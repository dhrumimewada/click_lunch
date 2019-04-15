-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2019 at 01:59 PM
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
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `profile_picture`, `username`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@eww.com', '$2y$10$chhoEmlZjGuhYqa9lzBJ9eJ8UBFbTOJR151IIFwkntWipTbSGWFTG', 'admin_1555164786.jpg', 'Dhrumi', 1, '', '2018-10-20 04:54:29', '2019-04-13 19:43:06', NULL),
(2, 'admin@bobmail.info', '$2y$10$PFOMzMbtADnwHKHu79B6i.vztg1TMQeJhrJlkorzFGkYdaSJi/Ghe', '', 'john deo', 1, '', '2018-10-24 13:45:49', NULL, NULL),
(4, 'CoolThunder@binkmail.com', '$2y$10$0xr4KB0YuGkrpDHx35ZaP..w3unC4Nnigh/Y/82IP5X7PIfrRBqu.', 'admin_1547204567.jpg', 'Miss Liby', 1, '', '2019-01-11 11:02:47', NULL, NULL),
(6, 'sunvenk04@gmail.com', '$2y$10$EFlfcW7VetlzyaeDHzrNJeovTP7cbYb9QNtF2m9kY4ZodAIHr/cL.', '', 'Sunitha', 0, '', '2019-01-14 07:15:07', NULL, NULL),
(7, 'happyadmin@streetwisemail.com', '$2y$10$ORemK88Ch9dAO.0OmpK2EOVjYZ3vryST.FVJkt4aVvlfzD098Kncq', '', 'Happy', 1, '', '2019-01-17 10:23:06', NULL, NULL),
(8, 'DelicateElf@sendspamhere.com', '$2y$10$mp594I.O4nKHyDIGH5wjCOAYLarreUqOl279rx4msr.556Uvkjipm', 'admin_1547721740.png', 'Delicat eElf', 1, '', '2019-01-17 10:25:12', '2019-01-17 10:42:20', NULL),
(9, 'BoogerDanger@safetymail.info', '$2y$10$I8nAXLKGaXZ1E2Keku2aKeLOLXki0bgje2WVLL91TXnhwhHKoxz7O', '', 'adminm', 0, '', '2019-01-23 09:42:21', NULL, NULL);

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
(4, 'ipad', 'Restaurant Ipad App', '1.2.0', 0),
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
(1, 'Satisfy Your Cravings', 'Experience a world of food, with your favorite restaurants at your fingertips.', 'banner_1549456477.jpg', 1, '2019-01-18 07:31:30', '2019-04-02 07:43:14', NULL),
(2, 'Delicious Food', 'Your one stop destination for1', 'banner_1549456614.jpg', 1, '2019-01-18 06:19:17', '2019-03-31 19:18:30', NULL),
(3, 'Hungry?', 'Order food from favourite restaurants near you.', 'banner_1549456575.jpg', 1, '2019-01-18 06:29:51', '2019-04-02 07:44:07', NULL),
(4, 'Office Lunch Delivered', 'Lunch from local restaurants delivered straight to your office', 'banner_1549456737.jpg', 1, '2019-02-06 08:08:57', '2019-04-12 04:22:11', NULL);

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
(4, 'Appetizer', 1, '2019-01-17 13:39:18', '2019-03-25 15:32:02', NULL),
(5, 'Main Dish', 1, '2019-01-17 13:39:34', NULL, NULL),
(6, 'Dessert', 1, '2019-01-17 13:39:34', NULL, NULL),
(7, 'Hello', 1, '2019-01-18 06:03:18', NULL, '2019-01-18 06:03:44'),
(9, 'Hot Beverage', 1, '2019-03-27 05:43:44', NULL, NULL),
(10, 'Soft Drinks /Juices', 1, '2019-04-07 16:35:03', NULL, NULL),
(11, 'Breakfast', 1, '2019-04-09 11:02:44', NULL, NULL);

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
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `contact_no`, `subject`, `message`, `created_at`, `deleted_at`) VALUES
(1, 'Deliverydispatcher Three', 'lunch1@safetymail.info', '567 567 5656', 'sdfsdfsdf', 'sdfdf', '2019-03-20 07:43:06', NULL),
(2, 'Dhrumi Suthar', 'dhrumi.m96@gmail.com', '886 658 0502', 'regarding new project from las\\\' vegas', 'Hello, How are you?', '2019-03-20 07:54:15', '2019-03-20 05:02:22'),
(3, 'John', 'suga_testr@mailinator.com', '444 509 5948', 'Before explaining CodeIgnite', 'r?s approach to data validation, let?s describe the ideal scenario:  A form is displayed. You fill it in and submit it. If you submitted something invalid, or perhaps missed a required item, the form is redisplayed containing your data along with an error message describing the problem. This process continues until you have submitted a valid form. On the receiving end, the script must:  Check for required data. Verify that the data is of the correct type, and meets the correct criteria. For example, if a username is submitted it must be validated to contain only permitted characters. It must be of a minimum length, and not exceed a maximum length. The username can?t be someone else?s existing username, or perhaps even a reserved word. Etc. Sanitize the data for security. Pre-format the data if needed (Does the data need to be trimmed? HTML encoded? Etc.) Prep the data for insertion in the database. Although there is nothing terribly complex about the above process, it usually', '2019-03-20 13:40:36', NULL);

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
(19, 'Maxican', 'cuisine_1549515712.png', 1, '2019-03-26 10:58:23', NULL, NULL),
(20, 'American', 'cuisine_1549515737.png', 1, '2019-02-07 00:32:17', NULL, NULL),
(21, 'Barbecue', 'cuisine_1549515816.png', 1, '2019-03-30 22:33:44', NULL, '2019-03-31 04:03:44'),
(22, 'Japanese', 'cuisine_1549515877.png', 1, '2019-03-23 12:51:35', NULL, NULL),
(23, 'Desserts', 'cuisine_1549515937.png', 1, '2019-03-30 22:33:24', NULL, '2019-03-31 04:03:24'),
(24, 'Ethiopian', 'cuisine_1554268731.png', 1, '2019-04-03 05:18:51', '2019-04-03 10:48:51', NULL),
(25, 'Mangolian', 'cuisine_1553985374.png', 1, '2019-03-30 22:37:36', NULL, '2019-03-31 04:07:36'),
(26, 'All', 'cuisine_1554268694.png', 1, '2019-04-13 16:16:07', '2019-04-13 21:46:07', NULL),
(27, 'Punjabi', 'cuisine_1554650162.jpg', 1, '2019-04-07 15:19:51', NULL, '2019-04-07 20:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `device_type` int(5) NOT NULL COMMENT '0-web, 1- android, 2 -ios',
  `device_token` varchar(255) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `social_type` varchar(1) NOT NULL COMMENT '1 - facebook, 2 - google',
  `status` int(1) NOT NULL COMMENT '0  - pending , 1 - active, 2 - deactive',
  `default_address` varchar(11) NOT NULL,
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

INSERT INTO `customer` (`id`, `email`, `password`, `username`, `profile_picture`, `address`, `mobile_number`, `dob`, `zipcode`, `device_type`, `device_token`, `social_id`, `social_type`, `status`, `default_address`, `created_at`, `updated_at`, `deleted_at`, `gender`, `latitude`, `longitude`, `remember_token`, `activation_token`, `daily_schedule_mail`, `cut_off_notification`, `delivery_notification`) VALUES
(6, 'DullRat@mailinator.com', '$2y$10$s5xq4SSBkVvXZow/pR6f9.mNUDyTNaonrZSsLwjTNPI27tahx3ASO', 'Dhrumi', 'customer_1546514755.jpg', 'city center 2, science city', '8866541254', '1996-02-14', '', 0, '', '0', '', 1, '', '2019-01-03 06:55:55', '2019-01-22 07:36:53', NULL, '1', '42.34797469999999', '-71.08792840000001', '995e6926a53e0f52141048894f2c11324eb373c4', '', 1, 1, 1),
(25, 'PieThunder@mailinator.com', '$2y$10$TJ0cFGhfYRvD.9OSimFFAekIE4ZLFHiUi0SKaZmemq4p9fGp1m7BG', 'Pie Thunder', 'customer_1548150942.jpg', 'Dallas-Fort Worth Metropolitan Area, TX, USA', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', '0', '', 1, '', '2019-01-09 01:35:17', '2019-01-22 09:55:42', NULL, '1', '121212', '1212154', 'f59c153f1b0653cd0b04228d133252259d027c74', '', 0, 1, 1),
(32, 'vinodkummar@yahoo.com', '$2y$10$JK3VdLe5iFoXDN55go1d.uVBCLKqo7ZTyIewaogEWgAglV7BcbGKO', 'vinod kummar', 'customer_1547811554.jpg', '#5,1 floor,1 main road,rama chandra pura', '900 859 9119', '2001-01-08', '', 0, '', '0', '', 1, '', '2019-01-14 07:22:20', '2019-04-01 23:22:49', NULL, '0', '', '', '', '', 1, 1, 1),
(33, 'developer.eww@gmail.com', '$2y$10$L8J5ytNjm6iJgSH3ctn3QOPnbWAHnXYf5QcTWz.7yvIhJX9/vHn/G', 'Developer', 'customer_1554118912.jpeg', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '333 222 1111', '1996-12-12', '', 2, 'eTRh7aY-m00:APA91bEJkh42HtRuGeb3M9rL1zxLgyp3Czie7k7RA29knhQAAh6-_EAarXJvIRcG8QxqvDT7BbTrqMtcvtJ1Pf1jAYyc48Ns0RvofRVPb16zWNjMrOZ5amkfZwa3WJcHP7wb6TXhs34L', '0', '', 1, '18', '2019-01-21 11:40:41', '2019-04-12 11:46:21', NULL, '0', '23.0728284104351', '72.51638378613029', '', '', 0, 0, 0),
(34, 'RhymePaladin@mailinator.com', '$2y$10$0LU.1X2e9RFtwmuRj7u2NeO1TlLB4UHPL3fw5PicVJVQLixo0eCT2', 'Dhrumi', '', '', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', '0', '', 0, '', '2019-01-23 11:37:07', NULL, NULL, '1', '13.666', '66.3333333', '', '487a25ca64324b9504fc260da580f06938197cb5', 1, 1, 1),
(35, 'Rehan@gmail.com', '$2y$10$ZrD6PhBniRrXQBr8rJ/K1./4RvOPNExosmqA8owjy/7GuYPXW8OoK', 'Dhrumi', 'customer_1554117792.jpeg', '', '333 222 1111', '0000-00-00', '', 2, 'eZbi6tjcrvU:APA91bFyRnf7MWA53oDZ3zb4DsIilOHDEB22byzl73308RMqHm4X4sC3dmwTCzunRzUa1VmI-dXSN9d-NwkRXiosbrY9SZTvUG5qthBubG2uXOzQ0VKCQDXx4s25RdDo8k14tMheIMXd', '0', '', 1, '14', '2019-01-28 08:59:31', '2019-04-01 16:53:12', NULL, '1', '23.07129066383203', '72.51543549012378', '', '', 0, 1, 0),
(36, 'pooja@excellentwebworld.in', '$2y$10$lmY8XIuPSNGwDoxNHjwFd.XsfXeS.Q9KHOm0PSciYzx5H/5BvSsjS', 'Pooja', 'customer_1551427005.jpg', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '2019-03-30', '', 2, 'f3xS2tcdokw:APA91bGTJrtOslG7rZPxe5Ln9Omds4tmafGpd09_7QlBoKeNBPntwM-1zTS8mDkLVPj1nzG8AXRj_Wd4obDIJ2xwkut5p8hfG-3eo816LXGdYb9SIISi84fUac02ZJqMOMqUooSso2PQ', '0', '', 1, '33', '2019-03-01 06:14:02', '2019-03-02 07:03:35', NULL, '1', '23.07271841026387', '72.51637852397903', '', '', 1, 1, 1),
(37, 'developer.eww5@gmail.com', '$2y$10$kf5slIKW6A0.9bhyi/jFW.9gmM90RdZADh5jLPlr9JJfKNpM5jLzu', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '111-111-1111', '1996-12-12', '', 0, 'ej1d0qJEZsU:APA91bGBLPdUqLEMJaDUYAs0o27Vu7JLLa3rStanyp2RZn8NZwEncRRNTegQvap7YfU3IwZ_3GnAM-qGbmlhX9dHb2Wzx6WXFvSB5csgCbnHcLGINEbBcskGM8NIs_DhkNNh6LBTw_BB', '0', '', 1, '', '2019-03-01 06:20:34', NULL, NULL, '0', '23.0727664', '72.5163406', '8fd14c230b0a650bd3593de1aba2f6ab9b515b18', '', 1, 1, 1),
(38, 'developer.ewweww2@gmail.com', '$2y$10$GbJgiU7VHBgoHOaL5JRq4O3G3Z47f5KUWpWO3mGpcjUPlIx953j06', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '111-111-1111', '1996-12-12', '', 0, 'ej1d0qJEZsU:APA91bGBLPdUqLEMJaDUYAs0o27Vu7JLLa3rStanyp2RZn8NZwEncRRNTegQvap7YfU3IwZ_3GnAM-qGbmlhX9dHb2Wzx6WXFvSB5csgCbnHcLGINEbBcskGM8NIs_DhkNNh6LBTw_BB', '0', '', 0, '', '2019-03-01 06:37:32', NULL, NULL, '0', '23.0727664', '72.5163406', '', '9fc031ca9c43028a29a6d1e16d8bafcc65f52c07', 1, 1, 1),
(39, 'dianahedlund123@gmail.com', '$2y$10$.u67p3.xpo5M33.WK4/kkuMfsMgTHAZhgSBhJ/wQ1P/Yx/6T7hzrO', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '1994-12-25', '', 0, 'fAQoL84MV60:APA91bGFDEWSxdbWd2kFlGi2iSzBW2k-PcxeRUoj3Q2H3_yghSi6bcDzqmbVUKnGJxi9_ec5fp30dL6fI7hY76FZV1XoZNB_NKQcb185tSoQuq4zyM2a3sZ6IoNIcybybMyQwoeK27JO', '0', '', 1, '', '2019-03-01 06:48:38', NULL, NULL, '1', '23.07275', '72.5163385', '', '', 1, 1, 1),
(40, 'r@r.com', '$2y$10$vWn4yoO9j80noylM8SmeJ.W0Enui99kvfTJvqof9WP0V0J6xPep5m', 'Dhrumi', '', 'Sarvanad Society Opp. Ramdev Mandir, 14, CIMS Hospital Road, Ahmedabad, Gujarat 380060, India', '999-999-9999', '2019-03-01', '', 0, 'af8b52580c7e6f275ba5f99dd45d4881428e5b2e479fcbdc8c6a1c3f063f2442', '0', '', 0, '', '2019-03-01 12:09:57', NULL, NULL, '0', '23.07094709289872', '72.51622031254746', '', '5b73e1486c470f37e7a297b6d9576b0867bd3e2e', 1, 1, 1),
(41, 'r@t.com', '$2y$10$PS0p2rCqnWCJdPdAIKhFGOquXaFOOK4Tnc0yDWoj98WdBk2sahG1y', 'Dhrumi', '', 'Science City Rd, Sola, Ahmedabad, Gujarat 380059, India', '999-999-9999', '2019-03-01', '', 2, 'eTRh7aY-m00:APA91bEJkh42HtRuGeb3M9rL1zxLgyp3Czie7k7RA29knhQAAh6-_EAarXJvIRcG8QxqvDT7BbTrqMtcvtJ1Pf1jAYyc48Ns0RvofRVPb16zWNjMrOZ5amkfZwa3WJcHP7wb6TXhs34L', '0', '', 1, '95', '2019-03-01 12:14:11', NULL, NULL, '0', '23.07081604003906', '72.51264953613278', '', '', 1, 1, 1),
(42, 'poojapanchal8512@gmail.com', '$2y$10$vbHV9Y2VbzhXyN7geFat5.ICRVq1mo6qa.Ed1.lPOuJgPi12Xdkk2', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '2019-04-19', '', 0, 'fAQoL84MV60:APA91bGFDEWSxdbWd2kFlGi2iSzBW2k-PcxeRUoj3Q2H3_yghSi6bcDzqmbVUKnGJxi9_ec5fp30dL6fI7hY76FZV1XoZNB_NKQcb185tSoQuq4zyM2a3sZ6IoNIcybybMyQwoeK27JO', '0', '', 1, '', '2019-03-04 05:31:21', NULL, NULL, '1', '23.07275', '72.5163385', '', '', 1, 1, 1),
(43, 'dhrumi_cl@mailinator.com', '$2y$10$0fLYzRKhLakLC.OhZcQEyeW5wGLhcmTxex7xTkkYg8n7KxfEEDYky', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '886-658-0502', '2015-02-01', '', 1, 'dvhmaXXa9OY:APA91bEWtwXyhYdcWERiXbLsMSv8UMmK_ZJ1qAjxydeMQUgFDRzZXkHxl8oI0Ww4d4bpIetX4VmdQzWD7rD6-S6TR8pOOIWb8MltRF6P8djOL3lE45Gb5zr0-9ceyALIZrCL279cEJEE', '0', '', 1, '', '2019-03-05 07:05:35', NULL, NULL, '1', '23.0727445', '72.5163463', '', '', 1, 1, 1),
(44, 'BoogerDanger12@mailinator.com', '$2y$10$rbOqEIZxgXl7scZsYYoYneMJfX5voBiFFbRRxy9dUZGqQCiB7udn.', 'Dhrumi', '', '', '774 587 1458', '2019-03-05', '', 0, '', '0', '', 1, '', '2019-03-06 13:55:05', NULL, NULL, '0', '', '', '', '51189b74c7d0a99a7ee15977e958f280fdc5bd4b', 1, 1, 1),
(45, 'sunvenk04@gmail.com', '$2y$10$5POx1wYJJcHog1m.WY2BseTo5fb9xp0Zas4GPINGh2VIJxRgK.Sc2', 'Sunvek', 'customer_1553567521.jpg', '25, 1st Cross Rd, Prakash Nagar, Rajaji Nagar, Bengaluru, Karnataka 560021, India', '866 016 6775', '1986-03-28', '', 1, 'cYJ9POWMV0U:APA91bF0ePsXE1bhJziPciKR1lH0-DxPz5_qd4InH8Ox3ICg5Qq7gEY1dv1ijjKoltoBCaxSGMJFGd06sBaqqljWK6HkrpuxVBcNhA9B0M9mldIv_HSSqrt8jvDOJAJ_cWpO0xhGRryz', '0', '', 1, '86', '2019-03-07 02:27:30', '2019-04-15 17:11:22', NULL, '1', '12.9226916', '77.5446627', '', '', 1, 1, 1),
(46, 'kv@excellentwebworld.com', '$2y$10$k.rZnFVGeWqVCSG.uTHEfOpCBTKrAn03H.o9zbwczRceQhwvUtKkS', 'Dhrumi', '', '', '999 835 9464', '1991-09-12', '', 0, '', '0', '', 1, '', '2019-03-07 12:06:20', '2019-04-01 10:12:20', NULL, '0', '', '', '', '', 1, 1, 1),
(47, 'Belgians123@mailinator.com', '$2y$10$88QTuFa/NeNLP4EwQYRdzOP9Fe8DuMZrbwOeoK9YLCFVzQMpbmChi', 'Dhrumi', '', '', '565 655 6545', '2019-03-03', '', 0, '', '0', '', 1, '', '2019-03-07 13:44:53', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(48, 'cl_customer@yopmail.com', '$2y$10$NzXLtcX04VqUo/bZAUiEV.hPdFy2Qv.BcO/ufLrgR6xKPLTIiSqPG', 'Dhrumi', 'customer_1552312125.jpg', '', '775 765 8768', '2019-03-13', '', 1, 'fqIMGxz0PQg:APA91bEVujgp8ZCvd9Z-zJAa4PExqGOHTjoSocDvE1ASqA_0tARPjUuC4yhRv-F15WsWfsB8kMqhMmonO2fY1mcdAwJwwG_uXSnkYsMO4jtptA2KQJpc1jLBqYa2GHxmAbpinFgtMakB', '0', '', 1, '', '2019-03-07 14:02:05', '2019-04-01 11:25:43', NULL, '0', '', '', '', '', 1, 1, 1),
(49, 'binal.nasit26@gmail.com', '$2y$10$yg8./q64sf4xCVYSN4NBz.orJB1QOLs0NzJgK3pDDjR3YhKQjqYem', 'Dhrumi', '', '', '7878616496', '0000-00-00', '', 0, 'f.bfdb', '1', ' ', 0, '', '2019-03-14 06:14:50', NULL, NULL, '1', '45.2356 ', '45.2365', '', '411a00341c7a68e64048edd852d16ef271738e38', 1, 1, 1),
(50, 'bhavesh@excellentwebworld.info', '$2y$10$x1n/fZV/zohKHIX2Vb5mTeGZMIBmWuOgghAIGt0LbVLES9m51H3Om', 'Dhrumi', '', '', '7878616495', '0000-00-00', '', 0, ' ughujhiki', '1', ' ', 1, '', '2019-03-14 06:20:52', NULL, NULL, '1', '16.051253', ' 20.1223', '', '', 1, 1, 1),
(51, 'binal.nasit@gmaill.co', '$2y$10$YWfoGaiBgJK4a1xARDfnduTESozRmnz8.XxBle7auW7/FBxwNd4AG', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '7878616)^^()$(;$,($', '0000-00-00', '', 0, '1234', '1', '1', 0, '', '2019-03-14 07:29:31', NULL, NULL, '1', '23.07269989776014', '72.5163995307786', '', '24834607ba023ebf2036d45d9e4079cfcbb60ed1', 1, 1, 1),
(52, ' Rahul.bbit@gmail.com', '$2y$10$PYEY5QAJf.0Lsldbed0msuymOS.nvPwYgQRUUq/7gCvmbRVVgAjqG', 'Dhrumi', '', '', ' 789067890', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:39:08', NULL, NULL, ' ', ' 23.07271914349111', ' 72.51635833381914', '', '', 1, 1, 1),
(53, ' rahul.bbit@gmail.comz', '$2y$10$3KnB665IcexMEQ5t0e/yLOs8FLFi.vxIpttKfX0pD5Wa7dcmYt6j2', 'Dhrumi', '', '', ' 789067890z', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:39:33', NULL, NULL, ' ', ' 23.07271914349111', ' 72.51635833381914', '', '', 1, 1, 1),
(54, ' binal1@gmail.co', '$2y$10$fEZ9kW6Qin07rqn65LOFpu5kIp/SUc3nBeDkgYXYZIkDHFpeiOdmS', 'Dhrumi', '', '', ' 789067890)5', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:43:44', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(55, ' acns@gmail.com', '$2y$10$wLf5xGSS3ALZxPO5IGiX7eowIrhJL1SvTKW6Y97nO93Tw/XYLaPVK', 'Dhrumi', '', '', ' 7890678967', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:44:36', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(56, ' ravi@excellentwebworld.info', '$2y$10$gHMzQ1iIUYnYFrcAkCjwBO7R3X.Qk2HvkNafUgeOp55oMAXXWM4CC', 'Dhrumi', '', '', ' 7890678562', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:45:02', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(57, ' ravi@excellentweb.com', '$2y$10$h5XKCUElxpWwpmUHmcujFelT/xxi87V78eH7PP1ZR7V7FqfwiR9bK', 'Dhrumi', '', '', ' 78906789652', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:45:56', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(58, 'binal.nasit26@gmail.comq', '$2y$10$7Yr8MRklL8mG9nWfG55Md.vp.nZokObKSQi9quae3fnufD4kaAE8G', 'Dhrumi', '', '', ' 7890678999652', '0000-00-00', '', 0, ' 1234', '1', ' ', 0, '', '2019-03-14 07:46:42', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '08e0909fcec596c1dced2dde72179354d73df9dd', 1, 1, 1),
(59, 'Rahul.eww@gmail.vom', '$2y$10$cELOe4fAF3zyMxq7VRFYqOnRwU2vkc/yYN238mnAXl/kmu0.QnBOK', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '787879889^9', '0000-00-00', '', 0, '1234', '21', '2', 0, '', '2019-03-14 07:50:40', NULL, NULL, '1', '23.07267730888438', '72.51642493032185', '', '0100ce93520df4569fa85be8dcd6ada8bb0381a8', 1, 1, 1),
(60, 'binal.excellentwebworld.info', '$2y$10$JseZGvNcsq9pgKL9gtMIcuO3IQFhbX0r2BLEBnDmgA9227NP0/q7S', 'Dhrumi', '', '', ' 7890678999', '0000-00-00', '', 0, ' 1234', '16', ' ', 0, '', '2019-03-14 07:54:32', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(61, 'raji@excellentwebworld.info', '$2y$10$qpUzXhXPAmI.W53IR3vBXO30rP9eySQPrytArZ56RBj.AiDN0SJjq', 'Dhrumi', '', '', ' 78906789997', '0000-00-00', '', 0, ' 1234', '168', ' ', 0, '', '2019-03-14 07:56:54', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', 'f3c6a4f0a1507b82c5b0e780a7bb174b51809bd8', 1, 1, 1),
(62, 'raju@excellentwebworld.info', '$2y$10$yG4ZHEyjB9x8pKrWG4CYuuly/KSIQZZDbD9OkbiVfNPyGHRfMnNAO', 'Dhrumi', '', '', ' 789067899976', '0000-00-00', '', 0, ' 1234', '1688', ' ', 2, '', '2019-03-14 07:57:11', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '5f9b0f8041719b5bd28167312103dbbf76aceadd', 1, 1, 1),
(63, 'raju.gupta@excellentwebworld.in', '$2y$10$UWvAYGjDtD1y.5M/RFAgluen5/IvU.UDwnK4U7P3mVsv.Jyj36Cou', 'Dhrumi', 'customer_1552565735.jpg', '', '7878616496', '0000-00-00', '', 0, ' ughujhiki', '1688', ' ', 1, '', '2019-03-14 07:59:31', '2019-03-14 12:15:35', NULL, '1', '16.051253', ' 20.1223', '', '', 1, 1, 1),
(64, 'dhrumi_test4@yopmail.com', '$2y$10$RbaltFYO7SY/aEfQHz47vOd.4/7mcQUz6r703GLx1FrxeiAVHdxp.', 'Dhrumi', '', '', '8866541254', '1996-02-19', '', 2, '345345534544', '2147483647', '2', 0, '', '2019-03-19 13:38:16', NULL, NULL, '1', '34534545', '34534545', '', '', 1, 1, 1),
(65, 'dhrumi_test4@yopmail.com', '$2y$10$UJsLV.fl.HdSI3IGAsReUOYocpldWtNXHeEQp84Z2txGB8em9FOta', 'Dhrumi', '', '', '8866541254', '1996-02-19', '', 2, '345345534544', '2147483647', '2', 0, '', '2019-03-19 13:38:25', NULL, NULL, '1', '34534545', '34534545', '', '', 1, 1, 1),
(66, 'dhrumi_test4@yopmail.com', '$2y$10$Jkqz8AwLjx/dczxqKbZ/ZO97k42AmFzdtptqj./5HH8c/hpjuOoTe', 'Dhrumi', '', '34A Jln Pari Burong, Singapore 488701', '8866541254', '1996-02-19', '', 2, '345345534544', '2147483647', '2', 0, '', '2019-03-19 13:40:38', NULL, NULL, '1', '1.3337324', '103.9489276', '', '', 1, 1, 1),
(67, 'dhrumi_test64@yopmail.com', '$2y$10$2TzGT2GrdUyVXONiIpwXrONlqd/K5EAt20gOYfi05wkmMNhSu99za', 'Dhrumi', '', '', '8866541254', '1996-02-19', '', 2, '345345534544', '2147483647', '2', 0, '', '2019-03-19 13:47:21', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(68, 'dhrumi_test645@yopmail.com', '$2y$10$sna9zoWDuzaPLcTT3dMIKebK0DHO5n/ATgls0uS8pwDIgoLDc5K0e', 'Dhrumi', '', '', '8866541254', '1996-02-19', '', 2, '345345534544', '143842899943088', '2', 0, '', '2019-03-19 13:57:12', NULL, NULL, '1', '0', '0', '', '', 1, 1, 1),
(69, 'clicklunch246@gmail.com', '', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '248 675 5518', '1996-12-12', '', 0, 'dvhmaXXa9OY:APA91bEWtwXyhYdcWERiXbLsMSv8UMmK_ZJ1qAjxydeMQUgFDRzZXkHxl8oI0Ww4d4bpIetX4VmdQzWD7rD6-S6TR8pOOIWb8MltRF6P8djOL3lE45Gb5zr0-9ceyALIZrCL279cEJEE', '143842899943087', '1', 1, '', '2019-03-20 07:33:59', '2019-03-31 04:45:27', '2019-04-02 00:00:00', '0', '23.0728456', '72.5163479', '', '', 1, 1, 1),
(70, 'developer.eww4@gmail.com', '', 'Dhrumi', '', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '111-111-1111', '1996-12-12', '', 0, '', '9223372036854775807', '2', 1, '', '2019-03-20 07:51:36', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(71, 'cl_customer@yomail.com', '$2y$10$TdXvq/d2Ajp.gPZUbWypNudG8jcayhL5vD9Lzk.DJwzwr6tevXx7C', 'Dhrumi', '', 'Google Building 40, 1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA', '248-522-9427', '1990-01-01', '', 0, 'eCEGqE-f7kw:APA91bEMnYqSifuhIcV-kKpeRku5nIVpcv1yB8OXIJR83I1n__L-bdupJpAysfV5wi9ZG4xfLQx5DpL6EsPvuZEELXmkL7ZLY24C5pVQXqo0HEOIWZIztjXkguVf1iY5hiFhnBpq2xHB', '', '', 0, '', '2019-03-26 02:20:19', NULL, NULL, '0', '37.4220459', '-122.0840279', '', 'af32d74a8f4e2c6a726560cd97e7d010b521e1af', 1, 1, 1),
(72, 'suma@oviotechnologies.com', '$2y$10$Ty2k8DtIONaEANB7DJowWuSyTpFoBuMSCjNmrSM0ILdWw2IiLAUvC', 'Suma', 'customer_1554038403.png', '747 South Main Street, Plymouth, MI, USA', '248 522 9427', '1960-03-18', '', 1, 'eAA8C-BbBws:APA91bFSn8r0tbwqAu99kHqosZIgvWnBMhghK1P0LCnoCZBEDVd0b8ToLIViH_Sm-U1ea154bqlt-OR-LYBPt4twWwW1awTADsrRFsdUMLu9kN68NBS7x_P7RdxMDbLxA_a9XtJl2afw', '', '', 1, '87', '2019-03-26 02:22:41', '2019-04-14 03:03:47', NULL, '1', '42.331633', '-83.484644', '', '', 1, 1, 1),
(73, 'sheren@mailinator.com', '$2y$10$Jh.ekqBS.LSCq2icA5kbkujmujrUWN2fMF565cdVquvrFLNOidb0S', 'Dhrumi', '', '', '8876541254', '1996-02-19', '', 1, '3453f45534544', '', '', 1, '', '2019-03-26 05:04:09', NULL, NULL, '1', '0', '0', '', '', 1, 1, 1),
(75, 'vinodkummar60@gmail.com', '$2y$10$yQAWraGiIEoqRDOpDjBPZOnx1VjqKbjeKthdGJVPcJlU99JtIlgz2', 'Dhrumi', '', '', '948 218 0768', '1980-02-26', '', 0, '', '', '', 1, '', '2019-03-26 17:50:34', '2019-03-26 23:23:27', NULL, '0', '', '', '', '', 1, 1, 1),
(76, 'sheren2667@mailinator.com', '$2y$10$YBB2jl8uTOzFz5P3zsbmq.Hz3Y5a3Hqzwt/l0ijFm.o7kO82ljyje', 'Dhrumi', '', '', '8077545254', '1996-02-19', '', 1, '3453f45y34544', '', '', 2, '', '2019-03-29 06:59:18', NULL, NULL, '1', '0', '0', '', '', 1, 1, 1),
(77, 'sugar_test66@mailinator.com', '$2y$10$fMt2J7XjPaIoBsKo5Jz51O7nhEcaFIBVuhE488gBWfPyCORnkVBn2', 'Dhrumi', 'customer_1553987132.png', '123 Ann Arbor Road, Plymouth, MI, USA', '556 698 7456', '1989-01-31', '', 0, '', '', '', 2, '', '2019-03-29 11:51:00', '2019-03-31 04:35:32', NULL, '1', '', '', '', '', 1, 1, 1),
(78, 'dhrumi@yopmail.com', '$2y$10$40gQnCrp9AspG0NVyuQZ3.GLHvKUbVdGafr1skk.fOyA0kRFHKwkK', 'Dhrumi', '', '', '886 695 4136', '1990-01-30', '', 0, '', '', '', 1, '', '2019-04-01 08:25:41', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(79, 'dhrumi0049@yopmail.com', '$2y$10$VJF7IgqVyRrQJn1Yneeoau./.v5xGBw.pp58x1qw5RfEAAqrd.qe6', 'Dhrumi', '', '', '564 564 5645', '1990-01-09', '', 0, '', '', '', 1, '', '2019-04-01 08:29:02', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(80, 'mayur.loved@gmail.com', '$2y$10$GsO2xss4T507sm2Ts4XTTOYsbGxr1Vzl.YRRq5DfpQpUfU/VJSISK', 'Mayur Panchal', 'customer_1554208052.jpg', '', '123 456 7890', '1990-01-01', '', 0, '', '', '', 1, '', '2019-04-01 10:41:28', '2019-04-02 17:59:33', NULL, '0', '', '', '', '', 1, 1, 1),
(81, 'dhrumi8890@yopmail.com', '$2y$10$34WkmhNlYNKy2RnoVEhqk.aqkZUnASKHRl1nndLMFDp5doL1IpUsC', 'dhrumi hi', '', '', '774 587 1466', '2019-04-01', '', 0, '', '', '', 0, '', '2019-04-01 13:26:35', NULL, NULL, '0', '', '', '', '0e999ea07418ef599afce595fd197bd2950b623c', 1, 1, 1),
(82, 'developer.eww2@gmail.com', '$2y$10$lS9YZsV7sWu1wKy/1G29vOyMI4Pf3oxQcZRpsS4C0FmRxGN5BbISa', 'customer test', '', '', '343 534 3454', '2019-03-31', '', 0, '', '', '', 0, '', '2019-04-01 13:33:22', NULL, NULL, '1', '', '', '', '0d99cd3e5d130e08a33f4b5897267eb57858b17d', 1, 1, 1),
(83, 'dhrumi_testt123@yopmail.com', '$2y$10$PkgFBnx.AfhnnOszdg9awOPOjL2IwZr7o0cLh/YZoykqpoS3b2PMS', 'dhrumii', '', '', '456 456 4564', '2019-04-02', '', 0, '', '', '', 0, '', '2019-04-02 05:28:23', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(84, 'dhrumi_testt129@yopmail.com', '$2y$10$DjG3xjZJA3vEOTpjKG0W4..H5H1E/xecGFPjLT0cFbUtsB5XW7xXG', 'Dhrumii', '', 'sgnttmjmumnahnmmtmtnt', '456 456 4564', '2019-04-02', '', 0, '', '', '', 1, '', '2019-04-02 05:29:37', '2019-04-08 19:40:42', NULL, '1', '', '', '', '9f0c2924de4b046a272a0a7fa4cf31b8e041bdd2', 1, 1, 1),
(86, 'clicklunch244@gmail.com', '$2y$10$if4sWh4CCRloRreebzx0XelLHawCFK58YZwiYbn6vD.OBcFOb1/nq', 'lunch click', '', '', '234 234 2324', '2019-03-31', '', 0, '', '', '', 1, '', '2019-04-02 05:59:51', NULL, NULL, '0', '', '', '', '', 1, 1, 1),
(87, '1800sri@gmail.com', '$2y$10$paw2cgmrxEd8ZPb3pCzzp.xqdf5knYsrQCmcrYZAgQQ4zRBzLO2oa', 'Sam Venkat', '', '', '734 239 3131', '1979-09-09', '', 0, '', '', '', 1, '', '2019-04-08 00:51:54', '2019-04-14 19:10:57', NULL, '0', '', '', '', '', 1, 1, 1),
(88, 'black@yopmail.com', '$2y$10$ycCVF1Voii5W1ILOwy1W4uP3v0ZcCiAQQZuR1BDIAl06racopAyiW', 'Sheren  Black', '', '', '8077595254', '1996-02-19', '', 1, 'ttttt', '', '', 0, '', '2019-04-09 05:04:18', NULL, NULL, '1', '0', '0', '', '9fb65a21265bd50751cfc66b969c42d79ae1c93b', 1, 1, 1),
(90, 'black0@yopmail.com', '$2y$10$1WnqA3dmMRqVMV5/LtSCFeh0b7KVaKeCN8Gja/79YNBTgrSP.Oq1y', 'Sheren  r', '', '', '8077095254', '1996-02-19', '', 1, 'ttttt', '', '', 0, '', '2019-04-09 05:17:11', NULL, NULL, '1', '0', '0', '', '', 1, 1, 1),
(91, 'black8@yopmail.com', '$2y$10$L.qsTf0qdG1HO/Ez5165lu41y6gVLtiInW6GBJkY3/VnJ2Hft.3gW', 'Sheren  tira', '', '', '8077995254', '1996-02-19', '', 1, 'ttttt', '', '', 0, '', '2019-04-09 05:18:20', NULL, NULL, '1', '0', '0', '', '', 1, 1, 1),
(92, 'black45@yopmail.com', '$2y$10$lclte1GWvYauXchAAyrt/uHdMU3JsRjZuWt8/1FMQ4WJcwy.weCL2', 'Sheren  tira', '', '', '8077695254', '1996-02-19', '', 1, 'ttttt', '', '', 1, '', '2019-04-09 05:18:51', NULL, NULL, '1', '0', '0', '', '0cc391fb3c9842f457be00354aab8073f501d36d', 1, 1, 1),
(93, 'clicklunch24@gmail.com', '$2y$10$NpL8OF86Q6uP7IPMHSpqyerjDpYTOqfBUEikJWIvHC9H4fpvcAaYu', 'Lunch Customer', '', '1 Market Street, San Francisco, CA, USA', '807 769 2258', '1998-02-19', '', 1, 'ttttt', '', '', 1, '', '2019-04-09 05:21:30', '2019-04-09 22:07:09', NULL, '1', '0', '0', '', '', 1, 1, 1),
(94, 'smit@yopmail.com', '', 'lunch customer', '', 'Kwami, Nigeria', '8077692250', '2000-01-01', '', 1, '5646456555555555555555', '777777777777777', '1', 1, '', '2019-04-10 06:33:41', NULL, NULL, '1', '10.333333', '11.2541555', '', '', 1, 1, 1),
(95, 'dhrumi.m@gmail.com', '$2y$10$om83z9zPbHNtMtqNpIML8O.oHHOwY9d/0cS7ovaWxtPL0zDkWkhpO', 'Myrtle A White', '', '', '448 868 4512', '1996-02-15', '', 1, 'fkcY-2EF0LU:APA91bGcgvma2JJzAddFjrJj1dyTrKAlT1j4zVSJIoHKqdb4yyhTo83ZJbuRweQT3MGn5GLqh-oOWMbFtqMBUeRdTywH989KMSzkNgPRXvsV0yVvq97JAFe9-TkWihn0aWDpmff4JR2Z', '', '', 1, '89', '2019-04-12 11:16:54', NULL, NULL, '1', '23.0727448', '72.5162816', '', '', 1, 1, 1),
(96, 't949113@nwytg.net', '$2y$10$mWoglzkeHggMOMngPpPwWeckGOX9Lz.XmJDh4gVNJK3rbYWJYr8uq', 'Tom', '', '', '616 543 8765', '2000-11-10', '', 0, '', '', '', 1, '', '2019-04-13 02:19:23', NULL, NULL, '0', '', '', '', '', 1, 1, 1),
(97, 't1044129@nwytg.net', '$2y$10$KuJTYrPSGuqH82LcWPkYFOt97JGW6vnzHa7YjIwPpy0.kltr6qPMu', 'Tom', '', '', '234 234 2345', '1971-09-09', '', 0, '', '', '', 1, '', '2019-04-13 22:08:16', NULL, NULL, '0', '', '', '', '', 1, 1, 1),
(98, 'dhrumi@mailinator.com', '$2y$10$Cds2DuieIxBDv9Xl7wm7PeCBUfO9mCPBsxLTjcOp06iB7TF67OGWS', 'Dhrumi S', 'customer_1555303985.jpg', '', '448 865 4123', '1990-02-06', '', 0, '', '', '', 2, '94', '2019-04-15 04:51:30', '2019-04-15 10:23:05', NULL, '1', '', '', '', '', 1, 1, 1);

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
  `card_type` int(1) NOT NULL COMMENT '1 - Visa, 2 - Mastercard, 3 - American Express, 4 - JCB, 5 - Diners Club, 6 - discover, 7 -other',
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
(5, 33, 'mayur', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 5, '2019-01-25 08:01:46', NULL, '2019-02-28 09:15:05'),
(6, 33, 'saurav', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'hove', 1, '2019-01-25 12:00:18', '2019-01-25 12:09:11', '2019-02-28 09:15:02'),
(7, 33, 'hoho', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'hiii', 2, '2019-01-25 12:10:18', NULL, '2019-01-25 13:20:06'),
(8, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-01-29 14:48:56', NULL, NULL),
(9, 6, 'Rehan', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-01-30 06:48:12', NULL, '2019-01-30 07:23:15'),
(10, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:53:12', NULL, NULL),
(11, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:54:31', NULL, NULL),
(12, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 07:55:18', NULL, NULL),
(13, 25, 'Siraaaaa', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'bunu', 4, '2019-02-12 09:08:25', NULL, NULL),
(14, 25, 'Siraaagdds', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', 'ggg', 4, '2019-02-12 09:14:09', NULL, NULL),
(15, 6, 'Dhrumi', 'ZqikpXBhYmOgoaZyZGk=', 'XXXX XXXX XXXX 3237', 'Y6aepXU=', 'ZKKk', '', 1, '2019-02-12 09:28:56', NULL, NULL),
(16, 33, 'Siya', 'aKWkqHVmZ2ilpKh1ZWZnpA==', 'XXXX XXXX XXXX 4444', 'ZKCepXBjYw==', 'aqej', '', 2, '2019-02-28 06:35:40', NULL, '2019-02-28 09:15:00'),
(17, 33, 'Siya', 'aKWkqHVmZ2ilpKh1ZWZnpA==', 'XXXX XXXX XXXX 4444', 'Y6KepXBiaw==', 'aqej', '', 2, '2019-02-28 06:35:52', NULL, NULL),
(18, 33, 'Siya', 'ZqWlqXBhZGOin6Z2YWdjpQ==', 'XXXX XXXX XXXX 0505', 'Y6OepXBiaw==', 'aqej', '', 6, '2019-02-28 07:14:56', NULL, NULL),
(19, 33, 'Siya', 'ZqWlqXBhZGOin6Z2YWdjpQ==', 'XXXX XXXX XXXX 0505', 'Y6SepXBiaw==', 'aqej', '', 6, '2019-02-28 07:15:33', NULL, NULL),
(20, 33, 'mayut', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:30:25', NULL, '2019-02-28 09:15:17'),
(21, 33, 'mayut', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:31:11', NULL, '2019-02-28 09:15:16'),
(22, 33, 'mayut', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:31:48', NULL, '2019-02-28 09:15:14'),
(23, 33, 'mayut', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:32:36', NULL, '2019-02-28 09:15:12'),
(24, 33, 'mayut', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:38:05', NULL, '2019-02-28 09:15:19'),
(25, 33, 'mayut', 'Z6CgpXhpamuop6t4YmproQ==', 'XXXX XXXX XXXX 1881', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 07:39:18', NULL, '2019-02-28 09:15:11'),
(26, 33, 'mayut', 'aaCgpHFiY2ShoKRxYmNkpw==', 'XXXX XXXX XXXX 1117', 'Y6aepXBiaw==', 'ZqOi', '', 5, '2019-02-28 07:41:11', NULL, '2019-02-28 09:14:48'),
(27, 33, 'mayut', 'ZqenpXhjZGemoqRwYWJo', 'XXXX XXXX XXXX 0005', 'Y6aepXBiaw==', 'ZqOi', '', 3, '2019-02-28 08:56:08', NULL, '2019-04-12 12:35:28'),
(28, 33, 'mayut', 'Z6KhpXJjZGWioaVyY2Rlog==', 'XXXX XXXX XXXX 2222', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 08:56:29', NULL, '2019-02-28 09:15:09'),
(29, 33, 'ufuf', 'aKGfqHFhZ2SgpKRwZmNjoA==', 'XXXX XXXX XXXX 5100', 'Y6OepXBiaw==', 'ZaKh', '', 2, '2019-02-28 09:04:05', NULL, '2019-02-28 09:14:51'),
(30, 33, 'ufuf', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6eepXBiaw==', 'Zqao', 'jin', 1, '2019-02-28 09:15:44', NULL, '2019-03-22 05:44:19'),
(31, 36, 'pooja', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZKKi', '', 1, '2019-03-02 05:17:42', NULL, '2019-03-02 06:03:27'),
(32, 36, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZKKi', 'test', 1, '2019-03-02 06:30:36', NULL, '2019-03-02 07:28:57'),
(33, 36, 'uft', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6OepXBiaw==', 'ZaKh', '', 1, '2019-03-02 06:54:28', NULL, '2019-03-02 07:28:55'),
(34, 36, 'hvfg', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6OepXBiaw==', 'ZqOi', 'mayurrrr', 1, '2019-03-02 07:02:59', NULL, '2019-03-02 07:28:53'),
(35, 36, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6WepXBjYg==', 'ZKKi', 'test', 1, '2019-03-02 08:17:49', NULL, NULL),
(36, 39, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6WepXBjYg==', 'ZKKi', 'test', 1, '2019-03-02 08:21:13', NULL, NULL),
(37, 36, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZKKi', 'test', 1, '2019-03-04 05:14:16', NULL, NULL),
(38, 43, 'fyyf', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6OepXBjYw==', 'ZaKh', 'hg', 1, '2019-03-05 07:24:34', NULL, NULL),
(39, 42, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZKKi', 'test', 1, '2019-03-08 07:18:57', NULL, NULL),
(40, 48, 'cl me', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZKKi', 'test', 1, '2019-03-08 07:18:57', NULL, NULL),
(41, 45, 'shubxjfj', 'aKOirHdqamympal2amhrpg==', 'XXXX XXXX XXXX 9686', 'Y6OepXBiaw==', 'aKan', 'ghsh', 2, '2019-03-13 10:18:18', NULL, NULL),
(42, 33, 'vyyf', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6OepXBiaw==', 'ZqOi', 'mkl', 1, '2019-03-19 14:13:52', NULL, '2019-03-22 05:44:17'),
(43, 70, 'mayur', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6OepXBiaw==', 'ZqOi', 'nk', 1, '2019-03-20 10:28:45', NULL, NULL),
(44, 33, 'dhdh', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6OepXBjYg==', 'ZqOi', 'nnn', 1, '2019-03-22 05:44:57', NULL, NULL),
(45, 45, 'ghzhzhzhhzjbsb', 'aKWnqXhmZ2mopal0ZWdppg==', 'XXXX XXXX XXXX 4566', 'Y6aepXBiaw==', 'aKah', 'gsinu', 2, '2019-03-25 07:40:53', NULL, '2019-03-26 02:49:28'),
(46, 45, 'ghzhzhzhhzjbsb', 'aKWnqXhmZ2mopal0ZWdppg==', 'XXXX XXXX XXXX 4566', 'Y6aepXBiaw==', 'aKah', 'gsinu', 2, '2019-03-25 07:40:53', NULL, '2019-03-26 02:35:51'),
(47, 45, 'ghzhzhzhhzjbsb', 'aKWnqXhmZ2mopal0ZWdppg==', 'XXXX XXXX XXXX 4566', 'Y6WepXBiaw==', 'aKah', 'gsinu', 2, '2019-03-25 08:11:08', NULL, '2019-03-26 02:35:47'),
(48, 72, 'SC', 'Z6afp3FpaWempKR0amRjpQ==', 'XXXX XXXX XXXX 9205', 'Y6OepXBjYg==', 'aqmn', 'Myvisa', 1, '2019-03-26 02:43:55', NULL, '2019-04-02 21:24:56'),
(49, 45, 'sunitha', 'aKWlq3lnaGilpKd2ZWhppw==', 'XXXX XXXX XXXX 4667', 'Y6OepXBiaw==', 'aKal', 'suni', 2, '2019-03-26 02:49:18', NULL, NULL),
(50, 45, 'ffyhjkngcjovg', 'Z6WnqXNnZ2Wopad1Z2VqpQ==', 'XXXX XXXX XXXX 6375', 'Y6WepXBiaw==', 'a6ak', 'ZsdX', 1, '2019-03-26 08:46:43', NULL, '2019-03-26 23:08:07'),
(51, 80, 'Mayur Panchal', 'Z6Sjp3NkZWaioaVyYmNkoQ==', 'XXXX XXXX XXXX 1111', 'ZKKepXBiaw==', 'ZKKi', 'KOTAK', 1, '2019-04-02 12:30:48', NULL, '2019-04-02 18:01:07'),
(52, 80, 'Mayur', 'Z6Sjp3NkZWaioaVyYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6mepXBjYw==', 'ZKKi', 'Kotak', 1, '2019-04-02 12:32:04', NULL, NULL),
(53, 72, 'Suma', 'Z6WlqnNmaGeioqd2Y2Zppw==', 'XXXX XXXX XXXX 2467', 'Y6SepXBjYg==', 'aqak', 'Myvisa', 1, '2019-04-02 16:09:22', NULL, '2019-04-02 21:39:33'),
(54, 72, 'Rovan', 'Z6KkpHNia2ihoqZ0YmJkqA==', 'XXXX XXXX XXXX 1018', 'Y6mepXBjYg==', 'aqan', 'Roro', 1, '2019-04-02 16:14:06', NULL, '2019-04-02 21:44:23'),
(55, 33, 'saurav', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjYg==', 'ZaKh', 'mayur', 1, '2019-04-11 06:53:23', NULL, NULL),
(56, 46, 'test', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'ZKKepXBjYg==', 'ZKKi', 'test', 1, '2019-04-11 12:15:23', NULL, NULL),
(57, 45, 'sunitha', 'aKWkp3NkZmmpp6x2Z2dopQ==', 'XXXX XXXX XXXX 6555', 'Y6WepXBiaw==', 'a6Wl', 'ghjdji', 2, '2019-04-11 16:41:20', NULL, '2019-04-15 16:55:09'),
(58, 72, 'Sridhara Venkateshaiah', 'Z6KkpHNia2ihoqZ0YmJkqA==', 'XXXX XXXX XXXX 1018', 'ZKGepXBjYg==', 'a6mf', '', 1, '2019-04-11 22:04:21', NULL, '2019-04-12 03:34:54'),
(59, 41, 'rehan', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBiaw==', 'ZKGg', 'rj', 1, '2019-04-12 06:47:18', NULL, NULL),
(60, 41, 'rehan hussain', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBiaw==', 'ZKGg', 'rj', 1, '2019-04-12 06:55:52', NULL, NULL),
(61, 95, 'dhrumi', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6SepXBjZQ==', 'ZaKh', 'ddd', 1, '2019-04-12 12:47:26', NULL, NULL),
(62, 33, 'rehab', 'Z6GgpHFiY2ShoKRxYmNkoQ==', 'XXXX XXXX XXXX 1111', 'Y6aepXBjaw==', 'ZKKf', 'rjjj', 1, '2019-04-12 13:12:10', NULL, NULL),
(63, 72, 'Suma', 'Z6OkpXhoZmipp6xwZWVjow==', 'XXXX XXXX XXXX 4303', 'Y6WepXBiaw==', 'Y6Co', 'My card', 1, '2019-04-13 21:46:17', NULL, NULL),
(64, 98, 'Dhrumi Suthar', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'ZKKepXBiaw==', 'a6in', 'Dhrumi', 1, '2019-04-15 05:15:54', NULL, NULL),
(65, 98, 'Dhrumi Suthar', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'ZKKepXBiaw==', 'a6in', 'Dhrumi', 1, '2019-04-15 05:15:57', NULL, NULL),
(66, 45, 'sunitha', 'Z6aorHlpamumpal2ZmdopQ==', 'XXXX XXXX XXXX 5555', 'Y6WepXBiaw==', 'aaWh', 'Kkjhsji', 1, '2019-04-15 11:40:23', NULL, NULL);

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
(2, 25, 0, 0, 'f33', 'sursagar tower', '', '380016', '23.0680435', '-119.4179324', 'No inst ', '2', 'bunu', '2019-02-27 05:54:39', NULL, '2019-01-21 13:40:17'),
(5, 25, 0, 0, 'f33', 'fgf', '', '380016', '36.778261', '-119.4179324', 'No inst ', '1', 'bunu', '2019-02-27 05:54:39', NULL, NULL),
(6, 25, 0, 0, 'f3355', 'fgf', '', '380016', '36.778261', '-119.4179324', 'No inst ', '2', 'bunu', '2019-03-14 13:44:51', NULL, NULL),
(7, 33, 0, 0, '20', 'kadi', 'patan', '38426', '36.778261', '-119.4179324', 'hey', '1', 'mayur', '2019-03-14 12:52:18', NULL, '2019-03-14 12:52:18'),
(8, 6, 0, 0, 'f33', 'sursagar+tower', 'Ahmedabad', '380061', '23.0680435', '72.5307147', 'No inst ', '2', 'bunu', '2019-01-24 13:17:10', NULL, NULL),
(9, 33, 0, 0, 'fhdy', 'cjig', 'gjkg', '95565', '36.778261', '-119.4179324', 'ncfh', '4', '', '2019-03-14 13:16:50', NULL, '2019-03-14 13:16:50'),
(10, 33, 0, 0, 'fjfj', 'cjjf', 'cjng', '56959', '36.778261', '-119.4179324', 'zv', '3', '', '2019-03-14 13:14:59', NULL, '2019-03-14 13:14:59'),
(11, 6, 0, 0, 'f33', 'sursagar tower', 'Ahmedabad', '380061', '23.0680435', '72.5307147', 'No inst ', '2', 'bunu', '2019-01-24 13:39:58', NULL, NULL),
(13, 0, 0, 1, 'Excellent WebWorld', 'City Center', 'Ahmedabad', '380060', '23.0726414', '72.51423', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-02-18 07:06:00', NULL, NULL),
(14, 35, 0, 0, '411', 'Science city', 'California', '12456', '36.778261', '-119.4179324', '', '3', '', '2019-01-30 10:19:15', NULL, NULL),
(15, 35, 0, 0, '411', 'Science city', 'California', '12456', '36.778261', '-119.4179324', '', '3', '', '2019-01-31 10:03:35', NULL, NULL),
(16, 35, 0, 0, 'f35', 'sursagar', 'ahmedabad', '380016', '23.0489074', '72.6058584', 'No inst ', '2', 'bunu', '2019-03-14 13:44:51', NULL, NULL),
(17, 33, 0, 0, 'f35', 'sursagar', 'ahmedabad', '380016', '23.0489074', '72.6058584', 'No inst ', '2', 'bunu', '2019-03-14 13:25:03', NULL, '2019-03-14 13:25:03'),
(18, 0, 0, 1, 'Salesforce', 'San Francisco', 'California', '94118', '42.3483041', '-71.08359259999997', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-01-31 10:06:03', NULL, NULL),
(19, 33, 0, 0, 'f33', 'sursagar tower', 'ahmedabad', '38001', '23.0680435', '72.5307147', 'No inst ', '4', 'ggg', '2019-03-14 13:29:32', NULL, '2019-03-14 13:26:13'),
(20, 33, 0, 0, 'F-33', 'Sattadhar', 'Ahmedabad', '380061', '23.0672405', '72.5310504', '', '3', 'mayu', '2019-03-14 13:25:14', NULL, '2019-03-14 13:25:14'),
(21, 33, 0, 0, 'F-33', 'Sursagar tower, Sattadhar', 'Ahmedabad', '38006', '23.0674991', '72.5307456', '', '4', 'mayu', '2019-03-14 13:52:45', NULL, '2019-03-14 13:52:45'),
(22, 33, 0, 0, 'fjj33', 'ddd', 'gddfre', '38016', '35.1816448', '-89.7661527', 'No inst ', '2', 'ggg', '2019-03-14 13:20:30', NULL, '2019-03-14 13:20:30'),
(23, 33, 0, 0, '43', 'sattadhar', 'kadi', '38271', '23.0676233', '72.530006', '', '3', 'mayur', '2019-03-14 13:20:28', NULL, '2019-03-14 13:20:28'),
(24, 33, 0, 0, '65', 'sattadhar', 'kadi', '38426', '23.0670686', '72.5310495', '', '1', '', '2019-03-14 13:20:26', NULL, '2019-03-14 13:20:26'),
(25, 33, 0, 0, '803', 'South Ocean Boulevard', 'Myrtle Beach', '29579', '33.6781578', '-78.8950967', '', '4', '', '2019-03-14 13:52:50', NULL, '2019-03-14 13:52:50'),
(26, 33, 0, 0, '6', 'sttadhar', 'kadi', '38426', '23.0681595', '72.5292566', '', '1', '', '2019-03-14 13:20:20', NULL, '2019-03-14 13:20:20'),
(27, 33, 0, 0, '1', 'acv', 'kadi', '38555', '35.9186133', '-84.9609464', '', '4', '', '2019-03-14 13:20:16', NULL, '2019-03-14 13:20:16'),
(28, 33, 0, 0, '44', 'abc', 'abc', '57424', '45.024261', '-98.4500606', '', '3', '', '2019-03-14 13:20:17', NULL, '2019-03-14 13:20:17'),
(29, 33, 0, 0, '111', 'abc', 'abc', '36542', '30.2999788', '-87.6778378', 'No inst ', '2', 'ggg', '2019-03-14 13:20:05', NULL, '2019-03-14 13:20:05'),
(30, 33, 0, 0, '111', 'abc', 'abc', '57424', '45.024261', '-98.4500606', 'No inst ', '2', 'ggg', '2019-03-14 13:20:07', NULL, '2019-03-14 13:20:07'),
(31, 33, 0, 0, '175', '5th Ave', 'New York', '10010', '40.7411774', '-73.989664', '', '1', '', '2019-03-14 13:20:14', NULL, '2019-03-14 13:20:14'),
(32, 37, 0, 0, '12', 'sattadhar ', 'Ahmedabad ', '38425', '23.0681595', '72.5292566', '', '3', '', '2019-03-14 13:44:51', NULL, NULL),
(33, 36, 0, 0, '   ', '   ', '     ', '12345', '34.0410619', '-118.260189', '   ', '2', '', '2019-03-04 04:50:15', NULL, NULL),
(34, 36, 0, 0, 'ahmedabad', 'ahmedabad', 'ahmedabad', '12345', '23.022505', '72.5713621', 'test', '3', 'test', '2019-03-26 17:19:36', NULL, NULL),
(35, 36, 0, 0, 'ahmedabad', 'ahmedabad', 'ahmedabad', '12345', '23.022505', '72.5713621', 'test', '2', 'test', '2019-03-14 13:44:51', NULL, NULL),
(36, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-04-01 13:27:00', NULL, NULL),
(37, 43, 0, 0, '199/2384, pratiksha apartment', 'sola road', 'ahmedabad', '38001', '23.0339859', '72.4742639', 'no instructions ', '3', 'my old home', '2019-03-14 13:44:51', NULL, NULL),
(38, 43, 0, 0, 'saint mark Coptic orthodox church', 'Carolina forest Blvd, myrtle beach', 'South Carolina ', '29579', '33.7589978', '-78.9209908', 'not for now', '4', 'church', '2019-03-12 05:18:00', NULL, NULL),
(39, 43, 0, 0, 'Salesforce', 'San Francisco', 'California', '94118', '42.3483041', '-71.08359259999997', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-03-12 05:17:53', NULL, NULL),
(40, 45, 0, 0, '43445', 'cherry blossom lane', 'canton', '48488', '40.7989473', '-81.378447', '', '4', 'drgbgxv', '2019-03-26 02:34:52', NULL, '2019-03-26 02:34:52'),
(41, 45, 0, 0, '57899', 'cherry wood lane', 'canton', '48488', '42.3032095', '-83.4693053', '', '1', 'dgihsbx', '2019-03-25 06:25:10', NULL, '2019-03-25 06:25:10'),
(42, 45, 0, 0, '43133', 'cherry wood lane', 'canton , Michigan', '48188', '42.3011048', '-83.4680535', '', '3', 'zhfghj', '2019-03-25 06:25:45', NULL, '2019-03-25 06:25:45'),
(43, 33, 0, 0, 'fhdy', 'cjig', 'gjkg', '95565', '40.4451891', '-124.0075476', 'ncfh', '3', '', '2019-03-14 13:20:35', NULL, '2019-03-14 13:20:35'),
(44, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '3', '', '2019-03-14 13:24:49', NULL, '2019-03-14 13:24:49'),
(45, 33, 0, 0, '1', 'acv', 'kadi', '38555', '35.9186133', '-84.9609464', '', '3', '', '2019-03-14 13:19:59', NULL, '2019-03-14 13:17:05'),
(46, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '3', '', '2019-03-14 13:24:51', NULL, '2019-03-14 13:24:51'),
(47, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-04-02 16:28:53', NULL, NULL),
(48, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-03-14 13:24:55', NULL, '2019-03-14 13:24:55'),
(49, 48, 0, 0, '1', 'Mecklenburg County', 'North Carolina', '28202', '35.2299431', '-80.8373539', '', '4', '', '2019-03-14 13:44:52', NULL, NULL),
(50, 48, 0, 0, '1', 'Mecklenburg County', 'North Carolina', '28202', '35.2299431', '-80.8373539', '', '4', '', '2019-03-26 17:19:36', NULL, NULL),
(51, 45, 0, 0, '76738', 'melburng county', 'north coralina', '54634', '43.5983864', '-90.4125181', '', '3', '', '2019-03-25 06:26:20', NULL, '2019-03-25 06:26:20'),
(52, 33, 0, 0, '123', 'bapunagar ', 'Ahmedabad ', '38006', '23.0371238', '72.6255029', '', '2', '', '2019-04-02 13:14:40', NULL, NULL),
(53, 45, 0, 0, '55', '2nd main road,ramachandrapura', 'bangalore', '56002', '12.9871134', '77.5630246', 'near market', '3', 'sunitha', '2019-04-01 17:43:31', NULL, NULL),
(54, 33, 0, 0, 'Sola Road', 'Chanakyapuri', 'Ahmedabad', '380060', '23.06816', '72.5261197', '', '1', '', '2019-03-26 11:52:20', NULL, '2019-03-26 17:22:20'),
(55, 72, 0, 0, '34505', 'S 12 mile', 'Farmington Hills', '48331', '42.4961038', '-83.3916415', 'Press the doorbell', '3', 'My address', '2019-04-02 16:22:42', NULL, '2019-04-02 21:52:42'),
(56, 45, 0, 0, '5', '1 st main road,ramachandrapura', 'Bangalore', '56002', '13.1081802', '77.5791251', 'near ganesha temple', '4', 'suni', '2019-04-01 17:55:19', NULL, NULL),
(57, 72, 0, 0, '1', 'Village ', 'van buren', '48111', '42.2419935', '-83.4327859', '', '1', 'Another office', '2019-04-02 16:22:37', NULL, '2019-04-02 21:52:37'),
(58, 72, 0, 0, '49100', 'Ford Rd', 'Canton,Mi', '48187', '42.3225487', '-83.5235952', '', '4', 'Suma', '2019-04-02 16:23:01', NULL, '2019-04-02 21:53:01'),
(59, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:57:48', NULL, '2019-04-01 14:27:48'),
(60, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:03', NULL, '2019-04-01 14:28:03'),
(61, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:06', NULL, '2019-04-01 14:28:06'),
(62, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:08', NULL, '2019-04-01 14:28:08'),
(63, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:11', NULL, '2019-04-01 14:28:11'),
(64, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:14', NULL, '2019-04-01 14:28:14'),
(65, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', 'near temple', '3', 'Suni', '2019-04-01 08:58:16', NULL, '2019-04-01 14:28:16'),
(66, 75, 0, 0, '556', '2 Nd Main Road', 'Bengaluru', '56002', '12.9298914', '77.5503772', '', '1', 'vins', '2019-04-01 04:35:06', NULL, NULL),
(67, 46, 0, 0, '203-206 , City Center', 'Science City Road', 'Ahmedabad', '38006', '23.0764707', '72.5076035', 'test', '1', 'test by developer', '2019-04-01 08:44:49', NULL, NULL),
(68, 78, 0, 0, '20', 'Fenchurch Street', 'Londan', '33333', '51.5112221', '-0.083525', '45656dghgfhfgh', '3', 'ttbv', '2019-04-01 17:55:19', NULL, NULL),
(69, 33, 0, 0, '12', 'science hill', 'KY', '42553', '37.1745569', '-84.6255639', '', '1', '', '2019-04-01 13:20:16', NULL, NULL),
(70, 33, 0, 0, '12', 'london eye court, las vegas, NV, USA', 'clark county', '89178', '36.0346157', '-115.3054807', '', '3', '', '2019-04-01 13:06:05', NULL, NULL),
(71, 33, 0, 0, '1', 'Ahmedabd', 'Ahmedabad', '38006', '23.022505', '72.5713621', '', '2', '', '2019-04-01 13:18:11', NULL, NULL),
(72, 33, 0, 0, '13', 'Ahmedabad', 'Ahmedabad', '38006', '23.022505', '72.5713621', '', '4', '', '2019-04-01 13:19:19', NULL, NULL),
(73, 33, 0, 0, '123', 'Ahmedabad', 'Ahmedabad', '38006', '23.022505', '72.5713621', '', '4', '', '2019-04-01 13:21:53', NULL, NULL),
(74, 33, 0, 0, '124', 'Ahmedabad', 'Ahmedabad', '38009', '23.022505', '72.5713621', '', '4', '', '2019-04-01 13:21:28', NULL, NULL),
(75, 33, 0, 0, '125', 'Ahmedabad', 'Ahmedabad', '38595', '23.022505', '72.5713621', '', '3', '', '2019-04-01 13:22:02', NULL, NULL),
(76, 32, 0, 0, '5,1st Main Road', 'Ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', '', '3', '', '2019-04-01 18:05:22', NULL, NULL),
(77, 45, 0, 0, '5', '5,1st Main Road,ramachandrapura', 'Bengaluru', '56002', '12.9907873', '77.5638528', '', '3', '', '2019-04-02 16:28:53', NULL, NULL),
(78, 72, 0, 0, '12020', 'North Meadow Springs Drive', 'Holland', '49424', '42.824506', '-86.079039', '', '4', '', '2019-04-02 16:30:40', NULL, '2019-04-02 21:59:46'),
(79, 72, 0, 0, '7017', '7017 Fox Hills Road', 'Canton', '48187', '42.3322208', '-83.4843788', '', '3', '', '2019-04-03 02:29:37', NULL, '2019-04-02 22:01:00'),
(80, 72, 0, 0, '9401', 'Hurstbourne Trace', 'Louisville', '58393', '38.251764', '-85.5810275', '', '4', 'Homewood', '2019-04-11 15:29:57', NULL, '2019-04-11 20:48:17'),
(81, 72, 0, 0, '1', 'Anystree', 'Nevada', '84849', '38.8026097', '-116.419389', '', '4', '', '2019-04-11 15:18:25', NULL, '2019-04-11 20:48:25'),
(82, 48, 0, 0, 'Science City', 'Sola', 'Ahmedabad', '38001', '23.0734419', '72.5145094', '', '2', '', '2019-04-08 00:57:37', NULL, NULL),
(83, 87, 0, 0, '43433 ', 'Cherrywood Lane', 'Canton', '48188', '42.3013697', '-83.4683268', '', '1', 'Office', '2019-04-11 10:33:59', NULL, NULL),
(84, 36, 0, 0, 'J-101', 'akash residency', 'ahmedabad', '123456', '23.0070113', '72.4595104', '', '2', '', '2019-04-08 09:21:48', NULL, NULL),
(85, 36, 0, 0, 'tesr', 'tesr', 'Ahmedabad ', '123456', '23.022505', '72.5713621', 'test', '2', 'test', '2019-04-09 11:44:01', NULL, NULL),
(86, 45, 0, 0, '78,', '3 Cross,bda Layout,banasankari', 'Bengaluru', '560085', '12.9311176', '77.5532457', 'near ganesha temple', '1', 'amma', '2019-04-11 15:29:57', NULL, NULL),
(87, 72, 0, 0, '7017', '7017 Fox Hills Road', 'Canton', '48187', '42.3322208', '-83.4843788', '', '4', '', '2019-04-14 13:43:47', NULL, NULL),
(88, 41, 0, 0, '204', 'science city', 'Ahmedabad ', '380056', '23.0720516', '72.5164557', '', '1', '', '2019-04-12 05:47:38', NULL, NULL),
(89, 95, 0, 0, '199/2384, Pratikha Appartment', 'Sola Road, Naranpura', 'Ahmedabad', '380016', '23.0614738', '72.5347584', 'Be aware of street dogs', '4', 'Old Home', '2019-04-13 22:14:38', NULL, NULL),
(90, 0, 0, 1, '78', '3 rd cross,4 th block,jayanagar', 'Bengaluru', '560021', '12.9306057', '77.5898167', 'Report to the security,,', '2', 'Bangalore location', '2019-04-12 15:17:07', NULL, NULL),
(91, 45, 0, 0, '65', '26,jai mata temple Street', 'ahmedabad,gujrat', '38856', '23.0144279', '72.5447862', 'call before coming', '4', 'other loc', '2019-04-13 17:42:04', NULL, NULL),
(92, 97, 0, 0, '7076', 'Foxhills Road', 'Canton', '48187', '42.3325309', '-83.4838242', '', '1', '', '2019-04-14 13:43:47', NULL, NULL),
(93, 87, 0, 0, '43434', 'Cherrystone Drive', 'Canton', '48188', '42.3048582', '-83.4694027', '', '1', 'Nearby Office', '2019-04-15 05:15:21', NULL, NULL),
(94, 98, 1, 0, 'City Center', 'Science City Road, Sola Road', 'Ahmedabad', '380016', '23.0708888', '72.5181041', 'Hrllo', '2', 'my name', '2019-04-15 05:15:21', NULL, NULL),
(95, 41, 0, 0, 'city center', 'science city Road, sola', 'Ahmedabad ', '380016', '23.0708888', '72.5181041', 'hellop', '2', 'huh', '2019-04-15 05:26:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address_popular_request`
--

CREATE TABLE `delivery_address_popular_request` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `address_type` varchar(1) NOT NULL COMMENT '1 - office, 2 - office buliding , 3 - home, 4 - other',
  `nickname` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address_popular_request`
--

INSERT INTO `delivery_address_popular_request` (`id`, `customer_id`, `house_no`, `street`, `city`, `zipcode`, `latitude`, `longitude`, `address_type`, `nickname`, `created_at`, `deleted_at`) VALUES
(1, 0, '1', 'village center dr', 'Van buren', '48111', '', '', '1', '', '2019-04-13 13:11:35', NULL);

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
  `device_type` smallint(3) NOT NULL COMMENT '1- android, 2 -ios',
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

INSERT INTO `delivery_boy` (`id`, `email`, `password`, `cl_id`, `profile_picture`, `username`, `mobile_number`, `device_type`, `device_token`, `status`, `preferred_city`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`, `remember_token`, `activation_token`) VALUES
(1, 'test@gmail.com', '', 'CL33', '', 'my boy', '8866584215', 0, '', 2, 'Kansas City', '', '', '2019-01-10 11:05:00', NULL, NULL, '', ''),
(2, 'BusyToots@mailinator.com', '$2y$10$oq/zjIL6zGuPK6xRahxHsOxtn0f9Yy/Dglx7w.nUstBe.OPQIR9tS', 'CL33', 'delivery_boy_1549026759.jpg', 'Ooo', '5566845124', 0, 'hjhjkhjkhjkhkj', 1, 'Kansas City', '', '', '2019-01-10 07:00:44', '2019-02-01 13:12:39', NULL, 'ae7fc785053f9a90de64d3ce0a79675c3b71d8b5', ''),
(3, 'vendor@eww.com', '$2y$10$9ks4zgxM0zo4RfkllPf6RefgpxTqWZaWwTFm064616mkg4TbCbnoO', 'CL33', '', 'Clicklunch', '2498976678', 0, '', 2, 'Kansas City', '', '', '2019-01-12 21:03:29', NULL, NULL, '', ''),
(4, 'suma@oviotechnologies.com', '$2y$10$Y2RT0qnBCJdhw5B5drJBDOAlRvVWyCfIKpD0Q3nmI0Sa/El9TnjlK', 'CL33', '', 'Clicklunch', '2498976678', 0, '', 2, 'Kansas City', '', '', '2019-01-12 21:04:08', NULL, NULL, '', ''),
(5, 'sunvenk04@gmail.com', '$2y$10$O8fPYMJwGEdYuYHp0uAVNeUA/zcegvr6VgeLDxghL/bl/NfMoUbWW', 'CL33', 'delivery_boy_1554813639.jpg', 'Sunitha Vinod', '9902366824', 0, '', 1, 'Kansas City', '', '', '2019-01-14 09:23:15', '2019-04-09 18:10:39', NULL, '', ''),
(6, 'PieGeek@mailinator.com', '$2y$10$CYf7oiAPLbu/oA7QrLHUNeZPmFKbrZmGWd0YK5XapgQ031ngGQzuK', 'CL33', '', 'Pie Geek', '333 333 3333', 0, '', 1, 'Kansas City', '26.4685668', '-81.76799640000002', '2019-01-23 11:10:19', '2019-02-01 05:43:35', NULL, '', ''),
(7, 'Shabby@mailinator.com', '$2y$10$DzjXChZH73AsBEWFNbLmKOL4hwB1QZoXSiK/wEztLKdi3zSEZ1qPC', 'CL33', '', 'Shabby Dog', '777 777 7777', 0, '', 1, 'Kansas City', '', '', '2019-01-23 11:11:41', NULL, NULL, '', ''),
(8, 'ZanyThunder@mailinator.com', '$2y$10$6Y.XcJuLYA9WqPwbXREu2.GRHyg4OCKo5pdZ2JWs78sp20Y5iRHIO', 'CL33', '', 'Zany T Hunder', '774 587 1466', 0, '', 1, 'Vienna, VA, USA', '38.9012225', '-77.26526039999999', '2019-01-23 11:33:04', '2019-02-07 05:45:00', NULL, '', ''),
(9, 'dhrumi@reconmail.com', '$2y$10$oq/zjIL6zGuPK6xRahxHsOxtn0f9Yy/Dglx7w.nUstBe.OPQIR9tS', 'DB9', 'delivery_boy_1552288161.jpeg', 'Dhrumi', '9874563210', 2, 'eOgQaO9mkjc:APA91bG5G1MjhOgZYccq99UOYGy-VeRRETlPEKk5_ShlRA0Fwdqrl7SqYsSa0KRmLxCnndVTZkigZyghbvNd_e4a80So_EjhMIB_3fh_tJXzg7bcKuajj8Xw-HAIU0IU_SUZMlyU92f0', 1, 'Buckingham Palace', '0', '0', '2019-01-10 07:00:44', '2019-04-03 10:29:50', NULL, '9172c0eaba6526baef1ea35aac620016e3d135d4', ''),
(10, 'thomas@gmail.com', '$2y$10$5YLRV0iAz6BTaD2N1QP/ju8co4eqWljBkhwuQdqI5A.SC9brzsVHK', '', 'delivery_boy_1549518890.jpg', 'Thomas', '456 778 8899', 0, '', 1, 'Greensboro, NC, USA', '36.0726354', '-79.79197540000001', '2019-02-07 05:54:50', NULL, NULL, '', ''),
(11, 'db2@yopmail.com', '$2y$10$Umi2xUIhIwDnSkpfpPWlQuvq7f.AXtYr0.Qq27NxpR9NzGL6cRhTG', 'DB11', 'delivery_boy_1552025401.jpg', 'Delivery Boy Brown', '546 456 4565', 0, '', 1, 'Houston, TX, USA', '', '', '2019-03-08 06:00:38', '2019-03-08 06:10:01', NULL, '', ''),
(12, 'suma1@oviotechnologies.com', '$2y$10$h/XsyoT6R6StrJIZACk77OV3Y1l7cSKA8Xp7vacfX7FpRIsvYNq2i', 'DB12', '', 'DJT', '234 324 5245', 0, '', 2, 'Canton, MI, USA', '', '', '2019-03-27 05:27:04', NULL, NULL, '', ''),
(13, 't999190@nwytg.net', '$2y$10$LNrvSSWywlEOII8XEhUjaergsXbNbQrZGm.M3l5lOpEFF.j3cLmdC', 'DB13', '', 'DJT', '123 434 3434', 0, '', 2, 'Canton', '', '', '2019-04-13 19:14:49', NULL, NULL, '', ''),
(14, 'sumakpn@yahoo.com', '$2y$10$57Ekv683DBFig5ySZjpmd.oBlIbQ3GSwvkjeOGej2hZ7QAtaswEgC', 'DB14', '', 'Sumana', '248 605 8831', 0, '', 1, 'Canton, MI, USA', '', '', '2019-04-13 19:40:39', NULL, NULL, '', '');

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
  `activation_token` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_dispatcher`
--

INSERT INTO `delivery_dispatcher` (`id`, `email`, `password`, `profile_picture`, `full_name`, `contact_no`, `address`, `city`, `state`, `country`, `zip_code`, `latitude`, `longitude`, `status`, `activation_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dispatcher@gmail.com', '', '', 'dispatcher one', '', '', '', '', '', '', '', '', 1, '', '', '2019-01-02 09:31:53', '2019-01-14 08:51:46', NULL),
(2, 'dispatcher2@gmail.com', '', '', 'dispatcher two', '', '', '', '', '', '', '', '', 2, '', '', '2019-01-03 09:31:53', NULL, '2019-01-02 06:49:34'),
(3, 'deliverydispatcher@gmail.com', '$2y$10$5bllpD4EDDtQirrFD4Jr7u.6Osz.gQx6J.7pOr8rDvW5/CzNZErgG', 'dispatcher_1547186657.png', 'Deliverydispatcher Three', '5656657567567', 'DSS and E Middle Tpke, Manchester, CT, USA', '', '', '', '', '', '', 1, '', '', '2019-01-02 07:07:22', '2019-01-11 06:04:17', NULL),
(4, 'deliverydispatcher4@excellentwebworld.in', '$2y$10$Z0crSvWW855EpkF7GKL0XeIbEHkcXhCOcvU4ECAJyEzIHvyuBmguG', 'dispatcher_1555332250.jpg', 'Jane Mark Clark', '488 745 6897', 'Old Canton Lane, East Lansing, MI, USA', 'Ingham County', 'Michigan', 'United States', '48823', '', '', 1, '', '', '2019-01-02 07:09:10', '2019-04-15 18:14:10', NULL),
(5, 'sunvenk04@gmail.com', '$2y$10$ri16BYgvYI9xXLkIFNIatuy14yoZVw5ELFsYQ2znlin.eq4WSGX3K', '', 'Sunitha', '9902366827', '#5,1 floor,1 main road,rama chandra purhgdsj', '', '', '', '', '', '', 2, '', '', '2019-01-14 08:47:16', '2019-01-14 08:50:39', '2019-01-14 08:50:47'),
(6, 'sunvenk04@gmail.com', '$2y$10$xqb0fY30frqMsmacIf.VcOPxog6CWQ8FFD/5mBdyWin/J.PNzxQMO', '', 'Sunitha', '9902366824', '#5,1 floor,1 main road,rama chandra pura', '', '', '', '', '', '', 1, '', '', '2019-01-14 08:52:25', NULL, NULL),
(7, 'admin@eww.com', '$2y$10$kl0O4pDCQyRwKm6leF.xEeuH5O001T0CQf0eOjNs9AQrwPlNBsg3q', 'delivery_dispatcher_1553644117.png', 'DJT', '234 234 3252', '345 North Canton Center Road, Canton, MI, USA', 'Wayne County', 'Michigan', 'United States', '48187', '42.3045569', '-83.4872145', 1, '', '', '2019-03-27 05:18:13', '2019-03-27 05:18:37', '2019-03-27 05:18:41'),
(8, 'sumakpn@yahoo.com', '$2y$10$cNMVnc99PzPJy/qmmTc4SOcdklf7IUUDsiW9YX64tYtLfHEGKUfm.', 'delivery_dispatcher_1553644359.png', 'Suma C', '248 678 5598', '7017 Fox Hills Road', 'Canton', 'MI', 'United States', '48188', '', '', 1, '', '', '2019-03-27 05:22:15', '2019-03-27 05:22:39', NULL),
(9, 'dhrumi.m96@gmail.com', '', 'delivery_dispatcher_1555131865.png', 'Dhrumi', '886 658 0502', 'Sattadhar Cross Road, Vardhamankrupa Society, Ghatlodiya, Ahmedabad, Gujarat, India', 'Ahmedabad', 'Gujarat', 'India', '380081', '34.0197481', '-118.28239919999999', 0, 'a0689def2e802f96d4d8d7b6e5d567c2fcde0681', '', '2019-04-13 10:34:25', '2019-04-13 18:58:51', NULL);

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
(23, 1, 'new_registration_vender', 'Activate Your Click Lunch Account', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b203c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e57656c636f6d6520746f20636c69636b206c756e6368213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f7572206163636f756e7420686173206265656e207375636365737366756c6c7920637265617465643c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d227b61637469766174696f6e5f6c696e6b7d22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e4163746976617465204163636f756e743c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-03-07 12:22:35', 1),
(24, 6, 'subscribe', 'Subscription Successful', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e5468616e6b20596f75213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f752068617665207375636365737366756c6c7920737562736372696265643c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d22687474703a2f2f7777772e636c69636b6c756e63682e636f6d2f22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e566973697420436c69636b204c756e63683c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-03-29 17:16:29', 1),
(25, 7, 'account_deactivated', 'You are blocked!', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f706572736f6e2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e3c7370616e207374796c653d22666f6e742d66616d696c793a20526f626f746f2c2073616e732d73657269663b20746578742d616c69676e3a206c6566743b223e596f7572204163636f756e742057617320426c6f636b65643c2f7370616e3e213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e436f6e7461637420636c69636b6c756e6368266e6273703b7465616d20666f7220616e792071756572793c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d2268747470733a2f2f7777772e636c69636b6c756e63682e636f6d2f636f6e746163742d757322207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e436f6e74616374204e6f773c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-04-08 16:18:59', 1);
INSERT INTO `email_template` (`id`, `emat_email_type`, `emat_email_name`, `emat_email_subject`, `emat_email_message`, `created_at`, `updated_at`, `emat_is_active`) VALUES
(26, 8, 'account_re_activated', 'You Are Activated!', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b206c696e652d6865696768743a20323870783b206261636b67726f756e642d636f6c6f723a20726762283233352c203234352c20323530293b2070616464696e673a203430707820323470783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203470783b206c696e652d6865696768743a20333970783b223e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20333070783b223e3c666f6e7420636f6c6f723d22233234326233642220666163653d22526f626f746f2c2073616e732d7365726966223e3c623e436f6e67726174756c6174696f6e733c2f623e3c2f666f6e743e3c2f7370616e3e3c666f6e7420636f6c6f723d22233234326233642220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e3c7370616e207374796c653d22666f6e742d73697a653a20333070783b223e3c623e213c2f623e3c2f7370616e3e3c2f666f6e743e3c2f68323e3c70207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b206d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b223e596f7572206163636f756e7420686173206265656e20726561637469766174656420627920636c69636b6c756e6368266e6273703b7465616d3c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b206d61782d77696474683a2036333270783b206d617267696e3a2032307078206175746f203070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d2268747470733a2f2f7777772e636c69636b6c756e63682e636f6d2f636f6e746163742d757322207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e566973697420436c69636b6c756e63683c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-04-08 16:19:23', 1),
(27, 9, 'shop_requested', 'New Restaurant Request Received', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b206c696e652d6865696768743a20323870783b206261636b67726f756e642d636f6c6f723a20726762283233352c203234352c20323530293b2070616464696e673a203430707820323470783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f6e6f74696669636174696f6e732d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22636f6c6f723a207267622833362c2034332c203631293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20333070783b20666f6e742d7765696768743a20626f6c643b206d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203470783b206c696e652d6865696768743a20333970783b223e4e65772052657175657374205265636569766564213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b223e7b706572736f6e5f6e616d657d206861732072657175657374656420666f72206c697374696e67266e6273703b3c2f7370616e3e3c2f666f6e743e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20313970783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e72657374617572616e74266e6273703b3c2f666f6e743e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b20636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20746578742d616c69676e3a206c6566743b223e7b73686f705f6e616d657d2e3c2f7370616e3e3c2f703e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2019-04-09 18:30:00', '2019-04-09 19:05:00', 1),
(28, 10, 'order_completed', 'Thank You For Ordering', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b206c696e652d6865696768743a20323870783b206261636b67726f756e642d636f6c6f723a20726762283233352c203234352c20323530293b2070616464696e673a203430707820323470783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f6e6f74696669636174696f6e732d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22636f6c6f723a207267622833362c2034332c203631293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20333070783b20666f6e742d7765696768743a20626f6c643b206d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203470783b206c696e652d6865696768743a20333970783b223e5468616e6b20596f7520466f72204f72646572696e67213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b223e596f7572206f72646572206e6f3a207b6f726465725f69647d2066726f6d207b73686f705f6e616d657d266e6273703b3c2f7370616e3e3c2f666f6e743e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20313970783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e72657374617572616e74266e6273703b3c2f666f6e743e3c2f7370616e3e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d736572696622207374796c653d22746578742d616c69676e3a206c6566743b223e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b223e6973266e6273703b3c2f7370616e3e3c2f666f6e743e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20313970783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e636f6d706c657465642e3c2f666f6e743e3c2f7370616e3e3c2f703e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2019-04-11 18:30:00', '2019-04-11 12:11:40', 1),
(29, 11, 'order_cancelled', 'Order Cancelled', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d226d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b206c696e652d6865696768743a20323870783b206261636b67726f756e642d636f6c6f723a20726762283233352c203234352c20323530293b2070616464696e673a203430707820323470783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f6e6f74696669636174696f6e732d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22636f6c6f723a207267622833362c2034332c203631293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20333070783b20666f6e742d7765696768743a20626f6c643b206d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203470783b206c696e652d6865696768743a20333970783b223e596f7572204f7264657220486173204265656e2043616e63656c6c6564213c2f68323e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b206d617267696e2d746f703a203070783b206d617267696e2d626f74746f6d3a203070783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b223e596f7572206f72646572206e6f3a207b6f726465725f69647d2066726f6d207b73686f705f6e616d657d266e6273703b3c2f7370616e3e3c2f666f6e743e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20313970783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e72657374617572616e7420686173206265656e3c2f666f6e743e3c2f7370616e3e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d736572696622207374796c653d22746578742d616c69676e3a206c6566743b223e3c7370616e207374796c653d22666f6e742d73697a653a20313970783b223e266e6273703b3c2f7370616e3e3c2f666f6e743e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b20666f6e742d73697a653a20313970783b223e3c666f6e7420636f6c6f723d22233832383939612220666163653d2248656c7665746963612c20417269616c2c2073616e732d7365726966223e63616e63656c6c65643c2f666f6e743e3c2f7370616e3e3c7370616e207374796c653d22636f6c6f723a20726762283133302c203133372c20313534293b20666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313970783b20746578742d616c69676e3a206c6566743b223e2e20436f6e7461637420636c69636b6c756e6368207465616d20666f7220616e792071756572792e3c2f7370616e3e3c2f703e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c62723e, '2019-04-13 18:30:00', '2019-04-13 12:55:31', 1);

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
(13, 'fragrant@yopmail.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 1, 58, 'Fragrant', 'One', 'employee_1553619215.png', '313 456 7890', 1, '', '', '2019-03-26 16:53:35', '2019-03-26 22:23:35', NULL),
(14, 'PieMan@mailinator.com', '$2y$10$LKdrd2NF.EQekouM6LZTuODk16IyOwzMB2W6el0Q0usX0PQF9YMGW', 2, 60, 'Employee', 'Jr', 'employee_1547208652.jpg', '', 1, '', '', '2019-01-12 06:18:08', '2019-01-12 06:18:08', NULL),
(15, 'sushmarai@gmail.com', '', 2, 58, 'Sushma', 'Rai', 'employee_1547463494.jpeg', '', 0, '', 'c1a9aa14d06af0efd7ecbd36a6e7756a776e1a18', '2019-01-14 10:58:17', NULL, NULL),
(16, 'MissGuy@mailinator.com', '$2y$10$q3Obzuk2NPHZ5L3p2r8xievEb97nm5P5uPoZUVMxVUq8/ORNi.XDG', 2, 62, 'Miss', 'Guy', 'employee_1547722991.jpg', '', 0, '', '', '2019-01-17 11:05:23', '2019-01-17 11:05:04', NULL),
(17, 'sunitha@oviotechnologies.com', '', 2, 94, 'Sunny', 'Venky', 'employee_1554830704.jpg', '', 0, '', '96def271720486f6b2731522c7fe53a7c5230025', '2019-04-09 17:25:05', NULL, NULL);

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
  `txt3` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `highlight`
--

INSERT INTO `highlight` (`id`, `txt1`, `txt2`, `txt3`, `updated_at`) VALUES
(1, '30', 'Minutes Saved', 'By Ordering With Us', '2019-04-14 02:26:44'),
(2, '99', '% Lunches Delivered', 'Accurately On Time,Every Time', '2019-04-05 18:12:19'),
(3, '15', 'Restaurant', 'Options Per Week', '2019-04-14 02:26:03');

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
  `category_id` varchar(11) NOT NULL,
  `inventory_status` int(1) NOT NULL COMMENT '0 - no, 1 - yes',
  `recommended` int(3) NOT NULL DEFAULT '0' COMMENT '1 - recommended',
  `notify_stock` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `shop_id`, `name`, `short_name`, `cuisine_id`, `quantity`, `price`, `offer_price`, `item_description`, `item_picture`, `is_combo`, `category_id`, `inventory_status`, `recommended`, `notify_stock`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 52, 'Masala Frankie', 'masala-frienkie', 10, 34, '60.00', '56.00', 'Combine The Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501653.jpg', 0, '3', 1, 0, 12, 1, '2018-11-06 06:24:13', NULL, NULL),
(19, 52, 'Chinese Frankie', 'chinese-frankie', 10, 98, '90.00', '89.00', 'Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501826.jpeg', 0, '3', 0, 0, 0, 1, '2018-11-06 06:27:06', NULL, NULL),
(20, 52, 'Chicken Pizza', 'chicken-pizza', 1, 10, '200.00', '189.00', 'Our Family Will Never Guess That This Fun Twist On Typical Pizza Uses Up Leftover Pesto. Loaded With Protein, Hearty Slices Of This Chicken Pizza\\\" Will Fill Them Up Fast!', 'item_1542019186.png', 1, '3', 1, 0, 0, 1, '2019-04-04 16:11:56', NULL, NULL),
(21, 52, 'Test', 'test', 10, 1, '33.33', '10.00', 'Dfgdfg', 'item_1542018900.jpg', 1, '3', 0, 0, 0, 1, '2018-11-12 06:05:00', NULL, '2018-11-12 06:05:24'),
(22, 52, 'Dhrumi', 'dhrumi', 3, 4, '100.00', '77.00', 'Fgdg', '', 0, '3', 0, 0, 0, 1, '2019-01-07 00:44:50', NULL, '2019-01-07 00:45:04'),
(23, 52, 'Sushi', 'shushi', 10, 100, '100.00', '77.00', '78768ggggg', '', 0, '3', 0, 0, 0, 0, '2019-01-07 00:45:50', NULL, NULL),
(24, 52, 'Burger Meal Combo', 'burger-combo', 2, 0, '100.00', '77.00', 'Dfddf', 'item_1546838672.jpg', 0, '3', 0, 0, 0, 1, '2019-01-07 00:54:32', NULL, NULL),
(25, 52, 'P12', 'p', 3, 1, '100.00', '', 'Our Family Will Never Guess That This Fun Twist On', 'item_1551072323.jpg', 0, '3', 1, 0, 0, 1, '2019-02-25 05:25:23', NULL, NULL),
(26, 52, 'C1', 'c1', 2, 1, '100.00', '9.00', 'Gg', '', 1, '3', 1, 0, 10, 1, '2019-01-07 00:58:20', NULL, NULL),
(27, 58, 'Fresh Mushroomss', 'fresh-mushroomss', 9, 0, '5.00', '4.00', 'Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure', 'item_1547206219.png', 0, '3', 1, 0, 0, 1, '2019-04-05 15:04:59', NULL, NULL),
(28, 58, 'Coco Drinks', 'coco-drinks', 9, 46, '3.00', '2.00', 'Coco Drinks', '', 0, '1', 1, 1, 0, 0, '2019-02-27 10:56:36', NULL, '2019-04-05 15:05:31'),
(29, 58, 'French Fries', 'french-fries', 19, 2, '15.00', '10.00', 'Spicy And Tasty', 'item_1547462625.jpg', 0, '3', 1, 0, 0, 0, '2019-01-14 10:43:45', NULL, '2019-04-05 15:05:33'),
(30, 58, 'Veg Meal + Coco Drinks', 'veg-meal-coco-drinks', 9, 38, '20.00', '15.00', 'Biriyani + Coco Drinks', 'item_1547462856.jpg', 1, '3', 1, 0, 2, 0, '2019-04-04 16:14:59', NULL, '2019-04-05 15:05:26'),
(31, 62, 'Ice Cream', 'ice-cream', 2, 100, '166.00', '150.00', 'Eld Our Little One?s First Birthday Here. The Cake Was Also Made By Fiona From The Restaurant And Was Exactly How I Wanted It. Was Guided By The Owner As To Where I Could Find Party Decorations As Per Our Colour Theme. We Only Needed To Deliver The Things To Them And Did Not Have To Worry About Anything. The Guests Appreciated The Ambience And The Food.. Thank You To The Entire Team For Making Our Special Day Perfect And Hassle Free And Providing Lip Smacking Food To Our Guests.', 'item_1547722922.png', 0, '7', 1, 0, 40, 1, '2019-01-17 11:02:02', NULL, NULL),
(32, 52, 'Farmhouse Pizza', 'farmhouse-pizza', 20, 27, '120.00', '100.00', 'Delightful Combination Of Onion, Capsicum, Tomato & Grilled Mushroom', 'item_1554800309.jpg', 0, '3', 1, 0, 0, 1, '2019-04-09 14:29:20', NULL, NULL),
(33, 52, 'Veg Parcel', 'veg-parcel', 3, 47, '30.00', '25.00', 'Mexican Herbs Sprinkled On Onion, Capsicum, Tomato & Jalapeno', 'item_1551249143.png', 0, '3', 1, 0, 0, 1, '2019-02-27 06:32:23', NULL, NULL),
(34, 58, 'Pizza', 'pizza', 18, 1, '23.00', '22.00', '', '', 0, '5', 1, 1, 0, 0, '2019-04-04 16:14:11', NULL, '2019-04-05 15:05:28'),
(36, 58, 'Pan Cake', 'pan-cake', 20, 0, '55.00', '5.00', 'Cake', '', 0, '6', 1, 0, 0, 1, '2019-04-05 15:20:23', NULL, NULL),
(37, 58, 'Cheese Pizza', 'cheese-pizza', 26, 98, '100.00', '99.00', 'Sddf', '', 0, '5', 1, 0, 0, 1, '2019-04-05 15:21:56', NULL, NULL),
(38, 58, 'Tacos', 'tacos', 20, 5, '66.00', '6.00', '', '', 0, '3', 1, 0, 0, 1, '2019-04-05 15:51:15', NULL, NULL),
(39, 58, 'Honey Cake', 'honey-cake', 18, 43, '55.00', '5.00', 'Fghfg', 'item_1554460210.jpg', 0, '2', 1, 0, 0, 1, '2019-04-05 16:00:24', NULL, NULL),
(40, 58, 'Coke Float', 'coke-float', 9, 100, '10.00', '5.00', '', 'item_1554460901.jpg', 0, '1', 1, 0, 0, 1, '2019-04-05 16:11:41', NULL, NULL),
(41, 58, 'Mc Save Pack', 'mc-save-pack', 20, 0, '20.30', '20.00', '', 'item_1554460963.jpg', 1, '5', 0, 0, 0, 1, '2019-04-05 16:12:43', NULL, NULL),
(42, 86, 'Mexican Rice With Salsa Curry', 'mexican-rice-with-salsa-curry', 19, 71, '148.00', '100.00', 'Cottage Cheese Bell Pepper Rice', 'item_1554466525.jpg', 0, '3', 1, 1, 0, 1, '2019-04-05 17:47:37', NULL, NULL),
(43, 86, 'Punjabi Platter', 'punjabi-platter', 9, 83, '12.00', '10.00', 'Paneer Tikka Served With Kulcha Bread, Salad And Buttermilk.', 'item_1554466753.jpg', 0, '5', 1, 1, 0, 1, '2019-04-09 16:34:30', NULL, NULL),
(44, 86, 'Corn Flakes And Milk', 'corn-flakes-and-milk', 3, 0, '12.00', '10.00', 'Corn Flakes And Milk Corn Flakes And Milk', 'item_1555051231.jpg', 1, '3', 0, 0, 0, 1, '2019-04-12 12:10:31', NULL, NULL),
(45, 88, 'Pizza', 'pizza-1', 9, 5, '200.00', '150.00', 'Capsicum, Fresh Tomatoes', 'item_1554703380.jpg', 0, '5', 1, 1, 0, 1, '2019-04-08 11:34:55', NULL, NULL),
(46, 94, 'Idli +Vada', 'idli-vada', 9, 95, '80.00', '50.00', '2 Idlis ,1 Vada, Sambar Chutney', '', 0, '11', 1, 0, 0, 1, '2019-04-09 13:57:54', NULL, NULL),
(47, 94, 'Idli', 'idli-1', 9, 100, '50.00', '40.00', '2 Idlis,sambar ,chutney', '', 0, '11', 1, 0, 0, 1, '2019-04-09 14:00:28', NULL, NULL),
(48, 94, 'Idli +Vada +Coffee', 'idli-vada-coffee', 9, 90, '80.00', '50.00', '2 Idlis,1 Vada,sambar,chutney, 1 Cup Coffee', '', 1, '11', 1, 0, 10, 1, '2019-04-09 14:02:29', NULL, NULL),
(49, 96, 'Butter Naan', 'butter-naan', 9, 25, '2.00', '1.99', 'Fresh Baked Tandoor Bread With Butter', '', 0, '5', 1, 1, 0, 1, '2019-04-11 23:54:07', NULL, NULL),
(50, 96, 'Paneer Tikka Masala', 'paneer-tikka-masala', 9, 24, '12.00', '11.00', 'Paneer Cubes Cooked In Extra Creamy Sauce', '', 0, '3', 1, 1, 0, 1, '2019-04-12 00:03:41', NULL, NULL),
(51, 96, 'Veg Biriyani', 'veg-biriyani', 9, 16, '13.00', '12.00', 'Rice Cooked With Vegetables', '', 0, '5', 1, 1, 0, 1, '2019-04-11 23:59:09', NULL, NULL),
(52, 96, 'Naan+Paneer Tikka Masala+Veg Biriyani', 'naanpaneer-tikka-masalaveg-biriyani', 9, 24, '18.00', '16.00', '', '', 1, '5', 1, 0, 0, 1, '2019-04-12 00:01:41', NULL, NULL),
(53, 96, 'Veg Hakka Noodles', 'veg-hakka-noodles', 1, 28, '19.00', '15.00', 'Vegetables With Noodles', '', 0, '5', 1, 0, 0, 1, '2019-04-12 00:01:58', NULL, NULL),
(54, 86, 'Lebanese Grilled Wrap', 'lebanese-grilled-wrap', 19, 0, '36.00', '32.00', '', 'item_1555048374.png', 1, '3', 0, 0, 0, 1, '2019-04-12 11:22:54', NULL, NULL),
(55, 86, 'Chocolate Avalanche', 'chocolate-avalanche', 20, 0, '229.00', '119.00', 'Chocolate Mousse, Brownie, Sponge And Chocolate Truffle Served Together To Treat You Chocolate Mousse, Brownie, Sponge And Chocolate Truffle Served Together To Treat You', 'item_1555048534.jpg', 0, '6', 0, 0, 0, 1, '2019-04-12 11:25:34', NULL, NULL),
(56, 86, 'Our Famous Pancake Stacks', 'our-famous-pancake-stacks', 20, 0, '20.00', '12.50', 'With Your Choice Of Whipped Butter, Cream Or Ice Cream, All Stacks Are Served With Maple Syrup.', 'item_1555051166.jpg', 0, '6', 0, 0, 0, 1, '2019-04-12 12:09:26', NULL, NULL),
(57, 100, 'Vegetarian Pizza', 'vegetarian-pizza', 20, 24, '15.00', '14.00', '', '', 0, '5', 1, 1, 0, 1, '2019-04-13 20:24:22', NULL, NULL),
(58, 100, 'Cheese Pizza', 'cheese-pizza-1', 20, 19, '13.00', '12.00', '', '', 0, '5', 1, 1, 0, 1, '2019-04-13 20:22:57', NULL, NULL),
(59, 100, 'Salad', 'salad', 20, 19, '8.00', '6.00', '', '', 0, '2', 1, 0, 0, 1, '2019-04-13 20:17:55', NULL, NULL),
(60, 100, 'Coke', 'coke-1', 20, 19, '8.00', '7.00', '', '', 0, '1', 1, 1, 0, 1, '2019-04-13 20:18:50', NULL, NULL),
(61, 100, 'Pizza +Coke+ Salad', 'pizza-coke-salad', 20, 20, '25.00', '22.00', '', '', 1, '5', 1, 0, 0, 1, '2019-04-13 20:21:00', NULL, NULL),
(62, 58, 'Spagetti', 'spagetti', 20, 30, '15.00', '12.00', 'Spaghetti Is Long, Thin Pasta. ... Spaghetti Is A Popular Italian Pasta, Often Served With A Tomato Sauce Sometimes Called Spaghetti Sauce. The Italian Word Spago Means String, And Spaghetti Is The Plural Of Spago ? A Description Of What Spaghetti Looks Like.', 'item_1555169981.png', 0, '5', 1, 0, 0, 1, '2019-04-13 21:11:21', NULL, NULL),
(63, 86, 'Diet Coke', 'diet-coke', 20, 0, '22.00', '20.00', 'Diet Coke? Is The Perfect Balance Of Crisp And Refreshing, Now Available In Sweet New Cans. Enjoy The Great Diet Cola Flavor That\\\'s Fizzing Delicious!', 'item_1555304687.jpg', 0, '1', 0, 1, 0, 1, '2019-04-15 10:34:47', NULL, NULL);

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
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notification_type` smallint(2) NOT NULL COMMENT '1 - general, 2 - order_accepeted, 3 - order_rejected, 4 - delivery_boy_assign, 5 - order_pickedup,  6 - msg_from_delivery_boy, 7 - order_completed, 8 - order_delivery_fail',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `notification_title` text NOT NULL,
  `notification_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notification_type`, `customer_id`, `order_id`, `notification_title`, `notification_message`, `created_at`) VALUES
(1, 2, 33, 195, 'ffff', 'gfff', '2019-03-29 10:16:48'),
(2, 2, 33, 111, 'Order Accepted by Restaurant', 'Your order no. CL111 has been accepted by restaurant.', '2019-03-29 10:17:51'),
(3, 5, 33, 219, 'Order Picked Up', 'Your order no. CL219 has been picked up', '2019-03-29 10:22:02'),
(4, 6, 33, 219, 'New message for order: CL219', 'Hello 55', '2019-03-29 10:22:52'),
(5, 2, 33, 223, 'Order Accepted by Restaurant', 'Your order no. CL223 has been accepted by restaurant.', '2019-03-29 10:27:28'),
(6, 5, 33, 224, 'Order Picked Up', 'Your order no. CL224 has been picked up', '2019-03-29 10:32:53'),
(7, 5, 33, 224, 'Order Picked Up', 'Your order no. CL224 has been picked up', '2019-03-29 10:33:42'),
(8, 2, 33, 225, 'Order Accepted by Restaurant', 'Your order no. CL225 has been accepted by restaurant.', '2019-03-29 10:41:35'),
(9, 4, 33, 223, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-03-29 10:44:53'),
(10, 4, 33, 0, 'Hello', '1233tryrtyy', '2019-03-29 10:44:53'),
(11, 4, 33, 223, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-03-29 12:44:53'),
(12, 4, 33, 0, 'Hello', '1233tryrtyy', '2019-03-29 10:44:53'),
(13, 1, 25, 0, 'Promotional offer', 'test', '2019-03-30 23:14:32'),
(14, 1, 33, 0, 'Promotional offer', 'test', '2019-03-30 23:14:32'),
(15, 1, 43, 0, 'Promotional offer', 'test', '2019-03-30 23:14:32'),
(16, 1, 48, 0, 'Promotional offer', 'test', '2019-03-30 23:14:32'),
(17, 1, 73, 0, 'Promotional offer', 'test', '2019-03-30 23:14:32'),
(18, 1, 25, 0, 'Promotional offer', 'test', '2019-03-30 23:19:29'),
(19, 1, 33, 0, 'Promotional offer', 'test', '2019-03-30 23:19:29'),
(20, 1, 43, 0, 'Promotional offer', 'test', '2019-03-30 23:19:29'),
(21, 1, 48, 0, 'Promotional offer', 'test', '2019-03-30 23:19:29'),
(22, 1, 73, 0, 'Promotional offer', 'test', '2019-03-30 23:19:29'),
(23, 2, 33, 227, 'Order Accepted by Restaurant', 'Your order no. CL227 has been accepted by restaurant.', '2019-04-01 11:08:41'),
(24, 4, 33, 227, 'Delivery Boy Assigned', 'Dhrumii will deliver your order. You can call on 9874563210 for live update.', '2019-04-01 11:12:19'),
(25, 5, 33, 227, 'Order Picked Up', 'Your order no. CL227 has been picked up', '2019-04-01 11:12:31'),
(26, 6, 33, 227, 'New message for order: CL227', 'Hi! I am near you', '2019-04-01 11:13:03'),
(27, 7, 33, 227, 'Order Completed', 'Your order no. CL227 has been delivered', '2019-04-01 11:13:59'),
(28, 2, 33, 229, 'Order Accepted by Restaurant', 'Your order no. CL229 has been accepted by restaurant.', '2019-04-01 11:49:01'),
(29, 4, 33, 229, 'Delivery Boy Assigned', 'Dhrumii will deliver your order. You can call on 9874563210 for live update.', '2019-04-01 11:49:37'),
(30, 4, 33, 136, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-04 11:17:33'),
(31, 2, 33, 248, 'Order Accepted by Restaurant', 'Your order no. CL248 has been accepted by restaurant.', '2019-04-04 11:55:26'),
(32, 6, 33, 248, 'New message for order: CL248', 'Please take your order', '2019-04-04 11:58:44'),
(33, 5, 33, 248, 'Order Picked Up', 'Your order no. CL248 has been picked up', '2019-04-04 11:58:48'),
(34, 5, 33, 248, 'Order Picked Up', 'Your order no. CL248 has been picked up', '2019-04-04 12:01:11'),
(35, 7, 33, 248, 'Order Completed', 'Your order no. CL248 has been delivered', '2019-04-04 12:06:10'),
(36, 2, 33, 272, 'Order Accepted by Restaurant', 'Your order no. CL272 has been accepted by restaurant.', '2019-04-05 05:13:50'),
(37, 4, 33, 272, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-05 05:18:11'),
(38, 5, 33, 272, 'Order Picked Up', 'Your order no. CL272 has been picked up', '2019-04-05 05:18:58'),
(39, 6, 33, 272, 'New message for order: CL272', 'Please take your order', '2019-04-05 05:19:31'),
(40, 2, 48, 275, 'Order Accepted by Restaurant', 'Your order no. CL275 has been accepted by restaurant.', '2019-04-05 10:06:05'),
(41, 4, 48, 275, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-05 10:22:27'),
(42, 2, 48, 280, 'Order Accepted by Restaurant', 'Your order no. CL280 has been accepted by restaurant.', '2019-04-05 12:29:59'),
(43, 2, 33, 281, 'Order Accepted by Restaurant', 'Your order no. CL281 has been accepted by restaurant.', '2019-04-05 13:20:34'),
(44, 4, 33, 281, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-05 13:23:37'),
(45, 4, 45, 189, 'Delivery Boy Assigned', 'Sunitha Vinod will deliver your order. You can call on 9902366824 for live update.', '2019-04-08 04:26:02'),
(46, 1, 25, 0, '546', '45654', '2019-04-08 04:48:47'),
(47, 1, 33, 0, '546', '45654', '2019-04-08 04:48:47'),
(48, 1, 35, 0, '546', '45654', '2019-04-08 04:48:47'),
(49, 1, 36, 0, '546', '45654', '2019-04-08 04:48:47'),
(50, 1, 43, 0, '546', '45654', '2019-04-08 04:48:47'),
(51, 1, 45, 0, '546', '45654', '2019-04-08 04:48:47'),
(52, 1, 48, 0, '546', '45654', '2019-04-08 04:48:47'),
(53, 1, 73, 0, '546', '45654', '2019-04-08 04:48:47'),
(54, 1, 25, 0, 'test', 'test', '2019-04-08 04:48:57'),
(55, 1, 33, 0, 'test', 'test', '2019-04-08 04:48:57'),
(56, 1, 35, 0, 'test', 'test', '2019-04-08 04:48:57'),
(57, 1, 36, 0, 'test', 'test', '2019-04-08 04:48:57'),
(58, 1, 43, 0, 'test', 'test', '2019-04-08 04:48:57'),
(59, 1, 45, 0, 'test', 'test', '2019-04-08 04:48:57'),
(60, 1, 48, 0, 'test', 'test', '2019-04-08 04:48:57'),
(61, 1, 73, 0, 'test', 'test', '2019-04-08 04:48:57'),
(62, 2, 36, 284, 'Order Accepted by Restaurant', 'Your order no. CL284 has been accepted by restaurant.', '2019-04-08 06:18:42'),
(63, 4, 36, 284, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 06:23:57'),
(64, 4, 48, 280, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 06:28:43'),
(65, 2, 36, 285, 'Order Accepted by Restaurant', 'Your order no. CL285 has been accepted by restaurant.', '2019-04-08 06:40:20'),
(66, 4, 36, 285, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 06:41:23'),
(67, 5, 36, 285, 'Order Picked Up', 'Your order no. CL285 has been picked up', '2019-04-08 06:55:57'),
(68, 6, 36, 285, 'New message for order: CL285', 'Hi, I am near you', '2019-04-08 06:56:28'),
(69, 6, 36, 285, 'New message for order: CL285', 'Please take your order', '2019-04-08 07:12:17'),
(70, 2, 36, 286, 'Order Accepted by Restaurant', 'Your order no. CL286 has been accepted by restaurant.', '2019-04-08 07:37:56'),
(71, 4, 36, 286, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 07:42:06'),
(72, 2, 36, 287, 'Order Accepted by Restaurant', 'Your order no. CL287 has been accepted by restaurant.', '2019-04-08 08:00:02'),
(73, 4, 36, 287, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 08:00:49'),
(74, 2, 36, 288, 'Order Accepted by Restaurant', 'Your order no. CL288 has been accepted by restaurant.', '2019-04-08 09:14:20'),
(75, 2, 36, 289, 'Order Accepted by Restaurant', 'Your order no. CL289 has been accepted by restaurant.', '2019-04-08 09:23:42'),
(76, 4, 36, 289, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 09:24:07'),
(77, 4, 36, 288, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 09:24:41'),
(78, 2, 36, 290, 'Order Accepted by Restaurant', 'Your order no. CL290 has been accepted by restaurant.', '2019-04-08 09:57:11'),
(79, 2, 36, 291, 'Order Accepted by Restaurant', 'Your order no. CL291 has been accepted by restaurant.', '2019-04-08 10:00:07'),
(80, 2, 36, 292, 'Order Accepted by Restaurant', 'Your order no. CL292 has been accepted by restaurant.', '2019-04-08 10:13:27'),
(81, 2, 36, 293, 'Order Accepted by Restaurant', 'Your order no. CL293 has been accepted by restaurant.', '2019-04-08 10:16:45'),
(82, 4, 36, 294, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-08 10:27:01'),
(83, 4, 36, 293, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:26:43'),
(84, 4, 36, 293, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:27:20'),
(85, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:28:34'),
(86, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:30:49'),
(87, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:33:24'),
(88, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:35:49'),
(89, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:41:27'),
(90, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:49:48'),
(91, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:51:56'),
(92, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:53:07'),
(93, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:58:21'),
(94, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 05:58:54'),
(95, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 06:16:52'),
(96, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 06:20:35'),
(97, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 06:26:51'),
(98, 4, 36, 291, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-09 06:27:16'),
(99, 3, 36, 300, 'Order Rejected by Restaurant', 'Your order no. CL300 has been rejected by restaurant.', '2019-04-09 07:15:22'),
(100, 2, 36, 335, 'Order Accepted by Restaurant', 'Your order no. CL335 has been accepted by restaurant.', '2019-04-09 10:22:55'),
(101, 2, 36, 337, 'Order Accepted by Restaurant', 'Your order no. CL337 has been accepted by restaurant.', '2019-04-09 10:42:02'),
(102, 2, 45, 338, 'Order Accepted by Restaurant', 'Your order no. CL338 has been accepted by restaurant.', '2019-04-09 13:04:52'),
(103, 2, 45, 331, 'Order Accepted by Restaurant', 'Your order no. CL331 has been accepted by restaurant.', '2019-04-09 13:04:57'),
(104, 3, 45, 327, 'Order Rejected by Restaurant', 'Your order no. CL327 has been rejected by restaurant.', '2019-04-09 13:05:06'),
(105, 2, 45, 326, 'Order Accepted by Restaurant', 'Your order no. CL326 has been accepted by restaurant.', '2019-04-09 13:05:14'),
(106, 4, 45, 326, 'Delivery Boy Assigned', 'Sunitha Vinod will deliver your order. You can call on 9902366824 for live update.', '2019-04-09 13:09:09'),
(107, 4, 45, 338, 'Delivery Boy Assigned', 'Sunitha Vinod will deliver your order. You can call on 9902366824 for live update.', '2019-04-09 13:09:47'),
(108, 5, 45, 326, 'Order Picked Up', 'Your order no. CL326 has been picked up', '2019-04-09 13:23:24'),
(109, 6, 45, 326, 'New message for order: CL326', 'Hi! I am near you', '2019-04-09 13:23:54'),
(110, 5, 45, 326, 'Order Picked Up', 'Your order no. CL326 has been picked up', '2019-04-09 13:24:24'),
(111, 5, 45, 338, 'Order Picked Up', 'Your order no. CL338 has been picked up', '2019-04-09 13:24:40'),
(112, 7, 45, 338, 'Order Completed', 'Your order no. CL338 has been delivered', '2019-04-09 13:24:51'),
(113, 7, 45, 326, 'Order Completed', 'Your order no. CL326 has been delivered', '2019-04-09 13:25:00'),
(114, 5, 45, 326, 'Order Picked Up', 'Your order no. CL326 has been picked up', '2019-04-09 13:26:14'),
(115, 7, 45, 326, 'Order Completed', 'Your order no. CL326 has been delivered', '2019-04-09 13:26:19'),
(116, 1, 36, 0, 'test 1', 'testing push notification', '2019-04-09 16:39:20'),
(117, 1, 33, 0, 'test 1', 'testing push notification', '2019-04-09 16:39:20'),
(118, 1, 45, 0, 'test 1', 'testing push notification', '2019-04-09 16:39:20'),
(119, 1, 45, 0, 'test', 'test1', '2019-04-09 16:40:09'),
(120, 1, 45, 0, 'hi', 'hi ,how r u', '2019-04-09 17:23:05'),
(121, 1, 45, 0, 'hi', 'hi ,how r u', '2019-04-09 17:23:05'),
(122, 4, 33, 148, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-10 02:35:43'),
(123, 4, 36, 351, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-11 06:31:42'),
(124, 5, 36, 351, 'Order Picked Up', 'Your order no. CL351 has been picked up', '2019-04-11 06:32:48'),
(125, 6, 36, 351, 'New message for order: CL351', 'Please take your order', '2019-04-11 06:33:21'),
(126, 4, 36, 351, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-11 06:47:05'),
(127, 5, 36, 351, 'Order Picked Up', 'Your order no. CL351 has been picked up', '2019-04-11 06:47:37'),
(128, 7, 36, 351, 'Order Completed', 'Your order no. CL351 has been delivered', '2019-04-11 06:50:51'),
(129, 7, 36, 351, 'Order Completed', 'Your order no. CL351 has been delivered', '2019-04-11 06:55:15'),
(130, 7, 36, 351, 'Order Completed', 'Your order no. CL351 has been delivered', '2019-04-11 06:55:34'),
(131, 5, 36, 287, 'Order Picked Up', 'Your order no. CL287 has been picked up', '2019-04-11 06:58:37'),
(132, 7, 36, 351, 'Order Completed', 'Your order no. CL351 has been delivered', '2019-04-11 06:58:40'),
(133, 6, 36, 287, 'New message for order: CL287', 'Please take your order', '2019-04-11 07:25:06'),
(134, 6, 36, 287, 'New message for order: CL287', 'Please take your order', '2019-04-11 07:25:29'),
(135, 6, 36, 287, 'New message for order: CL287', 'Please take your order', '2019-04-11 07:25:39'),
(136, 6, 36, 287, 'New message for order: CL287', 'Hi, I am near you', '2019-04-11 07:26:04'),
(137, 6, 36, 287, 'New message for order: CL287', 'Hi! I am near you', '2019-04-11 10:12:56'),
(138, 2, 33, 354, 'Order Accepted by Restaurant', 'Your order no. CL354 has been accepted by restaurant.', '2019-04-11 10:36:58'),
(139, 4, 33, 354, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-11 10:43:03'),
(140, 5, 33, 354, 'Order Picked Up', 'Your order no. CL354 has been picked up', '2019-04-11 10:43:24'),
(141, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 10:43:32'),
(142, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 10:43:44'),
(143, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 10:58:26'),
(144, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 10:58:35'),
(145, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:03:34'),
(146, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:03:58'),
(147, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:04:19'),
(148, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:11:42'),
(149, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:11:49'),
(150, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:11:56'),
(151, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:12:06'),
(152, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:12:17'),
(153, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:13:45'),
(154, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:13:57'),
(155, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:14:14'),
(156, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:18:43'),
(157, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:18:51'),
(158, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:19:02'),
(159, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:20:06'),
(160, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:20:13'),
(161, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:20:19'),
(162, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:21:08'),
(163, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:21:15'),
(164, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:21:40'),
(165, 6, 33, 354, 'New message for order: CL354', 'Hi! I am near you', '2019-04-11 11:21:46'),
(166, 6, 33, 354, 'New message for order: CL354', 'Please take your order', '2019-04-11 11:21:53'),
(167, 6, 33, 354, 'New message for order: CL354', 'Please open a door and take your order', '2019-04-11 11:21:59'),
(168, 4, 41, 381, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:13:59'),
(169, 5, 41, 381, 'Order Picked Up', 'Your order no. CL381 has been picked up', '2019-04-12 07:14:27'),
(170, 6, 41, 381, 'New message for order: CL381', 'Hi, I am near you', '2019-04-12 07:14:44'),
(171, 6, 41, 381, 'New message for order: CL381', 'Please open your door and take your order', '2019-04-12 07:14:49'),
(172, 6, 41, 381, 'New message for order: CL381', 'Please take your order', '2019-04-12 07:14:54'),
(173, 4, 41, 382, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:22:33'),
(174, 5, 41, 382, 'Order Picked Up', 'Your order no. CL382 has been picked up', '2019-04-12 07:23:02'),
(175, 4, 41, 382, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:25:49'),
(176, 5, 41, 382, 'Order Picked Up', 'Your order no. CL382 has been picked up', '2019-04-12 07:25:58'),
(177, 4, 33, 383, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:32:42'),
(178, 5, 33, 383, 'Order Picked Up', 'Your order no. CL383 has been picked up', '2019-04-12 07:33:03'),
(179, 6, 33, 383, 'New message for order: CL383', 'Please take your order', '2019-04-12 07:33:19'),
(180, 4, 33, 383, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:36:19'),
(181, 5, 33, 383, 'Order Picked Up', 'Your order no. CL383 has been picked up', '2019-04-12 07:36:24'),
(182, 4, 41, 384, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 07:46:19'),
(183, 5, 41, 384, 'Order Picked Up', 'Your order no. CL384 has been picked up', '2019-04-12 07:46:28'),
(184, 6, 41, 384, 'New message for order: CL384', 'Please take your order', '2019-04-12 07:46:34'),
(185, 7, 41, 384, 'Order Completed', 'Your order no. CL384 has been delivered', '2019-04-12 07:46:39'),
(186, 4, 41, 385, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-12 09:02:13'),
(187, 5, 41, 385, 'Order Picked Up', 'Your order no. CL385 has been picked up', '2019-04-12 09:08:41'),
(188, 7, 41, 385, 'Order Completed', 'Your order no. CL385 has been delivered', '2019-04-12 09:09:32'),
(189, 1, 25, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(190, 1, 33, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(191, 1, 35, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(192, 1, 36, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(193, 1, 41, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(194, 1, 43, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(195, 1, 45, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(196, 1, 48, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(197, 1, 73, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(198, 1, 92, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(199, 1, 93, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(200, 1, 94, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(201, 1, 95, 0, 'Hello', 'Test 66', '2019-04-12 13:39:24'),
(202, 2, 48, 404, 'Order Accepted by Restaurant', 'Your order no. CL404 has been accepted by restaurant.', '2019-04-13 07:13:06'),
(203, 3, 48, 404, 'Order Cancelled', 'Your order no. CL404 from Excellent Webworld Cafe has been cancelled.', '2019-04-13 07:13:29'),
(204, 2, 48, 405, 'Order Accepted by Restaurant', 'Your order no. CL405 has been accepted by restaurant.', '2019-04-13 07:28:34'),
(205, 3, 48, 405, 'Order Cancelled', 'Your order no. CL405 from Excellent Webworld Cafe has been cancelled.', '2019-04-13 07:28:43'),
(206, 2, 48, 406, 'Order Accepted by Restaurant', 'Your order no. CL406 has been accepted by restaurant.', '2019-04-13 07:29:58'),
(207, 2, 48, 407, 'Order Accepted by Restaurant', 'Your order no. CL407 has been accepted by restaurant.', '2019-04-13 07:55:20'),
(208, 2, 45, 386, 'Order Accepted by Restaurant', 'Your order no. CL386 has been accepted by restaurant.', '2019-04-13 17:20:27'),
(209, 2, 45, 375, 'Order Accepted by Restaurant', 'Your order no. CL375 has been accepted by restaurant.', '2019-04-13 17:20:34'),
(210, 2, 33, 367, 'Order Accepted by Restaurant', 'Your order no. CL367 has been accepted by restaurant.', '2019-04-13 17:20:40'),
(211, 2, 33, 364, 'Order Accepted by Restaurant', 'Your order no. CL364 has been accepted by restaurant.', '2019-04-13 17:20:48'),
(212, 2, 72, 417, 'Order Accepted by Restaurant', 'Your order no. CL417 has been accepted by restaurant.', '2019-04-13 21:50:40'),
(213, 4, 72, 417, 'Delivery Boy Assigned', 'Sumana will deliver your order. You can call on 248 605 8831 for live update.', '2019-04-13 21:53:04'),
(214, 5, 72, 417, 'Order Picked Up', 'Your order no. CL417 has been picked up', '2019-04-13 21:53:25'),
(215, 6, 72, 417, 'New message for order: CL417', 'Please open a door and take your order', '2019-04-13 21:53:40'),
(216, 7, 72, 417, 'Order Completed', 'Your order no. CL417 has been delivered', '2019-04-13 21:57:21'),
(217, 7, 72, 417, 'Order Completed', 'Your order no. CL417 has been delivered', '2019-04-13 21:57:30'),
(218, 2, 72, 419, 'Order Accepted by Restaurant', 'Your order no. CL419 has been accepted by restaurant.', '2019-04-13 22:24:23'),
(219, 2, 72, 421, 'Order Accepted by Restaurant', 'Your order no. CL421 has been accepted by restaurant.', '2019-04-13 22:24:31'),
(220, 2, 72, 420, 'Order Accepted by Restaurant', 'Your order no. CL420 has been accepted by restaurant.', '2019-04-13 22:24:38'),
(221, 2, 72, 372, 'Order Accepted by Restaurant', 'Your order no. CL372 has been accepted by restaurant.', '2019-04-13 22:24:54'),
(222, 4, 72, 420, 'Delivery Boy Assigned', 'Sumana will deliver your order. You can call on 248 605 8831 for live update.', '2019-04-13 22:28:00'),
(223, 5, 72, 420, 'Order Picked Up', 'Your order no. CL420 has been picked up', '2019-04-13 22:28:39'),
(224, 7, 72, 420, 'Order Completed', 'Your order no. CL420 has been delivered', '2019-04-13 22:29:10'),
(225, 2, 72, 422, 'Order Accepted by Restaurant', 'Your order no. CL422 has been accepted by restaurant.', '2019-04-13 23:13:29'),
(226, 2, 72, 423, 'Order Accepted by Restaurant', 'Your order no. CL423 has been accepted by restaurant.', '2019-04-13 23:17:40'),
(227, 2, 72, 424, 'Order Accepted by Restaurant', 'Your order no. CL424 has been accepted by restaurant.', '2019-04-13 23:17:50'),
(228, 4, 72, 424, 'Delivery Boy Assigned', 'Sumana will deliver your order. You can call on 248 605 8831 for live update.', '2019-04-13 23:20:24'),
(229, 5, 72, 424, 'Order Picked Up', 'Your order no. CL424 has been picked up', '2019-04-13 23:20:43'),
(230, 7, 72, 424, 'Order Completed', 'Your order no. CL424 has been delivered', '2019-04-13 23:20:52'),
(231, 2, 72, 425, 'Order Accepted by Restaurant', 'Your order no. CL425 has been accepted by restaurant.', '2019-04-13 23:23:09'),
(232, 2, 41, 428, 'Order Accepted by Restaurant', 'Your order no. CL428 has been accepted by restaurant.', '2019-04-15 05:29:10'),
(233, 4, 41, 428, 'Delivery Boy Assigned', 'Dhrumi will deliver your order. You can call on 9874563210 for live update.', '2019-04-15 05:36:39'),
(234, 2, 98, 430, 'Order Accepted by Restaurant', 'Your order no. CL430 has been accepted by restaurant.', '2019-04-15 07:14:16'),
(235, 2, 98, 430, 'Order Accepted by Restaurant', 'Your order no. CL430 has been accepted by restaurant.', '2019-04-15 07:14:48'),
(236, 3, 98, 430, 'Order Rejected by Restaurant', 'Your order no. CL430 has been rejected by restaurant.', '2019-04-15 07:17:18'),
(237, 3, 98, 430, 'Order Rejected by Restaurant', 'Your order no. CL430 has been rejected by restaurant.', '2019-04-15 07:17:50'),
(238, 3, 98, 430, 'Order Rejected by Restaurant', 'Your order no. CL430 has been rejected by restaurant.', '2019-04-15 07:18:09'),
(239, 2, 98, 430, 'Order Accepted by Restaurant', 'Your order no. CL430 has been accepted by restaurant.', '2019-04-15 07:18:24'),
(240, 6, 98, 430, 'Order Completed By Shop', 'Order CL430 completed by shop', '2019-04-15 07:34:58'),
(241, 2, 98, 430, 'Order Cancel By Shop', 'Order CL430 rejected', '2019-04-15 07:35:15'),
(242, 2, 98, 430, 'Order Cancel By Shop', 'Order CL430 rejected', '2019-04-15 07:35:34'),
(243, 6, 98, 430, 'Order Completed By Shop', 'Order CL430 completed by shop', '2019-04-15 07:35:45'),
(244, 2, 98, 430, 'Order Cancel By Shop', 'Order CL430 rejected', '2019-04-15 07:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_type` varchar(1) NOT NULL COMMENT '1-Deliver Now, 2-Deliver Later, 3-Takeout, 4-Takeout Later, 5 - weekly delivery, 6 - WeeklyTakeout',
  `later_time` varchar(15) NOT NULL,
  `total` varchar(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `delivery_charges` varchar(255) NOT NULL COMMENT '$',
  `promocode_id` varchar(255) NOT NULL,
  `promo_amount` varchar(11) NOT NULL DEFAULT '0',
  `tax` varchar(255) NOT NULL COMMENT '%',
  `service_charge` varchar(11) NOT NULL COMMENT '%',
  `schedule_date` date NOT NULL,
  `schedule_time` varchar(255) NOT NULL,
  `order_status` int(3) NOT NULL DEFAULT '0' COMMENT '0  - pending, 1 - accept by shop, 2 - reject by shop, 3 - assigned delivery_boy by dispatcher, 4 - accept by delivery_boy, 5 - order picked, 6 - order delivered, 7 - order delivery fail, 8 - cancel by customer',
  `delivery_address_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL DEFAULT '0',
  `payment_status` int(3) NOT NULL DEFAULT '0' COMMENT '0- pending , 1- success, 2 - failed',
  `payment_mode` int(5) NOT NULL COMMENT '0  - Card , 1 -  Apple Pay, 2 -  Google Pay',
  `transaction_id` varchar(255) NOT NULL,
  `QR_code` varchar(255) NOT NULL,
  `favourite` tinyint(1) NOT NULL DEFAULT '0',
  `rating` varchar(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shop_id`, `order_type`, `later_time`, `total`, `subtotal`, `delivery_charges`, `promocode_id`, `promo_amount`, `tax`, `service_charge`, `schedule_date`, `schedule_time`, `order_status`, `delivery_address_id`, `delivery_boy_id`, `payment_status`, `payment_mode`, `transaction_id`, `QR_code`, `favourite`, `rating`, `created_at`, `updated_at`, `deleted_at`) VALUES
(86, 33, 52, '1', '', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', '', 0, '0', '2019-03-02 07:37:38', NULL, NULL),
(87, 36, 52, '1', '', '767.40', '840.00', '1.50', '41', '100.00', '1.50', '2.00', '0000-00-00', '', 6, 34, 9, 1, 0, '', '', 0, '0', '2019-03-02 08:17:58', NULL, NULL),
(88, 36, 52, '3', '', '167.10', '160.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 34, 0, 1, 0, '', '', 0, '3.0', '2019-03-04 04:49:47', NULL, NULL),
(89, 33, 52, '2', '10:30 AM', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 6, 17, 9, 1, 2, '', '', 0, '0', '2019-03-04 11:16:57', NULL, NULL),
(90, 33, 52, '1', '', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 6, 17, 9, 1, 2, '', '', 0, '0', '2019-03-04 11:18:34', NULL, NULL),
(91, 33, 52, '1', '', '301.65', '290.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-05 05:30:32', NULL, NULL),
(92, 33, 52, '1', '', '175.38', '168.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-05 06:34:59', NULL, NULL),
(93, 43, 58, '1', '', '218.63', '235.00', '2.90', '46', '23.50', '1.50', '0.50', '0000-00-00', '', 1, 38, 0, 1, 0, '', '', 0, '0', '2019-03-05 07:25:03', NULL, NULL),
(94, 33, 52, '1', '', '623.54', '601.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-06 10:38:43', NULL, NULL),
(95, 33, 52, '1', '', '42.07', '56.00', '1.50', '35', '16.80', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 10:25:59', NULL, NULL),
(96, 33, 52, '1', '', '67.43', '91.00', '1.50', '35', '27.30', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 10:28:01', NULL, NULL),
(97, 33, 52, '1', '', '117.42', '160.00', '1.50', '35', '48.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 10:34:26', NULL, NULL),
(98, 33, 52, '1', '', '233.34', '320.00', '1.50', '35', '96.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 10:38:57', NULL, NULL),
(99, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 1, 17, 0, 1, 2, '', '', 0, '0', '2019-03-07 10:44:45', NULL, NULL),
(100, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 10:50:44', NULL, NULL),
(101, 33, 52, '1', '', '117.42', '112.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-07 10:55:00', NULL, NULL),
(102, 33, 52, '1', '', '239.55', '230.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 10:59:15', NULL, NULL),
(103, 33, 52, '1', '', '239.55', '230.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 3, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 11:14:25', NULL, NULL),
(104, 33, 52, '1', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 12:11:59', NULL, NULL),
(105, 33, 52, '2', '6:50 PM', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 12:14:09', NULL, NULL),
(106, 33, 52, '4', '6:45 PM', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 0, '0', '2019-03-07 12:15:22', NULL, NULL),
(107, 33, 52, '5', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '2019-03-21', '6:46 PM', 8, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 12:16:45', NULL, NULL),
(108, 33, 52, '5', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '2019-03-07', '6:47 PM', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 12:18:05', NULL, NULL),
(109, 33, 52, '1', '', '209.54', '201.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 13:19:15', NULL, NULL),
(110, 33, 58, '1', '', '81.85', '86.00', '2.90', '47', '8.60', '1.50', '0.50', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 14:06:18', '2019-03-07 14:13:07', NULL),
(111, 33, 58, '1', '', '16.67', '15.00', '2.90', '47', '1.50', '1.50', '0.50', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', 1, '2.5', '2019-03-07 14:06:54', '2019-03-29 15:47:51', NULL),
(112, 33, 58, '1', '', '94.70', '140.00', '2.90', '33', '50.00', '1.50', '0.50', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', 0, '0', '2019-03-07 14:07:19', '2019-03-08 04:56:46', NULL),
(113, 36, 52, '1', '', '891.60', '1360.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', 0, '3.5', '2019-03-08 06:25:27', NULL, NULL),
(114, 36, 52, '1', '', '964.05', '1430.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', 0, '4.0', '2019-03-08 06:30:23', NULL, NULL),
(115, 36, 52, '1', '', '887.46', '1356.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', 0, '4.0', '2019-03-08 06:31:45', NULL, NULL),
(116, 33, 52, '1', '', '6207.36', '5996.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', '', 0, '0', '2019-03-08 06:53:44', NULL, NULL),
(117, 33, 52, '5', '', '81.20', '77.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-09', '11:30 PM', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-08 08:00:09', NULL, NULL),
(118, 33, 52, '5', '', '117.42', '112.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-12', '11:45 PM', 4, 36, 9, 1, 0, '', '', 0, '0', '2019-03-09 06:16:00', NULL, NULL),
(119, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'drygpHk=.png', 0, '0', '2019-03-11 05:58:51', NULL, NULL),
(120, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL120_1552284107.png', 0, '0', '2019-03-11 06:01:47', NULL, NULL),
(121, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL121_1552284695.png', 0, '0', '2019-03-11 06:11:35', NULL, NULL),
(122, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL122_1552286386.png', 0, '0', '2019-03-11 06:39:46', NULL, NULL),
(123, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL123_1552300741.png', 0, '0', '2019-03-11 10:39:01', NULL, NULL),
(124, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL124_1552300770.png', 0, '0', '2019-03-11 10:39:30', NULL, NULL),
(125, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL125_1552301039.png', 0, '0', '2019-03-11 10:43:59', NULL, NULL),
(126, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL126_1552302183.png', 0, '0', '2019-03-11 11:03:03', NULL, NULL),
(127, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 37, 9, 1, 0, '', 'CL127_1552367891.png', 0, '0', '2019-03-12 05:18:11', NULL, NULL),
(128, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL128_1552371789.png', 0, '0', '2019-03-12 06:23:09', NULL, NULL),
(129, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 37, 9, 1, 0, '', 'CL129_1552371897.png', 0, '0', '2019-03-12 06:24:57', NULL, NULL),
(130, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL130_1552373554.png', 1, '0', '2019-03-12 06:52:34', NULL, NULL),
(131, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL131_1552373840.png', 0, '0', '2019-03-12 06:57:20', NULL, NULL),
(132, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL132_1552374219.png', 0, '0', '2019-03-12 07:03:39', NULL, NULL),
(133, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL133_1552374669.png', 0, '0', '2019-03-12 07:11:09', NULL, NULL),
(134, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL134_1552374785.png', 0, '0', '2019-03-12 07:13:05', NULL, NULL),
(135, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL135_1552381134.png', 0, '0', '2019-03-12 08:58:54', NULL, NULL),
(136, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL136_1552381778.png', 0, '0', '2019-03-12 09:09:38', NULL, NULL),
(137, 33, 58, '1', '', '15.14', '12.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL137_1552381943.png', 0, '0', '2019-03-12 09:12:23', NULL, NULL),
(138, 33, 62, '3', '', '158.27', '170.00', '2.20', '47', '17.00', '1.50', '0.50', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL138_1552381994.png', 1, '0', '2019-03-12 09:13:14', NULL, NULL),
(139, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', 'CL139_1552383280.png', 1, '0', '2019-03-12 09:34:40', NULL, NULL),
(140, 33, 58, '5', '', '16.17', '13.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-13', '8:26 PM', 4, 36, 9, 1, 0, '', 'CL140_1552391787.png', 1, '0', '2019-03-12 11:56:27', NULL, NULL),
(141, 45, 58, '3', '', '72.67', '76.00', '2.90', '47', '7.60', '1.50', '0.50', '0000-00-00', '', 0, 42, 0, 1, 0, '', 'CL141_1552472304.png', 0, '0', '2019-03-13 10:18:24', NULL, NULL),
(142, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 5, 37, 9, 1, 0, '', '', 0, '0', '2019-03-19 10:21:21', NULL, NULL),
(143, 33, 58, '1', '', '13.10', '10.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL143_1553065958.png', 0, '0', '2019-03-20 07:12:38', NULL, NULL),
(144, 33, 58, '1', '', '90.62', '86.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 4, 52, 9, 1, 0, '', 'CL144_1553066397.png', 0, '0', '2019-03-20 07:19:57', NULL, NULL),
(145, 33, 58, '1', '', '84.50', '80.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL145_1553066564.png', 0, '0', '2019-03-20 07:22:44', NULL, NULL),
(146, 33, 58, '1', '', '45.74', '42.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 5, 52, 9, 1, 0, '', 'CL146_1553067087.png', 0, '0', '2019-03-20 07:31:27', NULL, NULL),
(147, 33, 58, '1', '', '44.21', '40.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 5, 52, 9, 1, 0, '', 'CL147_1553067264.png', 0, '0', '2019-03-20 07:34:24', NULL, NULL),
(148, 33, 58, '1', '', '31.46', '28.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 4, 52, 9, 1, 0, '', 'CL148_1553067388.png', 0, '0', '2019-03-20 07:36:28', NULL, NULL),
(149, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL149_1553082272.png', 0, '0', '2019-03-20 11:44:32', NULL, NULL),
(150, 33, 52, '5', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-20', '8:36 PM', 0, 52, 0, 1, 0, '', 'CL150_1553085419.png', 0, '0', '2019-03-20 12:36:59', NULL, NULL),
(151, 33, 52, '6', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-20', '8:38 PM', 0, 0, 0, 1, 0, '', 'CL151_1553085510.png', 0, '0', '2019-03-20 12:38:30', NULL, NULL),
(152, 33, 52, '5', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-22', '8:43 PM', 0, 52, 0, 1, 0, '', 'CL152_1553085814.png', 0, '0', '2019-03-20 12:43:34', NULL, NULL),
(153, 33, 58, '6', '', '13.10', '10.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-22', '8:45 PM', 0, 0, 0, 1, 0, '', 'CL153_1553085929.png', 0, '0', '2019-03-20 12:45:29', NULL, NULL),
(154, 33, 58, '5', '', '42.69', '39.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-23', '10:2 PM', 0, 52, 0, 1, 0, '', 'CL154_1553086963.png', 0, '0', '2019-03-20 13:02:43', NULL, NULL),
(155, 33, 58, '5', '', '13.10', '10.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-23', '9:15 PM', 4, 52, 9, 1, 0, '', 'CL155_1553087211.png', 0, '0', '2019-03-20 13:06:51', NULL, NULL),
(156, 33, 62, '1', '', '185.80', '180.00', '2.20', '', '0.00', '1.50', '0.50', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL156_1553248333.png', 0, '0', '2019-03-22 09:52:13', NULL, NULL),
(157, 33, 58, '5', '', '13.10', '10.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-22', '5:54 PM', 4, 52, 9, 1, 0, '', 'CL157_1553248496.png', 0, '0', '2019-03-22 09:54:56', NULL, NULL),
(158, 33, 52, '6', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '2019-03-28', '5:55 PM', 6, 0, 0, 1, 0, '', 'CL158_1553248543.png', 0, '0', '2019-03-22 09:55:43', NULL, NULL),
(159, 33, 52, '3', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL159_1553267334.png', 0, '0', '2019-03-22 15:08:54', NULL, NULL),
(160, 36, 58, '1', '', '42.69', '39.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 5, 34, 11, 1, 0, '', 'CL160_1553326474.png', 0, '3.0', '2019-03-23 07:34:34', '2019-03-23 07:44:54', NULL),
(161, 33, 52, '3', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL161_1553491412.png', 0, '0', '2019-03-25 05:23:32', NULL, NULL),
(162, 33, 52, '3', '', '94.24', '89.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL162_1553491429.png', 0, '0', '2019-03-25 05:23:49', NULL, NULL),
(163, 33, 58, '1', '', '28.41', '25.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL163_1553491498.png', 0, '0', '2019-03-25 05:24:58', NULL, NULL),
(164, 33, 58, '6', '', '28.41', '25.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-25', '1:25 PM', 0, 0, 0, 1, 0, '', 'CL164_1553491529.png', 1, '3.0', '2019-03-25 05:25:29', NULL, NULL),
(165, 36, 58, '4', '1:29 PM', '17.69', '14.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL165_1553497225.png', 0, '0', '2019-03-25 07:00:25', NULL, NULL),
(166, 36, 58, '4', '2:36 PM', '18.71', '15.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL166_1553497613.png', 0, '0', '2019-03-25 07:06:53', NULL, NULL),
(167, 36, 58, '4', '02:53 PM', '17.18', '14.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL167_1553498626.png', 0, '0', '2019-03-25 07:23:46', NULL, NULL),
(168, 36, 58, '6', '', '28.41', '25.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-25', '05:56 PM', 0, 0, 0, 1, 0, '', 'CL168_1553498776.png', 0, '0', '2019-03-25 07:26:16', NULL, NULL),
(169, 45, 58, '3', '', '18.71', '15.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL169_1553499261.png', 0, '0', '2019-03-25 07:34:21', '2019-03-29 15:45:52', NULL),
(170, 45, 58, '1', '', '18.71', '15.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 53, 0, 1, 0, '', 'CL170_1553501628.png', 0, '0', '2019-03-25 08:13:48', NULL, NULL),
(171, 45, 58, '3', '', '41.66', '38.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL171_1553501698.png', 0, '0', '2019-03-25 08:14:58', NULL, NULL),
(172, 45, 58, '3', '', '33.50', '30.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL172_1553502264.png', 0, '0', '2019-03-25 08:24:24', NULL, NULL),
(173, 45, 52, '5', '', '66.10', '112.00', '1.50', '33', '50.00', '1.50', '2.70', '2019-03-27', '2:35 PM', 0, 53, 0, 1, 0, '', 'CL173_1553502452.png', 0, '0', '2019-03-25 08:27:32', NULL, NULL),
(174, 33, 52, '1', '', '152.60', '145.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL174_1553510155.png', 0, '0', '2019-03-25 10:35:55', NULL, NULL),
(175, 33, 58, '5', '', '28.41', '25.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-26', '06:33 PM', 8, 36, 0, 1, 0, '', 'CL175_1553511816.png', 0, '0', '2019-03-25 11:03:36', NULL, NULL),
(176, 33, 52, '1', '', '319.32', '305.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL176_1553512055.png', 0, '0', '2019-03-25 11:07:35', NULL, NULL),
(177, 33, 52, '3', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL177_1553512286.png', 0, '0', '2019-03-25 11:11:26', NULL, NULL),
(178, 33, 52, '6', '', '94.24', '89.00', '1.50', '', '0.00', '1.50', '2.70', '2019-03-29', '7:3 PM', 0, 0, 0, 1, 0, '', 'CL178_1553513622.png', 0, '0', '2019-03-25 11:33:42', NULL, NULL),
(179, 33, 52, '3', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL179_1553513952.png', 0, '0', '2019-03-25 11:39:12', NULL, NULL),
(180, 33, 52, '1', '', '59.85', '56.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL180_1553517118.png', 0, '0', '2019-03-25 12:31:58', NULL, NULL),
(181, 33, 52, '1', '', '59.85', '56.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL181_1553517118.png', 0, '0', '2019-03-25 12:31:58', NULL, NULL),
(182, 33, 52, '1', '', '59.85', '56.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL182_1553517449.png', 0, '0', '2019-03-25 12:37:29', NULL, NULL),
(183, 33, 52, '1', '', '59.85', '56.00', '1.50', '', '0.00', '1.5', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL183_1553518305.png', 1, '0', '2019-03-25 12:51:45', NULL, NULL),
(184, 45, 58, '2', '9:39 AM', '48.81', '45.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 1, 53, 0, 1, 0, '', 'CL184_1553571449.png', 0, '0', '2019-03-26 03:37:29', '2019-03-31 18:33:39', NULL),
(185, 45, 58, '2', '9:39 AM', '48.81', '45.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 1, 53, 0, 1, 0, '', 'CL185_1553571505.png', 0, '0', '2019-03-26 03:38:25', '2019-03-27 06:40:22', NULL),
(186, 45, 52, '3', '', '146.34', '189.00', '1.50', '33', '50.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL186_1553586841.png', 0, '0', '2019-03-26 07:54:01', NULL, NULL),
(187, 45, 52, '4', '2:50 PM', '41.62', '77.00', '1.50', '33', '38.50', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL187_1553589681.png', 0, '0', '2019-03-26 08:41:21', NULL, NULL),
(188, 45, 52, '3', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL188_1553590019.png', 0, '0', '2019-03-26 08:46:59', NULL, NULL),
(189, 45, 58, '1', '', '18.71', '15.50', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 4, 53, 5, 1, 0, '', 'CL189_1553591259.png', 0, '0', '2019-03-26 09:07:39', '2019-03-27 06:36:28', NULL),
(190, 33, 52, '3', '', '58.35', '56.00', '0.00', '', '0.00', '1.50', '2.70', '0000-00-00', '', 2, 0, 0, 1, 0, '', 'CL190_1553593620.png', 0, '5.0', '2019-03-26 09:47:00', '2019-03-27 15:34:16', NULL),
(191, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 1, 0, 0, 1, 2, '', 'CL191_1553595149.png', 0, '0', '2019-03-26 10:12:29', '2019-03-27 15:34:05', NULL),
(192, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL192_1553595302.png', 0, '0', '2019-03-26 10:15:02', NULL, NULL),
(193, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL193_1553595342.png', 0, '0', '2019-03-26 10:15:42', NULL, NULL),
(194, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL194_1553595443.png', 0, '0', '2019-03-26 10:17:23', NULL, NULL),
(195, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL195_1553595566.png', 0, '0', '2019-03-26 15:49:26', NULL, NULL),
(196, 33, 52, '4', '10:30 AM', '136.81', '187.00', '5.00', '35', '56.10', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL196_1553595601.png', 0, '0', '2019-03-26 15:50:01', NULL, NULL),
(197, 33, 52, '3', '', '58.35', '56.00', '0.00', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL197_1553595775.png', 0, '0', '2019-03-26 15:52:55', NULL, NULL),
(198, 72, 52, '1', '', '59.85', '56.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 3, 13, 2, 1, 0, '', 'CL198_1553617480.png', 0, '0', '2019-03-26 21:54:40', NULL, NULL),
(199, 45, 52, '1', '', '207.82', '198.00', '1.50', '', '0.00', '1.50', '2.70', '0000-00-00', '', 0, 65, 0, 1, 2, '', 'CL199_1553620802.png', 0, '0', '2019-03-26 17:20:02', NULL, NULL),
(200, 45, 58, '1', '', '13.74', '12.00', '1.50', '', '0.00', '1.50', '0.50', '0000-00-00', '', 1, 65, 0, 1, 0, '', 'CL200_1553622383.png', 1, '0', '2019-03-26 17:46:23', NULL, NULL),
(201, 72, 58, '1', '', '18.21', '15.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 3, 55, 4, 1, 0, '', 'CL201_1553633697.png', 1, '0', '2019-03-26 20:54:57', NULL, NULL),
(202, 33, 52, '3', '', '135.41', '185.00', '5.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL202_1553667483.png', 0, '0', '2019-03-27 11:48:03', NULL, NULL),
(203, 33, 52, '3', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL203_1553667524.png', 0, '0', '2019-03-27 11:48:44', NULL, NULL),
(204, 72, 58, '3', '', '16.75', '13.00', '2.90', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 58, 0, 1, 0, '', 'CL204_1553682073.png', 0, '0', '2019-03-27 10:21:13', '2019-03-31 18:33:32', NULL),
(205, 33, 52, '5', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '2019-03-27', '05:54 PM', 0, 52, 0, 1, 0, '', 'CL205_1553682252.png', 0, '0', '2019-03-27 15:54:12', NULL, NULL),
(206, 33, 52, '6', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '2019-03-31', '05:54 PM', 0, 0, 0, 1, 0, '', 'CL206_1553682296.png', 0, '5.0', '2019-03-27 15:54:56', NULL, NULL),
(207, 33, 52, '3', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 1, 0, 0, 1, 2, '', 'CL207_1553751105.png', 0, '5.0', '2019-03-28 11:01:45', '2019-03-28 12:23:15', NULL),
(208, 33, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL208_1553755384.png', 0, '0', '2019-03-28 12:13:04', '2019-03-28 12:18:05', NULL),
(209, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL209_1553756154.png', 0, '0', '2019-03-28 12:25:54', '2019-03-28 12:26:15', NULL),
(210, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 5, 52, 9, 1, 0, '', 'CL210_1553766402.png', 0, '0', '2019-03-28 15:16:42', NULL, NULL),
(211, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL211_1553769249.png', 0, '0', '2019-03-28 16:04:09', '2019-03-28 16:05:57', NULL),
(212, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 4, 52, 9, 1, 0, '', 'CL212_1553769768.png', 0, '0', '2019-03-28 16:12:48', '2019-03-28 16:13:21', NULL),
(213, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 2, 52, 0, 1, 0, '', 'CL213_1553769875.png', 0, '0', '2019-03-28 16:14:35', '2019-03-28 16:14:57', NULL),
(214, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL214_1553770449.png', 0, '0', '2019-03-28 16:24:09', '2019-03-28 16:24:33', NULL),
(215, 33, 52, '2', '07:48 PM', '62.37', '56.00', '0.00', '', '0.00', '6', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL215_1553779324.png', 0, '0', '2019-03-28 18:52:04', NULL, NULL),
(216, 33, 52, '4', '08:55 PM', '184.12', '168.00', '0.00', '', '0.00', '6', '2.7', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL216_1553779529.png', 0, '0', '2019-03-28 18:55:29', NULL, NULL),
(217, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 9, 1, 0, '', 'CL217_1553839389.png', 0, '0', '2019-03-29 11:33:09', '2019-03-29 12:30:02', NULL),
(218, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 9, 1, 0, '', 'CL218_1553849434.png', 0, '0', '2019-03-29 14:20:34', '2019-03-29 14:20:49', NULL),
(219, 33, 52, '1', '', '98.24', '89.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 9, 1, 0, '', 'CL219_1553849649.png', 0, '0', '2019-03-29 14:24:09', '2019-03-29 14:24:26', NULL),
(220, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL220_1553852475.png', 0, '0', '2019-03-29 15:11:15', NULL, NULL),
(221, 33, 52, '1', '', '206.94', '189.00', '0.00', '', '0.00', '6', '2.7', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL221_1553854694.png', 0, '0', '2019-03-29 15:48:14', NULL, NULL),
(222, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL222_1553854723.png', 0, '0', '2019-03-29 15:48:43', NULL, NULL),
(223, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 4, 52, 9, 1, 0, '', 'CL223_1553855191.png', 0, '0', '2019-03-29 15:56:31', '2019-03-29 15:57:28', NULL),
(224, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 5, 52, 9, 1, 2, '', 'CL224_1553855284.png', 0, '0', '2019-03-29 15:58:04', NULL, NULL),
(225, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 3, 52, 9, 1, 0, '', 'CL225_1553856070.png', 0, '0', '2019-03-29 16:11:10', '2019-03-29 16:11:34', NULL),
(226, 78, 58, '4', '03:30 PM', '41.24', '46.00', '0.00', '52', '10.00', '6.00', '0.50', '0000-00-00', '', 1, 68, 0, 1, 2, '', 'CL226_1554108896.png', 0, '0', '2019-04-01 08:54:56', '2019-04-01 16:27:47', NULL),
(227, 33, 58, '1', '', '16.75', '13.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 36, 9, 1, 0, '', 'CL227_1554116692.png', 0, '0', '2019-04-01 16:34:52', '2019-04-01 16:38:41', NULL),
(228, 33, 58, '5', '', '16.75', '13.00', '0.00', '', '0.00', '6.00', '0.50', '2019-04-05', '09:47 AM', 8, 70, 0, 1, 0, '', 'CL228_1554119250.png', 0, '0', '2019-04-01 17:17:30', NULL, NULL),
(229, 33, 58, '1', '', '40.18', '35.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 4, 70, 9, 1, 0, '', 'CL229_1554119314.png', 0, '0', '2019-04-01 17:18:34', '2019-04-01 17:19:01', NULL),
(230, 45, 58, '1', '', '34.85', '30.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 53, 0, 1, 0, '', 'CL230_1554126884.png', 0, '0', '2019-04-01 19:24:44', NULL, NULL),
(231, 32, 52, '1', '', '86.29', '78.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 76, 0, 1, 2, '', 'CL231_1554141332.png', 0, '0', '2019-04-01 17:55:32', NULL, NULL),
(232, 45, 58, '1', '', '15.68', '12.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 77, 0, 1, 0, '', 'CL232_1554141932.png', 0, '0', '2019-04-01 18:05:32', NULL, NULL),
(233, 45, 52, '1', '', '17.03', '63.00', '0.00', '38', '50.00', '6.00', '2.70', '0000-00-00', '', 0, 77, 0, 1, 0, '', 'CL233_1554141985.png', 0, '0', '2019-04-01 18:06:25', NULL, NULL),
(234, 33, 58, '1', '', '167.98', '205.00', '0.00', '55', '50.00', '6.00', '0.50', '0000-00-00', '', 0, 74, 0, 1, 0, '', 'CL234_1554278264.png', 0, '0', '2019-04-03 13:27:44', NULL, NULL),
(235, 33, 58, '1', '', '17.81', '14.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 74, 0, 1, 0, '', 'CL235_1554282511.png', 0, '0', '2019-04-03 14:38:31', NULL, NULL),
(236, 33, 58, '1', '', '16.75', '13.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 74, 0, 1, 0, '', 'CL236_1554283484.png', 0, '0', '2019-04-03 14:54:44', NULL, NULL),
(237, 33, 52, '5', '', '62.37', '56.00', '0.00', '', '0.00', '6', '2.7', '2019-04-03', '05:33 PM', 0, 52, 0, 1, 0, '', 'CL237_1554289913.png', 0, '0', '2019-04-03 16:41:53', NULL, NULL),
(238, 33, 52, '6', '', '62.37', '56.00', '0.00', '', '0.00', '6', '2.7', '2019-04-04', '05:02 PM', 0, 0, 0, 1, 0, '', 'CL238_1554291174.png', 0, '4.9', '2019-04-03 17:02:54', NULL, NULL),
(239, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL239_1554358084.png', 1, '0', '2019-04-04 11:38:04', NULL, NULL),
(240, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL240_1554358141.png', 1, '0', '2019-04-04 11:39:01', NULL, NULL),
(241, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL241_1554358339.png', 0, '0', '2019-04-04 11:42:19', NULL, NULL),
(242, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL242_1554358541.png', 0, '0', '2019-04-04 11:45:41', NULL, NULL),
(243, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL243_1554358688.png', 0, '0', '2019-04-04 11:48:08', NULL, NULL),
(244, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL244_1554377841.png', 0, '0', '2019-04-04 17:07:21', NULL, NULL),
(245, 33, 52, '1', '', '98.24', '89.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL245_1554377847.png', 0, '0', '2019-04-04 17:07:27', NULL, NULL),
(246, 33, 58, '1', '', '70.11', '44.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL246_1554378026.png', 0, '0', '2019-04-04 17:10:26', NULL, NULL),
(247, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL247_1554378210.png', 0, '0', '2019-04-04 17:13:30', NULL, NULL),
(248, 33, 58, '1', '', '70.11', '44.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 52, 9, 1, 0, '', 'CL248_1554378724.png', 0, '0', '2019-04-04 17:22:04', '2019-04-04 17:25:26', NULL),
(249, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL249_1554379812.png', 0, '0', '2019-04-04 17:40:12', NULL, NULL),
(250, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL250_1554379851.png', 0, '0', '2019-04-04 17:40:51', NULL, NULL),
(251, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL251_1554379864.png', 0, '0', '2019-04-04 17:41:04', NULL, NULL),
(252, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL252_1554380018.png', 0, '0', '2019-04-04 17:43:38', NULL, NULL),
(253, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL253_1554380385.png', 0, '0', '2019-04-04 17:49:45', NULL, NULL),
(254, 33, 58, '1', '', '104.19', '126.00', '0.00', '55', '50.00', '6.00', '0.50', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL254_1554380432.png', 0, '0', '2019-04-04 17:50:31', NULL, NULL),
(255, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL255_1554380682.png', 0, '0', '2019-04-04 17:54:42', NULL, NULL),
(256, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL256_1554380713.png', 0, '0', '2019-04-04 17:55:13', NULL, NULL),
(257, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL257_1554381102.png', 0, '0', '2019-04-04 18:01:42', NULL, NULL),
(258, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL258_1554381181.png', 0, '0', '2019-04-04 18:03:01', NULL, NULL),
(259, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL259_1554381189.png', 0, '0', '2019-04-04 18:03:09', NULL, NULL),
(260, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL260_1554381206.png', 0, '0', '2019-04-04 18:03:26', NULL, NULL),
(261, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL261_1554381228.png', 0, '0', '2019-04-04 18:03:48', NULL, NULL),
(262, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL262_1554381242.png', 0, '0', '2019-04-04 18:04:02', NULL, NULL),
(263, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL263_1554381352.png', 0, '0', '2019-04-04 18:05:52', NULL, NULL),
(264, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL264_1554381554.png', 0, '0', '2019-04-04 18:09:14', NULL, NULL),
(265, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL265_1554381604.png', 0, '0', '2019-04-04 18:10:04', NULL, NULL),
(266, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL266_1554381609.png', 0, '0', '2019-04-04 18:10:09', NULL, NULL),
(267, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL267_1554381722.png', 0, '0', '2019-04-04 18:12:02', NULL, NULL),
(268, 33, 52, '1', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL268_1554381964.png', 0, '0', '2019-04-04 18:16:04', NULL, NULL),
(269, 33, 52, '2', '10:30 AM', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 52, 0, 1, 2, '', 'CL269_1554382075.png', 0, '0', '2019-04-04 18:17:55', NULL, NULL),
(270, 33, 52, '3', '', '135.41', '185.00', '0.00', '35', '55.50', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL270_1554382100.png', 0, '0', '2019-04-04 18:18:20', NULL, NULL),
(271, 33, 58, '1', '', '108.45', '130.00', '0.00', '55', '50.00', '6.00', '0.50', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL271_1554382264.png', 0, '0', '2019-04-04 18:21:04', NULL, NULL),
(272, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 5, 52, 9, 1, 0, '', 'CL272_1554441124.png', 0, '0', '2019-04-05 10:42:04', '2019-04-05 10:43:50', NULL),
(273, 33, 58, '5', '', '37.10', '13.00', '0.00', '', '0.00', '6.00', '0.50', '2019-04-05', '5:7 PM', 0, 52, 0, 1, 0, '', 'CL273_1554449858.png', 0, '0', '2019-04-05 13:07:38', NULL, NULL),
(274, 46, 58, '1', '', '24.20', '20.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 67, 0, 1, 2, '', 'CL274_1554456723.png', 0, '0', '2019-04-05 09:32:03', NULL, NULL),
(275, 48, 58, '2', '06:32 PM', '18.88', '15.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 4, 50, 9, 1, 2, '', 'CL275_1554458596.png', 0, '0', '2019-04-05 10:03:16', '2019-04-05 15:36:05', NULL),
(276, 45, 58, '2', '04:30 PM', '34.85', '30.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 53, 0, 1, 0, '', 'CL276_1554459993.png', 0, '3.0', '2019-04-05 15:56:33', NULL, NULL),
(277, 33, 52, '1', '', '62.37', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL277_1554460435.png', 0, '0', '2019-04-05 16:03:55', NULL, NULL),
(278, 33, 52, '1', '', '62.37', '56.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 52, 0, 1, 0, '', 'CL278_1554460503.png', 0, '0', '2019-04-05 16:05:03', NULL, NULL),
(279, 45, 58, '2', '04:45 PM', '121.12', '121.00', '2.90', '51', '10.00', '6.00', '0.50', '0000-00-00', '', 0, 53, 0, 1, 0, '', 'CL279_1554460634.png', 0, '0', '2019-04-05 16:07:14', NULL, NULL),
(280, 48, 86, '1', '', '143.80', '110.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 4, 82, 9, 1, 0, '', 'CL280_1554466981.png', 1, '0', '2019-04-05 12:23:01', '2019-04-05 17:59:59', NULL),
(281, 33, 86, '1', '', '262.60', '220.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 4, 52, 9, 1, 0, '', 'CL281_1554470379.png', 0, '0', '2019-04-05 18:49:39', '2019-04-05 18:50:33', NULL),
(282, 48, 86, '2', '08:13 PM', '155.68', '121.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 2, 82, 0, 1, 0, '', 'CL282_1554471849.png', 0, '0', '2019-04-05 13:44:09', NULL, NULL),
(283, 87, 52, '2', '09:58 PM', '175.42', '160.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 83, 0, 1, 2, '', 'CL283_1554685106.png', 0, '0', '2019-04-08 00:58:26', NULL, NULL),
(284, 36, 86, '3', '', '286.36', '242.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 2, 0, 0, 1, 0, '', 'CL284_1554704036.png', 0, '0', '2019-04-08 11:43:56', '2019-04-08 11:48:42', NULL),
(285, 36, 86, '2', '01:00 PM', '84.40', '55.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 5, 34, 9, 1, 0, '', 'CL285_1554705584.png', 0, '0', '2019-04-08 12:09:44', '2019-04-08 12:10:20', NULL),
(286, 36, 86, '4', '10:01 PM', '439.72', '384.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 3, 0, 9, 1, 0, '', 'CL286_1554708863.png', 0, '0', '2019-04-08 13:04:23', '2019-04-08 13:07:56', NULL),
(287, 36, 86, '5', '', '89.80', '60.00', '25.00', '', '0.00', '6.00', '2.00', '2019-04-11', '02:29 PM', 5, 35, 9, 1, 0, '', 'CL287_1554710375.png', 0, '0', '2019-04-08 13:29:35', '2019-04-08 13:30:02', NULL),
(288, 36, 52, '2', '07:40 PM', '445.33', '399.60', '10.96', '', '0.00', '6.00', '2.70', '0000-00-00', '', 4, 34, 9, 1, 0, '', 'CL288_1554714641.png', 0, '0', '2019-04-08 14:40:41', '2019-04-08 14:44:19', NULL),
(289, 36, 52, '1', '', '77.29', '56.00', '16.42', '', '0.00', '6.00', '2.70', '0000-00-00', '', 4, 84, 9, 1, 0, '', 'CL289_1554715389.png', 0, '0', '2019-04-08 14:53:09', '2019-04-08 14:53:42', NULL),
(290, 36, 52, '2', '09:56 PM', '1115.81', '1011.40', '16.42', '', '0.00', '6.00', '2.70', '0000-00-00', '', 3, 13, 5, 1, 0, '', 'CL290_1554716515.png', 0, '0', '2019-04-08 15:11:55', '2019-04-08 15:27:11', NULL),
(291, 36, 52, '5', '', '337.06', '300.00', '10.96', '', '0.00', '6.00', '2.70', '2019-04-10', '04:28 AM', 4, 35, 9, 1, 0, '', 'CL291_1554717563.png', 0, '0', '2019-04-08 15:29:23', '2019-04-08 15:30:06', NULL),
(292, 36, 52, '6', '', '445.33', '399.60', '0.00', '', '0.00', '6.00', '2.70', '2019-04-11', '01:31 PM', 1, 0, 0, 1, 0, '', 'CL292_1554717705.png', 0, '0', '2019-04-08 15:31:45', '2019-04-08 15:43:27', NULL),
(293, 36, 52, '5', '', '77.29', '56.00', '16.42', '', '0.00', '6.00', '2.70', '2019-04-13', '07:45 PM', 4, 84, 9, 1, 0, '', 'CL293_1554718582.png', 0, '0', '2019-04-08 15:46:22', '2019-04-08 15:46:45', NULL),
(294, 36, 52, '5', '', '77.29', '56.00', '16.42', '', '0.00', '6.00', '2.70', '2019-04-11', '03:52 PM', 4, 84, 9, 1, 0, '', 'CL294_1554718977.png', 0, '0', '2019-04-08 15:52:57', NULL, NULL),
(295, 36, 52, '4', '05:10 PM', '233.82', '200.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL295_1554720571.png', 0, '0', '2019-04-08 16:19:31', NULL, NULL),
(296, 36, 52, '1', '', '244.99', '224.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 13, 0, 1, 0, '', 'CL296_1554723211.png', 0, '0', '2019-04-08 17:03:31', NULL, NULL),
(297, 36, 52, '1', '', '123.24', '112.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 2, 13, 0, 1, 0, '', 'CL297_1554723286.png', 0, '0', '2019-04-08 17:04:46', NULL, NULL),
(298, 33, 52, '5', '', '78.97', '56.00', '18.10', '', '0.00', '6.00', '2.70', '2019-04-09', '05:40 PM', 0, 52, 0, 1, 0, '', 'CL298_1554725450.png', 0, '0', '2019-04-08 17:40:50', NULL, NULL),
(299, 36, 58, '1', '', '8.23', '5.00', '2.90', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 33, 0, 1, 0, '', 'CL299_1554786323.png', 0, '0', '2019-04-09 10:35:23', NULL, NULL),
(300, 36, 52, '3', '', '159.12', '145.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 2, 0, 0, 1, 0, '', 'CL300_1554792381.png', 0, '0', '2019-04-09 12:16:21', '2019-04-09 12:45:21', NULL),
(301, 33, 52, '5', '', '78.97', '56.00', '18.10', '', '0.00', '6.00', '2.70', '2019-04-10', '06:38 PM', 8, 52, 0, 1, 0, '', 'CL301_1554793739.png', 0, '0', '2019-04-09 12:38:59', NULL, NULL),
(302, 33, 58, '5', '', '8.23', '5.00', '2.90', '', '0.00', '6.00', '0.50', '2019-04-11', '12:39 PM', 8, 47, 0, 1, 0, '', 'CL302_1554793790.png', 0, '0', '2019-04-09 12:39:50', NULL, NULL),
(303, 33, 58, '5', '', '24.73', '20.50', '2.90', '', '0.00', '6.00', '0.50', '2019-04-12', '12:40 PM', 8, 47, 0, 1, 0, '', 'CL303_1554793817.png', 0, '0', '2019-04-09 12:40:16', NULL, NULL),
(304, 36, 52, '3', '', '110.20', '100.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL304_1554794221.png', 0, '0', '2019-04-09 12:47:01', NULL, NULL),
(305, 36, 52, '3', '', '212.38', '194.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL305_1554794245.png', 0, '0', '2019-04-09 12:47:25', NULL, NULL),
(306, 36, 52, '3', '', '218.68', '199.80', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL306_1554794269.png', 0, '0', '2019-04-09 12:47:49', NULL, NULL),
(307, 36, 52, '3', '', '110.20', '100.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL307_1554794288.png', 0, '0', '2019-04-09 12:48:08', NULL, NULL),
(308, 36, 52, '3', '', '177.59', '162.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL308_1554794311.png', 0, '0', '2019-04-09 12:48:31', NULL, NULL),
(309, 36, 52, '3', '', '192.81', '176.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL309_1554794352.png', 0, '0', '2019-04-09 12:49:12', NULL, NULL),
(310, 36, 52, '3', '', '218.90', '200.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL310_1554794470.png', 0, '0', '2019-04-09 12:51:10', NULL, NULL),
(311, 36, 52, '3', '', '473.26', '434.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL311_1554794579.png', 0, '0', '2019-04-09 12:52:59', NULL, NULL),
(312, 36, 52, '3', '', '183.03', '167.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL312_1554794663.png', 0, '0', '2019-04-09 12:54:23', NULL, NULL),
(313, 36, 52, '3', '', '177.59', '162.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL313_1554794900.png', 0, '0', '2019-04-09 12:58:20', NULL, NULL),
(314, 36, 52, '3', '', '177.59', '162.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL314_1554795008.png', 0, '0', '2019-04-09 13:00:08', NULL, NULL),
(315, 36, 52, '3', '', '123.24', '112.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL315_1554795058.png', 0, '0', '2019-04-09 13:00:58', NULL, NULL),
(316, 36, 52, '3', '', '110.20', '100.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL316_1554795158.png', 0, '0', '2019-04-09 13:02:38', NULL, NULL),
(317, 36, 52, '3', '', '177.59', '162.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL317_1554795181.png', 0, '0', '2019-04-09 13:03:01', NULL, NULL),
(318, 36, 52, '3', '', '299.34', '274.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL318_1554795360.png', 0, '0', '2019-04-09 13:06:00', NULL, NULL),
(319, 36, 52, '3', '', '293.90', '269.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL319_1554795531.png', 0, '0', '2019-04-09 13:08:51', NULL, NULL),
(320, 36, 52, '3', '', '293.90', '269.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL320_1554795925.png', 0, '0', '2019-04-09 13:15:25', NULL, NULL),
(321, 36, 52, '3', '', '110.20', '100.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL321_1554795946.png', 0, '0', '2019-04-09 13:15:46', NULL, NULL),
(322, 36, 52, '3', '', '110.20', '100.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL322_1554796011.png', 0, '0', '2019-04-09 13:16:51', NULL, NULL),
(323, 36, 86, '3', '', '81.16', '52.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL323_1554796641.png', 0, '0', '2019-04-09 13:27:21', NULL, NULL),
(324, 36, 86, '3', '', '89.80', '60.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL324_1554796984.png', 0, '0', '2019-04-09 13:33:04', NULL, NULL),
(325, 36, 86, '4', '08:42 PM', '36.88', '11.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL325_1554800231.png', 0, '0', '2019-04-09 14:27:11', NULL, NULL),
(326, 45, 94, '1', '', '145.45', '150.00', '1.00', '50', '15.00', '6.00', '1.00', '0000-00-00', '', 6, 53, 5, 1, 0, '', 'CL326_1554800762.png', 0, '0', '2019-04-09 14:36:02', '2019-04-09 18:35:14', NULL),
(327, 45, 94, '5', '', '43.80', '50.00', '1.00', '52', '10.00', '6.00', '1.00', '2019-04-09', '03:15 PM', 2, 53, 0, 1, 0, '', 'CL327_1554800928.png', 0, '0', '2019-04-09 14:38:47', '2019-04-09 18:35:06', NULL),
(328, 45, 58, '5', '', '19.41', '15.50', '2.90', '', '0.00', '6.00', '0.50', '2019-04-10', '12:39 PM', 8, 53, 0, 1, 0, '', 'CL328_1554800996.png', 1, '0', '2019-04-09 14:39:56', NULL, NULL),
(329, 33, 52, '1', '', '168.13', '162.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL329_1554801313.png', 0, '0', '2019-04-09 14:45:13', NULL, NULL),
(330, 33, 52, '1', '', '105.70', '100.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL330_1554801437.png', 0, '0', '2019-04-09 14:47:17', NULL, NULL),
(331, 45, 94, '5', '', '525.30', '500.00', '1.00', '57', '10.00', '6.00', '1.00', '2019-04-10', '1:0 PM', 3, 53, 5, 1, 0, '', 'CL331_1554801515.png', 1, '0', '2019-04-09 14:48:35', '2019-04-09 18:34:57', NULL),
(332, 33, 52, '1', '', '268.83', '262.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL332_1554801729.png', 0, '0', '2019-04-09 14:52:09', NULL, NULL),
(333, 36, 52, '3', '', '286.29', '262.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL333_1554802560.png', 0, '0', '2019-04-09 15:06:00', NULL, NULL),
(334, 36, 86, '3', '', '133.00', '100.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 2, 0, 0, 1, 0, '', 'CL334_1554802788.png', 0, '0', '2019-04-09 15:09:48', NULL, NULL),
(335, 36, 52, '1', '', '628.25', '567.00', '11.92', '', '0.00', '6.00', '2.70', '0000-00-00', '', 1, 34, 0, 1, 0, '', 'CL335_1554804896.png', 0, '0', '2019-04-09 15:44:56', '2019-04-09 15:52:54', NULL),
(336, 36, 52, '1', '', '237.97', '207.00', '12.96', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 34, 0, 1, 0, '', 'CL336_1554806262.png', 0, '0', '2019-04-09 16:07:42', NULL, NULL),
(337, 36, 52, '3', '', '73.83', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 3, 0, 5, 1, 0, '', 'CL337_1554806507.png', 1, '0', '2019-04-09 16:11:47', '2019-04-09 16:12:02', NULL),
(338, 45, 94, '1', '', '54.50', '50.00', '1.00', '', '0.00', '6.00', '1.00', '0000-00-00', '', 3, 53, 9, 1, 0, '', 'CL338_1554813280.png', 0, '0', '2019-04-09 18:04:40', '2019-04-09 18:34:52', NULL),
(339, 33, 52, '1', '', '62.37', '56.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 47, 0, 1, 0, '', 'CL339_1554901309.png', 0, '0', '2019-04-10 18:31:49', NULL, NULL),
(340, 33, 52, '1', '', '164.55', '150.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 47, 0, 1, 0, '', 'CL340_1554901414.png', 0, '0', '2019-04-10 18:33:34', NULL, NULL),
(341, 33, 58, '1', '', '8.23', '5.00', '2.90', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 47, 0, 1, 0, '', 'CL341_1554901476.png', 0, '0', '2019-04-10 18:34:36', NULL, NULL),
(342, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL342_1554902696.png', 0, '0', '2019-04-10 18:54:56', NULL, NULL),
(343, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL343_1554902945.png', 0, '0', '2019-04-10 18:59:05', NULL, NULL),
(344, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL344_1554903182.png', 0, '0', '2019-04-10 19:03:02', NULL, NULL),
(345, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL345_1554903818.png', 0, '0', '2019-04-10 19:13:38', NULL, NULL),
(346, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL346_1554903843.png', 0, '0', '2019-04-10 19:14:03', NULL, NULL),
(347, 72, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 80, 0, 1, 2, '', 'CL347_1554910419.png', 0, '0', '2019-04-10 15:33:39', NULL, NULL),
(348, 72, 58, '1', '', '13.55', '10.00', '2.90', '', '0.00', '6.00', '0.50', '0000-00-00', '', 0, 81, 0, 1, 2, '', 'CL348_1554950852.png', 0, '0', '2019-04-11 02:47:32', NULL, NULL),
(349, 36, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 2, 33, 0, 1, 0, '', 'CL349_1554960892.png', 0, '0', '2019-04-11 11:04:52', NULL, NULL),
(350, 36, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 2, 34, 0, 1, 0, '', 'CL350_1554961157.png', 0, '0', '2019-04-11 11:09:17', NULL, NULL),
(351, 36, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 3, 34, 5, 1, 0, '', 'CL351_1554961515.png', 0, '0', '2019-04-11 11:15:15', NULL, NULL),
(352, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 2, 70, 0, 1, 2, '', 'CL352.png', 0, '0', '2019-04-11 12:40:22', NULL, NULL),
(353, 33, 86, '5', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '2019-04-16', '05:40 AM', 8, 71, 0, 1, 0, '', 'CL353.png', 0, '0', '2019-04-11 15:11:00', NULL, NULL);
INSERT INTO `orders` (`id`, `customer_id`, `shop_id`, `order_type`, `later_time`, `total`, `subtotal`, `delivery_charges`, `promocode_id`, `promo_amount`, `tax`, `service_charge`, `schedule_date`, `schedule_time`, `order_status`, `delivery_address_id`, `delivery_boy_id`, `payment_status`, `payment_mode`, `transaction_id`, `QR_code`, `favourite`, `rating`, `created_at`, `updated_at`, `deleted_at`) VALUES
(354, 33, 52, '5', '', '62.37', '56.00', '1.50', '', '0.00', '6.00', '2.70', '2019-04-11', '05:41 AM', 5, 36, 9, 1, 0, '', 'CL354.png', 0, '0', '2019-04-11 15:12:01', '2019-04-11 16:06:58', NULL),
(355, 45, 58, '1', '', '8.02', '5.00', '13.35', '51', '10.00', '6.00', '0.50', '0000-00-00', '', 0, 86, 0, 1, 2, '', 'CL355_1554978901.png', 1, '0', '2019-04-11 10:35:01', NULL, NULL),
(356, 48, 58, '2', '10:13 PM', '181.92', '178.00', '3.00', '59', '10.00', '6.00', '0.50', '0000-00-00', '', 0, 50, 0, 1, 0, '', 'CL356_1554983040.png', 0, '0', '2019-04-11 11:44:00', NULL, NULL),
(357, 48, 86, '3', '', '21.60', '20.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 50, 0, 1, 0, '', 'CL357_1554983452.png', 0, '0', '2019-04-11 11:50:52', NULL, NULL),
(358, 48, 86, '1', '', '13.80', '10.00', '3.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 50, 0, 1, 0, '', 'CL358_1554983483.png', 0, '0', '2019-04-11 11:51:23', NULL, NULL),
(359, 48, 86, '1', '', '35.40', '30.00', '3.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 50, 0, 1, 0, '', 'CL359_1554983506.png', 1, '0', '2019-04-11 11:51:46', NULL, NULL),
(360, 46, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL360_1554985469.png', 0, '0', '2019-04-11 12:24:29', NULL, NULL),
(361, 46, 86, '4', '06:55 PM', '118.80', '110.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL361_1554985537.png', 0, '0', '2019-04-11 12:25:37', NULL, NULL),
(362, 48, 86, '4', '08:56 PM', '118.80', '110.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL362_1554985604.png', 0, '0', '2019-04-11 12:26:44', NULL, NULL),
(363, 33, 86, '1', '', '100.60', '110.00', '25.00', '60', '40.00', '6.00', '2.00', '0000-00-00', '', 0, 47, 0, 1, 0, '', 'CL363.png', 0, '0', '2019-04-11 18:09:44', NULL, NULL),
(364, 33, 58, '1', '', '243.69', '226.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 47, 0, 1, 0, '', 'CL364.png', 0, '0', '2019-04-11 18:11:38', '2019-04-13 22:50:48', NULL),
(365, 36, 86, '4', '11:30 PM', '262.60', '220.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL365.png', 0, '0', '2019-04-11 18:50:17', NULL, NULL),
(366, 36, 86, '2', '07:39 PM', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 33, 0, 1, 0, '', 'CL366.png', 0, '0', '2019-04-11 18:51:40', NULL, NULL),
(367, 33, 58, '1', '', '161.69', '159.00', '3.00', '51', '10.00', '6.00', '0.50', '0000-00-00', '', 3, 47, 14, 1, 0, '', 'CL367.png', 0, '0', '2019-04-11 18:53:30', '2019-04-13 22:50:40', NULL),
(368, 36, 86, '1', '', '262.60', '220.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 33, 0, 1, 0, '', 'CL368.png', 0, '0', '2019-04-11 19:05:09', NULL, NULL),
(369, 36, 86, '1', '', '262.60', '220.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 33, 0, 1, 0, '', 'CL369.png', 0, '0', '2019-04-11 19:05:43', NULL, NULL),
(370, 36, 86, '1', '', '338.20', '330.00', '25.00', '60', '40.00', '6.00', '2.00', '0000-00-00', '', 0, 33, 0, 1, 0, '', 'CL370.png', 0, '0', '2019-04-11 19:21:13', NULL, NULL),
(371, 33, 86, '1', '', '338.20', '330.00', '25.00', '60', '40.00', '6.00', '2.00', '0000-00-00', '', 3, 47, 14, 1, 0, '', 'CL371.png', 0, '0', '2019-04-11 19:26:00', NULL, NULL),
(372, 72, 58, '1', '', '243.69', '226.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 87, 0, 1, 2, '', 'CL372_1554996618.png', 0, '0', '2019-04-11 15:30:18', '2019-04-14 03:54:54', NULL),
(373, 72, 58, '1', '', '116.96', '107.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 2, '', 'CL373_1554996862.png', 0, '0', '2019-04-11 15:34:22', '2019-04-13 22:51:00', NULL),
(374, 72, 58, '3', '', '-5.33', '5.00', '0.00', '51', '10.00', '6.00', '0.50', '0000-00-00', '', 1, 87, 0, 1, 2, '', 'CL374_1554997010.png', 0, '0', '2019-04-11 15:36:50', '2019-04-13 22:50:55', NULL),
(375, 45, 58, '1', '', '22.17', '20.00', '3.00', '53', '2.00', '6.00', '0.50', '0000-00-00', '', 3, 53, 14, 1, 0, '', 'CL375.png', 0, '0', '2019-04-11 22:13:21', '2019-04-13 22:50:33', NULL),
(376, 72, 58, '1', '', '116.96', '107.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 2, '', 'CL376_1555019925.png', 0, '0', '2019-04-11 21:58:45', '2019-04-13 22:50:17', NULL),
(377, 72, 52, '1', '', '74.74', '66.00', '3.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL377_1555020537.png', 0, '0', '2019-04-11 22:08:57', NULL, NULL),
(378, 72, 52, '1', '', '80.18', '71.00', '3.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL378_1555020633.png', 0, '0', '2019-04-11 22:10:33', NULL, NULL),
(379, 72, 52, '1', '', '80.18', '71.00', '3.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL379_1555020687.png', 0, '0', '2019-04-11 22:11:27', NULL, NULL),
(380, 72, 52, '1', '', '63.87', '56.00', '3.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL380_1555020731.png', 0, '0', '2019-04-11 22:12:11', NULL, NULL),
(381, 41, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 88, 9, 1, 0, '', 'CL381.png', 0, '0', '2019-04-12 12:36:11', NULL, NULL),
(382, 41, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 88, 9, 1, 0, '', 'CL382.png', 0, '4.9', '2019-04-12 12:46:09', NULL, NULL),
(383, 33, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 47, 9, 1, 0, '', 'CL383.png', 0, '0', '2019-04-12 13:00:27', NULL, NULL),
(384, 41, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 6, 88, 9, 1, 0, '', 'CL384.png', 0, '0', '2019-04-12 13:15:12', NULL, NULL),
(385, 41, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 6, 88, 9, 1, 0, '', 'CL385.png', 0, '0', '2019-04-12 13:28:05', NULL, NULL),
(386, 45, 58, '1', '', '111.63', '107.00', '3.00', '53', '5.00', '6.00', '0.50', '0000-00-00', '', 3, 53, 14, 1, 0, '', 'CL386_1555063671.png', 0, '0', '2019-04-12 10:07:51', '2019-04-13 22:50:27', NULL),
(387, 33, 52, '1', '', '431.97', '424.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 70, 0, 1, 2, '', 'CL387.png', 0, '0', '2019-04-12 16:39:41', NULL, NULL),
(388, 95, 86, '2', '07:15 PM', '160.00', '135.00', '25.00', '59', '10.00', '6.00', '2.00', '0000-00-00', '', 0, 89, 0, 1, 2, '', 'CL388_1555068007.png', 0, '0', '2019-04-12 11:20:07', NULL, NULL),
(389, 72, 52, '1', '', '73.24', '66.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 13, 0, 1, 2, '', 'CL389_1555069472.png', 0, '0', '2019-04-12 11:44:32', NULL, NULL),
(390, 72, 58, '1', '', '116.96', '107.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 2, '', 'CL390_1555069510.png', 0, '0', '2019-04-12 11:45:10', '2019-04-13 22:50:05', NULL),
(391, 72, 86, '1', '', '143.80', '110.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 87, 0, 1, 2, '', 'CL391_1555069545.png', 0, '0', '2019-04-12 11:45:45', NULL, NULL),
(392, 95, 86, '3', '', '284.04', '273.00', '0.00', '57', '10.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL392_1555071452.png', 0, '0', '2019-04-12 12:17:32', NULL, NULL),
(393, 95, 86, '1', '', '603.88', '546.00', '25.00', '57', '10.00', '6.00', '2.00', '0000-00-00', '', 0, 89, 0, 1, 2, '', 'CL393_1555071694.png', 1, '0', '2019-04-12 12:21:34', NULL, NULL),
(394, 95, 86, '6', '', '382.86', '364.50', '0.00', '56', '10.00', '6.00', '2.00', '2019-04-14', '09:46 AM', 0, 0, 0, 1, 0, '', 'CL394.png', 1, '0', '2019-04-12 18:17:33', NULL, NULL),
(395, 33, 52, '1', '', '62.37', '56.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 18, 0, 1, 0, '', 'CL395.png', 0, '0', '2019-04-12 18:42:29', NULL, NULL),
(396, 72, 52, '1', '', '98.24', '89.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 87, 0, 1, 2, '', 'CL396_1555076157.png', 0, '0', '2019-04-12 13:35:57', NULL, NULL),
(397, 72, 58, '1', '', '9.39', '6.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 2, '', 'CL397_1555076368.png', 0, '0', '2019-04-12 13:39:28', '2019-04-13 22:49:58', NULL),
(398, 95, 52, '2', '11:41 AM', '39.55', '35.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 89, 0, 1, 0, '', 'CL398.png', 0, '5.0', '2019-04-12 19:11:32', NULL, NULL),
(399, 72, 86, '1', '', '46.60', '20.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 87, 0, 1, 2, '', 'CL399_1555076513.png', 0, '0', '2019-04-12 13:41:53', NULL, NULL),
(400, 72, 52, '1', '', '98.24', '89.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 87, 0, 1, 2, '', 'CL400_1555077196.png', 0, '0', '2019-04-12 13:53:16', NULL, NULL),
(401, 95, 86, '2', '10:54 AM', '156.22', '121.50', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 89, 0, 1, 0, '', 'CL401.png', 0, '0', '2019-04-12 19:24:54', NULL, NULL),
(402, 95, 86, '1', '', '35.80', '10.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 89, 0, 1, 0, '', 'CL402.png', 0, '0', '2019-04-12 19:26:30', NULL, NULL),
(403, 95, 52, '3', '', '431.97', '424.00', '0.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 0, 0, 1, 2, '', 'CL403.png', 0, '0', '2019-04-12 19:35:20', NULL, NULL),
(404, 48, 86, '4', '01:15 PM', '37.91', '39.00', '0.00', '53', '3.90', '6.00', '2.00', '0000-00-00', '', 8, 0, 0, 1, 0, '', 'CL404_1555139569.png', 0, '0', '2019-04-13 07:12:49', '2019-04-13 12:43:29', NULL),
(405, 48, 86, '3', '', '13.50', '12.50', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 8, 0, 0, 1, 0, '', 'CL405_1555140498.png', 0, '0', '2019-04-13 07:28:18', '2019-04-13 12:58:43', NULL),
(406, 48, 86, '4', '01:30 PM', '32.40', '30.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL406_1555140584.png', 0, '0', '2019-04-13 07:29:44', '2019-04-13 12:59:58', NULL),
(407, 48, 86, '3', '', '13.50', '12.50', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL407_1555142107.png', 0, '0', '2019-04-13 07:55:07', '2019-04-13 13:25:20', NULL),
(408, 33, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL408.png', 0, '0', '2019-04-13 13:25:47', NULL, NULL),
(409, 33, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL409.png', 0, '0', '2019-04-13 13:25:48', NULL, NULL),
(410, 72, 58, '1', '', '116.96', '107.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 13, 1, 2, '', 'CL410_1555161838.png', 0, '0', '2019-04-13 13:23:58', '2019-04-13 19:00:59', NULL),
(411, 72, 58, '3', '', '5.33', '5.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 0, 14, 1, 2, '', 'CL411_1555167896.png', 0, '0', '2019-04-13 15:04:56', '2019-04-13 20:37:19', NULL),
(412, 72, 58, '1', '', '18.98', '15.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 14, 1, 2, '', 'CL412_1555170264.png', 0, '0', '2019-04-13 15:44:24', '2019-04-13 22:49:36', NULL),
(413, 72, 58, '1', '', '8.33', '15.00', '3.00', '51', '10.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 14, 1, 2, '', 'CL413_1555170384.png', 0, '0', '2019-04-13 15:46:24', '2019-04-13 21:22:07', NULL),
(414, 45, 94, '1', '', '54.50', '50.00', '1.00', '', '0.00', '6.00', '1.00', '0000-00-00', '', 0, 56, 0, 1, 0, '', 'CL414.png', 1, '0', '2019-04-13 22:50:47', NULL, NULL),
(415, 45, 86, '2', '11:55 PM', '46.60', '20.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 91, 0, 1, 0, '', 'CL415.png', 0, '0', '2019-04-13 23:13:10', NULL, NULL),
(416, 45, 86, '2', '11:55 PM', '46.60', '20.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 3, 91, 5, 1, 0, '', 'CL416.png', 0, '0', '2019-04-13 23:13:22', NULL, NULL),
(417, 72, 58, '1', '', '9.39', '6.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 14, 1, 0, '', 'CL417.png', 0, '0', '2019-04-14 03:17:59', '2019-04-14 03:20:40', NULL),
(418, 97, 58, '1', '', '34.95', '30.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 92, 14, 1, 2, '', 'CL418_1555193691.png', 0, '0', '2019-04-13 22:14:51', '2019-04-14 03:54:46', NULL),
(419, 72, 58, '1', '', '9.39', '6.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 0, '', 'CL419_1555193803.png', 0, '0', '2019-04-13 22:16:43', '2019-04-14 03:54:23', NULL),
(420, 72, 58, '1', '', '9.39', '6.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 14, 1, 0, '', 'CL420.png', 0, '0', '2019-04-14 03:50:25', '2019-04-14 03:54:37', NULL),
(421, 72, 58, '3', '', '113.96', '107.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL421.png', 0, '0', '2019-04-14 03:51:16', '2019-04-14 03:54:31', NULL),
(422, 72, 58, '3', '', '6.39', '6.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL422_1555197157.png', 0, '0', '2019-04-13 23:12:37', '2019-04-14 04:43:29', NULL),
(423, 72, 58, '3', '', '31.95', '30.00', '0.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 1, 0, 0, 1, 0, '', 'CL423_1555197334.png', 0, '0', '2019-04-13 23:15:34', '2019-04-14 04:47:40', NULL),
(424, 72, 58, '1', '', '34.95', '30.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 6, 87, 14, 1, 0, '', 'CL424_1555197399.png', 0, '0', '2019-04-13 23:16:39', '2019-04-14 04:47:50', NULL),
(425, 72, 58, '1', '', '16.85', '13.00', '3.00', '', '0.00', '6.00', '0.50', '0000-00-00', '', 3, 87, 14, 1, 0, '', 'CL425_1555197764.png', 0, '0', '2019-04-13 23:22:44', '2019-04-14 04:53:09', NULL),
(426, 87, 52, '1', '', '100.42', '91.00', '1.50', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 93, 0, 1, 2, '', 'CL426_1555249449.png', 0, '0', '2019-04-14 13:44:09', NULL, NULL),
(427, 48, 86, '1', '', '43.36', '57.00', '25.00', '60', '40.00', '6.00', '2.00', '0000-00-00', '', 0, 82, 0, 1, 0, '', 'CL427_1555263607.png', 0, '0', '2019-04-14 17:40:07', NULL, NULL),
(428, 41, 86, '2', '03:55 PM', '46.60', '20.00', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 4, 95, 9, 1, 0, '', 'CL428.png', 0, '0', '2019-04-15 10:58:36', '2019-04-15 10:59:10', NULL),
(429, 98, 86, '1', '', '156.22', '121.50', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 94, 0, 1, 0, '', 'CL429_1555308325.png', 0, '0', '2019-04-15 06:05:25', NULL, NULL),
(430, 98, 100, '2', '01:32 PM', '52.18', '48.00', '10.00', '52', '10.00', '6.00', '5.00', '0000-00-00', '', 2, 94, 0, 1, 0, '', 'CL430_1555311746.png', 0, '0', '2019-04-15 07:02:26', NULL, NULL),
(431, 45, 58, '1', '', '572.48', '535.00', '13.35', '52', '10.00', '6.00', '0.50', '0000-00-00', '', 0, 86, 0, 1, 0, '', 'CL431_1555320439.png', 1, '0', '2019-04-15 09:27:19', NULL, NULL),
(432, 98, 86, '1', '', '156.22', '121.50', '25.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 94, 0, 1, 0, '', 'CL432.png', 0, '0', '2019-04-15 14:59:34', NULL, NULL),
(433, 48, 86, '4', '06:14 PM', '21.60', '20.00', '0.00', '', '0.00', '6.00', '2.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL433_1555328646.png', 0, '0', '2019-04-15 11:44:06', NULL, NULL),
(434, 45, 100, '3', '', '46.62', '42.00', '0.00', '', '0.00', '6.00', '5.00', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL434.png', 0, '0', '2019-04-15 17:20:27', NULL, NULL),
(435, 33, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL435.png', 0, '0', '2019-04-15 19:22:32', NULL, NULL),
(436, 33, 52, '3', '', '60.87', '56.00', '0.00', '', '0.00', '6.00', '2.70', '0000-00-00', '', 0, 0, 0, 1, 0, '', 'CL436.png', 0, '0', '2019-04-15 19:23:11', NULL, NULL),
(437, 33, 86, '6', '', '118.80', '110.00', '0.00', '', '0.00', '6.00', '2.00', '2019-04-16', '07:26 PM', 0, 0, 0, 1, 0, '', 'CL437.png', 0, '0', '2019-04-15 19:26:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` varchar(11) NOT NULL,
  `variants_price` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_product_price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `item_price`, `variants_price`, `quantity`, `total_product_price`) VALUES
(117, 86, 32, '100.00', '17.00', 1, '117.00'),
(118, 86, 33, '25.00', '10.00', 2, '70.00'),
(119, 87, 32, '100.00', '5.00', 8, '840.00'),
(120, 88, 32, '100.00', '60.00', 1, '160.00'),
(121, 89, 32, '100.00', '17.00', 1, '117.00'),
(122, 89, 33, '25.00', '10.00', 2, '70.00'),
(123, 90, 32, '100.00', '17.00', 1, '117.00'),
(124, 90, 33, '25.00', '10.00', 2, '70.00'),
(125, 91, 18, '56.00', '0.00', 2, '112.00'),
(126, 91, 19, '89.00', '0.00', 2, '178.00'),
(127, 92, 18, '56.00', '0.00', 3, '168.00'),
(128, 93, 27, '4.00', '19.50', 10, '235.00'),
(129, 94, 18, '56.00', '0.00', 3, '168.00'),
(130, 94, 19, '89.00', '0.00', 4, '356.00'),
(131, 94, 24, '77.00', '0.00', 1, '77.00'),
(132, 95, 18, '56.00', '0.00', 1, '56.00'),
(133, 96, 18, '56.00', '0.00', 1, '56.00'),
(134, 96, 33, '25.00', '10.00', 1, '35.00'),
(135, 97, 32, '100.00', '60.00', 1, '160.00'),
(136, 98, 32, '100.00', '60.00', 2, '320.00'),
(137, 99, 32, '100.00', '17.00', 1, '117.00'),
(138, 99, 33, '25.00', '10.00', 2, '70.00'),
(139, 100, 18, '56.00', '0.00', 1, '56.00'),
(140, 101, 32, '100.00', '12.00', 1, '112.00'),
(141, 102, 32, '100.00', '15.00', 2, '230.00'),
(142, 103, 32, '100.00', '15.00', 2, '230.00'),
(143, 104, 32, '100.00', '15.00', 2, '230.00'),
(144, 105, 32, '100.00', '15.00', 2, '230.00'),
(145, 106, 32, '100.00', '15.00', 2, '230.00'),
(146, 107, 32, '100.00', '15.00', 2, '230.00'),
(147, 108, 32, '100.00', '15.00', 2, '230.00'),
(148, 109, 18, '56.00', '0.00', 2, '112.00'),
(149, 109, 19, '89.00', '0.00', 1, '89.00'),
(150, 110, 27, '4.00', '9.00', 2, '26.00'),
(151, 110, 29, '10.00', '10.00', 3, '60.00'),
(152, 111, 30, '15.00', '0.00', 1, '15.00'),
(153, 112, 29, '10.00', '25.00', 4, '140.00'),
(154, 113, 32, '100.00', '70.00', 8, '1360.00'),
(155, 114, 32, '100.00', '10.00', 13, '1430.00'),
(156, 115, 32, '100.00', '0.00', 6, '600.00'),
(157, 115, 20, '189.00', '0.00', 4, '756.00'),
(158, 116, 32, '100.00', '64.00', 4, '656.00'),
(159, 116, 19, '89.00', '0.00', 60, '5340.00'),
(160, 117, 24, '77.00', '0.00', 1, '77.00'),
(161, 118, 18, '56.00', '0.00', 2, '112.00'),
(162, 119, 32, '100.00', '17.00', 1, '117.00'),
(163, 119, 33, '25.00', '10.00', 2, '70.00'),
(164, 120, 32, '100.00', '17.00', 1, '117.00'),
(165, 120, 33, '25.00', '10.00', 2, '70.00'),
(166, 121, 32, '100.00', '17.00', 1, '117.00'),
(167, 121, 33, '25.00', '10.00', 2, '70.00'),
(168, 122, 32, '100.00', '17.00', 1, '117.00'),
(169, 122, 33, '25.00', '10.00', 2, '70.00'),
(170, 123, 18, '56.00', '0.00', 1, '56.00'),
(171, 124, 18, '56.00', '0.00', 1, '56.00'),
(172, 125, 18, '56.00', '0.00', 1, '56.00'),
(173, 126, 18, '56.00', '0.00', 1, '56.00'),
(174, 127, 18, '56.00', '0.00', 1, '56.00'),
(175, 128, 18, '56.00', '0.00', 1, '56.00'),
(176, 129, 18, '56.00', '0.00', 1, '56.00'),
(177, 130, 18, '56.00', '0.00', 1, '56.00'),
(178, 131, 18, '56.00', '0.00', 1, '56.00'),
(179, 132, 18, '56.00', '0.00', 1, '56.00'),
(180, 133, 18, '56.00', '0.00', 1, '56.00'),
(181, 134, 18, '56.00', '0.00', 1, '56.00'),
(182, 135, 18, '56.00', '0.00', 1, '56.00'),
(183, 136, 18, '56.00', '0.00', 1, '56.00'),
(184, 137, 27, '4.00', '8.00', 1, '12.00'),
(185, 138, 31, '150.00', '20.00', 1, '170.00'),
(186, 139, 18, '56.00', '0.00', 1, '56.00'),
(187, 140, 27, '4.00', '9.00', 1, '13.00'),
(188, 141, 30, '15.00', '0.00', 3, '45.00'),
(189, 141, 27, '4.00', '11.50', 2, '31.00'),
(190, 142, 18, '56.00', '0.00', 1, '56.00'),
(191, 143, 27, '4.00', '6.00', 1, '10.00'),
(192, 144, 27, '4.00', '17.50', 4, '86.00'),
(193, 145, 29, '10.00', '10.00', 4, '80.00'),
(194, 146, 27, '4.00', '10.00', 3, '42.00'),
(195, 147, 27, '4.00', '9.50', 3, '40.50'),
(196, 148, 27, '4.00', '10.00', 2, '28.00'),
(197, 149, 32, '100.00', '17.00', 1, '117.00'),
(198, 149, 33, '25.00', '10.00', 2, '70.00'),
(199, 150, 18, '56.00', '0.00', 1, '56.00'),
(200, 151, 18, '56.00', '0.00', 1, '56.00'),
(201, 152, 18, '56.00', '0.00', 1, '56.00'),
(202, 153, 27, '4.00', '6.00', 1, '10.00'),
(203, 154, 27, '4.00', '9.00', 3, '39.00'),
(204, 155, 27, '4.00', '6.00', 1, '10.00'),
(205, 156, 31, '150.00', '30.00', 1, '180.00'),
(206, 157, 27, '4.00', '6.00', 1, '10.00'),
(207, 158, 18, '56.00', '0.00', 1, '56.00'),
(208, 159, 18, '56.00', '0.00', 1, '56.00'),
(209, 160, 27, '4.00', '9.00', 3, '39.00'),
(210, 161, 18, '56.00', '0.00', 1, '56.00'),
(211, 162, 19, '89.00', '0.00', 1, '89.00'),
(212, 163, 29, '10.00', '15.00', 1, '25.00'),
(213, 164, 29, '10.00', '15.00', 1, '25.00'),
(214, 165, 27, '4.00', '10.50', 1, '14.50'),
(215, 166, 27, '4.00', '11.50', 1, '15.50'),
(216, 167, 27, '4.00', '10.00', 1, '14.00'),
(217, 168, 29, '10.00', '15.00', 1, '25.00'),
(218, 169, 27, '4.00', '11.50', 1, '15.50'),
(219, 170, 27, '4.00', '11.50', 1, '15.50'),
(220, 171, 29, '10.00', '15.00', 1, '25.00'),
(221, 171, 27, '4.00', '9.00', 1, '13.00'),
(222, 172, 30, '15.00', '0.00', 2, '30.00'),
(223, 173, 18, '56.00', '0.00', 2, '112.00'),
(224, 174, 18, '56.00', '0.00', 1, '56.00'),
(225, 174, 19, '89.00', '0.00', 1, '89.00'),
(226, 175, 29, '10.00', '15.00', 1, '25.00'),
(227, 176, 18, '56.00', '0.00', 1, '56.00'),
(228, 176, 24, '77.00', '0.00', 1, '77.00'),
(229, 176, 32, '100.00', '72.00', 1, '172.00'),
(230, 177, 18, '56.00', '0.00', 1, '56.00'),
(231, 178, 19, '89.00', '0.00', 1, '89.00'),
(232, 179, 18, '56.00', '0.00', 1, '56.00'),
(233, 180, 18, '56.00', '0.00', 1, '56.00'),
(234, 181, 18, '56.00', '0.00', 1, '56.00'),
(235, 182, 18, '56.00', '0.00', 1, '56.00'),
(236, 183, 18, '56.00', '0.00', 1, '56.00'),
(237, 184, 30, '15.00', '0.00', 3, '45.00'),
(238, 185, 30, '15.00', '0.00', 3, '45.00'),
(239, 186, 20, '189.00', '0.00', 1, '189.00'),
(240, 187, 23, '77.00', '0.00', 1, '77.00'),
(241, 188, 18, '56.00', '0.00', 1, '56.00'),
(242, 189, 27, '4.00', '11.50', 1, '15.50'),
(243, 190, 18, '56.00', '0.00', 1, '56.00'),
(244, 191, 32, '100.00', '17.00', 1, '117.00'),
(245, 191, 33, '25.00', '10.00', 2, '70.00'),
(246, 192, 32, '100.00', '17.00', 1, '117.00'),
(247, 192, 33, '25.00', '10.00', 2, '70.00'),
(248, 193, 32, '100.00', '17.00', 1, '117.00'),
(249, 193, 33, '25.00', '10.00', 2, '70.00'),
(250, 194, 32, '100.00', '17.00', 1, '117.00'),
(251, 194, 33, '25.00', '10.00', 2, '70.00'),
(252, 195, 32, '100.00', '17.00', 1, '117.00'),
(253, 195, 33, '25.00', '10.00', 2, '70.00'),
(254, 196, 32, '100.00', '17.00', 1, '117.00'),
(255, 196, 33, '25.00', '10.00', 2, '70.00'),
(256, 197, 18, '56.00', '0.00', 1, '56.00'),
(257, 198, 18, '56.00', '0.00', 1, '56.00'),
(258, 199, 18, '56.00', '10.00', 3, '198.00'),
(259, 200, 27, '4.00', '8.00', 1, '12.00'),
(260, 201, 27, '4.00', '11.00', 1, '15.00'),
(261, 202, 32, '100.00', '15.00', 1, '115.00'),
(262, 202, 33, '25.00', '10.00', 2, '70.00'),
(263, 203, 32, '100.00', '15.00', 1, '115.00'),
(264, 203, 33, '25.00', '10.00', 2, '70.00'),
(265, 204, 27, '4.00', '9.00', 1, '13.00'),
(266, 205, 18, '56.00', '0.00', 1, '56.00'),
(267, 206, 18, '56.00', '0.00', 1, '56.00'),
(268, 207, 32, '100.00', '15.00', 1, '115.00'),
(269, 207, 33, '25.00', '10.00', 2, '70.00'),
(270, 208, 18, '56.00', '0.00', 1, '56.00'),
(271, 209, 18, '56.00', '0.00', 1, '56.00'),
(272, 210, 18, '56.00', '0.00', 1, '56.00'),
(273, 211, 18, '56.00', '0.00', 1, '56.00'),
(274, 212, 18, '56.00', '0.00', 1, '56.00'),
(275, 213, 18, '56.00', '0.00', 1, '56.00'),
(276, 214, 18, '56.00', '0.00', 1, '56.00'),
(277, 215, 18, '56.00', '0.00', 1, '56.00'),
(278, 216, 18, '56.00', '0.00', 3, '168.00'),
(279, 217, 18, '56.00', '0.00', 1, '56.00'),
(280, 218, 18, '56.00', '0.00', 1, '56.00'),
(281, 219, 19, '89.00', '0.00', 1, '89.00'),
(282, 220, 18, '56.00', '0.00', 1, '56.00'),
(283, 221, 20, '189.00', '0.00', 1, '189.00'),
(284, 222, 18, '56.00', '0.00', 1, '56.00'),
(285, 223, 18, '56.00', '0.00', 1, '56.00'),
(286, 224, 32, '100.00', '15.00', 1, '115.00'),
(287, 224, 33, '25.00', '10.00', 2, '70.00'),
(288, 225, 18, '56.00', '0.00', 1, '56.00'),
(289, 226, 27, '4.00', '10.00', 1, '14.00'),
(290, 226, 27, '4.00', '6.00', 1, '10.00'),
(291, 226, 28, '2.00', '20.00', 1, '22.00'),
(292, 227, 27, '4.00', '9.00', 1, '13.00'),
(293, 228, 27, '4.00', '9.00', 1, '13.00'),
(294, 229, 29, '10.00', '25.00', 1, '35.00'),
(295, 230, 30, '15.00', '0.00', 2, '30.00'),
(296, 231, 18, '56.00', '22.00', 1, '78.00'),
(297, 232, 27, '4.00', '8.00', 1, '12.00'),
(298, 233, 18, '56.00', '7.00', 1, '63.00'),
(299, 234, 27, '4.00', '9.00', 5, '65.00'),
(300, 234, 29, '10.00', '10.00', 7, '140.00'),
(301, 235, 27, '4.00', '10.00', 1, '14.00'),
(302, 236, 27, '4.00', '9.00', 1, '13.00'),
(303, 237, 18, '56.00', '0.00', 1, '56.00'),
(304, 238, 18, '56.00', '0.00', 1, '56.00'),
(305, 239, 18, '56.00', '0.00', 1, '56.00'),
(306, 240, 18, '56.00', '0.00', 1, '56.00'),
(307, 241, 18, '56.00', '0.00', 1, '56.00'),
(308, 242, 18, '56.00', '0.00', 1, '56.00'),
(309, 243, 18, '56.00', '0.00', 1, '56.00'),
(310, 244, 32, '100.00', '15.00', 1, '115.00'),
(311, 244, 33, '25.00', '10.00', 2, '70.00'),
(312, 245, 19, '89.00', '0.00', 1, '89.00'),
(313, 246, 28, '2.00', '20.00', 2, '44.00'),
(314, 247, 32, '100.00', '15.00', 1, '115.00'),
(315, 247, 33, '25.00', '10.00', 2, '70.00'),
(316, 248, 28, '2.00', '20.00', 2, '44.00'),
(317, 249, 32, '100.00', '15.00', 1, '115.00'),
(318, 249, 33, '25.00', '10.00', 2, '70.00'),
(319, 250, 32, '100.00', '15.00', 1, '115.00'),
(320, 250, 33, '25.00', '10.00', 2, '70.00'),
(321, 251, 32, '100.00', '15.00', 1, '115.00'),
(322, 251, 33, '25.00', '10.00', 2, '70.00'),
(323, 252, 32, '100.00', '15.00', 1, '115.00'),
(324, 252, 33, '25.00', '10.00', 2, '70.00'),
(325, 253, 32, '100.00', '15.00', 1, '115.00'),
(326, 253, 33, '25.00', '10.00', 2, '70.00'),
(327, 254, 27, '4.00', '10.00', 9, '126.00'),
(328, 255, 32, '100.00', '15.00', 1, '115.00'),
(329, 255, 33, '25.00', '10.00', 2, '70.00'),
(330, 256, 32, '100.00', '15.00', 1, '115.00'),
(331, 256, 33, '25.00', '10.00', 2, '70.00'),
(332, 257, 32, '100.00', '15.00', 1, '115.00'),
(333, 257, 33, '25.00', '10.00', 2, '70.00'),
(334, 258, 32, '100.00', '15.00', 1, '115.00'),
(335, 258, 33, '25.00', '10.00', 2, '70.00'),
(336, 259, 32, '100.00', '15.00', 1, '115.00'),
(337, 259, 33, '25.00', '10.00', 2, '70.00'),
(338, 260, 32, '100.00', '15.00', 1, '115.00'),
(339, 260, 33, '25.00', '10.00', 2, '70.00'),
(340, 261, 32, '100.00', '15.00', 1, '115.00'),
(341, 261, 33, '25.00', '10.00', 2, '70.00'),
(342, 262, 32, '100.00', '15.00', 1, '115.00'),
(343, 262, 33, '25.00', '10.00', 2, '70.00'),
(344, 263, 32, '100.00', '15.00', 1, '115.00'),
(345, 263, 33, '25.00', '10.00', 2, '70.00'),
(346, 264, 32, '100.00', '15.00', 1, '115.00'),
(347, 264, 33, '25.00', '10.00', 2, '70.00'),
(348, 265, 32, '100.00', '15.00', 1, '115.00'),
(349, 265, 33, '25.00', '10.00', 2, '70.00'),
(350, 266, 32, '100.00', '15.00', 1, '115.00'),
(351, 266, 33, '25.00', '10.00', 2, '70.00'),
(352, 267, 32, '100.00', '15.00', 1, '115.00'),
(353, 267, 33, '25.00', '10.00', 2, '70.00'),
(354, 268, 32, '100.00', '15.00', 1, '115.00'),
(355, 268, 33, '25.00', '10.00', 2, '70.00'),
(356, 269, 32, '100.00', '15.00', 1, '115.00'),
(357, 269, 33, '25.00', '10.00', 2, '70.00'),
(358, 270, 32, '100.00', '15.00', 1, '115.00'),
(359, 270, 33, '25.00', '10.00', 2, '70.00'),
(360, 271, 27, '4.00', '9.00', 10, '130.00'),
(361, 272, 18, '56.00', '0.00', 1, '56.00'),
(362, 273, 27, '4.00', '9.00', 1, '13.00'),
(363, 274, 27, '4.00', '6.00', 2, '20.00'),
(364, 275, 36, '5.00', '10.00', 1, '15.00'),
(365, 276, 36, '5.00', '10.00', 1, '15.00'),
(366, 276, 27, '4.00', '11.00', 1, '15.00'),
(367, 277, 18, '56.00', '0.00', 1, '56.00'),
(368, 278, 18, '56.00', '0.00', 1, '56.00'),
(369, 279, 27, '4.00', '10.00', 1, '14.00'),
(370, 279, 37, '99.00', '8.00', 1, '107.00'),
(371, 280, 42, '100.00', '10.00', 1, '110.00'),
(372, 281, 42, '100.00', '10.00', 2, '220.00'),
(373, 282, 42, '100.00', '10.00', 1, '110.00'),
(374, 282, 43, '10.00', '1.00', 1, '11.00'),
(375, 283, 32, '100.00', '60.00', 1, '160.00'),
(376, 284, 42, '100.00', '10.00', 2, '220.00'),
(377, 284, 43, '10.00', '1.00', 2, '22.00'),
(378, 285, 43, '10.00', '1.00', 5, '55.00'),
(379, 286, 43, '10.00', '1.00', 4, '44.00'),
(380, 286, 42, '100.00', '10.00', 2, '220.00'),
(381, 286, 44, '10.00', '20.00', 4, '120.00'),
(382, 287, 44, '10.00', '20.00', 2, '60.00'),
(383, 288, 20, '189.00', '10.80', 2, '399.60'),
(384, 289, 18, '56.00', '0.00', 1, '56.00'),
(385, 290, 18, '56.00', '0.00', 2, '112.00'),
(386, 290, 20, '189.00', '10.80', 3, '599.40'),
(387, 290, 32, '100.00', '0.00', 3, '300.00'),
(388, 291, 32, '100.00', '0.00', 3, '300.00'),
(389, 292, 20, '189.00', '10.80', 2, '399.60'),
(390, 293, 18, '56.00', '0.00', 1, '56.00'),
(391, 294, 18, '56.00', '0.00', 1, '56.00'),
(392, 295, 32, '100.00', '0.00', 2, '200.00'),
(393, 296, 18, '56.00', '0.00', 4, '224.00'),
(394, 297, 18, '56.00', '0.00', 2, '112.00'),
(395, 298, 18, '56.00', '0.00', 1, '56.00'),
(396, 299, 39, '5.00', '0.00', 1, '5.00'),
(397, 300, 18, '56.00', '0.00', 1, '56.00'),
(398, 300, 19, '89.00', '0.00', 1, '89.00'),
(399, 301, 18, '56.00', '0.00', 1, '56.00'),
(400, 302, 39, '5.00', '0.00', 1, '5.00'),
(401, 303, 27, '4.00', '16.50', 1, '20.50'),
(402, 304, 32, '100.00', '0.00', 1, '100.00'),
(403, 305, 20, '189.00', '5.00', 1, '194.00'),
(404, 306, 20, '189.00', '10.80', 1, '199.80'),
(405, 307, 32, '100.00', '0.00', 1, '100.00'),
(406, 308, 32, '100.00', '62.00', 1, '162.00'),
(407, 309, 32, '100.00', '76.00', 1, '176.00'),
(408, 310, 32, '100.00', '0.00', 2, '200.00'),
(409, 311, 32, '100.00', '0.00', 1, '100.00'),
(410, 311, 32, '100.00', '67.00', 2, '334.00'),
(411, 312, 32, '100.00', '67.00', 1, '167.00'),
(412, 313, 32, '100.00', '62.00', 1, '162.00'),
(413, 314, 32, '100.00', '62.00', 1, '162.00'),
(414, 315, 32, '100.00', '12.00', 1, '112.00'),
(415, 316, 32, '100.00', '0.00', 1, '100.00'),
(416, 317, 32, '100.00', '62.00', 1, '162.00'),
(417, 318, 32, '100.00', '7.00', 1, '107.00'),
(418, 318, 32, '100.00', '67.00', 1, '167.00'),
(419, 319, 32, '100.00', '62.00', 1, '162.00'),
(420, 319, 32, '100.00', '7.00', 1, '107.00'),
(421, 320, 32, '100.00', '62.00', 1, '162.00'),
(422, 320, 32, '100.00', '7.00', 1, '107.00'),
(423, 321, 32, '100.00', '0.00', 1, '100.00'),
(424, 322, 32, '100.00', '0.00', 1, '100.00'),
(425, 323, 43, '10.00', '1.00', 2, '22.00'),
(426, 323, 44, '10.00', '20.00', 1, '30.00'),
(427, 324, 44, '10.00', '20.00', 2, '60.00'),
(428, 325, 43, '10.00', '1.00', 1, '11.00'),
(429, 326, 46, '50.00', '0.00', 3, '150.00'),
(430, 327, 48, '50.00', '0.00', 1, '50.00'),
(431, 328, 27, '4.00', '11.50', 1, '15.50'),
(432, 329, 32, '100.00', '62.00', 1, '162.00'),
(433, 330, 32, '100.00', '0.00', 1, '100.00'),
(434, 331, 48, '50.00', '0.00', 10, '500.00'),
(435, 332, 32, '100.00', '0.00', 1, '100.00'),
(436, 332, 32, '100.00', '62.00', 1, '162.00'),
(437, 333, 32, '100.00', '0.00', 1, '100.00'),
(438, 333, 32, '100.00', '62.00', 1, '162.00'),
(439, 334, 44, '10.00', '20.00', 2, '60.00'),
(440, 334, 44, '10.00', '10.00', 2, '40.00'),
(441, 335, 24, '77.00', '0.00', 1, '77.00'),
(442, 335, 32, '100.00', '0.00', 2, '200.00'),
(443, 335, 32, '100.00', '72.00', 1, '172.00'),
(444, 335, 32, '100.00', '18.00', 1, '118.00'),
(445, 336, 32, '100.00', '57.00', 1, '157.00'),
(446, 336, 33, '25.00', '0.00', 2, '50.00'),
(447, 337, 18, '56.00', '0.00', 1, '56.00'),
(448, 338, 46, '50.00', '0.00', 1, '50.00'),
(449, 339, 18, '56.00', '0.00', 1, '56.00'),
(450, 340, 32, '100.00', '50.00', 1, '150.00'),
(451, 341, 36, '5.00', '0.00', 1, '5.00'),
(452, 342, 32, '100.00', '0.00', 1, '100.00'),
(453, 342, 32, '100.00', '62.00', 2, '324.00'),
(454, 343, 32, '100.00', '0.00', 1, '100.00'),
(455, 343, 32, '100.00', '62.00', 2, '324.00'),
(456, 344, 32, '100.00', '0.00', 1, '100.00'),
(457, 344, 32, '100.00', '62.00', 2, '324.00'),
(458, 345, 32, '100.00', '0.00', 1, '100.00'),
(459, 345, 32, '100.00', '62.00', 2, '324.00'),
(460, 346, 32, '100.00', '0.00', 1, '100.00'),
(461, 346, 32, '100.00', '62.00', 2, '324.00'),
(462, 347, 18, '56.00', '0.00', 1, '56.00'),
(463, 348, 27, '4.00', '6.00', 1, '10.00'),
(464, 349, 42, '100.00', '10.00', 1, '110.00'),
(465, 350, 42, '100.00', '10.00', 1, '110.00'),
(466, 351, 42, '100.00', '10.00', 1, '110.00'),
(467, 352, 32, '100.00', '0.00', 1, '100.00'),
(468, 352, 32, '100.00', '62.00', 2, '324.00'),
(469, 353, 42, '100.00', '10.00', 1, '110.00'),
(470, 354, 18, '56.00', '0.00', 1, '56.00'),
(471, 355, 36, '5.00', '0.00', 1, '5.00'),
(472, 356, 27, '4.00', '6.00', 2, '20.00'),
(473, 356, 36, '5.00', '0.00', 1, '5.00'),
(474, 356, 37, '99.00', '8.00', 1, '107.00'),
(475, 356, 38, '6.00', '0.00', 1, '6.00'),
(476, 356, 39, '5.00', '0.00', 1, '5.00'),
(477, 356, 40, '5.00', '0.00', 1, '5.00'),
(478, 356, 41, '20.00', '10.00', 1, '30.00'),
(479, 357, 44, '10.00', '10.00', 1, '20.00'),
(480, 358, 43, '10.00', '0.00', 1, '10.00'),
(481, 359, 44, '10.00', '20.00', 1, '30.00'),
(482, 360, 18, '56.00', '0.00', 1, '56.00'),
(483, 361, 42, '100.00', '10.00', 1, '110.00'),
(484, 362, 42, '100.00', '10.00', 1, '110.00'),
(485, 363, 42, '100.00', '10.00', 1, '110.00'),
(486, 364, 27, '4.00', '9.00', 17, '221.00'),
(487, 364, 36, '5.00', '0.00', 1, '5.00'),
(488, 365, 42, '100.00', '10.00', 2, '220.00'),
(489, 366, 42, '100.00', '10.00', 1, '110.00'),
(490, 367, 27, '4.00', '9.00', 3, '39.00'),
(491, 367, 36, '5.00', '0.00', 2, '10.00'),
(492, 367, 39, '5.00', '0.00', 22, '110.00'),
(493, 368, 42, '100.00', '10.00', 2, '220.00'),
(494, 369, 42, '100.00', '10.00', 2, '220.00'),
(495, 370, 42, '100.00', '10.00', 3, '330.00'),
(496, 371, 42, '100.00', '10.00', 3, '330.00'),
(497, 372, 37, '99.00', '8.00', 2, '214.00'),
(498, 372, 38, '6.00', '0.00', 2, '12.00'),
(499, 373, 37, '99.00', '8.00', 1, '107.00'),
(500, 374, 39, '5.00', '0.00', 1, '5.00'),
(501, 375, 41, '20.00', '0.00', 1, '20.00'),
(502, 376, 37, '99.00', '8.00', 1, '107.00'),
(503, 377, 18, '56.00', '10.00', 1, '66.00'),
(504, 378, 18, '56.00', '15.00', 1, '71.00'),
(505, 379, 18, '56.00', '15.00', 1, '71.00'),
(506, 380, 18, '56.00', '0.00', 1, '56.00'),
(507, 381, 42, '100.00', '10.00', 1, '110.00'),
(508, 382, 42, '100.00', '10.00', 1, '110.00'),
(509, 383, 42, '100.00', '10.00', 1, '110.00'),
(510, 384, 42, '100.00', '10.00', 1, '110.00'),
(511, 385, 42, '100.00', '10.00', 1, '110.00'),
(512, 386, 37, '99.00', '8.00', 1, '107.00'),
(513, 387, 32, '100.00', '0.00', 1, '100.00'),
(514, 387, 32, '100.00', '62.00', 2, '324.00'),
(515, 388, 56, '12.50', '0.00', 2, '25.00'),
(516, 388, 42, '100.00', '10.00', 1, '110.00'),
(517, 389, 18, '56.00', '10.00', 1, '66.00'),
(518, 390, 37, '99.00', '8.00', 1, '107.00'),
(519, 391, 42, '100.00', '10.00', 1, '110.00'),
(520, 392, 55, '119.00', '2.50', 2, '243.00'),
(521, 392, 44, '10.00', '20.00', 1, '30.00'),
(522, 393, 54, '32.00', '7.00', 14, '546.00'),
(523, 394, 55, '119.00', '2.50', 3, '364.50'),
(524, 395, 18, '56.00', '0.00', 1, '56.00'),
(525, 396, 19, '89.00', '0.00', 1, '89.00'),
(526, 397, 38, '6.00', '0.00', 1, '6.00'),
(527, 398, 33, '25.00', '10.00', 1, '35.00'),
(528, 399, 44, '10.00', '10.00', 1, '20.00'),
(529, 400, 19, '89.00', '0.00', 1, '89.00'),
(530, 401, 55, '119.00', '2.50', 1, '121.50'),
(531, 402, 43, '10.00', '0.00', 1, '10.00'),
(532, 403, 32, '100.00', '0.00', 1, '100.00'),
(533, 403, 32, '100.00', '62.00', 2, '324.00'),
(534, 404, 54, '32.00', '7.00', 1, '39.00'),
(535, 405, 56, '12.50', '0.00', 1, '12.50'),
(536, 406, 43, '10.00', '0.00', 1, '10.00'),
(537, 406, 44, '10.00', '10.00', 1, '20.00'),
(538, 407, 56, '12.50', '0.00', 1, '12.50'),
(539, 408, 18, '56.00', '0.00', 1, '56.00'),
(540, 409, 18, '56.00', '0.00', 1, '56.00'),
(541, 410, 37, '99.00', '8.00', 1, '107.00'),
(542, 411, 39, '5.00', '0.00', 1, '5.00'),
(543, 412, 62, '12.00', '3.00', 1, '15.00'),
(544, 413, 62, '12.00', '3.00', 1, '15.00'),
(545, 414, 46, '50.00', '0.00', 1, '50.00'),
(546, 415, 43, '10.00', '0.00', 1, '10.00'),
(547, 415, 44, '10.00', '0.00', 1, '10.00'),
(548, 416, 43, '10.00', '0.00', 1, '10.00'),
(549, 416, 44, '10.00', '0.00', 1, '10.00'),
(550, 417, 38, '6.00', '0.00', 1, '6.00'),
(551, 418, 41, '20.00', '10.00', 1, '30.00'),
(552, 419, 38, '6.00', '0.00', 1, '6.00'),
(553, 420, 38, '6.00', '0.00', 1, '6.00'),
(554, 421, 37, '99.00', '8.00', 1, '107.00'),
(555, 422, 38, '6.00', '0.00', 1, '6.00'),
(556, 423, 41, '20.00', '10.00', 1, '30.00'),
(557, 424, 41, '20.00', '10.00', 1, '30.00'),
(558, 425, 62, '12.00', '1.00', 1, '13.00'),
(559, 426, 19, '89.00', '2.00', 1, '91.00'),
(560, 427, 54, '32.00', '5.00', 1, '37.00'),
(561, 427, 44, '10.00', '10.00', 1, '20.00'),
(562, 428, 63, '20.00', '0.00', 1, '20.00'),
(563, 429, 55, '119.00', '2.50', 1, '121.50'),
(564, 430, 61, '22.00', '0.00', 1, '22.00'),
(565, 430, 58, '12.00', '0.00', 1, '12.00'),
(566, 430, 58, '12.00', '2.00', 1, '14.00'),
(567, 431, 37, '99.00', '8.00', 5, '535.00'),
(568, 432, 55, '119.00', '2.50', 1, '121.50'),
(569, 433, 63, '20.00', '0.00', 1, '20.00'),
(570, 434, 57, '14.00', '1.00', 1, '15.00'),
(571, 434, 60, '7.00', '0.00', 1, '7.00'),
(572, 434, 59, '6.00', '0.00', 1, '6.00'),
(573, 434, 58, '12.00', '2.00', 1, '14.00'),
(574, 435, 18, '56.00', '0.00', 1, '56.00'),
(575, 436, 18, '56.00', '0.00', 1, '56.00'),
(576, 437, 42, '100.00', '10.00', 1, '110.00');

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
(336, 117, 21, 86, '5.00'),
(337, 117, 22, 91, '0.00'),
(338, 117, 23, 92, '10.00'),
(339, 117, 23, 101, '2.00'),
(340, 118, 22, 102, '10.00'),
(341, 119, 21, 85, '0.00'),
(342, 119, 21, 86, '5.00'),
(343, 119, 22, 91, '0.00'),
(344, 120, 21, 87, '10.00'),
(345, 120, 22, 90, '50.00'),
(346, 121, 21, 86, '5.00'),
(347, 121, 22, 91, '0.00'),
(348, 121, 23, 92, '10.00'),
(349, 121, 23, 101, '2.00'),
(350, 122, 22, 102, '10.00'),
(351, 123, 21, 86, '5.00'),
(352, 123, 22, 91, '0.00'),
(353, 123, 23, 92, '10.00'),
(354, 123, 23, 101, '2.00'),
(355, 124, 22, 102, '10.00'),
(356, 128, 12, 66, '2.00'),
(357, 128, 16, 69, '6.00'),
(358, 128, 16, 70, '6.50'),
(359, 128, 19, 67, '2.00'),
(360, 128, 19, 68, '3.00'),
(361, 128, 20, 72, '0.00'),
(362, 134, 22, 102, '10.00'),
(363, 135, 21, 87, '10.00'),
(364, 135, 22, 90, '50.00'),
(365, 136, 21, 87, '10.00'),
(366, 136, 22, 90, '50.00'),
(367, 137, 21, 86, '5.00'),
(368, 137, 22, 91, '0.00'),
(369, 137, 23, 92, '10.00'),
(370, 137, 23, 101, '2.00'),
(371, 138, 22, 102, '10.00'),
(372, 140, 21, 87, '10.00'),
(373, 140, 22, 91, '0.00'),
(374, 140, 23, 98, '2.00'),
(375, 141, 21, 86, '5.00'),
(376, 141, 22, 91, '0.00'),
(377, 141, 23, 92, '10.00'),
(378, 142, 21, 86, '5.00'),
(379, 142, 22, 91, '0.00'),
(380, 142, 23, 92, '10.00'),
(381, 143, 21, 86, '5.00'),
(382, 143, 22, 91, '0.00'),
(383, 143, 23, 92, '10.00'),
(384, 144, 21, 86, '5.00'),
(385, 144, 22, 91, '0.00'),
(386, 144, 23, 92, '10.00'),
(387, 145, 21, 86, '5.00'),
(388, 145, 22, 91, '0.00'),
(389, 145, 23, 92, '10.00'),
(390, 146, 21, 86, '5.00'),
(391, 146, 22, 91, '0.00'),
(392, 146, 23, 92, '10.00'),
(393, 147, 21, 86, '5.00'),
(394, 147, 22, 91, '0.00'),
(395, 147, 23, 92, '10.00'),
(396, 150, 12, 64, '1.00'),
(397, 150, 16, 69, '6.00'),
(398, 150, 19, 67, '2.00'),
(399, 150, 20, 71, '0.00'),
(400, 151, 13, 42, '10.00'),
(401, 153, 13, 42, '10.00'),
(402, 153, 13, 43, '15.00'),
(403, 154, 21, 87, '10.00'),
(404, 154, 22, 90, '50.00'),
(405, 154, 23, 92, '10.00'),
(406, 155, 21, 85, '0.00'),
(407, 155, 22, 91, '0.00'),
(408, 155, 23, 92, '10.00'),
(409, 156, 21, 85, '0.00'),
(410, 156, 22, 91, '0.00'),
(411, 158, 21, 87, '10.00'),
(412, 158, 22, 90, '50.00'),
(413, 158, 23, 94, '2.00'),
(414, 158, 23, 101, '2.00'),
(415, 162, 21, 86, '5.00'),
(416, 162, 22, 91, '0.00'),
(417, 162, 23, 92, '10.00'),
(418, 162, 23, 101, '2.00'),
(419, 163, 22, 102, '10.00'),
(420, 164, 21, 86, '5.00'),
(421, 164, 22, 91, '0.00'),
(422, 164, 23, 92, '10.00'),
(423, 164, 23, 101, '2.00'),
(424, 165, 22, 102, '10.00'),
(425, 166, 21, 86, '5.00'),
(426, 166, 22, 91, '0.00'),
(427, 166, 23, 92, '10.00'),
(428, 166, 23, 101, '2.00'),
(429, 167, 22, 102, '10.00'),
(430, 168, 21, 86, '5.00'),
(431, 168, 22, 91, '0.00'),
(432, 168, 23, 92, '10.00'),
(433, 168, 23, 101, '2.00'),
(434, 169, 22, 102, '10.00'),
(435, 184, 16, 69, '6.00'),
(436, 184, 19, 67, '2.00'),
(437, 184, 20, 72, '0.00'),
(438, 185, 17, 45, '10.00'),
(439, 185, 18, 47, '10.00'),
(440, 187, 12, 64, '1.00'),
(441, 187, 16, 69, '6.00'),
(442, 187, 19, 67, '2.00'),
(443, 187, 20, 71, '0.00'),
(444, 189, 12, 66, '2.00'),
(445, 189, 16, 70, '6.50'),
(446, 189, 19, 68, '3.00'),
(447, 189, 20, 72, '0.00'),
(448, 191, 16, 69, '6.00'),
(449, 191, 20, 71, '0.00'),
(450, 192, 12, 65, '2.00'),
(451, 192, 16, 69, '6.00'),
(452, 192, 16, 70, '6.50'),
(453, 192, 19, 68, '3.00'),
(454, 192, 20, 72, '0.00'),
(455, 193, 13, 42, '10.00'),
(456, 194, 12, 65, '2.00'),
(457, 194, 16, 69, '6.00'),
(458, 194, 19, 67, '2.00'),
(459, 194, 20, 71, '0.00'),
(460, 195, 12, 64, '1.00'),
(461, 195, 16, 70, '6.50'),
(462, 195, 19, 67, '2.00'),
(463, 195, 20, 71, '0.00'),
(464, 196, 12, 65, '2.00'),
(465, 196, 16, 69, '6.00'),
(466, 196, 19, 67, '2.00'),
(467, 196, 20, 71, '0.00'),
(468, 197, 21, 86, '5.00'),
(469, 197, 22, 91, '0.00'),
(470, 197, 23, 92, '10.00'),
(471, 197, 23, 101, '2.00'),
(472, 198, 22, 102, '10.00'),
(473, 202, 16, 69, '6.00'),
(474, 202, 20, 71, '0.00'),
(475, 203, 12, 64, '1.00'),
(476, 203, 16, 69, '6.00'),
(477, 203, 19, 67, '2.00'),
(478, 203, 20, 71, '0.00'),
(479, 204, 16, 69, '6.00'),
(480, 204, 20, 71, '0.00'),
(481, 205, 17, 45, '10.00'),
(482, 205, 18, 48, '20.00'),
(483, 206, 16, 69, '6.00'),
(484, 206, 20, 71, '0.00'),
(485, 209, 12, 64, '1.00'),
(486, 209, 16, 69, '6.00'),
(487, 209, 19, 67, '2.00'),
(488, 209, 20, 71, '0.00'),
(489, 212, 13, 43, '15.00'),
(490, 213, 13, 43, '15.00'),
(491, 214, 12, 65, '2.00'),
(492, 214, 16, 70, '6.50'),
(493, 214, 19, 67, '2.00'),
(494, 214, 20, 71, '0.00'),
(495, 215, 12, 66, '2.00'),
(496, 215, 16, 70, '6.50'),
(497, 215, 19, 68, '3.00'),
(498, 215, 20, 71, '0.00'),
(499, 216, 12, 65, '2.00'),
(500, 216, 16, 69, '6.00'),
(501, 216, 19, 67, '2.00'),
(502, 216, 20, 71, '0.00'),
(503, 217, 13, 43, '15.00'),
(504, 218, 12, 65, '2.00'),
(505, 218, 16, 70, '6.50'),
(506, 218, 19, 68, '3.00'),
(507, 218, 20, 71, '0.00'),
(508, 219, 12, 65, '2.00'),
(509, 219, 16, 70, '6.50'),
(510, 219, 19, 68, '3.00'),
(511, 219, 20, 71, '0.00'),
(512, 220, 13, 43, '15.00'),
(513, 221, 12, 64, '1.00'),
(514, 221, 16, 69, '6.00'),
(515, 221, 19, 67, '2.00'),
(516, 221, 20, 71, '0.00'),
(517, 226, 13, 43, '15.00'),
(518, 229, 21, 87, '10.00'),
(519, 229, 22, 90, '50.00'),
(520, 229, 23, 93, '2.00'),
(521, 229, 23, 95, '2.00'),
(522, 229, 23, 96, '2.00'),
(523, 229, 23, 97, '2.00'),
(524, 229, 23, 98, '2.00'),
(525, 229, 23, 99, '2.00'),
(526, 242, 12, 65, '2.00'),
(527, 242, 16, 70, '6.50'),
(528, 242, 19, 68, '3.00'),
(529, 242, 20, 72, '0.00'),
(530, 244, 21, 86, '5.00'),
(531, 244, 22, 91, '0.00'),
(532, 244, 23, 92, '10.00'),
(533, 244, 23, 101, '2.00'),
(534, 245, 22, 102, '10.00'),
(535, 246, 21, 86, '5.00'),
(536, 246, 22, 91, '0.00'),
(537, 246, 23, 92, '10.00'),
(538, 246, 23, 101, '2.00'),
(539, 247, 22, 102, '10.00'),
(540, 248, 21, 86, '5.00'),
(541, 248, 22, 91, '0.00'),
(542, 248, 23, 92, '10.00'),
(543, 248, 23, 101, '2.00'),
(544, 249, 22, 102, '10.00'),
(545, 250, 21, 86, '5.00'),
(546, 250, 22, 91, '0.00'),
(547, 250, 23, 92, '10.00'),
(548, 250, 23, 101, '2.00'),
(549, 251, 22, 102, '10.00'),
(550, 252, 21, 86, '5.00'),
(551, 252, 22, 91, '0.00'),
(552, 252, 23, 92, '10.00'),
(553, 252, 23, 101, '2.00'),
(554, 253, 22, 102, '10.00'),
(555, 254, 21, 86, '5.00'),
(556, 254, 22, 91, '0.00'),
(557, 254, 23, 92, '10.00'),
(559, 255, 22, 102, '10.00'),
(560, 258, 7, 18, '10.00'),
(561, 259, 12, 65, '2.00'),
(562, 259, 16, 69, '6.00'),
(563, 259, 20, 71, '0.00'),
(564, 260, 12, 65, '2.00'),
(565, 260, 16, 69, '6.00'),
(566, 260, 19, 68, '3.00'),
(567, 260, 20, 72, '0.00'),
(568, 261, 21, 86, '5.00'),
(569, 261, 22, 91, '0.00'),
(570, 261, 23, 92, '10.00'),
(571, 262, 22, 102, '10.00'),
(572, 263, 21, 86, '5.00'),
(573, 263, 22, 91, '0.00'),
(574, 263, 23, 92, '10.00'),
(575, 264, 22, 102, '10.00'),
(576, 265, 12, 64, '1.00'),
(577, 265, 16, 69, '6.00'),
(578, 265, 19, 67, '2.00'),
(579, 265, 20, 72, '0.00'),
(580, 268, 21, 86, '5.00'),
(581, 268, 22, 91, '0.00'),
(582, 268, 23, 92, '10.00'),
(583, 269, 22, 102, '10.00'),
(584, 286, 21, 86, '5.00'),
(585, 286, 22, 91, '0.00'),
(586, 286, 23, 92, '10.00'),
(587, 287, 22, 102, '10.00'),
(588, 289, 12, 66, '2.00'),
(589, 289, 16, 69, '6.00'),
(590, 289, 19, 67, '2.00'),
(591, 289, 20, 71, '0.00'),
(592, 290, 16, 69, '6.00'),
(593, 290, 20, 71, '0.00'),
(594, 291, 16, 104, '20.00'),
(595, 292, 12, 64, '1.00'),
(596, 292, 16, 69, '6.00'),
(597, 292, 19, 67, '2.00'),
(598, 292, 20, 71, '0.00'),
(599, 293, 12, 64, '1.00'),
(600, 293, 16, 69, '6.00'),
(601, 293, 19, 67, '2.00'),
(602, 293, 20, 71, '0.00'),
(603, 294, 13, 42, '10.00'),
(604, 294, 13, 43, '15.00'),
(605, 296, 7, 19, '7.00'),
(606, 296, 7, 20, '15.00'),
(607, 297, 12, 65, '2.00'),
(608, 297, 16, 69, '6.00'),
(609, 297, 20, 71, '0.00'),
(610, 298, 7, 19, '7.00'),
(611, 299, 12, 64, '1.00'),
(612, 299, 16, 69, '6.00'),
(613, 299, 19, 67, '2.00'),
(614, 299, 20, 71, '0.00'),
(615, 300, 13, 42, '10.00'),
(616, 301, 12, 65, '2.00'),
(617, 301, 16, 69, '6.00'),
(618, 301, 19, 67, '2.00'),
(619, 301, 20, 71, '0.00'),
(620, 302, 12, 64, '1.00'),
(621, 302, 16, 69, '6.00'),
(622, 302, 19, 67, '2.00'),
(623, 302, 20, 71, '0.00'),
(624, 310, 21, 86, '5.00'),
(625, 310, 22, 91, '0.00'),
(626, 310, 23, 92, '10.00'),
(627, 311, 22, 102, '10.00'),
(628, 313, 16, 104, '20.00'),
(629, 314, 21, 86, '5.00'),
(630, 314, 22, 91, '0.00'),
(631, 314, 23, 92, '10.00'),
(632, 315, 22, 102, '10.00'),
(633, 316, 16, 104, '20.00'),
(634, 317, 21, 86, '5.00'),
(635, 317, 22, 91, '0.00'),
(636, 317, 23, 92, '10.00'),
(637, 318, 22, 102, '10.00'),
(638, 319, 21, 86, '5.00'),
(639, 319, 22, 91, '0.00'),
(640, 319, 23, 92, '10.00'),
(641, 320, 22, 102, '10.00'),
(642, 321, 21, 86, '5.00'),
(643, 321, 22, 91, '0.00'),
(644, 321, 23, 92, '10.00'),
(645, 322, 22, 102, '10.00'),
(646, 323, 21, 86, '5.00'),
(647, 323, 22, 91, '0.00'),
(648, 323, 23, 92, '10.00'),
(649, 324, 22, 102, '10.00'),
(650, 325, 21, 86, '5.00'),
(651, 325, 22, 91, '0.00'),
(652, 325, 23, 92, '10.00'),
(653, 326, 22, 102, '10.00'),
(654, 327, 12, 64, '1.00'),
(655, 327, 16, 69, '6.00'),
(656, 327, 19, 68, '3.00'),
(657, 327, 20, 71, '0.00'),
(658, 328, 21, 86, '5.00'),
(659, 328, 22, 91, '0.00'),
(660, 328, 23, 92, '10.00'),
(661, 329, 22, 102, '10.00'),
(662, 330, 21, 86, '5.00'),
(663, 330, 22, 91, '0.00'),
(664, 330, 23, 92, '10.00'),
(665, 331, 22, 102, '10.00'),
(666, 332, 21, 86, '5.00'),
(667, 332, 22, 91, '0.00'),
(668, 332, 23, 92, '10.00'),
(669, 333, 22, 102, '10.00'),
(670, 334, 21, 86, '5.00'),
(671, 334, 22, 91, '0.00'),
(672, 334, 23, 92, '10.00'),
(673, 335, 22, 102, '10.00'),
(674, 336, 21, 86, '5.00'),
(675, 336, 22, 91, '0.00'),
(676, 336, 23, 92, '10.00'),
(677, 337, 22, 102, '10.00'),
(678, 338, 21, 86, '5.00'),
(679, 338, 22, 91, '0.00'),
(680, 338, 23, 92, '10.00'),
(681, 339, 22, 102, '10.00'),
(682, 340, 21, 86, '5.00'),
(683, 340, 22, 91, '0.00'),
(684, 340, 23, 92, '10.00'),
(685, 341, 22, 102, '10.00'),
(686, 342, 21, 86, '5.00'),
(687, 342, 22, 91, '0.00'),
(688, 342, 23, 92, '10.00'),
(689, 343, 22, 102, '10.00'),
(690, 344, 21, 86, '5.00'),
(691, 344, 22, 91, '0.00'),
(692, 344, 23, 92, '10.00'),
(693, 345, 22, 102, '10.00'),
(694, 346, 21, 86, '5.00'),
(695, 346, 22, 91, '0.00'),
(696, 346, 23, 92, '10.00'),
(697, 347, 22, 102, '10.00'),
(698, 348, 21, 86, '5.00'),
(699, 348, 22, 91, '0.00'),
(700, 348, 23, 92, '10.00'),
(701, 349, 22, 102, '10.00'),
(702, 350, 21, 86, '5.00'),
(703, 350, 22, 91, '0.00'),
(704, 350, 23, 92, '10.00'),
(705, 351, 22, 102, '10.00'),
(706, 352, 21, 86, '5.00'),
(707, 352, 22, 91, '0.00'),
(708, 352, 23, 92, '10.00'),
(709, 353, 22, 102, '10.00'),
(710, 354, 21, 86, '5.00'),
(711, 354, 22, 91, '0.00'),
(712, 354, 23, 92, '10.00'),
(713, 355, 22, 102, '10.00'),
(714, 356, 21, 86, '5.00'),
(715, 356, 22, 91, '0.00'),
(716, 356, 23, 92, '10.00'),
(717, 357, 22, 102, '10.00'),
(718, 358, 21, 86, '5.00'),
(719, 358, 22, 91, '0.00'),
(720, 358, 23, 92, '10.00'),
(721, 359, 22, 102, '10.00'),
(722, 360, 12, 64, '1.00'),
(723, 360, 16, 69, '6.00'),
(724, 360, 19, 67, '2.00'),
(725, 360, 20, 71, '0.00'),
(726, 362, 12, 64, '1.00'),
(727, 362, 16, 69, '6.00'),
(728, 362, 19, 67, '2.00'),
(729, 362, 20, 71, '0.00'),
(730, 363, 16, 69, '6.00'),
(731, 363, 20, 71, '0.00'),
(732, 364, 12, 120, '10.00'),
(733, 365, 12, 120, '10.00'),
(734, 366, 12, 112, '2.00'),
(735, 366, 16, 116, '6.00'),
(736, 366, 19, 115, '3.00'),
(737, 366, 20, 119, '0.00'),
(738, 369, 12, 112, '2.00'),
(739, 369, 16, 116, '6.00'),
(740, 369, 19, 114, '2.00'),
(741, 369, 20, 119, '0.00'),
(742, 370, 16, 121, '8.00'),
(743, 371, 25, 125, '10.00'),
(744, 372, 25, 125, '10.00'),
(745, 373, 25, 125, '10.00'),
(746, 374, 25, 126, '1.00'),
(747, 375, 21, 87, '10.00'),
(748, 375, 22, 90, '50.00'),
(749, 376, 25, 125, '10.00'),
(750, 377, 25, 126, '1.00'),
(751, 378, 25, 126, '1.00'),
(752, 379, 25, 126, '1.00'),
(753, 380, 25, 125, '10.00'),
(754, 381, 25, 127, '10.00'),
(755, 381, 25, 128, '10.00'),
(756, 382, 25, 127, '10.00'),
(757, 382, 25, 128, '10.00'),
(758, 383, 22, 105, '10.80'),
(759, 386, 22, 105, '10.80'),
(760, 387, 21, 85, '0.00'),
(761, 387, 22, 91, '0.00'),
(762, 388, 21, 85, '0.00'),
(763, 388, 22, 91, '0.00'),
(764, 389, 22, 105, '10.80'),
(765, 392, 21, 85, '0.00'),
(766, 392, 22, 91, '0.00'),
(767, 401, 12, 111, '1.00'),
(768, 401, 16, 116, '6.00'),
(769, 401, 16, 117, '6.50'),
(770, 401, 19, 115, '3.00'),
(771, 401, 20, 118, '0.00'),
(772, 402, 21, 85, '0.00'),
(773, 402, 22, 91, '0.00'),
(774, 403, 22, 108, '5.00'),
(775, 404, 22, 105, '10.80'),
(776, 405, 21, 85, '0.00'),
(777, 405, 22, 91, '0.00'),
(778, 406, 21, 85, '0.00'),
(779, 406, 22, 90, '50.00'),
(780, 406, 23, 92, '10.00'),
(781, 406, 23, 93, '2.00'),
(782, 407, 21, 85, '0.00'),
(783, 407, 22, 90, '50.00'),
(784, 407, 23, 92, '10.00'),
(785, 407, 23, 93, '2.00'),
(786, 407, 23, 94, '2.00'),
(787, 407, 23, 95, '2.00'),
(788, 407, 23, 96, '2.00'),
(789, 407, 23, 97, '2.00'),
(790, 407, 23, 98, '2.00'),
(791, 407, 23, 99, '2.00'),
(792, 407, 23, 100, '2.00'),
(793, 408, 21, 85, '0.00'),
(794, 408, 22, 91, '0.00'),
(795, 409, 21, 85, '0.00'),
(796, 409, 22, 91, '0.00'),
(797, 410, 21, 86, '5.00'),
(798, 410, 22, 90, '50.00'),
(799, 410, 23, 92, '10.00'),
(800, 410, 23, 93, '2.00'),
(801, 411, 21, 86, '5.00'),
(802, 411, 22, 90, '50.00'),
(803, 411, 23, 92, '10.00'),
(804, 411, 23, 93, '2.00'),
(805, 412, 21, 85, '0.00'),
(806, 412, 22, 90, '50.00'),
(807, 412, 23, 92, '10.00'),
(808, 412, 23, 93, '2.00'),
(809, 413, 21, 85, '0.00'),
(810, 413, 22, 90, '50.00'),
(811, 413, 23, 92, '10.00'),
(812, 413, 23, 93, '2.00'),
(813, 414, 21, 85, '0.00'),
(814, 414, 22, 91, '0.00'),
(815, 414, 23, 92, '10.00'),
(816, 414, 23, 93, '2.00'),
(817, 415, 21, 85, '0.00'),
(818, 415, 22, 91, '0.00'),
(819, 416, 21, 85, '0.00'),
(820, 416, 22, 90, '50.00'),
(821, 416, 23, 92, '10.00'),
(822, 416, 23, 93, '2.00'),
(823, 417, 21, 88, '5.00'),
(824, 417, 22, 91, '0.00'),
(825, 417, 23, 96, '2.00'),
(826, 418, 21, 89, '5.00'),
(827, 418, 22, 90, '50.00'),
(828, 418, 23, 92, '10.00'),
(829, 418, 23, 93, '2.00'),
(830, 419, 21, 85, '0.00'),
(831, 419, 22, 90, '50.00'),
(832, 419, 23, 92, '10.00'),
(833, 419, 23, 93, '2.00'),
(834, 420, 21, 86, '5.00'),
(835, 420, 22, 91, '0.00'),
(836, 420, 23, 95, '2.00'),
(837, 421, 21, 85, '0.00'),
(838, 421, 22, 90, '50.00'),
(839, 421, 23, 92, '10.00'),
(840, 421, 23, 93, '2.00'),
(841, 422, 21, 89, '5.00'),
(842, 422, 22, 91, '0.00'),
(843, 422, 23, 95, '2.00'),
(844, 423, 21, 85, '0.00'),
(845, 423, 22, 91, '0.00'),
(846, 424, 21, 85, '0.00'),
(847, 424, 22, 91, '0.00'),
(848, 425, 25, 126, '1.00'),
(849, 426, 25, 127, '10.00'),
(850, 426, 25, 128, '10.00'),
(851, 427, 25, 127, '10.00'),
(852, 427, 25, 128, '10.00'),
(853, 428, 25, 126, '1.00'),
(854, 431, 12, 112, '2.00'),
(855, 431, 16, 117, '6.50'),
(856, 431, 19, 115, '3.00'),
(857, 431, 20, 119, '0.00'),
(858, 432, 21, 161, '0.00'),
(859, 432, 22, 166, '50.00'),
(860, 432, 23, 168, '10.00'),
(861, 432, 23, 176, '2.00'),
(862, 433, 21, 161, '0.00'),
(863, 433, 22, 167, '0.00'),
(864, 435, 21, 161, '0.00'),
(865, 435, 22, 167, '0.00'),
(866, 436, 21, 161, '0.00'),
(867, 436, 22, 166, '50.00'),
(868, 436, 23, 168, '10.00'),
(869, 436, 23, 169, '2.00'),
(870, 437, 21, 161, '0.00'),
(871, 437, 22, 167, '0.00'),
(872, 438, 21, 161, '0.00'),
(873, 438, 22, 166, '50.00'),
(874, 438, 23, 168, '10.00'),
(875, 438, 23, 169, '2.00'),
(876, 439, 25, 127, '10.00'),
(877, 439, 25, 128, '10.00'),
(878, 440, 25, 127, '10.00'),
(879, 442, 21, 161, '0.00'),
(880, 442, 22, 167, '0.00'),
(881, 443, 21, 163, '10.00'),
(882, 443, 22, 166, '50.00'),
(883, 443, 23, 168, '10.00'),
(884, 443, 23, 169, '2.00'),
(885, 444, 21, 161, '0.00'),
(886, 444, 22, 167, '0.00'),
(887, 444, 23, 168, '10.00'),
(888, 444, 23, 169, '2.00'),
(889, 444, 23, 170, '2.00'),
(890, 444, 23, 171, '2.00'),
(891, 444, 23, 172, '2.00'),
(892, 445, 21, 162, '5.00'),
(893, 445, 22, 166, '50.00'),
(894, 445, 23, 169, '2.00'),
(895, 446, 22, 103, '0.00'),
(896, 450, 21, 161, '0.00'),
(897, 450, 22, 166, '50.00'),
(898, 452, 21, 161, '0.00'),
(899, 452, 22, 167, '0.00'),
(900, 453, 21, 161, '0.00'),
(901, 453, 22, 166, '50.00'),
(902, 453, 23, 168, '10.00'),
(903, 453, 23, 169, '2.00'),
(904, 454, 21, 161, '0.00'),
(905, 454, 22, 167, '0.00'),
(906, 455, 21, 161, '0.00'),
(907, 455, 22, 166, '50.00'),
(908, 455, 23, 168, '10.00'),
(909, 455, 23, 169, '2.00'),
(910, 456, 21, 161, '0.00'),
(911, 456, 22, 167, '0.00'),
(912, 457, 21, 161, '0.00'),
(913, 457, 22, 166, '50.00'),
(914, 457, 23, 168, '10.00'),
(915, 457, 23, 169, '2.00'),
(916, 458, 21, 161, '0.00'),
(917, 458, 22, 167, '0.00'),
(918, 459, 21, 161, '0.00'),
(919, 459, 22, 166, '50.00'),
(920, 459, 23, 168, '10.00'),
(921, 459, 23, 169, '2.00'),
(922, 460, 21, 161, '0.00'),
(923, 460, 22, 167, '0.00'),
(924, 461, 21, 161, '0.00'),
(925, 461, 22, 166, '50.00'),
(926, 461, 23, 168, '10.00'),
(927, 461, 23, 169, '2.00'),
(928, 463, 16, 116, '6.00'),
(929, 463, 20, 118, '0.00'),
(930, 464, 25, 125, '10.00'),
(931, 465, 25, 125, '10.00'),
(932, 466, 25, 125, '10.00'),
(933, 467, 21, 161, '0.00'),
(934, 467, 22, 167, '0.00'),
(935, 468, 21, 161, '0.00'),
(936, 468, 22, 166, '50.00'),
(937, 468, 23, 168, '10.00'),
(938, 468, 23, 169, '2.00'),
(939, 469, 25, 125, '10.00'),
(940, 472, 16, 116, '6.00'),
(941, 472, 20, 118, '0.00'),
(942, 474, 16, 121, '8.00'),
(943, 478, 15, 122, '10.00'),
(944, 479, 25, 127, '10.00'),
(945, 480, 29, 180, '0.00'),
(946, 481, 25, 127, '10.00'),
(947, 481, 25, 128, '10.00'),
(948, 483, 25, 125, '10.00'),
(949, 484, 25, 125, '10.00'),
(950, 485, 25, 125, '10.00'),
(951, 486, 12, 111, '1.00'),
(952, 486, 16, 116, '6.00'),
(953, 486, 19, 114, '2.00'),
(954, 486, 20, 118, '0.00'),
(955, 488, 25, 125, '10.00'),
(956, 489, 25, 125, '10.00'),
(957, 490, 12, 111, '1.00'),
(958, 490, 16, 116, '6.00'),
(959, 490, 19, 114, '2.00'),
(960, 490, 20, 118, '0.00'),
(961, 493, 25, 125, '10.00'),
(962, 494, 25, 125, '10.00'),
(963, 495, 25, 125, '10.00'),
(964, 496, 25, 125, '10.00'),
(965, 497, 16, 121, '8.00'),
(966, 499, 16, 121, '8.00'),
(967, 502, 16, 121, '8.00'),
(968, 503, 7, 18, '10.00'),
(969, 504, 7, 20, '15.00'),
(970, 505, 7, 20, '15.00'),
(971, 507, 25, 125, '10.00'),
(972, 508, 25, 125, '10.00'),
(973, 509, 25, 125, '10.00'),
(974, 510, 25, 125, '10.00'),
(975, 511, 25, 125, '10.00'),
(976, 512, 16, 121, '8.00'),
(977, 513, 21, 161, '0.00'),
(978, 513, 22, 167, '0.00'),
(979, 514, 21, 161, '0.00'),
(980, 514, 22, 166, '50.00'),
(981, 514, 23, 168, '10.00'),
(982, 514, 23, 169, '2.00'),
(983, 516, 25, 125, '10.00'),
(984, 517, 7, 18, '10.00'),
(985, 518, 16, 121, '8.00'),
(986, 519, 25, 125, '10.00'),
(987, 520, 25, 187, '2.50'),
(988, 521, 25, 188, '10.00'),
(989, 521, 25, 189, '10.00'),
(990, 522, 25, 185, '2.00'),
(991, 522, 25, 186, '5.00'),
(992, 523, 25, 187, '2.50'),
(993, 527, 22, 102, '10.00'),
(994, 528, 25, 188, '10.00'),
(995, 530, 25, 187, '2.50'),
(996, 531, 29, 181, '0.00'),
(997, 532, 21, 161, '0.00'),
(998, 532, 22, 167, '0.00'),
(999, 533, 21, 161, '0.00'),
(1000, 533, 22, 166, '50.00'),
(1001, 533, 23, 168, '10.00'),
(1002, 533, 23, 169, '2.00'),
(1003, 534, 25, 185, '2.00'),
(1004, 534, 25, 186, '5.00'),
(1005, 536, 29, 180, '0.00'),
(1006, 537, 25, 189, '10.00'),
(1007, 541, 16, 121, '8.00'),
(1008, 543, 19, 196, '2.00'),
(1009, 543, 24, 194, '1.00'),
(1010, 544, 19, 196, '2.00'),
(1011, 544, 24, 194, '1.00'),
(1012, 546, 29, 181, '0.00'),
(1013, 548, 29, 181, '0.00'),
(1014, 551, 15, 122, '10.00'),
(1015, 554, 16, 121, '8.00'),
(1016, 556, 15, 122, '10.00'),
(1017, 557, 15, 122, '10.00'),
(1018, 558, 19, 195, '1.00'),
(1019, 559, 7, 21, '2.00'),
(1020, 560, 25, 186, '5.00'),
(1021, 561, 25, 188, '10.00'),
(1022, 563, 25, 187, '2.50'),
(1023, 566, 31, 190, '2.00'),
(1024, 567, 16, 121, '8.00'),
(1025, 568, 25, 187, '2.50'),
(1026, 570, 32, 191, '1.00'),
(1027, 573, 31, 190, '2.00'),
(1028, 576, 25, 125, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `api_key` text,
  `secret` varchar(255) DEFAULT NULL,
  `payment_type` int(5) NOT NULL COMMENT '0 -Eway, 1 - Apple Pay, 2 - Google Pay',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `shop_id`, `api_key`, `secret`, `payment_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 52, '1zxcasacDSVCDVcsdvsdVsDVSDVsDVsdvSD', NULL, 1, '2019-04-02 09:00:56', '2019-04-02 15:13:15', NULL);

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
(33, '', '4', '2', 10, '50.00', '', 'SAVE50', '50.00', '1', '2019-02-04', '2019-03-31', '100.00', 'Use Promocode SAVE50 To Get 50.00% Discount* On Total Order Value (Max Discount $50.00)', 1, '2019-02-11 07:49:47', '2019-03-07 12:14:21', NULL),
(34, '', '5', '2', 3, '50.00', '', 'MYSHOPOFF', '20.00', '1', '2019-02-11', '2019-02-28', '100.00', 'Use Promocode MYSHOPOFF To Get 20.00% Cashback* On Total Order Value (Max Cashback Rs.50)', 1, '2019-02-11 10:28:40', NULL, NULL),
(35, '', '4', '2', 5, '100.00', '5', 'FEB27', '30.00', '1', '2019-02-11', '2019-03-09', '200.00', 'Use Promocode FEB27 To Get 30.00% Discount* On Total Order Value (Max Discount $100.00)', 1, '2019-02-11 11:15:32', '2019-03-07 10:17:25', NULL),
(36, '52', '7', '2', 5, '100.00', '', 'GET50M', '10.00', '1', '2019-02-13', '2019-02-28', '500.00', 'Use Promocode GET50M To Get 10.00% Discount* On Total Order Value (Max Discount $100.00)', 1, '2019-02-13 05:56:34', '2019-02-13 09:21:21', NULL),
(37, '62', '7', '1', 5, '', '', 'MYTEST', '50.00', '0', '2019-02-14', '2019-02-28', '500.00', 'Use Promocode MYTEST To Get Flat $50.00 Discount* On Total Product(s) Value ', 1, '2019-02-13 10:02:34', '2019-02-13 10:12:34', NULL),
(38, '52', '4', '1', 1, '', '', 'ALL10', '50.00', '0', '2019-02-18', '2019-03-09', '100.00', 'Use Promocode ALL10 To Get flat $50.00 Cashback* On Total Product(s) Value ', 1, '2019-02-18 09:17:57', NULL, NULL),
(39, '52', '4', '1', 2, '50.00', '', 'SAVE15', '15.00', '1', '2019-02-25', '2019-03-09', '100.00', 'Use Promocode SAVE15 To Get 15.00% Discount* On Total Product(s) Value (Max Discount $50.00)', 1, '2019-02-25 07:29:22', '2019-02-25 07:29:50', NULL),
(40, '', '1', '2', 2, '20.00', '', 'FLAT10', '10.00', '1', '2019-03-01', '2019-03-02', '200.00', 'Use Promocode FLAT10 To Get 10.00% Discount* On Total Order Value (Max Discount $20.00)', 1, '2019-03-01 11:04:39', '2019-03-01 11:11:55', '2019-03-04 05:28:08'),
(41, '', '6', '2', 2, '100.00', '2', 'SAVE20PERCENT', '20.00', '1', '2019-03-01', '2019-03-06', '500.00', 'Use Promocode SAVE20PERCENT To Get 20.00% Discount* On Total Order Value (Max Discount $100.00)', 1, '2019-03-01 11:24:34', '2019-03-02 08:22:36', '2019-03-04 05:28:01'),
(42, '', '6', '2', 3, '', '3', 'SAVE100', '100.00', '0', '2019-03-01', '2019-03-08', '700.00', 'Use Promocode SAVE100 To Get Flat $100.00 Discount* On Total Order Value ', 1, '2019-03-01 11:29:42', '2019-03-02 08:18:08', '2019-03-04 05:28:27'),
(43, '58', '7', '2', 2, '100.00', '', 'OFF20', '20.00', '1', '2019-03-01', '2019-03-04', '500.00', 'Use Promocode OFF20 To Get 20.00% Cashback* On Total Order Value (Max Cashback Rs.100)', 1, '2019-03-01 11:35:55', NULL, '2019-03-04 05:28:35'),
(44, '52', '4', '1', 3, '50.00', '', 'SAVE501', '50.00', '1', '2019-02-04', '2019-03-10', '100.00', 'Use Promocode SAVE501 To Get 50.00% Discount* On Total Product(s) Value (Max Discount $50.00)', 1, '2019-02-11 07:49:47', '2019-03-07 10:33:46', NULL),
(45, '52', '7', '2', 2, '', '', 'ITEMOFFER', '10.00', '0', '2019-03-02', '2019-03-31', '120.00', 'Use Promocode ITEMOFFER To Get Flat $10.00 Discount* On Total Order Value ', 1, '2019-03-02 05:36:55', '2019-03-02 05:37:35', NULL),
(46, '', '1', '2', 1, '30.00', '', 'SAVE10', '10.00', '1', '2019-03-04', '2019-03-14', '200.00', 'Use Promocode SAVE10 To Get 10.00% Cashback* On Total Order Value (Max Cashback Rs.30)', 1, '2019-03-04 05:30:01', NULL, '2019-03-08 05:39:25'),
(47, '', '4', '2', 2, '20.00', '', '3FREE', '10.00', '1', '2019-03-05', '2019-03-31', '50.00', 'Use Promocode 3FREE To Get 10.00% Cashback* On Total Order Value (Max Cashback Rs.20)', 1, '2019-03-05 07:58:38', NULL, NULL),
(48, '58', '7', '1', 2, '100.00', '2', 'SAVE10', '10.00', '0', '2019-03-08', '2019-03-10', '200.00', 'Use Promocode SAVE10 To Get Flat $10.00 Discount* On Total Product(s) Value ', 1, '2019-03-08 05:45:30', '2019-03-08 07:41:09', NULL),
(49, '', '4', '1', 5, '10.00', '', '18OFFER', '50.00', '0', '2019-03-26', '2019-03-30', '110.00', 'Use Promocode 18OFFER To Get Flat $50.00 Discount* On Total Order Value ', 1, '2019-03-18 06:18:40', '2019-03-27 02:17:37', NULL),
(50, '', '4', '2', 1, '20.00', '', 'SPRING10', '10.00', '1', '2019-04-01', '2019-04-27', '50.00', 'Use Promocode SPRING10 To Get 10.00% Cashback* On Total Order Value (Max Cashback Rs.20.00)', 1, '2019-03-27 06:23:10', NULL, NULL),
(51, '58', '4', '2', 1, '', '', 'SPING10', '10.00', '0', '2019-04-01', '2019-05-02', '10.00', 'Use Promocode SPING10 To Get flat $10.00 Cashback* On Total Order Value ', 1, '2019-03-27 06:45:42', NULL, NULL),
(52, '', '4', '2', 1, '', '', 'APRIL1', '10.00', '0', '2019-03-31', '2019-04-26', '12.00', 'Use Promocode APRIL1 To Get Flat $10.00 Discount* On Total Order Value ', 1, '2019-03-31 05:09:56', '2019-03-31 17:10:11', NULL),
(53, '', '4', '2', 1, '5.00', '', 'APRIL2', '10.00', '1', '2019-04-03', '2019-04-25', '12.00', 'Use Promocode APRIL2 To Get 10.00% Discount* On Total Order Value (Max Discount $5.00)', 1, '2019-03-31 18:40:51', '2019-04-03 01:03:37', NULL),
(54, '58', '7', '2', 3, '', '', 'MAYUR20', '50.00', '0', '2019-04-15', '2019-04-17', '100.00', 'Use Promocode MAYUR20 To Get Flat $50.00 Discount* On Total Order Value ', 1, '2019-04-03 12:05:52', '2019-04-10 20:27:37', NULL),
(55, '58', '4', '1', 100, '', '', 'SOVARAN30', '50.00', '0', '2019-04-03', '2019-04-12', '100.00', 'Use Promocode SOVARAN30 To Get Flat $50.00 Discount* On Total Product(s) Value ', 1, '2019-04-03 12:11:14', '2019-04-04 17:51:51', NULL),
(56, '', '4', '2', 1, '', '', 'TEST2', '10.00', '0', '2019-04-11', '2019-05-09', '70.00', 'Use Promocode TEST2 To Get Flat $10.00 Discount* On Total Order Value ', 1, '2019-04-05 08:25:58', '2019-04-10 20:24:24', NULL),
(57, '', '4', '2', 3, '10.00', '', 'TEST20', '10.00', '1', '2019-04-11', '2019-05-13', '50.00', 'Use Promocode TEST20 To Get 10.00% Discount* On Total Order Value (Max Discount $10.00)', 1, '2019-04-05 18:41:34', '2019-04-10 08:30:38', NULL),
(58, '94', '7', '1', 1, '', '', 'SAVI10', '50.00', '0', '2019-04-09', '2019-04-10', '300.00', 'Use Promocode SAVI10 To Get flat $50.00 Cashback* On Total Product(s) Value ', 1, '2019-04-09 14:45:44', NULL, NULL),
(59, '', '4', '2', 1, '', '', 'EWW10', '10.00', '0', '2019-04-11', '2019-05-09', '70.00', 'Use Promocode EWW10 To Get Flat $10.00 Discount* On Total Order Value ', 1, '2019-04-11 11:04:27', '2019-04-11 11:04:50', NULL),
(60, '86', '4', '1', 50, '', '', 'GANPAT50', '40.00', '0', '2019-04-11', '2020-04-23', '100.00', 'Use Promocode GANPAT50 To Get Flat $40.00 Discount* On Total Product(s) Value ', 1, '2019-04-11 17:54:09', '2019-04-11 18:08:11', NULL),
(61, '100', '6', '2', 2, '', '3', 'SAVE5', '5.00', '0', '2019-04-14', '2019-04-27', '0.00', 'Use Promocode SAVE5 To Get flat $5.00 Cashback* On Total Order Value ', 1, '2019-04-14 02:34:32', NULL, NULL);

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
(12, 37, 62, 31),
(13, 43, 58, 27),
(14, 43, 58, 30),
(17, 45, 52, 26),
(18, 45, 52, 32),
(23, 48, 58, 29),
(24, 48, 58, 30),
(26, 58, 94, 48),
(27, 54, 58, 36);

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
(21, 39, 52, 25),
(23, 44, 52, 32),
(24, 48, 58, 29),
(25, 48, 58, 30),
(26, 49, 52, 18),
(27, 49, 52, 19),
(28, 49, 52, 32),
(32, 55, 58, 27),
(33, 58, 94, 46),
(34, 58, 94, 48),
(36, 60, 86, 42),
(37, 60, 86, 44);

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
(1, 'tax', 'TAX(%)', '6.00'),
(2, 'delivery_available_mile', 'Delivery Available Mile', '100.00');

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
  `delivery_charges_per_mile` varchar(255) NOT NULL DEFAULT '1.50',
  `minimum_mile` varchar(11) NOT NULL DEFAULT '1.00',
  `charges_of_minimum_mile` varchar(11) NOT NULL DEFAULT '1.00',
  `payment_mode` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 - Card , 1 - Apple Pay, 2 - Google Pay',
  `tax_number` varchar(255) NOT NULL,
  `service_charge` varchar(11) NOT NULL,
  `device_type` int(5) NOT NULL COMMENT '	0-web, 1- android, 2 -ios',
  `device_token` varchar(255) NOT NULL,
  `broacher` varchar(255) NOT NULL,
  `takeout_delivery_status` int(5) NOT NULL DEFAULT '3' COMMENT '1 - Delivery , 2 - Takeout , 3 - Both',
  `weekly_status` int(1) NOT NULL DEFAULT '0' COMMENT 'Weekly Delivery Available - 1  ',
  `status` int(5) NOT NULL COMMENT '0  - pending , 1 - active, 2 - deactive',
  `admin_verified` smallint(1) NOT NULL DEFAULT '0' COMMENT '0 - pending, 1 - activated',
  `message` text NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `activation_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `email`, `password`, `shop_name`, `short_name`, `percentage`, `vender_name`, `shop_code`, `profile_picture`, `address`, `zip_code`, `city`, `state`, `country`, `latitude`, `longitude`, `about`, `contact_no1`, `contact_no2`, `website`, `facebook_link`, `twitter_link`, `pinterest_link`, `min_order`, `delivery_time`, `order_by_time`, `delivery_charges_per_mile`, `minimum_mile`, `charges_of_minimum_mile`, `payment_mode`, `tax_number`, `service_charge`, `device_type`, `device_token`, `broacher`, `takeout_delivery_status`, `weekly_status`, `status`, `admin_verified`, `message`, `remember_token`, `activation_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 'sugar@mailinator.com', '$2y$10$2Qov5hbktXILNk8/EezJi.rakocg80gqr75xA7JIFLNVHLoLgQlvi', 'Cafe Ristro', 'eww-decvv-1', '10', 'Mr Ristretto', 'RIS52', 'vender_1555132438.jpg', 'Sola, Ahmedabad, Gujarat, India', '38006', 'Ahmedabad', 'Gujarat', 'India', '23.0757184', '72.50903659999994', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '986 532 1245', '774 587 1466', 'https://www.zomato.com/ah', '', '', '', '8.00', '11:30 AM', '10:00 AM', '2.00', '2.00', '1.50', '0,1,2', '657-57-5765', '2.70', 0, '212', 'brochure_1541502113.jpg', 3, 1, 1, 1, '', '6c0bf58d69c1a8adead8c7c158badc2f87430bf9', '', '2018-11-06 05:49:41', '2019-04-09 15:12:40', NULL),
(53, 'palboy@mailinator.com', '', 'Test Shop', '', '10.50', 'Pal', 'TES53', 'vender_1541999590.jpg', 'Gota, Ahmedabad, Gujarat, India', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 1, 0, 1, '', '', '', '2018-11-12 00:43:10', NULL, NULL),
(54, 'palcakes@mailinator.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Git', '', '8.00', 'Frl', 'GIT54', '', 'Del\\\"hi, Ind\\\"ia', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '', '0.50', 0, '', '', 3, 1, 1, 1, '', '', '', '2018-11-12 09:06:52', '2018-11-23 00:41:26', NULL),
(55, 'Cafe@eww.com', '', 'The Hytt Cafe', '', '10.00', 'Giop', 'THE55', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '42.34797469999999', '-71.08792840000001', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 1, 0, 1, '', '', '', '2019-01-03 09:21:24', NULL, NULL),
(56, 'PunchyMan@mailinator.com', '', 'Punchy Man', '', '', 'Dhrumi', 'PUN56', '', 'DFW Remote North Parking, Grapevine, TX, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '32.926195', '-97.04413999999997', '', '7745871466', '4353455434', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 1, 0, 1, '', '', '', '2019-01-09 01:52:15', NULL, NULL),
(57, 'SmartDoody@mailinator.com', '$2y$10$CjPL17v5/rIGScMxRYs8x.9VT0K84Z109Z9niH80PKnJSOPcj//Oa', 'St. George\\\'s', 'st-georeg', '', 'Doody', 'SMA57', 'vender_1549620579.jpg', 'Hynes Convention Center (Boylston Street and Gloucester Street), Boston, MA, USA', '02199', 'Suffolk County', 'Massachusetts', 'United States', '42.3483041', '-71.08359259999997', '', '666 666 6666', '666 655 5555', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.30', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-01-10 02:23:39', '2019-02-08 10:10:41', NULL),
(58, 'vadilal@yopmail.com', '$2y$10$GtENeVvYVjeP6m4lvU8.wO4l95Km81m8SyTn2z9RAfRqHohIfO0kG', 'Vadilal Eatery', 'vadilal-eatery', '', 'Vadilal', 'VAD58', 'vender_1547204136.png', '55, 2nd Main Road, Ramachandrapuram, S.S.I.Area, Dayananda Nagar, Rajaji Nagar, Bengaluru, Karnataka, India', '56002', 'Bangalore Urban', 'Karnataka', 'India', '12.9871134', '77.56302460000006', 'This is test This is testThis is testThis is testThis is testThis is testThis is testThis is test This is testThis is testThis is test This is testThis is testThis is test', '774 587 1466', '774 587 1466', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '100.00', '11:30 AM', '10:00 AM', '2.50', '2.30', '3.00', '0,2', '545-55-5555', '0.50', 0, 'dmNrhhh4XkU:APA91bGlecM_fLypvGUtEoOTw3HhspbioIFlJzjz2JpNBPHGnwRjXGVLelKlcQ0D_E31bjFTYho47CuMBrZg9NUfqbH1JytQG1UbCstGITYmiCDnS-rDTNMBgKvxPtLKdVJw_Oe0NwfW', 'brochure_1547460096.jpg', 3, 1, 1, 1, '', '', '', '2019-01-11 10:50:17', '2019-04-11 15:20:13', NULL),
(59, 'BusyBoy@mailinator.com', '', 'Havmore', '', '', 'Mr  Patel', 'HAV59', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '', '', '', '7745871466', '7745871466', 'www.test.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '777-77-7777', '0.50', 0, '', '', 3, 1, 0, 1, '', '', '', '2019-01-11 11:04:12', '2019-01-14 07:47:37', NULL),
(60, 'bistro@mailinator.com', '$2y$10$LgPaANV6eu.2z8qblfoMf.qeNS8WVrfhEGBBiT8YBL6AJfVsCmGUy', 'Cafe Bistro', '', '', 'Mr Ristretto', 'CAF60', 'vender_1547208493.jpg', 'FGCU South Bridge Loop Road, Fort Myers, FL, USA', '33965', 'Lee County', 'Florida', 'United States', '26.4586806', '-81.76785970000003', 'Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in AhmedabadFind the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad', '8866541256', '8445687499', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '', '', '100.00', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '', '0.50', 0, '', 'brochure_1547208593.png', 3, 1, 1, 1, '', '', '', '2019-01-11 12:07:06', '2019-01-12 06:14:25', '2019-01-14 07:50:17'),
(61, 'dominos@gmail.com', '', 'Dominos', 'dominos', '10.00', 'Dominu', 'DOM61', '', 'no 124 ,rajajinagar entrance', '560067', 'bangalore', 'ka', 'India', '42.3086444', '-83.48211600000002', '', '576 878 9889', '354 656 7675', 'www.hfajfhaifr.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1', '778-90-0988', '0.50', 0, '', '', 3, 1, 0, 1, '', '', '63245e31b00d4f5b9b03c8ca0fe05f4890f5d4c6', '2019-01-14 07:55:53', '2019-04-08 18:09:03', '2019-04-08 18:10:13'),
(62, 'vineyard@mailinator.com', '$2y$10$NkmTmprrqUfdh/jBk.727eTMFtqouT2iIz/mXMJ04IwrRba8JXLW2', 'The Vineyard', '', '10.50', 'Mr Vine', 'THE62', 'vender_1549621131.jpg', 'London Eye Court, Las Vegas, NV, USA', '89178', 'Clark County', 'Nevada', 'United States', '36.0346157', '-115.30548069999998', '', '886 654 1258', '778 845 8745', 'https://www.zomato.com/ahmedabad/the-vineyard-bodakdev?zrp_bid=0&zrp_pid=14', '', '', '', '', '11:30 AM', '10:00 AM', '1.3', '2.50', '2.20', '2', '996-65-5745', '0.50', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-01-17 10:38:12', '2019-02-08 10:18:51', '2019-03-05 00:00:00'),
(63, 'test@gmail.com', '', 'Test', '', '', 'Rrtrt', 'TES63', '', 'Dg Farms Road, Wimauma, FL, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '', '', '', '546 546 4577', '444 444 4444', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '1,2', '555-55-5555', '0.50', 0, '', '', 3, 1, 0, 1, '', '', 'c7c1cf2f18b8f9c6e49f78a98e920877d17f288b', '2019-01-21 12:03:28', NULL, '2019-01-21 12:03:35'),
(64, 'MaleTater@mailinator.com', '$2y$10$u0u3DECZfKltNRAC..VwRegw2gUoiLY1dd.m3FcyOjRTVWNDu8LgG', 'MaleTater', '', '', 'MaleTater', 'MAL64', '', 'Aha Macav Parkway, Needles, CA, USA', '66666', 'San Bernardino County', 'California', 'United States', '35.0402223', '-114.64573039999999', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0', '66-66-6666', '0.50', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-01-23 06:11:39', '2019-01-23 06:12:38', NULL),
(65, 'developer.eww2@gmail.com', '$2y$10$4htY1Ibb10PR4qZfxVm0SeUKxI7/AKd.3ktlWfS6sQvcG7XT/Ef.m', 'Exotica Cafe', 'exotica-cafe-1', '', 'Eww', 'EWW65', 'vender_1554806046.png', 'Urban Management Center, GCP Business Centre, 120 Feet Ring Road, Sarvottam Nagar Society, Navrangpura, Ahmedabad, Gujarat', '380014', 'Ahmedabad', 'Gujarat', 'India', '23.045133', '72.551322', '', '9856457812', '555 555 5555', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '555-55-5555', '0.50', 0, 'SD', '', 3, 1, 1, 1, '', '', '', '2019-01-23 06:15:09', '2019-04-09 16:04:06', NULL),
(66, 'developer.eww3@gmail.com', '', 'The Esplendido Cafe', '', '', 'Mr Esplendo', 'THE66', '', 'Glendale, CA, USA', '32205', 'Duval County', 'Florida', 'United States', '', '', '', '555 555 5556', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '9', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 1, 0, 1, '', '', 'e5234ea06feeb57a1a78e1594224fa175fc054b8', '2019-01-23 06:37:05', NULL, NULL),
(67, 'myshop@binkmail.com', '', 'Waffles Store', 'waffles-store', '', 'Dhrumi', 'WAF67', '', 'Jollyville Road, Austin, TX, USA', '78759', 'Travis County', 'Texas', 'United States', '30.4065779', '30.4065779', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '2.00', '2.50', '2.20', '0', '666-66-6666', '0.50', 0, '', '', 3, 1, 0, 1, '', '', 'a03cc2da19ad20a31997fd09e4756843e301664d', '2019-01-31 12:04:09', '2019-04-14 02:30:15', NULL),
(68, 'Stingo@tradermail.info', '$2y$10$jyWKXLh14gxxlD93JJjyq.NPUnvByej8bWVHr5akuh4rsIBwsXhBW', 'Stingo, Ace Hotel', 'stingo-ace-hotel', '', 'Stingo', 'STI68', 'vender_1549620927.jpg', 'Ace Hotel, Portland, OR, USA', '97205', 'Multnomah County', 'Oregon', 'United States', '45.52211399999999', '-122.681602', 'The Main Bar at Willy\\\'s Wine Bar is a private event venue available to hire in the City of London.\r\n\r\nIf there is one place in the City you need to experience, it?s Willy?s Wine Bar.\r\n\r\nThis is one of London?s most established wine bars in London. Not only is it bursting with tradition and charm, but it also plays host to some of London?s best wine quizzes and tastings.', '787 878 7878', '787 878 7878', 'https://www.zomato.com/ah', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '5', '08:00 AM', '07:00 AM', '1.50', '2.50', '2.20', '0,1', '790-65-7575', '0.50', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-02-08 10:13:18', '2019-02-13 13:25:33', NULL),
(69, 'fire@devnullmail.com', '$2y$10$5iTn3WKnCn/z1LjrNeYca.7YmU0vhPKXqF9ZgYL3TQ0bya1DzcAAW', 'Nation Fire 2', 'nation-fire', '', 'Miss Boby', 'NAT69', '', 'King of Prussia, PA, USA', '19406', 'Montgomery County', 'Pennsylvania', 'United States', '', '', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '610 265 5794', '610 265 5794', 'https://www.simon.com/mall/king-of-prussia-mall', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '150.00', '10:00 AM', '09:30 AM', '1.50', '12.00', '10.00', '0,1', '676-76-7676', '2.00', 0, '', '', 2, 1, 1, 1, '', '', '', '2019-03-02 08:09:51', '2019-03-02 08:11:10', NULL),
(70, 'foody@letthemeatspam.com', '', 'Food Track', 'food-track', '', 'Miss Green', 'FOO70', '', 'H K Allen Parkway, Temple, TX, USA', '76502', 'Bell County', 'Texas', 'United States', '31.04998459999999', '-97.37216409999996', '', '777 777 7777', '', '', '', '', '', '', '', '', '2.00', '5.00', '5.00', '1,2', '777-77-7777', '', 0, '', '', 3, 1, 0, 1, '', '', 'a77ad09ca43d8ac2945bd81b8067b241d60444cf', '2019-03-04 05:17:57', NULL, '2019-03-04 05:19:07'),
(71, 'ThumbBub88@mailinator.com', '', 'Mcdonalds', 'mcdonalds', '', 'Ffgdf', 'MUU71', '', 'F.S.C.J. Kent Campus, Jacksonville, FL, USA', '32205', 'Duval County', 'Florida', 'United States', '', '', '', '666 666 6655', '', '', '', '', '', '', '', '', '60.00', '6.00', '6.00', '0', '565-67-5675', '', 0, '', '', 3, 1, 0, 1, '', '', '15d88eb35fa90c9b123b37676381a10d70b46370', '2019-03-06 11:07:32', '2019-03-08 03:34:27', NULL),
(76, 'rahul.bbit@gmail.comz', '', 'Dr Pizza', 'dr-pizza', '', 'Rahul', 'DRP76', '', '1109 Decatur Street, New Orleans, LA 70116, USA', '70116', 'Orleans Parish', 'Louisiana', 'United States', '29.9601404', '-90.05985670000001', '', '756 782 7928', '', '', '', '', '', '', '', '', '5.00', '3.00', '3.00', '1', '456-56-4564', '', 0, '', '', 3, 1, 0, 1, '', '', 'e508285af9500a5221824da3f5344b3b63ac59c9', '2019-03-15 06:09:24', NULL, NULL),
(77, 'savisagar@yopmail.com', '', 'Savi Sagar', 'savi-sagar', '7.00', 'Savitha', 'SAV77', '', '5,1st main road,ramachandrapura', '56002', 'Bengaluru', 'Karnataka', 'India', '12.9923118', '77.5600852', '', '990 236 6824', '866 016 6775', 'www.savisagar.com', '', '', '', '', '', '', '2.00', '1.00', '2.00', '0,1,2', '123-34-5676', '', 0, '', '', 3, 1, 0, 1, '', '', '352b85714b9f9bc60cae1dd8affe6373850f32ba', '2019-03-23 10:46:42', NULL, '2019-03-26 03:56:02'),
(78, 'sunvenk04@gmail.com', '$2y$10$8QLUD6tUq.J7ZAOSUYvRWuhjuUlvzmyaeCYdfMvYdoG0D5iOU9/1m', 'Dr Pizza', 'dr-pizza-3', '10.00', 'Amit', 'DRP78', '', '55, 2nd Main Road, Ramachandrapuram, S.S.I.Area, Dayananda Nagar, Rajaji Nagar, Bengaluru, Karnataka, India', '56002', 'Bangalore Urban', 'Karnataka', 'India', '12.9871134', '77.56302460000006', '', '756 782 7928', '', '', '', '', '', '', '', '', '2.00', '5.00', '4.00', '0,1,2', '123-44-6568', '', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-03-23 11:10:24', '2019-04-01 23:13:18', '2019-04-07 16:15:01'),
(79, 'suma@oviotechnologies.com', '$2y$10$qNgPOSO1HQOffft8tbQBRuy9yrcnZ44.49AI8MIQ301KLKUmF7lGq', 'BombaY Tawa', 'bombay-tawa', '', 'Mumabi Takrey', 'BOM79', '', '55, 2nd Main Road, Ramachandrapuram, S.S.I.Area, Dayananda Nagar, Rajaji Nagar, Bengaluru, Karnataka, India', '56002', 'Bangalore Urban', 'Karnataka', 'India', '12.9871134', '77.56302460000006', '', '248 522 9427', '', 'www.tacobell.com', '', '', '', '', '', '', '1.00', '2.50', '2.00', '0,1,2', '324-23-4324', '', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-03-26 23:47:13', '2019-04-13 20:27:20', '2019-04-10 21:12:07'),
(80, 'rahul.bbit@gmail.com', '$2y$10$ATQ8ruLA9BznZASjwD4sU.1W7bUuTMumkufPUPXE8Uh61kUsmZDay', 'Dr Pizza', 'dr-pizza-2', '', 'DJP', 'DRP80', '', '6908 Fox Hills Road, Canton, MI, USA', '48187', 'Canton', 'Michigan', 'United States', '42.3317731', '-83.48375679999998', '', '756 782 7928', '', '', '', '', '', '', '', '', '10.00', '2.00', '1.00', '0,1,2', '423-42-3423', '2.', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-03-27 05:05:31', '2019-04-09 16:21:19', NULL),
(81, 'yo@yomail.com', '', 'Dr Pizza', 'dr-pizza-3', '', 'DFFF', 'DRP81', '', '43433 Cherrywood lane', '48188', 'Canton', 'MI', 'United States', '', '', '', '756 782 7928', '', '', '', '', '', '', '', '', '1.00', '1.00', '1.00', '0', '343-24-3242', '', 0, '', '', 3, 1, 0, 1, '', '', '09881aaa8ce86c8a93b45b29533b29c5cd28026d', '2019-03-27 06:19:55', NULL, '2019-04-02 10:46:34'),
(82, 'sun_venk04@yahoo.com', '', 'Savi Sagar', 'savi-sagar-1', '', 'Savitha', 'SAV82', '', '55,2st main road,ramachandrapura', '56002', 'Bengaluru', 'Karnataka', 'India', '12.9871134', '77.56302460000006', '', '990 236 8269', '', '', '', '', '', '', '', '', '1.50', '10.00', '2.00', '0,1,2', '132-34-5657', '', 0, '', '', 3, 0, 0, 1, '', '', 'ca70c7253f7069c91dba2bf4ba70dfb129dde589', '2019-04-01 22:53:40', '2019-04-01 22:59:15', '2019-04-07 16:14:50'),
(84, 'dhrumi_1996@yopmail.com', '$2y$10$HuQcPtSYrzPGY5c0PgKbE.M/4YCfZxdcfJrSvk2OlXlrbfBYMNWs2', 'Burger King', 'burger-king', '', 'Dhrumii', 'BUR84', '', 'Housing and Dining Administration Building, San Diego, CA, USA', '92161', 'San Diego County', 'California', 'United States', '32.8745634', '-117.2431431', '', '345 345 3453', '', '', '', '', '', '', '', '', '4.00', '4.00', '4.00', '0', '345-34-5354', '', 0, '', '', 3, 0, 1, 1, '', '', '', '2019-04-02 10:45:42', '2019-04-02 10:46:14', NULL),
(85, 'clicklunch24@gmail.com', '$2y$10$J3/K72/VsJ85SbR9BEvaheQ8xNBn4kNweEbbH2lsgIqN2UQM1zw2O', 'Cafe Baraco', 'cafe-baraco', '', 'Baraco', 'CAF85', '', 'CIMS Hospital Road, Panchamrut Bunglows II, Sola, Ahmedabad, Gujarat, India', '38005', 'Ahmedabad', 'Gujarat', 'India', '23.0697106', '72.51729209999996', '', '535 345 3453', '', '', '', '', '', '', '', '', '2.00', '1.00', '1.00', '0', '345-35-3453', '', 0, '', '', 3, 0, 1, 0, '', '', '', '2019-04-02 11:04:59', '2019-04-02 11:05:20', NULL),
(86, 'excellent@yopmail.com', '$2y$10$lYJBX5dAWxy7xNP.rXVD5.CgEndlB78FsYJTJO2AM4BWQoT04ohHu', 'Excellent Webworld Cafe', 'excellent-webworld', '12.00', 'Mr Webworld', 'EXC86', 'vender_1555050101.jpg', 'Science City Road, Panchamrut Bunglows II, Sola, Ahmedabad, Gujarat, India', '38006', 'Ahmedabad', 'Gujarat', 'India', '23.0708523', '72.5199543', 'Find the perfect Mcdonalds stock photos and editorial news pictures from Getty Images. Download premium ... France, Mc Donald\\\'s sign. RF. Editorial use only.Find the perfect Mcdonalds stock photos and editorial news pictures from Getty Images. Download premium ... France, Mc Donald\\\'s sign. RF. Editorial use only.Find the perfect Mcdonalds stock photos and editorial news pictures from Getty Images. Download premium ... France, Mc Donald\\\'s sign. RF. Editorial use only.Find the perfect Mcdonalds stock photos and editorial news pictures from Getty Images. Download premium ... France, Mc Donald\\\'s sign. RF. Editorial use only.', '787 435 0950', '787 435 0950', 'https://www.excellentwebworld.com/', '', '', '', '20.00', '04:00 PM', '05:00 AM', '1.50', '50.00', '25.00', '0,1,2', '435-34-5345', '2.00', 0, 'fZrHm_6H7Cw:APA91bE5FYEe1QlZAeT3839T26j0up3a_ucT9YZxe9gDNzPI9vSw2tADbSqsOmf8D1thcaegGNySwLe3vRZdAgnOxvLbdNnqDCRxUc6JeIYNtk7yMnHgm26__Fl_I_wxWPqVDxlr1Q26', '', 3, 1, 1, 1, '', '', '', '2019-04-05 17:24:21', '2019-04-05 17:31:32', NULL),
(87, 'ewr@dfg.fthy', '', 'Werewr', 'werewr', '', 'Gfhh', 'WER87', '', 'GGICO Metro Station - Dubai - United Arab Emirates', '56456', 'Dubai', 'Dubai', 'United Arab Emirates', '25.24948329999999', '55.33996879999995', '', '546 456 5645', '', '', '', '', '', '', '', '', '5.00', '5.00', '5.00', '0,1,2', '345-34-5345', '', 0, '', '', 3, 0, 0, 1, '', '', 'a8e70651768cb705eebdbbf8c6581aeafac25b6f', '2019-04-05 17:25:06', NULL, '2019-04-05 17:25:11'),
(94, 'sun_venk04@yahoo.com', '$2y$10$vWho6oKRI0by.RdWUlYCdeqxf4cLjImldl7ETn5rG1kP2K1n0fqLy', 'Savi Sagar 1', 'savi-sagar-2', '10.00', 'Savitha Suman', 'SAV94', 'vender_1555165491.png', '5, 1st Main Road, Ramachandrapuram, Rajaji Nagar, Bengaluru, Karnataka, India', '560021', 'Bangalore Urban', 'Karnataka', 'India', '12.9907873', '77.56302460000006', 'hghsdghdsgjsdjgsgjsjhkdjhkkhjfjdhkjfddjfkjhshsjshuohjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjigsoositsitspraspiaspriapkgogiorgorsjgrosgurigfre8y5yyjjfjdrrhjjjjjjh', '866 017 7665', '325 454 6576', '', '', '', '', '10.00', '09:00 AM', '08:00 AM', '1.99', '1.00', '1.00', '0', '999-06-5478', '1.00', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-04-08 20:40:09', '2019-04-13 19:54:51', NULL),
(95, 'sumakpn@yahoo.com', '$2y$10$FLxfSeTXmCktVkrDyNeCeeLJ7AnZhBs/p9CzvxebaxV5h2r1qPoFO', 'BombaY Tawa', 'bombay-tawa-1', '', 'Suma', 'BOM95', '', 'Balaji Pure Veg. Pure Fun, North Canton Center Road, Canton, MI, USA', '48187', 'Wayne County', 'Michigan', 'United States', '42.3370353', '-83.48998540000002', '', '614 546 0961', '', '', '', '', '', '', '', '', '1.50', '1.00', '1.00', '0', '', '', 0, '', '', 3, 0, 1, 0, '', '', '', '2019-04-10 15:48:35', '2019-04-10 21:20:20', NULL),
(96, 'sumakpn@gmail.com', '$2y$10$qqVkkAdh6dGRxUsCBCbj0eP.9YzAojdqq2yD.2.Bv4S7dRrkBQ8YW', 'BombaY Tawa', 'bombay-tawa-2', '', 'Suma', 'BOM96', '', '7017 Fox Hills Road', '48187', 'Canton', 'MI', 'United States', '', '', 'Delicious Indian and Chinese cuisine Restaurant in Canton center road. We are open all the time. Delivery and take out available.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '456 789 9861', '', '', '', '', '', '5.00', '12:00 PM', '02:00 PM', '5.00', '2.00', '5.00', '0,1', '345-34-5345', '2.00', 0, '', '', 3, 0, 1, 1, '', '', '', '2019-04-10 21:50:36', '2019-04-12 04:23:15', NULL),
(97, 'bhavesh@excellentwebworld.info', '$2y$10$6Dl4MGaBnIvBYzrbw41PrOtQxhNZzzLGfmfvDXVGOwN8eSdhv42yq', 'Yahoo Food Center', 'yahoo-food-center', '', 'Bhavesh', 'YAH97', '', 'Iscon Mega Mall Sarkhej - Gandhinagar Hwy, Bodakdev, Ahmedabad, Gujarat 380054, India', '380054', 'Ahmedabad', 'Gujarat', 'India', '23.030513', '72.5075401', '', '1234567890', '', '', '', '', '', '', '', '', '1.50', '1.00', '1.00', '0', '', '', 0, '', '', 3, 0, 1, 0, 'All food are here', '', '', '2019-04-11 19:14:53', '2019-04-12 11:13:28', NULL),
(98, 'patron@yopmail.com', '$2y$10$eUYhwEAom29bkDCE7FK5yeL7E6h4JLiznGZsJ5PfvXs12SLXaPkuW', 'La Patron Cafe', 'la-patron-cafe', '', 'Miss Patron', 'LAP98', 'vender_1555074055.jpg', 'Rivera Arcade, 100 Feet Anand Nagar Road, opp barbeque nation, Prahlad Nagar, Ahmedabad, Gujarat, India', '380009', 'Ahmedabad', 'Gujarat', 'India', '23.0123098', '72.50994500000002', 'Come and enjoy the ongoing cricket fever with the best food and the best people at La Patron CafeCome and enjoy the ongoing cricket fever with the best food and the best people at La Patron CafeCome and enjoy the ongoing cricket fever with the best food and the best people at La Patron Cafe', '714 456 6666', '', 'https://www.zomato.com/ahmedabad/la-patron-cafe-c-g-road?zrp_bid=283598&zrp_pid=14&zrp_cid=351386', '', '', '', '20.00', '12:30 AM', '12:00 AM', '2.00', '2.00', '2.50', '0,1', '567-54-5555', '2.00', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-04-12 18:30:55', '2019-04-12 18:56:37', NULL),
(99, 'blue@yopmail.com', '$2y$10$aWKbc3K93Wn/fEI3I5n.tOqAS.LLf3nmdwDo44MheInmtDwpNtXrq', 'Blue Bottle Cafe1', 'blue-bottle-cafe', '', 'Mr Blue White', 'BLU99', 'vender_1555075024.jpg', 'TGB Express Maninagar, Kankaria Lake, Ahmedabad, Punit Maharaj Road, Near, Kankaria, Maninagar, Ahmedabad, Gujarat, India', '380008', 'Ahmedabad', 'Gujarat', 'India', '23.004873', '23.004873', 'The most loved T20 cricket league in the world is here.The most loved T20 cricket league in the world is here.The most loved T20 cricket league in the world is here.The most loved T20 cricket league in the world is here.The most loved T20 cricket league in the world is here.The most loved T20 cricket league in the world is here.', '567 567 5656', '435 465 6576', '', '', '', '', '100.00', '01:00 AM', '12:30 AM', '1.00', '2.00', '2.00', '0', '567-56-7575', '1.30', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-04-12 18:43:27', '2019-04-13 19:49:58', NULL),
(100, 'suma@oviotechnologies.com', '$2y$10$qNgPOSO1HQOffft8tbQBRuy9yrcnZ44.49AI8MIQ301KLKUmF7lGq', 'Rovan', 'rovan', '', 'Suma', 'ROV100', 'vender_1555166687.png', '7017 Main St Parking, Main street, Houston, TX, USA', '77030', 'Harris County', 'Texas', 'United States', '29.7046166', '-95.405261', 'Pizza bread is a type of sandwich that is often served open-faced which consists of bread, tomato sauce, cheese and various toppings. ... Pizza sticks may be prepared with pizza dough and pizza ingredients, in which the dough is shaped into stick forms, sauce and toppings are added, and it is then baked.', '248 605 8831', '', '', '', '', '', '25.00', '12:00 PM', '09:00 AM', '2.00', '5.00', '10.00', '0,2', '123-23-4567', '5.00', 0, '', '', 3, 1, 1, 1, '', '', '', '2019-04-13 20:08:09', '2019-04-13 20:27:20', NULL),
(101, 'sunitha@oviotechnologies.com', '$2y$10$X1JpyBEPV9izoWtvoDMK.O44RlW95Pdl8Hf5BXn36j6.6XIrILNcq', 'Ice And Nice', 'ice-and-nice', '', 'Sunny', 'ICE101', 'vender_1555245583.jpg', '55, 2nd Main Road, Ramachandrapuram, S.S.I.Area, Dayananda Nagar, Rajaji Nagar, Bengaluru, Karnataka, India', '56002', 'Bangalore Urban', 'Karnataka', 'India', '12.9871134', '12.9871134', 'gfjhsdjdkfslgopskgoergioreigreigopwfpweopfodofwiofiuwhgijogksdopfaosfidsgiewhgisdjoffaspaofhgfjfgijgioiogewwigewiughwuihggjjiweefoewkofeopfeihhruiweoiweoiw', '997 643 2334', '456 788 9999', '', '', '', '', '10.00', '02:00 PM', '01:30 AM', '1.99', '2.00', '2.50', '0,1,2', '567-89-9900', '1.00', 0, '', '', 3, 1, 1, 1, '', '14d7b4a945de39f24369936dc6cbd9593f9f65f6', '', '2019-04-14 18:09:43', '2019-04-15 15:18:34', NULL);

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
(356, 68, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-08 10:17:57'),
(357, 68, 'Monday', '', '', 0, 1, '2019-02-08 10:17:57'),
(358, 68, 'Tuesday', '', '', 0, 1, '2019-02-08 10:17:57'),
(359, 68, 'Wednesday', '', '', 0, 1, '2019-02-08 10:17:57'),
(360, 68, 'Thursday', '', '', 0, 1, '2019-02-08 10:17:57'),
(361, 68, 'Friday', '', '', 0, 1, '2019-02-08 10:17:57'),
(362, 68, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-02-08 10:17:57'),
(391, 69, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-03-02 08:19:39'),
(392, 69, 'Monday', '', '', 0, 1, '2019-03-02 08:19:39'),
(393, 69, 'Tuesday', '', '', 0, 1, '2019-03-02 08:19:39'),
(394, 69, 'Wednesday', '', '', 0, 1, '2019-03-02 08:19:39'),
(395, 69, 'Thursday', '', '', 0, 1, '2019-03-02 08:19:39'),
(396, 69, 'Friday', '', '', 0, 1, '2019-03-02 08:19:39'),
(397, 69, 'Saturday', '', '', 0, 1, '2019-03-02 08:19:39'),
(454, 78, 'Sunday', '', '', 0, 1, '2019-03-25 04:55:52'),
(455, 78, 'Monday', '', '', 0, 1, '2019-03-25 04:55:52'),
(456, 78, 'Tuesday', '', '', 0, 1, '2019-03-25 04:55:52'),
(457, 78, 'Wednesday', '', '', 0, 1, '2019-03-25 04:55:52'),
(458, 78, 'Thursday', '', '', 0, 1, '2019-03-25 04:55:52'),
(459, 78, 'Friday', '', '', 0, 1, '2019-03-25 04:55:52'),
(460, 78, 'Saturday', '', '', 0, 1, '2019-03-25 04:55:52'),
(461, 79, 'Sunday', '', '', 0, 1, '2019-03-26 18:18:34'),
(462, 79, 'Monday', '', '', 0, 1, '2019-03-26 18:18:34'),
(463, 79, 'Tuesday', '', '', 0, 1, '2019-03-26 18:18:34'),
(464, 79, 'Wednesday', '', '', 0, 1, '2019-03-26 18:18:34'),
(465, 79, 'Thursday', '', '', 0, 1, '2019-03-26 18:18:34'),
(466, 79, 'Friday', '', '', 0, 1, '2019-03-26 18:18:34'),
(467, 79, 'Saturday', '', '', 0, 1, '2019-03-26 18:18:34'),
(482, 84, 'Sunday', '', '', 0, 1, '2019-04-02 05:16:14'),
(483, 84, 'Monday', '', '', 0, 1, '2019-04-02 05:16:14'),
(484, 84, 'Tuesday', '', '', 0, 1, '2019-04-02 05:16:14'),
(485, 84, 'Wednesday', '', '', 0, 1, '2019-04-02 05:16:14'),
(486, 84, 'Thursday', '', '', 0, 1, '2019-04-02 05:16:14'),
(487, 84, 'Friday', '', '', 0, 1, '2019-04-02 05:16:14'),
(488, 84, 'Saturday', '', '', 0, 1, '2019-04-02 05:16:14'),
(489, 85, 'Sunday', '', '', 0, 1, '2019-04-02 05:35:20'),
(490, 85, 'Monday', '', '', 0, 1, '2019-04-02 05:35:20'),
(491, 85, 'Tuesday', '', '', 0, 1, '2019-04-02 05:35:20'),
(492, 85, 'Wednesday', '', '', 0, 1, '2019-04-02 05:35:20'),
(493, 85, 'Thursday', '', '', 0, 1, '2019-04-02 05:35:20'),
(494, 85, 'Friday', '', '', 0, 1, '2019-04-02 05:35:20'),
(495, 85, 'Saturday', '', '', 0, 1, '2019-04-02 05:35:20'),
(615, 88, 'Sunday', '', '', 0, 1, '2019-04-08 05:54:41'),
(616, 88, 'Monday', '', '', 0, 1, '2019-04-08 05:54:41'),
(617, 88, 'Tuesday', '', '', 0, 1, '2019-04-08 05:54:41'),
(618, 88, 'Wednesday', '', '', 0, 1, '2019-04-08 05:54:41'),
(619, 88, 'Thursday', '', '', 0, 1, '2019-04-08 05:54:41'),
(620, 88, 'Friday', '', '', 0, 1, '2019-04-08 05:54:41'),
(621, 88, 'Saturday', '', '', 0, 1, '2019-04-08 05:54:41'),
(622, 92, 'Sunday', '', '', 0, 1, '2019-04-08 10:16:37'),
(623, 92, 'Monday', '', '', 0, 1, '2019-04-08 10:16:37'),
(624, 92, 'Tuesday', '', '', 0, 1, '2019-04-08 10:16:37'),
(625, 92, 'Wednesday', '', '', 0, 1, '2019-04-08 10:16:37'),
(626, 92, 'Thursday', '', '', 0, 1, '2019-04-08 10:16:37'),
(627, 92, 'Friday', '', '', 0, 1, '2019-04-08 10:16:37'),
(628, 92, 'Saturday', '', '', 0, 1, '2019-04-08 10:16:37'),
(664, 94, 'Sunday', '09:00 AM', '07:00 PM', 0, 0, '2019-04-09 14:33:35'),
(665, 94, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(666, 94, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(667, 94, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(668, 94, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(669, 94, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(670, 94, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-09 14:33:35'),
(678, 80, 'Sunday', '', '', 0, 1, '2019-04-09 10:51:19'),
(679, 80, 'Monday', '', '', 0, 1, '2019-04-09 10:51:19'),
(680, 80, 'Tuesday', '', '', 0, 1, '2019-04-09 10:51:19'),
(681, 80, 'Wednesday', '', '', 0, 1, '2019-04-09 10:51:19'),
(682, 80, 'Thursday', '', '', 0, 1, '2019-04-09 10:51:19'),
(683, 80, 'Friday', '', '', 0, 1, '2019-04-09 10:51:19'),
(684, 80, 'Saturday', '', '', 0, 1, '2019-04-09 10:51:19'),
(685, 95, 'Sunday', '', '', 0, 1, '2019-04-10 15:50:20'),
(686, 95, 'Monday', '', '', 0, 1, '2019-04-10 15:50:20'),
(687, 95, 'Tuesday', '', '', 0, 1, '2019-04-10 15:50:20'),
(688, 95, 'Wednesday', '', '', 0, 1, '2019-04-10 15:50:20'),
(689, 95, 'Thursday', '', '', 0, 1, '2019-04-10 15:50:20'),
(690, 95, 'Friday', '', '', 0, 1, '2019-04-10 15:50:20'),
(691, 95, 'Saturday', '', '', 0, 1, '2019-04-10 15:50:20'),
(720, 96, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(721, 96, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(722, 96, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(723, 96, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(724, 96, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(725, 96, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(726, 96, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-11 20:12:58'),
(727, 97, 'Sunday', '', '', 0, 1, '2019-04-12 05:43:28'),
(728, 97, 'Monday', '', '', 0, 1, '2019-04-12 05:43:28'),
(729, 97, 'Tuesday', '', '', 0, 1, '2019-04-12 05:43:28'),
(730, 97, 'Wednesday', '', '', 0, 1, '2019-04-12 05:43:28'),
(731, 97, 'Thursday', '', '', 0, 1, '2019-04-12 05:43:28'),
(732, 97, 'Friday', '', '', 0, 1, '2019-04-12 05:43:28'),
(733, 97, 'Saturday', '', '', 0, 1, '2019-04-12 05:43:28'),
(755, 98, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:34:43'),
(756, 98, 'Monday', '', '', 0, 1, '2019-04-12 18:34:43'),
(757, 98, 'Tuesday', '', '', 0, 1, '2019-04-12 18:34:43'),
(758, 98, 'Wednesday', '', '', 0, 1, '2019-04-12 18:34:43'),
(759, 98, 'Thursday', '', '', 0, 1, '2019-04-12 18:34:43'),
(760, 98, 'Friday', '', '', 0, 1, '2019-04-12 18:34:43'),
(761, 98, 'Saturday', '10:30 AM', '05:00 PM', 0, 0, '2019-04-12 18:34:43'),
(769, 99, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(770, 99, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(771, 99, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(772, 99, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(773, 99, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(774, 99, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-12 18:47:04'),
(775, 99, 'Saturday', '', '', 0, 1, '2019-04-12 18:47:04'),
(797, 52, 'Sunday', '', '', 1, 0, '2019-04-13 10:43:58'),
(798, 52, 'Monday', '12:00 AM', '10:30 AM', 0, 0, '2019-04-13 10:43:58'),
(799, 52, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 10:43:58'),
(800, 52, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 10:43:58'),
(801, 52, 'Thursday', '', '', 1, 0, '2019-04-13 10:43:58'),
(802, 52, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 10:43:58'),
(803, 52, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 10:43:58'),
(818, 100, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(819, 100, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(820, 100, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(821, 100, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(822, 100, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(823, 100, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(824, 100, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-13 20:14:47'),
(825, 58, 'Sunday', '', '', 1, 0, '2019-04-14 03:17:48'),
(826, 58, 'Monday', '', '', 1, 0, '2019-04-14 03:17:48'),
(827, 58, 'Tuesday', '', '', 1, 0, '2019-04-14 03:17:48'),
(828, 58, 'Wednesday', '', '', 1, 0, '2019-04-14 03:17:48'),
(829, 58, 'Thursday', '', '', 1, 0, '2019-04-14 03:17:48'),
(830, 58, 'Friday', '', '', 1, 0, '2019-04-14 03:17:48'),
(831, 58, 'Saturday', '', '', 1, 0, '2019-04-14 03:17:48'),
(839, 101, 'Sunday', '09:00 AM', '11:00 PM', 0, 0, '2019-04-14 19:05:16'),
(840, 101, 'Monday', '09:00 AM', '11:00 PM', 0, 0, '2019-04-14 19:05:16'),
(841, 101, 'Tuesday', '09:00 AM', '11:30 PM', 0, 0, '2019-04-14 19:05:16'),
(842, 101, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-14 19:05:16'),
(843, 101, 'Thursday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-14 19:05:16'),
(844, 101, 'Friday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-14 19:05:16'),
(845, 101, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-14 19:05:16'),
(846, 86, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-15 10:58:33'),
(847, 86, 'Monday', '12:00 AM', '05:00 PM', 0, 0, '2019-04-15 10:58:33'),
(848, 86, 'Tuesday', '', '', 1, 0, '2019-04-15 10:58:33'),
(849, 86, 'Wednesday', '', '', 0, 1, '2019-04-15 10:58:33'),
(850, 86, 'Thursday', '', '', 0, 1, '2019-04-15 10:58:33'),
(851, 86, 'Friday', '09:00 AM', '11:30 PM', 0, 0, '2019-04-15 10:58:33'),
(852, 86, 'Saturday', '09:00 AM', '05:00 PM', 0, 0, '2019-04-15 10:58:33');

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
(94, 69, 9),
(148, 94, 9),
(149, 94, 18),
(158, 96, 1),
(159, 96, 9),
(162, 98, 4),
(163, 98, 9),
(164, 99, 18),
(170, 52, 3),
(171, 52, 7),
(174, 100, 18),
(175, 58, 1),
(176, 58, 3),
(177, 101, 7),
(178, 101, 20),
(179, 86, 3);

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
(25, 68, 2, 1, '05:30 AM', '11:30 AM'),
(26, 68, 2, 2, '02:30 PM', '10:30 PM'),
(35, 69, 2, 1, '07:00 AM', '12:30 PM'),
(36, 69, 2, 2, '02:00 PM', '11:30 PM'),
(97, 94, 2, 1, '', ''),
(98, 94, 2, 2, '', ''),
(107, 96, 2, 1, '', ''),
(108, 96, 2, 2, '', ''),
(113, 98, 2, 1, '', ''),
(114, 98, 2, 2, '', ''),
(115, 99, 2, 1, '', ''),
(116, 99, 2, 2, '', ''),
(123, 52, 2, 1, '', ''),
(124, 52, 2, 2, '', ''),
(127, 100, 2, 1, '', ''),
(128, 100, 2, 2, '', ''),
(129, 58, 2, 1, '', ''),
(130, 58, 2, 2, '', ''),
(131, 101, 2, 1, '', ''),
(132, 101, 2, 2, '', ''),
(133, 86, 2, 1, '', ''),
(134, 86, 2, 2, '', '');

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
(1, 'Cafe@eww.com', 'The Esplendido Cafe', 'Hynes Convention Center, Boston, MA, USA', '774587146677', 'am trying to format numbers in chartjs chart. I am getting this error on my console and the numbers are not visible on the chart', '2019-02-20 06:55:07', NULL, NULL),
(3, 'developer.eww@gmail.com', 'Eww decvv', 'Nikol bapunagar', '9865321245', 'This is the test', '2019-03-08 13:19:34', NULL, NULL),
(4, ' binal.nasit26@gmail.com', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-14 14:07:30', NULL, '2019-03-25 15:49:16'),
(5, ' binal.nasit26@gmail.comz', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:21:30', NULL, '2019-03-27 06:19:57'),
(6, 'rahul.bbit@gmail.com', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:25:10', NULL, '2019-03-27 05:05:33'),
(7, 'rahul.bbit@gmail.comz', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:54:27', NULL, '2019-03-15 06:09:27'),
(8, 'rahul.bbit@gmail.comb', ' Dr Pizza', ' Surat', ' 7567827928', '', '2019-03-15 06:23:01', NULL, '2019-03-23 11:10:25'),
(9, 'Bombaytawa@gmail.com', 'BombaY Tawa', '6754 Ford Road, Canotn MI', '734 567 8989', '', '2019-03-26 16:40:42', NULL, '2019-03-26 23:57:07'),
(10, 'suma@oviotechnologies.com', 'BombaY Tawa', '43433 Cherrywood lane', '248 522 9427', '', '2019-03-26 18:12:49', NULL, '2019-03-26 23:47:15'),
(11, 'jimy@excellentwebworld.in', 'Mayur\\\'s Cafe', '203-206, City Center, Opp Sukan Mall, Science City Road, Sola, Ahmedabad', '999 999 8880', 'I want to register in your system as I like yor system', '2019-04-02 12:18:57', NULL, NULL);

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
(3, 'test@yopmail.com', '2019-02-22 07:01:29'),
(4, 'vinodkummar60@gmail.com', '2019-03-26 17:24:41'),
(5, 'suma@oviotechnologies.com', '2019-03-27 01:22:42'),
(6, 'hhh@gg.ll', '2019-03-27 11:20:52'),
(7, 'hey_test@mailinator.com', '2019-04-01 05:30:58'),
(8, 'clicklunch24@gmail.com', '2019-04-02 05:26:24'),
(9, 'developer.eww@gmail.com', '2019-04-05 09:25:16'),
(10, 'lol6@mailinator.com', '2019-04-11 06:04:59'),
(11, 'shivam@mailinator.com', '2019-04-11 06:08:34'),
(12, 'admin@tickpay.com', '2019-04-11 09:58:04'),
(13, 'dhrumi@gmail.com', '2019-04-14 17:32:24');

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
(7, 52, 'Topping', 1, 0, '2019-02-27 06:15:24', NULL, '2019-02-27 06:15:24'),
(8, 52, 'Fries', 0, 0, '2019-02-27 06:15:30', NULL, '2019-02-27 06:15:30'),
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
(20, 58, 'Jain Prepration', 0, 1, '2019-02-22 05:28:26', NULL, NULL),
(21, 52, 'Crust', 0, 1, '2019-02-27 06:17:16', NULL, NULL),
(22, 52, 'Sizes', 0, 1, '2019-02-27 06:17:38', NULL, NULL),
(23, 52, 'Extra Toppings', 1, 0, '2019-02-27 06:18:26', NULL, NULL),
(24, 58, 'Sauce', 1, 0, '2019-04-05 15:46:14', NULL, NULL),
(25, 86, 'Topping', 1, 1, '2019-04-05 17:41:49', NULL, NULL),
(26, 94, 'Large', 1, 0, '2019-04-08 23:13:19', NULL, NULL),
(27, 94, 'Medium', 0, 1, '2019-04-08 23:38:36', NULL, NULL),
(28, 94, 'Small', 0, 0, '2019-04-08 23:39:30', NULL, NULL),
(29, 86, 'Jain Prepration', 0, 1, '2019-04-09 16:27:24', NULL, NULL),
(30, 96, 'Extra Cream', 1, 1, '2019-04-12 00:02:56', NULL, NULL),
(31, 100, 'Cheese', 0, 0, '2019-04-13 20:21:15', NULL, NULL),
(32, 100, 'Extra Vegetables', 1, 0, '2019-04-13 20:21:40', NULL, NULL),
(33, 101, 'Small', 0, 1, '2019-04-14 13:14:53', NULL, '2019-04-14 18:44:53'),
(34, 101, 'Small,Medium,Large', 1, 1, '2019-04-14 18:45:56', NULL, NULL);

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
(45, 17, 'Normal', 31, '10', '2019-01-17 11:02:02'),
(46, 17, 'Double', 31, '20', '2019-01-17 11:02:02'),
(47, 18, 'small packet', 31, '10', '2019-01-17 11:02:02'),
(48, 18, 'large packet', 31, '20', '2019-01-17 11:02:02'),
(77, 7, 'All', 25, '20', '2019-02-25 05:25:23'),
(78, 7, 'tomato', 25, '2', '2019-02-25 05:25:23'),
(79, 8, 'small', 25, '3', '2019-02-25 05:25:23'),
(80, 8, 'med', 25, '5', '2019-02-25 05:25:23'),
(102, 22, 'Large', 33, '10', '2019-02-27 06:32:23'),
(103, 22, 'regular', 33, '0', '2019-02-27 06:32:23'),
(105, 22, 'Cheese', 20, '10.80', '2019-04-04 16:11:56'),
(106, 22, 'ggg', 20, '2.30', '2019-04-04 16:11:56'),
(107, 22, 'Small', 20, '3.00', '2019-04-04 16:11:56'),
(108, 22, 'Med', 20, '5.00', '2019-04-04 16:11:56'),
(111, 12, 'Chille', 27, '1.00', '2019-04-05 15:04:59'),
(112, 12, 'Anchovies', 27, '2.00', '2019-04-05 15:04:59'),
(113, 12, 'Rockt', 27, '2.00', '2019-04-05 15:04:59'),
(114, 19, 'Single', 27, '2.00', '2019-04-05 15:04:59'),
(115, 19, 'Double', 27, '3.00', '2019-04-05 15:04:59'),
(116, 16, 'Coke', 27, '6.00', '2019-04-05 15:04:59'),
(117, 16, 'Pepsi', 27, '6.50', '2019-04-05 15:04:59'),
(118, 20, 'Yes', 27, '0.00', '2019-04-05 15:04:59'),
(119, 20, 'No', 27, '0.00', '2019-04-05 15:04:59'),
(120, 12, 'Honey', 36, '10', '2019-04-05 15:20:23'),
(121, 16, 'ff', 37, '8', '2019-04-05 15:21:56'),
(122, 15, 'Add', 41, '10', '2019-04-05 16:12:43'),
(125, 25, 'cheese', 42, '10.00', '2019-04-05 17:47:37'),
(161, 21, 'New Hand Tossed', 32, '0.00', '2019-04-09 14:29:20'),
(162, 21, 'Wheat Thin Crust', 32, '5.00', '2019-04-09 14:29:20'),
(163, 21, 'Cheese Burst', 32, '10.00', '2019-04-09 14:29:20'),
(164, 21, 'Fresh Pan Pizza', 32, '5.00', '2019-04-09 14:29:20'),
(165, 21, ' Classic Hand Tossed', 32, '5.00', '2019-04-09 14:29:20'),
(166, 22, 'Medium', 32, '50.00', '2019-04-09 14:29:20'),
(167, 22, 'Regular ', 32, '0.00', '2019-04-09 14:29:20'),
(168, 23, 'Extra Cheese', 32, '10.00', '2019-04-09 14:29:20'),
(169, 23, 'Black Olive', 32, '2.00', '2019-04-09 14:29:20'),
(170, 23, 'Onion', 32, '2.00', '2019-04-09 14:29:20'),
(171, 23, 'Crisp Capsicum', 32, '2.00', '2019-04-09 14:29:20'),
(172, 23, 'Paneer', 32, '2.00', '2019-04-09 14:29:20'),
(173, 23, 'Grilled Mushroom', 32, '2.00', '2019-04-09 14:29:20'),
(174, 23, 'Golden Corn', 32, '2.00', '2019-04-09 14:29:20'),
(175, 23, 'Fresh Tomato', 32, '2.00', '2019-04-09 14:29:20'),
(176, 23, 'Jalapeno', 32, '2.00', '2019-04-09 14:29:20'),
(180, 29, 'Yes', 43, '0.00', '2019-04-09 16:34:30'),
(181, 29, 'No', 43, '0.00', '2019-04-09 16:34:30'),
(182, 30, 'Small', 50, '1.00', '2019-04-12 00:03:41'),
(185, 25, 'Sauces', 54, '2.00', '2019-04-12 11:22:54'),
(186, 25, 'Cheese', 54, '5.00', '2019-04-12 11:22:54'),
(187, 25, 'Extra Choco', 55, '2.5', '2019-04-12 11:25:34'),
(188, 25, 'Chocos', 44, '10.00', '2019-04-12 12:10:31'),
(189, 25, 'Extra flexs', 44, '10.00', '2019-04-12 12:10:31'),
(190, 31, 'Mozarella', 58, '2', '2019-04-13 20:22:57'),
(191, 32, 'Pineapple', 57, '1.00', '2019-04-13 20:24:22'),
(192, 32, 'Olives', 57, '1.00', '2019-04-13 20:24:22'),
(193, 32, 'Green pepper', 57, '2', '2019-04-13 20:24:22'),
(194, 24, 'Tomato', 62, '1.00', '2019-04-13 21:11:21'),
(195, 19, 'Mozarella', 62, '1.00', '2019-04-13 21:11:21'),
(196, 19, 'American', 62, '2', '2019-04-13 21:11:21');

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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
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
-- Indexes for table `delivery_address_popular_request`
--
ALTER TABLE `delivery_address_popular_request`
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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `customer_payment_card`
--
ALTER TABLE `customer_payment_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `delivery_address_popular_request`
--
ALTER TABLE `delivery_address_popular_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `delivery_dispatcher`
--
ALTER TABLE `delivery_dispatcher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT for table `order_item_variant`
--
ALTER TABLE `order_item_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1029;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `promocode_products`
--
ALTER TABLE `promocode_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `promocode_shops`
--
ALTER TABLE `promocode_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `promocode_valid_product`
--
ALTER TABLE `promocode_valid_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `shop_availibality`
--
ALTER TABLE `shop_availibality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=853;

--
-- AUTO_INCREMENT for table `shop_cuisines`
--
ALTER TABLE `shop_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `shop_hours`
--
ALTER TABLE `shop_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `shop_request`
--
ALTER TABLE `shop_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `variant_group`
--
ALTER TABLE `variant_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `variant_items`
--
ALTER TABLE `variant_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
