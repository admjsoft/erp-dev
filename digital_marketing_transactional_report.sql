-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2023 at 01:35 AM
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
-- Table structure for table `digital_marketing_transactional_report`
--

DROP TABLE IF EXISTS `digital_marketing_transactional_report`;
CREATE TABLE IF NOT EXISTS `digital_marketing_transactional_report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8mb4_general_ci NOT NULL,
  `customer_source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_ids` text COLLATE utf8mb4_general_ci NOT NULL,
  `subject` text COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `digital_marketing_transactional_report`
--

INSERT INTO `digital_marketing_transactional_report` (`id`, `type`, `customer_source`, `customer_ids`, `subject`, `message`, `cr_date`) VALUES
(1, 'email', 'sprasad96@gmail.com', '84', 'hiii', '<p>ffff<br></p>', '2023-07-31 12:20:46'),
(2, 'sms', '9639639636', '84', '', 'hiiiiiiiiiii', '2023-07-31 12:24:33'),
(3, 'whatsapp', '123213424,9639639636', '84,83', '', 'hihihihi', '2023-07-31 12:26:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
