# 🧺 LaundryIn (Proyek Sistem Informasi Laundry)

LaundryIn merupakan sistem informasi laundry sederhana yang dibangun menggunakan PHP dan MySQL. Tujuannya adalah untuk mengelola transaksi layanan laundry secara aman dan konsisten, dengan memanfaatkan **stored procedure**, **transaction**, **stored function**, dan **trigger**. Sistem ini memastikan bahwa seluruh data transaksi dan pakaian yang berkaitan disimpan secara utuh atau tidak sama sekali jika terjadi kesalahan. Seluruh logika utama ditempatkan di level database agar aplikasi tetap menjaga integritas data meskipun dijalankan secara multi-user.

![image](https://github.com/user-attachments/assets/d3c25da4-612d-4712-8838-b16c9f863e97)

![image](https://github.com/user-attachments/assets/10048996-4926-4a09-a280-dec89e46f972)


## 📌 Detail Konsep

### 🔵 Stored Procedure

Stored procedure di LaundryIn digunakan untuk membungkus logika penting saat melakukan transaksi laundry. Prosedur ini disimpan di sisi database dan menjamin bahwa pengolahan data utama berjalan terstruktur dan efisien.

![image](https://github.com/user-attachments/assets/f4b6bdc7-0e0b-40bc-8f8c-336cd2023bc4)

#### Contoh:

```sql
CREATE PROCEDURE tambah_transaksi (
    IN tgl_transaksi DATE,
    IN id_pelanggan INT,
    IN berat DECIMAL(10,2),
    IN tgl_selesai DATE
)
BEGIN
    DECLARE harga_per_kilo INT DEFAULT 8000;
    DECLARE total INT;

    SET total = hitung_total(berat, harga_per_kilo);

    INSERT INTO transaksi (
        transaksi_tgl,
        transaksi_pelanggan,
        transaksi_harga,
        transaksi_berat,
        transaksi_tgl_selesai,
        transaksi_status
    ) VALUES (
        tgl_transaksi,
        id_pelanggan,
        total,
        berat,
        tgl_selesai,
        0
    );
END;
```

Prosedur ini menjamin bahwa setiap transaksi laundry yang masuk sudah otomatis dihitung total harganya di dalam database, bukan di level aplikasi.

### ⚠️ Transaction

Sistem LaundryIn menggunakan transaksi database untuk memastikan bahwa proses penyimpanan data transaksi dan detail pakaian berjalan secara atomik. Jika terjadi kesalahan di salah satu proses (misal: gagal menyimpan pakaian), maka seluruh proses dibatalkan.

#### Contoh implementasi di `transaksi_aksi.php`:

```php
mysqli_begin_transaction($koneksi);

try {
    mysqli_query($koneksi, "CALL tambah_transaksi(...)");

    // Simpan pakaian satu per satu
    foreach (...) {
        mysqli_query($koneksi, "INSERT INTO pakaian (...)");
    }

    mysqli_commit($koneksi);
} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "Transaksi gagal: " . $e->getMessage();
}
```

Dengan mekanisme ini, sistem mencegah penyimpanan setengah jadi yang dapat menyebabkan inkonsistensi data di tabel `transaksi` dan `pakaian`.

### 📺 Stored Function

Stored function digunakan untuk menghitung total harga secara otomatis berdasarkan berat pakaian dan harga per kilo. Dengan menyimpan fungsi ini di dalam database, perhitungan menjadi lebih konsisten dan tidak perlu dikodekan ulang di banyak tempat.

![image](https://github.com/user-attachments/assets/ef93245a-3bda-41b8-8c7f-ef2df6c8b8da)

#### Contoh:

```sql
CREATE FUNCTION hitung_total(
    berat DECIMAL(10,2),
    harga_per_kilo INT
) RETURNS INT
DETERMINISTIC
BEGIN
    RETURN berat * harga_per_kilo;
END;
```

Function ini dipanggil dari dalam `tambah_transaksi`, sehingga perhitungan total dilakukan otomatis dan aman dari manipulasi sisi client.

### 🚨 Trigger

Trigger di LaundryIn digunakan untuk menjaga otomatisasi status pelanggan dan pencatatan log ketika terjadi perubahan data di tabel `transaksi`. Dua trigger utama digunakan untuk mengelola status pelanggan berdasarkan aktivitas transaksi:

![image](https://github.com/user-attachments/assets/987e4d82-4f88-4868-824e-e5b7d8ad5af3)

#### 1. `after_insert_transaksi`

Trigger ini aktif setiap kali ada transaksi baru yang masuk. Trigger ini:

- Mengubah status pelanggan menjadi **Aktif**
- Menyimpan log ke dalam tabel `log_transaksi`

```sql
CREATE TRIGGER after_insert_transaksi
AFTER INSERT ON transaksi
FOR EACH ROW
BEGIN
    -- Update status pelanggan menjadi Aktif
    UPDATE pelanggan
    SET pelanggan_status = 'Aktif'
    WHERE pelanggan_id = NEW.transaksi_pelanggan;

    -- Tambahkan log transaksi
    INSERT INTO log_transaksi (log_pelanggan_id, log_transaksi_id, log_tanggal)
    VALUES (NEW.transaksi_pelanggan, NEW.transaksi_id, NOW());
END;
```

#### 2. `transaksi_selesai_status`

Trigger ini aktif setiap kali data `transaksi` di-*update*. Jika semua transaksi untuk pelanggan tersebut sudah selesai (status = 2), maka status pelanggan diubah menjadi **Nonaktif**.

```sql
CREATE TRIGGER transaksi_selesai_status
AFTER UPDATE ON transaksi
FOR EACH ROW
BEGIN
    DECLARE sisa_transaksi INT;

    -- Hitung transaksi yang belum selesai untuk pelanggan
    SELECT COUNT(*) INTO sisa_transaksi
    FROM transaksi
    WHERE transaksi_pelanggan = NEW.transaksi_pelanggan
      AND transaksi_status != 2;

    -- Jika semua transaksi selesai, ubah status pelanggan jadi Nonaktif
    IF sisa_transaksi = 0 THEN
        UPDATE pelanggan
        SET pelanggan_status = 'Nonaktif'
        WHERE pelanggan_id = NEW.transaksi_pelanggan;
    END IF;
END;
```

Dengan dua trigger ini, sistem LaundryIn secara otomatis memastikan bahwa status pelanggan selalu merepresentasikan kondisi terkini transaksi mereka.

### 🔄 Backup Otomatis
Untuk menjaga ketersediaan dan keamanan data, sistem dilengkapi fitur backup otomatis menggunakan `mysqldump`dan task scheduler. Backup dilakukan secara berkala dan disimpan dengan nama file yang mencakup timestamp, sehingga mudah ditelusuri. Semua file disimpan di direktori `storage/backups`.

`backup.php`
```php
<?php
require_once __DIR__ . '/init.php';

$date = date('Y-m-d_H-i-s');
$backupFile = __DIR__ . "/storage/backups/laundryin_$date.sql";
$command = "\"C:\\xampp\\mysql\\bin\\mysqldump.exe\" -u " . DB_USER . " " . DB_NAME . " > \"$backupFile\"";
exec($command);
```

---

## 🛠️ Integrasi dengan Sistem

LaundryIn menyimpan logika inti di dalam database. Dengan menggunakan kombinasi **procedure**, **function**, **trigger**, dan **transaction**, sistem ini menjaga:

- **Konsistensi data**: semua proses harus berhasil untuk disimpan.
- **Keamanan logika bisnis**: validasi dan hitung otomatis dilakukan di server.
- **Skalabilitas**: cocok untuk lingkungan multi-user tanpa risiko konflik data.

---
