-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 02:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipsitainventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namebn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `namebn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Barisal Division', 'বরিশাল', 1, '2019-10-26 03:41:47', '2019-10-26 03:41:47'),
(2, 'Chittagong Division', 'চট্টগ্রাম', 1, '2019-10-26 03:45:28', '2019-10-26 03:45:28'),
(3, 'Dhaka Division', 'ঢাকা', 1, '2019-10-26 03:45:47', '2019-10-26 03:45:47'),
(4, 'Khulna Division', 'খুলনা', 1, '2019-10-26 03:46:17', '2019-10-26 03:46:17'),
(5, 'Rajshahi Division', 'রাজশাহী', 1, '2019-10-26 03:46:33', '2019-10-26 03:46:33'),
(6, 'Rangpur Division', 'রংপুর', 1, '2019-10-26 03:46:46', '2019-10-26 03:46:46'),
(7, 'Sylhet Division', 'সিলেট', 1, '2019-10-26 03:46:58', '2019-10-26 03:46:58'),
(8, 'Mymensingh Division', 'ময়মনসিংহ', 1, '2019-10-26 03:47:11', '2019-10-26 03:47:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
