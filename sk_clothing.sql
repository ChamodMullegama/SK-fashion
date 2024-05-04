-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 01:04 PM
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
-- Database: `sk_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`) VALUES
('skfashion', 'SK2001');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `sub_category_name`, `description`) VALUES
(22, 'Dresses', '', 'Basics'),
(26, 'Tops & T Shirts', 'Tops', ''),
(27, 'Tops & T Shirts', 'T-Shirts', '');

-- --------------------------------------------------------

--
-- Table structure for table `category_bridal_wear`
--

CREATE TABLE `category_bridal_wear` (
  `category_id_BW` int(10) NOT NULL,
  `category_name_BW` varchar(255) NOT NULL,
  `description_BW` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_bridal_wear`
--

INSERT INTO `category_bridal_wear` (`category_id_BW`, `category_name_BW`, `description_BW`) VALUES
(8, 'Jackets', 'Elevate your style with the timeless elegance of Saree, Osarai and  lehenga!'),
(9, 'Sarees', 'Originating from India, a saree is a versatile and graceful garment that drapes around the body with effortless charm. Crafted from a variety of luxurious fabrics such as silk, chiffon, and georgette, sarees come in a myriad of colors, patterns, and designs, making them suitable for every occasion, from weddings to casual gatherings.'),
(10, 'Osaree', 'Experience the allure of traditional Sri Lankan attire with the Osari, also known as Osaree. Resplendent in its simplicity yet rich in cultural significance, the Osari is a traditional draped garment worn by women on special occasions and cultural ceremonies. '),
(11, 'Bridal Gowns', 'Indulge in the epitome of elegance and romance with our exquisite collection of Bridal Gowns. Crafted to perfection with the finest fabrics and meticulous attention to detail, our bridal gowns are designed to fulfill every bride\'s fairytale dream.');

-- --------------------------------------------------------

--
-- Table structure for table `clothing_items`
--

CREATE TABLE `clothing_items` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sub_category` varchar(225) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `sizeOptions` varchar(50) DEFAULT NULL,
  `material` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantityAvailable` int(11) NOT NULL,
  `images` text DEFAULT NULL,
  `description` text NOT NULL,
  `careInstructions` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `availabilityStatus` varchar(20) NOT NULL,
  `discounts` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clothing_items`
--

INSERT INTO `clothing_items` (`id`, `productName`, `category`, `sub_category`, `brand`, `gender`, `sizeOptions`, `material`, `price`, `quantityAvailable`, `images`, `description`, `careInstructions`, `tags`, `availabilityStatus`, `discounts`, `created_at`) VALUES
(73, 'Grey Short Sleeve', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% Cotton 5% Elastene', 3490.00, 15, './uploaded_img/183665266--3--1654230771.jpeg, ./uploaded_img/183665266--2--1654230769.jpeg, ./uploaded_img/183665266--1--1654230767.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Basics Grey Marl Short Sleeve Tshirt Dress', 'available', '10', '2024-03-17 13:02:49'),
(74, 'White Short Sleeve', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% Cotton 5% Elastene', 3490.00, 15, './uploaded_img/183665320--3--1654230779.jpeg, ./uploaded_img/183665320--2--1654230776.jpeg, ./uploaded_img/183665320--1--1654230775.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade', 'Basics Grey Marl Short Sleeve Tshirt Dress', 'available', '10', '2024-03-17 13:10:01'),
(79, 'Pink Maxi Dress', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% POLYESTER 5% ELASTANE', 5790.00, 10, './uploaded_img/185463342--1--1657170089.jpeg, ./uploaded_img/185463342--2--1657170091.jpeg, ./uploaded_img/185463342--3--1657170096.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Biconic Pink Maxi Dress With Front Slit', 'available', '5', '2024-03-17 13:46:26'),
(80, 'Greent Front Knot Skater', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% POLYESTER 5% ELASTANE', 5790.00, 10, './uploaded_img/1.jpeg, ./uploaded_img/2.jpeg, ./uploaded_img/3.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Biconic Pink Maxi Dress With Front Slit', 'available', '5', '2024-03-17 13:48:38'),
(81, 'Puff Sleeve Double', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% POLYESTER 5% ELASTANE', 6990.00, 10, './uploaded_img/191314116--1--1666756021.jpeg, ./uploaded_img/191314116--2--1666756022.jpeg, ./uploaded_img/191314116--3--1666756025.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Biconic Pink Maxi Dress With Front Slit', 'available', '5', '2024-03-17 13:51:25'),
(82, 'Red Off Shoulder', 'Dresses', '', 'SK CLOTHING', '', 'S, M, L', '95% POLYESTER 5% ELASTANE', 7990.00, 10, './uploaded_img/193514453--2--1668159922.jpeg, ./uploaded_img/193514453--1--1668159974.jpeg, ./uploaded_img/193514453--3--1668159976.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Biconic Pink Maxi Dress With Front Slit', 'available', 'no', '2024-03-17 13:54:37'),
(83, 'Halter Neck Party Dress', 'Dresses', '', 'SK CLOTHING', '', 'M, L, XL', '90% POLYESTER 10% VISCOSE', 7990.00, 5, './uploaded_img/193514322--1--1668159966.jpeg, ./uploaded_img/193514322--2--1668159968.jpeg, ./uploaded_img/193514322--3--1668159970.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', ' Biconic Red Halter Neck Party Dress', 'available', 'no', '2024-03-18 09:53:32'),
(84, 'Front Cut Out Midi Dress', 'Dresses', '', 'SK CLOTHING', '', 'M, L, XL', '95% COTTON 5% SPANDEX', 6990.00, 15, './uploaded_img/197867571--1--1678692338.jpeg, ./uploaded_img/197867571--2--1678692339.jpeg, ./uploaded_img/197867571--3--1678692341.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', ' Biconic Yellow Front Cut Out Midi Dress', 'available', '5', '2024-03-18 10:00:27'),
(85, 'Scallop Hem & Strap', 'Dresses', '', 'SK CLOTHING', '', 'M, L, XL', '95% COTTON 5% SPANDEX', 7990.00, 15, './uploaded_img/185814704--1--1659109509.jpeg, ./uploaded_img/185814704--2--1659109510.jpeg, ./uploaded_img/185814704--3--1659109513.jpeg', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Machine wash cold, color may transfer.\r\nWash separately.\r\nDo not bleach.\r\nLow iron.\r\nTumble dry or flat dry in shade.', 'Odel Purple Scallop Hem & Strap Detailed Mini Dress', 'available', '15', '2024-03-18 10:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `clothing_items_bridal_wear`
--

CREATE TABLE `clothing_items_bridal_wear` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `sizeOptions` varchar(50) DEFAULT NULL,
  `material` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantityAvailable` int(11) NOT NULL,
  `images` text DEFAULT NULL,
  `description` text NOT NULL,
  `careInstructions` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `availabilityStatus` varchar(20) NOT NULL,
  `discounts` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clothing_items_bridal_wear`
--

INSERT INTO `clothing_items_bridal_wear` (`id`, `productName`, `category`, `brand`, `gender`, `sizeOptions`, `material`, `price`, `quantityAvailable`, `images`, `description`, `careInstructions`, `tags`, `availabilityStatus`, `discounts`, `created_at`) VALUES
(32, 'Long Sleeve Jacket', 'Jackets', '', '', 'S, M, L, XL, XXL', 'Cotton/Satin', 2500.00, 100, './uploaded_img_BW/99d73f1776d0bb48a2e27c03e71ea9ce.jpg, ./uploaded_img_BW/900da351b999de399569317fd1b3686d.jpg, ./uploaded_img_BW/91fc095f94addae967f39d52e93337e4.jpg', 'Jackets effortlessly blend tradition with contemporary style. ', '', '', 'available', '10', '2024-04-10 14:57:14'),
(33, 'Elbow Length Jackets', 'Jackets', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 3000.00, 200, './uploaded_img_BW/ad843bc13a47b1f9c13b4f318d668beb.jpg, ./uploaded_img_BW/f522346e0372beb735c6acb5c09f404c.jpg, ./uploaded_img_BW/2b8d8e3278b441db6f60fa11a0357bdc.jpg', ' Adorned with intricate embroidery, sequins, or mirror work, each Lehenga Jacket ensemble is a statement of elegance and grace, allowing you to make a lasting impression wherever you go.', '', '', 'available', '10', '2024-04-10 15:06:50'),
(34, 'Sleeveless Saree Jackets', 'Jackets', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 1500.00, 100, './uploaded_img_BW/bca06cd7bb6dd7d4e52904f7eb61f1bd.jpg, ./uploaded_img_BW/d6d2d27a257c2bdd2aedc60cff0d9720.jpg, ./uploaded_img_BW/a8bf5ab93ac898c5c6a4f5f477cfca69.jpg', 'Embrace the beauty and grace', '', '', 'available', '', '2024-04-10 15:15:30'),
(35, 'Elbow Length Jackets', 'Jackets', '', '', 'S, M, L, XL, XXL', 'Silk/Chiffon', 1500.00, 100, './uploaded_img_BW/2138c1b258610c8ee7bd387c19014d60.jpg, ./uploaded_img_BW/3b13fdf74a4b05507618d24ce8002f57.jpg, ./uploaded_img_BW/ae71c61075f86ff6d85eda4de907215f.jpg', 'Elegant Black', '', '', 'available', '', '2024-04-11 05:49:13'),
(36, 'Lehenga Set', 'Bridal Gowns', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 4000.00, 200, './uploaded_img_BW/442c47e82b7ac7152f8f72cafb1f031d.jpg, ./uploaded_img_BW/158e2f7a49a7819c0b5b7d887edbeba4.jpg, ./uploaded_img_BW/97e6ff54fb89e74d8740963b05ff76c1.jpg', 'Simple Lehenga Set', '', '', 'preorder', '10', '2024-04-11 05:52:57'),
(37, 'Green Lehenga', 'Bridal Gowns', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 7000.00, 100, './uploaded_img_BW/6e406b0da2ba955f39968d159d2dc989.jpg, ./uploaded_img_BW/64b87f54486246f4c1b62751e1801389.jpg, ./uploaded_img_BW/ae1a726bd70f6a2c3658b73d644a79af.jpg', 'Glamorous', '', '', 'available', '10', '2024-04-11 05:56:47'),
(38, 'Floral Gown', 'Bridal Gowns', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 8000.00, 160, './uploaded_img_BW/e99e41bfbd34089365e483113a05aaac.jpg, ./uploaded_img_BW/2b42719b28cc80bec0bd574528c38afc.jpg, ./uploaded_img_BW/acd0131dc7c610876bb0d993dc87b78f.jpg', 'Floral touch ', '', '', 'available', '', '2024-04-11 05:58:23'),
(39, 'Rainbow color saree', 'Sarees', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 3000.00, 100, './uploaded_img_BW/5a528b5268be5564b471306438dfecac.jpg, ./uploaded_img_BW/5b5317d4cbe0c4ca7a3d22a2260736a4.jpg, ./uploaded_img_BW/d3396997745b43e1cddd8aca0930cf78.jpg', 'Rainbow touch', '', '', 'available', '', '2024-04-11 06:02:03'),
(41, 'Blue Color saree', 'Sarees', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 4000.00, 100, './uploaded_img_BW/7b80a4331b106c6208800ed6f81802c8.jpg, ./uploaded_img_BW/3b2685903188931053c9d1e157681b22.jpg, ./uploaded_img_BW/de523e48824833bb4bc66a31aed13023.jpg', 'Simple saree for your day', '', '', 'available', '', '2024-04-11 06:07:36'),
(42, 'Simple Saree', 'Sarees', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 6500.00, 200, './uploaded_img_BW/86ba4f3f8fcd2761f9edbccd9c54f18e.jpg, ./uploaded_img_BW/f48fa472dd60849a4c00a6272a3fb1db.jpg, ./uploaded_img_BW/22f4b2813bbe5d810777bd7970316277.jpg', 'for your day', '', '', 'available', '', '2024-04-11 06:08:39'),
(43, 'White osari', 'Osaree', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 3500.00, 100, './uploaded_img_BW/5958f1d6618837fa7024c776270bba38 (1).jpg, ./uploaded_img_BW/ad9bb508cf459158170b6a0adc8a89c5.jpg, ./uploaded_img_BW/945efa2d65d18e9bf8e2509b7f1cf406.jpg', 'Simple osari', '', '', 'available', '', '2024-04-11 06:12:35'),
(44, 'Designer osari', 'Osaree', '', '', 'S, M, L, XL, XXL', 'Chiffon/lace/velvet', 4500.00, 100, './uploaded_img_BW/065c5687257f70127c550dd1b27730d5.jpg, ./uploaded_img_BW/5073cc77e8b60ea3ac15b0b9a22551a1.jpg, ./uploaded_img_BW/7446e0ec999a6f16ee7e7b9151b15978.jpg', 'Glam to your day', '', '', 'available', '', '2024-04-11 06:13:42'),
(45, 'White Designer Osari', 'Osaree', '', '', 'S, M, L, XL, XXL', 'Silk/Chiffon', 5500.00, 100, './uploaded_img_BW/7fcea26368db85c7623576e003fa6f13.jpg, ./uploaded_img_BW/5db8b554fa716dc7740a0b509bba60aa.jpg, ./uploaded_img_BW/bd241a61d26f5672754f968e304e944d.jpg', 'Simple osari', '', '', 'available', '', '2024-04-11 06:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_otp` int(11) NOT NULL,
  `customer_vstatus` int(2) NOT NULL DEFAULT 0,
  `firstName` varchar(225) DEFAULT NULL,
  `lastName` varchar(225) DEFAULT NULL,
  `Profile_image` varchar(225) DEFAULT NULL,
  `addressLine1` varchar(225) DEFAULT NULL,
  `addressLine2` varchar(225) DEFAULT NULL,
  `town` varchar(225) DEFAULT NULL,
  `postalCode` int(10) DEFAULT NULL,
  `phoneNumber` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_otp`, `customer_vstatus`, `firstName`, `lastName`, `Profile_image`, `addressLine1`, `addressLine2`, `town`, `postalCode`, `phoneNumber`) VALUES
(30, 'visitha Nirmal', 'ruwanmg99@gmail.com', '$2y$10$DwXqIidp3ehk7FKkXa3BU.ZLJpVNTC3JwxcmufbsYjXvPbRk8YdAi', 152967, 1, 'Visitha Nirmal', 'Rajapaksha', './uploaded_img/profile_pic/337358500_226661709922288_7967773541895169445_n.jpg', 'No.99/3,', 'Kahawatta,', 'Ambathanna', 20136, 764632042),
(31, 'visitha', 'VNR2001@gmail.com', '$2y$10$PRFCoaoK0aiqKeBnJ7at5eNTZSLyjqxH2tAk0E/mRxDrGWsc9JIjG', 348337, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Jasintha Bandara', '123@gmail.com', '$2y$10$P8JSi1vM5ngTZubX7ticuOLkqV2DLYcsAQtOLr.P2ByM9.8rhXw0a', 320013, 1, 'Jasintha', 'Bandara', './uploaded_img/profile_pic/download (17).jpeg', '109/4 , samaragiri , ambthenn', '', 'Kandy', 201624, 750481219),
(37, 'asdasasd', 'VNR2001vcb@gmail.com', '$2y$10$baweWetWPaEV1zJC6NyH5.FAm8CF7srBn853od5KmHeKg1KLF9du6', 366317, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'YomalThushara', 'yomal2001@gmail.com', '$2y$10$6FnmA9juDXjhtY1x3hlv6OH5os4hiHZcC7y.h.iB9WUmbN7468LW6', 909241, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `customer_id`, `first_name`, `last_name`, `address_line1`, `address_line2`, `town`, `postal_code`, `phone_number`, `birthday`) VALUES
(1, NULL, 'Jasintha', 'Bandara', '109/4 , samaragiri , ambthenn', '', 'Kandy', '201624', '750481219', '0000-00-00'),
(2, NULL, 'Jasintha', 'Bandara', '109/4 , samaragiri , ambthenn', '', 'Kandy', '201624', '750481219', '2032-12-03'),
(3, NULL, 'Jasintha', 'Bandara', '109/4 , samaragiri , ambthenn', '', 'Kandy', '201624', '750481219', '0000-00-00'),
(4, NULL, 'Jasintha', 'Bandara', '109/4 , samaragiri , ambthenn', '', 'Kandy', '201624', '750481219', '0000-00-00'),
(5, NULL, 'dewd', 'ewdew', 'ewdew', 'ewdew', 'ewdew', '`3', '`21321', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `custom_clothes`
--

CREATE TABLE `custom_clothes` (
  `id` int(11) NOT NULL,
  `cloth_name` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_clothes`
--

INSERT INTO `custom_clothes` (`id`, `cloth_name`, `material`, `description`, `image_path`, `category`, `price`, `quantity`) VALUES
(12, 'Designer Osaree', 'Silk/Chiffon', 'For your Special Day', './uploads_bw_custom/d8acb479275dd81cff0f05fe5b341d91.jpg', 'Osari', 10000.00, 12),
(13, 'Pink Osaree', 'Chiffon/lace/velvet', 'Feel Pinkish', './uploads_bw_custom/229867365f5cbd1c6f4f636bbcc740f6.jpg', 'Osari', 5400.00, 10),
(14, 'Designer Osaree', 'Chiffon/lace/velvet', 'Fashionable ', './uploads_bw_custom/8bb26f51c2bcf8b5ed000924c23dc8bc.jpg', 'Osari', 7000.00, 20),
(15, 'Lace Jackets', 'Chiffon/lace/velvet', 'Trendy Lace Jacket', './uploads_bw_custom/950bbb152dc69de2bab6e5f50e832a90.jpg', 'blues', 2000.00, 40),
(16, 'White Saree Jackets', 'Chiffon/lace/velvet', 'Trendy Jacket', './uploads_bw_custom/5958f1d6618837fa7024c776270bba38.jpg', 'blues', 3000.00, 20),
(17, 'Bubble Sleeve Jacket', 'Silk/Chiffon', 'Simple And Elegant', './uploads_bw_custom/c7d921e41d1dfa42f066d25d9f69fdfc.jpg', 'Osari', 1500.00, 15),
(18, 'Bubble Sleeve Jacket', 'Chiffon/lace/velvet', 'Simple But Elegant', './uploads_bw_custom/c7d921e41d1dfa42f066d25d9f69fdfc.jpg', 'blues', 1500.00, 15);

-- --------------------------------------------------------

--
-- Table structure for table `cus_address`
--

CREATE TABLE `cus_address` (
  `customer_name` varchar(100) NOT NULL,
  `line01` varchar(100) NOT NULL,
  `line02` varchar(100) NOT NULL,
  `line03` varchar(100) NOT NULL,
  `ZIP_code` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cus_address`
--

INSERT INTO `cus_address` (`customer_name`, `line01`, `line02`, `line03`, `ZIP_code`) VALUES
('visitha Nirmal Rajapaksha', '99/3', 'kahawatta', 'ambathanna', 20136);

-- --------------------------------------------------------

--
-- Table structure for table `cus_dp`
--

CREATE TABLE `cus_dp` (
  `dp_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `image_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `shoulder` varchar(50) DEFAULT NULL,
  `front_w` varchar(50) DEFAULT NULL,
  `front_l` varchar(50) DEFAULT NULL,
  `bust_point_w` varchar(50) DEFAULT NULL,
  `bust_l` varchar(50) DEFAULT NULL,
  `bra_cut_l` varchar(50) DEFAULT NULL,
  `waist_l` varchar(50) DEFAULT NULL,
  `low_waist_l` varchar(50) DEFAULT NULL,
  `hip_l` varchar(50) DEFAULT NULL,
  `low_hip_l` varchar(50) DEFAULT NULL,
  `knee_l` varchar(50) DEFAULT NULL,
  `full_l` varchar(50) DEFAULT NULL,
  `upper_bust` varchar(50) DEFAULT NULL,
  `bust` varchar(50) DEFAULT NULL,
  `bra_cut_waist` varchar(50) DEFAULT NULL,
  `waist` varchar(50) DEFAULT NULL,
  `low_waist` varchar(50) DEFAULT NULL,
  `hip` varchar(50) DEFAULT NULL,
  `low_hip_r` varchar(50) DEFAULT NULL,
  `knee_r` varchar(50) DEFAULT NULL,
  `armhole` varchar(50) DEFAULT NULL,
  `sofa` varchar(50) DEFAULT NULL,
  `sl_l` varchar(50) DEFAULT NULL,
  `sl_open` varchar(50) DEFAULT NULL,
  `neck_depth` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `item_id`, `shoulder`, `front_w`, `front_l`, `bust_point_w`, `bust_l`, `bra_cut_l`, `waist_l`, `low_waist_l`, `hip_l`, `low_hip_l`, `knee_l`, `full_l`, `upper_bust`, `bust`, `bra_cut_waist`, `waist`, `low_waist`, `hip`, `low_hip_r`, `knee_r`, `armhole`, `sofa`, `sl_l`, `sl_open`, `neck_depth`, `created_at`) VALUES
(1, 3, '23', '324', '234', '23', '23', '234', '234', '2', '234', '234', '234', '234', '243', '234', '234', '23', '2', '324', '324', '234', '234', '324', '34', '234', '234', '2024-03-25 07:50:16'),
(2, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-25 18:17:04'),
(3, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-25 20:20:09'),
(4, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-25 20:29:16'),
(5, 9, '', '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '2024-03-27 08:50:27'),
(6, 9, '', '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '2024-03-27 08:51:10'),
(7, 9, '', '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '2024-03-27 14:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `measurements_bl`
--

CREATE TABLE `measurements_bl` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `shoulder` varchar(255) DEFAULT NULL,
  `front_w` varchar(255) DEFAULT NULL,
  `back_w` varchar(255) DEFAULT NULL,
  `bust_point_w` varchar(255) DEFAULT NULL,
  `bust_l` varchar(255) DEFAULT NULL,
  `bra_cut_l` varchar(255) DEFAULT NULL,
  `upper_bust` varchar(255) DEFAULT NULL,
  `bust` varchar(255) DEFAULT NULL,
  `bra_cut_waist` varchar(255) DEFAULT NULL,
  `waist` varchar(255) DEFAULT NULL,
  `waist_jacket_length` varchar(255) DEFAULT NULL,
  `armhole` varchar(255) DEFAULT NULL,
  `sofa` varchar(255) DEFAULT NULL,
  `sl_l` varchar(255) DEFAULT NULL,
  `sl_open` varchar(255) DEFAULT NULL,
  `neck_depth` varchar(255) DEFAULT NULL,
  `saree_jacket_open_side` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements_bl`
--

INSERT INTO `measurements_bl` (`id`, `item_id`, `shoulder`, `front_w`, `back_w`, `bust_point_w`, `bust_l`, `bra_cut_l`, `upper_bust`, `bust`, `bra_cut_waist`, `waist`, `waist_jacket_length`, `armhole`, `sofa`, `sl_l`, `sl_open`, `neck_depth`, `saree_jacket_open_side`, `created_at`) VALUES
(1, 6, '34', '34', '34', '43', '432', '234', '43', '34', '43', '34', '43', '43', '34', '43', '34', '43', '34', '2024-03-25 08:13:06'),
(2, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-27 08:36:05'),
(3, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-27 08:40:44'),
(4, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-27 08:41:13'),
(5, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-27 08:41:37'),
(6, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-03-27 08:50:13'),
(7, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-04-08 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `town` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `size` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `confirm_status` int(11) NOT NULL DEFAULT 0,
  `order_time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `first_name`, `last_name`, `address_line1`, `address_line2`, `town`, `postal_code`, `email`, `phone_number`, `item_name`, `size`, `price`, `quantity`, `subtotal`, `order_date`, `confirm_status`, `order_time`) VALUES
(52, 'visitha Nirmal', 'Visitha Nirmal', 'Rajapaksha', 'No.99/3,', 'Kahawatta,', 'Ambathanna', '20136', 'ruwanmg99@gmail.com', '764632042', 'Pink Maxi Dress', 'S', 5790.00, 2, 11580.00, '2024-03-28 15:08:36', 1, '20:38:36'),
(53, 'visitha Nirmal', 'Visitha Nirmal', 'Rajapaksha', 'No.99/3,', 'Kahawatta,', 'Ambathanna', '20136', 'ruwanmg99@gmail.com', '764632042', 'Pink Maxi Dress', 'S', 5790.00, 1, 5790.00, '2024-04-10 07:13:58', 1, '12:43:58'),
(54, 'visitha Nirmal', 'Visitha Nirmal', 'Rajapaksha', 'No.99/3,', 'Kahawatta,', 'Ambathanna', '20136', 'ruwanmg99@gmail.com', '764632042', 'Pink Maxi Dress', 'S', 5790.00, 1, 5790.00, '2024-04-10 07:21:00', 0, '12:51:00'),
(55, 'visitha Nirmal', 'Visitha Nirmal', 'Rajapaksha', 'No.99/3,', 'Kahawatta,', 'Ambathanna', '20136', 'ruwanmg99@gmail.com', '764632042', 'Halter Neck Party Dress', 'S', 7990.00, 1, 7990.00, '2024-04-10 07:21:00', 0, '12:51:00'),
(56, 'visitha Nirmal', 'Visitha Nirmal', 'Rajapaksha', 'No.99/3,', 'Kahawatta,', 'Ambathanna', '20136', 'ruwanmg99@gmail.com', '764632042', 'Scallop Hem & Strap', 'S', 7990.00, 1, 7990.00, '2024-04-10 07:21:00', 0, '12:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `rental_orders`
--

CREATE TABLE `rental_orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `date_ordered` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental_orders`
--

INSERT INTO `rental_orders` (`order_id`, `customer_name`, `item_name`, `price`, `size`, `quantity`, `total`, `subtotal`, `date_ordered`, `start_date`, `end_date`) VALUES
(11, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(12, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(13, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(14, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(15, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(16, 'visitha Nirmal', 'adas', 1323.00, 'S', 1, 1323.00, 1323.00, '2024-03-25', '2024-03-08', '2024-04-04'),
(17, 'visitha Nirmal', 'qweqwe', 12121.00, 'S', 1, 12121.00, 12121.00, '2024-03-25', '2024-03-23', '2024-03-26'),
(18, 'visitha Nirmal', 'tr iyt6', 6987.00, 'S', 1, 6987.00, 6987.00, '2024-03-25', '2024-03-25', '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `rented_clothes`
--

CREATE TABLE `rented_clothes` (
  `id` int(11) NOT NULL,
  `cloth_name` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `sizes_BW` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rented_clothes`
--

INSERT INTO `rented_clothes` (`id`, `cloth_name`, `material`, `description`, `image_path`, `category`, `price`, `quantity`, `availability`, `sizes_BW`) VALUES
(11, 'Designer Saree', 'Chiffon/lace/velvet', 'Elevate Your Glam', './uploads_bw_rent/0bb70f9969d2fa406a3252abeb0de625.jpg', 'Saree', 5000.00, 4, 1, 'S, M'),
(12, 'One shoulder jacket and skirt lehenga set', 'Chiffon/lace/velvet', 'Be Fashionable ', './uploads_bw_rent/674cf3a53259b70e63371419c0abbdbc.jpg', 'Saree', 6000.00, 5, 1, 'S, M, L'),
(13, 'Designer Saree', 'Chiffon/lace/velvet', 'Be Glamorous ', './uploads_bw_rent/7426f459332faf8b71737a7482a00a06.jpg', 'Saree', 5500.00, 8, 1, 'S, M, L, XL, XXL');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_bw`
--

CREATE TABLE `reviews_bw` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_bridal_wear`
--
ALTER TABLE `category_bridal_wear`
  ADD PRIMARY KEY (`category_id_BW`);

--
-- Indexes for table `clothing_items`
--
ALTER TABLE `clothing_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clothing_items_bridal_wear`
--
ALTER TABLE `clothing_items_bridal_wear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `custom_clothes`
--
ALTER TABLE `custom_clothes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cus_dp`
--
ALTER TABLE `cus_dp`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements_bl`
--
ALTER TABLE `measurements_bl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `rental_orders`
--
ALTER TABLE `rental_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `rented_clothes`
--
ALTER TABLE `rented_clothes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reviews_bw`
--
ALTER TABLE `reviews_bw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category_bridal_wear`
--
ALTER TABLE `category_bridal_wear`
  MODIFY `category_id_BW` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clothing_items`
--
ALTER TABLE `clothing_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `clothing_items_bridal_wear`
--
ALTER TABLE `clothing_items_bridal_wear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `custom_clothes`
--
ALTER TABLE `custom_clothes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cus_dp`
--
ALTER TABLE `cus_dp`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `measurements_bl`
--
ALTER TABLE `measurements_bl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rental_orders`
--
ALTER TABLE `rental_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rented_clothes`
--
ALTER TABLE `rented_clothes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews_bw`
--
ALTER TABLE `reviews_bw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD CONSTRAINT `customer_profile_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `clothing_items` (`id`);

--
-- Constraints for table `reviews_bw`
--
ALTER TABLE `reviews_bw`
  ADD CONSTRAINT `reviews_bw_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `clothing_items_bridal_wear` (`id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`id`) REFERENCES `clothing_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
