-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2025 at 07:34 AM
-- Server version: 10.6.21-MariaDB-cll-lve-log
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dfcaamvb_assets`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `purchase_order_invoice_no` text NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `grand_total_amount` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `purchase_order_invoice_no`, `supplier_id`, `grand_total_amount`, `description`, `file_path`, `dated`) VALUES
(1, '1001', 2, 207000, 'Add Stock', 'assets_images/65e9cba1c9151.png', '2024-03-07'),
(2, 'inspecton 1', 0, 0, '', 'IMAGE NOT YET ADDED', '0000-00-00'),
(3, 'inspected dated 07 10 2024', 0, 0, '', 'IMAGE NOT YET ADDED', '0000-00-00'),
(4, '1002', 2, 5000, 'Saqib Testing', 'assets_images/6703c4a873bc4.jpg', '2024-10-07'),
(5, 'Purchase No 01', 2, 0, '', 'IMAGE NOT YET ADDED', '2024-10-05'),
(6, 'Purchase No 02', 3, 180000, 'NIL', 'IMAGE NOT YET ADDED', '2024-10-06'),
(7, 'Purchase No, 3/2024', 1, 100000, 'NILL', 'IMAGE NOT YET ADDED', '2024-10-09'),
(8, 'Purchase No, 4/2024', 3, 131000, '', 'IMAGE NOT YET ADDED', '2024-10-08'),
(9, 'Inspected_dated_11/9/2024', 4, 0, 'Test', 'IMAGE NOT YET ADDED', '2024-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `asset_available`
--

CREATE TABLE `asset_available` (
  `id` int(11) NOT NULL,
  `asset_item_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_available`
--

INSERT INTO `asset_available` (`id`, `asset_item_id`, `category_id`, `item_id`, `quantity`) VALUES
(1, 1, 3, 7, 100),
(2, 2, 2, 6, 5),
(3, 3, 1, 5, 306),
(4, 4, 1, 9, 100),
(5, 5, 1, 10, 200),
(6, 6, 1, 11, 10),
(7, 13, 1, 12, 115),
(8, 18, 2, 13, 13),
(9, 19, 2, 14, 29);

-- --------------------------------------------------------

--
-- Table structure for table `asset_items`
--

CREATE TABLE `asset_items` (
  `id` int(11) NOT NULL,
  `asset_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `item_id` text NOT NULL,
  `item_no` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `dated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_items`
--

