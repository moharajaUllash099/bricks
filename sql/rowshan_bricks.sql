-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 06:41 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rowshan_bricks`
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
(1, 'company', 'এস. এন. ব্রিকস', NULL, NULL),
(2, 'company', 'এস. এন. ব্রিকস', NULL, NULL),
(3, 'phone', '01716678168', NULL, NULL),
(4, 'email', '', NULL, NULL),
(5, 'currency', 'BDT', NULL, NULL),
(6, 'print_auther_info', 'off', NULL, NULL),
(7, 'permissible_branch', '2', NULL, NULL);

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

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `phone`, `email`, `vat_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'এস. এন. ব্রিকস - গয়েশপুর', '<p>গয়েশপুর, পাগলাকানাই, ঝিনাইদাহ<br></p>', '01716678168', NULL, NULL, '0', '2018-11-05 10:57:43', '2018-11-05 10:57:43'),
(2, 'এস. এন. ব্রিকস - গয়েশপুর ২', '<p>গয়েশপুর, পাগলাকানাই, ঝিনাইদাহ<br></p>', '01716678168', NULL, NULL, '0', '2018-11-05 11:11:11', '2018-11-05 11:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `buy_categories`
--

CREATE TABLE `buy_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_categories`
--

INSERT INTO `buy_categories` (`id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'কাঁচামাল', 0, '2018-11-06 13:51:25', '2018-11-06 13:51:25'),
(2, 'মালপত্র', 0, '2018-11-06 13:51:34', '2018-11-06 13:51:34'),
(3, 'জ্বালানী', 0, '2018-11-06 13:51:56', '2018-11-06 13:51:56'),
(4, 'অন্যান্য', 0, '2018-11-06 13:52:02', '2018-11-06 16:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `buy_products`
--

CREATE TABLE `buy_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_products`
--

INSERT INTO `buy_products` (`id`, `name`, `category`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'কয়লা', '3', 0, '2018-11-06 13:52:57', '2018-11-06 13:52:57'),
(2, 'শুকনো কাঠ', '3', 0, '2018-11-06 14:01:04', '2018-11-06 16:09:35');

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
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `branch` tinyint(4) NOT NULL,
  `designation` tinyint(4) NOT NULL,
  `dob` date NOT NULL,
  `joining_date` date NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `branch`, `designation`, `dob`, `joining_date`, `personal_mobile`, `alt_mobile`, `nid`, `email`, `country`, `city`, `area`, `post_code`, `house_address`, `comment`, `img`, `created_at`, `updated_at`) VALUES
(1, 'মাসুদ 2', 0, 2, '1989-07-15', '2018-11-06', '01723769900', NULL, NULL, NULL, 16, 'ঢাকা', 'মোহাম্মদপুর', '1207', NULL, NULL, NULL, '2018-11-06 05:00:30', '2018-11-06 05:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `employee_designations`
--

CREATE TABLE `employee_designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_designations`
--

INSERT INTO `employee_designations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ম্যানেজান', '2018-11-05 11:35:08', '2018-11-05 11:40:00'),
(2, 'কোষাধ্যক্ষ', '2018-11-05 11:41:04', '2018-11-05 11:41:38'),
(3, 'কোষাধ্যক্ষ ২', '2018-11-06 04:58:51', '2018-11-06 04:58:51');

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
(6, '2018_08_06_043025_create_notifications_table', 1),
(7, '2018_08_06_061239_create_branches_table', 1),
(8, '2018_08_23_215325_create_countries_table', 2),
(9, '2018_09_22_215031_create_employee_designations_table', 3),
(10, '2018_09_23_081758_create_employees_table', 4),
(11, '2018_11_06_170856_create_buy_categories_table', 5),
(12, '2018_11_06_194721_create_buy_products_table', 6),
(13, '2018_11_06_223213_create_products_table', 7);

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `uid`, `role`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (company)', '1', '2018-11-05 10:40:09', NULL),
(2, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (company)', '1', '2018-11-05 10:40:09', NULL),
(3, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (phone)', '1', '2018-11-05 10:40:09', NULL),
(4, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (phone)', '1', '2018-11-05 10:40:09', NULL),
(5, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (email)', '1', '2018-11-05 10:40:10', NULL),
(6, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (email)', '1', '2018-11-05 10:40:10', NULL),
(7, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (currency)', '1', '2018-11-05 10:40:10', NULL),
(8, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (currency)', '1', '2018-11-05 10:40:10', NULL),
(9, 'Mr. Md. Masudzzaman', '1', '1', 'set new general information (print_auther_info)', '1', '2018-11-05 10:40:10', NULL),
(10, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (print_auther_info)', '1', '2018-11-05 10:40:10', NULL),
(11, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (company)', '1', '2018-11-05 10:40:39', NULL),
(12, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (phone)', '1', '2018-11-05 10:40:39', NULL),
(13, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (email)', '1', '2018-11-05 10:40:39', NULL),
(14, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (currency)', '1', '2018-11-05 10:40:39', NULL),
(15, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (print_auther_info)', '1', '2018-11-05 10:40:40', NULL),
(16, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (company)', '1', '2018-11-05 10:40:51', NULL),
(17, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (phone)', '1', '2018-11-05 10:40:52', NULL),
(18, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (email)', '1', '2018-11-05 10:40:52', NULL),
(19, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (currency)', '1', '2018-11-05 10:40:52', NULL),
(20, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (print_auther_info)', '1', '2018-11-05 10:40:52', NULL),
(21, 'Mr. Md. Masudzzaman', '1', '1', 'open a new branch (এস. এন. ব্রিকস - গয়েশপুর) .', '1', '2018-11-05 10:57:43', NULL),
(22, 'Mr. Md. Masudzzaman', '1', '1', 'update branch information (এস. এন. ব্রিকস - গয়েশপুর) .', '1', '2018-11-05 11:09:27', NULL),
(23, 'Mr. Md. Masudzzaman', '1', '1', 'update branch information (এস. এন. ব্রিকস - গয়েশপুর) .', '1', '2018-11-05 11:09:32', NULL),
(24, 'Mr. Md. Masudzzaman', '1', '1', 'update branch information (এস. এন. ব্রিকস - গয়েশপুর) .', '1', '2018-11-05 11:10:29', NULL),
(25, 'Mr. Md. Masudzzaman', '1', '1', 'open a new branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:11:11', NULL),
(26, 'Mr. Md. Masudzzaman', '1', '1', 'shut down a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:13:51', NULL),
(27, 'Mr. Md. Masudzzaman', '1', '1', 'reopen a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:13:55', NULL),
(28, 'Mr. Md. Masudzzaman', '1', '1', 'shut down a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:14:07', NULL),
(29, 'Mr. Md. Masudzzaman', '1', '1', 'reopen a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:17:22', NULL),
(30, 'Mr. Md. Masudzzaman', '1', '1', 'shut down a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:25:33', NULL),
(31, 'Mr. Md. Masudzzaman', '1', '1', 'reopen a branch (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-05 11:25:45', NULL),
(32, 'Mr. Md. Masudzzaman', '1', '1', 'Add a new designation (Manager) .', '1', '2018-11-05 11:35:08', NULL),
(33, 'Mr. Md. Masudzzaman', '1', '1', 'update designation to (ম্যানেজান) .', '1', '2018-11-05 11:40:00', NULL),
(34, 'Mr. Md. Masudzzaman', '1', '1', 'Add a new designation (fsdfs) .', '1', '2018-11-05 11:41:04', NULL),
(35, 'Mr. Md. Masudzzaman', '1', '1', 'update designation to (কোষাধ্যক্ষ) .', '1', '2018-11-05 11:41:38', NULL),
(36, 'Mr. Md. Masudzzaman', '1', '1', 'Add a new designation (কোষাধ্যক্ষ ২) .', '1', '2018-11-06 04:58:51', NULL),
(37, 'Mr. Md. Masudzzaman', '1', '1', 'Register a new employee (মাসুদ) .', '1', '2018-11-06 05:00:30', NULL),
(38, 'Mr. Md. Masudzzaman', '1', '1', 'update employee information (মাসুদ)', '1', '2018-11-06 05:23:56', NULL),
(39, 'Mr. Md. Masudzzaman', '1', '1', 'update branch information (এস. এন. ব্রিকস - গয়েশপুর ২) .', '1', '2018-11-06 05:36:36', NULL),
(40, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (company)', '1', '2018-11-06 05:36:42', NULL),
(41, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (phone)', '1', '2018-11-06 05:36:42', NULL),
(42, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (email)', '1', '2018-11-06 05:36:42', NULL),
(43, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (currency)', '1', '2018-11-06 05:36:42', NULL),
(44, 'Mr. Md. Masudzzaman', '1', '1', 'update on general information (print_auther_info)', '1', '2018-11-06 05:36:43', NULL),
(45, 'Mr. Md. Masudzzaman', '1', '1', 'update employee information (মাসুদ 2)', '1', '2018-11-06 05:37:09', NULL),
(46, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (কাঁচামাল) .', '1', '2018-11-06 11:18:47', NULL),
(47, 'Mr. Md. Masudzzaman', '1', '1', 'update buy category information (কাঁচামাল u1)', '1', '2018-11-06 11:39:24', NULL),
(48, 'Mr. Md. Masudzzaman', '1', '1', 'update buy category information (কাঁচামাল)', '1', '2018-11-06 11:39:34', NULL),
(49, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (মালপত্র) .', '1', '2018-11-06 11:41:50', NULL),
(50, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (কয়লা) .', '1', '2018-11-06 11:42:31', NULL),
(51, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (শুকনো কাঠ) .', '1', '2018-11-06 11:43:14', NULL),
(52, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (অন্যান্য) .', '1', '2018-11-06 11:43:47', NULL),
(53, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (কাঁচামাল) .', '1', '2018-11-06 13:51:25', NULL),
(54, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (মালপত্র) .', '1', '2018-11-06 13:51:34', NULL),
(55, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (জ্বালানী) .', '1', '2018-11-06 13:51:56', NULL),
(56, 'Mr. Md. Masudzzaman', '1', '1', 'open a new category (অন্যান্য) .', '1', '2018-11-06 13:52:02', NULL),
(57, 'Mr. Md. Masudzzaman', '1', '1', 'create a new product for buy (কয়লা) .', '1', '2018-11-06 13:52:57', NULL),
(58, 'Mr. Md. Masudzzaman', '1', '1', 'create a new product for buy (শুকনো কাঠ) .', '1', '2018-11-06 14:01:04', NULL),
(59, 'Mr. Md. Masudzzaman', '1', '1', 'update buy product information (শুকনো কাঠ u1)', '1', '2018-11-06 15:55:43', NULL),
(60, 'Mr. Md. Masudzzaman', '1', '1', 'update buy product information (শুকনো কাঠ)', '1', '2018-11-06 15:55:58', NULL),
(61, 'Mr. Md. Masudzzaman', '1', '1', 'deactivate a buy product categories (অন্যান্য) .', '1', '2018-11-06 16:02:11', NULL),
(62, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:52', NULL),
(63, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:52', NULL),
(64, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:52', NULL),
(65, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:53', NULL),
(66, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:53', NULL),
(67, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:53', NULL),
(68, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:54', NULL),
(69, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:54', NULL),
(70, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:55', NULL),
(71, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:55', NULL),
(72, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:55', NULL),
(73, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:56', NULL),
(74, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:56', NULL),
(75, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:56', NULL),
(76, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:57', NULL),
(77, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:57', NULL),
(78, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:58', NULL),
(79, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:58', NULL),
(80, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:58', NULL),
(81, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:02:59', NULL),
(82, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:03', NULL),
(83, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:03', NULL),
(84, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:04', NULL),
(85, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:04', NULL),
(86, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:05', NULL),
(87, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:05', NULL),
(88, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:05', NULL),
(89, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:06', NULL),
(90, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:06', NULL),
(91, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:06', NULL),
(92, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:07', NULL),
(93, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:07', NULL),
(94, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:08', NULL),
(95, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:08', NULL),
(96, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:09', NULL),
(97, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:09', NULL),
(98, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:09', NULL),
(99, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:10', NULL),
(100, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:10', NULL),
(101, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:11', NULL),
(102, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:16', NULL),
(103, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:16', NULL),
(104, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:17', NULL),
(105, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:17', NULL),
(106, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:18', NULL),
(107, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:18', NULL),
(108, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:18', NULL),
(109, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:19', NULL),
(110, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:19', NULL),
(111, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:19', NULL),
(112, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:20', NULL),
(113, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:20', NULL),
(114, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:21', NULL),
(115, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:21', NULL),
(116, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:21', NULL),
(117, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:22', NULL),
(118, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:22', NULL),
(119, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:22', NULL),
(120, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:23', NULL),
(121, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:23', NULL),
(122, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:23', NULL),
(123, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:24', NULL),
(124, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:24', NULL),
(125, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:25', NULL),
(126, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:25', NULL),
(127, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:26', NULL),
(128, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:26', NULL),
(129, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:27', NULL),
(130, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:27', NULL),
(131, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:27', NULL),
(132, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:28', NULL),
(133, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:28', NULL),
(134, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:28', NULL),
(135, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:29', NULL),
(136, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:29', NULL),
(137, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:29', NULL),
(138, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:03:30', NULL),
(139, 'Mr. Md. Masudzzaman', '1', '1', 'deactivate a buy product categories (অন্যান্য) .', '1', '2018-11-06 16:03:52', NULL),
(140, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a categories (অন্যান্য) .', '1', '2018-11-06 16:04:11', NULL),
(141, 'Mr. Md. Masudzzaman', '1', '1', 'deactivate a buy product (শুকনো কাঠ) .', '1', '2018-11-06 16:09:00', NULL),
(142, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a buy product (শুকনো কাঠ) .', '1', '2018-11-06 16:09:35', NULL),
(143, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (পিকেট) .', '1', '2018-11-06 16:36:58', NULL),
(144, 'Mr. Md. Masudzzaman', '1', '1', 'update product information (পিকেট)', '1', '2018-11-06 16:48:15', NULL),
(145, 'Mr. Md. Masudzzaman', '1', '1', 'update product information (পিকেট u1)', '1', '2018-11-06 16:48:24', NULL),
(146, 'Mr. Md. Masudzzaman', '1', '1', 'deactivate a product (পিকেট u1) .', '1', '2018-11-06 16:50:40', NULL),
(147, 'Mr. Md. Masudzzaman', '1', '1', 'reactive a product (পিকেট u1) .', '1', '2018-11-06 16:50:50', NULL),
(148, 'Mr. Md. Masudzzaman', '1', '1', 'update product information (পিকেট)', '1', '2018-11-06 16:51:25', NULL),
(149, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (প্রথম শ্রেণি) .', '1', '2018-11-06 16:51:52', NULL),
(150, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (ইন্টার ক্লাস) .', '1', '2018-11-06 16:52:12', NULL),
(151, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (দ্বিতীয় শ্রেণি) .', '1', '2018-11-06 16:52:24', NULL),
(152, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (তৃতীয় শ্রেণি) .', '1', '2018-11-06 16:52:33', NULL),
(153, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (আধলা) .', '1', '2018-11-06 16:52:43', NULL),
(154, 'Mr. Md. Masudzzaman', '1', '1', 'open a new product (রাবিশ) .', '1', '2018-11-06 16:52:51', NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf16 NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'পিকেট', 0, '2018-11-06 16:36:57', '2018-11-06 16:51:25'),
(2, 'প্রথম শ্রেণি', 0, '2018-11-06 16:51:52', '2018-11-06 16:51:52'),
(3, 'ইন্টার ক্লাস', 0, '2018-11-06 16:52:12', '2018-11-06 16:52:12'),
(4, 'দ্বিতীয় শ্রেণি', 0, '2018-11-06 16:52:23', '2018-11-06 16:52:23'),
(5, 'তৃতীয় শ্রেণি', 0, '2018-11-06 16:52:33', '2018-11-06 16:52:33'),
(6, 'আধলা', 0, '2018-11-06 16:52:43', '2018-11-06 16:52:43'),
(7, 'রাবিশ', 0, '2018-11-06 16:52:51', '2018-11-06 16:52:51');

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
('T6VEL3fi17LChx9kN46MJc9ZH4c76G3Ugw5LTjwo', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaGZYMzlVUlZLSnFmc3o4M3hjNzl5UkZ6bVZoWXpWdzhEQ2xJVHE5ayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwOi8vbG9jYWxob3N0L2JyaWNrcy9wdWJsaWMvc2V0dGluZ3MvYnJhbmNoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1541526018);

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
(1, 'Mr. Md. Masudzzaman', 'admin@admin.com', '$2y$10$i.21.xluapYRqV9hq8lAdO7.5ihl4V/8l6BcPWMWOcm/590lBrzAm', '0', NULL, 0, '0', '1', NULL, 'jkQ8Pr0xZwx8fp9CmRS4r11sIxLPoVxMvdFRj7Bc19xh925kkVhQsdy50joK', '2018-09-11 05:15:29', '2018-09-11 07:48:46');

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
-- Indexes for table `buy_categories`
--
ALTER TABLE `buy_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_products`
--
ALTER TABLE `buy_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_personal_mobile_unique` (`personal_mobile`),
  ADD UNIQUE KEY `employees_nid_unique` (`nid`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `employee_designations`
--
ALTER TABLE `employee_designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_designations_name_unique` (`name`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buy_categories`
--
ALTER TABLE `buy_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buy_products`
--
ALTER TABLE `buy_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_designations`
--
ALTER TABLE `employee_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
