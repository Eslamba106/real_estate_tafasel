-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 03:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `module_access` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `module_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', NULL, 1, NULL, NULL),
(2, 'Team Leader', '[\"dashboard\",\"edit_unit_description\",\"edit_unit_condition\",\"edit_unit_type\"]', 1, '2025-08-03 16:03:21', '2025-08-03 16:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":false},{\"id\":2,\"name\":\"Arabic\",\"direction\":\"rtl\",\"code\":\"eg\",\"status\":1,\"default\":true}]', '2020-10-11 04:53:02', '2025-07-31 17:33:52'),
(3, 'mail_config', '{\"status\":0,\"name\":\"demo\",\"host\":\"mail.demo.com\",\"driver\":\"SMTP\",\"port\":\"587\",\"username\":\"info@demo.com\",\"email_id\":\"info@demo.com\",\"encryption\":\"TLS\",\"password\":\"demo\"}', '2020-10-12 07:29:18', '2021-07-06 09:32:01'),
(4, 'cash_on_delivery', '{\"status\":\"1\"}', NULL, '2021-05-25 18:21:15'),
(6, 'ssl_commerz_payment', '{\"status\":\"0\",\"environment\":\"sandbox\",\"store_id\":\"\",\"store_password\":\"\"}', '2020-11-09 06:36:51', '2023-01-10 03:51:56'),
(7, 'paypal', '{\"status\":\"0\",\"environment\":\"sandbox\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\"}', '2020-11-09 06:51:39', '2023-01-10 03:51:56'),
(8, 'stripe', '{\"status\":\"0\",\"api_key\":null,\"published_key\":null}', '2020-11-09 07:01:47', '2021-07-06 09:30:05'),
(10, 'company_phone', '01150099801', NULL, '2020-12-08 12:15:01'),
(11, 'company_name', 'Tafasel', NULL, '2021-02-27 16:11:53'),
(12, 'company_web_logo', '2025-07-30-688aa6ddc9abb.webp', NULL, '2025-07-30 20:12:29'),
(13, 'company_mobile_logo', '2025-07-30-688aa6df98294.webp', NULL, '2025-07-30 20:12:31'),
(14, 'terms_condition', '<p>terms and conditions</p>', NULL, '2021-06-10 22:51:36'),
(15, 'about_us', '<h1><strong>Our Work</strong></h1>\r\n\r\n<h3>We&nbsp;develop simple, reliable,&nbsp; &nbsp; flexible and cost effective solutions which are adaptable to the client&rsquo;s environment. Our team are always equipped with the global technology updates; we evaluate and review our processes and knowledge base to implement the best available solutions that can bring value addition to our customers.</h3>\r\n\r\n<h1><strong>Environment, Employment, and Growth</strong></h1>\r\n\r\n<p>As a company and as individuals, we take great pride in contributing to the growth of our clients, employees, and communities where we live and work.</p>\r\n\r\n<p>Our persistent efforts to improve on our employee skills in a good work environment continue to pay off. We have always been recruiting with great employment opportunities with very high potential to learn, work and earn.</p>\r\n\r\n<h1><strong>Mission</strong></h1>\r\n\r\n<h3>Providing best and reliable IT solutions leveraging global opportunities for quality and cost effective services to our customers and helping them to achieve maximum efficiency and profitability in their business objectives.</h3>\r\n\r\n<h1><strong>Vision</strong></h1>\r\n\r\n<h3>To be an innovative IT &amp; ITES Solution provider and advisor for the enterprise consulting and systems integration in the emerging networked global economy.</h3>', NULL, '2025-06-01 05:30:26'),
(16, 'sms_nexmo', '{\"status\":\"0\",\"nexmo_key\":\"custo5cc042f7abf4c\",\"nexmo_secret\":\"custo5cc042f7abf4c@ssl\"}', NULL, NULL),
(17, 'company_email', 'support@tafasel.com', NULL, '2021-03-15 10:29:51'),
(18, 'colors', '{\"primary\":\"#3e4b75\",\"secondary\":\"#000000\",\"primary_light\":\"#CFDFFB\"}', '2020-10-11 10:53:02', '2023-10-13 02:34:53'),
(19, 'company_footer_logo', '2025-07-30-688aa6e191d71.webp', NULL, '2025-07-30 20:12:33'),
(20, 'company_copyright_text', 'CopyRight Y-codex@2021', NULL, '2021-03-15 10:30:47'),
(21, 'download_app_apple_stroe', '{\"status\":0,\"link\":null}', NULL, '2020-12-08 10:54:53'),
(22, 'download_app_google_stroe', '{\"status\":0,\"link\":null}', NULL, '2020-12-08 10:54:48'),
(23, 'company_fav_icon', '2025-07-30-688aa6e3920e2.webp', '2020-10-11 10:53:02', '2025-07-30 20:12:35'),
(24, 'fcm_topic', '', NULL, NULL),
(25, 'fcm_project_id', '', NULL, NULL),
(26, 'push_notification_key', 'Put your firebase server key here.', NULL, NULL),
(27, 'order_pending_message', '{\"status\":\"1\",\"message\":\"order pen message\"}', NULL, NULL),
(28, 'order_confirmation_msg', '{\"status\":\"1\",\"message\":\"Order con Message\"}', NULL, NULL),
(29, 'order_processing_message', '{\"status\":\"1\",\"message\":\"Order pro Message\"}', NULL, NULL),
(30, 'out_for_delivery_message', '{\"status\":\"1\",\"message\":\"Order ouut Message\"}', NULL, NULL),
(31, 'order_delivered_message', '{\"status\":\"1\",\"message\":\"Order del Message\"}', NULL, NULL),
(32, 'razor_pay', '{\"status\":\"0\",\"razor_key\":null,\"razor_secret\":null}', NULL, '2021-07-06 09:30:14'),
(33, 'sales_commission', '0', NULL, '2025-06-26 06:05:17'),
(34, 'seller_registration', '1', NULL, '2025-06-26 06:04:32'),
(35, 'pnc_language', '[\"en\",\"eg\"]', NULL, NULL),
(36, 'order_returned_message', '{\"status\":\"1\",\"message\":\"Order hh Message\"}', NULL, NULL),
(37, 'order_failed_message', '{\"status\":null,\"message\":\"Order fa Message\"}', NULL, NULL),
(40, 'delivery_boy_assign_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(41, 'delivery_boy_start_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(42, 'delivery_boy_delivered_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(43, 'terms_and_conditions', '', NULL, NULL),
(44, 'minimum_order_value', '1', NULL, NULL),
(45, 'privacy_policy', '<p>my privacy policy</p>\r\n\r\n<p>&nbsp;</p>', NULL, '2021-07-06 08:09:07'),
(46, 'paystack', '{\"status\":\"0\",\"publicKey\":null,\"secretKey\":null,\"paymentUrl\":\"https:\\/\\/api.paystack.co\",\"merchantEmail\":null}', NULL, '2021-07-06 09:30:35'),
(47, 'senang_pay', '{\"status\":\"0\",\"secret_key\":null,\"merchant_id\":null}', NULL, '2021-07-06 09:30:23'),
(48, 'currency_model', 'single_currency', NULL, NULL),
(49, 'social_login', '[{\"login_medium\":\"google\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":\"\"},{\"login_medium\":\"facebook\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":\"\"}]', NULL, NULL),
(50, 'digital_payment', '{\"status\":\"1\"}', NULL, NULL),
(51, 'phone_verification', NULL, NULL, NULL),
(52, 'email_verification', NULL, NULL, NULL),
(53, 'order_verification', '0', NULL, NULL),
(54, 'country_code', 'EG', NULL, NULL),
(55, 'pagination_limit', '10', NULL, NULL),
(56, 'shipping_method', 'inhouse_shipping', NULL, NULL),
(57, 'paymob_accept', '{\"status\":\"0\",\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', NULL, NULL),
(58, 'bkash', '{\"status\":\"0\",\"environment\":\"sandbox\",\"api_key\":\"\",\"api_secret\":\"\",\"username\":\"\",\"password\":\"\"}', NULL, '2023-01-10 03:51:56'),
(59, 'forgot_password_verification', NULL, NULL, NULL),
(60, 'paytabs', '{\"status\":0,\"profile_id\":\"\",\"server_key\":\"\",\"base_url\":\"https:\\/\\/secure-egypt.paytabs.com\\/\"}', NULL, '2021-11-21 01:01:40'),
(61, 'stock_limit', '10', NULL, NULL),
(62, 'flutterwave', '{\"status\":0,\"public_key\":\"\",\"secret_key\":\"\",\"hash\":\"\"}', NULL, NULL),
(63, 'mercadopago', '{\"status\":0,\"public_key\":\"\",\"access_token\":\"\"}', NULL, NULL),
(64, 'announcement', '{\"status\":null,\"color\":null,\"text_color\":null,\"announcement\":null}', NULL, NULL),
(65, 'fawry_pay', '{\"status\":0,\"merchant_code\":\"\",\"security_key\":\"\"}', NULL, '2022-01-18 07:46:30'),
(66, 'recaptcha', '{\"status\":0,\"site_key\":\"\",\"secret_key\":\"\"}', NULL, '2022-01-18 07:46:30'),
(67, 'seller_pos', '1', NULL, '2025-06-26 06:05:17'),
(68, 'liqpay', '{\"status\":0,\"public_key\":\"\",\"private_key\":\"\"}', NULL, NULL),
(69, 'paytm', '{\"status\":0,\"environment\":\"sandbox\",\"paytm_merchant_key\":\"\",\"paytm_merchant_mid\":\"\",\"paytm_merchant_website\":\"\",\"paytm_refund_url\":\"\"}', NULL, '2023-01-10 03:51:56'),
(70, 'refund_day_limit', '0', NULL, NULL),
(71, 'business_mode', NULL, NULL, NULL),
(72, 'mail_config_sendgrid', '{\"status\":0,\"name\":\"\",\"host\":\"\",\"driver\":\"\",\"port\":\"\",\"username\":\"\",\"email_id\":\"\",\"encryption\":\"\",\"password\":\"\"}', NULL, NULL),
(73, 'decimal_point_settings', NULL, NULL, NULL),
(74, 'shop_address', 'Menia', NULL, NULL),
(75, 'billing_input_by_customer', '1', NULL, NULL),
(76, 'wallet_status', '0', NULL, NULL),
(77, 'loyalty_point_status', '0', NULL, NULL),
(78, 'wallet_add_refund', '0', NULL, NULL),
(79, 'loyalty_point_exchange_rate', '0', NULL, NULL),
(80, 'loyalty_point_item_purchase_point', '0', NULL, NULL),
(81, 'loyalty_point_minimum_point', '0', NULL, NULL),
(82, 'minimum_order_limit', '1', NULL, NULL),
(83, 'product_brand', '1', NULL, NULL),
(84, 'digital_product', '1', NULL, NULL),
(85, 'delivery_boy_expected_delivery_date_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(86, 'order_canceled', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(87, 'refund-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 04:25:36'),
(88, 'return-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 04:25:36'),
(89, 'cancellation-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 04:25:36'),
(90, 'offline_payment', '{\"status\":0}', NULL, '2023-03-04 04:25:36'),
(91, 'temporary_close', '{\"status\":0}', NULL, '2023-03-04 04:25:36'),
(92, 'vacation_add', '{\"status\":0,\"vacation_start_date\":null,\"vacation_end_date\":null,\"vacation_note\":null}', NULL, '2023-03-04 04:25:36'),
(93, 'cookie_setting', '{\"status\":0,\"cookie_text\":null}', NULL, '2023-03-04 04:25:36'),
(94, 'maximum_otp_hit', '0', NULL, '2023-06-13 10:04:49'),
(95, 'otp_resend_time', '0', NULL, '2023-06-13 10:04:49'),
(96, 'temporary_block_time', '0', NULL, '2023-06-13 10:04:49'),
(97, 'maximum_login_hit', '0', NULL, '2023-06-13 10:04:49'),
(98, 'temporary_login_block_time', '0', NULL, '2023-06-13 10:04:49'),
(99, 'maximum_otp_hit', '0', NULL, '2023-10-13 02:34:53'),
(100, 'otp_resend_time', '0', NULL, '2023-10-13 02:34:53'),
(101, 'temporary_block_time', '0', NULL, '2023-10-13 02:34:53'),
(102, 'maximum_login_hit', '0', NULL, '2023-10-13 02:34:53'),
(103, 'temporary_login_block_time', '0', NULL, '2023-10-13 02:34:53'),
(104, 'apple_login', '[{\"login_medium\":\"apple\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":0,\"team_id\":\"\",\"key_id\":\"\",\"service_file\":\"\",\"redirect_url\":\"\"}]', NULL, '2023-10-13 02:34:53'),
(105, 'ref_earning_status', '0', NULL, '2023-10-13 02:34:53'),
(106, 'ref_earning_exchange_rate', '0', NULL, '2023-10-13 02:34:53'),
(107, 'guest_checkout', '0', NULL, '2023-10-13 08:34:53'),
(108, 'minimum_order_amount', '0', NULL, '2023-10-13 08:34:53'),
(109, 'minimum_order_amount_by_seller', '0', NULL, '2025-06-26 06:04:32'),
(110, 'minimum_order_amount_status', '0', NULL, '2023-10-13 08:34:53'),
(111, 'admin_login_url', 'admin', NULL, '2023-10-13 08:34:53'),
(112, 'employee_login_url', 'employee', NULL, '2023-10-13 08:34:53'),
(113, 'free_delivery_status', '0', NULL, '2023-10-13 08:34:53'),
(114, 'free_delivery_responsibility', 'admin', NULL, '2023-10-13 08:34:53'),
(115, 'free_delivery_over_amount', '0', NULL, '2023-10-13 08:34:53'),
(116, 'free_delivery_over_amount_seller', '0', NULL, '2023-10-13 08:34:53'),
(117, 'add_funds_to_wallet', '0', NULL, '2023-10-13 08:34:53'),
(118, 'minimum_add_fund_amount', '0', NULL, '2023-10-13 08:34:53'),
(119, 'maximum_add_fund_amount', '0', NULL, '2023-10-13 08:34:53'),
(120, 'user_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 08:34:53'),
(121, 'seller_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 08:34:53'),
(122, 'delivery_man_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 08:34:53'),
(123, 'whatsapp', '{\"status\":\"1\",\"phone\":\"+201150099801\"}', '2025-06-01 10:38:24', '2025-06-01 10:38:24'),
(124, 'currency_symbol_position', NULL, NULL, '2023-10-13 08:34:53'),
(125, 'cancellation-policy', '{\"status\":1,\"content\":\"\"}', NULL, NULL),
(126, 'timezone', 'Africa/Cairo', NULL, NULL),
(127, 'default_location', '{\"lat\":null,\"lng\":null}', NULL, NULL),
(128, 'new_product_approval', '0', NULL, '2025-06-26 06:04:32'),
(129, 'product_wise_shipping_cost_approval', '0', NULL, '2025-06-26 06:04:32'),
(130, 'system_default_currency', NULL, NULL, NULL),
(131, 'loader_gif', '2025-07-30-688aa6e58810d.webp', NULL, NULL);

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
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Floor - 1', 'active', NULL, '2025-07-31 04:43:34', '2025-07-31 09:16:37'),
(2, 'Floor - 2', 'active', NULL, '2025-07-31 09:16:18', '2025-07-31 09:16:18'),
(3, 'Floor - 3', 'active', NULL, '2025-07-31 09:16:25', '2025-07-31 09:16:25'),
(4, 'Roof', 'active', NULL, '2025-07-31 09:16:30', '2025-07-31 09:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `floor_management`
--

CREATE TABLE `floor_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floor_management`
--

INSERT INTO `floor_management` (`id`, `project_id`, `floor_id`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'active', NULL, '2025-07-31 09:18:43', '2025-07-31 09:20:39'),
(2, 2, 2, 'active', NULL, '2025-07-31 09:18:43', '2025-07-31 09:18:43'),
(3, 2, 3, 'inactive', NULL, '2025-07-31 09:18:43', '2025-07-31 11:36:17'),
(4, 2, 4, 'active', NULL, '2025-07-31 09:18:43', '2025-07-31 09:18:43');

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
(5, '2025_07_30_142042_create_business_settings_table', 1),
(6, '2025_07_30_214934_create_admin_roles_table', 2),
(7, '2025_07_30_222010_create_social_media_table', 3),
(8, '2025_07_31_063115_create_unit_descriptions_table', 4),
(9, '2025_07_31_063755_create_unit_types_table', 4),
(10, '2025_07_31_063804_create_unit_conditions_table', 4),
(11, '2025_07_31_063812_create_views_table', 4),
(12, '2025_07_31_063828_create_property_types_table', 4),
(13, '2025_07_31_070255_create_unit_parkings_table', 4),
(14, '2025_07_31_072917_create_floors_table', 5),
(15, '2025_07_31_074412_create_projects_table', 6),
(16, '2025_07_31_081706_create_floor_management_table', 7),
(17, '2025_07_31_083039_create_unit_management_table', 8),
(19, '2025_07_31_183832_create_theme_settings_table', 9),
(21, '2025_08_02_114300_create_teams_table', 10);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `area`, `location`, `status`, `type`, `image`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Project A', NULL, 'Menia', 'active', '1', NULL, NULL, '2025-07-31 09:12:05', '2025-07-31 09:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Commercial', 'active', NULL, '2025-07-31 04:43:24', '2025-07-31 04:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `active_status` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `link`, `icon`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'twitter', 'https://www.w3schools.com/howto/howto_css_table_responsive.asp', 'fa fa-twitter', 1, 1, '2020-12-31 19:18:03', '2020-12-31 19:18:25'),
(2, 'linkedin', 'https://dev.6amtech.com/', 'fa fa-linkedin', 1, 1, '2021-02-27 14:23:01', '2021-02-27 14:23:05'),
(3, 'google-plus', 'https://dev.6amtech.com/', 'fa fa-google-plus-square', 1, 1, '2021-02-27 14:23:30', '2021-02-27 14:23:33'),
(4, 'pinterest', 'https://dev.6amtech.com/', 'fa fa-pinterest', 1, 1, '2021-02-27 14:24:14', '2021-02-27 14:24:26'),
(5, 'instagram', 'https://dev.6amtech.com/', 'fa fa-instagram', 1, 1, '2021-02-27 14:24:36', '2021-02-27 14:24:41'),
(6, 'facebook', 'facebook.com', 'fa fa-facebook', 1, 1, '2021-02-27 17:19:42', '2021-06-11 14:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `members` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `members`, `created_at`, `updated_at`) VALUES
(1, 'Sales', NULL, '2025-08-02 09:24:24', '2025-08-02 10:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'first_header_text', 'مرحبا بك في شركة تفاصيل', '2025-07-31 16:21:19', '2025-07-31 16:50:38'),
(2, 'first_header_p', 'نحن خيارك الامثل بدءًا من شراء الأراضي والتخطيط والتصميم، وصولًا إلى البناء والتشطيب والتسويق والمبيعات.   .', '2025-07-31 16:22:00', '2025-07-31 17:06:36'),
(3, 'loader_gif', NULL, '2025-07-31 16:37:27', '2025-07-31 16:37:27'),
(4, 'about_us_header', 'من نحن', '2025-07-31 17:00:43', '2025-07-31 17:00:57'),
(5, 'about_us_middle', 'شركة  تفاضيل هي شركة متخصصة في تطوير المشاريع العقارية، بدءًا من شراء الأراضي والتخطيط والتصميم، وصولًا إلى البناء والتشطيب والتسويق والمبيعات. تعمل هذه الشركات على تحويل الأراضي أو العقارات إلى مشاريع جديدة، سواء كانت سكنية أو تجارية، بهدف تحقيق الربح وتقديم قيمة مضافة.', '2025-07-31 17:04:05', '2025-07-31 17:05:47'),
(6, 'about_us_footer', NULL, '2025-07-31 17:04:05', '2025-07-31 17:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `unit_conditions`
--

CREATE TABLE `unit_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_conditions`
--

INSERT INTO `unit_conditions` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Black-Finish1', 'active', NULL, '2025-07-31 04:37:58', '2025-07-31 04:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `unit_descriptions`
--

CREATE TABLE `unit_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_descriptions`
--

INSERT INTO `unit_descriptions` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(3, 'Sales', 'active', NULL, '2025-08-02 10:13:44', '2025-08-02 10:20:48'),
(4, 'eslam badawy', 'active', NULL, '2025-08-02 10:20:52', '2025-08-02 10:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `unit_management`
--

CREATE TABLE `unit_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `floor_management_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_description_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_condition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_parking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `view_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `room_counts` varchar(255) DEFAULT NULL,
  `bath_room_counts` varchar(255) DEFAULT NULL,
  `ratio` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `booking_status` enum('empty','request','review','meeting','booking','agreement') NOT NULL DEFAULT 'empty',
  `branch_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_parkings`
