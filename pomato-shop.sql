-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pomatoshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_infos`
--

CREATE TABLE `about_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_infos`
--

INSERT INTO `about_infos` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Our story', 'Welcome to our mobile phone store! Our story begins with a passion for technology and a desire to provide all users with access to the latest and highest quality mobile devices. With decades of experience in the industry, we proudly continue to provide superior service and products to meet your needs.', NULL, '2024-05-17 16:39:10'),
(2, 'Our team', 'Our team consists of experts from various fields, dedicated to providing you with superior service and support. They are ready to help you choose the best mobile device that suits your needs.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE `baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `datum` timestamp NOT NULL DEFAULT '2024-05-16 10:53:30',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket_products`
--

CREATE TABLE `basket_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `basket_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '2024-04-16 16:04:42', '2024-04-16 16:04:42'),
(2, 'Samsung', '2024-04-16 16:04:42', '2024-04-16 16:04:42'),
(3, 'Xiaomi', '2024-04-16 16:04:42', '2024-04-16 16:04:42'),
(4, 'Huawei', '2024-04-16 16:04:42', '2024-04-16 16:04:42'),
(5, 'Honor', '2024-04-16 16:04:42', '2024-04-16 16:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `client_comments`
--

CREATE TABLE `client_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activeClass` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_comments`
--

