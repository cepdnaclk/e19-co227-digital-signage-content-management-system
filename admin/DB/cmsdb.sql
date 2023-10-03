-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2023 at 06:31 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `a_id` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(100) DEFAULT NULL,
  `a_img` varchar(100) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int NOT NULL COMMENT 'F_key - UserId',
  PRIMARY KEY (`a_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`a_id`, `a_name`, `a_img`, `display_from`, `display_to`, `added_by`) VALUES
(1, 'Achievement 1', 'achievement1.jpg', '2023-07-01', '2023-07-15', 1),
(2, 'Achievement 2', 'achievement2.jpg', '2023-08-01', '2023-08-15', 2),
(3, 'Achievement 3', 'achievement3.jpg', '2023-09-01', '2023-09-15', 3),
(4, 'Achievement 4', 'achievement4.jpg', '2023-10-01', '2023-10-15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `details` text,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `c_name`, `details`) VALUES
(1, 'Introduction to Programming', 'Basic programming concepts and techniques.'),
(2, 'Web Development', 'Building web applications using HTML, CSS, and JavaScript.'),
(3, 'Database Management', 'Database design and SQL.'),
(4, 'Networking Fundamentals', 'Basics of computer networking.');

-- --------------------------------------------------------

--
-- Table structure for table `course_offering`
--

DROP TABLE IF EXISTS `course_offering`;
CREATE TABLE IF NOT EXISTS `course_offering` (
  `c_code` varchar(20) NOT NULL,
  `c_id` int NOT NULL,
  `coordinator_id` int NOT NULL,
  `starting date` date NOT NULL,
  `display_info` text,
  PRIMARY KEY (`c_code`),
  KEY `fk_c_id` (`c_id`),
  KEY `fk_coord_id` (`coordinator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_offering`
--

INSERT INTO `course_offering` (`c_code`, `c_id`, `coordinator_id`, `starting date`, `display_info`) VALUES
('COURSE01', 1, 1, '2023-08-15', 'Course details for August 2023'),
('COURSE02', 2, 2, '2022-12-10', 'Course details for December 2022'),
('COURSE03', 3, 3, '2023-09-05', 'Course details for September 2023'),
('COURSE04', 4, 4, '2023-10-01', 'Course details for October 2023');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

DROP TABLE IF EXISTS `facility`;
CREATE TABLE IF NOT EXISTS `facility` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`f_id`, `f_name`) VALUES
(1, 'Seminar Room'),
(2, 'Lab 1'),
(3, 'Lab 2'),
(4, 'CCNA Lab');

-- --------------------------------------------------------

--
-- Table structure for table `labslot`
--

DROP TABLE IF EXISTS `labslot`;
CREATE TABLE IF NOT EXISTS `labslot` (
  `slot_id` int NOT NULL AUTO_INCREMENT,
  `lab` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `date` int NOT NULL,
  `oneday` date DEFAULT NULL,
  `published` tinyint DEFAULT NULL,
  PRIMARY KEY (`slot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labslot`
--

INSERT INTO `labslot` (`slot_id`, `lab`, `course`, `start`, `end`, `date`, `oneday`) VALUES
(1, 'lab1', 'CourseA', '09:00:00', '11:00:00', 0, NULL),
(2, 'lab1', 'CourseB', '13:30:00', '15:00:00', 2, NULL),
(3, 'Lab2', 'CourseC', '10:30:00', '12:30:00', 1, NULL),
(4, 'lab2', 'CourseD', '14:00:00', '16:00:00', 3, NULL),
(5, 'ccna', 'CCNA101', '08:00:00', '12:00:00', 4, '2023-09-22'),
(6, 'sr', 'SR202', '15:00:00', '17:00:00', 5, '2023-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `previous_event`
--

DROP TABLE IF EXISTS `previous_event`;
CREATE TABLE IF NOT EXISTS `previous_event` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(100) DEFAULT NULL,
  `p_img` varchar(100) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int NOT NULL COMMENT 'f_key User_id',
  `published` tinyint DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previous_event`
--

INSERT INTO `previous_event` (`p_id`, `p_name`, `p_img`, `display_from`, `display_to`, `added_by`) VALUES
(1, 'Previous Event 1', 'prev_event1.jpg', '2022-12-01', '2022-12-15', 1),
(2, 'Previous Event 2', 'prev_event2.jpg', '2022-11-01', '2022-11-15', 2),
(3, 'Previous Event 3', 'prev_event3.jpg', '2022-10-01', '2022-10-15', 3),
(4, 'Previous Event 4', 'prev_event4.jpg', '2022-09-01', '2022-09-15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

DROP TABLE IF EXISTS `timetable`;
CREATE TABLE IF NOT EXISTS `timetable` (
  `c_code` varchar(20) NOT NULL,
  `f_id` int NOT NULL,
  `lec_day` tinytext NOT NULL COMMENT 'Monday - Friday',
  `lec_time` time NOT NULL,
  PRIMARY KEY (`c_code`,`f_id`),
  KEY `fk_f_id` (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`c_code`, `f_id`, `lec_day`, `lec_time`) VALUES
('COURSE01', 1, 'Monday', '09:00:00'),
('COURSE01', 2, 'Wednesday', '11:00:00'),
('COURSE02', 3, 'Tuesday', '14:00:00'),
('COURSE03', 4, 'Thursday', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_event`
--

DROP TABLE IF EXISTS `upcoming_event`;
CREATE TABLE IF NOT EXISTS `upcoming_event` (
  `e_id` int NOT NULL AUTO_INCREMENT,
  `e_name` varchar(100) DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `e_venue` varchar(100) DEFAULT NULL,
  `e_img` varchar(100) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int NOT NULL COMMENT 'f_key -userId',
  `published` tinyint DEFAULT NULL,
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upcoming_event`
--

INSERT INTO `upcoming_event` (`e_id`, `e_name`, `e_date`, `e_time`, `e_venue`, `e_img`, `display_from`, `display_to`, `added_by`) VALUES
(1, 'Event 1', '2023-09-20', '09:00:00', 'Seminar Room', 'event1.jpg', '2023-09-10', '2023-09-22', 1),
(2, 'Event 2', '2023-09-21', '11:00:00', 'Auditorium', 'event2.jpg', '2023-09-12', '2023-09-24', 2),
(3, 'Event 3', '2023-09-22', '09:00:00', 'Classroom A', 'event3.jpg', '2023-09-14', '2023-09-26', 3),
(4, 'Event 4', '2023-09-23', '15:00:00', 'Seminar Room', 'event4.jpg', '2023-09-16', '2023-09-28', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `clearense` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `email`, `password`, `contact`, `clearense`) VALUES
(1, 'John Doe', 'john@example.com', '1', '1234567890', 'Clearance1'),
(2, 'Jane Smith', 'jane@example.com', '2', '9876543210', 'Clearance2'),
(3, 'Alice Johnson', 'alice@example.com', '3', '5555555555', 'Clearance3'),
(4, 'Bob Williams', 'bob@example.com', '4', '9999999999', 'Clearance4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
