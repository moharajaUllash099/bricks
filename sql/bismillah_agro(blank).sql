-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 07:36 AM
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
-- Database: `bismillah_agro`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val` text CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `name`, `val`, `created_at`, `updated_at`) VALUES
(1, 'company', 'Bismillah Agro Ltd.', NULL, NULL),
(2, 'phone', '01723769900', NULL, NULL),
(3, 'email', 'dismillahagro@gmail.com', NULL, NULL),
(4, 'address', '<p>57/1 Jafrabad<br style=\"\">Mohammadpur ,Dhak<span style=\"color: rgb(255, 255, 255); font-family: \"Open Sans\", sans-serif; font-size: 14px; background-color: rgb(247, 247, 247);\">a-1209</span><br></p>', NULL, NULL),
(5, 'print_auther_info', 'off', NULL, NULL),
(6, 'permissible_branch', '2', NULL, NULL),
(7, 'active_invoice', 'basic_international', NULL, NULL),
(8, 'currency', 'BDT', NULL, NULL),
(9, 'vat', '15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `address` text CHARACTER SET utf16 NOT NULL,
  `phone` varchar(191) CHARACTER SET utf16 NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `img`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Dairy', 0, NULL, 0, '2018-09-12 10:12:14', '2018-09-12 10:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `phone_code`, `name`, `created_at`, `updated_at`) VALUES
(1, '+93', 'Afghanistan', NULL, NULL),
(2, '+355', 'Albania', NULL, NULL),
(3, '+213', 'Algeria', NULL, NULL),
(4, '+1', 'American Samoa', NULL, NULL),
(5, '+244', 'Andorra', NULL, NULL),
(6, '+355', 'Angola', NULL, NULL),
(7, '+1', 'Anguilla', NULL, NULL),
(8, '+1', 'Antigua', NULL, NULL),
(9, '+54', 'Argentina', NULL, NULL),
(10, '+374', 'Armenia', NULL, NULL),
(11, '+297', 'Aruba', NULL, NULL),
(12, '+61', 'Australia', NULL, NULL),
(13, '+43', 'Austria', NULL, NULL),
(14, '+994', 'Azerbaijan', NULL, NULL),
(15, '+973', 'Bahrain', NULL, NULL),
(16, '+880', 'Bangladesh', NULL, NULL),
(17, '+1', 'Barbados', NULL, NULL),
(18, '+375', 'Belarus', NULL, NULL),
(19, '+32', 'Belgium', NULL, NULL),
(20, '+501', 'Belize', NULL, NULL),
(21, '+229', 'Benin', NULL, NULL),
(22, '+1', 'Bermuda', NULL, NULL),
(23, '++975', 'Bhutan', NULL, NULL),
(24, '+591', 'Bolivia', NULL, NULL),
(25, '+599', 'AlbaniaBonaire, Sint Eustatius and Saba', NULL, NULL),
(26, '+387', 'Bosnia and Herzegovina', NULL, NULL),
(27, '+267', 'Botswana', NULL, NULL),
(28, '+55', 'Brazil', NULL, NULL),
(29, '+246', 'British Indian Ocean Territory', NULL, NULL),
(30, '+1', 'British Virgin Islands', NULL, NULL),
(31, '+673', 'Brunei', NULL, NULL),
(32, '+359', 'Bulgaria', NULL, NULL),
(33, '+226', 'Burkina', NULL, NULL),
(34, '+257', 'Burundi', NULL, NULL),
(35, '+855', 'Cambodia', NULL, NULL),
(36, '+237', 'Cameroon', NULL, NULL),
(37, '+1', 'Canada', NULL, NULL),
(38, '+238', 'Cape Verde', NULL, NULL),
(39, '+1', 'Cayman Islands', NULL, NULL),
(40, '+236', 'Central African Republic', NULL, NULL),
(41, 'Chad', 'Chad', NULL, NULL),
(42, '+56', 'Chile', NULL, NULL),
(43, '+86', 'China', NULL, NULL),
(44, '+57', 'Colombia', NULL, NULL),
(45, '+269', 'Comoros', NULL, NULL),
(46, '+682', 'Cook Islands', NULL, NULL),
(47, '+506', 'Costa Rica', NULL, NULL),
(48, '+225', 'Côte d\'Ivoire', NULL, NULL),
(49, '+385', 'Croatia', NULL, NULL),
(50, '+53', 'Cuba', NULL, NULL),
(51, '+599', 'Curaçao', NULL, NULL),
(52, '+357', 'Cyprus', NULL, NULL),
(53, '+420', 'Czech Republic', NULL, NULL),
(54, '+243', 'Democratic Republic of the Congo', NULL, NULL),
(55, '+45', 'Denmark', NULL, NULL),
(56, '+253', 'Djibouti', NULL, NULL),
(57, '+1', 'Dominica', NULL, NULL),
(58, '+1', 'Dominican Republic', NULL, NULL),
(59, '+593', 'Ecuador', NULL, NULL),
(60, '+20', 'Egypt', NULL, NULL),
(61, '+503', 'El Salvador', NULL, NULL),
(62, '+240', 'Equatorial Guinea', NULL, NULL),
(63, '+291', 'Eritrea', NULL, NULL),
(64, '+372', 'Estonia', NULL, NULL),
(65, '+251', 'Ethiopia', NULL, NULL),
(66, '+500', 'Falkland Islands', NULL, NULL),
(67, '+298', 'Faroe Islands', NULL, NULL),
(68, '+691', 'Federated States of Micronesia', NULL, NULL),
(69, '+679', 'Fiji', NULL, NULL),
(70, '+358', 'Finland', NULL, NULL),
(71, '+33', 'France', NULL, NULL),
(72, '+594', 'French Guiana', NULL, NULL),
(73, '+689', 'French Polynesia', NULL, NULL),
(74, '+241', 'Gabon', NULL, NULL),
(75, '+995', 'Georgia', NULL, NULL),
(76, '+49', 'Germany', NULL, NULL),
(77, '+233', 'Ghana', NULL, NULL),
(78, '+350', 'Gibraltar', NULL, NULL),
(79, '+30', 'Greece', NULL, NULL),
(80, '+299', 'Greenland', NULL, NULL),
(81, '+1', 'Grenada', NULL, NULL),
(82, '+590', 'Guadeloupe', NULL, NULL),
(83, '+1', 'Guam', NULL, NULL),
(84, '+502', 'Guatemala', NULL, NULL),
(85, '+44', 'Guernsey', NULL, NULL),
(86, '+224', 'Guinea', NULL, NULL),
(87, '+245', 'Guinea-Bissau', NULL, NULL),
(88, '+592', 'Guyana', NULL, NULL),
(89, '+509', 'Haiti', NULL, NULL),
(90, '+504', 'Honduras', NULL, NULL),
(91, '+852', 'Hong Kong', NULL, NULL),
(92, '+36', 'Hungary', NULL, NULL),
(93, '+354', 'Iceland', NULL, NULL),
(94, '+91', 'India', NULL, NULL),
(95, '+62', 'Indonesia', NULL, NULL),
(96, '+98', 'Iran', NULL, NULL),
(97, '+964', 'Iraq', NULL, NULL),
(98, '+353', 'Ireland', NULL, NULL),
(99, '+44', 'Isle Of Man', NULL, NULL),
(100, '+972', 'Israel', NULL, NULL),
(101, '+39', 'Italy', NULL, NULL),
(102, '+1', 'Jamaica', NULL, NULL),
(103, '+81', 'Japan', NULL, NULL),
(104, '+44', 'Jersey', NULL, NULL),
(105, '+962', 'Jordan', NULL, NULL),
(106, '+7', 'Kazakhstan', NULL, NULL),
(107, '+254', 'Kenya', NULL, NULL),
(108, '+686', 'Kiribati', NULL, NULL),
(109, '+381', 'Kosovo', NULL, NULL),
(110, '+965', 'Kuwait', NULL, NULL),
(111, '+996', 'Kyrgyzstan', NULL, NULL),
(112, '+856', 'Laos', NULL, NULL),
(113, '+371', 'Latvia', NULL, NULL),
(114, '+961', 'Lebanon', NULL, NULL),
(115, '+266', 'Lesotho', NULL, NULL),
(116, '+231', 'Liberia', NULL, NULL),
(117, '+218', 'Libya', NULL, NULL),
(118, '+423', 'Liechtenstein', NULL, NULL),
(119, '+370', 'Lithuania', NULL, NULL),
(120, '+352', 'Luxembourg', NULL, NULL),
(121, '+853', 'Macau', NULL, NULL),
(122, '+389', 'Macedonia', NULL, NULL),
(123, '+261', 'Madagascar', NULL, NULL),
(124, '+265', 'Malawi', NULL, NULL),
(125, '+60', 'Malaysia', NULL, NULL),
(126, '+960', 'Maldives', NULL, NULL),
(127, '+223', 'Mali', NULL, NULL),
(128, '+356', 'Malta', NULL, NULL),
(129, '+692', 'Marshall Islands', NULL, NULL),
(130, '+596', 'Martinique', NULL, NULL),
(131, '+222', 'Mauritania', NULL, NULL),
(132, '+230', 'Mauritius', NULL, NULL),
(133, '+262', 'Mayotte', NULL, NULL),
(134, '+52', 'Mexico', NULL, NULL),
(135, '+373', 'Moldova', NULL, NULL),
(136, '+377', 'Monaco', NULL, NULL),
(137, '+976', 'Mongolia', NULL, NULL),
(138, '+382', 'Montenegro', NULL, NULL),
(139, '+1', 'Montserrat', NULL, NULL),
(140, '+212', 'Morocco', NULL, NULL),
(141, '+258', 'Mozambique', NULL, NULL),
(142, '+95', 'Myanmar', NULL, NULL),
(143, '+264', 'Namibia', NULL, NULL),
(144, '+674', 'Nauru', NULL, NULL),
(145, '+977', 'Nepal', NULL, NULL),
(146, '+31', 'Netherlands', NULL, NULL),
(147, '+687', 'New Caledonia', NULL, NULL),
(148, '+64', 'New Zealand', NULL, NULL),
(149, '+505', 'Nicaragua', NULL, NULL),
(150, '+227', 'Niger', NULL, NULL),
(151, '+234', 'Nigeria', NULL, NULL),
(152, '+683', 'Niue', NULL, NULL),
(153, '+672', 'Norfolk Island', NULL, NULL),
(154, '+850', 'North Korea', NULL, NULL),
(155, '+1', 'Northern Mariana Islands', NULL, NULL),
(156, '+47', 'Norway', NULL, NULL),
(157, '+968', 'Oman', NULL, NULL),
(158, '+92', 'Pakistan', NULL, NULL),
(159, '+680', 'Palau', NULL, NULL),
(160, '+970', 'Palestine', NULL, NULL),
(161, '+507', 'Panama', NULL, NULL),
(162, '+675', 'Papua New Guinea', NULL, NULL),
(163, '+595', 'Paraguay', NULL, NULL),
(164, '+51', 'Peru', NULL, NULL),
(165, '+63', 'Philippines', NULL, NULL),
(166, '+48', 'Poland', NULL, NULL),
(167, '+351', 'Portugal', NULL, NULL),
(168, '+1', 'Puerto Rico', NULL, NULL),
(169, '+974', 'villain', NULL, NULL),
(170, '000', 'Qatar', NULL, NULL),
(171, '+242', 'Republic of the Congo', NULL, NULL),
(172, '+262', 'Réunion', NULL, NULL),
(173, '+40', 'Romania', NULL, NULL),
(174, '+7', 'Russia', NULL, NULL),
(175, '+250', 'Rwanda', NULL, NULL),
(176, '+590', 'Saint Barthélemy', NULL, NULL),
(177, '+290', 'Saint Helena', NULL, NULL),
(178, '+1', 'Saint Kitts and Nevis', NULL, NULL),
(179, '+590', 'Saint Martin', NULL, NULL),
(180, '+508', 'Saint Pierre and Miquelon', NULL, NULL),
(181, '+1', 'Saint Vincent and the Grenadines', NULL, NULL),
(182, '+685', 'Samoa', NULL, NULL),
(183, '+378', 'San Marino', NULL, NULL),
(184, '+239', 'Sao Tome and Principe', NULL, NULL),
(185, '+966', 'Saudi Arabia', NULL, NULL),
(186, '+221', 'Senegal', NULL, NULL),
(187, '+381', 'Serbia', NULL, NULL),
(188, '+248', 'Seychelles', NULL, NULL),
(189, '+232', 'Sierra Leone', NULL, NULL),
(190, '+65', 'Singapore', NULL, NULL),
(191, '+599', 'Sint Maarten', NULL, NULL),
(192, '+421', 'Slovakia', NULL, NULL),
(193, '+386', 'Slovenia', NULL, NULL),
(194, '+677', 'Solomon Islands', NULL, NULL),
(195, '+252', 'Somalia', NULL, NULL),
(196, '+27', 'South Africa', NULL, NULL),
(197, '+82', 'South Korea', NULL, NULL),
(198, '+211', 'South Sudan', NULL, NULL),
(199, '+34', 'Spain', NULL, NULL),
(200, '+94', 'Sri Lanka', NULL, NULL),
(201, '+1', 'St. Lucia', NULL, NULL),
(202, '+249', 'Sudan', NULL, NULL),
(203, '+597', 'Suriname', NULL, NULL),
(204, '+268', 'Swaziland', NULL, NULL),
(205, '+46', 'Sweden', NULL, NULL),
(206, '+41', 'Switzerland', NULL, NULL),
(207, '+963', 'Syria', NULL, NULL),
(208, '+886', 'Taiwan', NULL, NULL),
(209, '+992', 'Tajikistan', NULL, NULL),
(210, '+255', 'Tanzania', NULL, NULL),
(211, '+66', 'Thailand', NULL, NULL),
(212, '+1', 'The Bahamas', NULL, NULL),
(213, '+220', 'The Gambia', NULL, NULL),
(214, '+670', 'Timor-Leste', NULL, NULL),
(215, '+228', 'Togo', NULL, NULL),
(216, '+690', 'Tokelau', NULL, NULL),
(217, '+676', 'Tonga', NULL, NULL),
(218, '+1', 'Trinidad and Tobago', NULL, NULL),
(219, '+216', 'Tunisia', NULL, NULL),
(220, '+90', 'Turkey', NULL, NULL),
(221, '+993', 'Turkmenistan', NULL, NULL),
(222, '+1', 'Turks and Caicos Islands', NULL, NULL),
(223, '+688', 'Tuvalu', NULL, NULL),
(224, '+256', 'Uganda', NULL, NULL),
(225, '+380', 'Ukraine', NULL, NULL),
(226, '+971', 'United Arab Emirates', NULL, NULL),
(227, '+44', 'United Kingdom', NULL, NULL),
(228, '+1', 'United States', NULL, NULL),
(229, '+598', 'Uruguay', NULL, NULL),
(230, '+1', 'US Virgin Islands', NULL, NULL),
(231, '+998', 'Uzbekistan', NULL, NULL),
(232, '+678', 'Vanuatu', NULL, NULL),
(233, '+39', 'Vatican City', NULL, NULL),
(234, '+58', 'Venezuela', NULL, NULL),
(235, '+84', 'Vietnam', NULL, NULL),
(236, '+681', 'Wallis and Futuna', NULL, NULL),
(237, '+212', 'Western Sahara', NULL, NULL),
(238, '+967', 'Yemen', NULL, NULL),
(239, '+260', 'Zambia', NULL, NULL),
(240, '+263', 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_discount_types`
--

