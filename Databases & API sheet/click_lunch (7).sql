-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2019 at 02:00 PM
-- Server version: 5.6.41
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `click_lunch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `profile_picture`, `username`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@eww.com', '$2y$10$xZzqapv6XY78duxbimKIFuYbyu/fvJHBQfxOmywZV8tNWMQWfml.i', 'admin_1545288749.jpg', 'Dhrumi', 1, '2018-10-20 04:54:29', '2019-01-14 06:55:06', NULL),
(2, 'admin@bobmail.info', '$2y$10$PFOMzMbtADnwHKHu79B6i.vztg1TMQeJhrJlkorzFGkYdaSJi/Ghe', '', 'john deo', 1, '2018-10-24 13:45:49', NULL, NULL),
(4, 'CoolThunder@binkmail.com', '$2y$10$0xr4KB0YuGkrpDHx35ZaP..w3unC4Nnigh/Y/82IP5X7PIfrRBqu.', 'admin_1547204567.jpg', 'Miss Liby', 1, '2019-01-11 11:02:47', NULL, NULL),
(6, 'sunvenk04@gmail.com', '$2y$10$EFlfcW7VetlzyaeDHzrNJeovTP7cbYb9QNtF2m9kY4ZodAIHr/cL.', '', 'Sunitha', 1, '2019-01-14 07:15:07', NULL, NULL),
(7, 'happyadmin@streetwisemail.com', '$2y$10$ORemK88Ch9dAO.0OmpK2EOVjYZ3vryST.FVJkt4aVvlfzD098Kncq', '', 'Happy', 1, '2019-01-17 10:23:06', NULL, NULL),
(8, 'DelicateElf@sendspamhere.com', '$2y$10$mp594I.O4nKHyDIGH5wjCOAYLarreUqOl279rx4msr.556Uvkjipm', 'admin_1547721740.png', 'Delicat eElf', 1, '2019-01-17 10:25:12', '2019-01-17 10:42:20', NULL),
(9, 'BoogerDanger@safetymail.info', '$2y$10$I8nAXLKGaXZ1E2Keku2aKeLOLXki0bgje2WVLL91TXnhwhHKoxz7O', '', 'adminm', 0, '2019-01-23 09:42:21', NULL, NULL),
(10, 'ClueDoody@notmailinator.com', '$2y$10$3YSc55yJ41FMj6weGhSA0e5mYmaTghajHw7xJQuKvBxCtAnJG97AS', 'admin_1548934243.png', 'Johnn Doee', 1, '2019-01-31 11:30:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appsetting`
--

CREATE TABLE `appsetting` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_label` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `updates` int(1) NOT NULL COMMENT '0- optional, 1 - compalsory'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appsetting`
--

