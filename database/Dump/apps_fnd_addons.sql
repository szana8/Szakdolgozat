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
-- Table structure for table `fnd_addons`
--

DROP TABLE IF EXISTS `fnd_addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fnd_addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `vendor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnd_addons`
--

LOCK TABLES `fnd_addons` WRITE;
/*!40000 ALTER TABLE `fnd_addons` DISABLE KEYS */;
INSERT INTO `fnd_addons` VALUES (1,1,'adldap','adLDAP is a PHP class that provides LDAP authentication and integration with Active Directory.','2.1','frameworks\\adldap\\src\\adLDAP.php','adLDAP','Y'),(2,1,'fpdf','Provide a PHP class, which allows to generate PDF files without using the PDFlib library.','1.7','frameworks\\fpdf\\fpdf.php','fpdf','Y'),(3,1,'phpexcel','PHPExcel - OpenXML - Read, Write and Create Excel documents in PHP - Spreadsheet engine','1.7.6','frameworks\\phpexcel\\PHPExcel.php','phpExcel','Y'),(4,1,'phpmailer','The classic email sending library for PHP. ','5.1','frameworks\\phpmailer\\class.phpmailer.php','phpMailer','Y'),(5,1,'wideimage','WideImage is an object-oriented library for image manipulation. It requires PHP 5.2+ with GD2 extension.','11.02.19','frameworks\\wideimage\\WideImage.php','wideimage','Y'),(6,2,'jquery','jQuery is a fast, small, and feature-rich JavaScript library. It makes things like HTML document traversal and manipulation, event handling, animation, and Ajax much simpler with an easy-to-use API that works across a multitude of browsers. With a combination of versatility and extensibility, jQuery has changed the way that millions of people write JavaScript.','1.11.1','frameworks\\jquery\\jquery-1.11.1.min.js','jquery','Y'),(7,2,'jqueryui','Official jQuery user interface library. It provides interactions, widgets, effects, and theming for creating Rich Internet Applications.','1.11.4','frameworks\\jquery-ui-1.11.4\\jquery-ui.min.js','jqueryUI','Y'),(8,2,'bootstrap','Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.','3.3.6','frameworks\\bootstrap-3.3.6-dist\\js\\bootstrap.min.js','bootstrap','Y'),(9,2,'gojs','GoJS is a JavaScript library for building interactive diagrams on HTML web pages. Build apps with flowcharts, org charts, BPMN, UML, modeling, and other.','1.5.22','frameworks\\gojs\\go.js','gojs','Y'),(10,2,'godebug','The GoJS library comes in both \"debug\" and \"release\" variations in the release.','1.5.22','frameworks\\gojs\\go-debug.js','godebug','Y'),(11,2,'dropzone','DropzoneJS is an open source library that provides drag’n’drop file uploads with image previews.','1.0','frameworks\\dropzone\\dropzone.min.js','dropzone','Y'),(12,2,'formvalidator','jQuery Form Validator is a feature rich and multilingual jQuery plugin that makes it easy to validate user input while keeping your HTML markup clean from','0.5.0dev','frameworks\\formvalidator\\js\\bootstrapValidator.js','formValidator','Y'),(13,2,'fullcalendar','FullCalendar is a drag-n-drop jQuery plugin for displaying events on a full-sized calendar.','2.2.6','frameworks\\fullcalendar-2.2.6\\fullcalendar.min.js','fullcalendar','Y'),(14,3,'jqueryui','Official jQuery user interface library. It provides interactions, widgets, effects, and theming for creating Rich Internet Applications.','1.11.4','frameworks\\jquery-ui-1.11.4\\jquery-ui.min.css','jqueryUI','Y'),(15,3,'bootstrap','Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.','3.3.6','frameworks\\bootstrap-3.3.6-dist\\js\\bootstrap.min.css','bootstrap','Y'),(16,3,'dropzone','DropzoneJS is an open source library that provides drag’n’drop file uploads with image previews.','1.0','frameworks\\dropzone\\dropzone.min.css','dropzone','Y'),(17,3,'formvalidator','jQuery Form Validator is a feature rich and multilingual jQuery plugin that makes it easy to validate user input while keeping your HTML markup clean from','0.5.0dev','frameworks\\formvalidator\\js\\bootstrapValidator.css','formValidator','Y'),(18,3,'fullcalendar','FullCalendar is a drag-n-drop jQuery plugin for displaying events on a full-sized calendar.','2.2.6','frameworks\\fullcalendar-2.2.6\\fullcalendar.min.css','fullcalendar','Y');
/*!40000 ALTER TABLE `fnd_addons` ENABLE KEYS */;
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