INSERT INTO `asset_items` (`id`, `asset_id`, `category_id`, `item_id`, `item_no`, `price`, `quantity`, `total_amount`, `dated`) VALUES
(1, 1, 3, '7', '1', 10, 500, 5000, '2024-03-07'),
(2, 1, 2, '6', '3', 20000, 10, 200000, '2024-03-07'),
(3, 1, 1, '5', '4', 2, 1000, 2000, '2024-03-07'),
(4, 2, 1, '9', '5', 0, 50, 0, '0000-00-00'),
(5, 2, 1, '10', '6', 0, 50, 0, '0000-00-00'),
(6, 2, 1, '11', '7', 0, 50, 0, '0000-00-00'),
(7, 3, 1, '5', '8', 0, 100, 0, '0000-00-00'),
(8, 4, 3, '7', '9', 10, 500, 5000, '2024-10-07'),
(9, 5, 1, '9', '10', 0, 100, 0, '2024-10-05'),
(10, 5, 1, '10', '11', 0, 200, 0, '2024-10-05'),
(11, 5, 1, '11', '12', 0, 5, 0, '2024-10-05'),
(12, 6, 1, '5', '13', 1800, 100, 180000, '2024-10-06'),
(13, 7, 1, '12', '14', 2000, 50, 100000, '2024-10-09'),
(14, 8, 1, '9', '15', 20, 50, 1000, '2024-10-08'),
(15, 8, 1, '11', '16', 50, 40, 2000, '2024-10-08'),
(16, 8, 1, '5', '17', 1800, 50, 90000, '2024-10-08'),
(17, 8, 1, '12', '18', 1900, 20, 38000, '2024-10-08'),
(18, 9, 2, '13', '19', 0, 15, 0, '2024-11-08'),
(19, 9, 2, '14', '21', 0, 30, 0, '2024-11-08'),
(20, 9, 1, '5', '20', 0, 50, 0, '2024-11-08'),
(21, 9, 1, '12', '22', 0, 50, 0, '2024-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `name`, `date`) VALUES
(1, '09-10-2024-10-55-21-backup.sql', '2024-10-09'),
(2, '10-10-2024-09-34-38-backup.sql', '2024-10-10');

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
(3, 'Court Register', '2023-07-05 10:18:52', 0);

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
(2, 'Audit'),
(3, 'Senior Civil Judge');

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
(2, 1, 'Naveed Iqbal', '3181939480', '1560131888367', 'naveedjustonline@gmail.com', 'Database Administrator', 'employee_images/64a680f5a6d06.jpg', '2023-07-06 13:53:09', 0),
(3, 1, 'osama', '967678678', '56757575765', 'osama@gmail.com', 'nill', 'IMAGE NOT YET ADDED', '2023-07-26 12:44:36', 0),
(4, 2, 'jalal', '86565675', '4564646', 'jaal@gmail.com', 'nil', 'employee_images/64c0cf0a75b54.jpg', '2023-07-26 12:45:14', 0),
(5, 3, 'Saddam Khan', '', '', '', 'JC', 'IMAGE NOT YET ADDED', '2024-10-10 03:35:30', 0),
(6, 3, 'Muhammad Zahir Khan', '034599999999', '564445454', '', 'C/O', 'IMAGE NOT YET ADDED', '2024-10-10 03:46:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_assets`
--

CREATE TABLE `issue_assets` (
  `id` int(11) NOT NULL,
  `demand_report_no` text NOT NULL,
  `demand_date` date NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_assets`
--

INSERT INTO `issue_assets` (`id`, `demand_report_no`, `demand_date`, `department_id`, `employee_id`, `description`, `file_path`, `created_at`) VALUES
(2, '1001', '2024-03-20', 1, 2, 'issue', 'assets_images/65fa776f824e9.jpg', '2024-03-20 10:42:06'),
(3, '', '0000-00-00', 1, 2, '', 'IMAGE NOT YET ADDED', '2024-10-04 01:41:00'),
(4, '03', '0000-00-00', 1, 3, '', 'IMAGE NOT YET ADDED', '2024-10-07 06:10:25'),
(5, 'Demand No. 10/24', '2024-10-10', 3, 5, '', 'IMAGE NOT YET ADDED', '2024-10-10 05:32:19'),
(6, '2032', '2024-10-12', 3, 5, '', 'IMAGE NOT YET ADDED', '2024-10-12 00:23:51'),
(7, '2033', '2024-10-12', 2, 1, '', 'IMAGE NOT YET ADDED', '2024-10-12 00:31:38'),
(8, '2034', '2024-10-14', 3, 5, '', 'IMAGE NOT YET ADDED', '2024-10-14 07:35:55'),
(9, '123', '2024-11-06', 1, 2, '', 'IMAGE NOT YET ADDED', '2024-11-06 06:02:35'),
(10, '103', '2024-11-06', 2, 4, '', 'IMAGE NOT YET ADDED', '2024-11-06 06:17:52'),
(11, 'scj/mnd/08nov2024', '2024-11-08', 3, 5, '', 'IMAGE NOT YET ADDED', '2024-11-08 00:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `issue_assets_old`
--

CREATE TABLE `issue_assets_old` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_asset_details`
--

CREATE TABLE `issue_asset_details` (
  `id` int(11) NOT NULL,
  `issue_asset_id` bigint(20) NOT NULL,
  `available_asset_id` bigint(20) NOT NULL,
  `quantity_issue` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_asset_details`
--

INSERT INTO `issue_asset_details` (`id`, `issue_asset_id`, `available_asset_id`, `quantity_issue`, `created_at`) VALUES
(4, 2, 1, 400, '2024-03-20 10:42:06'),
(5, 2, 2, 5, '2024-03-20 10:42:06'),
(6, 2, 3, 400, '2024-03-20 10:42:06'),
(8, 3, 5, 10, '2024-10-04 01:41:00'),
(9, 3, 6, 45, '2024-10-04 01:41:00'),
(10, 4, 3, 590, '2024-10-07 06:10:25'),
(11, 5, 4, 20, '2024-10-10 05:32:19'),
(12, 5, 3, 2, '2024-10-10 05:32:19'),
(13, 5, 7, 3, '2024-10-10 05:32:19'),
(14, 5, 5, 30, '2024-10-10 05:32:19'),
(15, 6, 1, 200, '2024-10-12 00:23:51'),
(16, 7, 1, 300, '2024-10-12 00:31:38'),
(17, 8, 4, 10, '2024-10-14 07:35:55'),
(18, 9, 2, 0, '2024-11-06 06:02:35'),
(19, 10, 1, 100, '2024-11-06 06:17:52'),
(20, 10, 4, 50, '2024-11-06 06:17:52'),
(21, 10, 6, 20, '2024-11-06 06:17:52'),
(22, 11, 3, 2, '2024-11-08 00:43:45'),
(23, 11, 7, 2, '2024-11-08 00:43:45'),
(24, 11, 9, 1, '2024-11-08 00:43:45'),
(25, 11, 8, 2, '2024-11-08 00:43:45'),
(26, 11, 5, 10, '2024-11-08 00:43:45'),
(27, 11, 4, 20, '2024-11-08 00:43:45'),
(28, 11, 6, 20, '2024-11-08 00:43:45');

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
(5, 1, 'Paper: Copymate', 30, 'REM', '2023-07-06 16:24:31', 0),
(6, 2, 'HP Laptop', 10, 'piece', '2023-07-06 16:24:45', 0),
(7, 3, 'files', 5, 'piece', '2023-07-06 16:25:00', 0),
(8, 3, 'Books', 10, 'piece', '2023-07-19 15:53:15', 0),
(9, 1, 'Ball Point: Black', 30, 'Piece', '2024-10-04 01:36:36', 0),
(10, 1, 'Ball Points (Blue)', 30, 'Piece', '2024-10-04 01:37:08', 0),
(11, 1, 'Ball Points (Red)', 30, 'Piece', '2024-10-04 01:37:29', 0),
(12, 1, 'Paper: Double A', 20, 'REM', '2024-10-10 03:52:53', 0),
(13, 2, 'Insect Killer', 5, 'Piece', '2024-11-08 00:35:40', 0),
(14, 2, 'Toner: 59A', 5, 'Piece', '2024-11-08 00:36:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_id`
--

CREATE TABLE `item_id` (
  `id` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_id`
--

INSERT INTO `item_id` (`id`, `item_id`) VALUES
(1, 23);

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
(1, 'osama khan updated', '31819394800', '156013188836700', 'rencitrade@gmail.co', 'supplier_images/64a1a1ea65ce7.png', '2023-07-02 21:12:26', 0),
(2, 'Naveed Iqbal', '89789789789', '767578575785', 'naveedjustonline@gmail.com', 'supplier_images/64a67fdab6ee6.jpg', '2023-07-06 13:48:26', 0),
(3, 'Saqib', '03339163563', '1720167797919', 'saqibk276@gmail.com', 'supplier_images/6707874be3b29.jpg', '2024-10-10 03:50:35', 0),
(4, 'Test1', '', '', '', 'IMAGE NOT YET ADDED', '2024-10-10 04:20:02', 0),
(5, 'Vendor 03', '03469088522555', '123456789124577', '', 'IMAGE NOT YET ADDED', '2024-10-10 05:28:42', 0),
(6, 'Jamal Shah', '03449873233', '', 'jamalshah.mohmand@yahoo.com', 'IMAGE NOT YET ADDED', '2024-10-10 05:37:32', 0);

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
(1, 1, 'naveed', 'admin', 'admin@gmail.com', '1111 1111111', '2222-2222222-2', 'users_image/60b8c7b401155.jpg', '2023-05-26 01:49:27', 0),
(2, 2, 'user', 'user', 'user@gmail.com', '0345669977', '156014455666', '', '2023-06-26 12:20:31', 1),
(51, 2, 'Roman', '12345', 'romankhanpak@yahoo.com', '03469088596', '1234567891234', 'Image NOT YET ADDED', '2024-10-10 03:42:26', 0);

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
-- Indexes for table `asset_items`
--
ALTER TABLE `asset_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
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
-- Indexes for table `issue_assets_old`
--
ALTER TABLE `issue_assets_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_asset_details`
--
ALTER TABLE `issue_asset_details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `asset_available`
--
ALTER TABLE `asset_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `asset_items`
--
ALTER TABLE `asset_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issue_assets`
--
ALTER TABLE `issue_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `issue_assets_old`
--
ALTER TABLE `issue_assets_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_asset_details`
--
ALTER TABLE `issue_asset_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
