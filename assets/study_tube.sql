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

-- Dumping structure for table study_tube.favorit
DROP TABLE IF EXISTS `favorit`;
CREATE TABLE IF NOT EXISTS `favorit` (
  `studentID` int NOT NULL,
  `videoID` int NOT NULL,
  KEY `FK_favorit_siswa` (`studentID`),
  KEY `FK_favorit_video` (`videoID`),
  CONSTRAINT `FK_favorit_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`),
  CONSTRAINT `FK_favorit_video` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table study_tube.favorit: ~5 rows (approximately)
REPLACE INTO `favorit` (`studentID`, `videoID`) VALUES
	(1, 16),
	(1, 11),
	(1, 39),
	(1, 19),
	(1, 2),
	(1, 43),
	(7, 25),
	(7, 4);

-- Dumping structure for table study_tube.guru
DROP TABLE IF EXISTS `guru`;
CREATE TABLE IF NOT EXISTS `guru` (
  `teacherID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `followers` int NOT NULL,
  PRIMARY KEY (`teacherID`),
  KEY `schoolID` (`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `guru_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.guru: ~5 rows (approximately)
REPLACE INTO `guru` (`teacherID`, `userID`, `followers`) VALUES
	(1, 2, 4),
	(2, 5, 2),
	(3, 6, 1),
	(4, 7, 1),
	(5, 8, 0),
	(6, 14, 0);

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

-- Dumping data for table study_tube.ikuti: ~7 rows (approximately)
REPLACE INTO `ikuti` (`studentID`, `teacherID`) VALUES
	(2, 1),
	(3, 1),
	(4, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 1),
	(7, 2);

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

-- Dumping structure for table study_tube.modul
DROP TABLE IF EXISTS `modul`;
CREATE TABLE IF NOT EXISTS `modul` (
  `moduleID` int NOT NULL AUTO_INCREMENT,
  `teacherID` int NOT NULL,
  `videoID` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `download` int NOT NULL,
  `modul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`moduleID`),
  KEY `teacherID` (`teacherID`),
  KEY `FK_modul_video` (`videoID`),
  CONSTRAINT `FK_modul_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`),
  CONSTRAINT `FK_modul_video` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.modul: ~6 rows (approximately)
REPLACE INTO `modul` (`moduleID`, `teacherID`, `videoID`, `title`, `download`, `modul`) VALUES
	(1, 1, 1, 'How to Create a Website', 129, '/Study-Tube/assets/modul_pdf.pdf'),
	(2, 1, 2, 'Advanced PHP Techniques', 105, '/Study-Tube/assets/modul_dokumen.docx'),
	(3, 1, 16, 'Modul untuk test', 10, 'module_1737324809_Tata Bahasa Bebas Kontek Metode Chomsky.pptx'),
	(16, 1, 19, 'Keamanan_Informasi_Data_Pribadi_Pada_Med', 11, '/Study-Tube/db/module/module_1737424746_Keamanan_Informasi_Data_Pribadi_Pada_Med.pdf'),
	(17, 1, 25, 'modul_pdf', 6, '/Study-Tube/db/module/module_1737432964_modul_pdf.pdf'),
	(22, 2, 39, 'BDT 5-6', 2, '/Study-Tube/db/module/module_1737575805_BDT 5-6.pptx'),
	(23, 1, 43, 'Keamanan_Informasi_Data_Pribadi_Pada_Med', 12, '/Study-Tube/db/module/module_1737676445_Keamanan_Informasi_Data_Pribadi_Pada_Med.pdf');

-- Dumping structure for table study_tube.notifikasi_guru
DROP TABLE IF EXISTS `notifikasi_guru`;
CREATE TABLE IF NOT EXISTS `notifikasi_guru` (
  `notificationID` int NOT NULL AUTO_INCREMENT,
  `teacherID` int NOT NULL,
  `videoID` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('unread','read') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'unread',
  PRIMARY KEY (`notificationID`),
  KEY `userID` (`teacherID`) USING BTREE,
  KEY `FK_notifikasi_guru_video` (`videoID`),
  CONSTRAINT `FK_notifikasi_guru_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`),
  CONSTRAINT `FK_notifikasi_guru_video` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.notifikasi_guru: ~0 rows (approximately)

