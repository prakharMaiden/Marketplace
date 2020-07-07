-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2020 at 04:09 PM
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
(1, 'Appliances', 'Appliances', '200524011210-7.jpg', '', 1, 1, '2020-05-15 11:11:51', '2020-07-06 11:31:54');

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
  `shipping_address1` varchar(255) DEFAULT NULL,
  `shipping_address2` varchar(255) DEFAULT NULL,
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

INSERT INTO `customer_detail` (`id`, `customer_id`, `first_name`, `last_name`, `class`, `room`, `building`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `voicemail`, `card_name`, `card_number`, `card_exp`, `card_cvv`, `billing_address`, `billing_city`, `billing_region`, `billing_postal_code`, `billing_country`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_region`, `shipping_postal_code`, `shipping_country`, `created_at`, `updated_at`) VALUES
(1, 1, 'Swati', 'Chaudhary', NULL, '0', NULL, 'Rz-151/345, Gali Number 2, Shiv Puri, Jagdamba Vihar', 'West Sagarpur, Palam', 'New Delhi', 'New Delhi', '110046', 'India', NULL, 'swati', '9891123456786789', '07/20', '123', NULL, NULL, NULL, NULL, NULL, 'Rz-151/345, Gali Number 2, Shiv Puri, Jagdamba Vihar', 'West Sagarpurxgsdfsdf, Palam', 'New Delhi', 'New Delhi', '110046', 'India', '2020-05-01 12:45:12', '2020-07-03 13:28:58'),
(2, 2, 'Mayank', 'Chaudhary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-28 10:41:00', '2020-05-28 10:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `shipment_date` datetime NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `freight` varchar(150) NOT NULL,
  `sales_tax` varchar(150) NOT NULL,
  `transaction_status` enum('Order placed','In-process','Return','Delivered') NOT NULL DEFAULT 'Order placed',
  `err_loc` varchar(255) NOT NULL,
  `err_msg` varchar(255) NOT NULL,
  `fulfilled` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `payment_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `payment_id`, `order_number`, `order_date`, `shipment_date`, `shipper_id`, `freight`, `sales_tax`, `transaction_status`, `err_loc`, `err_msg`, `fulfilled`, `deleted`, `paid`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '171-0418065-5981138', '2020-06-23 03:13:35', '2020-06-29 00:00:00', 1, '', '', 'Delivered', '', '', 1, 0, 1, '2020-06-23 00:00:00', '2020-06-23 13:20:23', '2020-07-02 10:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(10) DEFAULT NULL,
  `quantity` varchar(15) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `total` varchar(10) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `billing_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`, `discount`, `total`, `size`, `color`, `billing_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '30000', '2', '3', '60000', NULL, 'black', '2020-06-23 00:00:00', '2020-06-23 07:56:12', '2020-06-23 07:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `allowed` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `type`, `allowed`, `created_at`, `updated_at`) VALUES
(1, 'Credit & Debit Card', 'yes', '2020-06-23 13:01:30', '2020-06-23 13:01:30'),
(2, 'Net Banking', 'yes', '2020-06-23 13:01:30', '2020-06-23 13:01:30'),
(3, 'Pay on Delivery', 'yes', '2020-06-23 13:02:45', '2020-06-23 13:02:45'),
(4, 'UPI(Pay With Bank Accounts)', 'yes', '2020-06-23 13:02:45', '2020-06-23 13:02:45');

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
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `customer_id`, `supplier_id`, `sku`, `id_sku`, `vendor_product_id`, `name`, `description`, `quantity_per_unit`, `unit_price`, `msrp`, `available_size`, `available_colors`, `size`, `color`, `discount`, `unit_weight`, `unit_in_stock`, `unit_on_order`, `reorder_level`, `product_available`, `discount_available`, `current_order`, `featured_image`, `images`, `size_url`, `active`, `date_view`, `counter`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 0, 5, 'SKU', '12234', NULL, 'Reconnect RH9103 Desert Air Cooler', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif; font-size: 15px;\">Enjoy top-notch cooling experience with the new Reconnect RH9103 Desert Air Cooler. This air cooler is made using high impact resistant ABS engineering plastic which makes it easy to move and install. With a tank capacity of 55-litres, this cooler is suitable for regions with a dry climatic condition and is ideal for cooling medium to large size rooms. This air cooler can be used in homes, offices, restaurants and shops. Thanks to the castor wheels at the bottom of this cooler, it can easily be moved around to clean the space and to relocate from one room to another. The highly efficient honeycomb pads absorb and retain water, thereby delivering optimum cooling. This Reconnect air cooler is embedded with an ice chamber facility that lets you pour ice cubes to boost the cooling experience. This portable cooler delivers cool air at an exceptionally high rate of 1600 Square feet. Its horizontal louvre covers a wide area and provides efficient cooling within minutes. It also features a control knob and offers 3-speed options - high, medium and low. Depending on your preference, manually select the speed and control the humidity and temperature of your space and keep it cool. This air cooler is compatible with inverters and provides cool air without any interruption even during power cuts.</span><br>', '10', '5299', '16999', '', '', '', '', '69', '55 litres', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707121733-dessert cooler.jpg', 'images-200707121733-dessert cooler.jpg,images-200707121733-dessertcooler2.jpg,', '56', 1, '2020-07-07', 3, '2020-05-31 05:48:36', '2020-07-07 12:30:24'),
(2, 1, 8, 0, 5, 'SKU', '12234', NULL, 'Havells Celia I Desert Air Cooler', 'Experience a cool environment at your home, offices, restaurants and shops with the Havells Celia i Desert Air Cooler This portable cooler has a large storage tank that can store water up to 55 litres. This cooler is suitable for humid climatic condition and is ideal for cooling small to medium size rooms. Thanks to the castor wheels at the bottom of this cooler, it can easily be moved around to clean the space and to relocate from one room to another. The three dust filter nets at the sides separate dust from the air ensuring only dust-free air washes through the honeycomb pads. Its three side Honeycomb cooling pads are specially processed with anti-bacterial, anti-erosion, anti-deformation and hydrophilic property, they absorb dust particles and cleanse air thoroughly. It is also embedded with an ice chamber facility that lets you pour ice cubes to boost the cooling experience. This portable cooler delivers cool air at an exceptionally high rate of 116 Cubic meters per hour and, its horizontal collapsible louvre covers a wide area and provides efficient cooling within minutes. When not in use, simply pull the louvres down to prevent dust and insects from entering the air cooler. It features a touch control panel with a digital display and offers 3-speed options - high, medium and low. It even lets you set the timer. Depending on your preference, manually select the speed and control the humidity and temperature of your space and keep it cool. Even in the middle of the night, you can control this cooler effortlessly without getting up from the bed just select the speed, set the timer with its remote and you\'re done. This cooler is integrated with a thermal overload protection technology which protects the fan motor and the pump motor from overheating and damage. The water level indicator in this air cooler, helps you determine the water level in the tank. That’s not all, with this cooler, you do not need to refill the tank frequently as it is integrated with an autofill mechanism when the water level goes below the required level, attach the cooler via a hose and turn it on to refill the tank through the water inlet. This air cooler has a cord winder that helps you to wind the electric cord correctly for hassle-free usage\r\n', '20', '10499', '17770', '', '', '', '', '41', '55 litres', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707014717-desertcooler3.jpg', 'images-200707014717-desertcooler3.jpg,images-200707014717-desertcooler4.jpg,', '56', 1, '2020-07-07', 3, '2020-06-19 05:49:04', '2020-07-07 12:42:03'),
(3, 1, 8, 0, 5, 'SKU', '12234', NULL, 'Kelvinator Nubra KCD-A550 Desert Air Cooler', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif; font-size: 15px;\">The Nubra dessert cooler range is a perfect match for large spaces. Built with the best technology ever seen, it not only provides effective cooling but also flaunts innovative features such as easy-to-remove Honeycomb Pads, Ice Chambers and more!</span><br style=\"font-size: 15px; color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif;\"><br style=\"font-size: 15px; color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif;\"><span style=\"color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif; font-size: 15px;\">The automatic louver ensures smooth airflow thoughtout, Auto Water Level Indicator easily monitors th amount of water in the cooler, and its Castor Wheels makes this device easily portable. It also offers an easy cleaning experience to ensure that the cooler is well maintained.</span>', '20', '8299', '13490', '', '', '', '', '38', '500g', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707023633-dessertcooler.jpg', 'images-200707023633-dessertcooler.jpg,images-200707023633-dessertcooler2.jpg,images-200707023633-dessertcooler3.jpg,', '56', 1, '2020-07-07', 3, '2020-06-18 05:49:04', '2020-07-07 12:42:12'),
(4, 1, 9, 0, 5, 'SKU', '12234', NULL, 'Symphony DiET 35T Portable Air Cooler', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif; font-size: 15px;\">Take a look at the Symphony DiET 35T Portable Air Cooler where advanced intelligence meets advanced electronics. This air cooler is loaded with features that make it a must-have for your home this summer. With a large tank capacity of 35-litres, this cooler is suitable for regions with a dry climatic condition and is ideal for cooling medium to large size rooms. This air cooler can be used in homes, offices, restaurants and shops. Due to its compact structure, this Symphony air cooler occupies minimal space and can easily fit in any corner of the room. Thanks to the castor wheels at the bottom of this cooler, it can easily be moved around to clean the space and to relocate from one room to another. This cooler is integrated with i-Pure technology that helps to prevent various air-pollutants from entering indoors and ensures to deliver clean and healthy air. The mosquito filter in this cooler prevents mosquitos from breeding, while the dust filter filters out large dust particles and ensures only clean air is circulated. The highly efficient honeycomb pad absorbs and retains water to deliver maximum cooling. This air cooler comes with built-in ice chamber that let you include ice cubes for faster cooling. Though this portable cooler consumes low power, it delivers powerful air throw at a high rate of 50 cubic meters per hour and, its auto vertical louvre movement covers a wide area and provides efficient cooling within minutes. The Dura-pump technology in this cooler protects the fan motor and the pump motor from overheating and damage. It also features a control knob that lets you manually select the speed and control the humidity and temperature of your space and keep it cool. The water level indicator in this air cooler helps you determine the water level in the tank so that you refill the tank through the water inlet when required and keep the room cool at all times.</span><br style=\"font-size: 15px; color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif;\">', '10', '6299', '9299', '', '', '', '', '32', '55 litres', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707025226-1.jpg', 'images-200707025226-1.jpg,', '56', 1, '2020-07-07', 3, '2020-05-31 05:48:36', '2020-07-07 12:52:26'),
(5, 1, 9, 0, 5, 'SKU', '12234', NULL, 'Hindware Snowcrest 19 HO Portable Air Cooler', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, system-ui, sans-serif; font-size: 15px;\">Enjoy the chill of cold air even on a hot sunny day with the Hindware Snowcrest 19 HO Portable Air Cooler. With a tank capacity of 19-litres, this cooler is suitable for regions with the humid climatic condition and is ideal for cooling small to medium size rooms. This air cooler can be used in homes, offices, restaurants and shops. Due to its compact structure, the Hindware Snowcrest air cooler occupies minimal space and can easily fit in any corner of the room. Thanks to the castor wheels at the bottom of this cooler, it can easily be moved around to clean the space and to relocate from one room to another. The highly efficient honeycomb pads fixed to the back grills absorbs dust and delivers maximum cooling. It also has anti-deformative and anti-erosive properties which increases the life span of the honeycomb pads. It is also embedded with an ice chamber facility that lets you pour ice cubes to boost the cooling experience. This portable cooler is equipped with a powerful fan and an efficient motor that delivers cool air at a rate of 1450 Cubic meters per hour and, its smartly designed motorized louvre mechanism covers a wide area and provides efficient cooling within minutes. With this cooler, there is no need for you and your family members to take turns and stand in front of this cooler to get some cool air as its powerful four-way air deflection uniformly blows cool air in all directions. It also features a button and dial control panel that offers three fan speed options- high, medium and low, to maintain an optimum comfort level you can manually select the speed and control the humidity and temperature of your space, thereby keeping it cool. The water level indicator in this air cooler helps you determine the water level in the tank so that you refill the tank through the water inlet when required and keep the room cool at all times. This air cooler is compatible with inverters and provides cool air without any interruption even during power cuts.</span>', '20', '4600', '8990', '', '', '3', '', '49', '55 litres', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707025518-1.jpg', 'images-200707025518-1.jpg,images-200707025518-2.jpg,', '56', 1, '2020-07-07', 3, '2020-06-19 05:49:04', '2020-07-07 12:55:41'),
(6, 1, 9, 0, 5, 'SKU', '12234', NULL, 'Symphony Diet 3D 55i+ Portable Air Cooler', 'The Symphony Diet 3D 55i Portable Air Cooler is where advanced intelligence meets advanced electronics. This air cooler is loaded with features that make it a must-have for your home this summer. With a large tank capacity of 55-litres, this cooler is suitable for regions with a dry climatic condition and is ideal for cooling medium to large size rooms. This air cooler can be used in homes, offices, restaurants and shops. Due to its compact structure, this Symphony air cooler occupies minimal space and can easily fit in any corner of the room. Thanks to the castor wheels at the bottom of this cooler, it can easily be moved around to clean the space and to relocate from one room to another. This cooler is integrated with i-Pure technology that helps to prevent various air-pollutants from entering indoors and ensures to deliver clean and healthy air. The three-side highly efficient washable honeycomb pads with PM 2.5 filter, provide superior 3D cooling. This air cooler comes with a built-in ice and water chamber that let you include ice-cold water for faster cooling. Though this portable cooler consumes low power, it delivers powerful air throw at an exceptionally high rate of 60 cubic meters per hour and, its auto vertical louvre movement covers a wide area and provides efficient cooling within minutes. This cooler also features a pop- up digital touch digital control panel with 3-speed control options- high, medium and low. It also has a full function magnetic remote that lets you control the cooler even from a distance. So with this cooler, even in the middle of the night, you can change the speed as well as set a timer without getting up from the bed, just press the buttons on the remote and you\'re done. This remote can stick to any metal body', '20', '10199', '11999', '', '', '', '', '15', '500g', '', '23', '32', 'yes', 'yes', '', 'featured_image-200707025842-1.jpg', 'images-200707025842-1.jpg,images-200707025842-2.jpg,', '56', 1, '2020-07-07', 3, '2020-07-06 05:49:04', '2020-07-07 12:59:43');

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
(1, 1, 1, 'saASSCZXCXCAWDARAWEQWEQE', 4, '2020-06-17 07:55:44', '2020-06-17 07:55:44'),
(2, 1, 1, 'nice product', 5, '2020-06-17 07:57:13', '2020-06-17 07:57:13'),
(3, 1, 1, 'sadsdasdas', 3, '2020-06-17 08:17:14', '2020-06-17 08:17:14'),
(4, 1, 3, 'SDasdasdasd', 4, '2020-06-18 06:24:29', '2020-06-18 06:24:29'),
(5, 1, 3, 'sdasdsadczczxczxawdaewqwezcxczxcqwedqwed', 1, '2020-06-18 06:24:58', '2020-06-18 06:24:58'),
(6, 1, 3, 'czxczxczxc', 2, '2020-06-18 06:25:50', '2020-06-18 06:25:50'),
(7, 1, 3, 'zxczxczxc', 5, '2020-06-18 06:28:26', '2020-06-18 06:28:26');

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

--
-- Dumping data for table `stock_management`
--

INSERT INTO `stock_management` (`id`, `supplier_id`, `product_id`, `quantity`, `price_per_product`, `total_price`, `total_discount`, `date_in_stock`, `active`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '500', '100000000', '1200000000', '12', '2020-06-25 00:00:00', 1, '2020-06-22 08:11:31', '2020-06-22 08:11:31');

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
(3, 1, 'Heating & Cooling', 'Heating and cooling attributes', '', 1, '2020-06-17 11:20:22', '2020-07-06 11:13:46', NULL, ''),
(4, 1, 'Air Coolers', 'Air coolers for house applications', '', 1, '2020-06-17 11:22:15', '2020-07-06 13:32:45', 3, ''),
(5, 1, 'Fans', 'Fans for house apllication', '', 1, '2020-06-17 11:23:29', '2020-07-06 13:32:45', 3, ''),
(6, 1, 'Room Heaters', 'Room Heaters home application', '', 1, '2020-06-17 11:25:23', '2020-07-06 13:32:45', 3, ''),
(7, 1, 'Water Heaters & Geysers', 'Water Heaters & Geysers home application', '', 1, '2020-06-17 11:27:38', '2020-07-06 13:32:45', 3, ''),
(8, 1, 'Desert', 'Desert for Air coolers', '', 1, '2020-06-17 11:32:25', '2020-07-06 13:32:45', 4, '[   {     \"Volume_Capacity_Name\": \"\",     \"Model_Number\": \"\",     \"Size_Map\": \"\",     \"Material\": \"\",     \"Product_ID\": \"\",     \"Product_Name\": \"\"   } ]'),
(9, 1, 'Portable', 'Portable air coolers', '', 1, '2020-06-17 11:39:50', '2020-07-06 13:32:45', 4, '[   {     \"Volume_Capacity_Name\": \"\",     \"Model_Number\": \"\",     \"Size_Map\": \"\",     \"Material\": \"\",     \"Product_ID\": \"\",     \"Product_Name\": \"\",     \"newfield\": \"\"   } ]'),
(10, 1, 'Air Purifiers', 'Air Purifiers', '', 1, '2020-07-06 12:24:10', '2020-07-06 13:32:45', 3, ''),
(11, 1, 'Parts & Accessories', 'Parts & Accessories', '', 1, '2020-07-06 12:24:10', '2020-07-06 13:32:45', 3, ''),
(12, 1, 'Tower', 'Tower', '', 1, '2020-07-06 12:25:21', '2020-07-06 13:32:45', 4, ''),
(13, 1, 'Other Air Coolers', 'Other Air Coolers', '', 1, '2020-07-06 12:25:21', '2020-07-06 13:32:45', 4, '');

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
(1, 1, 2, '2020-06-28 11:45:28', '2020-06-28 11:45:28');

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
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
