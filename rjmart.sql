-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 05:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rjmart`
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
(1, 'RJ Mart', 'rjmart', 'admin@gmail.com', '177656753723avatar2.png', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', 30, '2020-06-11 07:00:00', '2022-05-26 10:06:36');

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
(1, 1, 2, 2, 109, '2022-05-25 08:01:00', '2022-05-25 08:01:52'),
(4, 2, 2, 2, 109, '2022-05-26 09:46:49', NULL);

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
(1, 'vegetables.jpg', 'Vegetables (શાકભાજી)', 1, '2020-06-05 13:16:16', '2022-05-25 07:54:06'),
(2, 'fruits.jpg', 'Fruits', 1, '2020-06-05 12:15:15', NULL),
(3, '976030Ayurvedic-herb-herb-turmeric-indian-spices-1296x728-header-1296x728.jpg', 'Herbs and Seasonings(ઔષધો અને સીઝનિંગ્સ)', 0, '2020-08-02 19:51:48', '2022-05-25 07:55:24'),
(4, '2505600-38.png', 'Exotic Fruits & Vegetables', 0, '2020-08-02 19:54:12', '2022-05-25 07:55:17');

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
(1, 1, NULL, NULL, 'Delivery boy register', 'New delivery boy register successfully', 'new_register', 1, 0, '2022-05-23 10:12:45'),
(2, 2, NULL, NULL, 'User register', 'New user register successfully', 'new_regiter', 1, 0, '2022-05-23 10:37:58'),
(3, 2, NULL, 1, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-25 08:02:00'),
(10, 1, NULL, 1, 'Cancel Order', 'Order cancelled successfully', 'order_cancelled', 1, 0, '2022-05-25 10:47:42'),
(11, 2, NULL, 2, 'New Order', 'New order created successfully', 'new_order', 1, 0, '2022-05-25 11:03:17'),
(12, NULL, 2, 2, 'Order Cancelled', 'Order cancelled successfully', 'cancel_order', 0, 0, '2022-05-25 16:34:38');

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
(1, 1, 2, 109, 1, '2022-05-25 13:32:00'),
(2, 2, 2, 109, 1, '2022-05-25 16:33:17');

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
(1, 2, 1, 1, '', '', NULL, 0, '2022-05-25 08:02:00', NULL),
(2, 2, 2, 1, '', '', NULL, 0, '2022-05-25 11:03:17', NULL);

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
(3, 395006, 1, '2022-05-26 15:31:06', '2022-05-26 15:40:27'),
(4, 395009, 1, '2022-05-26 15:40:35', NULL);

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
(1, 'ORDER2022052501320062', 2, 1, '24', 'cash', 3, 0, '2022-05-26 13:32:00', 0, 0, NULL, 'This is testing', 0, '2022-05-25 10:28:00', NULL),
(2, 'ORDER2022052504331723', 2, 1, '24', 'cash', 3, 1, '2022-05-26 16:33:17', 0, 0, NULL, 'This is testing', 1, '2022-05-25 11:03:17', NULL);

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
(122, 47, 'GM', 500, '65', '2020-08-25 06:17:16', '2020-08-30 05:46:48');

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
(6, 4, '44909293653download.jpg', 0, 0, '2022-05-06 17:25:26');

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
(1, 'Johny Deep', '', '9090909090', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', '', '', 1, 0, '', 'ios', '123456', '12.362541', '13.236514', 0, 1, 0, 0, NULL, NULL, 0, NULL, '2022-05-23 10:12:45', NULL),
(2, 'Johny Deep', '', '9090909091', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0000-00-00', NULL, NULL, 0, 0, '', 'ios', '123456', '12.362541', '13.236514', 1, 1, 0, 0, '735191', NULL, 0, NULL, '2022-05-23 10:37:58', NULL);

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
  `state` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `full_name`, `mobile_number`, `alt_mobile_number`, `house_no`, `building_name`, `road_area_colony`, `main_area`, `landmark`, `city`, `state`, `created`) VALUES
(1, 2, 'KIshan Patel', '9632587445', '78787979745', '101', 'Saurashtra Residensy', 'Near Maharaja Farm', 'Mota Varachha', 'Mota Varachha', 'surat', 'gujrat', '2022-05-25 08:01:26');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `near_by_request`
--
ALTER TABLE `near_by_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
