-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2021 at 07:50 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CS340_testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `Dnum` int(11) NOT NULL,
  `Dname` varchar(20) NOT NULL,
  `MgrSsn` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`Dnum`, `Dname`, `MgrSsn`) VALUES
(0, 'RD', '555555555'),
(1, 'HR', '555555555'),
(2, 'Accounting', '555555555');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `Ssn` int(11) NOT NULL,
  `Street` varchar(11) NOT NULL,
  `State` varchar(11) NOT NULL,
  `ZipCode` int(11) NOT NULL,
  `Birthday` date NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`Ssn`, `Street`, `State`, `ZipCode`, `Birthday`, `FirstName`, `LastName`, `Salary`) VALUES
(555555555, '9th', 'Oregon', 97000, '2020-12-31', 'Jake', 'Goodwin', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `Pay`
--

CREATE TABLE `Pay` (
  `Essn` char(9) NOT NULL,
  `Dependents` int(2) NOT NULL,
  `BasePay` decimal(10,2) DEFAULT NULL,
  `ProjectPay` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pay`
--

INSERT INTO `Pay` (`Essn`, `Dependents`, `BasePay`, `ProjectPay`) VALUES
('555555555', 0, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `Pnum` int(4) NOT NULL,
  `Plocation` varchar(20) NOT NULL,
  `Pname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`Pnum`, `Plocation`, `Pname`) VALUES
(0, 'Bend', 'BlackBird'),
(1, 'Dallas', 'x-29'),
(2, 'Russia', 'Object 279');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`Dnum`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`Ssn`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`Pnum`),
  ADD UNIQUE KEY `Pname` (`Pname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
