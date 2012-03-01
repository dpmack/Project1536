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

LOCK TABLES `set` WRITE;
/*!40000 ALTER TABLE `set` DISABLE KEYS */;
/*!40000 ALTER TABLE `set` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `setcoursemapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setcoursemapping` (
  `setID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  PRIMARY KEY (`setID`,`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `setcoursemapping` WRITE;
/*!40000 ALTER TABLE `setcoursemapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `setcoursemapping` ENABLE KEYS */;
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

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(256) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'David','Mack','A00802872','$6$rounds=45489$e1dd1f44b02518c4$L4Chnr2LLAyYvep.N9ORsh852KFYBgIzW01q08N38VcIVEaBU6S8uX1NdFIlwOSCh2ht0n27mEJRo8mE2LQs11'),(2,'Kevin','McKeen','A00778394','');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `accountsrolesmapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountsrolesmapping` (
  `accountID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  PRIMARY KEY (`accountID`,`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `accountsrolesmapping` WRITE;
/*!40000 ALTER TABLE `accountsrolesmapping` DISABLE KEYS */;
INSERT INTO `accountsrolesmapping` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `accountsrolesmapping` ENABLE KEYS */;
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

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `permissionID` int(11) NOT NULL AUTO_INCREMENT,
  `permissionName` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'START_TOPIC'),(2,'REPLY'),(3,'START_TOPIC_NEWS'),(4,'CREATE_FORUM'),(5,'DELETE_REPLY'),(6,'LOGIN'),(7,'CREATE_DEPARTMENT'),(8,'EDIT_DEPARTMENT'),(9,'CREATE_COURSE'),(10,'EDIT_COURSE'),(11,'CREATE_HOMEWORK'),(12,'EDIT_HOMEWORK'),(13,'HIDE_HOMEWORK'),(14,'DELETE_HOMEWORK'),(15,'SITE_ADMINISTRATION');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES ('e8d4427a2ca9d2762fecc9ff19abd628aae45aa6','a057a8ce879a4bc58a124fdc5f5c693b8e085e2f',1330379323,1);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errors` (
  `errorID` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`errorID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `errors` WRITE;
