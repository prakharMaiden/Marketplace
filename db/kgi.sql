-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 06:24 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kgi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `picture` varchar(100) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `child` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `picture`, `icon`, `child`, `active`, `created_at`, `updated_at`) VALUES
(1, 'mobile', 'mobile', '200524011210-7.jpg', 'icon-phone', 1, 1, '2020-05-15 11:11:51', '2020-05-30 13:32:29'),
(2, 'Laptops', 'Laptops', '200524011210-9.jpg', 'icon-desktop', 0, 1, '2020-05-28 13:11:56', '2020-05-30 13:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `mobile_verified` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `mobile`, `password`, `email_verification_code`, `email_verified`, `mobile_verified`, `active`, `created_at`, `updated_at`) VALUES
(1, 'hello@maidenstride.com', '7042588757', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 1, '2020-05-01 12:45:12', '2020-06-09 10:56:31'),
(2, 'mayanklion1994@gmail.com', '9891494860', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 0, 1, '2020-05-28 10:40:59', '2020-05-28 10:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `building` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `postal_code` varchar(7) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `voicemail` varchar(15) DEFAULT NULL,
  `card_name` varchar(50) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_exp` varchar(10) DEFAULT NULL,
  `card_cvv` varchar(10) DEFAULT NULL,
  `billing_address` varchar(100) DEFAULT NULL,
  `billing_city` varchar(10) DEFAULT NULL,
  `billing_region` varchar(10) DEFAULT NULL,
  `billing_postal_code` varchar(7) DEFAULT NULL,
  `billing_country` varchar(10) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(10) DEFAULT NULL,
  `shipping_region` varchar(10) DEFAULT NULL,
  `shipping_postal_code` varchar(7) DEFAULT NULL,
  `shipping_country` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`id`, `customer_id`, `first_name`, `last_name`, `class`, `room`, `building`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `voicemail`, `card_name`, `card_number`, `card_exp`, `card_cvv`, `billing_address`, `billing_city`, `billing_region`, `billing_postal_code`, `billing_country`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_postal_code`, `shipping_country`, `created_at`, `updated_at`) VALUES
(1, 1, 'Swati', 'Chaudhary', NULL, '0', NULL, 'Rz-151/345, Gali Number 2, Shiv Puri, Jagdamba Vihar', 'West Sagarpur, Palam', 'New Delhi', 'New Delhi', '110046', 'India', NULL, 'swatii', '9891234533456789', '12/33', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-01 12:45:12', '2020-06-19 15:39:46'),
(2, 2, 'Mayank', 'Chaudhary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-28 10:41:00', '2020-05-28 10:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_number` varchar(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `shipment_date` datetime NOT NULL,
  `required_date` datetime NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `freight` varchar(15) NOT NULL,
  `sales_tax` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_status` varchar(10) NOT NULL,
  `err_loc` varchar(255) NOT NULL,
  `err_msg` varchar(255) NOT NULL,
  `fulfilled` varchar(10) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `paid` varchar(4) NOT NULL,
  `payment_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_number` varchar(50) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `quantity` varchar(15) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `total` varchar(10) DEFAULT NULL,
  `id_sku` varchar(10) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `billing_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `allowed` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `sku` varchar(10) DEFAULT NULL,
  `id_sku` varchar(10) DEFAULT NULL,
  `vendor_product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `quantity_per_unit` varchar(50) DEFAULT NULL,
  `unit_price` varchar(50) DEFAULT NULL,
  `msrp` varchar(50) DEFAULT NULL,
  `available_size` varchar(50) DEFAULT NULL,
  `available_colors` varchar(255) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `unit_weight` varchar(50) DEFAULT NULL,
  `unit_in_stock` varchar(50) DEFAULT NULL,
  `unit_on_order` varchar(50) DEFAULT NULL,
  `reorder_level` varchar(50) DEFAULT NULL,
  `product_available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `discount_available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `current_order` varchar(100) DEFAULT NULL,
  `featured_image` varchar(256) DEFAULT NULL,
  `images` varchar(256) DEFAULT NULL,
  `size_url` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `customer_id`, `supplier_id`, `sku`, `id_sku`, `vendor_product_id`, `name`, `description`, `quantity_per_unit`, `unit_price`, `msrp`, `available_size`, `available_colors`, `size`, `color`, `discount`, `unit_weight`, `unit_in_stock`, `unit_on_order`, `reorder_level`, `product_available`, `discount_available`, `current_order`, `featured_image`, `images`, `size_url`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 5, 'SKU', '12234', NULL, 'vivo v19', 'vivo v19  <ul>\r\n                                        <li> Unrestrained and portable active stereo speaker</li>\r\n                                        <li> Free from the confines of wires and chords</li>\r\n                                        <li> 20 hours of portable capabilities</li>\r\n                                        <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>\r\n                                        <li> 3/4? Dome Tweeters: 2X and 4? Woofer: 1X</li>\r\n                                    </ul>', '20', '34000', '45000', 'Small,Medium,Large,Extra Large', 'blue,black,white', 'Medium', '#795959', '3', '500g', '50', '23', '32', 'no', 'yes', '', 'featured_image-200524011210-7.jpg', 'images-200524011210-1.jpg,images-200524011210-7.jpg', '56', 1, '2020-05-31 11:18:36', '2020-06-17 12:46:54'),
(2, 1, 1, 0, 5, 'SKU', '12234', NULL, 'vivo v20', 'vivo v20', '20', '40000', '45000', '', 'blue,black,white', '3', '#ddd', NULL, '500g', '50', '23', '32', 'yes', 'no', '', 'featured_image-200524011210-7.jpg', '', '56', 1, '2020-06-19 11:19:04', '2020-06-18 12:10:39'),
(3, 2, 2, 0, 5, 'SKU', '12234', NULL, 'vivo v21', 'vivo v21', '20', '40000', '45000', '', 'blue,black,white', '3', '#Ff0', '5', '500g', '50', '23', '32', 'yes', 'yes', '', 'featured_image-200524011210-9.jpg', '', '56', 1, '2020-06-18 11:19:04', '2020-06-18 12:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review` longtext,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `product_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'saASSCZXCXCAWDARAWEQWEQE', 4, '2020-06-17 13:25:44', '2020-06-17 13:25:44'),
(2, 1, 1, 'nice product', 5, '2020-06-17 13:27:13', '2020-06-17 13:27:13'),
(3, 1, 1, 'sadsdasdas', 3, '2020-06-17 13:47:14', '2020-06-17 13:47:14'),
(4, 1, 3, 'SDasdasdasd', 4, '2020-06-18 11:54:29', '2020-06-18 11:54:29'),
(5, 1, 3, 'sdasdsadczczxczxawdaewqwezcxczxcqwedqwed', 1, '2020-06-18 11:54:58', '2020-06-18 11:54:58'),
(6, 1, 3, 'czxczxczxc', 2, '2020-06-18 11:55:50', '2020-06-18 11:55:50'),
(7, 1, 3, 'zxczxczxc', 5, '2020-06-18 11:58:26', '2020-06-18 11:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `id` int(11) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_management`
--

CREATE TABLE `stock_management` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `price_per_product` varchar(10) NOT NULL,
  `total_price` varchar(10) NOT NULL,
  `total_discount` varchar(10) NOT NULL,
  `date_in_stock` datetime NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `parent_id` int(100) DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`, `description`, `picture`, `active`, `created_at`, `updated_at`, `parent_id`, `attributes`) VALUES
(1, 1, 'smartphone', 'smartphone', '200524011210-1.jpg', 1, '2020-05-15 11:12:33', '2020-06-17 12:16:46', NULL, '[   {     \"_id\": \"5eea0434cf74d689c0186a51\",     \"index\": 0,     \"guid\": \"90d7bc60-c7db-40fa-9ff3-03e24eeaec2b\",     \"isActive\": true,     \"balance\": \"$3,916.79\",     \"picture\": \"http://placehold.it/32x32\",     \"age\": 36,     \"eyeColor\": \"blue\",     \"name\": \"Kaufman Ortega\",     \"gender\": \"male\",     \"company\": \"COMTREK\",     \"email\": \"kaufmanortega@comtrek.com\",     \"phone\": \"+1 (937) 447-2474\",     \"address\": \"834 Scholes Street, Spokane, Georgia, 6172\",     \"about\": \"Aute voluptate duis commodo id dolore mollit. Non consectetur id non do sit magna aute laborum nulla laboris occaecat veniam veniam et. Pariatur in amet velit proident incididunt tempor minim laborum nulla esse fugiat.\\r\\n\",     \"registered\": \"2018-10-29T05:57:09 -06:-30\",     \"latitude\": 18.178146,     \"longitude\": 6.368368,     \"tags\": [       \"ut\",       \"nostrud\",       \"pariatur\",       \"et\",       \"consequat\",       \"nisi\",       \"aliqua\"     ],     \"friends\": [       {         \"id\": 0,         \"name\": \"Shelia Woodard\"       },       {         \"id\": 1,         \"name\": \"Marcella Turner\"       },       {         \"id\": 2,         \"name\": \"Morin Benson\"       }     ],     \"greeting\": \"Hello, Kaufman Ortega! You have 2 unread messages.\",     \"favoriteFruit\": \"banana\"   },   {     \"_id\": \"5eea04340497c5ee26c11dae\",     \"index\": 1,     \"guid\": \"d04e3c61-95c1-4dc2-95e0-487dbf5aa5b7\",     \"isActive\": false,     \"balance\": \"$2,182.12\",     \"picture\": \"http://placehold.it/32x32\",     \"age\": 35,     \"eyeColor\": \"brown\",     \"name\": \"Lyons Macias\",     \"gender\": \"male\",     \"company\": \"RODEMCO\",     \"email\": \"lyonsmacias@rodemco.com\",     \"phone\": \"+1 (907) 459-2009\",     \"address\": \"280 Richardson Street, Blende, North Dakota, 4238\",     \"about\": \"Eu elit nulla officia voluptate do pariatur elit ea consequat eiusmod. In ex incididunt amet do aliqua sit magna aliquip aliqua esse veniam culpa labore. Tempor quis officia dolore commodo enim in anim. Fugiat irure in ad ea consectetur enim deserunt reprehenderit Lorem.\\r\\n\",     \"registered\": \"2015-04-23T08:58:29 -06:-30\",     \"latitude\": 26.430041,     \"longitude\": 55.3011,     \"tags\": [       \"occaecat\",       \"irure\",       \"anim\",       \"irure\",       \"exercitation\",       \"ipsum\",       \"labore\"     ],     \"friends\": [       {         \"id\": 0,         \"name\": \"Addie Sosa\"       },       {         \"id\": 1,         \"name\": \"Webster Howard\"       },       {         \"id\": 2,         \"name\": \"Laurie Delaney\"       }     ],     \"greeting\": \"Hello, Lyons Macias! You have 1 unread messages.\",     \"favoriteFruit\": \"strawberry\"   },   {     \"_id\": \"5eea0434a86313ea3c6f9887\",     \"index\": 2,     \"guid\": \"40814c2b-1587-41ab-90ed-06c30f894ff6\",     \"isActive\": false,     \"balance\": \"$2,513.59\",     \"picture\": \"http://placehold.it/32x32\",     \"age\": 25,     \"eyeColor\": \"blue\",     \"name\": \"Joann Austin\",     \"gender\": \"female\",     \"company\": \"POLARIA\",     \"email\": \"joannaustin@polaria.com\",     \"phone\": \"+1 (980) 584-2958\",     \"address\": \"855 Schenck Avenue, Hemlock, Ohio, 4865\",     \"about\": \"Velit magna do eiusmod dolor ipsum labore eiusmod reprehenderit proident aliqua aliqua esse. Nisi voluptate consequat pariatur commodo enim enim commodo cupidatat Lorem. Laborum consectetur amet non proident sint veniam excepteur enim adipisicing. Dolor commodo sint id pariatur fugiat esse laboris qui reprehenderit. Mollit excepteur qui cupidatat elit duis amet mollit. Duis minim ut excepteur magna enim sint. Ullamco qui ad fugiat id laborum ex nisi laborum eu velit laborum.\\r\\n\",     \"registered\": \"2014-11-15T08:45:59 -06:-30\",     \"latitude\": -82.6166,     \"longitude\": 70.90838,     \"tags\": [       \"aute\",       \"exercitation\",       \"exercitation\",       \"esse\",       \"sint\",       \"nostrud\",       \"exercitation\"     ],     \"friends\": [       {         \"id\": 0,         \"name\": \"Curry Nichols\"       },       {         \"id\": 1,         \"name\": \"Mccray Pearson\"       },       {         \"id\": 2,         \"name\": \"Twila Cain\"       }     ],     \"greeting\": \"Hello, Joann Austin! You have 5 unread messages.\",     \"favoriteFruit\": \"apple\"   },   {     \"_id\": \"5eea04349a29049cb2b36a51\",     \"index\": 3,     \"guid\": \"faa1bf87-8f06-45c0-8c89-6f171cffd15a\",     \"isActive\": false,     \"balance\": \"$3,226.32\",     \"picture\": \"http://placehold.it/32x32\",     \"age\": 24,     \"eyeColor\": \"blue\",     \"name\": \"Maricela Mayer\",     \"gender\": \"female\",     \"company\": \"BOLAX\",     \"email\": \"maricelamayer@bolax.com\",     \"phone\": \"+1 (861) 539-3294\",     \"address\": \"735 Bedford Avenue, Shasta, Idaho, 5686\",     \"about\": \"Consectetur labore ipsum pariatur cillum non voluptate quis adipisicing officia consectetur labore. Sint commodo eiusmod est amet quis esse ea cupidatat culpa laboris adipisicing ipsum aliqua elit. Ipsum qui anim ex laboris. Cillum qui nisi eiusmod Lorem anim eiusmod consectetur nostrud. Cillum labore laborum amet do duis consectetur duis elit officia mollit duis reprehenderit nostrud nisi.\\r\\n\",     \"registered\": \"2019-07-24T12:46:52 -06:-30\",     \"latitude\": 7.490715,     \"longitude\": 95.213653,     \"tags\": [       \"laboris\",       \"veniam\",       \"cupidatat\",       \"qui\",       \"veniam\",       \"reprehenderit\",       \"duis\"     ],     \"friends\": [       {         \"id\": 0,         \"name\": \"Elvira Blevins\"       },       {         \"id\": 1,         \"name\": \"Haley Hoffman\"       },       {         \"id\": 2,         \"name\": \"Fletcher Farmer\"       }     ],     \"greeting\": \"Hello, Maricela Mayer! You have 10 unread messages.\",     \"favoriteFruit\": \"strawberry\"   },   {     \"_id\": \"5eea04348c43ec01594b9bfd\",     \"index\": 4,     \"guid\": \"157a2a51-d5e4-47f0-8d4b-3fa7f709b4d7\",     \"isActive\": true,     \"balance\": \"$3,727.69\",     \"picture\": \"http://placehold.it/32x32\",     \"age\": 29,     \"eyeColor\": \"brown\",     \"name\": \"Lillian Gilmore\",     \"gender\": \"female\",     \"company\": \"QABOOS\",     \"email\": \"lilliangilmore@qaboos.com\",     \"phone\": \"+1 (977) 517-3941\",     \"address\": \"887 Vermont Court, Axis, Oregon, 6589\",     \"about\": \"Tempor sint fugiat nulla aliquip ut labore ullamco ad tempor consequat nostrud aute laborum sit. Commodo nisi magna ullamco sint laboris nostrud duis cupidatat ut pariatur id. Consectetur pariatur est culpa excepteur veniam laborum dolor sunt nulla cillum veniam reprehenderit cillum.\\r\\n\",     \"registered\": \"2019-05-25T04:06:54 -06:-30\",     \"latitude\": -73.322264,     \"longitude\": -177.323285,     \"tags\": [       \"aliqua\",       \"aliqua\",       \"velit\",       \"qui\",       \"mollit\",       \"ullamco\",       \"est\"     ],     \"friends\": [       {         \"id\": 0,         \"name\": \"Nola Nicholson\"       },       {         \"id\": 1,         \"name\": \"Marshall Hyde\"       },       {         \"id\": 2,         \"name\": \"Julianne Mccarty\"       }     ],     \"greeting\": \"Hello, Lillian Gilmore! You have 3 unread messages.\",     \"favoriteFruit\": \"apple\"   } ]'),
(2, 1, 'apple', 'apple', '200524011210-7.jpg', 1, '2020-05-15 11:12:49', '2020-06-03 10:58:21', NULL, ''),
(3, 3, 'Heating & Cooling', 'Heating and cooling attributes', '', 1, '2020-06-17 11:20:22', '2020-06-17 11:21:05', NULL, ''),
(4, 3, 'Air Coolers', 'Air coolers for house applications', '', 1, '2020-06-17 11:22:15', '2020-06-17 11:22:15', 3, ''),
(5, 3, 'Fans', 'Fans for house apllication', '', 1, '2020-06-17 11:23:29', '2020-06-17 11:23:29', 3, ''),
(6, 3, 'Room Heaters', 'Room Heaters home application', '', 1, '2020-06-17 11:25:23', '2020-06-17 11:25:23', 3, ''),
(7, 3, 'Water Heaters & Geysers', 'Water Heaters & Geysers home application', '', 1, '2020-06-17 11:27:38', '2020-06-17 11:27:38', 3, ''),
(8, 3, 'Desert', 'Desert for Air coolers', '', 1, '2020-06-17 11:32:25', '2020-06-17 12:41:11', 4, '[   {     \"Volume_Capacity_Name\": \"\",     \"Model_Number\": \"\",     \"Size_Map\": \"\",     \"Material\": \"\",     \"Product_ID\": \"\",     \"Product_Name\": \"\"   } ]'),
(9, 3, 'Portable', 'Portable air coolers', '', 1, '2020-06-17 11:39:50', '2020-06-17 13:04:48', 4, '[   {     \"Volume_Capacity_Name\": \"\",     \"Model_Number\": \"\",     \"Size_Map\": \"\",     \"Material\": \"\",     \"Product_ID\": \"\",     \"Product_Name\": \"\",     \"newfield\": \"\"   } ]');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_fname` varchar(50) DEFAULT NULL,
  `contact_lname` varchar(50) DEFAULT NULL,
  `contact_title` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address1` text,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `postal_code` varchar(7) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `payment_methods` varchar(100) DEFAULT NULL,
  `discount_type` varchar(100) DEFAULT NULL,
  `type_goods` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `discount_available` varchar(50) DEFAULT NULL,
  `current_order` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `size_url` varchar(100) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `customer_id`, `company_name`, `contact_fname`, `contact_lname`, `contact_title`, `password`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `phone`, `fax`, `email`, `url`, `payment_methods`, `discount_type`, `type_goods`, `notes`, `discount_available`, `current_order`, `logo`, `size_url`, `active`, `created_at`, `updated_at`) VALUES
(5, 1, 'Infinkey Media Pvt Ltd', 'Mayank', 'Chaudhary', 'Infinkey Media Pvt Ltd', 'e10adc3949ba59abbe56e057f20f883e', ' Block M Market', 'Greater Kailash Part 1', 'delhi', 'Delhi', '110048', 'India', '9891494860', '', 'mayanklion1994@gmail.com', '', '', '', '', 'Infinkey Media Pvt Ltd, New York’s no.1 online retailer was established in May 2012 with the aim and vision to become the one-stop shop for retail in New York with implementation of best practices both online', '', '', '', '', 1, '2020-06-17 14:09:51', '2020-06-17 14:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(5, 1, 1, '2020-06-14 13:22:10', '2020-06-14 13:22:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `shipper_id` (`shipper_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_management`
--
ALTER TABLE `stock_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_management`
--
ALTER TABLE `stock_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD CONSTRAINT `customer_detail_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`shipper_id`) REFERENCES `shipper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_10` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_11` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_12` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_management`
--
ALTER TABLE `stock_management`
  ADD CONSTRAINT `stock_management_ibfk_8` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_management_ibfk_9` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
