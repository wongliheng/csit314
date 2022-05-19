-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 06:23 PM
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
-- Database: `csit314`
--

-- --------------------------------------------------------

--
-- Table structure for table `couponcode`
--

CREATE TABLE `couponcode` (
  `code` varchar(20) NOT NULL,
  `discount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `couponcode`
--

INSERT INTO `couponcode` (`code`, `discount`) VALUES
('discount1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `name` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`name`, `price`, `description`, `image`) VALUES
('100Plus', '2.00', 'A can of 100Plus', '100plus.jpeg'),
('Coke', '3.00', 'A can of coke', 'coke.jpeg'),
('Pepsi', '2.50', 'A can of Pepsi', 'pepsi.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderNo` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `ccNo` varchar(16) NOT NULL,
  `orderDetails` varchar(255) NOT NULL,
  `cost` decimal(5,2) NOT NULL,
  `startTime` varchar(20) NOT NULL,
  `endTime` varchar(20) NOT NULL,
  `tableCode` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderNo`, `name`, `ccNo`, `orderDetails`, `cost`, `startTime`, `endTime`, `tableCode`, `status`) VALUES
(3, 'lh', '1234567891234567', '{\"Coke\":\"1\",\"100Plus\":\"1\",\"Pepsi\":\"1\"}', '7.50', '2022-05-19 22:42', '2022-05-19 22:50', 'table1', 'preparing'),
(5, 'lh', '1234567891234567', '{\"100Plus\":\"1\"}', '2.00', '2022-05-19 22:58', '2022-05-19 22:58', 'table1', 'preparing'),
(6, 'lh', '1234567891234567', '{\"100Plus\":\"1\",\"Coke\":\"1\"}', '5.00', '2022-05-19 22:58', '2022-05-19 23:05', 'table1', 'preparing'),
(7, 'lh', '1234567891234567', '{\"100Plus\":\"1\",\"Coke\":\"1\"}', '4.75', '2022-05-20 00:14', '2022-05-20 00:16', 'table1', 'preparing');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`name`) VALUES
('admin'),
('manager'),
('owner'),
('staff');

-- --------------------------------------------------------

--
-- Table structure for table `tablecode`
--

CREATE TABLE `tablecode` (
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tablecode`
--

INSERT INTO `tablecode` (`code`) VALUES
('table1'),
('table2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `profile`, `name`, `email`, `address`, `status`) VALUES
('staff', 'staff1234', 'staff', 'staff', 'staff@email.com', 'restaurant street', 'active'),
('userAdmin', 'userAdminPw', 'admin', 'userAdmin1', 'userAdmin@restaurant.com', 'Restaurant Address', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couponcode`
--
ALTER TABLE `couponcode`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderNo`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `tablecode`
--
ALTER TABLE `tablecode`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
