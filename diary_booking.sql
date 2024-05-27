-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 06:13 PM
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
-- Database: `diary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `diary_booking`
--

CREATE TABLE `diary_booking` (
  `book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_date` date NOT NULL,
  `book_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diary_booking`
--

INSERT INTO `diary_booking` (`book_id`, `name`, `email`, `phone`, `pickup_date`, `return_date`, `book_type`, `created_at`) VALUES
(6, 'Nurul Anis', 'anis2001@gmail.com', '0123456789', '2024-05-27', '2024-06-03', 'fiction', '2024-05-27 16:04:58'),
(8, 'Aqil Hakimi', 'aqil0207@gmail.com', '0234578999', '2024-05-30', '2024-06-05', 'fiction', '2024-05-27 16:06:44'),
(12, 'Arif Najwan', 'afif0309@gmail.com', '0192837645', '2024-05-27', '2024-06-07', 'non_fiction', '2024-05-27 16:01:58'),
(13, 'Nurul Athirah ', 'athirahchan@gmail.com', '0142367895', '2024-05-30', '2024-06-05', 'non_fiction', '2024-05-27 16:09:00'),
(14, 'Intan Fazleena', 'intanfaz@gmail.com', '0179865432', '2024-05-30', '2024-06-07', 'fiction', '2024-05-27 15:42:02'),
(15, 'Husna Solehah', 'unagi02@gmail.com', '0125437896', '2024-05-28', '2024-05-30', 'non_fiction', '2024-05-27 15:44:27'),
(16, 'Syamimi Nasuha', 'misuhaa@gmail.com', '0145623789', '2024-06-01', '2024-06-07', 'non_fiction', '2024-05-27 15:57:55'),
(17, 'Afif Musyrif', 'afif0309@gmail.com', '0234578999', '2024-05-28', '2024-06-08', 'fiction', '2024-05-27 16:06:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diary_booking`
--
ALTER TABLE `diary_booking`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diary_booking`
--
ALTER TABLE `diary_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
