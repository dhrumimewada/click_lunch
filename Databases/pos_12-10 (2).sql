-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 01:55 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_12-10`
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
(1, 'admin@eww.com', '$2y$10$91PDj5TKyWLt39egdamc6uL3oZxhI6dcdSOCcpJ0m/asrJlsQ9EeK', 'admin_1545288749.jpg', 'dhrumi', 1, '2018-10-20 04:54:29', '2018-12-20 02:22:30', NULL),
(2, 'admin@excellentwebworld.com', '$2y$10$PFOMzMbtADnwHKHu79B6i.vztg1TMQeJhrJlkorzFGkYdaSJi/Ghe', '', 'john deo', 1, '2018-10-24 13:45:49', NULL, NULL),
(3, '6777@admin.com', '$2y$10$Sc8dnEUJ1eUmaRhOzCUoZ.F.yp9adaQh7mnwne7UMSJHcGl7cqx9u', 'admin_1547011876.jpg', 'test', 1, '2018-12-20 11:19:32', '2019-01-09 01:01:16', NULL);

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
(3, 'delivery_boy_android', 'Delivery Boy Android App', '1.0.0', 1),
(4, 'ipad', 'Restaurant Ipad App', '1.0.0', 1),
(5, 'maintenance_mode', 'Maintenance Mode', '', 0);

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
(1, 'Chinese', 'cuisine_1541488030.jpg', 1, '2018-11-06 07:07:10', '2018-11-06 02:37:10', NULL),
(2, 'Mexican', 'cuisine_1542022208.jpg', 1, '2018-11-12 12:12:03', '2018-11-12 07:42:03', NULL),
(3, 'Italian', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:58', NULL, NULL),
(4, 'Japanese or sushi', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:56', NULL, NULL),
(5, 'Greek', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:55', NULL, NULL),
(6, 'French', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:54', NULL, NULL),
(7, 'Thai', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:52', NULL, NULL),
(8, 'Spanish', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:50', NULL, NULL),
(9, 'Indian', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:49', NULL, NULL),
(10, 'Mediterranean', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:47', NULL, NULL),
(11, 'British', 'cuisine_1541053458.jpg', 1, '2018-11-06 10:03:45', NULL, NULL),
(12, 'Vegan', 'cuisine_1541053458.jpg', 1, '2018-11-06 04:57:53', '2018-11-01 01:55:30', NULL),
(13, 'Sea Food', 'cuisine_1542024749.jpg', 1, '2018-11-23 04:59:45', '2018-11-23 00:29:45', NULL),
(14, 'Chinese123', '', 1, '2018-11-12 12:13:27', NULL, '2018-11-12 07:43:27');

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
  `activation_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `profile_picture`, `username`, `address`, `mobile_number`, `dob`, `zipcode`, `device_type`, `device_token`, `social_id`, `social_type`, `status`, `created_at`, `updated_at`, `deleted_at`, `gender`, `latitude`, `longitude`, `remember_token`, `activation_token`) VALUES
(6, 'DullRat@mailinator.com', '$2y$10$s5xq4SSBkVvXZow/pR6f9.mNUDyTNaonrZSsLwjTNPI27tahx3ASO', 'customer_1546514755.jpg', 'Dull Rat', 'city center 2, science city', '8866580502', '0000-00-00', '', 0, '', 0, '', 1, '2019-01-03 06:55:55', NULL, NULL, '', '', '', '', ''),
(25, 'PieThunder@mailinator.com', '$2y$10$TJ0cFGhfYRvD.9OSimFFAekIE4ZLFHiUi0SKaZmemq4p9fGp1m7BG', 'customer_1547014012.jpg', 'Pie Thunder', 'Dallas-Fort Worth Metropolitan Area, TX, USA', '354645654546', '0000-00-00', '', 0, '', 0, '', 1, '2019-01-09 01:35:17', '2019-01-09 01:36:52', NULL, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `preferred_city` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL COMMENT '0 - male, 1- female',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) NOT NULL,
  `activation_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `email`, `password`, `profile_picture`, `username`, `address`, `mobile_number`, `zipcode`, `status`, `preferred_city`, `latitude`, `longitude`, `gender`, `created_at`, `updated_at`, `deleted_at`, `remember_token`, `activation_token`) VALUES
(1, 'test@gmail.com', '', '', 'my boy', 'my addtesss', '8866584215', '56564', 2, '0', '', '', '1', '2019-01-10 11:05:00', NULL, NULL, '', ''),
(2, 'BusyToots@mailinator.com', '$2y$10$bf5fPWdzuQbPZdJbK5B3Y.preIgnVqTH5QVd1Kkg/IHlA6N2u6EV.', 'delivery_boy_1547119844.jpg', 'Dhrumiiiii', 'F.S.C.J. North Campus, Jacksonville, FL, USA', '7745871466', '', 1, '', '', '', '', '2019-01-10 07:00:44', '2019-01-10 08:15:20', NULL, '', '');

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
  `status` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_dispatcher`