-- Dumping structure for table study_tube.notifikasi_siswa
DROP TABLE IF EXISTS `notifikasi_siswa`;
CREATE TABLE IF NOT EXISTS `notifikasi_siswa` (
  `notificationID_s` int NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` datetime NOT NULL,
  `status` enum('unread','read') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'unread',
  PRIMARY KEY (`notificationID_s`),
  KEY `FK_notifikasi_siswa_siswa` (`studentID`),
  CONSTRAINT `FK_notifikasi_siswa_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table study_tube.notifikasi_siswa: ~0 rows (approximately)
REPLACE INTO `notifikasi_siswa` (`notificationID_s`, `studentID`, `message`, `upload_date`, `status`) VALUES
	(1, 7, 'test Siswa telah memfavoritkan video anda "Standard Deviation of Hawk Tuah"', '2025-01-26 21:38:13', 'unread'),
	(2, 7, 'test Siswa telah memfavoritkan video anda "Understanding Machine Learning"', '2025-01-26 21:38:28', 'unread'),
	(3, 7, 'test Siswa telah mengikuti anda', '2025-01-26 21:38:30', 'unread');

-- Dumping structure for table study_tube.rating
DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `ratingID` int NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `teacherID` int NOT NULL,
  `rating_score` tinyint NOT NULL,
  PRIMARY KEY (`ratingID`),
  KEY `studentID` (`studentID`,`teacherID`),
  KEY `rating_ibfk_1` (`teacherID`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.rating: ~4 rows (approximately)
REPLACE INTO `rating` (`ratingID`, `studentID`, `teacherID`, `rating_score`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 5),
	(3, 3, 1, 3),
	(4, 4, 1, 2);

-- Dumping structure for table study_tube.sekolah
DROP TABLE IF EXISTS `sekolah`;
CREATE TABLE IF NOT EXISTS `sekolah` (
  `schoolID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `school_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`schoolID`),
  KEY `userID` (`userID`),
  CONSTRAINT `sekolah_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.sekolah: ~0 rows (approximately)
REPLACE INTO `sekolah` (`schoolID`, `userID`, `school_address`) VALUES
	(1, 3, 'Jl. Logam no. 1');

-- Dumping structure for table study_tube.siswa
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `studentID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `schoolID` (`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.siswa: ~6 rows (approximately)
REPLACE INTO `siswa` (`studentID`, `userID`) VALUES
	(1, 1),
	(2, 9),
	(3, 10),
	(4, 11),
	(5, 12),
	(6, 13),
	(7, 15);

-- Dumping structure for table study_tube.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.user: ~14 rows (approximately)
REPLACE INTO `user` (`userID`, `email`, `password`, `name`, `school`, `profile_photo`, `role`) VALUES
	(1, 'siswa@gmail.com', '2020', 'MFarhadA', 'Manbaul Huda', '/Study-Tube/db/profile_photo/6792e2a2348f3.jpg', 1),
	(2, 'guru', '2020', 'Guru Ajil', 'Manbaul Huda', '/Study-Tube/db/profile_photo/677bcefc7e164.jpg', 2),
	(3, 'sekolah', '2020', 'Manbaul Huda', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 3),
	(5, 'farhad.ajilla@gmail.com', '2020', 'Muhammad Farhad Ajilla', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 2),
	(6, 'sarah.annisa@yahoo.com', '2020', 'Sarah Annisa', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 2),
	(7, 'john.doe@example.com', '2020', 'John Doe', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 2),
	(8, 'jane.smith@outlook.com', '2020', 'Jane Smith Stone Johnson', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 2),
	(9, 'murid1@example.com', '2020', 'Murid Satu', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 1),
	(10, 'murid2@example.com', '2020', 'Murid Dua', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 1),
	(11, 'murid3@example.com', '2020', 'Murid Tiga', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 1),
	(12, 'murid4@example.com', '2020', 'Murid Empat', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 1),
	(13, 'murid5@example.com', '2020', 'Murid Lima', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.jpg', 1),
	(14, 'gurug', '2020', 'test Guru', 'Manbaul Test', '/Study-Tube/assets/foto_profil.jpg', 2),
	(15, 'siswoo', '2020', 'test Siswa', 'Test Manbaul', '/Study-Tube/assets/foto_profil.jpg', 1);

-- Dumping structure for table study_tube.video
DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `videoID` int NOT NULL AUTO_INCREMENT,
  `teacherID` int NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `views` int NOT NULL,
  `upload_date` datetime NOT NULL,
  `favorite` int DEFAULT '0',
  PRIMARY KEY (`videoID`),
  KEY `teacherID` (`teacherID`),
  CONSTRAINT `video_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table study_tube.video: ~19 rows (approximately)
REPLACE INTO `video` (`videoID`, `teacherID`, `video`, `thumbnail`, `title`, `views`, `upload_date`, `favorite`) VALUES
	(1, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'How to Learn Programming', 360, '2024-09-22 20:14:00', 0),
	(2, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', '10 Tips for Effective Studying test 2', 314, '2025-01-19 19:55:21', 1),
	(3, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Mastering Python in 30 Days', 762, '2024-12-17 20:14:00', 0),
	(4, 2, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Understanding Machine Learning', 788, '2024-12-28 20:14:00', 1),
	(5, 2, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Data Science for Beginners', 178, '2024-11-30 20:14:00', 0),
	(6, 2, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Exploring Artificial Intelligence', 412, '2024-10-28 20:14:00', 0),
	(7, 3, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Learn JavaScript in a Week', 338, '2024-12-02 20:14:00', 0),
	(8, 3, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'React for Front-End Development', 800, '2024-10-26 20:14:00', 0),
	(9, 3, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Building Mobile Apps with Flutter', 272, '2024-10-02 20:14:00', 0),
	(10, 4, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Introduction to Game Development', 1067, '2024-12-16 20:14:00', 0),
	(11, 4, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Creating 3D Models in Blender', 907, '2024-10-31 20:14:00', 1),
	(12, 4, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Animating with Unity', 727, '2024-11-29 20:14:00', 0),
	(13, 5, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Mastering Unreal Engine', 769, '2024-11-19 20:14:00', 0),
	(14, 5, '/Study-Tube/assets/video.mp4', '/Study-Tube/assets/video_thumbnail.jpg', 'Advanced Coding Techniques', 166, '2024-12-22 20:14:00', 0),
	(15, 5, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Introduction to Cloud Computing', 326, '2024-10-04 20:14:00', 0),
	(16, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', 'test', 2, '2025-01-18 22:11:11', 1),
	(19, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', 'test file modul', 2, '2025-01-21 01:59:06', 1),
	(25, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737432964_1130469.png', 'Standard Deviation of Hawk Tuah', 2, '2025-01-21 04:16:04', 1),
	(39, 2, '/Study-Tube/db/video/video_1737575805_349145032_662634269011515_6425198523701700097_n.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737575805_FB_IMG_1690461040731.jpg', 'halo tuah', 1, '2025-01-22 19:56:45', 1),
	(43, 1, '/Study-Tube/db/video/video_1737676445_349145032_662634269011515_6425198523701700097_n.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737676445_349362221_696151078986426_3921021623258311066_n.jpg', 'test notif', 2, '2025-01-23 23:54:05', 1);

-- Dumping structure for trigger study_tube.update_favorite_after_delete
DROP TRIGGER IF EXISTS `update_favorite_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_favorite_after_delete` AFTER DELETE ON `favorit` FOR EACH ROW BEGIN
    UPDATE video
    SET favorite = favorite - 1
    WHERE videoID = OLD.videoID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger study_tube.update_favorite_after_insert
DROP TRIGGER IF EXISTS `update_favorite_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_favorite_after_insert` AFTER INSERT ON `favorit` FOR EACH ROW BEGIN
    UPDATE video
    SET favorite = favorite + 1
    WHERE videoID = NEW.videoID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger study_tube.update_followers_after_delete
DROP TRIGGER IF EXISTS `update_followers_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_followers_after_delete` AFTER DELETE ON `ikuti` FOR EACH ROW BEGIN
    UPDATE guru
    SET followers = (SELECT COUNT(*) FROM ikuti WHERE teacherID = OLD.teacherID)
    WHERE teacherID = OLD.teacherID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger study_tube.update_followers_after_insert
DROP TRIGGER IF EXISTS `update_followers_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_followers_after_insert` AFTER INSERT ON `ikuti` FOR EACH ROW BEGIN
    UPDATE guru
    SET followers = (SELECT COUNT(*) FROM ikuti WHERE teacherID = NEW.teacherID)
    WHERE teacherID = NEW.teacherID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
