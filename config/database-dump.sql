-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: passwordbank
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `passwordbank`
--

/*!40000 DROP DATABASE IF EXISTS `passwordbank`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `passwordbank` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `passwordbank`;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(20) NOT NULL,
  `emailuid` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `extra` tinytext,
  `description` tinytext,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (29,'Facebook','vitor@live.com','vitor40','','This is my fb account',3),(31,'Google','vit@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(32,'YT','vv@live.com','vit','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(33,'Twitter','vvvv@live.com','vitor33','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(34,'Twitch','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(35,'Github','vitor','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(36,'Microsoft','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(37,'Amazon','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(38,'Casas_Bahia','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: ','this is my cb account!',3),(39,'Mercado_Livre','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(40,'Evernote','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(41,'Udemy','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(42,'Linkedin','vitor@live.com','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(43,'StackOverflow','vitor','vitor','Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99','Example: This is my xyz account',3),(44,'ShopTime','vitor@live.com','vitor40','key: 231893y182H%$','This is my shoptime account',3),(45,'Facebook_2','vitor@livee.com','vitor','Example: This is my secret key to get back my account if I forget the password: ','This is my second account of fb',3);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pwd_reset_token`
--

DROP TABLE IF EXISTS `pwd_reset_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pwd_reset_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(50) NOT NULL,
  `selectorToken` text NOT NULL,
  `validatorToken` text NOT NULL,
  `expiration` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pwd_reset_token`
--

LOCK TABLES `pwd_reset_token` WRITE;
/*!40000 ALTER TABLE `pwd_reset_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `pwd_reset_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'xangdao','xangdao@live.com','$2y$10$BmmrEdvLN2M1jfs4UFKwzuBjVN09.VyT8tt9BHKSc2BxCE26xLtvW'),(2,'ueltin','ueltin@live.com','$2y$10$sSUbspi/CaaHUh3OqJTpy.wiRLfkeMm1C9r.3bd09JbrC3Gp6BYca'),(3,'Vitor','vitorsilva16@live.com','$2y$10$CeUm6Ay.PkCDLbTEkK9BS./080U5fRZbhsy7qJhlnVZLoZLE11M7a'),(4,'vitao','vitorsilva15@live.com','$2y$10$vcAL58CQEXR5ceHAjW9zau9xqntmDkePtxitiF3.VBv3Um2sh/dYS'),(5,'sfsdfsdf','fac3898@gmail.com','$2y$10$xQFioPpljbN7DQieVAuycOyMHgjFUfgk71E/hdSldturMwJsdouMG'),(7,'fsfsd','fdslfsd@live.com','$2y$10$GBZWUllF79TG3E18C8pgJeHEgZavAEFxUj91YYewwZXAT2bMTqbN6'),(8,'hello12','hello@live.com','$2y$10$MoclvNMgjNWcGp1.Eqa7I.Euzyj6fobYhiO5Uq1GakQhQjgfvleQC');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-15 11:02:38
