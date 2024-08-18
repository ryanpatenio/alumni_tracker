-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 10:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT '0',
  `user_id` varchar(255) NOT NULL DEFAULT '0',
  `ip_address` varchar(255) NOT NULL DEFAULT '0',
  `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_token`
--

INSERT INTO `access_token` (`id`, `token`, `user_id`, `ip_address`, `update_date`) VALUES
(47, 'e60af1879640c38650aa31849fa908044ddcaa314d956bae88e4651c6fdad42e', '1', '::1', '2024-07-24 05:32:40'),
(48, 'c031bd0ad72efdc71919c1925c4d8d153774411470905642ac8edc8d2218441f', '1', '::1', '2024-07-24 05:32:40'),
(49, '57084a81d67c6e1bfd5bf0605520ab7151ed491d1eafa50765cb1397718f2e2c', '1', '::1', '2024-07-24 05:32:40'),
(50, '14114cf220bf1358c55422db806c668e8b1d23d5fb78a9aed78ef9be8533a702', '1', '::1', '2024-07-24 05:32:40'),
(51, '8c47ca6aa319f319bb012f8b43c6d3c160b59125875ae1893c44757bc43692b1', '1', '::1', '2024-07-24 05:32:40'),
(52, '44e84157b5530bac7e48a5796845a60ff385899619f45e4eaf2bfb3dd9e18cd5', '1', '::1', '2024-07-24 05:32:40'),
(53, '2d211466cd99afa9a8baf36480d2b25dfee46332ceba7930d1f2972b3926d975', '1', '::1', '2024-07-24 05:32:40'),
(54, '8becc4555123723ffb9b2eb510b5759ee0fdde1bb3c3ebaf5a7cfafe0da357dc', '1', '::1', '2024-07-24 05:32:40'),
(55, '4a9ceae42c6d440c89a96fdff1a1405d2cb47530322996554e83eb6fce2465f5', '1', '::1', '2024-07-24 05:32:40'),
(56, '4725f659f60adef4052d53a76886dd6427bfc1113ce07f50cc6a147ed78f6cac', '1', '::1', '2024-07-24 05:38:14'),
(57, '19734215b047fe252e160d213e51a5dbff5f1580f2146f580172307e86d678c1', '1', '::1', '2024-07-24 05:38:59'),
(58, '2bcd5ca726664f0637aca12387c7cf8917b48dc66737b12f1a0e2c30f99ceb6d', '1', '::1', '2024-08-13 21:39:55'),
(59, 'd4153747a2ce7aa4fbcbe97c286c3c9396eb0243a3eb0840ed19b7f7b78d824d', '1', '::1', '2024-08-19 03:39:02'),
(60, '57a5389a992a8dd4880f87f0c0da4c7c7ce37432023410a94cfbc543652a4d5e', '1', '::1', '2024-08-19 03:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `advisor_records`
--

CREATE TABLE `advisor_records` (
  `advisor_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL DEFAULT 0,
  `sy_id` int(11) NOT NULL DEFAULT 0,
  `course_id` int(11) NOT NULL DEFAULT 0,
  `sect_id` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alumni_sessions`
--

CREATE TABLE `alumni_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_name` varchar(100) NOT NULL DEFAULT '0',
  `adviser_id` int(11) NOT NULL DEFAULT 0,
  `student_id` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
  `cap_id` int(11) NOT NULL,
  `cap` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`cap_id`, `cap`) VALUES
(1, 'add'),
(2, 'edit'),
(3, 'update'),
(4, 'delete'),
(5, 'view');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_codes`
--

CREATE TABLE `error_codes` (
  `id` int(11) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `code` char(4) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `error_codes`
--

INSERT INTO `error_codes` (`id`, `controller`, `code`, `message`) VALUES
(1, '', '0002', 'Post Data Null'),
(2, '', '0001', 'User Not Found');

-- --------------------------------------------------------

--
-- Table structure for table `number`
--

CREATE TABLE `number` (
  `num_id` int(11) NOT NULL,
  `num` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `number`
--

INSERT INTO `number` (`num_id`, `num`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `prof_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `contact` varchar(100) NOT NULL DEFAULT '0',
  `address` varchar(100) NOT NULL DEFAULT '0',
  `degree` varchar(100) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sect_id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sect_id`, `number`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `contact` varchar(100) NOT NULL DEFAULT '0',
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `student_status` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `contact`, `batch_id`, `student_status`) VALUES
(1, 'James Hunter', 'James_hunter@gmail.com', '0399493992', 1, 'A'),
(2, 'Crazy Slot', 'Crazy@gmail.com', '0948838883', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `sy_id` int(11) NOT NULL,
  `sy_name` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_logout_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `status`, `type`, `date_created`, `last_login_date`, `last_logout_date`) VALUES
(1, 'Ryan Wong', 'ryanwong@gmail.com', '$2y$10$iCH3cS5XxaeUDQb9Q6uXBuccQdCP8/Oc.wGwDFSFdqPz26U76/1de', 'A', '1', '2024-07-20 16:49:26', '2024-08-19 03:40:13', '2024-08-19 03:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `u_a_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `activity` varchar(100) NOT NULL DEFAULT '0',
  `target` varchar(100) NOT NULL DEFAULT '0',
  `do_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_capabilities`
--

CREATE TABLE `user_capabilities` (
  `id` int(11) NOT NULL,
  `capabilities_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_capabilities`
--

INSERT INTO `user_capabilities` (`id`, `capabilities_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_log_in` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisor_records`
--
ALTER TABLE `advisor_records`
  ADD PRIMARY KEY (`advisor_id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `sy_id` (`sy_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `sect_id` (`sect_id`);

--
-- Indexes for table `alumni_sessions`
--
ALTER TABLE `alumni_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `adviser_id` (`adviser_id`);

--
-- Indexes for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD PRIMARY KEY (`cap_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `error_codes`
--
ALTER TABLE `error_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `number`
--
ALTER TABLE `number`
  ADD PRIMARY KEY (`num_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sect_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `sy_id` (`batch_id`);

--
-- Indexes for table `sy`
--
ALTER TABLE `sy`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`u_a_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_capabilities`
--
ALTER TABLE `user_capabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `capabilities_id` (`capabilities_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `advisor_records`
--
ALTER TABLE `advisor_records`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `capabilities`
--
ALTER TABLE `capabilities`
  MODIFY `cap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_codes`
--
ALTER TABLE `error_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `number`
--
ALTER TABLE `number`
  MODIFY `num_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sy`
--
ALTER TABLE `sy`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `u_a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_capabilities`
--
ALTER TABLE `user_capabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
