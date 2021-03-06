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
-- Table structure for table `fnd_menus`
--

DROP TABLE IF EXISTS `fnd_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fnd_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL,
  `menu_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '-1',
  `enabled` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_update_by` int(11) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `menu_type_INDEX` (`menu_type`),
  KEY `menu_name_INDEX` (`menu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnd_menus`
--

LOCK TABLES `fnd_menus` WRITE;
/*!40000 ALTER TABLE `fnd_menus` DISABLE KEYS */;
INSERT INTO `fnd_menus` VALUES (1,0,1,'{APP.MENU.DASHBOARDS}',10,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(2,0,1,'{APP.MENU.SYSTEM}',20,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(3,2,2,'{APP.MENU.PLUGINS}',70,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(4,3,3,'{APP.MENU.PLUGINS_LIST}',10,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(5,3,3,'{APP.MENU.MODULE_LIST}',20,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(6,3,3,'{APP.MENU.INSTALL_PLUGIN}',30,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(7,3,3,'{APP.MENU.INSTALL_MODULE}',40,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(8,2,2,'{APP.MENU.SERVER_MANAGEMENT}',10,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(10,2,2,'{APP.MENU.MANAGE_USER}',30,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(11,2,2,'{APP.MENU.MANAGE_RESPONSIBILITY}',40,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(12,2,2,'{APP.MENU.MANAGE_RESPONSIBILITY_LOOKUP}',50,'Y',1,'2016-04-16 08:00:00',NULL,NULL),(13,2,2,'{APP.MENU.MANAGE_METADATA}',60,'Y',1,'2016-04-16 08:00:00',NULL,NULL);
/*!40000 ALTER TABLE `fnd_menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-28 18:15:43
