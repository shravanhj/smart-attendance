-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 05:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_history`
--

CREATE TABLE `attendance_history` (
  `attendance_id` int(7) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `batch` int(2) NOT NULL,
  `captured_by` varchar(20) NOT NULL,
  `semester` int(3) NOT NULL,
  `student_reg_no` varchar(15) NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Not Confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ongoing_attendance`
--

CREATE TABLE `ongoing_attendance` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `capturing_by` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `batch` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_admin`
--

CREATE TABLE `staff_admin` (
  `unique_id` int(5) NOT NULL,
  `role` varchar(6) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile_no` bigint(15) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `temp_password` varchar(7) NOT NULL,
  `fingerprint_template` varchar(500) NOT NULL,
  `account_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `unique_id` int(4) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `mobile_no` bigint(10) DEFAULT NULL,
  `current_semester` int(2) DEFAULT NULL,
  `fingerprint_template` longtext NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `temp_password` varchar(7) DEFAULT NULL,
  `account_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(3) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `semester` varchar(4) NOT NULL,
  `added_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `ongoing_attendance`
--
ALTER TABLE `ongoing_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_admin`
--
ALTER TABLE `staff_admin`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_history`
--
ALTER TABLE `attendance_history`
  MODIFY `attendance_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ongoing_attendance`
--
ALTER TABLE `ongoing_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_admin`
--
ALTER TABLE `staff_admin`
  MODIFY `unique_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `unique_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
