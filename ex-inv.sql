-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 03:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex-inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hardware', 'hardware', '2023-08-28 01:29:18', '2023-08-28 23:33:16', NULL),
(2, 'Alat Listrik', 'alat-listrik', '2023-08-28 01:29:26', '2023-08-28 01:29:26', NULL),
(3, 'alat ringan', 'alat-ringan', '2023-08-28 18:43:05', '2023-08-28 18:43:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departs`
--

CREATE TABLE `departs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `depart` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departs`
--

INSERT INTO `departs` (`id`, `depart`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IT', 'it', NULL, '2023-08-28 21:49:30', NULL),
(2, 'Audit', 'audit', '2023-08-28 01:29:37', '2023-08-28 01:29:37', NULL),
(3, 'Garmen', 'garmen', '2023-08-28 01:29:46', '2023-08-28 01:29:46', NULL),
(4, 'bottom', 'bottom', '2023-08-28 18:44:03', '2023-08-28 18:44:03', NULL),
(6, 'MARKETING', 'marketing', '2023-08-28 23:32:47', '2023-08-28 23:32:47', NULL);

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
-- Table structure for table `invs`
--

CREATE TABLE `invs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `stock` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'in stock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invs`
--

INSERT INTO `invs` (`id`, `inv_code`, `title`, `slug`, `stock`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IN-001', 'Mouse', 'mouse', '45', 'in stock', '2023-08-28 01:39:35', '2023-08-29 23:48:48', NULL),
(2, 'IN-002', 'Komputer', 'komputer', '200', 'in stock', '2023-08-28 02:17:08', '2023-08-29 18:41:46', NULL),
(3, 'IN-003', 'jumper', 'jumper', '253', 'in stock', '2023-08-28 02:17:17', '2023-08-29 10:57:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_categories`
--

CREATE TABLE `inv_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_categories`
--

INSERT INTO `inv_categories` (`id`, `inv_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_logs`
--

CREATE TABLE `inv_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `depart_id` bigint(20) UNSIGNED NOT NULL,
  `nickname` text NOT NULL,
  `inv_id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date NOT NULL,
  `stock` bigint(20) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `condition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_logs`
--

INSERT INTO `inv_logs` (`id`, `user_id`, `depart_id`, `nickname`, `inv_id`, `inv_date`, `stock`, `return_date`, `actual_return_date`, `created_at`, `updated_at`, `condition`) VALUES
(1, 5, 2, 'cici', 1, '2023-08-29', 25, '2023-09-01', '2023-08-30', '2023-08-29 01:34:37', '2023-08-29 23:47:57', 'rusak'),
(2, 5, 2, 'fui', 2, '2023-08-29', 1, '2023-09-01', '2023-08-29', '2023-08-29 10:57:34', '2023-08-29 10:59:12', 'bagus'),
(3, 5, 2, 'mon', 3, '2023-08-29', 4, '2023-09-01', NULL, '2023-08-29 10:57:51', '2023-08-29 10:57:51', 'bagus'),
(4, 6, 3, 'chim', 2, '2023-08-30', 24, '2023-09-02', NULL, '2023-08-29 18:41:46', '2023-08-29 18:41:46', 'bagus'),
(5, 5, 2, 'cici', 1, '2023-08-30', 30, '2023-09-02', '2023-08-30', '2023-08-29 23:43:14', '2023-08-29 23:48:48', 'rusak');

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
(78, '2014_10_12_000000_create_users_table', 1),
(79, '2014_10_12_100000_create_password_resets_table', 1),
(80, '2019_08_19_000000_create_failed_jobs_table', 1),
(81, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(82, '2023_08_09_074447_create_roles_table', 1),
(83, '2023_08_09_075833_add_role_id_column_to_users_table', 1),
(84, '2023_08_09_081418_create_categories_table', 1),
(85, '2023_08_09_081510_create_inv_table', 1),
(86, '2023_08_09_081826_create_inv_categories_table', 1),
(87, '2023_08_09_082847_create_inv_logs_table', 1),
(88, '2023_08_13_035531_add_slug_column_to_categories_table', 1),
(89, '2023_08_13_040709_change_slug_column_into_nullable_in_categories_table', 1),
(90, '2023_08_13_055730_add_soft_delete_column_to_categories_table', 1),
(91, '2023_08_13_080105_add_slug_cover_column_to_invs_table', 1),
(92, '2023_08_14_034901_add_soft_delete_to_invs_table', 1),
(93, '2023_08_14_063323_add_slug_to_users_table', 1),
(94, '2023_08_15_024644_add_softdelete_to_users_table', 1),
(95, '2023_08_22_025609_add_stock_column_to_invs_table', 1),
(96, '2023_08_23_200730_add_qty_column_to_inv_logs_table', 1),
(97, '2023_08_25_070153_create_departs_table', 1),
(98, '2023_08_25_081335_add_slug_column_to_departs_table', 1),
(99, '2023_08_25_081419_change_slug_column_into_nullable_in_departs_table', 1),
(100, '2023_08_25_081455_add_soft_delete_column_to_departs_table', 1),
(101, '2023_08_27_125944_add_depart_id_in_users_table', 1),
(102, '2023_08_28_020324_add_nickname_condition_in_inv_logs_table', 1),
(103, '2023_08_28_083530_create_user_departs_table', 2),
(104, '2023_08_29_082304_add_depart_id_in_inv_logs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'client', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `depart_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `slug`, `depart_id`, `password`, `status`, `created_at`, `updated_at`, `role_id`, `deleted_at`) VALUES
(4, 'admin', NULL, 1, '$2y$10$cv5Lywqsg7Xq9PbmHYWeKOpE.pM9AQhsLYJJzej3o8sBifeUaMY6S', 'active', NULL, NULL, 1, NULL),
(5, 'lala', 'lala', 2, '$2y$10$NhkjB8jcuvBHjzrwL/tYdOtUmaKBK0MskwctcGFtRvsLSwTjXWSQO', 'active', '2023-08-28 01:32:14', '2023-08-28 02:58:36', 2, NULL),
(6, 'shibal', 'shibal', 3, '$2y$10$d/9qTewEAeXeBG6EAVsWC.NBSo4KqNQblOhFBFM2KtqPxabA8HUDC', 'active', '2023-08-28 01:32:33', '2023-08-28 01:34:22', 2, NULL),
(7, 'kiki', 'kiki', 3, '$2y$10$ie3PcN9XKeK4PmylfCOn.u03jquLqVoTdYU3W.D4byHNRrCc6HkoW', 'active', '2023-08-28 01:32:54', '2023-08-28 01:41:00', 2, NULL),
(8, 'mint', 'mint', 3, '$2y$10$Z9Q4dPjumpu/vvJ3MaC9xuhgF6OTEvV908x9ZcxKug7RU4kYGxnQi', 'active', '2023-08-28 01:42:25', '2023-08-28 18:43:13', 2, NULL),
(9, 'aka', 'aka', 6, '$2y$10$gR8DfAjUp5RHzI5tRAE2v.KOMQOYWOMqO8c38VNdkVtWEOecS6kby', 'active', '2023-08-29 21:28:49', '2023-08-29 23:47:08', 2, NULL),
(10, 'toto', 'toto', 3, '$2y$10$SFDQW3631ptxxUDQITWx6.6OGmgNtpfXgG0YhwJwGQMSA5FOurGh6', 'inactive', '2023-08-29 21:45:42', '2023-08-29 21:45:42', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_departs`
--

CREATE TABLE `user_departs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `depart_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_departs`
--

INSERT INTO `user_departs` (`id`, `user_id`, `depart_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departs`
--
ALTER TABLE `departs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invs`
--
ALTER TABLE `invs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_categories`
--
ALTER TABLE `inv_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_categories_inv_id_foreign` (`inv_id`),
  ADD KEY `inv_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `inv_logs`
--
ALTER TABLE `inv_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_logs_user_id_foreign` (`user_id`),
  ADD KEY `inv_logs_inv_id_foreign` (`inv_id`),
  ADD KEY `inv_logs_depart_id_foreign` (`depart_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_depart_id_foreign` (`depart_id`);

--
-- Indexes for table `user_departs`
--
ALTER TABLE `user_departs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_departs_user_id_foreign` (`user_id`),
  ADD KEY `user_departs_depart_id_foreign` (`depart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departs`
--
ALTER TABLE `departs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invs`
--
ALTER TABLE `invs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inv_categories`
--
ALTER TABLE `inv_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_logs`
--
ALTER TABLE `inv_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_departs`
--
ALTER TABLE `user_departs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inv_categories`
--
ALTER TABLE `inv_categories`
  ADD CONSTRAINT `inv_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `inv_categories_inv_id_foreign` FOREIGN KEY (`inv_id`) REFERENCES `invs` (`id`);

--
-- Constraints for table `inv_logs`
--
ALTER TABLE `inv_logs`
  ADD CONSTRAINT `inv_logs_depart_id_foreign` FOREIGN KEY (`depart_id`) REFERENCES `departs` (`id`),
  ADD CONSTRAINT `inv_logs_inv_id_foreign` FOREIGN KEY (`inv_id`) REFERENCES `invs` (`id`),
  ADD CONSTRAINT `inv_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_depart_id_foreign` FOREIGN KEY (`depart_id`) REFERENCES `departs` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_departs`
--
ALTER TABLE `user_departs`
  ADD CONSTRAINT `user_departs_depart_id_foreign` FOREIGN KEY (`depart_id`) REFERENCES `departs` (`id`),
  ADD CONSTRAINT `user_departs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
