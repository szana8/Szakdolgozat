-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: apps
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

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
-- Table structure for table `fnd_directory_types`
--

DROP TABLE IF EXISTS `fnd_directory_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fnd_directory_types` (
  `directory_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `directory_type_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `attribute1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute8` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute9` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute10` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `last_update_by` int(11) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`directory_type_id`),
  UNIQUE KEY `directory_type_name_UNIQUE` (`directory_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnd_directory_types`
--

LOCK TABLES `fnd_directory_types` WRITE;
/*!40000 ALTER TABLE `fnd_directory_types` DISABLE KEYS */;
INSERT INTO `fnd_directory_types` VALUES (1,'Internal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-01-01 10:00:00',NULL,NULL);
/*!40000 ALTER TABLE `fnd_directory_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-28 18:15:42
