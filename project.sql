-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 04:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL,
  `full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `full_name`) VALUES
(1, 'zeadbawaknh@gmail.com', '111111', 'ziad riad'),
(2, 'ziad@yahoo.com', '0000', 'ziad riad bawaknh'),
(3, 'yaman@yahoo.com', '112233', 'yaman riad');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(16, 'Women', 'women.png'),
(17, 'Men', 'man.png'),
(18, 'Shoes', 'shoes.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(5) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` text NOT NULL,
  `customer_password` text NOT NULL,
  `customer_phone` int(10) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `customer_address`, `customer_image`) VALUES
(9, 'ahmad', 'ahmad@hotmail.com', '55555', 798750188, 'irbid', 'c2.jpg'),
(10, 'ziad', 'ziad@hotmail.com', '55555', 798750188, 'irbid', 'c1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `order_date` date NOT NULL,
  `customer_id` int(5) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_id`, `product_id`, `qty`, `total`) VALUES
(114, '2020-10-02', 10, '27,29', 1, 44),
(115, '2020-10-02', 10, '27,29', 2, 84),
(116, '2020-10-02', 10, '27,29', 1, 44),
(117, '2020-10-02', 10, '27,29', 2, 84),
(118, '2020-10-02', 10, '27,29', 3, 114),
(119, '2020-10-02', 10, '27,29', 1, 44),
(120, '2020-10-02', 10, '27,29', 1, 84),
(121, '2020-10-02', 10, '27,29', 1, 114),
(122, '2020-10-02', 10, '27,29', 1, 44),
(123, '2020-10-02', 10, '27,29', 1, 84),
(124, '2020-10-02', 10, '27,29', 1, 114),
(125, '2020-10-02', 10, '27,29', 1, 30),
(126, '2020-10-02', 10, '27,29', 1, 30),
(127, '2020-10-02', 10, '27,29', 1, 44),
(128, '2020-10-02', 10, '27,29', 1, 40),
(129, '2020-10-02', 10, '27,29', 1, 30),
(130, '2020-10-02', 10, '27,29', 1, 44),
(131, '2020-10-02', 10, '27,29', 1, 40),
(132, '2020-10-02', 10, '27,29', 1, 30),
(133, '2020-10-03', 10, '27,29', 1, 44),
(134, '2020-10-03', 10, '27,29', 1, 40),
(135, '2020-10-03', 10, '27,29', 1, 30),
(136, '2020-10-03', 10, '27,29', 1, 44);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_d_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `qty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pending_product`
--

CREATE TABLE `pending_product` (
  `pro_id` int(5) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_image` text NOT NULL,
  `pro_price` int(5) NOT NULL,
  `pro_desc` text NOT NULL,
  `vendor_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` text NOT NULL,
  `product_price` int(5) NOT NULL,
  `product_desc` text NOT NULL,
  `category_id` int(5) NOT NULL,
  `vendor_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_price`, `product_desc`, `category_id`, `vendor_id`) VALUES
(25, 'Smooth cloth', 'smoothclothe.png', 50, 'very beautiful ', 16, 0),
(26, 'blue shoes', 'blueshoes.png', 30, 'sweet shoes', 18, 0),
(27, 'Denim Jackit', 'man.png', 44, 'beautiful jackit', 17, 0),
(28, 'yallow jackit', 'yallow.png', 30, 'impressive', 17, 0),
(29, 'Green Bag', 'baggreen.png', 40, 'New bag ', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(5) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_email` text NOT NULL,
  `vendor_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_password`) VALUES
(1, '', '', ''),
(3, 'ZARA', 'zara@vendor.com', '123'),
(4, 'GUCCI', 'gucci@vendor.com ', '00000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_d_id`);

--
-- Indexes for table `pending_product`
--
ALTER TABLE `pending_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_d_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_product`
--
ALTER TABLE `pending_product`
  MODIFY `pro_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
