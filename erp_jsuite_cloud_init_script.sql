-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2023 at 03:02 PM
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
-- Database: `erp_latest_changes`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0d815a636150deec75a16cf23fe95ecdbbcc1ced', '2001:d08:d2:57ef:bc3a:bbb7:851a:f982', 1702973314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323937333331313b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b),
('4dccf6f23e7281af7cb5af456c2ecc56839f04b8', '2001:d08:d2:57ef:bc3a:bbb7:851a:f982', 1702971784, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323937313738343b);

-- --------------------------------------------------------

--
-- Table structure for table `digital_marketing_settings`
--

DROP TABLE IF EXISTS `digital_marketing_settings`;
CREATE TABLE IF NOT EXISTS `digital_marketing_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` text COLLATE utf8mb4_general_ci NOT NULL,
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
  `type` text COLLATE utf8mb4_general_ci NOT NULL,
  `customer_source` text COLLATE utf8mb4_general_ci NOT NULL,
  `customer_ids` text COLLATE utf8mb4_general_ci NOT NULL,
  `subject` text COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
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
  `tfrom` time NOT NULL,
  `tto` time DEFAULT NULL,
  `note` int DEFAULT NULL,
  `actual_hours` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp` (`emp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(2, 2, 'no', '10', 'inclusive', 'yes', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_contract`
--

DROP TABLE IF EXISTS `gtg_contract`;
CREATE TABLE IF NOT EXISTS `gtg_contract` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `client_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `reminder_date` date NOT NULL,
  `remarks` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('PENDING','INPROGRESS','COMPLETED') COLLATE utf8mb4_general_ci NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_link` text COLLATE utf8mb4_general_ci NOT NULL,
  `contract_unique_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `sharing_count` int NOT NULL,
  `client_id` int NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

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
(1, 'Default Group', 'Default Group', NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_digital_signature_signings`
--

DROP TABLE IF EXISTS `gtg_digital_signature_signings`;
CREATE TABLE IF NOT EXISTS `gtg_digital_signature_signings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ds_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `signed_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` text COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_documents`
--

DROP TABLE IF EXISTS `gtg_documents`;
CREATE TABLE IF NOT EXISTS `gtg_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `filename` text,
  `cdate` date NOT NULL,
  `permission` int DEFAULT NULL,
  `cid` int NOT NULL,
  `fid` int NOT NULL,
  `rid` int NOT NULL,
  `complaintid` varchar(250) DEFAULT '0',
  `userid` int DEFAULT NULL,
  `contract_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_do_relations`
--

DROP TABLE IF EXISTS `gtg_do_relations`;
CREATE TABLE IF NOT EXISTS `gtg_do_relations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'invoice,po,do',
  `do_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `po_id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `parent_do_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_do_id` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `cdate` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `passport` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `permit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `passport_expiry` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `permit_expiry` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `passport_document` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `visa_document` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL,
  `passport_email_sent` int NOT NULL,
  `permit_email_sent` int NOT NULL,
  `gender` text COLLATE utf8mb4_general_ci NOT NULL,
  `socso_number` text COLLATE utf8mb4_general_ci NOT NULL,
  `kwsp_number` text COLLATE utf8mb4_general_ci NOT NULL,
  `pcb_number` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_expenses_cat`
--

DROP TABLE IF EXISTS `gtg_expenses_cat`;
CREATE TABLE IF NOT EXISTS `gtg_expenses_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_fws_documents`
--

DROP TABLE IF EXISTS `gtg_fws_documents`;
CREATE TABLE IF NOT EXISTS `gtg_fws_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_log`
--

INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(1, '[Logged In] admin@admin.com', '2023-12-19 07:56:52', ''),
(2, '[Logged Out] ', '2023-12-19 07:59:46', ''),
(3, '[Logged In] admin@admin.com', '2023-12-19 08:01:31', ''),
(4, '[Logged Out] admin', '2023-12-19 08:01:36', ''),
(5, '[Logged In] admin@admin.com', '2023-12-19 08:02:11', ''),
(6, '[Logged Out] admin', '2023-12-19 08:07:21', ''),
(7, '[Logged In] admin@admin.com', '2023-12-19 08:07:24', ''),
(8, '[Logged Out] admin', '2023-12-19 08:07:32', ''),
(9, '[Logged In] admin@admin.com', '2023-12-19 08:08:06', ''),
(10, '[Logged Out] admin', '2023-12-19 08:08:12', ''),
(11, '[Logged In] admin@admin.com', '2023-12-19 08:08:22', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_login_attempts`
--

INSERT INTO `gtg_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(1, '2001:d08:d2:57ef:bc3a:bbb7:851a:f982', '2023-12-19 07:46:51', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `evidence_json` text COLLATE utf8mb4_general_ci NOT NULL,
  `document_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `document_expire_date` text COLLATE utf8mb4_general_ci NOT NULL,
  `guid` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_referral`
--

DROP TABLE IF EXISTS `gtg_referral`;
CREATE TABLE IF NOT EXISTS `gtg_referral` (
  `id` int NOT NULL AUTO_INCREMENT,
  `referral_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reffered_by` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `delete_status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Table structure for table `gtg_role`
--

DROP TABLE IF EXISTS `gtg_role`;
CREATE TABLE IF NOT EXISTS `gtg_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `delete_status` int NOT NULL,
  `all_data_previleges` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_role`
--

INSERT INTO `gtg_role` (`id`, `role_name`, `status`, `delete_status`, `all_data_previleges`) VALUES
(1, 'Inventory Manager', 1, 0, 0),
(2, 'Sales Person', 1, 0, 1),
(3, 'Sales Manager', 1, 0, 1),
(4, 'ADMIN', 1, 0, 1),
(5, 'Business Owner', 1, 0, 1),
(6, 'Project Manager', 1, 0, 1),
(7, 'Marketing ', 1, 0, 1),
(8, 'General Workers', 1, 0, 1),
(14, 'jkdddd', 1, 0, 1),
(15, 'ssss', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gtg_schedular_sub_modules`
--

DROP TABLE IF EXISTS `gtg_schedular_sub_modules`;
CREATE TABLE IF NOT EXISTS `gtg_schedular_sub_modules` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(1, 'JSOFT SOLUTION SDN BHD', '16-03-C', 'Ara Damansara', 'Petaling Jaya ', 'Malaysia ', '47320', '0125509210', 'sprasad96@gmail.com', 'JSX003456', -1, 'MYR', 0, 'JS', 1, 'Asia/Kuala_Lumpur', '1685513389420555249.png', 'english', '2022-04-14');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gtg_trans_cat`
--

DROP TABLE IF EXISTS `gtg_trans_cat`;
CREATE TABLE IF NOT EXISTS `gtg_trans_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upload_date` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_users`
--

INSERT INTO `gtg_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`, `loc`, `lang`, `login_status`) VALUES
(6, 'admin@admin.com', '3913228818759cd846b475d3106a4ecc9bf9bd91746cab4e88a8750c11d15914', 'admin', 0, '2023-12-19 08:08:22', '2023-12-19 08:08:22', '2022-04-14 11:35:34', NULL, '2023-11-25 00:00:00', '7yLXH9v4VFEpZO0B', '', NULL, '2001:d08:d2:57ef:bc3a:bbb7:851a:f982', 5, '1667294757148617952.jpeg', 0, 'english', 0);

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
  `ThirdPartyVendorItemId` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `CityId` int NOT NULL,
  `LocationId` int NOT NULL,
  `SegmentId` int NOT NULL,
  `SubSegmentId` int NOT NULL,
  `Price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SegmentStatus` int NOT NULL DEFAULT '0',
  `ItemStatus` int NOT NULL DEFAULT '1',
  `CrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_thirdparty_vendors`
--

DROP TABLE IF EXISTS `merchant_thirdparty_vendors`;
CREATE TABLE IF NOT EXISTS `merchant_thirdparty_vendors` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `VendorName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` int NOT NULL DEFAULT '1',
  `CrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebSiteUrl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ConsumerKey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ConsumerSecret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebSiteType` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `PlatformType` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

DROP TABLE IF EXISTS `scheduler`;
CREATE TABLE IF NOT EXISTS `scheduler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `run_scheduler_expiry_date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module` int NOT NULL,
  `scheduler_on` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `minutes` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hours` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Schdeuleno_days` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_to` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(36, 37, 40),
(37, 36, 41),
(38, 41, 42),
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
(170, 136, 200);

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
  `r_17` int DEFAULT '0',
  `r_14` int NOT NULL DEFAULT '0',
  `r_15` int NOT NULL DEFAULT '0',
  `r_16` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sidebaritems`
--

INSERT INTO `sidebaritems` (`id`, `parent_id`, `title`, `url`, `icon`, `permissions`, `type`, `status`, `display_order`, `module_type`, `r_1`, `r_2`, `r_3`, `r_4`, `r_5`, `r_6`, `r_7`, `r_8`, `cr_date`, `subscription_status`, `r_17`, `r_14`, `r_15`, `r_16`) VALUES
(1, 0, 'Dashboard', 'dashboard', 'icon-speedometer', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 05:48:10', 1, 0, 0, 0, 1),
(2, 0, 'Sales', ' ', 'icon-basket-loaded', NULL, 'Sidebar', 'Active', 2, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:49:41', 1, 1, 0, 0, 1),
(3, 2, 'Quotes', ' ', 'icon-call-out', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:51:50', 0, 1, 0, 0, 1),
(4, 0, 'New Quote', 'quote/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:55:09', 0, 1, 0, 0, 1),
(5, 0, 'Manage Quotes', 'quote', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:55:57', 0, 1, 0, 0, 1),
(6, 2, 'Invoices', ' ', 'icon-basket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 05:57:20', 0, 1, 0, 0, 1),
(7, 6, 'New Invoice', 'invoices/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 06:01:11', 0, 1, 0, 0, 1),
(8, 6, 'Manage Invoices', 'invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 06:02:00', 0, 1, 0, 0, 1),
(9, 6, 'Peppol Invoices', 'invoices/peppol_invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:17:55', 0, 1, 0, 0, 1),
(10, 2, 'Pos Invoices', '', 'icon-paper-plane', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:19:58', 0, 1, 0, 0, 1),
(11, 10, 'New Pos Invoice', 'pos_invoices/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:23:16', 0, 1, 0, 0, 1),
(12, 10, 'Manage Pos Invoices', 'pos_invoices', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 0, 1, 0, 0, 0, '2023-09-29 06:23:56', 0, 1, 0, 0, 1),
(13, 2, 'Subscriptions', '', 'ft-radio', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:25:41', 0, 1, 0, 0, 1),
(14, 13, 'New Subscription', 'subscriptions/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:26:52', 0, 1, 0, 0, 1),
(15, 13, 'Subscriptions', 'subscriptions', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:28:24', 0, 1, 0, 0, 1),
(16, 2, 'Credit Notes', 'stockreturn/creditnotes', 'icon-screen-tablet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 06:29:28', 0, 1, 0, 0, 1),
(17, 0, 'Stock', '', 'ft-layers', NULL, 'Sidebar', 'Active', 3, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:32:59', 1, 1, 0, 0, 1),
(18, 17, 'Items Manager', '', 'ft-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:35:39', 0, 1, 0, 0, 1),
(19, 18, 'New Product', 'products/add', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:36:41', 0, 1, 0, 0, 1),
(20, 18, 'Manage Products', 'products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:37:29', 0, 1, 0, 0, 1),
(21, 17, 'Product Categories', 'productcategory', 'ft-umbrella', NULL, 'Subheading', 'Active', 2, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:38:39', 0, 1, 0, 0, 1),
(22, 17, 'WareHouses', 'productcategory/warehouse', 'ft-sliders', NULL, 'Subheading', 'Active', 4, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:41:33', 0, 1, 0, 0, 1),
(23, 17, 'Stock Transfer', 'products/stock_transfer', 'ft-wind', NULL, 'Subheading', 'Active', 5, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:42:07', 0, 1, 0, 0, 1),
(24, 194, 'Purchase Order', '', 'icon-handbag', NULL, 'Subheading', 'Active', 2, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:42:40', 0, 1, 0, 0, 1),
(25, 24, 'New Order', 'purchase/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:43:16', 0, 1, 0, 0, 1),
(26, 24, 'Manage Orders', 'purchase', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:43:50', 0, 1, 0, 0, 1),
(27, 194, 'Stock Return', '', 'icon-puzzle', NULL, 'Subheading', 'Active', 5, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:48:39', 0, 1, 0, 0, 1),
(28, 27, 'Supplier Records', 'stockreturn', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:49:12', 0, 1, 0, 0, 1),
(29, 27, 'Customer Records', 'stockreturn/customer', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:02', 0, 1, 0, 0, 1),
(30, 194, 'Suppliers', '', 'ft-target', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:22', 0, 1, 0, 0, 1),
(31, 30, 'New Supplier', 'supplier/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:50:49', 0, 1, 0, 0, 1),
(32, 30, 'Manage Suppliers', 'supplier', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:51:23', 0, 1, 0, 0, 1),
(33, 17, 'Products Label', '', 'fa fa-barcode', NULL, 'Subheading', 'Active', 3, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:51:49', 0, 1, 0, 0, 1),
(34, 33, 'Custome Label', 'products/custom_label', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:52:43', 0, 1, 0, 0, 1),
(35, 33, 'Standard Label', 'products/standard_label', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 06:53:06', 0, 1, 0, 0, 1),
(36, 0, 'Job Sheet', '', 'icon-diamond', NULL, 'Sidebar', 'Active', 5, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 07:00:22', 1, 1, 0, 0, 1),
(37, 36, 'Task Manager', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:01:47', 0, 0, 0, 0, 1),
(38, 37, 'Create Task', 'jobsheets/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:02:54', 0, 0, 0, 0, 1),
(39, 37, 'View Task', 'jobsheets', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:03:34', 0, 0, 0, 0, 1),
(40, 37, 'Reports', 'jobsheets/reports', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:04:47', 0, 0, 0, 0, 1),
(41, 36, 'My Task', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 07:05:13', 0, 1, 0, 0, 1),
(42, 41, 'Task List', 'jobsheets/myjobs', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-09-29 07:06:04', 0, 1, 0, 0, 1),
(43, 0, 'CRM', '', 'ft-users', NULL, 'Sidebar', 'Active', 6, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:10:18', 1, 0, 0, 0, 1),
(44, 43, 'Clients', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:11:20', 0, 0, 0, 0, 1),
(45, 44, 'New Client', 'customers/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:12:59', 0, 0, 0, 0, 1),
(46, 44, 'Manage Clients', 'customers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:13:25', 0, 0, 0, 0, 1),
(47, 43, 'Client groups', 'clientgroup', 'icon-grid', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:14:32', 0, 0, 0, 0, 1),
(48, 43, 'Support Tickets', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:15:05', 0, 0, 0, 0, 1),
(49, 48, 'UnSolved', 'tickets/?filter=unsolved', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:15:56', 0, 0, 0, 0, 1),
(50, 48, 'Manage Tickets', 'tickets', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:16:48', 0, 0, 0, 0, 1),
(51, 0, 'File Manager', '', 'fa fa-folder-o', NULL, 'Sidebar', 'Active', 7, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:17:54', 1, 0, 0, 0, 0),
(52, 51, 'My Drive', 'filemanager', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:19:01', 0, 0, 0, 0, 0),
(53, 51, 'Shared Folders', 'filemanager/sharedfolders', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:19:33', 0, 0, 0, 0, 0),
(54, 51, 'Shared Files', 'filemanager/sharedfiles', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:20:04', 0, 0, 0, 0, 0),
(55, 0, 'Project', '', 'icon-briefcase', NULL, 'Sidebar', 'Active', 8, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:34:39', 1, 0, 0, 0, 0),
(56, 55, 'Project Management', '', 'icon-calendar', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:36:52', 0, 0, 0, 0, 0),
(57, 56, 'New Project', 'projects/addproject', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:37:51', 0, 0, 0, 0, 0),
(58, 56, 'Manage Projects', 'projects', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:38:22', 0, 0, 0, 0, 0),
(59, 55, 'To Do List', 'tools/todo', 'icon-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 07:40:24', 0, 0, 0, 0, 0),
(60, 0, 'Accounts', '', 'icon-calculator', NULL, 'Sidebar', 'Active', 9, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:52:52', 1, 0, 0, 0, 1),
(61, 60, 'Accounts', '', 'icon-book-open', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:54:04', 0, 0, 0, 0, 1),
(62, 61, 'Manage Accounts', 'accounts', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:55:11', 0, 0, 0, 0, 1),
(63, 61, 'Balance Sheet', 'accounts/balancesheet', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:56:02', 0, 0, 0, 0, 1),
(64, 61, 'Account Statements', 'reports/accountstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:56:43', 0, 0, 0, 0, 1),
(65, 60, 'Transactions', '', 'icon-wallet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 07:57:14', 0, 0, 0, 0, 1),
(66, 65, 'View Transactions', 'transactions', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:02:10', 0, 0, 0, 0, 1),
(67, 65, 'New Transaction', 'transactions/add', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:02:41', 0, 0, 0, 0, 1),
(68, 65, 'New Transfer', 'transactions/transfer', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:03:26', 0, 0, 0, 0, 1),
(69, 65, 'Income', 'transactions/income', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:04:11', 0, 0, 0, 0, 1),
(70, 65, 'Expense', 'transactions/expense', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:04:35', 0, 0, 0, 0, 1),
(71, 65, 'Client Transactions', 'customers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:05:16', 0, 0, 0, 0, 1),
(72, 0, 'Promo Codes', '', 'icon-trophy', NULL, 'Sidebar', 'Active', 10, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:18:56', 1, 0, 0, 0, 0),
(73, 72, 'Coupons', '', 'icon-trophy', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:20:17', 0, 0, 0, 0, 0),
(74, 73, 'New Promo', 'promo/create', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:20:51', 0, 0, 0, 0, 0),
(75, 73, 'Manage Promo', 'promo', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:21:45', 0, 0, 0, 0, 0),
(76, 0, 'Data & Reports', '', 'icon-pie-chart', NULL, 'Sidebar', 'Active', 11, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:23:45', 1, 0, 0, 0, 1),
(77, 76, 'Business Registers', '', 'icon-eyeglasses', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 08:26:30', 0, 0, 0, 0, 1),
(78, 76, 'Statements', '', 'icon-doc', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:27:12', 0, 0, 0, 0, 1),
(79, 78, 'Account Statements', 'reports/accountstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:28:13', 0, 0, 0, 0, 1),
(80, 78, 'Customer Account Statements', 'reports/customerstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:28:54', 0, 0, 0, 0, 1),
(81, 78, 'Supplier Account Statement', 'reports/supplierstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:31:35', 0, 0, 0, 0, 1),
(82, 78, 'Tax Statements', 'reports/taxstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:32:05', 0, 0, 0, 0, 1),
(83, 78, 'Product Sales Reports', 'pos_invoices/extended', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:32:50', 0, 0, 0, 0, 1),
(84, 76, 'Graphical Reports', '', 'icon-bar-chart', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:34:55', 0, 0, 0, 0, 1),
(85, 84, 'Product Categories', 'chart/product_cat', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:36:44', 0, 0, 0, 0, 1),
(86, 84, 'Trending Products', 'chart/trending_products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:37:16', 0, 0, 0, 0, 1),
(87, 84, 'Profit', 'chart/profit', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:37:53', 0, 0, 0, 0, 1),
(88, 84, 'Top Customers', 'chart/topcustomers', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:38:18', 0, 0, 0, 0, 1),
(89, 84, 'Income vs Expenses', 'chart/incvsexp', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:39:45', 0, 0, 0, 0, 1),
(90, 84, 'Income', 'chart/income', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:40:18', 0, 0, 0, 0, 1),
(91, 84, 'Expenses', 'chart/expenses', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:40:56', 0, 0, 0, 0, 1),
(92, 76, 'Summary & Report', '', 'icon-bulb', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 08:41:41', 0, 0, 0, 0, 1),
(93, 92, 'Statistics', 'reports/statistics', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:38:23', 0, 0, 0, 0, 1),
(94, 92, 'Profit', 'reports/profitstatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:39:27', 0, 0, 0, 0, 1),
(95, 92, 'Calculate Income', 'reports/incomestatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:40:11', 0, 0, 0, 0, 1),
(96, 92, 'Calculate Expenses', 'reports/expensestatement', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:41:06', 0, 0, 0, 0, 1),
(97, 92, 'Sales', 'reports/sales', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:41:39', 0, 0, 0, 0, 1),
(98, 92, 'Products', 'reports/products', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:42:32', 0, 0, 0, 0, 1),
(99, 92, 'Employee Sales Commission', 'reports/commission', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 10:43:13', 0, 0, 0, 0, 1),
(100, 0, 'Miscellaneous', '', 'icon-note', NULL, 'Sidebar', 'Active', 12, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:45:07', 1, 0, 0, 0, 0),
(101, 100, 'Notes', 'tools/notes', 'icon-note', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:46:21', 0, 0, 0, 0, 0),
(102, 100, 'Calendar', 'events', 'icon-calendar', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:46:49', 0, 0, 0, 0, 0),
(103, 100, 'Documents', 'tools/documents', 'icon-doc', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 10:48:25', 0, 0, 0, 0, 0),
(104, 0, 'E-Commerce', '', 'icon-basket', NULL, 'Sidebar', 'Active', 13, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:05:53', 1, 0, 0, 0, 0),
(105, 104, 'Online Platforms', 'ecommerce/online_platforms', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:02', 0, 0, 0, 0, 0),
(106, 104, 'Categories', 'ecommerce/categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:30', 0, 0, 0, 0, 0),
(107, 104, 'Sub Categories', 'ecommerce/sub_categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:07:54', 0, 0, 0, 0, 0),
(108, 104, 'Publishing', 'ecommerce/publishing', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:08:16', 0, 0, 0, 0, 0),
(109, 104, 'Analytics', 'ecommerce/analytics', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-09-29 11:08:46', 0, 0, 0, 0, 0),
(110, 0, 'HRM', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 14, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:09:37', 1, 0, 0, 0, 1),
(111, 110, 'Employees', '', 'ft-users', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:10:22', 0, 0, 0, 0, 1),
(112, 111, 'Employees List', 'employee', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:11:27', 0, 0, 0, 0, 1),
(113, 111, 'Salaries', 'employee/salaries', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:11:53', 0, 0, 0, 0, 1),
(114, 201, 'Attendance', 'employee/attendances', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:12:34', 0, 0, 0, 0, 1),
(115, 201, 'Attendance Report', 'employee/attendreport', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:13:07', 0, 0, 0, 0, 1),
(116, 201, 'Break Setting', 'employee/attendbreaksetting', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:13:37', 0, 0, 0, 0, 1),
(117, 201, 'Break Status', 'employee/attendview', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:14:17', 0, 0, 0, 0, 1),
(118, 201, 'Holidays', 'employee/holidays', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:14:56', 0, 0, 0, 0, 1),
(119, 110, 'Departments', 'employee/departments', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:15:36', 0, 0, 0, 0, 1),
(120, 110, 'Roles', 'employee/roles', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-09-29 11:16:03', 0, 0, 0, 0, 1),
(121, 0, 'FWMS', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 15, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:27:25', 1, 0, 0, 0, 0),
(122, 121, 'Clients', 'fwms/fwmsclients', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:28:17', 0, 0, 0, 0, 0),
(123, 121, 'Employees', 'fwms/fwmsemployees', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:28:51', 0, 0, 0, 0, 0),
(124, 121, 'Report', 'fwms/fwmsreport', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:29:24', 0, 0, 0, 0, 0),
(125, 0, 'Scheduler', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 16, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:30:04', 1, 0, 0, 0, 0),
(126, 125, 'Schedule', 'scheduler/schedule', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:30:40', 0, 0, 0, 0, 0),
(127, 125, 'Schedule List', 'scheduler/scheduleList', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:31:15', 0, 0, 0, 0, 0),
(128, 0, 'Asset Management', '', 'ft-file-text', NULL, 'Sidebar', 'Active', 17, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:31:39', 1, 0, 0, 0, 0),
(129, 128, 'View Assets', 'asset/assetlist', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:32:19', 0, 0, 0, 0, 0),
(130, 128, 'Asset History', 'asset/asset_history', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:32:59', 0, 0, 0, 0, 0),
(131, 128, 'Asset Category', 'asset/assetcategory', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:33:28', 0, 0, 0, 0, 0),
(132, 128, 'Asset Sub Category', 'asset/assetsubcategory', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:33:55', 0, 0, 0, 0, 0),
(133, 128, 'Asset Status', 'asset/assetStatus', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:34:21', 0, 0, 0, 0, 0),
(134, 128, 'Comments', 'asset/comments', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:34:44', 0, 0, 0, 0, 0),
(135, 128, 'Print BarCode', 'asset/printBarcode', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:35:14', 0, 0, 0, 0, 0),
(136, 0, 'Payroll', '', 'fa fa-money', NULL, 'Sidebar', 'Active', 18, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:35:29', 1, 1, 0, 0, 1),
(137, 136, 'Settings', 'payroll/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:44:42', 0, 0, 0, 0, 1),
(138, 136, 'Generate Pay slip', 'payroll/payroll', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:45:25', 0, 0, 0, 0, 1),
(139, 136, 'View Payslips', 'payroll/viewpaySlip', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:46:14', 0, 1, 0, 0, 1),
(140, 136, 'Payroll Report', 'payroll/payrollReport', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:46:42', 0, 0, 0, 0, 1),
(141, 0, 'Claims', '', 'fa fa-money', NULL, 'Sidebar', 'Active', 19, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:47:28', 1, 1, 0, 0, 1),
(142, 141, 'Add Claims', 'expenses/add', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:47:52', 0, 1, 0, 0, 1),
(143, 141, 'Claims', 'expenses', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-01 19:48:27', 0, 1, 0, 0, 1),
(144, 141, 'Reports', 'expenses/reports', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:49:14', 0, 0, 0, 0, 1),
(145, 141, 'Add Category', 'expenses/createcat', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:50:07', 0, 0, 0, 0, 1),
(146, 141, 'Category List', 'expenses/categories', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-01 19:50:34', 0, 0, 0, 0, 1),
(147, 0, 'Settings', '', 'icon-settings', NULL, 'Sidebar', 'Active', 20, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:52:11', 1, 0, 0, 0, 0),
(148, 147, 'Permissions', 'employee/permissions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:57:01', 0, 0, 0, 0, 0),
(149, 147, 'Dashboard Settings', 'dashboard/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:57:29', 0, 0, 0, 0, 0),
(150, 147, 'Subscribe Settings', 'dashboard/subscribe', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 19:58:06', 0, 0, 0, 0, 0),
(151, 0, 'Modules', '', 'icon-power', NULL, 'Sidebar', 'Active', 21, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:06:51', 1, 0, 0, 0, 0),
(152, 151, 'Modules List', 'modules/modules_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:09:38', 0, 0, 0, 0, 0),
(153, 151, 'Add Module', 'modules/add', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:10:54', 0, 0, 0, 0, 0),
(154, 151, 'Module Permissions', 'modules/module_permissions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-01 21:12:08', 0, 0, 0, 0, 0),
(156, 151, 'Subscriptions', 'modules/subscriptions', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-02 05:36:07', 0, 0, 0, 0, 0),
(157, 0, 'Delete', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:37:35', 1, 1, 0, 0, 1),
(158, 0, 'Reports', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:38:31', 1, 0, 0, 0, 1),
(159, 0, 'Edit', '', '', NULL, 'Sidebar', 'Active', 1, 'Authorized Action', 0, 1, 0, 1, 1, 0, 0, 0, '2023-10-02 11:40:28', 1, 1, 0, 0, 1),
(160, 1, 'Sales Dashboard', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:28:35', 0, 0, 0, 0, 1),
(161, 1, 'FWMS Dashboard', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:28:58', 0, 0, 0, 0, 1),
(162, 1, 'Payroll Dashboard Report', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:29:30', 0, 0, 0, 0, 1),
(163, 1, 'JobSheet Dashboard Report', '', '', NULL, 'Subheading', 'Active', 1, 'Authorized Action', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-03 04:29:50', 0, 0, 0, 0, 1),
(164, 2, 'Sales Landing Page', 'invoices', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 1, 0, 0, 0, 0, 0, 0, '2023-10-03 05:26:35', 0, 1, 0, 0, 0),
(165, 17, 'Stock Landing Page', 'products', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:27:10', 0, 0, 0, 0, 0),
(166, 36, 'JobSheet Landing Page', 'jobsheets', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:28:28', 0, 0, 0, 0, 0),
(167, 43, 'CRM Landing Page', 'customers', '', NULL, 'Sidebar', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 0, 0, 0, 0, '2023-10-03 05:29:22', 0, 0, 0, 0, 0),
(168, 0, 'Digital Marketing', '', 'icon-basket-loaded', NULL, 'Sidebar', 'Active', 22, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-03 09:32:03', 1, 0, 0, 0, 0),
(173, 168, 'Customer List', 'digitalmarketing/customers_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:14:46', 0, 0, 0, 0, 0),
(169, 0, 'Contract', 'contract', 'ft-file-text', NULL, 'Sidebar', 'Active', 23, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:29:09', 1, 0, 0, 0, 0),
(170, 141, 'Claim Landing Page ', 'expenses', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 1, 1, 0, 0, 0, '2023-10-04 03:35:31', 0, 0, 0, 0, 0),
(171, 0, 'Payroll Landing Page ', 'viewpaySlip', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:37:38', 1, 0, 0, 0, 0),
(172, 0, 'Attendance Landing Page ', 'employee/attendances', '', NULL, 'Subheading', 'Active', 1, 'Landing Page', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 03:48:05', 1, 0, 0, 0, 0),
(174, 168, 'Contact Management', 'digitalmarketing/contacts', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:16:20', 0, 0, 0, 0, 0),
(175, 168, 'List Management', 'digitalmarketing/lists', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:18:38', 0, 0, 0, 0, 0),
(176, 168, 'Folder Management', 'digitalmarketing/folders', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:22:23', 0, 0, 0, 0, 0),
(177, 168, 'Transactional', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:23:14', 0, 0, 0, 0, 0),
(178, 177, 'Emails', 'digitalmarketing/transactions/email', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:24:46', 0, 0, 0, 0, 0),
(179, 177, 'SMS', 'digitalmarketing/transactions/sms', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:25:11', 0, 0, 0, 0, 0),
(180, 177, 'Whatsapp', 'digitalmarketing/transactions/whatsapp', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:25:37', 0, 0, 0, 0, 0),
(181, 168, 'SMS Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:26:31', 0, 0, 0, 0, 0),
(182, 168, 'Email Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:26:58', 0, 0, 0, 0, 0),
(183, 168, 'Whatsapp Marketing', '', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:27:25', 0, 0, 0, 0, 0),
(184, 168, 'Settings', 'digitalmarketing/settings', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:28:36', 0, 0, 0, 0, 0),
(185, 181, 'Campaigns ', 'digitalmarketing/sms_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:29:55', 0, 0, 0, 0, 0),
(186, 182, 'Campaigns', 'digitalmarketing/email_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:31:29', 0, 0, 0, 0, 0),
(187, 183, 'Campaigns ', 'https://erp-dev.jsuitecloud.com/digitalmarketing/whatsapp_marketing_campaigns', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-10-04 04:32:46', 0, 0, 0, 0, 0),
(194, 0, 'Supplier', '', 'ft-sliders', NULL, 'Sidebar', 'Active', 4, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-21 14:42:58', 1, 0, 0, 0, 0),
(188, 194, 'Customer DO', '', 'fa fa-ticket', NULL, 'Subheading', 'Active', 4, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:54:56', 1, 0, 0, 0, 0),
(189, 188, 'Create Delivery Order', 'deliveryorder/create_delivery_order', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:56:07', 1, 0, 0, 0, 0),
(190, 188, 'Manage Delivery Orders', 'deliveryorder/list', '', NULL, 'Child Heading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-16 03:56:47', 1, 0, 0, 0, 0),
(191, 194, 'Supplier DO', 'deliveryorder/recieved_list', 'ft-umbrella', NULL, 'Subheading', 'Active', 3, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 14:05:50', 1, 0, 0, 0, 0),
(192, 191, 'Manage Delivery Orders', 'deliveryorder/recieved_list', '', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 14:10:00', 1, 0, 0, 0, 0),
(193, 17, 'Product Details', 'products/expire_products_list', 'ft-list', NULL, 'Subheading', 'Active', 6, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-20 20:08:49', 1, 0, 0, 0, 0),
(195, 17, 'Expiry Products', 'products/expiry_product_variations_list', 'ft-users', NULL, 'Subheading', 'Active', 10, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-22 08:58:06', 1, 0, 0, 0, 0),
(196, 17, 'Product Expiry By DO', 'products/detailed_product_expiry_list', 'ft-list', NULL, 'Subheading', 'Active', 16, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-27 17:35:36', 1, 0, 0, 0, 0),
(197, 17, 'Stock Balance', 'products/detailed_stock_balance', 'icon-bulb', NULL, 'Subheading', 'Active', 12, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-11-28 02:50:31', 1, 0, 0, 0, 0),
(198, 0, 'Digital Signature', 'digitalsignature', 'icon-trophy', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-08 11:43:08', 1, 0, 0, 0, 0),
(199, 136, 'Bulk Payroll', 'payroll/bulk_payroll', 'ft-list', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-11 15:07:07', 1, 0, 0, 0, 0),
(200, 136, 'Import PaySlip', 'payroll/ImportPaySlip', 'icon-wallet', NULL, 'Subheading', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-11 15:09:22', 1, 0, 0, 0, 0),
(201, 0, 'Attendance', '', 'ft-users', NULL, 'Sidebar', 'Active', 1, 'Page Display', 0, 0, 0, 0, 1, 0, 0, 0, '2023-12-18 03:47:19', 1, 0, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`, `cid`, `lang`, `code`) VALUES
(6, '1', NULL, 'active', '0', 'Jsoftsolution', '$2y$10$FwODtrQ3f9itfs744JvfWeZWvwWBPNv/.KDZC1oD9rVfT/SdLxCHq', 'shafeekajmal@hotmail.com', NULL, 'Member', 10, 'english', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
