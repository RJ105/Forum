-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2021 at 08:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`id`, `name`, `description`, `created`) VALUES
(1, 'C', 'C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system.', '2020-12-14 00:00:00'),
(2, 'Java', 'java is a class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.', '2020-12-14 19:33:24'),
(3, 'Python', 'Python is an interpreted, high-level and general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', '2020-12-14 19:33:53'),
(4, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\". ', '2020-12-14 19:34:29'),
(5, 'PHP', 'PHP is a general-purpose scripting language especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group.', '2020-12-31 19:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(5) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_thread_id` int(5) NOT NULL,
  `comment_user_id` int(5) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`comment_id`, `comment_content`, `comment_thread_id`, `comment_user_id`, `comment_time`) VALUES
(11, 'second comment', 3, 0, '2020-12-16 17:28:09'),
(12, 'fourth comment', 9, 0, '2020-12-16 17:29:31'),
(13, 'this is  the comment after correction', 1, 0, '2020-12-20 16:28:31'),
(14, 'this is  the comment after correction', 1, 0, '2020-12-20 16:28:44'),
(15, '', 1, 0, '2020-12-20 16:29:06'),
(16, 'lets check for this comment', 1, 0, '2020-12-21 17:28:18'),
(17, 'test for ajax', 9, 0, '2020-12-22 16:38:43'),
(18, 'test for ajax', 9, 0, '2020-12-22 16:40:19'),
(19, 'multiple test for ajax', 9, 0, '2020-12-22 16:41:30'),
(20, 'whats up bro', 9, 0, '2020-12-22 17:50:05'),
(21, 'whats up bro', 9, 0, '2020-12-22 17:50:20'),
(22, 'this the test for post using ajax', 9, 0, '2020-12-23 06:49:26'),
(23, 'another test for ajax', 9, 0, '2020-12-23 06:54:16'),
(24, 'this the test for post using ajax', 9, 0, '2020-12-23 06:55:08'),
(25, 'hello ji kaise ho saare', 9, 0, '2020-12-23 07:00:29'),
(26, '', 9, 0, '2020-12-23 07:06:44'),
(27, 'now it should work', 9, 0, '2020-12-23 07:11:34'),
(29, 'this the first comment', 6, 0, '2020-12-23 13:59:21'),
(32, 'another comment\n', 6, 0, '2020-12-23 16:07:02'),
(34, 'comment for thread id 8', 8, 0, '2020-12-23 17:33:37'),
(37, 'first comment for 3,24', 24, 4, '2020-12-26 21:29:37'),
(38, 'first comment for this post !', 49, 4, '2021-01-01 12:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `Comment_rating`
--

CREATE TABLE `Comment_rating` (
  `cr_user_id` int(5) UNSIGNED NOT NULL,
  `cr_comment_id` int(5) UNSIGNED NOT NULL,
  `cr_action` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Comment_rating`
--

INSERT INTO `Comment_rating` (`cr_user_id`, `cr_comment_id`, `cr_action`) VALUES
(0, 11, 'like'),
(0, 34, 'like'),
(4, 15, 'like'),
(4, 16, 'like'),
(4, 34, 'like'),
(4, 37, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `Reply`
--

CREATE TABLE `Reply` (
  `reply_id` int(5) NOT NULL,
  `reply_description` text NOT NULL,
  `reply_comment_id` int(5) NOT NULL,
  `reply_user_id` int(5) NOT NULL,
  `reply_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Reply`
--

INSERT INTO `Reply` (`reply_id`, `reply_description`, `reply_comment_id`, `reply_user_id`, `reply_time`) VALUES
(20, 'reply for fourth comment of thread id 9', 12, 0, '2020-12-23 17:58:34'),
(21, 'reply for test of ajax of thread id 9 ', 17, 0, '2020-12-23 17:59:49'),
(1530, 'reply for first comment for 3,24', 37, 4, '2020-12-27 00:00:49'),
(1532, 'some input', 38, 4, '2021-01-01 12:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `Threads`
--

CREATE TABLE `Threads` (
  `thread_id` int(5) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(5) NOT NULL,
  `thread_user_id` int(5) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `likes` int(5) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Threads`
--

INSERT INTO `Threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`, `likes`) VALUES
(1, 'Execute c program in terminal', 'I am using Ubuntu OS and I want to run c program using terminal, but its showing error, please help.', 1, 0, '2020-12-15 19:59:32', 1),
(2, 'buffer attack using C', 'How can we use the scanf function to overload the buffer of string, so that we can access the memory.  ', 1, 0, '2020-12-15 20:38:01', 0),
(3, 'trying title', 'trying description', 2, 0, '2020-12-15 23:19:38', 0),
(4, 'hii', 'hello', 1, 0, '2020-12-15 23:31:42', 0),
(5, 'thread in java', 'Trying to create a thread in java', 2, 0, '2020-12-16 06:48:37', 0),
(6, 'thread in java', 'Trying to create a thread in java', 2, 0, '2020-12-16 06:55:25', 0),
(8, '1 in python title', '1 in python description', 3, 0, '2020-12-16 10:18:57', 1),
(9, 'first title in c++', 'first descriptionin c++', 4, 0, '2020-12-16 10:39:16', 0),
(10, '2nd in c++ title', '2nd in c++description', 4, 0, '2020-12-16 11:59:48', 0),
(11, '2nd in c++ title', '2nd in c++description', 4, 0, '2020-12-16 12:00:54', 0),
(16, 'a', 'b', 4, 0, '2020-12-16 13:32:06', 0),
(17, 'a', 'b', 4, 0, '2020-12-16 13:33:08', 0),
(18, 'c', 'd', 4, 0, '2020-12-16 13:34:06', 0),
(19, '123', '456', 4, 0, '2020-12-16 16:54:52', 0),
(20, '11', '12', 4, 0, '2020-12-16 17:09:23', 0),
(21, 'testing for ', 'successs', 4, 0, '2020-12-16 18:01:00', 0),
(22, 'hello ', 'there', 2, 0, '2020-12-16 18:24:50', 0),
(23, 'ab', 'cd', 1, 0, '2020-12-24 19:01:40', 0),
(24, 'cat_id=3, thread_id=24', 'something', 3, 4, '2020-12-25 00:56:42', 0),
(32, 'cat_id = 3, thread_id dont know', '', 3, 4, '2020-12-25 16:24:02', 0),
(35, 'abcd', 'efgh', 2, 4, '2020-12-25 17:06:34', 0),
(48, 'asking something in java', 'what should i ask?', 2, 4, '2020-12-26 16:26:06', 0),
(49, 'How can I prevent SQL injection in PHP?', 'If user input is inserted without modification into an SQL query, then the application becomes vulnerable to SQL injection, like in the following example:', 5, 4, '2020-12-31 19:13:17', 0),
(50, 'Deleting an element from an array in PHP', 'Is there an easy way to delete an element from an array using PHP, such that foreach (array) no longer includes that \nI thought that setting it to null would do it, but apparently it does not work.', 5, 4, '2020-12-31 19:17:52', 0),
(51, 'Why shouldnt I use mysql functions in PHP?', 'There is some technical problem', 5, 4, '2020-12-31 19:44:44', 0),
(52, '_**888888888888*******?????><<>>', '<<<<<<>>>>>>>>>>>>*$##########@@@@@@@@@@@@@@@@', 5, 4, '2020-12-31 19:48:47', 0),
(53, 'What are the popular Content Management Systems (CMS) in PHP?', 'WordPress: WordPress is a free and open-source content management system (CMS) based on PHP & MySQL. It includes a plug-in architecture and template system. It is mostly connected with blogging but supports another kind of web content, containing more traditional mailing lists and forums, media displays, and online \nJoomla: Joomla is a free and open-source content management system (CMS) for distributing web content, created by Open Source Matters, Inc. It is based on a model-view-controller web application framework that can be used independently of the \nMagento: Magento is an open source E-trade programming, made by Varien Inc., which is valuable for online business. It has a flexible measured design and is versatile with many control alternatives that are useful for clients. Magento utilizes E-trade stage which offers organization extreme E-business arrangements and extensive support \nDrupal: Drupal is a CMS platform developed in PHP and distributed under the GNU (General Public License).\n', 5, 4, '2020-12-31 19:50:45', 0),
(54, 'Why shouldnt I use mysql_*!@#$%^&()_+-=[]{}|;:\"\",./<>?`~ functions in PHP?', 'What are the technical reasons for why one shouldnt use mysql_* functions? (e.g. mysql_query(), mysql_connect() or mysql_real_escape_string())?\r\nWhy should I use something else even if they work on my site?\r\nIf they dont work on my site, why do I get errors like ', 5, 4, '2021-01-01 12:11:12', 0),
(55, 'shouldnt', 'possible', 5, 4, '2021-01-01 12:32:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Thread_rating`
--

CREATE TABLE `Thread_rating` (
  `tr_user_id` int(5) UNSIGNED NOT NULL,
  `tr_thread_id` int(5) UNSIGNED NOT NULL,
  `tr_action` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Thread_rating`
--

INSERT INTO `Thread_rating` (`tr_user_id`, `tr_thread_id`, `tr_action`) VALUES
(4, 1, 'like'),
(4, 8, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_name`, `user_email`, `user_password`, `user_time`) VALUES
(0, 'Name', 'name@name.com', '$2y$10$LSCywUY5B/RxuvCU67eV5.MgK1bt8IKyV1pXyD40aBYGhmZtJG5gK', '2020-12-26 16:34:39'),
(3, 'aman', 'babu@test.com', '$2y$10$zwZ53gbYXsb0gTBU9EXP7O12CG8yJYvTZTWDMtIJ7MkcqoE.nN8gu', '2020-12-16 22:02:23'),
(4, 'rj', 'rj@gmail.com', '$2y$10$Y4KuPaOvngZl5SseZikcZusQbhxTTjPP3DYoEXZxz3LGcS1LbyN1G', '2020-12-19 19:30:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_thread_id` (`comment_thread_id`),
  ADD KEY `comment_user_id` (`comment_user_id`);

--
-- Indexes for table `Comment_rating`
--
ALTER TABLE `Comment_rating`
  ADD PRIMARY KEY (`cr_user_id`,`cr_comment_id`);

--
-- Indexes for table `Reply`
--
ALTER TABLE `Reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `reply_comment_id` (`reply_comment_id`),
  ADD KEY `reply_user_id` (`reply_user_id`);

--
-- Indexes for table `Threads`
--
ALTER TABLE `Threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `on delete` (`thread_user_id`);

--
-- Indexes for table `Thread_rating`
--
ALTER TABLE `Thread_rating`
  ADD PRIMARY KEY (`tr_user_id`,`tr_thread_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Reply`
--
ALTER TABLE `Reply`
  MODIFY `reply_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1533;

--
-- AUTO_INCREMENT for table `Threads`
--
ALTER TABLE `Threads`
  MODIFY `thread_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`comment_thread_id`) REFERENCES `Threads` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reply`
--
ALTER TABLE `Reply`
  ADD CONSTRAINT `Reply_ibfk_1` FOREIGN KEY (`reply_comment_id`) REFERENCES `Comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reply_ibfk_2` FOREIGN KEY (`reply_user_id`) REFERENCES `User` (`user_id`);

--
-- Constraints for table `Threads`
--
ALTER TABLE `Threads`
  ADD CONSTRAINT `on delete` FOREIGN KEY (`thread_user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
