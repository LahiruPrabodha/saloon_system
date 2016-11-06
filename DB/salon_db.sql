-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2016 at 05:31 PM
-- Server version: 5.6.31
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cus_id` int(10) NOT NULL,
  `Fname` varchar(50) DEFAULT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `contact_no` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE IF NOT EXISTS `employee_tb` (
  `Emp_id` int(5) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `Lname` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `nic` int(10) DEFAULT NULL,
  `contact_no` int(10) DEFAULT NULL,
  `salary` int(8) DEFAULT NULL,
  `join_date` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(10) NOT NULL,
  `emp_id` int(10) DEFAULT NULL,
  `cus_id` int(10) DEFAULT NULL,
  `balance` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `quntuty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `item_id` int(10) NOT NULL,
  `item-name` varchar(60) DEFAULT NULL,
  `quntity` int(4) DEFAULT NULL,
  `bad_item_qty` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`Emp_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `Emp_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
