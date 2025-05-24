-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2023 at 01:30 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assets_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `purchase_order_invoice_no` text NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `po_no` bigint(20) NOT NULL,
  `item_no` bigint(20) DEFAULT NULL,
  `item_id` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `purchase_order_invoice_no`, `supplier_id`, `category_id`, `po_no`, `item_no`, `item_id`, `price`, `quantity`, `total_amount`, `description`, `file_path`, `dated`) VALUES
(9, '', 2, 2, 99, 88, '6', 5000, 10, 50000, 'laptop purchase', 'assets_images/64a6a545046be.jpg', '2023-06-27'),
(10, '444', 1, 3, 123456, 0, '7', 50, 10, 500, 'new testing', 'assets_images/64b63f68a5ac0.png', '2023-07-03'),
(11, '346363', 1, 1, 1, 0, '5', 100, 1000, 100000, 'djslkjdf', 'FILE NOT YET ADDED', '2023-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `asset_available`
--

CREATE TABLE `asset_available` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset_available`
--

INSERT INTO `asset_available` (`id`, `asset_id`, `category_id`, `quantity`) VALUES
(9, 9, 2, 7),
(10, 10, 3, 7),
(11, 11, 1, 964);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `status`) VALUES
(1, 'Stationary', '2023-07-05 10:18:36', 0),
(2, 'Miscellaneous', '2023-07-05 10:18:45', 0),
(3, 'Court Register', '2023-07-05 10:18:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`) VALUES
(1, 'Finance'),
(2, 'Audit');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `mobile` text NOT NULL,
  `cnic` text NOT NULL,
  `email` text NOT NULL,
  `designation` text NOT NULL,
  `image_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `name`, `mobile`, `cnic`, `email`, `designation`, `image_path`, `created_at`, `status`) VALUES
(1, 2, 'Majid updated', '111111111111', '222222222', 'majid@gmail.comupdated', 'DR updated', 'employee_images/Screenshot (7).png', '2023-07-02 12:13:29', 0),
(2, 1, 'Naveed Iqbal', '3181939480', '1560131888367', 'naveedjustonline@gmail.com', 'Database Administrator', 'employee_images/64a680f5a6d06.jpg', '2023-07-06 13:53:09', 0),
(3, 1, 'osama', '967678678', '56757575765', 'osama@gmail.com', 'nill', 'IMAGE NOT YET ADDED', '2023-07-26 12:44:36', 0),
(4, 2, 'jalal', '86565675', '4564646', 'jaal@gmail.com', 'nil', 'employee_images/64c0cf0a75b54.jpg', '2023-07-26 12:45:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_assets`
--

CREATE TABLE `issue_assets` (
  `id` int(11) NOT NULL,
  `demand_report_no` text NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `assets_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `department_id` text NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_assets`
--

INSERT INTO `issue_assets` (`id`, `demand_report_no`, `item_id`, `assets_id`, `category_id`, `department_id`, `employee_id`, `quantity`, `issue_date`, `description`, `file_path`, `status`) VALUES
(8, '', 0, 9, 2, '1', 2, 3, '2023-07-05', 'issues laptop to finance naveed', 'IMAGE NOT YET ADDED', 0),
(9, '', 123456, 10, 3, '1', 2, 3, '2023-07-18', 'new testing', 'IMAGE NOT YET ADDED', 0),
(10, '80809', 1, 11, 1, '1', 2, 19, '2023-07-11', 'here is details', 'IMAGE NOT YET ADDED', 0),
(11, '798797', 1, 11, 1, '1', 2, 10, '2023-07-03', 'djsjdjf', 'IMAGE NOT YET ADDED', 0),
(12, '0980990', 1, 11, 1, '2', 1, 7, '2023-07-07', 'jkhjhjh', 'IMAGE NOT YET ADDED', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `min_quantity` bigint(20) NOT NULL,
  `unit` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `item_name`, `min_quantity`, `unit`, `created_at`, `status`) VALUES
(5, 1, 'Pages', 10, 'piece', '2023-07-06 16:24:31', 0),
(6, 2, 'HP Laptop', 2, 'piece', '2023-07-06 16:24:45', 0),
(7, 3, 'files', 5, 'piece', '2023-07-06 16:25:00', 0),
(8, 3, 'Books', 10, 'piece', '2023-07-19 15:53:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_id`
--

CREATE TABLE `item_id` (
  `id` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_id`
--

INSERT INTO `item_id` (`id`, `item_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `status`) VALUES
(1, 'Admin', '2023-06-26 12:19:08', 0),
(2, 'User', '2023-06-26 12:19:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mobile` text NOT NULL,
  `cnic` text NOT NULL,
  `email` text NOT NULL,
  `image_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `cnic`, `email`, `image_path`, `created_at`, `status`) VALUES
(1, 'osama khan updated', '31819394800', '156013188836700', 'rencitrade@gmail.co', 'supplier_images/64a1a1ea65ce7.png', '2023-07-02 21:12:26', 0),
(2, 'Naveed Iqbal', '89789789789', '767578575785', 'naveedjustonline@gmail.com', 'supplier_images/64a67fdab6ee6.jpg', '2023-07-06 13:48:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1 admin 2 client/user',
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `password`, `email`, `mobile`, `cnic`, `image_path`, `created_at`, `status`) VALUES
(1, 1, 'naveed', 'khan', 'naveedjustonline@gmail.com', '1111 1111111', '2222-2222222-2', 'users_image/60b8c7b401155.jpg', '2023-05-26 01:49:27', 0),
(2, 2, 'user', 'user', 'user@gmail.com', '0345669977', '156014455666', '', '2023-06-26 12:20:31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_available`
--
ALTER TABLE `asset_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_assets`
--
ALTER TABLE `issue_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_id`
--
ALTER TABLE `item_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `asset_available`
--
ALTER TABLE `asset_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_assets`
--
ALTER TABLE `issue_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_id`
--
ALTER TABLE `item_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
