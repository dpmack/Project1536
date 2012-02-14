CREATE DATABASE  IF NOT EXISTS `a5621243_staging` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `a5621243_staging`;

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

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL AUTO_INCREMENT,
  `courseCode` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `courseName` varchar(128) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1536,2,'Web Development'),(2,1510,2,'Programming Methods');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errors` (
  `errorID` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` datetime NOT NULL,
  `alert` text COLLATE latin1_general_ci NOT NULL,
  `debug` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`errorID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `errors` WRITE;
/*!40000 ALTER TABLE `errors` DISABLE KEYS */;
/*!40000 ALTER TABLE `errors` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `salt` varchar(9) COLLATE latin1_general_ci NOT NULL,
  `ticket` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `lastActivity` time NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'David','Mack','A00802872','843bf8ffde5c433f385561b804ddf709af583d3005ebcd38e','','1329239291','00:00:00'),(2,'Kevin','McKeen','A00778394','f9a6c714cb2d4e4ce4fc6427fc6002e48c8b05fc9bf348700','','1326917225','00:00:00');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(4) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`departmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'COMM'),(2,'COMP'),(3,'BUSA');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `forumID` int(11) NOT NULL,
  `title` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `isLocked` tinyint(1) NOT NULL DEFAULT '0',
  `isSticky` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forums` (
  `forumID` int(11) NOT NULL AUTO_INCREMENT,
  `forumTitle` varchar(64) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`forumID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `homeworkID` int(11) NOT NULL AUTO_INCREMENT,
  `courseID` int(11) NOT NULL,
  `assignment` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `dueDate` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`homeworkID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
INSERT INTO `homework` VALUES (1,2,'Assignment 1',1330342400,0),(2,1,'Milestone 2',1328564264,1),(3,2,'troy sucks',149872941,0);
/*!40000 ALTER TABLE `homework` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

