/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `study_tube`;
CREATE DATABASE IF NOT EXISTS `study_tube` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `study_tube`;

DROP TABLE IF EXISTS `favorit`;
CREATE TABLE IF NOT EXISTS `favorit` (
  `studentID` int NOT NULL,
  `videoID` int NOT NULL,
  KEY `FK_favorit_siswa` (`studentID`),
  KEY `FK_favorit_video` (`videoID`),
  CONSTRAINT `FK_favorit_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`),
  CONSTRAINT `FK_favorit_video` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `favorit`;
INSERT INTO `favorit` (`studentID`, `videoID`) VALUES
	(1, 39),
	(1, 19),
	(1, 2),
	(1, 43),
	(7, 25),
	(1, 47),
	(1, 51),
	(1, 49),
	(1, 54),
	(1, 16),
	(1, 52),
	(1, 50);

DROP TABLE IF EXISTS `guru`;
CREATE TABLE IF NOT EXISTS `guru` (
  `teacherID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `followers` int NOT NULL,
  PRIMARY KEY (`teacherID`),
  KEY `schoolID` (`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `guru_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `guru`;
INSERT INTO `guru` (`teacherID`, `userID`, `followers`) VALUES
	(1, 2, 4),
	(2, 5, 1),
	(3, 6, 0),
	(4, 7, 0),
	(5, 8, 0),
	(6, 14, 0),
	(8, 16, 1),
	(9, 17, 1),
	(10, 19, 1);

DROP TABLE IF EXISTS `ikuti`;
CREATE TABLE IF NOT EXISTS `ikuti` (
  `studentID` int NOT NULL,
  `teacherID` int NOT NULL,
  KEY `FK_ikuti_guru` (`teacherID`),
  KEY `FK_ikuti_siswa` (`studentID`),
  CONSTRAINT `FK_ikuti_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ikuti_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `ikuti`;
INSERT INTO `ikuti` (`studentID`, `teacherID`) VALUES
	(2, 1),
	(3, 1),
	(4, 1),
	(7, 2),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `modul`;
INSERT INTO `modul` (`moduleID`, `teacherID`, `videoID`, `title`, `download`, `modul`) VALUES
	(16, 1, 19, 'Keamanan_Informasi_Data_Pribadi_Pada_Med', 11, '/Study-Tube/db/module/module_1737424746_Keamanan_Informasi_Data_Pribadi_Pada_Med.pdf'),
	(17, 1, 25, 'modul_pdf', 6, '/Study-Tube/db/module/module_1737432964_modul_pdf.pdf'),
	(22, 2, 39, 'BDT 5-6', 3, '/Study-Tube/db/module/module_1737575805_BDT 5-6.pptx'),
	(23, 1, 43, 'Keamanan_Informasi_Data_Pribadi_Pada_Med', 12, '/Study-Tube/db/module/module_1737676445_Keamanan_Informasi_Data_Pribadi_Pada_Med.pdf'),
	(24, 10, 52, 'TBO Mesin Turing', 4, '/Study-Tube/db/module/module_1738384765_TBO Mesin Turing.pptx');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `notifikasi_guru`;
INSERT INTO `notifikasi_guru` (`notificationID`, `teacherID`, `videoID`, `message`, `upload_date`, `status`) VALUES
	(1, 8, 44, 'm4th-lab telah mengunggah video baru "Matriks Matematika Wajib Kelas 11 Bagian 1 - Pengenalan Matriks"', '2025-02-01 05:50:06', 'unread'),
	(2, 8, 45, 'm4th-lab telah mengunggah video baru "Transformasi Geometri Bagian 1 - Translasi (Pergeseran) Matematika Wajib Kelas 11"', '2025-02-01 05:50:28', 'unread'),
	(3, 8, 46, 'm4th-lab telah mengunggah video baru "Aplikasi Turunan 1  Gradien, Persamaan Garis Singgung dan Persamaan Garis Normal"', '2025-02-01 05:50:45', 'unread'),
	(4, 8, 47, 'm4th-lab telah mengunggah video baru "Integral Trigonometri Dasar, Substitusi & Menggunakan Identitas Trigonometri (Integral Part 6)"', '2025-02-01 05:51:15', 'unread'),
	(5, 8, 48, 'm4th-lab telah mengunggah video baru "Induksi Matematika Pembuktian Deret Bilangan - Matematika Wajib Kelas XI"', '2025-02-01 05:51:28', 'unread'),
	(6, 9, 49, 'Irfan Suryana telah mengunggah video baru "Materi Bahasa Inggris Kelas X Semester 2 Bab 6 Fractured Story (Narrative Text)"', '2025-02-01 08:43:39', 'unread'),
	(7, 9, 50, 'Irfan Suryana telah mengunggah video baru "Congratulating Others  Mengucapkan Selamat kepada Orang Lain  Materi Bahasa Inggris SMA Kelas X"', '2025-02-01 08:44:02', 'unread'),
	(8, 9, 51, 'Irfan Suryana telah mengunggah video baru "Rangkuman Materi Bahasa Inggris SMA Kelas X Semester 1 (Semester Ganjil) - Irfan Suryana (720p, h264)"', '2025-02-01 08:44:14', 'unread'),
	(9, 10, 52, 'edcent id telah mengunggah video baru "PEMBAHASAN SOAL EKONOMI - MATERI PENDAPATAN NASIONAL - PERSIAPAN UTBK SBMPTN DAN SIMAK UI"', '2025-02-01 08:54:39', 'unread'),
	(10, 10, 53, 'edcent id telah mengunggah video baru "PASAR PERSAINGAN SEMPURNA - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI"', '2025-02-01 08:54:55', 'unread'),
	(11, 10, 54, 'edcent id telah mengunggah video baru "PAJAK - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI"', '2025-02-01 08:55:13', 'unread');

DROP TABLE IF EXISTS `notifikasi_siswa`;
CREATE TABLE IF NOT EXISTS `notifikasi_siswa` (
  `notificationID_s` int NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `teacherID` int DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` datetime NOT NULL,
  `status` enum('unread','read') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'unread',
  PRIMARY KEY (`notificationID_s`),
  KEY `FK_notifikasi_siswa_siswa` (`studentID`),
  KEY `FK_notifikasi_siswa_guru` (`teacherID`),
  CONSTRAINT `FK_notifikasi_siswa_guru` FOREIGN KEY (`teacherID`) REFERENCES `guru` (`teacherID`),
  CONSTRAINT `FK_notifikasi_siswa_siswa` FOREIGN KEY (`studentID`) REFERENCES `siswa` (`studentID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `notifikasi_siswa`;
INSERT INTO `notifikasi_siswa` (`notificationID_s`, `studentID`, `teacherID`, `message`, `upload_date`, `status`) VALUES
	(1, 7, 1, 'test Siswa telah memfavoritkan video anda "Standard Deviation of Hawk Tuah"', '2025-01-26 21:38:13', 'unread'),
	(2, 7, 1, 'test Siswa telah memfavoritkan video anda "Understanding Machine Learning"', '2025-01-26 21:38:28', 'unread'),
	(3, 7, 1, 'test Siswa telah mengikuti anda', '2025-01-26 21:38:30', 'unread'),
	(4, 1, 8, 'MFarhadA telah memfavoritkan video anda "Integral Trigonometri Dasar, Substitusi & Menggunakan Identitas Trigonometri (Integral Part 6)"', '2025-02-01 05:59:32', 'unread'),
	(5, 1, 8, 'MFarhadA telah mengikuti anda', '2025-02-01 05:59:32', 'unread'),
	(6, 1, 9, 'MFarhadA telah mengikuti anda', '2025-02-01 08:44:27', 'unread'),
	(7, 1, 9, 'MFarhadA telah memfavoritkan video anda "Rangkuman Materi Bahasa Inggris SMA Kelas X Semester 1 (Semester Ganjil) - Irfan Suryana (720p, h264)"', '2025-02-01 08:44:27', 'unread'),
	(8, 1, 9, 'MFarhadA telah memfavoritkan video anda "Materi Bahasa Inggris Kelas X Semester 2 Bab 6 Fractured Story (Narrative Text)"', '2025-02-01 08:44:44', 'unread'),
	(9, 1, 10, 'MFarhadA telah mengikuti anda', '2025-02-01 08:56:31', 'unread'),
	(10, 1, 10, 'MFarhadA telah memfavoritkan video anda "PAJAK - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI"', '2025-02-01 08:56:31', 'unread'),
	(11, 1, 10, 'MFarhadA telah mengikuti anda', '2025-02-01 09:01:21', 'unread'),
	(12, 1, 1, 'MFarhadA telah mengikuti anda', '2025-02-01 09:01:38', 'unread'),
	(13, 1, NULL, 'MFarhadA telah memfavoritkan video anda "test"', '2025-02-01 09:01:46', 'unread'),
	(14, 1, 1, 'MFarhadA telah memfavoritkan video anda "test"', '2025-02-01 09:03:02', 'unread'),
	(15, 1, 1, 'MFarhadA telah mengikuti anda', '2025-02-01 11:27:18', 'unread'),
	(16, 1, 10, 'MFarhadA telah memfavoritkan video anda "PEMBAHASAN SOAL EKONOMI - MATERI PENDAPATAN NASIONAL - PERSIAPAN UTBK SBMPTN DAN SIMAK UI"', '2025-02-01 11:40:02', 'unread'),
	(17, 1, 9, 'MFarhadA telah memfavoritkan video anda "Congratulating Others  Mengucapkan Selamat kepada Orang Lain  Materi Bahasa Inggris SMA Kelas X"', '2025-02-01 11:40:41', 'unread');

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `studentID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `schoolID` (`userID`),
  KEY `userID` (`userID`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `siswa`;
INSERT INTO `siswa` (`studentID`, `userID`) VALUES
	(1, 1),
	(2, 9),
	(3, 10),
	(4, 11),
	(5, 12),
	(6, 13),
	(7, 15),
	(8, 18);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `user`;
INSERT INTO `user` (`userID`, `email`, `password`, `name`, `school`, `profile_photo`, `role`) VALUES
	(1, 'siswa@gmail.com', '2020', 'MFarhadA', 'Manbaul Huda', '/Study-Tube/db/profile_photo/6792e2a2348f3.jpg', 1),
	(2, 'guru', '2020', 'Guru Ajil', 'Manbaul Huda', '/Study-Tube/db/profile_photo/677bcefc7e164.jpg', 2),
	(3, 'sekolah', '2020', 'Manbaul Huda', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 3),
	(5, 'farhad.ajilla@gmail.com', '2020', 'Muhammad Farhad Ajilla', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 2),
	(6, 'sarah.annisa@yahoo.com', '2020', 'Sarah Annisa', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 2),
	(7, 'john.doe@example.com', '2020', 'John Doe', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 2),
	(8, 'jane.smith@outlook.com', '2020', 'Jane Smith Stone Johnson', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 2),
	(9, 'murid1@example.com', '2020', 'Murid Satu', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 1),
	(10, 'murid2@example.com', '2020', 'Murid Dua', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 1),
	(11, 'murid3@example.com', '2020', 'Murid Tiga', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 1),
	(12, 'murid4@example.com', '2020', 'Murid Empat', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 1),
	(13, 'murid5@example.com', '2020', 'Murid Lima', 'Manbaul Huda', '/Study-Tube/assets/foto_profil.png', 1),
	(14, 'gurug', '2020', 'test Guru', 'Manbaul Test', '/Study-Tube/assets/foto_profil.png', 2),
	(15, 'siswoo', '2020', 'test Siswa', 'Test Manbaul', '/Study-Tube/assets/foto_profil.png', 1),
	(16, 'm4th-lab@gmail.com', '2020', 'm4th-lab', 'UTB', '/Study-Tube/db/profile_photo/679d537189eb8.jpg', 2),
	(17, 'irfansuryana@gmail.com', '2020', 'Irfan Suryana', 'UTB', '/Study-Tube/db/profile_photo/679d7c00e4511.jpg', 2),
	(18, 'muridid@gmail.com', '2020', 'murid id', 'Test Test', '/Study-Tube/assets/foto_profil.png', 1),
	(19, 'edcentid@gmail.com', '2020', 'edcent id', 'UTB', '/Study-Tube/db/profile_photo/679d7e95ccae5.jpg', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `video`;
INSERT INTO `video` (`videoID`, `teacherID`, `video`, `thumbnail`, `title`, `views`, `upload_date`, `favorite`) VALUES
	(1, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'How to Learn Programming', 361, '2024-09-22 20:14:00', 0),
	(2, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', '10 Tips for Effective Studying test 2', 315, '2025-01-19 19:55:21', 1),
	(3, 1, '/Study-Tube/assets/video0.mp4', '/Study-Tube/assets/video_thumbnail0.jpg', 'Mastering Python in 30 Days', 762, '2024-12-17 20:14:00', 0),
	(16, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', 'test', 4, '2025-01-18 22:11:11', 1),
	(19, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737238271_image0.jpg', 'test file modul', 2, '2025-01-21 01:59:06', 1),
	(25, 1, '/Study-Tube/db/video/video_1737432964_Snapsave.app_-YOOcVvgfbV1_QzGG9hxNzcfkrMZ_RPW_.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737432964_1130469.png', 'Standard Deviation of Hawk Tuah', 2, '2025-01-21 04:16:04', 1),
	(39, 2, '/Study-Tube/db/video/video_1737575805_349145032_662634269011515_6425198523701700097_n.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737575805_FB_IMG_1690461040731.jpg', 'halo tuah', 2, '2025-01-22 19:56:45', 1),
	(43, 1, '/Study-Tube/db/video/video_1737676445_349145032_662634269011515_6425198523701700097_n.mp4', '/Study-Tube/db/thumbnail/thumbnail_1737676445_349362221_696151078986426_3921021623258311066_n.jpg', 'test notif', 2, '2025-01-23 23:54:05', 1),
	(44, 8, '/Study-Tube/db/video/video_1738363806_Matriks Matematika Wajib Kelas 11 Bagian 1 - Pengenalan Matriks - m4th-lab (480p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738363806_thumbnail.jpg', 'Matriks Matematika Wajib Kelas 11 Bagian 1 - Pengenalan Matriks', 0, '2025-02-01 05:50:06', 0),
	(45, 8, '/Study-Tube/db/video/video_1738363828_Transformasi Geometri Bagian 1 - Translasi (Pergeseran) Matematika Wajib Kelas 11 - m4th-lab (480p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738363828_thumbnail.jpg', 'Transformasi Geometri Bagian 1 - Translasi (Pergeseran) Matematika Wajib Kelas 11', 0, '2025-02-01 05:50:28', 0),
	(46, 8, '/Study-Tube/db/video/video_1738363845_Aplikasi Turunan 1  Gradien, Persamaan Garis Singgung dan Persamaan Garis Normal - m4th-lab (480p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738363845_thumbnail.jpg', 'Aplikasi Turunan 1  Gradien, Persamaan Garis Singgung dan Persamaan Garis Normal', 0, '2025-02-01 05:50:45', 0),
	(47, 8, '/Study-Tube/db/video/video_1738363875_Integral Trigonometri Dasar, Substitusi & Menggunakan Identitas Trigonometri (Integral Part 6) - m4th-lab (480p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738363875_thumbnail.jpg', 'Integral Trigonometri Dasar, Substitusi & Menggunakan Identitas Trigonometri (Integral Part 6)', 2, '2025-02-01 05:51:15', 1),
	(48, 8, '/Study-Tube/db/video/video_1738363888_Induksi Matematika Pembuktian Deret Bilangan - Matematika Wajib Kelas XI - m4th-lab (480p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738363888_thumbnail.jpg', 'Induksi Matematika Pembuktian Deret Bilangan - Matematika Wajib Kelas XI', 1, '2025-02-01 05:51:28', 0),
	(49, 9, '/Study-Tube/db/video/video_1738374219_Materi Bahasa Inggris Kelas X Semester 2 Bab 6 Fractured Story (Narrative Text) - Kurikulum Merdeka - Irfan Suryana (1080p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374219_thumbnail.jpg', 'Materi Bahasa Inggris Kelas X Semester 2 Bab 6 Fractured Story (Narrative Text)', 1, '2025-02-01 08:43:39', 1),
	(50, 9, '/Study-Tube/db/video/video_1738374242_Congratulating Others  Mengucapkan Selamat kepada Orang Lain  Materi Bahasa Inggris SMA Kelas X - Irfan Suryana (720p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374242_thumbnail.jpg', 'Congratulating Others  Mengucapkan Selamat kepada Orang Lain  Materi Bahasa Inggris SMA Kelas X', 1, '2025-02-01 08:44:02', 1),
	(51, 9, '/Study-Tube/db/video/video_1738374254_Rangkuman Materi Bahasa Inggris SMA Kelas X Semester 1 (Semester Ganjil) - Irfan Suryana (720p, h264).mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374254_thumbnail.jpg', 'Rangkuman Materi Bahasa Inggris SMA Kelas X Semester 1 (Semester Ganjil) - Irfan Suryana (720p, h264)', 2, '2025-02-01 08:44:14', 1),
	(52, 10, '/Study-Tube/db/video/video_1738374879_PEMBAHASAN SOAL EKONOMI - MATERI PENDAPATAN NASIONAL - PERSIAPAN UTBK SBMPTN DAN SIMAK UI.mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374879_thumbnail.jpeg', 'PEMBAHASAN SOAL EKONOMI - MATERI PENDAPATAN NASIONAL - PERSIAPAN UTBK SBMPTN DAN SIMAK UI', 1, '2025-02-01 04:39:25', 1),
	(53, 10, '/Study-Tube/db/video/video_1738374895_PASAR PERSAINGAN SEMPURNA - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI.mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374895_thumbnail.jpeg', 'PASAR PERSAINGAN SEMPURNA - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI', 0, '2025-02-01 08:54:55', 0),
	(54, 10, '/Study-Tube/db/video/video_1738374913_PAJAK - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI.mp4', '/Study-Tube/db/thumbnail/thumbnail_1738374913_thumbnail.jpeg', 'PAJAK - EKONOMI - MATERI UTBK SBMPTN DAN SIMAK UI', 2, '2025-02-01 08:55:13', 1);

DROP TRIGGER IF EXISTS `update_favorite_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `update_favorite_after_delete` AFTER DELETE ON `favorit` FOR EACH ROW BEGIN
    UPDATE video
    SET favorite = favorite - 1
    WHERE videoID = OLD.videoID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP TRIGGER IF EXISTS `update_favorite_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `update_favorite_after_insert` AFTER INSERT ON `favorit` FOR EACH ROW BEGIN
    UPDATE video
    SET favorite = favorite + 1
    WHERE videoID = NEW.videoID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP TRIGGER IF EXISTS `update_followers_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `update_followers_after_delete` AFTER DELETE ON `ikuti` FOR EACH ROW BEGIN
    UPDATE guru
    SET followers = (SELECT COUNT(*) FROM ikuti WHERE teacherID = OLD.teacherID)
    WHERE teacherID = OLD.teacherID;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP TRIGGER IF EXISTS `update_followers_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `update_followers_after_insert` AFTER INSERT ON `ikuti` FOR EACH ROW BEGIN
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
