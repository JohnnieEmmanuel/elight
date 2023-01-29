-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 02:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebill`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `first_name`, `last_name`, `email`, `password`, `date_reg`) VALUES
(1, 'test', 'tester', 'test@admin.com', 'test123', '2022-11-12 23:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `activation_code` varchar(20) NOT NULL,
  `meter_no` text NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `unit_purchased` int(10) NOT NULL,
  `charge` float NOT NULL,
  `unit_amount` float NOT NULL,
  `date_purchased` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL,
  `year` year(4) NOT NULL,
  `month` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `users_id`, `reference`, `activation_code`, `meter_no`, `user_email`, `unit_purchased`, `charge`, `unit_amount`, `date_purchased`, `status`, `year`, `month`) VALUES
(1, 1, 'T540896143660116', '2956973593324', '657298271001', 'jusen@gmail.com', 24, 16.5, 1100, '2022-12-15 10:34:00', 'success', 2022, 'Dec'),
(2, 1, 'T319951642952316', '681040175170', '657298271001', 'jusen@gmail.com', 0, 0.15, 10, '2023-01-14 09:39:46', 'success', 2023, 'Jan');

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE `meters` (
  `id` int(11) NOT NULL,
  `meter` varchar(12) NOT NULL,
  `tariff_plan` varchar(2) NOT NULL,
  `assigned` varchar(3) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meters`
--

INSERT INTO `meters` (`id`, `meter`, `tariff_plan`, `assigned`) VALUES
(1, '657298271001', 'd2', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `meter_number` text NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `verified_user` int(1) NOT NULL DEFAULT 0,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `meter_number`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `password`, `verified_user`, `date_reg`) VALUES
(1, '657298271001', 'Joshua', 'Usen', 'jusen@gmail.com', '07010005500', '1 UGBOMRO, WARRI, DELTA STATE', 'usen123', 0, '2022-11-20 15:53:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meter_number` (`meter_number`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