--

INSERT INTO `delivery_dispatcher` (`id`, `email`, `password`, `profile_picture`, `full_name`, `contact_no`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dispatcher@gmail.com', '', '', 'dispatcher one', '', '', 2, '2019-01-02 09:31:53', '2019-01-03 02:53:35', NULL),
(2, 'dispatcher2@gmail.com', '', '', 'dispatcher two', '', '', 2, '2019-01-03 09:31:53', NULL, '2019-01-02 06:49:34'),
(3, 'deliverydispatcher@gmail.com', '$2y$10$5bllpD4EDDtQirrFD4Jr7u.6Osz.gQx6J.7pOr8rDvW5/CzNZErgG', 'dispatcher_1547117044.jpg', 'Deliverydispatcher Three', '5656657567567', 'DSS and E Middle Tpke, Manchester, CT, USA', 1, '2019-01-02 07:07:22', '2019-01-10 06:14:11', NULL),
(4, 'deliverydispatcher4@excellentwebworld.in', '$2y$10$0F0OJoaUa/fZ73GKY784wuGWQz18vqCKOXThS6TGX9aDegu0fO7Fe', 'delivery_dispatcher_1546429150.jpg', 'Delivery Four', '43534543534', 'fffff', 1, '2019-01-02 07:09:10', '2019-01-02 07:22:07', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `emat_is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `emat_email_type`, `emat_email_name`, `emat_email_subject`, `emat_email_message`, `created_at`, `updated_at`, `emat_is_active`) VALUES
(9, 1, 'new_registration_vender', 'New Registration by vender', 0x3c6832207374796c653d22746578742d616c69676e3a2063656e7465723b202220636c6173733d226d79636c617373223e57656c636f6d6520746f20504f532053797374656d3c2f68323e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e48656c6c6f207b76656e6465725f6e616d657d2c3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e636c69636b206f6e2074686973206c696e6b20746f206163746976617465206163636f756e743c2f703e3c6835207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b61637469766174696f6e5f6c696e6b7d22207461726765743d225f626c616e6b22207374796c653d22206261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b20666f6e742d73697a653a20313370783b20646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d7765696768743a203430303b20746578742d616c69676e3a2063656e7465723b2077686974652d73706163653a206e6f777261703b20766572746963616c2d616c69676e3a206d6964646c653b2070616464696e673a202e33373572656d202e373572656d3b206c696e652d6865696768743a20312e353b20626f726465722d7261646975733a202e323572656d3b20746578742d6465636f726174696f6e3a206e6f6e653b20223e41637469766174696f6e204c696e6b3c2f613e3c2f68353e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c753e3c2f753e3c2f703e, '2018-10-18 18:30:00', '2019-01-09 08:34:22', 1),
(18, 2, 'reset_password', 'Request to reset your password', 0x3c683220636c6173733d226d79636c61737322207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20636f6c6f723a2072676228302c20302c2030293b20746578742d616c69676e3a2063656e7465723b223e466f72676f7420796f75722070617373776f72643f3c2f68323e3c68723e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e266e6273703b53696d706c7920636c69636b206f6e2074686520627574746f6e2062656c6f7720616e6420666f6c6c6f772074686520737465707320746f206372656174652061206e6577206f6e652e3c62723e3c2f703e3c6835207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20636f6c6f723a2072676228302c20302c2030293b20746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b0d0a20202020202020202020202020202020666f6e742d73697a653a20313370783b0d0a20202020202020202020202020202020646973706c61793a20696e6c696e652d626c6f636b3b0d0a20202020202020202020202020202020666f6e742d7765696768743a203430303b0d0a20202020202020202020202020202020746578742d616c69676e3a2063656e7465723b0d0a2020202020202020202020202020202077686974652d73706163653a206e6f777261703b0d0a20202020202020202020202020202020766572746963616c2d616c69676e3a206d6964646c653b0d0a2020202020202020202020202020202070616464696e673a202e33373572656d202e373572656d3b0d0a202020202020202020202020202020206c696e652d6865696768743a20312e353b0d0a20202020202020202020202020202020626f726465722d7261646975733a202e323572656d3b0d0a202020202020202020202020202020207472616e736974696f6e3a20636f6c6f72202e31357320656173652d696e2d6f75742c6261636b67726f756e642d636f6c6f72202e31357320656173652d696e2d6f75742c626f726465722d636f6c6f72202e31357320656173652d696e2d6f75742c626f782d736861646f77202e31357320656173652d696e2d6f75743b0d0a20202020202020202020202020202020746578742d6465636f726174696f6e3a206e6f6e653b223e5265636f76657279204c696e6b3c2f613e3c2f68353e3c70207374796c653d2220746578742d616c69676e3a2063656e7465723b223e266e6273703b496620796f7520646964206e6f742061736b20746f20726573657420796f75722070617373776f72642c20706c656173652069676e6f72652074686973206d6573736167652e3c2f703e3c70207374796c653d2220746578742d616c69676e3a2063656e7465723b223e3c753e3c62723e3c2f753e3c2f703e, '2018-10-26 18:30:00', '2019-01-09 08:31:01', 1),
(19, 3, 'new_customer_by_admin', 'Welcome to ClickLunch', 0x3c683220636c6173733d226d79636c61737322207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20636f6c6f723a2072676228302c20302c2030293b20746578742d616c69676e3a2063656e7465723b223e57656c636f6d6520746f20436c69636b204c756e63683c2f68323e3c68723e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e48656c6c6f2c207b637573746f6d65725f6e616d657d213c62723e596f7572206163636f756e74206973266e6273703b7375636365737366756c6c79206372656174656420696e20636c69636b206c756e63682e20596f752063616e2061636365737320796f7572206163636f756e742062792062656c6f772063726564656e7469616c732e266e6273703b3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e456d61696c203a266e6273703b3c623e7b656d61696c7d3c2f623e3c62723e50617373776f7264203a203c623e7b70617373776f72647d3c2f623e3c62723e3c2f703e3c6833207374796c653d22746578742d616c69676e3a2063656e7465723b20223e3c6120687265663d22687474703a2f2f6c6f63616c686f73742f636c69636b5f6c756e63682f6c6f67696e2d76656e64657222207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b0d0a20202020202020202020202020202020626f726465723a2031707820736f6c696420233245324434443b0d0a20202020202020202020202020202020636f6c6f723a20236666666666663b0d0a20202020202020202020202020202020666f6e742d73697a653a20313370783b0d0a20202020202020202020202020202020646973706c61793a20696e6c696e652d626c6f636b3b0d0a20202020202020202020202020202020666f6e742d7765696768743a203430303b0d0a20202020202020202020202020202020746578742d616c69676e3a2063656e7465723b0d0a2020202020202020202020202020202077686974652d73706163653a206e6f777261703b0d0a20202020202020202020202020202020766572746963616c2d616c69676e3a206d6964646c653b0d0a2020202020202020202020202020202070616464696e673a202e33373572656d202e373572656d3b0d0a202020202020202020202020202020206c696e652d6865696768743a20312e353b0d0a20202020202020202020202020202020626f726465722d7261646975733a202e323572656d3b0d0a202020202020202020202020202020207472616e736974696f6e3a20636f6c6f72202e31357320656173652d696e2d6f75742c6261636b67726f756e642d636f6c6f72202e31357320656173652d696e2d6f75742c626f726465722d636f6c6f72202e31357320656173652d696e2d6f75742c626f782d736861646f77202e31357320656173652d696e2d6f75743b0d0a20202020202020202020202020202020746578742d6465636f726174696f6e3a206e6f6e653b223e4c6f67696e204c696e6b3c2f613e3c2f68333e3c703e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e203c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e53696d706c7920636c69636b206f6e2074686520627574746f6e2062656c6f7720616e6420666f6c6c6f772074686520737465707320746f2075706461746520796f75722070617373776f72642e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c75207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20666f6e742d73697a653a20312e323572656d3b206261636b67726f756e642d636f6c6f723a20726762283235352c203235352c20323535293b223e3c6120687265663d227b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b22207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20666f6e742d73697a653a20312e323572656d3b206261636b67726f756e642d636f6c6f723a20726762283235352c203235352c20323535293b223e50617373776f7264205570646174696f6e204c696e6b3c2f613e3c2f753e3c2f703e3c68723e3c70207374796c653d2220746578742d616c69676e3a2063656e7465723b223e266e6273703b496620796f7520646964206e6f742061736b20666f7220637265617465206163636f756e742c20706c656173652069676e6f72652074686973206d6573736167652e3c753e3c6120687265663d22687474703a2f2f7b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b223e3c62723e3c2f613e3c2f753e3c2f703e, '2019-01-02 18:30:00', '2019-01-09 08:29:39', 1),
(20, 4, 'new_deliveryboy_by_admin', 'Welcome to ClickLunch', 0x3c683220636c6173733d226d79636c61737322207374796c653d22666f6e742d66616d696c793a20506f7070696e732c2073616e732d73657269663b20636f6c6f723a2072676228302c20302c2030293b20746578742d616c69676e3a2063656e7465723b223e57656c636f6d6520746f20436c69636b204c756e63683c2f68323e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e48656c6c6f2c207b64656c6976657279626f795f6e616d657d213c62723e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e5468616e6b20796f7520666f72207265676973746572696e6720617420436c69636b204c756e63682c205765206172652064656c69676874656420746f206861766520796f75206173206120637573746f6d6572206f6620436c69636b204c756e63682e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c7370616e207374796c653d22746578742d616c69676e3a206c6566743b223e596f752063616e2061636365737320796f7572206163636f756e742062792062656c6f772063726564656e7469616c732e266e6273703b3c2f7370616e3e3c2f703e3c703e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e456d61696c203a266e6273703b3c623e7b656d61696c7d3c2f623e3c62723e50617373776f7264203a203c623e7b70617373776f72647d3c2f623e3c62723e3c2f703e3c6833207374796c653d22746578742d616c69676e3a2063656e7465723b20223e3c6120687265663d22687474703a2f2f6c6f63616c686f73742f636c69636b5f6c756e63682f6c6f67696e2d76656e64657222207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b20666f6e742d73697a653a20313370783b20646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d7765696768743a203430303b20746578742d616c69676e3a2063656e7465723b2077686974652d73706163653a206e6f777261703b20766572746963616c2d616c69676e3a206d6964646c653b2070616464696e673a202e33373572656d202e373572656d3b206c696e652d6865696768743a20312e353b20626f726465722d7261646975733a202e323572656d3b20746578742d6465636f726174696f6e3a206e6f6e653b223e4c6f67696e204c696e6b3c2f613e3c2f68333e3c703e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e203c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e53696d706c7920636c69636b206f6e2074686520627574746f6e2062656c6f7720616e6420666f6c6c6f772074686520737465707320746f2075706461746520796f75722070617373776f72642e3c2f703e3c70207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b22207374796c653d226261636b67726f756e642d636f6c6f723a20233245324434443b20626f726465723a2031707820736f6c696420233245324434443b20636f6c6f723a20236666666666663b20666f6e742d73697a653a20313370783b20646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d7765696768743a203430303b20746578742d616c69676e3a2063656e7465723b2077686974652d73706163653a206e6f777261703b20766572746963616c2d616c69676e3a206d6964646c653b2070616464696e673a202e33373572656d202e373572656d3b206c696e652d6865696768743a20312e353b20626f726465722d7261646975733a202e323572656d3b20746578742d6465636f726174696f6e3a206e6f6e653b223e50617373776f7264205570646174696f6e204c696e6b3c2f613e3c2f703e3c70207374796c653d2220746578742d616c69676e3a2063656e7465723b223e266e6273703b496620796f7520646964206e6f742061736b20666f7220637265617465206163636f756e742c20706c656173652069676e6f72652074686973206d6573736167652e3c753e3c6120687265663d22687474703a2f2f7b7265636f766572795f6c696e6b7d22207461726765743d225f626c616e6b223e3c62723e3c2f613e3c2f753e3c2f703e, '2019-01-02 18:30:00', '2019-01-10 06:57:38', 1);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `email`, `password`, `role`, `shop_id`, `first_name`, `last_name`, `profile_picture`, `contact_no`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'emp1@mailinator.com', '', 2, 52, 'Employee', 'One', '', '', 0, '2018-11-12 06:49:49', NULL, '2018-11-12 02:19:49'),
(7, 'simplegeek@mailinator.com', '$2y$10$gYRNyiOh2Jp9h7G0i53hjuWwoetJuOD7syx9mni8pExhatA.b4ahW', 2, 52, 'Simple', 'Geek', '', '', 1, '2018-11-12 07:14:42', '2018-11-12 00:41:55', '2018-11-12 02:44:42'),
(8, 'missimp@mailinator.com', '$2y$10$Go2KgldtPjbYScE5q94pIORjTWAEzu1YDUuGR.61at5vYThocZv6C', 2, 52, 'Misso', 'Imp', 'employee_1542015101.png', '', 1, '2018-11-22 11:52:42', '2018-11-22 06:34:08', NULL),
(9, 'adghfgmin@eww.com', '', 2, 52, 'Zany', 'Ghj', '', '', 0, '2018-11-12 07:18:58', NULL, '2018-11-12 02:48:58'),
(10, 'admin@eww.com', '', 2, 52, 'Gjghj', 'Ghj', '', '', 0, '2018-11-12 07:29:35', NULL, '2018-11-12 02:59:35'),
(11, 'ghj@ghj.ghj', '', 2, 52, 'Gjghj', 'Toee', '', '', 0, '2018-11-12 07:30:20', NULL, '2018-11-12 03:00:20'),
(12, 'PieRascal@mailinator.com', '$2y$10$zG.b1BXPljcFFCsQAeZ2yuGAFKQjFUPb.c7Bd7uJSdK90C/WrxUhS', 2, 52, 'Pie', 'Rasca', 'employee_1547029587.jpg', '', 1, '2019-01-09 10:28:32', '2019-01-09 05:58:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `offer_price` varchar(11) NOT NULL,
  `item_description` text NOT NULL,
  `item_picture` varchar(255) NOT NULL,
  `is_combo` int(11) NOT NULL,
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

INSERT INTO `item` (`id`, `shop_id`, `name`, `cuisine_id`, `quantity`, `price`, `offer_price`, `item_description`, `item_picture`, `is_combo`, `inventory_status`, `notify_stock`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 52, 'Masala Frankie', 10, 80, '60.00', '56.00', 'Combine The Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501653.jpg', 0, 1, 12, 1, '2018-11-06 06:24:13', NULL, NULL),
(19, 52, 'Chinese Frankie', 10, 100, '90.00', '89.00', 'Mashed Potatoes, Carrot, Cheese, Onions, Chat Masala Powder, Lemon Juice And Salt', 'item_1541501826.jpeg', 0, 0, 0, 1, '2018-11-06 06:27:06', NULL, NULL),
(20, 52, 'Chicken P\\\"izza', 9, 20, '200.00', '189.00', 'Our Family Will Never Guess That This Fun Twist On Typical Pizza Uses Up Leftover Pesto. Loaded With Protein, Hearty Slices Of This Chicken Pizza\\\" Will Fill Them Up Fast!', 'item_1542019186.png', 1, 0, 0, 1, '2018-11-12 09:41:00', NULL, NULL),
(21, 52, 'Test', 10, 1, '33.33', '10.00', 'Dfgdfg', 'item_1542018900.jpg', 1, 0, 0, 1, '2018-11-12 06:05:00', NULL, '2018-11-12 06:05:24'),
(22, 52, 'Dhrumi', 3, 4, '100.00', '77.00', 'Fgdg', '', 0, 0, 0, 1, '2019-01-07 00:44:50', NULL, '2019-01-07 00:45:04'),
(23, 52, 'Sushi', 10, 100, '100.00', '77.00', '78768ggggg', '', 0, 0, 0, 1, '2019-01-07 00:45:50', NULL, NULL),
(24, 52, 'Burger Meal Combo', 2, 1, '100.00', '77.00', 'Dfddf', 'item_1546838672.jpg', 0, 0, 0, 1, '2019-01-07 00:54:32', NULL, NULL),
(25, 52, 'P12', 3, 1, '100.00', '77.00', 'Edd', '', 0, 1, 0, 1, '2019-01-07 01:34:34', NULL, NULL),
(26, 52, 'C1', 2, 1, '100.00', '9.00', 'Gg', '', 1, 1, 10, 1, '2019-01-07 00:58:20', NULL, NULL);

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
  `total` varchar(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `delivery_charges` varchar(255) NOT NULL,
  `promocode` varchar(255) NOT NULL,
  `discount_amount` varchar(255) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` varchar(255) NOT NULL,
  `order_status` int(5) NOT NULL,
  `payment_status` int(5) NOT NULL COMMENT '0- pending , 1- success, 2 - failed',
  `payment_mode` int(5) NOT NULL COMMENT '0  - Card , 1 -  Apple Pay, 2 -  Google Pay, 3- COD',
  `transaction_id` int(11) NOT NULL,
  `suggestion` text NOT NULL,
  `QR_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `shop_id` varchar(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `promocode` varchar(255) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `discount_type` varchar(255) NOT NULL COMMENT '0- flat, 1 - perc',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `apply_on` int(5) NOT NULL,
  `promo_min_order` varchar(11) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `shop_id`, `item_id`, `promocode`, `amount`, `discount_type`, `from_date`, `to_date`, `apply_on`, `promo_min_order`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, '52', 0, 'OFF50', '50', '1', '2018-11-06', '2018-11-30', 0, '100', 1, '2018-11-06 06:07:27', '2018-11-06 06:09:07', NULL),
(18, '52', 0, 'OFF20', '20', '1', '2018-11-10', '2018-11-30', 0, '200', 1, '2018-11-06 06:27:56', NULL, NULL),
(19, '52', 0, 'GET505', '2', '0', '2018-11-30', '2018-12-01', 0, '496.00', 0, '2018-11-12 05:27:16', NULL, NULL),
(20, '52', 0, 'ACDF', '12.22', '0', '2018-11-15', '2018-11-24', 0, '17.12', 1, '2018-11-12 05:34:13', '2018-11-12 05:40:02', NULL),
(21, '52', 0, 'GET577', '2', '0', '2018-11-30', '2018-12-01', 0, '496.00', 1, '2018-11-12 05:27:16', NULL, NULL),
(22, '52', 0, 'KOP', '12.22', '0', '2018-11-15', '2018-11-24', 0, '17.12', 1, '2018-11-12 05:34:13', '2018-11-12 05:40:02', NULL),
(23, '', 0, 'GET507', '99', '1', '2018-12-31', '2019-01-05', 0, '80', 1, '2018-12-21 02:11:06', NULL, NULL);

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
  `orders` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `profile`, `item`, `inventory`, `promocode`, `orders`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1),
(2, 'Manager', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
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
  `payment_mode` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 - Card , 1 - Apple Pay, 2 - Google Pay',
  `delivery_charges` varchar(11) NOT NULL,
  `tax_number` varchar(255) NOT NULL,
  `device_type` int(5) NOT NULL COMMENT '	0-web, 1- android, 2 -ios',
  `device_token` varchar(255) NOT NULL,
  `broacher` varchar(255) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0  - pending , 1 - active, 2 - deactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `email`, `password`, `shop_name`, `percentage`, `vender_name`, `shop_code`, `profile_picture`, `address`, `zip_code`, `city`, `state`, `country`, `latitude`, `longitude`, `about`, `contact_no1`, `contact_no2`, `website`, `facebook_link`, `twitter_link`, `pinterest_link`, `min_order`, `payment_mode`, `delivery_charges`, `tax_number`, `device_type`, `device_token`, `broacher`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 'sugar@mailinator.com', '$2y$10$2Qov5hbktXILNk8/EezJi.rakocg80gqr75xA7JIFLNVHLoLgQlvi', 'Ristretto - Behi', '10', 'Mr Ristretto', 'RIS52', 'vender_1541502113.jpg', 'Science Ciy Road, Sola, Ah', '', '0', '0', '', '', '', 'Your family will never guess that this fun twist on typical pizza uses up leftover pesto. Loaded with protein, hearty slices of this chicken pizza will fill them up fast!', '8866584541', '7745871466', 'https://www.zomato.com/ah', '', '', '', '100.00', '0,1,2,3', '6.00', '657-57-5765', 0, '', 'brochure_1541502113.jpg', 1, '2018-11-06 05:49:41', '2018-11-12 09:03:10', NULL),
(53, 'palboy@mailinator.com', '', 'Test Shop', '10.50', 'Pal', 'TES53', 'vender_1541999590.jpg', 'Gota, Ahmedabad, Gujarat, India', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, '2018-11-12 00:43:10', NULL, NULL),
(54, 'palcakes@mailinator.com', '$2y$10$9H2n2v7cI.lNp3E0JvAJoerpKhmOQxebMeWD2rnlcEETivT5B3nky', 'Git', '8.00', 'Frl', 'GIT54', '', 'Del\\\"hi, Ind\\\"ia', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 0, '', '', 1, '2018-11-12 09:06:52', '2018-11-23 00:41:26', NULL),
(55, 'Cafe@eww.com', '', 'The Hytt Cafe', '10.00', 'Giop', 'THE55', '', 'Hynes Convention Center, Boston, MA, USA', '02115', 'Suffolk County', 'Massachusetts', 'United States', '42.34797469999999', '-71.08792840000001', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, '2019-01-03 09:21:24', NULL, NULL),
(56, 'PunchyMan@mailinator.com', '', 'Punchy Man', '', 'Dhrumi', 'PUN56', '', 'DFW Remote North Parking, Grapevine, TX, USA', '33598', 'Hillsborough County', 'Florida', 'United States', '32.926195', '-97.04413999999997', '', '7745871466', '4353455434', '', '', '', '', '', '', '', '', 0, '', '', 0, '2019-01-09 01:52:15', NULL, NULL),
(57, 'SmartDoody@mailinator.com', '$2y$10$CjPL17v5/rIGScMxRYs8x.9VT0K84Z109Z9niH80PKnJSOPcj//Oa', 'Smart Doody', '', 'Doody', 'SMA57', 'vender_1547103263.jpg', 'Hynes Convention Center (Boylston Street and Gloucester Street), Boston, MA, USA', '02199', 'Suffolk County', 'Massachusetts', 'United States', '42.3483041', '-71.08359259999997', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 1, '2019-01-10 02:23:39', '2019-01-10 02:24:23', NULL);

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
(300, 52, 'Sunday', '', '', 1, 0, '2018-11-13 01:53:02'),
(301, 52, 'Monday', '', '', 1, 0, '2018-11-13 01:53:02'),
(302, 52, 'Tuesday', '', '', 1, 0, '2018-11-13 01:53:02'),
(303, 52, 'Wednesday', '', '', 1, 0, '2018-11-13 01:53:02'),
(304, 52, 'Thursday', '', '', 1, 0, '2018-11-13 01:53:02'),
(305, 52, 'Friday', '', '', 1, 0, '2018-11-13 01:53:02'),
(306, 52, 'Saturday', '', '', 1, 0, '2018-11-13 01:53:02');

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
(69, 52, 3),
(70, 52, 6);

-- --------------------------------------------------------

--
-- Table structure for table `shop_tags`
--

CREATE TABLE `shop_tags` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 52, 'Gg\\\'l', 0, 0, '2018-11-12 14:05:55', NULL, '2018-11-12 09:35:55');

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
(33, 8, 'Small', 20, '25.00', '2018-11-12 09:41:00'),
(34, 8, 'Medium', 20, '40.00', '2018-11-12 09:41:00'),
(35, 7, 'all', 23, '50', '2019-01-07 00:45:50'),
(36, 7, 'small', 23, '10', '2019-01-07 00:45:50'),
(37, 8, 'small', 24, '10', '2019-01-07 00:54:32'),
(38, 8, 'med', 24, '15', '2019-01-07 00:54:32');

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
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
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
-- Indexes for table `shop_tags`
--
ALTER TABLE `shop_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_dispatcher`
--
ALTER TABLE `delivery_dispatcher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item_variant`
--
ALTER TABLE `order_item_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `shop_availibality`
--
ALTER TABLE `shop_availibality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `shop_cuisines`
--
ALTER TABLE `shop_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `shop_tags`
--
ALTER TABLE `shop_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variant_group`
--
ALTER TABLE `variant_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `variant_items`
--
ALTER TABLE `variant_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
