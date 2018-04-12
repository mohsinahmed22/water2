-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 01:03 PM
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
(11, 8, 100.00, '2018-03-15', 400.00, 300.00, 100.00, 'Cash', 3, 100.00),
(12, 7, 10.00, '2018-03-15', 310.00, 310.00, 0.00, 'Cash', 3, 100.00),
(13, 6, 35.00, '2018-03-15', 135.00, 12.00, 123.00, 'Cash', 1, 100.00),
(14, 2, 300.00, '2018-03-07', 480.00, 0.00, 480.00, 'Monthly', 2, 90.00),
(15, 2, 480.00, '2018-03-16', 660.00, 0.00, 660.00, 'Monthly', 2, 90.00),
(16, 2, 660.00, '2018-03-14', 840.00, 0.00, 840.00, 'Monthly', 2, 90.00),
(17, 2, 840.00, '2018-03-17', 1020.00, 0.00, 1020.00, 'Monthly', 2, 90.00),
(18, 2, 1020.00, '2018-03-16', 1200.00, 0.00, 1200.00, 'Monthly', 4, 90.00),
(19, 2, 1200.00, '2018-02-08', 1380.00, 0.00, 1380.00, 'Monthly', 2, 90.00),
(20, 3, 100.00, '2018-03-19', 200.00, 150.00, 50.00, 'Cash', 2, 100.00),
(21, 2, 1380.00, '2018-02-14', 1580.00, 100.00, 1480.00, 'Monthly', 3, 100.00),
(22, 2, 1480.00, '2018-01-03', 1680.00, 0.00, 1680.00, 'Monthly', 2, 100.00),
(23, 2, 1680.00, '2018-01-18', 1880.00, 0.00, 1880.00, 'Monthly', 2, 100.00),
(24, 2, 1880.00, '2018-01-19', 2080.00, 0.00, 2080.00, 'Monthly', 2, 100.00),
(25, 5, 40.00, '2018-04-10', 200.00, 100.00, 140.00, 'Cash', 2, 100.00),
(26, 5, 140.00, '2018-04-10', 200.00, 200.00, 140.00, 'Cash', 2, 100.00),
(27, 5, 140.00, '2018-04-10', 100.00, 100.00, 140.00, 'Cash', 1, 100.00),
(28, 5, 140.00, '2018-04-10', 200.00, 20.00, 320.00, 'Cash', 2, 100.00),
(29, 2, 2080.00, '2018-04-10', 200.00, 200.00, 2080.00, 'Monthly', 2, 100.00),
(30, 2, 2080.00, '2018-04-10', 200.00, 200.00, 2080.00, 'Monthly', 2, 100.00),
(31, 2, 2080.00, '2018-04-10', 200.00, 100.00, 2180.00, 'Monthly', 2, 100.00),
(32, 2, 2180.00, '2018-04-10', 200.00, 100.00, 2280.00, 'Monthly', 2, 100.00),
(33, 2, 2280.00, '2018-04-11', 200.00, 150.00, 2330.00, 'Monthly', 2, 100.00),
(34, 2, 2330.00, '2018-04-11', 200.00, 10.00, 2520.00, 'Monthly', 2, 100.00),
(35, 2, 2520.00, '2018-04-11', 200.00, 150.00, 2570.00, 'Monthly', 2, 100.00),
(36, 2, 2570.00, '2018-04-11', 200.00, 150.00, 2620.00, 'Monthly', 2, 100.00),
(37, 2, 2620.00, '2017-12-15', 200.00, 0.00, 2820.00, 'Monthly', 2, 100.00);

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

--
-- Dumping data for table `billing_monthly`
--

