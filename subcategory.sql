-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 11:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `parent_id` int(100) DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`attributes`))
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
