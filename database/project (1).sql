-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 04:24 AM
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
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int(11) NOT NULL,
  `id_croom` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_std` int(11) NOT NULL,
  `ctime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `id_croom`, `id_sub`, `id_std`, `ctime`) VALUES
(2, 1, 29, 9, '2023-02-21 16:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `stime` datetime NOT NULL,
  `etime` datetime DEFAULT NULL,
  `totaltime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `id_subject`, `stime`, `etime`, `totaltime`) VALUES
(1, 29, '2023-02-21 16:42:09', '2023-02-21 16:42:09', '00:00:24');

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
  `up_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `std_id`, `prefix`, `fname`, `lname`, `email`, `phone`, `std_pic`, `cr_time`, `up_time`) VALUES
(9, '222', 'kk', 'BBB', 'bbb', '', '099123456', 'bbb-222.jpg', '2023-02-01 03:53:43', '2023-02-20 10:10:53'),
(12, '555', NULL, 'eee', 'eee', NULL, NULL, 'eee', '2023-02-01 03:55:13', NULL),
(14, '62114340160', 'นาย', 'j', 'k', '', '', 'student-20230201131839.png', '2023-02-01 13:18:39', NULL),
(16, '64853864564', 'นาย', 'ghm', 'b', 'yub@gmail.com', '', 'student-20230201133257.png', '2023-02-01 13:32:57', NULL);

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
(29, '111', 15, 'sub1', NULL, NULL, '2023-02-01 03:56:07', NULL),
(30, '222', 15, 'sub2', NULL, NULL, '2023-02-01 03:56:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_std`
--

CREATE TABLE `sub_std` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `cr_time` datetime NOT NULL,
  `up_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_std`
--

INSERT INTO `sub_std` (`id`, `id_subject`, `id_student`, `cr_time`, `up_time`) VALUES
(10, 29, 9, '2023-02-01 03:57:39', NULL),
(14, 30, 9, '2023-02-01 03:58:44', NULL),
(17, 29, 14, '2023-02-08 09:27:50', NULL);

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
(15, 'นาย', 'ธนวัฒน์', 'ลัดดา', 'thanawat.la.62@ubu.ac.th', '0991861363', 'teacher-20230130161944.jpg', 'jom', 'lpd1oKW84i4=', '2023-01-23 14:02:35', '2023-01-30 16:42:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_std` (`id_std`),
  ADD KEY `id_sub` (`id_sub`),
  ADD KEY `id_croom` (`id_croom`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_ibfk_1` (`id_subject`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_std`
--
ALTER TABLE `sub_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_ibfk_1` FOREIGN KEY (`id_std`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `checkin_ibfk_2` FOREIGN KEY (`id_sub`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `checkin_ibfk_3` FOREIGN KEY (`id_croom`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
