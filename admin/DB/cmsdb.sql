-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 21, 2023 at 12:11 PM
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
  PRIMARY KEY (`slot_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 13 DEFAULT CHARSET = latin1;

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
    `oneday`
  )
VALUES
  (
    1,
    'Lab1',
    'CourseA',
    '09:00:00',
    '11:00:00',
    0,
    NULL
  ),
  (
    2,
    'Lab1',
    'CourseB',
    '13:00:00',
    '15:00:00',
    2,
    NULL
  ),
  (
    3,
    'Lab2',
    'CourseC',
    '10:30:00',
    '12:30:00',
    1,
    NULL
  ),
  (
    4,
    'Lab2',
    'CourseD',
    '14:00:00',
    '16:00:00',
    3,
    NULL
  ),
  (
    5,
    'CCNA',
    'CCNA101',
    '08:00:00',
    '12:00:00',
    4,
    '2023-09-22'
  ),
  (
    6,
    'SR',
    'SR202',
    '15:00:00',
    '17:00:00',
    5,
    '2023-09-23'
  );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;