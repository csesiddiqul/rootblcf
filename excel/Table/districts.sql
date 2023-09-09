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
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `namebn` varchar(200) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `namebn`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Bagerhat', 'বাগেরহাট', 1, NULL, NULL),
(2, 2, 'Bandarban', 'বান্দরবন', 1, NULL, NULL),
(3, 1, 'Barguna', 'বরগুনা', 1, NULL, NULL),
(4, 1, 'Barisal', 'বরিশাল', 1, NULL, NULL),
(5, 2, 'Barnmanbaria', 'ব্রাহ্মনবাড়ীয়া', 1, NULL, NULL),
(6, 1, 'Bhola', 'ভোলা', 1, NULL, NULL),
(7, 5, 'Bogra', 'বগুড়া', 1, NULL, NULL),
(8, 2, 'Chandpur', 'চাঁদপুর', 1, NULL, NULL),
(9, 2, 'Chittagong', 'চট্টগ্রাম', 1, NULL, NULL),
(10, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 1, NULL, NULL),
(11, 2, 'Comilla', 'কুমিল্লা', 1, NULL, NULL),
(12, 2, 'Cox\'s Bazar', 'কক্সবাজার', 1, NULL, NULL),
(13, 3, 'Dhaka', 'ঢাকা', 1, NULL, NULL),
(14, 6, 'Dinajpur', 'দিনাজপুর', 1, NULL, NULL),
(15, 3, 'Faridpur', 'ফরিদপুর', 1, NULL, NULL),
(16, 2, 'Feni', 'ফেনি', 1, NULL, NULL),
(17, 6, 'Gaibandha', 'গাইবান্ধা', 1, NULL, NULL),
(18, 3, 'Gazipur', 'গাজীপুর', 1, NULL, NULL),
(19, 3, 'Gopalganj', 'গোঁপালগঞ্জ', 1, NULL, NULL),
(20, 7, 'Habiganj', 'হবিগঞ্জ', 1, NULL, NULL),
(21, 5, 'Jaipurhat', 'জয়পুরহাট', 1, NULL, NULL),
(22, 3, 'Jamalpur', 'জামালপুর', 1, NULL, NULL),
(23, 4, 'Jessore', 'যশোর', 1, NULL, NULL),
(24, 1, 'Jhalakathi', 'ঝালকাঠী', 1, NULL, NULL),
(25, 4, 'Jhinaidah', 'ঝিনাইদহ', 1, NULL, NULL),
(26, 2, 'Khagrachari', 'খাগড়াছড়ি', 1, NULL, NULL),
(27, 4, 'Khulna', 'খুলনা', 1, NULL, NULL),
(28, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 1, NULL, NULL),
(29, 6, 'Kurigram', 'কুড়িগ্রাম', 1, NULL, NULL),
(30, 4, 'Kushtia', 'কুষ্টিয়া', 1, NULL, NULL),
(31, 2, 'Lakshmipur', 'লক্ষীপুর', 1, NULL, NULL),
(32, 6, 'Lalmonirhat', 'লালমনিরহাট', 1, NULL, NULL),
(33, 3, 'Madaripur', 'মাদারিপুর', 1, NULL, NULL),
(34, 4, 'Magura', 'মাগুরা', 1, NULL, NULL),
(35, 3, 'Manikganj', 'মানিকগঞ্জ', 1, NULL, NULL),
(36, 4, 'Meherpur', 'মেহেরপুর', 1, NULL, NULL),
(37, 7, 'Moulavibazar', 'মৌলভীবাজার ', 1, NULL, NULL),
(38, 3, 'Munshiganj', 'মুন্সীগঞ্জ', 1, NULL, NULL),
(39, 3, 'Mymensingh', 'ময়মনসিংহ', 1, NULL, NULL),
(40, 5, 'Naogaon', 'নওগাঁ', 1, NULL, NULL),
(41, 3, 'Narayangan', 'নারায়ণগঞ্জ ', 1, NULL, NULL),
(42, 3, 'Narsingdi', 'নরসিংদী', 1, NULL, NULL),
(43, 5, 'Natore', 'নাটোর', 1, NULL, NULL),
(44, 5, 'Nawabgonj', 'নবাবগঞ্জ', 1, NULL, NULL),
(45, 3, 'Netrokona', 'নেত্রকোনা', 1, NULL, NULL),
(46, 6, 'Nilphamari', 'নীলফামারী ', 1, NULL, NULL),
(47, 2, 'Noakhali', 'নোয়াখালী', 1, NULL, NULL),
(48, 4, 'Norail', 'নড়াইল', 1, NULL, NULL),
(49, 5, 'Pabna', 'পাবনা', 1, NULL, NULL),
(50, 6, 'Panchagarh', 'পঞ্চগড় ', 1, NULL, NULL),
(51, 1, 'Patuakhali', 'পটুয়াখালী ', 1, NULL, NULL),
(52, 1, 'Pirojpur', 'পিরোজপুর', 1, NULL, NULL),
(53, 3, 'Rajbari', 'রাজবাড়ী', 1, NULL, NULL),
(54, 5, 'Rajshahi', 'রাজশাহী', 1, NULL, NULL),
(55, 2, 'Rangamati', 'রাঙ্গামাটি', 1, NULL, NULL),
(56, 6, 'Rangpur', 'রংপুর ', 1, NULL, NULL),
(57, 4, 'Satkhira', 'সাতক্ষীরা', 1, NULL, NULL),
(58, 3, 'Shariyatpur', 'শরিয়তপুর', 1, NULL, NULL),
(59, 3, 'Sherpur', 'শেরপুর', 1, NULL, NULL),
(60, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 1, NULL, NULL),
(61, 7, 'Sunamganj', 'সুনামগঞ্জ ', 1, NULL, NULL),
(62, 7, 'Sylhet', 'সিলেট', 1, NULL, NULL),
(63, 3, 'Tangail', 'টাংগাইল', 1, NULL, NULL),
(64, 6, 'Thakurgaon', 'ঠাকুরগাঁও ', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