/*!40000 ALTER TABLE `errors` DISABLE KEYS */;
INSERT INTO `errors` VALUES (1,'2012-02-14 17:32:20','Column \'homeworkID\' in where clause is ambiguous','SELECT !ISNULL(ham.homeworkID) as finished, accounts.accountID as accountID \r\nFROM homework\r\nJOIN courses on homework.courseID=courses.courseID\r\nJOIN accountsCoursesMapping as acm on acm.courseID=courses.courseID\r\nJOIN accounts on accounts.accountID = acm.accountID\r\nLEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID\r\nWHERE accounts.username=\'A00802872\' \r\nand accounts.ticket=\'1329269380\' \r\nand homeworkID=1'),(2,'2012-02-23 10:01:58','You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'INTO account\nSET password=\'$6$rounds=45489$2d93713636bfebf1$wIn91cok4vbB1L.KD3rz\' at line 1','UPDATE INTO account\nSET password=\'$6$rounds=45489$2d93713636bfebf1$wIn91cok4vbB1L.KD3rzl8zBw3AwUAlICJg.z7L30e48M6/pPklPPiPLeXaDrOTMfjQamfxqA.renTauqKJsU.\'\nWHERE accountID=1'),(3,'2012-02-23 10:08:35','Table \'a5621243_staging.account\' doesn\'t exist','UPDATE account\nSET password=\'$6$rounds=45489$4d2719351b17ce17$bY8c5292o5L2GCbNpFm0/cjsoNiiydLcUXlQMY/UvRr9KbrC7RElLsewWmr34Henm9UDA2MKqIjXe0LZTh5QJ/\'\nWHERE accountID=1'),(4,'2012-02-23 10:09:02','You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'0\' at line 1','0'),(5,'2012-02-23 10:15:50','Column \'accountID\' in field list is ambiguous','SELECT accountID, username, password, clientHash, lastActivity\nFROM tickets\nJOIN accounts on tickets.accountID = accounts.accountID\nWHERE tickets.ticket = \'c530ffddb5c6443b4ccd33e6223ea8f0f7e8998c\''),(6,'2012-02-23 12:42:56','Data too long for column \'ticket\' at row 1','INSERT INTO tickets (ticket, clientHash, lastActivity, accountID)\nVALUES (\'$6$rounds=45489$3dd93f070c9671ea$SDivSFaeevys7tYl46N8YoacxtDz37Bvne7RctX/NdtPT9QysUixxUwrRzNm5BVi.9iEs3Se9vYXjEj6JNtIP.\', \'a057a8ce879a4bc58a124fdc5f5c693b8e085e2f\', 1330029776, 1)'),(7,'2012-02-23 12:43:47','You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'lastActivity=1330029827\nWHERE ticket=\'d2a20c5e843c152356327ad465c441d4598a4e55\'\' at line 2','UPDATE tickets\nSET ticket=\'d48ef23ba5f74933ce821c963e8727a66aa33bf6\' lastActivity=1330029827\nWHERE ticket=\'d2a20c5e843c152356327ad465c441d4598a4e55\''),(8,'2012-02-23 12:45:03','Unknown column \'accounts.ticket\' in \'where clause\'','SELECT homework.homeworkID as homeworkID, courseName, assignment, dueDate, !ISNULL(ham.homeworkID) as finished \nFROM homework\nJOIN courses on homework.courseID=courses.courseID\nJOIN accountscoursesmapping as acm on acm.courseID=courses.courseID\nJOIN accounts on accounts.accountID = acm.accountID\nLEFT JOIN homeworkaccountmapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID\nWHERE accounts.username=\'A00802872\' and accounts.ticket=\'04b6addf953111564c85866bda3b70a9ab952493\' and\ndueDate > 1329770703 \nORDER BY duedate DESC'),(9,'2012-02-23 12:53:26','Unknown column \'accounts.ticket\' in \'where clause\'','SELECT !ISNULL(ham.homeworkID) as finished, accounts.accountID as accountID \r\nFROM homework\r\nJOIN courses on homework.courseID=courses.courseID\r\nJOIN accountsCoursesMapping as acm on acm.courseID=courses.courseID\r\nJOIN accounts on accounts.accountID = acm.accountID\r\nLEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID\r\nWHERE accounts.username=\'A00802872\' \r\nand accounts.ticket=\'3ddd8259cb85fc47188b78dea291d82fc20d34c7\' \r\nand homework.homeworkID=2'),(10,'2012-02-23 12:53:27','Unknown column \'accounts.ticket\' in \'where clause\'','SELECT !ISNULL(ham.homeworkID) as finished, accounts.accountID as accountID \r\nFROM homework\r\nJOIN courses on homework.courseID=courses.courseID\r\nJOIN accountsCoursesMapping as acm on acm.courseID=courses.courseID\r\nJOIN accounts on accounts.accountID = acm.accountID\r\nLEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID\r\nWHERE accounts.username=\'A00802872\' \r\nand accounts.ticket=\'c34116280e1b3a3c8484478bc6d4710930dee729\' \r\nand homework.homeworkID=2');
/*!40000 ALTER TABLE `errors` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Disabled'),(2,'Super User'),(3,'Teacher'),(4,'Student'),(5,'Prospective Student'),(6,'Set Rep'),(7,'Banned');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `homeworkaccountmapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homeworkaccountmapping` (
  `homeworkID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  PRIMARY KEY (`homeworkID`,`accountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `homeworkaccountmapping` WRITE;
/*!40000 ALTER TABLE `homeworkaccountmapping` DISABLE KEYS */;
INSERT INTO `homeworkaccountmapping` VALUES (1,1);
/*!40000 ALTER TABLE `homeworkaccountmapping` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `accountscoursesmapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountscoursesmapping` (
  `accountID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  PRIMARY KEY (`accountID`,`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `accountscoursesmapping` WRITE;
/*!40000 ALTER TABLE `accountscoursesmapping` DISABLE KEYS */;
INSERT INTO `accountscoursesmapping` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `accountscoursesmapping` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1536,2,'Web Development',NULL,NULL,NULL),(2,1510,2,'Programming Methods',NULL,NULL,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rolespermissionsmapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolespermissionsmapping` (
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL,
  PRIMARY KEY (`roleID`,`permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `rolespermissionsmapping` WRITE;
/*!40000 ALTER TABLE `rolespermissionsmapping` DISABLE KEYS */;
INSERT INTO `rolespermissionsmapping` VALUES (2,6);
/*!40000 ALTER TABLE `rolespermissionsmapping` ENABLE KEYS */;
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

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `homeworkID` int(11) NOT NULL AUTO_INCREMENT,
  `courseID` int(11) NOT NULL,
  `assignment` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `dueDate` int(11) NOT NULL,
  PRIMARY KEY (`homeworkID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
INSERT INTO `homework` VALUES (1,2,'Assignment 1',1338342400),(2,1,'Milestone 4',1339564264),(3,2,'troy sucks',149872941);
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

