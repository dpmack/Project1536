CREATE TABLE `authErrors` (
  `errorID` INT NOT NULL AUTO_INCREMENT,
  `accountID` INT NOT NULL ,
  `url` TEXT NOT NULL ,
  `time` INT NOT NULL ,
  PRIMARY KEY (`errorID`) );

