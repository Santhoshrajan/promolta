-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2017 at 10:58 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promolta`
--
CREATE DATABASE IF NOT EXISTS `promolta` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `promolta`;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_key` varchar(20) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `fa` varchar(20) DEFAULT NULL,
  `label_num` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `name_key`, `visibility`, `fa`, `label_num`, `created_at`, `updated_at`) VALUES
(1, 'InBox', 'inbox', 1, 'fa-inbox', 'label-danger', '2017-08-14 14:27:32', '2017-08-16 11:33:22'),
(2, 'Sent Mail', 'sent', 1, 'fa-envelope-o', NULL, '2017-08-14 14:27:32', '2017-08-16 11:33:28'),
(3, 'Drafts', 'drafts', 1, 'fa-external-link', 'label-info', '2017-08-14 14:27:54', '2017-08-16 11:33:32'),
(4, 'Spam', 'spam', 1, 'fa-bug', 'label-danger', '2017-08-14 14:27:54', '2017-08-16 11:33:38'),
(5, 'Trash', 'trash', 1, 'fa-trash-o', NULL, '2017-08-14 14:28:11', '2017-08-16 11:33:45'),
(6, 'Deleted (Not Visible)', '', 0, NULL, NULL, '2017-08-15 12:52:46', '2017-08-15 13:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `attachment` tinyint(4) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `parent_msg_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `author_id`, `subject`, `attachment`, `body`, `parent_msg_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'All the Best', 0, 'Thanks, Im doing the assignment', 1, '2017-08-15 13:13:06', '2017-08-15 13:13:06'),
(2, 5, 'Happy Independence Day', 0, '\n\nSanthosh ,\n\nA community is being built to disrupt a hundred year old reign backed by Trump and his allies: dirty, corrupt, fossil fuels.\n\nWhat can you do about it? It’s lying right on your counter top. It’s your power bill.\n\nWith our partner Arcadia Power, you can enroll your utility account to clean, renewable energy. Forget waiting for legislation, you can do this right now.\n\nThey ensure that every time you pay your power bill with your local utility, it supports renewable energy projects. You can do it online in two minutes, it’s free, and you don’t have to change your power company or install anything. The only difference is that you will support clean energy sources and get access to Arcadia’s modern energy platform. Once again, for free. This is a no-brainer.\n\nArcadia Power has one clear mission – to make the move from fossil fuels to renewable energy by giving every single person in America the option to support clean, renewable energy. 73% of Americans want access to renewable energy, and when people are given a choice, they can move entire industries. Now you have a tool to do it.\n\nPlus, if you sign up by August 31st, they will send you 4 free LED bulbs as a thank you.\n\nJoin a community of individuals making this movement happen today >>\n\nThank you,\n\nReuben\n\nSent via ActionNetwork.org. To update your email address or to stop receiving emails from Watchdog.net, please click here.\n', 2, '2017-08-15 13:48:31', '2017-08-16 18:51:36'),
(3, 5, 'Happy Independence Day', 0, 'India is my country. Im proud of its rich and heritage.', 3, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(4, 5, 'Happy Independence Day', 0, 'India is my country. Im proud of its rich and heritage.', 4, '2017-08-16 13:31:42', '2017-08-16 13:31:42'),
(5, 5, 'Koramangala is Flooded', 0, 'BBMP Didnt come to rescue', 5, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(6, 5, 'Koramangala is Flooded', 0, 'BBMP Didnt come to rescue', 6, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(7, 5, 'Koramangala is Flooded', 0, 'BBMP Didnt come to rescue', 7, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(8, 5, 'Koramangala is Flooded', 0, 'BBMP Didnt come to rescue', 8, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(9, 1, 'Merry Chrsitmas', 0, 'Wish you a Merry Chrsitmas', 9, '2017-08-16 13:58:04', '2017-08-16 13:58:04'),
(10, 1, 'This is a draft', 0, 'Oh! Cool', 10, '2017-08-16 14:11:41', '2017-08-16 14:11:41'),
(11, 1, 'Birthday Wishes', 0, 'Hi Molly... \n\nJoin me in Wishing Jesse', 11, '2017-08-16 20:53:10', '2017-08-16 20:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msg_address`
--

CREATE TABLE `msg_address` (
  `id` bigint(20) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `to` text NOT NULL,
  `cc` text,
  `bcc` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msg_address`
--

INSERT INTO `msg_address` (`id`, `msg_id`, `to`, `cc`, `bcc`, `created_at`, `updated_at`) VALUES
(1, 1, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123', '2017-08-15 13:13:06', '2017-08-15 13:13:06'),
(2, 2, 'santhosh', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse', '2017-08-15 13:48:31', '2017-08-15 13:48:31'),
(3, 3, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse', '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(4, 4, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse', '2017-08-16 13:31:42', '2017-08-16 13:31:42'),
(5, 5, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse,santhosh', '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(6, 6, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse,santhosh', '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(7, 7, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse,santhosh', '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(8, 8, 'jesse', 'steve@gmail.com,dolly@hotmail.', 'jacqueline@123,jesse,santhosh', '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(9, 9, 'jesse', 'dolly', NULL, '2017-08-16 13:58:04', '2017-08-16 13:58:04'),
(10, 10, 'jesse', NULL, NULL, '2017-08-16 14:11:41', '2017-08-16 14:11:41'),
(11, 11, 'jesse', 'molly', NULL, '2017-08-16 20:53:10', '2017-08-16 20:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `psswd` varchar(50) NOT NULL,
  `iat` varchar(30) DEFAULT NULL,
  `online_status` varchar(160) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `fname`, `lname`, `dob`, `gender`, `psswd`, `iat`, `online_status`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'santhosh', 'Santhosh', 'Rajan', '2017-04-01', 'M', '3e6d11ac8d017da8b1275df1a5111b', '1502913712', 'Busy with coding!!', 'santhosh.jpg', 0, '2017-08-14 14:29:05', '2017-08-16 20:01:52'),
(2, 'lucius', 'Lucius', 'Cashmere', '2017-04-01', 'M', '3e6d11ac8d017da8b1275df1a5111b', NULL, 'Enjoying my pizza :) ', 'lucius.jpg', 0, '2017-08-14 14:29:58', '2017-08-16 19:09:53'),
(3, 'jesse', 'Jesse', 'Phoenix', '2016-08-10', 'M', '3e6d11ac8d017da8b1275df1a5111b', '1502916901', 'Busy!', 'jesse.jpg', 0, '2017-08-14 14:31:14', '2017-08-16 20:55:01'),
(4, 'steve', 'Steve', 'Doublesteve', '2017-08-18', 'M', '3e6d11ac8d017da8b1275df1a5111b', NULL, 'Available', 'steve.jpg', 0, '2017-08-14 14:32:00', '2017-08-16 19:10:05'),
(5, 'dolly', 'Dolly', 'Unicycle', '2017-08-29', 'F', '3e6d11ac8d017da8b1275df1a5111b', '1502890534', 'I do not think', 'dolly.jpg', 0, '2017-08-14 14:34:04', '2017-08-16 19:10:20'),
(6, 'jacqueline', 'Jacqueline', 'Pumpkin', '2015-08-01', 'F', '3e6d11ac8d017da8b1275df1a5111b', NULL, 'Im not here', 'jacqueline.jpg', 0, '2017-08-15 12:15:54', '2017-08-16 19:10:25'),
(7, 'molly', 'Molly', 'Popper', '2013-08-10', 'F', '3e6d11ac8d017da8b1275df1a5111b', NULL, 'Single at Sixties', 'molly.jpg', 0, '2017-08-15 12:16:29', '2017-08-16 19:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_msg_map`
--

CREATE TABLE `user_msg_map` (
  `id` bigint(20) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `folder_id` tinyint(4) NOT NULL,
  `is_unread` tinyint(1) NOT NULL DEFAULT '1',
  `is_starred` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_msg_map`
--

INSERT INTO `user_msg_map` (`id`, `msg_id`, `user_id`, `folder_id`, `is_unread`, `is_starred`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 0, '2017-08-15 13:13:06', '2017-08-16 08:42:54'),
(2, 1, 3, 5, 0, 0, '2017-08-15 13:13:06', '2017-08-16 20:55:23'),
(3, 1, 4, 1, 1, 0, '2017-08-15 13:13:06', '2017-08-16 08:43:04'),
(4, 1, 5, 1, 1, 0, '2017-08-15 13:13:06', '2017-08-16 08:43:04'),
(5, 1, 6, 1, 1, 0, '2017-08-15 13:13:06', '2017-08-16 08:43:04'),
(6, 2, 5, 2, 1, 0, '2017-08-15 13:48:31', '2017-08-16 08:43:04'),
(7, 2, 1, 5, 0, 0, '2017-08-15 13:48:31', '2017-08-16 20:51:47'),
(8, 2, 3, 1, 1, 0, '2017-08-15 13:48:31', '2017-08-16 08:43:04'),
(9, 2, 4, 1, 1, 0, '2017-08-15 13:48:31', '2017-08-16 08:43:04'),
(10, 2, 5, 1, 1, 0, '2017-08-15 13:48:31', '2017-08-16 08:43:04'),
(11, 2, 6, 1, 1, 0, '2017-08-15 13:48:31', '2017-08-16 08:43:04'),
(12, 3, 5, 2, 0, 0, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(13, 3, 3, 1, 0, 0, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(14, 3, 4, 1, 0, 0, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(15, 3, 5, 1, 0, 0, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(16, 3, 6, 1, 0, 0, '2017-08-16 12:15:28', '2017-08-16 12:15:28'),
(17, 4, 5, 2, 0, 0, '2017-08-16 13:31:42', '2017-08-16 13:31:42'),
(18, 5, 5, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(19, 5, 1, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(20, 5, 3, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(21, 5, 4, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(22, 5, 5, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(23, 5, 6, 2, 0, 0, '2017-08-16 13:40:39', '2017-08-16 13:40:39'),
(24, 6, 5, 2, 0, 0, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(25, 6, 1, 5, 0, 0, '2017-08-16 13:43:21', '2017-08-16 20:47:47'),
(26, 6, 3, 1, 0, 0, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(27, 6, 4, 1, 0, 0, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(28, 6, 5, 1, 0, 0, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(29, 6, 6, 1, 0, 0, '2017-08-16 13:43:21', '2017-08-16 13:43:21'),
(30, 7, 5, 2, 1, 0, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(31, 7, 1, 1, 1, 0, '2017-08-16 13:44:16', '2017-08-16 20:51:33'),
(32, 7, 3, 1, 1, 0, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(33, 7, 4, 1, 1, 0, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(34, 7, 5, 1, 1, 0, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(35, 7, 6, 1, 1, 0, '2017-08-16 13:44:16', '2017-08-16 13:44:16'),
(36, 8, 5, 2, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(37, 8, 1, 1, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(38, 8, 3, 1, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(39, 8, 4, 1, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(40, 8, 5, 1, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(41, 8, 6, 1, 1, 0, '2017-08-16 13:53:14', '2017-08-16 13:53:14'),
(42, 9, 1, 2, 1, 0, '2017-08-16 13:58:04', '2017-08-16 13:58:04'),
(43, 9, 3, 1, 1, 0, '2017-08-16 13:58:04', '2017-08-16 13:58:04'),
(44, 9, 5, 1, 1, 0, '2017-08-16 13:58:04', '2017-08-16 13:58:04'),
(45, 10, 1, 3, 1, 0, '2017-08-16 14:11:41', '2017-08-16 14:11:41'),
(46, 11, 1, 2, 1, 0, '2017-08-16 20:53:10', '2017-08-16 20:53:10'),
(47, 11, 3, 1, 0, 0, '2017-08-16 20:53:10', '2017-08-16 20:55:10'),
(48, 11, 7, 1, 1, 0, '2017-08-16 20:53:10', '2017-08-16 20:53:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `msg_address`
--
ALTER TABLE `msg_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gender` (`gender`);

--
-- Indexes for table `user_msg_map`
--
ALTER TABLE `user_msg_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `folder_id` (`folder_id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `msg_address`
--
ALTER TABLE `msg_address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_msg_map`
--
ALTER TABLE `user_msg_map`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
