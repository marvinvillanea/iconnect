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


-- Dumping database structure for iconnect
CREATE DATABASE IF NOT EXISTS `iconnect` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `iconnect`;

-- Dumping structure for table iconnect.tbl_accounts
CREATE TABLE IF NOT EXISTS `tbl_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `cnum` varchar(20) NOT NULL,
  `bday` date NOT NULL,
  `age` int NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int NOT NULL COMMENT 'admin=1 company=2 client=3',
  `verification_state` int NOT NULL DEFAULT '0' COMMENT '0 = not verified\r\n1 = semi verified\r\n2 = verified',
  `avatar` varchar(50) NOT NULL DEFAULT 'avatar_default.png',
  `department` varchar(50) NOT NULL DEFAULT 'none',
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `degree_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_year_attended` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `achievement` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_id` int DEFAULT '0' COMMENT '0 = not verified , 1 = verifed by admin',
  `prof_id_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_accounts: ~10 rows (approximately)
DELETE FROM `tbl_accounts`;
INSERT INTO `tbl_accounts` (`id`, `firstname`, `lastname`, `cnum`, `bday`, `age`, `address`, `email`, `password`, `type`, `verification_state`, `avatar`, `department`, `facebook`, `linkedin`, `instagram`, `degree_title`, `school_name`, `school_address`, `school_year_attended`, `achievement`, `created_at`, `updated_at`, `status_id`, `prof_id_image`) VALUES
	(6, 'admin', 'admin', '09093939708', '2001-08-30', 25, '739 G. Araneta Avenue 1100', 'admin@connect.com', '1234', 1, 0, 'avatar_default.png', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 10:15:03', '2022-12-14 20:58:16', 1, NULL),
	(7, 'company', 'company', '09093939705', '2022-09-10', 25, 'Rm. 202 Grace Building Ortigas Avenue Greenhills 1500', 'company@connect.com', '1234', 2, 0, 'avatar_default.png', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 10:33:47', '2022-12-13 05:35:53', 3, NULL),
	(8, 'client', 'client', '09486502742', '2002-02-22', 25, 'P. Burgos Street corner Caseres Street', 'client@connect.com', '1234', 3, 0, 'avatar_default.png', 'I.T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 10:34:28', '2022-12-13 05:37:09', 1, NULL),
	(9, 'client1', 'client1', '09755983121', '2002-02-22', 25, '#26 mBaguio First Hotel, Bonifacio Street', 'client1@connect.com', '1234', 3, 2, 'avatar_default.png', 'I.T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 10:34:28', '2022-12-13 05:37:42', 1, NULL),
	(10, '1', '1', '09093939708', '2022-09-15', 12, '12121', '1234@yahoo.com', '123456789', 2, 0, 'avatar_default.png', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-14 09:06:23', '2022-12-14 21:16:05', 1, NULL),
	(12, 'marvin', 'villanea', '09486502742', '2006-02-07', 21, 'Purok 2, Tibanga-Saray', 'marvinvillanea1@gmail.com', 'marvin123', 3, 2, 'avatar_default.png', 'I.T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-14 15:56:26', '2022-12-13 05:35:49', 0, NULL),
	(13, 'VILLANEA', 'MARVIN', '09755983121', '2022-02-13', 23, 'adfafdaf', 'courier@gmail.com', 'testing123', 2, 0, 'avatar_default.png', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-26 13:17:37', '2022-12-13 05:35:50', 0, NULL),
	(15, 'VILLANEA', 'MARVIN', '09755983121', '2022-11-09', 23, 'testing123', 'USDggcharot@gmail.com', 'USDggcharot', 3, 0, 'avatar_default.png', 'dasfadsfas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-26 13:58:03', '2022-12-13 05:35:50', 0, NULL),
	(17, 'VILLANEA', 'MARVIN', '09755983121', '2022-12-15', 23, 'testing123', 'admin1234444@connect.com', 'admin1234444', 2, 0, 'avatar_default.png', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-14 20:44:03', '2022-12-14 20:44:03', 0, '../../assets/images/196a00244e11a16ac6baa0ed52dbebe0.png'),
	(18, 'VILLANEA', 'MARVIN', '09755983121', '2022-12-30', 21, 'Purok 2, Tibanga-Saray', 'marvinvillanea122@gmail.com', 'marvinvillanea122', 3, 0, 'avatar_default.png', 'I.T', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'Bachelor Science Technoilogy', 'VILLANEA MARVIN', 'Purok 2, Ti', '2018-2555', '123', '2022-12-14 20:58:07', '2022-12-14 20:58:07', 0, '../../assets/images/afa7b57ffc6a29f78e684a8bb462ddab.png');

-- Dumping structure for table iconnect.tbl_applicants
CREATE TABLE IF NOT EXISTS `tbl_applicants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `companyid` int NOT NULL,
  `applicantsid` int NOT NULL,
  `jobid` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=pending\r\n2=hired\r\n3=decline',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_applicants: ~5 rows (approximately)
