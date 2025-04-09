-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 03:25 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `about`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Php', 'php', 'Php programing', 'category/1.webp', NULL, '2025-03-14 14:10:33', '2025-03-15 13:15:56'),
(2, 'Vue3', 'vue', 'Vue 3 programing', NULL, NULL, '2025-03-14 14:11:29', '2025-03-14 14:11:29'),
(3, 'Laravel', 'php-laravel', 'Laravel framework programinig.', 'category/3.webp', 1, '2025-03-14 14:14:20', '2025-03-15 13:16:14'),
(4, 'Symfony', 'php-symfony', 'Symfony framework programing.', 'category/4.webp', 1, '2025-03-14 14:36:58', '2025-03-15 13:16:30'),
(5, 'C++', 'cpp', 'C++ programing tutorials.', NULL, 11, '2025-03-14 20:22:15', '2025-03-15 12:49:50'),
(8, 'Html', 'web-html', 'Html programing.', NULL, NULL, '2025-03-15 08:51:36', '2025-03-15 08:51:36'),
(9, 'CSS', 'web-css', 'Css programing.', NULL, NULL, '2025-03-15 08:52:47', '2025-03-15 08:52:47'),
(11, 'Math', 'math', 'Math for dummies', 'category/11.webp', NULL, '2025-03-15 09:29:26', '2025-03-15 12:44:50'),
(12, 'Games', 'games', 'Computer games.', 'category/12.webp', NULL, '2025-03-15 10:44:08', '2025-03-15 10:44:48'),
(13, '3D Games', '3d-games', '3D games subcategory.', 'category/13.webp', 12, '2025-03-15 13:05:47', '2025-03-15 13:06:56');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
