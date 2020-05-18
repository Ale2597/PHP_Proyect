/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - becasphp_final
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

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `admin_id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apelldo1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `admins` */

insert  into `admins`(`admin_id`,`nombre`,`apelldo1`,`apellido2`,`email`,`pass`,`telefono`,`status`) values 
(1,'Aixa','Ramírez','Toledo','aixa.ramirez@upr.edu','1234',2147483647,'activo'),
(2,'Hiram','Vera','Mercado','hiram.vera@upr.edu','1234',2147483647,'activo'),
(3,'Alejandro','Zeno','Miranda','alejandro.zeno@upr.edu','1234',2147483647,'activo'),
(4,'Gabriel X.','Ferrer','Torres','gabriel.ferrer@upr.edu','1234',2147483647,'activo');

/*Table structure for table `becas` */

DROP TABLE IF EXISTS `becas`;

CREATE TABLE `becas` (
  `beca_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_beca` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fondo_beca` int(5) unsigned NOT NULL,
  `tope_beca` int(3) unsigned NOT NULL,
  `balance_beca` int(5) unsigned NOT NULL,
  `promedio_min` float(3,2) unsigned NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`beca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `becas` */

insert  into `becas`(`beca_id`,`nombre_beca`,`fondo_beca`,`tope_beca`,`balance_beca`,`promedio_min`,`status`) values 
(1,'Beca Auxiliar',1000000,1000,1000000,0.00,'activa'),
(2,'Beca Legislativa',200000,200,200000,0.00,'activa'),
(3,'Beca FSEOG',1000000,1000,1000000,3.00,'activa'),
(4,'Programa ACG',1000000,750,1000000,3.50,'activa'),
(5,'Programa SMART',1000000,2000,1000000,3.50,'activa'),
(6,'Beca Staying Alive',100000,750,100000,0.00,'activa'),
(7,'Beca Educacional',150000,500,150000,0.00,'activa'),
(8,'Beca CCOM',100000,300,100000,3.00,'activa'),
(9,'Beca ADEM',100000,300,100000,3.00,'activa'),
(10,'Beca BIOL',100000,300,100000,3.00,'activa');

/*Table structure for table `becas_departamento` */

DROP TABLE IF EXISTS `becas_departamento`;

CREATE TABLE `becas_departamento` (
  `beca_id` int(2) unsigned NOT NULL,
  `depto_id` int(2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `becas_departamento` */

insert  into `becas_departamento`(`beca_id`,`depto_id`) values 
(8,7),
(9,10),
(10,8);

/*Table structure for table `depto` */

DROP TABLE IF EXISTS `depto`;

CREATE TABLE `depto` (
  `depto_id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_depto` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`depto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `depto` */

insert  into `depto`(`depto_id`,`nombre_depto`) values 
(1,'Español'),
(2,'Inglés'),
(3,'Matemáticas'),
(4,'Ciencias Sociales'),
(5,'Humanidades'),
(6,'Física Química'),
(7,'Ciencias de Cómputos'),
(8,'Biología'),
(9,'Comunicación Tele-Radial'),
(10,'Administración de Empresas'),
(11,'Enfermería'),
(12,'Educación'),
(13,'Gerencia de Tecnologías de Información y Procesos Administrativos');

/*Table structure for table `estudiantes` */

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `est_id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `depto_id` int(2) NOT NULL,
  `promedio` float(3,2) unsigned NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`est_id`),
  UNIQUE KEY `UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudiantes` */

insert  into `estudiantes`(`est_id`,`nombre`,`apellido1`,`apellido2`,`depto_id`,`promedio`,`email`) values 
(1,'Alejandro','Zeno','Miranda',7,3.80,'alejandro.zeno@upr.edu'),
(2,'Hiram','Vera','Mercado',7,3.90,'hiram.vera@upr.edu'),
(3,'Gabriel X.','Ferrer','Torres',7,3.85,'gabriel.ferrer@upr.edu'),
(4,'Hector','Pérez','Rivera',1,3.50,'hector.perez@upr.edu'),
(5,'Julia','Tosado','Nuñez',2,3.64,'julia.tosado@upr.edu'),
(6,'Karla','Martínez','Padín',3,3.87,'karla.martinez@upr.edu'),
(7,'Marcos','Toledo','Villanueva',4,3.40,'marcos.toledo@upr.edu'),
(8,'Kevin O.','Colón','Gutiérrez',5,3.63,'kevin.colon@upr.edu'),
(9,'Julio','Camacho','Chacón',6,3.90,'julio.camacho@upr.edu'),
(10,'Arturo','González','Matos',8,3.20,'arturo.gonzalez@upr.edu'),
(11,'Carmen','Hernández','Jiménez',9,3.29,'carmen.hernandez@upr.edu'),
(12,'Orlando','Acevedo','Serrano',10,3.73,'orlando.acevedo@upr.edu'),
(13,'María','Pedraza','Acuña',11,3.69,'maria.pedraza@upr.edu'),
(14,'Paola','Curbelo','Del Valle',12,3.70,'paola.curbelo@upr.edu'),
(15,'Mirelis','Figueroa','Rodríguez',13,3.86,'mirelis.figueroa@upr.edu'),
(16,'Aixa','Ramírez','Toledo',7,3.90,'aixa.ramirez@upr.edu'),
(17,'Roberto','Amador','Peña',7,3.70,'roberto.amador@upr.edu');

/*Table structure for table `solicitud` */

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `sol_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) NOT NULL,
  `beca_id` int(2) unsigned NOT NULL,
  `fecha_sol` date NOT NULL,
  `actividad` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(3) DEFAULT NULL,
  `fecha_actividad` date NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_aprobada` int(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`sol_id`),
  KEY `solicitud_ibfk_1` (`beca_id`),
  KEY `solicitud_ibfk_2` (`user_id`),
  CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`beca_id`) REFERENCES `becas` (`beca_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `solicitud` */

insert  into `solicitud`(`sol_id`,`user_id`,`beca_id`,`fecha_sol`,`actividad`,`costo`,`fecha_actividad`,`status`,`cantidad_aprobada`) values 
(1,4,8,'2020-05-01','Materiales',200,'2020-05-18','pendiente',NULL),
(2,5,9,'2020-05-28','Matricula',300,'2020-05-18','pendiente',NULL),
(3,2,10,'2020-05-07','Proroga',300,'2020-05-18','pendiente',NULL),
(4,1,4,'2020-05-10','Tutorias',300,'2020-05-18','otorgada',NULL),
(5,3,2,'2020-05-22','Taller de Señas',100,'2020-05-18','otorgada',NULL),
(6,6,1,'2020-05-13','Interes Propio',1000,'2020-05-18','denegada',NULL);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`email`) REFERENCES `estudiantes` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`user_id`,`email`,`pass`,`tel`,`status`) values 
(1,'hector.perez@upr.edu','1234','7871234567','Activo'),
(2,'arturo.gonzalez@upr.edu','1234','7877456123','Activo'),
(3,'paola.curbelo@upr.edu','1234','7872589632','Activo'),
(4,'roberto.amador@upr.edu','1234','7879632587','Activo'),
(5,'orlando.acevedo@upr.edu','1234','9396547896','Activo'),
(6,'karla.martinez@upr.edu','1234','9396582147','Activo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
