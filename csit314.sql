-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2022 at 09:47 AM
-- Server version: 10.4.21-MariaDB
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
('fsodnfoas', 'wqelrknqwelrn', 'owner', 'gnsldkngas', 'fj2@gmasdk.cosn', 'fasdfkasf', 'active'),
('gasdklgn', 'wlnqkerwe', 'staff', 'aslfdknlsdfn', 'LKN@NKfdls.sf', 'fsdafasg', 'active'),
('sadt', 'wkenrlqwkernqwer', 'staff', 'faskdlfm', 'mwer@gmail.com', 'radsfasdf', 'active'),
('sfakmsdfr', 'werqwerwqr', 'staff', 'afsdfasdf', 'gij@mgksm.com', 'fdsakfnaes', 'active'),
('staff', 'staff1', 'owner', 'staff one', 'staff@restaurant.com', 'restaurant address', 'active'),
('staff2', '12345785123', 'staff', 'fsdkf', 'h2@gmail.edo', 'fsadfasf', 'active'),
('user', 'fasdkfmwqr', 'owner', 'fasdkmf', 'rmewlrq@fakmsf.com', 'asknfsdf', 'active'),
('userAdmin', 'userAdminPw', 'admin', 'userAdmin1f', 'userAdmin@restaurant.com', 'Restaurant Address', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
