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


-- Dumping database structure for study_tube
DROP DATABASE IF EXISTS `study_tube`;
CREATE DATABASE IF NOT EXISTS `study_tube` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `study_tube`;

-- Dumping structure for table study_tube.diskusi
DROP TABLE IF EXISTS `diskusi`;
CREATE TABLE IF NOT EXISTS `diskusi` (
  `discussionID` int NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `teacherID` int NOT NULL,
  `discussion_date` time NOT NULL,
  `file` longblob NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`discussionID`),
  KEY `studentID` (`studentID`,`teacherID`),
  KEY `teacherID` (`teacherID`),
  CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `diskusi_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.diskusi: ~0 rows (approximately)
DELETE FROM `diskusi`;

-- Dumping structure for table study_tube.guru
DROP TABLE IF EXISTS `guru`;
CREATE TABLE IF NOT EXISTS `guru` (
  `teacherID` int NOT NULL AUTO_INCREMENT,
  `schoolID` int NOT NULL,
  `userID` int NOT NULL,
  `followers` int NOT NULL,
  `balance` int NOT NULL,
  PRIMARY KEY (`teacherID`),
  KEY `schoolID` (`schoolID`,`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`schoolID`) REFERENCES `sekolah` (`schoolID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `guru_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.guru: ~5 rows (approximately)
DELETE FROM `guru`;
INSERT INTO `guru` (`teacherID`, `schoolID`, `userID`, `followers`, `balance`) VALUES
	(1, 1, 2, 160, 576),
	(2, 1, 5, 303, 684),
	(3, 1, 6, 415, 922),
	(4, 1, 7, 265, 459),
	(5, 1, 8, 402, 533);

-- Dumping structure for table study_tube.ikuti
DROP TABLE IF EXISTS `ikuti`;
CREATE TABLE IF NOT EXISTS `ikuti` (
  `studentID` int NOT NULL,
  `teacherID` int NOT NULL,
  KEY `FK_ikuti_guru` (`teacherID`),
  KEY `FK_ikuti_siswa` (`studentID`),
  CONSTRAINT `FK_ikuti_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ikuti_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table study_tube.ikuti: ~3 rows (approximately)
DELETE FROM `ikuti`;
INSERT INTO `ikuti` (`studentID`, `teacherID`) VALUES
	(1, 3),
	(1, 1),
	(1, 2),
	(1, 4);

-- Dumping structure for table study_tube.koin
DROP TABLE IF EXISTS `koin`;
CREATE TABLE IF NOT EXISTS `koin` (
  `coinID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `amount` int NOT NULL,
  `transaction_type` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`coinID`),
  KEY `userID` (`userID`),
  CONSTRAINT `koin_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.koin: ~0 rows (approximately)
DELETE FROM `koin`;

-- Dumping structure for table study_tube.modul
DROP TABLE IF EXISTS `modul`;
CREATE TABLE IF NOT EXISTS `modul` (
  `moduleID` int NOT NULL AUTO_INCREMENT,
  `teacherID` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `downloads` int NOT NULL,
  `file` longblob NOT NULL,
  PRIMARY KEY (`moduleID`),
  KEY `teacherID` (`teacherID`),
  CONSTRAINT `FK_modul_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.modul: ~0 rows (approximately)
DELETE FROM `modul`;

-- Dumping structure for table study_tube.rating
DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `ratingID` int NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `teacherID` int NOT NULL,
  `comment` int NOT NULL,
  `rating_score` int NOT NULL,
  PRIMARY KEY (`ratingID`),
  KEY `studentID` (`studentID`,`teacherID`),
  KEY `rating_ibfk_1` (`teacherID`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.rating: ~0 rows (approximately)
DELETE FROM `rating`;

-- Dumping structure for table study_tube.sekolah
DROP TABLE IF EXISTS `sekolah`;
CREATE TABLE IF NOT EXISTS `sekolah` (
  `schoolID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `school_address` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`schoolID`),
  KEY `userID` (`userID`),
  CONSTRAINT `sekolah_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.sekolah: ~0 rows (approximately)
DELETE FROM `sekolah`;
INSERT INTO `sekolah` (`schoolID`, `userID`, `school_address`) VALUES
	(1, 3, 'Jl. Logam no. 1');

-- Dumping structure for table study_tube.siswa
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `studentID` int NOT NULL AUTO_INCREMENT,
  `schoolID` int NOT NULL,
  `userID` int NOT NULL,
  `balance` int NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `schoolID` (`schoolID`,`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`schoolID`) REFERENCES `sekolah` (`schoolID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.siswa: ~0 rows (approximately)
DELETE FROM `siswa`;
INSERT INTO `siswa` (`studentID`, `schoolID`, `userID`, `balance`) VALUES
	(1, 1, 1, 70);

-- Dumping structure for table study_tube.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.user: ~7 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`userID`, `email`, `password`, `name`, `profile_photo`, `role`) VALUES
	(1, 'siswa@gmail.com', '2020', 'MFarhadA', '/Study-Tube/db/profile_photo/677a63b0ab1a7.jpg', 1),
	(2, 'guru', '2020', 'Guru Ajil', '/Study-Tube/db/profile_photo/677bcefc7e164.jpg', 2),
	(3, 'sekolah', '2020', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 3),
	(5, 'farhad.ajilla@gmail.com', '2020', 'Muhammad Farhad Ajilla', '/Study-Tube/assets/foto_profil.jpg', 2),
	(6, 'sarah.annisa@yahoo.com', '2020', 'Sarah Annisa', '/Study-Tube/assets/foto_profil.jpg', 2),
	(7, 'john.doe@example.com', '2020', 'John Doe', '/Study-Tube/assets/foto_profil.jpg', 2),
	(8, 'jane.smith@outlook.com', '2020', 'Jane Smith Stone Johnson', '/Study-Tube/assets/foto_profil.jpg', 2);

-- Dumping structure for table study_tube.video
DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `videoID` int NOT NULL AUTO_INCREMENT,
  `teacherID` int NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `views` int NOT NULL,
  `upload_date` datetime NOT NULL,
  PRIMARY KEY (`videoID`),
  KEY `teacherID` (`teacherID`),
  CONSTRAINT `video_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.video: ~15 rows (approximately)
DELETE FROM `video`;
INSERT INTO `video` (`videoID`, `teacherID`, `video`, `thumbnail`, `title`, `views`, `upload_date`) VALUES
	(1, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'How to Learn Programming', 359, '2024-09-22 20:14:00'),
	(2, 1, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', '10 Tips for Effective Studying', 310, '2024-12-25 20:14:00'),
	(3, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Mastering Python in 30 Days', 762, '2024-12-17 20:14:00'),
	(4, 2, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Understanding Machine Learning', 786, '2024-12-28 20:14:00'),
	(5, 2, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Data Science for Beginners', 178, '2024-11-30 20:14:00'),
	(6, 2, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Exploring Artificial Intelligence', 412, '2024-10-28 20:14:00'),
	(7, 3, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Learn JavaScript in a Week', 337, '2024-12-02 20:14:00'),
	(8, 3, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'React for Front-End Development', 800, '2024-10-26 20:14:00'),
	(9, 3, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Building Mobile Apps with Flutter', 272, '2024-10-02 20:14:00'),
	(10, 4, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Introduction to Game Development', 1066, '2024-12-16 20:14:00'),
	(11, 4, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Creating 3D Models in Blender', 906, '2024-10-31 20:14:00'),
	(12, 4, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Animating with Unity', 727, '2024-11-29 20:14:00'),
	(13, 5, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Mastering Unreal Engine', 769, '2024-11-19 20:14:00'),
	(14, 5, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Advanced Coding Techniques', 165, '2024-12-22 20:14:00'),
	(15, 5, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Introduction to Cloud Computing', 326, '2024-10-04 20:14:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
