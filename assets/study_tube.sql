-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for apotek
CREATE DATABASE IF NOT EXISTS `apotek` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `apotek`;

-- Dumping structure for table apotek.detail_obat
CREATE TABLE IF NOT EXISTS `detail_obat` (
  `Id_det_ob` int NOT NULL,
  `NoResep` int DEFAULT NULL,
  `Subtotal` int DEFAULT NULL,
  `Jumlah` int DEFAULT NULL,
  `KodeObat` int DEFAULT NULL,
  PRIMARY KEY (`Id_det_ob`),
  KEY `NoResep` (`NoResep`),
  KEY `KodeObat` (`KodeObat`),
  CONSTRAINT `detail_obat_ibfk_1` FOREIGN KEY (`NoResep`) REFERENCES `resep` (`NoResep`),
  CONSTRAINT `detail_obat_ibfk_2` FOREIGN KEY (`KodeObat`) REFERENCES `obat` (`KodeObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.detail_obat: ~0 rows (approximately)
DELETE FROM `detail_obat`;

-- Dumping structure for table apotek.detail_retur
CREATE TABLE IF NOT EXISTS `detail_retur` (
  `Id_retur` int NOT NULL,
  `Id_det_ob` int NOT NULL,
  PRIMARY KEY (`Id_retur`,`Id_det_ob`),
  KEY `Id_det_ob` (`Id_det_ob`),
  CONSTRAINT `detail_retur_ibfk_1` FOREIGN KEY (`Id_retur`) REFERENCES `retur` (`Id_retur`),
  CONSTRAINT `detail_retur_ibfk_2` FOREIGN KEY (`Id_det_ob`) REFERENCES `detail_obat` (`Id_det_ob`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.detail_retur: ~0 rows (approximately)
DELETE FROM `detail_retur`;

-- Dumping structure for table apotek.kategori_obat
CREATE TABLE IF NOT EXISTS `kategori_obat` (
  `Id_kategori` int NOT NULL,
  `Nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Keterangan` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`Id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.kategori_obat: ~0 rows (approximately)
DELETE FROM `kategori_obat`;

-- Dumping structure for table apotek.notelppasien
CREATE TABLE IF NOT EXISTS `notelppasien` (
  `NoPasien` int NOT NULL,
  `NoTelp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoPasien`),
  CONSTRAINT `notelppasien_ibfk_1` FOREIGN KEY (`NoPasien`) REFERENCES `pasien` (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.notelppasien: ~0 rows (approximately)
DELETE FROM `notelppasien`;

-- Dumping structure for table apotek.notelppegawai
CREATE TABLE IF NOT EXISTS `notelppegawai` (
  `Id_pegawai` int NOT NULL,
  `No_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_pegawai`),
  CONSTRAINT `notelppegawai_ibfk_1` FOREIGN KEY (`Id_pegawai`) REFERENCES `pegawai` (`Id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.notelppegawai: ~0 rows (approximately)
DELETE FROM `notelppegawai`;

-- Dumping structure for table apotek.obat
CREATE TABLE IF NOT EXISTS `obat` (
  `KodeObat` int NOT NULL,
  `Id_kategori` int DEFAULT NULL,
  `MerkObat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Hargasatuan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Dosis` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Jumlah` int DEFAULT NULL,
  PRIMARY KEY (`KodeObat`),
  KEY `Id_kategori` (`Id_kategori`),
  CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`Id_kategori`) REFERENCES `kategori_obat` (`Id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.obat: ~0 rows (approximately)
DELETE FROM `obat`;

-- Dumping structure for table apotek.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `NoPasien` int NOT NULL,
  `Nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Alamat` text COLLATE utf8mb4_general_ci,
  `Pekerjaan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NoKtp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.pasien: ~0 rows (approximately)
DELETE FROM `pasien`;

-- Dumping structure for table apotek.pasien_bpjs
CREATE TABLE IF NOT EXISTS `pasien_bpjs` (
  `NoPasien` int NOT NULL,
  `NIK_BPJS` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `JenisBPJS` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoPasien`),
  CONSTRAINT `pasien_bpjs_ibfk_1` FOREIGN KEY (`NoPasien`) REFERENCES `pasien` (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.pasien_bpjs: ~0 rows (approximately)
DELETE FROM `pasien_bpjs`;

-- Dumping structure for table apotek.pasien_non_bpjs
CREATE TABLE IF NOT EXISTS `pasien_non_bpjs` (
  `NoPasien` int NOT NULL,
  `Faskes` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoPasien`),
  CONSTRAINT `pasien_non_bpjs_ibfk_1` FOREIGN KEY (`NoPasien`) REFERENCES `pasien` (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.pasien_non_bpjs: ~0 rows (approximately)
DELETE FROM `pasien_non_bpjs`;

-- Dumping structure for table apotek.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `Id_pegawai` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `jabatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `No_ktp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.pegawai: ~0 rows (approximately)
DELETE FROM `pegawai`;

-- Dumping structure for table apotek.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `Id_bayar` int NOT NULL,
  `Id_pegawai` int DEFAULT NULL,
  `Tgl_bayar` date DEFAULT NULL,
  `jumlah_bayar` int DEFAULT NULL,
  `sisa_piutang` int DEFAULT NULL,
  PRIMARY KEY (`Id_bayar`),
  KEY `Id_pegawai` (`Id_pegawai`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`Id_pegawai`) REFERENCES `pegawai` (`Id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.pembayaran: ~0 rows (approximately)
DELETE FROM `pembayaran`;

-- Dumping structure for table apotek.resep
CREATE TABLE IF NOT EXISTS `resep` (
  `NoResep` int NOT NULL,
  `NoPasien` int DEFAULT NULL,
  `TglResep` date DEFAULT NULL,
  `Asaldokter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Total` int DEFAULT NULL,
  `Id_bayar` int DEFAULT NULL,
  PRIMARY KEY (`NoResep`),
  KEY `NoPasien` (`NoPasien`),
  KEY `Id_bayar` (`Id_bayar`),
  CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`NoPasien`) REFERENCES `pasien` (`NoPasien`),
  CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`Id_bayar`) REFERENCES `pembayaran` (`Id_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.resep: ~0 rows (approximately)
DELETE FROM `resep`;

-- Dumping structure for table apotek.retur
CREATE TABLE IF NOT EXISTS `retur` (
  `Id_retur` int NOT NULL,
  `Tglretur` date DEFAULT NULL,
  PRIMARY KEY (`Id_retur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apotek.retur: ~0 rows (approximately)
DELETE FROM `retur`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
