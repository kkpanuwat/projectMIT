-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 12:31 PM
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
-- Database: `bangnaengineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` int(1) NOT NULL,
  `img` varchar(500) NOT NULL,
  `point` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `fname`, `lname`, `email`, `phone`, `gender`, `img`, `point`) VALUES
('guess', 'd41d8cd98f00b204e9800998ecf8427e', 'guess', 'guess', 'guess@bangnaengineering.org', '0854390131', 1, '../asset/userprofile/customer/img6071462535562.jpg', 120),
('narattha', '81dc9bdb52d04dc20036dbd8313ed055', 'ธนะรัชต์', 'อาจประโคน', 'narattha@bangnaenginerring.com', '0981702726', 1, '../asset/userprofile/staff/img60708155ab7c2.jpg', 111),
('panuwat', '81dc9bdb52d04dc20036dbd8313ed055', 'ภานุวัฒน์ ', 'ยี่สุ่นซ้อน', 'iamsmilepanuwat@gmail.com', '0854390131', 1, '../asset/userprofile/staff/img6070817cd570e.jpg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `detail_id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `price` int(10) NOT NULL,
  `purchase_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`detail_id`, `product_id`, `qty`, `price`, `purchase_id`) VALUES
(64, 'PD001', 1, 50, '38'),
(65, 'PD002', 1, 123, '38'),
(66, 'PD020', 1, 99, '38'),
(67, 'PD020', 5, 99, '39'),
(68, 'PD002', 3, 123, '39'),
(69, 'PD001', 8, 50, '39'),
(70, 'PD020', 1, 99, '40'),
(71, 'PD020', 1, 99, '41'),
(72, 'PD020', 1, 99, '42'),
(73, 'PD002', 2, 123, '42'),
(74, 'PD001', 1, 50, '43'),
(75, 'PD002', 5, 123, '44'),
(76, 'PD020', 2, 99, '44'),
(77, 'PD002', 5, 123, '45'),
(78, 'PD020', 2, 99, '45'),
(79, 'PD001', 21, 50, '45'),
(80, 'PD001', 21, 50, '46'),
(81, 'PD002', 4, 123, '46'),
(82, 'PD020', 5, 99, '46'),
(83, 'PD002', 7, 123, '47'),
(84, 'PD020', 1, 99, '47'),
(85, 'PD001', 1, 50, '47'),
(86, 'PD002', 1, 123, '48'),
(87, 'PD020', 1, 99, '48'),
(88, 'PD001', 1, 50, '48'),
(89, 'PD001', 17, 50, '49'),
(90, 'PD020', 11, 99, '50'),
(91, 'PD002', 71, 123, '50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pd_id` varchar(10) NOT NULL,
  `pd_type` varchar(10) NOT NULL,
  `pd_name` varchar(500) NOT NULL,
  `pd_qty` int(10) NOT NULL,
  `pd_price` int(10) NOT NULL,
  `pd_desp` varchar(500) NOT NULL,
  `pd_img` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `pd_type`, `pd_name`, `pd_qty`, `pd_price`, `pd_desp`, `pd_img`, `created_at`) VALUES
('PD001', 'TY001', 'น็อต 0.5', 39, 50, '<p>software Testing</p>\r\n', '../asset/image/img607077aeec4a3.jpg', '2021-04-10 10:25:22'),
('PD002', 'TY001', 'น็อต 0.7', 407, 123, '<p>Test Software Please Enter Number</p>\r\n', '../asset/image/img607077bec7fe7.jpg', '2021-04-10 10:29:01'),
('PD020', 'TY002', 'น็อต 0.5', 278, 99, '', '../asset/image/img607077ee7cea6.jpg', '2021-04-10 10:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `purchase_id` int(50) NOT NULL,
  `purchase_price` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` date NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `staff_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`purchase_id`, `purchase_price`, `created_at`, `deleted_at`, `customer_id`, `staff_id`) VALUES
