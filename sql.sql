-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for miniframework
CREATE DATABASE IF NOT EXISTS `miniframework` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `miniframework`;

-- Dumping structure for table miniframework.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT '0',
  `title` varchar(50) DEFAULT '0',
  `body` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table miniframework.posts: ~11 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `author`, `title`, `body`) VALUES
	(1, 'Diego', 'Mi primer post', 'AYLMAO'),
	(2, 'Diego', 'Mi primer post', 'AYLMAO'),
	(3, 'Diego', 'Mi primer post', 'AYLMAO'),
	(4, 'Diego', 'Mi primer post', 'AYLMAO'),
	(5, 'Diego', 'Mi primer post', 'AYLMAO'),
	(6, 'Diego', 'Mi primer post', 'AYLMAO'),
	(7, 'Diego', 'Mi primer post', 'AYLMAO'),
	(8, 'Diego', 'Mi primer post', 'AYLMAO'),
	(9, 'Diego', 'Mi primer post', 'AYLMAO'),
	(10, 'Diego', 'Mi primer post', 'AYLMAO'),
	(11, 'Diego', 'Mi primer post', 'AYLMAO'),
	(12, 'Diego', 'Mi primer post', 'AYLMAO');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
