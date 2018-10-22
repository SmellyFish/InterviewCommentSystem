CREATE TABLE `comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `authorName` VARCHAR(45) NOT NULL,
  `commentBody` TEXT(1024) NOT NULL,
  `depth` TINYINT(1) UNSIGNED NOT NULL,
  `createdAt` DATETIME NOT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `comments` 
ADD COLUMN `parentCommentId` INT(10) UNSIGNED NULL AFTER `createdAt`;