INSERT INTO `appsetting` (`id`, `app_name`, `app_label`, `app_version`, `updates`) VALUES
(1, 'android', 'Customer Android App', '1.0.0', 0),
(2, 'ios', 'Customer IOS App', '1.0.0', 1),
(3, 'delivery_boy_android', 'Delivery Boy Android App', '1.0.0', 0),
(4, 'ipad', 'Restaurant Ipad App', '1.0.0', 1),
(5, 'maintenance_mode', 'Maintenance Mode', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `banner_picture` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 - deactive, 1 - active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `sub_title`, `banner_picture`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SATISFY YOUR CRAVINGS', 'Experience a world of food, with your favorite restaurants at your fingertips.', 'banner_1549456477.jpg', 1, '2019-01-18 07:31:30', '2019-02-06 08:04:37', NULL),
(2, 'Delicious Foods', 'Your one stop destination for', 'banner_1549456614.jpg', 1, '2019-01-18 06:19:17', '2019-02-06 08:06:54', NULL),
(3, 'HUNGRY?', 'Order food from favourite restaurants near you.', 'banner_1549456575.jpg', 1, '2019-01-18 06:29:51', '2019-02-06 08:06:15', NULL),
(4, 'OFFICE LUNCH. DELIVERED.', 'Lunch from local restaurants delivered straight to your office', 'banner_1549456737.jpg', 1, '2019-02-06 08:08:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 - active 0 - Deactivate',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Beverages', 1, '2019-01-17 13:39:00', NULL, NULL),
(2, 'Salad', 1, '2019-01-17 13:39:00', NULL, NULL),
(3, 'Side Dish', 1, '2019-01-17 13:39:18', NULL, NULL),
(4, 'Snack', 1, '2019-01-17 13:39:18', NULL, NULL),
(5, 'Main Dish', 1, '2019-01-17 13:39:34', NULL, NULL),
(6, 'Dessert', 1, '2019-01-17 13:39:34', NULL, NULL),
(7, 'Hello', 1, '2019-01-18 06:03:18', NULL, '2019-01-18 06:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `id` int(11) NOT NULL,
  `cuisine_name` varchar(255) NOT NULL,
  `cuisine_picture` varchar(255) NOT NULL,
  `is_active` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`id`, `cuisine_name`, `cuisine_picture`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Chinese', 'cuisine_1549515836.png', 1, '2019-02-07 05:03:56', '2019-02-07 00:33:56', NULL),
(3, 'Italian', 'cuisine_1549515683.png', 1, '2019-02-07 05:01:23', '2019-02-07 00:31:23', NULL),
(4, 'Sushi', 'cuisine_1549515790.png', 1, '2019-02-07 05:03:10', '2019-02-07 00:33:10', NULL),
(5, 'Greek', 'cuisine_1541053458.jpg', 1, '2019-02-07 05:15:42', NULL, '2019-02-07 00:45:42'),
(7, 'Thai', 'cuisine_1549515853.png', 1, '2019-02-07 05:04:13', '2019-02-07 00:34:13', NULL),
(9, 'Indian', 'cuisine_1549515906.png', 1, '2019-02-07 05:05:06', '2019-02-07 00:35:06', NULL),
(15, 'Japanese', 'cuisine_1547217107.jpg', 1, '2019-01-11 14:33:06', NULL, '2019-01-11 14:33:06'),
(18, 'Pizza', 'cuisine_1549515598.png', 1, '2019-02-07 00:29:58', NULL, NULL),
(19, 'Maxican', 'cuisine_1549515712.png', 1, '2019-02-07 00:31:52', NULL, NULL),
(20, 'American', 'cuisine_1549515737.png', 1, '2019-02-07 00:32:17', NULL, NULL),
(21, 'Barbecue', 'cuisine_1549515816.png', 1, '2019-02-07 00:33:36', NULL, NULL),
(22, 'Japanese', 'cuisine_1549515877.png', 1, '2019-02-07 00:34:37', NULL, NULL),
(23, 'Desserts', 'cuisine_1549515937.png', 1, '2019-02-07 00:35:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `device_type` int(5) NOT NULL COMMENT '0-web, 1- android, 2 -ios',
  `device_token` varchar(255) NOT NULL,
  `social_id` int(11) NOT NULL,
  `social_type` varchar(1) NOT NULL COMMENT '1 - facebook, 2 - google',
  `status` int(1) NOT NULL COMMENT '0  - pending , 1 - active, 2 - deactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(1) NOT NULL COMMENT '0 - male, 1- female',
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `remember_token` text NOT NULL,
  `activation_token` varchar(255) NOT NULL,
  `daily_schedule_mail` int(1) NOT NULL DEFAULT '1' COMMENT '0 - off, 1 - on',
  `cut_off_notification` int(1) NOT NULL DEFAULT '1' COMMENT '0 - off, 1 - on',
  `delivery_notification` int(1) NOT NULL DEFAULT '1' COMMENT '0 - off, 1 - on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `profile_picture`, `username`, `address`, `mobile_number`, `dob`, `zipcode`, `device_type`, `device_token`, `social_id`, `social_type`, `status`, `created_at`, `updated_at`, `deleted_at`, `gender`, `latitude`, `longitude`, `remember_token`, `activation_token`, `daily_schedule_mail`, `cut_off_notification`, `delivery_notification`) VALUES
(6, 'DullRat@mailinator.com', '$2y$10$s5xq4SSBkVvXZow/pR6f9.mNUDyTNaonrZSsLwjTNPI27tahx3ASO', 'customer_1546514755.jpg', 'Dhrumi SS', 'city center 2, science city', '8866541254', '1996-02-14', '', 0, '', 0, '', 1, '2019-01-03 06:55:55', '2019-01-22 07:36:53', NULL, '1', '42.34797469999999', '-71.08792840000001', '', '', 1, 1, 1),
(25, 'PieThunder@mailinator.com', '$2y$10$TJ0cFGhfYRvD.9OSimFFAekIE4ZLFHiUi0SKaZmemq4p9fGp1m7BG', 'customer_1548150942.jpg', 'Dhrumi SS', 'Dallas-Fort Worth Metropolitan Area, TX, USA', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', 0, '', 1, '2019-01-09 01:35:17', '2019-01-22 09:55:42', NULL, '1', '121212', '1212154', 'f59c153f1b0653cd0b04228d133252259d027c74', '', 0, 1, 1),
(32, 'vinodkummar@yahoo.com', '$2y$10$qwBontvpGvQkgoMmf7zhKO.wZj1htnE0rUHE4bMvUOxuQ2MjPQbme', 'customer_1547811554.jpg', 'Vinodkummar', '#5,1 floor,1 main road,rama chandra pura', '900 859 9119', '2001-01-08', '', 0, '', 0, '', 1, '2019-01-14 07:22:20', '2019-01-17 10:29:52', NULL, '0', '', '', '', '', 1, 1, 1),
(33, 'developer.eww@gmail.com', '$2y$10$aa.zH3/GXVhn4BNskycVWu0iRr3Xw2rYLTz1g5hdplV6Y95buGuFu', 'customer_1548152462.jpg', 'Mayur Two', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '333-222-1111', '2019-01-31', '', 0, 'cXPaRme73O4:APA91bEQSnPEr_bzBZ35tBw-70D2bw630o20sQZ9W4J-BGEd-TUM26nquT817IQxsLBJTnBGEZAgBNfjfQBS0ER3majFxdw4Cdw1vB4-9cIQxSN_2XC9GWzBQghC1P8hrBzfI5hpalQW', 0, '', 1, '2019-01-21 11:40:41', '2019-01-22 10:58:07', NULL, '0', '23.0727738', '72.5163369', 'b660c73941cee4ed06cb455cc620be5d0eb40a94', '', 1, 1, 1),
(34, 'RhymePaladin@mailinator.com', '$2y$10$0LU.1X2e9RFtwmuRj7u2NeO1TlLB4UHPL3fw5PicVJVQLixo0eCT2', '', 'Paladin', '', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', 0, '', 0, '2019-01-23 11:37:07', NULL, NULL, '1', '13.666', '66.3333333', '', '487a25ca64324b9504fc260da580f06938197cb5', 1, 1, 1),
(35, 'Rehan@gmail.com', '$2y$10$ZrD6PhBniRrXQBr8rJ/K1./4RvOPNExosmqA8owjy/7GuYPXW8OoK', 'customer_1548679677.jpeg', 'Rehan Hussein', '', '989898989898', '2019-01-28', '', 0, 'adsdasddasd', 0, '', 1, '2019-01-28 08:59:31', '2019-01-28 12:47:57', NULL, '0', '121212', '1212154', '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_card`
--

CREATE TABLE `customer_payment_card` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `card_holder_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `display_number` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `card_type` int(1) NOT NULL COMMENT '1 - Visa, 2 - Mastercard, 3 - American Express, 4 - Diners Club, 5 - Discover, 6 - JCB, 7 - Other',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment_card`
--

INSERT INTO `customer_payment_card` (`id`, `customer_id`, `card_holder_name`, `card_number`, `display_number`, `expiry_date`, `cvv`, `nickname`, `card_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'dhrumi', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'Dhrumi', 1, '2019-01-18 12:03:43', NULL, NULL),
(2, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'Si', 1, '2019-01-18 12:03:57', '2019-01-30 07:03:37', '2019-01-30 07:22:05'),
(3, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'Hi', 1, '2019-01-18 12:05:53', '2019-01-30 07:01:13', NULL),
(4, 33, 'mayur', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'mavo', 1, '2019-01-25 07:48:24', NULL, '2019-01-25 11:16:56'),
(5, 33, 'mayur', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 5, '2019-01-25 08:01:46', NULL, NULL),
(6, 33, 'saurav', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'hove', 1, '2019-01-25 12:00:18', '2019-01-25 12:09:11', NULL),
(7, 33, 'hoho', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'hiii', 2, '2019-01-25 12:10:18', NULL, '2019-01-25 13:20:06'),
(8, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-01-29 14:48:56', NULL, NULL),
(9, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-01-30 06:48:12', NULL, '2019-01-30 07:23:15'),
(10, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:53:12', NULL, NULL),
(11, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:54:31', NULL, NULL),
(12, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:55:18', NULL, NULL),
(13, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 09:08:25', NULL, NULL),
(14, 25, 'Siraaagdds', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'ggg', 4, '2019-02-12 09:14:09', NULL, NULL),
(15, 6, 'Dhrumi', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-02-12 09:28:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `default_address` int(1) NOT NULL DEFAULT '0' COMMENT '0 - not , 1- default',
  `popular` int(1) NOT NULL DEFAULT '0' COMMENT '0 - no, 1 - popular',
  `house_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `delivery_instruction` text NOT NULL,
  `address_type` varchar(1) NOT NULL COMMENT '1 - office, 2 - office buliding , 3 - home, 4 - other',
  `nickname` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `customer_id`, `default_address`, `popular`, `house_no`, `street`, `city`, `zipcode`, `latitude`, `longitude`, `delivery_instruction`, `address_type`, `nickname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 25, 0, 0, 'f33', 'sursagar tower', '', '380016', '23.0680435', '', 'No inst ', '2', 'bunu', '2019-01-25 05:48:04', NULL, '2019-01-21 13:40:17'),
(5, 25, 0, 0, 'f33', 'fgf', '', '380016', '', '', 'No inst ', '1', 'bunu', '2019-01-21 13:39:53', NULL, NULL),
(6, 25, 1, 0, 'f3355', 'fgf', '', '380016', '', '', 'No inst ', '2', 'bunu', '2019-02-20 08:57:49', NULL, NULL),
(7, 33, 0, 0, '20', 'kadi', 'patan', '38426', '', '', 'hey', '1', 'mayur', '2019-02-25 06:21:41', NULL, NULL),
(8, 6, 0, 0, 'f33', 'sursagar+tower', 'Ahmedabad', '380061', '23.0680435', '72.5307147', 'No inst ', '2', 'bunu', '2019-01-24 13:17:10', NULL, NULL),
(9, 33, 1, 0, 'fhdy', 'cjig', 'gjkg', '95565', '', '', 'ncfh', '4', '', '2019-02-26 09:43:28', NULL, NULL),
(10, 33, 0, 0, 'fjfj', 'cjjf', 'cjng', '56959', '', '', 'zv', '3', '', '2019-02-25 06:23:30', NULL, NULL),
(11, 6, 0, 0, 'f33', 'sursagar tower', 'Ahmedabad', '380061', '23.0680435', '72.5307147', 'No inst ', '2', 'bunu', '2019-01-24 13:39:58', NULL, NULL),
(13, 0, 0, 1, 'Excellent WebWorld', 'City Center', 'Ahmedabad', '380060', '23.0726414', '72.51423', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-02-18 07:06:00', NULL, NULL),
(14, 35, 0, 0, '411', 'Science city', 'California', '12456', '36.778261', '-119.4179324', '', '3', '', '2019-01-30 10:19:15', NULL, NULL),
(15, 35, 0, 0, '411', 'Science city', 'California', '12456', '36.778261', '-119.4179324', '', '3', '', '2019-01-31 10:03:35', NULL, NULL),
(16, 35, 1, 0, 'f35', 'sursagar', 'ahmedabad', '380016', '23.0489074', '72.6058584', 'No inst ', '2', 'bunu', '2019-01-31 10:03:35', NULL, NULL),
(17, 33, 0, 0, 'f35', 'sursagar', 'ahmedabad', '380016', '23.0489074', '72.6058584', 'No inst ', '2', 'bunu', '2019-02-26 07:48:38', NULL, NULL),
(18, 0, 0, 1, 'Salesforce', 'San Francisco', 'California', '94118', '42.3483041', '-71.08359259999997', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-01-31 10:06:03', NULL, NULL),
(19, 33, 0, 0, 'f33', 'sursagar tower', 'ahmedabad', '380016', '23.0489074', '72.6058584', 'No inst ', '2', 'ggg', '2019-02-22 13:41:36', NULL, NULL),
(20, 33, 0, 0, 'F-33', 'Sattadhar', 'Ahmedabad', '380061', '23.0672405', '72.5310504', '', '3', 'mayu', '2019-02-22 13:41:45', NULL, NULL),
(21, 33, 0, 0, 'F-33', 'Sursagar tower, Sattadhar', 'Ahmedabad', '380061', '23.0674991', '72.5307456', '', '3', 'mayu', '2019-02-22 14:08:17', NULL, NULL),
(22, 33, 0, 0, 'fjj33', 'ddd', 'gddfre', '38016', '35.1816448', '-89.7661527', 'No inst ', '2', 'ggg', '2019-02-18 10:41:27', NULL, NULL),
(23, 33, 0, 0, '43', 'sattadhar', 'kadi', '38271', '23.0676233', '72.530006', '', '3', 'mayur', '2019-02-22 06:23:15', NULL, NULL),
(24, 33, 0, 0, '65', 'sattadhar', 'kadi', '38426', '23.0670686', '72.5310495', '', '1', '', '2019-02-22 06:45:29', NULL, NULL),
(25, 33, 0, 0, '803', 'South Ocean Boulevard', 'Myrtle Beach', '29579', '33.6781578', '-78.8950967', '', '4', '', '2019-02-22 08:50:18', NULL, NULL),
(26, 33, 0, 0, '6', 'sttadhar', 'kadi', '38426', '23.0681595', '72.5292566', '', '1', '', '2019-02-22 07:25:53', NULL, NULL),
(27, 33, 0, 0, '1', 'acv', 'kadi', '38555', '35.9186133', '-84.9609464', '', '4', '', '2019-02-22 07:28:57', NULL, NULL),
(28, 33, 0, 0, '44', 'abc', 'abc', '57424', '45.024261', '-98.4500606', '', '3', '', '2019-02-26 09:43:28', NULL, NULL),
(29, 33, 0, 0, '111', 'abc', 'abc', '36542', '30.2999788', '-87.6778378', 'No inst ', '2', 'ggg', '2019-02-22 07:31:46', NULL, NULL),
(30, 33, 0, 0, '111', 'abc', 'abc', '57424', '45.024261', '-98.4500606', 'No inst ', '2', 'ggg', '2019-02-25 06:22:14', NULL, NULL),
(31, 33, 0, 0, '55', 'avc', 'avc', '12345', '34.6769819', '-118.1862581', '', '4', '', '2019-02-26 09:43:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cl_id` varchar(15) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `preferred_city` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) NOT NULL,
  `activation_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `email`, `password`, `cl_id`, `profile_picture`, `username`, `mobile_number`, `device_token`, `status`, `preferred_city`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`, `remember_token`, `activation_token`) VALUES
(1, 'test@gmail.com', '', 'CL33', '', 'my boy', '8866584215', '', 2, 'Kansas City', '', '', '2019-01-10 11:05:00', NULL, NULL, '', ''),
(2, 'BusyToots@mailinator.com', '$2y$10$oq/zjIL6zGuPK6xRahxHsOxtn0f9Yy/Dglx7w.nUstBe.OPQIR9tS', 'CL33', 'delivery_boy_1549026759.jpg', 'Ooo', '5566845124', 'hjhjkhjkhjkhkj', 1, 'Kansas City', '', '', '2019-01-10 07:00:44', '2019-02-01 13:12:39', NULL, 'ae7fc785053f9a90de64d3ce0a79675c3b71d8b5', ''),
(3, 'vendor@eww.com', '$2y$10$9ks4zgxM0zo4RfkllPf6RefgpxTqWZaWwTFm064616mkg4TbCbnoO', 'CL33', '', 'Clicklunch', '2498976678', '', 2, 'Kansas City', '', '', '2019-01-12 21:03:29', NULL, NULL, '', ''),
(4, 'suma@oviotechnologies.com', '$2y$10$Y2RT0qnBCJdhw5B5drJBDOAlRvVWyCfIKpD0Q3nmI0Sa/El9TnjlK', 'CL33', '', 'Clicklunch', '2498976678', '', 1, 'Kansas City', '', '', '2019-01-12 21:04:08', NULL, NULL, '', ''),
(5, 'sunvenk04@gmail.com', '$2y$10$e5v0G71WfUDMlNbXMFpYue0cCtaIXAJII6N3sSPeCAERoyZ9/.Z6i', 'CL33', '', 'Sunitha', '990236682578', '', 1, 'Kansas City', '', '', '2019-01-14 09:23:15', '2019-01-14 09:25:15', NULL, '', ''),
(6, 'PieGeek@mailinator.com', '$2y$10$CYf7oiAPLbu/oA7QrLHUNeZPmFKbrZmGWd0YK5XapgQ031ngGQzuK', 'CL33', '', 'Pie Geek', '333 333 3333', '', 1, 'Kansas City', '26.4685668', '-81.76799640000002', '2019-01-23 11:10:19', '2019-02-01 05:43:35', NULL, '', ''),
(7, 'Shabby@mailinator.com', '$2y$10$DzjXChZH73AsBEWFNbLmKOL4hwB1QZoXSiK/wEztLKdi3zSEZ1qPC', 'CL33', '', 'Shabby Dog', '777 777 7777', '', 1, 'Kansas City', '', '', '2019-01-23 11:11:41', NULL, NULL, '', ''),
(8, 'ZanyThunder@mailinator.com', '$2y$10$6Y.XcJuLYA9WqPwbXREu2.GRHyg4OCKo5pdZ2JWs78sp20Y5iRHIO', 'CL33', '', 'Zany T Hunder', '774 587 1466', '', 2, 'Vienna, VA, USA', '38.9012225', '-77.26526039999999', '2019-01-23 11:33:04', '2019-02-07 05:45:00', NULL, '', ''),
(9, 'dhrumi@reconmail.com', '$2y$10$oq/zjIL6zGuPK6xRahxHsOxtn0f9Yy/Dglx7w.nUstBe.OPQIR9tS', 'CL99', 'delivery_boy_1549962747.jpg', 'Dhrumi', '9874563210', '', 1, 'Buckingham Palace', '', '', '2019-01-10 07:00:44', '2019-02-12 09:12:27', NULL, 'ff2792ff083dac409dc0f9ff9e86f6ae2e220c38', ''),
(10, 'thomas@gmail.com', '$2y$10$5YLRV0iAz6BTaD2N1QP/ju8co4eqWljBkhwuQdqI5A.SC9brzsVHK', '', 'delivery_boy_1549518890.jpg', 'Thomas', '456 778 8899', '', 1, 'Greensboro, NC, USA', '36.0726354', '-79.79197540000001', '2019-02-07 05:54:50', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_dispatcher`
--

CREATE TABLE `delivery_dispatcher` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_dispatcher`
--

INSERT INTO `delivery_dispatcher` (`id`, `email`, `password`, `profile_picture`, `full_name`, `contact_no`, `address`, `city`, `state`, `country`, `zip_code`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dispatcher@gmail.com', '', '', 'dispatcher one', '', '', '', '', '', '', '', '', 1, '2019-01-02 09:31:53', '2019-01-14 08:51:46', NULL),
(2, 'dispatcher2@gmail.com', '', '', 'dispatcher two', '', '', '', '', '', '', '', '', 2, '2019-01-03 09:31:53', NULL, '2019-01-02 06:49:34'),
(3, 'deliverydispatcher@gmail.com', '$2y$10$5bllpD4EDDtQirrFD4Jr7u.6Osz.gQx6J.7pOr8rDvW5/CzNZErgG', 'dispatcher_1547186657.png', 'Deliverydispatcher Three', '5656657567567', 'DSS and E Middle Tpke, Manchester, CT, USA', '', '', '', '', '', '', 1, '2019-01-02 07:07:22', '2019-01-11 06:04:17', NULL),
(4, 'deliverydispatcher4@excellentwebworld.in', '$2y$10$LsFhnKE2eQnLg5zIwZTYI.ueviCWtbb0h.PdmtKdAlYK/Yafir4RO', 'dispatcher_1547206327.jpg', 'Jane', '488 745 6897', 'Canton, MI, USA', 'Wayne County', 'Michigan', 'United States', '48188', '', '', 1, '2019-01-02 07:09:10', '2019-02-07 05:42:08', NULL),
(5, 'sunvenk04@gmail.com', '$2y$10$ri16BYgvYI9xXLkIFNIatuy14yoZVw5ELFsYQ2znlin.eq4WSGX3K', '', 'Sunitha', '9902366827', '#5,1 floor,1 main road,rama chandra purhgdsj', '', '', '', '', '', '', 2, '2019-01-14 08:47:16', '2019-01-14 08:50:39', '2019-01-14 08:50:47'),
(6, 'sunvenk04@gmail.com', '$2y$10$xqb0fY30frqMsmacIf.VcOPxog6CWQ8FFD/5mBdyWin/J.PNzxQMO', '', 'Sunitha', '9902366824', '#5,1 floor,1 main road,rama chandra pura', '', '', '', '', '', '', 1, '2019-01-14 08:52:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `emat_email_type` int(11) DEFAULT NULL,
  `emat_email_name` varchar(255) DEFAULT NULL,
  `emat_email_subject` varchar(255) DEFAULT NULL,
  `emat_email_message` longblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emat_is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `emat_email_type`, `emat_email_name`, `emat_email_subject`, `emat_email_message`, `created_at`, `updated_at`, `emat_is_active`) VALUES
(18, 2, 'reset_password', 'Reset Password', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c6520726f6c653d2270726573656e746174696f6e222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d2230223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62622d7072696d61727922206865696768743d223430222077696474683d2233322220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d617279203222207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420233234326233643b223e266e6273703b203c2f74643e3c746420726f777370616e3d22322220636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f7078206f5f70792220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233432343635313b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f76706e5f6b65792d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d22343822207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c746420636c6173733d226f5f62622d7072696d61727922206865696768743d223430222077696474683d2233322220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d617279203222207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420233234326233643b223e266e6273703b203c2f74643e3c2f74723e3c74723e3c7464206865696768743d223430223e266e6273703b203c2f74643e3c7464206865696768743d223430223e266e6273703b203c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a203870783b206c696e652d6865696768743a203870783b206865696768743a203870783b223e266e6273703b203c2f74643e3c7464207374796c653d22666f6e742d73697a653a203870783b206c696e652d6865696768743a203870783b206865696768743a203870783b223e266e6273703b203c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e466f72676f7420596f75722050617373776f72643f3c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e204a75737420636c69636b207468697320627574746f6e20746f206372656174652061206e6577206f6e653c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d227b7265636f766572795f6c696e6b7d22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b223e5265736574204d792050617373776f72643c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-26 18:30:00', '2019-01-23 10:12:41', 1),
(19, 3, 'new_customer_by_admin', 'Welcome to Click Lunch', 0x3c683220636c6173733d226d79636c61737322207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20636f6c6f723a2072676228302c20302c2030293b20746578742d616c69676e3a2063656e7465723b223e57656c636f6d6520746f20436c69636b204c756e63683c2f68323e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e48656c6c6f2c207b637573746f6d65725f6e616d657d213c62723e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e5468616e6b20796f7520666f72207265676973746572696e6720617420436c69636b204c756e63682c205765206172652064656c69676874656420746f206861766520796f75206173206120637573746f6d6572206f6620436c69636b204c756e63682e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b223e596f752063616e2061636365737320796f7572206163636f756e742062792062656c6f772063726564656e7469616c732e266e6273703b3c2f7370616e3e3c2f703e3c703e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e456d61696c203a266e6273703b3c623e7b656d61696c7d3c2f623e3c62723e50617373776f7264203a203c623e7b70617373776f72647d3c2f623e3c62723e3c2f703e3c6833207374796c653d22746578742d616c69676e3a2063656e7465723b20223e3c6120687265663d22687474703a2f2f6c6f63616c686f73742f636c69636b5f6c756e63682f6c6f67696e2d76656e64657222207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b20666f6e742d73697a653a20313370783b20646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d7765696768743a203430303b20746578742d616c69676e3a2063656e7465723b2077686974652d73706163653a206e6f777261703b20766572746963616c2d616c69676e3a206d6964646c653b2070616464696e673a202e33373572656d202e373572656d3b206c696e652d6865696768743a20312e353b20626f726465722d7261646975733a202e323572656d3b20746578742d6465636f726174696f6e3a206e6f6e653b223e4c6f67696e3c2f613e3c2f68333e3c703e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e203c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e53696d706c7920636c69636b206f6e2074686520627574746f6e2062656c6f7720616e6420666f6c6c6f772074686520737465707320746f2075706461746520796f75722070617373776f72642e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b20666f6e742d73697a653a20313370783b20646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d7765696768743a203430303b20746578742d616c69676e3a2063656e7465723b2077686974652d73706163653a206e6f777261703b20766572746963616c2d616c69676e3a206d6964646c653b2070616464696e673a202e33373572656d202e373572656d3b206c696e652d6865696768743a20312e353b20626f726465722d7261646975733a202e323572656d3b20746578742d6465636f726174696f6e3a206e6f6e653b223e5570646174652050617373776f72643c2f613e3c2f703e3c70207374796c653d2220746578742d616c69676e3a2063656e7465723b223e266e6273703b496620796f7520646964206e6f742061736b20666f7220637265617465206163636f756e742c20706c656173652069676e6f72652074686973206d6573736167652e3c753e3c6120687265663d22687474703a2f2f7b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b223e3c62723e3c2f613e3c2f753e3c2f703e, '2019-01-02 18:30:00', '2019-01-17 14:16:07', 1),
(21, 4, 'new_deliveryboy_by_admin', 'Welcome to ClickLunch', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e57656c636f6d6520746f20636c69636b206c756e6368213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f7572206163636f756e7420686173206265656e207375636365737366756c6c7920637265617465643c2f703e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f752063616e2061636365737320796f7572206163636f756e742062792062656c6f772063726564656e7469616c733c2f703e3c7461626c6520646174612d6d6f64756c653d226c6162656c2d7873302220646174612d7468756d623d226c6162656c2d78732e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d2270616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f70782d6d64206f5f7079206f5f73616e73206f5f746578742d7873206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d2242672057686974652220646174612d636f6c6f723d224c696768742220646174612d73697a653d22546578742058532220646174612d6d696e3d2231302220646174612d6d61783d22313822207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313470783b6c696e652d6865696768743a20323170783b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c7020636c6173733d226f5f6d6222207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a20313670783b223e3c7374726f6e673e452d6d61696c2041646472657373202f2050617373776f72643c2f7374726f6e673e3c2f703e3c7461626c6520726f6c653d2270726573656e746174696f6e222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d2230223e3c74626f64793e3c74723e3c74642077696474683d223238342220636c6173733d226f5f62672d7768697465206f5f6272206f5f746578742d7873206f5f73616e73206f5f70782d7873206f5f70792220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d73697a653d22546578742058532220646174612d6d696e3d2231302220646174612d6d61783d22313822207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313470783b6c696e652d6865696768743a20323170783b6261636b67726f756e642d636f6c6f723a20236666666666663b626f726465722d7261646975733a203470783b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c7020636c6173733d226f5f746578742d6461726b2220646174612d636f6c6f723d224461726b22207374796c653d22636f6c6f723a20233234326233643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e3c7374726f6e673e7b656d61696c7d202f207b70617373776f72647d3c2f7374726f6e673e3c2f703e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2019-01-16 04:11:39', '2019-01-23 11:30:39', 1),
(22, 5, 'new_registration_admin', 'New Registration of admin', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b203c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e57656c636f6d6520746f20636c69636b206c756e6368213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f75722061646d696e6973747261746f72206163636f756e7420686173206265656e207375636365737366756c6c7920637265617465643c2f703e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f752063616e2061636365737320796f7572206163636f756e742062792062656c6f772063726564656e7469616c733c2f703e3c7461626c6520646174612d6d6f64756c653d226c6162656c2d7873302220646174612d7468756d623d226c6162656c2d78732e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d2270616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f70782d6d64206f5f7079206f5f73616e73206f5f746578742d7873206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d2242672057686974652220646174612d636f6c6f723d224c696768742220646174612d73697a653d22546578742058532220646174612d6d696e3d2231302220646174612d6d61783d22313822207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313470783b6c696e652d6865696768743a20323170783b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c7020636c6173733d226f5f6d6222207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a20313670783b223e3c7374726f6e673e452d6d61696c2041646472657373202f2050617373776f72643c2f7374726f6e673e3c2f703e3c7461626c6520726f6c653d2270726573656e746174696f6e222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d2230223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f6272206f5f746578742d7873206f5f73616e73206f5f70782d7873206f5f70792220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d73697a653d22546578742058532220646174612d6d696e3d2231302220646174612d6d61783d22313822207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313470783b6c696e652d6865696768743a20323170783b6261636b67726f756e642d636f6c6f723a20236666666666663b626f726465722d7261646975733a203470783b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b6d696e2d77696474683a2032383470783b223e3c7020636c6173733d226f5f746578742d6461726b2220646174612d636f6c6f723d224461726b22207374796c653d22636f6c6f723a20233234326233643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e3c7374726f6e673e7b656d61696c7d202f207b70617373776f72647d3c2f7374726f6e673e3c2f703e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d227b6c6f67696e5f6c696e6b7d22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b223e4c6f67696e3c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2019-01-16 10:45:20', '2019-01-23 09:41:35', 1),
(23, 1, 'new_registration_vender', 'Activate Your Click Lunch Account', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b203c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e57656c636f6d6520746f20636c69636b206c756e6368213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f7572206163636f756e7420686173206265656e207375636365737366756c6c7920637265617465643c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d22687474703a2f2f7b61637469766174696f6e5f6c696e6b7d22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e4163746976617465204163636f756e743c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-01-23 06:19:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `activation_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `email`, `password`, `role`, `shop_id`, `first_name`, `last_name`, `profile_picture`, `contact_no`, `status`, `remember_token`, `activation_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'emp1@mailinator.com', '', 2, 52, 'Employee', 'One', '', '', 0, '', '', '2018-11-12 06:49:49', NULL, '2018-11-12 02:19:49'),
(7, 'simplegeek@mailinator.com', '$2y$10$gYRNyiOh2Jp9h7G0i53hjuWwoetJuOD7syx9mni8pExhatA.b4ahW', 2, 52, 'Simple', 'Geek', '', '', 1, '', '', '2018-11-12 07:14:42', '2018-11-12 00:41:55', '2018-11-12 02:44:42'),
(8, 'missimp@mailinator.com', '$2y$10$Go2KgldtPjbYScE5q94pIORjTWAEzu1YDUuGR.61at5vYThocZv6C', 2, 52, 'Misso', 'Imp', 'employee_1542015101.png', '', 1, '', '', '2018-11-22 11:52:42', '2018-11-22 06:34:08', NULL),
(9, 'adghfgmin@eww.com', '', 2, 52, 'Zany', 'Ghj', '', '', 0, '', '', '2018-11-12 07:18:58', NULL, '2018-11-12 02:48:58'),
(10, 'admin@eww.com', '', 2, 52, 'Gjghj', 'Ghj', '', '', 0, '', '', '2018-11-12 07:29:35', NULL, '2018-11-12 02:59:35'),
(11, 'ghj@ghj.ghj', '', 2, 52, 'Gjghj', 'Toee', '', '', 0, '', '', '2018-11-12 07:30:20', NULL, '2018-11-12 03:00:20'),
(12, 'PieRascal@mailinator.com', '$2y$10$zG.b1BXPljcFFCsQAeZ2yuGAFKQjFUPb.c7Bd7uJSdK90C/WrxUhS', 2, 52, 'Pie', 'Rasca', 'employee_1547723885.jpg', '886 654 1254', 1, '', '', '2019-01-17 11:18:05', '2019-01-17 11:18:05', NULL),
(13, 'fragrant@yopmail.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 1, 58, 'Fragrant', 'One', 'employee_1547204205.jpg', '', 1, '', '', '2019-01-11 10:57:18', NULL, NULL),
(14, 'PieMan@mailinator.com', '$2y$10$LKdrd2NF.EQekouM6LZTuODk16IyOwzMB2W6el0Q0usX0PQF9YMGW', 2, 60, 'Employee', 'Jr', 'employee_1547208652.jpg', '', 1, '', '', '2019-01-12 06:18:08', '2019-01-12 06:18:08', NULL),
(15, 'sushmarai@gmail.com', '', 2, 58, 'Sushma', 'Rai', 'employee_1547463494.jpeg', '', 0, '', 'c1a9aa14d06af0efd7ecbd36a6e7756a776e1a18', '2019-01-14 10:58:17', NULL, NULL),
(16, 'MissGuy@mailinator.com', '$2y$10$q3Obzuk2NPHZ5L3p2r8xievEb97nm5P5uPoZUVMxVUq8/ORNi.XDG', 2, 62, 'Miss', 'Guy', 'employee_1547722991.jpg', '', 0, '', '', '2019-01-17 11:05:23', '2019-01-17 11:05:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `customer_id`, `shop_id`, `order_id`, `created_at`, `deleted_at`) VALUES
(1, 25, 0, 52, '2019-01-21 13:48:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `highlight`
--

CREATE TABLE `highlight` (
  `id` int(11) NOT NULL,
  `txt1` text NOT NULL,
  `txt2` text NOT NULL,
  `txt3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `highlight`
--

INSERT INTO `highlight` (`id`, `txt1`, `txt2`, `txt3`) VALUES
(1, '27\r\n', 'MINUTES SAVED', 'PER FOODSBY ORDER'),
(2, '98.3', '% LUNCHES DELIVERED', 'ACCURATELY AND ON-TIME'),
(3, '21', 'RESTAURANT', 'OPTIONS PER WEEK (AVG.)');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `offer_price` varchar(11) NOT NULL,
  `item_description` text NOT NULL,
  `item_picture` varchar(255) NOT NULL,
  `is_combo` int(11) NOT NULL,
  `category_id` varchar(1) NOT NULL,
  `inventory_status` int(1) NOT NULL COMMENT '0 - no, 1 - yes',
  `notify_stock` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `shop_id`, `name`, `short_name`, `cuisine_id`, `quantity`, `price`, `offer_price`, `item_description`, `item_picture`, `is_combo`, `category_id`, `inventory_status`, `notify_stock`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 52, 'Masala Frankie', '', 10, 80, '60.00', '56.00', 'Combine The Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501653.jpg', 0, '', 1, 12, 1, '2018-11-06 06:24:13', NULL, NULL),
(19, 52, 'Chinese Frankie', '', 10, 100, '90.00', '89.00', 'Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501826.jpeg', 0, '', 0, 0, 1, '2018-11-06 06:27:06', NULL, NULL),
(20, 52, 'Chicken P\\\"izza', 'chicken-pizza', 1, 20, '200.00', '189.00', 'Our Family Will Never Guess That This Fun Twist On Typical Pizza Uses Up Leftover Pesto. Loaded With Protein, Hearty Slices Of This Chicken Pizza\\\" Will Fill Them Up Fast!', 'item_1542019186.png', 1, '3', 1, 0, 1, '2019-02-25 05:26:57', NULL, NULL),
(21, 52, 'Test', '', 10, 1, '33.33', '10.00', 'Dfgdfg', 'item_1542018900.jpg', 1, '', 0, 0, 1, '2018-11-12 06:05:00', NULL, '2018-11-12 06:05:24'),
(22, 52, 'Dhrumi', '', 3, 4, '100.00', '77.00', 'Fgdg', '', 0, '', 0, 0, 1, '2019-01-07 00:44:50', NULL, '2019-01-07 00:45:04'),
(23, 52, 'Sushi', '', 10, 100, '100.00', '77.00', '78768ggggg', '', 0, '', 0, 0, 1, '2019-01-07 00:45:50', NULL, NULL),
(24, 52, 'Burger Meal Combo', '', 2, 1, '100.00', '77.00', 'Dfddf', 'item_1546838672.jpg', 0, '', 0, 0, 1, '2019-01-07 00:54:32', NULL, NULL),
(25, 52, 'P12', 'p', 3, 1, '100.00', '', 'Our Family Will Never Guess That This Fun Twist On', 'item_1551072323.jpg', 0, '3', 1, 0, 1, '2019-02-25 05:25:23', NULL, NULL),
(26, 52, 'C1', '', 2, 1, '100.00', '9.00', 'Gg', '', 1, '', 1, 10, 1, '2019-01-07 00:58:20', NULL, NULL),
(27, 58, 'Fresh Mushrooms', 'fresh-mushrooms', 9, 50, '5.00', '4.00', 'Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure', 'item_1547206219.png', 0, '3', 1, 0, 1, '2019-02-22 05:28:52', NULL, NULL),
(28, 58, 'Coco Drinks', '', 9, 50, '3.00', '2.00', 'Coco Drinks', '', 0, '', 1, 0, 0, '2019-01-14 10:45:42', NULL, NULL),
(29, 58, 'French Fries', '', 19, 10, '15.00', '10.00', 'Spicy And Tasty', 'item_1547462625.jpg', 0, '', 1, 0, 1, '2019-01-14 10:43:45', NULL, NULL),
(30, 58, 'Veg Meal + Coco Drinks', 'veg-meal-coco-drinks', 9, 40, '20.00', '15.00', 'Biriyani + Coco Drinks', 'item_1547462856.jpg', 1, '3', 1, 2, 1, '2019-02-13 11:21:09', NULL, NULL),
(31, 62, 'Ice Cream', '', 2, 100, '166.00', '150.00', 'Eld Our Little One?s First Birthday Here. The Cake Was Also Made By Fiona From The Restaurant And Was Exactly How I Wanted It. Was Guided By The Owner As To Where I Could Find Party Decorations As Per Our Colour Theme. We Only Needed To Deliver The Things To Them And Did Not Have To Worry About Anything. The Guests Appreciated The Ambience And The Food.. Thank You To The Entire Team For Making Our Special Day Perfect And Hassle Free And Providing Lip Smacking Food To Our Guests.', 'item_1547722922.png', 0, '7', 1, 40, 1, '2019-01-17 11:02:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 'ClickLunch123*#*', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_type` varchar(1) NOT NULL COMMENT '1-Deliver Now, 2-Deliver Later, 3-Takeout, 4-Takeout Later',
  `later_time` varchar(15) NOT NULL,
  `total` varchar(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `delivery_charges` varchar(255) NOT NULL COMMENT '%',
  `promocode_id` varchar(255) NOT NULL,
  `promo_amount` varchar(11) NOT NULL DEFAULT '0',
  `discount_type` varchar(3) NOT NULL COMMENT '0- flat, 1 - perc',
  `tax` varchar(255) NOT NULL COMMENT '%',
  `service_charge` varchar(11) NOT NULL COMMENT '%',
  `schedule_date` date NOT NULL,
  `schedule_time` varchar(255) NOT NULL,
  `order_status` int(5) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `payment_status` int(5) NOT NULL COMMENT '0- pending , 1- success, 2 - failed',
  `payment_mode` int(5) NOT NULL COMMENT '0  - Card , 1 -  Apple Pay, 2 -  Google Pay',
  `transaction_id` int(11) NOT NULL,
  `QR_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shop_id`, `order_type`, `later_time`, `total`, `subtotal`, `delivery_charges`, `promocode_id`, `promo_amount`, `discount_type`, `tax`, `service_charge`, `schedule_date`, `schedule_time`, `order_status`, `delivery_address_id`, `payment_status`, `payment_mode`, `transaction_id`, `QR_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(43, 33, 52, '4', '10:30 AM', '296.75', '', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:02:58', NULL, NULL),
(44, 33, 52, '4', '10:30 AM', '296.75', '', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:03:44', NULL, NULL),
(45, 33, 52, '4', '10:30 AM', '1.70', '296.75', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:08:22', NULL, NULL),
(46, 33, 52, '4', '10:30 AM', '298.45', '296.75', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:09:36', NULL, NULL),
(47, 33, 52, '4', '10:30 AM', '301.79', '296.75', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:15:12', NULL, NULL),
(48, 33, 52, '4', '10:30 AM', '301.79', '296.75', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:17:28', NULL, NULL),
(49, 33, 52, '4', '10:30 AM', '301.79', '296.75', '0.00', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:18:14', NULL, NULL),
(50, 33, 52, '4', '10:30 AM', '306.25', '296.75', '1.50', '39', '0', '', '1.20', '0.50', '0000-00-00', '', 1, 17, 1, 2, 0, '', '2019-02-25 10:19:37', NULL, NULL),
(51, 33, 52, '1', '', '69.30', '66.00', '1.50', '', '0', '', '1.50', '2.00', '0000-00-00', '', 1, 17, 1, 0, 0, '', '2019-02-25 13:00:36', NULL, NULL),
(52, 33, 52, '1', '', '69.30', '66.00', '1.50', '', '0', '', '1.50', '2.00', '0000-00-00', '', 1, 17, 1, 0, 0, '', '2019-02-25 13:03:03', NULL, NULL),
(53, 33, 52, '1', '', '69.30', '66.00', '1.50', '', '0', '', '1.50', '2.00', '0000-00-00', '', 1, 17, 1, 0, 0, '', '2019-02-25 14:02:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `product_total` varchar(11) NOT NULL,
  `promocode` varchar(255) NOT NULL,
  `discount_amount` varchar(11) NOT NULL,
  `discount_type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`, `product_total`, `promocode`, `discount_amount`, `discount_type`) VALUES
(47, 43, 25, 2, '100.00', '', '', '', 0),
(48, 43, 20, 5, '189.00', '', '', '', 0),
(49, 44, 25, 2, '100.00', '', '', '', 0),
(50, 44, 20, 5, '189.00', '', '', '', 0),
(51, 45, 25, 2, '100.00', '', '', '', 0),
(52, 45, 20, 5, '189.00', '', '', '', 0),
(53, 46, 25, 2, '100.00', '', '', '', 0),
(54, 46, 20, 5, '189.00', '', '', '', 0),
(55, 47, 25, 2, '100.00', '', '', '', 0),
(56, 47, 20, 5, '189.00', '', '', '', 0),
(57, 48, 25, 2, '100.00', '', '', '', 0),
(58, 48, 20, 5, '189.00', '', '', '', 0),
(59, 49, 25, 2, '100.00', '', '', '', 0),
(60, 49, 20, 5, '189.00', '', '', '', 0),
(61, 50, 25, 2, '100.00', '', '', '', 0),
(62, 50, 20, 5, '189.00', '', '', '', 0),
(63, 51, 18, 1, '56.00', '', '', '', 0),
(64, 52, 18, 1, '56.00', '', '', '', 0),
(65, 53, 18, 1, '56.00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item_variant`
--

CREATE TABLE `order_item_variant` (
  `id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `variant_group_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item_variant`
--

INSERT INTO `order_item_variant` (`id`, `order_item_id`, `variant_group_id`, `variant_id`, `price`) VALUES
(153, 47, 7, 77, '20'),
(154, 47, 7, 78, '2'),
(155, 47, 8, 79, '3'),
(156, 47, 8, 80, '5'),
(157, 48, 7, 81, '10.80'),
(158, 48, 7, 82, '2.30'),
(159, 48, 8, 83, '3.00'),
(160, 48, 8, 84, '5.00'),
(161, 49, 7, 77, '20'),
(162, 49, 7, 78, '2'),
(163, 49, 8, 79, '3'),
(164, 49, 8, 80, '5'),
(165, 50, 7, 81, '10.80'),
(166, 50, 7, 82, '2.30'),
(167, 50, 8, 83, '3.00'),
(168, 50, 8, 84, '5.00'),
(169, 51, 7, 77, '20'),
(170, 51, 7, 78, '2'),
(171, 51, 8, 79, '3'),
(172, 51, 8, 80, '5'),
(173, 52, 7, 81, '10.80'),
(174, 52, 7, 82, '2.30'),
(175, 52, 8, 83, '3.00'),
(176, 52, 8, 84, '5.00'),
(177, 53, 7, 77, '20'),
(178, 53, 7, 78, '2'),
(179, 53, 8, 79, '3'),
(180, 53, 8, 80, '5'),
(181, 54, 7, 81, '10.80'),
(182, 54, 7, 82, '2.30'),
(183, 54, 8, 83, '3.00'),
(184, 54, 8, 84, '5.00'),
(185, 55, 7, 77, '20'),
(186, 55, 7, 78, '2'),
(187, 55, 8, 79, '3'),
(188, 55, 8, 80, '5'),
(189, 56, 7, 81, '10.80'),
(190, 56, 7, 82, '2.30'),
(191, 56, 8, 83, '3.00'),
(192, 56, 8, 84, '5.00'),
(193, 57, 7, 77, '20'),
(194, 57, 7, 78, '2'),
(195, 57, 8, 79, '3'),
(196, 57, 8, 80, '5'),
(197, 58, 7, 81, '10.80'),
(198, 58, 7, 82, '2.30'),
(199, 58, 8, 83, '3.00'),
(200, 58, 8, 84, '5.00'),
(201, 59, 7, 77, '20'),
(202, 59, 7, 78, '2'),
(203, 59, 8, 79, '3'),
(204, 59, 8, 80, '5'),
(205, 60, 7, 81, '10.80'),
(206, 60, 7, 82, '2.30'),
(207, 60, 8, 83, '3.00'),
(208, 60, 8, 84, '5.00'),
(209, 61, 7, 77, '20'),
(210, 61, 7, 78, '2'),
(211, 61, 8, 79, '3'),
(212, 61, 8, 80, '5'),
(213, 62, 7, 81, '10.80'),
(214, 62, 7, 82, '2.30'),
(215, 62, 8, 83, '3.00'),
(216, 62, 8, 84, '5.00'),
(217, 63, 7, 18, '10'),
(218, 64, 7, 18, '10'),
(219, 65, 7, 18, '10');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `user_key` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `payment_type` int(5) NOT NULL COMMENT '0 -Eway, 1 - Apple Pay, 2 - Google Pay',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `shop_id` varchar(11) NOT NULL,
  `group_type` varchar(1) NOT NULL,
  `promo_type` varchar(1) NOT NULL DEFAULT '2' COMMENT '1 => ''Product based promocode'', 2 => ''Order based promocode''',
  `usage_limit` int(11) NOT NULL,
  `max_disc` varchar(255) NOT NULL,
  `min_no_of_orders` varchar(11) NOT NULL COMMENT 'Customer have to order min X no of orders',
  `promocode` varchar(255) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `discount_type` varchar(255) NOT NULL COMMENT '0- flat, 1 - perc',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `promo_min_order_amount` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `shop_id`, `group_type`, `promo_type`, `usage_limit`, `max_disc`, `min_no_of_orders`, `promocode`, `amount`, `discount_type`, `from_date`, `to_date`, `promo_min_order_amount`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, '58', '7', '1', 2, '', '3', 'TASTNEXT', '100.00', '0', '2019-02-06', '2019-02-23', '1000.00', 'Use Promocode TASTNEXT To Get Flat $100.00 Discount* On Total Product(s) Value ', 1, '2019-02-05 11:18:36', '2019-02-11 10:08:09', NULL),
(32, '', '4', '2', 3, '', '', 'OFF100', '100.00', '0', '2019-02-11', '2019-03-21', '200.00', 'Use Promocode OFF100 To Get Flat $100.00 Discount* On Total Order Value ', 1, '2019-02-05 11:20:54', '2019-02-11 10:08:47', NULL),
(33, '52', '4', '2', 3, '50.00', '', 'SAVE50', '50.00', '1', '2019-02-04', '2019-03-02', '100.00', 'Use Promocode SAVE50 To Get 50.00% Discount* On Total Order Value (Max Discount $50.00)', 1, '2019-02-11 07:49:47', '2019-02-11 10:08:28', NULL),
(34, '', '5', '2', 3, '50.00', '', 'MYSHOPOFF', '20.00', '1', '2019-02-11', '2019-02-28', '100.00', 'Use Promocode MYSHOPOFF To Get 20.00% Cashback* On Total Order Value (Max Cashback Rs.50)', 1, '2019-02-11 10:28:40', NULL, NULL),
(35, '', '6', '2', 5, '50.00', '5', 'PROMO', '50.00', '1', '2019-02-11', '2019-02-28', '', 'Use Promocode PROMO To Get 50.00% Discount* On Total Order Value (Max Discount $50.00)', 1, '2019-02-11 11:15:32', '2019-02-11 13:53:44', NULL),
(36, '52', '7', '2', 5, '100.00', '', 'GET50M', '10.00', '1', '2019-02-13', '2019-02-28', '500.00', 'Use Promocode GET50M To Get 10.00% Discount* On Total Order Value (Max Discount $100.00)', 1, '2019-02-13 05:56:34', '2019-02-13 09:21:21', NULL),
(37, '62', '7', '1', 5, '', '', 'MYTEST', '50.00', '0', '2019-02-14', '2019-02-28', '500.00', 'Use Promocode MYTEST To Get Flat $50.00 Discount* On Total Product(s) Value ', 1, '2019-02-13 10:02:34', '2019-02-13 10:12:34', NULL),
(38, '52', '4', '1', 1, '', '', 'ALL10', '50.00', '0', '2019-02-18', '2019-03-09', '100.00', 'Use Promocode ALL10 To Get flat $50.00 Cashback* On Total Product(s) Value ', 1, '2019-02-18 09:17:57', NULL, NULL),
(39, '52', '4', '1', 2, '50.00', '', 'SAVE15', '15.00', '1', '2019-02-25', '2019-03-09', '100.00', 'Use Promocode SAVE15 To Get 15.00% Discount* On Total Product(s) Value (Max Discount $50.00)', 1, '2019-02-25 07:29:22', '2019-02-25 07:29:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocode_products`
--

CREATE TABLE `promocode_products` (
  `id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Promocode will valid for customers who purchase these product';

--
-- Dumping data for table `promocode_products`
--

INSERT INTO `promocode_products` (`id`, `promocode_id`, `shop_id`, `product_id`) VALUES
(5, 31, 58, 29),
(6, 31, 58, 30),
(8, 36, 52, 23),
(12, 37, 62, 31);

-- --------------------------------------------------------

--
-- Table structure for table `promocode_shops`
--

CREATE TABLE `promocode_shops` (
  `id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Promocode will valid for customers who purchase from this shop';

--
-- Dumping data for table `promocode_shops`
--

INSERT INTO `promocode_shops` (`id`, `promocode_id`, `shop_id`) VALUES
(15, 34, 52),
(16, 34, 58),
(17, 34, 62),
(18, 34, 68);

-- --------------------------------------------------------

--
-- Table structure for table `promocode_valid_product`
--

CREATE TABLE `promocode_valid_product` (
  `id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocode_valid_product`
--

INSERT INTO `promocode_valid_product` (`id`, `promocode_id`, `shop_id`, `product_id`) VALUES
(13, 31, 58, 29),
(14, 31, 58, 30),
(16, 37, 62, 31),
(17, 38, 52, 18),
(18, 38, 52, 19),
(20, 39, 52, 20),
(21, 39, 52, 25);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `profile` int(2) NOT NULL,
  `item` int(2) NOT NULL,
  `inventory` int(2) NOT NULL,
  `promocode` int(2) NOT NULL,
  `orders` int(2) NOT NULL,
  `email_push_management` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `profile`, `item`, `inventory`, `promocode`, `orders`, `email_push_management`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1, 1),
(2, 'Manager', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`, `data`) VALUES
(1, 'tax', 'TAX(%)', '1.50');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `vender_name` varchar(255) NOT NULL,
  `shop_code` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `contact_no1` varchar(15) NOT NULL,
  `contact_no2` varchar(15) NOT NULL,
  `website` varchar(255) NOT NULL,
  `facebook_link` text NOT NULL,
  `twitter_link` text NOT NULL,
  `pinterest_link` text NOT NULL,
  `min_order` varchar(11) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `order_by_time` varchar(255) NOT NULL,
  `delivery_charges_per_mile` varchar(255) NOT NULL,
  `minimum_mile` varchar(11) NOT NULL,
  `charges_of_minimum_mile` varchar(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 - Card , 1 - Apple Pay, 2 - Google Pay',
  `tax_number` varchar(255) NOT NULL,
  `service_charge` varchar(11) NOT NULL,
  `device_type` int(5) NOT NULL COMMENT '	0-web, 1- android, 2 -ios',
  `device_token` varchar(255) NOT NULL,
  `broacher` varchar(255) NOT NULL,
  `takeout_delivery_status` int(5) NOT NULL DEFAULT '3' COMMENT '1 - Delivery , 2 - Takeout , 3 - Both',
  `status` int(5) NOT NULL COMMENT '0  - pending , 1 - active, 2 - deactive',
  `remember_token` varchar(255) NOT NULL,
  `activation_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `email`, `password`, `shop_name`, `short_name`, `percentage`, `vender_name`, `shop_code`, `profile_picture`, `address`, `zip_code`, `city`, `state`, `country`, `latitude`, `longitude`, `about`, `contact_no1`, `contact_no2`, `website`, `facebook_link`, `twitter_link`, `pinterest_link`, `min_order`, `delivery_time`, `order_by_time`, `delivery_charges_per_mile`, `minimum_mile`, `charges_of_minimum_mile`, `payment_mode`, `tax_number`, `service_charge`, `device_type`, `device_token`, `broacher`, `takeout_delivery_status`, `status`, `remember_token`, `activation_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 'sugar@mailinator.com', '$2y$10$2Qov5hbktXILNk8/EezJi.rakocg80gqr75xA7JIFLNVHLoLgQlvi', 'Ristretto - Behi', 'ristre', '10', 'Mr Ristretto', 'RIS52', 'vender_1541502113.jpg', 'Charlotte center city, Charlotte, NC, USA', '28202', 'Mecklenburg County', 'North Carolina', 'United States', '35.22723019999999', '-80.84608220000001', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '886 658 4541', '774 587 1466', 'https://www.zomato.com/ah', '', '', '', '100.00', '11:30 AM', '10:00 AM', '2.00', '2.00', '1.50', '0,1,2', '657-57-5765', '2.00', 0, '', 'brochure_1541502113.jpg', 3, 1, '6c0bf58d69c1a8adead8c7c158badc2f87430bf9', '', '2018-11-06 05:49:41', '2018-11-12 09:03:10', NULL),
(53, 'palboy@mailinator.com', '', 'Test Shop', '', '10.50', 'Pal', 'TES53', 'vender_1541999590.jpg', 'Gota, Ahmedabad, Gujarat, India', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2018-11-12 00:43:10', NULL, NULL),
(54, 'palcakes@mailinator.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Git', '', '8.00', 'Frl', 'GIT54', '', 'Del\\\"hi, Ind\\\"ia', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '', '0.50', 0, '', '', 3, 2, '', '', '2018-11-12 09:06:52', '2018-11-23 00:41:26', NULL),
(55, 'Cafe@eww.com', '', 'The Hytt Cafe', '', '10.00', 'Giop', 'THE55', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '42.34797469999999', '-71.08792840000001', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2019-01-03 09:21:24', NULL, NULL),
(56, 'PunchyMan@mailinator.com', '', 'Punchy Man', '', '', 'Dhrumi', 'PUN56', '', 'DFW Remote North Parking, Grapevine, TX, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '32.926195', '-97.04413999999997', '', '7745871466', '4353455434', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2019-01-09 01:52:15', NULL, NULL),
(57, 'SmartDoody@mailinator.com', '$2y$10$CjPL17v5/rIGScMxRYs8x.9VT0K84Z109Z9niH80PKnJSOPcj//Oa', 'St. George\\\'s', '', '', 'Doody', 'SMA57', 'vender_1549620579.jpg', 'Hynes Convention Center (Boylston Street and Gloucester Street), Boston, MA, USA', '02199', 'Suffolk County', 'Massachusetts', 'United States', '42.3483041', '-71.08359259999997', '', '666 666 6666', '666 655 5555', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.30', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 1, '', '', '2019-01-10 02:23:39', '2019-02-08 10:10:41', NULL),
(58, 'vadilal@yopmail.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Vadilal Eatery', 'vadilal-eatery', '', 'Vadilal', 'VAD58', 'vender_1547204136.png', 'Ghramville Road, Myrtle Beach, SC, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '33.7569751', '-78.92280299999999', 'This is test This is testThis is testThis is testThis is testThis is testThis is testThis is test This is testThis is testThis is test This is testThis is testThis is test', '774 587 1466', '774 587 1466', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '100.00', '11:30 AM', '10:00 AM', '2.50', '2.30', '2.90', '0,2', '545-55-5555', '0.50', 0, '', 'brochure_1547460096.jpg', 1, 1, '', '', '2019-01-11 10:50:17', '2019-02-13 10:48:26', NULL),
(59, 'BusyBoy@mailinator.com', '', 'Havmore', '', '', 'Mr  Patel', 'HAV59', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '', '', '', '7745871466', '7745871466', 'www.test.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '777-77-7777', '0.50', 0, '', '', 3, 0, '', '', '2019-01-11 11:04:12', '2019-01-14 07:47:37', NULL),
(60, 'bistro@mailinator.com', '$2y$10$LgPaANV6eu.2z8qblfoMf.qeNS8WVrfhEGBBiT8YBL6AJfVsCmGUy', 'Cafe Bistro', '', '', 'Mr Ristretto', 'CAF60', 'vender_1547208493.jpg', 'FGCU South Bridge Loop Road, Fort Myers, FL, USA', '33965', 'Lee County', 'Florida', 'United States', '26.4586806', '-81.76785970000003', 'Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in AhmedabadFind the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad', '8866541256', '8445687499', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '', '', '100.00', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '', '0.50', 0, '', 'brochure_1547208593.png', 3, 1, '', '', '2019-01-11 12:07:06', '2019-01-12 06:14:25', '2019-01-14 07:50:17'),
(61, 'dominos@gmail.com', '', 'Dominos', '', '10.00', 'Dominu', 'DOM61', '', 'Canton, MI, USA', '48488889', 'bangalore', 'ka', 'India', '42.3086444', '-83.48211600000002', '', '57687898890808', '35465676756577', 'www.hfajfhaifr.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1', '', '0.50', 0, '', '', 3, 0, '', '63245e31b00d4f5b9b03c8ca0fe05f4890f5d4c6', '2019-01-14 07:55:53', NULL, NULL),
(62, 'vineyard@mailinator.com', '$2y$10$NkmTmprrqUfdh/jBk.727eTMFtqouT2iIz/mXMJ04IwrRba8JXLW2', 'The Vineyard', '', '10.50', 'Mr Vine', 'THE62', 'vender_1549621131.jpg', 'London Eye Court, Las Vegas, NV, USA', '89178', 'Clark County', 'Nevada', 'United States', '36.0346157', '-115.30548069999998', '', '886 654 1258', '778 845 8745', 'https://www.zomato.com/ahmedabad/the-vineyard-bodakdev?zrp_bid=0&zrp_pid=14', '', '', '', '', '11:30 AM', '10:00 AM', '1.3', '2.50', '2.20', '2', '996-65-5745', '0.50', 0, '', '', 3, 1, '', '', '2019-01-17 10:38:12', '2019-02-08 10:18:51', NULL),
(63, 'test@gmail.com', '', 'Test', '', '', 'Rrtrt', 'TES63', '', 'Dg Farms Road, Wimauma, FL, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '', '', '', '546 546 4577', '444 444 4444', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '1,2', '555-55-5555', '0.50', 0, '', '', 3, 0, '', 'c7c1cf2f18b8f9c6e49f78a98e920877d17f288b', '2019-01-21 12:03:28', NULL, '2019-01-21 12:03:35'),
(64, 'MaleTater@mailinator.com', '$2y$10$u0u3DECZfKltNRAC..VwRegw2gUoiLY1dd.m3FcyOjRTVWNDu8LgG', 'MaleTater', '', '', 'MaleTater', 'MAL64', '', 'Aha Macav Parkway, Needles, CA, USA', '66666', 'San Bernardino County', 'California', 'United States', '35.0402223', '-114.64573039999999', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0', '66-66-6666', '0.50', 0, '', '', 3, 2, '', '', '2019-01-23 06:11:39', '2019-01-23 06:12:38', NULL),
(65, 'developer.eww2@gmail.com', '', 'Eww', '', '', 'Eww', 'EWW65', '', 'London Eye Court, Las Vegas, NV, USA', '89178', 'Clark County', 'Nevada', 'United States', '36.0346157', '-115.30548069999998', '', '', '555 555 5555', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '555-55-5555', '0.50', 0, '', '', 3, 0, '', '6f99e942816d9b6fc40ef22d82de525396deb7a2', '2019-01-23 06:15:09', NULL, '2019-01-23 06:30:28'),
(66, 'developer.eww2@gmail.com', '', 'The Esplendido Cafe', '', '', 'Mr Esplendo', 'THE66', '', 'Glendale, CA, USA', '32205', 'Duval County', 'Florida', 'United States', '', '', '', '555 555 5556', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '9', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 0, '', 'e5234ea06feeb57a1a78e1594224fa175fc054b8', '2019-01-23 06:37:05', NULL, NULL),
(67, 'myshop@binkmail.com', '', 'Waffles Store', '', '', 'Dhrumi', 'WAF67', '', 'Jollyville Road, Austin, TX, USA', '78759', 'Travis County', 'Texas', 'United States', '30.4065779', '-97.7478949', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '2', '2.50', '2.20', '0', '666-66-6666', '0.50', 0, '', '', 3, 0, '', 'a03cc2da19ad20a31997fd09e4756843e301664d', '2019-01-31 12:04:09', NULL, NULL),
(68, 'Stingo@tradermail.info', '$2y$10$jyWKXLh14gxxlD93JJjyq.NPUnvByej8bWVHr5akuh4rsIBwsXhBW', 'Stingo, Ace Hotel', 'stingo-ace-hotel', '', 'Stingo', 'STI68', 'vender_1549620927.jpg', 'Ace Hotel, Portland, OR, USA', '97205', 'Multnomah County', 'Oregon', 'United States', '45.52211399999999', '-122.681602', 'The Main Bar at Willy\\\'s Wine Bar is a private event venue available to hire in the City of London.\r\n\r\nIf there is one place in the City you need to experience, it?s Willy?s Wine Bar.\r\n\r\nThis is one of London?s most established wine bars in London. Not only is it bursting with tradition and charm, but it also plays host to some of London?s best wine quizzes and tastings.', '787 878 7878', '787 878 7878', 'https://www.zomato.com/ah', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '5', '08:00 AM', '07:00 AM', '1.50', '2.50', '2.20', '0,1', '790-65-7575', '0.50', 0, '', '', 3, 1, '', '', '2019-02-08 10:13:18', '2019-02-13 13:25:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_availibality`
--

CREATE TABLE `shop_availibality` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `from_time` varchar(255) NOT NULL,
  `to_time` varchar(255) NOT NULL,
  `full_day` int(2) NOT NULL DEFAULT '0',
  `is_closed` int(52) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_availibality`
--

INSERT INTO `shop_availibality` (`id`, `shop_id`, `day`, `from_time`, `to_time`, `full_day`, `is_closed`, `updated_at`) VALUES
(306, 57, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2018-11-13 01:53:02'),
(328, 60, 'Sunday', '', '', 0, 1, '2019-01-12 06:30:02'),
(329, 60, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-01-12 06:30:02'),
(330, 60, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-01-12 06:30:02'),
(331, 60, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-01-12 06:30:02'),
(332, 60, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-01-12 06:30:02'),
(333, 60, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-01-12 06:30:02'),
(334, 60, 'Saturday', '07:00 PM', '11:30 PM', 0, 0, '2019-01-12 06:30:02'),
(349, 58, 'Sunday', '', '', 0, 1, '2019-02-07 11:28:35'),
(350, 58, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-07 11:28:35'),
(351, 58, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-07 11:28:35'),
(352, 58, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-07 11:28:35'),
(353, 58, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-07 11:28:35'),
(354, 58, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-07 11:28:35'),
(355, 58, 'Saturday', '12:00 PM', '06:00 PM', 0, 0, '2019-02-07 11:28:35'),
(356, 68, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-08 10:17:57'),
(357, 68, 'Monday', '', '', 0, 1, '2019-02-08 10:17:57'),
(358, 68, 'Tuesday', '', '', 0, 1, '2019-02-08 10:17:57'),
(359, 68, 'Wednesday', '', '', 0, 1, '2019-02-08 10:17:57'),
(360, 68, 'Thursday', '', '', 0, 1, '2019-02-08 10:17:57'),
(361, 68, 'Friday', '', '', 0, 1, '2019-02-08 10:17:57'),
(362, 68, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-08 10:17:57'),
(377, 52, 'Sunday', '', '', 1, 0, '2019-02-25 11:29:18'),
(378, 52, 'Monday', '', '', 1, 0, '2019-02-25 11:29:18'),
(379, 52, 'Tuesday', '', '', 1, 0, '2019-02-25 11:29:18'),
(380, 52, 'Wednesday', '', '', 1, 0, '2019-02-25 11:29:18'),
(381, 52, 'Thursday', '', '', 1, 0, '2019-02-25 11:29:18'),
(382, 52, 'Friday', '', '', 1, 0, '2019-02-25 11:29:18'),
(383, 52, 'Saturday', '', '', 0, 1, '2019-02-25 11:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `shop_cuisines`
--

CREATE TABLE `shop_cuisines` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_cuisines`
--

INSERT INTO `shop_cuisines` (`id`, `shop_id`, `cuisine_id`) VALUES
(69, 57, 3),
(70, 57, 2),
(74, 53, 3),
(75, 62, 3),
(77, 58, 3),
(78, 58, 1),
(79, 68, 1),
(80, 68, 3),
(81, 68, 4),
(82, 68, 7),
(83, 68, 9),
(84, 68, 18),
(85, 68, 19),
(86, 68, 20),
(87, 68, 21),
(88, 68, 22),
(89, 68, 23),
(92, 52, 3);

-- --------------------------------------------------------

--
-- Table structure for table `shop_hours`
--

CREATE TABLE `shop_hours` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_delivery` int(1) NOT NULL COMMENT 'delivery - 2',
  `morning_evening` int(1) NOT NULL COMMENT 'morning - 1, evening - 2',
  `from_time` varchar(255) NOT NULL,
  `to_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_hours`
--

INSERT INTO `shop_hours` (`id`, `shop_id`, `order_delivery`, `morning_evening`, `from_time`, `to_time`) VALUES
(21, 58, 1, 1, '08:00 AM', '02:00 PM'),
(22, 58, 1, 2, '02:30 PM', '10:30 PM'),
(23, 58, 2, 1, '09:00 AM', '01:00 PM'),
(24, 58, 2, 2, '03:00 PM', '09:00 PM'),
(25, 68, 2, 1, '05:30 AM', '11:30 AM'),
(26, 68, 2, 2, '02:30 PM', '10:30 PM'),
(31, 52, 2, 1, '09:00 AM', '01:00 PM'),
(32, 52, 2, 2, '03:00 PM', '09:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `shop_request`
--

CREATE TABLE `shop_request` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_request`
--

INSERT INTO `shop_request` (`id`, `email`, `shop_name`, `address`, `contact_no`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cafe@eww.com', 'The Esplendido Cafe', 'Hynes Convention Center, Boston, MA, USA', '774587146677', 'am trying to format numbers in chartjs chart. I am getting this error on my console and the numbers are not visible on the chart', '2019-02-20 06:55:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `created_at`) VALUES
(1, 'dhrumi@mailinator.com', '2019-02-07 07:36:10'),
(2, 'ramadac@mailinator.com', '2019-02-20 10:09:02'),
(3, 'test@yopmail.com', '2019-02-22 07:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `variant_group`
--

CREATE TABLE `variant_group` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `selection` int(5) NOT NULL COMMENT '0- single, 1- multiple',
  `availability` int(5) NOT NULL COMMENT '0 - optional, 1 - required',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant_group`
--

INSERT INTO `variant_group` (`id`, `shop_id`, `name`, `selection`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 46, 'Cheese', 0, 1, '2018-10-31 09:09:04', NULL, NULL),
(5, 46, 'Butter', 0, 0, '2018-10-31 09:09:24', NULL, NULL),
(7, 52, 'Topping', 1, 0, '2018-11-06 06:22:40', NULL, NULL),
(8, 52, 'Fries', 0, 0, '2018-11-06 06:28:57', NULL, NULL),
(9, 52, 'Wat\\\"er', 0, 0, '2018-11-12 13:47:05', NULL, '2018-11-12 09:17:05'),
(10, 52, 'Wate\\\'r', 0, 0, '2018-11-12 13:47:07', NULL, '2018-11-12 09:17:07'),
(11, 52, 'Gg\\\'l', 0, 0, '2018-11-12 14:05:55', NULL, '2018-11-12 09:35:55'),
(12, 58, 'Toppings', 0, 0, '2019-01-11 11:28:30', NULL, NULL),
(13, 58, 'Vgroup', 1, 1, '2019-01-12 03:53:46', NULL, NULL),
(14, 58, 'Drinks', 1, 1, '2019-01-14 10:39:22', NULL, '2019-01-14 10:39:22'),
(15, 58, 'Snacks', 1, 1, '2019-01-14 10:44:38', NULL, NULL),
(16, 58, 'Drinks', 1, 1, '2019-01-14 10:44:56', NULL, NULL),
(17, 62, 'Cream', 0, 1, '2019-01-17 11:00:39', NULL, NULL),
(18, 62, 'peri peri', 0, 1, '2019-01-17 11:00:39', NULL, NULL),
(19, 58, 'Cheese', 0, 0, '2019-02-13 11:23:56', NULL, NULL),
(20, 58, 'Jain Prepration', 0, 1, '2019-02-22 05:28:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_items`
--

CREATE TABLE `variant_items` (
  `id` int(11) NOT NULL,
  `variant_group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant_items`
--

INSERT INTO `variant_items` (`id`, `variant_group_id`, `name`, `item_id`, `price`, `created_at`) VALUES
(15, 4, 'Single', 16, '10.80', '2018-11-01 02:31:39'),
(16, 4, 'double', 16, '20.00', '2018-11-01 02:31:39'),
(18, 7, 'Cheese', 18, '10', '2018-11-06 06:24:13'),
(19, 7, 'Butter', 18, '7', '2018-11-06 06:24:13'),
(20, 7, 'Peri peri', 18, '15', '2018-11-06 06:24:13'),
(21, 7, 'chilli', 19, '2', '2018-11-06 06:27:06'),
(22, 7, 'onion ', 19, '6', '2018-11-06 06:27:06'),
(35, 7, 'all', 23, '50', '2019-01-07 00:45:50'),
(36, 7, 'small', 23, '10', '2019-01-07 00:45:50'),
(37, 8, 'small', 24, '10', '2019-01-07 00:54:32'),
(38, 8, 'med', 24, '15', '2019-01-07 00:54:32'),
(42, 13, 'small', 29, '10', '2019-01-14 10:43:45'),
(43, 13, 'large', 29, '15', '2019-01-14 10:43:45'),
(44, 16, 'Small', 28, '20', '2019-01-14 10:45:42'),
(45, 17, 'Normal', 31, '10', '2019-01-17 11:02:02'),
(46, 17, 'Double', 31, '20', '2019-01-17 11:02:02'),
(47, 18, 'small packet', 31, '10', '2019-01-17 11:02:02'),
(48, 18, 'large packet', 31, '20', '2019-01-17 11:02:02'),
(64, 12, 'Chille', 27, '1.00', '2019-02-22 05:28:52'),
(65, 12, 'Anchovies', 27, '2.00', '2019-02-22 05:28:52'),
(66, 12, 'Rockt', 27, '2.00', '2019-02-22 05:28:52'),
(67, 19, 'Single', 27, '2.00', '2019-02-22 05:28:52'),
(68, 19, 'Double', 27, '3.00', '2019-02-22 05:28:52'),
(69, 16, 'Coke', 27, '6.00', '2019-02-22 05:28:52'),
(70, 16, 'Pepsi', 27, '6.50', '2019-02-22 05:28:52'),
(71, 20, 'Yes', 27, '0', '2019-02-22 05:28:52'),
(72, 20, 'No', 27, '0', '2019-02-22 05:28:52'),
(77, 7, 'All', 25, '20', '2019-02-25 05:25:23'),
(78, 7, 'tomato', 25, '2', '2019-02-25 05:25:23'),
(79, 8, 'small', 25, '3', '2019-02-25 05:25:23'),
(80, 8, 'med', 25, '5', '2019-02-25 05:25:23'),
(81, 7, 'Cheese', 20, '10.80', '2019-02-25 05:26:57'),
(82, 7, 'ggg', 20, '2.30', '2019-02-25 05:26:57'),
(83, 8, 'Small', 20, '3.00', '2019-02-25 05:26:57'),
(84, 8, 'Med', 20, '5.00', '2019-02-25 05:26:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appsetting`
--
ALTER TABLE `appsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payment_card`
--
ALTER TABLE `customer_payment_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_dispatcher`
--
ALTER TABLE `delivery_dispatcher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `highlight`
--
ALTER TABLE `highlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
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
-- Indexes for table `order_item_variant`
--
ALTER TABLE `order_item_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode_products`
--
ALTER TABLE `promocode_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode_shops`
--
ALTER TABLE `promocode_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode_valid_product`
--
ALTER TABLE `promocode_valid_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_availibality`
--
ALTER TABLE `shop_availibality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_cuisines`
--
ALTER TABLE `shop_cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_hours`
--
ALTER TABLE `shop_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_request`
--
ALTER TABLE `shop_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_group`
--
ALTER TABLE `variant_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_items`
--
ALTER TABLE `variant_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer_payment_card`
--
ALTER TABLE `customer_payment_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `delivery_dispatcher`
--
ALTER TABLE `delivery_dispatcher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `highlight`
--
ALTER TABLE `highlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `order_item_variant`
--
ALTER TABLE `order_item_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `promocode_products`
--
ALTER TABLE `promocode_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `promocode_shops`
--
ALTER TABLE `promocode_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `promocode_valid_product`
--
ALTER TABLE `promocode_valid_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `shop_availibality`
--
ALTER TABLE `shop_availibality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `shop_cuisines`
--
ALTER TABLE `shop_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `shop_hours`
--
ALTER TABLE `shop_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `shop_request`
--
ALTER TABLE `shop_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variant_group`
--
ALTER TABLE `variant_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `variant_items`
--
ALTER TABLE `variant_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
