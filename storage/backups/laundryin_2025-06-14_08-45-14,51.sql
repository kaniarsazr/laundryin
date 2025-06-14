-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: laundryin
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'kania','kania123'),(2,'admin','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harga`
--

DROP TABLE IF EXISTS `harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `harga` (
  `harga_per_kilo` int(11) NOT NULL,
  PRIMARY KEY (`harga_per_kilo`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harga`
--

LOCK TABLES `harga` WRITE;
/*!40000 ALTER TABLE `harga` DISABLE KEYS */;
INSERT INTO `harga` VALUES (8000);
/*!40000 ALTER TABLE `harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_transaksi`
--

DROP TABLE IF EXISTS `log_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_transaksi` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_pelanggan_id` int(11) DEFAULT NULL,
  `log_transaksi_id` int(11) DEFAULT NULL,
  `log_tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_pelanggan_id` (`log_pelanggan_id`),
  KEY `log_transaksi_id` (`log_transaksi_id`),
  CONSTRAINT `log_transaksi_ibfk_1` FOREIGN KEY (`log_pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE,
  CONSTRAINT `log_transaksi_ibfk_2` FOREIGN KEY (`log_transaksi_id`) REFERENCES `transaksi` (`transaksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_transaksi`
--

LOCK TABLES `log_transaksi` WRITE;
/*!40000 ALTER TABLE `log_transaksi` DISABLE KEYS */;
INSERT INTO `log_transaksi` VALUES (1,9,5,'2025-06-12 23:45:01'),(7,9,11,'2025-06-13 00:37:54'),(9,11,13,'2025-06-13 00:43:23');
/*!40000 ALTER TABLE `log_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pakaian`
--

DROP TABLE IF EXISTS `pakaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pakaian` (
  `pakaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `pakaian_transaksi` int(11) NOT NULL,
  `pakaian_jenis` varchar(255) NOT NULL,
  `pakaian_jumlah` int(11) NOT NULL,
  PRIMARY KEY (`pakaian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pakaian`
--

LOCK TABLES `pakaian` WRITE;
/*!40000 ALTER TABLE `pakaian` DISABLE KEYS */;
INSERT INTO `pakaian` VALUES (6,3,'Baju Kaos',4),(7,3,'Celana Levis',1),(8,3,'Baju Kemeja',1),(9,3,'Kain Sarung',1),(13,4,'Jaket',1),(14,4,'Celana Pendek',2),(18,1,'Baju Kaos',5),(19,1,'Celana Pendek',2),(20,1,'Baju Batik',2),(21,2,'Baju Kaos',2),(22,2,'Celana Levis',2),(23,2,'Kain Sarung',2),(24,2,'Baju Kemeja',2),(25,2,'Jaket',1),(29,7,'Sweater',4),(31,7,'Selimut',1),(33,9,'Kemeja',6),(39,5,'Selimut',1),(43,11,'Celana Dalam',5),(47,13,'Baju Kaos',3);
/*!40000 ALTER TABLE `pakaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_hp` varchar(20) NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_status` varchar(20) DEFAULT 'Tidak Aktif',
  PRIMARY KEY (`pelanggan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES (9,'Kania','08123','Hatimu','Nonaktif'),(11,'Indah','081234567890','Pokoknya','Nonaktif');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_tgl` date NOT NULL,
  `transaksi_pelanggan` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL,
  `transaksi_berat` int(11) NOT NULL,
  `transaksi_tgl_selesai` date NOT NULL,
  `transaksi_status` int(11) NOT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (1,'2020-01-14',5,24000,3,'2020-01-15',2),(2,'2020-01-14',6,16000,2,'2020-01-18',1),(3,'2020-01-14',7,8000,1,'2020-01-19',0),(4,'2020-01-14',8,8000,1,'2020-01-19',0),(5,'2025-06-12',9,24000,3,'2025-06-12',2),(7,'2025-06-12',7,40000,5,'2025-06-12',0),(9,'2025-06-12',8,16000,2,'2025-06-12',0),(11,'2025-06-12',9,8000,1,'2025-06-13',2),(13,'2025-06-12',11,8000,1,'2025-06-13',2),(15,'2025-06-14',13,5000,1,'2025-06-14',0);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_insert_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
    -- Update status pelanggan menjadi Aktif
    UPDATE pelanggan 
    SET pelanggan_status = 'Aktif' 
    WHERE pelanggan_id = NEW.transaksi_pelanggan;

    -- Tambahkan log transaksi
    INSERT INTO log_transaksi (log_pelanggan_id, log_transaksi_id, log_tanggal)
    VALUES (NEW.transaksi_pelanggan, NEW.transaksi_id, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `transaksi_selesai_status` AFTER UPDATE ON `transaksi` FOR EACH ROW BEGIN
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
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'laundryin'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
/*!50003 DROP FUNCTION IF EXISTS `hitung_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `hitung_total`(`berat` DECIMAL(10,2), `harga_per_kilo` INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
    RETURN berat * harga_per_kilo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `tambah_transaksi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_transaksi`(IN `tgl_transaksi` DATE, IN `id_pelanggan` INT, IN `berat` DECIMAL(10,2), IN `tgl_selesai` DATE)
BEGIN
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-14  8:45:17
