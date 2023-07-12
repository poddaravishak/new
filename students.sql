-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 08:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `batch` int(11) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `currently_worked` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `father_name`, `mother_name`, `date_of_birth`, `batch`, `department`, `session`, `photo`, `mobile`, `email`, `password`, `currently_worked`) VALUES
(1222212, 'rxrtxr', 'xyrfh', 'cg', 'tyrx', '2023-07-06', 3, 'EEE', '2018-198', 'demo.jpg', '01222212214', 'aera@gmail.com', '123457', 'It company'),
(123456789, 'Demo', 'one', 'Father name', 'MOther name', '2016-03-13', 2, 'CSE', '2016-17', 'demo.jpg', '01241142542', 'example@domain.com', '123456', 'Software company'),
(2147483647, 'Demo', ' two', 'Demo', 'demo', '2007-07-13', 2, 'CSE', '2015-16', 'demo.jpg', '01235475214', 'demo2@gmail.com', '123456', 'Software Company');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