CREATE TABLE `customer_discount_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) CHARACTER SET utf16 NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_discount_types`
--

INSERT INTO `customer_discount_types` (`id`, `type`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'Normal', '0', '2018-09-11 12:16:36', '2018-09-11 12:16:36'),
(2, 'Silver', '3', '2018-09-11 12:16:52', '2018-09-11 12:16:52'),
(3, 'Gold', '5', '2018-09-11 12:17:03', '2018-09-11 12:17:03'),
(4, 'Platinum', '7', '2018-09-11 12:17:12', '2018-09-11 12:17:12'),
(5, 'Platinum Plus', '10', '2018-09-11 12:17:21', '2018-09-11 12:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `customer_infos`
--

CREATE TABLE `customer_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `type` tinyint(4) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `personal_mobile` varchar(191) CHARACTER SET utf16 NOT NULL,
  `alt_mobile` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `nid` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `country` tinyint(4) NOT NULL,
  `city` varchar(191) CHARACTER SET utf16 NOT NULL,
  `area` varchar(191) CHARACTER SET utf16 NOT NULL,
  `post_code` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `house_address` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `comment` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `img` varchar(191) CHARACTER SET utf16 DEFAULT NULL,
  `cid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'createing user id',
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'updating user id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'regular (morning)', '2018-09-12 00:06:15', '2018-09-12 00:27:10');

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
(3, '2018_07_29_051711_create_roles_table', 1),
(4, '2018_07_29_052915_create_basic_settings_table', 1),
(5, '2018_07_29_053732_create_sessions_table', 1),
(6, '2018_08_04_144904_create_categories_table', 1),
(7, '2018_08_06_043025_create_notifications_table', 1),
(8, '2018_08_06_061239_create_branches_table', 1),
(9, '2018_08_09_210004_create_products_table', 1),
(10, '2018_08_22_221950_create_customer_discount_types_table', 1),
(11, '2018_08_23_215325_create_countries_table', 1),
(12, '2018_08_24_155101_create_customer_infos_table', 1),
(13, '2018_09_12_115403_create_customer_types_table', 1),
(14, '2018_09_16_093321_create_sells_table', 2),
(15, '2018_09_16_094519_create_payments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` varchar(191) CHARACTER SET utf16 NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_date` date NOT NULL,
  `total_subtotal` double(8,2) NOT NULL,
  `vat` double(8,2) DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `total_bill` double(8,2) NOT NULL,
  `receive` double(8,2) NOT NULL,
  `advance` double(8,2) DEFAULT NULL,
  `due` double(8,2) DEFAULT NULL,
  `return` double(8,2) DEFAULT NULL,
  `create_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `img`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Milk', '1', 60.51, NULL, 0, '2018-09-13 10:47:32', '2018-09-13 10:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_type`) VALUES
(4, 'Accountant'),
(2, 'Admin'),
(1, 'Administrator'),
(3, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_date` date NOT NULL,
  `cat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uint_price` double(8,2) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `unit` double(8,2) NOT NULL,
  `subtotal` double(8,2) DEFAULT NULL,
  `create_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = principal branch',
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = active, 1 = not active',
  `block` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `branch`, `activation_code`, `status`, `block`, `role`, `img`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Md. Masudzzaman', 'admin@admin.com', '$2y$10$i.21.xluapYRqV9hq8lAdO7.5ihl4V/8l6BcPWMWOcm/590lBrzAm', '0', NULL, 0, '0', '1', NULL, 'jkQ8Pr0xZwx8fp9CmRS4r11sIxLPoVxMvdFRj7Bc19xh925kkVhQsdy50joK', '2018-09-11 11:15:29', '2018-09-11 13:48:46'),
(15, 'ullash', 'ullash099@gmail.com', '$2y$10$HO0ItMxbTYUntS0GE6OF0ugCMQx2kwcd42.4FGHFHtInAOIlkIq7.', '0', NULL, 0, '0', '2', NULL, 'keCaT63J2wwBSjo5L66YVgovDYaysuuehHlriVUtH3y1nJfHSFlKVmzBSPYP', '2018-09-11 13:22:47', '2018-09-11 13:38:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_discount_types`
--
ALTER TABLE `customer_discount_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_infos`
--
ALTER TABLE `customer_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_infos_personal_mobile_unique` (`personal_mobile`),
  ADD UNIQUE KEY `customer_infos_nid_unique` (`nid`),
  ADD UNIQUE KEY `customer_infos_email_unique` (`email`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_type_unique` (`role_type`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `customer_discount_types`
--
ALTER TABLE `customer_discount_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_infos`
--
ALTER TABLE `customer_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
