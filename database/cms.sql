-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 08:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(50) NOT NULL DEFAULT 'avatar.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`, `addedby`) VALUES
(2, 'February-25-2020 11:04:11', 'Tom ali', '12345', 'tom123', '', '', 'avatar.png', 'gulam'),
(3, 'February-25-2020 11:05:34', 'Akbar', '827ccb0eea8a706c4c34a16891f84e7b', 'ali ali', '', '', 'avatar.png', 'gulam'),
(10, 'February-25-2020 14:47:14', 'gulam', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '1.jpg', 'gulam'),
(11, 'February-25-2020 19:15:47', 'gulamnit', '827ccb0eea8a706c4c34a16891f84e7b', 'gulam mohd', '', '', 'avatar.png', 'gulam');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(14, 'Java', 'gulamkhan', 'February-05-2020 22:17:58'),
(15, 'Micro', 'gulamkhan', 'February-05-2020 22:21:46'),
(16, 'A Quick Overview of Laravel', 'gulam', 'February-25-2020 14:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`) VALUES
(16, 'February-25-2020 00:19:51', 'gulam', 'g@gmail', 'Laravel is a free and open-source PHP framework that follows the model–view–controller design (MVC)', 'gulam khan', 'OFF', 10),
(19, 'February-25-2020 00:34:47', 'gulam', 'g1@gmail.com', 'Laravel is a free and open-source PHP framework that follows the model–view–controller design (MVC)', 'pedding', 'OFF', 10),
(20, 'February-25-2020 16:17:26', 'gulam', 'g1@gmail.com', 'aravel is a free and open-source PHP framework that follows the model–view–controller design (MVC) pattern. Our extensive collection of Laravel Interview Questions will help', 'pedding', 'ON', 9),
(21, 'February-25-2020 16:17:52', 'gulam', 'g1@gmail.com', 'ENT_COMPAT - Default. Encodes only double quotes\r\nENT_QUOTES - Encodes double and single quotes\r\nENT_NOQUOTES - Does not encode any quotes', 'pedding', 'On', 9),
(23, 'February-25-2020 16:18:08', 'wwqeqw', 'a@gmail.com', 'ENT_COMPAT - Default. Encodes only double quotes\r\nENT_QUOTES - Encodes double and single quotes\r\nENT_NOQUOTES - Does not encode any quotes', 'pedding', 'ON', 9),
(24, 'February-25-2020 16:27:45', 'gulam', 'g1@gmail.com', 'ENT_IGNORE - Ignores invalid encoding instead of having the function return an empty string. Should be avoided, as it may have security implications.\r\nENT_SUBSTITUTE - Replaces invalid encoding for a specified character set with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD; instead of returning an empty string.\r\nENT_DISALLOWED - Replaces code points that are invalid in the specified doctype with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD', 'pedding', 'ON', 14),
(25, 'February-25-2020 16:27:59', 'gulam', 'g1@gmail.com', 'ENT_IGNORE - Ignores invalid encoding instead of having the function return an empty string. Should be avoided, as it may have security implications.\r\nEN', 'gulam khan', 'OFF', 14),
(26, 'February-25-2020 16:28:12', 'kiii', 'a@gmail.com', 'T_SUBSTITUTE - Replaces invalid encoding for a specified character set with a Unicode ', 'gulam khan', 'ON', 14);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(9, 'February-07-2020 17:36:15', 'Audience  Overview', 'php', 'gulamkhan', '11.jpg', 'This Complete Laravel tutorial will direct the programmers and learners who wish to understand how to create a site using Laravel. This tutorial is very meant for those programmers who don\'t have any previous experience of utilizing Laravel. Before you moving with this tutorial we presume that you\'re familiar with HTML, Core PHP, and Advance PHP. This brief laravel tutorial for beginners tutorial will lead especially the scholars, learners as well as development who desire to determine how to develop a website utilizing Laravel.  '),
(10, 'February-07-2020 17:37:01', 'Laravel Tutorial Index', 'Java', 'gulamkhan', '13.jpg', 'It will help in simplifying your website and it contains modular packaging system. And it also includes few flexible features the applications.\r\nAs Laravel has features of creating unique URLs related to it, with the same existing routes we can create different routes with the same name.\r\nLaravel contains auto loading facility, therefore PHP will not require special inclusion for paths and maintenance.\r\nAlso due to inclusion of namespaces and interfaces, Laravel makes it possible to organize and manage resources.'),
(11, 'February-08-2020 20:01:42', 'Updating to Angular version 9', 'Technology', 'gulamkhan', '9.jpg', 'For step-by-step instructions on how to update to the latest Angular release (and leverage our automated migration tools to do so), use the interactive update guide at update.angular.io.\r\n\r\nIf you\'re curious about the specific migrations being run by the CLI, see the automated migrations section for details on what code is changing and why.'),
(12, 'February-25-2020 14:58:09', 'Top 91 Laravel Interview Questions & Answers', 'Java', 'gulamkhan', 'IMG_20200223_131718.jpg', 'Laravel is a free and open-source PHP framework that follows the model–view–controller design (MVC) pattern. Our extensive collection of Laravel Interview Questions will help you find a great job. Laravel is a popular PHP framework that reduces the cost of development and improves code quality. Using Laravel, developers can save hours of development time and cut thousands of lines of code as compared to raw PHP. Because Laravel reuses the existing components of different frameworks in designing web applications, the outcome is more structured and'),
(13, 'February-25-2020 16:26:29', '25 PHP Interview Questions and Answers', 'Java', 'gulam', 'download (2).jpg', 'ENT_COMPAT - Default. Encodes only double quotes\r\nENT_QUOTES - Encodes double and single quotes\r\nENT_NOQUOTES - Does not encode any quotes'),
(14, 'February-25-2020 16:27:04', '50 PHP Interview Questions and Answers', 'php', 'gulam', '1.jpg', 'ENT_IGNORE - Ignores invalid encoding instead of having the function return an empty string. Should be avoided, as it may have security implications.\r\nENT_SUBSTITUTE - Replaces invalid encoding for a specified character set with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD; instead of returning an empty string.\r\nENT_DISALLOWED - Replaces code points that are invalid in the specified doctype with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
