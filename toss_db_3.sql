-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2016 at 08:08 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_list`
--

CREATE TABLE IF NOT EXISTS `tbl_activity_list` (
`activity_id` int(11) NOT NULL,
  `activity_name` varchar(45) NOT NULL,
  `activity_points` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1= active and 2 = in-active',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addon`
--

CREATE TABLE IF NOT EXISTS `tbl_addon` (
  `venue_id` int(11) NOT NULL,
  `base_type_id` int(11) NOT NULL,
  `base_type` tinyint(4) NOT NULL COMMENT '1=category and 2 = sub-category',
  `addon_name` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_details`
--

CREATE TABLE IF NOT EXISTS `tbl_bank_details` (
  `vendor_id` int(11) DEFAULT NULL,
  `beneficiary_name` varchar(245) DEFAULT NULL,
  `account_number` varchar(45) DEFAULT NULL,
  `account_type` varchar(20) DEFAULT NULL,
  `ifsc_code` varchar(15) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `booking_id` varchar(45) NOT NULL DEFAULT '',
  `venue_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `booking_type` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `cancel_amount` float DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `canceled_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_device_details`
--

CREATE TABLE IF NOT EXISTS `tbl_device_details` (
  `user_id` int(11) NOT NULL,
  `device_id` varchar(512) NOT NULL,
  `device_token` varchar(512) NOT NULL,
  `device_type` tinyint(2) NOT NULL COMMENT '1= IOS 2=Android'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facilities`
--

CREATE TABLE IF NOT EXISTS `tbl_facilities` (
`facility_id` int(11) NOT NULL,
  `facility_name` varchar(45) NOT NULL,
  `facility_image` varchar(256) NOT NULL,
  `status` varchar(45) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `payment_id` varchar(45) NOT NULL DEFAULT '',
  `booking_id` varchar(45) NOT NULL,
  `transation_id` varchar(45) DEFAULT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prices`
--

CREATE TABLE IF NOT EXISTS `tbl_prices` (
  `price_id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `price_type` tinyint(8) DEFAULT NULL,
  `base_type_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `discount_type` tinyint(4) DEFAULT '1' COMMENT '1= % and 2 = flat',
  `discount_amount` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `venue_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
`review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review_details`
--

CREATE TABLE IF NOT EXISTS `tbl_review_details` (
  `review_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `message` varchar(512) NOT NULL,
  `review_type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_categories` (
`sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` varchar(45) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time_slots`
--

CREATE TABLE IF NOT EXISTS `tbl_time_slots` (
  `day_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `slot_from_time` time DEFAULT NULL,
  `slot_to_time` time DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
`user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `gender` tinyint(2) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `profile_pic` varchar(256) DEFAULT NULL,
  `otp` varchar(4) DEFAULT NULL,
  `coins` float NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_user_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE IF NOT EXISTS `tbl_user_types` (
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '5' COMMENT '0= superadmin 1=admin 2= vendor admin 3 = venue manger 4= venu staff 5=app user',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
`vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `pan` varchar(45) DEFAULT NULL,
  `pan_image` varchar(256) DEFAULT NULL,
  `vat` varchar(45) DEFAULT NULL,
  `vat_image` varchar(256) DEFAULT NULL,
  `tan` varchar(45) DEFAULT NULL,
  `tan_image` varchar(256) DEFAULT NULL,
  `cst` varchar(45) DEFAULT NULL,
  `cst_image` varchar(256) DEFAULT NULL,
  `service_tax` varchar(45) NOT NULL,
  `service_tax_image` varchar(256) NOT NULL,
  `cancelled_cheque_image` varchar(256) NOT NULL,
  `web_url` varchar(512) DEFAULT NULL,
  `web_url2` varchar(512) DEFAULT NULL,
  `terms` text,
  `terms_accept` tinyint(4) DEFAULT NULL,
  `other_info_one` varchar(256) DEFAULT NULL,
  `other_info_two` varchar(256) DEFAULT NULL,
  `other_info_three` varchar(256) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venues`
--

CREATE TABLE IF NOT EXISTS `tbl_venues` (
`venue_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `venue_display_name` varchar(100) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `address2` varchar(256) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `pincode` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lng` varchar(45) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `venue_pic_1` varchar(256) DEFAULT NULL,
  `venue_pic_2` varchar(256) DEFAULT NULL,
  `venue_pic_3` varchar(256) DEFAULT NULL,
  `venue_pic_4` varchar(256) DEFAULT NULL,
  `venue_pic_5` varchar(256) DEFAULT NULL,
  `like_count` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_category`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_category` (
  `venue_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_facilities`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_facilities` (
  `venue_id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_sub_category`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_sub_category` (
  `venue_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_working_hours`
--

CREATE TABLE IF NOT EXISTS `tbl_working_hours` (
  `venue_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_list`
--
ALTER TABLE `tbl_activity_list`
 ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `tbl_addon`
--
ALTER TABLE `tbl_addon`
 ADD KEY `venue_id` (`venue_id`,`base_type_id`,`base_type`);

--
-- Indexes for table `tbl_bank_details`
--
ALTER TABLE `tbl_bank_details`
 ADD KEY `vendor_id` (`vendor_id`), ADD KEY `benifaciary_name` (`beneficiary_name`), ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
 ADD PRIMARY KEY (`booking_id`), ADD UNIQUE KEY `booking_id_UNIQUE` (`booking_id`), ADD KEY `booking_id` (`booking_id`), ADD KEY `venue_id` (`venue_id`), ADD KEY `category_id` (`category_id`), ADD KEY `day_id` (`day_id`), ADD KEY `price_id` (`price_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
 ADD PRIMARY KEY (`category_id`), ADD UNIQUE KEY `category_id_UNIQUE` (`category_id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_device_details`
--
ALTER TABLE `tbl_device_details`
 ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`), ADD KEY `user_id` (`user_id`), ADD KEY `device_type` (`device_type`);

--
-- Indexes for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
 ADD PRIMARY KEY (`facility_id`), ADD UNIQUE KEY `facility_id_UNIQUE` (`facility_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
 ADD PRIMARY KEY (`payment_id`), ADD KEY `booking_id` (`booking_id`), ADD KEY `transation_id` (`transation_id`), ADD KEY `payment_type` (`payment_type`);

--
-- Indexes for table `tbl_prices`
--
ALTER TABLE `tbl_prices`
 ADD PRIMARY KEY (`price_id`), ADD KEY `price_type` (`price_type`), ADD KEY `base_type_id` (`base_type_id`), ADD KEY `discount_type` (`discount_type`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
 ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
 ADD PRIMARY KEY (`review_id`), ADD KEY `user_id` (`user_id`), ADD KEY `venu_id` (`venue_id`);

--
-- Indexes for table `tbl_review_details`
--
ALTER TABLE `tbl_review_details`
 ADD KEY `review_id` (`review_id`), ADD KEY `user_id` (`user_id`), ADD KEY `review_type` (`review_type`);

--
-- Indexes for table `tbl_sub_categories`
--
ALTER TABLE `tbl_sub_categories`
 ADD PRIMARY KEY (`sub_category_id`), ADD UNIQUE KEY `sub_category_id_UNIQUE` (`sub_category_id`), ADD KEY `category_id` (`category_id`), ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_time_slots`
--
ALTER TABLE `tbl_time_slots`
 ADD KEY `sub_category_id` (`sub_category_id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`), ADD UNIQUE KEY `email_UNIQUE` (`email`), ADD KEY `otp_tbl_users` (`otp`);

--
-- Indexes for table `tbl_user_activity`
--
ALTER TABLE `tbl_user_activity`
 ADD KEY `activity_id` (`activity_id`,`user_id`,`created_on`);

--
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
 ADD KEY `user_id_tbl_user_type` (`user_id`);

--
-- Indexes for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
 ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `tbl_venues`
--
ALTER TABLE `tbl_venues`
 ADD PRIMARY KEY (`venue_id`), ADD KEY `lat` (`lat`), ADD KEY `lng` (`lng`), ADD KEY `venue_display_name` (`venue_display_name`), ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `tbl_venue_category`
--
ALTER TABLE `tbl_venue_category`
 ADD KEY `venue_id` (`venue_id`,`category_id`,`status`);

--
-- Indexes for table `tbl_venue_facilities`
--
ALTER TABLE `tbl_venue_facilities`
 ADD PRIMARY KEY (`venue_id`), ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `tbl_venue_sub_category`
--
ALTER TABLE `tbl_venue_sub_category`
 ADD KEY `venue_id` (`venue_id`,`sub_category_id`,`status`);

--
-- Indexes for table `tbl_working_hours`
--
ALTER TABLE `tbl_working_hours`
 ADD KEY `category_id` (`category_id`), ADD KEY `sub_category_id` (`sub_category_id`), ADD KEY `date_id` (`day_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_list`
--
ALTER TABLE `tbl_activity_list`
MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sub_categories`
--
ALTER TABLE `tbl_sub_categories`
MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_venues`
--
ALTER TABLE `tbl_venues`
MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