--

CREATE TABLE `unit_parkings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_parkings`
--

INSERT INTO `unit_parkings` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Internal Parking1', 'active', NULL, '2025-07-31 04:42:48', '2025-07-31 04:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Team Space1', 'active', NULL, '2025-07-31 04:38:36', '2025-07-31 04:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `my_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `status`, `role_id`, `team_id`, `phone`, `my_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'admin', '$2y$10$Ov1XETq6f9Yv2Lh5Ir.IbOysOkUj5z9LVXfrP51hJ4c5DGlBkAEpO', 1, 1, NULL, NULL, NULL, '2025-07-30 18:47:08', '2025-08-02 10:24:27'),
(2, 'e@badawy.e', 'e3@badawy.e', 'eslam', '$2y$10$k6ZRDUnv2JY3jWyBF/RDqef06ZwsrcCrJUEzUgueC8JvaGPFQtula', 1, 1, 1, '01117556204', '123456', '2025-08-03 15:46:52', '2025-08-03 15:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `name`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Street View1', 'active', NULL, '2025-07-31 04:43:11', '2025-07-31 04:43:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor_management`
--
ALTER TABLE `floor_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floor_management_project_id_foreign` (`project_id`),
  ADD KEY `floor_management_floor_id_foreign` (`floor_id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_name_unique` (`name`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `theme_settings_key_unique` (`key`);

--
-- Indexes for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_descriptions`
--
ALTER TABLE `unit_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_management`
--
ALTER TABLE `unit_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_management_project_id_foreign` (`project_id`),
  ADD KEY `unit_management_floor_management_id_foreign` (`floor_management_id`),
  ADD KEY `unit_management_unit_description_id_foreign` (`unit_description_id`),
  ADD KEY `unit_management_unit_condition_id_foreign` (`unit_condition_id`),
  ADD KEY `unit_management_unit_type_id_foreign` (`unit_type_id`),
  ADD KEY `unit_management_unit_parking_id_foreign` (`unit_parking_id`),
  ADD KEY `unit_management_view_id_foreign` (`view_id`);

--
-- Indexes for table `unit_parkings`
--
ALTER TABLE `unit_parkings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `floor_management`
--
ALTER TABLE `floor_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_descriptions`
--
ALTER TABLE `unit_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_management`
--
ALTER TABLE `unit_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit_parkings`
--
ALTER TABLE `unit_parkings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `floor_management`
--
ALTER TABLE `floor_management`
  ADD CONSTRAINT `floor_management_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `floor_management_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unit_management`
--
ALTER TABLE `unit_management`
  ADD CONSTRAINT `unit_management_floor_management_id_foreign` FOREIGN KEY (`floor_management_id`) REFERENCES `floor_management` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_unit_condition_id_foreign` FOREIGN KEY (`unit_condition_id`) REFERENCES `unit_conditions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_unit_description_id_foreign` FOREIGN KEY (`unit_description_id`) REFERENCES `unit_descriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_unit_parking_id_foreign` FOREIGN KEY (`unit_parking_id`) REFERENCES `unit_parkings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_unit_type_id_foreign` FOREIGN KEY (`unit_type_id`) REFERENCES `unit_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_management_view_id_foreign` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
