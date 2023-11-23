-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 09:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `address` varchar(64) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `profilepic_name` varchar(144) DEFAULT NULL,
  `ckid` varchar(146) DEFAULT NULL,
  `otp` varchar(8) DEFAULT NULL,
  `remember` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`, `email`, `fullname`, `address`, `nid`, `gender`, `phone`, `dob`, `profilepic_name`, `ckid`, `otp`, `remember`, `active`) VALUES
('abc', '1', 'mshahriar40@gmail.com', 'Shahriar Mahmud', 'Uttara, Sector-7, Road-27, House-12, Flat-5B', '12', 'male', '01778611151', '2023-04-11', 'abc-IMG-6429a02f32a3e8.34920065.jpg', 'abc=-342d29c0af10a0ad6b053ede47c5e7baf922803bc100aa7ae8a25e3dffe0fb67d3b0950aef9d6bcdc19485e3c6aecc2ac133bfb3418523ef4cd5cf83d444d468', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customertb`
--

CREATE TABLE `customertb` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT 'demo name',
  `email` varchar(120) NOT NULL DEFAULT 'demo email',
  `revenue` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customertb`
--

INSERT INTO `customertb` (`id`, `name`, `email`, `revenue`) VALUES
(1, 'demo name', 'demo email', 240),
(2, 'demo name', 'demo email', 552),
(3, 'demo name', 'demo email', 160),
(4, 'demo name', 'demo email', 120),
(5, 'demo name', 'demo email', 500),
(6, 'demo name', 'demo email', 50);

-- --------------------------------------------------------

--
-- Table structure for table `employeetb`
--

CREATE TABLE `employeetb` (
  `username` varchar(16) NOT NULL,
  `fullname` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(264) NOT NULL,
  `address` varchar(32) DEFAULT NULL,
  `nid` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `dob` varchar(12) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `profilepic_name` varchar(100) NOT NULL DEFAULT 'demo_pic.png',
  `performance` int(11) DEFAULT NULL,
  `approval` tinyint(1) NOT NULL DEFAULT 0,
  `otp` varchar(8) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeetb`
--

INSERT INTO `employeetb` (`username`, `fullname`, `password`, `email`, `address`, `nid`, `gender`, `dob`, `phone`, `attendance`, `profilepic_name`, `performance`, `approval`, `otp`, `verified`) VALUES
('abc', '11212', '1541', 'asdasd', NULL, NULL, NULL, NULL, NULL, 26, 'demo_pic.png', 8, 0, NULL, 1),
('ad', '11212', 'as54d5as', 'sadsad', 'asddasdsadas sad ', '0124599645', 'male', '2/2/2023', '0123456789', 28, 'demo_pic.png', 9, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ownerauthtb`
--

CREATE TABLE `ownerauthtb` (
  `sn` int(2) NOT NULL,
  `accesskey` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ownerauthtb`
--

INSERT INTO `ownerauthtb` (`sn`, `accesskey`) VALUES
(1, '12');

-- --------------------------------------------------------

--
-- Table structure for table `producttb`
--

CREATE TABLE `producttb` (
  `id` int(11) NOT NULL,
  `pd_info` varchar(32) NOT NULL DEFAULT 'demo product',
  `actualprice` int(11) NOT NULL DEFAULT 0,
  `sellingPrice` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttb`
--

INSERT INTO `producttb` (`id`, `pd_info`, `actualprice`, `sellingPrice`, `stock`, `sold`) VALUES
(1, 'demo product', 100, 130, 75, 15),
(2, 'demo product', 150, 200, 19, 140);

-- --------------------------------------------------------

--
-- Table structure for table `salarysheettb`
--

CREATE TABLE `salarysheettb` (
  `username` varchar(16) NOT NULL,
  `salary` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salarysheettb`
--

INSERT INTO `salarysheettb` (`username`, `salary`) VALUES
('abc', 12000),
('huhuj', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tasktb`
--

CREATE TABLE `tasktb` (
  `sn` int(11) NOT NULL,
  `task` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasktb`
--

INSERT INTO `tasktb` (`sn`, `task`, `time`) VALUES
(17, 'task 1', '2023-03-12 22:02:41'),
(19, 'task 789', '2023-03-12 22:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `totalsalestb`
--

CREATE TABLE `totalsalestb` (
  `sn` int(11) NOT NULL DEFAULT 1,
  `total_sales_amount` int(11) NOT NULL DEFAULT 0,
  `totalActualSalesAmount` int(11) NOT NULL DEFAULT 0,
  `infoDuration` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `totalsalestb`
--

INSERT INTO `totalsalestb` (`sn`, `total_sales_amount`, `totalActualSalesAmount`, `infoDuration`) VALUES
(1, 27000, 20000, 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `profilepic_name` (`profilepic_name`);

--
-- Indexes for table `customertb`
--
ALTER TABLE `customertb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeetb`
--
ALTER TABLE `employeetb`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `ownerauthtb`
--
ALTER TABLE `ownerauthtb`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `producttb`
--
ALTER TABLE `producttb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salarysheettb`
--
ALTER TABLE `salarysheettb`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tasktb`
--
ALTER TABLE `tasktb`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `totalsalestb`
--
ALTER TABLE `totalsalestb`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customertb`
--
ALTER TABLE `customertb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ownerauthtb`
--
ALTER TABLE `ownerauthtb`
  MODIFY `sn` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `producttb`
--
ALTER TABLE `producttb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasktb`
--
ALTER TABLE `tasktb`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
