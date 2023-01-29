-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 10:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `std_id` varchar(255) NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `std_pic` varchar(255) NOT NULL,
  `cr_time` datetime NOT NULL,
  `up_time` datetime DEFAULT NULL,
  `add_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `sub_id` varchar(255) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cr_time` datetime NOT NULL,
  `up_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `sub_id`, `id_teacher`, `name`, `detail`, `image`, `cr_time`, `up_time`) VALUES
(1, '62445hl', 15, 'information technology', 'esugybkrrrrrrbhbbbrhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', NULL, '2023-01-27 11:50:04', NULL),
(2, '62445oo', 15, 'information t', 'uyskhb J bNS', NULL, '2023-01-27 11:50:47', NULL),
(3, 'bs5', 15, 'informa', '', NULL, '2023-01-27 11:51:08', NULL),
(4, 'aetjzh', 15, 'tjs', '', NULL, '2023-01-27 11:55:03', NULL),
(5, 'bs5s', 15, 'dz', '', NULL, '2023-01-27 11:56:06', NULL),
(6, 'aeh', 15, 'aej', '', 'subject-20230127115731.png', '2023-01-27 11:57:31', NULL),
(7, '62445hl', 15, 'information technology', 'esugybkrrrrrrbhbbbrhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', NULL, '2023-01-27 11:50:04', NULL),
(8, '62445oo', 15, 'information t', 'uyskhb J bNS', NULL, '2023-01-27 11:50:47', NULL),
(9, 'bs5', 15, 'informa', '', NULL, '2023-01-27 11:51:08', NULL),
(10, 'aetjzh', 15, 'tjs', '', NULL, '2023-01-27 11:55:03', NULL),
(11, 'bs5s', 15, 'dz', '', NULL, '2023-01-27 11:56:06', NULL),
(12, 'aeh', 15, 'aej', '', 'subject-20230127115731.png', '2023-01-27 11:57:31', NULL),
(13, '62445hl', 15, 'information technology', 'esugybkrrrrrrbhbbbrhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', NULL, '2023-01-27 11:50:04', NULL),
(14, '62445oo', 15, 'information t', 'uyskhb J bNS', NULL, '2023-01-27 11:50:47', NULL),
(15, 'bs5', 15, 'informa', '', NULL, '2023-01-27 11:51:08', NULL),
(16, 'aetjzh', 15, 'tjs', '', NULL, '2023-01-27 11:55:03', NULL),
(17, 'bs5s', 15, 'dz', '', NULL, '2023-01-27 11:56:06', NULL),
(18, 'aeh', 15, 'aej', '', 'subject-20230127115731.png', '2023-01-27 11:57:31', NULL),
(19, '62445hl', 15, 'information technology', 'esugybkrrrrrrbhbbbrhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', NULL, '2023-01-27 11:50:04', NULL),
(20, '62445oo', 15, 'information t', 'uyskhb J bNS', NULL, '2023-01-27 11:50:47', NULL),
(21, 'bs5', 15, 'informa', '', NULL, '2023-01-27 11:51:08', NULL),
(22, 'aetjzh', 15, 'tjs', '', NULL, '2023-01-27 11:55:03', NULL),
(23, 'bs5s', 15, 'dz', '', NULL, '2023-01-27 11:56:06', NULL),
(24, 'aeh', 15, 'aej', '', 'subject-20230127115731.png', '2023-01-27 11:57:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_std`
--

CREATE TABLE `sub_std` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cr_time` datetime NOT NULL,
  `up_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `prefix`, `fname`, `lname`, `email`, `phone`, `profile`, `username`, `password`, `cr_time`, `up_time`) VALUES
(15, NULL, 'thanawat', 'ladda', 'thanawat.la.62@ubu.ac.th', NULL, NULL, 'jomtap', '111111', '2023-01-23 14:02:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addby` (`add_by`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tech_sub` (`id_teacher`);

--
-- Indexes for table `sub_std`
--
ALTER TABLE `sub_std`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std` (`id_student`),
  ADD KEY `sub` (`id_subject`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sub_std`
--
ALTER TABLE `sub_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `addby` FOREIGN KEY (`add_by`) REFERENCES `teacher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `tech_sub` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sub_std`
--
ALTER TABLE `sub_std`
  ADD CONSTRAINT `std` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sub` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