INSERT INTO `client_comments` (`id`, `name`, `content`, `active`, `activeClass`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'Buying a phone is extremely satisfying. The phone I chose is fast and in perfect condition. Also, customer support was very efficient and friendly.', 1, 0, '2024-05-14 22:03:34', NULL),
(2, 'Jane Smith', 'Perfect phone shopping experience! The selection of phones is huge, and the buying process is simple and intuitive. All recommendations for this web shop.', 1, 1, '2024-05-14 22:03:34', NULL),
(3, 'Michael Johnson ', 'The quality of products and services on the site are at the highest level! The phone I bought met all my expectations, and the delivery was fast and without problems. I will definitely shop here again.', 1, 0, '2024-05-14 22:03:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `hex` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `value`, `hex`) VALUES
(1, 'black', '#000000'),
(2, 'white', '#ffffff'),
(3, 'blue', '#0000FF'),
(4, 'red', '#FF0000');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` float DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `amount`, `start_date`, `end_date`, `active`, `product_id`, `created_at`, `updated_at`) VALUES
(21, 17, '2024-06-27 13:58:16', '2024-06-27 11:58:16', 0, 1, '2024-05-17 12:34:44', '2024-06-27 11:58:16'),
(22, 30, '2024-06-27 13:58:18', '2024-06-27 11:58:18', 0, 1, '2024-05-17 12:37:57', '2024-06-27 11:58:18'),
(23, 15, '2024-06-27 13:58:16', '2024-06-27 11:58:16', 0, 1, '2024-05-17 12:56:37', '2024-06-27 11:58:16'),
(24, 35, '2024-06-27 13:58:16', '2024-06-27 11:58:16', 0, 1, '2024-05-17 13:03:10', '2024-06-27 11:58:16'),
(25, 15, '2024-06-27 13:58:23', NULL, 1, 4, '2024-05-17 13:05:57', '2024-06-27 11:58:23'),
(26, 20, '2024-05-17 13:06:05', NULL, 1, 23, '2024-05-17 13:06:05', '2024-05-17 13:06:05'),
(27, 19, '2024-05-17 21:55:56', NULL, 1, 29, '2024-05-17 21:55:56', '2024-05-17 21:55:56'),
(28, 10, '2024-05-17 21:56:12', NULL, 1, 27, '2024-05-17 21:56:12', '2024-05-17 21:56:12'),
(29, 10, '2024-06-27 13:57:25', '2024-06-27 11:57:25', 0, 33, '2024-06-27 11:56:16', '2024-06-27 11:57:25'),
(30, 15, '2024-06-27 11:57:25', NULL, 1, 33, '2024-06-27 11:57:25', '2024-06-27 11:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `location`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Zdravka Čelara 16, Beograd', '+381658976611', 'pomatoinfo@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `internal_memories`
--

CREATE TABLE `internal_memories` (
  `id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internal_memories`
--

INSERT INTO `internal_memories` (`id`, `value`) VALUES
(1, '32'),
(2, '64'),
(3, '128'),
(4, '256');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `route`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', 0, NULL, NULL),
(2, 'About', 'about', 1, NULL, NULL),
(3, 'Products', 'products', 2, NULL, NULL),
(4, 'Contact', 'contact', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `message`, `ip_address`, `created_at`, `updated_at`) VALUES
(7, 'Proba', 'proba123@gmail.com', '0655865112', 'Poruka iz kontakt forme', '127.0.0.1', '2024-05-17 13:49:17', '2024-05-17 13:49:17'),
(8, 'Ime', 'email@gmail.com', '045432425', 'Poruka', '127.0.0.1', '2024-05-17 20:50:53', '2024-05-17 20:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_15_133458_create_menus_table', 1),
(6, '2024_04_15_192759_create_roles_table', 2),
(7, '2024_04_15_193347_create_users_table', 3),
(8, '2024_04_16_175844_create_brands_table', 4),
(9, '2024_04_16_223735_create_screens_table', 5),
(11, '2024_04_16_223224_create_products_table', 6),
(12, '2024_04_16_232233_create_prices_table', 7),
(13, '2024_05_12_121313_create_messages_table', 8),
(14, '2024_05_14_094022_create_social_table', 9),
(15, '2024_05_14_112247_create_socials_table', 10),
(17, '2024_05_14_113837_create_sliders_table', 11),
(18, '2024_05_14_135200_create_informations_table', 12),
(20, '2024_05_14_172651_create_about_info_table', 13),
(21, '2024_05_14_215543_create_client_comments', 14),
(23, '2024_05_14_224823_create_discounts_table', 15),
(24, '2024_05_16_125108_create_baskets_table', 16),
(25, '2024_05_16_125351_create_basket_products_table', 17),
(26, '2024_05_16_145416_create_user_actions_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `product_id`, `price`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 799.99, 1, '2024-04-16 21:29:53', '2024-05-17 10:41:45'),
(2, 2, 899.99, 0, '2024-04-16 21:29:53', '2024-05-17 13:32:57'),
(3, 3, 939.99, 1, '2024-04-16 21:29:53', '2024-04-16 21:29:53'),
(4, 4, 399.99, 1, NULL, NULL),
(9, 23, 372.00, 1, '2024-05-17 11:02:04', '2024-05-17 13:22:33'),
(10, 2, 799.99, 1, '2024-05-17 13:32:57', '2024-05-17 13:32:57'),
(11, 24, 459.00, 1, '2024-05-17 21:45:54', '2024-05-17 21:45:54'),
(12, 25, 659.00, 1, '2024-05-17 21:46:44', '2024-05-17 21:46:44'),
(13, 26, 679.00, 1, '2024-05-17 21:47:52', '2024-05-17 21:47:52'),
(14, 27, 899.00, 1, '2024-05-17 21:48:33', '2024-05-17 21:48:33'),
(15, 28, 799.00, 1, '2024-05-17 21:49:26', '2024-05-17 21:49:26'),
(16, 29, 989.00, 1, '2024-05-17 21:50:18', '2024-05-17 21:50:18'),
(17, 30, 999.00, 1, '2024-05-17 21:50:55', '2024-05-17 21:50:55'),
(18, 31, 499.00, 1, '2024-05-17 21:51:35', '2024-05-17 21:51:35'),
(19, 32, 739.00, 1, '2024-05-17 21:52:56', '2024-05-17 21:52:56'),
(20, 33, 699.00, 0, '2024-05-17 21:53:40', '2024-06-27 11:55:00'),
(21, 34, 399.00, 1, '2024-05-17 21:54:52', '2024-05-17 21:54:52'),
(22, 35, 899.00, 1, '2024-05-17 21:55:30', '2024-05-17 21:55:30'),
(23, 33, 735.00, 1, '2024-06-27 11:55:00', '2024-06-27 11:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `screen_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand_id`, `screen_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Iphone 12', 1, 1, 'iphone12.webp', '2024-04-16 20:58:23', '2024-05-17 10:41:45'),
(2, 'Iphone 13', 1, 1, 'iphone13-black128gb.webp', '2024-04-16 20:58:23', '2024-04-16 20:58:23'),
(3, 'Iphone 13', 1, 1, 'iphone13-pink128gb.webp', '2024-04-16 20:58:23', '2024-04-16 20:58:23'),
(4, 'A20', 2, 2, 'samsung-A20-32gb.webp', NULL, NULL),
(23, 'S21', 2, 3, 's21.webp', '2024-05-17 11:02:04', '2024-05-17 11:02:04'),
(24, 'x7', 5, 3, 'honorx7-128.webp', '2024-05-17 21:45:54', '2024-05-17 21:45:54'),
(25, 'x8', 5, 2, 'honorx8-128.webp', '2024-05-17 21:46:44', '2024-05-17 21:46:44'),
(26, 'p30', 4, 2, 'huaweip30pro-128.webp', '2024-05-17 21:47:52', '2024-05-17 21:47:52'),
(27, 'p40 pro', 4, 1, 'huaweip40pro-256-crystal.webp', '2024-05-17 21:48:33', '2024-05-17 21:48:33'),
(28, 'iphone13 pro', 1, 1, 'iphone13-pro.webp', '2024-05-17 21:49:26', '2024-05-17 21:49:26'),
(29, 'Iphone 14 plus', 1, 1, 'iphone14plus.webp', '2024-05-17 21:50:18', '2024-05-17 21:50:18'),
(30, 'iphone 15', 1, 1, 'iphone15pro.webp', '2024-05-17 21:50:55', '2024-05-17 21:50:55'),
(31, 'iPhone XS', 1, 2, 'iphonexs.webp', '2024-05-17 21:51:35', '2024-05-17 21:51:35'),
(32, 'A53', 2, 1, 'samsung-A53-128gb.webp', '2024-05-17 21:52:56', '2024-05-17 21:52:56'),
(33, 'A71', 2, 1, 'samsung-A71-128gb.webp', '2024-05-17 21:53:40', '2024-05-17 21:53:40'),
(34, '11t PRO', 3, 2, 'xiaomi11tpro-256gb.webp', '2024-05-17 21:54:52', '2024-05-17 21:54:52'),
(35, 's23', 2, 1, 'samsungS23-256gb.webp', '2024-05-17 21:55:30', '2024-05-17 21:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `product_id`, `color_id`, `active`, `start_date`, `end_date`) VALUES
(1, 4, 2, 1, '2024-05-15', NULL),
(2, 1, 4, 1, '2024-05-15', NULL),
(3, 2, 3, 1, '2024-05-15', NULL),
(4, 3, 1, 1, '2024-05-15', NULL),
(12, 23, 3, 1, '2024-05-17', NULL),
(13, 24, 1, 1, '2024-05-17', NULL),
(14, 25, 3, 1, '2024-05-17', NULL),
(15, 26, 2, 1, '2024-05-17', NULL),
(16, 27, 2, 1, '2024-05-17', NULL),
(17, 28, 2, 1, '2024-05-17', NULL),
(18, 29, 3, 1, '2024-05-17', NULL),
(19, 30, 1, 1, '2024-05-17', NULL),
(20, 31, 2, 1, '2024-05-17', NULL),
(21, 32, 3, 1, '2024-05-17', NULL),
(22, 33, 4, 1, '2024-05-17', NULL),
(23, 34, 2, 1, '2024-05-17', NULL),
(24, 35, 2, 1, '2024-05-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_internal`
--

CREATE TABLE `product_internal` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `internal_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_internal`
--

INSERT INTO `product_internal` (`id`, `product_id`, `internal_id`, `active`, `start_date`, `end_date`) VALUES
(1, 4, 2, 1, '2024-05-15 22:54:38', NULL),
(2, 1, 3, 1, '2024-05-15 22:54:38', NULL),
(3, 2, 4, 1, '2024-05-15 22:54:38', NULL),
(4, 3, 4, 1, '2024-05-15 22:54:38', NULL),
(9, 23, 2, 1, '2024-05-17 13:02:04', NULL),
(10, 24, 3, 1, '2024-05-17 23:45:54', NULL),
(11, 25, 3, 1, '2024-05-17 23:46:44', NULL),
(12, 26, 3, 1, '2024-05-17 23:47:52', NULL),
(13, 27, 4, 1, '2024-05-17 23:48:33', NULL),
(14, 28, 3, 1, '2024-05-17 23:49:26', NULL),
(15, 29, 4, 1, '2024-05-17 23:50:18', NULL),
(16, 30, 4, 1, '2024-05-17 23:50:55', NULL),
(17, 31, 2, 1, '2024-05-17 23:51:35', NULL),
(18, 32, 3, 1, '2024-05-17 23:52:56', NULL),
(19, 33, 3, 1, '2024-05-17 23:53:40', NULL),
(20, 34, 3, 1, '2024-05-17 23:54:52', NULL),
(21, 35, 4, 1, '2024-05-17 23:55:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_ram`
--

CREATE TABLE `product_ram` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ram_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_ram`
--

INSERT INTO `product_ram` (`id`, `product_id`, `ram_id`, `active`, `start_date`, `end_date`) VALUES
(1, 4, 2, 1, '2024-05-15', NULL),
(2, 1, 3, 1, '2024-05-15', NULL),
(3, 2, 4, 1, '2024-05-15', NULL),
(4, 3, 4, 1, '2024-05-15', NULL),
(9, 23, 1, 1, '2024-05-17', NULL),
(10, 24, 2, 1, '2024-05-17', NULL),
(11, 25, 3, 1, '2024-05-17', NULL),
(12, 26, 3, 1, '2024-05-17', NULL),
(13, 27, 4, 1, '2024-05-17', NULL),
(14, 28, 3, 1, '2024-05-17', NULL),
(15, 29, 4, 1, '2024-05-17', NULL),
(16, 30, 4, 1, '2024-05-17', NULL),
(17, 31, 2, 1, '2024-05-17', NULL),
(18, 32, 3, 1, '2024-05-17', NULL),
(19, 33, 3, 1, '2024-05-17', NULL),
(20, 34, 2, 1, '2024-05-17', NULL),
(21, 35, 3, 1, '2024-05-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ram_memories`
--

CREATE TABLE `ram_memories` (
  `id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ram_memories`
--

INSERT INTO `ram_memories` (`id`, `value`) VALUES
(1, '4'),
(2, '8'),
(3, '12'),
(4, '16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'korisnik', '2024-04-15 17:45:33', '2024-04-15 17:45:33'),
(2, 'administrator', '2024-04-15 17:45:33', '2024-04-15 17:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `screen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `screen`, `created_at`, `updated_at`) VALUES
(1, 'OLED', '2024-04-16 20:43:48', '2024-04-16 20:43:48'),
(2, 'AMOLED', '2024-04-16 20:43:48', '2024-04-16 20:43:48'),
(3, 'IPS', '2024-04-16 20:43:48', '2024-04-16 20:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `activeClass` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `subtitle`, `description`, `active`, `activeClass`, `created_at`, `updated_at`) VALUES
(1, 'banner.jpg', 'All New Phones', 'up to 25% Flat Sale', 'Discover our latest collection of smartphones at discounted prices. Hurry up and grab the best deals now!', 1, 0, NULL, '2024-05-17 20:07:46'),
(2, 'banner2.jpg', 'Exclusive Offers', 'Limited Time Deals', 'Explore our exclusive offers on a wide range of products. Don\\\'t miss out on these limited time deals!', 1, 1, NULL, '2024-05-17 19:31:32'),
(3, 'banner3.jpg', 'New Arrivals', 'Be the First to Get Them', 'Be among the first to get your hands on the latest arrivals in our store. Shop now and stay ahead of the trend!', 1, 0, NULL, '2024-05-17 19:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `iClass` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `name`, `link`, `iClass`, `active`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/', 'fa fa-facebook-f', 1, NULL, '2024-05-17 20:08:39'),
(2, 'twitter', 'https://twitter.com/', 'fa fa-twitter', 1, NULL, NULL),
(8, 'instagram', 'https://www.instagram.com/', 'fa fa-instagram', 1, '2024-05-17 15:55:58', '2024-05-17 15:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(7, 'Admin', 'Admin', 'admin@gmail.com', '$2y$12$kmNFpmmXBe3jicn0hszQ/OIhLUE//UNEjkoDeeER5Q7MYsoSe3TDG', 2, '2024-09-26 19:36:09', '2024-09-26 19:36:09'),
(8, 'User', 'User', 'user@gmail.com', '$2y$12$jaw.l51JVIRcHT44jmWv5u02XXMszrXR7RzMXs9Mae.InMQMtxud2', 1, '2024-09-26 19:38:05', '2024-09-26 19:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_time` datetime NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_actions`
--

INSERT INTO `user_actions` (`id`, `user_id`, `action`, `action_time`, `ip_address`, `device_type`, `browser`, `created_at`, `updated_at`) VALUES
(45, 7, 'registration', '2024-09-26 21:36:09', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:36:09', '2024-09-26 19:36:09'),
(46, 7, 'login', '2024-09-26 21:36:20', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:36:20', '2024-09-26 19:36:20'),
(47, 7, 'logout', '2024-09-26 21:37:25', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:37:25', '2024-09-26 19:37:25'),
(48, 8, 'registration', '2024-09-26 21:38:05', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:38:05', '2024-09-26 19:38:05'),
(49, 8, 'login', '2024-09-26 21:38:15', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:38:15', '2024-09-26 19:38:15'),
(50, 8, 'logout', '2024-09-26 21:38:30', '127.0.0.1', 'desktop', 'Chrome', '2024-09-26 19:38:30', '2024-09-26 19:38:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_infos`
--
ALTER TABLE `about_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baskets_user_id_foreign` (`user_id`);

--
-- Indexes for table `basket_products`
--
ALTER TABLE `basket_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basket_products_basket_id_foreign` (`basket_id`),
  ADD KEY `basket_products_product_id_foreign` (`product_id`),
  ADD KEY `basket_products_price_id_foreign` (`price_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_comments`
--
ALTER TABLE `client_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_memories`
--
ALTER TABLE `internal_memories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_sctype_id_foreign` (`screen_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `product_internal`
--
ALTER TABLE `product_internal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `internal_id` (`internal_id`);

--
-- Indexes for table `product_ram`
--
ALTER TABLE `product_ram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `ram_id` (`ram_id`);

--
-- Indexes for table `ram_memories`
--
ALTER TABLE `ram_memories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_actions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_infos`
--
ALTER TABLE `about_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `basket_products`
--
ALTER TABLE `basket_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client_comments`
--
ALTER TABLE `client_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internal_memories`
--
ALTER TABLE `internal_memories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_internal`
--
ALTER TABLE `product_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_ram`
--
ALTER TABLE `product_ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ram_memories`
--
ALTER TABLE `ram_memories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baskets`
--
ALTER TABLE `baskets`
  ADD CONSTRAINT `baskets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `basket_products`
--
ALTER TABLE `basket_products`
  ADD CONSTRAINT `basket_products_basket_id_foreign` FOREIGN KEY (`basket_id`) REFERENCES `baskets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_products_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sctype_id_foreign` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_color_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`);

--
-- Constraints for table `product_internal`
--
ALTER TABLE `product_internal`
  ADD CONSTRAINT `product_internal_ibfk_1` FOREIGN KEY (`internal_id`) REFERENCES `internal_memories` (`id`),
  ADD CONSTRAINT `product_internal_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_ram`
--
ALTER TABLE `product_ram`
  ADD CONSTRAINT `product_ram_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_ram_ibfk_2` FOREIGN KEY (`ram_id`) REFERENCES `ram_memories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD CONSTRAINT `user_actions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
