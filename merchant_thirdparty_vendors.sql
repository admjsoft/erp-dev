-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2023 at 05:16 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_thirdparty_vendors`
--

INSERT INTO `merchant_thirdparty_vendors` (`Id`, `VendorName`, `Status`, `CrDate`, `Type`, `WebSiteUrl`, `ConsumerKey`, `ConsumerSecret`, `WebSiteType`) VALUES
(3, 'POS', 1, '2023-07-10 08:30:55', 'Offline', '', '', '', ''),
(4, 'JStore', 1, '2023-07-19 02:57:21', 'Online', 'https://jstore.my', 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de', 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
