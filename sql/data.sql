USE a5621243_staging

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

INSERT INTO `accounts` VALUES(1, 'David', 'Mack', 'A00802872', '843bf8ffde5c433f385561b804ddf709af583d3005ebcd38e', '', '1326843304', '00:00:00');
INSERT INTO `accounts` VALUES(2, 'Kevin', 'McKeen', 'A00778394', 'f9a6c714cb2d4e4ce4fc6427fc6002e48c8b05fc9bf348700', '', '1326917225', '00:00:00');

INSERT INTO `courses` VALUES(1, 1536, 2, 'Web Development');
INSERT INTO `courses` VALUES(2, 1510, 2, 'Programming Methods');

INSERT INTO `department` VALUES(1, 'COMM');
INSERT INTO `department` VALUES(2, 'COMP');
INSERT INTO `department` VALUES(3, 'BUSA');

INSERT INTO `homework` VALUES(1, 2, 'Assignment 1', 1330342400, 0);
INSERT INTO `homework` VALUES(2, 1, 'Milestone 2', 1328564264, 1);
INSERT INTO `homework` VALUES(3, 2, 'troy sucks', 149872941, 0);

