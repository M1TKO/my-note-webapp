# myNote
### is app for saving notes :memo:

## :star: You can:
* create account
* make notes
* remove notes
* change username
* change password
* change email address
---

### :octocat: What is needed to be 100% functionaly? 
* Enter the host, username, password and database name in the **./files/db_connect.php**
* ```php
  $db_host = '';
  $db_name = '';
  $db_pass = '';
  $db_database = '';
  ```

* create database:
* ```sql
  CREATE DATABASE `my_note`;
  USE `my_note`;
  ```
* create the table for the **users** (using InnoDB)
* ```sql
  CREATE TABLE `users` (
    `user_id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(60) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(60) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ```
* create the table for the **notes** (using InnoDB)
* ```sql
    CREATE TABLE `notes` (
      `user_id` int(11) UNSIGNED NOT NULL,
      `title` varchar(40) CHARACTER SET utf8 NOT NULL,
      `body` text COLLATE utf8_bin NOT NULL,
      `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

* add index for table user
* ```sql
    ALTER TABLE `users`
     ADD UNIQUE KEY `username` (`username`);
  ```
---
:octocat: If you want you can see all of this queries in the **my_note.sql** file    