(38, 272, '2021-04-09 19:46:01', '0000-00-00', 'narattha', 'STF002'),
(39, 1264, '2021-04-09 20:21:46', '0000-00-00', 'panuwat', 'STF002'),
(40, 99, '2021-04-09 20:23:18', '0000-00-00', 'guess', 'STF002'),
(41, 99, '2021-04-09 20:24:08', '0000-00-00', 'guess', 'STF002'),
(42, 99, '2021-04-09 20:24:13', '0000-00-00', 'guess', 'STF002'),
(43, 50, '2021-04-09 20:26:17', '0000-00-00', 'guess', 'STF002'),
(44, 813, '2021-04-09 20:27:44', '0000-00-00', 'guess', 'STF002'),
(45, 813, '2021-04-09 20:27:58', '0000-00-00', 'guess', 'STF002'),
(46, 2037, '2021-04-09 20:29:18', '0000-00-00', 'guess', 'STF002'),
(47, 1010, '2021-04-10 06:07:59', '0000-00-00', 'panuwat', 'STF002'),
(48, 1010, '2021-04-10 06:08:20', '0000-00-00', 'panuwat', 'STF002'),
(49, 850, '2021-04-10 10:25:22', '0000-00-00', 'narattha', 'STF002'),
(50, 9822, '2021-04-10 10:29:01', '0000-00-00', 'panuwat', 'STF002');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`, `fname`, `lname`, `gender`, `email`, `phone`, `img`) VALUES
('STF002', '81dc9bdb52d04dc20036dbd8313ed055', 'สุภาวดี ', 'แย้มพุฒ', 2, 'hello@microbrain.io', '0854390131', '../asset/userprofile/staff/img60632a5c190dc.jpg'),
('STF003', '81dc9bdb52d04dc20036dbd8313ed055', 'น้องเบส', 'งื้อๆๆๆๆๆ', 1, 'best@bangnaengineer.com', '+66854390131', '../asset/userprofile/staff/img60632b73d06ed.jpg'),
('STF004', 'd37bcb97e2d0c2d93ce94ed5e658e3aa', 'ธนะรัชต์', 'อาจประโคน', 2, 'f@bangaenginerring.com', '0854390132', '../asset/userprofile/staff/img60632cff058cb.jpg'),
('STF005', 'd41d8cd98f00b204e9800998ecf8427e', 'สุภาวดี ', 'แย้มพุฒ', 2, 'siriluk7354@gmail.com', '085-439-0131', '../asset/userprofile/staff/img606579fb37d9a.jpg'),
('STF006', '81dc9bdb52d04dc20036dbd8313ed055', 'ภานุวัฒน์', 'ยี่สุ่นซ้อน', 1, 'iamsmilepanuwat@gmail.com', '0854390132', '../asset/userprofile/staff/img60640a2c58c3d.jpg'),
('STF007', 'd41d8cd98f00b204e9800998ecf8427e', 'สุภาวดี ', 'แย้มพุฒ', 2, 'iamsmilepanuwat@gmail.com', '0854390131', '../asset/userprofile/staff/img606ed76858fb1.jpg'),
('STF008', '81dc9bdb52d04dc20036dbd8313ed055', 'สมหญิง', 'ยี่สุ่นซ้อน', 2, 'siriluk7354@gmail.com', '+66854390131', '../asset/userprofile/staff/img606ed7945e90c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `type_product_id` varchar(10) NOT NULL,
  `type_name` varchar(500) NOT NULL,
  `type_desp` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`type_product_id`, `type_name`, `type_desp`, `created_at`) VALUES
('TY001', 'เครื่องจักร', '-', '2021-03-17 14:09:31'),
('TY002', 'น็อต', '-', '2021-03-17 14:09:35'),
('TY003', 'ปะแจ', '-', '2021-03-17 14:09:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`type_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `purchase_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
