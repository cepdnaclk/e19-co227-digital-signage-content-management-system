-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2023 at 04:31 PM
-- Server version: 10.4.10-MariaDB
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
USE cmsdb;
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
  `published` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`a_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE = MyISAM AUTO_INCREMENT = 5 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `achievement`
--
INSERT INTO
  `achievement` (
    `a_id`,
    `a_name`,
    `a_desc`,
    `a_date`,
    `a_img`,
    `added_by`,
    `published`
  )
VALUES
  (
    1,
    'Achievement 1',
    'Description 1',
    '2023-06-10',
    'achievement1.jpg',
    1,
    NULL
  ),
  (
    2,
    'Achievement 2',
    'Description 2',
    '2023-07-10',
    'achievement2.jpg',
    2,
    NULL
  ),
  (
    3,
    'Achievement 3',
    'Description 3',
    '2023-08-10',
    'achievement3.jpg',
    3,
    NULL
  ),
  (
    4,
    'Achievement 4',
    'Description 4',
    '2023-09-10',
    'achievement5.jpg',
    4,
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `contactsupport`
--
DROP TABLE IF EXISTS `contactsupport`;

CREATE TABLE IF NOT EXISTS `contactsupport` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM AUTO_INCREMENT = 9 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `contactsupport`
--
INSERT INTO
  `contactsupport` (`id`, `name`, `email`, `message`)
VALUES
  (
    5,
    'John Doe',
    'john@example.com',
    'I have a question about your services.'
  ),
  (
    6,
    'Alice Smith',
    'alice@example.com',
    'I encountered an issue with my account.'
  ),
  (
    7,
    'Bob Johnson',
    'bob@example.com',
    'I would like to request more information about your products.'
  ),
  (
    8,
    'Eve Wilson',
    'eve@example.com',
    'I need assistance with a recent purchase.'
  );

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
  `description` text DEFAULT NULL,
  `Poster_img` varchar(255) DEFAULT NULL,
  `duration(months)` int(11) DEFAULT NULL,
  `new_intake_date` date DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `display_description` text DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 10 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `course`
--
INSERT INTO
  `course` (
    `c_id`,
    `c_code`,
    `c_name`,
    `c_coordinator`,
    `description`,
    `Poster_img`,
    `duration(months)`,
    `new_intake_date`,
    `total_fee`,
    `display_description`,
    `published`
  )
VALUES
  (
    5,
    'CCNA01',
    'Cisco Certified Network Associate',
    'John Doe',
    'A comprehensive course on network fundamentals and Cisco technologies.',
    'ccna_img.jpg',
    6,
    '2023-09-15',
    1500,
    'Learn the essentials of networking and gain Cisco certification.',
    0
  ),
  (
    6,
    'WEBDEV01',
    'Web Development Fundamentals',
    'Jane Smith',
    'An introductory course to web development technologies and practices.',
    'webdev_img.jpg',
    3,
    '2023-10-05',
    1200,
    'Build websites and web applications with HTML, CSS, and JavaScript.',
    NULL
  ),
  (
    7,
    'ML101',
    'Machine Learning Basics',
    'Michael Johnson',
    'Explore the fundamentals of machine learning and data analysis.',
    'ml_img.jpg',
    4,
    '2023-11-20',
    1800,
    'Get started with machine learning and understand its applications.',
    NULL
  ),
  (
    8,
    'HARDWARE01',
    'Computer Hardware Essentials',
    'Sarah Williams',
    'Learn about computer hardware components and troubleshooting techniques.',
    'hardware_img.jpg',
    2,
    '2023-12-10',
    900,
    'Discover the inner workings of computers and how to fix common issues.',
    NULL
  ),
  (
    9,
    'DBADMIN01',
    'Database Administration',
    'David Brown',
    'A course on managing and optimizing relational databases.',
    'dbadmin_img.jpg',
    5,
    '2024-01-05',
    1600,
    'Master the art of database administration and SQL query optimization.',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `dashboard`
--
DROP TABLE IF EXISTS `dashboard`;

CREATE TABLE IF NOT EXISTS `dashboard` (
  `feature` varchar(100) NOT NULL,
  `time` int(11) DEFAULT 0,
  `time_slide` int(10) DEFAULT NULL,
  PRIMARY KEY (`feature`)
) ENGINE = MyISAM AUTO_INCREMENT = 5 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `dashboard`
--
INSERT INTO
  `dashboard` (`feature`, `time`, `time_slide`)
VALUES
  ('Lab Slots', 3, 1),
  ('Course Offerings', 2, 1),
  ('Upcoming Events', 2, 1),
  ('Previous Events', 2, 1),
  ('Achievements', 3, 1);

-- --------------------------------------------------------
--
-- Table structure for table `facility`
--
DROP TABLE IF EXISTS `facility`;

CREATE TABLE IF NOT EXISTS `facility` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 5 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `facility`
--
INSERT INTO
  `facility` (`f_id`, `f_name`)
VALUES
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
  `slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `date` int(11) NOT NULL,
  `oneday` date DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`slot_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 20 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `labslot`
--
INSERT INTO
  `labslot` (
    `slot_id`,
    `lab`,
    `course`,
    `start`,
    `end`,
    `date`,
    `oneday`,
    `published`
  )
VALUES
  (
    1,
    'lab1',
    'CourseA',
    '09:00:00',
    '11:00:00',
    0,
    NULL,
    NULL
  ),
  (
    2,
    'lab1',
    'CourseB',
    '13:30:00',
    '15:00:00',
    2,
    NULL,
    NULL
  ),
  (
    13,
    'lab2',
    'IT01',
    '08:00:00',
    '11:00:00',
    1,
    NULL,
    NULL
  ),
  (
    4,
    'lab2',
    'CourseD',
    '14:00:00',
    '16:00:00',
    3,
    NULL,
    NULL
  ),
  (
    5,
    'ccna',
    'CCNA101',
    '08:00:00',
    '12:00:00',
    4,
    '2023-09-22',
    NULL
  ),
  (
    6,
    'sr',
    'SR202',
    '15:00:00',
    '17:00:00',
    5,
    '2023-09-23',
    NULL
  ),
  (
    17,
    'lab1',
    'IT01',
    '13:30:00',
    '15:00:00',
    2,
    NULL,
    NULL
  );

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
  `published` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE = MyISAM AUTO_INCREMENT = 6 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `previous_event`
--
INSERT INTO
  `previous_event` (
    `e_id`,
    `e_name`,
    `e_date`,
    `e_time`,
    `e_venue`,
    `e_img`,
    `display_from`,
    `display_to`,
    `added_by`,
    `published`
  )
VALUES
  (
    3,
    'Event 3',
    '2023-09-22',
    '09:00:00',
    'Classroom A',
    'event3.jpg',
    '2023-09-14',
    '2023-09-26',
    3,
    0
  ),
  (
    4,
    'Event 4',
    '2023-09-23',
    '15:00:00',
    'Seminar Room',
    'event4.jpg',
    '2023-09-16',
    '2023-09-28',
    4,
    0
  ),
  (
    5,
    'Event New',
    '2023-10-20',
    '09:40:00',
    'IT center',
    '../images/previous-event-posters/Capture.PNG',
    '2023-10-06',
    '2023-10-19',
    1,
    0
  );

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
  `published` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE = MyISAM AUTO_INCREMENT = 7 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `upcoming_event`
--
INSERT INTO
  `upcoming_event` (
    `e_id`,
    `e_name`,
    `e_date`,
    `e_time`,
    `e_venue`,
    `e_img`,
    `display_from`,
    `display_to`,
    `added_by`,
    `published`
  )
VALUES
  (
    3,
    'Event 3',
    '2023-09-22',
    '09:00:00',
    'Classroom A',
    'event3.jpg',
    '2023-09-14',
    '2023-09-26',
    3,
    1
  ),
  (
    4,
    'Event 4',
    '2023-09-23',
    '15:00:00',
    'Seminar Room',
    'event4.jpg',
    '2023-09-16',
    '2023-09-28',
    4,
    0
  ),
  (
    5,
    'Event New',
    '2023-10-20',
    '09:40:00',
    'IT center',
    '../images/upcoming-event-posters/Capture.PNG',
    '2023-10-06',
    '2023-10-19',
    1,
    0
  ),
  (
    6,
    'Event edited',
    '2023-10-19',
    '12:00:00',
    'IT center Hall',
    '/images/upcoming-event-posters/Screenshot (11).png',
    '2023-10-15',
    '2023-10-19',
    7,
    1
  );

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
) ENGINE = MyISAM AUTO_INCREMENT = 9 DEFAULT CHARSET = latin1;

--
-- Dumping data for table `user`
--
INSERT INTO
  `user` (
    `u_id`,
    `user_name`,
    `email`,
    `password`,
    `contact`,
    `clearense`
  )
VALUES
  (
    8,
    'test1',
    'test1@test.com',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    '',
    'admin'
  ),
  (
    7,
    'SuperAdmin',
    'super@test.com',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    '',
    'super_admin'
  ),
  (
    6,
    'test2',
    'test2@mail.com',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    '',
    'admin'
  );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;