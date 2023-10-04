-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 04, 2023 at 06:32 PM
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
-- Database: `academetrics`
--
CREATE DATABASE IF NOT EXISTS `academetrics` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `academetrics`;

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
-- Table structure for table `assesment`
--

DROP TABLE IF EXISTS `assesment`;
CREATE TABLE IF NOT EXISTS `assesment` (
  `asses_id` int NOT NULL AUTO_INCREMENT,
  `max_marks` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`asses_id`),
  KEY `FK12oov9r01cheoouvyapjv1gwi` (`year`,`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `year` int NOT NULL,
  `course_code` varchar(255) NOT NULL,
  PRIMARY KEY (`year`,`course_code`),
  KEY `FKo7xj3e85d9ynarl3h3byg3cm4` (`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_offering`
--

INSERT INTO `course_offering` (`year`, `course_code`) VALUES
(2023, 'CO221'),
(2023, 'CO222'),
(2023, 'CO223'),
(2023, 'CO224'),
(2023, 'CO225'),
(2023, 'CO226'),
(2023, 'EE282'),
(2023, 'EE285'),
(2023, 'EM211'),
(2023, 'EM212'),
(2023, 'EM213'),
(2023, 'EM214'),
(2023, 'EM215');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
('CE', 'Department of Civil Engineering'),
('CO', 'Department of Computer Engineering'),
('CP', 'Department of Chemical & Process Engineering'),
('EE', 'Department of Electrical & Electronic Engineering'),
('EM', 'Department of Engineering Mathematics'),
('ME', 'Department of Mechanical Engineering'),
('PR', 'Department of Manufacturing & Industrial Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `assessment_id` int DEFAULT NULL,
  `grade_id` int DEFAULT NULL,
  `id` bigint NOT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsfgb5xn6qjwflridgn9gbhm46` (`assessment_id`),
  KEY `FK2eh2j0y2hqphucbj0olqbo1i2` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `academic_year` int NOT NULL,
  `dept_rank` int NOT NULL,
  `gpa` float NOT NULL,
  `semester` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

DROP TABLE IF EXISTS `student_course`;
CREATE TABLE IF NOT EXISTS `student_course` (
  `course_offering_year` int DEFAULT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  `course_offering_course_code` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `student_user_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcot7hhab1ouw11c27825m0ar6` (`course_offering_year`,`course_offering_course_code`),
  KEY `FKtnrd0of8gllswwnuppjfjs8eu` (`student_user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_following_courses`
--

DROP TABLE IF EXISTS `student_following_courses`;
CREATE TABLE IF NOT EXISTS `student_following_courses` (
  `following_courses_year` int NOT NULL,
  `following_courses_course_code` varchar(255) NOT NULL,
  `student_user_name` varchar(255) NOT NULL,
  KEY `FKmbomvd20l5v4tpkdscrq1vpx` (`following_courses_year`,`following_courses_course_code`),
  KEY `FKqdc08xexlhlxv69rpplpby0bi` (`student_user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `contact` varchar(255) DEFAULT NULL,
  `dept_id` varchar(255) DEFAULT NULL,
  `honorific` varchar(255) DEFAULT NULL,
  `initials` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_name`),
  KEY `FKmf82od1cs7u7drq5eua8ukyrw` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assesment`
--
ALTER TABLE `assesment`
  ADD CONSTRAINT `FK12oov9r01cheoouvyapjv1gwi` FOREIGN KEY (`year`,`course_code`) REFERENCES `course_offering` (`year`, `course_code`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `FK2eh2j0y2hqphucbj0olqbo1i2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  ADD CONSTRAINT `FKsfgb5xn6qjwflridgn9gbhm46` FOREIGN KEY (`assessment_id`) REFERENCES `assesment` (`asses_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK1nwjdu600dak7y9ygw4p3lo35` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `FKcot7hhab1ouw11c27825m0ar6` FOREIGN KEY (`course_offering_year`,`course_offering_course_code`) REFERENCES `course_offering` (`year`, `course_code`),
  ADD CONSTRAINT `FKtnrd0of8gllswwnuppjfjs8eu` FOREIGN KEY (`student_user_name`) REFERENCES `student` (`user_name`);

--
-- Constraints for table `student_following_courses`
--
ALTER TABLE `student_following_courses`
  ADD CONSTRAINT `FKmbomvd20l5v4tpkdscrq1vpx` FOREIGN KEY (`following_courses_year`,`following_courses_course_code`) REFERENCES `course_offering` (`year`, `course_code`),
  ADD CONSTRAINT `FKqdc08xexlhlxv69rpplpby0bi` FOREIGN KEY (`student_user_name`) REFERENCES `student` (`user_name`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FKmf82od1cs7u7drq5eua8ukyrw` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`);
--
-- Database: `academetricsdb`
--
CREATE DATABASE IF NOT EXISTS `academetricsdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `academetricsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

DROP TABLE IF EXISTS `assesment`;
CREATE TABLE IF NOT EXISTS `assesment` (
  `c_code` varchar(20) NOT NULL,
  `a_id` tinyint NOT NULL AUTO_INCREMENT,
  `a_type` varchar(50) NOT NULL,
  `max_marks` tinyint NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `c_code` (`c_code`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assesment`
--

INSERT INTO `assesment` (`c_code`, `a_id`, `a_type`, `max_marks`) VALUES
('GP106', 1, 'Mid Exam', 20),
('GP106', 2, 'Project', 10),
('CO225', 3, 'Project', 30),
('CO225', 4, 'Lab-1', 5),
('CO225', 5, 'Lab-2', 5),
('CO225', 6, 'Lab-3', 5),
('CO225', 7, 'Lab-4', 5),
('CO225', 8, 'Quiz-1', 5),
('CO225', 9, 'Quiz-2', 5),
('EM215', 10, 'Mid Exam', 20),
('EM215', 11, 'Lab Assignment -1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `assesment_marks`
--

DROP TABLE IF EXISTS `assesment_marks`;
CREATE TABLE IF NOT EXISTS `assesment_marks` (
  `stu_id` int NOT NULL,
  `a_id` tinyint NOT NULL,
  `marks` tinyint NOT NULL,
  PRIMARY KEY (`stu_id`,`a_id`),
  KEY `a_id` (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `C_id` int NOT NULL,
  `C_name` varchar(255) NOT NULL,
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`C_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_id`, `C_name`, `id`, `name`) VALUES
(13, 'Java', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_offering`
--

DROP TABLE IF EXISTS `course_offering`;
CREATE TABLE IF NOT EXISTS `course_offering` (
  `Course_id` int NOT NULL,
  `Coord_id` int NOT NULL,
  `offered_by` int NOT NULL,
  `offered_to` int NOT NULL,
  `Course_code` varchar(20) NOT NULL,
  `year` int NOT NULL,
  `batch` int NOT NULL,
  `semester` tinyint NOT NULL,
  `credits` tinyint NOT NULL,
  PRIMARY KEY (`Course_code`,`year`),
  KEY `Course_id` (`Course_id`),
  KEY `Coord_id` (`Coord_id`),
  KEY `offered_by` (`offered_by`),
  KEY `offered_to` (`offered_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_offering`
--

INSERT INTO `course_offering` (`Course_id`, `Coord_id`, `offered_by`, `offered_to`, `Course_code`, `year`, `batch`, `semester`, `credits`) VALUES
(1, 1, 3, 4, 'GP106', 2023, 20, 2, 3),
(2, 2, 3, 5, 'GP106', 2021, 19, 1, 3),
(3, 3, 3, 1, 'CO225', 2023, 19, 4, 3),
(4, 4, 8, 1, 'EM212', 2023, 19, 4, 2),
(5, 5, 3, 3, 'CO225', 2021, 18, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `course_seq`
--

DROP TABLE IF EXISTS `course_seq`;
CREATE TABLE IF NOT EXISTS `course_seq` (
  `next_val` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_seq`
--

INSERT INTO `course_seq` (`next_val`) VALUES
(51);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `D_id` int UNSIGNED NOT NULL,
  `D_name` varchar(100) NOT NULL,
  PRIMARY KEY (`D_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`D_id`, `D_name`) VALUES
(1, 'Civil Engineering'),
(2, 'Chemical and Processing Engineering'),
(3, 'Computer Engineering'),
(4, 'Electrical and Electronic Engineering'),
(5, 'Manufacturing and Industrial Engineering'),
(6, 'Mechanical Engineering'),
(7, 'Engineering Management'),
(8, 'Engineering Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `following_courses`
--

DROP TABLE IF EXISTS `following_courses`;
CREATE TABLE IF NOT EXISTS `following_courses` (
  `Stu_id` int NOT NULL,
  `Course_code` varchar(10) NOT NULL,
  `Final_grades` varchar(2) NOT NULL,
  PRIMARY KEY (`Stu_id`,`Course_code`),
  KEY `Course_code` (`Course_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `S_id` int NOT NULL,
  `Batch` int NOT NULL,
  `Academic_year` tinyint NOT NULL,
  `Semester` tinyint NOT NULL,
  `gpa` double NOT NULL,
  `D_rank` int UNSIGNED NOT NULL,
  PRIMARY KEY (`S_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`S_id`, `Batch`, `Academic_year`, `Semester`, `gpa`, `D_rank`) VALUES
(1, 19, 2, 4, 3.5, 1),
(2, 17, 4, 8, 3.2, 2),
(3, 18, 3, 6, 3.7, 3),
(4, 20, 1, 2, 3, 4),
(5, 19, 2, 4, 3.9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int UNSIGNED NOT NULL,
  `User_name` varchar(100) NOT NULL DEFAULT 'NOT NULL',
  `Password` varchar(255) NOT NULL,
  `Gmail` varchar(255) NOT NULL,
  `Initials` varchar(20) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `sex` tinyint NOT NULL,
  `b_year` year NOT NULL,
  `b_month` tinyint NOT NULL,
  `b_date` tinyint NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `addressline1` varchar(50) DEFAULT NULL,
  `addressline2` varchar(50) DEFAULT NULL,
  `addressline3` varchar(50) DEFAULT NULL,
  `Dep_id` int NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Dep_id` (`Dep_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `User_name`, `Password`, `Gmail`, `Initials`, `Last_name`, `sex`, `b_year`, `b_month`, `b_date`, `profile_picture`, `addressline1`, `addressline2`, `addressline3`, `Dep_id`, `contact_no`, `role`, `email`, `name`, `username`) VALUES
(1, 'kavishkagaya', 'password', 'kavishkagaya@example.com', 'K.G.', 'Dissanayake', 1, 2000, 5, 10, NULL, '123 Main St', 'Colombo', 'Sri Lanka', 1, '1234567890', 'student', NULL, NULL, NULL),
(2, 'gabrielinesha', 'password', 'ineshag@example.com', 'I.G.', 'De Silva', 1, 1999, 8, 15, NULL, '456 Elm St', 'Kandy', 'Sri Lanka', 2, '9876543210', 'student', NULL, NULL, NULL),
(3, 'silvaboss', 'password', 'boss_silva@example.com', 'S.B', 'Rambukwella', 1, 1999, 3, 20, NULL, '789 Oak St', 'Galle', 'Sri Lanka', 3, '5678901234', 'student', NULL, NULL, NULL),
(4, 'thiranjaya', 'password', 'thiranjaya@example.com', 'T.', 'Rajapaksa', 1, 1999, 11, 5, NULL, '321 Pine St', 'Jaffna', 'Sri Lanka', 4, '4321098765', 'student', NULL, NULL, NULL),
(5, 'denuwankalindu', 'password', 'denuwankalindu@example.com', 'D.K.', 'Senevirathna', 1, 2000, 2, 1, NULL, '654 Maple St', 'Matara', 'Sri Lanka', 5, '9012345678', 'student', NULL, NULL, NULL),
(6, 'manodya', 'password', 'gomezmanodya@example.com', 'M.', 'Gomez', 1, 2000, 9, 25, NULL, '987 Pine St', 'Negombo', 'Sri Lanka', 1, '7890123456', 'student', NULL, NULL, NULL),
(7, 'dinukanemo', 'password', 'dinukanemo@example.com', 'D.N.', 'Wickramasinghe', 1, 2000, 4, 12, NULL, '654 Oak St', 'Colombo', 'Sri Lanka', 2, '5678901234', 'student', NULL, NULL, NULL),
(8, 'sanka', 'password', 'peterson_sanka@example.com', 'S.M', 'Peterson', 1, 1999, 11, 8, NULL, '321 Elm St', 'Kandy', 'Sri Lanka', 3, '9012345678', 'student', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_seq`
--

DROP TABLE IF EXISTS `user_seq`;
CREATE TABLE IF NOT EXISTS `user_seq` (
  `next_val` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_seq`
--

INSERT INTO `user_seq` (`next_val`) VALUES
(1);
--
-- Database: `cmsdb`
--
CREATE DATABASE IF NOT EXISTS `cmsdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cmsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

DROP TABLE IF EXISTS `achievement`;
CREATE TABLE IF NOT EXISTS `achievement` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(100) DEFAULT NULL,
  `a_desc` varchar(500) DEFAULT NULL,
  `a_img` varchar(100) NOT NULL,
  `added_by` int NOT NULL COMMENT 'F_key - UserId',
  `published` tinyint DEFAULT NULL,
  PRIMARY KEY (`a_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`a_id`, `a_name`, `a_desc`, `a_img`, `added_by`, `published`) VALUES
(1, 'Achievement 1', 'Description 1', 'achievement1.jpg', 1, NULL),
(2, 'Achievement 2', 'Description 2', 'achievement2.jpg', 2, NULL),
(3, 'Achievement 3', 'Description 3', 'achievement3.jpg', 3, NULL),
(4, 'Achievement 4', 'Description 4', 'achievement5.jpg', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_code` varchar(50) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_coordinator` varchar(100) NOT NULL,
  `description` text,
  `Poster_img` varchar(255) DEFAULT NULL,
  `duration(months)` int DEFAULT NULL,
  `new_intake_date` date DEFAULT NULL,
  `total_fee` int DEFAULT NULL,
  `display_description` text,
  `published` tinyint DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `c_code`, `c_name`, `c_coordinator`, `description`, `Poster_img`, `duration(months)`, `new_intake_date`, `total_fee`, `display_description`, `published`) VALUES
(5, 'CCNA01', 'Cisco Certified Network Associate', 'John Doe', 'A comprehensive course on network fundamentals and Cisco technologies.', 'ccna_img.jpg', 6, '2023-09-15', 1500, 'Learn the essentials of networking and gain Cisco certification.', NULL),
(6, 'WEBDEV01', 'Web Development Fundamentals', 'Jane Smith', 'An introductory course to web development technologies and practices.', 'webdev_img.jpg', 3, '2023-10-05', 1200, 'Build websites and web applications with HTML, CSS, and JavaScript.', NULL),
(7, 'ML101', 'Machine Learning Basics', 'Michael Johnson', 'Explore the fundamentals of machine learning and data analysis.', 'ml_img.jpg', 4, '2023-11-20', 1800, 'Get started with machine learning and understand its applications.', NULL),
(8, 'HARDWARE01', 'Computer Hardware Essentials', 'Sarah Williams', 'Learn about computer hardware components and troubleshooting techniques.', 'hardware_img.jpg', 2, '2023-12-10', 900, 'Discover the inner workings of computers and how to fix common issues.', NULL),
(9, 'DBADMIN01', 'Database Administration', 'David Brown', 'A course on managing and optimizing relational databases.', 'dbadmin_img.jpg', 5, '2024-01-05', 1600, 'Master the art of database administration and SQL query optimization.', NULL);

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

INSERT INTO `labslot` (`slot_id`, `lab`, `course`, `start`, `end`, `date`, `oneday`, `published`) VALUES
(1, 'lab1', 'CourseA', '09:00:00', '11:00:00', 0, NULL, NULL),
(2, 'lab1', 'CourseB', '13:30:00', '15:00:00', 2, NULL, NULL),
(3, 'Lab2', 'CourseC', '10:30:00', '12:30:00', 1, NULL, NULL),
(4, 'lab2', 'CourseD', '14:00:00', '16:00:00', 3, NULL, NULL),
(5, 'ccna', 'CCNA101', '08:00:00', '12:00:00', 4, '2023-09-22', NULL),
(6, 'sr', 'SR202', '15:00:00', '17:00:00', 5, '2023-09-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `previous_event`
--

DROP TABLE IF EXISTS `previous_event`;
CREATE TABLE IF NOT EXISTS `previous_event` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(100) DEFAULT NULL,
  `p_desc` varchar(500) DEFAULT NULL,
  `p_date` date DEFAULT NULL,
  `p_img` varchar(100) NOT NULL,
  `added_by` int NOT NULL COMMENT 'f_key User_id',
  `published` tinyint DEFAULT '0',
  PRIMARY KEY (`p_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previous_event`
--

INSERT INTO `previous_event` (`p_id`, `p_name`, `p_desc`, "p_date", `p_img`, `added_by`) VALUES
(1, 'Previous Event 1', 'Description 1', '2023-06-10', 'prev-event1.jpg', 1),
(2, 'Previous Event 2', 'Description 2', '2023-07-10', 'prev-event2.jpg', 2),
(3, 'Previous Event 3', 'Description 3', '2023-08-10', 'prev-event3.jpg', 3),
(4, 'Previous Event 4', 'Description 4', '2023-09-10', 'prev-event4.jpg', 4);
INSERT INTO `previous_event` (`p_id`, `p_name`, `p_desc`, `p_img`, `added_by`, `published`) VALUES
(1, 'Previous Event 1', 'Description 1', 'prev-event1.jpg', 1, 0),
(2, 'Previous Event 2', 'Description 2', 'prev-event2.jpg', 2, 0),
(3, 'Previous Event 3', 'Description 3', 'prev-event3.jpg', 3, 0),
(4, 'Previous Event 4', 'Description 4', 'prev-event4.jpg', 4, 0);

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
  `published` tinyint DEFAULT '0',
  PRIMARY KEY (`e_id`),
  KEY `fk_admin_id` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upcoming_event`
--

INSERT INTO `upcoming_event` (`e_id`, `e_name`, `e_date`, `e_time`, `e_venue`, `e_img`, `display_from`, `display_to`, `added_by`, `published`) VALUES
(1, 'Event 1', '2023-09-20', '09:00:00', 'Seminar Room', 'event1.jpg', '2023-09-10', '2023-09-22', 1, 0),
(2, 'Event 2', '2023-09-21', '11:00:00', 'Auditorium', 'event2.jpg', '2023-09-12', '2023-09-24', 2, 0),
(3, 'Event 3', '2023-09-22', '09:00:00', 'Classroom A', 'event3.jpg', '2023-09-14', '2023-09-26', 3, 0),
(4, 'Event 4', '2023-09-23', '15:00:00', 'Seminar Room', 'event4.jpg', '2023-09-16', '2023-09-28', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `clearense` varchar(20) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `email`, `password`, `contact`, `clearense`) VALUES
(8, 'test1', 'test1@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'admin'),
(7, 'SuperAdmin', 'super@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'super_admin'),
(6, 'test2', 'test2@mail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'admin');
--
-- Database: `e19446lab05`
--
CREATE DATABASE IF NOT EXISTS `e19446lab05` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `e19446lab05`;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `Movie ID` int NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Year` year NOT NULL,
  `Director` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Movie ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`Movie ID`, `Title`, `Year`, `Director`) VALUES
(101, 'Gone with the Wind', 1964, 'Victor Fleming'),
(102, 'Star Wars', 2002, 'George Lucas'),
(103, 'The Sound of Music', 1990, 'Robert Wise'),
(104, 'E.T.', 2007, 'Steven Spielberg'),
(105, 'Titanic', 2022, 'James Cameron'),
(106, 'Snow White', 1962, NULL),
(107, 'Avatar', 2034, 'James Cameron'),
(108, 'Raiders of the Lost Ark', 2006, 'Steven Spielberg');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `Reviewer ID` int NOT NULL,
  `Movie ID` int NOT NULL,
  `Stars` int NOT NULL,
  `Rating Date` datetime DEFAULT NULL,
  KEY `fk_mov` (`Reviewer ID`),
  KEY `fk_rev` (`Movie ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`Reviewer ID`, `Movie ID`, `Stars`, `Rating Date`) VALUES
(203, 108, 5, '2011-01-12 00:00:00'),
(203, 108, 3, '2011-01-30 00:00:00'),
(205, 104, 3, '2011-01-22 00:00:00'),
(208, 104, 4, '2011-01-02 00:00:00'),
(207, 101, 5, NULL),
(207, 102, 5, NULL),
(207, 103, 5, NULL),
(207, 104, 5, NULL),
(207, 105, 5, NULL),
(207, 106, 5, NULL),
(207, 107, 5, NULL),
(207, 108, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

DROP TABLE IF EXISTS `reviewer`;
CREATE TABLE IF NOT EXISTS `reviewer` (
  `Reviewer ID` int NOT NULL,
  `Reviewer Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Reviewer ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`Reviewer ID`, `Reviewer Name`) VALUES
(201, 'Sarah Martinez'),
(202, 'Daniel Lewis'),
(203, 'Brittany Harris'),
(204, 'Mike Anderson'),
(205, 'Chris Jackson'),
(206, 'Elizabeth Thomas'),
(207, 'James Cameron'),
(208, 'Ashley White');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_mov` FOREIGN KEY (`Reviewer ID`) REFERENCES `reviewer` (`Reviewer ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rev` FOREIGN KEY (`Movie ID`) REFERENCES `movie` (`Movie ID`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `e19446lab07`
--
CREATE DATABASE IF NOT EXISTS `e19446lab07` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `e19446lab07`;

-- --------------------------------------------------------

--
-- Table structure for table `convocation`
--

DROP TABLE IF EXISTS `convocation`;
CREATE TABLE IF NOT EXISTS `convocation` (
  `ConvoRegNo` int NOT NULL,
  `RegNo` int DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Address` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`ConvoRegNo`),
  KEY `RegNo` (`RegNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `convocation`
--

INSERT INTO `convocation` (`ConvoRegNo`, `RegNo`, `LastName`, `Age`, `Address`) VALUES
(1, 425, 'Bandara', 22, 'No. 123/A,Kaluthara'),
(2, 312, 'Rambukwella', 25, 'No. 123/A,Galagedara'),
(3, 473, 'Weerawardhane', 25, 'No. 10/2,Mawilmada'),
(4, 352, 'Rajapaksa', 26, 'No. 5/21,Rathnapura'),
(5, 456, 'Premairi', 27, 'No. 56/121,Kegalle');

-- --------------------------------------------------------

--
-- Table structure for table `lateregistration`
--

DROP TABLE IF EXISTS `lateregistration`;
CREATE TABLE IF NOT EXISTS `lateregistration` (
  `ConvoRegNo` int NOT NULL,
  `RegNo` int DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Address` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`ConvoRegNo`),
  KEY `RegNo` (`RegNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lateregistration`
--

INSERT INTO `lateregistration` (`ConvoRegNo`, `RegNo`, `LastName`, `Age`, `Address`) VALUES
(6, 210, 'Madushankar', 23, 'No. 113/9,Gampaha'),
(7, 201, 'Kariyawasam', 25, 'No. 19A/34,Gampola'),
(8, 111, 'Hathurusinghe', 26, 'No. 194/C,Peradeniya'),
(9, 324, 'Fernando', 26, 'No. 10/116,Galle'),
(10, 231, 'Somapala', 25, 'No. 21/116,Galle');

--
-- Triggers `lateregistration`
--
DROP TRIGGER IF EXISTS `LateRegState`;
DELIMITER $$
CREATE TRIGGER `LateRegState` AFTER INSERT ON `lateregistration` FOR EACH ROW BEGIN
		IF NEW.ConvoRegNo IS NOT NULL THEN
		UPDATE Student
		SET Student.ConvoRegNo = NEW.ConvoRegNo
		WHERE Student.RegNo = NEW.RegNo;
		END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `notregistered`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `notregistered`;
CREATE TABLE IF NOT EXISTS `notregistered` (
`Name` varchar(30)
,`RegNo` int
,`GPA` decimal(3,2)
,`Address` binary(0)
,`Age` binary(0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `registered`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `registered`;
CREATE TABLE IF NOT EXISTS `registered` (
`Name` varchar(30)
,`RegNo` int
,`GPA` decimal(3,2)
,`ConvoRegNo` int
,`Address` varchar(75)
,`Age` int
);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `Name` varchar(30) DEFAULT NULL,
  `RegNo` int NOT NULL,
  `GPA` decimal(3,2) DEFAULT NULL,
  `ConvoRegNo` int DEFAULT NULL,
  `Class` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`RegNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Name`, `RegNo`, `GPA`, `ConvoRegNo`, `Class`) VALUES
('Sameera', 425, '3.25', 1, 'Second class honors-lower division'),
('Kasun', 210, '3.40', 6, 'Second class honors-upper division'),
('Kai', 201, '3.10', 7, 'Second class honors-lower division'),
('Chathura', 312, '3.85', 2, 'First Class honors'),
('Lakmali', 473, '3.75', 3, 'First Class honors'),
('Sidath', 352, '3.30', 4, 'Second class honors-upper division'),
('Kumudu', 111, '3.70', 8, 'First Class honors'),
('Nalin', 456, '3.05', 5, 'Second class honors-lower division'),
('Rohani', 324, '3.70', 9, 'First Class honors'),
('Chithra', 231, '3.30', 10, 'Second class honors-upper division');

-- --------------------------------------------------------

--
-- Structure for view `notregistered`
--
DROP TABLE IF EXISTS `notregistered`;

DROP VIEW IF EXISTS `notregistered`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `notregistered`  AS SELECT `student`.`Name` AS `Name`, `student`.`RegNo` AS `RegNo`, `student`.`GPA` AS `GPA`, NULL AS `Address`, NULL AS `Age` FROM `student` WHERE (`student`.`ConvoRegNo` is null)  ;

-- --------------------------------------------------------

--
-- Structure for view `registered`
--
DROP TABLE IF EXISTS `registered`;

DROP VIEW IF EXISTS `registered`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `registered`  AS SELECT `student`.`Name` AS `Name`, `student`.`RegNo` AS `RegNo`, `student`.`GPA` AS `GPA`, `student`.`ConvoRegNo` AS `ConvoRegNo`, `convocation`.`Address` AS `Address`, `convocation`.`Age` AS `Age` FROM (`student` join `convocation`) WHERE ((`student`.`RegNo` = `convocation`.`RegNo`) AND (`convocation`.`ConvoRegNo` is not null))  ;
--
-- Database: `e19446lab08`
--
CREATE DATABASE IF NOT EXISTS `e19446lab08` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `e19446lab08`;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Price` int UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`Id`, `Name`, `Price`) VALUES
(1, 'Audi', 52642),
(2, 'Mercedes', 57127),
(3, 'Skoda', 9000),
(4, 'Volvo', 35000),
(5, 'Bentley', 350000),
(6, 'Citroen', 21000),
(8, 'Volkswagen', 21600);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_time` time NOT NULL,
  `c_date` int NOT NULL,
  `c_month` int NOT NULL,
  `c_year` int NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment_like`
--

DROP TABLE IF EXISTS `comment_like`;
CREATE TABLE IF NOT EXISTS `comment_like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `l_time` time NOT NULL,
  `l_date` int NOT NULL,
  `l_month` int NOT NULL,
  `l_year` year NOT NULL,
  `liketype_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `comment_id` (`comment_id`),
  KEY `liketype_id` (`liketype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends_with`
--

DROP TABLE IF EXISTS `friends_with`;
CREATE TABLE IF NOT EXISTS `friends_with` (
  `friend_id` int NOT NULL AUTO_INCREMENT,
  `accepter_id` int NOT NULL,
  `requester_id` int NOT NULL,
  `acc_date` date NOT NULL,
  PRIMARY KEY (`friend_id`),
  UNIQUE KEY `friend_id_2` (`friend_id`),
  UNIQUE KEY `accepter_id` (`accepter_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends_with`
--

INSERT INTO `friends_with` (`friend_id`, `accepter_id`, `requester_id`, `acc_date`) VALUES
(1, 2, 1, '2023-01-01'),
(2, 3, 1, '2023-02-05'),
(3, 4, 2, '2023-03-10'),
(4, 5, 3, '2023-04-15'),
(5, 6, 4, '2023-05-20'),
(6, 7, 5, '2023-06-25'),
(7, 8, 6, '2023-07-30'),
(8, 9, 7, '2023-08-04'),
(9, 10, 8, '2023-09-09'),
(10, 1, 9, '2023-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
CREATE TABLE IF NOT EXISTS `friend_request` (
  `requestee_id` int NOT NULL,
  `requester_id` int NOT NULL,
  `req_time` time NOT NULL,
  `req_date` int NOT NULL,
  `req_month` int NOT NULL,
  `req_year` year NOT NULL,
  `req_status` tinyint(1) NOT NULL,
  KEY `requestee_id` (`requestee_id`),
  KEY `requester_id` (`requester_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_type`
--

DROP TABLE IF EXISTS `like_type`;
CREATE TABLE IF NOT EXISTS `like_type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `type_emoji` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_time` time NOT NULL,
  `p_date` int NOT NULL,
  `p_month` int NOT NULL,
  `p_year` int NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE IF NOT EXISTS `post_like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `l_time` time NOT NULL,
  `l_date` int NOT NULL,
  `l_month` int NOT NULL,
  `l_year` year NOT NULL,
  `liketype_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` tinyint DEFAULT NULL,
  `b_year` year DEFAULT NULL,
  `b_month` int DEFAULT NULL,
  `b_date` int DEFAULT NULL,
  `profile_picture` int DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `bio` text,
  `interest` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `sex`, `b_year`, `b_month`, `b_date`, `profile_picture`, `location`, `affiliation`, `bio`, `interest`) VALUES
(3, 'john_doe', 'password123', 'John', 'Doe', 'john.doe@example.com', 1, 1990, 1, 1, NULL, NULL, NULL, 'I am John Doe.', NULL),
(4, 'jane_smith', 'password456', 'Jane', 'Smith', 'jane.smith@example.com', 0, 1992, 3, 15, NULL, NULL, NULL, 'I am Jane Smith.', NULL),
(5, 'alice', 'password789', 'Alice', 'Johnson', 'alice@example.com', 0, 1995, 6, 12, NULL, NULL, NULL, 'I am Alice Johnson.', NULL),
(6, 'bob', 'password321', 'Bob', 'Smith', 'bob@example.com', 1, 1993, 9, 25, NULL, NULL, NULL, 'I am Bob Smith.', NULL),
(7, 'emma', 'password654', 'Emma', 'Davis', 'emma@example.com', 0, 1998, 2, 7, NULL, NULL, NULL, 'I am Emma Davis.', NULL),
(8, 'michael', 'password987', 'Michael', 'Wilson', 'michael@example.com', 1, 1991, 12, 3, NULL, NULL, NULL, 'I am Michael Wilson.', NULL),
(9, 'sophia', 'password012', 'Sophia', 'Brown', 'sophia@example.com', 0, 1997, 4, 18, NULL, NULL, NULL, 'I am Sophia Brown.', NULL),
(10, 'david', 'password345', 'David', 'Lee', 'david@example.com', 1, 1994, 7, 9, NULL, NULL, NULL, 'I am David Lee.', NULL),
(11, 'olivia', 'password678', 'Olivia', 'Miller', 'olivia@example.com', 0, 1996, 10, 27, NULL, NULL, NULL, 'I am Olivia Miller.', NULL),
(12, 'james', 'password901', 'James', 'Taylor', 'james@example.com', 1, 1992, 8, 14, NULL, NULL, NULL, 'I am James Taylor.', NULL),
(13, 'lily', 'password234', 'Lily', 'Anderson', 'lily@example.com', 0, 1999, 5, 6, NULL, NULL, NULL, 'I am Lily Anderson.', NULL),
(14, 'benjamin', 'password567', 'Benjamin', 'Clark', 'benjamin@example.com', 1, 1990, 11, 22, NULL, NULL, NULL, 'I am Benjamin Clark.', NULL);
--
-- Database: `peralink`
--
CREATE DATABASE IF NOT EXISTS `peralink` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `peralink`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_time` time NOT NULL,
  `c_date` int NOT NULL,
  `c_month` int NOT NULL,
  `c_year` int NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`c_id`, `c_time`, `c_date`, `c_month`, `c_year`, `content`, `user_id`, `post_id`) VALUES
(1, '12:30:00', 1, 1, 2023, 'Nice post!', 2, 1),
(2, '09:30:00', 2, 2, 2023, 'Good morning, Jane!', 1, 1),
(3, '10:00:00', 2, 2, 2023, 'Have a great day!', 3, 1),
(4, '15:00:00', 3, 3, 2023, 'Hello John!', 2, 2),
(5, '16:30:00', 4, 4, 2023, 'Nice post, Alice!', 4, 3),
(6, '11:45:00', 5, 5, 2023, 'Feeling excited too!', 5, 4),
(7, '12:00:00', 5, 5, 2023, 'Same here!', 6, 4),
(8, '17:15:00', 6, 6, 2023, 'Just relaxing...', 3, 5),
(9, '18:00:00', 6, 6, 2023, 'Enjoy your weekend!', 7, 5),
(10, '20:20:00', 7, 7, 2023, 'Looking forward to it!', 8, 6),
(11, '13:10:00', 8, 8, 2023, 'Sounds fun!', 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comment_like`
--

DROP TABLE IF EXISTS `comment_like`;
CREATE TABLE IF NOT EXISTS `comment_like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `l_time` time NOT NULL,
  `l_date` int NOT NULL,
  `l_month` int NOT NULL,
  `l_year` year NOT NULL,
  `liketype_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `comment_id` (`comment_id`),
  KEY `liketype_id` (`liketype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment_like`
--

INSERT INTO `comment_like` (`id`, `l_time`, `l_date`, `l_month`, `l_year`, `liketype_id`, `user_id`, `comment_id`) VALUES
(1, '12:30:00', 1, 1, 2023, 1, 2, 1),
(2, '12:30:00', 1, 1, 2023, 1, 2, 1),
(3, '09:50:00', 2, 2, 2023, 1, 1, 1),
(4, '10:30:00', 2, 2, 2023, 2, 3, 1),
(5, '15:45:00', 3, 3, 2023, 1, 2, 2),
(6, '17:00:00', 4, 4, 2023, 3, 4, 3),
(7, '11:55:00', 5, 5, 2023, 1, 5, 4),
(8, '12:30:00', 5, 5, 2023, 2, 6, 4),
(9, '17:45:00', 6, 6, 2023, 1, 3, 5),
(10, '18:30:00', 6, 6, 2023, 2, 7, 5),
(11, '20:40:00', 7, 7, 2023, 1, 8, 6),
(12, '13:30:00', 8, 8, 2023, 2, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `friends_with`
--

DROP TABLE IF EXISTS `friends_with`;
CREATE TABLE IF NOT EXISTS `friends_with` (
  `friend_id` int NOT NULL AUTO_INCREMENT,
  `accepter_id` int NOT NULL,
  `requester_id` int NOT NULL,
  `acc_date` date NOT NULL,
  PRIMARY KEY (`accepter_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friends_with`
--

INSERT INTO `friends_with` (`friend_id`, `accepter_id`, `requester_id`, `acc_date`) VALUES
(1, 3, 1, '2023-02-05'),
(2, 4, 2, '2023-03-10'),
(3, 5, 3, '2023-04-15'),
(4, 6, 4, '2023-05-20'),
(5, 7, 5, '2023-06-25'),
(6, 8, 6, '2023-07-30'),
(7, 9, 7, '2023-08-04'),
(8, 10, 8, '2023-09-09'),
(9, 1, 9, '2023-10-14'),
(10, 2, 10, '2023-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
CREATE TABLE IF NOT EXISTS `friend_request` (
  `requestee_id` int NOT NULL,
  `requester_id` int NOT NULL,
  `req_time` time NOT NULL,
  `req_date` int NOT NULL,
  `req_month` int NOT NULL,
  `req_year` year NOT NULL,
  `req_status` varchar(25) NOT NULL,
  KEY `requestee_id` (`requestee_id`),
  KEY `requester_id` (`requester_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`requestee_id`, `requester_id`, `req_time`, `req_date`, `req_month`, `req_year`, `req_status`) VALUES
(1, 2, '10:15:00', 2023, 6, 2023, 'pending'),
(3, 1, '14:30:00', 2023, 5, 2023, 'accepted'),
(4, 1, '09:45:00', 2023, 6, 2023, 'pending'),
(2, 3, '16:20:00', 2023, 5, 2023, 'rejected'),
(5, 2, '11:55:00', 2023, 5, 2023, 'accepted'),
(3, 4, '13:10:00', 2023, 6, 2023, 'rejected'),
(2, 4, '17:30:00', 2023, 6, 2023, 'pending'),
(5, 1, '10:00:00', 2023, 5, 2023, 'accepted'),
(4, 5, '15:45:00', 2023, 5, 2023, 'rejected'),
(1, 3, '12:05:00', 2023, 6, 2023, 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `like_type`
--

DROP TABLE IF EXISTS `like_type`;
CREATE TABLE IF NOT EXISTS `like_type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `type_emoji` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `like_type`
--

INSERT INTO `like_type` (`type_id`, `type_name`, `type_emoji`) VALUES
(1, 'Like', '👍'),
(2, 'Love', '❤️'),
(3, 'Haha', '😄'),
(4, 'Wow', '😲'),
(5, 'Sad', '😢'),
(6, 'Angry', '😡');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_time` time NOT NULL,
  `p_date` int NOT NULL,
  `p_month` int NOT NULL,
  `p_year` int NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `p_time`, `p_date`, `p_month`, `p_year`, `content`, `user_id`) VALUES
(1, '12:00:00', 1, 1, 2023, 'Hello world!', 1),
(2, '09:00:00', 2, 2, 2023, 'Good morning!', 2),
(3, '14:30:00', 3, 3, 2023, 'Hello everyone!', 1),
(4, '18:45:00', 4, 4, 2023, 'I had a great day!', 3),
(5, '20:15:00', 5, 5, 2023, 'Feeling excited!', 4),
(6, '11:20:00', 6, 6, 2023, 'Just chilling...', 2),
(7, '16:10:00', 7, 7, 2023, 'Enjoying the weekend!', 1),
(8, '19:30:00', 8, 8, 2023, 'Having fun with friends!', 5),
(9, '21:45:00', 9, 9, 2023, 'Looking forward to the future!', 6),
(10, '10:05:00', 10, 10, 2023, 'New beginnings!', 7),
(11, '15:50:00', 11, 11, 2023, 'Feeling blessed!', 8);

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE IF NOT EXISTS `post_like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `l_time` time NOT NULL,
  `l_date` int NOT NULL,
  `l_month` int NOT NULL,
  `l_year` year NOT NULL,
  `liketype_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`id`, `l_time`, `l_date`, `l_month`, `l_year`, `liketype_id`, `user_id`, `post_id`) VALUES
(1, '12:30:00', 1, 1, 2023, 1, 2, 1),
(2, '12:30:00', 1, 1, 2023, 1, 2, 1),
(3, '09:40:00', 2, 2, 2023, 1, 1, 1),
(4, '10:15:00', 2, 2, 2023, 2, 3, 1),
(5, '15:30:00', 3, 3, 2023, 1, 2, 2),
(6, '16:45:00', 4, 4, 2023, 3, 4, 3),
(7, '11:50:00', 5, 5, 2023, 1, 5, 4),
(8, '12:15:00', 5, 5, 2023, 2, 6, 4),
(9, '17:30:00', 6, 6, 2023, 1, 3, 5),
(10, '18:20:00', 6, 6, 2023, 2, 7, 5),
(11, '20:30:00', 7, 7, 2023, 1, 8, 6),
(12, '13:20:00', 8, 8, 2023, 2, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` tinyint NOT NULL,
  `b_year` year NOT NULL,
  `b_month` int NOT NULL,
  `b_date` int NOT NULL,
  `profile_picture` int DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `bio` text NOT NULL,
  `interest` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `sex`, `b_year`, `b_month`, `b_date`, `profile_picture`, `location`, `affiliation`, `bio`, `interest`) VALUES
(1, 'john_doe', 'password123', 'John', 'Doe', 'john.doe@example.com', 1, 1990, 1, 1, NULL, NULL, NULL, 'I am John Doe.', NULL),
(2, 'jane_smith', 'password456', 'Jane', 'Smith', 'jane.smith@example.com', 0, 1992, 3, 15, NULL, NULL, NULL, 'I am Jane Smith.', NULL),
(3, 'alice', 'password789', 'Alice', 'Johnson', 'alice@example.com', 0, 1995, 6, 12, NULL, NULL, NULL, 'I am Alice Johnson.', NULL),
(4, 'bob', 'password321', 'Bob', 'Smith', 'bob@example.com', 1, 1993, 9, 25, NULL, NULL, NULL, 'I am Bob Smith.', NULL),
(5, 'emma', 'password654', 'Emma', 'Davis', 'emma@example.com', 0, 1998, 2, 7, NULL, NULL, NULL, 'I am Emma Davis.', NULL),
(6, 'michael', 'password987', 'Michael', 'Wilson', 'michael@example.com', 1, 1991, 12, 3, NULL, NULL, NULL, 'I am Michael Wilson.', NULL),
(7, 'sophia', 'password012', 'Sophia', 'Brown', 'sophia@example.com', 0, 1997, 4, 18, NULL, NULL, NULL, 'I am Sophia Brown.', NULL),
(8, 'david', 'password345', 'David', 'Lee', 'david@example.com', 1, 1994, 7, 9, NULL, NULL, NULL, 'I am David Lee.', NULL),
(9, 'olivia', 'password678', 'Olivia', 'Miller', 'olivia@example.com', 0, 1996, 10, 27, NULL, NULL, NULL, 'I am Olivia Miller.', NULL),
(10, 'james', 'password901', 'James', 'Taylor', 'james@example.com', 1, 1992, 8, 14, NULL, NULL, NULL, 'I am James Taylor.', NULL),
(11, 'lily', 'password234', 'Lily', 'Anderson', 'lily@example.com', 0, 1999, 5, 6, NULL, NULL, NULL, 'I am Lily Anderson.', NULL),
(12, 'benjamin', 'password567', 'Benjamin', 'Clark', 'benjamin@example.com', 1, 1990, 11, 22, NULL, NULL, NULL, 'I am Benjamin Clark.', NULL),
(13, 'k', '$2b$10$MqLUeNyVLTa9/CylZl9J9ulrjGgixdZDVe6O4QKqqg2UwOF20AuqG', '', '', 'k', 0, 0000, 0, 0, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE IF NOT EXISTS `user_interests` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest` varchar(100) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`user_id`, `interest`) VALUES
(1, 'Music'),
(1, 'Sports'),
(1, 'Reading'),
(2, 'Travel'),
(2, 'Photography'),
(3, 'Cooking'),
(4, 'Technology'),
(5, 'Art'),
(6, 'Dancing'),
(7, 'Fitness'),
(8, 'Gaming'),
(9, 'Movies'),
(10, 'Fashion'),
(11, 'Writing'),
(12, 'Hiking');
--
-- Database: `springbootdemo`
--
CREATE DATABASE IF NOT EXISTS `springbootdemo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `springbootdemo`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password`) VALUES
(1, 'test@test.com', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_seq`
--

DROP TABLE IF EXISTS `user_seq`;
CREATE TABLE IF NOT EXISTS `user_seq` (
  `next_val` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_seq`
--

INSERT INTO `user_seq` (`next_val`) VALUES
(51);
--
-- Database: `testing`
--
CREATE DATABASE IF NOT EXISTS `testing` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `testing`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
