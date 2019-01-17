-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2019 at 10:00 AM
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
-- Database: `rocketr2`
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
  `receive_email_site_tips_updates` tinyint(4) DEFAULT NULL COMMENT 'Receive an e-mail with Creationshop tips and update',
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
(1, 1, NULL, '1UU0BRSRFU0JK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-02 04:07:36', '2019-01-02 04:07:36'),
(2, 2, NULL, 'ZHFFAQH4LYYSJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-02 04:22:27', '2019-01-02 04:22:27'),
(3, 3, NULL, 'M6JD12783FK35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-12 23:24:27', '2019-01-12 23:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_apps`
--

CREATE TABLE `merchant_apps` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchant_id` int(10) UNSIGNED NOT NULL,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'App Name.',
  `app_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Application Id.',
  `app_secrect` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Application Secrect Key.',
  `scope` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_apps`
--

INSERT INTO `merchant_apps` (`id`, `merchant_id`, `app_name`, `app_description`, `app_id`, `app_secrect`, `scope`, `created_at`, `updated_at`) VALUES
(1, 1, 'new', 'one', 'newbtiYORIE7SHkAXvjGqMQ3B8KszmpPJ', 'MjhqTWdBRndxbkp1V2k2Q2JoVm1TSDR2b1lJSzcxcHhkeTVMOURFME9adFFlVHNYY1U=', '[\"orders\",\"invoices\",\"merchants\"]', '2019-01-05 23:45:35', '2019-01-05 23:45:35'),
(2, 1, 'new1', 'one', 'new1VMK2PD3zxn9TJrypgjiR06CQamWqUu', 'QklBYXB3TmJleTFmaFV6RzBRN0tKVk1TV085MllndUZpdmNuOEw2cmtabVRFREhYbHQ=', '[\"orders\",\"invoices\",\"merchants\"]', '2019-01-05 23:45:45', '2019-01-05 23:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_invoices`
--

CREATE TABLE `merchant_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique for each Invoice',
  `merchant_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `currency` text COLLATE utf8mb4_unicode_ci,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_status` text COLLATE utf8mb4_unicode_ci,
  `buyer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `browser_redirect` text COLLATE utf8mb4_unicode_ci COMMENT 'The URL to redirect Merchant Pages.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_invoices`
--

INSERT INTO `merchant_invoices` (`id`, `invoice_uid`, `merchant_id`, `payment_method_id`, `currency`, `amount`, `quantity`, `description`, `paid_amount`, `invoice_status`, `buyer_email`, `notes`, `browser_redirect`, `created_at`, `updated_at`) VALUES
(1, 'A6BE78IB8RU7', 1, 1, '1', '11', NULL, NULL, NULL, 'Paid', 'shakil.techvill@gmail.com', NULL, NULL, '2019-01-02 04:39:56', '2019-01-02 04:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_orders`
--

CREATE TABLE `merchant_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique for each Order',
  `merchant_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` text COLLATE utf8mb4_unicode_ci,
  `order_status` text COLLATE utf8mb4_unicode_ci,
  `buyer_email` text COLLATE utf8mb4_unicode_ci,
  `ipn_url` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_orders`
--

INSERT INTO `merchant_orders` (`id`, `order_uid`, `merchant_id`, `invoice_id`, `payment_method_id`, `amount`, `currency`, `order_status`, `buyer_email`, `ipn_url`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'VFJ4GECCSM9P', 1, 1, 1, '11', '1', 'Paid', 'shakil.techvill@gmail.com', NULL, NULL, '2019-01-02 04:39:57', '2019-01-02 04:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_payment_details`
--

CREATE TABLE `merchant_payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
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

--
-- Dumping data for table `merchant_payment_details`
--

INSERT INTO `merchant_payment_details` (`id`, `invoice_id`, `order_id`, `payment_method_id`, `transaction_id`, `payment_status`, `payment_method_email`, `amount_paid`, `payment_method_fees`, `sender_name`, `sender_address`, `receiver_email`, `site_fee`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '12H11978GP655060E', 'Paid', 'techvillage_personal@gmail.com', '11.00', '0.62', 'tech village', '{\"Street\":\"1 Main St\",\"City\":\"San Jose\",\"State\":\"CA\",\"Zip\":\"95131\",\"country_code\":\"US\",\"country_name\":\"United States\"}', 'techvillage_business@gmail.com', '0.00', '2019-01-02 04:40:38', '2019-01-02 04:40:38');

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
(26, '2018_12_09_064337_create_sessions_table', 1),
(27, '2018_12_24_102650_create_merchant_invoices_table', 1),
(28, '2018_12_25_043659_create_payment_buttons_table', 1),
(29, '2018_12_27_061318_create_merchant_apps_table', 1),
(30, '2018_12_27_102620_create_merchant_orders_table', 1),
(31, '2018_12_27_102627_create_merchant_payment_details_table', 1);

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
  `affiliate_user_id` int(10) UNSIGNED DEFAULT NULL,
  `is_affiliated` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `affiliate_amount` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `seller_id`, `product_id`, `order_uuid`, `buyer_email`, `buyer_country`, `buyer_ip`, `coupon_code`, `coupon_activate_date`, `http_referer`, `amount`, `payment_method_id`, `product_quantity`, `payment_status`, `delivery_status`, `order_date`, `affiliate_user_id`, `is_affiliated`, `affiliate_amount`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'nCF4o5ecwwWnncgwIwg5', 'atik@gmail.com', NULL, 'fe80::a574:a8e8:8c29:254e', NULL, NULL, 'http://aminul-pc/rocketr/buy/QXRpaw==/UELKGGCHKGPGB', '50.00', 1, 1, 'unpaid', NULL, '2019-01-02 00:00:00', NULL, 'No', NULL, NULL, '2019-01-02 05:05:12', '2019-01-02 05:05:36'),
(2, 1, 1, 'UZNB8v2qxuxKNPGStL1J', 'atik@gmail.com', NULL, 'fe80::a574:a8e8:8c29:254e', NULL, NULL, 'http://aminul-pc/rocketr/buy/QXRpaw==/UELKGGCHKGPGB', '50.00', 1, 1, 'paid', NULL, '2019-01-02 00:00:00', NULL, 'No', NULL, NULL, '2019-01-02 05:09:22', '2019-01-02 05:10:02');

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
-- Table structure for table `payment_buttons`
--

CREATE TABLE `payment_buttons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `browser_redirect_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The URL to redirect the buyer to after payment.',
  `ipn_redirect_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The URL to send purchase notifications to. Learn more here.',
  `buyer_shipping` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_buttons`
--

INSERT INTO `payment_buttons` (`id`, `user_id`, `invoice_id`, `username`, `price`, `browser_redirect_url`, `ipn_redirect_url`, `buyer_shipping`, `created_at`, `updated_at`) VALUES
(1, 1, 'A6BE78IB8RU7', 'Atik', 11, NULL, NULL, '', '2019-01-02 04:16:26', '2019-01-02 04:16:26');

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

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `order_id`, `payment_method_id`, `transaction_id`, `payment_status`, `payment_method_email`, `amount_paid`, `payment_method_fees`, `sender_name`, `sender_address`, `receiver_email`, `site_fee`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '9MB76055EY559714A', 'Paid', 'techvillage_personal@gmail.com', '50.00', '1.75', 'tech village', '{\"Street\":\"1 Main St\",\"City\":\"San Jose\",\"State\":\"CA\",\"Zip\":\"95131\",\"country_code\":\"US\",\"country_name\":\"United States\"}', 'techvillage_business@gmail.com', '0.00', '2019-01-02 05:10:03', '2019-01-02 05:10:03');

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

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `account_id`, `name`, `value`, `type`, `account`, `created_at`, `updated_at`) VALUES
(1, 1, 'username', 'techvillage_business_api1.gmail.com', 'paypal', 'merchants', '2019-01-02 04:17:56', '2019-01-02 04:17:56'),
(2, 1, 'password', '9DDYZX2JLA6QL668', 'paypal', 'merchants', '2019-01-02 04:17:56', '2019-01-02 04:17:56'),
(3, 1, 'signature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ABayz5pdk84jno7.Udj6-U8ffwbT', 'paypal', 'merchants', '2019-01-02 04:17:56', '2019-01-02 04:17:56'),
(4, 1, 'mode', 'sandbox', 'paypal', 'merchants', '2019-01-02 04:17:56', '2019-01-02 04:17:56'),
(5, 1, 'status', 'active', 'paypal', 'merchants', '2019-01-02 04:17:56', '2019-01-02 04:17:56'),
(6, 1, 'currency', '1', 'currency', 'merchants', '2019-01-02 04:19:59', '2019-01-02 04:19:59'),
(7, 2, 'currency', '1', 'currency', 'merchants', '2019-01-02 04:36:54', '2019-01-02 04:39:16'),
(8, 1, 'currency', '1', 'currency', 'seller', '2019-01-02 05:08:12', '2019-01-02 05:08:12'),
(9, 1, 'username', 'techvillage_business_api1.gmail.com', 'paypal', 'seller', '2019-01-02 05:08:59', '2019-01-02 05:08:59'),
(10, 1, 'password', '9DDYZX2JLA6QL668', 'paypal', 'seller', '2019-01-02 05:08:59', '2019-01-02 05:08:59'),
(11, 1, 'signature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ABayz5pdk84jno7.Udj6-U8ffwbT', 'paypal', 'seller', '2019-01-02 05:08:59', '2019-01-02 05:08:59'),
(12, 1, 'mode', 'sandbox', 'paypal', 'seller', '2019-01-02 05:08:59', '2019-01-02 05:08:59'),
(13, 1, 'status', 'active', 'paypal', 'seller', '2019-01-02 05:08:59', '2019-01-02 05:08:59');

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
(1, 1, 1, 'UELKGGCHKGPGB', 'Vrent', '<p>Vacation Rental</p>', '1546426422_Screenshot_3.png', '1546426423_Screenshot_3.png', -1, NULL, NULL, 50, '1', 1, 'Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}', NULL, NULL, NULL, NULL, 'Yes', '10.00', '2019-01-02 04:53:43', '2019-01-02 04:53:43');

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
(1, 1, '[\"1\"]', 'Techvillage Product', '2019-01-02 04:55:56', '2019-01-02 04:55:56');

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

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `seller_id`, `order_id`, `review_count`, `comment`, `response`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 'Nice', NULL, '2019-01-02 05:11:37', '2019-01-02 05:11:37');

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
(1, 1, 1, 'facebook', 'Inactive', '2019-01-02 04:53:43', '2019-01-02 04:53:43'),
(2, 1, 1, 'twitter', 'Inactive', '2019-01-02 04:53:44', '2019-01-02 04:53:44'),
(3, 1, 1, 'pininterest', 'Inactive', '2019-01-02 04:53:44', '2019-01-02 04:53:44');

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
(1, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 04:53:55', '2019-01-02 04:53:55'),
(2, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 04:56:12', '2019-01-02 04:56:12'),
(3, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 05:05:11', '2019-01-02 05:05:11'),
(4, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 05:05:38', '2019-01-02 05:05:38'),
(5, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 05:09:16', '2019-01-02 05:09:16'),
(6, 1, 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-02', '2019-01-02 05:14:06', '2019-01-02 05:14:06');

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
(1, 1, NULL, 'IKZYEWJ7INHWG', '2019-01-02 04:07:36', '2019-01-02 04:07:36'),
(2, 2, NULL, '95MU9CRXAM7LB', '2019-01-02 04:22:27', '2019-01-02 04:22:27'),
(3, 3, NULL, 'BVAFAJAMNT5OV', '2019-01-12 23:24:27', '2019-01-12 23:24:27');

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
(1, 'Atik', NULL, 'shakil.techvill@gmail.com', NULL, '$2y$10$hyLAkufZVe17mMM5bk8KjOFaoLgVkxnr.L/2sOkVWpo8HelHiSyTm', 'Active', NULL, '1n7DI5lflMSXxxi5bfAZ5JYDr4nZ7115I5ZB8oD93msjInJqYqZVrcNndCtK', '2019-01-02 04:07:36', '2019-01-02 04:07:36'),
(2, 'shakil', NULL, 'atik@gmail.com', NULL, '$2y$10$gs6l8LGy4LSe/nThjuLRs.ImQ.t6vDFz/gsK.cEimpblyZ6IBNyxG', 'Active', NULL, 'PQSNYfelBBc2y8jbFrQv1Ehgf3PssK0szT6aQDY3Aznd0GaJkY8tMnPKcUxr', '2019-01-02 04:22:26', '2019-01-02 04:22:26'),
(3, 'atkjs', NULL, 'shakil@gmail.com', NULL, '$2y$10$tiuauvwaBWD0EIqzLWBlDeeUqSZaLi3N3hy.JfQZIsL9E1KxfKl.u', 'Active', NULL, 'nGfMlsgIzgavqXPNNYgahCULbLqZw30CFb8ZE1R3oRVdQSmXZjl5YHeh9xo4', '2019-01-12 23:24:26', '2019-01-12 23:24:26');

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
  `two_step_verification` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` enum('merchant','seller') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `email_verification`, `two_step_verification_type`, `two_step_verification_code`, `two_step_verification`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, NULL, 0, 'merchant', '2019-01-02 04:07:36', '2019-01-02 04:07:36'),
(2, 1, 0, NULL, NULL, 0, 'seller', '2019-01-02 04:07:36', '2019-01-02 04:07:36'),
(3, 2, 0, NULL, NULL, 0, 'merchant', '2019-01-02 04:22:27', '2019-01-02 04:22:27'),
(4, 2, 0, NULL, NULL, 0, 'seller', '2019-01-02 04:22:27', '2019-01-02 04:22:27'),
(5, 3, 0, NULL, NULL, 0, 'merchant', '2019-01-12 23:24:26', '2019-01-12 23:24:26'),
(6, 3, 0, NULL, NULL, 0, 'seller', '2019-01-12 23:24:26', '2019-01-12 23:24:26');

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
(1, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-02 04:07:42', 'Success', '', '2019-01-02 04:07:42', '2019-01-02 04:07:42'),
(2, 2, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-02 04:22:41', 'Success', '', '2019-01-02 04:22:41', '2019-01-02 04:22:41'),
(3, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-02 05:37:00', 'Success', '', '2019-01-02 05:37:00', '2019-01-02 05:37:00'),
(4, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-02 22:56:37', 'Success', '', '2019-01-02 22:56:37', '2019-01-02 22:56:37'),
(5, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-05 23:45:09', 'Success', '', '2019-01-05 23:45:09', '2019-01-05 23:45:09'),
(6, 3, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-12 23:24:41', 'Success', '', '2019-01-12 23:24:41', '2019-01-12 23:24:41'),
(7, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-12 23:58:37', 'Success', '', '2019-01-12 23:58:37', '2019-01-12 23:58:37'),
(8, 1, 'fe80::a574:a8e8:8c29:254e', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', ' -  - ', '2019-01-13 02:11:02', 'Success', '', '2019-01-13 02:11:03', '2019-01-13 02:11:03');

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
-- Indexes for table `merchant_apps`
--
ALTER TABLE `merchant_apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_apps_merchant_id_index` (`merchant_id`);

--
-- Indexes for table `merchant_invoices`
--
ALTER TABLE `merchant_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchant_invoices_invoice_uid_unique` (`invoice_uid`),
  ADD KEY `merchant_invoices_merchant_id_index` (`merchant_id`),
  ADD KEY `merchant_invoices_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `merchant_orders`
--
ALTER TABLE `merchant_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchant_orders_order_uid_unique` (`order_uid`),
  ADD KEY `merchant_orders_merchant_id_index` (`merchant_id`),
  ADD KEY `merchant_orders_invoice_id_index` (`invoice_id`),
  ADD KEY `merchant_orders_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `merchant_payment_details`
--
ALTER TABLE `merchant_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchant_payment_details_transaction_id_unique` (`transaction_id`),
  ADD KEY `merchant_payment_details_invoice_id_index` (`invoice_id`),
  ADD KEY `merchant_payment_details_order_id_index` (`order_id`),
  ADD KEY `merchant_payment_details_payment_method_id_index` (`payment_method_id`);

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
-- Indexes for table `payment_buttons`
--
ALTER TABLE `payment_buttons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_buttons_user_id_index` (`user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchant_apps`
--
ALTER TABLE `merchant_apps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merchant_invoices`
--
ALTER TABLE `merchant_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchant_orders`
--
ALTER TABLE `merchant_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchant_payment_details`
--
ALTER TABLE `merchant_payment_details`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_buttons`
--
ALTER TABLE `payment_buttons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_social_options`
--
ALTER TABLE `product_social_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller_groups`
--
ALTER TABLE `seller_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
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
-- Constraints for table `merchant_apps`
--
ALTER TABLE `merchant_apps`
  ADD CONSTRAINT `merchant_apps_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `merchant_invoices`
--
ALTER TABLE `merchant_invoices`
  ADD CONSTRAINT `merchant_invoices_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `merchant_invoices_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `merchant_orders`
--
ALTER TABLE `merchant_orders`
  ADD CONSTRAINT `merchant_orders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `merchant_invoices` (`id`),
  ADD CONSTRAINT `merchant_orders_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `merchant_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `merchant_payment_details`
--
ALTER TABLE `merchant_payment_details`
  ADD CONSTRAINT `merchant_payment_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `merchant_invoices` (`id`),
  ADD CONSTRAINT `merchant_payment_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `merchant_orders` (`id`),
  ADD CONSTRAINT `merchant_payment_details_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_affiliate_user_id_foreign` FOREIGN KEY (`affiliate_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `payment_buttons`
--
ALTER TABLE `payment_buttons`
  ADD CONSTRAINT `payment_buttons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
