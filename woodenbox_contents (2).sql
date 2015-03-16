-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2015 at 03:46 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `woodenbox_contents`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_balance`
--

CREATE TABLE IF NOT EXISTS `fee_balance` (
`id` int(30) NOT NULL,
  `student_id` int(10) NOT NULL,
  `item` varchar(30) NOT NULL,
  `balance` decimal(18,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `penalty_count` int(10) NOT NULL,
  `penalty_balance` decimal(18,2) NOT NULL,
  `waive` int(1) NOT NULL,
  `original_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `fee_balance`
--

INSERT INTO `fee_balance` (`id`, `student_id`, `item`, `balance`, `due_date`, `penalty_count`, `penalty_balance`, `waive`, `original_price`) VALUES
(142, 53, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '19000.00'),
(143, 54, 'Downpayment', '11000.00', NULL, 0, '0.00', 0, '11000.00'),
(144, 54, 'Miscellaneous', '3000.00', '2015-08-30', 1, '150.00', 0, '3000.00'),
(145, 54, 'September Fee', '6000.00', '2015-09-30', 0, '0.00', 0, '6000.00'),
(146, 55, 'Downpayment', '9000.00', NULL, 0, '0.00', 0, '9000.00'),
(147, 55, 'Miscellaneous', '4000.00', '2015-07-30', 0, '0.00', 0, '4000.00'),
(148, 55, 'October Fee', '4000.00', '2015-10-01', 0, '0.00', 0, '4000.00'),
(149, 55, 'January Fee', '4000.00', '2016-01-01', 0, '0.00', 0, '4000.00'),
(150, 56, 'Downpayment', '6000.00', NULL, 0, '0.00', 0, '6000.00'),
(151, 56, 'Miscellaneous', '6000.00', '2015-07-30', 0, '0.00', 0, '6000.00'),
(152, 56, 'June fee', '1050.00', '2015-06-30', 0, '0.00', 0, '1050.00'),
(153, 56, 'July fee', '1050.00', '2015-07-30', 0, '0.00', 0, '1050.00'),
(154, 56, 'August fee', '1050.00', '2015-08-30', 0, '0.00', 0, '1050.00'),
(155, 56, 'September fee', '1050.00', '2015-09-30', 0, '0.00', 0, '1050.00'),
(156, 56, 'October fee', '1050.00', '2015-10-30', 0, '0.00', 0, '1050.00'),
(157, 56, 'November fee', '1050.00', '2015-11-30', 0, '0.00', 0, '1050.00'),
(158, 56, 'December fee', '1050.00', '2015-12-30', 0, '0.00', 0, '1050.00'),
(159, 56, 'January fee', '1050.00', '2016-01-30', 0, '0.00', 0, '1050.00'),
(160, 56, 'February fee', '1050.00', '2016-02-29', 0, '0.00', 0, '1050.00'),
(161, 56, 'March fee', '1050.00', '2016-03-30', 0, '0.00', 0, '1050.00'),
(162, 57, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00'),
(163, 58, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00'),
(164, 59, 'Downpayment', '11000.00', NULL, 0, '0.00', 0, '11000.00'),
(165, 59, 'Miscellaneous', '3000.00', '2015-08-30', 1, '150.00', 0, '3000.00'),
(166, 59, 'September Fee', '6000.00', '2015-09-30', 0, '0.00', 0, '6000.00'),
(167, 60, 'Downpayment', '8000.00', NULL, 0, '0.00', 0, '8000.00'),
(168, 60, 'Miscellaneous', '7000.00', '2015-08-30', 1, '350.00', 0, '7000.00'),
(169, 60, 'June fee', '1300.00', '2015-08-30', 2, '130.00', 0, '1300.00'),
(170, 60, 'July fee', '1300.00', '2015-08-30', 1, '65.00', 0, '1300.00'),
(171, 60, 'August fee', '1300.00', '2015-08-30', 0, '0.00', 0, '1300.00'),
(172, 60, 'September fee', '1300.00', '2015-09-30', 0, '0.00', 0, '1300.00'),
(173, 60, 'October fee', '1300.00', '2015-10-30', 0, '0.00', 0, '1300.00'),
(174, 60, 'November fee', '1300.00', '2015-11-30', 0, '0.00', 0, '1300.00'),
(175, 60, 'December fee', '1300.00', '2015-12-30', 0, '0.00', 0, '1300.00'),
(176, 60, 'January fee', '1300.00', '2016-01-30', 0, '0.00', 0, '1300.00'),
(177, 60, 'February fee', '1300.00', '2016-02-29', 0, '0.00', 0, '1300.00'),
(178, 60, 'March fee', '1300.00', '2016-03-30', 0, '0.00', 0, '1300.00'),
(179, 61, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '11000.00'),
(180, 61, 'Miscellaneous', '2000.00', '2015-08-30', 1, '150.00', 0, '3000.00'),
(181, 61, 'September Fee', '0.00', '2015-09-30', 0, '0.00', 0, '6000.00'),
(182, 62, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '9000.00'),
(183, 62, 'Miscellaneous', '0.00', '2015-08-30', 1, '200.00', 0, '4000.00'),
(184, 62, 'October Fee', '4000.00', '2015-10-01', 0, '0.00', 0, '4000.00'),
(185, 62, 'January Fee', '4000.00', '2016-01-01', 0, '0.00', 0, '4000.00'),
(186, 54, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00');

-- --------------------------------------------------------

--
-- Table structure for table `fee_payment`
--

CREATE TABLE IF NOT EXISTS `fee_payment` (
`id` int(50) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `payment_date` date NOT NULL,
  `cash` decimal(18,2) DEFAULT NULL,
  `dr` varchar(30) NOT NULL,
  `cr` varchar(30) NOT NULL,
  `tuition` decimal(18,2) DEFAULT NULL,
  `remark` varchar(30) NOT NULL,
  `student_id` int(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` varchar(10) NOT NULL,
  `ar` int(11) NOT NULL,
  `state` int(1) NOT NULL,
  `grade` varchar(11) NOT NULL,
  `sy` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `fee_payment`
--

INSERT INTO `fee_payment` (`id`, `last_name`, `first_name`, `payment_date`, `cash`, `dr`, `cr`, `tuition`, `remark`, `student_id`, `year`, `month`, `ar`, `state`, `grade`, `sy`) VALUES
(30, 'Neria', 'Carlo', '2015-05-12', '5000.00', '', '', '5000.00', 'Tuition Fee', 1, 2015, 'May', 265, 0, '', ''),
(32, 'Basco', 'Kevin', '2015-05-02', '3200.00', '', '', '3200.00', 'June Fee', 1, 2015, 'May', 264, 0, '', ''),
(33, 'Grajera', 'Aaron', '2015-05-12', '8000.00', '', '', '8000.00', 'June Fee', 1, 2015, 'May', 266, 0, '', ''),
(34, 'Rios', 'Gabriel', '2015-05-12', '5200.00', '', '', '5200.00', 'June Fee', 1, 2015, 'May', 267, 0, '', ''),
(35, 'Walid', 'Mohd', '2015-05-13', '4100.00', '', '', '4100.00', 'June Fee', 1, 2015, 'May', 268, 0, '', ''),
(36, 'Bugnot', 'Mark', '2015-05-13', '2300.00', '', '', '2300.00', 'Downpayment', 1, 2015, 'May', 269, 0, '', ''),
(37, 'Aguirre', 'Nehemiah', '2015-05-14', '6500.00', '', '', '6500.00', 'June Fee', 1, 2015, 'May', 270, 0, '', ''),
(38, 'Tonga', 'Patrick', '2015-05-14', '7400.00', '', '', '7400.00', 'June Fee', 1, 2015, 'May', 271, 0, '', ''),
(39, 'Mabini', 'Frits', '2015-05-14', '5200.00', '', '', '5200.00', 'Downpayment', 1, 2015, 'May', 272, 0, '', ''),
(40, 'Corpuz', 'Patric', '2015-05-14', '2300.00', '', '', '2300.00', 'Downpayment', 1, 2015, 'May', 273, 0, '', ''),
(41, 'Constantino', 'Carl', '2015-05-14', '6300.00', '', '', '6300.00', 'Downpayment', 1, 2015, 'May', 274, 0, '', ''),
(42, 'Rasalan', 'Joseph', '2015-05-16', '2500.00', '', '', '2500.00', 'June Fee', 1, 2015, 'May', 275, 0, '', ''),
(43, 'Santiago', 'KC', '2015-05-16', '7700.00', '', '', '7700.00', 'June Fee', 1, 2015, 'May', 276, 0, '', ''),
(44, 'Felix', 'Nap', '2015-05-17', '8000.00', '', '', '8000.00', 'June Fee', 1, 2015, 'May', 278, 0, '', ''),
(45, 'Mendoza', 'Kurt', '2015-05-18', '10000.00', '', '', '10000.00', 'June Fee', 1, 2015, 'May', 279, 0, '', ''),
(46, 'Dizor', 'Marvin', '2015-05-19', '1500.00', '', '', '1500.00', 'June Fee', 1, 2015, 'May', 280, 0, '', ''),
(47, 'Onate', 'Sophia', '2015-05-22', '1050.00', '', '', '1050.00', 'June Fee', 1, 2015, 'May', 281, 0, '', ''),
(50, 'Guzon', 'Justin', '2015-05-23', '3150.00', '', '', '3150.00', 'June Fee', 1, 2015, 'May', 282, 0, '', ''),
(51, 'Balmes', 'Kenneth', '2015-05-24', '2100.00', '', '', '2100.00', 'February Fee', 1, 2015, 'May', 283, 0, '', ''),
(52, 'Jovi', 'Bon', '2015-06-02', '9000.00', '', '', '9000.00', 'Downpayment', 62, 2015, 'June', 284, 0, '', ''),
(53, 'Gomez', 'Richard', '2015-08-02', '500.00', '', '', '500.00', 'Downpayment', 53, 2015, 'August', 285, 0, '', ''),
(54, 'Gomez', 'Richard', '2015-08-02', '18500.00', '', '', '18500.00', 'Downpayment', 53, 2015, 'August', 286, 0, '', ''),
(55, 'Tyson', 'Mike', '2015-08-02', '5000.00', '', '', '5000.00', 'Downpayment', 61, 2015, 'August', 287, 0, '', ''),
(56, 'Tyson', 'Mike', '2015-08-02', '6000.00', '', '', '6000.00', 'September Fee', 61, 2015, 'August', 288, 0, '', ''),
(57, 'Tyson', 'Mike', '2015-08-02', '7000.00', '', '', '7000.00', 'Downpayment & Misc', 61, 2015, 'August', 289, 0, '', ''),
(58, 'Jovi', 'Bon', '2015-03-16', '4000.00', '', '', '4000.00', 'misc', 62, 2015, 'March', 290, 0, 'Kindergarte', '2015 - 2016');

-- --------------------------------------------------------

--
-- Table structure for table `fee_schedule`
--

CREATE TABLE IF NOT EXISTS `fee_schedule` (
`fee_id` int(5) unsigned zerofill NOT NULL,
  `grade` varchar(20) NOT NULL,
  `fee_type` varchar(20) NOT NULL,
  `item` varchar(30) NOT NULL,
  `fee` decimal(18,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `fee_schedule`
--

INSERT INTO `fee_schedule` (`fee_id`, `grade`, `fee_type`, `item`, `fee`, `due_date`) VALUES
(00001, 'Nursery', 'Cash', 'Downpayment', '19000.00', NULL),
(00002, 'Nursery', 'Semi-Annual', 'Downpayment', '11000.00', NULL),
(00003, 'Nursery', 'Semi-Annual', 'Miscellaneous', '3000.00', '2015-07-30'),
(00004, 'Nursery', 'Semi-Annual', 'September Fee', '6000.00', '2015-09-30'),
(00005, 'Nursery', 'Tri-Term', 'Downpayment', '9000.00', NULL),
(00006, 'Nursery', 'Tri-Term', 'Miscellaneous', '4000.00', '2015-07-30'),
(00007, 'Nursery', 'Tri-Term', 'October Fee', '4000.00', '2015-10-01'),
(00008, 'Nursery', 'Tri-Term', 'January Fee', '4000.00', '2016-01-01'),
(00009, 'Nursery', 'Monthly', 'Downpayment', '6000.00', NULL),
(00010, 'Nursery', 'Monthly', 'Miscellaneous', '6000.00', '2015-07-30'),
(00011, 'Nursery', 'Monthly', 'Monthly Fee', '1050.00', NULL),
(00012, 'Kindergarten 1 ', 'Cash', 'Downpayment', '19000.00', NULL),
(00013, 'Kindergarten 1 ', 'Semi-Annual', 'Downpayment', '11000.00', NULL),
(00014, 'Kindergarten 1 ', 'Semi-Annual', 'Miscellaneous', '3000.00', '2015-07-30'),
(00015, 'Kindergarten 1 ', 'Semi-Annual', 'September Fee', '6000.00', '2015-09-30'),
(00016, 'Kindergarten 1 ', 'Tri-Term', 'Downpayment', '9000.00', NULL),
(00017, 'Kindergarten 1 ', 'Tri-Term', 'Miscellaneous', '4000.00', '2015-07-30'),
(00018, 'Kindergarten 1 ', 'Tri-Term', 'October Fee', '4000.00', '2015-10-01'),
(00019, 'Kindergarten 1 ', 'Tri-Term', 'January Fee', '4000.00', '2016-01-01'),
(00020, 'Kindergarten 1 ', 'Monthly', 'Downpayment', '6000.00', NULL),
(00021, 'Kindergarten 1 ', 'Monthly', 'Miscellaneous', '6000.00', '2015-07-30'),
(00022, 'Kindergarten 1 ', 'Monthly', 'Monthly Fee', '1050.00', NULL),
(00023, 'Kindergarten 2', 'Cash', 'Downpayment', '19000.00', NULL),
(00024, 'Kindergarten 2', 'Semi-Annual', 'Downpayment', '11000.00', NULL),
(00025, 'Kindergarten 2', 'Semi-Annual', 'Miscellaneous', '3000.00', '2015-07-30'),
(00026, 'Kindergarten 2', 'Semi-Annual', 'September Fee', '6000.00', '2015-09-30'),
(00027, 'Kindergarten 2', 'Tri-Term', 'Downpayment', '9000.00', NULL),
(00028, 'Kindergarten 2', 'Tri-Term', 'Miscellaneous', '4000.00', '2015-07-30'),
(00029, 'Kindergarten 2', 'Tri-Term', 'October Fee', '4000.00', '2015-10-01'),
(00030, 'Kindergarten 2', 'Tri-Term', 'January Fee', '4000.00', '2016-01-01'),
(00031, 'Kindergarten 2', 'Monthly', 'Downpayment', '6000.00', NULL),
(00032, 'Kindergarten 2', 'Monthly', 'Miscellaneous', '6000.00', '2015-07-30'),
(00033, 'Kindergarten 2', 'Monthly', 'Monthly Fee', '1050.00', NULL),
(00034, 'Grade 1', 'Cash', 'Downpayment', '24000.00', NULL),
(00035, 'Grade 1', 'Semi-Annual', 'Downpayment', '14000.00', NULL),
(00036, 'Grade 1', 'Semi-Annual', 'Miscellaneous', '4000.00', '2015-07-30'),
(00037, 'Grade 1', 'Semi-Annual', 'September Fee', '7000.00', '2015-09-30'),
(00038, 'Grade 1', 'Tri-Term', 'Downpayment', '12000.00', NULL),
(00039, 'Grade 1', 'Tri-Term', 'Miscellaneous', '5000.00', '2015-07-30'),
(00040, 'Grade 1', 'Tri-Term', 'October Fee', '4750.00', '2015-10-01'),
(00041, 'Grade 1', 'Tri-Term', 'January Fee', '4750.00', '2016-01-01'),
(00042, 'Grade 1', 'Monthly', 'Downpayment', '8000.00', NULL),
(00043, 'Grade 1', 'Monthly', 'Miscellaneous', '7000.00', '2015-07-30'),
(00044, 'Grade 1', 'Monthly', 'Monthly Fee', '1300.00', NULL),
(00045, 'Grade 2', 'Cash', 'Downpayment', '24000.00', NULL),
(00046, 'Grade 2', 'Semi-Annual', 'Downpayment', '14000.00', NULL),
(00047, 'Grade 2', 'Semi-Annual', 'Miscellaneous', '4000.00', '2015-07-30'),
(00048, 'Grade 2', 'Semi-Annual', 'September Fee', '7000.00', '2015-09-30'),
(00049, 'Grade 2', 'Tri-Term', 'Downpayment', '12000.00', NULL),
(00050, 'Grade 2', 'Tri-Term', 'Miscellaneous', '5000.00', '2015-07-30'),
(00051, 'Grade 2', 'Tri-Term', 'October Fee', '4750.00', '2015-10-01'),
(00052, 'Grade 2', 'Tri-Term', 'January Fee', '4750.00', '2016-01-01'),
(00053, 'Grade 2', 'Monthly', 'Downpayment', '8000.00', NULL),
(00054, 'Grade 2', 'Monthly', 'Miscellaneous', '7000.00', '2015-07-30'),
(00055, 'Grade 2', 'Monthly', 'Monthly Fee', '1300.00', NULL),
(00056, 'Grade 3', 'Cash', 'Downpayment', '24000.00', NULL),
(00057, 'Grade 3', 'Semi-Annual', 'Downpayment', '14000.00', NULL),
(00058, 'Grade 3', 'Semi-Annual', 'Miscellaneous', '4000.00', '2015-07-30'),
(00059, 'Grade 3', 'Semi-Annual', 'September Fee', '7000.00', '2015-09-30'),
(00060, 'Grade 3', 'Tri-Term', 'Downpayment', '12000.00', NULL),
(00061, 'Grade 3', 'Tri-Term', 'Miscellaneous', '5000.00', '2015-07-30'),
(00062, 'Grade 3', 'Tri-Term', 'October Fee', '4750.00', '2015-10-01'),
(00063, 'Grade 3', 'Tri-Term', 'January Fee', '4750.00', '2016-01-01'),
(00064, 'Grade 3', 'Monthly', 'Downpayment', '8000.00', NULL),
(00065, 'Grade 3', 'Monthly', 'Miscellaneous', '7000.00', '2015-07-30'),
(00066, 'Grade 3', 'Monthly', 'Monthly Fee', '1300.00', NULL),
(00067, 'Grade 4', 'Cash', 'Downpayment', '25000.00', NULL),
(00068, 'Grade 4', 'Semi-Annual', 'Downpayment', '13500.00', NULL),
(00069, 'Grade 4', 'Semi-Annual', 'Miscellaneous', '5000.00', '2015-07-30'),
(00070, 'Grade 4', 'Semi-Annual', 'September Fee', '7500.00', '2015-09-30'),
(00071, 'Grade 4', 'Tri-Term', 'Downpayment', '11000.00', NULL),
(00072, 'Grade 4', 'Tri-Term', 'Miscellaneous', '6500.00', '2015-07-30'),
(00073, 'Grade 4', 'Tri-Term', 'October Fee', '5000.00', '2015-10-01'),
(00074, 'Grade 4', 'Tri-Term', 'January Fee', '5000.00', '2016-01-01'),
(00075, 'Grade 4', 'Monthly', 'Downpayment', '8000.00', NULL),
(00076, 'Grade 4', 'Monthly', 'Miscellaneous', '7500.00', '2015-07-30'),
(00077, 'Grade 4', 'Monthly', 'Monthly Fee', '1350.00', NULL),
(00078, 'Grade 5', 'Cash', 'Downpayment', '25000.00', NULL),
(00079, 'Grade 5', 'Semi-Annual', 'Downpayment', '13500.00', NULL),
(00080, 'Grade 5', 'Semi-Annual', 'Miscellaneous', '5000.00', '2015-07-30'),
(00081, 'Grade 5', 'Semi-Annual', 'September Fee', '7500.00', '2015-09-30'),
(00082, 'Grade 5', 'Tri-Term', 'Downpayment', '11000.00', NULL),
(00083, 'Grade 5', 'Tri-Term', 'Miscellaneous', '6500.00', '2015-07-30'),
(00084, 'Grade 5', 'Tri-Term', 'October Fee', '5000.00', '2015-10-01'),
(00085, 'Grade 5', 'Tri-Term', 'January Fee', '5000.00', '2016-01-01'),
(00086, 'Grade 5', 'Monthly', 'Downpayment', '8000.00', NULL),
(00087, 'Grade 5', 'Monthly', 'Miscellaneous', '7500.00', '2015-07-30'),
(00088, 'Grade 5', 'Monthly', 'Monthly Fee', '1350.00', NULL),
(00089, 'Grade 6', 'Cash', 'Downpayment', '25000.00', NULL),
(00090, 'Grade 6', 'Semi-Annual', 'Downpayment', '13500.00', NULL),
(00091, 'Grade 6', 'Semi-Annual', 'Miscellaneous', '5000.00', '2015-07-30'),
(00092, 'Grade 6', 'Semi-Annual', 'September Fee', '7500.00', '2015-09-30'),
(00093, 'Grade 6', 'Tri-Term', 'Downpayment', '11000.00', NULL),
(00094, 'Grade 6', 'Tri-Term', 'Miscellaneous', '6500.00', '2015-07-30'),
(00095, 'Grade 6', 'Tri-Term', 'October Fee', '5000.00', '2015-10-01'),
(00096, 'Grade 6', 'Tri-Term', 'January Fee', '5000.00', '2016-01-01'),
(00097, 'Grade 6', 'Monthly', 'Downpayment', '8000.00', NULL),
(00098, 'Grade 6', 'Monthly', 'Miscellaneous', '7500.00', '2015-07-30'),
(00099, 'Grade 6', 'Monthly', 'Monthly Fee', '1350.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `options_academic_status`
--

CREATE TABLE IF NOT EXISTS `options_academic_status` (
`id` int(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `options_academic_status`
--

INSERT INTO `options_academic_status` (`id`, `status`) VALUES
(1, 'Regular'),
(2, 'Irregular'),
(3, 'Transferee');

-- --------------------------------------------------------

--
-- Table structure for table `options_grades`
--

CREATE TABLE IF NOT EXISTS `options_grades` (
`id` int(2) NOT NULL,
  `grade_levels` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `options_grades`
--

INSERT INTO `options_grades` (`id`, `grade_levels`) VALUES
(1, 'Pre-Nursery'),
(2, 'Nursery'),
(3, 'Kindergarten 1'),
(4, 'Kindergarten 2'),
(5, 'Grade 1'),
(6, 'Grade 2'),
(7, 'Grade 3'),
(8, 'Grade 4'),
(9, 'Grade 5'),
(10, 'Grade 6');

-- --------------------------------------------------------

--
-- Table structure for table `options_others`
--

CREATE TABLE IF NOT EXISTS `options_others` (
`id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `options_others`
--

INSERT INTO `options_others` (`id`, `item`, `price`, `due_date`) VALUES
(1, 'Pre-School Uniform', 800, NULL),
(2, 'Grade-School Uniform', 900, NULL),
(3, 'PE Pre-School Uniform', 700, NULL),
(4, 'PE Grade School Uniform', 800, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `options_payment_modes`
--

CREATE TABLE IF NOT EXISTS `options_payment_modes` (
`id` int(2) NOT NULL,
  `mode` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `options_payment_modes`
--

INSERT INTO `options_payment_modes` (`id`, `mode`) VALUES
(1, 'Cash'),
(2, 'Semi-Annual'),
(3, 'Tri-Term'),
(4, 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `options_school_year`
--

CREATE TABLE IF NOT EXISTS `options_school_year` (
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options_school_year`
--

INSERT INTO `options_school_year` (`year`) VALUES
(2015),
(2016),
(2017),
(2018),
(2019),
(2020),
(2021),
(2022),
(2023),
(2024),
(2025);

-- --------------------------------------------------------

--
-- Table structure for table `options_times`
--

CREATE TABLE IF NOT EXISTS `options_times` (
`id` int(2) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `options_times`
--

INSERT INTO `options_times` (`id`, `time`) VALUES
(1, '8:00 am'),
(2, '9:30 am'),
(3, '10:00 am'),
(4, '11:00 am'),
(5, '12:00 pm'),
(6, '1:00 pm'),
(7, '2:00 pm'),
(8, '3:00 pm'),
(9, '4:00 pm'),
(10, '5:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE IF NOT EXISTS `penalty` (
  `penalty` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`penalty`) VALUES
('5.00');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL,
  `from_user` varchar(20) NOT NULL,
  `to_user` varchar(20) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `from_user`, `to_user`, `subject`, `message`, `date`, `read`) VALUES
(0, 'admin', 'juan', 'asd', 'asdasdadsa\r\n', '2015-05-02', 0),
(0, 'juan', 'admin', 'asd', 'hahahahaha', '2015-05-02', 0),
(0, 'juan', 'admin', 'asd', 'hahahahaha', '2015-05-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE IF NOT EXISTS `school_year` (
  `from` int(4) NOT NULL,
  `to` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`from`, `to`) VALUES
(2015, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`student_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `fromTime` varchar(20) NOT NULL,
  `toTime` varchar(20) NOT NULL,
  `academicstatus` varchar(20) NOT NULL,
  `paymentmode` varchar(20) NOT NULL,
  `uniform` varchar(20) DEFAULT NULL,
  `peuniform` varchar(20) DEFAULT NULL,
  `imagelocation` varchar(50) NOT NULL,
  `last_accessed` date NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `middle_name`, `age`, `grade`, `fromTime`, `toTime`, `academicstatus`, `paymentmode`, `uniform`, `peuniform`, `imagelocation`, `last_accessed`, `state`) VALUES
(53, 'Richard', 'Gomez', 'B', 6, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', 'Child.jpg', '2015-03-13', 0),
(54, 'Isabel', 'Frial', 'K.', 6, 'Kindergarten 1 ', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', 'child-8-sm.jpg', '2015-03-13', 0),
(55, 'Geoff', 'Eigenmann', 'Y.', 8, 'Nursery', '8:00 am', '12:00 pm', 'Regular', 'Tri-Term', '', '', 'child-happy-face.jpg', '2015-04-30', 0),
(56, 'Robin', 'Padilla', 'H.', 9, 'Nursery', '8:00 am', '11:00 am', 'Regular', 'Monthly', '', '', 'kid1.jpg', '2015-05-01', 0),
(57, 'Ogie', 'Alcasid', 'J.', 4, 'Kindergarten 1 ', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', 'kids_hoodie_red_front_4.jpg', '2015-06-12', 0),
(58, 'Kim', 'Chui', 'Q.', 6, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', 'Smiling_girl_outside.jpg', '2015-03-12', 0),
(59, 'Manny', 'Pacquiao', 'W.', 5, 'Kindergarten 1 ', '8:00 am', '11:00 am', 'Regular', 'Semi-Annual', '', '', 'smiling-child.jpg', '2015-03-13', 0),
(60, 'Floyd', 'Mayweather', 'E.', 8, 'Grade 1', '8:00 am', '2:00 pm', 'Regular', 'Monthly', '', '', 'smiling-kid.jpg', '2015-08-02', 0),
(61, 'Mike', 'Tyson', 'F.', 5, 'Kindergarten 1 ', '8:00 am', '8:00 am', 'Regular', 'Semi-Annual', '', '', 'sos-child-bulgaria.jpg', '2015-08-02', 0),
(62, 'Bon', 'Jovi', 'L.', 6, 'Kindergarten 1 ', '8:00 am', '8:00 am', 'Regular', 'Tri-Term', '', '', 'Whiz Kid 23.png', '2015-03-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabs_academicstatus`
--

CREATE TABLE IF NOT EXISTS `tabs_academicstatus` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade_level` int(10) NOT NULL,
  `quarter` varchar(50) NOT NULL,
  `average` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tabs_academicstatus`
--

INSERT INTO `tabs_academicstatus` (`id`, `student_id`, `grade_level`, `quarter`, `average`) VALUES
(1, 24, 10, '', 10),
(2, 24, 10, '', 10),
(3, 24, 10, '', 10),
(4, 24, 10, '0', 0),
(5, 24, 10, '10', 10),
(7, 6, 5, '2nd', 5),
(8, 6, 6, '3rd', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tabs_other_records`
--

CREATE TABLE IF NOT EXISTS `tabs_other_records` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sent_to` varchar(50) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tabs_other_records`
--

INSERT INTO `tabs_other_records` (`id`, `student_id`, `date`, `sent_to`, `reason`) VALUES
(1, 40, '0000-00-00', '', ''),
(2, 40, '0000-00-00', '', ''),
(3, 50, '0000-00-00', '', ''),
(4, 50, '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_control` int(2) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `access_control`, `first_name`, `last_name`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'Michael', 'Joslyn'),
(2, 'juan', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Juan', 'Cruz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_balance`
--
ALTER TABLE `fee_balance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_payment`
--
ALTER TABLE `fee_payment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_schedule`
--
ALTER TABLE `fee_schedule`
 ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `options_academic_status`
--
ALTER TABLE `options_academic_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options_grades`
--
ALTER TABLE `options_grades`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options_others`
--
ALTER TABLE `options_others`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options_payment_modes`
--
ALTER TABLE `options_payment_modes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options_times`
--
ALTER TABLE `options_times`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tabs_academicstatus`
--
ALTER TABLE `tabs_academicstatus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabs_other_records`
--
ALTER TABLE `tabs_other_records`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee_balance`
--
ALTER TABLE `fee_balance`
MODIFY `id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT for table `fee_payment`
--
ALTER TABLE `fee_payment`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `fee_schedule`
--
ALTER TABLE `fee_schedule`
MODIFY `fee_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `options_academic_status`
--
ALTER TABLE `options_academic_status`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `options_grades`
--
ALTER TABLE `options_grades`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `options_others`
--
ALTER TABLE `options_others`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options_payment_modes`
--
ALTER TABLE `options_payment_modes`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options_times`
--
ALTER TABLE `options_times`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `tabs_academicstatus`
--
ALTER TABLE `tabs_academicstatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tabs_other_records`
--
ALTER TABLE `tabs_other_records`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
