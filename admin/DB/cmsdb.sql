-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2023 at 03:03 PM
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
  `published` tinyint(4) NOT NULL DEFAULT 0,
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
    '/images/upcoming-event-posters/img-2.png',
    7,
    1
  ),
  (
    2,
    'Achievement 2',
    'Description 2',
    '2023-07-10',
    '/images/upcoming-event-posters/img-1.png',
    7,
    1
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
  `published` tinyint(4) NOT NULL DEFAULT 0,
  `poster` varchar(500) DEFAULT NULL,
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
    `published`,
    `poster`
  )
VALUES
  (
    5,
    'CCNA01',
    'Cisco Certified Network Associate',
    'John Doe',
    'A comprehensive course on network fundamentals and Cisco technologies.',
    '',
    6,
    '2023-09-15',
    1500,
    'Learn the essentials of networking and gain Cisco certification.',
    0,
    NULL
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
    0,
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
    0,
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
    0,
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
    0,
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
  ('Lab Slots', 1000, NULL),
  ('Course Offerings', 1000, 1),
  ('Upcoming Events', 1000, 1),
  ('Previous Events', 1000, 1),
  ('Achievements', 1000, 1);

-- --------------------------------------------------------
--
-- Table structure for table `facility`
--
DROP TABLE IF EXISTS `facility`;


CREATE TABLE IF NOT EXISTS `facility` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `total_seats` int NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`f_id`, `f_name`, `total_seats`, `price`) VALUES
(1, 'Seminar Room', 100, 100),
(2, 'Lab 1', 50, 50),
(3, 'Lab 2', 50, 50),
(4, 'CCNA Lab', 20, 150);


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
) ENGINE = MyISAM AUTO_INCREMENT = 31 DEFAULT CHARSET = latin1;

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
    20,
    'ccna',
    'CCNA01',
    '08:00:00',
    '10:00:00',
    0,
    NULL,
    NULL
  ),
  (
    22,
    'lab1',
    'CCNA01',
    '12:00:00',
    '17:00:00',
    5,
    NULL,
    NULL
  ),
  (
    23,
    'lab2',
    'ML101',
    '08:00:00',
    '10:00:00',
    2,
    NULL,
    NULL
  ),
  (
    24,
    'ccna',
    'CCNA01',
    '13:00:00',
    '17:00:00',
    2,
    NULL,
    NULL
  ),
  (
    25,
    'sr',
    'CCNA01',
    '11:05:00',
    '12:45:00',
    2,
    NULL,
    NULL
  ),
  (
    30,
    'lab1',
    'CCNA01',
    '08:00:00',
    '13:30:00',
    2,
    '2023-10-25',
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
    '/images/previous-event-posters/img2.jpg',
    '2023-09-16',
    '2023-11-21',
    7,
    1
  ),
  (
    5,
    'Event New',
    '2023-10-20',
    '09:40:00',
    'IT center',
    '/images/previous-event-posters/upcoming-event-4.png',
    '2023-10-06',
    '2023-10-19',
    7,
    1
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
) ENGINE = MyISAM AUTO_INCREMENT = 8 DEFAULT CHARSET = latin1;

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
    '/images/upcoming-event-posters/upcoming-event-4.png',
    '2023-09-16',
    '2023-09-28',
    10,
    0
  ),
  (
    5,
    'Event New',
    '2023-10-20',
    '09:40:00',
    'IT center',
    '/images/upcoming-event-posters/upcoming-event-2.jpg',
    '2023-10-06',
    '2023-10-19',
    7,
    1
  ),
  (
    6,
    'Event edited',
    '2023-10-19',
    '12:00:00',
    'IT center Hall',
    '/images/upcoming-event-posters/upcoming-event-1.jpg',
    '2023-10-15',
    '2023-10-19',
    7,
    1
  ),
  (
    7,
    'Event edited',
    '2023-10-31',
    '08:41:00',
    'IT center',
    '/images/upcoming-event-posters/upcoming-event-3.jpg',
    '2023-10-16',
    '2023-10-30',
    7,
    1
  );

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_name` varchar(100) NOT NULL,
  `m_file` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `m_desc` text,
  `added_by` int NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `map`
--
INSERT INTO `map` (`m_id`, `m_name`, `m_file`, `m_desc`, `added_by`) VALUES
(1, 'Map 1', '/images/maps/map1.mp4', 'This is the firstuihdhdjhwohjedklwnxowhxlkjwsjndxowdkjkwhxiedw;ncorieuoncoweifcnbedlewmxerhrfeddxneowchbewouhbcowehcdnworhfochneowehcxwoneohowjcxnoejpvcpejcnwpiepfhcodsnbwoheoneowbgcwuhegbweixbwurhfoeijfriyvfhrfhvcrelwcfkpoewedeiufbekwqlefhgceirufidcgoeq;efyeo[fdheofheowfbckehwqirhfeytfrurifg1fip1epfdhecbevcbe1gqgpwgergf934ggdieufeowihrfiehfdeigcgieuwqegfdeidbciewqedheohvoerferyigfcbedcq;wedoeiuyf374gekbceufhye4yfegbdcxbedwilu map', 1),
(2, 'Map 2', '/images/maps/map2.mp4', 'A description of the second map', 2),
(3, 'Map 3', '/images/maps/map3.mp4', 'The third map with some details', 1);

COMMIT;
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
) ENGINE = MyISAM AUTO_INCREMENT = 11 DEFAULT CHARSET = latin1;

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
    9,
    'test1',
    'test1@test.co',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    '4564654654',
    'course_c'
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
  ),
  (
    10,
    'admin1',
    'admin@test.com',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    '',
    'admin'
  );

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `f_id` int NOT NULL,
  `b_date` date NOT NULL,
  `b_timeslot` varchar(20) NOT NULL,
  `b_seats` int NOT NULL,
  `b_for` varchar(100) NOT NULL,
  `b_by` int NOT NULL,
  PRIMARY KEY (`b_id`),
  KEY `fk_admin_id` (`b_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `booking`
ADD CONSTRAINT `fk_facility_id`
FOREIGN KEY (`f_id`) REFERENCES `facility` (`f_id`);

INSERT INTO `booking` (`f_id`, `b_date`, `b_timeslot`, `b_seats`, `b_for`, `b_by`)
VALUES
(1, '2023-11-01', '08:00 - 09:00 AM', 2, 'John Doe', 1),
(2, '2023-11-02', '09:00 - 10:00 AM', 3, 'Alice Smith', 2),
(3, '2023-11-03', '10:00 - 11:00 AM', 1, 'Bob Johnson', 3),
(4, '2023-11-04', '11:00 - 12:00 PM', 4, 'Eva White', 4);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;