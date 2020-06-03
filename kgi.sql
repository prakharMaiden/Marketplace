-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 03:47 PM
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
(1, 'hello@maidenstride.com', '7042588757', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 0, '2020-05-01 12:45:12', '2020-05-15 13:11:36'),
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
  `credit_card` varchar(20) DEFAULT NULL,
  `credit_card_type_id` varchar(10) DEFAULT NULL,
  `card_exp_mo` varchar(3) DEFAULT NULL,
  `card_ex_yr` varchar(5) DEFAULT NULL,
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

INSERT INTO `customer_detail` (`id`, `customer_id`, `first_name`, `last_name`, `class`, `room`, `building`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `voicemail`, `credit_card`, `credit_card_type_id`, `card_exp_mo`, `card_ex_yr`, `billing_address`, `billing_city`, `billing_region`, `billing_postal_code`, `billing_country`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_postal_code`, `shipping_country`, `created_at`, `updated_at`) VALUES
(1, 1, 'Swati', 'Chaudhary', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-01 12:45:12', '2020-05-01 14:10:51'),
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
  `description` text,
  `quantity_per_unit` varchar(50) DEFAULT NULL,
  `unit_price` varchar(50) DEFAULT NULL,
  `msrp` varchar(100) DEFAULT NULL,
  `available_size` varchar(50) DEFAULT NULL,
  `available_colors` varchar(50) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `unit_weight` varchar(50) DEFAULT NULL,
  `unit_in_stock` varchar(50) DEFAULT NULL,
  `unit_on_order` varchar(50) DEFAULT NULL,
  `reorder_level` varchar(50) DEFAULT NULL,
  `product_available` varchar(50) DEFAULT NULL,
  `discount_available` varchar(50) DEFAULT NULL,
  `current_order` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `size_url` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `customer_id`, `supplier_id`, `sku`, `id_sku`, `vendor_product_id`, `name`, `description`, `quantity_per_unit`, `unit_price`, `msrp`, `available_size`, `available_colors`, `size`, `color`, `discount`, `unit_weight`, `unit_in_stock`, `unit_on_order`, `reorder_level`, `product_available`, `discount_available`, `current_order`, `logo`, `size_url`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 5, 'SKU', '12234', NULL, 'vivo v19', 'vivo v19', '20', '40000', '45000', '', 'blue,black,white', '3', 'blue', '3%', '500g', '50', '23', '32', '22', '2%', '', '200524011210-1.jpg', '56', 1, '2020-05-31 11:18:36', '2020-06-01 13:17:08'),
(2, 1, 1, 0, 5, 'SKU', '12234', NULL, 'vivo v20', 'vivo v20', '20', '40000', '45000', '', 'blue,black,white', '3', 'blue', '10%', '500g', '50', '23', '32', '22', '2%', '', '200524011210-7.jpg', '56', 1, '2020-05-31 11:19:04', '2020-06-01 13:17:23'),
(11, 2, 2, 0, 5, 'SKU', '12234', NULL, 'vivo v21', 'vivo v21', '20', '40000', '45000', '', 'blue,black,white', '3', 'blue', '5%', '500g', '50', '23', '32', '22', '2%', '', '200524011210-9.jpg', '56', 0, '2020-06-03 11:19:04', '2020-06-03 13:46:47'),
(12, 2, 2, 0, 5, '', '', NULL, 'sasa', 'asasas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '200524011210-1.jpg', '', 1, '2020-06-03 11:31:52', '2020-06-03 13:46:42');

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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`, `description`, `picture`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'smartphone', 'smartphone', '200524011210-1.jpg', 1, '2020-05-15 11:12:33', '2020-05-30 13:58:30'),
(2, 1, 'apple', 'apple', '200524011210-7.jpg', 1, '2020-05-15 11:12:49', '2020-06-03 10:58:21');

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
  `notes` text,
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
(5, 1, 'INFINIKEY MEDIA PVT LTD', 'Mayank', 'Chaudhary', 'INFINIKEY MEDIA PVT LTD', 'e10adc3949ba59abbe56e057f20f883e', ' Block M Market', 'Greater Kailash Part 1', 'delhi', 'Delhi', '110048', 'India', '9891494860', '', 'mayanklion1994@gmail.com', '', '', '', '', '', '', '', '', '', 1, '2020-05-26 12:48:12', '2020-05-26 12:48:12');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `stock_management`
--
ALTER TABLE `stock_management`
  ADD CONSTRAINT `stock_management_ibfk_8` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_management_ibfk_9` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
