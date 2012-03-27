ALTER TABLE `courses`
ADD COLUMN `description` TEXT NOT NULL AFTER `courseName`,
ADD COLUMN `location` VARCHAR(45) NOT NULL DEFAULT '' AFTER `parentCourse`,
DROP COLUMN `courseURL`,
ADD COLUMN `courseURL` VARCHAR(1024) NOT NULL DEFAULT '' AFTER `location`,
DROP COLUMN `displayName`,
ADD COLUMN `displayName` VARCHAR(40) NOT NULL DEFAULT '' AFTER `courseURL`;