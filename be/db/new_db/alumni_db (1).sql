-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 09:30 PM
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
  `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_token`
--

INSERT INTO `access_token` (`id`, `token`, `user_id`, `ip_address`, `update_date`, `status`) VALUES
(132, 'c2604cee20bb51257dbf5664db7befe3563237b02658ad3c99666692b4e31171', '1', '::1', '2024-09-29 03:48:24', 'U'),
(133, '43726862c3c600660f6a61546922207d8f56710d7e96e346ed412083f4309dc5', '1', '::12323', '2024-09-29 03:53:20', 'U'),
(134, '6c7395f3126169c564a9ebb66f3430d6ae85eb4969525a094d0da97c0ec3cc42', '1', '::13232', '2024-09-29 03:53:23', 'U'),
(135, '66de6df54f6e3baf886778c048ac8923b606c6c33ac169f5e7c98e5c583e59fb', '1', '::1', '2024-09-29 03:53:54', 'U'),
(136, 'a2381caa065abce93f68f909f0d8f495fa2c8f979653754d2554f1b8f4923954', '1', '::1', '2024-09-29 03:54:40', 'U'),
(137, '25ba5288f6e7925b2831bda1b6bb4553980d9fd2f6e4a7e84dc734c4d3308b94', '1', '::1', '2024-09-29 03:55:08', 'U'),
(138, 'b7204e2b784d12b5b8aaa8fa6f53ba74eac32ceec32d9da95d2a2253949f7937', '2', '::1', '2024-09-29 03:56:15', 'U'),
(139, '0b7977444e4b80ef392e13dd9fa8392f973945204fc06c5ff182c4ce2b2e1d0d', '1', '::1', '2024-09-29 04:02:03', 'U'),
(140, '4b6de92e5d276c88815caa4ce3351bff872f6894912edd023be796667ff0397b', '2', '::1', '2024-09-29 04:02:06', 'U'),
(141, '54900a878bab756b0f51678f57a41653f484641bb1553abdcf46b2911f8b0ca9', '2', '::1', '2024-09-29 04:01:44', 'U'),
(142, '2a4d5ec44f7108abf7fb1f51669fe43ff2efd3b144f60aef9b798ddfa445d8c6', '2', '::1', '2024-09-29 04:03:59', 'U'),
(143, '4e1e7ea378eae0a0189ff4c9a4b094a45a7f4d59bafaab7e5044a7f223d0b36d', '1', '::1', '2024-09-29 04:02:56', 'U'),
(144, '2d7d76f3e17e32d2fb98dd9672ca1db75d85e7ae7d1689fc8791262e44ab25cd', '1', '::1', '2024-09-29 04:10:07', 'U'),
(145, '0d52cae9a9b7bdfd08e4e8789e29d34ac54a4bc18ff1904b785216d5104c5f8b', '2', '::1', '2024-09-29 04:14:36', 'U'),
(146, 'c5048eb45a80fb281c5edcb7152f8014ee47214dbd2279a574683b2569cc9411', '1', '::1', '2024-09-29 04:13:36', 'U'),
(147, '33b52f66e4c499a04407dc85a15ac3fda828df34bfcca9eb6ad4340b107a017e', '1', '::1', '2024-09-29 04:14:03', 'U'),
(148, '13d0f9fdfe22cbed23b5b66941ccea35bb35ea47bcbb33aa5121ca8376517f4d', '1', '::1', '2024-09-29 04:15:16', 'U'),
(149, 'e189ad4c653acc5b5de693e59c8604f0aa1fcdf6f8827e077673ef7b0ff22a2a', '2', '::1', '2024-09-29 04:17:26', 'U'),
(150, '65f87bb6811e93b8d54c7c0dfc25020e001c8198683794f064742b066c58f00b', '1', '::1', '2024-09-29 04:16:59', 'U'),
(151, 'a86bea4d84bba39c5ee34a30a6e126d8da60e12362490bccfc1e9d861bb30c80', '1', '::1', '2024-09-29 04:23:38', 'U'),
(152, '463814eac07c7b1a119155e08bee07ef02bffa751c9253ddcffd38f99a149e26', '2', '::1', '2024-09-29 04:47:08', 'U'),
(153, '9d1c9bd38f071cc2265e2d623599c51dc7833b7b68626b1cf8b67c085c78768e', '1', '::1', '2024-09-29 04:23:38', 'U'),
(154, '530e4fed902192cb63498a4d5e50f45c8df0ee4b9046d21dc7a3126bfc294aa4', '1', '::1', '2024-09-29 04:23:38', 'U'),
(155, '63dc6066d5100d1c680c93d7aa4b5e413788ae308d4f5fa9134e865abd750b4d', '1', '::1', '2024-09-29 04:33:16', 'U'),
(156, '03d225daefb54560322fd5d781658d41d8c8282d4074a10bb4f125c67a49806b', '1', '::1', '2024-09-29 04:46:44', 'U'),
(157, '3eb99ce1e54c0335b264f8fd180e139ff06edab7941c1b70c9e90b750b2b2237', '1', '::1', '2024-09-29 04:45:13', 'U'),
(158, 'fd1b04f456dd4169caed542ccd5176e3a523ac845e50dad9fec790e30dd6e6a7', '1', '::1', '2024-09-29 04:45:48', 'U'),
(159, '987bb46d03b047d7d5e9f58b691e5c07c9f7aabf56a8a21c615e324e96e912bf', '1', '::1', '2024-09-29 04:46:54', 'U'),
(160, 'f72b3fa33bd71c79d0f2d6ad8948f2ca68109ab31ef7dd1f8927514c81eab9ae', '1', '::1', '2024-09-29 04:47:13', 'A'),
(161, 'b235f813ef41631081c684ee7ef7a9e3de48a1c684da8c11fc113fdbeb968dfb', '2', '::1', '2024-09-29 04:49:49', 'U'),
(162, 'dca231ad9ced8ec2420f9fd490adb43a0cc070e3e0bd579241c36773ff8eb62a', '2', '::1', '2024-09-29 04:50:51', 'U'),
(163, 'deca362ea49f0157dbe6def859b5091daddaf54ed746cae6d16a15f207b00929', '2', '::1', '2024-09-29 04:45:41', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `advisory_details`
--

CREATE TABLE `advisory_details` (
  `ad_id` int(11) NOT NULL,
  `advisor_id` int(11) NOT NULL DEFAULT 0,
  `student_id` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advisor_records`
--

CREATE TABLE `advisor_records` (
  `advisor_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `prof_id` int(11) NOT NULL DEFAULT 0,
  `sy_id` int(11) NOT NULL DEFAULT 0,
  `course_id` int(11) NOT NULL DEFAULT 0,
  `sect_id` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'A',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor_records`
--

INSERT INTO `advisor_records` (`advisor_id`, `batch_id`, `prof_id`, `sy_id`, `course_id`, `sect_id`, `status`, `date_created`, `last_updated`) VALUES
(1, 1, 17, 1, 4, 1, 'A', '2024-08-29 02:09:49', '2024-09-09 16:41:43'),
(3, 1, 18, 1, 3, 1, 'U', '2024-09-09 21:55:07', '2024-09-09 16:39:53'),
(4, 1, 17, 1, 3, 1, 'A', '2024-09-24 03:31:52', NULL);

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
  `isUse` int(50) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_name`, `isUse`, `date_created`, `last_updated`, `status`) VALUES
(1, 'Batch Matatag 2023', 0, '2024-08-29 02:50:56', '2024-09-09 21:11:33', 'A'),
(3, 'Masipag', 0, '2024-09-24 03:42:12', '2024-09-24 04:11:55', 'A');

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
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `status`, `date_created`, `last_updated`) VALUES
(3, 'BSIT', 'A', '2024-09-01 11:17:35', '2024-09-01 06:01:51'),
(4, 'BSFI', 'A', '2024-09-01 11:19:51', NULL),
(5, 'BSCRIM', 'A', '2024-09-01 11:20:45', NULL);

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
  `num` varchar(100) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT 'A',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `number`
