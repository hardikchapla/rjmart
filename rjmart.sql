-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u806229794_dev
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'devadmin','devadmin','gujaratfruitsvegetables@gmail.com','975340favicon.png','9876543210','e10adc3949ba59abbe56e057f20f883e','2020-06-11 07:00:00','2020-08-19 14:41:05');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `product_type_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (170,21,2,2,3,'2020-08-31 03:05:29','2020-08-31 03:05:30'),(171,21,1,1,2,'2020-08-31 03:05:29',NULL),(172,21,13,1,124,'2020-08-31 03:06:52',NULL),(173,21,26,1,41,'2020-08-31 03:07:04',NULL),(177,5,35,1,69,'2020-08-31 10:37:52',NULL),(186,9,22,1,30,'2020-08-31 10:50:05',NULL),(218,11,38,4,78,'2020-08-31 14:36:10','2020-08-31 14:36:11'),(224,8,4,2,7,'2020-08-31 14:52:07','2020-08-31 14:52:09');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'vegetables.jpg','Vegetables (શાકભાજી)','2020-06-05 13:16:16','2020-06-16 22:23:09'),(2,'fruits.jpg','Fruits','2020-06-05 12:15:15',NULL),(3,'976030Ayurvedic-herb-herb-turmeric-indian-spices-1296x728-header-1296x728.jpg','Herbs and Seasonings(ઔષધો અને સીઝનિંગ્સ)','2020-08-02 19:51:48',NULL),(4,'2505600-38.png','Exotic Fruits & Vegetables','2020-08-02 19:54:12',NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

--
-- Table structure for table `near_by_request`
--

DROP TABLE IF EXISTS `near_by_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `near_by_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-pending, 1-accept, 2-reject',
  `order_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `near_by_request_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `near_by_request_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `product_order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `near_by_request`
--

/*!40000 ALTER TABLE `near_by_request` DISABLE KEYS */;
INSERT INTO `near_by_request` VALUES (2,2,3,1,4,'2020-08-19 17:48:12',NULL),(6,4,3,0,6,'2020-08-19 19:51:00',NULL),(7,5,3,0,7,'2020-08-20 13:28:49',NULL),(8,2,3,0,8,'2020-08-21 17:58:32',NULL),(9,7,3,0,9,'2020-08-22 12:34:53',NULL),(10,7,3,0,9,'2020-08-22 06:27:23','2020-08-22 06:27:23'),(11,20,22,1,15,'2020-08-31 05:23:47','2020-08-31 05:23:47'),(12,8,22,0,16,'2020-09-01 14:06:04',NULL),(13,8,22,0,17,'2020-09-01 14:12:32',NULL),(14,8,22,0,18,'2020-09-01 14:14:57',NULL),(15,8,22,0,19,'2020-09-01 14:51:36',NULL),(16,8,22,0,19,'2020-08-31 15:08:03','2020-08-31 15:08:03');
/*!40000 ALTER TABLE `near_by_request` ENABLE KEYS */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'which type of notification',
  `receiver_type` int(11) NOT NULL DEFAULT 0 COMMENT '0-user, 1-admin',
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0-unread, 1-read',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,1,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-19 16:26:19'),(2,1,NULL,1,'New Order','New order created successfully','new_order',1,0,'2020-08-19 16:30:42'),(3,1,NULL,1,'Cancel Order','Order cancelled successfully','order_cancelled',1,0,'2020-08-19 16:30:57'),(4,2,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-19 16:33:42'),(5,1,NULL,2,'New Order','New order created successfully','new_order',1,0,'2020-08-19 16:33:56'),(6,3,NULL,NULL,'Delivery boy register','New delivery boy register successfully','new_register',1,0,'2020-08-19 16:35:17'),(7,2,NULL,3,'New Order','New order created successfully','new_order',1,0,'2020-08-19 16:41:49'),(8,2,NULL,3,'Cancel Order','Order cancelled successfully','order_cancelled',1,0,'2020-08-19 16:42:17'),(9,3,NULL,2,'Order completed','Order completed successfully','order_shipped',1,0,'2020-08-19 16:43:51'),(10,2,NULL,4,'New Order','New order created successfully','new_order',1,0,'2020-08-19 16:48:12'),(11,1,NULL,5,'New Order','New order created successfully','new_order',1,0,'2020-08-19 16:51:53'),(12,3,NULL,5,'Order completed','Order completed successfully','order_shipped',1,0,'2020-08-19 17:03:02'),(13,4,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-19 18:49:16'),(14,4,NULL,6,'New Order','New order created successfully','new_order',1,0,'2020-08-19 18:51:00'),(15,4,NULL,6,'Cancel Order','Order cancelled successfully','order_cancelled',1,0,'2020-08-19 18:54:24'),(16,5,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-20 12:27:30'),(17,6,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-20 12:28:17'),(18,5,NULL,7,'New Order','New order created successfully','new_order',1,0,'2020-08-20 12:28:49'),(19,2,NULL,8,'New Order','New order created successfully','new_order',1,0,'2020-08-20 17:58:32'),(20,7,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-21 12:31:55'),(21,7,NULL,9,'New Order','New order created successfully','new_order',1,0,'2020-08-21 12:34:53'),(22,8,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-21 16:42:05'),(23,8,NULL,10,'New Order','New order created successfully','new_order',1,0,'2020-08-23 06:56:46'),(24,7,NULL,11,'New Order','New order created successfully','new_order',1,0,'2020-08-24 13:33:39'),(25,7,NULL,12,'New Order','New order created successfully','new_order',1,0,'2020-08-24 13:37:17'),(26,7,NULL,13,'New Order','New order created successfully','new_order',1,0,'2020-08-24 13:56:20'),(27,9,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-25 13:19:49'),(28,10,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-27 14:08:17'),(29,11,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-27 15:14:45'),(30,12,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-27 19:03:43'),(31,13,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-28 14:11:55'),(32,7,NULL,14,'New Order','New order created successfully','new_order',1,0,'2020-08-29 07:04:43'),(33,14,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-29 13:09:33'),(34,15,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-30 15:49:37'),(35,16,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-30 16:25:54'),(36,17,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-30 16:27:48'),(37,18,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-30 17:41:23'),(38,19,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 02:07:47'),(39,20,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 02:31:35'),(40,21,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 03:02:03'),(41,20,NULL,15,'New Order','New order created successfully','new_order',1,0,'2020-08-31 04:10:35'),(42,22,NULL,NULL,'Delivery boy register','New delivery boy register successfully','new_register',1,0,'2020-08-31 05:22:32'),(43,23,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 05:33:35'),(44,22,NULL,15,'Order completed','Order completed successfully','order_shipped',1,0,'2020-08-31 05:53:20'),(45,24,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 06:11:14'),(46,25,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 07:08:04'),(47,26,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 07:26:52'),(48,27,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 08:06:29'),(49,28,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 12:11:02'),(50,8,NULL,16,'New Order','New order created successfully','new_order',1,0,'2020-08-31 14:06:04'),(51,8,NULL,17,'New Order','New order created successfully','new_order',1,0,'2020-08-31 14:12:32'),(52,8,NULL,18,'New Order','New order created successfully','new_order',1,0,'2020-08-31 14:14:57'),(53,29,NULL,NULL,'User register','New user register successfully','new_register',1,0,'2020-08-31 14:21:29'),(54,8,NULL,19,'New Order','New order created successfully','new_order',1,0,'2020-08-31 14:51:36'),(55,30,NULL,NULL,'User register','New user register successfully','new_regiter',1,0,'2020-08-31 16:22:24'),(56,30,NULL,20,'New Order','New order created successfully','new_order',1,0,'2020-08-31 16:23:40'),(57,30,NULL,20,'Cancel Order','Order cancelled successfully','order_cancelled',1,0,'2020-09-01 09:29:32');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_items_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,1,2,'2020-08-19 16:30:42'),(2,1,2,3,3,'2020-08-19 16:30:42'),(3,2,19,23,1,'2020-08-19 16:33:56'),(4,2,18,22,1,'2020-08-19 16:33:56'),(5,2,17,21,1,'2020-08-19 16:33:56'),(6,2,16,20,1,'2020-08-19 16:33:56'),(7,2,15,18,1,'2020-08-19 16:33:56'),(8,3,13,16,1,'2020-08-19 16:41:49'),(9,3,2,3,1,'2020-08-19 16:41:49'),(10,3,3,5,1,'2020-08-19 16:41:49'),(11,4,8,9,1,'2020-08-19 16:48:12'),(12,5,1,1,4,'2020-08-19 16:51:53'),(13,6,3,5,1,'2020-08-19 18:51:00'),(14,6,4,7,1,'2020-08-19 18:51:00'),(15,7,1,1,2,'2020-08-20 12:28:49'),(16,7,2,3,1,'2020-08-20 12:28:49'),(17,7,9,12,1,'2020-08-20 12:28:49'),(18,7,13,16,1,'2020-08-20 12:28:49'),(19,7,3,5,1,'2020-08-20 12:28:49'),(20,7,4,7,1,'2020-08-20 12:28:49'),(21,7,8,9,1,'2020-08-20 12:28:49'),(22,7,10,13,1,'2020-08-20 12:28:49'),(23,8,8,9,1,'2020-08-20 17:58:32'),(24,9,1,1,1,'2020-08-21 12:34:53'),(25,9,2,3,1,'2020-08-21 12:34:53'),(26,9,13,16,1,'2020-08-21 12:34:53'),(27,10,1,1,2,'2020-08-23 06:56:46'),(28,10,40,84,2,'2020-08-23 06:56:46'),(29,10,39,81,1,'2020-08-23 06:56:46'),(30,11,1,1,5,'2020-08-24 13:33:39'),(31,12,1,1,6,'2020-08-24 13:37:17'),(32,13,1,1,9,'2020-08-24 13:56:20'),(33,14,2,3,2,'2020-08-29 07:04:43'),(34,14,29,51,1,'2020-08-29 07:04:43'),(35,15,31,57,3,'2020-08-31 04:10:35'),(36,16,39,81,2,'2020-08-31 14:06:04'),(37,16,43,95,1,'2020-08-31 14:06:04'),(38,16,33,63,1,'2020-08-31 14:06:04'),(39,16,4,7,1,'2020-08-31 14:06:04'),(40,16,46,118,1,'2020-08-31 14:06:04'),(41,16,48,127,1,'2020-08-31 14:06:04'),(42,17,2,3,3,'2020-08-31 14:12:32'),(43,17,1,1,2,'2020-08-31 14:12:32'),(44,17,13,125,1,'2020-08-31 14:12:32'),(45,18,1,1,1,'2020-08-31 14:14:57'),(46,18,25,37,1,'2020-08-31 14:14:57'),(47,18,28,48,3,'2020-08-31 14:14:57'),(48,19,1,1,1,'2020-08-31 14:51:36'),(49,19,22,30,1,'2020-08-31 14:51:36'),(50,19,13,125,2,'2020-08-31 14:51:36'),(51,19,2,3,1,'2020-08-31 14:51:36'),(52,20,1,1,1,'2020-08-31 16:23:40'),(53,20,2,3,1,'2020-08-31 16:23:40'),(54,20,13,125,1,'2020-08-31 16:23:40');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-failed, 1-done, 2-cancel',
  `payment_identifier` varchar(255) DEFAULT NULL,
  `TXNDATE` varchar(50) DEFAULT NULL,
  `refId` varchar(255) DEFAULT NULL,
  `payment_type` int(11) DEFAULT 0 COMMENT '0-cash, 1-paytm',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `product_order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (3,2,3,1,'20200819111212800110168725201850002','2020-08-19 22:07:27.0',NULL,1,'2020-08-19 16:41:49',NULL),(4,2,4,1,'20200819111212800110168304301918502','2020-08-19 22:18:02.0',NULL,1,'2020-08-19 16:48:12',NULL),(6,4,6,1,'20200820111212800110168302201918512','2020-08-20 00:20:30.0',NULL,1,'2020-08-19 18:51:00',NULL),(7,5,7,1,'','',NULL,0,'2020-08-20 12:28:49',NULL),(8,2,8,1,'','',NULL,0,'2020-08-20 17:58:32',NULL),(9,7,9,1,'','',NULL,0,'2020-08-21 12:34:53',NULL),(10,8,10,1,'','',NULL,0,'2020-08-23 06:56:46',NULL),(11,7,11,1,'','',NULL,0,'2020-08-24 13:33:39',NULL),(12,7,12,1,'','',NULL,0,'2020-08-24 13:37:17',NULL),(13,7,13,1,'','',NULL,0,'2020-08-24 13:56:20',NULL),(14,7,14,1,'','',NULL,0,'2020-08-29 07:04:43',NULL),(15,20,15,1,'','',NULL,0,'2020-08-31 04:10:35',NULL),(16,8,16,1,'','',NULL,0,'2020-08-31 14:06:04',NULL),(17,8,17,1,'','',NULL,0,'2020-08-31 14:12:32',NULL),(18,8,18,1,'','',NULL,0,'2020-08-31 14:14:57',NULL),(19,8,19,1,'','',NULL,0,'2020-08-31 14:51:36',NULL),(20,30,20,1,'','',NULL,0,'2020-08-31 16:23:40',NULL);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL COMMENT 'in %',
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0 - no, 1 - yes',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'Cabbage (કોબી)','<p>Green cabbage</p>\r\n',NULL,1,'2020-06-06 12:13:16','2020-08-31 05:45:16'),(2,1,'potato (બટેકા)','<p>Quality Available: A Grade, Packaging Type Available: Net Bag, Cultivation Type: Common, We are the leading entity of a wide range of Fresh Potato.</p>\r\n',NULL,1,'2020-06-06 10:07:07','2020-08-31 09:09:02'),(3,2,'Watermelon (તરબૂચ)','<p>The&nbsp;watermelon&nbsp;is a large&nbsp;fruit&nbsp;of a more or less spherical shape. ... It has an oval or spherical shape and a dark green and smooth rind, sometimes showing irregular areas of a pale green colour. It has a sweet, juicy, refreshing flesh of yellowish or reddish colour, containing multiple black, brown or white pips.</p>\r\n',NULL,0,'2020-06-06 12:13:13','2020-08-29 04:29:05'),(4,2,'Orange (નારંગી)','<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, <em>graphic or web designs.</em> The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>\r\n',NULL,1,'2020-06-06 13:15:12','2020-08-30 06:01:06'),(10,2,'Banana (કેળા)','<p>Banana,&nbsp;<a href=\"https://www.britannica.com/science/fruit-plant-reproductive-body\">fruit</a>&nbsp;of the&nbsp;<a href=\"https://www.britannica.com/science/genus-taxon\">genus</a>&nbsp;<em>Musa</em>, of the family&nbsp;<a href=\"https://www.britannica.com/plant/Musaceae\">Musaceae</a>, one of the most important fruit crops of the world. The banana is grown in the tropics, and, though it is most widely consumed in those regions, it is valued worldwide for its flavour, nutritional value, and availability throughout the year.&nbsp;<a href=\"https://www.britannica.com/plant/Cavendish-banana\">Cavendish</a>, or dessert, bananas are most commonly eaten fresh, though they may be fried or mashed and chilled in pies or puddings.</p>\r\n',NULL,1,'2020-07-05 19:27:58','2020-08-30 06:00:39'),(11,2,'Black Currant (કાળો જાંબુ)','<p>Overview&nbsp;-&nbsp;Black currant.&nbsp;Blackcurrant&nbsp;is a berry of translucent pulp with&nbsp;red&nbsp;or green tones and bittersweet taste. The fruit is small, of&nbsp;black-blue colour and spherical shape, with an intense taste when completely ripe. This berry is covered with hair and its pulp contains multiple small seeds.</p>\r\n',NULL,0,'2020-07-05 19:28:57','2020-08-25 06:00:13'),(13,1,'Brinjal (રીંગણા)','<p>Brinjal&nbsp;is an erect annual plant, often spiny, with large, coarsely lobed fuzzy leaves, 10-20 cm long and 5-10 cm broad. The plants usually grow 45 to 60 cm high and bears long to oval shaped, purple or greenish fruits. Flowers are white to purple, with five-lobed corolla and yellow stamens.</p>\r\n',NULL,1,'2020-07-05 19:30:53','2020-08-31 05:46:19'),(15,2,'Grapes (દ્રાક્ષ)','<p>A&nbsp;grape&nbsp;is a fruit, botanically a berry, of the deciduous woody vines of the flowering plant genus Vitis.&nbsp;Grapes&nbsp;can be eaten fresh as table&nbsp;grapes&nbsp;or they can be used for making wine, jam,&nbsp;grape&nbsp;juice, jelly,&nbsp;grape&nbsp;seed extract, raisins, vinegar, and&nbsp;grape&nbsp;seed oil.</p>\r\n',NULL,0,'2020-07-05 19:32:36','2020-08-29 04:35:30'),(22,1,'Sponge gourd (ગાલ્કા)','<p>The&nbsp;Sponge gourd&nbsp;is a cylindrical fruit that grows on a climbing, herbaceous vine. ... The interior flesh of the&nbsp;Sponge gourd&nbsp;is smooth and creamy-white.&nbsp;Sponge gourd&nbsp;has a mild, zucchini-like sweet taste and a silky texture. Mature fruits are not tasty, being fibrous, bitter and brown.</p>\r\n',NULL,1,'2020-08-14 20:19:20','2020-08-31 05:46:36'),(24,1,'LEMON(લીંબુ)','<p>The&nbsp;lemon&nbsp;is a round, slightly elongated fruit, it has a strong and resistant skin, with an intense bright yellow colour when it is totaly ripe, giving off a special aroma when it is cut. The pulp is pale yellow, juicy and acid, divided in gores.</p>\r\n',NULL,1,'2020-08-21 11:32:13','2020-08-31 05:46:54'),(25,1,'OKRA(ભીંડા)','<p>Okra, Abelmoschus esculentus, is an herbaceous annual plant in the family Malvaceae which is grown for its edible seed pods.&nbsp;Okra&nbsp;plants have small erect stems that can be bristly or hairless with heart-shaped leaves.</p>\r\n',NULL,1,'2020-08-21 11:42:20','2020-08-31 05:47:26'),(26,1,'GUAR (ગુવાર)','<p>The&nbsp;guar&nbsp;or cluster bean, with the botanical name Cyamopsis tetragonoloba, is an annual legume and the source of&nbsp;guar&nbsp;gum. It is also known as gavar,&nbsp;gawar, or&nbsp;guvar&nbsp;bean. ... This legume is a valuable plant in a crop rotation cycle, as it lives in symbiosis with nitrogen-fixing bacteria</p>\r\n',NULL,1,'2020-08-21 11:59:17','2020-08-31 05:47:51'),(27,1,'Luffa acutangula (તુરીયા)','<p>It is a dark green, ridged and tapering pretty vegetable. It has white pulp with white seeds embedded in spongy flesh. A&nbsp;ridge gourd&nbsp;also commonly known as Turai or Turiya is a well beloved in India. Its hard skin is peeled off and chopped and cooked as desired.</p>\r\n',NULL,1,'2020-08-21 12:07:53','2020-08-31 05:48:54'),(28,1,'Lobia Beans (ચોલી)','<p>Punjabi&nbsp;Lobia&nbsp;is a North Indian Style Black Eyed&nbsp;Beans&nbsp;curry where&nbsp;lobia&nbsp;is cooked in a spicy onion tomato gravy. It can be paired best with paratha, phulka, and rice.</p>\r\n',NULL,1,'2020-08-21 12:33:53','2020-08-31 05:49:29'),(29,1,'carrot (ગાજર)','<p>The&nbsp;carrot&nbsp;(Daucus carota subsp. sativus) is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist. ... The&nbsp;carrot&nbsp;is a biennial plant in the umbellifer family, Apiaceae. At first, it grows a rosette of leaves while building up the enlarged taproot.</p>\r\n',NULL,1,'2020-08-21 12:51:46','2020-08-31 05:49:45'),(30,1,'cucumber (કાકડી)','<p>Cucumber, Cucumis sativus, is a warm season, vining, annual plant in the family Cucurbitaceae grown for its edible&nbsp;cucumber&nbsp;fruit. The&nbsp;cucumber&nbsp;plant is a sprawling vine with large leaves and curling tendrils. ... The leaves of the plant are arranged alternately on the vines, have 3&ndash;7 pointed lobes and are hairy.</p>\r\n',NULL,1,'2020-08-21 12:55:56','2020-08-31 05:50:09'),(31,1,'Tomato (ટોમેટો)','<p>Tomato, Lycopersicum esculentum (syn. Solanum lycopersicum and Lycopersicon lycopersicum) is an herbaceous annual in the family Solanaceae grown for its edible fruit. The plant can be erect with short stems or vine-like with long, spreading stems.</p>\r\n',NULL,1,'2020-08-21 13:00:24','2020-08-31 05:30:56'),(32,3,'coriander (ધાના)','<p>Coriander&nbsp;is native to regions spanning from Southern Europe and Northern Africa to Southwestern Asia. It is a soft plant growing to 50 cm (20 in) tall. The leaves are variable in shape, broadly lobed at the base of the plant, and slender and feathery higher on the flowering stems.</p>\r\n',NULL,1,'2020-08-21 13:31:14','2020-08-31 06:38:45'),(33,3,'Ginger (આદુ)','<p>Ginger&nbsp;(Zingiber officinale) is a flowering plant whose rhizome,&nbsp;ginger&nbsp;root or&nbsp;ginger, is widely used as a spice and a folk medicine. It is a herbaceous perennial which grows annual pseudostems (false stems made of the rolled bases of leaves) about one meter tall bearing narrow leaf blades.</p>\r\n',NULL,1,'2020-08-21 13:34:49','2020-08-31 06:38:29'),(34,1,'Green Chili (મરચાં)','<p>Green Chillies&nbsp;A spice without which Indian cuisine would be incomplete, the most common variety of&nbsp;chilli&nbsp;used apart from red is the&nbsp;green. These are used with or without the stalks, whole or chopped, with seeds or deseeded. They are used fresh, dried, powdered, pickled or in sauces.</p>\r\n',NULL,1,'2020-08-21 13:40:19','2020-08-30 05:53:32'),(35,3,'Methi leaves (મેથી)','<p>Methi leaves&nbsp;can help in weight loss. Both&nbsp;fenugreek&nbsp;seeds and&nbsp;leaves&nbsp;can help in weight loss. These&nbsp;leaves&nbsp;are high in fiber and other essential nutrients. Fibre can keep you full for longer and make you eat less. These&nbsp;leaves&nbsp;will also provide you other essential nutrients as well.</p>\r\n',NULL,1,'2020-08-21 13:46:33','2020-08-31 06:38:03'),(36,1,'Coccinia Grandis (ટિંડોરા)','<p>grandis&nbsp;is a dioecious, perennial, herbaceous vine that can grow between 9 and 28 m long. It has glabrous stems, an extensive tuberous root system and axillary tendrils. The alternate, simple leaves have a broadly ovate, 5-lobed, 5-9 by 4-9 cm. The flowers are white, star-shaped with 5 peta</p>\r\n',NULL,1,'2020-08-21 13:55:05','2020-08-30 05:52:05'),(37,3,'Spinach (પાલક)','<p>Spinach is a leafy green flowering plant native to central and western Asia. It is of the order Caryophyllales, family Amaranthaceae, subfamily Chenopodioideae. Its leaves are a common edible vegetable consumed either fresh, or after storage using preservation techniques by canning, freezing, or dehydration.</p>\r\n',NULL,1,'2020-08-21 14:06:38','2020-08-31 06:37:50'),(38,1,'Onion (ડુંગળી)','<p>The onion, also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium. Its close relatives include the garlic, scallion, shallot, leek, chive, and Chinese onion.</p>\r\n',NULL,1,'2020-08-21 14:12:52','2020-08-30 05:50:41'),(39,3,'Amaranthus Green (તાંજલીયા)','<p>Amaranthus viridis is a cosmopolitan species in the botanical family Amaranthaceae and is commonly known as slender amaranth or green amaranth.</p>\r\n',NULL,1,'2020-08-21 14:24:46','2020-08-31 06:37:36'),(40,1,'Flat Beans (પાપડી)','<p>Flat beans, also known as helda beans, romano beans and &quot;sem fhali&quot; in some Indian states, are a variety of Phaseolus coccineus, known as runner bean with edible pods that have a characteristic wide and flat shape. Flat beans are normally cooked and served as the whole pods, the same way as other green beans.</p>\r\n',NULL,1,'2020-08-21 14:35:11','2020-08-30 05:49:39'),(42,1,'Spiny gourd (કંટોલા)','<p>Momordica dioica, commonly known as spiny gourd or spine gourd and also known as bristly balsam pear, prickly carolaho, teasle gourd, kantola, is a species of flowering plant in the Cucurbitaceae/gourd family. It is used as a vegetable in all regions of India and some parts in South Asia.</p>\r\n',NULL,1,'2020-08-21 14:49:44','2020-08-30 05:49:02'),(43,1,'Calabash (દુધિ)','<p>Calabash, also known as bottle gourd, white-flowered gourd, long melon, New Guinea bean and Tasmania bean is a vine grown for its fruit. It can be either harvested young to be consumed as a vegetable, or harvested mature to be dried and used as a utensil.</p>\r\n',NULL,1,'2020-08-22 06:11:39','2020-08-30 05:48:38'),(44,1,'Bitter Melon (કારેલા)','<p>Momordica charantia is a tropical and subtropical vine of the family Cucurbitaceae, widely grown in Asia, Africa, and the Caribbean for its edible fruit. Its many varieties differ substantially in the shape and bitterness of the fruit. Bitter melon originated in India and was introduced into China in the 14th century.&nbsp;</p>\r\n',NULL,1,'2020-08-24 13:06:33','2020-08-30 05:48:07'),(45,1,'Green Peas (વટણા)','<p>A&nbsp;pea&nbsp;is a most commonly&nbsp;green, occasionally golden yellow, or infrequently purple pod-shaped vegetable, widely grown as a cool season vegetable crop. The seeds may be planted as soon as the soil temperature reaches 10 &deg;C (50 &deg;F),&nbsp;with&nbsp;the plants growing best at temperatures&nbsp;of&nbsp;13 to 18 &deg;C (55 to 64 &deg;F).</p>\r\n',NULL,0,'2020-08-24 13:13:49','2020-08-29 05:01:48'),(46,2,'Pomegranate (દાડમ)','<p>The pomegranate is a fruit-bearing deciduous shrub in the family Lythraceae, subfamily Punicoideae, that grows between 5 and 10 m tall. The pomegranate originated in the region extending from Iran to northern India, and has been cultivated since ancient times throughout the Mediterranean region.</p>\r\n',NULL,1,'2020-08-25 06:07:35','2020-08-30 05:47:09'),(47,2,'Guava (જામફળ)','<p>Guava&nbsp;is a fast growing evergreen shrub or small tree that can grow to a height of 3-10 m. It has a shallow root system.&nbsp;Guava&nbsp;produces low drooping branches from the base and suckers from the roots. The trunk is slender, 20 cm in diameter, covered with a smooth green to red brown bark that peels off in thin flakes.</p>\r\n',NULL,0,'2020-08-25 06:17:16','2020-08-30 05:46:48'),(48,2,'Apple (સફરજન)','<p>An apple is an edible fruit produced by an apple tree. Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today.</p>\r\n',NULL,1,'2020-08-29 05:06:36','2020-08-30 05:45:51'),(49,1,'Cauliflower (ફ્લાવર)','<p>Cauliflower is one of several vegetables in the species Brassica oleracea in the genus Brassica, which is in the Brassicaceae family. It is an annual plant that reproduces by seed. Typically, only the head is eaten &ndash; the edible white flesh sometimes called &quot;curd&quot;.</p>\r\n',NULL,0,'2020-08-29 05:45:51',NULL),(50,1,'Daikon (મુલો)','<p>Daikon, Raphanus sativus var. longipinnatus, also known by many other names depending on context, is a mild-flavored winter radish usually characterized by fast-growing leaves and a long, white, napiform root.</p>\r\n',NULL,0,'2020-08-29 05:48:56','2020-08-30 05:44:18'),(51,3,'Garlic (લસન)','<p>Garlic is a species in the onion genus, Allium. Its close relatives include the onion, shallot, leek, chive, and Chinese onion. It is native to Central Asia and northeastern Iran, and has long been a common seasoning worldwide, with a history of several thousand years of human consumption and use.&nbsp;</p>\r\n',NULL,1,'2020-08-29 05:52:29','2020-08-31 06:37:14');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
INSERT INTO `product_image` VALUES (1,1,'cabbage.jpeg','2020-06-06 15:17:17'),(2,1,'cabbage1.jpeg','2020-06-06 11:11:10'),(3,1,'cabbage3.jpeg','2020-06-06 12:12:12'),(10,4,'orange.jpeg','2020-06-06 13:13:13'),(11,4,'orange2.jpg','2020-06-06 11:09:09'),(12,4,'orange3.jpeg','2020-06-06 12:12:12'),(20,10,'781227.jpg','2020-07-05 19:27:58'),(21,11,'254910.jpg','2020-07-05 19:28:57'),(25,15,'811654.jpg','2020-07-05 19:32:36'),(42,24,'65105.jpeg','2020-08-21 11:32:13'),(43,24,'671081.jpg','2020-08-21 11:32:13'),(44,24,'450224.jpg','2020-08-21 11:32:13'),(45,24,'763015.png','2020-08-21 11:32:13'),(46,25,'888060.jpg','2020-08-21 11:42:20'),(47,25,'272635.jpg','2020-08-21 11:42:20'),(48,25,'933822.png','2020-08-21 11:42:20'),(52,27,'417309.png','2020-08-21 12:07:53'),(53,27,'507441.jpg','2020-08-21 12:07:53'),(55,26,'836450.jpg','2020-08-21 12:10:03'),(56,26,'48653.jpg','2020-08-21 12:10:03'),(58,22,'320974.jpg','2020-08-21 12:19:10'),(59,22,'965630.jpg','2020-08-21 12:19:10'),(62,28,'303531.jpg','2020-08-21 12:33:53'),(63,22,'395527.jpg','2020-08-21 12:34:43'),(65,27,'142662.jpg','2020-08-21 12:40:08'),(67,26,'161086.jpg','2020-08-21 12:45:35'),(68,28,'628844.jpg','2020-08-21 12:46:41'),(69,28,'776355.jpg','2020-08-21 12:46:41'),(70,29,'254638.jpg','2020-08-21 12:51:46'),(71,29,'237477.jpg','2020-08-21 12:51:46'),(72,29,'228238.jpg','2020-08-21 12:51:46'),(74,31,'735910.jpg','2020-08-21 13:00:24'),(75,31,'30331.jpg','2020-08-21 13:00:24'),(76,30,'180251.jpg','2020-08-21 13:09:42'),(77,30,'879783.jpg','2020-08-21 13:09:42'),(78,30,'877528.jpg','2020-08-21 13:09:42'),(79,32,'522223.jpg','2020-08-21 13:31:14'),(80,32,'898714.jpg','2020-08-21 13:31:14'),(81,32,'781996.jpg','2020-08-21 13:31:14'),(82,33,'57475.jpg','2020-08-21 13:34:49'),(83,33,'487352.jpg','2020-08-21 13:34:49'),(84,33,'20870.png','2020-08-21 13:34:49'),(85,34,'524564.jpg','2020-08-21 13:40:19'),(86,34,'968991.png','2020-08-21 13:40:19'),(87,34,'486899.jpeg','2020-08-21 13:40:19'),(88,35,'692299.jpeg','2020-08-21 13:46:33'),(89,35,'986530.jpg','2020-08-21 13:46:33'),(90,35,'139137.jpg','2020-08-21 13:46:33'),(91,36,'184240.jpg','2020-08-21 13:55:05'),(92,36,'713957.jpg','2020-08-21 13:55:05'),(93,36,'249262.jpg','2020-08-21 13:55:05'),(94,37,'339887.jpg','2020-08-21 14:06:38'),(95,37,'574588.jpg','2020-08-21 14:06:38'),(96,37,'838334.jpg','2020-08-21 14:06:38'),(97,38,'302807.jpg','2020-08-21 14:12:52'),(98,38,'159333.jpg','2020-08-21 14:12:52'),(99,38,'451366.jpg','2020-08-21 14:12:52'),(101,39,'993045.jpg','2020-08-21 14:24:46'),(103,39,'639445.png','2020-08-21 14:25:59'),(104,40,'873888.jpg','2020-08-21 14:35:11'),(105,40,'516873.png','2020-08-21 14:35:11'),(106,40,'186510.jpg','2020-08-21 14:35:11'),(110,42,'907951.jpg','2020-08-21 14:49:44'),(111,42,'227578.jpg','2020-08-21 14:49:44'),(112,42,'122668.jpg','2020-08-21 14:49:44'),(116,43,'136783.jpg','2020-08-22 06:11:39'),(117,43,'30501.jpg','2020-08-22 06:11:39'),(118,43,'443080.jpg','2020-08-22 06:11:39'),(119,44,'873024.jpeg','2020-08-24 13:06:33'),(120,44,'605382.jpeg','2020-08-24 13:06:33'),(121,44,'14703.jpeg','2020-08-24 13:06:33'),(122,45,'85732.jpeg','2020-08-24 13:13:49'),(123,45,'926766.jpeg','2020-08-24 13:13:49'),(124,45,'951661.jpeg','2020-08-24 13:13:49'),(132,3,'442065.jpg','2020-08-24 13:51:25'),(133,3,'269639.jpg','2020-08-24 13:51:25'),(134,3,'885213.jpg','2020-08-24 13:51:25'),(138,2,'84965.jpg','2020-08-25 05:46:12'),(139,2,'574502.jpg','2020-08-25 05:46:12'),(140,2,'916226.jpg','2020-08-25 05:46:12'),(141,15,'164917.jpg','2020-08-25 05:50:37'),(142,15,'31324.jpg','2020-08-25 05:50:37'),(143,13,'632323.jpg','2020-08-25 05:54:13'),(144,13,'852326.jpg','2020-08-25 05:54:13'),(145,13,'658973.jpg','2020-08-25 05:54:13'),(146,11,'655560.jpeg','2020-08-25 06:00:13'),(147,11,'740626.jpg','2020-08-25 06:00:13'),(148,10,'280343.jpg','2020-08-25 06:02:24'),(149,10,'694954.jpg','2020-08-25 06:02:24'),(150,46,'740087.jpg','2020-08-25 06:07:35'),(151,46,'101405.jpg','2020-08-25 06:07:35'),(152,46,'641155.jpeg','2020-08-25 06:07:35'),(153,47,'884574.jpg','2020-08-25 06:17:16'),(154,47,'981350.jpg','2020-08-25 06:17:16'),(155,47,'634761.jpeg','2020-08-25 06:17:16'),(156,39,'23819.jpg','2020-08-29 04:43:48'),(157,48,'240530.jpg','2020-08-29 05:06:36'),(158,48,'607743.jpeg','2020-08-29 05:06:36'),(159,48,'242357.jpeg','2020-08-29 05:06:36'),(160,49,'39995.jpg','2020-08-29 05:45:51'),(161,49,'249804.jpg','2020-08-29 05:45:51'),(162,49,'13450.jpg','2020-08-29 05:45:51'),(163,50,'355745.png','2020-08-29 05:48:56'),(164,50,'521211.jpg','2020-08-29 05:48:56'),(165,50,'563898.jpg','2020-08-29 05:48:56'),(166,51,'875441.jpg','2020-08-29 05:52:29'),(167,51,'970971.png','2020-08-29 05:52:29'),(168,51,'764973.jpg','2020-08-29 05:52:29');
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_order_ibfk_3` (`user_address_id`),
  CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_order_ibfk_3` FOREIGN KEY (`user_address_id`) REFERENCES `user_address` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (3,'ORDER2020081904372015',2,2,'140','paytm',3,0,'2020-08-19 17:41:49',0,0,NULL,NULL,'2020-08-19 16:41:49',NULL),(4,'ORDER2020081904475953',2,2,'1000','paytm',4,0,'2020-08-19 17:48:12',0,0,502418,NULL,'2020-08-19 16:48:12',NULL),(6,'ORDER2020081906502841',4,3,'120','paytm',0,0,'2020-08-19 19:51:00',0,0,NULL,NULL,'2020-08-19 18:51:00',NULL),(7,'ORDER2020082012284937',5,4,'1300','cash',0,0,'2020-08-20 13:28:49',0,0,NULL,NULL,'2020-08-20 12:28:49',NULL),(8,'ORDER2020082005583224',2,2,'1000','cash',0,0,'2020-08-21 17:58:32',0,0,NULL,NULL,'2020-08-20 17:58:32',NULL),(9,'ORDER2020082112345319',7,6,'105','cash',4,0,'2020-08-22 12:34:53',0,0,470630,NULL,'2020-08-21 12:34:53',NULL),(10,'ORDER2020082306564646',8,7,'130','cash',0,0,'2020-08-24 06:56:46',0,0,NULL,NULL,'2020-08-23 06:56:46',NULL),(11,'ORDER2020082401333941',7,6,'125','cash',0,0,'2020-08-25 13:33:39',0,0,NULL,NULL,'2020-08-24 13:33:39',NULL),(12,'ORDER2020082401371786',7,6,'150','cash',0,0,'2020-08-25 13:37:17',0,0,NULL,NULL,'2020-08-24 13:37:17',NULL),(13,'ORDER2020082401562066',7,6,'225','cash',0,0,'2020-08-25 13:56:20',0,0,NULL,NULL,'2020-08-24 13:56:20',NULL),(14,'ORDER2020082907044386',7,6,'140','cash',0,0,'2020-08-30 07:04:43',0,0,NULL,NULL,'2020-08-29 07:04:43',NULL),(15,'ORDER2020083104103590',20,9,'120','cash',2,0,'2020-09-01 04:10:35',1,0,804171,NULL,'2020-08-31 04:10:35',NULL),(16,'ORDER2020083102060460',8,7,'930','cash',0,0,'2020-09-01 14:06:04',0,0,NULL,NULL,'2020-08-31 14:06:04',NULL),(17,'ORDER2020083102123240',8,7,'346','cash',0,0,'2020-09-01 14:12:32',0,0,NULL,NULL,'2020-08-31 14:12:32',NULL),(18,'ORDER2020083102145747',8,7,'526','cash',0,0,'2020-09-01 14:14:57',0,0,NULL,NULL,'2020-08-31 14:14:57',NULL),(19,'ORDER2020083102513618',8,7,'314','cash',4,0,'2020-09-01 14:51:36',0,0,488623,NULL,'2020-08-31 14:51:36',NULL),(20,'ORDER2020083104234021',30,10,'184','cash',3,0,'2020-09-01 16:23:40',0,0,NULL,'for testing','2020-08-31 16:23:40',NULL);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `Product_qty` int(11) NOT NULL,
  `product_type_price` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (1,1,'KG',1,'66','2020-06-06 04:11:11','2020-08-31 05:45:16'),(3,2,'KG',1,'48','2020-06-06 05:12:12','2020-08-31 09:09:02'),(102,3,'KG',5,'95','2020-08-24 13:51:25','2020-08-29 04:29:05'),(7,4,'KG',1,'200','2020-06-06 04:11:11','2020-08-30 06:01:06'),(8,4,'GM',500,'110','2020-06-06 04:11:11','2020-08-30 06:01:06'),(9,8,'kg',20,'1000','2020-07-03 17:08:33','2020-07-03 17:10:54'),(10,8,'kg',10,'500','2020-07-03 17:08:33','2020-07-03 17:10:54'),(12,9,'kg',1,'30','2020-07-05 12:25:38','2020-08-14 13:27:42'),(13,10,'PCS',12,'50','2020-07-05 12:27:58','2020-08-30 06:00:39'),(14,11,'GM',500,'60','2020-07-05 12:28:57','2020-08-25 06:00:13'),(15,12,'gm',500,'100','2020-07-05 12:29:46','2020-07-05 12:33:34'),(114,11,'KG',1,'120','2020-08-25 06:00:13','2020-08-25 06:00:13'),(17,14,'pcs',2,'40','2020-07-05 12:31:37','2020-07-05 12:31:37'),(18,15,'KG',1,'100','2020-07-05 12:32:36','2020-08-29 04:35:30'),(31,23,'G.M',500,'20','2020-08-21 11:32:11','2020-08-21 11:32:11'),(20,16,'gm',200,'15','2020-07-05 12:34:34','2020-07-05 12:34:34'),(21,17,'kg',1,'120','2020-07-05 12:35:38','2020-07-05 12:35:38'),(22,18,'GM',500,'50','2020-07-05 12:36:25','2020-08-25 05:42:20'),(23,19,'pcs',3,'15','2020-07-05 12:37:07','2020-07-05 12:37:07'),(24,20,'ltr',1,'100','2020-07-20 16:40:37','2020-07-20 16:40:37'),(25,20,'Kg',1,'200','2020-08-01 13:49:53','2020-08-01 13:49:53'),(26,20,'Gm',500,'100','2020-08-01 13:49:53','2020-08-01 13:49:53'),(27,20,'Kg',2,'300','2020-08-01 13:49:53','2020-08-01 13:49:53'),(28,20,'GM',1,'100','2020-08-14 13:19:19','2020-08-14 13:19:19'),(29,21,'GM',1,'100','2020-08-14 13:19:19','2020-08-14 13:19:19'),(30,22,'KG',1,'60','2020-08-14 13:19:20','2020-08-31 05:46:36'),(32,23,'K.G',1,'40','2020-08-21 11:32:11','2020-08-21 11:32:11'),(33,23,'K.G',2,'70','2020-08-21 11:32:11','2020-08-21 11:32:11'),(34,24,'KG',1,'50','2020-08-21 11:32:13','2020-08-31 05:46:54'),(35,24,'GM',500,'25','2020-08-21 11:32:13','2020-08-31 05:46:54'),(37,25,'KG',1,'70','2020-08-21 11:42:20','2020-08-31 05:47:26'),(38,25,'GM',500,'35','2020-08-21 11:42:20','2020-08-31 05:47:26'),(40,26,'KG',1,'70','2020-08-21 11:59:17','2020-08-31 05:47:51'),(41,26,'GM',500,'35','2020-08-21 11:59:17','2020-08-31 05:47:51'),(43,27,'KG',1,'70','2020-08-21 12:07:53','2020-08-31 05:48:54'),(44,27,'GM',500,'35','2020-08-21 12:07:53','2020-08-31 05:48:54'),(46,22,'GM',500,'33','2020-08-21 12:19:10','2020-08-31 05:46:36'),(48,28,'KG',1,'130','2020-08-21 12:33:53','2020-08-31 05:49:29'),(49,28,'GM',500,'75','2020-08-21 12:33:53','2020-08-31 05:49:29'),(51,29,'KG',1,'70','2020-08-21 12:51:46','2020-08-31 05:49:45'),(52,29,'GM',500,'35','2020-08-21 12:51:46','2020-08-31 05:49:45'),(54,30,'KG',1,'75','2020-08-21 12:55:56','2020-08-31 05:50:09'),(55,30,'GM',500,'40','2020-08-21 12:55:56','2020-08-31 05:50:09'),(57,31,'KG',1,'70','2020-08-21 13:00:24','2020-08-31 05:30:56'),(58,31,'GM',500,'35','2020-08-21 13:00:24','2020-08-31 05:30:56'),(60,32,'KG',1,'300','2020-08-21 13:31:14','2020-08-31 06:38:45'),(61,32,'GM',500,'160','2020-08-21 13:31:14','2020-08-31 06:38:45'),(63,33,'KG',1,'220','2020-08-21 13:34:49','2020-08-31 06:38:29'),(64,33,'GM',500,'125','2020-08-21 13:34:49','2020-08-31 06:38:29'),(133,51,'KG',1,'260','2020-08-29 05:52:29','2020-08-31 06:37:14'),(66,34,'KG',1,'80','2020-08-21 13:40:19','2020-08-30 05:53:32'),(67,34,'GM',500,'43','2020-08-21 13:40:19','2020-08-30 05:53:32'),(132,51,'GM',500,'135','2020-08-29 05:52:29','2020-08-31 06:37:14'),(69,35,'KG',1,'220','2020-08-21 13:46:33','2020-08-31 06:38:03'),(70,35,'GM',500,'125','2020-08-21 13:46:33','2020-08-31 06:38:03'),(72,36,'KG',1,'90','2020-08-21 13:55:05','2020-08-30 05:52:05'),(73,36,'GM',500,'47','2020-08-21 13:55:05','2020-08-30 05:52:05'),(131,50,'GM',500,'30','2020-08-29 05:48:56','2020-08-30 05:44:18'),(75,37,'KG',1,'200','2020-08-21 14:06:38','2020-08-31 06:37:50'),(76,37,'GM',500,'110','2020-08-21 14:06:38','2020-08-31 06:37:50'),(78,38,'KG',1,'30','2020-08-21 14:12:52','2020-08-30 05:50:41'),(79,38,'GM',500,'15','2020-08-21 14:12:52','2020-08-30 05:50:41'),(130,50,'KG',1,'50','2020-08-29 05:48:56','2020-08-30 05:44:18'),(81,39,'KG',1,'80','2020-08-21 14:24:46','2020-08-31 06:37:36'),(82,39,'GM',500,'45','2020-08-21 14:24:46','2020-08-31 06:37:36'),(84,40,'KG',1,'72','2020-08-21 14:35:11','2020-08-30 05:49:39'),(85,40,'GM',500,'37','2020-08-21 14:35:11','2020-08-30 05:49:39'),(129,49,'GM',500,'30','2020-08-29 05:45:51','2020-08-29 05:45:51'),(87,41,'GM',500,'20','2020-08-21 14:46:26','2020-08-21 14:56:21'),(88,41,'KG',1,'40','2020-08-21 14:46:26','2020-08-21 14:56:21'),(89,41,'KG',2,'80','2020-08-21 14:46:26','2020-08-21 14:56:21'),(90,42,'KG',1,'90','2020-08-21 14:49:44','2020-08-30 05:49:02'),(91,42,'GM',500,'50','2020-08-21 14:49:44','2020-08-30 05:49:02'),(128,49,'KG',1,'50','2020-08-29 05:45:51','2020-08-29 05:45:51'),(93,43,'KG',1,'60','2020-08-22 06:11:39','2020-08-30 05:48:38'),(94,43,'GM',500,'33','2020-08-22 06:11:39','2020-08-30 05:48:38'),(127,48,'PCS',12,'240','2020-08-29 05:06:36','2020-08-30 05:45:51'),(96,44,'KG',1,'72','2020-08-24 13:06:33','2020-08-30 05:48:07'),(97,44,'GM',500,'40','2020-08-24 13:06:33','2020-08-30 05:48:07'),(126,48,'PCS',6,'120','2020-08-29 05:06:36','2020-08-30 05:45:51'),(99,45,'KG',1,'110','2020-08-24 13:13:49','2020-08-29 05:01:48'),(100,45,'GM',500,'60','2020-08-24 13:13:49','2020-08-29 05:01:48'),(103,3,'KG',3,'50','2020-08-24 13:51:25','2020-08-29 04:29:05'),(125,13,'KG',1,'70','2020-08-29 04:34:24','2020-08-31 05:46:19'),(107,18,'KG',1,'100','2020-08-25 05:42:20','2020-08-25 05:42:20'),(108,18,'KG',2,'200','2020-08-25 05:42:20','2020-08-25 05:42:20'),(109,2,'GM',500,'24','2020-08-25 05:46:12','2020-08-31 09:09:02'),(112,15,'GM',500,'60','2020-08-25 05:50:37','2020-08-29 04:35:30'),(115,11,'KG',2,'240','2020-08-25 06:00:13','2020-08-25 06:00:13'),(116,10,'PCS',6,'30','2020-08-25 06:02:24','2020-08-30 06:00:39'),(124,13,'GM',500,'35','2020-08-29 04:34:24','2020-08-31 05:46:19'),(118,46,'KG',1,'110','2020-08-25 06:07:35','2020-08-30 05:47:09'),(119,46,'GM',500,'60','2020-08-25 06:07:35','2020-08-30 05:47:09'),(121,47,'KG',1,'120','2020-08-25 06:17:16','2020-08-30 05:46:48'),(122,47,'GM',500,'65','2020-08-25 06:17:16','2020-08-30 05:46:48');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deliver_id` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,2,1,3,4,'gugugu','2020-08-19 16:45:40'),(2,5,1,3,3,'good','2020-08-19 17:08:24'),(3,15,20,22,5,'very good\n\n and fast \n','2020-08-31 05:58:59');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`slider_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (1,1,'AbdullaBinKhater_slider1.jpg','2020-06-06 08:17:02'),(2,2,'49017world-hands.png','2020-07-24 19:17:05');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
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
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'','','8690701233',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dThk1K-NSvWL-1e18OzbFF:APA91bHgFYSSQC-KiSN3dyO56UeMIJi4LjPRujMiVdQDppKcUI-HwKc-_GlLNVcP9nQMN0gJhZS7840CGcCQBN7Rhyc6EsXpLDNvXKfL4uCwGpHS1rJGJrsb6Dq7RJjuVQSHgeRadrmV','','',1,1,0,0,'177874',NULL,0,'2020-08-19 16:33:42',NULL),(4,'','','9558686644',NULL,'0000-00-00',NULL,NULL,0,0,'','android','fac1hyHzScKkLJFXA7ufjb:APA91bFhFSigBF5742J1c4foy4ONjcdAvG_KDvt2jNXiSj0QUlTqSYiVa50Ql37vWPNRyjXwBiUi9HJeHkzwtDIOcd2SSLAaocra8C7GYpNto205vFkAs0D_Dxa-HF991RhugU2CgceV','','',1,1,0,0,'178427',NULL,0,'2020-08-19 18:49:16','2020-08-21 16:12:13'),(5,'Vatsal koladiya','vatsalkoladiya55@gmail.com','7567970221',NULL,'2000-07-27',NULL,NULL,0,0,'','android','f_sCXOaQQWKmFTSHhI0K6u:APA91bEBeuu6OHc5RHQ5QQpCyjvKLBRiFzrKByt9fOoREIXo3Z-9xNBuzw4k6aJaJ18WWsJZ6rzNH0L5A-Jkks7bMdCZIjfqDDi1USr5uasUQLipl9j9ybqa2aaJPno1M9oZNE8J6g8-','','',1,1,0,0,'858545',NULL,0,'2020-08-20 12:27:30','2020-08-31 10:32:56'),(6,'','','6356701091',NULL,'0000-00-00',NULL,NULL,0,0,'','android','fsFC6sUNRLeEZ1bm5-7TNh:APA91bFh1obJQLjztOmHW93SsMZWlLJfrpmejnFesxV5O-9dfY5umVvOrH-9Gc2o2fbZyp02joRPDxb45xD67Zq0CNxN8Whk3NpM5_Egp2iunKYk9SsuIcOsY-9mDUN-sZk_XYeyhu8E','','',1,1,0,0,'598953',NULL,0,'2020-08-20 12:28:17','2020-08-25 12:16:38'),(7,'','','9974427488',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dx4WZOzuR4CXRHq64UVDpu:APA91bF76241ie72KBNXUyAioPxaFghQRVBAWY7v1f3ZFO3DgElEkAp7sQUBU0daDiSGVyvfrTcgJE64l8BtGlIFJzebcvhEbquxU8apRfJoR0UJ4hC5KNLNi447lUz4jhvL5FpvOBwg','','',1,1,0,0,'323854',NULL,0,'2020-08-21 12:31:55',NULL),(8,'','','9099383060',NULL,'0000-00-00',NULL,NULL,0,0,'','android','fNufldJZQB6zjKcfpax7OC:APA91bFhqtUyUlH8Mq39_VYzLfXWyqLXce9-TYUAdTsN1iwSXjkqH1hSilcvSvewmsWl_Dviq54ztKxfV00RAN8Xrug6AmJwfITOz_lEdgjaYhEMHjzznNsJpgunVaySEccRfa69PiWD','','',1,1,0,0,'814356',NULL,0,'2020-08-21 16:42:05','2020-08-31 13:40:51'),(9,'','','9081701091',NULL,'0000-00-00',NULL,NULL,0,0,'','android','fHua2XYgRfGdG99EBaCQjG:APA91bH18B0Ifdw0_d33yQ31711iyb_9is6jmkw6xK1Li40ZszXR70lVMbkfDSXidueURANYM5rnPmKAIqeNbjkgyXZQ70LpVItbljGfXrTXGWblZ10IbHJ5yIyhunmPtnuOxHtDkjuM','','',1,1,0,0,'738166',NULL,0,'2020-08-25 13:19:49','2020-08-31 05:44:07'),(10,'','','9429210297',NULL,'0000-00-00',NULL,NULL,0,0,'','android','eKGMlxkMRLGfDU_aAyNEy3:APA91bGHZdSX26hPz-xl4b540JYLayqtCWFBsvQ_2KSNaN6bGptTsMC9ZjiAFJxgcDyRhBw2OTVj02CvBCmPBevwXt2hPyA9CiCnTk6pso7PbdF4sdOSxRJhudKl7-CmPQXhFT2gSswy','','',1,1,0,0,'927936',NULL,0,'2020-08-27 14:08:17','2020-08-29 07:08:22'),(11,'Bhavik','','8238513650',NULL,'1995-10-30',NULL,NULL,0,0,'','android','cDcyximkQ5iOdtMgCMXnM7:APA91bHApZ606OYNYEUJ-dhMEV3KB-l1MdxbMK7T1zmetwsyFc1ljdVk5i74FwFxHFoPfTmYoEKlSJSjmHmMDFvojZzQATPbraYhcTheoFPd97o4RWyy6D9j60ugD1RKatAUq8GFtHaw','','',1,1,0,0,'295180',NULL,0,'2020-08-27 15:14:45','2020-08-27 15:15:38'),(12,'','','9909932474',NULL,'0000-00-00',NULL,NULL,0,0,'','android','ew1ei_sKSZelL-9gTi39iM:APA91bHXqtrwb3r2krI3mA7i4_qeij_g5Rd7g952-Qrx_ZWlw4Si3n6kvaxjsBOtNtNxA0Z5qkC0KuvahQDpRaOv38T-2TogWRdCdSCVtZAEm_Cy6BSfLxxigOhH3sr6EzVdkCJTVU-e','','',1,1,0,0,'617162',NULL,0,'2020-08-27 19:03:43',NULL),(13,'','','9879635509',NULL,'0000-00-00',NULL,NULL,0,0,'','android','faLcYFJRQ3CyoeyvgmECsI:APA91bFLTh-RailsFMsRXusJRl9MLSuILQz5Jp8e8EnM-g1hEkzb3SPXX8mD6QasIoLzGBNhqsLxOQ_GbLASZzR-WIqkxOydxJ9Wmzn4WpVa-tOh0x3ksU0DdiHbnSByf6LSCj5tMRZa','','',1,1,0,0,'942640',NULL,0,'2020-08-28 14:11:55',NULL),(14,'','','8141574556',NULL,'0000-00-00',NULL,NULL,0,0,'','android','f1kTID1-SNWhuGLMA3QxAr:APA91bGYeq7f2NEsQfCGScwFwYBy83JZIDU1jJXlshCiI2bim-jUO1JDETFCe379MXMmCFeZxn9S6n1P3D6-rEmZQx2DFJoAYHx6S2Zh0fG4OwMGRXQpxA-g5t109S2jZVH8uHDJeb3s','','',1,1,0,0,'715867',NULL,0,'2020-08-29 13:09:33',NULL),(15,'','','9375816457',NULL,'0000-00-00',NULL,NULL,0,0,'','android','ftUWDdTQQ9qi1Gnl-ZZFjk:APA91bGSKBFaIxWo6fbsxYKXgPllhLjcM6-UJ3jhs5he93RtH0Lf1vj1T5rWqKE6T9z35yFd8d0dEanrDXd--2iuuQuOdniJzalTn6TdyOKpQfeYvrTcOXwe3Ol1Omlqqc6RdZXgeFN2','','',1,1,0,0,'229922',NULL,0,'2020-08-30 15:49:37',NULL),(16,'','','6352710954',NULL,'0000-00-00',NULL,NULL,0,0,'','android','exgRoTE1Ri6ku2PN9E_oPZ:APA91bFBwx1p2UKRAKWcx66bW8J-BdL9GRslucT-lfCYxayy2btvf6oQLvXe5hD4K736a8hjuBwQ4HmnbNVc5Rd_hC-Vlik6dqn7Wog7Lo5p9xaXgF8wl0k-EMiPpqrBPIsPmOF8cpIW','','',1,1,0,0,'609587',NULL,0,'2020-08-30 16:25:54',NULL),(17,'','','8758749502',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dtxF1T91TNyGODMVpGKj5D:APA91bEGJBx4q-pLGMVZTc3iQzVegnbvfmRBEV0z3_NEN_Xqx9sW3xKM7ZH7BHnZdZ6q1r3eSO6WP4NdKB4tgRVB-PUQWvtxuHVlENdbBzoMRJARoS6G-aBfukdectgpjFxCjCBi5gYB','','',1,1,0,0,'928170',NULL,0,'2020-08-30 16:27:48',NULL),(18,'','','8980022739',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dsXt_EmaTjKziXLQxC0JZT:APA91bGGwspzB3KPxw811IBJzB6PVGsGx1ZibzMjzjLp14syVnk_9vM4XN98IvQyOpxVcbkZIsxy7UkROqogdt5HGnixw0rNQzuQxR5-Luz_7qr9CiX8F_mq73_s0SUmTSnArL3VFX0Q','','',1,1,0,0,'698893',NULL,0,'2020-08-30 17:41:23',NULL),(19,'','','9725914314',NULL,'0000-00-00',NULL,NULL,0,0,'','android','d89xpbfyQQaSh_4zI7gNYH:APA91bEsWCfFAFgS-gNG5laTwTIFNZVzd6IQBTFuquOUkcjJ_Wgsi6RuFNED6kJ3SkvMcM2wyvUcVHq2lVdQQNU6z2e1gYySgZTHmJvoGTRFX6L5mzWWJkZLKDOAYTq6IxwxtsPxwjfr','','',1,1,0,0,'222450',NULL,0,'2020-08-31 02:07:47',NULL),(20,'Vaghani sonal','vaghanisonal409@gmail.com','8000635929',NULL,'1980-09-13',NULL,NULL,0,0,'','android','dIR-ZG0XQvKMjXmrFu7SSi:APA91bH0mDi_1iS9nBa353dR9Y34RxoacA1_dLBCil3NVFyJ34jb4crsGsdkursoTFP_CcwSF0rIiOE3xZQKaSgSX7hS0efJ3BZ4kXw_s8bog3tNYdQuL-bY2vPXp73PS8PhOVPpic0T','','',1,1,1,0,'179279',NULL,0,'2020-08-31 02:31:35','2020-08-31 04:02:03'),(21,'','','8758342103',NULL,'0000-00-00',NULL,NULL,0,0,'','android','d744i3-6S7--z6Gx42zKwz:APA91bGKB0AJ7_xXlijDoYXA8C8mZ-UfPnH1KykjC777u8kyWuvQv9huZtkk2V4gv3YKFUex518Tj35cR_TdiEXamen_HRNpGIfmUbGcnfe91UuEI5fSRBzdA6SCsmKG2qKvriNZCpxj','','',1,1,0,0,'488081',NULL,0,'2020-08-31 03:02:03',NULL),(22,'Bholo','bhaumikkachhadiya1@gmail.com','6354757970',NULL,'2001-01-21','866401IMG_20200831_105207.jpg','546068IMG_20200831_105148.jpg',1,0,'','android','f_sCXOaQQWKmFTSHhI0K6u:APA91bEBeuu6OHc5RHQ5QQpCyjvKLBRiFzrKByt9fOoREIXo3Z-9xNBuzw4k6aJaJ18WWsJZ6rzNH0L5A-Jkks7bMdCZIjfqDDi1USr5uasUQLipl9j9ybqa2aaJPno1M9oZNE8J6g8-','21.2246086','72.8890715',1,0,0,0,NULL,NULL,0,'2020-08-31 05:22:32','2020-08-31 05:41:44'),(23,'','','9727725815',NULL,'0000-00-00',NULL,NULL,0,0,'','android','ebkpWF-ZRtCmBlZY8goygs:APA91bF-z2VRw0tx3nVb3IGRzoY97uYO-lUD1y-0UZS74Qju4-9zepi199nV2g9lvqDujc5EbI09kNCSpxiMsbN7eHEIgC48GzLcsLqZVscX6dKgKIHd-XyPosXG1evpvUl0fKga2js0','','',1,1,0,0,'988558',NULL,0,'2020-08-31 05:33:35',NULL),(24,'','','9265615020',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dyIr9n76SoGwzj4pfFxtfv:APA91bEJEsZmL5hOU9YomHMGYkWb4DAocQ2jBDtpKdM87cyFrgrwndfTI7v1xwyp9jAf0vyk2K4AuMEAu35XSXM70bKWXlxDJip4rDFTQwoEsQF4j6Y4JpkFMNUgmlD0niRI1fmS6Nsl','','',1,1,0,0,'926360',NULL,0,'2020-08-31 06:11:14',NULL),(25,'','','9925072825',NULL,'0000-00-00',NULL,NULL,0,0,'','android','c0fyijelTSCWVpzVOdfQWB:APA91bGctdOLEEHawNF2nxtH6PPd2AnQtdddaBsx301oq8QZZakbsepzMHFlgmPqhVtNj9zjyYwHdTN6sCr2mk3XyS8H166t0nlpviFLaDiHlbfbbQpSBs7rc8Vd4f9Kh4r6QyVLVKLU','','',1,1,0,0,'795608',NULL,0,'2020-08-31 07:08:04',NULL),(26,'','','9925331609',NULL,'0000-00-00',NULL,NULL,0,0,'','android','c6K8J99cQd2avkRLbBhc5n:APA91bEM1pQQhch1m1ovENetQaDdbYIXLkdUi4rlo3LNRh95K9XM1RApKLT4XVTLvHuwdKEmK0oWE_LrqKiJVao67vwRNfkqDpiA_mNAUA0OmraH3BVbWsUlVJI-cWo-k5vx7jpusM3m','','',1,1,0,0,'333128',NULL,0,'2020-08-31 07:26:52',NULL),(27,'','','9687769100',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dkX4__MHQRGL8Zj9b5ptes:APA91bE7BAfyos_C4JNUKhn1usxqma9ikvLH8Fustq0ixWENaCYQ01pFQXA9IKjMPNzWlEhMP4JaeBHuhDY5VQ58jG2b_WAEfDMOJnrLXk4G0aRszybCWorlsQKqwqvrnK2uJRhV10Hm','','',1,1,0,0,'945420',NULL,0,'2020-08-31 08:06:29',NULL),(28,'','','8866621232',NULL,'0000-00-00',NULL,NULL,0,0,'','android','egy02u2dTHSO9gckT0VX-9:APA91bHKlw-Qj21sOk7a24kXUN9LGFKw_HkLSCljw22P5nnue2xCFbYKvcCh_O-L3ETPn-IXjbhs6Z1N-cd57wxrIRL6xgDVnVeuoBolU1yoSQUQ4T52j00ILKp0xBV_1O9HvvviBGtA','','',1,1,0,0,'450968',NULL,0,'2020-08-31 12:11:02',NULL),(29,'','','9825845165',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dITlO_seScOxle7B10Q0_F:APA91bEBAZ7a7rodwloZt3C9kmp34yXeOdqDishDJt9kSegH6vw7wGmenBADGH39ES7UyuEEkvFehV4ekBF0EIyBmOfqs8-7G-v9gpuuYSLXAdxbR91geiiIFXJvynj2-yHwyVPbPeQz','','',1,1,0,0,'335322','179279',0,'2020-08-31 14:21:29',NULL),(30,'','','9586036861',NULL,'0000-00-00',NULL,NULL,0,0,'','android','dNqnaJQ4QYS12K4JcHKywe:APA91bE_IfW4imM9ByPhl__5NmeeVJ3xrAecpenGICT04KfghQxDKfh9aUukjPD3TOBdP8CAANdrfx--AAu1K-kFZfcuP0Ayt7n1ioyfX6JEeszPnGvDIWlwaFFhWdMIrdWUEdEhaJ7L','','',1,1,0,0,'176116',NULL,0,'2020-08-31 16:22:24',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `state` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (2,2,'Chirag Sanghani','8690701233','8690701233','65','Shreenathji society','Near sitanagar society','Lambe hanuman road','Lambe hanuman road','Surat','Gujarat','2020-08-19 16:37:14'),(3,4,'Hardik Chapla','9558686644','9558686644','603','Shivdhara','Maharaja farm','Mota varachha','','Surat','Gujarat','2020-08-19 18:50:15'),(4,5,'Vatsal koladiya','7567970221','','32','Swaminarayan nagar 3','Near kalakunj temple','Nana varachha','Surat','Surat','Gujarat','2020-08-20 12:28:46'),(5,6,'Manoj Patel','6356701091','6356701091','12','Galaxy','Varacha','Varachha','Varachha road','Surat','Gujarat','2020-08-20 13:27:15'),(6,7,'Vipul Ramani','9974427488','9974427488','503','Shiv ','Gadhapur Township','Varachha','','Surta','Gujarat','2020-08-21 12:34:48'),(7,8,' J k ','939','','0693','Gih','Cuvu',' J k','','Vjbk','N k','2020-08-23 06:56:42'),(8,10,'dipak butani','9429210297','8511846600','139','Fast floor','Gokulnagar soc near rachana soc','L.h.road','Kapodra','Surat','Gujarat','2020-08-29 08:24:15'),(9,20,'Vaghani sonal ','8000635929','8000635929','241','Kavita row houses','Varachha road sarthana jakatnaka','Sarthana jakatnaka','Navjeevan hotel','Surat ','Gujarat','2020-08-31 04:07:12'),(10,30,'Chirag','9036812345','','53','Gdy','Dhdhhd','Jddjdj','Jdjdj','Hf','Nnx','2020-08-31 16:23:34');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;

--
-- Dumping routines for database 'u806229794_dev'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-03  6:50:08
