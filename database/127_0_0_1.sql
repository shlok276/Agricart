-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 05:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agricart`
--
CREATE DATABASE IF NOT EXISTS `agricart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agricart`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `contact_no`) VALUES
(29, 'admin@admin.com', '$2y$10$U/bvSZB1P9zBYgrouy1mWei3FlpBqaW8EoZvz/uLpsA431AW4DaeW', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_details`
--

CREATE TABLE `buyer_details` (
  `Buyer_id` int(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `full_name` char(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` int(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `address` varchar(200) NOT NULL,
  `pin_code` int(7) NOT NULL,
  `state` varchar(255) NOT NULL,
  `otp` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_details`
--

INSERT INTO `buyer_details` (`Buyer_id`, `photo`, `full_name`, `email`, `contact_no`, `password`, `created_on`, `address`, `pin_code`, `state`, `otp`) VALUES
(17, 'image.jpg', 'shlok patel', 'shlok@gmail.com', 2147483647, '$2y$10$aGvqss9lICuR4O2KHOSUs.VSZQLFbHLArGKDxvGZnIrFFKqW2yBBa', '2024-02-17 18:07:55', '50,Sachin Park Society Jodhpur Gam Road Satellite Ahmedabad', 380015, 'Gujarat', 0),
(20, 'manthan.jpg', 'manthan', 'manthan@gmail.com', 2147483647, '$2y$10$prmmWGp1tAqKwy7hxyPQoOmeLx0BH2FSC1ShADrQEWmMZj5dTm93G', '2024-03-01 04:21:26', '', 0, '', 0),
(21, 'punya.jpg', 'punya', 'punya@gmail.com', 784563218, '$2y$10$aGvqss9lICuR4O2KHOSUs.VSZQLFbHLArGKDxvGZnIrFFKqW2yBBa', '2024-03-01 04:39:57', 'sachin park', 380015, 'Karnataka', 0),
(22, 'vraj.png', 'vraj', 'vraj@gmail.com', 2147483647, '$2y$10$NX3y0r9gxWcC6IXLaMR65OoplBdLLuqq.1lcfKRZzroUY0Abgm0zS', '2024-03-01 04:40:20', '', 0, '', 0),
(23, 'shreyansh.jpg', 'raj', 'raj@gmail.com', 2147483647, '$2y$10$b/VNiQ4Dyzmk0vvoRSHkz.MqEdt7PuCafGkbtBBcEKIUs9xYYB1uG', '2024-03-01 04:40:40', '', 0, '', 0),
(24, 'nand.png', 'nand', 'nand@gmaIL.com', 898007388, '$2y$10$5CqR0bNnqlzZ/4FyMkX4kuOb83xygFUQMwiCbYk/gCix346UArR0y', '2024-03-01 04:41:30', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(255) NOT NULL,
  `product_id` int(10) NOT NULL,
  `buyer_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `product_id`, `buyer_id`, `quantity`) VALUES
(191, 57, 0, 1),
(194, 72, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `contact_id` int(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` bigint(20) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`contact_id`, `buyer_name`, `email`, `message`, `status`, `created_on`) VALUES
(1, 'shlok', 'shlok@gmail.com', 'In HTML, the <p> tag defines a paragraph. A paragraph is a distinct section of text with spacing before and after. \r\nThe closing <p> tag is optional and is implied by the opening tag of the next HTML element. Browsers automatically add a single blank line', 0, '2024-02-16 09:10:14'),
(2, 'raj', '', 'jhkjsdskdhjasdkjsahdjbsakjdkjasdasjdsdjashdiasydshazxs', 1, '2024-02-16 09:10:14'),
(9, 'punya', 's', 'sss', 1, '2024-02-16 09:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_details`
--

CREATE TABLE `coupon_details` (
  `coupon_id` int(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_percentage` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_details`
--

INSERT INTO `coupon_details` (`coupon_id`, `coupon_code`, `discount_percentage`) VALUES
(1, 'shlok', 10),
(2, 'aaa', 20);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(8, 'shlokpatel.502@gmail.com'),
(9, 'sasas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(255) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `buyer_id` int(50) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `payment` int(50) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` int(10) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `tracking_no`, `order_no`, `product_id`, `buyer_id`, `seller_id`, `payment`, `price`, `quantity`, `status`, `order_date`) VALUES
(66, '11111111', '2733949706', '27', 17, 11, 0, 799, 11, 1, '2023-11-12 17:09:40'),
(67, '353453432', '8144956717', '29', 17, 11, 0, 1299, 3, 1, '2023-11-13 17:26:45'),
(74, '', '4730060100', '34', 17, 11, 0, 799, 1, 0, '2023-11-14 18:06:31'),
(75, '3957285828', '5069363713', '38', 20, 11, 0, 2999, 11, 1, '2023-11-21 04:38:22'),
(76, '', '5069363713', '44', 20, 22, 0, 899, 9, 0, '2023-11-22 04:38:22'),
(77, '', '1894386848', '53', 20, 23, 0, 299, 1, 0, '2023-11-27 04:39:00'),
(79, '3857265738', '5061796026', '28', 21, 11, 0, 399, 1, 1, '2023-12-13 04:54:19'),
(80, '3692760284', '2940702671', '28', 21, 11, 0, 399, 1, 1, '2023-12-15 04:58:19'),
(81, '', '3277234757', '42', 21, 22, 0, 799, 1, 0, '2023-12-23 07:17:56'),
(82, '3628427415', '3277234757', '30', 21, 11, 0, 399, 1, 1, '2023-12-25 07:17:56'),
(83, '', '3277234757', '50', 21, 22, 0, 599, 1, 0, '2023-12-26 07:17:56'),
(84, '', '3277234757', '60', 21, 23, 0, 859, 20, 0, '2024-01-16 07:17:56'),
(85, '', '3277234757', '65', 21, 24, 0, 12999, 15, 0, '2024-01-17 07:17:56'),
(86, '', '3277234757', '58', 21, 23, 0, 499, 30, 0, '2024-01-24 07:17:56'),
(87, '', '7879849061', '58', 17, 23, 0, 499, 20, 0, '2024-01-25 09:26:32'),
(88, '4365286426', '8467593020', '39', 17, 11, 0, 2599, 11, 1, '2024-01-29 07:14:32'),
(89, '', '8467593020', '60', 17, 23, 0, 859, 1, 0, '2024-01-30 07:14:32'),
(90, '', '8467593020', '37', 17, 11, 0, 499, 4, 0, '2024-03-02 07:14:32'),
(91, '', '8467593020', '72', 17, 24, 0, 950, 1, 0, '2024-03-02 07:14:32'),
(92, '', '8467593020', '62', 17, 24, 0, 189, 1, 0, '2024-03-02 07:14:32'),
(93, '', '3959526947', '66', 17, 24, 0, 189, 1, 0, '2024-03-02 07:27:19'),
(94, '', '7771404239', '69', 17, 24, 0, 999, 1, 0, '2024-03-02 07:45:54'),
(95, '', '4775544921', '56', 17, 23, 0, 499, 1, 0, '2024-03-02 08:10:05'),
(96, '', '6596209740', '59', 17, 23, 0, 599, 1, 0, '2024-03-02 09:31:38'),
(97, '', '6596209740', '73', 17, 24, 0, 2899, 1, 0, '2024-03-02 09:31:38'),
(98, '', '1683931026', '42', 17, 22, 0, 799, 4, 0, '2024-03-02 10:15:08'),
(99, '', '1683931026', '72', 17, 24, 0, 950, 1, 0, '2024-03-02 10:15:08'),
(100, '9473628564', '1683931026', '28', 17, 11, 0, 399, 25, 1, '2024-03-02 10:15:08'),
(101, '8980072477', '5950698875', '33', 17, 11, 0, 599, 6, 1, '2024-03-04 16:20:17'),
(102, '', '3098334556', '58', 17, 23, 0, 499, 1, 0, '2024-05-05 07:44:44'),
(103, '', '8887587470', '66', 17, 24, 0, 189, 1, 0, '2024-05-05 08:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_id` int(10) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mrp` int(255) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `seller_id`, `name`, `description`, `mrp`, `price`, `quantity`, `photo`, `photo2`, `photo3`) VALUES
(27, 11, 'Panga', 'Made up of stainless steal and the handle is made up of kashmir wood. ', 850, 799, 19, 'panga.jpg', 'panga2.jpg', 'panga3.jpeg.jpg'),
(28, 11, 'Water Pipe', 'Pacakage Contains: Unbreakable PVC Plain Green Super Braided Water Hose Pipe With Water Tap Adapter & 2 Clamps.\r\nSize : 1/2 inch( 0.50 Inch) , Length : 10 mete', 430, 399, 3, 'rubber_pipe.webp', 'rubber_pipe2.webp', 'rubber_pipe3.jpg'),
(29, 11, 'Pick Mattock', 'Very convenient when digging hard ground. It can be used for various purposes. For caring for flower beds and farmwork. For harvesting carrots and onions, and for rooting small trees. From archaeological excavation to cracking ice. Easy to use, making it ', 1380, 1299, 0, 'pick_mattock.jpg', 'pick_mattock2.jpg', 'pick_mattock3.jpg'),
(30, 11, 'AGNI Plus | Pesticides', 'Pesticides are chemical substances designed to control or eliminate pests such as insects, weeds, fungi, rodents, and other organisms that interfere with agricultural production, public health, or comfort. These compounds play a crucial role in modern agr', 430, 399, 98, 'pesticides.jpg', 'pesticides.jpg', 'pesticides.jpg'),
(31, 11, 'IPL TRIN | Pesticides', 'Pesticides are chemical substances designed to control or eliminate pests such as insects, weeds, fungi, rodents, and other organisms that interfere with agricultural production, public health, or comfort. These compounds play a crucial role in modern agr', 740, 699, 88, 'pesticides2.jpeg.jpg', 'pesticides2.jpeg.jpg', 'pesticides2.jpeg.jpg'),
(32, 11, 'IPL Warrior | Pesticides', 'Pesticides are chemical substances designed to control or eliminate pests such as insects, weeds, fungi, rodents, and other organisms that interfere with agricultural production, public health, or comfort. These compounds play a crucial role in modern agr', 635, 599, 119, 'pesticides3.jpg', 'pesticides3.jpg', 'pesticides3.jpg'),
(33, 11, 'Digging Fork', 'Versatile gardening tool combining the functionality of a fork and a shovel.\r\nForked blades for effective soil penetration, loosening, and aeration.\r\nEfficient for digging planting holes, transplanting small plants, and moving soil or compost.\r\nSuitable f', 630, 599, 23, 'spade_forkp.jpg', 'spade_forkp2.jpg', 'spade_forkp3.jpg'),
(34, 11, 'Spade', 'Heavy Duty Gardening Spade\r\nStrong Wooden Handle\r\nMade for rough use and long lasting', 840, 799, 0, 'spade.webp', 'spade2.webp', 'spade3.webp'),
(35, 11, 'Sprayer', 'Built-Up Quality: The Turbo 2-in-1 sprayer machine for agriculture is built with heavy-duty plastic that can withstand any season and harsh climatic conditions. Product maintenance is very important\r\nMultiple Nozzles: The agriculture machine comes with 5 ', 3535, 3499, 40, 'sprayer.jpg', 'sprayer2.jpg', 'sprayer3.webp'),
(37, 11, 'Fast Action | Weed Killer', 'kill all the weeds which are harmfull for the plants', 520, 499, 16, 'weed killer.jpg', 'weed killer.jpg', 'weed killer.jpg'),
(38, 11, 'MAHADHAN | fertilizer', 'Fertilizer is a vital component in modern agriculture, designed to enhance soil fertility and promote plant growth, ultimately maximizing crop yields. These formulations typically consist of essential nutrients crucial for plant development, such as nitro', 3037, 2999, 97, 'fertilizer_2.jpg', 'fertilizer_2.jpg', 'fertilizer_2.jpg'),
(39, 11, 'Girnar | fertilizer', 'Fertilizer is a vital component in modern agriculture, designed to enhance soil fertility and promote plant growth, ultimately maximizing crop yields. These formulations typically consist of essential nutrients crucial for plant development, such as nitro', 2658, 2599, 39, 'fertilizer_3.jpg', 'fertilizer_3.jpg', 'fertilizer_3.jpg'),
(40, 11, 'BJUP | fertilizer', 'Fertilizer is a vital component in modern agriculture, designed to enhance soil fertility and promote plant growth, ultimately maximizing crop yields. These formulations typically consist of essential nutrients crucial for plant development, such as nitro', 3010, 2999, 0, 'fertilizer.jpg', 'fertilizer.jpg', 'fertilizer.jpg'),
(42, 22, 'Pesticide | SUNPHATE', 'Safe for People and Pets When Used as DirectedCreates a Natural Peppermint Barrier for MiceHigh-Grade, US-Farmed Peppermint from the Pacific NorthwestNatural Ingredients Proven Effective in the Real World', 899, 799, 45, 'download (1).jpeg', 'download (1).jpeg', 'download (1).jpeg'),
(43, 22, 'Pesticide | ALACHLOR', 'Safe for People and Pets When Used as DirectedCreates a Natural Peppermint Barrier for MiceHigh-Grade, US-Farmed Peppermint from the Pacific NorthwestNatural Ingredients Proven Effective in the Real World', 699, 659, 70, 'download (3).jpeg', 'download (3).jpeg', 'download (3).jpeg'),
(44, 22, 'Pesticide | ATRAZINE', 'Safe for People and Pets When Used as DirectedCreates a Natural Peppermint Barrier for MiceHigh-Grade, US-Farmed Peppermint from the Pacific NorthwestNatural Ingredients Proven Effective in the Real World', 999, 899, 79, 'download (6).jpeg', 'download (6).jpeg', 'download (6).jpeg'),
(45, 22, 'Pesticide | ATRAZINE', 'Safe for People and Pets When Used as DirectedCreates a Natural Peppermint Barrier for MiceHigh-Grade, US-Farmed Peppermint from the Pacific NorthwestNatural Ingredients Proven Effective in the Real World', 799, 699, 40, 'download (8).jpeg', 'download (8).jpeg', 'download (8).jpeg'),
(46, 22, 'Pesticide | AGERUO', 'Safe for People and Pets When Used as DirectedCreates a Natural Peppermint Barrier for MiceHigh-Grade, US-Farmed Peppermint from the Pacific NorthwestNatural Ingredients Proven Effective in the Real World', 1299, 1199, 0, 'download (9).jpeg', 'download (9).jpeg', 'download (9).jpeg'),
(47, 22, 'Pesticide | MARKER', 'Safe for People and Pets When Used as Directed\r\nCreates a Natural Peppermint Barrier for Mice\r\nHigh-Grade, US-Farmed Peppermint from the Pacific Northwest\r\nNatural Ingredients Proven Effective in the Real World', 399, 299, 100, 'p.png', 'pesticide1.webp', 'pesticide3.webp'),
(48, 22, 'fertilizer | GREEN', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 1299, 1199, 80, 'fertilizer1.jpg', 'fertilizer1.jpg', 'fertilizer1.jpg'),
(49, 22, 'fertilizer | NAFED', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 999, 899, 100, 'fertilizer3.jpeg', 'fertilizer3.jpeg', 'fertilizer3.jpeg'),
(50, 22, 'fertilizer | GREEN', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 699, 599, 199, 'fertilizer4.jpeg', 'fertilizer4.jpeg', 'fertilizer4.jpeg'),
(51, 22, 'fertilizer | ISO', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 2999, 2599, 0, 'fertilizer5.webp', 'fertilizer5.webp', 'fertilizer5.webp'),
(52, 23, 'fertilizer | PROM+', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 3999, 3599, 70, 'fertilizer6.webp', 'fertilizer6.webp', 'fertilizer6.webp'),
(53, 23, 'weed killer | FARM GENERAL', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 399, 299, 199, 'weed1.jpg', 'weed1.jpg', 'weed1.jpg'),
(54, 23, 'weed killer | EARTS', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 299, 259, 200, 'weed2.jpeg', 'weed2.jpeg', 'weed2.jpeg'),
(55, 23, 'Green & Weed Killer | HOME FRONT', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 899, 799, 150, 'weed3.jpeg', 'weed3.jpeg', 'weed3.jpeg'),
(56, 23, 'Weed & Green Killer | SPECTRACIDE', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 599, 499, 179, 'weed4.jpeg', 'weed4.jpeg', 'weed4.jpeg'),
(57, 23, 'Green & Weed Killer | ELIMINATOR', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 999, 899, 190, 'weed5.jpeg', 'weed5.jpeg', 'weed5.jpeg'),
(58, 23, 'weed killer | IMAGE', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 599, 499, 116, 'weed6.jpeg', 'weed6.jpeg', 'weed6.jpeg'),
(59, 23, 'Weed & Green Killer ', 'Kills weeds and grasses: use on driveways and walkways, and around fences, trees, flower beds, shrubs and other areas in your yard\r\nKills the root: visible results as fast as 3 hours. Replant new flowers, trees and shrubs the same weekend\r\nRAINFAST: rainf', 699, 599, 139, 'weed7.jpeg', 'weed7.jpeg', 'weed7.jpeg'),
(60, 23, 'fertilizer | VERMI COMPOST', 'Nutrient-Rich: TrustBasket Vermicompost for plants is a nutrient-packed enhancer for your soil. Enriched with essential minerals, vitamins, and beneficial microorganisms, it provides the perfect nourishment for your plants to flourish.\r\nEco-Friendly: Unli', 899, 859, 108, 'h.jpg', 'h1.jpg', 'h.jpg'),
(61, 24, 'BKR ® Power Tiller Inter-Cultivator with 4 Stroke ', 'Durable 7HP engine: The BKR Power Tiller Inter-Cultivator is equipped with a robust 7.0 HP engine, providing reliable power and performance for various tilling tasks.Eco-friendly operation: The low-emission fuel engine ensures environmentally friendly o', 44999, 39999, 16, 'bb.jpg', 'bb1.jpg', 'bb2.jpg'),
(62, 24, 'FALCON FCH-301 Hand Cultivator Single Prong Hand H', 'DURABLE CONSTRUCTION: The hand cultivator single prong is built to last with top-notch quality materials. It features a strong and sturdy single prong made from durable steel or stainless steel. This ensures that the cultivator can withstand the rigors of', 299, 189, 49, 'fch.jpg', 'fch1.jpg', 'fch2.jpg'),
(63, 24, 'VIS 1000R Power Weeder/Tiller for Farming Weeder w', 'These Tillers are best for Agriculture & Gardening Purposes, which Start with Recoil Starter\r\nThe power weeder is a new generation soil preparing machine suitable for all kinds of farms for the purpose of deweeding, ploughing and ridge forming with unique', 40000, 38999, 22, 'a - Copy.jpg', 'a1 - Copy.jpg', 'a2 - Copy.jpg'),
(64, 24, ' Grass Soil Mixing Cultivator Tool', 'VERSATILE FUNCTIONALITY: The hand soil tiller with a weeding blade combines the benefits of both a tiller and a weeding tool, providing users with a versatile gardening tool in one compact device.\r\nEFFICIENT SOIL PREPARATION: The tiller feature of this to', 1200, 1199, 50, 'sm.jpg', 'sm1.jpg', 'sm2.jpg'),
(65, 24, 'Neptune', 'HAND PUSH BRUSH CUTTER - NEPTUNE SIMPLIFY FARMING HAND PUSH BRUSH CUTTER is the unique product which lets you cut the grass of your lawn without getting fatigued. The two wheels move seamlessly on the ground and save a great amount of time and effort.\r\n2 ', 14000, 12999, 29, 'cutter.jpg', 'cutter1.jpg', 'cutter2.jpg'),
(66, 24, 'FALCON FW-500', 'EFFICIENT WEED REMOVAL: The Hand Weeder is a specialized tool designed to efficiently remove weeds from your garden or lawn. Its unique design allows you to dig deep into the soil and extract weeds, including their roots, ensuring effective weed control.\r', 200, 189, 18, 'ss.jpg', 'ss1.jpg', 'ss2.jpg'),
(67, 24, 'FALCON FPHD-1906 Post Hole Digger', 'VERSATILE DIGGING: A post-hole digger is a powerful tool designed to efficiently dig holes in the ground. It can be used for various applications, such as installing fence posts, deck supports, or planting trees, making it a versatile choice for both resi', 2500, 2399, 80, 'f1.jpg', 'f2.jpg', 'f3.jpg'),
(68, 24, 'FRP Telescopic Pole 7to 22 Ft', 'FIBRE GLASS Telescopic pole\r\nLIGHT WEIGHT\r\nSHOCK PROOF\r\nTERMITE PROOF\r\nEASY TO HANDLE AND TRANSPORT', 2700, 2599, 90, 'fp.jpg', 'fp1.jpg', 'fp2.jpg'),
(69, 24, 'tata agrico Round Shovel with Wooden Handle', 'Ideal for agriculture purposes and construction sites.', 1300, 999, 99, 'shovel.jpg', 'shovel1.jpg', 'shovel2.jpg'),
(70, 24, 'Pruning Saw', 'JCT TATA Wooden Handle Pruning Saw, Traditional Handsaw Light Weight for Gardening and Agriculture Purpose (Small Size 30 cm), Hand powered\r\nUseful for agriculture, professionals and for camping', 350, 299, 130, 'pruning.jpg', 'pruning1.jpg', 'pruning2.jpg'),
(71, 24, 'Klassic Post Hole Hand Auger', 'Hand Augers are used to carry out a range of shallow digging necessary in obtaining soil samples, making postholes, drilling fishing holes in ice, environmental construction, mining, opening clogged drains and locating underground materials that may poten', 350, 310, 180, 'hole.jpg', 'hole1.jpg', 'hole2.jpg'),
(72, 24, 'WOLF-Garten 7223000 Bypass Anvil Secateur', 'Its best used on younger growth as it provides a very clean cut, essential for maintaining a healthy plant or shrub\r\nSuitable for both left and right handed users with Single-handed locking device\r\nIdeal for delicate and precise pruning\r\nThese light weigh', 1000, 950, 118, 'wolftool.jpg', 'wolftool1.jpg', 'wolftool2.jpg'),
(73, 24, 'ALL IN ONE KIT', 'Material: The khurpi is made of Export-quality stainless steel. The tools are made of iron and are black powder coated for corrosion and rust protection.\r\nContents: The tool box contains one pc each- Hand Cultivator, Hand Fork, Big Hand Trowel, Small Hand', 3000, 2899, 99, 'i2.jpg', 'i.jpg', '5 items2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seller_details`
--

CREATE TABLE `seller_details` (
  `seller_id` int(20) NOT NULL,
  `first_name` char(50) NOT NULL,
  `last_name` char(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_no` int(15) NOT NULL,
  `government_id` varchar(100) NOT NULL,
  `gst_no` int(100) NOT NULL,
  `status` int(3) NOT NULL,
  `created_on` datetime NOT NULL,
  `otp` int(7) NOT NULL,
  `verify` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller_details`
--

INSERT INTO `seller_details` (`seller_id`, `first_name`, `last_name`, `photo`, `email`, `password`, `contact_no`, `government_id`, `gst_no`, `status`, `created_on`, `otp`, `verify`) VALUES
(11, 'shlok', 'patel', 'image.jpg', 'shlok@gmail.com', '$2y$10$zQ5wzL3wEB3cmwAMUY32WO1tQnPg9jbdmnwbySGYA7nC772m2cQvm', 1, 'adminrevenue.jpeg', 0, 0, '2024-05-22 12:10:18', 0, 1),
(15, 'manthan', 'patel', 'manthan.jpg', 'manthan@gmail.com', '$2y$10$nRvF3vpF7tV8x9BSZsH5q.QXiIgZ2Mgsn1ob1EgEKJd.OvVjJf7R6', 111, 'adminrevenue.jpeg', 1212, 1, '2024-05-01 12:10:26', 1, 1),
(20, 'shreyansh', 'patel', 'shreyansh.jpg', 'shreyansh@gmail.com', '$2y$10$ihIMwgyLXiLqv5wyTtP9ge4kjZLnFftAaOfMRuh7thRSKbi7FrKLi', 1111, 'image.jpg', 2223, 1, '2024-02-28 08:14:17', 0, 1),
(23, 'nand', 'patel', 'nand.png', 'nand@gmail.com', '$2y$10$TZfuewyflhim0sJ6jYTYCuBBMIATMeZAXLpK0I5yJbkBuisNcGOw.', 123456789, 'nand.png', 123456789, 1, '2024-02-29 05:17:26', 0, 0),
(24, 'punya', 'patel', 'punya.jpg', 'punya@gmail.com', '$2y$10$SlGepU0ADu1Vzo/Zdm6wBewk3CJXAlHcbENIS0u63Ps.PTeNFbmSu', 696969, 'punya.jpg', 12345678, 0, '2024-02-29 05:46:19', 0, 1),
(25, 'vraj', 'patel', 'vraj.png', 'vraj@gmail.com', '$2y$10$rQ8uRvvY0WpPkU1JiUzRk.XXTMDrZ3SvPEx3jzssZjb0gc3JGilou', 2147483647, 'aadhar.jpg', 0, 0, '2024-03-01 05:45:11', 0, 0),
(26, '', '', '', 'shlokpatel.502@gmail.com', '$2y$10$cAaYYva6MJP4Rxq2TOHfou1jqqPCYVCzSPOmOrMYWK2KqLRHBangO', 11111, '', 0, 0, '2024-05-05 17:00:43', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE `shop_details` (
  `shop_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`shop_id`, `seller_id`, `name`, `address`, `city`, `email`, `contact_no`, `time`, `contact_person`, `location`, `photo`) VALUES
(10, 24, 'Agro Infomart', '1104, 11th Floor, Capstone Building, Opp. Chirag Motors, nr. Parimal Garden, Gujarat 380006', 'Gujarat', 'Gujarat', 2147483647, 'Monday-Friday 9:00AM To 8:00PM', '9645876123', 'https://maps.app.goo.gl/ULzx26PUc3czLVgm6', '65e018e3417a6_shop1.jpeg'),
(11, 24, 'SHREE BHAVANI NURSERY AND FARM', ' Oppo. Arose foods, Nr. Sandesh bunglow, b/h Mumatpura gam, Karnavati Club Rd, Ahmedabad, Gujarat 380054', ' Ahmedabad', ' Ahmedabad', 2147483647, 'Monday-Saturday 10:00AM To 9:00PM', '5623152369', 'https://maps.app.goo.gl/9b5DWwNKYdk6MSTR7', '65e019f92eb7e_shop2.jpeg'),
(12, 24, 'Sheetal Nursery', 'Makarba Rd, opposite Kripal Heritage, near Police Headquarters, Makarba, Ahmedabad, Gujarat 380051', 'Ahmedabad', 'Ahmedabad', 2147483647, 'Monday-Saturday 10:00AM To 10:00PM', '8596412356', 'https://maps.app.goo.gl/Vd5rAabuD5VLL6n48', '65e01a01a3b19_shop3.jpeg'),
(13, 24, 'Rocks N Woods Nursery & Pots', '2F5M+CJJ, Mumatpura Rd, Mumatpura, Ahmedabad, Gujarat 380054', 'Ahmedabad', 'Ahmedabad', 2147483647, 'Monday-Friday 9:00AM To 6:00PM', '6523145879', 'https://maps.app.goo.gl/n6b3qE17sS5w7todA', '65e01a0c22ef3_shop4.jpeg'),
(14, 22, 'Pragati seeds & Agro chemicals', '2HR8+PWW, Income Tax, Navjeevan Press Rd, Sattar Taluka Society, Usmanpura, Ahmedabad, Gujarat 380014', 'Ahmedabad', 'Ahmedabad', 2147483647, 'Monday-Friday 11:00AM To 9:30PM', '5231245789', 'https://maps.app.goo.gl/fnM9f6DStd3Qt74s8', '65e01c409c503_shop5.jpg'),
(15, 22, 'AMBICA AGRO', '404,Sankalp complex, Sardar Gunj Road, beside Indo Africa Marriage Hall, Anand, Gujarat 388001', 'Anand,Gujarat', 'Anand,Gujarat', 2147483647, 'Monday-Saturday 8:30AM To 9:30PM', '9856412356', 'https://maps.app.goo.gl/isMHBDe7kRpzhU77A', '65e01c965cee5_shop6.jpeg'),
(16, 22, 'Yug Shakti Seeds', 'Life Style, B-1 Gf 18 Anta, Ajwa Rd, near Kashi Da Party Plot, Vadodara, Gujarat 390019', 'Vadodara, Gujarat', 'Vadodara, Gujarat', 2147483647, 'Monday-Saturday 10:30AM To 10:30PM', '9325678913', 'https://maps.app.goo.gl/GggACEB5BQXXWK5F7', '65e01c5cdce42_shop7.jpeg'),
(17, 22, 'Shree Khodiyar Garden Tools', 'Shop No 30 & 31 Silicon Valley, Satellite, Ahmedabad - 380015 (Beside India Sports Near Shivranjini Cross Road)', 'Satellite, Ahmedabad', 'Satellite, Ahmedabad', 2147483647, 'Monday-Friday 11:30AM To 10:30PM', '5231659875', 'https://maps.app.goo.gl/6z8ASawdBCm2oGEu9', '65e01c645b076_shop8.jpg'),
(18, 23, 'Agriown Farmtech Pvt Ltd', 'F Block, 8 No, 3rd Floor, 4D Square Mall, Opp Engineering School, Motera, Ahmedabad - 380005', ' Motera, Ahmedabad', ' Motera, Ahmedabad', 2147483647, 'Monday-Friday 9:45AM To 8:00PM', '3265987456', 'https://maps.app.goo.gl/Qn2cKYTEvaidBW6H6', '65e01eb219aad_shop9.jpeg'),
(19, 23, 'Arbuda Agrochemicals Pvt Ltd', 'Shop No:-LL-22, Sattadhar Complex, C P Nagar Road, Ghatlodiya, Ahmedabad - 380061 (Near CP Pan Parlour,)', 'Ghatlodiya, Ahmedabad ', 'Ghatlodiya, Ahmedabad ', 2147483647, 'Monday-Friday 10:30AM To 9:35PM', '9856123789', 'https://maps.app.goo.gl/eoT98s4geNhPk5qz9', '65e01eb96cae3_shop10.jpeg'),
(20, 23, 'Greenman Garden Agro Center', 'B/2-1, Mayurpark Society, Gate No.2, Near Swamivivekanand chowk, opposite Yash Arian Memnagar, Memnagar, Ahmedabad, Gujarat 380052', 'Memnagar, Ahmedabad,', 'Memnagar, Ahmedabad,', 2147483647, 'Monday-Saturday 12:30AM To 11:30PM', '9623156896', 'https://maps.app.goo.gl/xzr5PoWLGjdtwmCH9', '65e01ec09ccb5_shop11.jpeg'),
(21, 23, 'The Green Garden', '146, Suyog Complex, New CG Rd, below SAKAR ENGLISH SCHOOL, Nigam Nagar, Chandkheda, Ahmedabad, Gujarat 382424', 'Chandkheda, Ahmedabad', 'Chandkheda, Ahmedabad', 2147483647, 'Monday-Friday 12:00AM To 8:00PM', '9653265987', 'https://maps.app.goo.gl/Apy5UjzmJPKbS8Sz6', '65e01ec7572d4_shop12.jpeg'),
(22, 11, 'swaroop agrochemical industries', ' Plot no. -B/9, Vasupujaya Industrial Estate, 2nd Floor, Gala No.:, 212, New Link Rd, Laxmi Nagar, Goregaon, Mumbai, Maharashtra 400064', ' Mumbai, Maharashtra', ' Laxmi Nagar, Goregaon, Mumbai, Maharashtra', 2147483647, 'Monday-Saturday 12:00AM To 5:00PM', '9652316598', 'https://maps.app.goo.gl/B8JnmazJsjiPa5P48', '65e020e7df198_shop13.jpeg'),
(23, 11, 'patel agro centre palanpur', 'Gurunanak Chowk, Chaman Bagh, Palanpur, Gujarat 385001', ' Palanpur, Gujarat', ' Palanpur, Gujarat', 2147483647, 'Monday-Saturday 12:30AM To 3:30PM', '6326598563', 'https://maps.app.goo.gl/ya6wPpg9bcyjb8Eg7', '65e020ee9cd2c_shop14.jpeg'),
(24, 11, 'Utkarsh Agrochem Private Limited', 'Shop number 177, GOLDEN PLAZA COMPLEX, NH No 48, Kamrej Rd, Kamrej, Gujarat 394185', ' Kamrej, Gujarat', ' Kamrej, Gujarat', 2147483647, 'Monday-Friday 8:30AM To 5:30PM', '9856321569', 'https://maps.app.goo.gl/mofMisFmA1Hr7Z3S9', '65e020f5b07a9_shop15.jpeg'),
(25, 11, 'Apna Seeds & Pesticides', 'Shop No. 16 & 17, Sardar Patel Vegetable Market, Jamalpur, Ahmedabad, Gujarat 380022', ' Ahmedabad, Gujarat ', ' Ahmedabad, Gujarat ', 2147483647, 'Monday-Friday 11:00AM To 2:00PM', '9653157563', 'https://maps.app.goo.gl/KAUbkGaY8uyg3Yv16', '65e020fb218a9_shop16.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(10) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `feedback` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `buyer_details`
--
ALTER TABLE `buyer_details`
  ADD PRIMARY KEY (`Buyer_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `coupon_details`
--
ALTER TABLE `coupon_details`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `seller_details`
--
ALTER TABLE `seller_details`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `buyer_details`
--
ALTER TABLE `buyer_details`
  MODIFY `Buyer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `coupon_details`
--
ALTER TABLE `coupon_details`
  MODIFY `coupon_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `seller_details`
--
ALTER TABLE `seller_details`
  MODIFY `seller_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `shop_details`
--
ALTER TABLE `shop_details`
  MODIFY `shop_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Database: `ecomm`
--
CREATE DATABASE IF NOT EXISTS `ecomm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecomm`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(9, 9, 2, 1),
(10, 9, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Laptops', 'laptops'),
(2, 'Desktop PC', 'desktop-pc'),
(3, 'Tablets', 'tablets'),
(4, 'Smart Phones', '');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 3),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `counter`) VALUES
(1, 1, 'DELL Inspiron 15 7000 15.6', '<p>15-inch laptop ideal for gamers. Featuring the latest Intel&reg; processors for superior gaming performance, and life-like NVIDIA&reg; GeForce&reg; graphics and an advanced thermal cooling design.</p>\r\n', 'dell-inspiron-15-7000-15-6', 899, 'dell-inspiron-15-7000-15-6.jpg', '2018-07-09', 2),
(2, 1, 'MICROSOFT Surface Pro 4 & Typecover - 128 GB', '<p>Surface Pro 4 powers through everything you need to do, while being lighter than ever before</p>\r\n\r\n<p>The 12.3 PixelSense screen has extremely high contrast and low glare so you can work through the day without straining your eyes</p>\r\n\r\n<p>keyboard is not included and needed to be purchased separately</p>\r\n\r\n<p>Features an Intel Core i5 6th Gen (Skylake) Core,Wireless: 802.11ac Wi-Fi wireless networking; IEEE 802.11a/b/g/n compatible Bluetooth 4.0 wireless technology</p>\r\n\r\n<p>Ships in Consumer packaging.</p>\r\n', 'microsoft-surface-pro-4-typecover-128-gb', 799, 'microsoft-surface-pro-4-typecover-128-gb.jpg', '2023-09-20', 2),
(3, 1, 'DELL Inspiron 15 5000 15.6', '<p>Dell&#39;s 15.6-inch, midrange notebook is a bland, chunky block. It has long been the case that the Inspiron lineup lacks any sort of aesthetic muse, and the Inspiron 15 5000 follows this trend. It&#39;s a plastic, silver slab bearing Dell&#39;s logo in a mirror sheen.</p>\r\n\r\n<p>Lifting the lid reveals the 15.6-inch, 1080p screen surrounded by an almost offensively thick bezel and a plastic deck with a faux brushed-metal look. There&#39;s a fingerprint reader on the power button, and the keyboard is a black collection of island-style keys.</p>\r\n', 'dell-inspiron-15-5000-15-6', 599, 'dell-inspiron-15-5000-15-6.jpg', '2023-09-20', 4),
(4, 1, 'LENOVO Ideapad 320s-14IKB 14\" Laptop - Grey', '<p>- Made for portability with a slim, lightweight chassis design&nbsp;<br />\r\n<br />\r\n- Powerful processing helps you create and produce on the go&nbsp;<br />\r\n<br />\r\n- Full HD screen ensures crisp visuals for movies, web pages, photos and more&nbsp;<br />\r\n<br />\r\n- Enjoy warm, sparkling sound courtesy of two Harman speakers and Dolby Audio&nbsp;<br />\r\n<br />\r\n- Fast data transfer and high-quality video connection with USB-C and HDMI ports&nbsp;<br />\r\n<br />\r\nThe Lenovo&nbsp;<strong>IdeaPad 320s-14IKB 14&quot; Laptop</strong>&nbsp;is part of our Achieve range, which has the latest tech to help you develop your ideas and work at your best. It&#39;s great for editing complex documents, business use, editing photos, and anything else you do throughout the day.</p>\r\n', 'lenovo-ideapad-320s-14ikb-14-laptop-grey', 399, 'lenovo-ideapad-320s-14ikb-14-laptop-grey.jpg', '2024-01-04', 1),
(5, 3, 'APPLE 9.7\" iPad - 32 GB, Gold', '<p>9.7 inch Retina Display, 2048 x 1536 Resolution, Wide Color and True Tone Display</p>\r\n\r\n<p>Apple iOS 9, A9X chip with 64bit architecture, M9 coprocessor</p>\r\n\r\n<p>12 MP iSight Camera, True Tone Flash, Panorama (up to 63MP), Four-Speaker Audio</p>\r\n\r\n<p>Up to 10 Hours of Battery Life</p>\r\n\r\n<p>iPad Pro Supports Apple Smart Keyboard and Apple Pencil</p>\r\n', 'apple-9-7-ipad-32-gb-gold', 339, 'apple-9-7-ipad-32-gb-gold.jpg', '2018-07-09', 3),
(6, 1, 'DELL Inspiron 15 5000 15', '<p>15-inch laptop delivering an exceptional viewing experience, a head-turning finish and an array of options designed to elevate your entertainment, wherever you go.</p>\r\n', 'dell-inspiron-15-5000-15', 449.99, 'dell-inspiron-15-5000-15.jpg', '0000-00-00', 0),
(7, 3, 'APPLE 10.5\" iPad Pro - 64 GB, Space Grey (2017)', '<p>4K video recording at 30 fps</p>\r\n\r\n<p>12-megapixel camera</p>\r\n\r\n<p>Fingerprint resistant coating</p>\r\n\r\n<p>Antireflective coating</p>\r\n\r\n<p>Face Time video calling</p>\r\n', 'apple-10-5-ipad-pro-64-gb-space-grey-2017', 619, 'apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', '0000-00-00', 0),
(8, 1, 'ASUS Transformer Mini T102HA 10.1\" 2 in 1 - Silver', '<p>Versatile Windows 10 device with keyboard and pen included, 2-in-1 functionality: use as both laptop and tablet.Update Windows periodically to ensure that your applications have the latest security settings.</p>\r\n\r\n<p>All day battery life, rated up to 11 hours of video playback; 128GB Solid State storage. Polymer Battery.With up to 11 hours between charges, you can be sure that Transformer Mini T102HA will be right there whenever you need it. You can charge T102HA via its micro USB port, so you can use a mobile charger or any power bank with a micro USB connector.</p>\r\n', 'asus-transformer-mini-t102ha-10-1-2-1-silver', 549.99, 'asus-transformer-mini-t102ha-10-1-2-1-silver.jpg', '0000-00-00', 0),
(9, 2, 'PC SPECIALIST Vortex Core Lite Gaming PC', '<p>- Top performance for playing eSports and more&nbsp;<br />\r\n<br />\r\n- NVIDIA GeForce GTX graphics deliver smooth visuals&nbsp;<br />\r\n<br />\r\n- GeForce Experience delivers updates straight to your PC&nbsp;<br />\r\n<br />\r\nThe PC Specialist&nbsp;<strong>Vortex Core Lite&nbsp;</strong>is part of our Gaming range, bringing you the most impressive PCs available today. It has spectacular graphics and fast processing performance to suit the most exacting players.</p>\r\n', 'pc-specialist-vortex-core-lite-gaming-pc', 599.99, 'pc-specialist-vortex-core-lite-gaming-pc.jpg', '0000-00-00', 0),
(10, 2, 'DELL Inspiron 5675 Gaming PC - Recon Blue', '<p>All-new gaming desktop featuring powerful AMD Ryzen&trade; processors, graphics ready for VR, LED lighting and a meticulous design for optimal cooling.</p>\r\n', 'dell-inspiron-5675-gaming-pc-recon-blue', 599.99, 'dell-inspiron-5675-gaming-pc-recon-blue.jpg', '2018-05-10', 1),
(11, 2, 'HP Barebones OMEN X 900-099nn Gaming PC', '<p>What&#39;s inside matters.</p>\r\n\r\n<p>Without proper cooling, top tierperformance never reaches its fullpotential.</p>\r\n\r\n<p>Nine lighting zones accentuate theaggressive lines and smooth blackfinish of this unique galvanized steelcase.</p>\r\n', 'hp-barebones-omen-x-900-099nn-gaming-pc', 489.98, 'hp-barebones-omen-x-900-099nn-gaming-pc.jpg', '2018-05-12', 1),
(12, 2, 'ACER Aspire GX-781 Gaming PC', '<p>- GTX 1050 graphics card lets you play huge games in great resolutions&nbsp;<br />\r\n<br />\r\n- Latest generation Core&trade; i5 processor can handle demanding media software&nbsp;<br />\r\n<br />\r\n- Superfast SSD storage lets you load programs in no time&nbsp;<br />\r\n<br />\r\nThe Acer&nbsp;<strong>Aspire&nbsp;GX-781 Gaming PC&nbsp;</strong>is part of our Gaming range, which offers the most powerful PCs available today. It has outstanding graphics and processing performance to suit the most demanding gamer.</p>\r\n', 'acer-aspire-gx-781-gaming-pc', 749.99, 'acer-aspire-gx-781-gaming-pc.jpg', '2018-05-12', 3),
(13, 2, 'HP Pavilion Power 580-015na Gaming PC', '<p>Features the latest quad core Intel i5 processor and discrete graphics. With this power, you&rsquo;re ready to take on any activity from making digital art to conquering new worlds in VR.</p>\r\n\r\n<p>Choose the performance and storage you need. Boot up in seconds with to 128 GB SSD.</p>\r\n\r\n<p>Ditch the dull grey box, this desktop comes infused with style. A new angular bezel and bold green and black design give your workspace just the right amount of attitude.</p>\r\n\r\n<p>Up to 3 times faster performance - GeForce GTX 10-series graphics cards are powered by Pascal to deliver twice the performance of previous-generation graphics cards.</p>\r\n', 'hp-pavilion-power-580-015na-gaming-pc', 799.99, 'hp-pavilion-power-580-015na-gaming-pc.jpg', '2018-05-12', 1),
(14, 2, 'LENOVO Legion Y520 Gaming PC', '<p>- Multi-task with ease thanks to Intel&reg; i5 processor&nbsp;<br />\r\n<br />\r\n- Prepare for battle with NVIDIA GeForce GTX graphics card&nbsp;<br />\r\n<br />\r\n- VR ready for the next-generation of immersive gaming and entertainment<br />\r\n<br />\r\n- Tool-less upgrade helps you personalise your system to your own demands&nbsp;<br />\r\n<br />\r\nPart of our Gaming range, which features the most powerful PCs available today, the Lenovo&nbsp;<strong>Legion Y520 Gaming PC</strong>&nbsp;has superior graphics and processing performance to suit the most demanding gamer.</p>\r\n', 'lenovo-legion-y520-gaming-pc', 899.99, 'lenovo-legion-y520-gaming-pc.jpg', '2018-05-10', 13),
(15, 2, 'PC SPECIALIST Vortex Minerva XT-R Gaming PC', '<p>- NVIDIA GeForce GTX graphics for stunning gaming visuals<br />\r\n<br />\r\n- Made for eSports with a speedy 7th generation Intel&reg; Core&trade; i5 processor<br />\r\n<br />\r\n- GeForce technology lets you directly update drivers, record your gaming and more<br />\r\n<br />\r\nThe PC Specialist&nbsp;<strong>Vortex Minerva XT-R Gaming PC</strong>&nbsp;is part of our Gaming range, which offers the most powerful PCs available. Its high-performance graphics and processing are made to meet the needs of serious gamers.</p>\r\n', 'pc-specialist-vortex-minerva-xt-r-gaming-pc', 999.99, 'pc-specialist-vortex-minerva-xt-r-gaming-pc.jpg', '2018-07-09', 1),
(16, 2, 'PC SPECIALIST Vortex Core II Gaming PC', '<p>Processor: Intel&reg; CoreTM i3-6100 Processor- Dual-core- 3.7 GHz- 3 MB cache</p>\r\n\r\n<p>Memory (RAM): 8 GB DDR4 HyperX, Storage: 1 TB HDD, 7200 rpm</p>\r\n\r\n<p>Graphics card: NVIDIA GeForce GTX 950 (2 GB GDDR5), Motherboard: ASUS H110M-R</p>\r\n\r\n<p>USB: USB 3.0 x 3- USB 2.0 x 5, Video interface: HDMI x 1- DisplayPort x 1- DVI x 2, Audio interface: 3.5 mm jack, Optical disc drive: DVD/RW, Expansion card slot PCIe: (x1) x 2</p>\r\n\r\n<p>Sound: 5.1 Surround Sound support PSU Corsair: VS350, 350W, Colour: Black- Green highlights, Box contents: PC Specialist Vortex Core- AC power cable</p>\r\n', 'pc-specialist-vortex-core-ii-gaming-pc', 649.99, 'pc-specialist-vortex-core-ii-gaming-pc.jpg', '2018-05-10', 2),
(17, 3, 'AMAZON Fire 7 Tablet with Alexa (2017) - 8 GB, Black', '<p>The next generation of our best-selling Fire tablet ever - now thinner, lighter, and with longer battery life and an improved display. More durable than the latest iPad</p>\r\n\r\n<p>Beautiful 7&quot; IPS display with higher contrast and sharper text, a 1.3 GHz quad-core processor, and up to 8 hours of battery life. 8 or 16 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.</p>\r\n', 'amazon-fire-7-tablet-alexa-2017-8-gb-black', 49.99, 'amazon-fire-7-tablet-alexa-2017-8-gb-black.jpg', '2018-05-12', 1),
(18, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 16 GB, Black', '<p>Take your personal assistant with you wherever you go with this Amazon Fire HD 8 tablet featuring Alexa voice-activated cloud service. The slim design of the tablet is easy to handle, and the ample 8-inch screen is ideal for work or play. This Amazon Fire HD 8 features super-sharp high-definition graphics for immersive streaming.</p>\r\n', 'amazon-fire-hd-8-tablet-alexa-2017-16-gb-black', 79.99, 'amazon-fire-hd-8-tablet-alexa-2017-16-gb-black.jpg', '2018-05-12', 2),
(19, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 32 GB, Black', '<p>The next generation of our best-reviewed Fire tablet, with up to 12 hours of battery life, a vibrant 8&quot; HD display, a 1.3 GHz quad-core processor, 1.5 GB of RAM, and Dolby Audio. More durable than the latest iPad.</p>\r\n\r\n<p>16 or 32 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.</p>\r\n', 'amazon-fire-hd-8-tablet-alexa-2017-32-gb-black', 99.99, 'amazon-fire-hd-8-tablet-alexa-2017-32-gb-black.jpg', '2018-05-10', 1),
(20, 3, 'APPLE 9.7\" iPad - 32 GB, Space Grey', '<p>9.7-inch Retina display, wide color and true tone</p>\r\n\r\n<p>A9 third-generation chip with 64-bit architecture</p>\r\n\r\n<p>M9 motion coprocessor</p>\r\n\r\n<p>1.2MP FaceTime HD camera</p>\r\n\r\n<p>8MP iSight camera</p>\r\n\r\n<p>Touch ID</p>\r\n\r\n<p>Apple Pay</p>\r\n', 'apple-9-7-ipad-32-gb-space-grey', 339, 'apple-9-7-ipad-32-gb-space-grey.jpg', '2018-05-12', 1),
(27, 1, 'Dell XPS 15 9560', '<p>The world&rsquo;s smallest 15.6-inch performance laptop packs powerhouse performance and a stunning InfinityEdge display &mdash; all in our most powerful XPS laptop. Featuring the latest Intel&reg; processors.</p>\r\n\r\n<h2>Operating system</h2>\r\n\r\n<p><strong>Available with Windows 10 Home&nbsp;</strong>- Get the best combination of Windows features you know and new improvements you&#39;ll love.</p>\r\n\r\n<h2>Innovation that inspires.</h2>\r\n\r\n<p>When you&rsquo;re at the forefront of ingenuity, you get noticed. That&rsquo;s why it&rsquo;s no surprise the XPS 15 was honored. The winning streak continues.</p>\r\n\r\n<h2>Meet the smallest 15.6-inch laptop on the planet.</h2>\r\n\r\n<p><strong>The world&rsquo;s only 15.6-inch InfinityEdge display*:</strong>&nbsp;The virtually borderless display maximizes screen space by accommodating a 15.6-inch display inside a laptop closer to the size of a 14-inch, thanks to a bezel measuring just 5.7mm.<br />\r\n&nbsp;<br />\r\n<strong>Operating System: Windows 10 Pro.</strong><br />\r\n<br />\r\n<strong>One-of-a-kind design:</strong>&nbsp;Measuring in at a slim 11-17mm and starting at just 4 pounds (1.8 kg) with a solid state drive, the XPS 15 is one of the world&rsquo;s lightest 15-inch performance-class laptop.</p>\r\n\r\n<h2>A stunning view, wherever you go.</h2>\r\n\r\n<p><strong>Dazzling detail:</strong>&nbsp;With the UltraSharp 4K Ultra HD display (3840 x 2160), you can see each detail of every pixel without needing to zoom in. And with 6 million more pixels than Full HD and 3 million more than the MacBook Pro, you can edit images with pinpoint accuracy without worrying about blurriness or jagged lines.<br />\r\n<br />\r\n<strong>Industry-leading color:</strong>&nbsp;The XPS 15 is the only laptop with 100% Adobe RGB color, covering a wider color gamut and producing shades of color outside conventional panels so you can see more of what you see in real life. And with over 1 billion colors, images appear smoother and color gradients are amazingly lifelike with more depth and dimension. Included is Dell PremierColor software, which automatically remaps content not already in Adobe RGB format for onscreen colors that appear amazingly accurate and true to life.<br />\r\n<br />\r\n<strong>Easy collaboration:</strong>&nbsp;See your screen from nearly every angle with an IGZO IPS panel, providing a wide viewing angle of up to 170&deg;.&nbsp;<br />\r\n<br />\r\n<strong>Brighten your day:</strong>&nbsp;With 350 nit brightness, it&rsquo;s brighter than a typical laptop.<br />\r\n<br />\r\n<strong>Touch-friendly:</strong>&nbsp;Tap, swipe and pinch your way around the screen. The optional touch display lets you interact naturally with your technology.</p>\r\n', 'dell-xps-15-9560', 1599, 'dell-xps-15-9560.jpg', '2018-07-09', 9),
(28, 4, 'Samsung Note 8', '<p>See the bigger picture and communicate in a whole new way. With the Galaxy Note8 in your hand, bigger things are just waiting to happen.&nbsp;</p>\r\n\r\n<h3>The Infinity Display that&#39;s larger than life.&nbsp;</h3>\r\n\r\n<p>More screen means more space to do great things. Go big with the Galaxy Note8&#39;s 6.3&quot; screen. It&#39;s the largest ever screen on a Note device and it still fits easily in your hand.</p>\r\n\r\n<p>*Infinity Display: a near bezel-less, full-frontal glass, edge-to-edge screen.</p>\r\n\r\n<p>*Screen measured diagonally as a full rectangle without accounting for the rounded corners.</p>\r\n\r\n<p>Use the S Pen to express yourself in ways that make a difference. Draw your own emojis to show how you feel or write a message on a photo and send it as a handwritten note. Do things that matter with the S Pen.</p>\r\n\r\n<p>*Image simulated for illustration purpose only.</p>\r\n', 'samsung-note-8', 829, 'samsung-note-8.jpg', '0000-00-00', 0),
(29, 4, 'Samsung Galaxy S9+ [128 GB]', '<h2>The revolutionary camera that adapts like the human eye.&nbsp;</h2>\r\n\r\n<h3>Capture stunning pictures in bright daylight and super low light.</h3>\r\n\r\n<p>Our category-defining Dual Aperture lens adapts like the human eye. It&#39;s able to automatically switch between various lighting conditions with ease&mdash;making your photos look great whether it&#39;s bright or dark, day or night.</p>\r\n\r\n<p>*Dual Aperture supports F1.5 and F2.4 modes. Installed on the rear camera (Galaxy S9)/rear wide camera (Galaxy S9+).</p>\r\n\r\n<p><img alt=\"\" src=\"https://www.samsung.com/global/galaxy/galaxy-s9/images/galaxy-s9_slow_gif_visual_l.jpg\" style=\"height:464px; width:942px\" />Add music. Make GIFs. Get likes</p>\r\n\r\n<p>Super Slow-mo lets you see the things you could have missed in the blink of an eye. Set the video to music or turn it into a looping GIF, and share it with a tap. Then sit back and watch the reactions roll in.</p>\r\n', 'samsung-galaxy-s9-128-gb', 889.99, 'samsung-galaxy-s9-128-gb.jpg', '2023-09-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$0SHFfoWzz8WZpdu9Qw//E.tWamILbiNCX7bqhy3od0gvK5.kSJ8N2', 1, 'Code', 'Projects', '', '', 'thanos1.jpg', 1, '', '', '2018-05-01'),
(9, 'harry@den.com', '$2y$10$0TzKcRCEfL8ByofGJOPer.IoTOg9HWhZFw5qjoNXTDOPn2QCv4n0G', 0, 'Harry', 'Den', 'Silay City, Negros Occidental', '09092735719', 'male2.png', 1, 'k8FBpynQfqsv', 'PmK2oWqn91aHfvy', '2018-05-09'),
(12, 'christine@gmail.com', '$2y$10$ozW4c8r313YiBsf7HD7m6egZwpvoE983IHfZsPRxrO1hWXfPRpxHO', 0, 'Christine', 'becker', 'demo', '7542214500', 'female3.jpg', 1, '', '', '2018-07-09'),
(33, 'aa@gmail.com', '12344', 0, 'aaaa', 'aaa', 'asjidausdasdkh@#kkdahkdia', '3787637263836127836', '', 1, '', '', '0000-00-00'),
(34, 'ddd@gamil.com', '$2y$10$/Zis9TJyXXS7iCs83.3z0eS288KahH5NAdWslSQIBvQ2nGRzdYNTW', 0, 'ad', 'as', 'as', '333', '', 1, '', '', '2023-09-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"agricart\",\"table\":\"seller_details\"},{\"db\":\"agricart\",\"table\":\"order_details\"},{\"db\":\"agricart\",\"table\":\"shop_details\"},{\"db\":\"agricart\",\"table\":\"admin\"},{\"db\":\"agricart\",\"table\":\"buyer_details\"},{\"db\":\"agricart\",\"table\":\"product_details\"},{\"db\":\"agricart\",\"table\":\"newsletter\"},{\"db\":\"agricart\",\"table\":\"contact_details\"},{\"db\":\"agricart\",\"table\":\"cart_details\"},{\"db\":\"ecomm\",\"table\":\"details\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'agricart', 'cart_details', '[]', '2024-02-13 05:39:03'),
('root', 'agricart', 'contact_details', '[]', '2024-02-06 08:13:05'),
('root', 'agricart', 'order_details', '{\"sorted_col\":\"`tracking_no` ASC\"}', '2024-03-12 03:27:00'),
('root', 'agricart', 'seller_details', '{\"sorted_col\":\"`government_id` ASC\"}', '2024-02-28 07:12:03'),
('root', 'agricart', 'shop_details', '{\"sorted_col\":\"`shop_details`.`address` ASC\"}', '2024-02-21 13:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-05-06 03:02:11', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `prashant bhadvo`
--
CREATE DATABASE IF NOT EXISTS `prashant bhadvo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `prashant bhadvo`;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `question` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_name`, `question`, `date`) VALUES
(5, 'shlok111', 'create a login page in html', ''),
(6, 'shlok111', 'what is inheritance', ''),
(7, 'shlok111', 'what is inheritance', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `contact` int(40) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `contact`, `email`) VALUES
(3, 'shlok', '123', 1234567890, 'shlokpatel.502@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Database: `upload`
--
CREATE DATABASE IF NOT EXISTS `upload` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `upload`;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_path`) VALUES
(1, 'uploads/Screenshot (5).png'),
(2, 'uploads/Screenshot (9).png'),
(3, 'uploads/leaving.jpg'),
(4, 'uploads/foto.jpg'),
(5, 'uploads/Creative & Personal Portfolio Elementor Template Kit.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
