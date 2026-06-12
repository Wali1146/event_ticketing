-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 08:45 AM
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
-- Database: `event_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` enum('konser','workshop') NOT NULL DEFAULT 'konser',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `category`, `date`, `time`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Iwan Fals - Tikus-Tikus Kantor', 'Ayo bernyanyi bersama di konser akbar kami bersama penyanyi legendaris kita dalam rangka naiknya mata uang rupiah tertinggi dalam sejarah indonesia', 'konser', '2026-07-06', '15:00:00', 'Stadion Pakansari - Bogor', '2026-06-07 11:49:49', '2026-06-07 11:49:49'),
(2, 'Laravel - Framework Untuk Website', 'Membuat projek web sederhana dengan MVC arsitektur dengan framework laravel', 'workshop', '2026-07-06', '12:00:00', 'Auditorium lt.3, gedung CCIT-FTUI - Depok', '2026-06-07 11:49:49', '2026-06-07 11:49:49'),
(3, 'Codeigniter4 - framework untuk website', 'Membuat projek web sederhana dengan MVC arsitektur dengan framework Codeigniter4', 'workshop', '2026-06-01', '10:00:00', 'Auditorium lt.3, gedung CCIT-FTUI - Depok', '2026-06-09 01:01:30', '2026-06-10 07:40:53'),
(4, 'Little Piece of Heaven - Avenged Sevenfold', 'Happy valentines day with live music on Jakarta International Stadium', 'konser', '2026-06-12', '21:00:00', 'Jakarta International Stadium', '2026-06-12 03:52:38', '2026-06-12 03:52:38');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_06_06_201459_create_events_table', 1),
(3, '2026_06_06_201516_create_tickets_table', 1),
(4, '2026_06_06_201531_create_transactions_table', 1),
(5, '2026_06_08_133445_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(26, 'App\\Models\\User', 1, 'auth_token', 'cbf691804efc36e18f6a7391ab7435add4c72f15d5ed0daa78777e9cc52b9e20', '[\"*\"]', '2026-06-12 06:31:37', NULL, '2026-06-12 04:40:31', '2026-06-12 06:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `quota` int(11) NOT NULL,
  `remaining_quota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event_id`, `price`, `quota`, `remaining_quota`, `created_at`, `updated_at`) VALUES
(1, 1, 50000, 100, 88, '2026-06-07 11:49:57', '2026-06-10 06:17:11'),
(2, 2, 10000, 100, 67, '2026-06-07 11:49:57', '2026-06-10 08:13:06'),
(3, 3, 15000, 50, 0, '2026-06-09 02:30:21', '2026-06-12 06:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `ticket_id`, `qty`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 50000, '2026-06-07 11:50:20', '2026-06-07 11:50:20'),
(3, 1, 1, 1, 50000, '2026-06-07 11:51:24', '2026-06-07 11:51:24'),
(4, 1, 2, 3, 30000, '2026-06-07 11:51:24', '2026-06-07 11:51:24'),
(6, 4, 3, 4, 60000, '2026-06-10 02:28:17', '2026-06-10 02:28:17'),
(7, 1, 2, 12, 120000, '2026-06-10 06:51:36', '2026-06-10 06:51:36'),
(8, 1, 3, 45, 675000, '2026-06-10 06:53:22', '2026-06-10 06:53:22'),
(9, 3, 2, 21, 210000, '2026-06-10 08:13:06', '2026-06-10 08:13:06'),
(10, 1, 3, 20, 300000, '2026-06-12 06:26:22', '2026-06-12 06:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '$2y$12$bQ7vB9sIqd04M6Nj0iHRQObWL5FYdSB3izZbBejlpVq0WXri3C1cW', 'user', '2026-06-07 11:49:34', '2026-06-09 03:15:55'),
(2, 'Test Admin', 'admin@example.com', '$2y$12$bQ7vB9sIqd04M6Nj0iHRQObWL5FYdSB3izZbBejlpVq0WXri3C1cW', 'admin', '2026-06-07 11:49:34', '2026-06-07 11:49:34'),
(3, 'Supa Nigga', 'supa@nigga.com', '$2y$12$5mbiluEcvmaTXvS4LXAkt.6xDcJseyxpNx2me/UFiRIDEm5TdWApy', 'user', '2026-06-09 09:08:12', '2026-06-10 07:39:52'),
(4, 'udin', 'udin@galon.com', '$2y$12$G5bYAznCeop/I5S3sJrzEejCXDITou12f4CepVjOnVfCJnjAOpMUm', 'admin', '2026-06-09 09:38:07', '2026-06-10 02:39:09'),
(6, 'User Test', 'user@test.com', '$2y$12$FTc7OmVkn0tZMRlmyNNIm.EAD7Xj/UYdjpfUcVnGXD0dseJXEvlAy', 'user', '2026-06-12 02:08:54', '2026-06-12 02:08:54'),
(8, 'Admin Test', 'admin@test.com', '$2y$12$DFnTxKq2lDxO6JZCHPnFpOCJIwb/d0cTx1c4t66EempSLLc3WHJiW', 'user', '2026-06-12 04:37:02', '2026-06-12 04:37:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_foreign` (`event_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_ticket_id_foreign` (`ticket_id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
