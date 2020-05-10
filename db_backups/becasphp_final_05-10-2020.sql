/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - becasphp_final
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`becasphp_final` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `becasphp_final`;

/*Table structure for table `becas` */

DROP TABLE IF EXISTS `becas`;

CREATE TABLE `becas` (
  `beca_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_beca` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fondo_beca` int(5) unsigned NOT NULL,
  `tope_beca` int(3) unsigned NOT NULL,
  `balance_beca` int(5) unsigned NOT NULL,
  `promedio_min` float(3,2) unsigned NOT NULL,
  PRIMARY KEY (`beca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `becas` */

/*Table structure for table `depto` */

DROP TABLE IF EXISTS `depto`;

CREATE TABLE `depto` (
  `depto_id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_depto` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`depto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `depto` */

/*Table structure for table `estudiantes` */

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `est_id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `depto_id` int(2) NOT NULL,
  `promedio` float(3,2) unsigned NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudiantes` */

/*Table structure for table `solicitud` */

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `sol_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) NOT NULL,
  `beca_id` int(2) NOT NULL,
  `fecha_sol` date NOT NULL,
  `actividad` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(3) DEFAULT NULL,
  `fecha_actividad` date NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `solicitud` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
