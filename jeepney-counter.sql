-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 05:00 PM
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
-- Database: `jeepney-counter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `jeepney-counter`
--

CREATE TABLE `jeepney-counter` (
  `jeepney_id` int(100) NOT NULL,
  `jeepney_name` varchar(100) NOT NULL,
  `jeepney_counter` int(100) NOT NULL,
  `terminal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeepney-counter`
--

INSERT INTO `jeepney-counter` (`jeepney_id`, `jeepney_name`, `jeepney_counter`, `terminal`) VALUES
(28, 'DAU TO MARQUEE', 0, 'MBLCT'),
(29, 'ASTRO TO XEVERA', 0, 'MBLCT'),
(30, 'ASTRO TO ANGELES', 0, 'MBLCT'),
(31, 'MARQUEE TO DAU', 0, 'MARQUEE'),
(32, 'MARQUEE TO MAGALANG', 0, 'MARQUEE'),
(33, 'MARQUEE TO ANGLES', 0, 'MARQUEE'),
(35, 'MARQUEE TO ANGELES', 0, 'MARQUEE');

-- --------------------------------------------------------

--
-- Table structure for table `jeepney-info`
--

CREATE TABLE `jeepney-info` (
  `id` int(100) NOT NULL,
  `jeepney_name` varchar(100) NOT NULL,
  `jeepney_color` varchar(100) NOT NULL,
  `jeepney_seats` int(100) NOT NULL,
  `file_route` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeepney-info`
--

INSERT INTO `jeepney-info` (`id`, `jeepney_name`, `jeepney_color`, `jeepney_seats`, `file_route`) VALUES
(62, 'DAU TO MARQUEE', '#c99797', 30, '../map/marquee.html'),
(63, 'ASTRO TO XEVERA', '#c4a4d5', 16, '../map/xevera.html'),
(64, 'ASTRO TO ANGELES', '#5900ff', 14, '../map/astro.html'),
(65, 'MARQUEE TO DAU', '#615c6a', 32, '../map/dau.html'),
(66, 'MARQUEE TO MAGALANG', '#bfc83c', 18, '../map/magalang.html'),
(67, 'MARQUEE TO ANGELES', '#0068f0', 20, '../map/angeles.html');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeepney-counter`
--
ALTER TABLE `jeepney-counter`
  ADD PRIMARY KEY (`jeepney_id`);

--
-- Indexes for table `jeepney-info`
--
ALTER TABLE `jeepney-info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeepney-counter`
--
ALTER TABLE `jeepney-counter`
  MODIFY `jeepney_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jeepney-info`
--
ALTER TABLE `jeepney-info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
