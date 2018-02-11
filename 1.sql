
CREATE DATABASE `blog` DEFAULT COLLATE utf8_general_ci;
use `blog`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `authors_name` varchar(255) NOT NULL,
  `time` TIMESTAMP

); 
CREATE TABLE `coments` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `com` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
   FOREIGN KEY (post_id) REFERENCES `posts`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ;



