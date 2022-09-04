-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2022 at 03:33 PM
-- Server version: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techsava_courier`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_code` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `country` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(1, 'vzTL0PqMogyOWhF', 'Kirinyaga Road', 'Nairobi', 'Nairobi', '1001', 'Kenya', '+254722537792', '2020-11-26 11:21:41'),
(3, 'KyIab3mYBgAX71t', 'New Light', 'Nakuru', 'nakuru', '6000', 'Kenya', '+254729790941', '2020-11-26 16:45:05'),
(4, 'dIbUK5mEh96f0Zc', 'Jamaat Bldng', 'Mombasa', 'Mombasa', '123456', 'Kenya', '+254722537792', '2020-11-27 13:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `route` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `location`, `town`, `county`, `route`) VALUES
(1, 'Quickmart', 'Roysambu', 'Roysambu', 'Nairobi', 1),
(3, 'Naivas', 'Ruiru', 'Ruiru', 'Kiambu', 3),
(5, '', '', 'Umoja', 'Nairobi', 0),
(6, 'sam', 'test', 'Umoja', 'Nairobi', 1),
(2, 'ken', 'test', 'Umoja', 'Nairobi', 2),
(8, 'Muchai', 'Nakuru', 'Umoja', 'Nairobi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer_route`
--

CREATE TABLE `customer_route` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `outbound_priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_route`
--

INSERT INTO `customer_route` (`id`, `customer`, `route`, `outbound_priority`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_address` text NOT NULL,
  `sender_contact` text NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 = Deliver, 2=Pickup',
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `weight` int(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `width` varchar(100) DEFAULT NULL,
  `length` varchar(100) NOT NULL,
  `price` float DEFAULT NULL,
  `lm` smallint(2) NOT NULL DEFAULT 0,
  `s` smallint(2) NOT NULL DEFAULT 0,
  `rc` int(2) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` varchar(20) NOT NULL,
  `loaded` tinyint(1) NOT NULL DEFAULT 0,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `vehicle` varchar(20) NOT NULL,
  `lpo_date` varchar(20) NOT NULL,
  `loaded_by` int(11) NOT NULL,
  `confimed_by` int(11) NOT NULL,
  `upload1` varchar(500) DEFAULT NULL,
  `upload2` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`, `lm`, `s`, `rc`, `status`, `date_created`, `customer_id`, `loaded`, `delivered`, `vehicle`, `lpo_date`, `loaded_by`, `confimed_by`, `upload1`, `upload2`) VALUES
(1, '201406231415', 'John Smith', 'Sample', '+123456', 'Claire Blake', 'Sample', 'Sample', 1, '1', '0', 1000, '12in', '12in', '15in', 2500, 0, 0, 0, 7, '2020-11-26 16:15:46', '1', 1, 1, '1', '2022-05-07', 1, 1, 'assets/uploads/6281bbdc6e127-1652669404.png', 'assets/uploads/6281bbdc6e784-1652669404.png'),
(2, '117967400213', 'John Smith', 'Sample', '+123456', 'Claire Blake', 'Sample', 'Sample', 2, '1', '3', 1000, '12in', '12in', '15in', 2500, 0, 0, 0, 1, '2020-11-26 16:46:03', '1', 0, 1, '1', '', 1, 0, 'assets/uploads/6281bbdc6e127-1652669404.png', 'assets/uploads/6281bbdc6e784-1652669404.png'),
(3, '983186540795', 'John Smith', 'Sample', '+123456', 'Claire Blake', 'Sample', 'Sample', 2, '1', '3', 1000, '10in', '10in', '10in', 1500, 0, 0, 0, 2, '2020-11-26 16:46:03', '3', 0, 0, '1', '', 1, 0, 'assets/uploads/6281ba1253287-1652668946.png', ''),
(4, '514912669061', 'Claire Blake', 'Sample', '+123456', 'John Smith', 'Sample Address', '+12345', 2, '4', '1', 500, '12in', '12in', '15in', 1900, 0, 0, 1, 0, '2020-11-27 13:52:14', '1', 0, 0, '1', '', 1, 0, '', ''),
(5, '897856905844', 'Claire Blake', 'Sample', '+123456', 'John Smith', 'Sample Address', '+12345', 2, '4', '1', 500, '10in', '10in', '10in', 1450, 0, 0, 1, 0, '2020-11-27 13:52:14', '1', 0, 0, '1', '', 1, 0, '', ''),
(6, '505604168988', 'John Smith', 'Sample', '+123456', 'Sample', 'Sample', '+12345', 1, '1', '0', 600, '12in', '12in', '15in', 2500, 1, 1, 0, 1, '2020-11-27 14:06:42', '2', 0, 0, '2', '', 1, 0, '', ''),
(7, '492472072635', 'fred kairu', '10306', '+254722537792', 'Florence Ngina', '10306', '+254725505359', 2, '1', '4', 300, 'n/a', '20', 'na', 400, 1, 1, 0, 8, '2022-04-28 13:44:23', '2', 0, 0, '2', '', 1, 0, '', ''),
(11, '535936836618', 'test', 'test', 'test', 'test', 'test', 'test', 2, '3', '3', 1200, 'kg', '20', '12345565666', 100, 0, 0, 1, 0, '2022-05-05 20:10:00', '2', 1, 0, '2', '', 1, 0, '', ''),
(12, '605855855625', 'test', 'test', 'test', 'test', 'test', 'test', 2, '3', '4', 500, 'kg', '20', '3444', 100, 1, 0, 0, 0, '2022-05-05 20:12:30', '2', 0, 0, '2', '', 1, 0, '', ''),
(13, '053245814051', 'test', 'test', 'test', 'test', 'test', 'test', 2, '3', '4', 2300, 'kg', '344', '5666', 3444, 1, 1, 0, 0, '2022-05-05 20:12:30', '1', 0, 0, '2', '', 0, 0, '', ''),
(14, '451616835780', 'test', 'test', 'test', 'test', 'rrr', 'test', 2, '3', '3', 500, 'err', '20', '1333', 100, 1, 1, 0, 0, '2022-05-05 20:26:23', '1', 0, 0, '2', '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `parcels_temp`
--

CREATE TABLE `parcels_temp` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_address` text NOT NULL,
  `sender_contact` text NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 = Deliver, 2=Pickup',
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `weight` int(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `width` varchar(100) DEFAULT NULL,
  `length` varchar(100) NOT NULL,
  `price` float DEFAULT NULL,
  `lm` smallint(2) NOT NULL DEFAULT 0,
  `s` smallint(2) NOT NULL DEFAULT 0,
  `rc` int(2) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` varchar(20) NOT NULL,
  `loaded` tinyint(1) NOT NULL DEFAULT 0,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `vehicle` varchar(20) NOT NULL,
  `lpo_date` varchar(20) NOT NULL,
  `loaded_by` int(11) NOT NULL,
  `confimed_by` int(11) NOT NULL,
  `upload1` varchar(500) DEFAULT NULL,
  `upload2` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcels_temp`
--

INSERT INTO `parcels_temp` (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`, `lm`, `s`, `rc`, `status`, `date_created`, `customer_id`, `loaded`, `delivered`, `vehicle`, `lpo_date`, `loaded_by`, `confimed_by`, `upload1`, `upload2`) VALUES
(1, '201406231415', 'John Smith', 'Sample', '+123456', 'Claire Blake', 'Sample', 'Sample', 1, '1', '0', 1000, '12in', '12in', '15in', 2500, 0, 0, 0, 7, '2020-11-26 16:15:46', '1', 1, 1, '1', '2022-05-07', 1, 0, 'assets/uploads/6281bbdc6e127-1652669404.png', 'assets/uploads/6281bbdc6e784-1652669404.png'),
(2, '117967400213', 'John Smith', 'Sample', '+123456', 'Claire Blake', 'Sample', 'Sample', 2, '1', '3', 1000, '12in', '12in', '15in', 2500, 0, 0, 0, 1, '2020-11-26 16:46:03', '1', 1, 1, '1', '', 1, 0, 'assets/uploads/6281bbdc6e127-1652669404.png', 'assets/uploads/6281bbdc6e784-1652669404.png');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `date_created`) VALUES
(1, 2, 1, '2020-11-27 09:53:27'),
(2, 3, 1, '2020-11-27 09:55:17'),
(3, 1, 1, '2020-11-27 10:28:01'),
(4, 1, 2, '2020-11-27 10:28:10'),
(5, 1, 3, '2020-11-27 10:28:16'),
(6, 1, 4, '2020-11-27 11:05:03'),
(7, 1, 5, '2020-11-27 11:05:17'),
(8, 1, 7, '2020-11-27 11:05:26'),
(9, 3, 2, '2020-11-27 11:05:41'),
(10, 6, 1, '2020-11-27 14:06:57'),
(11, 7, 3, '2022-04-28 13:46:25'),
(12, 7, 8, '2022-04-28 14:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Line Manager'),
(2, 'Security'),
(3, 'Returning Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `inbound_outbound` char(3) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `name`, `town`, `county`, `inbound_outbound`, `active`) VALUES
(1, 'Thika Rd', 'Roysambu', 'Nairobi', 'O', 1),
(2, 'Umoja', 'Umoja', 'Nairobi', 'O', 1),
(3, 'Tao', 'Umoja', 'Nairobi', 'O', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Shipping Management System', 'info@techsavanna.technology', '+254722537792', 'Reliance Center Westlands', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `role` varchar(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `role`, `branch_id`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', 0, '2020-11-26 10:57:04'),
(2, 'John', 'Karanja', 'jsmith@techsavanna.technology', '1254737c076cf867dc53d60a0364f38e', 2, '', 1, '2020-11-26 11:52:04'),
(3, 'George', 'Njoroge', 'gwilson@techsavanna.technology', 'd40242fb23c45206fadee4e2418f274f', 2, '', 4, '2020-11-27 13:32:12'),
(10, 'Return', 'Clerk', 'returnclerk@gmail.com', '089b5b958363ef3affb805b9bb0847ea', 2, '3', 3, '2022-05-11 13:28:13'),
(8, 'Line', 'Manager', 'linemanager@gmail.com', 'd8e3b561892a6e1bdbfa9af22145ec56', 2, '1', 4, '2022-05-05 23:40:23'),
(9, 'Security', 'Test', 'security@gmail.com', 'e91e6348157868de9dd8b25c81aebfb9', 2, '2', 3, '2022-05-06 09:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `capacity_weight` int(20) NOT NULL,
  `capacity_vol` int(20) NOT NULL,
  `capacity_ltr` int(20) NOT NULL,
  `loaded` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `plate`, `capacity_weight`, `capacity_vol`, `capacity_ltr`, `loaded`) VALUES
(5, '1.5 Tuner (Small)', 2000, 4000, 3000, 0),
(4, 'probox', 3000, 290, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_route`
--

CREATE TABLE `vehicle_route` (
  `id` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `day` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_route`
--

INSERT INTO `vehicle_route` (`id`, `vehicle`, `route`, `day`) VALUES
(1, 1, 1, '2022-05-07'),
(2, 2, 2, '2022-05-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_route`
--
ALTER TABLE `customer_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels_temp`
--
ALTER TABLE `parcels_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_route`
--
ALTER TABLE `vehicle_route`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_route`
--
ALTER TABLE `customer_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parcels_temp`
--
ALTER TABLE `parcels_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_route`
--
ALTER TABLE `vehicle_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
