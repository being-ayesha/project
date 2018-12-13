-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2018 at 11:25 AM
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
-- Database: `rocketrtest`
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

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `affiliate_uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique for each affiliate',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_payouts`
--

CREATE TABLE `affiliate_payouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `affiliate_user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_products`
--

CREATE TABLE `affiliate_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `affiliate_id` int(10) UNSIGNED NOT NULL,
  `affiliate_product_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `product_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_methods` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_structure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_off` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `stock` int(11) NOT NULL COMMENT 'Uses Left',
  `number_of_uses` int(11) NOT NULL,
  `deleted_at` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'usd', '&#36;', '1.00', 'Active', NULL, NULL),
(2, 'Pound Sterling', 'gbp', '&pound;', '0.65', 'Active', NULL, NULL),
(3, 'Europe', 'eur', '&euro;', '0.88', 'Active', NULL, NULL),
(4, 'India', 'inr', '&#x20B9;', '66.24', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_campaigns`
--

CREATE TABLE `email_campaigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `campaign_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipients` longtext COLLATE utf8mb4_unicode_ci,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `sent_status` enum('pending','success') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `sent_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, NULL, 'ITZ2B7LKTOLAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-13 04:17:35', '2018-12-13 04:17:35');

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
(9, '2018_10_06_064711_create_payment_methods_table', 1),
(10, '2018_10_06_064712_create_products_table', 1),
(11, '2018_10_06_082455_create_product_social_options_table', 1),
(12, '2018_10_06_082536_create_product_groups_table', 1),
(13, '2018_10_06_084205_create_orders_table', 1),
(14, '2018_10_06_084206_create_payment_details_table', 1),
(15, '2018_10_30_103718_create_coupons_table', 1),
(16, '2018_10_31_124022_create_account_settings_table', 1),
(17, '2018_11_19_053442_create_currencies_table', 1),
(18, '2018_11_19_053443_create_payment_settings_table', 1),
(19, '2018_11_20_125559_create_email_campaigns_table', 1),
(20, '2018_11_21_083535_create_user_logs_table', 1),
(21, '2018_12_04_052101_create_product_views_table', 1),
(22, '2018_12_06_101131_create_product_reviews_table', 1),
(23, '2018_12_08_064628_create_affiliates_table', 1),
(24, '2018_12_08_065022_create_affiliate_products_table', 1),
(25, '2018_12_08_111924_create_affiliate_payouts_table', 1),
(26, '2018_12_09_064337_create_sessions_table', 1);

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
  `coupon_activate_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_referer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `affiliate_user_id` int(10) UNSIGNED NOT NULL,
  `is_affiliated` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `affiliate_amount` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL COMMENT 'Account id is user id which can be seller or merchant',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Account is user which can be seller or merchants',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 1, '4MVKUEUYW9SWY', 'Demo Product', '<p>Demo product Details</p>', '1544696377_logo2.png', NULL, -1, NULL, NULL, 50, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'Yes', '10.00', '2018-12-13 04:19:38', '2018-12-13 04:19:38');

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
(1, 1, '[\"1\"]', 'Demo', '2018-12-13 04:19:58', '2018-12-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `review_count` int(11) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Buyer Comment',
  `response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Owner Response',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 1, 'facebook', 'Active', '2018-12-13 04:19:38', '2018-12-13 04:19:38'),
(2, 1, 1, 'twitter', 'Active', '2018-12-13 04:19:38', '2018-12-13 04:19:38'),
(3, 1, 1, 'pininterest', 'Active', '2018-12-13 04:19:38', '2018-12-13 04:19:38');

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
(1, 'File', NULL, NULL, NULL, NULL),
(2, 'Code', NULL, NULL, NULL, NULL),
(3, 'Service', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_views_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `product_id`, `seller_id`, `browser`, `product_views_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-13', '2018-12-13 04:20:18', '2018-12-13 04:20:18');

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
(1, 1, NULL, 'E3LATXGAJBRM5', '2018-12-13 04:17:35', '2018-12-13 04:17:35');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ty84elEevlUEfsfoQuFMzA3GJ3QoYw8O64B6iKjA', 1, '192.168.0.111', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', 'YTo2OntzOjEyOiJjb3VudHJ5X25hbWUiO2E6MjQ6e3M6MTc6Imdlb3BsdWdpbl9yZXF1ZXN0IjtzOjEzOiIyMjAuMTU4LjIwNS41IjtzOjE2OiJnZW9wbHVnaW5fc3RhdHVzIjtpOjIwMDtzOjE1OiJnZW9wbHVnaW5fZGVsYXkiO3M6MzoiMG1zIjtzOjE2OiJnZW9wbHVnaW5fY3JlZGl0IjtzOjE0NToiU29tZSBvZiB0aGUgcmV0dXJuZWQgZGF0YSBpbmNsdWRlcyBHZW9MaXRlIGRhdGEgY3JlYXRlZCBieSBNYXhNaW5kLCBhdmFpbGFibGUgZnJvbSA8YSBocmVmPVwnaHR0cDovL3d3dy5tYXhtaW5kLmNvbVwnPmh0dHA6Ly93d3cubWF4bWluZC5jb208L2E+LiI7czoxNDoiZ2VvcGx1Z2luX2NpdHkiO3M6NToiRGhha2EiO3M6MTY6Imdlb3BsdWdpbl9yZWdpb24iO3M6MTQ6IkRoYWthIERpdmlzaW9uIjtzOjIwOiJnZW9wbHVnaW5fcmVnaW9uQ29kZSI7czoyOiIxMyI7czoyMDoiZ2VvcGx1Z2luX3JlZ2lvbk5hbWUiO3M6NToiRGhha2EiO3M6MTg6Imdlb3BsdWdpbl9hcmVhQ29kZSI7czowOiIiO3M6MTc6Imdlb3BsdWdpbl9kbWFDb2RlIjtzOjA6IiI7czoyMToiZ2VvcGx1Z2luX2NvdW50cnlDb2RlIjtzOjI6IkJEIjtzOjIxOiJnZW9wbHVnaW5fY291bnRyeU5hbWUiO3M6MTA6IkJhbmdsYWRlc2giO3M6MTQ6Imdlb3BsdWdpbl9pbkVVIjtpOjA7czoxOToiZ2VvcGx1Z2luX2V1VkFUcmF0ZSI7YjowO3M6MjM6Imdlb3BsdWdpbl9jb250aW5lbnRDb2RlIjtzOjI6IkFTIjtzOjIzOiJnZW9wbHVnaW5fY29udGluZW50TmFtZSI7czo0OiJBc2lhIjtzOjE4OiJnZW9wbHVnaW5fbGF0aXR1ZGUiO3M6NzoiMjMuODUxNSI7czoxOToiZ2VvcGx1Z2luX2xvbmdpdHVkZSI7czo2OiI5MC40MDMiO3M6MzI6Imdlb3BsdWdpbl9sb2NhdGlvbkFjY3VyYWN5UmFkaXVzIjtzOjQ6IjEwMDAiO3M6MTg6Imdlb3BsdWdpbl90aW1lem9uZSI7czoxMDoiQXNpYS9EaGFrYSI7czoyMjoiZ2VvcGx1Z2luX2N1cnJlbmN5Q29kZSI7czozOiJCRFQiO3M6MjQ6Imdlb3BsdWdpbl9jdXJyZW5jeVN5bWJvbCI7czoyOiJUayI7czoyOToiZ2VvcGx1Z2luX2N1cnJlbmN5U3ltYm9sX1VURjgiO3M6MjoiVGsiO3M6Mjc6Imdlb3BsdWdpbl9jdXJyZW5jeUNvbnZlcnRlciI7czo3OiI4My42NDAyIjt9czo2OiJfdG9rZW4iO3M6NDA6Imlja0VDOXlqSnJ6VW0zQ21nM2hWVnlIZUQzNEJUN2dFcU1jTlpDSWUiO3M6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly9hbWludWwtcGMvcm9ja2V0ci9zZWxsZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MToiaHR0cDovL2FtaW51bC1wYy9yb2NrZXRyL2J1eS9SR1Z0Ync9PS80TVZLVUVVWVc5U1dZIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fdXNlcnNfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1544696418);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google2fa_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `google2fa_secret`, `password`, `status`, `profile_photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Demo', NULL, 'demo@techvill.net', NULL, '$2y$10$J7KrpvX8IRi59Gty.Tam/uLmH2088keJMjuV7DuqhyKH1MlbRay2q', 'Active', NULL, NULL, '2018-12-13 04:17:34', '2018-12-13 04:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email_verification` tinyint(4) NOT NULL DEFAULT '0',
  `two_step_verification_type` enum('email','googleauthenticator') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_step_verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_step_verification` tinyint(4) DEFAULT NULL,
  `user_type` enum('merchant','seller') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `email_verification`, `two_step_verification_type`, `two_step_verification_code`, `two_step_verification`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, NULL, NULL, 'merchant', '2018-12-13 04:17:34', '2018-12-13 04:17:34'),
(2, 1, 0, NULL, NULL, NULL, 'seller', '2018-12-13 04:17:35', '2018-12-13 04:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `last_login_ip`, `last_login_browser`, `last_login_country`, `last_login_at`, `last_login_status`, `last_login_details`, `created_at`, `updated_at`) VALUES
(1, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Dhaka - Dhaka Division - Bangladesh', '2018-12-13 04:17:47', 'Success', '', '2018-12-13 04:17:47', '2018-12-13 04:17:47');

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
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliates_affiliate_uuid_unique` (`affiliate_uuid`),
  ADD KEY `affiliates_user_id_index` (`user_id`);

--
-- Indexes for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliate_payouts_seller_id_index` (`seller_id`),
  ADD KEY `affiliate_payouts_affiliate_user_id_index` (`affiliate_user_id`),
  ADD KEY `affiliate_payouts_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `affiliate_products`
--
ALTER TABLE `affiliate_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliate_products_seller_id_index` (`seller_id`),
  ADD KEY `affiliate_products_product_id_index` (`product_id`),
  ADD KEY `affiliate_products_affiliate_id_index` (`affiliate_id`);

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
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_code_index` (`code`);

--
-- Indexes for table `email_campaigns`
--
ALTER TABLE `email_campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_campaigns_campaign_id_unique` (`campaign_id`),
  ADD KEY `email_campaigns_seller_id_index` (`seller_id`);

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
  ADD KEY `orders_payment_method_id_index` (`payment_method_id`),
  ADD KEY `orders_affiliate_user_id_index` (`affiliate_user_id`);

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
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_settings_account_id_index` (`account_id`),
  ADD KEY `payment_settings_account_index` (`account`);

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
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_seller_id_index` (`seller_id`),
  ADD KEY `product_reviews_order_id_index` (`order_id`);

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
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_views_product_id_index` (`product_id`),
  ADD KEY `product_views_seller_id_index` (`seller_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

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
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_settings`
--
ALTER TABLE `account_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_products`
--
ALTER TABLE `affiliate_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_campaigns`
--
ALTER TABLE `email_campaigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchant_tiers`
--
ALTER TABLE `merchant_tiers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_groups`
--
ALTER TABLE `product_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_social_options`
--
ALTER TABLE `product_social_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller_groups`
--
ALTER TABLE `seller_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_settings`
--
ALTER TABLE `account_settings`
  ADD CONSTRAINT `account_settings_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  ADD CONSTRAINT `affiliate_payouts_affiliate_user_id_foreign` FOREIGN KEY (`affiliate_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `affiliate_payouts_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `affiliate_payouts_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliate_products`
--
ALTER TABLE `affiliate_products`
  ADD CONSTRAINT `affiliate_products_affiliate_id_foreign` FOREIGN KEY (`affiliate_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `affiliate_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `affiliate_products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`user_id`);

--
-- Constraints for table `email_campaigns`
--
ALTER TABLE `email_campaigns`
  ADD CONSTRAINT `email_campaigns_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`user_id`);

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
  ADD CONSTRAINT `orders_affiliate_user_id_foreign` FOREIGN KEY (`affiliate_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
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
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_reviews_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_social_options`
--
ALTER TABLE `product_social_options`
  ADD CONSTRAINT `product_social_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_social_options_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `product_views`
--
ALTER TABLE `product_views`
  ADD CONSTRAINT `product_views_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_views_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

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

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
