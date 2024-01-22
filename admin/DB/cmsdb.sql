-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 22, 2024 at 03:31 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

DROP TABLE IF EXISTS `achievement`;
CREATE TABLE IF NOT EXISTS `achievement` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(100) DEFAULT NULL,
  `a_desc` varchar(500) DEFAULT NULL,
  `a_date` date DEFAULT NULL,
  `a_img` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'F_key - UserId',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` int(11) NOT NULL,
  `b_date` date NOT NULL,
  `b_timeslot` varchar(20) NOT NULL,
  `b_seats` int(11) NOT NULL,
  `b_for` varchar(100) NOT NULL,
  `b_contact` varchar(15) NOT NULL,
  `b_by` int(11) NOT NULL,
  PRIMARY KEY (`b_id`),
  KEY `fk_admin_id` (`b_by`),
  KEY `fk_facility_id` (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_code` varchar(50) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_coordinator` varchar(100) NOT NULL,
  `description` text,
  `Poster_img` varchar(255) DEFAULT NULL,
  `duration(months)` int(11) DEFAULT NULL,
  `new_intake_date` date DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `display_description` text,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `poster` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

DROP TABLE IF EXISTS `dashboard`;
CREATE TABLE IF NOT EXISTS `dashboard` (
  `feature` varchar(100) NOT NULL,
  `time` int(11) DEFAULT '0',
  `time_slide` int(10) DEFAULT NULL,
  PRIMARY KEY (`feature`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`feature`, `time`, `time_slide`) VALUES
('Lab Slots', 10, NULL),
('Course Offerings', 5, 1),
('Upcoming Events', 5, 1),
('Previous Events', 5, 1),
('Achievements', 5, 1),
('Maps', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

DROP TABLE IF EXISTS `facility`;
CREATE TABLE IF NOT EXISTS `facility` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `floor` varchar(20) DEFAULT NULL,
  `in_charge` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(100) NOT NULL,
  `m_file` varchar(300) NOT NULL,
  `m_desc` text,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previous_event`
--

DROP TABLE IF EXISTS `previous_event`;
CREATE TABLE IF NOT EXISTS `previous_event` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(100) DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `e_venue` varchar(100) DEFAULT NULL,
  `e_img` varchar(1000) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'f_key -userId',
  `published` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_event`
--

DROP TABLE IF EXISTS `upcoming_event`;
CREATE TABLE IF NOT EXISTS `upcoming_event` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(100) DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `e_venue` varchar(100) DEFAULT NULL,
  `e_img` varchar(1000) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'f_key -userId',
  `published` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
  `clearense` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `email`, `password`, `contact`, `clearense`) VALUES
(1, 'SuperAdmin', 'super@test.com', '59b62e0dffd6c01ac351446ba5789774965704128ab1bfa2504a379b1cff854c', '', 'super_admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
