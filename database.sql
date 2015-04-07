-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 07, 2015 at 03:05 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
`id` int(11) NOT NULL,
  `coment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `coment`, `created_at`, `updated_at`, `user_id`, `message_id`) VALUES
(1, 'hey', '2015-04-06 15:19:23', '2015-04-06 15:19:23', 1, 7),
(2, 'a', '2015-04-06 15:31:59', '2015-04-06 15:31:59', 1, 7),
(3, 'hi', '2015-04-06 15:47:20', '2015-04-06 15:47:20', 1, 6),
(4, 'testing', '2015-04-06 18:10:40', '2015-04-06 18:10:40', 1, 4),
(5, 'hey man', '2015-04-06 18:10:57', '2015-04-06 18:10:57', 1, 9),
(6, 'how are you?', '2015-04-06 18:11:03', '2015-04-06 18:11:03', 1, 9),
(7, 'Hi Mason', '2015-04-06 18:34:16', '2015-04-06 18:34:16', 1, 10),
(8, 'Hi Ashley', '2015-04-06 18:34:22', '2015-04-06 18:34:22', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(2, 1, 'hi there', '2015-04-06 13:57:06', '2015-04-06 13:57:06'),
(3, 1, 'hi', '2015-04-06 13:59:06', '2015-04-06 13:59:06'),
(4, 1, 'hi again', '2015-04-06 14:08:10', '2015-04-06 14:08:10'),
(5, 1, 'Here we go!', '2015-04-06 14:32:45', '2015-04-06 14:32:45'),
(6, 1, 'so exciting!', '2015-04-06 14:32:52', '2015-04-06 14:32:52'),
(7, 1, 'this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message this is a message ', '2015-04-06 14:33:21', '2015-04-06 14:33:21'),
(8, 1, 'testing', '2015-04-06 16:42:29', '2015-04-06 16:42:29'),
(9, 1, 'hey dude', '2015-04-06 18:10:53', '2015-04-06 18:10:53'),
(10, 1, 'Hi Ashley', '2015-04-06 18:34:11', '2015-04-06 18:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'a', 'a', 'a@a.com', 'password', '2015-04-06 13:56:53', '2015-04-06 13:56:53'),
(2, 'mason', 'c', 'm@gmail.com', 'password1', '2015-04-06 18:41:50', '2015-04-06 18:41:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_comments_users1_idx` (`user_id`), ADD KEY `fk_comments_messages1_idx` (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_messages_users_idx` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `fk_comments_messages1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
