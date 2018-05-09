-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2018 at 12:57 PM
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
  `user_id` int(11) NOT NULL,
  `admin_user_name` varchar(255) DEFAULT NULL,
  `admin_user_username` varchar(255) DEFAULT NULL,
  `admin_user_password` varchar(255) DEFAULT NULL,
  `admin_user_role` varchar(255) DEFAULT NULL,
  `admin_user_email` varchar(255) DEFAULT NULL,
  `admin_user_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `admin_user_name`, `admin_user_username`, `admin_user_password`, `admin_user_role`, `admin_user_email`, `admin_user_status`) VALUES
(1, 'Mohsin', 'mohsin', 'a', 'Administrator', 'ahmed.mohsin98@gmail.com', 1),
(5, 'faizan Raza', 'faizan', 't', 'Administrator', 'faiz@toolmarts.com', 1),
(9, 'Farhan Soomoro', 'farhan1', 'a', 'Administrator', 'farhan@toolmarts.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_balance` float(8,2) DEFAULT NULL,
  `billing_date` date DEFAULT NULL,
  `billing_amount_due` float(8,2) DEFAULT NULL,
  `billing_amount_paid` float(8,2) DEFAULT NULL,
  `billing_amount_balance` float(8,2) DEFAULT NULL,
  `billing_amount_payment_type` varchar(255) DEFAULT NULL,
  `billing_bottle_qty` int(11) DEFAULT NULL,
  `billing_bottle_rate` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `customer_id`, `customer_balance`, `billing_date`, `billing_amount_due`, `billing_amount_paid`, `billing_amount_balance`, `billing_amount_payment_type`, `billing_bottle_qty`, `billing_bottle_rate`) VALUES
(43, 33, 0.00, '2018-05-08', 720.00, 700.00, 20.00, 'Cash', 6, 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `billing_monthly`
--

CREATE TABLE `billing_monthly` (
  `billing_monthly_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `billing_monthly_month` varchar(255) DEFAULT NULL,
  `billing_monthly_collection_status` varchar(255) DEFAULT 'Unpaid',
  `billing_monthly_amount_balance` float(8,2) DEFAULT NULL,
  `billing_monthly_amount_paid` float(8,2) DEFAULT NULL,
  `billing_monthly_amount_due` float(8,2) DEFAULT NULL,
  `billing_monthly_bottle_qty` int(11) DEFAULT NULL,
  `billing_monthly_visits` int(11) DEFAULT NULL
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
(32, 'mohsin', 'q', 'Mohsin Ahmed', 'testing1231', 'ahmed.mohsin98@gmail.com', 2147483647, '2018-05-08', 1, 'Monthly', 5, 100.00, 2000.00, 0.00),
(33, 'Faizan', 'a', 'Faizan Raza', 'test', 'ahmed.mohsin98@gmail.com', 2147483647, '2018-05-08', 1, 'cash', 6, 120.00, 2000.00, 20.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `billing_customers_customer_id_fk` (`customer_id`);

--
-- Indexes for table `billing_monthly`
--
ALTER TABLE `billing_monthly`
  ADD PRIMARY KEY (`billing_monthly_id`),
  ADD KEY `billing_monthly_customers_customer_id_fk` (`customer_id`);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `billing_monthly`
--
ALTER TABLE `billing_monthly`
  MODIFY `billing_monthly_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_monthly`
--
ALTER TABLE `billing_monthly`
  ADD CONSTRAINT `billing_monthly_customers_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
