/*
SQLyog Ultimate - MySQL GUI v8.22 
MySQL - 5.5.5-10.4.28-MariaDB : Database - media
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`media` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `media`;

/*Table structure for table `mediauploads` */

DROP TABLE IF EXISTS `mediauploads`;

CREATE TABLE `mediauploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) DEFAULT NULL,
  `uplmedia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mediauploads` */

insert  into `mediauploads`(`id`,`uname`,`uplmedia`) values (2,'neildojeta','8422550.mp3'),(3,'neildojeta','871906.mp3'),(4,'neildojeta','3187070.mp4'),(5,'neildojeta','6141676.mp4');

/*Table structure for table `userinfo` */

DROP TABLE IF EXISTS `userinfo`;

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `userinfo` */

insert  into `userinfo`(`id`,`username`,`lname`,`fname`,`password`) values (1,'neildojeta','Dojeta','Neil Andrews','01232003');

/*Table structure for table `youtube` */

DROP TABLE IF EXISTS `youtube`;

CREATE TABLE `youtube` (
  `username` varchar(100) DEFAULT NULL,
  `ytvideos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `youtube` */

insert  into `youtube`(`username`,`ytvideos`) values ('neildojeta','M4Rw9frcH6M'),('neildojeta','UTMuL_86gSQ'),('neildojeta','izgp3OG7mcE');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
