# --------------------------------------------------------
# Host:                         zilore01.mysql.ukraine.com.ua
# Server version:               5.1.69-cll-lve
# Server OS:                    redhat-linux-gnu
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-08-28 16:42:31
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table zilore01_school2.activation_codes
DROP TABLE IF EXISTS `activation_codes`;
CREATE TABLE IF NOT EXISTS `activation_codes` (
  `code` varchar(32) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_data` text,
  KEY `Index 1` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.activation_codes: ~53 rows (approximately)
DELETE FROM `activation_codes`;
/*!40000 ALTER TABLE `activation_codes` DISABLE KEYS */;
INSERT INTO `activation_codes` (`code`, `type`, `user_data`) VALUES
	('6fc36ec1780b65a32340545e770a880f', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('0a0c1b9a73c6a98470a3380cbe9c19b2', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('2437b926c7787408c5de92a33c8b4185', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('963a5e718d939202b3469e04bf5ccaa5', 'invitation', 'a:2:{s:2:"id";s:1:"1";s:4:"type";s:6:"parent";}'),
	('df39392578eb9f14d50116dad79a0214', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('709a13b1b362561302106940eabdd8b3', 'invitation', 'a:2:{s:2:"id";s:1:"1";s:4:"type";s:6:"parent";}'),
	('67a8917f099352e0b2dbdc561f9db2c3', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('bb1d5f0eea762ec3b3103908ce62419f', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:6:"parent";}'),
	('8b9e6a0f7ba1c08b4387cab11ca0ebbd', 'invitation', 'a:2:{s:2:"id";s:2:"31";s:4:"type";s:7:"student";}'),
	('8d09f8d39888ec1407a6152b30cdc2cd', 'invitation', 'a:2:{s:2:"id";i:31;s:4:"type";s:7:"student";}'),
	('fc573d842a4ef721cb0a5eb1f4bf9a5a', 'invitation', 'a:2:{s:2:"id";i:3;s:4:"type";s:7:"student";}'),
	('d080a1c6f705121cda9e1e426e84276c', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:7:"teacher";}'),
	('d1850ba9670bc45c03ecef6d78bf9ead', 'invitation', 'a:2:{s:2:"id";s:1:"1";s:4:"type";s:7:"teacher";}'),
	('b5e460b85c6be5faaf7f1cec7baa7723', 'invitation', 'a:2:{s:2:"id";s:1:"1";s:4:"type";s:7:"teacher";}'),
	('e4fdc45b3dbc8f4b24de426d6f5d51ac', 'invitation', 'a:2:{s:2:"id";i:2;s:4:"type";s:7:"teacher";}'),
	('232af5a1533b79cfef2c1bb324143b08', 'invitation', 'a:2:{s:2:"id";s:1:"2";s:4:"type";s:7:"teacher";}'),
	('6b3d158284a7091d3e42e9aa5d32b6ad', 'invitation', 'a:2:{s:2:"id";i:4;s:4:"type";s:7:"student";}'),
	('d5e367c4f85e5ec98ef387cd96a205ac', 'invitation', 'a:2:{s:2:"id";i:33;s:4:"type";s:7:"student";}'),
	('ac3b18c5dc7c94309d5f26bd3d959009', 'invitation', 'a:2:{s:2:"id";i:34;s:4:"type";s:7:"student";}'),
	('34118a0045bd8a242bf1e9ad79c2a796', 'invitation', 'a:2:{s:2:"id";i:35;s:4:"type";s:7:"student";}'),
	('898340473a6a15fbf344580f91903ca5', 'invitation', 'a:2:{s:2:"id";i:31;s:4:"type";s:7:"teacher";}'),
	('9c0e7277008e10a072e6d3e1ce752b3c', 'invitation', 'a:2:{s:2:"id";i:37;s:4:"type";s:7:"student";}'),
	('feb7f572d37dcfe655e4dd657c70ccc4', 'invitation', 'a:2:{s:2:"id";i:38;s:4:"type";s:7:"student";}'),
	('064a2ed7adebabdedcb141275121dfa7', 'invitation', 'a:2:{s:2:"id";i:39;s:4:"type";s:7:"student";}'),
	('656c0542db72ec60a120bfbf1352696d', 'invitation', 'a:2:{s:2:"id";i:40;s:4:"type";s:7:"student";}'),
	('038e93e678578d76f223ac9a6e3f974e', 'invitation', 'a:2:{s:2:"id";i:41;s:4:"type";s:7:"student";}'),
	('3b8dadb9cd4ffa3696605c8762185dfe', 'invitation', 'a:2:{s:2:"id";i:42;s:4:"type";s:7:"student";}'),
	('8ef40bc0696a897c1fb1bfa6615446e2', 'invitation', 'a:2:{s:2:"id";i:43;s:4:"type";s:7:"student";}'),
	('9d93ac5f4c7e72287eb41dbb864f7b28', 'invitation', 'a:2:{s:2:"id";i:44;s:4:"type";s:7:"student";}'),
	('75d98edae49b8da12b1ecc9ed78853db', 'invitation', 'a:2:{s:2:"id";i:45;s:4:"type";s:7:"student";}'),
	('7afd6c0b8f46520ba2fa7af94ff16a26', 'invitation', 'a:2:{s:2:"id";i:46;s:4:"type";s:7:"student";}'),
	('28e40d324fdaaf01939510853d2f6293', 'invitation', 'a:2:{s:2:"id";i:47;s:4:"type";s:7:"student";}'),
	('626f1e079c2a1210e76968b5554a2544', 'invitation', 'a:2:{s:2:"id";i:48;s:4:"type";s:7:"student";}'),
	('d531508b8458200fb59b1d02a8505e4d', 'invitation', 'a:2:{s:2:"id";i:49;s:4:"type";s:7:"student";}'),
	('01c920a73f9a9bd54f9fee925cb0194a', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:5:"donor";}'),
	('b8bd3981d2572536b9a933be660d79ec', 'invitation', 'a:2:{s:2:"id";i:2;s:4:"type";s:5:"donor";}'),
	('03071bfda3a4803d44ce170458abf73c', 'invitation', 'a:2:{s:2:"id";i:3;s:4:"type";s:5:"donor";}'),
	('73b5470faaefacc8562db44cc3a43992', 'invitation', 'a:2:{s:2:"id";i:4;s:4:"type";s:5:"donor";}'),
	('88d9860e1faccede07ee5543593ebf5b', 'invitation', 'a:2:{s:2:"id";i:5;s:4:"type";s:5:"donor";}'),
	('3ccf4ab7a61e8a22d6c3a0a61d655874', 'invitation', 'a:2:{s:2:"id";i:6;s:4:"type";s:5:"donor";}'),
	('bd01ac964497379488bf59c9a19b86dd', 'invitation', 'a:2:{s:2:"id";i:6;s:4:"type";s:5:"donor";}'),
	('ef48d113608684e446bbfc83f4ca542f', 'invitation', 'a:2:{s:2:"id";i:7;s:4:"type";s:5:"donor";}'),
	('2bd5fc937e41da420a9d72a241647c85', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:5:"donor";}'),
	('99f09e0f019f93bcd6ba4f772c4727d5', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:5:"donor";}'),
	('e7998f932ee5874193b0db866938aa8d', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:5:"donor";}'),
	('7318797d61d88756feb4d42083a7afe3', 'invitation', 'a:2:{s:2:"id";s:1:"1";s:4:"type";s:5:"donor";}'),
	('9479b00b8718eadf77ce9c1d8bcfa510', 'invitation', 'a:2:{s:2:"id";i:50;s:4:"type";s:7:"student";}'),
	('36b71c72eaf01719d4216efcc779ea53', 'invitation', 'a:2:{s:2:"id";i:57;s:4:"type";s:6:"parent";}'),
	('a26bb06e91b75c1da03cb33c7b8dd7ed', 'invitation', 'a:2:{s:2:"id";i:48;s:4:"type";s:7:"student";}'),
	('f4e0851fee8fd0af8c22d58904cfa413', 'invitation', 'a:2:{s:2:"id";i:32;s:4:"type";s:7:"teacher";}'),
	('4d91b1d93bc239e1693f9fd12fc2c765', 'invitation', 'a:2:{s:2:"id";i:2;s:4:"type";s:5:"donor";}'),
	('325d7e5a1076800d403d12113c1113b8', 'invitation', 'a:2:{s:2:"id";i:1;s:4:"type";s:5:"donor";}'),
	('f7795525549fe8cd178a304c21c71d40', 'invitation', 'a:2:{s:2:"id";i:52;s:4:"type";s:7:"student";}');
/*!40000 ALTER TABLE `activation_codes` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) DEFAULT NULL,
  `admin_login` varchar(50) DEFAULT NULL,
  `admin_password` varchar(300) DEFAULT NULL,
  `admin_salt` varchar(40) DEFAULT NULL,
  `admin_permissions` text,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.admins: ~3 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_login`, `admin_password`, `admin_salt`, `admin_permissions`) VALUES
	(1, 'Admin', 'admin', '9f5308766f84cf8ac112257823930dc33005c6e7bf54e01745ef297b593771f8c45e9161292cb7c0787412976aefe045d9adcf9ceb8d9b40fbc0387dc51f3d48', '545890195606954', 'a:1:{s:12:"global_admin";b:1;}'),
	(4, 'mike', 'mike', 'a299a0eef0a91697afda1442fcd817a6fd838889490922a1aa2f23349094ba26ab624d893ea27e9c19fa1a123e9b099c1a6178a22fff9017c76205fc78601e21', 'f5df613d3dc0c67', 'a:3:{s:5:"admin";b:1;s:13:"registrations";b:1;s:8:"students";b:1;}'),
	(5, 'test', 'test', '389b0a2f1e61971e981a7965e604f55a2a696ec38eb2d2f0256691a22e248cfcabdcd9e1286c25119f5b7c49a575b4a737f67503f3afdd72d9cdc3d1576fe4bc', 'fbd97551f782c13', 'a:7:{s:5:"admin";b:1;s:6:"import";b:1;s:15:"messages_center";b:1;s:4:"fees";b:1;s:13:"registrations";b:1;s:8:"students";b:1;s:5:"users";b:1;}');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.attendance
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `lesson_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `comment` varchar(450) DEFAULT NULL,
  `private_comment` varchar(450) DEFAULT NULL,
  `added` datetime DEFAULT NULL,
  `added_by` int(10) unsigned DEFAULT '0',
  UNIQUE KEY `Index 3` (`lesson_id`,`student_id`),
  KEY `Index 2` (`student_id`),
  KEY `Index 1` (`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.attendance: ~4 rows (approximately)
