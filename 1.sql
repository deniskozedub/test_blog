
CREATE DATABASE `video_blog` DEFAULT COLLATE utf8_general_ci;
use `video_blog`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL
); 
CREATE TABLE `video` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
   `users_id` int(10) unsigned NOT NULL,
   FOREIGN KEY (users_id) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ;
CREATE TABLE `tokens` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_ip` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `expiries` bigint(20) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  FOREIGN KEY (users_id) REFERENCES `users`(`id`)  ON DELETE CASCADE ON UPDATE RESTRICT

);

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45) NOT NULL
) ;

CREATE TABLE `user_roles` (
  `users_id` int(10) unsigned NOT NULL ,
  `roles_id` int(10) unsigned NOT NULL,
  FOREIGN KEY (users_id) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  FOREIGN KEY (roles_id) REFERENCES `roles`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT
);


