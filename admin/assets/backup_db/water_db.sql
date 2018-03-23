-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 02:46 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_user_id` int(11) NOT NULL,
  `admin_user_name` varchar(255) DEFAULT NULL,
  `admin_user_username` varchar(255) DEFAULT NULL,
  `admin_user_password` varchar(255) DEFAULT NULL,
  `admin_user_role` varchar(255) DEFAULT NULL,
  `admin_user_email` varchar(255) DEFAULT NULL,
  `admin_user_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_balance` int(11) DEFAULT NULL,
  `billing_date` date DEFAULT NULL,
  `billing_amount_due` int(11) DEFAULT NULL,
  `billing_amount_paid` int(11) DEFAULT NULL,
  `billing_amount_balance` int(11) DEFAULT NULL,
  `billing_amount_payment_type` varchar(255) DEFAULT NULL,
  `billing_bottle_qty` int(11) DEFAULT NULL,
  `billing_bottle_rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_username` varchar(255) DEFAULT NULL,
  `customer_password` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` text,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` int(11) DEFAULT NULL,
  `customer_join_date` date DEFAULT NULL,
  `customer_status` int(11) DEFAULT '0',
  `customer_payment_type` varchar(255) DEFAULT NULL,
  `customer_bottle_qty` int(11) DEFAULT '1',
  `customer_bottle_rate` float(8,2) DEFAULT NULL,
  `customer_advance` float(8,2) DEFAULT NULL,
  `customer_balance` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Water Customer';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_username`, `customer_password`, `customer_name`, `customer_address`, `customer_email`, `customer_phone`, `customer_join_date`, `customer_status`, `customer_payment_type`, `customer_bottle_qty`, `customer_bottle_rate`, `customer_advance`, `customer_balance`) VALUES
(1, NULL, NULL, 'Mohsin', 'North Nazimbad', 'test@toolmarts.com', 111111111, '2018-03-12', 0, 'cash', 6, 10.00, 1000.25, 20.00),
(2, NULL, NULL, 'Farhan', 'gulshan', 'abc@toolmarts.com', 2222222, '2018-03-12', 1, 'Monthly', 2, 90.00, 2000.00, 150.00),
(3, 'Farhan', 'test123', 'Farhan Somooro', NULL, 'farhan@toolmarts.com', 12312312, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 0.00),
(4, 'Farhan', 'test123', 'Farhan Somooro', NULL, 'farhan@toolmarts.com', 12312312, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 0.00),
(5, 'faizan', 'test', 'Faizan Raza', 'ababs', 'faizan@toolmarts.com', 111111, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 20.00),
(6, 'faizan', 'test', 'Faizan Raza', 'ababs', 'faizan@toolmarts.com', 111111, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 20.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `billing_customers_customer_id_fk` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_customers_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
