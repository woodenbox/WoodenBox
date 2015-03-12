-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2015 at 10:57 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `fee_balance`
--

INSERT INTO `fee_balance` (`id`, `student_id`, `item`, `balance`, `due_date`, `penalty_count`, `penalty_balance`, `waive`, `original_price`) VALUES
(1, 1, 'Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(2, 1, 'Grade-School Uniform', '900.00', NULL, 0, '0.00', 0, '0.00'),
(3, 1, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '0.00'),
(4, 2, 'Pre-School Uniform', '2400.00', NULL, 0, '0.00', 1, '0.00'),
(5, 2, 'PE Pre-School Uniform', '800.00', NULL, 0, '0.00', 0, '0.00'),
(6, 2, 'Downpayment', '11000.00', NULL, 0, '0.00', 0, '0.00'),
(7, 2, 'Miscellaneous', '3000.00', '2016-03-29', 8, '1200.00', 0, '0.00'),
(8, 2, 'September Fee', '6000.00', '2016-03-29', 6, '1800.00', 0, '0.00'),
(9, 3, 'Pre-School Uniform', '1600.00', NULL, 0, '0.00', 0, '0.00'),
(10, 3, 'PE Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(11, 3, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '0.00'),
(12, 4, 'Pre-School Uniform', '1600.00', NULL, 0, '0.00', 0, '0.00'),
(13, 4, 'PE Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(14, 4, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '0.00'),
(45, 16, 'Pre-School Uniform', '1600.00', NULL, 0, '0.00', 0, '0.00'),
(46, 16, 'Grade-School Uniform', '1800.00', NULL, 0, '0.00', 0, '0.00'),
(47, 16, 'PE Pre-School Uniform', '1400.00', NULL, 0, '0.00', 0, '0.00'),
(48, 16, 'PE Grade School Uniform', '1600.00', NULL, 0, '0.00', 0, '0.00'),
(49, 16, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '0.00'),
(66, 18, 'Pre-School Uniform', '1600.00', NULL, 0, '0.00', 0, '0.00'),
(67, 19, 'Pre-School Uniform', '800.00', NULL, 0, '0.00', 0, '0.00'),
(68, 20, 'Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(69, 20, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '0.00'),
(70, 21, 'Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(71, 21, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '0.00'),
(72, 21, 'Miscellaneous', '0.00', '2015-07-30', 0, '0.00', 0, '0.00'),
(73, 21, 'September Fee', '0.00', '2015-09-30', 0, '0.00', 0, '0.00'),
(79, 1, 'Pre-School Uniform', '800000.00', NULL, 0, '0.00', 0, '0.00'),
(95, 30, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '0.00'),
(96, 30, 'Miscellaneous', '0.00', NULL, 0, '0.00', 0, '0.00'),
(97, 30, 'October Fee', '2500.00', '2016-05-01', 7, '875.00', 0, '0.00'),
(98, 30, 'January Fee', '5000.00', '2016-05-01', 4, '1000.00', 0, '0.00'),
(100, 30, 'Downpayment', '11000.00', NULL, 0, '0.00', 0, '0.00'),
(101, 30, 'Miscellaneous', '6500.00', NULL, 0, '0.00', 0, '0.00'),
(102, 30, 'October Fee', '5000.00', '2016-05-01', 7, '1750.00', 0, '0.00'),
(103, 30, 'January Fee', '5000.00', '2016-05-01', 4, '1000.00', 0, '0.00'),
(104, 30, 'Downpayment', '19000.00', NULL, 0, '0.00', 1, '0.00'),
(105, 31, 'Downpayment', '8490.00', NULL, 0, '0.00', 1, '0.00'),
(106, 31, 'Miscellaneous', '4000.00', '2017-03-30', 20, '4000.00', 1, '0.00'),
(107, 31, 'October Fee', '4000.00', '2018-04-30', 30, '6000.00', 0, '0.00'),
(108, 31, 'January Fee', '4000.00', '2018-04-30', 27, '5400.00', 0, '0.00'),
(109, 33, 'Downpayment', '9000.00', NULL, 0, '0.00', 0, '0.00'),
(110, 33, 'Miscellaneous', '4000.00', '2015-10-30', 36, '7200.00', 0, '0.00'),
(111, 33, 'October Fee', '4000.00', '2018-05-30', 31, '6200.00', 0, '0.00'),
(112, 33, 'January Fee', '4000.00', '2018-05-30', 28, '5600.00', 0, '0.00'),
(113, 34, '', '11000.00', NULL, 0, '0.00', 1, '0.00'),
(114, 34, '', '3000.00', NULL, 1, '150.00', 1, '0.00'),
(115, 34, 'September Fee', '6000.00', '2015-05-30', 1, '300.00', 0, '0.00'),
(116, 35, '', '18873.45', NULL, 0, '0.00', 1, '0.00'),
(117, 40, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '9000.00'),
(118, 40, 'Miscellaneous', '4000.00', '2015-08-30', 1, '200.00', 1, '4000.00'),
(119, 40, 'October Fee', '0.00', '2015-10-01', 0, '0.00', 0, '4000.00'),
(120, 40, 'January Fee', '0.10', '2016-01-01', 0, '0.00', 1, '4000.00'),
(121, 40, 'Pre-School Uniform', '800.00', NULL, 0, '0.00', 1, '800.00'),
(122, 42, 'Pre-School Uniform', '0.00', NULL, 0, '0.00', 1, '0.00'),
(123, 43, 'Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '800.00'),
(124, 43, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '19000.00'),
(125, 44, 'Pre-School Uniform', '7200.00', NULL, 0, '0.00', 1, '7200.00'),
(126, 44, 'PE Pre-School Uniform', '0.00', NULL, 0, '0.00', 0, '0.00'),
(127, 44, 'Downpayment', '0.00', NULL, 0, '0.00', 0, '19000.00'),
(128, 45, 'Downpayment', '11000.00', NULL, 0, '0.00', 1, '11000.00'),
(129, 45, 'Miscellaneous', '2500.00', '2015-09-10', 0, '5.00', 0, '3000.00'),
(130, 45, 'September Fee', '6000.00', '2015-09-30', 0, '0.00', 0, '6000.00'),
(131, 46, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00'),
(132, 47, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00'),
(133, 48, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00'),
(134, 49, 'Downpayment', '19000.00', NULL, 0, '0.00', 1, '19000.00'),
(135, 50, 'Downpayment', '19000.00', NULL, 0, '0.00', 1, '19000.00'),
(136, 50, 'Downpayment', '14000.00', NULL, 0, '0.00', 0, '14000.00'),
(137, 50, 'Miscellaneous', '4000.00', '2015-09-30', 1, '400.00', 0, '4000.00'),
(138, 50, 'September Fee', '7000.00', '2015-09-30', 0, '0.00', 0, '7000.00'),
(139, 51, 'Downpayment', '10000.00', NULL, 0, '0.00', 1, '10000.00'),
(140, 51, 'Miscellaneous', '15000.00', NULL, 0, '0.00', 1, '15000.00'),
(141, 52, 'Downpayment', '19000.00', NULL, 0, '0.00', 0, '19000.00');

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
  `state` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `fee_payment`
--

INSERT INTO `fee_payment` (`id`, `last_name`, `first_name`, `payment_date`, `cash`, `dr`, `cr`, `tuition`, `remark`, `student_id`, `year`, `month`, `ar`, `state`) VALUES
(2, '2', '1', '2015-03-01', '1235.00', '', '', '123.00', 'Uniform', 15, 2015, 'March', 2, 0),
(3, '', '', '2015-03-01', '200.50', '', '', '201.00', 'Uniform', 8, 2015, 'March', 3, 0),
(4, '', '', '2015-03-01', '199.50', '', '', '199.50', 'Uniform', 8, 2015, 'March', 4, 0),
(5, 'ifef', 'Freidn', '2015-03-02', '1800.00', '', '', '1800.00', 'Uniforms', 24, 2015, 'March', 5, 0),
(6, 'ifef', 'Freidn', '2015-03-02', '8500.00', '', '', '8500.00', 'Uniform and Downpayment', 24, 2015, 'March', 6, 0),
(7, 'Joslyn', 'Michael', '2016-03-02', '19000.00', '', '', '19000.00', 'Uniform', 23, 2016, 'March', 7, 0),
(9, '', '', '2015-03-02', '100.00', '', '', '100.00', 'Uniform', 22, 2015, 'March', 9, 0),
(10, '', '', '2015-03-02', '800.00', '', '', '800.00', 'Uniform', 22, 2015, 'March', 10, 0),
(11, 'Nudd', 'Vin', '2015-03-02', '800.00', '', '', '800.00', 'Pre-School Uniform', 1, 2015, 'March', 11, 0),
(12, '', '', '2015-03-02', '11800.00', '', '', '11800.00', 'Downpayment & Uniform', 21, 2015, 'March', 12, 0),
(13, '', '', '2015-03-02', '9000.00', '', '', '9000.00', 'Clicakb', 21, 2015, 'March', 13, 0),
(14, '', '', '2015-03-02', '800.00', '', '', '800.00', 'Uniform', 20, 2015, 'March', 14, 1),
(15, '', '', '2015-03-02', '19000.00', '', '', '19000.00', 'Downpayment', 20, 2015, 'March', 15, 0),
(16, 'Lol', 'Lol', '2015-03-02', '20000.00', '', '', '20000.00', 'lol', 30, 2015, 'March', 16, 0),
(17, 'Guy', 'New', '2015-03-03', '10.00', '', '', '10.00', 'REm', 31, 2015, 'March', 17, 1),
(18, 'Guy', 'New', '2015-03-03', '500.00', '', '', '500.00', 'ege', 31, 2015, 'March', 18, 1),
(19, 'Rots', 'Job', '2015-03-03', '63.00', '', '', '63.00', 'femf', 35, 2015, 'March', 17, 0),
(20, 'Rots', 'Job', '2015-03-03', '63.00', '', '', '63.00', 'femf', 35, 2015, 'March', 17, 0),
(21, 'Something', 'Radical', '2015-03-09', '9000.00', '', '', '9000.00', '', 40, 2015, 'March', 19, 0),
(22, 'Something', 'Radical', '2015-03-09', '500.00', '', '', '500.00', '', 40, 2015, 'March', 20, 0),
(23, 'Something', 'Radical', '2015-03-09', '99.90', '', '', '99.90', '', 40, 2015, 'March', 21, 0),
(24, 'Something', 'Radical', '2015-03-09', '5000.00', '', '', '5000.00', '', 40, 2015, 'March', 22, 0),
(25, 'Something', 'Radical', '2015-03-09', '2400.00', '', '', '2400.00', 'January Feees', 40, 2015, 'March', 23, 0),
(26, 'joslynq', 'micahe', '2015-03-09', '19800.00', '', '', '19800.00', 'Downpayment', 43, 2015, 'March', 24, 0),
(27, 'Sulit', 'Job', '2015-03-10', '2000.00', '', '', '2000.00', 'Mahalaga magbayad ha', 44, 2015, 'March', 25, 1),
(28, 'Sulit', 'Job', '2015-03-11', '17000.00', '', '', '17000.00', 'Downpayment', 44, 2015, 'March', 26, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `middle_name`, `age`, `grade`, `fromTime`, `toTime`, `academicstatus`, `paymentmode`, `uniform`, `peuniform`, `imagelocation`, `last_accessed`, `state`) VALUES
(1, 'Vin', 'Nudd', 'A', 10, 'Nursery', '8:00 am', '11:00 am', 'Regular', 'Cash', '', '', 'ss_101558346.jpg', '2015-03-09', 0),
(2, 'Blake', 'Sheldon', 'Q', 4, 'Nursery', '8:00 am', '12:00 pm', 'Regular', 'Semi-Annual', '', '', 'wavebreak-media_smart-kid-blackboard-300x300.jpg', '2015-03-09', 0),
(3, '', '', '', 0, 'Nursery', '', '', '', 'Cash', '', '', '', '2015-03-03', 0),
(4, '', '', '', 0, 'Nursery', '', '', '', 'Cash', '', '', '', '2015-03-09', 0),
(18, 'Bigay', 'Gege', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-02', 0),
(19, '', '', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2018-04-01', 0),
(20, '', '', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-02', 0),
(21, '', '', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Semi-Annual', '', '', '', '2015-03-09', 0),
(25, '', '', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-02', 0),
(26, '152', '.', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-02', 0),
(27, 'OFSM', 'ASGN', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-09', 0),
(29, 'Michael', 'Joslyn', 'F', 10, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Monthly', '', '', '', '2015-03-02', 0),
(30, 'Lol', 'Lol', 'Lol', 20, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-09-17', 0),
(31, 'New', 'Guy', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Tri-Term', '', '', '', '2015-03-03', 0),
(32, 'fewf', 'ewfh', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Monthly', '', '', '', '2016-01-19', 0),
(33, 'eogj', 'ijg', 'ge', 51, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Tri-Term', '', '', '', '2015-09-17', 0),
(34, 'Tensen', 'Kris', 'F', 20, 'Nursery', '9:00 am', '11:00 am', 'Irregular', 'Semi-Annual', '', '', '', '2015-05-01', 0),
(35, 'Job', 'Rots', 'f', 0, 'Nursery', '8:00 am', '10:00 am', 'Irregular', 'Cash', '', '', '', '2015-03-09', 0),
(36, 'gej', 'gijrij', 'gij', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-03', 0),
(37, 'gpoje', 'RKGNN', 'RGN', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-10', 0),
(38, 'APKF', 'KIGNJ', 'GOJ', 20, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-03', 0),
(39, 'Michael', 'JEFO', 'MEW', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-03', 0),
(40, 'Radical', 'Something', 'F', 20, 'Kindergarten 1', '8:00 am', '8:00 am', 'Regular', 'Tri-Term', '', '', '', '2015-03-09', 0),
(41, '', '', '', 0, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-09', 0),
(42, 'Michael', 'ASf', '', 99, 'Pre-Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-10', 1),
(43, 'micahe', 'joslynq', '', 99, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-10', 0),
(44, 'Job', 'Sulit', 'Santos', 45, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '19.jpg', '2015-03-11', 0),
(45, 'Job', 'Sulit', '', 0, 'Kindergarten 1 ', '8:00 am', '8:00 am', 'Regular', 'Semi-Annual', '', '', '19.jpg', '2015-03-10', 0),
(46, 'micaeh', 'joslyn', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '19.jpg', '2015-03-10', 0),
(47, 'any', 'asd', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-10', 0),
(48, 'ije', 'gnrk', '', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '19.jpg', '2015-03-10', 0),
(49, 'Job', 'SUlit', 'asd', 0, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '19.jpg', '2015-03-11', 0),
(50, 'Job', 'Sulit', '', 0, 'Grade 1', '8:00 am', '8:00 am', 'Regular', 'Semi-Annual', '', '', '19.jpg', '2015-09-11', 0),
(51, 'Michael', 'Joslyn', 'F', 20, 'Grade 7', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '', '2015-03-12', 0),
(52, 'asas', 'sags', 'sg', 12, 'Nursery', '8:00 am', '8:00 am', 'Regular', 'Cash', '', '', '19.jpg', '2015-03-12', 0);

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
(1, 'user', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'Michael', 'Joslyn'),
(2, 'jc', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Juan', 'Cruz');

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
MODIFY `id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `fee_payment`
--
ALTER TABLE `fee_payment`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `fee_schedule`
--
ALTER TABLE `fee_schedule`
MODIFY `fee_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
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
MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
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
