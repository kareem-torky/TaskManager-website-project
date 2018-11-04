
CREATE DATABASE `todo`;
USE `todo`;

CREATE TABLE `users` (
	`username` varchar(20) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY(username)
);

CREATE TABLE `tasks` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`task` varchar(70) NOT NULL,
	`name` varchar(20) NOT NULL,
	`added_at` TIMESTAMP,
	PRIMARY KEY(id)
);