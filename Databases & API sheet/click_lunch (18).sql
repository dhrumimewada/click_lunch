-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2019 at 12:54 PM
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
(6, 'DullRat@mailinator.com', '$2y$10$s5xq4SSBkVvXZow/pR6f9.mNUDyTNaonrZSsLwjTNPI27tahx3ASO', 'customer_1546514755.jpg', 'Dhrumi SS', 'city center 2, science city', '8866541254', '1996-02-14', '', 0, '', 0, '', 1, '2019-01-03 06:55:55', '2019-01-22 07:36:53', NULL, '1', '42.34797469999999', '-71.08792840000001', '995e6926a53e0f52141048894f2c11324eb373c4', '', 1, 1, 1),
(25, 'PieThunder@mailinator.com', '$2y$10$TJ0cFGhfYRvD.9OSimFFAekIE4ZLFHiUi0SKaZmemq4p9fGp1m7BG', 'customer_1548150942.jpg', 'Dhrumi SS', 'Dallas-Fort Worth Metropolitan Area, TX, USA', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', 0, '', 1, '2019-01-09 01:35:17', '2019-01-22 09:55:42', NULL, '1', '121212', '1212154', 'f59c153f1b0653cd0b04228d133252259d027c74', '', 0, 1, 1),
(32, 'vinodkummar@yahoo.com', '$2y$10$qwBontvpGvQkgoMmf7zhKO.wZj1htnE0rUHE4bMvUOxuQ2MjPQbme', 'customer_1547811554.jpg', 'Vinodkummar', '#5,1 floor,1 main road,rama chandra pura', '900 859 9119', '2001-01-08', '', 0, '', 0, '', 1, '2019-01-14 07:22:20', '2019-01-17 10:29:52', NULL, '0', '', '', '', '', 1, 1, 1),
(33, 'developer.eww@gmail.com', '$2y$10$aa.zH3/GXVhn4BNskycVWu0iRr3Xw2rYLTz1g5hdplV6Y95buGuFu', 'customer_1551337791.jpg', 'Mayur Two', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '333-222-1111', '2000-12-08', '', 0, 'e3F1-dW5MF8:APA91bFpQ8DIhg_s5UFg8rRER1m7cyYdrDfUunMtJPfiF36p2Yz_xfHYVjDtKc2c9JyrxWdzVY-t1m22NdiUshR9OU1kbBHIwIEp_Pm1k2LdB149KHbpw-_a7bE7Ytk9EyZtqr0PrXSm', 0, '', 1, '2019-01-21 11:40:41', '2019-03-08 05:39:28', NULL, '0', '23.072739', '72.5162995', 'b660c73941cee4ed06cb455cc620be5d0eb40a94', '', 1, 1, 0),
(34, 'RhymePaladin@mailinator.com', '$2y$10$0LU.1X2e9RFtwmuRj7u2NeO1TlLB4UHPL3fw5PicVJVQLixo0eCT2', '', 'Paladin', '', '8866541254', '1996-02-14', '', 1, 'hjhjkhjkhjkhkj', 0, '', 0, '2019-01-23 11:37:07', NULL, NULL, '1', '13.666', '66.3333333', '', '487a25ca64324b9504fc260da580f06938197cb5', 1, 1, 1),
(35, 'Rehan@gmail.com', '$2y$10$ZrD6PhBniRrXQBr8rJ/K1./4RvOPNExosmqA8owjy/7GuYPXW8OoK', 'customer_1548679677.jpeg', 'Rehan Hussein', '', '989898989898', '2019-01-28', '', 0, 'adsdasddasd', 0, '', 1, '2019-01-28 08:59:31', '2019-03-02 08:49:49', NULL, '0', '121212', '1212154', '', '', 0, 1, 0),
(36, 'pooja@excellentwebworld.in', '$2y$10$lmY8XIuPSNGwDoxNHjwFd.XsfXeS.Q9KHOm0PSciYzx5H/5BvSsjS', 'customer_1551427005.jpg', 'Pooja', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '2019-03-30', '', 0, 'fAQoL84MV60:APA91bGFDEWSxdbWd2kFlGi2iSzBW2k-PcxeRUoj3Q2H3_yghSi6bcDzqmbVUKnGJxi9_ec5fp30dL6fI7hY76FZV1XoZNB_NKQcb185tSoQuq4zyM2a3sZ6IoNIcybybMyQwoeK27JO', 0, '', 1, '2019-03-01 06:14:02', '2019-03-02 07:03:35', NULL, '1', '23.0727509', '72.5163357', '', '', 1, 1, 1),
(37, 'developer.eww2@gmail.com', '$2y$10$kf5slIKW6A0.9bhyi/jFW.9gmM90RdZADh5jLPlr9JJfKNpM5jLzu', '', 'Mayur', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '111-111-1111', '1996-12-12', '', 0, 'ej1d0qJEZsU:APA91bGBLPdUqLEMJaDUYAs0o27Vu7JLLa3rStanyp2RZn8NZwEncRRNTegQvap7YfU3IwZ_3GnAM-qGbmlhX9dHb2Wzx6WXFvSB5csgCbnHcLGINEbBcskGM8NIs_DhkNNh6LBTw_BB', 0, '', 1, '2019-03-01 06:20:34', NULL, NULL, '0', '23.0727664', '72.5163406', '', '', 1, 1, 1),
(38, 'developer.ewweww2@gmail.com', '$2y$10$GbJgiU7VHBgoHOaL5JRq4O3G3Z47f5KUWpWO3mGpcjUPlIx953j06', '', 'Saurav', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '111-111-1111', '1996-12-12', '', 0, 'ej1d0qJEZsU:APA91bGBLPdUqLEMJaDUYAs0o27Vu7JLLa3rStanyp2RZn8NZwEncRRNTegQvap7YfU3IwZ_3GnAM-qGbmlhX9dHb2Wzx6WXFvSB5csgCbnHcLGINEbBcskGM8NIs_DhkNNh6LBTw_BB', 0, '', 0, '2019-03-01 06:37:32', NULL, NULL, '0', '23.0727664', '72.5163406', '', '9fc031ca9c43028a29a6d1e16d8bafcc65f52c07', 1, 1, 1),
(39, 'dianahedlund123@gmail.com', '$2y$10$.u67p3.xpo5M33.WK4/kkuMfsMgTHAZhgSBhJ/wQ1P/Yx/6T7hzrO', '', 'Pooja', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '1994-12-25', '', 0, 'fAQoL84MV60:APA91bGFDEWSxdbWd2kFlGi2iSzBW2k-PcxeRUoj3Q2H3_yghSi6bcDzqmbVUKnGJxi9_ec5fp30dL6fI7hY76FZV1XoZNB_NKQcb185tSoQuq4zyM2a3sZ6IoNIcybybMyQwoeK27JO', 0, '', 1, '2019-03-01 06:48:38', NULL, NULL, '1', '23.07275', '72.5163385', '', '', 1, 1, 1),
(40, 'r@r.com', '$2y$10$vWn4yoO9j80noylM8SmeJ.W0Enui99kvfTJvqof9WP0V0J6xPep5m', '', 'rj381', 'Sarvanad Society Opp. Ramdev Mandir, 14, CIMS Hospital Road, Ahmedabad, Gujarat 380060, India', '999-999-9999', '2019-03-01', '', 0, 'af8b52580c7e6f275ba5f99dd45d4881428e5b2e479fcbdc8c6a1c3f063f2442', 0, '', 0, '2019-03-01 12:09:57', NULL, NULL, '0', '23.07094709289872', '72.51622031254746', '', '5b73e1486c470f37e7a297b6d9576b0867bd3e2e', 1, 1, 1),
(41, 'r@t.com', '$2y$10$PS0p2rCqnWCJdPdAIKhFGOquXaFOOK4Tnc0yDWoj98WdBk2sahG1y', '', 'rj381', 'Science City Rd, Sola, Ahmedabad, Gujarat 380059, India', '999-999-9999', '2019-03-01', '', 0, 'd6qLopAf8Qw:APA91bEbZnJLZYnRV2zisLEpJARvKJmKdybVblsm3Y2g5z_FEPx0ZwqJAZsh7bVrJ37P__7ADEVG6jZoFDNKDqqMv_e3NeYk8Tagu8LchO_efv-WZXLiFBvdA7JtQiCDTDKFZkZ5NoD8', 0, '', 1, '2019-03-01 12:14:11', NULL, NULL, '0', '23.0727523', '72.5163233', '', '', 1, 1, 1),
(42, 'poojapanchal8512@gmail.com', '$2y$10$vbHV9Y2VbzhXyN7geFat5.ICRVq1mo6qa.Ed1.lPOuJgPi12Xdkk2', '', 'Alice', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '777-807-5528', '2019-04-19', '', 0, 'fAQoL84MV60:APA91bGFDEWSxdbWd2kFlGi2iSzBW2k-PcxeRUoj3Q2H3_yghSi6bcDzqmbVUKnGJxi9_ec5fp30dL6fI7hY76FZV1XoZNB_NKQcb185tSoQuq4zyM2a3sZ6IoNIcybybMyQwoeK27JO', 0, '', 1, '2019-03-04 05:31:21', NULL, NULL, '1', '23.07275', '72.5163385', '', '', 1, 1, 1),
(43, 'dhrumi_cl@mailinator.com', '$2y$10$0fLYzRKhLakLC.OhZcQEyeW5wGLhcmTxex7xTkkYg8n7KxfEEDYky', '', 'Dhrumi Mewada', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '886-658-0502', '2015-02-01', '', 0, 'dvhmaXXa9OY:APA91bEWtwXyhYdcWERiXbLsMSv8UMmK_ZJ1qAjxydeMQUgFDRzZXkHxl8oI0Ww4d4bpIetX4VmdQzWD7rD6-S6TR8pOOIWb8MltRF6P8djOL3lE45Gb5zr0-9ceyALIZrCL279cEJEE', 0, '', 1, '2019-03-05 07:05:35', NULL, NULL, '1', '23.0727445', '72.5163463', '', '', 1, 1, 1),
(44, 'BoogerDanger12@mailinator.com', '$2y$10$rbOqEIZxgXl7scZsYYoYneMJfX5voBiFFbRRxy9dUZGqQCiB7udn.', '', 'BoogerDanger test', '', '774 587 1458', '2019-03-05', '', 0, '', 0, '', 1, '2019-03-06 13:55:05', NULL, NULL, '0', '', '', '', '51189b74c7d0a99a7ee15977e958f280fdc5bd4b', 1, 1, 1),
(45, 'sunvenk04@gmail.com', '$2y$10$bklAotvLCfBcT7eCblTVoO.MG2YZwl.SX3exRjiUBuPCLauvJ7may', '', 'Sunitha', '25, 1st Cross Rd, Prakash Nagar, Rajaji Nagar, Bengaluru, Karnataka 560021, India', '990-236-6824', '1980-03-24', '', 0, 'cYJ9POWMV0U:APA91bF0ePsXE1bhJziPciKR1lH0-DxPz5_qd4InH8Ox3ICg5Qq7gEY1dv1ijjKoltoBCaxSGMJFGd06sBaqqljWK6HkrpuxVBcNhA9B0M9mldIv_HSSqrt8jvDOJAJ_cWpO0xhGRryz', 0, '', 1, '2019-03-07 02:27:30', '2019-03-15 08:26:14', NULL, '1', '12.9873504', '77.5634626', '', '', 1, 1, 0),
(46, 'kv@excellentwebworld.com', '$2y$10$LJmuYJ5WDcYFPsVyxrQr/eVyuH9yrqxEQH7vknl.K8nTAQUQfer.u', '', 'kvpatel', '', '999 835 9464', '1991-09-12', '', 0, '', 0, '', 1, '2019-03-07 12:06:20', NULL, NULL, '0', '', '', '', '', 1, 1, 1),
(47, 'Belgians123@mailinator.com', '$2y$10$88QTuFa/NeNLP4EwQYRdzOP9Fe8DuMZrbwOeoK9YLCFVzQMpbmChi', '', 'Belgians', '', '565 655 6545', '2019-03-03', '', 0, '', 0, '', 1, '2019-03-07 13:44:53', NULL, NULL, '1', '', '', '', '', 1, 1, 1),
(48, 'cl_customer@yopmail.com', '$2y$10$ls/3kHi7dW4Q93luykOjlenvb8UAGOUs1txLjV7lyKZH2HbvdeIpq', 'customer_1552312125.jpg', 'Cl Customer', '', '775 765 8768', '2019-03-04', '', 1, 'fqIMGxz0PQg:APA91bEVujgp8ZCvd9Z-zJAa4PExqGOHTjoSocDvE1ASqA_0tARPjUuC4yhRv-F15WsWfsB8kMqhMmonO2fY1mcdAwJwwG_uXSnkYsMO4jtptA2KQJpc1jLBqYa2GHxmAbpinFgtMakB', 0, '', 1, '2019-03-07 14:02:05', '2019-03-11 13:48:45', NULL, '0', '', '', '', '', 1, 1, 1),
(49, 'binal.nasit26@gmail.com', '$2y$10$yg8./q64sf4xCVYSN4NBz.orJB1QOLs0NzJgK3pDDjR3YhKQjqYem', '', ' binal', '', '7878616496', '0000-00-00', '', 0, 'f.bfdb', 1, ' ', 0, '2019-03-14 06:14:50', NULL, NULL, '1', '45.2356 ', '45.2365', '', '411a00341c7a68e64048edd852d16ef271738e38', 1, 1, 1),
(50, 'bhavesh@excellentwebworld.info', '$2y$10$x1n/fZV/zohKHIX2Vb5mTeGZMIBmWuOgghAIGt0LbVLES9m51H3Om', '', ' binal', '', '7878616495', '0000-00-00', '', 0, ' ughujhiki', 1, ' ', 1, '2019-03-14 06:20:52', NULL, NULL, '1', '16.051253', ' 20.1223', '', '', 1, 1, 1),
(51, 'binal.nasit@gmaill.co', '$2y$10$YWfoGaiBgJK4a1xARDfnduTESozRmnz8.XxBle7auW7/FBxwNd4AG', '', 'bcvbn', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '7878616)^^()$(;$,($', '0000-00-00', '', 0, '1234', 1, '1', 0, '2019-03-14 07:29:31', NULL, NULL, '1', '23.07269989776014', '72.5163995307786', '', '24834607ba023ebf2036d45d9e4079cfcbb60ed1', 1, 1, 1),
(52, ' Rahul.bbit@gmail.com', '$2y$10$PYEY5QAJf.0Lsldbed0msuymOS.nvPwYgQRUUq/7gCvmbRVVgAjqG', '', ' rahul', '', ' 789067890', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:39:08', NULL, NULL, ' ', ' 23.07271914349111', ' 72.51635833381914', '', '', 1, 1, 1),
(53, ' rahul.bbit@gmail.comz', '$2y$10$3KnB665IcexMEQ5t0e/yLOs8FLFi.vxIpttKfX0pD5Wa7dcmYt6j2', '', ' rahul', '', ' 789067890z', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:39:33', NULL, NULL, ' ', ' 23.07271914349111', ' 72.51635833381914', '', '', 1, 1, 1),
(54, ' binal1@gmail.co', '$2y$10$fEZ9kW6Qin07rqn65LOFpu5kIp/SUc3nBeDkgYXYZIkDHFpeiOdmS', '', ' rahul', '', ' 789067890)5', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:43:44', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(55, ' acns@gmail.com', '$2y$10$wLf5xGSS3ALZxPO5IGiX7eowIrhJL1SvTKW6Y97nO93Tw/XYLaPVK', '', ' rahul', '', ' 7890678967', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:44:36', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(56, ' ravi@excellentwebworld.info', '$2y$10$gHMzQ1iIUYnYFrcAkCjwBO7R3X.Qk2HvkNafUgeOp55oMAXXWM4CC', '', ' rahul', '', ' 7890678562', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:45:02', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(57, ' ravi@excellentweb.com', '$2y$10$h5XKCUElxpWwpmUHmcujFelT/xxi87V78eH7PP1ZR7V7FqfwiR9bK', '', ' rahul', '', ' 78906789652', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:45:56', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(58, 'binal.nasit26@gmail.comq', '$2y$10$7Yr8MRklL8mG9nWfG55Md.vp.nZokObKSQi9quae3fnufD4kaAE8G', '', ' rahul', '', ' 7890678999652', '0000-00-00', '', 0, ' 1234', 1, ' ', 0, '2019-03-14 07:46:42', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '08e0909fcec596c1dced2dde72179354d73df9dd', 1, 1, 1),
(59, 'Rahul.eww@gmail.vom', '$2y$10$cELOe4fAF3zyMxq7VRFYqOnRwU2vkc/yYN238mnAXl/kmu0.QnBOK', '', 'rahul ', '208 Siya Info sundram arcate, Sola, Ahmedabad, Gujarat 380060, India', '787879889^9', '0000-00-00', '', 0, '1234', 21, '2', 0, '2019-03-14 07:50:40', NULL, NULL, '1', '23.07267730888438', '72.51642493032185', '', '0100ce93520df4569fa85be8dcd6ada8bb0381a8', 1, 1, 1),
(60, 'binal.excellentwebworld.info', '$2y$10$JseZGvNcsq9pgKL9gtMIcuO3IQFhbX0r2BLEBnDmgA9227NP0/q7S', '', ' rahul', '', ' 7890678999', '0000-00-00', '', 0, ' 1234', 16, ' ', 0, '2019-03-14 07:54:32', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '', 1, 1, 1),
(61, 'raji@excellentwebworld.info', '$2y$10$qpUzXhXPAmI.W53IR3vBXO30rP9eySQPrytArZ56RBj.AiDN0SJjq', '', ' rahul', '', ' 78906789997', '0000-00-00', '', 0, ' 1234', 168, ' ', 0, '2019-03-14 07:56:54', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', 'f3c6a4f0a1507b82c5b0e780a7bb174b51809bd8', 1, 1, 1),
(62, 'raju@excellentwebworld.info', '$2y$10$yG4ZHEyjB9x8pKrWG4CYuuly/KSIQZZDbD9OkbiVfNPyGHRfMnNAO', '', ' rahul', '', ' 789067899976', '0000-00-00', '', 0, ' 1234', 1688, ' ', 0, '2019-03-14 07:57:11', NULL, NULL, ' ', ' 23.07275994966755', ' 72.51635100537418', '', '5f9b0f8041719b5bd28167312103dbbf76aceadd', 1, 1, 1),
(63, 'raju.gupta@excellentwebworld.in', '$2y$10$UWvAYGjDtD1y.5M/RFAgluen5/IvU.UDwnK4U7P3mVsv.Jyj36Cou', 'customer_1552565735.jpg', ' rahul', '', '7878616496', '0000-00-00', '', 0, ' ughujhiki', 1688, ' ', 1, '2019-03-14 07:59:31', '2019-03-14 12:15:35', NULL, '1', '16.051253', ' 20.1223', '', '', 1, 1, 1);

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
(27, 33, 'mayut', 'ZqenpXhjZGemoqRwYWJo', 'XXXX XXXX XXXX 0005', 'Y6aepXBiaw==', 'ZqOi', '', 3, '2019-02-28 08:56:08', NULL, NULL),
(28, 33, 'mayut', 'Z6KhpXJjZGWioaVyY2Rlog==', 'XXXX XXXX XXXX 2222', 'Y6aepXBiaw==', 'ZqOi', '', 1, '2019-02-28 08:56:29', NULL, '2019-02-28 09:15:09'),
(29, 33, 'ufuf', 'aKGfqHFhZ2SgpKRwZmNjoA==', 'XXXX XXXX XXXX 5100', 'Y6OepXBiaw==', 'ZaKh', '', 2, '2019-02-28 09:04:05', NULL, '2019-02-28 09:14:51'),
(30, 33, 'ufuf', 'Z6KjpXRjZmWkoadyZWRnog==', 'XXXX XXXX XXXX 4242', 'Y6eepXBiaw==', 'Zqao', 'jin', 1, '2019-02-28 09:15:44', NULL, NULL),
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
(41, 45, 'shubxjfj', 'aKOirHdqamympal2amhrpg==', 'XXXX XXXX XXXX 9686', 'Y6OepXBiaw==', 'aKan', 'ghsh', 2, '2019-03-13 10:18:18', NULL, NULL);

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
(34, 36, 0, 0, 'ahmedabad', 'ahmedabad', 'ahmedabad', '12345', '23.022505', '72.5713621', 'test', '3', 'test', '2019-03-04 04:50:17', NULL, NULL),
(35, 36, 0, 0, 'ahmedabad', 'ahmedabad', 'ahmedabad', '12345', '23.022505', '72.5713621', 'test', '2', 'test', '2019-03-14 13:44:51', NULL, NULL),
(36, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-03-14 14:14:32', NULL, NULL),
(37, 43, 0, 0, '199/2384, pratiksha apartment', 'sola road', 'ahmedabad', '38001', '23.0339859', '72.4742639', 'no instructions ', '3', 'my old home', '2019-03-14 13:44:51', NULL, NULL),
(38, 43, 0, 0, 'saint mark Coptic orthodox church', 'Carolina forest Blvd, myrtle beach', 'South Carolina ', '29579', '33.7589978', '-78.9209908', 'not for now', '4', 'church', '2019-03-12 05:18:00', NULL, NULL),
(39, 43, 0, 0, 'Salesforce', 'San Francisco', 'California', '94118', '42.3483041', '-71.08359259999997', 'San Francisco, in northern California, is a hilly city on the tip of a peninsula surrounded by the Pacific Ocean and San Francisco Bay', '1', 'Transbay Tower', '2019-03-12 05:17:53', NULL, NULL),
(40, 45, 1, 0, '43445', 'cherry blossom lane', 'canton', '48488', '40.7989473', '-81.378447', '', '4', 'drgbgxv', '2019-03-15 08:31:02', NULL, NULL),
(41, 45, 0, 0, '57899', 'cherry wood lane', 'canton', '48488', '42.3032095', '-83.4693053', '', '1', 'dgihsbx', '2019-03-15 08:29:36', NULL, NULL),
(42, 45, 0, 0, '43133', 'cherry wood lane', 'canton , Michigan', '48188', '42.3011048', '-83.4680535', '', '3', 'zhfghj', '2019-03-13 11:07:26', NULL, NULL),
(43, 33, 0, 0, 'fhdy', 'cjig', 'gjkg', '95565', '40.4451891', '-124.0075476', 'ncfh', '3', '', '2019-03-14 13:20:35', NULL, '2019-03-14 13:20:35'),
(44, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '3', '', '2019-03-14 13:24:49', NULL, '2019-03-14 13:24:49'),
(45, 33, 0, 0, '1', 'acv', 'kadi', '38555', '35.9186133', '-84.9609464', '', '3', '', '2019-03-14 13:19:59', NULL, '2019-03-14 13:17:05'),
(46, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '3', '', '2019-03-14 13:24:51', NULL, '2019-03-14 13:24:51'),
(47, 33, 1, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-03-14 14:14:32', NULL, NULL),
(48, 33, 0, 0, '203-206 city center', 'Opp shukan mall, Science City Rd, sola', 'Ahmedabad', '38006', '31.2826685', '-86.2555067', '', '4', '', '2019-03-14 13:24:55', NULL, '2019-03-14 13:24:55'),
(49, 48, 0, 0, '1', 'Mecklenburg County', 'North Carolina', '28202', '35.2299431', '-80.8373539', '', '4', '', '2019-03-14 13:44:52', NULL, NULL),
(50, 48, 1, 0, '1', 'Mecklenburg County', 'North Carolina', '28202', '35.2299431', '-80.8373539', '', '4', '', '2019-03-14 13:44:52', NULL, NULL),
(51, 45, 0, 0, '76738', 'melburng county', 'north coralina', '54634', '43.5983864', '-90.4125181', '', '3', '', '2019-03-15 08:31:02', NULL, NULL);

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
(5, 'sunvenk04@gmail.com', '$2y$10$e5v0G71WfUDMlNbXMFpYue0cCtaIXAJII6N3sSPeCAERoyZ9/.Z6i', 'CL33', '', 'Sunitha', '990236682578', '', 1, 'Kansas City', '', '', '2019-01-14 09:23:15', '2019-01-14 09:25:15', NULL, 'b2f4429ea5b418f4b88084089feebf32fa5f19db', ''),
(6, 'PieGeek@mailinator.com', '$2y$10$CYf7oiAPLbu/oA7QrLHUNeZPmFKbrZmGWd0YK5XapgQ031ngGQzuK', 'CL33', '', 'Pie Geek', '333 333 3333', '', 1, 'Kansas City', '26.4685668', '-81.76799640000002', '2019-01-23 11:10:19', '2019-02-01 05:43:35', NULL, '', ''),
(7, 'Shabby@mailinator.com', '$2y$10$DzjXChZH73AsBEWFNbLmKOL4hwB1QZoXSiK/wEztLKdi3zSEZ1qPC', 'CL33', '', 'Shabby Dog', '777 777 7777', '', 1, 'Kansas City', '', '', '2019-01-23 11:11:41', NULL, NULL, '', ''),
(8, 'ZanyThunder@mailinator.com', '$2y$10$6Y.XcJuLYA9WqPwbXREu2.GRHyg4OCKo5pdZ2JWs78sp20Y5iRHIO', 'CL33', '', 'Zany T Hunder', '774 587 1466', '', 2, 'Vienna, VA, USA', '38.9012225', '-77.26526039999999', '2019-01-23 11:33:04', '2019-02-07 05:45:00', NULL, '', ''),
(9, 'dhrumi@reconmail.com', '$2y$10$oq/zjIL6zGuPK6xRahxHsOxtn0f9Yy/Dglx7w.nUstBe.OPQIR9tS', 'DB9', 'delivery_boy_1552288161.jpeg', 'Dhrumi', '9874563210', 'fqIMGxz0PQg:APA91bEVujgp8ZCvd9Z-zJAa4PExqGOHTjoSocDvE1ASqA_0tARPjUuC4yhRv-F15WsWfsB8kMqhMmonO2fY1mcdAwJwwG_uXSnkYsMO4jtptA2KQJpc1jLBqYa2GHxmAbpinFgtMakB', 1, 'Buckingham Palace', '23.07275', '72.516343', '2019-01-10 07:00:44', '2019-03-13 04:40:30', NULL, '0fab4a9b779f393f21dbf6e8fc43d0f674baf8b2', ''),
(10, 'thomas@gmail.com', '$2y$10$5YLRV0iAz6BTaD2N1QP/ju8co4eqWljBkhwuQdqI5A.SC9brzsVHK', '', 'delivery_boy_1549518890.jpg', 'Thomas', '456 778 8899', '', 1, 'Greensboro, NC, USA', '36.0726354', '-79.79197540000001', '2019-02-07 05:54:50', NULL, NULL, '', ''),
(11, 'db2@yopmail.com', '$2y$10$Umi2xUIhIwDnSkpfpPWlQuvq7f.AXtYr0.Qq27NxpR9NzGL6cRhTG', 'DB11', 'delivery_boy_1552025401.jpg', 'Delivery Boy Brown', '546 456 4565', 'fiPXJr-eEFc:APA91bEf_PDnU-hNfc4scI1IoEbD_734v2g-QqpOTfin4RrJDQ1wPF_tMuMg2z9oKcz8Opb_iYq9Xjyqhm8zM1OUICuitITk8EtWE4eSQVyaIdAC_RTalRnR5jJqq0-44Z0tfi9iEp8Q', 1, 'Houston, TX, USA', '0.0', '0.0', '2019-03-08 06:00:38', '2019-03-08 06:10:01', NULL, '', '');

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
(23, 1, 'new_registration_vender', 'Activate Your Click Lunch Account', 0x3c7461626c6520646174612d6d6f64756c653d226865726f2d69636f6e2d6f75746c696e65302220646174612d7468756d623d226865726f2d69636f6e2d6f75746c696e652e706e67222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d6c69676874206f5f70782d78732220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d224267204c6967687422207374796c653d226261636b67726f756e642d636f6c6f723a20236462653565613b70616464696e672d6c6566743a203870783b70616464696e672d72696768743a203870783b223e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d756c7472615f6c69676874206f5f70782d6d64206f5f70792d786c206f5f78732d70792d6d64206f5f73616e73206f5f746578742d6d64206f5f746578742d6c696768742220616c69676e3d2263656e7465722220646174612d6267636f6c6f723d22426720556c747261204c696768742220646174612d636f6c6f723d224c696768742220646174612d73697a653d2254657874204d442220646174612d6d696e3d2231352220646174612d6d61783d22323322207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313970783b6c696e652d6865696768743a20323870783b6261636b67726f756e642d636f6c6f723a20236562663566613b636f6c6f723a20233832383939613b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a20343070783b70616464696e672d626f74746f6d3a20343070783b223e3c7461626c652063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c746420636c6173733d226f5f73616e73206f5f74657874206f5f746578742d7365636f6e64617279206f5f622d7072696d617279206f5f7078206f5f7079206f5f62722d6d61782220616c69676e3d2263656e7465722220646174612d636f6c6f723d225365636f6e646172792220646174612d626f726465722d746f702d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d626f74746f6d2d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d6c6566742d636f6c6f723d22426f72646572205072696d6172792220646174612d626f726465722d72696768742d636f6c6f723d22426f72646572205072696d6172792220646174612d73697a653d22546578742044656661756c742220646174612d6d696e3d2231322220646174612d6d61783d22323022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b636f6c6f723a20233234326233643b626f726465723a2032707820736f6c696420233234326233643b626f726465722d7261646975733a20393670783b70616464696e672d6c6566743a20313670783b70616464696e672d72696768743a20313670783b70616464696e672d746f703a20313670783b70616464696e672d626f74746f6d3a20313670783b223e3c696d67207372633d22687474703a2f2f31332e35382e3230312e3137382f6173736574732f696d616765732f656d61696c2d696d616765732f636865636b2d34382d7072696d6172792e706e67222077696474683d22343822206865696768743d2234382220616c743d2222207374796c653d226d61782d77696474683a20343870783b2d6d732d696e746572706f6c6174696f6e2d6d6f64653a20626963756269633b766572746963616c2d616c69676e3a206d6964646c653b626f726465723a20303b6c696e652d6865696768743a20313030253b6865696768743a206175746f3b6f75746c696e653a206e6f6e653b746578742d6465636f726174696f6e3a206e6f6e653b2220646174612d63726f703d2266616c7365223e3c2f74643e3c2f74723e3c74723e3c7464207374796c653d22666f6e742d73697a653a20323470783b206c696e652d6865696768743a20323470783b206865696768743a20323470783b223e266e6273703b203c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c683220636c6173733d226f5f68656164696e67206f5f746578742d6461726b206f5f6d622d7878732220646174612d636f6c6f723d224461726b2220646174612d73697a653d2248656164696e6720322220646174612d6d696e3d2232302220646174612d6d61783d22343022207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203470783b636f6c6f723a20233234326233643b666f6e742d73697a653a20333070783b6c696e652d6865696768743a20333970783b223e57656c636f6d6520746f20636c69636b206c756e6368213c2f68323e3c70207374796c653d226d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b223e596f7572206163636f756e7420686173206265656e207375636365737366756c6c7920637265617465643c2f703e3c7461626c6520636c6173733d226f5f626c6f636b222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e22207374796c653d226d61782d77696474683a2036333270783b6d617267696e3a2030206175746f3b6d617267696e2d746f703a20323070783b223e3c74626f64793e3c74723e3c746420636c6173733d226f5f62672d7768697465206f5f70782d6d64206f5f70792d78732220616c69676e3d2263656e74657222207374796c653d226261636b67726f756e642d636f6c6f723a207472616e73706172656e743b70616464696e672d6c6566743a20323470783b70616464696e672d72696768743a20323470783b70616464696e672d746f703a203870783b70616464696e672d626f74746f6d3a203870783b223e3c7461626c6520616c69676e3d2263656e746572222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220626f726465723d22302220726f6c653d2270726573656e746174696f6e223e3c74626f64793e3c74723e3c74642077696474683d223330302220636c6173733d226f5f62746e206f5f62672d6461726b206f5f6272206f5f68656164696e67206f5f746578742220616c69676e3d2263656e74657222207374796c653d22666f6e742d66616d696c793a2048656c7665746963612c20417269616c2c2073616e732d73657269663b666f6e742d7765696768743a20626f6c643b6d617267696e2d746f703a203070783b6d617267696e2d626f74746f6d3a203070783b666f6e742d73697a653a20313670783b6c696e652d6865696768743a20323470783b6d736f2d70616464696e672d616c743a203132707820323470783b6261636b67726f756e642d636f6c6f723a20233234326233643b626f726465722d7261646975733a203470783b223e3c6120636c6173733d226f5f746578742d77686974652220687265663d227b61637469766174696f6e5f6c696e6b7d22207374796c653d22746578742d6465636f726174696f6e3a206e6f6e653b6f75746c696e653a206e6f6e653b636f6c6f723a20236666666666663b646973706c61793a20626c6f636b3b70616464696e673a203132707820323470783b6d736f2d746578742d72616973653a203370783b22207461726765743d225f626c616e6b223e4163746976617465204163636f756e743c2f613e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e, '2018-10-18 18:30:00', '2019-03-07 12:22:35', 1);

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
(18, 52, 'Masala Frankie', 'masala-frienkie', 10, 80, '60.00', '56.00', 'Combine The Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501653.jpg', 0, '3', 1, 0, 12, 1, '2018-11-06 06:24:13', NULL, NULL),
(19, 52, 'Chinese Frankie', 'chinese-frankie', 10, 100, '90.00', '89.00', 'Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501826.jpeg', 0, '3', 0, 0, 0, 1, '2018-11-06 06:27:06', NULL, NULL),
(20, 52, 'Chicken P\\\"izza', 'chicken-pizza', 1, 20, '200.00', '189.00', 'Our Family Will Never Guess That This Fun Twist On Typical Pizza Uses Up Leftover Pesto. Loaded With Protein, Hearty Slices Of This Chicken Pizza\\\" Will Fill Them Up Fast!', 'item_1542019186.png', 1, '3', 1, 0, 0, 1, '2019-02-25 05:26:57', NULL, NULL),
(21, 52, 'Test', 'test', 10, 1, '33.33', '10.00', 'Dfgdfg', 'item_1542018900.jpg', 1, '3', 0, 0, 0, 1, '2018-11-12 06:05:00', NULL, '2018-11-12 06:05:24'),
(22, 52, 'Dhrumi', 'dhrumi', 3, 4, '100.00', '77.00', 'Fgdg', '', 0, '3', 0, 0, 0, 1, '2019-01-07 00:44:50', NULL, '2019-01-07 00:45:04'),
(23, 52, 'Sushi', 'shushi', 10, 100, '100.00', '77.00', '78768ggggg', '', 0, '3', 0, 0, 0, 1, '2019-01-07 00:45:50', NULL, NULL),
(24, 52, 'Burger Meal Combo', 'burger-combo', 2, 1, '100.00', '77.00', 'Dfddf', 'item_1546838672.jpg', 0, '3', 0, 0, 0, 1, '2019-01-07 00:54:32', NULL, NULL),
(25, 52, 'P12', 'p', 3, 1, '100.00', '', 'Our Family Will Never Guess That This Fun Twist On', 'item_1551072323.jpg', 0, '3', 1, 0, 0, 1, '2019-02-25 05:25:23', NULL, NULL),
(26, 52, 'C1', 'c1', 2, 1, '100.00', '9.00', 'Gg', '', 1, '3', 1, 0, 10, 1, '2019-01-07 00:58:20', NULL, NULL),
(27, 58, 'Fresh Mushrooms', 'fresh-mushrooms', 9, 50, '5.00', '4.00', 'Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure Ut Wisi Enim Ad Minim Veniam, Quis Nostrud Exerci Tation Ullamcorper Suscipit Lobortis Nisl Ut Aliquip Ex Ea Commodo Consequat. Duis Autem Vel Eum Iriure', 'item_1547206219.png', 0, '3', 1, 0, 0, 1, '2019-02-22 05:28:52', NULL, NULL),
(28, 58, 'Coco Drinks', 'coco-drinks', 9, 50, '3.00', '2.00', 'Coco Drinks', '', 0, '1', 1, 0, 0, 0, '2019-02-27 10:56:36', NULL, NULL),
(29, 58, 'French Fries', 'french-fries', 19, 10, '15.00', '10.00', 'Spicy And Tasty', 'item_1547462625.jpg', 0, '3', 1, 0, 0, 1, '2019-01-14 10:43:45', NULL, NULL),
(30, 58, 'Veg Meal + Coco Drinks', 'veg-meal-coco-drinks', 9, 40, '20.00', '15.00', 'Biriyani + Coco Drinks', 'item_1547462856.jpg', 1, '3', 1, 0, 2, 1, '2019-02-13 11:21:09', NULL, NULL),
(31, 62, 'Ice Cream', 'ice-cream', 2, 100, '166.00', '150.00', 'Eld Our Little One?s First Birthday Here. The Cake Was Also Made By Fiona From The Restaurant And Was Exactly How I Wanted It. Was Guided By The Owner As To Where I Could Find Party Decorations As Per Our Colour Theme. We Only Needed To Deliver The Things To Them And Did Not Have To Worry About Anything. The Guests Appreciated The Ambience And The Food.. Thank You To The Entire Team For Making Our Special Day Perfect And Hassle Free And Providing Lip Smacking Food To Our Guests.', 'item_1547722922.png', 0, '7', 1, 0, 40, 1, '2019-01-17 11:02:02', NULL, NULL),
(32, 52, 'Farmhouse Pizza', 'farmhouse-pizza', 19, 100, '120.00', '100.00', 'Delightful Combination Of Onion, Capsicum, Tomato & Grilled Mushroom', 'item_1551248647.jpg', 0, '5', 1, 0, 0, 1, '2019-02-27 06:24:07', NULL, NULL),
(33, 52, 'Veg Parcel', 'veg-parcel', 3, 100, '30.00', '25.00', 'Mexican Herbs Sprinkled On Onion, Capsicum, Tomato & Jalapeno', 'item_1551249143.png', 0, '3', 1, 0, 0, 1, '2019-02-27 06:32:23', NULL, NULL);

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
  `order_type` varchar(1) NOT NULL COMMENT '1-Deliver Now, 2-Deliver Later, 3-Takeout, 4-Takeout Later, 5 - weekly',
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
  `order_status` int(3) NOT NULL DEFAULT '0' COMMENT '0  - pending, 1 - accept by shop, 2 - reject by shop, 3 - assigned delivery_boy by dispatcher, 4 - accept by delivery_boy, 5 - order picked, 6 - order delivered, 7 - order delivery fail',
  `delivery_address_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL DEFAULT '0',
  `payment_status` int(3) NOT NULL DEFAULT '0' COMMENT '0- pending , 1- success, 2 - failed',
  `payment_mode` int(5) NOT NULL COMMENT '0  - Card , 1 -  Apple Pay, 2 -  Google Pay',
  `transaction_id` varchar(255) NOT NULL,
  `QR_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shop_id`, `order_type`, `later_time`, `total`, `subtotal`, `delivery_charges`, `promocode_id`, `promo_amount`, `tax`, `service_charge`, `schedule_date`, `schedule_time`, `order_status`, `delivery_address_id`, `delivery_boy_id`, `payment_status`, `payment_mode`, `transaction_id`, `QR_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(86, 33, 52, '1', '', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 4, 17, 9, 1, 2, '', '', '2019-03-02 07:37:38', NULL, NULL),
(87, 36, 52, '1', '', '767.40', '840.00', '1.50', '41', '100.00', '1.50', '2.00', '0000-00-00', '', 4, 34, 9, 1, 0, '', '', '2019-03-02 08:17:58', NULL, NULL),
(88, 36, 52, '3', '', '167.10', '160.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 34, 0, 1, 0, '', '', '2019-03-04 04:49:47', NULL, NULL),
(89, 33, 52, '2', '10:30 AM', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 4, 17, 9, 1, 2, '', '', '2019-03-04 11:16:57', NULL, NULL),
(90, 33, 52, '1', '', '99.16', '187.00', '5.00', '35', '93.50', '0.20', '0.50', '0000-00-00', '', 4, 17, 9, 1, 2, '', '', '2019-03-04 11:18:34', NULL, NULL),
(91, 33, 52, '1', '', '301.65', '290.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 3, 36, 9, 1, 0, '', '', '2019-03-05 05:30:32', NULL, NULL),
(92, 33, 52, '1', '', '175.38', '168.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-05 06:34:59', NULL, NULL),
(93, 43, 58, '1', '', '218.63', '235.00', '2.90', '46', '23.50', '1.50', '0.50', '0000-00-00', '', 3, 38, 9, 1, 0, '', '', '2019-03-05 07:25:03', NULL, NULL),
(94, 33, 52, '1', '', '623.54', '601.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 9, 1, 0, '', '', '2019-03-06 10:38:43', NULL, NULL),
(95, 33, 52, '1', '', '42.07', '56.00', '1.50', '35', '16.80', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:25:59', NULL, NULL),
(96, 33, 52, '1', '', '67.43', '91.00', '1.50', '35', '27.30', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:28:01', NULL, NULL),
(97, 33, 52, '1', '', '117.42', '160.00', '1.50', '35', '48.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:34:26', NULL, NULL),
(98, 33, 52, '1', '', '233.34', '320.00', '1.50', '35', '96.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:38:57', NULL, NULL),
(99, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 1, 17, 0, 1, 2, '', '', '2019-03-07 10:44:45', NULL, NULL),
(100, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:50:44', NULL, NULL),
(101, 33, 52, '1', '', '117.42', '112.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 10:55:00', NULL, NULL),
(102, 33, 52, '1', '', '239.55', '230.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', '2019-03-07 10:59:15', NULL, NULL),
(103, 33, 52, '1', '', '239.55', '230.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 3, 36, 11, 1, 0, '', '', '2019-03-07 11:14:25', NULL, NULL),
(104, 33, 52, '1', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', '2019-03-07 12:11:59', NULL, NULL),
(105, 33, 52, '2', '6:50 PM', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 3, 36, 11, 1, 0, '', '', '2019-03-07 12:14:09', NULL, NULL),
(106, 33, 52, '4', '6:45 PM', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '0000-00-00', '', 1, 36, 0, 1, 0, '', '', '2019-03-07 12:15:22', NULL, NULL),
(107, 33, 52, '5', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '2019-03-08', '6:46 PM', 3, 36, 11, 1, 0, '', '', '2019-03-07 12:16:45', NULL, NULL),
(108, 33, 52, '5', '', '187.80', '230.00', '1.50', '33', '50.00', '1.50', '2.00', '2019-03-07', '6:47 PM', 4, 36, 11, 1, 0, '', '', '2019-03-07 12:18:05', NULL, NULL),
(109, 33, 52, '1', '', '209.54', '201.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', '2019-03-07 13:19:15', NULL, NULL),
(110, 33, 58, '1', '', '81.85', '86.00', '2.90', '47', '8.60', '1.50', '0.50', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', '2019-03-07 14:06:18', '2019-03-07 14:13:07', NULL),
(111, 33, 58, '1', '', '16.67', '15.00', '2.90', '47', '1.50', '1.50', '0.50', '0000-00-00', '', 0, 36, 0, 1, 0, '', '', '2019-03-07 14:06:54', NULL, NULL),
(112, 33, 58, '1', '', '94.70', '140.00', '2.90', '33', '50.00', '1.50', '0.50', '0000-00-00', '', 4, 36, 11, 1, 0, '', '', '2019-03-07 14:07:19', '2019-03-08 04:56:46', NULL),
(113, 36, 52, '1', '', '891.60', '1360.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', '2019-03-08 06:25:27', NULL, NULL),
(114, 36, 52, '1', '', '964.05', '1430.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', '2019-03-08 06:30:23', NULL, NULL),
(115, 36, 52, '1', '', '887.46', '1356.00', '1.50', '48', '500.00', '1.50', '2.00', '0000-00-00', '', 0, 35, 0, 1, 0, '', '', '2019-03-08 06:31:45', NULL, NULL),
(116, 33, 52, '1', '', '6207.36', '5996.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', '', '2019-03-08 06:53:44', NULL, NULL),
(117, 33, 52, '5', '', '81.20', '77.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-09', '11:30 PM', 4, 36, 9, 1, 0, '', '', '2019-03-08 08:00:09', NULL, NULL),
(118, 33, 52, '5', '', '117.42', '112.00', '1.50', '', '0.00', '1.50', '2.00', '2019-03-12', '11:45 PM', 4, 36, 9, 1, 0, '', '', '2019-03-09 06:16:00', NULL, NULL),
(119, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'drygpHk=.png', '2019-03-11 05:58:51', NULL, NULL),
(120, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL120_1552284107.png', '2019-03-11 06:01:47', NULL, NULL),
(121, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL121_1552284695.png', '2019-03-11 06:11:35', NULL, NULL),
(122, 33, 52, '1', '', '193.31', '187.00', '5.00', '', '0.00', '0.20', '0.50', '0000-00-00', '', 0, 17, 0, 1, 2, '', 'CL122_1552286386.png', '2019-03-11 06:39:46', NULL, NULL),
(123, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL123_1552300741.png', '2019-03-11 10:39:01', NULL, NULL),
(124, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL124_1552300770.png', '2019-03-11 10:39:30', NULL, NULL),
(125, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL125_1552301039.png', '2019-03-11 10:43:59', NULL, NULL),
(126, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL126_1552302183.png', '2019-03-11 11:03:03', NULL, NULL),
(127, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL127_1552367891.png', '2019-03-12 05:18:11', NULL, NULL),
(128, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL128_1552371789.png', '2019-03-12 06:23:09', NULL, NULL),
(129, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL129_1552371897.png', '2019-03-12 06:24:57', NULL, NULL),
(130, 43, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 37, 0, 1, 0, '', 'CL130_1552373554.png', '2019-03-12 06:52:34', NULL, NULL),
(131, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL131_1552373840.png', '2019-03-12 06:57:20', NULL, NULL),
(132, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL132_1552374219.png', '2019-03-12 07:03:39', NULL, NULL),
(133, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL133_1552374669.png', '2019-03-12 07:11:09', NULL, NULL),
(134, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL134_1552374785.png', '2019-03-12 07:13:05', NULL, NULL),
(135, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL135_1552381134.png', '2019-03-12 08:58:54', NULL, NULL),
(136, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL136_1552381778.png', '2019-03-12 09:09:38', NULL, NULL),
(137, 33, 58, '1', '', '15.14', '12.00', '2.90', '', '0.00', '1.50', '0.50', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL137_1552381943.png', '2019-03-12 09:12:23', NULL, NULL),
(138, 33, 62, '3', '', '158.27', '170.00', '2.20', '47', '17.00', '1.50', '0.50', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL138_1552381994.png', '2019-03-12 09:13:14', NULL, NULL),
(139, 33, 52, '1', '', '59.46', '56.00', '1.50', '', '0.00', '1.50', '2.00', '0000-00-00', '', 0, 36, 0, 1, 0, '', 'CL139_1552383280.png', '2019-03-12 09:34:40', NULL, NULL),
(140, 33, 58, '5', '', '16.17', '13.00', '2.90', '', '0.00', '1.50', '0.50', '2019-03-13', '8:26 PM', 0, 36, 0, 1, 0, '', 'CL140_1552391787.png', '2019-03-12 11:56:27', NULL, NULL),
(141, 45, 58, '3', '', '72.67', '76.00', '2.90', '47', '7.60', '1.50', '0.50', '0000-00-00', '', 0, 42, 0, 1, 0, '', 'CL141_1552472304.png', '2019-03-13 10:18:24', NULL, NULL);

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
(189, 141, 27, '4.00', '11.50', 2, '31.00');

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
(447, 189, 20, 72, '0.00');

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
(48, '58', '7', '1', 2, '100.00', '2', 'SAVE10', '10.00', '0', '2019-03-08', '2019-03-10', '200.00', 'Use Promocode SAVE10 To Get Flat $10.00 Discount* On Total Product(s) Value ', 1, '2019-03-08 05:45:30', '2019-03-08 07:41:09', NULL);

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
(24, 48, 58, 30);

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
(25, 48, 58, 30);

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
(52, 'sugar@mailinator.com', '$2y$10$2Qov5hbktXILNk8/EezJi.rakocg80gqr75xA7JIFLNVHLoLgQlvi', 'Ristretto - Behi', 'ristre', '10', 'Mr Ristretto', 'RIS52', 'vender_1541502113.jpg', 'Charlotte center city, Charlotte, NC, USA', '28202', 'Mecklenburg County', 'North Carolina', 'United States', '35.22723019999999', '-80.84608220000001', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '886 658 4541', '774 587 1466', 'https://www.zomato.com/ah', '', '', '', '100.00', '11:30 AM', '10:00 AM', '2.00', '2.00', '1.50', '0,1,2', '657-57-5765', '2.00', 0, '1234', 'brochure_1541502113.jpg', 3, 1, '6c0bf58d69c1a8adead8c7c158badc2f87430bf9', '', '2018-11-06 05:49:41', '2018-11-12 09:03:10', NULL),
(53, 'palboy@mailinator.com', '', 'Test Shop', '', '10.50', 'Pal', 'TES53', 'vender_1541999590.jpg', 'Gota, Ahmedabad, Gujarat, India', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2018-11-12 00:43:10', NULL, NULL),
(54, 'palcakes@mailinator.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Git', '', '8.00', 'Frl', 'GIT54', '', 'Del\\\"hi, Ind\\\"ia', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '', '0.50', 0, '', '', 3, 2, '', '', '2018-11-12 09:06:52', '2018-11-23 00:41:26', NULL),
(55, 'Cafe@eww.com', '', 'The Hytt Cafe', '', '10.00', 'Giop', 'THE55', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '42.34797469999999', '-71.08792840000001', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2019-01-03 09:21:24', NULL, NULL),
(56, 'PunchyMan@mailinator.com', '', 'Punchy Man', '', '', 'Dhrumi', 'PUN56', '', 'DFW Remote North Parking, Grapevine, TX, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '32.926195', '-97.04413999999997', '', '7745871466', '4353455434', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '', '', '0.50', 0, '', '', 3, 0, '', '', '2019-01-09 01:52:15', NULL, NULL),
(57, 'SmartDoody@mailinator.com', '$2y$10$CjPL17v5/rIGScMxRYs8x.9VT0K84Z109Z9niH80PKnJSOPcj//Oa', 'St. George\\\'s', '', '', 'Doody', 'SMA57', 'vender_1549620579.jpg', 'Hynes Convention Center (Boylston Street and Gloucester Street), Boston, MA, USA', '02199', 'Suffolk County', 'Massachusetts', 'United States', '42.3483041', '-71.08359259999997', '', '666 666 6666', '666 655 5555', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.30', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 1, '', '', '2019-01-10 02:23:39', '2019-02-08 10:10:41', NULL),
(58, 'vadilal@yopmail.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Vadilal Eatery', 'vadilal-eatery', '', 'Vadilal', 'VAD58', 'vender_1547204136.png', 'Ghramville Road, Myrtle Beach, SC, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '33.7569751', '-78.92280299999999', 'This is test This is testThis is testThis is testThis is testThis is testThis is testThis is test This is testThis is testThis is test This is testThis is testThis is test', '774 587 1466', '774 587 1466', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '100.00', '11:30 AM', '10:00 AM', '2.50', '2.30', '2.90', '0,2', '545-55-5555', '0.50', 0, '', 'brochure_1547460096.jpg', 3, 1, '', '', '2019-01-11 10:50:17', '2019-02-13 10:48:26', NULL),
(59, 'BusyBoy@mailinator.com', '', 'Havmore', '', '', 'Mr  Patel', 'HAV59', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '', '', '', '7745871466', '7745871466', 'www.test.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '777-77-7777', '0.50', 0, '', '', 3, 0, '', '', '2019-01-11 11:04:12', '2019-01-14 07:47:37', NULL),
(60, 'bistro@mailinator.com', '$2y$10$LgPaANV6eu.2z8qblfoMf.qeNS8WVrfhEGBBiT8YBL6AJfVsCmGUy', 'Cafe Bistro', '', '', 'Mr Ristretto', 'CAF60', 'vender_1547208493.jpg', 'FGCU South Bridge Loop Road, Fort Myers, FL, USA', '33965', 'Lee County', 'Florida', 'United States', '26.4586806', '-81.76785970000003', 'Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in AhmedabadFind the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad Find the best restaurants, caf?s, and bars in Ahmedabad\r\nFind the best restaurants, caf?s, and bars in Ahmedabad', '8866541256', '8445687499', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '', '', '100.00', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1,2', '', '0.50', 0, '', 'brochure_1547208593.png', 3, 1, '', '', '2019-01-11 12:07:06', '2019-01-12 06:14:25', '2019-01-14 07:50:17'),
(61, 'dominos@gmail.com', '', 'Dominos', '', '10.00', 'Dominu', 'DOM61', '', 'Canton, MI, USA', '48488889', 'bangalore', 'ka', 'India', '42.3086444', '-83.48211600000002', '', '57687898890808', '35465676756577', 'www.hfajfhaifr.com', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0,1', '', '0.50', 0, '', '', 3, 0, '', '63245e31b00d4f5b9b03c8ca0fe05f4890f5d4c6', '2019-01-14 07:55:53', NULL, NULL),
(62, 'vineyard@mailinator.com', '$2y$10$NkmTmprrqUfdh/jBk.727eTMFtqouT2iIz/mXMJ04IwrRba8JXLW2', 'The Vineyard', '', '10.50', 'Mr Vine', 'THE62', 'vender_1549621131.jpg', 'London Eye Court, Las Vegas, NV, USA', '89178', 'Clark County', 'Nevada', 'United States', '36.0346157', '-115.30548069999998', '', '886 654 1258', '778 845 8745', 'https://www.zomato.com/ahmedabad/the-vineyard-bodakdev?zrp_bid=0&zrp_pid=14', '', '', '', '', '11:30 AM', '10:00 AM', '1.3', '2.50', '2.20', '2', '996-65-5745', '0.50', 0, '', '', 3, 1, '', '', '2019-01-17 10:38:12', '2019-02-08 10:18:51', NULL),
(63, 'test@gmail.com', '', 'Test', '', '', 'Rrtrt', 'TES63', '', 'Dg Farms Road, Wimauma, FL, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '', '', '', '546 546 4577', '444 444 4444', 'https://www.zomato.com/ahmedabad/', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '1,2', '555-55-5555', '0.50', 0, '', '', 3, 0, '', 'c7c1cf2f18b8f9c6e49f78a98e920877d17f288b', '2019-01-21 12:03:28', NULL, '2019-01-21 12:03:35'),
(64, 'MaleTater@mailinator.com', '$2y$10$u0u3DECZfKltNRAC..VwRegw2gUoiLY1dd.m3FcyOjRTVWNDu8LgG', 'MaleTater', '', '', 'MaleTater', 'MAL64', '', 'Aha Macav Parkway, Needles, CA, USA', '66666', 'San Bernardino County', 'California', 'United States', '35.0402223', '-114.64573039999999', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '0', '66-66-6666', '0.50', 0, '', '', 3, 2, '', '', '2019-01-23 06:11:39', '2019-01-23 06:12:38', NULL),
(65, 'developer.eww2@gmail.com', '$2y$10$4htY1Ibb10PR4qZfxVm0SeUKxI7/AKd.3ktlWfS6sQvcG7XT/Ef.m', 'Eww', '', '', 'Eww', 'EWW65', '', 'London Eye Court, Las Vegas, NV, USA', '89178', 'Clark County', 'Nevada', 'United States', '', '', '', '', '555 555 5555', '', '', '', '', '', '11:30 AM', '10:00 AM', '1.50', '2.50', '2.20', '2', '555-55-5555', '0.50', 0, 'SD', '', 3, 1, '', '', '2019-01-23 06:15:09', '2019-03-08 11:05:46', NULL),
(66, 'developer.eww2@gmail.com', '', 'The Esplendido Cafe', '', '', 'Mr Esplendo', 'THE66', '', 'Glendale, CA, USA', '32205', 'Duval County', 'Florida', 'United States', '', '', '', '555 555 5556', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '9', '2.50', '2.20', '0', '555-55-5555', '0.50', 0, '', '', 3, 0, '', 'e5234ea06feeb57a1a78e1594224fa175fc054b8', '2019-01-23 06:37:05', NULL, NULL),
(67, 'myshop@binkmail.com', '', 'Waffles Store', '', '', 'Dhrumi', 'WAF67', '', 'Jollyville Road, Austin, TX, USA', '78759', 'Travis County', 'Texas', 'United States', '30.4065779', '-97.7478949', '', '', '', '', '', '', '', '', '11:30 AM', '10:00 AM', '2', '2.50', '2.20', '0', '666-66-6666', '0.50', 0, '', '', 3, 0, '', 'a03cc2da19ad20a31997fd09e4756843e301664d', '2019-01-31 12:04:09', NULL, NULL),
(68, 'Stingo@tradermail.info', '$2y$10$jyWKXLh14gxxlD93JJjyq.NPUnvByej8bWVHr5akuh4rsIBwsXhBW', 'Stingo, Ace Hotel', 'stingo-ace-hotel', '', 'Stingo', 'STI68', 'vender_1549620927.jpg', 'Ace Hotel, Portland, OR, USA', '97205', 'Multnomah County', 'Oregon', 'United States', '45.52211399999999', '-122.681602', 'The Main Bar at Willy\\\'s Wine Bar is a private event venue available to hire in the City of London.\r\n\r\nIf there is one place in the City you need to experience, it?s Willy?s Wine Bar.\r\n\r\nThis is one of London?s most established wine bars in London. Not only is it bursting with tradition and charm, but it also plays host to some of London?s best wine quizzes and tastings.', '787 878 7878', '787 878 7878', 'https://www.zomato.com/ah', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '5', '08:00 AM', '07:00 AM', '1.50', '2.50', '2.20', '0,1', '790-65-7575', '0.50', 0, '', '', 3, 1, '', '', '2019-02-08 10:13:18', '2019-02-13 13:25:33', NULL),
(69, 'fire@devnullmail.com', '$2y$10$5iTn3WKnCn/z1LjrNeYca.7YmU0vhPKXqF9ZgYL3TQ0bya1DzcAAW', 'Nation Fire 2', 'nation-fire', '', 'Miss Boby', 'NAT69', '', 'King of Prussia, PA, USA', '19406', 'Montgomery County', 'Pennsylvania', 'United States', '', '', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '610 265 5794', '610 265 5794', 'https://www.simon.com/mall/king-of-prussia-mall', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', 'https://www.zomato.com/ahmedabad/', '150.00', '10:00 AM', '09:30 AM', '1.50', '12.00', '10.00', '0,1', '676-76-7676', '2.00', 0, '', '', 2, 1, '', '', '2019-03-02 08:09:51', '2019-03-02 08:11:10', NULL),
(70, 'foody@letthemeatspam.com', '', 'Food Track', 'food-track', '', 'Miss Green', 'FOO70', '', 'H K Allen Parkway, Temple, TX, USA', '76502', 'Bell County', 'Texas', 'United States', '31.04998459999999', '-97.37216409999996', '', '777 777 7777', '', '', '', '', '', '', '', '', '2.00', '5.00', '5.00', '1,2', '777-77-7777', '', 0, '', '', 3, 0, '', 'a77ad09ca43d8ac2945bd81b8067b241d60444cf', '2019-03-04 05:17:57', NULL, '2019-03-04 05:19:07'),
(71, 'ThumbBub88@mailinator.com', '', 'Mcdonalds', 'mcdonalds', '', 'Ffgdf', 'MUU71', '', 'F.S.C.J. Kent Campus, Jacksonville, FL, USA', '32205', 'Duval County', 'Florida', 'United States', '', '', '', '666 666 6655', '', '', '', '', '', '', '', '', '60.00', '6.00', '6.00', '0', '565-67-5675', '', 0, '', '', 3, 0, '', '15d88eb35fa90c9b123b37676381a10d70b46370', '2019-03-06 11:07:32', '2019-03-08 03:34:27', NULL),
(76, 'rahul.bbit@gmail.comz', '', 'Dr Pizza', 'dr-pizza', '', 'Rahul', 'DRP76', '', '1109 Decatur Street, New Orleans, LA 70116, USA', '70116', 'Orleans Parish', 'Louisiana', 'United States', '29.9601404', '-90.05985670000001', '', '756 782 7928', '', '', '', '', '', '', '', '', '5.00', '3.00', '3.00', '1', '456-56-4564', '', 0, '', '', 3, 0, '', 'e508285af9500a5221824da3f5344b3b63ac59c9', '2019-03-15 06:09:24', NULL, NULL);

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
(377, 52, 'Sunday', '', '', 1, 0, '2019-02-25 11:29:18'),
(378, 52, 'Monday', '', '', 1, 0, '2019-02-25 11:29:18'),
(379, 52, 'Tuesday', '', '', 1, 0, '2019-02-25 11:29:18'),
(380, 52, 'Wednesday', '', '', 1, 0, '2019-02-25 11:29:18'),
(381, 52, 'Thursday', '', '', 1, 0, '2019-02-25 11:29:18'),
(382, 52, 'Friday', '', '', 1, 0, '2019-02-25 11:29:18'),
(383, 52, 'Saturday', '', '', 0, 1, '2019-02-25 11:29:18'),
(391, 69, 'Sunday', '09:00 AM', '05:00 PM', 0, 0, '2019-03-02 08:19:39'),
(392, 69, 'Monday', '', '', 0, 1, '2019-03-02 08:19:39'),
(393, 69, 'Tuesday', '', '', 0, 1, '2019-03-02 08:19:39'),
(394, 69, 'Wednesday', '', '', 0, 1, '2019-03-02 08:19:39'),
(395, 69, 'Thursday', '', '', 0, 1, '2019-03-02 08:19:39'),
(396, 69, 'Friday', '', '', 0, 1, '2019-03-02 08:19:39'),
(397, 69, 'Saturday', '', '', 0, 1, '2019-03-02 08:19:39'),
(447, 58, 'Sunday', '', '', 0, 1, '2019-03-08 07:52:12'),
(448, 58, 'Monday', '09:00 AM', '05:00 PM', 0, 0, '2019-03-08 07:52:12'),
(449, 58, 'Tuesday', '09:00 AM', '05:00 PM', 0, 0, '2019-03-08 07:52:12'),
(450, 58, 'Wednesday', '09:00 AM', '05:00 PM', 0, 0, '2019-03-08 07:52:12'),
(451, 58, 'Thursday', '', '', 0, 1, '2019-03-08 07:52:12'),
(452, 58, 'Friday', '04:30 PM', '05:00 PM', 0, 0, '2019-03-08 07:52:12'),
(453, 58, 'Saturday', '12:00 PM', '06:00 PM', 0, 0, '2019-03-08 07:52:12');

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
(92, 52, 3),
(94, 69, 9),
(109, 58, 1),
(110, 58, 3);

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
(31, 52, 2, 1, '09:00 AM', '01:00 PM'),
(32, 52, 2, 2, '03:00 PM', '09:00 PM'),
(35, 69, 2, 1, '07:00 AM', '12:30 PM'),
(36, 69, 2, 2, '02:00 PM', '11:30 PM'),
(51, 58, 2, 1, '09:00 AM', '01:00 PM'),
(52, 58, 2, 2, '12:00 AM', '09:00 AM');

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
(4, ' binal.nasit26@gmail.com', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-14 14:07:30', NULL, NULL),
(5, ' binal.nasit26@gmail.comz', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:21:30', NULL, NULL),
(6, 'rahul.bbit@gmail.com', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:25:10', NULL, NULL),
(7, 'rahul.bbit@gmail.comz', ' Dr Pizza', ' Surat', ' 7567827928', 'abc', '2019-03-15 05:54:27', NULL, '2019-03-15 06:09:27'),
(8, 'rahul.bbit@gmail.comb', ' Dr Pizza', ' Surat', ' 7567827928', '', '2019-03-15 06:23:01', NULL, NULL);

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
(23, 52, 'Extra Toppings', 1, 0, '2019-02-27 06:18:26', NULL, NULL);

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
(84, 8, 'Med', 20, '5.00', '2019-02-25 05:26:57'),
(85, 21, 'New Hand Tossed', 32, '0', '2019-02-27 06:24:07'),
(86, 21, 'Wheat Thin Crust', 32, '5', '2019-02-27 06:24:07'),
(87, 21, 'Cheese Burst', 32, '10', '2019-02-27 06:24:07'),
(88, 21, 'Fresh Pan Pizza', 32, '5', '2019-02-27 06:24:07'),
(89, 21, ' Classic Hand Tossed', 32, '5', '2019-02-27 06:24:07'),
(90, 22, 'Medium', 32, '50', '2019-02-27 06:24:07'),
(91, 22, 'Regular ', 32, '0', '2019-02-27 06:24:07'),
(92, 23, 'Extra Cheese', 32, '10', '2019-02-27 06:24:07'),
(93, 23, 'Black Olive', 32, '2', '2019-02-27 06:24:07'),
(94, 23, 'Onion', 32, '2', '2019-02-27 06:24:07'),
(95, 23, 'Crisp Capsicum', 32, '2', '2019-02-27 06:24:07'),
(96, 23, 'Paneer', 32, '2', '2019-02-27 06:24:07'),
(97, 23, 'Grilled Mushroom', 32, '2', '2019-02-27 06:24:07'),
(98, 23, 'Golden Corn', 32, '2', '2019-02-27 06:24:07'),
(99, 23, 'Fresh Tomato', 32, '2', '2019-02-27 06:24:07'),
(100, 23, 'Jalapeno', 32, '2', '2019-02-27 06:24:07'),
(101, 23, 'Red Paprika', 32, '2', '2019-02-27 06:24:07'),
(102, 22, 'Large', 33, '10', '2019-02-27 06:32:23'),
(103, 22, 'regular', 33, '0', '2019-02-27 06:32:23'),
(104, 16, 'Small', 28, '20.00', '2019-02-27 10:56:36');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `customer_payment_card`
--
ALTER TABLE `customer_payment_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `order_item_variant`
--
ALTER TABLE `order_item_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `promocode_products`
--
ALTER TABLE `promocode_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `promocode_shops`
--
ALTER TABLE `promocode_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `promocode_valid_product`
--
ALTER TABLE `promocode_valid_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `shop_availibality`
--
ALTER TABLE `shop_availibality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `shop_cuisines`
--
ALTER TABLE `shop_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `shop_hours`
--
ALTER TABLE `shop_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `shop_request`
--
ALTER TABLE `shop_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `variant_items`
--
ALTER TABLE `variant_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
