-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2019 at 02:04 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zend`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `reason_of_visit` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `username`, `reason_of_visit`, `start_time`, `end_time`) VALUES
(13, 'Kirandeep Kaur', 'regular checkup', '2019-01-01 01:00:00', '2020-01-01 01:50:00'),
(3, 'kiran123', 'Monthly-checkup', '2019-02-24 05:56:00', '2019-02-24 05:56:00'),
(4, 'kiran123', 'Lab tests go-through', '2019-02-24 05:56:00', '2019-02-24 05:56:00'),
(14, 'Cardi B', 'Mental Checkup :D', '2019-01-01 15:30:00', '2019-01-01 16:30:00'),
(8, 'kiran3046', 'yearly', '2019-01-01 01:00:00', '2019-01-02 01:00:00'),
(9, 'kiran3046', 'yearly', '2019-01-01 01:00:00', '2021-01-01 02:00:00'),
(10, 'Kirandeep Kaur', 'regular checkup', '2019-02-01 12:00:00', '2019-02-01 13:10:00'),
(12, 'Drake321', 'regular checkup', '2019-03-01 13:00:00', '2019-03-01 13:20:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
