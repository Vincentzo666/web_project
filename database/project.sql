-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Feb 05, 2023 at 07:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6
=======
-- Generation Time: Feb 02, 2023 at 07:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33
>>>>>>> parent of 1d98f7a (success)

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
  `up_time` datetime DEFAULT NULL
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
>>>>>>> parent of 1d98f7a (success)

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `std_id`, `prefix`, `fname`, `lname`, `email`, `phone`, `std_pic`, `cr_time`, `up_time`) VALUES
<<<<<<< HEAD
(1, '62114340371', 'นาย', 'สหัสวรรษ', 'วงศ์สวัสดิ์', 'sahasawat.14@gmail.com', '0967812740', 'สหัสวรรษ-62114340371.jpg', '2023-02-05 13:01:35', NULL),
(2, '62114340027', 'นาย', 'กฤติน', 'หวังยศ', 'krittin.wa.62@ubu.ac.th', '', 'กฤติน-62114340027.png', '2023-02-05 13:03:26', NULL),
(3, '62114340069', 'นาย', 'คมกฤษณ์', 'มุธาพร', 'komkrit.mu.62@ubu.ac.th', '', 'คมกฤษณ์-62114340069.PNG', '2023-02-05 13:03:51', NULL),
(4, '62114340133', 'นาย', 'ณัฐวุฒิ', 'สุดาชม', 'nattawut.su.62@ubu.ac.th', '', 'ณัฐวุฒิ-62114340133.png', '2023-02-05 13:04:19', NULL),
(5, '62114340302', 'นางสาว', 'ลีมา', 'ศรีภัคดี', 'lema.sr.62@ubu.ac.th', '', 'ลีมา-62114340302.jpg', '2023-02-05 13:04:47', NULL),
(6, '62114340313', 'นาย', 'วงศกร', 'ผลให้', 'wongsakorn.ph.62@ubu.ac.th', '', 'วงศกร-62114340313.jpg', '2023-02-05 13:05:04', NULL),
(7, '62114340368', 'นางสาว', 'ศศิธร', 'ดอนกว้าง', 'sasithon.do.62@ubu.ac.th', '', 'ศศิธร-62114340368.png', '2023-02-05 13:05:23', NULL),
(8, '62114340386', 'นาย', 'อธิวัฒน์', 'สุริวงค์', 'atiwat.su.62@ubu.ac.th', '', 'อธิวัฒน์-62114340386.jpeg', '2023-02-05 13:05:40', NULL),
(9, '62114340786', 'นาย', 'ณัฐพล', 'จุฬา', 'nattaphon.ju.62@ubu.ac.th', '', 'ณัฐพล-62114340786.jpg', '2023-02-05 13:05:57', NULL);
=======
(8, '111', '', 'ghm', 'b', 'b@gmail.com', '0807502947', 'aaa', '2023-02-01 03:53:43', '2023-02-01 14:33:19'),
(9, '222', '', 'bbb', 'bbb', '', '099123456', 'bbb', '2023-02-01 03:53:43', '2023-02-02 13:33:55'),
(10, '333', NULL, 'ccc', 'ccc', NULL, NULL, 'ccc', '2023-02-01 03:54:42', NULL),
(11, '444', '', 'ddd', 'ddd', '', '000', 'ddd', '2023-02-01 03:54:42', '2023-02-01 11:59:33'),
(12, '555', NULL, 'eee', 'eee', NULL, NULL, 'eee', '2023-02-01 03:55:13', NULL),
(13, '666', 'fff', 'fff', '', NULL, NULL, 'fff', '2023-02-01 03:55:13', NULL),
(14, '62114340160', 'นาย', 'j', 'k', '', '', 'student-20230201131839.png', '2023-02-01 13:18:39', NULL),
(15, '621143401', 'นาง', 'ghm', 'b', 'yub@gmail.com', '', 'student-20230201133158.png', '2023-02-01 13:31:58', NULL),
(16, '64853864564', 'นาย', 'ghm', 'b', 'yub@gmail.com', '', 'student-20230201133257.png', '2023-02-01 13:32:57', NULL),
(17, '777', 'นาย', 'j', 'k', '', '', 'student-20230202133613.png', '2023-02-02 13:36:13', NULL);
>>>>>>> parent of 1d98f7a (success)

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `sub_id`, `id_teacher`, `name`, `detail`, `image`, `cr_time`, `up_time`) VALUES
(29, '111', 15, 'sub1', NULL, NULL, '2023-02-01 03:56:07', NULL),
(30, '222', 15, 'sub2', NULL, NULL, '2023-02-01 03:56:07', NULL);
>>>>>>> parent of 1d98f7a (success)

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_std`
--

INSERT INTO `sub_std` (`id`, `id_subject`, `id_student`, `cr_time`, `up_time`) VALUES
(9, 29, 8, '2023-02-01 03:57:39', NULL),
(10, 29, 9, '2023-02-01 03:57:39', NULL),
(11, 30, 10, '2023-02-01 03:58:07', NULL),
(12, 30, 11, '2023-02-01 03:58:07', NULL),
(14, 30, 9, '2023-02-01 03:58:44', NULL),
(15, 29, 10, '2023-02-01 14:01:54', NULL),
(16, 29, 11, '2023-02-01 14:02:07', NULL);
>>>>>>> parent of 1d98f7a (success)

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `prefix`, `fname`, `lname`, `email`, `phone`, `profile`, `username`, `password`, `cr_time`, `up_time`) VALUES
(15, 'นาย', 'ธนวัฒน์', 'ลัดดา', 'thanawat.la.62@ubu.ac.th', '0991861363', 'teacher-20230130161944.jpg', 'jom', 'lpd1oKW84i4=', '2023-01-23 14:02:35', '2023-01-30 16:42:23');
>>>>>>> parent of 1d98f7a (success)

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
>>>>>>> parent of 1d98f7a (success)

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
>>>>>>> parent of 1d98f7a (success)

--
-- AUTO_INCREMENT for table `sub_std`
--
ALTER TABLE `sub_std`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
>>>>>>> parent of 1d98f7a (success)

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
>>>>>>> parent of 1d98f7a (success)

--
-- Constraints for dumped tables
--

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
