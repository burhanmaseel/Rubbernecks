-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2018 at 03:29 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveys`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `aid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `answer` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`aid`, `qid`, `answer`, `user_id`, `survey_id`, `comments`) VALUES
(116, 68, 'Yes', 4, 27, ''),
(117, 69, 'No', 4, 27, ''),
(118, 70, 'No', 4, 27, ''),
(119, 71, 'Yes', 4, 27, ''),
(120, 72, 'Yes', 4, 27, ''),
(121, 73, 'No', 4, 27, 'Helllooooo World'),
(122, 74, 'Yes', 4, 27, ''),
(123, 68, 'No', 4, 28, ''),
(124, 69, 'Yes', 4, 28, ''),
(125, 70, 'Yes', 4, 28, ''),
(126, 71, 'N/A', 4, 28, ''),
(127, 72, 'Yes', 4, 28, ''),
(128, 73, 'Yes', 4, 28, ''),
(129, 74, 'Yes', 4, 28, ''),
(130, 68, 'No', 5, 29, ''),
(131, 69, 'No', 5, 29, ''),
(132, 70, 'No', 5, 29, ''),
(133, 71, 'Yes', 5, 29, ''),
(134, 72, 'Yes', 5, 29, ''),
(135, 73, 'Yes', 5, 29, ''),
(136, 74, 'Yes', 5, 29, ''),
(137, 75, 'No', 4, 30, ''),
(138, 76, 'Yes', 4, 30, ''),
(139, 77, 'Yes', 4, 30, ''),
(140, 78, 'No', 4, 30, ''),
(141, 79, 'Yes', 4, 30, ''),
(142, 80, 'Yes', 4, 30, ''),
(143, 81, 'Yes', 4, 30, ''),
(144, 82, 'Yes', 6, 31, ''),
(145, 84, 'Yes', 6, 31, 'Something Bad'),
(146, 85, 'No', 6, 31, ''),
(147, 86, 'No', 6, 31, ''),
(148, 87, 'N/A', 4, 32, 'it was nice'),
(149, 88, 'Yes', 4, 32, ''),
(150, 89, 'N/A', 4, 32, '');

-- --------------------------------------------------------

--
-- Table structure for table `assigned`
--

CREATE TABLE `assigned` (
  `assigned_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `assigndate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned`
--

INSERT INTO `assigned` (`assigned_id`, `cid`, `b_id`, `uid`, `assigndate`) VALUES
(27, 6, 16, 4, '2018-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(20) DEFAULT NULL,
  `b_address` text,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`b_id`, `b_name`, `b_address`, `client_id`) VALUES
(16, 'M.M. Alam', NULL, 6),
(17, 'DHA', NULL, 6),
(18, 'DHA', NULL, 7),
(19, 'Gulberg', NULL, 7),
(20, 'Bahria Town', NULL, 7),
(21, 'DHA', NULL, 8),
(22, 'DHA Phase 4', NULL, 9),
(23, 'XX', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `branch_surverys`
--

CREATE TABLE `branch_surverys` (
  `c_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_surverys`
--

INSERT INTO `branch_surverys` (`c_id`, `b_id`, `cat_id`) VALUES
(6, 16, 47),
(6, 16, 48),
(6, 16, 49),
(6, 17, 50),
(6, 17, 51),
(8, 21, 52),
(8, 21, 53),
(9, 22, 54);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(20) DEFAULT NULL,
  `cat_type` varchar(20) DEFAULT NULL,
  `cat_discp` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_type`, `cat_discp`) VALUES
(47, 'Ambiance', '', ''),
(48, 'Quality', '', ''),
(49, '', '', ''),
(50, 'Ambiance', '', ''),
(51, 'Quality', '', ''),
(52, 'Ambiance', '', ''),
(53, 'Product', '', ''),
(54, 'Ambiance', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `c_disc` varchar(20) DEFAULT NULL,
  `sdate` varchar(20) NOT NULL,
  `edate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`c_id`, `c_name`, `c_disc`, `sdate`, `edate`) VALUES
(6, 'Tony & Guy', NULL, '2018-06-13', '2018-07-18'),
(7, 'Blvd 56', NULL, '2018-06-15', '2018-07-20'),
(8, 'Asma T', NULL, '2018-06-14', '2018-07-14'),
(9, 'Jalal Sons', 'retail', '2018-06-20', '2018-07-26'),
(10, 'Madihas', 'salon', '2018-06-23', '2018-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `done_surveys`
--

CREATE TABLE `done_surveys` (
  `done_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `done_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `done_surveys`
--

INSERT INTO `done_surveys` (`done_id`, `survey_id`, `done_date`) VALUES
(8, 27, '14-06-2018'),
(9, 28, '14-06-2018'),
(10, 31, '14-06-2018'),
(12, 30, '20-06-2018'),
(13, 29, '20-06-2018'),
(14, 32, '24-06-2018');

-- --------------------------------------------------------

--
-- Table structure for table `filled_surveys`
--

CREATE TABLE `filled_surveys` (
  `filled_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `filled_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `q_statement` text,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `q_statement`, `cat_id`) VALUES
(68, 'Did you liked it?', 47),
(69, 'Were you treated well?', 47),
(70, 'Was there any issue?', 47),
(71, 'Are there improvements required?', 47),
(72, 'Was it good enough?', 48),
(73, 'Will you come again?', 48),
(74, 'Will you suggest someone?', 48),
(75, 'Did you liked it?', 50),
(76, 'Were you treated well?', 50),
(77, 'Was there any issue?', 50),
(78, 'Are there any improvements required?', 50),
(79, 'Was it good enough?', 51),
(80, 'Will you come again?', 51),
(81, 'Will you suggest someone?', 51),
(82, 'Did you like it?', 52),
(84, 'Will you come again?', 52),
(85, 'Was the product good?', 53),
(86, 'Are you satisfied?', 53),
(87, 'Did you liked it?', 54),
(88, 'Are you sure about it?', 54),
(89, 'Any suggestions?', 54);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `survey_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `max` int(11) NOT NULL,
  `achieved` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`survey_id`, `cat_id`, `cat_name`, `max`, `achieved`, `cid`, `bid`) VALUES
