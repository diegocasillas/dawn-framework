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

-- Dumping structure for table miniframework.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `author` int(11) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_posts` (`post_id`),
  CONSTRAINT `FK_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Dumping data for table miniframework.comments: ~8 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table miniframework.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `score` float NOT NULL DEFAULT '0',
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Dumping data for table miniframework.posts: ~9 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `score`, `votes`) VALUES
	(40, 2, 'Lorem Ipsum', 'Duis eu gravida sem. Nulla varius facilisis nunc, at bibendum neque egestas quis. Aenean finibus mollis mauris, vitae sagittis erat mattis at. Fusce felis ipsum, maximus ut nunc sit amet, mollis dictum odio. Praesent consectetur quis nulla eget malesuada. Curabitur condimentum tortor in sapien maximus luctus. Nullam efficitur congue enim, non convallis erat iaculis quis. Aliquam eget vestibulum turpis, non laoreet libero. Nullam sollicitudin, lectus a egestas malesuada, libero enim mattis dui, sit amet pellentesque massa diam ut odio. Fusce in justo rutrum, varius lacus sit amet, ornare nisi.', 0, 0),
	(41, 1, 'Lorem Ipsum', 'Duis eu gravida sem. Nulla varius facilisis nunc, at bibendum neque egestas quis. Aenean finibus mollis mauris, vitae sagittis erat mattis at. Fusce felis ipsum, maximus ut nunc sit amet, mollis dictum odio. Praesent consectetur quis nulla eget malesuada. Curabitur condimentum tortor in sapien maximus luctus. Nullam efficitur congue enim, non convallis erat iaculis quis. Aliquam eget vestibulum turpis, non laoreet libero. Nullam sollicitudin, lectus a egestas malesuada, libero enim mattis dui, sit amet pellentesque massa diam ut odio. Fusce in justo rutrum, varius lacus sit amet, ornare nisi.', 0, 0),
	(42, 2, 'Lorem Ipsum', 'Duis eu gravida sem. Nulla varius facilisis nunc, at bibendum neque egestas quis. Aenean finibus mollis mauris, vitae sagittis erat mattis at. Fusce felis ipsum, maximus ut nunc sit amet, mollis dictum odio. Praesent consectetur quis nulla eget malesuada. Curabitur condimentum tortor in sapien maximus luctus. Nullam efficitur congue enim, non convallis erat iaculis quis. Aliquam eget vestibulum turpis, non laoreet libero. Nullam sollicitudin, lectus a egestas malesuada, libero enim mattis dui, sit amet pellentesque massa diam ut odio. Fusce in justo rutrum, varius lacus sit amet, ornare nisi.', 0, 0),
	(43, 2, 'Lorem Ipsum', 'Duis eu gravida sem. Nulla varius facilisis nunc, at bibendum neque egestas quis. Aenean finibus mollis mauris, vitae sagittis erat mattis at. Fusce felis ipsum, maximus ut nunc sit amet, mollis dictum odio. Praesent consectetur quis nulla eget malesuada. Curabitur condimentum tortor in sapien maximus luctus. Nullam efficitur congue enim, non convallis erat iaculis quis. Aliquam eget vestibulum turpis, non laoreet libero. Nullam sollicitudin, lectus a egestas malesuada, libero enim mattis dui, sit amet pellentesque massa diam ut odio. Fusce in justo rutrum, varius lacus sit amet, ornare nisi.', 0, 0),
	(44, 2, 'Lorem Ipsum', 'Duis eu gravida sem. Nulla varius facilisis nunc, at bibendum neque egestas quis. Aenean finibus mollis mauris, vitae sagittis erat mattis at. Fusce felis ipsum, maximus ut nunc sit amet, mollis dictum odio. Praesent consectetur quis nulla eget malesuada. Curabitur condimentum tortor in sapien maximus luctus. Nullam efficitur congue enim, non convallis erat iaculis quis. Aliquam eget vestibulum turpis, non laoreet libero. Nullam sollicitudin, lectus a egestas malesuada, libero enim mattis dui, sit amet pellentesque massa diam ut odio. Fusce in justo rutrum, varius lacus sit amet, ornare nisi.', 0, 0),
	(59, 1, 'asdad', 'asdads', 0, 0),
	(60, 1, 'y otro mas', 'y ya van 20', 0, 0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table miniframework.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- Dumping data for table miniframework.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'root', '111'),
	(2, 'xdlmao', '123'),
	(52, 'diego', '111'),
	(53, 'ayyyxd', 'xd'),
	(54, 'paquitoelchocolatero', 'aasd'),
	(56, 'poki', '111');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
