-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2023 at 02:08 AM
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
-- Database: `erp-dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
  `comments` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `comment_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
  `assign_asset_employee` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `emp_id` int NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `note_history` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_history`
--

INSERT INTO `asset_history` (`id`, `asset_id`, `assign_asset_employee`, `emp_id`, `action`, `note_history`, `created_at`, `updated_at`) VALUES
(1, 1, '', 0, 'Asset Created', '', '2023-05-19 01:18:50', '0000-00-00 00:00:00'),
(2, 1, 'Hariinraj', 10, 'Asset Unassigned From employee', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00'),
(3, 1, 'Hariinraj', 10, 'Asset Assigned to Employee', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00'),
(4, 1, '', 10, 'Asset Updated', '', '2023-05-22 06:14:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asset_management`
--

DROP TABLE IF EXISTS `asset_management`;
CREATE TABLE IF NOT EXISTS `asset_management` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_modelno` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `unit_price` int NOT NULL,
  `asset_status` int NOT NULL,
  `date_of_purchase` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` int NOT NULL,
  `subcategory` int DEFAULT NULL,
  `supplier` int DEFAULT NULL,
  `department` int NOT NULL,
  `sub_department` int DEFAULT NULL,
  `date_of_manufacture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year_of_valuation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `warrenty_month` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `depreciation_month` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assign_employee` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_management`
--

INSERT INTO `asset_management` (`id`, `asset_id`, `barcode`, `asset_modelno`, `name`, `description`, `unit_price`, `asset_status`, `date_of_purchase`, `category`, `subcategory`, `supplier`, `department`, `sub_department`, `date_of_manufacture`, `year_of_valuation`, `warrenty_month`, `depreciation_month`, `location`, `image_url`, `note`, `assign_employee`, `created_at`, `updated_at`) VALUES
(1, 'AST-040816', 'https://erp-dev.jsuitecloud.com/barcodes/AST-040816.png', 'HP123', 'HP Laptop', 'HP Pavilion Laptop', 3000, 1, '2023-05-17', 9, 9, NULL, 5, NULL, '2023-05-17', '2023-05-17', '', '', '', 'blank-asset.png', '', 10, '2023-05-19 01:18:50', '2023-05-22 06:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `asset_status`
--

DROP TABLE IF EXISTS `asset_status`;
CREATE TABLE IF NOT EXISTS `asset_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
('043d1e99d42f8d87e764db6bf6ff2ea97ab0a9dd', '113.210.53.120', 1685715382, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353731353338323b),
('0a6a3f7f9db25c105a028b2b0a6cdb616329f54e', '206.189.7.178', 1685853892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353835333839323b),
('1074fb94e96c7ae5261f343211082efecd047ef2', '217.21.75.72', 1685808791, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353830383739303b),
('1cc564f49a40691bb8c65ee0b74c1a323d20f8e4', '113.210.53.181', 1685768379, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353736383337383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('20ad91e9bdb3c9314f817d337a322e8da97f2585', '123.201.171.220', 1685649830, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353634393832393b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('217bcf438f2ef0aded867f73ed1cfc046764fa83', '121.121.166.198', 1685871609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353837313630383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('2a8a975af31c421d2f876fbb5f0d70743c89c532', '180.74.219.115', 1685912764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353931323736333b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('2f037caca3da18408c48ca05607d67f724f40b16', '113.210.93.130', 1685682486, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353638323438313b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('331b31a3a42c8d1378659f2084bf974ccd18862a', '217.21.75.72', 1685722390, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353732323339303b),
('34e44fe9d2c03e365f6648aa173dd686659b3c19', '217.21.75.72', 1685595934, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353539353933343b),
('381054be6d1b535a24e5c24643254b24a4638082', '107.178.200.228', 1685726360, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353732363336303b),
('3a148217b06ebfb6df982ecf4e0b611fa2d6f2f5', '35.203.245.218', 1685902423, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353930323432333b),
('3af3c78a66b723a5ebea5ae954d27948af2acb8c', '42.106.177.97', 1685756789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353735363738383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('3d6497c99a60ae08653ca2b8495ef07cbe4154fc', '121.123.0.74', 1686015790, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363031353738393b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('42760a8d93d31a4e8d8f929c617b0a7d891dd56e', '121.122.100.219', 1686021227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363032313232373b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('4bd61798c365f3f15d6bded944d401d077517eb2', '121.123.0.74', 1686004488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363030343438383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('6f76bd51e075b898985859692a2ae1780cce950e', '107.178.200.200', 1685990330, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353939303333303b),
('76550a2fed949f32e5a507614bd4e67e45613672', '113.211.139.181', 1685956928, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353935363932373b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('820a8d302cc34499925ce5a87054e2ebb91e7678', '217.21.75.72', 1685838602, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353833383630323b),
('8b7285d9fc3b066dd8e440f7858ddbcbb2f7793c', '180.74.219.115', 1685843820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353834333831393b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('9d8a4d946401f421d8b5fbaf2396a1733416fa56', '42.106.179.12', 1686012856, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363031323835333b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('a0452320b14c9ee13cbcdf9bc9d7b3e39a2ace53', '217.21.75.72', 1686011401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363031313430313b),
('a73a94b223ca174bfb5667cebe87cf48f0d4bdd0', '45.128.163.132', 1685635410, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353633353431303b),
('aba0098aa60db1b977734c1664e0ea2622d6c0a3', '113.210.93.130', 1685674864, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353637343836333b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('ae752a7d1790c8c0c8dcdab5144e0c0395f8397d', '217.21.75.72', 1685925001, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353932353030313b),
('b23532e816aee59572e10f5478ff78dbc5c3f6a0', '113.210.53.184', 1685696727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353639363732363b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('c5210db36019d613ee2ae62b1760a6bef1e9dd3e', '203.109.75.80', 1686022936, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363032323933353b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('c624a2394062cb78dc584b7ff2cc1a41578286fa', '118.101.171.39', 1685767171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353736373137313b),
('c8aa3c7d616402ca4bdde56cede88969fabf8d9b', '34.253.239.34', 1686009398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638363030393339383b),
('d951a868a6ae2e7499651ed33fa095742bf6107b', '121.122.100.67', 1685606963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353630363936333b),
('df08737e5c4deeabcc29b5530fc982dc06a92f28', '113.211.139.117', 1685941521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353934313532303b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('e9fea4693b1e619de86d22124868abcbd6ffd3d8', '219.91.202.109', 1685592516, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353539323531363b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('ea862c6e68f6b9674331e270de227e12e9fa143a', '42.106.179.189', 1685593691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353539333639313b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('f4f3f9293be855dbd9ee92c755f42f5b276dc486', '217.21.75.72', 1685682334, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353638323333343b),
('f898077a31a8d091f4a6f8c5fb8f8741a9d8da82', '34.255.100.112', 1685902170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353930323137303b),
('facdefb977fb54597d7700509971caac247f101c', '107.178.231.252', 1685814230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353831343233303b),
('ffeb2f73440c5fedee6f5ffc09b36be93210715f', '203.82.75.132', 1685871615, 0x5f5f63695f6c6173745f726567656e65726174657c693a313638353837313631353b);

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
(1, '123456', 'Sales Account', '2018-01-01 00:00:00', '4990.54', 'Default Sales Account', 0, 'Basic');

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
  `tfrom` time NOT NULL,
  `tto` time DEFAULT NULL,
  `note` int DEFAULT NULL,
  `actual_hours` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp` (`emp`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_attendance`
--

INSERT INTO `gtg_attendance` (`id`, `emp`, `created`, `adate`, `tfrom`, `tto`, `note`, `actual_hours`) VALUES
(2, 3, '2023-04-05 03:05:12', '2022-04-05', '09:00:00', '10:51:01', 0, NULL),
(3, 3, '0000-00-00 00:00:00', '2022-04-06', '06:06:31', '06:06:52', 0, '21'),
(4, 3, '0000-00-00 00:00:00', '2023-03-25', '06:07:30', '17:08:47', 0, '1681277'),
(5, 3, '0000-00-00 00:00:00', '2023-03-26', '12:04:45', '12:05:43', NULL, '3365021417'),
(6, 3, '0000-00-00 00:00:00', '2023-04-26', '12:05:11', '00:00:00', NULL, '0'),
(7, 3, '0000-00-00 00:00:00', '2023-04-26', '12:08:02', '00:00:00', NULL, '0'),
(8, 3, '0000-00-00 00:00:00', '2023-04-26', '12:08:42', '00:00:00', NULL, '0'),
(9, 3, '0000-00-00 00:00:00', '2023-04-26', '12:16:27', '00:00:00', NULL, '0'),
(10, 6, '0000-00-00 00:00:00', '2023-04-26', '13:46:16', '00:00:00', NULL, '0'),
(11, 6, '0000-00-00 00:00:00', '2023-04-26', '13:46:18', '00:00:00', NULL, '0'),
(12, 6, '0000-00-00 00:00:00', '2023-04-26', '13:49:33', '00:00:00', NULL, '0'),
(19, 3, '0000-00-00 00:00:00', '2023-04-28', '04:36:33', '14:06:39', NULL, '5048069197'),
(24, 3, '0000-00-00 00:00:00', '2023-05-01', '07:32:22', '11:14:21', 0, '03:41:59'),
(25, 3, '0000-00-00 00:00:00', '2023-05-02', '04:35:55', '04:42:36', 0, '00:06:41'),
(26, 4, '0000-00-00 00:00:00', '2023-05-02', '06:58:12', '08:17:35', 0, '01:19:23'),
(27, 3, '0000-00-00 00:00:00', '2023-05-03', '04:52:06', '04:41:23', 0, '1331'),
(28, 4, '0000-00-00 00:00:00', '2023-05-03', '04:16:25', '04:42:22', 0, '00:25:57'),
(30, 11, '2023-05-11 07:23:04', '2023-05-11', '04:09:15', '07:23:04', 0, '4'),
(31, 12, '2023-05-11 07:23:22', '2023-05-11', '04:12:33', '07:23:22', 0, '720'),
(32, 3, '2023-05-15 11:40:31', '2023-05-15', '10:57:43', '11:40:31', 0, '00:42:48'),
(33, 1, '2023-05-16 01:03:42', '2023-05-16', '01:03:24', '01:03:42', 0, '00:00:18'),
(34, 12, '2023-05-16 03:23:23', '2023-05-16', '10:48:39', '03:23:23', 0, '125'),
(35, 3, '2023-05-16 10:51:40', '2023-05-16', '11:40:35', '10:51:40', 0, '23:11:05'),
(36, 12, '2023-05-17 05:14:23', '2023-05-17', '05:11:34', '05:14:23', 0, '00:02:49'),
(37, 12, '2023-05-24 06:05:59', '2023-05-24', '09:24:29', '06:05:59', 0, '20:41:30'),
(38, 13, '2023-05-24 07:50:40', '2023-05-24', '07:30:35', '07:50:40', 0, '00:20:05'),
(39, 12, '2023-05-26 02:12:57', '2023-05-26', '09:33:41', '02:12:57', 0, '79'),
(40, 12, '2023-05-29 01:36:19', '2023-05-29', '01:35:42', '01:36:19', 0, '00:00:37'),
(41, 12, '2023-05-31 12:53:13', '2023-05-31', '01:36:30', '12:53:13', 0, '10967');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

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
(43, 'Short Break', 2, '2023-05-31', '07:31:12', '07:38:46', '00:07:34', 12, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `roc` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `incharge` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'example.png',
  `gid` int NOT NULL DEFAULT '1',
  `company` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taxid` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox_s` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` decimal(16,2) DEFAULT '0.00',
  `loc` int DEFAULT '0',
  `docid` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discount_c` decimal(16,2) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_customers`
--

INSERT INTO `gtg_customers` (`id`, `name`, `phone`, `address`, `roc`, `incharge`, `city`, `region`, `country`, `postbox`, `email`, `picture`, `gid`, `company`, `taxid`, `name_s`, `phone_s`, `email_s`, `address_s`, `city_s`, `region_s`, `country_s`, `postbox_s`, `balance`, `loc`, `docid`, `custom1`, `discount_c`, `reg_date`, `customer_type`) VALUES
(1, 'Shafeek Ajmal', '07042121686', '414 Krishna enclave', '', '', 'Zirakpur', 'Punjab', 'India', '140603', 'ajmalshafeek@gmail.com', 'cutsm_upl_1678713658.jpg', 2, 'Jsoftsolution', '', 'Shafeek Ajmal', '07042121686', 'ajmalshafeek@gmail.com', '414 Krishna enclave', 'Zirakpur', 'Punjab', 'India', '140603', '531.50', 0, '', '', '0.00', '2023-03-23 06:15:18', ''),
(10, 'Jsoftsolution', '07042121686', '414 Krishna enclave', '', '', 'Mohali', 'gdfgfd', 'India', '53453', 'shafeekajmal@hotmail.com', 'example.png', 2, 'Jsoftsolution', '3213', 'Jsoftsolution', '07042121686', 'shafeekajmal@hotmail.com', '414 Krishna enclave', 'Mohali', 'gdfgfd', 'India', '53453', '0.00', 0, '3123', '', '12.00', '0000-00-00 00:00:00', ''),
(11, 'Raj', '60146291291', 'No 40, Oasis Square, Business Park', '', '', 'Kuala Lumpur', 'Wilayah Persekutuan', 'Malaysia', '51000', 'hariinraj2911@gmail.com', 'cutsm_upl_1678783768.jpg', 1, 'HR HiTech Services', '', 'Raj', '60146291291', 'hariinraj2911@gmail.com', 'No 40, Oasis Square, Business Park', 'Kuala Lumpur', 'Wilayah Persekutuan', 'Malaysia', '51000', '137.00', 0, '', '', '0.00', '2023-03-24 02:56:31', ''),
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
(24, 'sdasd', '234234234', 'asdasd', '234234', 'sdfsdf', NULL, NULL, NULL, NULL, 'krish@smartoffice.my', 'example.png', 1, 'sdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0, NULL, NULL, NULL, '2023-06-02 11:10:43', 'forgein');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Table structure for table `gtg_documents`
--

DROP TABLE IF EXISTS `gtg_documents`;
CREATE TABLE IF NOT EXISTS `gtg_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `cdate` date NOT NULL,
  `permission` int DEFAULT NULL,
  `cid` int NOT NULL,
  `fid` int NOT NULL,
  `rid` int NOT NULL,
  `complaintid` varchar(250) DEFAULT '0',
  `userid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_documents`
--

INSERT INTO `gtg_documents` (`id`, `title`, `filename`, `cdate`, `permission`, `cid`, `fid`, `rid`, `complaintid`, `userid`) VALUES
(1, 'GTG', '0234dbd8a51a6787909ec3cd0583d8f6.pdf', '2022-11-01', NULL, 0, 0, 0, NULL, 0),
(2, 'test', 'feff087a9d08a092c30e4be9d142217b.pdf', '2023-01-31', NULL, 0, 0, 0, '31', 6),
(3, 'test', 'ef40622d2d46b9f648cdcbc226b04b98.pdf', '2023-01-31', NULL, 0, 0, 0, '32', 6),
(4, 'test', '19c7fe8af4503cc36113011f853b7608.pdf', '2023-01-31', NULL, 0, 0, 0, '33', 6),
(5, 'test', '9033bad1760cef4a01b2a9ea8adb91a8.pdf', '2023-01-31', NULL, 0, 0, 0, '34', 6),
(6, 'test', '56b4182f66d0f8fa5881b1ab34aeab41.pdf', '2023-01-31', NULL, 0, 0, 0, '35', 6),
(7, 'test', 'a29c6405c36ab3f58112fb95f70e9c53.pdf', '2023-01-31', NULL, 0, 0, 0, '36', 6),
(8, 'test', 'f990c168389383f8f20190c703cb01cd.pdf', '2023-01-31', NULL, 0, 0, 0, '37', 6),
(9, 'test', '446b6be404526a24e8d7f4e8fa8ce6ba.pdf', '2023-01-31', NULL, 0, 0, 0, '38', 6),
(10, 'test', '2654d81726fca45274f3dd4a57003153.pdf', '2023-01-31', NULL, 0, 0, 0, '39', 6),
(11, 'test', '68c7723414dc7cfdec95c59f52777ea6.pdf', '2023-01-31', NULL, 0, 0, 0, '40', 6),
(12, 'test', '2e96869c0b52fc7ee8fc8cec6d7d7e4b.pdf', '2023-01-31', NULL, 0, 0, 0, '41', 6),
(13, 'test', '0e65af14a2efbe9d638c8e31d9e7c80c.pdf', '2023-01-31', NULL, 0, 0, 0, '42', 6),
(14, 'test', '3c02d6dbc9c86561a4f4fab627ee0d2f.pdf', '2023-01-31', NULL, 0, 0, 0, '43', 6),
(15, 'test', '07d2da30bfb723adfb774b9d5f68eb61.pdf', '2023-01-31', NULL, 0, 0, 0, '44', 6),
(16, 'test', '7cc4cad7a76996f9a4e3aadcfead77ea.pdf', '2023-01-31', NULL, 0, 0, 0, '45', 6),
(17, 'test', 'a0dfc0e00c4ea1f5d13256f83bd4ad80.pdf', '2023-01-31', NULL, 0, 0, 0, '46', 6),
(18, 'test', '3a84372d5fb75c4024e5ab38ba1ae646.pdf', '2023-01-31', NULL, 0, 0, 0, '47', 6),
(19, 'test', 'cbe3367227c2d2beac85b57959e3dcf9.pdf', '2023-01-31', NULL, 0, 0, 0, '48', 6),
(20, 'test', 'b5d77f2776b3614feea86e64ea59a094.pdf', '2023-01-31', NULL, 0, 0, 0, '49', 6),
(21, 'test', '6bca391862fa3ce62c9e1863781cd941.pdf', '2023-01-31', NULL, 0, 0, 0, '50', 6),
(22, 'test', '78b03e47f08a9fab498dccd493de912a.pdf', '2023-01-31', NULL, 0, 0, 0, '51', 6),
(23, 'test', '8c5a9d68a8aba2dabbc3a825f41dd5d7.pdf', '2023-01-31', NULL, 0, 0, 0, '52', 6),
(24, 'test', '063a84edccf4e0f38a040cb326ff751c.pdf', '2023-01-31', NULL, 0, 0, 0, '53', 6),
(25, 'test', '4d242f5b41e07697c99dc5cce95a3602.pdf', '2023-01-31', NULL, 0, 0, 0, '54', 6),
(26, 'test', '1f96f939ace2b73468adf1dd5c4275dd.pdf', '2023-01-31', NULL, 0, 0, 0, '55', 6),
(27, 'Emp’ee', '6cc622421959d30970f2feba9e8f59b7.pdf', '2023-02-06', NULL, 0, 0, 0, '58', 6),
(28, 'Testing GTG', '41229b14b32c0edc990fa210ecefe791.docx', '2023-02-20', NULL, 0, 0, 0, '59', 6),
(29, 'title', '1681731789PayBill_FDS_V1_2.docx', '2023-04-17', NULL, 0, 0, 0, '60', 6),
(30, 'test sytem', '1681814040ERP_Website_Bugs_and_Enhancements_V1.doc', '2023-04-18', NULL, 0, 0, 0, '61', 6),
(31, 'test', '1681977909Claim_Expenses.pdf', '2023-04-20', NULL, 0, 0, 0, '62', 6),
(32, 'test', '1681978010Google_API_Sign.docx', '2023-04-20', NULL, 0, 0, 0, '63', 6),
(33, 'Customer House Electricity Issue', '1684233320Flowchart_Wisma_KLSICCI_(1)_drawio.pdf', '2023-05-16', NULL, 0, 0, 0, '73', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_draft`
--

INSERT INTO `gtg_draft` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `multi`, `i_class`, `loc`) VALUES
(1, 1001, '2023-05-18', '2023-05-18', '157.50', '0.00', '0.00', 'incl', '0.00', '7.50', '157.50', NULL, '', 'partial', 1, 6, '0.00', '5.00', 'yes', 1, '%', '', 1, NULL, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_draft_items`
--

INSERT INTO `gtg_draft_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `i_class`, `unit`) VALUES
(1, 1, 1, 'AVT tea-00165', '00165', '5.00', '30.00', '5.00', '0.00', '157.50', '7.50', '0.00', NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_employees`
--

DROP TABLE IF EXISTS `gtg_employees`;
CREATE TABLE IF NOT EXISTS `gtg_employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postbox` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phonealt` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'example.png',
  `sign` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'sign.png',
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dept` int DEFAULT NULL,
  `degis` int DEFAULT NULL,
  `salary` decimal(16,2) DEFAULT '0.00',
  `clock` int DEFAULT NULL,
  `clockin` int DEFAULT NULL,
  `clockout` int DEFAULT NULL,
  `c_rate` decimal(16,2) DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `passport` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `permit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `passport_expiry` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `permit_expiry` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_employees`
--

INSERT INTO `gtg_employees` (`id`, `username`, `email`, `name`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `phonealt`, `picture`, `sign`, `joindate`, `dept`, `degis`, `salary`, `clock`, `clockin`, `clockout`, `c_rate`, `company`, `passport`, `permit`, `employee_type`, `passport_expiry`, `permit_expiry`, `document`) VALUES
(1, 'testing', 'udhayase@gmail.com', 'fsdfdsf', 'fsdfa', 'fdsafsaff', 'fads', 'fafd', 'fds', '4242342', NULL, 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '1000.00', NULL, NULL, NULL, '1.00', '', '', '', '', '', '', ''),
(2, 'ajmal', 'udhayase@gmail.com', 'Shafeek Ajmal', '414 Krishna enclave', 'Mohali', NULL, 'India', '', '0000000000', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 1, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(3, 'abcd', 'udhayase@gmail.com', 'AjmalSoft', '414 Krishna enclave', 'Mohali', NULL, 'United States', '53453', '8968022885', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 5, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(4, 'myname', 'udhayase@gmail.com', 'krish81', '414 Krishna enclave', 'Mumbai', NULL, 'India', '65464', '1234343', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(10, 'test1201', 'udhayase@gmail.com', 'test', 'test', 'test', 'testt', 'india', '1234', '123456789', NULL, 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '2000.00', NULL, NULL, NULL, '1.00', '', '', '', '', '', '', ''),
(11, 'Hariinraj', 'udhayase@gmail.com', 'Hariinraj', 'B-0-29 Astrum Jelatek', 'Kuala Lumour', 'Wilayah Persekutuan', 'Malaysia', '50600', '60146291291', NULL, 'example.png', 'sign.png', '2023-05-18 13:20:46', 3, NULL, '6000.00', 0, 0, 1681815054, '0.00', '', '', '', '', '', '', ''),
(12, 'krish81', 'udhayase@gmail.com', 'jsoftsolution.com.my', 'No , 64 Taman Subang baru', 'Shah Alam', 'Selangor', '', '', '', NULL, 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(13, 'krshmathavan', 'udhayase@gmail.com', 'jsoftsolution.com.my', 'No , 64 Taman Subang baru', 'Shah Alam', NULL, '', '', '', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 0, NULL, '0.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(14, 'Reena', 'udhayase@gmail.com', 'Reena', 'C-3-16, Centum @ Oasis Corporate Park, 2, Jalan PJU 1a/2, Oasis Ara Damansara, 47301 Petaling Jaya, ', 'KL', NULL, 'Malaysia', ' 47301', '601323456788', '', 'example.png', 'sign.png', '2023-05-18 13:20:46', 1, NULL, '1000.00', NULL, NULL, NULL, '0.00', '', '', '', '', '', '', ''),
(15, 'sdfsdf', '', 'sdfsdf', NULL, NULL, NULL, 'sdfsdf', NULL, NULL, NULL, 'example.png', 'sign.png', '2023-06-02 11:20:54', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, 'sdfsdfsdfs', 'sdfsdf', 'sdfsdf', 'foreign', '', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_expenses`
--

INSERT INTO `gtg_expenses` (`id`, `eid`, `name`, `title`, `category`, `receipt_no`, `receipt_date`, `receipt_amount`, `tax_amount`, `reason`, `remarks`, `doc`, `loc`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, 'AjmalSoft ', 'claim expense title', 'personal loan', 423, '0000-00-00', 123, 12, 'tset', 'test', '16813654629_colors_(1).png', 0, 2, '2023-04-13 05:57:42', '2023-04-13 05:57:42'),
(7, 2, 'Shafeek Ajmal ', 'claim expense title', 'personal loan', 423, '2023-04-13', 4324, 12, 'reason for claim', 'admin Remarks:taxting <br />admin Remarks:testing <br />admin Remarks:testing', '16813663410-circle-img-with-icon.png', 0, 1, '2023-04-13 06:12:21', '2023-04-13 06:12:21'),
(8, 3, 'AjmalSoft', 'test', 'medical', 123456, '0000-00-00', 1234, 12, 'medical claim', 'Remarks:Admin approved', '1681386132calendar.png', 0, 1, '2023-04-13 11:42:12', '2023-04-13 11:42:12'),
(9, 2, 'Shafeek Ajmal ', 'test', 'personal loan', 123456, '2023-04-20', 123456, 123, 'TESTING', '', '16819689461.png', 0, 0, '2023-04-20 05:35:46', '2023-04-20 05:35:46'),
(10, 3, 'AjmalSoft', 'required emeer gency requirement', 'personal loan', 1000, '2023-05-05', 1000, 10, 'testing purpose', 'okay', '16832354639_colors_(1).png', 0, 1, '2023-05-04 09:24:23', '2023-05-04 21:24:23'),
(11, 12, 'Treena Reena', 'Client Site Meeting', 'personal loan', 123456, '2023-05-03', 0, 0, 'Client Site Meeting to demo the ERP System', '', '1683796046Receipt.png', 0, 0, '2023-05-11 09:07:26', '2023-05-11 09:07:26'),
(12, 12, 'Treena Reena', 'Client Site Meeting', 'personal loan', 123456, '2023-05-03', 0, 0, 'Client Site Meeting to demo the ERP System', '', '1683796051Receipt.png', 0, 0, '2023-05-11 09:07:31', '2023-05-11 09:07:31'),
(13, 12, 'Treena Reena ', 'Client Site Visit', 'personal loan', 1, '2023-05-04', 100, 0, 'Client visit', 'Test', '1684300921Receipt.png', 0, 0, '2023-05-17 05:22:01', '2023-05-17 05:22:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_hrm`
--

INSERT INTO `gtg_hrm` (`id`, `typ`, `rid`, `val1`, `val2`, `val3`) VALUES
(1, 3, 1, 'SALES', NULL, NULL),
(2, 3, 0, 'Finance ', NULL, NULL),
(3, 3, 0, 'Operation', NULL, NULL),
(4, 1, 8, '4000', '0.00', '2022-11-01 08:37:36'),
(5, 3, 1, 'DEVELOPMENT', NULL, NULL);

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
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`),
  KEY `loc` (`loc`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_invoices`
--

INSERT INTO `gtg_invoices` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `invoice_type`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `discount_rate`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `multi`, `i_class`, `loc`, `r_time`) VALUES
(1, 1001, '2023-02-10', '2023-02-10', 0, '2.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.18', '2.00', 'Wallet Payment', '', 'paid', 1, 2, '2.00', '0.00', 'incl', 1, '%', 'JS001', 1, NULL, 0, 0, NULL),
(2, 1002, '2023-02-10', '2023-02-10', 0, '1900.00', '0.00', '0.00', 'incl', '100.00', '0.00', '181.82', '1900.00', 'Cash', '', 'paid', 1, 3, '1900.00', '1.00', 'incl', 1, '%', 'JS002', 1, NULL, 0, 0, NULL),
(3, 1003, '2023-02-13', '2023-02-13', 0, '198.00', '0.98', '0.02', 'incl', '2.00', '0.00', '1.98', '199.00', 'Card', '', 'paid', 1, 3, '199.00', '0.00', 'incl', 1, '%', '004', 1, NULL, 0, 0, NULL),
(4, 1004, '2023-03-09', '2023-03-09', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Wallet', '', 'partial', 10, 3, '0.02', '1.00', 'incl', 1, '%', '1022', 1, NULL, 0, 0, NULL),
(5, 1005, '2023-03-13', '2023-03-13', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Wallet', '', 'paid', 1, 3, '2.02', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(6, 1006, '2023-04-04', '2023-04-04', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 1, 3, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(7, 1007, '2023-04-06', '2023-04-06', 0, '99.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '99.00', NULL, 'no', 'due', 1, 3, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(8, 1008, '2023-04-06', '2023-04-06', 0, '423.00', '10.91', '1.09', 'incl', '0.00', '0.00', '45.32', '435.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(9, 1009, '2023-04-06', '2023-04-06', 0, '2310.25', '0.00', '0.00', 'incl', '315.03', '0.00', '281.28', '2310.25', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(10, 1010, '2023-04-06', '2023-04-06', 0, '11.83', '10.91', '1.09', 'incl', '1.61', '0.00', '1.44', '23.83', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(11, 1011, '2023-04-06', '2023-04-06', 0, '13.00', '0.91', '0.09', 'incl', '0.13', '0.00', '0.13', '14.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(12, 1012, '2023-04-18', '2023-04-18', 0, '218.79', '0.00', '0.00', 'incl', '2.21', '0.00', '21.00', '218.79', NULL, '', 'due', 1, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(13, 1013, '2023-04-18', '2023-04-18', 0, '14.26', '0.00', '0.00', 'incl', '10.24', '0.00', '2.50', '14.26', NULL, 'fds', 'due', 1, 2, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(14, 1014, '2023-04-18', '2023-04-18', 0, '65.75', '0.00', '0.00', 'incl', '4.25', '0.00', '10.00', '65.75', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(15, 1015, '2023-04-18', '2023-04-18', 0, '124.50', '0.00', '0.00', 'incl', '80.50', '0.00', '55.00', '124.50', NULL, '', 'due', 12, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(16, 1016, '2023-04-18', '2023-04-18', 0, '93.50', '0.00', '0.00', 'incl', '16.50', '0.00', '10.00', '93.50', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(17, 1017, '2023-04-18', '2023-04-18', 0, '4490.04', '0.00', '0.00', 'incl', '612.28', '0.00', '778.32', '4490.04', NULL, '', 'due', 12, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(18, 1018, '2023-04-19', '2023-04-19', 0, '39.00', '0.00', '0.00', 'incl', '11.00', '0.00', '8.74', '39.00', NULL, 'test', 'due', 12, 1, '0.00', '2.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(19, 1019, '2023-04-19', '2023-04-19', 0, '29.70', '0.00', '0.00', 'incl', '0.30', '0.00', '0.30', '29.70', NULL, 'test', 'due', 12, 1, '0.00', '2.00', 'incl', 1, '%', '', 1, NULL, 0, 0, NULL),
(20, 1020, '2023-04-19', '2023-04-19', 0, '48.60', '0.00', '0.00', 'incl', '9.40', '0.00', '8.00', '48.60', NULL, '', 'due', 12, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(21, 1021, '2023-05-04', '2023-05-04', 0, '99.75', '0.00', '0.00', 'incl', '5.25', '0.00', '5.00', '99.75', NULL, '', 'due', 11, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(22, 1022, '2023-05-05', '2023-05-05', 0, '742.00', '0.00', '0.00', 'incl', '0.00', '0.00', '42.00', '742.00', 'Wallet', '', 'partial', 13, 1, '42.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(23, 1023, '2023-05-09', '2023-05-09', 0, '619.40', '0.00', '0.00', 'incl', '0.00', '0.00', '29.40', '619.40', NULL, '', 'due', 14, 1, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(24, 1024, '2023-05-12', '2023-05-12', 0, '5.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '5.00', 'Wallet', '', 'paid', 1, 1, '5.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(25, 1025, '2023-05-16', '2023-05-16', 0, '354.00', '0.00', '0.00', 'incl', '0.00', '0.00', '54.00', '354.00', NULL, '', 'due', 14, 3, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(26, 1026, '2023-05-17', '2023-05-17', 0, '155.82', '9.09', '0.91', 'incl', '3.18', '0.00', '9.00', '165.82', NULL, 'Server', 'due', 13, 10, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(27, 1027, '2023-05-17', '2023-05-17', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', 'Maybank2U', 'Ipay88 Test', 'paid', 13, 1, '2.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(29, 1029, '2023-05-17', '2023-05-17', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 14, 11, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(31, 1001, '2023-05-18', '2023-05-18', 0, '157.50', '0.00', '0.00', 'incl', '0.00', '0.00', '7.50', '157.50', 'Cash', '', 'paid', 1, 1, '157.50', '5.00', 'yes', 1, '%', '', 1, NULL, 1, 0, NULL),
(32, 1030, '2023-05-19', '2023-05-19', 0, '200.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '200.00', NULL, '', 'due', 1, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(33, 1031, '2023-05-31', '2023-05-31', 0, '0.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '0.00', NULL, '', 'due', 1, 10, '0.00', '2.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(34, 1032, '2023-05-31', '2023-05-31', 0, '1.01', '0.00', '0.00', 'incl', '0.00', '0.00', '0.01', '1.01', NULL, '', 'due', 10, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(36, 1033, '2023-05-31', '2023-05-31', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL),
(37, 1034, '2023-05-31', '2023-05-31', 0, '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '0.00', '1.00', NULL, '', 'due', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, NULL, 0, 0, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;

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
(53, 37, 0, 'Test DEV 1', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_job`
--

DROP TABLE IF EXISTS `gtg_job`;
CREATE TABLE IF NOT EXISTS `gtg_job` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(20) DEFAULT NULL,
  `job_name` varchar(50) DEFAULT NULL,
  `job_description` varchar(50) DEFAULT NULL,
  `userid` int DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `cname` varchar(150) DEFAULT NULL,
  `clocation` varchar(255) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `ctime` time DEFAULT NULL,
  `cinvoice` int DEFAULT '0',
  `require_date` datetime DEFAULT NULL,
  `status` int DEFAULT '3',
  `created_by` int DEFAULT NULL,
  `action` text,
  `man_days` int DEFAULT NULL,
  `latlon` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_job`
--

INSERT INTO `gtg_job` (`id`, `ref_no`, `job_name`, `job_description`, `userid`, `cid`, `cname`, `clocation`, `cdate`, `ctime`, `cinvoice`, `require_date`, `status`, `created_by`, `action`, `man_days`, `latlon`, `updated_at`, `created_at`) VALUES
(12, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 2, NULL, '2023-02-06 07:31:39', '2023-01-27 11:49:02'),
(13, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(14, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(15, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(16, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-02-07 04:13:37', '2023-01-27 11:49:02'),
(17, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(18, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(19, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(20, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(21, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(22, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(23, NULL, 'test', 'Services', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 2, NULL, '2023-02-07 04:20:55', '2023-01-27 11:49:02'),
(24, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(25, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(26, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(27, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(28, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 504, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(29, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(30, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(31, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(32, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(33, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(34, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(35, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(36, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(37, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(38, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 4, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(39, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(40, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(41, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(42, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(43, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(44, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(45, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(46, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(47, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(48, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(49, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(50, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(51, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, NULL, NULL, 672, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(52, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(53, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(54, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(55, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 336, NULL, '2023-01-27 11:49:02', '2023-01-27 11:49:02'),
(56, NULL, 'test', 'test', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-02-06 05:06:03', '2023-02-06 05:06:03'),
(57, NULL, 'test', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, 2, NULL, '2023-02-06 05:06:24', '2023-02-06 05:06:24'),
(58, NULL, 'Emp’ee', 'Services', 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 672, NULL, '2023-02-06 05:06:37', '2023-02-06 05:06:37'),
(59, NULL, 'Testing GTG', 'Testing M2 complete ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 6, NULL, 4, NULL, '2023-02-20 09:16:15', '2023-02-20 09:16:15'),
(60, NULL, 'title', 'title with description', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-17', '17:09:00', 1, NULL, 1, 6, NULL, 2, NULL, '2023-04-17 11:43:09', '2023-04-17 11:43:09'),
(61, NULL, 'test sytem', 'System have bugs', 3, 12, 'testing1 ', 'first line, city test', '2023-04-18', '16:03:00', 1, NULL, 2, 6, NULL, 2, NULL, '2023-04-18 10:35:14', '2023-04-18 10:34:00'),
(62, NULL, 'test', 'test', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-20', '13:34:00', 1, NULL, 3, 6, NULL, 2, NULL, '2023-04-20 08:05:09', '2023-04-20 08:05:09'),
(63, NULL, 'test', 'tset', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-04-20', '13:36:00', 1, NULL, 3, 6, NULL, 2, NULL, '2023-04-20 08:06:50', '2023-04-20 08:06:50'),
(64, NULL, 'create', 'test', NULL, 11, 'testing ', 'first line, city test', '2023-05-05', '09:30:00', 1, NULL, 3, 6, NULL, 672, NULL, '2023-05-04 09:00:47', '2023-05-04 09:00:47'),
(65, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, 3, 6, NULL, 672, NULL, '2023-05-04 09:03:41', '2023-05-04 09:03:41'),
(66, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, 3, 6, NULL, 672, NULL, '2023-05-04 09:09:43', '2023-05-04 09:09:43'),
(67, NULL, 'test', 'Services', NULL, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, 3, 6, NULL, 672, NULL, '2023-05-04 09:10:11', '2023-05-04 09:10:11'),
(68, NULL, 'test', 'Services', 3, 1, 'Shafeek Ajmal ', '414 Krishna enclave, Zirakpur', '2023-05-05', '08:33:00', 1, NULL, 1, 6, NULL, 672, NULL, '2023-05-04 09:12:15', '2023-05-04 09:10:52'),
(69, NULL, 'Server Update', 'Replace the server', 11, 13, 'Testing2 ', 'Oasis Square', '2023-05-05', '11:00:00', 0, NULL, 1, 6, NULL, 4, NULL, '2023-05-05 10:44:28', '2023-05-05 10:44:01'),
(70, NULL, 'Test', 'Replace the server', 10, 13, 'Testing2 ', 'Oasis Square', '2023-05-05', '18:46:00', 0, NULL, 1, 6, NULL, 4, NULL, '2023-05-05 10:46:51', '2023-05-05 10:46:40'),
(71, NULL, 'Hard Disk Update', 'Upgrade Hard Disk', 11, 13, 'Testing2 ', 'No 40, KL', '2023-05-11', '17:30:00', 0, NULL, 1, 6, NULL, 4, NULL, '2023-05-11 03:35:26', '2023-05-11 03:35:03'),
(72, NULL, 'Server Test', 'Test Server', 11, 13, 'Testing2 ', 'No 40, KL', '2023-05-11', '16:00:00', 1, NULL, 1, 6, NULL, 6, NULL, '2023-05-11 04:03:38', '2023-05-11 04:03:29'),
(73, NULL, 'Customer House Electricity Issue', 'Faccing the electricity ', 3, 14, 'udhayaraja ', 'no 36 anna street, madurai', '2023-05-16', '18:04:00', 1, NULL, 1, 6, NULL, 2, NULL, '2023-05-16 10:36:07', '2023-05-16 10:35:20'),
(74, NULL, 'Server Replacement', 'Replace the server', 10, 13, 'Testing2 ', 'No 40, KL', '2023-05-17', '15:43:00', 1, NULL, 1, 6, NULL, 8, NULL, '2023-05-17 04:42:28', '2023-05-17 04:40:35'),
(75, NULL, 'Hard disk', 'Testing description', 11, 12, 'testing1 ', 'first line, city test', '2023-05-17', '12:44:00', 1, NULL, 2, 6, NULL, 6, NULL, '2023-05-18 08:25:31', '2023-05-17 04:41:42'),
(76, NULL, 'CCTV Fixing', 'Add 2 CCTV', NULL, 13, 'Testing2 ', 'No 40, KL', '2023-05-19', '22:00:00', 1, NULL, 3, 6, NULL, 4, NULL, '2023-05-18 08:41:47', '2023-05-18 08:41:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

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
(27, 74, '<p>Server replacement done</p>', 0, 10, '2023-05-17 04:49:47', '1684298987JPG.jpg', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

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
(13, 75, 'Urgent', 6, '2023-05-18 08:25:31', NULL, 0, 11, NULL, NULL, 'N', '2023-05-18 08:25:31', '2023-05-18 08:25:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=1349 DEFAULT CHARSET=utf8mb3;

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
(1348, '[Logged In] admin@admin.com', '2023-06-06 03:14:28', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=680 DEFAULT CHARSET=utf8mb3;

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
(597, '121.122.100.10', '2023-05-30 04:49:54', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3;

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
(44, 9, 37, '1', NULL, '2023-05-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_movers`
--

INSERT INTO `gtg_movers` (`id`, `d_type`, `rid1`, `rid2`, `rid3`, `d_time`, `note`) VALUES
(1, 1, 1, 10, 0, '2022-04-15 04:12:50', 'Stock Initialized');

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
  `sosco_employer` int NOT NULL,
  `sosco_employee` int NOT NULL,
  `pcb` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `eis` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `accountno` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tax_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_payroll_settings`
--

INSERT INTO `gtg_payroll_settings` (`id`, `staff_id`, `basic_salary`, `epf_percent`, `epf_employee_percent`, `epf_employee`, `epf_employer`, `sosco_employer_percent`, `sosco_employee_percent`, `sosco_employer`, `sosco_employee`, `pcb`, `eis`, `bank`, `accountno`, `nationality`, `tax_no`, `created_at`, `updated_at`) VALUES
(1, 11, 70000, 12, 9, 6300, 8400, 1, 1, 875, 350, '5', '140', 'ICICI', '1130150648', '1', '2342342344', '2023-05-19 11:26:03', '2023-05-19 11:26:03'),
(2, 10, 7000, 12, 11, 770, 840, 1, 1, 88, 35, '0', '14', 'BANK CENTRAL ASIA', '12345678910', '1', '43524234234', '2023-05-22 02:44:32', '2023-05-22 08:34:43'),
(3, 12, 3000, 13, 11, 330, 390, 1, 1, 38, 15, '0', '6', 'Maybank', '12345678910', '1', '12345678', '2023-05-22 02:45:17', '2023-05-22 02:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_payslip`
--

DROP TABLE IF EXISTS `gtg_payslip`;
CREATE TABLE IF NOT EXISTS `gtg_payslip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monthText` varchar(20) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gtg_payslip`
--

INSERT INTO `gtg_payslip` (`id`, `monthText`, `year`, `staffId`, `staffName`, `employeeId`, `designation`, `department`, `salaryMonth`, `epf`, `epfPerc`, `socso`, `pcb`, `allowance`, `claims`, `commissions`, `ot`, `bonus`, `totalEarning`, `totalDeduction`, `datePayment`, `bankName`, `bankAcc`, `netPay`, `payslip`, `paymentVoucher`, `deduction`, `created_at`, `updated_at`) VALUES
(5, 'January', '2023', 10, 'Hariinraj', '10', 'None', 'Operation', '7000.00', '840', 840, '88.00', '0.00', '0', '0', '0', '0', '0', '7000', '819.00', '2023-05-24', 'BANK CENTRAL ASIA', '12345678910', '6181.00', 'P1277767.pdf', NULL, NULL, '2023-05-24 02:42:51', '2023-05-24 02:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `gtg_peppol_invoices`
--

DROP TABLE IF EXISTS `gtg_peppol_invoices`;
CREATE TABLE IF NOT EXISTS `gtg_peppol_invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_sent_date` date NOT NULL,
  `invoice_id` int NOT NULL,
  `invoice_json` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_peppol_invoices`
--

INSERT INTO `gtg_peppol_invoices` (`id`, `invoice_sent_date`, `invoice_id`, `invoice_json`) VALUES
(2, '2023-05-15', 47, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}'),
(3, '2023-05-15', 1, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}'),
(4, '2023-05-15', 11, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}'),
(5, '2023-05-15', 16, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}'),
(6, '2023-05-15', 12, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}'),
(7, '2023-05-15', 12, '{\"legalEntityId\":215184,\"routing\":{\"emails\":[\"sprasad96@gmail.com\"],\"eIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"document\":{\"documentType\":\"invoice\",\"invoice\":{\"invoiceNumber\":\"202112007\",\"issueDate\":\"2021-12-07\",\"documentCurrencyCode\":\"EUR\",\"taxSystem\":\"tax_line_percentages\",\"accountingCustomerParty\":{\"party\":{\"companyName\":\"ManyMarkets Inc.\",\"address\":{\"street1\":\"Street 123\",\"zip\":\"1111AA\",\"city\":\"Here\",\"country\":\"NL\"}},\"publicIdentifiers\":[{\"scheme\":\"NL:KVK\",\"id\":\"60881119\"},{\"scheme\":\"NL:VAT\",\"id\":\"NL123456789B45\"}]},\"invoiceLines\":[{\"description\":\"The things you purchased\",\"amountExcludingVat\":10,\"tax\":{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\"}}],\"taxSubtotals\":[{\"percentage\":0,\"category\":\"reverse_charge\",\"country\":\"NL\",\"taxableAmount\":10,\"taxAmount\":0}],\"paymentMeansArray\":[{\"account\":\"NL50ABNA0552321249\",\"holder\":\"Storecove\",\"code\":\"credit_transfer\"}],\"amountIncludingVat\":10}}}');

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
  `module` enum('Sales','Stock','Crm','Project','Accounts','Miscellaneous','Employees','Assign Project','Customer Profile','Reports','Delete','POS','Sales Edit','Stock Edit','Jobsheet Admin','My Jobs','Jobsheet Report','Payroll','Setting','Permission','Expenses','Expenses Manager','Pay Run','Pay Run Manager','Attendance','Attendance Manager') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `r_1` int NOT NULL,
  `r_2` int NOT NULL,
  `r_3` int NOT NULL,
  `r_4` int NOT NULL,
  `r_5` int NOT NULL,
  `r_6` int NOT NULL,
  `r_7` int NOT NULL,
  `r_8` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_premissions`
--

INSERT INTO `gtg_premissions` (`id`, `module`, `r_1`, `r_2`, `r_3`, `r_4`, `r_5`, `r_6`, `r_7`, `r_8`) VALUES
(1, 'Sales', 0, 1, 1, 1, 1, 1, 0, 0),
(2, 'Stock', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Crm', 0, 0, 1, 1, 1, 0, 0, 0),
(4, 'Project', 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Accounts', 0, 0, 0, 0, 1, 0, 0, 0),
(6, 'Miscellaneous', 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Assign Project', 0, 0, 0, 0, 1, 0, 0, 0),
(8, 'Customer Profile', 0, 1, 1, 0, 1, 0, 0, 0),
(9, 'Employees', 0, 1, 0, 0, 1, 1, 0, 0),
(10, 'Reports', 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'Delete', 1, 1, 1, 1, 1, 1, 0, 0),
(12, 'POS', 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'Sales Edit', 1, 1, 1, 1, 1, 0, 0, 0),
(14, 'Stock Edit', 1, 1, 1, 1, 1, 1, 1, 1),
(15, 'Jobsheet Admin', 0, 0, 0, 1, 1, 0, 0, 0),
(16, 'My Jobs', 0, 1, 0, 1, 1, 1, 0, 0),
(17, 'Jobsheet Report', 0, 0, 0, 1, 1, 1, 0, 0),
(18, 'Payroll', 0, 0, 0, 0, 1, 0, 0, 0),
(19, 'Setting', 0, 0, 0, 0, 1, 0, 0, 0),
(20, 'Permission', 0, 0, 0, 0, 1, 0, 0, 0),
(21, 'Expenses', 0, 1, 1, 0, 1, 0, 0, 0),
(22, 'Expenses Manager', 0, 0, 0, 0, 1, 0, 0, 0),
(23, 'Pay Run', 0, 1, 0, 0, 1, 1, 0, 0),
(24, 'Pay Run Manager', 0, 1, 0, 0, 1, 1, 0, 0),
(25, 'Attendance', 1, 1, 1, 1, 1, 1, 1, 1),
(26, 'Attendance Manager', 0, 1, 0, 0, 1, 1, 0, 0);

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
  PRIMARY KEY (`pid`),
  KEY `pcat` (`pcat`),
  KEY `warehouse` (`warehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_products`
--

INSERT INTO `gtg_products` (`pid`, `pcat`, `warehouse`, `product_name`, `product_code`, `product_price`, `fproduct_price`, `taxrate`, `disrate`, `qty`, `product_des`, `alert`, `unit`, `image`, `barcode`, `merge`, `sub`, `vb`, `expiry`, `code_type`, `sub_id`, `b_id`) VALUES
(1, 3, 1, 'AVT tea', '00165', '30.00', '19.00', '5.00', '0.00', '0.00', '', 2, '', 'default.png', '0013221', 0, 0, 0, NULL, 'EAN13', 4, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_product_cat`
--

INSERT INTO `gtg_product_cat` (`id`, `title`, `extra`, `c_type`, `rel_id`) VALUES
(1, 'General', 'General Cat', 0, 0),
(2, 'coffee shop', 'coffee shop', 0, 0),
(3, 'supermarket', 'supermarket', 0, 0),
(4, 'tea ', 'tea ', 1, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_projects`
--

INSERT INTO `gtg_projects` (`id`, `p_id`, `name`, `status`, `priority`, `progress`, `cid`, `sdate`, `edate`, `tag`, `phase`, `note`, `worth`, `ptype`) VALUES
(1, '', 'KLSICCI MITRA', 'Progress', 'High', 31, 0, '2022-12-21', '2023-01-06', 'KLSICCI MITRA', 'Phase 1', '', '0.00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_project_meta`
--

INSERT INTO `gtg_project_meta` (`id`, `pid`, `meta_key`, `meta_data`, `value`, `key3`, `key4`) VALUES
(1, 1, 12, NULL, '[Project Created]  @2022-12-23 10:06:11', NULL, 0),
(2, 1, 2, 'false', 'false', NULL, 0),
(3, 1, 19, '6', NULL, NULL, 0);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_purchase`
--

INSERT INTO `gtg_purchase` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `loc`, `multi`) VALUES
(1, 1001, '2022-04-15', '2022-04-15', '19.95', '0.00', '0.00', 'incl', '0.00', '0.95', '19.95', NULL, '', 'due', 1, 6, '0.00', '1.00', 'yes', 1, '%', '', 1, 0, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_purchase_items`
--

INSERT INTO `gtg_purchase_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `unit`) VALUES
(1, 1, 1, 'AVT tea', '00165', '1.00', '19.00', '5.00', '0.00', '19.95', '0.95', '0.00', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_quotes`
--

INSERT INTO `gtg_quotes` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `ship_tax`, `ship_tax_type`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `proposal`, `multi`, `loc`) VALUES
(1, 1001, '2022-11-01', '2022-12-01', '6360.00', '0.00', '0.00', 'incl', '0.00', '360.00', '6360.00', NULL, 'Testing ', 'accepted', 2, 13, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>testing&nbsp;</p>', NULL, 0),
(3, 1002, '2023-04-05', '2023-05-05', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 10, 3, '0.00', '1.00', 'incl', 1, '%', '43243', 1, '<p>test</p>', NULL, 0),
(4, 1003, '2023-05-09', '2023-06-08', '100.00', '0.00', '0.00', 'incl', '0.00', '0.00', '100.00', NULL, '', 'pending', 14, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>Test</p><p>test</p>', NULL, 0),
(5, 1004, '2023-05-31', '2023-06-30', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 13, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '<p>Test DEV</p>', NULL, 0),
(6, 1005, '2023-05-31', '2023-06-30', '1.00', '0.00', '0.00', 'incl', '0.00', '0.00', '1.00', NULL, '', 'pending', 11, 1, '0.00', '1.00', 'yes', 1, '%', '', 1, '', NULL, 0);

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
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_quotes_items`
--

INSERT INTO `gtg_quotes_items` (`id`, `tid`, `pid`, `product`, `code`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`, `unit`) VALUES
(1, 1, 0, 'Software', '', '1.00', '6000.00', '6.00', '0.00', '6360.00', '360.00', '0.00', 'POS', ''),
(2, 3, 0, 'test product', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', 'test', ''),
(3, 4, 0, 'Reconnection', '', '1.00', '100.00', '0.00', '0.00', '100.00', '0.00', '0.00', 'Reconnection Charges \"kkkm.my\"', ''),
(4, 5, 0, 'DEV TEST', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', ''),
(5, 6, 0, 'DEV 2', '', '1.00', '1.00', '0.00', '0.00', '1.00', '0.00', '0.00', '', '');

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
(4, 6, '2022-11-01 09:56:01', '0000-00-00 00:00:00', '257.50', '0.00', '0.00', '0.00', '0.00', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_supplier`
--

INSERT INTO `gtg_supplier` (`id`, `name`, `phone`, `address`, `city`, `region`, `country`, `postbox`, `email`, `picture`, `gid`, `company`, `taxid`, `loc`) VALUES
(1, 'rahul', '9841204881', '', '', '', '', '', 'salesperson@abc.om', 'example.png', 1, 'reno', '', 0);

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
(1, 'JSOFT SOLUTION SDN BHD', '16-03-C', 'Ara Damansara', 'Petaling Jaya ', 'Malaysia ', '47320', '0125509210', 'ajmal@jsoftsolution.com.my', 'JSX003456', -1, 'MYR', 0, 'SRN', 1, 'Etc/Greenwich', '1685513389420555249.png', 'english', '2022-04-14');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_terms`
--

INSERT INTO `gtg_terms` (`id`, `title`, `type`, `terms`) VALUES
(1, 'Payment On Receipt', 0, '<p>1. 10% discount if payment received within ten days otherwise payment 30 days\n            after invoice date<br></p>');

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
  `ext` int DEFAULT '0',
  `loc` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `loc` (`loc`),
  KEY `acid` (`acid`),
  KEY `eid` (`eid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_transactions`
--

INSERT INTO `gtg_transactions` (`id`, `acid`, `account`, `type`, `cat`, `debit`, `credit`, `payer`, `payerid`, `method`, `date`, `tid`, `eid`, `note`, `ext`, `loc`) VALUES
(1, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1900.00', 'Walk-in Client', 1, 'Cash', '2023-02-10', 2, 6, 'Payment for invoice #1002', 0, 0),
(2, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Walk-in Client', 1, 'Card', '2023-02-13', 1, 6, 'Payment for invoice #1001', 0, 0),
(3, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Card', '2023-02-23', 3, 3, 'Card Payment for #1003', 0, 0),
(4, 1, 'Sales Account', 'Income', 'Sales', '0.00', '99.00', 'Shafeek Ajmal', 1, 'Card', '2023-02-23', 3, 3, 'Card Payment for #1003', 0, 0),
(5, 1, 'Sales Account', 'Income', 'Sales', '0.00', '99.00', 'Shafeek Ajmal', 1, 'Card', '2023-03-10', 3, 3, 'Card Payment for #1003', 0, 0),
(6, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.50', 'Shafeek Ajmal', 1, 'Balance', '2023-03-13', 1, 6, 'Payment for invoice #1001', 0, 0),
(7, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01 customer note:Payment for invoice #1001', 0, 0),
(8, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01 customer note:test', 0, 0),
(9, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01  customer note:final', 0, 0),
(10, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001 amount: 0.01  customer note:final', 0, 0),
(11, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', 0, 0),
(12, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', 0, 0),
(13, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.01  customer note:final', 0, 0),
(14, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.43', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 1, 2, 'Wallet Payment for invoice #1001, amount: 0.43  customer note:Payment for invoice #1001', 0, 0),
(15, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-13', 5, 3, 'Wallet Payment for invoice #1005, amount: 0.01  customer note:Payment for invoice #1005', 0, 0),
(16, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Card', '2023-03-13', 5, 3, 'Card for #SRN1005 by ipay88 transid:T184069815623', 0, 0),
(17, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Shafeek Ajmal', 1, 'Wallet Payment', '2023-03-14', 5, 3, 'Wallet Payment for invoice #1005, amount: 01  customer note:Payment for invoice #1005', 0, 0),
(18, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Shafeek Ajmal', 1, 'Wallet', '2023-03-21', 5, 3, 'Wallet for invoice #1005, amount: 0.01  customer note:Payment for invoice #1005', 0, 0),
(19, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Jsoftsolution', 10, 'Wallet', '2023-03-21', 4, 3, 'Wallet for invoice #1004, amount: 0.01  customer note:Payment for invoice #1004', 0, 0),
(20, 1, 'Sales Account', 'Income', 'Sales', '0.00', '0.01', 'Jsoftsolution', 10, 'Wallet', '2023-03-21', 4, 3, 'Wallet for invoice #1004, amount: 0.01  customer note:Payment for invoice #1004', 0, 0),
(21, 1, 'Sales Account', 'Income', 'Sales', '0.00', '5.00', 'Shafeek Ajmal', 1, 'Wallet', '2023-05-12', 24, 1, 'Wallet for invoice #1024, amount: 5.00  customer note:Payment for invoice #1024', 0, 0),
(22, 1, 'Sales Account', 'Income', 'Sales', '0.00', '42.00', 'Testing2', 13, 'Wallet', '2023-05-17', 22, 1, 'Wallet for invoice #1022, amount: 42.00  customer note:Payment for invoice #1022', 0, 0),
(23, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Testing2', 13, 'Maybank2U', '2023-05-17', 27, 1, 'Maybank2U for #SRN1027 by ipay88 transid:T195717025523', 0, 0),
(25, 1, 'Sales Account', 'Income', 'Sales', '0.00', '157.50', 'Shafeek Ajmal', 1, 'Cash', '2023-05-18', 31, 1, '#1001-Cash', 0, 0),
(26, 1, 'Sales Account', 'Income', 'Sales', '0.00', '1.00', 'Testing2', 13, 'Maybank2U', '2023-05-31', 27, 1, 'Maybank2U for #SRN1027 by ipay88 transid:T198480583823', 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_users`
--

INSERT INTO `gtg_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`, `loc`, `lang`, `login_status`) VALUES
(1, 'testing@gmail.com', '6bb5b4afb231da6a4c8439e5b9b967ec7a1faf47f31f4a743fa8ef5735c55e62', 'testing', 0, '2023-05-16 01:03:17', '2023-05-16 01:03:17', '2023-01-29 20:06:02', NULL, NULL, NULL, NULL, NULL, '113.211.101.190', 5, '16806759151426990786.png', 0, 'english', 0),
(2, 'ajmal@jsoftsolution.com.my', 'd731388dbab6b50e80f4d5e321ad8321882d33cb059b1ff78d3b76e7ee45d8a7', 'ajmal', 0, '2023-04-05 05:10:13', '2023-04-05 05:10:13', '2023-02-02 08:31:56', NULL, NULL, NULL, NULL, NULL, '::1', 4, '16806759601486794664.png', 0, 'english', 0),
(3, 'abcd@gmail.com', '806dab78bc80fbba11525a6deb0a1f274887acb4259edbea20e819ea02db896f', 'abcd', 0, '2023-05-16 10:46:48', '2023-05-16 10:46:48', '2023-02-05 12:37:38', NULL, NULL, NULL, NULL, NULL, '45.118.158.76', 2, '1680675853738705439.png', 0, 'english', 0),
(4, 'myname@gmail.com', '0e96cb6a17904976a393e6b54097caaab59fb674da027f9f03efc16c09007711', 'myname', 0, '2023-05-03 04:42:06', '2023-05-03 04:42:06', '2023-03-14 07:31:37', NULL, NULL, NULL, NULL, NULL, '::1', 4, '16806759931752597390.png', 0, 'english', 0),
(6, 'admin@admin.com', '3913228818759cd846b475d3106a4ecc9bf9bd91746cab4e88a8750c11d15914', 'admin', 0, '2023-06-06 03:14:28', '2023-06-06 03:14:28', '2022-04-14 11:35:34', NULL, '2023-05-21 00:00:00', 'KZrhtq8c0vxNBlPF', '', NULL, '203.109.75.80', 5, '1667294757148617952.jpeg', 0, 'english', 0),
(7, 'salesperson@abc.om', '3ed55a7943024f5fdf89c6aeb593c6622463e980e97f6f201f91ae5f30f42f99', 'salesperson', 0, '2022-04-15 03:48:18', '2022-04-15 03:48:19', '2022-04-15 03:34:03', NULL, NULL, NULL, NULL, NULL, '::1', 1, 'example.png', 0, 'english', 0),
(8, 'krish@jsoftsolution.com.my', '90e002a56457d390a2ddbddf807135a242d3d7bace8ddd9e7350cfa086c53c48', 'krish', 0, '2022-11-02 03:53:04', '2022-11-02 03:53:04', '2022-11-01 07:37:14', NULL, NULL, NULL, NULL, NULL, '2001:d08:2297:282d:26:1694:74b0:b196', 3, '16672918891901802524.jpeg', 0, 'english', 0),
(9, 'raj@jsoftsolution.com.my', '660807946ad1865ba31d990c14dce2a5af394a19a69cdb830db743806df5202a', 'raj', 0, '2023-01-23 05:32:17', '2023-01-23 05:32:17', '2022-12-23 10:34:36', NULL, NULL, NULL, NULL, NULL, '::1', 4, 'example.png', 0, 'english', 0),
(10, 'hariinraj29@yahoo.com', 'b7e185512c047ad01cc0a2a21141c97c7aa06977e9f0c271ec997a392b9c2986', 'hariinraj29', 0, '2023-05-17 04:44:25', '2023-05-17 04:44:25', '2023-05-05 10:27:35', NULL, NULL, NULL, NULL, NULL, '121.123.244.7', 5, 'example.png', 0, 'english', 0),
(11, 'testingjsoft@gmail.com', '84042bb415fefb8be3b833354b6f1d4d7c79825e48e1214901e1c20b167d0eab', 'Prabhat', 0, '2023-06-06 03:13:09', '2023-06-06 03:13:09', '2023-05-05 10:37:35', NULL, NULL, NULL, NULL, NULL, '121.122.100.219', -1, 'example.png', 0, 'english', 0),
(12, 'reena@yahoo.com', '0a198c1b085a2bda80299c1cfa0eba8105744725cd93bd5903f31905b6843bc5', 'Treena', 0, '2023-05-31 12:52:52', '2023-05-31 12:52:52', '2023-05-11 04:12:12', NULL, NULL, NULL, NULL, NULL, '113.210.86.115', 2, 'example.png', 0, 'english', 1),
(13, 'udhay@gmail.com', '45a914b5af15e892513901f4508a290c1137d1d54106a16f6ee675659111f642', 'Udhay', 0, '2023-05-31 07:40:08', '2023-05-31 07:40:08', '2023-05-24 04:37:10', NULL, NULL, NULL, NULL, NULL, '121.122.100.175', -1, 'example.png', 0, 'english', 0);

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
-- Table structure for table `publishing_activity`
--

DROP TABLE IF EXISTS `publishing_activity`;
CREATE TABLE IF NOT EXISTS `publishing_activity` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `SessionId` text COLLATE utf8mb4_general_ci NOT NULL,
  `ItemId` text COLLATE utf8mb4_general_ci NOT NULL,
  `ThirdPartyVenderId` text COLLATE utf8mb4_general_ci NOT NULL,
  `MerchantId` text COLLATE utf8mb4_general_ci NOT NULL,
  `CityId` text COLLATE utf8mb4_general_ci NOT NULL,
  `LocationId` text COLLATE utf8mb4_general_ci NOT NULL,
  `SegmentId` text COLLATE utf8mb4_general_ci NOT NULL,
  `SubSegmentId` text COLLATE utf8mb4_general_ci NOT NULL,
  `ActionType` text COLLATE utf8mb4_general_ci NOT NULL,
  `Action` text COLLATE utf8mb4_general_ci NOT NULL,
  `PreviousValue` text COLLATE utf8mb4_general_ci NOT NULL,
  `NewValue` text COLLATE utf8mb4_general_ci NOT NULL,
  `Query` text COLLATE utf8mb4_general_ci NOT NULL,
  `CrDate` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `run_scheduler_expiry_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `module` int NOT NULL,
  `scheduler_on` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `minutes` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hours` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Schdeuleno_days` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `run_scheduler_expiry_date`, `module`, `scheduler_on`, `minutes`, `hours`, `days`, `month`, `day`, `Schdeuleno_days`, `status`) VALUES
(1, 'yes', 1, '1,2', '', '', '1-90', '', '', '', 0),
(2, 'no', 0, '', '0-59', '0-23', '', '0-12', '1-7', '1-30', 0),
(3, 'yes', 5, '2', '', '', '1-90', '', '', '', 0),
(4, 'yes', 1, '2', '', '', '1-90', '', '', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;

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
(9, 'Invoice payment Received', '{Company} Payment Received for Invoice #{BillNumber}', NULL, NULL, NULL, '<p>\n            Dear Client,\r\n</p><p>We are contacting you in regard to a payment received for invoice # {BillNumber} that\n            has been created on your account. You can find the invoice with below link.\r\n</p><p>\r\nView Invoice</p>\n        <p>\r\n{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind\n            Regards,\r\n</p><p>\r\nTeam\r\n</p><p>\r\n{CompanyDetails}</p>', NULL),
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
(64, 'FrontEndSection', '0', '0', '0', '0', '0', 0),
(65, 'Dual Entry', '0', '1', '0', '0', '0', 0),
(66, 'Email Alert', '1', '0', 'sample@email.com', '0', '', 0),
(67, 'billing_settings', '0', '0', NULL, NULL, NULL, NULL),
(69, 'pos_settings', '1', NULL, NULL, NULL, NULL, NULL),
(70, 'DB-B-150', '4a99003dd3aa27b87fabfa153f1ab06a2ff08c3d', NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`, `cid`, `lang`, `code`) VALUES
(1, '1', NULL, 'active', '0', 'Shafeek Ajmal', '$2y$10$roTfh0rBVFny.r2EX74DNuZ1Y/MLmg3hf9Wfsk0OX/zdQkyNUOh8C', 'shafee@gmail.com', 'cutsm_upl_1678713658.jpg', 'Member', 1, 'english', NULL),
(6, '1', NULL, 'active', '0', 'Jsoftsolution', '$2y$10$0fUaa9cxhqPbpABQFqS/wO2.9.36ct1AIUHjJwWto2Ixa0b4FY6Je', 'shafeekajmal@hotmail.com', NULL, 'Member', 10, 'english', NULL),
(7, '1', NULL, 'active', '0', 'testing', '$2y$10$He1kYJT5/0YAs51RHrfDse7DdoqPSrh0oG3qglPSUkk/6rqolJBpC', 'testing@yahoo.com', NULL, 'Member', 11, '', NULL),
(8, '1', NULL, 'active', '0', 'testing1', '$2y$10$M7yFesvFQ2F6fmfGbwFLeOJgeqFQEuPO.JldlYLalC8BHQukCcYSq', 'testing1@yahoo.com', NULL, 'Member', 12, '', NULL),
(9, '1', NULL, 'active', '0', 'Testing2', '$2y$10$FI8q5LKHxxLHcAah6ZTPaOPUGD/w1L3X2Qi7QaV9H5uqmkbCnCs/C', 'testingjsoft@gmail.com', NULL, 'Member', 13, '', NULL),
(10, '1', NULL, 'active', '0', 'udhayaraja', '$2y$10$kZhCUz1rwtFHzWC1xDj.KO/TmQ3Lk/zzH442EzAo4EYRlxVIF/RKG', 'udhayase@gmail.com', NULL, 'Member', 14, 'english', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
