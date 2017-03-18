--
-- Database: `my_note`
--
-- --------------------------------------------------------
CREATE DATABASE `my_note`;
USE `my_note`;

--
-- Table structure for table `notes`
--


CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `notes` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(40) CHARACTER SET utf8 NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);
  
