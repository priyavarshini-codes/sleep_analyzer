-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Feb 17, 2026 at 04:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sleep_analyzer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'admin',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `role`, `password`, `created_at`) VALUES
(9, 'admin', 'admin@gmail.com', 'admin', 'admin123', '2025-12-26 14:29:44'),
(10, 'Sleep Admin', 'sleepadmin@gmail.com', 'admin', 'admin@123', '2026-02-17 13:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `input_type` varchar(50) NOT NULL,
  `options` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `input_type`, `options`) VALUES
(1, 'What time do you usually go to bed?', 'time', NULL),
(2, 'What time do you usually wake up?', 'time', NULL),
(3, 'How many minutes does it take you to fall asleep?', 'number', NULL),
(4, 'How many times do you wake up at night?', 'number', NULL),
(5, 'How many hours do you sleep on average?', 'number', NULL),
(6, 'How would you rate your overall sleep quality?', 'rating', '1,2,3,4,5'),
(7, 'Do you feel stressed before going to bed?', 'yesno', '0,1'),
(8, 'Do you use your phone or screen in bed?', 'yesno', '0,1'),
(9, 'Do you consume caffeine after 6 PM?', 'yesno', '0,1'),
(10, 'Do you have nightmares frequently?', 'yesno', '0,1');

-- --------------------------------------------------------

--
-- Table structure for table `sleep_assessments`
--

CREATE TABLE `sleep_assessments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sleep_time` time NOT NULL,
  `wake_time` time NOT NULL,
  `time_to_sleep` int(11) NOT NULL,
  `interruptions` int(11) NOT NULL,
  `sleep_quality` int(11) NOT NULL,
  `stress_level` int(11) NOT NULL,
  `dream_quality` varchar(50) NOT NULL,
  `date_taken` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sleep_assessments`
--

INSERT INTO `sleep_assessments` (`id`, `user_id`, `sleep_time`, `wake_time`, `time_to_sleep`, `interruptions`, `sleep_quality`, `stress_level`, `dream_quality`, `date_taken`, `created_at`) VALUES
(1, 1, '20:30:00', '04:30:00', 15, 1, 4, 3, '3', '2025-12-17 00:00:00', '2025-12-17 23:38:34'),
(2, 2, '21:30:00', '05:30:00', 15, 2, 5, 2, '3', '2025-12-17 00:00:00', '2025-12-17 23:38:34'),
(3, 3, '22:30:00', '06:30:00', 15, 3, 5, 4, '4', '2025-12-17 00:00:00', '2025-12-17 23:38:34'),
(4, 4, '23:30:00', '07:30:00', 15, 2, 4, 3, '4', '2025-12-17 00:00:00', '2025-12-17 23:38:34'),
(5, 1, '15:39:00', '16:40:00', 15, 3, 1, 0, '0', '2025-12-28 00:00:00', '2025-12-28 15:40:18'),
(6, 9, '23:52:00', '23:52:00', 18, 3, 2, 0, '0', '2025-12-28 00:00:00', '2025-12-28 20:52:36'),
(7, 9, '23:52:00', '23:52:00', 18, 3, 2, 0, '0', '2025-12-28 00:00:00', '2025-12-28 20:56:27'),
(8, 9, '23:52:00', '23:52:00', 18, 3, 2, 0, '0', '2025-12-28 00:00:00', '2025-12-28 20:59:09'),
(9, 9, '23:52:00', '23:52:00', 18, 3, 2, 0, '0', '2025-12-28 00:00:00', '2025-12-28 20:59:12'),
(10, 9, '00:13:00', '23:11:00', 22, 8, 1, 1, '1', '2025-12-29 00:00:00', '2025-12-29 23:12:14'),
(11, 4, '00:37:00', '23:37:00', 7, 6, 1, 1, '1', '2026-01-01 00:00:00', '2026-01-01 19:38:18'),
(12, 1, '16:31:00', '16:28:00', 5, 8, 2, 1, '1', '2026-02-17 00:00:00', '2026-02-17 16:24:38'),
(13, 8, '22:30:00', '18:30:00', 15, 1, 4, 0, '0', '2026-02-17 00:00:00', '2026-02-17 18:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `sleep_results`
--

CREATE TABLE `sleep_results` (
  `user_id` int(11) NOT NULL,
  `sleep_score` int(11) NOT NULL,
  `sleep_quality` varchar(20) NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sleep_results`
--

INSERT INTO `sleep_results` (`user_id`, `sleep_score`, `sleep_quality`, `recommendation`, `created_at`) VALUES
(1, 78, 'Fair', 'Sleep earlier', '2025-12-26 18:57:46'),
(2, 72, 'Fair', 'Try to reduce screen time before bed', '2025-12-26 18:57:46'),
(3, 60, 'Poor', 'Increase sleep duration and avoid caffeine at night', '2025-12-26 18:57:46'),
(4, 92, 'Excellent', 'Great job! Keep maintaining your routine', '2025-12-26 18:57:46'),
(9, 40, '2', 'Poor sleep, improve habits', '2025-12-28 20:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`) VALUES
(1, 'Priya', 'priya@gmail.com', 'user', 'priya123', '2025-12-23 16:21:37'),
(2, 'John Doe', 'john@gmail.com', 'user', 'john123', '2025-12-23 16:21:37'),
(3, 'Jane Smith', 'jane@gmail.com', 'user', 'jane123', '2025-12-23 16:21:37'),
(4, 'Alice', 'alice@gmail.com', 'user', 'alice123', '2025-12-23 16:21:37'),
(6, 'bob', 'bob@gmail.com', 'user', 'bob123', '2025-12-23 17:06:03'),
(7, 'darick', 'darick@gmail.com', 'user', 'darick123', '2026-02-17 12:38:07'),
(8, 'Test User', 'testuser@gmail.com', 'user', 'testuser@123', '2026-02-17 12:42:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sleep_assessments`
--
ALTER TABLE `sleep_assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sleep_results`
--
ALTER TABLE `sleep_results`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sleep_assessments`
--
ALTER TABLE `sleep_assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