INSERT INTO `billing_monthly` (`billing_monthly_id`, `customer_id`, `billing_monthly_month`, `billing_monthly_collection_status`, `billing_monthly_amount_balance`, `billing_monthly_amount_paid`, `billing_monthly_amount_due`, `billing_monthly_bottle_qty`, `billing_monthly_visits`) VALUES
(23, 2, 'Mar-18', 'Paid', 0.00, 4200.00, 4200.00, 12, 5),
(24, 2, 'Feb-18', 'Paid', 2780.00, 3000.00, 2960.00, 5, 2),
(25, 2, 'Jan-18', 'Paid', 0.00, 200.00, 5640.00, 6, 3),
(26, 2, 'Apr-18', 'Paid', 4120.00, 300.00, 1600.00, 16, 8),
(27, 2, 'Dec-17', 'Paid', 1320.00, 3000.00, 200.00, 2, 1);

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
(1, 'Clean Property', 'New UPdate Setup', 'Mohsin', 'North Nazimbad', 'test@toolmarts.com', 111111111, '2018-03-12', 0, 'cash', 6, 10.00, 1000.25, 200.00),
(2, 'Mooo', '123', 'Mohsin Ahmed', 'johar - new', 'abc@toolmarts.com', 2222222, '2018-03-12', 1, 'Monthly', 2, 100.00, 2000.00, 1320.00),
(3, 'Umar', '123', 'Umar khan', 'autopark way', 'umar@toolmarts.com', 12312312, '2018-03-12', 0, 'Monthly', 1, 100.00, 1000.00, 50.00),
(4, 'Farhan', '123', 'Farhan Somooro', 'johar chowrangi', 'farhan@toolmarts.com', 12312312, '2018-03-12', 1, 'Monthly', 2, 120.00, 1000.00, 200.00),
(5, 'faizan', 'test', 'Faizan Raza', 'ababs', 'faizan@toolmarts.com', 111111, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 320.00),
(6, 'faizan', 'test', 'Faizan Raza', 'ababs', 'faizan@toolmarts.com', 111111, '2018-03-12', 1, 'cash', 1, 100.00, 1000.00, 123.00),
(7, 'Asif', '123', 'asif new', 'akdjfksdj', 'asif@toolmarts.com', 111111, '2018-03-15', 1, 'cash', 3, 100.00, 1500.00, 0.00),
(8, 'ahmed', 'mohsin', 'Ahmed', 'testing123', 'aut@toolmarts.com', 111111, '2018-03-15', 1, 'cash', 3, 100.00, 1500.00, 100.00),
(9, 'Farhan', '222', 'Farhan Somooro', 'fdfdf', 'farhan@toolmarts.com', 12312312, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 50.00),
(10, 'faizan', '123131', 'Faizan Raza', 'testss', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 40.00),
(11, 'faizan', '122', 'Faizan Raza', 'aaaaaaaaaaaaaaaaaaaaaaa', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 123.00),
(12, 'Asif', '123', 'asif new', 'testing address update', 'asif@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 3, 100.00, 1500.00, 0.00),
(13, 'Asif', '123', 'asif new', 'aaaa', 'asif@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 3, 100.00, 1500.00, 0.00),
(14, 'faizan', '123', 'Faizan Raza', 'aaasdfd', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 40.00),
(15, 'ahmed', '123', 'Ahmed', '111111111', 'aut@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 3, 100.00, 1500.00, 100.00),
(16, 'Farhan', '123', 'Farhan Somooro', '11111111111111111', 'farhan@toolmarts.com', 12312312, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 50.00),
(17, 'faizan', '123', 'Faizan Raza', '123', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 123.00),
(18, 'Asif', '123', 'asif new', '122312323', 'asif@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 3, 100.00, 1500.00, 0.00),
(19, 'Asif', 'aaaa', 'asif new', 'aaaa', 'asif@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 3, 100.00, 1500.00, 0.00),
(20, 'faizan', 'aaa', 'Faizan Raza', 'aaaaaa', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 40.00),
(21, 'faizan', 'asd', 'Faizan Raza', 'asdasdasd', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 40.00),
(22, 'aaaaa', 'aaaa', 'Farhan', 'aaaa', 'abc@toolmarts.com', 2222222, '2018-03-19', 1, 'cash', 2, 90.00, 2000.00, 1380.00),
(23, 'Farhan', '122', 'Farhan Somooro', 'asdas', 'farhan@toolmarts.com', 12312312, '2018-03-19', 1, 'Monthly', 1, 100.00, 1000.00, 50.00),
(24, 'far', '123', 'Farhan', 'aaasd', 'abc@toolmarts.com', 2222222, '2018-03-19', 1, 'cash', 2, 90.00, 2000.00, 1380.00),
(25, 'faizan', '111', 'Faizan Raza', 'ababs1111111', 'faizan@toolmarts.com', 111111, '2018-03-19', 1, 'cash', 1, 100.00, 1000.00, 40.00),
(26, 'mohsin Ahmed', 'password', 'mohsin Ahmed', 'c401 select address 1123', 'mohsin@toolmarts.com', 2147483647, '0000-00-00', 0, '', 0, 0.00, 0.00, 0.00),
(27, 'New test', 'ops', 'mohsin new', 'k1j2k31jk23j1', 'aut@toolmarts.com', 123456, '2018-04-04', 1, 'cash', 2, 120.00, 0.00, 10.00),
(28, 'New test', '12333', 'mohsin new', 'k1j2k31jk23j1', 'aut@toolmarts.com', 123456, '2018-04-04', 1, 'cash', 2, 120.00, 0.00, 10.00),
(29, 'Mohsin', 'test123', 'Mohsin Ahmed', 'auto park', 'mohsin@toolmarts.com', 0, '0000-00-00', 0, 'Cash', 1, 0.00, 0.00, 0.00),
(30, 'admin', 'tmt123456', 'test', '132', 'aut@toolmarts.com', 12312312, '0000-00-00', 0, 'Cash', 1, 0.00, 0.00, 0.00),
(31, 'admin', 'tmt123456', 'test', '132', 'aut@toolmarts.com', 12312312, '0000-00-00', 0, 'Cash', 1, 0.00, 0.00, 0.00);

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
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `billing_monthly`
--
ALTER TABLE `billing_monthly`
  MODIFY `billing_monthly_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
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
