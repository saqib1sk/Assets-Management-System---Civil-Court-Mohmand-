-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2023 at 08:34 AM
-- Server version: 10.5.20-MariaDB-cll-lve-log
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skenjlgk_assest`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `po_no` bigint(20) NOT NULL,
  `item_no` bigint(20) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `supplier_id`, `category_id`, `po_no`, `item_no`, `item_id`, `price`, `quantity`, `total_amount`, `description`, `file_path`, `dated`) VALUES
(8, 1, 1, 11, 22, '5', 100, 50, 5000, 'pages from osama khan ', 'assets_images/64a6a4e8c056b.jpg', '2023-07-04'),
(9, 2, 2, 99, 88, '6', 5000, 10, 50000, 'laptop purchase', 'assets_images/64a6a545046be.jpg', '2023-06-27'),
(10, 1, 3, 2233, 4455, '7', 100, 10, 1000, 'testing online', 'FILE NOT YET ADDED', '2023-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `asset_available`
--

CREATE TABLE `asset_available` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_available`
--

INSERT INTO `asset_available` (`id`, `asset_id`, `category_id`, `quantity`) VALUES
(8, 8, 1, 46),
(9, 9, 2, 7),
(10, 10, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `status`) VALUES
(1, 'Stationary', '2023-07-05 10:18:36', 0),
(2, 'Miscellaneous', '2023-07-05 10:18:45', 0),
(3, 'Court Item', '2023-07-05 10:18:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `name`, `mobile`, `cnic`, `email`, `designation`, `image_path`, `created_at`, `status`) VALUES
(1, 2, 'Majid updated', '111111111111', '222222222', 'majid@gmail.comupdated', 'DR updated', 'employee_images/Screenshot (7).png', '2023-07-02 12:13:29', 0),
(2, 1, 'Naveed Iqbal', '3181939480', '1560131888367', 'naveedjustonline@gmail.com', 'Database Administrator', 'employee_images/64a680f5a6d06.jpg', '2023-07-06 13:53:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_assets`
--

CREATE TABLE `issue_assets` (
  `id` int(11) NOT NULL,
  `assets_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `department_id` text NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_assets`
--

INSERT INTO `issue_assets` (`id`, `assets_id`, `category_id`, `department_id`, `employee_id`, `quantity`, `issue_date`, `description`, `file_path`, `status`) VALUES
(8, 9, 2, '1', 2, 3, '2023-07-05', 'issues laptop to finance naveed', 'IMAGE NOT YET ADDED', 0),
(9, 8, 1, '2', 1, 4, '2023-07-12', 'test', 'issue_assets_images/64ad4916273f5.jpeg', 0),
(10, 10, 3, '1', 2, 5, '2023-07-16', 'issue to finanace dept employee naveed', 'IMAGE NOT YET ADDED', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `item_name`, `min_quantity`, `unit`, `created_at`, `status`) VALUES
(5, 1, 'Pages', 10, 'piece', '2023-07-06 16:24:31', 0),
(6, 2, 'HP Laptop', 2, 'piece', '2023-07-06 16:24:45', 0),
(7, 3, 'files', 5, 'piece', '2023-07-06 16:25:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `cnic`, `email`, `image_path`, `created_at`, `status`) VALUES
(1, 'osama khan', '3181939480', '1560131888367', 'rencitrade@gmail.com', 'supplier_images/64a1a1ea65ce7.png', '2023-07-02 21:12:26', 0),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `asset_available`
--
ALTER TABLE `asset_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issue_assets`
--
ALTER TABLE `issue_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
