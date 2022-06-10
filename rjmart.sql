-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2022 at 09:17 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u269128924_rjmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cancel_time` int(11) DEFAULT NULL COMMENT 'in min',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `avatar`, `number`, `password`, `cancel_time`, `created`, `updated`) VALUES
(1, 'RJ Mart', 'rjmart', 'admin@gmail.com', '4818753723avatar2.png', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', 35, '2020-06-11 07:00:00', '2022-05-26 15:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `product_type_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `p_id`, `qty`, `product_type_id`, `created`, `updated`) VALUES
(25, 4, 32, 2, 60, '2022-06-04 05:25:53', '2022-06-04 05:28:24'),
(26, 4, 15, 1, 112, '2022-06-04 05:34:35', NULL),
(27, 4, 46, 3, 119, '2022-06-04 05:34:57', NULL),
(36, 9, 2, 2, 109, '2022-06-09 05:15:23', NULL),
(37, 9, 24, 7, 34, '2022-06-09 05:15:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `image`, `name`, `is_active`, `created`, `updated`) VALUES
(1, 'vegetables.jpg', 'Vegetables (શાકભાજી)', 1, '2020-06-05 13:16:16', '2020-06-16 22:23:09'),
(2, 'fruits.jpg', 'Fruits', 1, '2020-06-05 12:15:15', '2022-05-25 14:02:29'),
(3, '976030Ayurvedic-herb-herb-turmeric-indian-spices-1296x728-header-1296x728.jpg', 'Herbs and Seasonings(ઔષધો અને સીઝનિંગ્સ)', 1, '2020-08-02 19:51:48', NULL),
(4, '2505600-38.png', 'Exotic Fruits & Vegetables', 0, '2020-08-02 19:54:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `near_by_request`
--

CREATE TABLE `near_by_request` (
  `id` int(11) NOT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-pending, 1-accept, 2-reject',
  `order_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `near_by_request`
--

INSERT INTO `near_by_request` (`id`, `from_id`, `to_id`, `status`, `order_id`, `created`, `updated`) VALUES
(5, 9, 2, 1, 13, '2022-06-09 05:29:43', '2022-06-09 05:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'which type of notification',
  `receiver_type` int(11) NOT NULL DEFAULT 0 COMMENT '0-user, 1-admin',
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0-unread, 1-read',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `sender_id`, `receiver_id`, `order_id`, `title`, `message`, `type`, `receiver_type`, `is_read`, `created`) VALUES
(1, 1, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-05-10 16:23:09'),
(2, 1, NULL, 1, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 16:43:25'),
(3, 1, NULL, 1, 'Cancel Order', 'Order cancelled successfully', 'order_cancelled', 1, 0, '2022-05-10 16:44:32'),
(4, 1, NULL, 2, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 16:46:25'),
(5, 2, NULL, NULL, 'Delivery boy register', 'New delivery boy register successfully', 'new_register', 1, 0, '2022-05-10 16:48:56'),
(6, 1, NULL, 3, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 16:54:38'),
(7, 1, NULL, 2, 'Cancel Order', 'Order cancelled successfully', 'order_cancelled', 1, 0, '2022-05-10 16:57:23'),
(8, 1, NULL, 3, 'Cancel Order', 'Order cancelled successfully', 'order_cancelled', 1, 0, '2022-05-10 16:57:27'),
(9, 1, NULL, 4, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 17:00:36'),
(10, 1, NULL, 5, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 17:02:52'),
(11, 1, NULL, 1, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-10 17:07:32'),
(12, 2, NULL, 1, 'Order completed', 'Order completed successfully', 'order_shipped', 1, 0, '2022-05-10 17:14:14'),
(13, 1, NULL, 2, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-11 15:39:39'),
(14, 3, NULL, NULL, 'Delivery boy register', 'New delivery boy register successfully', 'new_register', 1, 0, '2022-05-11 15:43:27'),
(15, 3, NULL, 2, 'Order completed', 'Order completed successfully', 'order_shipped', 1, 0, '2022-05-11 15:49:56'),
(16, 3, NULL, 2, 'Order completed', 'Order completed successfully', 'order_shipped', 1, 0, '2022-05-11 15:53:02'),
(17, 1, NULL, 3, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-11 15:55:47'),
(18, 4, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-05-23 16:24:41'),
(19, 5, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-05-23 17:14:48'),
(20, NULL, 1, 3, 'Order Cancelled', 'Order cancelled successfully', 'cancel_order', 0, 0, '2022-05-25 14:03:17'),
(21, 4, NULL, 5, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-25 16:43:06'),
(22, NULL, 4, 5, 'Order Cancelled', 'Order cancelled successfully', 'cancel_order', 0, 0, '2022-05-25 16:43:37'),
(23, 4, NULL, 6, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-25 16:44:19'),
(24, 4, NULL, 6, 'Cancel Order', 'Order cancelled successfully', 'order_cancelled', 1, 0, '2022-05-25 16:44:41'),
(25, 4, NULL, 7, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-25 16:45:09'),
(26, 1, NULL, 8, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-30 05:47:31'),
(27, 5, NULL, 9, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-30 05:48:32'),
(28, NULL, 5, 9, 'Request Accepted', 'Your order request accepted successfully', 'order_accepted', 0, 0, '2022-06-04 05:48:19'),
(29, NULL, 3, 9, 'Order assign', 'Order assign by admin', 'order_assigned', 0, 0, '2022-06-04 05:48:19'),
(30, NULL, 5, 9, 'Order Shipped', 'Order shipped successfully', 'order_shipped', 0, 0, '2022-06-04 05:49:51'),
(31, 6, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-05 05:11:03'),
(32, 7, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-05 05:11:30'),
(33, 5, NULL, 10, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-06-06 04:14:11'),
(34, NULL, 5, 10, 'New Order', 'New order created successfully', 'new_order', 0, 0, '2022-06-06 04:14:11'),
(35, 5, NULL, 11, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-06-06 04:19:04'),
(36, NULL, 5, 11, 'New Order', 'New order created successfully', 'new_order', 0, 0, '2022-06-06 04:19:04'),
(37, 5, NULL, 12, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-06-07 08:36:35'),
(38, NULL, 5, 12, 'New Order', 'New order created successfully', 'new_order', 0, 0, '2022-06-07 08:36:35'),
(39, 8, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-08 09:27:43'),
(40, 9, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-08 09:50:59'),
(41, 9, NULL, 13, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-06-08 10:15:34'),
(42, NULL, 9, 13, 'New Order', 'New order created successfully', 'new_order', 0, 0, '2022-06-08 10:15:34'),
(43, 10, NULL, NULL, 'Delivery boy register', 'New delivery boy register successfully', 'new_register', 1, 0, '2022-06-08 13:35:00'),
(44, 11, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-08 13:35:18'),
(45, 12, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-06-08 14:01:28'),
(46, NULL, 9, 13, 'Request Accepted', 'Your order request accepted successfully', 'order_accepted', 0, 0, '2022-06-09 05:29:43'),
(47, NULL, 2, 13, 'Order assign', 'Order assign by admin', 'order_assigned', 0, 0, '2022-06-09 05:29:43'),
(48, NULL, 9, 13, 'Order Shipped', 'Order shipped successfully', 'order_shipped', 0, 0, '2022-06-09 05:30:00'),
(49, NULL, 9, 13, 'Order Shipped', 'Order shipped successfully', 'order_shipped', 0, 0, '2022-06-09 14:50:13'),
(50, NULL, 2, 13, 'Order Shipped', 'Order shipped successfully', 'order_shipped', 0, 0, '2022-06-09 14:50:13'),
(51, 2, NULL, 13, 'Order Shipped', 'Order shipped successfully', 'order_shipped', 1, 0, '2022-06-09 14:50:13'),
(52, 12, NULL, 14, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-06-10 08:52:19'),
(53, NULL, 12, 14, 'New Order', 'New order created successfully', 'new_order', 0, 0, '2022-06-10 08:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `product_type_id`, `qty`, `created`) VALUES
(1, 1, 2, 109, 1, '2022-05-10 17:07:32'),
(2, 2, 2, 109, 1, '2022-05-11 15:39:39'),
(3, 3, 2, 109, 1, '2022-05-11 15:55:47'),
(4, 5, 2, 109, 1, '2022-05-25 16:43:06'),
(5, 6, 2, 109, 1, '2022-05-25 16:44:19'),
(6, 7, 2, 109, 1, '2022-05-25 16:45:09'),
(7, 8, 2, 109, 2, '2022-05-30 05:47:31'),
(8, 9, 31, 57, 2, '2022-05-30 05:48:32'),
(9, 10, 1, 1, 3, '2022-06-06 04:14:11'),
(10, 11, 32, 60, 1, '2022-06-06 04:19:04'),
(11, 12, 29, 51, 1, '2022-06-07 08:36:35'),
(12, 13, 1, 1, 4, '2022-06-08 10:15:34'),
(13, 13, 13, 125, 4, '2022-06-08 10:15:34'),
(14, 14, 40, 84, 2, '2022-06-10 08:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-failed, 1-done, 2-cancel',
  `payment_identifier` varchar(255) DEFAULT NULL,
  `TXNDATE` varchar(50) DEFAULT NULL,
  `refId` varchar(255) DEFAULT NULL,
  `payment_type` int(11) DEFAULT 0 COMMENT '0-cash, 1-paytm',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `order_id`, `status`, `payment_identifier`, `TXNDATE`, `refId`, `payment_type`, `created`, `updated`) VALUES
(4, 1, 4, 1, '', '', NULL, 0, '2022-05-10 17:00:36', NULL),
(17, 9, 13, 1, '', '', NULL, 0, '2022-06-08 10:15:34', NULL),
(18, 12, 14, 1, '', '', NULL, 1, '2022-06-10 08:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `id` int(11) NOT NULL,
  `pincode` int(6) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Deactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`id`, `pincode`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 395006, 1, '2022-05-10 16:29:36', '2022-05-26 15:45:30'),
(2, 395009, 1, '2022-05-26 15:45:39', NULL),
(3, 360004, 1, '2022-06-04 05:52:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'privacy_policy_header', 'Privacy Policy', '2022-06-02 21:20:39', '2022-06-02 17:49:36'),
(2, 'privacy_policy_description', '<p>&bull; Deliveries would take place around the same time and date selected by the customersM<br />\n&bull; For same day Deliveries the closing time 1 hour after your place order.<br />\n&bull; The above-mentioned details would have some exceptions.<br />\n&bull; Gujarat Foods will strive hard to deliver the products ordered on time, however we do not guarantee delivery on time.<br />\n&bull; Gujarat Foods is not liable for any incorrect address provided<br />\n&bull; Gujarat Foods does not guarantee to deliver all produce mentioned on the website.<br />\n&bull; Gujarat Foods will not cancel the order placed on the same day of the delivery.<br />\n&bull; Order can be changed or cancelled 30 min before the delivery time.<br />\n&bull; All decision on delivery charge, product availability, order cancellation is reserved with Gujarat Foods.</p>\n\n<p>This privacy policy has been compiled to better serve those who are concerned with how their &#39;Personally identifiable information&#39; (PII) is being used on Gujarat Foods. PII, as used in accordance with the Indian privacy act, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context.</p>\n\n<p>Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.</p>\n\n<p><strong>1. What personal information do we collect from the people that visit our website or app?</strong><br />\nWhen ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address, phone number or other details to help you with your experience.</p>\n\n<p><strong>2. When do we collect information?</strong><br />\nWe collect information from you when you register on our site, place an order or enter information on our site.</p>\n\n<p><strong>3. How do we use your information?</strong><br />\nWe may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:<br />\n<br />\n&bull; To personalize user&#39;s experience and to allow us to deliver the type of content and product offerings in which you are most interested.<br />\n&bull; To improve our website in order to better serve you.<br />\n&bull; To allow us to better service you in responding to your customer service requests.<br />\n&bull; To administer a contest, promotion, survey or other site feature.<br />\n&bull; To quickly process your transactions.<br />\n&bull; To ask for ratings and reviews of services or products</p>\n\n<p><strong>4. Do we collect and store your credit card information?</strong><br />\nNo. All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>\n\n<p><strong>5. How do we protect visitor information?</strong><br />\nOur website is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible.<br />\n<br />\nWe do not use Malware Scanning.<br />\n<br />\nYour personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.<br />\n<br />\nWe implement a variety of security measures when a user places an order enters, submits, or accesses their information to maintain the safety of your personal information. All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>\n\n<p><strong>a. Do we use &#39;cookies&#39;?</strong><br />\nYes. Cookies are small files that a site or its service provider transfers to your computer&#39;s hard drive through your Web browser (if you allow) that enables the site&#39;s or service provider&#39;s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future. We use cookies to:<br />\n<br />\n&bull; Help remember and process the items in the shopping cart.<br />\n&bull; Understand and save user&#39;s preferences for future visits.<br />\n&bull; Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third-party services that track this information on our behalf.<br />\n<br />\nYou can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser (like Internet Explorer) settings. Each browser is a little different, so look at your browser&#39;s Help menu to learn the correct way to modify your cookies.<br />\n<br />\nIf you disable cookies, some features will be disabled It won&#39;t affect the user&#39;s experience that make your site experience more efficient and some of our services will not function properly.<br />\n<br />\nHowever, you can still place orders.<br />\n<br />\n<strong>b. Third-party disclosure</strong><br />\nWe do not sell, trade, or otherwise transfer to outside parties your personally identifiable information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it&#39;s release is appropriate to comply with the law, enforce our site policies, or protect ours or others&#39; rights, property, or safety. However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.<br />\n<br />\nThird-party links Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Corrections</strong><br />\nIf you would like to update or correct information previously provided to us, please send an e-mail with your new information, including your complete name, postal address, and email address to&nbsp;<a href=\"mailto:Care@gujratfoods.in\">Care@gujratfoods.in</a>. and Phone Number to&nbsp;<a href=\"tel:+919876543210\">+919876543210</a>&nbsp;Registered users can modify and update their membership information (including name, mailing address, telephone number and email address) by accessing the password protected &quot;Edit Profile&quot; page.<br />\n<br />\nYour Consent and Changes to this Policy Subject to the above provisions, by using our Web Site, you consent to the terms of this Privacy Policy and the Terms of Use, of which this policy is a part. We may change our Privacy Policy from time to time as new features are added, suggestions from our customers are incorporated or other changes are made. We will post the revised Privacy Policy on our Web Site at least 30 days prior to their effective date - unless we believe changes must take effect sooner to comply with law or to protect the Company or our customers, users, members, recipients, sponsors, providers, licensors, merchants, associates and affiliates, in which case the changes will be effective upon posting or as otherwise specified.</p>\n', '2022-06-02 21:20:39', '2022-06-03 18:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL COMMENT 'in %',
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0 - no, 1 - yes',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cat_id`, `name`, `description`, `offer`, `is_active`, `created`, `updated`) VALUES
(1, 1, 'Cabbage (કોબી)', '<p>Green cabbage</p>\r\n', NULL, 1, '2020-06-06 12:13:16', '2020-08-31 05:45:16'),
(2, 1, 'potato (બટેકા)', '<p>Quality Available: A Grade, Packaging Type Available: Net Bag, Cultivation Type: Common, We are the leading entity of a wide range of Fresh Potato.</p>\r\n', NULL, 1, '2020-06-06 10:07:07', '2020-08-31 09:09:02'),
(3, 2, 'Watermelon (તરબૂચ)', '<p>The&nbsp;watermelon&nbsp;is a large&nbsp;fruit&nbsp;of a more or less spherical shape. ... It has an oval or spherical shape and a dark green and smooth rind, sometimes showing irregular areas of a pale green colour. It has a sweet, juicy, refreshing flesh of yellowish or reddish colour, containing multiple black, brown or white pips.</p>\r\n', NULL, 0, '2020-06-06 12:13:13', '2020-08-29 04:29:05'),
(4, 2, 'Orange (નારંગી)', '<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, <em>graphic or web designs.</em> The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>\r\n', NULL, 1, '2020-06-06 13:15:12', '2020-08-30 06:01:06'),
(10, 2, 'Banana (કેળા)', '<p>Banana,&nbsp;<a href=\"https://www.britannica.com/science/fruit-plant-reproductive-body\">fruit</a>&nbsp;of the&nbsp;<a href=\"https://www.britannica.com/science/genus-taxon\">genus</a>&nbsp;<em>Musa</em>, of the family&nbsp;<a href=\"https://www.britannica.com/plant/Musaceae\">Musaceae</a>, one of the most important fruit crops of the world. The banana is grown in the tropics, and, though it is most widely consumed in those regions, it is valued worldwide for its flavour, nutritional value, and availability throughout the year.&nbsp;<a href=\"https://www.britannica.com/plant/Cavendish-banana\">Cavendish</a>, or dessert, bananas are most commonly eaten fresh, though they may be fried or mashed and chilled in pies or puddings.</p>\r\n', NULL, 1, '2020-07-05 19:27:58', '2020-08-30 06:00:39'),
(11, 2, 'Black Currant (કાળો જાંબુ)', '<p>Overview&nbsp;-&nbsp;Black currant.&nbsp;Blackcurrant&nbsp;is a berry of translucent pulp with&nbsp;red&nbsp;or green tones and bittersweet taste. The fruit is small, of&nbsp;black-blue colour and spherical shape, with an intense taste when completely ripe. This berry is covered with hair and its pulp contains multiple small seeds.</p>\r\n', NULL, 0, '2020-07-05 19:28:57', '2020-08-25 06:00:13'),
(13, 1, 'Brinjal (રીંગણા)', '<p>Brinjal&nbsp;is an erect annual plant, often spiny, with large, coarsely lobed fuzzy leaves, 10-20 cm long and 5-10 cm broad. The plants usually grow 45 to 60 cm high and bears long to oval shaped, purple or greenish fruits. Flowers are white to purple, with five-lobed corolla and yellow stamens.</p>\r\n', NULL, 1, '2020-07-05 19:30:53', '2020-08-31 05:46:19'),
(15, 2, 'Grapes (દ્રાક્ષ)', '<p>A&nbsp;grape&nbsp;is a fruit, botanically a berry, of the deciduous woody vines of the flowering plant genus Vitis.&nbsp;Grapes&nbsp;can be eaten fresh as table&nbsp;grapes&nbsp;or they can be used for making wine, jam,&nbsp;grape&nbsp;juice, jelly,&nbsp;grape&nbsp;seed extract, raisins, vinegar, and&nbsp;grape&nbsp;seed oil.</p>\r\n', NULL, 0, '2020-07-05 19:32:36', '2020-08-29 04:35:30'),
(22, 1, 'Sponge gourd (ગાલ્કા)', '<p>The&nbsp;Sponge gourd&nbsp;is a cylindrical fruit that grows on a climbing, herbaceous vine. ... The interior flesh of the&nbsp;Sponge gourd&nbsp;is smooth and creamy-white.&nbsp;Sponge gourd&nbsp;has a mild, zucchini-like sweet taste and a silky texture. Mature fruits are not tasty, being fibrous, bitter and brown.</p>\r\n', NULL, 1, '2020-08-14 20:19:20', '2020-08-31 05:46:36'),
(24, 1, 'LEMON(લીંબુ)', '<p>The&nbsp;lemon&nbsp;is a round, slightly elongated fruit, it has a strong and resistant skin, with an intense bright yellow colour when it is totaly ripe, giving off a special aroma when it is cut. The pulp is pale yellow, juicy and acid, divided in gores.</p>\r\n', NULL, 1, '2020-08-21 11:32:13', '2020-08-31 05:46:54'),
(25, 1, 'OKRA(ભીંડા)', '<p>Okra, Abelmoschus esculentus, is an herbaceous annual plant in the family Malvaceae which is grown for its edible seed pods.&nbsp;Okra&nbsp;plants have small erect stems that can be bristly or hairless with heart-shaped leaves.</p>\r\n', NULL, 1, '2020-08-21 11:42:20', '2020-08-31 05:47:26'),
(26, 1, 'GUAR (ગુવાર)', '<p>The&nbsp;guar&nbsp;or cluster bean, with the botanical name Cyamopsis tetragonoloba, is an annual legume and the source of&nbsp;guar&nbsp;gum. It is also known as gavar,&nbsp;gawar, or&nbsp;guvar&nbsp;bean. ... This legume is a valuable plant in a crop rotation cycle, as it lives in symbiosis with nitrogen-fixing bacteria</p>\r\n', NULL, 1, '2020-08-21 11:59:17', '2020-08-31 05:47:51'),
(27, 1, 'Luffa acutangula (તુરીયા)', '<p>It is a dark green, ridged and tapering pretty vegetable. It has white pulp with white seeds embedded in spongy flesh. A&nbsp;ridge gourd&nbsp;also commonly known as Turai or Turiya is a well beloved in India. Its hard skin is peeled off and chopped and cooked as desired.</p>\r\n', NULL, 1, '2020-08-21 12:07:53', '2020-08-31 05:48:54'),
(28, 1, 'Lobia Beans (ચોલી)', '<p>Punjabi&nbsp;Lobia&nbsp;is a North Indian Style Black Eyed&nbsp;Beans&nbsp;curry where&nbsp;lobia&nbsp;is cooked in a spicy onion tomato gravy. It can be paired best with paratha, phulka, and rice.</p>\r\n', NULL, 1, '2020-08-21 12:33:53', '2020-08-31 05:49:29'),
(29, 1, 'carrot (ગાજર)', '<p>The&nbsp;carrot&nbsp;(Daucus carota subsp. sativus) is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist. ... The&nbsp;carrot&nbsp;is a biennial plant in the umbellifer family, Apiaceae. At first, it grows a rosette of leaves while building up the enlarged taproot.</p>\r\n', NULL, 1, '2020-08-21 12:51:46', '2020-08-31 05:49:45'),
(30, 1, 'cucumber (કાકડી)', '<p>Cucumber, Cucumis sativus, is a warm season, vining, annual plant in the family Cucurbitaceae grown for its edible&nbsp;cucumber&nbsp;fruit. The&nbsp;cucumber&nbsp;plant is a sprawling vine with large leaves and curling tendrils. ... The leaves of the plant are arranged alternately on the vines, have 3&ndash;7 pointed lobes and are hairy.</p>\r\n', NULL, 1, '2020-08-21 12:55:56', '2020-08-31 05:50:09'),
(31, 1, 'Tomato (ટોમેટો)', '<p>Tomato, Lycopersicum esculentum (syn. Solanum lycopersicum and Lycopersicon lycopersicum) is an herbaceous annual in the family Solanaceae grown for its edible fruit. The plant can be erect with short stems or vine-like with long, spreading stems.</p>\r\n', NULL, 1, '2020-08-21 13:00:24', '2020-08-31 05:30:56'),
(32, 3, 'coriander (ધાના)', '<p>Coriander&nbsp;is native to regions spanning from Southern Europe and Northern Africa to Southwestern Asia. It is a soft plant growing to 50 cm (20 in) tall. The leaves are variable in shape, broadly lobed at the base of the plant, and slender and feathery higher on the flowering stems.</p>\r\n', NULL, 1, '2020-08-21 13:31:14', '2020-08-31 06:38:45'),
(33, 3, 'Ginger (આદુ)', '<p>Ginger&nbsp;(Zingiber officinale) is a flowering plant whose rhizome,&nbsp;ginger&nbsp;root or&nbsp;ginger, is widely used as a spice and a folk medicine. It is a herbaceous perennial which grows annual pseudostems (false stems made of the rolled bases of leaves) about one meter tall bearing narrow leaf blades.</p>\r\n', NULL, 1, '2020-08-21 13:34:49', '2020-08-31 06:38:29'),
(34, 1, 'Green Chili (મરચાં)', '<p>Green Chillies&nbsp;A spice without which Indian cuisine would be incomplete, the most common variety of&nbsp;chilli&nbsp;used apart from red is the&nbsp;green. These are used with or without the stalks, whole or chopped, with seeds or deseeded. They are used fresh, dried, powdered, pickled or in sauces.</p>\r\n', NULL, 1, '2020-08-21 13:40:19', '2020-08-30 05:53:32'),
(35, 3, 'Methi leaves (મેથી)', '<p>Methi leaves&nbsp;can help in weight loss. Both&nbsp;fenugreek&nbsp;seeds and&nbsp;leaves&nbsp;can help in weight loss. These&nbsp;leaves&nbsp;are high in fiber and other essential nutrients. Fibre can keep you full for longer and make you eat less. These&nbsp;leaves&nbsp;will also provide you other essential nutrients as well.</p>\r\n', NULL, 1, '2020-08-21 13:46:33', '2020-08-31 06:38:03'),
(36, 1, 'Coccinia Grandis (ટિંડોરા)', '<p>grandis&nbsp;is a dioecious, perennial, herbaceous vine that can grow between 9 and 28 m long. It has glabrous stems, an extensive tuberous root system and axillary tendrils. The alternate, simple leaves have a broadly ovate, 5-lobed, 5-9 by 4-9 cm. The flowers are white, star-shaped with 5 peta</p>\r\n', NULL, 1, '2020-08-21 13:55:05', '2020-08-30 05:52:05'),
(37, 3, 'Spinach (પાલક)', '<p>Spinach is a leafy green flowering plant native to central and western Asia. It is of the order Caryophyllales, family Amaranthaceae, subfamily Chenopodioideae. Its leaves are a common edible vegetable consumed either fresh, or after storage using preservation techniques by canning, freezing, or dehydration.</p>\r\n', NULL, 1, '2020-08-21 14:06:38', '2020-08-31 06:37:50'),
(38, 1, 'Onion (ડુંગળી)', '<p>The onion, also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium. Its close relatives include the garlic, scallion, shallot, leek, chive, and Chinese onion.</p>\r\n', NULL, 1, '2020-08-21 14:12:52', '2020-08-30 05:50:41'),
(39, 3, 'Amaranthus Green (તાંજલીયા)', '<p>Amaranthus viridis is a cosmopolitan species in the botanical family Amaranthaceae and is commonly known as slender amaranth or green amaranth.</p>\r\n', NULL, 1, '2020-08-21 14:24:46', '2020-08-31 06:37:36'),
(40, 1, 'Flat Beans (પાપડી)', '<p>Flat beans, also known as helda beans, romano beans and &quot;sem fhali&quot; in some Indian states, are a variety of Phaseolus coccineus, known as runner bean with edible pods that have a characteristic wide and flat shape. Flat beans are normally cooked and served as the whole pods, the same way as other green beans.</p>\r\n', NULL, 1, '2020-08-21 14:35:11', '2020-08-30 05:49:39'),
(42, 1, 'Spiny gourd (કંટોલા)', '<p>Momordica dioica, commonly known as spiny gourd or spine gourd and also known as bristly balsam pear, prickly carolaho, teasle gourd, kantola, is a species of flowering plant in the Cucurbitaceae/gourd family. It is used as a vegetable in all regions of India and some parts in South Asia.</p>\r\n', NULL, 1, '2020-08-21 14:49:44', '2020-08-30 05:49:02'),
(43, 1, 'Calabash (દુધિ)', '<p>Calabash, also known as bottle gourd, white-flowered gourd, long melon, New Guinea bean and Tasmania bean is a vine grown for its fruit. It can be either harvested young to be consumed as a vegetable, or harvested mature to be dried and used as a utensil.</p>\r\n', NULL, 1, '2020-08-22 06:11:39', '2020-08-30 05:48:38'),
(44, 1, 'Bitter Melon (કારેલા)', '<p>Momordica charantia is a tropical and subtropical vine of the family Cucurbitaceae, widely grown in Asia, Africa, and the Caribbean for its edible fruit. Its many varieties differ substantially in the shape and bitterness of the fruit. Bitter melon originated in India and was introduced into China in the 14th century.&nbsp;</p>\r\n', NULL, 1, '2020-08-24 13:06:33', '2020-08-30 05:48:07'),
(45, 1, 'Green Peas (વટણા)', '<p>A&nbsp;pea&nbsp;is a most commonly&nbsp;green, occasionally golden yellow, or infrequently purple pod-shaped vegetable, widely grown as a cool season vegetable crop. The seeds may be planted as soon as the soil temperature reaches 10 &deg;C (50 &deg;F),&nbsp;with&nbsp;the plants growing best at temperatures&nbsp;of&nbsp;13 to 18 &deg;C (55 to 64 &deg;F).</p>\r\n', NULL, 0, '2020-08-24 13:13:49', '2020-08-29 05:01:48'),
(46, 2, 'Pomegranate (દાડમ)', '<p>The pomegranate is a fruit-bearing deciduous shrub in the family Lythraceae, subfamily Punicoideae, that grows between 5 and 10 m tall. The pomegranate originated in the region extending from Iran to northern India, and has been cultivated since ancient times throughout the Mediterranean region.</p>\r\n', NULL, 1, '2020-08-25 06:07:35', '2020-08-30 05:47:09'),
(47, 2, 'Guava (જામફળ)', '<p>Guava&nbsp;is a fast growing evergreen shrub or small tree that can grow to a height of 3-10 m. It has a shallow root system.&nbsp;Guava&nbsp;produces low drooping branches from the base and suckers from the roots. The trunk is slender, 20 cm in diameter, covered with a smooth green to red brown bark that peels off in thin flakes.</p>\r\n', NULL, 0, '2020-08-25 06:17:16', '2020-08-30 05:46:48'),
(48, 2, 'Apple (સફરજન)', '<p>An apple is an edible fruit produced by an apple tree. Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today.</p>\r\n', NULL, 1, '2020-08-29 05:06:36', '2020-08-30 05:45:51'),
(49, 1, 'Cauliflower (ફ્લાવર)', '<p>Cauliflower is one of several vegetables in the species Brassica oleracea in the genus Brassica, which is in the Brassicaceae family. It is an annual plant that reproduces by seed. Typically, only the head is eaten &ndash; the edible white flesh sometimes called &quot;curd&quot;.</p>\r\n', NULL, 0, '2020-08-29 05:45:51', NULL),
(50, 1, 'Daikon (મુલો)', '<p>Daikon, Raphanus sativus var. longipinnatus, also known by many other names depending on context, is a mild-flavored winter radish usually characterized by fast-growing leaves and a long, white, napiform root.</p>\r\n', NULL, 0, '2020-08-29 05:48:56', '2020-08-30 05:44:18'),
(51, 3, 'Garlic (લસન)', '<p>Garlic is a species in the onion genus, Allium. Its close relatives include the onion, shallot, leek, chive, and Chinese onion. It is native to Central Asia and northeastern Iran, and has long been a common seasoning worldwide, with a history of several thousand years of human consumption and use.&nbsp;</p>\r\n', NULL, 1, '2020-08-29 05:52:29', '2020-08-31 06:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `p_id`, `image`, `created`) VALUES
(1, 1, 'cabbage.jpeg', '2020-06-06 15:17:17'),
(2, 1, 'cabbage1.jpeg', '2020-06-06 11:11:10'),
(3, 1, 'cabbage3.jpeg', '2020-06-06 12:12:12'),
(10, 4, 'orange.jpeg', '2020-06-06 13:13:13'),
(11, 4, 'orange2.jpg', '2020-06-06 11:09:09'),
(12, 4, 'orange3.jpeg', '2020-06-06 12:12:12'),
(20, 10, '781227.jpg', '2020-07-05 19:27:58'),
(21, 11, '254910.jpg', '2020-07-05 19:28:57'),
(25, 15, '811654.jpg', '2020-07-05 19:32:36'),
(42, 24, '65105.jpeg', '2020-08-21 11:32:13'),
(43, 24, '671081.jpg', '2020-08-21 11:32:13'),
(44, 24, '450224.jpg', '2020-08-21 11:32:13'),
(45, 24, '763015.png', '2020-08-21 11:32:13'),
(46, 25, '888060.jpg', '2020-08-21 11:42:20'),
(47, 25, '272635.jpg', '2020-08-21 11:42:20'),
(48, 25, '933822.png', '2020-08-21 11:42:20'),
(52, 27, '417309.png', '2020-08-21 12:07:53'),
(53, 27, '507441.jpg', '2020-08-21 12:07:53'),
(55, 26, '836450.jpg', '2020-08-21 12:10:03'),
(56, 26, '48653.jpg', '2020-08-21 12:10:03'),
(58, 22, '320974.jpg', '2020-08-21 12:19:10'),
(59, 22, '965630.jpg', '2020-08-21 12:19:10'),
(62, 28, '303531.jpg', '2020-08-21 12:33:53'),
(63, 22, '395527.jpg', '2020-08-21 12:34:43'),
(65, 27, '142662.jpg', '2020-08-21 12:40:08'),
(67, 26, '161086.jpg', '2020-08-21 12:45:35'),
(68, 28, '628844.jpg', '2020-08-21 12:46:41'),
(69, 28, '776355.jpg', '2020-08-21 12:46:41'),
(70, 29, '254638.jpg', '2020-08-21 12:51:46'),
(71, 29, '237477.jpg', '2020-08-21 12:51:46'),
(72, 29, '228238.jpg', '2020-08-21 12:51:46'),
(74, 31, '735910.jpg', '2020-08-21 13:00:24'),
(75, 31, '30331.jpg', '2020-08-21 13:00:24'),
(76, 30, '180251.jpg', '2020-08-21 13:09:42'),
(77, 30, '879783.jpg', '2020-08-21 13:09:42'),
(78, 30, '877528.jpg', '2020-08-21 13:09:42'),
(79, 32, '522223.jpg', '2020-08-21 13:31:14'),
(80, 32, '898714.jpg', '2020-08-21 13:31:14'),
(81, 32, '781996.jpg', '2020-08-21 13:31:14'),
(82, 33, '57475.jpg', '2020-08-21 13:34:49'),
(83, 33, '487352.jpg', '2020-08-21 13:34:49'),
(84, 33, '20870.png', '2020-08-21 13:34:49'),
(85, 34, '524564.jpg', '2020-08-21 13:40:19'),
(86, 34, '968991.png', '2020-08-21 13:40:19'),
(87, 34, '486899.jpeg', '2020-08-21 13:40:19'),
(88, 35, '692299.jpeg', '2020-08-21 13:46:33'),
(89, 35, '986530.jpg', '2020-08-21 13:46:33'),
(90, 35, '139137.jpg', '2020-08-21 13:46:33'),
(91, 36, '184240.jpg', '2020-08-21 13:55:05'),
(92, 36, '713957.jpg', '2020-08-21 13:55:05'),
(93, 36, '249262.jpg', '2020-08-21 13:55:05'),
(94, 37, '339887.jpg', '2020-08-21 14:06:38'),
(95, 37, '574588.jpg', '2020-08-21 14:06:38'),
(96, 37, '838334.jpg', '2020-08-21 14:06:38'),
(97, 38, '302807.jpg', '2020-08-21 14:12:52'),
(98, 38, '159333.jpg', '2020-08-21 14:12:52'),
(99, 38, '451366.jpg', '2020-08-21 14:12:52'),
(101, 39, '993045.jpg', '2020-08-21 14:24:46'),
(103, 39, '639445.png', '2020-08-21 14:25:59'),
(104, 40, '873888.jpg', '2020-08-21 14:35:11'),
(105, 40, '516873.png', '2020-08-21 14:35:11'),
(106, 40, '186510.jpg', '2020-08-21 14:35:11'),
(110, 42, '907951.jpg', '2020-08-21 14:49:44'),
(111, 42, '227578.jpg', '2020-08-21 14:49:44'),
(112, 42, '122668.jpg', '2020-08-21 14:49:44'),
(116, 43, '136783.jpg', '2020-08-22 06:11:39'),
(117, 43, '30501.jpg', '2020-08-22 06:11:39'),
(118, 43, '443080.jpg', '2020-08-22 06:11:39'),
(119, 44, '873024.jpeg', '2020-08-24 13:06:33'),
(120, 44, '605382.jpeg', '2020-08-24 13:06:33'),
(121, 44, '14703.jpeg', '2020-08-24 13:06:33'),
(122, 45, '85732.jpeg', '2020-08-24 13:13:49'),
(123, 45, '926766.jpeg', '2020-08-24 13:13:49'),
(124, 45, '951661.jpeg', '2020-08-24 13:13:49'),
(132, 3, '442065.jpg', '2020-08-24 13:51:25'),
(133, 3, '269639.jpg', '2020-08-24 13:51:25'),
(134, 3, '885213.jpg', '2020-08-24 13:51:25'),
(138, 2, '84965.jpg', '2020-08-25 05:46:12'),
(139, 2, '574502.jpg', '2020-08-25 05:46:12'),
(140, 2, '916226.jpg', '2020-08-25 05:46:12'),
(141, 15, '164917.jpg', '2020-08-25 05:50:37'),
(142, 15, '31324.jpg', '2020-08-25 05:50:37'),
(143, 13, '632323.jpg', '2020-08-25 05:54:13'),
(144, 13, '852326.jpg', '2020-08-25 05:54:13'),
(145, 13, '658973.jpg', '2020-08-25 05:54:13'),
(146, 11, '655560.jpeg', '2020-08-25 06:00:13'),
(147, 11, '740626.jpg', '2020-08-25 06:00:13'),
(148, 10, '280343.jpg', '2020-08-25 06:02:24'),
(149, 10, '694954.jpg', '2020-08-25 06:02:24'),
(150, 46, '740087.jpg', '2020-08-25 06:07:35'),
(151, 46, '101405.jpg', '2020-08-25 06:07:35'),
(152, 46, '641155.jpeg', '2020-08-25 06:07:35'),
(153, 47, '884574.jpg', '2020-08-25 06:17:16'),
(154, 47, '981350.jpg', '2020-08-25 06:17:16'),
(155, 47, '634761.jpeg', '2020-08-25 06:17:16'),
(156, 39, '23819.jpg', '2020-08-29 04:43:48'),
(157, 48, '240530.jpg', '2020-08-29 05:06:36'),
(158, 48, '607743.jpeg', '2020-08-29 05:06:36'),
(159, 48, '242357.jpeg', '2020-08-29 05:06:36'),
(160, 49, '39995.jpg', '2020-08-29 05:45:51'),
(161, 49, '249804.jpg', '2020-08-29 05:45:51'),
(162, 49, '13450.jpg', '2020-08-29 05:45:51'),
(163, 50, '355745.png', '2020-08-29 05:48:56'),
(164, 50, '521211.jpg', '2020-08-29 05:48:56'),
(165, 50, '563898.jpg', '2020-08-29 05:48:56'),
(166, 51, '875441.jpg', '2020-08-29 05:52:29'),
(167, 51, '970971.png', '2020-08-29 05:52:29'),
(168, 51, '764973.jpg', '2020-08-29 05:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_address_id` int(11) NOT NULL,
  `total_amount` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `order_status` int(11) DEFAULT 0 COMMENT '0-pending, 1-confirmed, 2-completed, 3-cancel, 4-shipped',
  `cancel_status` int(11) NOT NULL DEFAULT 0,
  `order_date` datetime DEFAULT NULL,
  `is_review` int(11) NOT NULL DEFAULT 0,
  `referral_amount` int(11) NOT NULL DEFAULT 0,
  `receive_otp` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `is_cancel_by_admin` int(11) NOT NULL DEFAULT 0 COMMENT '0: User, 1: Admin',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `order_number`, `user_id`, `user_address_id`, `total_amount`, `payment_type`, `order_status`, `cancel_status`, `order_date`, `is_review`, `referral_amount`, `receive_otp`, `reason`, `is_cancel_by_admin`, `created`, `updated`) VALUES
(13, 'ORDER2022060810153545', 9, 23, '544', 'cash', 2, 0, '2022-06-09 10:15:34', 0, 0, 523501, NULL, 0, '2022-06-08 10:15:34', NULL),
(14, 'ORDER2022061008521922', 12, 29, '144', 'online', 0, 0, '2022-06-11 08:52:19', 0, 0, NULL, NULL, 0, '2022-06-10 08:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `Product_qty` int(11) NOT NULL,
  `product_type_price` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_id`, `product_type`, `Product_qty`, `product_type_price`, `created`, `updated`) VALUES
(1, 1, 'KG', 1, '66', '2020-06-06 04:11:11', '2020-08-31 05:45:16'),
(3, 2, 'KG', 1, '48', '2020-06-06 05:12:12', '2020-08-31 09:09:02'),
(102, 3, 'KG', 5, '95', '2020-08-24 13:51:25', '2020-08-29 04:29:05'),
(7, 4, 'KG', 1, '200', '2020-06-06 04:11:11', '2020-08-30 06:01:06'),
(8, 4, 'GM', 500, '110', '2020-06-06 04:11:11', '2020-08-30 06:01:06'),
(9, 8, 'kg', 20, '1000', '2020-07-03 17:08:33', '2020-07-03 17:10:54'),
(10, 8, 'kg', 10, '500', '2020-07-03 17:08:33', '2020-07-03 17:10:54'),
(12, 9, 'kg', 1, '30', '2020-07-05 12:25:38', '2020-08-14 13:27:42'),
(13, 10, 'PCS', 12, '50', '2020-07-05 12:27:58', '2020-08-30 06:00:39'),
(14, 11, 'GM', 500, '60', '2020-07-05 12:28:57', '2020-08-25 06:00:13'),
(15, 12, 'gm', 500, '100', '2020-07-05 12:29:46', '2020-07-05 12:33:34'),
(114, 11, 'KG', 1, '120', '2020-08-25 06:00:13', '2020-08-25 06:00:13'),
(17, 14, 'pcs', 2, '40', '2020-07-05 12:31:37', '2020-07-05 12:31:37'),
(18, 15, 'KG', 1, '100', '2020-07-05 12:32:36', '2020-08-29 04:35:30'),
(31, 23, 'G.M', 500, '20', '2020-08-21 11:32:11', '2020-08-21 11:32:11'),
(20, 16, 'gm', 200, '15', '2020-07-05 12:34:34', '2020-07-05 12:34:34'),
(21, 17, 'kg', 1, '120', '2020-07-05 12:35:38', '2020-07-05 12:35:38'),
(22, 18, 'GM', 500, '50', '2020-07-05 12:36:25', '2020-08-25 05:42:20'),
(23, 19, 'pcs', 3, '15', '2020-07-05 12:37:07', '2020-07-05 12:37:07'),
(24, 20, 'ltr', 1, '100', '2020-07-20 16:40:37', '2020-07-20 16:40:37'),
(25, 20, 'Kg', 1, '200', '2020-08-01 13:49:53', '2020-08-01 13:49:53'),
(26, 20, 'Gm', 500, '100', '2020-08-01 13:49:53', '2020-08-01 13:49:53'),
(27, 20, 'Kg', 2, '300', '2020-08-01 13:49:53', '2020-08-01 13:49:53'),
(28, 20, 'GM', 1, '100', '2020-08-14 13:19:19', '2020-08-14 13:19:19'),
(29, 21, 'GM', 1, '100', '2020-08-14 13:19:19', '2020-08-14 13:19:19'),
(30, 22, 'KG', 1, '60', '2020-08-14 13:19:20', '2020-08-31 05:46:36'),
(32, 23, 'K.G', 1, '40', '2020-08-21 11:32:11', '2020-08-21 11:32:11'),
(33, 23, 'K.G', 2, '70', '2020-08-21 11:32:11', '2020-08-21 11:32:11'),
(34, 24, 'KG', 1, '50', '2020-08-21 11:32:13', '2020-08-31 05:46:54'),
(35, 24, 'GM', 500, '25', '2020-08-21 11:32:13', '2020-08-31 05:46:54'),
(37, 25, 'KG', 1, '70', '2020-08-21 11:42:20', '2020-08-31 05:47:26'),
(38, 25, 'GM', 500, '35', '2020-08-21 11:42:20', '2020-08-31 05:47:26'),
(40, 26, 'KG', 1, '70', '2020-08-21 11:59:17', '2020-08-31 05:47:51'),
(41, 26, 'GM', 500, '35', '2020-08-21 11:59:17', '2020-08-31 05:47:51'),
(43, 27, 'KG', 1, '70', '2020-08-21 12:07:53', '2020-08-31 05:48:54'),
(44, 27, 'GM', 500, '35', '2020-08-21 12:07:53', '2020-08-31 05:48:54'),
(46, 22, 'GM', 500, '33', '2020-08-21 12:19:10', '2020-08-31 05:46:36'),
(48, 28, 'KG', 1, '130', '2020-08-21 12:33:53', '2020-08-31 05:49:29'),
(49, 28, 'GM', 500, '75', '2020-08-21 12:33:53', '2020-08-31 05:49:29'),
(51, 29, 'KG', 1, '70', '2020-08-21 12:51:46', '2020-08-31 05:49:45'),
(52, 29, 'GM', 500, '35', '2020-08-21 12:51:46', '2020-08-31 05:49:45'),
(54, 30, 'KG', 1, '75', '2020-08-21 12:55:56', '2020-08-31 05:50:09'),
(55, 30, 'GM', 500, '40', '2020-08-21 12:55:56', '2020-08-31 05:50:09'),
(57, 31, 'KG', 1, '70', '2020-08-21 13:00:24', '2020-08-31 05:30:56'),
(58, 31, 'GM', 500, '35', '2020-08-21 13:00:24', '2020-08-31 05:30:56'),
(60, 32, 'KG', 1, '300', '2020-08-21 13:31:14', '2020-08-31 06:38:45'),
(61, 32, 'GM', 500, '160', '2020-08-21 13:31:14', '2020-08-31 06:38:45'),
(63, 33, 'KG', 1, '220', '2020-08-21 13:34:49', '2020-08-31 06:38:29'),
(64, 33, 'GM', 500, '125', '2020-08-21 13:34:49', '2020-08-31 06:38:29'),
(133, 51, 'KG', 1, '260', '2020-08-29 05:52:29', '2020-08-31 06:37:14'),
(66, 34, 'KG', 1, '80', '2020-08-21 13:40:19', '2020-08-30 05:53:32'),
(67, 34, 'GM', 500, '43', '2020-08-21 13:40:19', '2020-08-30 05:53:32'),
(132, 51, 'GM', 500, '135', '2020-08-29 05:52:29', '2020-08-31 06:37:14'),
(69, 35, 'KG', 1, '220', '2020-08-21 13:46:33', '2020-08-31 06:38:03'),
(70, 35, 'GM', 500, '125', '2020-08-21 13:46:33', '2020-08-31 06:38:03'),
(72, 36, 'KG', 1, '90', '2020-08-21 13:55:05', '2020-08-30 05:52:05'),
(73, 36, 'GM', 500, '47', '2020-08-21 13:55:05', '2020-08-30 05:52:05'),
(131, 50, 'GM', 500, '30', '2020-08-29 05:48:56', '2020-08-30 05:44:18'),
(75, 37, 'KG', 1, '200', '2020-08-21 14:06:38', '2020-08-31 06:37:50'),
(76, 37, 'GM', 500, '110', '2020-08-21 14:06:38', '2020-08-31 06:37:50'),
(78, 38, 'KG', 1, '30', '2020-08-21 14:12:52', '2020-08-30 05:50:41'),
(79, 38, 'GM', 500, '15', '2020-08-21 14:12:52', '2020-08-30 05:50:41'),
(130, 50, 'KG', 1, '50', '2020-08-29 05:48:56', '2020-08-30 05:44:18'),
(81, 39, 'KG', 1, '80', '2020-08-21 14:24:46', '2020-08-31 06:37:36'),
(82, 39, 'GM', 500, '45', '2020-08-21 14:24:46', '2020-08-31 06:37:36'),
(84, 40, 'KG', 1, '72', '2020-08-21 14:35:11', '2020-08-30 05:49:39'),
(85, 40, 'GM', 500, '37', '2020-08-21 14:35:11', '2020-08-30 05:49:39'),
(129, 49, 'GM', 500, '30', '2020-08-29 05:45:51', '2020-08-29 05:45:51'),
(87, 41, 'GM', 500, '20', '2020-08-21 14:46:26', '2020-08-21 14:56:21'),
(88, 41, 'KG', 1, '40', '2020-08-21 14:46:26', '2020-08-21 14:56:21'),
(89, 41, 'KG', 2, '80', '2020-08-21 14:46:26', '2020-08-21 14:56:21'),
(90, 42, 'KG', 1, '90', '2020-08-21 14:49:44', '2020-08-30 05:49:02'),
(91, 42, 'GM', 500, '50', '2020-08-21 14:49:44', '2020-08-30 05:49:02'),
(128, 49, 'KG', 1, '50', '2020-08-29 05:45:51', '2020-08-29 05:45:51'),
(93, 43, 'KG', 1, '60', '2020-08-22 06:11:39', '2020-08-30 05:48:38'),
(94, 43, 'GM', 500, '33', '2020-08-22 06:11:39', '2020-08-30 05:48:38'),
(127, 48, 'PCS', 12, '240', '2020-08-29 05:06:36', '2020-08-30 05:45:51'),
(96, 44, 'KG', 1, '72', '2020-08-24 13:06:33', '2020-08-30 05:48:07'),
(97, 44, 'GM', 500, '40', '2020-08-24 13:06:33', '2020-08-30 05:48:07'),
(126, 48, 'PCS', 6, '120', '2020-08-29 05:06:36', '2020-08-30 05:45:51'),
(99, 45, 'KG', 1, '110', '2020-08-24 13:13:49', '2020-08-29 05:01:48'),
(100, 45, 'GM', 500, '60', '2020-08-24 13:13:49', '2020-08-29 05:01:48'),
(103, 3, 'KG', 3, '50', '2020-08-24 13:51:25', '2020-08-29 04:29:05'),
(125, 13, 'KG', 1, '70', '2020-08-29 04:34:24', '2020-08-31 05:46:19'),
(107, 18, 'KG', 1, '100', '2020-08-25 05:42:20', '2020-08-25 05:42:20'),
(108, 18, 'KG', 2, '200', '2020-08-25 05:42:20', '2020-08-25 05:42:20'),
(109, 2, 'GM', 500, '24', '2020-08-25 05:46:12', '2020-08-31 09:09:02'),
(112, 15, 'GM', 500, '60', '2020-08-25 05:50:37', '2020-08-29 04:35:30'),
(115, 11, 'KG', 2, '240', '2020-08-25 06:00:13', '2020-08-25 06:00:13'),
(116, 10, 'PCS', 6, '30', '2020-08-25 06:02:24', '2020-08-30 06:00:39'),
(124, 13, 'GM', 500, '35', '2020-08-29 04:34:24', '2020-08-31 05:46:19'),
(118, 46, 'KG', 1, '110', '2020-08-25 06:07:35', '2020-08-30 05:47:09'),
(119, 46, 'GM', 500, '60', '2020-08-25 06:07:35', '2020-08-30 05:47:09'),
(121, 47, 'KG', 1, '120', '2020-08-25 06:17:16', '2020-08-30 05:46:48'),
(122, 47, 'GM', 500, '65', '2020-08-25 06:17:16', '2020-08-30 05:46:48'),
(134, 52, 'KG', 1, '50', '2022-06-04 05:39:47', '2022-06-04 05:41:56'),
(135, 52, 'GM', 500, '40', '2022-06-04 05:39:47', '2022-06-04 05:41:56'),
(136, 53, 'KG', 2, '100', '2022-06-04 05:43:27', '2022-06-04 05:43:27'),
(137, 53, 'GM', 500, '50', '2022-06-04 05:43:27', '2022-06-04 05:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deliver_id` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `order_id`, `user_id`, `deliver_id`, `review`, `description`, `created`) VALUES
(1, 1, 1, 2, 5, 'Good work all of you', '2022-05-10 17:15:36'),
(2, 2, 1, 3, 5, 'Good work all of you', '2022-05-11 15:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_type` int(11) NOT NULL DEFAULT 0 COMMENT '0: Image, 1: Video',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `category_id`, `slider_image`, `slider_type`, `is_active`, `created`) VALUES
(1, 1, 'AbdullaBinKhater_slider1.jpg', 0, 1, '2020-06-06 08:17:02'),
(2, 2, '49017world-hands.png', 0, 1, '2020-07-24 19:17:05'),
(5, 1, '638623SampleVideo_360x240_2mb.mp4', 1, 1, '2022-05-06 16:42:01'),
(6, 4, '44909293653download.jpg', 0, 0, '2022-05-06 17:25:26'),
(7, 2, '721263SampleVideo_360x240_2mb.mp4', 1, 0, '2022-05-26 13:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'terms_and_condition_header', '<p>Terms &amp; Condition</p>\r\n', '2022-06-03 18:33:01', '2022-06-03 13:23:48'),
(2, 'terms_and_condition_description', '<p>&bull; Deliveries would take place around the same time and date selected by the customersM<br />\r\n&bull; For same day Deliveries the closing time 1 hour after your place order.<br />\r\n&bull; The above-mentioned details would have some exceptions.<br />\r\n&bull; Gujarat Foods will strive hard to deliver the products ordered on time, however we do not guarantee delivery on time.<br />\r\n&bull; Gujarat Foods is not liable for any incorrect address provided<br />\r\n&bull; Gujarat Foods does not guarantee to deliver all produce mentioned on the website.<br />\r\n&bull; Gujarat Foods will not cancel the order placed on the same day of the delivery.<br />\r\n&bull; Order can be changed or cancelled 30 min before the delivery time.<br />\r\n&bull; All decision on delivery charge, product availability, order cancellation is reserved with Gujarat Foods.</p>\r\n\r\n<p>This privacy policy has been compiled to better serve those who are concerned with how their &#39;Personally identifiable information&#39; (PII) is being used on Gujarat Foods. PII, as used in accordance with the Indian privacy act, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context.</p>\r\n\r\n<p>Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.</p>\r\n\r\n<p><strong>1. What personal information do we collect from the people that visit our website or app?</strong><br />\r\nWhen ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address, phone number or other details to help you with your experience.</p>\r\n\r\n<p><strong>2. When do we collect information?</strong><br />\r\nWe collect information from you when you register on our site, place an order or enter information on our site.</p>\r\n\r\n<p><strong>3. How do we use your information?</strong><br />\r\nWe may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:<br />\r\n<br />\r\n&bull; To personalize user&#39;s experience and to allow us to deliver the type of content and product offerings in which you are most interested.<br />\r\n&bull; To improve our website in order to better serve you.<br />\r\n&bull; To allow us to better service you in responding to your customer service requests.<br />\r\n&bull; To administer a contest, promotion, survey or other site feature.<br />\r\n&bull; To quickly process your transactions.<br />\r\n&bull; To ask for ratings and reviews of services or products</p>\r\n\r\n<p><strong>4. Do we collect and store your credit card information?</strong><br />\r\nNo. All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>\r\n\r\n<p><strong>5. How do we protect visitor information?</strong><br />\r\nOur website is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible.<br />\r\n<br />\r\nWe do not use Malware Scanning.<br />\r\n<br />\r\nYour personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.<br />\r\n<br />\r\nWe implement a variety of security measures when a user places an order enters, submits, or accesses their information to maintain the safety of your personal information. All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>\r\n\r\n<p><strong>a. Do we use &#39;cookies&#39;?</strong><br />\r\nYes. Cookies are small files that a site or its service provider transfers to your computer&#39;s hard drive through your Web browser (if you allow) that enables the site&#39;s or service provider&#39;s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future. We use cookies to:<br />\r\n<br />\r\n&bull; Help remember and process the items in the shopping cart.<br />\r\n&bull; Understand and save user&#39;s preferences for future visits.<br />\r\n&bull; Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third-party services that track this information on our behalf.<br />\r\n<br />\r\nYou can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser (like Internet Explorer) settings. Each browser is a little different, so look at your browser&#39;s Help menu to learn the correct way to modify your cookies.<br />\r\n<br />\r\nIf you disable cookies, some features will be disabled It won&#39;t affect the user&#39;s experience that make your site experience more efficient and some of our services will not function properly.<br />\r\n<br />\r\nHowever, you can still place orders.<br />\r\n<br />\r\n<strong>b. Third-party disclosure</strong><br />\r\nWe do not sell, trade, or otherwise transfer to outside parties your personally identifiable information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it&#39;s release is appropriate to comply with the law, enforce our site policies, or protect ours or others&#39; rights, property, or safety. However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.<br />\r\n<br />\r\nThird-party links Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Corrections</strong><br />\r\nIf you would like to update or correct information previously provided to us, please send an e-mail with your new information, including your complete name, postal address, and email address to&nbsp;<a href=\"mailto:Care@gujratfoods.in\">Care@gujratfoods.in</a>. and Phone Number to&nbsp;<a href=\"tel:+919876543210\">+919876543210</a>&nbsp;Registered users can modify and update their membership information (including name, mailing address, telephone number and email address) by accessing the password protected &quot;Edit Profile&quot; page.<br />\r\n<br />\r\nYour Consent and Changes to this Policy Subject to the above provisions, by using our Web Site, you consent to the terms of this Privacy Policy and the Terms of Use, of which this policy is a part. We may change our Privacy Policy from time to time as new features are added, suggestions from our customers are incorporated or other changes are made. We will post the revised Privacy Policy on our Web Site at least 30 days prior to their effective date - unless we believe changes must take effect sooner to comply with law or to protect the Company or our customers, users, members, recipients, sponsors, providers, licensors, merchants, associates and affiliates, in which case the changes will be effective upon posting or as otherwise specified.</p>\r\n', '2022-06-03 18:33:01', '2022-06-03 13:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0 COMMENT '0-user, 1-delivery boy',
  `login_type` int(11) NOT NULL DEFAULT 0 COMMENT '0-normal, 1-fb, 2-gmail, 3-apple',
  `login_identifier` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-deactive, 1-active',
  `active` int(11) NOT NULL DEFAULT 1,
  `referral_count` int(11) NOT NULL DEFAULT 0,
  `referral_amount` int(11) NOT NULL DEFAULT 0,
  `referral` varchar(255) DEFAULT NULL,
  `friend_referral` varchar(255) DEFAULT NULL,
  `referral_used` int(11) NOT NULL DEFAULT 0,
  `pincode` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `mobile`, `password`, `otp`, `dob`, `document`, `avatar`, `user_type`, `login_type`, `login_identifier`, `device_type`, `device_token`, `latitude`, `longitude`, `status`, `active`, `referral_count`, `referral_amount`, `referral`, `friend_referral`, `referral_used`, `pincode`, `created`, `updated`) VALUES
(1, 'John Dao', 'johndao@gmail.com', '9632587431', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1996-05-12', NULL, '611892avatar2.png', 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '738574', NULL, 0, 360004, '2022-05-10 16:23:09', '2022-05-31 16:54:46'),
(2, 'John Dao', 'johndao@gmail.com', '8080808080', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1996-05-12', '', '282131avatar2.png', 1, 0, '', 'ios', '123456', '12.352541', '13.362541', 1, 1, 0, 0, NULL, NULL, 0, NULL, '2022-05-10 16:48:56', '2022-05-10 16:52:21'),
(3, 'Johny Deep', '', '9090909090', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', '', '', 1, 0, '', 'ANDROID', '123456789', '12.362541', '13.236514', 1, 0, 0, 0, NULL, NULL, 0, NULL, '2022-05-11 15:43:27', NULL),
(4, 'Johny Deep', '', '9090909091', '4297f44b13955235245b2497399d7a93', NULL, '0000-00-00', NULL, NULL, 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '659077', NULL, 0, NULL, '2022-05-23 16:24:41', NULL),
(6, 'Zoe Mitchelle', '', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', NULL, NULL, 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '240104', NULL, 0, NULL, '2022-06-05 05:11:03', NULL),
(7, 'Brad Perez', '', '9876543211', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', NULL, NULL, 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '979009', NULL, 0, NULL, '2022-06-05 05:11:30', NULL),
(9, 'Hardik Chapla', '', '8073204662', '25f9e794323b453885f5181f1b624d0b', NULL, '0000-00-00', NULL, '15312320220522_093201.jpg', 0, 0, '', '', '', '', '', 1, 1, 0, 0, '815607', NULL, 0, NULL, '2022-06-08 09:50:59', '2022-06-08 10:16:14'),
(10, 'John Dao', '', '8080808091', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', NULL, NULL, 1, 0, '', 'ios', '123456', '12.362541', '13.236514', 0, 1, 0, 0, NULL, NULL, 0, NULL, '2022-06-08 13:35:00', NULL),
(11, 'John Dao', '', '8080808090', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', NULL, NULL, 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '954226', NULL, 0, NULL, '2022-06-08 13:35:18', NULL),
(12, 'kishan', '', '9427396304', '202cb962ac59075b964b07152d234b70', NULL, '0000-00-00', NULL, NULL, 0, 0, '', '', '', '', '', 1, 1, 0, 0, '427897', NULL, 0, NULL, '2022-06-08 14:01:28', '2022-06-08 14:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `alt_mobile_number` varchar(50) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `building_name` varchar(50) DEFAULT NULL,
  `road_area_colony` varchar(255) DEFAULT NULL,
  `main_area` varchar(50) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `full_name`, `mobile_number`, `alt_mobile_number`, `house_no`, `building_name`, `road_area_colony`, `main_area`, `landmark`, `city`, `address`, `pincode`, `state`, `latitude`, `longitude`, `is_default`, `created`) VALUES
(4, 2, 'KIshan Patel', '9632587445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101, Saurashtra\'s Residensy, Mota Varachha, Surat', 395006, 'Gujrat', NULL, NULL, 0, '2022-05-29 04:48:52'),
(5, 4, 'KIshan Patel', '9632587445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101, Saurashtra\'s Residensy, Mota Varachha, Surat', 395006, 'Gujrat', NULL, NULL, 1, '2022-05-29 04:49:03'),
(7, 1, 'KIshan Patel', '9427396304', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '105, velenja', 394150, 'gujrat', NULL, NULL, 0, '2022-05-29 05:06:29'),
(10, 1, 'KIshan ', '9632587445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rajkot', 151535, 'gujrat', NULL, NULL, 0, '2022-05-30 16:39:19'),
(21, 9, 'Hardik Chapla', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sardargadh, Gujarat 362640, India', 360000, 'gujarat', '21.5696844', '70.2021382', 0, '2022-06-08 10:09:09'),
(23, 9, 'Hardik Chapla', '8073204662', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rajkot, Gujarat 360022, India', 395001, 'gujarat', '22.1988203', '70.7943774', 0, '2022-06-08 10:13:29'),
(24, 11, 'Leah Barnes', '4125689995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1602, Green Rd, Tampa', 69207, 'Idaho', '12.2561451', '13.2651451', 0, '2022-06-08 13:48:36'),
(28, 9, 'Hardik Chapla', '9558686644', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Baharpara Street 6, Sardargadh, Gujarat 362640, India', 362640, 'gujarat', '21.5687846', '70.1989952', 1, '2022-06-09 05:19:03'),
(29, 12, 'kishan', '9427396304', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surat, Gujarat, India', 395006, 'gujarat', '21.1702401', '72.83106070000001', 0, '2022-06-10 07:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `near_by_request`
--
ALTER TABLE `near_by_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_address_id` (`user_address_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `near_by_request`
--
ALTER TABLE `near_by_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `near_by_request`
--
ALTER TABLE `near_by_request`
  ADD CONSTRAINT `near_by_request_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `near_by_request_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `product_order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `product_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`user_address_id`) REFERENCES `user_address` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
