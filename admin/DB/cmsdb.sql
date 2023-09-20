


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


INSERT INTO `user` (`user_name`, `email`, `password`, `contact`, `clearense`) VALUES
    ('John Doe', 'john@example.com', 'hashed_password_1', '1234567890', 'Clearance1'),
    ('Jane Smith', 'jane@example.com', 'hashed_password_2', '9876543210', 'Clearance2'),
    ('Alice Johnson', 'alice@example.com', 'hashed_password_3', '5555555555', 'Clearance3'),
    ('Bob Williams', 'bob@example.com', 'hashed_password_4', '9999999999', 'Clearance4');


INSERT INTO `facility` (`f_name`) VALUES
    ('Seminar Room'),
    ('Classroom A'),
    ('Classroom B'),
    ('Auditorium');


INSERT INTO `course` (`c_name`, `details`) VALUES
    ('Introduction to Programming', 'Basic programming concepts and techniques.'),
    ('Web Development', 'Building web applications using HTML, CSS, and JavaScript.'),
    ('Database Management', 'Database design and SQL.'),
    ('Networking Fundamentals', 'Basics of computer networking.');


INSERT INTO `course_offering` (`c_code`, `c_id`, `coordinator_id`, `starting date`, `display_info`) VALUES
    ('COURSE01', 1, 1, '2023-08-15', 'Course details for August 2023'),
    ('COURSE02', 2, 2, '2022-12-10', 'Course details for December 2022'),
    ('COURSE03', 3, 3, '2023-09-05', 'Course details for September 2023'),
    ('COURSE04', 4, 4, '2023-10-01', 'Course details for October 2023');


INSERT INTO `timetable` (`c_code`, `f_id`, `lec_day`, `lec_time`) VALUES
    ('COURSE01', 1, 'Monday', '09:00:00'),
    ('COURSE01', 2, 'Wednesday', '11:00:00'),
    ('COURSE02', 3, 'Tuesday', '14:00:00'),
    ('COURSE03', 4, 'Thursday', '10:00:00');

INSERT INTO `upcoming_event` (`e_name`, `e_date`, `e_time`, `e_venue`, `e_img`, `display_from`, `display_to`, `added_by`) VALUES
    ('Event 1', '2023-09-20', '09:00:00', 'Seminar Room', 'event1.jpg', '2023-09-10', '2023-09-22', 1),
    ('Event 2', '2023-09-21', '11:00:00', 'Auditorium', 'event2.jpg', '2023-09-12', '2023-09-24', 2),
    ('Event 3', '2023-09-22', '09:00:00', 'Classroom A', 'event3.jpg', '2023-09-14', '2023-09-26', 3),
    ('Event 4', '2023-09-23', '15:00:00', 'Seminar Room', 'event4.jpg', '2023-09-16', '2023-09-28', 4);


INSERT INTO `achievement` (`a_name`, `a_img`, `display_from`, `display_to`, `added_by`) VALUES
    ('Achievement 1', 'achievement1.jpg', '2023-07-01', '2023-07-15', 1),
    ('Achievement 2', 'achievement2.jpg', '2023-08-01',x '2023-08-15', 2),
    ('Achievement 3', 'achievement3.jpg', '2023-09-01', '2023-09-15', 3),
    ('Achievement 4', 'achievement4.jpg', '2023-10-01', '2023-10-15', 4);


INSERT INTO `previous_event` (`p_name`, `p_img`, `display_from`, `display_to`, `added_by`) VALUES
    ('Previous Event 1', 'prev_event1.jpg', '2022-12-01', '2022-12-15', 1),
    ('Previous Event 2', 'prev_event2.jpg', '2022-11-01', '2022-11-15', 2),
    ('Previous Event 3', 'prev_event3.jpg', '2022-10-01', '2022-10-15', 3),
    ('Previous Event 4', 'prev_event4.jpg', '2022-09-01', '2022-09-15', 4);
