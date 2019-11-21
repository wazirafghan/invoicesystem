-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2019 at 02:26 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@domain.com', '$2y$10$sleQZbz6f233cuRus8r0QeyrFRo1lhBChKCkr1fIECnugVCBZQTM2', 1, NULL, '2019-10-01 05:40:27', '2019-10-01 05:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_business_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `title`, `pic`, `user_id`, `from_name`, `from_email`, `from_address`, `from_phone`, `from_business_num`, `invoice_num`, `date`, `terms`, `to_name`, `to_email`, `to_address`, `to_phone`, `notes`, `discount`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Test', NULL, 1, 'Demo Demo', 'user@domain.com', 'What ever', '34534534534', '435', 'Invo3453', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '34534534543', 'What ever', NULL, NULL, 57.00, '2019-10-01 04:16:09', '2019-10-01 04:16:09'),
(2, 'Test', NULL, 1, 'Demo Demo', 'user@domain.com', 'What ever', '34534534534', '435', 'Invo3453', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '34534534543', 'What ever', NULL, NULL, 57.00, '2019-10-01 04:26:12', '2019-10-01 04:26:12'),
(3, 'Second test session', NULL, 1, 'Demo Demo', 'user@domain.com', 'What ever', '456876', '546', 'Invo34535', '2019-10-11', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '4645645', 'What Ever', NULL, NULL, 900.00, '2019-10-01 05:05:22', '2019-10-01 05:05:22'),
(4, 'Your Content Goes Here', NULL, 1, 'Kyle Kemp', 'user@domain.com', '53 Crown Street', '23423', '352352', 'Invo34533', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '32423', 'asdas', 5.00, NULL, 54.15, '2019-10-01 06:10:14', '2019-10-01 06:10:14'),
(5, 'First Title', '1569931642Approved Invoices.png', 1, 'Demo Demo', 'user@domain.com', 'What ever', '345235', '345', '345', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '345', 'asdsad', 0.00, NULL, 0.00, '2019-10-01 07:07:22', '2019-10-01 07:07:22'),
(6, 'First Title', '1569931925Approved Invoices.png', 1, 'Demo Demo', 'user@domain.com', 'What ever', '345235', '345', '345', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '345', 'asdsad', 0.00, NULL, 0.00, '2019-10-01 07:12:05', '2019-10-01 07:12:05'),
(7, 'First Title', '1569931987Approved Invoices.png', 1, 'Demo Demo', 'user@domain.com', 'What ever', '345235', '345', '345', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '345', 'asdsad', 0.00, NULL, 0.00, '2019-10-01 07:13:07', '2019-10-01 07:13:07'),
(8, 'First Title', '1569932040Approved Invoices.png', 1, 'Demo Demo', 'user@domain.com', 'What ever', '345235', '345', '345', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '345', 'asdsad', 0.00, NULL, 0.00, '2019-10-01 07:14:00', '2019-10-01 07:14:00'),
(9, 'First Title', '1569932095Approved Invoices.png', 1, 'Demo Demo', 'user@domain.com', 'What ever', '345235', '345', '345', '2019-10-16', NULL, 'Demo Demo', 'user@domain.com', 'What ever', '345', 'asdsad', 0.00, NULL, 0.00, '2019-10-01 07:14:55', '2019-10-01 07:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(8,2) NOT NULL,
  `qty` double(8,2) NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `description`, `rate`, `qty`, `detail`, `tax`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdfsd', 34.00, 1.00, 'sdfsdf', NULL, '2019-10-01 04:16:09', '2019-10-01 04:16:09'),
(2, 1, 'asdsa', 23.00, 1.00, 'asdas', NULL, '2019-10-01 04:16:09', '2019-10-01 04:16:09'),
(3, 2, 'sdfsd', 34.00, 1.00, 'sdfsdf', NULL, '2019-10-01 04:26:12', '2019-10-01 04:26:12'),
(4, 2, 'asdsa', 23.00, 1.00, 'asdas', NULL, '2019-10-01 04:26:12', '2019-10-01 04:26:12'),
(5, 3, 'sdfsd', 23.00, 14.00, 'sdfdfg', NULL, '2019-10-01 05:05:22', '2019-10-01 05:05:22'),
(6, 3, 'sdfsd', 34.00, 17.00, 'asfdf', NULL, '2019-10-01 05:05:22', '2019-10-01 05:05:22'),
(7, 4, 'asd', 23.00, 1.00, 'asd', NULL, '2019-10-01 06:10:14', '2019-10-01 06:10:14'),
(8, 4, '343', 34.00, 1.00, 'sd', NULL, '2019-10-01 06:10:14', '2019-10-01 06:10:14'),
(9, 5, 'sdfsd', 34.00, 1.00, '34', NULL, '2019-10-01 07:07:22', '2019-10-01 07:07:22'),
(10, 6, 'sdfsd', 34.00, 1.00, '34', NULL, '2019-10-01 07:12:05', '2019-10-01 07:12:05'),
(11, 7, 'sdfsd', 34.00, 1.00, '34', NULL, '2019-10-01 07:13:07', '2019-10-01 07:13:07'),
(12, 8, 'sdfsd', 34.00, 1.00, '34', NULL, '2019-10-01 07:14:00', '2019-10-01 07:14:00'),
(13, 9, 'sdfsd', 34.00, 1.00, '34', NULL, '2019-10-01 07:14:55', '2019-10-01 07:14:55');

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
(3, '2018_12_28_100229_create_admins_table', 1),
(4, '2019_01_24_092244_create_settings_table', 1),
(5, '2019_10_01_053220_create_invoices_table', 1),
(6, '2019_10_01_053247_create_invoice_items_table', 2);

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(2, 'meta_keywords', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(3, 'meta_desc', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(4, 'facebook_page_url', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(5, 'linkedin_url', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(6, 'instagram_url', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(7, 'youtube_url', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(8, 'contact_number', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(9, 'email', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(10, 'address', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(11, 'google_analytics', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(12, 'google_analytics_client_id', NULL, '2019-10-01 06:00:39', '2019-10-01 06:00:39'),
(13, 'footer_text', NULL, '2019-10-01 06:00:40', '2019-10-01 06:00:40'),
(14, 'logo', '1569927639Approved Invoices.png', '2019-10-01 06:00:40', '2019-10-01 06:00:40'),
(15, 'favicon', '', '2019-10-01 06:00:40', '2019-10-01 06:00:40'),
(16, 'stripe_enable', '0', '2019-10-01 06:00:40', '2019-10-01 06:00:40'),
(17, 'paypal_enable', '0', '2019-10-01 06:00:40', '2019-10-01 06:00:40'),
(18, 'p_mode', '0', '2019-10-01 06:00:40', '2019-10-01 06:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@domain.com', '$2y$10$sleQZbz6f233cuRus8r0QeyrFRo1lhBChKCkr1fIECnugVCBZQTM2', 't4O2nH8lKer5bIRZdB18kdQwCiDLP78nx6tn0ovSmOfthg9nPITkt10meoBJ', '2019-10-01 07:36:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
