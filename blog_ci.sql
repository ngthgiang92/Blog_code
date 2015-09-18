-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2015 at 06:39 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `comment_name` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_body` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `entry_id`, `comment_name`, `comment_email`, `comment_body`, `comment_date`, `user_id`) VALUES
(1, 1, 'administrator', 'admin@admin.com', 'Test comment. Continually matrix process-centric markets via web-enabled niche markets.', '2012-02-09 03:39:48', 1),
(2, 1, 'Tester 1', 'a@a.com', 'Vestibulum venenatis. Nulla vel ipsum. Proin rutrum, urna sit amet bibendum pellentesque.', '2012-02-09 03:40:39', 0),
(3, 1, 'design', 'thanhgiang@gmail.com', '?ây la 1 comment .', '2015-09-16 02:36:25', 0),
(4, 1, 'giang', 'nguyenthanhgiang92@gmail.com', 'asdasdsa', '2015-09-17 08:10:28', 1),
(5, 1, 'giang', 'nguyenthanhgiang92@gmail.com', 'asdasdas', '2015-09-17 08:11:08', 0),
(6, 2, 'giang', 'nguyenthanhgiang92@gmail.com', 'ASasA', '2015-09-17 08:14:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `entry_name` varchar(255) NOT NULL,
  `entry_body` text NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`entry_id`, `author_id`, `entry_name`, `entry_body`, `entry_date`, `comment_count`) VALUES
(8, 1, 'Insert - Update - Delete  CI', '<p>Through our&nbsp;previous&nbsp;post, you have learnt to insert data in database using CodeIgniter framework.</p>\r\n\r\n<p>In this tutorial we&nbsp;explain&nbsp;you how to delete data from database using CodeIgniter framework.</p>\r\n', '2015-09-17 23:25:08', 0),
(9, 1, 'Continuous integration', '<p><strong>Continuous integration</strong>&nbsp;(<strong>CI</strong>) is the practice, in&nbsp;<a href="https://en.wikipedia.org/wiki/Software_engineering" title="Software engineering">software engineering</a>, of merging all developer working copies to a shared&nbsp;<a href="https://en.wikipedia.org/wiki/Trunk_(software)" title="Trunk (software)">mainline</a>&nbsp;several times a day. It was first named and proposed by&nbsp;<a href="https://en.wikipedia.org/wiki/Grady_Booch" title="Grady Booch">Grady Booch</a>&nbsp;in his 1991&nbsp;<a href="https://en.wikipedia.org/wiki/Booch_method" title="Booch method">method</a>,<sup><a href="https://en.wikipedia.org/wiki/Continuous_integration#cite_note-1">[1]</a></sup>&nbsp;although Booch did not advocate integrating several times a day.&nbsp;</p>\r\n', '2015-09-18 04:41:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entry_category`
--

CREATE TABLE IF NOT EXISTS `entry_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `entry_category`
--

INSERT INTO `entry_category` (`category_id`, `category_name`, `slug`) VALUES
(3, 'CodeIgniter', 'codeigniter');

-- --------------------------------------------------------

--
-- Table structure for table `entry_relationships`
--

CREATE TABLE IF NOT EXISTS `entry_relationships` (
  `relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`relationship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `entry_relationships`
--

INSERT INTO `entry_relationships` (`relationship_id`, `object_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 4),
(5, 2, 5),
(6, 3, 3),
(7, 3, 3),
(8, 4, 3),
(9, 5, 3),
(10, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 2130706433, 'giang', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'nguyenthanhgiang92@gmail.com', '', NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1442558158, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
