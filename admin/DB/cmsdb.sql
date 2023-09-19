


--
-- Database: `cmsdb`
--
CREATE DATABASE IF NOT EXISTS cmsdb;

USE cmsdb;

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
);
-- ----------------------------------------------------------
--
-- Table structure for table `facility`
--
DROP TABLE IF EXISTS `facility`;
CREATE TABLE IF NOT EXISTS `facility` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  PRIMARY KEY (`f_id`)
); 

-- ----------------------------------------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `details` text,
  PRIMARY KEY (`c_id`)
);

-- ----------------------------------------------------------
DROP TABLE IF EXISTS `course_offering`;
CREATE TABLE IF NOT EXISTS `course_offering` (
  `c_code` varchar(20) NOT NULL,
  `c_id` int NOT NULL,
  `coordinator_id` int NOT NULL,
  `starting date` date NOT NULL,
  `display_info` text,
  PRIMARY KEY (`c_code`)
);
ALTER TABLE `course_offering`
ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`);
ALTER TABLE `course_offering`
ADD CONSTRAINT `fk_coord_id` FOREIGN KEY (`coordinator_id`) REFERENCES `user` (`u_id`);

-- ----------------------------------------------------------
DROP TABLE IF EXISTS `timetable`;
CREATE TABLE IF NOT EXISTS `timetable` (
  `c_code` varchar(20) NOT NULL,
  `f_id` int NOT NULL,
  `lec_day` tinytext NOT NULL COMMENT 'Monday - Friday',
  `lec_time` time NOT NULL,
  PRIMARY KEY (`c_code`,`f_id`)
);
ALTER TABLE `timetable`
ADD CONSTRAINT `fk_c_code` FOREIGN KEY (`c_code`) REFERENCES `course_offering` (`c_code`);
ALTER TABLE `timetable`
ADD CONSTRAINT `fk_f_id` FOREIGN KEY (`f_id`) REFERENCES `facility` (`f_id`);

-- --------------------------------------------------------
--
-- Table structure for table `upcoming_event`
--

DROP TABLE IF EXISTS `upcoming_event`;
CREATE TABLE IF NOT EXISTS `upcoming_event` (
  `e_id` int NOT NULL AUTO_INCREMENT,
  `e_name` int DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `e_venue` varchar(100) DEFAULT NULL,
  `e_img` varchar(100) NOT NULL,
  `display_from` date NOT NULL,
  `display_to` date NOT NULL,
  `added_by` int NOT NULL COMMENT 'f_key -userId',
  PRIMARY KEY (`e_id`)
);
ALTER TABLE `upcoming_event`
ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`added_by`) REFERENCES `user`(`u_id`); 

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
  PRIMARY KEY (`a_id`)
); 
ALTER TABLE `achievement`
ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`added_by`) REFERENCES `user`(`u_id`); 
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
  PRIMARY KEY (`p_id`)
);
ALTER TABLE `previous_event`
ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`added_by`) REFERENCES `user`(`u_id`); 
-- --------------------------------------------------------