DELETE FROM `attendance`;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` (`lesson_id`, `student_id`, `status`, `comment`, `private_comment`, `added`, `added_by`) VALUES
	(21, 25, 3, NULL, NULL, NULL, 0),
	(21, 1, 2, NULL, NULL, NULL, 0),
	(21, 17, 3, NULL, NULL, NULL, 0),
	(21, 22, 4, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.classrooms
DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `room_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `is_shared` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.classrooms: ~14 rows (approximately)
DELETE FROM `classrooms`;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT INTO `classrooms` (`room_id`, `name`, `is_deleted`, `is_shared`) VALUES
	(1, 'Classroom #1', 1, 0),
	(2, 'Classroom #2', 0, 1),
	(3, 'Classroom #3', 0, 0),
	(4, 'Classroom #4', 0, 0),
	(5, 'Classroom #5', 0, 0),
	(6, 'Classroom #6', 0, 0),
	(7, 'Classroom #7', 0, 0),
	(8, 'Classroom #8', 0, 0),
	(9, 'Classroom #9', 0, 0),
	(10, 'Classroom #10', 0, 0),
	(11, 'Shared', 0, 1),
	(12, 'test', 1, 0),
	(13, 'new', 1, 0),
	(14, 'Classroom #1', 0, 0);
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.cron_tasks
DROP TABLE IF EXISTS `cron_tasks`;
CREATE TABLE IF NOT EXISTS `cron_tasks` (
  `task_name` varchar(50) DEFAULT NULL,
  `last_run` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.cron_tasks: ~3 rows (approximately)
DELETE FROM `cron_tasks`;
/*!40000 ALTER TABLE `cron_tasks` DISABLE KEYS */;
INSERT INTO `cron_tasks` (`task_name`, `last_run`) VALUES
	('send_notificaitions', '2013-07-25 17:02:41'),
	('send_emails', '2013-07-25 17:03:12'),
	('check_payments', '2013-07-25 17:02:40');
/*!40000 ALTER TABLE `cron_tasks` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.donated
DROP TABLE IF EXISTS `donated`;
CREATE TABLE IF NOT EXISTS `donated` (
  `donate_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `donor_id` int(10) unsigned DEFAULT '0',
  `student_id` int(10) unsigned DEFAULT '0',
  `amount` float DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `fee_id` mediumint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`donate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.donated: ~9 rows (approximately)
DELETE FROM `donated`;
/*!40000 ALTER TABLE `donated` DISABLE KEYS */;
INSERT INTO `donated` (`donate_id`, `donor_id`, `student_id`, `amount`, `date`, `fee_id`) VALUES
	(1, 1, 10, 50, '2013-07-31 23:51:25', 1),
	(2, 1, 12, 10, '2013-07-31 23:51:31', 2),
	(3, 1, 3, 1, '2013-07-31 23:55:03', 3),
	(8, 1, 32, 20, '2013-08-02 11:35:06', 4),
	(9, 2, 32, 20, '2013-08-02 11:35:06', 4),
	(10, 1, 32, 64.2, '2013-08-02 11:35:42', 2),
	(11, 2, 32, 64.2, '2013-08-02 11:35:42', 2),
	(12, 1, 32, 0.4, '2013-08-02 11:36:41', 3),
	(13, 2, 32, 0.4, '2013-08-02 11:36:41', 3);
/*!40000 ALTER TABLE `donated` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.donations
DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `donation_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `donor_id` int(10) unsigned DEFAULT '0',
  `donation` float unsigned DEFAULT '0',
  `donation_date` date DEFAULT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `is_paid` tinyint(3) unsigned DEFAULT '0',
  `comment` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `Index 2` (`donor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.donations: ~15 rows (approximately)
DELETE FROM `donations`;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
INSERT INTO `donations` (`donation_id`, `donor_id`, `donation`, `donation_date`, `transaction_id`, `is_paid`, `comment`) VALUES
	(1, 1, 100, '2013-08-01', 0, 1, 'Test'),
	(2, 1, 200, '2013-08-01', 2, 1, NULL),
	(14, 1, 100, '2013-08-01', 78, 0, NULL),
	(15, 1, 100, '2013-08-01', 79, 0, NULL),
	(16, 1, 200, '2013-08-01', 80, 0, NULL),
	(17, 1, 300, '2013-08-01', 81, 0, NULL),
	(18, 1, 200, '2013-08-01', 82, 0, NULL),
	(19, 1, 100, '2013-08-01', NULL, 1, '12'),
	(20, 1, 100, '2013-08-01', NULL, 1, '12'),
	(21, 1, 100, '2013-08-01', NULL, 1, '12'),
	(22, 2, 5000, '2013-08-03', NULL, 1, ''),
	(23, 2, 50000, '2013-08-03', NULL, 1, ''),
	(24, 2, 50, '2013-08-07', NULL, 1, 'This is test....'),
	(25, 1, 5000, '2013-08-07', NULL, 1, ''),
	(26, 1, 50, '2013-08-11', NULL, 1, 'I am not active but I can do payments..... wao.........');
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.donors
DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `donor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `ssn` varchar(20) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `cell_phone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `status` enum('Active','Inactive','Deleted') DEFAULT 'Inactive',
  `avatar` varchar(100) DEFAULT 'images/no_avatar.jpg',
  `donations` float DEFAULT '0',
  `donated` float DEFAULT '0',
  PRIMARY KEY (`donor_id`),
  KEY `Index 2` (`status`),
  KEY `Index 3` (`name`,`ssn`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.donors: ~2 rows (approximately)
DELETE FROM `donors`;
/*!40000 ALTER TABLE `donors` DISABLE KEYS */;
INSERT INTO `donors` (`donor_id`, `name`, `birth_date`, `gender`, `ssn`, `address`, `city`, `state`, `zip_code`, `home_phone`, `cell_phone`, `email`, `status`, `avatar`, `donations`, `donated`) VALUES
	(1, 'Test', '2014-06-09', 'male', 'e3', '', '', '', '', '', '', 'donor@zilorent.com', 'Inactive', 'avatars/7c82d46e21b61e490d094aafde938383.jpg', 5050, 0),
	(2, 'Test2', NULL, 'male', '', '', '', '', '', '', '', 'pardeep@therootsint.com', 'Inactive', 'images/no_avatar.jpg', 55650, 84.6);
/*!40000 ALTER TABLE `donors` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.emails
DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipient` varchar(100) DEFAULT NULL,
  `subject` varchar(400) DEFAULT NULL,
  `message` text,
  `busy_by` smallint(5) unsigned DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.emails: ~20 rows (approximately)
DELETE FROM `emails`;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` (`message_id`, `recipient`, `subject`, `message`, `busy_by`) VALUES
	(3, 'SamuelM.Molloy@zilorent.com', 'Inivation to join "Test"', 'Hello Samuel M. Molloy,<br><br>You was invited to join "Test" as a student.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/feb7f572d37dcfe655e4dd657c70ccc4" target="_blank">http://localhost/school/start/accept_invite/feb7f572d37dcfe655e4dd657c70ccc4</a>.<br><br>Test<br>', 0),
	(4, 'fsdgh@adfg.ru', 'Inivation to join "High School Math Science and Engineering at CCNY"', '', 0),
	(5, 'fsdgh@adfg.ru', 'Inivation to join "High School Math Science and Engineering at CCNY"', '', 0),
	(6, 'fsdgh@adfg.ru', 'Inivation to join "High School Math Science and Engineering at CCNY"', '', 0),
	(7, 'fsdgh@adfg.ru', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello dshg,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/73b5470faaefacc8562db44cc3a43992" target="_blank">http://localhost/school/start/accept_invite/73b5470faaefacc8562db44cc3a43992</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(8, 'sdfghf@wert.tu', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello sfgh,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/88d9860e1faccede07ee5543593ebf5b" target="_blank">http://localhost/school/start/accept_invite/88d9860e1faccede07ee5543593ebf5b</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(9, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello daf,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/3ccf4ab7a61e8a22d6c3a0a61d655874" target="_blank">http://localhost/school/start/accept_invite/3ccf4ab7a61e8a22d6c3a0a61d655874</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(10, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello daf2,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/bd01ac964497379488bf59c9a19b86dd" target="_blank">http://localhost/school/start/accept_invite/bd01ac964497379488bf59c9a19b86dd</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(11, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello sdfgh,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/ef48d113608684e446bbfc83f4ca542f" target="_blank">http://localhost/school/start/accept_invite/ef48d113608684e446bbfc83f4ca542f</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(12, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/2bd5fc937e41da420a9d72a241647c85" target="_blank">http://localhost/school/start/accept_invite/2bd5fc937e41da420a9d72a241647c85</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(13, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/99f09e0f019f93bcd6ba4f772c4727d5" target="_blank">http://localhost/school/start/accept_invite/99f09e0f019f93bcd6ba4f772c4727d5</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(14, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/e7998f932ee5874193b0db866938aa8d" target="_blank">http://localhost/school/start/accept_invite/e7998f932ee5874193b0db866938aa8d</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(15, 'ishevchuk@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/7318797d61d88756feb4d42083a7afe3" target="_blank">http://localhost/school/start/accept_invite/7318797d61d88756feb4d42083a7afe3</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(16, 'sdfgh@df.ey', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello dfgh,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a student.<br><br>To accept invitation follow this link: <a href="http://localhost/school/start/accept_invite/9479b00b8718eadf77ce9c1d8bcfa510" target="_blank">http://localhost/school/start/accept_invite/9479b00b8718eadf77ce9c1d8bcfa510</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(17, 'test@test.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a parent.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/36b71c72eaf01719d4216efcc779ea53" target="_blank">http://dev.zilorent.com/school/start/accept_invite/36b71c72eaf01719d4216efcc779ea53</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(18, 'SamuelM.Molloy@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Samuel M. Molloy,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a student.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/a26bb06e91b75c1da03cb33c7b8dd7ed" target="_blank">http://dev.zilorent.com/school/start/accept_invite/a26bb06e91b75c1da03cb33c7b8dd7ed</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(19, 'pardeep@therootsint.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a teacher.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/f4e0851fee8fd0af8c22d58904cfa413" target="_blank">http://dev.zilorent.com/school/start/accept_invite/f4e0851fee8fd0af8c22d58904cfa413</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(20, 'pardeep@therootsint.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test2,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/4d91b1d93bc239e1693f9fd12fc2c765" target="_blank">http://dev.zilorent.com/school/start/accept_invite/4d91b1d93bc239e1693f9fd12fc2c765</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(21, 'donor@zilorent.com', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello Test,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a donor.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/325d7e5a1076800d403d12113c1113b8" target="_blank">http://dev.zilorent.com/school/start/accept_invite/325d7e5a1076800d403d12113c1113b8</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0),
	(22, 'dsfh222@dfgh.rt', 'Inivation to join "High School Math Science and Engineering at CCNY"', 'Hello sdh,<br><br>You was invited to join "High School Math Science and Engineering at CCNY" as a student.<br><br>To accept invitation follow this link: <a href="http://dev.zilorent.com/school/start/accept_invite/f7795525549fe8cd178a304c21c71d40" target="_blank">http://dev.zilorent.com/school/start/accept_invite/f7795525549fe8cd178a304c21c71d40</a>.<br><br>High School Math Science and Engineering at CCNY<br>', 0);
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.email_templates
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `template_id` varchar(30) NOT NULL,
  `template_name` varchar(100) DEFAULT NULL,
  `template_content` text,
  `template_fields` text,
  KEY `Index 1` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.email_templates: ~4 rows (approximately)
DELETE FROM `email_templates`;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` (`template_id`, `template_name`, `template_content`, `template_fields`) VALUES
	('teacher_invitation', 'Teacher invitation email', 'Hello #teacher_name#,<br><br>You was invited to join "#school_name#" as a teacher.<br><br>To accept invitation follow this link: #invitation_link#.<br><br>#school_name#<br>', 'teacher_name|school_name|invitation_link'),
	('student_invitation', 'Student invitation email', 'Hello #student_name#,<br><br>You was invited to join "#school_name#" as a student.<br><br>To accept invitation follow this link: #invitation_link#.<br><br>#school_name#<br>', 'student_name|school_name|invitation_link'),
	('parent_invitation', 'Parent invitation email', 'Hello #parent_name#,<br><br>You was invited to join "#school_name#" as a parent.<br><br>To accept invitation follow this link: #invitation_link#.<br><br>#school_name#<br>', 'parent_name|school_name|invitation_link'),
	('donor_invitation', 'Donor invitation email', 'Hello #donor_name#,<br><br>You was invited to join "#school_name#" as a donor.<br><br>To accept invitation follow this link: #invitation_link#.<br><br>#school_name#<br>', 'donor_name|school_name|invitation_link');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_date` datetime DEFAULT NULL,
  `event_type` varchar(30) DEFAULT NULL,
  `source_id` int(10) unsigned DEFAULT NULL,
  `target_person` int(10) unsigned DEFAULT NULL,
  `person_type` varchar(15) DEFAULT NULL,
  `event_status` tinyint(3) unsigned DEFAULT '0',
  `busy_by` smallint(5) unsigned DEFAULT '0',
  `last_notification` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.events: ~35 rows (approximately)
DELETE FROM `events`;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`event_id`, `event_date`, `event_type`, `source_id`, `target_person`, `person_type`, `event_status`, `busy_by`, `last_notification`) VALUES
	(213, '2013-07-25 17:01:43', 'payment', 4, 2, 'parent', 1, 0, '2013-07-25 17:02:41'),
	(214, '2013-08-06 15:10:51', 'payment', 3, 9, 'student', 0, 0, NULL),
	(215, '2013-08-06 15:10:51', 'payment', 3, 17, 'student', 0, 0, NULL),
	(216, '2013-08-06 15:10:51', 'payment', 3, 20, 'student', 0, 0, NULL),
	(217, '2013-08-06 15:10:51', 'payment', 3, 33, 'student', 0, 0, NULL),
	(221, '2013-08-07 10:40:57', 'message', 120, 4, 'student', 0, 0, NULL),
	(222, '2013-08-07 10:40:57', 'message', 120, 6, 'student', 0, 0, NULL),
	(223, '2013-08-07 10:40:57', 'message', 120, 7, 'student', 0, 0, NULL),
	(224, '2013-08-07 10:40:57', 'message', 120, 8, 'student', 0, 0, NULL),
	(225, '2013-08-07 10:40:57', 'message', 120, 9, 'student', 0, 0, NULL),
	(226, '2013-08-07 10:40:57', 'message', 120, 10, 'student', 0, 0, NULL),
	(227, '2013-08-07 10:40:57', 'message', 120, 11, 'student', 0, 0, NULL),
	(228, '2013-08-07 10:40:57', 'message', 120, 12, 'student', 0, 0, NULL),
	(229, '2013-08-07 10:40:57', 'message', 120, 13, 'student', 0, 0, NULL),
	(230, '2013-08-07 10:40:57', 'message', 120, 14, 'student', 0, 0, NULL),
	(231, '2013-08-07 10:40:57', 'message', 120, 15, 'student', 0, 0, NULL),
	(232, '2013-08-07 10:40:57', 'message', 120, 16, 'student', 0, 0, NULL),
	(233, '2013-08-07 10:40:57', 'message', 120, 17, 'student', 0, 0, NULL),
	(234, '2013-08-07 10:40:57', 'message', 120, 18, 'student', 0, 0, NULL),
	(235, '2013-08-07 10:40:57', 'message', 120, 19, 'student', 0, 0, NULL),
	(236, '2013-08-07 10:40:57', 'message', 120, 20, 'student', 0, 0, NULL),
	(237, '2013-08-07 10:40:57', 'message', 120, 21, 'student', 0, 0, NULL),
	(238, '2013-08-07 10:40:57', 'message', 120, 22, 'student', 0, 0, NULL),
	(239, '2013-08-07 10:40:57', 'message', 120, 23, 'student', 0, 0, NULL),
	(240, '2013-08-07 10:40:57', 'message', 120, 24, 'student', 0, 0, NULL),
	(241, '2013-08-07 10:40:57', 'message', 120, 25, 'student', 0, 0, NULL),
	(242, '2013-08-07 10:40:57', 'message', 120, 26, 'student', 0, 0, NULL),
	(243, '2013-08-07 10:40:57', 'message', 120, 27, 'student', 0, 0, NULL),
	(244, '2013-08-07 10:40:57', 'message', 120, 28, 'student', 0, 0, NULL),
	(245, '2013-08-07 10:40:57', 'message', 120, 29, 'student', 0, 0, NULL),
	(246, '2013-08-07 10:40:57', 'message', 120, 32, 'parent', 0, 0, NULL),
	(247, '2013-08-07 10:40:57', 'message', 120, 32, 'teacher', 0, 0, NULL),
	(248, '2013-08-07 10:40:57', 'message', 120, 35, 'student', 0, 0, NULL),
	(252, '2013-08-07 11:40:32', 'message', 121, 17, 'teacher', 0, 0, NULL),
	(253, '2013-08-07 11:40:32', 'message', 121, 52, 'parent', 0, 0, NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.fees
DROP TABLE IF EXISTS `fees`;
CREATE TABLE IF NOT EXISTS `fees` (
  `fee_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(150) DEFAULT '',
  `fee_description` varchar(400) DEFAULT NULL,
  `until` date DEFAULT NULL,
  `amount` double unsigned DEFAULT NULL,
  `type` enum('students','groups') DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `is_subscription` tinyint(4) DEFAULT '0',
  `time_period` varchar(6) DEFAULT NULL,
  `subscription_start` date DEFAULT NULL,
  `subscription_end` date DEFAULT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.fees: ~4 rows (approximately)
DELETE FROM `fees`;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` (`fee_id`, `fee_name`, `fee_description`, `until`, `amount`, `type`, `is_deleted`, `is_subscription`, `time_period`, `subscription_start`, `subscription_end`) VALUES
	(1, 'Test charge', '', '2013-06-27', 97, 'students', 0, 0, NULL, NULL, NULL),
	(2, 'Charge for new books', '', '2013-06-27', 500, 'students', 0, 0, NULL, NULL, NULL),
	(3, 'Subscription payment for the 1st Grade', 'sfdghjfg dfghj dfj dfjdfgh', '2013-06-30', 25, 'groups', 0, 0, NULL, NULL, NULL),
	(4, 'test', 'dfdf', '2013-07-31', 100, 'students', 0, 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.fees_members
DROP TABLE IF EXISTS `fees_members`;
CREATE TABLE IF NOT EXISTS `fees_members` (
  `fee_id` mediumint(8) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `group_id` smallint(10) unsigned DEFAULT NULL,
  `is_paid` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `is_subscribed` tinyint(3) unsigned DEFAULT '0',
  `transaction_id` int(10) unsigned DEFAULT '0',
  `donated_ids` varchar(30) DEFAULT '0',
  `until` date DEFAULT NULL,
  UNIQUE KEY `Index 1` (`fee_id`,`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.fees_members: ~10 rows (approximately)
DELETE FROM `fees_members`;
/*!40000 ALTER TABLE `fees_members` DISABLE KEYS */;
INSERT INTO `fees_members` (`fee_id`, `student_id`, `group_id`, `is_paid`, `is_deleted`, `is_subscribed`, `transaction_id`, `donated_ids`, `until`) VALUES
	(3, 25, 4, 1, 1, 0, 106, '0', NULL),
	(3, 26, 4, 1, 1, 0, 109, '0', NULL),
	(3, 29, 3, 1, 1, 0, 105, '0', NULL),
	(3, 32, 3, 1, 1, 0, 99, '12,13', NULL),
	(2, 32, 3, 1, 0, 0, 98, '10,11', NULL),
	(4, 32, 3, 1, 0, 0, 97, '8,9', NULL),
	(3, 9, 4, 0, 0, 0, 0, '0', NULL),
	(3, 17, 3, 0, 0, 0, 0, '0', NULL),
	(3, 20, 3, 0, 0, 0, 0, '0', NULL),
	(3, 33, 3, 0, 0, 0, 0, '0', NULL);
/*!40000 ALTER TABLE `fees_members` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.fees_subscriptions
DROP TABLE IF EXISTS `fees_subscriptions`;
CREATE TABLE IF NOT EXISTS `fees_subscriptions` (
  `subscription_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned DEFAULT '0',
  `person_type` varchar(15) DEFAULT NULL,
  `fee_id` mediumint(15) unsigned DEFAULT NULL,
  `subscription_name` varchar(100) DEFAULT NULL,
  `subscription_value` double unsigned DEFAULT NULL,
  `is_active` tinyint(3) unsigned DEFAULT '0',
  `started_at` date DEFAULT NULL,
  `completed_at` date DEFAULT NULL,
  `source` varchar(20) DEFAULT NULL,
  `source_id` varchar(50) DEFAULT NULL,
  `current_transaction` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.fees_subscriptions: ~0 rows (approximately)
DELETE FROM `fees_subscriptions`;
/*!40000 ALTER TABLE `fees_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `fees_subscriptions` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.gradebook_scores
DROP TABLE IF EXISTS `gradebook_scores`;
CREATE TABLE IF NOT EXISTS `gradebook_scores` (
  `set_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `score` float(5,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `private_comment` varchar(100) DEFAULT NULL,
  `label` varchar(20) DEFAULT NULL,
  UNIQUE KEY `Index 2` (`set_id`,`student_id`),
  KEY `Index 1` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.gradebook_scores: ~48 rows (approximately)
DELETE FROM `gradebook_scores`;
/*!40000 ALTER TABLE `gradebook_scores` DISABLE KEYS */;
INSERT INTO `gradebook_scores` (`set_id`, `student_id`, `score`, `comment`, `private_comment`, `label`) VALUES
	(3, 25, 100.00, NULL, NULL, ''),
	(1, 32, 100.00, NULL, NULL, ''),
	(2, 13, 100.00, NULL, NULL, 'A'),
	(2, 7, 20.00, NULL, NULL, 'D'),
	(1, 4, 59.00, NULL, NULL, ''),
	(4, 32, 90.00, NULL, NULL, ''),
	(4, 5, 10.00, NULL, NULL, ''),
	(4, 6, 40.00, NULL, NULL, ''),
	(4, 13, 10.00, NULL, NULL, ''),
	(7, 4, 59.00, NULL, NULL, 'B'),
	(7, 7, 100.00, NULL, NULL, 'A'),
	(7, 13, 200.00, NULL, NULL, 'A'),
	(8, 4, 90.00, NULL, NULL, ''),
	(8, 5, 10.00, NULL, NULL, ''),
	(8, 6, 40.00, NULL, NULL, ''),
	(8, 13, 10.00, NULL, NULL, ''),
	(9, 25, 100.00, NULL, NULL, ''),
	(7, 5, 100.00, NULL, NULL, 'A'),
	(2, 25, 60.20, NULL, NULL, 'B'),
	(2, 5, 30.00, NULL, NULL, 'C'),
	(2, 6, 20.00, NULL, NULL, 'D'),
	(5, 4, 24.00, NULL, NULL, 'C'),
	(5, 5, 10.00, NULL, NULL, 'D'),
	(5, 6, 57.00, NULL, NULL, 'B'),
	(5, 7, 30.00, NULL, NULL, 'C'),
	(5, 13, 90.00, NULL, NULL, 'A'),
	(6, 4, 60.00, NULL, NULL, 'B'),
	(6, 5, 20.00, NULL, NULL, 'D'),
	(6, 6, 10.00, NULL, NULL, 'D'),
	(6, 7, 40.00, NULL, NULL, 'C'),
	(6, 13, 100.00, NULL, NULL, 'A'),
	(7, 6, 10.00, NULL, NULL, 'D'),
	(10, 4, 262.20, NULL, NULL, 'A'),
	(10, 5, 160.00, NULL, NULL, 'A'),
	(10, 6, 97.00, NULL, NULL, 'A'),
	(10, 7, 190.00, NULL, NULL, 'A'),
	(10, 13, 590.00, NULL, NULL, 'A'),
	(21, 1, 87.00, NULL, NULL, 'A'),
	(21, 17, 90.00, NULL, NULL, 'A'),
	(21, 22, 28.00, NULL, NULL, 'C'),
	(21, 32, 100.00, NULL, NULL, 'A'),
	(21, 3, 87.00, NULL, NULL, 'A'),
	(21, 31, 90.00, NULL, NULL, 'A'),
	(17, 3, 100.00, NULL, NULL, 'A'),
	(28, 17, 2.00, NULL, NULL, 'D'),
	(28, 22, 100.00, NULL, NULL, 'A'),
	(28, 24, 1.00, NULL, NULL, 'D'),
	(28, 32, 1.00, NULL, NULL, 'D');
/*!40000 ALTER TABLE `gradebook_scores` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.gradebook_sets
DROP TABLE IF EXISTS `gradebook_sets`;
CREATE TABLE IF NOT EXISTS `gradebook_sets` (
  `set_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) unsigned DEFAULT '0',
  `group_id` int(10) unsigned DEFAULT '0',
  `subject_id` int(10) unsigned DEFAULT '0',
  `category_id` tinyint(3) unsigned DEFAULT '1',
  `date` date DEFAULT NULL,
  `name` varchar(100) DEFAULT '',
  `semester_id` int(10) unsigned DEFAULT '0',
  `autor_id` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.gradebook_sets: ~25 rows (approximately)
DELETE FROM `gradebook_sets`;
/*!40000 ALTER TABLE `gradebook_sets` DISABLE KEYS */;
INSERT INTO `gradebook_sets` (`set_id`, `grade_id`, `group_id`, `subject_id`, `category_id`, `date`, `name`, `semester_id`, `autor_id`) VALUES
	(1, 3, 0, 1, 1, '2013-05-22', 'Test assignment', 1, 0),
	(2, 3, 0, 1, 1, '2013-05-22', 'Test assignment', 1, 0),
	(3, 6, 0, 2, 1, '2013-05-22', 'test one', 1, 0),
	(4, 3, 0, 2, 1, '2013-05-21', 'test', 1, 0),
	(5, 3, 0, 1, 5, '2013-05-22', 'Test Final grade', 1, 0),
	(6, 3, 0, 1, 5, '2013-05-22', 'Test Final grade', 1, 0),
	(7, 3, 0, 1, 5, '2013-05-22', 'Test Final grade', 1, 0),
	(8, 3, 0, 2, 5, '2013-05-22', 'Test Final grade', 1, 0),
	(9, 6, 0, 2, 5, '2013-05-22', 'Test Final grade', 1, 0),
	(10, 3, 0, 1, 5, '2013-05-22', 'Final grade', 1, 0),
	(11, 3, 0, 2, 5, '2013-05-22', 'Final grade', 1, 0),
	(12, 6, 0, 2, 5, '2013-05-22', 'Final grade', 1, 0),
	(13, 2, 0, 1, 1, '2013-06-08', 'fghdf', 3, 4),
	(14, 2, 0, 1, 1, '2013-06-12', '121264564', 3, 4),
	(15, 2, 0, 1, 1, '2013-06-11', 'cvjhg', 3, 4),
	(16, 2, 0, 1, 1, '2013-06-25', 'bsfghjg', 3, 4),
	(17, 2, 0, 1, 1, '2013-06-17', 'xvbn', 3, 4),
	(18, 2, 0, 1, 1, '2013-06-19', 'cjg', 3, 4),
	(19, 2, 0, 1, 1, '2013-06-19', 'xfgh', 3, 4),
	(20, 2, 0, 1, 1, '2013-06-11', '1111', 3, 4),
	(21, 2, 0, 1, 1, '2013-06-12', 'dfhjkghj', 3, 4),
	(22, 2, 0, 1, 1, '2013-06-17', 'dhfgjg', 3, 4),
	(25, 4, 0, 2, 1, '2013-06-19', 'dasfg', 3, 0),
	(27, 3, 0, 2, 1, '2013-06-19', 'dfdf', 3, 5),
	(28, 2, 0, 2, 1, '2013-06-18', 'sd', 3, 5);
/*!40000 ALTER TABLE `gradebook_sets` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.grades
DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `grade_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `is_active` tinyint(3) unsigned DEFAULT '1',
  `order` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.grades: ~7 rows (approximately)
DELETE FROM `grades`;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` (`grade_id`, `name`, `is_active`, `order`) VALUES
	(1, 'Kindergarten', 1, 5),
	(2, '1st Grade', 1, 4),
	(4, '3rd Grade', 1, 1),
	(5, 'Test', 1, 3),
	(6, '5th Grade', 1, 0),
	(7, '6th Grade', 1, 6),
	(8, '7th Grade', 1, 2);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.incidents
DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `incident_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `details` text,
  `response` text,
  `status` enum('Deleted','Active') DEFAULT 'Active',
  `autor_id` int(3) unsigned DEFAULT '0',
  PRIMARY KEY (`incident_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.incidents: ~7 rows (approximately)
DELETE FROM `incidents`;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
INSERT INTO `incidents` (`incident_id`, `date`, `details`, `response`, `status`, `autor_id`) VALUES
	(1, '2013-05-21', 'dfghfdhsfghfg', 'dfdfdf', 'Deleted', 0),
	(2, '2013-05-22', 'But why the arbitrary three-click limit? Is there any indication that web users will suddenly give up if it takes them three clicks to get to what the want?', 'In fact, most users won’t give up just because they’ve hit some magical number. The number of clicks they have to make isn’t related to user frustration.', 'Active', 0),
	(3, '2013-05-23', 'sfghfdghdfg', 'sfghfsg', 'Active', 0),
	(4, '2013-05-23', 'xcgh', '', 'Active', 0),
	(5, '2013-06-12', 'adfgasdfg', '', 'Deleted', 5),
	(6, '2013-08-15', 'asfg fgh sdhsdf', '', 'Deleted', 2),
	(7, '2013-06-12', 'dfghjfg', 'sfhsfgh', 'Deleted', 0);
/*!40000 ALTER TABLE `incidents` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.incidents_persons
DROP TABLE IF EXISTS `incidents_persons`;
CREATE TABLE IF NOT EXISTS `incidents_persons` (
  `incident_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  `person_type` enum('teacher','student') DEFAULT NULL,
  KEY `Index 1` (`incident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.incidents_persons: ~27 rows (approximately)
DELETE FROM `incidents_persons`;
/*!40000 ALTER TABLE `incidents_persons` DISABLE KEYS */;
INSERT INTO `incidents_persons` (`incident_id`, `person_id`, `person_type`) VALUES
	(1, 3, 'student'),
	(1, 2, 'student'),
	(1, 32, 'student'),
	(1, 2, 'teacher'),
	(2, 2, 'student'),
	(2, 32, 'student'),
	(2, 22, 'teacher'),
	(2, 5, 'teacher'),
	(4, 25, 'student'),
	(4, 12, 'student'),
	(4, 5, 'teacher'),
	(5, 28, 'student'),
	(5, 12, 'student'),
	(5, 20, 'student'),
	(5, 5, 'teacher'),
	(6, 28, 'student'),
	(6, 3, 'student'),
	(6, 12, 'student'),
	(6, 4, 'student'),
	(6, 18, 'student'),
	(6, 2, 'teacher'),
	(7, 28, 'student'),
	(7, 17, 'teacher'),
	(7, 22, 'teacher'),
	(3, 32, 'student'),
	(3, 4, 'student'),
	(3, 17, 'teacher');
/*!40000 ALTER TABLE `incidents_persons` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.library
DROP TABLE IF EXISTS `library`;
CREATE TABLE IF NOT EXISTS `library` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_file` varchar(150) DEFAULT '',
  `item_extenstion` varchar(4) DEFAULT '',
  `item_description` varchar(400) DEFAULT '',
  `item_location` varchar(100) DEFAULT '',
  `uploaded` datetime DEFAULT NULL,
  `item_type` varchar(100) DEFAULT NULL,
  `access_type` varchar(10) DEFAULT NULL,
  `item_autor` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.library: ~2 rows (approximately)
DELETE FROM `library`;
/*!40000 ALTER TABLE `library` DISABLE KEYS */;
INSERT INTO `library` (`item_id`, `item_file`, `item_extenstion`, `item_description`, `item_location`, `uploaded`, `item_type`, `access_type`, `item_autor`) VALUES
	(1, '(04)_[Headstrong_feat._Tiff_Lacey]_Show_Me_The_Love_(Reuben_Halsey_Chillout_Remix)_.mp3', 'mp3', 'fghjfghjfdfjdfgh', 'b4f7ee8b42b38755e35e83c421c4c607.mp3', '2013-07-30 11:33:07', 'audio/mp3', NULL, 1),
	(4, '(04)_[Headstrong_feat._Tiff_Lacey]_Show_Me_The_Love_(Reuben_Halsey_Chillout_Remix)_.mp3', 'mp3', 'dgdfghjg45454', '365c20d73dd4b1f5992f61226b85c1bb.mp3', '2013-07-30 11:36:13', 'audio/mp3', 'students', 1);
/*!40000 ALTER TABLE `library` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.library_permissions
DROP TABLE IF EXISTS `library_permissions`;
CREATE TABLE IF NOT EXISTS `library_permissions` (
  `item_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  KEY `Index 1` (`item_id`),
  KEY `Index 2` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.library_permissions: ~2 rows (approximately)
DELETE FROM `library_permissions`;
/*!40000 ALTER TABLE `library_permissions` DISABLE KEYS */;
INSERT INTO `library_permissions` (`item_id`, `type`, `value`) VALUES
	(1, 'all', '*'),
	(4, 'student', '27');
/*!40000 ALTER TABLE `library_permissions` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) unsigned DEFAULT NULL,
  `message_body` text,
  `message_date` datetime DEFAULT NULL,
  `message_sender` int(10) unsigned DEFAULT NULL,
  `sender_person` varchar(15) DEFAULT NULL,
  `is_last_message` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `Index 2` (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.messages: ~121 rows (approximately)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`message_id`, `thread_id`, `message_body`, `message_date`, `message_sender`, `sender_person`, `is_last_message`) VALUES
	(1, 1, 'test', '2013-06-29 15:01:24', 0, 'admin', 1),
	(2, 2, 'sfgh', '2013-06-29 15:04:06', 0, 'admin', 0),
	(3, 2, 'dfghgf', '2013-06-29 16:51:22', 2, 'parent', 1),
	(4, 3, 'ghj', '2013-06-30 14:15:01', 0, 'admin', 1),
	(5, 4, 'ghj', '2013-06-30 14:15:06', 0, 'admin', 1),
	(6, 5, 'ghj', '2013-06-30 14:38:19', 0, 'admin', 1),
	(7, 6, 'ghj', '2013-06-30 14:41:25', 0, 'admin', 1),
	(8, 7, 'ghj', '2013-06-30 14:41:41', 0, 'admin', 1),
	(9, 8, 'ghj', '2013-06-30 14:47:33', 0, 'admin', 1),
	(10, 9, 'ghj', '2013-06-30 14:54:23', 0, 'admin', 1),
	(11, 10, 'fghkj', '2013-06-30 15:03:49', 0, 'admin', 1),
	(12, 11, 'xcvbn', '2013-06-30 15:04:08', 0, 'admin', 0),
	(13, 11, 'fgh', '2013-06-30 19:05:34', 0, 'admin', 0),
	(14, 11, 'ghfdg', '2013-06-30 19:05:36', 0, 'admin', 0),
	(15, 11, 'fghfg', '2013-06-30 19:05:39', 0, 'admin', 0),
	(16, 11, 'dfghdfghf', '2013-06-30 19:05:43', 0, 'admin', 0),
	(17, 11, 'dfgjdfg', '2013-06-30 19:05:45', 0, 'admin', 0),
	(18, 11, 'fbdafgdfg', '2013-06-30 19:05:51', 0, 'admin', 0),
	(19, 11, '1234567778gshjghj', '2013-06-30 19:05:54', 0, 'admin', 0),
	(20, 11, 'dfhsdf', '2013-06-30 19:06:20', 0, 'admin', 1),
	(21, 12, 'Hello to everyone,\nI want to discuss scheduling for New Year and ask everyone to join this discussion.\n\nAdmin', '2013-06-30 19:07:37', 0, 'admin', 0),
	(22, 12, 'fsdghsfgh<br />\n<br />\nsdfghsdfgh<br />\n<br />\nsghsdfgh', '2013-06-30 19:09:13', 0, 'admin', 0),
	(23, 12, 'dfghjdfjg<br />\nfgh<br />\nfgh', '2013-06-30 19:10:15', 0, 'admin', 0),
	(24, 12, 'cvbnmcv', '2013-06-30 19:10:21', 0, 'admin', 0),
	(25, 12, 'dfghsdgh', '2013-06-30 19:10:25', 0, 'admin', 0),
	(26, 12, 'sdfghsfgh', '2013-06-30 19:10:32', 0, 'admin', 0),
	(27, 13, 'Exams are coming ', '2013-06-30 19:12:08', 0, 'admin', 1),
	(28, 14, 'Exams are coming ', '2013-06-30 19:12:15', 0, 'admin', 0),
	(29, 15, 'Exams are coming ', '2013-06-30 19:13:27', 0, 'admin', 0),
	(30, 16, 'Exams are coming ', '2013-06-30 19:14:28', 0, 'admin', 0),
	(31, 16, 'gsfh', '2013-06-30 19:16:32', 0, 'admin', 0),
	(32, 16, 'fsdgh', '2013-06-30 19:16:33', 0, 'admin', 0),
	(33, 16, 'sdafg', '2013-06-30 19:16:49', 0, 'admin', 0),
	(34, 16, 'fhjfg', '2013-06-30 19:18:37', 0, 'admin', 0),
	(35, 16, 'adfgasfg', '2013-06-30 19:18:41', 0, 'admin', 0),
	(36, 16, 'sghf', '2013-06-30 21:00:38', 0, 'admin', 0),
	(37, 16, 'sy45756', '2013-06-30 21:00:40', 0, 'admin', 0),
	(38, 16, 'dgjhgh', '2013-06-30 21:00:42', 0, 'admin', 0),
	(39, 16, 'xfghjfghj', '2013-06-30 21:00:44', 0, 'admin', 0),
	(40, 16, '45656234', '2013-06-30 21:00:46', 0, 'admin', 0),
	(41, 16, 'dghs hsw45y 4w', '2013-06-30 21:00:48', 0, 'admin', 0),
	(42, 16, 'dhjdfh', '2013-06-30 21:05:06', 0, 'admin', 0),
	(43, 16, 'ghjg', '2013-06-30 21:05:07', 0, 'admin', 0),
	(44, 16, 'sdhfgsdf', '2013-06-30 21:08:18', 0, 'admin', 0),
	(45, 16, 'sdfghsdf', '2013-06-30 21:08:20', 0, 'admin', 0),
	(46, 16, 'sfhgsfgh', '2013-06-30 22:09:19', 0, 'admin', 0),
	(47, 16, 'sfhgsfgh', '2013-06-30 22:09:19', 0, 'admin', 0),
	(48, 16, 'dfghjdfghjf', '2013-06-30 22:09:39', 0, 'admin', 0),
	(49, 16, 'dfjdfghj', '2013-06-30 22:09:41', 0, 'admin', 0),
	(50, 16, 'sfghdfg', '2013-06-30 22:11:33', 0, 'admin', 0),
	(51, 16, 'dfgsdfghsdf', '2013-06-30 22:11:41', 0, 'admin', 0),
	(52, 16, 'asdfgasdf', '2013-06-30 22:11:44', 0, 'admin', 0),
	(53, 16, 'fxdhgfdghfg', '2013-06-30 22:12:31', 0, 'admin', 0),
	(54, 16, 'dhdfgjdfgh', '2013-06-30 22:13:39', 0, 'admin', 0),
	(55, 16, 'sdhdfgh', '2013-06-30 22:13:42', 0, 'admin', 0),
	(56, 16, 'djdgfhj', '2013-06-30 22:41:40', 0, 'admin', 0),
	(57, 16, 'dfghjdfghj', '2013-06-30 22:41:43', 0, 'admin', 0),
	(58, 16, 'sdhsdhfgd', '2013-06-30 22:41:46', 0, 'admin', 0),
	(59, 16, 'sdghdfgh', '2013-06-30 22:41:48', 0, 'admin', 0),
	(60, 16, 'sfghsdfh', '2013-06-30 22:41:50', 0, 'admin', 0),
	(61, 16, 'sdhdsfhd', '2013-06-30 22:41:53', 0, 'admin', 0),
	(62, 16, 'sdfhdsfh', '2013-06-30 22:41:54', 0, 'admin', 0),
	(63, 16, 'fghjfdg', '2013-06-30 23:30:36', 0, 'admin', 0),
	(64, 16, 'gj', '2013-06-30 23:30:38', 0, 'admin', 0),
	(65, 16, 'g', '2013-06-30 23:30:40', 0, 'admin', 0),
	(66, 16, 'sdfgh', '2013-06-30 23:30:43', 0, 'admin', 0),
	(67, 16, 'sdfgh', '2013-06-30 23:30:45', 0, 'admin', 0),
	(68, 16, 'sdfghsdfgh', '2013-06-30 23:30:47', 0, 'admin', 0),
	(69, 16, 'sghsdfgh', '2013-06-30 23:30:49', 0, 'admin', 0),
	(70, 16, 'sghsdfhg', '2013-06-30 23:30:51', 0, 'admin', 0),
	(71, 12, 'dsfghsdfhd', '2013-06-30 23:33:23', 0, 'admin', 0),
	(72, 12, 'dghdfghjf', '2013-07-01 10:17:08', 0, 'admin', 0),
	(73, 12, 'dghdfghjf', '2013-07-01 10:17:16', 0, 'admin', 0),
	(74, 12, 'dghdfghjf', '2013-07-01 10:17:31', 0, 'admin', 0),
	(75, 12, 'dhjghj', '2013-07-01 10:17:41', 0, 'admin', 0),
	(76, 12, 'dfjdgjkg', '2013-07-01 10:17:45', 0, 'admin', 0),
	(77, 12, 'dfghjdfgjh', '2013-07-01 10:18:11', 0, 'admin', 0),
	(78, 12, 'sdfgsdfg', '2013-07-01 10:18:13', 0, 'admin', 0),
	(79, 12, 'sdfgdfg', '2013-07-01 10:18:15', 0, 'admin', 1),
	(80, 16, 'shjdfgh', '2013-07-01 10:22:35', 0, 'admin', 0),
	(81, 16, 'fdghjdfgh', '2013-07-01 11:16:04', 32, 'student', 0),
	(82, 16, 'dfghfghf', '2013-07-01 11:16:26', 32, 'student', 0),
	(83, 16, 'sfghsfgh', '2013-07-01 11:24:13', 32, 'student', 1),
	(84, 14, 'Great to here this', '2013-07-01 11:24:43', 32, 'student', 0),
	(85, 14, 'What about tasks? May you help with them?', '2013-07-01 11:25:03', 32, 'student', 0),
	(86, 14, '??', '2013-07-01 11:25:50', 32, 'student', 0),
	(87, 14, 'dfjdfjfdgh', '2013-07-01 11:26:09', 32, 'student', 0),
	(88, 14, 'fdghdfghf', '2013-07-01 11:38:10', 32, 'student', 0),
	(89, 14, 'sfghfdgh', '2013-07-01 11:38:17', 32, 'student', 0),
	(90, 14, 'sdfsds', '2013-07-01 11:38:23', 32, 'student', 0),
	(91, 14, 'sdfgdgdgfd dfg afg fg adfg adfgad fgfa ag adfg', '2013-07-01 11:40:07', 32, 'student', 0),
	(92, 14, 'dfghjdfghjg', '2013-07-01 11:41:44', 32, 'student', 0),
	(93, 14, 'dfgjdfjhg', '2013-07-01 11:42:10', 32, 'student', 0),
	(94, 14, 'dghjdghj', '2013-07-01 11:42:14', 32, 'student', 0),
	(95, 17, 'fdghf', '2013-07-01 12:57:04', 32, 'student', 1),
	(96, 18, 'fdghf', '2013-07-01 12:59:09', 32, 'student', 1),
	(97, 19, 'fgf', '2013-07-01 13:00:44', 32, 'student', 1),
	(98, 20, 'dsfgh', '2013-07-01 13:01:20', 32, 'student', 1),
	(99, 21, 'dsfgh', '2013-07-01 13:04:27', 32, 'student', 1),
	(100, 15, 'shfsdgh', '2013-07-01 13:05:25', 32, 'student', 0),
	(101, 15, 'hndfghjdf', '2013-07-01 13:05:28', 32, 'student', 1),
	(102, 22, 'I don\'t understand homework', '2013-07-01 13:55:16', 32, 'student', 1),
	(103, 23, 'Financial Account has been suspended', '2013-07-01 13:56:17', 32, 'student', 1),
	(104, 24, 'New homework', '2013-07-01 14:05:10', 1, 'teacher', 0),
	(105, 24, 'Got it', '2013-07-01 14:05:28', 32, 'student', 1),
	(106, 25, 'What about new books', '2013-07-01 14:06:17', 1, 'teacher', 0),
	(107, 25, 'Accept', '2013-07-01 14:07:31', 5, 'teacher', 0),
	(108, 25, 'good', '2013-07-01 14:08:19', 1, 'teacher', 1),
	(109, 26, 'test', '2013-07-01 14:08:30', 1, 'teacher', 0),
	(110, 26, 'we got a problem', '2013-07-01 14:10:46', 2, 'parent', 0),
	(111, 26, 'dfghdfghfg', '2013-07-01 14:38:56', 2, 'parent', 0),
	(112, 26, 'dfghdfghfg', '2013-07-01 14:39:01', 2, 'parent', 0),
	(113, 26, 'dfghdfghfg', '2013-07-01 14:39:26', 2, 'parent', 1),
	(114, 27, 'sfgh', '2013-07-01 15:30:45', 2, 'parent', 0),
	(115, 27, 'sdfhsdhsd', '2013-07-01 15:31:12', 2, 'parent', 1),
	(116, 28, 'fxdghdf', '2013-07-01 15:34:23', 2, 'parent', 1),
	(117, 29, 'afg', '2013-07-01 15:37:06', 2, 'parent', 1),
	(118, 30, 'fghf', '2013-07-03 15:39:47', 0, 'admin', 1),
	(119, 14, 'fghfsdg', '2013-07-03 15:39:58', 0, 'admin', 0),
	(120, 14, 'I know it', '2013-08-07 10:40:57', 32, 'student', 1),
	(121, 31, 'This is test message......', '2013-08-07 11:40:32', 2, 'parent', 1);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.messages_interlocutors
DROP TABLE IF EXISTS `messages_interlocutors`;
CREATE TABLE IF NOT EXISTS `messages_interlocutors` (
  `thread_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  `person_type` varchar(15) DEFAULT NULL,
  `is_active` tinyint(3) unsigned DEFAULT '0',
  `new_messages` smallint(5) unsigned DEFAULT '0',
  KEY `Index 1` (`thread_id`),
  KEY `Index 2` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.messages_interlocutors: ~385 rows (approximately)
DELETE FROM `messages_interlocutors`;
/*!40000 ALTER TABLE `messages_interlocutors` DISABLE KEYS */;
INSERT INTO `messages_interlocutors` (`thread_id`, `person_id`, `person_type`, `is_active`, `new_messages`) VALUES
	(1, 5, 'teacher', 0, 0),
	(1, 7, 'teacher', 0, 0),
	(1, 8, 'teacher', 0, 0),
	(1, 9, 'teacher', 0, 0),
	(1, 10, 'teacher', 0, 0),
	(1, 11, 'teacher', 0, 0),
	(1, 12, 'teacher', 0, 0),
	(1, 13, 'teacher', 0, 0),
	(1, 14, 'teacher', 0, 0),
	(1, 15, 'teacher', 0, 0),
	(1, 16, 'teacher', 0, 0),
	(1, 17, 'teacher', 0, 0),
	(1, 18, 'teacher', 0, 0),
	(1, 19, 'teacher', 0, 0),
	(1, 20, 'teacher', 0, 0),
	(1, 21, 'teacher', 0, 0),
	(1, 22, 'teacher', 0, 0),
	(1, 23, 'teacher', 0, 0),
	(1, 24, 'teacher', 0, 0),
	(1, 25, 'teacher', 0, 0),
	(1, 26, 'teacher', 0, 0),
	(1, 27, 'teacher', 0, 0),
	(1, 28, 'teacher', 0, 0),
	(1, 29, 'teacher', 0, 0),
	(1, 30, 'teacher', 0, 0),
	(1, 4, 'student', 0, 0),
	(1, 6, 'student', 0, 0),
	(1, 7, 'student', 0, 0),
	(1, 8, 'student', 0, 0),
	(1, 9, 'student', 0, 0),
	(1, 10, 'student', 0, 0),
	(1, 11, 'student', 0, 0),
	(1, 12, 'student', 0, 0),
	(1, 13, 'student', 0, 0),
	(1, 14, 'student', 0, 0),
	(1, 15, 'student', 0, 0),
	(1, 16, 'student', 0, 0),
	(1, 17, 'student', 0, 0),
	(1, 18, 'student', 0, 0),
	(1, 19, 'student', 0, 0),
	(1, 20, 'student', 0, 0),
	(1, 21, 'student', 0, 0),
	(1, 22, 'student', 0, 0),
	(1, 23, 'student', 0, 0),
	(1, 24, 'student', 0, 0),
	(1, 25, 'student', 0, 0),
	(1, 26, 'student', 0, 0),
	(1, 27, 'student', 0, 0),
	(1, 28, 'student', 0, 0),
	(1, 29, 'student', 0, 0),
	(1, 31, 'student', 0, 0),
	(1, 32, 'student', 0, 0),
	(1, 33, 'student', 0, 0),
	(1, 34, 'student', 0, 0),
	(1, 35, 'student', 0, 0),
	(1, 2, 'parent', 0, 0),
	(1, 3, 'parent', 0, 0),
	(1, 33, 'parent', 0, 0),
	(1, 34, 'parent', 0, 0),
	(1, 35, 'parent', 0, 0),
	(1, 36, 'parent', 0, 0),
	(1, 37, 'parent', 0, 0),
	(1, 38, 'parent', 0, 0),
	(1, 39, 'parent', 0, 0),
	(1, 40, 'parent', 0, 0),
	(1, 41, 'parent', 0, 0),
	(1, 42, 'parent', 0, 0),
	(1, 43, 'parent', 0, 0),
	(1, 44, 'parent', 0, 0),
	(1, 45, 'parent', 0, 0),
	(1, 46, 'parent', 0, 0),
	(1, 47, 'parent', 0, 0),
	(1, 48, 'parent', 0, 0),
	(1, 49, 'parent', 0, 0),
	(1, 50, 'parent', 0, 0),
	(1, 51, 'parent', 0, 0),
	(1, 52, 'parent', 0, 0),
	(1, 53, 'parent', 0, 0),
	(1, 54, 'parent', 0, 0),
	(1, 55, 'parent', 0, 0),
	(1, 56, 'parent', 0, 0),
	(1, 0, 'admin', 1, 0),
	(2, 0, 'admin', 1, 0),
	(2, 17, 'teacher', 1, 0),
	(2, 28, 'student', 1, 0),
	(2, 38, 'parent', 1, 0),
	(2, 2, 'parent', 1, 0),
	(3, 0, 'admin', 1, 0),
	(3, 5, 'teacher', 0, 0),
	(3, 7, 'teacher', 0, 0),
	(3, 8, 'teacher', 0, 0),
	(3, 9, 'teacher', 0, 0),
	(3, 10, 'teacher', 0, 0),
	(3, 11, 'teacher', 0, 0),
	(3, 12, 'teacher', 0, 0),
	(3, 13, 'teacher', 0, 0),
	(3, 14, 'teacher', 0, 0),
	(3, 15, 'teacher', 0, 0),
	(3, 16, 'teacher', 0, 0),
	(3, 17, 'teacher', 0, 0),
	(3, 18, 'teacher', 0, 0),
	(3, 19, 'teacher', 0, 0),
	(3, 20, 'teacher', 0, 0),
	(3, 21, 'teacher', 0, 0),
	(3, 22, 'teacher', 0, 0),
	(3, 23, 'teacher', 0, 0),
	(3, 24, 'teacher', 0, 0),
	(3, 25, 'teacher', 0, 0),
	(3, 26, 'teacher', 0, 0),
	(3, 27, 'teacher', 0, 0),
	(3, 28, 'teacher', 0, 0),
	(3, 29, 'teacher', 0, 0),
	(3, 30, 'teacher', 0, 0),
	(4, 0, 'admin', 1, 0),
	(4, 5, 'teacher', 0, 0),
	(4, 7, 'teacher', 0, 0),
	(4, 8, 'teacher', 0, 0),
	(4, 9, 'teacher', 0, 0),
	(4, 10, 'teacher', 0, 0),
	(4, 11, 'teacher', 0, 0),
	(4, 12, 'teacher', 0, 0),
	(4, 13, 'teacher', 0, 0),
	(4, 14, 'teacher', 0, 0),
	(4, 15, 'teacher', 0, 0),
	(4, 16, 'teacher', 0, 0),
	(4, 17, 'teacher', 0, 0),
	(4, 18, 'teacher', 0, 0),
	(4, 19, 'teacher', 0, 0),
	(4, 20, 'teacher', 0, 0),
	(4, 21, 'teacher', 0, 0),
	(4, 22, 'teacher', 0, 0),
	(4, 23, 'teacher', 0, 0),
	(4, 24, 'teacher', 0, 0),
	(4, 25, 'teacher', 0, 0),
	(4, 26, 'teacher', 0, 0),
	(4, 27, 'teacher', 0, 0),
	(4, 28, 'teacher', 0, 0),
	(4, 29, 'teacher', 0, 0),
	(4, 30, 'teacher', 0, 0),
	(5, 0, 'admin', 1, 0),
	(5, 5, 'teacher', 0, 0),
	(5, 7, 'teacher', 0, 0),
	(5, 8, 'teacher', 0, 0),
	(5, 9, 'teacher', 0, 0),
	(5, 10, 'teacher', 0, 0),
	(5, 11, 'teacher', 0, 0),
	(5, 12, 'teacher', 0, 0),
	(5, 13, 'teacher', 0, 0),
	(5, 14, 'teacher', 0, 0),
	(5, 15, 'teacher', 0, 0),
	(5, 16, 'teacher', 0, 0),
	(5, 17, 'teacher', 0, 0),
	(5, 18, 'teacher', 0, 0),
	(5, 19, 'teacher', 0, 0),
	(5, 20, 'teacher', 0, 0),
	(5, 21, 'teacher', 0, 0),
	(5, 22, 'teacher', 0, 0),
	(5, 23, 'teacher', 0, 0),
	(5, 24, 'teacher', 0, 0),
	(5, 25, 'teacher', 0, 0),
	(5, 26, 'teacher', 0, 0),
	(5, 27, 'teacher', 0, 0),
	(5, 28, 'teacher', 0, 0),
	(5, 29, 'teacher', 0, 0),
	(5, 30, 'teacher', 0, 0),
	(6, 0, 'admin', 1, 3),
	(6, 5, 'teacher', 0, 0),
	(6, 7, 'teacher', 0, 0),
	(6, 8, 'teacher', 0, 0),
	(6, 9, 'teacher', 0, 0),
	(6, 10, 'teacher', 0, 0),
	(6, 11, 'teacher', 0, 0),
	(6, 12, 'teacher', 0, 0),
	(6, 13, 'teacher', 0, 0),
	(6, 14, 'teacher', 0, 0),
	(6, 15, 'teacher', 0, 0),
	(6, 16, 'teacher', 0, 0),
	(6, 17, 'teacher', 0, 0),
	(6, 18, 'teacher', 0, 0),
	(6, 19, 'teacher', 0, 0),
	(6, 20, 'teacher', 0, 0),
	(6, 21, 'teacher', 0, 0),
	(6, 22, 'teacher', 0, 0),
	(6, 23, 'teacher', 0, 0),
	(6, 24, 'teacher', 0, 0),
	(6, 25, 'teacher', 0, 0),
	(6, 26, 'teacher', 0, 0),
	(6, 27, 'teacher', 0, 0),
	(6, 28, 'teacher', 0, 0),
	(6, 29, 'teacher', 0, 0),
	(6, 30, 'teacher', 0, 0),
	(7, 0, 'admin', 1, 0),
	(7, 5, 'teacher', 0, 0),
	(7, 7, 'teacher', 0, 0),
	(7, 8, 'teacher', 0, 0),
	(7, 9, 'teacher', 0, 0),
	(7, 10, 'teacher', 0, 0),
	(7, 11, 'teacher', 0, 0),
	(7, 12, 'teacher', 0, 0),
	(7, 13, 'teacher', 0, 0),
	(7, 14, 'teacher', 0, 0),
	(7, 15, 'teacher', 0, 0),
	(7, 16, 'teacher', 0, 0),
	(7, 17, 'teacher', 0, 0),
	(7, 18, 'teacher', 0, 0),
	(7, 19, 'teacher', 0, 0),
	(7, 20, 'teacher', 0, 0),
	(7, 21, 'teacher', 0, 0),
	(7, 22, 'teacher', 0, 0),
	(7, 23, 'teacher', 0, 0),
	(7, 24, 'teacher', 0, 0),
	(7, 25, 'teacher', 0, 0),
	(7, 26, 'teacher', 0, 0),
	(7, 27, 'teacher', 0, 0),
	(7, 28, 'teacher', 0, 0),
	(7, 29, 'teacher', 0, 0),
	(7, 30, 'teacher', 0, 0),
	(8, 0, 'admin', 1, 0),
	(8, 5, 'teacher', 0, 0),
	(8, 7, 'teacher', 0, 0),
	(8, 8, 'teacher', 0, 0),
	(8, 9, 'teacher', 0, 0),
	(8, 10, 'teacher', 0, 0),
	(8, 11, 'teacher', 0, 0),
	(8, 12, 'teacher', 0, 0),
	(8, 13, 'teacher', 0, 0),
	(8, 14, 'teacher', 0, 0),
	(8, 15, 'teacher', 0, 0),
	(8, 16, 'teacher', 0, 0),
	(8, 17, 'teacher', 0, 0),
	(8, 18, 'teacher', 0, 0),
	(8, 19, 'teacher', 0, 0),
	(8, 20, 'teacher', 0, 0),
	(8, 21, 'teacher', 0, 0),
	(8, 22, 'teacher', 0, 0),
	(8, 23, 'teacher', 0, 0),
	(8, 24, 'teacher', 0, 0),
	(8, 25, 'teacher', 0, 0),
	(8, 26, 'teacher', 0, 0),
	(8, 27, 'teacher', 0, 0),
	(8, 28, 'teacher', 0, 0),
	(8, 29, 'teacher', 0, 0),
	(8, 30, 'teacher', 0, 0),
	(9, 0, 'admin', 1, 0),
	(9, 5, 'teacher', 0, 0),
	(9, 7, 'teacher', 0, 0),
	(9, 8, 'teacher', 0, 0),
	(9, 9, 'teacher', 0, 0),
	(9, 10, 'teacher', 0, 0),
	(9, 11, 'teacher', 0, 0),
	(9, 12, 'teacher', 0, 0),
	(9, 13, 'teacher', 0, 0),
	(9, 14, 'teacher', 0, 0),
	(9, 15, 'teacher', 0, 0),
	(9, 16, 'teacher', 0, 0),
	(9, 17, 'teacher', 0, 0),
	(9, 18, 'teacher', 0, 0),
	(9, 19, 'teacher', 0, 0),
	(9, 20, 'teacher', 0, 0),
	(9, 21, 'teacher', 0, 0),
	(9, 22, 'teacher', 0, 0),
	(9, 23, 'teacher', 0, 0),
	(9, 24, 'teacher', 0, 0),
	(9, 25, 'teacher', 0, 0),
	(9, 26, 'teacher', 0, 0),
	(9, 27, 'teacher', 0, 0),
	(9, 28, 'teacher', 0, 0),
	(9, 29, 'teacher', 0, 0),
	(9, 30, 'teacher', 0, 0),
	(10, 0, 'admin', 1, 0),
	(10, 5, 'teacher', 0, 0),
	(10, 7, 'teacher', 0, 0),
	(10, 8, 'teacher', 0, 0),
	(10, 9, 'teacher', 0, 0),
	(10, 10, 'teacher', 0, 0),
	(10, 11, 'teacher', 0, 0),
	(10, 12, 'teacher', 0, 0),
	(10, 13, 'teacher', 0, 0),
	(10, 14, 'teacher', 0, 0),
	(10, 15, 'teacher', 0, 0),
	(10, 16, 'teacher', 0, 0),
	(10, 17, 'teacher', 0, 0),
	(10, 18, 'teacher', 0, 0),
	(10, 19, 'teacher', 0, 0),
	(10, 20, 'teacher', 0, 0),
	(10, 21, 'teacher', 0, 0),
	(10, 22, 'teacher', 0, 0),
	(10, 23, 'teacher', 0, 0),
	(10, 24, 'teacher', 0, 0),
	(10, 25, 'teacher', 0, 0),
	(10, 26, 'teacher', 0, 0),
	(10, 27, 'teacher', 0, 0),
	(10, 28, 'teacher', 0, 0),
	(10, 29, 'teacher', 0, 0),
	(10, 30, 'teacher', 0, 0),
	(11, 0, 'admin', 1, 0),
	(11, 22, 'teacher', 0, 0),
	(12, 0, 'admin', 1, 0),
	(12, 5, 'teacher', 0, 0),
	(12, 7, 'teacher', 0, 6),
	(12, 8, 'teacher', 0, 6),
	(12, 9, 'teacher', 0, 6),
	(12, 10, 'teacher', 0, 6),
	(12, 11, 'teacher', 0, 6),
	(12, 12, 'teacher', 0, 6),
	(12, 13, 'teacher', 0, 6),
	(12, 14, 'teacher', 0, 6),
	(12, 15, 'teacher', 0, 6),
	(12, 16, 'teacher', 0, 6),
	(12, 17, 'teacher', 0, 6),
	(12, 18, 'teacher', 0, 6),
	(12, 19, 'teacher', 0, 6),
	(12, 20, 'teacher', 0, 6),
	(12, 21, 'teacher', 0, 6),
	(12, 22, 'teacher', 0, 6),
	(12, 23, 'teacher', 0, 6),
	(12, 24, 'teacher', 0, 6),
	(12, 25, 'teacher', 0, 6),
	(12, 26, 'teacher', 0, 6),
	(12, 27, 'teacher', 0, 6),
	(12, 28, 'teacher', 0, 6),
	(12, 29, 'teacher', 0, 6),
	(12, 30, 'teacher', 0, 6),
	(13, 0, 'admin', 1, 0),
	(13, 4, 'student', 0, 0),
	(13, 6, 'student', 0, 0),
	(13, 7, 'student', 0, 0),
	(13, 8, 'student', 0, 0),
	(13, 9, 'student', 0, 0),
	(13, 10, 'student', 0, 0),
	(13, 11, 'student', 0, 0),
	(13, 12, 'student', 0, 0),
	(13, 13, 'student', 0, 0),
	(13, 14, 'student', 0, 0),
	(13, 15, 'student', 0, 0),
	(13, 16, 'student', 0, 0),
	(13, 17, 'student', 0, 0),
	(13, 18, 'student', 0, 0),
	(13, 19, 'student', 0, 0),
	(13, 20, 'student', 0, 0),
	(13, 21, 'student', 0, 0),
	(13, 22, 'student', 0, 0),
	(13, 23, 'student', 0, 0),
	(13, 24, 'student', 0, 0),
	(13, 25, 'student', 0, 0),
	(13, 26, 'student', 0, 0),
	(13, 27, 'student', 0, 0),
	(13, 28, 'student', 0, 0),
	(13, 29, 'student', 0, 0),
	(13, 31, 'student', 0, 0),
	(13, 32, 'student', 0, 0),
	(13, 33, 'student', 0, 0),
	(13, 34, 'student', 0, 0),
	(13, 35, 'student', 0, 0),
	(14, 0, 'admin', 1, 1),
	(14, 4, 'student', 0, 11),
	(14, 6, 'student', 0, 11),
	(14, 7, 'student', 0, 11),
	(14, 8, 'student', 0, 11),
	(14, 9, 'student', 0, 11),
	(14, 10, 'student', 0, 11),
	(14, 11, 'student', 0, 11),
	(14, 12, 'student', 0, 11),
	(14, 13, 'student', 0, 11),
	(14, 14, 'student', 0, 11),
	(14, 15, 'student', 0, 11),
	(14, 16, 'student', 0, 11),
	(14, 17, 'student', 0, 11),
	(14, 18, 'student', 0, 11),
	(14, 19, 'student', 0, 11),
	(14, 20, 'student', 0, 11),
	(14, 21, 'student', 0, 11),
	(14, 22, 'student', 0, 11),
	(14, 23, 'student', 0, 11),
	(14, 24, 'student', 0, 11),
	(14, 25, 'student', 0, 11),
	(14, 26, 'student', 0, 11),
	(14, 27, 'student', 0, 11),
	(14, 28, 'student', 0, 11),
	(14, 29, 'student', 0, 11),
	(14, 31, 'student', 0, 1),
	(14, 32, 'student', 1, 0),
	(14, 32, 'parent', 0, 9),
	(14, 32, 'teacher', 0, 9),
	(14, 35, 'student', 0, 11),
	(15, 0, 'admin', 1, 2),
	(15, 4, 'student', 0, 2),
	(15, 6, 'student', 0, 2),
	(15, 7, 'student', 0, 2),
	(15, 8, 'student', 0, 2),
	(15, 9, 'student', 0, 2),
	(15, 10, 'student', 0, 2),
	(15, 11, 'student', 0, 2),
	(15, 12, 'student', 0, 2),
	(15, 13, 'student', 0, 2),
	(15, 14, 'student', 0, 2),
	(15, 15, 'student', 0, 2),
	(15, 16, 'student', 0, 2),
	(15, 17, 'student', 0, 2),
	(15, 18, 'student', 0, 2),
	(15, 19, 'student', 0, 2),
	(15, 20, 'student', 0, 2),
	(15, 21, 'student', 0, 2),
	(15, 22, 'student', 0, 2),
	(15, 23, 'student', 0, 2),
	(15, 24, 'student', 0, 2),
	(15, 25, 'student', 0, 2),
	(15, 26, 'student', 0, 2),
	(15, 27, 'student', 0, 2),
	(15, 28, 'student', 0, 2),
	(15, 29, 'student', 0, 2),
	(15, 31, 'student', 0, 2),
	(15, 32, 'student', 1, 0),
	(15, 33, 'student', 0, 2),
	(15, 34, 'student', 0, 2),
	(15, 35, 'student', 0, 2),
	(16, 0, 'admin', 1, 3),
	(16, 4, 'student', 0, 1),
	(16, 6, 'student', 0, 1),
	(16, 7, 'student', 0, 1),
	(16, 8, 'student', 0, 1),
	(16, 9, 'student', 0, 1),
	(16, 10, 'student', 0, 1),
	(16, 11, 'student', 0, 1),
	(16, 12, 'student', 0, 1),
	(16, 13, 'student', 0, 1),
	(16, 14, 'student', 0, 1),
	(16, 15, 'student', 0, 1),
	(16, 16, 'student', 0, 1),
	(16, 17, 'student', 0, 1),
	(16, 18, 'student', 0, 1),
	(16, 19, 'student', 0, 1),
	(16, 20, 'student', 0, 1),
	(16, 21, 'student', 0, 1),
	(16, 22, 'student', 0, 1),
	(16, 23, 'student', 0, 1),
	(16, 24, 'student', 0, 1),
	(16, 25, 'student', 0, 1),
	(16, 26, 'student', 0, 1),
	(16, 27, 'student', 0, 1),
	(16, 28, 'student', 0, 1),
	(16, 29, 'student', 0, 1),
	(16, 31, 'student', 0, 1),
	(16, 32, 'student', 1, 0),
	(16, 33, 'student', 0, 1),
	(16, 34, 'student', 0, 1),
	(16, 35, 'student', 0, 1),
	(17, 32, 'student', 1, 0),
	(18, 32, 'student', 1, 0),
	(18, 17, 'teacher', 0, 1),
	(18, 22, 'teacher', 0, 1),
	(19, 32, 'student', 1, 0),
	(20, 32, 'student', 1, 0),
	(21, 32, 'student', 1, 0),
	(22, 32, 'student', 1, 0),
	(22, 22, 'teacher', 0, 1),
	(23, 32, 'student', 1, 0),
	(23, 1, 'teacher', 0, 0),
	(23, 5, 'teacher', 0, 0),
	(24, 1, 'teacher', 1, 0),
	(24, 4, 'student', 0, 2),
	(24, 6, 'student', 0, 2),
	(24, 7, 'student', 0, 2),
	(24, 8, 'student', 0, 2),
	(24, 9, 'student', 0, 2),
	(24, 10, 'student', 0, 2),
	(24, 11, 'student', 0, 2),
	(24, 12, 'student', 0, 2),
	(24, 13, 'student', 0, 2),
	(24, 14, 'student', 0, 2),
	(24, 15, 'student', 0, 2),
	(24, 16, 'student', 0, 2),
	(24, 17, 'student', 0, 2),
	(24, 18, 'student', 0, 2),
	(24, 19, 'student', 0, 2),
	(24, 20, 'student', 0, 2),
	(24, 21, 'student', 0, 2),
	(24, 22, 'student', 0, 2),
	(24, 23, 'student', 0, 2),
	(24, 24, 'student', 0, 2),
	(24, 25, 'student', 0, 2),
	(24, 26, 'student', 0, 2),
	(24, 27, 'student', 0, 2),
	(24, 28, 'student', 0, 2),
	(24, 29, 'student', 0, 2),
	(24, 31, 'student', 0, 2),
	(24, 32, 'student', 1, 0),
	(24, 33, 'student', 0, 2),
	(24, 34, 'student', 0, 2),
	(24, 35, 'student', 0, 2),
	(25, 1, 'teacher', 1, 0),
	(25, 5, 'teacher', 1, 0),
	(25, 7, 'teacher', 0, 3),
	(25, 8, 'teacher', 0, 3),
	(25, 9, 'teacher', 0, 3),
	(25, 10, 'teacher', 0, 3),
	(25, 11, 'teacher', 0, 3),
	(25, 12, 'teacher', 0, 3),
	(25, 13, 'teacher', 0, 3),
	(25, 14, 'teacher', 0, 3),
	(25, 15, 'teacher', 0, 3),
	(25, 16, 'teacher', 0, 3),
	(25, 17, 'teacher', 0, 3),
	(25, 18, 'teacher', 0, 3),
	(25, 19, 'teacher', 0, 3),
	(25, 20, 'teacher', 0, 3),
	(25, 21, 'teacher', 0, 3),
	(25, 22, 'teacher', 0, 3),
	(25, 23, 'teacher', 0, 3),
	(25, 24, 'teacher', 0, 3),
	(25, 25, 'teacher', 0, 3),
	(25, 26, 'teacher', 0, 3),
	(25, 27, 'teacher', 0, 3),
	(25, 28, 'teacher', 0, 3),
	(25, 29, 'teacher', 0, 3),
	(25, 30, 'teacher', 0, 3),
	(26, 1, 'teacher', 1, 0),
	(26, 2, 'parent', 1, 0),
	(26, 3, 'parent', 0, 3),
	(26, 33, 'parent', 0, 3),
	(26, 34, 'parent', 0, 3),
	(26, 35, 'parent', 0, 3),
	(26, 36, 'parent', 0, 3),
	(26, 37, 'parent', 0, 3),
	(26, 38, 'parent', 0, 3),
	(26, 39, 'parent', 0, 3),
	(26, 40, 'parent', 0, 3),
	(26, 41, 'parent', 0, 3),
	(26, 42, 'parent', 0, 3),
	(26, 43, 'parent', 0, 3),
	(26, 44, 'parent', 0, 3),
	(26, 45, 'parent', 0, 3),
	(26, 46, 'parent', 0, 3),
	(26, 47, 'parent', 0, 3),
	(26, 48, 'parent', 0, 3),
	(26, 49, 'parent', 0, 3),
	(26, 50, 'parent', 0, 3),
	(26, 51, 'parent', 0, 3),
	(26, 52, 'parent', 0, 3),
	(26, 53, 'parent', 0, 3),
	(26, 54, 'parent', 0, 3),
	(26, 55, 'parent', 0, 3),
	(26, 56, 'parent', 0, 3),
	(27, 2, 'parent', 1, 0),
	(27, 22, 'teacher', 0, 2),
	(27, 38, 'parent', 0, 2),
	(27, 49, 'parent', 0, 2),
	(28, 2, 'parent', 1, 0),
	(28, 1, 'teacher', 0, 0),
	(28, 5, 'teacher', 0, 0),
	(28, 49, 'parent', 0, 1),
	(29, 2, 'parent', 1, 0),
	(29, 17, 'teacher', 0, 1),
	(29, 49, 'parent', 0, 1),
	(29, 53, 'parent', 0, 1),
	(30, 0, 'admin', 1, 0),
	(30, 1, 'teacher', 0, 0),
	(30, 5, 'teacher', 0, 0),
	(30, 7, 'teacher', 0, 1),
	(30, 8, 'teacher', 0, 1),
	(30, 9, 'teacher', 0, 1),
	(30, 10, 'teacher', 0, 1),
	(30, 11, 'teacher', 0, 1),
	(30, 12, 'teacher', 0, 1),
	(30, 13, 'teacher', 0, 1),
	(30, 14, 'teacher', 0, 1),
	(30, 15, 'teacher', 0, 1),
	(30, 16, 'teacher', 0, 1),
	(30, 17, 'teacher', 0, 1),
	(30, 18, 'teacher', 0, 1),
	(30, 19, 'teacher', 0, 1),
	(30, 20, 'teacher', 0, 1),
	(30, 21, 'teacher', 0, 1),
	(30, 22, 'teacher', 0, 1),
	(30, 23, 'teacher', 0, 1),
	(30, 24, 'teacher', 0, 1),
	(30, 25, 'teacher', 0, 1),
	(30, 26, 'teacher', 0, 1),
	(30, 27, 'teacher', 0, 1),
	(30, 28, 'teacher', 0, 1),
	(30, 29, 'teacher', 0, 1),
	(30, 30, 'teacher', 0, 1),
	(30, 4, 'student', 0, 1),
	(30, 6, 'student', 0, 1),
	(30, 7, 'student', 0, 1),
	(30, 8, 'student', 0, 1),
	(30, 9, 'student', 0, 1),
	(30, 10, 'student', 0, 1),
	(30, 11, 'student', 0, 1),
	(30, 12, 'student', 0, 1),
	(30, 13, 'student', 0, 1),
	(30, 14, 'student', 0, 1),
	(30, 15, 'student', 0, 1),
	(30, 16, 'student', 0, 1),
	(30, 17, 'student', 0, 1),
	(30, 18, 'student', 0, 1),
	(30, 19, 'student', 0, 1),
	(30, 20, 'student', 0, 1),
	(30, 21, 'student', 0, 1),
	(30, 22, 'student', 0, 1),
	(30, 23, 'student', 0, 1),
	(30, 24, 'student', 0, 1),
	(30, 25, 'student', 0, 1),
	(30, 26, 'student', 0, 1),
	(30, 27, 'student', 0, 1),
	(30, 28, 'student', 0, 1),
	(30, 29, 'student', 0, 1),
	(30, 31, 'student', 0, 1),
	(30, 32, 'student', 0, 0),
	(30, 33, 'student', 0, 1),
	(30, 34, 'student', 0, 1),
	(30, 35, 'student', 0, 1),
	(30, 2, 'parent', 0, 0),
	(30, 3, 'parent', 0, 1),
	(30, 33, 'parent', 0, 1),
	(30, 34, 'parent', 0, 1),
	(30, 35, 'parent', 0, 1),
	(30, 36, 'parent', 0, 1),
	(30, 37, 'parent', 0, 1),
	(30, 38, 'parent', 0, 1),
	(30, 39, 'parent', 0, 1),
	(30, 40, 'parent', 0, 1),
	(30, 41, 'parent', 0, 1),
	(30, 42, 'parent', 0, 1),
	(30, 43, 'parent', 0, 1),
	(30, 44, 'parent', 0, 1),
	(30, 45, 'parent', 0, 1),
	(30, 46, 'parent', 0, 1),
	(30, 47, 'parent', 0, 1),
	(30, 48, 'parent', 0, 1),
	(30, 49, 'parent', 0, 1),
	(30, 50, 'parent', 0, 1),
	(30, 51, 'parent', 0, 1),
	(30, 52, 'parent', 0, 1),
	(30, 53, 'parent', 0, 1),
	(30, 54, 'parent', 0, 1),
	(30, 55, 'parent', 0, 1),
	(30, 56, 'parent', 0, 1),
	(31, 2, 'parent', 1, 0),
	(31, 17, 'teacher', 0, 1),
	(31, 52, 'parent', 0, 1);
/*!40000 ALTER TABLE `messages_interlocutors` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.messages_thread
DROP TABLE IF EXISTS `messages_thread`;
CREATE TABLE IF NOT EXISTS `messages_thread` (
  `thread_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_subject` varchar(200) DEFAULT NULL,
  `thread_autor` int(10) unsigned DEFAULT NULL,
  `thread_person` varchar(15) DEFAULT NULL,
  `last_message_by` varchar(200) DEFAULT NULL,
  `last_message` varchar(200) DEFAULT NULL,
  `last_message_at` datetime DEFAULT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.messages_thread: ~31 rows (approximately)
DELETE FROM `messages_thread`;
/*!40000 ALTER TABLE `messages_thread` DISABLE KEYS */;
INSERT INTO `messages_thread` (`thread_id`, `thread_subject`, `thread_autor`, `thread_person`, `last_message_by`, `last_message`, `last_message_at`) VALUES
	(1, 'test', 0, 'admin', 'Admin', 'dafghf', '2013-06-29 15:38:45'),
	(2, 'dhg', 0, 'admin', 'Admin', 'fsghfg', '2013-06-29 15:38:46'),
	(3, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:15:01'),
	(4, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:15:06'),
	(5, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:38:19'),
	(6, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:41:25'),
	(7, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:41:41'),
	(8, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:47:33'),
	(9, 'cfghjgh', 0, 'admin', 'Admin', 'ghj', '2013-06-30 14:54:23'),
	(10, 'fghjk', 0, 'admin', 'Admin', 'fghkj', '2013-06-30 15:03:49'),
	(11, 'cv', 0, 'admin', '0', 'dfhsdf', '2013-06-30 19:06:20'),
	(12, 'Discuss new scheduling for New Year', 0, 'admin', 'Admin', 'sdfgdfg', '2013-07-01 10:18:15'),
	(13, 'Exams are coming ', 0, 'admin', 'Admin', 'Exams are coming ', '2013-06-30 19:12:08'),
	(14, 'Exams are coming ', 0, 'admin', 'Loren M. Kim', 'I know it', '2013-08-07 10:40:57'),
	(15, 'Exams are coming ', 0, 'admin', 'Loren M. Kim', 'hndfghjdf', '2013-07-01 13:05:28'),
	(16, 'Exams are coming ', 0, 'admin', 'Loren M. Kim', 'sfghsfgh', '2013-07-01 11:24:13'),
	(17, 'fgh', 32, 'student', 'Loren M. Kim', 'fdghf', '2013-07-01 12:57:04'),
	(18, 'fgh', 32, 'student', 'Loren M. Kim', 'fdghf', '2013-07-01 12:59:09'),
	(19, 'ff', 32, 'student', 'Loren M. Kim', 'fgf', '2013-07-01 13:00:43'),
	(20, 'dfgh', 32, 'student', 'Loren M. Kim', 'dsfgh', '2013-07-01 13:01:20'),
	(21, 'dfgh', 32, 'student', 'Loren M. Kim', 'dsfgh', '2013-07-01 13:04:27'),
	(22, 'I don\'t understand homework', 32, 'student', 'Loren M. Kim', 'I don\'t understand homework', '2013-07-01 13:55:16'),
	(23, 'Financial Account has been suspended', 32, 'student', 'Loren M. Kim', 'Financial Account has been suspended', '2013-07-01 13:56:17'),
	(24, 'New homework', 1, 'teacher', 'Loren M. Kim', 'Got it', '2013-07-01 14:05:28'),
	(25, 'What about new books', 1, 'teacher', 'Scott M Amaya', 'good', '2013-07-01 14:08:19'),
	(26, 'test', 1, 'teacher', 'Justin M Wyatt', 'dfghdfghfg', '2013-07-01 14:39:26'),
	(27, 'dfgh', 2, 'parent', 'Justin M Wyatt', 'sdfhsdhsd', '2013-07-01 15:31:12'),
	(28, 'adfgh', 2, 'parent', 'Justin M Wyatt', 'fxdghdf', '2013-07-01 15:34:23'),
	(29, 'sdfg', 2, 'parent', 'Justin M Wyatt', 'afg', '2013-07-01 15:37:06'),
	(30, 'fgh', 0, 'admin', 'Admin', 'fghf', '2013-07-03 15:39:47'),
	(31, 'Test message', 2, 'parent', 'Justin M Wyatt', 'This is test message......', '2013-08-07 11:40:32');
/*!40000 ALTER TABLE `messages_thread` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int(10) unsigned DEFAULT '0',
  `recipient_type` varchar(15) DEFAULT NULL,
  `event_id` int(10) unsigned DEFAULT NULL,
  `notification` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `is_read` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `Index 2` (`recipient_id`,`recipient_type`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.notifications: ~26 rows (approximately)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`notification_id`, `recipient_id`, `recipient_type`, `event_id`, `notification`, `date`, `is_read`) VALUES
	(1, 4, 'student', 1, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:43', 0),
	(2, 9, 'student', 2, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:43', 0),
	(3, 17, 'student', 3, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:43', 0),
	(4, 20, 'student', 4, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(5, 25, 'student', 5, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(6, 26, 'student', 6, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(7, 29, 'student', 7, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(8, 33, 'student', 8, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(10, 3, 'parent', 17, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(11, 3, 'parent', 18, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 10:03:44', 0),
	(20, 4, 'student', 1, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:21', 0),
	(21, 9, 'student', 2, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:21', 0),
	(22, 17, 'student', 3, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:21', 0),
	(23, 20, 'student', 4, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:21', 0),
	(24, 26, 'student', 6, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:22', 0),
	(25, 33, 'student', 8, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:22', 0),
	(26, 3, 'parent', 18, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-06-27 16:50:22', 0),
	(27, 4, 'student', 1, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(28, 9, 'student', 2, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(29, 17, 'student', 3, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(30, 20, 'student', 4, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(31, 26, 'student', 6, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(32, 33, 'student', 8, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:31', 0),
	(33, 3, 'parent', 18, 'You need to pay USD 2 for "Subscription payment for the 1st Grade"  due 30 Jun 2013. Click <a href="http://localhost/school/payments/pay/3">here to pay</a>', '2013-07-01 15:16:32', 0),
	(34, 32, 'student', 212, 'You need to pay USD 100 for "test" (dfdf) due 31 Jul 2013. Click <a href="http://localhost/school/payments/pay/4">here to pay</a>', '2013-07-25 17:02:41', 1),
	(35, 2, 'parent', 213, 'You need to pay USD 100 for "test" (dfdf) due 31 Jul 2013. Click <a href="http://localhost/school/payments/pay/4">here to pay</a>', '2013-07-25 17:02:41', 1);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.parents
DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `parent_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `ssn` varchar(20) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `cell_phone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `status` enum('Active','Inactive','Deleted') DEFAULT 'Inactive',
  `avatar` varchar(100) DEFAULT 'images/no_avatar.jpg',
  PRIMARY KEY (`parent_id`),
  KEY `Index 2` (`status`),
  KEY `Index 3` (`name`,`ssn`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.parents: ~27 rows (approximately)
DELETE FROM `parents`;
/*!40000 ALTER TABLE `parents` DISABLE KEYS */;
INSERT INTO `parents` (`parent_id`, `name`, `birth_date`, `gender`, `ssn`, `address`, `city`, `state`, `zip_code`, `home_phone`, `cell_phone`, `email`, `status`, `avatar`) VALUES
	(2, 'Freddie O French', '1956-03-01', 'male', '474-26-2327', '2729 Laurel Lee', 'Minneapolis', 'MN', '55415', '651-846-2570', '651-846-2570', 'FreddieFrench@dodgit.com', 'Active', 'images/no_avatar.jpg'),
	(3, 'Bailey L Chandler', '1996-03-24', 'male', '414-94-7690', '4107 Broadway Avenue', 'Bristol', 'TN', '37620', '423-878-3840', '423-878-3840', 'BaileyChandler@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(33, 'Roberta R Lewis', '1934-10-06', 'male', '517-78-6825', '1325 Meadow Drive', 'Bozeman', 'MT', '59715', '406-215-5034', '406-215-5034', 'RobertaRLewis@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(34, 'Norolf G Feragen', '1978-04-28', 'male', '316-64-9583', '2359 Crestview Manor', 'Indianapolis', 'IN', '46219', '317-322-0329', '317-322-0329', 'NorolfFeragen@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(35, 'Simone M Bumgarner', '1993-12-17', 'female', '550-72-7314', '967 Harrison Street', 'Oakland', 'CA', '94612', '415-530-1089', '415-530-1089', 'SimoneBumgarner@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(36, 'Isabella A Dyer', '1962-07-21', 'female', '374-04-4686', '2472 John Avenue', 'Lansing', 'MI', '48933', '517-772-6445', '517-772-6445', 'IsabellaDyer@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(37, 'Barbara R Egger', '1954-12-03', 'female', '375-90-6582', '3042 Twin Oaks Drive', 'Copemish', 'MI', '49625', '231-378-2144', '231-378-2144', 'BarbaraEgger@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(38, 'Adele N Trevisani', '1939-07-14', 'female', '648-24-1819', '914 Westfall Avenue', 'Santa Fe', 'NM', '87501', '505-986-3808', '505-986-3808', 'AdeleTrevisani@dodgit.com', 'Inactive', 'images/no_avatar.jpg'),
	(39, 'Théodore C Veronneau', '1982-02-02', 'male', '407-14-4509', '669 May Street', 'Salyersville', 'KY', '41465', '606-349-5013', '606-349-5013', 'TheodoreVeronneau@dodgit.com', 'Inactive', 'images/no_avatar.jpg'),
	(40, 'Fabiana  L Trevisani', '1947-02-19', 'female', '218-69-6584', '260 Roane Avenue', 'Laurel', 'MD', '20707', '301-206-3749', '301-206-3749', 'FabianaTrevisani@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(41, 'William B Goodwin', '1989-12-02', 'male', '341-76-8941', '4432 Braxton Street', 'Crystal Lake', 'IL', '60012', '815-482-3773', '815-482-3773', 'WilliamBGoodwin@spambob.com', 'Inactive', 'images/no_avatar.jpg'),
	(42, 'Lilly I Østenstad', '1986-09-23', 'female', '498-32-8323', '4789 Twin House Lane', 'Mount Vernon', 'MO', '65712', '417-471-9709', '417-471-9709', 'Lillystenstad@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(43, 'Sara J Wechsler', '1939-03-13', 'female', '090-88-5149', '225 Lake Forest Drive', 'Katonah', 'NY', '10536', '914-232-6600', '914-232-6600', 'SaraWechsler@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(44, 'Marphisa T Plaisance', '1951-06-25', 'female', '042-42-3090', '1632 Copperhead Road', 'Hartford', 'CT', '06103', '860-619-3036', '860-619-3036', 'MarphisaPlaisance@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(45, 'Uwe K Reinhard', '1980-11-12', 'male', '484-38-2254', '287 Pin Oak Drive', 'Davenport', 'IA', '52803', '563-336-8422', '563-336-8422', 'UweReinhard@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(46, 'Max M Fuchs', '1958-05-29', 'male', '272-08-0839', '924 Little Street', 'Warren', 'OH', '44481', '330-647-0217', '330-647-0217', 'MaxFuchs@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(47, 'William L Perkins', '1950-03-04', 'male', '763-01-7650', '3163 Edgewood Road', 'Arlington', 'TN', '38002', '901-201-8770', '901-201-8770', 'WilliamPerkins@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(48, 'Mason C Scott', '1982-05-16', 'male', '456-28-6222', '433 Bubby Drive', 'Austin', 'TX', '78759', '512-372-9566', '512-372-9566', 'MasonScott@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(49, 'Alice K Rhodes', '1980-08-09', 'female', '449-17-9029', '2666 Candlelight Drive', 'Katy', 'TX', '77494', '281-395-6035', '281-395-6035', 'AliceRhodes@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(50, 'Teline B Klyve', '1928-07-04', 'female', '653-22-4110', '3641 Scheuvront Drive', 'Broomfield', 'CO', '80020', '303-533-6316', '303-533-6316', 'TelineKlyve@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(51, 'Sindre K Skomedal', '1966-06-01', 'male', '241-56-2234', '4353 Snyder Avenue', 'Charlotte', 'NC', '28273', '704-712-3256', '704-712-3256', 'SindreSkomedal@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(52, 'Janina S Schwartz', '1982-10-09', 'female', '270-26-7540', '845 Round Table Drive', 'Amelia', 'OH', '45102', '513-797-5945', '513-797-5945', 'JaninaSchwartz@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(53, 'André S Brunvoll', '1991-01-21', 'male', '503-68-5013', '3623 Ryan Road', 'Forestburg', 'SD', '57338', '605-495-5888', '605-495-5888', 'AndreBrunvoll@pookmail.com', 'Inactive', 'images/no_avatar.jpg'),
	(54, 'Jessie C Barksdale', '1997-05-07', 'female', '389-46-3257', '692 Tail Ends Road', 'Green Bay', 'WI', '54303', '920-617-2849', '920-617-2849', 'JessieCBarksdale@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(55, 'Talon M Rochefort', '1998-04-10', 'male', '239-46-0852', '3314 Broadcast Drive', 'Matthews', 'NC', '28105', '704-240-7648', '704-240-7648', 'TalonRochefort@trashymail.com', 'Inactive', 'images/no_avatar.jpg'),
	(56, 'Charles A Gibbons', '1993-03-19', 'male', '632-62-0892', '1431 Romines Mill Road', 'Dallas', 'TX', '75247', '214-634-3209', '214-634-3209', 'CharlesGibbons@mailinator.com', 'Inactive', 'images/no_avatar.jpg'),
	(57, 'test', '2010-06-15', 'male', 'test', 'test', 'test', 'test', 'test', '234234234', '333333', 'test@test.com', 'Deleted', 'images/no_avatar.jpg');
/*!40000 ALTER TABLE `parents` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.registrations
DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `registration_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` smallint(5) unsigned DEFAULT '1',
  `student_name` varchar(100) DEFAULT NULL,
  `student_phone` varchar(50) DEFAULT NULL,
  `student_email` varchar(60) DEFAULT NULL,
  `student_comment` text,
  `registration_status` enum('Open','Accepted','Declined') DEFAULT 'Open',
  `registation_date` date DEFAULT NULL,
  `last_comment` varchar(500) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`registration_id`),
  KEY `Index 1` (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.registrations: ~6 rows (approximately)
DELETE FROM `registrations`;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` (`registration_id`, `form_id`, `student_name`, `student_phone`, `student_email`, `student_comment`, `registration_status`, `registation_date`, `last_comment`, `comments`) VALUES
	(10, 1, 'Samuel M. Molloy', '617-946-0983', 'SamuelM.Molloy2@zilorent.com', 'Test', 'Open', '2013-07-23', 'Declined', '<li>sfdghdjfgh<br/> <i><small>23 Jul 2013 15:29, by Admin</small></i></li><li>hjfghj<br/> <i><small>23 Jul 2013 15:29, by Admin</small></i></li><li>fsghfg<br/> <i><small>23 Jul 2013 03:29 PM, by Admin</small></i></li><li>fghfg<br/> <i><small>23 Jul 2013 03:29 PM, by Admin</small></i></li><li>srgh<br/> <i><small>23 Jul 2013 03:30 PM, by Admin</small></i></li><li>Accepted by Admin<br/> <i><small>23 Jul 2013 04:06 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:08 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:12 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:13 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:37 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:38 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:39 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:42 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:43 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:45 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:46 PM, by Admin</small></i></li><li>Declined<br/> <i><small>23 Jul 2013 04:48 PM, by Admin</small></i></li><li>sfgh<br/> <i><small>23 Jul 2013 04:49 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 04:49 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>23 Jul 2013 05:35 PM, by Admin</small></i></li><li>Declined<br/> <i><small>23 Jul 2013 05:42 PM, by Admin</small></i></li>'),
	(11, 1, 'sdh', 'sdfh', 'dsfh12121222@dfgh.rt', 'dfgt', 'Open', '2013-07-23', 'Accepted', '<li>Declined<br/> <i><small>23 Jul 2013 07:40 PM, by Admin</small></i></li><li>Accepted<br/> <i><small>12 Aug 2013 12:05 PM,  by  Admin</small></i></li>'),
	(12, 1, 'sdh', 'sdfh', 'dsfh@dfgh.rt', 'dfgt', 'Declined', '2013-07-23', 'Declined', '<li>Declined<br/> <i><small>23 Jul 2013 07:40 PM, by Admin</small></i></li>'),
	(13, 1, 'sdh', 'sdfh', 'dsfh@dfgh.rt', 'dfgt', 'Declined', '2013-07-23', 'Declined', '<li>Declined<br/> <i><small>23 Jul 2013 07:40 PM, by Admin</small></i></li>'),
	(14, 1, 'sdh', 'sdfh', 'dsfh@dfgh.rt', 'dfgt', 'Declined', '2013-07-23', 'Declined', '<li>Declined<br/> <i><small>23 Jul 2013 07:40 PM, by Admin</small></i></li>'),
	(15, 1, 'sdh', 'sdfh', 'dsfh@dfgh.rt', 'dfgt', 'Declined', '2013-07-23', 'Declined', '<li>Declined<br/> <i><small>23 Jul 2013 07:40 PM, by Admin</small></i></li>');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.reminders
DROP TABLE IF EXISTS `reminders`;
CREATE TABLE IF NOT EXISTS `reminders` (
  `remind_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `remind_text` varchar(400) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `remind_owner` int(10) unsigned DEFAULT NULL,
  `remind_person_type` varchar(10) DEFAULT NULL,
  `is_completed` tinyint(3) unsigned DEFAULT '0',
  `remind_object` int(10) unsigned DEFAULT '0',
  `remind_object_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`remind_id`),
  KEY `Index 2` (`remind_owner`),
  KEY `Index 3` (`remind_object`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.reminders: ~6 rows (approximately)
DELETE FROM `reminders`;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
INSERT INTO `reminders` (`remind_id`, `remind_text`, `due_date`, `remind_owner`, `remind_person_type`, `is_completed`, `remind_object`, `remind_object_type`) VALUES
	(1, 'Next time I will ask John to read the full page again ', NULL, 1, 'teacher', 0, 1, 'lesson'),
	(2, 'sfghdfgh', NULL, 1, 'teacher', 0, 223, 'lesson'),
	(3, 'sfghdfg', NULL, 1, 'teacher', 0, 26, 'lesson'),
	(4, 'sdfghsfghsfg', NULL, 1, 'teacher', 0, 27, 'lesson'),
	(5, 'Ask Amanda Z Wagner to read twice new words in Spanish to fix her accent!!', NULL, 1, 'teacher', 0, 24, 'lesson'),
	(6, 'vhdfg', NULL, 1, 'teacher', 0, 27, 'lesson');
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.scheduling
DROP TABLE IF EXISTS `scheduling`;
CREATE TABLE IF NOT EXISTS `scheduling` (
  `scheduling_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `grade` tinyint(3) unsigned DEFAULT NULL,
  `student_group` smallint(5) unsigned DEFAULT NULL,
  `room_id` smallint(5) unsigned DEFAULT NULL,
  `autor_id` int(10) unsigned DEFAULT '0',
  `is_private` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`scheduling_id`),
  KEY `Index 2` (`date`),
  KEY `Index 3` (`teacher_id`),
  KEY `Index 4` (`grade`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.scheduling: ~18 rows (approximately)
DELETE FROM `scheduling`;
/*!40000 ALTER TABLE `scheduling` DISABLE KEYS */;
INSERT INTO `scheduling` (`scheduling_id`, `start_time`, `end_time`, `date`, `teacher_id`, `subject_id`, `grade`, `student_group`, `room_id`, `autor_id`, `is_private`) VALUES
	(10, '16:47:00', '17:47:00', '2013-06-06', 4, 1, 2, 0, 2, 4, NULL),
	(14, '09:15:00', '10:15:00', '2013-06-04', 4, 1, 2, 0, 1, 4, NULL),
	(15, '18:20:00', '19:20:00', '2013-06-06', 5, 1, 2, 0, 1, 5, NULL),
	(18, '10:10:00', '11:09:00', '2013-06-25', 5, 1, 5, 10, 6, 5, NULL),
	(19, '20:16:14', '22:16:17', '2013-07-24', 5, 1, 2, 10, 11, 0, NULL),
	(20, '21:37:00', '22:37:00', '2013-07-24', 1, 1, 2, 0, 2, 0, NULL),
	(21, '21:49:00', '22:49:00', '2013-08-06', 1, 1, 2, 0, 4, 0, NULL),
	(22, '21:52:00', '22:52:00', '2013-07-24', 1, 1, 2, 0, 6, 0, NULL),
	(23, '22:02:00', '23:02:00', '2013-07-24', 1, 1, 2, 0, 7, 0, NULL),
	(24, '23:17:00', '23:30:00', '2013-07-24', 1, 1, 0, 0, 11, 0, '28,3'),
	(25, '23:50:00', '23:52:00', '2013-07-24', 1, 1, 0, 0, 11, 0, '28,3,12,2'),
	(26, '23:35:00', '23:55:00', '2013-07-24', 1, 1, 2, 0, 11, 0, NULL),
	(27, '09:50:00', '10:50:00', '2013-07-25', 1, 1, 0, 0, 11, 0, '11,32,12,20,28,1'),
	(28, '10:19:00', '11:19:00', '2013-07-25', 1, 1, 0, 0, 11, 0, '32'),
	(29, '15:06:00', '16:06:00', '2013-07-25', 1, 1, 0, 0, 11, 0, '4,34,29'),
	(30, '16:16:00', '17:16:00', '2013-07-25', 1, 1, 0, 0, 11, 1, '28,29'),
	(32, '14:24:00', '15:24:00', '2013-08-08', 1, 1, 2, 13, 3, 1, NULL),
	(34, '11:50:00', '12:50:00', '2013-08-08', 1, 1, 0, 0, 4, 0, '6');
/*!40000 ALTER TABLE `scheduling` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.school_info
DROP TABLE IF EXISTS `school_info`;
CREATE TABLE IF NOT EXISTS `school_info` (
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `principal` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.school_info: ~1 rows (approximately)
DELETE FROM `school_info`;
/*!40000 ALTER TABLE `school_info` DISABLE KEYS */;
INSERT INTO `school_info` (`name`, `address`, `city`, `state`, `zip`, `phone`, `email`, `principal`) VALUES
	('High School Math Science and Engineering at CCNY', '385 Watson Street', 'Pleasantville', 'NJ ', '08232', '609-742-1857', 'dfd@zilorent.com', 11);
/*!40000 ALTER TABLE `school_info` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.semesters
DROP TABLE IF EXISTS `semesters`;
CREATE TABLE IF NOT EXISTS `semesters` (
  `semester_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `year_start` year(4) DEFAULT NULL,
  `year_end` year(4) DEFAULT NULL,
  `is_active` tinyint(3) unsigned DEFAULT '0',
  `is_completed` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.semesters: ~5 rows (approximately)
DELETE FROM `semesters`;
/*!40000 ALTER TABLE `semesters` DISABLE KEYS */;
INSERT INTO `semesters` (`semester_id`, `name`, `start_date`, `end_date`, `year_start`, `year_end`, `is_active`, `is_completed`) VALUES
	(1, '', '2013-05-21', '2013-05-22', '2013', '2013', 0, 1),
	(2, '', '2013-05-23', '2013-05-29', '2013', '2013', 0, 1),
	(3, '', '2013-06-07', '2013-06-30', '2013', '2013', 1, 0),
	(4, 'test', '2013-08-20', '2013-11-15', '2013', '2013', 0, 0),
	(5, 'test', '2014-01-01', '2014-03-06', '2013', '2014', 0, 0);
/*!40000 ALTER TABLE `semesters` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(200) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('4962ef68070499352c7ac6865ca2c1e6', '94.200.137.250', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36', 1377696675, 'a:4:{s:9:"user_data";s:0:"";s:8:"admin_id";s:1:"1";s:10:"admin_name";s:5:"Admin";s:11:"permissions";a:1:{s:12:"global_admin";b:1;}}');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_key` varchar(50) DEFAULT NULL,
  `setting_value` text,
  `setting_group` varchar(20) DEFAULT NULL,
  KEY `Index 1` (`setting_key`),
  KEY `Index 2` (`setting_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.settings: ~17 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_group`) VALUES
	('smtp_server', '', 'email'),
	('smtp_user_name', '', 'email'),
	('smtp_password', '', 'email'),
	('message_from', 'School', 'email'),
	('from_email', '', 'email'),
	('email_method', 'mail', 'email'),
	('send_type', 'immediately', 'email'),
	('teacher_manage_own_subjects', 'on', 'global'),
	('teacher_manage_attendance', 'on', 'global'),
	('scale', 'a:4:{s:4:"0.00";a:2:{s:3:"max";s:5:"20.00";s:5:"label";s:1:"D";}s:5:"21.00";a:2:{s:3:"max";s:5:"40.00";s:5:"label";s:1:"C";}s:5:"41.00";a:2:{s:3:"max";s:5:"60.00";s:5:"label";s:1:"B";}s:5:"61.00";a:2:{s:3:"max";s:6:"100.00";s:5:"label";s:1:"A";}}', 'scale'),
	('final_score_method', 'avg', 'global'),
	('teacher_manage_gradebook', 'on', 'global'),
	('teacher_manage_incidents', 'on', 'global'),
	('current_language', 'english', 'global'),
	('current_currency', 'USD', 'global'),
	('payment_settings', 'a:0:{}', 'global'),
	('active_payments', '', 'global');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `ssn` varchar(20) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `state` varchar(30) DEFAULT '',
  `zip_code` varchar(10) DEFAULT '',
  `home_phone` varchar(20) DEFAULT '',
  `cell_phone` varchar(20) DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `status` enum('Active','Deleted','Inactive','Graduated','Left') DEFAULT 'Inactive',
  `avatar` varchar(100) DEFAULT 'images/no_avatar.jpg',
  `grade` tinyint(3) unsigned DEFAULT NULL,
  `group` smallint(3) unsigned DEFAULT NULL,
  `old_group` varchar(50) DEFAULT NULL,
  `part_of_donation` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`student_id`),
  KEY `Index 2` (`status`),
  KEY `Index 3` (`grade`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.students: ~52 rows (approximately)
DELETE FROM `students`;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`student_id`, `name`, `birth_date`, `gender`, `ssn`, `address`, `city`, `state`, `zip_code`, `home_phone`, `cell_phone`, `email`, `status`, `avatar`, `grade`, `group`, `old_group`, `part_of_donation`) VALUES
	(1, 'Shirley T Beaulieu', NULL, 'male', '557-66-1060', '3057 Thunder Road', 'Mountain View', 'CA', '94041', '650-527-7896', '650-527-7896', 'ShirleyTBeaulieu@zilorent.com', 'Active', 'images/no_avatar.jpg', 2, 0, NULL, 0),
	(2, 'Brittany K Smith', NULL, 'male', '469-64-0485', '1004 Newton Street', 'Saint Cloud', 'MN', '56301', '320-321-3011', '320-321-3011', 'BrittanyKSmith@zilorent.com', 'Graduated', 'images/no_avatar.jpg', 2, 11, NULL, 0),
	(3, 'Angel J Schuetz', NULL, 'male', '032-74-8501', '4286 Lyon Avenue', 'Cambridge', 'MA', '02141', '508-973-1277', '508-973-1277', 'AngelJSchuetz@zilorent.com', 'Left', 'images/no_avatar.jpg', 2, 1, NULL, 0),
	(4, 'Sahreef', NULL, 'male', '673-14-2435', '3164 Flint Street', 'Norcross', 'GA', '30091', '678-234-1351', '678-234-1351', 'DennisMHayes@zilorent.com', 'Inactive', 'avatars/8782debcf230163a16ed7efd016cdb7c.jpg', 4, 0, NULL, 0),
	(5, 'Heather A Barnett', NULL, 'male', '760-01-5513', '4914 Hidden Pond Road', 'Nashville', 'TN', '37201', '615-695-3926', '615-695-3926', 'HeatherABarnett@zilorent.com', 'Deleted', 'images/no_avatar.jpg', 4, 9, NULL, 0),
	(6, 'Abdul Hamid Adam', NULL, 'male', '465-59-3008', '3447 Adams Drive', 'Giddings', 'TX', '78942', '979-542-2600', '979-542-2600', 'ScottVMonroy@zilorent.com', 'Inactive', 'avatars/8c454588cea1a044688e1bb20b6ea1a3.jpg', 4, 0, NULL, 0),
	(7, 'Daniel P Shaw', NULL, 'male', '384-52-8174', '168 Wildrose Lane', 'Highland Park', 'MI', '48203', '313-866-8085', '313-866-8085', 'DanielPShaw@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 4, 2, NULL, 0),
	(8, 'Jennifer T Davis', NULL, 'female', '430-56-0363', '1088 Clinton Street', 'Little Rock', 'AR', '72211', '501-237-7490', '501-237-7490', 'JenniferTDavis@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 2, NULL, 0),
	(9, 'Robert I Platt', NULL, 'male', '255-91-3427', '2865 Layman Court', 'Decatur', 'GA', '30030', '678-386-6393', '678-386-6393', 'RobertIPlatt@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 4, NULL, 0),
	(10, 'Michael J Bullock', NULL, 'male', '372-48-7827', '2069 Lakeland Terrace', 'Wyandotte', 'MI', '48192', '734-283-7028', '734-283-7028', 'MichaelJBullock@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 10, NULL, 0),
	(11, 'Norma T Baptiste', NULL, 'male', '529-31-3410', '286 Austin Secret Lane', 'Evanston', 'UT', '82930', '435-289-0361', '435-289-0361', 'NormaTBaptiste@zilorent.com', 'Active', 'images/no_avatar.jpg', 1, 0, NULL, 0),
	(12, 'Brett T Glaude', NULL, 'male', '637-10-2704', '3967 New York Avenue', 'Fort Worth', 'TX', '76147', '817-952-4346', '817-952-4346', 'BrettTGlaude@zilorent.com', 'Graduated', 'images/no_avatar.jpg', 4, 7, NULL, 40),
	(13, 'William D Eadie', NULL, 'male', '769-01-5761', '710 Trails End Road', 'Pompano Beach', 'FL', '33064', '954-317-9073', '954-317-9073', 'WilliamDEadie@zilorent.com', 'Inactive', 'avatars/df3ca599bd29664cfddedc48383d086f.jpg', 4, 8, NULL, 0),
	(14, 'Juan S Katz', NULL, 'male', '140-06-8676', '4336 West Side Avenue', 'Newark', 'NJ', '07102', '201-300-3767', '201-300-3767', 'JuanSKatz@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 8, NULL, 0),
	(15, 'Loraine R Hamilton', NULL, 'female', '272-06-8805', '179 Jessie Street', 'Glenford', 'OH', '43739', '740-659-2136', '740-659-2136', 'LoraineRHamilton@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 6, NULL, 0),
	(16, 'James D Ferrell', NULL, 'male', '539-52-6667', '2239 Calico Drive', 'Wenatchee', 'WA', '98801', '509-645-9284', '509-645-9284', 'JamesDFerrell@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 2, NULL, 0),
	(17, 'Selma L Neth', NULL, 'male', '500-46-2931', '4174 Bruce Street', 'Saint Louis', 'MO', '63126', '314-272-5447', '314-272-5447', 'SelmaLNeth@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 2, 3, NULL, 0),
	(18, 'Christine M Fernandez', NULL, 'female', '681-07-0492', '3162 Twin Willow Lane', 'Fayetteville', 'NC', '28301', '910-492-8408', '910-492-8408', 'ChristineMFernandez@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 7, NULL, 0),
	(19, 'Charles E Cowman', NULL, 'male', '086-88-7717', '4299 Briercliff Road', 'Brooklyn', 'NY', '11234', '718-629-4205', '718-629-4205', 'CharlesECowman@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 5, NULL, 0),
	(20, 'Charlene W Harding', NULL, 'female', '265-19-7315', '1847 County Line Road', 'Tampa', 'FL', '33614', '727-692-9855', '727-692-9855', 'CharleneWHarding@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 3, NULL, 0),
	(21, 'Mary A Diaz', NULL, 'female', '475-62-6011', '3291 Jewell Road', 'Saint Paul', 'MN', '55104', '612-622-1113', '612-622-1113', 'MaryADiaz@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 10, NULL, 0),
	(22, 'Stanley K Riter', NULL, 'male', '091-03-5896', '756 Hanover Street', 'New York', 'NY', '10013', '917-715-8876', '917-715-8876', 'StanleyKRiter@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 2, 9, NULL, 0),
	(23, 'Jack A Guarino', NULL, 'male', '450-70-0510', '3431 Wilson Avenue', 'Frisco', 'TX', '75034', '972-549-4676', '972-549-4676', 'JackAGuarino@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 2, 5, NULL, 0),
	(24, 'Jacqueline N Elmore', NULL, 'male', '309-88-6725', '3334 Lucy Lane', 'Brazil', 'IN', '47834', '812-443-7347', '812-443-7347', 'JacquelineNElmore@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 2, 8, NULL, 0),
	(25, 'Ida D ', NULL, 'male', '334-92-9563', '780 Bolman Court', 'Ludlow', 'IL', '60949', '217-396-1177', '217-396-1177', 'IdaDBlack@zilorent.com', 'Inactive', 'avatars/44f368b6078d1f5817b7a4e873360c41.jpg', 2, 0, NULL, 0),
	(26, 'Marvin E Christensen', NULL, 'male', '549-44-8585', '4893 Brannon Street', 'Los Angeles', 'CA', '90071', '213-333-3534', '213-333-3534', 'MarvinEChristensen@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 7, 4, NULL, 0),
	(27, ' Siddiqe Thikai', NULL, 'male', '472-12-0675', '2705 Murphy Court', 'Plymouth', 'MN', '55441', '952-230-7915', '952-230-7915', 'JohnDWilson@zilorent.com', 'Inactive', 'avatars/a73355dfb4a64aa6a10104b583f694f0.jpg', 1, 0, NULL, 0),
	(28, 'Amanda Z Wagner', NULL, 'female', '423-04-9623', '1292 Wright Court', 'Birmingham', 'AL', '35205', '205-930-9042', '205-930-9042', 'AmandaZWagner@zilorent.com', 'Inactive', 'images/no_avatar.jpg', NULL, 11, NULL, 0),
	(29, 'Sham Kamikaze', NULL, 'male', '292-03-1208', '2370 Briarhill Lane', 'Akron', 'OH', '44308', '330-230-3713', '330-230-3713', 'DeloresJBrown@zilorent.com', 'Inactive', 'avatars/e2c64349fdf62f38cf83796d2a0850d7.jpg', 1, 0, NULL, 100),
	(30, 'Ali Rizwan', NULL, 'male', '256-96-4230', '2087 Holly Street', 'Rome', 'GA', '30161', '706-236-0681', '706-236-0681', 'MariaDHenry@zilorent.com', 'Graduated', 'avatars/537331044895caeb48100a3a24cd5519.jpg', 1, 0, NULL, 0),
	(31, 'er', NULL, 'male', '', '', '', '', '', '', '', 'dfd@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 2, 7, NULL, 0),
	(32, 'Sheza Irfan', NULL, 'male', '', '', '', '', '', '', '', 'LorenM.Kim@zilorent.com', 'Inactive', 'avatars/a52a5405dc6b2ece6bbd360f117fd6a5.jpg', 2, 0, NULL, 100),
	(33, 'dfb', NULL, 'male', '', '', '', '', '', '', '', 'dfgh@dfmryt.ty', 'Inactive', 'images/no_avatar.jpg', 1, 3, NULL, 0),
	(34, 'ddf', NULL, 'male', '', '', '', '', '', '', '', 'ishevchuk@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 1, 8, NULL, 0),
	(35, '12', NULL, 'male', '', '', '', '', '', '', '', 'ishevchuk@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 1, 8, NULL, 0),
	(36, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 1, 1, NULL, 0),
	(37, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(38, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(39, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(40, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(41, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(42, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(43, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(44, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(45, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(46, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(47, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(48, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(49, 'Samuel M. Molloy', NULL, 'male', '', '', '', '', '', '617-946-0983', '617-946-0983', 'SamuelM.Molloy@zilorent.com', 'Left', 'images/no_avatar.jpg', 6, 11, NULL, 0),
	(50, 'dfgh', NULL, 'male', '', '', '', '', '', '', '', 'sdfgh@df.ey', 'Graduated', 'images/no_avatar.jpg', 1, 0, NULL, 10),
	(51, 'adult', NULL, 'male', '', '', '', '', '', '', '', 'test@newtest.com', 'Inactive', 'images/no_avatar.jpg', 1, 0, NULL, 0),
	(52, 'sdh', NULL, 'male', '', '', '', '', '', 'sdfh', 'sdfh', 'dsfh222@dfgh.rt', 'Inactive', 'images/no_avatar.jpg', 6, 11, NULL, 0);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.students_donors
DROP TABLE IF EXISTS `students_donors`;
CREATE TABLE IF NOT EXISTS `students_donors` (
  `student_id` int(10) unsigned DEFAULT NULL,
  `donor_id` int(10) unsigned DEFAULT NULL,
  KEY `Index 1` (`student_id`,`donor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.students_donors: ~4 rows (approximately)
DELETE FROM `students_donors`;
/*!40000 ALTER TABLE `students_donors` DISABLE KEYS */;
INSERT INTO `students_donors` (`student_id`, `donor_id`) VALUES
	(6, 1),
	(20, 2),
	(27, 1),
	(28, 2);
/*!40000 ALTER TABLE `students_donors` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.students_groups
DROP TABLE IF EXISTS `students_groups`;
CREATE TABLE IF NOT EXISTS `students_groups` (
  `group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT '',
  `grade_id` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.students_groups: ~13 rows (approximately)
DELETE FROM `students_groups`;
/*!40000 ALTER TABLE `students_groups` DISABLE KEYS */;
INSERT INTO `students_groups` (`group_id`, `group_name`, `grade_id`, `is_deleted`) VALUES
	(1, 'K1', 1, 1),
	(2, 'K2', 1, 1),
	(3, '1G-1', 2, 1),
	(4, '1G-2', 2, 1),
	(5, '2G-1', 3, 1),
	(6, '2G-2', 3, 0),
	(7, '3G-1', 4, 0),
	(8, '3G-2', 4, 0),
	(9, '4G-1', 5, 0),
	(10, '4G-2', 5, 0),
	(11, '5G-1', 6, 0),
	(12, '5G-2', 6, 0),
	(13, 'test', 2, 1);
/*!40000 ALTER TABLE `students_groups` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.students_parents
DROP TABLE IF EXISTS `students_parents`;
CREATE TABLE IF NOT EXISTS `students_parents` (
  `student_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  KEY `Index 1` (`student_id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.students_parents: ~40 rows (approximately)
DELETE FROM `students_parents`;
/*!40000 ALTER TABLE `students_parents` DISABLE KEYS */;
INSERT INTO `students_parents` (`student_id`, `parent_id`) VALUES
	(1, 2),
	(2, 1),
	(2, 3),
	(3, 1),
	(4, 2),
	(4, 3),
	(4, 36),
	(4, 37),
	(4, 38),
	(4, 40),
	(4, 49),
	(4, 52),
	(4, 53),
	(4, 56),
	(5, 4),
	(5, 6),
	(6, 2),
	(6, 57),
	(7, 33),
	(8, 6),
	(11, 2),
	(13, 2),
	(18, 33),
	(19, 33),
	(21, 4),
	(23, 4),
	(24, 4),
	(24, 6),
	(24, 22),
	(25, 2),
	(25, 3),
	(26, 3),
	(27, 2),
	(27, 57),
	(28, 5),
	(29, 2),
	(30, 2),
	(32, 2),
	(35, 57),
	(50, 38);
/*!40000 ALTER TABLE `students_parents` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.subjects
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.subjects: ~5 rows (approximately)
DELETE FROM `subjects`;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`subject_id`, `name`) VALUES
	(1, 'Math for 1-4,6 grades'),
	(2, 'History for 1-6 grades'),
	(3, 'rg'),
	(7, 'fdjg'),
	(8, 'Science');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.teachers
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `ssn` varchar(20) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `state` varchar(30) DEFAULT '',
  `zip_code` varchar(10) DEFAULT '',
  `home_phone` varchar(20) DEFAULT '',
  `cell_phone` varchar(20) DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `status` enum('Active','Deleted','Inactive','Resigned') DEFAULT 'Inactive',
  `avatar` varchar(100) DEFAULT 'images/no_avatar.jpg',
  PRIMARY KEY (`teacher_id`),
  KEY `Index 2` (`status`),
  KEY `Index 3` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.teachers: ~32 rows (approximately)
DELETE FROM `teachers`;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` (`teacher_id`, `name`, `birth_date`, `gender`, `ssn`, `address`, `city`, `state`, `zip_code`, `home_phone`, `cell_phone`, `email`, `status`, `avatar`) VALUES
	(1, 'Mufti Zubair', NULL, 'male', '498-18-3303', '4562 Irving Place', 'St Peters', 'MO', '63376', '636-278-9284', '636-278-9284', 'ScottMAmaya@zilorent.com', 'Active', 'avatars/f7b6e7f1dccd85cf4cb743357699fa7a.jpg'),
	(2, 'Ronald V Keller', NULL, 'male', '537-84-8955', '1852 Elliot Avenue', 'Seattle', 'WA', '98115', '206-523-3244', '206-523-3244', 'RonaldVKeller@zilorent.com', 'Deleted', 'images/no_avatar.jpg'),
	(3, 'Mildred J Bowman', NULL, 'female', '376-92-0397', '1171 Daylene Drive', 'Southfield', 'MI', '48075', '734-530-6334', '734-530-6334', 'MildredJBowman@zilorent.com', 'Deleted', 'images/no_avatar.jpg'),
	(4, 'Thomas B Lopez', NULL, 'male', '698-01-0654', '4262 White Pine Lane', 'Luray', 'VA', '22835', '540-743-5671', '540-743-5671', 'ThomasBLopez@zilorent.com', 'Deleted', 'images/no_avatar.jpg'),
	(5, 'Raul P Parrett', NULL, 'male', '026-20-3108', '4301 Kinney Street', 'Springfield', 'MA', '01103', '413-453-8255', '413-453-8255', 'RaulPParrett@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(6, 'Betty J Snow', NULL, 'female', '305-05-7415', '3567 Lucy Lane', 'Evansville', 'IN', '47708', '812-504-5737', '812-504-5737', 'BettyJSnow@zilorent.com', 'Deleted', 'images/no_avatar.jpg'),
	(7, 'Roberto M Gregg', NULL, 'male', '768-24-2749', '3131 Elkview Drive', 'West Palm Beach', 'FL', '33401', '772-320-7649', '772-320-7649', 'RobertoMGregg@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(8, 'Joe J Steele', NULL, 'male', '561-46-6446', '4574 Tenmile', 'San Diego', 'CA', '92110', '760-236-8927', '760-236-8927', 'JoeJSteele@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(9, 'William M Hartley', NULL, 'male', '631-72-2679', '2309 Clair Street', 'Rogers', 'TX', '76569', '254-642-5075', '254-642-5075', 'WilliamMHartley@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(10, 'James V Garcia', NULL, 'male', '769-09-6681', '4294 Boundary Street', 'Hastings', 'FL', '32145', '904-692-2350', '904-692-2350', 'JamesVGarcia@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(11, 'Jean S Miller', NULL, 'female', '063-68-6469', '2184 Feathers Hooves Drive', 'New York', 'NY', '10011', '631-604-3201', '631-604-3201', 'JeanSMiller@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(12, 'George J Weaver', NULL, 'male', '645-32-4892', '314 Florence Street', 'Longview', 'TX', '75601', '903-452-5015', '903-452-5015', 'GeorgeJWeaver@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(13, 'Hazel J Bolden', NULL, 'female', '659-01-2278', '1204 Roguski Road', 'Natchitoches', 'LA', '71457', '318-354-7359', '318-354-7359', 'HazelJBolden@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(14, 'Chelsea G Kingsbury', NULL, 'female', '210-48-4851', '3736 Glen Falls Road', 'Philadelphia', 'PA', '19103', '215-832-9846', '215-832-9846', 'ChelseaGKingsbury@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(15, 'Bobby M Sherman', NULL, 'male', '622-86-0785', '3940 Freed Drive', 'Stockton', 'CA', '95202', '209-678-7652', '209-678-7652', 'BobbyMSherman@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(16, 'Erin R Peck', NULL, 'female', '618-48-1599', '2961 Driftwood Road', 'San Jose', 'CA', '95118', '408-369-7928', '408-369-7928', 'ErinRPeck@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(17, 'Alison H Ellison', NULL, 'female', '174-60-9901', '158 Custer Street', 'Smethport', 'PA', '16749', '814-887-4314', '814-887-4314', 'AlisonHEllison@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(18, 'Fern M Robinson', NULL, 'female', '418-33-6496', '3346 Lonely Oak Drive', 'Mobile', 'AL', '36693', '251-656-5849', '251-656-5849', 'FernMRobinson@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(19, 'Mirna G Mitchell', NULL, 'female', '770-30-4177', '2528 American Drive', 'Panama City', 'FL', '32401', '850-896-2239', '850-896-2239', 'MirnaGMitchell@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(20, 'Joanne A Garcia', NULL, 'female', '680-44-7903', '538 Wescam Court', 'Washoe', 'NV', '89701', '775-849-8623', '775-849-8623', 'JoanneAGarcia@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(21, 'Susan C Eaton', NULL, 'female', '430-35-4877', '404 Barrington Court', 'Little Rock', 'AR', '72201', '870-594-0239', '870-594-0239', 'SusanCEaton@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(22, 'Anne S Westbrook', NULL, 'female', '042-02-0624', '3400 Meadow View Drive', 'Hartford', 'CT', '06103', '860-512-2381', '860-512-2381', 'AnneSWestbrook@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(23, 'Ruby R Fouts', NULL, 'female', '276-92-0923', '2942 Langtown Road', 'Margaretta (Township)', 'OH', '44824', '567-278-1272', '567-278-1272', 'RubyRFouts@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(24, 'Robert H Culver', NULL, 'male', '215-39-4444', '3035 Calvin Street', 'Baltimore', 'MD', '21202', '443-347-9135', '443-347-9135', 'RobertHCulver@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(25, 'Michele K Wooldridge', NULL, 'female', '653-09-2615', '1047 Clover Drive', 'Pueblo', 'CO', '81008', '719-281-3261', '719-281-3261', 'MicheleKWooldridge@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(26, 'Gloria J Hazelwood', NULL, 'female', '455-63-1881', '1097 Hall Place', 'Paris', 'TX', '75460', '903-784-9038', '903-784-9038', 'GloriaJHazelwood@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(27, 'Margaret J Dawson', NULL, 'female', '459-30-7038', '2831 Roane Avenue', 'Houston', 'TX', '77011', '281-992-8211', '281-992-8211', 'MargaretJDawson@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(28, 'Lloyd P Lee', NULL, 'male', '223-86-1893', '4801 Golf Course Drive', 'Centerville', 'VA', '22020', '703-378-7477', '703-378-7477', 'LloydPLee@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(29, 'Susanna J Avery', NULL, 'female', '153-11-0284', '3274 Finwood Road', 'Englishtown', 'NJ', '07726', '732-446-7818', '732-446-7818', 'SusannaJAvery@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(30, 'Steve B Regalado', NULL, 'male', '307-78-6807', '2448 Sand Fork Road', 'Twelve Mile', 'IN', '46988', '574-664-5209', '574-664-5209', 'SteveBRegalado@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(31, 'أَبْجَدِيَّة عَرَبِيَّة', NULL, 'male', '', '', '', '', '', '', '', 'ishevchuk@zilorent.com', 'Inactive', 'images/no_avatar.jpg'),
	(32, 'Test', '1982-03-03', 'male', '889', 'test', 'test', 'Dubai', '1234', '234234234', '234234234', 'pardeep@therootsint.com', 'Inactive', 'images/no_avatar.jpg');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.teachers_comments
DROP TABLE IF EXISTS `teachers_comments`;
CREATE TABLE IF NOT EXISTS `teachers_comments` (
  `lesson_id` int(10) unsigned DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `rating` tinyint(3) unsigned DEFAULT NULL,
  `comment` varchar(400) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  UNIQUE KEY `Index 3` (`lesson_id`,`student_id`),
  KEY `Index 2` (`teacher_id`,`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.teachers_comments: ~8 rows (approximately)
DELETE FROM `teachers_comments`;
/*!40000 ALTER TABLE `teachers_comments` DISABLE KEYS */;
INSERT INTO `teachers_comments` (`lesson_id`, `teacher_id`, `student_id`, `rating`, `comment`, `date_added`) VALUES
	(27, 1, 32, 5, 'dfghjdfgh', '2013-07-28 20:29:55'),
	(28, 1, 32, 5, 'dfghfsdg', '2013-07-28 20:32:08'),
	(20, 1, 32, 5, 'sdfghd', '2013-07-28 20:34:42'),
	(20, 1, 31, 5, '', '2013-07-28 22:08:43'),
	(22, 1, 31, 5, '', '2013-07-28 22:09:33'),
	(23, 1, 31, 5, 'fgh', '2013-07-28 22:16:28'),
	(26, 1, 31, 5, 'shdfg', '2013-07-28 22:16:43'),
	(21, 1, 32, 3, 'feedback by student', '2013-08-07 10:40:07');
/*!40000 ALTER TABLE `teachers_comments` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.teacher_subjects
DROP TABLE IF EXISTS `teacher_subjects`;
CREATE TABLE IF NOT EXISTS `teacher_subjects` (
  `subject_id` int(10) unsigned DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `grade_id` tinyint(3) unsigned DEFAULT NULL,
  KEY `Index 1` (`subject_id`,`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.teacher_subjects: ~45 rows (approximately)
DELETE FROM `teacher_subjects`;
/*!40000 ALTER TABLE `teacher_subjects` DISABLE KEYS */;
INSERT INTO `teacher_subjects` (`subject_id`, `teacher_id`, `grade_id`) VALUES
	(4, 22, 2),
	(4, 23, 3),
	(3, 17, 2),
	(3, 6, 2),
	(7, 6, 1),
	(7, 22, 1),
	(1, 1, 2),
	(1, 1, 4),
	(1, 1, 5),
	(1, 1, 7),
	(1, 22, 2),
	(1, 22, 4),
	(1, 22, 5),
	(1, 22, 7),
	(1, 29, 2),
	(1, 29, 4),
	(1, 29, 5),
	(1, 29, 7),
	(1, 30, 2),
	(1, 30, 4),
	(1, 30, 5),
	(1, 30, 7),
	(2, 4, 2),
	(2, 4, 4),
	(2, 4, 5),
	(2, 4, 6),
	(2, 4, 7),
	(2, 5, 2),
	(2, 5, 4),
	(2, 5, 5),
	(2, 5, 6),
	(2, 5, 7),
	(2, 21, 2),
	(2, 21, 4),
	(2, 21, 5),
	(2, 21, 6),
	(2, 21, 7),
	(2, 1, 2),
	(2, 1, 4),
	(2, 1, 5),
	(2, 1, 6),
	(2, 1, 7),
	(8, 32, 2),
	(8, 32, 4),
	(8, 32, 6);
/*!40000 ALTER TABLE `teacher_subjects` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(20) DEFAULT 'paypal',
  `token` varchar(80) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payer_id` varchar(50) DEFAULT NULL,
  `title` varchar(400) DEFAULT NULL,
  `quantity` tinyint(3) unsigned DEFAULT NULL,
  `sum` double unsigned DEFAULT NULL,
  `transaction_code` varchar(300) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `transaction_type` varchar(10) DEFAULT 'payment',
  `fee_id` mediumint(10) unsigned DEFAULT NULL,
  `is_subscription` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`transaction_id`),
  KEY `Index 2` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.transactions: ~56 rows (approximately)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`transaction_id`, `source`, `token`, `status`, `payer_id`, `title`, `quantity`, `sum`, `transaction_code`, `payment_date`, `transaction_type`, `fee_id`, `is_subscription`) VALUES
	(1, 'paypal', 'EC-0LY95917BK977683V', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Ida D Black)', 1, 2, '3J774174L9761511N', '2013-06-27 10:06:36', 'payment', NULL, 0),
	(2, 'paypal', 'EC-48X017582D062564L', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Ida D Black)', 1, 2, '9GF35746AU9834345', '2013-06-27 10:39:13', 'payment', NULL, 0),
	(3, 'paypal', 'EC-6EC81919HL194343G', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '12U276950B495063S', '2013-06-27 10:44:57', 'payment', NULL, 0),
	(4, 'paypal', 'EC-6KB201457M655371X', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '0B245200KH215672X', '2013-06-27 10:46:19', 'payment', NULL, 0),
	(5, 'paypal', 'EC-14W04408DR990252D', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '93R75738BP0776733', '2013-06-27 11:25:48', 'payment', NULL, 0),
	(6, 'paypal', 'EC-20266914SB6200043', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '84R34624GY999504Y', '2013-06-27 12:05:38', 'payment', NULL, 0),
	(7, 'paypal', 'EC-7SW158527B8778049', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '3MR93901GE4050343', '2013-06-27 12:06:39', 'payment', NULL, 0),
	(8, 'paypal', 'EC-4X194228D9948174W', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Delores J Brown)', 1, 2, '3RG32556111503254', '2013-06-27 13:13:46', 'payment', NULL, 0),
	(9, 'paypal', 'EC-5C611361VD8384907', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Loren M. Kim)', 1, 2, '1FT50085KF458850D', '2013-06-27 13:20:50', 'payment', NULL, 0),
	(10, 'paypal', 'EC-7H2639127E977881T', 'Pending', 'HPLNEJ8WQ5M9U', 'Charge for new books', 1, 500, '63Y1505918990041G', '2013-06-27 13:25:05', 'payment', NULL, 0),
	(11, 'paypal', 'EC-65E210578K5061800', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-03 15:46:06', 'payment', NULL, 0),
	(12, 'paypal', 'EC-7NN7067397106080A', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-26 16:04:28', 'payment', NULL, 0),
	(13, 'paypal', 'EC-0SD325732F6440411', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-26 16:16:52', 'payment', NULL, 0),
	(14, 'paypal', 'EC-80C7525428156484P', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-26 16:17:08', 'payment', NULL, 0),
	(15, 'paypal', 'EC-54F48143UE907294K', 'Pending', 'HPLNEJ8WQ5M9U', NULL, NULL, 100, '20R37311UC534945H', '2013-07-26 16:29:58', 'payment', NULL, 0),
	(16, 'paypal', 'EC-66G155392Y121563G', 'Pending', 'HPLNEJ8WQ5M9U', 'test', 1, 100, '3Y816772GD7961705', '2013-07-26 16:35:07', 'payment', NULL, 0),
	(17, 'paypal', 'EC-199479075C014144S', 'Pending', 'HPLNEJ8WQ5M9U', 'test', 1, 100, '1DM68444PP4756716', '2013-07-26 16:37:33', 'payment', NULL, 0),
	(18, 'paypal', 'EC-3EA96494F1449953C', 'Pending', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade (Dennis M Hayes,Ida D Black,Delores J Brown)', 3, 6, '4G9537039H088543U', '2013-07-26 16:39:56', 'payment', NULL, 0),
	(56, '2checkout', '5943f793df0bdf925a0b6660188412579660139f', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 12:22:21', 'payment', NULL, 0),
	(57, '2checkout', '14E3BE11CD3582B965D8C7EA3D6A71DB1D2', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 12:24:48', 'payment', NULL, 0),
	(58, '2checkout', '53F8495BBA35CC97A0B79BE5EBF52E834F1', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 12:25:22', 'payment', NULL, 0),
	(59, '2checkout', 'B07FD549BCA5F54B7AD4EC8EC29FB2C5CAF', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 12:25:59', 'payment', NULL, 0),
	(60, '2checkout', 'EE17AE3FE09F464C9C2A8051522951B7997', 'Deposited', '4431280767', 'Deposit for open customer offers(10 offers)', 1, 10, '4431280761', '2013-07-27 12:28:53', 'payment', NULL, 0),
	(61, 'paypal', 'EC-54B37193HG360931C', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:34:08', 'payment', NULL, 0),
	(62, '2checkout', 'A2772DD8B7A1FE9E8A426A5746ED20B2945', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:34:34', 'payment', NULL, 0),
	(63, '2checkout', '91B0ABD28E77D1E4AD3022AE6994DD1EE46', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:37:44', 'payment', NULL, 0),
	(64, '2checkout', 'B5AA842DD39BCD9DE7EA02702F1544F8DBB', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:38:18', 'payment', NULL, 0),
	(65, '2checkout', '975AECBC649A2F007530E3FA331B78EF909', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:38:30', 'payment', NULL, 0),
	(66, '2checkout', '104CB93FF2DAFF8B7A21F90FFDDE7E678E5', NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-27 15:38:49', 'payment', NULL, 0),
	(78, 'paypal', 'EC-7DW87254LS276445M', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 13:29:39', 'payment', NULL, 0),
	(79, '2checkout', '43BF4F781D2D167A72B4D490D37790AE733', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 13:29:58', 'payment', NULL, 0),
	(80, '2checkout', '07B0C0E18BE1B725C082BA8663294678CE4', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 13:31:19', 'payment', NULL, 0),
	(81, '2checkout', 'A98DD57324B303C3F1633CE6BEDB953A0E4', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 13:34:58', 'payment', NULL, 0),
	(82, '2checkout', '0D48B33BF86D7966A6EE990E8558FF7F832', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 13:36:46', 'payment', NULL, 0),
	(83, '2checkout', '02F623693DA9B826FD8956C707E7462D389', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01 23:11:27', 'payment', NULL, 0),
	(84, 'paypal', 'EC-2Y905255D0335862L', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:22:33', 'payment', NULL, 0),
	(85, 'paypal', 'EC-0RS66975GK209040A', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:23:10', 'payment', NULL, 0),
	(86, 'paypal', 'EC-233694686C8993119', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:23:22', 'payment', NULL, 0),
	(87, 'paypal', 'EC-9SN00716P98446545', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:23:42', 'payment', NULL, 0),
	(88, '2checkout', '7C86757617189B7E10BC0870CF7F1A029D7', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:24:02', 'payment', NULL, 0),
	(89, '2checkout', 'BF027F95C93074F226319F92CFC0FAA9F44', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 00:24:16', 'payment', NULL, 0),
	(90, '2checkout', '446CECCDC86C16B12C6248B1FB021CD5DB6', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 10:14:40', 'payment', NULL, 0),
	(91, 'paypal', 'EC-6MF29436EG177794E', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-02 10:26:25', 'payment', NULL, 0),
	(92, 'paypal', 'EC-7XY90553E5086714F', 'Pending', 'HPLNEJ8WQ5M9U', 'Charge for new books', 1, 192.6, '1TC652636W353530P', '2013-08-02 10:46:23', 'payment', NULL, 0),
	(93, 'paypal', 'EC-4JT57711LE970254V', 'Pending', 'HPLNEJ8WQ5M9U', NULL, NULL, 192.6, '9PG16084R6326603R', '2013-08-02 11:22:02', 'payment', NULL, 0),
	(94, 'paypal', 'EC-5PA97481FW791174G', 'Pending', 'HPLNEJ8WQ5M9U', 'Charge for new books', 1, 192.6, '82347075SB960270W', '2013-08-02 11:25:06', 'payment', NULL, 0),
	(95, 'paypal', 'EC-0A164386N1789590S', 'Pending', 'HPLNEJ8WQ5M9U', 'Charge for new books', 1, 192.6, '29N36467VH401861D', '2013-08-02 11:26:21', 'payment', NULL, 0),
	(96, 'paypal', 'EC-80E932569U9433624', 'Pending', 'HPLNEJ8WQ5M9U', 'test', 1, 60, '44U30515MY675942F', '2013-08-02 11:29:21', 'payment', NULL, 0),
	(97, 'paypal', 'EC-3P711832NU6056146', 'Pending', 'HPLNEJ8WQ5M9U', 'test', 1, 60, '8YC86132K3076115T', '2013-08-02 11:34:48', 'payment', NULL, 0),
	(98, 'paypal', 'EC-2CW445641A3420817', 'Pending', 'HPLNEJ8WQ5M9U', 'Charge for new books', 1, 192.6, '7G743590HR438162K', '2013-08-02 11:35:26', 'payment', NULL, 0),
	(99, 'paypal', 'EC-8UN19384C18978114', 'Completed', 'HPLNEJ8WQ5M9U', 'Subscription payment for the 1st Grade', 1, 1.2, '3HD624147Y418224A', '2013-08-02 11:36:27', 'payment', NULL, 0),
	(105, 'Manual', '0', 'Completed', NULL, NULL, NULL, 2, '0', '2013-08-02 15:21:55', 'payment', NULL, 0),
	(106, 'Manual', '0', 'Completed', NULL, NULL, NULL, 2, '0', '2013-08-02 15:24:56', 'payment', NULL, 0),
	(107, '2checkout', '225382B0439C64B6EAEAD709C3C3312A170', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-03 11:40:41', 'payment', NULL, 0),
	(108, '2checkout', '62A8607D1B764F1D8B9CF42DB85F95A8798', 'Completed', NULL, NULL, NULL, NULL, NULL, '2013-08-06 14:21:45', 'payment', NULL, 0),
	(109, 'Manual', '0', 'Completed', NULL, NULL, NULL, 2, '0', '2013-08-06 15:04:15', 'payment', NULL, 0);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;


# Dumping structure for table zilore01_school2.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_password` varchar(300) DEFAULT '',
  `password_salt` varchar(20) DEFAULT '',
  `name` varchar(150) DEFAULT '',
  `user_email` varchar(60) DEFAULT '',
  `is_active` tinyint(3) unsigned DEFAULT '1',
  `person_type` varchar(15) DEFAULT 'teacher',
  `person_id` int(10) unsigned DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `Index 2` (`user_email`),
  KEY `Index 3` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

# Dumping data for table zilore01_school2.users: ~6 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_password`, `password_salt`, `name`, `user_email`, `is_active`, `person_type`, `person_id`, `last_login`, `last_logout`) VALUES
	(1, '9f5308766f84cf8ac112257823930dc33005c6e7bf54e01745ef297b593771f8c45e9161292cb7c0787412976aefe045d9adcf9ceb8d9b40fbc0387dc51f3d48', '545890195606954', 'Loren M. Kim', 'LorenM.Kim@zilorent.com', 1, 'student', 32, '2013-08-14 12:40:12', NULL),
	(2, 'fd24acad67cd8466c0d39566c2ef911642ec60833242b797cb0894d9b5425aac0373d5ef1bcade0eab481a2932622b0111c9f01146eb1193f83dc9af54266fe8', '39636be89c2eccd', 'Scott M Amaya', 'ScottMAmaya@zilorent.com', 1, 'teacher', 1, '2013-08-12 13:27:28', '2013-08-12 13:38:39'),
	(4, '91f3907a6b74aaed72db28c5f4ccc0922aeb847e7fdeb23fd5720414142f055a892fe5869c875b152bcd1f57917065285a193e2361d12addad7d2e6d2c5f4394', 'af8bb045e34604d', 'Raul P Parrett', 'RaulPParrett@zilorent.com', 1, 'teacher', 5, '2013-07-03 15:46:38', NULL),
	(6, '9f5308766f84cf8ac112257823930dc33005c6e7bf54e01745ef297b593771f8c45e9161292cb7c0787412976aefe045d9adcf9ceb8d9b40fbc0387dc51f3d48', '545890195606954', 'Justin M Wyatt', 'JustinMWyatt@zilorent.com', 1, 'parent', 2, '2013-08-14 12:39:55', NULL),
	(7, '9fb811baedb0be8430d646abf1139942082a5d492171f1ec0c682ca606c1896b848e9800bdb8b8ca50994ba3654a75cd40d1794e2aa98f910df3db6f925c47bd', 'b1f42e3b85d7122', 'er', 'dfd@zilorent.com', 1, 'student', 31, '2013-07-28 20:59:14', '2013-07-28 22:18:40'),
	(8, '61f844e3067b76747ad4fe5dc3bda1907e02ddbef219bbfdce1ef09750ba771504d916e544126d19c6e441431a6c39479a333b55b81c67b8123f27f8b1d77c81', '64d5899dbb19864', 'Test', 'donor@zilorent.com', 1, 'donor', 1, '2013-08-13 13:41:42', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
