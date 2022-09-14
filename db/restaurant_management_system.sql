-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2022 at 07:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailyproductexpenses`
--

CREATE TABLE `dailyproductexpenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dailyproductexpenses`
--

INSERT INTO `dailyproductexpenses` (`id`, `expense_date`, `product_name`, `product_id`, `quantity`, `unit_title`, `created_at`, `updated_at`) VALUES
(1, '2022-09-13', 'Oil', NULL, '1', 'liter', '2022-09-12 04:17:52', '2022-09-12 04:17:52'),
(2, '2022-09-06', 'Alu', NULL, '1', 'kg', '2022-09-12 04:20:02', '2022-09-12 04:20:02'),
(3, '2022-09-12', 'Oil', NULL, '500', 'ml', '2022-09-12 04:49:02', '2022-09-12 04:49:02'),
(4, '2022-09-12', 'Oil', NULL, '500', 'ml', '2022-09-12 04:49:21', '2022-09-12 04:49:21'),
(5, '2022-09-12', 'Oil', NULL, '500', 'ml', '2022-09-12 04:49:56', '2022-09-12 04:49:56'),
(6, '2022-09-12', 'Oil', NULL, '500', 'ml', '2022-09-12 04:50:00', '2022-09-12 04:50:00'),
(7, '2022-09-12', 'Oil', NULL, '500', 'ml', '2022-09-12 04:50:30', '2022-09-12 04:50:30'),
(8, '2022-09-13', 'Oil', NULL, '1', 'liter', '2022-09-12 04:51:28', '2022-09-12 04:51:28'),
(9, '2022-09-13', 'Egg', NULL, '2', 'piece', '2022-09-12 05:02:38', '2022-09-12 05:02:38'),
(10, '2022-09-13', 'Oil', NULL, '1.5', 'liter', '2022-09-12 05:11:14', '2022-09-12 05:11:14'),
(11, '2022-09-13', 'Oil', NULL, '3', 'liter', '2022-09-12 05:17:50', '2022-09-12 05:17:50'),
(12, '2022-09-06', 'Oil', NULL, '1.5', 'liter', '2022-09-12 05:21:41', '2022-09-12 05:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `expensedetails`
--

CREATE TABLE `expensedetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensedetails`
--

INSERT INTO `expensedetails` (`id`, `quantity`, `unit_title`, `expense_id`, `product_id`, `unit_price`, `unit`, `total_quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, '5', 'liter', '000002', '1', '940', '1', '5', '940', '2022-09-12 02:48:26', '2022-09-12 02:48:26'),
(2, '10', 'kg', '000002', '2', '20', '10', '10', '200', '2022-09-12 02:48:26', '2022-09-12 02:48:26'),
(3, '12', 'piece', '000002', '3', '10', '10', '120', '100', '2022-09-12 02:48:26', '2022-09-12 02:48:26'),
(4, '500', 'ml', '000002', '4', '100', '1', '0.5', '100', '2022-09-12 02:48:26', '2022-09-12 02:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advanced_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percentage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`id`, `item_name`, `price`, `discount_percentage`, `discount_price`, `created_at`, `updated_at`) VALUES
(2, 'Gril', '75', NULL, NULL, '2022-09-12 23:41:51', '2022-09-12 23:41:51'),
(3, 'Hardee\'s Original Thickburger', '250', NULL, NULL, '2022-09-12 23:42:38', '2022-09-12 23:42:38'),
(4, 'KFC Extra Crispy Chicken', '120', NULL, NULL, '2022-09-12 23:42:59', '2022-09-12 23:42:59'),
(5, 'Burger King Chicken Fries', '99', NULL, NULL, '2022-09-12 23:43:22', '2022-09-12 23:43:22'),
(6, 'Dunkin\' Munchkins', '145', NULL, NULL, '2022-09-12 23:43:37', '2022-09-12 23:43:37');

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
(46, '2014_10_12_000000_create_users_table', 1),
(47, '2014_10_12_100000_create_password_resets_table', 1),
(48, '2019_08_19_000000_create_failed_jobs_table', 1),
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2022_08_31_120200_create_suppliers_table', 1),
(51, '2022_09_01_090240_create_expenses_table', 1),
(52, '2022_09_01_092053_create_stockproductlists_table', 1),
(53, '2022_09_03_100409_create_expensedetails_table', 1),
(54, '2022_09_06_055917_create_supplierdues_table', 2),
(55, '2022_09_06_115709_create_dailyproductexpenses_table', 3),
(56, '2022_09_07_084910_create_productlimits_table', 4),
(57, '2022_09_12_115539_create_menuitems_table', 5),
(58, '2022_09_13_045505_create_orders_table', 6),
(59, '2022_09_13_045605_create_orderdetails_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `invoice_id`, `item_id`, `item_quantity`, `unit_price`, `price`, `created_at`, `updated_at`) VALUES
(1, '000001', '4', '2', '120', '240', '2022-09-13 05:28:23', '2022-09-13 05:28:23'),
(2, '000001', '5', '1', '99', '99', '2022-09-13 05:28:23', '2022-09-13 05:28:23'),
(16, '000002', '3', '10', '250', '2500', '2022-09-13 05:33:32', '2022-09-13 05:33:32'),
(17, '000002', '4', '10', '120', '1200', '2022-09-13 05:33:32', '2022-09-13 05:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `invoice_number`, `table_number`, `total_amount`, `paid_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, '2022-09-13', '000001', '1', '339', '100', '239', '2022-09-13 05:28:23', '2022-09-13 05:28:23'),
(2, '2022-09-13', '000002', '1', '3700', '3700', '0', '2022-09-13 05:33:32', '2022-09-13 05:33:32');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productlimits`
--

CREATE TABLE `productlimits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productlimits`
--

INSERT INTO `productlimits` (`id`, `product_id`, `limit`, `created_at`, `updated_at`) VALUES
(3, '11', '10', '2022-09-07 03:57:34', '2022-09-07 03:57:34'),
(4, '5', '10', '2022-09-07 03:57:42', '2022-09-07 03:57:42'),
(5, '8', '10', '2022-09-10 02:38:30', '2022-09-10 02:38:30'),
(6, '10', '10', '2022-09-10 03:44:15', '2022-09-10 03:44:15'),
(7, '3', '10', '2022-09-11 03:44:19', '2022-09-11 03:44:19'),
(8, '6', '10', '2022-09-11 03:44:30', '2022-09-11 03:44:30'),
(9, '1', '2', '2022-09-11 03:44:40', '2022-09-11 03:44:40'),
(10, '4', '10', '2022-09-11 03:45:07', '2022-09-11 03:45:07'),
(11, '2', '5', '2022-09-11 23:23:21', '2022-09-11 23:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `stockproductlists`
--

CREATE TABLE `stockproductlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockproductlists`
--

INSERT INTO `stockproductlists` (`id`, `product_name`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Oil', '3.5', '2022-09-12 02:48:26', '2022-09-12 05:21:41'),
(2, 'Alu', '9', '2022-09-12 02:48:26', '2022-09-12 04:20:02'),
(3, 'Egg', '118', '2022-09-12 02:48:26', '2022-09-12 05:02:38'),
(4, 'Souce', '0.5', '2022-09-12 02:48:26', '2022-09-12 02:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `contact_person_name`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'CV Enterprize', 'Md Rana Hamid', '01712124578', '2022-09-05 02:50:12', '2022-09-05 02:50:12'),
(2, 'CV Enterprizes', 'Md Rana Hamids', '01712124578', '2022-09-05 02:50:31', '2022-09-05 02:50:31'),
(3, 'CV Enterprize2', 'Md Rana Hamid1', '01712124574', '2022-09-11 06:22:17', '2022-09-11 06:22:17'),
(4, 'AMARESKUL', 'Md Rana Hamid2', '01712124525', '2022-09-11 06:22:40', '2022-09-11 06:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$3.pQ5dpETqC68uyDx96STe2ncgME.vUXKvZoDZTGCUujNjoc6iENe', NULL, '2022-09-05 02:49:44', '2022-09-05 02:49:44'),
(2, 'coderfaruk', 'seller', 'seller@gmail.com', NULL, '$2y$10$uPWqNzVMiTYOuqOxFzhcme8rIy8z1yOdT9ResTE08AoN1nzpzboei', NULL, '2022-09-11 06:20:52', '2022-09-11 06:20:52'),
(3, 'Buyers', 'buyer', 'buyer@gmail.com', NULL, '$2y$10$mU4brNYAF2D0cEEla41uOu7svwf81I5llWAzk9EfKZNDBsVvWNxZm', NULL, '2022-09-11 06:21:08', '2022-09-11 06:21:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dailyproductexpenses`
--
ALTER TABLE `dailyproductexpenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensedetails`
--
ALTER TABLE `expensedetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menuitems_item_name_unique` (`item_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productlimits`
--
ALTER TABLE `productlimits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockproductlists`
--
ALTER TABLE `stockproductlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stockproductlists_product_name_unique` (`product_name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_company_name_unique` (`company_name`);

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
-- AUTO_INCREMENT for table `dailyproductexpenses`
--
ALTER TABLE `dailyproductexpenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expensedetails`
--
ALTER TABLE `expensedetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productlimits`
--
ALTER TABLE `productlimits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stockproductlists`
--
ALTER TABLE `stockproductlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
