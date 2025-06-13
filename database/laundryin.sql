-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2025 at 12:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundryin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_transaksi` (IN `tgl_transaksi` DATE, IN `id_pelanggan` INT, IN `berat` DECIMAL(10,2), IN `tgl_selesai` DATE)   BEGIN
    DECLARE harga_per_kilo INT DEFAULT 8000;
    DECLARE total INT;

    -- Hitung total dari berat dan harga per kilo
    SET total = hitung_total(berat, harga_per_kilo);

    -- Simpan ke tabel transaksi
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
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hitung_total` (`berat` DECIMAL(10,2), `harga_per_kilo` INT) RETURNS INT DETERMINISTIC BEGIN
    RETURN berat * harga_per_kilo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(0, 'admin', 'admin123'),
(1, 'kania', 'kania123'),
(2, 'della', 'della123');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `harga_per_kilo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`harga_per_kilo`) VALUES
(8000);

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `log_id` int NOT NULL,
  `log_pelanggan_id` int DEFAULT NULL,
  `log_transaksi_id` int DEFAULT NULL,
  `log_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_transaksi`
--

INSERT INTO `log_transaksi` (`log_id`, `log_pelanggan_id`, `log_transaksi_id`, `log_tanggal`) VALUES
(1, 9, 5, '2025-06-12 23:45:01'),
(5, 8, 9, '2025-06-12 23:56:01'),
(7, 9, 11, '2025-06-13 00:37:54'),
(11, 13, 15, '2025-06-13 18:37:06'),
(12, 11, 16, '2025-06-13 18:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `pakaian`
--

CREATE TABLE `pakaian` (
  `pakaian_id` int NOT NULL,
  `pakaian_transaksi` int NOT NULL,
  `pakaian_jenis` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pakaian_jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pakaian`
--

INSERT INTO `pakaian` (`pakaian_id`, `pakaian_transaksi`, `pakaian_jenis`, `pakaian_jumlah`) VALUES
(6, 3, 'Baju Kaos', 4),
(7, 3, 'Celana Levis', 1),
(8, 3, 'Baju Kemeja', 1),
(9, 3, 'Kain Sarung', 1),
(18, 1, 'Baju Kaos', 5),
(19, 1, 'Celana Pendek', 2),
(20, 1, 'Baju Batik', 2),
(21, 2, 'Baju Kaos', 2),
(22, 2, 'Celana Levis', 2),
(23, 2, 'Kain Sarung', 2),
(24, 2, 'Baju Kemeja', 2),
(25, 2, 'Jaket', 1),
(29, 7, 'Sweater', 4),
(31, 7, 'Selimut', 1),
(33, 9, 'Kemeja', 6),
(39, 5, 'Selimut', 1),
(43, 11, 'Celana Dalam', 5),
(49, 1, 'celana', 3),
(51, 123, 'celana', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int NOT NULL,
  `pelanggan_nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pelanggan_hp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pelanggan_alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `pelanggan_status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_hp`, `pelanggan_alamat`, `pelanggan_status`) VALUES
(8, 'RANIA', '089934531343', 'Jl. Cendrawasih', 'Aktif'),
(9, 'Kania', '08123', 'Hatimu', 'Aktif'),
(11, 'Indah', '081234567890', 'Pokoknya', 'Nonaktif'),
(13, 'Indah Febriana Della', '089670976543', 'Tanggamus', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int NOT NULL,
  `transaksi_tgl` date NOT NULL,
  `transaksi_pelanggan` int NOT NULL,
  `transaksi_harga` int NOT NULL,
  `transaksi_berat` int NOT NULL,
  `transaksi_tgl_selesai` date NOT NULL,
  `transaksi_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tgl`, `transaksi_pelanggan`, `transaksi_harga`, `transaksi_berat`, `transaksi_tgl_selesai`, `transaksi_status`) VALUES
(1, '2020-01-14', 5, 24000, 3, '2020-01-15', 2),
(2, '2020-01-14', 6, 16000, 2, '2020-01-18', 1),
(3, '2020-01-14', 7, 8000, 1, '2020-01-19', 0),
(4, '2020-01-14', 8, 8000, 1, '2020-01-19', 1),
(5, '2025-06-12', 9, 24000, 3, '2025-06-12', 2),
(7, '2025-06-12', 7, 40000, 5, '2025-06-12', 0),
(9, '2025-06-12', 8, 16000, 2, '2025-06-12', 0),
(11, '2025-06-12', 9, 8000, 1, '2025-06-13', 2),
(15, '2025-06-13', 13, 32000, 4, '2025-06-14', 1),
(16, '2025-06-13', 11, 56000, 7, '2025-06-15', 0);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_insert_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
    -- Update status pelanggan menjadi Aktif
    UPDATE pelanggan 
    SET pelanggan_status = 'Aktif' 
    WHERE pelanggan_id = NEW.transaksi_pelanggan;

    -- Tambahkan log transaksi
    INSERT INTO log_transaksi (log_pelanggan_id, log_transaksi_id, log_tanggal)
    VALUES (NEW.transaksi_pelanggan, NEW.transaksi_id, NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi_selesai_status` AFTER UPDATE ON `transaksi` FOR EACH ROW BEGIN
  DECLARE sisa_transaksi INT;

  -- Hitung transaksi yang belum selesai untuk pelanggan itu
  SELECT COUNT(*) INTO sisa_transaksi
  FROM transaksi
  WHERE transaksi_pelanggan = NEW.transaksi_pelanggan AND transaksi_status != 2;

  -- Jika semua transaksi selesai, ubah status pelanggan jadi Nonaktif
  IF sisa_transaksi = 0 THEN
    UPDATE pelanggan
    SET pelanggan_status = 'Nonaktif'
    WHERE pelanggan_id = NEW.transaksi_pelanggan;
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`harga_per_kilo`) USING BTREE;

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_pelanggan_id` (`log_pelanggan_id`),
  ADD KEY `log_transaksi_id` (`log_transaksi_id`);

--
-- Indexes for table `pakaian`
--
ALTER TABLE `pakaian`
  ADD PRIMARY KEY (`pakaian_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pakaian`
--
ALTER TABLE `pakaian`
  MODIFY `pakaian_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD CONSTRAINT `log_transaksi_ibfk_1` FOREIGN KEY (`log_pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_2` FOREIGN KEY (`log_transaksi_id`) REFERENCES `transaksi` (`transaksi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
