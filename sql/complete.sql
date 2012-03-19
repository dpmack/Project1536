USE `csthub`;

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
-- Table structure for table `set`
--

DROP TABLE IF EXISTS `set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set` (
  `setID` int(11) NOT NULL AUTO_INCREMENT,
  `departmentID` int(11) DEFAULT NULL,
  `setName` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`setID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `set`
--

LOCK TABLES `set` WRITE;
/*!40000 ALTER TABLE `set` DISABLE KEYS */;
/*!40000 ALTER TABLE `set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setCourseMapping`
--

DROP TABLE IF EXISTS `setCourseMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setCourseMapping` (
  `setID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  PRIMARY KEY (`setID`,`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setcoursemapping`
--

LOCK TABLES `setCourseMapping` WRITE;
/*!40000 ALTER TABLE `setCourseMapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `setCourseMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `forumID` int(11) NOT NULL,
  `title` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `isLocked` tinyint(1) NOT NULL DEFAULT '0',
  `isSticky` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,1,1,'CSTHub is live',0,0);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `emailConfirmed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'David','Mack','A00802872','davidpmack@gmail.com','$6$rounds=45489$e1dd1f44b02518c4$L4Chnr2LLAyYvep.N9ORsh852KFYBgIzW01q08N38VcIVEaBU6S8uX1NdFIlwOSCh2ht0n27mEJRo8mE2LQs11',1),(2,'Kevin','McKeen','A00778394','kevmckeenis@gmail.com','$6$rounds=45489$cb258fb32c66bce1$jMihwGA3UrsszJ8ERKd1JRC3xHuQWlIjshYGJ5N2zutq0HG6SVkvgEAMH01SvelQfNYMBQ7agg20SefbeqWU0/',1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accountsCoursesMapping`
--

DROP TABLE IF EXISTS `accountsCoursesMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountsCoursesMapping` (
  `accountID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  PRIMARY KEY (`accountID`,`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accountsCoursesMapping`
--

LOCK TABLES `accountsCoursesMapping` WRITE;
/*!40000 ALTER TABLE `accountsCoursesMapping` DISABLE KEYS */;
INSERT INTO `accountsCoursesMapping` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `accountsCoursesMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whiteboards`
--

DROP TABLE IF EXISTS `whiteboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whiteboards` (
  `whiteboardID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `accountID` int(11) DEFAULT NULL,
  PRIMARY KEY (`whiteboardID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whiteboards`
--

LOCK TABLES `whiteboards` WRITE;
/*!40000 ALTER TABLE `whiteboards` DISABLE KEYS */;
INSERT INTO `whiteboards` VALUES (1,'ghjk',1);
/*!40000 ALTER TABLE `whiteboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forums`
--

DROP TABLE IF EXISTS `forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forums` (
  `forumID` int(11) NOT NULL AUTO_INCREMENT,
  `forumTitle` varchar(64) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`forumID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forums`
--

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` VALUES (1,'News'),(2,'Homework'),(3,'Courses'),(4,'Off-Topic');
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confirmationemails`
--

DROP TABLE IF EXISTS `confirmationEmails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confirmationEmails` (
  `hash` varchar(40) NOT NULL,
  `accountID` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  PRIMARY KEY (`hash`),
  UNIQUE KEY `accountID_UNIQUE` (`accountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confirmationemails`
--

LOCK TABLES `confirmationEmails` WRITE;
/*!40000 ALTER TABLE `confirmationEmails` DISABLE KEYS */;
/*!40000 ALTER TABLE `confirmationEmails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `permissionID` int(11) NOT NULL AUTO_INCREMENT,
  `permissionName` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'START_TOPIC'),(2,'REPLY'),(3,'START_TOPIC_NEWS'),(4,'CREATE_FORUM'),(5,'DELETE_REPLY'),(6,'LOGIN'),(7,'CREATE_DEPARTMENT'),(8,'EDIT_DEPARTMENT'),(9,'CREATE_COURSE'),(10,'EDIT_COURSE'),(11,'CREATE_HOMEWORK'),(12,'EDIT_HOMEWORK'),(13,'HIDE_HOMEWORK'),(14,'DELETE_HOMEWORK'),(15,'SITE_ADMINISTRATION');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `ticket` varchar(40) NOT NULL,
  `clientHash` varchar(40) NOT NULL,
  `lastActivity` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  PRIMARY KEY (`ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `errors`
--

DROP TABLE IF EXISTS `errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errors` (
  `errorID` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`errorID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `errors`
--

LOCK TABLES `errors` WRITE;
/*!40000 ALTER TABLE `errors` DISABLE KEYS */;
/*!40000 ALTER TABLE `errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accountsRolesMapping`
--

DROP TABLE IF EXISTS `accountsRolesMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountsRolesMapping` (
  `accountID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  PRIMARY KEY (`accountID`,`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accountsRolesMapping`
--

LOCK TABLES `accountsRolesMapping` WRITE;
/*!40000 ALTER TABLE `accountsRolesMapping` DISABLE KEYS */;
INSERT INTO `accountsRolesMapping` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `accountsRolesMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Disabled'),(2,'Super User'),(3,'Teacher'),(4,'Student'),(5,'Prospective Student'),(6,'Set Rep'),(7,'Banned');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homeworkAccountMapping`
--

DROP TABLE IF EXISTS `homeworkAccountMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homeworkAccountMapping` (
  `homeworkID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  PRIMARY KEY (`homeworkID`,`accountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homeworkAccountMapping`
--

LOCK TABLES `homeworkAccountMapping` WRITE;
/*!40000 ALTER TABLE `homeworkAccountMapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `homeworkAccountMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `topicID` int(11) NOT NULL,
  `content` text NOT NULL,
  `createdDate` int(11) NOT NULL,
  `modifiedDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1,'<p>\n	CSTHub is now live and ready to be used.\n</p>\n<p>\n	As the first release there are some areas of the site which wont be open to public yet.\n	However in the mean time the homework checklist and forums are operational.\n</p>\n<p>\n	We ask for the moment that only CST students in sets 1A, 1B and 1C sign up for the site.\n	We will be opening the site to all CST students soon.\n</p>\n<p>	\n	We hope that you can find our site useful.\n	Please give any feedback or suggestions to us either in person or to our email <a href=\"mailto:csthub@gmail.com\">csthub@gmail.com</a>.\n</p>\n<p>\n	Thank you,<br />\n	<br />\n	CSTHub Crew - David, Kevin, Troy, Jay and Jake.\n</p>',1332140738,NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(4) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`departmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'COMM'),(2,'COMP'),(3,'BUSA');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL AUTO_INCREMENT,
  `courseCode` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `courseName` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `parentCourse` int(11) DEFAULT NULL,
  `courseURL` text COLLATE latin1_general_ci,
  `displayName` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1536,2,'Web Development',NULL,NULL,NULL),(2,1510,2,'Programming Methods',NULL,NULL,NULL),(3,1111,2,'Essential Skills for Computing',NULL,NULL,NULL),(4,1113,2,'Applied Mathematics',NULL,NULL,NULL),(5,1116,1,'Business Commincations',NULL,NULL,NULL),(6,1100,2,'Enhanced Learning Skills',NULL,NULL,NULL),(7,2720,3,'Business in a Networked Econ',NULL,NULL,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolesPermissionsMapping`
--

DROP TABLE IF EXISTS `rolesPermissionsMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolesPermissionsMapping` (
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL,
  PRIMARY KEY (`roleID`,`permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolespermissionsmapping`
--

LOCK TABLES `rolesPermissionsMapping` WRITE;
/*!40000 ALTER TABLE `rolesPermissionsMapping` DISABLE KEYS */;
INSERT INTO `rolesPermissionsMapping` VALUES (2,6);
/*!40000 ALTER TABLE `rolesPermissionsMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whiteboardsAccountsMapping`
--

DROP TABLE IF EXISTS `whiteboardsAccountsMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whiteboardsAccountsMapping` (
  `whiteboardID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `color` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`whiteboardID`,`accountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whiteboardsAccountsMapping`
--

LOCK TABLES `whiteboardsAccountsMapping` WRITE;
/*!40000 ALTER TABLE `whiteboardsAccountsMapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `whiteboardsAccountsMapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `homeworkID` int(11) NOT NULL AUTO_INCREMENT,
  `courseID` int(11) NOT NULL,
  `title` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `dueDate` int(11) NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`homeworkID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homework`
--

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
INSERT INTO `homework` VALUES (5,1,'Milestone 5',1332831599,'Serverside programming'),(4,6,'Journal',1332226799,'Activity Log');
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

-- Dump completed on 2012-03-19  0:58:20
