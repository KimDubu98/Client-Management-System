-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 05:20 PM
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
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `myusername` varchar(255) NOT NULL,
  `mypassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`myusername`, `mypassword`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auditfees`
--

CREATE TABLE `auditfees` (
  `id` int(11) NOT NULL,
  `companyId` varchar(255) NOT NULL,
  `staffId` int(255) NOT NULL,
  `feesRate` int(255) NOT NULL,
  `timeTaken` int(11) NOT NULL,
  `timeAdd` int(255) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditfees`
--

INSERT INTO `auditfees` (`id`, `companyId`, `staffId`, `feesRate`, `timeTaken`, `timeAdd`, `fees`) VALUES
(1, '123456', 590, 50, 39, 5, 1950),
(2, '897', 632, 50, 12, 4, 600);

--
-- Triggers `auditfees`
--
DELIMITER $$
CREATE TRIGGER `after_timeAdd_update` BEFORE UPDATE ON `auditfees` FOR EACH ROW SET NEW.fees = (NEW.timeTaken * OLD.feesRate)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_timeAdd_update` BEFORE UPDATE ON `auditfees` FOR EACH ROW SET NEW.timeTaken = (NEW.timeAdd + OLD.timeTaken)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `companyId` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `companyAddress` varchar(255) NOT NULL,
  `companyEmail` varchar(255) NOT NULL,
  `companyPhone` int(12) NOT NULL,
  `staffId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`companyId`, `companyName`, `companyAddress`, `companyEmail`, `companyPhone`, `staffId`) VALUES
('123456', 'kentucky fried chicken (kfc)', 'kuala lumpur', 'kfc@gmail.com', 3373722, 493),
('2551', 'safreen', 'axis residence', 'safreen@gmail.com', 8998, 493),
('36363', 'subway', 'axis residence', 'subway@gmail.com', 858648, 590),
('7464', 'Lacoste', 'Bukit Bintang, Kuala Lumpur', 'lacoste@gmail.com', 36377474, 0),
('789', 'mcd', 'kuala lumpur', 'mcd@gmail.com', 4744884, 590),
('7890', 'porsche', 'pandan indah', 'por@gmail.com', 47737, 0),
('897', 'marrybrown', 'pahang', 'marrybrown@gmail.com', 9847832, 0);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `docId` int(255) NOT NULL,
  `docTitle` varchar(255) NOT NULL,
  `companyId` varchar(255) NOT NULL,
  `dateAdd` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`docId`, `docTitle`, `companyId`, `dateAdd`, `status`) VALUES
(0, '', '', '2024-04-03', 'Returned'),
(342, 'Audit Report 2022', '897', '2024-04-02', 'Not Returned'),
(474, 'Audit Report 2021', '7890', '2024-04-03', 'Returned'),
(505, 'audit report 2024', '123456', '2024-04-02', 'Returned'),
(543, 'Financial report 2023', '36363', '', 'Returned'),
(747, 'Audit Report 2021', '123456', '2024-04-02', 'Not Returned'),
(909, 'Financial report 2021', '789', '2024-04-02', 'Not Returned'),
(58584, 'audit report 2023', '7464', '2024-04-02', 'Not Returned');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int(255) NOT NULL,
  `staffName` varchar(255) NOT NULL,
  `staffAge` int(2) NOT NULL,
  `staffPhone` int(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `staffName`, `staffAge`, `staffPhone`, `password`, `username`) VALUES
(590, 'abu', 53, 325251, '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'abu123'),
(632, 'Amirul Hadi', 34, 252525242, '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'amirul123'),
(885, 'hadi', 35, 9383538, '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'hadi123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditfees`
--
ALTER TABLE `auditfees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffId` (`staffId`),
  ADD KEY `companyId` (`companyId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`companyId`),
  ADD KEY `staffId` (`staffId`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`docId`),
  ADD KEY `companyId` (`companyId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