DELETE FROM `tbl_applicants`;
INSERT INTO `tbl_applicants` (`id`, `companyid`, `applicantsid`, `jobid`, `status`, `created_at`) VALUES
	(1, 4, 8, 3, 1, '2022-08-12 06:00:44'),
	(2, 4, 8, 3, 1, '2022-08-12 06:00:44'),
	(3, 5, 8, 3, 2, '2022-08-12 06:00:44'),
	(4, 5, 8, 3, 2, '2022-08-12 06:00:44'),
	(5, 4, 8, 3, 1, '2022-09-02 06:31:42'),
	(7, 5, 8, 2, 3, '2022-11-15 02:06:55'),
	(8, 5, 9, 2, 1, '2022-11-28 14:19:16'),
	(9, 5, 9, 14, 1, '2022-11-29 02:05:32');

-- Dumping structure for table iconnect.tbl_company
CREATE TABLE IF NOT EXISTS `tbl_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `c_logo` varchar(70) NOT NULL DEFAULT 'company_logo_default.png',
  `c_banner` varchar(70) NOT NULL DEFAULT 'company_banner_default.png',
  `c_name` varchar(50) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_cnum` varchar(20) NOT NULL,
  `c_position` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_company: ~6 rows (approximately)
DELETE FROM `tbl_company`;
INSERT INTO `tbl_company` (`id`, `userid`, `c_logo`, `c_banner`, `c_name`, `c_address`, `c_cnum`, `c_position`, `department`, `created_at`) VALUES
	(4, 6, 'company_logo_default.png', 'company_banner_default.png', 'D Devs', 'Manila, Metro Manila', '09093939708', 'I.T', 'I.T', '2022-08-03 10:15:03'),
	(5, 7, 'company_logo_default.png', 'company_banner_default.png', 'Fux Devs', 'Manila, Metro Manila', '09093939708', 'I.T', 'I.T', '2022-08-03 10:33:47'),
	(6, 8, 'company_logo_default.png', 'company_banner_default.png', 'Metro Ui', 'Manila, Metro Manila', '09093939708', 'Advertiser', 'I.T', '2022-08-03 10:34:28'),
	(7, 10, 'company_logo_default.png', 'company_banner_default.png', '12adasd', 'asdasd', '09093939708', 'asdasdas', 'try', '2022-09-14 09:06:23'),
	(8, 13, 'company_logo_default.png', 'company_banner_default.png', 'ggg', '2313123', '09755983121', 'afdasfads', 'dasfadsfas', '2022-11-26 13:17:37'),
	(9, 14, 'company_logo_default.png', 'company_banner_default.png', 'ggg', '2313123', '09755983121', 'ggg', '123', '2022-11-26 13:21:45'),
	(10, 17, 'company_logo_default.png', 'company_banner_default.png', 'ggg', '2313123', '09755983121', '23', '23', '2022-12-14 20:44:03');

-- Dumping structure for table iconnect.tbl_company_reports
CREATE TABLE IF NOT EXISTS `tbl_company_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `reported_by` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_company_reports: ~3 rows (approximately)
DELETE FROM `tbl_company_reports`;
INSERT INTO `tbl_company_reports` (`id`, `company_id`, `reported_by`, `message`, `created_at`) VALUES
	(1, 4, 8, 'Miss leading information', '2022-08-26 18:35:28'),
	(2, 4, 8, 'Miss leading information', '2022-08-26 18:35:28'),
	(3, 4, 8, 'asdasdsa', '2022-09-01 23:43:15');

-- Dumping structure for table iconnect.tbl_jobs
CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `j_name` varchar(50) NOT NULL,
  `j_age` int NOT NULL,
  `j_min` decimal(50,0) NOT NULL,
  `j_max` decimal(50,0) NOT NULL,
  `j_currency_symbol` varchar(1) NOT NULL,
  `j_description` text NOT NULL,
  `j_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_jobs: ~26 rows (approximately)
