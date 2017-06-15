--
-- Database: `my_note`
--
-- --------------------------------------------------------
--it is optimal (you can name the db how you want)
-- CREATE DATABASE `my_note`;
-- USE `my_note`;


--
--  Table structure for table `notes`
--


CREATE TABLE `users` (
  `user_idAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `users`
--

ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);
  
