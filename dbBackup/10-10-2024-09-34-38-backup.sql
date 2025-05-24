DROP TABLE asset_available;

CREATE TABLE `asset_available` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_item_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asset_available VALUES("1","1","3","7","700");
INSERT INTO asset_available VALUES("2","2","2","6","5");
INSERT INTO asset_available VALUES("3","3","1","5","258");
INSERT INTO asset_available VALUES("4","4","1","9","145");
INSERT INTO asset_available VALUES("5","5","1","10","210");
INSERT INTO asset_available VALUES("6","6","1","11","50");
INSERT INTO asset_available VALUES("7","13","1","12","67");



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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asset_items VALUES("1","1","3","7","1","10","500","5000","2024-03-07");
INSERT INTO asset_items VALUES("2","1","2","6","3","20000","10","200000","2024-03-07");
INSERT INTO asset_items VALUES("3","1","1","5","4","2","1000","2000","2024-03-07");
INSERT INTO asset_items VALUES("4","2","1","9","5","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("5","2","1","10","6","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("6","2","1","11","7","0","50","0","0000-00-00");
INSERT INTO asset_items VALUES("7","3","1","5","8","0","100","0","0000-00-00");
INSERT INTO asset_items VALUES("8","4","3","7","9","10","500","5000","2024-10-07");
INSERT INTO asset_items VALUES("9","5","1","9","10","0","100","0","2024-10-05");
INSERT INTO asset_items VALUES("10","5","1","10","11","0","200","0","2024-10-05");
INSERT INTO asset_items VALUES("11","5","1","11","12","0","5","0","2024-10-05");
INSERT INTO asset_items VALUES("12","6","1","5","13","1800","100","180000","2024-10-06");
INSERT INTO asset_items VALUES("13","7","1","12","14","2000","50","100000","2024-10-09");
INSERT INTO asset_items VALUES("14","8","1","9","15","20","50","1000","2024-10-08");
INSERT INTO asset_items VALUES("15","8","1","11","16","50","40","2000","2024-10-08");
INSERT INTO asset_items VALUES("16","8","1","5","17","1800","50","90000","2024-10-08");
INSERT INTO asset_items VALUES("17","8","1","12","18","1900","20","38000","2024-10-08");



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO assets VALUES("1","1001","2","207000","Add Stock","assets_images/65e9cba1c9151.png","2024-03-07");
INSERT INTO assets VALUES("2","inspecton 1","0","0","","IMAGE NOT YET ADDED","0000-00-00");
INSERT INTO assets VALUES("3","inspected dated 07 10 2024","0","0","","IMAGE NOT YET ADDED","0000-00-00");
INSERT INTO assets VALUES("4","1002","2","5000","Saqib Testing","assets_images/6703c4a873bc4.jpg","2024-10-07");
INSERT INTO assets VALUES("5","Purchase No 01","2","0","","IMAGE NOT YET ADDED","2024-10-05");
INSERT INTO assets VALUES("6","Purchase No 02","3","180000","NIL","IMAGE NOT YET ADDED","2024-10-06");
INSERT INTO assets VALUES("7","Purchase No, 3/2024","1","100000","NILL","IMAGE NOT YET ADDED","2024-10-09");
INSERT INTO assets VALUES("8","Purchase No, 4/2024","3","131000","","IMAGE NOT YET ADDED","2024-10-08");



DROP TABLE backup;

CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO backup VALUES("1","09-10-2024-10-55-21-backup.sql","2024-10-09");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO departments VALUES("1","Finance");
INSERT INTO departments VALUES("2","Audit");
INSERT INTO departments VALUES("3","Senior Civil Judge");



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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO employees VALUES("1","2","Majid updated","111111111111","222222222","majid@gmail.comupdated","DR updated","employee_images/Screenshot (7).png","2023-07-02 12:13:29","0");
INSERT INTO employees VALUES("2","1","Naveed Iqbal","3181939480","1560131888367","naveedjustonline@gmail.com","Database Administrator","employee_images/64a680f5a6d06.jpg","2023-07-06 13:53:09","0");
INSERT INTO employees VALUES("3","1","osama","967678678","56757575765","osama@gmail.com","nill","IMAGE NOT YET ADDED","2023-07-26 12:44:36","0");
INSERT INTO employees VALUES("4","2","jalal","86565675","4564646","jaal@gmail.com","nil","employee_images/64c0cf0a75b54.jpg","2023-07-26 12:45:14","0");
INSERT INTO employees VALUES("5","3","Saddam Khan","","","","JC","IMAGE NOT YET ADDED","2024-10-10 03:35:30","0");
INSERT INTO employees VALUES("6","3","Muhammad Zahir Khan","034599999999","564445454","","C/O","IMAGE NOT YET ADDED","2024-10-10 03:46:34","0");



DROP TABLE issue_asset_details;

CREATE TABLE `issue_asset_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_asset_id` bigint(20) NOT NULL,
  `available_asset_id` bigint(20) NOT NULL,
  `quantity_issue` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO issue_asset_details VALUES("4","2","1","300","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("5","2","2","5","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("6","2","3","400","2024-03-20 10:42:06");
INSERT INTO issue_asset_details VALUES("7","3","4","35","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("8","3","5","10","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("9","3","6","45","2024-10-04 01:41:00");
INSERT INTO issue_asset_details VALUES("10","4","3","590","2024-10-07 06:10:25");
INSERT INTO issue_asset_details VALUES("11","5","4","20","2024-10-10 05:32:19");
INSERT INTO issue_asset_details VALUES("12","5","3","2","2024-10-10 05:32:19");
INSERT INTO issue_asset_details VALUES("13","5","7","3","2024-10-10 05:32:19");
INSERT INTO issue_asset_details VALUES("14","5","5","30","2024-10-10 05:32:19");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO issue_assets VALUES("2","1001","2024-03-20","1","2","issue","assets_images/65fa776f824e9.jpg","2024-03-20 10:42:06");
INSERT INTO issue_assets VALUES("3","","0000-00-00","1","2","","IMAGE NOT YET ADDED","2024-10-04 01:41:00");
INSERT INTO issue_assets VALUES("4","03","0000-00-00","1","3","","IMAGE NOT YET ADDED","2024-10-07 06:10:25");
INSERT INTO issue_assets VALUES("5","Demand No. 10/24","2024-10-10","3","5","","IMAGE NOT YET ADDED","2024-10-10 05:32:19");



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

INSERT INTO item_id VALUES("1","19");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO items VALUES("5","1","Paper: Copymate","30","REM","2023-07-06 16:24:31","0");
INSERT INTO items VALUES("6","2","HP Laptop","10","piece","2023-07-06 16:24:45","0");
INSERT INTO items VALUES("7","3","files","5","piece","2023-07-06 16:25:00","0");
INSERT INTO items VALUES("8","3","Books","10","piece","2023-07-19 15:53:15","0");
INSERT INTO items VALUES("9","1","Ball Point: Black","30","Piece","2024-10-04 01:36:36","0");
INSERT INTO items VALUES("10","1","Ball Points (Blue)","30","Piece","2024-10-04 01:37:08","0");
INSERT INTO items VALUES("11","1","Ball Points (Red)","30","Piece","2024-10-04 01:37:29","0");
INSERT INTO items VALUES("12","1","Paper: Double A","20","REM","2024-10-10 03:52:53","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO suppliers VALUES("1","osama khan updated","31819394800","156013188836700","rencitrade@gmail.co","supplier_images/64a1a1ea65ce7.png","2023-07-02 21:12:26","0");
INSERT INTO suppliers VALUES("2","Naveed Iqbal","89789789789","767578575785","naveedjustonline@gmail.com","supplier_images/64a67fdab6ee6.jpg","2023-07-06 13:48:26","0");
INSERT INTO suppliers VALUES("3","Saqib","03339163563","1720167797919","saqibk276@gmail.com","supplier_images/6707874be3b29.jpg","2024-10-10 03:50:35","0");
INSERT INTO suppliers VALUES("4","Test1","","","","IMAGE NOT YET ADDED","2024-10-10 04:20:02","0");
INSERT INTO suppliers VALUES("5","Vendor 03","03469088522555","123456789124577","","IMAGE NOT YET ADDED","2024-10-10 05:28:42","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO users VALUES("1","1","naveed","admin","admin@gmail.com","1111 1111111","2222-2222222-2","users_image/60b8c7b401155.jpg","2023-05-26 01:49:27","0");
INSERT INTO users VALUES("2","2","user","user","user@gmail.com","0345669977","156014455666","","2023-06-26 12:20:31","1");
INSERT INTO users VALUES("51","2","Roman","12345","romankhanpak@yahoo.com","03469088596","1234567891234","Image NOT YET ADDED","2024-10-10 03:42:26","0");



