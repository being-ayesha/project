-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 12:25 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rocketr`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_settings`
--

CREATE TABLE `account_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `seller_page_description` longtext COLLATE utf8mb4_unicode_ci,
  `google_track_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_track_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipn_status` tinyint(4) DEFAULT NULL,
  `ipn_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_email_product_sold` tinyint(4) DEFAULT NULL COMMENT 'Receive email when product is sold',
  `receive_email_unsuccessfull_login` tinyint(4) DEFAULT NULL COMMENT 'Receive an e-mail when someone unsuccessfully attempts to login to your account',
  `receive_email_site_tips_updates` tinyint(4) DEFAULT NULL COMMENT 'Receive an e-mail with Rocketr tips and update',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_settings`
--

INSERT INTO `account_settings` (`id`, `seller_id`, `seller_page_description`, `google_track_code`, `fb_track_code`, `ipn_status`, `ipn_secret`, `receive_email_product_sold`, `receive_email_unsuccessfull_login`, `receive_email_site_tips_updates`, `created_at`, `updated_at`) VALUES
(1, 2, 'sdafsdfasdf afsadfsdafsda', 'asdfsadfsdaasdfsad asdfsa', 'asdfsdafsdaf afdsafsadfsdaf', 0, 'sdfgdsfgdfsgfds', 1, 1, 1, '2018-11-01 00:22:24', '2018-11-02 22:37:06'),
(2, 1, NULL, NULL, NULL, 0, '123', 0, 0, 0, '2018-11-05 00:15:03', '2018-11-05 00:15:09'),
(3, 4, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2018-11-05 04:41:34', '2018-11-05 04:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_methods` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_structure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_off` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stock` int(11) NOT NULL,
  `number_of_uses` int(11) NOT NULL,
  `deleted_at` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `seller_id`, `product_ids`, `payment_methods`, `coupon_code`, `discount_structure`, `amount_off`, `start_date`, `expiry_date`, `stock`, `number_of_uses`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 1, '[\"1\",\"2\"]', '[\"1\"]', '500', 'amount', '10', '2018-11-05 05:11:23', '2018-11-08 01:00:00', 1, 0, 1, '2018-11-01 05:52:49', '2018-11-04 23:11:23'),
(9, 1, '[\"2\"]', '[\"1\"]', 'kk', 'percent', '47', '2018-11-03 08:27:57', '2018-11-06 20:00:00', -1, 0, NULL, '2018-11-01 06:04:51', '2018-11-03 02:27:57'),
(10, 1, '[\"1\"]', '[\"1\"]', 'New456', 'amount', '5', '2018-11-03 08:18:02', '2018-11-02 05:00:00', 1, 0, 1, '2018-11-01 06:05:51', '2018-11-03 02:18:02'),
(11, 2, '[\"3\",\"4\"]', '[\"1\"]', 'rqwerweqrweq', 'percent', '3', '2018-11-03 19:08:45', '2018-11-04 00:00:00', -1, 0, NULL, '2018-11-04 07:08:45', '2018-11-04 07:08:45'),
(12, 4, '[\"8\"]', '[\"1\"]', 'VACATION', 'percent', '10', '2018-11-05 04:45:51', '2018-11-21 03:00:00', 1, 0, NULL, '2018-11-05 04:45:51', '2018-11-05 04:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `merchant_tier_id` int(10) UNSIGNED DEFAULT NULL,
  `merchant_uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique id for each merchant',
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci,
  `address_line_2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_description` text COLLATE utf8mb4_unicode_ci,
  `business_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `user_id`, `merchant_tier_id`, `merchant_uuid`, `first_name`, `last_name`, `address_line_1`, `address_line_2`, `city`, `state`, `postal_code`, `country`, `business_name`, `business_description`, `business_company`, `merchant_website`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'NOPZEJGRA90XS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-31 07:16:03', '2018-10-31 07:16:03'),
(2, 2, NULL, 'HHJ7ZZZILHXJL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-31 07:20:14', '2018-10-31 07:20:14'),
(3, 3, NULL, 'M5BIDTOBZQTG2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-05 04:29:33', '2018-11-05 04:29:33'),
(4, 4, NULL, 'WSZPSZGXO4ULE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-05 04:30:58', '2018-11-05 04:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_tiers`
--

CREATE TABLE `merchant_tiers` (
  `id` int(10) UNSIGNED NOT NULL,
  `tier_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_processing_time` int(11) DEFAULT NULL,
  `annual_processing_time` int(11) DEFAULT NULL,
  `tier_verfication` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `tier_documentation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tier_ein` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_06_053909_create_user_details_table', 1),
(4, '2018_10_06_054045_create_merchant_tiers_table', 1),
(5, '2018_10_06_054150_create_seller_groups_table', 1),
(6, '2018_10_06_054236_create_merchants_table', 1),
(7, '2018_10_06_054325_create_sellers_table', 1),
(8, '2018_10_06_063924_create_product_types_table', 1),
(9, '2018_10_06_064712_create_products_table', 1),
(10, '2018_10_06_082455_create_product_social_options_table', 1),
(11, '2018_10_06_082536_create_product_groups_table', 1),
(12, '2018_10_06_083909_create_payment_methods_table', 1),
(13, '2018_10_06_084125_create_orders_table', 1),
(14, '2018_10_06_084204_create_payment_details_table', 1),
(15, '2018_10_30_103718_create_coupons_table', 1),
(16, '2018_10_31_124022_create_account_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_activate_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_referer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `affiliate_info` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `seller_id`, `product_id`, `order_uuid`, `buyer_email`, `buyer_country`, `buyer_ip`, `coupon_code`, `coupon_activate_date`, `http_referer`, `amount`, `payment_method_id`, `product_quantity`, `payment_status`, `delivery_status`, `order_date`, `affiliate_info`, `notes`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'SHA1542545', 'atik@gmail.com', 'Bangladesh', '192.168.0.1', '11', '2018-11', 'new', '100.00', 1, 10, 'unpaid', 'Yes', '2018-11-01 10:10:10', '123', '123', NULL, NULL),
(9, 1, 1, 'DA548', 'shakil@gmail.com', 'Bangladesh', '192.168.0.1', '8', '2018-11', 'new', '100.00', 1, 10, 'paid', 'Yes', '2018-11-01 10:10:10', '123', '123', NULL, NULL),
(11, 1, 1, '542545', 'atik@gmail.com', 'Bangladesh', '192.168.0.1', '11', '2018-11', 'new', '100.00', 1, 10, 'unpaid', 'Yes', '2018-11-01 10:10:10', '123', '123', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Generate unique id for each transaction',
  `payment_status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` decimal(8,2) DEFAULT NULL,
  `payment_method_fees` decimal(8,2) DEFAULT NULL,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_address` text COLLATE utf8mb4_unicode_ci,
  `receiver_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_fee` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_type_id` int(10) UNSIGNED NOT NULL,
  `product_uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique for each product',
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `product_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloadable_file` text COLLATE utf8mb4_unicode_ci COMMENT 'For only product type file',
  `stock` int(11) NOT NULL COMMENT '-1 for unlimited',
  `limit_downloads` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For only product type file',
  `watermark_pdf_file` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For only product type file',
  `price` int(10) UNSIGNED NOT NULL,
  `payment_method_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_purchase_permission` int(11) DEFAULT NULL COMMENT '0 for all buyers can purchase,1 for buyers except my blacklist',
  `product_delivery_email_message` text COLLATE utf8mb4_unicode_ci COMMENT 'Product delivery email information',
  `code_separator` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For only code/serial based products',
  `added_codes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For only code/serial base products',
  `codes_purchase_permission` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'If yes then unlimited For only code/serial based products',
  `purchase_limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '-1 for unlimited',
  `affiliate_permission` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `affiliate_rate` decimal(8,2) DEFAULT NULL COMMENT 'Rate in percentage (%)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `product_type_id`, `product_uuid`, `product_title`, `product_description`, `product_photo`, `downloadable_file`, `stock`, `limit_downloads`, `watermark_pdf_file`, `price`, `payment_method_id`, `buyer_purchase_permission`, `product_delivery_email_message`, `code_separator`, `added_codes`, `codes_purchase_permission`, `purchase_limit`, `affiliate_permission`, `affiliate_rate`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'FSM4AAMZY9LDK', 'E Learning', 'new', '1540991995_Capture.PNG', NULL, 2, NULL, NULL, 10, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, '[\"5\",\"10\"]', 'No', '1', 'No', NULL, '2018-10-31 07:19:55', '2018-10-31 07:19:55'),
(2, 1, 1, 'X85MFCUI63TAW', 'Rocketr', 'new', '1540992100_car.png', '1540992100_car.png', -1, NULL, NULL, 5, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'No', NULL, '2018-10-31 07:21:40', '2018-10-31 07:21:40'),
(3, 2, 1, 'MB8TU3EWHS1FD', 'Demo Product', 'Demo Product description', '1541224174_125-fall-in-love.png', '1541224175_apex-logo-xavier-graphics-apex-logo-xavier-graphics.jpg', -1, NULL, NULL, 44, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'No', NULL, '2018-11-02 23:49:35', '2018-11-02 23:49:35'),
(4, 2, 2, '1GVHJRP0NF45T', 'Demo Product for code', 'Demo description for code product', '1541224224_58428e7da6515b1e0ad75ab5.png', NULL, 6, NULL, NULL, 30, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, '[\"eee\",\"ee\",\"eee\",\"e\",\"eee\",\"ed\"]', 'No', '1', 'No', NULL, '2018-11-02 23:50:24', '2018-11-03 04:10:18'),
(5, 2, 3, 'P77EJ8C4ZXFPX', 'Service Prodcut title', 'Description', '1541235711_apex-logo-xavier-graphics-apex-logo-xavier-graphics.jpg', NULL, -1, NULL, NULL, 44, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, 'No', '5', 'No', NULL, '2018-11-03 03:01:52', '2018-11-03 03:01:52'),
(6, 2, 3, 'Q08TJLN42MUYP', 'Service product title 2', 'qrerweqrweqrweqrweq', '1541235739_bata.png', NULL, -1, NULL, NULL, 44, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, 'No', '4', 'No', NULL, '2018-11-03 03:02:19', '2018-11-03 03:02:19'),
(7, 2, 1, 'YBABQPL9V0I92', 'Digital file product', 'Digital file product to description', '1541245421_90fdb6c4-7ba9-408f-9074-29db0f48dad3-original.jpeg', '1541245422_index4.jpg', -1, NULL, NULL, 22, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'No', NULL, '2018-11-03 05:43:42', '2018-11-03 05:43:42'),
(8, 4, 1, 'DXVIH033DTRFZ', 'Document', 'New document', '1541414619_car.png', '1541414599_google-dont-be-evil.jpg', -1, NULL, NULL, 5, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'No', NULL, '2018-11-05 04:43:19', '2018-11-05 04:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_groups`
--

CREATE TABLE `product_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_group_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_groups`
--

INSERT INTO `product_groups` (`id`, `seller_id`, `product_id`, `product_group_title`, `created_at`, `updated_at`) VALUES
(2, 2, '[\"3\",\"4\"]', 'Demo Group title', '2018-11-02 23:50:32', '2018-11-02 23:50:32'),
(3, 2, '[\"3\"]', 'New Product group', '2018-11-02 23:50:46', '2018-11-02 23:50:46'),
(4, 2, '[\"4\"]', 'Another New Group', '2018-11-02 23:50:57', '2018-11-02 23:50:57'),
(6, 2, '[\"3\",\"4\",\"5\",\"6\"]', 'Service Product group', '2018-11-03 03:02:46', '2018-11-03 03:02:46'),
(7, 2, '[\"3\",\"4\",\"5\",\"6\",\"7\"]', 'Service Product group title goes here.', '2018-11-03 04:47:25', '2018-11-03 05:45:48'),
(9, 4, '[\"8\"]', 'Books', '2018-11-05 04:44:16', '2018-11-05 04:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_social_options`
--

CREATE TABLE `product_social_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `social_platform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_social_options`
--

INSERT INTO `product_social_options` (`id`, `seller_id`, `product_id`, `social_platform_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'facebook', 'Inactive', '2018-10-31 07:19:55', '2018-10-31 07:19:55'),
(2, 1, 1, 'twitter', 'Inactive', '2018-10-31 07:19:55', '2018-10-31 07:19:55'),
(3, 1, 1, 'pininterest', 'Inactive', '2018-10-31 07:19:55', '2018-10-31 07:19:55'),
(4, 1, 2, 'facebook', 'Inactive', '2018-10-31 07:21:40', '2018-10-31 07:21:40'),
(5, 1, 2, 'twitter', 'Inactive', '2018-10-31 07:21:40', '2018-10-31 07:21:40'),
(6, 1, 2, 'pininterest', 'Inactive', '2018-10-31 07:21:40', '2018-10-31 07:21:40'),
(7, 2, 3, 'facebook', 'Active', '2018-11-02 23:49:35', '2018-11-02 23:49:35'),
(8, 2, 3, 'twitter', 'Active', '2018-11-02 23:49:35', '2018-11-02 23:49:35'),
(9, 2, 3, 'pininterest', 'Inactive', '2018-11-02 23:49:35', '2018-11-02 23:49:35'),
(10, 2, 4, 'facebook', 'Inactive', '2018-11-02 23:50:24', '2018-11-03 04:10:18'),
(11, 2, 4, 'twitter', 'Active', '2018-11-02 23:50:24', '2018-11-03 04:10:18'),
(12, 2, 4, 'pininterest', 'Inactive', '2018-11-02 23:50:24', '2018-11-03 04:10:18'),
(13, 2, 5, 'facebook', 'Inactive', '2018-11-03 03:01:52', '2018-11-03 03:01:52'),
(14, 2, 5, 'twitter', 'Active', '2018-11-03 03:01:53', '2018-11-03 03:01:53'),
(15, 2, 5, 'pininterest', 'Active', '2018-11-03 03:01:53', '2018-11-03 03:01:53'),
(16, 2, 6, 'facebook', 'Active', '2018-11-03 03:02:19', '2018-11-03 03:02:19'),
(17, 2, 6, 'twitter', 'Active', '2018-11-03 03:02:20', '2018-11-03 03:02:20'),
(18, 2, 6, 'pininterest', 'Inactive', '2018-11-03 03:02:20', '2018-11-03 03:02:20'),
(19, 2, 7, 'facebook', 'Active', '2018-11-03 05:43:42', '2018-11-03 05:43:42'),
(20, 2, 7, 'twitter', 'Active', '2018-11-03 05:43:42', '2018-11-03 05:43:42'),
(21, 2, 7, 'pininterest', 'Inactive', '2018-11-03 05:43:42', '2018-11-03 05:43:42'),
(22, 4, 8, 'facebook', 'Active', '2018-11-05 04:43:19', '2018-11-05 04:46:39'),
(23, 4, 8, 'twitter', 'Active', '2018-11-05 04:43:19', '2018-11-05 04:46:39'),
(24, 4, 8, 'pininterest', 'Inactive', '2018-11-05 04:43:19', '2018-11-05 04:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'File', 'File Download', NULL, NULL, NULL),
(2, 'Code', 'Code/Serials', NULL, NULL, NULL),
(3, 'Service', 'For Service', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `seller_group_id` int(10) UNSIGNED DEFAULT NULL,
  `seller_uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique for each seller',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `seller_group_id`, `seller_uuid`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '4NGJZHXOEXDMQ', '2018-10-31 07:16:03', '2018-10-31 07:16:03'),
(2, 2, NULL, 'GTNR0HYUHAGBO', '2018-10-31 07:20:14', '2018-10-31 07:20:14'),
(3, 3, NULL, '2BFBEXSOKVGDJ', '2018-11-05 04:29:33', '2018-11-05 04:29:33'),
(4, 4, NULL, 'PXXT2GXCASDF3', '2018-11-05 04:30:58', '2018-11-05 04:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `seller_groups`
--

CREATE TABLE `seller_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`, `status`, `profile_photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Atik', NULL, 'shakil.techvill@gmail.com', '$2y$10$shSF9CVJd1Yo23U9agHLPulHihdVDdzzlGPjQDSUO3JVE2xcTPFDW', 'Active', NULL, 'fp0Il74wJg914BRGO0pLdMas1Fr3gB9vY821sVXsIbOz5d0lK3paesYY9Gk8', '2018-10-31 07:16:03', '2018-10-31 07:16:03'),
(2, 'aminultechvill', NULL, 'aminul.techvill@gmail.com', '$2y$10$XhU4Zf4AermwByjY9PVKueQaVKmz7bfP8zBrjzRQ89o5woC/Nkb6C', 'Active', '1541337150_147028_d030_9.jpg', 'Kc5NcbDhtC4RiJK6wmvnA2DtMlPI5iwdilSUty4ohcTivoOWSHeVNIy6fCcS', '2018-10-31 07:20:14', '2018-11-04 07:12:30'),
(3, 'Shakil', NULL, 'shakil@gmail.com', '$2y$10$lmf6rNNx7yq8GWJahsK3Ku/6TsY4G.X2rImufG0UJbG4W7jJ8Rb3a', 'Active', NULL, NULL, '2018-11-05 04:29:33', '2018-11-05 04:29:33'),
(4, 'atkjs', NULL, 'atik@gmail.com', '$2y$10$ikSvuUBKdlC6PdCEKLV0zOYstmhR6323alRHEEoQRizRO0E3S1L4y', 'Active', NULL, 'vwkcpvlfhuTa8InhY3eF0CCKvIcPINHdg6QUeVf4CBUN9EF3mgympieLYTnC', '2018-11-05 04:30:57', '2018-11-05 04:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` enum('merchant','seller') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'merchant', '2018-10-31 07:16:03', '2018-10-31 07:16:03'),
(2, 1, 'seller', '2018-10-31 07:16:03', '2018-10-31 07:16:03'),
(3, 2, 'merchant', '2018-10-31 07:20:14', '2018-10-31 07:20:14'),
(4, 2, 'seller', '2018-10-31 07:20:14', '2018-10-31 07:20:14'),
(5, 3, 'merchant', '2018-11-05 04:29:33', '2018-11-05 04:29:33'),
(6, 3, 'seller', '2018-11-05 04:29:33', '2018-11-05 04:29:33'),
(7, 4, 'merchant', '2018-11-05 04:30:57', '2018-11-05 04:30:57'),
(8, 4, 'seller', '2018-11-05 04:30:57', '2018-11-05 04:30:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_settings`
--
ALTER TABLE `account_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_settings_seller_id_index` (`seller_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`),
  ADD KEY `coupons_seller_id_index` (`seller_id`),
  ADD KEY `coupons_product_ids_index` (`product_ids`),
  ADD KEY `coupons_payment_methods_index` (`payment_methods`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_merchant_uuid_unique` (`merchant_uuid`),
  ADD KEY `merchants_id_index` (`id`),
  ADD KEY `merchants_user_id_index` (`user_id`),
  ADD KEY `merchants_merchant_tier_id_index` (`merchant_tier_id`);

--
-- Indexes for table `merchant_tiers`
--
ALTER TABLE `merchant_tiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_tiers_id_index` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_uuid_unique` (`order_uuid`),
  ADD KEY `orders_id_index` (`id`),
  ADD KEY `orders_seller_id_index` (`seller_id`),
  ADD KEY `orders_product_id_index` (`product_id`),
  ADD KEY `payment_method_id_index` (`payment_method_id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_details_transaction_id_unique` (`transaction_id`),
  ADD KEY `payment_details_id_index` (`id`),
  ADD KEY `payment_details_order_id_index` (`order_id`),
  ADD KEY `payment_details_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_name_unique` (`name`),
  ADD KEY `payment_methods_id_index` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_title_unique` (`product_title`),
  ADD UNIQUE KEY `products_product_uuid_unique` (`product_uuid`),
  ADD KEY `products_id_index` (`id`),
  ADD KEY `products_seller_id_index` (`seller_id`),
  ADD KEY `products_product_type_id_index` (`product_type_id`),
  ADD KEY `products_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `product_groups`
--
ALTER TABLE `product_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_groups_product_group_title_unique` (`product_group_title`),
  ADD KEY `product_groups_id_index` (`id`),
  ADD KEY `product_groups_seller_id_index` (`seller_id`);

--
-- Indexes for table `product_social_options`
--
ALTER TABLE `product_social_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_social_options_id_index` (`id`),
  ADD KEY `product_social_options_seller_id_index` (`seller_id`),
  ADD KEY `product_social_options_product_id_index` (`product_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_id_index` (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_seller_uuid_unique` (`seller_uuid`),
  ADD KEY `sellers_id_index` (`id`),
  ADD KEY `sellers_user_id_index` (`user_id`),
  ADD KEY `sellers_seller_group_id_index` (`seller_group_id`);

--
-- Indexes for table `seller_groups`
--
ALTER TABLE `seller_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_groups_id_index` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_id_index` (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_id_index` (`id`),
  ADD KEY `user_details_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_settings`
--
ALTER TABLE `account_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchant_tiers`
--
ALTER TABLE `merchant_tiers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_groups`
--
ALTER TABLE `product_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_social_options`
--
ALTER TABLE `product_social_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_groups`
--
ALTER TABLE `seller_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_settings`
--
ALTER TABLE `account_settings`
  ADD CONSTRAINT `account_settings_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`user_id`);

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_merchant_tier_id_foreign` FOREIGN KEY (`merchant_tier_id`) REFERENCES `merchant_tiers` (`id`),
  ADD CONSTRAINT `merchants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `payment_details_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`),
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`user_id`);

--
-- Constraints for table `product_groups`
--
ALTER TABLE `product_groups`
  ADD CONSTRAINT `product_groups_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `product_social_options`
--
ALTER TABLE `product_social_options`
  ADD CONSTRAINT `product_social_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_social_options_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_seller_group_id_foreign` FOREIGN KEY (`seller_group_id`) REFERENCES `seller_groups` (`id`),
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
