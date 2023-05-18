-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 09:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ez_solution_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `logo`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, '', 'Brand 1', '2023-01-07 12:22:48', '2023-01-07 17:26:10', 1),
(2, '', 'Brand 2', '2023-01-07 12:22:55', '2023-01-07 17:26:12', 1),
(3, '', 'Brand 3', '2023-01-07 12:23:02', '2023-01-07 17:26:14', 1),
(6, '1673367949_23.jpg', 'Brand 52', '2023-01-10 11:25:49', '2023-01-10 11:26:38', 1),
(7, '1673367987_32.jpg', 'Brand 6', '2023-01-10 11:26:05', '2023-01-10 11:26:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `logo` text DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `logo`, `name`, `parent_id`, `created_at`, `updated_at`, `status`) VALUES
(2, '', 'Category 1', NULL, '2023-01-07 12:24:02', '2023-01-07 12:24:02', 1),
(3, '', 'Category 2', NULL, '2023-01-07 12:24:14', '2023-01-07 12:24:14', 1),
(4, '', 'Category 4', NULL, '2023-01-07 13:15:46', '2023-01-07 13:15:46', 1),
(5, '', 'Category4.1', 4, '2023-01-07 13:16:41', '2023-01-10 11:21:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT 'Quotation = 1, Order = 2',
  `relative_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `only_staff` int(11) NOT NULL DEFAULT 0,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `type`, `relative_id`, `user_id`, `only_staff`, `message`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 12, 14, 1, 'ismail', '2023-04-02 12:34:56', '2023-04-02 12:34:56', 1),
(2, 1, 12, 4, 0, 'Message 1', '2023-04-17 14:04:36', '2023-04-17 14:04:36', 1),
(3, 1, 12, 4, 0, 'testing', '2023-04-18 14:06:25', '2023-04-18 14:06:25', 1),
(4, 1, 12, 4, 0, 'working', '2023-04-18 14:07:09', '2023-04-18 14:07:09', 1),
(5, 1, 12, 4, 0, 'dsfsd', '2023-04-18 14:07:14', '2023-04-18 14:07:14', 1),
(6, 1, 12, 4, 0, 'sdfsd', '2023-04-18 14:08:46', '2023-04-18 14:08:46', 1),
(7, 1, 12, 4, 0, 'd', '2023-04-18 14:14:30', '2023-04-18 14:14:30', 1),
(8, 1, 12, 4, 0, 'd', '2023-04-18 14:17:59', '2023-04-18 14:17:59', 1),
(9, 1, 11, 18, 0, 'vendor message Testing', '2023-05-02 16:15:11', '2023-05-02 16:15:11', 1),
(10, 1, 11, 18, 0, 'vendor message testing', '2023-05-02 16:16:07', '2023-05-02 16:16:07', 1),
(11, 1, 11, 18, 0, 'd', '2023-05-02 16:20:15', '2023-05-02 16:20:15', 1),
(12, 1, 11, 4, 0, 'Staff Public Meesage', '2023-05-02 16:31:09', '2023-05-02 16:31:09', 1),
(13, 1, 11, 4, 1, 'Staff Private Message', '2023-05-02 16:31:26', '2023-05-02 16:31:26', 1),
(14, 1, 11, 4, 0, 'a', '2023-05-02 16:31:34', '2023-05-02 16:31:34', 1),
(16, 1, 11, 22, 0, 'Customer Message', '2023-05-02 17:02:33', '2023-05-02 17:02:33', 1),
(17, 1, 13, 4, 0, 'Hi', '2023-05-03 12:51:38', '2023-05-03 12:51:38', 1),
(18, 1, 13, 4, 1, 'Only STaff Message', '2023-05-03 12:52:22', '2023-05-03 12:52:22', 1),
(19, 1, 13, 19, 0, 'i submit my price', '2023-05-03 12:54:20', '2023-05-03 12:54:20', 1),
(20, 1, 13, 21, 0, 'i check your price', '2023-05-03 12:55:49', '2023-05-03 12:55:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pakistan', '2023-03-23 10:21:16', '2023-03-23 10:21:16'),
(2, 'India', '2023-03-23 10:21:16', '2023-03-23 10:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tax_payer` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addres` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `logo`, `name`, `phone`, `email`, `tax_payer`, `country`, `state`, `city`, `addres`, `note`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(4, NULL, 'Customer 1', '(23) 423 534 5345', 'customer1@gmail.com', 0, 'Pakistan', 'Florida', 'New York', 'ABC', 'abc', 0, '2023-03-23 05:26:04', '2023-03-23 05:26:04', 1),
(5, NULL, 'Customer 2', '(23) 423 534 5345', 'customer2@gmail.com', 0, 'Pakistan', 'Florida', 'New York', 'ABC', 'abc', 0, '2023-03-23 05:26:04', '2023-03-23 05:26:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `related_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `type`, `related_id`, `title`, `file_url`, `file_type`, `file_size`, `created_at`, `updated_at`) VALUES
(4, 'quotation', 13, 'File 1', '1683997303_1683971967_1677006741_1673368081_2018-Rolex-Logo.jpg', 'jpg', 0, '2023-05-13 12:01:43', '2023-05-13 12:01:43'),
(5, 'quotation', 13, 'File 2', '1683997324_Web 3.0 User Manual.pdf', 'pdf', 0, '2023-05-13 12:02:04', '2023-05-13 12:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `phone`, `email`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(14, 'Ismail', 'Muhammad Iqbal', '(03) 320 824 8040', 'ismail6082@gmail.com', 0, '2022-12-18 05:50:34', '2023-01-02 12:31:11', 1),
(15, 'Ibrahim', 'Shabir', '32423423', 'ibrahim.shabir@gmail.com', 0, '2022-12-18 09:13:39', '2022-12-18 09:13:39', 1),
(17, 'Ismail', 'FSD', '03132312312', 'ismail60822@gmail.com', 0, '2022-12-20 12:24:13', '2022-12-20 12:38:27', 1),
(18, 'Ismail', 'FSD', '(04) 323 423 4234', 'ismailfsd2@gmail.com', 0, '2023-01-02 12:41:04', '2023-01-02 12:41:04', 1),
(19, 'Ismail', 'FSD', '(04) 323 423 4234', 'ismailfsd22@gmail.com', 0, '2023-01-02 12:42:24', '2023-01-02 12:42:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `finished_goods`
--

CREATE TABLE `finished_goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finished_goods`
--

INSERT INTO `finished_goods` (`id`, `name`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'FG 1', '', '2023-05-13 03:55:18', '2023-05-13 09:01:11', 1),
(2, 'FG 2', 'abc', '2023-05-13 03:58:27', '2023-05-13 09:01:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tax_payer` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addres` varchar(255) NOT NULL,
  `fda_licenses` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `logo`, `name`, `phone`, `email`, `tax_payer`, `country`, `state`, `city`, `addres`, `fda_licenses`, `note`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(2, '1683971967_1677006741_1673368081_2018-Rolex-Logo.jpg', 'Factory 1', '(15) 616 712 564_', 'cutypevuho@mailinator.com', 0, 'United State', 'Wisconsin', 'Houston', 'Qui voluptatem id d', 'Pariatur Ut aliquam', 'Ut qui sed molestiae', '2023-05-13 04:59:27', '2023-05-13 04:59:27', 0, 1),
(3, '1683971985_1677006741_1673368081_2018-Rolex-Logo.jpg', 'Factory 2', '(17) 445 936 171_', 'deqixo@mailinator.com', 1, 'United State', 'Washington', 'Los Angeles', 'Sint ullamco quia el', 'Eu voluptatem volup', 'Est deserunt qui eos', '2023-05-13 04:59:45', '2023-05-13 04:59:45', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_items` int(11) NOT NULL DEFAULT 0,
  `sub_total` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `quotation_id`, `customer_id`, `vendor_id`, `total_items`, `sub_total`, `created_at`, `updated_at`, `status`) VALUES
(8, 11, 5, 5, 1, '240.0000', '2023-05-13 07:48:19', '2023-05-13 16:00:49', 'proccess'),
(9, 11, 5, 6, 2, '982.8000', '2023-05-13 07:48:19', '2023-05-13 11:03:23', 'completed'),
(10, 13, 4, 5, 1, '96.0000', '2023-05-15 12:54:48', '2023-05-15 13:02:19', 'completed'),
(11, 13, 4, 6, 2, '740.0000', '2023-05-15 12:54:48', '2023-05-15 12:54:48', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(25,4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `eta_date` varchar(255) DEFAULT NULL,
  `ets_date` varchar(255) DEFAULT NULL,
  `delivery_date` varchar(255) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity`, `eta_date`, `ets_date`, `delivery_date`, `total`, `created_at`, `updated_at`) VALUES
(7, 8, 4, '2.4000', 100, '2023-05-25', '2023-05-26', '2023-05-31', '240.0000', '2023-05-13 07:48:19', '2023-05-13 10:49:49'),
(8, 9, 5, '3.5000', 250, '2023-05-18', '2023-05-19', '2023-05-13', '875.0000', '2023-05-13 07:48:19', '2023-05-13 11:03:16'),
(9, 9, 7, '4.9000', 22, '2023-05-17', '2023-05-18', '2023-05-20', '107.8000', '2023-05-13 07:48:19', '2023-05-13 11:03:23'),
(10, 10, 5, '2.4000', 40, '2023-05-25', '2023-05-28', '2023-06-21', '96.0000', '2023-05-15 12:54:48', '2023-05-15 13:02:19'),
(11, 11, 4, '4.0000', 50, NULL, NULL, NULL, '200.0000', '2023-05-15 12:54:48', '2023-05-15 12:54:48'),
(12, 11, 7, '6.0000', 90, NULL, NULL, NULL, '540.0000', '2023-05-15 12:54:48', '2023-05-15 12:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `point_of_contacts`
--

CREATE TABLE `point_of_contacts` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `working_phone` varchar(255) NOT NULL,
  `personal_phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_of_contacts`
--

INSERT INTO `point_of_contacts` (`id`, `type`, `related_id`, `first_name`, `last_name`, `designation`, `working_phone`, `personal_phone`, `email`, `comment`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(2, 2, 2, 'poc1', 'poc1', 'head2', '(42) 342 354 3453', '(23) 435 345 3454', 'poc1@gmail.com', NULL, 0, '2022-12-28 11:13:16', '2022-12-28 11:39:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT 'Material = 1, Finish Good = 2',
  `name` text NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `cost` decimal(25,4) NOT NULL,
  `price` decimal(25,4) NOT NULL,
  `mrp` decimal(25,4) NOT NULL,
  `tax_method` int(11) NOT NULL,
  `taxes` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `suppliers` text DEFAULT NULL,
  `alert_quantity` decimal(25,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `type`, `name`, `barcode`, `company_code`, `cost`, `price`, `mrp`, `tax_method`, `taxes`, `category_id`, `unit_id`, `brand_id`, `suppliers`, `alert_quantity`, `description`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(4, '', 1, 'Product 1', '324234234234', '32424235', '10.0000', '12.0000', '12.0000', 1, '1', 2, 1, 1, NULL, '10.00', NULL, 0, '2023-02-26 07:05:39', '2023-02-26 07:05:39', 1),
(5, '', 1, 'Product 2', '353453453453', '23424234', '13.0000', '14.0000', '14.0000', 1, '1', 3, 1, 2, NULL, '12.00', NULL, 0, '2023-02-26 07:06:17', '2023-02-26 07:06:17', 1),
(6, '', 2, 'Product 3', '234234345345', '32423432', '9.0000', '11.0000', '11.0000', 1, '1', 3, 1, 2, NULL, '12.00', NULL, 0, '2023-02-26 07:06:53', '2023-04-18 21:29:55', 1),
(7, '', 1, 'Product 4', '234235345342', '23423423', '15.0000', '17.0000', '13.0000', 1, '3', 4, 2, 3, NULL, '12.00', NULL, 0, '2023-02-26 07:07:46', '2023-02-26 11:59:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_vendors`
--

CREATE TABLE `product_vendors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_vendors`
--

INSERT INTO `product_vendors` (`id`, `product_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(2, 4, 6, '2023-02-26 08:46:17', '2023-02-26 08:46:17'),
(5, 4, 7, '2023-02-26 09:15:09', '2023-02-26 09:15:09'),
(6, 5, 6, '2023-02-26 09:15:37', '2023-02-26 09:15:37'),
(7, 6, 6, '2023-02-26 09:15:52', '2023-02-26 09:15:52'),
(8, 7, 6, '2023-02-26 09:16:00', '2023-02-26 09:16:00'),
(10, 7, 5, '2023-02-26 09:45:53', '2023-02-26 09:45:53'),
(11, 6, 5, '2023-02-26 14:05:01', '2023-02-26 14:05:01'),
(13, 5, 5, '2023-02-26 14:07:16', '2023-02-26 14:07:16'),
(14, 4, 5, '2023-02-28 12:35:55', '2023-02-28 12:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `finish_good_id` int(11) DEFAULT 0,
  `production_factory_id` int(11) NOT NULL DEFAULT 0,
  `packaging_factory_id` int(11) NOT NULL DEFAULT 0,
  `ponumber` varchar(255) DEFAULT NULL,
  `billaddress` varchar(255) DEFAULT NULL,
  `shippingaddress` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `reference_no`, `date`, `customer_id`, `project_name`, `finish_good_id`, `production_factory_id`, `packaging_factory_id`, `ponumber`, `billaddress`, `shippingaddress`, `created_at`, `updated_at`, `status`) VALUES
(11, '20230323094619', '2023-05-13 15:20:18', 5, 'Project 1', 1, 2, 3, '23423423423423', 'sdfa', 'dfssdfds', '2023-03-23 04:46:19', '2023-05-13 10:20:18', 'accept'),
(13, '20230503174831', '2023-05-15 17:54:48', 4, 'Project 2', 2, 2, 2, '23423423423423', 'Hussainabad Karachi', 'Hussainabad Karachi', '2023-05-03 12:48:31', '2023-05-15 12:54:48', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_addons`
--

CREATE TABLE `quotation_addons` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor_price` decimal(25,2) DEFAULT 0.00,
  `estimated_delivery_date` date DEFAULT NULL,
  `quote_expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation_items`
--

INSERT INTO `quotation_items` (`id`, `quotation_id`, `product_id`, `vendor_id`, `quantity`, `vendor_price`, `estimated_delivery_date`, `quote_expiry_date`, `created_at`, `updated_at`, `status`) VALUES
(20, 11, 4, 5, 100, '2.40', '2023-05-03', '2023-05-05', '2023-03-23 04:46:19', '2023-05-02 15:58:52', 'pending'),
(21, 11, 5, 6, 250, '3.50', '2023-05-14', '2023-05-25', '2023-03-23 04:46:19', '2023-05-13 07:03:50', 'pending'),
(25, 13, 4, 6, 50, '4.00', '2023-05-03', '2023-05-05', '2023-05-03 12:48:31', '2023-05-03 12:50:55', 'pending'),
(26, 13, 5, 5, 40, '2.40', '2023-05-24', '2023-05-26', '2023-05-03 12:48:31', '2023-05-15 12:49:21', 'pending'),
(27, 13, 7, 6, 90, '6.00', '2023-05-23', '2023-06-02', '2023-05-03 12:48:31', '2023-05-15 12:49:37', 'pending'),
(29, 11, 7, 6, 22, '4.90', '2023-05-24', '2023-05-25', '2023-05-13 07:03:39', '2023-05-13 07:04:04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `rate` decimal(25,2) NOT NULL,
  `apply_on` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `type`, `rate`, `apply_on`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'GST 17%', 1, '17.00', 1, 0, '2023-01-07 11:27:34', '2023-01-07 11:35:40', 1),
(2, 'GST 20%', 1, '20.00', 0, 0, '2023-01-07 12:24:53', '2023-01-07 12:24:53', 1),
(3, 'Tax 10%', 2, '10.00', 0, 0, '2023-01-07 13:24:21', '2023-01-10 11:32:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `code`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Pieces', 'Pcs', '2023-01-03 13:48:32', '2023-01-10 11:18:24', 1),
(2, 'Kilogram', 'KG', '2023-01-03 13:48:47', '2023-01-03 13:48:47', 1),
(3, 'Meter', 'm', '2023-01-07 13:14:46', '2023-01-07 13:14:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `related_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email_verification` int(11) NOT NULL DEFAULT 0,
  `phone_verification` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `related_id`, `username`, `password`, `email_verification`, `phone_verification`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(4, 'employee', 14, 'ismail6082', 'eyJpdiI6IkNJY3VxSGpoS3pjU1c4TVRma0pTU3c9PSIsInZhbHVlIjoieFQ2cFZhOWpCeFM5cEhOb2dETEZMdz09IiwibWFjIjoiMjcwYzA4ZmQ4ZGYwZDI0MWU0OWJhYTlmYTFiZTQyZTMzMTY1YWYyNGZlY2YyMzQ0YjA0YWRkYTliY2M2YjViNSIsInRhZyI6IiJ9', 0, 0, 0, '2022-12-18 05:50:34', '2023-01-02 12:31:11', 1),
(5, 'employee', 15, 'ibrahimshabir', 'eyJpdiI6IkFTQy8vcWRtZWZqTVhqaXhCVlpIcUE9PSIsInZhbHVlIjoiM2pmYjhJeDErdVhMajRTRjV0Mnp6dz09IiwibWFjIjoiMDEyMzAwODM2ZDBhNTY4MWRkNDY4NjUzNWViZjdjNzgwMDMyM2UwY2UwZTQ4ZDVlOTUxMDQ3NDM0ZDRhMWI0YyIsInRhZyI6IiJ9', 0, 0, 0, '2022-12-18 09:13:39', '2022-12-18 12:37:25', 0),
(12, 'employee', 17, 'ismailfsd', 'eyJpdiI6IlBtREYxSmpvdUJ0NXJaOStoU0kxbkE9PSIsInZhbHVlIjoiOFdORzdtNVlYKzJOY1NZeStNZzRaZz09IiwibWFjIjoiYmVmMjg1MDRjNjYwMDVmZDY1ZjUyYjk0NjJlMGIzODhhMmYyNGY5MmU5MmY1NmQzZTFiOTY2YzA3NjViNWM4NiIsInRhZyI6IiJ9', 0, 0, 0, '2022-12-20 12:24:13', '2022-12-20 12:38:36', 0),
(15, 'employee', 18, 'ismailfsd2', 'eyJpdiI6IklMcDdiOUczK1hNdzEwSmU3M0Iyd0E9PSIsInZhbHVlIjoiWWxnbXpSajBWKy9kYVAzMXYyWnJzUT09IiwibWFjIjoiMDExZjhkYmIwYjU4OTFiOGUyNTI4NmMzZTZiZWI2MGJlMmE0MzJlNTYyMWNjZThmZjM0YjlmNTUyOWYyYTEwNSIsInRhZyI6IiJ9', 0, 0, 0, '2023-01-02 12:41:04', '2023-01-02 12:41:04', 1),
(16, 'employee', 19, 'ismailfsd22', 'eyJpdiI6InM4R2dUN0x2TGUzazU1aUV2c0Ezc0E9PSIsInZhbHVlIjoiZk9CNmVyVk8yMC83N2lRY1VjNXVLQT09IiwibWFjIjoiMmU0OTVhYTE1YzhkNjk3NWMwZmJkNGQ5MDQxMWZjNDMzODRmZmI0ODg5OGU4OWNhOTgwMTY3NmYwNzZlYzYzMiIsInRhZyI6IiJ9', 0, 0, 0, '2023-01-02 12:42:24', '2023-01-02 12:42:24', 1),
(18, 'vendor', 5, 'vendor1', 'eyJpdiI6IndGbFBrYzV4dWloeGxHNTlYV2puMmc9PSIsInZhbHVlIjoiT3hKbWw0UjQwcm9adXlSTjdtZzdXZz09IiwibWFjIjoiYWEyNGQwNDdhYzM3ZWMwZGYxZTAxODZjZGY5OTBkOGM3MzY3NTM1NGI5ODEzYjVmNGEwNDk4MmE3MzdlMGIxNSIsInRhZyI6IiJ9', 0, 0, 0, '2023-02-26 06:36:12', '2023-02-26 06:36:12', 1),
(19, 'vendor', 6, 'vendor2', 'eyJpdiI6Ii9NTUxzYU4rSFdLYTg5UjFhOWlZQkE9PSIsInZhbHVlIjoiSzlxY2gxaEU2SVh6QVlKcEhyaDZZQT09IiwibWFjIjoiODY5NmY5ZTdmYThmMzUwMmQ4OTA0NDkxZDE3NTczNjZiOTMzZDczOGYxMjc5ZGY4ODY0NmQ5ZTA3NmMzNzk0OCIsInRhZyI6IiJ9', 0, 0, 0, '2023-02-26 06:36:53', '2023-02-26 06:36:53', 1),
(20, 'vendor', 7, 'vendor3', 'eyJpdiI6InhDelZCZXFSRTNxOHRtbGpSWUk4c3c9PSIsInZhbHVlIjoiWmJsaTF0Q0FlbWNaNDZvVWxIWlZ2dz09IiwibWFjIjoiZTExNDdmMGFmMDI4Y2ZhZTExMzUwZTRlY2M0MmU4MTFiYWE3OTc3Y2ExMDUxNmVjNzQyNzA3ZDU4MGUzMDY2NyIsInRhZyI6IiJ9', 0, 0, 0, '2023-02-26 06:37:43', '2023-02-26 06:37:43', 1),
(21, 'customer', 4, 'customer1', 'eyJpdiI6Im10eW5LcnM5WWd0M3o5SWN1RVh2Y0E9PSIsInZhbHVlIjoiUnZCeUN4NkQydm1Td3dvV2U2Zklrdz09IiwibWFjIjoiMDFkOGFiYzA3OGQ1ZDMxZjEzNmRhY2Q4Y2Y3ZDkxYzQxMzFiNTFjYjMwMjc4ZjRlMTRjMDE1ODA1NmJhODU5MyIsInRhZyI6IiJ9', 0, 0, 0, '2023-03-23 05:26:04', '2023-03-23 05:26:04', 1),
(22, 'customer', 5, 'customer2', 'eyJpdiI6Im10eW5LcnM5WWd0M3o5SWN1RVh2Y0E9PSIsInZhbHVlIjoiUnZCeUN4NkQydm1Td3dvV2U2Zklrdz09IiwibWFjIjoiMDFkOGFiYzA3OGQ1ZDMxZjEzNmRhY2Q4Y2Y3ZDkxYzQxMzFiNTFjYjMwMjc4ZjRlMTRjMDE1ODA1NmJhODU5MyIsInRhZyI6IiJ9', 0, 0, 0, '2023-03-23 05:26:04', '2023-03-23 05:26:04', 1),
(23, 'manufacturer', 2, 'dysyhexib', 'eyJpdiI6Imw2MWlkNXlBaExYVlkwSGZHdHZIUnc9PSIsInZhbHVlIjoiWHlibXJlMEtSRlJMcFNRKzdXSnJnOUZpd3FZWlJ2T3o0cFFQT0Vjb3IvRT0iLCJtYWMiOiI1N2NlZDNjMTFhOTM4MjMwYTE0ZTFhZDFiZWEzZDM1MmU1MDNhMjkwNzk2MWMxOWExOWY4OTk3MjBhNTk3ZDVlIiwidGFnIjoiIn0=', 0, 0, 0, '2023-05-13 04:59:27', '2023-05-13 04:59:27', 1),
(24, 'manufacturer', 3, 'mubuvi', 'eyJpdiI6ImdnSmFvYnJKdkpqNEgwR2dUYU5HZUE9PSIsInZhbHVlIjoieHFDRUQwOXpMdDNZc0cxQlZFZHVTd0JRWGVvZ0RZQXc3dFpnM3RCcXp4MD0iLCJtYWMiOiI1N2YzYmI3ODUwNTg2NDU1YTMxZGNkNTA1NTllZWE3N2E3MDgzNGZlZWIyYWIwY2MxZTU2MDY4NWZlOTVlZWQ0IiwidGFnIjoiIn0=', 0, 0, 0, '2023-05-13 04:59:45', '2023-05-13 04:59:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tax_payer` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addres` varchar(255) NOT NULL,
  `fda_licenses` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `logo`, `name`, `phone`, `email`, `tax_payer`, `country`, `state`, `city`, `addres`, `fda_licenses`, `note`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(5, '', 'Vendor 1', '(23) 423 423 4234', 'vendor1@gmail.com', 0, 'United State', 'Florida', 'New York', 'ABC', '24323', NULL, '2023-02-26 06:36:12', '2023-02-26 06:36:12', 0, 1),
(6, '', 'Vendor 2', '(32) 432 534 5345', 'vendor2@gmail.com', 0, 'United State', 'Florida', 'New York', 'ABC', '234242', NULL, '2023-02-26 06:36:53', '2023-02-26 06:36:53', 0, 1),
(7, '', 'Vendor 3', '(23) 423 434 5456', 'vendor3@gmail.com', 0, 'United State', 'Florida', 'New York', 'ABC', '5645654', NULL, '2023-02-26 06:37:43', '2023-02-26 06:37:43', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `type`, `status`) VALUES
(1, 'Warehouse 1', '(34) 234 324 2342', 'warehouse1@gmail.com', 'Warehouse 1 ABC', '2023-01-03 13:24:28', '2023-01-31 14:52:17', 1, 0),
(2, 'Warehouse 2', '(23) 423 434 5345', 'warehouse2@gmail.com', 'Warehouse 2 ABC', '2023-01-03 13:24:54', '2023-01-03 13:24:54', 1, 1),
(3, 'Warehosue 3', '(67) 687 778 9889', 'warehouse3@gmail.com', 'ABC', '2023-01-07 13:13:39', '2023-01-07 13:13:39', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finished_goods`
--
ALTER TABLE `finished_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_of_contacts`
--
ALTER TABLE `point_of_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_vendors`
--
ALTER TABLE `product_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_addons`
--
ALTER TABLE `quotation_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `finished_goods`
--
ALTER TABLE `finished_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `point_of_contacts`
--
ALTER TABLE `point_of_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_vendors`
--
ALTER TABLE `product_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quotation_addons`
--
ALTER TABLE `quotation_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