(27, 47, 'Ambiance', 4, 2, 0, 0),
(27, 48, 'Quality', 3, 2, 0, 0),
(28, 47, 'Ambiance', 4, 3, 0, 0),
(28, 48, 'Quality', 3, 3, 0, 0),
(29, 47, 'Ambiance', 4, 1, 6, 16),
(29, 48, 'Quality', 3, 3, 6, 16),
(30, 50, 'Ambiance', 4, 2, 6, 17),
(30, 51, 'Quality', 3, 3, 6, 17),
(31, 52, 'Ambiance', 2, 1, 8, 21),
(31, 53, 'Product', 2, 0, 8, 21),
(32, 54, 'Ambiance', 3, 1, 9, 22);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `visit_date` varchar(20) NOT NULL,
  `profile` text NOT NULL,
  `visit_time` varchar(20) NOT NULL,
  `time_out` text NOT NULL,
  `total_members` varchar(20) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `cashier_name` varchar(50) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `total_paid` varchar(20) NOT NULL,
  `items_ordered` text NOT NULL,
  `addcom` text NOT NULL,
  `survey_fill_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `cid`, `bid`, `user_id`, `location`, `visit_date`, `profile`, `visit_time`, `time_out`, `total_members`, `member_name`, `cashier_name`, `bill_no`, `total_paid`, `items_ordered`, `addcom`, `survey_fill_date`) VALUES
(27, 6, 16, 4, 'MM Alam', '06/15/2018', '2 Males', '12:53pm', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', '', ''),
(28, 6, 16, 4, 'MM Alam', '06/15/2018', '2 Males', '12:53pm', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', '', ''),
(29, 6, 16, 5, 'DHA', '06/10/2018', '2 Males', '12:00am', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', '', ''),
(30, 6, 17, 4, 'M M Alam', '06/09/2018', '2 Males', '12:53pm', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', '', ''),
(31, 8, 21, 6, 'Phase 4', '06/09/2018', '2 Males', '12:53pm', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', 'Overall good experience', ''),
(32, 9, 22, 4, 'Phase 4', '24-06-2018', '2 Males', '12:53pm', '', '10', 'Ali', 'Ali', '12345678', '1200', 'Bla Bla Bla', '', '24-06-2018');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `usertype`) VALUES
(1, 'Super', 'Admin', 'superadmin@rubbernecks.com', '12344321', 'Super Admin'),
(2, 'User', 'Admin', 'admin@rubbernecks.com', '12345678', 'Admin'),
(4, 'Burhan', 'Maseel', 'burhan@rubbernecks.com', '123', 'User'),
(5, 'Test', 'Person', 'testperson@rubbernecks.com', '123456789', 'User'),
(6, 'Ali', 'Cheema', 'alicheema@rubberneck.com', '123456', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `assigned`
--
ALTER TABLE `assigned`
  ADD PRIMARY KEY (`assigned_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `branch_surverys`
--
ALTER TABLE `branch_surverys`
  ADD KEY `c_id` (`c_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `done_surveys`
--
ALTER TABLE `done_surveys`
  ADD PRIMARY KEY (`done_id`);

--
-- Indexes for table `filled_surveys`
--
ALTER TABLE `filled_surveys`
  ADD PRIMARY KEY (`filled_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `assigned`
--
ALTER TABLE `assigned`
  MODIFY `assigned_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `done_surveys`
--
ALTER TABLE `done_surveys`
  MODIFY `done_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `filled_surveys`
--
ALTER TABLE `filled_surveys`
  MODIFY `filled_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`survey_id`),
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`q_id`);

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`c_id`);

--
-- Constraints for table `branch_surverys`
--
ALTER TABLE `branch_surverys`
  ADD CONSTRAINT `branch_surverys_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `clients` (`c_id`),
  ADD CONSTRAINT `branch_surverys_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `branch` (`b_id`),
  ADD CONSTRAINT `branch_surverys_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