DELETE FROM `tbl_jobs`;
INSERT INTO `tbl_jobs` (`id`, `userid`, `j_name`, `j_age`, `j_min`, `j_max`, `j_currency_symbol`, `j_description`, `j_created_at`) VALUES
	(1, 7, 'I.T', 18, 15000, 200000, '₱', 'Solary', '2022-08-04 16:46:17'),
	(2, 7, 'Social Media Avertiser', 18, 10000, 200000, '₱', 'Solary', '2022-08-04 16:46:17'),
	(3, 6, 'Back End Developer', 18, 15000, 20000, '₱', '<p><strong>Bruh</strong></p>\r\n', '2022-08-11 21:22:23'),
	(4, 7, 'PHP Dev', 21, 15000, 30000, '₱', '<p>Hi</p>\r\n', '2022-09-14 10:23:22'),
	(5, 7, '1', 50, 1, 1, '₱', '<p>1</p>\r\n', '2022-09-14 10:24:26'),
	(6, 7, 'Marvin', 56, 2000, 3000, '₱', '<p>Helooo wafdafdsa</p>\r\n', '2022-11-28 16:48:40'),
	(7, 7, 'Marvin', 56, 2000, 3000, '₱', '<p>Helooo wafdafdsa</p>\r\n', '2022-11-28 16:48:44'),
	(8, 7, 'TESTIN', 24, 23333, 23333, '₱', '<p>DSAFADSFDASFASF</p>\r\n', '2022-11-28 17:05:43'),
	(9, 7, 'TESTIN', 24, 23333, 23333, '₱', '<p>HELO GOODMINRONG</p>\r\n', '2022-11-28 17:05:46'),
	(10, 7, 'TESTIN', 24, 23333, 23333, '₱', '<p>HELO GOODMINRONG</p>\r\n', '2022-11-28 17:05:51'),
	(11, 7, 'Web Developer', 130, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper</p>\r\n', '2022-11-28 17:07:26'),
	(12, 7, 'Web Developer', 130, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper.<br />\r\nTesting&nbsp;</p>\r\n', '2022-11-28 17:07:31'),
	(13, 7, 'Web Developer', 23, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper.<br />\r\nTesting&nbsp;</p>\r\n', '2022-11-28 17:07:41'),
	(14, 7, 'Web Developer', 23, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper.<br />\r\nTesting&nbsp;</p>\r\n', '2022-11-28 17:07:49'),
	(15, 7, 'Web Developer', 23, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper.<br />\r\nTesting&nbsp;</p>\r\n', '2022-11-28 17:07:50'),
	(16, 7, 'Web Developer', 32, 30000, 30000, '₱', '<p>Hello team good day, We&#39;re hiring a developer to create devveloper.<br />\r\nTesting&nbsp;</p>\r\n', '2022-11-28 17:08:11'),
	(17, 7, 'Marvin', 42, 30000, 30000, '₱', '<p>HRLLO WOLRD</p>\r\n', '2022-11-28 17:11:19'),
	(18, 7, 'Marvin', 42, 30000, 30000, '₱', '<p>HRLLO WOLRDDASFDASFDASF</p>\r\n', '2022-11-28 17:13:14'),
	(19, 7, 'Marvin3232', 39, 30000, 30000, '₱', '<p>HRLLO WOLRDDASFDASFDASF</p>\r\n', '2022-11-28 17:21:18'),
	(20, 7, 'PHP PROGRAMMER ', 39, 30000, 30000, '₱', '<p>HRLLO WOLRDDASFDASFDASF</p>\r\n', '2022-11-28 17:22:50'),
	(21, 7, 'Web Developer Testinggggffff', 24, 2222, 2222, '₱', '<p>2222</p>\r\n', '2022-11-28 18:18:25'),
	(22, 7, 'Web Developer', 23, 2333, 2333, '₱', 'dsafdsafdasfasdfdsaf', '2022-11-28 18:25:27'),
	(23, 7, 'Web Developer Testindsafdasfadsf', 21, 12313, 12313, '₱', '<p>1234</p>\r\n', '2022-11-28 18:26:31'),
	(24, 7, 'Web Developer TAE', 18, 5000, 50000, '₱', '<p>dsaf</p>\r\n', '2022-11-28 18:33:44'),
	(25, 7, 'TESTIN tae', 50, 50000, 49998, '₱', '<p>afdasfdasfdasf</p>\r\n', '2022-11-28 18:34:21'),
	(26, 7, 'Web Developer Testingggg TAEEEEE', 60, 5000, 50000, '₱', '<p>DFSAFDASFDSAFADSF</p>\r\n', '2022-11-28 18:34:55'),
	(27, 7, 'Web Developer Testingggg fsdgfdsgfsdg', 50, 50000, 50000, '₱', '<p>dsafdsafdasfas</p>\r\n', '2022-11-28 18:35:22');

-- Dumping structure for table iconnect.tbl_notification
CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_notification: ~45 rows (approximately)
DELETE FROM `tbl_notification`;
INSERT INTO `tbl_notification` (`id`, `user_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 3, 'You`re hired, Hello $fullname, We see your resume and you have good potential for this kind of job $job_name , Please contact us on $company_cnum. - $company_name.', 0, '2022-11-14 15:05:23', '2022-11-14 15:05:23'),
	(2, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:07:13', '2022-11-14 15:07:13'),
	(3, 3, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:07:36', '2022-11-14 15:07:36'),
	(4, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:08:23', '2022-11-14 15:08:23'),
	(5, 3, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:08:44', '2022-11-14 15:08:44'),
	(6, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:08:53', '2022-11-14 15:08:53'),
	(7, 3, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:11:49', '2022-11-14 15:11:49'),
	(8, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:12:23', '2022-11-14 15:12:23'),
	(9, 3, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:14:03', '2022-11-14 15:14:03'),
	(10, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:14:13', '2022-11-14 15:14:13'),
	(11, 3, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:15:09', '2022-11-14 15:15:09'),
	(12, 3, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-14 15:15:19', '2022-11-14 15:15:19'),
	(13, 8, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-14 15:17:34', '2022-11-15 01:50:22'),
	(14, 8, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 1, '2022-11-14 15:17:41', '2022-11-15 01:53:06'),
	(15, 8, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 1, '2022-11-14 15:24:44', '2022-11-15 01:52:58'),
	(16, 8, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 1, '2022-11-14 15:24:54', '2022-11-15 01:52:26'),
	(17, 8, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 1, '2022-11-14 15:27:14', '2022-11-15 01:52:19'),
	(18, 8, 'Hello client client, Your application for this position Back End Developer was declined - Fux Devs.', 0, '2022-11-15 01:54:19', '2022-11-15 01:54:19'),
	(19, 8, 'You`re hired, Hello client client, We see your resume and you have good potential for this kind of job Back End Developer , Please contact us on 09093939708. - Fux Devs.', 0, '2022-11-15 01:54:23', '2022-11-15 01:54:23'),
	(20, 7, 'Company, Company, Applying for  Social Media Avertiser', 1, '2022-11-15 02:06:55', '2022-11-16 15:55:45'),
	(21, 8, 'Hello client client, Your application for this position Social Media Avertiser was declined - Fux Devs.', 1, '2022-11-16 15:56:01', '2022-11-16 15:58:16'),
	(22, 7, 'Company, Company, Applying for  Social Media Avertiser', 0, '2022-11-28 14:19:16', '2022-11-28 14:19:16'),
	(23, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job TESTIN.', 0, '2022-11-28 17:05:43', '2022-11-28 17:05:43'),
	(24, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job TESTIN.', 0, '2022-11-28 17:05:46', '2022-11-28 17:05:46'),
	(25, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job TESTIN.', 0, '2022-11-28 17:05:51', '2022-11-28 17:05:51'),
	(26, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:07:26', '2022-11-28 17:07:26'),
	(27, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:07:31', '2022-11-28 17:07:31'),
	(28, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:07:41', '2022-11-28 17:07:41'),
	(29, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:07:49', '2022-11-28 17:07:49'),
	(30, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:07:50', '2022-11-28 17:07:50'),
	(31, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 17:08:11', '2022-11-28 17:08:11'),
	(32, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Marvin.', 0, '2022-11-28 17:11:19', '2022-11-28 17:11:19'),
	(33, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Marvin.', 0, '2022-11-28 17:13:14', '2022-11-28 17:13:14'),
	(34, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Marvin3232.', 0, '2022-11-28 17:21:18', '2022-11-28 17:21:18'),
	(35, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job PHP PROGRAMMER .', 0, '2022-11-28 17:22:50', '2022-11-28 17:22:50'),
	(36, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job PHP PROGRAMMER .', 0, '2022-11-28 17:22:51', '2022-11-28 17:22:51'),
	(37, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testinggggffff.', 0, '2022-11-28 18:18:25', '2022-11-28 18:18:25'),
	(38, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testinggggffff.', 0, '2022-11-28 18:18:26', '2022-11-28 18:18:26'),
	(39, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.', 0, '2022-11-28 18:25:27', '2022-11-28 18:25:27'),
	(40, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer.', 0, '2022-11-28 18:25:27', '2022-11-28 18:25:27'),
	(41, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testindsafdasfadsf.', 0, '2022-11-28 18:26:31', '2022-11-28 18:26:31'),
	(42, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testindsafdasfadsf.', 0, '2022-11-28 18:26:31', '2022-11-28 18:26:31'),
	(43, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer TAE.', 0, '2022-11-28 18:33:44', '2022-11-28 18:33:44'),
	(44, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer TAE.', 0, '2022-11-28 18:33:44', '2022-11-28 18:33:44'),
	(45, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job TESTIN tae.', 0, '2022-11-28 18:34:21', '2022-11-28 18:34:21'),
	(46, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job TESTIN tae.', 0, '2022-11-28 18:34:22', '2022-11-28 18:34:22'),
	(47, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testingggg TAEEEEE.', 0, '2022-11-28 18:34:55', '2022-11-28 18:34:55'),
	(48, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testingggg TAEEEEE.', 0, '2022-11-28 18:34:55', '2022-11-28 18:34:55'),
	(49, 9, 'LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testingggg fsdgfdsgfsdg.', 0, '2022-11-28 18:35:22', '2022-11-28 18:35:22'),
	(50, 12, 'LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testingggg fsdgfdsgfsdg.', 0, '2022-11-28 18:35:22', '2022-11-28 18:35:22'),
	(51, 7, 'Company, Company, Applying for  Web Developer', 1, '2022-11-29 02:05:32', '2022-11-29 02:05:41');

-- Dumping structure for table iconnect.tbl_resume
CREATE TABLE IF NOT EXISTS `tbl_resume` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `path` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_resume: ~5 rows (approximately)
DELETE FROM `tbl_resume`;
INSERT INTO `tbl_resume` (`id`, `userid`, `path`, `created_at`) VALUES
	(1, 6, 'example1.png', '2022-08-11 22:35:51'),
	(2, 7, 'example4.png', '2022-08-11 22:35:51'),
	(3, 8, 'example4.png', '2022-09-01 21:34:59'),
	(4, 9, '45c48cce2e2d7fbdea1afc51c7c6ad26.jpg', '2022-11-14 14:33:18'),
	(5, 12, 'example5.jpeg', '2022-11-14 15:58:45');

-- Dumping structure for table iconnect.tbl_sms_logs
CREATE TABLE IF NOT EXISTS `tbl_sms_logs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `receiverid` bigint NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_sms_logs: ~29 rows (approximately)
DELETE FROM `tbl_sms_logs`;
INSERT INTO `tbl_sms_logs` (`id`, `receiverid`, `message`, `created_at`) VALUES
	(69, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job PHP PROGRAMMER .","to":"+6309755983121"}', '2022-11-28 17:22:50'),
	(70, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 17:22:51'),
	(71, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job PHP PROGRAMMER .","to":"+6309486502742"}', '2022-11-28 17:22:51'),
	(72, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 17:22:52'),
	(73, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testinggggffff.","to":"+6309755983121"}', '2022-11-28 18:18:25'),
	(74, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:18:26'),
	(75, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testinggggffff.","to":"+6309486502742"}', '2022-11-28 18:18:26'),
	(76, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:18:26'),
	(77, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer.","to":"+6309755983121"}', '2022-11-28 18:25:27'),
	(78, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:25:27'),
	(79, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer.","to":"+6309486502742"}', '2022-11-28 18:25:27'),
	(80, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:25:28'),
	(81, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testindsafdasfadsf.","to":"+6309755983121"}', '2022-11-28 18:26:31'),
	(82, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:26:31'),
	(83, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testindsafdasfadsf.","to":"+6309486502742"}', '2022-11-28 18:26:31'),
	(84, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:26:31'),
	(85, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer TAE.","to":"+6309755983121"}', '2022-11-28 18:33:44'),
	(86, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:33:44'),
	(87, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer TAE.","to":"+6309486502742"}', '2022-11-28 18:33:45'),
	(88, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:33:45'),
	(89, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job TESTIN tae.","to":"+6309755983121"}', '2022-11-28 18:34:21'),
	(90, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:34:21'),
	(91, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job TESTIN tae.","to":"+6309486502742"}', '2022-11-28 18:34:22'),
	(92, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:34:22'),
	(93, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testingggg TAEEEEE.","to":"+6309755983121"}', '2022-11-28 18:34:55'),
	(94, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:34:55'),
	(95, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testingggg TAEEEEE.","to":"+6309486502742"}', '2022-11-28 18:34:55'),
	(96, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:34:56'),
	(97, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello client1, Fux Devs has new open job Web Developer Testingggg fsdgfdsgfsdg.","to":"+6309755983121"}', '2022-11-28 18:35:22'),
	(98, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:35:22'),
	(99, 12, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"LocalMJob \n Hello marvin, Fux Devs has new open job Web Developer Testingggg fsdgfdsgfsdg.","to":"+6309486502742"}', '2022-11-28 18:35:22'),
	(100, 12, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-11-28 18:35:22'),
	(101, 9, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"Hi Client1 Your Account has been Decline by the Administrator.","to":"+6309755983121"}', '2022-12-13 05:37:42'),
	(102, 9, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-12-13 05:37:43'),
	(103, 10, '{"api_key":"2H7GtWOeyWYMff0XzK7en5zEdy6","api_secret":"m0hv1Nw4C0949gsL9RGVRIp75QomqWsLqD5fjpjB","from":"iConnect","text":"Hi 1 Your Account has been Accepted by the Administrator.","to":"+6309093939708"}', '2022-12-14 21:16:05'),
	(104, 10, 'Client error: `POST https://api.movider.co/v1/sms` resulted in a `401 Unauthorized` response:\n{"error":{"code":403,"name":"ERR_AUTHENTICATION_FAILED","description":"Authentication field."}}\n', '2022-12-14 21:16:06');

-- Dumping structure for table iconnect.tbl_verificationcode
CREATE TABLE IF NOT EXISTS `tbl_verificationcode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=not used\r\n1=used',
  `used_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iconnect.tbl_verificationcode: ~4 rows (approximately)
DELETE FROM `tbl_verificationcode`;
INSERT INTO `tbl_verificationcode` (`id`, `session`, `code`, `status`, `used_at`, `created_at`) VALUES
	(17, 'dd3d05d7de99af7a376db3aaf6a18dba', '484709', 1, '2022-09-01 21:34:41', '2022-09-01 21:33:54'),
	(19, '5nRJwCgt95yfmq9qXlB1lv16683973682073', NULL, 0, '2022-11-14 03:42:48', '2022-11-14 03:42:48'),
	(20, '5nRJwCgt95yfmq9qXly1SB16684344287422', NULL, 0, '2022-11-14 14:00:30', '2022-11-14 14:00:30'),
	(21, '5nRJwCgt95yfmq9qXlyjW216684349778122', NULL, 1, '2022-11-14 14:10:35', '2022-11-14 14:09:38'),
	(22, '5nRJwCgt95yfmq9qXm69fL16684414075689', NULL, 1, '2022-11-14 15:57:12', '2022-11-14 15:56:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
