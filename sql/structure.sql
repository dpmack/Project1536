USE a5621243_staging

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL AUTO_INCREMENT,
  `courseCode` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `courseName` varchar(128) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(4) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`departmentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

CREATE TABLE `errors` (
  `errorID` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` datetime NOT NULL,
  `alert` text COLLATE latin1_general_ci NOT NULL,
  `debug` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`errorID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

CREATE TABLE `forums` (
  `forumID` int(11) NOT NULL AUTO_INCREMENT,
  `forumTitle` varchar(64) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`forumID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

CREATE TABLE `homework` (
  `homeworkID` int(11) NOT NULL AUTO_INCREMENT,
  `courseID` int(11) NOT NULL,
  `assignment` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `dueDate` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`homeworkID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

CREATE TABLE `topics` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `forumID` int(11) NOT NULL,
  `title` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `isLocked` tinyint(1) NOT NULL DEFAULT '0',
  `isSticky` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

