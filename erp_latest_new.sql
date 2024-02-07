-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2024 at 04:14 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_latest_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Softwares', 'All Kind\'s Software Paid Applications', '2023-05-11 08:21:33', '2023-05-13 02:11:59'),
(9, 'Hardware', '', '2023-05-19 04:35:55', '2023-05-19 04:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `asset_comments`
--

DROP TABLE IF EXISTS `asset_comments`;
CREATE TABLE IF NOT EXISTS `asset_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_id` int NOT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_comments`
--

INSERT INTO `asset_comments` (`id`, `asset_id`, `comments`, `comment_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'asdasdasdasd', 'admin', '2023-05-22 04:32:16', '2023-05-22 04:32:16'),
(2, 1, 'nmuiyuiyui', 'admin', '2023-05-22 04:32:23', '2023-05-22 04:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `asset_history`
--

DROP TABLE IF EXISTS `asset_history`;
CREATE TABLE IF NOT EXISTS `asset_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_id` int NOT NULL,
  `assign_asset_employee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emp_id` int NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note_history` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_history`
--

INSERT INTO `asset_history` (`id`, `asset_id`, `assign_asset_employee`, `emp_id`, `action`, `note_history`, `created_at`, `updated_at`) VALUES
(1, 1, '', 0, 'Asset Created', '', '2023-05-19 01:18:50', '0000-00-00 00:00:00'),
(2, 1, 'Hariinraj', 10, 'Asset Unassigned From employee', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00'),
(3, 1, 'Hariinraj', 10, 'Asset Assigned to Employee', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00'),
(4, 1, '', 10, 'Asset Updated', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00'),
(5, 2, '', 0, 'Asset Created', '', '2023-06-12 12:34:22', '0000-00-00 00:00:00'),
(6, 2, 'krish81', 4, 'Asset Unassigned From employee', '', '2023-06-12 12:35:28', '0000-00-00 00:00:00'),
(7, 2, 'krish81', 4, 'Asset Assigned to Employee', '', '2023-06-12 12:35:28', '0000-00-00 00:00:00'),
(8, 2, '', 4, 'Asset Updated', '', '2023-06-12 12:35:28', '0000-00-00 00:00:00'),
(9, 3, '', 0, 'Asset Created', '', '2023-06-12 12:38:26', '0000-00-00 00:00:00'),
(10, 3, 'AjmalSoft', 3, 'Asset Unassigned From employee', '', '2023-06-12 12:38:45', '0000-00-00 00:00:00'),
(11, 3, 'AjmalSoft', 3, 'Asset Assigned to Employee', '', '2023-06-12 12:38:45', '0000-00-00 00:00:00'),
(12, 4, 'krish81', 4, 'Asset Created', '', '2023-07-19 10:42:13', '0000-00-00 00:00:00'),
(13, 4, 'krish81', 4, 'Unassigned Asset Assigned to Employee', '', '2023-07-19 10:42:13', '0000-00-00 00:00:00'),
(14, 5, '', 0, 'Asset Created', '', '2023-07-19 10:44:38', '0000-00-00 00:00:00'),
(15, 5, '', 0, 'Asset Updated', '', '2023-07-19 10:47:17', '0000-00-00 00:00:00'),
(16, 5, '', 0, 'Asset Updated', '', '2023-07-19 10:47:17', '0000-00-00 00:00:00'),
(17, 5, 'krish81', 4, 'Asset Unassigned From employee', '', '2023-07-19 10:48:16', '0000-00-00 00:00:00'),
(18, 5, 'krish81', 4, 'Asset Assigned to Employee', '', '2023-07-19 10:48:16', '0000-00-00 00:00:00'),
(19, 5, '', 4, 'Asset Updated', '', '2023-07-19 10:48:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asset_management`
--

DROP TABLE IF EXISTS `asset_management`;
CREATE TABLE IF NOT EXISTS `asset_management` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `asset_modelno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit_price` int NOT NULL,
  `asset_status` int NOT NULL,
  `date_of_purchase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` int NOT NULL,
  `subcategory` int DEFAULT NULL,
  `supplier` int DEFAULT NULL,
  `department` int NOT NULL,
  `sub_department` int DEFAULT NULL,
  `date_of_manufacture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year_of_valuation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `warrenty_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `depreciation_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `assign_employee` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_management`
--

INSERT INTO `asset_management` (`id`, `asset_id`, `barcode`, `asset_modelno`, `name`, `description`, `unit_price`, `asset_status`, `date_of_purchase`, `category`, `subcategory`, `supplier`, `department`, `sub_department`, `date_of_manufacture`, `year_of_valuation`, `warrenty_month`, `depreciation_month`, `location`, `image_url`, `note`, `assign_employee`, `created_at`, `updated_at`) VALUES
(1, 'AST-040816', 'https://erp-dev.jsuitecloud.com/barcodes/AST-040816.png', 'HP123', 'HP Laptop', 'HP Pavilion Laptop', 3000, 1, '2023-05-17', 9, 9, NULL, 5, NULL, '2023-05-17', '2023-05-17', '', '', '', 'blank-asset.png', '', 10, '2023-05-19 01:18:50', '2023-05-22 06:14:14'),
(2, 'AST-020993', 'https://erp-dev.jsuitecloud.com/barcodes/AST-020993.png', 'lenovo98768', 'lenovo krish ', 'lenovo', 3000, 1, '2023-04-17', 9, 9, NULL, 5, NULL, '2023-05-17', '2023-05-17', '', '', '', 'blank-asset.png', '', 4, '2023-06-12 12:34:22', '2023-06-12 12:35:28'),
(3, 'AST-023000', 'https://erp-dev.jsuitecloud.com/barcodes/AST-023000.png', 'dell 09089', 'dell', 'dell', 4000, 1, '2023-03-17', 9, 9, NULL, 5, NULL, '2023-05-17', '2023-05-17', '', '', '', 'blank-asset.png', '', 3, '2023-06-12 12:38:26', '2023-06-12 12:38:45'),
(4, 'AST-086019', 'https://erp-dev.jsuitecloud.com/barcodes/AST-086019.png', 'LENOVO T460', 'LENOVO T460', 'laptop', 5000, 5, '2023-05-17', 9, 9, NULL, 1, NULL, '2023-05-17', '2023-05-17', '2', '', 'Ara damansara ', 'blank-asset.png', '', 4, '2023-07-19 10:42:13', '2023-07-19 10:42:13'),
(5, 'AST-087302', 'https://erp-dev.jsuitecloud.com/barcodes/AST-087302.png', 'Microsoft Office 365', 'Microsoft Office 365', 'Microsoft Office 365', 560, 1, '2023-05-17', 1, 1, NULL, 7, NULL, '2023-05-09', '2023-05-23', '', '3', 'Ara damansara ', '1689763637license1.jpg', 'License will be expired on 2024', 4, '2023-07-19 10:44:38', '2023-07-19 10:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `asset_status`
--

DROP TABLE IF EXISTS `asset_status`;
CREATE TABLE IF NOT EXISTS `asset_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_status`
--

INSERT INTO `asset_status` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Miscellaneous', 'Miscellaneous', '2023-05-12 07:04:09'),
(2, 'Expired', 'Expired', '2023-05-12 07:04:26'),
(3, 'Damage', 'Damage', '2023-05-12 07:04:53'),
(4, 'test', 'test', '2023-05-12 05:21:32'),
(5, 'New', '', '2023-05-19 04:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `asset_sub_categories`
--

DROP TABLE IF EXISTS `asset_sub_categories`;
CREATE TABLE IF NOT EXISTS `asset_sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_category` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_sub_categories`
--

INSERT INTO `asset_sub_categories` (`id`, `asset_category`, `name`, `description`, `created_at`) VALUES
(1, 0, 'IT', 'All Kind\'s Charger', '2023-05-11 08:51:03'),
(2, 1, 'testsub', 'testsubb', '2023-05-11 09:41:04'),
(3, 9, 'Laptops', '', '2023-05-19 04:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `chart_data`
--

DROP TABLE IF EXISTS `chart_data`;
CREATE TABLE IF NOT EXISTS `chart_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` varchar(10) NOT NULL,
  `month` varchar(50) NOT NULL,
  `profit` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_data`
--

INSERT INTO `chart_data` (`id`, `year`, `month`, `profit`) VALUES
(1, '2017', 'January', '50000'),
(2, '2017', 'February', '45000'),
(3, '2017', 'March', '60000'),
(4, '2017', 'April', '52000'),
(5, '2017', 'May', '67000'),
(6, '2017', 'June', '74000'),
(7, '2017', 'July', '71000'),
(8, '2017', 'August', '76000'),
(9, '2017', 'September', '80000'),
(10, '2017', 'October', '86000'),
(11, '2017', 'November', '88000'),
(12, '2017', 'December', '76000'),
(13, '2018', 'January', '92000'),
(14, '2018', 'February', '96000'),
(15, '2018', 'March', '105000'),
(16, '2018', 'April', '112000'),
(17, '2018', 'May', '120000'),
(18, '2018', 'June', '128000'),
(19, '2018', 'July', '116000'),
(20, '2018', 'August', '112000'),
(21, '2018', 'September', '129000'),
(22, '2018', 'October', '139000'),
(23, '2018', 'November', '140000'),
(24, '2018', 'December', '146000'),
(25, '2019', 'January', '151000'),
(26, '2019', 'February', '146000'),
(27, '2019', 'March', '160000'),
(28, '2019', 'April', '164000'),
(29, '2019', 'May', '185000'),
(30, '2019', 'June', '176000');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('10ghrpqo7seuu1hvt095k3bdu9uat4ka', '127.0.0.1', 1707214358, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373231343335373b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('19tlpkp1bhj8s63lm4jsfn0plijpueeo', '127.0.0.1', 1707119228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373131393232373b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('1m9ia18stnvh122u1sfe1oefdv3ieqeb', '::1', 1707212453, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373231323435313b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('2i1bshe1grd0f02dr9aeqf6fo8nuq2sa', '127.0.0.1', 1707151496, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373135313439363b),
('34itag470brm8pf8u8uj6672hofvj7j1', '::1', 1707206629, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373230363632373b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('3ob3k5mfk0fo8oh5tqk4pupn3rjfdg3o', '127.0.0.1', 1707235664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373233353636333b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('54kpqjdfpo9ts044qjl3uu2uuklgn2h9', '::1', 1707229945, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373232393934353b),
('5srcu9dhpp9eqlb9vumv06kdleiqdeb1', '127.0.0.1', 1707151785, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373135313738343b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('9m86oil7tu8c2epuk9lal3e9s5bkq0sk', '127.0.0.1', 1707205183, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373230353138333b),
('a6hvbvhgeie8q5iulbv6ojssgvscb56l', '127.0.0.1', 1707233142, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373233333134323b),
('ami0d14fld5j1kgo00uiinat7g4f7thb', '127.0.0.1', 1707128886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373132383838363b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('f3h92qbojcaqgpt6feg22o2pu173sng0', '127.0.0.1', 1707125109, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373132353130393b),
('fqjnn6bjfdvcd22frh6dqec4p6rr7sqk', '127.0.0.1', 1707114792, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373131343739323b),
('jc83g44aqtdu7fqdhni0ri9cg3ao2nc2', '127.0.0.1', 1707210796, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373231303739363b),
('mbmhs3q5ojnvdnshqe9crgrj1cgvcrb1', '127.0.0.1', 1707230030, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373233303033303b),
('ok0qet6ev7u4mokp972p1829au88792l', '::1', 1707236055, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373233363035353b),
('okrd2t5t7ieilbiqtgm1tb62vouairq6', '127.0.0.1', 1707230410, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373233303431303b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('orjtohiubssh87pdpeko5efjvg9ji7cn', '127.0.0.1', 1707119086, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373131393038363b),
('rjqe35h0c0n8gmkmibpgjetehon5pdmn', '::1', 1707128707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373132383730363b69647c733a313a2233223b757365726e616d657c733a343a2261626364223b656d61696c7c733a31343a226162636440676d61696c2e636f6d223b735f726f6c657c733a333a22725f32223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a393a22416a6d616c536f6674223b),
('ru1aqf77trk2k5e79rrveiadrnefkblt', '127.0.0.1', 1707211702, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373231313730313b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('tteocng3t968bhis72es5t3thrhmkk0e', '127.0.0.1', 1707192078, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373139323037383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('tutsk6lf702fe5hacttpsmb23pi3kn9n', '::1', 1707229945, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730373232393934353b);

-- --------------------------------------------------------

--
-- Table structure for table `digital_marketing_settings`
--

DROP TABLE IF EXISTS `digital_marketing_settings`;
CREATE TABLE IF NOT EXISTS `digital_marketing_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `digital_marketing_settings`
--

INSERT INTO `digital_marketing_settings` (`id`, `name`, `api_key`, `cr_date`) VALUES
(7, 'jsuite', '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', '2023-08-10 06:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `digital_marketing_transactional_report`
--

DROP TABLE IF EXISTS `digital_marketing_transactional_report`;
CREATE TABLE IF NOT EXISTS `digital_marketing_transactional_report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `digital_marketing_transactional_report`
--

INSERT INTO `digital_marketing_transactional_report` (`id`, `type`, `customer_source`, `customer_ids`, `subject`, `message`, `cr_date`) VALUES
(1, 'email', 'sprasad96@gmail.com', '84', 'hiii', '<p>ffff<br></p>', '2023-07-31 12:20:46'),
(2, 'sms', '9639639636', '84', '', 'hiiiiiiiiiii', '2023-07-31 12:24:33'),
(3, 'whatsapp', '123213424,9639639636', '84,83', '', 'hihihihi', '2023-07-31 12:26:08'),
(4, 'email', 'sprasad96@gmail.com', '84', 'hii', '<p>siva sent mail<br></p>', '2023-08-08 04:28:25'),
(5, 'email', 'sprasad96@gmail.com', '84', 'hiii', '<p>siva sent mail1<br></p>', '2023-08-08 04:30:40'),
(6, 'email', 'sprasad96@gmail.com', '84', 'hiii', '<p>awdkjhaskjd<br></p>', '2023-08-08 04:31:03'),
(7, 'email', 'sprasad96@gmail.com', '84', 'asdasasd', '', '2023-08-08 04:32:40'),
(8, 'email', 'sprasad96@gmail.com', '84', 'asdasasd', '', '2023-08-08 04:32:59'),
(9, 'email', 'sprasad96@gmail.com', '84', 'hii', '<p>hjgjhg&nbsp;&nbsp;&nbsp; hjghj<br></p>', '2023-08-08 04:42:26'),
(10, 'email', 'sprasad96@gmail.com', '84', 'hiiii', '', '2023-08-08 04:57:42'),
(11, 'email', 'sprasad96@gmail.com', '84', 'qwereqw', '<p>hjgjhg&nbsp;&nbsp;&nbsp; hjghjqelrjl &nbsp;&nbsp;&nbsp; wjle q<br></p>', '2023-08-08 04:59:19'),
(12, 'email', 'sprasad96@gmail.com', '84', 'hiii', 'siva praass<br>', '2023-08-08 05:02:48'),
(13, 'email', 'sprasad96@gmail.com', '84', 'hiii test', '<p>sp test<br></p>', '2023-08-08 05:04:55'),
(14, 'email', 'sprasad96@gmail.com', '84', 'hiii testdsa sd', '<p>sp testsa sda<br></p>', '2023-08-08 05:05:28'),
(15, 'sms', '9639639636', '84', '', 'hhisidsd', '2023-08-08 05:38:09'),
(16, 'sms', '919182288185', '84', '', 'hiii', '2023-08-08 05:40:58'),
(17, 'sms', '919182288185', '84', '', 'hiii siva', '2023-08-08 05:42:10'),
(18, 'sms', '919182288185', '84', '', 'hiii siva', '2023-08-08 05:42:36'),
(19, 'sms', '919182288185', '84', '', 'hiii siva', '2023-08-08 05:43:18'),
(20, 'sms', '919182288185', '84', '', 'hiii siva..', '2023-08-08 05:44:15'),
(21, 'sms', '919182288185', '84', '', 'hiii siva..', '2023-08-08 05:44:51'),
(22, 'sms', '919182288185', '84', '', 'hiii siva..', '2023-08-08 05:45:29'),
(23, 'sms', '919182288185', '84', '', 'hiii siva..', '2023-08-08 05:45:54'),
(24, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:14:40'),
(25, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:16:25'),
(26, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:16:44'),
(27, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:17:32'),
(28, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:18:18'),
(29, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:18:27'),
(30, 'whatsapp', '123213424,919182288185', '84,83', '', 'sadasd', '2023-08-08 06:18:36'),
(31, 'email', 'sprasad96@gmail.com', '84', 'hii', '<p>hi siva<br></p>', '2023-08-10 04:38:30'),
(32, 'sms', '919182288185', '84', '', 'hi siva', '2023-08-10 04:38:48'),
(33, 'whatsapp', '919182288185', '84', '', 'hiii', '2023-08-10 10:36:53'),
(34, 'sms', '919182288185', '84', '', 'hiii', '2023-08-10 10:39:07'),
(35, 'whatsapp', '919182288185', '84', '', 'hiiiii', '2023-08-10 10:39:17'),
(36, 'whatsapp', '919182288185', '84', '', 'hi siva', '2023-08-10 10:46:49'),
(37, 'email', 'sprasad96@gmail.com', '84', 'hi', '<p>test mail<br></p>', '2023-08-15 01:56:28'),
(38, 'sms', '919182288185', '84', '', 'hi siva', '2023-08-15 01:56:40'),
(39, 'whatsapp', '919182288185', '84', '', 'hi siva wa', '2023-08-15 01:56:56'),
(40, 'whatsapp', '919182288185', '84', '', 'hi wa message', '2023-08-15 01:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_accounts`
--

DROP TABLE IF EXISTS `gtg_accounts`;
CREATE TABLE IF NOT EXISTS `gtg_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `acn` varchar(35) NOT NULL,
  `holder` varchar(100) NOT NULL,
  `adate` datetime NOT NULL,
  `lastbal` decimal(16,2) DEFAULT '0.00',
  `code` varchar(30) DEFAULT NULL,
  `loc` int DEFAULT NULL,
  `account_type` enum('Assets','Expenses','Income','Liabilities','Equity','Basic') NOT NULL DEFAULT 'Basic',
  PRIMARY KEY (`id`),
  UNIQUE KEY `acn` (`acn`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_accounts`
--

INSERT INTO `gtg_accounts` (`id`, `acn`, `holder`, `adate`, `lastbal`, `code`, `loc`, `account_type`) VALUES
(1, '123456', 'Sales Account', '2018-01-01 00:00:00', '9775.93', 'Default Sales Account', 0, 'Basic');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_attendance`
--

DROP TABLE IF EXISTS `gtg_attendance`;
CREATE TABLE IF NOT EXISTS `gtg_attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adate` date NOT NULL,
  `tfrom` text NOT NULL,
  `tto` text,
  `note` int DEFAULT NULL,
  `actual_hours` varchar(255) DEFAULT NULL,
  `clock_in_latitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_in_longitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_in_location` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_in_photo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_out_latitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_out_longitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_out_location` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `clock_out_photo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`id`),
  KEY `emp` (`emp`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_attendance`
--

INSERT INTO `gtg_attendance` (`id`, `emp`, `created`, `adate`, `tfrom`, `tto`, `note`, `actual_hours`, `clock_in_latitude`, `clock_in_longitude`, `clock_in_location`, `clock_in_photo`, `clock_out_latitude`, `clock_out_longitude`, `clock_out_location`, `clock_out_photo`) VALUES
(60, 67, '2024-01-10 04:39:44', '2024-01-10', '04:11:23', '10:11:27', 0, '00:00:04', '', '', '', '', '', '', '', ''),
(61, 3, '2024-01-18 03:27:25', '2024-01-18', '03:18:22', '03:27:25', 0, '367', '', '', '', '', '', '', '', ''),
(62, 3, '2024-01-20 09:51:35', '2024-01-20', '04:15:06', '09:42:52', 0, '698', '3.1684699', '101.5333286', '40150, Jalan Uranus U5/125, Seksyen U5, 40150 Shah Alam, Selangor, Malaysia', 'C:\\wamp64\\www\\erp-dev\\userfiles\\clock_in_photos\\image_65ab979d05d49.png', '3.1683424', '101.5332159', '37, Jalan Uranus Ah U5/Aj, Subang Pelangi, 40150 Shah Alam, Selangor, Malaysia', 'C:\\wamp64\\www\\erp-dev\\userfiles\\clock_in_photos\\image_65ab959bd5255.png'),
(71, 3, '2024-01-22 07:16:39', '2024-01-22', '07:16:21', '07:16:39', 0, '00:00:17', '3.1134915', '101.5775538', '4H7H+92 Petaling Jaya, Selangor, Malaysia', 'C:\\wamp64\\www\\erp-dev\\userfiles/clock_in_photos/image_65ae1645df5fb.png', '3.1135691', '101.5775618', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'C:\\wamp64\\www\\erp-dev\\userfiles/clock_out_photos/image_65ae15bc29d6e.png'),
(75, 3, '2024-01-23 05:41:10', '2024-01-23', '07:30:00', '13:41:10', 0, '07:30:21', '3.1683766', '101.5332293', '37, Jalan Uranus Ah U5/Aj, Subang Pelangi, 40150 Shah Alam, Selangor, Malaysia', 'image_65af5161ac786.png', '3.1683966', '101.5332465', '37, Jalan Uranus Ah U5/Aj, Subang Pelangi, 40150 Shah Alam, Selangor, Malaysia', 'image_65af51768e9dc.png'),
(76, 3, '2024-01-23 05:43:50', '2024-01-23', '13:43:50', '', 0, '', '3.1684516', '101.5332601', '37, Jalan Uranus Ah U5/Aj, Subang Pelangi, 40150 Shah Alam, Selangor, Malaysia', 'image_65af5216e8d65.png', NULL, NULL, NULL, NULL),
(77, 6, '2024-01-24 06:53:34', '2024-01-24', '14:53:34', '', 0, '', '3.1135239', '101.5775311', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0b3ee37a45.png', NULL, NULL, NULL, NULL),
(78, 6, '2024-01-24 06:53:37', '2024-01-24', '14:53:37', '', 0, '', '3.1135239', '101.5775311', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0b3f1b804c.png', NULL, NULL, NULL, NULL),
(79, 6, '2024-01-24 06:53:38', '2024-01-24', '14:53:38', '', 0, '', '3.1135239', '101.5775311', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0b3f2a5c42.png', NULL, NULL, NULL, NULL),
(80, 6, '2024-01-24 06:53:38', '2024-01-24', '14:53:38', '', 0, '', '3.1135239', '101.5775311', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0b3f2d5a10.png', NULL, NULL, NULL, NULL),
(81, 6, '2024-01-24 06:53:39', '2024-01-24', '14:53:39', '', 0, '', '3.1135239', '101.5775311', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0b3f3e70f9.png', NULL, NULL, NULL, NULL),
(82, 3, '2024-01-30 11:41:00', '2024-01-24', '04:30:00', '17:51:14', 0, '07:31:10', '3.1136333', '101.5775061', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0dd4ccf182.png', '3.1136308', '101.5775084', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0dd92ba50f.png'),
(83, 3, '2024-01-24 09:35:53', '2024-01-24', '17:35:53', '', 0, '', '3.11362', '101.5775195', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0d9f9f0d29.png', NULL, NULL, NULL, NULL),
(84, 3, '2024-01-24 09:41:52', '2024-01-24', '17:41:52', '', 0, '', '3.1135197', '101.5775379', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0db605b940.png', NULL, NULL, NULL, NULL),
(85, 3, '2024-01-24 09:46:12', '2024-01-24', '17:46:12', '', 0, '', '3.1136349', '101.5775103', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0dc63f2ec2.png', NULL, NULL, NULL, NULL),
(86, 3, '2024-01-24 09:50:05', '2024-01-24', '17:50:05', '', 0, '', '3.1136333', '101.5775061', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0dd4ccf182.png', NULL, NULL, NULL, NULL),
(87, 3, '2024-01-24 09:52:44', '2024-01-24', '17:52:44', '', 0, '', '3.1136301', '101.5775054', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0ddec1dbc8.png', NULL, NULL, NULL, NULL),
(88, 6, '2024-01-24 10:13:54', '2024-01-24', '18:13:54', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2e2984d1.png', NULL, NULL, NULL, NULL),
(89, 6, '2024-01-24 10:13:58', '2024-01-24', '18:13:58', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2e6a58a2.png', NULL, NULL, NULL, NULL),
(90, 6, '2024-01-24 10:13:59', '2024-01-24', '18:13:59', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2e7cb871.png', NULL, NULL, NULL, NULL),
(91, 6, '2024-01-24 10:14:00', '2024-01-24', '18:14:00', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2e803749.png', NULL, NULL, NULL, NULL),
(92, 6, '2024-01-24 10:14:02', '2024-01-24', '18:14:02', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2ea14dca.png', NULL, NULL, NULL, NULL),
(93, 6, '2024-01-24 10:14:02', '2024-01-24', '18:14:02', '', 0, '', '3.1136155', '101.5775123', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2ea44127.png', NULL, NULL, NULL, NULL),
(94, 6, '2024-01-24 10:14:09', '2024-01-24', '18:14:09', '', 0, '', '3.1136198', '101.5775089', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2f131ad6.png', NULL, NULL, NULL, NULL),
(95, 6, '2024-01-24 10:14:21', '2024-01-24', '18:14:21', '', 0, '', '3.1136198', '101.5775089', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', 'image_65b0e2fd650b1.png', NULL, NULL, NULL, NULL),
(96, 3, '2024-01-30 12:12:11', '2024-01-25', '04:30:00', '14:29:32', 0, '04:06:48', '3.1136301', '101.5775054', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', 'image_65b0ddec1dbc8.png', '3.1683491', '101.5332591', '40150, Jalan Uranus U5/125, Seksyen U5, 40150 Shah Alam, Selangor, Malaysia', 'image_65b1ffccaa364.png'),
(97, 3, '2024-01-30 08:11:59', '2024-01-30', '07:30:00', '16:11:59', 0, '07:35:31', '3.1136421', '101.5775004', '2, Jalan PJU 1a/2, Pusat Perdagangan Dana 1, 47301 Petaling Jaya, Selangor, Malaysia', 'image_65b8ae04709fe.png', '3.1135204', '101.5775019', 'Jalan Tanpa Nama, Pusat Perdagangan Dana 1, 47301 Petaling Jaya, Selangor, Malaysia', 'image_65b8af4fb77f1.png'),
(98, 3, '2024-01-30 08:30:13', '2024-01-30', '16:30:00', '17:30:00', 0, '', '3.1136421', '101.5775004', '2, Jalan PJU 1a/2, Pusat Perdagangan Dana 1, 47301 Petaling Jaya, Selangor, Malaysia', 'image_65b8ae04709fe.png', NULL, NULL, NULL, NULL),
(99, 3, '2024-02-05 09:26:11', '2024-02-05', '17:26:11', '', 0, '', '3.11296', '101.5742464', '4H7F+5M Petaling Jaya, Selangor, Malaysia', 'image_65c0a9b350817.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_attendance_settings`
--

DROP TABLE IF EXISTS `gtg_attendance_settings`;
CREATE TABLE IF NOT EXISTS `gtg_attendance_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_working_hours` int NOT NULL,
  `clock_in_time` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_out_time` text COLLATE utf8mb4_general_ci NOT NULL,
  `ot_allowance_per_hour` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in_grace_period` int NOT NULL,
  `clock_in_checking_hours` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_attendance_settings`
--

INSERT INTO `gtg_attendance_settings` (`id`, `total_working_hours`, `clock_in_time`, `clock_out_time`, `ot_allowance_per_hour`, `clock_in_grace_period`, `clock_in_checking_hours`, `created_date`) VALUES
(1, 5, '04:43', '10:45', '2', 10, 2, '2024-01-08 07:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_attend_break`
--

DROP TABLE IF EXISTS `gtg_attend_break`;
CREATE TABLE IF NOT EXISTS `gtg_attend_break` (
  `id` int NOT NULL AUTO_INCREMENT,
  `break` varchar(100) DEFAULT NULL,
  `code` int DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `clockin` time DEFAULT NULL,
  `clockout` time DEFAULT NULL,
  `duration` varchar(255) DEFAULT '0',
  `emp` int DEFAULT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_attend_break`
--

INSERT INTO `gtg_attend_break` (`id`, `break`, `code`, `bdate`, `clockin`, `clockout`, `duration`, `emp`, `status`) VALUES
(9, 'Lunch Break', 3, '2023-05-01', '08:36:43', '11:14:16', '02:37:33', 3, 0),
(10, 'Short Break', 2, '2023-05-02', '04:37:12', '04:41:29', '00:04:17', 3, 0),
(11, 'Lunch Break', 3, '2023-05-02', '05:00:13', '00:00:00', '0', 3, 1),
(12, 'Lunch Break', 3, '2023-05-02', '06:50:30', '06:58:27', '00:07:57', 4, 0),
(13, 'Short Break', 2, '2023-05-02', '06:59:37', '07:00:03', '00:00:26', 4, 0),
(14, 'Away', 4, '2023-05-02', '07:00:06', '07:55:03', '00:54:57', 4, 0),
(15, 'Away', 4, '2023-05-02', '07:55:12', '08:17:21', '00:22:09', 4, 0),
(16, 'Away', 4, '2023-05-03', '04:19:58', '04:28:27', '00:08:29', 3, 0),
(17, 'Short Break', 2, '2023-05-03', '04:21:45', '04:42:18', '00:20:33', 4, 0),
(18, 'Short Break', 2, '2023-05-03', '11:08:53', '00:00:00', '0', 3, 1),
(23, 'Lunch Break', 3, '2023-05-05', '10:57:57', '10:58:07', '00:00:10', 3, 0),
(24, 'Away', 4, '2023-05-05', '10:58:12', '10:58:16', '00:00:04', 3, 0),
(25, 'Short Break', 2, '2023-05-05', '10:58:25', '10:58:29', '00:00:04', 3, 0),
(26, 'Short Break', 2, '2023-05-11', '04:13:06', '04:13:12', '00:00:06', 12, 0),
(27, 'Lunch Break', 3, '2023-05-11', '04:13:17', '04:13:21', '00:00:04', 12, 0),
(28, 'Away', 4, '2023-05-11', '04:13:27', '07:13:56', '03:00:29', 12, 0),
(29, 'Short Break', 2, '2023-05-16', '02:52:14', '02:52:19', '00:00:05', 12, 0),
(30, 'Away', 4, '2023-05-16', '10:26:07', '10:26:29', '00:00:22', 3, 0),
(31, 'Short Break', 2, '2023-05-17', '05:11:59', '05:13:11', '00:01:12', 12, 0),
(32, 'Lunch Break', 3, '2023-05-24', '02:29:30', '03:04:44', '00:35:14', 12, 0),
(33, 'Short Break', 2, '2023-05-24', '08:02:12', '08:03:43', '00:01:31', 12, 0),
(34, 'Short Break', 2, '2023-05-24', '08:03:46', '08:03:52', '00:00:06', 12, 0),
(35, 'Short Break', 2, '2023-05-24', '08:03:58', '08:04:07', '00:00:09', 12, 0),
(36, 'Away', 4, '2023-05-24', '08:37:44', '00:00:00', '0', 12, 1),
(37, 'Short Break', 2, '2023-05-25', '09:33:49', '09:34:00', '00:00:11', 12, 0),
(38, 'Lunch Break', 3, '2023-05-25', '09:34:07', '09:34:10', '00:00:03', 12, 0),
(39, 'Lunch Break', 3, '2023-05-25', '09:35:01', '00:00:00', '0', 12, 1),
(40, 'Short Break', 2, '2023-05-26', '01:51:05', '01:52:03', '00:00:58', 12, 0),
(41, 'Short Break', 2, '2023-05-29', '01:37:10', '01:37:13', '00:00:03', 12, 0),
(42, 'Lunch Break', 3, '2023-05-29', '01:37:15', '01:41:07', '00:03:52', 12, 0),
(43, 'Short Break', 2, '2023-05-31', '07:31:12', '07:38:46', '00:07:34', 12, 0),
(44, 'Short Break', 2, '2023-06-07', '05:18:29', '05:29:32', '00:11:03', 3, 0),
(45, 'Away', 4, '2023-06-07', '08:23:37', '08:24:01', '00:00:24', 3, 0),
(46, 'Short Break', 2, '2023-06-12', '07:06:20', '07:06:30', '00:00:10', 11, 0),
(47, 'Lunch Break', 3, '2023-06-12', '07:06:32', '07:06:34', '00:00:02', 11, 0),
(48, 'Away', 4, '2023-06-12', '07:06:35', '07:06:36', '00:00:01', 11, 0),
(49, 'Away', 4, '2023-06-12', '07:07:58', '07:13:26', '00:05:28', 11, 0),
(50, 'Short Break', 2, '2023-06-12', '07:14:06', '07:14:09', '00:00:03', 11, 0),
(51, 'Away', 4, '2023-06-12', '07:14:10', '07:14:11', '00:00:01', 11, 0),
(52, 'Lunch Break', 3, '2023-06-12', '07:14:12', '07:14:13', '00:00:01', 11, 0),
(53, 'Short Break', 2, '2023-06-13', '04:42:15', '04:42:19', '00:00:04', 24, 0),
(54, 'Short Break', 2, '2023-06-13', '08:43:02', '08:43:03', '00:00:01', 11, 0),
(55, 'Short Break', 2, '2023-06-20', '12:03:36', '12:04:21', '00:00:45', 6, 0),
(56, 'Short Break', 2, '2023-06-20', '12:04:48', '12:04:49', '00:00:01', 24, 0),
(57, 'Away', 4, '2023-06-20', '12:04:50', '12:04:51', '00:00:01', 24, 0),
(58, 'Lunch Break', 3, '2023-06-20', '12:04:52', '12:04:54', '00:00:02', 24, 0),
(59, 'Short Break', 2, '2023-06-20', '12:05:15', '12:05:48', '00:00:33', 6, 0),
(60, 'Short Break', 2, '2023-06-20', '12:07:19', '12:07:51', '00:00:32', 6, 0),
(61, 'Short Break', 2, '2023-06-20', '12:07:32', '12:07:35', '00:00:03', 24, 0),
(62, 'Lunch Break', 3, '2023-06-20', '12:07:36', '12:07:37', '00:00:01', 24, 0),
(63, 'Away', 4, '2023-06-20', '12:07:38', '12:07:39', '00:00:01', 24, 0),
(64, 'Short Break', 2, '2023-06-20', '12:09:55', '12:10:08', '00:00:13', 6, 0),
(65, 'Short Break', 2, '2023-06-20', '13:50:44', '13:50:45', '00:00:01', 24, 0),
(66, 'Away', 4, '2023-06-20', '13:50:46', '13:50:48', '00:00:02', 24, 0),
(67, 'Lunch Break', 3, '2023-06-20', '13:50:50', '13:50:53', '00:00:03', 24, 0),
(68, 'Short Break', 2, '2023-06-20', '13:51:30', '13:51:35', '00:00:05', 24, 0),
(69, 'Away', 4, '2023-06-20', '14:14:10', '14:14:12', '00:00:02', 24, 0),
(70, 'Lunch Break', 3, '2023-06-20', '14:14:14', '14:14:15', '00:00:01', 24, 0),
(71, 'Short Break', 2, '2023-06-20', '23:30:51', '23:31:06', '00:00:15', 27, 0),
(72, 'Lunch Break', 3, '2023-06-20', '23:31:14', '23:31:20', '00:00:06', 27, 0),
(73, 'Away', 4, '2023-06-20', '23:31:26', '23:31:31', '00:00:05', 27, 0),
(74, 'Short Break', 2, '2023-06-21', '07:13:58', '07:14:24', '00:00:26', 24, 0),
(75, 'Lunch Break', 3, '2023-06-21', '07:14:25', '07:14:42', '00:00:17', 24, 0),
(76, 'Away', 4, '2023-06-21', '07:14:44', '07:15:01', '00:00:17', 24, 0),
(77, 'Short Break', 2, '2023-06-21', '07:20:08', '07:20:32', '00:00:24', 24, 0),
(78, 'Short Break', 2, '2023-06-21', '07:28:29', '00:00:00', '0', 11, 1),
(79, 'Short Break', 2, '2023-06-21', '07:36:58', '07:37:08', '00:00:10', 28, 0),
(80, 'Away', 4, '2023-06-21', '07:37:22', '07:40:40', '00:03:18', 28, 0),
(81, 'Away', 4, '2023-06-21', '07:40:48', '07:40:53', '00:00:05', 28, 0),
(82, 'Short Break', 2, '2023-06-21', '11:16:48', '11:17:04', '00:00:16', 28, 0),
(83, 'Away', 4, '2023-06-21', '12:58:26', '12:58:37', '00:00:11', 28, 0),
(84, 'Lunch Break', 3, '2023-06-21', '13:36:52', '13:36:58', '00:00:06', 28, 0),
(85, 'Away', 4, '2023-06-21', '13:36:59', '13:37:09', '00:00:10', 28, 0),
(86, 'Short Break', 2, '2023-06-22', '02:05:27', '02:05:31', '00:00:04', 28, 0),
(87, 'Away', 4, '2023-06-22', '09:54:31', '09:54:40', '00:00:09', 28, 0),
(88, 'Short Break', 2, '2023-06-22', '20:51:52', '20:52:13', '00:00:21', 24, 0),
(89, 'Lunch Break', 3, '2023-06-22', '20:52:19', '20:55:13', '00:02:54', 24, 0),
(90, 'Short Break', 2, '2023-06-22', '20:55:52', '20:56:12', '00:00:20', 24, 0),
(91, 'Short Break', 2, '2023-06-22', '20:56:24', '00:00:00', '0', 24, 1),
(92, 'Short Break', 2, '2023-06-23', '02:45:58', '02:46:01', '00:00:03', 28, 0),
(93, 'Away', 4, '2023-06-23', '02:46:15', '02:46:17', '00:00:02', 28, 0),
(94, 'Lunch Break', 3, '2023-06-23', '02:46:25', '02:46:27', '00:00:02', 28, 0),
(95, 'Away', 4, '2023-06-23', '02:46:33', '03:01:48', '00:15:15', 28, 0),
(96, 'Short Break', 2, '2023-06-23', '03:01:56', '03:01:57', '00:00:01', 28, 0),
(97, 'Away', 4, '2023-06-23', '03:01:58', '03:02:00', '00:00:02', 28, 0),
(98, 'Lunch Break', 3, '2023-06-23', '03:02:01', '03:02:02', '00:00:01', 28, 0),
(99, 'Short Break', 2, '2023-06-27', '08:59:49', '08:59:51', '00:00:02', 28, 0),
(100, 'Away', 4, '2023-06-27', '08:59:52', '08:59:53', '00:00:01', 28, 0),
(101, 'Away', 4, '2023-06-27', '08:59:56', '10:08:23', '01:08:27', 28, 0),
(102, 'Short Break', 2, '2023-07-05', '14:40:22', '14:40:28', '00:00:06', 28, 0),
(103, 'Lunch Break', 3, '2023-07-05', '14:40:29', '14:40:31', '00:00:02', 28, 0),
(104, 'Away', 4, '2023-07-05', '14:40:32', '14:40:33', '00:00:01', 28, 0),
(105, 'Short Break', 2, '2023-12-19', '04:16:43', '04:20:58', '00:04:15', 50, 0),
(106, 'Short Break', 2, '2023-12-19', '04:21:07', '04:21:10', '00:00:03', 50, 0),
(107, 'Lunch Break', 3, '2023-12-19', '04:21:15', '04:21:19', '00:00:04', 50, 0),
(108, 'Away', 4, '2023-12-19', '04:21:24', '04:21:28', '00:00:04', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_bank_ac`
--

DROP TABLE IF EXISTS `gtg_bank_ac`;
CREATE TABLE IF NOT EXISTS `gtg_bank_ac` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acn` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `enable` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_bank_ac`
--

INSERT INTO `gtg_bank_ac` (`id`, `name`, `bank`, `acn`, `code`, `note`, `address`, `branch`, `enable`) VALUES
(1, 'test', '', '123456789p[', '2345678', 'test', 'dfghjkl;kljgh', 'test', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_break_time`
--

DROP TABLE IF EXISTS `gtg_break_time`;
CREATE TABLE IF NOT EXISTS `gtg_break_time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `btime` time NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_break_time`
--

INSERT INTO `gtg_break_time` (`id`, `btime`, `name`) VALUES
(2, '00:15:00', 'Short Break'),
(3, '01:00:00', 'Lunch Break'),
(4, '00:05:00', 'Away');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_config`
--

DROP TABLE IF EXISTS `gtg_config`;
CREATE TABLE IF NOT EXISTS `gtg_config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `val1` varchar(50) NOT NULL,
  `val2` varchar(200) NOT NULL,
  `val3` varchar(100) NOT NULL,
  `val4` varchar(100) NOT NULL,
  `rid` int NOT NULL,
  `other` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_config`
--

INSERT INTO `gtg_config` (`id`, `type`, `val1`, `val2`, `val3`, `val4`, `rid`, `other`) VALUES
(1, 2, 'yes', '22', 'inclusive', 'inclusive', 0, 0),
(2, 2, 'no', '10', 'inclusive', 'yes', 0, 0),
(3, 2, 'afsafs', '45', 'yes', 'yes', 0, 0),
(4, 2, 'yes11', '222', 'yes', 'yes', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_contract`
--

DROP TABLE IF EXISTS `gtg_contract`;
CREATE TABLE IF NOT EXISTS `gtg_contract` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `client_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reminder_date` date NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('PENDING','INPROGRESS','COMPLETED') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_link` text COLLATE utf8mb4_general_ci NOT NULL,
  `contract_unique_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `sharing_count` int NOT NULL,
  `client_id` int NOT NULL,
  `cr_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_contract`
--

INSERT INTO `gtg_contract` (`id`, `name`, `start_date`, `end_date`, `client_name`, `pic`, `email`, `phone`, `reminder_date`, `remarks`, `status`, `updated_on`, `share_link`, `contract_unique_id`, `sharing_count`, `client_id`, `cr_date`) VALUES
(5, 'jhkjhkj', '2024-01-05', '2023-12-12', 'Shafeek Ajmal ', 'hjgjgj', 'sprasad96@gmail.com', '741741741', '2024-01-05', 'hghjggj', 'INPROGRESS', '2023-12-03 21:49:00', 'https://localhost/erp-dev/billing/contract_share_view?id=5&token=aab84c21527eb389e8a776b641f5d6b71fc8cec9', 'CON08600', 4, 1, '0000-00-00 00:00:00'),
(6, 'jhkjhkj', '2024-01-05', '2023-12-11', 'Shafeek Ajmal ', 'hjgjgj', 'sprasad96@gmail.com', '741741741', '2024-01-05', 'hghjggj', 'INPROGRESS', '2023-12-03 21:49:00', 'https://localhost/erp-dev/billing/contract_share_view?id=5&token=aab84c21527eb389e8a776b641f5d6b71fc8cec9', 'CON08600', 4, 1, '2023-12-12 08:59:09'),
(7, 'qqqq', '2025-01-05', '2029-12-12', 'Hasan Prasetyo ', 'eeeeee', 'sprasad96@gmail.com', '741741741', '2024-01-05', 'hghjggj', 'PENDING', '2023-12-12 01:37:28', 'https://localhost/erp-dev/billing/contract_share_view?id=5&token=aab84c21527eb389e8a776b641f5d6b71fc8cec9', 'CON74125', 4, 12, '2023-12-12 08:59:19'),
(8, 'www', '2024-01-05', '2023-12-13', 'sdfas ', 'ssss', 'sprasad96@gmail.com', '741741741', '2024-01-05', 'eeeeee', 'INPROGRESS', '2023-12-12 01:38:47', 'https://localhost/erp-dev/billing/contract_share_view?id=5&token=aab84c21527eb389e8a776b641f5d6b71fc8cec9', 'CON08600', 4, 19, '2023-12-12 08:59:19'),
(9, 'ghj', '2024-02-15', '2026-01-15', 'jh ', 'k', 'mhghgjh@sadf.ff', '7417417417', '2025-01-15', 'jhjhk', 'INPROGRESS', '2023-12-13 16:49:42', 'https://localhost/erp-dev/billing/contract_share_view?id=9&token=79dab0ca19350f7a78e33b2b7dd850b06acdcc9d', 'CON90060', 1, 98, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_contract_signings`
--

DROP TABLE IF EXISTS `gtg_contract_signings`;
CREATE TABLE IF NOT EXISTS `gtg_contract_signings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contract_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `signed_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `contract_remarks` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` text COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_countries`
--

DROP TABLE IF EXISTS `gtg_countries`;
CREATE TABLE IF NOT EXISTS `gtg_countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_countries`
--

INSERT INTO `gtg_countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TL', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GG', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'YT', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Eswatini'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_currencies`
--

DROP TABLE IF EXISTS `gtg_currencies`;
CREATE TABLE IF NOT EXISTS `gtg_currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `symbol` varchar(3) DEFAULT NULL,
  `rate` decimal(10,5) NOT NULL,
  `thous` char(1) DEFAULT NULL,
  `dpoint` char(1) NOT NULL,
  `decim` int NOT NULL,
  `cpos` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_customers`
--

DROP TABLE IF EXISTS `gtg_customers`;
CREATE TABLE IF NOT EXISTS `gtg_customers` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `roc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `incharge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'example.png',
  `gid` int NOT NULL DEFAULT '1',
  `company` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taxid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` decimal(16,2) DEFAULT '0.00',
  `loc` int DEFAULT '0',
  `docid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discount_c` decimal(16,2) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_customers`
--

INSERT INTO `gtg_customers` (`id`, `name`, `phone`, `address`, `roc`, `incharge`, `city`, `region`, `country`, `postbox`, `email`, `picture`, `gid`, `company`, `taxid`, `name_s`, `phone_s`, `email_s`, `address_s`, `city_s`, `region_s`, `country_s`, `postbox_s`, `balance`, `loc`, `docid`, `custom1`, `discount_c`, `reg_date`, `customer_type`) VALUES
(1, 'Shafeek Ajmal', '07042121686', '414 Krishna enclave', '', '', 'Zirakpur', 'Punjab', 'India', '140603', 'sprasad96@gmail.com', 'cutsm_upl_1678713658.jpg', 2, 'Jsoftsolution', '', 'Shafeek Ajmal', '07042121686', 'ajmalshafeek@gmail.com', '414 Krishna enclave', 'Zirakpur', 'Punjab', 'India', '140603', '611.50', 0, '', '', '0.00', '2023-10-17 05:54:26', ''),
(10, 'Jsoftsolution', '07042121686', '414 Krishna enclave', '', '', 'Mohali', 'An', 'India', '53453', 'shafeekajmal@hotmail.com', 'example.png', 2, 'Jsoftsolution', '3213', 'Jsoftsolution', '07042121686', 'shafeekajmal@hotmail.com', '414 Krishna enclave', 'Mohali', 'gdfgfd', 'India', '53453', '0.00', 0, '3123', '', '12.00', '2023-06-07 08:41:43', ''),
(11, 'Raj', '60146291291', 'No 40, Oasis Square, Business Park', '', '', 'Kuala Lumpur', 'Wilayah Persekutuan', 'Malaysia', '51000', 'hariinraj29@gmail.com', 'cutsm_upl_1678783768.jpg', 1, 'HR HiTech Services', '', 'Raj', '60146291291', 'hariinraj29@gmail.com', 'No 40, Oasis Square, Business Park', 'Kuala Lumpur', 'Wilayah Persekutuan', 'Malaysia', '51000', '137.00', 0, '', '', '0.00', '2023-07-10 09:22:21', ''),
(12, 'Hasan Prasetyo', '62 21 6541961', 'Jl. Bandara Lama ', '', '', 'Mandai', 'Maros', 'Indonesia', '90552', 'hasan@ap1.co.id', 'cutsm_upl_1678785087.jpg', 1, 'Angkasa Pura', '', 'Hasan Prasetyo', '62 21 6541961', 'hasan@ap1.co.id', 'Jl. Bandara Lama ', 'Mandai', 'Maros', 'Indonesia', '90552', '0.00', 0, '', '', '0.00', '2023-03-14 09:11:27', ''),
(13, 'Wulandari Hartono', '021 5084 3888', 'Jl. Jenderal Sudirman Kav 5-6', '', '', 'Daerah Khusus Ibukota', 'Jakarta ', 'Indonesia', '10220', 'wulandari@ai.astra.co.id', 'cutsm_upl_1678785213.jpg', 1, 'Astra International', '', 'Wulandari Hartono', '021 5084 3888', 'wulandari@ai.astra.co.id', 'Jl. Jenderal Sudirman Kav 5-6', 'Daerah Khusus Ibukota', 'Jakarta ', 'Indonesia', '10220', '0.00', 0, '', '', NULL, '2023-03-14 09:13:33', ''),
(14, 'Budi Darmawan', '62 31 5480500', 'Ciputra World, Office Tower, Jl. Mayjen Sungkono N', '', '', ' Surabaya City', 'East Java', 'Indonesia', '60224', 'krshmathavan@gmail.com', 'cutsm_upl_1678785396.jpg', 1, 'D-net', '', 'Budi Darmawan', '62 31 5480500', 'krshmathavan@gmail.com', 'Ciputra World, Office Tower, Jl. Mayjen Sungkono No.89, RT.008/RW.006,', ' Surabaya City', 'East Java', 'Indonesia', '60224', '0.00', 0, '', '', '0.00', '2023-03-24 22:57:34', ''),
(15, 'Febriyanto Wijaya', '62 21 2566 9000', '7 Boulevard Palem Raya #22-00 Menara Matahari,Lipp', '', '', 'Tangerang', 'Banten', 'Indonesia', '15811', 'febriyanto@lippokarawaci.co.id', 'cutsm_upl_1678785482.jpg', 1, 'Lippo Group ', '', 'Febriyanto Wijaya', '62 21 2566 9000', 'febriyanto@lippokarawaci.co.id', '#24-00 Menara Matahari,Lippo Karawaci Central,  ', 'Tangerang', 'Banten', 'Indonesia', '15811', '0.00', 0, '', '', NULL, '2023-03-14 09:18:02', ''),
(16, 'G Krishna', '6013456789', 'C-3-16, Centum @ Oasis Corporate Park, 2, Jalan PJ', '', '', 'KL', 'WP', 'Malaysia', '47301', 'testingjsoft@gmail.com', 'example.png', 1, 'GK Sdn Bhd', '', 'G Krishna', '6013456789', 'testingjsoft@gmail.com', 'C-3-16, Centum @ Oasis Corporate Park, 2, Jalan PJU 1a/2, Oasis Ara Damansara, 47301 Petaling Jaya, ', 'KL', 'WP', 'Malaysia', '47301', '0.00', 0, '', '', NULL, '2023-03-27 04:56:17', ''),
(17, 'ascs', '9677660842', '', '', '', '', '', '', '', 'krisdddh@smartoffice.my', 'example.png', 1, 'ascac', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-05-12 01:35:34', ''),
(18, 'udhaykumar', 'asdasd', '', '', '', '', '', '', '', 'asdasfffd@mail.com', 'example.png', 1, 'asdasd', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', '0.00', '2023-05-18 10:25:05', ''),
(19, 'sdfas', '245235235235', 'safasf', '345345', 'werwerwer', NULL, NULL, NULL, NULL, 'admin@gmail.com', 'example.png', 1, 'sdfas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-01 20:05:21', ''),
(20, 'sadd', '234234234', 'asdasd', '324234', '324234', NULL, NULL, NULL, NULL, 'krish@smartoffice.my', 'example.png', 1, 'sadd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-01 20:08:28', ''),
(21, 'asdasd', '234124124', 'asdasd', '34234', 'sdsdasd', NULL, NULL, NULL, NULL, 'krish@smartoffice.my', 'example.png', 1, 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-01 20:10:01', ''),
(22, 'asdsadasd', '34234234', 'asdasdasd', '234234', 'dwerwer', NULL, NULL, NULL, NULL, 'admin@gmail.com', 'example.png', 1, 'asdsadasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-01 20:10:53', ''),
(23, 'sdasd', '24234234', 'asdasd', '34234', 'dfsdff', NULL, NULL, NULL, NULL, 'krish@smartoffice.my', 'example.png', 1, 'sdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-01 20:12:19', ''),
(24, 'sdasd', '234234234', 'asdasd', '234234', 'sdfsdf', NULL, NULL, NULL, NULL, 'krish@smartoffice.my', 'example.png', 1, 'sdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-02 11:10:43', 'forgein'),
(25, 'JSOFT SOLUTION SDN BHD', '+60125509210', 'Level 15 , DPluze', '', '', 'Cyberjaya', 'Selangor', 'Malaysia', '', 'krish@jsoftsolution.com.my', 'example.png', 1, 'JSOFT SOLUTION SDN BHD', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-07 21:18:01', ''),
(26, 'testinternational', '9677660842', 'no 36-2', '12345', 'raj', NULL, NULL, NULL, NULL, 'testint@gmail.com', 'example.png', 1, 'testinternational', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-08 10:11:06', 'foreign'),
(27, 'testcompany', '9677660842', 'no 36 anna street', '345345345', 'incharge', NULL, NULL, NULL, NULL, 'udhyay@gmail.com', 'example.png', 1, 'testcompany', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-08 12:51:48', 'foreign'),
(28, 'John', '60146291291', 'c-1-3 Ara Damandsara', '', '', 'KL', 'Wilayah Persekutuan', 'Malaysia', '50600', 'john@gmail,com', 'example.png', 1, 'ABC SDN BHD', '', 'John', '60146291291', 'john@gmail,com', 'c-1-3 Ara Damandsara', 'KL', 'Wilayah Persekutuan', 'Malaysia', '50600', '0.00', 0, '', '', NULL, '2023-06-09 10:37:09', ''),
(30, 'DEV Sdn Bhd', '0145381381', 'No 40 Damansara', '12345678', 'Peter', NULL, NULL, NULL, NULL, 'peter@gmail.com', 'example.png', 1, 'DEV Sdn Bhd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-09 13:56:13', 'foreign'),
(31, 'testtoday', '7092150290', 'no 36 annastreet', '34234234', 'udhay', NULL, NULL, NULL, NULL, 'test123@gmail.com', 'example.png', 1, 'testtoday', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-10 04:47:48', 'foreign'),
(32, 'sample', '9677660842', 'no 36 annastreet', '2342344', 'krish', NULL, NULL, NULL, NULL, 'sample@gmail.com', 'example.png', 1, 'sample', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-10 05:37:10', 'foreign'),
(33, 'puteri ', '123457890', 'shah alam ', '', '', 'Shah  alam ', 'sel ', 'malaysia ', '', 'sales@jsoftsolution.com.my', 'example.png', 1, 'PUTERI SHAH ALAM ', '', 'puteri ', '123457890', 'sales@jsoftsolution.com.my', 'shah alam ', 'Shah  alam ', 'sel ', 'malaysia ', '', '0.00', 0, '', '', '0.00', '2023-06-12 02:42:45', ''),
(34, 'newtest', '9994244797', 'no 36 annastreet', '453453', 'nanthu', NULL, NULL, NULL, NULL, 'newtest@gmail.com', 'example.png', 1, 'newtest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-12 02:56:56', 'foreign'),
(35, 'Sim', '60146291291', 'B-1-7 KKKA JLN U-THANT', '', '', 'Melaka ', 'KL', 'Malaysia', '54000', 'sim@gmail.com', 'example.png', 1, 'ZXC Sdn Bhd', '1e23e23', 'Sim', '60146291291', 'sim@gmail.com', 'B-1-7 KKKA JLN U-THANT', 'Melaka ', 'KL', 'Malaysia', '54000', '0.00', 0, '', '', NULL, '2023-06-13 10:01:25', ''),
(36, 'Benjamin', '0143441502', '5, Jalan Sri Putra 1, Taman Sri Putra', '', '', 'Johor Bharu', 'Johor', 'Malaysia', '81200', 'benjamin@kenchanasukma.com', 'example.png', 1, 'Kenchana Sukma Ventures', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-15 09:18:57', ''),
(37, 'Vin', '0126163600', 'B3-1-3 Solaris Dutamas No.1 Jalan Dutamas 1, ', '', '', 'Publika', 'Dutamas', 'Malaysia', '50480', 'vin@aerotechlogistics.com.my', 'example.png', 1, 'Aerotech Logistics', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-15 09:24:10', ''),
(38, 'Esther Chan', '0129811591', 'level15, Tower C, Megan Avenue 2', '', '', '12, Jalan Yap Kwan Seng', 'Kuala Lumpur', 'Malaysia', '50450', 'esther.chan@crown.my', 'example.png', 1, 'Crowe KL Tax Mei Yee', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-15 09:27:18', ''),
(39, 'Ivy Loh', '0127599079', 'c-22-5 Empire Damansara', '', '', 'Jalan pju8/8A', 'Damansara Perdana ', 'Malaysia', '47820', 'ivy.loh@dreamtalents.com', 'example.png', 1, 'Dream Talents Media Sdn Bhd', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-15 09:32:48', ''),
(40, 'Mohd Nor Azlan', '0122728560', 'Bahagian Jualan, Tingkat 2, ', '', '', 'Kompleks pkns ', 'Shah Alam ', 'Malaysia', '40505', 'azlannorri@pkns.gov.my', 'example.png', 1, 'PKFZ', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-06-15 09:36:40', ''),
(41, 'jsofttest', '9677660843', 'bkhl', '345345', 'harinn', NULL, NULL, NULL, NULL, 'jsofttest@gmail.com', 'example.png', 1, 'jsofttest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-30 09:40:13', 'foreign'),
(42, 'democlient', '8056030980', 'test', 'test', 'test', NULL, NULL, NULL, NULL, 'democlient@gmail.com', 'example.png', 1, 'democlient', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-07-03 02:17:46', 'foreign'),
(43, 'Sparow', '0123456789', 'M01 Saujana ', '', '', 'Damansara Damai', 'pj', 'Malaysia', '47830', 'sparow@gmail.com', 'example.png', 1, 'Dog with love sdn bhd', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-06 09:36:50', ''),
(44, 'testclientp', '7092150290', 'no 36 annastreet', '12312313', 'testtt', NULL, NULL, NULL, NULL, 'testclientp@gmail.com', 'example.png', 1, 'testclientp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-07-12 08:06:00', 'foreign'),
(45, 'akerp', '9677660842', 'no 36 annastreet', '', '', 'test', 'test', 'test', '625002', 'akerpsolutions@gmail.com', 'example.png', 1, 'akerpsolutions', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-12 08:10:42', ''),
(47, 'Kali D', '0123456789', 'Centrum ', '', '', 'Damansara', 'Selangor', 'Malaysia', '43000', 'kali@gmail.com', 'example.png', 1, 'CNTrix SDN BHD', '1122334455', 'Kali D', '0123456789', 'kali@gmail.com', 'Centrum ', 'Damansara', 'Selangor', 'Malaysia', '43000', '0.00', 0, '2233445566', 'test', NULL, '2023-07-12 13:13:40', ''),
(48, 'DEXTER SDN BHD', '01243546578', 'Dex Arena', '123456789', 'Dexter Lab', NULL, NULL, NULL, NULL, 'dex@gmail.com', 'example.png', 1, 'DEXTER SDN BHD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-07-12 13:19:49', 'foreign'),
(49, 'testcmpny', '97686788888', 'asdasdas, Royal Colony, Humayun Nagar, Hyderabad, ', '12312313', '', NULL, NULL, NULL, NULL, 'krddish@smartoffice.my', 'example.png', 1, 'ASdad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-07-14 05:52:13', 'foreign'),
(50, 'DATO SHARAN J VALIRAM', '0323809888', 'Wisma Uoa 2, 21, Jalan Pinang, Kuala Lumpur, Feder', '123123123', 'SHARON', '', '', '', '', 'sharon@gmail.com', 'example.png', 1, 'VALIRAM', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', '0.00', '2023-07-19 09:15:26', 'foreign'),
(51, 'Mr.Subra', '012664859', 'H-03-01 BLOCK H JALAN PPK1, PUSAT PERNIAGAAN KINRA', '', '', 'PUCHONG ', 'SELANGOR ', 'MALAYSIA', '47100', 'subra@newtechcleaning.com.my', 'example.png', 1, 'NEW TECH CLEANING & MAINTAINANCE SERVICES', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-14 10:23:20', ''),
(53, 'Rai', '0124356456', 'Hilton Kuala Lumpur, Jalan Stesen Sentral, Kuala L', '', '', 'Kuala Lumpur', 'Wilayah Persekutuan Kuala Lump', 'Malaysia', '50470', 'rai@gmail.com', 'example.png', 1, 'RI Sdn Bhd', '', 'Rai', '0124356456', 'rai@gmail.com', 'Hilton Kuala Lumpur, Jalan Stesen Sentral, Kuala Lumpur Sentral, Kuala Lumpur, Federal Territory of ', 'Kuala Lumpur', 'Wilayah Persekutuan Kuala Lumpur', 'Malaysia', '50470', '0.00', 0, '', '', NULL, '2023-07-14 10:57:50', ''),
(54, 'PT WASTE RECYCLING INDUSTRY ', '0169363439', '13, jalan im 3/3 Mahkota Industry Park', '', '', 'Kuantan', 'Pahang', 'Malaysia', '25200', 'pantaitimurmetal@gmail.com', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, '', '', NULL, '2023-07-14 13:46:23', ''),
(55, 'PT WASTE RECYCLING INDUSTRY ', '0169363439', '13, jalan im 3/3 Mahkota Industry Park', '', '', 'Kuantan', 'Pahang', 'Malaysia', '25200', 'pantaitimurmetal@gmail.com', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, '', '', NULL, '2023-07-14 13:46:41', ''),
(56, 'PT WASTE RECYCLING INDUSTRY ', '0169363439', '13, jalan im 3/3 Mahkota Industry Park', '', '', 'Kuantan', 'Pahang', 'Malaysia', '25200', 'pantaitimurmetal@gmail.com', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, '', '', NULL, '2023-07-14 13:46:50', ''),
(57, 'PT WASTE RECYCLING INDUSTRY ', '0169363439', '13, jalan im 3/3 Mahkota Industry Park', '', '', 'Kuantan', 'Pahang', 'Malaysia', '25200', 'pantaitimurmetal@gmail.com', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, '', '', NULL, '2023-07-14 13:46:51', ''),
(58, 'PT WASTE RECYCLING INDUSTRY ', '0169363439', '13, jalan im 3/3 Mahkota Industry Park', '', '', 'Kuantan', 'Pahang', 'Malaysia', '25200', 'pantaitimurmetal@gmail.com', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, '', '', NULL, '2023-07-14 13:46:54', ''),
(59, 'harry', '0123456789', '23/1, Jalan Alor, Bukit Bintang, Kuala Lumpur, Fed', '', '', 'Kuala Lumpur', 'Wilayah Persekutuan Kuala Lump', 'Malaysia', '50200', 'harry@gmail.com', 'example.png', 1, 'Harry Sdn Bhd', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-17 08:55:36', ''),
(75, 'Sathias ', '0829289', 'Puchong Utama, Puchong, Selangor, Malaysia', '', '', 'Puchong', 'Selangor', 'Malaysia', '47100', 'sathia@gmail.com', '16897590031755552802 (1).jpeg', 1, 'Sathias Trading ', '', '', '', '', '', '', '', '', '', '2000.00', 0, '', '', NULL, '2023-07-19 09:30:03', ''),
(76, 'rajkapoor', '8056030981', 'Nơ Trang Long, Bình Thạnh, Ho Chi Minh City, Vietn', '', '', 'vietnam', 'Thành phố Hồ Chí Minh', 'Vietnam', '', 'rajkapoorsolutions@gmail.com', 'example.png', 1, 'rajkapoorsolutions', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 09:55:58', ''),
(77, 'testjsoft', '9994244777', '123 William Street, New York, NY, USA', '', '', 'New York', 'New York', 'United States', '3804', 'testjsoftsolutions@gmail.com', 'example.png', 1, 'testjsoftsolutions', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 09:59:44', ''),
(78, 'asdxcasdas', '345345345', 'London, UK', '', '', 'London', 'England', 'United Kingdom', '', 'sdfsdfsdf@smartoffice.my', 'example.png', 1, 'asdasdasd', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 10:02:43', ''),
(79, 'xzcvzzcvxc', '8056030979', 'London, UK', '', '', 'London', 'England', 'United Kingdom', '', 'ewrwerwer@gmail.com', 'example.png', 1, 'xcvzxcvzxcv', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 10:05:31', ''),
(80, 'sfdsdfsd', '8056040980', 'Las Vegas, NV, USA', '', '', 'Las Vegas', 'Nevada', 'United States', '', 'udhvvvvvvvvvayase@gmail.com', 'example.png', 1, 'sdfsdf', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 10:08:03', ''),
(81, 'sfdsdfsd', '8056040980', 'London, UK', '', '', 'London', 'England', 'United Kingdom', '', 'mkklopjhhhhh@gmail.com', 'example.png', 1, 'sdfsdf', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 10:12:03', ''),
(82, 'bdfbvsdfb', '7969679699', 'Los Angeles, CA, USA', '', '', 'Los Angeles', 'California', 'United States', '', 'bdfbvsdfb@gmail.com', 'example.png', 1, 'dfbdfb', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-07-19 10:16:10', ''),
(83, ' Devin', '919032992054', 'Kelana Jaya, SS7, Petaling Jaya, Selangor, Malaysi', '', '', 'Petaling Jaya', 'Selangor', 'Malaysia', '', 'devin@gmail.com', 'example.png', 1, 'Maccilect Bhd ', '', ' Devin', '123213424', 'devin@gmail.com', 'Kelana Jaya, SS7, Petaling Jaya, Selangor, Malaysi', 'Petaling Jaya', 'Selangor', 'Malaysia', '', '0.00', 0, '', '', '0.00', '2023-08-30 06:24:03', ''),
(84, 'sivaprasad', '919182288185', 'Jgali, Georgia', '', '', 'Jgali', 'Samegrelo Zemo Svan', 'Georgia', '741741', 'sprasad96@gmail.com', 'example.png', 1, 'test company', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-08-08 05:40:45', ''),
(85, 'asrfafg', '', 'Fhgftvd، Erbil, Iraq', '', '', 'Erbil', 'Erbil Governorate', 'Iraq', '44001', 'hgfgh@dvhf.dfd', 'example.png', 1, 'hgj', 'hgh', 'asrfafg', '', 'hgfgh@dvhf.dfd', 'Fhgftvd، Erbil, Iraq', 'Erbil', 'Erbil Governorate', 'Iraq', '44001', '0.00', 0, '', '', NULL, '2023-09-07 07:51:26', ''),
(86, 'asrfafg', '', 'Fhgftvd، Erbil, Iraq', '', '', 'Erbil', 'Erbil Governorate', 'Iraq', '44001', 'hgfgh@dvhf.dfd', 'example.png', 1, 'hgj', 'hgh', 'asrfafg', '', 'hgfgh@dvhf.dfd', 'Fhgftvd، Erbil, Iraq', 'Erbil', 'Erbil Governorate', 'Iraq', '44001', '0.00', 0, '', '', NULL, '2023-09-07 07:51:56', ''),
(87, 'jhkjhkjhkj', '9639639639', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly', '', '', 'Bengaluru', 'Karnataka', 'India', '560049', 'gfghfgh@sdfasaf.sdd', 'example.png', 1, '', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 07:52:32', ''),
(88, 'jhkjhkjhkj', '9639639639', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly', '', '', 'Bengaluru', 'Karnataka', 'India', '560049', 'gfghfgh@sdfasaf.sdd', 'example.png', 1, '', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 07:54:57', ''),
(89, 'jhkjhkjhkj', '9639639639', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly', '', '', 'Bengaluru', 'Karnataka', 'India', '560049', 'gfghfgh@sdfasaf.sdd', 'example.png', 1, '', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 07:56:19', ''),
(90, 'hjghjghj', '', 'Jagakarsa, South Jakarta City, Jakarta, Indonesia', '', '', 'jhhjgj', 'hjhkjhkj', 'hkj', 'hkjh', 'hjghjgj@jgh.ddd', '17060790271820864541(1).png', 1, 'kjh', 'kjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2024-01-24 06:50:27', ''),
(91, 'hjghjghj', '', 'Jagakarsa, South Jakarta City, Jakarta, Indonesia', '', '', 'jhhjgj', 'hjhkjhkj', 'hkj', 'hkjh', 'hjghjgj@jgh.ddd', 'example.png', 1, 'kjh', 'kjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 07:59:41', ''),
(92, 'hjghjghj', '', 'Jagakarsa, South Jakarta City, Jakarta, Indonesia', '', '', 'jhhjgj', 'hjhkjhkj', 'hkj', 'hkjh', 'hjghjgj@jgh.ddd', 'example.png', 1, 'kjh', 'kjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 08:07:23', ''),
(93, 'hjghjghj', '', 'Jagakarsa, South Jakarta City, Jakarta, Indonesia', '', '', 'jhhjgj', 'hjhkjhkj', 'hkj', 'hkjh', 'hjghjgj@jgh.ddd', 'example.png', 1, 'kjh', 'kjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 08:07:58', ''),
(94, 'aeawfasdf', '', 'jghhjgjhg', '', '', 'hjg', 'hjghj', 'gjhg', 'hj', 'hjghjgj@jgh.ddd', 'example.png', 1, 'gh', 'j', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 08:09:04', ''),
(95, 'hjg', '', 'gjhgjhg', '', '', 'hj', 'hghjg', 'jhgh', 'hjg', 'ghjdsf@sad.df', 'example.png', 1, 'jhg', 'hjg', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 08:10:00', ''),
(96, 'jhghj', '', 'hjg', '', '', 'jh', 'gf', 'ghfh', 'gfgh', 'gjhg@sdaf.sadf', 'example.png', 1, 'fhg', 'fh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-07 08:11:06', ''),
(97, 'ghhjgHJGHJGhjgjh', '9032992056', 'Kjellerup, Denmark', '', '', 'Kjellerup', 'jhgjj', 'Denmark', '8620', 'hghjG@sdf.fgf', 'example.png', 1, 'hkjh', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 02:42:34', ''),
(98, 'jh', '7417417417', 'HH2A Linh Đàm, Hoàng Liệt, Hoàng Mai, Hanoi, Vietn', '', '', 'khghjgjhGHJG', 'Hà Nội', 'Vietnam', 'ghjgjh', 'mhghgjh@sadf.ff', 'example.png', 1, 'kjhkjhh', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 02:44:08', ''),
(99, 'ghfhfh', '', 'hgg', '', '', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', 'fghfhgfghf@aadf.hjg', 'example.png', 1, 'gjh', 'gjhg', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 04:58:31', ''),
(100, 'ghfhfh', '', 'hgg', '', '', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', 'fghfhgfghf@aadf.hjg', 'example.png', 1, 'gjh', 'gjhg', 'ghfhfh', '', 'fghfhgfghf@aadf.hjg', 'hgg', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', '0.00', 0, '', '', NULL, '2023-09-08 04:58:44', ''),
(101, 'ghfhfh', '', 'hgg', '', '', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', 'fghfhgfghf@aadf.hjg', 'example.png', 1, 'gjh', 'gjhg', 'ghfhfh', '', 'fghfhgfghf@aadf.hjg', 'hgg', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', '0.00', 0, '', '', NULL, '2023-09-08 04:59:13', ''),
(102, 'ghfhfh', '', 'hgg', '', '', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', 'fghfhgfghf@aadf.hjg', 'example.png', 1, 'gjh', 'gjhg', 'ghfhfh', '', 'fghfhgfghf@aadf.hjg', 'hgg', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', '0.00', 0, '', '', NULL, '2023-09-08 04:59:51', ''),
(103, 'ghfhfh', '', 'hgg', '', '', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', 'fghfhgfghf@aadf.hjg', 'example.png', 1, 'gjh', 'gjhg', 'ghfhfh', '', 'fghfhgfghf@aadf.hjg', 'hgg', 'hghjgjh', 'ghjg', 'jhgjh', 'ghj', '0.00', 0, '', '', NULL, '2023-09-08 05:00:49', ''),
(104, 'jkh', '12345678987654', 'hghj', '', '', 'gjhg', 'hjg', 'jhg', 'hj', 'hkjhkjh@dfadf.ffs', 'example.png', 1, 'ghj', 'gjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:11:38', ''),
(105, 'jkh', '12345678987654', 'hghj', '', '', 'gjhg', 'hjg', 'jhg', 'hj', 'hkjhkjh@dfadf.ffs', 'example.png', 1, 'ghj', 'gjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:14:24', ''),
(106, 'hjghjg', '2345678909876', 'hgjghjgj', '', '', 'gjgj', 'hghj', 'gjh', 'gjh', 'jhjkhkjhK@hjgh.ddd', 'example.png', 1, 'gjhgjhg', 'jhhgjh', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:16:39', ''),
(107, 'vjgjhgjh', '7465164646', 'hjjgfhfghf', '', '', 'ghf', 'fgh', 'fhg', 'fhgf', 'gfhgfhgfg@sdf.sdf', 'example.png', 1, 'hgf', 'hgf', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:17:49', ''),
(108, 'jkhgjhghj', '741741741', 'jhhjgg', '', '', 'hjghj', 'gjhg', 'jhg', 'jhg', 'jhgjh@sdf.dsf', 'example.png', 1, 'jhg', 'jhg', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:18:41', ''),
(109, 'jkhgjhghj', '741741741', 'jhhjgg', '', '', 'hjghj', 'gjhg', 'jhg', 'jhg', 'jhgjh@sdf.dsf', 'example.png', 1, 'jhg', 'jhg', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-09-08 05:20:21', ''),
(114, '', '', '', '', '', '', '', '', '', 'dsfsad', 'example.png', 1, '', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2023-10-05 08:00:45', ''),
(116, 'hghjghjg', '7418529634', 'jagadamba junction', '', '', 'JHGJG', 'JHGJHG', 'JHG', 'JHGJHG', 'ggggg@adADF.FDD', 'example.png', 1, '', '', '', '', '', '', '', '', '', '', '0.00', 0, '', '', NULL, '2024-02-02 02:47:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_custom_data`
--

DROP TABLE IF EXISTS `gtg_custom_data`;
CREATE TABLE IF NOT EXISTS `gtg_custom_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `field_id` int NOT NULL,
  `rid` int NOT NULL,
  `module` int NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`field_id`,`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_custom_data`
--

INSERT INTO `gtg_custom_data` (`id`, `field_id`, `rid`, `module`, `data`) VALUES
(15, 2, 116, 1, 'SDFFD');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_custom_fields`
--

DROP TABLE IF EXISTS `gtg_custom_fields`;
CREATE TABLE IF NOT EXISTS `gtg_custom_fields` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_module` int NOT NULL,
  `f_type` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `placeholder` varchar(30) DEFAULT NULL,
  `value_data` text NOT NULL,
  `f_view` int NOT NULL,
  `other` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `f_module` (`f_module`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_custom_fields`
--

INSERT INTO `gtg_custom_fields` (`id`, `f_module`, `f_type`, `name`, `placeholder`, `value_data`, `f_view`, `other`) VALUES
(2, 1, 'text', 'krish', 'enter', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_cust_group`
--

DROP TABLE IF EXISTS `gtg_cust_group`;
CREATE TABLE IF NOT EXISTS `gtg_cust_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `summary` varchar(250) DEFAULT NULL,
  `disc_rate` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_cust_group`
--

INSERT INTO `gtg_cust_group` (`id`, `title`, `summary`, `disc_rate`) VALUES
(1, 'Default Group', 'Default Group', NULL),
(2, 'Register Client', 'Register Client for Subscription', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_delivery_orders`
--

DROP TABLE IF EXISTS `gtg_delivery_orders`;
CREATE TABLE IF NOT EXISTS `gtg_delivery_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `invoice_type` int NOT NULL DEFAULT '0' COMMENT '0 - pos 1 - online 	',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `discount_rate` decimal(10,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,2) NOT NULL,
  `taxstatus` enum('yes','no','incl','cgst','igst') NOT NULL DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `multi` int DEFAULT NULL,
  `i_class` int NOT NULL DEFAULT '0',
  `loc` int NOT NULL,
  `r_time` varchar(10) DEFAULT NULL,
  `delivery_order_id` text NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`),
  KEY `loc` (`loc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_delivery_order_items`
--

DROP TABLE IF EXISTS `gtg_delivery_order_items`;
CREATE TABLE IF NOT EXISTS `gtg_delivery_order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL DEFAULT '0',
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `i_class` int NOT NULL DEFAULT '0',
  `unit` varchar(5) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_digital_signatures`
--

DROP TABLE IF EXISTS `gtg_digital_signatures`;
CREATE TABLE IF NOT EXISTS `gtg_digital_signatures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_general_ci NOT NULL,
  `sharing_count` int NOT NULL,
  `share_link` text COLLATE utf8mb4_general_ci NOT NULL,
  `ds_unique_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_type` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_digital_signatures`
--

INSERT INTO `gtg_digital_signatures` (`id`, `file_name`, `file_size`, `file_path`, `sharing_count`, `share_link`, `ds_unique_id`, `status`, `cr_date`, `file_type`) VALUES
(12, 'Quote_451704446387.pdf', '144.83', 'https://localhost/erp-dev/userfiles/ds_docs/Quote_#451704446387.pdf', 1, 'https://localhost/erp-dev/billing/digital_signature_share_view?id=12&token=0575d4e322ae7cd50dc99bdd54c86cf5fbb6e752', 'DS59568', 'PENDING', '2024-01-05 09:19:47', 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_digital_signature_signings`
--

DROP TABLE IF EXISTS `gtg_digital_signature_signings`;
CREATE TABLE IF NOT EXISTS `gtg_digital_signature_signings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ds_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `signed_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_digital_signature_signings`
--

INSERT INTO `gtg_digital_signature_signings` (`id`, `ds_id`, `signed_date`, `file_name`, `file_type`, `file_size`, `upload_date`, `file_path`) VALUES
(1, '6', '2023-12-08 11:10:47', '', '', '', '', ''),
(2, '6', '2023-12-08 11:12:27', '', '', '', '', ''),
(3, '6', '2023-12-08 11:13:45', '', '', '', '', ''),
(4, '6', '2023-12-08 11:15:44', 'exported-document1702034144.pdf', 'application/pdf', '685.43', '2023-12-08 11:15:44', 'https://localhost/erp-dev/userfiles/ds_docs/exported-document1702034144.pdf'),
(7, '10', '2023-12-10 04:09:06', 'exported-document1702224546.pdf', 'application/pdf', '622.57', '2023-12-10 16:09:06', 'https://localhost/erp-dev/userfiles/ds_docs/exported-document1702224546.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_documents`
--

DROP TABLE IF EXISTS `gtg_documents`;
CREATE TABLE IF NOT EXISTS `gtg_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `filename` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `cdate` date NOT NULL,
  `permission` int DEFAULT NULL,
  `cid` int NOT NULL,
  `fid` int NOT NULL,
  `rid` int NOT NULL,
  `complaintid` varchar(250) DEFAULT '0',
  `userid` int DEFAULT NULL,
  `contract_id` int NOT NULL DEFAULT '0',
  `emp_doc` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_documents`
--

INSERT INTO `gtg_documents` (`id`, `title`, `filename`, `cdate`, `permission`, `cid`, `fid`, `rid`, `complaintid`, `userid`, `contract_id`, `emp_doc`) VALUES
(2, 'Server Replacement ', '1686535160PDF.pdf', '2023-06-12', NULL, 0, 0, 0, '79', 6, 0, 0),
(3, 'Data Migration', '1686545552Docx.docx', '2023-06-12', NULL, 0, 0, 0, '81', 6, 0, 0),
(4, 'Test Fixes', '1686644335PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '82', 6, 0, 0),
(5, 'Test Fixes', '1686644518PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '83', 6, 0, 0),
(6, 'Test1', '1686644707Docx.docx', '2023-06-13', NULL, 0, 0, 0, '84', 6, 0, 0),
(7, 'Test New fix', '1686649843PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '85', 6, 0, 0),
(8, 'TESSTTTT', '1686650059PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '86', 6, 0, 0),
(9, 'Date test', '1686650507PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '88', 6, 0, 0),
(10, 'Test Fix', '1686657336PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '89', 6, 0, 0),
(11, 'Server Replacement', '1686669719PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '90', 6, 0, 0),
(12, 'Server Replacement', '1686669818PDF.pdf', '2023-06-13', NULL, 0, 0, 0, '91', 6, 0, 0),
(13, 'Test status', '1687329926PDF.pdf', '2023-06-21', NULL, 0, 0, 0, '93', 6, 0, 0),
(14, 'Test Status', '1687334896PDF.pdf', '2023-06-21', NULL, 0, 0, 0, '94', 6, 0, 0),
(15, 'Test', '1687334958PDF.pdf', '2023-06-21', NULL, 0, 0, 0, '95', 6, 0, 0),
(16, 'Test 2', '1687336366PDF.pdf', '2023-06-21', NULL, 0, 0, 0, '96', 6, 0, 0),
(17, 'test', '1687344315PDF_-_Copy.pdf', '2023-06-21', NULL, 0, 0, 0, '97', 6, 0, 0),
(18, 'Test ', '1687358886PDF.pdf', '2023-06-21', NULL, 0, 0, 0, '98', 6, 0, 0),
(19, 'Testing', '1687854455PDF_-_Copy.pdf', '2023-06-27', NULL, 0, 0, 0, '100', 6, 0, 0),
(20, 'Account Service ', '1689756110List_of_Project_PAST_PROJECT.pdf', '2023-07-19', NULL, 0, 0, 0, '106', 6, 0, 0),
(21, 'Mantenance Contract', 'c260a4a11bf3b1cf889e5b5e81fd5c9c.docx', '2023-07-19', NULL, 6, 0, 1, '0', NULL, 0, 0),
(23, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(24, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(25, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(26, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(27, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(28, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(29, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(30, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(31, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(32, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(33, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(34, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(35, 'jhjkhkjh', '', '2030-11-01', NULL, 16, 0, 1, '0', 6, 0, 0),
(36, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/', '2030-11-01', NULL, 1, 0, 1, '0', 6, 0, 0),
(37, 'jhkjhkj', NULL, '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(38, 'jhkjhkj', NULL, '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(39, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(40, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701700229.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(41, 'jhkjhkj', NULL, '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(42, 'jhkjhkj', NULL, '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(43, 'jhkjhkj', NULL, '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(44, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701701247.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(45, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701701467.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(46, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701701558.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(47, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701701732.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(48, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701701836.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 6, 5, 0),
(49, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701852165.pdf', '2030-11-01', NULL, 1, 0, 1, '0', NULL, 5, 0),
(50, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701853191.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 0, 5, 0),
(51, 'jhkjhkj', 'https://localhost/erp-dev/userfiles/contract_docs/sample1701853478.pdf', '2030-11-01', NULL, 1, 0, 1, '0', 0, 5, 0),
(52, 'jhkjhkj', '1705286785Purchase_258-1.pdf', '2024-01-15', NULL, 0, 0, 0, '109', 6, 0, 0),
(53, 'jhjhjkhjk', '1705287342Picture1.png', '2024-01-15', NULL, 0, 0, 0, '114', 6, 0, 0),
(54, 'hjgj', '1705288835Attendance_Module_Improvement_.docx', '2024-01-15', NULL, 0, 0, 0, '115', 6, 0, 0),
(55, 'sofware developmen mocule - file ,manager ', '1686531514JomPAY_23067011528.pdf', '2023-06-12', NULL, 0, 0, 0, '78', 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_do_delivered_items`
--

DROP TABLE IF EXISTS `gtg_do_delivered_items`;
CREATE TABLE IF NOT EXISTS `gtg_do_delivered_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `po_id` int NOT NULL,
  `do_id` int NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `type` text NOT NULL COMMENT 'dr/cr',
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_id` int NOT NULL,
  `p_id` int NOT NULL,
  `delivery_order_id` text NOT NULL,
  `parent_delivery_order_id` text NOT NULL,
  `return_qty` int NOT NULL,
  `description` text NOT NULL,
  `return_type` text NOT NULL COMMENT 'return,cancel',
  `supplier_delivery_order_id` text NOT NULL,
  `do_expire_date` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_do_delivered_items`
--

INSERT INTO `gtg_do_delivered_items` (`id`, `tid`, `po_id`, `do_id`, `qty`, `type`, `cr_date`, `invoice_id`, `p_id`, `delivery_order_id`, `parent_delivery_order_id`, `return_qty`, `description`, `return_type`, `supplier_delivery_order_id`, `do_expire_date`) VALUES
(1, 0, 9, 0, '5.00', 'cr', '2023-11-20 13:50:17', 0, 6, '1000111', '1000', 1, 'hjkjhkjk', 'return', '', ''),
(2, 0, 9, 0, '3.00', 'cr', '2023-11-20 13:50:17', 0, 8, '1000111', '1000', 1, 'jhjhkj', 'return', '', ''),
(3, 0, 9, 0, '2.00', 'cr', '2023-11-20 13:50:17', 0, 1, '1000111', '1000', 1, 'jkhjkhkjhjk', 'return', '', ''),
(4, 0, 0, 0, '10.00', 'cr', '2023-11-21 05:38:49', 113, 6, '1001111', '1001', 0, '', '', '', ''),
(5, 0, 0, 0, '6.00', 'cr', '2023-11-21 05:38:49', 113, 8, '1001111', '1001', 0, '', '', '', ''),
(6, 0, 9, 0, '5.00', 'cr', '2023-11-21 11:27:03', 0, 6, '1000112', '1000', 0, '', '', 'sAABJND23333', ''),
(7, 0, 9, 0, '2.00', 'cr', '2023-11-21 11:27:03', 0, 8, '1000112', '1000', 0, '', '', 'sAABJND23333', ''),
(8, 0, 9, 0, '1.00', 'cr', '2023-11-21 11:27:03', 0, 1, '1000112', '1000', 0, '', '', 'sAABJND23333', ''),
(9, 0, 0, 0, '1.00', 'cr', '2023-11-21 15:15:26', 107, 0, '1002111', '1002', 0, '', '', '', ''),
(10, 0, 0, 0, '1.00', 'cr', '2023-11-21 15:15:26', 107, 0, '1002111', '1002', 0, '', '', '', ''),
(11, 0, 8, 0, '5.00', 'cr', '2023-11-22 04:43:00', 0, 4, '1003111', '1003', 3, 'not worked', 'return', '232333', ''),
(12, 0, 0, 0, '5.00', 'cr', '2023-11-22 05:00:02', 114, 8, '1004111', '1004', 2, 'jhkh', 'return', '', ''),
(13, 0, 0, 0, '5.00', 'cr', '2023-11-22 05:00:02', 114, 4, '1004111', '1004', 4, 'jkhjhk', 'return', '', ''),
(14, 0, 16, 0, '50.00', 'cr', '2023-11-22 06:21:38', 0, 9, '1005111', '1005', 2, 'lkjk', 'return', '234223', ''),
(15, 0, 16, 0, '50.00', 'cr', '2023-11-22 06:21:38', 0, 11, '1005111', '1005', 2, 'jhgjhg', 'return', '234223', ''),
(16, 0, 16, 0, '52.00', 'cr', '2023-11-23 14:08:12', 0, 9, '1005113', '1005', 0, '', '', '457987', '2023-11-30'),
(17, 0, 16, 0, '52.00', 'cr', '2023-11-23 14:08:12', 0, 11, '1005113', '1005', 0, '', '', '457987', '2023-11-29'),
(18, 0, 0, 0, '100.00', 'cr', '2023-11-26 09:47:24', 0, 22, '1009111', '1009', 0, '', '', '741741', '2023-11-11 00:00:00'),
(19, 0, 0, 0, '100.00', 'cr', '2023-12-21 08:45:29', 0, 23, '1010111', '1010', 0, '', '', 'jhjkhjk', '2023-12-15 00:00:00'),
(20, 0, 0, 0, '4.00', 'dr', '2023-12-21 12:06:07', 114, 8, '1004112', '1004', 0, '', '', '', ''),
(21, 0, 0, 0, '5.00', 'dr', '2023-12-21 12:06:07', 114, 4, '1004112', '1004', 0, '', '', '', ''),
(22, 0, 8, 0, '8.00', 'cr', '2024-01-22 08:51:20', 0, 4, '1003112', '1003', 0, '', '', '741741741', '2024-01-22'),
(23, 0, 9, 0, '1.00', 'cr', '2024-01-22 08:52:09', 0, 6, '1000113', '1000', 0, '', '', '74154565', '2024-01-26'),
(24, 0, 9, 0, '1.00', 'cr', '2024-01-22 08:52:09', 0, 8, '1000113', '1000', 0, '', '', '74154565', '2024-01-27'),
(25, 0, 9, 0, '1.00', 'cr', '2024-01-22 08:52:09', 0, 1, '1000113', '1000', 0, '', '', '74154565', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_do_product_batches_history`
--

DROP TABLE IF EXISTS `gtg_do_product_batches_history`;
CREATE TABLE IF NOT EXISTS `gtg_do_product_batches_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `do_delivered_item_id` int NOT NULL,
  `po_id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `p_id` int NOT NULL,
  `supplier_delivery_order_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_order_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `parent_delivery_order_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `available_quantity` text COLLATE utf8mb4_general_ci NOT NULL,
  `do_expire_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `used_qty` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_do_product_batches_history`
--

INSERT INTO `gtg_do_product_batches_history` (`id`, `do_delivered_item_id`, `po_id`, `invoice_id`, `p_id`, `supplier_delivery_order_id`, `delivery_order_id`, `parent_delivery_order_id`, `available_quantity`, `do_expire_date`, `used_qty`, `cr_date`) VALUES
(1, 0, 9, 2, 6, '', '1000111', '1000', '4', '', '3', '0000-00-00 00:00:00'),
(2, 11, 8, 114, 4, '232333', '1003111', '1003', '2', '', '2', '0000-00-00 00:00:00'),
(3, 13, 0, 114, 4, '', '1004111', '1004', '1', '', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_do_relations`
--

DROP TABLE IF EXISTS `gtg_do_relations`;
CREATE TABLE IF NOT EXISTS `gtg_do_relations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'invoice,po,do',
  `do_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `po_id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `parent_do_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_do_id` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_do_relations`
--

INSERT INTO `gtg_do_relations` (`id`, `type`, `do_id`, `cr_date`, `po_id`, `invoice_id`, `parent_do_id`, `supplier_do_id`) VALUES
(1, 'po', '1000111', '2023-11-20 13:50:17', 9, 0, '1000', '3434'),
(2, 'invoice', '1001111', '2023-11-21 05:38:49', 0, 113, '1001', '0'),
(3, 'po', '1000112', '2023-11-21 11:27:03', 9, 0, '1000', '55555'),
(4, 'invoice', '1002111', '2023-11-21 15:15:26', 0, 107, '1002', ''),
(5, 'po', '1003111', '2023-11-22 04:43:00', 8, 0, '1003', '232333'),
(6, 'invoice', '1004111', '2023-11-22 05:00:02', 0, 114, '1004', ''),
(7, 'po', '1005111', '2023-11-22 06:21:38', 16, 0, '1005', '234223'),
(8, 'po', '1005112', '2023-11-23 14:07:26', 16, 0, '1005', '457987'),
(9, 'po', '1005113', '2023-11-23 14:08:12', 16, 0, '1005', '457987'),
(10, 'po', '1006111', '2023-11-26 09:43:43', 0, 0, '1006', '741741'),
(11, 'po', '1007111', '2023-11-26 09:44:04', 0, 0, '1007', '741741'),
(12, 'po', '1008111', '2023-11-26 09:44:09', 0, 0, '1008', '741741'),
(13, 'po', '1009111', '2023-11-26 09:47:24', 0, 0, '1009', '741741'),
(14, 'default_po', '1010111', '2023-12-21 08:45:29', 0, 0, '1010', 'jhjkhjk'),
(15, 'invoice', '1004112', '2023-12-21 12:06:07', 0, 114, '1004', ''),
(16, 'po', '1003112', '2024-01-22 08:51:20', 8, 0, '1003', '741741741'),
(17, 'po', '1000113', '2024-01-22 08:52:09', 9, 0, '1000', '74154565');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_draft`
--

DROP TABLE IF EXISTS `gtg_draft`;
CREATE TABLE IF NOT EXISTS `gtg_draft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,2) NOT NULL,
  `taxstatus` enum('yes','no','cgst','igst') NOT NULL DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','bflat','b_p') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `multi` int DEFAULT NULL,
  `i_class` int NOT NULL DEFAULT '0',
  `loc` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`),
  KEY `loc` (`loc`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_draft`
--

INSERT INTO `gtg_draft` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `multi`, `i_class`, `loc`) VALUES
(1, 1001, '2023-05-18', '2023-05-18', '157.50', '0.00', '0.00', 'incl', '0.00', '7.50', '157.50', NULL, '', 'partial', 1, 6, '0.00', '5.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(6, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(7, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(8, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(9, 1029, '2023-10-11', '2023-10-11', '86.00', '0.00', '0.00', 'incl', '0.00', '0.00', '86.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(10, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(11, 1029, '2023-10-11', '2023-10-11', '241.00', '0.00', '0.00', 'incl', '2.00', '0.00', '241.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(12, 1029, '2023-10-11', '2023-10-11', '241.00', '0.00', '0.00', 'incl', '2.00', '0.00', '241.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(13, 1029, '2023-10-11', '2023-10-11', '421.00', '0.00', '0.00', 'incl', '4.00', '0.00', '421.00', NULL, '', 'partial', 1, 6, '0.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(14, 1029, '2023-10-11', '2023-10-11', '241.00', '0.00', '0.00', 'incl', '2.00', '0.00', '241.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(15, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(16, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(18, 1029, '2023-10-11', '2023-10-11', '266.00', '0.00', '0.00', 'incl', '2.00', '0.00', '266.00', NULL, '', 'partial', 1, 6, '0.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(19, 1029, '2023-10-11', '2023-10-11', '266.00', '0.00', '0.00', 'incl', '2.00', '0.00', '266.00', NULL, '', 'partial', 1, 6, '0.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(21, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(22, 1029, '2023-10-11', '2023-10-11', '50.00', '0.00', '0.00', 'incl', '0.00', '0.00', '50.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(24, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(25, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 10, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(26, 1029, '2023-10-11', '2023-10-11', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 25, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(27, 1029, '2023-12-19', '2023-12-19', '143.00', '0.00', '0.00', 'incl', '0.00', '0.00', '143.00', NULL, '', 'partial', 1, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(28, 1030, '2023-12-19', '2023-12-19', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 0, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0),
(29, 1032, '2023-12-19', '2023-12-19', '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '43.00', NULL, '', 'partial', 0, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_draft_items`
--

DROP TABLE IF EXISTS `gtg_draft_items`;
CREATE TABLE IF NOT EXISTS `gtg_draft_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL DEFAULT '0',
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `i_class` int NOT NULL DEFAULT '0',
  `unit` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_draft_items`
--

INSERT INTO `gtg_draft_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `i_class`, `unit`) VALUES
(1, 1, 1, 'AVT tea-00165', '00165', '5.00', '30.00', '5.00', '0.00', '157.50', '7.50', '0.00', NULL, 1, ''),
(2, 6, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', NULL, 1, ''),
(3, 7, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', NULL, 1, ''),
(4, 8, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(5, 9, 7, 'Dolo 650-9639633', '9639633', '2.00', '43.00', '1.00', '0.00', '86.00', '0.00', '0.00', '', 1, ''),
(6, 10, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', 't', 1, ''),
(7, 11, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', NULL, 1, ''),
(8, 11, 6, 'Test coffe one-8965896', '8965896', '1.00', '200.00', '1.00', '1.00', '198.00', '0.00', '2.00', NULL, 1, ''),
(9, 12, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', NULL, 1, ''),
(10, 12, 6, 'Test coffe one-8965896', '8965896', '1.00', '200.00', '1.00', '1.00', '198.00', '0.00', '2.00', NULL, 1, ''),
(11, 13, 6, 'Test coffe one-8965896', '8965896', '2.00', '200.00', '1.00', '1.00', '396.00', '0.00', '4.00', NULL, 1, ''),
(12, 13, 8, 'Test coffe one by siva-741741', '741741', '1.00', '25.00', '0.00', '0.00', '25.00', '0.00', '0.00', NULL, 1, ''),
(13, 14, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', 'w', 1, ''),
(14, 14, 6, 'Test coffe one-8965896', '8965896', '1.00', '200.00', '1.00', '1.00', '198.00', '0.00', '2.00', 'w', 1, ''),
(15, 15, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(16, 16, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(17, 18, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', NULL, 1, ''),
(18, 18, 6, 'Test coffe one-8965896', '8965896', '1.00', '200.00', '1.00', '1.00', '198.00', '0.00', '2.00', NULL, 1, ''),
(19, 18, 8, 'Test coffe one by siva-741741', '741741', '1.00', '25.00', '0.00', '0.00', '25.00', '0.00', '0.00', NULL, 1, ''),
(20, 19, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(21, 19, 6, 'Test coffe one-8965896', '8965896', '1.00', '200.00', '1.00', '1.00', '198.00', '0.00', '2.00', '', 1, ''),
(22, 19, 8, 'Test coffe one by siva-741741', '741741', '1.00', '25.00', '0.00', '0.00', '25.00', '0.00', '0.00', '', 1, ''),
(23, 21, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(24, 22, 8, 'Test coffe one by siva-741741', '741741', '2.00', '25.00', '0.00', '0.00', '50.00', '0.00', '0.00', '', 1, ''),
(25, 24, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(26, 25, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(27, 26, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(28, 27, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(29, 27, 14, 'hjghjghj-745545', '745545', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', '', 1, ''),
(30, 28, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, ''),
(31, 29, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_employees`
--

DROP TABLE IF EXISTS `gtg_employees`;
CREATE TABLE IF NOT EXISTS `gtg_employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phonealt` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'example.png',
  `sign` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sign.png',
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dept` int DEFAULT NULL,
  `degis` int DEFAULT NULL,
  `salary` decimal(16,2) DEFAULT '0.00',
  `clock` int DEFAULT NULL,
  `clockin` int DEFAULT NULL,
  `clockout` int DEFAULT NULL,
  `c_rate` decimal(16,2) DEFAULT NULL,
  `cdate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passport` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employee_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passport_expiry` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permit_expiry` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passport_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visa_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL,
  `passport_email_sent` int NOT NULL,
  `permit_email_sent` int NOT NULL,
  `gender` text COLLATE utf8mb4_general_ci NOT NULL,
  `socso_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kwsp_number` text COLLATE utf8mb4_general_ci NOT NULL,
  `pcb_number` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in_latitude` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in_longitude` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in_location` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in_photo` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_out_latitude` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_out_longitude` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_out_location` text COLLATE utf8mb4_general_ci NOT NULL,
  `clock_out_photo` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_job_type` text COLLATE utf8mb4_general_ci NOT NULL,
  `join_date` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_employees`
--

INSERT INTO `gtg_employees` (`id`, `username`, `email`, `name`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `phonealt`, `picture`, `sign`, `joindate`, `dept`, `degis`, `salary`, `clock`, `clockin`, `clockout`, `c_rate`, `cdate`, `company`, `passport`, `permit`, `employee_type`, `passport_expiry`, `permit_expiry`, `passport_document`, `visa_document`, `delete_status`, `passport_email_sent`, `permit_email_sent`, `gender`, `socso_number`, `kwsp_number`, `pcb_number`, `clock_in_latitude`, `clock_in_longitude`, `clock_in_location`, `clock_in_photo`, `clock_out_latitude`, `clock_out_longitude`, `clock_out_location`, `clock_out_photo`, `cr_date`, `employee_job_type`, `join_date`) VALUES
(1, 'testing', 'udhayase@gmail.com', 'fsdfdsf', 'fsdfa', 'fdsafsaff', NULL, 'fafd', 'fds', '4242342', '', 'example.png', '1688989228930689739 (1).png', '2023-07-10 11:40:28', 0, NULL, '1000.00', NULL, NULL, NULL, '1.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(2, 'ajmal', 'udhayase@gmail.com', 'Shafeek Ajmal', '414 Krishna enclave', 'Mohali', NULL, 'India', '', '0000000000', '', '16861129861475570024.png', '16889964661844041341 (1).jpeg', '2023-07-10 13:41:08', 1, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(3, 'abcd', 'udhayase@gmail.com', 'AjmalSoft', '414 Krishna enclave', 'Mohali', NULL, 'United States', '53453', '8968022885', '', '1686070936115891243.png', '1686070952299397313.png', '2024-02-05 09:26:11', 5, NULL, '0.00', 1, 1707125171, 0, '0.00', '2024-02-05', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '3.11296', '101.5742464', '4H7F+5M Petaling Jaya, Selangor, Malaysia', 'image_65c0a9b350817.png', '3.1135204', '101.5775019', 'Jalan Tanpa Nama, Pusat Perdagangan Dana 1, 47301 Petaling Jaya, Selangor, Malaysia', 'image_65b8af4fb77f1.png', '2024-01-29 07:16:29', '', ''),
(4, 'myname', 'udhayase@gmail.com', 'krish81', '414 Krishna enclave', 'Mumbai', NULL, 'India', '65464', '1234343', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(27, 'jenifer', '', 'jenifer', 'klang', 'klang', NULL, '', '', '', '', 'example.png', 'sign.png', '2023-06-20 23:31:42', 6, NULL, '1000.00', 0, 0, 1687303902, '5.00', '2023-06-20', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(28, 'Alvin', '', 'Alvin', 'no 36 anna street', 'Melaka Tengah', NULL, '1', '45000', '60146291291', '', 'example.png', 'sign.png', '2023-10-04 05:08:37', 3, 1, '2000.00', 0, 0, 1688568233, '0.00', '2023-07-05', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(29, 'Testing Schedular', 'sprasadss96@gmail.com', 'Testing Schedular', NULL, NULL, NULL, 'India', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-12-19 04:06:59', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '26', '1122334455', '2233445566', 'foreign', '2023-10-13', '2023-11-13', '1687836233PDF.pdf', 'PDF.pdf', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(30, 'Test Schedular 2', 'hariinraj29@gmail.com', 'Test Schedular 2', NULL, NULL, NULL, 'India', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-11 05:42:05', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '26', '3344556677', '445566778899', 'foreign', '2023-07-28', '2023-07-28', '1687836347PDF_-_Copy.pdf', 'PDF - Copy.pdf', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(31, 'Schedule Test 2.1', 'udhayase@gmail.com', 'Schedule Test 2.1', NULL, NULL, NULL, 'India', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-11 05:47:09', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '26', '1122334455', '445566778899', 'foreign', '2024-08-28', '2023-08-28', '1687837132PDF_-_Copy.pdf', 'PDF - Copy.pdf', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(32, 'Schedule Test 3', 'k.udhayaraja@gmail.com', 'Schedule Test 3', NULL, NULL, NULL, 'India', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-12 00:00:12', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '26', '1122334455', '2233445566', 'foreign', '2023-07-26', '2023-08-11', '1687837357PDF.pdf', 'PDF.pdf', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(33, 'sureshkumar', 'suresh@gmail.com', 'sureshkumar', NULL, NULL, NULL, 'India', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-06-30 09:45:03', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '41', '123456', '54466677', 'foreign', '2023-06-30', '2023-06-30', '1688118295config.jpg', 'configuration.jpg', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(34, 'demoemployee', 'reena@jsoftsolution.com.my', 'demoemployee', NULL, NULL, NULL, 'india', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-11 05:42:05', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '42', '421412414', '3423423535', 'foreign', '2023-07-20', '2023-07-21', '1688350904Quote_17.pdf', 'P1337793 (2).pdf', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(37, 'basdffffff', '', 'udfgfgjfj', 'dfgdfgdf', 'dfgdfgdfg', 'sgdsdgg', '47', '625002', '7092150290', NULL, 'example.png', 'sign.png', '2023-07-12 10:54:05', 2, 3, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(38, 'demosample', '', 'demosample', 'test', 'test', 'test', '13', '625002', '7092150290', NULL, 'example.png', 'sign.png', '2023-07-12 11:10:23', 2, 2, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(39, 'akajith', '', 'akajith', 'no 36 annastreet', 'sdasdasd', 'asdasd', '8', '625003', '7092150290', NULL, 'example.png', 'sign.png', '2023-07-12 11:16:21', 2, 2, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(40, 'Steve19', '', 'Steve Jobs', 'Facebook Street', 'Ara Damansara', NULL, '134', '48000', '0149261261', '', '16897465051063658153 (1).jpeg', '16897465641255762161 (1).jpeg', '2023-07-19 11:10:47', 3, 11, '2000.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(41, 'Alfred', 'sprasad96@gmail.com', 'Alfred', NULL, NULL, NULL, '231', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-09-25 04:45:40', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '1', '1122334455', '2233445566', 'foreign', '2023-10-25', '2023-10-25', '', '', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(42, 'vivevk', 'vivevk@gmail.com', 'vivevk', NULL, NULL, NULL, '4', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-12 11:58:05', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '1', '1241241241', '124124124124', 'foreign', '2023-07-12', '2023-07-12', '', '', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(43, 'domesticuser', '', 'domesticuser', 'test', 'test', 'test', '36', '625002', '7092150290', NULL, 'example.png', 'sign.png', '2023-07-13 11:16:16', 1, 2, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(44, 'foreignuser', 'foreignuser@gmail.com', 'foreignuser', NULL, NULL, NULL, '13', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-13 11:18:02', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '42', '12345678', 'permitnumber', 'foreign', '2023-07-13', '2023-07-13', '', '', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(45, '', '', 'domestic3', 'domestic3', 'domestic3', 'domestic3', '13', '625002', '7092150290', NULL, 'example.png', 'sign.png', '2023-07-13 11:28:54', 1, 2, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(46, '', '', 'foreignworker2', NULL, NULL, NULL, '13', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-13 11:33:02', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '32', '43423432434', '234123411', 'foreign', '2023-07-13', '2023-07-13', '', '', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(47, '', '', 'foreignwrker3', NULL, NULL, NULL, '18', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-13 11:40:02', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '42', '12342112414', '1512532555', 'foreign', '2023-07-29', '2023-07-21', '', '', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(48, '', '', 'krish mathavan', NULL, NULL, NULL, '134', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-13 19:53:04', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '30', '124456', '12445678', 'foreign', '2023-07-21', '2023-07-28', '1689277955IMG-20230714-WA0000.jpg', '1689277955IMG-20230714-WA00001.jpg', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(49, '', '', 'REENA', NULL, NULL, NULL, '100', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-14 09:00:04', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '50', '2112311', '12112132323', 'foreign', '2023-11-03', '2023-11-11', '1689325178WEB1.jpg', '', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(50, '', '', 'demoemployee', NULL, NULL, NULL, '13', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-12-19 04:21:02', NULL, 0, '0.00', 1, 1702959662, 0, NULL, '2023-12-19', '31', '123456', '456346346', 'foreign', '2023-07-28', '2023-07-28', '', '', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(51, '', '', 'Kamu', NULL, NULL, NULL, '78', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-14 12:13:05', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '50', '12456', '2563', 'foreign', '2024-04-27', '2024-09-28', '1689336764Quote_28.pdf', '1689336764Quote_281.pdf', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(52, '', '', 'krish mathavan', NULL, NULL, NULL, '', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-16 05:49:04', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '30', '124456', '12445678', 'foreign', '2023-07-23', '2023-07-30', '1689486524IMG-20230716-WA0061.jpg', '1689486524IMG-20230716-WA00611.jpg', 0, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(53, '', '', 'ABC ', '4-8-27 Monash University Malaysia, Jalan Lagoon Selatan, Bandar Sunway', 'SUNWAY', NULL, '134', '46150', '0123698754', '', 'example.png', 'sign.png', '2023-12-12 05:47:29', 5, 6, '2500.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'male', 'socos123', 'kwsp123', 'pcb123', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(54, '', '', 'soba', NULL, NULL, NULL, '13', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-07-17 09:33:04', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '48', '843005064', '65332578907', 'foreign', '2024-05-31', '2024-06-11', '1689586335Receipt_(3).pdf', '1689586335Receipt_(3)1.pdf', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(55, 'HELLY', 'jhghghjg@dafdsf.fff', 'HELLY', NULL, NULL, NULL, '18', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-10-04 06:54:13', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '1', '432157895', '632358961', 'foreign', '2024-02-17', '2024-10-17', '', '', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(56, '', '', 'SANY', NULL, NULL, NULL, '18', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-09-25 04:57:34', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '60', '4321874665', '45769953', 'foreign', '2024-06-11', '2024-06-20', '1689587554Receipt_(3).pdf', '1689587554Receipt_(3)1.pdf', 1, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(57, 'muthukumar', 'muthukumar@gmail.com', 'muthukumar', NULL, NULL, NULL, '1', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-09-25 04:56:30', NULL, 0, '0.00', NULL, NULL, NULL, NULL, '', '42', '223423423424', '2342341241', 'foreign', '2023-07-20', '2023-07-20', '', '', 1, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(58, 'tryuiuasdjbmhgdsdfasd', '', 'hghjg', 'hjghjg', 'hjg', 'hjg', '94', 'jkhkj', '8529639636', NULL, '17058885301274772737(1).png', 'image_65addcef61cb9.png', '2024-01-22 03:11:43', 0, 14, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(59, 'hjghjg', '', 'jhjhkjh', 'jkh@sadf.fd', 'kjh', 'kjhkjh', '2', 'hghjghjgj', '741852665', NULL, 'example.png', 'sign.png', '2023-09-25 05:50:03', 0, 1, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(60, 'hgjhgjhh', '', 'hghjghjg', 'jhghj', 'ghj', 'ghj', '82', 'gjhg', '741741741', NULL, 'example.png', 'sign.png', '2023-09-25 05:53:35', 0, 8, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(61, '', '', 'hgjhgjhg', 'jhg', 'hjgjh', 'gjh', '82', 'jhgjh', '741852963', NULL, 'example.png', 'sign.png', '2023-09-25 05:30:10', 0, 8, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(62, '', '', 'hjghjghjg', 'hjghj', 'ghjg', 'hjg', '94', 'gjh', '777777777', NULL, 'example.png', 'sign.png', '2023-09-25 05:52:07', 0, 8, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(63, '', '', 'fffff', 'ghhjghjgjh', 'gjhghj', 'gjh', '82', 'jkhkj', '741258963', NULL, 'example.png', 'sign.png', '2023-09-25 10:00:49', 0, 1, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(64, '1', '2024', '1/1/2024', '3', 'test', 'test designation', 'test department', NULL, '5000', NULL, 'example.png', 'sign.png', '2023-12-11 13:34:51', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', '50', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(65, 'TestSivaPrasadwee', '', 'siva', 'jagadamba junction', 'visakhapatnam', 'test', '100', '530040', '74174174185', NULL, 'example.png', 'sign.png', '2023-12-12 05:49:57', 0, 2, '52000.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'male', 'socos741', 'kwsp741', 'pcb741', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(66, 'siva', '', 'siva', 'jagadamba junction', 'visakhapatnam', 'rtc complex', '100', '533005', '741852966', NULL, 'example.png', 'sign.png', '2023-12-13 07:20:38', 0, 2, '10000.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'male', 'jhgjkh', 'jgjhhgjhgkjg', 'jhghjgkhgj', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(67, 'Sivaprasad', '', 'Siva', 'jagadamba junction', 'visakhapatnam', 'Visakhapatnam', '100', '530020', '9182288185', NULL, 'example.png', 'sign.png', '2024-01-10 04:11:27', 1, 2, '60000.00', 0, 0, 1704859887, '10.00', '2024-01-10', '', '', '', '', '', '', '', '', 0, 0, 0, 'male', '741741741', '74174174', '74174174', '', '', '', '', '', '', '', '', '2024-01-29 07:16:29', '', ''),
(68, 'Alvin', 'alvin6241@gmail.com', 'Alvin A/L Adaikalasamy', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '011-2618 0017', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(69, 'Dzul Helmie', 'dzulhelmie7@gmail.com', 'Dzul Helmie Bin Ahmd Damanhuri', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '011 11194686', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(70, 'Fathi', 'fathivans92@gmail.com', 'Muhammad Fathi Bin Jamaludin', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '01160806351', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(71, 'Flavian', 'flavianbiswas@gmail.com', 'Flavian Biswas', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '0123658905', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(72, 'Hethis', 'hethis86@gmail.com', 'Hethiswara Retnam A/L Kanagaretnam', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '012 340 8905', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(73, 'Kailash', 'kailashbhawar536@gmail.com', 'Kailash', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '01111560293', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(74, 'Kanna', 'kannan3avsi@gmail.com', 'Kannan a/l Bijekumar', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '016 284 0022', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(75, 'Karthik', 'karthiksubramaniam1992@gmail.com', 'Karthik A/L Subramaniam', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '014 9258913', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(76, 'KG', 'kg@avsolutions.com.my', 'Kumuthan A/L Govindasamy', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '012 3298905', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(77, 'Prakash', 'prakash@avsolutions.com.my', 'Jeyaprakash A/L Jeyakumar', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '012 225 1948', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(78, 'Ragu', 'ragu@avsolutions.com.my', 'Velayuthan A/L Bala Krishnan', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '012 232 1477', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(79, 'Rakesh', 'rakeshdhimanrd34@gmail.com', 'Rakesh Kumar', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '011 28857712', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(80, 'Shah Imran', 'imran.shaharudin@gmail.com', 'Shah Imran bin Shaharudin ', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '016 953 7890', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(81, 'Siva', 'sivamac360@gmail.com', 'Sanderasegaran A/L Kumaran', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '016 200 2360', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(82, 'Taufiq', 'taufiq@avsolutions.com.my', 'Muhammad Taufiq Bin Md Yasin', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '0182741837', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', ''),
(83, 'William', 'accounts@avsolutions.com.my', 'William Hong', 'No 2, Jalan Tembaga SD 5/2F', 'Bandar Sri Damansara', 'Kuala Lumpur', 'Malaysia', NULL, '0164559135', NULL, 'example.png', 'sign.png', '0000-00-00 00:00:00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '', '', '', '', 'Permanent', '', '', '', '', 0, 0, 0, 'male', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '2024-01-31 17:30:17', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_events`
--

DROP TABLE IF EXISTS `gtg_events`;
CREATE TABLE IF NOT EXISTS `gtg_events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` varchar(50) NOT NULL DEFAULT 'true',
  `rel` int NOT NULL DEFAULT '0',
  `rid` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rel` (`rel`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_events`
--

INSERT INTO `gtg_events` (`id`, `title`, `description`, `color`, `start`, `end`, `allDay`, `rel`, `rid`) VALUES
(1, '[Project] Website Development ', 'High priority. Start date: 2023-07-19 00:00:00 End Date: 2023-08-18 00:00:00', '#264150', '2023-07-19 00:00:00', '2023-08-18 00:00:00', 'true', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_expenses`
--

DROP TABLE IF EXISTS `gtg_expenses`;
CREATE TABLE IF NOT EXISTS `gtg_expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` text,
  `receipt_no` int DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  `receipt_amount` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `doc` varchar(255) NOT NULL,
  `loc` int DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_expenses`
--

INSERT INTO `gtg_expenses` (`id`, `eid`, `name`, `title`, `category`, `receipt_no`, `receipt_date`, `receipt_amount`, `tax_amount`, `reason`, `remarks`, `doc`, `loc`, `status`, `created_at`, `updated_at`) VALUES
(16, 24, 'Adam Iskandar', 'Data Migration at John office', 'personal loan', 3211495, '2023-06-29', 400, 0, 'Site visit for Data Migration', 'Approving', '1686552600Receipt.png', 0, 1, '2023-06-12 06:50:00', '2023-06-12 06:50:00'),
(17, 11, 'Hariinraj', 'Data Migration at John office (With Adam)', 'personal loan', 3211499, '2023-06-29', 50, 0, 'Lunch', 'Clarified and Approved', '1686552722Receipt.png', 0, 1, '2023-06-12 06:52:02', '2023-06-12 06:52:02'),
(18, 24, 'Adam Iskandar', 'Server replacement at John office', 'personal loan', 3211495, '2023-06-06', 400, 0, 'Server replacement', '', '1686645338Receipt.png', 0, 2, '2023-06-13 08:35:38', '2023-06-13 08:35:38'),
(20, 11, 'Prabhat', 'Server replacement at John office', 'personal loan', 3211499, '2023-06-09', 60, 0, 'Client visit', '', '1686645610Receipt.png', 0, 2, '2023-06-13 08:40:10', '2023-06-13 08:40:10'),
(21, 28, 'Alvin ', 'Test', 'personal loan', 2, '2023-06-14', 400, 0, 'Client visit', 'Test', '1687335410PDF.pdf', 0, 0, '2023-06-21 08:16:50', '2023-06-21 08:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_expenses_cat`
--

DROP TABLE IF EXISTS `gtg_expenses_cat`;
CREATE TABLE IF NOT EXISTS `gtg_expenses_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_expenses_cat`
--

INSERT INTO `gtg_expenses_cat` (`id`, `name`) VALUES
(4, 'personal loan'),
(5, 'medical'),
(6, 'Emergency'),
(7, 'Gg');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_fws_documents`
--

DROP TABLE IF EXISTS `gtg_fws_documents`;
CREATE TABLE IF NOT EXISTS `gtg_fws_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_fws_documents`
--

INSERT INTO `gtg_fws_documents` (`id`, `employee_id`, `document`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 28, 'P6021212.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:13:40'),
(2, 28, 'P60212121.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:13:41'),
(3, 29, 'P5383486.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:32:08'),
(4, 29, 'P53834861.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:32:08'),
(5, 30, 'P8168437.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:38:47'),
(6, 30, 'P81684371.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 02:38:47'),
(7, 31, 'P1337793_(2).pdf', 0, '0000-00-00 00:00:00', '2023-06-08 10:20:54'),
(8, 31, 'P1337793_(2)1.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 10:20:54'),
(9, 18, 'P8168437.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 10:31:55'),
(10, 18, 'P81684371.pdf', 0, '0000-00-00 00:00:00', '2023-06-08 10:31:55'),
(11, 19, 'PDF.pdf', 0, '0000-00-00 00:00:00', '2023-06-09 10:42:38'),
(12, 20, 'Screenshot_20230609_220843_Chrome.jpg', 0, '0000-00-00 00:00:00', '2023-06-09 14:10:09'),
(13, 21, 'P1337793_(2).pdf', 0, '0000-00-00 00:00:00', '2023-06-10 04:49:33'),
(14, 21, 'P1337793_(2)1.pdf', 0, '0000-00-00 00:00:00', '2023-06-10 04:49:33'),
(15, 22, 'P5383486.pdf', 0, '0000-00-00 00:00:00', '2023-06-10 05:39:23'),
(16, 22, 'P53834861.pdf', 0, '0000-00-00 00:00:00', '2023-06-10 05:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_gateways`
--

DROP TABLE IF EXISTS `gtg_gateways`;
CREATE TABLE IF NOT EXISTS `gtg_gateways` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `enable` enum('Yes','No') NOT NULL,
  `key1` varchar(255) NOT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `dev_mode` enum('true','false') NOT NULL,
  `ord` int NOT NULL,
  `surcharge` decimal(16,2) NOT NULL,
  `extra` varchar(40) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_gateways`
--

INSERT INTO `gtg_gateways` (`id`, `name`, `enable`, `key1`, `key2`, `currency`, `dev_mode`, `ord`, `surcharge`, `extra`) VALUES
(1, 'Stripe', 'No', 'sk_test_51MasxASG84AF8eFw9d8nUxgIHV0vzLIOHNkAA3cIsbSLdAU9B4Ar5OeTiVEwyUDpRuC1nAdRQ8ypZdmdRoDwZADj00eJTNaJWN', 'pk_test_51MasxASG84AF8eFws3SF7hQSgguiXdbvxDUHJj5ejcEn2O0OvZLashyFwnAMC1Evjfmerd4cGyZcGCV08Bz8xrP000cK2VqLZh', 'INR', 'true', 1, '0.00', 'none'),
(2, 'Authorize.Net', 'No', 'TRANSACTIONKEY', 'LOGINID', 'AUD', 'true', 2, '0.00', 'none'),
(3, 'Pin Payments', 'No', 'TEST', 'none', 'AUD', 'true', 3, '0.00', 'none'),
(4, 'PayPal', 'No', 'AY6cxaOftfhjJGmPEtkOU28X0cY2ZdKARImsXziJBM8CpbEa-xT8DwISRxxgUcSBg85D0N1XxUVoNJAJ', 'EPpe4riQW9j-YkG8Jx1_JJSuC_tZBaqKn9zIqZFjfdpjZvLoCgl05dx07HLp3o2rVKneFg9B2BGCIK2W', 'USD', 'true', 4, '0.00', 'none'),
(5, 'SecurePay', 'No', 'ABC0001', 'abc123', 'AUD', 'true', 5, '0.00', 'none'),
(6, '2Checkout', 'No', 'Publishable Key', 'seller_id', 'USD', 'true', 6, '0.00', 'seller_id'),
(7, 'PayU Money', 'No', 'MERCHANT_KEY', 'MERCHANT_SALT', 'USD', 'true', 7, '0.00', 'none'),
(8, 'RazorPay', 'No', 'Key Id', 'Key Secret', 'INR', 'true', 8, '0.00', 'none'),
(9, 'iPay88', 'Yes', 'M15995', 'NpUPyVfkHI', 'MYR', 'true', 9, '0.00', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_goals`
--

DROP TABLE IF EXISTS `gtg_goals`;
CREATE TABLE IF NOT EXISTS `gtg_goals` (
  `id` int NOT NULL,
  `income` bigint NOT NULL,
  `expense` bigint NOT NULL,
  `sales` bigint NOT NULL,
  `netincome` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_goals`
--

INSERT INTO `gtg_goals` (`id`, `income`, `expense`, `sales`, `netincome`) VALUES
(1, 80000, 20000, 100000, 80000),
(1, 80000, 20000, 100000, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_hrm`
--

DROP TABLE IF EXISTS `gtg_hrm`;
CREATE TABLE IF NOT EXISTS `gtg_hrm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `typ` int NOT NULL,
  `rid` int NOT NULL,
  `val1` varchar(255) DEFAULT NULL,
  `val2` varchar(255) DEFAULT NULL,
  `val3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_hrm`
--

INSERT INTO `gtg_hrm` (`id`, `typ`, `rid`, `val1`, `val2`, `val3`) VALUES
(1, 3, 1, 'SALES', NULL, NULL),
(2, 3, 0, 'Finance ', NULL, NULL),
(3, 3, 0, 'Operation', NULL, NULL),
(4, 1, 8, '4000', '0.00', '2022-11-01 08:37:36'),
(5, 3, 1, 'DEVELOPMENT', NULL, NULL),
(6, 3, 0, 'executive ', NULL, NULL),
(7, 3, 0, '12123313', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_invoices`
--

DROP TABLE IF EXISTS `gtg_invoices`;
CREATE TABLE IF NOT EXISTS `gtg_invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `invoice_type` int NOT NULL DEFAULT '0' COMMENT '0 - pos 1 - online 	',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `discount_rate` decimal(10,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,2) NOT NULL,
  `taxstatus` enum('yes','no','incl','cgst','igst') NOT NULL DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `multi` int DEFAULT NULL,
  `i_class` int NOT NULL DEFAULT '0',
  `loc` int NOT NULL,
  `r_time` varchar(10) DEFAULT NULL,
  `delivery_order_id` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`),
  KEY `loc` (`loc`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_invoices`
--

INSERT INTO `gtg_invoices` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `invoice_type`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `discount_rate`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `multi`, `i_class`, `loc`, `r_time`, `delivery_order_id`) VALUES
(1, 1001, '2023-02-10', '2023-02-10', 0, '2.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.18', '2.00', 'Wallet Payment', '', 'paid', 1, 2, '2.00', '0.00', 'incl', 1, '%', 'JS001', 1, NULL, 0, 0, NULL, ''),
(2, 1002, '2023-02-10', '2023-02-10', 0, '1900.00', '0.00', '0.00', 'incl', '100.00', '0.00', '181.82', '1900.00', 'Cash', '', 'paid', 1, 3, '1900.00', '1.00', 'incl', 1, '%', 'JS002', 1, NULL, 0, 0, NULL, ''),
(3, 1003, '2023-02-13', '2023-02-13', 0, '198.00', '0.98', '0.02', 'incl', '2.00', '0.00', '1.98', '199.00', 'Card', '', 'paid', 1, 3, '199.00', '0.00', 'incl', 1, '%', '004', 1, NULL, 0, 0, NULL, ''),
(4, 1004, '2023-03-09', '2023-03-09', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Wallet', '', 'partial', 10, 3, '0.02', '1.00', 'incl', 1, '%', '1022', 1, NULL, 0, 0, NULL, ''),
(5, 1005, '2023-03-13', '2023-03-13', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Wallet', '', 'paid', 1, 3, '2.02', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(6, 1006, '2023-04-04', '2023-04-04', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 1, 3, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(7, 1007, '2023-04-06', '2023-04-06', 0, '99.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '99.00', 'Cash', 'no', 'paid', 1, 3, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(8, 1008, '2023-04-06', '2023-04-06', 0, '423.00', '10.91', '1.09', 'incl', '0.00', '0.00', '45.32', '435.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(9, 1009, '2023-04-06', '2023-04-06', 0, '2310.25', '0.00', '0.00', 'incl', '315.03', '0.00', '281.28', '2310.25', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(10, 1010, '2023-04-06', '2023-04-06', 0, '11.83', '10.91', '1.09', 'incl', '1.61', '0.00', '1.44', '23.83', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(11, 1011, '2023-04-06', '2023-04-06', 0, '13.00', '0.91', '0.09', 'incl', '0.13', '0.00', '0.13', '14.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(12, 1012, '2023-04-18', '2023-04-18', 0, '218.79', '0.00', '0.00', 'incl', '2.21', '0.00', '21.00', '218.79', NULL, '', 'due', 1, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(13, 1013, '2023-04-18', '2023-04-18', 0, '14.26', '0.00', '0.00', 'incl', '10.24', '0.00', '2.50', '14.26', NULL, 'fds', 'due', 1, 2, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(14, 1014, '2023-04-18', '2023-04-18', 0, '65.75', '0.00', '0.00', 'incl', '4.25', '0.00', '10.00', '65.75', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(15, 1015, '2023-04-18', '2023-04-18', 0, '124.50', '0.00', '0.00', 'incl', '80.50', '0.00', '55.00', '124.50', NULL, '', 'due', 12, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(16, 1016, '2023-04-18', '2023-04-18', 0, '93.50', '0.00', '0.00', 'incl', '16.50', '0.00', '10.00', '93.50', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(17, 1017, '2023-04-18', '2023-04-18', 0, '4490.04', '0.00', '0.00', 'incl', '612.28', '0.00', '778.32', '4490.04', NULL, '', 'due', 12, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(18, 1018, '2023-04-19', '2023-04-19', 0, '39.00', '0.00', '0.00', 'incl', '11.00', '0.00', '8.74', '39.00', NULL, 'test', 'due', 12, 1, '0.00', '2.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(19, 1019, '2023-04-19', '2023-04-19', 0, '29.70', '0.00', '0.00', 'incl', '0.30', '0.00', '0.30', '29.70', NULL, 'test', 'due', 12, 1, '0.00', '2.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(20, 1020, '2023-04-19', '2023-04-19', 0, '48.60', '0.00', '0.00', 'incl', '9.40', '0.00', '8.00', '48.60', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(21, 1021, '2023-05-04', '2023-05-04', 0, '99.75', '0.00', '0.00', 'incl', '5.25', '0.00', '5.00', '99.75', NULL, '', 'due', 11, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(22, 1022, '2023-05-05', '2023-05-05', 0, '742.00', '0.00', '0.00', 'incl', '0.00', '0.00', '42.00', '742.00', 'Wallet', '', 'partial', 13, 1, '42.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(23, 1023, '2023-05-09', '2023-05-09', 0, '619.40', '0.00', '0.00', 'incl', '0.00', '0.00', '29.40', '619.40', NULL, '', 'due', 14, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(24, 1024, '2023-05-12', '2023-05-12', 0, '5.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '5.00', 'Wallet', '', 'paid', 1, 1, '5.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(25, 1025, '2023-05-16', '2023-05-16', 0, '354.00', '0.00', '0.00', 'incl', '0.00', '0.00', '54.00', '354.00', NULL, '', 'due', 14, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(26, 1026, '2023-05-17', '2023-05-17', 0, '155.82', '9.09', '0.91', 'incl', '3.18', '0.00', '9.00', '165.82', NULL, 'Server', 'due', 13, 10, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(27, 1027, '2023-05-17', '2023-05-17', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Maybank2U', 'Ipay88 Test', 'paid', 13, 1, '2.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(29, 1029, '2023-05-17', '2023-05-17', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 14, 11, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(31, 1001, '2023-05-18', '2023-05-18', 0, '157.50', '0.00', '0.00', 'incl', '0.00', '0.00', '7.50', '157.50', 'Cash', '', 'paid', 1, 1, '157.50', '5.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(32, 1030, '2023-05-19', '2023-05-19', 0, '200.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '200.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(33, 1031, '2023-05-31', '2023-05-31', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 1, 10, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(34, 1032, '2023-05-31', '2023-05-31', 0, '1.01', '0.00', '0.00', 'incl', '0.00', '0.00', '0.01', '1.01', NULL, '', 'due', 10, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(36, 1033, '2023-05-31', '2023-05-31', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(37, 1034, '2023-05-31', '2023-05-31', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(38, 1035, '2023-06-07', '2023-06-07', 0, '1652.00', '0.00', '0.00', 'incl', '28.00', '0.00', '180.00', '1652.00', NULL, '', 'due', 10, 3, '0.00', '2.00', 'yes', 1, '%', '0', 1, NULL, 0, 0, NULL, ''),
(39, 1036, '2023-06-07', '2023-06-07', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '120.00', '2120.00', NULL, '', 'due', 10, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(40, 1037, '2023-06-12', '2023-06-12', 0, '1060.00', '0.00', '0.00', 'incl', '0.00', '0.00', '60.00', '1060.00', NULL, '', 'due', 33, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(41, 1038, '2023-06-12', '2023-06-12', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 28, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(42, 1039, '2023-06-13', '2023-06-13', 0, '500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '500.00', NULL, '', 'due', 28, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(43, 1002, '2023-06-14', '2023-06-14', 0, '5.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '5.00', 'Cash', '', 'paid', 1, 1, '5.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(44, 1040, '2023-06-14', '2023-06-14', 0, '424.00', '0.00', '0.00', 'incl', '0.00', '0.00', '24.00', '424.00', NULL, '', 'due', 28, 24, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(45, 1041, '2023-06-15', '2023-06-15', 0, '270.00', '0.00', '0.00', 'incl', '30.00', '0.00', '0.00', '270.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(46, 1042, '2023-06-15', '2023-06-15', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 40, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(47, 1043, '2023-06-16', '2023-06-16', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2500.00', NULL, '', 'due', 36, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(48, 1044, '2023-06-16', '2023-06-16', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2500.00', NULL, '', 'due', 40, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(49, 1045, '2023-06-16', '2023-06-16', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2500.00', NULL, '', 'due', 39, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(50, 1046, '2023-06-16', '2023-06-16', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2500.00', NULL, '', 'due', 38, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(51, 1047, '2023-06-16', '2023-06-16', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2500.00', NULL, '', 'paid', 37, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(53, 1003, '2023-06-21', '2023-06-21', 0, '18.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '18.00', 'Cash', 'POS Test', 'paid', 1, 24, '18.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(54, 1048, '2023-06-27', '2023-06-27', 0, '742.00', '0.00', '0.00', 'incl', '0.00', '0.00', '42.00', '742.00', NULL, 'This is to test the modules', 'due', 25, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(55, 1004, '2023-06-27', '2023-06-27', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(56, 1005, '2023-06-27', '2023-06-27', 0, '11.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '11.00', 'Cash', '', 'paid', 1, 1, '11.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(57, 1006, '2023-06-28', '2023-06-28', 0, '11.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '11.00', 'Cash', '', 'paid', 1, 1, '11.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(58, 1007, '2023-06-28', '2023-06-28', 0, '11.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '11.00', 'Cash', '', 'paid', 1, 1, '11.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(59, 1008, '2023-06-28', '2023-06-28', 0, '11.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '11.00', 'Cash', '', 'paid', 1, 1, '11.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(60, 1009, '2023-06-28', '2023-06-28', 0, '12.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '12.00', 'Cash', '', 'paid', 1, 1, '12.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(61, 1010, '2023-06-28', '2023-06-28', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(62, 1011, '2023-06-28', '2023-06-28', 0, '11.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '11.00', 'Cash', '', 'paid', 1, 1, '11.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(63, 1012, '2023-06-28', '2023-06-28', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(64, 1013, '2023-06-29', '2023-06-29', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(65, 1014, '2023-06-29', '2023-06-29', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(67, 1015, '2023-06-29', '2023-06-29', 0, '6.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '6.00', 'Cash', '', 'paid', 1, 1, '6.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(71, 1016, '2023-07-05', '2023-07-05', 0, '21.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '21.00', 'Cash', '', 'paid', 1, 1, '21.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(72, 1017, '2023-07-05', '2023-07-05', 0, '47.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '47.00', 'Cash', '', 'paid', 1, 1, '47.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(73, 1018, '2023-07-05', '2023-07-05', 0, '52.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '52.00', 'Cash', '', 'paid', 1, 1, '52.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(75, 1019, '2023-07-05', '2023-07-05', 0, '78.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '78.00', 'Cash', '', 'paid', 1, 1, '78.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(76, 1020, '2023-07-05', '2023-07-05', 0, '104.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '104.00', 'Cash', '', 'paid', 1, 1, '104.00', '4.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(77, 1021, '2023-07-05', '2023-07-05', 0, '73.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '73.00', 'Cash', '', 'paid', 1, 1, '73.00', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(78, 1022, '2023-07-05', '2023-07-05', 0, '26.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '26.00', 'Cash', '', 'paid', 1, 1, '26.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(79, 1023, '2023-07-05', '2023-07-05', 0, '125.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '125.00', 'Cash', '', 'paid', 1, 1, '125.00', '5.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(80, 1024, '2023-07-06', '2023-07-06', 0, '26.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '26.00', 'Cash', '', 'paid', 1, 1, '26.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(81, 1049, '2023-07-06', '2023-07-06', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', '2930.00', NULL, '', 'due', 43, 28, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(82, 1050, '2023-07-10', '2023-07-10', 0, '106.00', '0.00', '0.00', 'incl', '0.00', '0.00', '6.00', '106.00', NULL, '', 'due', 10, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(83, 1051, '2023-07-10', '2023-07-10', 0, '106.00', '0.00', '0.00', 'incl', '0.00', '0.00', '6.00', '106.00', NULL, '', 'due', 25, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(84, 1025, '2023-07-10', '2023-07-10', 0, '173.72', '0.00', '0.00', 'incl', '0.00', '0.00', '1.72', '173.72', 'Cash', '', 'paid', 1, 1, '173.72', '4.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(85, 1026, '2023-07-10', '2023-07-10', 0, '219.42', '0.00', '0.00', 'incl', '1.52', '0.00', '1.93', '219.42', 'Cash', '', 'paid', 1, 1, '219.42', '3.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(86, 1052, '2023-07-11', '2023-07-11', 0, '318.00', '0.00', '0.00', 'incl', '0.00', '0.00', '18.00', '318.00', NULL, '', 'due', 10, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(87, 1053, '2023-07-11', '2023-07-11', 0, '330.00', '0.00', '0.00', 'incl', '0.00', '0.00', '30.00', '330.00', NULL, '', 'due', 10, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(88, 1054, '2023-07-11', '2023-07-11', 0, '318.00', '0.00', '0.00', 'incl', '0.00', '0.00', '18.00', '318.00', NULL, '', 'due', 25, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(89, 1055, '2023-07-11', '2023-07-11', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 25, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(90, 1056, '2023-07-11', '2023-07-11', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '7.20', '127.20', NULL, '', 'due', 11, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(91, 1057, '2023-07-11', '2023-07-11', 0, '10.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '10.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 2, NULL, 0, 0, NULL, ''),
(92, 1058, '2023-07-14', '2023-07-14', 0, '318.00', '0.00', '0.00', 'incl', '0.00', '0.00', '18.00', '318.00', NULL, '', 'due', 11, 4, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(93, 1059, '2023-07-14', '2023-07-14', 0, '212.00', '0.00', '0.00', 'incl', '0.00', '0.00', '12.00', '212.00', NULL, '', 'due', 10, 40, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(94, 1060, '2023-07-14', '2023-07-14', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '18.00', '318.00', NULL, '', 'due', 10, 4, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(95, 1061, '2023-07-14', '2023-07-14', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '138.00', '2438.00', NULL, '', 'due', 51, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(96, 1062, '2023-07-17', '2023-07-17', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '30.00', '530.00', NULL, '', 'paid', 11, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(97, 1063, '2023-07-17', '2023-07-17', 0, '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '60.00', '1360.00', 'Cash', '', 'paid', 11, 40, '1360.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(98, 1064, '2023-07-18', '2023-07-18', 0, '100.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'canceled', 25, 40, '0.00', '0.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(100, 1066, '2023-07-19', '2023-07-19', 0, '2023.00', '0.00', NULL, 'off', '530.00', '0.00', '300.00', '4770.00', 'Wallet', '', 'paid', 74, 40, '4770.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(101, 1027, '2023-07-19', '2023-07-19', 0, '378.75', '0.00', '0.00', 'incl', '3.03', '0.00', '3.78', '378.75', 'Cash', '', 'paid', 1, 40, '378.75', '4.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(103, 1067, '2023-07-19', '2023-07-19', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', 'Balance', '', 'paid', 1, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(104, 1068, '2023-07-19', '2023-07-19', 0, '21624.00', '0.00', '0.00', 'incl', '3816.00', '0.00', '1440.00', '21624.00', 'Cash', '', 'partial', 16, 28, '500.00', '4.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(105, 1069, '2023-09-13', '2023-09-13', 0, '90.00', '0.00', '0.00', 'incl', '10.00', '0.00', '22.00', '90.00', 'Cash', 'dsafasfg', 'paid', 1, 58, '90.00', '1.00', '', 1, 'flat', '', 1, NULL, 0, 0, NULL, ''),
(106, 1070, '2023-09-13', '2023-09-13', 0, '1098.00', '0.00', '0.00', 'incl', '122.00', '0.00', '220.00', '1098.00', 'Cash', '', 'paid', 84, 58, '1098.00', '1.00', '', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(107, 1071, '2023-09-13', '2023-09-13', 0, '2196.00', '0.00', '0.00', 'incl', '244.00', '0.00', '440.00', '2196.00', 'Cash', '', 'paid', 1, 58, '0.00', '2.00', '', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(108, 1072, '2023-10-04', '2023-10-04', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'canceled', 10, 53, '0.00', '0.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(109, 1001, '2023-10-05', '2023-10-12', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 2, 0, '7 day', ''),
(110, 1002, '2023-10-05', '2023-10-12', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 10, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 2, 0, '7 day', ''),
(111, 1003, '2023-10-05', '2023-10-12', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 12, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 2, 0, '7 day', ''),
(112, 1028, '2023-10-10', '2023-10-10', 0, '86.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '86.00', 'Cash', '', 'paid', 12, 53, '86.00', '2.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(113, 1073, '2023-11-17', '2023-11-17', 0, '2070.00', '0.00', '0.00', 'incl', '20.00', '0.00', '0.00', '2070.00', NULL, '', 'paid', 32, 53, '0.00', '16.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(114, 1074, '2023-11-22', '2023-11-22', 0, '300.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '300.00', 'Cash', '', 'paid', 1, 53, '300.00', '20.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(115, 1075, '2023-11-22', '2023-11-22', 0, '500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '500.00', 'Cash', '', 'paid', 1, 53, '500.00', '4.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL, ''),
(116, 1029, '2023-12-19', '2023-12-19', 0, '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '43.00', 'Cash', '', 'paid', 0, 58, '43.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(117, 1030, '2023-12-19', '2023-12-19', 0, '43.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '43.00', 'Cash', '', 'paid', 0, 58, '43.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(118, 1031, '2023-12-19', '2023-12-19', 0, '297.00', '0.00', '0.00', 'incl', '3.00', '0.00', '0.00', '297.00', 'Cash', '', 'paid', 0, 58, '297.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, ''),
(119, 1032, '2023-12-19', '2023-12-19', 0, '297.00', '0.00', '0.00', 'incl', '3.00', '0.00', '0.00', '297.00', 'Cash', '', 'paid', 0, 58, '297.00', '1.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_invoice_items`
--

DROP TABLE IF EXISTS `gtg_invoice_items`;
CREATE TABLE IF NOT EXISTS `gtg_invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL DEFAULT '0',
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `i_class` int NOT NULL DEFAULT '0',
  `unit` varchar(5) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_invoice_items`
--

INSERT INTO `gtg_invoice_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `i_class`, `unit`, `serial`) VALUES
(2, 2, 0, 'Website', '', '1.00', '2000.00', '10.00', '5.00', '1900.00', '181.82', '100.00', '', 0, '', ''),
(5, 3, 0, 'website with hosting', '', '1.00', '200.00', '1.00', '1.00', '198.00', '1.98', '2.00', '', 0, '', ''),
(6, 4, 0, 'test', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', ''),
(7, 1, 0, 'website', '', '1.00', '2.00', '10.00', '0.00', '2.00', '0.18', '0.00', '', 0, '', ''),
(8, 5, 0, 'test', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', ''),
(11, 8, 0, '', '', '1.00', '423.00', '12.00', '0.00', '423.00', '45.32', '0.00', '', 0, '', ''),
(14, 11, 0, 'test', '', '1.00', '13.00', '1.00', '1.00', '13.00', '0.13', '0.13', '', 0, '', ''),
(15, 12, 0, 'test', '', '1.00', '100.00', '10.00', '1.00', '108.90', '10.00', '1.10', '', 0, '', ''),
(16, 12, 0, 'fast', '', '1.00', '100.00', '11.00', '1.00', '109.89', '11.00', '1.11', '', 0, '', ''),
(17, 13, 0, 'test', '', '1.00', '10.00', '1.00', '100.00', '0.00', '0.10', '10.10', '', 0, '', ''),
(18, 13, 0, 'a', '', '1.00', '12.00', '20.00', '1.00', '14.26', '2.40', '0.14', '', 0, '', ''),
(19, 14, 0, 'Item One', '', '1.00', '50.00', '10.00', '5.00', '52.25', '5.00', '2.75', '', 0, '', ''),
(20, 14, 0, 'item two', '', '1.00', '10.00', '50.00', '10.00', '13.50', '5.00', '1.50', '', 0, '', ''),
(21, 15, 0, 'itemone', '', '1.00', '50.00', '10.00', '10.00', '49.50', '5.00', '5.50', '', 0, '', ''),
(22, 15, 0, 'semi final', '', '1.00', '100.00', '50.00', '50.00', '75.00', '50.00', '75.00', '', 0, '', ''),
(23, 16, 0, 'item one', '', '1.00', '50.00', '10.00', '10.00', '49.50', '5.00', '5.50', '<br data-mce-bogus=\"1\">', 0, '', ''),
(24, 16, 0, 'test ing item', '', '1.00', '50.00', '10.00', '20.00', '44.00', '5.00', '11.00', '', 0, '', ''),
(25, 17, 0, 'testing one', '', '1.00', '4324.00', '18.00', '12.00', '4490.04', '778.32', '612.28', '', 0, '', ''),
(26, 18, 0, 'one item', '', '1.00', '20.00', '10.00', '10.00', '18.00', '1.82', '2.00', '<div xss=removed>This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. This is a part of programming content. </div>', 0, '', ''),
(27, 18, 0, 'two item', '', '1.00', '30.00', '30.00', '30.00', '21.00', '6.92', '9.00', '', 0, '', ''),
(28, 19, 0, 'services takan', '', '1.00', '10.00', '1.00', '1.00', '9.90', '0.10', '0.10', 'test', 0, '', ''),
(29, 19, 0, 'test item', '', '1.00', '20.00', '1.00', '1.00', '19.80', '0.20', '0.20', '', 0, '', ''),
(30, 20, 0, 'test', '', '1.00', '20.00', '10.00', '10.00', '19.80', '2.00', '2.20', 'test', 0, '', ''),
(31, 20, 0, 'test2', '', '1.00', '30.00', '20.00', '20.00', '28.80', '6.00', '7.20', 'test 2 description', 0, '', ''),
(32, 21, 0, 'test', '', '1.00', '100.00', '5.00', '5.00', '99.75', '5.00', '5.25', 'Testing for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdafTesting for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdafTesting for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdafTesting for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdafTesting for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdafTesting for this text area is fixed or not. Testing for this text area is fixed or not. Testing for this text area is fixed or not. dsadadad sdfdfafasd sdaf', 0, '', ''),
(33, 22, 0, '1', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', 'Test <br>test<br>test ', 0, '', ''),
(34, 22, 0, '2', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', 'Test', 0, '', ''),
(35, 23, 0, 'Domain & Hosting', '', '1.00', '490.00', '6.00', '0.00', '519.40', '29.40', '0.00', '<div>Domain Hosting Renewal -</div>\r\n<div>kkkm.my - 1 Year/s</div>\r\n<div>(28/04/2023 - 27/04/2024)</div>', 0, '', ''),
(36, 23, 0, 'Reconnection', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', 'Reconnection Charges \"kkkm.my\"', 0, '', ''),
(37, 24, 0, 'Hhh', '', '1.00', '2.00', '0.00', '0.00', '2.00', '0.00', '0.00', 'Hhhh', 0, '', ''),
(38, 24, 0, 'Hdjd', '', '1.00', '3.00', '0.00', '0.00', '3.00', '0.00', '0.00', '<div xss=removed>Tyeueejŕrrrŕrfgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggcccgccghhdhhdhdhhjjjdjjjrhhrhhrhrhhrhdrjjjrnbbrbrbbdbbdbdbdhrhrhrhrhdhdhhddhh4hdhh3hhdudjrbbdeijerbrheje brg4brrr4bbrhhrjrrj</div>', 0, '', ''),
(39, 25, 0, 'Wire replaced', '', '1.00', '200.00', '18.00', '0.00', '236.00', '36.00', '0.00', 'Burn wire replaced', 0, '', ''),
(40, 25, 0, 'Service Visiting Charges', '', '1.00', '100.00', '18.00', '0.00', '118.00', '18.00', '0.00', '', 0, '', ''),
(41, 26, 0, 'Server ', '', '1.00', '150.00', '6.00', '2.00', '155.82', '9.00', '3.18', '1 TB<br>HP<br>Test <br>Test', 0, '', ''),
(42, 27, 0, 'Ipay88 Testing', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', ''),
(44, 29, 0, 'Testing ', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', 'Testing', 0, '', ''),
(46, 31, 1, 'AVT tea-00165', '00165', '5.00', '30.00', '5.00', '0.00', '157.50', '7.50', '0.00', NULL, 1, '', ''),
(47, 32, 0, 'Chicken', '', '1.00', '200.00', '0.00', '0.00', '200.00', '0.00', '0.00', '', 0, '', ''),
(48, 33, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(49, 33, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(50, 34, 0, 'Test', '', '1.00', '1.00', '1.00', '0.00', '1.01', '0.01', '0.00', '', 0, '', ''),
(52, 36, 0, 'Test DEV', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', ''),
(53, 37, 0, 'Test DEV 1', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', ''),
(54, 38, 0, 'Testing Website UX UI', '', '1.00', '500.00', '12.00', '5.00', '532.00', '60.00', '28.00', 'Testing Personal Website UX UI', 0, '', ''),
(55, 38, 0, 'Email required ', '', '1.00', '1000.00', '12.00', '0.00', '1120.00', '120.00', '0.00', 'Five email required', 0, '', ''),
(56, 39, 0, 'A Bog Website ', '', '1.00', '1000.00', '12.00', '0.00', '1120.00', '120.00', '0.00', 'A Bog Website with five pages', 0, '', NULL),
(57, 39, 0, 'Email', '', '1.00', '1000.00', '0.00', '0.00', '1000.00', '0.00', '0.00', '1 email', 0, '', NULL),
(58, 40, 0, 'data migration ', '', '1.00', '1000.00', '6.00', '0.00', '1060.00', '60.00', '0.00', 'data Migration&nbsp;', 0, '', ''),
(59, 40, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(60, 41, 0, 'Data Migration', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', 'From Old Server to New Server', 0, '', ''),
(61, 42, 0, 'Server Replacement', '', '1.00', '500.00', '0.00', '0.00', '500.00', '0.00', '0.00', '1) Old server replaced to new Server<br>2) Data Migration', 0, '', ''),
(62, 43, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(63, 44, 0, 'Server Replacement', '', '1.00', '400.00', '6.00', '0.00', '424.00', '24.00', '0.00', '1) Old server to new server replacement<br>2) Data migration', 0, '', ''),
(64, 45, 0, 'abc', '', '1.00', '300.00', '0.00', '10.00', '270.00', '0.00', '30.00', 'esing&nbsp;', 0, '', ''),
(65, 46, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(66, 47, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', 0, '', NULL),
(67, 48, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', 0, '', NULL),
(68, 49, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', 0, '', NULL),
(69, 50, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', 0, '', NULL),
(70, 51, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', 0, '', NULL),
(71, 53, 3, 'nasi goreng -ng0034', 'ng0034', '3.00', '6.00', '0.00', '0.00', '18.00', '0.00', '0.00', NULL, 1, '', ''),
(72, 54, 0, 'Testing1', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', 'Line break<br>Line break 1<br>Line break 2<br>Line Break 3', 0, '', ''),
(73, 54, 0, 'Test 2', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', 'Line Break 4<br>Line Break 5<br>Line Break 6', 0, '', ''),
(74, 55, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(75, 56, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(76, 56, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(77, 57, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(78, 57, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(79, 58, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(80, 58, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(81, 59, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(82, 59, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(83, 60, 3, 'nasi goreng -ng0034', 'ng0034', '2.00', '6.00', '0.00', '0.00', '12.00', '0.00', '0.00', NULL, 1, '', ''),
(84, 61, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(85, 62, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(86, 62, 2, 'nasi lemak -ns003', 'ns003', '1.00', '5.00', '0.00', '0.00', '5.00', '0.00', '0.00', NULL, 1, '', ''),
(87, 63, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(88, 64, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(89, 65, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(90, 67, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '6.00', '0.00', '0.00', '6.00', '0.00', '0.00', NULL, 1, '', ''),
(93, 71, 2, 'nasi lemak -ns003', 'ns003', '1.00', '21.00', '0.00', '0.00', '21.00', '0.00', '0.00', NULL, 1, '', ''),
(94, 72, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '26.00', '0.00', '0.00', '26.00', '0.00', '0.00', NULL, 1, '', ''),
(95, 72, 2, 'nasi lemak -ns003', 'ns003', '1.00', '21.00', '0.00', '0.00', '21.00', '0.00', '0.00', NULL, 1, '', ''),
(96, 73, 3, 'nasi goreng -ng0034', 'ng0034', '2.00', '26.00', '0.00', '0.00', '52.00', '0.00', '0.00', NULL, 1, '', ''),
(97, 75, 3, 'nasi goreng -ng0034', 'ng0034', '3.00', '26.00', '0.00', '0.00', '78.00', '0.00', '0.00', NULL, 1, '', ''),
(98, 76, 3, 'nasi goreng -ng0034', 'ng0034', '4.00', '26.00', '0.00', '0.00', '104.00', '0.00', '0.00', NULL, 1, '', ''),
(99, 77, 3, 'nasi goreng -ng0034', 'ng0034', '2.00', '26.00', '0.00', '0.00', '52.00', '0.00', '0.00', NULL, 1, '', ''),
(100, 77, 2, 'nasi lemak -ns003', 'ns003', '1.00', '21.00', '0.00', '0.00', '21.00', '0.00', '0.00', NULL, 1, '', ''),
(101, 78, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '26.00', '0.00', '0.00', '26.00', '0.00', '0.00', NULL, 1, '', ''),
(102, 79, 3, 'nasi goreng -ng0034', 'ng0034', '4.00', '26.00', '0.00', '0.00', '104.00', '0.00', '0.00', NULL, 1, '', ''),
(103, 79, 2, 'nasi lemak -ns003', 'ns003', '1.00', '21.00', '0.00', '0.00', '21.00', '0.00', '0.00', NULL, 1, '', ''),
(104, 80, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '26.00', '0.00', '0.00', '26.00', '0.00', '0.00', NULL, 1, '', ''),
(105, 81, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Hardware Cashier Machine -Touch screen Monitor&nbsp;', 0, '', NULL),
(106, 81, 0, '', '', '1.00', '430.00', '0.00', '0.00', '430.00', '0.00', '0.00', 'Thermal Receipt Printer USB + Serial Port + LAN 4MB, 256 bytes Input AC 100-240V 50/60 Hz Output DC 24V/2.5A Max 83mmm Auto Cutter', 0, '', NULL),
(107, 82, 0, 'ssss', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'ess', 0, '', ''),
(108, 83, 0, 'aaaa', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'aaaa', 0, '', ''),
(109, 84, 7, 'Dolo 650-9639633', '9639633', '4.00', '43.00', '1.00', '0.00', '173.72', '1.72', '0.00', NULL, 1, '', ''),
(110, 85, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.43', '0.43', '0.00', NULL, 1, '', ''),
(111, 85, 3, 'nasi goreng -ng0034', 'ng0034', '1.00', '26.00', '0.00', '0.00', '26.00', '0.00', '0.00', NULL, 1, '', ''),
(113, 86, 0, 'yruwyeor', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'mnzvc,dsbcb.csaasn/ds/', 0, '', ''),
(114, 86, 0, 'erwiu', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', '', 0, '', ''),
(115, 87, 0, 'hdgsadkda', '', '1.00', '100.00', '10.00', '0.00', '110.00', '10.00', '0.00', 'sbxkjsadaldkad', 0, '', ''),
(116, 87, 0, 'wruetqweiewq', '', '1.00', '200.00', '10.00', '0.00', '220.00', '20.00', '0.00', 'sfdhhadgadhsaldaj;', 0, '', ''),
(117, 88, 0, 'sghachadsfk', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'jvdjsakgksadshdsld', 0, '', ''),
(118, 88, 0, 'hjdgsaksa;sal', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', 'cvjhcsaddsl', 0, '', ''),
(119, 89, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(120, 90, 0, 'ssssssssssssssssssssssss', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'sdasassasdsdsadsadsadsad', 0, '', NULL),
(121, 90, 0, 'sdsadsasafsasafas', '', '1.00', '20.00', '6.00', '0.00', '21.20', '1.20', '0.00', 'sadsadsadadsdsada', 0, '', NULL),
(122, 91, 0, 'Yyyy', '', '1.00', '10.00', '0.00', '0.00', '10.00', '0.00', '0.00', 'Wewrtw', 0, '', ''),
(123, 92, 0, 'laptop ', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'LAptop Spec&nbsp;<br>xxxxxxxxxxxxxxxxxxxxx<br>x<br>xx<br>x<br>x', 0, '', ''),
(124, 92, 0, 'Personal Computer ', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', 'komputer Maintgenance&nbsp;&nbsp;<br>sdsadaslsadsdjsa<br>\'s;dasjd;sadj;sak', 0, '', ''),
(125, 93, 0, 'zczcxzcxzcxzczx', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', '', 0, '', ''),
(126, 93, 0, 'wewewqe', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', '', 0, '', ''),
(127, 94, 0, 'Laptop ', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'jhcasfjhdgaskgdasdjkasldhasdh;asjd;lasd;lasdlasdasjd\'sadas\'dkasdadfasukdfqwtiuqwtuetqweyqwyeioqwiogasjgdkgasdkjgsdjfgasjdfasdhflashflsdkgsdgfkasdfklsdhfkljdgfjsdfjsdhfhasdlfjas;dfjslk', 0, '', NULL),
(128, 94, 0, 'Personal Computer', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', '', 0, '', NULL),
(129, 95, 0, 'WEBSITE ', '', '1.00', '2300.00', '6.00', '0.00', '2438.00', '138.00', '0.00', '', 0, '', NULL),
(130, 96, 0, 'ABC', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', '', 0, '', NULL),
(131, 97, 0, 'HAGSCHS', '', '1.00', '1000.00', '6.00', '0.00', '1060.00', '60.00', '0.00', '', 0, '', NULL),
(132, 97, 0, 'SDSFSFDS', '', '1.00', '300.00', '0.00', '0.00', '300.00', '0.00', '0.00', '', 0, '', NULL),
(133, 98, 0, 'Test', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', 'Test', 0, '', ''),
(136, 100, 0, 'DELL Laptop ', '', '1.00', '5000.00', '6.00', '10.00', '4770.00', '300.00', '530.00', 'DELL&nbsp;', 0, '', NULL),
(137, 101, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.43', '0.43', '0.00', NULL, 1, '', ''),
(138, 101, 4, 'Test coffee by siva-741741', '741741', '1.00', '35.00', '1.00', '0.00', '35.35', '0.35', '0.00', NULL, 1, '', ''),
(141, 103, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(142, 104, 0, 'DELL LAPTOP', '', '4.00', '6000.00', '6.00', '15.00', '21624.00', '1440.00', '3816.00', '500 GB SSD32GB RAMGTX 3060 8GB', 0, '', ''),
(143, 105, 0, 'jhkjhkj', '', '1.00', '100.00', '22.00', '10.00', '90.00', '22.00', '10.00', '', 0, '', ''),
(144, 106, 0, ',jjbmhjkhkh', '', '1.00', '1000.00', '22.00', '10.00', '1098.00', '220.00', '122.00', '', 0, '', ''),
(145, 107, 0, 'jkhjhkj', '', '1.00', '1000.00', '22.00', '10.00', '1098.00', '220.00', '122.00', '', 0, '', ''),
(146, 107, 0, 'hghghjghj', '', '1.00', '1000.00', '22.00', '10.00', '1098.00', '220.00', '122.00', '', 0, '', ''),
(147, 108, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', ''),
(148, 109, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', NULL),
(149, 110, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', NULL),
(150, 111, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 0, '', NULL),
(151, 112, 7, 'Dolo 650-9639633', '9639633', '2.00', '43.00', '1.00', '0.00', '86.00', '0.00', '0.00', NULL, 1, '', ''),
(152, 113, 6, 'Test coffe one', '8965896', '10.00', '200.00', '1.00', '1.00', '1980.00', '0.00', '20.00', '', 0, '', ''),
(153, 113, 8, 'Test coffe one by siva', '741741', '6.00', '15.00', '0.00', '0.00', '90.00', '0.00', '0.00', '', 0, '', ''),
(154, 114, 8, 'Test coffe one by siva', '741741', '10.00', '15.00', '0.00', '0.00', '150.00', '0.00', '0.00', '', 0, '', ''),
(155, 114, 4, 'Test coffee by siva', '741741', '10.00', '15.00', '1.00', '0.00', '150.00', '0.00', '0.00', '', 0, '', ''),
(156, 115, 7, 'Dolo 650', '9639633', '4.00', '125.00', '1.00', '0.00', '500.00', '0.00', '0.00', '', 0, '', ''),
(157, 116, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, '', ''),
(158, 117, 7, 'Dolo 650-9639633', '9639633', '1.00', '43.00', '1.00', '0.00', '43.00', '0.00', '0.00', '', 1, '', ''),
(159, 118, 5, 'coffee new1-85412', '85412', '1.00', '300.00', '1.00', '1.00', '297.00', '0.00', '3.00', '', 1, '', ''),
(160, 119, 5, 'coffee new1-85412', '85412', '1.00', '300.00', '1.00', '1.00', '297.00', '0.00', '3.00', '', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_job`
--

DROP TABLE IF EXISTS `gtg_job`;
CREATE TABLE IF NOT EXISTS `gtg_job` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(20) DEFAULT NULL,
  `job_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `job_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `userid` int DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `cname` varchar(150) DEFAULT NULL,
  `clocation` varchar(255) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `ctime` time DEFAULT NULL,
  `cinvoice` int DEFAULT '0',
  `require_date` datetime DEFAULT NULL,
  `remarks` text NOT NULL,
  `completed_time` text NOT NULL,
  `status` int DEFAULT '3',
  `created_by` int DEFAULT NULL,
  `action` text,
  `man_days` int DEFAULT NULL,
  `latlon` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `signature` text NOT NULL,
  `signature_date` text NOT NULL,
  `job_priority` text NOT NULL,
  `vehicle_id` int NOT NULL DEFAULT '0',
  `do_number` text,
  `job_clock_out_photo` text,
  `job_clock_out_location` text,
  `work_in_progress_start_time` text,
  `job_unique_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_job`
--

INSERT INTO `gtg_job` (`id`, `ref_no`, `job_name`, `job_description`, `userid`, `cid`, `cname`, `clocation`, `cdate`, `ctime`, `cinvoice`, `require_date`, `remarks`, `completed_time`, `status`, `created_by`, `action`, `man_days`, `latlon`, `updated_at`, `created_at`, `signature`, `signature_date`, `job_priority`, `vehicle_id`, `do_number`, `job_clock_out_photo`, `job_clock_out_location`, `work_in_progress_start_time`, `job_unique_id`) VALUES
(12, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 2, NULL, '2023-02-06 07:31:39', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(13, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(14, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-02-06 11:29:28', 1, NULL, NULL, 2, NULL, '2024-02-06 11:29:28', '2023-01-27 11:49:02', 'data:image/png;base64,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', '01-02-2024 05:47:52', '', 0, NULL, NULL, NULL, NULL, ''),
(15, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 2, NULL, '2023-01-27 11:55:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(16, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 2, NULL, '2023-02-07 04:13:37', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(17, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2023-12-21 11:13:12', 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', 'data:image/png;base64,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', '21-12-2023 11:16:04', '', 0, NULL, NULL, NULL, NULL, ''),
(18, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2023-12-21 10:10:55', 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:55:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(19, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(20, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-02-01 05:56:29', 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(21, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(22, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(23, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 2, NULL, '2023-02-07 04:20:55', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(24, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(25, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(26, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(27, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(28, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(29, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(30, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(31, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(32, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(33, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(34, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(35, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(36, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(37, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(38, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(39, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(40, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(41, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(42, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-01-26 05:41:39', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, '2024-01-26 05:41:21', ''),
(43, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(44, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(45, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(46, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(47, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(48, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(49, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-01-29 07:41:20', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(50, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(51, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(52, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-01-29 06:15:05', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(53, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-01-24 03:37:50', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(54, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(55, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAADICAYAAAA0n5+2AAAafklEQVR4Xu3dO6h92V0H8KQRFMVHIYLIHLUQq5mAYCU5qSK+ZlKIWs2Nlhb5pxC0kPyjgiJC/qkt5k6lhTAzPiqLnGAKOzNqFcTcEUULQdEQH0Xw9yV7ke2Z+ziPfc5Ze5/PhsU59/73Y63P2sP9ztrrrPPBD9gIECBAgAABAgQmFfjgpGdzMgIECBAgQIAAgQ8IWG4CAgQIECBAgMDEAgLWxKBOR4AAAQIECBAQsNwDBAgQIECAAIGJBQSsiUGdjgABAgQIECAgYLkHCBAgQIAAAQITCwhYE4M6HQECBAgQIEBAwHIPECBAgAABAgQmFhCwJgZ1OgIECBAgQICAgOUeIECAAAECBAhMLCBgTQzqdAQIECBAgAABAcs9QIAAAQIECBCYWEDAmhjU6QgQIECAAAECApZ7gAABAgQIECAwsYCANTGo0xEgQIAAAQIEBCz3AAECBAgQIEBgYgEBa2JQpyNAgAABAgQICFjuAQIECBAgQIDAxAIC1sSgTkeAAAECBAgQELDcAwQIECBAgACBiQUErIlBnY4AAQIECBAgIGC5BwgQIECAAAECEwsIWBODOh0BAgQIECBAQMByDxAgQIAAAQIEJhYQsCYGdToCBAgQIECAgIDlHiBAgAABAgQITCwgYE0M6nQECBAgQIAAAQHLPUCAAAECBAgQmFhAwJoY1OkIECBAgAABAgKWe4AAAQIECBAgMLGAgDUxqNMRIECAAAECBAQs9wABAgQIECBAYGIBAWtiUKcjQIAAgYMFvqOOfKVKXt8++CwOJNCBgIDVQSeoAgECBK5YIGHqtSqvj8JVOD5SZXPFLpo+cwEBa+YdqPoECBCYoUAbqfpE1X1V5d+rvFPlK1V+s8q/DAErv7cRmKWAgDXLblNpAgQIzFIgYWpdJaNVXxxCVV4TpDKK9UaVL1X56PC7WTZSpQlEQMByHxAgQIDAKQXGo1VtpGozClD5909Vuany6Sq3wtUpu8O5zyUgYJ1L2nUIECBwXQKram5GpV6u8vkqmbS+/chvXb/7TJWErI9XSfCyEViEgIC1iG7UCAIECHQjkNCUR4DvDYHpvtCUQJVglX3z75+8J3x10yAVIXCIgIB1iJpjCBAgQGAs0B4Dvlq/fLfK7QM82e+mSh4J3g3B6r4ARpfA7AUErNl3oQYQIEDgIgIJSynr4TVBKRPWH9qyX0atVlXMtbpIl7noOQUErHNquxYBAgTmL9ACVcJV5lQlWD22nMI4WH229n3xxP7zF9ICAiUgYLkNCBAgQGAXgUxY/3CVTFh/KlTlfAlWmYuV4zKylUnsd7tcyD4EliAgYC2hF7WBAAEC0wtkhGo1KglVjz0CbDXYDlaZwL7LcdO3wBkJXFBAwLogvksTIECgQ4EEq2fDaFNCVR7/7bKieoJVVmbPawKVYNVh56rS+QQErPNZuxIBAgR6FXilKtYmra/q/e2OoSrtybH5VGAeBWatq0xgN2LVa0+r19kEBKyzUbsQAQIEuhJogSqjTllaYTOEql1Gq9qyDO1TgTlWsOqqe1Xm0gIC1qV7wPUJECBwXoFVXW49jDIlKGW0aZdQlVq2dawyeT3nua3y5nCO87bC1Qh0LiBgdd5BqkeAAIEJBPIYL1tCUbY8yttna/OyMtqVMJZQlXB1t89J7EvgmgQErGvqbW0lQOCaBNojwJtq9KbKPiNVzSmBLKEq86tasHpxTYjaSuBQAQHrUDnHESBAoD+BtrTCuqqWUaoEpISrfbeMeGV+VV5zfBYIPSSg7Xtd+xNYjICAtZiu1BACBK5YICNMCVcJQwlF+z4CDF2Oz3kyYpVglnO0YHXFtJpO4DABAeswN0cRIEDg0gIJQxlVyuvdgaGqBau2zEJ+zvyqPAbcdeL7pR1cn0CXAgJWl92iUgQIEHifQEaY1kOoyutmCEGHBqGcY/xVNhmtaufET4DAkQIC1pGADidAgMAJBdqcqrzm0d/tcK1DQ1UOfzYEq9UQqKxfdcIOdOrrFRCwrrfvtZwAgT4FEnyyJVClPK+SgHVMqFoP58qjwPZpwIS1uz4J1IrA/AUErPn3oRYQIDB/gQSgzRCmEnoSfo4NVW3Ua/z9gJlflcnrx4S1+WtrAYEzCAhYZ0B2CQIECGwJtEd/CTo3Q7iaahmEnDvnzPyq9snCPAZMcLMRIHAmAQHrTNAuQ4DA1QusRwJ5n0/qZZtqNCmPE9uk9fYYMKNVgtXV33oALiEgYF1C3TUJELgGgfapv4Sd1RB0Mko1ZahqjwEztyoBa1MljwHzOlVwu4a+0kYCkwsIWJOTOiEBAlcokKCT8lqV9qhv/Km/qUnatTK/qj0GtCjo1MrOR+AIAQHrCDyHEiBwtQIJT3dV1lVWVd6q8qEqmyqnHDlqjwFz3QSrhCqPAa/2NtTwngUErJ57R90IELi0QEJMtoxMtS2jRp8cBan22O9UdX3oMWCClY0AgU4FBKxOO0a1CBA4u0ALU6shUL1Ur+9VebXKpsrnq9xVOXWgag1vnwbM9VOnBKrMrzrX9c/eAS5IYEkCAtaSelNbCBDYR6DNm1rXQR8eQkwLWS1QJcwkVJ1zy2PAjJjlE4F53JhQdTu8P2c9XIsAgSMEBKwj8BxKgMBsBO4LU6uqfQtUCTDvVkmwOnegCmJ7DNgWBU09fBpwNreXihJ4v4CA5a4gQGCJAgks6yoZDWqjUwlUbQJ6AtW5H/nd5+zTgEu8+7SJQAkIWG4DAgTmLtBGfxKoXq6SIJVg1bY85nunyl2VvO9hDlMLfxmxyubTgHO/C9WfwJaAgOWWIEBgTgItTCVEtcnf4zCVtmxGgSrv26hVD+1MsPIYsIeeUAcCJxYQsE4M7PQECBwlkPCUUJJg1QJVmzeVEyc8JUTdDaEqo1M9BarW+ExaT7BKe1Lf9t2APdb1qA5zMAECXxcQsNwJBAj0IDCehJ7HfAkiKeMwlXomSLUwlaDSw+O+x/yeDcEq7Xh7FKx6MFcHAgROKCBgnRDXqQkQeFBgVf+yrvJYmGqBKkEq61EloCRc9T7qkzDVglXqmk8DvphBvd2uBAhMKCBgTYjpVAQI3CvQRqMSqvKJvvtGpnJgwkgCVJuUntf8PJct7ctjwJuhwlntPaGw90A4F1/1JDArAQFrVt2lsgS6FmiP+RI01lXumzM1bkCCR0JUlkvI62amYSSBsQWrtKF9IrDrzlI5AgROKyBgndbX2QksWaCNTOUxXwJVgtX2nKntQJUAkkCV197nTz3Vd2n/Z6rkNW3JxPW0y0aAAAGT3N0DBAg8KTCegN4e8T0VpnLShI65Pu57CCUWbcRqPQSqBKu5h8UnbwI7ECCwn4ARrP287E1g6QIJEAlPCRH7hKnx477NEDiWNPcoLq9VyaPA+KSNgtXS/2vQPgJHCAhYR+A5lMDMBdpoTAtTCQ4pjz3ma02+G0JGWyE9Py8pULV2xuKmSr54Oe8TrDLHyojVzG9+1SdwagEB69TCzk+gD4EEp+1Rqfxuly3hKYEiX4b8dpWlhqlti2f1i/ZVNglWbXHQXczsQ4DAlQsIWFd+A2j+4gRakMprW2Mq73cZlQpGe9SXEDUOVIuDeqRBgtU19ba2EjiRgIB1IlinJXAGgYxItUA1DlP7XDpBajOEqbzm5yU+6tvFJMHqU0P7M1KXR4HxsBEgQGBvAQFrbzIHEDi7QAtRec3E87ym7Doq1SqcsJAyXibhWsPUuBNvhmAVzwQrjwLPfou7IIHlCQhYy+tTLZqvwHjSed4/tVDnYy1NkGrzpjZDsMrvbN8QWNfbto7Vbb3PyusCpzuEAIFJBASsSRidhMBeAglPKasqh3yCb/tibd5UAlVGp1q42qtSV7RzglUeBeY1I1YJVjGzESBAYDIBAWsySici8D6B7SD10vBHPcFq38d77eQJAikJUtf0ib4pbq+E2YxYCVZTaDoHAQKPCghYbhAC0wgkNOUPeBuZGs+VOuQKGZVKkGqP+fLawtUh57vmY9I3GbG6qbKp4ittrvlu0HYCZxIQsM4E7TKLEsgf7HWV8Sf38rtDt/vCVAKV+UCHin79uPRJ+xLm/JxHgbfHndLRBAgQ2E1AwNrNyV7XKZA/0BmVSsnjvbYswqGP96J4V6WNRmUV9BauhKnp7rH0z7MhXOWsGbF6Md3pnYkAAQJPCwhYTxvZY/kC40/vTTFPKmItOG3q/XtV8ppwJUid7n5q/dg+GZhQlXDF/HTmzkyAwAMCApZb45oE2qTzdTV6qsd78UtwanOl2vv8bDufwPYEdl/EfD57VyJA4B4BActtsVSBVTWsPdI7ZnHOsc/2XKnNEK6MkFzuLkpozgT2PBJMuM08q7cvVx1XJkCAwNcFBCx3wtwF8gc2YWpdJaNSLVgdM08qJvljnVGo8bpSCVLCVB93TPr3tSp5HJgtX2uTR4L6p4/+UQsCVy8gYF39LTAbgPZ4L6NSbUSqjVAd2oj2xzhBKsVcqUMlz3tcwvR4odCPC1bn7QBXI0DgaQEB62kje5xfYDzpfDxX6phRqfZ4766ak1GpBKr8zlyp8/fvoVccPw5Mv+Vx4ObQkzmOAAECpxQQsE6p69y7CGQUqo1EjR/x7XLsQ/skOOUPbwtTeRWkjhG9/LHrqsJbQzVu69WnAy/fJ2pAgMAjAgKW2+NcAqu6UJs3M9WaUm0EKq9tVCphKsW2DIHcM29UyXyrTZWMWgnLy+hbrSCwaAEBa9Hde5HGtblS67p6QlULUxmlOmYbz5PK+xakTGo+RrXvY59V9TLXKltGrG6r6O+++0ztCBAYBAQst8IxAm2uVIJUyqtV8ru8P3Qbj0plpfMEqTZf6tBzOm5eAuuqbr7iJq/p+0xiz31gI0CAwGwEBKzZdNXFK5rQlJI/ehmVyiObbIdOPE+QamEqfzzHE8+NUly8uy9WgZu68njU6u3hPrlYhVyYAAEChwgIWIeoLf+YNuk8rxmVynbMI777glRClSC1/Htp1xbm/mpfzLyp9+Za7SpnPwIEuhQQsLrslrNVqs2X+sW64g9U+d5RkDp0ZCp/HLO1Ean2eE+YOlu3zu5CGQ3NgqGrIVi9mF0LVJgAAQJbAgLWdd0SGSVYV0l4yshU/qAdGqQSmO6qtHlSeW+u1HXdT8e2Nvde+5qbTb3PRPa82ggQIDB7AQFr9l34/xownmCeMNUW6Wy/PzRMtfCU1zeHKyZM2QgcKrCuAzNqlfv0tkoeCRrlPFTTcQQIdCcgYHXXJfdWaByQVrVHC0ptYc72qC//duj2tTrwq1X+rsqmSr42JiGqBSl//A6Vddy2wLP6RUauck/5cmb3BwECixQQsPro1hag1kN4+vZ6TVjK/923MHXo6NN9LbyrX7by7vDeXKk+7oUl1yL3cFs0NPdbll8wErrkHtc2AlcsIGBdvvPzR+fLoyB1bI0SnDIykNL+eLUQ1eZNGY06Vtnx+wrkfxjyVTf5n4a3h3DlPtxX0f4ECMxGQMC6fFflD08C1vbW/vi0UNSCU/ZLYGq/z88tULX3l2+VGhD4hsBr9TYjV9kykf0FHAIECCxdQMDqo4czJyUjWQlRLUiNA1QftVQLAvsLPK9DMt8qo6kJVxm9shEgQGDxAgLW4rtYAwlcRGB7vtXHhv95uEhlXJQAAQLnFhCwzi3uegSWL7AaRq1uhhGrTGY332r5/a6FBAiMBAQstwMBAlMKJFy1yex5JPh8ypM7FwECBOYiIGDNpafUk0D/AushXKWmWd/qtv8qqyEBAgROIyBgncbVWQlcm8BNNTgrswtX19bz2kuAwL0CApYbgwCBYwWyDEMeC2aeVeZb+aTgsaKOJ0Bg9gIC1uy7UAMIXFQgS4z8bpV/GsLV5qK1cXECBAh0IiBgddIRqkFghgI3VecsIPqVKj9R5S9m2AZVJkCAwEkEBKyTsDopgcULtK94SkOzxpWRq8V3uQYSILCPgIC1j5Z9CRBoAnk0mEntlmJwTxAgQOAeAQHLbUGAwCECz+ugfAVOJrXfHnICxxAgQGDJAgLWkntX2wicTuCmTp35V/nEYB4R2ggQIEBgJCBguR0IEDhEIHOwPlflFSHrED7HECCwdAEBa+k9rH0ETiewqlO3r8XJGlhWbz+dtTMTIDAzAQFrZh2mugQ6FMhk90x6b9uLevPZKncd1lWVCBAgcBYBAesszC5CYPECGc3KpPebUUs39f6LVd4cXhePoIEECBBoAgKWe4EAgakFMpr14Sr5Cp225RFiJsR/fnjNzzYCBAgsVkDAWmzXahiBLgRuqhavV8lk+EyMb9um3mR0qwWuLiqrEgQIEJhKQMCaStJ5CBB4SiAjWhnZWg+Bq+2f0ay7obTHifnZRoAAgdkKCFiz7ToVJzBrgYxmJXC9PLzm5zbClcCVMp6/JXDNurtVnsD1CQhY19fnWkygR4GEq3WVNndrNapkG+Ha1O/eqZJXGwECBLoWELC67h6VI3C1AuMRrptSGM/fCkomzLewdXe1ShpOgEC3AgJWt12jYgQIjATW9T6lzeEa42zqh0yWf06MAAECvQgIWL30hHoQILCrwKp2zPyt9unE8XEWOd1V0X4ECJxUQMA6Ka+TEyBwYoGMaqVkkdPxtqkfPl7l7sTXd3oCBAjcKyBguTEIEFiKQBY4/USV1ahBGdHKdyTaCBAgcFYBAeus3C5GgMAZBG7qGvl+xDYxPqNYH6mSVxsBAgTOIiBgnYXZRQh0JTBec2ocOvL7JX2FzVvVnvZ1PWlXQlbW1rIRIEDg5AIC1smJXYBAFwIJT/m6ml+u8uNVvnWo1X/Ua8p3VfmWIWD9bb1+qcqfVMlyCHPe3qjK3wwN+Md6/b45N0bdCRCYj4CANZ++UlMChwgkWGVu0qtDwNr3HHd1QL6+5vm+B3a0/59WXX5yqM+v1+tvdVQ3VSFAYKECAtZCO1azCAzBKp+u216k8xCcf6iDfn+m4eSlqneCYrY/q/JThwA4hgABAvsICFj7aNmXwHwEfqOqmtGa+7b/rV9+04FN+Zs67mdGgeXA05z9sC/XFVdVMhfrO89+dRckQODqBASsq+tyDb4Sgf+sdrZ5Vq3JCRf/WuXvq3y1yg9W+UKVP6iS/e+GHT9arz9cJUse3Df6lfN8ukqWQJjDljb8VZXV0Mbvn0Ol1ZEAgXkLCFjz7j+1J/CQwD/XP3zPjjy3tV8W5bxve16/3F7Es+2XkJV/7/3Th+M2ZNL+x3Z0sRsBAgQOFhCwDqZzIIGuBX6+apeRqV22Te2UJQwe2hKg/rzKj9yzw//U775W5Zur5NOIf1Tll3a56Bn2Sb0TDm+qtBCYcJX22ggQIHBSAQHrpLxOTuCiAqshXDz0qC+Vy+O+rHR+u0NNx0sePLZ7lkP4sSp3O5zzFLu0JSlS3xi0zarup9B2TgIE7hUQsNwYBK5DoIWOFqpa8MjCm/sEoSz5kFXSn9py3g89tdPE//7QkhRzmzM2MYvTESBwCQEB6xLqrklg3gJZsDSjYjdPNKPN0Tpla1twfL0uklXbtyflb+p3GaGzgvspe8G5CRB4n4CA5aYgQOBQgVUd+KNVMv/qv6s8r/JDWyd7uX7+60Mv8MBxLVRl8dSEvO1QlRGrBCrBamJ4pyNAYHcBAWt3K3sSIPC4QIJOFiT9ttFumfT+sxPBZeQso1QPrUqfUPVOldsqdxNd02kIECBwkICAdRCbgwgQeEDgt+v3vzr6twSdY9ademheVbtERquy9MJnq3gM6LYkQKAbAQGrm65QEQKLEEgg+rdRS/6r3udLpPfZ2iPALLGQUauHHgEmVG2qJGTZCBAg0JWAgNVVd6gMgUUIZKX48ajVr9TPv7dDyx4brWrzqoSqHSDtQoDA5QUErMv3gRoQWJrAH1eDfnrUqDzCe2z19FX9e/tU4n2fAsy8qpzjbmlQ2kOAwHIFBKzl9q2WEbiUwLou/LnRxTP6lDWxtgNSwtTvVPm5KuNglf03VbLMg3lVl+pF1yVA4CgBAesoPgcTIPCAwJfr96vRv/1Cvf/D4ef2KHB7hfkEqzwCvL0njIEmQIDArAQErFl1l8oSmI1AllN4a1TbL9T7fDfid1fJoqDj8JU1tH5tCFYmrM+mi1WUAIHHBAQs9wcBAqcS2B7F2r6OEatTyTsvAQIXFxCwLt4FKkBgsQLratl4Lta4oZv6wUrri+16DSNAQMByDxAgcEqBrGOVuVYJW3kU+JdVLAp6SnHnJkCgCwEBq4tuUAkCBAgQIEBgSQIC1pJ6U1sIECBAgACBLgQErC66QSUIECBAgACBJQkIWEvqTW0hQIAAAQIEuhAQsLroBpUgQIAAAQIEliQgYC2pN7WFAAECBAgQ6EJAwOqiG1SCAAECBAgQWJKAgLWk3tQWAgQIECBAoAsBAauLblAJAgQIECBAYEkCAtaSelNbCBAgQIAAgS4EBKwuukElCBAgQIAAgSUJCFhL6k1tIUCAAAECBLoQELC66AaVIECAAAECBJYkIGAtqTe1hQABAgQIEOhCQMDqohtUggABAgQIEFiSgIC1pN7UFgIECBAgQKALAQGri25QCQIECBAgQGBJAgLWknpTWwgQIECAAIEuBASsLrpBJQgQIECAAIElCQhYS+pNbSFAgAABAgS6EBCwuugGlSBAgAABAgSWJCBgLak3tYUAAQIECBDoQkDA6qIbVIIAAQIECBBYkoCAtaTe1BYCBAgQIECgCwEBq4tuUAkCBAgQIEBgSQIC1pJ6U1sIECBAgACBLgQErC66QSUIECBAgACBJQkIWEvqTW0hQIAAAQIEuhAQsLroBpUgQIAAAQIEliQgYC2pN7WFAAECBAgQ6EJAwOqiG1SCAAECBAgQWJKAgLWk3tQWAgQIECBAoAsBAauLblAJAgQIECBAYEkCAtaSelNbCBAgQIAAgS4EBKwuukElCBAgQIAAgSUJCFhL6k1tIUCAAAECBLoQELC66AaVIECAAAECBJYkIGAtqTe1hQABAgQIEOhCQMDqohtUggABAgQIEFiSgIC1pN7UFgIECBAgQKALAQGri25QCQIECBAgQGBJAv8HaxpF9izJyrEAAAAASUVORK5CYII=', '26-01-2024 06:30:43', '', 0, NULL, NULL, NULL, NULL, ''),
(56, NULL, 'test', 'test', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 1, NULL, NULL, 672, NULL, '2023-02-06 05:06:03', '2023-02-06 05:06:03', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(57, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '2024-02-02 12:20:28', 1, NULL, NULL, 2, NULL, '2023-02-06 05:06:24', '2023-02-06 05:06:24', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(59, NULL, 'Testing GTG', 'Testing M2 complete ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', '', 3, 6, NULL, 4, NULL, '2023-02-20 09:16:15', '2023-02-20 09:16:15', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(60, NULL, 'title', 'title with description', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-17', '17:09:00', 1, NULL, '', '', 6, 6, NULL, 2, NULL, '2023-04-17 11:43:09', '2023-04-17 11:43:09', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(61, NULL, 'test sytem', 'System have bugs', 3, 12, 'testing1 ', 'first line, city test', '2023-04-18', '16:03:00', 1, NULL, '', '', 5, 6, NULL, 2, NULL, '2023-04-18 10:35:14', '2023-04-18 10:34:00', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(62, NULL, 'test', 'test', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-20', '13:34:00', 1, NULL, '', '', 3, 6, NULL, 2, NULL, '2023-04-20 08:05:09', '2023-04-20 08:05:09', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(63, NULL, 'test', 'tset', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-20', '13:36:00', 1, NULL, '', '', 3, 6, NULL, 2, NULL, '2023-04-20 08:06:50', '2023-04-20 08:06:50', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(64, NULL, 'create', 'test', NULL, 11, 'testing ', 'first line, city test', '2023-05-05', '09:30:00', 1, NULL, '', '', 3, 6, NULL, 672, NULL, '2023-05-04 09:00:47', '2023-05-04 09:00:47', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(65, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, '', '', 3, 6, NULL, 672, NULL, '2023-05-04 09:03:41', '2023-05-04 09:03:41', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(66, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, '', '', 3, 6, NULL, 672, NULL, '2023-05-04 09:09:43', '2023-05-04 09:09:43', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(67, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, '', '', 3, 6, NULL, 672, NULL, '2023-05-04 09:10:11', '2023-05-04 09:10:11', '', '', '', 0, NULL, NULL, NULL, NULL, '');
INSERT INTO `gtg_job` (`id`, `ref_no`, `job_name`, `job_description`, `userid`, `cid`, `cname`, `clocation`, `cdate`, `ctime`, `cinvoice`, `require_date`, `remarks`, `completed_time`, `status`, `created_by`, `action`, `man_days`, `latlon`, `updated_at`, `created_at`, `signature`, `signature_date`, `job_priority`, `vehicle_id`, `do_number`, `job_clock_out_photo`, `job_clock_out_location`, `work_in_progress_start_time`, `job_unique_id`) VALUES
(68, NULL, 'test', 'Services', 3, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, '', '', 5, 6, NULL, 672, NULL, '2023-05-04 09:12:15', '2023-05-04 09:10:52', 'data:image/png;base64,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', '24-01-2024 01:53:39', '', 0, NULL, NULL, NULL, NULL, ''),
(69, NULL, 'Server Update', 'Replace the server', 11, 13, 'Testing2 ', 'Oasis Square', '2023-05-05', '11:00:00', 0, NULL, '', '', 1, 6, NULL, 4, NULL, '2023-05-05 10:44:28', '2023-05-05 10:44:01', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(70, NULL, 'Test', 'Replace the server', 10, 13, 'Testing2 ', 'Oasis Square', '2023-05-05', '18:46:00', 0, NULL, '', '', 1, 6, NULL, 4, NULL, '2023-05-05 10:46:51', '2023-05-05 10:46:40', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(71, NULL, 'Hard Disk Update', 'Upgrade Hard Disk', 11, 13, 'Testing2 ', 'No 40, KL', '2023-05-11', '17:30:00', 0, NULL, '', '', 1, 6, NULL, 4, NULL, '2023-05-11 03:35:26', '2023-05-11 03:35:03', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(72, NULL, 'Server Test', 'Test Server', 11, 13, 'Testing2 ', 'No 40, KL', '2023-05-11', '16:00:00', 1, NULL, '', '', 1, 6, NULL, 6, NULL, '2023-05-11 04:03:38', '2023-05-11 04:03:29', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(73, NULL, 'Customer House Electricity Issue', 'Faccing the electricity ', 3, 14, 'udhayaraja ', 'no 36 anna street, madurai', '2023-05-16', '18:04:00', 1, NULL, '', '2024-02-06 11:21:08', 1, 6, NULL, 2, NULL, '2024-02-06 11:21:08', '2023-05-16 10:35:20', '', '', '', 0, NULL, NULL, NULL, '2024-02-06 00:27:36', ''),
(74, NULL, 'Server Replacement', 'Replace the server', 10, 13, 'Testing2 ', 'No 40, KL', '2023-05-17', '15:43:00', 1, NULL, '', '', 1, 6, NULL, 8, NULL, '2023-05-17 04:42:28', '2023-05-17 04:40:35', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(75, NULL, 'Hard disk', 'Testing description', 11, 12, 'testing1 ', 'first line, city test', '2023-05-17', '12:44:00', 1, NULL, '', '', 2, 6, NULL, 6, NULL, '2023-05-18 08:25:31', '2023-05-17 04:41:42', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(76, NULL, 'CCTV Fixing', 'Add 2 CCTV', NULL, 13, 'Testing2 ', 'No 40, KL', '2023-05-19', '22:00:00', 1, NULL, '', '', 3, 6, NULL, 4, NULL, '2023-05-18 08:41:47', '2023-05-18 08:41:47', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(77, NULL, 'Counter', 'Testing M2 complete ', 3, 10, 'Jsoftsolution ', '414 Krishna enclave, Mohali', '2023-06-07', '14:41:00', 1, NULL, '', '', 1, 6, NULL, 2, NULL, '2023-06-07 09:05:49', '2023-06-07 09:05:33', 'data:image/png;base64,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', '23-01-2024 12:32:39', '', 0, NULL, NULL, NULL, NULL, ''),
(79, NULL, 'Server Replacement ', 'Replace the server', 24, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '0000-00-00', '00:00:00', 1, NULL, '', '', 4, 6, NULL, 4, NULL, '2023-06-14 04:22:56', '2023-06-12 01:59:20', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(80, NULL, 'data migration ', 'data migration for Puteri ', 2, 33, 'puteri  ', 'shah alam , Shah  alam ', '2023-06-12', '11:16:00', 1, NULL, '', '', 1, 6, NULL, 72, NULL, '2023-06-12 02:22:09', '2023-06-12 02:18:09', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(81, NULL, 'Data Migration', 'Migration from old to new server', 24, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-15', '13:00:00', 1, NULL, '', '', 1, 6, NULL, 8, NULL, '2023-06-12 05:07:48', '2023-06-12 04:52:32', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(90, NULL, 'Server Replacement', 'Old server replaced to new server and data migrati', 24, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-16', '11:21:00', 1, NULL, '', '', 1, 6, NULL, 4, NULL, '2023-06-13 03:24:50', '2023-06-13 03:21:59', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(92, NULL, 'my future job', 'regiser my future job', 27, 25, 'JSOFT SOLUTION SDN BHD ', 'Level 15 , DPluze, Cyberjaya', '2023-06-21', '07:58:00', 0, NULL, '', '', 1, 6, NULL, 2, NULL, '2023-06-20 11:00:03', '2023-06-20 10:59:46', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(93, NULL, 'Test status', 'status WOP', 24, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-21', '08:30:00', 1, NULL, '', '2024-02-01 03:11:31', 1, 6, NULL, 4, NULL, '2023-06-21 06:45:35', '2023-06-21 06:45:26', 'data:image/png;base64,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', '01-02-2024 03:29:46', '', 0, NULL, NULL, NULL, '2024-02-01 03:01:28', ''),
(95, NULL, 'Test', 'Test', 28, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-21', '16:09:00', 1, NULL, '', '', 4, 6, NULL, 2, NULL, '2023-06-21 08:41:42', '2023-06-21 08:09:18', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(96, NULL, 'Test 2', 'Test', 3, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-21', '16:32:00', 1, NULL, 'Not available.', '2024-01-22 02:01:19', 1, 6, NULL, 4, NULL, '2023-06-29 09:20:15', '2023-06-21 08:32:46', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(97, NULL, 'test', 'Test', 28, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-21', '18:45:00', 1, NULL, '', '', 4, 6, NULL, 2, NULL, '2023-06-21 02:48:15', '2023-06-21 10:45:15', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(98, NULL, 'Test ', 'Test', NULL, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-21', '22:47:00', 1, NULL, '', '', 3, 6, NULL, 2, NULL, '2023-06-21 02:48:06', '2023-06-21 02:48:06', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(99, NULL, 'Task in Advance date', 'Test', 28, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-28', '15:00:00', 0, NULL, '', '', 2, 6, NULL, NULL, NULL, '2023-06-23 07:59:51', '2023-06-23 07:59:35', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(100, NULL, 'Testing', 'Testing', 28, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '0000-00-00', '00:00:00', 1, NULL, '', '', 5, 6, NULL, 4, NULL, '2023-06-27 08:44:08', '2023-06-27 08:27:35', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(101, NULL, 'Test SLA Red Flag', 'Red Flag', NULL, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-06-29', '14:00:00', 0, NULL, '', '', 3, 6, NULL, 6, NULL, '2023-06-28 02:03:26', '2023-06-28 02:03:26', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(102, NULL, 'Er', 'Er', 4, 10, 'Jsoftsolution ', '414 Krishna enclave, Mohali ggg', '2023-06-30', '05:24:00', 0, NULL, '', '', 5, 6, NULL, 2, NULL, '2023-06-29 09:25:32', '2023-06-29 09:25:32', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(103, NULL, 'Test', 'Tst', 28, 28, 'John ', 'c-1-3 Ara Damandsara, KL', '2023-07-07', '22:45:00', 1, NULL, '', '', 2, 6, NULL, 4, NULL, '2023-07-06 09:43:53', '2023-07-06 09:43:42', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(104, NULL, 'Site Vsit ', 'PJ', 4, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '0000-00-00', '00:00:00', 1, NULL, '', '', 2, 6, NULL, 2, NULL, '2023-07-17 08:07:29', '2023-07-17 08:06:52', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(105, NULL, 'S', 'D', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-07-25', '05:29:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2023-07-17 07:29:52', '2023-07-17 07:29:52', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(106, NULL, 'Account Service ', 'Account Service ', 40, 15, 'Febriyanto Wijaya ', '7 Boulevard Palem Raya #22-00 Menara Matahari,Lipp, Tangerang', '2023-07-26', '16:45:00', 1, NULL, '', '', 2, 6, NULL, 4, NULL, '2023-07-19 08:42:06', '2023-07-19 08:41:50', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(107, NULL, 'kjkl', 'kljkj', NULL, 25, 'JSOFT SOLUTION SDN BHD ', 'Level 15 , DPluze, Cyberjaya', '2023-12-21', '05:36:00', 0, NULL, '', '', 3, 6, NULL, 24, NULL, '2023-12-21 08:35:12', '2023-12-21 08:35:12', '', '', '', 0, NULL, NULL, NULL, NULL, '');
INSERT INTO `gtg_job` (`id`, `ref_no`, `job_name`, `job_description`, `userid`, `cid`, `cname`, `clocation`, `cdate`, `ctime`, `cinvoice`, `require_date`, `remarks`, `completed_time`, `status`, `created_by`, `action`, `man_days`, `latlon`, `updated_at`, `created_at`, `signature`, `signature_date`, `job_priority`, `vehicle_id`, `do_number`, `job_clock_out_photo`, `job_clock_out_location`, `work_in_progress_start_time`, `job_unique_id`) VALUES
(108, NULL, 'SP NEW', 'jhjhk', 40, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-12-21', '19:13:00', 1, NULL, '', '2023-12-22 10:15:46', 1, 6, NULL, 10, NULL, '2023-12-21 10:13:10', '2023-12-21 10:12:42', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA8AAAADICAYAAAAnbYhrAAAgAElEQVR4Xu3dbag9230X8FuxRJu0sakUG2qzbw1CrTWNIvqiTU76SrAl9yKCUmxOahHypv6lCFoKubXYtCjk1vpGKvYEK0Ks5MYHVHyRHdoiBW1yKYIPwe6AD8GqMdeatqm1/r5mVjLd3ed/5pyzH2bNfAbWfz+c2TNrfdb8957vXjOzv+AZEwECBAgQIECAAAECBAgQWIHAF6ygjZpIgAABAgQIECBAgAABAgSeEYBtBAQIECBAgAABAgQIECCwCgEBeBXdrJEECBAgQIAAAQIECBAgIADbBggQIECAAAECBAgQIEBgFQIC8Cq6WSMJECBAgAABAgQIECBAQAC2DRAgQIAAAQIECBAgQIDAKgQE4FV0s0YSIECAAAECBAgQIECAgABsGyBAgAABAgQIECBAgACBVQgIwKvoZo0kQIAAAQIECBAgQIAAAQHYNkCAAAECBAgQIECAAAECqxAQgFfRzRpJgAABAgQIECBAgAABAgKwbYAAAQIECBAgQIAAAQIEViEgAK+imzWSAAECBAgQIECAAAECBARg2wABAgQIECBAgAABAgQIrEJAAF5FN2skAQIECBAgQIAAAQIECAjAtgECBAgQIECAAAECBAgQWIWAALyKbtZIAgQIECBAgAABAgQIEBCAbQMECBAgQIAAAQIECBAgsAoBAXgV3ayRBAgQIECAAAECBAgQICAA2wYIECBAgAABAgQIECBAYBUCAvAqulkjCRAgQIAAAQIECBAgQEAAtg0QIECAAAECBAgQIECAwCoEBOBVdLNGEiBAgAABAgQIECBAgIAAbBsgQIAAAQIECBAgQIAAgVUICMCr6GaNJECAAAECBAgQIECAAAEB2DZAgMBUgd82zLip25Q2/c+6k7Ibbqcuz3wECBAgQIAAAQIEziogAJ+V28oIzEoggfaqSm5TEmAzJcy+psobh+ffULdfP9zf3NGCLOOjVf7LcPv+YXmzarjKECBAgAABAgQIrFNAAF5nv2v1ugWuqvl/s8qXDaH21BoJ1NsqL1e5qZKQbCJAgAABAgQIECBwdgEB+OzkVkjgIgJttPfdtfaM5j5mSqDN1G7bCPLUZW5rxh+q8tLUF5iPAAECBAgQIECAwDEEBOBjKFoGgXkLXFX13nsg+P5yPfcDVXZDaef4tnN62+O0LvPsB99xqzPvZlS+qe7/ripfNDx3SOh768kX5k2ndgQIECBAgAABAksSEICX1JvaQuDXCySUZsT3yR5MgmxGYG+q7M6E9lytJyPPbx9u22rfOdTjTNWwGgIECBAgQIAAgTULCMBr7n1tX7LAphr3oSq5bVOCb0Zdb6q00dxLGFzXSn90WHHq8eyF63MJA+skQIAAAQIECBC4gIAAfAF0qyRwYoGMtCb8jg9hzvm2GW29ZPAdNzsBOEE403dXec+JTSyeAAECBAgQIECAwDMCsI2AwLIEcqhxwuX4fN6M+r44s2amfp8c6vSJuv2KmdVPdQgQIECAAAECBBYoIAAvsFM1abUCCb8fGLU+o73PV9nOVOSVqtcXV/nUKLDPtKqqRYAAAQIECBAgsAQBAXgJvagNBJ555jsK4UdGEB+t+znkObdznT5SFWs/yfTmmdd1robqRYAAAQIECBAgcA8BAfgeWGYlMFOBXOU5P3PUpoTejPzuZlrfVq0cAt0O1c6FsOZe35lzqh4BAgQIECBAgMBdAgLwXUL+TmDeAgm+4585+qf1+F0dhMnx4doJvgnAJgIECBAgQIAAAQInFRCAT8pr4QROJpCR01zsKkGyTbnQVS54NZcrPT+t8blK9dUwQ65QnRFrEwECBAgQIECAAIGTCgjAJ+W1cAInExj/jFBW0lP4TfBNAG7T2+rO9mRSFkyAAAECBAgQIEBgEBCAbQoE+hM4FH7/XEfNGF/8yuhvRx2nqgQIECBAgACB3gUE4N57UP3XJrB/waueRn7TV9dVEuDbZPR3bVuw9hIgQIAAAQIELiggAF8Q36oJ3FMgPxmUQ4fblZO3dT/nzvZwzm+amnqn/u2nj27qfn6qyUSAAAECBAgQIEDgLAIC8FmYrYTAowUSHj9Q5WpYUn7qKKOnvYTfVPu6Shv9Tb3z27+7R8tYAAECBAgQIECAAIGJAgLwRCizEbiwQM6VffuoDj0eOjw+9zeHbvd03vKFu9/qCRAgQIAAAQIEjiEgAB9D0TIInFbguhY/Pm82wTEBsqdp/Lu/Rn976jl1JUCAAAECBAgsSEAAXlBnasoiBXLoc0ZON0PrfrZu31Klp0OfU/WbKu8Y2uDKz4vcVDWKAAECBAgQIDB/AQF4/n2khusW+DPV/L8xIni27u86IxmH+F+qun9Nh23ojFx1CRAgQIDAgwRyocpNlXxZbSKwSAEBeJHdqlELEnhPteUvDO351br9zR22bfzTTd9b9X+hwzaoMgECBAgQWKJAvqRO6P09Vf54lauhkT1+4b7E/tGmEwgIwCdAtUgCRxTIzwa1D6P/WPe/rkpPhz9vqr45hDsfsPk2OT971FP9j9iVFkWAAAECBGYhkP2KlLcOt/lliZ+q8rVVPjjUsLdrjcwCViX6EBCA++gntVynQL6RTXhsU87//X0dUYwPfd5VvfOzR8JvRx2oqgQIECCwCIHsT6Tk1yRym8D7cpV8Nud+ionAagQE4NV0tYZ2KLAfgNOEbZXnOwmSbfQ6oTeHUgm/HW6EqkyAAAECXQnky+dMmyq5+GQe5/M3gTdHYvks7qo7VfYUAgLwKVQtk8DxBP59LeqNe4vLh1cOJZ7zBSrys03XVV6pkkOsfLt8vG3CkggQIECAwFggITfluSHgZj8hJZ+9Aq9thcCegABskyAwb4GMAud8nK86UM0E4Pwm8G5mTUjwfe/wYfwtdfuPZlY/1SFAgAABAr0KbIbP13z2Pxn2AbI/0A5tFnh77Vn1PpuAAHw2aisi8GCBfKubQJlgeWh6sZ5MEJ7DlA/gHPqcOrvi8xx6RB0IECBAoFeBfJZuhson2GaEN1M7lFnY7bVn1fuiAgLwRfmtnMC9BK5r7nePPgzHL86HYELwzb2WeNyZ80Gd8JsQnHrkMG0TAQIECBAgME1gU7O1w5lzP2VXZVulHdY8bUnmIkDgVgEB2MZBoC+BfBgmBF/fUu2c7/NDVW4u0KyMUudwrNThbcOH9QWqYZUECBAgQGD2AuPzdltl23m7O5+hs+8/FexYQADuuPNUfdUCGWXNhaZye2g6dxC+HuqTD+/83FE+vE0ECBAgQIDAZwUSeK+qbIb7eS6f1dsqDmW2lRA4o4AAfEZsqyJwAoHrWuZth0W3D9dTjwjnnKSE8Xy4Z+Q3H+YmAgQIECCwVoGE3JR8SZ3PxvZ53EZ4Bd61bhnaPQsBAXgW3aASBB4tkEOP/+zwgXtoYacaEXbRq0d3nQUQIECAQMcC7UJVV9WGNw3tSMDN7+7mszfFRIDAjAQE4Bl1hqoQOIJARmMThPNBfGj6mXryu6psj7CurOMDVfLh74rPRwC1CAIECBCYvcCmapjP2kwJvHmckJufLMyt0d3Zd6EKrl1AAF77FqD9SxXIyGyC8PUtDXypns+h0dsHAmS57bd+c/XpFx+4HC8jQIAAAQJzFGgXqcrtO4YK5v7Hh6CbsLubY8XViQCBpwsIwLYQAssWmBKE31cECcRTpxxunfOOsyMg/E5VMx8BAgQIzFkgn2n5zLyq8trhMy6juR8eAm/uG92dcw+qG4GJAgLwRCizEehcIB/s31/lXbe0Y1vPJwjf3NHOXOzqetgJeL5u8zoTAQIECBDoSaCdt7upSr+1Sh4n3GZ0t30hvOupQepKgMB0AQF4upU5CSxBIB/2OTQ6o7iHphzSdeiq0dk5SPi9GnYS8lNHvglfwhahDQQIEFi+wHh0N+ftttHcfPGbaeczbfkbgRYSaAICsG2BwDoFNtXsHMZ8fUvzs3OQC1vl3N6E3vYzR9u6n5FfEwECBAgQmKNAG93N4cy5/4ahkhndzWdYvug1ESCwYgEBeMWdr+kEBoGMBt/2E0qfHub5TN22QAyOAAECBAjMQWB8oarnRhXaDUE3t45WmkNPqQOBGQkIwDPqDFUhcGGB7Dzc9hNKH6u//fkq97lY1oWbY/UECBAgsDCB8bm7GeHNlICboLsVdhfW25pD4EQCAvCJYC2WQMcC31F1/74qv+NAG36ynvtTw85Gx01UdQIECBDoQKAF3qtRXXMIczuM2ehuB52oigTmJiAAz61H1IfA5QSyozE+LziHPP98lQTi8c5HapiR4Mf8jvDlWmnNBAgQIDBXgXwO5fMmt5lawN2O7s+17upFgEAnAgJwJx2lmgROLJAdjvdWySFl2dHI7/uOLxSyqcc5PPrbqrxuVJfbrhp94upaPAECBAgsQCCfOfl8SdDN/dzmM2i3gLZpAgECMxUQgGfaMapF4EwCLdjmQljtys83w/3bqnDoolnZWUlodo7wmTrOaggQINCZwPhw5oTcfP5k8rnRWUeqLoHeBQTg3ntQ/Qk8TGB8uHPuZwckATZBdup0KAj/cL34O6cuwHwECBAgsEiBFnbzmZLPitzmc6YdZbTIRmsUAQJ9CAjAffSTWhI4psBVLSy/67upsq2Sc31z+9ApOzc5fLpN2cl5ZxUXJ3moqNcRIECgL4F8niTc5rSY3Kbks2Dns6CvjlRbAmsQEIDX0MvaSOCzAtkhSVC9GnZSchGr7KAcI6j+iVrO3x1Bb+v+28ATIECAwCIF8nmSKSO97X77PDnGZ8oi0TSKAIF5CAjA8+gHtSBwSoFNLfy6Sq7wvKuS4HtT5dg7Kc/VMj8wasi27gvBp+xZyyZAgMDpBdrhzLl9e5WPV8lIb0qmY3+WnL5F1kCAwKoFBOBVd7/GL1wgOyvXVXL15k2VHOp8U2V3wnbvh+AXa105t9hEgAABAn0ItMB7NXxevLVuX64yDr19tEQtCRAgcEBAALZZEFimQHZccp7vf63yn6uc85zc/RD85mHHaZnSWkWAAIF+BRJ2M+Uw5s1QdnWbUd3t8DcjvP32r5oTIHBAQAC2WRBYlsD4PN+cj/XBKjcXaGLC9/Ww3owaJASbCBAgQODyAu283RzO/KkqCbyZjnVNiMu3UA0IECDwFAEB2OZBYBkC2aF5UiWHO2dnpl3Z+VLf3Kc+H6myGXgzAn2zDGqtIECAQFcCeR9OyRekbxhqnkOat1XyGXGpz4muEFWWAIHlCAjAy+lLLVmnQAu+7xiaf6oLXD1E97pelJHgTJ+u8uqHLMRrCBAgQOBeAu0c3gTeN1VpF63a1f0UEwECBFYtIACvuvs1vmOB8YhvmtEucDW3b/L/U9Xt9YNzLoaVi2KZCBAgQOB4AuPAmwtW7QfeuX0uHK/llkSAAIEHCAjAD0DzEgIXFGhXds5PGs05+Dai1PeTI69n6/7ugn5WTYAAgd4F9gNvHr9veG/N+6vA23sPqz8BAicVEIBPymvhBI4msKklXVfJOb7ZuZl6qHNe91eqfHWV76qyPVqNpi8ovw2cK0Nnyvr9NvB0O3MSIEAgAnkvv6qSQ5rblNCbiwyaCBAgQOAeAgLwPbDMSuACAtnhSUnwzY5OdnhuJtQjr/m+Kn+wyquG+f9H3X7ZhNcee5b9C2I9XyvI1UZNBAgQIPAbBfKemZIvDhN4c79dtCqfA0Z4bTUECBB4hIAA/Ag8LyVwQoFcvCSHOec2Ozw5f3Z3x/qyk5T5/1qVrzsw7yfqua84YZ2ftugn9cf3DjNk5+1LL1QPqyVAgMAcBTZVqQTevI/nSs15n8zP2OV9/673/jm2R50IECAwWwEBeLZdo2IrFGjndWUnKCO+97mw1XXNnxHfr7zF7WP1/LdX+YkLuuZnkRLQM6VtL1ywLlZNgACBSwpsauV5r0/YzXt/Lly1rWKE95K9Yt0ECKxCQABeRTdr5MwFsvNzXeXtVf5llVw5+cWJdU6g/AdVfueB+T9Tz/29Kn912KmauMiTzZa6JgRnyuhGLojlUL6TcVswAQIzEWhH5+Q9sI3w5pDmnAqS90DvgzPpKNUgQGAdAgLwOvpZK+cpkJ2hjADkN3yzA5TDnKd++/+NNe9fqvKWKr9pr3m/Uo/fX+V7quxm1vT8LvD1UCc/izSzzlEdAgSOIrCppaQk7OaLzby/t3N45/aefJQGWwgBAgR6EhCAe+otdV2KwFU1JIc4JwBnZ2jqha3S/rz2R6q88RaMjLDmUOcE6TlOm6rUzw0Vcy7wHHtInQgQuI9AO3Ul782Zckjzh4f7eR/Oe7yJAAECBGYkIADPqDNUZfECT6qFGe1N8M2hb7nASTsE7q7GZ+cq5/h+wy0zfqqe/8Eq77lrQTP4+3gU+J1Vn5sZ1EkVCBAgMEUggTdH7myqvLZK3nu3VfKF3ly/eJzSLvMQIEBgNQIC8Gq6WkMvJJCwm9B7XSU7TtlRym/4th2mu6qV1yQ45zd8X3PLzAnRU64Sfde6zvX3q1rRh4aV3dRtQrCJAAECcxPI+3emNsqbkJv7uypTT1eZW5vUhwABAqsXEIBXvwkAOJFAQl4Oc85IQaZtlfsE37xmU+VvV7lt1Dc7YwmPWXZvF1HJYdBpX6b8JFJv9T/RZmOxBAhcSGAcdtv9dghze3/yPnWhzrFaAgQIHFNAAD6mpmWtXaAdGtfO741Hwml+8ie395m+uWbOhax+6y0v6m3Ud78Z31pP/NjwpMOg77NlmJcAgccKbGoBKbsqV8P9vEfncaZ2+9j1eD0BAgQIzFBAAJ5hp6hSdwLZkUrova6SENzOBWtXdb5Pg9qyctjzoSnLTqB+8T4LneG8cfrkUK+E+ednWEdVIkCgb4G8z2TK7VWVbZUclTMe2TWq23cfqz0BAgTuLSAA35vMCwh8TiA7VPmJi+thB+sxwTcLzY7Ze6tsbjHOzltGS3cL6YN2GHTcchi0iQABAo8RyHtnDl9OwM37ct4r8wVbe07YfYyu1xIgQGAhAgLwQjpSM84mkJGE7EwlqLbzxLJTdVMlP2eUHa/7Ttlpywjy0kd9xy75qZB/W+VVVV6pkqupmggQIHCXwHhUN18a5nELuXkvzv12JM5dy/J3AgQIEFihgAC8wk7X5AcJZIcqATVXdN4MS8jOVi5sdVNl96ClfnaZ7x522A4tYltPPuRQ6gdW52wvS7vzJUKm/IxI26k9WwWsiACBWQuM3xPynns1et9t77ftqJtZN0TlCBAgQGBeAgLwvPpDbeYnkJ2u8WHOqWF2unIe7s1w/yG1znITfNtO3f4yWrh+8RHreEi9zvWahN824v2Tdf8bz7Vi6yFAYJYCm6pVKwm/KTmipo3m5v5uljVXKQIECBDoSkAA7qq7VPZMAocOc86qt1U+WOWmykPPJcuyE3yvhx27Q03Kjl5GfbO+pU4fqYa1Q8hzyOK5L4I1PowyxuPHrW93A/5D+3qpfaddBB4j0MJt/v+394C31v287708vO+1/3uPWY/XEiBAgACBgwICsA2DwOcFDh3mnL9uqxzjMOTs7GXk82qE/mt1v/0/PMbIci/9OQ7AGeWO732nFlrj1kaJsoy2U70Znm873G8aHo+fv886s55dleyo/2KV/1blbw3P3Wc55iWwBoH8v8v/tfZ+l/P+n6uS/0fbKh8e/u9kvjw2ESBAgACBswgIwGdhtpKZC2QH7dBhzhmZzDm+CTyPnbLj96NVWmjbX96/qSf+5JHW9di6nuP17QrQWVfCb0Lw06b00ZurvKXKZijjAJzXZsc6f7vElG0lo1e5Pcb2cok2WCeBhwi0oJsvnvIlU/v/2ZaV/w8Ju7ltXyI9ZD1eQ4AAAQIEjiIgAB+F0UI6FMhOW0Jprr7cRgzTjF2VdmGr7KwdY3phWM+h8Jt1PPZ84mPU8ZzLyA5yAnCbcvhzguP+dFVPpOTLibzmti8P2uti+YVVXr23oDyf17bbU7c1O/ptGzr1uiyfwLkE8n8w75W5zZT/ly385v9WC7q74X6eO9Z76LnaaD0ECBAgsAIBAXgFnayJnxeovbVN7ZFd1zMJvuNAta3HCS25PdZOW5afdbWrHe93RUJfRj+zw7imKV88fGDU4GdHBjHLTvb4Z6bGNp+uB++vknOx45Yy7q8WdPOa1r/j5/adnxaKN8My8vpW2nIzGp1DoF83LDDzpt7jKYEg85kI9CTQtuXc5tzc3KZk2o1KjnjINp7njvWe2ZOTuhIgQIBApwICcKcdp9r3FriqVyT05rYFo+y0JYQe6zDn/Uq9UE/kgleHpp+tJ3M47xp3HMeHP8e/XQArfZPDxDd7YLt6nN9Y3lbJDveczRLu2+H0acZto9v33oC9gMCRBPL+l/9jreTc3Hx5057PavJ/Lv/XEnLz/y33U0wECBAgQKB7AQG4+y7UgKcItBHY/HbveHQuO3IJVDfDzt0pEJ/UQscjvxm5/KJhRdmhzMhgdjLXNl1XgxNy25SAGI/9n4RqO91thHzOoXfch5uhLWnn/63yB6oIDmvbyi/f3hZmW7BtITfbZ0r+P+X9p/0/+3jd346ev3wL1IAAAQIECJxIQAA+EazFXlTgqtaekuCbnb02ZQcv59ueehQxo4DjQ3yzozmuxzvr8c1FhS6z8uyU5+rPzSKj4D9f5ZtG1ckO+bifLlPT+6017WrbW27zOH3+PVX+zv0WZW4CkwSyjWVKwM3/pzzO4crj0d0WcrMtprRDlvN8K5NWZiYCBAgQILAkAQF4Sb257rZkxy87g4dGEtsFibITeOopO6MJv23EOWE754l+1bDibd2+7dSVmOnyM/J7PdTtM3X7S1W+ZFTX2Bzj56ZO2fwWMK5qJRlVy23r6zaa9tjfij5l/S27H4Fsa+3LldR6P+C2L1radjc+XHlX8/dy1EQ/PaKmBAgQILAIAQF4Ed246kZshlD1x+r29+6FqXaY8zmBxiEvO6DfUuUnRhX44br/nees0EzW9RerHt9/S13yE1DvqrKdQV3bIaMtfGT7+u1VvrZKC7qpZv7eRqt3db+NruULDxOBqQLj7S33229Vty9a2ihublvAbf9Pst0JuVOlzUeAAAECBAYBAdim0KNAGxVpP2GUxxlR/MUqGX3NYc7ZOTz39KRWOD7vN4c6v1Tlk/mP9mufr82U3709d91Ptb70TQwyerU/beuJY195+652tGCRsLEZZs5Ibu63gJt5xtM/qwfZtnZVcq7kOPjetT5/J5BtKyXbVbax11Z5bni8H3Cjlf8Xeb79jSABAgQIECBwRAEB+IiYFnVSgRZ6c4XdtvPYVphgkiCVoJX7l5g2tdIPVcltppsqCcCZct7rePQwz2WkcFvlw0OdW72XNKKTPvv7Vcbn+OZ7gLT724d2H7Ovsr4WMrLcZp5Rtdxvf99fZ/qiBY7xT7u0fjpmHS1reQLjL05yP9tbm9p2l/emT422s/x/b9vd8kS0iAABAgQIzFhAAJ5x56ja/w8tV1XaxazGI3NtFK6N9l46OL5Q9Ww/eZS6PDvs7KYbN1VyaHTactf0Ss2QC0OlfKLKbnhBRh4z5fF4dOjS7b6tPd9cf/jxKq8azZDwm0Ohf/AuhOHv6e+0L36ZWpjI/RYy2nNtnvE20laTZbSwEb+E3NyOLSdWyWwrExhvT9nWfrVKruydIxqy/eTvz1XJF3BtatuW7WtlG4vmEiBAgEAfAgJwH/20plpmh/JJlYz0tpGV1v4WenNu77bKXMLft1ZdfmzUSbnIVeo3ntKuhODsLB97ag4t5LXH7XDdrG83rLSF5/FzuX8sy00t669X+aO3NPJ/1/M/UOUXqsQkh4O2Ka/Nc63k8V1T6p22tXYduhDQsdp2V138vU+BFnKvhu0o7zvtglPZttp2mf9fP1XlNcM2tx221cxjIkCAAAECBDoREIA76aiFVzM7oNnJbFdwHo+6ZKczV9V9adjpnFuYSV3/dZXXD310U7ft0OdD3ZYAnHB/PeM+bca5bX3RdvLb3/L8z1T56qHv/lfd5lzaL67y0PeVrCPLbesKUfo/08vPfGH9+yufG7nNcy38zphS1WYg0N5fUpWE20z5P5gpf8tz4y9S2hEC2fbatji3950ZsKoCAQIECBDoU+ChO6p9tlat5yaQHc8Ewj9S5Q+NKjcOvS0Aza3urT4v1J126HN+1udrRjvNd9U5bd9USXDMlPu54nBGmDJC2q5qPf5C4K5lnuPvLQz8dK0shzgnBOennlLvNv1y3fkXVXIF7P9Q5U9X+Ya9yuVw7/xO7ncPzwsZ5+i9fteR/wft/8I41Ob/Tbad/cPi2/+p8ZcqLdTmfNxdle3w2sxr++t321BzAgQIECAwWUAAnkxlxiMJXNVyUvYPcc4Oaa7gnHPp5h56G0V2rH9utFOe85FfOJLTeDFtZ38cAPL38ZWV82XCfkCYEpzHO/27UQjI/XYIdRsdS79kmXmckn7c/93l1Gtb5dDv+Sbw5zDwQ/V6qZ7PyFtem/UIIyfYkCYucr9/Wp9vRq9P/+xvj3ku86S0bSnbZZ5Pn7Zt9F/V/ZxHO96W8n6Q+bLNJciO15XV7q8ry8/UtsXcb89lGW39bdu1PY06z10CBAgQILBmAQF4zb1/vrZnZ/a6yqHzerOjmtB7M+zMnq9Wj1/TC7WI2y589filH2cJ4+DQQksLDuPb+6wty0y7n+y9KMvPlwAvPmVheW1+Kirbw11Tto0cWv1/qowvApbXtfCU51tgS8jaVMnr2m1rY+bJ821q8+Tx+Pn298cGpla/trzx4/2A2dqzP2/asB8022tb2GyvaUcR5HG+TMrj8XqyrPHU/jZe3nj+Q3XcW8RveNjMmnUz3tac+XKj1fGf1/0vH+qXv7VttL0+rxuvv/XPY/vkrvr7OwECBAgQILACAQF4BZ18oSZmB/aqSoLS1x+oQwtLN/W3XndsM/q7Gdp2qtHfC3XfwdW24Hu9F1Ae0uhJpB0AAAqnSURBVJfZJvI7zlnW3KYp2+N+cBy/5lD4bW1sgXZubd6vT+q5G57M/XE4bYcP58/tbx8d5m3hd+7tUz8CBAgQIEBgpQIC8Eo7/oTNvqplt4s8HRpFekhYOmF1H7zo5+qVOWS7Tc+OAsODFzrTF6Yfn1RJYN3v05fquRzuvHtE3a/rtTmcO6aHtplHLHqVLx2H8dYv40AblHaYcO5nnrgnxI7D7irxNJoAAQIECBBYtoAAvOz+PVfr7hrtTT2WEnybac5lTXDLlBD4/Lmwz7ieTa2rjdLuB9Nt/e3Qeb6PrV7Wk9HhrDv3f3eVfLnwW4bHu+E2f2/bVbs/XnfPQboF2P3bBNTxCGsOK87jFlrHIXf/tY/tF68nQIAAAQIECCxCQABeRDderBEJKhm1OzQy2Cq1tODb2jU+/Dk/e3RzsV44/oqvhj7N7aHgm8O9t8df7VGWOK5vtr32eDNa+v48+dP473l8W4A+9Pw4hLa/twDalrWrO+P61P1XV8nPIn/u8GKh9SibgIUQIECAAAECBG4XEIBtHfcVyA5+C70JwLdNSw2+LSwlALfpzXUno3M9T+nXJ1UOXagsfXlT5X0LaGfPfaTuBAgQIECAAAECjxQQgB8JuKKXt4D0tNHecCQs5arOLw73l0iULwDa+b9p75d23Mh8iZE+TZv2R0YT6hN6X1pwX3bcdapOgAABAgQIECBwXwEB+L5i65v/qpr8jgMBaV+iBd+b+sNu4UzX1b6cA5wpbc05qj1Nm6ps2pALT6V/25Q+FHp76kl1JUCAAAECBAgQuJeAAHwvrtXMnJHABKQE36cd5hyQdnhsRn13KxHKocL5LdtMCYw5BHru0219+kpV/Mer/MMq26E/594W9SNAgAABAgQIECDwIAEB+EFsi31Rwm47v3d8OOxtDU5gOsWVgOcO/EJVML9vnGnOAXh8vvam6tr6NF9apO/ypUXqn8cmAgQIECBAgAABAosXEIAX38V3NjCh6GoIdHeN9mZhLoj02YtFtRHguZ0DnKCbLzEyep/749Dr8OY7/zuYgQABAgQIECBAYMkCAvCSe/fpbUvozRV/r0ch6WmvaOf4vjiE4PXKfdasnQN86QCcgJsvLlp/jr/EaOf0frD+/lKV3Zo7TdsJECBAgAABAgQICMDr2wYSmP5JlT88senbmi8B6kbw/ZxYwuaHRn65CNa5wmX6b1MlQTcXscpo7/hwdaF34oZtNgIECBAgQIAAgfUJCMDL7vMEtYSllDcMt7+/br/kjmYnRGXEsJ0jumyl+7cunuf6HeA2wtsCb26z/vHUQm/6a1vFOb3371OvIECAAAECBAgQWIGAALzcTt4PaVNamvBktHeK1DPPfLJmayOv76z7N9Nedudc6bc2qptD1PN4PMKbBSTgpq9erpIvKnJur4kAAQIECBAgQIAAgTsEBODlbiIJTQlpd027IUS9T5C6i+rX/f0j9aidb3tT9xOC25TnE1I3w+1tAbUdzpzAmxH6q+E14xVlOemjbZUE3iwrj43y3qu7zEyAAAECBAgQIEDgmWcE4GVvBQliLYwlMI1HEnPeakJcApUwdf/tIFeBfjK87GN1+5er5JzcqyqbA4vbDs7NOv3y+ipfPpo3fxuP7qZv9M/9+8YrCBAgQIAAAQIECBwUEIBtGAQeJnBdL2tXgn7IEhJ0X6nyj6v8uyotIO8esjCvIUCAAAECBAgQIEDgbgEB+G4jcxC4TeC/1x9eN/pjuxhVRm1zLnUef2WVX6iyGR5n9oTcFCPvti0CBAgQIECAAAECZxQQgM+IbVWLFMhh0Dm0PGH2pSHYLrKhGkWAAAECBAgQIECgdwEBuPceVH8CBAgQIECAAAECBAgQmCQgAE9iMhMBAgQIECBAgAABAgQI9C4gAPfeg+pPgAABAgQIECBAgAABApMEBOBJTGYiQIAAAQIECBAgQIAAgd4FBODee1D9CRAgQIAAAQIECBAgQGCSgAA8iclMBAgQIECAAAECBAgQINC7gADcew+qPwECBAgQIECAAAECBAhMEhCAJzGZiQABAgQIECBAgAABAgR6FxCAe+9B9SdAgAABAgQIECBAgACBSQIC8CQmMxEgQIAAAQIECBAgQIBA7wICcO89qP4ECBAgQIAAAQIECBAgMElAAJ7EZCYCBAgQIECAAAECBAgQ6F1AAO69B9WfAAECBAgQIECAAAECBCYJCMCTmMxEgAABAgQIECBAgAABAr0LCMC996D6EyBAgAABAgQIECBAgMAkAQF4EpOZCBAgQIAAAQIECBAgQKB3AQG49x5UfwIECBAgQIAAAQIECBCYJCAAT2IyEwECBAgQIECAAAECBAj0LiAA996D6k+AAAECBAgQIECAAAECkwQE4ElMZiJAgAABAgQIECBAgACB3gUE4N57UP0JECBAgAABAgQIECBAYJKAADyJyUwECBAgQIAAAQIECBAg0LuAANx7D6o/AQIECBAgQIAAAQIECEwSEIAnMZmJAAECBAgQIECAAAECBHoXEIB770H1J0CAAAECBAgQIECAAIFJAgLwJCYzESBAgAABAgQIECBAgEDvAgJw7z2o/gQIECBAgAABAgQIECAwSUAAnsRkJgIECBAgQIAAAQIECBDoXUAA7r0H1Z8AAQIECBAgQIAAAQIEJgkIwJOYzESAAAECBAgQIECAAAECvQsIwL33oPoTIECAAAECBAgQIECAwCQBAXgSk5kIECBAgAABAgQIECBAoHcBAbj3HlR/AgQIECBAgAABAgQIEJgkIABPYjITAQIECBAgQIAAAQIECPQuIAD33oPqT4AAAQIECBAgQIAAAQKTBATgSUxmIkCAAAECBAgQIECAAIHeBQTg3ntQ/QkQIECAAAECBAgQIEBgkoAAPInJTAQIECBAgAABAgQIECDQu4AA3HsPqj8BAgQIECBAgAABAgQITBIQgCcxmYkAAQIECBAgQIAAAQIEehcQgHvvQfUnQIAAAQIECBAgQIAAgUkCAvAkJjMRIECAAAECBAgQIECAQO8CAnDvPaj+BAgQIECAAAECBAgQIDBJQACexGQmAgQIECBAgAABAgQIEOhdQADuvQfVnwABAgQIECBAgAABAgQmCQjAk5jMRIAAAQIECBAgQIAAAQK9CwjAvfeg+hMgQIAAAQIECBAgQIDAJAEBeBKTmQgQIECAAAECBAgQIECgdwEBuPceVH8CBAgQIECAAAECBAgQmCQgAE9iMhMBAgQIECBAgAABAgQI9C4gAPfeg+pPgAABAgQIECBAgAABApMEBOBJTGYiQIAAAQIECBAgQIAAgd4FBODee1D9CRAgQIAAAQIECBAgQGCSgAA8iclMBAgQIECAAAECBAgQINC7gADcew+qPwECBAgQIECAAAECBAhMEhCAJzGZiQABAgQIECBAgAABAgR6FxCAe+9B9SdAgAABAgQIECBAgACBSQIC8CQmMxEgQIAAAQIECBAgQIBA7wICcO89qP4ECBAgQIAAAQIECBAgMElAAJ7EZCYCBAgQIECAAAECBAgQ6F1AAO69B9WfAAECBAgQIECAAAECBCYJCMCTmMxEgAABAgQIECBAgAABAr0LCMC996D6EyBAgAABAgQIECBAgMAkgf8HJS+OFBscDJ8AAAAASUVORK5CYII=', '', '', 0, NULL, NULL, NULL, NULL, ''),
(109, NULL, 'jhkjhkj', 'hkjh', NULL, 87, 'jhkjhkjhkj ', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly, Bengaluru', '2024-01-15', '11:47:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2024-01-15 02:46:25', '2024-01-15 02:46:25', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(110, NULL, 'jhjkhkjh', 'kjhk', NULL, 97, 'ghhjgHJGHJGhjgjh ', 'Kjellerup, Denmark, Kjellerup', '2026-02-16', '11:48:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2024-01-15 02:47:41', '2024-01-15 02:47:41', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(111, NULL, 'kjklj', 'jkljlkjlk', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2024-01-15', '11:49:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2024-01-15 02:48:09', '2024-01-15 02:48:09', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(112, NULL, 'jkjhjk', 'khkjhk', NULL, 87, 'jhkjhkjhkj ', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly, Bengaluru', '2024-01-15', '11:49:00', 0, NULL, '', '', 3, 6, NULL, 4, NULL, '2024-01-15 02:49:06', '2024-01-15 02:49:06', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(113, NULL, 'jjk', 'hkjjk', NULL, 113, 'jhkjhjk ', 'HKJC Sha Tin Racecourse Y Box, Sha Tin, Hong Kong, jhkjhk', '2024-01-15', '11:53:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2024-01-15 02:52:31', '2024-01-15 02:52:31', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(114, NULL, 'jhjhjkhjk', 'jhkjlklk;kl', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2024-01-15', '11:56:00', 0, NULL, '', '', 3, 6, NULL, 2, NULL, '2024-01-15 02:55:42', '2024-01-15 02:55:42', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(115, NULL, 'hjgj', 'ghjgjhgjgjhgjhgjhghjh hjg ghjhjgjhghjgjjjjjjj ghj', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2024-01-15', '12:21:00', 0, NULL, '', '', 3, 6, NULL, 6, NULL, '2024-01-18 08:39:34', '2024-01-18 08:39:34', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(116, NULL, 'jhjh', 'kjhjhjkjh', 58, 88, 'jhkjhkjhkj ', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly, Bengaluru', '2024-01-18', '05:42:00', 0, NULL, '', '', 2, 6, NULL, 2, NULL, '2024-01-21 03:45:26', '2024-01-18 08:44:44', '', '', 'urgent', 0, NULL, NULL, NULL, NULL, ''),
(117, NULL, 'hghjgj', 'ghjghj', NULL, 102, 'ghfhfh ', 'hgg, hghjgjh', '2024-01-22', '17:57:00', 0, NULL, '', '', 3, 6, NULL, 12, NULL, '2024-01-22 08:56:30', '2024-01-22 08:56:30', '', '', 'low', 0, '', NULL, NULL, NULL, ''),
(118, NULL, 'nmhj', 'ghjgjhghj', NULL, 91, 'hjghjghj ', 'Jagakarsa, South Jakarta City, Jakarta, Indonesia, jhhjgj', '2024-01-23', '17:59:00', 0, NULL, '', '', 3, 6, NULL, 6, NULL, '2024-01-22 08:58:48', '2024-01-22 08:58:48', '', '', 'low', 0, '1002', NULL, NULL, NULL, ''),
(119, NULL, 'jhkj', 'hh', NULL, 87, 'jhkjhkjhkj ', 'GFGC KR Pram, Brindavan Layout, Thambu Chetty Paly, Bengaluru', '2024-01-24', '06:02:00', 0, NULL, '', '', 3, 6, NULL, 24, NULL, '2024-01-22 09:01:13', '2024-01-22 09:01:13', '', '', 'low', 0, '741741', NULL, NULL, NULL, ''),
(120, NULL, 'sppp test', 'jjkh', 58, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2024-01-22', '01:00:00', 0, NULL, '', '', 2, 6, NULL, 24, NULL, '2024-02-06 11:22:52', '2024-01-22 10:57:01', '', '', 'low', 0, NULL, NULL, NULL, NULL, ''),
(121, NULL, 'hbhhhhh', 'jkhjhkjhk', 3, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2024-01-26', '08:03:00', 0, NULL, '', '2024-02-06 10:58:29', 1, 6, NULL, 2, NULL, '2024-02-06 10:58:29', '2024-01-26 07:02:26', '', '', 'low', 0, '1004', NULL, NULL, '2024-02-06 00:28:11', 'job-35355'),
(122, NULL, 'test by siva', 'test by siva', 40, 25, 'JSOFT SOLUTION SDN BHD ', 'Level 15 , DPluze, Cyberjaya', '2024-02-01', '19:23:00', 0, NULL, '', '2024-02-05 16:01:24', 1, 6, NULL, 2, NULL, '2024-02-05 16:01:24', '2024-02-01 06:23:13', 'data:image/png;base64,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', '02-02-2024 01:31:21', 'low', 3, '741741741', NULL, NULL, NULL, 'job-90983'),
(123, NULL, 'test by siva 2', 'test by siva 2', 3, 77, 'testjsoft ', '123 William Street, New York, NY, USA, New York', '2024-02-01', '18:24:14', 0, NULL, '', '', 5, 6, NULL, 24, NULL, '2024-02-01 06:44:51', '2024-02-01 06:24:45', '', '', 'low', 3, '1002', NULL, NULL, '2024-02-01 06:45:26', 'job-62966'),
(124, NULL, 'test new', 'test new', 58, 36, 'Benjamin ', '5, Jalan Sri Putra 1, Taman Sri Putra, Johor Bharu', '2024-02-05', '15:50:16', 0, NULL, '', '2024-02-05 15:53:13', 1, 6, NULL, 2, NULL, '2024-02-05 03:51:14', '2024-02-05 03:50:39', '', '', 'low', 0, '741741741', NULL, NULL, '2024-02-05 15:51:36', 'job-94720');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_jobsheets_th`
--

DROP TABLE IF EXISTS `gtg_jobsheets_th`;
CREATE TABLE IF NOT EXISTS `gtg_jobsheets_th` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jid` int NOT NULL,
  `message` text,
  `cid` int NOT NULL,
  `eid` int NOT NULL,
  `cdate` datetime NOT NULL,
  `attach` varchar(255) NOT NULL,
  `aid` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_jobsheets_th`
--

INSERT INTO `gtg_jobsheets_th` (`id`, `jid`, `message`, `cid`, `eid`, `cdate`, `attach`, `aid`) VALUES
(4, 12, '<p>test</p>', 0, 0, '2023-02-02 07:48:56', '1675324136Banner-1.png', 6),
(5, 12, '<p>test</p>', 0, 0, '2023-02-02 11:28:41', '', 6),
(6, 12, '<p>test</p>', 0, 0, '2023-02-02 11:33:56', '', 6),
(7, 12, '<p>test</p>', 0, 0, '2023-02-02 11:34:05', '', 6),
(8, 12, '<p>noted</p>', 0, 2, '2023-02-07 07:55:47', '', 0),
(9, 12, '<p>final</p>', 0, 2, '2023-02-07 08:00:15', '', 0),
(10, 61, '<p>System cleaning is completed.&nbsp;</p>', 0, 3, '2023-04-18 10:37:14', '', 0),
(11, 61, '<p>System cleaning is completed.&nbsp;</p>', 0, 3, '2023-04-18 10:39:36', '', 0),
(12, 61, '<p>test</p>', 0, 6, '2023-04-20 08:01:51', '16819777111.png', 0),
(13, 68, '<p>test</p>', 0, 3, '2023-05-04 21:16:56', '', 0),
(14, 68, '<p>okay</p>', 0, 6, '2023-05-04 21:17:13', '', 0),
(15, 68, '<p>test</p>', 0, 3, '2023-05-04 21:18:33', '', 0),
(16, 68, '<p>okay</p>', 0, 6, '2023-05-04 21:18:59', '', 0),
(17, 68, '<p>test</p>', 0, 3, '2023-05-04 21:19:05', '', 0),
(18, 68, '<p>okay</p>', 0, 6, '2023-05-04 21:19:22', '', 0),
(19, 70, '<p>Task complete</p><p><br></p>', 0, 10, '2023-05-05 10:47:30', '', 0),
(20, 70, '<p>Task complete</p><p><br></p>', 0, 10, '2023-05-05 10:47:32', '', 0),
(21, 70, '<p>Checked and completed</p><p><br></p>', 0, 6, '2023-05-11 03:28:10', '', 0),
(22, 71, '<p>Updated the Hard Disk</p>', 0, 11, '2023-05-11 03:55:05', '', 0),
(23, 71, '<p>Updated the Hard Disk</p>', 0, 11, '2023-05-11 04:03:48', '', 0),
(24, 72, '<p>Tested the Server</p>', 0, 11, '2023-05-11 04:04:17', '', 0),
(25, 73, '<p>issue: Wire burn, replace wire.</p>', 0, 3, '2023-05-16 10:38:17', '', 0),
(26, 73, '<p>issue: Wire burn, replace wire.</p>', 0, 3, '2023-05-16 10:38:43', '', 0),
(27, 74, '<p>Server replacement done</p>', 0, 10, '2023-05-17 04:49:47', '1684298987JPG.jpg', 0),
(28, 77, '<p>no issue found&nbsp;</p>', 0, 3, '2023-06-07 09:06:31', '', 0),
(29, 77, '<p>completed</p>', 0, 3, '2023-06-07 09:07:01', '16861288212.png', 0),
(30, 80, '<p>still cooking</p>', 0, 6, '2023-06-12 02:20:04', '', 0),
(31, 80, '<p>cooking&nbsp;</p>', 0, 6, '2023-06-12 02:21:21', '', 0),
(32, 81, '<p>To cook</p>', 0, 6, '2023-06-12 06:10:52', '1686550252PDF.pdf', 0),
(33, 81, '<p>Done cooking</p>', 0, 24, '2023-06-12 06:28:57', '1686551337PDF_-_Copy.pdf', 0),
(34, 79, '<p>Test message</p>', 0, 6, '2023-06-12 10:06:32', '', 0),
(35, 79, '<p>Test 2</p>', 0, 6, '2023-06-12 10:08:52', '', 0),
(36, 76, '<p>Test</p>', 0, 6, '2023-06-12 10:13:23', '', 0),
(37, 76, '<p>Test</p><p><br></p>', 0, 6, '2023-06-12 10:13:40', '', 0),
(41, 92, '<p>job compleed as requested</p>', 0, 27, '2023-06-20 23:05:32', '', 0),
(42, 92, '<p>waiing for clien&nbsp;</p>', 0, 27, '2023-06-20 23:06:07', '', 0),
(43, 92, '<p>noed&nbsp;</p>', 0, 0, '2023-06-20 23:08:53', '', 6),
(44, 97, '<p>Working&nbsp;</p>', 0, 28, '2023-06-21 14:55:58', '', 0),
(45, 97, '<p>Working&nbsp;</p>', 0, 28, '2023-06-21 15:02:35', '', 0),
(46, 97, '<p>Working&nbsp;</p>', 0, 28, '2023-06-21 15:04:48', '', 0),
(47, 100, '<p>Workng on it</p><p><br></p>', 0, 28, '2023-06-27 08:52:02', '', 0),
(48, 102, '<p>Testihgfggb</p>', 0, 0, '2023-06-29 21:26:07', '', 6),
(49, 106, '<p>Aircon Services done&nbsp;</p>', 0, 40, '2023-07-19 08:44:20', '1689756260EMP_sIGN.jpg', 0),
(50, 106, '<p>Reopen Customer Request to second visit&nbsp;</p>', 0, 0, '2023-07-19 08:46:20', '', 6),
(51, 17, '<p>asdfasdfasdf<br></p>', 0, 0, '2023-12-21 09:34:45', '', 6),
(52, 17, '<p>asdfasdfasdf<br></p>', 0, 0, '2023-12-21 09:35:25', '', 6),
(53, 17, '<p>asdfasdfasdf<br></p>', 0, 0, '2023-12-21 09:39:17', '', 6),
(54, 17, '<p>sssssssssssss<br></p>', 0, 0, '2023-12-21 10:00:57', '', 6),
(55, 17, '<p>sssssssssssss<br></p>', 0, 0, '2023-12-21 10:02:27', '', 6),
(56, 17, '<p>sssssssssssss<br></p>', 0, 0, '2023-12-21 10:02:48', '', 6),
(57, 18, '<p>asdasdadfs<br></p>', 0, 0, '2023-12-21 10:10:15', '', 6),
(58, 108, '<p>adwfasdfsadf<br></p>', 0, 0, '2023-12-21 10:14:57', '', 6),
(59, 108, '<p>adwfasdfsadf<br></p>', 0, 0, '2023-12-21 10:15:20', '', 6),
(60, 108, '<p>adwfasdfsadf<br></p>', 0, 0, '2023-12-21 10:15:50', '', 6),
(61, 108, '<p>adwfasdfsadf<br></p>', 0, 0, '2023-12-21 10:18:07', '', 6),
(62, 17, NULL, 0, 0, '2023-12-21 11:00:45', '', 6),
(63, 17, NULL, 0, 0, '2023-12-21 11:09:13', '', 6),
(64, 17, NULL, 0, 0, '2023-12-21 11:11:19', '', 6),
(65, 17, NULL, 0, 0, '2023-12-21 11:12:34', '', 6),
(66, 17, NULL, 0, 0, '2023-12-21 11:12:43', '', 6),
(67, 17, NULL, 0, 0, '2023-12-21 11:13:04', '', 6),
(68, 17, NULL, 0, 0, '2023-12-21 11:13:17', '', 6),
(69, 17, NULL, 0, 0, '2023-12-21 11:13:30', '', 6),
(70, 17, NULL, 0, 0, '2023-12-21 11:14:03', '', 6),
(71, 17, NULL, 0, 0, '2023-12-21 11:14:08', '', 6),
(72, 17, NULL, 0, 0, '2023-12-21 11:15:02', '', 6),
(73, 17, NULL, 0, 0, '2023-12-21 11:15:48', '', 6),
(74, 17, NULL, 0, 0, '2023-12-21 11:16:04', '', 6),
(75, 114, '<p>kwqljklqwe<br></p>', 0, 0, '2024-01-15 03:41:41', '', 6),
(76, 114, '<p>sdfdf</p><p><br></p>', 0, 0, '2024-01-15 03:47:38', '', 6),
(77, 114, '<p>sdfdf</p><p><br></p>', 0, 0, '2024-01-15 03:48:53', '', 6),
(78, 114, '<p>sdfdf</p><p><br></p>', 0, 0, '2024-01-15 03:49:21', '', 6),
(79, 57, '<p>srgsf<br></p>', 0, 0, '2024-01-15 04:38:47', '', 6),
(80, 57, '<p>srgsf<br></p>', 0, 0, '2024-01-15 05:01:23', '', 6),
(81, 57, '<p>d<br></p>', 0, 0, '2024-01-15 06:03:42', '1705298622ERP_DEployement_Status_-_Sheet2_(7).pdf', 6),
(82, 115, '<p>ewqqwer<br></p>', 0, 0, '2024-01-15 06:28:21', '', 6),
(83, 115, '<p>ewqqwer<br></p>', 0, 0, '2024-01-15 06:28:36', '', 6),
(84, 115, '<p>qdwewwer<br></p>', 0, 0, '2024-01-15 06:29:06', '', 6),
(85, 115, '<p>wewerwer<br></p>', 0, 0, '2024-01-15 06:30:40', '1705300240Print-Invoice-3013581-258-1-pdf.png', 6),
(86, 115, '<p>wfwqrkj<br></p>', 0, 0, '2024-01-15 06:31:03', '1705300263Attendance_Module_Improvement_.docx', 6),
(87, 58, NULL, 0, 0, '2024-01-22 02:40:11', '', 6),
(88, 77, NULL, 0, 3, '2024-01-23 12:15:19', '', 0),
(89, 77, NULL, 0, 3, '2024-01-23 12:15:36', '', 0),
(90, 77, NULL, 0, 3, '2024-01-23 12:20:19', '', 0),
(91, 77, NULL, 0, 3, '2024-01-23 12:20:33', '', 0),
(92, 77, NULL, 0, 3, '2024-01-23 12:21:44', '', 0),
(93, 77, NULL, 0, 3, '2024-01-23 12:22:06', '', 0),
(94, 77, NULL, 0, 3, '2024-01-23 12:22:16', '', 0),
(95, 77, NULL, 0, 3, '2024-01-23 12:22:42', '', 0),
(96, 77, NULL, 0, 3, '2024-01-23 12:29:41', '', 0),
(97, 77, NULL, 0, 3, '2024-01-23 12:30:00', '', 0),
(98, 77, NULL, 0, 3, '2024-01-23 12:31:30', '', 0),
(99, 77, NULL, 0, 3, '2024-01-23 12:31:44', '', 0),
(100, 77, NULL, 0, 3, '2024-01-23 12:32:39', '', 0),
(101, 68, NULL, 0, 3, '2024-01-24 13:53:25', '', 0),
(102, 68, NULL, 0, 3, '2024-01-24 13:53:39', '', 0),
(103, 55, NULL, 0, 0, '2024-01-26 18:30:28', '', 6),
(104, 55, NULL, 0, 0, '2024-01-26 18:30:43', '', 6),
(105, 93, NULL, 0, 0, '2024-02-01 03:29:46', '', 6),
(106, 14, '', 0, 0, '2024-02-01 17:47:51', '', 6),
(119, 122, '', 0, 0, '2024-02-01 20:04:18', '', 6),
(120, 122, '<p>asdfdsf<br></p>', 0, 0, '2024-02-02 02:30:14', '', 6),
(121, 122, '<p>pora<br></p>', 0, 0, '2024-02-02 02:31:02', '', 6),
(122, 122, '', 0, 0, '2024-02-02 02:40:38', '1706812838passportdetailspage.jpg', 6),
(123, 122, '<p>dsfadfdsf<br></p>', 0, 0, '2024-02-02 02:51:15', '', 6),
(124, 122, '<p>dsfadfdsf<br></p>', 0, 0, '2024-02-02 02:51:48', '', 6),
(125, 122, '<p>dsfadfdsf<br></p>', 0, 0, '2024-02-02 02:52:23', '', 6),
(126, 122, '<p>wedfwe<br></p>', 0, 0, '2024-02-02 10:19:49', '', 6),
(127, 122, '<p>weqe<br></p>', 0, 0, '2024-02-02 13:20:00', '', 6),
(128, 122, '<p>e<br></p>', 0, 0, '2024-02-02 13:30:38', '', 6),
(129, 25, '<p>asaadfad<br></p>', 0, 0, '2024-02-06 15:39:47', '', 6),
(130, 25, '<p>asdfasd<br></p>', 0, 0, '2024-02-06 15:41:26', '', 6),
(131, 25, '<p>asdfasd<br></p>', 0, 0, '2024-02-06 15:43:59', '', 6),
(132, 25, '<p>sss<br></p>', 0, 0, '2024-02-06 15:46:21', '', 6),
(133, 25, '<p>adasd<br></p>', 0, 0, '2024-02-06 15:52:19', '', 6),
(134, 25, '<p>dsfsf<br></p>', 0, 0, '2024-02-06 15:54:05', '', 6),
(135, 25, '<p>sdsds<br></p>', 0, 0, '2024-02-06 15:54:46', '', 6),
(136, 25, '<p>sdfsd<br></p>', 0, 0, '2024-02-06 15:55:48', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_jobtransaction`
--

DROP TABLE IF EXISTS `gtg_jobtransaction`;
CREATE TABLE IF NOT EXISTS `gtg_jobtransaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jobid` int DEFAULT NULL,
  `assign_type` varchar(25) DEFAULT NULL,
  `assign_by` int DEFAULT NULL,
  `assign_date` datetime DEFAULT NULL,
  `remarks` longtext,
  `status` int DEFAULT NULL,
  `staffid` int DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `message_status` varchar(1) DEFAULT 'N',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_jobtransaction`
--

INSERT INTO `gtg_jobtransaction` (`id`, `jobid`, `assign_type`, `assign_by`, `assign_date`, `remarks`, `status`, `staffid`, `start_time`, `end_time`, `message_status`, `updated_at`, `created_at`) VALUES
(1, 12, 'Task', 6, '2023-02-06 07:31:39', NULL, 0, 2, NULL, NULL, 'N', '2023-02-06 07:31:39', '2023-02-06 07:31:39'),
(2, 16, 'Internal', 6, '2023-02-07 04:02:10', NULL, 0, 2, NULL, NULL, 'N', '2023-02-07 04:02:10', '2023-02-07 04:02:10'),
(3, 16, 'Internal', 6, '2023-02-07 04:13:37', NULL, 0, 2, NULL, NULL, 'N', '2023-02-07 04:13:37', '2023-02-07 04:13:37'),
(4, 23, 'Task', 6, '2023-02-07 04:20:55', NULL, 0, 2, NULL, NULL, 'N', '2023-02-07 04:20:55', '2023-02-07 04:20:55'),
(5, 61, 'system issue', 6, '2023-04-18 10:35:14', NULL, 0, 3, NULL, NULL, 'N', '2023-04-18 10:35:14', '2023-04-18 10:35:14'),
(6, 68, 'test', 6, '2023-05-04 09:12:15', NULL, 0, 3, NULL, NULL, 'N', '2023-05-04 09:12:15', '2023-05-04 09:12:15'),
(7, 69, 'Urgent', 6, '2023-05-05 10:44:28', NULL, 0, 11, NULL, NULL, 'N', '2023-05-05 10:44:28', '2023-05-05 10:44:28'),
(8, 70, '', 6, '2023-05-05 10:46:51', NULL, 0, 10, NULL, NULL, 'N', '2023-05-05 10:46:51', '2023-05-05 10:46:51'),
(9, 71, 'Imidiate', 6, '2023-05-11 03:35:26', NULL, 0, 11, NULL, NULL, 'N', '2023-05-11 03:35:26', '2023-05-11 03:35:26'),
(10, 72, 'Urgent', 6, '2023-05-11 04:03:38', NULL, 0, 11, NULL, NULL, 'N', '2023-05-11 04:03:38', '2023-05-11 04:03:38'),
(11, 73, 'urgent', 6, '2023-05-16 10:36:07', NULL, 0, 3, NULL, NULL, 'N', '2023-05-16 10:36:07', '2023-05-16 10:36:07'),
(12, 74, 'Urgent', 6, '2023-05-17 04:42:28', NULL, 0, 10, NULL, NULL, 'N', '2023-05-17 04:42:28', '2023-05-17 04:42:28'),
(13, 75, 'Urgent', 6, '2023-05-18 08:25:31', NULL, 0, 11, NULL, NULL, 'N', '2023-05-18 08:25:31', '2023-05-18 08:25:31'),
(14, 77, 'Task', 6, '2023-06-07 09:05:49', NULL, 0, 3, NULL, NULL, 'N', '2023-06-07 09:05:49', '2023-06-07 09:05:49'),
(15, 78, 'weekl ', 6, '2023-06-12 12:59:01', NULL, 0, 2, NULL, NULL, 'N', '2023-06-12 12:59:01', '2023-06-12 12:59:01'),
(16, 80, 'urgent ', 6, '2023-06-12 02:22:09', NULL, 0, 2, NULL, NULL, 'N', '2023-06-12 02:22:09', '2023-06-12 02:22:09'),
(17, 81, 'Urgent', 6, '2023-06-12 05:07:48', NULL, 0, 24, NULL, NULL, 'N', '2023-06-12 05:07:48', '2023-06-12 05:07:48'),
(18, 79, 'Urgent', 6, '2023-06-12 08:30:05', NULL, 0, 24, NULL, NULL, 'N', '2023-06-12 08:30:05', '2023-06-12 08:30:05'),
(19, 83, 'Urgent Job', 6, '2023-06-13 08:24:09', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 08:24:09', '2023-06-13 08:24:09'),
(20, 84, 'Not Urgent', 6, '2023-06-13 08:25:36', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 08:25:36', '2023-06-13 08:25:36'),
(21, 85, 'Testtt', 6, '2023-06-13 09:51:38', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 09:51:38', '2023-06-13 09:51:38'),
(22, 86, 'Test', 6, '2023-06-13 09:54:32', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 09:54:32', '2023-06-13 09:54:32'),
(23, 87, 'job type by siva', 6, '2023-06-13 10:01:48', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 10:01:48', '2023-06-13 10:01:48'),
(24, 89, 'Test Type', 6, '2023-06-13 11:56:50', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 11:56:50', '2023-06-13 11:56:50'),
(25, 88, 'Urgent', 6, '2023-06-13 03:16:09', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 03:16:09', '2023-06-13 03:16:09'),
(26, 90, 'Urgent Task', 6, '2023-06-13 03:24:50', NULL, 0, 24, NULL, NULL, 'N', '2023-06-13 03:24:50', '2023-06-13 03:24:50'),
(27, 79, 'DEV TEST', 6, '2023-06-14 04:22:56', NULL, 0, 24, NULL, NULL, 'N', '2023-06-14 04:22:56', '2023-06-14 04:22:56'),
(28, 92, 'urgen ', 6, '2023-06-20 11:00:03', NULL, 0, 27, NULL, NULL, 'N', '2023-06-20 11:00:03', '2023-06-20 11:00:03'),
(29, 93, 'Urgent', 6, '2023-06-21 06:45:35', NULL, 0, 24, NULL, NULL, 'N', '2023-06-21 06:45:35', '2023-06-21 06:45:35'),
(30, 96, 'IT Support', 6, '2023-06-21 08:33:07', NULL, 0, 28, NULL, NULL, 'N', '2023-06-21 08:33:07', '2023-06-21 08:33:07'),
(31, 95, 'Urgent', 6, '2023-06-21 08:41:42', NULL, 0, 28, NULL, NULL, 'N', '2023-06-21 08:41:42', '2023-06-21 08:41:42'),
(32, 97, 'Urgent', 6, '2023-06-21 02:48:15', NULL, 0, 28, NULL, NULL, 'N', '2023-06-21 02:48:15', '2023-06-21 02:48:15'),
(33, 99, 'Task', 6, '2023-06-23 07:59:51', NULL, 0, 28, NULL, NULL, 'N', '2023-06-23 07:59:51', '2023-06-23 07:59:51'),
(34, 100, 'Test', 6, '2023-06-27 08:44:08', NULL, 0, 28, NULL, NULL, 'N', '2023-06-27 08:44:08', '2023-06-27 08:44:08'),
(35, 96, '', 6, '2023-06-29 09:20:15', NULL, 0, 3, NULL, NULL, 'N', '2023-06-29 09:20:15', '2023-06-29 09:20:15'),
(36, 96, '', 6, '2023-06-29 09:20:15', NULL, 0, 3, NULL, NULL, 'N', '2023-06-29 09:20:15', '2023-06-29 09:20:15'),
(37, 102, 'Testing', 6, '2023-06-29 09:24:57', NULL, 0, 4, NULL, NULL, 'N', '2023-06-29 09:24:57', '2023-06-29 09:24:57'),
(38, 103, 'Test', 6, '2023-07-05 02:45:20', NULL, 0, 28, NULL, NULL, 'N', '2023-07-05 02:45:20', '2023-07-05 02:45:20'),
(39, 103, 'Test', 6, '2023-07-06 09:43:53', NULL, 0, 28, NULL, NULL, 'N', '2023-07-06 09:43:53', '2023-07-06 09:43:53'),
(40, 104, '', 6, '2023-07-17 08:07:07', NULL, 0, 4, NULL, NULL, 'N', '2023-07-17 08:07:07', '2023-07-17 08:07:07'),
(41, 104, '', 6, '2023-07-17 08:07:11', NULL, 0, 4, NULL, NULL, 'N', '2023-07-17 08:07:11', '2023-07-17 08:07:11'),
(42, 104, 'Urgent', 6, '2023-07-17 08:07:25', NULL, 0, 4, NULL, NULL, 'N', '2023-07-17 08:07:25', '2023-07-17 08:07:25'),
(43, 104, 'Urgent', 6, '2023-07-17 08:07:27', NULL, 0, 4, NULL, NULL, 'N', '2023-07-17 08:07:27', '2023-07-17 08:07:27'),
(44, 104, 'Urgent', 6, '2023-07-17 08:07:29', NULL, 0, 4, NULL, NULL, 'N', '2023-07-17 08:07:29', '2023-07-17 08:07:29'),
(45, 106, 'Urgent', 6, '2023-07-19 08:42:06', NULL, 0, 40, NULL, NULL, 'N', '2023-07-19 08:42:06', '2023-07-19 08:42:06'),
(46, 108, 'test', 6, '2023-12-21 10:13:10', NULL, 0, 40, NULL, NULL, 'N', '2023-12-21 10:13:10', '2023-12-21 10:13:10'),
(47, 116, 'ddd', 6, '2024-01-21 03:45:26', NULL, 0, 58, NULL, NULL, 'N', '2024-01-21 03:45:26', '2024-01-21 03:45:26'),
(48, 121, '', 6, '2024-01-31 12:29:39', NULL, 0, 3, NULL, NULL, 'N', '2024-01-31 12:29:39', '2024-01-31 12:29:39'),
(49, 122, 'urgent', 6, '2024-02-01 06:43:34', NULL, 0, 40, NULL, NULL, 'N', '2024-02-01 06:43:34', '2024-02-01 06:43:34'),
(50, 123, 'test', 6, '2024-02-01 06:44:51', NULL, 0, 3, NULL, NULL, 'N', '2024-02-01 06:44:51', '2024-02-01 06:44:51'),
(51, 124, '', 6, '2024-02-05 03:51:14', NULL, 0, 58, NULL, NULL, 'N', '2024-02-05 03:51:14', '2024-02-05 03:51:14'),
(52, 120, '', 6, '2024-02-06 11:22:52', NULL, 0, 58, NULL, NULL, 'N', '2024-02-06 11:22:52', '2024-02-06 11:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_jobupdateimage`
--

DROP TABLE IF EXISTS `gtg_jobupdateimage`;
CREATE TABLE IF NOT EXISTS `gtg_jobupdateimage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jobid` int DEFAULT NULL,
  `path` varchar(500) DEFAULT NULL,
  `taken` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_job_images`
--

DROP TABLE IF EXISTS `gtg_job_images`;
CREATE TABLE IF NOT EXISTS `gtg_job_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `job_clock_in_photo` text COLLATE utf8mb4_general_ci NOT NULL,
  `job_clock_in_location` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_clock_in_latitude` text COLLATE utf8mb4_general_ci NOT NULL,
  `job_clock_in_longitude` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_job_images`
--

INSERT INTO `gtg_job_images` (`id`, `job_id`, `job_clock_in_photo`, `job_clock_in_location`, `cr_date`, `job_clock_in_latitude`, `job_clock_in_longitude`) VALUES
(61, 93, 'image_65ba9b2f7781f.png', '37, Jalan Uranus Ah U5/Aj, Subang Pelangi, 40150 Shah Alam, Selangor, Malaysia', '2024-01-31 19:10:39', '3.1683018', '101.5332463'),
(62, 14, 'image_65bb68662d268.png', 'Jalan Tanpa Nama, Pusat Perdagangan Dana 1, 47301 Petaling Jaya, Selangor, Malaysia', '2024-02-01 09:46:14', '3.1134604', '101.5775421'),
(12, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a08ceb948.png', '', '2024-01-24 05:30:52', '', ''),
(13, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a08e39998.png', '', '2024-01-24 05:30:54', '', ''),
(14, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a08f943a7.png', '', '2024-01-24 05:30:55', '', ''),
(15, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a090aeb8d.png', '', '2024-01-24 05:30:56', '', ''),
(16, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a091ca4cf.png', '', '2024-01-24 05:30:57', '', ''),
(17, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09303f90.png', '', '2024-01-24 05:30:59', '', ''),
(18, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a094390da.png', '', '2024-01-24 05:31:00', '', ''),
(19, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0954be05.png', '', '2024-01-24 05:31:01', '', ''),
(20, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09665f8b.png', '', '2024-01-24 05:31:02', '', ''),
(21, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a097d3a49.png', '', '2024-01-24 05:31:03', '', ''),
(22, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a098edbfe.png', '', '2024-01-24 05:31:04', '', ''),
(23, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09a3fc98.png', '', '2024-01-24 05:31:06', '', ''),
(24, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09bc0720.png', '', '2024-01-24 05:31:07', '', ''),
(25, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09cba866.png', '', '2024-01-24 05:31:08', '', ''),
(26, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09e0b290.png', '', '2024-01-24 05:31:10', '', ''),
(27, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a09f291bf.png', '', '2024-01-24 05:31:11', '', ''),
(28, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a01a14c.png', '', '2024-01-24 05:31:12', '', ''),
(29, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a39d21e.png', '', '2024-01-24 05:31:15', '', ''),
(30, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a485dca.png', '', '2024-01-24 05:31:16', '', ''),
(31, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a64baba.png', '', '2024-01-24 05:31:18', '', ''),
(32, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a7aaa24.png', '', '2024-01-24 05:31:19', '', ''),
(33, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0a8c79c4.png', '', '2024-01-24 05:31:20', '', ''),
(34, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0aa2bf9e.png', '', '2024-01-24 05:31:22', '', ''),
(35, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0ab39c9e.png', '', '2024-01-24 05:31:23', '', ''),
(36, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0ac45fbd.png', '', '2024-01-24 05:31:24', '', ''),
(37, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0ad43875.png', '', '2024-01-24 05:31:25', '', ''),
(38, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0ae4280e.png', '', '2024-01-24 05:31:26', '', ''),
(39, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0af9359a.png', '', '2024-01-24 05:31:27', '', ''),
(40, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b11a1d0.png', '', '2024-01-24 05:31:29', '', ''),
(41, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b246435.png', '', '2024-01-24 05:31:30', '', ''),
(42, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b342139.png', '', '2024-01-24 05:31:31', '', ''),
(43, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b499f42.png', '', '2024-01-24 05:31:32', '', ''),
(44, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b5dc31c.png', '', '2024-01-24 05:31:33', '', ''),
(45, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b73afaa.png', '', '2024-01-24 05:31:35', '', ''),
(46, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b84dcea.png', '', '2024-01-24 05:31:36', '', ''),
(47, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0b9305d9.png', '', '2024-01-24 05:31:37', '', ''),
(48, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0ba50f24.png', '', '2024-01-24 05:31:38', '', ''),
(49, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0bb8fb71.png', '', '2024-01-24 05:31:39', '', ''),
(50, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0bc8b0bb.png', '', '2024-01-24 05:31:40', '', ''),
(51, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0bde4110.png', '', '2024-01-24 05:31:41', '', ''),
(52, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0bf0b8af.png', '', '2024-01-24 05:31:43', '', ''),
(53, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a0c042be1.png', '', '2024-01-24 05:31:44', '', ''),
(54, 68, 'C:\\wamp64\\www\\erp-dev\\userfiles/job_clock_in_photos/image_65b0a5e0b2bc1.png', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', '2024-01-24 05:53:36', '3.1135387', '101.5775329'),
(55, 68, 'image_65b0d408d0db5.png', '4H7H+92 Petaling Jaya, Selangor, Malaysia', '2024-01-24 09:10:32', '3.1134815', '101.5775365'),
(56, 68, 'image_65b0dc057f23a.png', '4H7H+F2 Petaling Jaya, Selangor, Malaysia', '2024-01-24 09:44:37', '3.1136348', '101.5775067'),
(57, 60, 'image_65b0dfc6be7f4.png', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', '2024-01-24 10:00:38', '3.1136113', '101.5775162'),
(58, 77, 'image_65b3801ea0711.png', '4H7H+C2 Petaling Jaya, Selangor, Malaysia', '2024-01-26 09:49:18', '3.113585', '101.5775333');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_locations`
--

DROP TABLE IF EXISTS `gtg_locations`;
CREATE TABLE IF NOT EXISTS `gtg_locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `taxid` varchar(40) DEFAULT NULL,
  `logo` varchar(50) DEFAULT 'logo.png',
  `cur` int NOT NULL,
  `ware` int DEFAULT '0',
  `ext` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_log`
--

DROP TABLE IF EXISTS `gtg_log`;
CREATE TABLE IF NOT EXISTS `gtg_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `note` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3331 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_log`
--

INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(1, '[Logged In] admin@admin.com', '2022-04-14 01:38:50', ''),
(2, '[Employee ClockIn]  ID 6', '2022-04-14 01:44:34', 'admin'),
(3, '[Employee ClockIn]  ID 6', '2022-04-14 01:44:44', 'admin'),
(4, '[Employee ClockIn]  ID 6', '2022-04-14 01:44:49', 'admin'),
(5, '[Client Added] jerr edwin ID 2', '2022-04-14 02:33:58', 'admin'),
(6, '[Client Updated] jerry edwin ID 2', '2022-04-14 02:43:38', 'admin'),
(7, '[Logged Out] admin', '2022-04-14 05:35:45', ''),
(8, '[Logged In] admin@admin.com', '2022-04-14 05:36:19', ''),
(9, '[Logged In] admin@admin.com', '2022-04-14 19:30:52', ''),
(10, '[Logged Out] admin', '2022-04-14 19:34:13', ''),
(11, '[Logged In] admin@admin.com', '2022-04-14 19:38:44', ''),
(12, '[Logged Out] admin', '2022-04-14 19:41:34', ''),
(13, '[Logged In] admin@admin.com', '2022-04-14 19:42:24', ''),
(14, '[Logged Out] admin', '2022-04-14 19:43:16', ''),
(15, '[Logged In] admin@admin.com', '2022-04-14 19:44:47', ''),
(16, '[Logged Out] admin', '2022-04-14 19:47:10', ''),
(17, '[Logged In] salesperson@abc.om', '2022-04-14 19:48:19', ''),
(18, '[Employee ClockIn]  ID 7', '2022-04-14 19:49:32', 'salesperson'),
(19, '[Logged Out] salesperson', '2022-04-14 19:59:38', ''),
(20, '[Logged In] admin@admin.com', '2022-04-14 19:59:56', ''),
(21, '[Category Created] coffee shop ID 2', '2022-04-14 20:00:42', 'admin'),
(22, '[Category Created] supermarket ID 3', '2022-04-14 20:10:07', 'admin'),
(23, '[Category Created] tea  ID 4', '2022-04-14 20:10:58', 'admin'),
(24, '[New Product] -AVT tea  -Qty-10 ID 1', '2022-04-14 20:12:50', 'admin'),
(25, '[Payment Invoice 2]  Transaction-1 - 189 ', '2022-04-14 20:14:24', 'admin'),
(26, '[Logged In] admin@admin.com', '2022-10-31 12:06:17', ''),
(27, '[Logged In] admin@admin.com', '2022-10-31 23:22:10', ''),
(28, '[Logged Out] admin', '2022-10-31 23:27:15', ''),
(29, '[Logged In] admin@admin.com', '2022-10-31 23:27:34', ''),
(30, '[Logged Out] admin', '2022-10-31 23:29:46', ''),
(31, '[Logged In] admin@admin.com', '2022-10-31 23:29:59', ''),
(32, '[Client Added] BILAL ID 3', '2022-10-31 23:33:10', 'admin'),
(33, '[Employee ClockIn]  ID 6', '2022-10-31 23:52:03', 'admin'),
(34, '[Logged Out] admin', '2022-10-31 23:52:25', ''),
(35, '[Logged In] admin@admin.com', '2022-10-31 23:53:15', ''),
(36, '[Client Added] jsoftsolution.com.my ID 4', '2022-10-31 23:57:03', 'admin'),
(37, '[Client Updated] jsoftsolution.com.my ID 4', '2022-10-31 23:58:18', 'admin'),
(38, '[Logged Out] admin', '2022-11-01 00:32:39', ''),
(39, '[Logged In] admin@admin.com', '2022-11-01 00:33:32', ''),
(40, '[Logged Out] admin', '2022-11-01 00:42:40', ''),
(41, '[Logged In] krish@jsoftsolution.com.my', '2022-11-01 00:43:11', ''),
(42, '[Client Added] FARIDA ID 5', '2022-11-01 00:48:15', 'krish'),
(43, '[Logged Out] krish', '2022-11-01 00:49:15', ''),
(44, '[Logged In] admin@admin.com', '2022-11-01 00:49:28', ''),
(45, '[Logged Out] admin', '2022-11-01 00:50:34', ''),
(46, '[Logged In] krish@jsoftsolution.com.my', '2022-11-01 00:50:56', ''),
(47, '[Client Added] FARIDA ID 6', '2022-11-01 00:53:13', 'krish'),
(48, '[Logged Out] krish', '2022-11-01 00:53:24', ''),
(49, '[Logged In] admin@admin.com', '2022-11-01 00:54:58', ''),
(50, '[Logged Out] admin', '2022-11-01 00:58:20', ''),
(51, '[Logged In] admin@admin.com', '2022-11-01 01:04:10', ''),
(52, '[Logged Out] admin', '2022-11-01 01:05:33', ''),
(53, '[Logged In] krish@jsoftsolution.com.my', '2022-11-01 01:05:54', ''),
(54, '[Logged Out] krish', '2022-11-01 01:08:58', ''),
(55, '[Logged In] krish@jsoftsolution.com.my', '2022-11-01 01:10:23', ''),
(56, '[Logged Out] krish', '2022-11-01 01:12:58', ''),
(57, '[Logged In] admin@admin.com', '2022-11-01 01:16:08', ''),
(58, '[Employee ClockIn]  ID 6', '2022-11-01 01:22:53', 'admin'),
(59, '[Client Deleted]  ID 5', '2022-11-01 01:32:03', 'admin'),
(60, '[Client Doc Deleted]  DocId 5 CID 5', '2022-11-01 01:32:03', 'admin'),
(61, '[Logged Out] admin', '2022-11-01 01:49:48', ''),
(62, '[Logged In] krish@jsoftsolution.com.my', '2022-11-01 01:50:12', ''),
(63, '[Employee ClockIn]  ID 8', '2022-11-01 01:50:18', 'krish'),
(64, '[Employee ClockOut]  ID 8', '2022-11-01 01:50:30', 'krish'),
(65, '[Logged Out] krish', '2022-11-01 01:50:37', ''),
(66, '[Logged In] admin@admin.com', '2022-11-01 01:50:49', ''),
(67, '[Logged In] Admin@admin.com', '2022-11-01 19:47:04', ''),
(68, '[Logged Out] admin', '2022-11-01 19:48:27', ''),
(69, '[Logged In] Krish@jsoftsolution.com.my', '2022-11-01 19:53:04', ''),
(70, '[Employee ClockIn]  ID 8', '2022-11-01 19:55:08', 'krish'),
(71, '[Logged Out] krish', '2022-11-01 19:56:46', ''),
(72, '[Logged In] admin@admin.com', '2022-11-01 19:57:03', ''),
(73, '[Logged In] admin@admin.com', '2022-11-02 22:30:28', ''),
(74, '[Logged In] admin@admin.com', '2022-11-03 00:48:06', ''),
(75, '[Logged In] admin@admin.com', '2022-12-23 02:02:03', ''),
(76, '[Logged In] admin@admin.com', '2022-12-23 02:16:27', ''),
(77, '[Client Added] Abhishk ID 7', '2022-12-23 02:36:25', 'admin'),
(78, '[Logged Out] admin', '2022-12-23 02:39:33', ''),
(79, '[Logged Out] admin', '2022-12-23 02:40:25', ''),
(80, '[Logged In] admin@admin.com', '2023-01-10 23:48:31', ''),
(81, '[Logged In] admin@admin.com', '2023-01-11 00:33:45', ''),
(82, '[Logged In] admin@admin.com', '2023-01-20 02:01:19', ''),
(83, '[Logged In] admin@admin.com', '2023-01-20 05:41:21', ''),
(84, '[Logged In] admin@admin.com', '2023-01-22 23:58:40', ''),
(85, '[Logged In] raj@jsoftsolution.com.my', '2023-01-23 00:02:17', ''),
(86, '[Logged Out] raj', '2023-01-23 00:02:29', ''),
(87, '[Logged In] admin@admin.com', '2023-01-24 01:09:09', ''),
(88, '[Logged Out] admin', '2023-01-24 01:11:01', ''),
(89, '[Logged In] admin@admin.com', '2023-01-24 01:11:58', ''),
(90, '[Logged In] admin@admin.com', '2023-01-24 01:13:20', ''),
(91, '[Logged In] admin@admin.com', '2023-01-24 04:38:28', ''),
(92, '[Logged Out] admin', '2023-01-24 05:05:38', ''),
(93, '[Logged In] admin@admin.com', '2023-01-24 05:12:29', ''),
(94, '[Logged Out] admin', '2023-01-24 05:13:10', ''),
(95, '[Logged In] admin@admin.com', '2023-01-24 07:23:53', ''),
(96, '[Logged In] admin@admin.com', '2023-01-26 04:02:27', ''),
(97, '[Logged In] admin@admin.com', '2023-01-26 23:40:53', ''),
(98, '[Logged In] admin@admin.com', '2023-01-29 13:18:29', ''),
(99, '[Logged In] admin@admin.com', '2023-01-29 18:06:44', ''),
(100, '[Logged In] admin@admin.com', '2023-01-29 18:17:44', ''),
(101, '[Logged In] admin@admin.com', '2023-01-29 18:21:40', ''),
(102, '[Logged Out] admin', '2023-01-29 18:23:01', ''),
(103, '[Logged In] admin@admin.com', '2023-01-29 18:23:16', ''),
(104, '[Logged In] admin@admin.com', '2023-01-29 18:33:21', ''),
(105, '[Logged In] admin@admin.com', '2023-01-29 23:54:23', ''),
(106, '[Logged In] admin@admin.com', '2023-01-29 23:55:08', ''),
(107, '[Logged In] admin@admin.com', '2023-01-29 23:55:11', ''),
(108, '[Logged In] admin@admin.com', '2023-01-29 23:55:42', ''),
(109, '[Logged In] admin@admin.com', '2023-01-30 00:18:27', ''),
(110, '[Logged In] admin@admin.com', '2023-01-30 11:57:17', ''),
(111, '[Logged Out] admin', '2023-01-30 12:28:44', ''),
(112, '[Logged In] admin@admin.com', '2023-01-30 12:32:40', ''),
(113, '[Logged In] admin@admin.com', '2023-01-30 22:32:57', ''),
(114, '[Jobsheets Doc Added]  DocId test ComplaintId 30', '2023-01-30 22:34:44', 'admin'),
(115, '[Jobsheets Doc Added]  DocId test ComplaintId 31', '2023-01-30 22:36:26', 'admin'),
(116, '[Jobsheets Added] 6 TaskId 31', '2023-01-30 22:36:26', 'admin'),
(117, '[Jobsheets Doc Added]  DocId test ComplaintId 32', '2023-01-30 23:32:33', 'admin'),
(118, '[Jobsheets Added] 6 TaskId 32', '2023-01-30 23:32:33', 'admin'),
(119, '[Jobsheets Doc Added]  DocId test ComplaintId 33', '2023-01-30 23:51:14', 'admin'),
(120, '[Jobsheets Added] 6 TaskId 33', '2023-01-30 23:51:14', 'admin'),
(121, '[Jobsheets Doc Added]  DocId test ComplaintId 34', '2023-01-30 23:55:40', 'admin'),
(122, '[Jobsheets Added] 6 TaskId 34', '2023-01-30 23:55:40', 'admin'),
(123, '[Jobsheets Doc Added]  DocId test ComplaintId 35', '2023-01-30 23:56:05', 'admin'),
(124, '[Jobsheets Added] 6 TaskId 35', '2023-01-30 23:56:05', 'admin'),
(125, '[Jobsheets Doc Added]  DocId test ComplaintId 36', '2023-01-30 23:59:17', 'admin'),
(126, '[Jobsheets Added] 6 TaskId 36', '2023-01-30 23:59:17', 'admin'),
(127, '[Jobsheets Doc Added]  DocId test ComplaintId 37', '2023-01-31 00:00:03', 'admin'),
(128, '[Jobsheets Added] 6 TaskId 37', '2023-01-31 00:00:03', 'admin'),
(129, '[Jobsheets Doc Added]  DocId test ComplaintId 38', '2023-01-31 00:00:27', 'admin'),
(130, '[Jobsheets Added] 6 TaskId 38', '2023-01-31 00:00:27', 'admin'),
(131, '[Jobsheets Doc Added]  DocId test ComplaintId 39', '2023-01-31 00:02:19', 'admin'),
(132, '[Jobsheets Added] 6 TaskId 39', '2023-01-31 00:02:19', 'admin'),
(133, '[Jobsheets Doc Added]  DocId test ComplaintId 40', '2023-01-31 00:11:56', 'admin'),
(134, '[Jobsheets Added] 6 TaskId 40', '2023-01-31 00:11:56', 'admin'),
(135, '[Jobsheets Doc Added]  DocId test ComplaintId 41', '2023-01-31 00:12:12', 'admin'),
(136, '[Jobsheets Added] 6 TaskId 41', '2023-01-31 00:12:12', 'admin'),
(137, '[Jobsheets Doc Added]  DocId test ComplaintId 42', '2023-01-31 00:13:44', 'admin'),
(138, '[Jobsheets Added] 6 TaskId 42', '2023-01-31 00:13:44', 'admin'),
(139, '[Jobsheets Doc Added]  DocId test ComplaintId 43', '2023-01-31 00:25:49', 'admin'),
(140, '[Jobsheets Added] 6 TaskId 43', '2023-01-31 00:25:49', 'admin'),
(141, '[Jobsheets Doc Added]  DocId test ComplaintId 44', '2023-01-31 00:33:53', 'admin'),
(142, '[Jobsheets Added] 6 TaskId 44', '2023-01-31 00:33:53', 'admin'),
(143, '[Jobsheets Doc Added]  DocId test ComplaintId 45', '2023-01-31 00:40:02', 'admin'),
(144, '[Jobsheets Added] 6 TaskId 45', '2023-01-31 00:40:02', 'admin'),
(145, '[Jobsheets Doc Added]  DocId test ComplaintId 46', '2023-01-31 00:40:10', 'admin'),
(146, '[Jobsheets Added] 6 TaskId 46', '2023-01-31 00:40:10', 'admin'),
(147, '[Jobsheets Doc Added]  DocId test ComplaintId 47', '2023-01-31 00:40:40', 'admin'),
(148, '[Jobsheets Added] 6 TaskId 47', '2023-01-31 00:40:40', 'admin'),
(149, '[Jobsheets Doc Added]  DocId test ComplaintId 48', '2023-01-31 00:40:45', 'admin'),
(150, '[Jobsheets Added] 6 TaskId 48', '2023-01-31 00:40:45', 'admin'),
(151, '[Jobsheets Doc Added]  DocId test ComplaintId 49', '2023-01-31 00:42:41', 'admin'),
(152, '[Jobsheets Added] 6 TaskId 49', '2023-01-31 00:42:41', 'admin'),
(153, '[Jobsheets Doc Added]  DocId test ComplaintId 50', '2023-01-31 00:43:27', 'admin'),
(154, '[Jobsheets Added] 6 TaskId 50', '2023-01-31 00:43:27', 'admin'),
(155, '[Jobsheets Doc Added]  DocId test ComplaintId 51', '2023-01-31 00:48:54', 'admin'),
(156, '[Jobsheets Added] 6 TaskId 51', '2023-01-31 00:48:54', 'admin'),
(157, '[Jobsheets Doc Added]  DocId test ComplaintId 52', '2023-01-31 00:49:11', 'admin'),
(158, '[Jobsheets Added] 6 TaskId 52', '2023-01-31 00:49:11', 'admin'),
(159, '[Jobsheets Doc Added]  DocId test ComplaintId 53', '2023-01-31 00:55:57', 'admin'),
(160, '[Jobsheets Added] 6 TaskId 53', '2023-01-31 00:55:57', 'admin'),
(161, '[Jobsheets Doc Added]  DocId test ComplaintId 54', '2023-01-31 02:10:09', 'admin'),
(162, '[Jobsheets Added] 6 TaskId 54', '2023-01-31 02:10:09', 'admin'),
(163, '[Jobsheets Doc Added]  DocId test ComplaintId 55', '2023-01-31 02:13:35', 'admin'),
(164, '[Jobsheets Added] 6 TaskId 55', '2023-01-31 02:13:35', 'admin'),
(165, '[Logged In] admin@admin.com', '2023-01-31 05:37:30', ''),
(166, '[Logged In] admin@admin.com', '2023-02-01 00:19:37', ''),
(167, '[Logged In] admin@admin.com', '2023-02-01 05:41:24', ''),
(168, '[Logged In] admin@admin.com', '2023-02-02 00:31:26', ''),
(169, '[Logged Out] admin', '2023-02-02 02:14:29', ''),
(170, '[Logged In] admin@admin.com', '2023-02-02 02:14:48', ''),
(171, '[Logged Out] admin', '2023-02-02 02:20:52', ''),
(172, '[Logged In] admin@admin.com', '2023-02-02 02:21:06', ''),
(173, '[Logged In] admin@admin.com', '2023-02-02 08:42:32', ''),
(174, '[Logged In] admin@admin.com', '2023-02-05 05:16:55', ''),
(175, '[Logged Out] admin', '2023-02-05 07:23:20', ''),
(176, '[Logged In] admin@admin.com', '2023-02-05 07:23:28', ''),
(177, '[Logged In] admin@admin.com', '2023-02-05 19:35:15', ''),
(178, '[Logged Out] admin', '2023-02-05 22:00:48', ''),
(179, '[Logged In] admin@admin.com', '2023-02-05 22:01:33', ''),
(180, '[Logged Out] admin', '2023-02-05 22:21:23', ''),
(181, '[Logged In] abcd@gmail.com', '2023-02-05 22:21:34', ''),
(182, '[Logged Out] abcd', '2023-02-05 22:34:38', ''),
(183, '[Logged In] admin@admin.com', '2023-02-05 22:34:54', ''),
(184, '[Jobsheets Doc Added]  DocId Emp’ee ComplaintId 58', '2023-02-05 23:36:37', 'admin'),
(185, '[Jobsheets Added] 6 TaskId 58', '2023-02-05 23:36:37', 'admin'),
(186, '[Logged Out] admin', '2023-02-05 23:45:54', ''),
(187, '[Logged In] admin@admin.com', '2023-02-05 23:46:19', ''),
(188, '[Logged Out] admin', '2023-02-05 23:46:48', ''),
(189, '[Logged In] abcd@gmail.com', '2023-02-05 23:47:01', ''),
(190, '[Logged In] admin@admin.com', '2023-02-06 05:13:39', ''),
(191, '[Logged In] admin@admin.com', '2023-02-06 10:32:47', ''),
(192, '[Logged In] admin@admin.com', '2023-02-06 22:31:21', ''),
(193, '[Logged Out] admin', '2023-02-06 23:33:40', ''),
(194, '[Logged In] ajmal@jsoftsolution.com.my', '2023-02-06 23:33:49', ''),
(195, '[Logged Out] ajmal', '2023-02-07 02:47:47', ''),
(196, '[Logged In] admin@admin.com', '2023-02-07 02:47:58', ''),
(197, '[Logged Out] admin', '2023-02-07 03:52:16', ''),
(198, '[Logged In] ajmal@jsoftsolution.com.my', '2023-02-07 03:52:26', ''),
(199, '[Logged Out] ajmal', '2023-02-07 03:53:25', ''),
(200, '[Logged In] admin@admin.com', '2023-02-07 03:53:35', ''),
(201, '[Logged Out] admin', '2023-02-07 03:54:20', ''),
(202, '[Logged In] abcd@gmail.com', '2023-02-07 03:54:27', ''),
(203, '[Logged Out] abcd', '2023-02-07 03:58:04', ''),
(204, '[Logged In] admin@admin.com', '2023-02-07 03:58:25', ''),
(205, '[Logged Out] admin', '2023-02-07 08:55:27', ''),
(206, '[Logged In] ajmal@jsoftsolution.com.my', '2023-02-07 08:55:43', ''),
(207, '[Logged In] admin@admin.com', '2023-02-07 09:32:01', ''),
(208, '[Logged Out] admin', '2023-02-07 09:35:39', ''),
(209, '[Logged In] abcd@gmail.com', '2023-02-07 09:35:46', ''),
(210, '[Logged In] admin@admin.com', '2023-02-08 02:01:39', ''),
(211, '[Logged In] admin@admin.com', '2023-02-08 22:33:11', ''),
(212, '[Logged In] admin@admin.com', '2023-02-09 21:30:06', ''),
(213, '[Logged Out] admin', '2023-02-09 21:31:18', ''),
(214, '[Logged In] admin@admin.com', '2023-02-09 21:32:23', ''),
(215, '[Logged In] admin@admin.com', '2023-02-09 22:51:06', ''),
(216, '[Logged Out] admin', '2023-02-09 22:55:21', ''),
(217, '[Client Wallet Recharge] Amt-500 ID 1', '2023-02-09 23:18:19', 'admin'),
(218, '[Group Created] Register Client ID 2', '2023-02-10 00:39:14', 'admin'),
(219, '[Client Updated] Walk-in Client ID 1', '2023-02-10 00:42:13', 'admin'),
(220, '[Logged In] admin@admin.com', '2023-02-12 22:58:39', ''),
(221, '[Client Updated] Shafeek Ajmal ID 1', '2023-02-12 23:08:17', 'admin'),
(222, '[Client Updated] Shafeek Ajmal ID 1', '2023-02-12 23:08:27', 'admin'),
(223, '[Logged In] admin@admin.com', '2023-02-13 06:20:15', ''),
(224, '[Logged Out] admin', '2023-02-13 07:39:26', ''),
(225, '[Logged In] admin@admin.com', '2023-02-13 23:19:57', ''),
(226, '[Logged In] admin@admin.com', '2023-02-14 02:00:11', ''),
(227, '[Logged In] admin@admin.com', '2023-02-16 05:00:55', ''),
(228, '[Logged Out] admin', '2023-02-16 07:42:19', ''),
(229, '[Logged In] admin@admin.com', '2023-02-16 07:44:42', ''),
(230, '[Logged Out] admin', '2023-02-16 07:46:46', ''),
(231, '[Logged In] admin@admin.com', '2023-02-16 07:47:27', ''),
(232, '[Logged Out] admin', '2023-02-16 07:48:19', ''),
(233, '[Logged In] admin@admin.com', '2023-02-16 07:54:41', ''),
(234, '[Logged Out] admin', '2023-02-16 07:57:20', ''),
(235, '[Logged In] admin@admin.com', '2023-02-16 07:57:41', ''),
(236, '[Client Added] Jsoftsolution ID 9', '2023-02-16 08:44:35', 'admin'),
(237, '[Client Added] Jsoftsolution ID 10', '2023-02-16 08:57:08', 'admin'),
(238, '[Logged In] admin@admin.com', '2023-02-16 23:29:58', ''),
(239, '[Logged Out] admin', '2023-02-16 23:30:39', ''),
(240, '[Logged In] admin@admin.com', '2023-02-17 00:21:16', ''),
(241, '[Logged Out] admin', '2023-02-17 00:23:29', ''),
(242, '[Logged In] admin@admin.com', '2023-02-17 00:24:32', ''),
(243, '[Logged Out] admin', '2023-02-17 00:56:12', ''),
(244, '[Logged In] admin@admin.com', '2023-02-17 00:58:58', ''),
(245, '[Logged In] admin@admin.com', '2023-02-17 03:54:02', ''),
(246, '[Logged Out] admin', '2023-02-17 03:56:29', ''),
(247, '[Logged In] admin@admin.com', '2023-02-17 04:00:22', ''),
(248, '[Logged Out] admin', '2023-02-17 04:03:33', ''),
(249, '[Logged In] admin@admin.com', '2023-02-17 04:09:28', ''),
(250, '[Logged Out] admin', '2023-02-17 04:10:01', ''),
(251, '[Logged In] admin@admin.com', '2023-02-17 04:21:00', ''),
(252, '[Logged Out] admin', '2023-02-17 04:26:08', ''),
(253, '[Logged In] admin@admin.com', '2023-02-17 04:26:29', ''),
(254, '[Logged Out] admin', '2023-02-17 05:23:08', ''),
(255, '[Logged In] admin@admin.com', '2023-02-19 22:17:30', ''),
(256, '[Jobsheets Doc Added]  DocId Testing GTG ComplaintId 59', '2023-02-20 03:46:15', 'admin'),
(257, '[Jobsheets Added] 6 TaskId 59', '2023-02-20 03:46:15', 'admin'),
(258, '[Logged Out] admin', '2023-02-20 03:48:29', ''),
(259, '[Logged In] admin@admin.com', '2023-02-20 03:59:14', ''),
(260, '[Logged Out] admin', '2023-02-20 04:27:59', ''),
(261, '[Logged In] abcd@gmail.com', '2023-02-20 04:28:22', ''),
(262, '[Logged Out] abcd', '2023-02-20 04:28:30', ''),
(263, '[Logged In] admin@admin.com', '2023-02-20 04:28:45', ''),
(264, '[Logged Out] admin', '2023-02-20 04:29:32', ''),
(265, '[Logged In] admin@admin.com', '2023-02-20 12:49:25', ''),
(266, '[Logged Out] admin', '2023-02-20 12:50:08', ''),
(267, '[Logged In] admin@admin.com', '2023-02-20 13:46:11', ''),
(268, '[Logged Out] admin', '2023-02-20 13:50:27', ''),
(269, '[Logged In] admin@admin.com', '2023-02-22 01:21:54', ''),
(270, '[Logged In] admin@admin.com', '2023-02-23 00:07:12', ''),
(271, '[Logged Out] admin', '2023-02-23 00:07:30', ''),
(272, '[Logged In] admin@admin.com', '2023-02-23 00:07:58', ''),
(273, '[Logged Out] admin', '2023-02-23 00:08:24', ''),
(274, '[Logged In] admin@admin.com', '2023-02-23 00:08:45', ''),
(275, '[Logged Out] admin', '2023-02-23 00:09:06', ''),
(276, '[Logged In] admin@admin.com', '2023-02-23 00:13:56', ''),
(277, '[Payment Invoice 3]  Transaction-3 - 1 ', '2023-02-23 00:15:28', NULL),
(278, '[Client Updated] Shafeek Ajmal ID 1', '2023-02-23 00:38:01', 'admin'),
(279, '[Payment Invoice 3]  Transaction-4 - 99 ', '2023-02-23 00:50:25', NULL),
(280, '[Logged In] admin@admin.com', '2023-02-23 02:26:49', ''),
(281, '[Logged In] admin@admin.com', '2023-02-27 01:49:00', ''),
(282, '[Logged Out] admin', '2023-02-27 01:49:38', ''),
(283, '[Logged In] admin@admin.com', '2023-02-27 23:57:05', ''),
(284, '[Logged Out] admin', '2023-02-27 23:58:57', ''),
(285, '[Logged In] admin@admin.com', '2023-02-28 07:36:53', ''),
(286, '[Logged Out] admin', '2023-02-28 08:03:06', ''),
(287, '[Logged In] admin@admin.com', '2023-03-06 05:51:06', ''),
(288, '[Logged In] admin@admin.com', '2023-03-06 06:06:41', ''),
(289, '[Logged In] admin@admin.com', '2023-03-09 02:24:12', ''),
(290, '[Logged Out] admin', '2023-03-09 02:41:49', ''),
(291, '[Logged In] admin@admin.com', '2023-03-09 02:41:59', ''),
(292, '[Logged Out] admin', '2023-03-09 03:32:08', ''),
(293, '[Logged In] admin@admin.com', '2023-03-09 03:51:44', ''),
(294, '[Logged Out] admin', '2023-03-09 06:11:25', ''),
(295, '[Logged In] admin@admin.com', '2023-03-09 06:43:07', ''),
(296, '[Logged Out] admin', '2023-03-09 06:45:35', ''),
(297, '[Logged In] admin@admin.com', '2023-03-09 06:50:00', ''),
(298, '[Logged Out] admin', '2023-03-09 06:58:31', ''),
(299, '[Logged In] admin@admin.com', '2023-03-09 06:58:49', ''),
(300, '[Logged Out] admin', '2023-03-09 06:59:19', ''),
(301, '[Logged In] admin@admin.com', '2023-03-09 23:23:24', ''),
(302, '[Client Updated] Jsoftsolution ID 10', '2023-03-09 23:23:57', 'admin'),
(303, '[Logged In] admin@admin.com', '2023-03-10 03:43:49', ''),
(304, '[Logged In] admin@admin.com', '2023-03-10 06:49:00', ''),
(305, '[Logged Out] admin', '2023-03-10 07:05:56', ''),
(306, '[Logged In] admin@admin.com', '2023-03-10 07:06:33', ''),
(307, '[Logged Out] admin', '2023-03-10 07:07:55', ''),
(308, '[Logged In] admin@admin.com', '2023-03-10 07:08:20', ''),
(309, '[Logged Out] admin', '2023-03-10 07:15:15', ''),
(310, '[Payment Invoice 3]  Transaction-5 - 99 ', '2023-03-10 07:16:09', NULL),
(311, '[Logged In] admin@admin.com', '2023-03-10 22:41:34', ''),
(312, '[Logged Out] admin', '2023-03-10 22:44:30', ''),
(313, '[Logged In] admin@admin.com', '2023-03-10 22:44:42', ''),
(314, '[Logged Out] admin', '2023-03-10 22:45:32', ''),
(315, '[Logged In] admin@admin.com', '2023-03-11 01:11:18', ''),
(316, '[Logged In] admin@admin.com', '2023-03-12 22:12:48', ''),
(317, '[Logged Out] admin', '2023-03-13 00:17:05', ''),
(318, '[Logged In] admin@admin.com', '2023-03-13 00:17:18', ''),
(319, '[Logged Out] admin', '2023-03-13 00:45:50', ''),
(320, '[Payment Invoice 1]  Transaction-7 - 0.01 ', '2023-03-13 03:36:07', NULL),
(321, '[Payment Invoice 1]  Transaction-8 - 0.01 ', '2023-03-13 03:38:08', NULL),
(322, '[Payment Invoice 1]  Transaction-9 - 0.01 ', '2023-03-13 03:42:59', NULL),
(323, '[Payment Invoice 1]  Transaction-10 - 0.01 ', '2023-03-13 03:44:54', NULL),
(324, '[Payment Invoice 1]  Transaction-11 - 0.01 ', '2023-03-13 03:46:45', NULL),
(325, '[Payment Invoice 1]  Transaction-12 - 0.01 ', '2023-03-13 03:47:11', NULL),
(326, '[Payment Invoice 1]  Transaction-13 - 0.01 ', '2023-03-13 03:47:23', NULL),
(327, '[Payment Invoice 1]  Transaction-14 - 0.43 ', '2023-03-13 03:48:33', NULL),
(328, '[Logged In] admin@admin.com', '2023-03-13 04:03:10', ''),
(329, '[Logged Out] admin', '2023-03-13 04:04:18', ''),
(330, '[Logged In] admin@admin.com', '2023-03-13 04:52:49', ''),
(331, '[Logged Out] admin', '2023-03-13 04:53:24', ''),
(332, '[Logged In] admin@admin.com', '2023-03-13 06:42:56', ''),
(333, '[Logged Out] admin', '2023-03-13 06:43:04', ''),
(334, '[Logged In] admin@admin.com', '2023-03-13 15:08:14', ''),
(335, '[Logged Out] admin', '2023-03-13 15:08:57', ''),
(336, '[Payment Invoice 5]  Transaction-15 - 0.01 ', '2023-03-13 15:09:25', NULL),
(337, '[Payment Invoice 5]  Transaction-16 - 1 ', '2023-03-13 15:09:54', NULL),
(338, '[Logged In] admin@admin.com', '2023-03-13 23:13:32', ''),
(339, '[Logged Out] admin', '2023-03-13 23:30:44', ''),
(340, '[Payment Invoice 5]  Transaction-17 - 1 ', '2023-03-13 23:31:10', NULL),
(341, '[Logged In] admin@admin.com', '2023-03-14 00:12:06', ''),
(342, '[Logged Out] admin', '2023-03-14 00:22:14', ''),
(343, '[Logged In] admin@admin.com', '2023-03-14 01:04:05', ''),
(344, '[Logged Out] admin', '2023-03-14 01:58:09', ''),
(345, '[Logged In] admin@admin.com', '2023-03-14 01:58:22', ''),
(346, '[Logged In] admin@admin.com', '2023-03-14 02:08:40', ''),
(347, '[Logged Out] admin', '2023-03-14 03:13:03', ''),
(348, '[Logged In] admin@admin.com', '2023-03-14 03:29:01', ''),
(349, '[Logged Out] admin', '2023-03-14 03:44:40', ''),
(350, '[Logged In] admin@admin.com', '2023-03-14 04:03:08', ''),
(351, '[Logged Out] admin', '2023-03-14 04:05:59', ''),
(352, '[Logged In] admin@admin.com', '2023-03-14 09:10:17', ''),
(353, '[Logged Out] ', '2023-03-14 13:55:55', ''),
(354, '[Logged In] admin@admin.com', '2023-03-14 22:58:25', ''),
(355, '[Logged In] admin@admin.com', '2023-03-14 22:58:51', ''),
(356, '[Logged In] admin@admin.com', '2023-03-14 23:00:20', ''),
(357, '[Logged Out] admin', '2023-03-14 23:02:07', ''),
(358, '[Logged In] admin@admin.com', '2023-03-16 00:12:42', ''),
(359, '[Payment Invoice 5]  Transaction-18 - 0.01 ', '2023-03-21 03:50:41', 'Shafeek Ajmal'),
(360, '[Logged In] admin@admin.com', '2023-03-21 03:54:13', ''),
(361, '[Client Wallet Recharge] Amt-2 ID 10', '2023-03-21 03:55:44', 'admin'),
(362, '[Logged Out] admin', '2023-03-21 03:55:51', ''),
(363, '[Payment Invoice 4]  Transaction-19 - 0.01 ', '2023-03-21 03:56:14', 'Jsoftsolution'),
(364, '[Payment Invoice 4]  Transaction-20 - 0.01 ', '2023-03-21 04:06:10', 'Jsoftsolution'),
(365, '[Logged In] admin@admin.com', '2023-03-22 00:49:11', ''),
(366, '[Logged In] admin@admin.com', '2023-03-22 14:37:59', ''),
(367, '[Logged In] admin@admin.com', '2023-03-30 00:42:48', ''),
(368, '[Logged In] admin@admin.com', '2023-04-03 23:56:54', ''),
(369, '[Logged Out] admin', '2023-04-04 00:02:38', ''),
(370, '[Logged In] admin@admin.com', '2023-04-04 00:03:13', ''),
(371, '[Logged Out] admin', '2023-04-04 00:05:35', ''),
(372, '[Logged In] admin@admin.com', '2023-04-04 00:05:59', ''),
(373, '[Logged Out] admin', '2023-04-04 00:06:44', ''),
(374, '[Logged In] admin@admin.com', '2023-04-04 00:12:01', ''),
(375, '[Logged Out] admin', '2023-04-04 00:16:39', ''),
(376, '[Logged In] admin@admin.com', '2023-04-04 00:16:54', ''),
(377, '[Logged Out] admin', '2023-04-04 00:21:55', ''),
(378, '[Logged In] admin@admin.com', '2023-04-04 00:22:14', ''),
(379, '[Logged Out] admin', '2023-04-04 00:22:34', ''),
(380, '[Logged In] abcd@gmail.com', '2023-04-04 00:22:41', ''),
(381, '[Logged Out] abcd', '2023-04-04 00:32:19', ''),
(382, '[Logged In] admin@admin.com', '2023-04-04 01:35:35', ''),
(383, '[Logged Out] admin', '2023-04-04 01:36:02', ''),
(384, '[Logged In] abcd@gmail.com', '2023-04-04 01:36:16', ''),
(385, '[Logged Out] abcd', '2023-04-04 01:49:06', ''),
(386, '[Logged In] abcd@gmail.com', '2023-04-04 01:49:16', ''),
(387, '[Logged In] abcd@gmail.com', '2023-04-04 01:50:01', ''),
(388, '[Logged In] abcd@gmail.com', '2023-04-04 01:50:53', ''),
(389, '[Logged In] abcd@gmail.com', '2023-04-04 01:51:36', ''),
(390, '[Logged In] abcd@gmail.com', '2023-04-04 01:52:09', ''),
(391, '[Logged In] abcd@gmail.com', '2023-04-04 01:52:34', ''),
(392, '[Logged In] abcd@gmail.com', '2023-04-04 01:53:38', ''),
(393, '[Logged In] abcd@gmail.com', '2023-04-04 01:54:11', ''),
(394, '[Logged In] abcd@gmail.com', '2023-04-04 01:55:59', ''),
(395, '[Logged In] abcd@gmail.com', '2023-04-04 01:56:32', ''),
(396, '[Logged In] abcd@gmail.com', '2023-04-04 01:58:04', ''),
(397, '[Logged In] abcd@gmail.com', '2023-04-04 01:58:29', ''),
(398, '[Logged In] abcd@gmail.com', '2023-04-04 02:01:16', ''),
(399, '[Logged In] abcd@gmail.com', '2023-04-04 02:04:02', ''),
(400, '[Logged In] abcd@gmail.com', '2023-04-04 02:05:16', ''),
(401, '[Logged In] abcd@gmail.com', '2023-04-04 02:20:50', ''),
(402, '[Logged In] abcd@gmail.com', '2023-04-04 02:26:12', ''),
(403, '[Logged Out] abcd', '2023-04-04 02:28:55', ''),
(404, '[Logged In] admin@admin.com', '2023-04-04 02:29:00', ''),
(405, '[Logged Out] admin', '2023-04-04 02:29:55', ''),
(406, '[Logged In] admin@admin.com', '2023-04-04 02:29:59', ''),
(407, '[Logged Out] admin', '2023-04-04 02:30:03', ''),
(408, '[Logged In] abcd@gmail.com', '2023-04-04 02:30:23', ''),
(409, '[Logged Out] abcd', '2023-04-04 02:31:21', ''),
(410, '[Logged In] admin@admin.com', '2023-04-04 05:07:26', ''),
(411, '[Logged Out] admin', '2023-04-04 05:23:53', ''),
(412, '[Logged In] admin@admin.com', '2023-04-04 05:25:52', ''),
(413, '[Logged Out] admin', '2023-04-04 05:27:15', ''),
(414, '[Logged In] admin@admin.com', '2023-04-04 05:29:11', ''),
(415, '[Logged Out] admin', '2023-04-04 05:57:27', ''),
(416, '[Logged In] admin@admin.com', '2023-04-04 23:09:35', ''),
(417, '[Logged Out] admin', '2023-04-04 23:14:50', ''),
(418, '[Logged In] abcd@gmail.com', '2023-04-04 23:14:58', ''),
(419, '[Logged Out] abcd', '2023-04-04 23:16:51', ''),
(420, '[Logged In] abcd@gmail.com', '2023-04-04 23:16:59', ''),
(421, '[Logged Out] abcd', '2023-04-04 23:40:02', ''),
(422, '[Logged In] ajmal@jsoftsolution.com.my', '2023-04-04 23:40:13', ''),
(423, '[Logged Out] ajmal', '2023-04-05 00:47:10', ''),
(424, '[Logged In] admin@admin.com', '2023-04-05 00:47:19', ''),
(425, '[Logged In] admin@admin.com', '2023-04-05 01:18:20', ''),
(426, '[Logged Out] admin', '2023-04-05 02:56:12', ''),
(427, '[Logged In] admin@admin.com', '2023-04-05 02:56:33', ''),
(428, '[Logged Out] admin', '2023-04-05 03:00:37', ''),
(429, '[Logged In] abcd@gmail.com', '2023-04-05 03:01:03', ''),
(430, '[Logged In] admin@admin.com', '2023-04-05 05:12:59', ''),
(431, '[Logged Out] admin', '2023-04-05 05:20:32', ''),
(432, '[Logged In] abcd@gmail.com', '2023-04-05 05:20:45', ''),
(433, '[Employee ClockOut]  ID 3', '2023-04-05 05:20:54', 'abcd'),
(434, '[Employee ClockIn]  ID 3', '2023-04-05 05:20:59', 'abcd'),
(435, '[Employee ClockOut]  ID 3', '2023-04-05 05:21:01', 'abcd'),
(436, '[Logged Out] abcd', '2023-04-05 06:33:07', ''),
(437, '[Logged In] admin@admin.com', '2023-04-05 06:33:11', ''),
(438, '[Logged In] admin@admin.com', '2023-04-05 23:07:24', ''),
(439, '[Logged Out] admin', '2023-04-05 23:09:34', ''),
(440, '[Logged In] admin@admin.com', '2023-04-05 23:12:30', ''),
(441, '[Logged Out] admin', '2023-04-06 00:20:09', ''),
(442, '[Logged In] abcd@gmail.com', '2023-04-06 00:20:48', ''),
(443, '[Logged Out] abcd', '2023-04-06 00:22:44', ''),
(444, '[Logged In] abcd@gmail.com', '2023-04-06 00:22:57', ''),
(445, '[Logged Out] abcd', '2023-04-06 00:24:13', ''),
(446, '[Logged In] abcd@gmail.com', '2023-04-06 00:24:24', ''),
(447, '[Logged Out] abcd', '2023-04-06 00:25:00', ''),
(448, '[Logged In] admin@admin.com', '2023-04-06 00:25:03', ''),
(449, '[Logged Out] admin', '2023-04-06 00:25:55', ''),
(450, '[Logged In] abcd@gmail.com', '2023-04-06 00:26:07', ''),
(451, '[Logged Out] abcd', '2023-04-06 00:28:36', ''),
(452, '[Logged In] admin@admin.com', '2023-04-06 00:28:41', ''),
(453, '[Logged Out] admin', '2023-04-06 00:33:22', ''),
(454, '[Logged In] abcd@gmail.com', '2023-04-06 00:33:50', ''),
(455, '[Employee ClockIn]  ID 3', '2023-04-06 00:36:31', 'abcd'),
(456, '[Employee ClockOut]  ID 3', '2023-04-06 00:36:52', 'abcd'),
(457, '[Employee ClockIn]  ID 3', '2023-04-06 00:37:30', 'abcd'),
(458, '[Logged Out] abcd', '2023-04-06 00:38:36', ''),
(459, '[Logged In] admin@admin.com', '2023-04-06 00:38:40', ''),
(460, '[Logged Out] admin', '2023-04-06 00:39:26', ''),
(461, '[Logged In] abcd@gmail.com', '2023-04-06 00:39:41', ''),
(462, '[Logged In] admin@admin.com', '2023-04-06 04:41:38', ''),
(463, '[Logged In] admin@admin.com', '2023-04-06 06:45:37', ''),
(464, '[Logged In] admin@admin.com', '2023-04-07 04:37:13', ''),
(465, '[Logged In] admin@admin.com', '2023-04-10 01:40:16', ''),
(466, '[Logged In] admin@admin.com', '2023-04-10 05:11:43', ''),
(467, '[Logged In] admin@admin.com', '2023-04-10 23:25:24', ''),
(468, '[Logged In] admin@admin.com', '2023-04-11 01:37:49', ''),
(469, '[Logged In] admin@admin.com', '2023-04-11 03:22:39', ''),
(470, '[Logged In] admin@admin.com', '2023-04-11 03:35:54', ''),
(471, '[Logged In] admin@admin.com', '2023-04-11 22:27:45', ''),
(472, '[Logged In] admin@admin.com', '2023-04-12 00:44:45', ''),
(473, '[Logged In] admin@admin.com', '2023-04-12 03:31:33', ''),
(474, '[Logged In] admin@admin.com', '2023-04-12 05:36:34', ''),
(475, '[Logged In] admin@admin.com', '2023-04-12 21:52:57', ''),
(476, '[Logged In] admin@admin.com', '2023-04-12 23:52:59', ''),
(477, '[Logged In] admin@admin.com', '2023-04-13 01:53:03', ''),
(478, '[Logged Out] admin', '2023-04-13 02:28:00', ''),
(479, '[Logged In] abcd@gmail.com', '2023-04-13 02:28:15', ''),
(480, '[Logged Out] abcd', '2023-04-13 02:28:56', ''),
(481, '[Logged In] admin@admin.com', '2023-04-13 02:29:07', ''),
(482, '[Logged In] admin@admin.com', '2023-04-13 04:16:31', ''),
(483, '[Logged Out] admin', '2023-04-13 06:10:27', ''),
(484, '[Logged In] admin@admin.com', '2023-04-13 06:10:42', ''),
(485, '[Logged Out] admin', '2023-04-13 06:10:59', ''),
(486, '[Logged In] abcd@gmail.com', '2023-04-13 06:11:12', ''),
(487, '[Logged Out] abcd', '2023-04-13 06:14:19', ''),
(488, '[Logged In] admin@admin.com', '2023-04-13 06:14:30', ''),
(489, '[Logged In] admin@admin.com', '2023-04-13 06:16:38', ''),
(490, '[Logged Out] admin', '2023-04-13 06:42:41', ''),
(491, '[Logged In] admin@admin.com', '2023-04-13 17:52:58', ''),
(492, '[Logged In] admin@admin.com', '2023-04-13 19:36:27', ''),
(493, '[Logged Out] admin', '2023-04-13 19:42:34', ''),
(494, '[Logged In] admin@admin.com', '2023-04-13 23:22:04', ''),
(495, '[Client Added] testing ID 11', '2023-04-14 00:22:22', 'admin'),
(496, '[Client Added] testing1 ID 12', '2023-04-14 00:30:23', 'admin'),
(497, '[Logged In] admin@admin.com', '2023-04-14 03:34:17', ''),
(498, '[Logged In] admin@admin.com', '2023-04-14 03:54:16', ''),
(499, '[Logged In] admin@admin.com', '2023-04-14 05:53:56', ''),
(500, '[Logged In] admin@admin.com', '2023-04-17 04:26:32', ''),
(501, '[Jobsheets Doc Added]  DocId title ComplaintId 60', '2023-04-17 06:13:09', 'admin'),
(502, '[Jobsheets Added]  TaskId 60', '2023-04-17 06:13:09', 'admin'),
(503, '[Logged In] admin@admin.com', '2023-04-17 06:31:24', ''),
(504, '[Logged In] admin@admin.com', '2023-04-17 23:20:03', ''),
(505, '[Logged In] admin@admin.com', '2023-04-18 01:32:32', ''),
(506, '[Logged In] admin@admin.com', '2023-04-18 03:43:00', ''),
(507, '[Jobsheets Doc Added]  DocId test sytem ComplaintId 61', '2023-04-18 05:04:00', 'admin'),
(508, '[Jobsheets Added]  TaskId 61', '2023-04-18 05:04:00', 'admin'),
(509, '[Logged Out] admin', '2023-04-18 05:06:09', ''),
(510, '[Logged In] abcd@gmail.com', '2023-04-18 05:06:20', ''),
(511, '[Logged Out] abcd', '2023-04-18 05:10:04', ''),
(512, '[Logged In] admin@admin.com', '2023-04-18 05:10:09', ''),
(513, '[Logged In] admin@admin.com', '2023-04-18 05:43:53', ''),
(514, '[Logged In] admin@admin.com', '2023-04-19 00:20:05', ''),
(515, '[Logged In] admin@admin.com', '2023-04-19 03:12:04', ''),
(516, '[Logged In] admin@admin.com', '2023-04-19 05:07:54', ''),
(517, '[Logged In] admin@admin.com', '2023-04-19 23:55:52', ''),
(518, '[Logged In] admin@admin.com', '2023-04-20 02:06:07', ''),
(519, '[Jobsheets Doc Added]  DocId test ComplaintId 62', '2023-04-20 02:35:09', 'admin'),
(520, '[Jobsheets Added]  TaskId 62', '2023-04-20 02:35:09', 'admin'),
(521, '[Jobsheets Doc Added]  DocId test ComplaintId 63', '2023-04-20 02:36:50', 'admin'),
(522, '[Jobsheets Added]  TaskId 63', '2023-04-20 02:36:50', 'admin'),
(523, '[Logged In] admin@admin.com', '2023-04-24 23:35:18', ''),
(524, '[Logged Out] admin', '2023-04-24 23:35:49', ''),
(525, '[Logged In] abcd@gmail.com', '2023-04-24 23:35:58', ''),
(526, '[Logged Out] abcd', '2023-04-24 23:36:31', ''),
(527, '[Logged In] abcd@gmail.com', '2023-04-24 23:36:49', ''),
(528, '[Logged In] abcd@gmail.com', '2023-04-25 11:38:28', ''),
(529, '[Employee ClockOut]  ID 3', '2023-04-25 11:38:47', 'abcd'),
(530, '[Logged Out] abcd', '2023-04-24 23:40:04', ''),
(531, '[Logged In] admin@admin.com', '2023-04-25 00:14:28', ''),
(532, '[Logged Out] admin', '2023-04-25 01:09:57', ''),
(533, '[Logged In] myname@gmail.com', '2023-04-25 01:10:14', ''),
(534, '[Employee ClockIn]  ID 4', '2023-04-25 01:11:38', 'myname'),
(535, '[Logged In] admin@admin.com', '2023-04-25 23:46:08', ''),
(536, '[Employee ClockIn]  ID 6', '2023-04-25 23:46:16', 'admin'),
(537, '[Logged In] admin@admin.com', '2023-04-26 00:59:23', ''),
(538, '[Logged In] admin@admin.com', '2023-04-26 06:09:19', ''),
(539, '[Logged Out] admin', '2023-04-26 06:34:26', ''),
(540, '[Logged In] abcd@gmail.com', '2023-04-26 06:34:38', ''),
(541, '[Employee ClockIn]  ID 3', '2023-04-26 06:34:45', 'abcd'),
(542, '[Employee ClockOut]  ID 3', '2023-04-26 06:34:58', 'abcd'),
(543, '[Employee ClockIn]  ID 3', '2023-04-26 06:35:11', 'abcd'),
(544, '[Employee ClockOut]  ID 3', '2023-04-26 06:35:43', 'abcd'),
(545, '[Employee ClockIn]  ID 3', '2023-04-26 06:38:02', 'abcd'),
(546, '[Employee ClockOut]  ID 3', '2023-04-26 06:38:06', 'abcd'),
(547, '[Employee ClockIn]  ID 3', '2023-04-26 06:38:42', 'abcd'),
(548, '[Employee ClockOut]  ID 3', '2023-04-26 06:38:44', 'abcd'),
(549, '[Employee ClockIn]  ID 3', '2023-04-26 06:46:27', 'abcd'),
(550, '[Employee ClockOut]  ID 3', '2023-04-26 06:46:30', 'abcd'),
(551, '[Logged In] admin@admin.com', '2023-04-26 08:15:58', ''),
(552, '[Employee ClockIn]  ID 6', '2023-04-26 08:16:16', 'admin'),
(553, '[Employee ClockIn]  ID 6', '2023-04-26 08:16:18', 'admin'),
(554, '[Employee ClockIn]  ID 6', '2023-04-26 08:19:33', 'admin'),
(555, '[Employee ClockIn]  ID 6', '2023-04-26 08:19:37', 'admin'),
(556, '[Logged Out] admin', '2023-04-26 08:21:43', ''),
(557, '[Logged In] abcd@gmail.com', '2023-04-26 08:21:58', ''),
(558, '[Employee ClockIn]  ID 3', '2023-04-26 08:22:13', 'abcd'),
(559, '[Logged In] abcd@gmail.com', '2023-04-27 22:27:22', ''),
(560, '[Employee ClockOut]  ID 3', '2023-04-27 22:28:00', 'abcd'),
(561, '[Employee ClockIn]  ID 3', '2023-04-27 22:29:44', 'abcd'),
(562, '[Employee ClockOut]  ID 3', '2023-04-28 07:30:45', 'abcd'),
(563, '[Logged In] admin@admin.com', '2023-04-27 22:33:19', ''),
(564, '[Logged Out] admin', '2023-04-27 22:53:19', ''),
(565, '[Logged In] abcd@gmail.com', '2023-04-27 22:53:35', ''),
(566, '[Employee ClockIn]  ID 3', '2023-04-27 22:55:20', 'abcd'),
(567, '[Employee ClockOut]  ID 3', '2023-04-27 22:56:51', 'abcd'),
(568, '[Employee ClockIn]  ID 3', '2023-04-27 22:57:28', 'abcd'),
(569, '[Logged In] abcd@gmail.com', '2023-04-27 22:58:20', ''),
(570, '[Employee ClockOut]  ID 3', '2023-04-27 22:58:32', 'abcd'),
(571, '[Employee ClockIn]  ID 3', '2023-04-27 23:06:33', 'abcd'),
(572, '[Employee ClockOut]  ID 3', '2023-04-28 08:07:01', 'abcd'),
(573, '[Employee ClockIn]  ID 3', '2023-04-27 23:12:40', 'abcd'),
(574, '[Employee ClockOut]  ID 3', '2023-04-28 08:12:57', 'abcd'),
(575, '[Employee ClockIn]  ID 3', '2023-04-28 08:13:59', 'abcd'),
(576, '[Employee ClockOut]  ID 3', '2023-04-28 08:36:39', 'abcd'),
(577, '[Logged Out] abcd', '2023-04-28 08:45:28', ''),
(578, '[Logged In] admin@admin.com', '2023-04-28 08:45:31', ''),
(579, '[Logged Out] admin', '2023-04-28 08:57:42', ''),
(580, '[Logged In] admin@admin.com', '2023-04-28 08:57:46', ''),
(581, '[Logged In] admin@admin.com', '2023-04-30 02:51:05', ''),
(582, '[Logged In] admin@admin.com', '2023-04-30 05:49:12', ''),
(583, '[Employee ClockIn]  ID 6', '2023-04-30 06:07:05', 'admin'),
(584, '[Logged In] admin@admin.com', '2023-04-30 22:15:49', ''),
(585, '[Logged Out] admin', '2023-04-30 22:33:08', ''),
(586, '[Logged In] admin@admin.com', '2023-04-30 22:33:11', ''),
(587, '[Employee ClockIn]  ID 6', '2023-04-30 22:34:32', 'admin'),
(588, '[Employee Short Break Start]  ID 6', '2023-04-30 23:08:37', 'admin'),
(589, '[Employee Short Break Start]  ID 6', '2023-04-30 23:14:46', 'admin'),
(590, '[Employee Short Break Start]  ID 6', '2023-04-30 23:14:47', 'admin'),
(591, '[Employee Short Break Start]  ID 6', '2023-04-30 23:16:53', 'admin'),
(592, '[Employee Short Break Start]  ID 6', '2023-04-30 23:16:55', 'admin'),
(593, '[Employee Short Break Start]  ID 6', '2023-04-30 23:17:19', 'admin'),
(594, '[Employee  End]  ID 6', '2023-04-30 23:27:21', 'admin'),
(595, '[Employee  End]  ID 6', '2023-04-30 23:29:04', 'admin'),
(596, '[Employee  End]  ID 6', '2023-04-30 23:29:36', 'admin'),
(597, '[Employee  End]  ID 6', '2023-04-30 23:29:57', 'admin'),
(598, '[Employee  End]  ID 6', '2023-04-30 23:31:38', 'admin'),
(599, '[Employee Short Break End]  ID 6', '2023-04-30 23:31:57', 'admin'),
(600, '[Employee Short Break End]  ID 6', '2023-04-30 23:40:05', 'admin'),
(601, '[Employee Short Break End]  ID 6', '2023-05-01 00:00:23', 'admin'),
(602, '[Logged Out] admin', '2023-05-01 00:12:37', ''),
(603, '[Logged In] abcd@gmail.com', '2023-05-01 00:13:00', ''),
(604, '[Employee ClockIn]  ID 3', '2023-05-01 00:13:08', 'abcd'),
(605, '[Employee ClockOut]  ID 3', '2023-05-01 12:14:59', 'abcd'),
(606, '[Logged In] admin@admin.com', '2023-05-01 12:15:42', ''),
(607, '[Employee ClockIn]  ID 6', '2023-05-01 12:19:53', 'admin'),
(608, '[Logged Out] admin', '2023-05-01 12:19:59', ''),
(609, '[Logged In] admin@admin.com', '2023-05-01 12:20:05', ''),
(610, '[Logged Out] admin', '2023-05-01 00:23:18', ''),
(611, '[Logged In] abcd@gmail.com', '2023-05-01 00:23:32', ''),
(612, '[Employee ClockIn]  ID 3', '2023-05-01 00:25:23', 'abcd'),
(613, '[Employee ClockOut]  ID 3', '2023-05-01 00:25:35', 'abcd'),
(614, '[Employee ClockIn]  ID 3', '2023-05-01 01:33:42', 'abcd'),
(615, '[Employee ClockOut]  ID 3', '2023-05-01 01:33:46', 'abcd'),
(616, '[Employee ClockIn]  ID 3', '2023-05-01 01:34:36', 'abcd'),
(617, '[Employee ClockOut]  ID 3', '2023-05-01 01:36:32', 'abcd'),
(618, '[Employee ClockIn]  ID 3', '2023-05-01 01:40:52', 'abcd'),
(619, '[Employee ClockOut]  ID 3', '2023-05-01 01:43:59', 'abcd'),
(620, '[Logged Out] abcd', '2023-05-01 01:44:30', ''),
(621, '[Logged In] admin@admin.com', '2023-05-01 01:44:34', ''),
(622, '[Employee Short Break Start]  ID 6', '2023-05-01 01:46:56', 'admin'),
(623, '[Employee Short Break End]  ID 6', '2023-05-01 02:00:48', 'admin'),
(624, '[Employee ClockIn]  ID 6', '2023-05-01 02:01:57', 'admin'),
(625, '[Logged Out] admin', '2023-05-01 02:02:02', ''),
(626, '[Logged In] abcd@gmail.com', '2023-05-01 02:02:17', ''),
(627, '[Employee ClockIn]  ID 3', '2023-05-01 02:02:22', 'abcd'),
(628, '[Employee Lunch Break Start]  ID 3', '2023-05-01 02:02:31', 'abcd'),
(629, '[Logged Out] abcd', '2023-05-01 02:02:54', ''),
(630, '[Logged In] admin@admin.com', '2023-05-01 02:02:59', ''),
(631, '[Logged Out] admin', '2023-05-01 02:03:36', ''),
(632, '[Logged In] abcd@gmail.com', '2023-05-01 02:03:52', ''),
(633, '[Employee Lunch Break End]  ID 3', '2023-05-01 02:04:00', 'abcd'),
(634, '[Employee Lunch Break Start]  ID 3', '2023-05-01 03:06:43', 'abcd'),
(635, '[Logged Out] abcd', '2023-05-01 03:07:33', ''),
(636, '[Logged In] admin@admin.com', '2023-05-01 03:07:42', ''),
(637, '[Logged Out] admin', '2023-05-01 05:41:34', ''),
(638, '[Logged In] abcd@gmail.com', '2023-05-01 05:44:06', ''),
(639, '[Employee Lunch Break End]  ID 3', '2023-05-01 05:44:16', 'abcd'),
(640, '[Employee ClockOut]  ID 3', '2023-05-01 05:44:21', 'abcd'),
(641, '[Logged Out] abcd', '2023-05-01 05:44:27', ''),
(642, '[Logged In] admin@admin.com', '2023-05-01 05:44:30', ''),
(643, '[Logged In] admin@admin.com', '2023-05-01 23:03:35', ''),
(644, '[Logged Out] admin', '2023-05-01 23:03:43', ''),
(645, '[Logged In] abcd@gmail.com', '2023-05-01 23:04:49', ''),
(646, '[Employee ClockIn]  ID 3', '2023-05-01 23:05:55', 'abcd'),
(647, '[Employee Short Break Start]  ID 3', '2023-05-01 23:07:12', 'abcd'),
(648, '[Employee Short Break End]  ID 3', '2023-05-01 23:11:29', 'abcd'),
(649, '[Employee ClockOut]  ID 3', '2023-05-01 23:12:36', 'abcd'),
(650, '[Employee ClockIn]  ID 3', '2023-05-01 23:22:06', 'abcd'),
(651, '[Employee Lunch Break Start]  ID 3', '2023-05-01 23:30:13', 'abcd'),
(652, '[Logged In] admin@admin.com', '2023-05-02 01:16:15', ''),
(653, '[Logged Out] admin', '2023-05-02 01:20:05', ''),
(654, '[Logged In] myname@gmail.com', '2023-05-02 01:20:16', ''),
(655, '[Employee Lunch Break Start]  ID 4', '2023-05-02 01:20:30', 'myname'),
(656, '[Logged Out] myname', '2023-05-02 01:20:40', ''),
(657, '[Logged In] admin@admin.com', '2023-05-02 01:20:43', ''),
(658, '[Logged Out] admin', '2023-05-02 01:21:25', ''),
(659, '[Logged In] myname@gmail.com', '2023-05-02 01:21:35', ''),
(660, '[Logged In] admin@admin.com', '2023-05-02 01:25:53', ''),
(661, '[Logged Out] myname', '2023-05-02 01:27:49', ''),
(662, '[Logged In] myname@gmail.com', '2023-05-02 01:28:04', ''),
(663, '[Employee ClockIn]  ID 4', '2023-05-02 01:28:12', 'myname'),
(664, '[Employee Lunch Break End]  ID 4', '2023-05-02 01:28:27', 'myname'),
(665, '[Employee Short Break Start]  ID 4', '2023-05-02 01:29:37', 'myname'),
(666, '[Employee Short Break End]  ID 4', '2023-05-02 01:30:03', 'myname'),
(667, '[Employee Away Start]  ID 4', '2023-05-02 01:30:06', 'myname'),
(668, '[Employee Away End]  ID 4', '2023-05-02 02:25:03', 'myname'),
(669, '[Employee Away Start]  ID 4', '2023-05-02 02:25:12', 'myname'),
(670, '[Employee Away End]  ID 4', '2023-05-02 02:47:21', 'myname'),
(671, '[Employee ClockOut]  ID 4', '2023-05-02 02:47:35', 'myname'),
(672, '[Logged Out] ', '2023-05-02 05:42:07', ''),
(673, '[Logged In] admin@admin.com', '2023-05-02 05:42:11', ''),
(674, '[Logged In] admin@admin.com', '2023-05-02 14:11:57', ''),
(675, '[Employee ClockIn]  ID 6', '2023-05-02 16:02:22', 'admin'),
(676, '[Logged In] admin@admin.com', '2023-05-02 16:19:39', ''),
(677, '[Logged In] admin@admin.com', '2023-05-02 18:20:14', ''),
(678, '[Logged In] admin@admin.com', '2023-05-02 22:03:44', ''),
(679, '[Logged In] admin@admin.com', '2023-05-02 22:43:09', ''),
(680, '[Logged Out] admin', '2023-05-02 22:45:51', ''),
(681, '[Logged In] myname@gmail.com', '2023-05-02 22:46:08', ''),
(682, '[Employee ClockIn]  ID 4', '2023-05-02 22:46:25', 'myname'),
(683, '[Logged Out] myname', '2023-05-02 22:46:38', ''),
(684, '[Logged In] admin@admin.com', '2023-05-02 22:46:41', ''),
(685, '[Logged Out] admin', '2023-05-02 22:47:20', ''),
(686, '[Logged In] abcd@gmail.com', '2023-05-02 22:47:42', ''),
(687, '[Employee ClockOut]  ID 3', '2023-05-02 22:47:56', 'abcd'),
(688, '[Employee ClockIn]  ID 3', '2023-05-02 22:49:35', 'abcd'),
(689, '[Employee Away Start]  ID 3', '2023-05-02 22:49:58', 'abcd'),
(690, '[Logged Out] abcd', '2023-05-02 22:50:02', ''),
(691, '[Logged In] abcd@gmail.com', '2023-05-02 22:50:59', ''),
(692, '[Logged Out] abcd', '2023-05-02 22:51:12', ''),
(693, '[Logged In] myname@gmail.com', '2023-05-02 22:51:33', ''),
(694, '[Employee Short Break Start]  ID 4', '2023-05-02 22:51:45', 'myname'),
(695, '[Logged Out] myname', '2023-05-02 22:51:49', ''),
(696, '[Logged In] admin@admin.com', '2023-05-02 22:51:53', ''),
(697, '[Logged Out] admin', '2023-05-02 22:57:27', ''),
(698, '[Logged In] abcd@gmail.com', '2023-05-02 22:57:49', ''),
(699, '[Employee Away End]  ID 3', '2023-05-02 22:58:27', 'abcd'),
(700, '[Employee ClockOut]  ID 3', '2023-05-02 23:11:23', 'abcd'),
(701, '[Logged Out] abcd', '2023-05-02 23:11:39', ''),
(702, '[Logged In] myname@gmail.com', '2023-05-02 23:12:06', ''),
(703, '[Employee Short Break End]  ID 4', '2023-05-02 23:12:18', 'myname'),
(704, '[Employee ClockOut]  ID 4', '2023-05-02 23:12:22', 'myname'),
(705, '[Logged In] admin@admin.com', '2023-05-03 02:37:30', ''),
(706, '[Logged In] admin@admin.com', '2023-05-03 05:30:03', ''),
(707, '[Logged Out] admin', '2023-05-03 05:31:10', ''),
(708, '[Logged In] abcd@gmail.com', '2023-05-03 05:31:39', ''),
(709, '[Employee ClockIn]  ID 3', '2023-05-03 05:31:52', 'abcd'),
(710, '[Employee Short Break Start]  ID 3', '2023-05-03 05:38:53', 'abcd'),
(711, '[Logged In] admin@admin.com', '2023-05-03 21:01:34', ''),
(712, '[Logged In] admin@admin.com', '2023-05-03 23:02:54', ''),
(713, '[Logged Out] admin', '2023-05-04 00:06:38', ''),
(714, '[Logged In] admin@admin.com', '2023-05-04 00:06:47', ''),
(715, '[Logged In] admin@admin.com', '2023-05-04 01:05:04', ''),
(716, '[Logged In] admin@admin.com', '2023-05-04 03:43:38', ''),
(717, '[Logged Out] admin', '2023-05-04 04:32:14', ''),
(718, '[Logged In] abcd@gmail.com', '2023-05-04 04:32:38', ''),
(719, '[Employee ClockOut]  ID 3', '2023-05-04 04:43:06', 'abcd'),
(720, '[Logged Out] abcd', '2023-05-04 04:45:02', ''),
(721, '[Logged In] admin@admin.com', '2023-05-04 04:45:05', ''),
(722, '[Logged In] admin@admin.com', '2023-05-04 06:27:09', ''),
(723, '[Logged In] admin@admin.com', '2023-05-04 13:57:21', ''),
(724, '[Logged Out] admin', '2023-05-04 13:58:26', ''),
(725, '[Logged In] admin@admin.com', '2023-05-04 14:03:34', ''),
(726, '[Logged In] abcd@gmail.com', '2023-05-04 14:08:12', ''),
(727, '[Employee ClockIn]  ID 3', '2023-05-04 14:08:28', 'abcd'),
(728, '[Employee Away Start]  ID 3', '2023-05-04 14:26:49', 'abcd'),
(729, '[Employee Away End]  ID 3', '2023-05-04 14:27:25', 'abcd'),
(730, '[Employee Lunch Break Start]  ID 3', '2023-05-04 14:29:36', 'abcd'),
(731, '[Employee Lunch Break End]  ID 3', '2023-05-04 14:30:26', 'abcd'),
(732, '[Employee Away Start]  ID 3', '2023-05-04 14:45:11', 'abcd'),
(733, '[Employee Away End]  ID 3', '2023-05-04 14:45:15', 'abcd'),
(734, '[Employee Lunch Break Start]  ID 3', '2023-05-04 14:48:45', 'abcd'),
(735, '[Employee Lunch Break End]  ID 3', '2023-05-04 15:05:30', 'abcd'),
(736, '[Employee ClockOut]  ID 3', '2023-05-04 15:25:44', 'abcd'),
(737, '[Logged Out] abcd', '2023-05-04 15:29:53', ''),
(738, '[Logged In] abcd@gmail.com', '2023-05-04 15:30:04', ''),
(739, '[Jobsheets Added]  TaskId 64', '2023-05-04 15:30:47', 'admin'),
(740, '[Jobsheets Added]  TaskId 65', '2023-05-04 15:33:41', 'admin'),
(741, '[Jobsheets Added]  TaskId 66', '2023-05-04 15:39:43', 'admin'),
(742, '[Jobsheets Added]  TaskId 67', '2023-05-04 15:40:11', 'admin'),
(743, '[Jobsheets Added]  TaskId 68', '2023-05-04 15:40:52', 'admin'),
(744, '[Logged In] admin@admin.com', '2023-05-04 15:59:25', ''),
(745, '[Logged Out] abcd', '2023-05-04 16:02:35', ''),
(746, '[Logged In] admin@admin.com', '2023-05-05 10:22:36', ''),
(747, '[Logged Out] admin', '2023-05-05 10:24:46', ''),
(748, '[Logged In] admin@admin.com', '2023-05-05 10:25:23', ''),
(749, '[Logged Out] admin', '2023-05-05 10:27:40', ''),
(750, '[Logged In] hariinraj29@yahoo.com', '2023-05-05 10:27:48', ''),
(751, '[Logged Out] hariinraj29', '2023-05-05 10:28:20', ''),
(752, '[Logged In] admin@admin.com', '2023-05-05 10:28:27', ''),
(753, '[Client Added] Testing2 ID 13', '2023-05-05 10:32:54', 'admin'),
(754, '[Jobsheets Added]  TaskId 69', '2023-05-05 10:44:01', 'admin'),
(755, '[Logged Out] admin', '2023-05-05 10:44:41', ''),
(756, '[Logged In] testingjsoft@gmail.com', '2023-05-05 10:44:50', ''),
(757, '[Logged Out] Prabhat', '2023-05-05 10:45:00', ''),
(758, '[Logged In] admin@admin.com', '2023-05-05 10:45:05', ''),
(759, '[Jobsheets Added]  TaskId 70', '2023-05-05 10:46:40', 'admin'),
(760, '[Logged Out] admin', '2023-05-05 10:47:01', ''),
(761, '[Logged In] hariinraj29@yahoo.com', '2023-05-05 10:47:07', ''),
(762, '[Logged Out] hariinraj29', '2023-05-05 10:47:37', ''),
(763, '[Logged In] admin@admin.com', '2023-05-05 10:47:41', ''),
(764, '[Logged Out] admin', '2023-05-05 10:51:31', ''),
(765, '[Logged In] hariinraj29@yahoo.com', '2023-05-05 10:51:38', ''),
(766, '[Logged Out] hariinraj29', '2023-05-05 10:54:26', ''),
(767, '[Logged In] hariinraj29@yahoo.com', '2023-05-05 10:54:43', ''),
(768, '[Logged Out] hariinraj29', '2023-05-05 10:57:26', ''),
(769, '[Logged In] abcd@gmail.com', '2023-05-05 10:57:33', ''),
(770, '[Employee ClockIn]  ID 3', '2023-05-05 10:57:43', 'abcd'),
(771, '[Employee Lunch Break Start]  ID 3', '2023-05-05 10:57:57', 'abcd'),
(772, '[Employee Lunch Break End]  ID 3', '2023-05-05 10:58:07', 'abcd'),
(773, '[Employee Away Start]  ID 3', '2023-05-05 10:58:12', 'abcd'),
(774, '[Employee Away End]  ID 3', '2023-05-05 10:58:16', 'abcd'),
(775, '[Employee Short Break Start]  ID 3', '2023-05-05 10:58:25', 'abcd'),
(776, '[Employee Short Break End]  ID 3', '2023-05-05 10:58:29', 'abcd'),
(777, '[Logged Out] abcd', '2023-05-05 11:01:24', ''),
(778, '[Logged In] admin@admin.com', '2023-05-05 11:01:31', ''),
(779, '[Logged Out] admin', '2023-05-05 11:02:33', ''),
(780, '[Logged In] abcd@gmail.com', '2023-05-05 11:02:43', ''),
(781, '[Logged In] admin@admin.com', '2023-05-07 10:09:38', ''),
(782, '[Employee ClockIn]  ID 6', '2023-05-07 10:25:16', 'admin'),
(783, '[Logged In] admin@admin.com', '2023-05-08 04:15:40', ''),
(784, '[Logged Out] admin', '2023-05-08 04:19:04', '');
INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(785, '[Logged In] admin@admin.com', '2023-05-08 07:34:48', ''),
(786, '[Logged In] admin@admin.com', '2023-05-08 12:24:03', ''),
(787, '[Logged In] admin@admin.com', '2023-05-08 12:59:36', ''),
(788, '[Logged In] admin@admin.com', '2023-05-08 13:21:02', ''),
(789, '[Logged In] admin@admin.com', '2023-05-08 13:41:32', ''),
(790, '[Logged In] admin@admin.com', '2023-05-08 13:41:40', ''),
(791, '[Logged In] admin@admin.com', '2023-05-08 13:43:27', ''),
(792, '[Logged In] admin@admin.com', '2023-05-08 13:43:34', ''),
(793, '[Logged In] admin@admin.com', '2023-05-08 13:44:24', ''),
(794, '[Logged In] admin@admin.com', '2023-05-08 22:40:40', ''),
(795, '[Logged In] admin@admin.com', '2023-05-09 01:48:13', ''),
(796, '[Logged In] admin@admin.com', '2023-05-09 01:52:26', ''),
(797, '[Logged In] admin@admin.com', '2023-05-09 01:52:32', ''),
(798, '[Logged In] admin@admin.com', '2023-05-09 01:52:54', ''),
(799, '[Logged In] admin@admin.com', '2023-05-09 01:57:20', ''),
(800, '[Logged In] admin@admin.com', '2023-05-09 02:00:25', ''),
(801, '[Client Added] udhayaraja ID 14', '2023-05-09 02:08:40', 'admin'),
(802, '[Logged Out] admin', '2023-05-09 02:23:36', ''),
(803, '[Logged In] admin@admin.com', '2023-05-09 02:23:41', ''),
(804, '[Logged In] admin@admin.com', '2023-05-09 05:01:12', ''),
(805, '[Logged In] admin@admin.com', '2023-05-09 05:16:30', ''),
(806, '[Logged In] admin@admin.com', '2023-05-09 05:16:36', ''),
(807, '[Logged In] admin@admin.com', '2023-05-09 05:16:50', ''),
(808, '[Logged In] admin@admin.com', '2023-05-09 05:17:17', ''),
(809, '[Logged In] admin@admin.com', '2023-05-09 05:21:29', ''),
(810, '[Logged In] admin@admin.com', '2023-05-09 06:10:51', ''),
(811, '[Logged In] admin@admin.com', '2023-05-09 08:33:10', ''),
(812, '[Logged In] admin@admin.com', '2023-05-09 14:07:48', ''),
(813, '[Logged In] admin@admin.com', '2023-05-09 22:20:57', ''),
(814, '[Logged In] admin@admin.com', '2023-05-10 01:37:30', ''),
(815, '[Logged In] admin@admin.com', '2023-05-10 02:04:42', ''),
(816, '[Logged In] admin@admin.com', '2023-05-10 02:12:18', ''),
(817, '[Logged In] admin@admin.com', '2023-05-10 03:22:31', ''),
(818, '[Logged In] admin@admin.com', '2023-05-11 02:57:01', ''),
(819, '[Logged In] admin@admin.com', '2023-05-11 03:15:41', ''),
(820, '[Jobsheets Added]  TaskId 71', '2023-05-11 03:35:03', 'admin'),
(821, '[Logged Out] admin', '2023-05-11 03:35:29', ''),
(822, '[Logged In] admin@admin.com', '2023-05-11 03:35:36', ''),
(823, '[Logged Out] admin', '2023-05-11 03:35:59', ''),
(824, '[Logged In] testingjsoft@gmail.com', '2023-05-11 03:36:04', ''),
(825, '[Logged Out] Prabhat', '2023-05-11 03:38:37', ''),
(826, '[Logged In] admin@admin.com', '2023-05-11 03:38:45', ''),
(827, '[Logged In] testingjsoft@gmail.com', '2023-05-11 03:49:51', ''),
(828, '[Logged In] testingjsoft@gmail.com', '2023-05-11 03:50:28', ''),
(829, '[Jobsheets Added]  TaskId 72', '2023-05-11 04:03:29', 'admin'),
(830, '[Employee ClockIn]  ID 11', '2023-05-11 04:09:15', 'Prabhat'),
(831, '[Employee ClockOut]  ID 11', '2023-05-11 04:10:37', 'Prabhat'),
(832, '[Logged Out] Prabhat', '2023-05-11 04:12:19', ''),
(833, '[Logged In] reena@yahoo.com', '2023-05-11 04:12:30', ''),
(834, '[Employee ClockIn]  ID 12', '2023-05-11 04:12:33', 'Treena'),
(835, '[Employee Short Break Start]  ID 12', '2023-05-11 04:13:06', 'Treena'),
(836, '[Employee Short Break End]  ID 12', '2023-05-11 04:13:12', 'Treena'),
(837, '[Employee Lunch Break Start]  ID 12', '2023-05-11 04:13:17', 'Treena'),
(838, '[Employee Lunch Break End]  ID 12', '2023-05-11 04:13:21', 'Treena'),
(839, '[Employee Away Start]  ID 12', '2023-05-11 04:13:27', 'Treena'),
(840, '[Logged In] admin@admin.com', '2023-05-11 06:38:48', ''),
(841, '[Logged In] admin@admin.com', '2023-05-11 06:48:49', ''),
(842, '[Logged In] testingjsoft@gmail.com', '2023-05-11 07:04:18', ''),
(843, '[Logged Out] Prabhat', '2023-05-11 07:04:25', ''),
(844, '[Logged In] reena@yahoo.com', '2023-05-11 07:04:32', ''),
(845, '[Employee ClockOut]  ID 12', '2023-05-11 07:06:12', 'Treena'),
(846, '[Employee ClockIn]  ID 12', '2023-05-11 07:07:58', 'Treena'),
(847, '[Employee ClockOut]  ID 12', '2023-05-11 07:09:57', 'Treena'),
(848, '[Logged Out] Treena', '2023-05-11 07:10:04', ''),
(849, '[Logged In] testingjsoft@gmail.com', '2023-05-11 07:10:16', ''),
(850, '[Logged Out] Prabhat', '2023-05-11 07:11:12', ''),
(851, '[Logged In] reena@yahoo.com', '2023-05-11 07:11:25', ''),
(852, '[Employee ClockIn]  ID 12', '2023-05-11 07:13:23', 'Treena'),
(853, '[Employee Away End]  ID 12', '2023-05-11 07:13:56', 'Treena'),
(854, '[Logged Out] Treena', '2023-05-11 07:20:32', ''),
(855, '[Logged In] testingjsoft@gmail.com', '2023-05-11 07:22:55', ''),
(856, '[Employee ClockIn]  ID 11', '2023-05-11 07:23:00', 'Prabhat'),
(857, '[Employee ClockOut]  ID 11', '2023-05-11 07:23:04', 'Prabhat'),
(858, '[Logged Out] Prabhat', '2023-05-11 07:23:08', ''),
(859, '[Logged In] reena@yahoo.com', '2023-05-11 07:23:19', ''),
(860, '[Employee ClockOut]  ID 12', '2023-05-11 07:23:22', 'Treena'),
(861, '[Logged In] admin@admin.com', '2023-05-11 08:54:03', ''),
(862, '[Logged In] reena@yahoo.com', '2023-05-11 09:06:21', ''),
(863, '[Employee ClockIn]  ID 12', '2023-05-11 10:48:39', 'Treena'),
(864, '[Logged Out] Treena', '2023-05-11 10:49:07', ''),
(865, '[Logged In] reena@yahoo.com', '2023-05-12 04:30:56', ''),
(866, '[Logged In] admin@admin.com', '2023-05-12 23:15:02', ''),
(867, '[Payment Invoice 24]  Transaction-21 - 5 ', '2023-05-12 23:22:28', 'Shafeek Ajmal'),
(868, '[Logged In] admin@admin.com', '2023-05-13 08:05:27', ''),
(869, '[Logged In] admin@admin.com', '2023-05-13 09:10:36', ''),
(870, '[Logged In] admin@admin.com', '2023-05-15 02:02:59', ''),
(871, '[Logged In] admin@admin.com', '2023-05-15 02:25:12', ''),
(872, '[Logged In] admin@admin.com', '2023-05-15 03:45:17', ''),
(873, '[Logged In] admin@admin.com', '2023-05-15 07:03:17', ''),
(874, '[Employee ClockIn]  ID 6', '2023-05-15 07:03:44', 'admin'),
(875, '[Employee ClockIn]  ID 6', '2023-05-15 07:13:53', 'admin'),
(876, '[Employee ClockIn]  ID 6', '2023-05-15 07:14:39', 'admin'),
(877, '[Employee ClockIn]  ID 6', '2023-05-15 07:14:45', 'admin'),
(878, '[Logged Out] ', '2023-05-15 07:38:52', ''),
(879, '[Logged In] admin@admin.com', '2023-05-15 09:58:08', ''),
(880, '[Logged Out] admin', '2023-05-15 10:02:30', ''),
(881, '[Logged In] admin@admin.com', '2023-05-15 11:35:37', ''),
(882, '[Logged Out] admin', '2023-05-15 11:37:06', ''),
(883, '[Logged In] admin@admin.com', '2023-05-15 11:39:06', ''),
(884, '[Logged In] abcd@gmail.com', '2023-05-15 11:40:23', ''),
(885, '[Employee ClockOut]  ID 3', '2023-05-15 11:40:31', 'abcd'),
(886, '[Employee ClockIn]  ID 3', '2023-05-15 11:40:35', 'abcd'),
(887, '[Logged In] admin@admin.com', '2023-05-15 22:41:47', ''),
(888, '[Logged In] admin@admin.com', '2023-05-16 00:31:10', ''),
(889, '[Logged In] admin@admin.com', '2023-05-16 00:59:36', ''),
(890, '[Logged Out] admin', '2023-05-16 01:03:01', ''),
(891, '[Logged In] testing@gmail.com', '2023-05-16 01:03:17', ''),
(892, '[Employee ClockIn]  ID 1', '2023-05-16 01:03:24', 'testing'),
(893, '[Employee ClockOut]  ID 1', '2023-05-16 01:03:42', 'testing'),
(894, '[Logged In] admin@admin.com', '2023-05-16 01:28:32', ''),
(895, '[Logged In] admin@admin.com', '2023-05-16 01:28:37', ''),
(896, '[Logged In] admin@admin.com', '2023-05-16 01:28:41', ''),
(897, '[Logged In] admin@admin.com', '2023-05-16 02:28:43', ''),
(898, '[Logged Out] admin', '2023-05-16 02:50:55', ''),
(899, '[Logged In] reena@yahoo.com', '2023-05-16 02:51:06', ''),
(900, '[Employee ClockOut]  ID 12', '2023-05-16 02:51:38', 'Treena'),
(901, '[Employee ClockIn]  ID 12', '2023-05-16 02:52:00', 'Treena'),
(902, '[Employee Short Break Start]  ID 12', '2023-05-16 02:52:14', 'Treena'),
(903, '[Employee Short Break End]  ID 12', '2023-05-16 02:52:19', 'Treena'),
(904, '[Employee ClockOut]  ID 12', '2023-05-16 02:52:21', 'Treena'),
(905, '[Logged Out] Treena', '2023-05-16 02:55:47', ''),
(906, '[Logged In] admin@admin.com', '2023-05-16 02:56:02', ''),
(907, '[Logged In] admin@admin.com', '2023-05-16 02:58:24', ''),
(908, '[Logged In] admin@admin.com', '2023-05-16 03:14:00', ''),
(909, '[Logged Out] admin', '2023-05-16 03:21:38', ''),
(910, '[Logged In] reena@yahoo.com', '2023-05-16 03:21:49', ''),
(911, '[Employee ClockIn]  ID 12', '2023-05-16 03:21:55', 'Treena'),
(912, '[Employee ClockOut]  ID 12', '2023-05-16 03:23:23', 'Treena'),
(913, '[Logged Out] Treena', '2023-05-16 03:25:21', ''),
(914, '[Logged In] admin@admin.com', '2023-05-16 03:25:32', ''),
(915, '[Logged Out] admin', '2023-05-16 03:27:16', ''),
(916, '[Logged In] admin@admin.com', '2023-05-16 03:27:27', ''),
(917, '[Logged In] admin@admin.com', '2023-05-16 05:00:10', ''),
(918, '[Logged In] admin@admin.com', '2023-05-16 05:28:16', ''),
(919, '[Logged In] admin@admin.com', '2023-05-16 07:23:21', ''),
(920, '[Logged In] admin@admin.com', '2023-05-16 08:41:20', ''),
(921, '[Logged In] admin@admin.com', '2023-05-16 08:45:15', ''),
(922, '[Logged In] admin@admin.com', '2023-05-16 08:46:11', ''),
(923, '[Logged In] admin@admin.com', '2023-05-16 08:47:01', ''),
(924, '[Logged In] admin@admin.com', '2023-05-16 10:01:28', ''),
(925, '[Logged In] admin@admin.com', '2023-05-16 10:10:35', ''),
(926, '[Logged In] admin@admin.com', '2023-05-16 10:15:01', ''),
(927, '[Logged Out] admin', '2023-05-16 10:25:33', ''),
(928, '[Logged In] abcd@gmail.com', '2023-05-16 10:25:46', ''),
(929, '[Employee Away Start]  ID 3', '2023-05-16 10:26:07', 'abcd'),
(930, '[Employee Away End]  ID 3', '2023-05-16 10:26:29', 'abcd'),
(931, '[Logged Out] abcd', '2023-05-16 10:28:09', ''),
(932, '[Logged In] admin@admin.com', '2023-05-16 10:28:23', ''),
(933, '[Jobsheets Doc Added]  DocId Customer House Electricity Issue ComplaintId 73', '2023-05-16 10:35:20', 'admin'),
(934, '[Jobsheets Added]  TaskId 73', '2023-05-16 10:35:20', 'admin'),
(935, '[Logged Out] admin', '2023-05-16 10:36:58', ''),
(936, '[Logged In] abcd@gmail.com', '2023-05-16 10:37:07', ''),
(937, '[Logged Out] abcd', '2023-05-16 10:38:53', ''),
(938, '[Logged In] abcd@gmail.com', '2023-05-16 10:39:01', ''),
(939, '[Logged Out] abcd', '2023-05-16 10:39:18', ''),
(940, '[Logged In] admin@admin.com', '2023-05-16 10:39:34', ''),
(941, '[Logged Out] admin', '2023-05-16 10:44:39', ''),
(942, '[Logged In] abcd@gmail.com', '2023-05-16 10:44:47', ''),
(943, '[Logged Out] abcd', '2023-05-16 10:44:57', ''),
(944, '[Logged In] admin@admin.com', '2023-05-16 10:45:39', ''),
(945, '[Logged Out] admin', '2023-05-16 10:46:40', ''),
(946, '[Logged In] abcd@gmail.com', '2023-05-16 10:46:48', ''),
(947, '[Employee ClockOut]  ID 3', '2023-05-16 10:51:40', 'abcd'),
(948, '[Logged In] admin@admin.com', '2023-05-16 14:37:35', ''),
(949, '[Logged In] admin@admin.com', '2023-05-17 01:26:13', ''),
(950, '[Logged In] admin@admin.com', '2023-05-17 02:30:49', ''),
(951, '[Logged In] admin@admin.com', '2023-05-17 04:13:39', ''),
(952, '[Client Updated] Testing2 ID 13', '2023-05-17 04:20:31', 'admin'),
(953, '[Client Updated] Testing2 ID 13', '2023-05-17 04:20:42', 'admin'),
(954, '[Client Updated] Testing2 ID 13', '2023-05-17 04:20:54', 'admin'),
(955, '[Logged In] admin@admin.com', '2023-05-17 04:27:28', ''),
(956, '[Client Wallet Recharge] Amt-10000 ID 13', '2023-05-17 04:28:08', 'admin'),
(957, '[Logged Out] admin', '2023-05-17 04:28:12', ''),
(958, '[Logged In] testingjsoft@gmail.com', '2023-05-17 04:29:00', ''),
(959, '[Logged Out] Prabhat', '2023-05-17 04:29:43', ''),
(960, '[Payment Invoice 22]  Transaction-22 - 42 ', '2023-05-17 04:30:27', 'Testing2'),
(961, '[Logged In] admin@admin.com', '2023-05-17 04:30:53', ''),
(962, '[Payment Invoice 27]  Transaction-23 - 1 ', '2023-05-17 04:34:57', 'Testing2'),
(963, '[Jobsheets Added]  TaskId 74', '2023-05-17 04:40:35', 'admin'),
(964, '[Jobsheets Added]  TaskId 75', '2023-05-17 04:41:42', 'admin'),
(965, '[Logged In] testingjsoft@gmail.com', '2023-05-17 04:43:01', ''),
(966, '[Logged Out] Prabhat', '2023-05-17 04:43:26', ''),
(967, '[Logged In] hariinraj29@yahoo.com', '2023-05-17 04:44:25', ''),
(968, '[Logged Out] hariinraj29', '2023-05-17 04:57:28', ''),
(969, '[Logged In] testingjsoft@gmail.com', '2023-05-17 04:57:36', ''),
(970, '[Logged Out] Prabhat', '2023-05-17 05:09:04', ''),
(971, '[Logged In] reena@yahoo.com', '2023-05-17 05:11:12', ''),
(972, '[Employee ClockIn]  ID 12', '2023-05-17 05:11:34', 'Treena'),
(973, '[Employee Short Break Start]  ID 12', '2023-05-17 05:11:59', 'Treena'),
(974, '[Employee Short Break End]  ID 12', '2023-05-17 05:13:11', 'Treena'),
(975, '[Employee ClockOut]  ID 12', '2023-05-17 05:14:23', 'Treena'),
(976, '[Logged Out] Treena', '2023-05-17 05:26:27', ''),
(977, '[Logged In] testingjsoft@gmail.com', '2023-05-17 05:26:38', ''),
(978, '[Logged In] admin@admin.com', '2023-05-17 05:44:40', ''),
(979, '[Logged In] admin@admin.com', '2023-05-17 07:17:21', ''),
(980, '[Logged Out] ', '2023-05-17 09:24:03', ''),
(981, '[Logged In] reena@yahoo.com', '2023-05-17 09:24:14', ''),
(982, '[Employee ClockIn]  ID 12', '2023-05-17 09:24:29', 'Treena'),
(983, '[Logged In] admin@admin.com', '2023-05-17 09:42:30', ''),
(984, '[Logged In] admin@admin.com', '2023-05-17 18:36:13', ''),
(985, '[Logged In] admin@admin.com', '2023-05-17 20:49:11', ''),
(986, '[Logged In] admin@admin.com', '2023-05-17 22:55:58', ''),
(987, '[Logged In] admin@admin.com', '2023-05-18 01:04:43', ''),
(988, '[Logged In] admin@admin.com', '2023-05-18 01:04:59', ''),
(989, '[Logged In] admin@admin.com', '2023-05-18 02:51:10', ''),
(990, '[Payment Invoice 30]  Transaction-24 - 661.5 ', '2023-05-18 02:52:34', 'Shafeek Ajmal'),
(991, '[Logged Out] admin', '2023-05-18 02:56:38', ''),
(992, '[Payment Invoice 31]  Transaction-25 - 157.5 ', '2023-05-18 03:53:44', 'Shafeek Ajmal'),
(993, '[Logged Out] admin', '2023-05-18 04:27:21', ''),
(994, '[Logged In] admin@admin.com', '2023-05-18 04:27:33', ''),
(995, '[Logged In] admin@admin.com', '2023-05-18 06:25:44', ''),
(996, '[Logged In] admin@admin.com', '2023-05-18 08:10:15', ''),
(997, '[Logged In] admin@admin.com', '2023-05-18 08:20:33', ''),
(998, '[Jobsheets Added]  TaskId 76', '2023-05-18 08:41:47', 'admin'),
(999, '[Client Updated] udhayaraja ID 14', '2023-05-18 08:42:31', 'admin'),
(1000, '[Client Updated] udhayaraja ID 14', '2023-05-18 08:42:36', 'admin'),
(1001, '[Logged Out] ', '2023-05-18 09:04:30', ''),
(1002, '[Logged In] testingjsoft@gmail.com', '2023-05-18 09:04:41', ''),
(1003, '[Logged Out] Prabhat', '2023-05-18 09:04:56', ''),
(1004, '[Logged In] reena@yahoo.com', '2023-05-18 09:05:19', ''),
(1005, '[Logged Out] Treena', '2023-05-18 09:05:33', ''),
(1006, '[Logged In] admin@admin.com', '2023-05-18 10:30:13', ''),
(1007, '[Logged In] admin@admin.com', '2023-05-18 22:13:02', ''),
(1008, '[Logged In] admin@admin.com', '2023-05-19 00:01:11', ''),
(1009, '[Logged In] admin@admin.com', '2023-05-19 01:34:06', ''),
(1010, '[Logged In] admin@admin.com', '2023-05-19 01:44:17', ''),
(1011, '[Logged In] admin@admin.com', '2023-05-19 01:44:20', ''),
(1012, '[Logged In] admin@admin.com', '2023-05-19 04:14:55', ''),
(1013, '[Logged In] admin@admin.com', '2023-05-19 04:25:43', ''),
(1014, '[Logged In] admin@admin.com', '2023-05-19 04:51:23', ''),
(1015, '[Logged In] admin@admin.com', '2023-05-19 04:51:36', ''),
(1016, '[Logged In] admin@admin.com', '2023-05-19 05:03:51', ''),
(1017, '[Employee ClockIn]  ID 6', '2023-05-19 05:05:18', 'admin'),
(1018, '[Employee ClockIn]  ID 6', '2023-05-19 05:05:51', 'admin'),
(1019, '[Logged In] admin@admin.com', '2023-05-19 08:51:24', ''),
(1020, '[Logged In] admin@admin.com', '2023-05-19 08:52:06', ''),
(1021, '[Logged In] admin@admin.com', '2023-05-19 09:20:53', ''),
(1022, '[Logged In] admin@admin.com', '2023-05-19 09:21:15', ''),
(1023, '[Logged In] admin@admin.com', '2023-05-19 09:21:26', ''),
(1024, '[Logged In] admin@admin.com', '2023-05-19 09:21:43', ''),
(1025, '[Logged In] admin@admin.com', '2023-05-19 13:17:27', ''),
(1026, '[Logged In] admin@admin.com', '2023-05-19 13:25:05', ''),
(1027, '[Logged In] admin@admin.com', '2023-05-20 00:33:32', ''),
(1028, '[Logged Out] ', '2023-05-20 00:44:32', ''),
(1029, '[Logged In] admin@admin.com', '2023-05-20 00:44:37', ''),
(1030, '[Logged In] admin@admin.com', '2023-05-20 00:45:09', ''),
(1031, '[Logged Out] ', '2023-05-20 01:03:58', ''),
(1032, '[Logged In] admin@admin.com', '2023-05-20 01:04:05', ''),
(1033, '[Logged In] admin@admin.com', '2023-05-20 01:04:33', ''),
(1034, '[Logged In] admin@admin.com', '2023-05-20 09:12:36', ''),
(1035, '[Logged In] admin@admin.com', '2023-05-22 02:34:13', ''),
(1036, '[Logged Out] admin', '2023-05-22 02:50:51', ''),
(1037, '[Logged In] admin@admin.com', '2023-05-22 02:52:06', ''),
(1038, '[Logged In] admin@admin.com', '2023-05-22 02:56:15', ''),
(1039, '[Logged In] admin@admin.com', '2023-05-22 03:49:16', ''),
(1040, '[Logged In] admin@admin.com', '2023-05-22 04:29:48', ''),
(1041, '[Logged In] admin@admin.com', '2023-05-22 04:30:13', ''),
(1042, '[Logged In] admin@admin.com', '2023-05-22 04:30:28', ''),
(1043, '[Logged In] admin@admin.com', '2023-05-22 04:34:16', ''),
(1044, '[Logged In] admin@admin.com', '2023-05-22 04:44:05', ''),
(1045, '[Logged In] admin@admin.com', '2023-05-22 04:54:29', ''),
(1046, '[Logged In] admin@admin.com', '2023-05-22 04:58:47', ''),
(1047, '[Logged In] admin@admin.com', '2023-05-22 05:16:41', ''),
(1048, '[Logged In] admin@admin.com', '2023-05-22 05:16:57', ''),
(1049, '[Logged In] admin@admin.com', '2023-05-22 05:17:08', ''),
(1050, '[Logged In] admin@admin.com', '2023-05-22 05:17:27', ''),
(1051, '[Logged In] admin@admin.com', '2023-05-22 07:05:56', ''),
(1052, '[Logged In] testingjsoft@gmail.com', '2023-05-22 07:40:59', ''),
(1053, '[Logged Out] Prabhat', '2023-05-22 07:41:13', ''),
(1054, '[Logged In] reena@yahoo.com', '2023-05-22 07:41:25', ''),
(1055, '[Logged Out] Treena', '2023-05-22 07:43:26', ''),
(1056, '[Logged In] admin@admin.com', '2023-05-22 08:25:46', ''),
(1057, '[Logged In] admin@admin.com', '2023-05-22 08:26:02', ''),
(1058, '[Logged In] admin@admin.com', '2023-05-22 08:37:19', ''),
(1059, '[Logged In] admin@admin.com', '2023-05-22 11:56:59', ''),
(1060, '[Logged In] admin@admin.com', '2023-05-22 12:02:21', ''),
(1061, '[Logged In] admin@admin.com', '2023-05-22 12:06:33', ''),
(1062, '[Logged In] admin@admin.com', '2023-05-22 12:34:17', ''),
(1063, '[Logged In] admin@admin.com', '2023-05-22 12:42:34', ''),
(1064, '[Logged In] admin@admin.com', '2023-05-23 00:24:15', ''),
(1065, '[Logged In] admin@admin.com', '2023-05-23 03:15:44', ''),
(1066, '[Logged In] admin@admin.com', '2023-05-23 09:58:48', ''),
(1067, '[Logged In] admin@admin.com', '2023-05-23 14:12:27', ''),
(1068, '[Logged In] admin@admin.com', '2023-05-24 00:39:58', ''),
(1069, '[Employee ClockIn]  ID 6', '2023-05-24 00:40:49', 'admin'),
(1070, '[Logged Out] admin', '2023-05-24 01:08:17', ''),
(1071, '[Logged In] admin@admin.com', '2023-05-24 01:08:24', ''),
(1072, '[Employee ClockIn]  ID 6', '2023-05-24 01:08:32', 'admin'),
(1073, '[Logged Out] admin', '2023-05-24 01:08:38', ''),
(1074, '[Logged In] admin@admin.com', '2023-05-24 01:08:46', ''),
(1075, '[Logged Out] admin', '2023-05-24 01:09:03', ''),
(1076, '[Logged In] reena@yahoo.com', '2023-05-24 01:54:34', ''),
(1077, '[Logged Out] Treena', '2023-05-24 02:02:02', ''),
(1078, '[Logged In] reena@yahoo.com', '2023-05-24 02:10:17', ''),
(1079, '[Logged In] reena@yahoo.com', '2023-05-24 02:10:38', ''),
(1080, '[Logged In] reena@yahoo.com', '2023-05-24 02:11:17', ''),
(1081, '[Logged In] reena@yahoo.com', '2023-05-24 02:27:22', ''),
(1082, '[Employee Lunch Break Start]  ID 12', '2023-05-24 02:29:30', 'Treena'),
(1083, '[Logged Out] Treena', '2023-05-24 02:33:35', ''),
(1084, '[Logged In] admin@admin.com', '2023-05-24 02:33:43', ''),
(1085, '[Logged In] admin@admin.com', '2023-05-24 02:37:50', ''),
(1086, '[Logged In] admin@admin.com', '2023-05-24 02:42:36', ''),
(1087, '[Logged Out] admin', '2023-05-24 02:56:54', ''),
(1088, '[Logged In] reena@yahoo.com', '2023-05-24 02:57:03', ''),
(1089, '[Logged Out] Treena', '2023-05-24 02:57:32', ''),
(1090, '[Logged In] admin@admin.com', '2023-05-24 02:57:37', ''),
(1091, '[Employee ClockIn]  ID 6', '2023-05-24 03:00:30', 'admin'),
(1092, '[Employee ClockIn]  ID 6', '2023-05-24 03:00:53', 'admin'),
(1093, '[Logged In] reena@yahoo.com', '2023-05-24 03:01:55', ''),
(1094, '[Employee Lunch Break End]  ID 12', '2023-05-24 03:04:44', 'Treena'),
(1095, '[Logged In] admin@admin.com', '2023-05-24 03:24:34', ''),
(1096, '[Logged In] admin@admin.com', '2023-05-24 03:25:05', ''),
(1097, '[Logged In] admin@admin.com', '2023-05-24 04:09:46', ''),
(1098, '[Logged In] reena@yahoo.com', '2023-05-24 04:18:17', ''),
(1099, '[Logged In] admin@admin.com', '2023-05-24 04:29:59', ''),
(1100, '[Logged In] admin@admin.com', '2023-05-24 04:34:29', ''),
(1101, '[Logged Out] Treena', '2023-05-24 04:35:32', ''),
(1102, '[Logged In] admin@admin.com', '2023-05-24 04:35:39', ''),
(1103, '[Logged Out] admin', '2023-05-24 04:36:36', ''),
(1104, '[Logged In] reena@yahoo.com', '2023-05-24 04:36:53', ''),
(1105, '[Logged Out] Treena', '2023-05-24 04:39:29', ''),
(1106, '[Logged In] admin@admin.com', '2023-05-24 04:39:35', ''),
(1107, '[Logged Out] admin', '2023-05-24 04:41:08', ''),
(1108, '[Logged In] reena@yahoo.com', '2023-05-24 04:41:23', ''),
(1109, '[Logged In] admin@admin.com', '2023-05-24 04:47:45', ''),
(1110, '[Logged In] admin@admin.com', '2023-05-24 04:48:00', ''),
(1111, '[Logged In] admin@admin.com', '2023-05-24 04:49:07', ''),
(1112, '[Logged In] admin@admin.com', '2023-05-24 04:49:29', ''),
(1113, '[Logged In] admin@admin.com', '2023-05-24 04:49:36', ''),
(1114, '[Logged Out] Treena', '2023-05-24 04:51:04', ''),
(1115, '[Logged In] admin@admin.com', '2023-05-24 04:51:17', ''),
(1116, '[Logged In] reena@yahoo.com', '2023-05-24 04:51:36', ''),
(1117, '[Logged Out] Treena', '2023-05-24 04:56:55', ''),
(1118, '[Logged In] reena@yahoo.com', '2023-05-24 04:57:12', ''),
(1119, '[Logged Out] Treena', '2023-05-24 04:58:46', ''),
(1120, '[Logged In] reena@yahoo.com', '2023-05-24 04:59:01', ''),
(1121, '[Logged Out] ', '2023-05-24 05:00:00', ''),
(1122, '[Logged In] admin@admin.com', '2023-05-24 05:00:02', ''),
(1123, '[Logged In] admin@admin.com', '2023-05-24 05:00:04', ''),
(1124, '[Logged In] admin@admin.com', '2023-05-24 05:00:06', ''),
(1125, '[Logged In] admin@admin.com', '2023-05-24 05:00:27', ''),
(1126, '[Logged In] admin@admin.com', '2023-05-24 05:00:29', ''),
(1127, '[Logged Out] Treena', '2023-05-24 05:09:57', ''),
(1128, '[Logged In] reena@yahoo.com', '2023-05-24 05:10:10', ''),
(1129, '[Logged Out] Treena', '2023-05-24 05:11:16', ''),
(1130, '[Logged In] reena@yahoo.com', '2023-05-24 05:11:28', ''),
(1131, '[Logged Out] Treena', '2023-05-24 05:13:17', ''),
(1132, '[Logged In] reena@yahoo.com', '2023-05-24 05:13:30', ''),
(1133, '[Logged Out] Treena', '2023-05-24 05:15:56', ''),
(1134, '[Logged In] reena@yahoo.com', '2023-05-24 05:16:14', ''),
(1135, '[Logged Out] Treena', '2023-05-24 05:18:36', ''),
(1136, '[Logged In] reena@yahoo.com', '2023-05-24 05:18:56', ''),
(1137, '[Logged Out] Treena', '2023-05-24 05:19:51', ''),
(1138, '[Logged In] reena@yahoo.com', '2023-05-24 05:20:02', ''),
(1139, '[Logged In] reena@yahoo.com', '2023-05-24 05:21:15', ''),
(1140, '[Logged In] reena@yahoo.com', '2023-05-24 05:21:43', ''),
(1141, '[Logged Out] admin', '2023-05-24 05:22:21', ''),
(1142, '[Logged In] reena@yahoo.com', '2023-05-24 05:22:50', ''),
(1143, '[Logged Out] Treena', '2023-05-24 05:23:11', ''),
(1144, '[Logged In] reena@yahoo.com', '2023-05-24 05:25:00', ''),
(1145, '[Logged Out] Treena', '2023-05-24 05:26:25', ''),
(1146, '[Logged In] reena@yahoo.com', '2023-05-24 05:26:30', ''),
(1147, '[Logged Out] Treena', '2023-05-24 05:26:46', ''),
(1148, '[Logged In] admin@admin.com', '2023-05-24 05:29:17', ''),
(1149, '[Logged In] reena@yahoo.com', '2023-05-24 05:30:15', ''),
(1150, '[Logged In] admin@admin.com', '2023-05-24 05:41:28', ''),
(1151, '[Logged In] admin@admin.com', '2023-05-24 05:41:47', ''),
(1152, '[Employee ClockOut]  ID 12', '2023-05-24 06:05:59', 'admin'),
(1153, '[Logged In] admin@admin.com', '2023-05-24 06:50:25', ''),
(1154, '[Logged Out] ', '2023-05-24 07:10:03', ''),
(1155, '[Logged In] udhay@gmail.com', '2023-05-24 07:11:40', ''),
(1156, '[Employee ClockIn]  ID 13', '2023-05-24 07:30:35', 'Udhay'),
(1157, '[Employee ClockOut]  ID 13', '2023-05-24 07:50:40', 'Udhay'),
(1158, '[Logged Out] Udhay', '2023-05-24 07:50:46', ''),
(1159, '[Logged In] reena@yahoo.com', '2023-05-24 07:50:57', ''),
(1160, '[Employee ClockIn]  ID 6', '2023-05-24 08:01:49', 'admin'),
(1161, '[Employee Short Break Start]  ID 12', '2023-05-24 08:02:12', 'admin'),
(1162, '[Employee Short Break End]  ID 12', '2023-05-24 08:03:43', 'Treena'),
(1163, '[Employee Short Break Start]  ID 12', '2023-05-24 08:03:46', 'Treena'),
(1164, '[Employee Short Break End]  ID 12', '2023-05-24 08:03:52', 'Treena'),
(1165, '[Employee Short Break Start]  ID 12', '2023-05-24 08:03:58', 'Treena'),
(1166, '[Employee Short Break End]  ID 12', '2023-05-24 08:04:07', 'Treena'),
(1167, '[Employee Away Start]  ID 12', '2023-05-24 08:37:44', 'Treena'),
(1168, '[Logged Out] Treena', '2023-05-24 08:40:45', ''),
(1169, '[Logged In] admin@admin.com', '2023-05-25 00:23:55', ''),
(1170, '[Logged In] admin@admin.com', '2023-05-25 03:50:15', ''),
(1171, '[Logged In] admin@admin.com', '2023-05-25 03:56:05', ''),
(1172, '[Logged In] admin@admin.com', '2023-05-25 04:07:39', ''),
(1173, '[Logged In] admin@admin.com', '2023-05-25 04:08:27', ''),
(1174, '[Logged In] admin@admin.com', '2023-05-25 05:14:37', ''),
(1175, '[Logged In] admin@admin.com', '2023-05-25 09:14:27', ''),
(1176, '[Logged Out] admin', '2023-05-25 09:23:40', ''),
(1177, '[Logged In] admin@admin.com', '2023-05-25 09:25:19', ''),
(1178, '[Logged Out] admin', '2023-05-25 09:31:53', ''),
(1179, '[Logged In] reena@yahoo.com', '2023-05-25 09:32:11', ''),
(1180, '[Employee ClockIn]  ID 12', '2023-05-25 09:33:41', 'Treena'),
(1181, '[Employee Short Break Start]  ID 12', '2023-05-25 09:33:49', 'Treena'),
(1182, '[Employee Short Break End]  ID 12', '2023-05-25 09:34:00', 'Treena'),
(1183, '[Employee Lunch Break Start]  ID 12', '2023-05-25 09:34:07', 'Treena'),
(1184, '[Employee Lunch Break End]  ID 12', '2023-05-25 09:34:10', 'Treena'),
(1185, '[Employee Lunch Break Start]  ID 12', '2023-05-25 09:35:01', 'Treena'),
(1186, '[Logged Out] Treena', '2023-05-25 09:37:54', ''),
(1187, '[Logged In] admin@admin.com', '2023-05-25 09:38:02', ''),
(1188, '[Logged In] reena@yahoo.com', '2023-05-26 01:50:29', ''),
(1189, '[Employee ClockOut]  ID 12', '2023-05-26 01:50:34', 'Treena'),
(1190, '[Employee ClockIn]  ID 12', '2023-05-26 01:50:59', 'Treena'),
(1191, '[Employee Short Break Start]  ID 12', '2023-05-26 01:51:05', 'Treena'),
(1192, '[Logged Out] Treena', '2023-05-26 01:51:11', ''),
(1193, '[Logged In] reena@yahoo.com', '2023-05-26 01:51:30', ''),
(1194, '[Employee ClockOut]  ID 12', '2023-05-26 01:51:35', 'Treena'),
(1195, '[Logged Out] Treena', '2023-05-26 01:51:39', ''),
(1196, '[Logged In] reena@yahoo.com', '2023-05-26 01:51:51', ''),
(1197, '[Employee Short Break End]  ID 12', '2023-05-26 01:52:03', 'Treena'),
(1198, '[Logged Out] Treena', '2023-05-26 01:52:30', ''),
(1199, '[Logged In] admin@admin.com', '2023-05-26 01:52:58', ''),
(1200, '[Logged In] reena@yahoo.com', '2023-05-26 02:12:04', ''),
(1201, '[Employee ClockIn]  ID 12', '2023-05-26 02:12:30', 'Treena'),
(1202, '[Employee ClockOut]  ID 12', '2023-05-26 02:12:57', 'admin'),
(1203, '[Logged In] reena@yahoo.com', '2023-05-29 01:35:13', ''),
(1204, '[Employee ClockIn]  ID 12', '2023-05-29 01:35:42', 'Treena'),
(1205, '[Employee ClockOut]  ID 12', '2023-05-29 01:36:19', 'Treena'),
(1206, '[Employee ClockIn]  ID 12', '2023-05-29 01:36:30', 'Treena'),
(1207, '[Employee Short Break Start]  ID 12', '2023-05-29 01:37:10', 'Treena'),
(1208, '[Employee Short Break End]  ID 12', '2023-05-29 01:37:13', 'Treena'),
(1209, '[Employee Lunch Break Start]  ID 12', '2023-05-29 01:37:15', 'Treena'),
(1210, '[Logged Out] Treena', '2023-05-29 01:37:18', ''),
(1211, '[Logged In] admin@admin.com', '2023-05-29 01:37:24', ''),
(1212, '[Logged Out] admin', '2023-05-29 01:40:30', ''),
(1213, '[Logged In] reena@yahoo.com', '2023-05-29 01:40:51', ''),
(1214, '[Employee Lunch Break End]  ID 12', '2023-05-29 01:41:07', 'Treena'),
(1215, '[Logged In] reena@yahoo.com', '2023-05-30 02:55:39', ''),
(1216, '[Logged In] admin@admin.com', '2023-05-30 02:56:34', ''),
(1217, '[Logged In] admin@admin.com', '2023-05-30 03:23:12', ''),
(1218, '[Logged Out] admin', '2023-05-30 04:41:35', ''),
(1219, '[Logged In] admin@admin.com', '2023-05-30 04:42:31', ''),
(1220, '[Logged Out] ', '2023-05-30 04:49:48', ''),
(1221, '[Logged In] admin@admin.com', '2023-05-31 01:24:53', ''),
(1222, '[Logged Out] admin', '2023-05-31 02:12:13', ''),
(1223, '[Logged In] reena@yahoo.com', '2023-05-31 02:12:18', ''),
(1224, '[Logged Out] Treena', '2023-05-31 02:21:06', ''),
(1225, '[Logged In] admin@admin.com', '2023-05-31 02:21:12', ''),
(1226, '[Logged In] admin@admin.com', '2023-05-31 02:53:04', ''),
(1227, '[Logged Out] admin', '2023-05-31 03:06:47', ''),
(1228, '[Logged In] admin@admin.com', '2023-05-31 03:07:09', ''),
(1229, '[Logged In] admin@admin.com', '2023-05-31 06:07:37', ''),
(1230, '[Logged In] reena@yahoo.com', '2023-05-31 06:11:23', ''),
(1231, '[Employee ClockOut]  ID 12', '2023-05-31 06:11:35', 'Treena'),
(1232, '[Logged In] admin@admin.com', '2023-05-31 06:15:00', ''),
(1233, '[Logged In] admin@admin.com', '2023-05-31 06:43:08', ''),
(1234, '[Logged Out] Treena', '2023-05-31 07:26:43', ''),
(1235, '[Logged In] reena@yahoo.com', '2023-05-31 07:27:43', ''),
(1236, '[Employee ClockIn]  ID 12', '2023-05-31 07:29:32', 'Treena'),
(1237, '[Employee Short Break Start]  ID 12', '2023-05-31 07:31:12', 'Treena'),
(1238, '[Logged Out] Treena', '2023-05-31 07:33:35', ''),
(1239, '[Logged In] udhay@gmail.com', '2023-05-31 07:35:16', ''),
(1240, '[Logged Out] Udhay', '2023-05-31 07:36:10', ''),
(1241, '[Logged In] reena@yahoo.com', '2023-05-31 07:36:20', ''),
(1242, '[Logged Out] Treena', '2023-05-31 07:37:43', ''),
(1243, '[Logged In] udhay@gmail.com', '2023-05-31 07:37:53', ''),
(1244, '[Logged Out] Udhay', '2023-05-31 07:38:14', ''),
(1245, '[Logged In] reena@yahoo.com', '2023-05-31 07:38:25', ''),
(1246, '[Employee Short Break End]  ID 12', '2023-05-31 07:38:46', 'Treena'),
(1247, '[Logged Out] Treena', '2023-05-31 07:39:58', ''),
(1248, '[Logged In] udhay@gmail.com', '2023-05-31 07:40:08', ''),
(1249, '[Logged In] admin@admin.com', '2023-05-31 07:47:09', ''),
(1250, '[Logged Out] admin', '2023-05-31 07:49:05', ''),
(1251, '[Logged Out] ', '2023-05-31 08:28:36', ''),
(1252, '[Logged In] reena@yahoo.com', '2023-05-31 08:28:41', ''),
(1253, '[Logged Out] Treena', '2023-05-31 08:37:12', ''),
(1254, '[Logged In] reena@yahoo.com', '2023-05-31 08:38:32', ''),
(1255, '[Logged In] admin@admin.com', '2023-05-31 08:41:31', ''),
(1256, '[Logged In] reena@yahoo.com', '2023-05-31 09:07:48', ''),
(1257, '[Logged In] admin@admin.com', '2023-05-31 09:27:52', ''),
(1258, '[Logged Out] admin', '2023-05-31 09:33:25', ''),
(1259, '[Employee ClockOut]  ID 12', '2023-05-31 10:13:25', 'Treena'),
(1260, '[Logged Out] ', '2023-05-31 10:21:38', ''),
(1261, '[Logged In] reena@yahoo.com', '2023-05-31 10:21:51', ''),
(1262, '[Logged In] reena@yahoo.com', '2023-05-31 10:21:54', ''),
(1263, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:00', ''),
(1264, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:03', ''),
(1265, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:14', ''),
(1266, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:15', ''),
(1267, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:17', ''),
(1268, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:18', ''),
(1269, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:20', ''),
(1270, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:21', ''),
(1271, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:23', ''),
(1272, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:25', ''),
(1273, '[Logged In] admin@admin.com', '2023-05-31 10:22:40', ''),
(1274, '[Logged Out] admin', '2023-05-31 10:22:48', ''),
(1275, '[Logged In] reena@yahoo.com', '2023-05-31 10:22:53', ''),
(1276, '[Logged Out] Treena', '2023-05-31 10:24:13', ''),
(1277, '[Logged In] reena@yahoo.com', '2023-05-31 10:24:19', ''),
(1278, '[Employee ClockIn]  ID 12', '2023-05-31 10:26:16', 'Treena'),
(1279, '[Logged Out] Treena', '2023-05-31 10:27:40', ''),
(1280, '[Logged In] reena@yahoo.com', '2023-05-31 10:27:44', ''),
(1281, '[Employee ClockOut]  ID 12', '2023-05-31 10:28:07', 'Treena'),
(1282, '[Logged Out] Treena', '2023-05-31 10:28:56', ''),
(1283, '[Logged In] reena@yahoo.com', '2023-05-31 10:29:06', ''),
(1284, '[Logged In] reena@yahoo.com', '2023-05-31 10:41:01', ''),
(1285, '[Logged In] reena@yahoo.com', '2023-05-31 10:41:33', ''),
(1286, '[Logged Out] Treena', '2023-05-31 10:44:07', ''),
(1287, '[Logged In] reena@yahoo.com', '2023-05-31 10:44:10', ''),
(1288, '[Employee ClockOut]  ID 12', '2023-05-31 10:44:32', 'Treena'),
(1289, '[Logged Out] Treena', '2023-05-31 10:44:36', ''),
(1290, '[Logged In] reena@yahoo.com', '2023-05-31 10:44:40', ''),
(1291, '[Employee ClockIn]  ID 12', '2023-05-31 10:44:52', 'Treena'),
(1292, '[Employee ClockOut]  ID 12', '2023-05-31 10:47:51', 'Treena'),
(1293, '[Employee ClockIn]  ID 12', '2023-05-31 10:48:46', 'Treena'),
(1294, '[Logged In] reena@yahoo.com', '2023-05-31 10:51:21', ''),
(1295, '[Logged In] reena@yahoo.com', '2023-05-31 10:51:23', ''),
(1296, '[Logged In] reena@yahoo.com', '2023-05-31 10:51:25', ''),
(1297, '[Logged In] reena@yahoo.com', '2023-05-31 10:51:26', ''),
(1298, '[Logged In] reena@yahoo.com', '2023-05-31 10:52:07', ''),
(1299, '[Employee ClockOut]  ID 12', '2023-05-31 10:52:38', 'Treena'),
(1300, '[Employee ClockIn]  ID 12', '2023-05-31 10:52:46', 'Treena'),
(1301, '[Logged Out] Treena', '2023-05-31 10:59:38', ''),
(1302, '[Logged In] reena@yahoo.com', '2023-05-31 10:59:42', ''),
(1303, '[Employee ClockOut]  ID 12', '2023-05-31 10:59:58', 'Treena'),
(1304, '[Logged Out] Treena', '2023-05-31 11:04:15', ''),
(1305, '[Logged In] reena@yahoo.com', '2023-05-31 11:04:23', ''),
(1306, '[Logged In] reena@yahoo.com', '2023-05-31 12:52:52', ''),
(1307, '[Employee ClockIn]  ID 12', '2023-05-31 12:53:08', 'Treena'),
(1308, '[Employee ClockOut]  ID 12', '2023-05-31 12:53:13', 'Treena'),
(1309, '[Logged Out] Treena', '2023-05-31 12:53:17', ''),
(1310, '[Logged In] admin@admin.com', '2023-05-31 12:53:22', ''),
(1311, '[Payment Invoice 27]  Transaction-26 - 1 ', '2023-05-31 13:20:13', 'Testing2'),
(1312, '[Logged In] admin@admin.com', '2023-05-31 13:52:37', ''),
(1313, '[Logged Out] admin', '2023-05-31 13:53:18', ''),
(1314, '[Logged In] admin@admin.com', '2023-05-31 13:54:08', ''),
(1315, '[Logged Out] admin', '2023-05-31 13:55:06', ''),
(1316, '[Logged In] admin@admin.com', '2023-05-31 14:10:21', ''),
(1317, '[Logged In] admin@admin.com', '2023-06-01 01:41:15', ''),
(1318, '[Logged In] admin@admin.com', '2023-06-01 04:07:41', ''),
(1319, '[Logged In] admin@admin.com', '2023-06-01 04:23:46', ''),
(1320, '[Logged In] admin@admin.com', '2023-06-01 20:00:10', ''),
(1321, '[Logged In] admin@admin.com', '2023-06-02 03:01:02', ''),
(1322, '[Logged In] admin@admin.com', '2023-06-02 05:07:50', ''),
(1323, '[Logged In] admin@admin.com', '2023-06-02 05:07:53', ''),
(1324, '[Logged In] admin@admin.com', '2023-06-02 09:04:48', ''),
(1325, '[Logged In] admin@admin.com', '2023-06-03 01:37:34', ''),
(1326, '[Logged In] admin@admin.com', '2023-06-03 04:45:57', ''),
(1327, '[Logged In] admin@admin.com', '2023-06-03 06:38:49', ''),
(1328, '[Logged In] admin@admin.com', '2023-06-03 06:38:53', ''),
(1329, '[Logged In] admin@admin.com', '2023-06-04 01:55:58', ''),
(1330, '[Logged In] admin@admin.com', '2023-06-04 09:40:08', ''),
(1331, '[Logged In] admin@admin.com', '2023-06-04 20:33:56', ''),
(1332, '[Logged In] admin@admin.com', '2023-06-05 03:12:45', ''),
(1333, '[Logged In] admin@admin.com', '2023-06-05 09:17:21', ''),
(1334, '[Logged In] admin@admin.com', '2023-06-05 22:33:01', ''),
(1335, '[Logged In] admin@admin.com', '2023-06-06 00:44:41', ''),
(1336, '[Logged In] admin@admin.com', '2023-06-06 00:57:36', ''),
(1337, '[Logged In] admin@admin.com', '2023-06-06 00:57:44', ''),
(1338, '[Logged In] admin@admin.com', '2023-06-06 01:42:54', ''),
(1339, '[Logged In] admin@admin.com', '2023-06-06 02:57:17', ''),
(1340, '[Logged Out] admin', '2023-06-06 03:11:23', ''),
(1341, '[Logged In] testingjsoft@gmail.com', '2023-06-06 03:11:28', ''),
(1342, '[Logged Out] Prabhat', '2023-06-06 03:11:54', ''),
(1343, '[Logged In] admin@admin.com', '2023-06-06 03:11:59', ''),
(1344, '[Logged Out] admin', '2023-06-06 03:13:02', ''),
(1345, '[Logged In] testingjsoft@gmail.com', '2023-06-06 03:13:09', ''),
(1346, '[Logged Out] Prabhat', '2023-06-06 03:13:31', ''),
(1347, '[Logged In] admin@admin.com', '2023-06-06 03:13:38', ''),
(1348, '[Logged In] admin@admin.com', '2023-06-06 03:14:28', ''),
(1349, '[Logged In] testingjsoft@gmail.com', '2023-06-06 05:06:23', ''),
(1350, '[Logged Out] Prabhat', '2023-06-06 05:06:32', ''),
(1351, '[Logged In] reena@yahoo.com', '2023-06-06 05:06:41', ''),
(1352, '[Logged In] reena@yahoo.com', '2023-06-06 07:33:06', ''),
(1353, '[Logged Out] Treena', '2023-06-06 07:52:40', ''),
(1354, '[Logged In] admin@admin.com', '2023-06-06 07:52:47', ''),
(1355, '[Logged In] admin@admin.com', '2023-06-06 09:49:28', ''),
(1356, '[Logged In] abcd@gmail.com', '2023-06-06 17:02:00', ''),
(1357, '[Logged In] admin@admin.com', '2023-06-07 00:56:47', ''),
(1358, '[Logged In] admin@admin.com', '2023-06-07 04:40:42', ''),
(1359, '[Logged In] abcd@gmail.com', '2023-06-07 04:42:36', ''),
(1360, '[Employee ClockIn]  ID 3', '2023-06-07 05:16:26', 'abcd'),
(1361, '[Employee Short Break Start]  ID 3', '2023-06-07 05:18:29', 'abcd'),
(1362, '[Employee Short Break End]  ID 3', '2023-06-07 05:29:32', 'abcd'),
(1363, '[Logged In] admin@admin.com', '2023-06-07 06:05:21', ''),
(1364, '[Logged Out] admin', '2023-06-07 06:06:23', ''),
(1365, '[Logged In] abcd@gmail.com', '2023-06-07 06:06:29', ''),
(1366, '[Employee ClockOut]  ID 3', '2023-06-07 06:06:44', 'abcd'),
(1367, '[Logged In] admin@admin.com', '2023-06-07 07:04:04', ''),
(1368, '[Logged In] admin@admin.com', '2023-06-07 07:09:47', ''),
(1369, '[Logged In] abcd@gmail.com', '2023-06-07 07:19:09', ''),
(1370, '[Employee ClockIn]  ID 3', '2023-06-07 07:28:29', 'abcd'),
(1371, '[Employee ClockOut]  ID 3', '2023-06-07 07:29:13', 'abcd'),
(1372, '[Logged Out] abcd', '2023-06-07 07:34:41', ''),
(1373, '[Logged Out] abcd', '2023-06-07 07:35:13', ''),
(1374, '[Logged In] admin@admin.com', '2023-06-07 07:35:30', ''),
(1375, '[Logged Out] admin', '2023-06-07 07:57:43', ''),
(1376, '[Logged In] abcd@gmail.com', '2023-06-07 07:57:47', ''),
(1377, '[Logged In] abcd@gmail.com', '2023-06-07 08:08:10', ''),
(1378, '[Logged Out] abcd', '2023-06-07 08:08:37', ''),
(1379, '[Logged In] admin@admin.com', '2023-06-07 08:08:49', ''),
(1380, '[Logged Out] admin', '2023-06-07 08:10:32', ''),
(1381, '[Logged In] abcd@gmail.com', '2023-06-07 08:10:36', ''),
(1382, '[Employee ClockIn]  ID 3', '2023-06-07 08:22:25', 'abcd'),
(1383, '[Employee Away Start]  ID 3', '2023-06-07 08:23:37', 'abcd'),
(1384, '[Employee Away End]  ID 3', '2023-06-07 08:24:01', 'abcd'),
(1385, '[Employee ClockOut]  ID 3', '2023-06-07 08:24:45', 'abcd'),
(1386, '[Logged Out] abcd', '2023-06-07 08:25:24', ''),
(1387, '[Logged In] admin@admin.com', '2023-06-07 08:25:50', ''),
(1388, '[Logged Out] admin', '2023-06-07 08:33:25', ''),
(1389, '[Logged In] reena@yahoo.com', '2023-06-07 08:33:34', ''),
(1390, '[Logged Out] admin', '2023-06-07 08:39:17', ''),
(1391, '[Logged In] admin@admin.com', '2023-06-07 08:42:08', ''),
(1392, '[Logged Out] admin', '2023-06-07 08:44:06', ''),
(1393, '[Logged Out] ', '2023-06-07 08:45:07', ''),
(1394, '[Logged In] admin@admin.com', '2023-06-07 08:45:14', ''),
(1395, '[Logged In] reena@yahoo.com', '2023-06-07 08:45:17', ''),
(1396, '[Logged In] admin@admin.com', '2023-06-07 08:45:21', ''),
(1397, '[Logged In] admin@admin.com', '2023-06-07 08:45:33', ''),
(1398, '[Logged Out] admin', '2023-06-07 08:45:55', ''),
(1399, '[Logged In] admin@admin.com', '2023-06-07 08:46:10', ''),
(1400, '[Logged In] admin@admin.com', '2023-06-07 08:48:13', ''),
(1401, '[Logged Out] admin', '2023-06-07 08:48:20', ''),
(1402, '[Logged In] reena@yahoo.com', '2023-06-07 08:48:24', ''),
(1403, '[Logged Out] Treena', '2023-06-07 08:49:54', ''),
(1404, '[Logged In] reena@yahoo.com', '2023-06-07 08:49:59', ''),
(1405, '[Logged Out] Treena', '2023-06-07 08:54:21', ''),
(1406, '[Logged In] admin@admin.com', '2023-06-07 08:54:29', ''),
(1407, '[Logged Out] admin', '2023-06-07 08:56:48', ''),
(1408, '[Logged In] reena@yahoo.com', '2023-06-07 08:56:58', ''),
(1409, '[Logged Out] Treena', '2023-06-07 09:04:15', ''),
(1410, '[Logged In] admin@admin.com', '2023-06-07 09:04:23', ''),
(1411, '[Jobsheets Doc Added]  DocId Counter ComplaintId 77', '2023-06-07 09:05:33', 'admin'),
(1412, '[Jobsheets Added]  TaskId 77', '2023-06-07 09:05:33', 'admin'),
(1413, '[Logged Out] admin', '2023-06-07 09:05:56', ''),
(1414, '[Logged In] abcd@gmail.com', '2023-06-07 09:06:01', ''),
(1415, '[Logged Out] admin', '2023-06-07 09:07:31', ''),
(1416, '[Logged In] reena@yahoo.com', '2023-06-07 09:07:36', ''),
(1417, '[Logged Out] abcd', '2023-06-07 09:07:41', ''),
(1418, '[Logged In] admin@admin.com', '2023-06-07 09:07:55', ''),
(1419, '[Logged Out] Treena', '2023-06-07 09:09:14', ''),
(1420, '[Logged In] reena@yahoo.com', '2023-06-07 09:09:18', ''),
(1421, '[Logged Out] Treena', '2023-06-07 09:10:19', ''),
(1422, '[Logged In] admin@admin.com', '2023-06-07 09:10:22', ''),
(1423, '[Logged Out] admin', '2023-06-07 09:10:32', ''),
(1424, '[Logged In] reena@yahoo.com', '2023-06-07 09:10:36', ''),
(1425, '[Logged Out] Treena', '2023-06-07 09:26:24', ''),
(1426, '[Logged In] admin@admin.com', '2023-06-07 09:26:40', ''),
(1427, '[Logged Out] ', '2023-06-07 09:52:06', ''),
(1428, '[Logged In] admin@admin.com', '2023-06-07 09:52:39', ''),
(1429, '[Logged Out] admin', '2023-06-07 09:53:01', ''),
(1430, '[Logged In] reena@yahoo.com', '2023-06-07 09:53:06', ''),
(1431, '[Logged In] admin@admin.com', '2023-06-07 10:01:30', ''),
(1432, '[Logged Out] Treena', '2023-06-07 10:01:49', ''),
(1433, '[Logged Out] admin', '2023-06-07 10:02:10', ''),
(1434, '[Logged In] testingjsoft@gmail.com', '2023-06-07 10:02:28', ''),
(1435, '[Logged Out] Prabhat', '2023-06-07 10:05:50', ''),
(1436, '[Logged In] admin@admin.com', '2023-06-07 10:05:56', ''),
(1437, '[Logged In] admin@admin.com', '2023-06-07 10:08:18', ''),
(1438, '[Logged In] admin@admin.com', '2023-06-07 10:08:33', ''),
(1439, '[Logged Out] admin', '2023-06-07 10:12:23', ''),
(1440, '[Logged In] admin@admin.com', '2023-06-07 10:19:04', ''),
(1441, '[Logged Out] ', '2023-06-07 10:27:06', ''),
(1442, '[Logged In] admin@admin.com', '2023-06-07 10:27:13', ''),
(1443, '[Logged In] admin@admin.com', '2023-06-07 10:27:19', ''),
(1444, '[Logged In] admin@admin.com', '2023-06-07 10:27:32', ''),
(1445, '[Logged In] admin@admin.com', '2023-06-07 10:37:36', ''),
(1446, '[Logged In] admin@admin.com', '2023-06-07 10:47:15', ''),
(1447, '[Logged In] admin@admin.com', '2023-06-07 10:47:28', ''),
(1448, '[Logged In] admin@admin.com', '2023-06-07 10:48:13', ''),
(1449, '[Logged Out] admin', '2023-06-07 11:24:34', ''),
(1450, '[Logged In] admin@admin.com', '2023-06-07 11:24:36', ''),
(1451, '[Logged Out] admin', '2023-06-07 11:24:48', ''),
(1452, '[Logged In] reena@yahoo.com', '2023-06-07 11:24:52', ''),
(1453, '[Logged Out] Treena', '2023-06-07 11:25:01', ''),
(1454, '[Logged In] admin@admin.com', '2023-06-07 11:25:05', ''),
(1455, '[Logged In] admin@admin.com', '2023-06-07 11:53:23', ''),
(1456, '[Logged Out] admin', '2023-06-07 12:13:49', ''),
(1457, '[Logged In] admin@admin.com', '2023-06-07 12:14:10', ''),
(1458, '[Employee ClockIn]  ID 6', '2023-06-07 12:15:51', 'admin'),
(1459, '[Employee ClockIn]  ID 6', '2023-06-07 12:15:57', 'admin'),
(1460, '[Employee ClockIn]  ID 6', '2023-06-07 12:17:04', 'admin'),
(1461, '[Logged In] admin@admin.com', '2023-06-07 12:23:50', ''),
(1462, '[Logged In] admin@admin.com', '2023-06-07 12:23:55', ''),
(1463, '[Logged In] admin@admin.com', '2023-06-07 12:24:23', ''),
(1464, '[Logged Out] admin', '2023-06-07 12:30:30', ''),
(1465, '[Logged In] admin@admin.com', '2023-06-07 12:30:49', ''),
(1466, '[Logged In] abcd@gmail.com', '2023-06-07 12:31:42', ''),
(1467, '[Logged Out] abcd', '2023-06-07 12:34:37', ''),
(1468, '[Logged In] admin@admin.com', '2023-06-07 12:42:47', ''),
(1469, '[Logged In] admin@admin.com', '2023-06-07 13:54:26', ''),
(1470, '[Logged Out] admin', '2023-06-07 14:20:26', ''),
(1471, '[Logged In] abcd@gmail.com', '2023-06-07 14:21:01', ''),
(1472, '[Logged Out] admin', '2023-06-07 14:21:41', ''),
(1473, '[Logged In] admin@admin.com', '2023-06-07 14:22:32', ''),
(1474, '[Logged In] admin@admin.com', '2023-06-07 14:24:34', ''),
(1475, '[Logged Out] ', '2023-06-07 14:31:50', ''),
(1476, '[Logged In] admin@admin.com', '2023-06-07 14:31:53', ''),
(1477, '[Logged In] admin@admin.com', '2023-06-07 14:32:06', ''),
(1478, '[Logged Out] admin', '2023-06-07 14:32:26', ''),
(1479, '[Logged In] abcd@gmail.com', '2023-06-07 14:32:35', ''),
(1480, '[Logged Out] abcd', '2023-06-07 14:33:24', ''),
(1481, '[Logged In] admin@admin.com', '2023-06-07 14:33:41', ''),
(1482, '[Logged Out] admin', '2023-06-07 14:38:35', ''),
(1483, '[Logged In] testingjsoft@gmail.com', '2023-06-07 14:38:45', ''),
(1484, '[Logged Out] Prabhat', '2023-06-07 14:38:56', ''),
(1485, '[Logged In] admin@admin.com', '2023-06-07 14:39:02', ''),
(1486, '[Logged Out] admin', '2023-06-07 14:44:54', ''),
(1487, '[Logged In] admin@admin.com', '2023-06-07 14:56:00', ''),
(1488, '[Logged Out] admin', '2023-06-07 15:00:01', ''),
(1489, '[Logged In] abcd@gmail.com', '2023-06-07 15:00:11', ''),
(1490, '[Logged Out] abcd', '2023-06-07 15:00:20', ''),
(1491, '[Logged In] testingjsoft@gmail.com', '2023-06-07 15:00:32', ''),
(1492, '[Logged Out] Prabhat', '2023-06-07 15:00:43', ''),
(1493, '[Logged In] admin@admin.com', '2023-06-07 15:00:48', ''),
(1494, '[Logged Out] admin', '2023-06-07 15:01:54', ''),
(1495, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:02:00', ''),
(1496, '[Logged Out] ajmal', '2023-06-07 15:02:12', ''),
(1497, '[Logged In] admin@admin.com', '2023-06-07 15:02:17', ''),
(1498, '[Logged Out] admin', '2023-06-07 15:03:13', ''),
(1499, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:03:20', ''),
(1500, '[Logged Out] ajmal', '2023-06-07 15:03:44', ''),
(1501, '[Logged In] admin@admin.com', '2023-06-07 15:03:49', ''),
(1502, '[Logged Out] admin', '2023-06-07 15:11:47', ''),
(1503, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:11:52', ''),
(1504, '[Logged Out] ajmal', '2023-06-07 15:12:11', ''),
(1505, '[Logged In] admin@admin.com', '2023-06-07 15:12:15', ''),
(1506, '[Logged Out] admin', '2023-06-07 15:12:23', ''),
(1507, '[Logged In] admin@admin.com', '2023-06-07 15:12:27', ''),
(1508, '[Logged Out] admin', '2023-06-07 15:12:31', ''),
(1509, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:12:54', ''),
(1510, '[Logged Out] ajmal', '2023-06-07 15:21:39', ''),
(1511, '[Logged In] abcd@gmail.com', '2023-06-07 15:22:57', ''),
(1512, '[Logged Out] admin', '2023-06-07 15:23:00', ''),
(1513, '[Logged In] abcd@gmail.com', '2023-06-07 15:23:08', ''),
(1514, '[Logged Out] abcd', '2023-06-07 15:23:18', ''),
(1515, '[Logged In] admin@admin.com', '2023-06-07 15:23:22', ''),
(1516, '[Logged Out] abcd', '2023-06-07 15:24:36', ''),
(1517, '[Logged In] admin@admin.com', '2023-06-07 15:24:40', ''),
(1518, '[Logged Out] admin', '2023-06-07 15:25:01', ''),
(1519, '[Logged In] abcd@gmail.com', '2023-06-07 15:25:29', ''),
(1520, '[Logged Out] abcd', '2023-06-07 15:25:43', ''),
(1521, '[Logged In] admin@admin.com', '2023-06-07 15:25:48', ''),
(1522, '[Logged Out] admin', '2023-06-07 15:32:48', ''),
(1523, '[Logged In] abcd@gmail.com', '2023-06-07 15:33:09', ''),
(1524, '[Logged Out] abcd', '2023-06-07 15:33:45', ''),
(1525, '[Logged In] admin@admin.com', '2023-06-07 15:34:29', ''),
(1526, '[Logged Out] admin', '2023-06-07 15:34:30', ''),
(1527, '[Logged In] abcd@gmail.com', '2023-06-07 15:34:43', ''),
(1528, '[Logged Out] abcd', '2023-06-07 15:34:53', ''),
(1529, '[Logged In] admin@admin.com', '2023-06-07 15:35:00', ''),
(1530, '[Logged Out] admin', '2023-06-07 15:36:06', ''),
(1531, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:36:53', ''),
(1532, '[Logged Out] ajmal', '2023-06-07 15:37:23', ''),
(1533, '[Logged In] admin@admin.com', '2023-06-07 15:37:42', ''),
(1534, '[Logged Out] admin', '2023-06-07 15:40:30', ''),
(1535, '[Logged In] myname@gmail.com', '2023-06-07 15:40:37', ''),
(1536, '[Logged Out] myname', '2023-06-07 15:40:52', ''),
(1537, '[Logged In] admin@admin.com', '2023-06-07 15:40:58', ''),
(1538, '[Logged Out] admin', '2023-06-07 15:45:09', ''),
(1539, '[Logged In] myname@gmail.com', '2023-06-07 15:45:33', ''),
(1540, '[Logged Out] admin', '2023-06-07 15:45:36', ''),
(1541, '[Logged Out] myname', '2023-06-07 15:46:04', ''),
(1542, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:46:33', ''),
(1543, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 15:46:54', ''),
(1544, '[Logged Out] ajmal', '2023-06-07 15:47:10', ''),
(1545, '[Logged Out] ajmal', '2023-06-07 15:48:12', ''),
(1546, '[Logged In] myname@gmail.com', '2023-06-07 15:48:23', ''),
(1547, '[Logged In] myname@gmail.com', '2023-06-07 16:00:31', ''),
(1548, '[Logged In] myname@gmail.com', '2023-06-07 16:00:56', ''),
(1549, '[Logged In] admin@admin.com', '2023-06-07 16:05:38', ''),
(1550, '[Logged In] myname@gmail.com', '2023-06-07 16:17:13', ''),
(1551, '[Logged Out] myname', '2023-06-07 16:17:21', ''),
(1552, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-07 16:17:52', ''),
(1553, '[Logged Out] ajmal', '2023-06-07 16:18:00', ''),
(1554, '[Logged In] admin@admin.com', '2023-06-07 20:53:10', ''),
(1555, '[Client Added] JSOFT SOLUTION SDN BHD ID 25', '2023-06-07 21:18:01', 'admin'),
(1556, '[Logged In] admin@admin.com', '2023-06-08 00:52:52', ''),
(1557, '[Logged In] admin@admin.com', '2023-06-08 02:45:26', ''),
(1558, '[Logged Out] admin', '2023-06-08 03:10:16', ''),
(1559, '[Logged In] admin@admin.com', '2023-06-08 03:11:00', ''),
(1560, '[Logged Out] admin', '2023-06-08 03:48:15', ''),
(1561, '[Logged In] admin@admin.com', '2023-06-08 03:48:48', ''),
(1562, '[Logged Out] admin', '2023-06-08 03:49:09', ''),
(1563, '[Logged In] admin@admin.com', '2023-06-08 03:49:31', ''),
(1564, '[Logged In] admin@admin.com', '2023-06-08 04:06:12', ''),
(1565, '[Logged In] admin@admin.com', '2023-06-08 06:51:14', ''),
(1566, '[Logged In] admin@admin.com', '2023-06-08 09:08:17', ''),
(1567, '[Logged In] admin@admin.com', '2023-06-08 09:29:21', ''),
(1568, '[Logged In] admin@admin.com', '2023-06-08 09:44:46', ''),
(1569, '[Logged In] admin@admin.com', '2023-06-08 09:53:00', ''),
(1570, '[Logged In] admin@admin.com', '2023-06-08 09:53:18', ''),
(1571, '[Client Added] testinternational ID 26', '2023-06-08 10:11:06', 'admin'),
(1572, '[Logged In] admin@admin.com', '2023-06-08 10:16:46', ''),
(1573, '[Logged In] admin@admin.com', '2023-06-08 10:16:51', ''),
(1574, '[Logged In] admin@admin.com', '2023-06-08 10:16:56', '');
INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(1575, '[Logged Out] admin', '2023-06-08 10:54:34', ''),
(1576, '[Logged In] admin@admin.com', '2023-06-08 10:54:52', ''),
(1577, '[Logged In] admin@admin.com', '2023-06-08 12:49:38', ''),
(1578, '[Client Added] testcompany ID 27', '2023-06-08 12:51:48', 'admin'),
(1579, '[Logged Out] admin', '2023-06-08 12:51:56', ''),
(1580, '[Logged In] admin@admin.com', '2023-06-08 13:11:33', ''),
(1581, '[Logged In] admin@admin.com', '2023-06-08 14:05:38', ''),
(1582, '[Logged In] admin@admin.com', '2023-06-08 18:49:38', ''),
(1583, '[Logged In] admin@admin.com', '2023-06-09 02:50:14', ''),
(1584, '[Logged In] admin@admin.com', '2023-06-09 06:50:47', ''),
(1585, '[Logged In] admin@admin.com', '2023-06-09 10:33:52', ''),
(1586, '[Client Added] John ID 28', '2023-06-09 10:37:09', 'admin'),
(1587, '[Client Added] DEV SDN BHD ID 29', '2023-06-09 10:40:17', 'admin'),
(1588, '[Logged In] admin@admin.com', '2023-06-09 13:46:07', ''),
(1589, '[Logged In] admin@admin.com', '2023-06-09 13:54:25', ''),
(1590, '[Client Added] DEV Sdn Bhd ID 30', '2023-06-09 13:56:13', 'admin'),
(1591, '[Logged In] admin@admin.com', '2023-06-09 14:38:06', ''),
(1592, '[Client Deleted]  ID 29', '2023-06-09 14:42:46', 'admin'),
(1593, '[Client Doc Deleted]  DocId 29 CID 29', '2023-06-09 14:42:46', 'admin'),
(1594, '[Logged In] admin@admin.com', '2023-06-09 15:13:28', ''),
(1595, '[Logged In] admin@admin.com', '2023-06-09 15:13:31', ''),
(1596, '[Logged In] admin@admin.com', '2023-06-09 15:40:15', ''),
(1597, '[Logged In] admin@admin.com', '2023-06-09 15:40:34', ''),
(1598, '[Logged In] admin@admin.com', '2023-06-10 00:31:41', ''),
(1599, '[Logged In] admin@admin.com', '2023-06-10 04:09:39', ''),
(1600, '[Logged In] admin@admin.com', '2023-06-10 04:22:08', ''),
(1601, '[Logged In] admin@admin.com', '2023-06-10 04:22:45', ''),
(1602, '[Client Added] testtoday ID 31', '2023-06-10 04:47:48', 'admin'),
(1603, '[Logged In] admin@admin.com', '2023-06-10 05:10:48', ''),
(1604, '[Logged In] admin@admin.com', '2023-06-10 05:11:00', ''),
(1605, '[Logged In] admin@admin.com', '2023-06-10 05:11:02', ''),
(1606, '[Logged In] admin@admin.com', '2023-06-10 05:11:19', ''),
(1607, '[Logged In] admin@admin.com', '2023-06-10 05:11:33', ''),
(1608, '[Logged In] admin@admin.com', '2023-06-10 05:12:20', ''),
(1609, '[Logged In] admin@admin.com', '2023-06-10 05:12:58', ''),
(1610, '[Logged In] admin@admin.com', '2023-06-10 05:13:34', ''),
(1611, '[Logged In] admin@admin.com', '2023-06-10 05:23:34', ''),
(1612, '[Logged In] admin@admin.com', '2023-06-10 05:31:01', ''),
(1613, '[Logged In] admin@admin.com', '2023-06-10 05:34:31', ''),
(1614, '[Logged Out] admin', '2023-06-10 05:34:46', ''),
(1615, '[Logged In] admin@admin.com', '2023-06-10 05:34:49', ''),
(1616, '[Logged In] admin@admin.com', '2023-06-10 05:35:14', ''),
(1617, '[Client Added] sample ID 32', '2023-06-10 05:37:10', 'admin'),
(1618, '[Logged Out] admin', '2023-06-10 05:40:08', ''),
(1619, '[Logged In] admin@admin.com', '2023-06-10 06:32:08', ''),
(1620, '[Logged Out] admin', '2023-06-10 06:32:30', ''),
(1621, '[Logged In] admin@admin.com', '2023-06-10 06:35:17', ''),
(1622, '[Logged Out] ', '2023-06-10 13:23:49', ''),
(1623, '[Logged In] admin@admin.com', '2023-06-10 13:53:17', ''),
(1624, '[Logged In] admin@admin.com', '2023-06-11 02:36:52', ''),
(1625, '[Logged In] admin@admin.com', '2023-06-11 15:12:23', ''),
(1626, '[Logged In] admin@admin.com', '2023-06-11 15:13:06', ''),
(1627, '[Logged In] admin@admin.com', '2023-06-11 20:51:28', ''),
(1628, '[Logged Out] ', '2023-06-12 00:29:30', ''),
(1629, '[Logged In] admin@admin.com', '2023-06-12 00:29:51', ''),
(1630, '[Employee ClockIn]  ID 6', '2023-06-12 00:52:44', 'admin'),
(1631, '[Jobsheets Doc Added]  DocId sofware developmen mocule - file ,manager  ComplaintId 78', '2023-06-12 00:58:34', 'admin'),
(1632, '[Jobsheets Added]  TaskId 78', '2023-06-12 00:58:34', 'admin'),
(1633, '[Logged Out] admin', '2023-06-12 00:59:12', ''),
(1634, '[Logged In] admin@admin.com', '2023-06-12 00:59:36', ''),
(1635, '[Logged Out] admin', '2023-06-12 01:00:20', ''),
(1636, '[Logged In] abcd@gmail.com', '2023-06-12 01:00:44', ''),
(1637, '[Logged Out] abcd', '2023-06-12 01:02:23', ''),
(1638, '[Logged In] admin@admin.com', '2023-06-12 01:02:38', ''),
(1639, '[Logged Out] admin', '2023-06-12 01:13:51', ''),
(1640, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-12 01:14:06', ''),
(1641, '[Logged In] admin@admin.com', '2023-06-12 01:41:04', ''),
(1642, '[Logged In] testingjsoft@gmail.com', '2023-06-12 01:43:43', ''),
(1643, '[Logged Out] ajmal', '2023-06-12 01:58:48', ''),
(1644, '[Jobsheets Doc Added]  DocId Server Replacement  ComplaintId 79', '2023-06-12 01:59:20', 'admin'),
(1645, '[Jobsheets Added]  TaskId 79', '2023-06-12 01:59:20', 'admin'),
(1646, '[Logged In] admin@admin.com', '2023-06-12 02:01:28', ''),
(1647, '[Logged In] admin@admin.com', '2023-06-12 02:10:42', ''),
(1648, '[Client Added] puteri  ID 33', '2023-06-12 02:15:22', 'admin'),
(1649, '[Logged Out] admin', '2023-06-12 02:23:20', ''),
(1650, '[Logged In] ajmal@jsoftsolution.com.my', '2023-06-12 02:23:58', ''),
(1651, '[Logged Out] ajmal', '2023-06-12 02:30:57', ''),
(1652, '[Logged In] admin@admin.com', '2023-06-12 02:31:05', ''),
(1653, '[Client Updated] puteri  ID 33', '2023-06-12 02:42:23', 'admin'),
(1654, '[Client Updated] puteri  ID 33', '2023-06-12 02:42:45', 'admin'),
(1655, '[Logged Out] admin', '2023-06-12 02:42:55', ''),
(1656, '[Logged In] admin@admin.com', '2023-06-12 02:51:42', ''),
(1657, '[Logged In] admin@admin.com', '2023-06-12 02:52:32', ''),
(1658, '[Logged Out] admin', '2023-06-12 02:53:33', ''),
(1659, '[Logged In] admin@admin.com', '2023-06-12 02:54:16', ''),
(1660, '[Client Added] newtest ID 34', '2023-06-12 02:56:56', 'admin'),
(1661, '[Logged In] admin@admin.com', '2023-06-12 03:03:15', ''),
(1662, '[Logged In] admin@admin.com', '2023-06-12 03:03:33', ''),
(1663, '[Logged Out] admin', '2023-06-12 03:13:49', ''),
(1664, '[Logged In] admin@admin.com', '2023-06-12 03:24:58', ''),
(1665, '[Logged Out] admin', '2023-06-12 04:03:34', ''),
(1666, '[Logged In] admin@admin.com', '2023-06-12 04:12:55', ''),
(1667, '[Logged In] admin@admin.com', '2023-06-12 04:20:44', ''),
(1668, '[Logged Out] ', '2023-06-12 04:28:16', ''),
(1669, '[Logged In] admin@admin.com', '2023-06-12 04:36:16', ''),
(1670, '[Jobsheets Doc Added]  DocId Data Migration ComplaintId 81', '2023-06-12 04:52:32', 'admin'),
(1671, '[Jobsheets Added]  TaskId 81', '2023-06-12 04:52:32', 'admin'),
(1672, '[Logged In] admin@admin.com', '2023-06-12 06:10:31', ''),
(1673, '[Logged In] adam@gmail.com', '2023-06-12 06:19:33', ''),
(1674, '[Logged Out] Adam29', '2023-06-12 06:51:06', ''),
(1675, '[Logged In] testingjsoft@gmail.com', '2023-06-12 06:51:14', ''),
(1676, '[Employee ClockIn]  ID 11', '2023-06-12 07:05:37', 'Prabhat'),
(1677, '[Employee Short Break Start]  ID 11', '2023-06-12 07:06:20', 'Prabhat'),
(1678, '[Employee Short Break End]  ID 11', '2023-06-12 07:06:30', 'Prabhat'),
(1679, '[Employee Lunch Break Start]  ID 11', '2023-06-12 07:06:32', 'Prabhat'),
(1680, '[Employee Lunch Break End]  ID 11', '2023-06-12 07:06:34', 'Prabhat'),
(1681, '[Employee Away Start]  ID 11', '2023-06-12 07:06:35', 'Prabhat'),
(1682, '[Employee Away End]  ID 11', '2023-06-12 07:06:36', 'Prabhat'),
(1683, '[Employee Away Start]  ID 11', '2023-06-12 07:07:58', 'Prabhat'),
(1684, '[Employee Away End]  ID 11', '2023-06-12 07:13:26', 'Prabhat'),
(1685, '[Employee ClockIn]  ID 6', '2023-06-12 07:13:44', 'admin'),
(1686, '[Employee Short Break Start]  ID 11', '2023-06-12 07:14:06', 'Prabhat'),
(1687, '[Employee Short Break End]  ID 11', '2023-06-12 07:14:09', 'Prabhat'),
(1688, '[Employee Away Start]  ID 11', '2023-06-12 07:14:10', 'Prabhat'),
(1689, '[Employee Away End]  ID 11', '2023-06-12 07:14:11', 'Prabhat'),
(1690, '[Employee Lunch Break Start]  ID 11', '2023-06-12 07:14:12', 'Prabhat'),
(1691, '[Employee Lunch Break End]  ID 11', '2023-06-12 07:14:13', 'Prabhat'),
(1692, '[Employee ClockOut]  ID 11', '2023-06-12 07:28:20', 'Prabhat'),
(1693, '[Employee ClockIn]  ID 6', '2023-06-12 07:28:38', 'admin'),
(1694, '[Logged In] admin@admin.com', '2023-06-12 08:07:48', ''),
(1695, '[Logged In] admin@admin.com', '2023-06-12 08:16:28', ''),
(1696, '[Logged In] admin@admin.com', '2023-06-12 08:25:21', ''),
(1697, '[Logged In] adam@gmail.com', '2023-06-12 08:31:34', ''),
(1698, '[Employee ClockIn]  ID 24', '2023-06-12 08:37:44', 'Adam29'),
(1699, '[Logged Out] Adam29', '2023-06-12 08:39:15', ''),
(1700, '[Logged In] adam@gmail.com', '2023-06-12 08:39:26', ''),
(1701, '[Employee ClockOut]  ID 24', '2023-06-12 08:39:30', 'Adam29'),
(1702, '[Logged Out] Adam29', '2023-06-12 08:42:47', ''),
(1703, '[Logged In] testingjsoft@gmail.com', '2023-06-12 08:42:55', ''),
(1704, '[Employee ClockIn]  ID 11', '2023-06-12 08:43:01', 'Prabhat'),
(1705, '[Employee ClockOut]  ID 11', '2023-06-12 08:46:37', 'Prabhat'),
(1706, '[Employee ClockIn]  ID 6', '2023-06-12 09:36:23', 'admin'),
(1707, '[Logged Out] Prabhat', '2023-06-12 09:36:44', ''),
(1708, '[Logged In] adam@gmail.com', '2023-06-12 09:37:23', ''),
(1709, '[Logged Out] Adam29', '2023-06-12 09:48:26', ''),
(1710, '[Logged In] testingjsoft@gmail.com', '2023-06-12 09:48:36', ''),
(1711, '[Logged Out] admin', '2023-06-12 09:48:48', ''),
(1712, '[Logged In] admin@admin.com', '2023-06-12 09:48:53', ''),
(1713, '[Logged Out] Prabhat', '2023-06-12 10:02:33', ''),
(1714, '[Logged In] admin@admin.com', '2023-06-12 11:43:48', ''),
(1715, '[Logged In] testingjsoft@gmail.com', '2023-06-12 11:44:26', ''),
(1716, '[Logged Out] Prabhat', '2023-06-12 11:48:59', ''),
(1717, '[Logged In] adam@gmail.com', '2023-06-12 11:49:08', ''),
(1718, '[Logged In] admin@admin.com', '2023-06-12 12:26:46', ''),
(1719, '[Logged In] admin@admin.com', '2023-06-12 16:00:37', ''),
(1720, '[Logged Out] admin', '2023-06-13 02:02:41', ''),
(1721, '[Logged In] admin@admin.com', '2023-06-13 02:32:19', ''),
(1722, '[Logged In] adam@gmail.com', '2023-06-13 04:38:06', ''),
(1723, '[Logged In] admin@admin.com', '2023-06-13 04:38:52', ''),
(1724, '[Employee ClockIn]  ID 24', '2023-06-13 04:41:08', 'Adam29'),
(1725, '[Employee Short Break Start]  ID 24', '2023-06-13 04:42:15', 'Adam29'),
(1726, '[Employee Short Break End]  ID 24', '2023-06-13 04:42:19', 'Adam29'),
(1727, '[Employee ClockOut]  ID 24', '2023-06-13 04:43:12', 'Adam29'),
(1728, '[Logged Out] Adam29', '2023-06-13 04:43:36', ''),
(1729, '[Logged In] adam@gmail.com', '2023-06-13 04:43:48', ''),
(1730, '[Employee ClockIn]  ID 24', '2023-06-13 04:44:00', 'Adam29'),
(1731, '[Logged In] admin@admin.com', '2023-06-13 08:02:04', ''),
(1732, '[Jobsheets Doc Added]  DocId Test Fixes ComplaintId 82', '2023-06-13 08:18:55', 'admin'),
(1733, '[Jobsheets Added]  TaskId 82', '2023-06-13 08:18:55', 'admin'),
(1734, '[Jobsheets Doc Added]  DocId Test Fixes ComplaintId 83', '2023-06-13 08:21:58', 'admin'),
(1735, '[Jobsheets Added]  TaskId 83', '2023-06-13 08:21:58', 'admin'),
(1736, '[Jobsheets Doc Added]  DocId Test1 ComplaintId 84', '2023-06-13 08:25:07', 'admin'),
(1737, '[Jobsheets Added]  TaskId 84', '2023-06-13 08:25:07', 'admin'),
(1738, '[Logged In] adam@gmail.com', '2023-06-13 08:26:56', ''),
(1739, '[Logged In] admin@admin.com', '2023-06-13 08:28:46', ''),
(1740, '[Logged Out] Adam29', '2023-06-13 08:35:46', ''),
(1741, '[Logged In] testingjsoft@gmail.com', '2023-06-13 08:35:56', ''),
(1742, '[Logged Out] Prabhat', '2023-06-13 08:36:55', ''),
(1743, '[Logged In] adam@gmail.com', '2023-06-13 08:37:25', ''),
(1744, '[Logged Out] Adam29', '2023-06-13 08:39:19', ''),
(1745, '[Logged In] testingjsoft@gmail.com', '2023-06-13 08:39:28', ''),
(1746, '[Employee ClockIn]  ID 6', '2023-06-13 08:42:13', 'admin'),
(1747, '[Employee ClockIn]  ID 11', '2023-06-13 08:42:27', 'Prabhat'),
(1748, '[Employee Short Break Start]  ID 11', '2023-06-13 08:43:02', 'Prabhat'),
(1749, '[Employee Short Break End]  ID 11', '2023-06-13 08:43:03', 'Prabhat'),
(1750, '[Employee ClockOut]  ID 11', '2023-06-13 08:43:07', 'Prabhat'),
(1751, '[Logged In] admin@admin.com', '2023-06-13 08:49:52', ''),
(1752, '[Logged In] admin@admin.com', '2023-06-13 09:15:17', ''),
(1753, '[Logged Out] Prabhat', '2023-06-13 09:40:04', ''),
(1754, '[Logged In] adam@gmail.com', '2023-06-13 09:40:17', ''),
(1755, '[Jobsheets Doc Added]  DocId Test New fix ComplaintId 85', '2023-06-13 09:50:43', 'admin'),
(1756, '[Jobsheets Added]  TaskId 85', '2023-06-13 09:50:43', 'admin'),
(1757, '[Jobsheets Doc Added]  DocId TESSTTTT ComplaintId 86', '2023-06-13 09:54:19', 'admin'),
(1758, '[Jobsheets Added]  TaskId 86', '2023-06-13 09:54:19', 'admin'),
(1759, '[Logged In] admin@admin.com', '2023-06-13 09:59:52', ''),
(1760, '[Client Added] Sim ID 35', '2023-06-13 10:01:25', 'admin'),
(1761, '[Jobsheets Added]  TaskId 87', '2023-06-13 10:01:29', 'admin'),
(1762, '[Jobsheets Doc Added]  DocId Date test ComplaintId 88', '2023-06-13 10:01:47', 'admin'),
(1763, '[Jobsheets Added]  TaskId 88', '2023-06-13 10:01:47', 'admin'),
(1764, '[Logged In] adam@gmail.com', '2023-06-13 10:02:33', ''),
(1765, '[Logged Out] admin', '2023-06-13 10:40:49', ''),
(1766, '[Logged In] adam@gmail.com', '2023-06-13 10:41:00', ''),
(1767, '[Logged Out] Adam29', '2023-06-13 10:57:10', ''),
(1768, '[Logged In] admin@admin.com', '2023-06-13 10:57:18', ''),
(1769, '[Logged In] admin@admin.com', '2023-06-13 11:18:25', ''),
(1770, '[Logged In] admin@admin.com', '2023-06-13 11:51:33', ''),
(1771, '[Jobsheets Doc Added]  DocId Test Fix ComplaintId 89', '2023-06-13 11:55:36', 'admin'),
(1772, '[Jobsheets Added]  TaskId 89', '2023-06-13 11:55:36', 'admin'),
(1773, '[Logged In] adam@gmail.com', '2023-06-13 11:57:18', ''),
(1774, '[Logged In] adam@gmail.com', '2023-06-13 12:42:08', ''),
(1775, '[Logged In] adam@gmail.com', '2023-06-13 12:42:40', ''),
(1776, '[Logged In] admin@admin.com', '2023-06-13 12:44:02', ''),
(1777, '[Logged In] admin@admin.com', '2023-06-13 12:45:53', ''),
(1778, '[Logged In] admin@admin.com', '2023-06-13 14:35:55', ''),
(1779, '[Logged In] admin@admin.com', '2023-06-13 14:37:20', ''),
(1780, '[Logged In] adam@gmail.com', '2023-06-13 14:43:43', ''),
(1781, '[Jobsheets Doc Added]  DocId Server Replacement ComplaintId 90', '2023-06-13 15:21:59', 'admin'),
(1782, '[Jobsheets Added]  TaskId 90', '2023-06-13 15:21:59', 'admin'),
(1783, '[Jobsheets Doc Added]  DocId Server Replacement ComplaintId 91', '2023-06-13 15:23:38', 'admin'),
(1784, '[Jobsheets Added]  TaskId 91', '2023-06-13 15:23:38', 'admin'),
(1785, '[Logged In] admin@admin.com', '2023-06-13 22:10:01', ''),
(1786, '[Logged In] admin@admin.com', '2023-06-14 01:35:04', ''),
(1787, '[Logged In] admin@admin.com', '2023-06-14 02:35:39', ''),
(1788, '[New Product] -nasi lemak   -Qty-10 ID 2', '2023-06-14 02:39:46', 'admin'),
(1789, '[Update Product] -nasi lemak   -Qty-10 ID 2', '2023-06-14 02:40:16', 'admin'),
(1790, '[Update Product] -nasi lemak   -Qty-10 ID 2', '2023-06-14 02:42:38', 'admin'),
(1791, '[Update Product] -nasi lemak   -Qty-10 ID 2', '2023-06-14 02:42:58', 'admin'),
(1792, '[Payment Invoice 43]  Transaction-27 - 5 ', '2023-06-14 02:43:32', 'Shafeek Ajmal'),
(1793, '[New Product] -nasi goreng   -Qty-100 ID 3', '2023-06-14 03:13:46', 'admin'),
(1794, '[Update Product] -nasi goreng   -Qty-100 ID 3', '2023-06-14 03:15:50', 'admin'),
(1795, '[Logged In] admin@admin.com', '2023-06-14 03:28:24', ''),
(1796, '[Logged In] admin@admin.com', '2023-06-14 03:36:20', ''),
(1797, '[Logged Out] ', '2023-06-14 04:11:27', ''),
(1798, '[Logged In] adam@gmail.com', '2023-06-14 04:23:13', ''),
(1799, '[Logged In] admin@admin.com', '2023-06-14 04:46:25', ''),
(1800, '[Logged Out] Adam29', '2023-06-14 05:10:31', ''),
(1801, '[Logged In] testingjsoft@gmail.com', '2023-06-14 05:10:41', ''),
(1802, '[Employee ClockIn]  ID 11', '2023-06-14 05:10:44', 'Prabhat'),
(1803, '[Employee ClockOut]  ID 11', '2023-06-14 05:11:18', 'Prabhat'),
(1804, '[Logged Out] Prabhat', '2023-06-14 05:11:28', ''),
(1805, '[Logged In] admin@admin.com', '2023-06-14 05:15:29', ''),
(1806, '[Logged In] admin@admin.com', '2023-06-14 06:40:47', ''),
(1807, '[Logged In] admin@admin.com', '2023-06-14 06:48:02', ''),
(1808, '[Logged In] admin@admin.com', '2023-06-14 13:04:25', ''),
(1809, '[Logged Out] admin', '2023-06-14 13:13:42', ''),
(1810, '[Logged In] admin@admin.com', '2023-06-14 13:14:52', ''),
(1811, '[Logged Out] admin', '2023-06-14 13:15:47', ''),
(1812, '[Logged In] admin@admin.com', '2023-06-14 13:19:34', ''),
(1813, '[Logged Out] admin', '2023-06-14 13:19:39', ''),
(1814, '[Logged In] admin@admin.com', '2023-06-15 05:11:29', ''),
(1815, '[Logged In] admin@admin.com', '2023-06-15 05:26:47', ''),
(1816, '[Logged Out] admin', '2023-06-15 05:58:24', ''),
(1817, '[Logged In] admin@admin.com', '2023-06-15 05:59:50', ''),
(1818, '[Logged Out] admin', '2023-06-15 06:01:27', ''),
(1819, '[Logged In] reena@jsoftsolution.com.my', '2023-06-15 06:01:46', ''),
(1820, '[Logged Out] reena', '2023-06-15 06:02:54', ''),
(1821, '[Logged In] admin@admin.com', '2023-06-15 06:03:06', ''),
(1822, '[Logged Out] admin', '2023-06-15 06:05:24', ''),
(1823, '[Logged In] reena@jsoftsolution.com.my', '2023-06-15 06:06:03', ''),
(1824, '[Logged Out] reena', '2023-06-15 06:06:56', ''),
(1825, '[Logged Out] admin', '2023-06-15 06:07:38', ''),
(1826, '[Logged In] admin@admin.com', '2023-06-15 06:07:42', ''),
(1827, '[Logged Out] admin', '2023-06-15 06:19:43', ''),
(1828, '[Logged In] admin@admin.com', '2023-06-15 06:19:47', ''),
(1829, '[Logged In] admin@admin.com', '2023-06-15 06:33:56', ''),
(1830, '[Logged In] admin@admin.com', '2023-06-15 07:57:57', ''),
(1831, '[Employee ClockIn]  ID 6', '2023-06-15 08:07:43', 'admin'),
(1832, '[Logged In] admin@admin.com', '2023-06-15 08:35:53', ''),
(1833, '[Logged In] admin@admin.com', '2023-06-15 08:35:57', ''),
(1834, '[Logged In] admin@admin.com', '2023-06-15 08:36:11', ''),
(1835, '[Logged In] reena@jsoftsolution.com.my', '2023-06-15 08:36:14', ''),
(1836, '[Client Added] Benjamin ID 36', '2023-06-15 09:18:57', 'reena'),
(1837, '[Client Added] Vin ID 37', '2023-06-15 09:24:10', 'reena'),
(1838, '[Client Added] Esther Chan ID 38', '2023-06-15 09:27:18', 'reena'),
(1839, '[Client Added] Ivy Loh ID 39', '2023-06-15 09:32:48', 'reena'),
(1840, '[Client Added] Mohd Nor Azlan ID 40', '2023-06-15 09:36:40', 'reena'),
(1841, '[Logged In] admin@admin.com', '2023-06-15 11:23:07', ''),
(1842, '[Logged In] admin@admin.com', '2023-06-15 21:36:08', ''),
(1843, '[Logged In] admin@admin.com', '2023-06-16 01:58:05', ''),
(1844, '[Logged Out] admin', '2023-06-16 01:58:26', ''),
(1845, '[Logged In] adam@gmail.com', '2023-06-16 01:58:35', ''),
(1846, '[Logged Out] Adam29', '2023-06-16 02:00:20', ''),
(1847, '[Logged In] admin@admin.com', '2023-06-16 02:00:31', ''),
(1848, '[Logged In] adam@gmail.com', '2023-06-16 04:20:24', ''),
(1849, '[Logged In] admin@admin.com', '2023-06-16 05:44:15', ''),
(1850, '[Logged In] reena@jsoftsolution.com.my', '2023-06-16 06:31:18', ''),
(1851, '[Logged In] admin@admin.com', '2023-06-16 06:40:48', ''),
(1852, '[Logged In] adam@gmail.com', '2023-06-16 06:48:15', ''),
(1853, '[Employee ClockOut]  ID 24', '2023-06-16 06:50:05', 'Adam29'),
(1854, '[Logged Out] Adam29', '2023-06-16 06:50:11', ''),
(1855, '[Logged In] testingjsoft@gmail.com', '2023-06-16 06:50:37', ''),
(1856, '[Logged Out] Prabhat', '2023-06-16 06:50:41', ''),
(1857, '[Logged In] adam@gmail.com', '2023-06-16 06:50:58', ''),
(1858, '[Logged Out] Adam29', '2023-06-16 06:51:03', ''),
(1859, '[Logged In] adam@gmail.com', '2023-06-16 06:51:51', ''),
(1860, '[Logged In] admin@admin.com', '2023-06-16 07:23:13', ''),
(1861, '[Logged In] admin@admin.com', '2023-06-16 07:23:40', ''),
(1862, '[Logged Out] Adam29', '2023-06-16 07:31:06', ''),
(1863, '[Logged In] testingjsoft@gmail.com', '2023-06-16 07:31:15', ''),
(1864, '[Logged Out] admin', '2023-06-16 07:44:28', ''),
(1865, '[Logged In] adam@gmail.com', '2023-06-16 07:44:54', ''),
(1866, '[Logged In] admin@admin.com', '2023-06-16 07:50:31', ''),
(1867, '[Logged In] admin@admin.com', '2023-06-16 08:33:38', ''),
(1868, '[Logged In] admin@admin.com', '2023-06-16 08:49:14', ''),
(1869, '[Logged In] admin@admin.com', '2023-06-16 09:02:56', ''),
(1870, '[Logged In] admin@admin.com', '2023-06-16 09:03:25', ''),
(1871, '[Logged In] adam@gmail.com', '2023-06-16 10:05:08', ''),
(1872, '[Logged In] admin@admin.com', '2023-06-16 12:18:53', ''),
(1873, '[Logged In] admin@admin.com', '2023-06-19 01:49:38', ''),
(1874, '[Logged In] admin@admin.com', '2023-06-19 11:20:43', ''),
(1875, '[Update Product] -nasi goreng   -Qty-100 ID 3', '2023-06-19 11:21:34', 'admin'),
(1876, '[Logged Out] admin', '2023-06-19 11:21:44', ''),
(1877, '[Logged In] admin@admin.com', '2023-06-20 02:46:45', ''),
(1878, '[Logged In] adam@gmail.com', '2023-06-20 02:48:11', ''),
(1879, '[Employee ClockIn]  ID 24', '2023-06-20 02:48:32', 'Adam29'),
(1880, '[Employee ClockOut]  ID 24', '2023-06-20 02:49:01', 'Adam29'),
(1881, '[Logged Out] Adam29', '2023-06-20 02:49:03', ''),
(1882, '[Logged In] testingjsoft@gmail.com', '2023-06-20 02:49:13', ''),
(1883, '[Employee ClockIn]  ID 11', '2023-06-20 02:49:23', 'Prabhat'),
(1884, '[Employee ClockIn]  ID 6', '2023-06-20 02:49:38', 'admin'),
(1885, '[Employee ClockOut]  ID 11', '2023-06-20 03:19:11', 'Prabhat'),
(1886, '[Logged Out] Prabhat', '2023-06-20 03:19:27', ''),
(1887, '[Logged In] adam@gmail.com', '2023-06-20 03:19:36', ''),
(1888, '[Logged In] admin@admin.com', '2023-06-20 07:01:53', ''),
(1889, '[Logged In] admin@admin.com', '2023-06-20 07:17:45', ''),
(1890, '[Logged Out] ', '2023-06-20 12:01:34', ''),
(1891, '[Logged Out] ', '2023-06-20 12:01:44', ''),
(1892, '[Logged In] adam@gmail.com', '2023-06-20 12:01:54', ''),
(1893, '[Logged In] admin@admin.com', '2023-06-20 12:02:03', ''),
(1894, '[Employee ClockIn]  ID 24', '2023-06-20 12:02:11', 'Adam29'),
(1895, '[Employee Short Break Start]  ID 6', '2023-06-20 12:03:36', 'admin'),
(1896, '[Employee ClockIn]  ID 6', '2023-06-20 12:04:05', 'admin'),
(1897, '[Employee Short Break End]  ID 6', '2023-06-20 12:04:21', 'admin'),
(1898, '[Employee ClockIn]  ID 6', '2023-06-20 12:04:24', 'admin'),
(1899, '[Employee Short Break Start]  ID 24', '2023-06-20 12:04:48', 'Adam29'),
(1900, '[Employee Short Break End]  ID 24', '2023-06-20 12:04:49', 'Adam29'),
(1901, '[Employee Away Start]  ID 24', '2023-06-20 12:04:50', 'Adam29'),
(1902, '[Employee Away End]  ID 24', '2023-06-20 12:04:51', 'Adam29'),
(1903, '[Employee Lunch Break Start]  ID 24', '2023-06-20 12:04:52', 'Adam29'),
(1904, '[Employee Lunch Break End]  ID 24', '2023-06-20 12:04:54', 'Adam29'),
(1905, '[Employee Short Break Start]  ID 6', '2023-06-20 12:05:15', 'admin'),
(1906, '[Employee ClockIn]  ID 6', '2023-06-20 12:05:17', 'admin'),
(1907, '[Employee Short Break End]  ID 6', '2023-06-20 12:05:48', 'admin'),
(1908, '[Employee ClockIn]  ID 6', '2023-06-20 12:07:08', 'admin'),
(1909, '[Employee Short Break Start]  ID 6', '2023-06-20 12:07:19', 'admin'),
(1910, '[Employee Short Break Start]  ID 24', '2023-06-20 12:07:32', 'Adam29'),
(1911, '[Employee Short Break End]  ID 24', '2023-06-20 12:07:35', 'Adam29'),
(1912, '[Employee Lunch Break Start]  ID 24', '2023-06-20 12:07:36', 'Adam29'),
(1913, '[Employee Lunch Break End]  ID 24', '2023-06-20 12:07:37', 'Adam29'),
(1914, '[Employee Away Start]  ID 24', '2023-06-20 12:07:38', 'Adam29'),
(1915, '[Employee Away End]  ID 24', '2023-06-20 12:07:39', 'Adam29'),
(1916, '[Employee ClockIn]  ID 6', '2023-06-20 12:07:43', 'admin'),
(1917, '[Employee Short Break End]  ID 6', '2023-06-20 12:07:51', 'admin'),
(1918, '[Employee ClockIn]  ID 6', '2023-06-20 12:07:53', 'admin'),
(1919, '[Employee ClockOut]  ID 24', '2023-06-20 12:09:32', 'Adam29'),
(1920, '[Employee ClockIn]  ID 24', '2023-06-20 12:09:35', 'Adam29'),
(1921, '[Employee Short Break Start]  ID 6', '2023-06-20 12:09:55', 'admin'),
(1922, '[Employee ClockIn]  ID 6', '2023-06-20 12:09:57', 'admin'),
(1923, '[Employee Short Break End]  ID 6', '2023-06-20 12:10:08', 'admin'),
(1924, '[Employee ClockOut]  ID 24', '2023-06-20 13:50:24', 'Adam29'),
(1925, '[Employee ClockIn]  ID 24', '2023-06-20 13:50:31', 'Adam29'),
(1926, '[Employee Short Break Start]  ID 24', '2023-06-20 13:50:44', 'admin'),
(1927, '[Employee Short Break End]  ID 24', '2023-06-20 13:50:45', 'admin'),
(1928, '[Employee Away Start]  ID 24', '2023-06-20 13:50:46', 'admin'),
(1929, '[Employee Away End]  ID 24', '2023-06-20 13:50:48', 'admin'),
(1930, '[Employee Lunch Break Start]  ID 24', '2023-06-20 13:50:50', 'admin'),
(1931, '[Employee Lunch Break End]  ID 24', '2023-06-20 13:50:53', 'admin'),
(1932, '[Employee Short Break Start]  ID 24', '2023-06-20 13:51:30', 'admin'),
(1933, '[Employee Short Break End]  ID 24', '2023-06-20 13:51:35', 'Adam29'),
(1934, '[Employee ClockOut]  ID 24', '2023-06-20 13:52:04', 'Adam29'),
(1935, '[Employee ClockIn]  ID 6', '2023-06-20 13:52:21', 'admin'),
(1936, '[Logged In] admin@admin.com', '2023-06-20 14:05:43', ''),
(1937, '[Logged In] adam@gmail.com', '2023-06-20 14:06:12', ''),
(1938, '[Employee ClockIn]  ID 6', '2023-06-20 14:06:48', 'admin'),
(1939, '[Employee ClockIn]  ID 6', '2023-06-20 14:06:57', 'admin'),
(1940, '[Employee ClockIn]  ID 24', '2023-06-20 14:07:11', 'Adam29'),
(1941, '[Employee ClockOut]  ID 24', '2023-06-20 14:07:44', 'Adam29'),
(1942, '[Employee ClockIn]  ID 24', '2023-06-20 14:11:58', 'admin'),
(1943, '[Employee ClockOut]  ID 24', '2023-06-20 14:12:06', 'admin'),
(1944, '[Employee ClockIn]  ID 24', '2023-06-20 14:12:20', 'admin'),
(1945, '[Employee Away Start]  ID 24', '2023-06-20 14:14:10', 'admin'),
(1946, '[Employee Away End]  ID 24', '2023-06-20 14:14:12', 'admin'),
(1947, '[Employee Lunch Break Start]  ID 24', '2023-06-20 14:14:14', 'admin'),
(1948, '[Employee Lunch Break End]  ID 24', '2023-06-20 14:14:15', 'admin'),
(1949, '[Employee ClockOut]  ID 24', '2023-06-20 14:14:17', 'admin'),
(1950, '[Logged In] admin@admin.com', '2023-06-20 22:34:53', ''),
(1951, '[Jobsheets Added]  TaskId 92', '2023-06-20 22:59:46', 'admin'),
(1952, '[Logged Out] admin', '2023-06-20 23:00:09', ''),
(1953, '[Logged In] admin@admin.com', '2023-06-20 23:00:43', ''),
(1954, '[Logged Out] admin', '2023-06-20 23:02:18', ''),
(1955, '[Logged In] admin@admin.com', '2023-06-20 23:03:02', ''),
(1956, '[Logged Out] admin', '2023-06-20 23:04:11', ''),
(1957, '[Logged In] jenifer@gmail.com', '2023-06-20 23:04:21', ''),
(1958, '[Logged Out] jenifer', '2023-06-20 23:06:28', ''),
(1959, '[Logged In] admin@admin.com', '2023-06-20 23:06:35', ''),
(1960, '[Logged Out] admin', '2023-06-20 23:07:08', ''),
(1961, '[Logged In] jenifer@gmail.com', '2023-06-20 23:07:26', ''),
(1962, '[Logged Out] jenifer', '2023-06-20 23:07:52', ''),
(1963, '[Logged In] admin@admin.com', '2023-06-20 23:08:07', ''),
(1964, '[Logged Out] admin', '2023-06-20 23:30:08', ''),
(1965, '[Logged In] jenifer@gmail.com', '2023-06-20 23:30:22', ''),
(1966, '[Employee ClockIn]  ID 27', '2023-06-20 23:30:28', 'jenifer'),
(1967, '[Employee Short Break Start]  ID 27', '2023-06-20 23:30:51', 'jenifer'),
(1968, '[Employee Short Break End]  ID 27', '2023-06-20 23:31:06', 'jenifer'),
(1969, '[Employee Lunch Break Start]  ID 27', '2023-06-20 23:31:14', 'jenifer'),
(1970, '[Employee Lunch Break End]  ID 27', '2023-06-20 23:31:20', 'jenifer'),
(1971, '[Employee Away Start]  ID 27', '2023-06-20 23:31:26', 'jenifer'),
(1972, '[Employee Away End]  ID 27', '2023-06-20 23:31:31', 'jenifer'),
(1973, '[Employee ClockOut]  ID 27', '2023-06-20 23:31:42', 'jenifer'),
(1974, '[Logged Out] jenifer', '2023-06-20 23:34:18', ''),
(1975, '[Logged In] admin@admin.com', '2023-06-20 23:34:26', ''),
(1976, '[Logged In] admin@admin.com', '2023-06-21 01:32:59', ''),
(1977, '[Logged In] adam@gmail.com', '2023-06-21 02:05:39', ''),
(1978, '[Employee ClockIn]  ID 24', '2023-06-21 02:05:55', 'Adam29'),
(1979, '[Logged In] admin@admin.com', '2023-06-21 02:26:40', ''),
(1980, '[Payment Invoice 53]  Transaction-32 - 18 ', '2023-06-21 02:31:02', 'Shafeek Ajmal'),
(1981, '[Logged In] reena@jsoftsolution.com.my', '2023-06-21 02:32:30', ''),
(1982, '[Logged Out] admin', '2023-06-21 04:07:23', ''),
(1983, '[Logged In] admin@admin.com', '2023-06-21 04:07:34', ''),
(1984, '[Employee ClockOut]  ID 24', '2023-06-21 04:14:44', 'admin'),
(1985, '[Logged In] adam@gmail.com', '2023-06-21 04:15:09', ''),
(1986, '[Employee ClockIn]  ID 24', '2023-06-21 04:15:21', 'admin'),
(1987, '[Employee ClockOut]  ID 24', '2023-06-21 04:15:38', 'admin'),
(1988, '[Logged Out] ', '2023-06-21 06:31:41', ''),
(1989, '[Logged In] admin@admin.com', '2023-06-21 06:36:52', ''),
(1990, '[Jobsheets Doc Added]  DocId Test status ComplaintId 93', '2023-06-21 06:45:26', 'admin'),
(1991, '[Jobsheets Added]  TaskId 93', '2023-06-21 06:45:26', 'admin'),
(1992, '[Logged In] adam@gmail.com', '2023-06-21 06:46:02', ''),
(1993, '[Employee ClockIn]  ID 24', '2023-06-21 06:52:26', 'Adam29'),
(1994, '[Employee ClockOut]  ID 24', '2023-06-21 06:52:45', 'admin'),
(1995, '[Employee ClockIn]  ID 24', '2023-06-21 06:58:10', 'admin'),
(1996, '[Logged In] admin@admin.com', '2023-06-21 06:58:52', ''),
(1997, '[Employee ClockOut]  ID 24', '2023-06-21 07:12:24', 'admin'),
(1998, '[Employee ClockIn]  ID 24', '2023-06-21 07:13:45', 'admin'),
(1999, '[Employee Short Break Start]  ID 24', '2023-06-21 07:13:58', 'admin'),
(2000, '[Employee Short Break End]  ID 24', '2023-06-21 07:14:24', 'admin'),
(2001, '[Employee Lunch Break Start]  ID 24', '2023-06-21 07:14:25', 'admin'),
(2002, '[Employee Lunch Break End]  ID 24', '2023-06-21 07:14:42', 'admin'),
(2003, '[Employee Away Start]  ID 24', '2023-06-21 07:14:44', 'admin'),
(2004, '[Employee Away End]  ID 24', '2023-06-21 07:15:01', 'admin'),
(2005, '[Employee ClockOut]  ID 24', '2023-06-21 07:15:03', 'admin'),
(2006, '[Employee ClockIn]  ID 24', '2023-06-21 07:19:42', 'admin'),
(2007, '[Employee Short Break Start]  ID 24', '2023-06-21 07:20:08', 'admin'),
(2008, '[Employee Short Break End]  ID 24', '2023-06-21 07:20:32', 'admin'),
(2009, '[Logged Out] Adam29', '2023-06-21 07:27:42', ''),
(2010, '[Logged In] testingjsoft@gmail.com', '2023-06-21 07:27:53', ''),
(2011, '[Employee ClockIn]  ID 11', '2023-06-21 07:28:02', 'Prabhat'),
(2012, '[Employee Short Break Start]  ID 11', '2023-06-21 07:28:29', 'admin'),
(2013, '[Logged Out] Prabhat', '2023-06-21 07:36:13', ''),
(2014, '[Logged In] alvin@gmail.com', '2023-06-21 07:36:28', ''),
(2015, '[Employee ClockIn]  ID 28', '2023-06-21 07:36:32', 'Alvin'),
(2016, '[Employee ClockOut]  ID 24', '2023-06-21 07:36:48', 'admin'),
(2017, '[Employee Short Break Start]  ID 28', '2023-06-21 07:36:58', 'admin'),
(2018, '[Employee Short Break End]  ID 28', '2023-06-21 07:37:08', 'admin'),
(2019, '[Employee Away Start]  ID 28', '2023-06-21 07:37:22', 'admin'),
(2020, '[Employee ClockOut]  ID 11', '2023-06-21 07:37:38', 'admin'),
(2021, '[Employee ClockOut]  ID 28', '2023-06-21 07:37:47', 'admin'),
(2022, '[Employee ClockIn]  ID 28', '2023-06-21 07:40:34', 'Alvin'),
(2023, '[Employee Away End]  ID 28', '2023-06-21 07:40:40', 'Alvin'),
(2024, '[Employee ClockOut]  ID 28', '2023-06-21 07:40:45', 'Alvin'),
(2025, '[Employee ClockIn]  ID 28', '2023-06-21 07:40:46', 'Alvin'),
(2026, '[Employee Away Start]  ID 28', '2023-06-21 07:40:48', 'Alvin'),
(2027, '[Employee ClockOut]  ID 28', '2023-06-21 07:40:49', 'Alvin'),
(2028, '[Employee ClockIn]  ID 28', '2023-06-21 07:40:52', 'Alvin'),
(2029, '[Employee Away End]  ID 28', '2023-06-21 07:40:53', 'Alvin'),
(2030, '[Jobsheets Doc Added]  DocId Test Status ComplaintId 94', '2023-06-21 08:08:16', 'admin'),
(2031, '[Jobsheets Added]  TaskId 94', '2023-06-21 08:08:16', 'admin'),
(2032, '[Jobsheets Doc Added]  DocId Test ComplaintId 95', '2023-06-21 08:09:18', 'admin'),
(2033, '[Jobsheets Added]  TaskId 95', '2023-06-21 08:09:18', 'admin'),
(2034, '[Employee ClockOut]  ID 28', '2023-06-21 08:10:36', 'Alvin'),
(2035, '[Jobsheets Doc Added]  DocId Test 2 ComplaintId 96', '2023-06-21 08:32:46', 'admin'),
(2036, '[Jobsheets Added]  TaskId 96', '2023-06-21 08:32:46', 'admin'),
(2037, '[Logged In] alvin@gmail.com', '2023-06-21 08:33:30', ''),
(2038, '[Logged In] admin@admin.com', '2023-06-21 08:41:16', ''),
(2039, '[Logged In] admin@admin.com', '2023-06-21 09:33:01', ''),
(2040, '[Logged In] admin@admin.com', '2023-06-21 10:42:41', ''),
(2041, '[Jobsheets Doc Added]  DocId test ComplaintId 97', '2023-06-21 10:45:15', 'admin'),
(2042, '[Jobsheets Added]  TaskId 97', '2023-06-21 10:45:15', 'admin'),
(2043, '[Employee ClockIn]  ID 28', '2023-06-21 10:49:20', 'admin'),
(2044, '[Employee ClockOut]  ID 28', '2023-06-21 10:49:22', 'admin'),
(2045, '[Logged In] admin@admin.com', '2023-06-21 11:01:04', ''),
(2046, '[Employee ClockIn]  ID 28', '2023-06-21 11:16:47', 'admin'),
(2047, '[Employee Short Break Start]  ID 28', '2023-06-21 11:16:48', 'admin'),
(2048, '[Employee Short Break End]  ID 28', '2023-06-21 11:17:04', 'admin'),
(2049, '[Logged In] admin@admin.com', '2023-06-21 11:47:02', ''),
(2050, '[Logged Out] admin', '2023-06-21 11:49:33', ''),
(2051, '[Logged In] adam@gmail.com', '2023-06-21 11:49:46', ''),
(2052, '[Logged Out] Adam29', '2023-06-21 11:49:58', ''),
(2053, '[Logged In] admin@admin.com', '2023-06-21 12:08:54', ''),
(2054, '[Logged In] alvin@gmail.com', '2023-06-21 12:55:43', ''),
(2055, '[Employee ClockOut]  ID 28', '2023-06-21 12:56:20', 'Alvin'),
(2056, '[Logged Out] Alvin', '2023-06-21 12:56:22', ''),
(2057, '[Logged In] admin@admin.com', '2023-06-21 12:57:05', ''),
(2058, '[Employee ClockIn]  ID 28', '2023-06-21 12:58:15', 'admin'),
(2059, '[Employee Away Start]  ID 28', '2023-06-21 12:58:26', 'admin'),
(2060, '[Employee Away End]  ID 28', '2023-06-21 12:58:37', 'admin'),
(2061, '[Logged In] alvin@gmail.com', '2023-06-21 12:59:27', ''),
(2062, '[Logged In] alvin@gmail.com', '2023-06-21 12:59:36', ''),
(2063, '[Logged Out] admin', '2023-06-21 12:59:42', ''),
(2064, '[Logged In] alvin@gmail.com', '2023-06-21 13:00:01', ''),
(2065, '[Logged Out] Alvin', '2023-06-21 13:00:11', ''),
(2066, '[Logged In] alvin@gmail.com', '2023-06-21 13:00:19', ''),
(2067, '[Employee ClockOut]  ID 28', '2023-06-21 13:27:54', 'Alvin'),
(2068, '[Logged Out] Alvin', '2023-06-21 13:27:57', ''),
(2069, '[Logged In] admin@admin.com', '2023-06-21 13:28:07', ''),
(2070, '[Employee ClockIn]  ID 28', '2023-06-21 13:36:44', 'admin'),
(2071, '[Employee Lunch Break Start]  ID 28', '2023-06-21 13:36:52', 'admin'),
(2072, '[Employee Lunch Break End]  ID 28', '2023-06-21 13:36:58', 'admin'),
(2073, '[Employee Away Start]  ID 28', '2023-06-21 13:36:59', 'admin'),
(2074, '[Employee Away End]  ID 28', '2023-06-21 13:37:09', 'admin'),
(2075, '[Employee ClockOut]  ID 28', '2023-06-21 13:37:11', 'admin'),
(2076, '[Jobsheets Doc Added]  DocId Test  ComplaintId 98', '2023-06-21 14:48:06', 'admin'),
(2077, '[Jobsheets Added]  TaskId 98', '2023-06-21 14:48:06', 'admin'),
(2078, '[Logged In] alvin@gmail.com', '2023-06-21 14:55:42', ''),
(2079, '[Logged In] admin@admin.com', '2023-06-22 01:29:11', ''),
(2080, '[Logged In] admin@admin.com', '2023-06-22 01:42:29', ''),
(2081, '[Logged In] admin@admin.com', '2023-06-22 02:05:04', ''),
(2082, '[Employee ClockIn]  ID 28', '2023-06-22 02:05:26', 'admin'),
(2083, '[Employee Short Break Start]  ID 28', '2023-06-22 02:05:27', 'admin'),
(2084, '[Employee Short Break End]  ID 28', '2023-06-22 02:05:31', 'admin'),
(2085, '[Employee ClockOut]  ID 28', '2023-06-22 02:14:17', 'admin'),
(2086, '[Logged In] admin@admin.com', '2023-06-22 02:38:33', ''),
(2087, '[Logged In] admin@admin.com', '2023-06-22 05:09:32', ''),
(2088, '[Logged In] admin@admin.com', '2023-06-22 08:18:54', ''),
(2089, '[Logged In] admin@admin.com', '2023-06-22 09:54:06', ''),
(2090, '[Employee ClockIn]  ID 28', '2023-06-22 09:54:29', 'admin'),
(2091, '[Employee Away Start]  ID 28', '2023-06-22 09:54:31', 'admin'),
(2092, '[Employee Away End]  ID 28', '2023-06-22 09:54:40', 'admin'),
(2093, '[Employee ClockOut]  ID 28', '2023-06-22 09:54:42', 'admin'),
(2094, '[Logged In] admin@admin.com', '2023-06-22 12:39:59', ''),
(2095, '[Logged In] admin@admin.com', '2023-06-22 20:51:07', ''),
(2096, '[Employee ClockIn]  ID 24', '2023-06-22 20:51:49', 'admin'),
(2097, '[Employee Short Break Start]  ID 24', '2023-06-22 20:51:52', 'admin'),
(2098, '[Employee Short Break End]  ID 24', '2023-06-22 20:52:13', 'admin'),
(2099, '[Employee Lunch Break Start]  ID 24', '2023-06-22 20:52:19', 'admin'),
(2100, '[Employee Lunch Break End]  ID 24', '2023-06-22 20:55:13', 'admin'),
(2101, '[Logged In] admin@admin.com', '2023-06-22 20:55:42', ''),
(2102, '[Employee Short Break Start]  ID 24', '2023-06-22 20:55:52', 'admin'),
(2103, '[Logged Out] admin', '2023-06-22 20:55:58', ''),
(2104, '[Logged In] adam@gmail.com', '2023-06-22 20:56:05', ''),
(2105, '[Employee Short Break End]  ID 24', '2023-06-22 20:56:12', 'Adam29'),
(2106, '[Employee Short Break Start]  ID 24', '2023-06-22 20:56:24', 'Adam29'),
(2107, '[Logged In] admin@admin.com', '2023-06-23 02:39:22', ''),
(2108, '[Logged Out] admin', '2023-06-23 02:45:35', ''),
(2109, '[Logged In] alvin@gmail.com', '2023-06-23 02:45:48', ''),
(2110, '[Employee ClockIn]  ID 28', '2023-06-23 02:45:56', 'Alvin'),
(2111, '[Employee Short Break Start]  ID 28', '2023-06-23 02:45:58', 'Alvin'),
(2112, '[Employee Short Break End]  ID 28', '2023-06-23 02:46:01', 'Alvin'),
(2113, '[Employee Away Start]  ID 28', '2023-06-23 02:46:15', 'Alvin'),
(2114, '[Employee Away End]  ID 28', '2023-06-23 02:46:17', 'Alvin'),
(2115, '[Employee Lunch Break Start]  ID 28', '2023-06-23 02:46:25', 'Alvin'),
(2116, '[Employee Lunch Break End]  ID 28', '2023-06-23 02:46:27', 'Alvin'),
(2117, '[Employee Away Start]  ID 28', '2023-06-23 02:46:33', 'Alvin'),
(2118, '[Employee ClockOut]  ID 28', '2023-06-23 02:46:36', 'Alvin'),
(2119, '[Logged Out] Alvin', '2023-06-23 02:46:48', ''),
(2120, '[Logged In] admin@admin.com', '2023-06-23 03:01:29', ''),
(2121, '[Employee ClockIn]  ID 28', '2023-06-23 03:01:44', 'admin'),
(2122, '[Employee Away End]  ID 28', '2023-06-23 03:01:48', 'admin'),
(2123, '[Employee ClockOut]  ID 28', '2023-06-23 03:01:51', 'admin'),
(2124, '[Employee ClockIn]  ID 28', '2023-06-23 03:01:53', 'admin'),
(2125, '[Employee Short Break Start]  ID 28', '2023-06-23 03:01:56', 'admin'),
(2126, '[Employee Short Break End]  ID 28', '2023-06-23 03:01:57', 'admin'),
(2127, '[Employee Away Start]  ID 28', '2023-06-23 03:01:58', 'admin'),
(2128, '[Employee Away End]  ID 28', '2023-06-23 03:02:00', 'admin'),
(2129, '[Employee Lunch Break Start]  ID 28', '2023-06-23 03:02:01', 'admin'),
(2130, '[Employee Lunch Break End]  ID 28', '2023-06-23 03:02:02', 'admin'),
(2131, '[Employee ClockOut]  ID 28', '2023-06-23 03:06:50', 'admin'),
(2132, '[Logged In] admin@admin.com', '2023-06-23 03:58:52', ''),
(2133, '[Logged In] admin@admin.com', '2023-06-23 06:03:24', ''),
(2134, '[Jobsheets Added]  TaskId 99', '2023-06-23 07:59:35', 'admin'),
(2135, '[Logged In] alvin@gmail.com', '2023-06-23 08:00:11', ''),
(2136, '[Logged In] admin@admin.com', '2023-06-23 08:05:57', ''),
(2137, '[Logged In] admin@admin.com', '2023-06-23 12:52:46', ''),
(2138, '[Logged In] admin@admin.com', '2023-06-23 17:48:00', ''),
(2139, '[Logged In] admin@admin.com', '2023-06-23 21:50:27', ''),
(2140, '[Logged In] admin@admin.com', '2023-06-24 02:49:00', ''),
(2141, '[Employee ClockIn]  ID 6', '2023-06-24 02:51:32', 'admin'),
(2142, '[Logged Out] admin', '2023-06-24 02:59:16', ''),
(2143, '[Logged In] admin@admin.com', '2023-06-24 02:59:23', ''),
(2144, '[Logged In] admin@admin.com', '2023-06-24 04:33:45', ''),
(2145, '[Logged In] admin@admin.com', '2023-06-24 05:55:51', ''),
(2146, '[Logged In] admin@admin.com', '2023-06-24 05:56:20', ''),
(2147, '[Logged In] admin@admin.com', '2023-06-24 06:50:06', ''),
(2148, '[Logged In] admin@admin.com', '2023-06-24 07:43:49', ''),
(2149, '[Logged In] admin@admin.com', '2023-06-24 07:54:50', ''),
(2150, '[Logged In] admin@admin.com', '2023-06-24 08:03:27', ''),
(2151, '[Logged In] admin@admin.com', '2023-06-24 08:03:33', ''),
(2152, '[Logged In] admin@admin.com', '2023-06-24 08:03:35', ''),
(2153, '[Logged In] admin@admin.com', '2023-06-24 08:03:37', ''),
(2154, '[Logged In] admin@admin.com', '2023-06-24 08:03:39', ''),
(2155, '[Logged In] admin@admin.com', '2023-06-24 08:03:40', ''),
(2156, '[Logged In] admin@admin.com', '2023-06-24 08:03:45', ''),
(2157, '[Logged In] admin@admin.com', '2023-06-24 08:03:46', ''),
(2158, '[Logged In] admin@admin.com', '2023-06-24 08:03:49', ''),
(2159, '[Logged In] admin@admin.com', '2023-06-24 08:03:51', ''),
(2160, '[Logged In] admin@admin.com', '2023-06-24 08:04:24', ''),
(2161, '[Logged In] admin@admin.com', '2023-06-24 08:34:43', ''),
(2162, '[Logged In] admin@admin.com', '2023-06-25 23:25:31', ''),
(2163, '[Logged In] admin@admin.com', '2023-06-26 02:04:54', ''),
(2164, '[Logged Out] admin', '2023-06-26 03:09:05', ''),
(2165, '[Logged In] admin@admin.com', '2023-06-26 04:16:21', ''),
(2166, '[Logged In] admin@admin.com', '2023-06-26 04:40:17', ''),
(2167, '[Logged In] admin@admin.com', '2023-06-26 08:54:29', ''),
(2168, '[Logged In] admin@admin.com', '2023-06-26 09:22:34', ''),
(2169, '[Logged In] admin@admin.com', '2023-06-26 10:16:14', ''),
(2170, '[Logged In] admin@admin.com', '2023-06-26 10:16:29', ''),
(2171, '[Logged In] admin@admin.com', '2023-06-26 10:16:54', ''),
(2172, '[Logged In] admin@admin.com', '2023-06-26 10:17:05', ''),
(2173, '[Logged In] admin@admin.com', '2023-06-26 10:17:21', ''),
(2174, '[Logged In] admin@admin.com', '2023-06-26 10:23:16', ''),
(2175, '[Logged In] admin@admin.com', '2023-06-26 10:23:32', ''),
(2176, '[Logged In] admin@admin.com', '2023-06-26 10:36:36', ''),
(2177, '[Logged In] admin@admin.com', '2023-06-26 10:36:53', ''),
(2178, '[Logged In] admin@admin.com', '2023-06-26 10:37:58', ''),
(2179, '[Logged In] admin@admin.com', '2023-06-26 10:38:17', ''),
(2180, '[Logged In] admin@admin.com', '2023-06-26 10:38:26', ''),
(2181, '[Logged In] admin@admin.com', '2023-06-26 11:14:33', ''),
(2182, '[Logged In] admin@admin.com', '2023-06-26 11:48:12', ''),
(2183, '[Logged In] admin@admin.com', '2023-06-26 14:34:05', ''),
(2184, '[Logged In] admin@admin.com', '2023-06-26 23:36:25', ''),
(2185, '[Logged In] admin@admin.com', '2023-06-27 02:33:05', ''),
(2186, '[Logged In] admin@admin.com', '2023-06-27 04:27:48', ''),
(2187, '[Logged In] admin@admin.com', '2023-06-27 05:02:07', ''),
(2188, '[Logged In] admin@admin.com', '2023-06-27 08:02:10', ''),
(2189, '[Logged In] admin@admin.com', '2023-06-27 08:09:11', ''),
(2190, '[Payment Invoice 55]  Transaction-33 - 6 ', '2023-06-27 08:25:49', 'Shafeek Ajmal'),
(2191, '[Jobsheets Doc Added]  DocId Testing ComplaintId 100', '2023-06-27 08:27:35', 'admin'),
(2192, '[Jobsheets Added]  TaskId 100', '2023-06-27 08:27:35', 'admin'),
(2193, '[Logged Out] admin', '2023-06-27 08:31:01', ''),
(2194, '[Logged In] admin@admin.com', '2023-06-27 08:31:10', ''),
(2195, '[Logged Out] admin', '2023-06-27 08:31:21', ''),
(2196, '[Logged In] admin@admin.com', '2023-06-27 08:31:28', ''),
(2197, '[Logged In] alvin@gmail.com', '2023-06-27 08:48:56', ''),
(2198, '[Employee ClockIn]  ID 28', '2023-06-27 08:59:36', 'Alvin'),
(2199, '[Employee Short Break Start]  ID 28', '2023-06-27 08:59:49', 'Alvin'),
(2200, '[Employee Short Break End]  ID 28', '2023-06-27 08:59:51', 'Alvin'),
(2201, '[Employee Away Start]  ID 28', '2023-06-27 08:59:52', 'Alvin'),
(2202, '[Employee Away End]  ID 28', '2023-06-27 08:59:53', 'Alvin'),
(2203, '[Employee Away Start]  ID 28', '2023-06-27 08:59:56', 'Alvin'),
(2204, '[Logged In] admin@admin.com', '2023-06-27 09:37:58', ''),
(2205, '[Payment Invoice 56]  Transaction-34 - 11 ', '2023-06-27 09:41:07', 'Shafeek Ajmal'),
(2206, '[Employee Away End]  ID 28', '2023-06-27 10:08:23', 'Alvin'),
(2207, '[Employee ClockOut]  ID 28', '2023-06-27 10:08:29', 'Alvin'),
(2208, '[Logged In] admin@admin.com', '2023-06-27 10:08:43', ''),
(2209, '[Logged In] admin@admin.com', '2023-06-27 12:09:49', ''),
(2210, '[Logged In] admin@admin.com', '2023-06-28 02:02:35', ''),
(2211, '[Jobsheets Added]  TaskId 101', '2023-06-28 02:03:26', 'admin'),
(2212, '[Logged In] admin@admin.com', '2023-06-28 06:19:19', ''),
(2213, '[Logged In] admin@admin.com', '2023-06-28 09:24:15', ''),
(2214, '[Payment Invoice 57]  Transaction-35 - 11 ', '2023-06-28 09:24:22', 'Shafeek Ajmal'),
(2215, '[Logged In] admin@admin.com', '2023-06-28 09:27:31', ''),
(2216, '[Payment Invoice 58]  Transaction-36 - 11 ', '2023-06-28 09:27:38', 'Shafeek Ajmal'),
(2217, '[Logged In] admin@admin.com', '2023-06-28 09:30:06', ''),
(2218, '[Payment Invoice 59]  Transaction-37 - 11 ', '2023-06-28 09:30:14', 'Shafeek Ajmal'),
(2219, '[Payment Invoice 60]  Transaction-38 - 12 ', '2023-06-28 10:00:23', 'Shafeek Ajmal'),
(2220, '[Logged In] admin@admin.com', '2023-06-28 10:06:11', ''),
(2221, '[Payment Invoice 61]  Transaction-39 - 6 ', '2023-06-28 10:06:16', 'Shafeek Ajmal'),
(2222, '[Logged In] admin@admin.com', '2023-06-28 10:44:36', ''),
(2223, '[Payment Invoice 62]  Transaction-40 - 11 ', '2023-06-28 10:45:51', 'Shafeek Ajmal'),
(2224, '[Payment Invoice 63]  Transaction-41 - 6 ', '2023-06-28 10:51:59', 'Shafeek Ajmal'),
(2225, '[Logged In] admin@admin.com', '2023-06-29 05:50:02', ''),
(2226, '[Payment Invoice 64]  Transaction-42 - 6 ', '2023-06-29 05:50:27', 'Shafeek Ajmal'),
(2227, '[Payment Invoice 65]  Transaction-43 - 6 ', '2023-06-29 05:53:17', 'Shafeek Ajmal'),
(2228, '[Payment Invoice 67]  Transaction-44 - 6 ', '2023-06-29 05:57:00', 'Shafeek Ajmal'),
(2229, '[Logged In] admin@admin.com', '2023-06-29 18:22:46', ''),
(2230, '[Logged Out] admin', '2023-06-29 18:23:07', ''),
(2231, '[Logged In] admin@admin.com', '2023-06-29 21:18:50', ''),
(2232, '[Employee ClockIn]  ID 6', '2023-06-29 21:20:56', 'admin'),
(2233, '[Jobsheets Added]  TaskId 102', '2023-06-29 21:24:33', 'admin'),
(2234, '[Jobsheets Added]  TaskId 102', '2023-06-29 21:25:32', 'admin'),
(2235, '[Logged In] admin@admin.com', '2023-06-29 21:34:04', ''),
(2236, '[Logged In] admin@admin.com', '2023-06-29 21:34:09', ''),
(2237, '[Logged In] admin@admin.com', '2023-06-29 21:34:20', ''),
(2238, '[Logged In] admin@admin.com', '2023-06-29 22:59:03', ''),
(2239, '[Logged In] admin@admin.com', '2023-06-30 00:52:03', ''),
(2240, '[Logged In] admin@admin.com', '2023-06-30 01:56:09', ''),
(2241, '[Logged In] admin@admin.com', '2023-06-30 01:58:37', ''),
(2242, '[Logged Out] admin', '2023-06-30 02:32:34', ''),
(2243, '[Logged In] admin@admin.com', '2023-06-30 02:46:46', ''),
(2244, '[Logged In] admin@admin.com', '2023-06-30 02:49:09', ''),
(2245, '[Logged In] admin@admin.com', '2023-06-30 02:49:11', ''),
(2246, '[Logged In] admin@admin.com', '2023-06-30 02:49:53', ''),
(2247, '[Logged In] admin@admin.com', '2023-06-30 02:55:59', ''),
(2248, '[Logged In] admin@admin.com', '2023-06-30 03:01:11', ''),
(2249, '[Logged In] admin@admin.com', '2023-06-30 03:07:01', ''),
(2250, '[Logged In] admin@admin.com', '2023-06-30 09:36:26', ''),
(2251, '[Client Added] jsofttest ID 41', '2023-06-30 09:40:13', 'admin'),
(2252, '[Logged In] admin@admin.com', '2023-06-30 09:51:49', ''),
(2253, '[Logged In] admin@admin.com', '2023-06-30 09:52:04', ''),
(2254, '[Logged In] admin@admin.com', '2023-06-30 09:58:12', ''),
(2255, '[Logged In] admin@admin.com', '2023-06-30 09:58:27', ''),
(2256, '[Logged In] admin@admin.com', '2023-06-30 09:58:37', ''),
(2257, '[Logged In] admin@admin.com', '2023-06-30 09:58:50', ''),
(2258, '[Logged In] admin@admin.com', '2023-06-30 09:59:04', ''),
(2259, '[Logged In] admin@admin.com', '2023-06-30 10:08:03', ''),
(2260, '[Logged In] admin@admin.com', '2023-06-30 10:14:14', ''),
(2261, '[Logged In] admin@admin.com', '2023-06-30 10:45:33', ''),
(2262, '[Logged In] admin@admin.com', '2023-07-01 14:01:09', ''),
(2263, '[Logged In] admin@admin.com', '2023-07-01 14:03:16', ''),
(2264, '[Logged In] admin@admin.com', '2023-07-01 14:03:47', ''),
(2265, '[Logged In] admin@admin.com', '2023-07-02 01:01:32', ''),
(2266, '[Logged Out] admin', '2023-07-02 01:02:31', ''),
(2267, '[Logged In] admin@admin.com', '2023-07-03 01:50:14', ''),
(2268, '[Client Added] democlient ID 42', '2023-07-03 02:17:46', 'admin'),
(2269, '[Logged In] admin@admin.com', '2023-07-03 03:28:08', ''),
(2270, '[Logged Out] admin', '2023-07-03 03:36:29', ''),
(2271, '[Logged In] admin@admin.com', '2023-07-03 03:36:37', ''),
(2272, '[Logged In] admin@admin.com', '2023-07-03 06:52:21', ''),
(2273, '[Logged In] admin@admin.com', '2023-07-03 09:32:06', ''),
(2274, '[Logged Out] admin', '2023-07-03 11:07:30', ''),
(2275, '[Logged In] admin@admin.com', '2023-07-03 11:07:34', ''),
(2276, '[Logged In] admin@admin.com', '2023-07-03 11:12:10', ''),
(2277, '[Logged In] admin@admin.com', '2023-07-03 11:19:43', ''),
(2278, '[Logged In] admin@admin.com', '2023-07-03 12:53:52', ''),
(2279, '[Logged In] admin@admin.com', '2023-07-03 14:02:00', ''),
(2280, '[Logged In] admin@admin.com', '2023-07-03 22:30:49', ''),
(2281, '[Logged In] admin@admin.com', '2023-07-04 01:15:36', ''),
(2282, '[Logged In] admin@admin.com', '2023-07-04 03:26:54', ''),
(2283, '[Logged In] admin@admin.com', '2023-07-04 20:43:39', ''),
(2284, '[Logged In] admin@admin.com', '2023-07-05 04:36:48', ''),
(2285, '[Logged In] admin@admin.com', '2023-07-05 04:53:08', ''),
(2286, '[Logged In] admin@admin.com', '2023-07-05 05:17:28', ''),
(2287, '[Logged In] admin@admin.com', '2023-07-05 05:51:39', ''),
(2288, '[Payment Invoice 71]  Transaction-45 - 21 ', '2023-07-05 05:51:51', 'Shafeek Ajmal'),
(2289, '[Logged In] admin@admin.com', '2023-07-05 06:40:43', ''),
(2290, '[Logged In] admin@admin.com', '2023-07-05 06:41:08', ''),
(2291, '[Logged In] admin@admin.com', '2023-07-05 07:43:03', ''),
(2292, '[Logged In] admin@admin.com', '2023-07-05 08:15:29', ''),
(2293, '[Payment Invoice 72]  Transaction-46 - 47 ', '2023-07-05 08:15:41', 'Shafeek Ajmal'),
(2294, '[Logged In] admin@admin.com', '2023-07-05 09:04:30', ''),
(2295, '[Payment Invoice 73]  Transaction-47 - 52 ', '2023-07-05 09:04:38', 'Shafeek Ajmal'),
(2296, '[Logged In] admin@admin.com', '2023-07-05 10:30:36', ''),
(2297, '[Payment Invoice 75]  Transaction-48 - 78 ', '2023-07-05 10:31:50', 'Shafeek Ajmal'),
(2298, '[Payment Invoice 76]  Transaction-49 - 104 ', '2023-07-05 10:32:24', 'Shafeek Ajmal'),
(2299, '[Logged In] admin@admin.com', '2023-07-05 10:32:46', ''),
(2300, '[Payment Invoice 77]  Transaction-50 - 73 ', '2023-07-05 10:32:54', 'Shafeek Ajmal'),
(2301, '[Payment Invoice 78]  Transaction-51 - 26 ', '2023-07-05 10:33:39', 'Shafeek Ajmal'),
(2302, '[Logged In] admin@admin.com', '2023-07-05 14:26:46', ''),
(2303, '[Logged In] admin@admin.com', '2023-07-05 14:38:20', ''),
(2304, '[Employee ClockIn]  ID 6', '2023-07-05 14:38:40', 'admin'),
(2305, '[Employee ClockIn]  ID 6', '2023-07-05 14:38:51', 'admin'),
(2306, '[Logged In] alvin@gmail.com', '2023-07-05 14:39:39', ''),
(2307, '[Employee ClockIn]  ID 28', '2023-07-05 14:39:51', 'Alvin'),
(2308, '[Employee Short Break Start]  ID 28', '2023-07-05 14:40:22', 'Alvin'),
(2309, '[Employee Short Break End]  ID 28', '2023-07-05 14:40:28', 'Alvin'),
(2310, '[Employee Lunch Break Start]  ID 28', '2023-07-05 14:40:29', 'Alvin'),
(2311, '[Employee Lunch Break End]  ID 28', '2023-07-05 14:40:31', 'Alvin'),
(2312, '[Employee Away Start]  ID 28', '2023-07-05 14:40:32', 'Alvin'),
(2313, '[Employee Away End]  ID 28', '2023-07-05 14:40:33', 'Alvin'),
(2314, '[Employee ClockOut]  ID 28', '2023-07-05 14:40:36', 'Alvin');
INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(2315, '[Employee ClockIn]  ID 28', '2023-07-05 14:43:36', 'Alvin'),
(2316, '[Employee ClockOut]  ID 28', '2023-07-05 14:43:53', 'Alvin'),
(2317, '[Logged Out] Alvin', '2023-07-05 14:43:55', ''),
(2318, '[Jobsheets Added]  TaskId 103', '2023-07-05 14:45:08', 'admin'),
(2319, '[Logged In] alvin@gmail.com', '2023-07-05 14:45:41', ''),
(2320, '[Logged Out] Alvin', '2023-07-05 14:48:33', ''),
(2321, '[Logged In] admin@admin.com', '2023-07-05 18:39:03', ''),
(2322, '[Payment Invoice 79]  Transaction-52 - 125 ', '2023-07-05 18:39:23', 'Shafeek Ajmal'),
(2323, '[Logged In] admin@admin.com', '2023-07-05 22:59:56', ''),
(2324, '[Logged In] admin@admin.com', '2023-07-06 03:06:12', ''),
(2325, '[Logged In] admin@admin.com', '2023-07-06 05:08:27', ''),
(2326, '[Logged In] admin@admin.com', '2023-07-06 07:51:17', ''),
(2327, '[Payment Invoice 80]  Transaction-53 - 26 ', '2023-07-06 07:52:14', 'Shafeek Ajmal'),
(2328, '[Logged In] admin@admin.com', '2023-07-06 09:31:57', ''),
(2329, '[Client Added] Sparow ID 43', '2023-07-06 09:36:50', 'admin'),
(2330, '[Logged In] alvin@gmail.com', '2023-07-06 09:39:23', ''),
(2331, '[Jobsheets Added]  TaskId 103', '2023-07-06 09:43:42', 'admin'),
(2332, '[Logged In] admin@admin.com', '2023-07-07 01:41:14', ''),
(2333, '[Logged In] admin@admin.com', '2023-07-07 07:48:52', ''),
(2334, '[Logged In] admin@admin.com', '2023-07-07 14:05:46', ''),
(2335, '[Logged In] admin@admin.com', '2023-07-07 14:06:43', ''),
(2336, '[Logged In] admin@admin.com', '2023-07-07 22:05:08', ''),
(2337, '[Logged In] admin@admin.com', '2023-07-07 22:26:33', ''),
(2338, '[Logged In] admin@admin.com', '2023-07-08 11:22:57', ''),
(2339, '[Logged In] admin@admin.com', '2023-07-09 10:17:46', ''),
(2340, '[Logged In] admin@admin.com', '2023-07-10 02:38:22', ''),
(2341, '[Logged In] admin@admin.com', '2023-07-10 04:19:47', ''),
(2342, '[Logged In] admin@admin.com', '2023-07-10 05:06:09', ''),
(2343, '[Logged In] admin@admin.com', '2023-07-10 05:06:23', ''),
(2344, '[Logged In] admin@admin.com', '2023-07-10 05:19:19', ''),
(2345, '[Logged In] admin@admin.com', '2023-07-10 05:48:20', ''),
(2346, '[New Product] -Test coffee by siva  -Qty-50 ID 4', '2023-07-10 05:51:51', 'admin'),
(2347, '[Category Created] strong coffee ID 5', '2023-07-10 06:49:35', 'admin'),
(2348, '[New Product] -coffee new  -Qty-122 ID 5', '2023-07-10 06:50:13', 'admin'),
(2349, '[New Product] -Test coffe one  -Qty-200 ID 6', '2023-07-10 07:10:52', 'admin'),
(2350, '[Category Created] Medicines ID 6', '2023-07-10 07:29:01', 'admin'),
(2351, '[Category Created] Fever Meds ID 7', '2023-07-10 07:29:38', 'admin'),
(2352, '[New Product] -Dolo 650  -Qty-150 ID 7', '2023-07-10 07:31:02', 'admin'),
(2353, '[Logged In] admin@admin.com', '2023-07-10 09:21:08', ''),
(2354, '[Client Updated] Raj ID 11', '2023-07-10 09:22:21', 'admin'),
(2355, '[Client Updated] Raj ID 11', '2023-07-10 09:22:28', 'admin'),
(2356, '[Logged In] admin@admin.com', '2023-07-10 10:19:34', ''),
(2357, '[Logged Out] admin', '2023-07-10 10:20:00', ''),
(2358, '[Logged In] admin@admin.com', '2023-07-10 11:20:33', ''),
(2359, '[Logged In] admin@admin.com', '2023-07-10 11:35:14', ''),
(2360, '[Logged In] admin@admin.com', '2023-07-10 13:36:53', ''),
(2361, '[Payment Invoice 84]  Transaction-54 - 173.72 ', '2023-07-10 13:54:06', 'Shafeek Ajmal'),
(2362, '[Payment Invoice 85]  Transaction-55 - 219.42 ', '2023-07-10 15:02:12', 'Shafeek Ajmal'),
(2363, '[Logged In] admin@admin.com', '2023-07-10 23:27:28', ''),
(2364, '[Logged In] admin@admin.com', '2023-07-10 23:27:29', ''),
(2365, '[Logged In] admin@admin.com', '2023-07-11 01:45:10', ''),
(2366, '[Logged In] admin@admin.com', '2023-07-11 03:59:12', ''),
(2367, '[Logged In] admin@admin.com', '2023-07-11 04:12:26', ''),
(2368, '[Logged In] admin@admin.com', '2023-07-11 06:36:51', ''),
(2369, '[Logged In] admin@admin.com', '2023-07-11 07:32:25', ''),
(2370, '[Logged Out] admin', '2023-07-11 07:33:16', ''),
(2371, '[Logged In] admin@admin.com', '2023-07-11 08:37:17', ''),
(2372, '[Logged In] admin@admin.com', '2023-07-11 08:58:58', ''),
(2373, '[Logged In] admin@admin.com', '2023-07-11 11:07:01', ''),
(2374, '[Logged Out] admin', '2023-07-11 11:33:24', ''),
(2375, '[Logged In] admin@admin.com', '2023-07-11 11:34:08', ''),
(2376, '[Logged In] admin@admin.com', '2023-07-11 12:04:32', ''),
(2377, '[Logged In] admin@admin.com', '2023-07-11 12:24:04', ''),
(2378, '[Logged In] admin@admin.com', '2023-07-11 12:36:14', ''),
(2379, '[Logged In] admin@admin.com', '2023-07-11 13:36:06', ''),
(2380, '[Logged In] admin@admin.com', '2023-07-11 13:36:36', ''),
(2381, '[Logged In] admin@admin.com', '2023-07-11 13:36:58', ''),
(2382, '[Logged In] admin@admin.com', '2023-07-11 20:27:52', ''),
(2383, '[Logged In] admin@admin.com', '2023-07-11 20:35:44', ''),
(2384, '[Logged In] admin@admin.com', '2023-07-12 01:18:19', ''),
(2385, '[Logged In] admin@admin.com', '2023-07-12 02:59:32', ''),
(2386, '[Logged In] admin@admin.com', '2023-07-12 03:30:11', ''),
(2387, '[Logged In] admin@admin.com', '2023-07-12 04:52:32', ''),
(2388, '[Logged In] admin@admin.com', '2023-07-12 06:17:47', ''),
(2389, '[Logged In] admin@admin.com', '2023-07-12 06:17:55', ''),
(2390, '[Logged In] admin@admin.com', '2023-07-12 06:52:13', ''),
(2391, '[Logged In] admin@admin.com', '2023-07-12 08:03:10', ''),
(2392, '[Client Added] testclientp ID 44', '2023-07-12 08:06:00', 'admin'),
(2393, '[Client Added] akerp ID 45', '2023-07-12 08:10:42', 'admin'),
(2394, '[Logged In] admin@admin.com', '2023-07-12 08:29:53', ''),
(2395, '[Logged In] admin@admin.com', '2023-07-12 08:54:22', ''),
(2396, '[Logged In] admin@admin.com', '2023-07-12 09:34:47', ''),
(2397, '[Logged In] admin@admin.com', '2023-07-12 01:59:03', ''),
(2398, '[Logged In] admin@admin.com', '2023-07-12 11:07:55', ''),
(2399, '[Logged In] admin@admin.com', '2023-07-12 11:08:08', ''),
(2400, '[Logged Out] ', '2023-07-12 11:14:49', ''),
(2401, '[Logged In] admin@admin.com', '2023-07-12 11:14:52', ''),
(2402, '[Logged In] admin@admin.com', '2023-07-12 11:15:10', ''),
(2403, '[Logged Out] admin', '2023-07-12 11:48:45', ''),
(2404, '[Logged In] steve@gmail.com', '2023-07-12 11:48:59', ''),
(2405, '[Logged Out] Steve19', '2023-07-12 11:50:30', ''),
(2406, '[Logged In] admin@admin.com', '2023-07-12 11:50:38', ''),
(2407, '[Logged Out] admin', '2023-07-12 11:51:02', ''),
(2408, '[Logged In] alfred@gmail.com', '2023-07-12 11:51:25', ''),
(2409, '[Logged In] alfred@gmail.com', '2023-07-12 11:52:23', ''),
(2410, '[Logged In] admin@admin.com', '2023-07-12 11:53:35', ''),
(2411, '[Logged Out] admin', '2023-07-12 11:55:10', ''),
(2412, '[Logged In] steve@gmail.com', '2023-07-12 11:55:27', ''),
(2413, '[Logged Out] Steve19', '2023-07-12 11:55:34', ''),
(2414, '[Logged In] admin@admin.com', '2023-07-12 11:56:02', ''),
(2415, '[Logged Out] admin', '2023-07-12 11:56:16', ''),
(2416, '[Logged In] admin@admin.com', '2023-07-12 11:56:21', ''),
(2417, '[Logged In] admin@admin.com', '2023-07-12 11:59:11', ''),
(2418, '[Logged Out] admin', '2023-07-12 12:00:40', ''),
(2419, '[Logged In] steve@gmail.com', '2023-07-12 12:01:27', ''),
(2420, '[Logged In] admin@admin.com', '2023-07-12 12:41:05', ''),
(2421, '[Logged In] admin@admin.com', '2023-07-12 12:55:40', ''),
(2422, '[Logged In] admin@admin.com', '2023-07-12 12:56:18', ''),
(2423, '[Client Added] DEXTOR SDN BHD ID 46', '2023-07-12 13:07:47', 'admin'),
(2424, '[Client Deleted]  ID 46', '2023-07-12 13:08:05', 'admin'),
(2425, '[Client Doc Deleted]  DocId 46 CID 46', '2023-07-12 13:08:05', 'admin'),
(2426, '[Client Added] Kali D ID 47', '2023-07-12 13:13:40', 'admin'),
(2427, '[Logged Out] admin', '2023-07-12 13:14:29', ''),
(2428, '[Logged In] admin@admin.com', '2023-07-12 13:16:23', ''),
(2429, '[Logged Out] admin', '2023-07-12 13:17:18', ''),
(2430, '[Logged In] admin@admin.com', '2023-07-12 13:18:35', ''),
(2431, '[Client Added] DEXTER SDN BHD ID 48', '2023-07-12 13:19:49', 'admin'),
(2432, '[Logged Out] admin', '2023-07-12 13:19:54', ''),
(2433, '[Logged In] admin@admin.com', '2023-07-12 13:21:27', ''),
(2434, '[Logged In] admin@admin.com', '2023-07-13 06:56:34', ''),
(2435, '[Logged In] admin@admin.com', '2023-07-13 10:57:34', ''),
(2436, '[Logged In] admin@admin.com', '2023-07-13 11:12:56', ''),
(2437, '[Logged In] admin@admin.com', '2023-07-13 11:24:41', ''),
(2438, '[Logged In] admin@admin.com', '2023-07-13 15:13:02', ''),
(2439, '[Logged In] admin@admin.com', '2023-07-13 19:50:11', ''),
(2440, '[Logged In] admin@admin.com', '2023-07-14 01:09:13', ''),
(2441, '[Logged In] admin@admin.com', '2023-07-14 01:19:35', ''),
(2442, '[Logged In] admin@admin.com', '2023-07-14 05:47:22', ''),
(2443, '[Logged In] admin@admin.com', '2023-07-14 06:04:28', ''),
(2444, '[Logged Out] admin', '2023-07-14 06:15:30', ''),
(2445, '[Logged In] admin@admin.com', '2023-07-14 06:15:38', ''),
(2446, '[Logged In] admin@admin.com', '2023-07-14 06:30:01', ''),
(2447, '[Logged In] admin@admin.com', '2023-07-14 06:30:11', ''),
(2448, '[Logged In] admin@admin.com', '2023-07-14 06:30:26', ''),
(2449, '[Logged In] admin@admin.com', '2023-07-14 06:31:16', ''),
(2450, '[Logged In] admin@admin.com', '2023-07-14 06:49:57', ''),
(2451, '[Logged In] admin@admin.com', '2023-07-14 06:50:12', ''),
(2452, '[Logged In] admin@admin.com', '2023-07-14 07:26:28', ''),
(2453, '[Logged In] admin@admin.com', '2023-07-14 08:37:56', ''),
(2454, '[Logged In] admin@admin.com', '2023-07-14 08:49:04', ''),
(2455, '[Logged In] admin@admin.com', '2023-07-14 08:51:09', ''),
(2456, '[Logged Out] admin', '2023-07-14 08:51:41', ''),
(2457, '[Logged In] admin@admin.com', '2023-07-14 08:52:13', ''),
(2458, '[Logged Out] admin', '2023-07-14 08:59:35', ''),
(2459, '[Logged In] admin@admin.com', '2023-07-14 09:00:47', ''),
(2460, '[Logged Out] admin', '2023-07-14 09:01:00', ''),
(2461, '[Logged In] steve@gmail.com', '2023-07-14 09:03:20', ''),
(2462, '[Logged Out] Steve19', '2023-07-14 09:04:49', ''),
(2463, '[Logged In] alfred@gmail.com', '2023-07-14 09:06:06', ''),
(2464, '[Logged In] admin@admin.com', '2023-07-14 09:07:19', ''),
(2465, '[Logged In] admin@admin.com', '2023-07-14 09:15:36', ''),
(2466, '[Logged In] admin@admin.com', '2023-07-14 09:27:01', ''),
(2467, '[Logged In] admin@admin.com', '2023-07-14 09:33:35', ''),
(2468, '[Logged In] admin@admin.com', '2023-07-14 09:44:16', ''),
(2469, '[Logged In] admin@admin.com', '2023-07-14 09:59:46', ''),
(2470, '[Logged In] admin@admin.com', '2023-07-14 10:25:45', ''),
(2471, '[Logged Out] admin', '2023-07-14 10:33:43', ''),
(2472, '[Logged In] admin@admin.com', '2023-07-14 10:45:32', ''),
(2473, '[Client Deleted]  ID 52', '2023-07-14 10:56:13', 'admin'),
(2474, '[Client Doc Deleted]  DocId 52 CID 52', '2023-07-14 10:56:13', 'admin'),
(2475, '[Logged In] admin@admin.com', '2023-07-14 11:53:00', ''),
(2476, '[Logged In] admin@admin.com', '2023-07-14 12:09:16', ''),
(2477, '[Logged In] admin@admin.com', '2023-07-14 13:27:46', ''),
(2478, '[Logged In] admin@admin.com', '2023-07-14 13:27:55', ''),
(2479, '[Logged In] admin@admin.com', '2023-07-14 13:43:54', ''),
(2480, '[Logged In] admin@admin.com', '2023-07-14 13:44:02', ''),
(2481, '[Client Added] PT WASTE RECYCLING INDUSTRY  ID 54', '2023-07-14 13:46:24', 'admin'),
(2482, '[Client Added] PT WASTE RECYCLING INDUSTRY  ID 55', '2023-07-14 13:46:41', 'admin'),
(2483, '[Client Added] PT WASTE RECYCLING INDUSTRY  ID 56', '2023-07-14 13:46:50', 'admin'),
(2484, '[Client Added] PT WASTE RECYCLING INDUSTRY  ID 57', '2023-07-14 13:46:51', 'admin'),
(2485, '[Client Added] PT WASTE RECYCLING INDUSTRY  ID 58', '2023-07-14 13:46:54', 'admin'),
(2486, '[Logged In] admin@admin.com', '2023-07-15 07:50:40', ''),
(2487, '[Logged In] admin@admin.com', '2023-07-15 08:18:08', ''),
(2488, '[Logged In] admin@admin.com', '2023-07-15 15:18:02', ''),
(2489, '[Logged In] admin@admin.com', '2023-07-16 05:41:14', ''),
(2490, '[Logged In] admin@admin.com', '2023-07-16 05:46:38', ''),
(2491, '[Logged In] admin@admin.com', '2023-07-17 02:13:08', ''),
(2492, '[Logged In] admin@admin.com', '2023-07-17 04:09:48', ''),
(2493, '[Logged In] admin@admin.com', '2023-07-17 06:05:27', ''),
(2494, '[Logged In] admin@admin.com', '2023-07-17 06:36:37', ''),
(2495, '[Logged In] admin@admin.com', '2023-07-17 06:36:41', ''),
(2496, '[Logged In] admin@admin.com', '2023-07-17 07:17:01', ''),
(2497, '[Jobsheets Added]  TaskId 104', '2023-07-17 08:06:52', 'admin'),
(2498, '[Logged In] admin@admin.com', '2023-07-17 08:46:05', ''),
(2499, '[Logged In] admin@admin.com', '2023-07-17 08:57:26', ''),
(2500, '[Logged In] admin@admin.com', '2023-07-17 09:37:11', ''),
(2501, '[Logged In] admin@admin.com', '2023-07-17 19:27:35', ''),
(2502, '[Jobsheets Added]  TaskId 105', '2023-07-17 19:29:52', 'admin'),
(2503, '[Logged In] admin@admin.com', '2023-07-18 02:24:51', ''),
(2504, '[Logged In] admin@admin.com', '2023-07-18 02:51:18', ''),
(2505, '[Logged In] admin@admin.com', '2023-07-18 07:38:34', ''),
(2506, '[Logged In] admin@admin.com', '2023-07-18 08:24:28', ''),
(2507, '[Client Added] Test ID 61', '2023-07-18 08:26:16', 'admin'),
(2508, '[Client Added] Test ID 62', '2023-07-18 08:26:25', 'admin'),
(2509, '[Client Added] Test ID 63', '2023-07-18 08:26:30', 'admin'),
(2510, '[Client Added] Test ID 64', '2023-07-18 08:26:33', 'admin'),
(2511, '[Client Added] Test ID 65', '2023-07-18 08:26:37', 'admin'),
(2512, '[Client Added] Test ID 66', '2023-07-18 08:26:42', 'admin'),
(2513, '[Client Added] Testoorr ID 67', '2023-07-18 08:26:55', 'admin'),
(2514, '[Client Added] Testoorr ID 68', '2023-07-18 08:27:00', 'admin'),
(2515, '[Client Added] Testoorr ID 69', '2023-07-18 08:27:06', 'admin'),
(2516, '[Client Added] Testoorr ID 70', '2023-07-18 08:27:08', 'admin'),
(2517, '[Client Added] Testoorr ID 71', '2023-07-18 08:27:09', 'admin'),
(2518, '[Client Added] Testoorr ID 72', '2023-07-18 08:27:47', 'admin'),
(2519, '[Client Deleted]  ID 61', '2023-07-18 08:28:56', 'admin'),
(2520, '[Client Doc Deleted]  DocId 61 CID 61', '2023-07-18 08:28:56', 'admin'),
(2521, '[Client Deleted]  ID 62', '2023-07-18 08:28:58', 'admin'),
(2522, '[Client Doc Deleted]  DocId 62 CID 62', '2023-07-18 08:28:58', 'admin'),
(2523, '[Client Deleted]  ID 63', '2023-07-18 08:29:07', 'admin'),
(2524, '[Client Doc Deleted]  DocId 63 CID 63', '2023-07-18 08:29:07', 'admin'),
(2525, '[Client Deleted]  ID 72', '2023-07-18 08:29:11', 'admin'),
(2526, '[Client Doc Deleted]  DocId 72 CID 72', '2023-07-18 08:29:11', 'admin'),
(2527, '[Client Deleted]  ID 71', '2023-07-18 08:29:13', 'admin'),
(2528, '[Client Doc Deleted]  DocId 71 CID 71', '2023-07-18 08:29:13', 'admin'),
(2529, '[Client Deleted]  ID 70', '2023-07-18 08:29:15', 'admin'),
(2530, '[Client Doc Deleted]  DocId 70 CID 70', '2023-07-18 08:29:15', 'admin'),
(2531, '[Client Deleted]  ID 69', '2023-07-18 08:29:18', 'admin'),
(2532, '[Client Doc Deleted]  DocId 69 CID 69', '2023-07-18 08:29:18', 'admin'),
(2533, '[Client Deleted]  ID 68', '2023-07-18 08:29:22', 'admin'),
(2534, '[Client Doc Deleted]  DocId 68 CID 68', '2023-07-18 08:29:22', 'admin'),
(2535, '[Client Deleted]  ID 67', '2023-07-18 08:29:25', 'admin'),
(2536, '[Client Doc Deleted]  DocId 67 CID 67', '2023-07-18 08:29:25', 'admin'),
(2537, '[Client Deleted]  ID 66', '2023-07-18 08:29:27', 'admin'),
(2538, '[Client Doc Deleted]  DocId 66 CID 66', '2023-07-18 08:29:27', 'admin'),
(2539, '[Client Deleted]  ID 65', '2023-07-18 08:29:30', 'admin'),
(2540, '[Client Doc Deleted]  DocId 65 CID 65', '2023-07-18 08:29:30', 'admin'),
(2541, '[Client Deleted]  ID 64', '2023-07-18 08:29:32', 'admin'),
(2542, '[Client Doc Deleted]  DocId 64 CID 64', '2023-07-18 08:29:32', 'admin'),
(2543, '[Client Added] Sarath ID 73', '2023-07-18 08:37:25', 'admin'),
(2544, '[Client Added] Sharon ID 74', '2023-07-18 08:44:13', 'admin'),
(2545, '[Logged In] admin@admin.com', '2023-07-18 10:58:38', ''),
(2546, '[Logged In] admin@admin.com', '2023-07-18 11:21:47', ''),
(2547, '[Logged In] admin@admin.com', '2023-07-18 11:26:23', ''),
(2548, '[Logged In] admin@admin.com', '2023-07-18 13:45:25', ''),
(2549, '[Logged In] admin@admin.com', '2023-07-19 02:05:23', ''),
(2550, '[Logged In] admin@admin.com', '2023-07-19 02:09:56', ''),
(2551, '[Logged In] admin@admin.com', '2023-07-19 02:18:15', ''),
(2552, '[Logged In] admin@admin.com', '2023-07-19 02:22:08', ''),
(2553, '[Logged In] admin@admin.com', '2023-07-19 02:31:03', ''),
(2554, '[Logged In] admin@admin.com', '2023-07-19 02:42:03', ''),
(2555, '[Logged In] admin@admin.com', '2023-07-19 02:43:12', ''),
(2556, '[Logged Out] admin', '2023-07-19 03:52:49', ''),
(2557, '[Logged In] admin@admin.com', '2023-07-19 04:14:42', ''),
(2558, '[Logged In] admin@admin.com', '2023-07-19 04:20:15', ''),
(2559, '[Logged Out] admin', '2023-07-19 04:21:05', ''),
(2560, '[Logged In] admin@admin.com', '2023-07-19 04:21:33', ''),
(2561, '[Logged Out] admin', '2023-07-19 04:22:03', ''),
(2562, '[Logged In] admin@admin.com', '2023-07-19 04:36:41', ''),
(2563, '[Logged In] admin@admin.com', '2023-07-19 04:38:12', ''),
(2564, '[Logged In] admin@admin.com', '2023-07-19 04:43:31', ''),
(2565, '[Logged In] admin@admin.com', '2023-07-19 04:45:27', ''),
(2566, '[Logged In] admin@admin.com', '2023-07-19 04:46:06', ''),
(2567, '[Logged Out] admin', '2023-07-19 05:14:11', ''),
(2568, '[Logged In] admin@admin.com', '2023-07-19 05:14:18', ''),
(2569, '[Logged In] admin@admin.com', '2023-07-19 05:18:06', ''),
(2570, '[Logged In] admin@admin.com', '2023-07-19 05:49:13', ''),
(2571, '[Logged In] admin@admin.com', '2023-07-19 05:52:43', ''),
(2572, '[Logged In] admin@admin.com', '2023-07-19 05:52:49', ''),
(2573, '[Logged Out] admin', '2023-07-19 05:58:05', ''),
(2574, '[Logged In] admin@admin.com', '2023-07-19 05:58:26', ''),
(2575, '[Logged Out] admin', '2023-07-19 05:59:01', ''),
(2576, '[Logged In] steve@gmail.com', '2023-07-19 05:59:13', ''),
(2577, '[Logged Out] Steve19', '2023-07-19 06:00:02', ''),
(2578, '[Logged In] admin@admin.com', '2023-07-19 06:00:08', ''),
(2579, '[Logged Out] admin', '2023-07-19 06:05:08', ''),
(2580, '[Logged In] admin@admin.com', '2023-07-19 06:06:22', ''),
(2581, '[Logged Out] admin', '2023-07-19 06:22:42', ''),
(2582, '[Logged In] admin@admin.com', '2023-07-19 06:24:05', ''),
(2583, '[Logged Out] admin', '2023-07-19 06:24:31', ''),
(2584, '[Logged In] admin@admin.com', '2023-07-19 06:26:43', ''),
(2585, '[Client Wallet Recharge] Amt-6000 ID 74', '2023-07-19 06:27:07', 'admin'),
(2586, '[Logged Out] admin', '2023-07-19 06:27:23', ''),
(2587, '[Payment Invoice 100]  Transaction-57 - 4770 ', '2023-07-19 06:27:46', 'Sharon'),
(2588, '[Logged In] admin@admin.com', '2023-07-19 06:28:20', ''),
(2589, '[Logged In] admin@admin.com', '2023-07-19 07:49:20', ''),
(2590, '[Logged In] admin@admin.com', '2023-07-19 08:40:07', ''),
(2591, '[Jobsheets Doc Added]  DocId Account Service  ComplaintId 106', '2023-07-19 08:41:50', 'admin'),
(2592, '[Jobsheets Added]  TaskId 106', '2023-07-19 08:41:50', 'admin'),
(2593, '[Logged Out] admin', '2023-07-19 08:42:14', ''),
(2594, '[Logged In] steve@gmail.com', '2023-07-19 08:42:32', ''),
(2595, '[Logged Out] Steve19', '2023-07-19 08:45:01', ''),
(2596, '[Logged In] admin@admin.com', '2023-07-19 08:45:06', ''),
(2597, '[Logged Out] admin', '2023-07-19 08:46:26', ''),
(2598, '[Logged In] steve@gmail.com', '2023-07-19 08:46:33', ''),
(2599, '[Logged Out] Steve19', '2023-07-19 08:51:44', ''),
(2600, '[Logged In] admin@admin.com', '2023-07-19 09:00:17', ''),
(2601, '[Client Deleted]  ID 74', '2023-07-19 09:01:09', 'admin'),
(2602, '[Client Doc Deleted]  DocId 74 CID 74', '2023-07-19 09:01:09', 'admin'),
(2603, '[Client Deleted]  ID 73', '2023-07-19 09:01:09', 'admin'),
(2604, '[Client Doc Deleted]  DocId 73 CID 73', '2023-07-19 09:01:09', 'admin'),
(2605, '[Client Deleted]  ID 60', '2023-07-19 09:01:09', 'admin'),
(2606, '[Client Doc Deleted]  DocId 60 CID 60', '2023-07-19 09:01:09', 'admin'),
(2607, '[Logged In] admin@admin.com', '2023-07-19 09:06:02', ''),
(2608, '[Logged In] admin@admin.com', '2023-07-19 09:06:13', ''),
(2609, '[Logged Out] admin', '2023-07-19 09:10:10', ''),
(2610, '[Logged In] admin@admin.com', '2023-07-19 09:12:10', ''),
(2611, '[Logged Out] admin', '2023-07-19 09:13:48', ''),
(2612, '[Logged In] admin@admin.com', '2023-07-19 09:14:38', ''),
(2613, '[Client Updated] DATO SHARAN J VALIRAM ID 50', '2023-07-19 09:15:26', 'admin'),
(2614, '[Logged Out] admin', '2023-07-19 09:15:59', ''),
(2615, '[Logged In] admin@admin.com', '2023-07-19 09:17:00', ''),
(2616, '[Logged Out] admin', '2023-07-19 09:18:04', ''),
(2617, '[Logged In] admin@admin.com', '2023-07-19 09:19:11', ''),
(2618, '[Logged Out] admin', '2023-07-19 09:21:07', ''),
(2619, '[Logged In] admin@admin.com', '2023-07-19 09:21:56', ''),
(2620, '[Logged Out] admin', '2023-07-19 09:22:44', ''),
(2621, '[Logged In] admin@admin.com', '2023-07-19 09:23:37', ''),
(2622, '[Client Wallet Recharge] Amt-2000 ID 75', '2023-07-19 09:25:53', 'admin'),
(2623, '[Logged In] admin@admin.com', '2023-07-19 09:26:41', ''),
(2624, '[Logged Out] admin', '2023-07-19 09:31:13', ''),
(2625, '[Logged In] admin@admin.com', '2023-07-19 09:32:47', ''),
(2626, '[Payment Invoice 101]  Transaction-58 - 378.75 ', '2023-07-19 10:02:57', 'Shafeek Ajmal'),
(2627, '[Employee ClockIn]  ID 6', '2023-07-19 10:07:00', 'admin'),
(2628, '[Client Added] sfdsdfsd ID 81', '2023-07-19 10:12:03', 'admin'),
(2629, '[Logged Out] admin', '2023-07-19 10:23:38', ''),
(2630, '[Logged In] admin@admin.com', '2023-07-19 10:24:12', ''),
(2631, '[Logged Out] admin', '2023-07-19 10:25:55', ''),
(2632, '[Logged In] admin@admin.com', '2023-07-19 10:27:19', ''),
(2633, '[Client Updated]  Devin ID 83', '2023-07-19 10:27:51', 'admin'),
(2634, '[Client Doc Added]  DocId Mantenance Contract CID ', '2023-07-19 10:29:41', 'admin'),
(2635, '[Client Doc Added]  DocId mmmm CID 83', '2023-07-19 10:30:48', 'admin'),
(2636, '[Client Doc Deleted]  DocId 22 CID 83', '2023-07-19 10:31:17', 'admin'),
(2637, '[Logged In] admin@admin.com', '2023-07-19 11:06:24', ''),
(2638, '[Employee ClockIn]  ID 6', '2023-07-19 11:08:34', 'admin'),
(2639, '[Logged Out] admin', '2023-07-19 11:10:55', ''),
(2640, '[Logged In] steve@gmail.com', '2023-07-19 11:11:05', ''),
(2641, '[Logged In] admin@admin.com', '2023-07-19 11:12:34', ''),
(2642, '[Logged In] admin@admin.com', '2023-07-19 11:56:26', ''),
(2643, '[Logged In] admin@admin.com', '2023-07-19 14:09:18', ''),
(2644, '[Logged In] admin@admin.com', '2023-07-19 16:27:25', ''),
(2645, '[Logged In] admin@admin.com', '2023-07-19 20:32:45', ''),
(2646, '[Logged In] admin@admin.com', '2023-07-20 00:34:53', ''),
(2647, '[Logged In] admin@admin.com', '2023-07-20 03:29:17', ''),
(2648, '[Logged In] admin@admin.com', '2023-07-23 08:27:00', ''),
(2649, '[Logged In] admin@admin.com', '2023-07-23 10:40:43', ''),
(2650, '[Logged In] admin@admin.com', '2023-07-23 13:35:25', ''),
(2651, '[Client Added] sivaprasad ID 84', '2023-07-23 13:36:20', 'admin'),
(2652, '[Logged Out] admin', '2023-07-23 13:36:37', ''),
(2653, '[Logged In] adam@gmail.com', '2023-07-23 13:43:12', ''),
(2654, '[Logged Out] Adam29', '2023-07-23 13:43:31', ''),
(2655, '[Logged In] admin@admin.com', '2023-07-23 14:41:14', ''),
(2656, '[New Product] -Test coffe one  -Qty-120 ID 8', '2023-07-23 14:43:23', 'admin'),
(2657, '[Logged In] admin@admin.com', '2023-07-24 02:08:47', ''),
(2658, '[Logged In] admin@admin.com', '2023-07-25 01:17:04', ''),
(2659, '[Logged In] admin@admin.com', '2023-07-25 03:18:34', ''),
(2660, '[Logged In] admin@admin.com', '2023-07-25 03:24:34', ''),
(2661, '[Logged In] admin@admin.com', '2023-07-27 22:53:04', ''),
(2662, '[Logged In] admin@admin.com', '2023-07-30 04:13:02', ''),
(2663, '[Logged In] admin@admin.com', '2023-07-31 06:16:08', ''),
(2664, '[Logged In] admin@admin.com', '2023-07-31 06:47:39', ''),
(2665, '[Logged In] admin@admin.com', '2023-07-31 11:09:04', ''),
(2666, '[Logged In] admin@admin.com', '2023-08-01 20:12:38', ''),
(2667, '[Logged In] admin@admin.com', '2023-08-01 22:25:04', ''),
(2668, '[Logged In] admin@admin.com', '2023-08-02 22:31:31', ''),
(2669, '[Logged In] admin@admin.com', '2023-08-03 01:38:22', ''),
(2670, '[Logged In] admin@admin.com', '2023-08-03 11:46:27', ''),
(2671, '[Logged In] admin@admin.com', '2023-08-03 14:54:35', ''),
(2672, '[Logged In] admin@admin.com', '2023-08-03 22:18:31', ''),
(2673, '[Logged In] admin@admin.com', '2023-08-04 00:28:18', ''),
(2674, '[Logged In] admin@admin.com', '2023-08-04 12:45:09', ''),
(2675, '[Logged In] admin@admin.com', '2023-08-07 20:31:06', ''),
(2676, '[Logged In] admin@admin.com', '2023-08-07 22:30:43', ''),
(2677, '[Logged In] admin@admin.com', '2023-08-08 00:43:58', ''),
(2678, '[Logged In] admin@admin.com', '2023-08-08 04:45:28', ''),
(2679, '[Logged In] admin@admin.com', '2023-08-08 23:12:38', ''),
(2680, '[Logged In] admin@admin.com', '2023-08-09 01:12:06', ''),
(2681, '[Logged In] admin@admin.com', '2023-08-09 04:40:31', ''),
(2682, '[Logged In] admin@admin.com', '2023-08-09 06:45:51', ''),
(2683, '[Logged In] admin@admin.com', '2023-08-09 07:27:11', ''),
(2684, '[Logged In] admin@admin.com', '2023-08-09 11:58:04', ''),
(2685, '[Logged In] admin@admin.com', '2023-08-09 13:59:03', ''),
(2686, '[Logged In] admin@admin.com', '2023-08-09 21:11:28', ''),
(2687, '[Logged In] admin@admin.com', '2023-08-10 00:46:55', ''),
(2688, '[Logged In] admin@admin.com', '2023-08-10 03:32:26', ''),
(2689, '[Logged In] admin@admin.com', '2023-08-10 13:09:25', ''),
(2690, '[Logged In] admin@admin.com', '2023-08-10 20:20:47', ''),
(2691, '[Logged In] admin@admin.com', '2023-08-10 22:26:34', ''),
(2692, '[Logged In] admin@admin.com', '2023-08-11 00:18:34', ''),
(2693, '[Logged In] admin@admin.com', '2023-08-11 03:35:15', ''),
(2694, '[Logged In] admin@admin.com', '2023-08-11 05:56:14', ''),
(2695, '[Logged In] admin@admin.com', '2023-08-11 09:10:15', ''),
(2696, '[Logged In] admin@admin.com', '2023-08-13 21:09:54', ''),
(2697, '[Logged In] admin@admin.com', '2023-08-13 23:10:15', ''),
(2698, '[Logged In] admin@admin.com', '2023-08-14 01:10:13', ''),
(2699, '[Logged In] admin@admin.com', '2023-08-14 01:28:27', ''),
(2700, '[Logged In] admin@admin.com', '2023-08-14 01:34:53', ''),
(2701, '[Logged In] admin@admin.com', '2023-08-14 03:14:11', ''),
(2702, '[Logged In] admin@admin.com', '2023-08-14 05:47:12', ''),
(2703, '[Logged In] admin@admin.com', '2023-08-14 08:16:20', ''),
(2704, '[Logged In] admin@admin.com', '2023-08-14 10:18:43', ''),
(2705, '[Logged In] admin@admin.com', '2023-08-14 12:49:11', ''),
(2706, '[Logged In] admin@admin.com', '2023-08-14 19:43:08', ''),
(2707, '[Logged In] admin@admin.com', '2023-08-14 21:54:46', ''),
(2708, '[Logged In] admin@admin.com', '2023-08-15 00:24:12', ''),
(2709, '[Logged In] admin@admin.com', '2023-08-15 03:12:34', ''),
(2710, '[Logged In] admin@admin.com', '2023-08-15 09:48:12', ''),
(2711, '[Logged In] admin@admin.com', '2023-08-15 21:29:16', ''),
(2712, '[Logged In] admin@admin.com', '2023-08-16 20:00:05', ''),
(2713, '[Logged In] admin@admin.com', '2023-08-16 22:00:17', ''),
(2714, '[Logged In] admin@admin.com', '2023-08-16 22:01:43', ''),
(2715, '[Logged In] admin@admin.com', '2023-08-18 01:54:17', ''),
(2716, '[Logged In] admin@admin.com', '2023-08-18 04:45:29', ''),
(2717, '[Logged In] admin@admin.com', '2023-08-18 05:04:08', ''),
(2718, '[Logged In] admin@admin.com', '2023-08-18 06:50:08', ''),
(2719, '[Logged In] admin@admin.com', '2023-08-18 09:36:54', ''),
(2720, '[Logged In] admin@admin.com', '2023-08-18 09:50:16', ''),
(2721, '[Logged In] admin@admin.com', '2023-08-18 11:42:12', ''),
(2722, '[Logged In] admin@admin.com', '2023-08-18 19:37:37', ''),
(2723, '[Logged In] admin@admin.com', '2023-08-20 20:25:26', ''),
(2724, '[Logged In] admin@admin.com', '2023-08-20 22:32:25', ''),
(2725, '[Logged In] admin@admin.com', '2023-08-21 00:34:19', ''),
(2726, '[Logged In] admin@admin.com', '2023-08-21 01:23:47', ''),
(2727, '[Logged In] admin@admin.com', '2023-08-21 03:26:30', ''),
(2728, '[Category Edited] supermarketww ID 3', '2023-08-21 05:24:17', 'admin'),
(2729, '[Logged In] admin@admin.com', '2023-08-21 05:27:06', ''),
(2730, '[Logged In] admin@admin.com', '2023-08-21 05:43:17', ''),
(2731, '[Logged In] admin@admin.com', '2023-08-21 12:39:12', ''),
(2732, '[Logged In] admin@admin.com', '2023-08-21 20:08:48', ''),
(2733, '[Logged In] admin@admin.com', '2023-08-21 22:28:24', ''),
(2734, '[Logged In] admin@admin.com', '2023-08-22 01:26:04', ''),
(2735, '[Logged In] admin@admin.com', '2023-08-22 03:33:38', ''),
(2736, '[Logged In] admin@admin.com', '2023-08-22 11:27:25', ''),
(2737, '[Logged In] admin@admin.com', '2023-08-22 20:44:14', ''),
(2738, '[Logged In] admin@admin.com', '2023-08-22 23:01:07', ''),
(2739, '[Logged In] admin@admin.com', '2023-08-23 01:08:43', ''),
(2740, '[Update Product] -Test coffe one by siva  -Qty-120 ID 8', '2023-08-23 01:11:11', 'admin'),
(2741, '[Logged In] admin@admin.com', '2023-08-23 03:09:03', ''),
(2742, '[Logged In] admin@admin.com', '2023-08-23 05:42:38', ''),
(2743, '[Logged In] admin@admin.com', '2023-08-23 13:11:07', ''),
(2744, '[Logged In] admin@admin.com', '2023-08-23 15:08:50', ''),
(2745, '[Logged In] admin@admin.com', '2023-08-23 22:24:04', ''),
(2746, '[Logged In] admin@admin.com', '2023-08-24 01:42:06', ''),
(2747, '[Logged In] admin@admin.com', '2023-08-24 03:43:44', ''),
(2748, '[Logged In] admin@admin.com', '2023-08-26 03:13:43', ''),
(2749, '[Logged In] admin@admin.com', '2023-08-26 04:29:39', ''),
(2750, '[Logged In] admin@admin.com', '2023-08-26 05:21:33', ''),
(2751, '[Logged In] admin@admin.com', '2023-08-26 10:04:57', ''),
(2752, '[Update Product] -Dolo 650  -Qty-144 ID 7', '2023-08-26 10:36:15', 'admin'),
(2753, '[Logged In] admin@admin.com', '2023-08-26 10:40:33', ''),
(2754, '[Logged In] admin@admin.com', '2023-08-28 23:59:08', ''),
(2755, '[Logged In] admin@admin.com', '2023-08-29 00:33:02', ''),
(2756, '[Logged In] admin@admin.com', '2023-08-29 21:20:40', ''),
(2757, '[Logged In] admin@admin.com', '2023-08-29 23:24:30', ''),
(2758, '[Logged In] admin@admin.com', '2023-08-30 03:37:48', ''),
(2759, '[Logged In] admin@admin.com', '2023-09-04 02:39:33', ''),
(2760, '[Category Created] testT ID 8', '2023-09-04 03:04:56', 'admin'),
(2761, '[Category Created] dfdsf ID 9', '2023-09-04 03:18:18', 'admin'),
(2762, '[Logged In] admin@admin.com', '2023-09-06 22:40:42', ''),
(2763, '[Logged In] admin@admin.com', '2023-09-06 23:58:44', ''),
(2764, '[Logged In] admin@admin.com', '2023-09-06 23:59:47', ''),
(2765, '[Logged In] admin@admin.com', '2023-09-07 00:57:24', ''),
(2766, '[Client Added] asrfafg ID 85', '2023-09-07 02:21:26', 'admin'),
(2767, '[Client Added] asrfafg ID 86', '2023-09-07 02:21:56', 'admin'),
(2768, '[Client Added] jhkjhkjhkj ID 87', '2023-09-07 02:22:32', 'admin'),
(2769, '[Client Added] jhkjhkjhkj ID 88', '2023-09-07 02:24:57', 'admin'),
(2770, '[Client Added] jhkjhkjhkj ID 89', '2023-09-07 02:26:20', 'admin'),
(2771, '[Client Added] hjghjghj ID 90', '2023-09-07 02:26:50', 'admin'),
(2772, '[Client Added] hjghjghj ID 91', '2023-09-07 02:29:41', 'admin'),
(2773, '[Client Added] hjghjghj ID 92', '2023-09-07 02:37:24', 'admin'),
(2774, '[Client Added] hjghjghj ID 93', '2023-09-07 02:37:59', 'admin'),
(2775, '[Client Added] aeawfasdf ID 94', '2023-09-07 02:39:04', 'admin'),
(2776, '[Client Added] hjg ID 95', '2023-09-07 02:40:00', 'admin'),
(2777, '[Client Added] jhghj ID 96', '2023-09-07 02:41:06', 'admin'),
(2778, '[Logged In] admin@admin.com', '2023-09-07 03:06:39', ''),
(2779, '[Logged Out] admin', '2023-09-07 03:42:08', ''),
(2780, '[Logged In] admin@admin.com', '2023-09-07 21:10:06', ''),
(2781, '[Client Added] ghhjgHJGHJGhjgjh ID 97', '2023-09-07 21:12:35', 'admin'),
(2782, '[Client Added] jh ID 98', '2023-09-07 21:14:09', 'admin'),
(2783, '[Logged Out] admin', '2023-09-07 21:15:40', ''),
(2784, '[Logged In] admin@admin.com', '2023-09-07 21:37:05', ''),
(2785, '[Logged In] admin@admin.com', '2023-09-07 22:49:32', ''),
(2786, '[Client Added] ghfhfh ID 99', '2023-09-07 23:28:31', 'admin'),
(2787, '[Client Added] ghfhfh ID 100', '2023-09-07 23:28:44', 'admin'),
(2788, '[Client Added] ghfhfh ID 101', '2023-09-07 23:29:13', 'admin'),
(2789, '[Client Added] ghfhfh ID 102', '2023-09-07 23:29:51', 'admin'),
(2790, '[Client Added] ghfhfh ID 103', '2023-09-07 23:30:49', 'admin'),
(2791, '[Logged In] admin@admin.com', '2023-09-07 23:40:59', ''),
(2792, '[Client Added] jkh ID 104', '2023-09-07 23:41:38', 'admin'),
(2793, '[Client Added] jkh ID 105', '2023-09-07 23:44:24', 'admin'),
(2794, '[Client Added] hjghjg ID 106', '2023-09-07 23:46:39', 'admin'),
(2795, '[Client Added] vjgjhgjh ID 107', '2023-09-07 23:47:49', 'admin'),
(2796, '[Client Added] jkhgjhghj ID 108', '2023-09-07 23:48:42', 'admin'),
(2797, '[Client Added] jkhgjhghj ID 109', '2023-09-07 23:50:22', 'admin'),
(2798, '[Client Added] jkhkjh ID 110', '2023-09-07 23:52:19', 'admin'),
(2799, '[Client Added] jkhjhg ID 111', '2023-09-07 23:54:04', 'admin'),
(2800, '[Client Added] hjghjg ID 112', '2023-09-07 23:55:30', 'admin'),
(2801, '[Logged In] admin@admin.com', '2023-09-08 01:22:32', ''),
(2802, '[Logged In] admin@admin.com', '2023-09-08 03:34:31', ''),
(2803, '[Logged In] admin@admin.com', '2023-09-10 21:17:48', ''),
(2804, '[Logged In] admin@admin.com', '2023-09-10 23:19:28', ''),
(2805, '[Logged In] admin@admin.com', '2023-09-11 00:06:37', ''),
(2806, '[Logged In] admin@admin.com', '2023-09-11 04:07:58', ''),
(2807, '[Logged In] admin@admin.com', '2023-09-11 21:44:45', ''),
(2808, '[Logged In] admin@admin.com', '2023-09-12 00:59:15', ''),
(2809, '[Client Added] jhkjhjk ID 113', '2023-09-12 01:00:04', 'admin'),
(2810, '[Logged In] admin@admin.com', '2023-09-12 03:10:11', ''),
(2811, '[Logged Out] admin', '2023-09-12 03:44:26', ''),
(2812, '[Logged In] ffffff@gmail.com', '2023-09-12 03:44:37', ''),
(2813, '[Logged In] admin@admin.com', '2023-09-12 03:49:30', ''),
(2814, '[Logged Out] fffffff', '2023-09-12 03:49:50', ''),
(2815, '[Logged In] admin@admin.com', '2023-09-12 03:49:59', ''),
(2816, '[Logged Out] admin', '2023-09-12 03:50:03', ''),
(2817, '[Logged In] ffffff@gmail.com', '2023-09-12 03:50:12', ''),
(2818, '[Logged Out] fffffff', '2023-09-12 03:59:54', ''),
(2819, '[Logged In] ffffff@gmail.com', '2023-09-12 04:00:01', ''),
(2820, '[Logged In] ffffff@gmail.com', '2023-09-12 12:31:50', ''),
(2821, '[Logged Out] fffffff', '2023-09-12 12:32:06', ''),
(2822, '[Logged In] admin@admin.com', '2023-09-12 12:32:28', ''),
(2823, '[Logged Out] admin', '2023-09-12 12:42:50', ''),
(2824, '[Logged In] ddsasdaddd@gmail.com', '2023-09-12 12:43:00', ''),
(2825, '[Logged Out] tryuiuasdjbmhgdsdfasd', '2023-09-12 12:43:06', ''),
(2826, '[Logged In] admin@admin.com', '2023-09-12 13:34:32', ''),
(2827, '[Logged In] admin@admin.com', '2023-09-12 16:02:34', ''),
(2828, '[Logged In] admin@admin.com', '2023-09-12 22:10:44', ''),
(2829, '[Logged In] admin@admin.com', '2023-09-13 00:36:19', ''),
(2830, '[Logged In] admin@admin.com', '2023-09-13 02:13:43', ''),
(2831, '[Logged In] admin@admin.com', '2023-09-13 03:56:18', ''),
(2832, '[Logged In] admin@admin.com', '2023-09-13 04:14:09', ''),
(2833, '[Logged In] admin@admin.com', '2023-09-13 05:59:09', ''),
(2834, '[Logged In] admin@admin.com', '2023-09-13 07:14:31', ''),
(2835, '[Logged In] admin@admin.com', '2023-09-13 08:12:25', ''),
(2836, '[Logged In] admin@admin.com', '2023-09-13 13:08:12', ''),
(2837, '[Logged In] admin@admin.com', '2023-09-13 15:02:28', ''),
(2838, '[Logged In] admin@admin.com', '2023-09-13 15:36:48', ''),
(2839, '[Logged In] admin@admin.com', '2023-09-14 03:12:30', ''),
(2840, '[Logged In] admin@admin.com', '2023-09-14 20:53:30', ''),
(2841, '[Logged In] admin@admin.com', '2023-09-14 23:02:26', ''),
(2842, '[Logged In] admin@admin.com', '2023-09-15 00:18:53', ''),
(2843, '[Logged In] admin@admin.com', '2023-09-15 01:02:40', ''),
(2844, '[Logged In] admin@admin.com', '2023-09-15 02:24:25', ''),
(2845, '[Logged In] admin@admin.com', '2023-09-15 05:17:11', ''),
(2846, '[Logged In] admin@admin.com', '2023-09-15 05:36:44', ''),
(2847, '[Logged In] admin@admin.com', '2023-09-17 13:25:00', ''),
(2848, '[Logged In] admin@admin.com', '2023-09-17 14:27:52', ''),
(2849, '[Logged In] admin@admin.com', '2023-09-17 14:33:07', ''),
(2850, '[Logged In] admin@admin.com', '2023-09-18 01:43:19', ''),
(2851, '[Logged In] admin@admin.com', '2023-09-18 03:57:03', ''),
(2852, '[Logged In] admin@admin.com', '2023-09-18 21:14:54', ''),
(2853, '[Logged In] admin@admin.com', '2023-09-19 04:36:24', ''),
(2854, '[Logged In] admin@admin.com', '2023-09-20 21:15:22', ''),
(2855, '[Logged Out] admin', '2023-09-20 21:17:48', ''),
(2856, '[Logged In] admin@admin.com', '2023-09-20 23:20:59', ''),
(2857, '[Logged In] admin@admin.com', '2023-09-21 04:15:11', ''),
(2858, '[Logged In] admin@admin.com', '2023-09-24 22:40:33', ''),
(2859, '[Logged In] ddsasdaddd@gmail.com', '2023-09-24 23:08:24', ''),
(2860, '[Logged Out] tryuiuasdjbmhgdsdfasd', '2023-09-24 23:08:27', ''),
(2861, '[Logged In] admin@admin.com', '2023-09-24 23:42:15', ''),
(2862, '[Logged In] admin@admin.com', '2023-09-25 04:29:50', ''),
(2863, '[Logged In] admin@admin.com', '2023-09-25 07:24:07', ''),
(2864, '[Logged In] admin@admin.com', '2023-09-26 01:20:20', ''),
(2865, '[Logged In] admin@admin.com', '2023-09-26 04:41:23', ''),
(2866, '[Logged In] admin@admin.com', '2023-09-26 13:34:29', ''),
(2867, '[Logged In] admin@admin.com', '2023-09-26 21:28:33', ''),
(2868, '[Logged Out] admin', '2023-09-26 21:41:07', ''),
(2869, '[Logged In] admin@admin.com', '2023-09-26 21:41:13', ''),
(2870, '[Logged In] admin@admin.com', '2023-09-27 02:08:15', ''),
(2871, '[Logged In] admin@admin.com', '2023-09-27 05:32:02', ''),
(2872, '[Logged In] admin@admin.com', '2023-09-27 23:49:24', ''),
(2873, '[Logged In] admin@admin.com', '2023-09-28 04:11:30', ''),
(2874, '[Logged In] admin@admin.com', '2023-10-01 13:39:03', ''),
(2875, '[Logged In] admin@admin.com', '2023-10-01 15:39:14', ''),
(2876, '[Logged In] admin@admin.com', '2023-10-01 22:46:25', ''),
(2877, '[Logged Out] admin', '2023-10-01 22:54:04', ''),
(2878, '[Logged In] admin@admin.com', '2023-10-01 23:07:11', ''),
(2879, '[Logged In] admin@admin.com', '2023-10-02 00:46:17', ''),
(2880, '[Logged In] admin@admin.com', '2023-10-02 03:16:27', ''),
(2881, '[Logged Out] admin', '2023-10-02 03:35:21', ''),
(2882, '[Logged In] adam@gmail.com', '2023-10-02 03:35:47', ''),
(2883, '[Logged Out] Adam29', '2023-10-02 03:59:33', ''),
(2884, '[Logged In] admin@admin.com', '2023-10-02 04:56:54', ''),
(2885, '[Logged In] admin@admin.com', '2023-10-02 06:06:58', ''),
(2886, '[Logged In] admin@admin.com', '2023-10-02 07:25:08', ''),
(2887, '[Logged In] admin@admin.com', '2023-10-02 21:15:30', ''),
(2888, '[Logged In] admin@admin.com', '2023-10-02 23:20:01', ''),
(2889, '[Logged In] admin@admin.com', '2023-10-03 04:16:59', ''),
(2890, '[Logged In] admin@admin.com', '2023-10-03 11:53:06', ''),
(2891, '[Logged In] admin@admin.com', '2023-10-03 23:02:26', ''),
(2892, '[Logged In] admin@admin.com', '2023-10-03 23:20:31', ''),
(2893, '[Logged Out] admin', '2023-10-03 23:33:14', ''),
(2894, '[Logged In] adam@gmail.com', '2023-10-03 23:33:19', ''),
(2895, '[Logged Out] Adam29', '2023-10-03 23:33:50', ''),
(2896, '[Logged In] admin@admin.com', '2023-10-03 23:34:03', ''),
(2897, '[Logged Out] admin', '2023-10-03 23:35:09', ''),
(2898, '[Logged In] alvin@gmail.com', '2023-10-03 23:35:20', ''),
(2899, '[Logged Out] Alvin', '2023-10-03 23:37:10', ''),
(2900, '[Logged In] alvin@gmail.com', '2023-10-03 23:37:16', ''),
(2901, '[Logged Out] Alvin', '2023-10-03 23:37:34', ''),
(2902, '[Logged In] admin@admin.com', '2023-10-03 23:37:43', ''),
(2903, '[Logged Out] admin', '2023-10-03 23:39:50', ''),
(2904, '[Logged In] alvin@gmail.com', '2023-10-03 23:39:58', ''),
(2905, '[Logged In] admin@admin.com', '2023-10-04 01:23:52', ''),
(2906, '[Logged In] admin@admin.com', '2023-10-04 06:46:15', ''),
(2907, '[Logged In] admin@admin.com', '2023-10-04 23:15:59', ''),
(2908, '[Warehouse Edited] Main WareHouse1 ID ', '2023-10-04 23:59:57', 'admin'),
(2909, '[Warehouse Edited] Main WareHouse1 ID ', '2023-10-05 00:00:09', 'admin'),
(2910, '[Warehouse Edited] Main WareHouse ID ', '2023-10-05 00:01:44', 'admin'),
(2911, '[Warehouse Edited] Main WareHouse1 ID 1', '2023-10-05 00:04:39', 'admin'),
(2912, '[Warehouse Edited] Main WareHouse ID 1', '2023-10-05 00:06:13', 'admin'),
(2913, '[Logged In] admin@admin.com', '2023-10-05 01:22:56', ''),
(2914, '[Client Added]  ID 114', '2023-10-05 02:30:46', 'admin'),
(2915, '[Client Added]  ID 115', '2023-10-05 02:30:47', 'admin'),
(2916, '[Logged In] admin@admin.com', '2023-10-10 02:35:10', ''),
(2917, '[Payment Invoice 112]  Transaction-66 - 86 ', '2023-10-10 03:10:37', 'Hasan Prasetyo'),
(2918, '[Logged In] admin@admin.com', '2023-10-11 13:25:11', ''),
(2919, '[Logged In] admin@admin.com', '2023-10-11 14:11:53', ''),
(2920, '[Logged Out] admin', '2023-10-11 14:16:12', ''),
(2921, '[Logged In] admin@admin.com', '2023-10-11 14:17:13', ''),
(2922, '[Logged In] admin@admin.com', '2023-10-12 00:08:38', ''),
(2923, '[Logged In] admin@admin.com', '2023-10-12 13:14:42', ''),
(2924, '[Logged In] admin@admin.com', '2023-10-12 14:06:27', ''),
(2925, '[Logged In] admin@admin.com', '2023-10-12 23:57:38', ''),
(2926, '[Logged In] admin@admin.com', '2023-10-15 05:12:05', ''),
(2927, '[Logged In] admin@admin.com', '2023-10-15 22:21:45', ''),
(2928, '[Logged In] admin@admin.com', '2023-10-15 22:22:46', ''),
(2929, '[Logged In] admin@admin.com', '2023-10-16 05:41:30', ''),
(2930, '[Logged In] admin@admin.com', '2023-10-16 22:20:31', ''),
(2931, '[Logged In] admin@admin.com', '2023-10-17 00:22:39', ''),
(2932, '[Logged In] admin@admin.com', '2023-10-17 14:00:41', ''),
(2933, '[Logged In] admin@admin.com', '2023-10-17 14:00:57', ''),
(2934, '[Logged In] admin@admin.com', '2023-10-17 14:05:11', ''),
(2935, '[Logged In] admin@admin.com', '2023-10-18 01:10:14', ''),
(2936, '[Logged In] admin@admin.com', '2023-10-19 13:43:22', ''),
(2937, '[Logged Out] admin', '2023-10-19 14:00:41', ''),
(2938, '[Logged In] admin@admin.com', '2023-10-25 21:42:42', ''),
(2939, '[Logged In] admin@admin.com', '2023-11-13 23:18:24', ''),
(2940, '[Logged Out] admin', '2023-11-19 12:21:19', ''),
(2941, '[Logged In] admin@admin.com', '2023-11-19 12:24:11', ''),
(2942, '[Logged Out] admin', '2023-11-19 12:30:13', ''),
(2943, '[Logged In] admin@admin.com', '2023-11-19 12:30:47', ''),
(2944, '[Logged In] admin@admin.com', '2023-11-21 20:25:18', ''),
(2945, '[Update Product] -AVT tea  -Qty-12 ID 1', '2023-11-21 21:39:35', 'admin'),
(2946, '[New Product] -AVT tea  -Qty-12 ID 1', '2023-11-21 21:39:35', 'admin'),
(2947, '[New Product] -AVT tea  -Qty-12 ID 1', '2023-11-21 21:39:35', 'admin'),
(2948, '[New Product] -AVT tea  -Qty-12 ID 1', '2023-11-21 21:39:35', 'admin'),
(2949, '[Logged Out] admin', '2023-11-22 02:31:45', ''),
(2950, '[Logged In] admin@admin.com', '2023-11-22 02:32:39', ''),
(2951, '[Logged Out] admin', '2023-11-22 02:32:58', ''),
(2952, '[Logged In] admin@admin.com', '2023-11-22 02:39:08', ''),
(2953, '[Update Product] -Test coffe one by siva  -Qty-131 ID 8', '2023-11-22 06:23:21', 'admin'),
(2954, '[Update Product] -Dolo 650  -Qty-142 ID 7', '2023-11-22 06:37:36', 'admin'),
(2955, '[New Product] -Dolo 650  -Qty-142 ID 7', '2023-11-22 06:37:36', 'admin'),
(2956, '[New Product] -Dolo 650  -Qty-142 ID 7', '2023-11-22 06:37:36', 'admin'),
(2957, '[New Product] -hjghjghj  -Qty-100 ID 14', '2023-11-22 06:45:23', 'admin'),
(2958, '[Update Product] -hjghjghj  -Qty-100 ID 14', '2023-11-22 07:01:53', 'admin'),
(2959, '[Update Product] -hjghjghj  -Qty-100 ID 14', '2023-11-22 07:05:48', 'admin'),
(2960, '[Update Product] -hjghjghj  -Qty-100 ID 14', '2023-11-22 07:27:21', 'admin'),
(2961, '[Update Product] -hjghjghj  -Qty-100 ID 14', '2023-11-22 07:27:48', 'admin'),
(2962, '[New Product] -hghjghj  -Qty-100 ID 15', '2023-11-26 01:42:30', 'admin'),
(2963, '[New Product] -hghjghj  -Qty-100 ID 16', '2023-11-26 01:42:42', 'admin'),
(2964, '[New Product] -hghjghj  -Qty-100 ID 17', '2023-11-26 01:43:43', 'admin'),
(2965, '[New Product] -hghjghj  -Qty-100 ID 18', '2023-11-26 01:44:04', 'admin'),
(2966, '[New Product] -hghjghj  -Qty-100 ID 19', '2023-11-26 01:44:09', 'admin'),
(2967, '[New Product] -hghjghj  -Qty-100 ID 20', '2023-11-26 01:45:21', 'admin'),
(2968, '[New Product] -hghjghj  -Qty-100 ID 21', '2023-11-26 01:47:05', 'admin'),
(2969, '[New Product] -hghjghj  -Qty-100 ID 22', '2023-11-26 01:47:24', 'admin'),
(2970, '[Logged In] admin@admin.com', '2023-11-30 22:31:01', ''),
(2971, '[Logged In] admin@admin.com', '2023-11-30 22:35:16', ''),
(2972, '[Logged In] admin@admin.com', '2023-12-02 02:30:58', ''),
(2973, '[Logged In] admin@admin.com', '2023-12-02 11:30:37', ''),
(2974, '[Logged In] admin@admin.com', '2023-12-02 11:50:21', ''),
(2975, '[Logged In] admin@admin.com', '2023-12-03 07:29:37', ''),
(2976, '[Logged In] admin@admin.com', '2023-12-03 08:46:30', ''),
(2977, '[Logged In] admin@admin.com', '2023-12-03 20:48:32', ''),
(2978, '[Logged In] admin@admin.com', '2023-12-03 22:41:37', ''),
(2979, '[Logged In] admin@admin.com', '2023-12-04 05:55:55', ''),
(2980, '[Logged In] admin@admin.com', '2023-12-04 06:55:16', ''),
(2981, '[Logged In] admin@admin.com', '2023-12-04 07:56:09', ''),
(2982, '[Logged In] admin@admin.com', '2023-12-04 20:29:57', ''),
(2983, '[Logged In] admin@admin.com', '2023-12-04 20:42:58', ''),
(2984, '[Logged In] admin@admin.com', '2023-12-04 22:59:56', ''),
(2985, '[Logged In] admin@admin.com', '2023-12-04 23:04:59', ''),
(2986, '[Logged In] admin@admin.com', '2023-12-05 01:00:07', ''),
(2987, '[Logged In] admin@admin.com', '2023-12-05 01:01:51', ''),
(2988, '[Logged In] admin@admin.com', '2023-12-05 19:45:15', ''),
(2989, '[Logged In] admin@admin.com', '2023-12-08 02:17:16', ''),
(2990, '[Logged In] admin@admin.com', '2023-12-08 19:20:17', ''),
(2991, '[Logged In] admin@admin.com', '2023-12-10 21:23:46', ''),
(2992, '[Logged In] admin@admin.com', '2023-12-11 03:08:45', ''),
(2993, '[Logged In] admin@admin.com', '2023-12-11 18:51:40', ''),
(2994, '[Logged In] admin@admin.com', '2023-12-11 19:12:17', ''),
(2995, '[Logged In] admin@admin.com', '2023-12-12 21:01:19', ''),
(2996, '[Logged In] admin@admin.com', '2023-12-12 21:05:13', ''),
(2997, '[Logged In] admin@admin.com', '2023-12-13 00:25:36', ''),
(2998, '[Logged In] admin@admin.com', '2023-12-13 00:26:25', ''),
(2999, '[Logged In] admin@admin.com', '2023-12-13 17:15:36', ''),
(3000, '[Logged In] admin@admin.com', '2023-12-14 00:42:23', ''),
(3001, '[Employee ClockIn]  ID 6', '2023-12-17 19:41:05', 'admin'),
(3002, '[Logged In] admin@admin.com', '2023-12-18 18:51:09', ''),
(3003, '[Logged Out] admin', '2023-12-18 20:07:10', ''),
(3004, '[Logged In] admin@admin.com', '2023-12-18 20:07:30', ''),
(3005, '[Logged Out] admin', '2023-12-18 20:08:03', ''),
(3006, '[Logged In] sprasad96@gmail.com', '2023-12-18 20:08:14', ''),
(3007, '[Logged Out] sivaaaa', '2023-12-18 20:10:24', ''),
(3008, '[Logged In] sprasad96@gmail.com', '2023-12-18 20:10:31', ''),
(3009, '[Logged Out] sivaaaa', '2023-12-18 20:11:32', ''),
(3010, '[Logged In] sprasad96@gmail.com', '2023-12-18 20:12:09', ''),
(3011, '[Logged Out] sivaaaa', '2023-12-18 20:14:23', ''),
(3012, '[Logged In] sprasad96@gmail.com', '2023-12-18 20:14:27', ''),
(3013, '[Employee ClockIn]  ID 50', '2023-12-18 20:16:32', 'sivaaaa'),
(3014, '[Employee Short Break Start]  ID 50', '2023-12-18 20:16:43', 'sivaaaa'),
(3015, '[Employee Short Break End By System Due to ClockOut]  ID 50', '2023-12-18 20:20:58', 'sivaaaa'),
(3016, '[Employee ClockOut]  ID 50', '2023-12-18 20:20:58', 'sivaaaa'),
(3017, '[Employee ClockIn]  ID 50', '2023-12-18 20:21:02', 'sivaaaa'),
(3018, '[Employee Short Break Start]  ID 50', '2023-12-18 20:21:07', 'sivaaaa'),
(3019, '[Employee Short Break End]  ID 50', '2023-12-18 20:21:10', 'sivaaaa'),
(3020, '[Employee Lunch Break Start]  ID 50', '2023-12-18 20:21:15', 'sivaaaa'),
(3021, '[Employee Lunch Break End]  ID 50', '2023-12-18 20:21:19', 'sivaaaa'),
(3022, '[Employee Away Start]  ID 50', '2023-12-18 20:21:24', 'sivaaaa'),
(3023, '[Employee Away End]  ID 50', '2023-12-18 20:21:28', 'sivaaaa'),
(3024, '[Logged Out] sivaaaa', '2023-12-18 20:22:08', ''),
(3025, '[Logged In] admin@admin.com', '2023-12-18 20:22:13', ''),
(3026, '[Payment Invoice 116]  Transaction-90 - 43 ', '2023-12-18 21:16:07', NULL),
(3027, '[Payment Invoice 117]  Transaction-91 - 43 ', '2023-12-18 21:56:00', NULL),
(3028, '[Payment Invoice 118]  Transaction-92 - 297 ', '2023-12-18 22:20:14', NULL),
(3029, '[Payment Invoice 119]  Transaction-93 - 297 ', '2023-12-18 22:20:37', NULL),
(3030, '[Jobsheets Added]  TaskId 107', '2023-12-21 00:35:12', 'admin'),
(3031, '[New Product] -khgjg  -Qty-100 ID 23', '2023-12-21 00:45:29', 'admin'),
(3032, '[Logged In] admin@admin.com', '2023-12-21 00:56:09', ''),
(3033, '[Jobsheets Added]  TaskId 108', '2023-12-21 02:12:42', 'admin'),
(3034, '[Logged Out] admin', '2023-12-21 02:22:07', ''),
(3035, '[Logged In] admin@admin.com', '2023-12-21 02:36:56', ''),
(3036, '[Logged In] admin@admin.com', '2023-12-21 02:56:15', ''),
(3037, '[Logged Out] admin', '2023-12-21 03:33:39', ''),
(3038, '[Logged In] admin@admin.com', '2023-12-21 03:49:22', ''),
(3039, '[Logged In] admin@admin.com', '2023-12-21 07:27:02', ''),
(3040, '[Logged In] admin@admin.com', '2023-12-21 07:43:20', ''),
(3041, '[Logged In] admin@admin.com', '2023-12-21 22:56:21', ''),
(3042, '[Logged In] admin@admin.com', '2023-12-26 19:08:18', ''),
(3043, '[Logged In] admin@admin.com', '2023-12-27 20:06:29', ''),
(3044, '[Logged In] admin@admin.com', '2023-12-28 19:37:30', ''),
(3045, '[Logged In] admin@admin.com', '2023-12-28 20:43:56', ''),
(3046, '[Logged In] admin@admin.com', '2024-01-02 20:18:10', ''),
(3047, '[Logged In] admin@admin.com', '2024-01-02 22:23:20', ''),
(3048, '[Logged In] admin@admin.com', '2024-01-03 19:49:53', ''),
(3049, '[Client Deleted]  ID 115', '2024-01-03 19:52:57', 'admin'),
(3050, '[Client Doc Deleted]  DocId 115 CID 115', '2024-01-03 19:52:57', 'admin'),
(3051, '[Logged In] admin@admin.com', '2024-01-04 18:29:45', ''),
(3052, '[Logged In] admin@admin.com', '2024-01-05 01:03:03', ''),
(3053, '[Logged In] admin@admin.com', '2024-01-06 03:02:23', ''),
(3054, '[Logged In] admin@admin.com', '2024-01-06 06:48:07', ''),
(3055, '[Logged In] admin@admin.com', '2024-01-06 19:44:43', ''),
(3056, '[Logged In] admin@admin.com', '2024-01-06 21:54:47', ''),
(3057, '[Logged In] admin@admin.com', '2024-01-07 00:15:36', ''),
(3058, '[Logged In] admin@admin.com', '2024-01-07 02:39:54', ''),
(3059, '[Logged Out] admin', '2024-01-07 03:08:24', ''),
(3060, '[Logged In] admin@admin.com', '2024-01-07 03:37:45', ''),
(3061, '[Logged In] admin@admin.com', '2024-01-07 18:48:29', ''),
(3062, '[Logged In] admin@admin.com', '2024-01-07 20:58:43', ''),
(3063, '[Logged In] admin@admin.com', '2024-01-07 23:40:05', ''),
(3064, '[Employee ClockIn]  ID 6', '2024-01-08 00:43:44', 'admin'),
(3065, '[Employee ClockIn]  ID 6', '2024-01-08 00:43:48', 'admin'),
(3066, '[Employee ClockIn]  ID 6', '2024-01-08 00:44:12', 'admin'),
(3067, '[Logged Out] admin', '2024-01-08 00:45:22', ''),
(3068, '[Logged In] admin@admin.com', '2024-01-08 00:59:51', ''),
(3069, '[Logged In] admin@admin.com', '2024-01-08 02:02:10', ''),
(3070, '[Logged In] admin@admin.com', '2024-01-08 21:24:10', ''),
(3071, '[Logged In] admin@admin.com', '2024-01-09 19:56:17', ''),
(3072, '[Logged Out] admin', '2024-01-09 19:57:43', '');
INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(3073, '[Logged In] admin@admin.com', '2024-01-09 19:58:10', ''),
(3074, '[Employee ClockIn]  ID 6', '2024-01-09 19:59:06', 'admin'),
(3075, '[Logged Out] admin', '2024-01-09 20:09:46', ''),
(3076, '[Logged In] siva@jsoftsolution.com.my', '2024-01-09 20:10:01', ''),
(3077, '[Employee ClockIn]  ID 67', '2024-01-09 20:11:23', 'Sivaprasad'),
(3078, '[Employee ClockOut]  ID 67', '2024-01-09 20:11:27', 'Sivaprasad'),
(3079, '[Logged Out] Sivaprasad', '2024-01-09 20:11:45', ''),
(3080, '[Logged In] admin@admin.com', '2024-01-09 20:11:50', ''),
(3081, '[Logged Out] admin', '2024-01-09 20:12:34', ''),
(3082, '[Logged In] siva@jsoftsolution.com.my', '2024-01-09 20:12:41', ''),
(3083, '[Logged In] admin@admin.com', '2024-01-09 22:55:17', ''),
(3084, '[Logged In] admin@admin.com', '2024-01-10 20:46:29', ''),
(3085, '[Logged Out] admin', '2024-01-10 20:47:40', ''),
(3086, '[Logged In] admin@admin.com', '2024-01-14 18:31:29', ''),
(3087, '[Jobsheets Doc Added]  DocId jhkjhkj ComplaintId 109', '2024-01-14 18:46:25', 'admin'),
(3088, '[Jobsheets Added]  TaskId 109', '2024-01-14 18:46:25', 'admin'),
(3089, '[Jobsheets Doc Added]  DocId jhjhjkhjk ComplaintId 114', '2024-01-14 18:55:42', 'admin'),
(3090, '[Jobsheets Added]  TaskId 114', '2024-01-14 18:55:42', 'admin'),
(3091, '[Jobsheets Doc Added]  DocId hjgj ComplaintId 115', '2024-01-14 19:20:35', 'admin'),
(3092, '[Jobsheets Added]  TaskId 115', '2024-01-14 19:20:35', 'admin'),
(3093, '[Logged In] admin@admin.com', '2024-01-14 20:38:13', ''),
(3094, '[Logged In] admin@admin.com', '2024-01-17 19:15:42', ''),
(3095, '[Logged Out] admin', '2024-01-17 19:16:55', ''),
(3096, '[Logged In] abcd@gmail.com', '2024-01-17 19:17:12', ''),
(3097, '[Employee ClockIn]  ID 3', '2024-01-17 19:18:22', 'abcd'),
(3098, '[Employee ClockOut]  ID 3', '2024-01-17 19:18:28', 'abcd'),
(3099, '[Employee ClockIn]  ID 3', '2024-01-17 19:21:18', 'abcd'),
(3100, '[Employee ClockOut]  ID 3', '2024-01-17 19:27:25', 'abcd'),
(3101, '[Employee ClockIn]  ID 3', '2024-01-17 20:15:06', 'abcd'),
(3102, '[Logged Out] abcd', '2024-01-18 00:19:19', ''),
(3103, '[Logged In] admin@admin.com', '2024-01-18 00:19:24', ''),
(3104, '[Jobsheets Added]  TaskId 115', '2024-01-18 00:39:34', 'admin'),
(3105, '[Jobsheets Added]  TaskId 116', '2024-01-18 00:40:55', 'admin'),
(3106, '[Jobsheets Added]  TaskId 116', '2024-01-18 00:44:44', 'admin'),
(3107, '[Logged In] admin@admin.com', '2024-01-18 02:22:55', ''),
(3108, '[Logged In] admin@admin.com', '2024-01-20 00:13:35', ''),
(3109, '[Employee ClockIn]  ID 6', '2024-01-20 01:28:14', 'admin'),
(3110, '[Employee ClockIn]  ID 6', '2024-01-20 01:28:16', 'admin'),
(3111, '[Logged Out] admin', '2024-01-20 01:28:18', ''),
(3112, '[Logged In] abcd@gmail.com', '2024-01-20 01:28:25', ''),
(3113, '[Employee ClockOut]  ID 3', '2024-01-20 01:28:40', 'abcd'),
(3114, '[Employee ClockIn]  ID 3', '2024-01-20 01:29:34', 'abcd'),
(3115, '[Employee ClockOut]  ID 3', '2024-01-20 01:40:42', 'abcd'),
(3116, '[Employee ClockIn]  ID 3', '2024-01-20 01:42:37', 'abcd'),
(3117, '[Employee ClockOut]  ID 3', '2024-01-20 01:42:52', 'abcd'),
(3118, '[Employee ClockIn]  ID 3', '2024-01-20 01:51:25', 'abcd'),
(3119, '[Employee ClockOut]  ID 3', '2024-01-20 01:51:35', 'abcd'),
(3120, '[Logged Out] abcd', '2024-01-20 02:20:56', ''),
(3121, '[Logged In] admin@admin.com', '2024-01-20 02:21:01', ''),
(3122, '[Client Doc Added]  DocId earewqrqwe CID 58', '2024-01-20 10:29:26', 'admin'),
(3123, '[Client Doc Deleted]  DocId 1 CID 114', '2024-01-20 10:29:39', 'admin'),
(3124, '[Client Doc Deleted]  DocId 56 CID 114', '2024-01-20 10:29:48', 'admin'),
(3125, '[Employee ClockIn]  ID 6', '2024-01-21 17:46:55', 'admin'),
(3126, '[Employee ClockIn]  ID 6', '2024-01-21 17:46:59', 'admin'),
(3127, '[Employee ClockIn]  ID 6', '2024-01-21 17:47:18', 'admin'),
(3128, '[Employee ClockIn]  ID 6', '2024-01-21 17:47:48', 'admin'),
(3129, '[Employee ClockIn]  ID 6', '2024-01-21 17:48:00', 'admin'),
(3130, '[Logged Out] admin', '2024-01-21 18:00:48', ''),
(3131, '[Logged In] abcd@gmail.com', '2024-01-21 18:00:55', ''),
(3132, '[Logged Out] abcd', '2024-01-21 18:07:39', ''),
(3133, '[Logged In] admin@admin.com', '2024-01-21 18:07:43', ''),
(3134, '[Logged Out] admin', '2024-01-21 22:35:51', ''),
(3135, '[Logged In] abcd@gmail.com', '2024-01-21 22:35:57', ''),
(3136, '[Employee ClockIn]  ID 3', '2024-01-21 22:36:56', 'abcd'),
(3137, '[Employee ClockOut]  ID 3', '2024-01-21 22:40:30', 'abcd'),
(3138, '[Employee ClockIn]  ID 3', '2024-01-21 22:41:10', 'abcd'),
(3139, '[Employee ClockOut]  ID 3', '2024-01-21 22:42:59', 'abcd'),
(3140, '[Employee ClockIn]  ID 3', '2024-01-21 22:43:28', 'abcd'),
(3141, '[Employee ClockOut]  ID 3', '2024-01-21 22:48:09', 'abcd'),
(3142, '[Employee ClockIn]  ID 3', '2024-01-21 22:48:47', 'abcd'),
(3143, '[Employee ClockOut]  ID 3', '2024-01-21 22:50:46', 'abcd'),
(3144, '[Employee ClockIn]  ID 3', '2024-01-21 22:51:22', 'abcd'),
(3145, '[Employee ClockOut]  ID 3', '2024-01-21 23:14:04', 'abcd'),
(3146, '[Employee ClockIn]  ID 3', '2024-01-21 23:16:21', 'abcd'),
(3147, '[Employee ClockOut]  ID 3', '2024-01-21 23:16:38', 'abcd'),
(3148, '[Logged Out] abcd', '2024-01-22 00:25:23', ''),
(3149, '[Logged In] admin@admin.com', '2024-01-22 00:25:28', ''),
(3150, '[Jobsheets Added]  TaskId 117', '2024-01-22 00:56:30', 'admin'),
(3151, '[Jobsheets Added]  TaskId 118', '2024-01-22 00:58:48', 'admin'),
(3152, '[Jobsheets Added]  TaskId 119', '2024-01-22 01:01:13', 'admin'),
(3153, '[Jobsheets Added]  TaskId 120', '2024-01-22 02:57:01', 'admin'),
(3154, '[Logged Out] admin', '2024-01-22 11:12:16', ''),
(3155, '[Logged In] abcd@gmail.com', '2024-01-22 11:12:21', ''),
(3156, '[Logged Out] abcd', '2024-01-23 02:47:19', ''),
(3157, '[Logged In] admin@admin.com', '2024-01-23 02:53:23', ''),
(3158, '[Logged Out] admin', '2024-01-23 02:53:37', ''),
(3159, '[Logged In] abcd@gmail.com', '2024-01-23 02:53:41', ''),
(3160, '[Employee ClockIn]  ID 3', '2024-01-23 04:41:50', 'abcd'),
(3161, '[Employee ClockOut]  ID 3', '2024-01-23 05:30:18', 'abcd'),
(3162, '[Employee ClockIn]  ID 3', '2024-01-23 05:33:19', 'abcd'),
(3163, '[Employee ClockOut]  ID 3', '2024-01-23 05:34:07', 'abcd'),
(3164, '[Employee ClockIn]  ID 3', '2024-01-23 05:37:48', 'abcd'),
(3165, '[Employee ClockOut]  ID 3', '2024-01-23 05:38:02', 'abcd'),
(3166, '[Employee ClockIn]  ID 3', '2024-01-23 05:40:49', 'abcd'),
(3167, '[Employee ClockOut]  ID 3', '2024-01-23 05:41:10', 'abcd'),
(3168, '[Employee ClockIn]  ID 3', '2024-01-23 05:43:50', 'abcd'),
(3169, '[Logged Out] abcd', '2024-01-23 07:24:55', ''),
(3170, '[Logged In] admin@admin.com', '2024-01-23 07:41:21', ''),
(3171, '[Logged Out] admin', '2024-01-23 08:14:58', ''),
(3172, '[Logged In] abcd@gmail.com', '2024-01-23 08:15:02', ''),
(3173, '[Logged Out] abcd', '2024-01-23 08:53:55', ''),
(3174, '[Logged In] admin@admin.com', '2024-01-23 08:54:00', ''),
(3175, '[Logged Out] admin', '2024-01-24 05:30:34', ''),
(3176, '[Logged In] abcd@gmail.com', '2024-01-24 05:30:39', ''),
(3177, '[Logged Out] abcd', '2024-01-24 05:53:52', ''),
(3178, '[Logged In] admin@admin.com', '2024-01-24 06:39:32', ''),
(3179, '[Employee ClockIn]  ID 6', '2024-01-24 06:53:34', 'admin'),
(3180, '[Employee ClockIn]  ID 6', '2024-01-24 06:53:37', 'admin'),
(3181, '[Employee ClockIn]  ID 6', '2024-01-24 06:53:38', 'admin'),
(3182, '[Employee ClockIn]  ID 6', '2024-01-24 06:53:38', 'admin'),
(3183, '[Employee ClockIn]  ID 6', '2024-01-24 06:53:39', 'admin'),
(3184, '[Logged Out] admin', '2024-01-24 07:43:57', ''),
(3185, '[Logged In] abcd@gmail.com', '2024-01-24 07:44:01', ''),
(3186, '[Logged Out] abcd', '2024-01-24 07:46:02', ''),
(3187, '[Logged In] admin@admin.com', '2024-01-24 07:47:59', ''),
(3188, '[Logged Out] admin', '2024-01-24 08:38:42', ''),
(3189, '[Logged In] abcd@gmail.com', '2024-01-24 09:01:44', ''),
(3190, '[Employee ClockOut]  ID 3', '2024-01-24 09:26:56', 'abcd'),
(3191, '[Employee ClockIn]  ID 3', '2024-01-24 09:35:53', 'abcd'),
(3192, '[Employee ClockOut]  ID 3', '2024-01-24 09:36:56', 'abcd'),
(3193, '[Employee ClockIn]  ID 3', '2024-01-24 09:41:52', 'abcd'),
(3194, '[Employee ClockOut]  ID 3', '2024-01-24 09:43:48', 'abcd'),
(3195, '[Employee ClockIn]  ID 3', '2024-01-24 09:46:12', 'abcd'),
(3196, '[Employee ClockOut]  ID 3', '2024-01-24 09:47:35', 'abcd'),
(3197, '[Employee ClockIn]  ID 3', '2024-01-24 09:50:04', 'abcd'),
(3198, '[Employee ClockOut]  ID 3', '2024-01-24 09:51:14', 'abcd'),
(3199, '[Employee ClockIn]  ID 3', '2024-01-24 09:52:44', 'abcd'),
(3200, '[Logged Out] abcd', '2024-01-24 09:59:05', ''),
(3201, '[Logged In] admin@admin.com', '2024-01-24 09:59:09', ''),
(3202, '[Employee ClockIn]  ID 6', '2024-01-24 10:13:54', 'admin'),
(3203, '[Employee ClockIn]  ID 6', '2024-01-24 10:13:58', 'admin'),
(3204, '[Employee ClockIn]  ID 6', '2024-01-24 10:13:59', 'admin'),
(3205, '[Employee ClockIn]  ID 6', '2024-01-24 10:14:00', 'admin'),
(3206, '[Employee ClockIn]  ID 6', '2024-01-24 10:14:02', 'admin'),
(3207, '[Employee ClockIn]  ID 6', '2024-01-24 10:14:02', 'admin'),
(3208, '[Employee ClockIn]  ID 6', '2024-01-24 10:14:09', 'admin'),
(3209, '[Employee ClockIn]  ID 6', '2024-01-24 10:14:21', 'admin'),
(3210, '[Logged Out] admin', '2024-01-25 05:47:09', ''),
(3211, '[Logged In] abcd@gmail.com', '2024-01-25 05:47:13', ''),
(3212, '[Logged Out] abcd', '2024-01-25 05:49:29', ''),
(3213, '[Logged In] admin@admin.com', '2024-01-25 05:49:35', ''),
(3214, '[Logged Out] admin', '2024-01-25 06:29:18', ''),
(3215, '[Logged In] abcd@gmail.com', '2024-01-25 06:29:22', ''),
(3216, '[Employee ClockOut]  ID 3', '2024-01-25 06:29:32', 'abcd'),
(3217, '[Logged Out] abcd', '2024-01-25 06:29:48', ''),
(3218, '[Logged In] abcd@gmail.com', '2024-01-25 06:30:41', ''),
(3219, '[Logged Out] abcd', '2024-01-25 06:31:26', ''),
(3220, '[Logged In] admin@admin.com', '2024-01-26 01:45:50', ''),
(3221, '[Logged Out] admin', '2024-01-26 10:51:08', ''),
(3222, '[Logged In] abcd@gmail.com', '2024-01-26 10:51:12', ''),
(3223, '[Logged Out] abcd', '2024-01-26 10:51:26', ''),
(3224, '[Logged In] admin@admin.com', '2024-01-26 10:51:32', ''),
(3225, '[Logged Out] admin', '2024-01-26 10:52:17', ''),
(3226, '[Logged In] abcd@gmail.com', '2024-01-26 10:52:21', ''),
(3227, '[Logged Out] abcd', '2024-01-26 10:52:31', ''),
(3228, '[Logged In] admin@admin.com', '2024-01-26 10:52:45', ''),
(3229, '[Logged Out] admin', '2024-01-26 10:55:15', ''),
(3230, '[Logged In] abcd@gmail.com', '2024-01-26 10:55:21', ''),
(3231, '[Logged Out] abcd', '2024-01-26 10:55:33', ''),
(3232, '[Logged In] admin@admin.com', '2024-01-26 11:01:52', ''),
(3233, '[Jobsheets Added]  TaskId 121', '2024-01-26 11:02:26', 'admin'),
(3234, '[Logged In] admin@admin.com', '2024-01-27 04:36:35', ''),
(3235, '[Logged Out] admin', '2024-01-27 04:37:45', ''),
(3236, '[Logged In] admin@admin.com', '2024-01-27 07:27:09', ''),
(3237, '[Logged Out] admin', '2024-01-27 07:27:19', ''),
(3238, '[Logged In] admin@admin.com', '2024-01-27 07:27:38', ''),
(3239, '[Logged Out] admin', '2024-01-27 07:29:22', ''),
(3240, '[Logged In] admin@admin.com', '2024-01-27 07:30:26', ''),
(3241, '[Logged Out] admin', '2024-01-27 07:31:12', ''),
(3242, '[Logged In] admin@admin.com', '2024-01-27 07:40:05', ''),
(3243, '[Logged Out] admin', '2024-01-29 11:34:12', ''),
(3244, '[Logged In] admin@admin.com', '2024-01-29 11:34:20', ''),
(3245, '[Logged Out] admin', '2024-01-29 11:35:19', ''),
(3246, '[Logged In] admin@admin.com', '2024-01-29 11:40:47', ''),
(3247, '[Logged In] admin@admin.com', '2024-01-30 02:07:55', ''),
(3248, '[Logged In] admin@admin.com', '2024-01-30 04:17:37', ''),
(3249, '[Logged In] admin@admin.com', '2024-01-30 07:26:18', ''),
(3250, '[Logged Out] admin', '2024-01-30 08:02:17', ''),
(3251, '[Logged In] abcd@gmail.com', '2024-01-30 08:02:22', ''),
(3252, '[Employee ClockIn]  ID 3', '2024-01-30 08:02:31', 'abcd'),
(3253, '[Employee ClockOut]  ID 3', '2024-01-30 08:05:31', 'abcd'),
(3254, '[Logged Out] abcd', '2024-01-30 08:05:34', ''),
(3255, '[Logged In] admin@admin.com', '2024-01-30 08:05:39', ''),
(3256, '[Logged Out] admin', '2024-01-30 08:06:14', ''),
(3257, '[Logged In] abcd@gmail.com', '2024-01-30 08:06:19', ''),
(3258, '[Employee ClockIn]  ID 3', '2024-01-30 08:06:28', 'abcd'),
(3259, '[Logged Out] abcd', '2024-01-30 08:06:40', ''),
(3260, '[Logged In] admin@admin.com', '2024-01-30 08:06:47', ''),
(3261, '[Logged Out] admin', '2024-01-30 08:11:43', ''),
(3262, '[Logged In] abcd@gmail.com', '2024-01-30 08:11:48', ''),
(3263, '[Employee ClockOut]  ID 3', '2024-01-30 08:11:59', 'abcd'),
(3264, '[Logged Out] abcd', '2024-01-30 08:12:04', ''),
(3265, '[Logged In] admin@admin.com', '2024-01-30 08:12:14', ''),
(3266, '[Logged In] admin@admin.com', '2024-01-30 09:40:37', ''),
(3267, '[Logged In] admin@admin.com', '2024-01-30 11:41:12', ''),
(3268, '[Logged In] admin@admin.com', '2024-01-31 02:36:07', ''),
(3269, '[Logged In] admin@admin.com', '2024-01-31 04:23:50', ''),
(3270, '[Logged In] admin@admin.com', '2024-01-31 07:39:19', ''),
(3271, '[Logged In] admin@admin.com', '2024-01-31 09:18:11', ''),
(3272, '[Logged In] admin@admin.com', '2024-01-31 09:39:45', ''),
(3273, '[Logged In] admin@admin.com', '2024-01-31 11:43:04', ''),
(3274, '[Logged In] admin@admin.com', '2024-01-31 16:12:49', ''),
(3275, '[Logged In] admin@admin.com', '2024-01-31 18:43:48', ''),
(3276, '[Logged In] admin@admin.com', '2024-01-31 20:47:31', ''),
(3277, '[Logged In] admin@admin.com', '2024-02-01 06:20:10', ''),
(3278, '[Logged In] admin@admin.com', '2024-02-01 08:04:36', ''),
(3279, '[Logged In] admin@admin.com', '2024-02-01 10:04:37', ''),
(3280, '[Jobsheets Added]  TaskId 122', '2024-02-01 10:23:13', 'admin'),
(3281, '[Jobsheets Added]  TaskId 123', '2024-02-01 10:24:45', 'admin'),
(3282, '[Logged Out] admin', '2024-02-01 10:43:54', ''),
(3283, '[Logged In] admin@admin.com', '2024-02-01 10:43:59', ''),
(3284, '[Logged Out] admin', '2024-02-01 10:44:04', ''),
(3285, '[Logged In] abcd@gmail.com', '2024-02-01 10:44:09', ''),
(3286, '[Logged Out] abcd', '2024-02-01 10:44:18', ''),
(3287, '[Logged In] admin@admin.com', '2024-02-01 10:44:24', ''),
(3288, '[Logged Out] admin', '2024-02-01 10:44:55', ''),
(3289, '[Logged In] abcd@gmail.com', '2024-02-01 10:44:58', ''),
(3290, '[Logged Out] abcd', '2024-02-01 10:45:32', ''),
(3291, '[Logged In] admin@admin.com', '2024-02-01 10:45:38', ''),
(3292, '[Logged Out] admin', '2024-02-01 11:18:17', ''),
(3293, '[Logged In] abcd@gmail.com', '2024-02-01 11:18:21', ''),
(3294, '[Logged Out] abcd', '2024-02-01 11:20:53', ''),
(3295, '[Logged In] admin@admin.com', '2024-02-01 11:20:58', ''),
(3296, '[Logged In] admin@admin.com', '2024-02-01 12:04:39', ''),
(3297, '[Logged In] admin@admin.com', '2024-02-01 17:06:09', ''),
(3298, '[Logged In] admin@admin.com', '2024-02-02 02:01:27', ''),
(3299, '[Client Added] hghjghjg ID 116', '2024-02-02 02:47:00', 'admin'),
(3300, '[Logged In] admin@admin.com', '2024-02-02 04:16:02', ''),
(3301, '[Logged Out] admin', '2024-02-02 05:20:22', ''),
(3302, '[Logged In] admin@admin.com', '2024-02-02 05:30:14', ''),
(3303, '[Logged In] admin@admin.com', '2024-02-05 05:49:34', ''),
(3304, '[Logged In] admin@admin.com', '2024-02-05 07:50:09', ''),
(3305, '[Jobsheets Added]  TaskId 124', '2024-02-05 07:50:39', 'admin'),
(3306, '[Logged Out] admin', '2024-02-05 08:53:22', ''),
(3307, '[Logged In] admin@admin.com', '2024-02-05 08:58:15', ''),
(3308, '[Logged Out] admin', '2024-02-05 09:25:09', ''),
(3309, '[Logged In] abcd@gmail.com', '2024-02-05 09:25:25', ''),
(3310, '[Employee ClockIn]  ID 3', '2024-02-05 09:26:11', 'abcd'),
(3311, '[Logged In] admin@admin.com', '2024-02-05 10:00:25', ''),
(3312, '[Logged In] abcd@gmail.com', '2024-02-05 16:27:16', ''),
(3313, '[Logged Out] abcd', '2024-02-05 16:28:18', ''),
(3314, '[Logged In] abcd@gmail.com', '2024-02-05 16:28:32', ''),
(3315, '[Logged Out] abcd', '2024-02-05 16:28:46', ''),
(3316, '[Logged In] admin@admin.com', '2024-02-05 16:40:28', ''),
(3317, '[Logged In] admin@admin.com', '2024-02-06 02:53:17', ''),
(3318, '[Logged Out] admin', '2024-02-06 02:56:22', ''),
(3319, '[Logged In] abcd@gmail.com', '2024-02-06 02:58:04', ''),
(3320, '[Logged Out] abcd', '2024-02-06 03:22:32', ''),
(3321, '[Logged In] admin@admin.com', '2024-02-06 03:22:36', ''),
(3322, '[Logged Out] abcd', '2024-02-06 06:46:21', ''),
(3323, '[Logged In] admin@admin.com', '2024-02-06 06:46:35', ''),
(3324, '[Logged In] admin@admin.com', '2024-02-06 07:38:01', ''),
(3325, '[Logged In] admin@admin.com', '2024-02-06 09:16:29', ''),
(3326, '[Logged In] admin@admin.com', '2024-02-06 09:36:36', ''),
(3327, '[Logged In] admin@admin.com', '2024-02-06 14:31:52', ''),
(3328, '[Logged In] admin@admin.com', '2024-02-06 14:34:16', ''),
(3329, '[Logged In] admin@admin.com', '2024-02-06 14:42:14', ''),
(3330, '[Logged Out] admin', '2024-02-06 16:14:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_login_attempts`
--

DROP TABLE IF EXISTS `gtg_login_attempts`;
CREATE TABLE IF NOT EXISTS `gtg_login_attempts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1754 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_login_attempts`
--

INSERT INTO `gtg_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(9, '103.240.163.65', '2022-10-29 10:42:25', 1),
(14, '103.240.163.110', '2023-01-20 06:47:38', 3),
(15, '103.240.163.110', '2023-01-20 09:17:25', 2),
(16, '103.240.163.110', '2023-01-20 09:25:13', 3),
(78, '::1', '2023-02-15 07:06:29', 1),
(79, '::1', '2023-02-16 03:42:23', 1),
(80, '::1', '2023-02-16 06:11:35', 1),
(81, '::1', '2023-02-16 10:16:41', 1),
(85, '::1', '2023-02-16 13:18:29', 1),
(109, '::1', '2023-02-23 07:58:07', 4),
(112, '::1', '2023-02-28 06:33:45', 1),
(114, '::1', '2023-02-28 15:59:29', 1),
(133, '::1', '2023-03-13 09:06:36', 1),
(149, '::1', '2023-03-15 09:52:43', 1),
(151, '::1', '2023-03-16 07:45:25', 1),
(152, '127.0.0.1', '2023-03-20 10:27:12', 1),
(160, '::1', '2023-04-04 05:36:51', 1),
(464, '119.40.126.228', '2023-05-18 22:13:05', 1),
(521, '2402:3a80:1912:74af:cc88:98b8:6b1f:3af7', '2023-05-24 01:09:25', 2),
(597, '121.122.100.10', '2023-05-30 04:49:54', 1),
(808, '42.106.178.71', '2023-06-08 11:44:26', 1),
(840, '42.106.178.17', '2023-06-10 05:40:26', 1),
(843, '42.106.178.17', '2023-06-10 13:25:32', 1),
(868, '121.121.85.171', '2023-06-12 04:28:25', 1),
(967, '119.40.126.229', '2023-06-19 01:49:40', 1),
(1106, '121.122.100.129', '2023-06-30 02:32:52', 2),
(1180, '121.121.84.48', '2023-07-10 09:52:16', 2),
(1315, '115.164.140.6', '2023-07-19 05:18:08', 1),
(1356, '127.0.0.1', '2023-07-23 19:07:35', 2),
(1518, '::1', '2023-09-25 04:38:32', 1),
(1647, '127.0.0.1', '2024-01-08 08:45:49', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_metadata`
--

DROP TABLE IF EXISTS `gtg_metadata`;
CREATE TABLE IF NOT EXISTS `gtg_metadata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `rid` int NOT NULL,
  `col1` varchar(255) DEFAULT NULL,
  `col2` varchar(255) DEFAULT NULL,
  `d_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_metadata`
--

INSERT INTO `gtg_metadata` (`id`, `type`, `rid`, `col1`, `col2`, `d_date`) VALUES
(1, 9, 1, '2', NULL, '2023-02-10'),
(2, 9, 2, '2000', NULL, '2023-02-10'),
(3, 21, 1, '500', '2023-02-10 04:48:19 Account Recharge by admin', '0000-00-00'),
(4, 9, 3, '200', NULL, '2023-02-13'),
(5, 71, 3, '1', '2', '2023-02-13'),
(6, 71, 3, '1', '2', '2023-02-23'),
(7, 9, 4, '1', NULL, '2023-03-09'),
(8, 9, 5, '1', NULL, '2023-03-13'),
(9, 21, 10, '2', '2023-03-21 09:25:44 Account Recharge by admin', '0000-00-00'),
(10, 9, 6, '1', NULL, '2023-04-04'),
(11, 9, 7, '99', NULL, '2023-04-06'),
(12, 9, 8, '423', NULL, '2023-04-06'),
(13, 9, 9, '2344', NULL, '2023-04-06'),
(14, 9, 10, '12', NULL, '2023-04-06'),
(15, 1, 10, '682605RadSystems.lnk', NULL, '0000-00-00'),
(16, 9, 11, '13', NULL, '2023-04-06'),
(17, 9, 12, '200', NULL, '2023-04-18'),
(18, 9, 13, '22', NULL, '2023-04-18'),
(19, 9, 14, '60', NULL, '2023-04-18'),
(20, 9, 15, '150', NULL, '2023-04-18'),
(21, 9, 16, '100', NULL, '2023-04-18'),
(22, 9, 17, '4324', NULL, '2023-04-18'),
(23, 9, 18, '50', NULL, '2023-04-19'),
(24, 9, 19, '30', NULL, '2023-04-19'),
(25, 9, 20, '50', NULL, '2023-04-19'),
(26, 9, 21, '100', NULL, '2023-05-04'),
(27, 9, 22, '700', NULL, '2023-05-05'),
(28, 9, 23, '590', NULL, '2023-05-09'),
(29, 9, 24, '5', NULL, '2023-05-12'),
(30, 9, 25, '300', NULL, '2023-05-16'),
(31, 9, 26, '150', NULL, '2023-05-17'),
(32, 21, 13, '10000', '2023-05-17 04:28:08 Account Recharge by admin', '0000-00-00'),
(33, 9, 27, '1', NULL, '2023-05-17'),
(35, 9, 29, '1', NULL, '2023-05-17'),
(36, 9, 30, '0', NULL, '2023-05-18'),
(37, 9, 1, '2', NULL, '2023-05-18'),
(38, 9, 31, '55', NULL, '2023-05-18'),
(39, 9, 32, '200', NULL, '2023-05-19'),
(40, 9, 33, '0', NULL, '2023-05-31'),
(41, 9, 34, '1', NULL, '2023-05-31'),
(43, 9, 36, '1', NULL, '2023-05-31'),
(44, 9, 37, '1', NULL, '2023-05-31'),
(45, 9, 38, '1500', NULL, '2023-06-07'),
(46, 9, 39, '2000', NULL, '2023-06-07'),
(47, 9, 40, '1000', NULL, '2023-06-12'),
(48, 9, 41, '1', NULL, '2023-06-12'),
(49, 9, 42, '500', NULL, '2023-06-13'),
(50, 9, 43, '5', NULL, '2023-06-14'),
(51, 9, 44, '400', NULL, '2023-06-14'),
(52, 9, 45, '300', NULL, '2023-06-15'),
(53, 9, 46, '0', NULL, '2023-06-15'),
(54, 9, 47, '2500', NULL, '2023-06-16'),
(55, 9, 48, '2500', NULL, '2023-06-16'),
(56, 9, 49, '2500', NULL, '2023-06-16'),
(57, 9, 50, '2500', NULL, '2023-06-16'),
(58, 9, 51, '2500', NULL, '2023-06-16'),
(59, 9, 2, '2000', NULL, '2023-06-21'),
(60, 9, 52, '0', NULL, '2023-06-21'),
(61, 9, 53, '18', NULL, '2023-06-21'),
(62, 9, 54, '700', NULL, '2023-06-27'),
(63, 9, 55, '6', NULL, '2023-06-27'),
(64, 9, 56, '11', NULL, '2023-06-27'),
(65, 9, 57, '11', NULL, '2023-06-28'),
(66, 9, 58, '11', NULL, '2023-06-28'),
(67, 9, 59, '11', NULL, '2023-06-28'),
(68, 9, 60, '12', NULL, '2023-06-28'),
(69, 9, 61, '6', NULL, '2023-06-28'),
(70, 9, 62, '11', NULL, '2023-06-28'),
(71, 9, 63, '6', NULL, '2023-06-28'),
(72, 9, 64, '6', NULL, '2023-06-29'),
(73, 9, 65, '6', NULL, '2023-06-29'),
(74, 9, 66, '0', NULL, '2023-06-29'),
(75, 9, 67, '6', NULL, '2023-06-29'),
(76, 9, 68, '0', NULL, '2023-06-29'),
(77, 9, 69, '0', NULL, '2023-06-29'),
(79, 9, 71, '21', NULL, '2023-07-05'),
(80, 9, 72, '47', NULL, '2023-07-05'),
(81, 9, 73, '52', NULL, '2023-07-05'),
(82, 9, 74, '0', NULL, '2023-07-05'),
(83, 9, 75, '78', NULL, '2023-07-05'),
(84, 9, 76, '104', NULL, '2023-07-05'),
(85, 9, 77, '73', NULL, '2023-07-05'),
(86, 9, 78, '26', NULL, '2023-07-05'),
(87, 9, 79, '125', NULL, '2023-07-05'),
(88, 9, 80, '26', NULL, '2023-07-06'),
(89, 9, 81, '2930', NULL, '2023-07-06'),
(90, 9, 82, '100', NULL, '2023-07-10'),
(91, 9, 83, '100', NULL, '2023-07-10'),
(92, 9, 84, '-308', NULL, '2023-07-10'),
(93, 9, 85, '-86', NULL, '2023-07-10'),
(94, 9, 86, '300', NULL, '2023-07-11'),
(95, 9, 87, '300', NULL, '2023-07-11'),
(96, 9, 88, '300', NULL, '2023-07-11'),
(97, 9, 89, '0', NULL, '2023-07-11'),
(98, 9, 90, '120', NULL, '2023-07-11'),
(99, 9, 91, '10', NULL, '2023-07-11'),
(100, 9, 92, '300', NULL, '2023-07-14'),
(101, 9, 93, '200', NULL, '2023-07-14'),
(102, 9, 94, '300', NULL, '2023-07-14'),
(103, 9, 95, '2300', NULL, '2023-07-14'),
(104, 9, 96, '500', NULL, '2023-07-17'),
(105, 9, 97, '1300', NULL, '2023-07-17'),
(108, 9, 100, '5000', NULL, '2023-07-19'),
(109, 21, 74, '6000', '2023-07-19 06:27:07 Account Recharge by admin', '0000-00-00'),
(110, 1, 96, '164742EMP (1).jpg', NULL, '0000-00-00'),
(111, 21, 75, '2000', '2023-07-19 09:25:53 Account Recharge by admin', '0000-00-00'),
(112, 9, 101, '-127', NULL, '2023-07-19'),
(114, 9, 103, '0', NULL, '2023-07-19'),
(115, 9, 104, '24000', NULL, '2023-07-19'),
(116, 9, 105, '100', NULL, '2023-09-13'),
(117, 9, 106, '1000', NULL, '2023-09-13'),
(118, 9, 107, '2000', NULL, '2023-09-13'),
(120, 9, 109, '0', NULL, '2023-10-05'),
(121, 9, 110, '0', NULL, '2023-10-05'),
(122, 9, 111, '0', NULL, '2023-10-05'),
(123, 9, 112, '-154', NULL, '2023-10-10'),
(124, 9, 3, '200', NULL, '2023-10-11'),
(125, 9, 4, '1', NULL, '2023-10-11'),
(126, 9, 5, '1', NULL, '2023-10-11'),
(127, 9, 6, '0', NULL, '2023-10-11'),
(128, 9, 7, '0', NULL, '2023-10-11'),
(129, 9, 8, '423', NULL, '2023-10-11'),
(130, 9, 9, '0', NULL, '2023-10-11'),
(131, 9, 10, '0', NULL, '2023-10-11'),
(132, 9, 11, '13', NULL, '2023-10-11'),
(133, 9, 12, '200', NULL, '2023-10-11'),
(134, 9, 13, '22', NULL, '2023-10-11'),
(135, 9, 14, '60', NULL, '2023-10-11'),
(136, 9, 15, '150', NULL, '2023-10-11'),
(137, 9, 16, '100', NULL, '2023-10-11'),
(138, 9, 17, '4324', NULL, '2023-10-11'),
(139, 9, 18, '50', NULL, '2023-10-11'),
(140, 9, 19, '30', NULL, '2023-10-11'),
(141, 9, 20, '50', NULL, '2023-10-11'),
(142, 9, 21, '100', NULL, '2023-10-11'),
(143, 9, 22, '700', NULL, '2023-10-11'),
(144, 9, 23, '590', NULL, '2023-10-11'),
(145, 9, 24, '5', NULL, '2023-10-11'),
(146, 9, 25, '300', NULL, '2023-10-11'),
(147, 9, 26, '150', NULL, '2023-10-11'),
(148, 9, 113, '100', NULL, '2023-11-15'),
(149, 9, 1, '0', NULL, '2023-11-16'),
(150, 9, 113, '180', NULL, '2023-11-17'),
(151, 9, 114, '50', NULL, '2023-11-22'),
(152, 9, 115, '20', NULL, '2023-11-22'),
(153, 9, 27, '1', NULL, '2023-12-19'),
(154, 9, 116, '-77', NULL, '2023-12-19'),
(155, 9, 28, '0', NULL, '2023-12-19'),
(156, 9, 117, '-77', NULL, '2023-12-19'),
(157, 9, 118, '280', NULL, '2023-12-19'),
(158, 9, 29, '1', NULL, '2023-12-19'),
(159, 9, 119, '280', NULL, '2023-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_milestones`
--

DROP TABLE IF EXISTS `gtg_milestones`;
CREATE TABLE IF NOT EXISTS `gtg_milestones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `exp` text NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_movers`
--

DROP TABLE IF EXISTS `gtg_movers`;
CREATE TABLE IF NOT EXISTS `gtg_movers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `d_type` int NOT NULL,
  `rid1` int NOT NULL,
  `rid2` int NOT NULL,
  `rid3` int NOT NULL,
  `d_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `d_type` (`d_type`,`rid1`,`rid2`,`rid3`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_movers`
--

INSERT INTO `gtg_movers` (`id`, `d_type`, `rid1`, `rid2`, `rid3`, `d_time`, `note`) VALUES
(1, 1, 1, 10, 0, '2022-04-15 04:12:50', 'Stock Initialized'),
(4, 1, 4, 50, 0, '2023-07-10 05:51:51', 'Stock Initialized'),
(5, 1, 5, 122, 0, '2023-07-10 06:50:13', 'Stock Initialized'),
(6, 1, 6, 200, 0, '2023-07-10 07:10:52', 'Stock Initialized'),
(7, 1, 7, 150, 0, '2023-07-10 07:31:02', 'Stock Initialized'),
(8, 1, 8, 120, 0, '2023-07-23 20:13:23', 'Stock Initialized'),
(9, 1, 9, 100, 0, '2023-11-22 05:39:35', 'Stock Initialized'),
(10, 1, 10, 100, 0, '2023-11-22 05:39:35', 'Stock Initialized'),
(11, 1, 11, 100, 0, '2023-11-22 05:39:35', 'Stock Initialized'),
(12, 1, 12, 100, 0, '2023-11-22 14:37:36', 'Stock Initialized'),
(13, 1, 13, 100, 0, '2023-11-22 14:37:36', 'Stock Initialized'),
(14, 1, 14, 100, 0, '2023-11-22 14:45:23', 'Stock Initialized'),
(22, 1, 22, 100, 0, '2023-11-26 09:47:24', 'Stock Initialized'),
(23, 1, 23, 100, 0, '2023-12-21 08:45:29', 'Stock Initialized');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_notes`
--

DROP TABLE IF EXISTS `gtg_notes`;
CREATE TABLE IF NOT EXISTS `gtg_notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `cdate` date NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cid` int NOT NULL DEFAULT '0',
  `fid` int NOT NULL DEFAULT '0',
  `rid` int NOT NULL DEFAULT '0',
  `ntype` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_office_forms`
--

DROP TABLE IF EXISTS `gtg_office_forms`;
CREATE TABLE IF NOT EXISTS `gtg_office_forms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `form_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `form_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_office_forms`
--

INSERT INTO `gtg_office_forms` (`id`, `form_name`, `form_url`, `status`, `created_at`) VALUES
(1, 'Deployement', '', 0, '2023-12-27 03:39:29'),
(2, 'Project Completion', '', 0, '2023-12-27 03:39:29'),
(3, 'ddd', 'https://localhost/erp-dev/userfiles/office_docs/Awan_Advertistment1705807689.pdf', 1, '2024-01-21 03:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_payroll_settings`
--

DROP TABLE IF EXISTS `gtg_payroll_settings`;
CREATE TABLE IF NOT EXISTS `gtg_payroll_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `basic_salary` int NOT NULL,
  `epf_percent` int NOT NULL,
  `epf_employee_percent` int NOT NULL,
  `epf_employee` int NOT NULL,
  `epf_employer` int NOT NULL,
  `sosco_employer_percent` int NOT NULL,
  `sosco_employee_percent` int NOT NULL,
  `sosco_employer` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sosco_employee` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pcb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `eis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `accountno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tax_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_payroll_settings`
--

INSERT INTO `gtg_payroll_settings` (`id`, `staff_id`, `basic_salary`, `epf_percent`, `epf_employee_percent`, `epf_employee`, `epf_employer`, `sosco_employer_percent`, `sosco_employee_percent`, `sosco_employer`, `sosco_employee`, `pcb`, `eis`, `bank`, `accountno`, `nationality`, `tax_no`, `created_at`, `updated_at`) VALUES
(1, 11, 70000, 0, 9, 6300, 8400, 0, 0, '875', '350', '5', '140', 'ICICI', '1130150648', '1', '2342342344', '2023-05-19 11:26:03', '2023-06-07 14:25:29'),
(2, 3, 300000, 0, 9, 27000, 36000, 0, 0, '3750', '1500', '5', '600', 'ICICI', '1130150648', '1', '', '2023-06-07 02:18:51', '2023-06-07 15:22:16'),
(3, 2, 2500, 13, 11, 275, 325, 0, 0, '31', '13', '0', '5', 'Maybank12', '12345678910', '1', '44332', '2023-06-07 02:25:14', '2023-07-19 09:56:08'),
(4, 4, 10000, 12, 11, 1100, 1200, 1, 1, '125', '50', '0', '20', 'Maybank', '12345678910', '1', '12345678', '2023-06-07 03:39:23', '2023-06-07 15:39:23'),
(5, 28, 3000, 13, 11, 330, 390, 2, 1, '53', '15', '0.00', '5.90', 'CIMB ', '164548239975', '1', '0.00', '2023-07-14 10:38:55', '2023-07-14 10:38:55'),
(6, 27, 6000, 0, 11, 660, 720, 0, 0, '105', '30', '5', '12', 'Maybank', '19030319', '1', '112233445566', '2023-07-18 02:54:35', '2023-07-18 02:58:52'),
(7, 58, 6000, 12, 9, 540, 720, 0, 0, '0', '0', '456415', '12', 'jkhkjh', 'khkjh', '1', 'j', '2024-01-26 12:38:55', '2024-01-26 04:38:55'),
(8, 40, 5000, 13, 11, 550, 650, 1, 1, '62.50', '25.50', '10', '10', 'test', '74174174182', '1', '789654123', '2024-02-05 04:30:35', '2024-02-05 08:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_payslip`
--

DROP TABLE IF EXISTS `gtg_payslip`;
CREATE TABLE IF NOT EXISTS `gtg_payslip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monthText` varchar(20) DEFAULT NULL,
  `month` int NOT NULL,
  `year` varchar(255) NOT NULL,
  `staffId` int DEFAULT NULL,
  `staffName` varchar(100) DEFAULT NULL,
  `employeeId` varchar(255) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `salaryMonth` varchar(30) DEFAULT NULL,
  `epf` varchar(30) DEFAULT NULL,
  `epfPerc` int DEFAULT NULL,
  `socso` varchar(30) DEFAULT NULL,
  `pcb` varchar(30) DEFAULT NULL,
  `allowance` varchar(30) DEFAULT NULL,
  `claims` varchar(30) DEFAULT NULL,
  `commissions` varchar(30) DEFAULT NULL,
  `ot` varchar(30) DEFAULT NULL,
  `bonus` varchar(30) DEFAULT NULL,
  `totalEarning` varchar(30) DEFAULT NULL,
  `totalDeduction` varchar(30) DEFAULT NULL,
  `datePayment` date DEFAULT NULL,
  `bankName` varchar(30) DEFAULT NULL,
  `bankAcc` varchar(255) DEFAULT NULL,
  `netPay` varchar(30) DEFAULT NULL,
  `payslip` varchar(255) DEFAULT NULL,
  `paymentVoucher` varchar(30) DEFAULT NULL,
  `deduction` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gtg_payslip`
--

INSERT INTO `gtg_payslip` (`id`, `monthText`, `month`, `year`, `staffId`, `staffName`, `employeeId`, `designation`, `department`, `salaryMonth`, `epf`, `epfPerc`, `socso`, `pcb`, `allowance`, `claims`, `commissions`, `ot`, `bonus`, `totalEarning`, `totalDeduction`, `datePayment`, `bankName`, `bankAcc`, `netPay`, `payslip`, `paymentVoucher`, `deduction`, `created_at`, `updated_at`) VALUES
(15, 'February', 2, '2023', 3, 'AjmalSoft', '3', 'None', 'None', '300000.00', '36000', 36000, '3750.00', '5.00', '0', '0', '0', '0', '0', '300000', '29105.00', '2023-06-07', 'ICICI', '1130150648', '270895.00', 'P8516359.pdf', NULL, NULL, '2023-06-07 03:22:35', '2023-06-07 15:22:35'),
(12, 'May', 5, '2023', 2, 'Shafeek Ajmal', '2', 'None', 'Sales', '2500.00', '325', 325, '31.00', '0.00', '0', '0', '0', '0', '0', '2500', '293.00', '2023-06-07', 'Maybank', '12345678910', '2207.00', 'P7868626.pdf', NULL, NULL, '2023-06-07 02:57:04', '2023-06-07 14:57:04'),
(13, 'March', 3, '2023', 11, 'Hariinraj', '11', 'None', 'Operation', '70000.00', '8400', 8400, '875.00', '5.00', '0', '0', '0', '0', '0', '70000', '6795.00', '2023-06-07', 'ICICI', '1130150648', '63205.00', 'P2674410.pdf', NULL, NULL, '2023-06-07 02:57:24', '2023-06-07 14:57:24'),
(10, 'Jun', 6, '2023', 11, 'Hariinraj', '11', 'None', 'Operation', '70000.00', '8400', 8400, '875.00', '5.00', '0', '0', '0', '0', '0', '70000', '6795.00', '2023-06-07', 'ICICI', '1130150648', '63205.00', 'P2469282.pdf', NULL, NULL, '2023-06-07 02:56:52', '2023-06-07 14:56:52'),
(16, 'Jun', 6, '2023', 4, 'krish81', '4', 'None', 'None', '10000.00', '1200', 1200, '125.00', '0.00', '0', '0', '0', '0', '0', '10000', '1170.00', '2023-06-07', 'Maybank', '12345678910', '8830.00', 'P2861098.pdf', NULL, NULL, '2023-06-07 03:40:03', '2023-06-07 15:40:03'),
(18, 'Jun', 6, '2023', 27, 'jenifer', '27', 'None', 'None', '6000.00', '720', 720, '105.00', '5.00', '1000.00', '52.00', '48.00', '0', '2000.00', '9100', '707.00', '2023-07-18', 'Maybank', '19030319', '8393.00', 'P7891872.pdf', NULL, NULL, '2023-07-18 03:04:58', '2023-07-18 03:04:58'),
(19, 'January', 1, '2022', 28, 'Alvin', '28', 'None', 'Operation', '3000.00', '390', 390, '53.00', '0.00', '0', '0', '0', '0', '0', '3000', '350.90', '2023-07-19', 'CIMB ', '164548239975', '2649.10', 'P4888528.pdf', NULL, NULL, '2023-07-19 09:57:03', '2023-07-19 09:57:03'),
(35, 'Error', 11, '2023', 3, 'AjmalSoft', '3', 'None', 'None', '300000.00', '36000', 36000, '3750.00', '5.00', '0', '0', '0', '0', '0', '300000', '29105.00', '2023-12-11', 'ICICI', '1130150648', '270895.00', 'P6391444.pdf', NULL, NULL, '2023-12-11 11:45:10', '2023-12-11 11:45:10'),
(36, 'Error', 11, '2023', 2, 'Shafeek Ajmal', '2', 'None', 'Sales', '2500.00', '325', 325, '31.00', '0.00', '0', '0', '0', '0', '0', '2500', '293.00', '2023-12-11', 'Maybank12', '12345678910', '2207.00', 'P7776573.pdf', NULL, NULL, '2023-12-11 11:45:11', '2023-12-11 11:45:11'),
(51, 'December', 12, '2023', 28, 'Alvin', '28', 'Inventory Manager', 'Operation', '3000.00', '390', 390, '53.00', '0.00', '0', '0', '0', '0', '0', '3000', '350.90', '2023-12-13', 'CIMB ', '164548239975', '2649.10', 'P9128393.pdf', NULL, NULL, '2023-12-13 10:50:02', '2023-12-13 10:50:02'),
(50, 'December', 12, '2023', 3, 'AjmalSoft', '3', 'None', 'None', '300000.00', '36000', 36000, '3750.00', '5.00', '0', '0', '0', '0', '0', '300000', '29105.00', '2023-12-11', 'ICICI', '1130150648', '270895.00', 'P6320846.pdf', NULL, NULL, '2023-12-13 10:12:08', '2023-12-13 10:12:08'),
(52, 'January', 1, '2024', 27, 'jenifer', '27', 'None', 'None', '6000.00', '720', 720, '105.00', '5.00', '0', '0', '0', '0', '0', '6000', '707.00', '2024-01-29', 'Maybank', '19030319', '5293.00', 'P2769737.pdf', NULL, NULL, '2024-01-29 12:38:58', '2024-01-29 04:38:58'),
(48, 'December', 12, '2023', 2, 'Shafeek Ajmal', '2', 'None', 'Sales', '2500.00', '325', 325, '31.00', '0.00', '0', '0', '0', '0', '0', '2500', '293.00', '2023-12-13', 'Maybank12', '12345678910', '2207.00', 'P7364891.pdf', NULL, NULL, '2023-12-13 08:40:04', '2023-12-13 08:40:04'),
(47, 'December', 12, '2023', 3, 'AjmalSoft', '3', 'None', 'None', '300000.00', '36000', 36000, '3750.00', '5.00', '0', '0', '0', '0', '0', '300000', '29105.00', '2023-12-13', 'ICICI', '1130150648', '270895.00', 'P5752476.pdf', NULL, NULL, '2023-12-13 08:40:03', '2023-12-13 08:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_peppol_invoices`
--

DROP TABLE IF EXISTS `gtg_peppol_invoices`;
CREATE TABLE IF NOT EXISTS `gtg_peppol_invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_sent_date` date NOT NULL,
  `invoice_id` int NOT NULL,
  `invoice_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `evidence_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `document_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `document_expire_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_peppol_invoices`
--

INSERT INTO `gtg_peppol_invoices` (`id`, `invoice_sent_date`, `invoice_id`, `invoice_json`, `evidence_json`, `document_url`, `document_expire_date`, `guid`, `cr_date`) VALUES
(2, '2023-05-15', 47, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(3, '2023-05-15', 1, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(4, '2023-05-15', 11, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(5, '2023-05-15', 16, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(6, '2023-05-15', 12, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(7, '2023-05-15', 12, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(8, '2023-07-19', 16, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '', 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7', '', '', '0000-00-00 00:00:00'),
(9, '2023-08-18', 94, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"74680727\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"Jsoftsolution\",\"address\":{\"street1\":\"414 Krishna enclave\",\"zip\":\"53453\",\"city\":\"Mohali\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}', '0', '', '', '0f9ef503-e0ce-447c-93d6-49255feacc42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_pms`
--

DROP TABLE IF EXISTS `gtg_pms`;
CREATE TABLE IF NOT EXISTS `gtg_pms` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int UNSIGNED NOT NULL,
  `receiver_id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int NOT NULL,
  `pm_deleted_receiver` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_premissions`
--

DROP TABLE IF EXISTS `gtg_premissions`;
CREATE TABLE IF NOT EXISTS `gtg_premissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module` enum('Sales','Stock','Crm','Project','Accounts','Miscellaneous','Employees','Assign Project','Customer Profile','Reports','Delete','POS','Sales Edit','Stock Edit','Jobsheet Admin','My Jobs','Jobsheet Report','Payroll','Setting','Permission','Expenses','Expenses Manager','Pay Run','Pay Run Manager','Attendance','Attendance Manager','Payroll New','Payroll Manager','File Manager','Peppol Invoices','Ecommerce','FWMS','Scheduler','Asset Management','Sales Dashboard','Fwms Dashboard','Ecommerce','Employee Login','Client Login','Payroll Dashboard Report','Jobsheet Dashboard Report','Digital Marketing','Master Data Import') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `r_1` int NOT NULL,
  `r_2` int NOT NULL,
  `r_3` int NOT NULL,
  `r_4` int NOT NULL,
  `r_5` int NOT NULL,
  `r_6` int NOT NULL,
  `r_7` int NOT NULL,
  `r_8` int NOT NULL,
  `settings` varchar(255) NOT NULL,
  `r_14` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_premissions`
--

INSERT INTO `gtg_premissions` (`id`, `module`, `r_1`, `r_2`, `r_3`, `r_4`, `r_5`, `r_6`, `r_7`, `r_8`, `settings`, `r_14`) VALUES
(1, 'Sales', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(2, 'Stock', 1, 1, 1, 1, 1, 0, 1, 0, '', 0),
(3, 'Crm', 0, 1, 1, 1, 1, 0, 0, 0, '', 0),
(4, 'Project', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(5, 'Accounts', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(6, 'Miscellaneous', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(7, 'Assign Project', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(8, 'Customer Profile', 0, 0, 1, 0, 1, 0, 0, 0, '', 1),
(9, 'Employees', 0, 0, 0, 0, 1, 1, 0, 1, '', 1),
(10, 'Reports', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(11, 'Delete', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(12, 'POS', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(13, 'Sales Edit', 1, 1, 1, 1, 1, 0, 0, 0, '', 0),
(14, 'Stock Edit', 1, 1, 1, 1, 1, 1, 1, 0, '', 0),
(15, 'Jobsheet Admin', 0, 0, 0, 1, 1, 0, 0, 0, '', 0),
(16, 'My Jobs', 0, 0, 0, 1, 1, 1, 0, 0, '', 0),
(17, 'Jobsheet Report', 0, 0, 0, 1, 1, 0, 0, 0, '', 0),
(18, 'Payroll', 0, 0, 1, 1, 1, 1, 0, 0, '', 0),
(19, 'Setting', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(20, 'Permission', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(21, 'Expenses', 1, 1, 1, 1, 1, 1, 1, 0, '', 0),
(22, 'Expenses Manager', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(23, 'Pay Run', 0, 0, 0, 0, 1, 1, 0, 0, '', 0),
(24, 'Pay Run Manager', 0, 0, 0, 0, 1, 1, 0, 0, '', 0),
(25, 'Attendance', 1, 1, 1, 1, 1, 1, 1, 1, '', 0),
(26, 'Attendance Manager', 0, 0, 1, 0, 1, 1, 0, 1, '', 0),
(27, 'Payroll New', 1, 1, 1, 1, 1, 1, 1, 0, '', 0),
(28, 'Payroll Manager', 1, 1, 0, 0, 1, 0, 0, 0, '', 0),
(29, 'File Manager', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(30, 'Peppol Invoices', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(31, 'Ecommerce', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(32, 'FWMS', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(33, 'Scheduler', 1, 1, 1, 1, 1, 1, 0, 0, '', 0),
(34, 'Asset Management', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(35, 'Sales Dashboard', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard', 0),
(36, 'Fwms Dashboard', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard', 0),
(37, 'Ecommerce', 1, 1, 1, 1, 1, 1, 1, 0, '', 0),
(38, 'Employee Login', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(39, 'Client Login', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(40, 'Payroll Dashboard Report', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard', 0),
(41, 'Jobsheet Dashboard Report', 0, 0, 0, 0, 1, 1, 0, 0, 'dashboard', 0),
(42, 'Digital Marketing', 0, 0, 0, 0, 1, 0, 0, 0, '', 0),
(43, 'Master Data Import', 0, 0, 0, 0, 1, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_products`
--

DROP TABLE IF EXISTS `gtg_products`;
CREATE TABLE IF NOT EXISTS `gtg_products` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pcat` int NOT NULL DEFAULT '1',
  `warehouse` int NOT NULL DEFAULT '1',
  `product_name` varchar(80) NOT NULL,
  `product_code` varchar(30) DEFAULT NULL,
  `product_price` decimal(16,2) DEFAULT '0.00',
  `fproduct_price` decimal(16,2) DEFAULT '0.00',
  `taxrate` decimal(16,2) DEFAULT '0.00',
  `disrate` decimal(16,2) DEFAULT '0.00',
  `qty` decimal(10,2) NOT NULL,
  `product_des` text,
  `alert` int DEFAULT NULL,
  `unit` varchar(4) DEFAULT NULL,
  `image` varchar(120) DEFAULT 'default.png',
  `barcode` varchar(40) DEFAULT NULL,
  `merge` int NOT NULL,
  `sub` int NOT NULL,
  `vb` int NOT NULL,
  `expiry` date DEFAULT NULL,
  `code_type` varchar(8) DEFAULT 'EAN13',
  `sub_id` int DEFAULT '0',
  `b_id` int DEFAULT '0',
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `pcat` (`pcat`),
  KEY `warehouse` (`warehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_products`
--

INSERT INTO `gtg_products` (`pid`, `pcat`, `warehouse`, `product_name`, `product_code`, `product_price`, `fproduct_price`, `taxrate`, `disrate`, `qty`, `product_des`, `alert`, `unit`, `image`, `barcode`, `merge`, `sub`, `vb`, `expiry`, `code_type`, `sub_id`, `b_id`, `cr_date`) VALUES
(1, 3, 1, 'AVT tea', '00165', '50.00', '19.00', '5.00', '0.00', '13.00', '', 2, '', 'default.png', '0013221', 0, 0, 0, NULL, '  EAN13', 0, NULL, '2023-08-14 18:53:48'),
(4, 2, 1, 'Test coffee by siva', '741741', '15.00', '15.00', '1.00', '0.00', '50.00', '', 5, '', '489629ab67616d0000b27393e64b86abf75fd153bf0834 (1).jpg', '304226566562', 0, 0, 0, '2023-08-17', 'EAN13', 0, 0, '2023-08-14 18:53:48'),
(5, 2, 1, 'coffee new1', '85412', '300.00', '20.00', '1.00', '1.00', '120.00', '', 12, '', '404269flat-white-3402c4f (1).jpg', '147053533109', 0, 0, 0, NULL, 'EAN13', 5, 0, '2023-08-14 18:53:48'),
(6, 2, 1, 'Test coffe one', '8965896', '200.00', '185.00', '1.00', '1.00', '236.00', '', 20, '', '236459istockphoto-1303583671-612x612 (1).jpg', '220088960605', 0, 0, 0, '2023-08-19', 'EAN13', 5, 0, '2023-08-14 18:53:48'),
(7, 6, 1, 'Dolo 650', '9639633', '125.00', '120.00', '1.00', '0.00', '141.00', '', 25, '', '428477Siva-Prasad(1).png', '741850833954', 0, 0, 0, '2023-08-17', '    EAN1', 7, NULL, '2023-08-14 18:53:48'),
(8, 3, 1, 'Test coffe one by siva', '741741', '15.00', '10.00', '0.00', '0.00', '128.00', '', 10, '', '508672images (1).jpg', '119088501654', 0, 0, 0, NULL, '    EAN1', 0, NULL, '2023-08-13 18:53:48'),
(9, 3, 1, 'AVT tea-l-l', '00165', '50.00', '19.00', '5.00', '0.00', '202.00', '', 0, '', 'default.png', '0013221', 1, 1, 8, NULL, '  EAN13', 0, NULL, '2023-11-22 05:39:35'),
(10, 3, 1, 'AVT tea-m-m', '00165', '50.00', '19.00', '5.00', '0.00', '100.00', '', 0, '', 'default.png', '0013221', 1, 1, 7, NULL, '  EAN13', 0, NULL, '2023-11-22 05:39:35'),
(11, 3, 1, 'AVT tea-xs-xs', '00165', '50.00', '19.00', '5.00', '0.00', '202.00', '', 0, '', 'default.png', '0013221', 1, 1, 6, '0000-00-00', '  EAN13', 0, NULL, '2023-11-22 05:39:35'),
(12, 6, 1, 'Dolo 650-l-l', '9639633', '125.00', '120.00', '1.00', '0.00', '100.00', '', 10, '', '428477Siva-Prasad(1).png', '741850833954', 1, 7, 8, NULL, '    EAN1', 7, NULL, '2023-11-22 14:37:36'),
(13, 6, 1, 'Dolo 650-m-m', '9639633', '125.00', '120.00', '1.00', '0.00', '100.00', '', 10, '', '428477Siva-Prasad(1).png', '741850833954', 1, 7, 7, NULL, '    EAN1', 7, NULL, '2023-11-22 14:37:36'),
(14, 8, 1, 'hjghjghj', '745545', '100.00', '50.00', '0.00', '0.00', '100.00', '', 10, '', 'default.png', '473955660393', 0, 0, 0, '2023-11-25', '        ', 0, NULL, '2023-11-22 14:45:23'),
(22, 8, 1, 'hghjghj', 'jhgj67', '100.00', '15.00', '0.00', '0.00', '100.00', 'jkhkhk', 10, '', 'default.png', '159021128057', 0, 0, 0, '2023-11-11', 'EAN13', 0, 0, '2023-11-26 09:47:24'),
(23, 8, 1, 'khgjg', 'jgjg', '100.00', '10.00', '0.00', '0.00', '100.00', 'hwegfhjwgfjads', 10, '', 'default.png', '827194061942', 0, 0, 0, '2023-12-15', 'EAN13', 0, 0, '2023-12-21 08:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_product_cat`
--

DROP TABLE IF EXISTS `gtg_product_cat`;
CREATE TABLE IF NOT EXISTS `gtg_product_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `c_type` int DEFAULT '0',
  `rel_id` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_product_cat`
--

INSERT INTO `gtg_product_cat` (`id`, `title`, `extra`, `c_type`, `rel_id`) VALUES
(2, 'coffee shop', 'coffee shop', 0, 0),
(3, 'supermarketww', 'supermarket', 0, 0),
(5, 'strong coffee', '....', 1, 2),
(6, 'Medicines', 'medicines category', 0, 0),
(7, 'Fever Meds', 'fever medicies', 1, 6),
(8, 'testT', 'jhkjhk', 0, 0),
(9, 'dfdsf', 'dafsdfa', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_product_serials`
--

DROP TABLE IF EXISTS `gtg_product_serials`;
CREATE TABLE IF NOT EXISTS `gtg_product_serials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_product_serials`
--

INSERT INTO `gtg_product_serials` (`id`, `product_id`, `serial`, `status`) VALUES
(1, 8, 'eerrrr3344', 0),
(2, 7, 'yuy8777', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_projects`
--

DROP TABLE IF EXISTS `gtg_projects`;
CREATE TABLE IF NOT EXISTS `gtg_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_id` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Waiting','Pending','Terminated','Finished','Progress') NOT NULL DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Urgent') NOT NULL DEFAULT 'Medium',
  `progress` int NOT NULL,
  `cid` int NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `note` text,
  `worth` decimal(16,2) NOT NULL DEFAULT '0.00',
  `ptype` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_projects`
--

INSERT INTO `gtg_projects` (`id`, `p_id`, `name`, `status`, `priority`, `progress`, `cid`, `sdate`, `edate`, `tag`, `phase`, `note`, `worth`, `ptype`) VALUES
(1, '', 'KLSICCI MITRA', 'Progress', 'High', 31, 0, '2022-12-21', '2023-01-06', 'KLSICCI MITRA', 'Phase 1', '', '0.00', 0),
(2, '', 'Website Development ', 'Waiting', 'High', 0, 25, '2023-07-19', '2023-08-18', 'Web', 'A', '<p>Website Development&nbsp;</p>', '3000.00', 2),
(3, '', 'jhgjhgjh', 'Waiting', 'Low', 0, 84, '2024-01-07', '2024-02-06', 'test,test1', 'test', '', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_project_meta`
--

DROP TABLE IF EXISTS `gtg_project_meta`;
CREATE TABLE IF NOT EXISTS `gtg_project_meta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `meta_key` int NOT NULL,
  `meta_data` varchar(200) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `key3` varchar(20) DEFAULT NULL,
  `key4` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `meta_key` (`meta_key`),
  KEY `key3` (`key3`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_project_meta`
--

INSERT INTO `gtg_project_meta` (`id`, `pid`, `meta_key`, `meta_data`, `value`, `key3`, `key4`) VALUES
(1, 1, 12, NULL, '[Project Created]  @2022-12-23 10:06:11', NULL, 0),
(2, 1, 2, 'false', 'false', NULL, 0),
(3, 1, 19, '6', NULL, NULL, 0),
(4, 2, 12, NULL, '[Project Created]  @2023-07-19 10:57:44', NULL, 0),
(5, 2, 2, 'true', 'true', NULL, 0),
(6, 2, 19, '4', NULL, NULL, 0),
(7, 3, 12, NULL, '[Project Created]  @2024-01-07 10:58:46', NULL, 0),
(8, 3, 2, 'true', 'true', NULL, 0),
(9, 3, 19, '6', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_promo`
--

DROP TABLE IF EXISTS `gtg_promo`;
CREATE TABLE IF NOT EXISTS `gtg_promo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `valid` date NOT NULL,
  `active` int NOT NULL,
  `note` varchar(100) NOT NULL,
  `reflect` int NOT NULL,
  `qty` int NOT NULL,
  `available` int NOT NULL,
  `location` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_2` (`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_purchase`
--

DROP TABLE IF EXISTS `gtg_purchase`;
CREATE TABLE IF NOT EXISTS `gtg_purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') DEFAULT 'due',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,2) NOT NULL,
  `taxstatus` enum('yes','no','incl','cgst','igst') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `loc` int NOT NULL,
  `multi` int DEFAULT NULL,
  `delivery_order_id` text NOT NULL,
  `stock_update_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_purchase`
--

INSERT INTO `gtg_purchase` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `loc`, `multi`, `delivery_order_id`, `stock_update_status`) VALUES
(1, 1001, '2022-04-15', '2022-04-15', '19.95', '0.00', '0.00', 'incl', '0.00', '0.95', '19.95', NULL, '', 'due', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(2, 1002, '2023-06-16', '2023-06-16', '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '2500.00', NULL, '', 'due', 2, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(3, 1003, '2023-07-10', '2023-07-10', '22.50', '0.00', '0.00', 'incl', '0.00', '0.00', '22.50', NULL, 'Test', 'due', 1, 6, '0.00', '5.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(4, 1004, '2023-07-14', '2023-07-14', '106.00', '0.00', '0.00', 'incl', '0.00', '6.00', '106.00', NULL, '', 'canceled', 1, 6, '0.00', '0.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(5, 1005, '2023-09-07', '2023-09-07', '15.15', '0.00', '0.00', 'incl', '0.00', '0.15', '15.15', 'Cash', '', 'paid', 4, 6, '500.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(6, 1006, '2023-10-04', '2023-10-04', '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', 'Cash', '', 'paid', 4, 53, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(7, 1007, '2023-10-04', '2023-10-04', '2023.00', '0.00', NULL, 'off', '0.00', '0.00', '0.00', 'Cash', '', 'paid', 4, 53, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(8, 1008, '2023-11-16', '2023-11-16', '150.00', '0.00', '0.00', 'incl', '0.00', '0.00', '150.00', 'Cash', '', 'paid', 4, 6, '150.00', '10.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(9, 1009, '2023-11-17', '2023-11-17', '1938.50', '0.00', '0.00', 'incl', '18.50', '0.00', '1938.50', 'Cash', '', 'paid', 4, 6, '1938.50', '18.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(11, 1010, '2023-11-21', '2023-11-21', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '196.85', NULL, '', 'due', 4, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1),
(12, 1011, '2023-11-21', '2023-11-21', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '196.85', NULL, '', 'due', 4, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1),
(13, 1012, '2023-11-21', '2023-11-21', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '196.85', NULL, '', 'due', 4, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1),
(14, 1013, '2023-11-21', '2023-11-21', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '196.85', NULL, '', 'due', 4, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1),
(15, 1014, '2023-11-21', '2023-11-21', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '196.85', NULL, '', 'canceled', 4, 6, '0.00', '2.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1),
(16, 1015, '2023-11-22', '2023-11-22', '3800.00', '0.00', '0.00', 'incl', '0.00', '0.00', '3800.00', 'Cash', '', 'paid', 4, 6, '3800.00', '200.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(17, 1016, '2023-11-29', '2023-11-29', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '121.20', NULL, '', 'due', 4, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 0),
(18, 1017, '2023-11-29', '2023-11-29', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '121.20', NULL, '', 'due', 4, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_purchase_items`
--

DROP TABLE IF EXISTS `gtg_purchase_items`;
CREATE TABLE IF NOT EXISTS `gtg_purchase_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `unit` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_purchase_items`
--

INSERT INTO `gtg_purchase_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `unit`) VALUES
(1, 1, 1, 'AVT tea', '00165', '1.00', '19.00', '5.00', '0.00', '19.95', '0.95', '0.00', '', ''),
(2, 2, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', ''),
(4, 3, 2, 'nasi lemak ', 'ns003', '5.00', '4.50', '0.00', '0.00', '22.50', '0.00', '0.00', 'Ikan Bilis\r\nKacang\r\nSambal\r\nTelur Mata\r\n', ''),
(5, 4, 0, 'laptop', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', '', ''),
(6, 5, 4, 'Test coffee by siva', '741741', '1.00', '15.00', '1.00', '0.00', '15.15', '0.15', '0.00', 'Test Coffee', ''),
(7, 6, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(8, 7, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(9, 8, 4, 'Test coffee by siva', '741741', '10.00', '15.00', '1.00', '0.00', '150.00', '0.00', '0.00', '', ''),
(10, 9, 6, 'Test coffe one', '8965896', '10.00', '185.00', '1.00', '1.00', '1831.50', '0.00', '18.50', '', ''),
(11, 9, 8, 'Test coffe one by siva', '741741', '5.00', '10.00', '0.00', '0.00', '50.00', '0.00', '0.00', '', ''),
(12, 9, 1, 'AVT tea', '00165', '3.00', '19.00', '5.00', '0.00', '57.00', '0.00', '0.00', '', ''),
(15, 11, 6, 'Test coffe one', '', '1.00', '185.00', '1.00', '1.00', '0.00', '0.00', '0.00', '', ''),
(16, 11, 8, 'Test coffe one by siva', '', '1.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(17, 12, 6, 'Test coffe one', '', '1.00', '185.00', '1.00', '1.00', '0.00', '0.00', '0.00', '', ''),
(18, 12, 8, 'Test coffe one by siva', '', '1.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(19, 13, 6, 'Test coffe one', '', '1.00', '185.00', '1.00', '1.00', '0.00', '0.00', '0.00', '', ''),
(20, 13, 8, 'Test coffe one by siva', '', '1.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(21, 14, 6, 'Test coffe one', '', '1.00', '185.00', '1.00', '1.00', '0.00', '0.00', '0.00', '', ''),
(22, 14, 8, 'Test coffe one by siva', '', '1.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(23, 15, 6, 'Test coffe one', '', '1.00', '185.00', '1.00', '1.00', '0.00', '0.00', '0.00', '', ''),
(24, 15, 8, 'Test coffe one by siva', '', '1.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(25, 16, 9, 'AVT tea-l-l', '00165', '100.00', '19.00', '5.00', '0.00', '1900.00', '0.00', '0.00', '', ''),
(26, 16, 11, 'AVT tea-xs-xs', '00165', '100.00', '19.00', '5.00', '0.00', '1900.00', '0.00', '0.00', '', ''),
(27, 17, 7, 'Dolo 650', '', '1.00', '120.00', '1.00', '0.00', '0.00', '0.00', '0.00', '', ''),
(28, 18, 7, 'Dolo 650', '', '1.00', '120.00', '1.00', '0.00', '0.00', '0.00', '0.00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_quotes`
--

DROP TABLE IF EXISTS `gtg_quotes`;
CREATE TABLE IF NOT EXISTS `gtg_quotes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','customer_approved') DEFAULT 'pending',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) NOT NULL,
  `items` decimal(10,2) NOT NULL,
  `taxstatus` enum('yes','no','incl','cgst','igst') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `proposal` text,
  `multi` int DEFAULT NULL,
  `loc` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_quotes`
--

INSERT INTO `gtg_quotes` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `proposal`, `multi`, `loc`) VALUES
(1, 1001, '2022-11-01', '2022-12-01', '6360.00', '0.00', '0.00', 'incl', '0.00', '360.00', '6360.00', NULL, 'Testing ', 'accepted', 2, 13, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>testing&nbsp;</p>', NULL, 0),
(3, 1002, '2023-04-05', '2023-05-05', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 10, 3, '0.00', '1.00', 'incl', 1, '%', '43243', 1, '<p>test</p>', NULL, 0),
(4, 1003, '2023-05-09', '2023-06-08', '100.00', '0.00', '0.00', 'incl', '0.00', '0.00', '100.00', NULL, '', 'pending', 14, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>Test</p><p>test</p>', NULL, 0),
(5, 1004, '2023-05-31', '2023-06-30', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>Test DEV</p>', NULL, 0),
(6, 1005, '2023-05-31', '2023-06-30', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 11, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(7, 1006, '2023-06-07', '2023-07-07', '2120.00', '0.00', '0.00', 'incl', '0.00', '120.00', '2120.00', NULL, '', 'accepted', 10, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, '<p>nothing personal&nbsp;&nbsp;&nbsp;&nbsp;</p>', NULL, 0),
(8, 1007, '2023-06-15', '2023-07-15', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'pending', 37, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(9, 1008, '2023-06-16', '2023-07-16', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'accepted', 37, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(10, 1009, '2023-06-16', '2023-07-16', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'accepted', 38, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(13, 1010, '2023-06-16', '2023-07-16', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'accepted', 39, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(14, 1011, '2023-06-16', '2023-07-16', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'accepted', 40, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(15, 1012, '2023-06-16', '2023-07-16', '2500.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2500.00', NULL, '', 'accepted', 36, 25, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(16, 1013, '2023-06-23', '2023-07-23', '9.20', '0.00', '0.00', 'incl', '1.00', '0.20', '9.20', NULL, 'jewhkasdfasdfas', 'pending', 1, 1, '0.00', '1.00', 'yes', 1, 'flat', 'sadff', 1, '<p>asdfasdfasdfas&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', NULL, 0),
(17, 1014, '2023-06-27', '2023-07-27', '583.00', '0.00', '0.00', 'incl', '53.00', '36.00', '583.00', NULL, 'Testing Quotation', 'pending', 28, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, '<p>Testing Message</p>', NULL, 0),
(18, 1015, '2023-07-06', '2023-08-05', '2930.00', '0.00', '0.00', 'incl', '0.00', '0.00', '2930.00', NULL, '', 'accepted', 43, 28, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(19, 1016, '2023-07-10', '2023-08-09', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, 'Test', 'pending', 11, 28, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>Test</p>', NULL, 0),
(20, 1017, '2023-07-11', '2023-08-10', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', NULL, '', 'pending', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>xcxzxzcxcccczxczxcxzcxczxcxzcxzcxz</p>', NULL, 0),
(21, 1018, '2023-07-11', '2023-08-10', '127.20', '0.00', '0.00', 'incl', '0.00', '7.20', '127.20', NULL, '', 'accepted', 11, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, '<p>saddddddddsssssssssssssssssss</p>', NULL, 0),
(22, 1019, '2023-07-14', '2023-08-13', '210.94', '0.00', '0.00', 'incl', '0.00', '11.94', '210.94', NULL, '', 'pending', 10, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(24, 1020, '2023-07-14', '2023-08-13', '212.00', '0.00', '0.00', 'incl', '0.00', '12.00', '212.00', NULL, '', 'pending', 25, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(25, 1021, '2023-07-14', '2023-08-13', '530.00', '0.00', '0.00', 'incl', '0.00', '30.00', '530.00', NULL, '', 'pending', 1, 4, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(26, 1022, '2023-07-14', '2023-08-13', '318.00', '0.00', '0.00', 'incl', '0.00', '18.00', '318.00', NULL, '', 'accepted', 10, 4, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(27, 1023, '2023-07-14', '2023-08-13', '2438.00', '0.00', '0.00', 'incl', '0.00', '138.00', '2438.00', NULL, '', 'accepted', 51, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(28, 1024, '2023-07-14', '2023-08-13', '100.00', '0.00', '0.00', 'incl', '0.00', '0.00', '100.00', NULL, '', 'pending', 1, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(29, 1025, '2023-07-14', '2023-08-13', '13356.00', '0.00', '0.00', 'incl', '0.00', '756.00', '13356.00', NULL, '', 'pending', 54, 4, '0.00', '101.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(30, 1026, '2023-07-17', '2023-08-16', '530.00', '0.00', '0.00', 'incl', '0.00', '30.00', '530.00', NULL, '', 'accepted', 11, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(31, 1027, '2023-07-17', '2023-08-16', '1590.00', '0.00', '0.00', 'incl', '0.00', '90.00', '1590.00', NULL, '', 'pending', 12, 40, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(33, 1028, '2023-07-17', '2023-08-16', '1530.00', '0.00', '0.00', 'incl', '0.00', '30.00', '1530.00', NULL, '', 'pending', 13, 40, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(35, 1029, '2023-07-17', '2023-08-16', '1360.00', '0.00', '0.00', 'incl', '0.00', '60.00', '1360.00', NULL, '', 'accepted', 11, 40, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(36, 1030, '2023-07-18', '2023-08-17', '1100.00', '0.00', '0.00', 'incl', '0.00', '100.00', '1100.00', NULL, '', 'pending', 25, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(37, 1031, '2023-07-19', '2023-08-18', '106.00', '0.00', '0.00', 'incl', '0.00', '6.00', '106.00', NULL, '', 'pending', 1, 4, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(38, 1032, '2023-07-19', '2023-08-18', '106.00', '0.00', '0.00', 'incl', '0.00', '6.00', '106.00', NULL, '', 'accepted', 1, 40, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(39, 1033, '2023-07-19', '2023-08-18', '5185.52', '0.00', '0.00', 'incl', '538.48', '324.00', '5185.52', NULL, '', 'pending', 15, 4, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(40, 1034, '2023-07-19', '2023-08-18', '4770.00', '0.00', '0.00', 'incl', '530.00', '300.00', '4770.00', NULL, '', 'accepted', 74, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(41, 1035, '2023-07-19', '2023-08-18', '2442.24', '0.00', '0.00', 'incl', '271.36', '153.60', '2442.24', NULL, '', 'pending', 1, 40, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(42, 1036, '2023-07-19', '2023-08-18', '4770.00', '4.55', '0.45', 'incl', '530.00', '300.00', '4775.00', NULL, '', 'pending', 10, 27, '0.00', '2.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(43, 1037, '2023-10-04', '2023-11-03', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', NULL, '', 'pending', 10, 53, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(44, 1038, '2023-10-04', '2023-11-03', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', NULL, '', 'pending', 1, 53, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0),
(45, 1039, '2023-10-04', '2023-11-03', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', NULL, '', 'accepted', 10, 53, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_quotes_items`
--

DROP TABLE IF EXISTS `gtg_quotes_items`;
CREATE TABLE IF NOT EXISTS `gtg_quotes_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(16,2) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `unit` varchar(5) NOT NULL,
  `serial` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_quotes_items`
--

INSERT INTO `gtg_quotes_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `unit`, `serial`) VALUES
(1, 1, 0, 'Software', '', '1.00', '6000.00', '6.00', '0.00', '6360.00', '360.00', '0.00', 'POS', '', ''),
(2, 3, 0, 'test product', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', 'test', '', ''),
(3, 4, 0, 'Reconnection', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', 'Reconnection Charges \"kkkm.my\"', '', ''),
(4, 5, 0, 'DEV TEST', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', '', ''),
(5, 6, 0, 'DEV 2', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', '', ''),
(6, 7, 0, 'A Bog Website ', '', '1.00', '1000.00', '12.00', '0.00', '1120.00', '120.00', '0.00', 'A Bog Website with five pages', '', ''),
(7, 7, 0, 'Email', '', '1.00', '1000.00', '0.00', '0.00', '1000.00', '0.00', '0.00', '1 email', '', ''),
(8, 8, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(9, 9, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(10, 10, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(13, 15, 0, 'Website', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(14, 14, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(15, 13, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Startup website development 5 Pages Website Design Design Adaptation Conceptualization Web Design Visualization Website Navigation Structure Planning 3 Main page Banner Designs Enquiry Form, Contact Address Google Map Social Media Link Content Management System Mobile Friendly Website Drive(SSD) Disk Space20GB Bandwidth-100GB Email Accounts- 5 accounts 12 Months Free Hosting/Email Completion Timeframe - 20 working days Two revisions via online NOTES: HOSTING / DOMAIN / MODULE SUBSCRIPTION YEARLY: RM499.00', '', ''),
(16, 16, 0, 'asdhfghj', '', '1.00', '10.00', '2.00', '1.00', '9.20', '0.20', '1.00', '', '', ''),
(17, 17, 0, 'Test Name 1', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'Line Break 1<br>Line Break 2<br>Line Break 3<br>Line Break 4', '', ''),
(18, 17, 0, 'Test Name 2', '', '1.00', '500.00', '6.00', '10.00', '477.00', '30.00', '53.00', 'Line Break 1<br>Line Break 2<br>Line Break 3<br>Line Break 4', '', ''),
(19, 18, 0, '', '', '1.00', '2500.00', '0.00', '0.00', '2500.00', '0.00', '0.00', 'Hardware Cashier Machine -Touch screen Monitor&nbsp;', '', ''),
(20, 18, 0, '', '', '1.00', '430.00', '0.00', '0.00', '430.00', '0.00', '0.00', 'Thermal Receipt Printer USB + Serial Port + LAN 4MB, 256 bytes Input AC 100-240V 50/60 Hz Output DC 24V/2.5A Max 83mmm Auto Cutter', '', ''),
(21, 19, 0, 'Test', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', 'Line<br>Line<br>Line<br>Line ', '', ''),
(22, 20, 0, 'xaczcxzcxzcxzczc', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', ''),
(23, 21, 0, 'ssssssssssssssssssssssss', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'sdasassasdsdsadsadsadsad', '', ''),
(24, 21, 0, 'sdsadsasafsasafas', '', '1.00', '20.00', '6.00', '0.00', '21.20', '1.20', '0.00', 'sadsadsadadsdsada', '', ''),
(25, 22, 0, 'fdfds', '', '1.00', '199.00', '6.00', '0.00', '210.94', '11.94', '0.00', 'jfsdjhashslda', '', ''),
(26, 24, 0, 'sdasdasdsdsdasdasd', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', 'fsdfsdfdfsdfsdfsdfsd', '', ''),
(27, 25, 0, 'fgdte', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', '', '', ''),
(28, 25, 0, 'rwtwtwy', '', '1.00', '300.00', '6.00', '0.00', '318.00', '18.00', '0.00', '', '', ''),
(29, 26, 0, 'Laptop ', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'jhcasfjhdgaskgdasdjkasldhasdh;asjd;lasd;lasdlasdasjd\'sadas\'dkasdadfasukdfqwtiuqwtuetqweyqwyeioqwiogasjgdkgasdkjgsdjfgasjdfasdhflashflsdkgsdgfkasdfklsdhfkljdgfjsdfjsdhfhasdlfjas;dfjslk', '', ''),
(30, 26, 0, 'Personal Computer', '', '1.00', '200.00', '6.00', '0.00', '212.00', '12.00', '0.00', '', '', ''),
(31, 27, 0, 'WEBSITE ', '', '1.00', '2300.00', '6.00', '0.00', '2438.00', '138.00', '0.00', '', '', ''),
(32, 28, 0, 'Hhh', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', '', '', ''),
(48, 29, 0, 'Attendance ', '', '50.00', '96.00', '6.00', '0.00', '5088.00', '288.00', '0.00', '<div>CLOUD ATTENDANCE SYSTEM &#40; 50 x 8 x 12 Month&#41; Time Attendance Software is a cloudbased software and the captured attendance data by various means will be synced real-time to the software. </div>\r\n<div> </div>', '', ''),
(49, 29, 0, 'Payroll ', '', '50.00', '96.00', '6.00', '0.00', '5088.00', '288.00', '0.00', '<div>PAYROLL SYSTEM &#40; 50 x 8 x 12 Month&#41; Ease your payroll calculation process by integrating Payroll with attendance.</div>\r\n<div> </div>', '', ''),
(50, 29, 0, 'Jobsheet', '', '1.00', '3000.00', '6.00', '0.00', '3180.00', '180.00', '0.00', 'JobSheet + Invoice Generation RM 3000/ Yearly', '', ''),
(51, 30, 0, 'ABC', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', '', '', ''),
(52, 31, 0, 'ABC', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', '', '', ''),
(53, 31, 0, 'DEF', '', '1.00', '1000.00', '6.00', '0.00', '1060.00', '60.00', '0.00', '', '', ''),
(54, 33, 0, 'ABC', '', '1.00', '500.00', '6.00', '0.00', '530.00', '30.00', '0.00', '', '', ''),
(55, 33, 0, 'DEF', '', '1.00', '1000.00', '0.00', '0.00', '1000.00', '0.00', '0.00', '', '', ''),
(56, 35, 0, 'HAGSCHS', '', '1.00', '1000.00', '6.00', '0.00', '1060.00', '60.00', '0.00', '', '', ''),
(57, 35, 0, 'SDSFSFDS', '', '1.00', '300.00', '0.00', '0.00', '300.00', '0.00', '0.00', '', '', ''),
(58, 36, 0, 'Testt', '', '1.00', '1000.00', '10.00', '0.00', '1100.00', '100.00', '0.00', 'Testtt<br>Testtt', '', ''),
(59, 37, 0, 'Laptop', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'laptop Spec&nbsp;', '', ''),
(60, 38, 0, 'laptop ', '', '1.00', '100.00', '6.00', '0.00', '106.00', '6.00', '0.00', 'asdsdsddad', '', ''),
(61, 38, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', ''),
(62, 39, 0, 'Laptop ', '', '1.00', '5000.00', '6.00', '10.00', '4770.00', '300.00', '530.00', 'I5&nbsp;<br>250 GB <br>16 Gb ram ', '', ''),
(63, 39, 0, 'HDD ', '', '1.00', '400.00', '6.00', '2.00', '415.52', '24.00', '8.48', 'HDD 500 GB&nbsp;', '', ''),
(64, 40, 0, 'DELL Laptop ', '', '1.00', '5000.00', '6.00', '10.00', '4770.00', '300.00', '530.00', 'DELL&nbsp;', '', ''),
(65, 41, 0, 'i;ad', '', '1.00', '2560.00', '6.00', '10.00', '2442.24', '153.60', '271.36', 'ipad256gbrose gold', '', ''),
(66, 42, 0, 'IPAD', '', '2.00', '2500.00', '6.00', '10.00', '4770.00', '300.00', '530.00', 'Ipad 5th gen64 GBspace grey', '', ''),
(67, 43, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', ''),
(68, 44, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', ''),
(69, 45, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_referral`
--

DROP TABLE IF EXISTS `gtg_referral`;
CREATE TABLE IF NOT EXISTS `gtg_referral` (
  `id` int NOT NULL AUTO_INCREMENT,
  `referral_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reffered_by` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `delete_status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gtg_referral`
--

INSERT INTO `gtg_referral` (`id`, `referral_name`, `company_name`, `contact_no`, `emailid`, `remarks`, `subscription`, `start_date`, `end_date`, `admin_remarks`, `reffered_by`, `status`, `delete_status`, `created_at`, `update_at`) VALUES
(2, 'asdfasfasf', 'asfasfaf', '9677660842', 'krish@smartoffice.my', 'weqweqwe', '', '', '', '', '', 0, 0, '2023-08-15 07:44:32', '2023-08-15 07:44:54'),
(3, 'udhaya', 'jsoft', '96532910', 'udhayase@gmail.com', 'testtttt', '', '', '', '', '', 1, 0, '2023-08-15 07:46:20', '2023-08-15 07:46:20'),
(9, 'xcvxcv', 'xcvxcv', '5345', 'krvvvish@smartoffice.my', 'sdfsdfasf', '20', '2023-08-18', '2023-09-23', '', 'jsoftadmin', 2, 0, '2023-08-16 04:06:51', '2023-08-16 04:06:51'),
(10, 'sdfsdf', 'dfsdf', '345345345', 'erwerwern@gmail.com', 'erwerwer', '', '', '', '', 'jsoftadmin', 0, 0, '2023-08-16 07:25:01', '2023-08-16 07:25:01'),
(11, 'Guna', 'Sathias Trading ', '0125509210', 'sharon@gmail.com', 'looking for payroll System ', '30', '2023-08-19', '2023-08-30', 'czxczxczxczxc', 'jsoftadmin', 2, 0, '2023-08-16 07:30:00', '2023-08-16 07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_register`
--

DROP TABLE IF EXISTS `gtg_register`;
CREATE TABLE IF NOT EXISTS `gtg_register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `o_date` datetime NOT NULL,
  `c_date` datetime NOT NULL,
  `cash` decimal(16,2) NOT NULL,
  `card` decimal(16,2) NOT NULL,
  `bank` decimal(16,2) NOT NULL,
  `cheque` decimal(16,2) NOT NULL,
  `r_change` decimal(16,2) NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_register`
--

INSERT INTO `gtg_register` (`id`, `uid`, `o_date`, `c_date`, `cash`, `card`, `bank`, `cheque`, `r_change`, `active`) VALUES
(1, 6, '2022-04-14 10:29:26', '2022-04-14 10:30:51', '1000.00', '500.00', '500.00', '500.00', '0.00', 0),
(2, 6, '2022-04-15 04:08:40', '2022-04-15 04:09:37', '50000.00', '2500.00', '2500.00', '0.00', '0.00', 0),
(3, 6, '2022-04-15 04:13:15', '2022-11-01 07:31:41', '189.00', '0.00', '0.00', '0.00', '0.00', 0),
(4, 6, '2022-11-01 09:56:01', '0000-00-00 00:00:00', '2473.39', '0.00', '0.00', '0.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_reports`
--

DROP TABLE IF EXISTS `gtg_reports`;
CREATE TABLE IF NOT EXISTS `gtg_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `month` varchar(10) DEFAULT NULL,
  `year` int NOT NULL,
  `invoices` int NOT NULL,
  `sales` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,2) NOT NULL,
  `income` decimal(16,2) DEFAULT '0.00',
  `expense` decimal(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_reports`
--

INSERT INTO `gtg_reports` (`id`, `month`, `year`, `invoices`, `sales`, `items`, `income`, `expense`) VALUES
(17, '2', 2023, 3, '2101.00', '1.00', '2001.00', '0.00'),
(18, '3', 2023, 2, '2.00', '2.00', '102.04', '0.00'),
(19, '4', 2023, 15, '8007.22', '23.00', NULL, NULL),
(20, '5', 2023, 14, '2348.48', '23.00', '206.50', '0.00'),
(21, '6', 2023, 28, '19395.00', '40.00', '2126.00', '2000.00'),
(22, '7', 2023, 29, '15515.09', '58.00', '7453.89', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_restkeys`
--

DROP TABLE IF EXISTS `gtg_restkeys`;
CREATE TABLE IF NOT EXISTS `gtg_restkeys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `key` varchar(40) DEFAULT NULL,
  `level` int NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_restkeys`
--

INSERT INTO `gtg_restkeys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'd330d8873386768553f774a4', 0, 0, 0, NULL, '2022-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_role`
--

DROP TABLE IF EXISTS `gtg_role`;
CREATE TABLE IF NOT EXISTS `gtg_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `delete_status` int NOT NULL,
  `all_data_previleges` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_role`
--

INSERT INTO `gtg_role` (`id`, `role_name`, `status`, `delete_status`, `all_data_previleges`) VALUES
(1, 'Inventory Manager', 1, 0, 0),
(2, 'driver', 1, 0, 1),
(3, 'Sales Manager', 1, 0, 1),
(4, 'ADMIN', 1, 0, 1),
(5, 'Business Owner', 1, 0, 1),
(6, 'Project Manager', 1, 0, 1),
(7, 'Marketing ', 1, 0, 1),
(8, 'General Workers', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_schedular_sub_modules`
--

DROP TABLE IF EXISTS `gtg_schedular_sub_modules`;
CREATE TABLE IF NOT EXISTS `gtg_schedular_sub_modules` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ModuleId` int NOT NULL,
  `CrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_schedular_sub_modules`
--

INSERT INTO `gtg_schedular_sub_modules` (`Id`, `Name`, `ModuleId`, `CrDate`) VALUES
(1, 'passport', 8, '2023-09-13 06:35:26'),
(2, 'permit', 8, '2023-09-13 06:35:26'),
(3, 'contract_reminder', 12, '2023-09-13 06:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_smtp`
--

DROP TABLE IF EXISTS `gtg_smtp`;
CREATE TABLE IF NOT EXISTS `gtg_smtp` (
  `id` int NOT NULL,
  `host` varchar(100) NOT NULL,
  `port` int NOT NULL,
  `auth` enum('true','false') NOT NULL,
  `auth_type` enum('none','tls','ssl') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sender` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_smtp`
--

INSERT INTO `gtg_smtp` (`id`, `host`, `port`, `auth`, `auth_type`, `username`, `password`, `sender`) VALUES
(1, 'mail.jcloud.my', 587, 'true', 'none', 'noreply@jcloud.my', 'fakepassword1', 'support@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_stock_r`
--

DROP TABLE IF EXISTS `gtg_stock_r`;
CREATE TABLE IF NOT EXISTS `gtg_stock_r` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `ship_tax` decimal(16,2) DEFAULT NULL,
  `ship_tax_type` enum('incl','excl','off') DEFAULT 'off',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','partial','canceled') DEFAULT 'pending',
  `csd` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` decimal(10,0) NOT NULL,
  `taxstatus` enum('yes','no','incl','cgst','igst') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','bflat','b_p') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int NOT NULL,
  `loc` int NOT NULL,
  `i_class` int NOT NULL DEFAULT '0',
  `multi` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_stock_r`
--

INSERT INTO `gtg_stock_r` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `loc`, `i_class`, `multi`) VALUES
(1, 1001, '2023-10-05', '2023-10-05', '100.00', '0.00', '0.00', 'incl', '0.00', '0.00', '100.00', NULL, 'aFAdfadf', 'pending', 1, 6, '0.00', '0', 'yes', 1, '%', '', 1, 0, 2, 0),
(2, 1002, '2023-10-05', '2023-10-05', '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', NULL, '', 'pending', 4, 6, '0.00', '0', 'yes', 1, '%', '', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_stock_r_items`
--

DROP TABLE IF EXISTS `gtg_stock_r_items`;
CREATE TABLE IF NOT EXISTS `gtg_stock_r_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `pid` int NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  `unit` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_stock_r_items`
--

INSERT INTO `gtg_stock_r_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `unit`) VALUES
(1, 1, 0, 'test', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', 'adfsdfsdf', ''),
(2, 2, 0, '', '', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_subscription`
--

DROP TABLE IF EXISTS `gtg_subscription`;
CREATE TABLE IF NOT EXISTS `gtg_subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module` enum('Sales','Stock','Crm','Project','Accounts','Miscellaneous','Employees','Assign Project','Customer Profile','Reports','Delete','POS','Sales Edit','Stock Edit','Jobsheet Admin','My Jobs','Jobsheet Report','Payroll','Setting','Permission','Expenses','Expenses Manager','Pay Run','Pay Run Manager','Attendance','Attendance Manager','Payroll New','Payroll Manager','File Manager','Peppol Invoices','Ecommerce','FWMS','Scheduler','Asset Management','Sales Dashboard','Fwms Dashboard','Ecommerce','Digital Marketing') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `r_1` int NOT NULL,
  `settings` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_subscription`
--

INSERT INTO `gtg_subscription` (`id`, `module`, `r_1`, `settings`) VALUES
(1, 'Sales', 1, ''),
(2, 'Stock', 1, ''),
(3, 'Crm', 1, ''),
(4, 'Project', 1, ''),
(5, 'Accounts', 1, ''),
(6, 'Miscellaneous', 1, ''),
(7, 'Assign Project', 1, ''),
(8, 'Customer Profile', 1, ''),
(9, 'Employees', 1, ''),
(10, 'Reports', 1, ''),
(11, 'Delete', 1, ''),
(12, 'POS', 1, ''),
(13, 'Sales Edit', 1, ''),
(14, 'Stock Edit', 1, ''),
(15, 'Jobsheet Admin', 1, ''),
(16, 'My Jobs', 1, ''),
(17, 'Jobsheet Report', 1, ''),
(18, 'Payroll', 1, ''),
(19, 'Setting', 1, ''),
(20, 'Permission', 1, ''),
(21, 'Expenses', 1, ''),
(22, 'Expenses Manager', 1, ''),
(23, 'Pay Run', 1, ''),
(24, 'Pay Run Manager', 1, ''),
(25, 'Attendance', 1, ''),
(26, 'Attendance Manager', 1, ''),
(27, 'Payroll New', 1, ''),
(28, 'Payroll Manager', 1, ''),
(29, 'File Manager', 1, ''),
(30, 'Peppol Invoices', 1, ''),
(31, 'Ecommerce', 1, ''),
(32, 'FWMS', 1, ''),
(33, 'Scheduler', 1, ''),
(34, 'Asset Management', 1, ''),
(35, 'Sales Dashboard', 1, 'dashboard'),
(36, 'Fwms Dashboard', 1, 'dashboard'),
(37, 'Ecommerce', 1, ''),
(38, 'Digital Marketing', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_supplier`
--

DROP TABLE IF EXISTS `gtg_supplier`;
CREATE TABLE IF NOT EXISTS `gtg_supplier` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'example.png',
  `gid` int NOT NULL DEFAULT '1',
  `company` varchar(100) DEFAULT NULL,
  `taxid` varchar(100) DEFAULT NULL,
  `loc` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_supplier`
--

INSERT INTO `gtg_supplier` (`id`, `name`, `phone`, `address`, `city`, `region`, `country`, `postbox`, `email`, `picture`, `gid`, `company`, `taxid`, `loc`) VALUES
(1, 'rahul', '9841204881', '', '', '', '', '', 'hariinraj29@gmail.com', 'example.png', 1, 'reno', '', 0),
(2, 'Windy', '0122555412', '4th, Wisma Academy, Lot 4A, Jalan 19/1,', 'Petaling Jaya', 'Selangor', 'Malaysia', '46300', 'windy@ingrammicro.com', 'example.png', 1, 'Ingram Micro Malaysia Sdn. Bhd', '', 0),
(3, 'Mr Ng', '01223232323', 'Suite 2B-20-1, 20th Floor, Block 2B, Plaza Sentral', 'Wilayah Persekutuan', 'Kuala Lumpur', 'Malaysia', '50470', 'sales@jsoftsolution.com.my', 'example.png', 1, 'iPay88 Malaysia', '', 0),
(4, 'mr sry', '0123434343', 'H1-6, Block H1, Level 6, SetiaWalk, Persiaran Wawa', ' Pusat Bandar Puchong', 'Selangor', 'Malaysia', '47100', 'exabyte@exabyte.com', 'example.png', 1, 'Exabytes', '', 0),
(5, 'Chandran', '0355699951', '27, Jalan Pendidik U1/31, Hicom-glenmarie Industri', 'Shah Alam', 'Selangor', 'Malaysia', '40150', 'cbg@cbg.com', 'example.png', 1, 'CBG Infotech', '', 0),
(6, 'Ng', '03-6286 8222', 'Lot 3, Jalan Teknologi 3/5, Taman Sains Selangor.', 'Kota Damansara', 'Selangor', 'Malaysia', '47810', 'Yuni@vstecs berhad', 'example.png', 1, 'VSTECS Berhad', '', 0),
(7, 'hjgj', 'jhg', 'hgjh', 'gjh', 'ghjg', 'hjg', 'j', 'jhgj', 'example.png', 1, 'jhgjhg', 'j', 0),
(8, 'hghjg', 'jhg', 'ghj', 'ghj', 'ghj', 'ghj', 'ghj', 'jhghj', 'example.png', 1, 'hjgjg', 'gjh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_system`
--

DROP TABLE IF EXISTS `gtg_system`;
CREATE TABLE IF NOT EXISTS `gtg_system` (
  `id` int NOT NULL,
  `cname` char(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `region` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postbox` varchar(15) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `taxid` varchar(20) NOT NULL,
  `tax` int NOT NULL,
  `currency` varchar(4) NOT NULL,
  `currency_format` int NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `dformat` int NOT NULL,
  `zone` varchar(25) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `lang` varchar(20) DEFAULT 'english',
  `foundation` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_system`
--

INSERT INTO `gtg_system` (`id`, `cname`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `email`, `taxid`, `tax`, `currency`, `currency_format`, `prefix`, `dformat`, `zone`, `logo`, `lang`, `foundation`) VALUES
(1, 'JSOFT SOLUTION SDN BHD', '16-03-C', 'Ara Damansara', 'Petaling Jaya ', 'Malaysia ', '47320', '0125509210', 'sprasad96@gmail.com', 'JSX003456', -1, 'MYR', 0, 'JS', 1, 'Asia/Kuala_Lumpur', '1706503657879730312(1).jpeg', 'english', '2022-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_terms`
--

DROP TABLE IF EXISTS `gtg_terms`;
CREATE TABLE IF NOT EXISTS `gtg_terms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` int NOT NULL,
  `terms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_terms`
--

INSERT INTO `gtg_terms` (`id`, `title`, `type`, `terms`) VALUES
(1, 'Term & Condition', 0, '<p>All cheque are subjected to be issued to the following Account No. : 8600597764 [Bank: CIMB].Our customer will have our prompt\r\nand careful attention as always. Corporate Social Responsibility: GO GREEN with SOFTCOPY.<br></p>'),
(2, 'test terms', 0, 'test terms by siva<br>');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_tickets`
--

DROP TABLE IF EXISTS `gtg_tickets`;
CREATE TABLE IF NOT EXISTS `gtg_tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `cid` int NOT NULL,
  `status` enum('Solved','Processing','Waiting') NOT NULL,
  `section` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_tickets_th`
--

DROP TABLE IF EXISTS `gtg_tickets_th`;
CREATE TABLE IF NOT EXISTS `gtg_tickets_th` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tid` int NOT NULL,
  `message` text,
  `cid` int NOT NULL,
  `eid` int NOT NULL,
  `cdate` datetime NOT NULL,
  `attach` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `cid` (`cid`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_todolist`
--

DROP TABLE IF EXISTS `gtg_todolist`;
CREATE TABLE IF NOT EXISTS `gtg_todolist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tdate` date NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('Due','Done','Progress') NOT NULL DEFAULT 'Due',
  `start` date NOT NULL,
  `duedate` date NOT NULL,
  `description` text,
  `eid` int NOT NULL,
  `aid` int NOT NULL,
  `related` int NOT NULL,
  `priority` enum('Low','Medium','High','Urgent') NOT NULL,
  `rid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_transactions`
--

DROP TABLE IF EXISTS `gtg_transactions`;
CREATE TABLE IF NOT EXISTS `gtg_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `acid` int NOT NULL,
  `account` varchar(200) NOT NULL,
  `type` enum('Income','Expense','Transfer') NOT NULL,
  `cat` varchar(200) NOT NULL,
  `debit` decimal(16,2) DEFAULT '0.00',
  `credit` decimal(16,2) DEFAULT '0.00',
  `payer` varchar(200) DEFAULT NULL,
  `payerid` int NOT NULL DEFAULT '0',
  `method` varchar(200) DEFAULT NULL,
  `date` date NOT NULL,
  `tid` int NOT NULL DEFAULT '0',
  `eid` int NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `ext` int DEFAULT '0',
  `loc` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `loc` (`loc`),
  KEY `acid` (`acid`),
  KEY `eid` (`eid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_transactions`
--

INSERT INTO `gtg_transactions` (`id`, `acid`, `account`, `type`, `cat`, `debit`, `credit`, `payer`, `payerid`, `method`, `date`, `tid`, `eid`, `note`, `payment_proof`, `ext`, `loc`) VALUES
(1, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1900.00', 'Walk-in Client', 1, 'Cash', '2023-02-10', 2, 6, 'Payment for invoice #1002', '', 0, 0),
(2, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Walk-in Client', 1, 'Card', '2023-02-13', 1, 6, 'Payment for invoice #1001', '', 0, 0),
(3, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Card', '2023-02-23', 3, 3, 'Card Payment for #1003', '', 0, 0),
(4, 1, 'Sales Account', 'Income', 'Sales', '0.00', '99.00', 'Shafeek Ajmal', 1, 'Card', '2023-02-23', 3, 3, 'Card Payment for #1003', '', 0, 0),
(5, 1, 'Sales Account', 'Income', 'Sales', '0.00', '99.00', 'Shafeek Ajmal', 1, 'Card', '2023-03-10', 3, 3, 'Card Payment for #1003', '', 0, 0),
(6, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.50', 'Shafeek Ajmal', 1, 'Balance', '2023-03-13', 1, 6, 'Payment for invoice #1001', '', 0, 0),
(7, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01 customer note:Payment for invoice #1001', '', 0, 0),
(8, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01 customer note:test', '', 0, 0),
(9, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01  customer note:final', '', 0, 0),
(10, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01  customer note:final', '', 0, 0),
(11, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', '', 0, 0),
(12, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', '', 0, 0),
(13, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', '', 0, 0),
(14, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.43', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.43  customer note:Payment for invoice #1001', '', 0, 0),
(15, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 5, 3, 'Wallet Payment for invoice #1005, amount: 0.01  customer note:Payment for invoice #1005', '', 0, 0),
(16, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Card', '2023-03-13', 5, 3, 'Card for #SRN1005 by ipay88 transid:T184069815623', '', 0, 0),
(17, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-14', 5, 3, 'Wallet Payment for invoice #1005, amount: 01  customer note:Payment for invoice #1005', '', 0, 0),
(18, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet', '2023-03-21', 5, 3, 'Wallet for invoice #1005, amount: 0.01  customer note:Payment for invoice #1005', '', 0, 0),
(19, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Jsoftsolution', 10, 'Wallet', '2023-03-21', 4, 3, 'Wallet for invoice #1004, amount: 0.01  customer note:Payment for invoice #1004', '', 0, 0),
(20, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Jsoftsolution', 10, 'Wallet', '2023-03-21', 4, 3, 'Wallet for invoice #1004, amount: 0.01  customer note:Payment for invoice #1004', '', 0, 0),
(21, 1, 'Sales Account', 'Income', 'Sales', '0.00', '5.00', 'Shafeek Ajmal', 1, 'Wallet', '2023-05-12', 24, 1, 'Wallet for invoice #1024, amount: 5.00  customer note:Payment for invoice #1024', '', 0, 0),
(22, 1, 'Sales Account', 'Income', 'Sales', '0.00', '42.00', 'Testing2', 13, 'Wallet', '2023-05-17', 22, 1, 'Wallet for invoice #1022, amount: 42.00  customer note:Payment for invoice #1022', '', 0, 0),
(23, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Testing2', 13, 'Maybank2U', '2023-05-17', 27, 1, 'Maybank2U for #SRN1027 by ipay88 transid:T195717025523', '', 0, 0),
(25, 1, 'Sales Account', 'Income', 'Sales', '0.00', '157.50', 'Shafeek Ajmal', 1, 'Cash', '2023-05-18', 31, 1, '#1001-Cash', '', 0, 0),
(26, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Testing2', 13, 'Maybank2U', '2023-05-31', 27, 1, 'Maybank2U for #SRN1027 by ipay88 transid:T198480583823', '', 0, 0),
(27, 1, 'Sales Account', 'Income', 'Sales', '0.00', '5.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-14', 43, 1, '#1002-Cash', '', 0, 0),
(28, 1, 'Sales Account', 'Expense', 'Expenses', '1000.00', '0.00', 'exabyte sdn hd ', 0, 'Bank', '2023-06-15', 0, 6, 'buy a server ', '', 1, 0),
(29, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '1000.00', 'Windy ', 2, 'Cash', '2023-06-20', 0, 6, 'Bought PC', '', 1, 0),
(30, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '1000.00', 'Windy ', 2, 'Cash', '2023-06-20', 0, 6, 'Bought PC', '', 1, 0),
(31, 1, 'Sales Account', 'Expense', 'Expenses', '1000.00', '0.00', 'Windy ', 2, 'Cash', '2023-06-20', 0, 6, 'Bought PC', '', 1, 0),
(32, 1, 'Sales Account', 'Income', 'Sales', '0.00', '18.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-21', 53, 24, '#1003-Cash', '', 0, 0),
(33, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-27', 55, 1, '#1004-Cash', '', 0, 0),
(34, 1, 'Sales Account', 'Income', 'Sales', '0.00', '11.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-27', 56, 1, '#1005-Cash', '', 0, 0),
(35, 1, 'Sales Account', 'Income', 'Sales', '0.00', '11.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 57, 1, '#1006-Cash', '', 0, 0),
(36, 1, 'Sales Account', 'Income', 'Sales', '0.00', '11.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 58, 1, '#1007-Cash', '', 0, 0),
(37, 1, 'Sales Account', 'Income', 'Sales', '0.00', '11.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 59, 1, '#1008-Cash', '', 0, 0),
(38, 1, 'Sales Account', 'Income', 'Sales', '0.00', '12.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 60, 1, '#1009-Cash', '', 0, 0),
(39, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 61, 1, '#1010-Cash', '', 0, 0),
(40, 1, 'Sales Account', 'Income', 'Sales', '0.00', '11.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 62, 1, '#1011-Cash', '', 0, 0),
(41, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-28', 63, 1, '#1012-Cash', '', 0, 0),
(42, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-29', 64, 1, '#1013-Cash', '', 0, 0),
(43, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-29', 65, 1, '#1014-Cash', '', 0, 0),
(44, 1, 'Sales Account', 'Income', 'Sales', '0.00', '6.00', 'Shafeek Ajmal', 1, 'Cash', '2023-06-29', 67, 1, '#1015-Cash', '', 0, 0),
(45, 1, 'Sales Account', 'Income', 'Sales', '0.00', '21.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 71, 1, '#1016-Cash', '', 0, 0),
(46, 1, 'Sales Account', 'Income', 'Sales', '0.00', '47.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 72, 1, '#1017-Cash', '', 0, 0),
(47, 1, 'Sales Account', 'Income', 'Sales', '0.00', '52.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 73, 1, '#1018-Cash', '', 0, 0),
(48, 1, 'Sales Account', 'Income', 'Sales', '0.00', '78.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 75, 1, '#1019-Cash', '', 0, 0),
(49, 1, 'Sales Account', 'Income', 'Sales', '0.00', '104.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 76, 1, '#1020-Cash', '', 0, 0),
(50, 1, 'Sales Account', 'Income', 'Sales', '0.00', '73.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 77, 1, '#1021-Cash', '', 0, 0),
(51, 1, 'Sales Account', 'Income', 'Sales', '0.00', '26.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 78, 1, '#1022-Cash', '', 0, 0),
(52, 1, 'Sales Account', 'Income', 'Sales', '0.00', '125.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-05', 79, 1, '#1023-Cash', '', 0, 0),
(53, 1, 'Sales Account', 'Income', 'Sales', '0.00', '26.00', 'Shafeek Ajmal', 1, 'Cash', '2023-07-06', 80, 1, '#1024-Cash', '', 0, 0),
(54, 1, 'Sales Account', 'Income', 'Sales', '0.00', '173.72', 'Shafeek Ajmal', 1, 'Cash', '2023-07-10', 84, 1, '#1025-Cash', '', 0, 0),
(55, 1, 'Sales Account', 'Income', 'Sales', '0.00', '219.42', 'Shafeek Ajmal', 1, 'Cash', '2023-07-10', 85, 1, '#1026-Cash', '', 0, 0),
(56, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1360.00', 'Raj', 11, 'Cash', '2023-07-17', 97, 6, 'Payment for invoice #1063', '', 0, 0),
(57, 1, 'Sales Account', 'Income', 'Sales', '0.00', '4770.00', 'Sharon', 74, 'Wallet', '2023-07-19', 100, 40, 'Wallet for invoice #1066, amount: 4770.00  customer note:Payment for invoice #1066', '', 0, 0),
(58, 1, 'Sales Account', 'Income', 'Sales', '0.00', '378.75', 'Shafeek Ajmal', 1, 'Cash', '2023-07-19', 101, 40, '#1027-Cash', '', 0, 0),
(59, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'Shafeek Ajmal', 1, 'Bank', '2023-09-12', 103, 6, 'Payment for invoice #1067', '', 0, 0),
(60, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'Shafeek Ajmal', 1, 'Card', '2023-09-12', 103, 6, 'Payment for invoice #1067', '', 0, 0),
(61, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'Shafeek Ajmal', 1, 'Balance', '2023-09-12', 103, 6, 'Payment for invoice #1067', '', 0, 0),
(62, 1, 'Sales Account', 'Transfer', '', '0.00', '10.00', '', 0, '', '2023-10-05', 0, 6, 'Transferred by Sales Account', '', 9, 0),
(63, 1, 'Sales Account', 'Transfer', '', '10.00', '0.00', '', 0, '', '2023-10-05', 0, 6, 'Transferred to Sales Account', '', 9, 0),
(64, 1, 'Sales Account', 'Transfer', '', '0.00', '100.00', '', 0, '', '2023-10-05', 0, 6, 'Transferred by Sales Account', '', 9, 0),
(65, 1, 'Sales Account', 'Transfer', '', '100.00', '0.00', '', 0, '', '2023-10-05', 0, 6, 'Transferred to Sales Account', '', 9, 0),
(66, 1, 'Sales Account', 'Income', 'Sales', '0.00', '86.00', 'Hasan Prasetyo', 12, 'Cash', '2023-10-10', 112, 53, '#1028-Cash', '', 0, 0),
(67, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'Shafeek Ajmal', 1, 'Cash', '2023-10-17', 107, 6, '', '', 0, 0),
(68, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'Shafeek Ajmal', 1, 'Cash', '2023-10-17', 107, 6, '', '', 0, 0),
(69, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'sivaprasad', 84, 'Balance', '2023-10-17', 106, 6, '', '', 0, 0),
(70, 1, 'Sales Account', 'Income', 'Sales', '0.00', '500.00', 'sivaprasad', 84, 'Cash', '2023-10-17', 106, 6, '', '', 0, 0),
(71, 1, 'Sales Account', 'Income', 'Sales', '0.00', '598.00', 'sivaprasad', 84, 'Cash', '2023-10-17', 106, 6, '', '', 0, 0),
(72, 1, 'Sales Account', 'Income', 'Sales', '0.00', '10.00', 'Shafeek Ajmal', 1, 'Cash', '2023-10-17', 105, 6, '', '', 0, 0),
(73, 1, 'Sales Account', 'Income', 'Sales', '0.00', '10.00', 'Shafeek Ajmal', 1, 'Cash', '2023-10-17', 105, 6, '', '', 0, 0),
(74, 1, 'Sales Account', 'Income', 'Sales', '0.00', '70.00', 'Shafeek Ajmal', 1, 'Cash', '2023-10-17', 105, 6, '', '', 0, 0),
(75, 1, 'Sales Account', 'Income', 'Sales', '0.00', '500.00', 'G Krishna', 16, 'Cash', '2023-10-17', 104, 6, '', '', 0, 0),
(76, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'mr sry', 4, 'Cash', '2023-10-17', 7, 6, '', '', 0, 0),
(77, 1, 'Sales Account', 'Income', 'Sales', '150.00', '0.00', 'mr sry', 4, 'Cash', '2023-11-16', 8, 6, '', '', 0, 0),
(78, 1, 'Sales Account', 'Expense', 'Purchase', '1938.50', '0.00', 'mr sry', 4, 'Bank', '2023-11-17', 9, 6, 'Payment for purchase #1009', '', 1, 0),
(79, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'mr sry', 4, 'Cash', '2023-11-19', 6, 6, '', '', 0, 0),
(80, 1, 'Sales Account', 'Income', 'Sales', '500.00', '0.00', 'mr sry', 4, 'Cash', '2023-11-19', 5, 6, 'kjhjkhkjhk', '', 0, 0),
(81, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.00', 'mr sry', 4, 'Cash', '2023-11-20', 9, 6, '', '', 0, 0),
(82, 1, 'Sales Account', 'Income', 'Sales', '0.00', '300.00', 'Shafeek Ajmal', 1, 'Cash', '2023-11-22', 114, 6, '', '', 0, 0),
(83, 1, 'Sales Account', 'Income', 'Sales', '3800.00', '0.00', 'mr sry', 4, 'Cash', '2023-11-22', 16, 6, '', '', 0, 0),
(84, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '100.00', 'Shafeek Ajmal ', 1, 'Cash', '2023-11-29', 0, 6, 'shshs', '', 0, 0),
(85, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '20.00', 'mr sry ', 4, 'Cash', '2023-11-16', 0, 6, '', '', 1, 0),
(86, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '20.00', 'mr sry ', 4, 'Cash', '2023-11-16', 0, 6, 'dwfdeq', '', 1, 0),
(87, 1, 'Sales Account', 'Income', 'Sales', '0.00', '500.00', 'Shafeek Ajmal', 1, 'Cash', '2023-11-29', 115, 6, '', '', 0, 0),
(88, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '100.00', 'Shafeek Ajmal ', 1, 'Cash', '2023-11-29', 0, 6, 'ddd', '', 0, 0),
(89, 1, 'Sales Account', 'Income', 'Expenses', '0.00', '100.00', 'Windy ', 2, 'Cash', '2023-11-17', 0, 6, 'eee', '', 1, 0),
(90, 1, 'Sales Account', 'Income', 'Sales', '0.00', '43.00', NULL, 0, 'Cash', '2023-12-19', 116, 58, '#1029-Cash', '', 0, 0),
(91, 1, 'Sales Account', 'Income', 'Sales', '0.00', '43.00', NULL, 0, 'Cash', '2023-12-19', 117, 58, '#1030-Cash', '', 0, 0),
(92, 1, 'Sales Account', 'Income', 'Sales', '0.00', '297.00', NULL, 0, 'Cash', '2023-12-19', 118, 58, '#1031-Cash', '', 0, 0),
(93, 1, 'Sales Account', 'Income', 'Sales', '0.00', '297.00', NULL, 0, 'Cash', '2023-12-19', 119, 58, '#1032-Cash', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_trans_cat`
--

DROP TABLE IF EXISTS `gtg_trans_cat`;
CREATE TABLE IF NOT EXISTS `gtg_trans_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_trans_cat`
--

INSERT INTO `gtg_trans_cat` (`id`, `name`) VALUES
(2, 'Expenses'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_units`
--

DROP TABLE IF EXISTS `gtg_units`;
CREATE TABLE IF NOT EXISTS `gtg_units` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `code` varchar(5) NOT NULL,
  `type` int NOT NULL,
  `sub` int NOT NULL,
  `rid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_units`
--

INSERT INTO `gtg_units` (`id`, `name`, `code`, `type`, `sub`, `rid`) VALUES
(1, 'xl', 'xl', 0, 0, 0),
(2, 'xl', '', 1, 0, 0),
(3, 'l', '', 1, 0, 0),
(4, 'm', '', 1, 0, 0),
(5, 'xs', '', 1, 0, 0),
(6, 'xs', '', 2, 0, 5),
(7, 'm', '', 2, 0, 4),
(8, 'l', '', 2, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_uploads`
--

DROP TABLE IF EXISTS `gtg_uploads`;
CREATE TABLE IF NOT EXISTS `gtg_uploads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contract_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upload_date` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_uploads`
--

INSERT INTO `gtg_uploads` (`id`, `contract_id`, `file_name`, `file_path`, `file_type`, `file_size`, `created_at`, `upload_date`) VALUES
(6, 9, 'Error_ERP1702514982.pdf', 'https://localhost/erp-dev/userfiles/contract_docs/Error_ERP1702514982.pdf', 'application/pdf', 790, '2023-12-14 00:49:42', '2023-12-14 00:49:42'),
(7, 10, 'Error_ERP1702515356.pdf', 'https://localhost/erp-dev/userfiles/contract_docs/Error_ERP1702515356.pdf', 'application/pdf', 790, '2023-12-14 00:55:56', '2023-12-14 00:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_users`
--

DROP TABLE IF EXISTS `gtg_users`;
CREATE TABLE IF NOT EXISTS `gtg_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `roleid` int NOT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `loc` int NOT NULL,
  `lang` char(15) NOT NULL DEFAULT 'english',
  `login_status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_users`
--

INSERT INTO `gtg_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`, `loc`, `lang`, `login_status`) VALUES
(1, 'testing@gmail.com', '6bb5b4afb231da6a4c8439e5b9b967ec7a1faf47f31f4a743fa8ef5735c55e62', 'testing', 0, '2023-05-16 01:03:17', '2023-05-16 01:03:17', '2023-01-29 20:06:02', NULL, NULL, NULL, NULL, NULL, '113.211.101.190', 5, '16806759151426990786.png', 0, 'english', 0),
(2, 'ajmal@jsoftsolution.com.my', '8d86167f21aa93362ca383bae8cb2ba7ff23b77712c08e0d68cc24b0754f1ec2', 'ajmal', 0, '2023-06-12 02:23:58', '2023-06-12 02:23:58', '2023-02-02 08:31:56', NULL, NULL, NULL, NULL, NULL, '121.121.85.171', 4, '16861129861475570024.png', 0, 'english', 1),
(3, 'abcd@gmail.com', 'd5c97e5827ac9609231ec60907bd423377f3023acbb45f9701357d4f1aa2bce8', 'abcd', 0, '2024-02-06 10:58:04', '2024-02-06 10:58:04', '2023-02-05 12:37:38', NULL, '2024-02-08 00:00:00', 'waqcVRAEB07DGImH', NULL, NULL, '127.0.0.1', 2, '1686070936115891243.png', 0, 'english', 1),
(4, 'myname@gmail.com', 'e40570440e412408307f64e060e5949192b7c5ba9965b7e40a2a437628077b57', 'myname', 0, '2023-06-07 16:17:13', '2023-06-07 16:17:13', '2023-03-14 07:31:37', NULL, NULL, NULL, NULL, NULL, '14.192.213.86', 4, '16806759931752597390.png', 0, 'english', 1),
(6, 'admin@admin.com', '3913228818759cd846b475d3106a4ecc9bf9bd91746cab4e88a8750c11d15914', 'admin', 0, '2024-02-06 22:42:14', '2024-02-06 22:42:14', '2022-04-14 11:35:34', NULL, '2023-11-25 00:00:00', '7yLXH9v4VFEpZO0B', '', NULL, '::1', 5, '1667294757148617952.jpeg', 0, 'english', 0),
(7, 'salesperson@abc.om', '3ed55a7943024f5fdf89c6aeb593c6622463e980e97f6f201f91ae5f30f42f99', 'salesperson', 0, '2022-04-15 03:48:18', '2022-04-15 03:48:19', '2022-04-15 03:34:03', NULL, NULL, NULL, NULL, NULL, '::1', 1, 'example.png', 0, 'english', 0),
(8, 'krish@jsoftsolution.com.my', '90e002a56457d390a2ddbddf807135a242d3d7bace8ddd9e7350cfa086c53c48', 'krish', 0, '2022-11-02 03:53:04', '2022-11-02 03:53:04', '2022-11-01 07:37:14', NULL, NULL, NULL, NULL, NULL, '2001:d08:2297:282d:26:1694:74b0:b196', 3, '16672918891901802524.jpeg', 0, 'english', 0),
(9, 'raj@jsoftsolution.com.my', '660807946ad1865ba31d990c14dce2a5af394a19a69cdb830db743806df5202a', 'raj', 0, '2023-01-23 05:32:17', '2023-01-23 05:32:17', '2022-12-23 10:34:36', NULL, NULL, NULL, NULL, NULL, '::1', 4, 'example.png', 0, 'english', 0),
(10, 'hariinraj29@yahoo.com', 'b7e185512c047ad01cc0a2a21141c97c7aa06977e9f0c271ec997a392b9c2986', 'hariinraj29', 0, '2023-05-17 04:44:25', '2023-05-17 04:44:25', '2023-05-05 10:27:35', NULL, NULL, NULL, NULL, NULL, '121.123.244.7', 5, 'example.png', 0, 'english', 0),
(11, 'testingjsoft@gmail.com', '84042bb415fefb8be3b833354b6f1d4d7c79825e48e1214901e1c20b167d0eab', 'Prabhat', 0, '2023-06-21 07:27:53', '2023-06-21 07:27:53', '2023-05-05 10:37:35', NULL, NULL, NULL, NULL, NULL, '121.122.100.169', -1, 'example.png', 0, 'english', 0),
(14, 'udhayas@gmail.com', '2a74b4a28f00408c278c6620a81f507dd1a74a7e0237eab83c4a967665968f48', 'udhay', 0, NULL, NULL, '2023-06-08 10:19:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(15, 'mathan@mail.com', '196075d3b960128ae4a5cf79596d3d06ed482c5535c813ec0c7dbc2e6be032be', 'mathan', 0, NULL, NULL, '2023-06-08 10:23:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(16, 'udhay@mail.com', '8c04f0d45d99fb3c09f7c82165b9672b53145f042c0d27a0067b25103c26408f', 'udhaya', 0, NULL, NULL, '2023-06-08 10:26:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(17, 'hari@gmail.com', '1cb4df1f9cc3eff69f9fa98a554c0cac43000c0fa999e7e51bd80fc23ab644a1', 'harinraj', 0, NULL, NULL, '2023-06-08 10:31:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(18, 'illyah@gmail.com', '19ed9ca8fa44b07b21dde25508ba1e3cac6e0abbb79bc918ccb27591cbc762fb', 'Illyah01', 0, NULL, NULL, '2023-06-09 10:42:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(19, 'amir@gmail.com', '13bb3cbb038bbd2b8519e04e039303f449012abe989da6a7fab69de8512de9d4', 'Amir29', 0, NULL, NULL, '2023-06-09 14:10:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(20, 'testemployee@gmail.com', 'da42e6365c0273267ee7fd7dbce9e95436291c91d308dda4a16ea52da52419ae', 'testemployee', 0, NULL, NULL, '2023-06-10 04:49:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(21, 'ravi@gmail.com', '1ec551e2917d5181571c9a5c6e36ed78930f3213ec89c9e38a3487f764a25dcf', 'ravi', 0, NULL, NULL, '2023-06-10 05:39:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(22, 'shah@gmail.com', '38d9ec86f954bbacc867dd8630cbcdaef2c3b3bfdbfaec5a82587839f482ec53', 'Shah', 0, NULL, NULL, '2023-06-11 02:38:14', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(23, 'naresh@gmail.com', '95a807da3742c28e70a40695ea3a697b33aeb6e6232cf10819844a43d5d9b9ad', 'naresh', 0, NULL, NULL, '2023-06-12 03:10:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(24, 'adam@gmail.com', '924c064274886a0b88066559112e2ec439bba89a3ea727f6b1ec6e4ad7ecbad5', 'Adam29', 0, '2023-10-04 05:03:19', '2023-10-04 05:03:19', '2023-06-12 05:07:19', NULL, '2023-06-16 00:00:00', 'h83lKVtHpaIP15n9', NULL, NULL, '127.0.0.1', -1, 'example.png', 0, 'english', 1),
(25, 'reena@jsoftsolution.com.my', '07cb69ba34b928ee81737913ba4f23db6ecb48cf3200a10ea010b6e5a9d64c3c', 'reena', 0, '2023-06-21 02:32:30', '2023-06-21 02:32:30', '2023-06-15 05:57:58', NULL, '2023-06-24 00:00:00', 'f0le9sBGYhmDN6yX', NULL, NULL, '121.122.100.169', 2, 'example.png', 0, 'english', 1),
(26, 'krish@gmail.com', '0bc67909cf8012ef20ff78813d0c49e2c74402866becc0d68b360e91431216d7', 'krish0081', 0, NULL, NULL, '2023-06-20 22:38:31', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(27, 'jenifer@gmail.com', 'e7aa36bc7d93e8443d5781e9401a51180da0054391205db4a898e8129705193b', 'jenifer', 0, '2023-06-20 23:30:22', '2023-06-20 23:30:22', '2023-06-20 22:53:15', NULL, NULL, NULL, NULL, NULL, '180.74.219.115', 4, 'example.png', 0, 'english', 1),
(28, 'alvin@gmail.com', '0aa5a81093ec0e686386038d7793b0a8a866bca2e11cc4e905f12fe732339aec', 'Alvin', 0, '2023-10-04 05:09:58', '2023-10-04 05:09:58', '2023-06-21 07:34:51', NULL, '2023-10-07 00:00:00', 'z4xPTVa3G1DZebKm', NULL, NULL, '127.0.0.1', 1, 'example.png', 0, 'english', 1),
(29, 'suresh@gmail.com', '9062845ecc4f511be576b88d8be16f68d59b83efb359f51ccf404b7d5a061177', 'suresh', 0, NULL, NULL, '2023-06-30 09:44:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(30, 'demoemployee@gmail.com', '7c41cd1c5ab502e5693185bc777a2c4a627569b2a9bbb429218ae3240a8e2e3e', 'demoemployee', 0, NULL, NULL, '2023-07-03 02:21:44', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(31, 'alex@gmail.com', '18868264e062188775eee4a4eaf26de96429cf62d9f9765b8d6d27ab1e3437c4', 'Alex2', 0, NULL, NULL, '2023-07-12 07:12:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(32, 'Kridddddddsh@jsoftsolution.com.my', '9303833982d500ef350a3ef4aeea2418c3c43cb4ddda3761dc0be91613eb3519', 'asdasd', 0, NULL, NULL, '2023-07-12 09:01:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(33, 'adsssmin@gmail.com', '6cb91e6bbe8b85093d8b7b05426c0f262e805ccad38108d3926e3f23e01f0a89', 'sdsdsd', 0, NULL, NULL, '2023-07-12 10:04:24', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(34, 'Kriffffsh@jsoftsolution.com.my', '8d5917d040aa140ee042d878d45a16d3e3533db8ca3e873f50338d0108989ae5', 'sdfssdfsdf', 0, NULL, NULL, '2023-07-12 10:13:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(35, 'test1444423@gmail.com', 'ad969bf0fdd6184fd78a33ef332da112131d8aea0362223fb03505832d9890a7', 'sdfsdfsdf', 0, NULL, NULL, '2023-07-12 10:40:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(37, 'k.udhayarajasoftsolution.com.my@gmail.com', 'ddd47862cd81e23296da633d3d91f930d06bec24557bdbd6ab012dba03e3276a', 'basdffffff', 0, NULL, NULL, '2023-07-12 10:54:05', NULL, NULL, NULL, NULL, NULL, NULL, 3, 'example.png', 0, 'english', 0),
(38, 'demosample@gmail.com', '7972ac8c13e1a8c3e6bdea7bcb651828b47000d556976076fafdd95f6926ad9e', 'demosample', 0, NULL, NULL, '2023-07-12 11:10:23', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'example.png', 0, 'english', 0),
(39, 'akajith@gmail.com', '4cabd4a9612354066d9ec504697863dc8c137300843c8a848ae077549b6f9398', 'akajith', 0, NULL, NULL, '2023-07-12 11:16:21', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'example.png', 0, 'english', 0),
(40, 'steve@gmail.com', '44abfb48fe5c8d0972a337f23c0166475862f79a82130836f512b0702a63c31b', 'Steve19', 0, '2023-07-19 11:11:05', '2023-07-19 11:11:05', '2023-07-12 11:45:05', NULL, NULL, NULL, NULL, NULL, '113.211.135.151', 11, '16897465051063658153 (1).jpeg', 0, 'english', 1),
(41, 'alfred@gmail.com', 'd59c522bf7aa5d8410d339d3e0f02f3f5f66c63e498eb2f3badbecf9242fc4fe', 'Aflred29', 0, '2023-07-14 09:06:06', '2023-07-14 09:06:06', '2023-07-12 11:47:51', NULL, NULL, NULL, NULL, NULL, '218.208.18.87', 0, 'example.png', 0, 'english', 0),
(42, 'vivevk@gmail.com', 'cc618f839c52981c8ac95b25adea7d48ce1740b54cec391234ed22acc76cef3d', 'vivevk', 0, NULL, NULL, '2023-07-12 11:57:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(43, 'domesticuser@gmail.com', '8f2c3571f7d611f9a6ed7ed1daedb8671345d0307cc040575fb2dac126b62575', 'domesticuser', 0, NULL, NULL, '2023-07-13 11:16:16', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'example.png', 0, 'english', 0),
(44, 'foreignuser@gmail.com', '68be7a9ac332d21688d8a8ea23c29ba3dd62ca6083d56594128813ebe94c14ca', 'foreignuser', 0, NULL, NULL, '2023-07-13 11:17:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(45, 'vijaykumar@gmail.com', '0f534da9e230bdf6185a4a3733ba998c9fb455c2686e886a10ed8d791b16dc64', 'vijaykumar', 0, NULL, NULL, '2023-07-19 05:45:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(46, 'harishkalyan@gmail.com', '1809d17359f68f12e5de0485592ff850add937385a1b19aae2c4a1d546787ac8', 'harishkalyan', 0, NULL, NULL, '2023-07-19 05:56:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(47, 'muthukumar@gmail.com', 'a965df447c1901b45dcd108f13a8d073ae03ec3a7d67a27223fdee245541c57f', 'muthukumar', 0, NULL, NULL, '2023-07-19 05:58:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(48, 'ranjithkumar@gmail.com', '075ee5fb8d7b1de87902170252f433bb3565b11ffb79fbece6f8844cf008a97b', 'ranjithkumar', 0, NULL, NULL, '2023-07-19 06:01:24', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(49, 'das@gmail.com', '2205db6dfa7d63ae2d9dc1000db43465c9d535d069054286b34d2d0d61bbddac', 'das', 0, NULL, NULL, '2023-07-19 06:02:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(50, 'sprasad96@gmail.com', '4cfbd0e40deb73118023ee0b245b5e4a2b3c5842452d52d2e084a479956d39d6', 'sivaaaa', 0, '2023-12-19 04:14:27', '2023-12-19 04:14:27', '2023-09-08 07:36:32', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2, 'example.png', 0, 'english', 0),
(51, 'kjhkjhjjk@jhkj.dfd', '17cfd1fcc7f04aae63d300bf25524ecbfe8c4b4304d39a178f6a471de0ce6541', 'jhkjhkjhkjh', 0, NULL, NULL, '2023-09-11 09:40:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(52, 'hjghjghjgjh@saf.sadf', '33d3f285a862bd66cfc39882a941e581eb7e34b65bd494fc8433407819f551d4', 'gjhghjgjhg', 0, NULL, NULL, '2023-09-11 09:44:54', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'example.png', 0, 'english', 0),
(53, 'ffffff@gmail.com', '3cdc7fe6e25ec8f11ddc38ec61984bec04bd49c2f51a36a3a745b32b15f6731b', 'fffffff', 0, '2023-09-12 18:01:50', '2023-09-12 18:01:50', '2023-09-12 09:14:05', NULL, '2023-09-15 00:00:00', 'iMZ4nhNAXsE79S1o', NULL, NULL, '127.0.0.1', 6, 'example.png', 0, 'english', 0),
(54, 'sss@gmail.com', 'ae1e3ffe4cf6f41011ce716cd42eb120be9624801ace3cf46319e8eae6d54019', 'tryuiujbmhg', 0, NULL, NULL, '2023-09-12 18:03:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(55, 'ssss@gmail.com', '2efd2f24976eaeaf12c0ec9c9697fe79c07117aafd05edb2d995b04527837bf8', 'tryuiujbmhgds', 0, NULL, NULL, '2023-09-12 18:03:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(56, 'ssssdd@gmail.com', '299d77c02eb59048b25e0d592d690e235b23a6dddb9e4a2737c763ff2bca236c', 'tryuiujbmhgdsdf', 0, NULL, NULL, '2023-09-12 18:07:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(57, 'ddsasda@gmail.com', '5c79c44c90c0bd1782a873b49526927f09e17083208d90434c4acc1774b06d7d', 'tryuiuasdjbmhgdsdf', 0, NULL, NULL, '2023-09-12 18:09:24', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(58, 'ddsasdaddd@gmail.com', 'e4dd85ad72071404c5e093776dffcad6578adec6c0b435ae776ec503e8402d7c', 'tryuiuasdjbmhgdsdfasd', 0, '2023-09-25 04:38:24', '2023-09-25 04:38:24', '2023-09-12 18:12:19', NULL, NULL, NULL, NULL, NULL, '::1', 14, '17058885301274772737(1).png', 0, 'english', 1),
(59, 'hjghjghjgj@sfddf.fdd', 'a2b95c3ea6d4bd9e009fbff1a646ac348a46d48f3ca4f939ec019e3abdb3d3ba', 'hjghjg', 0, NULL, NULL, '2023-09-25 05:50:03', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'example.png', 0, 'english', 0),
(60, 'hjgjh@saddaf.dff', 'fc47e32053fd3722aa50d10e7483036f1c78edde480a3fc7e67bccf5ab564cbf', 'hgjhgjhh', 0, NULL, NULL, '2023-09-25 05:53:34', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(61, 'fgfggfgfgf@fff.fff', 'e2a8a415e8ea6e25815dd65cbfff77f06d47ae36da0cdf422b913178dcd20404', 'hgghgghghgf', 0, NULL, NULL, '2023-09-25 05:55:03', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(62, 'fgfggfssgfgf@fff.fff', 'fd8dd28c3c8312100726eb2630c3c4b0c00bc5f6decac256c8a84c3d85fbf7e6', 'hgghgghghgfsss', 0, NULL, NULL, '2023-09-25 05:57:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(63, '', '', '', 0, NULL, NULL, '2023-09-25 10:00:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(64, 'testsiva@gmail.com', '583e645052aacfbd4295829ecb008b7a3efb185f81677490f41a23a8eceeeb11', 'TestSivaPrasad', 0, NULL, NULL, '2023-12-12 05:49:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'example.png', 0, 'english', 0),
(65, 'testwwsiva@gmail.com', '438ab9a4e235d4ecf4899c2103aab148ecd8cce6615de6dc48b6aa401e44608c', 'TestSivaPrasadwee', 0, NULL, NULL, '2023-12-12 05:49:57', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'example.png', 0, 'english', 0),
(66, 'ssssp@gmail.com', '1f19b92966b4701af57205e670b604e9f3eb75a86f57f68c9b42c8e34ba0c996', 'siva', 0, NULL, NULL, '2023-12-13 07:20:38', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'example.png', 0, 'english', 0),
(67, 'siva@jsoftsolution.com.my', '4429d42f28b6c973a699a338b0e4b41638ba403767c44ff518c7cf9e49eefcbf', 'Sivaprasad', 0, '2024-01-10 04:12:41', '2024-01-10 04:12:41', '2024-01-10 04:09:35', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2, 'example.png', 0, 'english', 1),
(68, 'alvin6241@gmail.com', '5b90bb1ffc8aa228a2e5ae4b7860fe8ab031892f77d72241e5ded11a36774a2a', 'Alvin A/L Adaikalasamy', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(69, 'dzulhelmie7@gmail.com', '1a61b7bdfd1f0b95851f2cbe2c3ec53801638b526df0f5a1cab9fe8993e4c325', 'Dzul Helmie Bin Ahmd Damanhuri', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(70, 'fathivans92@gmail.com', '2fae9cbcf3024f184d7da121663e9bf4722f43a33edb15488a675bf98d580b9e', 'Muhammad Fathi Bin Jamaludin', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(71, 'flavianbiswas@gmail.com', '7a548aebaf5d00e3429f90594ee6e9bfafdd527c93e107499e8bcdc0e5451916', 'Flavian Biswas', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(72, 'hethis86@gmail.com', 'db5a9d196e919934a66f9c2ea51024cf9ebef721bd0d95f874078775c7753eef', 'Hethiswara Retnam A/L Kanagaretnam', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(73, 'kailashbhawar536@gmail.com', '73f7fc3318f116ee778eb271c87d97bcaf7288c8bfd9986704b8da748066c280', 'Kailash', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(74, 'kannan3avsi@gmail.com', '9aeb71c616cc02211aae5cd01d51709b24ca34bdfe4865669105f44f5020741b', 'Kannan a/l Bijekumar', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(75, 'karthiksubramaniam1992@gmail.com', '4628ffb2116b2d9c085f978edf8c80314b0d5202adc606a36163f0d342b32406', 'Karthik A/L Subramaniam', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(76, 'kg@avsolutions.com.my', '59ccdfe5fe9f446433b99f088d91093e7fadff81e4e43b17a48a22a66cfbeed4', 'Kumuthan A/L Govindasamy', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(77, 'prakash@avsolutions.com.my', '069e5e27b207257aa4dfa1c9724316262cec94f0fa7ad9ee53ca08d5ca3bbbe9', 'Jeyaprakash A/L Jeyakumar', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(78, 'ragu@avsolutions.com.my', '72cf57c9750dbad236d45379102739cdf10220eaf41ba7480dfe03c3992ad4fe', 'Velayuthan A/L Bala Krishnan', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(79, 'rakeshdhimanrd34@gmail.com', 'bf7ebd05fc080fb7303f0f25f88872be659f52e4960249d8330ba2482a73e039', 'Rakesh Kumar', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(80, 'imran.shaharudin@gmail.com', '05054cd73e154e92164fbe600bca49f75713f92160668887b0e5c50bc4453714', 'Shah Imran bin Shaharudin ', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(81, 'sivamac360@gmail.com', 'c5a7bf3c1e553404466b08be9cec78f5896dbaa67fe3a7b7c9868cbb40748855', 'Sanderasegaran A/L Kumaran', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(82, 'taufiq@avsolutions.com.my', 'd8b79841f68addca3688d85c8663e9678bb7c1802db58d8c7720824aca1024c0', 'Muhammad Taufiq Bin Md Yasin', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0),
(83, 'accounts@avsolutions.com.my', 'fc7657c637345df6d3857c5f02f989d52306f5facae75dd86684dc9e5e0d5bce', 'William Hong', 0, NULL, NULL, '2024-02-01 01:29:26', NULL, NULL, NULL, NULL, NULL, NULL, 8, 'example.png', 0, 'english', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_vehicles`
--

DROP TABLE IF EXISTS `gtg_vehicles`;
CREATE TABLE IF NOT EXISTS `gtg_vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `make` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `year_of_manufacture` int DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vin` varchar(17) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `engine_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chassis_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fuel_type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transmission_type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odometer_reading` int DEFAULT NULL,
  `insurance_details` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `owner_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner_contact` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_history` text COLLATE utf8mb4_general_ci,
  `additional_features` text COLLATE utf8mb4_general_ci,
  `delete_status` int NOT NULL DEFAULT '0',
  `emp_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_vehicles`
--

INSERT INTO `gtg_vehicles` (`id`, `registration_number`, `make`, `model`, `year_of_manufacture`, `color`, `vin`, `engine_number`, `chassis_number`, `fuel_type`, `transmission_type`, `odometer_reading`, `insurance_details`, `registration_date`, `owner_name`, `owner_contact`, `service_history`, `additional_features`, `delete_status`, `emp_id`) VALUES
(1, 'jhgjhg', 'aaaqqq', 'hjj', 0, 'jhdddd', 'hjgjgjhg', NULL, NULL, 'Petrol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'mhj', 'kjh', 'gjhg', 2023, 'jh', 'ghjgj', NULL, NULL, 'Diesel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(3, '4567890', 'ppppp', 'qqqqq', 0, 'RED', 'jgg', NULL, NULL, 'Diesel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 43);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_warehouse`
--

DROP TABLE IF EXISTS `gtg_warehouse`;
CREATE TABLE IF NOT EXISTS `gtg_warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `loc` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_warehouse`
--

INSERT INTO `gtg_warehouse` (`id`, `title`, `extra`, `loc`) VALUES
(1, 'Main WareHouse', 'The Main WareHouse', 0);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_items_thirdparty_pricing`
--

DROP TABLE IF EXISTS `merchant_items_thirdparty_pricing`;
CREATE TABLE IF NOT EXISTS `merchant_items_thirdparty_pricing` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ItemId` int NOT NULL,
  `MerchantId` int NOT NULL,
  `ThirdPartyVendorId` int NOT NULL,
  `ThirdPartyVendorItemId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CityId` int NOT NULL,
  `LocationId` int NOT NULL,
  `SegmentId` int NOT NULL,
  `SubSegmentId` int NOT NULL,
  `Price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SegmentStatus` int NOT NULL DEFAULT '0',
  `ItemStatus` int NOT NULL DEFAULT '1',
  `CrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_items_thirdparty_pricing`
--

INSERT INTO `merchant_items_thirdparty_pricing` (`Id`, `ItemId`, `MerchantId`, `ThirdPartyVendorId`, `ThirdPartyVendorItemId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `SegmentStatus`, `ItemStatus`, `CrDate`) VALUES
(1, 1, 1, 3, '', 0, 0, 26, 38, '50', 0, 1, '2023-07-19 15:02:33'),
(2, 1, 1, 4, '26552', 0, 0, 26, 38, '23', 0, 1, '2023-08-24 07:55:18'),
(10, 2, 1, 4, '2', 0, 0, 26, 38, '23', 0, 1, '2023-07-19 08:46:18'),
(9, 2, 1, 3, '', 0, 0, 26, 38, '21', 0, 1, '2023-06-27 17:29:14'),
(23, 5, 0, 3, '26477', 0, 0, 2, 5, '300', 0, 1, '2023-08-18 16:00:56'),
(12, 3, 1, 4, '3', 0, 0, 3, 5, '25', 0, 1, '2023-07-19 08:46:31'),
(11, 3, 1, 3, '', 0, 0, 3, 5, '26', 0, 1, '2023-07-02 07:37:46'),
(24, 5, 0, 4, '', 0, 0, 2, 5, '225', 0, 1, '2023-08-23 07:43:36'),
(19, 7, 0, 3, '26479', 0, 0, 3, 4, '43', 0, 1, '2023-08-18 16:01:01'),
(20, 7, 0, 4, '', 0, 0, 3, 4, '15', 0, 1, '2023-08-23 07:43:38'),
(21, 4, 0, 3, '', 0, 0, 2, 5, '58', 0, 1, '2023-07-10 07:56:24'),
(22, 4, 0, 4, '', 0, 0, 2, 5, '15', 0, 1, '2023-08-23 07:46:21'),
(25, 6, 0, 3, '', 0, 0, 2, 5, '200', 0, 1, '2023-07-10 07:56:24'),
(26, 6, 0, 4, '', 0, 0, 2, 5, '100', 0, 1, '2023-08-23 08:46:52'),
(27, 7, 0, 3, '', 0, 0, 2, 6, '10', 0, 1, '2023-07-10 02:20:51'),
(28, 7, 0, 4, '7', 0, 0, 2, 6, '10', 0, 1, '2023-07-19 08:46:57'),
(29, 8, 0, 3, '', 0, 0, 2, 6, '25', 0, 1, '2023-07-10 02:21:36'),
(30, 8, 0, 4, '26417', 0, 0, 2, 6, '25', 0, 1, '2023-08-14 09:30:30'),
(32, 8, 0, 3, '', 0, 0, 3, 4, '15', 0, 1, '2023-07-23 02:43:23'),
(33, 8, 0, 4, '', 0, 0, 3, 4, '15', 0, 1, '2023-07-23 02:43:23'),
(34, 14, 0, 3, '', 0, 0, 8, 0, '100', 0, 1, '2023-11-21 18:45:23'),
(35, 14, 0, 4, '', 0, 0, 8, 0, '100', 0, 1, '2023-11-21 18:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_thirdparty_vendors`
--

DROP TABLE IF EXISTS `merchant_thirdparty_vendors`;
CREATE TABLE IF NOT EXISTS `merchant_thirdparty_vendors` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `VendorName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` int NOT NULL DEFAULT '1',
  `CrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebSiteUrl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ConsumerKey` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ConsumerSecret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebSiteType` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PlatformType` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_thirdparty_vendors`
--

INSERT INTO `merchant_thirdparty_vendors` (`Id`, `VendorName`, `Status`, `CrDate`, `Type`, `WebSiteUrl`, `ConsumerKey`, `ConsumerSecret`, `WebSiteType`, `PlatformType`) VALUES
(3, 'POS', 1, '2023-07-10 08:30:55', 'Offline', '', '', '', '', 0),
(4, 'JStore', 1, '2023-09-04 09:52:34', 'Online', 'https://jstore.my', 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de', 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d', 'wordpress', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `description`) VALUES
(1, 'Dashboard', 'Dashboard'),
(2, 'My Organization', 'My Organization'),
(3, 'Appointment', 'Appointment'),
(4, 'Calendar', 'Calendar'),
(5, 'Product', 'Product'),
(6, 'Client', 'Client'),
(7, 'Vendor', 'Vendor'),
(8, 'Staff', 'Staff'),
(9, 'Privilege', 'Privilege'),
(10, 'Complaints / Request', 'Complaints / Request'),
(11, 'View Job Report', 'View Job Report'),
(12, 'Quotation', 'Quotation'),
(13, 'Summary', 'Summary'),
(14, 'Settings', 'Settings'),
(15, 'Help', 'Help'),
(16, 'Terms & Privacy', 'Terms & Privacy'),
(17, 'Invoice', 'Invoice'),
(18, 'Payslip', 'Payslip'),
(19, 'Claims', 'Claims Desc'),
(20, 'SLA Time Frame', 'SLA Time Frame'),
(22, 'Attendance', 'Attendance'),
(23, 'Project', 'Project'),
(24, 'Profit & Loss Report', 'Profit & Loss Report'),
(25, 'Recurring Invoice', 'Recurring Invoice'),
(26, 'Paid Status', 'Paid Status'),
(27, 'Purchase Order', 'Purchase Order'),
(28, 'Bill Payment', 'Bill Payment'),
(29, 'Receipt', 'Receipt'),
(30, 'Create Task', 'Create Task'),
(31, 'Download Clients Lis', 'Download Clients Excel'),
(32, 'Department', 'Department'),
(33, 'Complaint Edit', 'Complaint Edit'),
(34, 'Sharing', 'Sharing'),
(35, 'Services', 'Services'),
(36, 'Assigned Task', 'Assigned Task'),
(37, 'Incomplete', 'Incomplete'),
(38, 'Completed', 'Completed'),
(39, 'Hide Other\'s Quotati', 'Hide Other\'s Quotation '),
(40, 'Compliant Extra', 'Compliant Extra'),
(41, 'Attendance Report', 'Attendance Report'),
(42, 'Service Engineer', 'Service Engineer'),
(43, 'Staff Role', 'Staff Role'),
(44, 'Manager Role', 'Manager Role'),
(45, 'EA Form', 'EA Form'),
(46, 'Late Attendance', 'Late Attendance'),
(47, 'Leave Module', 'Leave Module'),
(48, 'Leave In-charge', 'Leave In-charge'),
(49, 'Leave Manager', 'Leave Manager'),
(50, 'New Client Pass Sent', 'On Create Client Password Sent '),
(51, 'Store Order List', 'Store Order List'),
(52, 'Store Report', 'Store Report'),
(53, 'Report Location', 'Report Location'),
(54, 'Vehicles', 'Vehicles'),
(55, 'Maintenance', 'Maintenance'),
(56, 'Trip', 'Trip'),
(57, 'Vehicles Report', 'Vehicles Report'),
(58, 'Membership', 'Membership'),
(59, 'Membership Approval', 'Membership Approval'),
(60, 'PDF Manager', 'PDF Manager'),
(61, 'Online Order', 'Online Order'),
(62, 'Professional Dev', 'Professional Dev'),
(63, 'Technical Inquiry', 'Technical Inquiry'),
(64, 'EPF Letter Approval', 'EPF Letter Approval'),
(65, 'Examination Progress', 'Examination Progress'),
(66, 'IIAM Articles', 'IIAM Articles'),
(67, 'Research Grant', 'Research Grant'),
(68, 'Certification', 'Certification'),
(69, 'Certificate eSign', 'Certificate eSign'),
(70, 'Event Manager', 'Event Manager'),
(71, 'Report Manager', 'Report Manager'),
(72, 'QAR', 'QAR'),
(73, 'Termination Process', 'Termination Process'),
(74, 'Post Member', 'Post Member'),
(75, 'Requisition', 'Requisition'),
(76, 'Recruitment', 'Recruitment'),
(77, 'Resignation', 'Resignation'),
(78, 'Employee Drive', 'Employee Drive'),
(79, 'Training and Dev', 'Training and Dev'),
(80, 'Performance Mgt', 'Performance Mgt'),
(81, 'API', 'API'),
(82, 'Account', 'Account'),
(83, 'Audit', 'Auditor'),
(84, 'Secretarial', 'Secretarial'),
(85, 'Process', 'Process'),
(86, 'File Manager', 'File Manager');

-- --------------------------------------------------------

--
-- Table structure for table `modules_new`
--

DROP TABLE IF EXISTS `modules_new`;
CREATE TABLE IF NOT EXISTS `modules_new` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules_new`
--

INSERT INTO `modules_new` (`id`, `name`, `status`) VALUES
(1, 'sales', 1),
(2, 'jobsheet', 1),
(3, 'crm', 1),
(4, 'project', 1),
(5, 'accounts', 1),
(6, 'promocode', 1),
(7, 'HRM', 1),
(8, 'FWMS', 1),
(9, 'Payroll', 1),
(10, 'Asset Management', 1),
(11, 'expenses', 1),
(12, 'contract', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publishing_activity`
--

DROP TABLE IF EXISTS `publishing_activity`;
CREATE TABLE IF NOT EXISTS `publishing_activity` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `SessionId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ItemId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ThirdPartyVenderId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `MerchantId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CityId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LocationId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SegmentId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SubSegmentId` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ActionType` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PreviousValue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NewValue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Query` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CrDate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishing_activity`
--

INSERT INTO `publishing_activity` (`Id`, `SessionId`, `ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `ActionType`, `Action`, `PreviousValue`, `NewValue`, `Query`, `CrDate`) VALUES
(1, '97843', '1', '4', '3', '5', '10', '3', '4', 'PriceInsert', 'Price Insert new price value 32', '', '32', 'INSERT INTO `merchant_items_thirdparty_pricing` (`ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `CrDate`) VALUES (1, 4, 3, 5, 10, 3, 4, 32,\'2023-07-04 07:02:39\')', '2023-07-04 07:02:39'),
(2, '97843', '1', '4', '3', '5', '10', '3', '4', 'PriceInsert', 'Price Insert new price value 35', '', '35', 'INSERT INTO `merchant_items_thirdparty_pricing` (`ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `CrDate`) VALUES (1, 4, 3, 5, 10, 3, 4, 35,\'2023-07-04 07:05:26\')', '2023-07-04 07:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

DROP TABLE IF EXISTS `scheduler`;
CREATE TABLE IF NOT EXISTS `scheduler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `run_scheduler_expiry_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module` int NOT NULL,
  `scheduler_on` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `minutes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Schdeuleno_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `run_scheduler_expiry_date`, `module`, `scheduler_on`, `minutes`, `hours`, `days`, `month`, `day`, `Schdeuleno_days`, `email_to`, `status`, `created_at`) VALUES
(1, 'yes', 8, '1,2', '', '', '30', '', '', '', '1,2,3', 0, '2023-09-25'),
(7, 'yes', 12, '3', '', '', '30', '', '', '', '1,2', 1, '2023-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `sidebarhierarchy`
--

DROP TABLE IF EXISTS `sidebarhierarchy`;
CREATE TABLE IF NOT EXISTS `sidebarhierarchy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `child_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `child_id` (`child_id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sidebarhierarchy`
--

INSERT INTO `sidebarhierarchy` (`id`, `parent_id`, `child_id`) VALUES
(1, 2, 3),
(2, 3, 4),
(3, 3, 5),
(4, 2, 6),
(5, 6, 8),
(6, 6, 7),
(7, 6, 9),
(8, 2, 10),
(9, 10, 11),
(10, 10, 12),
(11, 13, 14),
(12, 2, 13),
(13, 13, 15),
(14, 2, 16),
(15, 17, 18),
(16, 18, 19),
(17, 18, 20),
(18, 17, 21),
(19, 17, 22),
(20, 17, 23),
(21, 194, 24),
(22, 24, 25),
(23, 24, 26),
(24, 194, 27),
(25, 27, 28),
(26, 27, 29),
(27, 194, 30),
(28, 30, 31),
(29, 30, 32),
(30, 17, 33),
(31, 33, 34),
(32, 33, 35),
(33, 36, 37),
(34, 37, 38),
(35, 37, 39),
(36, 36, 40),
(37, 36, 41),
(172, 201, 206),
(39, 43, 44),
(40, 44, 45),
(41, 44, 46),
(42, 43, 47),
(43, 43, 48),
(44, 48, 49),
(45, 48, 50),
(46, 51, 52),
(47, 51, 53),
(48, 51, 54),
(49, 55, 56),
(50, 56, 57),
(51, 56, 58),
(52, 55, 59),
(53, 60, 61),
(54, 61, 62),
(55, 61, 63),
(56, 61, 64),
(57, 60, 65),
(58, 65, 66),
(59, 65, 67),
(60, 65, 68),
(61, 65, 69),
(62, 65, 70),
(63, 65, 71),
(64, 72, 73),
(65, 73, 74),
(66, 73, 75),
(67, 76, 77),
(68, 76, 78),
(69, 78, 79),
(70, 78, 80),
(71, 78, 81),
(72, 78, 82),
(73, 78, 83),
(74, 76, 84),
(75, 84, 85),
(76, 84, 86),
(77, 84, 87),
(78, 84, 88),
(79, 84, 89),
(80, 84, 90),
(81, 84, 91),
(82, 76, 92),
(83, 92, 93),
(84, 92, 94),
(85, 92, 95),
(86, 92, 96),
(87, 92, 97),
(88, 92, 98),
(89, 92, 99),
(90, 100, 101),
(91, 100, 102),
(92, 100, 103),
(93, 104, 105),
(94, 104, 106),
(95, 104, 107),
(96, 104, 108),
(97, 104, 109),
(98, 110, 111),
(99, 111, 112),
(100, 111, 113),
(101, 201, 114),
(102, 201, 115),
(103, 201, 116),
(104, 201, 117),
(105, 201, 118),
(106, 110, 119),
(107, 110, 120),
(108, 121, 122),
(109, 121, 123),
(110, 121, 124),
(111, 125, 126),
(112, 125, 127),
(113, 128, 129),
(114, 128, 130),
(115, 128, 131),
(116, 128, 132),
(117, 128, 133),
(118, 128, 134),
(119, 128, 135),
(120, 136, 137),
(121, 136, 138),
(122, 136, 139),
(123, 136, 140),
(124, 141, 142),
(125, 141, 143),
(126, 141, 144),
(127, 141, 145),
(128, 141, 146),
(129, 147, 148),
(130, 147, 149),
(131, 147, 150),
(132, 151, 152),
(133, 151, 153),
(134, 151, 154),
(135, 151, 156),
(136, 1, 161),
(137, 1, 163),
(138, 1, 162),
(139, 1, 160),
(140, 2, 164),
(141, 17, 165),
(142, 36, 166),
(143, 43, 167),
(144, 141, 170),
(145, 168, 173),
(146, 168, 174),
(147, 168, 175),
(148, 168, 176),
(149, 168, 177),
(150, 177, 178),
(151, 177, 179),
(152, 177, 180),
(153, 168, 181),
(154, 168, 182),
(155, 168, 183),
(156, 168, 184),
(157, 181, 185),
(158, 182, 186),
(159, 183, 187),
(160, 194, 188),
(161, 188, 189),
(162, 188, 190),
(163, 194, 191),
(164, 191, 192),
(165, 17, 193),
(166, 17, 195),
(167, 17, 196),
(168, 17, 197),
(169, 136, 199),
(170, 136, 200),
(171, 201, 204),
(173, 36, 207);

-- --------------------------------------------------------

--
-- Table structure for table `sidebaritems`
--

DROP TABLE IF EXISTS `sidebaritems`;
CREATE TABLE IF NOT EXISTS `sidebaritems` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `permissions` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` enum('Sidebar','Subheading','Child Heading') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_general_ci NOT NULL,
  `display_order` int NOT NULL,
  `module_type` text COLLATE utf8mb4_general_ci NOT NULL,
  `r_1` int NOT NULL DEFAULT '0',
  `r_2` int NOT NULL DEFAULT '0',
  `r_3` int NOT NULL DEFAULT '0',
  `r_4` int NOT NULL DEFAULT '0',
  `r_5` int NOT NULL DEFAULT '0',
  `r_6` int NOT NULL DEFAULT '0',
  `r_7` int NOT NULL DEFAULT '0',
  `r_8` int NOT NULL DEFAULT '0',
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscription_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sidebaritems`
--

INSERT INTO `sidebaritems` (`id`, `parent_id`, `title`, `url`, `icon`, `permissions`, `type`, `status`, `display_order`, `module_type`, `r_1`, `r_2`, `r_3`, `r_4`, `r_5`, `r_6`, `r_7`, `r_8`, `cr_date`, `subscription_status`) VALUES
(1, 0, 'Dashboard', 'dashboard', 'icon-speedometer', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 05:48:10', 1),
(2, 0, 'Sales', ' ', 'icon-basket-loaded', NULL, 'Sidebar', 'Active', 2, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:49:41', 1),
(3, 2, 'Quotes', ' ', 'icon-call-out', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:51:50', 0),
(4, 0, 'New Quote', 'quote/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:55:09', 0),
(5, 0, 'Manage Quotes', 'quote', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:55:57', 0),
(6, 2, 'Invoices', ' ', 'icon-basket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:57:20', 0),
(7, 6, 'New Invoice', 'invoices/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 06:01:11', 0),
(8, 6, 'Manage Invoices', 'invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 06:02:00', 0),
(9, 6, 'Peppol Invoices', 'invoices/peppol_invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:17:55', 0),
(10, 2, 'Pos Invoices', '', 'icon-paper-plane', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:19:58', 0),
(11, 10, 'New Pos Invoice', 'pos_invoices/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:23:16', 0),
(12, 10, 'Manage Pos Invoices', 'pos_invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:23:56', 0),
(13, 2, 'Subscriptions', '', 'ft-radio', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:25:41', 0),
(14, 13, 'New Subscription', 'subscriptions/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:26:52', 0),
(15, 13, 'Subscriptions', 'subscriptions', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:28:24', 0),
(16, 2, 'Credit Notes', 'stockreturn/creditnotes', 'icon-screen-tablet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:29:28', 0),
(17, 0, 'Inventory Management', '', 'ft-layers', NULL, 'Sidebar', 'Active', 3, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:32:59', 1),
(18, 17, 'Items Manager', '', 'ft-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:35:39', 0),
(19, 18, 'New Product', 'products/add', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:36:41', 0),
(20, 18, 'Manage Products', 'products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:37:29', 0),
(21, 17, 'Product Categories', 'productcategory', 'ft-umbrella', NULL, 'Subheading', 'Active', 2, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:38:39', 0),
(22, 17, 'WareHouses', 'productcategory/warehouse', 'ft-sliders', NULL, 'Subheading', 'Active', 4, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:41:33', 0),
(23, 17, 'Stock Transfer', 'products/stock_transfer', 'ft-wind', NULL, 'Subheading', 'Active', 5, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:42:07', 0),
(24, 194, 'Purchase Order', '', 'icon-handbag', NULL, 'Subheading', 'Active', 2, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:42:40', 0),
(25, 24, 'New Order', 'purchase/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:43:16', 0),
(26, 24, 'Manage Orders', 'purchase', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:43:50', 0),
(27, 194, 'Stock Return', '', 'icon-puzzle', NULL, 'Subheading', 'Active', 5, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:48:39', 0),
(28, 27, 'Supplier Records', 'stockreturn', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:49:12', 0),
(29, 27, 'Customer Records', 'stockreturn/customer', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:02', 0),
(30, 194, 'Suppliers', '', 'ft-target', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:22', 0),
(31, 30, 'New Supplier', 'supplier/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:49', 0),
(32, 30, 'Manage Suppliers', 'supplier', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:51:23', 0),
(33, 17, 'Products Label', '', 'fa fa-barcode', NULL, 'Subheading', 'Active', 3, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:51:49', 0),
(34, 33, 'Custome Label', 'products/custom_label', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:52:43', 0),
(35, 33, 'Standard Label', 'products/standard_label', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:53:06', 0),
(36, 0, 'Job Sheet', '', 'icon-diamond', NULL, 'Sidebar', 'Active', 5, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 07:00:22', 1),
(37, 36, 'Task Manager', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:01:47', 0),
(38, 37, 'Create Task', 'jobsheets/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:02:54', 0),
(39, 37, 'View Task', 'jobsheets', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:03:34', 0),
(40, 36, 'Reports', 'jobsheets/reports', 'ft-sliders', NULL, 'Subheading', 'Active', 20, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:04:47', 0),
(41, 36, 'My Task', 'jobsheets/myjobs', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 07:05:13', 0),
(206, 201, 'Attendance KPI', '/employee/attendreport_new', '', NULL, 'Subheading', 'Active', 50, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2024-02-05 05:55:13', 1),
(43, 0, 'CRM', '', 'ft-users', NULL, 'Sidebar', 'Active', 6, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:10:18', 1),
(44, 43, 'Clients', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:11:20', 0),
(45, 44, 'New Client', 'customers/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:12:59', 0),
(46, 44, 'Manage Clients', 'customers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:13:25', 0),
(47, 43, 'Client groups', 'clientgroup', 'icon-grid', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:14:32', 0),
(48, 43, 'Support Tickets', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:15:05', 0),
(49, 48, 'UnSolved', 'tickets/?filter=unsolved', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:15:56', 0),
(50, 48, 'Manage Tickets', 'tickets', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:16:48', 0),
(51, 0, 'File Manager', '', 'fa fa-folder-o', NULL, 'Sidebar', 'Active', 7, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:17:54', 1),
(52, 51, 'My Drive', 'filemanager', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:19:01', 0),
(53, 51, 'Shared Folders', 'filemanager/sharedfolders', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:19:33', 0),
(54, 51, 'Shared Files', 'filemanager/sharedfiles', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:20:04', 0),
(55, 0, 'Project', '', 'icon-briefcase', NULL, 'Sidebar', 'Active', 8, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:34:39', 1),
(56, 55, 'Project Management', '', 'icon-calendar', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:36:52', 0),
(57, 56, 'New Project', 'projects/addproject', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:37:51', 0),
(58, 56, 'Manage Projects', 'projects', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:38:22', 0),
(59, 55, 'To Do List', 'tools/todo', 'icon-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:40:24', 0),
(60, 0, 'Accounts', '', 'icon-calculator', NULL, 'Sidebar', 'Active', 9, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:52:52', 1),
(61, 60, 'Accounts', '', 'icon-book-open', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:54:04', 0),
(62, 61, 'Manage Accounts', 'accounts', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:55:11', 0),
(63, 61, 'Balance Sheet', 'accounts/balancesheet', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:56:02', 0),
(64, 61, 'Account Statements', 'reports/accountstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:56:43', 0),
(65, 60, 'Transactions', '', 'icon-wallet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:57:14', 0),
(66, 65, 'View Transactions', 'transactions', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:02:10', 0),
(67, 65, 'New Transaction', 'transactions/add', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:02:41', 0),
(68, 65, 'New Transfer', 'transactions/transfer', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:03:26', 0),
(69, 65, 'Income', 'transactions/income', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:04:11', 0),
(70, 65, 'Expense', 'transactions/expense', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:04:35', 0),
(71, 65, 'Client Transactions', 'customers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:05:16', 0),
(72, 0, 'Promo Codes', '', 'icon-trophy', NULL, 'Sidebar', 'Active', 10, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:18:56', 1),
(73, 72, 'Coupons', '', 'icon-trophy', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:20:17', 0),
(74, 73, 'New Promo', 'promo/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:20:51', 0),
(75, 73, 'Manage Promo', 'promo', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:21:45', 0),
(76, 0, 'Data & Reports', '', 'icon-pie-chart', NULL, 'Sidebar', 'Active', 11, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:23:45', 1),
(77, 76, 'Business Registers', '', 'icon-eyeglasses', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:26:30', 0),
(78, 76, 'Statements', '', 'icon-doc', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:27:12', 0),
(79, 78, 'Account Statements', 'reports/accountstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:28:13', 0),
(80, 78, 'Customer Account Statements', 'reports/customerstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:28:54', 0),
(81, 78, 'Supplier Account Statement', 'reports/supplierstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:31:35', 0),
(82, 78, 'Tax Statements', 'reports/taxstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:32:05', 0),
(83, 78, 'Product Sales Reports', 'pos_invoices/extended', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:32:50', 0),
(84, 76, 'Graphical Reports', '', 'icon-bar-chart', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:34:55', 0),
(85, 84, 'Product Categories', 'chart/product_cat', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:36:44', 0),
(86, 84, 'Trending Products', 'chart/trending_products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:37:16', 0),
(87, 84, 'Profit', 'chart/profit', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:37:53', 0),
(88, 84, 'Top Customers', 'chart/topcustomers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:38:18', 0),
(89, 84, 'Income vs Expenses', 'chart/incvsexp', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:39:45', 0),
(90, 84, 'Income', 'chart/income', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:40:18', 0),
(91, 84, 'Expenses', 'chart/expenses', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:40:56', 0),
(92, 76, 'Summary & Report', '', 'icon-bulb', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:41:41', 0),
(93, 92, 'Statistics', 'reports/statistics', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:38:23', 0),
(94, 92, 'Profit', 'reports/profitstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:39:27', 0),
(95, 92, 'Calculate Income', 'reports/incomestatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:40:11', 0),
(96, 92, 'Calculate Expenses', 'reports/expensestatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:41:06', 0),
(97, 92, 'Sales', 'reports/sales', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:41:39', 0),
(98, 92, 'Products', 'reports/products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:42:32', 0),
(99, 92, 'Employee Sales Commission', 'reports/commission', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:43:13', 0),
(100, 0, 'Miscellaneous', '', 'icon-note', NULL, 'Sidebar', 'Active', 12, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:45:07', 1),
(101, 100, 'Notes', 'tools/notes', 'icon-note', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:46:21', 0),
(102, 100, 'Calendar', 'events', 'icon-calendar', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:46:49', 0),
(103, 100, 'Documents', 'tools/documents', 'icon-doc', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:48:25', 0),
(104, 0, 'E-Commerce', '', 'icon-basket', NULL, 'Sidebar', 'Active', 13, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:05:53', 1),
(105, 104, 'Online Platforms', 'ecommerce/online_platforms', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:02', 0),
(106, 104, 'Categories', 'ecommerce/categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:30', 0),
(107, 104, 'Sub Categories', 'ecommerce/sub_categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:54', 0),
(108, 104, 'Publishing', 'ecommerce/publishing', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:08:16', 0),
(109, 104, 'Analytics', 'ecommerce/analytics', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:08:46', 0),
(110, 0, 'Human Resources', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 14, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:09:37', 1),
(111, 110, 'Employees', '', 'ft-users', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:10:22', 0),
(112, 111, 'Employees List', 'employee', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:11:27', 0),
(113, 111, 'Salaries', 'employee/salaries', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:11:53', 0),
(114, 201, 'Attendance', 'employee/attendances', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:12:34', 0),
(115, 201, 'Attendance Report', 'employee/attendreport', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:13:07', 0),
(116, 201, 'Break Setting', 'employee/attendbreaksetting', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:13:37', 0),
(117, 201, 'Break Status', 'employee/attendview', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:14:17', 0),
(118, 201, 'Holidays', 'employee/holidays', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:14:56', 0),
(119, 110, 'Departments', 'employee/departments', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:15:36', 0),
(120, 110, 'Roles', 'employee/roles', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:16:03', 0),
(121, 0, 'FWMS', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 15, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:27:25', 1),
(122, 121, 'Clients', 'fwms/fwmsclients', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:28:17', 0),
(123, 121, 'Employees', 'fwms/fwmsemployees', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:28:51', 0),
(124, 121, 'Report', 'fwms/fwmsreport', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:29:24', 0),
(125, 0, 'Scheduler', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 16, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:30:04', 1),
(126, 125, 'Schedule', 'scheduler/schedule', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:30:40', 0),
(127, 125, 'Schedule List', 'scheduler/scheduleList', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:31:15', 0),
(128, 0, 'Asset Management', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 17, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:31:39', 1),
(129, 128, 'View Assets', 'asset/assetlist', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:32:19', 0),
(130, 128, 'Asset History', 'asset/asset_history', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:32:59', 0),
(131, 128, 'Asset Category', 'asset/assetcategory', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:33:28', 0),
(132, 128, 'Asset Sub Category', 'asset/assetsubcategory', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:33:55', 0),
(133, 128, 'Asset Status', 'asset/assetStatus', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:34:21', 0),
(134, 128, 'Comments', 'asset/comments', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:34:44', 0),
(135, 128, 'Print BarCode', 'asset/printBarcode', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:35:14', 0),
(136, 0, 'Payroll', '', 'fa fa-money', NULL, 'Sidebar', 'Active', 18, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:35:29', 1),
(137, 136, 'Settings', 'payroll/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:44:42', 0),
(138, 136, 'Generate Pay slip', 'payroll/payroll', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:45:25', 0),
(139, 136, 'View Payslips', 'payroll/viewpaySlip', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:46:14', 0),
(140, 136, 'Payroll Report', 'payroll/payrollReport', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:46:42', 0),
(141, 0, 'Claims', '', 'fa fa-money', NULL, 'Sidebar', 'Active', 19, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:47:28', 1),
(142, 141, 'Add Claims', 'expenses/add', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:47:52', 0),
(143, 141, 'Claims', 'expenses', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:48:27', 0),
(144, 141, 'Reports', 'expenses/reports', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:49:14', 0),
(145, 141, 'Add Category', 'expenses/createcat', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:50:07', 0),
(146, 141, 'Category List', 'expenses/categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:50:34', 0),
(147, 0, 'Settings', '', 'icon-settings', NULL, 'Sidebar', 'Active', 20, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:52:11', 1),
(148, 147, 'Permissions', 'employee/permissions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:57:01', 0),
(149, 147, 'Dashboard Settings', 'dashboard/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:57:29', 0),
(150, 147, 'Subscribe Settings', 'dashboard/subscribe', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:58:06', 0),
(151, 0, 'Modules', '', 'icon-power', NULL, 'Sidebar', 'Active', 21, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:06:51', 1),
(152, 151, 'Modules List', 'modules/modules_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:09:38', 0),
(153, 151, 'Add Module', 'modules/add', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:10:54', 0),
(154, 151, 'Module Permissions', 'modules/module_permissions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:12:08', 0),
(156, 151, 'Subscriptions', 'modules/subscriptions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-02 05:36:07', 0),
(157, 0, 'Delete', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:37:35', 1),
(158, 0, 'Reports', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:38:31', 1),
(159, 0, 'Edit', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:40:28', 1),
(160, 1, 'Sales Dashboard', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:28:35', 0),
(161, 1, 'FWMS Dashboard', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:28:58', 0),
(162, 1, 'Payroll Dashboard Report', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:29:30', 0),
(163, 1, 'JobSheet Dashboard Report', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:29:50', 0),
(164, 2, 'Sales Landing Page', 'invoices', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 1, 0, 0, 0, 0, 0, 0, '2023-10-03 05:26:35', 0),
(165, 17, 'Stock Landing Page', 'products', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:27:10', 0),
(166, 36, 'JobSheet Landing Page', 'jobsheets', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:28:28', 0),
(167, 43, 'CRM Landing Page', 'customers', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:29:22', 0),
(168, 0, 'Digital Marketing', '', 'icon-basket-loaded', NULL, 'Sidebar', 'Active', 22, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-03 09:32:03', 1),
(173, 168, 'Customer List', 'digitalmarketing/customers_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:14:46', 0),
(169, 0, 'Contract Management', 'contract', 'ft-file-text', NULL, 'Sidebar', 'Active', 23, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:29:09', 1),
(170, 141, 'Claim Landing Page ', 'expenses', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-04 03:35:31', 0),
(171, 0, 'Payroll Landing Page ', 'viewpaySlip', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:37:38', 1),
(172, 0, 'Attendance Landing Page ', 'employee/attendances', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:48:05', 1),
(174, 168, 'Contact Management', 'digitalmarketing/contacts', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:16:20', 0),
(175, 168, 'List Management', 'digitalmarketing/lists', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:18:38', 0),
(176, 168, 'Folder Management', 'digitalmarketing/folders', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:22:23', 0),
(177, 168, 'Transactional', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:23:14', 0),
(178, 177, 'Emails', 'digitalmarketing/transactions/email', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:24:46', 0),
(179, 177, 'SMS', 'digitalmarketing/transactions/sms', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:25:11', 0),
(180, 177, 'Whatsapp', 'digitalmarketing/transactions/whatsapp', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:25:37', 0),
(181, 168, 'SMS Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:26:31', 0),
(182, 168, 'Email Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:26:58', 0),
(183, 168, 'Whatsapp Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:27:25', 0),
(184, 168, 'Settings', 'digitalmarketing/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:28:36', 0),
(185, 181, 'Campaigns ', 'digitalmarketing/sms_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:29:55', 0),
(186, 182, 'Campaigns', 'digitalmarketing/email_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:31:29', 0),
(187, 183, 'Campaigns ', 'https://erp-dev.jsuitecloud.com/digitalmarketing/whatsapp_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:32:46', 0),
(194, 0, 'Purchasing', '', 'ft-sliders', NULL, 'Sidebar', 'Active', 4, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-21 14:42:58', 1),
(188, 194, 'Customer DO', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 4, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:54:56', 1),
(189, 188, 'Create Delivery Order', 'deliveryorder/create_delivery_order', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:56:07', 1),
(190, 188, 'Manage Delivery Orders', 'deliveryorder/list', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:56:47', 1),
(191, 194, 'Supplier DO', 'deliveryorder/recieved_list', 'ft-umbrella', NULL, 'Subheading', 'Active', 3, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 14:05:50', 1),
(192, 191, 'Manage Delivery Orders', 'deliveryorder/recieved_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 14:10:00', 1),
(193, 17, 'Product Details', 'products/expire_products_list', 'ft-list', NULL, 'Subheading', 'Active', 6, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 20:08:49', 1),
(195, 17, 'Expiry Products', 'products/expiry_product_variations_list', 'ft-users', NULL, 'Subheading', 'Active', 10, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-22 08:58:06', 1),
(196, 17, 'Product Expiry By DO', 'products/detailed_product_expiry_list', 'ft-list', NULL, 'Subheading', 'Active', 16, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-27 17:35:36', 1),
(197, 17, 'Stock Balance', 'products/detailed_stock_balance', 'icon-bulb', NULL, 'Subheading', 'Active', 12, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-28 02:50:31', 1),
(198, 0, 'Digital Signature', 'digitalsignature', 'icon-trophy', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-08 11:43:08', 1),
(199, 136, 'Bulk Payroll', 'payroll/bulk_payroll', 'ft-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-11 15:07:07', 1),
(200, 136, 'Import PaySlip', 'payroll/ImportPaySlip', 'icon-wallet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-11 15:09:22', 1),
(201, 0, 'Attendance', '', 'ft-users', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-18 03:47:19', 1),
(202, 0, 'Vehicles', '/vehicles', 'ft-wind', NULL, 'Sidebar', 'Active', 49, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2024-01-21 04:09:29', 1),
(203, 0, 'Office Forms', '/officeforms', 'ft-umbrella', NULL, 'Sidebar', 'Active', 50, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2024-01-21 04:10:26', 1),
(204, 201, 'Attendance Settings', '/employee/attendance_settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2024-01-24 08:02:00', 1),
(205, 0, 'Do Image Upload', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 0, 0, 0, 0, 0, 0, 0, '2024-01-31 18:59:20', 1),
(207, 36, 'JobSheet KPI', 'jobsheets/jobsheet_report_new', '', NULL, 'Subheading', 'Active', 50, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2024-02-05 05:57:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `univarsal_api`
--

DROP TABLE IF EXISTS `univarsal_api`;
CREATE TABLE IF NOT EXISTS `univarsal_api` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `key1` varchar(255) DEFAULT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `other` text,
  `active` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `univarsal_api`
--

INSERT INTO `univarsal_api` (`id`, `name`, `key1`, `key2`, `url`, `method`, `other`, `active`) VALUES
(1, 'Goo.gl URL Shortner', 'yourkey', '0', '0', '0', '0', 0),
(2, 'Twilio SMS API', 'ac', 'key', '+11234567', '0', '0', 1),
(3, 'Company Support', '1', '1', 'support@gmail.com', NULL, '<p>Your footer</p>', 1),
(4, 'Currency', '.', ',', '2', 'l', '', 0),
(5, 'Exchange', 'key1v', 'key2', 'USD', NULL, NULL, 0),
(6, 'New Invoice Notification', '[{Company}] Invoice #{BillNumber} Generated', NULL, NULL, NULL, '<p>Dear\n            Client,\r\n</p><p>We are contacting you in regard to a payment received for invoice # {BillNumber} that has\n            been created on your account. You may find the invoice with below link.\r\n\r\nView\n            Invoice\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind\n            Regards,\r\nTeam\r\n{CompanyDetails}</p>', NULL),
(7, 'Invoice Payment Reminder', '[{Company}] Invoice #{BillNumber} Payment Reminder', NULL, NULL, NULL, '<p>Dear\n            Client,</p><p>We are contacting you in regard to a payment reminder of invoice # {BillNumber} that has been\n            created on your account. You may find the invoice with below link. Please pay the balance of {Amount} due by\n            {DueDate}.</p><p>\r\n\r\n<b>View Invoice</b></p><p><span style=\"font-size: 1rem;\">{URL}\r\n</span></p><p>\n            <span style=\"font-size: 1rem;\">\r\nWe look forward to conducting future business with you.</span></p><p>\n            <span style=\"font-size: 1rem;\">\r\n\r\nKind Regards,\r\n</span></p><p><span style=\"font-size: 1rem;\">\r\nTeam\r\n</span>\n        </p><p><span style=\"font-size: 1rem;\">\r\n{CompanyDetails}</span></p>', NULL),
(8, 'Invoice Refund Proceeded', '{Company} Invoice #{BillNumber} Refund Proceeded', NULL, NULL, NULL, '<p>Dear\n            Client,</p><p>\r\nWe are contacting you in regard to a refund request processed for invoice # {BillNumber}\n            that has been created on your account. You may find the invoice with below link. Please pay the balance of\n            {Amount} by {DueDate}.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to\n            conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\n            \r\nTeam\r\n\r\n{CompanyDetails}</p>', NULL),
(9, 'Invoice payment Received', '{Company} Payment Received for Invoice #{BillNumber}', NULL, NULL, NULL, '<p>\n            Dear Client,\n</p><p>We are contacting you in regard to a payment received for invoice # {BillNumber} that\n            has been created on your account. You can find the invoice with below link.\n</p><p>\nView Invoice</p>\n        <p>\n{URL}\n</p><p>\nWe look forward to conducting future business with you.\n</p><p>\nKind\n            Regards,\n</p><p>\nTeam\n</p><p>\n{CompanyDetails}</p>', NULL),
(10, 'Invoice Overdue Notice', '{Company} Invoice #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear\n            Client,</p><p>\r\nWe are contacting you in regard to an Overdue Notice for invoice # {BillNumber} that has\n            been created on your account. You may find the invoice with below link.\r\nPlease pay the balance of\n            {Amount} due by {DueDate}.\r\n</p><p>View Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to\n            conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam</p><p>\n            \r\n\r\n{CompanyDetails}</p>', NULL),
(11, 'Quote Proposal', '{Company} Quote #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear Client,</p>\n        <p>\r\nWe are contacting you in regard to a new quote # {BillNumber} that has been created on your account. You\n            may find the quote with below link.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward\n            to conducting future business with you.</p><p>\r\n\r\nKind Regards,</p><p>\r\n\r\nTeam</p><p>\n            \r\n\r\n{CompanyDetails}</p>', NULL),
(12, 'Purchase Order Request', '{Company} Purchase Order #{BillNumber} Requested', NULL, NULL, NULL, '<p>Dear\n            Client,\r\n</p><p>We are contacting you in regard to a new purchase # {BillNumber} that has been requested\n            on your account. You may find the order with below link. </p><p>\r\n\r\nView Invoice\r\n</p><p>{URL}</p><p>\n            \r\n\r\nWe look forward to conducting future business with you.</p><p>\r\n\r\nKind Regards,\r\n</p><p>\n            \r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(13, 'Stock Return Mail', '{Company} New purchase return # {BillNumber}', NULL, NULL, NULL, 'Dear Client,\r\n\r\nWe are contacting you in regard to a new purchase return # {BillNumber} that has been requested on your account. You may find the order with below link.\r\n\r\nView Invoice\r\n\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind Regards,\r\n\r\nTeam\r\n\r\n{CompanyDetails}', NULL),
(14, 'Customer Registration', '{Company}  Customer Registration - {NAME}', NULL, NULL, NULL, 'Dear Customer,\r\nThank You for registration, please confirm the registration by the following URL {REG_URL}\r\nRegards', NULL),
(15, 'Â Customer Password Reset', '{Company} Â Customer Password Reset- {NAME}', NULL, NULL, NULL, 'Dear Customer,\r\nPlease reset the password by the following URL {RESET_URL}\r\nRegards', NULL),
(16, 'Customer Registration by Employee', '{Company} Â Customer Registration - {NAME}', '0', '0', '0', 'Dear Customer,\r\nThank You for registration.\r\nLogin URL: {URL}\r\nLogin Email: {EMAIL}\r\nPassword: {PASSWORD}\r\n\r\nRegards\r\n{CompanyDetails}', 0),
(30, 'New Invoice Notification', NULL, NULL, NULL, NULL, 'Dear Customer, new invoice  # {BillNumber} generated. {URL} Regards', NULL),
(31, 'Invoice Payment Reminder', NULL, NULL, NULL, NULL, 'Dear Customer, Please make payment of invoice  # {BillNumber}. {URL} Regards', NULL),
(32, 'Invoice Refund Proceeded', NULL, NULL, NULL, NULL, 'Dear Customer, Refund generated of invoice # {BillNumber}. {URL} Regards', NULL),
(33, 'Invoice payment Received', NULL, NULL, NULL, NULL, 'Dear Customer, Payment received of invoice # {BillNumber}. {URL} Regards', NULL),
(34, 'Invoice Overdue Notice', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer,Payment is overdue of invoice # {BillNumber}. {URL} Regards', NULL),
(35, 'Quote Proposal', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer, a quote created for you # {BillNumber}. {URL} Regards', NULL),
(36, 'Purchase Order Request', NULL, NULL, NULL, NULL, 'Dear Customer, Dear, a purchased order for you # {BillNumber}. {URL} Regards', NULL),
(51, 'QT#', 'PO#', 'SUB#', 'SR#', 'TRN#', 'SRN#', 1),
(52, 'ThermalPrint', '0', NULL, NULL, NULL, 'POS#', 0),
(53, 'ConfPort', 'Public Key', '0', 'Private Key', NULL, NULL, 1),
(54, 'online_payment', '1', 'USD', '1', '1', NULL, 1),
(55, 'CronJob', '99293768', 'rec_email', 'email', 'rec_due', 'recemail', NULL),
(56, 'Auto Email SMS', '0', '0', NULL, NULL, NULL, NULL),
(60, 'Warehouse', '1', NULL, NULL, NULL, NULL, NULL),
(61, 'Discount & Shipping', '%', '10.00', 'incl', NULL, '% Discount After TAX', NULL),
(62, 'AutoAttendance', '1', '0', '0', '0', '0', 1),
(63, 'Zero Stock Billing', '1', '0', '0', '0', '0', 0),
(64, 'FrontEndSection', '1', '0', '1', '0', '1', 0),
(65, 'Dual Entry', '0', '1', '0', '0', '0', 0),
(66, 'Email Alert', '1', '0', 'sample@email.com', '0', '', 0),
(67, 'billing_settings', '0', '0', NULL, NULL, NULL, NULL),
(69, 'pos_settings', '1', NULL, NULL, NULL, NULL, NULL),
(70, 'DB-B-150', '4a99003dd3aa27b87fabfa153f1ab06a2ff08c3d', NULL, NULL, NULL, NULL, NULL),
(71, 'Contract Notification', '[{Company}] Contract #{BillNumber} Generated', NULL, NULL, NULL, '<p>Dear\n            Client,\n</p><p>We are reaching out to you regarding Contract # {BillNumber}, which has been created and is now being shared with you for your electronic signature. You can access the contract through the link provided below.\n\nView\n            Contract\n{URL}\n\nWe look forward to conducting future business with you.\n\nKind\n            Regards,\nTeam\n{CompanyDetails}</p>', NULL),
(72, 'Digital Signature Notification', 'Digital Signature #{BillNumber} Generated', NULL, NULL, NULL, '<p>Dear\r\n            Client,\r\n</p><p>We are reaching out to you regarding Digital Signature # {BillNumber}, which has been created and is now being shared with you for your electronic signature. You can access the contract through the link provided below.\r\n\r\nView\r\n            Document\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind\r\n            Regards,\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `lang` varchar(25) NOT NULL DEFAULT 'english',
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`, `cid`, `lang`, `code`) VALUES
(1, '1', NULL, 'active', '0', 'Shafeek Ajmal', '$2y$10$2Y6JwF1AE0r9PXzQ5ESoYOZb9n.jtOoIyCS2t.3tnwl2pDrh78NCK', 'shafee@gmail.com', 'cutsm_upl_1678713658.jpg', 'Member', 1, 'english', NULL),
(6, '1', NULL, 'active', '0', 'Jsoftsolution', '$2y$10$FwODtrQ3f9itfs744JvfWeZWvwWBPNv/.KDZC1oD9rVfT/SdLxCHq', 'shafeekajmal@hotmail.com', NULL, 'Member', 10, 'english', NULL),
(7, '1', NULL, 'active', '0', 'Raj', '$2y$10$0EaFyOFB2483GlFX9HMeuOHRGPmu6im62vW2A3ZkW82x20RHqUFQ.', 'hariinraj29@gmail.com', NULL, 'Member', 11, '', NULL),
(8, '1', NULL, 'active', '0', 'testing1', '$2y$10$M7yFesvFQ2F6fmfGbwFLeOJgeqFQEuPO.JldlYLalC8BHQukCcYSq', 'testing1@yahoo.com', NULL, 'Member', 12, '', NULL),
(9, '1', NULL, 'active', '0', 'Testing2', '$2y$10$FI8q5LKHxxLHcAah6ZTPaOPUGD/w1L3X2Qi7QaV9H5uqmkbCnCs/C', 'testingjsoft@gmail.com', NULL, 'Member', 13, '', NULL),
(10, '1', NULL, 'active', '0', 'udhayaraja', '$2y$10$FwODtrQ3f9itfs744JvfWeZWvwWBPNv/.KDZC1oD9rVfT/SdLxCHq', 'udhayase@gmail.com', NULL, 'Member', 14, 'english', NULL),
(11, '1', NULL, 'active', '0', 'JSOFT SOLUTION SDN BHD', '$2y$10$BjyDHP8vfM8DFCLhB3wZh.AsTIWPMyarz9bURnIMiMnTePw/NEzFi', 'krish@jsoftsolution.com.my', NULL, 'Member', 25, 'english', NULL),
(12, '1', NULL, 'active', '0', 'testinternational', '$2y$10$pH.bnRP8vPG4ZskB34vRVej20bECoNtI2jmNl1L0wRUTPoNuqp/tC', 'testint@gmail.com', NULL, 'Member', 26, 'english', NULL),
(13, '1', NULL, 'active', '0', 'testcompany', '$2y$10$JK3qgYiABlx4j5kXk5RUY.ofjhbiYVlmg1IiWyhrudoNcdjdWZFCm', 'udhyay@gmail.com', NULL, 'Member', 27, 'english', NULL),
(14, '1', NULL, 'active', '0', 'John', '$2y$10$wttYhINTjaIgcw2WDyesYOPiIGXXxxPM6V4wTGmsUNrhix33Veb4K', 'john@gmail,com', NULL, 'Member', 28, 'english', NULL),
(16, '1', NULL, 'active', '0', 'DEV Sdn Bhd', '$2y$10$vON9Bvy4Pk.XDF4oZ75toevGWQji/cCOGdmX8uAFQhz8Sy7T70uF6', 'peter@gmail.com', NULL, 'Member', 30, 'english', NULL),
(17, '1', NULL, 'active', '0', 'testtoday', '$2y$10$iOBUpsOdiKXsltpfwK28Oevag7rsAv4n2eRWes4hclpRvOiSNESCm', 'test123@gmail.com', NULL, 'Member', 31, 'english', NULL),
(18, '1', NULL, 'active', '0', 'sample', '$2y$10$P15AbTzvl0Wj9vo5aWzL..sINbac04VhPzXqaAvfJhIzA0591Uzpq', 'sample@gmail.com', NULL, 'Member', 32, 'english', NULL),
(19, '1', NULL, 'active', '0', 'puteri ', '$2y$10$P6dWOISWFGtYfby9jGPG8uCzmG6jVbipq4Ihzy52zfzDc9xvBmfMS', 'sales@jsoftsolution.com.my', NULL, 'Member', 33, 'english', NULL),
(20, '1', NULL, 'active', '0', 'newtest', '$2y$10$RaeKCj.lmSOmd1T4czHt/ejPrrksToce86JT1wOFhgzRpigv3.SZ2', 'newtest@gmail.com', NULL, 'Member', 34, 'english', NULL),
(21, '1', NULL, 'active', '0', 'Sim', '$2y$10$jwx2utYt9/D1DZQSUrkXUuRQB/rRRPRmgCpYIlfa6cDNY/nyNcuJG', 'sim@gmail.com', NULL, 'Member', 35, '', NULL),
(22, '1', NULL, 'active', '0', 'Benjamin', '$2y$10$PrTrTgFAOH8lxnZWNLmh2Onl0skWiCKs.YLzxYjqVuqHzi5uYvm0q', 'benjamin@kenchanasukma.com', NULL, 'Member', 36, 'english', NULL),
(23, '1', NULL, 'active', '0', 'Vin', '$2y$10$RCX23QHl6.jxC/KUG8ijTOVFzq2KmMwviv9DwwGSxUxBNXuqmvpjy', 'vin@aerotechlogistics.com.my', NULL, 'Member', 37, 'english', NULL),
(24, '1', NULL, 'active', '0', 'Esther Chan', '$2y$10$4l8rIB/qWoM6F/VlDu8cceabgYTabqrQ7tu08hsUkbLOHlYvMEhKO', 'esther.chan@crown.my', NULL, 'Member', 38, 'english', NULL),
(25, '1', NULL, 'active', '0', 'Ivy Loh', '$2y$10$jOSSBGSwxU3NI5VxmtoFM.hOHYz3frbErThk5FcVyQt5C2AEoeaa2', 'ivy.loh@dreamtalents.com', NULL, 'Member', 39, 'english', NULL),
(26, '1', NULL, 'active', '0', 'Mohd Nor Azlan', '$2y$10$u4322xPLkVjQQN3GXmF3yeYF9zchuifWMP6hDdFE/YMrIGUojfmiK', 'azlannorri@pkns.gov.my', NULL, 'Member', 40, 'english', NULL),
(27, '1', NULL, 'active', '0', 'jsofttest', '$2y$10$bO587AkC295ZbYE3DB5wMOh9fWzWVMDeJntuHl51f9qUbDrcEeydS', 'jsofttest@gmail.com', NULL, 'Member', 41, 'english', NULL),
(28, '1', NULL, 'active', '0', 'democlient', '$2y$10$PMA/pv1xSeKoUVbKse3gMOi7HBlaGAkgx9hSIy6hH6mgS4W.IDH8a', 'democlient@gmail.com', NULL, 'Member', 42, 'english', NULL),
(29, '1', NULL, 'active', '0', 'Sparow', '$2y$10$N//CuEk71kXqfe4gzSDc8udoQ3Ktpdbqjdf8ntOtySrc/GNxoYYES', 'sparow@gmail.com', NULL, 'Member', 43, 'english', NULL),
(30, '1', NULL, 'active', '0', 'testclientp', '$2y$10$5lEGMNyS1VXVeSay.EeYPuSxSwseMbi9AzgArBFZW9wnylfit1hXe', 'testclientp@gmail.com', NULL, 'Member', 44, 'english', NULL),
(31, '1', NULL, 'active', '0', 'akerp', '$2y$10$sZ59jxboI3QCYYw4rxw2Ku8fyQUc1t1YvlsQrUj/HTaI61vryilG6', 'akerpsolutions@gmail.com', NULL, 'Member', 45, 'english', NULL),
(33, '1', NULL, 'active', '0', 'Kali D', '$2y$10$/GCFjJ6MoAPB.X2zn3VF6OPQD6fMrmp1w6JGKWdjizwgrMValCXfm', 'kali@gmail.com', NULL, 'Member', 47, 'english', NULL),
(34, '1', NULL, 'active', '0', 'DEXTER SDN BHD', '$2y$10$vJMHPu2Ymw/h.zjFGkA6aejivXs0Ru6bEbuoDDK8rZa0Np7JA9T/2', 'dex@gmail.com', NULL, 'Member', 48, 'english', NULL),
(35, '1', NULL, 'active', '0', 'PT WASTE RECYCLING INDUSTRY ', '$2y$10$/NacoJhSH9nhJ2BdrVvzNe.zwl91R0zYeP2XSEbAXrvGO2aywjT6O', 'pantaitimurmetal@gmail.com', NULL, 'Member', 54, '', NULL),
(36, '1', NULL, 'active', '0', 'PT WASTE RECYCLING INDUSTRY ', '$2y$10$cxLB9EaaSU1n.Tujrjjje.XG7EoYvPbMxHyIVOn0/Hhe9LNBEEAPy', 'pantaitimurmetal@gmail.com', NULL, 'Member', 55, '', NULL),
(37, '1', NULL, 'active', '0', 'PT WASTE RECYCLING INDUSTRY ', '$2y$10$1/b2CwNCvdXTGXbijFY2EuKSP5Diu8By5WGf/0zPdYW11pChs6YMW', 'pantaitimurmetal@gmail.com', NULL, 'Member', 56, '', NULL),
(38, '1', NULL, 'active', '0', 'PT WASTE RECYCLING INDUSTRY ', '$2y$10$xKexQCxsKj6COLSeUukr9.todMKeltb.6XeVmTWiLfG7bo/5mxiV6', 'pantaitimurmetal@gmail.com', NULL, 'Member', 57, '', NULL),
(39, '1', NULL, 'active', '0', 'PT WASTE RECYCLING INDUSTRY ', '$2y$10$mMN60Tgo1FeAkCi8aGz.2..stK3P2bTCOA0i2MBjn6YFK2O0LYu1.', 'pantaitimurmetal@gmail.com', NULL, 'Member', 58, '', NULL),
(54, '1', NULL, 'active', '0', 'sfdsdfsd', '$2y$10$g6Ttlv9chfu6cAOnY.aN2e9Hx0dzY8WVV3IWP/Q2H0G00jJM8OLfq', 'mkklopjhhhhh@gmail.com', NULL, 'Member', 81, 'english', NULL),
(55, '1', NULL, 'active', '0', 'bdfbvsdfb', '$2y$10$RXnJYI5gSuUw3/neCW4uAeBXMklkTGXwn3KQGwPLd2KF5eVFELNb2', 'bdfbvsdfb@gmail.com', NULL, 'Member', 82, 'english', NULL),
(57, '1', NULL, 'active', '0', 'sivaprasad', '$2y$10$9wn/RwnSZyJst2OxyZndGenwXbQUemmc1gTbWMTUqtY5xG6j5VE1W', 'sprasad96@gmail.com', NULL, 'Member', 84, 'english', NULL),
(58, '1', NULL, 'active', '0', 'asrfafg', '$2y$10$SL9Jmbue31zpESQ5h8yFCuZO8m62P2PUZb7YkzpcjaISJg9fNczWm', 'hgfgh@dvhf.dfd', NULL, 'Member', 85, '', NULL),
(59, '1', NULL, 'active', '0', 'asrfafg', '$2y$10$O1cp2m.bVb/EzOrcLAVWZuDX0zsFtlJMsplZpOvl.QoLnBN3SaFt.', 'hgfgh@dvhf.dfd', NULL, 'Member', 86, '', NULL),
(60, '1', NULL, 'active', '0', 'jhkjhkjhkj', '$2y$10$jbwfmoUDr1iKazX7ZIiom.3pFq/zUNbG6utBmyUboUhcvSIiIAexy', 'gfghfgh@sdfasaf.sdd', NULL, 'Member', 87, '', NULL),
(61, '1', NULL, 'active', '0', 'jhkjhkjhkj', '$2y$10$wGCXpPcFxQUnixgn6BP5l.kGw7./IEEZUw4c8jRvVN4UePbladO6a', 'gfghfgh@sdfasaf.sdd', NULL, 'Member', 88, '', NULL),
(62, '1', NULL, 'active', '0', 'jhkjhkjhkj', '$2y$10$p1QpotWnCN.X3TEvZD6q8eVW5BXT61VqRE2t1Rlr8SS/Xztol2xyO', 'gfghfgh@sdfasaf.sdd', NULL, 'Member', 89, '', NULL),
(63, '1', NULL, 'active', '0', 'hjghjghj', '$2y$10$/tB5dORGKgo0t4UHDbwkj.ityEUMJEsRxSFqzFgkc2hkHyXsARHuG', 'hjghjgj@jgh.ddd', NULL, 'Member', 90, '', NULL),
(64, '1', NULL, 'active', '0', 'hjghjghj', '$2y$10$tkV1uI.AfsmM2OlU2dKmbOmLzYHuVOZDv/cR4PdrrDe85in0JZIB2', 'hjghjgj@jgh.ddd', NULL, 'Member', 91, '', NULL),
(65, '1', NULL, 'active', '0', 'hjghjghj', '$2y$10$y7nBXK5aGRfFZ0Y5IZOWvuxv/ggBaBepgS4gEdgNLY7SjAUuOOnkW', 'hjghjgj@jgh.ddd', NULL, 'Member', 92, '', NULL),
(66, '1', NULL, 'active', '0', 'hjghjghj', '$2y$10$437kpaEdxW/FZPD1W6NOvOLYZy2LzZFbH/L5eHXARErP4a5R//YMm', 'hjghjgj@jgh.ddd', NULL, 'Member', 93, '', NULL),
(67, '1', NULL, 'active', '0', 'aeawfasdf', '$2y$10$ZrTCYesMkNMWU8QDzkO1xeQxA5H.ghWjRqEVlflYlJG34eo8BWfkO', 'hjghjgj@jgh.ddd', NULL, 'Member', 94, '', NULL),
(68, '1', NULL, 'active', '0', 'hjg', '$2y$10$CjxHsd/opQXOZvnVb32PueQm2UojL/ru7LY2J5WIkoy4Vt0pNUpUG', 'ghjdsf@sad.df', NULL, 'Member', 95, '', NULL),
(69, '1', NULL, 'active', '0', 'jhghj', '$2y$10$CJkcYj1Fw1TSnraA0kW/MeadMPB3VffxREYOgzFJYcuf5uS.KpQdO', 'gjhg@sdaf.sadf', NULL, 'Member', 96, '', NULL),
(70, '1', NULL, 'active', '0', 'ghhjgHJGHJGhjgjh', '$2y$10$6V8NSDx1IEWKK37fV69yr.VOh0D2ugp1hIkL.II9po9eeC.I64sgS', 'hghjG@sdf.fgf', NULL, 'Member', 97, 'english', NULL),
(71, '1', NULL, 'active', '0', 'jh', '$2y$10$FwODtrQ3f9itfs744JvfWeZWvwWBPNv/.KDZC1oD9rVfT/SdLxCHq', 'mhghgjh@sadf.ff', NULL, 'Member', 98, 'english', NULL),
(72, '1', NULL, 'active', '0', 'ghfhfh', '$2y$10$W1lhB46uTyEdbGydKo02v.ZwdCFgtn4I/YjefKDac6UajGqAiRIQO', 'fghfhgfghf@aadf.hjg', NULL, 'Member', 99, '', NULL),
(73, '1', NULL, 'active', '0', 'ghfhfh', '$2y$10$Zm6R6N/6uOVL7nqSmiC5Ue5cKhF5.p3dtfx.aUUGcPpl.3YizWuJe', 'fghfhgfghf@aadf.hjg', NULL, 'Member', 100, '', NULL),
(74, '1', NULL, 'active', '0', 'ghfhfh', '$2y$10$5ixgIyybTpQ.tKXseSSLJOiJMWQczAZfpyX665cuuVJlNWdlFy0qe', 'fghfhgfghf@aadf.hjg', NULL, 'Member', 101, '', NULL),
(75, '1', NULL, 'active', '0', 'ghfhfh', '$2y$10$Ak2iwNcMxTUrtCf8S9Mt2OG/zZhoakq5G4sTOL30OAZmAsGWOcDHu', 'fghfhgfghf@aadf.hjg', NULL, 'Member', 102, '', NULL),
(76, '1', NULL, 'active', '0', 'ghfhfh', '$2y$10$qASuZbdg7v40cP9Q6jXVDe0KVG9LFnEQxc3sQJWShtqfFaciI.jTm', 'fghfhgfghf@aadf.hjg', NULL, 'Member', 103, '', NULL),
(77, '1', NULL, 'active', '0', 'jkh', '$2y$10$NNz4EZyNjvZlzX7eRJrICei05EO91xZYWGplbrD7lJqq3TWyAdtge', 'hkjhkjh@dfadf.ffs', NULL, 'Member', 104, '', NULL),
(78, '1', NULL, 'active', '0', 'jkh', '$2y$10$TXTs1QWMRJwWi3RoXbUXi.TpOx9GCEWyatelL.daBFI0hixnrvtSe', 'hkjhkjh@dfadf.ffs', NULL, 'Member', 105, '', NULL),
(79, '1', NULL, 'active', '0', 'hjghjg', '$2y$10$bBxRKxd/R5AcQz6NS5bDcuNKBU1Tf7J42w4UY8aom0x92Mnvzjque', 'jhjkhkjhK@hjgh.ddd', NULL, 'Member', 106, '', NULL),
(80, '1', NULL, 'active', '0', 'vjgjhgjh', '$2y$10$imeEuzjBAlz7mm/WJcoSLOXScRcHO9batYxvNR67UPR0F1uLSswbm', 'gfhgfhgfg@sdf.sdf', NULL, 'Member', 107, '', NULL),
(81, '1', NULL, 'active', '0', 'jkhgjhghj', '$2y$10$oD5VnlmQCEh5moj/DQ24W.vl.LeKHnS07SkWd.OIwZDsyg5IIFZJy', 'jhgjh@sdf.dsf', NULL, 'Member', 108, '', NULL),
(82, '1', NULL, 'active', '0', 'jkhgjhghj', '$2y$10$LNaEPafdZSp5KiEMibNXJuZiBU/MmND1ncZ12Ar3FZ5Srb1xZ7u0u', 'jhgjh@sdf.dsf', NULL, 'Member', 109, '', NULL),
(83, '1', NULL, 'active', '0', 'jkhkjh', '$2y$10$iqliZaF6YAHTOoNloGzzp.LxHsp.i92OI6Cr.y0dCmGxN2SojIUuO', 'hkjh@dfgsdg.ff', NULL, 'Member', 110, '', NULL),
(84, '1', NULL, 'active', '0', 'jkhjhg', '$2y$10$AkXuzlPgCDkgWyOcISyhre9oVl.b/3QVNqJXpvO5tkqa45sHkx1WO', 'hhghgH@dddd.dd', NULL, 'Member', 111, '', NULL),
(85, '1', NULL, 'active', '0', 'hjghjg', '$2y$10$FcI9oMTDO35u/hCe/jfSzOnBg4lyPHSN20X8EpeK2sajBSnqJRDTy', 'kjhgkjhgkJ@d.fdf', NULL, 'Member', 112, '', NULL),
(86, '1', NULL, 'active', '0', 'jhkjhjk', '$2y$10$YaEQlkm60xrZbrBVQUMM5.fiDVoAzfU6qGb0k.JDGgkWV6W6/f4oW', 'kjhkj@sdaf.sdf', NULL, 'Member', 113, 'english', NULL),
(87, '1', NULL, 'active', '0', '', '$2y$10$DK9vE3ZP7Q4nYTxN1RoBe.ebFMDfqV5u09o0iUkjLbJ1o3IN1ENQq', 'dsfsad', NULL, 'Member', 114, '', NULL),
(89, '1', NULL, 'active', '0', 'hghjghjg', '$2y$10$8RVtDrM5xCLe708C79sZI.E4lRZzRjKBeWtOMSvWCzuQ/7z6XCf4y', 'ggggg@adADF.FDD', NULL, 'Member', 116, '', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
