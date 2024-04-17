-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 03:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_bin`
--

CREATE TABLE `data_bin` (
  `reading_bin` int(15) NOT NULL,
  `date_bin1` varchar(255) NOT NULL,
  `time_bin1` varchar(255) NOT NULL,
  `trash_bin1` varchar(255) NOT NULL,
  `status_bin1` varchar(255) NOT NULL,
  `date_bin2` varchar(255) NOT NULL,
  `time_bin2` varchar(255) NOT NULL,
  `trash_bin2` varchar(255) NOT NULL,
  `status_bin2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_bin`
--

INSERT INTO `data_bin` (`reading_bin`, `date_bin1`, `time_bin1`, `trash_bin1`, `status_bin1`, `date_bin2`, `time_bin2`, `trash_bin2`, `status_bin2`) VALUES
(1, 'June 8, 2023', '8:00 AM', '50 cm', 'Full', 'June 8, 2023', '8:00 AM', '35 cm', 'Half_full');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_trial`
--

CREATE TABLE `thesis_trial` (
  `id` int(12) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thesis_trial`
--

INSERT INTO `thesis_trial` (`id`, `email_address`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin@gmail.com', 'admin123', 'admin', 'admin lassalle'),
(2, 'admin123@gmail.com', 'admin123', 'admin co', 'admin gihapon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_bin`
--
ALTER TABLE `data_bin`
  ADD PRIMARY KEY (`reading_bin`);

--
-- Indexes for table `thesis_trial`
--
ALTER TABLE `thesis_trial`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_bin`
--
ALTER TABLE `data_bin`
  MODIFY `reading_bin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thesis_trial`
--
ALTER TABLE `thesis_trial`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