--

INSERT INTO `number` (`num_id`, `num`, `status`, `date_created`, `last_updated`) VALUES
(1, '1', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(2, '2', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(3, '3', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(4, '4', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(5, '5', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(6, '6', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(7, '7', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35'),
(8, '8', 'A', '2024-09-03 11:37:35', '2024-09-03 11:37:35');

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
  `last_updated` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`prof_id`, `name`, `email`, `contact`, `address`, `degree`, `date_created`, `last_updated`, `status`) VALUES
(17, 'Henry Cabell', 'henryCabel@gmail.com', '09484883888', 'Sipalay City, Negros Occidental', 'MIT', '2024-08-19 07:52:42', '2024-09-29 00:46:37', 'A'),
(18, 'Mike Tan', 'miketan@gmail.com', '09388588388', 'sampleAddress', 'MIT', '2024-08-22 20:56:52', '2024-08-22 20:56:52', 'A'),
(19, 'Henry MacArthur', 'henrymacarthur@gmail.com', '09998384883', 'Bacolod City', 'MIT', '2024-08-22 22:24:00', '2024-08-22 20:44:35', 'A'),
(21, 'Kerr Arvin Tabligan', 'kerr@gmail.com', '09992988488', 'Brgy Mambaroto, Sipalay City, Negros Occidental', 'MIT | CSC', '2024-09-01 09:22:37', NULL, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sect_id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL DEFAULT '0',
  `status` char(50) NOT NULL DEFAULT 'A',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sect_id`, `number`, `status`, `date_created`, `last_updated`) VALUES
(1, '1', 'A', '2024-08-24 23:43:43', '2024-08-24 23:43:43'),
(2, '2', 'A', '2024-08-24 23:43:43', '2024-08-24 23:43:43'),
(3, '3', 'A', '2024-08-24 23:43:43', '2024-08-24 23:43:43'),
(4, '4', 'A', '2024-08-24 23:43:43', '2024-08-24 23:43:43'),
(5, '5', 'A', '2024-08-24 23:43:43', '2024-08-24 23:43:43'),
(6, '6', 'A', '2024-08-24 23:43:43', '2024-08-24 23:44:06'),
(7, '7', 'U', '2024-09-03 10:42:00', '2024-09-03 11:40:21'),
(8, '9', 'U', '2024-09-03 10:50:49', '2024-09-03 11:36:24');

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
  `student_status` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `contact`, `batch_id`, `student_status`, `date_created`, `last_updated`) VALUES
(1, 'James Hunter', 'James_hunter@gmail.com', '0399493992', 1, 'A', '2024-08-23 04:43:55', NULL),
(2, 'Crazy Slot', 'Crazy@gmail.com', '0948838883', 1, 'A', '2024-08-23 04:43:55', NULL),
(3, 'tes1', 'testEmail@gmail.com', '09388388883', 1, 'A', '2024-08-23 04:43:55', NULL),
(4, 'test 5', 'test5@gmail.com', '09388853444', 1, 'U', '2024-08-23 04:43:55', '2024-08-24 23:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `sy_id` int(11) NOT NULL,
  `sy_name` varchar(50) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sy`
--

INSERT INTO `sy` (`sy_id`, `sy_name`, `date_created`, `last_updated`, `status`) VALUES
(1, '2022-2023', '2024-08-24 23:47:06', '2024-08-24 23:47:06', 'A'),
(2, '2023-2024', '2024-09-03 12:03:59', '2024-09-03 12:03:59', 'A'),
(3, '2024-2025', '2024-09-03 12:05:39', '2024-09-03 12:32:47', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT 'A',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `avatar` varchar(100) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_date` datetime DEFAULT NULL,
  `last_logout_date` datetime DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `status`, `type`, `avatar`, `date_created`, `last_login_date`, `last_logout_date`, `last_updated`) VALUES
(1, 'Ryan Wong', 'ryanwong@gmail.com', '$2y$10$JUbVctsIHEaSV.zYc6LsPuxRGvjnt25PgKB.o9un8WnuZL4oduvOe', 'A', '1', 'asdadasd', '2024-07-20 16:49:26', '2024-09-29 04:46:54', '2024-09-29 04:41:58', '2024-09-29 04:46:54'),
(2, 'James Henry', 'james@gmail.com', '$2y$10$DNSiohSIu02kNGm97LlEJ.vhgrdQsscfga9ksA4DEhpIJayrANouq', 'A', '1', 'qwer', '2024-08-20 23:57:42', '2024-09-29 04:50:51', '2024-09-29 04:50:37', '2024-09-29 04:50:51');

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
  `email` varchar(50) NOT NULL,
  `date_log_in` datetime NOT NULL DEFAULT current_timestamp(),
  `date_logout` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`log_id`, `user_id`, `email`, `date_log_in`, `date_logout`) VALUES
(17, 1, 'ryanwong@gmail.com', '2024-09-29 03:40:33', NULL),
(18, 1, 'ryanwong@gmail.com', '2024-09-29 03:48:24', NULL),
(19, 1, 'ryanwong@gmail.com', '2024-09-29 03:48:47', NULL),
(20, 1, 'ryanwong@gmail.com', '2024-09-29 03:53:34', NULL),
(21, 1, 'ryanwong@gmail.com', '2024-09-29 03:53:54', NULL),
(22, 1, 'ryanwong@gmail.com', '2024-09-29 03:54:40', NULL),
(23, 2, 'james@gmail.com', '2024-09-29 03:55:08', NULL),
(24, 1, 'ryanwong@gmail.com', '2024-09-29 03:56:15', NULL),
(25, 2, 'james@gmail.com', '2024-09-29 03:58:39', NULL),
(26, 2, 'james@gmail.com', '2024-09-29 03:59:18', NULL),
(27, 2, 'james@gmail.com', '2024-09-29 04:02:19', NULL),
(28, 1, 'ryanwong@gmail.com', '2024-09-29 04:02:29', NULL),
(29, 1, 'ryanwong@gmail.com', '2024-09-29 04:02:56', NULL),
(30, 2, 'james@gmail.com', '2024-09-29 04:03:59', NULL),
(31, 1, 'ryanwong@gmail.com', '2024-09-29 04:10:07', NULL),
(32, 1, 'ryanwong@gmail.com', '2024-09-29 04:13:36', NULL),
(33, 1, 'ryanwong@gmail.com', '2024-09-29 04:14:03', NULL),
(34, 2, 'james@gmail.com', '2024-09-29 04:14:36', NULL),
(35, 1, 'ryanwong@gmail.com', '2024-09-29 04:15:16', NULL),
(36, 1, 'ryanwong@gmail.com', '2024-09-29 04:16:59', NULL),
(37, 2, 'james@gmail.com', '2024-09-29 04:17:26', NULL),
(38, 1, 'ryanwong@gmail.com', '2024-09-29 04:23:01', NULL),
(39, 1, 'ryanwong@gmail.com', '2024-09-29 04:23:19', NULL),
(40, 1, 'ryanwong@gmail.com', '2024-09-29 04:23:38', NULL),
(41, 1, 'ryanwong@gmail.com', '2024-09-29 04:33:16', NULL),
(42, 1, 'ryanwong@gmail.com', '2024-09-29 04:45:13', NULL),
(43, 1, 'ryanwong@gmail.com', '2024-09-29 04:45:48', NULL),
(44, 1, 'ryanwong@gmail.com', '2024-09-29 04:46:44', NULL),
(45, 1, 'ryanwong@gmail.com', '2024-09-29 04:46:54', NULL),
(46, 2, 'james@gmail.com', '2024-09-29 04:47:08', NULL),
(47, 2, 'james@gmail.com', '2024-09-29 04:49:49', NULL),
(48, 2, 'james@gmail.com', '2024-09-29 04:50:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisory_details`
--
ALTER TABLE `advisory_details`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `advisor_id` (`advisor_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `advisor_records`
--
ALTER TABLE `advisor_records`
  ADD PRIMARY KEY (`advisor_id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `sy_id` (`sy_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `sect_id` (`sect_id`),
  ADD KEY `batch_name` (`batch_id`);

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
  ADD PRIMARY KEY (`batch_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `advisory_details`
--
ALTER TABLE `advisory_details`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advisor_records`
--
ALTER TABLE `advisor_records`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `capabilities`
--
ALTER TABLE `capabilities`
  MODIFY `cap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sy`
--
ALTER TABLE `sy`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
