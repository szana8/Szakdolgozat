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
-- Table structure for table `fnd_lookups`
--

DROP TABLE IF EXISTS `fnd_lookups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fnd_lookups` (
  `lookup_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Lookups in applications are used to represent a set of codes and their translated meanings. For example, a product team might store the values ''Y'' and ''N'' in a column in a table, but when displaying those values they would want to display "Yes" or "No" (or their translated equivalents) instead. Each set of related codes is identified as a lookup type.',
  `lookup_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lookup_value` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` int(11) NOT NULL,
  `meaning` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_update_by` int(11) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `enabled_flag` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`lookup_id`),
  UNIQUE KEY `lookup_type_UNIQUE` (`lookup_type`),
  KEY `created_by_fk_idx` (`created_by`),
  KEY `last_update_by_idx` (`last_update_by`),
  KEY `lookup_application_fk_idx` (`application_id`),
  CONSTRAINT `created_by_fk_lk` FOREIGN KEY (`created_by`) REFERENCES `fnd_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `last_update_by_lk` FOREIGN KEY (`last_update_by`) REFERENCES `fnd_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lookup_application_fk` FOREIGN KEY (`application_id`) REFERENCES `fnd_application` (`application_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnd_lookups`
--

LOCK TABLES `fnd_lookups` WRITE;
/*!40000 ALTER TABLE `fnd_lookups` DISABLE KEYS */;
INSERT INTO `fnd_lookups` VALUES (1,'APP_NAME','APPLICATION_NAME',1,'Jira','Name of the application',1,'2016-04-16 08:00:00',NULL,NULL,'Y'),(2,'APP_VER','APPLICATION_VERSION',1,'1.0.0','Version of the application',1,'2016-04-16 08:00:00',NULL,NULL,'Y'),(3,'APP_EMAL_NOTIFICATIONS','EMAIL_NOTIFICATIONS',1,'TRUE','Enable or Disable the email notifications',1,'2016-05-21 10:00:00',NULL,NULL,'Y');
/*!40000 ALTER TABLE `fnd_lookups` ENABLE KEYS */;
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
