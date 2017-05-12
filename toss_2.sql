-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2016 at 05:49 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toss`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

CREATE TABLE `tbl_bookings` (
  `booking_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `price` float(8,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `booking_status` tinyint(4) NOT NULL DEFAULT '1',
  `bookingdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`booking_id`, `vendor_id`, `venue_id`, `category_id`, `subcategory_id`, `slot_id`, `user_id`, `manager_id`, `user_type`, `price`, `qty`, `booking_status`, `bookingdate`) VALUES
(1, 2, 1, 1, 1, 1, 2, 4, 4, 6000.00, 1, 1, '2015-12-18 08:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT '1',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `category_name`, `category_status`, `datecreated`) VALUES
(1, 'fitness', 1, '2015-12-30 06:08:38'),
(2, 'stadium', 1, '2015-12-30 06:08:53'),
(3, 'test', 1, '2015-12-30 06:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facilities`
--

CREATE TABLE `tbl_facilities` (
  `f_id` int(11) NOT NULL,
  `faclty_name` varchar(250) NOT NULL,
  `facl_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facilities`
--

INSERT INTO `tbl_facilities` (`f_id`, `faclty_name`, `facl_status`, `datecreated`) VALUES
(1, 'experienced trainers', 1, '2016-01-21 11:39:14'),
(2, 'Pre packaged snacks and fruit bow', 1, '2016-01-21 11:44:16'),
(3, 'Preffered magazines and newspapers', 1, '2016-01-21 11:45:06'),
(4, '29\\''\\'' inches flat panel HDTV with DIRECTV', 1, '2016-01-21 11:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `pay_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `tansaction_id` int(11) NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `payment` float(8,2) NOT NULL,
  `transaction_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`pay_id`, `booking_id`, `tansaction_id`, `payment_type`, `payment`, `transaction_status`, `datecreated`) VALUES
(1, 1, 3456, 1, 6000.00, 1, '2015-12-18 11:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `rt_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviewdetails`
--

CREATE TABLE `tbl_reviewdetails` (
  `resp_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `review_type` int(11) NOT NULL COMMENT '1=review, 2=reply',
  `response_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `rev_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slots`
--

CREATE TABLE `tbl_slots` (
  `slt_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `slot_time` varchar(50) NOT NULL,
  `slot_price` float(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `slot_status` tinyint(4) NOT NULL DEFAULT '1',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slots`
--

INSERT INTO `tbl_slots` (`slt_id`, `venue_id`, `category_id`, `subcategory_id`, `manager_id`, `day_id`, `slot_time`, `slot_price`, `quantity`, `slot_status`, `datecreated`) VALUES
(1, 1, 1, 1, 4, 1, '6am-7am', 6000.00, 4, 1, '2015-12-18 07:27:32'),
(2, 1, 1, 1, 4, 2, '7am-8am', 7000.00, 4, 1, '2015-12-18 07:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sport_events`
--

CREATE TABLE `tbl_sport_events` (
  `sp_id` int(11) NOT NULL,
  `vendor_cat_id` int(11) NOT NULL,
  `venue_cat_id` int(11) NOT NULL,
  `sport_name` varchar(250) NOT NULL,
  `sport_status` tinyint(4) NOT NULL DEFAULT '1',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sport_events`
--

INSERT INTO `tbl_sport_events` (`sp_id`, `vendor_cat_id`, `venue_cat_id`, `sport_name`, `sport_status`, `datecreated`) VALUES
(1, 1, 1, 'cardio', 1, '2015-12-18 07:22:56'),
(2, 2, 2, 'boxing', 1, '2015-12-18 07:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategories`
--

CREATE TABLE `tbl_subcategories` (
  `subcat_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  `subcat_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subcategories`
--

INSERT INTO `tbl_subcategories` (`subcat_id`, `category_id`, `subcat_name`, `subcat_status`, `datecreated`) VALUES
(1, 1, 'aerobics', 1, '2016-01-11 06:42:53'),
(2, 1, 'cardio', 1, '2016-01-11 06:43:08'),
(3, 2, 'hockey', 1, '2016-01-11 06:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `dtype` tinyint(4) NOT NULL COMMENT '1=ios,2=android',
  `profile_pic` varchar(250) NOT NULL,
  `activation_key` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0=inactive,1=active,2=waitapprove',
  `regddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateactive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_id`, `name`, `email`, `password`, `gender`, `phone`, `dtype`, `profile_pic`, `activation_key`, `status`, `regddate`, `dateactive`) VALUES
(1, 'superadmin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'male', '9533672269', 1, '', 0, 1, '2016-01-11 09:27:55', '2016-01-11'),
(2, 'rameshvendor', 'rameshvendor@gmail.com', '6c6e1464695ec20feb0b2a633f9cf27b', 'male', '9533672269', 2, 'jobs-jpg.jpg', 0, 1, '2016-01-11 09:30:06', '0000-00-00'),
(3, 'rameshvendor2', 'test2@gmail.com', '6c6e1464695ec20feb0b2a633f9cf27b', 'male', '9898989898', 0, 'emp1.jpg', 0, 1, '2016-01-29 12:24:17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `usertype_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '0=superadmin,1=vendorowner,2=venuemanager,3=venuestaff,4=user',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_types`
--

INSERT INTO `tbl_user_types` (`usertype_id`, `user_id`, `user_type`, `status`) VALUES
(1, 1, 0, 1),
(2, 2, 1, 1),
(3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendordetails`
--

CREATE TABLE `tbl_vendordetails` (
  `v_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `address_one` text NOT NULL,
  `address_two` text NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `company_pincode` int(11) NOT NULL,
  `srvc_provider_name` varchar(250) NOT NULL,
  `pan` varchar(20) NOT NULL,
  `vat` varchar(250) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `tan` varchar(50) NOT NULL,
  `service_tax` varchar(50) NOT NULL,
  `benificiary_name` varchar(250) NOT NULL,
  `accont_number` bigint(20) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `ifsc_code` varchar(15) NOT NULL,
  `pan_image` varchar(250) NOT NULL,
  `cancelledchq_image` varchar(250) NOT NULL,
  `tan_image` varchar(250) NOT NULL,
  `vat_image` varchar(250) NOT NULL,
  `cst_image` varchar(250) NOT NULL,
  `srvc_tax_image` varchar(250) NOT NULL,
  `tandc_acpt` tinyint(4) NOT NULL COMMENT '1=yes,0=no',
  `web_existing` varchar(250) NOT NULL,
  `web_other` varchar(250) NOT NULL,
  `other_info_one` varchar(250) NOT NULL,
  `other_info_two` varchar(250) NOT NULL,
  `other_info_three` varchar(250) NOT NULL,
  `vendor_status` tinyint(4) NOT NULL DEFAULT '1',
  `dateregd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateactive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendordetails`
--

INSERT INTO `tbl_vendordetails` (`v_id`, `user_id`, `company_name`, `category_type`, `address_one`, `address_two`, `city`, `state`, `country`, `company_pincode`, `srvc_provider_name`, `pan`, `vat`, `cst`, `tan`, `service_tax`, `benificiary_name`, `accont_number`, `account_type`, `ifsc_code`, `pan_image`, `cancelledchq_image`, `tan_image`, `vat_image`, `cst_image`, `srvc_tax_image`, `tandc_acpt`, `web_existing`, `web_other`, `other_info_one`, `other_info_two`, `other_info_three`, `vendor_status`, `dateregd`, `dateactive`) VALUES
(1, 2, '24 by 7 fitness centre', 'gym', 'banjara hills', 'road no 3', 'hyd', 'telangana', 'india', 500018, '24 by 7 fitness centre', 'pan001', 'vat001', 'cst001', 'tan001', 'serv001', 'ramesh', 465476576876878, 'current', 'hyd001', 'pan1.jpg', 'cancelled-cheque.jpg', 'tan1.png', 'vat1.jpg', 'cst1.jpg', 'service_tax1.PNG', 1, 'http://www.sample.com', 'http://www.sampleone.com', 'otherinfo1', 'otherinfo2', 'otherinfo3', 1, '2016-01-11 09:30:06', '0000-00-00'),
(2, 3, '365 days', 'gym', 'jubilee hills', 'road no 72', 'hyderabad', 'andhra pradesh', 'india', 522647, '365 days fitness centre', 'pan002', 'vat002', 'cst002', 'tan002', 'serv002', 'suresh', 346879890980, 'current', 'hyd002', 'pan1.jpg', 'cancelled-cheque.jpg', 'tan1.png', 'vat1.jpg', 'cst1.jpg', 'service_tax1.PNG', 1, 'http://www.sample1.com', 'http://www.sampleone.com', 'otherinfo1', 'otherinfo2', 'otherinfo3', 1, '2016-01-29 12:24:18', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venuedetails`
--

CREATE TABLE `tbl_venuedetails` (
  `venue_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `venue_name` varchar(250) NOT NULL,
  `venue_disp_name` varchar(250) NOT NULL,
  `venue_cp` varchar(50) NOT NULL,
  `venue_phone` varchar(15) NOT NULL,
  `venue_email` varchar(250) NOT NULL,
  `address_one` text NOT NULL,
  `address_two` text NOT NULL,
  `venue_city` varchar(250) NOT NULL,
  `venue_state` varchar(250) NOT NULL,
  `venue_country` varchar(250) NOT NULL,
  `venue_pincode` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `venue_pic_one` varchar(250) NOT NULL,
  `venue_pic_two` varchar(250) NOT NULL,
  `venue_pic_three` varchar(250) NOT NULL,
  `venue_pic_four` varchar(250) NOT NULL,
  `venue_pic_five` varchar(250) NOT NULL,
  `likes` int(11) NOT NULL,
  `facilities` text NOT NULL,
  `venue_lat` double NOT NULL,
  `venue_long` double NOT NULL,
  `location` varchar(256) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateactive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_venuedetails`
--

INSERT INTO `tbl_venuedetails` (`venue_id`, `vendor_id`, `category_id`, `venue_name`, `venue_disp_name`, `venue_cp`, `venue_phone`, `venue_email`, `address_one`, `address_two`, `venue_city`, `venue_state`, `venue_country`, `venue_pincode`, `status`, `venue_pic_one`, `venue_pic_two`, `venue_pic_three`, `venue_pic_four`, `venue_pic_five`, `likes`, `facilities`, `venue_lat`, `venue_long`, `location`, `datecreated`, `dateactive`) VALUES
(1, 1, 1, 'banjara hills branch', '24 by 7 fitness centre banjara hills branch', 'ram', '9969568', 'ram@gmail.com', 'banjara hillls road no2', 'opp:trendset building lane', 'hyd', 'telangana', 'india', 500018, 1, '1453297588gym_main.jpg', '1453297588gym_image2.jpg', '1453297588gym_image3.jpg', '1453297588gym_image4.jpg', '1453297588gym_image5.jpg', 0, '', 0, 0, '', '2016-01-20 13:46:28', '0000-00-00'),
(2, 1, 0, '', '', '', '', '', '', '', '', '', '', 0, 1, '1453440749gym_main.jpg', '1453440749gym_image2.jpg', '1453440749gym_image3.jpg', '1453440749gym_image4.jpg', '1453440749gym_image5.jpg', 0, '1', 0, 0, '', '2016-01-22 05:32:29', '0000-00-00'),
(3, 1, 1, '', '', '', '', '', '', '', '', '', '', 0, 1, '1453440811gym_main.jpg', '1453440811gym_image4.jpg', '1453440811', '1453440811', '1453440811', 0, '1,3,4', 0, 0, '', '2016-01-22 05:33:31', '0000-00-00'),
(4, 1, 1, '', '', '', '', '', '', '', '', '', '', 0, 1, '0', '1453441523gym_image2.jpg', '1453441523gym_image3.jpg', '1453441523gym_image4.jpg', '1453441523gym_image5.jpg', 0, '1,2', 0, 0, '', '2016-01-22 05:45:23', '0000-00-00'),
(5, 1, 1, '', '', '', '', '', '', '', '', '', '', 0, 1, '1453453614gym_main.jpg', '1453453614', '1453453614', '1453453614', '1453453614', 0, '1,2,3,4', 0, 0, '', '2016-01-22 09:06:54', '0000-00-00'),
(6, 1, 1, '', '', '', '', '', '', '', '', '', '', 0, 1, '1453453679gym_main.jpg', '0', '0', '0', '0', 0, '1,2,3,4', 0, 0, '', '2016-01-22 09:07:59', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venues`
--

CREATE TABLE `tbl_venues` (
  `ven_id` int(11) NOT NULL,
  `vendor_cat_id` int(11) NOT NULL,
  `venue_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_venues`
--

INSERT INTO `tbl_venues` (`ven_id`, `vendor_cat_id`, `venue_name`) VALUES
(1, 1, 'banjarahills'),
(2, 2, 'LB stadium');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workingdays`
--

CREATE TABLE `tbl_workingdays` (
  `wd_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `frm_dte` varchar(50) NOT NULL,
  `t_dte` varchar(50) NOT NULL,
  `wday_status` tinyint(4) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_workingdays`
--

INSERT INTO `tbl_workingdays` (`wd_id`, `venue_id`, `category_id`, `day_id`, `frm_dte`, `t_dte`, `wday_status`, `datecreated`) VALUES
(1, 1, 1, 1, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(2, 1, 1, 2, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(3, 1, 1, 3, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(4, 1, 1, 4, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(5, 1, 1, 5, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(6, 1, 1, 6, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(7, 1, 1, 7, '05:00 AM', '05:00 PM', 1, '2016-01-20 13:46:28'),
(8, 2, 0, 1, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(9, 2, 0, 2, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(10, 2, 0, 3, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(11, 2, 0, 4, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(12, 2, 0, 5, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(13, 2, 0, 6, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(14, 2, 0, 7, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:32:29'),
(15, 3, 1, 1, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(16, 3, 1, 2, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(17, 3, 1, 3, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(18, 3, 1, 4, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(19, 3, 1, 5, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(20, 3, 1, 6, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(21, 3, 1, 7, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:33:32'),
(22, 4, 1, 1, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(23, 4, 1, 2, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(24, 4, 1, 3, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(25, 4, 1, 4, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(26, 4, 1, 5, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(27, 4, 1, 6, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(28, 4, 1, 7, '05:00 AM', '05:00 PM', 1, '2016-01-22 05:45:23'),
(29, 5, 1, 1, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(30, 5, 1, 2, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(31, 5, 1, 3, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(32, 5, 1, 4, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(33, 5, 1, 5, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(34, 5, 1, 6, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(35, 5, 1, 7, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:06:54'),
(36, 6, 1, 1, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(37, 6, 1, 2, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(38, 6, 1, 3, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(39, 6, 1, 4, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(40, 6, 1, 5, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(41, 6, 1, 6, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59'),
(42, 6, 1, 7, '05:00 AM', '05:00 PM', 1, '2016-01-22 09:07:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `vendor_cat_id` (`vendor_id`),
  ADD KEY `venue_cat_id` (`venue_id`),
  ADD KEY `sport_id` (`category_id`),
  ADD KEY `slot_id` (`slot_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `tansaction_id` (`tansaction_id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`rt_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `tbl_reviewdetails`
--
ALTER TABLE `tbl_reviewdetails`
  ADD PRIMARY KEY (`resp_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`rev_id`),
  ADD KEY `venue_id` (`venue_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_slots`
--
ALTER TABLE `tbl_slots`
  ADD PRIMARY KEY (`slt_id`),
  ADD KEY `vendor_cat_id` (`venue_id`),
  ADD KEY `venue_cat_id` (`category_id`),
  ADD KEY `sport_id` (`subcategory_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `tbl_sport_events`
--
ALTER TABLE `tbl_sport_events`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `vendor_cat_id` (`vendor_cat_id`),
  ADD KEY `venue_cat_id` (`venue_cat_id`);

--
-- Indexes for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`usertype_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_vendordetails`
--
ALTER TABLE `tbl_vendordetails`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_venuedetails`
--
ALTER TABLE `tbl_venuedetails`
  ADD PRIMARY KEY (`venue_id`),
  ADD KEY `vendor_id` (`category_id`);

--
-- Indexes for table `tbl_venues`
--
ALTER TABLE `tbl_venues`
  ADD PRIMARY KEY (`ven_id`),
  ADD KEY `vendor_cat_id` (`vendor_cat_id`);

--
-- Indexes for table `tbl_workingdays`
--
ALTER TABLE `tbl_workingdays`
  ADD PRIMARY KEY (`wd_id`),
  ADD KEY `cat_id` (`category_id`),
  ADD KEY `day` (`day_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_reviewdetails`
--
ALTER TABLE `tbl_reviewdetails`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slots`
--
ALTER TABLE `tbl_slots`
  MODIFY `slt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_sport_events`
--
ALTER TABLE `tbl_sport_events`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `usertype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_vendordetails`
--
ALTER TABLE `tbl_vendordetails`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_venuedetails`
--
ALTER TABLE `tbl_venuedetails`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_venues`
--
ALTER TABLE `tbl_venues`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_workingdays`
--
ALTER TABLE `tbl_workingdays`
  MODIFY `wd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
