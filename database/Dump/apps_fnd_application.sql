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
-- Table structure for table `fnd_application`
--

DROP TABLE IF EXISTS `fnd_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fnd_application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FND_APPLICATION_TL stores translated information about all the applications registered with Oracle Application Object Library. Each row includes the language the row is translated to, the name and description of the application, and the application identifier which uniquely identifies the application. You need one row for each application in each of the installed languages.',
  `menu_id` int(11) NOT NULL,
  `application_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `application_short_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `basepath` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `need_authentication` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `enabled` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `created_by` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_update_by` int(11) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  UNIQUE KEY `application_short_name_UNIQUE` (`application_short_name`),
  UNIQUE KEY `basepath_UNIQUE` (`basepath`),
  UNIQUE KEY `application_name_UNIQUE` (`application_name`),
  KEY `created_by_fk_idx` (`created_by`),
  KEY `last_update_by_fk_idx` (`last_update_by`),
  CONSTRAINT `created_by_fk_a` FOREIGN KEY (`created_by`) REFERENCES `fnd_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `last_update_by_fk_a` FOREIGN KEY (`last_update_by`) REFERENCES `fnd_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnd_application`
--

LOCK TABLES `fnd_application` WRITE;
/*!40000 ALTER TABLE `fnd_application` DISABLE KEYS */;
INSERT INTO `fnd_application` VALUES (1,1,'Main','main','main','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(2,0,'Login','login','login','1.0.0','HUSZANAI','istvan.szana@ni.com','N','Y',1,'2016-06-26 00:00:00',NULL,NULL),(3,8,'Server Management','server_management','ServerManagement','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(4,9,'Database Management','database_management','DatabaseManagement','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(5,10,'Manage User','manage_user','ManageUser','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(6,11,'Manage Responsibility','manage_responsibility','ManageResponsibility','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(7,12,'Responsibility Lookups','responsibility_lookups','ResponsibilityLookup','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(8,13,'Metadata','metadata','metadata','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(9,4,'Plugins List','plugins_list','PluginsList','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(10,5,'Module List','module_list','ModuleList','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(11,6,'Install Plugin','install_plugin','InstallPlugin','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL),(12,7,'Install Module','install_module','InstallModule','1.0.0','HUSZANAI','istvan.szana@ni.com','Y','Y',1,'2016-06-26 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `fnd_application` ENABLE KEYS */;
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
