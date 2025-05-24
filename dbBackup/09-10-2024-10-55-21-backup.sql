DROP TABLE asset_available;

CREATE TABLE `asset_available` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_item_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asset_available VALUES("1","1","3","7","700");
INSERT INTO asset_available VALUES("2","2","2","6","5");
INSERT INTO asset_available VALUES("3","3","1","5","110");
INSERT INTO asset_available VALUES("4","4","1","9","15");
INSERT INTO asset_available VALUES("5","5","1","10","40");
INSERT INTO asset_available VALUES("6","6","1","11","5");



DROP TABLE asset_items;

CREATE TABLE `asset_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `item_id` text NOT NULL,
  `item_no` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `dated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asset_items VALUES("1","1","3","7","1","10","500","5000","2024-03-07");
INSERT INTO asset_items VALUES("2","1","2","6","3","20000","10","200000","2024-03-07");
INSERT INTO asset_items VALUES("3","1","1","5","4","2","1000","2000","2024-03-07");
INSERT INTO asset_items VALUES("4","2","1","9","5","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("5","2","1","10","6","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("6","2","1","11","7","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("7","3","1","5","8","0","100","0","0000-00-00");
INSERT INTO asset_items VALUES("8","4","3","7","9","10","500","5000","2024-10-07");



DROP TABLE assets;

CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_invoice_no` text NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `grand_total_amount` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `dated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO assets VALUES("1","1001","2","207000","Add Stock","assets_images/65e9cba1c9151.png","2024-03-07");
INSERT INTO assets VALUES("2","inspecton 1","0","0","","IMAGE NOT YET ADDED","0000-00-00");
INSERT INTO assets VALUES("3","inspected dated 07 10 2024","0","0","","IMAGE NOT YET ADDED","0000-00-00");
INSERT INTO assets VALUES("4","1002","2","5000","Saqib Testing","assets_images/6703c4a873bc4.jpg","2024-10-07");



DROP TABLE backup;

CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




DROP TABLE categories;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categories VALUES("1","Stationary","2023-07-05 10:18:36","0");
INSERT INTO categories VALUES("2","Miscellaneous","2023-07-05 10:18:45","0");
INSERT INTO categories VALUES("3","Court Register","2023-07-05 10:18:52","0");



DROP TABLE departments;

CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO departments VALUES("1","Finance");
INSERT INTO departments VALUES("2","Audit");



DROP TABLE employees;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `mobile` text NOT NULL,
  `cnic` text NOT NULL,
  `email` text NOT NULL,
  `designation` text NOT NULL,
  `image_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO employees VALUES("1","2","Majid updated","111111111111","222222222","majid@gmail.comupdated","DR updated","employee_images/Screenshot (7).png","2023-07-02 12:13:29","0");
INSERT INTO employees VALUES("2","1","Naveed Iqbal","3181939480","1560131888367","naveedjustonline@gmail.com","Database Administrator","employee_images/64a680f5a6d06.jpg","2023-07-06 13:53:09","0");
INSERT INTO employees VALUES("3","1","osama","967678678","56757575765","osama@gmail.com","nill","IMAGE NOT YET ADDED","2023-07-26 12:44:36","0");
INSERT INTO employees VALUES("4","2","jalal","86565675","4564646","jaal@gmail.com","nil","employee_images/64c0cf0a75b54.jpg","2023-07-26 12:45:14","0");



DROP TABLE issue_asset_details;

CREATE TABLE `issue_asset_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_asset_id` bigint(20) NOT NULL,
  `available_asset_id` bigint(20) NOT NULL,
  `quantity_issue` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO issue_asset_details VALUES("4","2","1","300","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("5","2","2","5","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("6","2","3","400","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("7","3","4","35","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("8","3","5","10","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("9","3","6","45","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("10","4","3","590","2024-10-07 06:10:25");



DROP TABLE issue_assets;

CREATE TABLE `issue_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demand_report_no` text NOT NULL,
  `demand_date` date NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO issue_assets VALUES("2","1001","2024-03-20","1","2","issue","assets_images/65fa776f824e9.jpg","2024-03-20 10:42:06");
INSERT INTO issue_assets VALUES("3","","0000-00-00","1","2","","IMAGE NOT YET ADDED","2024-10-04 01:41:00");
INSERT INTO issue_assets VALUES("4","03","0000-00-00","1","3","","IMAGE NOT YET ADDED","2024-10-07 06:10:25");



DROP TABLE issue_assets_old;

CREATE TABLE `issue_assets_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE item_id;

CREATE TABLE `item_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO item_id VALUES("1","10");



DROP TABLE items;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `min_quantity` bigint(20) NOT NULL,
  `unit` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO items VALUES("5","1","Paper: Copymate","30","REM","2023-07-06 16:24:31","0");
INSERT INTO items VALUES("6","2","HP Laptop","10","piece","2023-07-06 16:24:45","0");
INSERT INTO items VALUES("7","3","files","5","piece","2023-07-06 16:25:00","0");
INSERT INTO items VALUES("8","3","Books","10","piece","2023-07-19 15:53:15","0");
INSERT INTO items VALUES("9","1","Ball Point: Black","30","Piece","2024-10-04 01:36:36","0");
INSERT INTO items VALUES("10","1","Ball Points (Blue)","30","Piece","2024-10-04 01:37:08","0");
INSERT INTO items VALUES("11","1","Ball Points (Red)","30","Piece","2024-10-04 01:37:29","0");



DROP TABLE roles;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roles VALUES("1","Admin","2023-06-26 12:19:08","0");
INSERT INTO roles VALUES("2","User","2023-06-26 12:19:08","0");



DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `mobile` text NOT NULL,
  `cnic` text NOT NULL,
  `email` text NOT NULL,
  `image_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO suppliers VALUES("1","osama khan updated","31819394800","156013188836700","rencitrade@gmail.co","supplier_images/64a1a1ea65ce7.png","2023-07-02 21:12:26","0");
INSERT INTO suppliers VALUES("2","Naveed Iqbal","89789789789","767578575785","naveedjustonline@gmail.com","supplier_images/64a67fdab6ee6.jpg","2023-07-06 13:48:26","0");



DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '1 admin 2 client/user',
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO users VALUES("1","1","naveed","admin","admin@gmail.com","1111 1111111","2222-2222222-2","users_image/60b8c7b401155.jpg","2023-05-26 01:49:27","0");
INSERT INTO users VALUES("2","2","user","user","user@gmail.com","0345669977","156014455666","","2023-06-26 12:20:31","1");



