-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2025 at 04:31 AM
-- Server version: 10.11.13-MariaDB-cll-lve
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hsstxfzu_bukujiwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('booksoul_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:7:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:6:\"create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:18:\"create transaction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"create customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"create category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:4:\"edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:6:\"delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"seller\";s:1:\"c\";s:3:\"web\";}}}', 1752658710),
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:7:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:6:\"create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:18:\"create transaction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"create customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"create category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:4:\"edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:6:\"delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"seller\";s:1:\"c\";s:3:\"web\";}}}', 1751930397);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Memasak', '2025-05-18 17:04:59', '2025-06-30 03:38:10'),
(2, 'Menulis', '2025-05-25 23:29:56', '2025-05-25 23:29:56'),
(3, 'Olah Data', '2025-05-26 00:04:05', '2025-05-26 00:04:05'),
(4, 'Machine Learning', '2025-06-22 16:27:44', '2025-06-22 16:27:44'),
(5, 'Framework', '2025-06-23 00:58:08', '2025-06-23 00:58:08'),
(6, 'Perikanan', '2025-06-23 01:15:01', '2025-06-23 01:15:01'),
(9, 'Perhutanan', '2025-06-23 01:17:05', '2025-06-23 01:17:05'),
(10, 'Teknik', '2025-06-30 04:11:37', '2025-06-30 04:11:37'),
(12, 'Peternakan', '2025-07-01 02:47:58', '2025-07-01 02:47:58'),
(13, 'Tanaman Hias', '2025-07-01 02:49:57', '2025-07-01 02:49:57'),
(14, 'Industri', '2025-07-15 04:56:31', '2025-07-15 04:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_28_063434_create_categories_table', 1),
(5, '2025_04_28_063435_create_products_table', 1),
(6, '2025_04_28_063436_create_customers_table', 1),
(7, '2025_05_10_082651_transactions', 1),
(8, '2025_05_10_082652_transaction_item', 1),
(9, '2025_05_11_224004_create_permission_tables', 1),
(10, '2025_05_26_071036_add_writer', 2),
(11, '2025_05_26_071811_add_payment_change', 2),
(12, '2025_05_26_092123_add_stock', 3),
(13, '2025_05_27_225619_update_foreign_key_on_transactions_table', 4),
(14, '2025_05_27_232444_drop_customer_table', 5),
(15, '2025_04_28_063435_create_customers_table', 6),
(16, '2025_05_10_075438_seller', 6),
(17, '2025_06_18_074018_create_transaction_history_table', 6),
(18, '2025_06_18_074059_create_transaction_history_product_table', 6),
(19, '2025_06_19_101517_change_foreign_key_transactions', 7),
(20, '2025_06_19_101518_change_foreign_key_transaction_product', 8),
(21, '2025_06_22_081644_delete_product_id_fk', 9),
(22, '2025_06_22_112204_update_discount', 10),
(23, '2025_06_22_112205_update_discount', 11),
(24, '2025_06_23_005809_tambah_catatan', 12),
(25, '2025_06_23_005809_tambah_histori_catatan', 12),
(26, '2025_06_23_082813_histori_profit', 13),
(27, '2025_06_23_082813_profit_transaksi', 13),
(28, '2025_06_23_105802_create_profit_table', 14),
(29, '2025_06_24_040221_create_cart_items_table', 14),
(30, '2025_06_25_102220_create_cart_locked', 15),
(31, '2025_06_30_033953_make_final_price', 16),
(32, '2025_06_30_033954_make_final_price_h', 16),
(33, '2025_06_30_060450_create_notifications_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('30feff38-dea1-4066-b3ed-6797a4b4b59b', 'App\\Notifications\\TransactionCompleted', 'App\\Models\\User', 14, '{\"message\":\"Transaksi Anda telah berhasil diproses oleh pegawai.\"}', NULL, '2025-07-15 04:54:18', '2025-07-15 04:54:18'),
('a6445458-c232-4147-8343-162699e555e9', 'App\\Notifications\\TransactionCompleted', 'App\\Models\\User', 14, '{\"message\":\"Transaksi Anda telah berhasil diproses oleh pegawai.\"}', NULL, '2025-06-29 23:05:53', '2025-06-29 23:05:53');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(2, 'create transaction', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(3, 'create customer', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(4, 'create category', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(5, 'edit', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(6, 'delete', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58'),
(7, 'manage users', 'web', '2025-05-18 17:04:58', '2025-05-18 17:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `writer` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `minimum_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `category_name`, `created_at`, `updated_at`, `writer`, `quantity`, `minimum_quantity`) VALUES
(4, 'Memasak Ayam Pedas Manis', 20000.00, 1, 'Memasak', '2025-05-19 03:36:03', '2025-06-29 23:56:47', 'Ayam', 5, 5),
(5, 'Mengolah Data Dari Kaggle', 250000.00, 3, 'Olah Data', '2025-05-25 23:30:30', '2025-07-15 04:53:24', 'Munir', 33, 5),
(7, 'Implementasi Pustaka Olah Data Python', 180000.00, 3, 'Olah Data', '2025-05-27 20:25:29', '2025-06-30 03:55:28', 'Aziz', 9, 5),
(8, 'Metode ML Linier dan Non-linier', 200000.00, 4, 'Machine Learning', '2025-06-22 16:33:08', '2025-07-15 04:54:18', 'Saya', 17, 5),
(9, 'Menampilkan Notifikasi di Laravel', 50000.00, 5, 'Framework', '2025-06-23 00:59:42', '2025-06-23 00:59:42', 'Novi', 5, 5),
(10, 'Hutan dan Oksigen', 165000.00, 9, 'Perhutanan', '2025-06-30 03:09:27', '2025-07-15 04:54:18', 'Pohon', 27, 5),
(11, 'Oprek HP', 150000.00, 3, 'Olah Data', '2025-06-30 04:08:34', '2025-06-30 04:10:01', 'HP', 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `total_profit` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-05-18 17:04:57', '2025-05-18 17:04:57'),
(2, 'seller', 'web', '2025-05-18 17:04:57', '2025-05-18 17:04:57'),
(3, 'buyer', 'web', '2025-05-18 17:04:57', '2025-05-18 17:04:57'),
(4, 'regular', 'web', '2025-06-22 00:31:34', '2025-06-22 00:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4jrTj6O43AmHK1rFPGfjasDlFjL8YNuPfkpSb49r', NULL, '23.111.114.116', 'Mozilla/5.0 (Android 10; Mobile; rv:86.0) Gecko/86.0 Firefox/86.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDhWazRrTGJ5cGJpdGVaaXBHNzdrcVFZMWphSnplalloV3Y1TEU1ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753037375),
('61G2CieqT13dZVciOlzfT406o4XGOME4g63jQS4W', NULL, '195.201.199.99', 'Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFJFRTE4V0g5dU5jQUhlbXBhRTB6TjRmYndWZEw5cmFmbHJvNlhObyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753040837),
('CDrhsnaeckHOCxIPTBeuzhHgzD45U0fE0LARHNkk', NULL, '194.190.210.43', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) EdgiOS/116.0.1938.56 Version/17.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjExQ3Y0RnBSSVJuMm1xbmhwVjFnZjB0UkFyNTluZWE4QTlnYmpPVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753040335),
('cX6sScEtgEMYmo3a2lNVKYNFbGmmNxcwTxQPZGCt', NULL, '43.133.187.11', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG00SHBVdVlFUDhrNkhKdnAzYkVwb1E2UHN0Zmx6UXI2a1o5M1A4UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753034621),
('egmXjHRqmfot3Of6fzXDEj1mW9VetCg0rC2g3uhO', NULL, '103.225.130.164', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/116.0.5845.177 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZElJT1JmYnY5T3l0amZPOFgydWRGWXdPYmxUb042VllJbUtqczdvSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753049888),
('gagzhybOdezcb42BgJ9paz20wny19fs218nPhL2e', NULL, '110.40.186.63', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU292YTQ5NTdwVnhuMk9MNk5jMFFudWNFd0ZCeXZBWkVpQTVPcVBpNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753038290),
('j3V2L9DapHeTslElXgawyqlapgYHwUzlE7jahrHE', NULL, '120.71.59.24', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0VxRHRWNkc5WGxTQ3oxSThDelRzV2c1RjUyWVZSWW1QdzRyd2JtZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753027417),
('l7ksMNLt4aIgbyUaOPjh7MtToBcJvAqm1vu3sAPo', NULL, '182.44.9.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEp3WVJ0YWFWY0V4MnFhMVMwNmxvekVKTVpQcVdYUk1ISmljNWhoNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753049132),
('NcUcdr7Fmcl972HGgL0kH6GnrKX7HG6FWpNTy9D1', NULL, '102.129.152.206', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/89.0.4389.90 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGhEUGtPdHR6RDRqNlZ1MG1sN2xYbldPMVBQODl4ZUZvYUNFRGRQciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753040197),
('Q08eyfkfIYzeAPFH8dZmt89fVxYdJjYcAeoyjyqe', NULL, '43.166.136.202', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEtucWMxMmd3eDVvalBuOXZwSUpYVTAzWFdZeEZiMTM0bXRrc0NoVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753038996),
('TFP3eBylgZZznTD6A8gmcl4H2gtAtxEYBUeWt1LB', NULL, '172.111.15.241', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0xwZ2MwWDRGeUk3QXZDYTdPYXJtaFN5cHZDRWhlNUtFQU9MWmJMWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753049423),
('x2lyN43Cugtbs8F9a6lyjpvgUwkqkoZxuBRUzPMC', NULL, '172.82.65.38', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlhFUzRVTlZmNkxUODlzeXNuY2xxVFRJTTZ4VlhDNUtvQ1BuenoyVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753033818),
('X4Bq2FxF6IqASInAAQbMkdCFnJJkRLQLI8andABu', NULL, '43.157.148.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNElBZDVPRE1Sa1RCbGdEcHMxckZZTGw3QVA3bFlkR2d4UFBIbEhMUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9idWt1aml3YS5zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753041760),
('xka6mw89T3gzSFLP7K7lxG3eFul1YoVb7w73sQSs', NULL, '49.51.253.26', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2ZwSWhVU2JHMUk0V2hCOVRhTjVCZnAxS0MxVjRBSmhUS0lqQU5tMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuYnVrdWppd2Euc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753045544);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `seller_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment` decimal(10,2) NOT NULL,
  `change` decimal(10,2) NOT NULL DEFAULT 0.00,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `profit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `final_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `seller_name`, `seller_email`, `customer_name`, `customer_email`, `transaction_date`, `total_price`, `created_at`, `updated_at`, `payment`, `change`, `seller_id`, `customer_id`, `discount`, `is_returned`, `profit`, `final_price`) VALUES
(24, 'Aur', 'admin@example.com', 'Siapa', 'regular@regular.com', '2025-07-15', 237500.00, '2025-07-15 04:43:19', '2025-07-15 04:43:19', 250000.00, 12500.00, 1, 14, 12500.00, 0, 12500.00, 237500.00),
(25, 'Aur', 'admin@example.com', 'Siapa', 'regular@regular.com', '2025-07-15', 250000.00, '2025-07-15 04:53:21', '2025-07-15 04:53:21', 0.00, 0.00, 1, 14, 0.00, 1, 0.00, 0.00),
(26, 'Aur', 'admin@example.com', 'Siapa', 'regular@regular.com', '2025-07-15', 895000.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18', 1000000.00, 149750.00, 1, 14, 44750.00, 0, 44750.00, 850250.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `seller_email` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `change` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `profit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `final_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `transaction_id`, `seller_id`, `seller_name`, `seller_email`, `customer_id`, `customer_name`, `customer_email`, `transaction_date`, `discount`, `total_price`, `payment`, `change`, `created_at`, `updated_at`, `is_returned`, `profit`, `final_price`) VALUES
(18, 24, 1, 'Aur', 'admin@example.com', 14, 'Siapa', 'regular@regular.com', '2025-07-15', 12500.00, 237500.00, 250000.00, 12500.00, '2025-07-15 04:43:19', '2025-07-15 04:43:19', 0, 12500.00, 237500.00),
(19, 25, 1, 'Aur', 'admin@example.com', 14, 'Siapa', 'regular@regular.com', '2025-07-15', 0.00, 250000.00, 0.00, 0.00, '2025-07-15 04:53:25', '2025-07-15 04:53:25', 1, 0.00, 0.00),
(20, 26, 1, 'Aur', 'admin@example.com', 14, 'Siapa', 'regular@regular.com', '2025-07-15', 44750.00, 895000.00, 1000000.00, 149750.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18', 0, 44750.00, 850250.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history_product`
--

CREATE TABLE `transaction_history_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_history_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_history_product`
--

INSERT INTO `transaction_history_product` (`id`, `transaction_history_id`, `product_id`, `product_name`, `product_price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(19, 18, 5, 'Mengolah Data Dari Kaggle', 250000.00, 1, 250000.00, '2025-07-15 04:43:19', '2025-07-15 04:43:19'),
(20, 19, 5, 'Mengolah Data Dari Kaggle', 250000.00, 1, 250000.00, '2025-07-15 04:53:25', '2025-07-15 04:53:25'),
(21, 20, 8, 'Metode ML Linier dan Non-linier', 200000.00, 2, 400000.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18'),
(22, 20, 10, 'Hutan dan Oksigen', 165000.00, 3, 495000.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_product`
--

CREATE TABLE `transaction_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_product`
--

INSERT INTO `transaction_product` (`id`, `transaction_id`, `product_name`, `product_price`, `quantity`, `subtotal`, `created_at`, `updated_at`, `product_id`) VALUES
(31, 24, 'Mengolah Data Dari Kaggle', 250000.00, 1, 250000.00, '2025-07-15 04:43:19', '2025-07-15 04:43:19', 5),
(32, 25, 'Mengolah Data Dari Kaggle', 250000.00, 1, 250000.00, '2025-07-15 04:53:22', '2025-07-15 04:53:22', 5),
(33, 26, 'Metode ML Linier dan Non-linier', 200000.00, 2, 400000.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18', 8),
(34, 26, 'Hutan dan Oksigen', 165000.00, 3, 495000.00, '2025-07-15 04:54:18', '2025-07-15 04:54:18', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cart_locked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `adress`, `remember_token`, `created_at`, `updated_at`, `cart_locked`) VALUES
(1, 'Aur Hakim', NULL, 'aur@hakim.com', NULL, '$2y$12$8z9FzO36pHoH/zi13XZK7.OlB8nlWSjcqpOk6RlWYLyQ6Q0j4U3Ea', NULL, NULL, '2025-05-18 17:04:58', '2025-07-15 04:59:20', 0),
(11, 'Hoddy', NULL, 'x@x.com', NULL, '$2y$12$PM5aEVZ4KCW.KVomT1F3yut9.UBqSald/i3iYLcZRdjIPhH5O4WSO', NULL, NULL, '2025-05-18 23:32:53', '2025-05-18 23:32:53', 0),
(12, 'Bagus', NULL, 'z@z.com', NULL, '$2y$12$alhbeWTCAJ35Pe5PbsF.w.a.nA5u67201zGIJhmhsEaq/aRYn9YRi', NULL, NULL, '2025-05-25 23:31:36', '2025-05-27 21:17:04', 0),
(13, 'Firman', NULL, 'f@f.com', NULL, '$2y$12$gttNj2E.CrNOGnuv6uLu9OrhYp9CuQd8lW/jd5CosEVm6kXQubjEK', NULL, NULL, '2025-05-27 20:30:07', '2025-05-27 20:30:07', 0),
(14, 'Siapa', NULL, 'regular@regular.com', NULL, '$2y$12$019HWViMn8WWnUI7iOus8OAD5CK3PZTPEJczA7J9cG8ZvLGil6b9q', NULL, NULL, '2025-06-22 00:37:56', '2025-07-15 04:54:18', 0),
(15, 'Mamat', '030303', 'mamat@email.com', NULL, '$2y$12$o18WsoPd5oN1quYstb.42eG8gWmtcXnQWTPRa8FcB2lfERsepiUnK', 'dimana?', NULL, '2025-06-30 03:24:53', '2025-06-30 03:29:43', 0),
(16, 'si bos', '121331', 'bos@email.com', NULL, '$2y$12$Rhm08q2Zx1kkrml5fcr11.3fnhRg8/p8DYt4rQlwnOYQbh2i7KdTe', 'disana', NULL, '2025-06-30 03:31:05', '2025-06-30 03:33:53', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seller_phone_unique` (`phone`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history_product`
--
ALTER TABLE `transaction_history_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_history_product_transaction_history_id_foreign` (`transaction_history_id`);

--
-- Indexes for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_product_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_history_product`
--
ALTER TABLE `transaction_history_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaction_product`
--
ALTER TABLE `transaction_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_history_product`
--
ALTER TABLE `transaction_history_product`
  ADD CONSTRAINT `transaction_history_product_transaction_history_id_foreign` FOREIGN KEY (`transaction_history_id`) REFERENCES `transaction_history` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD CONSTRAINT `transaction_product_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
