-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2023 at 03:43 AM
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
-- Database: `erp-dev-init`
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('8403pmv8kii7cp6ta56ddv09hl0elb47', '::1', 1690169448, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303136393434383b69647c733a313a2236223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b735f726f6c657c733a333a22725f35223b6c6f67676564696e7c623a313b6c6f67696e5f6e616d657c733a353a2261646d696e223b746f6b656e7c733a36343a2265386539656663396461623031613965613261306563616364663134323262616234303639316266383732633339626131646165366562643162393864383031223b);

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
(1, '123456', 'Sales Account', '2018-01-01 00:00:00', '12560.43', 'Default Sales Account', 0, 'Basic');

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `document` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`),
  KEY `invoice` (`tid`),
  KEY `i_class` (`i_class`),
  KEY `loc` (`loc`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb3;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=2684 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_log`
--

INSERT INTO `gtg_log` (`id`, `note`, `created`, `user`) VALUES
(2679, '[Logged In] admin@admin.com', '2023-07-23 19:21:31', ''),
(2680, '[Logged Out] admin', '2023-07-23 19:23:29', ''),
(2681, '[Logged In] admin@admin.com', '2023-07-23 19:23:37', ''),
(2682, '[Logged Out] admin', '2023-07-23 19:24:14', ''),
(2683, '[Logged In] admin@admin.com', '2023-07-23 19:24:20', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=1378 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `gtg_premissions` (
  `id` int(11) NOT NULL,
  `module` enum('Sales','Stock','Crm','Project','Accounts','Miscellaneous','Employees','Assign Project','Customer Profile','Reports','Delete','POS','Sales Edit','Stock Edit','Jobsheet Admin','My Jobs','Jobsheet Report','Payroll','Setting','Permission','Expenses','Expenses Manager','Pay Run','Pay Run Manager','Attendance','Attendance Manager','Payroll New','Payroll Manager','File Manager','Peppol Invoices','Ecommerce','FWMS','Scheduler','Asset Management','Sales Dashboard','Fwms Dashboard','Ecommerce','Employee Login','Client Login','Payroll Dashboard Report','Jobsheet Dashboard Report','Digital Marketing','Master Data Import') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `r_1` int(11) NOT NULL,
  `r_2` int(11) NOT NULL,
  `r_3` int(11) NOT NULL,
  `r_4` int(11) NOT NULL,
  `r_5` int(11) NOT NULL,
  `r_6` int(11) NOT NULL,
  `r_7` int(11) NOT NULL,
  `r_8` int(11) NOT NULL,
  `settings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gtg_premissions`
--

INSERT INTO `gtg_premissions` (`id`, `module`, `r_1`, `r_2`, `r_3`, `r_4`, `r_5`, `r_6`, `r_7`, `r_8`, `settings`) VALUES
(1, 'Sales', 0, 1, 1, 1, 1, 1, 0, 0, ''),
(2, 'Stock', 1, 0, 1, 1, 1, 0, 1, 0, ''),
(3, 'Crm', 0, 0, 1, 1, 1, 0, 0, 0, ''),
(4, 'Project', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(5, 'Accounts', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(6, 'Miscellaneous', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(7, 'Assign Project', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(8, 'Customer Profile', 0, 0, 1, 0, 1, 0, 0, 0, ''),
(9, 'Employees', 0, 0, 0, 0, 1, 1, 0, 1, ''),
(10, 'Reports', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(11, 'Delete', 1, 0, 1, 1, 1, 1, 0, 0, ''),
(12, 'POS', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(13, 'Sales Edit', 1, 0, 1, 1, 1, 0, 0, 0, ''),
(14, 'Stock Edit', 1, 0, 1, 1, 1, 1, 1, 0, ''),
(15, 'Jobsheet Admin', 0, 0, 0, 1, 1, 0, 0, 0, ''),
(16, 'My Jobs', 0, 0, 0, 1, 1, 1, 0, 0, ''),
(17, 'Jobsheet Report', 0, 0, 0, 1, 1, 0, 0, 0, ''),
(18, 'Payroll', 0, 0, 1, 1, 1, 1, 0, 0, ''),
(19, 'Setting', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(20, 'Permission', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(21, 'Expenses', 1, 0, 1, 1, 1, 1, 1, 0, ''),
(22, 'Expenses Manager', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(23, 'Pay Run', 0, 0, 0, 0, 1, 1, 0, 0, ''),
(24, 'Pay Run Manager', 0, 0, 0, 0, 1, 1, 0, 0, ''),
(25, 'Attendance', 1, 0, 1, 1, 1, 1, 1, 1, ''),
(26, 'Attendance Manager', 0, 0, 1, 0, 1, 1, 0, 1, ''),
(27, 'Payroll New', 1, 0, 1, 1, 1, 1, 1, 0, ''),
(28, 'Payroll Manager', 1, 0, 0, 0, 1, 0, 0, 0, ''),
(29, 'File Manager', 1, 0, 1, 1, 1, 1, 0, 0, ''),
(30, 'Peppol Invoices', 1, 0, 1, 1, 1, 1, 0, 0, ''),
(31, 'Ecommerce', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(32, 'FWMS', 1, 0, 1, 1, 1, 1, 0, 0, ''),
(33, 'Scheduler', 1, 0, 1, 1, 1, 1, 0, 0, ''),
(34, 'Asset Management', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(35, 'Sales Dashboard', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard'),
(36, 'Fwms Dashboard', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard'),
(37, 'Ecommerce', 1, 0, 1, 1, 1, 1, 1, 0, ''),
(38, 'Employee Login', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(39, 'Client Login', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(40, 'Payroll Dashboard Report', 0, 0, 0, 0, 1, 0, 0, 0, 'dashboard'),
(41, 'Jobsheet Dashboard Report', 0, 0, 0, 0, 1, 1, 0, 0, 'dashboard'),
(42, 'Digital Marketing', 0, 0, 0, 0, 1, 0, 0, 0, ''),
(43, 'Master Data Import', 0, 0, 0, 0, 1, 0, 0, 0, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_product_cat`
--

INSERT INTO `gtg_product_cat` (`id`, `title`, `extra`, `c_type`, `rel_id`) VALUES
(1, 'General', 'General Cat', 0, 0),
(2, 'coffee shop', 'coffee shop', 0, 0),
(3, 'supermarket', 'supermarket', 0, 0),
(4, 'tea ', 'tea ', 1, 3),
(5, 'strong coffee', '....', 1, 2),
(6, 'Medicines', 'medicines category', 0, 0),
(7, 'Fever Meds', 'fever medicies', 1, 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_projects`
--

INSERT INTO `gtg_projects` (`id`, `p_id`, `name`, `status`, `priority`, `progress`, `cid`, `sdate`, `edate`, `tag`, `phase`, `note`, `worth`, `ptype`) VALUES
(1, '', 'KLSICCI MITRA', 'Progress', 'High', 31, 0, '2022-12-21', '2023-01-06', 'KLSICCI MITRA', 'Phase 1', '', '0.00', 0),
(2, '', 'Website Development ', 'Waiting', 'High', 0, 25, '2023-07-19', '2023-08-18', 'Web', 'A', '<p>Website Development&nbsp;</p>', '3000.00', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_promo`
--

INSERT INTO `gtg_promo` (`id`, `code`, `amount`, `valid`, `active`, `note`, `reflect`, `qty`, `available`, `location`) VALUES
(1, 'MVOFPCDN', '10.00', '2023-07-21', 0, 'testing', 1, 1, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;

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

CREATE TABLE `gtg_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gtg_role`
--

INSERT INTO `gtg_role` (`id`, `role_name`, `status`, `delete_status`) VALUES
(1, 'Inventory Manager', 1, 0),
(2, 'Sales Person', 1, 0),
(3, 'Sales Manager', 1, 0),
(4, 'ADMIN', 1, 0),
(5, 'Business Owner', 1, 0),
(6, 'Project Manager', 1, 0),
(7, 'Marketing ', 1, 0),
(8, 'General Workers', 1, 0);

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

CREATE TABLE `gtg_subscription` (
  `id` int(11) NOT NULL,
  `module` enum('Sales','Stock','Crm','Project','Accounts','Miscellaneous','Employees','Assign Project','Customer Profile','Reports','Delete','POS','Sales Edit','Stock Edit','Jobsheet Admin','My Jobs','Jobsheet Report','Payroll','Setting','Permission','Expenses','Expenses Manager','Pay Run','Pay Run Manager','Attendance','Attendance Manager','Payroll New','Payroll Manager','File Manager','Peppol Invoices','Ecommerce','FWMS','Scheduler','Asset Management','Sales Dashboard','Fwms Dashboard','Ecommerce','Digital Marketing') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `r_1` int(11) NOT NULL,
  `settings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gtg_supplier`
--

INSERT INTO `gtg_supplier` (`id`, `name`, `phone`, `address`, `city`, `region`, `country`, `postbox`, `email`, `picture`, `gid`, `company`, `taxid`, `loc`) VALUES
(1, 'rahul', '9841204881', '', '', '', '', '', 'hariinraj29@gmail.com', 'example.png', 1, 'reno', '', 0),
(2, 'Windy', '0122555412', '4th, Wisma Academy, Lot 4A, Jalan 19/1,', 'Petaling Jaya', 'Selangor', 'Malaysia', '46300', 'windy@ingrammicro.com', 'example.png', 1, 'Ingram Micro Malaysia Sdn. Bhd', '', 0),
(3, 'Mr Ng', '01223232323', 'Suite 2B-20-1, 20th Floor, Block 2B, Plaza Sentral', 'Wilayah Persekutuan', 'Kuala Lumpur', 'Malaysia', '50470', 'sales@jsoftsolution.com.my', 'example.png', 1, 'iPay88 Malaysia', '', 0),
(4, 'mr sry', '0123434343', 'H1-6, Block H1, Level 6, SetiaWalk, Persiaran Wawa', ' Pusat Bandar Puchong', 'Selangor', 'Malaysia', '47100', 'exabyte@exabyte.com', 'example.png', 1, 'Exabytes', '', 0),
(5, 'Chandran', '0355699951', '27, Jalan Pendidik U1/31, Hicom-glenmarie Industri', 'Shah Alam', 'Selangor', 'Malaysia', '40150', 'cbg@cbg.com', 'example.png', 1, 'CBG Infotech', '', 0),
(6, 'Ng', '03-6286 8222', 'Lot 3, Jalan Teknologi 3/5, Taman Sains Selangor.', 'Kota Damansara', 'Selangor', 'Malaysia', '47810', 'Yuni@vstecs berhad', 'example.png', 1, 'VSTECS Berhad', '', 0);

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
(1, 'JSOFT SOLUTION SDN BHD', '16-03-C', 'Ara Damansara', 'Petaling Jaya ', 'Malaysia ', '47320', '0125509210', 'ba@jsoftsolution.com.my', 'JSX003456', -1, 'MYR', 0, 'JS', 1, 'Etc/Greenwich', '1685513389420555249.png', 'english', '2022-04-14');

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3;

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

CREATE TABLE `gtg_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `roleid` int(11) NOT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `loc` int(11) NOT NULL,
  `lang` char(15) NOT NULL DEFAULT 'english',
  `login_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gtg_users`
--

INSERT INTO `gtg_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`, `loc`, `lang`, `login_status`) VALUES
(6, 'admin@admin.com', '3913228818759cd846b475d3106a4ecc9bf9bd91746cab4e88a8750c11d15914', 'admin', 0, '2023-07-24 03:24:20', '2023-07-24 03:24:20', '2022-04-14 11:35:34', NULL, NULL, NULL, '', NULL, '::1', 5, '1667294757148617952.jpeg', 0, 'english', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_items_thirdparty_pricing`
--

-- INSERT INTO `merchant_items_thirdparty_pricing` (`Id`, `ItemId`, `MerchantId`, `ThirdPartyVendorId`, `ThirdPartyVendorItemId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `SegmentStatus`, `ItemStatus`, `CrDate`) VALUES
-- (1, 1, 1, 3, '', 0, 0, 26, 38, '50', 0, 1, '2023-07-19 15:02:33'),
-- (2, 1, 1, 4, '1', 0, 0, 26, 38, '23', 0, 1, '2023-07-19 08:46:14'),
-- (10, 2, 1, 4, '2', 0, 0, 26, 38, '23', 0, 1, '2023-07-19 08:46:18'),
-- (9, 2, 1, 3, '', 0, 0, 26, 38, '21', 0, 1, '2023-06-27 17:29:14'),
-- (23, 5, 0, 3, '', 0, 0, 2, 5, '300', 0, 1, '2023-07-10 07:56:24'),
-- (12, 3, 1, 4, '3', 0, 0, 3, 5, '25', 0, 1, '2023-07-19 08:46:31'),
-- (11, 3, 1, 3, '', 0, 0, 3, 5, '26', 0, 1, '2023-07-02 07:37:46'),
-- (24, 5, 0, 4, '26289', 0, 0, 2, 5, '225', 0, 1, '2023-07-23 20:44:28'),
-- (19, 7, 0, 3, '', 0, 0, 3, 4, '43', 0, 1, '2023-07-02 08:10:43'),
-- (20, 7, 0, 4, '7', 0, 0, 3, 4, '15', 0, 1, '2023-07-19 08:46:45'),
-- (21, 4, 0, 3, '', 0, 0, 2, 5, '58', 0, 1, '2023-07-10 07:56:24'),
-- (22, 4, 0, 4, '4', 0, 0, 2, 5, '15', 0, 1, '2023-07-19 08:46:49'),
-- (25, 6, 0, 3, '', 0, 0, 2, 5, '200', 0, 1, '2023-07-10 07:56:24'),
-- (26, 6, 0, 4, '26277', 0, 0, 2, 5, '100', 0, 1, '2023-07-21 09:01:55'),
-- (27, 7, 0, 3, '', 0, 0, 2, 6, '10', 0, 1, '2023-07-10 02:20:51'),
-- (28, 7, 0, 4, '7', 0, 0, 2, 6, '10', 0, 1, '2023-07-19 08:46:57'),
-- (29, 8, 0, 3, '', 0, 0, 2, 6, '25', 0, 1, '2023-07-10 02:21:36'),
-- (30, 8, 0, 4, '8', 0, 0, 2, 6, '25', 0, 1, '2023-07-19 08:46:59');

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
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_thirdparty_vendors`
--

INSERT INTO `merchant_thirdparty_vendors` (`Id`, `VendorName`, `Status`, `CrDate`, `Type`, `WebSiteUrl`, `ConsumerKey`, `ConsumerSecret`, `WebSiteType`) VALUES
(3, 'POS', 1, '2023-07-10 08:30:55', 'Offline', '', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 'expenses', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishing_activity`
--

-- INSERT INTO `publishing_activity` (`Id`, `SessionId`, `ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `ActionType`, `Action`, `PreviousValue`, `NewValue`, `Query`, `CrDate`) VALUES
-- (1, '97843', '1', '4', '3', '5', '10', '3', '4', 'PriceInsert', 'Price Insert new price value 32', '', '32', 'INSERT INTO `merchant_items_thirdparty_pricing` (`ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `CrDate`) VALUES (1, 4, 3, 5, 10, 3, 4, 32,\'2023-07-04 07:02:39\')', '2023-07-04 07:02:39'),
-- (2, '97843', '1', '4', '3', '5', '10', '3', '4', 'PriceInsert', 'Price Insert new price value 35', '', '35', 'INSERT INTO `merchant_items_thirdparty_pricing` (`ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `CrDate`) VALUES (1, 4, 3, 5, 10, 3, 4, 35,\'2023-07-04 07:05:26\')', '2023-07-04 07:05:26');

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
  `status` int NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `run_scheduler_expiry_date`, `module`, `scheduler_on`, `minutes`, `hours`, `days`, `month`, `day`, `Schdeuleno_days`, `email_to`, `status`, `created_at`) VALUES
(1, 'yes', 8, '1,2', '', '', '30', '', '', '', '1,3', 0, '2023-06-26');

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
(64, 'FrontEndSection', '1', '0', '1', '0', '1', 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
