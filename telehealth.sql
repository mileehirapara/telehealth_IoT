-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2017 at 03:16 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor_reg`
--

CREATE TABLE IF NOT EXISTS `doctor_reg` (
  `aadhar_id` varchar(16) NOT NULL COMMENT 'Store Aadhar number of Doctor (username)',
  `first_name` varchar(20) NOT NULL COMMENT 'Store First name of Doctor',
  `last_name` varchar(20) NOT NULL COMMENT 'Store last name of Doctor',
  `password` varchar(32) NOT NULL COMMENT 'Store password (in md5 encrypted form)',
  `email_id` varchar(30) NOT NULL COMMENT 'Store Email address of doctor',
  `mobile_no` text NOT NULL COMMENT 'Store Mobile number of doctor',
  `dob` date NOT NULL COMMENT 'Store date of birth of doctor (yyyy-mm-dd)',
  `age` int(5) NOT NULL COMMENT 'Store age of doctor',
  `gender` varchar(1) NOT NULL COMMENT 'Store of gender doctor',
  `blood_group` varchar(3) NOT NULL COMMENT 'Store blood group of doctor',
  `hospital` varchar(100) NOT NULL COMMENT 'Store hospital or clinic related information ',
  `telephone` text NOT NULL COMMENT 'Store contact  number of doctor at hospital or clinic',
  `pincode` int(6) NOT NULL COMMENT 'Store pincode of doctor''s hospital or clinic area',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT 'Store status of doctor ( 0: OFFLINE, 1: ONLINE )',
  PRIMARY KEY (`aadhar_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_data`
--

CREATE TABLE IF NOT EXISTS `patient_data` (
  `aadhar_id` varchar(16) NOT NULL COMMENT 'Store Aadhar number of patient',
  `email_id` varchar(30) NOT NULL COMMENT 'Store email address of patient',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Store date and time when record is inserted',
  `temp` float NOT NULL COMMENT 'Store value of temperature sensor',
  `pulse` float NOT NULL COMMENT 'Store value of pulse sensor',
  `blood_oxy` float NOT NULL COMMENT 'Store value of Blood Oxygen',
  `ecg` text NOT NULL COMMENT 'Store value of Electrocardiogram sensor',
  `blood_pressure` float NOT NULL COMMENT 'Store value of Blood Pressure',
  `symptoms` varchar(300) NOT NULL COMMENT 'Store symptoms values of patient',
  `doctor` varchar(16) NOT NULL COMMENT 'Store aadhar number of consultant doctor ( in case any sensor value crosses threshold)',
  KEY `aadhar_id` (`aadhar_id`),
  KEY `doctor` (`doctor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE IF NOT EXISTS `patient_history` (
  `p_aadhar_id` varchar(16) NOT NULL COMMENT 'Store Aadhar number of patient ',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Store date and time when record is inserted',
  `temp` float NOT NULL COMMENT 'Store value of temperature sensor',
  `pulse` float NOT NULL COMMENT 'Store value of pulse sensor',
  `blood_oxy` float NOT NULL COMMENT 'Store value of Blood Oxygen',
  `ecg` text NOT NULL COMMENT 'Store value of Electrocardiogram sensor',
  `blood_pressure` float NOT NULL COMMENT 'Store value of Blood Pressure',
  `symptoms` varchar(300) NOT NULL COMMENT 'Store symptoms values of patient',
  `prescription` varchar(300) NOT NULL COMMENT 'Store prescription sent by doctor',
  `d_aadhar_id` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor who have given prescription',
  KEY `p_aadhar_id` (`p_aadhar_id`),
  KEY `d_aadhar_id` (`d_aadhar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_reg`
--

CREATE TABLE IF NOT EXISTS `patient_reg` (
  `aadhar_id` varchar(16) NOT NULL COMMENT 'Store Aadhar number of patient (username)',
  `password` varchar(32) NOT NULL COMMENT 'Store password (in md5 encryption form)',
  `first_name` varchar(20) NOT NULL COMMENT 'Store first name of patient',
  `last_name` varchar(20) NOT NULL COMMENT 'Store last name of patient',
  `email_id` varchar(30) NOT NULL COMMENT 'Store Email address of patient',
  `mobile_no` text NOT NULL COMMENT 'Store Mobile number of patient',
  `emergency_ph_no` text NOT NULL COMMENT 'Store contact number which can be used in emergency',
  `address` varchar(100) NOT NULL COMMENT 'Store address of patient',
  `pincode` int(6) NOT NULL COMMENT 'Store pincode of patient',
  `dob` date NOT NULL COMMENT 'Store date of birth of patient (yyyy-mm-dd)',
  `age` int(5) NOT NULL COMMENT 'Store age of patient',
  `gender` varchar(1) NOT NULL COMMENT 'Store gender of patient',
  `blood_group` varchar(3) NOT NULL COMMENT 'Store blood group of patient',
  `doc1` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor (contact priority 1)',
  `doc2` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor (contact priority 2)',
  `doc3` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor (contact priority 3)',
  `doc4` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor (contact priority 4)',
  `doc5` varchar(16) NOT NULL COMMENT 'Store aadhar number of doctor (contact priority 5)',
  PRIMARY KEY (`aadhar_id`),
  UNIQUE KEY `email_id` (`email_id`),
  KEY `email_id_2` (`email_id`),
  KEY `doc5` (`doc5`),
  KEY `doc1` (`doc1`),
  KEY `doc2` (`doc2`),
  KEY `doc3` (`doc3`),
  KEY `doc4` (`doc4`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `threshold`
--

CREATE TABLE IF NOT EXISTS `threshold` (
  `sensor` varchar(15) NOT NULL COMMENT 'Store name of the sensor',
  `low_val` float NOT NULL COMMENT 'Store lower threshold value of specific sensor',
  `high_val` float NOT NULL COMMENT 'Store upper threshold valueof specific sensor',
  UNIQUE KEY `sensor` (`sensor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_data`
--
ALTER TABLE `patient_data`
  ADD CONSTRAINT `patient_data_ibfk_1` FOREIGN KEY (`aadhar_id`) REFERENCES `patient_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_data_ibfk_2` FOREIGN KEY (`doctor`) REFERENCES `doctor_reg` (`aadhar_id`);

--
-- Constraints for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD CONSTRAINT `patient_history_ibfk_1` FOREIGN KEY (`p_aadhar_id`) REFERENCES `patient_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_history_ibfk_2` FOREIGN KEY (`d_aadhar_id`) REFERENCES `doctor_reg` (`aadhar_id`);

--
-- Constraints for table `patient_reg`
--
ALTER TABLE `patient_reg`
  ADD CONSTRAINT `patient_reg_ibfk_5` FOREIGN KEY (`doc5`) REFERENCES `doctor_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_reg_ibfk_1` FOREIGN KEY (`doc1`) REFERENCES `doctor_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_reg_ibfk_2` FOREIGN KEY (`doc2`) REFERENCES `doctor_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_reg_ibfk_3` FOREIGN KEY (`doc3`) REFERENCES `doctor_reg` (`aadhar_id`),
  ADD CONSTRAINT `patient_reg_ibfk_4` FOREIGN KEY (`doc4`) REFERENCES `doctor_reg` (`aadhar_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
