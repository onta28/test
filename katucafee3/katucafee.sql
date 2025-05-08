-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2025 at 08:34 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katucafee`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admins`
--

DROP TABLE IF EXISTS `tb_admins`;
CREATE TABLE IF NOT EXISTS `tb_admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminpassword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admins`
--

INSERT INTO `tb_admins` (`admin_id`, `adminname`, `adminpassword`) VALUES
(1, 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bill`
--

DROP TABLE IF EXISTS `tb_bill`;
CREATE TABLE IF NOT EXISTS `tb_bill` (
  `billID` int NOT NULL AUTO_INCREMENT,
  `sale_date` date DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`billID`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_bill`
--

INSERT INTO `tb_bill` (`billID`, `sale_date`, `user_id`) VALUES
(1, '2025-03-31', 1),
(2, '2025-03-31', 1),
(3, '2025-03-31', 5),
(4, '2025-04-01', 1),
(5, '2025-04-04', 1),
(6, '2025-04-04', 1),
(7, '2025-04-06', 1),
(8, '2025-04-19', 1),
(9, '2025-04-23', 1),
(10, '2025-04-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_expenses`
--

DROP TABLE IF EXISTS `tb_expenses`;
CREATE TABLE IF NOT EXISTS `tb_expenses` (
  `expensesID` int NOT NULL AUTO_INCREMENT,
  `expensesName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `date` date NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`expensesID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_expenses`
--

INSERT INTO `tb_expenses` (`expensesID`, `expensesName`, `price`, `date`, `Name`) VALUES
(12, 'ສອນສະເມີ', 44444, '2025-02-02', 'ທ້າວ ອ່ອນຕາ ກຽງຢວນ'),
(8, 'ນົມເຢັນ', 125000, '2025-01-27', 'ທ້າວ ອ່ອນຕາ ກຽງຢວນ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

DROP TABLE IF EXISTS `tb_product`;
CREATE TABLE IF NOT EXISTS `tb_product` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DrinkType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Product_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`ProductID`, `ProductName`, `DrinkType`, `Product_image`, `Product_price`) VALUES
(1, 'Capucino', 'ຮ້ອນ', '../../upload/IMG-20250110-WA0005.jpg', 58000.00),
(2, 'Latte', 'ຮ້ອນ', '../../upload/IMG-20250110-WA0004.jpg', 4000.00),
(4, 'calamel', 'ຮ້ອນ', '../../upload/IMG-20250404-WA0003.jpg', 400000.00),
(5, 'ກະເຟຈໍາປາລາວ', 'ເຢັນ', '../../upload/IMG-20250404-WA0002.jpg', 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_details`
--

DROP TABLE IF EXISTS `tb_sales_details`;
CREATE TABLE IF NOT EXISTS `tb_sales_details` (
  `sale_id` int NOT NULL AUTO_INCREMENT,
  `bill_id` int NOT NULL,
  `sale_date` date NOT NULL,
  `product_id` int NOT NULL,
  `quantity_sold` int NOT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_sales_details`
--

INSERT INTO `tb_sales_details` (`sale_id`, `bill_id`, `sale_date`, `product_id`, `quantity_sold`) VALUES
(1, 1, '2025-03-31', 1, 4),
(2, 1, '2025-03-31', 2, 4),
(3, 2, '2025-03-31', 2, 6),
(4, 2, '2025-03-31', 1, 3),
(5, 3, '2025-03-31', 2, 1),
(6, 3, '2025-03-31', 1, 7),
(7, 4, '2025-04-01', 1, 1),
(8, 4, '2025-04-01', 2, 1),
(9, 5, '2025-04-04', 1, 6),
(10, 5, '2025-04-04', 2, 4),
(11, 6, '2025-04-04', 4, 3),
(12, 6, '2025-04-04', 5, 2),
(13, 6, '2025-04-04', 2, 2),
(14, 6, '2025-04-04', 1, 1),
(15, 7, '2025-04-06', 5, 2),
(16, 7, '2025-04-06', 4, 2),
(17, 7, '2025-04-06', 2, 1),
(18, 7, '2025-04-06', 1, 1),
(19, 8, '2025-04-19', 4, 7),
(20, 8, '2025-04-19', 2, 12),
(21, 8, '2025-04-19', 1, 11),
(22, 8, '2025-04-19', 5, 10),
(23, 9, '2025-04-23', 5, 1),
(24, 9, '2025-04-23', 4, 1),
(25, 9, '2025-04-23', 2, 2),
(26, 9, '2025-04-23', 1, 1),
(27, 10, '2025-04-24', 4, 3),
(28, 10, '2025-04-24', 5, 1),
(29, 10, '2025-04-24', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_summary_daily`
--

DROP TABLE IF EXISTS `tb_summary_daily`;
CREATE TABLE IF NOT EXISTS `tb_summary_daily` (
  `SummaryID` int NOT NULL AUTO_INCREMENT,
  `sale_date` date NOT NULL,
  `total_sales` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`SummaryID`),
  UNIQUE KEY `sale_date` (`sale_date`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_summary_daily`
--

INSERT INTO `tb_summary_daily` (`SummaryID`, `sale_date`, `total_sales`) VALUES
(1, '2025-03-29', 311110),
(2, '2025-03-30', 3071110),
(3, '2025-03-31', 1188000),
(4, '2025-04-01', 62000),
(5, '2025-04-04', 1730000),
(6, '2025-04-06', 962000),
(7, '2025-04-19', 3986000),
(8, '2025-04-23', 516000),
(9, '2025-04-24', 1262000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_summary_monthly`
--

DROP TABLE IF EXISTS `tb_summary_monthly`;
CREATE TABLE IF NOT EXISTS `tb_summary_monthly` (
  `SummaryID` int NOT NULL AUTO_INCREMENT,
  `salem` date NOT NULL,
  `total_sales` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`SummaryID`),
  UNIQUE KEY `sale_month` (`salem`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_summary_monthly`
--

INSERT INTO `tb_summary_monthly` (`SummaryID`, `salem`, `total_sales`) VALUES
(1, '2025-03-01', 39560720),
(2, '2025-04-01', 8518000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `name`, `picture`, `username`, `password`, `number`, `address`, `salary`, `data`) VALUES
(1, 'ທ້າວ ອ່ອນຕາ ກຽງຢວນ', '../pictures/1d8aa778-c143-4b0b-81e8-0a9d2e042785.jpg', 'onta', '13', '020 77518125', 'ໂພນສະອາດ', 4000000, '2025-03-31'),
(5, 'ທ້າວ ເຈນ', '../pictures/WhatsApp Image 2024-03-18 at 16.13.35_5d0d31c7.jpg', 'janey', '3', '020 98786586', 'ຫຼັກສິບ', 3500000, '2025-03-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
