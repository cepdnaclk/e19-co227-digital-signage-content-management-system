-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 22, 2024 at 05:22 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `cmsdb`
--
-- --------------------------------------------------------
--
-- Table structure for table `boards`
--
DROP TABLE IF EXISTS `boards`;

CREATE TABLE IF NOT EXISTS `boards` (
  `board_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_name` varchar(100) NOT NULL,
  `theme` varchar(1000) NOT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `contactsupport`
--
DROP TABLE IF EXISTS `contactsupport`;

CREATE TABLE IF NOT EXISTS `contactsupport` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  `checked` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

-- --------------------------------------------------------
--
-- Table structure for table `labslot`
--
DROP TABLE IF EXISTS `labslot`;

CREATE TABLE IF NOT EXISTS `labslot` (
  `slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `date` int(11) NOT NULL,
  `oneday` date DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`slot_id`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

-- --------------------------------------------------------
--
-- Table structure for table `slides`
--
DROP TABLE IF EXISTS `slides`;

CREATE TABLE IF NOT EXISTS `slides` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `topic` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `timing`
--
DROP TABLE IF EXISTS `timing`;

CREATE TABLE IF NOT EXISTS `timing` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` int(11) NOT NULL,
  `per_page` int(11) NOT NULL,
  `per_slide` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `topics`
--
DROP TABLE IF EXISTS `topics`;

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 2 DEFAULT CHARSET = latin1;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;