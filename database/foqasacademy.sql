-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 11:18 AM
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
-- Database: `foqasacademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_sectors`
--

CREATE TABLE `account_sectors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_sectors`
--

INSERT INTO `account_sectors` (`id`, `name`, `type`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Admission/ Re-Admission Fee', 'income', 1, 12, '2021-02-10 06:09:26', '2021-02-10 06:09:26'),
(2, 'Tuition Fee', 'income', 1, 12, '2021-02-10 06:12:13', '2021-02-10 06:12:13'),
(3, 'Board  Reg. Fee', 'income', 1, 12, '2021-02-10 06:12:47', '2021-02-10 06:12:47'),
(4, 'Late Fee', 'income', 1, 12, '2021-02-10 06:13:17', '2021-02-10 06:13:17'),
(5, 'College Exam Fee', 'income', 1, 12, '2021-02-10 06:13:36', '2021-02-10 06:13:36'),
(6, 'Library Fee', 'income', 1, 12, '2021-02-10 06:15:09', '2021-02-10 06:15:09'),
(7, 'Teacher-Staff Welfare Fund', 'income', 1, 12, '2021-02-10 06:15:53', '2021-02-10 06:15:53'),
(8, 'Milad', 'income', 1, 12, '2021-02-10 06:42:47', '2021-02-10 06:42:47'),
(9, 'College Annual Fee', 'income', 1, 12, '2021-02-10 06:43:44', '2021-02-10 06:43:44'),
(10, 'Testimonial Fee', 'income', 1, 12, '2021-02-10 06:50:23', '2021-02-10 06:50:23'),
(11, 'Maintenance Fee', 'income', 1, 12, '2021-02-10 06:55:16', '2021-02-10 06:55:16'),
(12, 'Form Fill Up', 'income', 1, 12, '2021-02-10 06:55:45', '2021-02-10 06:55:45'),
(13, 'ID Card Fee', 'income', 1, 12, '2021-02-10 06:56:09', '2021-02-10 06:56:09'),
(14, 'Admission Expense', 'expense', 1, 12, '2021-02-10 07:16:29', '2021-02-10 07:16:29'),
(15, 'Electric Bill & Others exp.', 'expense', 1, 12, '2021-02-10 07:29:39', '2021-02-10 07:29:39'),
(16, 'WASA Bill & Others exp.', 'expense', 1, 12, '2021-02-10 07:30:02', '2021-02-10 07:30:02'),
(17, 'Telephone Bill exp.', 'expense', 1, 12, '2021-02-10 07:30:48', '2021-02-10 07:30:48'),
(18, 'Paper Bill exp.', 'expense', 1, 12, '2021-02-10 07:46:34', '2021-02-10 07:46:34'),
(19, 'Computer Maintenance exp.', 'expense', 1, 12, '2021-02-10 07:48:52', '2021-02-10 07:48:52'),
(20, 'Printing & Stationary exp.', 'expense', 1, 12, '2021-02-10 07:50:47', '2021-02-10 07:50:47'),
(21, 'Gas Bill & Others exp.', 'expense', 1, 12, '2021-02-10 07:58:55', '2021-02-10 07:58:55'),
(22, 'Internet Bill Expense', 'expense', 1, 12, '2021-02-17 09:29:15', '2021-02-17 09:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `preadmission_id` int(11) DEFAULT NULL,
  `roll` int(11) DEFAULT NULL,
  `mark` float DEFAULT NULL,
  `add_pass` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `religon` tinyint(4) NOT NULL,
  `dob` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloodgroup` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathercell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fatheremail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothercell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motheremail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fatheroccupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motheroccupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactpersonmobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentAddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perpostoffice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perpostcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastAddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastpostoffice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastpostcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthcertificateNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fatherPassport` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nameAddressofmainSchool` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admissioninbengaliClass` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gName` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gNationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gMobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gdate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gnrcNo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gPhone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gAddress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gOccupation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeBirth` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singaporepr` tinyint(4) DEFAULT NULL,
  `cemail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preDivision` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preDistrict` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preThana` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastDivision` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastDistrict` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastThana` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persent_same` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bengaliLang` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=pending,2=approve,3=reject,4=paid,5=unpaid,6=promoted,7=not_promoted',
  `remark` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streetAddress_1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streetAddress_2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipCode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `school_id`, `section_id`, `class_id`, `preadmission_id`, `roll`, `mark`, `add_pass`, `name`, `gender`, `religon`, `dob`, `bloodgroup`, `mobile`, `email`, `photo`, `father_name`, `signature`, `fathercell`, `fatheremail`, `mother_name`, `mothercell`, `motheremail`, `fatheroccupation`, `motheroccupation`, `height`, `weight`, `contactperson`, `contactpersonmobile`, `realation`, `presentAddress`, `perpostoffice`, `perpostcode`, `pastAddress`, `pastpostoffice`, `pastpostcode`, `birthcertificateNo`, `fatherPassport`, `nameAddressofmainSchool`, `admissioninbengaliClass`, `gName`, `gNationality`, `gMobile`, `gEmail`, `gdate`, `gnrcNo`, `gPhone`, `gAddress`, `gOccupation`, `placeBirth`, `singaporepr`, `cemail`, `preDivision`, `preDistrict`, `preThana`, `pastDivision`, `pastDistrict`, `pastThana`, `nationality`, `persent_same`, `bengaliLang`, `password`, `status`, `remark`, `streetAddress_1`, `streetAddress_2`, `city`, `state`, `zipCode`, `country`, `created_at`, `updated_at`) VALUES
(10, 1, 25, 10, 5, 2020101, 20, '123456', 'sysok@mailinator.com', 1, 1, '0000-00-00', '1', 'Animi optio rem co', 'dili@mailinator.com', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/profile/XLsWFvVvw7BKDQy0CcMb68EwYKtO8yy2vp8asbeI.png', 'Maggy Lowe', NULL, NULL, NULL, 'Lisandra Santiago', NULL, NULL, NULL, NULL, NULL, NULL, 'Omnis sit nesciunt', 'In consequatur dolo', 'Non dolorem debitis', 'Ipsa cum reprehende', 'Aliquid eum neque do', '82', 'Ipsa cum reprehende', 'Aliquid eum neque do', '82', 'Vitae modi velit ut', NULL, 'Tanisha Craig', 'In ut et dolor dolor', 'Russell Hughes', 'Ut illo rerum expedi', 'Fugiat quis distinct', 'virawy@mailinator.com', '0000-00-00', 'Ut dolore molestiae', '+1 (554) 261-6972', 'Ipsa quidem fuga I', 'Alias vitae labore s', 'Amet et in voluptat', 1, 'nabyrywo@mailinator.com', 'Ipsam ducimus esse', 'Accusamus modi magna', 'Ut aut autem obcaeca', 'Ipsam ducimus esse', 'Accusamus modi magna', 'Ut aut autem obcaeca', 'Distinctio Eos ame', '1', NULL, '123', 6, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-11-24 12:10:47', '2021-03-31 07:53:05'),
(11, 1, 25, 10, 5, 2020102, NULL, '123', 'zozonipico@mailinator.com', 2, 1, '0000-00-00', '2', 'Sed et tempore do e', 'mupam@mailinator.com', NULL, 'Cain Workman', NULL, NULL, NULL, 'Lamar Ballard', NULL, NULL, NULL, NULL, NULL, NULL, 'Amet in temporibus', 'Aut itaque id blandi', 'Numquam laboriosam', 'Dhanmondi', 'Sit id mollit digni', '61', 'Dhanmondi', 'Sit id mollit digni', '61', 'Voluptas in est dolo', NULL, 'Micah Bradford', 'Dolor dolor laborum', 'Henry Adams', 'Ut reiciendis tempor', 'Beatae iure sit cum', 'zafakurane@mailinator.com', '0000-00-00', 'Dolores a labore sed', '+1 (471) 451-9725', 'Aut consequatur nul', 'Et tempore sit erro', 'Occaecat pariatur N', 2, 'zakuvywus@mailinator.com', 'Nesciunt in assumen', 'Debitis sint consequ', 'Vel blanditiis elige', 'Nesciunt in assumen', 'Debitis sint consequ', 'Vel blanditiis elige', 'Ut ipsum nihil reic', '1', NULL, '123456', 3, 'Reject', NULL, NULL, NULL, NULL, NULL, '18', '2020-11-24 12:12:59', '2020-12-10 07:23:53'),
(12, 1, 25, 10, 5, 2020103, NULL, '12345', 'joxuwafef@mailinator.com', 2, 1, '0000-00-00', '1', 'Ea soluta aliqua Nu', 'bugu@mailinator.com', NULL, 'Lester Solomon', NULL, NULL, NULL, 'Dominique Villarreal', NULL, NULL, NULL, NULL, NULL, NULL, 'Accusamus est sed si', 'Eveniet perspiciati', 'Sit at omnis qui do', 'In rerum explicabo', 'Rem esse in minim i', '85', 'In rerum explicabo', 'Rem esse in minim i', '85', 'Pariatur Sit cillu', NULL, 'Quamar Weaver', 'Nostrud mollitia par', 'Zane Maynard', 'Fugiat quia sequi u', 'Est itaque ut expedi', 'kiwexumari@mailinator.com', '0000-00-00', 'Nostrum fugit ut et', '+1 (806) 372-2227', 'Maxime perspiciatis', 'Dolore commodi cum v', 'Est sed ea dolore qu', 1, 'lobyveb@mailinator.com', '1', '4', '122', '5', '44', '422', 'Ab sunt ipsam ipsum', '1', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-11-25 07:03:13', '2020-12-10 07:29:06'),
(14, 1, 25, 10, 5, 2020104, NULL, '12345678', 'xunyfiquv@mailinator.com', 1, 4, '2020-09-11', '3', 'Cum repudiandae exce', 'vomoc@mailinator.com', NULL, 'Drake Newton', NULL, NULL, NULL, 'Stephen Mckay', NULL, NULL, NULL, NULL, NULL, NULL, 'Aut aut aut in ut ex', 'Dolor nostrud natus', 'Ut duis rem ad exerc', 'Anim molestiae disti', 'Temporibus ad sequi', '54', 'Anim molestiae disti', 'Temporibus ad sequi', '54', 'Ad molestias incidun', NULL, 'Yeo Garza', 'Quibusdam sint enim', 'Germane Carter', 'Qui quis proident e', 'Voluptatem laboriosa', 'mitugef@mailinator.com', '0000-00-00', 'Voluptatem dolor rep', '+1 (628) 632-1397', 'Commodi beatae est d', 'Proident quis minim', 'Sit ipsum explicab', 2, 'jewocymy@mailinator.com', '1', '24', '139', '1', '24', '139', 'Consequatur velit vi', '1', 'Nill', NULL, 3, 'sdfsadff', NULL, NULL, NULL, NULL, NULL, '18', '2020-11-28 10:58:29', '2020-12-10 07:29:19'),
(16, 1, 25, 10, 5, 2020105, NULL, '123456789', 'Ingrid Lewis', 3, 1, '1971-12-02', '4', '221', 'wehyf@mailinator.com', NULL, 'Belle Booth', NULL, NULL, NULL, 'Logan Barton', NULL, NULL, NULL, NULL, NULL, NULL, 'Zachary Goodwin', 'Earum minima deserun', 'Praesentium neque ne', 'Et iure nostrud mini', 'Nobis harum alias in', 'Mollitia quo autem a', 'Et iure nostrud mini', 'Nobis harum alias in', 'Mollitia quo autem a', 'Neque aliqua Vel od', NULL, 'Keane Romero', 'Impedit facilis qui', 'Michelle Schroeder', 'Dolorum eos alias bl', 'Sapiente est ut temp', 'fenifew@mailinator.com', '2020-12-11', 'Repellendus Proiden', '+1 (918) 888-1117', 'Dolor porro magni ve', 'Id magni nisi quam c', 'Praesentium corporis', 2, 'doloxoh@mailinator.com', '4', '34', '340', '4', '34', '340', 'Quis tempor suscipit', '1', 'Good', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-11-29 10:27:38', '2020-12-30 05:46:37'),
(18, 1, 25, 10, 5, 2020108, NULL, NULL, 'Brendan Carroll', 3, 4, '2005-11-12', '1', '374', 'buzul@mailinator.com', NULL, 'Mufutau Pate', NULL, NULL, NULL, 'Hermione Vega', NULL, NULL, NULL, NULL, NULL, NULL, 'Alec Goff', 'Qui eligendi sed cul', 'Nihil magna et dolor', 'In qui esse est id', 'Veritatis aliqua Pa', 'Maxime quo et aut ni', 'Irure fugiat dolori', 'Commodi ex numquam d', 'Error enim cillum la', 'Voluptas sunt ullam', NULL, 'Gisela Meyer', 'Et nisi voluptas ea', 'Basil Joseph', 'Voluptatibus pariatu', 'Ad voluptatibus iure', 'wizon@mailinator.com', '1979-08-03', 'Officia anim mollit', '+1 (531) 774-7207', 'Perspiciatis facili', 'Velit voluptas dolo', 'Est nostrum asperior', 1, 'wemufu@mailinator.com', '7', '20', '357', '5', '7', '389', 'Aliquid cumque aute', NULL, 'Good', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-01 08:56:04', '2021-01-06 11:27:30'),
(19, 1, 25, 10, 5, 2020109, NULL, NULL, 'Quamar Davidson', 3, 2, '2007-08-08', '8', '190', 'totizusejo@mailinator.com', NULL, 'Reuben Barker', NULL, NULL, NULL, 'Emery Dejesus', NULL, NULL, NULL, NULL, NULL, NULL, 'Pandora Burks', 'Totam molestiae corr', 'In commodi quia dolo', 'Animi impedit quo', 'Aut placeat id sin', 'Consequatur volupta', 'Animi impedit quo', 'Aut placeat id sin', 'Consequatur volupta', 'Neque in qui est dol', NULL, 'Iola Ruiz', 'Commodi excepteur do', 'Xena Bowen', 'Quos dolor sed sint', 'Illo at nesciunt el', 'xejakop@mailinator.com', '0000-00-00', 'Rerum recusandae Su', '+1 (719) 591-5953', 'Deserunt ut cupidata', 'Ullam at est aut est', 'In reiciendis quia d', 2, 'kunapo@mailinator.com', '7', '20', NULL, '7', '20', NULL, 'Labore ut iure fuga', '1', 'Fair', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-01 10:20:49', '2021-01-06 11:27:33'),
(23, 1, 25, 10, 5, 2020110, NULL, NULL, 'Rae Branch', 3, 4, '0000-00-00', '1', '40', 'cebebodi@mailinator.com', NULL, 'Genevieve Gentry', NULL, NULL, NULL, 'Aladdin Hewitt', NULL, NULL, NULL, NULL, NULL, NULL, 'Fleur Patrick', 'Corporis nihil dolor', 'Necessitatibus in eo', 'Consectetur archite', 'Laudantium nihil no', 'Aliquid qui perspici', 'Consectetur archite', 'Laudantium nihil no', 'Aliquid qui perspici', 'Quia et aliqua Nequ', NULL, 'Todd Weber', 'In consequatur Quos', 'Micah Jones', 'Temporibus atque dol', 'Incididunt molestias', 'salexo@mailinator.com', '0000-00-00', 'Optio dolore adipis', '+1 (509) 124-7572', 'Magni sed laboriosam', 'Ea a veritatis quis', 'Quidem facere beatae', 1, 'suqu@mailinator.com', '5', '40', '405', '5', '40', '405', 'Repudiandae obcaecat', '1', 'Nill', '$2y$10$bnNRAVEv9RI/VCKH94TpT.YuA5Qq6WNC.dGWI/sZTG87M0yHybr7K', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-03 07:10:58', '2020-12-07 07:33:01'),
(25, 1, 25, 10, 5, 2020111, NULL, NULL, 'Abra Weeks', 1, 2, '1970-01-01', '8', '435', 'hydisaj@mailinator.com', NULL, 'Shea Baird', NULL, NULL, NULL, 'Scott Burt', NULL, NULL, NULL, NULL, NULL, NULL, 'Jordan Atkinson', 'Nam veniam do dolor', 'Laborum consequatur', 'Aut sit ullam nobis', 'Eu adipisci quis sit', 'Blanditiis autem eum', 'Aut sit ullam nobis', 'Eu adipisci quis sit', 'Blanditiis autem eum', 'Deserunt voluptatibu', NULL, 'Maite Houston', 'Assumenda beatae mai', 'Mollie Holland', 'Tempora est volupta', 'Autem voluptatem sin', 'kysine@mailinator.com', '1972-12-08', 'Ullamco officia inve', '+1 (619) 625-7969', 'Excepturi ut aut lau', 'Ad at praesentium ip', 'Nostrud architecto a', 1, 'lakeby@mailinator.com', '1', '4', '478', '1', '4', '478', 'Optio rerum id et u', '1', 'Fair', '$2y$10$CgcfNI4I4aUPb9uItL2Nq.mNcUBOAL8WguVY.GZGN1myOvGvfNApu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-03 07:32:56', '2021-01-06 11:27:38'),
(26, 1, 25, 10, 5, 2020112, NULL, NULL, 'fgfgfgfgfgfgfgf', 2, 3, '0000-00-00', '7', '888', 'lizawyqu@mailinator.com', NULL, 'Scott Ramos', NULL, NULL, NULL, 'Dorothy Wood', NULL, NULL, NULL, NULL, NULL, NULL, 'Gail Tyson', 'Exercitation eligend', 'Dolores eius cum qui', 'Dolor distinctio Op', 'Reiciendis minus eum', 'Quidem eum facere no', 'Dolor distinctio Op', 'Reiciendis minus eum', 'Quidem eum facere no', 'Rerum et consequuntu', NULL, 'Ifeoma Walker', 'Similique sint reici', 'Hanae Bean', 'Doloribus id ex labo', 'Ipsum hic expedita q', 'bejyzelo@mailinator.com', '0000-00-00', 'Nulla consequatur a', '+1 (184) 185-1456', 'Aut illum ab volupt', 'Ipsa voluptas ad ip', 'Ut aut totam ipsum q', 2, 'fulutit@mailinator.com', '4', '25', '313', '4', '25', '313', 'Quis dolores ducimus', '1', NULL, '$2y$10$KVq9jMT1YbfpCC8xinx.L.F//KRGRrdw/5NlMi2xcv.23eTzyi3ny', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-03 09:50:51', '2020-12-07 07:33:01'),
(27, 1, 25, 10, 5, 2020113, NULL, NULL, 'Debra Bowers', 1, 1, '0000-00-00', '2', '77', 'cujyz@mailinator.com', NULL, 'Kylee Dickerson', NULL, NULL, NULL, 'Gregory Sykes', NULL, NULL, NULL, NULL, NULL, NULL, 'Hector Diaz', 'Repudiandae non qui', 'Aliquip quia est qu', 'Voluptatem ut ipsam', 'Consequuntur et at q', 'Ipsa ea quia amet', 'Ipsum sit qui et v', 'Esse officia unde c', 'Laudantium vero ani', 'Molestiae cillum a a', NULL, 'Cameron Sheppard', 'Delectus est aute', 'Guinevere Wright', 'Commodo obcaecati om', 'Tenetur modi ut offi', 'duhybu@mailinator.com', '0000-00-00', 'Cupidatat anim aut u', '+1 (263) 376-2322', 'Facere itaque fuga', 'Dolore et rerum labo', 'Quis reprehenderit', 1, 'tomubov@mailinator.com', '2', '2', NULL, '2', '8', '56', 'Suscipit doloremque', NULL, 'Poor', '$2y$10$S/ZV/3rIfNZzTRYFilOZVuZ4Dej0JeY0bLScqI63J5BM7cn3.Klia', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 05:46:52', '2020-12-07 07:33:02'),
(28, 1, 25, 10, 5, 2020114, NULL, NULL, 'Bertha Patterson', 2, 5, '0000-00-00', '4', '329', 'hixinunut@mailinator.com', NULL, 'Sebastian Roy', NULL, NULL, NULL, 'Carol Bates', NULL, NULL, NULL, NULL, NULL, NULL, 'Ashton Carrillo', 'Odio in fugiat blan', 'Numquam exercitation', 'Quod voluptatem Dol', 'Eos quos molestiae', 'Consequatur eligend', 'Quod voluptatem Dol', 'Eos quos molestiae', 'Consequatur eligend', 'Incididunt qui sit t', NULL, 'Constance Bauer', 'Vitae error a deseru', 'Prescott Medina', 'Reprehenderit dolor', 'Pariatur Atque volu', 'pukafugyt@mailinator.com', '0000-00-00', 'Est perspiciatis es', '+1 (368) 391-3059', 'Enim rerum vero omni', 'Est quia omnis ut po', 'Commodi Nam non nisi', 1, 'bixekuhur@mailinator.com', '8', NULL, NULL, '8', NULL, NULL, 'Impedit harum lorem', '1', 'Fair', '$2y$10$uTyz844PsSWH6x6rn3HP2uFUmq1uS5MPR4nXm8azR8COpcc0FncgG', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 05:47:32', '2020-12-07 07:33:02'),
(29, 1, 25, 10, 5, 2020115, NULL, NULL, 'Colby Meyer', 2, 2, '0000-00-00', '2', '255', 'boxoqehu@mailinator.com', NULL, 'Ava Vance', NULL, NULL, NULL, 'Vivien Randall', NULL, NULL, NULL, NULL, NULL, NULL, 'Yael Howard', 'Sed laudantium non', 'Labore minima aut vo', 'Sequi velit temporib', 'Molestiae exercitati', 'Sed et deserunt mini', 'Sequi velit temporib', 'Molestiae exercitati', 'Sed et deserunt mini', 'Commodo voluptatem', NULL, 'Ciaran Ellis', 'Repellendus Sed qua', 'Kelly Compton', 'Nostrum error deleni', 'Iure deserunt aut re', 'ramuvof@mailinator.com', '0000-00-00', 'Praesentium rerum au', '+1 (736) 596-8467', 'Dignissimos dolor qu', 'Doloremque reprehend', 'Consectetur qui nat', 2, 'fykybebeq@mailinator.com', '7', '37', '361', '7', '37', '361', 'Autem maxime adipisi', '1', 'Nill', '$2y$10$R128.hwfgNEP.N3aHO4sQO4Ga/moTMY/MKHHgs707PA.kMMI9f29a', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 05:49:25', '2020-12-07 07:33:02'),
(30, 1, 25, 10, 5, 2020116, NULL, NULL, 'Hyatt Duffy', 1, 2, '1998-05-05', '1', '422', 'miza@mailinator.com', NULL, 'Lani Joseph', NULL, NULL, NULL, 'Ferdinand Wright', NULL, NULL, NULL, NULL, NULL, NULL, 'Jerome Anthony', 'Commodi non id bland', 'Cillum excepteur dol', 'Mollitia qui velit', 'Et eos velit et ull', 'Quis aute non conseq', 'Mollitia qui velit', 'Et eos velit et ull', 'Quis aute non conseq', 'Dolore vitae rerum d', NULL, 'Cailin Sargent', 'Aspernatur quia est', 'Isaiah Hayes', 'Anim libero sed ex n', 'Amet adipisci unde', 'xypexel@mailinator.com', '2008-03-04', 'Voluptate consequat', '+1 (447) 352-2157', 'Recusandae Molestia', 'Optio quo aut aut p', 'Amet sint laborum', 2, 'valogaci@mailinator.com', '3', '42', '256', '3', '42', '256', 'Qui voluptate tempor', '1', NULL, '$2y$10$1KGJDE6/fPJ/ur3S0w1zMeKAIBCGRuXpLxLUVpzYpwo66eC8W9pia', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 05:50:16', '2020-12-07 07:33:02'),
(31, 1, 25, 10, 5, 2020117, NULL, NULL, 'Liberty Burke', 2, 5, '0000-00-00', '3', '378', 'kybewy@mailinator.com', NULL, 'Hasad Carson', NULL, NULL, NULL, 'Caldwell Lucas', NULL, NULL, NULL, NULL, NULL, NULL, 'Fiona Rush', 'Officia consequatur', 'Eu aliqua Ipsum id', 'Quisquam ipsum vel', 'Voluptatem Nihil ut', 'Cillum tempora omnis', 'Quisquam ipsum vel', 'Voluptatem Nihil ut', 'Cillum tempora omnis', 'Sed est nobis occaec', NULL, 'Daphne Rush', 'Ut eum facilis sequi', 'Mohammad Erickson', 'Consequatur Aliquid', 'Velit itaque et face', 'wabojy@mailinator.com', '2018-05-07', 'In non ducimus volu', '+1 (946) 901-8531', 'Exercitation ad quas', 'Id iure nobis sit of', 'Consequatur volupta', 1, 'nanuvi@mailinator.com', '7', '20', NULL, '7', '20', NULL, 'Minus amet dolor ma', '1', 'Nill', '$2y$10$/1OueJHYbwtNXU3wnF6jOeunw/CeaRxXg.T5SyFSRsV1FFaJqGCdm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:04:20', '2020-12-07 07:33:02'),
(32, 1, 25, 10, 5, 2020118, NULL, NULL, 'Ciaran Cleveland', 2, 1, '1970-02-07', '8', '959', 'lajulyd@mailinator.com', NULL, 'Michael Blankenship', NULL, NULL, NULL, 'Sage Wilkins', NULL, NULL, NULL, NULL, NULL, NULL, 'Nora Allison', 'Veritatis autem est', 'Ipsam quia placeat', 'Sed omnis enim aliqu', 'Eiusmod aut velit no', 'Voluptatibus debitis', 'Sed omnis enim aliqu', 'Eiusmod aut velit no', 'Voluptatibus debitis', 'Voluptatem minima qu', NULL, 'Reuben Cote', 'Minim rerum laborum', 'Ina Campos', 'Eos ut et a aperiam', 'Velit sit eos arch', 'notaly@mailinator.com', '1997-03-12', 'Nulla veniam sit q', '+1 (911) 841-5466', 'Laudantium deleniti', 'Debitis et facere au', 'Eaque dicta nemo dol', 2, 'weka@mailinator.com', '1', '3', '355', '1', '3', '355', 'A reprehenderit null', '1', 'Good', '$2y$10$FKzKSwFtERix2VGEr84tD.2.BZEhfOaurN9kyC.tuZhAjOWFwMA1u', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:04:38', '2020-12-07 07:33:02'),
(33, 1, 25, 10, 5, 2020119, NULL, NULL, 'Taylor Craig', 2, 2, '1983-10-08', '5', '134', 'daquku@mailinator.com', NULL, 'Jennifer Ferguson', NULL, NULL, NULL, 'Irene Warner', NULL, NULL, NULL, NULL, NULL, NULL, 'Melyssa Kelly', 'Earum animi cupidit', 'Voluptate inventore', 'Exercitationem fugia', 'Ea eveniet tempore', 'Cupiditate amet lab', 'Repudiandae et repre', 'Dolor est alias et s', 'Reiciendis qui conse', 'Sint laborum Ullam', NULL, 'Andrew Walters', 'Culpa iste sint qui', 'Lillian Moon', 'Omnis asperiores vol', 'Vitae asperiores dol', 'nixit@mailinator.com', '0000-00-00', 'Maiores adipisicing', '+1 (623) 551-2453', 'Inventore consequatu', 'Quibusdam ut minima', 'Ut minus culpa rerum', 2, 'muwepod@mailinator.com', '7', '20', NULL, '5', '40', '408', 'Quae laborum Vitae', NULL, 'Good', '$2y$10$OkCgWAlR1qvQ54HGFgl1GOnpaSfXEoRVENWJCKczQG9QV0EVsyQYO', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:05:19', '2020-12-07 07:33:02'),
(34, 1, 25, 10, 5, 2020120, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', '361', '7', '20', '361', 'Accusamus et et ut m', '1', 'Good', '$2y$10$UJ0KKQ/7paGvW5htc5bHDOdetijY9A.qDdi0Jhkk9lQdQzr/WD49K', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:12', '2020-12-07 07:33:02'),
(35, 1, 25, 10, 5, 2020121, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', NULL, '7', '20', NULL, 'Accusamus et et ut m', '1', NULL, '$2y$10$ZwFZfnGevVLvB6TmT53SyOSvloBqp02poyYJ1Jzn7hpy.B7F1Ivk2', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:13', '2020-12-07 07:33:02'),
(36, 1, 25, 10, 5, 2020122, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', '361', '7', '20', '361', 'Accusamus et et ut m', '1', 'Good', '$2y$10$52Pa24gc8C/v8KV/hwagnuGupag3Sk0B65lpCjS6PenXSh23Dzr1W', 3, 'aad', NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:14', '2020-12-10 07:31:14'),
(37, 1, 25, 10, 5, 2020123, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', NULL, '7', '20', NULL, 'Accusamus et et ut m', '1', NULL, '$2y$10$tvoM0VlGOmhPLcgylcCKIum6R3ikHhTP6FcZLD0w7GCYIaAygxJQ6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:14', '2020-12-07 07:33:02'),
(38, 1, 25, 10, 5, 2020124, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', '361', '7', '20', '361', 'Accusamus et et ut m', '1', 'Good', '$2y$10$sd4o8u0nIvQbxWw3KXUWtOLV3gxx.Ll5hf1I15y2qAXSHO5Ukm0hS', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:19', '2020-12-07 07:33:02'),
(39, 1, 25, 10, 5, 2020125, NULL, NULL, 'Mariam Becker', 1, 3, '0000-00-00', '6', '608', 'keboti@mailinator.com', NULL, 'Jamal Owens', NULL, NULL, NULL, 'Aretha Wheeler', NULL, NULL, NULL, NULL, NULL, NULL, 'Adam Wong', 'Quos dolore elit si', 'Dolorem quia volupta', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Ex voluptates et qui', 'Architecto ut cum qu', 'Illo sit laboris re', 'Amet sit porro ani', NULL, 'Sebastian Maynard', 'Vel odio et perspici', 'Rebecca Lindsay', 'Error commodo doloru', 'Cum minim suscipit n', 'qyrupuz@mailinator.com', '0000-00-00', 'Vel aut nostrud dele', '+1 (673) 278-7297', 'Adipisci enim dolore', 'Quas adipisci volupt', 'Officia et non amet', 2, 'segac@mailinator.com', '7', '20', '361', '7', '20', '361', 'Accusamus et et ut m', '1', 'Good', '$2y$10$l5sELwUak8eRJm0Chh4L7Oyn3zKkv.Zo4RUXUGz7JHIB6N.pVx5eW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:19', '2020-12-07 07:33:02'),
(40, 1, 25, 10, 5, 2020126, NULL, NULL, 'Maia Farrell', 1, 4, '0000-00-00', '5', '569', 'pofezep@mailinator.com', NULL, 'Nina Hayes', NULL, NULL, NULL, 'Ahmed Knight', NULL, NULL, NULL, NULL, NULL, NULL, 'Uma Tran', 'Hic assumenda nisi d', 'Ab sint non asperior', 'Eum ad qui et aliqua', 'Quas et ullam non er', 'Quis exercitation fu', 'Eum ad qui et aliqua', 'Quas et ullam non er', 'Quis exercitation fu', 'Ex suscipit quis par', NULL, 'Amanda Wade', 'Aut fugiat tempor u', 'Xena Burris', 'Dolor eos quidem ma', 'Et nesciunt volupta', 'nuxe@mailinator.com', '1982-07-04', 'Aliquam quod est non', '+1 (189) 476-4177', 'Impedit mollit nihi', 'Accusamus a quia atq', 'Amet facilis eligen', 2, 'vonu@mailinator.com', '4', '1', NULL, '4', '1', NULL, 'Est labore dolore e', '1', 'Good', '$2y$10$IPJowhy8svGwFjDt1Pa/HOfBGCtocN.nm51RxHDVUy7rS8yZmBfHO', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:36', '2020-12-07 07:33:02'),
(41, 1, 25, 10, 5, 2020127, NULL, NULL, 'Garrett Vega', 1, 3, '0000-00-00', '1', '581', 'momypu@mailinator.com', NULL, 'Ariel Blackburn', NULL, NULL, NULL, 'Flynn Norman', NULL, NULL, NULL, NULL, NULL, NULL, 'Sylvia Mcleod', 'Sit aut qui qui dol', 'Ipsum aliquid volupt', 'Sint nulla qui possi', 'Qui dolore commodo p', 'Eos non sed aut occa', 'Sint nulla qui possi', 'Qui dolore commodo p', 'Eos non sed aut occa', 'Voluptatem ea cumque', NULL, 'Carson Stout', 'Ad pariatur Est la', 'Alvin Holman', 'Maiores sunt libero', 'Aut in nulla placeat', 'pymoj@mailinator.com', '0000-00-00', 'Numquam quae saepe v', '+1 (307) 363-4046', 'Dignissimos accusant', 'Officia veritatis re', 'Quis vel sapiente vo', 2, 'nozuvytopy@mailinator.com', '3', '13', '291', '3', '13', '291', 'Ducimus non digniss', '1', 'Nill', '$2y$10$G1feSpG4ClnHUL1CCY9er.nDbFfIatFaziI.ChTW3Rb4Lj03h8Ugm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:06:51', '2020-12-07 07:33:02'),
(42, 1, 25, 10, 5, 2020128, NULL, NULL, 'Clinton Harmon', 2, 3, '0000-00-00', '7', '754', 'wacu@mailinator.com', NULL, 'Leigh Taylor', NULL, NULL, NULL, 'Alexander Morrison', NULL, NULL, NULL, NULL, NULL, NULL, 'Madeson Sutton', 'Enim soluta quia quo', 'Aut odio asperiores', 'Eius rem nesciunt e', 'Sed corrupti quis n', 'Quis corrupti paria', 'Eius rem nesciunt e', 'Sed corrupti quis n', 'Quis corrupti paria', 'Consequat Consequun', NULL, 'Hilda Bradley', 'Soluta ut iure et fu', 'Patrick Schwartz', 'In quis nulla quo do', 'Nemo ut et in cillum', 'qisomy@mailinator.com', '0000-00-00', 'Minus et nobis labor', '+1 (151) 505-6728', 'Aut assumenda laboru', 'Ipsum eveniet tempo', 'Dolor hic sunt archi', 1, 'cabylugum@mailinator.com', '4', '1', '292', '4', '1', '292', 'Sed numquam quo numq', '1', NULL, '$2y$10$gwWy7pSw.quT7Q3CAd6qcuPsRzS.Sed003IoDGEBx/3JGkoWVCyZC', 5, 'ghhghghghgh', NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 07:42:51', '2020-12-31 05:04:29'),
(43, 1, 25, 10, 5, 2020129, NULL, NULL, 'Arthur Newton', 3, 4, '2014-08-06', '5', '116', 'teqasenino@mailinator.com', NULL, 'Mark Cortez', NULL, NULL, NULL, 'Cynthia Wyatt', NULL, NULL, NULL, NULL, NULL, NULL, 'Jeanette Dickson', 'Alias praesentium ac', 'Tempor iste commodo', 'Ut itaque consequat', 'Asperiores non deser', 'Eum cum sed at ullam', 'Ut itaque consequat', 'Asperiores non deser', 'Eum cum sed at ullam', 'Vitae molestiae dolo', NULL, 'Fredericka Wilder', 'Iure nisi qui rem qu', 'Juliet Yang', 'Aliquam tenetur ipsa', 'Dolore reprehenderit', 'lawira@mailinator.com', '1992-04-09', 'Corrupti aut sed pr', '+1 (474) 269-2712', 'In vel fuga Labore', 'Quia eaque delectus', 'Et molestiae volupta', 2, 'dazuvahas@mailinator.com', '1', '3', NULL, '1', '3', NULL, 'Ut deserunt placeat', '1', 'Nill', '$2y$10$.M3wOkMkIM0N8uVNHwOqm.knDWKcFT6X9EDDpnBMddMmYHkreNoVS', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-05 09:34:56', '2020-12-07 07:33:02'),
(44, 1, 25, 10, 5, 2020130, NULL, NULL, 'Jeremy Carver', 1, 2, '0000-00-00', '6', '759', 'bizyrywafo@mailinator.com', NULL, 'Sopoline Harris', NULL, NULL, NULL, 'Jared Campbell', NULL, NULL, NULL, NULL, NULL, NULL, 'Winter Hood', 'Ut et odit earum vol', 'Autem accusamus eius', 'Error amet eveniet', 'Sit dolores et omni', 'Dolorem voluptatum i', 'Error amet eveniet', 'Sit dolores et omni', 'Dolorem voluptatum i', 'Voluptas numquam cor', NULL, 'Aimee Barlow', 'Quod neque est sint', 'Rudyard Irwin', 'Sapiente aperiam imp', 'Eos reprehenderit l', 'qygo@mailinator.com', '1997-01-06', 'Et totam a voluptate', '+1 (964) 197-8203', 'Quia quod pariatur', 'Est eu magna nulla a', 'Quam ut nisi error q', 1, 'qezeg@mailinator.com', '2', '9', '75', '2', '9', '75', 'Ipsam maiores ut ear', '1', 'Poor', '$2y$10$whCneszPZ5DK40r7ZX13i.ADNwgpI34l6oipgG.Ao17y3D5VHbqmy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 08:24:38', '2020-12-07 07:33:02'),
(45, 1, 25, 10, 5, 2020131, NULL, NULL, 'Dylan Espinoza', 2, 2, '2008-03-05', '2', '553', 'geweni@mailinator.com', NULL, 'Arden Castillo', NULL, NULL, NULL, 'Jelani Maddox', NULL, NULL, NULL, NULL, NULL, NULL, 'Rhonda Eaton', 'Deserunt officiis do', 'Accusantium eu commo', 'Nisi nulla eos dele', 'Odio nisi exercitati', 'Id sunt corrupti', 'Nisi nulla eos dele', 'Odio nisi exercitati', 'Id sunt corrupti', 'Fugiat minima qui m', NULL, 'Jescie Armstrong', 'Nulla et aliquid qui', 'Chava Mcgowan', 'Eius magna magni cul', 'Quo et delectus fug', 'pynilyj@mailinator.com', '0000-00-00', 'Quia aliquid asperna', '+1 (126) 871-6171', 'Itaque molestiae bea', 'Quidem elit volupta', 'Voluptatem Voluptat', 1, 'jatex@mailinator.com', '2', '8', '55', '2', '8', '55', 'Nesciunt voluptas d', '1', 'Fair', '$2y$10$kBwaMVeJ2c2mJhrITZlG1Ot/jAiokf.NkmVEIWF1d19JqelQnvEi6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:05:15', '2020-12-07 07:33:02'),
(46, 1, 25, 10, 5, 2020132, NULL, NULL, 'Geraldine Becker', 2, 3, '0000-00-00', '5', '30', 'zuqec@mailinator.com', NULL, 'Raphael Bernard', NULL, NULL, NULL, 'Latifah Burgess', NULL, NULL, NULL, NULL, NULL, NULL, 'Imani Raymond', 'Quaerat qui necessit', 'Explicabo Nostrum v', 'Expedita dolor verit', 'Provident eum elige', 'Corporis reprehender', 'Expedita dolor verit', 'Provident eum elige', 'Corporis reprehender', 'Recusandae Minim pa', NULL, 'Kane Zimmerman', 'Temporibus unde dolo', 'Davis Stuart', 'Nulla amet voluptat', 'Qui ut magna tempor', 'gyxaketoh@mailinator.com', '2005-11-08', 'Consectetur in expli', '+1 (601) 807-2173', 'Sed proident suscip', 'Vero excepteur sunt', 'Obcaecati facilis si', 2, 'kynazel@mailinator.com', '2', '8', '53', '2', '8', '53', 'Quae quia aute dolor', '1', 'Good', '$2y$10$/WVI6v7F0guWMxmQUY0NxOMA4jTqHnjGK/LYKDX5cRO2Cw.9Xn7NC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:34:55', '2020-12-07 07:33:03'),
(47, 1, 25, 10, 5, 2020133, NULL, NULL, 'Macey Mcintyre', 2, 3, '0000-00-00', '7', '783', 'muhecugeb@mailinator.com', NULL, 'Keegan Marshall', NULL, NULL, NULL, 'Amanda Alexander', NULL, NULL, NULL, NULL, NULL, NULL, 'Nadine Adams', 'Sit voluptas provid', 'Magnam saepe occaeca', 'Ut esse numquam rep', 'Iure cumque quod cul', 'A sit delectus temp', 'Ut esse numquam rep', 'Iure cumque quod cul', 'A sit delectus temp', 'Aliquam ut minus ut', NULL, 'Phillip Goff', 'Esse sunt enim vel v', 'Jessica Simpson', 'Ea dolore possimus', 'Fugit ex eos sunt v', 'jitamoqyvo@mailinator.com', '0000-00-00', 'Dolore reprehenderit', '+1 (545) 111-1265', 'Voluptatem culpa eni', 'Architecto alias qua', 'Quia velit voluptati', 2, 'gavoqil@mailinator.com', '1', '6', '133', '1', '6', '133', 'Sapiente rerum venia', '1', 'Poor', '$2y$10$G2d50Vg6wNTl7vUZQgvSPuUt6unNAPXlU1CAkcWN6UThVyxeyWp5S', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:35:34', '2020-12-07 07:33:03'),
(48, 1, 25, 10, 5, 2020134, NULL, NULL, 'Penelope Crane', 1, 3, '1992-08-01', '2', '949', 'ririba@mailinator.com', NULL, 'Madeline Pena', NULL, NULL, NULL, 'Tamekah Bates', NULL, NULL, NULL, NULL, NULL, NULL, 'Rogan Mcmillan', 'Officiis aliquid exp', 'Et ut quisquam tempo', 'Ab nulla quidem qui', 'Doloremque et suscip', 'Voluptas odio dolor', 'Ab nulla quidem qui', 'Doloremque et suscip', 'Voluptas odio dolor', 'Sit explicabo Venia', NULL, 'MacKensie Mcintyre', 'In reiciendis mollit', 'Shannon Jones', 'Ad omnis quia sit nu', 'Sit do et debitis q', 'wesyfe@mailinator.com', '0000-00-00', 'Iste atque hic tempo', '+1 (339) 208-4838', 'Aut esse commodo de', 'Deserunt optio nece', 'Aut in aliquip odit', 2, 'golitiqep@mailinator.com', '4', '25', '313', '4', '25', '313', 'Illum possimus aut', '1', 'Poor', '$2y$10$26Mj9t27UfNPLVYT1T0EC.UtDOXayXlgcwWcK82O1JOxZ.m6xAfUC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:36:30', '2020-12-07 07:33:03'),
(49, 1, 25, 10, 5, 2020135, NULL, NULL, 'Brianna Rosales', 3, 4, '1996-06-08', '5', '633', 'rerufe@mailinator.com', NULL, 'Ariel Hart', NULL, NULL, NULL, 'Martin Ramirez', NULL, NULL, NULL, NULL, NULL, NULL, 'Devin Swanson', 'Quas voluptatem Lor', 'Ut aspernatur ea rem', 'Libero dolore non mo', 'Aspernatur et volupt', 'Assumenda incidunt', 'Libero dolore non mo', 'Aspernatur et volupt', 'Assumenda incidunt', 'Provident ab volupt', NULL, 'Caesar Carter', 'Facilis perferendis', 'Zenaida Deleon', 'Est animi ratione n', 'Odio aut unde aut au', 'nepywok@mailinator.com', '2007-10-10', 'Neque voluptates asp', '+1 (134) 367-9986', 'Molestiae eum expedi', 'Temporibus quia iste', 'In delectus rem nec', 2, 'gyvu@mailinator.com', '6', '29', '481', '6', '29', '481', 'Commodi velit offici', '1', 'Fair', '$2y$10$iCKT6nI8oy7r5TrJOwG2keAIf7SncWvKVcQoK6RAi3yKpdhsfi0N6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:41:06', '2020-12-07 07:33:03'),
(50, 1, 25, 10, 5, 2020136, NULL, NULL, 'Aileen Joyner', 1, 1, '0000-00-00', '8', '572', 'wejaw@mailinator.com', NULL, 'Felicia Riggs', NULL, NULL, NULL, 'Aaron Cameron', NULL, NULL, NULL, NULL, NULL, NULL, 'Signe Bowen', 'Voluptatem ipsam ev', 'Velit nulla in sit', 'Possimus voluptates', 'Sed eos porro rerum', 'Nostrum veniam nost', 'Possimus voluptates', 'Sed eos porro rerum', 'Nostrum veniam nost', 'Doloribus qui cum mi', NULL, 'Amena Weeks', 'Consequat Est aut q', 'Cole Mcpherson', 'Eveniet laboris sit', 'Sed aperiam laudanti', 'sifomebe@mailinator.com', '1994-12-03', 'Qui voluptatem est', '+1 (901) 727-7548', 'Cum est deleniti lab', 'Dolores culpa dolor', 'Laudantium vero mol', 1, 'dibilydy@mailinator.com', '7', '37', '362', '7', '37', '362', 'Sit dolor aliquip pl', '1', 'Good', '$2y$10$C0HnQwTXRZp9dtUyk/H6je5HsB/EdxoKNMDWPGowniSgEn4.3nSEi', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:43:24', '2020-12-07 07:33:03'),
(51, 1, 25, 10, 5, 2020137, NULL, NULL, 'Gage Weaver', 3, 3, '0000-00-00', '3', '215', 'lyxudig@mailinator.com', NULL, 'Amity Chavez', NULL, NULL, NULL, 'Dawn Collins', NULL, NULL, NULL, NULL, NULL, NULL, 'Yoshio Atkins', 'Et rerum beatae dolo', 'Temporibus consequat', 'Amet quo culpa rer', 'Ea amet iure quidem', 'Provident ipsam cor', 'Amet quo culpa rer', 'Ea amet iure quidem', 'Provident ipsam cor', 'Irure adipisci aut n', NULL, 'Georgia Wilson', 'Eveniet saepe aut i', 'Hammett Cummings', 'Ea laboriosam delec', 'Distinctio Dolore c', 'fedyvoveqo@mailinator.com', '0000-00-00', 'Dolore aut dolore al', '+1 (477) 534-6316', 'Optio odio animi e', 'Fugiat ad hic enim q', 'Velit sunt similique', 2, 'fuwobe@mailinator.com', '7', '61', '367', '7', '61', '367', 'Laboris minim dignis', '1', 'Fair', '$2y$10$uWAtazH.SI9A9JhknXcIbutoEu7OM4g9N08Yipm.lZIvZnRttqct.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:45:33', '2020-12-07 07:33:03'),
(52, 1, 25, 10, 5, 2020138, NULL, NULL, 'Jin Sharp', 3, 1, '0000-00-00', '2', '969', 'pegasevo@mailinator.com', NULL, 'Shelley Taylor', NULL, NULL, NULL, 'Brian Wooten', NULL, NULL, NULL, NULL, NULL, NULL, 'Chiquita Justice', 'Dolorem rem labore h', 'Consequuntur autem s', 'Facilis itaque volup', 'Adipisicing sit eum', 'Quas optio quia rat', 'Facilis itaque volup', 'Adipisicing sit eum', 'Quas optio quia rat', 'Architecto et eos d', NULL, 'Brendan Hurst', 'Est dolor occaecat e', 'Shelby Montoya', 'Ut pariatur Aute fu', 'Adipisicing alias ci', 'wyzuwa@mailinator.com', '1991-04-12', 'Ipsam minim dolorem', '+1 (126) 703-4842', 'Magni perspiciatis', 'Fuga Est maiores n', 'Velit recusandae I', 2, 'jitixu@mailinator.com', '2', '9', '65', '2', '9', '65', 'Doloribus anim dolor', '1', 'Fair', '$2y$10$J7.9w2IeMqfnU7bA02s6YefwDyMitnslYdYjZR2GAu1FF5LWZ/1Jy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-06 10:49:15', '2020-12-07 07:33:03'),
(53, 1, 25, 10, 5, 2020139, NULL, NULL, 'Roth Sexton', 2, 1, '0000-00-00', '4', '564', 'fuca@mailinator.com', NULL, 'Thaddeus Holcomb', NULL, NULL, NULL, 'Fiona Bell', NULL, NULL, NULL, NULL, NULL, NULL, 'Talon Vang', 'Dolorem velit est si', 'Illum quibusdam tem', 'Laboris beatae asper', 'Sed commodi aliqua', 'Itaque veniam dolor', 'Laboris beatae asper', 'Sed commodi aliqua', 'Itaque veniam dolor', 'Blanditiis exercitat', NULL, 'TaShya Valdez', 'Porro laborum totam', 'Rigel Cantu', 'Deserunt quis eius n', 'Enim sit accusamus', 'feka@mailinator.com', '2012-01-02', 'Rerum adipisci incid', '+1 (679) 168-1384', 'Repudiandae ut sed e', 'In quo possimus por', 'Velit asperiores in', 2, 'danez@mailinator.com', '1', '4', '123', '1', '4', '123', 'Illum iure velit at', '1', 'Poor', '$2y$10$qLG5pBXnzzsaQOGtOHpyjeBDcjzRkalpcAP61ncu0Rj8ba/twQ8nm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 04:52:33', '2020-12-07 07:33:03'),
(54, 1, 25, 10, 5, 2020140, NULL, NULL, 'Roth Sexton', 2, 1, '0000-00-00', '4', '564', 'fuca@mailinator.com', NULL, 'Thaddeus Holcomb', NULL, NULL, NULL, 'Fiona Bell', NULL, NULL, NULL, NULL, NULL, NULL, 'Talon Vang', 'Dolorem velit est si', 'Illum quibusdam tem', 'Laboris beatae asper', 'Sed commodi aliqua', 'Itaque veniam dolor', 'Laboris beatae asper', 'Sed commodi aliqua', 'Itaque veniam dolor', 'Blanditiis exercitat', NULL, 'TaShya Valdez', 'Porro laborum totam', 'Rigel Cantu', 'Deserunt quis eius n', 'Enim sit accusamus', 'feka@mailinator.com', '2012-01-02', 'Rerum adipisci incid', '+1 (679) 168-1384', 'Repudiandae ut sed e', 'In quo possimus por', 'Velit asperiores in', 2, 'danez@mailinator.com', '1', '4', '123', '1', '4', '123', 'Illum iure velit at', '1', 'Poor', '$2y$10$c4zQ2NEJERllfiYjb4rMXOeXiFX3ChsrAdBc20nWneBy0y9qdbzUy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 04:54:09', '2020-12-07 07:33:03'),
(55, 1, 25, 10, 5, 2020141, NULL, NULL, 'Delilah Waters', 1, 2, '2000-07-04', '1', '783', 'nisaj@mailinator.com', NULL, 'Jack Bird', NULL, NULL, NULL, 'Sasha Douglas', NULL, NULL, NULL, NULL, NULL, NULL, 'Jacob Walters', 'Rem nostrum iure exc', 'Ullamco vel maiores', 'Voluptas dolore nihi', 'Non ab excepteur del', 'Delectus porro in v', 'Voluptas dolore nihi', 'Non ab excepteur del', 'Delectus porro in v', 'Sit quis ab vitae i', NULL, 'Hedda Kline', 'Possimus soluta ad', 'Olga Allison', 'Deleniti ut eligendi', 'Dolor optio assumen', 'kige@mailinator.com', '0000-00-00', 'Sint eiusmod elit l', '+1 (196) 256-3531', 'Voluptas vitae aliqu', 'Mollit ea similique', 'Cupiditate libero eu', 2, 'puvogobam@mailinator.com', '6', '29', '478', '6', '29', '478', 'Qui dolorem quos qua', '1', 'Nill', '$2y$10$mcwatYixHhAEbcTVDBqUsO/ilYQ7ti/56Utxv4aBvlSUYyOYe83OC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 04:55:42', '2020-12-07 07:33:03'),
(56, 1, 25, 10, 5, 2020142, NULL, NULL, 'Delilah Waters', 1, 2, '2000-07-04', '1', '783', 'nisaj@mailinator.com', NULL, 'Jack Bird', NULL, NULL, NULL, 'Sasha Douglas', NULL, NULL, NULL, NULL, NULL, NULL, 'Jacob Walters', 'Rem nostrum iure exc', 'Ullamco vel maiores', 'Voluptas dolore nihi', 'Non ab excepteur del', 'Delectus porro in v', 'Voluptas dolore nihi', 'Non ab excepteur del', 'Delectus porro in v', 'Sit quis ab vitae i', NULL, 'Hedda Kline', 'Possimus soluta ad', 'Olga Allison', 'Deleniti ut eligendi', 'Dolor optio assumen', 'kige@mailinator.com', '0000-00-00', 'Sint eiusmod elit l', '+1 (196) 256-3531', 'Voluptas vitae aliqu', 'Mollit ea similique', 'Cupiditate libero eu', 2, 'puvogobam@mailinator.com', '6', '29', '478', '6', '29', '478', 'Qui dolorem quos qua', '1', 'Nill', '$2y$10$K/BTG3u636NvVk/BsYP.0e5J20GXiUkOOnJVfMozAIR21or0UJ1FC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 04:57:56', '2020-12-07 07:33:03'),
(57, 1, 25, 10, 5, 2020143, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$foNj7fIH92JVPBTKCdKjP.UF959SF3U4k8aZokz0NQ4qpDUdJL2uq', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:00:09', '2020-12-07 07:33:03'),
(58, 1, 25, 10, 5, 2020144, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$IXn0iupkn6UJGZJrG746c.ymWTQVCeY8agbHowQ98DSpgJJWPxjKy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:04:44', '2020-12-07 07:33:03'),
(59, 1, 25, 10, 5, 2020145, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$hoIYYRnryAFlRfjY.Hh2.OLsQu5vGgZUI7j5MMDvRZBebL0ccwcFC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:05:33', '2020-12-07 07:33:03'),
(60, 1, 25, 10, 5, 2020146, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$j7Tsoxg21Ygy9/2XZhOPDeggmnquRyPHZ0WhnvN/j6fRFAgVubMOO', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:06:06', '2020-12-07 07:33:03'),
(61, 1, 25, 10, 5, 2020147, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$I3fTFrXzsuQqNoUe5BXms.D0XEzLkv2kOKwDBgPksYzf8.ThX7PGm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:07:17', '2020-12-07 07:33:03'),
(62, 1, 25, 10, 5, 2020148, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$9QCUDloqSJk7N1GxdzxHuuxQ75k64GgN57gyLmPUqgzz/lcyXlmGK', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:07:29', '2020-12-07 07:33:03'),
(63, 1, 25, 10, 5, 2020149, NULL, NULL, 'Erin French', 2, 3, '1978-11-06', '5', '457', 'xucegona@mailinator.com', NULL, 'Sydney Russo', NULL, NULL, NULL, 'Lacey Moon', NULL, NULL, NULL, NULL, NULL, NULL, 'Medge Gomez', 'Ipsum ullam volupta', 'Magnam iure dolor Na', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'Aliquid omnis et ali', 'A perferendis quos e', 'Eu nostrum eligendi', 'A consequat Possimu', NULL, 'Camilla Wilkinson', 'Dolores distinctio', 'Dominique Griffin', 'Debitis rem obcaecat', 'A voluptates tempori', 'bysidegy@mailinator.com', '0000-00-00', 'Nisi ullam incidunt', '+1 (415) 784-8855', 'Ea officia est ex d', 'Aspernatur error ull', 'Ut asperiores perspi', 1, 'civyf@mailinator.com', '4', '10', '301', '4', '10', '301', 'Illum adipisicing o', '1', 'Good', '$2y$10$9zwCPXRUxwHV.B3xmEnIn.ySAwH4Wrbm61dWkkjOQQN6JmP1MKaii', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:08:48', '2020-12-07 07:33:03'),
(64, 1, 25, 10, 5, 2020150, NULL, NULL, 'Vanna Oconnor', 3, 3, '1991-01-08', '6', '601', 'wytolehec@mailinator.com', NULL, 'Trevor Cain', NULL, NULL, NULL, 'Brenna Park', NULL, NULL, NULL, NULL, NULL, NULL, 'Blythe Spencer', 'Nisi labore dignissi', 'Rerum incididunt quo', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Est cupiditate conse', NULL, 'Hiram Wiggins', 'Quo voluptatem Ut f', 'Regina Peck', 'Ut exercitation volu', 'Dicta ut ut dolore o', 'zypybyg@mailinator.com', '1970-06-10', 'Dolor repellendus V', '+1 (787) 876-4156', 'Quia aut labore adip', 'Commodi facilis in n', 'Libero sed eaque pla', 1, 'byjaroqa@mailinator.com', '3', '19', '197', '3', '19', '197', 'Voluptate et aperiam', '1', 'Nill', '$2y$10$pIwnUYeE7XzwOz5/5bPVi.hhRBysKOfvFvkgrJoIZnc917rI.pF36', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:25:17', '2020-12-07 07:33:03'),
(65, 1, 25, 10, 5, 2020151, NULL, NULL, 'Vanna Oconnor', 3, 3, '1991-01-08', '6', '601', 'wytolehec@mailinator.com', NULL, 'Trevor Cain', NULL, NULL, NULL, 'Brenna Park', NULL, NULL, NULL, NULL, NULL, NULL, 'Blythe Spencer', 'Nisi labore dignissi', 'Rerum incididunt quo', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Est cupiditate conse', NULL, 'Hiram Wiggins', 'Quo voluptatem Ut f', 'Regina Peck', 'Ut exercitation volu', 'Dicta ut ut dolore o', 'zypybyg@mailinator.com', '1970-06-10', 'Dolor repellendus V', '+1 (787) 876-4156', 'Quia aut labore adip', 'Commodi facilis in n', 'Libero sed eaque pla', 1, 'byjaroqa@mailinator.com', '3', '19', '197', '3', '19', '197', 'Voluptate et aperiam', '1', 'Nill', '$2y$10$H8KJHGLh/qJ1JTi8G/JsheDOcfuUSvRLbUt645Kjgn.2JulTSgYEe', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:28:59', '2020-12-07 07:33:03'),
(66, 1, 25, 10, 5, 2020152, NULL, NULL, 'Vanna Oconnor', 3, 3, '1991-01-08', '6', '601', 'wytolehec@mailinator.com', NULL, 'Trevor Cain', NULL, NULL, NULL, 'Brenna Park', NULL, NULL, NULL, NULL, NULL, NULL, 'Blythe Spencer', 'Nisi labore dignissi', 'Rerum incididunt quo', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Est cupiditate conse', NULL, 'Hiram Wiggins', 'Quo voluptatem Ut f', 'Regina Peck', 'Ut exercitation volu', 'Dicta ut ut dolore o', 'zypybyg@mailinator.com', '1970-06-10', 'Dolor repellendus V', '+1 (787) 876-4156', 'Quia aut labore adip', 'Commodi facilis in n', 'Libero sed eaque pla', 1, 'byjaroqa@mailinator.com', '3', '19', '197', '3', '19', '197', 'Voluptate et aperiam', '1', 'Nill', '$2y$10$IGJ6n.RKs6fQ8rioUS5I9eV29FHT8lDmVxgEoGjyJZkAcpf05cWYu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:29:32', '2020-12-07 07:33:03'),
(67, 1, 25, 10, 5, 2020153, NULL, NULL, 'Vanna Oconnor', 3, 3, '1991-01-08', '6', '601', 'wytolehec@mailinator.com', NULL, 'Trevor Cain', NULL, NULL, NULL, 'Brenna Park', NULL, NULL, NULL, NULL, NULL, NULL, 'Blythe Spencer', 'Nisi labore dignissi', 'Rerum incididunt quo', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Ea fuga Commodo dol', 'Laboris dolores at q', 'Exercitation sit au', 'Est cupiditate conse', NULL, 'Hiram Wiggins', 'Quo voluptatem Ut f', 'Regina Peck', 'Ut exercitation volu', 'Dicta ut ut dolore o', 'zypybyg@mailinator.com', '1970-06-10', 'Dolor repellendus V', '+1 (787) 876-4156', 'Quia aut labore adip', 'Commodi facilis in n', 'Libero sed eaque pla', 1, 'byjaroqa@mailinator.com', '3', '19', '197', '3', '19', '197', 'Voluptate et aperiam', '1', 'Nill', '$2y$10$F0pt/HqoMcHZZ5dcWYxPf.0h5cyDSYxfkiszPkys.61AGZsWJ7S4e', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:35:42', '2020-12-07 07:33:03');
INSERT INTO `admissions` (`id`, `school_id`, `section_id`, `class_id`, `preadmission_id`, `roll`, `mark`, `add_pass`, `name`, `gender`, `religon`, `dob`, `bloodgroup`, `mobile`, `email`, `photo`, `father_name`, `signature`, `fathercell`, `fatheremail`, `mother_name`, `mothercell`, `motheremail`, `fatheroccupation`, `motheroccupation`, `height`, `weight`, `contactperson`, `contactpersonmobile`, `realation`, `presentAddress`, `perpostoffice`, `perpostcode`, `pastAddress`, `pastpostoffice`, `pastpostcode`, `birthcertificateNo`, `fatherPassport`, `nameAddressofmainSchool`, `admissioninbengaliClass`, `gName`, `gNationality`, `gMobile`, `gEmail`, `gdate`, `gnrcNo`, `gPhone`, `gAddress`, `gOccupation`, `placeBirth`, `singaporepr`, `cemail`, `preDivision`, `preDistrict`, `preThana`, `pastDivision`, `pastDistrict`, `pastThana`, `nationality`, `persent_same`, `bengaliLang`, `password`, `status`, `remark`, `streetAddress_1`, `streetAddress_2`, `city`, `state`, `zipCode`, `country`, `created_at`, `updated_at`) VALUES
(68, 1, 25, 10, 5, 2020154, NULL, NULL, 'MacKenzie Dickerson', 3, 3, '0000-00-00', '1', '432', 'wymohylu@mailinator.com', NULL, 'Dean Stewart', NULL, NULL, NULL, 'Theodore Battle', NULL, NULL, NULL, NULL, NULL, NULL, 'Cora Bell', 'Et est omnis aperiam', 'Autem explicabo Nos', 'Fuga Maiores offici', 'Eiusmod qui doloremq', 'Ut iusto ut omnis sa', 'Fuga Maiores offici', 'Eiusmod qui doloremq', 'Ut iusto ut omnis sa', 'Tempore consectetur', NULL, 'Griffith Battle', 'Aut est modi corpori', 'Cleo Mccormick', 'Reprehenderit persp', 'Neque ducimus est', 'biqyje@mailinator.com', '0000-00-00', 'Aliqua Dolor verita', '+1 (144) 459-8336', 'Quidem ipsam excepte', 'Aute quia assumenda', 'Qui esse voluptas de', 2, 'dyfafokub@mailinator.com', '6', '29', '479', '6', '29', '479', 'Officiis aperiam eli', '1', 'Good', '$2y$10$nyDJBiyNQnURFZa32aOHrOnGZvatlP8uZIcyHS89tfTQbAnW8UBEe', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:37:09', '2020-12-07 07:33:03'),
(69, 1, 25, 10, 5, 2020155, NULL, NULL, 'Arthur Ewing', 2, 3, '0000-00-00', '3', '795', 'luberad@mailinator.com', NULL, 'Casey Hardy', NULL, NULL, NULL, 'Guinevere Riggs', NULL, NULL, NULL, NULL, NULL, NULL, 'Colin Dale', 'Sequi dolorem incidi', 'Aliqua Deserunt mag', 'Exercitation impedit', 'Assumenda maiores qu', 'Distinctio Omnis be', 'Exercitation impedit', 'Assumenda maiores qu', 'Distinctio Omnis be', 'Exercitation esse i', NULL, 'Nathan Hayden', 'Corrupti inventore', 'Iola Duffy', 'Et aut sed doloremqu', 'Facere modi consecte', 'bigepuno@mailinator.com', '2005-12-09', 'Dolorum a adipisci m', '+1 (834) 393-6272', 'Eligendi minus liber', 'Aut alias do dolor o', 'Nihil voluptate nobi', 2, 'kowy@mailinator.com', '4', '30', '334', '4', '30', '334', 'Reiciendis ex qui eu', '1', 'Poor', '$2y$10$a9P0erHke1Vm2cSIIGOiRe5gSx65FQzp3WyCn23VYy3KJzq0gldB6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 05:39:02', '2020-12-07 07:33:03'),
(70, 1, 25, 10, 5, 2020156, NULL, NULL, 'Patricia Reeves', 2, 2, '0000-00-00', '2', '736', 'pagip@mailinator.com', NULL, 'Chase Nieves', NULL, NULL, NULL, 'Melinda Koch', NULL, NULL, NULL, NULL, NULL, NULL, 'Willa Fields', 'Sed expedita id eaqu', 'Velit ut laudantium', 'Explicabo Repellend', 'Possimus modi qui l', 'Voluptatum voluptate', 'Explicabo Repellend', 'Possimus modi qui l', 'Voluptatum voluptate', 'Laborum aliqua Cons', NULL, 'Tanner Frye', 'Alias velit dolore o', 'Aurora Holloway', 'Dolor voluptatem At', 'Voluptas iusto excep', 'jeqazisawy@mailinator.com', '0000-00-00', 'Reprehenderit repreh', '+1 (642) 118-7101', 'Dolorum ratione mole', 'Illo rem est commodo', 'Sint non quos labore', 1, 'dajusisuq@mailinator.com', '6', '17', '472', '6', '17', '472', 'Hic lorem non ipsa', '1', 'Nill', '$2y$10$gkxLresfiSC3GjJVeLUTVeIDSz5VGZwhl9vz2A7c7UQU0Q.LfVM1u', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 06:11:33', '2020-12-07 07:33:03'),
(71, 1, 25, 10, 5, 2020157, NULL, NULL, 'Patricia Reeves', 2, 2, '0000-00-00', '2', '736', 'pagip@mailinator.com', NULL, 'Chase Nieves', NULL, NULL, NULL, 'Melinda Koch', NULL, NULL, NULL, NULL, NULL, NULL, 'Willa Fields', 'Sed expedita id eaqu', 'Velit ut laudantium', 'Explicabo Repellend', 'Possimus modi qui l', 'Voluptatum voluptate', 'Explicabo Repellend', 'Possimus modi qui l', 'Voluptatum voluptate', 'Laborum aliqua Cons', NULL, 'Tanner Frye', 'Alias velit dolore o', 'Aurora Holloway', 'Dolor voluptatem At', 'Voluptas iusto excep', 'jeqazisawy@mailinator.com', '0000-00-00', 'Reprehenderit repreh', '+1 (642) 118-7101', 'Dolorum ratione mole', 'Illo rem est commodo', 'Sint non quos labore', 1, 'dajusisuq@mailinator.com', '6', '17', '472', '6', '17', '472', 'Hic lorem non ipsa', '1', 'Nill', '$2y$10$F68GQWeaBGsKHHwNtNNCUe4NeXz0FGI4vLScsnp3qwO/I/j2.RGfK', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 06:14:40', '2020-12-07 07:33:04'),
(72, 1, 25, 10, 5, 2020158, NULL, NULL, 'Graham Grant', 1, 3, '1991-12-04', '1', '700', 'sefag@mailinator.com', NULL, 'Warren Swanson', NULL, NULL, NULL, 'Kyla Foster', NULL, NULL, NULL, NULL, NULL, NULL, 'Kamal Ramirez', 'Ut error incididunt', 'Ea voluptatem odio a', 'In commodo consectet', 'Exercitation rerum q', 'Sit tempore exercit', 'In commodo consectet', 'Exercitation rerum q', 'Sit tempore exercit', 'Placeat nesciunt v', NULL, 'Gail Donovan', 'Placeat est autem v', 'Montana Sparks', 'Reiciendis aliqua E', 'Quo est sint eos qu', 'hecoviliw@mailinator.com', '0000-00-00', 'Aperiam irure dolor', '+1 (485) 733-9963', 'Mollit laboris repud', 'Ipsum laboriosam te', 'Adipisicing cumque q', 1, 'hytedave@mailinator.com', '3', '53', '270', '3', '53', '270', 'Qui fugiat atque eaq', '1', 'Nill', '$2y$10$5kPGu7qz5z1dE8G8SscrMu9NFa4PMOEzqxgIQC2X6raPqpK86foWu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 06:53:39', '2020-12-07 07:33:04'),
(73, 1, 25, 10, 5, 2020159, NULL, NULL, 'Cheyenne Warner', 2, 3, '1977-02-11', '7', '795', 'jesacobok@mailinator.com', NULL, 'Kellie Ochoa', NULL, NULL, NULL, 'Colorado Jennings', NULL, NULL, NULL, NULL, NULL, NULL, 'William Barrera', 'Perspiciatis aliqui', 'Pariatur Odit sint', 'Magna aute quia qui', 'Fuga Quibusdam beat', 'Aut quia nesciunt e', 'Magna aute quia qui', 'Fuga Quibusdam beat', 'Aut quia nesciunt e', 'Animi sit porro sun', NULL, 'Alden Buck', 'Vero nisi ut vel rem', 'Rogan Leonard', 'Culpa sunt incidunt', 'Sed nisi sint vero d', 'tisigu@mailinator.com', '2006-03-06', 'Inventore esse quia', '+1 (899) 143-7781', 'Amet ab consequatur', 'Accusantium nisi dol', 'Sequi obcaecati ipsu', 2, 'zatydafev@mailinator.com', '3', '15', '183', '3', '15', '183', 'Labore officiis volu', '1', NULL, '$2y$10$xeX/RiCfy8Xo4RY8AvgvA.BXbe8rApWABGYQoz7qa3r2bNUP2lCH6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 07:01:13', '2020-12-07 07:33:04'),
(74, 1, 25, 10, 5, 2020160, NULL, NULL, 'Harlan Powers', 3, 4, '2017-06-05', '2', '732', 'xyjefabe@mailinator.com', NULL, 'Gisela Hendricks', NULL, NULL, NULL, 'Avram Melendez', NULL, NULL, NULL, NULL, NULL, NULL, 'MacKensie Bridges', 'Sed rerum ullamco qu', 'Error fugit aliquid', 'Dolor necessitatibus', 'Error mollit qui tem', 'Laborum Velit esse', 'Dolor necessitatibus', 'Error mollit qui tem', 'Laborum Velit esse', 'Do itaque Nam volupt', NULL, 'Kennan Valencia', 'Cumque distinctio C', 'Hadley Key', 'Perferendis commodi', 'Lorem ullamco dolore', 'naryc@mailinator.com', '0000-00-00', 'Esse debitis animi', '+1 (472) 676-1115', 'Est id laborum Qui', 'Omnis asperiores seq', 'Et quos provident e', 1, 'kuto@mailinator.com', '7', '61', '368', '7', '61', '368', 'Eum inventore et vol', '1', 'Nill', '$2y$10$LoaDUuQukBl8BeMZD4dh4u/mJpP2lF0kDIaF3bdgK9TluwOzUmtEG', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 07:35:04', '2020-12-07 07:35:04'),
(75, 1, 25, 10, 5, 2020161, NULL, NULL, 'Francesca Caldwell', 3, 1, '1977-03-09', '2', '475', 'maxo@mailinator.com', NULL, 'Charles Jensen', NULL, NULL, NULL, 'Willow Webb', NULL, NULL, NULL, NULL, NULL, NULL, 'Channing Montgomery', 'Sit et nostrum perf', 'Irure laboriosam du', 'In blanditiis perspi', 'Aut quo officia eius', 'Dolore itaque sunt d', 'In blanditiis perspi', 'Aut quo officia eius', 'Dolore itaque sunt d', 'Ad voluptas sed sequ', NULL, 'Nomlanga Alvarez', 'Veritatis est aliqui', 'Kellie Frederick', 'Iste praesentium in', 'Laboris eligendi eum', 'riwexodel@mailinator.com', '0000-00-00', 'Distinctio Id ipsum', '+1 (855) 612-9982', 'Aliquid voluptatem i', 'Duis dolorum ipsam p', 'Reprehenderit adipi', 2, 'pocyhabif@mailinator.com', '2', '11', '20', '2', '11', '20', 'Ratione dolor volupt', '1', 'Good', '$2y$10$zAVnzWaNIK4EuBKUdH/h4OiS06.0H5BF067C0/4FKjGb3p8tWjFh.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 07:42:47', '2020-12-07 07:42:47'),
(76, 1, 25, 10, 5, 2020162, NULL, NULL, 'Francesca Caldwell', 3, 1, '1977-03-09', '2', '475', 'maxo@mailinator.com', NULL, 'Charles Jensen', NULL, NULL, NULL, 'Willow Webb', NULL, NULL, NULL, NULL, NULL, NULL, 'Channing Montgomery', 'Sit et nostrum perf', 'Irure laboriosam du', 'In blanditiis perspi', 'Aut quo officia eius', 'Dolore itaque sunt d', 'In blanditiis perspi', 'Aut quo officia eius', 'Dolore itaque sunt d', 'Ad voluptas sed sequ', NULL, 'Nomlanga Alvarez', 'Veritatis est aliqui', 'Kellie Frederick', 'Iste praesentium in', 'Laboris eligendi eum', 'riwexodel@mailinator.com', '0000-00-00', 'Distinctio Id ipsum', '+1 (855) 612-9982', 'Aliquid voluptatem i', 'Duis dolorum ipsam p', 'Reprehenderit adipi', 2, 'pocyhabif@mailinator.com', '2', '11', '20', '2', '11', '20', 'Ratione dolor volupt', '1', 'Good', '$2y$10$capFlVv8Z2y8L9B7OXnnbu0i9iWwHHTg90zFQLHj4Zi3vxi79HtgC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 07:45:46', '2020-12-07 07:45:46'),
(77, 1, 25, 10, 5, 2020163, NULL, NULL, 'MacKenzie Perry', 3, 5, '1983-12-05', '3', '870', 'leha@mailinator.com', NULL, 'Zoe Hudson', NULL, NULL, NULL, 'Colin Fuentes', NULL, NULL, NULL, NULL, NULL, NULL, 'Ryder Everett', 'Tenetur qui fugiat', 'Debitis ullamco aper', 'Dolores consequatur', 'Occaecat aut repudia', 'Magna non exercitati', 'Dolores consequatur', 'Occaecat aut repudia', 'Magna non exercitati', 'Dolore quia voluptat', NULL, 'Alana Hartman', 'Sit officia est dol', 'Cynthia Savage', 'Numquam elit dolori', 'Similique incididunt', 'symuvu@mailinator.com', '1972-12-09', 'Asperiores ad qui eu', '+1 (603) 267-2755', 'Illum eiusmod nesci', 'Voluptatem qui animi', 'Vel enim ullamco ani', 2, 'byza@mailinator.com', '6', '32', '488', '6', '32', '488', 'Laudantium aliquid', '1', 'Good', '$2y$10$i0Zd53W3GJxdxi4snF.I/uoHhmVrJPjHInQJenb69cCJSfkcOuEqy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 08:30:30', '2020-12-07 08:30:30'),
(78, 1, 25, 10, 5, 2020164, NULL, NULL, 'Kibo Harris', 3, 2, '2006-12-09', '2', '343', 'vivyk@mailinator.com', NULL, 'Axel Wilkerson', NULL, NULL, NULL, 'Britanni Navarro', NULL, NULL, NULL, NULL, NULL, NULL, 'Patience Owen', 'Architecto sit cumq', 'Duis est ut nemo qui', 'Commodi voluptatem e', 'Molestiae quod ad vo', 'Qui in quos velit u', 'Commodi voluptatem e', 'Molestiae quod ad vo', 'Qui in quos velit u', 'Nostrud beatae beata', NULL, 'Claire Ewing', 'Aliquid voluptatum q', 'Arsenio Vasquez', 'Sint aut quia conse', 'Repudiandae obcaecat', 'ribe@mailinator.com', '0000-00-00', 'Ducimus elit offic', '+1 (871) 498-8184', 'Aspernatur qui asper', 'Ducimus culpa ut ve', 'Magna dolorem quo si', 1, 'rixacihep@mailinator.com', '4', '25', '314', '4', '25', '314', 'Esse ex doloremque n', '1', 'Fair', '$2y$10$3K56.VuQu/hcJlNFr0pa/.O1/gMTyIS2lQgqT7zzLcLy0awn.S1D.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 08:56:31', '2020-12-07 08:56:31'),
(79, 1, 25, 10, 5, 2020165, NULL, NULL, 'Linda Ellison', 3, 5, '0000-00-00', '8', '430', 'hexu@mailinator.com', NULL, 'Gary Dejesus', NULL, NULL, NULL, 'Tiger Perkins', NULL, NULL, NULL, NULL, NULL, NULL, 'Carly Fulton', 'Quo do nihil dolore', 'Qui dicta debitis fu', 'Elit duis quo sapie', 'Molestiae tempora et', 'Aspernatur rerum arc', 'Elit duis quo sapie', 'Molestiae tempora et', 'Aspernatur rerum arc', 'Quo excepturi volupt', NULL, 'Charlotte Rosales', 'Molestiae molestiae', 'Chester Townsend', 'Odit autem Nam est', 'Fuga Autem autem at', 'talycihyri@mailinator.com', '0000-00-00', 'Debitis itaque totam', '+1 (793) 815-8693', 'Fugiat magni deserun', 'Illum possimus aut', 'Cillum dolorum aut d', 2, 'nuremef@mailinator.com', '3', '58', '276', '3', '58', '276', 'Consequatur Laborum', '1', 'Good', '$2y$10$4FtmKQo5rrPbHGB3iCOMKuYT4m0g2WfUErEfxmPSfU2FRdvAdPGwS', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 10:02:46', '2020-12-07 10:02:46'),
(80, 1, 25, 10, 5, 2020166, NULL, NULL, 'Linda Ellison', 3, 5, '1970-01-01', '8', '430', 'hexu@mailinator.com', NULL, 'Gary Dejesus', NULL, NULL, NULL, 'Tiger Perkins', NULL, NULL, NULL, NULL, NULL, NULL, 'Carly Fulton', 'Quo do nihil dolore', 'Qui dicta debitis fu', 'Elit duis quo sapie', 'Molestiae tempora et', 'Aspernatur rerum arc', 'Elit duis quo sapie', 'Molestiae tempora et', 'Aspernatur rerum arc', 'Quo excepturi volupt', NULL, 'Charlotte Rosales', 'Molestiae molestiae', 'Chester Townsend', 'Odit autem Nam est', 'Fuga Autem autem at', 'talycihyri@mailinator.com', '1970-01-01', 'Debitis itaque totam', '+1 (793) 815-8693', 'Fugiat magni deserun', 'Illum possimus aut', 'Cillum dolorum aut d', 2, 'nuremef@mailinator.com', '3', '58', '276', '3', '58', '276', 'Consequatur Laborum', '1', 'Good', '$2y$10$l.bXPNvlRtUMYv8kNfvCwutfRj28CmMefYttQ41t97Np4QZ/lIOiy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 10:10:20', '2020-12-07 10:10:20'),
(81, 1, 25, 10, 5, 2020167, NULL, NULL, 'Anika Andrews', 1, 2, '1972-11-07', '7', '951', 'rehyduhofi@mailinator.com', NULL, 'Remedios Olson', NULL, NULL, NULL, 'Dominique Velazquez', NULL, NULL, NULL, NULL, NULL, NULL, 'Zorita Dudley', 'Nobis laborum eaque', 'Aliqua Molestiae es', 'Minim dolor occaecat', 'Rerum quibusdam amet', 'Id rerum ea molestia', 'Minim dolor occaecat', 'Rerum quibusdam amet', 'Id rerum ea molestia', 'Deleniti quasi cupid', NULL, 'Robin Mckay', 'Mollitia provident', 'Stephen Pugh', 'A maiores libero qui', 'Ut a eum iure rerum', 'kigatywuvo@mailinator.com', '1982-10-04', 'Eaque perferendis qu', '+1 (137) 253-8102', 'Aliqua Est ea dese', 'Harum Nam quis eiusm', 'Dolore proident eos', 2, 'zapilajore@mailinator.com', '3', '53', '273', '3', '53', '273', 'Consequatur Ea culp', '1', 'Good', '$2y$10$Nxq9q7UOPLtIpJdIIMU5me0qLqQs60w0//hVW9d5EBeclpzeojVoK', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 10:38:10', '2020-12-07 10:38:10'),
(82, 1, 25, 10, 5, 2020168, NULL, NULL, 'Rylee Clemons', 1, 5, '0000-00-00', '8', '533', 'tifez@mailinator.com', NULL, 'Dean Mullen', NULL, NULL, NULL, 'Anika Rodriquez', NULL, NULL, NULL, NULL, NULL, NULL, 'Wynter Short', 'Natus molestias quam', 'Quod incididunt quae', 'Dolores dolore eu fu', 'Adipisicing sit quia', 'Consectetur est in', 'Dolores dolore eu fu', 'Adipisicing sit quia', 'Consectetur est in', 'Non aute est ut sit', NULL, 'Finn Park', 'Aute sed rerum esse', 'Malcolm Conrad', 'Iure sit in vel exe', 'In sed velit nisi ul', 'molon@mailinator.com', '0000-00-00', 'Exercitationem itaqu', '+1 (443) 305-9913', 'Et nostrum magni eos', 'Quis tempor sequi de', 'Error exercitation e', 1, 'puwynes@mailinator.com', '6', '29', '477', '6', '29', '477', 'Aliqua Magna aut mi', '1', 'Fair', '$2y$10$4YJ/d/Pu0YAp/s5Ad2pr/OiUVqkAEYdIvWF3hrXoEfwHf9EPjORru', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 10:52:05', '2020-12-07 10:52:05'),
(83, 1, 25, 10, 5, 2020169, NULL, NULL, 'Aretha Suarez', 2, 4, '0000-00-00', '6', '322', 'veka@mailinator.com', NULL, 'Skyler Guzman', NULL, NULL, NULL, 'Illiana Rios', NULL, NULL, NULL, NULL, NULL, NULL, 'Brady Dorsey', 'Consequatur blanditi', 'Voluptatem qui sed s', 'Esse sint aut quo di', 'Eos eos sapiente ma', 'A ab eum ipsum sunt', 'Esse sint aut quo di', 'Eos eos sapiente ma', 'A ab eum ipsum sunt', 'Irure atque et perfe', NULL, 'Hayfa Morton', 'Delectus ut eaque i', 'Shannon Kent', 'Unde ipsa non eum d', 'Iure laboris iusto m', 'wucyvyril@mailinator.com', '0000-00-00', 'Corporis sed laborum', '+1 (632) 969-9689', 'Voluptatem Voluptat', 'Blanditiis fugiat u', 'Fugiat consequatur', 2, 'nesaq@mailinator.com', '3', '19', '197', '3', '19', '197', 'Aliquid a reprehende', '1', NULL, '$2y$10$ubl.8eSLvteYqIkx6Sw3luaugqS2cJksvjwJrdbwfsERFzhQweKRO', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 11:23:34', '2020-12-19 07:44:54'),
(84, 1, 25, 10, 5, 2020170, NULL, NULL, 'Unity Spears', 1, 4, '2011-02-08', '2', '498', 'vywe@mailinator.com', NULL, 'Thor Buckner', NULL, NULL, NULL, 'Lysandra Mcdonald', NULL, NULL, NULL, NULL, NULL, NULL, 'Alan Tyson', 'Aperiam et error mod', 'Deserunt vero sequi', 'Ullam lorem aut volu', 'Voluptatem consectet', 'Libero enim excepteu', 'Ullam lorem aut volu', 'Voluptatem consectet', 'Libero enim excepteu', 'Elit dolore nihil v', NULL, 'Audra Cooke', 'Anim velit voluptate', 'Melodie Shepherd', 'Atque aliquam in lib', 'Sed nihil labore cil', 'mudewygut@mailinator.com', '1974-07-02', 'Ea enim voluptas con', '+1 (582) 305-8322', 'Omnis laboris quia q', 'Enim pariatur Nisi', 'Temporibus amet dol', 1, 'jivuxe@mailinator.com', '7', '61', '367', '7', '61', '367', 'Inventore iusto a om', '1', 'Nill', '$2y$10$BaDDOv143CJrF1yLtI9mAuqmtCfq4YhhQmE0eI8b5alrBld4QPtDm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 11:29:44', '2020-12-07 11:29:44'),
(85, 1, 25, 10, 5, 2020171, NULL, NULL, 'Unity Spears', 1, 4, '2011-08-02', '2', '498', 'vywe@mailinator.com', NULL, 'Thor Buckner', NULL, NULL, NULL, 'Lysandra Mcdonald', NULL, NULL, NULL, NULL, NULL, NULL, 'Alan Tyson', 'Aperiam et error mod', 'Deserunt vero sequi', 'Ullam lorem aut volu', 'Voluptatem consectet', 'Libero enim excepteu', 'Ullam lorem aut volu', 'Voluptatem consectet', 'Libero enim excepteu', 'Elit dolore nihil v', NULL, 'Audra Cooke', 'Anim velit voluptate', 'Melodie Shepherd', 'Atque aliquam in lib', 'Sed nihil labore cil', 'mudewygut@mailinator.com', '1974-02-07', 'Ea enim voluptas con', '+1 (582) 305-8322', 'Omnis laboris quia q', 'Enim pariatur Nisi', 'Temporibus amet dol', 1, 'jivuxe@mailinator.com', '7', '61', '367', '7', '61', '367', 'Inventore iusto a om', '1', 'Nill', '$2y$10$NFBCRugb87esjIHnEQl7cOjKn8EOy2zmpMOge8vCAAzl.VCQqkRRG', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 11:54:03', '2020-12-07 11:54:03'),
(86, 1, 25, 10, 5, 2020172, NULL, NULL, 'Indigo Bradford', 1, 4, '1986-10-12', '6', '163', 'beqovijusi@mailinator.com', NULL, 'Demetrius Ford', NULL, NULL, NULL, 'Buckminster Beach', NULL, NULL, NULL, NULL, NULL, NULL, 'Virginia Lindsey', 'Sint vitae cupidata', 'Distinctio Dignissi', 'Voluptatum necessita', 'Eiusmod quae nisi ni', 'Enim dolores corrupt', 'Voluptatum necessita', 'Eiusmod quae nisi ni', 'Enim dolores corrupt', 'Aliquip veniam eum', NULL, 'Alexander Jordan', 'Exercitation aut sim', 'Shelby Brooks', 'Atque cupiditate in', 'Mollitia maiores fug', 'neryda@mailinator.com', '0000-00-00', 'Qui qui corrupti vo', '+1 (619) 453-9397', 'Obcaecati fugiat ea', 'Explicabo Eius arch', 'Ab sequi dolor asper', 2, 'jyvazuj@mailinator.com', '6', '32', '487', '6', '32', '487', 'Ad rerum ea ea fugia', '1', 'Poor', '$2y$10$ys5nHc5VZNSiOA5y74U5H.7iS.9lrr3XPnyL8OSQhEMEdJyDfAHOS', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 12:04:37', '2020-12-07 12:04:37'),
(87, 1, 25, 10, 5, 2020173, NULL, NULL, 'Alvin Shaffer', 1, 5, '0000-00-00', '1', '569', 'seqi@mailinator.com', NULL, 'Aretha Padilla', NULL, NULL, NULL, 'Chava Maynard', NULL, NULL, NULL, NULL, NULL, NULL, 'Amy Wade', 'Dolore exercitation', 'Ut cumque fugiat inc', 'Nostrum provident v', 'Voluptate sit volupt', 'Fugiat mollitia exe', 'Nostrum provident v', 'Voluptate sit volupt', 'Fugiat mollitia exe', 'Repudiandae expedita', NULL, 'Isaiah Odom', 'Velit exercitation m', 'Christen Small', 'Ducimus error tempo', 'Qui eaque minus et d', 'kogovacij@mailinator.com', '0000-00-00', 'Accusantium velit u', '+1 (387) 776-3664', 'Maxime reprehenderit', 'Dolorem nesciunt iu', 'Corrupti sit cillu', 2, 'seruwevipi@mailinator.com', '5', '43', '418', '5', '43', '418', 'Quis id fuga Culpa', '1', 'Nill', '$2y$10$Jp.AlZuVUFWp71PGPZMk8ePSQn.GV/0MeexrjOBJqscZOykkcJstW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 12:11:06', '2020-12-07 12:11:06'),
(88, 1, 25, 10, 5, 2020174, NULL, NULL, 'Hillary Cannon', 2, 5, '0000-00-00', '7', '567', 'juki@mailinator.com', NULL, 'Illiana Mccarthy', NULL, NULL, NULL, 'Levi Whitaker', NULL, NULL, NULL, NULL, NULL, NULL, 'Diana Finley', 'Vitae sed eum ex ea', 'Enim a obcaecati odi', 'Facilis quas qui mol', 'Nostrud recusandae', 'Voluptatibus aliquid', 'Facilis quas qui mol', 'Nostrud recusandae', 'Voluptatibus aliquid', 'Necessitatibus volup', NULL, 'Tyler Bass', 'Rerum quos qui disti', 'Uta Callahan', 'Ad eius ex commodi n', 'Suscipit aperiam acc', 'sogicukymu@mailinator.com', '0000-00-00', 'Minus ea minus incid', '+1 (891) 828-6786', 'Aliquip amet eos e', 'A omnis eligendi sol', 'Deleniti eaque volup', 1, 'wykafan@mailinator.com', '7', '61', '370', '7', '61', '370', 'Sequi ut sint minus', '1', 'Nill', '$2y$10$T8L4nBupd5yZXD0CyvkIL.d7aXujykOW3/VIXawNkZmYaHe5PwjuW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-07 12:22:47', '2020-12-07 12:22:47'),
(89, 1, 25, 10, 5, 2020175, NULL, NULL, 'Dawn Morris', 2, 4, '0000-00-00', '3', '21', 'jyfi@mailinator.com', NULL, 'Hedwig Lane', NULL, NULL, NULL, 'Carol Wilkerson', NULL, NULL, NULL, NULL, NULL, NULL, 'Burke Pope', 'Voluptatem error pra', 'Modi in iste molesti', 'Non delectus culpa', 'Vel nisi in aspernat', 'Ducimus omnis qui o', 'Non delectus culpa', 'Vel nisi in aspernat', 'Ducimus omnis qui o', 'Voluptas perferendis', NULL, 'Bevis Harmon', 'Non iure mollit cupi', 'Timon Estes', 'Possimus qui aliqui', 'Asperiores ea odio q', 'vazazy@mailinator.com', '1993-05-11', 'Esse earum adipisci', '+1 (325) 186-7611', 'Voluptatibus sed ea', 'Sit quibusdam nemo N', 'Rerum omnis pariatur', 2, 'zysyfo@mailinator.com', '4', '25', '316', '4', '25', '316', 'Quam quia id duis an', '1', 'Good', '$2y$10$VOlawErl0EEeNwR3ehiwwOxGMO6V5nIH5yGdpjazF9ocGA0Rodv52', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 04:24:36', '2020-12-08 04:24:36'),
(90, 1, 25, 10, 5, 2020176, NULL, NULL, 'Macey Williamson', 3, 5, '1981-01-12', '4', '519', 'baxibeto@mailinator.com', NULL, 'Meredith Russell', NULL, NULL, NULL, 'Kieran Barnett', NULL, NULL, NULL, NULL, NULL, NULL, 'September Bowers', 'Molestias quia vel q', 'Sed dicta earum in e', 'Voluptas inventore e', 'Numquam velit labore', 'Quos sed ut tempora', 'Voluptas inventore e', 'Numquam velit labore', 'Quos sed ut tempora', 'Ex velit expedita do', NULL, 'Kevin Joyner', 'Neque magna quia min', 'Raya Luna', 'Unde labore libero s', 'Ad quidem laboris sa', 'dusipotapa@mailinator.com', '1996-09-12', 'Temporibus non iste', '+1 (423) 681-8739', 'Obcaecati quo aut et', 'Nam voluptatum sed i', 'Reprehenderit sit q', 1, 'hyreza@mailinator.com', '1', '4', '123', '1', '4', '123', 'Maxime vitae mollit', '1', 'Poor', '$2y$10$vWHSEx6qC.tD1A2.Cw54xui9jpWC3KGk2ZHNfhSFWSZ9HtHA9KRma', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 04:28:24', '2020-12-08 04:28:24'),
(91, 1, 25, 10, 5, 2020177, NULL, NULL, 'Olivia Mccray', 2, 5, '0000-00-00', '6', '824', 'wibaxevori@mailinator.com', NULL, 'Mason Vazquez', NULL, NULL, NULL, 'Tobias Peck', NULL, NULL, NULL, NULL, NULL, NULL, 'Fuller Valencia', 'Ut quis cupidatat et', 'Incididunt repellend', 'Deserunt quasi in qu', 'Qui consequatur nos', 'Eligendi occaecat ut', 'Deserunt quasi in qu', 'Qui consequatur nos', 'Eligendi occaecat ut', 'Est officia ut deser', NULL, 'Hakeem Torres', 'Autem natus necessit', 'Marsden Sanders', 'Omnis consequat Ad', 'Ducimus in dolores', 'pewas@mailinator.com', '2005-04-07', 'Voluptatem dicta eos', '+1 (993) 193-7036', 'Dolores aut odit pla', 'Commodo id vero tem', 'Natus dicta molestia', 2, 'zicocade@mailinator.com', '6', '29', '481', '6', '29', '481', 'Necessitatibus neque', '1', 'Fair', '$2y$10$f54PdR1jFO.2lsitKliL8uwxAY.UJSrrbvU23Gw1.cE1UmSJIdDuC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 04:35:07', '2020-12-08 04:35:07'),
(92, 1, 25, 10, 5, 2020178, NULL, NULL, 'Omar Moore', 1, 1, '0000-00-00', '6', '84', 'tyla@mailinator.com', NULL, 'Sierra Leach', NULL, NULL, NULL, 'Hammett Hatfield', NULL, NULL, NULL, NULL, NULL, NULL, 'Ronan Wagner', 'Est aut quos quia sa', 'Aut veritatis omnis', 'Ut ipsum quia non ve', 'Molestiae ipsa ad n', 'Eum sunt fugiat non', 'Ut ipsum quia non ve', 'Molestiae ipsa ad n', 'Eum sunt fugiat non', 'Quia quae est impedi', NULL, 'Aurora Olson', 'Ducimus non vero id', 'Reese Monroe', 'Mollit qui unde prov', 'Aute dolor veniam l', 'qijiwi@mailinator.com', '0000-00-00', 'Fugiat molestias to', '+1 (818) 362-5141', 'Accusamus aliquid te', 'Distinctio Ducimus', 'Qui ut eiusmod quas', 1, 'secasago@mailinator.com', '2', '5', '14', '2', '5', '14', 'Alias voluptas incid', '1', 'Nill', '$2y$10$.937kunI/howdpeoR37lJOCbQDvsTTzLIurkO78W2XFJBdTEsHp8i', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 04:36:57', '2020-12-08 04:36:57'),
(93, 1, 25, 10, 5, 2020179, NULL, NULL, 'Lacota Hanson', 1, 1, '1990-11-12', '3', '122', 'ziranuny@mailinator.com', NULL, 'Savannah Fuentes', NULL, NULL, NULL, 'Briar Valenzuela', NULL, NULL, NULL, NULL, NULL, NULL, 'Leslie Barron', 'Eligendi laboris par', 'Consectetur asperior', 'Excepteur corporis d', 'Perferendis culpa v', 'Eum aut perspiciatis', 'Excepteur corporis d', 'Perferendis culpa v', 'Eum aut perspiciatis', 'Esse sed perspiciati', NULL, 'Carter Newman', 'Ducimus amet nobis', 'Penelope Murray', 'Reiciendis non labor', 'Eos recusandae Qui', 'ramu@mailinator.com', '0000-00-00', 'Qui quibusdam itaque', '+1 (261) 305-2535', 'Exercitationem in de', 'Dolorem numquam sunt', 'Consequatur Deserun', 1, 'xelodurak@mailinator.com', '3', '19', '197', '3', '19', '197', 'Quis aut anim sed ex', '1', 'Fair', '$2y$10$znv2GQFFQdAQMuM4C.18Xe5BIsl/2TDihxoweCkaNu4.HC6SF3CkW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 05:00:26', '2020-12-08 05:00:26'),
(94, 1, 25, 10, 5, 2020180, NULL, NULL, 'ccsasxasxax', 1, 1, '2020-12-09', '2', '04256353533', 'dshhghb@gmail.com', NULL, 'ergtrgggrg', NULL, NULL, NULL, 'dasdadadadadda', NULL, NULL, NULL, NULL, NULL, NULL, 'dddadd', NULL, 'dadadadadacscfwef', 'fffcsdsca', 'DSS', '535555', 'fffcsdsca', 'DSS', '535555', '424442', NULL, 'ssaxsxasxasx', 'sccc', 'dadadadadadadadda', 'ddddwdd', NULL, 'dshhghb@gmail.com', '1970-01-01', NULL, '066230', 'ddddd', 'dddwdwdwd', 'sccac', 1, 'dshhghb@gmail.com', '6', '56', '507', '6', '56', '507', 'sxasxaxasxx', '1', 'Poor', '$2y$10$ECK4b/yrZnYpS9zgzEWIh.KTfI5EMZCoeGDRFVrlob4e3dQ7dK0pK', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 05:35:56', '2020-12-08 05:35:56'),
(95, 1, 25, 10, 5, 2020181, NULL, NULL, 'xcfgthyju', 2, 1, '1970-01-01', '5', '53356..', 'adasdfg@gmail.com', NULL, '404045', NULL, NULL, NULL, 'bv', NULL, NULL, NULL, NULL, NULL, NULL, 'sfsfs', '45888', 'dsdfg', 'sdg', 'dwerg', '85', 'sdg', 'dwerg', '85', '5876345', NULL, 'gregegg', 'cdgthyju', 'dffff', 'thttr', '..4444', 'adasdfg@gmail.com', '1970-01-01', '4454..45.', '.4.45.4..', 'frgthtrh', 'tgtgtg', 'hgk', 1, 'adasdfg@gmail.com', '2', '31', '38', '2', '31', '38', 'gergergegeg', '1', 'Good', '$2y$10$kXCCnzi9gfzxZW.ksIaw1OGuj7bZsDivVvd2FkuRdyO36JpNzDY4m', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 05:44:44', '2020-12-08 05:44:44'),
(96, 1, 25, 10, 5, 2020182, NULL, NULL, 'fgfgfg', 1, 1, '1970-01-01', '1', '56565', 'ad@gmail.com', NULL, 'fgfgf', NULL, NULL, NULL, 'fgfgf', NULL, NULL, NULL, NULL, NULL, NULL, 'ghgh', 'fgfgf', 'fgfg', 'fgfgf', 'fgfgfg', '56565', 'fgfgf', 'fgfgfg', '56565', 'fgfgf', NULL, 'fgfg', 'ffgf', 'fgfgfg', 'fgfgfg', 'fgfgf', 'rt@gmail.com', '1970-01-01', 'fgfgfg', '78787', 'fgfgf', 'fgfgf', 'fgfg', 1, 'hj@gmail.com', '3', '13', '155', '3', '13', '155', 'fgfgf', '1', 'Good', '$2y$10$0ZQxwWvBUI0NGLJhWE5CJ.YFs3.mwRLchanLJPfBWciiFdW3Qvfeq', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 05:54:02', '2020-12-08 05:54:02'),
(97, 1, 25, 10, 5, 2020183, NULL, NULL, 'ghjj', 1, 1, '1970-01-01', '4', '56565', 'dfg@gmail.com', NULL, 'ghghg', NULL, NULL, NULL, 'ghghgh', NULL, NULL, NULL, NULL, NULL, NULL, 'ghghgh', '66565', 'ghghgh', 'ghgh', 'ghggh', '56', 'ghgh', 'ghggh', '56', 'fgfg', NULL, 'fgg', 'ghhh', 'ghghgh', 'hghgh', 'ghgh', 'rtyyu@gmail.com', '1970-01-01', 'ghgh', 'ghgh', 'ghgh', 'ghghg', 'ghghgh', 1, 'tyu@gmail.com', '1', '3', '116', '1', '3', '116', 'fggg', '1', 'Good', '$2y$10$bNO5FNyCRuvnQ.TUTggecuoQX.yglPtorS5kSc99frRT7NeghBrNy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 06:13:41', '2020-12-08 06:13:41'),
(98, 1, 25, 10, 5, 2020184, NULL, NULL, 'Angelica Roach', 1, 5, '0000-00-00', '8', '374', 'lywyzu@mailinator.com', NULL, 'Buckminster Evans', NULL, NULL, NULL, 'Nina Thompson', NULL, NULL, NULL, NULL, NULL, NULL, 'Samuel Alvarado', 'Et nulla rerum ex pa', 'Deserunt veniam in', 'Irure incididunt mol', 'Qui autem fugiat ei', 'Aute in atque reicie', 'Irure incididunt mol', 'Qui autem fugiat ei', 'Aute in atque reicie', 'Architecto ut non vo', NULL, 'Reagan Faulkner', 'Illo voluptatibus no', 'Jana Welch', 'Harum tempor delectu', 'Deleniti vitae in de', 'ricubizen@mailinator.com', '0000-00-00', 'Delectus corrupti', '+1 (276) 657-2614', 'Molestiae ex magni v', 'Non in in aliquip ul', 'A sit consequuntur', 2, 'nujyzi@mailinator.com', '2', '8', '52', '2', '8', '52', 'Hic assumenda ut ani', '1', 'Good', '$2y$10$6s35p.EMA0BZ3ibreMRfeumMVoet0MUN.UKr1B9BC82sv05INriS2', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 06:16:51', '2020-12-08 06:16:51'),
(99, 1, 25, 10, 5, 2020185, NULL, NULL, 'refgthy', 2, 1, '1970-01-01', '3', '054387878786', 'zsdfgthyjukil@gmail.com', NULL, 'fefefvefef', NULL, NULL, NULL, 'zassg', NULL, NULL, NULL, NULL, NULL, NULL, 'dfghjukjhgdf', '787824866268', 'fscffsdscff', 'scsffsfsf', 'xccx zxdc', '886868686', 'scsffsfsf', 'xccx zxdc', '886868686', '57868686786', NULL, 'Xxaxx', 'zazzZAz', 'xsxasascc', 'xsaxsaxas', '2686868686', 'zsdfgthyjukil@gmail.com', '1970-01-01', '22822868', '688678637867', 'xfgthyjdf', 'addxasddasd', 'zaZZA', 1, 'zsdfgthyjukil@gmail.com', '5', '44', '424', '5', '44', '424', 'axaxasxasx', '1', 'Good', '$2y$10$2DPcCwdt4EZSM./p.Lg16.vjKVGfTHdLm/zC5XRSW1YDHs.DeYWqu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 06:56:18', '2020-12-08 06:56:18'),
(100, 1, 25, 10, 5, 2020186, NULL, NULL, 'Nathan Boyd', 3, 2, '1975-07-06', '5', '853', 'tabikeh@mailinator.com', NULL, 'Stella Simon', NULL, NULL, NULL, 'Aristotle Combs', NULL, NULL, NULL, NULL, NULL, NULL, 'Mollie Baker', 'Eligendi est offici', 'Labore et autem ea c', 'Explicabo Obcaecati', 'Soluta enim unde aut', 'Et pariatur Est ut', 'Explicabo Obcaecati', 'Soluta enim unde aut', 'Et pariatur Est ut', 'Fugiat rem magni et', NULL, 'Lance Davenport', 'Quae ad placeat do', 'Ella Thompson', 'Voluptatem sed volup', 'Ut sapiente occaecat', 'cehonol@mailinator.com', '0000-00-00', 'In tempora ipsam ali', '+1 (707) 534-1747', 'Exercitationem excep', 'Eveniet qui et dolo', 'Ut elit voluptas su', 2, 'hugigyqo@mailinator.com', '3', '42', '255', '3', '42', '255', 'Eius animi aute qui', '1', 'Nill', '$2y$10$igJwhxDaqrwL7ceV6v7AfezkADI/hqjPTG9H74GISPOo7pjn6GULC', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:00:32', '2020-12-08 07:00:32'),
(101, 1, 25, 10, 5, 2020187, NULL, NULL, 'crrvv vvv tvtvtvtv', 1, 3, '1970-01-01', '6', '58882882', 'gtgyygygg@gmail.com', NULL, 'dcfvbghngfd', NULL, NULL, NULL, 'dcfvgbhbf', NULL, NULL, NULL, NULL, NULL, NULL, 'ffbbhthbhr', '268626666', 'fvefervfv', 'vdfvdfv dfvdf', 'fddd', '2787868686', 'vdfvdfv dfvdf', 'fddd', '2787868686', '868686', NULL, 'rewqweewrrfw', 'gvtv', 'xscdfvdsc', 'scffef', '572785278527', 'sddfgffc@gmail.com', '1970-01-01', '5852727', '82686868', 'frethht', 'fffeff', 'rrrgrgrg', 1, 'dfgbjj@gmail.com', '5', '44', '423', '5', '44', '423', 'fwefwefewfewf', '1', 'Good', '$2y$10$lgfEDMLyL1y7W9DcZg1kw.3b8O/jB3GP896nD6y.ShfRD8BCfCpdW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:05:32', '2020-12-08 07:05:32'),
(102, 1, 25, 10, 5, 2020188, NULL, NULL, 'dfdf', 1, 1, '1970-01-01', '1', '3434', 'rt@gmail.com', NULL, 'fdfdf', NULL, NULL, NULL, 'dfdfd', NULL, NULL, NULL, NULL, NULL, NULL, 'fgfgfg', 'fgfgf', 'fgfg', 'fgfg', 'fgfg', '454', 'fgfg', 'fgfg', '454', 'dfdf', NULL, 'dfdf', 'dfdf', 'dfdf', 'fgfgf', '545454', 'er@gmail.com', '1970-01-01', 'dfdfdf', '4545', 'fgfg', 'fgfg', 'dfdfdf', 1, 'kj@gmail.com', '4', '30', '332', '4', '30', '332', 'dfdf', '1', 'Good', '$2y$10$FAX8g9NXO8AaSdhJ/ASHT.gniRoNv.loOJCjsTVs4A6ImLgqqDVL6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:22:58', '2020-12-08 07:22:58'),
(103, 1, 25, 10, 5, 2020189, NULL, NULL, 'Stephen Johnson', 1, 4, '0000-00-00', '4', '391', 'cymu@mailinator.com', NULL, 'Alden Baird', NULL, NULL, NULL, 'Forrest Lewis', NULL, NULL, NULL, NULL, NULL, NULL, 'Imelda Nash', 'Obcaecati nisi praes', 'Pariatur Quia qui s', 'Vel deleniti repelle', 'Ut rem earum exercit', 'Ad velit quas qui om', 'Vel deleniti repelle', 'Ut rem earum exercit', 'Ad velit quas qui om', 'Amet ratione ad mol', NULL, 'Keelie Murphy', 'Debitis numquam cons', 'Chava Rosa', 'Accusamus ut nulla f', 'Nostrud rerum error', 'dazo@mailinator.com', '0000-00-00', 'Harum tempore ut Na', '+1 (112) 705-4326', 'Qui ut in minim iust', 'Mollit doloremque in', 'Dolorum consectetur', 2, 'vecyzy@mailinator.com', '3', '58', '274', '3', '58', '274', 'Minim aspernatur in', '1', 'Fair', '$2y$10$JQwxCcSWUexFDxLGGjGzHOD1rKKHxb5gWr6ikzZj3TbsSTo4kcVey', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:39:39', '2020-12-08 07:39:39'),
(104, 1, 25, 10, 5, 2020190, NULL, NULL, 'sdfgh', 1, 4, '1970-01-01', '5', '86268868', 'cdcdcsd@gmail.com', NULL, 'asxxaxxsa', NULL, NULL, NULL, 'asxxaxa', NULL, NULL, NULL, NULL, NULL, NULL, 'csdfvdgdg', '2686868', 'gvddsds', 'scccsdcds', 'vdfvdd', '578785785', 'scccsdcds', 'vdfvdd', '578785785', '98645668', NULL, 'swertyui', 'sddsadda', 'asxsaxsx', 'asddasda', '8266888', 'sdsdd@gmail.com', '1970-01-01', '226868', '68368686', 'ddaddasd', 'adadsad', 'dasddasdda', 1, 'csfsdfs@gmail.com', '5', '54', '442', '5', '54', '442', 'ttyjukjh', '1', 'Good', '$2y$10$FZW5wbDUYNY77tfZZBPb0uGhUc7DU5VX1rZDlKBnNzT8bEVRvzI3.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:43:10', '2020-12-08 07:43:10'),
(105, 1, 25, 10, 5, 2020191, NULL, NULL, 'sdfgh', 1, 4, '1970-01-01', '5', '86268868', 'cdcdcsd@gmail.com', NULL, 'asxxaxxsa', NULL, NULL, NULL, 'asxxaxa', NULL, NULL, NULL, NULL, NULL, NULL, 'csdfvdgdg', '2686868', 'gvddsds', 'scccsdcds', 'vdfvdd', '578785785', 'scccsdcds', 'vdfvdd', '578785785', '98645668', NULL, 'swertyui', 'sddsadda', 'asxsaxsx', 'asddasda', '8266888', 'sdsdd@gmail.com', '1970-01-01', '226868', '68368686', 'ddaddasd', 'adadsad', 'dasddasdda', 1, 'csfsdfs@gmail.com', '5', '54', '442', '5', '54', '442', 'ttyjukjh', '1', 'Good', '$2y$10$pm/LwAI8INzmObi8M.DZWu6Gr1kyRiZndbwRtmPUBZ1gHvIRysE5C', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:56:55', '2020-12-08 07:56:55'),
(106, 1, 25, 10, 5, 2020192, NULL, NULL, 'sdfgh', 1, 4, '1970-01-01', '5', '86268868', 'cdcdcsd@gmail.com', NULL, 'asxxaxxsa', NULL, NULL, NULL, 'asxxaxa', NULL, NULL, NULL, NULL, NULL, NULL, 'csdfvdgdg', '2686868', 'gvddsds', 'scccsdcds', 'vdfvdd', '578785785', 'scccsdcds', 'vdfvdd', '578785785', '98645668', NULL, 'swertyui', 'sddsadda', 'asxsaxsx', 'asddasda', '8266888', 'sdsdd@gmail.com', '1970-01-01', '226868', '68368686', 'ddaddasd', 'adadsad', 'dasddasdda', 1, 'csfsdfs@gmail.com', '5', '54', '442', '5', '54', '442', 'ttyjukjh', '1', 'Good', '$2y$10$ADVKqwE78j2fJRBzadISXue1PwAfCtCG2F6yCRciGfGrIrYG3wODu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 07:57:32', '2020-12-08 07:57:32'),
(107, 1, 25, 10, 5, 2020193, NULL, NULL, 'Priscilla Phelps', 2, 5, '1974-11-09', '8', '567', 'juhemig@mailinator.com', NULL, 'Paloma Sims', NULL, NULL, NULL, 'Avye Carey', NULL, NULL, NULL, NULL, NULL, NULL, 'Veda Hobbs', 'Quasi et voluptatem', 'Sit ullam harum cor', 'Explicabo Nihil nec', 'Eiusmod deserunt dol', 'Molestias occaecat r', 'Explicabo Nihil nec', 'Eiusmod deserunt dol', 'Molestias occaecat r', 'Optio totam quasi n', NULL, 'Cheyenne Rodgers', 'Voluptas aut sit hi', 'Samantha Norman', 'Anim eligendi ipsam', 'Ex quis sed repellen', 'hoti@mailinator.com', '2019-10-10', 'Dolorum facere velit', '+1 (369) 911-7307', 'Illum quo facilis e', 'Et enim commodi expl', 'Deleniti velit reru', 2, 'libozowym@mailinator.com', '6', '29', '478', '6', '29', '478', 'Elit fugiat accusan', '1', 'Good', '$2y$10$/IAKAaSg5B2VEqJ85KI9z.OGyc8W0n.L5Zw06iJuCkjqRIpkhxOPW', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 08:03:05', '2020-12-08 08:03:05'),
(108, 1, 25, 10, 5, 2020194, NULL, NULL, 'Beatrice Coffey', 3, 1, '0000-00-00', '7', '610', 'tozag@mailinator.com', NULL, 'Hedwig Kelly', NULL, NULL, NULL, 'Reagan Foreman', NULL, NULL, NULL, NULL, NULL, NULL, 'Deborah Dorsey', 'Incidunt sequi quia', 'Quisquam dignissimos', 'Quidem sint eveniet', 'Eos quam laborum Qu', 'Eius fugit et ipsa', 'Quidem sint eveniet', 'Eos quam laborum Qu', 'Eius fugit et ipsa', 'Magni sint exercitat', NULL, 'Calista Best', 'In et voluptatem Na', 'Leila Nichols', 'Temporibus amet qua', 'Commodi dolorem labo', 'jaligug@mailinator.com', '0000-00-00', 'Pariatur Aliquam Na', '+1 (651) 128-3409', 'Sequi voluptatem est', 'Quos animi eos solu', 'Et aut quis ex est e', 1, 'qenit@mailinator.com', '2', '5', '14', '2', '5', '14', 'Fugit enim sit id', '1', 'Poor', '$2y$10$5tFR1uzDB06bXiuCtmUmNeFAlEmc4yFxZb.rxEHT2bpNCLIcdzAa.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 08:11:25', '2020-12-08 08:11:25'),
(109, 1, 25, 10, 5, 2020195, NULL, NULL, 'Simone Mccormick', 2, 4, '0000-00-00', '7', '401', 'seni@mailinator.com', NULL, 'Violet Wilcox', NULL, NULL, NULL, 'Curran Neal', NULL, NULL, NULL, NULL, NULL, NULL, 'Cedric Vang', 'Excepturi quas venia', 'Lorem Nam et aut omn', 'Dolor aut nesciunt', 'Incididunt quibusdam', 'Non obcaecati irure', 'Dolor aut nesciunt', 'Incididunt quibusdam', 'Non obcaecati irure', 'Odio quis autem anim', NULL, 'Geraldine Reynolds', 'Ea quaerat ut dolore', 'Gray Hays', 'Quo consequatur dol', 'Aperiam quia sint h', 'jydihywe@mailinator.com', '0000-00-00', 'Est reprehenderit e', '+1 (307) 888-1107', 'Eum dolores harum es', 'Reprehenderit quia', 'Cupiditate soluta ex', 2, 'vukub@mailinator.com', '4', '27', '327', '4', '27', '327', 'Sequi minim sunt acc', '1', 'Nill', '$2y$10$nsStUkaE1UH86D3RHJZeCuyLKzhjFzEOzTb3WteYL0b9U5A41XigK', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 08:15:46', '2020-12-08 08:15:46'),
(110, 1, 25, 10, 5, 2020196, NULL, NULL, 'Merrill Church', 1, 1, '0000-00-00', '2', '70', 'mubasasyq@mailinator.com', NULL, 'Stephen Harris', NULL, NULL, NULL, 'Ross Bruce', NULL, NULL, NULL, NULL, NULL, NULL, 'Faith Schneider', 'Nobis omnis irure it', 'Quae dolor asperiore', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Quasi eum magnam rer', NULL, 'Cooper Beach', 'Exercitationem velit', 'Ethan Huffman', 'Aute sed laboriosam', 'Eos et deserunt offi', 'cixysebo@mailinator.com', '0000-00-00', 'Illo vitae doloribus', '+1 (774) 373-1642', 'Omnis vel in est do', 'Eligendi deleniti te', 'Quia at doloremque m', 2, 'vasozo@mailinator.com', '1', '4', '126', '1', '4', '126', 'Earum dolore harum s', '1', 'Fair', '$2y$10$NUCGGLjnhGz25LChU28XUuUHcY4.BDJ.jc72NebN1nNcr0keiCK5C', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 08:44:45', '2020-12-08 08:44:45'),
(111, 1, 25, 10, 5, 2020197, NULL, NULL, 'Merrill Church', 1, 1, '1970-01-01', '2', '70', 'mubasasyq@mailinator.com', NULL, 'Stephen Harris', NULL, NULL, NULL, 'Ross Bruce', NULL, NULL, NULL, NULL, NULL, NULL, 'Faith Schneider', 'Nobis omnis irure it', 'Quae dolor asperiore', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Quasi eum magnam rer', NULL, 'Cooper Beach', 'Exercitationem velit', 'Ethan Huffman', 'Aute sed laboriosam', 'Eos et deserunt offi', 'cixysebo@mailinator.com', '1970-01-01', 'Illo vitae doloribus', '+1 (774) 373-1642', 'Omnis vel in est do', 'Eligendi deleniti te', 'Quia at doloremque m', 2, 'vasozo@mailinator.com', '1', '4', '126', '1', '4', '126', 'Earum dolore harum s', '1', NULL, '$2y$10$uHxkdzEprRsAyEtkDKX7geWkkj.Ye4.knezq.qNxhpBzRah.0.JGi', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 08:52:29', '2020-12-08 11:00:16'),
(112, 1, 25, 10, 5, 2020198, NULL, NULL, 'Merrill Church', 1, 1, '1970-01-01', '2', '70', 'mubasasyq@mailinator.com', NULL, 'Stephen Harris', NULL, NULL, NULL, 'Ross Bruce', NULL, NULL, NULL, NULL, NULL, NULL, 'Faith Schneider', 'Nobis omnis irure it', 'Quae dolor asperiore', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Minima atque qui ut', 'Possimus vel facili', 'Accusantium modi exp', 'Quasi eum magnam rer', NULL, 'Cooper Beach', 'Exercitationem velit', 'Ethan Huffman', 'Aute sed laboriosam', 'Eos et deserunt offi', 'cixysebo@mailinator.com', '1970-01-01', 'Illo vitae doloribus', '+1 (774) 373-1642', 'Omnis vel in est do', 'Eligendi deleniti te', 'Quia at doloremque m', 2, 'vasozo@mailinator.com', '1', '4', '126', '1', '4', '126', 'Earum dolore harum s', '1', NULL, '$2y$10$YUD0gsjgV5hpF8.YfKS9peeIm1dWMM6.lnRhA.FwDWeUNJbYECz0O', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-08 09:02:52', '2020-12-08 10:57:51'),
(113, 1, 25, 10, 5, 2020199, NULL, NULL, 'Jackson Duran', 3, 1, '2014-06-11', '8', '956', 'xoha@mailinator.com', NULL, 'Gretchen Santiago', NULL, NULL, NULL, 'Lionel Mcguire', NULL, NULL, NULL, NULL, NULL, NULL, 'Carl Velazquez', 'Elit odio nostrud n', 'Ipsam elit dolorum', 'Eiusmod nisi fugiat', 'Vitae amet aute con', 'Ex in sint quam sun', 'Eiusmod nisi fugiat', 'Vitae amet aute con', 'Ex in sint quam sun', 'Maxime sed eaque ali', NULL, 'Hadley Carlson', 'Minus quis est culpa', 'Shoshana Villarreal', 'Occaecat nesciunt o', 'Nihil aut nostrud iu', 'copyjajo@mailinator.com', '2009-04-12', 'Illo voluptates aliq', '+1 (871) 926-3438', 'Vel repudiandae aut', 'Consequatur officia', 'Sit tempora omnis qu', 1, 'fozisog@mailinator.com', '2', '16', '94', '2', '16', '94', 'Ut officia dolorum c', '1', 'Good', '$2y$10$KL9NigWZ/Jp4vdeKwc8w.O1Q.ZRq7G/DLb7ny93ASrSXpYq4t2nM.', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-09 11:57:59', '2020-12-09 11:57:59'),
(114, 1, 25, 10, 5, 2020200, NULL, NULL, 'Jackson Duran', 3, 1, '2014-11-06', '8', '956', 'xoha@mailinator.com', NULL, 'Gretchen Santiago', NULL, NULL, NULL, 'Lionel Mcguire', NULL, NULL, NULL, NULL, NULL, NULL, 'Carl Velazquez', 'Elit odio nostrud n', 'Ipsam elit dolorum', 'Eiusmod nisi fugiat', 'Vitae amet aute con', 'Ex in sint quam sun', 'Eiusmod nisi fugiat', 'Vitae amet aute con', 'Ex in sint quam sun', 'Maxime sed eaque ali', NULL, 'Hadley Carlson', 'Minus quis est culpa', 'Shoshana Villarreal', 'Occaecat nesciunt o', 'Nihil aut nostrud iu', 'copyjajo@mailinator.com', '2009-12-04', 'Illo voluptates aliq', '+1 (871) 926-3438', 'Vel repudiandae aut', 'Consequatur officia', 'Sit tempora omnis qu', 1, 'fozisog@mailinator.com', '2', '16', '94', '2', '16', '94', 'Ut officia dolorum c', '1', 'Good', '$2y$10$Oot0nTnsNaLUF2XJhqrZVOxeajIRO2kBmax6cbwxh030pRivOvhje', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-09 12:04:49', '2020-12-09 12:04:49'),
(115, 1, 25, 10, 5, 2020201, NULL, NULL, 'Coby Hansen', 3, 3, '1991-04-07', '2', '733', 'dogyt@mailinator.com', NULL, 'Marcia Gilliam', NULL, NULL, NULL, 'Belle Fox', NULL, NULL, NULL, NULL, NULL, NULL, 'Elaine Justice', 'Fugiat eos in disti', 'Illo ut vel do culpa', 'Voluptate hic esse', 'Consequatur Non ist', 'Tenetur est ducimus', 'Voluptate hic esse', 'Consequatur Non ist', 'Tenetur est ducimus', 'Quo nulla ea nobis e', NULL, 'Stacey Melendez', 'Accusamus fuga Veri', 'Hayes Mejia', 'Quisquam ut aut repr', 'Accusamus qui ut est', 'cahugu@mailinator.com', '0000-00-00', 'Ut fugiat similique', '+1 (362) 228-7588', 'Dolor perferendis mo', 'Fuga Error minus au', 'Voluptatem aliquid e', 2, 'zohyjor@mailinator.com', '7', '20', '356', '7', '20', '356', 'Est cupidatat volup', '1', 'Good', '$2y$10$6d6J0YYPwl7Xi8mI7vAQZuEKUjWdQMhD/Yb2/YR7JDO9PlsmWU/h6', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-09 12:15:23', '2020-12-09 12:15:23'),
(116, 1, 25, 10, 5, 2020202, NULL, NULL, 'Grant Simmons', 1, 3, '0000-00-00', '4', '48', 'mizapi@mailinator.com', NULL, 'Charissa Benjamin', NULL, NULL, NULL, 'Nasim Gallegos', NULL, NULL, NULL, NULL, NULL, NULL, 'Brian Long', 'Eaque sapiente proid', 'Sed unde officia adi', 'Explicabo Occaecat', 'Cupidatat dolor dolo', 'Consequatur minima c', 'Explicabo Occaecat', 'Cupidatat dolor dolo', 'Consequatur minima c', 'Dicta et molestiae s', NULL, 'Lana Dillon', 'Ex qui aliquip nobis', 'Tamara Roy', 'Sit distinctio Sit', 'Quo et a ab rerum al', 'jedyg@mailinator.com', '2019-10-09', 'Amet pariatur Null', '+1 (215) 557-1556', 'Omnis quia rerum do', 'Exercitationem incid', 'Perspiciatis est i', 1, 'mise@mailinator.com', '2', '9', '72', '2', '9', '72', 'Eligendi placeat si', '1', 'Fair', '$2y$10$Vr8DonCjZK/m6u9mDZP8juN1fxogusrYUlW038mNiSMutDkGLel2i', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-09 12:18:48', '2020-12-09 12:18:48'),
(117, 1, 25, 10, 5, 2020203, NULL, '123', 'Jessamine Key', 3, 4, '0000-00-00', '4', '55066', 'jawi@mailinator.com', NULL, 'Brynne Farley', NULL, NULL, NULL, 'Scarlet Cooper', NULL, NULL, NULL, NULL, NULL, NULL, 'Hedda Garrett', 'Labore cupiditate ex', 'Ipsa excepteur volu', 'Molestiae dignissimo', 'Quo autem dolorum mo', 'Voluptas minus sunt', 'Molestiae dignissimo', 'Quo autem dolorum mo', 'Voluptas minus sunt', 'Praesentium ad quas', NULL, '4', 'Nulla et expedita ab', 'Ivana Melendez', 'Beatae tempora aliqu', 'In dolorem id nesci', 'dedomifif@mailinator.com', '0000-00-00', 'Illum illo quia qui', '+1 (828) 436-3126', 'Odio aut architecto', 'Consequatur Mollit', 'Iure eligendi dolore', 2, 'qynute@mailinator.com', '5', '44', '422', '5', '44', '422', 'Qui consectetur aliq', '1', 'Fair', '$2y$10$MWlj4pK1ifdGf8IUGO9pUegcDSx96qV0dSQwbFrmRxmoI1yiQ4zlu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-09 12:25:20', '2020-12-09 12:25:20'),
(118, 1, 25, 10, 5, 2020204, NULL, '123456', 'Leila Frost', 1, 4, '1997-11-03', '7', '687', 'lyreqal@mailinator.com', NULL, 'Caryn Ryan', NULL, NULL, NULL, 'Elliott Hyde', NULL, NULL, NULL, NULL, NULL, NULL, 'Channing Cobb', 'Consequatur mollit', 'Aut cupidatat id max', 'Similique dolore nem', 'Nostrud architecto i', 'Architecto provident', 'Similique dolore nem', 'Nostrud architecto i', 'Architecto provident', 'Ipsam qui natus quis', NULL, 'Winter Foreman', 'Quidem in eum ullamc', 'Kalia Terrell', 'Sunt aut nobis quia', 'Sunt enim elit mole', 'nipuqihopi@mailinator.com', '1998-06-04', 'Qui corporis minim n', '+1 (945) 432-8796', 'Autem voluptatem au', 'Quibusdam nisi lorem', 'Dolorem nulla anim s', 1, 'qucasopuvi@mailinator.com', '2', '16', '95', '2', '16', '95', 'Quae magnam doloremq', '1', 'Fair', '$2y$10$AVA20PQDnK8yGDG2cJjL4eIsU9YalqNfUCqBoCyt3HGhtHUnfRvoq', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 05:44:26', '2020-12-10 05:44:26'),
(119, 1, 25, 10, 5, 2020205, 63, 'abc', 'Graiden Browning', 1, 3, '2000-06-02', '3', '410', 'favokutuhu@mailinator.com', NULL, 'Alika Rice', NULL, NULL, NULL, 'Josiah Witt', NULL, NULL, NULL, NULL, NULL, NULL, 'Quinn Pierce', 'Sit delectus eaque', 'Consequat Sint quia', 'Sit numquam id reru', 'Sed sint aut odit a', 'Distinctio Est ven', 'Sit numquam id reru', 'Sed sint aut odit a', 'Distinctio Est ven', 'Nihil quia at placea', NULL, 'Kennan Landry', 'Est adipisicing volu', 'Jada Pate', 'Perspiciatis aut il', 'Aute sunt proident', 'boti@mailinator.com', '0000-00-00', 'Consequatur omnis e', '+1 (973) 693-7994', 'Similique quos accus', 'Fuga Sint minima cu', 'Eos non accusamus ex', 1, 'biqyko@mailinator.com', '3', '42', '255', '3', '42', '255', 'Ratione ut esse nul', '1', 'Poor', '$2y$10$zNkoZ5m10ZW/1aOelKyC1uVp0jnC/GWVb/l5Uwvdz/u2G5xrDFZVS', 2, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 06:03:00', '2021-03-31 10:23:39'),
(120, 1, 25, 10, 5, 2020206, NULL, NULL, 'Rose Benton', 3, 4, '0000-00-00', '4', '999', 'paqi@mailinator.com', NULL, 'Tate Sawyer', NULL, NULL, NULL, 'Noel Vincent', NULL, NULL, NULL, NULL, NULL, NULL, 'Christine Kerr', 'Lorem fugiat dicta e', 'Aute quo commodi cup', 'Earum dolor amet in', 'Ad laboris qui animi', 'Incididunt est dolo', 'Earum dolor amet in', 'Ad laboris qui animi', 'Incididunt est dolo', 'Impedit deserunt cu', NULL, 'Melissa Solis', 'Repudiandae recusand', 'Logan Sherman', 'Do aut tempore exer', 'Autem incididunt con', 'byduxuxosa@mailinator.com', '1997-05-06', 'Aut deserunt reprehe', '+1 (582) 827-8333', 'Ducimus quia cum re', 'Consectetur harum et', 'Enim a ex ea do solu', 1, 'hoqifydot@mailinator.com', '1', '51', '144', '1', '51', '144', 'Est ut magnam molest', '1', 'Good', '$2y$10$tWktAxMeR9.rI61cDyTSg.z2ByUml85I9404amZDVG5692FgSX.zm', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 08:34:33', '2021-03-10 08:30:29');
INSERT INTO `admissions` (`id`, `school_id`, `section_id`, `class_id`, `preadmission_id`, `roll`, `mark`, `add_pass`, `name`, `gender`, `religon`, `dob`, `bloodgroup`, `mobile`, `email`, `photo`, `father_name`, `signature`, `fathercell`, `fatheremail`, `mother_name`, `mothercell`, `motheremail`, `fatheroccupation`, `motheroccupation`, `height`, `weight`, `contactperson`, `contactpersonmobile`, `realation`, `presentAddress`, `perpostoffice`, `perpostcode`, `pastAddress`, `pastpostoffice`, `pastpostcode`, `birthcertificateNo`, `fatherPassport`, `nameAddressofmainSchool`, `admissioninbengaliClass`, `gName`, `gNationality`, `gMobile`, `gEmail`, `gdate`, `gnrcNo`, `gPhone`, `gAddress`, `gOccupation`, `placeBirth`, `singaporepr`, `cemail`, `preDivision`, `preDistrict`, `preThana`, `pastDivision`, `pastDistrict`, `pastThana`, `nationality`, `persent_same`, `bengaliLang`, `password`, `status`, `remark`, `streetAddress_1`, `streetAddress_2`, `city`, `state`, `zipCode`, `country`, `created_at`, `updated_at`) VALUES
(121, 1, 25, 10, 5, 2020207, NULL, NULL, 'Kellie Joyce', 1, 3, '2018-04-06', '6', '580', 'pyny@mailinator.com', NULL, 'Hammett Bowman', NULL, NULL, NULL, 'Colette Browning', NULL, NULL, NULL, NULL, NULL, NULL, 'Lilah Gonzalez', 'Eu deserunt exceptur', 'Iure aliquip assumen', 'Dolores ea soluta sa', 'Illum nulla iste ad', 'Deserunt consequatur', 'Dolores ea soluta sa', 'Illum nulla iste ad', 'Deserunt consequatur', 'Quisquam qui molliti', NULL, 'Brittany Estes', 'In commodi ut minim', 'Adrienne Greer', 'Dolores dolores dict', 'Fugiat tempora error', 'pudafudi@mailinator.com', '0000-00-00', 'Et qui totam non quo', '+1 (732) 729-1768', 'Deleniti commodi ius', 'Reprehenderit itaqu', 'Quia distinctio Cor', 1, 'ponetiq@mailinator.com', '1', '24', '140', '1', '24', '140', 'A autem magni amet', '1', 'Good', '$2y$10$tbnQrtUUjbNMax3yv6ocNeyz97zUlIENjEcnbEJGCO4kD/JxF3klu', 6, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 08:48:15', '2021-03-31 07:53:06'),
(122, 1, 25, 10, 5, 2020208, NULL, NULL, 'Teagan Espinoza', 2, 2, '1993-08-02', '7', '977', 'xezo@mailinator.com', NULL, 'Devin Joyner', NULL, NULL, NULL, 'Rhea Guthrie', NULL, NULL, NULL, NULL, NULL, NULL, 'Dahlia Edwards', 'Numquam tempor minim', 'Veniam quis placeat', 'Ea quo mollit volupt', 'Nihil Nam dolores no', 'Quaerat ex et a repu', 'Ea quo mollit volupt', 'Nihil Nam dolores no', 'Quaerat ex et a repu', 'Quaerat ut alias qui', NULL, 'Brandon Delgado', 'Atque tempore porro', 'August Wilkerson', 'Est aut in sunt ess', 'Recusandae Assumend', 'cire@mailinator.com', '0000-00-00', 'Minus eligendi ducim', '+1 (522) 342-4883', 'Expedita error dolor', 'Numquam temporibus c', 'Fugiat eveniet exp', 2, 'nyjylehot@mailinator.com', '1', '4', '122', '1', '4', '122', 'Quibusdam inventore', '1', 'Nill', '$2y$10$XcE5XBhFwSKwIB2X7JAzzu4vM54guuyRGeqEM.nNSe61DghLMPuvG', 4, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 09:22:14', '2021-03-09 09:42:41'),
(123, 1, 25, 10, 5, 2020209, NULL, NULL, 'Teagan Espinoza', 2, 2, '1993-02-08', '7', '977', 'xezo@mailinator.com', NULL, 'Devin Joyner', NULL, NULL, NULL, 'Rhea Guthrie', NULL, NULL, NULL, NULL, NULL, NULL, 'Dahlia Edwards', 'Numquam tempor minim', 'Veniam quis placeat', 'Ea quo mollit volupt', 'Nihil Nam dolores no', 'Quaerat ex et a repu', 'Ea quo mollit volupt', 'Nihil Nam dolores no', 'Quaerat ex et a repu', 'Quaerat ut alias qui', NULL, 'Brandon Delgado', 'Atque tempore porro', 'August Wilkerson', 'Est aut in sunt ess', 'Recusandae Assumend', 'cire@mailinator.com', '1970-01-01', 'Minus eligendi ducim', '+1 (522) 342-4883', 'Expedita error dolor', 'Numquam temporibus c', 'Fugiat eveniet exp', 2, 'nyjylehot@mailinator.com', '1', '4', '122', '1', '4', '122', 'Quibusdam inventore', '1', 'Nill', '$2y$10$QdeVsxEYVhG/H46JGTrJY.Fy2u3q7ZR4NXNuCDiKtGhj7kymFl0lm', 4, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 09:26:56', '2021-03-09 09:50:42'),
(124, 1, 25, 10, 5, 2020210, NULL, NULL, 'Brady Pace', 2, 3, '0000-00-00', '2', '945', 'mawapiw@mailinator.com', NULL, 'Michelle Wilkinson', NULL, NULL, NULL, 'Paul Barnett', NULL, NULL, NULL, NULL, NULL, NULL, 'Daquan Flowers', 'At qui obcaecati id', 'Nostrud ipsum est', 'Ratione cupiditate r', 'Mollitia qui mollit', 'Autem voluptas non c', 'Ratione cupiditate r', 'Mollitia qui mollit', 'Autem voluptas non c', 'Dolorem deserunt arc', NULL, 'Grant Osborne', 'Amet sed nulla quis', 'Jerry Sullivan', 'Dignissimos quos con', 'Sunt cupiditate qui', 'wunuvejug@mailinator.com', '1997-07-09', 'Quam mollitia est qu', '+1 (863) 574-2711', 'Aliqua Debitis non', 'Provident consectet', 'In culpa aut aut sit', 3, 'wadejiwu@mailinator.com', '3', '18', '191', '3', '18', '191', 'Porro vel delectus', '1', NULL, '$2y$10$qQNFbh4rBAFxYP9Tw9/fguSnnCVVQ41AxZ/XmKZ8nbj9lJasZiGGO', 4, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 11:59:22', '2021-03-09 10:44:13'),
(125, 1, 25, 10, 5, 2020211, NULL, NULL, 'Melyssa Walton', 3, 5, '0000-00-00', '4', '8', 'zaxipom@mailinator.com', NULL, 'Ashely Travis', NULL, NULL, NULL, 'Lisandra Campos', NULL, NULL, NULL, NULL, NULL, NULL, 'Lawrence Mccoy', 'Dolorem quidem dolor', 'Dolor corrupti sed', 'Nihil ipsam dolores', 'Elit excepturi esse', 'Officiis dolore et a', 'Nihil ipsam dolores', 'Elit excepturi esse', 'Officiis dolore et a', 'A dolorum magnam tot', NULL, 'Abdul Hensley', 'Quos tempor delectus', 'Brennan Barron', 'Debitis quia officia', 'Repudiandae a velit', 'nuho@mailinator.com', '1999-04-03', 'Ab perspiciatis et', '+1 (678) 268-5477', 'Commodi reprehenderi', 'Eaque perferendis te', 'Distinctio Quibusda', 4, 'gema@mailinator.com', '2', '2', '45', '2', '2', '45', 'Earum et rerum eos e', '1', 'Poor', '$2y$10$7rJAyrV/MIwnRNCpnzbyDewLUr2BxzgZkE4CrAijOpedwGCfrPA.G', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-10 12:01:23', '2021-03-08 11:54:43'),
(126, 1, 25, 10, 5, 2020212, NULL, NULL, 'Barbara Howe', 2, 2, '1999-09-01', '2', '832', 'jovovevat@mailinator.com', NULL, 'Hilel Weaver', NULL, NULL, NULL, 'Uriah Haynes', NULL, NULL, NULL, NULL, NULL, NULL, 'Tanner Beck', 'Vel porro minus prae', 'Veniam omnis except', 'Labore et expedita a', 'Nulla et vero velit', 'Duis iusto ex a sed', 'Labore et expedita a', 'Nulla et vero velit', 'Duis iusto ex a sed', 'Et esse cillum magn', NULL, 'Nissim Fernandez', 'Earum itaque ut dolo', 'Hamilton Houston', 'Officia exercitation', 'Aliquip ullam sint', 'muvoqa@mailinator.com', '2012-01-05', 'Pariatur Rerum at u', '+1 (601) 818-3999', 'Dolore reiciendis ma', 'Excepturi magni aliq', 'Temporibus odit dolo', 3, 'huduryt@mailinator.com', '5', '7', '389', '5', '7', '389', 'Nulla porro vel elig', '1', NULL, '$2y$10$OAvF9ZWMxOFpmaklaMrifuwdp83afoT7Fd5QmVjH2AXQaTCOz6P4y', 4, NULL, '540 Cowley Drive', 'Voluptate ea aliquid', 'Suscipit ex soluta r', '6', '59191', '18', '2020-12-12 10:04:53', '2021-03-09 11:10:46'),
(127, 1, 25, 10, 5, 2020213, NULL, NULL, 'Isabelle Kelley', 2, 3, '1994-05-07', '8', '316', 'xilib@mailinator.com', NULL, 'Fallon Cochran', NULL, NULL, NULL, 'Laith Brennan', NULL, NULL, NULL, NULL, NULL, NULL, 'Byron Dixon', 'Nihil impedit ad do', 'Nam debitis quisquam', 'Quod rerum qui velit', 'Fugit atque quisqua', 'Sed aliquip quo volu', 'Quod rerum qui velit', 'Fugit atque quisqua', 'Sed aliquip quo volu', 'Maxime rem ullam min', NULL, 'Kellie Mercado', 'Rerum est facilis ei', 'Branden Wells', 'Consequatur mollitia', 'Minus eos consequat', 'lisoras@mailinator.com', '1988-09-03', 'Obcaecati adipisicin', '+1 (369) 788-7275', 'Dolorum libero vel h', 'Voluptatum rerum eve', 'Proident quia venia', 3, 'gufufoqed@mailinator.com', '1', '3', '116', '1', '3', '116', 'Numquam voluptates d', '1', 'Nill', '$2y$10$cAIy9zxhQD20ozYQ8ojgyejFFx2NynNkP/EtvbnAzNUh.QBOR98xm', 5, NULL, '25 Fabien Road', 'Aute dolorem ab id o', 'Placeat ducimus fu', '3', '11622', '18', '2020-12-12 10:51:16', '2021-03-09 06:38:45'),
(128, 1, 25, 10, 5, 2020214, NULL, NULL, 'Shelley Garrett', 2, 5, '1970-01-01', '8', '520', 'jidal@mailinator.com', NULL, 'Hadley Ochoa', NULL, NULL, NULL, 'Octavia Benjamin', NULL, NULL, NULL, NULL, NULL, NULL, 'Iona Buckley', 'Laudantium esse ex', 'Tempore exercitatio', 'Amet culpa quia omn', 'Reprehenderit alias', 'Ut enim qui quam fac', 'Amet culpa quia omn', 'Reprehenderit alias', 'Ut enim qui quam fac', 'Sint officia commodo', NULL, 'Nadine Parsons', 'Ea pariatur Dolorem', 'Mason Browning', 'Vel in nulla error c', 'Cupidatat porro cupi', 'qyxipapo@mailinator.com', '1970-01-01', 'Et eum lorem asperio', '+1 (831) 993-2697', 'Quia mollit mollit s', 'Totam quia illum cu', 'Consectetur neque i', 1, 'tuzu@mailinator.com', '5', '40', '404', '5', '40', '404', 'Esse ea quis et lab', '1', 'Poor', '$2y$10$NrRt4.ymkm6efzPzE4XSAOj.Q/V6huxUVeZZj/HrqXIoNYVzrlFAa', 5, NULL, '20 West Clarendon Boulevard', 'At ducimus illo ani', 'Corporis et totam ea', '23', '70919', '18', '2020-12-13 06:00:11', '2021-03-09 07:02:31'),
(129, 1, 25, 10, 5, 2020215, NULL, NULL, 'Heidi Fulton', 2, 1, '1970-01-01', '2', '927', 'norym@mailinator.com', NULL, 'Marcia Bullock', NULL, NULL, NULL, 'Josiah Johns', NULL, NULL, NULL, NULL, NULL, NULL, 'Megan Santana', 'Quidem tempora non a', 'Est fugit ullam es', 'Qui in unde in enim', 'Labore nihil totam d', 'Velit velit esse f', 'Qui in unde in enim', 'Labore nihil totam d', 'Velit velit esse f', 'Non voluptatem offic', NULL, 'Camilla Terrell', 'Beatae inventore dol', 'Zeus Peck', 'Qui magnam necessita', 'Irure quis adipisci', 'nugon@mailinator.com', '2020-12-09', 'Et fugiat quis dolo', '+1 (107) 859-5474', 'Qui quia aliquip exe', 'Aliquam nisi itaque', 'Et necessitatibus do', 2, 'tutosepa@mailinator.com', '1', '3', '117', '1', '3', '117', 'Eum illum anim ea l', '1', 'Poor', '$2y$10$yKY5XyUeuO9XlcsoQZepQeMX9yAVw4FiLClRzkf0Q0ElMvhZzPX32', 5, NULL, '836 Old Freeway', 'Minus officiis elige', 'Sed rerum do commodi', '5', '37165', '18', '2020-12-13 10:49:17', '2021-03-09 07:04:53'),
(130, 1, 25, 10, 5, 2020216, NULL, NULL, 'Wesley Mueller', 2, 2, '0000-00-00', '5', '44', 'bymylo@mailinator.com', NULL, 'Macy Hewitt', NULL, NULL, NULL, 'Victoria Pickett', NULL, NULL, NULL, NULL, NULL, NULL, 'Ila Bond', 'Adipisicing adipisic', 'Et dolore odit nihil', 'Culpa possimus fug', 'Corrupti cumque eum', 'Culpa hic similique', 'Culpa possimus fug', 'Corrupti cumque eum', 'Culpa hic similique', 'Minim molestiae enim', NULL, 'Myles Stanton', 'Eos vero anim saepe', 'Kiona Rodriguez', 'Eu nulla asperiores', 'Quis voluptatibus do', 'siqefymyqy@mailinator.com', '0000-00-00', 'Velit impedit tempo', '+1 (976) 403-9807', 'Corporis laborum Lo', 'Commodi saepe velit', 'Provident non harum', 4, 'zuhuza@mailinator.com', '3', '45', '264', '3', '45', '264', 'Sint aut sed velit', '1', 'Good', '$2y$10$.54pGVpgTGx0SrCGP3eylOiSdr0F6pB0gxVyv2xTX6CuHiX2eDjrO', 5, NULL, '295 North Green Second Road', 'Excepturi minim fugi', 'Porro labore omnis d', NULL, '96083', '18', '2020-12-13 10:56:10', '2021-03-09 07:05:56'),
(131, 1, 25, 10, 5, 2020217, NULL, NULL, 'Nell Reese', 2, 3, '2010-10-01', '6', '496', 'virowuxibi@mailinator.com', NULL, 'Callie Weeks', NULL, NULL, NULL, 'Ginger Calderon', NULL, NULL, NULL, NULL, NULL, NULL, 'Carissa Barlow', 'Pariatur Eiusmod ob', 'Nulla veniam qui al', 'Omnis aliquip in ea', 'Voluptas tempore mo', 'Eu voluptatem Sit m', 'Omnis aliquip in ea', 'Voluptas tempore mo', 'Eu voluptatem Sit m', 'Pariatur Sed cupida', NULL, 'Renee Nelson', 'Facilis ea nihil ull', 'Blaine Whitley', 'Sequi repudiandae et', 'Odio praesentium ad', 'zidodewexy@mailinator.com', '0000-00-00', 'Iusto quasi inventor', '+1 (844) 197-7767', 'Laboris et eligendi', 'Sed voluptas quae qu', 'Aute et ducimus lib', 4, 'jucil@mailinator.com', '3', '22', '202', '3', '22', '202', 'Aut ab accusamus dol', '1', 'Nill', '$2y$10$B4hoAZfkjoatfoOVNE9iTOMRr76wcQp7fZzAiA/fQD/KtG23nB4e2', 5, NULL, '56 North White New Road', 'Dignissimos debitis', 'Qui eum ut qui velit', NULL, '24432', '18', '2020-12-13 10:57:23', '2021-03-09 07:07:47'),
(132, 1, 25, 10, 5, 2020218, NULL, NULL, 'Lance Kline', 1, 1, '0000-00-00', '4', '918', 'bexeno@mailinator.com', NULL, 'Leandra Morris', NULL, NULL, NULL, 'Martena Medina', NULL, NULL, NULL, NULL, NULL, NULL, 'Emma Woods', 'Qui aut officia odio', 'Quis sed rerum rerum', 'Dolore nulla ab unde', 'Minima ea nostrum ne', 'Nobis fugiat ut off', 'Dolore nulla ab unde', 'Minima ea nostrum ne', 'Nobis fugiat ut off', 'Consectetur qui vol', NULL, 'Arthur Galloway', 'Delectus voluptate', 'Azalia Moody', 'Cillum quos assumend', 'Saepe ullamco dolor', 'hufahosero@mailinator.com', '2007-03-07', 'In architecto explic', '+1 (131) 536-3168', 'Enim velit molestias', 'Voluptas eaque conse', 'Commodi ratione qui', 1, 'ryvypo@mailinator.com', '3', '42', '254', '3', '42', '254', 'Dolores maxime sunt', '1', 'Fair', '$2y$10$njIuEeqGWXAhJeGUQergj.7aakmk/t0WDh8cYW.dSsFRWu.b4joj2', 5, NULL, '64 South New Avenue', 'Recusandae Voluptat', 'Qui ut voluptatibus', '2', '79257', '18', '2020-12-13 10:57:25', '2021-03-09 07:11:19'),
(133, 1, 25, 10, 5, 2020219, NULL, NULL, 'Stewart Sweeney', 2, 1, '0000-00-00', '6', '264', 'cutoq@mailinator.com', NULL, 'Xenos Oliver', NULL, NULL, NULL, 'Gray Peck', NULL, NULL, NULL, NULL, NULL, NULL, 'Ima Dillon', 'Tempor sint veritati', 'Est sed architecto', 'Recusandae Tempore', 'Aperiam enim officia', 'Vel eiusmod voluptat', 'Recusandae Tempore', 'Aperiam enim officia', 'Vel eiusmod voluptat', 'Aut ullam elit sunt', NULL, 'Sopoline Walsh', 'Harum omnis aliquip', 'Brenna Holloway', 'Quasi in ad laborios', 'Dolores enim dolor v', 'zeguze@mailinator.com', '0000-00-00', 'Cupidatat nobis susc', '+1 (179) 222-6257', 'Excepturi facilis di', 'Qui voluptatem occae', 'Qui proident vero q', 4, 'xyxexe@mailinator.com', '3', '19', '197', '3', '19', '197', 'Sunt error perspici', '1', NULL, '$2y$10$pPHewFhoA/pFdC8ucO0Chus9UsuKxbyrFGtXdVYNQvrAxMQnkxDNW', 5, NULL, '34 West White Old Freeway', 'Neque ex obcaecati s', 'Tenetur mollit ad ve', NULL, '10893', '18', '2020-12-13 12:15:58', '2021-03-09 07:12:35'),
(134, 1, 25, 10, 5, 2020220, NULL, '338439', 'Moses Dixon', 3, 3, '0000-00-00', '4', '553', 'zacaj@mailinator.com', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/SP/1608725606.png', 'Yael Robles', NULL, NULL, NULL, 'Nehru Flowers', NULL, NULL, NULL, NULL, NULL, NULL, 'Urielle Hammond', 'Irure molestias simi', 'Sint velit obcaecat', 'In eligendi et neque', 'Omnis non commodi ad', 'Ad fugit quam nemo', 'In eligendi et neque', 'Omnis non commodi ad', 'Ad fugit quam nemo', 'Tempore quia pariat', NULL, 'Guinevere Becker', 'Obcaecati deserunt m', 'Whoopi Houston', 'Dolores aut aliqua', 'Eiusmod nulla repudi', 'hanujyqo@mailinator.com', '0000-00-00', 'Aute ex cillum fugia', '+1 (771) 807-2326', 'Eum corrupti sed pr', 'Animi ullam quos od', 'Eveniet rerum quia', 1, 'cylamef@mailinator.com', '1', '51', '146', '1', '51', '146', 'Qui nihil natus sit', '1', 'Fair', '$2y$10$YKqU22xtKsqLU2qGuNO/g./94D3DtUWwIsi4Y9a/l6HUj1SFyC.NO', 5, NULL, '12 Oak Drive', 'Ducimus et aute lab', 'Dolore ullam eum rem', NULL, '74544', '18', '2020-12-23 12:13:27', '2021-03-09 07:26:14'),
(135, 1, 25, 10, 5, 2020221, NULL, '778323', 'Asher Bonner', 2, 4, '0000-00-00', '4', '561', 'vywyxaru@mailinator.com', '', 'Brielle Morrow', NULL, NULL, NULL, 'Jocelyn Lopez', NULL, NULL, NULL, NULL, NULL, NULL, 'Travis Hurst', 'A sed quisquam at ne', 'Ipsum ipsa corrupt', 'Quis tempore illum', 'Aut assumenda aliqua', 'Ut illo fugiat ad i', 'Quis tempore illum', 'Aut assumenda aliqua', 'Ut illo fugiat ad i', 'Eos aspernatur qui', NULL, 'Isabella Newton', 'Doloremque et id quo', 'Selma Spencer', 'Non minim aute ut vo', 'Ex minus est laboru', 'mugyx@mailinator.com', '0000-00-00', 'Tempora voluptatum r', '+1 (653) 837-8118', 'Maxime sit sint est', 'Aute nemo vel qui ex', 'Adipisci tempora con', 3, 'qozixudo@mailinator.com', '3', '28', '213', '3', '28', '213', 'Qui voluptatum sapie', '1', 'Fair', '$2y$10$OO1gqMx95SQq8BKg5G0rF.6zxlR34faEVGDNh6XsLJ2CshA4S.Cgi', 5, NULL, '51 East Second Extension', 'Omnis sit officiis', 'Molestiae vitae dolo', 'Choose', '86820', '18', '2020-12-24 10:06:03', '2021-03-09 07:27:29'),
(136, 1, 26, 3, 5, 2020222, NULL, '276263', 'Zephania Armstrong', 3, 3, '0000-00-00', '6', '811', 'mexoxur@mailinator.com', '', 'Daryl Dale', NULL, NULL, NULL, 'Charde Stone', NULL, NULL, NULL, NULL, NULL, NULL, 'Kenneth Clark', 'Ex illum modi sint', 'Praesentium reprehen', 'Consectetur ipsum mo', 'Dolore enim qui aliq', 'Laborum Ut recusand', 'Consectetur ipsum mo', 'Dolore enim qui aliq', 'Laborum Ut recusand', 'Qui non nulla necess', NULL, '3', 'Ea ullamco necessita', 'Felicia Gonzales', 'Voluptatem nihil dol', 'Est accusantium nul', 'qezajyh@mailinator.com', '0000-00-00', 'Ipsa officia duis l', '+1 (229) 617-5359', 'Illo esse atque quo', 'Veritatis dolore ani', 'Anim officiis at con', 3, 'cehiqokumy@mailinator.com', '7', '20', '355', '7', '20', '355', 'Veniam ipsum accus', '1', 'Fair', '$2y$10$dK.A15wYIs78RsLQ5FA.meFsOwlmV6yCAVFeEiD9fgUq5IKM5W1h2', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-29 07:20:55', '2020-12-29 07:20:55'),
(137, 1, 26, 3, 5, 2020223, NULL, '139546', 'Wyatt Stevenson', 1, 1, '0000-00-00', '2', '283', 'vabanyrov@mailinator.com', '', 'Debra Fields', NULL, NULL, NULL, 'Naomi Riley', NULL, NULL, NULL, NULL, NULL, NULL, 'Jorden Levy', 'Dolorem velit qui ci', 'Reprehenderit ut ni', NULL, NULL, NULL, NULL, NULL, NULL, 'Accusamus sit tempo', NULL, 'Kelsey Hurley', 'In temporibus omnis', 'Wyoming Torres', 'Ut sit ad mollit hi', 'Suscipit voluptate o', 'nuso@mailinator.com', '0000-00-00', 'Recusandae Incidunt', '+1 (769) 281-6393', 'Laboriosam assumend', 'Praesentium repellen', 'Sed mollit dolore oc', 2, 'hamasogi@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Est nostrum amet et', NULL, 'Good', '$2y$10$pKc9.1w.SfycklSQ4nOP6.Oig5ovRQXczBCgryuAdEVe8K4MeLbnG', 5, NULL, '816 North First Avenue', 'Laborum Nulla alias', 'Voluptas quisquam no', '32', '93753', '18', '2020-12-29 08:34:31', '2021-03-09 08:17:46'),
(138, 1, 24, 7, 5, 2020224, NULL, '317306', 'Shelby Bolton', 2, 5, '0000-00-00', '1', '427', 'hakiryxiwo@mailinator.com', '', 'Shay Baker', NULL, NULL, NULL, 'Fletcher Strong', NULL, NULL, NULL, NULL, NULL, NULL, 'Clarke Pratt', 'In non qui reprehend', 'Deserunt distinctio', NULL, NULL, NULL, NULL, NULL, NULL, 'Fugiat esse aut la', NULL, 'Athena Rios', 'Proident nemo place', 'Nora Aguirre', 'Dignissimos non volu', 'Autem aut quibusdam', 'hemokoqigo@mailinator.com', '2018-10-09', 'Labore aperiam enim', '+1 (634) 637-9674', 'Deleniti qui nemo il', 'Corporis qui nihil a', 'Assumenda fugiat er', 2, 'cidecume@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Officia hic voluptas', NULL, 'Good', '$2y$10$nZbcNadwcLhmZelNBVzZv.NBv.65lCIBWntkzgtMtkY4c1aXdBds6', 5, NULL, '225 South Fabien Lane', 'Quia cum ad qui dolo', 'Obcaecati in enim al', '1', '80272', '18', '2020-12-29 10:55:10', '2021-03-09 08:42:43'),
(139, 1, 26, 3, 5, 2020225, NULL, '651284', 'Iona Morgan', 1, 1, '0000-00-00', '3', '299', 'hohykigi@mailinator.com', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/SP/1609390374.png', 'Hilary Workman', NULL, NULL, NULL, 'Jena Sanders', NULL, NULL, NULL, NULL, NULL, NULL, 'Leigh Macdonald', 'Fugiat ipsa repudia', 'Illum esse sequi q', 'Tenetur dolor aute c', 'Consectetur dolor i', 'Dolores proident no', 'Tenetur dolor aute c', 'Consectetur dolor i', 'Dolores proident no', 'Eiusmod exercitation', NULL, 'Jacob Russo', 'Quia incidunt ea is', 'Basia Herman', 'Fuga Maxime incidun', 'Ut ut labore tempora', 'nuvosipyw@mailinator.com', '0000-00-00', 'Omnis consectetur a', '+1 (622) 142-2908', 'Et iste labore labor', 'Possimus explicabo', 'Cum ex facilis ea li', NULL, 'vusojodiqy@mailinator.com', '5', '54', '441', '5', '54', '441', 'Cumque quis dolores', '1', NULL, '$2y$10$j/fjmr3ldZ0JYgVUX21poOvDG2Vr0DIekgB8WVJFlOna7VjbdtvYy', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2020-12-31 04:52:55', '2021-03-09 08:44:07'),
(140, 1, 26, 3, 9, 2020226, 60, '618611', 'Amanda Mckee', 2, 3, '0000-00-00', '3', '564', 'hycuqaruna@mailinator.com', '', 'Cheryl Clemons', NULL, NULL, NULL, 'Avram Branch', NULL, NULL, NULL, NULL, NULL, NULL, 'Eric Larson', 'Est quia ut eveniet', 'Cillum eveniet haru', 'Officiis molestiae u', 'In maiores culpa ea', 'Doloribus non velit', 'Officiis molestiae u', 'In maiores culpa ea', 'Doloribus non velit', 'Perferendis pariatur', NULL, 'Porter Doyle', 'Beatae maiores sunt', 'Maisie Brewer', 'Assumenda rem omnis', 'Sit non quam ad et', 'libixumelu@mailinator.com', '2014-08-06', 'Ut earum dolore lore', '+1 (632) 549-9968', 'Assumenda maiores si', 'Quisquam dolore cupi', 'Dolorem iure in et e', NULL, 'jilebyvowo@mailinator.com', '4', '1', '291', '4', '1', '291', 'Corporis minima adip', '1', NULL, '$2y$10$mXICSxF5fqumXFTEHeiW2e6a6CNMaX3YxYiC4jpwYZ5Kj5Gj4I5Eu', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-01-02 08:44:42', '2021-01-12 09:02:14'),
(141, 1, 25, 10, 9, 2020227, 0, '166524', 'Ifeoma Rodgers', 3, 3, '1995-10-01', '1', '484', 'zuzyrux@mailinator.com', '', 'Abbot Duncan', NULL, NULL, NULL, 'Venus Conrad', NULL, NULL, NULL, NULL, NULL, NULL, 'Rana Witt', 'Quia est et asperior', 'Consequatur enim ver', NULL, NULL, NULL, NULL, NULL, NULL, 'Sit ducimus repreh', NULL, 'Eve Taylor', 'Obcaecati id rerum u', 'Wyatt William', 'Iusto quod quidem si', 'Dolorem delectus do', 'pike@mailinator.com', '0000-00-00', 'Velit ad impedit es', '+1 (782) 393-5236', 'Unde minus delectus', 'Est minus exercitat', 'Doloremque quis haru', 4, 'kehymow@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Qui duis eu sint vol', NULL, 'Fair', '$2y$10$GLszKN0VFteKPoUXsoAaY.7oMuaFPO2xtk9j2Q.kxYpF6dHDcyvOO', 5, NULL, '79 North Green Milton Boulevard', 'Architecto neque acc', 'Sit dolorum nihil vo', NULL, '23178', '18', '2021-01-10 10:31:11', '2021-03-09 09:13:28'),
(142, 1, 24, 7, 9, 2020228, 85, '243227', 'Lillian Pennington', 3, 4, '0000-00-00', '3', '218', 'tiloki@mailinator.com', '', 'Cullen Noble', NULL, NULL, NULL, 'Kibo Richard', NULL, NULL, NULL, NULL, NULL, NULL, 'Rachel Mathews', 'Commodo nulla aut la', 'Dolore rerum Nam Nam', NULL, NULL, NULL, NULL, NULL, NULL, 'Deleniti incididunt', NULL, 'Hu Lawson', 'Ipsum lorem quaerat', 'Astra Gallegos', 'Quisquam aut sit qui', 'Itaque dolorem elit', 'sovexyvobu@mailinator.com', '2002-06-10', 'Sed aliquam commodi', '+1 (416) 419-9331', 'Repudiandae et fuga', 'Ratione libero eveni', 'Incidunt autem labo', 1, 'kedilaw@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Illo laudantium cul', NULL, 'Poor', '$2y$10$zfxs7pUgteh1v2HCvfLiQOzi1JRwzAeG.S5Ob7tUb9/9YeSN.MwGG', 5, NULL, '294 South First Parkway', 'Quis voluptatem numq', 'Tempor amet labore', 'Choose', '98110', '18', '2021-01-10 11:37:21', '2021-03-01 00:29:40'),
(143, 1, 25, 10, 9, 2020229, NULL, '290353', 'Whilemina Mejia', 3, 2, '0000-00-00', '5', '535', 'nyba@mailinator.com', '', 'Orlando Mitchell', NULL, NULL, NULL, 'Alice Pope', NULL, NULL, NULL, NULL, NULL, NULL, 'Imelda Vinson', 'Aspernatur irure est', 'Cum ipsa consequatu', 'Amet veniam harum', 'Architecto dolor sim', '1207', 'Dhaka', 'Dhaka', '1205', 'Elit vel quia venia', NULL, 'Patience Middleton', 'Aperiam consequat S', 'Yeo Hughes', 'Voluptate ipsam maio', 'Est quae quasi natu', 'razu@mailinator.com', '0000-00-00', 'Corrupti reprehende', '+1 (297) 103-8457', 'Sint voluptate faci', 'Laboriosam nisi vel', 'Qui velit voluptates', NULL, 'poqy@mailinator.com', '3', '28', '213', '3', '28', '213', 'Et fugiat cupidatat', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-01-13 07:55:25', '2021-01-13 10:42:29'),
(144, 1, 25, 10, 9, 2020230, NULL, '109864', 'Thomas Griffith', 3, 4, '1999-05-06', '8', '694', 'femijel@mailinator.com', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/SP/1610525792.png', 'Mannix Reid', NULL, NULL, NULL, 'Paki Williamson', NULL, NULL, NULL, NULL, NULL, NULL, 'Jasper Fletcher', 'Impedit excepturi h', 'Molestiae pariatur', 'Rerum totam enim eni', 'Accusantium vel do v', 'Magni in sint dolor', 'Rerum totam enim eni', 'Accusantium vel do v', 'Magni in sint dolor', 'Perspiciatis volupt', NULL, 'Chelsea French', 'Non porro velit vol', 'Dakota Zimmerman', 'Corrupti qui id pos', 'Sit minim temporibus', 'honoje@mailinator.com', '2005-11-03', 'Nisi ea et autem eaq', '+1 (414) 901-1056', 'Cum alias recusandae', 'Quisquam repellendus', 'Quod ipsam sint eiu', NULL, 'rotuzymib@mailinator.com', '3', '22', '203', '3', '22', '203', 'Fugiat autem vel ut', '1', NULL, '$2y$10$rea1asx/zYEtbsbRjXAY6e8YPg/GPfSn7i7F/i96qK0HsaUqWaM86', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-01-13 08:16:32', '2021-01-13 08:16:32'),
(145, 1, 24, 7, 9, 2020231, NULL, '266819', 'Courtney Huber', 3, 3, '0000-00-00', '7', '944', 'mawerehe@mailinator.com', '', 'Bryar Rios', NULL, NULL, NULL, 'Edan Dawson', NULL, NULL, NULL, NULL, NULL, NULL, 'Randall Sykes', 'Explicabo Blanditii', 'Eum in minim commodo', 'Provident eum nostr', 'Odit nihil sit sunt', 'Do eu quasi possimus', 'Provident eum nostr', 'Odit nihil sit sunt', 'Do eu quasi possimus', 'Aut optio ipsum imp', NULL, 'Bruno Valenzuela', 'Sunt nihil in iusto', 'Aimee Haynes', 'Architecto numquam o', 'Quisquam eius accusa', 'kebopuryf@mailinator.com', '0000-00-00', 'Aut odio pariatur S', '+1 (654) 233-7361', 'Elit rerum sit cons', 'Corporis laboris in', 'Quo pariatur Dicta', NULL, 'jydiforez@mailinator.com', '5', '21', '400', '5', '21', '400', 'Neque voluptatem qu', '1', NULL, '', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-01-13 08:58:23', '2021-01-13 08:59:47'),
(146, 1, 26, 3, 9, 2020232, NULL, '264006', 'Brody Holder', 1, 1, '0000-00-00', '3', '90', 'zezycowe@mailinator.com', '', 'Kyla Rhodes', NULL, NULL, NULL, 'Emery Mcconnell', NULL, NULL, NULL, NULL, NULL, NULL, 'Halee Bishop', 'Est ut ea asperiore', 'Enim quos facere dol', 'Dolor aut inventore', 'Minim non sed possim', '5623', 'Dolor aut inventore', 'Minim non sed possim', '5623', 'Perferendis nostrud', NULL, 'Sylvester Colon', 'Sit duis distinctio', 'Phoebe Zimmerman', 'Veniam velit nostru', 'Sit unde non ut iru', 'vigogytid@mailinator.com', '0000-00-00', 'Similique recusandae', '+1 (295) 843-8047', 'Voluptatem inventor', 'Officiis facilis vol', 'Non dicta illo dolor', NULL, 'zivywek@mailinator.com', '5', 'Choose', NULL, '5', 'Choose', NULL, 'Dolores maiores cons', '1', NULL, '$2y$10$iO67VO/Mxoxh4JGH8xVYDe.WSpz6ud2zaAyJ0f311umQoR7QznguO', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-03-01 00:28:16', '2021-03-01 00:28:16'),
(147, 1, 24, 7, 9, 2020233, NULL, '386505', 'Halla Pitts', 1, 2, '2021-17-03', '5', '479', 'ciraxi@mailinator.com', '', 'Colin Landry', NULL, NULL, NULL, 'Valentine Hudson', NULL, NULL, NULL, NULL, NULL, NULL, 'Brennan Stone', 'Fugiat assumenda au', 'Iusto rem aut enim q', 'Labore harum nisi ve', 'Reiciendis quaerat n', '9563', 'Labore harum nisi ve', 'Reiciendis quaerat n', '9563', 'Aut totam in sit rat', NULL, 'Geraldine Alvarado', 'Repellendus Veritat', 'Kaden Robles', 'Sit reprehenderit in', 'Voluptas quae duis s', 'tozuju@mailinator.com', '2021-25-03', 'Obcaecati ipsa amet', '+1 (679) 334-7687', 'Voluptatem Ut non v', 'Corporis officia par', 'Quia expedita ipsum', NULL, 'bycegimak@mailinator.com', '5', '44', '423', '5', '44', '423', 'Ipsa quas elit et', '1', NULL, '$2y$10$omVQgYQLW.pCIjgj/RNn8eVgJwLqBS.JG5Vr19HV3eKm5y2lKJPOi', 5, NULL, NULL, NULL, NULL, NULL, NULL, '18', '2021-03-01 01:01:45', '2021-03-01 01:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `admission_payments`
--

CREATE TABLE `admission_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED NOT NULL,
  `trans_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_charge` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_date` timestamp NULL DEFAULT NULL,
  `trans_type` tinyint(4) DEFAULT NULL COMMENT '1=Stripe,2=SSL',
  `trans_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_pay` tinyint(4) DEFAULT 1 COMMENT '1=charge with amount,0=charge without amount',
  `amount` double(8,2) NOT NULL,
  `stripe_fee` double(3,2) DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For SSL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_payments`
--

INSERT INTO `admission_payments` (`id`, `school_id`, `admission_id`, `trans_number`, `stripe_charge`, `trans_id`, `trans_date`, `trans_type`, `trans_status`, `fee_pay`, `amount`, `stripe_fee`, `currency`, `card_type`, `created_at`, `updated_at`) VALUES
(3, 1, 121, 'FA1615281733', NULL, 'txn_21FAvXSo4MoUswucjekF1W2u', '2021-03-09 09:27:30', 2, 'Paid', 1, 200.00, 0.00, 'BDT', 'BKASH-BKash', '2021-03-09 09:22:13', '2021-03-09 09:22:40'),
(4, 1, 122, 'FA1615282751', NULL, 'txn_21FAWxDeECzBU6xcfZHabNUj', '2021-03-09 09:44:28', 2, 'Paid', 1, 150.00, 3.85, 'BDT', 'BKASH-BKash', '2021-03-09 09:39:11', '2021-03-09 09:42:40'),
(5, 1, 123, 'FA1615283425', NULL, 'txn_21FA0FhkQLwqraYUX5ZkzYIB', '2021-03-09 09:55:41', 2, 'Paid', 1, 150.00, 3.85, 'BDT', 'NAGAD-Nagad', '2021-03-09 09:50:25', '2021-03-09 09:50:42'),
(6, 1, 124, 'FA1615284078', NULL, 'txn_21FAZsuATcaWuZmZuiUHn9VM', NULL, 2, 'Canceled', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-09 10:01:18', '2021-03-09 10:01:27'),
(7, 1, 124, 'FA1615286196', NULL, 'txn_21FAqJtWbhMAS40wl9G0IkzR', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-09 10:36:36', '2021-03-09 10:36:36'),
(8, 1, 124, 'FA1615286508', NULL, 'txn_21FA1FDm9XZlH1F0FsUrb2In', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-09 10:41:48', '2021-03-09 10:41:48'),
(9, 1, 124, 'FA1615286592', NULL, 'txn_21FAyA4catr5TnNSGkzFmsTJ', '2021-03-09 10:48:29', 2, 'Paid', 1, 150.00, 3.85, 'BDT', 'ABBANKIB-AB Bank', '2021-03-09 10:43:12', '2021-03-09 10:44:13'),
(10, 1, 126, 'FA1615286690', NULL, 'txn_21FA3axdHQTT7Q1BGMMi6OyK', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-09 10:44:50', '2021-03-09 10:44:50'),
(11, 1, 126, 'FA1615286733', NULL, 'txn_21FAYgKC7BrVu82koPCcuzLD', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-09 10:45:33', '2021-03-09 10:45:33'),
(12, 1, 126, 'FA1615288194', NULL, 'txn_21FAhx6pSBwaNeL8slKo41Dl', '2021-03-09 11:15:11', 2, 'Paid', 1, 150.00, 3.85, 'BDT', 'IBBL-Islami Bank', '2021-03-09 11:09:54', '2021-03-09 11:10:46'),
(13, 1, 10, 'FA1615376676', NULL, 'txn_21FASXSOzVSR3qs4MnHep7JN', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-10 11:44:36', '2021-03-10 11:44:36'),
(14, 1, 119, 'FA1616655678', NULL, 'txn_21FAtkSBpNnTV0eLLzBtTaNd', NULL, 2, 'Pending', 1, 153.85, 3.85, 'BDT', NULL, '2021-03-25 07:01:17', '2021-03-25 07:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shareOf` double(8,2) DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_branch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_routing` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `user_id`, `district_id`, `state_id`, `city`, `nid`, `nid_url`, `shareOf`, `bank_name`, `ac_name`, `ac_number`, `ac_branch`, `ac_routing`, `created_at`, `updated_at`) VALUES
(1, 402, 46, NULL, NULL, '19927313651000176', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/NID/9771612953802.png', 21.45, 'Islami Bank Ltd', 'Arun Kumar', '12434', 'Elephant Road', '41324', NULL, '2021-03-24 10:11:30'),
(2, 403, NULL, 1, NULL, NULL, NULL, 20.00, 'Dhaka Bank', 'asdsa', 'asdasd', 'asdad', 'asdasd', NULL, '2021-03-25 08:12:47'),
(3, 404, NULL, NULL, 'My City is\r\nDhaka', NULL, NULL, 15.00, 'asda', 'asda', 'asda', 'asdas', 'asdasd', '2021-02-09 10:51:15', '2021-03-24 09:50:16'),
(4, 431, NULL, NULL, NULL, NULL, NULL, 15.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:38:36', '2021-03-24 07:38:36'),
(5, 432, NULL, NULL, NULL, NULL, NULL, 30.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:41:41', '2021-03-24 09:48:55'),
(6, 434, NULL, NULL, NULL, NULL, NULL, 20.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:45:55', '2021-03-24 09:59:24'),
(7, 435, NULL, NULL, NULL, NULL, NULL, 12.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:55:39', '2021-03-24 09:59:11'),
(8, 436, NULL, NULL, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:05:06', '2021-03-24 09:59:05'),
(9, 437, NULL, NULL, NULL, NULL, NULL, 16.50, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:08:06', '2021-03-24 09:58:34'),
(10, 438, NULL, NULL, NULL, NULL, NULL, 1.99, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:13:23', '2021-03-24 09:55:02'),
(11, 439, NULL, NULL, '15', NULL, NULL, 22.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:14:42', '2021-03-24 09:54:14'),
(12, 440, NULL, NULL, NULL, NULL, NULL, 30.50, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:16:54', '2021-03-24 09:52:53'),
(13, 441, NULL, NULL, NULL, NULL, NULL, 24.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:18:38', '2021-03-24 08:18:38'),
(14, 442, NULL, NULL, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:22:15', '2021-03-24 08:22:15'),
(15, 443, NULL, NULL, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:25:12', '2021-03-24 08:25:12'),
(16, 444, NULL, NULL, NULL, NULL, NULL, 45.00, NULL, NULL, NULL, NULL, NULL, '2021-03-24 08:29:28', '2021-03-24 09:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `present` tinyint(3) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `school_id`, `student_id`, `section_id`, `exam_id`, `present`, `user_id`, `date`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 110, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:21', '2021-01-30 08:17:21'),
(2, 1, 210, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:22', '2021-01-30 08:17:22'),
(3, 1, 239, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:23', '2021-01-30 08:17:23'),
(4, 1, 137, 17, 1, 0, 12, '2021-01-28', NULL, '2021-01-30 08:17:24', '2021-01-30 08:17:35'),
(5, 1, 157, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:25', '2021-01-30 08:17:25'),
(6, 1, 231, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:26', '2021-01-30 08:17:26'),
(7, 1, 66, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:27', '2021-01-30 08:17:27'),
(8, 1, 124, 17, 1, 0, 12, '2021-01-28', NULL, '2021-01-30 08:17:28', '2021-01-30 08:17:37'),
(9, 1, 267, 17, 1, 1, 12, '2021-01-28', NULL, '2021-01-30 08:17:29', '2021-01-30 08:17:29'),
(10, 1, 110, 17, 1, 0, 12, '2021-01-29', NULL, '2021-01-30 08:17:48', '2021-01-30 08:17:59'),
(11, 1, 210, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:49', '2021-01-30 08:17:49'),
(12, 1, 239, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:50', '2021-01-30 08:17:50'),
(13, 1, 137, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:51', '2021-01-30 08:17:51'),
(14, 1, 157, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:52', '2021-01-30 08:17:52'),
(15, 1, 231, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:53', '2021-01-30 08:17:53'),
(16, 1, 66, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:54', '2021-01-30 08:17:54'),
(17, 1, 124, 17, 1, 0, 12, '2021-01-29', NULL, '2021-01-30 08:17:55', '2021-01-30 08:18:01'),
(18, 1, 267, 17, 1, 1, 12, '2021-01-29', NULL, '2021-01-30 08:17:56', '2021-03-25 12:06:46'),
(19, 1, 210, 17, 1, 1, 12, '2021-01-30', NULL, '2021-01-30 08:18:09', '2021-01-30 08:18:09'),
(20, 1, 157, 17, 1, 1, 12, '2021-01-30', NULL, '2021-01-30 08:18:11', '2021-01-30 08:18:11'),
(21, 1, 124, 17, 1, 1, 12, '2021-01-30', NULL, '2021-01-30 08:18:12', '2021-01-30 08:18:12'),
(22, 1, 110, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:08', '2021-01-31 12:09:08'),
(23, 1, 210, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:10', '2021-01-31 12:09:10'),
(24, 1, 239, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:11', '2021-01-31 12:09:11'),
(25, 1, 137, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:12', '2021-01-31 12:09:12'),
(26, 1, 157, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:13', '2021-01-31 12:09:13'),
(27, 1, 231, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:14', '2021-01-31 12:09:14'),
(28, 1, 66, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:15', '2021-01-31 12:09:15'),
(29, 1, 124, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:16', '2021-01-31 12:09:16'),
(30, 1, 267, 17, 1, 1, 12, '2021-01-07', NULL, '2021-01-31 12:09:17', '2021-01-31 12:09:17'),
(31, 1, 110, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:30', '2021-01-31 12:09:30'),
(32, 1, 210, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:31', '2021-01-31 12:09:31'),
(33, 1, 239, 17, 1, 0, 12, '2021-01-20', NULL, '2021-01-31 12:09:32', '2021-01-31 12:09:41'),
(34, 1, 137, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:33', '2021-01-31 12:09:33'),
(35, 1, 157, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:34', '2021-01-31 12:09:34'),
(36, 1, 231, 17, 1, 0, 12, '2021-01-20', NULL, '2021-01-31 12:09:35', '2021-01-31 12:09:45'),
(37, 1, 66, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:37', '2021-01-31 12:09:37'),
(38, 1, 124, 17, 1, 1, 12, '2021-01-20', NULL, '2021-01-31 12:09:38', '2021-01-31 12:09:38'),
(39, 1, 267, 17, 1, 0, 12, '2021-01-20', NULL, '2021-01-31 12:09:38', '2021-01-31 12:09:43'),
(40, 1, 230, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-04 10:10:35', '2021-02-04 10:10:43'),
(41, 1, 227, 8, 1, 0, 12, '2021-02-03', 'fgb', '2021-02-04 10:20:41', '2021-02-04 10:21:33'),
(42, 1, 232, 8, 1, 1, 12, '2021-02-01', NULL, '2021-02-04 10:31:50', '2021-02-04 10:31:50'),
(43, 1, 90, 8, 1, 1, 12, '2021-02-03', 's', '2021-02-06 07:09:16', '2021-02-06 07:09:16'),
(44, 1, 133, 8, 1, 0, 12, '2021-02-03', NULL, '2021-02-06 07:49:54', '2021-02-06 07:49:54'),
(45, 1, 216, 8, 1, 0, 12, '2021-02-03', NULL, '2021-02-06 07:49:54', '2021-02-06 07:49:54'),
(46, 1, 223, 8, 1, 0, 12, '2021-02-03', NULL, '2021-02-06 07:49:54', '2021-02-06 07:49:54'),
(47, 1, 232, 8, 1, 0, 12, '2021-02-03', NULL, '2021-02-06 07:49:54', '2021-02-06 07:49:54'),
(48, 1, 90, 8, 1, 0, 12, '2021-02-01', NULL, '2021-02-06 07:59:41', '2021-02-06 07:59:41'),
(49, 1, 133, 8, 1, 0, 12, '2021-02-01', NULL, '2021-02-06 07:59:41', '2021-02-06 07:59:41'),
(50, 1, 216, 8, 1, 0, 12, '2021-02-01', NULL, '2021-02-06 07:59:41', '2021-02-06 07:59:41'),
(51, 1, 223, 8, 1, 0, 12, '2021-02-01', NULL, '2021-02-06 07:59:41', '2021-02-06 07:59:41'),
(52, 1, 227, 8, 1, 0, 12, '2021-02-01', NULL, '2021-02-06 07:59:41', '2021-02-06 07:59:41'),
(53, 1, 227, 8, 1, 0, 12, '2021-02-06', 'no test', '2021-02-06 10:02:40', '2021-02-06 10:08:46'),
(54, 1, 90, 8, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:03:07', '2021-02-06 10:03:07'),
(55, 1, 133, 8, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:03:07', '2021-02-06 10:03:07'),
(56, 1, 216, 8, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:03:07', '2021-02-06 10:03:07'),
(57, 1, 223, 8, 1, 1, 12, '2021-02-06', 'okay', '2021-02-06 10:03:07', '2021-02-06 10:08:28'),
(58, 1, 232, 8, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:03:07', '2021-02-06 10:03:07'),
(59, 1, 239, 17, 1, 1, 12, '2021-02-06', NULL, '2021-02-06 10:11:38', '2021-02-06 10:11:38'),
(60, 1, 66, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(61, 1, 110, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(62, 1, 124, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(63, 1, 137, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(64, 1, 157, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(65, 1, 210, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(66, 1, 231, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(67, 1, 267, 17, 1, 0, 12, '2021-02-06', NULL, '2021-02-06 10:11:46', '2021-02-06 10:11:46'),
(68, 1, 110, 17, 1, 1, 12, '2021-02-04', NULL, '2021-02-06 10:12:05', '2021-02-06 10:12:05'),
(69, 1, 231, 17, 1, 1, 12, '2021-02-04', NULL, '2021-02-06 10:12:07', '2021-02-06 10:12:07'),
(70, 1, 66, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(71, 1, 124, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(72, 1, 137, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(73, 1, 157, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(74, 1, 210, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(75, 1, 239, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(76, 1, 267, 17, 1, 0, 12, '2021-02-04', NULL, '2021-02-06 10:12:13', '2021-02-06 10:12:13'),
(77, 1, 66, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(78, 1, 110, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(79, 1, 137, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(80, 1, 231, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(81, 1, 239, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(82, 1, 267, 17, 1, 0, 12, '2021-01-30', NULL, '2021-02-06 10:15:37', '2021-02-06 10:15:37'),
(83, 1, 210, 17, 1, 1, 12, '2021-02-07', NULL, '2021-02-07 07:47:31', '2021-02-07 07:47:31'),
(84, 1, 66, 17, 1, 1, 12, '2021-02-07', NULL, '2021-02-07 07:47:33', '2021-02-07 07:47:33'),
(85, 1, 149, 1, 1, 1, 12, '2021-02-07', NULL, '2021-02-07 07:49:39', '2021-02-07 07:49:39'),
(86, 1, 82, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(87, 1, 153, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(88, 1, 162, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(89, 1, 168, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(90, 1, 206, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(91, 1, 212, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(92, 1, 229, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(93, 1, 230, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(94, 1, 238, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(95, 1, 248, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(96, 1, 249, 1, 1, 0, 12, '2021-02-07', NULL, '2021-02-07 07:49:49', '2021-02-07 07:49:49'),
(97, 1, 82, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(98, 1, 149, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(99, 1, 153, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(100, 1, 162, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(101, 1, 168, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(102, 1, 206, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(103, 1, 212, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(104, 1, 229, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(105, 1, 238, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(106, 1, 248, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(107, 1, 249, 1, 1, 0, 12, '2021-02-04', NULL, '2021-02-07 07:50:33', '2021-02-07 07:50:33'),
(108, 1, 212, 1, 1, 1, 12, '2021-02-06', NULL, '2021-02-07 07:51:14', '2021-02-07 07:51:14'),
(109, 1, 168, 1, 1, 1, 12, '2021-02-06', NULL, '2021-02-07 07:51:16', '2021-02-07 07:51:16'),
(110, 1, 82, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(111, 1, 149, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(112, 1, 153, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(113, 1, 162, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(114, 1, 206, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(115, 1, 229, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(116, 1, 230, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(117, 1, 238, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(118, 1, 248, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(119, 1, 249, 1, 1, 0, 12, '2021-02-06', NULL, '2021-02-07 07:51:21', '2021-02-07 07:51:21'),
(120, 1, 110, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(121, 1, 124, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(122, 1, 137, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(123, 1, 157, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(124, 1, 239, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(125, 1, 267, 17, 1, 0, 12, '2021-02-07', NULL, '2021-02-18 06:39:44', '2021-02-18 06:39:44'),
(126, 1, 110, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:43', '2021-02-22 06:31:43'),
(127, 1, 210, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:45', '2021-02-22 06:31:45'),
(128, 1, 239, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:45', '2021-02-22 06:31:45'),
(129, 1, 137, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:47', '2021-02-22 06:31:47'),
(130, 1, 157, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:47', '2021-02-22 06:31:47'),
(131, 1, 66, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:49', '2021-02-22 06:31:49'),
(132, 1, 124, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:50', '2021-02-22 06:31:50'),
(133, 1, 267, 17, 1, 1, 12, '2021-02-22', NULL, '2021-02-22 06:31:51', '2021-02-22 06:31:51'),
(134, 1, 110, 17, 1, 1, 12, '2021-03-04', NULL, '2021-03-04 09:51:06', '2021-03-04 09:51:27'),
(135, 1, 210, 17, 1, 1, 12, '2021-03-04', NULL, '2021-03-04 09:51:14', '2021-03-04 09:51:16'),
(136, 1, 239, 17, 1, 1, 12, '2021-03-04', NULL, '2021-03-04 09:51:31', '2021-03-04 09:51:33'),
(137, 1, 137, 17, 1, 1, 12, '2021-03-04', NULL, '2021-03-04 09:51:40', '2021-03-04 09:51:43'),
(138, 1, 157, 17, 1, 1, 12, '2021-03-04', NULL, '2021-03-04 09:51:50', '2021-03-04 09:51:52'),
(139, 1, 66, 17, 1, 0, 12, '2021-03-04', NULL, '2021-03-04 09:52:21', '2021-03-04 09:52:21'),
(140, 1, 124, 17, 1, 0, 12, '2021-03-04', NULL, '2021-03-04 09:52:21', '2021-03-04 09:52:21'),
(141, 1, 267, 17, 1, 0, 12, '2021-03-04', NULL, '2021-03-04 09:52:21', '2021-03-04 09:52:21'),
(158, 1, 110, 17, 7, 1, 12, '2021-04-01', NULL, '2021-04-01 09:48:28', '2021-04-01 09:48:28'),
(159, 1, 267, 17, 7, 1, 12, '2021-04-01', NULL, '2021-04-01 09:48:30', '2021-04-01 09:48:30'),
(160, 1, 66, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44'),
(161, 1, 124, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44'),
(162, 1, 137, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44'),
(163, 1, 157, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44'),
(164, 1, 210, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44'),
(165, 1, 239, 17, 7, 0, 12, '2021-04-01', NULL, '2021-04-01 09:48:44', '2021-04-01 09:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `rackNo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rowNo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_code`, `title`, `author`, `quantity`, `rackNo`, `rowNo`, `img_path`, `about`, `type`, `price`, `class_id`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'bk6845506', 'Optio ratione culpa iste.', 'Dr. Carole Mann Sr.', 34, '2', '1', 'https://lorempixel.com/150/150/cats/?48828', 'Consequuntur numquam natus itaque velit. Vitae et ut quam exercitationem tempora qui et. Eveniet et accusantium et nostrum dolores vitae.', 'Academic', 79, 9, 35, 25, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(2, 'bk4546201', 'Eaque voluptates ea cupiditate iusto tempora architecto tempore quia.', 'Angelica Tromp', 13, '12', '8', 'https://lorempixel.com/150/150/cats/?24413', 'Autem qui dolores recusandae accusantium voluptas tenetur temporibus maiores. Explicabo quasi vel dolore animi cum minima odit. Ea voluptas dolor omnis.', 'Magazine', 205601, 13, 21, 23, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(3, 'bk295587', 'Quis aut ratione et nihil qui.', 'Cristobal Schulist', 19, '3', '9', 'https://lorempixel.com/150/150/cats/?78881', 'Possimus illo repudiandae architecto illum placeat a. Inventore quos eveniet rerum est ut expedita eveniet. Et sequi voluptatum distinctio voluptate voluptas.', 'Other', 5531320, 2, 33, 23, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(4, 'bk6647813', 'Et saepe iure maxime modi consequatur minus.', 'Evan Monahan', 13, '7', '2', 'https://lorempixel.com/150/150/cats/?42344', 'Quia nisi unde veritatis totam. Qui omnis exercitationem ipsa consequatur occaecati officia. Consequatur et itaque reiciendis iste.', 'Magazine', 74, 6, 44, 30, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(5, 'bk8357165', 'A consectetur culpa provident saepe.', 'Bertram Rosenbaum', 5, '4', '12', 'https://lorempixel.com/150/150/cats/?59126', 'Tempora aut harum architecto molestiae. Nisi aspernatur et architecto quibusdam fuga neque enim. Voluptatem assumenda qui ab aut aut enim sint.', 'Academic', 600691863, 2, 29, 31, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(6, 'bk9340920', 'Eos eum iure iure accusantium cum nesciunt.', 'Clair Sauer IV', 8, '8', '11', 'https://lorempixel.com/150/150/cats/?96445', 'Quam facere quibusdam ratione quis et numquam est. Assumenda ipsa expedita dolorem. Ea facilis rerum quo delectus quos ut.', 'Story', 1145455, 11, 49, 30, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(7, 'bk6793073', 'Autem nihil ut voluptatem rerum dolores a.', 'Nico Littel', 8, '4', '4', 'https://lorempixel.com/150/150/cats/?36298', 'Repudiandae ex necessitatibus a sed reiciendis labore explicabo. Iure excepturi qui omnis optio. Nobis aperiam sapiente nihil perspiciatis officiis et ut.', 'Academic', 332269, 5, 1, 23, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(8, 'bk4804935', 'Et quo similique laudantium eum.', 'Jennyfer O\'Hara', 13, '11', '10', 'https://lorempixel.com/150/150/cats/?25043', 'Asperiores error dolore quaerat sunt dicta est. Impedit similique soluta recusandae iste tempore modi adipisci. Est necessitatibus neque libero pariatur qui dolor consequatur.', 'Story', 245, 6, 22, 25, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(9, 'bk9552705', 'Et illo voluptate ut impedit.', 'Providenci Paucek', 5, '2', '5', 'https://lorempixel.com/150/150/cats/?64051', 'Autem impedit debitis iure aut. Quis et placeat qui qui ad sapiente possimus veniam. Repellendus et sit consectetur eligendi sit dolorem.', 'Magazine', 3, 9, 34, 27, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(10, 'bk4659352', 'Iusto fuga quam ratione rem nulla.', 'Adriana Sauer', 8, '7', '11', 'https://lorempixel.com/150/150/cats/?90707', 'Ipsum aut quia hic qui molestiae tempore architecto. Voluptatem sit tempora voluptates ad sapiente vitae quis tempora. Optio molestiae illum et saepe.', 'Magazine', 535, 9, 10, 31, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(11, 'bk5873275', 'Repellendus assumenda officiis quo magnam ad ut.', 'Fatima Morar', 34, '8', '9', 'https://lorempixel.com/150/150/cats/?86015', 'Cum non sit aut in. Praesentium voluptatem ut ea. Repudiandae iste dolorum laboriosam suscipit.', 'Magazine', 5481927, 11, 26, 30, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(12, 'bk5313884', 'Iusto dolorum enim cum nihil vel.', 'Ms. Sharon Rodriguez', 34, '9', '1', 'https://lorempixel.com/150/150/cats/?30848', 'Modi fugit ratione harum deserunt aut consequatur. Qui perspiciatis vero sit deleniti. Adipisci quibusdam ipsa earum enim ea voluptate.', 'Academic', 127105, 10, 8, 29, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(13, 'bk8564793', 'Repellat omnis expedita repudiandae velit beatae.', 'Anna Sauer V', 19, '8', '9', 'https://lorempixel.com/150/150/cats/?21884', 'Et consequatur quis tempore autem sed quisquam. Quis sed illo fugit sed quia sit ut. Voluptate quia iure ratione ullam modi sed.', 'Magazine', 97311, 4, 30, 27, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(14, 'bk3085769', 'Quia aliquam aspernatur commodi perferendis dolorem dolorum ut magni.', 'Savanah Feest DVM', 8, '3', '6', 'https://lorempixel.com/150/150/cats/?27660', 'Esse ipsa ex distinctio voluptatem qui dolor. Temporibus iste harum voluptas perspiciatis ex cumque. Reprehenderit nisi ea sunt doloribus.', 'Other', 196, 8, 43, 30, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(15, 'bk3273903', 'Dolor reprehenderit praesentium labore velit veniam asperiores minus.', 'Raymond Carter', 5, '9', '5', 'https://lorempixel.com/150/150/cats/?34439', 'Magnam sint veniam et voluptatem maxime ab. Cumque cumque atque consequatur possimus eaque quia corrupti doloribus. Suscipit ipsa excepturi temporibus ut sed voluptatem error.', 'Academic', 75031116, 8, 20, 25, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(16, 'bk8278099', 'Et sit explicabo totam aut vel optio totam optio.', 'Myles Beatty', 8, '6', '10', 'https://lorempixel.com/150/150/cats/?55590', 'Autem non optio expedita unde quidem aut unde fugiat. Eum tempora doloribus ut sint autem. Fuga necessitatibus praesentium voluptas ut perspiciatis.', 'Other', 939145825, 1, 8, 25, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(17, 'bk3483184', 'Quae facere sapiente eum quaerat officiis.', 'Bettye Berge', 5, '11', '9', 'https://lorempixel.com/150/150/cats/?31734', 'A praesentium placeat nemo fugit in. Unde unde voluptatem sit. Atque sunt a vero optio.', 'Story', 571761125, 7, 15, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(18, 'bk72752', 'Voluptatem libero quia aperiam quia possimus.', 'Okey Mante', 19, '4', '10', 'https://lorempixel.com/150/150/cats/?49529', 'Aliquam mollitia optio non deserunt earum accusantium quisquam. Eum adipisci cum quam molestiae. Nesciunt reiciendis pariatur dolore et perferendis molestiae.', 'Other', 451111, 4, 8, 27, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(19, 'bk8209628', 'Voluptas pariatur odio doloribus molestias suscipit voluptas adipisci.', 'Lula Fahey PhD', 5, '8', '11', 'https://lorempixel.com/150/150/cats/?98687', 'Ex et perspiciatis nihil aut velit. Quia alias harum perferendis voluptas eaque. Magnam ab fuga cupiditate doloribus et dolores.', 'Story', 8, 11, 14, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(20, 'bk6324613', 'Nemo commodi occaecati quam nostrum natus saepe minus.', 'Dr. Ivah Schaefer', 13, '6', '5', 'https://lorempixel.com/150/150/cats/?13406', 'Quisquam nihil aut est quia. Rerum dolores sed voluptatem ad ut voluptas. Praesentium magnam possimus aut tempore.', 'Academic', 438583, 2, 39, 29, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(21, 'bk9232209', 'Expedita dolor ea pariatur qui eos.', 'Jevon Becker', 5, '5', '7', 'https://lorempixel.com/150/150/cats/?77579', 'Nihil quidem ut eaque dolor totam qui rerum repellat. Non non temporibus libero quia. Sint laborum quis praesentium consequatur.', 'Academic', 32763, 6, 23, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(22, 'bk6681180', 'Inventore et laboriosam sapiente facere autem.', 'Dr. Wayne Towne Sr.', 13, '7', '12', 'https://lorempixel.com/150/150/cats/?89758', 'Aut ipsam commodi atque quas aut beatae quis eveniet. Ad consectetur rerum consequatur voluptatem distinctio impedit et. At corrupti odit excepturi pariatur in sed.', 'Magazine', 237623388, 7, 47, 30, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(23, 'bk7438097', 'Ipsam labore possimus nisi voluptas.', 'Davion Bernhard', 19, '7', '7', 'https://lorempixel.com/150/150/cats/?11350', 'Ipsum enim eos omnis possimus eum. Sunt maxime qui sit in accusantium aut consequuntur. Officiis architecto neque ea.', 'Story', 337, 7, 37, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(24, 'bk3375551', 'Vitae consequuntur quisquam quos quis est fugit ea.', 'Abner Erdman', 5, '9', '12', 'https://lorempixel.com/150/150/cats/?98037', 'Ut unde consequatur perspiciatis sit voluptatem. Dolorem rerum qui ut aliquam maiores. A blanditiis perspiciatis aut voluptatibus perferendis.', 'Academic', 7275, 1, 9, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(25, 'bk30813', 'Nemo cumque aspernatur vel fuga.', 'Mya Ankunding Sr.', 19, '7', '8', 'https://lorempixel.com/150/150/cats/?94772', 'Aliquam non et praesentium. Exercitationem odit at quis est. Ipsam rerum fugiat totam ipsam.', 'Academic', 9336210, 10, 33, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(26, 'bk2463570', 'Omnis ratione reiciendis qui vero consequatur quia non voluptates.', 'Carley Marquardt', 8, '12', '2', 'https://lorempixel.com/150/150/cats/?65130', 'Qui aut dolores velit laboriosam dolore qui. Voluptas dolor ea ut labore alias et. Dolor quos id quibusdam voluptas ipsa odit id.', 'Academic', 37, 7, 51, 22, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(27, 'bk4089420', 'Sed quisquam quos doloribus vero sit eos.', 'Shanelle Bartell', 19, '8', '2', 'https://lorempixel.com/150/150/cats/?12752', 'Officia est occaecati aut ut et id dolores. Quo exercitationem enim facilis est eum blanditiis ad. Et dolore quam dolores voluptatem corrupti sed beatae.', 'Story', 5453313, 10, 25, 22, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(28, 'bk1535746', 'Atque fuga officia in.', 'Leslie Bednar', 19, '12', '8', 'https://lorempixel.com/150/150/cats/?45289', 'Pariatur rerum odio neque eos. Voluptas corrupti sit sed quo. Aut quisquam voluptas nam labore.', 'Academic', 46, 9, 34, 25, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(29, 'bk6931455', 'Non cumque asperiores non sit.', 'Alda Schultz', 13, '2', '9', 'https://lorempixel.com/150/150/cats/?19943', 'Incidunt dolore ipsum cumque error. Adipisci ab est magni quas quis atque. Accusamus architecto fugit quia esse.', 'Story', 743414, 1, 8, 27, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(30, 'bk9334799', 'Eos dolorum provident nisi consequatur sequi.', 'Marilou Kutch', 34, '8', '7', 'https://lorempixel.com/150/150/cats/?80784', 'Dignissimos atque quia fugiat eligendi vel. Quasi porro illo deleniti porro quisquam. Aut consequuntur perferendis quos inventore aut aut culpa.', 'Other', 25253, 7, 11, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(31, 'bk5531104', 'Est sit asperiores nihil.', 'Beth Bode', 13, '9', '9', 'https://lorempixel.com/150/150/cats/?41124', 'Temporibus magnam hic repellat debitis. Ducimus architecto accusantium quaerat harum odit. Magni iste distinctio ex.', 'Story', 3250, 3, 26, 22, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(32, 'bk7547862', 'Officiis est voluptatem id.', 'Meagan Abbott', 5, '5', '2', 'https://lorempixel.com/150/150/cats/?25531', 'Deleniti ut eius laudantium odio. Ea eaque voluptas doloremque adipisci. Est cumque ut non.', 'Academic', 8375329, 8, 15, 29, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(33, 'bk2576842', 'Sint laboriosam occaecati et rerum incidunt voluptatem amet.', 'Lea Baumbach PhD', 8, '3', '4', 'https://lorempixel.com/150/150/cats/?16294', 'Perferendis consequatur consequatur qui suscipit. Sit et perferendis iure quaerat earum similique. Rerum quaerat laudantium sit voluptas qui.', 'Story', 17, 10, 4, 31, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(34, 'bk9965877', 'Impedit assumenda et sint voluptas repudiandae.', 'Prof. Willa Haag', 8, '9', '3', 'https://lorempixel.com/150/150/cats/?96396', 'Nemo suscipit ut quia. Omnis exercitationem est facere dignissimos placeat. Rerum quas consequuntur unde tempore.', 'Story', 72920069, 3, 19, 22, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(35, 'bk1235792', 'Molestiae repellat repudiandae amet.', 'Mrs. Lenora Trantow Jr.', 5, '3', '7', 'https://lorempixel.com/150/150/cats/?68053', 'Natus harum id ut accusantium et atque reiciendis. Vitae et quia minima sapiente. Aut aut alias aperiam at facere quaerat.', 'Magazine', 9691, 3, 8, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(36, 'bk6122609', 'Sapiente velit a omnis nemo dignissimos unde rerum consequatur.', 'Mr. Garrett Oberbrunner', 13, '7', '1', 'https://lorempixel.com/150/150/cats/?71731', 'Unde maxime aspernatur omnis nostrum magnam culpa blanditiis. Et dolorum qui explicabo. Modi vel mollitia consequatur qui ut.', 'Academic', 58, 1, 29, 22, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(37, 'bk629530', 'Placeat accusantium quae nisi.', 'Nelson Rohan', 13, '10', '6', 'https://lorempixel.com/150/150/cats/?75122', 'Qui at vero voluptatem dolorem. Totam sed autem rem veniam aliquid qui facere qui. Praesentium eos culpa provident voluptas et accusamus nemo.', 'Magazine', 533940889, 4, 37, 29, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(38, 'bk6431166', 'Iste minus qui aut aspernatur est voluptas vel.', 'Mortimer Klocko', 8, '5', '11', 'https://lorempixel.com/150/150/cats/?38388', 'Repudiandae dolores alias at quia est et. Sed qui voluptatem placeat. Corporis corporis quis et aliquam quis non.', 'Academic', 384113, 13, 28, 25, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(39, 'bk3401165', 'Eius eius aut totam dolores explicabo aut.', 'Stephan Emard', 8, '6', '7', 'https://lorempixel.com/150/150/cats/?68601', 'Eum quis eum id cumque. Sed ratione itaque suscipit sit. Soluta amet rerum porro quibusdam eum.', 'Other', 5, 12, 7, 31, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(40, 'bk5294887', 'Suscipit repellat earum ipsum et.', 'Clinton Osinski', 5, '9', '3', 'https://lorempixel.com/150/150/cats/?60125', 'Aspernatur optio tempora et quia aut. Eum possimus quis nostrum non vel est. Adipisci dolor debitis at illo.', 'Other', 738574436, 3, 35, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(41, 'bk3346875', 'Ad reprehenderit et adipisci et rem.', 'Mr. Trystan Dibbert III', 8, '1', '2', 'https://lorempixel.com/150/150/cats/?15961', 'Vero libero ad recusandae quis molestiae consectetur consequuntur. Officiis odit quisquam neque sequi error ea omnis praesentium. Vel quia quibusdam nostrum accusamus sunt voluptas ut.', 'Academic', 7, 6, 45, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(42, 'bk8826311', 'Officiis ea impedit sit saepe.', 'Mr. Dorian Bernhard', 5, '10', '12', 'https://lorempixel.com/150/150/cats/?29832', 'Nihil ut commodi mollitia rerum sapiente. Aliquam velit quidem mollitia ipsa ut voluptatum velit. Optio quibusdam cum officia velit.', 'Magazine', 20430, 6, 26, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(43, 'bk1541827', 'Facere ducimus aut aspernatur ut.', 'Ozella Schowalter V', 8, '10', '9', 'https://lorempixel.com/150/150/cats/?76251', 'Aut ratione provident ut et quo eos quam provident. Aut distinctio voluptas omnis soluta. Ut amet voluptatum soluta quo deleniti.', 'Academic', 53, 3, 41, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(44, 'bk7263877', 'Eligendi ipsam recusandae natus ab aspernatur quos.', 'Mrs. Laurine Grimes', 5, '10', '4', 'https://lorempixel.com/150/150/cats/?48609', 'Et et assumenda labore amet aut soluta et. Architecto vel vitae aut eum illum odio et. Ex corporis ab vel rerum qui.', 'Academic', 987210, 5, 19, 27, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(45, 'bk2874762', 'Est quia ipsam dolor aliquid qui adipisci.', 'Amara Kreiger MD', 34, '8', '8', 'https://lorempixel.com/150/150/cats/?26257', 'Temporibus qui ut et repellat ut placeat. Voluptas unde pariatur cumque est minima. Id libero cumque laborum nihil.', 'Magazine', 99, 10, 40, 23, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(46, 'bk8574458', 'Corrupti iste voluptas vel amet possimus.', 'Genesis Dickens', 8, '3', '8', 'https://lorempixel.com/150/150/cats/?50366', 'Ipsum saepe beatae dolore facere minima animi id. Id illo et praesentium illum eum eum. Nesciunt beatae commodi et saepe enim voluptatum in eos.', 'Magazine', 7575021, 1, 19, 26, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(47, 'bk8094719', 'Est nemo veniam voluptas voluptas.', 'Ms. Sylvia Marquardt III', 19, '3', '11', 'https://lorempixel.com/150/150/cats/?71714', 'Recusandae quibusdam molestiae blanditiis fuga. Rerum placeat corrupti nisi nam harum suscipit. Placeat ut ut quidem.', 'Academic', 4832, 3, 11, 25, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(48, 'bk7932219', 'Quis reprehenderit impedit autem explicabo et nostrum eveniet.', 'Sabina Dooley', 13, '11', '7', 'https://lorempixel.com/150/150/cats/?39406', 'Ullam molestiae earum maiores voluptate tempore. Architecto rerum natus praesentium architecto id delectus voluptatum omnis. Voluptatem corrupti consequatur et deleniti.', 'Academic', 9946, 7, 32, 30, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(49, 'bk8177092', 'Libero quidem minus maiores consequatur recusandae magnam.', 'Stanley Glover', 34, '7', '10', 'https://lorempixel.com/150/150/cats/?33536', 'Nostrum vel hic temporibus officia autem. Eos cum perferendis aliquam vel voluptatem omnis. Repellendus veritatis magni odio.', 'Academic', 6314257, 2, 3, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01'),
(50, 'bk8282635', 'Consequatur quidem voluptatem aut expedita rerum eveniet qui.', 'Kianna Kertzmann', 8, '9', '4', 'https://lorempixel.com/150/150/cats/?88441', 'Aut vel ullam sint. Distinctio mollitia omnis earum rerum. Officiis expedita quia ab.', 'Academic', 3, 11, 39, 28, '2020-10-28 06:24:01', '2020-10-28 06:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `school_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Good', 1, '2020-12-31 09:50:57', '2020-12-31 11:08:09'),
(3, 1, 'Blue', 1, '2021-01-04 07:33:03', '2021-01-04 08:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_to` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `created_at`, `updated_at`, `file_path`, `title`, `given_to`, `active`, `school_id`, `user_id`) VALUES
(1, '2020-10-28 06:24:21', '2020-10-28 06:24:21', 'https://turner.com/et-velit-et-odio-sit.html', 'Ipsa qui non aspernatur maxime quam modi quia.', 5202467, 0, 24, 108),
(2, '2020-10-28 06:24:21', '2020-10-28 06:24:21', 'http://bogisich.info/placeat-consequuntur-deserunt-dolores-deleniti-distinctio-optio-cupiditate', 'Expedita sit illum commodi vitae maiores repellendus.', 2253136, 1, 50, 85),
(3, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://harber.biz/quaerat-soluta-tempora-blanditiis-blanditiis', 'Blanditiis aut voluptatem ipsum autem veniam.', 8807394, 0, 13, 173),
(4, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.fay.com/et-id-quidem-maxime-in-ut-repudiandae', 'Consequatur officia adipisci officia architecto.', 5486484, 1, 27, 196),
(5, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.heidenreich.org/consequatur-sapiente-blanditiis-vel-ut', 'Placeat rerum eius quod incidunt.', 6326221, 1, 30, 8),
(6, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://olson.com/', 'Fuga et nam ipsa voluptas.', 7883688, 0, 19, 228),
(7, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://donnelly.com/', 'Qui aliquam labore vitae minus eum reprehenderit.', 6326221, 1, 18, 86),
(8, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://dickinson.com/et-consectetur-veniam-iusto-facere-optio-dicta-et', 'Assumenda quaerat eligendi eius odio.', 6284574, 1, 36, 35),
(9, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.kihn.net/', 'Quas itaque quo quod.', 1076681, 1, 47, 67),
(10, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.daugherty.com/odit-inventore-facere-repellat-iste-repudiandae-quisquam-voluptate.html', 'Quo ipsa ducimus aut rerum accusantium id iusto.', 4153705, 1, 12, 221),
(11, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.hand.com/saepe-quia-et-et-nobis-laudantium.html', 'Numquam ab eos saepe consequatur et vel quia.', 3814034, 0, 48, 55),
(12, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://kirlin.com/consequatur-aut-provident-minima-saepe-adipisci-aut-nemo-mollitia.html', 'Alias eligendi ipsam voluptatem corrupti voluptatem.', 1373799, 0, 28, 215),
(13, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.botsford.com/dolores-maiores-quo-excepturi-reprehenderit-cumque', 'Doloremque est rem occaecati qui saepe fuga dignissimos recusandae.', 765807, 0, 23, 224),
(14, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.gaylord.com/rerum-fuga-ipsa-expedita-tempora', 'Eligendi commodi necessitatibus quod perferendis minima.', 3904042, 0, 3, 218),
(15, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.russel.net/et-asperiores-reiciendis-aut-sit-laudantium-itaque-qui.html', 'Odio maxime natus odio soluta non.', 1954445, 0, 5, 54),
(16, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://bartoletti.com/consequatur-recusandae-dolorum-vel-sequi-cumque-ea', 'Similique dicta impedit suscipit voluptatibus voluptatem.', 2136437, 1, 37, 171),
(17, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://johnson.com/minus-quidem-facilis-minima-error-ut-omnis.html', 'Necessitatibus nihil voluptate ut laudantium.', 5128255, 1, 13, 110),
(18, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://christiansen.net/ea-dolor-dolores-numquam', 'Et recusandae recusandae sint exercitationem nostrum quaerat aut.', 5293452, 1, 46, 206),
(19, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://schultz.com/sint-natus-optio-quaerat-aut-consequatur', 'Est nam asperiores fugiat odit dolores maxime.', 2281988, 1, 49, 28),
(20, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.hoeger.com/itaque-et-quia-cupiditate-enim-culpa-ut', 'Est amet dolorum natus ex aut.', 4920151, 1, 24, 228),
(21, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.walter.com/quo-mollitia-sed-dolores-dolorem.html', 'Quibusdam ipsum voluptates ut ut aut dolores.', 4486827, 1, 13, 199),
(22, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.brakus.com/nisi-aliquid-quis-accusamus-est', 'Excepturi aliquid ad et dolor.', 6296949, 1, 8, 2),
(23, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.okuneva.org/est-deleniti-nihil-ab-velit.html', 'Rerum expedita omnis voluptatibus excepturi.', 3511245, 0, 4, 177),
(24, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.beer.com/labore-rem-saepe-sequi-quibusdam-illum', 'Aspernatur ut est natus quod vitae.', 1076681, 1, 35, 82),
(25, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://osinski.com/', 'Quidem suscipit hic qui doloribus qui aut accusantium.', 689293, 1, 37, 23),
(26, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.veum.com/aliquam-asperiores-omnis-magni-et-recusandae.html', 'Modi nemo minus ipsa.', 7606811, 1, 21, 211),
(27, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://grimes.com/voluptatum-exercitationem-magni-placeat-quae-molestiae', 'Cumque consequatur quos consectetur distinctio ipsum.', 6949307, 0, 27, 113),
(28, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://goyette.com/illum-sit-ad-saepe-ratione-voluptate-sit-maxime.html', 'Et totam autem porro error neque qui ut nisi.', 709312, 1, 39, 46),
(29, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.stark.com/voluptatem-rem-at-nihil-culpa-voluptatem', 'Quam voluptas deserunt nulla animi sapiente quae.', 2036656, 1, 27, 257),
(30, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.konopelski.com/voluptate-delectus-adipisci-et', 'Consequuntur sint culpa omnis reprehenderit voluptatem sed omnis.', 8557557, 0, 36, 92),
(31, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://yost.info/vitae-dicta-est-quia-sint-est.html', 'Quisquam excepturi aut amet cupiditate.', 34914, 0, 8, 113),
(32, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://kautzer.info/velit-rerum-praesentium-autem-cupiditate', 'Atque amet quasi tempore velit qui minus.', 4964603, 1, 44, 184),
(33, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://bradtke.com/deserunt-quisquam-nulla-possimus-aut-et.html', 'Aut asperiores laborum quibusdam quae laudantium quis consequatur maxime.', 3664500, 1, 17, 197),
(34, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'https://www.lindgren.com/ipsa-voluptas-qui-voluptas', 'Ut vitae eligendi molestiae molestiae doloribus sunt quasi.', 8123404, 0, 10, 242),
(35, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://kuhlman.biz/et-occaecati-distinctio-eum', 'Suscipit et sed modi eaque.', 1137277, 1, 46, 187),
(36, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.hartmann.com/architecto-voluptatum-suscipit-eius-rerum-omnis-quidem', 'Et perspiciatis suscipit nesciunt nihil libero aut temporibus quos.', 2281988, 0, 26, 10),
(37, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://www.powlowski.com/inventore-totam-officia-voluptates-eaque-laudantium-enim-id', 'Labore incidunt ipsa facere sed similique.', 5768075, 0, 34, 30),
(38, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://hessel.com/est-ipsa-vero-temporibus-numquam-quod-quia-quas-voluptatem', 'Consequatur magnam nihil magnam dicta aperiam impedit.', 5959945, 1, 10, 221),
(39, '2020-10-28 06:24:22', '2020-10-28 06:24:22', 'http://tillman.com/', 'Occaecati esse voluptatem eum vel nisi eligendi quisquam odio.', 5300341, 1, 28, 203),
(40, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'https://www.kuhic.com/quia-consequatur-nesciunt-molestias-perferendis-sapiente', 'Qui et corrupti qui sed.', 8104302, 0, 46, 1),
(41, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://www.nitzsche.com/quam-aut-cum-eos-in-aut-iste-ratione.html', 'Et velit ut nemo quod provident.', 2253136, 0, 32, 57),
(42, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://lakin.biz/quos-non-et-et-incidunt.html', 'Suscipit atque placeat officiis aut ut nemo magni.', 336996, 1, 33, 236),
(43, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://lang.net/', 'Eum suscipit non eum sed cumque eum.', 3246019, 1, 50, 91),
(44, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://harber.com/provident-rem-corporis-dignissimos', 'Corporis tempore voluptatibus cum aut.', 5768075, 1, 9, 245),
(45, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://www.eichmann.com/consectetur-quia-non-eligendi', 'Velit vero quis sit non tenetur iusto veniam fuga.', 4003335, 0, 22, 55),
(46, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://koelpin.biz/sapiente-incidunt-similique-et-laboriosam.html', 'Nisi magnam ea laborum qui.', 8999766, 0, 13, 43),
(47, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://hackett.info/', 'Ducimus quidem ut animi quia in hic.', 6397436, 1, 6, 221),
(48, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://www.abernathy.com/itaque-neque-illum-consequuntur-odit.html', 'Natus qui aut quis dolorem.', 9142896, 1, 46, 231),
(49, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'http://trantow.com/est-nihil-quia-dolor-ut.html', 'Iure ipsum labore officia et eos consequatur.', 6404180, 1, 42, 91),
(50, '2020-10-28 06:24:23', '2020-10-28 06:24:23', 'https://www.volkman.biz/quam-odit-fuga-exercitationem-id', 'Impedit unde ipsa et ut voluptatem asperiores quis.', 2341800, 1, 26, 33);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `class_number`, `school_id`, `group`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Zero', '0', 1, '', 1, '2020-10-28 06:23:22', '2021-01-17 11:45:39'),
(2, 'One', '1', 1, 'Sc', 1, '2020-10-28 06:23:22', '2021-01-17 09:16:55'),
(3, 'Two', '2', 1, '', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(4, 'Three', '3', 1, '', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(5, 'Four', '4', 1, '', 1, '2020-10-28 06:23:22', '2020-12-01 07:57:03'),
(6, 'Five', '5', 1, '', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(7, 'Six', '6', 1, '', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(8, 'Seven', '7', 1, '', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(9, 'Eight', '8', 1, 'arts', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(10, 'Nine', '9', 1, 'arts', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(11, 'Ten', '10', 1, 'science', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(12, 'Eleven', '11', 1, 'commerce', 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(13, 'Twelve', '12', 1, 'arts', 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(14, 'Grade 1', 'Grade 1', 1, 'ff', 1, '2020-11-18 05:48:19', '2020-11-18 05:48:19'),
(15, 'Grade 2', 'Grade 2', 1, 'dfdf', 1, '2020-11-18 06:09:40', '2020-11-18 06:09:40'),
(16, 'Grade 3', 'Grade 3', 1, 'fgfg', 1, '2020-11-18 06:30:13', '2020-11-18 06:30:13'),
(17, 'One', '1', 2, '', 1, '2020-12-21 07:18:18', '2020-12-21 07:18:18'),
(18, 'Play', '14', 1, '', 1, '2021-01-17 09:10:48', '2021-01-17 09:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `religon` tinyint(4) DEFAULT NULL,
  `dob` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bloodgroup` tinyint(4) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marritalstatus` tinyint(4) DEFAULT NULL,
  `startdate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enddate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `nationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `school_id`, `name`, `gender`, `religon`, `dob`, `bloodgroup`, `email`, `nid`, `mobile`, `profession`, `education`, `image`, `priority`, `designation`, `marritalstatus`, `startdate`, `enddate`, `father_name`, `mother_name`, `address`, `status`, `nationality`, `created_at`, `updated_at`) VALUES
(6, 1, 'Xyla Malone', 2, 1, '2020-12-01', 2, 'jawuny@mailinator.com', 'Nisi provident qui', '2025588', 'Aut doloribus nisi n', 'Ut voluptas sunt su', NULL, NULL, '2', 2, '2020-12-07', '1970-01-01', 'Patrick Hudson', 'Avram Wynn', 'Architecto sunt et c', 1, '114', '2020-12-15 05:34:55', '2020-12-15 05:35:19'),
(7, 1, 'Latifah Donovan', 1, 1, '2020-12-07', 4, 'sazixup@mailinator.com', 'Dolor laborum Asper', 'Sint dolore sed recu', 'Tempora minim ex asp', 'Consequuntur rerum c', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/SC/1609573768.png', NULL, '8', 1, '1970-01-01', '1970-01-01', 'Hamilton Frost', 'Giacomo Valentine', 'Quaerat tempor ea id', 1, '153', '2020-12-15 07:04:48', '2021-01-02 07:49:28'),
(8, 1, 'Winifred Collier', 1, 5, '2020-23-12', 1, 'bodanizod@mailinator.com', 'Quis ea inventore in', 'Hic magna assumenda', 'Ea consequuntur sapi', 'Minus ea perferendis', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/SC/1608018875.png', NULL, '4', 1, '1986-23-10', '1988-23-03', 'Melanie Hubbard', 'Duncan Parks', 'Culpa qui eaque aspe', 1, '157', '2020-12-15 07:54:36', '2020-12-15 07:54:36'),
(9, 1, 'Suki Torres', 2, 5, '2014-15-03', 4, 'zigak@mailinator.com', 'Nostrum mollit maior', 'Earum non mollit qui', 'Esse ducimus est p', 'Ut tempore sit pos', '', NULL, '8', 2, '2009-12-02', '1975-03-06', 'Wade Ewing', 'Julian Mills', 'Voluptate proident', 1, '94', '2020-12-15 08:06:46', '2020-12-15 08:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactnumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `school_id`, `name`, `contactnumber`, `email`, `description`, `ip_address`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Amethyst Sellers', '535355353535353535', 'fadubak@mailinator.com', 'Quod lorem ut molest', '192.168.0.103', 'Xfghjkkjhgfd', 1, '2020-12-26 11:08:32', '2020-12-26 12:07:27'),
(2, 1, 'Indigo Estes', '730', 'nacegyki@mailinator.com', 'olore suscipiNobis dolore suscipiNobis dolore suscipiNobis dolore suscipiNobis dolore suscipi', '192.168.0.109', 'sczxczxczxc sczxczxczxc sczxczxczxc sczxczxczxc sczxczxczxc', 1, '2020-12-26 12:11:53', '2020-12-26 12:27:00'),
(5, 1, 'Mufutau Hubbard', '951', 'dytysopy@mailinator.com', 'Error quisquam vitae', '192.168.0.108', 'ok', 1, '2021-01-17 11:16:51', '2021-03-01 05:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `school_id`, `name`, `email`, `phone`, `subject`, `message`, `ip_address`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'MD. EMRUL HASSAN', 'emrul.01745@gmail.com', '01745371324', 'fghhhjj', 'ghghghgx', '192.168.0.105', 'cccsccscs', '2020-12-23 10:25:36', '2020-12-26 12:06:56'),
(4, 1, 'Clark Manning', 'teva@mailinator.com', '+1 (277) 338-9598', 'Fugiat velit quam e', 'Voluptatem numquam q', '192.168.0.103', NULL, '2020-12-24 08:28:20', '2020-12-24 08:28:20'),
(5, 1, 'Fuller Levine', 'jiwu@mailinator.com', '+1 (595) 729-3257', 'Totam cupidatat aute', 'Animi et dolore eli', '192.168.0.108', NULL, '2021-01-17 11:19:56', '2021-01-17 11:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `currency` varchar(30) COLLATE utf8_bin NOT NULL,
  `rate` float NOT NULL,
  `code` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `iso_code_3` varchar(3) COLLATE utf8_bin NOT NULL DEFAULT '',
  `nationality` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `currency`, `rate`, `code`, `iso_code_3`, `nationality`, `status`) VALUES
(1, 'United States (USA)', 'USD', 85.3, 'AS', 'ASM', 'American', '2'),
(2, 'Afghanistan', 'USD', 0, 'AF', 'AFG', 'Afghan', '1'),
(3, 'Albania', 'USD', 0, 'AL', 'ALB', 'Albanian', '1'),
(4, 'Algeria', 'USD', 0, 'DZ', 'DZA', 'Algerian', '1'),
(5, 'Andorra', 'USD', 0, 'AD', 'AND', 'Andorran', '1'),
(6, 'Angola', 'USD', 0, 'AO', 'AGO', 'Angolan', '1'),
(7, 'Anguilla', 'USD', 0, 'AI', 'AIA', 'Antiguans', '1'),
(8, 'Antarctica', 'USD', 0, 'AQ', 'ATA', NULL, '1'),
(9, 'Antigua and Barbuda', 'USD', 0, 'AG', 'ATG', NULL, '1'),
(10, 'Argentina', 'USD', 0, 'AR', 'ARG', 'Argentinean', '1'),
(11, 'Armenia', 'USD', 0, 'AM', 'ARM', 'Armenian', '1'),
(12, 'Aruba', 'USD', 0, 'AW', 'ABW', NULL, '1'),
(13, 'Australia', 'USD', 0, 'AU', 'AUS', 'Australian', '1'),
(14, 'Austria', 'USD', 0, 'AT', 'AUT', 'Austrian', '1'),
(15, 'Azerbaijan', 'USD', 0, 'AZ', 'AZE', 'Azerbaijani', '1'),
(16, 'Bahamas', 'USD', 0, 'BS', 'BHS', 'Bahamian', '1'),
(17, 'Bahrain', 'USD', 0, 'BH', 'BHR', 'Bahraini', '1'),
(18, 'Bangladesh', 'BDT', 0, 'BD', 'BGD', 'Bangladeshi', '1'),
(19, 'Barbados', 'USD', 0, 'BB', 'BRB', 'Barbadian', '1'),
(20, 'Belarus', 'USD', 0, 'BY', 'BLR', 'Belarusian', '1'),
(21, 'Belgium', 'USD', 0, 'BE', 'BEL', 'Belgian', '1'),
(22, 'Belize', 'USD', 0, 'BZ', 'BLZ', 'Belizean', '1'),
(23, 'Benin', 'USD', 0, 'BJ', 'BEN', 'Beninese', '1'),
(24, 'Bermuda', 'USD', 0, 'BM', 'BMU', NULL, '1'),
(25, 'Bhutan', 'USD', 0, 'BT', 'BTN', 'Bhutanese', '1'),
(26, 'Bolivia', 'USD', 0, 'BO', 'BOL', 'Bolivian', '1'),
(27, 'Bosnia and Herzegowina', 'USD', 0, 'BA', 'BIH', 'Bosnian', '1'),
(28, 'Botswana', 'USD', 0, 'BW', 'BWA', NULL, '1'),
(29, 'Bouvet Island', 'USD', 0, 'BV', 'BVT', NULL, '1'),
(30, 'Brazil', 'USD', 0, 'BR', 'BRA', 'Brazilian', '1'),
(31, 'British Indian Ocean Territory', 'USD', 0, 'IO', 'IOT', 'British', '1'),
(32, 'Brunei Darussalam', 'USD', 0, 'BN', 'BRN', 'Bruneian', '1'),
(33, 'Bulgaria', 'USD', 0, 'BG', 'BGR', 'Bulgarian', '1'),
(34, 'Burkina Faso', 'USD', 0, 'BF', 'BFA', 'Burkinabe', '1'),
(35, 'Burundi', 'USD', 0, 'BI', 'BDI', 'Burundian', '1'),
(36, 'Cambodia', 'USD', 0, 'KH', 'KHM', 'Cambodian', '1'),
(37, 'Cameroon', 'USD', 0, 'CM', 'CMR', 'Cameroonian', '1'),
(38, 'Canada', 'USD', 0, 'CA', 'CAN', 'Canadian', '1'),
(39, 'Cape Verde', 'USD', 0, 'CV', 'CPV', 'Cape Verdean', '1'),
(40, 'Cayman Islands', 'USD', 0, 'KY', 'CYM', NULL, '1'),
(41, 'Central African Republic', 'USD', 0, 'CF', 'CAF', 'Central African', '1'),
(42, 'Chad', 'USD', 0, 'TD', 'TCD', 'Chadian', '1'),
(43, 'Chile', 'USD', 0, 'CL', 'CHL', 'Chilean', '1'),
(44, 'China', 'USD', 0, 'CN', 'CHN', 'Chinese', '1'),
(45, 'Christmas Island', 'USD', 0, 'CX', 'CXR', NULL, '1'),
(46, 'Cocos (Keeling) Islands', 'USD', 0, 'CC', 'CCK', NULL, '1'),
(47, 'Colombia', 'USD', 0, 'CO', 'COL', 'Colombian', '1'),
(48, 'Comoros', 'USD', 0, 'KM', 'COM', 'Comoran', '1'),
(49, 'Congo', 'USD', 0, 'CG', 'COG', 'Congolese', '1'),
(50, 'Cook Islands', 'USD', 0, 'CK', 'COK', NULL, '1'),
(51, 'Costa Rica', 'USD', 0, 'CR', 'CRI', 'Costa Rican', '1'),
(52, 'Cote D\'Ivoire', 'USD', 0, 'CI', 'CIV', NULL, '1'),
(53, 'Croatia', 'USD', 0, 'HR', 'HRV', 'Croatian', '1'),
(54, 'Cuba', 'USD', 0, 'CU', 'CUB', 'Cuban', '1'),
(55, 'Cyprus', 'USD', 0, 'CY', 'CYP', 'Cypriot', '1'),
(56, 'Czech Republic', 'USD', 0, 'CZ', 'CZE', 'Czech', '1'),
(57, 'Denmark', 'USD', 0, 'DK', 'DNK', 'Danish', '1'),
(58, 'Djibouti', 'USD', 0, 'DJ', 'DJI', 'Djibouti', '1'),
(59, 'Dominica', 'USD', 0, 'DM', 'DMA', 'Dominican', '1'),
(60, 'Dominican Republic', 'USD', 0, 'DO', 'DOM', 'Dominican Republic', '1'),
(61, 'East Timor', 'USD', 0, 'TP', 'TMP', 'East Timorese', '1'),
(62, 'Ecuador', 'USD', 0, 'EC', 'ECU', 'Ecuadorean', '1'),
(63, 'Egypt', 'USD', 0, 'EG', 'EGY', 'Egyptian', '1'),
(64, 'El Salvador', 'USD', 0, 'SV', 'SLV', NULL, '1'),
(65, 'Equatorial Guinea', 'USD', 0, 'GQ', 'GNQ', NULL, '1'),
(66, 'Eritrea', 'USD', 0, 'ER', 'ERI', NULL, '1'),
(67, 'Estonia', 'USD', 0, 'EE', 'EST', NULL, '1'),
(68, 'Ethiopia', 'USD', 0, 'ET', 'ETH', NULL, '1'),
(69, 'Falkland Islands (Malvinas)', 'USD', 0, 'FK', 'FLK', NULL, '1'),
(70, 'Faroe Islands', 'USD', 0, 'FO', 'FRO', NULL, '1'),
(71, 'Fiji', 'USD', 0, 'FJ', 'FJI', NULL, '1'),
(72, 'Finland', 'USD', 0, 'FI', 'FIN', NULL, '1'),
(73, 'France', 'USD', 0, 'FR', 'FRA', NULL, '1'),
(74, 'France, Metropolitan', 'USD', 0, 'FX', 'FXX', NULL, '1'),
(75, 'French Guiana', 'USD', 0, 'GF', 'GUF', NULL, '1'),
(76, 'French Polynesia', 'USD', 0, 'PF', 'PYF', NULL, '1'),
(77, 'French Southern Territories', 'USD', 0, 'TF', 'ATF', NULL, '1'),
(78, 'Gabon', 'USD', 0, 'GA', 'GAB', NULL, '1'),
(79, 'Gambia', 'USD', 0, 'GM', 'GMB', NULL, '1'),
(80, 'Georgia', 'USD', 0, 'GE', 'GEO', NULL, '1'),
(81, 'Germany', 'USD', 0, 'DE', 'DEU', NULL, '1'),
(82, 'Ghana', 'USD', 0, 'GH', 'GHA', NULL, '1'),
(83, 'Gibraltar', 'USD', 0, 'GI', 'GIB', NULL, '1'),
(84, 'Greece', 'USD', 0, 'GR', 'GRC', NULL, '1'),
(85, 'Greenland', 'USD', 0, 'GL', 'GRL', NULL, '1'),
(86, 'Grenada', 'USD', 0, 'GD', 'GRD', NULL, '1'),
(87, 'Guadeloupe', 'USD', 0, 'GP', 'GLP', NULL, '1'),
(88, 'Guam', 'USD', 0, 'GU', 'GUM', NULL, '1'),
(89, 'Guatemala', 'USD', 0, 'GT', 'GTM', NULL, '1'),
(90, 'Guinea', 'USD', 0, 'GN', 'GIN', NULL, '1'),
(91, 'Guinea-bissau', 'USD', 0, 'GW', 'GNB', NULL, '1'),
(92, 'Guyana', 'USD', 0, 'GY', 'GUY', NULL, '1'),
(93, 'Haiti', 'USD', 0, 'HT', 'HTI', NULL, '1'),
(94, 'Heard and Mc Donald Islands', 'USD', 0, 'HM', 'HMD', NULL, '1'),
(95, 'Honduras', 'USD', 0, 'HN', 'HND', NULL, '1'),
(96, 'Hong Kong', 'USD', 0, 'HK', 'HKG', NULL, '1'),
(97, 'Hungary', 'USD', 0, 'HU', 'HUN', NULL, '1'),
(98, 'Iceland', 'USD', 0, 'IS', 'ISL', NULL, '1'),
(99, 'India', 'USD', 0, 'IN', 'IND', NULL, '1'),
(100, 'Indonesia', 'USD', 0, 'ID', 'IDN', NULL, '1'),
(101, 'Iran (Islamic Republic of)', 'USD', 0, 'IR', 'IRN', NULL, '1'),
(102, 'Iraq', 'USD', 0, 'IQ', 'IRQ', NULL, '1'),
(103, 'Ireland', 'USD', 0, 'IE', 'IRL', NULL, '1'),
(104, 'Israel', 'USD', 0, 'IL', 'ISR', NULL, '1'),
(105, 'Italy', 'USD', 0, 'IT', 'ITA', NULL, '1'),
(106, 'Jamaica', 'USD', 0, 'JM', 'JAM', NULL, '1'),
(107, 'Japan', 'USD', 0, 'JP', 'JPN', NULL, '1'),
(108, 'Jordan', 'USD', 0, 'JO', 'JOR', NULL, '1'),
(109, 'Kazakhstan', 'USD', 0, 'KZ', 'KAZ', NULL, '1'),
(110, 'Kenya', 'USD', 0, 'KE', 'KEN', NULL, '1'),
(111, 'Kiribati', 'USD', 0, 'KI', 'KIR', NULL, '1'),
(112, 'North Korea', 'USD', 0, 'KP', 'PRK', NULL, '1'),
(113, 'Korea, Republic of', 'USD', 0, 'KR', 'KOR', NULL, '1'),
(114, 'Kuwait', 'USD', 0, 'KW', 'KWT', NULL, '1'),
(115, 'Kyrgyzstan', 'USD', 0, 'KG', 'KGZ', NULL, '1'),
(116, 'Lao People\'s Democratic Republic', 'USD', 0, 'LA', 'LAO', NULL, '1'),
(117, 'Latvia', 'USD', 0, 'LV', 'LVA', NULL, '1'),
(118, 'Lebanon', 'USD', 0, 'LB', 'LBN', NULL, '1'),
(119, 'Lesotho', 'USD', 0, 'LS', 'LSO', NULL, '1'),
(120, 'Liberia', 'USD', 0, 'LR', 'LBR', NULL, '1'),
(121, 'Libyan Arab Jamahiriya', 'USD', 0, 'LY', 'LBY', NULL, '1'),
(122, 'Liechtenstein', 'USD', 0, 'LI', 'LIE', NULL, '1'),
(123, 'Lithuania', 'USD', 0, 'LT', 'LTU', NULL, '1'),
(124, 'Luxembourg', 'USD', 0, 'LU', 'LUX', NULL, '1'),
(125, 'Macau', 'USD', 0, 'MO', 'MAC', NULL, '1'),
(126, 'Macedonia', 'USD', 0, 'MK', 'MKD', NULL, '1'),
(127, 'Madagascar', 'USD', 0, 'MG', 'MDG', NULL, '1'),
(128, 'Malawi', 'USD', 0, 'MW', 'MWI', NULL, '1'),
(129, 'Malaysia', 'USD', 0, 'MY', 'MYS', NULL, '1'),
(130, 'Maldives', 'USD', 0, 'MV', 'MDV', NULL, '1'),
(131, 'Mali', 'USD', 0, 'ML', 'MLI', NULL, '1'),
(132, 'Malta', 'USD', 0, 'MT', 'MLT', NULL, '1'),
(133, 'Marshall Islands', 'USD', 0, 'MH', 'MHL', NULL, '1'),
(134, 'Martinique', 'USD', 0, 'MQ', 'MTQ', NULL, '1'),
(135, 'Mauritania', 'USD', 0, 'MR', 'MRT', NULL, '1'),
(136, 'Mauritius', 'USD', 0, 'MU', 'MUS', NULL, '1'),
(137, 'Mayotte', 'USD', 0, 'YT', 'MYT', NULL, '1'),
(138, 'Mexico', 'USD', 0, 'MX', 'MEX', NULL, '1'),
(139, 'Micronesia, Federated States of', 'USD', 0, 'FM', 'FSM', NULL, '1'),
(140, 'Moldova, Republic of', 'USD', 0, 'MD', 'MDA', NULL, '1'),
(141, 'Monaco', 'USD', 0, 'MC', 'MCO', NULL, '1'),
(142, 'Mongolia', 'USD', 0, 'MN', 'MNG', NULL, '1'),
(143, 'Montserrat', 'USD', 0, 'MS', 'MSR', NULL, '1'),
(144, 'Morocco', 'USD', 0, 'MA', 'MAR', NULL, '1'),
(145, 'Mozambique', 'USD', 0, 'MZ', 'MOZ', NULL, '1'),
(146, 'Myanmar', 'USD', 0, 'MM', 'MMR', NULL, '1'),
(147, 'Namibia', 'USD', 0, 'NA', 'NAM', NULL, '1'),
(148, 'Nauru', 'USD', 0, 'NR', 'NRU', NULL, '1'),
(149, 'Nepal', 'USD', 0, 'NP', 'NPL', NULL, '1'),
(150, 'Netherlands', 'USD', 0, 'NL', 'NLD', NULL, '1'),
(151, 'Netherlands Antilles', 'USD', 0, 'AN', 'ANT', NULL, '1'),
(152, 'New Caledonia', 'USD', 0, 'NC', 'NCL', NULL, '1'),
(153, 'New Zealand', 'USD', 0, 'NZ', 'NZL', NULL, '1'),
(154, 'Nicaragua', 'USD', 0, 'NI', 'NIC', NULL, '1'),
(155, 'Niger', 'USD', 0, 'NE', 'NER', NULL, '1'),
(156, 'Nigeria', 'USD', 0, 'NG', 'NGA', NULL, '1'),
(157, 'Niue', 'USD', 0, 'NU', 'NIU', NULL, '1'),
(158, 'Norfolk Island', 'USD', 0, 'NF', 'NFK', NULL, '1'),
(159, 'Northern Mariana Islands', 'USD', 0, 'MP', 'MNP', NULL, '1'),
(160, 'Norway', 'USD', 0, 'NO', 'NOR', NULL, '1'),
(161, 'Oman', 'USD', 0, 'OM', 'OMN', NULL, '1'),
(162, 'Pakistan', 'USD', 0, 'PK', 'PAK', NULL, '1'),
(163, 'Palau', 'USD', 0, 'PW', 'PLW', NULL, '1'),
(164, 'Panama', 'USD', 0, 'PA', 'PAN', NULL, '1'),
(165, 'Papua New Guinea', 'USD', 0, 'PG', 'PNG', NULL, '1'),
(166, 'Paraguay', 'USD', 0, 'PY', 'PRY', NULL, '1'),
(167, 'Peru', 'USD', 0, 'PE', 'PER', NULL, '1'),
(168, 'Philippines', 'USD', 0, 'PH', 'PHL', NULL, '1'),
(169, 'Pitcairn', 'USD', 0, 'PN', 'PCN', NULL, '1'),
(170, 'Poland', 'USD', 0, 'PL', 'POL', NULL, '1'),
(171, 'Portugal', 'USD', 0, 'PT', 'PRT', NULL, '1'),
(172, 'Puerto Rico', 'USD', 0, 'PR', 'PRI', NULL, '1'),
(173, 'Qatar', 'USD', 0, 'QA', 'QAT', NULL, '1'),
(174, 'Reunion', 'USD', 0, 'RE', 'REU', NULL, '1'),
(175, 'Romania', 'USD', 0, 'RO', 'ROM', NULL, '1'),
(176, 'Russian Federation', 'USD', 0, 'RU', 'RUS', NULL, '1'),
(177, 'Rwanda', 'USD', 0, 'RW', 'RWA', NULL, '1'),
(178, 'Saint Kitts and Nevis', 'USD', 0, 'KN', 'KNA', NULL, '1'),
(179, 'Saint Lucia', 'USD', 0, 'LC', 'LCA', NULL, '1'),
(180, 'Saint Vincent and the Grenadines', 'USD', 0, 'VC', 'VCT', NULL, '1'),
(181, 'Samoa', 'USD', 0, 'WS', 'WSM', NULL, '1'),
(182, 'San Marino', 'USD', 0, 'SM', 'SMR', NULL, '1'),
(183, 'Sao Tome and Principe', 'USD', 0, 'ST', 'STP', NULL, '1'),
(184, 'Saudi Arabia', 'USD', 0, 'SA', 'SAU', NULL, '1'),
(185, 'Senegal', 'USD', 0, 'SN', 'SEN', NULL, '1'),
(186, 'Seychelles', 'USD', 0, 'SC', 'SYC', NULL, '1'),
(187, 'Sierra Leone', 'USD', 0, 'SL', 'SLE', NULL, '1'),
(188, 'Singapore', 'USD', 0, 'SG', 'SGP', NULL, '1'),
(189, 'Slovak Republic', 'USD', 0, 'SK', 'SVK', NULL, '1'),
(190, 'Slovenia', 'USD', 0, 'SI', 'SVN', NULL, '1'),
(191, 'Solomon Islands', 'USD', 0, 'SB', 'SLB', NULL, '1'),
(192, 'Somalia', 'USD', 0, 'SO', 'SOM', NULL, '1'),
(193, 'South Africa', 'USD', 0, 'ZA', 'ZAF', NULL, '1'),
(194, 'South Georgia &amp; South Sandwich Islands', 'USD', 0, 'GS', 'SGS', NULL, '1'),
(195, 'Spain', 'USD', 0, 'ES', 'ESP', NULL, '1'),
(196, 'Sri Lanka', 'USD', 0, 'LK', 'LKA', NULL, '1'),
(197, 'St. Helena', 'USD', 0, 'SH', 'SHN', NULL, '1'),
(198, 'St. Pierre and Miquelon', 'USD', 0, 'PM', 'SPM', NULL, '1'),
(199, 'Sudan', 'USD', 0, 'SD', 'SDN', NULL, '1'),
(200, 'Suriname', 'USD', 0, 'SR', 'SUR', NULL, '1'),
(201, 'Svalbard and Jan Mayen Islands', 'USD', 0, 'SJ', 'SJM', NULL, '1'),
(202, 'Swaziland', 'USD', 0, 'SZ', 'SWZ', NULL, '1'),
(203, 'Sweden', 'USD', 0, 'SE', 'SWE', NULL, '1'),
(204, 'Switzerland', 'USD', 0, 'CH', 'CHE', NULL, '1'),
(205, 'Syrian Arab Republic', 'USD', 0, 'SY', 'SYR', NULL, '1'),
(206, 'Taiwan', 'USD', 0, 'TW', 'TWN', NULL, '1'),
(207, 'Tajikistan', 'USD', 0, 'TJ', 'TJK', NULL, '1'),
(208, 'Tanzania, United Republic of', 'USD', 0, 'TZ', 'TZA', NULL, '1'),
(209, 'Thailand', 'USD', 0, 'TH', 'THA', NULL, '1'),
(210, 'Togo', 'USD', 0, 'TG', 'TGO', NULL, '1'),
(211, 'Tokelau', 'USD', 0, 'TK', 'TKL', NULL, '1'),
(212, 'Tonga', 'USD', 0, 'TO', 'TON', NULL, '1'),
(213, 'Trinidad and Tobago', 'USD', 0, 'TT', 'TTO', NULL, '1'),
(214, 'Tunisia', 'USD', 0, 'TN', 'TUN', NULL, '1'),
(215, 'Turkey', 'USD', 0, 'TR', 'TUR', NULL, '1'),
(216, 'Turkmenistan', 'USD', 0, 'TM', 'TKM', NULL, '1'),
(217, 'Turks and Caicos Islands', 'USD', 0, 'TC', 'TCA', NULL, '1'),
(218, 'Tuvalu', 'USD', 0, 'TV', 'TUV', NULL, '1'),
(219, 'Uganda', 'USD', 0, 'UG', 'UGA', NULL, '1'),
(220, 'Ukraine', 'USD', 0, 'UA', 'UKR', NULL, '1'),
(221, 'United Arab Emirates', 'USD', 0, 'AE', 'ARE', NULL, '1'),
(222, 'United Kingdom', 'USD', 0, 'GB', 'GBR', NULL, '1'),
(223, 'United States', 'USD', 0, 'US', 'USA', NULL, '1'),
(224, 'United States Minor Outlying Islands', 'USD', 0, 'UM', 'UMI', NULL, '1'),
(225, 'Uruguay', 'USD', 0, 'UY', 'URY', NULL, '1'),
(226, 'Uzbekistan', 'USD', 0, 'UZ', 'UZB', NULL, '1'),
(227, 'Vanuatu', 'USD', 0, 'VU', 'VUT', NULL, '1'),
(228, 'Vatican City State (Holy See)', 'USD', 0, 'VA', 'VAT', NULL, '1'),
(229, 'Venezuela', 'USD', 0, 'VE', 'VEN', NULL, '1'),
(230, 'Viet Nam', 'USD', 0, 'VN', 'VNM', NULL, '1'),
(231, 'Virgin Islands (British)', 'USD', 0, 'VG', 'VGB', NULL, '1'),
(232, 'Virgin Islands (U.S.)', 'USD', 0, 'VI', 'VIR', NULL, '1'),
(233, 'Wallis and Futuna Islands', 'USD', 0, 'WF', 'WLF', NULL, '1'),
(234, 'Western Sahara', 'USD', 0, 'EH', 'ESH', NULL, '1'),
(235, 'Yemen', 'USD', 0, 'YE', 'YEM', NULL, '1'),
(236, 'Yugoslavia', 'USD', 0, 'YU', 'YUG', NULL, '1'),
(237, 'Democratic Republic of Congo', 'USD', 0, 'CD', 'COD', NULL, '1'),
(238, 'Zambia', 'USD', 0, 'ZM', 'ZMB', NULL, '1'),
(239, 'Zimbabwe', 'USD', 0, 'ZW', 'ZWE', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=mandatory,2=optional',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `school_id`, `user_id`, `name`, `code`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 'Bangla 1st Paper', '101', 1, 1, '2021-01-09 10:01:56', '2021-01-17 09:38:21'),
(2, 1, 12, 'Bangla 2nd Paper', '102', 1, 1, '2021-01-09 11:07:30', '2021-01-09 11:07:30'),
(3, 1, 12, 'English 1st Paper', '107', 1, 1, '2021-01-09 11:07:44', '2021-01-09 11:07:44'),
(4, 1, 12, 'English 2nd Paper', '108', 1, 1, '2021-01-09 11:07:49', '2021-01-09 11:07:49'),
(5, 1, 12, 'Math', '109', 1, 1, '2021-01-09 11:07:58', '2021-01-09 11:07:58'),
(6, 1, 12, 'ICT', '154', 1, 1, '2021-01-09 11:08:13', '2021-01-09 11:08:13'),
(7, 1, 12, 'Religion', '111', 1, 1, '2021-01-09 11:08:44', '2021-02-25 02:16:11'),
(8, 1, 12, 'Hindu Studies', '112', 2, 2, '2021-01-09 11:08:53', '2021-02-25 02:15:11'),
(9, 1, 12, 'Physics', '136', 2, 1, '2021-01-09 11:09:32', '2021-01-09 11:10:27'),
(10, 1, 12, 'Chemistry', '137', 2, 1, '2021-01-09 11:09:44', '2021-01-09 11:09:44'),
(11, 1, 12, 'Biology', '138', 2, 1, '2021-01-09 11:09:57', '2021-01-09 11:09:57'),
(12, 1, 12, 'Higher Math', '126', 2, 1, '2021-01-09 11:10:07', '2021-01-09 11:10:07'),
(13, 1, 12, 'Bangladesh and Global Studies', '150', 1, 1, '2021-01-09 11:17:05', '2021-01-09 11:17:05'),
(14, 1, 12, 'CSE', '1143', 2, 1, '2021-01-17 09:39:40', '2021-01-17 09:39:40'),
(15, 1, 12, 'Liberty Lang', '20202', 1, 2, '2021-01-17 09:46:41', '2021-01-17 09:47:44'),
(16, 1, 12, 'Agricultural Studies', '134', 3, 1, '2021-01-18 08:16:16', '2021-01-18 08:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_attendances`
--

CREATE TABLE `course_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `present` tinyint(3) UNSIGNED NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_attendances`
--

INSERT INTO `course_attendances` (`id`, `school_id`, `student_id`, `section_id`, `course_id`, `exam_id`, `user_id`, `present`, `remark`, `created_at`, `updated_at`) VALUES
(17, 1, 66, 17, 16, 1, 12, 1, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26'),
(18, 1, 110, 17, 16, 1, 12, 1, NULL, '2021-03-25 02:35:26', '2021-03-25 12:07:50'),
(19, 1, 124, 17, 16, 1, 12, 1, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26'),
(20, 1, 137, 17, 16, 1, 12, 1, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26'),
(21, 1, 157, 17, 16, 1, 12, 1, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26'),
(22, 1, 210, 17, 16, 1, 12, 0, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26'),
(23, 1, 239, 17, 16, 1, 12, 1, 'late', '2021-03-25 02:35:26', '2021-03-25 12:13:17'),
(24, 1, 267, 17, 16, 1, 12, 0, NULL, '2021-03-25 02:35:26', '2021-03-25 02:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_configs`
--

CREATE TABLE `course_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `grade_system_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quiz_count` int(11) NOT NULL DEFAULT 0,
  `assignment_count` int(11) NOT NULL DEFAULT 0,
  `ct_count` int(11) NOT NULL DEFAULT 0,
  `quiz_percent` int(11) NOT NULL DEFAULT 0,
  `attendance_percent` int(11) NOT NULL DEFAULT 0,
  `assignment_percent` int(11) NOT NULL DEFAULT 0,
  `ct_percent` int(11) NOT NULL DEFAULT 0,
  `final_exam_percent` int(11) NOT NULL DEFAULT 0,
  `practical_percent` int(11) NOT NULL DEFAULT 0,
  `att_fullmark` int(11) NOT NULL DEFAULT 0,
  `quiz_fullmark` int(11) NOT NULL DEFAULT 0,
  `a_fullmark` int(11) NOT NULL DEFAULT 0,
  `ct_fullmark` int(11) NOT NULL DEFAULT 0,
  `final_fullmark` int(11) NOT NULL DEFAULT 0,
  `practical_fullmark` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_configs`
--

INSERT INTO `course_configs` (`id`, `school_id`, `class_id`, `section_id`, `course_id`, `exam_id`, `teacher_id`, `user_id`, `grade_system_name`, `quiz_count`, `assignment_count`, `ct_count`, `quiz_percent`, `attendance_percent`, `assignment_percent`, `ct_percent`, `final_exam_percent`, `practical_percent`, `att_fullmark`, `quiz_fullmark`, `a_fullmark`, `ct_fullmark`, `final_fullmark`, `practical_fullmark`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 1, 16, 1, 32, 12, 'Grade System 1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-03-20 07:17:10', '2021-03-20 07:17:10'),
(2, 1, 9, 17, 16, 1, 32, 12, 'Grade System 1', 1, 1, 1, 5, 5, 10, 20, 50, 10, 30, 20, 20, 20, 50, 10, '2021-03-20 10:32:50', '2021-03-23 10:44:26'),
(3, 1, 9, 8, 16, 1, 32, 12, 'Grade System 1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-03-22 09:04:49', '2021-03-22 09:04:49'),
(4, 1, 9, 8, 1, 1, 32, 12, 'Grade System 1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-04-01 05:03:25', '2021-04-01 05:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `course_groups`
--

CREATE TABLE `course_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optional` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countiAss` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_groups`
--

INSERT INTO `course_groups` (`id`, `school_id`, `name`, `class`, `section`, `course`, `optional`, `countiAss`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Subject Group 1', NULL, NULL, '16,1,2,11,10,3,4,6,7', '11,10', '16', 'For Class Six,Seven,Eight,Nine & Ten', 1, '2021-01-10 05:41:37', '2021-01-18 08:49:44'),
(2, 1, 'Subject Group 2', NULL, NULL, '1,2,3,4,5', NULL, NULL, NULL, 1, '2021-01-10 08:58:46', '2021-01-12 05:00:03'),
(3, 1, 'Subject Group 3', NULL, NULL, '1,2,13,10,9', NULL, NULL, NULL, 1, '2021-01-11 05:26:05', '2021-01-18 08:45:20'),
(4, 1, 'Subject Group 4', NULL, NULL, '11,10,12,6,7,5,9', NULL, NULL, 'For Class Nine & Ten', 1, '2021-01-17 09:52:08', '2021-01-17 09:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_of_education` tinyint(4) NOT NULL,
  `exam_degree_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `level_of_education`, `exam_degree_title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SSC', 1, '2020-11-24 06:49:26', '2020-11-24 06:49:26'),
(2, 1, 'O Level', 1, '2020-11-24 06:51:04', '2020-11-24 07:43:46'),
(3, 1, 'Dakhil (Madrasah)', 1, '2020-11-24 06:53:09', '2020-11-24 06:53:09'),
(4, 1, 'SSC (Vocational)', 1, '2020-11-24 06:54:59', '2020-11-24 06:54:59'),
(5, 1, 'Other', 1, '2020-11-24 07:11:07', '2020-11-24 07:44:37'),
(6, 2, 'HSC', 1, '2020-11-24 07:45:13', '2020-11-24 07:45:13'),
(7, 2, 'A Level', 1, '2020-11-24 07:45:24', '2020-11-24 07:45:24'),
(8, 2, 'Alim (Madrasah)', 1, '2020-11-24 07:45:37', '2020-11-24 07:45:37'),
(9, 2, 'HSC (Vocational)', 1, '2020-11-24 07:45:50', '2020-11-24 07:45:50'),
(10, 2, 'Other', 1, '2020-11-24 07:46:03', '2020-11-24 07:46:03'),
(11, 3, 'Diploma in Engineering', 1, '2020-11-24 07:48:13', '2020-11-24 07:48:13'),
(12, 3, 'Diploma in Medical Technology', 1, '2020-11-24 07:48:21', '2020-11-24 07:48:21'),
(13, 3, 'Diploma in Nursing', 1, '2020-11-24 07:48:34', '2020-11-24 07:48:34'),
(14, 4, 'Bachelor of Science (BSc)', 1, '2020-11-24 07:49:05', '2020-11-24 07:49:05'),
(15, 4, 'Bachelor of Arts (BA)', 1, '2020-11-24 07:49:13', '2020-11-24 07:49:13'),
(16, 4, 'Bachelor of Commerce (BCom)', 1, '2020-11-24 07:49:25', '2020-11-24 07:49:25'),
(17, 4, 'Bachelor of Commerce (Pass)', 1, '2020-11-24 07:49:34', '2020-11-24 07:49:34'),
(18, 5, 'Master of Science (MSc)', 1, '2020-11-24 07:49:53', '2020-11-24 07:49:53'),
(19, 5, 'Master of Arts (MA)', 1, '2020-11-24 07:50:01', '2020-11-24 07:50:01'),
(20, 5, 'Master of Commerce (MCom)', 1, '2020-11-24 07:50:08', '2020-11-24 07:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `school_id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(2, 1, 'English', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22'),
(3, 1, 'Math', 1, '2020-10-28 06:23:22', '2020-10-28 06:23:22');

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

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namebn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `namebn`, `status`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Barisal', 'বরিশাল', 1, 'https://www.codecheef.org/public/editor/kcfinder/upload/images/image-intervention-package-tutorial-in-laravel.jpg', '2019-10-26 03:41:47', '2019-10-26 03:41:47'),
(2, 'Chittagong', 'চট্টগ্রাম', 1, '', '2019-10-26 03:45:28', '2019-10-26 03:45:28'),
(3, 'Dhaka', 'ঢাকা', 1, '', '2019-10-26 03:45:47', '2019-10-26 03:45:47'),
(4, 'Khulna', 'খুলনা', 1, '', '2019-10-26 03:46:17', '2019-10-26 03:46:17'),
(5, 'Rajshahi', 'রাজশাহী', 1, '', '2019-10-26 03:46:33', '2019-10-26 03:46:33'),
(6, 'Rangpur', 'রংপুর', 1, '', '2019-10-26 03:46:46', '2019-10-26 03:46:46'),
(7, 'Sylhet', 'সিলেট', 1, '', '2019-10-26 03:46:58', '2019-10-26 03:46:58'),
(8, 'Mymensingh', 'ময়মনসিংহ', 1, '', '2019-10-26 03:47:11', '2019-10-26 03:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `dues`
--

CREATE TABLE `dues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fee_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=unpaid,2=paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dues`
--

INSERT INTO `dues` (`id`, `school_id`, `user_id`, `class_id`, `section_id`, `student_id`, `fee_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 11, 20, 62, 1, 1, NULL, NULL),
(2, 1, 12, 11, 20, 69, 1, 1, NULL, NULL),
(3, 1, 12, 11, 20, 70, 1, 1, NULL, NULL),
(4, 1, 12, 11, 20, 100, 1, 1, NULL, NULL),
(5, 1, 12, 11, 20, 101, 1, 1, NULL, NULL),
(6, 1, 12, 11, 20, 107, 1, 1, NULL, NULL),
(7, 1, 12, 11, 20, 112, 1, 1, NULL, NULL),
(8, 1, 12, 11, 20, 144, 1, 1, NULL, NULL),
(9, 1, 12, 11, 20, 159, 1, 1, NULL, NULL),
(10, 1, 12, 11, 20, 166, 1, 1, NULL, NULL),
(11, 1, 12, 11, 20, 178, 1, 1, NULL, NULL),
(12, 1, 12, 11, 20, 188, 1, 1, NULL, NULL),
(13, 1, 12, 11, 20, 247, 1, 1, NULL, NULL),
(14, 1, 12, 11, 20, 62, 2, 1, NULL, NULL),
(15, 1, 12, 11, 20, 69, 2, 1, NULL, NULL),
(16, 1, 12, 11, 20, 70, 2, 1, NULL, NULL),
(17, 1, 12, 11, 20, 100, 2, 1, NULL, NULL),
(18, 1, 12, 11, 20, 101, 2, 1, NULL, NULL),
(19, 1, 12, 11, 20, 107, 2, 1, NULL, NULL),
(20, 1, 12, 11, 20, 112, 2, 1, NULL, NULL),
(21, 1, 12, 11, 20, 144, 2, 1, NULL, NULL),
(22, 1, 12, 11, 20, 159, 2, 1, NULL, NULL),
(23, 1, 12, 11, 20, 166, 2, 1, NULL, NULL),
(24, 1, 12, 11, 20, 178, 2, 1, NULL, NULL),
(25, 1, 12, 11, 20, 188, 2, 1, NULL, NULL),
(26, 1, 12, 11, 20, 247, 2, 1, NULL, NULL),
(27, 1, 12, 11, 20, 62, 3, 1, NULL, NULL),
(28, 1, 12, 11, 20, 69, 3, 1, NULL, NULL),
(29, 1, 12, 11, 20, 70, 3, 1, NULL, NULL),
(30, 1, 12, 11, 20, 100, 3, 1, NULL, NULL),
(31, 1, 12, 11, 20, 101, 3, 1, NULL, NULL),
(32, 1, 12, 11, 20, 107, 3, 1, NULL, NULL),
(33, 1, 12, 11, 20, 112, 3, 1, NULL, NULL),
(34, 1, 12, 11, 20, 144, 3, 1, NULL, NULL),
(35, 1, 12, 11, 20, 159, 3, 1, NULL, NULL),
(36, 1, 12, 11, 20, 166, 3, 1, NULL, NULL),
(37, 1, 12, 11, 20, 178, 3, 1, NULL, NULL),
(38, 1, 12, 11, 20, 188, 3, 1, NULL, NULL),
(39, 1, 12, 11, 20, 247, 3, 1, NULL, NULL),
(40, 1, 12, 11, 20, 62, 4, 1, NULL, NULL),
(41, 1, 12, 11, 20, 69, 4, 1, NULL, NULL),
(42, 1, 12, 11, 20, 70, 4, 1, NULL, NULL),
(43, 1, 12, 11, 20, 100, 4, 1, NULL, NULL),
(44, 1, 12, 11, 20, 101, 4, 1, NULL, NULL),
(45, 1, 12, 11, 20, 107, 4, 1, NULL, NULL),
(46, 1, 12, 11, 20, 112, 4, 1, NULL, NULL),
(47, 1, 12, 11, 20, 144, 4, 1, NULL, NULL),
(48, 1, 12, 11, 20, 159, 4, 1, NULL, NULL),
(49, 1, 12, 11, 20, 166, 4, 1, NULL, NULL),
(50, 1, 12, 11, 20, 178, 4, 1, NULL, NULL),
(51, 1, 12, 11, 20, 188, 4, 1, NULL, NULL),
(52, 1, 12, 11, 20, 247, 4, 1, NULL, NULL),
(53, 1, 12, 11, 20, 62, 5, 1, NULL, NULL),
(54, 1, 12, 11, 20, 69, 5, 1, NULL, NULL),
(55, 1, 12, 11, 20, 70, 5, 1, NULL, NULL),
(56, 1, 12, 11, 20, 100, 5, 1, NULL, NULL),
(57, 1, 12, 11, 20, 101, 5, 1, NULL, NULL),
(58, 1, 12, 11, 20, 107, 5, 1, NULL, NULL),
(59, 1, 12, 11, 20, 112, 5, 1, NULL, NULL),
(60, 1, 12, 11, 20, 144, 5, 1, NULL, NULL),
(61, 1, 12, 11, 20, 159, 5, 1, NULL, NULL),
(62, 1, 12, 11, 20, 166, 5, 1, NULL, NULL),
(63, 1, 12, 11, 20, 178, 5, 1, NULL, NULL),
(64, 1, 12, 11, 20, 188, 5, 1, NULL, NULL),
(65, 1, 12, 11, 20, 247, 5, 1, NULL, NULL),
(66, 1, 12, 11, 20, 62, 6, 1, NULL, NULL),
(67, 1, 12, 11, 20, 69, 6, 1, NULL, NULL),
(68, 1, 12, 11, 20, 70, 6, 1, NULL, NULL),
(69, 1, 12, 11, 20, 100, 6, 1, NULL, NULL),
(70, 1, 12, 11, 20, 101, 6, 1, NULL, NULL),
(71, 1, 12, 11, 20, 107, 6, 1, NULL, NULL),
(72, 1, 12, 11, 20, 112, 6, 1, NULL, NULL),
(73, 1, 12, 11, 20, 144, 6, 1, NULL, NULL),
(74, 1, 12, 11, 20, 159, 6, 1, NULL, NULL),
(75, 1, 12, 11, 20, 166, 6, 1, NULL, NULL),
(76, 1, 12, 11, 20, 178, 6, 1, NULL, NULL),
(77, 1, 12, 11, 20, 188, 6, 1, NULL, NULL),
(78, 1, 12, 11, 20, 247, 6, 1, NULL, NULL),
(79, 1, 12, 11, 20, 62, 7, 1, NULL, NULL),
(80, 1, 12, 11, 20, 69, 7, 1, NULL, NULL),
(81, 1, 12, 11, 20, 70, 7, 1, NULL, NULL),
(82, 1, 12, 11, 20, 100, 7, 1, NULL, NULL),
(83, 1, 12, 11, 20, 101, 7, 1, NULL, NULL),
(84, 1, 12, 11, 20, 107, 7, 1, NULL, NULL),
(85, 1, 12, 11, 20, 112, 7, 1, NULL, NULL),
(86, 1, 12, 11, 20, 144, 7, 1, NULL, NULL),
(87, 1, 12, 11, 20, 159, 7, 1, NULL, NULL),
(88, 1, 12, 11, 20, 166, 7, 1, NULL, NULL),
(89, 1, 12, 11, 20, 178, 7, 1, NULL, NULL),
(90, 1, 12, 11, 20, 188, 7, 1, NULL, NULL),
(91, 1, 12, 11, 20, 247, 7, 1, NULL, NULL),
(92, 1, 12, 11, 20, 62, 8, 1, NULL, NULL),
(93, 1, 12, 11, 20, 69, 8, 1, NULL, NULL),
(94, 1, 12, 11, 20, 70, 8, 1, NULL, NULL),
(95, 1, 12, 11, 20, 100, 8, 1, NULL, NULL),
(96, 1, 12, 11, 20, 101, 8, 1, NULL, NULL),
(97, 1, 12, 11, 20, 107, 8, 1, NULL, NULL),
(98, 1, 12, 11, 20, 112, 8, 1, NULL, NULL),
(99, 1, 12, 11, 20, 144, 8, 1, NULL, NULL),
(100, 1, 12, 11, 20, 159, 8, 1, NULL, NULL),
(101, 1, 12, 11, 20, 166, 8, 1, NULL, NULL),
(102, 1, 12, 11, 20, 178, 8, 1, NULL, NULL),
(103, 1, 12, 11, 20, 188, 8, 1, NULL, NULL),
(104, 1, 12, 11, 20, 247, 8, 1, NULL, NULL),
(105, 1, 12, 11, 20, 62, 9, 1, NULL, NULL),
(106, 1, 12, 11, 20, 69, 9, 1, NULL, NULL),
(107, 1, 12, 11, 20, 70, 9, 1, NULL, NULL),
(108, 1, 12, 11, 20, 100, 9, 1, NULL, NULL),
(109, 1, 12, 11, 20, 101, 9, 1, NULL, NULL),
(110, 1, 12, 11, 20, 107, 9, 1, NULL, NULL),
(111, 1, 12, 11, 20, 112, 9, 1, NULL, NULL),
(112, 1, 12, 11, 20, 144, 9, 1, NULL, NULL),
(113, 1, 12, 11, 20, 159, 9, 1, NULL, NULL),
(114, 1, 12, 11, 20, 166, 9, 1, NULL, NULL),
(115, 1, 12, 11, 20, 178, 9, 1, NULL, NULL),
(116, 1, 12, 11, 20, 188, 9, 1, NULL, NULL),
(117, 1, 12, 11, 20, 247, 9, 1, NULL, NULL),
(118, 1, 12, 8, 12, 78, 10, 1, NULL, NULL),
(119, 1, 12, 8, 12, 94, 10, 1, NULL, NULL),
(120, 1, 12, 8, 12, 97, 10, 1, NULL, NULL),
(121, 1, 12, 8, 12, 109, 10, 1, NULL, NULL),
(122, 1, 12, 8, 12, 126, 10, 1, NULL, NULL),
(123, 1, 12, 8, 12, 158, 10, 1, NULL, NULL),
(124, 1, 12, 8, 12, 163, 10, 1, NULL, NULL),
(125, 1, 12, 8, 12, 180, 10, 1, NULL, NULL),
(126, 1, 12, 8, 12, 218, 10, 1, NULL, NULL),
(127, 1, 12, 8, 12, 241, 10, 1, NULL, NULL),
(128, 1, 12, 8, 12, 78, 11, 1, NULL, NULL),
(129, 1, 12, 8, 12, 94, 11, 1, NULL, NULL),
(130, 1, 12, 8, 12, 97, 11, 1, NULL, NULL),
(131, 1, 12, 8, 12, 109, 11, 1, NULL, NULL),
(132, 1, 12, 8, 12, 126, 11, 1, NULL, NULL),
(133, 1, 12, 8, 12, 158, 11, 1, NULL, NULL),
(134, 1, 12, 8, 12, 163, 11, 1, NULL, NULL),
(135, 1, 12, 8, 12, 180, 11, 1, NULL, NULL),
(136, 1, 12, 8, 12, 218, 11, 1, NULL, NULL),
(137, 1, 12, 8, 12, 241, 11, 1, NULL, NULL),
(138, 1, 12, 8, 12, 78, 12, 1, NULL, NULL),
(139, 1, 12, 8, 12, 94, 12, 1, NULL, NULL),
(140, 1, 12, 8, 12, 97, 12, 1, NULL, NULL),
(141, 1, 12, 8, 12, 109, 12, 1, NULL, NULL),
(142, 1, 12, 8, 12, 126, 12, 1, NULL, NULL),
(143, 1, 12, 8, 12, 158, 12, 1, NULL, NULL),
(144, 1, 12, 8, 12, 163, 12, 1, NULL, NULL),
(145, 1, 12, 8, 12, 180, 12, 1, NULL, NULL),
(146, 1, 12, 8, 12, 218, 12, 1, NULL, NULL),
(147, 1, 12, 8, 12, 241, 12, 1, NULL, NULL),
(148, 1, 12, 8, 12, 78, 13, 1, NULL, NULL),
(149, 1, 12, 8, 12, 94, 13, 1, NULL, NULL),
(150, 1, 12, 8, 12, 97, 13, 1, NULL, NULL),
(151, 1, 12, 8, 12, 109, 13, 1, NULL, NULL),
(152, 1, 12, 8, 12, 126, 13, 1, NULL, NULL),
(153, 1, 12, 8, 12, 158, 13, 1, NULL, NULL),
(154, 1, 12, 8, 12, 163, 13, 1, NULL, NULL),
(155, 1, 12, 8, 12, 180, 13, 1, NULL, NULL),
(156, 1, 12, 8, 12, 218, 13, 1, NULL, NULL),
(157, 1, 12, 8, 12, 241, 13, 1, NULL, NULL),
(158, 1, 12, 8, 12, 78, 14, 1, NULL, NULL),
(159, 1, 12, 8, 12, 94, 14, 1, NULL, NULL),
(160, 1, 12, 8, 12, 97, 14, 1, NULL, NULL),
(161, 1, 12, 8, 12, 109, 14, 1, NULL, NULL),
(162, 1, 12, 8, 12, 126, 14, 1, NULL, NULL),
(163, 1, 12, 8, 12, 158, 14, 1, NULL, NULL),
(164, 1, 12, 8, 12, 163, 14, 1, NULL, NULL),
(165, 1, 12, 8, 12, 180, 14, 1, NULL, NULL),
(166, 1, 12, 8, 12, 218, 14, 1, NULL, NULL),
(167, 1, 12, 8, 12, 241, 14, 1, NULL, NULL),
(168, 1, 12, 8, 12, 78, 15, 1, NULL, NULL),
(169, 1, 12, 8, 12, 94, 15, 1, NULL, NULL),
(170, 1, 12, 8, 12, 97, 15, 1, NULL, NULL),
(171, 1, 12, 8, 12, 109, 15, 1, NULL, NULL),
(172, 1, 12, 8, 12, 126, 15, 1, NULL, NULL),
(173, 1, 12, 8, 12, 158, 15, 1, NULL, NULL),
(174, 1, 12, 8, 12, 163, 15, 1, NULL, NULL),
(175, 1, 12, 8, 12, 180, 15, 1, NULL, NULL),
(176, 1, 12, 8, 12, 218, 15, 1, NULL, NULL),
(177, 1, 12, 8, 12, 241, 15, 1, NULL, NULL),
(178, 1, 12, 8, 4, 106, 16, 1, NULL, NULL),
(179, 1, 12, 8, 4, 108, 16, 1, NULL, NULL),
(180, 1, 12, 8, 4, 113, 16, 1, NULL, NULL),
(181, 1, 12, 8, 4, 121, 16, 1, NULL, NULL),
(182, 1, 12, 8, 4, 156, 16, 1, NULL, NULL),
(183, 1, 12, 8, 4, 181, 16, 1, NULL, NULL),
(184, 1, 12, 8, 4, 193, 16, 1, NULL, NULL),
(185, 1, 12, 8, 4, 194, 16, 1, NULL, NULL),
(186, 1, 12, 8, 4, 204, 16, 1, NULL, NULL),
(187, 1, 12, 8, 4, 220, 16, 1, NULL, NULL),
(188, 1, 12, 8, 4, 106, 17, 1, NULL, NULL),
(189, 1, 12, 8, 4, 108, 17, 1, NULL, NULL),
(190, 1, 12, 8, 4, 113, 17, 1, NULL, NULL),
(191, 1, 12, 8, 4, 121, 17, 1, NULL, NULL),
(192, 1, 12, 8, 4, 156, 17, 1, NULL, NULL),
(193, 1, 12, 8, 4, 181, 17, 1, NULL, NULL),
(194, 1, 12, 8, 4, 193, 17, 1, NULL, NULL),
(195, 1, 12, 8, 4, 194, 17, 1, NULL, NULL),
(196, 1, 12, 8, 4, 204, 17, 1, NULL, NULL),
(197, 1, 12, 8, 4, 220, 17, 1, NULL, NULL),
(198, 1, 12, 9, 8, 133, 18, 1, NULL, NULL),
(199, 1, 12, 11, 20, 62, 19, 1, NULL, NULL),
(200, 1, 12, 11, 20, 69, 19, 1, NULL, NULL),
(201, 1, 12, 11, 20, 70, 19, 1, NULL, NULL),
(202, 1, 12, 11, 20, 100, 19, 1, NULL, NULL),
(203, 1, 12, 11, 20, 101, 19, 1, NULL, NULL),
(204, 1, 12, 11, 20, 107, 19, 1, NULL, NULL),
(205, 1, 12, 11, 20, 112, 19, 1, NULL, NULL),
(206, 1, 12, 11, 20, 144, 19, 1, NULL, NULL),
(207, 1, 12, 11, 20, 159, 19, 1, NULL, NULL),
(208, 1, 12, 11, 20, 166, 19, 1, NULL, NULL),
(209, 1, 12, 11, 20, 178, 19, 1, NULL, NULL),
(210, 1, 12, 11, 20, 188, 19, 1, NULL, NULL),
(211, 1, 12, 11, 20, 247, 19, 1, NULL, NULL),
(212, 1, 12, 9, 17, 66, 20, 1, NULL, NULL),
(213, 1, 12, 9, 17, 110, 20, 1, NULL, NULL),
(214, 1, 12, 9, 17, 124, 20, 1, NULL, NULL),
(215, 1, 12, 9, 17, 137, 20, 1, NULL, NULL),
(216, 1, 12, 9, 17, 157, 20, 1, NULL, NULL),
(217, 1, 12, 9, 17, 210, 20, 1, NULL, NULL),
(218, 1, 12, 9, 17, 231, 20, 1, NULL, NULL),
(219, 1, 12, 9, 17, 239, 20, 1, NULL, NULL),
(220, 1, 12, 9, 17, 267, 20, 1, NULL, NULL),
(221, 1, 12, 11, 20, 70, 21, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_timend` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `file_path`, `title`, `slug`, `description`, `venue`, `event_date`, `event_time`, `event_timend`, `active`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610171528.jpeg', 'Repellendus Est aut', 'repellendus-est-aut', '<p>Arun</p>', 'Odio architecto unde', '1993-06-15', '1:33 PM', '1:33 PM', 1, 1, 12, '2021-01-03 07:34:24', '2021-03-15 06:57:11'),
(2, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610171864.jpeg', 'Quisquam duis illum', 'quisquam-duis-illum', '<p>asdsadad</p>', 'Molestias adipisicin', '2017-08-17', '1:34 PM', '1:34 PM', 1, 1, 12, '2021-01-03 07:34:37', '2021-03-15 06:57:16'),
(3, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/3741615795140.pdf', 'Md. Asifuzzaman', 'md-asifuzzaman', '<p>asdasd</p>', 'dasdas', '2021-03-24', '1:57 PM', '1:57 PM', 1, 1, 12, '2021-03-15 07:59:00', '2021-03-15 07:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''''',
  `end_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''''',
  `term` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''''',
  `active` tinyint(4) NOT NULL,
  `notice_published` tinyint(4) NOT NULL,
  `result_published` tinyint(4) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `start_date`, `end_date`, `term`, `active`, `notice_published`, `result_published`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1st Semester ', '1994-09-17 14:49:19', '1974-05-11 15:37:16', 'Optio et soluta sit.', 1, 1, 0, 1, 99, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(2, 'placeat placeat eveniet', '2008-01-15 08:24:48', '2000-02-06 04:06:51', 'Placeat vel.', 0, 0, 0, 1, 124, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(3, 'quod magni id', '1979-09-17 01:29:26', '1984-04-28 08:07:14', 'Dolores culpa.', 0, 1, 0, 1, 26, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(4, 'maxime assumenda ut', '1983-07-27 23:05:18', '1973-02-05 10:51:14', 'Ut quae repellat.', 0, 0, 1, 1, 72, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(5, 'illo temporibus qui', '1978-06-16 14:04:45', '1997-04-29 22:31:27', 'Dolore.', 1, 1, 1, 1, 82, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(6, 'eligendi qui ex', '1992-03-23 18:26:33', '1981-10-16 05:15:35', 'Ab mollitia.', 1, 1, 1, 1, 256, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(7, 'et id vitae', '1976-11-14 16:41:31', '1981-04-10 14:26:22', 'In veritatis nemo.', 1, 0, 0, 1, 79, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(8, 'blanditiis possimus non', '1979-10-27 23:40:12', '1981-03-22 06:17:42', 'Odio nobis dolores.', 1, 0, 1, 1, 252, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(9, 'facere placeat ab', '1999-07-22 07:32:08', '1990-06-23 12:33:14', 'Officia aut sit.', 1, 0, 1, 1, 183, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(10, 'culpa voluptatem aut', '2020-08-24 20:46:10', '2012-05-21 15:34:53', 'Aut asperiores.', 0, 0, 1, 1, 180, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(12, 'First Semester 201', '2021-03-18', '2021-03-27', '1', 1, 0, 0, 1, 12, '2021-03-18 07:26:02', '2021-03-18 07:26:02'),
(14, 'Class test', '2021-03-17', '2021-03-31', '1', 1, 0, 0, 1, 12, '2021-03-20 10:48:53', '2021-03-20 10:48:53'),
(16, 'Class test 3', '2021-03-29', '2021-03-31', '1', 1, 0, 0, 1, 12, '2021-03-20 11:26:22', '2021-03-20 12:01:58'),
(17, 'Semester 1', '2021-03-01', '2021-03-31', '3', 1, 0, 0, 1, 12, '2021-03-28 09:10:40', '2021-03-28 09:10:40'),
(18, 'Semester 1', '2021-03-01', '2021-03-31', '3', 1, 0, 0, 1, 12, '2021-03-28 09:10:42', '2021-03-28 09:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `exam_for_classes`
--

CREATE TABLE `exam_for_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_for_classes`
--

INSERT INTO `exam_for_classes` (`id`, `class_id`, `exam_id`, `active`) VALUES
(1, 7, 7, 1),
(2, 13, 6, 0),
(3, 3, 9, 1),
(4, 13, 7, 0),
(5, 9, 8, 1),
(6, 9, 9, 0),
(7, 2, 9, 1),
(8, 13, 8, 1),
(9, 3, 8, 1),
(10, 5, 7, 1),
(11, 3, 9, 1),
(12, 3, 8, 0),
(13, 10, 5, 1),
(14, 12, 6, 1),
(15, 6, 7, 0),
(16, 2, 9, 1),
(17, 12, 5, 1),
(18, 9, 1, 1),
(19, 1, 9, 0),
(20, 6, 5, 1),
(21, 9, 1, 0),
(22, 7, 9, 1),
(23, 9, 8, 1),
(24, 12, 1, 1),
(25, 8, 8, 1),
(26, 10, 6, 0),
(27, 7, 8, 1),
(28, 3, 8, 0),
(29, 13, 8, 1),
(30, 11, 8, 0),
(31, 4, 16, 0),
(32, 14, 17, 0),
(33, 14, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_sector_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(25,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `school_id`, `user_id`, `account_sector_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 15, 2500.00, 'Electric Bill', '2021-02-10 09:17:08', '2021-02-10 09:17:08'),
(2, 1, 12, 16, 350.00, 'Wasa Bill', '2021-02-10 09:18:01', '2021-02-10 09:18:01'),
(3, 1, 12, 17, 550.00, 'Telephone Bill', '2021-02-10 09:18:51', '2021-02-10 09:18:51'),
(4, 1, 12, 18, 310.00, 'Paper Bill', '2021-02-03 09:19:18', '2021-02-10 09:19:18'),
(5, 1, 12, 15, 359.00, 'Electric Bill', '2021-02-01 09:22:30', '2021-02-10 09:22:30'),
(6, 1, 12, 16, 200.00, 'ertt', '2021-02-04 09:22:50', '2021-02-10 09:22:50'),
(7, 1, 12, 18, 320.00, 'Paper Bill', '2021-02-10 09:23:54', '2021-02-10 09:23:54'),
(8, 1, 12, 18, 300.00, 'Paper Bill', '2021-02-05 09:24:41', '2021-02-10 09:24:41'),
(9, 1, 12, 21, 300.00, 'Gas Bill', '2021-02-10 09:32:01', '2021-02-10 09:32:01'),
(10, 1, 12, 21, 950.00, 'Gas Bill', '2021-02-08 09:32:21', '2021-02-10 09:32:21'),
(11, 1, 12, 22, 1150.00, 'For month February', '2021-02-17 09:45:40', '2021-02-17 09:45:40'),
(12, 1, 12, 16, 200.00, 'df', '2021-02-17 11:27:38', '2021-02-17 11:27:38'),
(13, 1, 12, 18, 400.00, '25', '2021-02-17 11:29:14', '2021-02-17 11:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Culpa autem laudantium quasi dignissimos recusandae veritatis enim.', 'Et aut vero velit iste. Molestias incidunt expedita quidem aliquid at aut aut. Iure sit voluptas debitis ut molestiae.', 234, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(2, 'Aut autem consequatur veritatis nisi sed.', 'Dolor ut distinctio cupiditate et molestiae eaque et. Vel facere sit ipsum eum voluptatem esse aut. Consequatur neque dicta quia reiciendis eaque vel qui.', 97, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(3, 'Et quia sunt porro fugiat explicabo.', 'Dolores voluptatem eius quo optio autem non magnam. Voluptatem laboriosam sint saepe alias. Voluptate ducimus quibusdam qui dolores consequatur quas.', 193, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(4, 'Officiis suscipit unde ipsum adipisci suscipit molestias commodi.', 'Ex quasi voluptatem doloribus eos molestiae tempora. Corrupti odio consequatur officiis ut veritatis. Voluptas qui architecto rerum.', 61, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(5, 'Natus est nostrum accusamus quia id rem et.', 'Est aperiam sint soluta accusamus. Odio quia praesentium suscipit voluptatem et ex quia quia. Quae aut tempore nesciunt dolor quo unde itaque aut.', 41, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(6, 'Placeat quasi perferendis quae.', 'Recusandae tempore facilis vitae necessitatibus sunt hic qui. Aut ipsa rerum quasi qui. Suscipit aliquid soluta rerum excepturi blanditiis.', 126, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(7, 'Et sit ea culpa et eum.', 'Vero nam magnam voluptatem amet molestiae fugit quia. Reiciendis dolorum eius reiciendis cum nihil voluptatibus vel. Maiores deserunt et sunt non.', 2, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(8, 'Quo incidunt delectus facere eaque qui voluptatem.', 'Facere odit tempora blanditiis expedita molestias. Ut quam et repudiandae. Corporis rem fuga voluptas.', 14, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(9, 'Ullam unde et voluptas nulla quo optio.', 'Aliquid consectetur est id vel magni est. Aut nulla et dicta. Magnam eos at enim ipsam sint autem sint.', 62, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(10, 'Accusantium itaque dolor sint qui libero iusto animi nostrum.', 'Velit et dolor ipsum dolorem. Deleniti dicta non tempora. Possimus asperiores dolores eos earum iusto quo eum.', 180, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(11, 'Officia sunt ducimus facere neque.', 'A aut consectetur exercitationem. Iste ut atque quidem similique. Sapiente consequatur alias atque nihil nobis nam maiores.', 156, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(12, 'Dolorem id repellendus pariatur veniam aut consectetur.', 'Impedit consequatur assumenda expedita eius quia. Voluptatem voluptatem ipsam incidunt. Sit dolor qui est a.', 65, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(13, 'Praesentium qui debitis velit expedita et neque aut dolores.', 'A quo natus iure dolor. Eius placeat qui quibusdam dolorum fuga sunt. Neque aut consequatur et temporibus ut doloribus.', 21, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(14, 'Labore eum eius rem qui pariatur nihil eveniet.', 'Optio unde fugit autem consequuntur quia. Natus neque fuga placeat impedit ut consequatur delectus. Id perspiciatis doloremque quam voluptates quis maxime exercitationem.', 182, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(15, 'Earum quibusdam illum sunt ut qui ducimus voluptatem doloribus.', 'Quis excepturi blanditiis reiciendis labore quia. Assumenda sed hic aliquid eaque et est. Aliquid consequuntur dolores tempore.', 61, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(16, 'Et sit vitae molestiae tempore eos.', 'Omnis ut labore sint voluptas ut veniam consequatur. Omnis aperiam numquam pariatur nemo voluptatem magni quo ad. Illum dolores dolores saepe facilis.', 211, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(17, 'Consectetur iste non et et rerum sint.', 'Numquam incidunt rerum excepturi adipisci nesciunt modi. Maiores aut molestiae possimus facere asperiores quo. Nesciunt sunt cumque voluptates quis reiciendis.', 192, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(18, 'Commodi magni numquam inventore et iste.', 'Maiores aut cumque quibusdam occaecati. Voluptas et rerum rerum eligendi. Molestiae molestias ipsum rem voluptatem dolor.', 140, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(19, 'Dolor sed quia ut sed non minus.', 'Alias odio ipsum voluptas ipsum. Voluptas doloribus laboriosam qui et. Aspernatur facere iure cumque aspernatur.', 229, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(20, 'Nulla sed veritatis sint.', 'Qui aliquid maiores cupiditate. Officia ut eveniet nihil non saepe ea qui. Maxime quia iste est est ab corrupti autem.', 249, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(21, 'Dolor quia error provident aut et id est explicabo.', 'Suscipit repudiandae optio magnam enim. Libero sapiente magni tempora labore amet et quos. Ut repellat quae nostrum aperiam explicabo.', 8, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(22, 'Est enim ducimus a.', 'Magnam sunt voluptates numquam dicta maiores magnam fuga. Nostrum ipsa pariatur architecto nesciunt nihil expedita ut. Pariatur molestias minima corrupti molestiae aut aperiam voluptas voluptatem.', 102, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(23, 'Illo cupiditate repudiandae consequatur sapiente.', 'Veniam cumque labore asperiores et consequuntur ratione ex. Architecto aliquid cupiditate modi. Omnis beatae eos qui deserunt cum maiores.', 143, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(24, 'Perspiciatis vitae cumque sed iste omnis nemo exercitationem.', 'Eius quam natus velit. Officia labore eos debitis voluptatum et dignissimos. Rem nulla quam corrupti autem et sapiente aperiam.', 168, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(25, 'Fuga laborum ut esse vero nobis.', 'Vel qui dolor inventore. Non veniam eveniet omnis neque doloribus omnis unde et. Praesentium error incidunt dolores perspiciatis eaque.', 191, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(26, 'Et nesciunt quos nesciunt accusantium earum.', 'Ut repellendus laboriosam voluptas sed natus soluta. Repudiandae maxime est et quod vel sit ea cupiditate. Aut et numquam eius necessitatibus voluptatibus.', 157, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(27, 'Cumque officia quia corporis tempore.', 'Doloremque dolores id ut non. Molestiae atque est occaecati deserunt et ducimus. Labore eos natus dolor hic non unde eum repudiandae.', 256, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(28, 'Quae est nihil sequi aut molestias facere aut.', 'Rerum commodi quaerat vitae hic. Omnis accusamus voluptas sit laborum vel rem. Est voluptatibus in tempore sint tempora vel earum in.', 89, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(29, 'Consequatur facilis magnam non animi dignissimos ipsam consequuntur.', 'Facere nihil corrupti repellat asperiores labore eius. Perferendis aut sit enim doloremque. Facere qui harum cumque sunt quod.', 248, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(30, 'Et sed commodi sit ut.', 'Quo cupiditate eaque ipsam. Quasi quasi qui praesentium cupiditate sed. Exercitationem non facere molestiae omnis rem ut iste.', 128, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(31, 'Id vel aut quaerat possimus.', 'Asperiores sunt aliquam repellat non earum. Cupiditate voluptatibus non repellat omnis laborum. Ullam laboriosam consequatur nesciunt iure eveniet quas placeat.', 61, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(32, 'Excepturi necessitatibus sunt deleniti aperiam dicta qui assumenda.', 'Et error vel veritatis molestias aut eos libero. Magnam velit repellat distinctio consequuntur. Vitae quo dolores qui.', 165, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(33, 'Ut quia repudiandae sed et excepturi illo laboriosam.', 'Corrupti cum optio modi at ea ut dolorem. Est non omnis fugiat ut voluptatum. Exercitationem molestias eum asperiores exercitationem voluptates nemo et.', 164, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(34, 'Cumque sunt ducimus modi est molestiae unde esse.', 'Et sapiente aut vel dolorem aut quasi ipsam omnis. In consequatur a fugiat est. Quia est saepe excepturi exercitationem doloribus ducimus.', 257, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(35, 'Sit qui et earum quia beatae animi ut eligendi.', 'In eum omnis nihil sapiente qui velit velit nihil. Quaerat hic ipsam cumque ut aspernatur. Sit veniam magnam corporis aut.', 135, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(36, 'Officia beatae omnis aut.', 'Dolore illum dolorum exercitationem nam eos. Hic magni et ea. Minus tenetur amet sit qui quos consequuntur deserunt.', 241, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(37, 'Sunt repellat sint ab rem.', 'Quia aut non suscipit ipsum qui reprehenderit. Quo quod voluptas aut illo aperiam minus. Corporis cum distinctio excepturi provident et quidem.', 125, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(38, 'Veritatis voluptas necessitatibus accusamus itaque.', 'Architecto quod rerum praesentium et magnam ut. Molestiae cum ducimus est et omnis quidem ratione. Enim eveniet sit doloribus facere culpa.', 130, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(39, 'Aliquid ipsa fuga quo aut ad.', 'Quo nesciunt ducimus aperiam deserunt. Qui facere sed voluptatum a ipsum rerum nemo. Sunt nostrum repellendus aspernatur at voluptas asperiores aut tenetur.', 220, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(40, 'Ut nemo numquam reprehenderit.', 'Quod molestias qui dicta. Dolores eum labore assumenda quo. Quae sed corrupti error qui aliquid praesentium.', 212, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(41, 'Commodi doloremque aut dignissimos enim aut quasi.', 'Alias blanditiis ut quisquam fuga. Et cupiditate aut ratione accusamus. Porro velit mollitia quisquam animi.', 187, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(42, 'Et ut suscipit corporis ut.', 'Doloribus doloremque dolores alias voluptatem quos eaque dicta voluptas. Est sed qui unde fugiat dolorem voluptates nihil occaecati. Dolor necessitatibus eos aut asperiores beatae qui natus.', 256, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(43, 'Nihil est accusantium labore sint.', 'Vitae sit atque sint mollitia est qui. Quia dolorum est pariatur voluptatem. Laudantium nulla similique cumque eligendi corporis minima.', 221, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(44, 'Corporis cum qui perspiciatis praesentium.', 'Consequatur aut porro ut. Enim aut reprehenderit occaecati quis animi et. Excepturi et explicabo ipsum est.', 239, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(45, 'Omnis cupiditate aliquam itaque ullam aliquam ea distinctio tenetur.', 'Aperiam facere animi nisi ut recusandae eveniet. Aut laborum natus ut illo dicta animi enim. Animi et omnis illum eligendi rem.', 79, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(46, 'Facilis numquam quo praesentium nihil sed voluptatem saepe.', 'Adipisci cum autem odit est et nihil. Eos vitae vel molestiae earum expedita architecto qui. Quo incidunt sit est ad.', 84, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(47, 'Soluta aut et dolorem repellendus.', 'Ab est consequuntur aut maiores totam distinctio corrupti ratione. Distinctio beatae consequuntur fuga in ea. Omnis ad quae et molestiae temporibus.', 194, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(48, 'Consequatur occaecati sapiente labore omnis beatae adipisci et sed.', 'Dolores similique voluptatibus dignissimos in sed. Corporis quae iure perferendis earum et blanditiis. Dolorum eius omnis magnam in recusandae.', 252, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(49, 'Sit vero eum velit aut.', 'Corrupti voluptas enim culpa et. Quos molestiae molestiae aliquam quas aperiam. Sed eius saepe dolores nihil vel.', 236, '2020-10-28 06:24:05', '2020-10-28 06:24:05'),
(50, 'Est qui voluptas architecto doloribus sed reiciendis.', 'Veritatis architecto est id. Eos tenetur corporis nostrum aliquid impedit et. Sed architecto officiis blanditiis quia eum.', 69, '2020-10-28 06:24:05', '2020-10-28 06:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `description`, `teacher_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 'Consequatur assumenda temporibus eum sit. Possimus neque autem in error sunt. Minima magni architecto dolore eius architecto occaecati.', 35, 244, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(2, 'Perspiciatis odio fugit repudiandae nostrum. Consequuntur consequuntur iusto est enim eos. Accusamus aut natus est et at officiis adipisci.', 46, 199, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(3, 'Culpa qui repellat a dolores. Numquam quam nihil occaecati. Vel atque natus incidunt aut voluptatum.', 49, 108, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(4, 'Nihil exercitationem minus autem ipsa sed voluptatem quo. Voluptatem beatae optio est optio sapiente. Veritatis aperiam nisi exercitationem consequatur.', 37, 64, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(5, 'Et natus dolorum ratione quam voluptatibus voluptas qui voluptatum. Est ducimus veritatis quasi assumenda earum est. Cupiditate accusamus maxime dolores expedita aut.', 51, 143, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(6, 'Rem et quia laborum esse ab quis. Saepe itaque architecto dicta aut. Et in quod id dolor magni sit ipsa quam.', 47, 228, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(7, 'At et ad nostrum consequuntur quam. Dolores quia distinctio eaque aut perferendis sit dolor. Rem ad animi accusantium maxime eum.', 53, 259, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(8, 'Ea non nesciunt hic ab quo accusantium. Nulla tenetur nemo corrupti placeat beatae. Ut fugiat dolor fugiat aut.', 45, 82, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(9, 'Architecto pariatur molestias molestiae nihil dolores quos ipsum. Natus veniam quis recusandae sed. Aperiam soluta vel adipisci nam nihil laboriosam enim et.', 42, 116, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(10, 'Ad est et voluptatibus iste voluptate mollitia. Laudantium nobis non aut et et qui et. Eveniet velit beatae perferendis voluptate et.', 51, 93, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(11, 'Nulla sed et corporis sapiente vel quia consequuntur non. Laborum doloremque eaque nemo culpa. Qui nulla consectetur quibusdam alias pariatur velit omnis enim.', 44, 233, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(12, 'Voluptas dolores perferendis eaque assumenda inventore debitis tempore. Dolores quibusdam et eos sit. In rerum praesentium distinctio maiores asperiores et facere.', 32, 221, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(13, 'Est non tempore ullam. Nesciunt voluptatibus sunt blanditiis blanditiis facere consequuntur. Quisquam sapiente voluptatibus dolorum quia dicta corrupti magni.', 36, 230, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(14, 'In molestias nulla ut illo provident. Maiores et aut enim dolor quis perferendis qui. Vitae et eius quo placeat ducimus.', 55, 121, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(15, 'Ad consequatur consectetur itaque eum eum beatae eos. Aut at aspernatur molestias facere. Sint consectetur autem ab sit incidunt nostrum.', 34, 164, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(16, 'Libero qui ut consectetur autem doloribus cum. Quae eos enim qui nihil magnam. Quaerat nulla cum possimus vel neque.', 61, 178, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(17, 'Excepturi ex dolorem omnis molestias est nobis sit. Ex aspernatur rerum enim deserunt. Vero rerum ipsam ut.', 40, 202, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(18, 'Quo impedit vel nulla iste alias. Ullam tempora dolores iste repellat. Explicabo odio maxime eos et.', 44, 218, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(19, 'Asperiores aut velit ea sit omnis dicta. Sint ipsa deleniti enim est debitis. Illo non numquam aut assumenda suscipit adipisci hic.', 53, 206, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(20, 'Rem fugiat unde earum reiciendis veniam. Soluta in ea est consequatur mollitia. Repudiandae omnis quae consequatur dolorum quae.', 32, 184, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(21, 'Voluptates aut et animi natus. Expedita soluta dolorum dignissimos eos et at. Fugit aut est possimus non beatae qui aut.', 53, 243, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(22, 'In ratione voluptas dolorum occaecati est. Non excepturi consectetur in enim odit et enim. Iusto et tempora ut eveniet molestiae.', 44, 241, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(23, 'Voluptatem consequatur saepe facilis fuga. Nostrum vel veniam deleniti maxime non praesentium quisquam. Quis repudiandae autem ut et illo natus temporibus.', 54, 83, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(24, 'Soluta aperiam nam dolores aperiam corporis. Quis unde voluptas iure recusandae. Tempora aliquid voluptas amet consequatur quo recusandae corporis.', 39, 93, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(25, 'Quae consequatur repellendus tempore est ut expedita qui. Molestiae beatae rerum laudantium explicabo dolores enim quaerat. Ratione praesentium harum et eligendi earum eos et.', 51, 187, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(26, 'Illum aliquid architecto veniam laboriosam aut aut ex sit. Eos sunt explicabo sequi est. Minima sed ea eos et corporis.', 38, 117, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(27, 'Officiis maxime et quod ducimus vel incidunt. Ut vero est quidem soluta repellendus consequuntur. Consectetur recusandae eligendi est minima.', 53, 214, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(28, 'Maiores atque quisquam et. Tempora nobis animi ut impedit quasi sed. Quod iure beatae velit ut doloribus est nulla.', 39, 165, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(29, 'Doloremque sed aut iure aperiam. Omnis in dicta odio ad officia. Unde delectus sunt sequi fugit voluptas hic corrupti.', 60, 74, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(30, 'Ut et excepturi excepturi animi eos vel voluptatem. Iste in saepe exercitationem tenetur. Praesentium sequi dolores et harum eaque.', 44, 151, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(31, 'Maxime aut quam tempore id quod error. Ratione vero ut sunt harum. Quos deleniti laborum nostrum eaque ut repellat.', 45, 133, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(32, 'Natus quasi molestias sit labore et velit sunt. Eveniet dolores quo reprehenderit et hic eum voluptatem. Adipisci sint exercitationem dolorem sunt.', 41, 80, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(33, 'Eum autem occaecati veniam reprehenderit. Officia autem hic rerum maxime. Inventore ducimus in dolorem excepturi necessitatibus accusantium.', 35, 260, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(34, 'Earum corrupti natus nulla. Hic delectus aut quaerat eaque consequatur similique quas. Voluptas culpa eius nobis dolor.', 44, 119, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(35, 'A sequi sunt consequatur vero cum. Odio voluptates accusantium numquam praesentium est odio. Itaque vitae commodi facere nemo.', 48, 229, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(36, 'Rerum veritatis est quia ea consequuntur dolorem sed dicta. Doloribus quod non dolorem at. Sapiente quae quos id nulla perspiciatis.', 61, 103, '2020-10-28 06:23:55', '2020-10-28 06:23:55'),
(37, 'Veniam rerum sequi tempora. Eligendi adipisci vitae id. Iure dolorum tempora ipsa est et perspiciatis.', 44, 122, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(38, 'Dolores eum veniam consequatur dolorum eos. Est rerum aliquid minima sit quam. Necessitatibus facere impedit rem necessitatibus vel.', 33, 152, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(39, 'Vel officia quam rem ipsa. Sed aliquam ut qui ab. Quasi ut et eveniet.', 35, 203, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(40, 'Pariatur vel ut nam voluptatem et. Dolores architecto itaque minus debitis suscipit quos. Omnis commodi omnis non aperiam nam.', 53, 125, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(41, 'Repellat nobis odio distinctio harum suscipit omnis sit. Magnam beatae et nesciunt magni mollitia deserunt temporibus. Ipsa dignissimos quasi voluptas sit quidem.', 46, 73, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(42, 'Aut sapiente inventore itaque. Cupiditate voluptatem mollitia earum ut. Voluptatem esse sit eveniet rerum.', 57, 98, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(43, 'Facere ab quidem labore tempora neque sint. Quia voluptas ut qui blanditiis repudiandae beatae. Repellendus commodi possimus rerum assumenda deleniti corrupti ut distinctio.', 57, 187, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(44, 'Voluptate odit nesciunt a labore dignissimos. Eos nihil sit dolorem ab sit optio. Dolores porro impedit deserunt et eaque sit.', 45, 191, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(45, 'Dignissimos ullam officia sed non qui aspernatur. Nihil laborum qui ut aut. Sit ex est ut ea.', 48, 128, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(46, 'Ipsa sunt accusamus sit et. Eum nisi fugiat eius aliquid facere expedita consequuntur. Autem explicabo qui velit eum laboriosam quam et.', 50, 150, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(47, 'Molestiae esse autem laborum quidem inventore. Ut facilis veritatis numquam quidem totam ad tempore. Modi fugit a velit a asperiores aut voluptas est.', 58, 78, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(48, 'In ipsa aut voluptatem doloribus. Exercitationem officiis quia blanditiis nihil eveniet ut. Iste ex iste consequatur in voluptates maxime.', 58, 251, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(49, 'Facilis temporibus harum omnis ut neque possimus. Aut blanditiis laborum harum laudantium ipsum minima voluptatibus. Cupiditate et dolore quis minus optio nam.', 51, 258, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(50, 'Quam rem perspiciatis quis facere qui inventore velit. Iste voluptas sit quo culpa quia. Dicta quas ab dolorum mollitia tenetur sit ad.', 53, 83, '2020-10-28 06:23:56', '2020-10-28 06:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` bigint(20) DEFAULT NULL,
  `amount` double(25,2) DEFAULT NULL,
  `cycle` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `school_id`, `user_id`, `type`, `amount`, `cycle`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 1, 500.00, 1, '2021-02-10 08:00:26', '2021-02-10 08:00:26'),
(2, 1, 12, 2, 200.00, 1, '2021-02-10 08:00:58', '2021-02-10 08:00:58'),
(3, 1, 12, 3, 300.00, 1, '2021-02-10 08:03:18', '2021-02-10 08:03:18'),
(4, 1, 12, 6, 100.00, 1, '2021-02-10 08:49:38', '2021-02-10 08:49:38'),
(5, 1, 12, 7, 150.00, 1, '2021-02-10 08:50:27', '2021-02-10 08:50:27'),
(6, 1, 12, 12, 2000.00, 1, '2021-02-10 08:51:17', '2021-02-10 08:51:17'),
(7, 1, 12, 9, 250.00, 1, '2021-02-10 08:52:07', '2021-02-10 08:52:07'),
(8, 1, 12, 13, 120.00, 1, '2021-02-10 08:53:09', '2021-02-10 08:53:09'),
(9, 1, 12, 11, 150.00, 1, '2021-02-10 08:54:00', '2021-02-10 08:54:00'),
(10, 1, 12, 1, 600.00, 1, '2021-02-10 09:01:05', '2021-02-10 09:01:05'),
(11, 1, 12, 2, 200.00, 1, '2021-02-10 09:02:05', '2021-02-10 09:02:05'),
(12, 1, 12, 3, 250.00, 1, '2021-02-10 09:07:09', '2021-02-10 09:07:09'),
(13, 1, 12, 4, 200.00, 1, '2021-02-10 09:11:28', '2021-02-10 09:11:28'),
(14, 1, 12, 7, 350.00, 1, '2021-02-10 10:19:36', '2021-02-10 10:19:36'),
(15, 1, 12, 12, 1500.00, 1, '2021-02-10 10:20:11', '2021-02-10 10:20:11'),
(16, 1, 12, 2, 200.00, 1, '2021-02-11 05:55:06', '2021-02-11 05:55:06'),
(17, 1, 12, 1, 600.00, 1, '2021-02-11 05:56:01', '2021-02-11 05:56:01'),
(18, 1, 12, 4, 200.00, 1, '2021-02-11 06:35:45', '2021-02-11 06:35:45'),
(19, 1, 12, 1, 100.00, 1, '2021-02-14 05:29:59', '2021-02-14 05:29:59'),
(20, 1, 12, 1, 120.00, 1, '2021-02-15 11:53:44', '2021-02-15 11:53:44'),
(21, 1, 12, 6, 1000.00, 1, '2021-02-17 09:40:21', '2021-02-17 09:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `file_path`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Opal Nienow', 'http://www.runolfsdottir.com/fugit-vel-ea-mollitia-omnis-autem', 2, 148, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(2, 'Belle Gusikowski', 'http://www.rath.com/', 3, 145, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(3, 'Enrique Jacobson', 'http://kozey.com/possimus-veniam-et-dolorem-ab-mollitia-et-excepturi', 4, 204, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(4, 'Alessandro Rippin', 'http://www.erdman.com/reiciendis-nostrum-esse-laborum', 5, 245, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(5, 'Enos Legros V', 'http://funk.net/voluptatem-quae-voluptatem-at-qui-aut-aperiam', 6, 95, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(6, 'Tiffany Bauch', 'http://blanda.com/expedita-quia-sit-totam-quam-praesentium-magni-blanditiis-ipsum.html', 7, 163, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(7, 'Joany Thiel', 'http://www.douglas.com/', 8, 142, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(8, 'General Hettinger', 'https://www.berge.biz/odit-quis-autem-est-et-deserunt-qui-perferendis', 9, 194, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(9, 'Alysson Christiansen', 'http://www.dach.com/ut-non-recusandae-dolores-deserunt-sequi', 10, 188, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(10, 'Rahsaan Rosenbaum', 'http://gorczany.com/et-quo-illum-quo-sit-in-ad-non.html', 11, 118, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(11, 'Ken Sipes', 'https://www.carter.com/blanditiis-aliquam-et-molestias-aut', 12, 154, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(12, 'Miss Sallie Beer', 'http://hilpert.com/', 13, 112, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(13, 'Caleigh Sawayn', 'https://willms.net/repellendus-rerum-qui-nisi-ad-vitae.html', 14, 52, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(14, 'Halie Hirthe DVM', 'https://www.emmerich.com/cum-tenetur-unde-minima', 15, 247, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(15, 'Raquel Harber MD', 'http://www.homenick.info/quas-doloribus-odit-cum-molestiae-odit-dignissimos.html', 16, 240, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(16, 'Sienna Green III', 'http://pollich.com/commodi-est-earum-magnam-aut.html', 17, 202, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(17, 'Dr. Nichole Hermann', 'http://kozey.org/', 18, 105, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(18, 'Miss Bettye Hermiston II', 'http://www.lubowitz.com/qui-sequi-quis-recusandae-vel-consectetur', 19, 217, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(19, 'Darrick Grady', 'https://moen.com/iste-a-eos-veritatis-consequatur-tenetur-rerum-distinctio.html', 20, 159, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(20, 'Sid Reichert II', 'http://gaylord.biz/reprehenderit-consectetur-ea-maxime-voluptas-qui-veritatis-ea', 21, 154, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(21, 'Dr. Bobbie Eichmann III', 'http://www.ruecker.com/repudiandae-laboriosam-numquam-aut-qui-sit-molestias.html', 22, 132, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(22, 'Prof. Beth Legros V', 'http://shields.info/voluptatem-quia-asperiores-repellat-aut.html', 23, 174, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(23, 'Carolyne O\'Reilly', 'http://www.turner.com/', 24, 144, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(24, 'Peggie Towne', 'http://www.blanda.com/magni-et-placeat-nisi.html', 25, 10, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(25, 'Otilia Stamm III', 'http://rohan.com/iure-esse-voluptatem-nihil-est-perspiciatis', 26, 174, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(26, 'Gunnar Witting', 'http://ratke.com/', 27, 208, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(27, 'Hettie Lowe', 'http://www.fahey.com/', 28, 63, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(28, 'Albin Grant', 'https://www.stoltenberg.com/et-numquam-ratione-quis-harum-neque', 29, 29, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(29, 'Prof. Bernita Kreiger', 'http://www.kuphal.com/asperiores-ipsa-optio-nisi-impedit-necessitatibus-quae.html', 30, 74, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(30, 'Vergie Gutkowski', 'http://www.smitham.info/', 31, 235, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(31, 'Jimmy Connelly', 'https://wiegand.biz/consectetur-cumque-explicabo-quam-doloremque-nihil.html', 32, 134, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(32, 'Janet Streich MD', 'http://ruecker.com/rerum-quidem-neque-nihil-eaque-blanditiis-ut.html', 33, 49, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(33, 'Mrs. Ashly Streich', 'http://brown.com/', 34, 173, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(34, 'Adam Cassin', 'http://www.monahan.com/repellat-quia-tenetur-ut-delectus-unde', 35, 45, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(35, 'Zoe Durgan', 'http://tromp.net/', 36, 192, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(36, 'Ryann Fadel', 'http://www.bruen.com/excepturi-ad-facere-velit-debitis', 37, 62, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(37, 'Prof. Rudy Durgan', 'http://www.hermann.com/', 38, 131, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(38, 'Ms. Maya Hegmann DVM', 'https://www.okon.com/mollitia-harum-exercitationem-minima-enim-ipsa-minus-dolor', 39, 217, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(39, 'Prof. Josefina Rempel PhD', 'http://ward.com/animi-autem-facilis-non-molestiae-minus.html', 40, 67, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(40, 'Gerald Harris', 'http://hettinger.com/', 41, 23, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(41, 'Jovanny Kiehn', 'http://www.hills.net/dicta-et-sunt-nam-est-error-id', 42, 12, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(42, 'Henri Hills', 'http://kreiger.com/sint-dolor-blanditiis-qui', 43, 145, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(43, 'Friedrich Towne', 'http://huel.com/dicta-numquam-quo-labore-cupiditate-commodi-sed-nisi.html', 44, 212, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(44, 'Alejandrin Windler', 'http://russel.com/assumenda-modi-voluptas-aliquam', 45, 9, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(45, 'Prof. Saul Goodwin', 'http://www.zemlak.com/consequuntur-ut-ipsam-consequuntur-beatae-quia-quo-quo', 46, 46, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(46, 'Dalton Gleichner III', 'http://www.hane.info/porro-nesciunt-fugit-cum-dolorum-consequatur.html', 47, 94, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(47, 'Prof. Grayce Ankunding Sr.', 'http://king.biz/fuga-facilis-error-id-neque-voluptates-minima', 48, 115, '2020-10-28 06:23:59', '2020-10-28 06:23:59'),
(48, 'Autumn Barton', 'https://bernier.biz/eos-iusto-hic-et-adipisci.html', 49, 175, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(49, 'Miss Dianna Von Sr.', 'http://farrell.com/nulla-porro-corrupti-numquam-inventore', 50, 151, '2020-10-28 06:24:00', '2020-10-28 06:24:00'),
(50, 'Allene Simonis', 'http://legros.com/saepe-quo-sequi-quia-laborum-laborum', 51, 193, '2020-10-28 06:24:00', '2020-10-28 06:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `school_id`, `title`, `description`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Shihab', 'rrtt', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/GP/5971615794008.png', 1, '2020-12-24 07:31:32', '2021-03-15 07:40:09'),
(4, 1, 'ICPL', 'ICPL Gallery', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/GP/1609399851.png', 1, '2020-12-31 06:17:04', '2020-12-31 07:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `marks` double(8,2) NOT NULL,
  `gpa` double(8,2) NOT NULL,
  `attendance` double(8,2) NOT NULL,
  `quiz1` double(8,2) NOT NULL,
  `quiz2` double(8,2) NOT NULL,
  `quiz3` double(8,2) NOT NULL,
  `quiz4` double(8,2) NOT NULL,
  `quiz5` double(8,2) NOT NULL,
  `ct1` double(8,2) NOT NULL,
  `ct2` double(8,2) NOT NULL,
  `ct3` double(8,2) NOT NULL,
  `ct4` double(8,2) NOT NULL,
  `ct5` double(8,2) NOT NULL,
  `assignment1` double(8,2) NOT NULL,
  `assignment2` double(8,2) NOT NULL,
  `assignment3` double(8,2) NOT NULL,
  `written` double(8,2) NOT NULL,
  `mcq` double(8,2) NOT NULL,
  `practical` double(8,2) NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `marks`, `gpa`, `attendance`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `ct1`, `ct2`, `ct3`, `ct4`, `ct5`, `assignment1`, `assignment2`, `assignment3`, `written`, `mcq`, `practical`, `exam_id`, `student_id`, `teacher_id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 97.00, 7.00, 5.00, 93.00, 82.00, 32.00, 65.00, 91.00, 78.00, 31.00, 65.00, 57.00, 50.00, 81.00, 28.00, 35.00, 66.00, 59.00, 11.00, 10, 71, 37, 3, 200, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(2, 67.00, 5.00, 5.00, 63.00, 98.00, 38.00, 37.00, 72.00, 41.00, 58.00, 70.00, 57.00, 67.00, 85.00, 16.00, 30.00, 84.00, 41.00, 63.00, 6, 66, 41, 6, 245, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(3, 27.00, 0.00, 5.00, 16.00, 50.00, 71.00, 91.00, 14.00, 65.00, 86.00, 60.00, 42.00, 3.00, 30.00, 96.00, 94.00, 85.00, 38.00, 53.00, 1, 65, 38, 7, 54, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(4, 80.00, 6.00, 5.00, 4.00, 5.00, 15.00, 4.00, 9.00, 4.00, 59.00, 47.00, 5.00, 11.00, 56.00, 33.00, 93.00, 80.00, 90.00, 31.00, 5, 62, 37, 7, 170, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(5, 91.00, 1.00, 5.00, 1.00, 46.00, 97.00, 61.00, 98.00, 4.00, 1.00, 89.00, 19.00, 57.00, 78.00, 9.00, 49.00, 20.00, 67.00, 1.00, 9, 66, 32, 10, 79, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(6, 60.00, 5.00, 5.00, 83.00, 20.00, 14.00, 59.00, 58.00, 11.00, 40.00, 83.00, 7.00, 38.00, 21.00, 24.00, 37.00, 38.00, 21.00, 11.00, 6, 63, 37, 3, 85, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(7, 8.00, 0.00, 5.00, 35.00, 34.00, 58.00, 55.00, 59.00, 51.00, 1.00, 61.00, 4.00, 46.00, 59.00, 76.00, 49.00, 37.00, 62.00, 55.00, 4, 71, 38, 10, 222, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(8, 57.00, 0.00, 5.00, 8.00, 47.00, 56.00, 97.00, 79.00, 91.00, 87.00, 75.00, 78.00, 88.00, 25.00, 79.00, 28.00, 5.00, 49.00, 81.00, 5, 66, 41, 7, 216, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(9, 62.00, 8.00, 5.00, 72.00, 25.00, 87.00, 69.00, 75.00, 35.00, 93.00, 35.00, 21.00, 97.00, 53.00, 93.00, 24.00, 79.00, 95.00, 54.00, 5, 64, 32, 6, 206, '2020-10-28 06:23:50', '2020-10-28 06:23:50'),
(10, 44.00, 9.00, 5.00, 47.00, 33.00, 28.00, 1.00, 85.00, 7.00, 73.00, 21.00, 31.00, 18.00, 38.00, 46.00, 76.00, 12.00, 87.00, 44.00, 4, 64, 32, 7, 164, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(11, 95.00, 3.00, 5.00, 85.00, 76.00, 89.00, 26.00, 41.00, 23.00, 26.00, 63.00, 29.00, 70.00, 75.00, 26.00, 35.00, 76.00, 74.00, 22.00, 3, 63, 32, 2, 244, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(12, 56.00, 5.00, 5.00, 16.00, 62.00, 75.00, 6.00, 13.00, 26.00, 23.00, 92.00, 10.00, 73.00, 6.00, 56.00, 43.00, 13.00, 54.00, 55.00, 4, 64, 38, 4, 176, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(13, 19.00, 7.00, 5.00, 90.00, 19.00, 17.00, 14.00, 75.00, 13.00, 41.00, 36.00, 77.00, 40.00, 37.00, 20.00, 45.00, 36.00, 39.00, 62.00, 7, 71, 32, 7, 239, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(14, 36.00, 8.00, 5.00, 82.00, 49.00, 18.00, 21.00, 8.00, 27.00, 94.00, 38.00, 84.00, 92.00, 84.00, 64.00, 46.00, 36.00, 81.00, 78.00, 10, 62, 39, 7, 18, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(15, 56.00, 1.00, 5.00, 83.00, 61.00, 95.00, 99.00, 22.00, 38.00, 50.00, 43.00, 58.00, 78.00, 61.00, 33.00, 88.00, 47.00, 32.00, 93.00, 1, 63, 37, 3, 55, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(16, 23.00, 4.00, 5.00, 71.00, 5.00, 87.00, 6.00, 45.00, 34.00, 75.00, 92.00, 73.00, 83.00, 38.00, 36.00, 9.00, 60.00, 51.00, 30.00, 6, 65, 35, 4, 52, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(17, 70.00, 0.00, 5.00, 30.00, 70.00, 85.00, 16.00, 66.00, 80.00, 87.00, 40.00, 92.00, 71.00, 62.00, 81.00, 69.00, 75.00, 9.00, 19.00, 7, 70, 40, 2, 146, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(18, 78.00, 3.00, 5.00, 6.00, 47.00, 57.00, 56.00, 30.00, 54.00, 44.00, 90.00, 73.00, 35.00, 71.00, 62.00, 29.00, 15.00, 28.00, 23.00, 6, 66, 37, 2, 248, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(19, 24.00, 0.00, 5.00, 43.00, 92.00, 18.00, 92.00, 10.00, 99.00, 91.00, 94.00, 69.00, 54.00, 78.00, 63.00, 59.00, 44.00, 52.00, 70.00, 9, 66, 41, 2, 21, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(20, 23.00, 1.00, 5.00, 26.00, 83.00, 93.00, 1.00, 7.00, 79.00, 8.00, 90.00, 17.00, 57.00, 41.00, 3.00, 46.00, 57.00, 95.00, 62.00, 8, 71, 41, 10, 136, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(21, 25.00, 3.00, 5.00, 17.00, 35.00, 90.00, 27.00, 12.00, 20.00, 64.00, 71.00, 35.00, 0.00, 97.00, 88.00, 77.00, 5.00, 89.00, 34.00, 10, 71, 34, 6, 34, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(22, 56.00, 5.00, 5.00, 93.00, 35.00, 65.00, 49.00, 10.00, 3.00, 16.00, 71.00, 88.00, 96.00, 58.00, 94.00, 56.00, 47.00, 46.00, 60.00, 5, 65, 38, 4, 163, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(23, 17.00, 4.00, 5.00, 3.00, 49.00, 72.00, 36.00, 52.00, 65.00, 9.00, 77.00, 51.00, 57.00, 55.00, 58.00, 83.00, 33.00, 48.00, 87.00, 3, 65, 34, 5, 200, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(24, 91.00, 2.00, 5.00, 65.00, 53.00, 45.00, 58.00, 95.00, 40.00, 89.00, 71.00, 29.00, 28.00, 67.00, 22.00, 9.00, 28.00, 11.00, 74.00, 1, 70, 32, 2, 99, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(25, 67.00, 6.00, 5.00, 93.00, 9.00, 49.00, 47.00, 37.00, 12.00, 12.00, 96.00, 17.00, 61.00, 57.00, 81.00, 47.00, 74.00, 96.00, 24.00, 5, 70, 33, 1, 24, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(26, 9.00, 4.00, 5.00, 39.00, 81.00, 76.00, 16.00, 59.00, 42.00, 17.00, 52.00, 40.00, 51.00, 46.00, 68.00, 78.00, 22.00, 46.00, 92.00, 2, 63, 32, 1, 215, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(27, 80.00, 5.00, 5.00, 80.00, 64.00, 32.00, 36.00, 93.00, 36.00, 9.00, 61.00, 99.00, 74.00, 24.00, 37.00, 3.00, 15.00, 17.00, 55.00, 4, 70, 35, 6, 253, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(28, 16.00, 5.00, 5.00, 76.00, 46.00, 1.00, 45.00, 17.00, 81.00, 19.00, 71.00, 55.00, 88.00, 1.00, 27.00, 62.00, 53.00, 60.00, 39.00, 6, 67, 39, 3, 173, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(29, 91.00, 0.00, 5.00, 32.00, 6.00, 55.00, 86.00, 55.00, 94.00, 89.00, 39.00, 29.00, 90.00, 20.00, 93.00, 72.00, 21.00, 85.00, 17.00, 7, 66, 40, 5, 169, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(30, 37.00, 7.00, 5.00, 35.00, 23.00, 62.00, 60.00, 42.00, 73.00, 61.00, 3.00, 34.00, 35.00, 82.00, 82.00, 19.00, 26.00, 3.00, 9.00, 7, 65, 32, 5, 95, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(31, 24.00, 2.00, 5.00, 82.00, 30.00, 77.00, 29.00, 89.00, 63.00, 12.00, 82.00, 37.00, 58.00, 1.00, 68.00, 98.00, 9.00, 72.00, 23.00, 9, 69, 41, 5, 85, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(32, 31.00, 7.00, 5.00, 57.00, 87.00, 29.00, 79.00, 80.00, 45.00, 68.00, 8.00, 43.00, 92.00, 27.00, 3.00, 52.00, 81.00, 55.00, 95.00, 5, 65, 32, 10, 63, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(33, 66.00, 6.00, 5.00, 8.00, 86.00, 32.00, 29.00, 7.00, 53.00, 61.00, 31.00, 59.00, 50.00, 12.00, 45.00, 17.00, 76.00, 8.00, 12.00, 8, 63, 34, 6, 257, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(34, 96.00, 4.00, 5.00, 51.00, 51.00, 27.00, 32.00, 48.00, 23.00, 90.00, 99.00, 52.00, 48.00, 49.00, 90.00, 42.00, 85.00, 21.00, 47.00, 10, 65, 39, 8, 170, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(35, 48.00, 5.00, 5.00, 16.00, 96.00, 46.00, 36.00, 26.00, 28.00, 59.00, 30.00, 22.00, 25.00, 92.00, 67.00, 45.00, 27.00, 61.00, 39.00, 7, 65, 41, 6, 59, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(36, 43.00, 6.00, 5.00, 2.00, 57.00, 65.00, 60.00, 59.00, 26.00, 64.00, 13.00, 97.00, 94.00, 75.00, 73.00, 25.00, 6.00, 28.00, 49.00, 3, 62, 36, 1, 108, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(37, 42.00, 0.00, 5.00, 78.00, 23.00, 57.00, 81.00, 95.00, 33.00, 25.00, 41.00, 29.00, 20.00, 43.00, 69.00, 9.00, 11.00, 85.00, 60.00, 9, 67, 41, 4, 21, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(38, 82.00, 7.00, 5.00, 26.00, 24.00, 78.00, 99.00, 10.00, 91.00, 33.00, 10.00, 59.00, 8.00, 57.00, 9.00, 87.00, 50.00, 28.00, 95.00, 5, 65, 40, 1, 103, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(39, 38.00, 4.00, 5.00, 59.00, 13.00, 61.00, 5.00, 31.00, 98.00, 29.00, 47.00, 38.00, 26.00, 44.00, 87.00, 28.00, 85.00, 86.00, 92.00, 8, 68, 36, 5, 155, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(40, 73.00, 7.00, 5.00, 33.00, 14.00, 74.00, 44.00, 3.00, 36.00, 69.00, 54.00, 65.00, 57.00, 76.00, 66.00, 37.00, 30.00, 94.00, 4.00, 7, 65, 34, 1, 233, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(41, 89.00, 6.00, 5.00, 23.00, 7.00, 36.00, 49.00, 52.00, 89.00, 77.00, 37.00, 38.00, 15.00, 60.00, 90.00, 6.00, 94.00, 36.00, 24.00, 6, 66, 37, 8, 82, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(42, 51.00, 8.00, 5.00, 31.00, 19.00, 88.00, 89.00, 55.00, 64.00, 18.00, 25.00, 92.00, 61.00, 80.00, 27.00, 73.00, 94.00, 96.00, 96.00, 6, 71, 37, 10, 230, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(43, 2.00, 0.00, 5.00, 9.00, 19.00, 47.00, 12.00, 55.00, 32.00, 38.00, 48.00, 98.00, 32.00, 14.00, 15.00, 73.00, 55.00, 13.00, 87.00, 8, 68, 41, 5, 38, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(44, 8.00, 8.00, 5.00, 18.00, 8.00, 12.00, 13.00, 62.00, 97.00, 15.00, 34.00, 98.00, 34.00, 69.00, 70.00, 68.00, 43.00, 98.00, 19.00, 8, 70, 35, 4, 68, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(45, 23.00, 8.00, 5.00, 26.00, 19.00, 73.00, 30.00, 18.00, 10.00, 68.00, 78.00, 42.00, 6.00, 23.00, 92.00, 39.00, 74.00, 42.00, 32.00, 2, 68, 32, 7, 66, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(46, 56.00, 1.00, 5.00, 91.00, 33.00, 38.00, 20.00, 38.00, 45.00, 51.00, 29.00, 16.00, 92.00, 21.00, 17.00, 50.00, 91.00, 71.00, 27.00, 7, 67, 32, 8, 92, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(47, 38.00, 1.00, 5.00, 87.00, 84.00, 32.00, 27.00, 47.00, 7.00, 11.00, 61.00, 25.00, 36.00, 51.00, 3.00, 53.00, 54.00, 90.00, 99.00, 1, 64, 33, 6, 41, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(48, 85.00, 6.00, 5.00, 87.00, 64.00, 98.00, 22.00, 65.00, 41.00, 51.00, 73.00, 92.00, 15.00, 82.00, 83.00, 59.00, 9.00, 27.00, 47.00, 8, 63, 39, 5, 53, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(49, 97.00, 0.00, 5.00, 70.00, 67.00, 49.00, 39.00, 41.00, 26.00, 6.00, 63.00, 64.00, 94.00, 27.00, 71.00, 31.00, 24.00, 74.00, 63.00, 6, 68, 37, 6, 127, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(50, 33.00, 9.00, 5.00, 52.00, 77.00, 51.00, 95.00, 42.00, 23.00, 95.00, 80.00, 49.00, 80.00, 2.00, 13.00, 31.00, 85.00, 61.00, 69.00, 3, 64, 35, 4, 132, '2020-10-28 06:23:51', '2020-10-28 06:23:51'),
(51, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 67, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(52, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 76, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(53, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 89, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 114, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(55, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 115, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(56, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 120, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(57, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 135, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 164, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(59, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 172, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(60, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 192, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(61, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 201, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 209, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(63, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 226, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(64, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6, 253, 35, 20, 0, '2020-11-16 23:43:40', '2020-11-16 23:43:40'),
(65, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 67, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 76, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(67, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 89, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(68, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 114, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(69, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 115, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 120, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(71, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 135, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(72, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 164, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(73, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 172, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 192, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(75, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 201, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(76, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 209, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(77, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 226, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10, 253, 41, 17, 0, '2020-11-22 01:17:48', '2020-11-22 01:17:48'),
(79, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 62, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(80, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 69, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(81, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 70, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 100, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(83, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 101, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(84, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 107, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(85, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 112, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 144, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(87, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 159, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(88, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 166, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(89, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 178, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 188, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(91, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 247, 41, 27, 0, '2021-01-02 03:57:31', '2021-01-02 03:57:31'),
(92, 91.92, 0.00, 10.00, 15.00, 0.00, 0.00, 0.00, 0.00, 24.00, 0.00, 12.00, 0.00, 0.00, 25.00, 0.00, 0.00, 50.00, 0.00, 0.00, 1, 66, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(93, 96.92, 0.00, 10.00, 15.00, 0.00, 0.00, 0.00, 0.00, 35.00, 0.00, 12.00, 0.00, 0.00, 23.00, 0.00, 0.00, 45.00, 0.00, 0.00, 1, 110, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(94, 78.42, 0.00, 10.00, 15.00, 0.00, 0.00, 0.00, 0.00, 20.00, 0.00, 12.00, 0.00, 0.00, 22.00, 0.00, 0.00, 42.00, 0.00, 0.00, 1, 124, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(95, 85.08, 0.00, 8.00, 15.00, 0.00, 0.00, 0.00, 0.00, 25.00, 0.00, 12.00, 0.00, 0.00, 10.00, 0.00, 0.00, 50.00, 0.00, 0.00, 1, 137, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(96, 84.92, 0.00, 7.00, 15.00, 0.00, 0.00, 0.00, 0.00, 22.00, 0.00, 12.00, 0.00, 0.00, 20.00, 0.00, 0.00, 48.00, 0.00, 0.00, 1, 157, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(97, 85.50, 0.00, 6.00, 12.00, 0.00, 0.00, 0.00, 0.00, 27.00, 0.00, 12.00, 0.00, 0.00, 23.00, 0.00, 0.00, 43.00, 0.00, 0.00, 1, 210, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(98, 53.17, 0.00, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 28.00, 0.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 21.00, 0.00, 0.00, 1, 239, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(99, 56.50, 0.00, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 30.00, 0.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 25.00, 0.00, 0.00, 1, 267, 32, 16, 12, '2021-03-23 05:20:31', '2021-03-23 05:20:31'),
(100, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 82, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(101, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 149, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(102, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 153, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(103, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 162, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(104, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 168, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(105, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 206, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:08'),
(106, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 212, 32, 16, 0, '2021-03-28 04:45:08', '2021-03-28 04:45:09'),
(107, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 229, 32, 16, 0, '2021-03-28 04:45:09', '2021-03-28 04:45:09'),
(108, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 230, 32, 16, 0, '2021-03-28 04:45:09', '2021-03-28 04:45:09'),
(109, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 238, 32, 16, 0, '2021-03-28 04:45:09', '2021-03-28 04:45:09'),
(110, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 248, 32, 16, 0, '2021-03-28 04:45:09', '2021-03-28 04:45:09'),
(111, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 249, 32, 16, 0, '2021-03-28 04:45:09', '2021-03-28 04:45:09'),
(113, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 90, 32, 1, 0, '2021-04-01 05:31:10', '2021-04-01 05:31:10'),
(114, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 133, 32, 1, 0, '2021-04-01 05:31:10', '2021-04-01 05:31:10'),
(115, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 216, 32, 1, 0, '2021-04-01 05:31:10', '2021-04-01 05:31:10'),
(116, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 223, 32, 1, 0, '2021-04-01 05:31:10', '2021-04-01 05:31:10'),
(117, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 232, 32, 1, 0, '2021-04-01 05:31:10', '2021-04-01 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `grade_systems`
--

CREATE TABLE `grade_systems` (
  `id` int(10) UNSIGNED NOT NULL,
  `grade_system_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` double(8,2) NOT NULL,
  `from_mark` int(11) NOT NULL,
  `to_mark` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_systems`
--

INSERT INTO `grade_systems` (`id`, `grade_system_name`, `grade`, `point`, `from_mark`, `to_mark`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Grade System 1', 'A+', 5.00, 80, 100, 1, 204, '2020-10-28 06:23:48', '2020-10-28 06:23:48'),
(2, 'Grade System 1', 'A', 4.00, 70, 79, 1, 220, '2020-10-28 06:23:48', '2020-10-28 06:23:48'),
(3, 'Grade System 1', 'A-', 3.50, 60, 69, 1, 12, '2021-02-04 10:44:24', '2021-02-04 10:44:24'),
(4, 'Grade System 1', 'B', 3.00, 50, 59, 1, 12, '2021-03-24 09:03:49', '2021-03-24 09:03:49'),
(5, 'Grade System 1', 'C', 2.00, 40, 49, 1, 12, '2021-03-24 09:12:37', '2021-03-24 09:12:37'),
(6, 'Grade System 1', 'D', 1.00, 33, 39, 1, 12, '2021-03-24 09:22:49', '2021-03-24 09:22:49'),
(7, 'Grade System 1', 'F', 0.00, 0, 32, 1, 12, '2021-03-24 09:23:11', '2021-03-24 09:23:11'),
(8, 'Grade System 2', 'A', 4.00, 35, 39, 1, 12, '2021-03-24 09:28:05', '2021-04-01 12:00:59'),
(9, 'Grade System 2', 'A+', 5.00, 40, 50, 1, 12, '2021-03-24 09:33:13', '2021-04-01 12:00:11'),
(10, 'Grade System 2', 'A-', 3.50, 30, 34, 1, 12, '2021-04-01 12:01:35', '2021-04-01 12:01:35'),
(11, 'Grade System 2', 'B', 3.00, 25, 29, 1, 12, '2021-04-01 12:02:33', '2021-04-01 12:02:33'),
(12, 'Grade System 2', 'C', 2.00, 20, 24, 1, 12, '2021-04-01 12:02:51', '2021-04-01 12:02:51'),
(13, 'Grade System 2', 'D', 1.00, 17, 19, 1, 12, '2021-04-01 12:03:21', '2021-04-01 12:03:58'),
(14, 'Grade System 2', 'F', 0.00, 0, 16, 1, 12, '2021-04-01 12:03:37', '2021-04-01 12:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `file_path`, `description`, `teacher_id`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'https://www.schamberger.biz/sed-nemo-officiis-assumenda-temporibus-exercitationem-distinctio', 'Dolorem rerum voluptates rerum voluptatem quia nulla. Culpa iste consequuntur maiores quia. Veniam rerum laboriosam voluptatum.', 61, 19, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(2, 'http://www.vandervort.com/odit-ut-quisquam-officiis-occaecati-qui', 'Tenetur id vero totam voluptas. Ratione alias praesentium dolores quia. Ut est iusto aspernatur at.', 48, 17, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(3, 'http://grady.biz/', 'Autem voluptas suscipit incidunt est. Alias vel aut omnis quia in fugit ea. Voluptatem amet aliquam saepe voluptatibus.', 35, 6, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(4, 'http://www.volkman.com/molestiae-qui-minus-reiciendis-aut-nam-aperiam', 'Voluptates unde voluptates recusandae dignissimos tenetur voluptas ut. Blanditiis nihil quasi rerum repellendus consequatur. Ut molestiae tempora impedit id quia et molestiae.', 61, 8, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(5, 'http://www.yost.com/aspernatur-accusamus-voluptatem-dolor-ducimus-autem-ut', 'Ipsam omnis perferendis quis dolorem. Rerum dolor nesciunt repellendus voluptatem laborum. Voluptatem occaecati velit saepe ut est quam.', 40, 10, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(6, 'https://kuhic.com/delectus-harum-et-veritatis-nihil-eum-quam-nulla-aut.html', 'Qui magni aspernatur doloremque officiis ex. Mollitia sed rerum culpa. Laborum quia modi qui numquam dolor pariatur.', 61, 18, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(7, 'https://crona.org/asperiores-est-tenetur-quas-et-quo-est.html', 'Veniam eveniet molestias qui molestiae totam ab fugit. Ab asperiores magnam provident non ut pariatur impedit. Aliquam voluptas voluptas alias id dolorem fugit.', 35, 18, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(8, 'http://weber.com/fugiat-laborum-temporibus-voluptatem', 'Veritatis qui blanditiis omnis at modi. A expedita beatae nisi dolor. Distinctio omnis est incidunt atque.', 45, 15, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(9, 'http://www.heidenreich.net/ab-sit-modi-eius-quia-qui-ullam.html', 'Id voluptatum et voluptas odit. In ut nisi rerum qui odit. Quisquam commodi explicabo quia at.', 40, 2, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(10, 'http://hirthe.com/quia-cum-non-dignissimos-alias-corporis.html', 'Optio ea laborum consequatur nobis et nihil sed. Necessitatibus officiis voluptas eius laboriosam dolor quam ea. Voluptatem quis animi distinctio iste dicta.', 45, 18, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(11, 'http://www.jakubowski.com/', 'Sunt at soluta et inventore omnis cum. Iste officiis rerum incidunt ab possimus odio. Voluptas optio assumenda aut nihil et.', 36, 10, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(12, 'http://mcdermott.net/', 'Iste necessitatibus in laborum qui blanditiis esse. Quis natus quasi ullam nemo. Placeat dolore enim voluptatem quasi soluta alias fugiat.', 52, 7, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(13, 'http://www.kub.biz/', 'Repellat aliquam culpa sit blanditiis et. Vero hic ut sequi aspernatur. Nihil provident consequatur ut voluptates aspernatur exercitationem.', 36, 11, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(14, 'http://www.lebsack.com/similique-qui-reiciendis-sed-nihil-consequatur-et-quia', 'Sit necessitatibus nobis voluptatem sed laudantium nihil. Qui commodi ipsa magnam in. Sequi deserunt autem consequatur et.', 32, 10, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(15, 'http://www.murphy.com/officia-ut-tempora-earum-sed', 'Sed est quasi adipisci est quo nostrum. Et impedit expedita similique temporibus aperiam ea. Molestiae veritatis rem repellat dolorum aut dolorum.', 46, 5, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(16, 'http://ratke.net/numquam-nisi-cupiditate-voluptatibus-qui-dignissimos-harum.html', 'Aliquid et voluptas quaerat non voluptates. Unde saepe consectetur et magnam enim sint. Enim fugiat est voluptatem.', 35, 15, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(17, 'http://www.littel.com/', 'Explicabo illum nesciunt labore. Qui facilis commodi asperiores consequuntur quis quo et. Voluptatibus soluta adipisci officiis atque eos qui.', 50, 17, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(18, 'http://kunze.com/enim-alias-veniam-voluptas-et-voluptas-molestiae-veniam.html', 'Beatae provident tempore inventore ipsa magni dignissimos autem vel. Delectus iure molestiae qui debitis omnis. Vero dolores voluptate dolores ut et.', 54, 11, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(19, 'http://kihn.com/', 'Totam iste vel magni velit dolorum. Dolore aut quaerat aut non officiis quis. Repudiandae sit quibusdam fugiat voluptatem assumenda omnis autem.', 49, 4, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(20, 'http://www.rutherford.com/recusandae-voluptate-quasi-cumque-consequatur-incidunt-dolor-et', 'Voluptatibus dolorum impedit et est amet eius voluptas aut. Voluptatem consectetur beatae rerum sequi ex. Voluptatibus eius hic quisquam dolorem non autem perferendis.', 40, 15, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(21, 'http://www.schmidt.com/', 'Ea enim quasi doloremque et consectetur et. Ex reprehenderit hic facere est delectus ut. Magni est sit cum aliquid voluptates quisquam.', 45, 11, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(22, 'https://labadie.com/cupiditate-odio-nisi-veritatis-officiis-quo.html', 'Aut doloremque voluptates amet exercitationem repellendus quas beatae. Recusandae culpa voluptatibus ut ipsam dolor explicabo. Voluptatibus sit eaque corrupti fugiat molestias et.', 58, 11, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(23, 'https://parker.com/inventore-eveniet-vel-eum-reprehenderit.html', 'Natus culpa sunt aut numquam. Est et est iure maiores consequatur voluptatem. Quidem eum autem ullam aut quibusdam.', 44, 16, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(24, 'https://www.lang.org/quam-corrupti-necessitatibus-blanditiis', 'Hic error autem molestiae vitae at aut accusamus magnam. Fuga et totam placeat voluptas commodi reprehenderit harum. At et quod enim ut doloremque similique fuga aspernatur.', 37, 17, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(25, 'https://casper.com/voluptatem-sunt-enim-totam-et.html', 'Optio illo occaecati quasi impedit et exercitationem quisquam autem. Dignissimos sapiente ea officiis numquam reprehenderit. Voluptas voluptatem enim illum maxime est aliquam libero.', 44, 19, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(26, 'http://buckridge.com/et-veniam-eum-modi-distinctio-minus-consequatur-qui', 'Vel temporibus rerum fugiat ut ut fuga nemo. Cumque saepe itaque vel quidem dolorum saepe ducimus. Ut iste dolorem et quidem aliquid pariatur reprehenderit.', 41, 8, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(27, 'https://morissette.biz/voluptatem-sequi-maxime-repudiandae-sapiente-sit-sed.html', 'Vel et cupiditate et. Quae accusamus optio soluta reprehenderit rerum excepturi quia. Sed similique labore cumque.', 61, 19, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(28, 'http://hodkiewicz.com/aut-itaque-et-ut', 'Dolores consequatur voluptas cumque mollitia unde. A error et optio suscipit. Velit a qui eos reprehenderit et.', 35, 10, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(29, 'http://www.wisoky.biz/cupiditate-unde-enim-est-quia-tenetur-animi-dicta', 'Reiciendis odit dolorem sint aliquid ea nemo. Est ut rem voluptatum rerum. Similique et pariatur nesciunt dolor in voluptatem ullam.', 47, 20, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(30, 'http://www.hand.net/', 'Voluptatum nobis et eos cupiditate molestias eos autem. Cupiditate aut ullam reiciendis ad. Ex nisi maiores temporibus rerum aut.', 45, 4, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(31, 'http://www.wiegand.com/quod-nihil-officiis-dolore', 'Aut aperiam vel et eligendi. Saepe quo minima blanditiis et quasi. Eligendi cupiditate aut consequuntur blanditiis aut aut.', 40, 5, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(32, 'http://www.crist.com/nisi-consectetur-quia-soluta-aut-ad-eum-aut-asperiores.html', 'Quasi ullam deleniti rerum qui est blanditiis. Ipsa quis est labore tenetur nam similique distinctio. Dolor qui et sint voluptas illum quas.', 55, 15, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(33, 'http://www.murray.com/', 'Rerum ullam dignissimos fugit assumenda. Quisquam voluptatem rerum laboriosam molestias omnis. Et iusto odio qui laboriosam atque cumque.', 33, 1, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(34, 'http://kihn.biz/cumque-vitae-adipisci-deserunt-rerum-velit', 'Laudantium et voluptas temporibus maiores nisi. Blanditiis minima exercitationem omnis quia natus eum. Libero voluptatem cumque qui tenetur aut rerum ullam.', 34, 4, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(35, 'http://www.wintheiser.info/', 'Aliquid et error deleniti beatae. Voluptatibus sed sit quia similique dolor praesentium consequuntur. Sunt enim aut ducimus rerum voluptatum et itaque.', 39, 20, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(36, 'http://bergnaum.info/iste-est-voluptates-nihil-asperiores-dolore-repellendus-rerum.html', 'Repellendus amet quam voluptatem quo maxime et. Sed magni aut aut aut dolorem atque aut. Veritatis voluptas eaque dignissimos earum.', 61, 14, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(37, 'http://grimes.com/quos-labore-rerum-et-id', 'Quisquam nostrum quae quidem rerum enim ipsa ut. Ipsam consectetur accusamus ab quo officiis eos. Architecto magnam dolorem molestias ullam mollitia quia fugit.', 46, 6, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(38, 'http://cronin.org/et-aut-voluptatem-est-ex-similique-deserunt-animi', 'Id expedita et qui qui autem quia. Necessitatibus possimus magni cum magnam voluptate ea rem. Temporibus aut porro est voluptatem dolores enim ut.', 46, 19, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(39, 'https://koelpin.com/et-est-sunt-tenetur-id-sit-sed-quos.html', 'Voluptatibus et sunt minima ex odio aut expedita. Facere inventore optio est quia nulla maxime deserunt. Tempora illo repellat ut et delectus temporibus.', 41, 4, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(40, 'http://legros.com/sunt-aperiam-aliquid-soluta', 'Modi veniam quo totam nisi. Voluptatem ea et tempora. Eaque quis aut non quas.', 37, 12, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(41, 'http://hyatt.com/cupiditate-sit-qui-recusandae', 'Asperiores fugiat quasi enim est. Numquam iusto voluptatibus est eveniet corporis sed. Ratione nulla ullam tempora maiores qui enim.', 37, 12, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(42, 'http://harvey.org/provident-corrupti-quod-magni-eligendi-qui-laboriosam-molestias-et.html', 'Consectetur voluptatem suscipit voluptatem sequi dicta sit quaerat nihil. Dolorem magni ipsum cupiditate quo vel repellendus delectus. Nobis ea qui non.', 46, 18, '2020-10-28 06:23:43', '2020-10-28 06:23:43'),
(43, 'http://stanton.com/molestiae-et-repellat-veritatis-ipsum-beatae', 'Delectus et qui eum ut fugit sint natus. Illo commodi eum dolore. Quos impedit error et dolore voluptatum.', 50, 17, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(44, 'http://www.kunde.com/quis-sapiente-omnis-dolorem-et-quas-expedita.html', 'Voluptatibus ad facere neque enim ut ad vel. In iusto voluptatem qui pariatur ut autem. Explicabo autem quisquam consequatur est eum labore.', 61, 19, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(45, 'http://luettgen.org/', 'At repellat reiciendis nihil ratione nisi eos. Deleniti voluptatum ipsam dolorum blanditiis et voluptate. Natus natus quisquam expedita ipsa.', 58, 12, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(46, 'http://www.west.com/', 'Ratione voluptas quia rerum est fugiat autem harum. Optio provident deleniti similique libero voluptates. At qui est neque dicta.', 34, 19, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(47, 'http://oconner.com/omnis-nemo-suscipit-qui-tenetur-corporis-temporibus', 'Ab est molestiae harum alias reprehenderit minus quia. Eos optio et non aliquam est corporis. Quaerat dolorem quibusdam aliquid neque voluptatem.', 54, 17, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(48, 'http://veum.com/sed-et-consequuntur-iusto-laboriosam-dolores', 'Asperiores voluptates eum voluptas error non necessitatibus. Molestiae nulla quam aut eum autem aut. Hic rerum neque delectus porro quis voluptate vero.', 59, 15, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(49, 'http://schroeder.biz/natus-aperiam-est-sint-reiciendis-blanditiis-voluptatem-soluta', 'Nesciunt est nostrum alias et debitis. Quam recusandae qui quia id qui. Quae et est nihil aliquam.', 33, 14, '2020-10-28 06:23:44', '2020-10-28 06:23:44'),
(50, 'http://www.herman.com/consequatur-consectetur-ratione-perferendis-sequi-et-provident', 'Praesentium ut perspiciatis vel quos similique nostrum commodi. Repudiandae illum et ea voluptas. Voluptas consectetur officiis odit dicta adipisci.', 49, 19, '2020-10-28 06:23:44', '2020-10-28 06:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `school_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Emrul', 'Welcome fvfv', 1, '2020-12-27 06:58:57', '2021-02-24 05:42:30'),
(3, 1, 'MD. EMRUL HASSAN', 'hg', 1, '2020-12-28 09:40:54', '2020-12-28 09:40:54'),
(4, 1, 'Md. Asifuzzaman', 'xcvbnm,', 1, '2021-01-25 10:19:04', '2021-01-25 10:19:04'),
(5, 1, 'asif', 'cdxc', 1, '2021-03-25 12:08:42', '2021-03-25 12:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `important_links`
--

CREATE TABLE `important_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parioty` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `important_links`
--

INSERT INTO `important_links` (`id`, `school_id`, `link`, `name`, `parioty`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'http://www.educationboard.gov.bd/', 'Ministry of Education', 1, 1, '2020-12-28 06:00:10', '2020-12-28 06:00:10'),
(3, 1, 'http://www.dshe.gov.bd/', 'secondary and higher secondary education', 2, 1, '2020-12-28 06:01:02', '2020-12-28 06:01:02'),
(4, 1, 'http://www.moedu.gov.bd/', 'Ministry of Education', 3, 1, '2020-12-28 06:01:38', '2020-12-28 06:01:38'),
(5, 1, 'http://www.educationboardresults.gov.bd/regular/index.php', 'Education Board Results', 4, 1, '2020-12-28 06:05:22', '2020-12-28 06:05:22'),
(6, 1, 'http://www.nctb.gov.bd/', 'E-Book', 5, 1, '2020-12-28 06:05:59', '2020-12-28 06:05:59'),
(7, 1, 'http://erp.dhakaeducationboard.gov.bd/index.php/auth/login', 'STUDENT FORMFILLUP', 6, 1, '2020-12-28 06:07:22', '2020-12-28 06:07:22'),
(8, 1, 'https://www.teachers.gov.bd/', 'shikkhokbatayon', 7, 1, '2020-12-28 06:11:06', '2020-12-28 06:11:06'),
(9, 1, 'http://mmc.e-service.gov.bd/', 'mmc.e-service', 8, 1, '2020-12-28 06:11:46', '2020-12-28 06:11:46'),
(10, 1, 'http://banbeis.gov.bd/new/', 'banbeis', 9, 1, '2020-12-28 06:12:31', '2020-12-28 06:12:31'),
(11, 1, 'http://www.dhaka.gov.bd/', 'Dhaka Zilla', 10, 1, '2020-12-28 06:13:21', '2020-12-28 06:13:21'),
(12, 1, 'http://www.dpe.gov.bd/', 'Directorate of Primary Education', 11, 1, '2020-12-28 06:19:24', '2020-12-28 06:19:24'),
(13, 1, 'http://www.nape.gov.bd/', 'National Academy for Primary Education (NAPE), Bangladesh', 12, 1, '2020-12-28 06:23:29', '2020-12-28 06:24:42'),
(14, 1, 'http://www.moedu.gov.bd/', 'Ministry of Education', 13, 1, '2020-12-28 06:24:19', '2020-12-28 06:24:19'),
(15, 1, 'http://dhakaeducationboard.gov.bd/', 'Dhakaeducationboard, Dhaka', 14, 1, '2020-12-28 06:25:25', '2020-12-28 06:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_code` int(11) NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine` decimal(8,2) NOT NULL,
  `borrowed` tinyint(4) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `student_code`, `book_id`, `quantity`, `school_id`, `issue_date`, `return_date`, `fine`, `borrowed`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 9887213, 47, 19, 27, '1972-06-14', '1983-07-12', '5.00', 1, 14, '2020-10-28 06:24:06', '2020-10-28 06:24:06'),
(2, 8871304, 20, 5, 39, '1971-06-15', '1970-08-15', '19.00', 1, 22, '2020-10-28 06:24:06', '2020-10-28 06:24:06'),
(3, 3550635, 10, 5, 36, '1993-05-08', '1993-12-21', '8.00', 1, 35, '2020-10-28 06:24:06', '2020-10-28 06:24:06'),
(4, 6874785, 21, 13, 4, '1971-08-02', '1977-11-16', '34.00', 0, 199, '2020-10-28 06:24:06', '2020-10-28 06:24:06'),
(5, 8104302, 8, 13, 35, '1987-07-18', '2020-05-02', '34.00', 0, 155, '2020-10-28 06:24:06', '2020-10-28 06:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `lets_encripts`
--

CREATE TABLE `lets_encripts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initialIp` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lets_encripts`
--

INSERT INTO `lets_encripts` (`id`, `school_id`, `domain`, `initialIp`, `account_id`, `order_id`, `status`, `expires`, `filename`, `content`, `object_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'schoolone.foqas.org', NULL, NULL, NULL, 'domain_added', NULL, 'dd', 'dddd', '6325', '2020-12-30 05:33:46', '2020-12-30 05:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `parent` bigint(20) NOT NULL DEFAULT 0,
  `url` tinyint(4) DEFAULT NULL COMMENT '1=url,2=dropdown',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '	1=static,2=dynamic	',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `school_id`, `name`, `priority`, `parent`, `url`, `slug`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(2, 1, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(3, 1, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(4, 1, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(5, 1, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(6, 1, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(7, 1, 'Committee', 1, 2, 1, 'committee', 1, 1, NULL, NULL),
(8, 1, 'Our School', 2, 2, 1, 'about', 1, 1, NULL, NULL),
(9, 2, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(10, 2, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(11, 2, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(12, 2, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(13, 2, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(14, 2, 'Contact', 6, 0, 1, 'contact', 1, 1, NULL, NULL),
(15, 2, 'Committee', 1, 10, 1, 'committee', 1, 1, NULL, NULL),
(16, 2, 'Our School', 2, 10, 1, 'about', 1, 1, NULL, NULL),
(20, 1, 'Admission', 6, 0, 2, '#', 1, 1, '2021-01-10 08:00:34', '2021-01-10 08:00:34'),
(21, 1, 'Apply Admission', 1, 20, 1, 'admission/apply', 1, 1, NULL, NULL),
(22, 1, 'Download Application', 2, 20, 1, 'admission/download', 1, 1, NULL, NULL),
(23, 1, 'Download Admitcard', 3, 20, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(24, 1, 'Merit List', 4, 20, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(25, 56, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(26, 56, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(27, 56, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(28, 56, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(29, 56, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(30, 56, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(31, 56, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(32, 56, 'Committee', 1, 26, 1, 'committee', 1, 1, NULL, NULL),
(33, 56, 'Our School', 2, 26, 1, 'about', 1, 1, NULL, NULL),
(34, 56, 'Apply Admission', 1, 30, 1, 'admission/apply', 1, 1, NULL, NULL),
(35, 56, 'Download Application', 2, 30, 1, 'admission/download', 1, 1, NULL, NULL),
(36, 56, 'Download Admitcard', 3, 30, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(37, 56, 'Merit List', 4, 30, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(38, 57, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(39, 57, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(40, 57, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(41, 57, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(42, 57, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(43, 57, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(44, 57, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(45, 57, 'Committee', 1, 39, 1, 'committee', 1, 1, NULL, NULL),
(46, 57, 'Our School', 2, 39, 1, 'about', 1, 1, NULL, NULL),
(47, 57, 'Apply Admission', 1, 43, 1, 'admission/apply', 1, 1, NULL, NULL),
(48, 57, 'Download Application', 2, 43, 1, 'admission/download', 1, 1, NULL, NULL),
(49, 57, 'Download Admitcard', 3, 43, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(50, 57, 'Merit List', 4, 43, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(51, 58, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(52, 58, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(53, 58, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(54, 58, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(55, 58, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(56, 58, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(57, 58, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(58, 58, 'Committee', 1, 52, 1, 'committee', 1, 1, NULL, NULL),
(59, 58, 'Our School', 2, 52, 1, 'about', 1, 1, NULL, NULL),
(60, 58, 'Apply Admission', 1, 56, 1, 'admission/apply', 1, 1, NULL, NULL),
(61, 58, 'Download Application', 2, 56, 1, 'admission/download', 1, 1, NULL, NULL),
(62, 58, 'Download Admitcard', 3, 56, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(63, 58, 'Merit List', 4, 56, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(64, 59, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(65, 59, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(66, 59, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(67, 59, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(68, 59, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(69, 59, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(70, 59, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(71, 59, 'Committee', 1, 65, 1, 'committee', 1, 1, NULL, NULL),
(72, 59, 'Our School', 2, 65, 1, 'about', 1, 1, NULL, NULL),
(73, 59, 'Apply Admission', 1, 69, 1, 'admission/apply', 1, 1, NULL, NULL),
(74, 59, 'Download Application', 2, 69, 1, 'admission/download', 1, 1, NULL, NULL),
(75, 59, 'Download Admitcard', 3, 69, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(76, 59, 'Merit List', 4, 69, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(77, 60, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(78, 60, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(79, 60, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(80, 60, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(81, 60, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(82, 60, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(83, 60, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(84, 60, 'Committee', 1, 78, 1, 'committee', 1, 1, NULL, NULL),
(85, 60, 'Our School', 2, 78, 1, 'about', 1, 1, NULL, NULL),
(86, 60, 'Apply Admission', 1, 82, 1, 'admission/apply', 1, 1, NULL, NULL),
(87, 60, 'Download Application', 2, 82, 1, 'admission/download', 1, 1, NULL, NULL),
(88, 60, 'Download Admitcard', 3, 82, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(89, 60, 'Merit List', 4, 82, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(90, 61, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(91, 61, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(92, 61, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(93, 61, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(94, 61, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(95, 61, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(96, 61, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(97, 61, 'Committee', 1, 91, 1, 'committee', 1, 1, NULL, NULL),
(98, 61, 'Our School', 2, 91, 1, 'about', 1, 1, NULL, NULL),
(99, 61, 'Apply Admission', 1, 95, 1, 'admission/apply', 1, 1, NULL, NULL),
(100, 61, 'Download Application', 2, 95, 1, 'admission/download', 1, 1, NULL, NULL),
(101, 61, 'Download Admitcard', 3, 95, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(102, 61, 'Merit List', 4, 95, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(103, 62, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(104, 62, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(105, 62, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(106, 62, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(107, 62, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(108, 62, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(109, 62, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(110, 62, 'Committee', 1, 104, 1, 'committee', 1, 1, NULL, NULL),
(111, 62, 'Our School', 2, 104, 1, 'about', 1, 1, NULL, NULL),
(112, 62, 'Apply Admission', 1, 108, 1, 'admission/apply', 1, 1, NULL, NULL),
(113, 62, 'Download Application', 2, 108, 1, 'admission/download', 1, 1, NULL, NULL),
(114, 62, 'Download Admitcard', 3, 108, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(115, 62, 'Merit List', 4, 108, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(116, 63, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(117, 63, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(118, 63, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(119, 63, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(120, 63, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(121, 63, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(122, 63, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(123, 63, 'Committee', 1, 117, 1, 'committee', 1, 1, NULL, NULL),
(124, 63, 'Our School', 2, 117, 1, 'about', 1, 1, NULL, NULL),
(125, 63, 'Apply Admission', 1, 121, 1, 'admission/apply', 1, 1, NULL, NULL),
(126, 63, 'Download Application', 2, 121, 1, 'admission/download', 1, 1, NULL, NULL),
(127, 63, 'Download Admitcard', 3, 121, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(128, 63, 'Merit List', 4, 121, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(129, 64, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(130, 64, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(131, 64, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(132, 64, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(133, 64, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(134, 64, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(135, 64, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(136, 64, 'Committee', 1, 130, 1, 'committee', 1, 1, NULL, NULL),
(137, 64, 'Our School', 2, 130, 1, 'about', 1, 1, NULL, NULL),
(138, 64, 'Apply Admission', 1, 134, 1, 'admission/apply', 1, 1, NULL, NULL),
(139, 64, 'Download Application', 2, 134, 1, 'admission/download', 1, 1, NULL, NULL),
(140, 64, 'Download Admitcard', 3, 134, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(141, 64, 'Merit List', 4, 134, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(142, 65, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(143, 65, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(144, 65, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(145, 65, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(146, 65, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(147, 65, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(148, 65, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(149, 65, 'Committee', 1, 143, 1, 'committee', 1, 1, NULL, NULL),
(150, 65, 'Our School', 2, 143, 1, 'about', 1, 1, NULL, NULL),
(151, 65, 'Apply Admission', 1, 147, 1, 'admission/apply', 1, 1, NULL, NULL),
(152, 65, 'Download Application', 2, 147, 1, 'admission/download', 1, 1, NULL, NULL),
(153, 65, 'Download Admitcard', 3, 147, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(154, 65, 'Merit List', 4, 147, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(155, 66, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(156, 66, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(157, 66, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(158, 66, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(159, 66, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(160, 66, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(161, 66, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(162, 66, 'Committee', 1, 156, 1, 'committee', 1, 1, NULL, NULL),
(163, 66, 'Our School', 2, 156, 1, 'about', 1, 1, NULL, NULL),
(164, 66, 'Apply Admission', 1, 160, 1, 'admission/apply', 1, 1, NULL, NULL),
(165, 66, 'Download Application', 2, 160, 1, 'admission/download', 1, 1, NULL, NULL),
(166, 66, 'Download Admitcard', 3, 160, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(167, 66, 'Merit List', 4, 160, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(168, 67, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(169, 67, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(170, 67, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(171, 67, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(172, 67, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(173, 67, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(174, 67, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(175, 67, 'Committee', 1, 169, 1, 'committee', 1, 1, NULL, NULL),
(176, 67, 'Our School', 2, 169, 1, 'about', 1, 1, NULL, NULL),
(177, 67, 'Apply Admission', 1, 173, 1, 'admission/apply', 1, 1, NULL, NULL),
(178, 67, 'Download Application', 2, 173, 1, 'admission/download', 1, 1, NULL, NULL),
(179, 67, 'Download Admitcard', 3, 173, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(180, 67, 'Merit List', 4, 173, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(181, 68, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(182, 68, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(183, 68, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(184, 68, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(185, 68, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(186, 68, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(187, 68, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(188, 68, 'Committee', 1, 182, 1, 'committee', 1, 1, NULL, NULL),
(189, 68, 'Our School', 2, 182, 1, 'about', 1, 1, NULL, NULL),
(190, 68, 'Apply Admission', 1, 186, 1, 'admission/apply', 1, 1, NULL, NULL),
(191, 68, 'Download Application', 2, 186, 1, 'admission/download', 1, 1, NULL, NULL),
(192, 68, 'Download Admitcard', 3, 186, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(193, 68, 'Merit List', 4, 186, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(194, 69, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(195, 69, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(196, 69, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(197, 69, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(198, 69, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(199, 69, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(200, 69, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(201, 69, 'Committee', 1, 195, 1, 'committee', 1, 1, NULL, NULL),
(202, 69, 'Our School', 2, 195, 1, 'about', 1, 1, NULL, NULL),
(203, 69, 'Apply Admission', 1, 199, 1, 'admission/apply', 1, 1, NULL, NULL),
(204, 69, 'Download Application', 2, 199, 1, 'admission/download', 1, 1, NULL, NULL),
(205, 69, 'Download Admitcard', 3, 199, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(206, 69, 'Merit List', 4, 199, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(207, 70, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(208, 70, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(209, 70, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(210, 70, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(211, 70, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(212, 70, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(213, 70, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(214, 70, 'Committee', 1, 208, 1, 'committee', 1, 1, NULL, NULL),
(215, 70, 'Our School', 2, 208, 1, 'about', 1, 1, NULL, NULL),
(216, 70, 'Apply Admission', 1, 212, 1, 'admission/apply', 1, 1, NULL, NULL),
(217, 70, 'Download Application', 2, 212, 1, 'admission/download', 1, 1, NULL, NULL),
(218, 70, 'Download Admitcard', 3, 212, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(219, 70, 'Merit List', 4, 212, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(220, 71, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(221, 71, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(222, 71, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(223, 71, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(224, 71, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(225, 71, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(226, 71, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(227, 71, 'Committee', 1, 221, 1, 'committee', 1, 1, NULL, NULL),
(228, 71, 'Our School', 2, 221, 1, 'about', 1, 1, NULL, NULL),
(229, 71, 'Apply Admission', 1, 225, 1, 'admission/apply', 1, 1, NULL, NULL),
(230, 71, 'Download Application', 2, 225, 1, 'admission/download', 1, 1, NULL, NULL),
(231, 71, 'Download Admitcard', 3, 225, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(232, 71, 'Merit List', 4, 225, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(233, 72, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(234, 72, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(235, 72, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(236, 72, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(237, 72, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(238, 72, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(239, 72, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(240, 72, 'Committee', 1, 234, 1, 'committee', 1, 1, NULL, NULL),
(241, 72, 'Our School', 2, 234, 1, 'about', 1, 1, NULL, NULL),
(242, 72, 'Apply Admission', 1, 238, 1, 'admission/apply', 1, 1, NULL, NULL),
(243, 72, 'Download Application', 2, 238, 1, 'admission/download', 1, 1, NULL, NULL),
(244, 72, 'Download Admitcard', 3, 238, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(245, 72, 'Merit List', 4, 238, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(246, 73, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(247, 73, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(248, 73, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(249, 73, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(250, 73, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(251, 73, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(252, 73, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(253, 73, 'Committee', 1, 247, 1, 'committee', 1, 1, NULL, NULL),
(254, 73, 'Our School', 2, 247, 1, 'about', 1, 1, NULL, NULL),
(255, 73, 'Apply Admission', 1, 251, 1, 'admission/apply', 1, 1, NULL, NULL),
(256, 73, 'Download Application', 2, 251, 1, 'admission/download', 1, 1, NULL, NULL),
(257, 73, 'Download Admitcard', 3, 251, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(258, 73, 'Merit List', 4, 251, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(259, 74, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(260, 74, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(261, 74, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(262, 74, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(263, 74, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(264, 74, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(265, 74, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(266, 74, 'Committee', 1, 260, 1, 'committee', 1, 1, NULL, NULL),
(267, 74, 'Our School', 2, 260, 1, 'about', 1, 1, NULL, NULL),
(268, 74, 'Apply Admission', 1, 264, 1, 'admission/apply', 1, 1, NULL, NULL),
(269, 74, 'Download Application', 2, 264, 1, 'admission/download', 1, 1, NULL, NULL),
(270, 74, 'Download Admitcard', 3, 264, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(271, 74, 'Merit List', 4, 264, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(272, 75, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(273, 75, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(274, 75, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(275, 75, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(276, 75, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(277, 75, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(278, 75, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(279, 75, 'Committee', 1, 273, 1, 'committee', 1, 1, NULL, NULL),
(280, 75, 'Our School', 2, 273, 1, 'about', 1, 1, NULL, NULL),
(281, 75, 'Apply Admission', 1, 277, 1, 'admission/apply', 1, 1, NULL, NULL),
(282, 75, 'Download Application', 2, 277, 1, 'admission/download', 1, 1, NULL, NULL),
(283, 75, 'Download Admitcard', 3, 277, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(284, 75, 'Merit List', 4, 277, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(285, 76, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(286, 76, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(287, 76, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(288, 76, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(289, 76, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(290, 76, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(291, 76, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(292, 76, 'Committee', 1, 286, 1, 'committee', 1, 1, NULL, NULL),
(293, 76, 'Our School', 2, 286, 1, 'about', 1, 1, NULL, NULL),
(294, 76, 'Apply Admission', 1, 290, 1, 'admission/apply', 1, 1, NULL, NULL),
(295, 76, 'Download Application', 2, 290, 1, 'admission/download', 1, 1, NULL, NULL),
(296, 76, 'Download Admitcard', 3, 290, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(297, 76, 'Merit List', 4, 290, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(298, 77, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(299, 77, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(300, 77, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(301, 77, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(302, 77, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(303, 77, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(304, 77, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(305, 77, 'Committee', 1, 299, 1, 'committee', 1, 1, NULL, NULL),
(306, 77, 'Our School', 2, 299, 1, 'about', 1, 1, NULL, NULL),
(307, 77, 'Apply Admission', 1, 303, 1, 'admission/apply', 1, 1, NULL, NULL),
(308, 77, 'Download Application', 2, 303, 1, 'admission/download', 1, 1, NULL, NULL),
(309, 77, 'Download Admitcard', 3, 303, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(310, 77, 'Merit List', 4, 303, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(311, 78, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(312, 78, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(313, 78, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(314, 78, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(315, 78, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(316, 78, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(317, 78, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(318, 78, 'Committee', 1, 312, 1, 'committee', 1, 1, NULL, NULL),
(319, 78, 'Our School', 2, 312, 1, 'about', 1, 1, NULL, NULL),
(320, 78, 'Apply Admission', 1, 316, 1, 'admission/apply', 1, 1, NULL, NULL),
(321, 78, 'Download Application', 2, 316, 1, 'admission/download', 1, 1, NULL, NULL),
(322, 78, 'Download Admitcard', 3, 316, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(323, 78, 'Merit List', 4, 316, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(324, 79, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(325, 79, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(326, 79, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(327, 79, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(328, 79, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(329, 79, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(330, 79, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(331, 79, 'Committee', 1, 325, 1, 'committee', 1, 1, NULL, NULL),
(332, 79, 'Our School', 2, 325, 1, 'about', 1, 1, NULL, NULL),
(333, 79, 'Apply Admission', 1, 329, 1, 'admission/apply', 1, 1, NULL, NULL),
(334, 79, 'Download Application', 2, 329, 1, 'admission/download', 1, 1, NULL, NULL),
(335, 79, 'Download Admitcard', 3, 329, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(336, 79, 'Merit List', 4, 329, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(337, 80, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(338, 80, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(339, 80, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(340, 80, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(341, 80, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(342, 80, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(343, 80, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(344, 80, 'Committee', 1, 338, 1, 'committee', 1, 1, NULL, NULL),
(345, 80, 'Our School', 2, 338, 1, 'about', 1, 1, NULL, NULL),
(346, 80, 'Apply Admission', 1, 342, 1, 'admission/apply', 1, 1, NULL, NULL),
(347, 80, 'Download Application', 2, 342, 1, 'admission/download', 1, 1, NULL, NULL),
(348, 80, 'Download Admitcard', 3, 342, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(349, 80, 'Merit List', 4, 342, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(350, 81, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(351, 81, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(352, 81, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(353, 81, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(354, 81, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(355, 81, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(356, 81, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(357, 81, 'Committee', 1, 351, 1, 'committee', 1, 1, NULL, NULL),
(358, 81, 'Our School', 2, 351, 1, 'about', 1, 1, NULL, NULL),
(359, 81, 'Apply Admission', 1, 355, 1, 'admission/apply', 1, 1, NULL, NULL),
(360, 81, 'Download Application', 2, 355, 1, 'admission/download', 1, 1, NULL, NULL),
(361, 81, 'Download Admitcard', 3, 355, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(362, 81, 'Merit List', 4, 355, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(363, 82, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(364, 82, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(365, 82, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(366, 82, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(367, 82, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(368, 82, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(369, 82, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(370, 82, 'Committee', 1, 364, 1, 'committee', 1, 1, NULL, NULL),
(371, 82, 'Our School', 2, 364, 1, 'about', 1, 1, NULL, NULL),
(372, 82, 'Apply Admission', 1, 368, 1, 'admission/apply', 1, 1, NULL, NULL),
(373, 82, 'Download Application', 2, 368, 1, 'admission/download', 1, 1, NULL, NULL),
(374, 82, 'Download Admitcard', 3, 368, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(375, 82, 'Merit List', 4, 368, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(376, 83, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(377, 83, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(378, 83, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(379, 83, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(380, 83, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(381, 83, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(382, 83, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(383, 83, 'Committee', 1, 377, 1, 'committee', 1, 1, NULL, NULL),
(384, 83, 'Our School', 2, 377, 1, 'about', 1, 1, NULL, NULL),
(385, 83, 'Apply Admission', 1, 381, 1, 'admission/apply', 1, 1, NULL, NULL),
(386, 83, 'Download Application', 2, 381, 1, 'admission/download', 1, 1, NULL, NULL),
(387, 83, 'Download Admitcard', 3, 381, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(388, 83, 'Merit List', 4, 381, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(389, 84, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(390, 84, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(391, 84, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(392, 84, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(393, 84, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(394, 84, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(395, 84, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(396, 84, 'Committee', 1, 390, 1, 'committee', 1, 1, NULL, NULL),
(397, 84, 'Our School', 2, 390, 1, 'about', 1, 1, NULL, NULL),
(398, 84, 'Apply Admission', 1, 394, 1, 'admission/apply', 1, 1, NULL, NULL),
(399, 84, 'Download Application', 2, 394, 1, 'admission/download', 1, 1, NULL, NULL),
(400, 84, 'Download Admitcard', 3, 394, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(401, 84, 'Merit List', 4, 394, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(402, 85, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(403, 85, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(404, 85, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(405, 85, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(406, 85, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(407, 85, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(408, 85, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(409, 85, 'Committee', 1, 403, 1, 'committee', 1, 1, NULL, NULL),
(410, 85, 'Our School', 2, 403, 1, 'about', 1, 1, NULL, NULL),
(411, 85, 'Apply Admission', 1, 407, 1, 'admission/apply', 1, 1, NULL, NULL),
(412, 85, 'Download Application', 2, 407, 1, 'admission/download', 1, 1, NULL, NULL),
(413, 85, 'Download Admitcard', 3, 407, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(414, 85, 'Merit List', 4, 407, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(415, 86, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(416, 86, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(417, 86, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(418, 86, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(419, 86, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(420, 86, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(421, 86, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(422, 86, 'Committee', 1, 416, 1, 'committee', 1, 1, NULL, NULL),
(423, 86, 'Our School', 2, 416, 1, 'about', 1, 1, NULL, NULL),
(424, 86, 'Apply Admission', 1, 420, 1, 'admission/apply', 1, 1, NULL, NULL),
(425, 86, 'Download Application', 2, 420, 1, 'admission/download', 1, 1, NULL, NULL),
(426, 86, 'Download Admitcard', 3, 420, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(427, 86, 'Merit List', 4, 420, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(429, 87, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(430, 87, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(431, 87, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(432, 87, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(433, 87, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(434, 87, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(435, 87, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(436, 87, 'Committee', 1, 430, 1, 'committee', 1, 1, NULL, NULL),
(437, 87, 'Our School', 2, 430, 1, 'about', 1, 1, NULL, NULL),
(438, 87, 'Apply Admission', 1, 434, 1, 'admission/apply', 1, 1, NULL, NULL),
(439, 87, 'Download Application', 2, 434, 1, 'admission/download', 1, 1, NULL, NULL),
(440, 87, 'Verify Application', 3, 434, 1, 'admission/verify', 1, 1, NULL, NULL),
(441, 87, 'Download Application', 4, 434, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(442, 87, 'Merit List', 5, 434, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(443, 88, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(444, 88, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(445, 88, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(446, 88, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(447, 88, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(448, 88, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(449, 88, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(450, 88, 'Committee', 1, 444, 1, 'committee', 1, 1, NULL, NULL),
(451, 88, 'Our School', 2, 444, 1, 'about', 1, 1, NULL, NULL),
(452, 88, 'Apply Admission', 1, 448, 1, 'admission/apply', 1, 1, NULL, NULL),
(453, 88, 'Download Application', 2, 448, 1, 'admission/download', 1, 1, NULL, NULL),
(454, 88, 'Verify Application', 3, 448, 1, 'admission/verify', 1, 1, NULL, NULL),
(455, 88, 'Download Application', 4, 448, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(456, 88, 'Merit List', 5, 448, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(457, 89, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(458, 89, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(459, 89, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(460, 89, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(461, 89, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(462, 89, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(463, 89, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(464, 89, 'Committee', 1, 458, 1, 'committee', 1, 1, NULL, NULL),
(465, 89, 'Our School', 2, 458, 1, 'about', 1, 1, NULL, NULL),
(466, 89, 'Apply Admission', 1, 462, 1, 'admission/apply', 1, 1, NULL, NULL),
(467, 89, 'Download Application', 2, 462, 1, 'admission/download', 1, 1, NULL, NULL),
(468, 89, 'Verify Application', 3, 462, 1, 'admission/verify', 1, 1, NULL, NULL),
(469, 89, 'Download Application', 4, 462, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(470, 89, 'Merit List', 5, 462, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(471, 90, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(472, 90, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(473, 90, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(474, 90, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(475, 90, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(476, 90, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(477, 90, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(478, 90, 'Committee', 1, 472, 1, 'committee', 1, 1, NULL, NULL),
(479, 90, 'Our School', 2, 472, 1, 'about', 1, 1, NULL, NULL),
(480, 90, 'Apply Admission', 1, 476, 1, 'admission/apply', 1, 1, NULL, NULL),
(481, 90, 'Download Application', 2, 476, 1, 'admission/download', 1, 1, NULL, NULL),
(482, 90, 'Verify Application', 3, 476, 1, 'admission/verify', 1, 1, NULL, NULL),
(483, 90, 'Download Application', 4, 476, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(484, 90, 'Merit List', 5, 476, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(485, 91, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(486, 91, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(487, 91, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(488, 91, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(489, 91, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(490, 91, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(491, 91, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(492, 91, 'Committee', 1, 486, 1, 'committee', 1, 1, NULL, NULL),
(493, 91, 'Our School', 2, 486, 1, 'about', 1, 1, NULL, NULL),
(494, 91, 'Apply Admission', 1, 490, 1, 'admission/apply', 1, 1, NULL, NULL),
(495, 91, 'Download Application', 2, 490, 1, 'admission/download', 1, 1, NULL, NULL),
(496, 91, 'Verify Application', 3, 490, 1, 'admission/verify', 1, 1, NULL, NULL),
(497, 91, 'Download Application', 4, 490, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(498, 91, 'Merit List', 5, 490, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(499, 92, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(500, 92, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(501, 92, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(502, 92, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(503, 92, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(504, 92, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(505, 92, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(506, 92, 'Committee', 1, 500, 1, 'committee', 1, 1, NULL, NULL),
(507, 92, 'Our School', 2, 500, 1, 'about', 1, 1, NULL, NULL),
(508, 92, 'Apply Admission', 1, 504, 1, 'admission/apply', 1, 1, NULL, NULL),
(509, 92, 'Download Application', 2, 504, 1, 'admission/download', 1, 1, NULL, NULL),
(510, 92, 'Verify Application', 3, 504, 1, 'admission/verify', 1, 1, NULL, NULL),
(511, 92, 'Download Application', 4, 504, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(512, 92, 'Merit List', 5, 504, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(513, 93, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(514, 93, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(515, 93, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(516, 93, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(517, 93, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(518, 93, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(519, 93, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(520, 93, 'Committee', 1, 514, 1, 'committee', 1, 1, NULL, NULL),
(521, 93, 'Our School', 2, 514, 1, 'about', 1, 1, NULL, NULL),
(522, 93, 'Apply Admission', 1, 518, 1, 'admission/apply', 1, 1, NULL, NULL),
(523, 93, 'Download Application', 2, 518, 1, 'admission/download', 1, 1, NULL, NULL),
(524, 93, 'Verify Application', 3, 518, 1, 'admission/verify', 1, 1, NULL, NULL),
(525, 93, 'Download Application', 4, 518, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(526, 93, 'Merit List', 5, 518, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(527, 94, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(528, 94, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(529, 94, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(530, 94, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(531, 94, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(532, 94, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(533, 94, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(534, 94, 'Committee', 1, 528, 1, 'committee', 1, 1, NULL, NULL),
(535, 94, 'Our School', 2, 528, 1, 'about', 1, 1, NULL, NULL),
(536, 94, 'Apply Admission', 1, 532, 1, 'admission/apply', 1, 1, NULL, NULL),
(537, 94, 'Download Application', 2, 532, 1, 'admission/download', 1, 1, NULL, NULL),
(538, 94, 'Verify Application', 3, 532, 1, 'admission/verify', 1, 1, NULL, NULL),
(539, 94, 'Download Application', 4, 532, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(540, 94, 'Merit List', 5, 532, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(541, 95, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(542, 95, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(543, 95, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(544, 95, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(545, 95, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(546, 95, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(547, 95, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(548, 95, 'Committee', 1, 542, 1, 'committee', 1, 1, NULL, NULL),
(549, 95, 'Our School', 2, 542, 1, 'about', 1, 1, NULL, NULL),
(550, 95, 'Apply Admission', 1, 546, 1, 'admission/apply', 1, 1, NULL, NULL),
(551, 95, 'Download Application', 2, 546, 1, 'admission/download', 1, 1, NULL, NULL),
(552, 95, 'Verify Application', 3, 546, 1, 'admission/verify', 1, 1, NULL, NULL),
(553, 95, 'Download Application', 4, 546, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(554, 95, 'Merit List', 5, 546, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(555, 1, 'Verify Application', 2, 20, 1, 'admission/verify', 1, 1, '2021-03-03 09:56:46', '2021-03-03 09:56:46'),
(556, 96, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(557, 96, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(558, 96, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(559, 96, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(560, 96, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(561, 96, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(562, 96, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(563, 96, 'Committee', 1, 557, 1, 'committee', 1, 1, NULL, NULL),
(564, 96, 'Our School', 2, 557, 1, 'about', 1, 1, NULL, NULL),
(565, 96, 'Apply Admission', 1, 561, 1, 'admission/apply', 1, 1, NULL, NULL),
(566, 96, 'Download Application', 2, 561, 1, 'admission/download', 1, 1, NULL, NULL),
(567, 96, 'Verify Application', 3, 561, 1, 'admission/verify', 1, 1, NULL, NULL),
(568, 96, 'Download Application', 4, 561, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(569, 96, 'Merit List', 5, 561, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(570, 97, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(571, 97, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(572, 97, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(573, 97, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(574, 97, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(575, 97, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(576, 97, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(577, 97, 'Committee', 1, 571, 1, 'committee', 1, 1, NULL, NULL),
(578, 97, 'Our School', 2, 571, 1, 'about', 1, 1, NULL, NULL),
(579, 97, 'Apply Admission', 1, 575, 1, 'admission/apply', 1, 1, NULL, NULL),
(580, 97, 'Download Application', 2, 575, 1, 'admission/download', 1, 1, NULL, NULL),
(581, 97, 'Verify Application', 3, 575, 1, 'admission/verify', 1, 1, NULL, NULL),
(582, 97, 'Download Application', 4, 575, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(583, 97, 'Merit List', 5, 575, 1, 'admission/meritlist', 1, 1, NULL, NULL),
(584, 98, 'Home', 1, 0, 1, '/', 1, 1, NULL, NULL),
(585, 98, 'About Us', 2, 0, 2, '#', 1, 1, NULL, NULL),
(586, 98, 'Teachers', 3, 0, 1, 'teacher', 1, 1, NULL, NULL),
(587, 98, 'Events', 4, 0, 1, 'event', 1, 1, NULL, NULL),
(588, 98, 'Gallery', 5, 0, 1, 'gallery', 1, 1, NULL, NULL),
(589, 98, 'Admission', 6, 0, 2, '#', 1, 1, NULL, NULL),
(590, 98, 'Contact', 7, 0, 1, 'contact', 1, 1, NULL, NULL),
(591, 98, 'Committee', 1, 585, 1, 'committee', 1, 1, NULL, NULL),
(592, 98, 'Our School', 2, 585, 1, 'about', 1, 1, NULL, NULL),
(593, 98, 'Apply Admission', 1, 589, 1, 'admission/apply', 1, 1, NULL, NULL),
(594, 98, 'Download Application', 2, 589, 1, 'admission/download', 1, 1, NULL, NULL),
(595, 98, 'Verify Application', 3, 589, 1, 'admission/verify', 1, 1, NULL, NULL),
(596, 98, 'Download Application', 4, 589, 1, 'admission/admitcard', 1, 1, NULL, NULL),
(597, 98, 'Merit List', 5, 589, 1, 'admission/meritlist', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `phone_number`, `email`, `message`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '6946373', 'broberts@example.com', 'Incidunt esse autem sint ab impedit quibusdam. Consequatur fugit incidunt non sapiente sunt optio. Magnam dolorem praesentium cupiditate.', 38, 27, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(2, '6122039', 'demario.hickle@example.com', 'Dolores corrupti accusamus rerum dolorem facere ut aut. Qui autem nostrum sit qui delectus ullam. Et est non impedit aut sunt voluptatum ipsa voluptatem.', 38, 226, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(3, '5153619', 'grady.alia@example.com', 'Expedita molestiae non eaque aut voluptas odit. Debitis aut esse at repellat voluptatem quaerat. Modi dicta non eum excepturi delectus sunt.', 32, 140, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(4, '5622909', 'kaleb65@example.net', 'Fugit expedita et voluptatem quia dolores cum aut. Qui temporibus sed adipisci numquam. Incidunt beatae corporis rem esse corporis.', 40, 92, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(5, '1457110', 'wreichert@example.org', 'Impedit dignissimos sunt tempora. Et repellat harum eius doloribus qui. Veniam soluta ratione voluptas dicta magni provident quas.', 33, 78, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(6, '7579981', 'powlowski.grant@example.com', 'Aspernatur et et natus ut. Quis sit ut reiciendis nobis maiores rerum. Consequatur ipsam eius ut culpa ducimus animi.', 12, 212, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(7, '4904141', 'balistreri.clemmie@example.org', 'Est quae non occaecati aperiam rem nam occaecati. Est tempora et sequi non optio dolorum qui. Ullam doloribus aut placeat necessitatibus et voluptatibus.', 31, 147, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(8, '1945627', 'hudson.tremblay@example.com', 'Eum accusamus a facere vitae corrupti voluptas in. Assumenda ut occaecati eos sequi. Odio nam error suscipit tenetur voluptas impedit.', 15, 197, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(9, '3239649', 'crona.travon@example.net', 'Veritatis quae autem dignissimos facere veniam consequatur voluptate. Placeat doloribus eos sequi sunt tempora. Ut qui atque qui labore autem.', 36, 146, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(10, '47602', 'ebeer@example.com', 'Illo ratione aut velit eligendi placeat est. Architecto molestias voluptas neque est. Alias ipsum repudiandae enim mollitia.', 19, 223, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(11, '6086714', 'taya.kessler@example.org', 'Ut quae quisquam porro ut cumque incidunt molestiae sunt. Inventore debitis natus et. At totam asperiores rerum rerum quos facere.', 16, 1, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(12, '4675640', 'garrison79@example.com', 'In quo quibusdam debitis impedit. Consequatur assumenda nulla dicta vero deserunt. Ea debitis sint ratione excepturi iusto.', 36, 118, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(13, '7833354', 'eleanore50@example.com', 'Consequatur veniam eum nesciunt numquam. Fugiat quia perferendis aut non aut omnis. Facilis quis eaque in.', 26, 234, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(14, '8064734', 'powlowski.connie@example.org', 'Distinctio et dolores dolores non. Quod mollitia blanditiis cupiditate molestiae. Dolor aut accusamus earum iure amet eos vero.', 28, 96, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(15, '7665246', 'cleta70@example.org', 'Iste odio illum ullam molestias voluptate fuga. Eveniet quisquam tempore repellat dolores et eum ipsa. Eum eos cumque sit dolorem enim ut voluptas.', 15, 48, '2020-10-28 06:24:02', '2020-10-28 06:24:02'),
(16, '2307063', 'hollis67@example.org', 'Accusantium rem et tempore atque incidunt deleniti. Praesentium inventore rerum tenetur saepe distinctio est. Est saepe porro molestiae.', 36, 238, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(17, '1166629', 'ischmidt@example.net', 'Aspernatur optio est quam fuga id maxime qui odio. Cupiditate velit sint aliquid consequuntur. Voluptas earum et omnis nisi quidem pariatur iusto.', 41, 153, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(18, '7493674', 'jeffrey59@example.net', 'Velit expedita velit qui. Rem et sed sint et alias culpa adipisci. Tenetur repudiandae ipsum quibusdam quia voluptas voluptas reiciendis.', 31, 26, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(19, '5173229', 'schmeler.olin@example.net', 'Cumque maiores perspiciatis asperiores veritatis provident. Et et aut reiciendis incidunt et non quam explicabo. Modi ipsa non omnis ducimus voluptatem voluptatem voluptas.', 48, 75, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(20, '414759', 'stehr.serenity@example.com', 'Omnis ab magni reprehenderit voluptatem culpa eligendi. Pariatur molestiae ducimus qui qui. Adipisci praesentium excepturi laborum quis.', 29, 151, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(21, '3610720', 'osborne19@example.com', 'Est voluptas adipisci suscipit quia ipsa. Blanditiis facilis quia et. Id facere aspernatur consequuntur ut.', 24, 92, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(22, '7562477', 'beahan.esther@example.com', 'Sit distinctio consequatur eius dolor omnis. Provident deserunt autem sed eaque est vel minus quis. Sint eum et dolore rem sunt.', 33, 245, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(23, '6764377', 'ihermiston@example.com', 'Perspiciatis voluptatem similique ipsa necessitatibus numquam eligendi cum nulla. Et vitae rerum consequuntur sed molestiae mollitia laboriosam sunt. Earum non voluptatem tempora omnis ipsam atque iure.', 10, 87, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(24, '929494', 'jordane.rosenbaum@example.com', 'Nemo totam nam quidem laudantium exercitationem sint. Sed amet aut alias temporibus dolorem. Est fugiat non ab ab.', 21, 89, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(25, '4756611', 'eloisa90@example.org', 'Deleniti eveniet quasi est nemo. Fugit autem dolores quis sunt maiores. Perferendis tempora deleniti et.', 47, 30, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(26, '945908', 'name92@example.com', 'Enim et explicabo qui quia necessitatibus harum. Beatae qui perspiciatis vero. Accusantium facere et enim ea unde voluptatibus.', 13, 233, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(27, '7493206', 'jabari.wehner@example.net', 'Sunt odio dolorem dolore sunt. Atque omnis numquam accusamus. Dolor ipsam dolore sapiente repudiandae eum.', 44, 171, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(28, '2386270', 'bmckenzie@example.org', 'Animi a voluptas aut repellendus architecto et. Nihil mollitia itaque enim. Maiores reprehenderit quia dolor dolores dolore.', 29, 86, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(29, '3155984', 'alda21@example.net', 'Nihil et eum et ullam ut. Fugit quidem sit aperiam voluptatum nisi non est. Odio repellendus aut blanditiis qui voluptas distinctio harum.', 49, 220, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(30, '2942472', 'syost@example.com', 'A laudantium libero unde soluta. Est alias molestiae numquam repellendus ea sapiente. Maxime reiciendis veniam voluptas soluta modi id sunt.', 29, 231, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(31, '4433965', 'dpaucek@example.org', 'Dolor saepe maiores temporibus itaque quo ut. Doloremque voluptas magnam nostrum aspernatur consequuntur laudantium. Modi nostrum fugiat voluptates possimus.', 12, 36, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(32, '9932582', 'ametz@example.net', 'Suscipit quis quibusdam quaerat in eos est enim deleniti. Fugiat quis sequi eligendi in suscipit. Et nemo aut et sunt minus.', 39, 124, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(33, '1997202', 'skuhlman@example.com', 'Magni quam libero tenetur ut sequi molestiae. Dolor autem sit quis. Minima ipsum quasi accusantium expedita odit dolorum iure.', 33, 223, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(34, '4353344', 'giovanni.kuphal@example.net', 'Veniam perferendis nostrum delectus corporis itaque nihil molestiae quo. Facilis quisquam est laudantium corrupti. Inventore cupiditate vel quisquam velit beatae pariatur.', 38, 67, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(35, '6889209', 'maurine.boehm@example.com', 'Libero libero voluptatem iure nesciunt ex. Veritatis a earum est veniam vero aspernatur sint autem. Aliquid blanditiis voluptatem reiciendis officia iste labore.', 13, 6, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(36, '4779240', 'lawson.reichert@example.org', 'Quis fugiat dolor numquam sit repudiandae soluta delectus in. Assumenda itaque enim nemo tempore tempore hic. Vel voluptatem blanditiis adipisci expedita earum.', 27, 42, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(37, '2498382', 'kamren69@example.org', 'Voluptates ut quia assumenda beatae. Illum debitis labore voluptatum debitis. Pariatur rerum quo et repudiandae.', 36, 230, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(38, '269424', 'sbins@example.com', 'Aliquam amet quae natus alias esse quia. Quod saepe architecto nihil sint voluptate at aut. Delectus sint quos repellat ratione minima placeat et.', 33, 126, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(39, '3741456', 'jmccullough@example.net', 'Iure eveniet dolorum voluptas error consequatur hic blanditiis. Ratione ipsam eos voluptas et velit. Voluptas aperiam quas recusandae alias incidunt veniam laborum.', 10, 245, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(40, '7556275', 'beahan.elisabeth@example.org', 'Error sed quos veniam placeat sint similique voluptatem. Tempore quo maxime delectus quia eveniet non. Quos dolorem non hic pariatur quas.', 6, 134, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(41, '8138629', 'xblick@example.com', 'Veritatis vero sit et facilis. Dolorum rerum veritatis ab. Ipsam eos neque dolores in quo.', 43, 141, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(42, '6226848', 'hanna.muller@example.com', 'Voluptatem distinctio veritatis aliquid tempora doloribus rem. Sit iure dolorum eum qui praesentium. Optio recusandae magni ad molestias.', 20, 87, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(43, '7348383', 'wlangosh@example.net', 'Voluptatem omnis aut aut libero cupiditate. Rem molestias consequatur autem et. Sit non magnam ab velit quia deserunt.', 47, 149, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(44, '2237159', 'parker.kendrick@example.org', 'Reiciendis accusantium dolorum veritatis qui maiores itaque. Ducimus recusandae quis rem dolores corporis et. Aut quibusdam debitis aut voluptatibus aliquid.', 27, 93, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(45, '7444728', 'marge.mayer@example.com', 'Quasi quisquam totam aut beatae esse voluptatem voluptatem. Nemo aliquid quisquam iste laboriosam pariatur molestiae. Aspernatur sit illum cumque rem quidem assumenda rerum.', 23, 159, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(46, '3799579', 'silas95@example.org', 'Occaecati quia voluptate molestiae tenetur fuga officia corrupti. Et laborum ipsa temporibus. Reiciendis eos ipsa quia voluptatem velit adipisci.', 34, 112, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(47, '5421832', 'bhauck@example.net', 'Ea sint occaecati eum sunt nobis est. Et soluta consequatur est. Esse dolores error harum quo delectus.', 42, 156, '2020-10-28 06:24:03', '2020-10-28 06:24:03'),
(48, '8100969', 'elmer.beer@example.net', 'Consectetur qui sint deserunt in tenetur qui doloremque. Aspernatur qui non temporibus facilis amet dolore mollitia. Nisi eveniet id deleniti eos atque.', 24, 71, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(49, '4634306', 'amccullough@example.net', 'Tempora ex labore quaerat. Autem esse saepe consequatur harum ab. In id voluptates nisi nesciunt nisi placeat quod.', 41, 132, '2020-10-28 06:24:04', '2020-10-28 06:24:04'),
(50, '773620', 'rfritsch@example.com', 'Cumque saepe sapiente a vel. Fugit sint id nemo debitis quasi. Dolores atque et magnam quam omnis sed iusto.', 11, 41, '2020-10-28 06:24:04', '2020-10-28 06:24:04');

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
(1, '2014_10_12_000000_create_schools_table', 1),
(2, '2014_10_12_100000_create_users_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_12_21_065735_create_exams_table', 1),
(9, '2017_12_27_025313_create_password_resets_table', 1),
(10, '2017_12_27_025349_create_attendances_table', 1),
(11, '2017_12_27_025413_create_classes_table', 1),
(12, '2017_12_27_025427_create_sections_table', 1),
(13, '2017_12_27_025450_create_syllabuses_table', 1),
(14, '2017_12_27_025503_create_notices_table', 1),
(15, '2017_12_27_025512_create_events_table', 1),
(16, '2017_12_27_025530_create_homeworks_table', 1),
(17, '2017_12_27_025542_create_routines_table', 1),
(18, '2017_12_27_025556_create_grades_table', 1),
(19, '2017_12_27_025612_create_notifications_table', 1),
(20, '2017_12_27_025631_create_feedbacks_table', 1),
(21, '2017_12_27_025644_create_books_table', 1),
(23, '2017_12_27_025738_create_forms_table', 1),
(24, '2017_12_27_025751_create_messages_table', 1),
(25, '2017_12_27_025806_create_faqs_table', 1),
(26, '2018_02_06_161642_create_fees_table', 1),
(27, '2018_03_26_105657_create_grade_systems_table', 1),
(28, '2018_03_27_153448_create_issued_books_table', 1),
(29, '2018_04_01_195635_create_accounts_table', 1),
(30, '2018_04_01_195715_create_account_sectors_table', 1),
(31, '2018_04_29_121233_create_student_infos_table', 1),
(32, '2018_04_29_121517_create_student_board_exams_table', 1),
(33, '2018_10_05_163435_create_exam_for_classes_table', 1),
(34, '2018_10_08_002853_add_department_class_teacher_to_users_table', 1),
(35, '2018_10_09_093606_add_term_start_end_date_to_exams_table', 1),
(36, '2018_10_09_203125_create_departments_table', 1),
(37, '2019_04_08_105033_add_class_id_to_syllabuses_table', 1),
(38, '2019_04_08_121149_add_section_id_to_routines_table', 1),
(39, '2019_04_25_101700_add_active_to_exam_for_class_table', 1),
(40, '2019_05_03_000001_create_customer_columns', 1),
(43, '2019_05_10_151601_add_stripe_fields_in_users_table', 1),
(44, '2019_05_10_163920_create_stripe_subscription_table', 1),
(46, '2020_07_24_201246_create_certificates_table', 1),
(47, '2020_11_23_130829_create_teacherinfos_table', 2),
(48, '2020_11_23_155625_create_degrees_table', 2),
(49, '2020_11_23_160206_create_admissions_table', 2),
(51, '2020_12_06_151934_create_pre_admissions_table', 3),
(52, '2020_12_06_114109_create_settings_table', 4),
(53, '2020_12_13_181053_create_committees_table', 5),
(54, '2020_12_20_115601_create_sliders_table', 6),
(55, '2020_12_21_124258_create_menus_table', 7),
(56, '2020_12_22_110949_create_contents_table', 8),
(57, '2020_12_23_134055_create_contacts_table', 9),
(58, '2020_12_24_114916_create_galleries_table', 10),
(59, '2020_12_26_144929_create_complains_table', 11),
(60, '2020_12_27_112814_create_houses_table', 12),
(61, '2020_12_27_141758_create_sessions_table', 13),
(62, '2020_12_27_155257_create_testimonials_table', 14),
(63, '2020_12_27_172050_create_important_links_table', 15),
(64, '2020_12_28_141029_create_lets_encripts_table', 16),
(65, '2020_12_31_130205_create_categories_table', 17),
(67, '2021_01_05_125942_create_templete_designs_table', 18),
(68, '2017_12_27_025727_create_courses_table', 19),
(69, '2021_01_09_151801_create_course_groups_table', 19),
(70, '2021_01_09_152830_create_assign_teachers_table', 19),
(71, '2021_01_11_133002_create_dues_table', 20),
(72, '2019_05_10_193135_create_payments_table', 21),
(73, '2021_01_27_165214_create_school_payments_table', 22),
(74, '2021_01_28_132749_create_expenses_table', 23),
(76, '2021_02_07_152402_create_agents_table', 24),
(77, '2021_02_10_145605_create_failed_jobs_table', 25),
(78, '2021_02_10_165658_create_pricings_table', 25),
(83, '2019_05_03_000003_create_subscription_items_table', 26),
(84, '2019_05_03_000002_create_subscriptions_table', 27),
(86, '2021_03_01_163920_create_subscriptions_table', 28),
(87, '2021_03_02_105234_create_admission_payments_table', 29),
(88, '2021_03_18_074050_create_course_configs_table', 30),
(89, '2021_03_24_113934_create_course_attendances_table', 31),
(90, '2021_03_28_120418_alter_table_student_infos', 32);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `file_path`, `title`, `slug`, `description`, `active`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610171852.jpeg', 'asdsad', 'asdsad', '<p>fsfsf</p>', 1, 1, 12, '2021-01-03 11:36:08', '2021-01-09 05:57:32'),
(2, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610173549.pdf', 'Shihab Vai Apnake Notice Dewa holo', 'shihab', '<p>hkjuygtfds</p>', 1, 1, 12, '2021-01-09 05:17:15', '2021-01-09 06:25:50'),
(3, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610173587.jpeg', 'Arun Vai Apnake Notice Dewa holo', 'arun-vai-apanke', '<p>hkjuygtfds</p>', 1, 1, 12, '2021-01-09 05:18:10', '2021-01-09 06:26:28'),
(4, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610173602.png', 'Md. Asifuzzaman', 'md-asifuzzaman', '<p>dsvsgvg</p>', 1, 1, 12, '2021-01-09 05:38:09', '2021-01-09 06:26:42'),
(5, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610173615.png', 'Asif', 'asif', '<p>&nbsp;bvbvb</p>', 1, 1, 12, '2021-01-09 05:43:17', '2021-01-09 06:26:55'),
(6, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1610175954.doc', 'Khela Hobe', 'khela-hobe', '<p>z</p>', 1, 1, 12, '2021-01-09 07:05:55', '2021-01-09 07:05:55'),
(7, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/4971615800727.jpg', 'IPSITA COMPUTERS PTE LTD', 'ipsita-computers-pte-ltd', '<p>IPSITA COMPUTERS PTE LTD</p>', 1, 1, 12, '2021-03-15 09:32:07', '2021-03-15 09:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `sent_status` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sent_status`, `active`, `message`, `student_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Et consequatur laboriosam eum aperiam asperiores id. Expedita nesciunt autem atque ullam vero vitae voluptas eligendi. Corrupti porro excepturi blanditiis odio.', 249, 109, '2020-10-28 06:23:46', '2020-10-28 06:23:46'),
(2, 0, 0, 'Omnis fuga quas non facere repellendus. Delectus neque repellendus dolores sunt repellat. Suscipit iste maxime eum cupiditate mollitia rerum.', 230, 206, '2020-10-28 06:23:46', '2020-10-28 06:23:46'),
(3, 1, 1, 'Neque officiis doloremque culpa quis explicabo. Dolores est maiores sit non mollitia autem molestiae. Et esse id aut.', 125, 134, '2020-10-28 06:23:46', '2020-10-28 06:23:46'),
(4, 0, 1, 'Tenetur impedit vero rerum corrupti. Aperiam molestias ut praesentium. Non unde reiciendis laboriosam et perferendis.', 73, 92, '2020-10-28 06:23:46', '2020-10-28 06:23:46'),
(5, 1, 1, 'Aut ad vel sed eaque natus aut. Laboriosam ducimus aut culpa quaerat cupiditate corrupti hic et. Sed ex veritatis et nihil iusto doloremque.', 250, 239, '2020-10-28 06:23:46', '2020-10-28 06:23:46'),
(6, 1, 0, 'Adipisci est dignissimos ipsa ducimus magni possimus saepe. Quidem in ipsum ad qui aperiam. At sunt eligendi quisquam odit.', 110, 218, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(7, 1, 1, 'Aperiam quae qui corrupti et. Quasi non et asperiores quisquam molestiae delectus. Fugit aut ut aut dolores non modi.', 242, 151, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(8, 0, 1, 'Illo maxime aliquam et ullam iure dolorem quaerat. Omnis et expedita aut cumque quia rerum enim. Quos voluptas omnis minus accusantium facilis sapiente eum unde.', 234, 18, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(9, 0, 0, 'Accusantium minima mollitia officiis eius quas eveniet. Ut non quis nostrum quis quo itaque et odit. Ut officiis vel velit harum deserunt eligendi eos beatae.', 111, 126, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(10, 1, 0, 'Error deleniti aut earum. Eum et aut occaecati dolorem ipsam et ut. Esse explicabo reiciendis id tempore atque laboriosam rerum.', 251, 105, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(11, 1, 0, 'At ut voluptas voluptatem voluptate autem ut quo. Sed placeat minima molestiae possimus. Consequatur sequi et rerum minus quia sit aut.', 181, 185, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(12, 0, 1, 'Ut vel enim ut maiores accusamus repellat. Rerum minima debitis optio ducimus repellat itaque possimus. Ut sint sunt rerum inventore optio labore.', 107, 48, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(13, 0, 0, 'Saepe eum architecto eum fugiat dolorem quis sit pariatur. Modi quam et veritatis corporis a aut est. Laborum quos voluptatem rerum eum qui et est.', 79, 168, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(14, 1, 1, 'Est quia non omnis dolorum consequuntur aliquid distinctio. Fugiat est non nobis sit. Ad commodi quia pariatur recusandae.', 148, 34, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(15, 0, 1, 'Temporibus rerum doloribus labore sequi rem in dignissimos. Omnis ullam vitae id et. Quam non voluptate voluptas omnis.', 250, 35, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(16, 0, 0, 'Magni minima qui error corrupti. Et maiores ipsam est. Impedit libero enim iure est.', 247, 54, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(17, 1, 1, 'Distinctio minima distinctio provident perspiciatis velit inventore. Voluptates omnis facere hic et vel delectus et nam. Dolores dolorum quia quis placeat.', 173, 148, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(18, 0, 0, 'Qui quam eum odio illo esse quia. Illum commodi consequatur in harum. Reiciendis culpa molestiae nesciunt sint quis modi ullam.', 163, 216, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(19, 0, 1, 'In cupiditate molestiae ducimus numquam expedita eos. Et magnam ut sed nostrum. Sit et et aut ratione quasi.', 191, 259, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(20, 0, 1, 'Velit est sit molestiae totam suscipit consequatur explicabo saepe. Eligendi et est aspernatur ducimus eum beatae. Eligendi numquam voluptatem odit natus.', 195, 253, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(21, 1, 0, 'Aut quis eum omnis et et non rerum. Quibusdam cupiditate sit unde velit. Non harum eaque voluptatem repudiandae qui.', 146, 222, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(22, 0, 1, 'Omnis eum et ad minima. Nam accusantium quia facilis ipsa. Quae libero alias et sit aperiam.', 175, 102, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(23, 1, 0, 'Et et doloremque perferendis quos occaecati. Et qui libero rerum ad. Sapiente quia cupiditate sit ipsam aliquid.', 119, 181, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(24, 0, 1, 'Quia consequatur ullam reprehenderit voluptates omnis ut sunt. Adipisci animi et maxime molestias numquam animi. Et sed eaque quas sint consectetur sequi praesentium velit.', 146, 26, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(25, 0, 1, 'Similique sunt labore deleniti suscipit quos. Incidunt ipsum perferendis unde non perferendis. Perferendis est et vel.', 254, 39, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(26, 0, 0, 'Repudiandae aspernatur velit alias dolorem et nostrum. Non repellat tempore dolore doloremque reprehenderit aut sunt. Quaerat et velit non repudiandae ab.', 168, 136, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(27, 1, 1, 'Dicta et et hic nulla quam. Occaecati nihil iusto eos dicta non. Est autem voluptatem et labore.', 120, 190, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(28, 0, 0, 'Harum et itaque unde velit eaque quasi. Aliquam non sit aut et delectus. Et placeat vel dolorem iste consequatur.', 184, 78, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(29, 0, 1, 'Aspernatur cumque accusantium ut quo similique. Molestias dolores tenetur alias id odit quidem iure quo. Aut voluptatem animi ipsum quo reprehenderit dolores veritatis.', 72, 204, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(30, 0, 1, 'Consectetur aut minus sunt ea ut. Perspiciatis vel doloribus sit. Itaque id temporibus et blanditiis.', 183, 236, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(31, 1, 0, 'Sunt saepe sed sunt officiis ea. Illo animi cumque beatae beatae illo ipsam. Qui tempore excepturi adipisci cum perspiciatis quaerat repellendus.', 84, 209, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(32, 1, 1, 'Amet amet quia et atque officiis minus. Doloremque veniam et vero sint. Quaerat non eveniet sit modi aut id qui.', 89, 166, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(33, 1, 0, 'Laboriosam perferendis hic sint qui. Ut omnis praesentium et id ut fugiat. Rem aspernatur nobis quisquam sit.', 171, 250, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(34, 0, 0, 'Repellendus dolores unde itaque inventore corporis fuga error vel. Voluptatem quas est et odit repudiandae aspernatur possimus. Odit in sit minus qui voluptatem.', 66, 247, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(35, 0, 0, 'Voluptas mollitia omnis fuga. Tempore maxime praesentium harum praesentium labore. Magnam sit blanditiis omnis autem est.', 246, 32, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(36, 0, 0, 'Et iure at unde dolorum non. Assumenda inventore ipsum delectus sed. Rem voluptatem pariatur expedita.', 240, 174, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(37, 1, 1, 'Eius quia hic delectus ut nobis nobis ut. Et alias laboriosam quidem perferendis expedita. Consequuntur numquam maxime mollitia iusto.', 145, 143, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(38, 1, 0, 'Sed qui ex beatae nesciunt. Perferendis et architecto fugit maiores qui amet impedit fugiat. Quaerat sit sint ducimus in voluptas.', 100, 173, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(39, 1, 0, 'Sint at quam facere earum omnis corrupti. Veniam voluptas nisi incidunt vero officiis reiciendis. Ullam in nihil vitae quos excepturi qui.', 87, 72, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(40, 0, 0, 'Quaerat vitae veritatis harum repellendus aut excepturi sapiente. Velit ullam ratione laborum sit sint maxime ipsa et. Et placeat et voluptas accusamus doloremque repellat.', 138, 234, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(41, 1, 1, 'Dolores perspiciatis ipsum sint sunt vitae quas impedit. Dolorem incidunt placeat quas accusantium est aperiam quas ea. Repudiandae non accusantium ut praesentium.', 208, 11, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(42, 1, 0, 'Ut iusto quia laudantium repudiandae. Perspiciatis voluptas ut et rerum ea possimus. Quibusdam voluptas voluptas aut nulla consectetur.', 206, 112, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(43, 1, 0, 'Quisquam sed vero in corporis esse. Totam repellendus voluptatem quisquam repudiandae eligendi. Quia rerum quos optio molestiae perspiciatis.', 82, 81, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(44, 1, 1, 'Dolor non voluptatibus nostrum qui. Non quia labore hic omnis sit. Labore quas rerum consequatur illo.', 155, 226, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(45, 0, 1, 'Quisquam voluptatem sapiente velit eveniet. Ut voluptatem unde suscipit velit. Perferendis architecto eius nobis sequi dolorem occaecati.', 220, 133, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(46, 0, 0, 'Fugit eum molestias accusantium amet voluptatem. Unde et eaque eligendi. Et rerum occaecati reprehenderit quae in.', 175, 161, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(47, 0, 0, 'Qui ea et eligendi incidunt aperiam. Rerum rerum deserunt aut voluptatem illo quos. Aliquam hic hic nobis ut quia voluptas magnam.', 247, 27, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(48, 0, 0, 'Ad tempore atque dolorem. Vitae quasi rem omnis minima a est. Quam voluptatem enim non corporis vero et ad.', 73, 78, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(49, 0, 0, 'Voluptas consequuntur optio exercitationem id. Veritatis est exercitationem consectetur voluptatem soluta animi non. Deleniti illum nihil inventore ullam ipsum quibusdam odit sit.', 131, 140, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(50, 0, 0, 'Sit mollitia dolorum dolores mollitia perspiciatis et. Est natus aut voluptates et rerum dolores non. Sunt enim reiciendis dolorem sit libero ut.', 107, 139, '2020-10-28 06:23:47', '2020-10-28 06:23:47'),
(51, 1, 1, '<p>rsdfdsf</p>', 192, 41, '2020-12-05 03:57:10', '2020-12-05 03:57:10'),
(52, 1, 1, '<p>rsdfdsf</p>', 201, 41, '2020-12-05 03:57:10', '2020-12-05 03:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'School Management Personal Access Client', 'LKNnzfkBfvbsvcv9klBQts3lcRJL4BM8BHmKAUli', NULL, 'http://localhost', 1, 0, 0, '2020-12-20 07:59:04', '2020-12-20 07:59:04'),
(2, NULL, 'School Management Password Grant Client', 'nyxAXMR8XAEnpJeU9DWinEvnBVyq2YT2JkDt1S78', 'users', 'http://localhost', 0, 1, 0, '2020-12-20 07:59:05', '2020-12-20 07:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-12-20 07:59:05', '2020-12-20 07:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
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

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shihab@gmail.com', '$2y$10$clVjPiQBzOfcw7U9EGB0JOj8eLrpCHtPyaTS322xEgPCBOSJQum.C', '2020-11-15 11:13:25'),
('arun24542@gmail.com', '$2y$10$q8C4jm/9Qc9BV5r.C.MUdufEkkolCgS4R94pdsFp4x8AGeOXkYRAe', '2020-12-07 08:22:55'),
('pobitro.pobi@gmail.com', '$2y$10$69jaYqm5dzVmwJ1baz6y6ORIHXPNwTOwZ4JflpvgzJLdIRupJ6nNW', '2020-12-07 09:24:43'),
('mdshihabuddinm@gmail.com', '$2y$10$8LFUcqMA7ajcRV6l0TzxIOsIdOqCg8TuHRRDb7uuKHdKdnXAFYc..', '2020-12-08 05:38:59'),
('branch@demo.com', '$2y$10$VvG0N1VlGoVCJPLMVIlFT.tBWSft6hE8Kyn0/ufRfGDfdg16ZYKPK', '2021-02-06 12:17:01'),
('admin@demo.com', '$2y$10$pqS7eSP95PWrQb75IC2j9OkFLgEm6DssfWjhEUUPA6VaqNXu7uvOe', '2021-02-06 12:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `reciept_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(25,2) NOT NULL,
  `waiver` double(25,2) DEFAULT NULL,
  `payment_type` tinyint(4) NOT NULL COMMENT '1=Cash, 2=SSLCommerz, 3=strip, 4=paypal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `school_id`, `user_id`, `student_id`, `reciept_number`, `total`, `waiver`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 107, 'FA202102101V8E3', 2100.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(2, 1, 12, 144, 'FA20210210BW7HK', 3150.00, 1200.00, 1, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(3, 1, 12, 62, 'FA20210210W6O0S', 670.00, 0.00, 1, '2021-02-10 10:36:39', '2021-02-10 10:36:39'),
(4, 1, 12, 78, 'FA20210210HIIMG', 2550.00, 500.00, 1, '2021-02-10 10:41:27', '2021-02-10 10:41:27'),
(5, 1, 12, 94, 'FA20210210ELIGU', 3100.00, 0.00, 1, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(6, 1, 12, 178, 'FA20210211EJRSX', 3770.00, 0.00, 1, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(7, 1, 12, 166, 'FA20210211L68LH', 3250.00, 1000.00, 1, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(8, 1, 12, 101, 'FA20210211R5WHJ', 2000.00, 0.00, 1, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(9, 1, 12, 144, 'FA202102144NNMQ', 100.00, 100.00, 1, '2021-02-14 05:31:56', '2021-02-14 05:31:56'),
(10, 1, 12, 66, 'FA20210215L75C2', 120.00, 0.00, 1, '2021-02-15 11:54:22', '2021-02-15 11:54:22'),
(11, 1, 12, 100, 'FA202102173V4ME', 700.00, 0.00, 1, '2021-02-17 04:52:10', '2021-02-17 04:52:10'),
(12, 1, 12, 100, 'FA20210217RHC63', 3170.00, 0.00, 1, '2021-02-17 05:00:23', '2021-02-17 05:00:23'),
(13, 1, 12, 166, 'FA20210217DPKOP', 620.00, 0.00, 1, '2021-02-17 07:43:40', '2021-02-17 07:43:40'),
(14, 1, 12, 178, 'FA20210217G9XXT', 100.00, 0.00, 1, '2021-02-17 07:45:19', '2021-02-17 07:45:19'),
(15, 1, 12, 247, 'FA20210217DVBP0', 500.00, 0.00, 1, '2021-02-17 09:27:16', '2021-02-17 09:27:16'),
(19, 1, 12, 70, 'FA20210320UDICW', 150.00, 0.00, 1, '2021-03-20 07:12:46', '2021-03-20 07:12:46'),
(20, 1, 12, 70, 'FA20210320OTRDM', 400.00, 0.00, 1, '2021-03-20 07:14:34', '2021-03-20 07:14:34'),
(21, 1, 12, 70, 'FA202103202BBVC', 150.00, 0.00, 1, '2021-03-20 07:14:38', '2021-03-20 07:14:38'),
(22, 1, 12, 70, 'FA20210320CK', 2000.00, 0.00, 1, '2021-03-20 07:15:27', '2021-03-20 07:15:27'),
(23, 1, 12, 70, 'FA20210320NWO6O', 270.00, 0.00, 1, '2021-03-20 07:16:31', '2021-03-20 07:16:31'),
(24, 1, 12, 188, 'FA20210320MH', 500.00, 0.00, 1, '2021-03-20 07:29:24', '2021-03-20 07:29:24'),
(25, 1, 12, 188, 'FA0320260104', 750.00, 0.00, 1, '2021-03-20 07:47:30', '2021-03-20 07:47:30'),
(26, 1, 12, 69, 'FA0320831945', 700.00, 0.00, 1, '2021-03-20 08:22:56', '2021-03-20 08:22:56'),
(27, 1, 12, 112, 'FA0320369999', 3870.00, 0.00, 1, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(28, 1, 12, 69, 'FA0320908654', 3170.00, 0.00, 1, '2021-03-20 12:07:34', '2021-03-20 12:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `due_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(25,2) NOT NULL,
  `waiver` double(25,2) NOT NULL DEFAULT 0.00,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `due_id`, `amount`, `waiver`, `payment_id`, `created_at`, `updated_at`) VALUES
(1, 6, 500.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(2, 19, 200.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(3, 32, 300.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(4, 45, 100.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(5, 71, 1000.00, 0.00, 1, '2021-02-10 10:28:49', '2021-02-10 10:28:49'),
(6, 8, 300.00, 200.00, 2, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(7, 21, 200.00, 0.00, 2, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(8, 34, 300.00, 0.00, 2, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(9, 60, 150.00, 0.00, 2, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(10, 73, 1000.00, 1000.00, 2, '2021-02-10 10:34:42', '2021-02-10 10:34:42'),
(11, 53, 150.00, 0.00, 3, '2021-02-10 10:36:39', '2021-02-10 10:36:39'),
(12, 79, 250.00, 0.00, 3, '2021-02-10 10:36:39', '2021-02-10 10:36:39'),
(13, 92, 120.00, 0.00, 3, '2021-02-10 10:36:39', '2021-02-10 10:36:39'),
(14, 105, 150.00, 0.00, 3, '2021-02-10 10:36:39', '2021-02-10 10:36:39'),
(15, 118, 600.00, 0.00, 4, '2021-02-10 10:41:27', '2021-02-10 10:41:27'),
(16, 128, 200.00, 0.00, 4, '2021-02-10 10:41:27', '2021-02-10 10:41:27'),
(17, 138, 250.00, 0.00, 4, '2021-02-10 10:41:27', '2021-02-10 10:41:27'),
(18, 168, 1000.00, 500.00, 4, '2021-02-10 10:41:27', '2021-02-10 10:41:27'),
(19, 119, 600.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(20, 129, 200.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(21, 139, 250.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(22, 149, 200.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(23, 159, 350.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(24, 169, 1500.00, 0.00, 5, '2021-02-10 10:42:10', '2021-02-10 10:42:10'),
(25, 11, 500.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(26, 24, 200.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(27, 37, 300.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(28, 50, 100.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(29, 63, 150.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(30, 76, 2000.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(31, 89, 250.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(32, 102, 120.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(33, 115, 150.00, 0.00, 6, '2021-02-11 06:02:34', '2021-02-11 06:02:34'),
(34, 10, 500.00, 0.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(35, 23, 200.00, 0.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(36, 36, 300.00, 0.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(37, 49, 100.00, 0.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(38, 62, 150.00, 0.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(39, 75, 1000.00, 1000.00, 7, '2021-02-11 06:04:46', '2021-02-11 06:04:46'),
(40, 18, 200.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(41, 31, 300.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(42, 44, 100.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(43, 57, 150.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(44, 70, 1000.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(45, 83, 250.00, 0.00, 8, '2021-02-11 06:07:04', '2021-02-11 06:07:04'),
(46, 47, 0.00, 100.00, 9, '2021-02-14 05:31:56', '2021-02-14 05:31:56'),
(47, 212, 120.00, 0.00, 10, '2021-02-15 11:54:22', '2021-02-15 11:54:22'),
(48, 4, 500.00, 0.00, 11, '2021-02-17 04:52:11', '2021-02-17 04:52:11'),
(49, 17, 200.00, 0.00, 11, '2021-02-17 04:52:11', '2021-02-17 04:52:11'),
(50, 30, 300.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(51, 43, 100.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(52, 56, 150.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(53, 69, 2000.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(54, 82, 250.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(55, 95, 120.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(56, 108, 150.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(57, 202, 100.00, 0.00, 12, '2021-02-17 05:00:24', '2021-02-17 05:00:24'),
(58, 88, 250.00, 0.00, 13, '2021-02-17 07:43:40', '2021-02-17 07:43:40'),
(59, 101, 120.00, 0.00, 13, '2021-02-17 07:43:40', '2021-02-17 07:43:40'),
(60, 114, 150.00, 0.00, 13, '2021-02-17 07:43:40', '2021-02-17 07:43:40'),
(61, 208, 100.00, 0.00, 13, '2021-02-17 07:43:40', '2021-02-17 07:43:40'),
(62, 209, 100.00, 0.00, 14, '2021-02-17 07:45:20', '2021-02-17 07:45:20'),
(63, 26, 200.00, 0.00, 15, '2021-02-17 09:27:17', '2021-02-17 09:27:17'),
(64, 39, 300.00, 0.00, 15, '2021-02-17 09:27:17', '2021-02-17 09:27:17'),
(65, 3, 500.00, 0.00, 16, '2021-03-20 07:07:00', '2021-03-20 07:07:00'),
(66, 16, 200.00, 0.00, 16, '2021-03-20 07:07:00', '2021-03-20 07:07:00'),
(67, 29, 300.00, 0.00, 17, '2021-03-20 07:09:04', '2021-03-20 07:09:04'),
(68, 42, 100.00, 0.00, 17, '2021-03-20 07:09:04', '2021-03-20 07:09:04'),
(69, 55, 150.00, 0.00, 18, '2021-03-20 07:12:23', '2021-03-20 07:12:23'),
(70, 55, 150.00, 0.00, 19, '2021-03-20 07:12:46', '2021-03-20 07:12:46'),
(71, 29, 300.00, 0.00, 20, '2021-03-20 07:14:34', '2021-03-20 07:14:34'),
(72, 42, 100.00, 0.00, 20, '2021-03-20 07:14:34', '2021-03-20 07:14:34'),
(73, 55, 150.00, 0.00, 21, '2021-03-20 07:14:38', '2021-03-20 07:14:38'),
(74, 68, 2000.00, 0.00, 22, '2021-03-20 07:15:27', '2021-03-20 07:15:27'),
(75, 94, 120.00, 0.00, 23, '2021-03-20 07:16:31', '2021-03-20 07:16:31'),
(76, 107, 150.00, 0.00, 23, '2021-03-20 07:16:31', '2021-03-20 07:16:31'),
(77, 25, 200.00, 0.00, 24, '2021-03-20 07:29:24', '2021-03-20 07:29:24'),
(78, 38, 300.00, 0.00, 24, '2021-03-20 07:29:24', '2021-03-20 07:29:24'),
(79, 12, 500.00, 0.00, 25, '2021-03-20 07:47:30', '2021-03-20 07:47:30'),
(80, 51, 100.00, 0.00, 25, '2021-03-20 07:47:30', '2021-03-20 07:47:30'),
(81, 64, 150.00, 0.00, 25, '2021-03-20 07:47:30', '2021-03-20 07:47:30'),
(82, 2, 500.00, 0.00, 26, '2021-03-20 08:22:56', '2021-03-20 08:22:56'),
(83, 15, 200.00, 0.00, 26, '2021-03-20 08:22:56', '2021-03-20 08:22:56'),
(84, 7, 500.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(85, 20, 200.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(86, 33, 300.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(87, 46, 100.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(88, 59, 150.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(89, 72, 2000.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(90, 85, 250.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(91, 98, 120.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(92, 111, 150.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(93, 205, 100.00, 0.00, 27, '2021-03-20 10:02:56', '2021-03-20 10:02:56'),
(94, 28, 300.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(95, 41, 100.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(96, 54, 150.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(97, 67, 2000.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(98, 80, 250.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(99, 93, 120.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(100, 106, 150.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34'),
(101, 200, 100.00, 0.00, 28, '2021-03-20 12:07:34', '2021-03-20 12:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `pre_admissions`
--

CREATE TABLE `pre_admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(10) UNSIGNED NOT NULL,
  `year` year(4) DEFAULT NULL,
  `shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_admissions`
--

INSERT INTO `pre_admissions` (`id`, `school_id`, `year`, `shift`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 2021, 'hassan', 2, '2020-12-07 05:05:04', '2021-03-09 11:22:06'),
(5, 1, 2020, 'em', 1, '2020-12-07 05:12:13', '2021-03-09 11:22:06'),
(6, 1, 2020, 'day', 2, '2020-12-14 09:41:04', '2021-03-09 11:22:06'),
(7, 1, 2021, 'Morning', 2, '2020-12-31 05:16:04', '2021-03-09 11:22:06'),
(8, 1, 2020, 'day', 2, '2020-12-31 11:05:36', '2021-03-09 11:22:06'),
(9, 1, 2020, 'Morning', 2, '2020-12-31 11:05:51', '2021-03-09 11:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price_type` tinyint(4) NOT NULL COMMENT '1=Installation,2=Service',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subsMonth` tinyint(4) DEFAULT NULL COMMENT 'Subscription Month',
  `perStudent` double(8,2) DEFAULT NULL COMMENT 'Per Student Fee',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive,1=Active,2=Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `price_type`, `code`, `title`, `price`, `country`, `details`, `subsMonth`, `perStudent`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'FA1602500', 'Basic', 1000.00, 'Bangladesh', 'Per 1 Year', 12, 5.00, 4, '2021-02-11 10:01:33', '2021-04-01 09:40:29'),
(2, 2, 'FA2602500', 'Basic', 5.50, 'Bangladesh', 'Per Student Per month', 0, NULL, 1, '2021-02-11 10:02:23', '2021-02-28 12:19:19'),
(3, 1, 'FA1602501', 'Pro', 100.00, 'Bangladesh', 'Per Year for the first time', 4, 4.00, 1, '2021-02-11 10:03:45', '2021-04-01 09:40:46'),
(4, 3, 'FA1A0A79A', 'Premium', 15000.00, 'Bangladesh', 'Per Year for the first time', 4, NULL, 1, '2021-02-11 10:04:10', '2021-03-01 06:33:14'),
(5, 2, 'FA2602501', 'Basic', 2.00, 'United States', 'Per month per student', 0, NULL, 1, '2021-02-11 10:07:06', '2021-03-02 11:46:13'),
(6, 1, 'FA17D30FD', 'Basic', 200.00, 'United States', 'For the first time', 12, 1.00, 1, '2021-02-11 10:07:35', '2021-04-01 09:41:28'),
(7, 1, 'FA1602503', 'Premium', 20.00, 'United States', 'Per year for the first time', 4, 1.00, 4, '2021-02-11 10:14:48', '2021-04-01 09:41:15'),
(8, 2, 'FA260250A', 'Exam Process System', 12000.00, 'Bangladesh', '<b>Final exam process system.</b>\r\nFinal exam process system.\r\nFinal exam process system.', 0, NULL, 1, '2021-02-11 10:43:00', '2021-02-28 12:19:26'),
(9, 3, 'FA36044AD', 'Prime', 1500.00, 'Bangladesh', 'Lorem ipsum dolor sit amet, \r\nconsectetur adipiscing elit, sed do \r\neiusmod tempor incididunt ut labore \r\net dolore magna aliqua.', 5, NULL, 1, '2021-03-07 10:39:52', '2021-03-07 10:45:21'),
(10, 3, 'FA36044AE', 'Basic', 500.00, 'Bangladesh', 'Lorem ipsum dolor sit amet, \r\nconsectetur adipiscing elit, sed do \r\neiusmod tempor incididunt ut labore et dolore magna aliqua.', 2, NULL, 1, '2021-03-07 10:44:47', '2021-03-07 11:27:16'),
(11, 3, 'FA36044AF', 'Gold Pak', 2000.00, 'Bangladesh', '<b>Lorem ipsum dolor sit amet</b>\r\nconsectetur adipiscing elit, sed do \r\neiusmod tempor incididunt ut labore \r\net dolore magna aliqua.', 7, NULL, 1, '2021-03-07 10:47:21', '2021-03-08 07:45:44'),
(12, 3, 'FA3604F16', 'Special Pack', 1500.00, 'United States', 'Text is the exact, original words written by an author. \r\nText is also a specific work as written by the original author.', 12, NULL, 1, '2021-03-15 08:11:26', '2021-03-15 08:11:26'),
(13, 3, 'FA3604F1E', 'Premium Star', 200.00, 'United States', 'Text is also commonly used to refer to a text message or to send a text message.\r\nWhen you read something, you are looking at text and using your language skills to get meaning out of it.', 6, NULL, 1, '2021-03-15 08:46:10', '2021-03-15 08:46:10'),
(14, 1, 'FA1606587', 'Best Price', 7000.00, 'Bangladesh', 'gag rgsg sdgd sgs sdgsg sdtgg sgsg\r\ngsh s sdggdh\r\nshsh sgsg\r\nsrgsgs', 6, 4.00, 1, '2021-04-01 08:43:36', '2021-04-01 09:22:14'),
(15, 1, 'FA1606589', 'Best Sels', 8200.00, 'Bangladesh', 'afaa sdfsffs', 4, 4.50, 1, '2021-04-01 08:51:07', '2021-04-03 05:09:32'),
(16, 2, 'FA260658B', 'sfag', 200.00, 'Armenia', 'hfvnbmn,m.,/.', 0, NULL, 1, '2021-04-01 08:58:35', '2021-04-01 08:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section_id` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routines`
--

INSERT INTO `routines` (`id`, `file_path`, `title`, `description`, `active`, `school_id`, `user_id`, `created_at`, `updated_at`, `section_id`) VALUES
(5, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1609749058.png', 'Perferendis maiores', '', 1, 1, 12, '2021-01-04 08:30:58', '2021-01-04 08:30:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT 0 COMMENT 'parent school id ',
  `branch_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `established` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `secretKey` int(11) DEFAULT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agentcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=delete,1=active,2=deactive',
  `perStudent` double(8,2) DEFAULT NULL,
  `activeTill` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `short_name`, `parent_id`, `branch_code`, `country_id`, `state_id`, `district_id`, `city`, `established`, `about`, `mission`, `vision`, `address`, `medium`, `code`, `secretKey`, `theme`, `agentcode`, `status`, `perStudent`, `activeTill`, `created_at`, `updated_at`) VALUES
(1, 'Foqas Academy', 'Foqas Academy', 0, 'FA20', 18, NULL, NULL, NULL, '2000-06-14', 'Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid m Est aliquid molestiae est esse. Earum eaque mo Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid', 'Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid m Est aliquid molestiae est esse. Earum eaque mo', 'Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid molestiae est esse. Earum eaque modi cum hic molestias esse fugiat. Ut dolorem deleniti facilis et. yjhgjbh Est aliquid m Est aliquid molestiae est esse. Earum eaque mo', 'New York, USA', 'bangla', 20165757, 2020, 'flatly', NULL, 1, NULL, '2022-03-24 05:39:28', '2020-10-28 06:23:22', '2021-03-24 05:39:34'),
(2, 'Devin Drake', 'DD', 1, 'NHB', 16, NULL, NULL, NULL, '21-11-2020', 'Mollitia quas ipsam', NULL, NULL, 'Alias quibusdam cons', 'english', 20165758, 2021, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2021-01-11 11:30:36'),
(3, 'Branch 2', 'B2', 1, 'LIKD', 55, NULL, NULL, NULL, '24-12-2020', 'Nesciunt ea minima culpa et consequatur. Mollitia enim sed quam quia iure odit. Ad eaque et unde hic.', NULL, NULL, 'Uttara,Dhaka', 'Bangla', 20115279, 2022, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-12-23 11:41:16'),
(4, 'Jarvis Halvorson', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Prof. Kevon Ruecker Sr.', 'Autem ducimus ex est corrupti reiciendis amet. Voluptate explicabo harum impedit perspiciatis dolorum non quis eos. Sint optio voluptates dolorum consequatur illo odit sed.', NULL, NULL, NULL, 'bangla', 20324271, 2020, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(5, 'Miss Blanca Spinka', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Lizeth Cummings', 'Consequatur sit nobis sunt optio praesentium. Voluptas similique repellendus libero. Occaecati tenetur voluptatibus omnis possimus voluptatem vel nobis.', NULL, NULL, NULL, 'english', 20286062, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(6, 'Morgan Roob PhD', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Kane Sawayn', 'Magni quia ex assumenda ipsa quo tempore. Placeat deserunt ad ratione voluptatem id eos. Facere totam quidem voluptas et qui.', NULL, NULL, NULL, 'english', 20100897, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(7, 'Dariana Cassin', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Brian Windler', 'Voluptas voluptatibus non sunt error in quaerat velit. Consequatur voluptatum est excepturi et quibusdam vero quam. Ad illo quo et quis ipsum quis.', NULL, NULL, NULL, 'english', 20120602, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(8, 'Arvid Luettgen', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Nels Rosenbaum', 'Commodi autem sed perferendis est quae laborum. Illo tempora ab quasi rem alias. Officia in exercitationem eos consequatur perspiciatis.', NULL, NULL, NULL, 'bangla', 20183360, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(9, 'Marcos Hintz', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Dina Harvey I', 'Sequi perspiciatis qui animi omnis autem. Perferendis est adipisci earum atque necessitatibus. Veritatis esse ratione ut aut quisquam culpa corrupti.', NULL, NULL, NULL, 'english', 20261834, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(10, 'Bell Blanda', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Ervin Moen', 'Amet accusamus dolores autem. Quas molestias eum nesciunt est et corporis. Nesciunt eum deleniti doloribus.', NULL, NULL, NULL, 'english', 20177774, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(11, 'Bert Bayer DDS', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Otto Maggio', 'Consequatur magnam cumque atque unde aut. Qui officia ut quia voluptatem aut repellat. Deserunt et id magni enim similique.', NULL, NULL, NULL, 'english', 20305523, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(12, 'Melissa Marquardt V', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Ms. Clara Jacobson', 'Odio ut modi debitis molestiae iure est voluptatem. Quod voluptatem aut autem nobis amet quod distinctio. Iusto est tenetur quidem et voluptas quis sed inventore.', NULL, NULL, NULL, 'english', 20924417, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(13, 'Luciano Schultz', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Lon Cruickshank', 'Molestiae non atque quibusdam ab dolorem consequatur. A est et nihil reprehenderit sint consequatur. Nemo consequuntur repellat minus porro libero dolore.', NULL, NULL, NULL, 'bangla', 20173890, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(14, 'Reed Kiehn', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Mollie Will Sr.', 'Distinctio sunt placeat corporis deleniti beatae. Quam eaque est rerum nihil veritatis omnis. Sed et et beatae nulla.', NULL, NULL, NULL, 'bangla', 20178222, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:56', '2020-10-28 06:23:56'),
(15, 'Jamey Konopelski', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Casimer Larkin', 'Aut velit laudantium beatae occaecati maxime amet. Quaerat expedita voluptatem ipsam possimus aut aperiam. Suscipit sed molestiae praesentium aut et et est.', NULL, NULL, NULL, 'bangla', 20151793, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(16, 'Aditya Maggio', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Adam Emard', 'Sed beatae sit incidunt quia qui tenetur. At aut dolorum recusandae enim nesciunt veritatis exercitationem. Laborum repellendus incidunt praesentium et.', NULL, NULL, NULL, 'english', 20173182, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(17, 'Miss Liana Wisozk III', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Shaylee Gorczany', 'Ut quis minima asperiores assumenda earum nesciunt saepe. Maxime ipsa commodi tempore. Exercitationem quia labore quo.', NULL, NULL, NULL, 'bangla', 20292105, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(18, 'Prof. Devyn Parker I', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Reece Veum', 'Id dolor omnis et nihil dolores quaerat. Ratione earum earum est et dignissimos qui libero. Quam omnis quasi ut ut amet non est.', NULL, NULL, NULL, 'english', 20174057, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(19, 'Cassidy Macejkovic', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Elvera Pouros I', 'Voluptas est qui et qui sit nulla. Assumenda numquam assumenda pariatur quod qui dolores. Dolores quo saepe exercitationem nam laboriosam quo.', NULL, NULL, NULL, 'english', 20471550, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(20, 'Marlene Lubowitz II', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Sheila Senger', 'Repellendus dolores quis facere facilis. Omnis aut temporibus aut molestias. Nobis repellat eligendi ipsum ut.', NULL, NULL, NULL, 'bangla', 20186102, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(21, 'Cathryn Greenholt', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Ansel Murray', 'Vero dolorem voluptates id. Dolore iure est quia dolor placeat cum. Voluptatem pariatur eos harum ut vel eum.', NULL, NULL, NULL, 'bangla', 20575634, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(22, 'Dr. Erwin Feest', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Jaycee Goodwin', 'Sit odio id vel velit. Sit dicta illo consequatur fugit cupiditate vitae odit. Aut et et odit doloribus rerum quaerat.', NULL, NULL, NULL, 'english', 20874024, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(23, 'Kira Fisher', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Ms. Palma Little Jr.', 'Temporibus rerum autem repellat perferendis. Suscipit et veritatis nesciunt architecto vel. Fugiat fuga est sunt qui numquam voluptas libero.', NULL, NULL, NULL, 'bangla', 20235643, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(24, 'Prof. Sammie Leannon', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Thelma Nicolas', 'Voluptatibus est ducimus ut hic vel autem aut. Porro veniam consequatur voluptates ut nobis laboriosam quod. Perferendis quibusdam quo enim enim voluptatem blanditiis.', NULL, NULL, NULL, 'english', 20334691, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(25, 'Dr. Bertrand Von', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Britney Schiller', 'Molestiae odit alias aspernatur quos in mollitia quia explicabo. Ut debitis facilis aut eum dolore recusandae omnis. Et et quis officiis deserunt sunt illo.', NULL, NULL, NULL, 'english', 20539102, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(26, 'Dr. Ryleigh Hudson', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Carmine Rempel', 'Repellendus ullam ipsa et ut laboriosam. Aliquam incidunt et est qui. Perspiciatis nihil sapiente ab dolorem dolore impedit.', NULL, NULL, NULL, 'bangla', 20175411, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(27, 'Jess Mayert', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Deon Jacobs', 'Totam sit sit et. Tenetur qui dignissimos sapiente libero. Quasi magni et beatae dolor inventore.', NULL, NULL, NULL, 'english', 20175000, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(28, 'Angelita Batz', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Arno Nikolaus DDS', 'Totam vel quibusdam id aut. Dignissimos occaecati placeat modi est. Exercitationem illo officia dolores ut.', NULL, NULL, NULL, 'bangla', 20312042, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(29, 'Skye Brown', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Mr. Tommie Oberbrunner II', 'Adipisci est excepturi sed temporibus. Ex et nostrum est officia quis. Voluptatem consequuntur omnis et ipsa aut odio reprehenderit.', NULL, NULL, NULL, 'bangla', 20243015, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(30, 'Etha Weimann', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Prof. Teagan Koelpin', 'Ducimus ipsa vero alias nam ut ea saepe. Laudantium qui aut eaque perspiciatis. Dolor autem perferendis aliquam tempore officia in.', NULL, NULL, NULL, 'bangla', 20104196, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(31, 'Clovis Wunsch', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Kristopher Rodriguez DVM', 'Culpa excepturi et voluptas fuga reprehenderit natus suscipit assumenda. Officia et et dolores sequi. Quaerat ab omnis voluptatem consequuntur est ex ut.', NULL, NULL, NULL, 'english', 20130936, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(32, 'Trevion D\'Amore DDS', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Dr. Shawn Waelchi', 'Deleniti repudiandae provident odio qui. Rerum et nisi rerum velit. Praesentium maiores magnam et consequatur neque ut quos.', NULL, NULL, NULL, 'bangla', 20310644, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(33, 'Octavia Willms', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Tyson Lindgren V', 'Modi officia ut laborum qui. Eos magni atque non quod. Placeat nihil repellat aut labore nesciunt et.', NULL, NULL, NULL, 'bangla', 20168209, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(34, 'Dr. Dillon Schinner V', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Braden Beier', 'Praesentium quaerat hic recusandae nostrum vel eos rerum. Incidunt et unde quibusdam qui aut natus. Aut ea nulla id laudantium vero.', NULL, NULL, NULL, 'english', 20146468, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(35, 'Dr. Alexandrea Sanford', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Eddie Fritsch', 'Veniam reprehenderit porro sunt deserunt maiores. Provident pariatur quae nobis quo soluta. Itaque error placeat beatae at.', NULL, NULL, NULL, 'english', 20730633, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(36, 'Dr. Roselyn Bradtke III', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Lionel Paucek', 'Voluptatem explicabo voluptas harum. Quia quia quo consequatur ratione voluptas. Nulla recusandae iure aut voluptatibus qui error.', NULL, NULL, NULL, 'bangla', 20319711, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:57', '2020-10-28 06:23:57'),
(37, 'Miss Emely Becker MD', NULL, 0, NULL, 0, NULL, NULL, NULL, 'General Rosenbaum', 'Vel sunt in est aperiam quia delectus in et. Occaecati cumque cum ad ut. Maiores error ex ut vel deleniti laboriosam.', NULL, NULL, NULL, 'bangla', 20321026, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(38, 'Ms. Elnora Emard', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Amiya Howe', 'Occaecati sit hic magni eos magni rerum accusantium. Ut non delectus sit deserunt illo reprehenderit. Possimus itaque eos repellat quam consequuntur non.', NULL, NULL, NULL, 'bangla', 20137312, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(39, 'Mireya Schaefer', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Vicenta Powlowski', 'Accusamus placeat magnam maxime ab sint quod. At dolorum similique aut aut aliquid aliquam. Quis maxime aut dolore aliquam.', NULL, NULL, NULL, 'bangla', 20115213, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(40, 'Prof. Eldora Feeney III', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Herminia Gibson I', 'Rerum quaerat vel eum non assumenda dolor eligendi. Sequi aliquid delectus est numquam saepe. Qui at at qui similique.', NULL, NULL, NULL, 'bangla', 20248539, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(41, 'Alf Rohan', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Mossie Lehner', 'Minus eum harum impedit unde aperiam alias necessitatibus. Molestias nemo et aut eos. Atque repudiandae rerum maxime explicabo.', NULL, NULL, NULL, 'bangla', 20391104, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(42, 'Preston Pfannerstill V', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Annie Anderson', 'Neque occaecati ut ducimus ratione sapiente reprehenderit. Asperiores consequatur esse asperiores aut minus rerum aspernatur provident. Iste nam molestiae qui iure non officiis consectetur corrupti.', NULL, NULL, NULL, 'bangla', 20306432, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(43, 'Dr. Cale Bergstrom Jr.', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Mr. Soledad Buckridge IV', 'Dolores aperiam omnis quis. Ab fuga rerum fugiat maxime facere ullam. Quasi nam dolorem voluptatem.', NULL, NULL, NULL, 'bangla', 20685893, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(44, 'Prof. Grant Jaskolski', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Cathrine Labadie', 'Impedit sint beatae non ipsum. Repellendus tenetur et aspernatur deserunt totam enim quo velit. Rem veniam eveniet voluptatibus quisquam consectetur vero omnis.', NULL, NULL, NULL, 'bangla', 20769048, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(45, 'Ms. Tabitha Senger', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Lee Cremin', 'Explicabo hic molestias necessitatibus ea. Provident temporibus nam nostrum rem velit quia. Tempore recusandae ut dolores molestiae quia et.', NULL, NULL, NULL, 'bangla', 20190663, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(46, 'Miss Leta Pollich', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Reyna Pouros', 'Ipsa error eum quas eum dolore sed tempora. Consequatur provident impedit tempore necessitatibus qui facilis. Ab aut rerum animi nihil consequatur adipisci fugit.', NULL, NULL, NULL, 'bangla', 20580282, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(47, 'Abbie Lakin DDS', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Sadye Paucek', 'Pariatur porro quia et est rerum quasi minima. Labore magnam est architecto quae quia facere. Ipsum nobis et nulla animi dolore ut corrupti.', NULL, NULL, NULL, 'english', 20213292, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(48, 'Madie Douglas', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Theodore Spencer', 'Exercitationem neque quidem libero placeat inventore. Eligendi enim at corrupti beatae rerum enim. Quo est a voluptas ut nihil ad eaque.', NULL, NULL, NULL, 'english', 20110718, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(49, 'Verlie Gottlieb', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Verona O\'Keefe', 'Quasi quisquam impedit alias tenetur. Ut sed maxime incidunt quia maiores. Repellat inventore nihil officia dolorem quos.', NULL, NULL, NULL, 'english', 20239021, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(50, 'Shane Gerhold', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Griffin Blanda DDS', 'Fuga dolor ut similique dolor ut aut aut aspernatur. Eum dolor iusto eius et. Vel nihil reprehenderit rem dolorem quo voluptas porro.', NULL, NULL, NULL, 'english', 20258722, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(51, 'Prof. Nicholaus Quigley Sr.', NULL, 0, NULL, 0, NULL, NULL, NULL, 'Talia Dietrich', 'Quos qui sed accusantium sint nostrum quia. Temporibus asperiores assumenda architecto maxime id odit. Veniam quas voluptatum nihil iure quisquam reiciendis cupiditate.', NULL, NULL, NULL, 'bangla', 20326815, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-10-28 06:23:58', '2020-10-28 06:23:58'),
(52, 'shihab', 'S', 1, 'SDW', 30, NULL, NULL, NULL, '10-11-2020', 'Dolorum nostrud veli', NULL, NULL, 'Dhaka-1205', 'English', 20868648, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-11-21 06:40:49', '2020-12-23 11:42:21'),
(53, 'Kyra Fitzpatrick', 'KF', 1, '02A', 5, NULL, NULL, NULL, '17-12-2020', 'Voluptates soluta nu', NULL, NULL, 'Sit eos quis nobis a', 'Chinese', 20768296, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-11-21 07:05:20', '2020-12-23 11:41:49'),
(54, 'Dane Oliver', 'DO', 1, '85W', 4, NULL, NULL, NULL, '06-12-2020', 'Est cumque ut sint i', NULL, NULL, 'Obcaecati culpa qui', 'English', 20140283, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-11-21 11:24:34', '2020-12-23 11:42:05'),
(55, 'Tatyana Valentine', 'TV', 1, 'WD3', 207, NULL, NULL, NULL, '16-12-2020', 'Nemo nemo nulla aliq', NULL, NULL, 'Quia cumque est mini', 'English', 20348642, NULL, 'flatly', NULL, 1, NULL, NULL, '2020-12-13 11:34:17', '2020-12-23 11:42:32'),
(56, 'Foqas 2', 'F2', 1, '2020', 44, NULL, NULL, NULL, '13-01-2021', 'Nothing To Say. Best', NULL, NULL, '53 First Lane', 'chinese', 21268695, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-17 10:00:33', '2021-01-17 10:00:33'),
(57, 'Foqas 2', 'F2', 1, '2020', 44, NULL, NULL, NULL, '13-01-2021', 'Nothing to say. Best', NULL, NULL, '53 First Lane', 'chinese', 21202356, NULL, 'flatly', NULL, 0, NULL, NULL, '2021-01-17 10:02:56', '2021-01-17 10:05:08'),
(58, 'Tyrone Norman', 'TN', 0, NULL, 194, NULL, NULL, 'saf', '1414', 'Tyrone Norman Established in 1414', NULL, NULL, 'afasa', '', 21242715, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-27 10:21:44', '2021-01-27 10:21:44'),
(59, 'Tyrone Norman', 'TN', 0, NULL, 194, NULL, NULL, 'saf', '1414', 'Tyrone Norman Established in 1414', NULL, NULL, 'afasa', '', 21147560, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-27 10:26:43', '2021-01-27 10:26:43'),
(60, 'Whilemina Wise', 'WW', 0, NULL, 67, NULL, NULL, 'Xavier Howell', 'Obcaecati omnis eu a', 'Whilemina Wise Established in Obcaecati omnis eu a', NULL, NULL, 'Ipsam quo non repreh', '', 21143022, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 05:28:54', '2021-01-28 05:28:54'),
(61, 'Whilemina Wise', 'WW', 0, NULL, 67, NULL, NULL, 'Xavier Howell', 'Obcaecati omnis eu a', 'Whilemina Wise Established in Obcaecati omnis eu a', NULL, NULL, 'Ipsam quo non repreh', '', 21615402, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 05:33:03', '2021-01-28 05:33:03'),
(62, 'Whilemina Wise', 'WW', 0, NULL, 67, NULL, NULL, 'Xavier Howell', 'Obcaecati omnis eu a', 'Whilemina Wise Established in Obcaecati omnis eu a', NULL, NULL, 'Ipsam quo non repreh', '', 21219828, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 06:41:33', '2021-01-28 06:41:33'),
(63, 'Whilemina Wise', 'WW', 0, NULL, 67, NULL, NULL, 'Xavier Howell', 'Obcaecati omnis eu a', 'Whilemina Wise Established in Obcaecati omnis eu a', NULL, NULL, 'Ipsam quo non repreh', '', 21452022, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 07:46:29', '2021-01-28 07:46:29'),
(64, 'Karen Peters', 'KP', 0, NULL, 167, NULL, NULL, 'Dhaka', '2010', 'Karen Peters Established in 2010', NULL, NULL, 'Dhaka, Bangla', '', 21177333, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 11:05:06', '2021-01-28 11:05:06'),
(65, 'Karen Peters', 'KP', 0, NULL, 167, NULL, NULL, 'Dhaka', '2010', 'Karen Peters Established in 2010', NULL, NULL, 'Dhaka, Bangla', '', 21228601, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 11:10:15', '2021-01-28 11:10:15'),
(66, 'Kaden Gomez', 'KG', 0, NULL, 231, NULL, NULL, 'fcsfa', '1421', 'Kaden Gomez Established in 1421', NULL, NULL, 'afafa', '', 21137514, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-28 11:40:55', '2021-01-28 11:40:55'),
(67, 'Nathan Dalton', 'ND', 0, NULL, 18, NULL, 6, NULL, '12345', 'Nathan Dalton Established in 12345', NULL, NULL, 'sfsdfs', '', 21118541, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:13:19', '2021-01-31 11:13:19'),
(68, 'Nathan Dalton', 'ND', 0, NULL, 18, NULL, 6, NULL, '12345', 'Nathan Dalton Established in 12345', NULL, NULL, 'sfsdfs', '', 21116158, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:32:38', '2021-01-31 11:32:38'),
(69, 'Whilemina Moss', 'WM', 0, NULL, 18, NULL, 11, NULL, '141', 'Whilemina Moss Established in 141', NULL, NULL, '124114', '', 21752451, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:36:23', '2021-01-31 11:36:23'),
(70, 'Whilemina Moss', 'WM', 0, NULL, 18, NULL, 11, NULL, '141', 'Whilemina Moss Established in 141', NULL, NULL, '124114', '', 21141356, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:37:45', '2021-01-31 11:37:45'),
(71, 'Whilemina Moss', 'WM', 0, NULL, 18, NULL, 11, NULL, '141', 'Whilemina Moss Established in 141', NULL, NULL, '124114', '', 21104856, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:48:39', '2021-01-31 11:48:39'),
(72, 'Zeus Ortega', 'ZO', 0, NULL, 18, NULL, 17, NULL, 'dad', 'Zeus Ortega Established in dad', NULL, NULL, 'asdad', '', 21212689, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 11:55:10', '2021-01-31 11:55:10'),
(73, 'Thaddeus Brewer', 'TB', 0, NULL, 18, NULL, 13, NULL, '141', 'Thaddeus Brewer Established in 141', NULL, NULL, '1241', '', 21317796, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 12:13:23', '2021-01-31 12:13:23'),
(74, 'afa sfaff', 'AS', 0, NULL, 223, 0, NULL, NULL, '31', 'afa sfaff Established in 31', NULL, NULL, 'werwr', '', 21229529, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 12:21:40', '2021-01-31 12:21:40'),
(75, 'Hamish Mcintosh', 'HM', 0, NULL, 223, 4, NULL, NULL, 'scd', 'Hamish Mcintosh Established in scd', NULL, NULL, 'dasasd', '', 21253395, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-01-31 12:28:10', '2021-01-31 12:28:10'),
(76, 'dasdad', 'D', 0, NULL, 18, NULL, 18, NULL, '141', 'dasdad Established in 141', NULL, NULL, '14124', '', 21221387, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-14 07:06:55', '2021-02-14 07:06:55'),
(77, 'sgzdgg', 'S', 0, NULL, 18, NULL, 11, NULL, '1289', 'sgzdgg Established in 1289', NULL, NULL, 'afaf', '', 21170061, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-14 07:11:56', '2021-02-14 07:11:56'),
(78, 'Cheryl Dunlap', 'CD', 0, NULL, 18, NULL, 33, NULL, 'Praesentium sunt do', 'Cheryl Dunlap Established in Praesentium sunt do', NULL, NULL, 'Natus dolorum volupt', '', 21116588, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-17 10:46:14', '2021-02-17 10:46:14'),
(79, 'getwh gdsg', 'GG', 0, NULL, 18, NULL, 19, NULL, 'fsfs', 'getwh gdsg Established in fsfs', NULL, NULL, 'sfsfd', '', 21224739, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-18 10:51:38', '2021-02-18 10:51:38'),
(80, 'fsgs srgrs', 'FS', 0, NULL, 18, NULL, 19, NULL, 'afa', 'fsgs srgrs Established in afa', NULL, NULL, 'fafa', '', 21232717, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-18 11:24:39', '2021-02-18 11:24:39'),
(81, 'Sydney Cantu', 'SC', 0, NULL, 18, NULL, 7, NULL, '2874', 'Sydney Cantu Established in 2874', NULL, NULL, 'In quo aliquip corru', '', 21199504, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-22 06:01:15', '2021-02-22 06:01:15'),
(82, 'Callie Holcomb', 'CH', 0, NULL, 18, NULL, 36, NULL, '1254', 'Callie Holcomb Established in 1254', NULL, NULL, 'In quo aliquip corru', '', 21762345, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-22 06:10:19', '2021-02-22 06:10:19'),
(83, 'Leilani Contreras', 'LC', 0, NULL, 18, NULL, 40, NULL, 'Id similique pariatu', 'Leilani Contreras Established in Id similique pariatu', NULL, NULL, 'Placeat quos quasi', '', 21276510, NULL, 'flatly', '12123990', 1, NULL, NULL, '2021-02-22 06:20:48', '2021-02-22 06:20:48'),
(84, 'Blaze Blankenship', 'BB', 0, NULL, 18, NULL, 51, NULL, 'Vel sit iusto eius d', 'Blaze Blankenship Established in Vel sit iusto eius d', NULL, NULL, 'Porro quod occaecat', '', 21305895, NULL, 'flatly', NULL, 1, NULL, NULL, '2021-02-22 06:27:59', '2021-02-22 06:27:59'),
(85, 'Laura Lambert', 'LL', 0, NULL, 18, NULL, 39, NULL, 'Voluptate voluptatem', 'Laura Lambert Established in Voluptate voluptatem', NULL, NULL, 'Nisi consectetur et', '', 21243352, NULL, 'flatly', '12123990', 2, NULL, '2022-05-29 17:54:09', '2021-02-22 06:30:11', '2021-03-29 12:01:26'),
(86, 'Illiana Levy', 'IL', 0, NULL, 223, 1, NULL, NULL, 'In do qui qui unde m', 'Illiana Levy Established in In do qui qui unde m', NULL, NULL, 'Earum qui lorem exer', '', 21597229, NULL, 'flatly', '12123991', 1, NULL, NULL, '2021-02-22 06:34:05', '2021-02-22 06:34:05'),
(87, 'Cullen Beach', 'CB', 0, NULL, 18, NULL, 60, NULL, 'Eligendi saepe nostr', 'Cullen Beach Established in Eligendi saepe nostr', NULL, NULL, 'Quae perferendis dol', '', 21860539, NULL, 'flatly', NULL, 1, NULL, '2021-07-02 15:49:14', '2021-03-02 03:44:28', '2021-03-02 03:44:28'),
(88, 'Ian Cochran', 'IC', 0, NULL, 18, NULL, 17, NULL, 'Hic deserunt repelle', 'Ian Cochran Established in Hic deserunt repelle', NULL, NULL, 'Pariatur Voluptatem', '', 21333079, NULL, 'flatly', NULL, 1, NULL, '2021-04-02 16:03:01', '2021-03-02 03:58:14', '2021-03-02 03:58:14'),
(89, 'Portia Vincent', 'PV', 0, NULL, 18, NULL, 20, NULL, 'Dicta distinctio In', 'Portia Vincent Established in Dicta distinctio In', NULL, NULL, 'Nisi qui ad ullam ut', '', 21123869, NULL, 'flatly', NULL, 1, NULL, '2021-04-02 16:14:09', '2021-03-02 10:09:23', '2021-03-02 10:09:23'),
(90, 'Erica Atkinson', 'EA', 0, NULL, 223, 2, NULL, NULL, 'Et ab sint ratione', 'Erica Atkinson Established in Et ab sint ratione', NULL, NULL, 'Tempore laboris qua', '', 21282628, NULL, 'flatly', '', 1, NULL, '2021-04-02 11:48:02', '2021-03-02 11:48:08', '2021-03-02 11:48:08'),
(91, 'Erica Atkinson', 'EA', 0, NULL, 223, 2, NULL, NULL, 'Et ab sint ratione', 'Erica Atkinson Established in Et ab sint ratione', NULL, NULL, 'Tempore laboris qua', '', 21204596, NULL, 'flatly', '', 1, NULL, '2021-04-02 11:52:04', '2021-03-02 11:52:05', '2021-03-02 11:52:05'),
(92, 'Erica Atkinson', 'EA', 0, NULL, 223, 2, NULL, NULL, 'Et ab sint ratione', 'Erica Atkinson Established in Et ab sint ratione', NULL, NULL, 'Tempore laboris qua', '', 21207849, NULL, 'flatly', '', 1, NULL, '2021-07-02 11:56:43', '2021-03-02 11:56:43', '2021-03-02 11:56:43'),
(93, 'Clayton Abbott', 'CA', 0, NULL, 223, 59, NULL, NULL, 'Labore deserunt ipsa', 'Clayton Abbott Established in Labore deserunt ipsa', NULL, NULL, 'Doloremque praesenti', '', 21353657, NULL, 'flatly', '12123991', 1, NULL, '2022-11-02 12:09:55', '2021-03-02 12:09:57', '2021-03-25 10:12:15'),
(94, 'Sebastian Roberson dfss egrsgsrg sgsggg', 'SRDES', 0, NULL, 18, NULL, 15, NULL, '4455', 'Sebastian Roberson dfss egrsgsrg sgsggg Established in 4455', NULL, NULL, '1212399012123990', '', 21298820, NULL, 'flatly', '12123990', 1, NULL, '2024-03-10 15:31:29', '2021-03-03 05:35:07', '2021-03-25 07:29:07'),
(95, 'Gay Knight Mailinator Bdt', 'GKMB', 0, NULL, 223, 5, NULL, NULL, 'Consequatur Autem N', 'Gay Knight Mailinator Bdt Established in Consequatur Autem N', NULL, NULL, 'Deserunt consequuntu', '', 21596420, NULL, 'flatly', '12123991', 1, NULL, '2023-03-16 11:31:41', '2021-03-03 06:01:03', '2021-03-16 06:03:01'),
(96, 'Aretha Tanner', 'AT', 0, NULL, 18, NULL, 63, NULL, 'Eum pariatur Illo q', 'Aretha Tanner Established in Eum pariatur Illo q', NULL, NULL, 'Deserunt autem quo c', '', 21295188, NULL, 'flatly', '12123990', 1, NULL, '2022-01-06 11:18:30', '2021-03-06 05:13:38', '2021-03-10 10:54:54'),
(97, 'Ina Walls', 'IW', 0, NULL, 223, 14, NULL, NULL, 'gsg', 'Ina Walls Established in gsg', NULL, NULL, 'sgs', '', 21254782, NULL, 'flatly', '12123991', 1, NULL, '2022-03-23 07:49:03', '2021-03-23 07:49:10', '2021-03-23 07:49:10'),
(98, 'Sebastian Roberson Banglsa', 'SRB', 0, NULL, 18, NULL, 46, NULL, '123456', 'Sebastian Roberson Banglsa Established in 123456', NULL, NULL, 'zdbhab', '', 21888156, NULL, 'flatly', NULL, 1, NULL, '2022-03-25 17:35:27', '2021-03-25 11:29:56', '2021-03-25 11:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `school_payments`
--

CREATE TABLE `school_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trans_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_charge` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_date` timestamp NULL DEFAULT NULL,
  `trans_type` tinyint(4) DEFAULT NULL COMMENT '1=Stripe,2=SSL',
  `trans_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `stripe_fee` double(3,2) DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For SSL',
  `purpose_id` int(11) NOT NULL,
  `agentcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `rangeFrom` datetime DEFAULT NULL,
  `rangeTo` datetime DEFAULT NULL,
  `transBy` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'School',
  `shareOf` double(8,2) DEFAULT NULL,
  `percentTk` double(8,2) DEFAULT NULL,
  `pStatus` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Unpaid,1=Paid to Agent',
  `tranCheque` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Foqas to Agent Payment Number',
  `sNote` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tracking comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_payments`
--

INSERT INTO `school_payments` (`id`, `school_id`, `user_id`, `trans_number`, `stripe_charge`, `trans_id`, `trans_date`, `trans_type`, `trans_status`, `amount`, `stripe_fee`, `currency`, `card_type`, `purpose_id`, `agentcode`, `ref_number`, `created_at`, `updated_at`, `month`, `rangeFrom`, `rangeTo`, `transBy`, `shareOf`, `percentTk`, `pStatus`, `tranCheque`, `sNote`) VALUES
(1, 60, 383, '$2y$10$zfZp6lUa', 'ch_1IET3qBXLGOKjnPzslxmAcKn', 'txn_1IET3qBXLGOKjnPzMfkH5r7N', '0000-00-00 00:00:00', 1, 'Paid', 100.00, 0.00, 'usd', NULL, 1, '', '', '2021-01-28 05:28:55', '2021-01-28 05:28:55', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(2, 61, 384, 'FA1611811983', 'ch_1IET7rBXLGOKjnPzxteS2rzF', 'txn_1IET7rBXLGOKjnPzW8LVAFuF', '2021-01-28 05:33:03', 1, 'Paid', 100.00, 0.00, 'usd', NULL, 2, '', '', '2021-01-28 05:33:03', '2021-01-28 05:33:03', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(3, 62, 385, 'FA1611816093', 'ch_1IEUC7BXLGOKjnPz46y8jt8O', 'txn_1IEUC7BXLGOKjnPzDIjlRkcP', '2021-01-28 06:41:31', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, NULL, NULL, '2021-01-28 06:41:33', '2021-01-28 06:41:33', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(4, 63, 386, 'FA1611819990', 'ch_1IEVCwBXLGOKjnPzX6ubNZwd', 'txn_1IEVCxBXLGOKjnPziA0JU7e1', '2021-01-27 19:46:26', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, '12', '14', '2021-01-28 07:46:30', '2021-01-28 07:46:30', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(5, 64, 387, 'FA1611831907', 'ch_1IEYJ9BXLGOKjnPzJKvDYxjM', 'txn_1IEYJABXLGOKjnPz8yjKDeLw', '2021-01-27 23:05:03', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, '25874', '123456', '2021-01-28 11:05:07', '2021-01-28 11:05:07', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(6, 65, 388, 'FA1611832216', 'ch_1IEYOCBXLGOKjnPzu1g5SQ3s', 'txn_1IEYOCBXLGOKjnPzCZ5ANfo6', '2021-01-27 23:10:16', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, '1254', '258741', '2021-01-28 11:10:16', '2021-01-28 11:10:16', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(7, 66, 389, 'FA1611834057', 'ch_1IEYroBXLGOKjnPzDWG1SBTt', 'txn_1IEYroBXLGOKjnPzrjfM8RNx', '2021-01-27 23:40:52', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, '66', '365', '2021-01-28 11:40:57', '2021-01-28 11:40:57', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(17, 67, 390, 'FA1612091586', NULL, 'txn_21FAiN34PhZoBMz0fUlS9xMs', '2021-01-31 11:17:18', 2, 'Failed', 20.00, 0.51, 'BDT', 'BKASH-BKash', 1, 'afafa', 'afaf', '2021-01-31 11:13:05', '2021-01-31 11:13:20', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(19, 69, 392, 'FA1612092970', NULL, 'txn_21FAbr0TNqXf5tDf7W89eDP8', '2021-01-31 11:40:22', 2, 'Paid', 20.00, 0.51, 'BDT', 'BKASH-BKash', 1, 'afaf', 'fafa', '2021-01-31 11:36:10', '2021-01-31 11:36:23', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(20, 70, 393, 'FA1612093052', NULL, 'txn_21FAKmKBRFJ8dj8ScI0wD8Kj', '2021-01-31 11:41:43', 2, 'Paid', 20.00, 0.51, 'BDT', 'BKASH-BKash', 1, '757', '95', '2021-01-31 11:37:32', '2021-01-31 11:37:45', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(21, 71, 394, 'FA1612093706', NULL, 'txn_21FAH6LTpTX1waJ04Un1J7Dk', '2021-01-31 11:52:37', 2, 'Paid', 20.00, 0.51, 'BDT', 'BKASH-BKash', 1, '374', '100', '2021-01-31 11:48:26', '2021-01-31 11:48:39', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(22, 72, 395, 'FA1612094096', NULL, 'txn_21FASRObkPSHbdz4SKJf1cB7', '2021-01-31 11:59:07', 2, 'Paid', 20.00, 0.51, 'BDT', 'BKASH-BKash', 1, '688', '221', '2021-01-31 11:54:56', '2021-01-31 11:55:10', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(23, 73, 396, 'FA1612095184', NULL, 'txn_21FAImVdUSGvFydKugddxRjs', '2021-01-31 12:17:15', 2, 'Paid', 20.00, 0.51, 'bdt', 'BKASH-BKash', 1, 'asda', 'ca', '2021-01-31 12:13:04', '2021-01-31 12:13:23', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(24, 74, 397, 'FA1612095700', 'ch_1IFevtBXLGOKjnPzXPZnBriV', 'txn_1IFevtBXLGOKjnPzZnbcir24', '2021-01-31 00:21:37', 1, 'Pending', 100.00, 3.30, 'usd', NULL, 2, 'rwr', 'wrwr', '2021-01-31 12:21:40', '2021-01-31 12:21:40', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(25, 75, 398, 'FA1612096092', 'ch_1IFf24BXLGOKjnPzJZAMWaWI', 'txn_1IFf25BXLGOKjnPz5N7ossYp', '2021-01-31 00:28:00', 1, 'Paid', 100.00, 3.30, 'usd', NULL, 1, '696', '185', '2021-01-31 12:28:12', '2021-01-31 12:28:12', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(28, 77, 408, 'FA1613286698', NULL, 'txn_21FAHsaDeDrXraaVnLKiDgh3', '2021-02-14 07:16:13', 2, 'Paid', 20.00, 0.51, 'bdt', 'BKASH-BKash', 1, '23423', '2434', '2021-02-14 07:11:38', '2021-02-14 07:11:57', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(39, 78, 409, 'FA1613558736', NULL, 'txn_21FA4M2ThYGaEDNa9ujXEeIP', '2021-02-17 10:50:18', 2, 'Paid', 50.00, 1.28, 'bdt', 'BKASH-BKash', 1, '12123990', 'FA1602500', '2021-02-17 10:45:36', '2021-02-17 10:46:17', NULL, NULL, NULL, 'School', 21.45, 15.00, '0', NULL, NULL),
(43, 79, 410, 'FA1613645470', NULL, 'txn_21FAhHVhgDpqkJaQd9ntwydu', '2021-02-18 10:55:53', 2, 'Paid', 12000.00, 9.99, 'bdt', 'BKASH-BKash', 1, '', 'FA260250A', '2021-02-18 10:51:10', '2021-02-18 10:51:41', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(52, 80, 411, 'FA1613647466', NULL, 'txn_21FAFdMkpGpw7SEXLS7tk7KF', '2021-02-18 11:29:08', 2, 'Paid', 12000.00, 9.99, 'bdt', 'BKASH-BKash', 1, '', 'FA260250A', '2021-02-18 11:24:26', '2021-02-18 11:24:40', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(55, 81, 412, 'FA1613973627', NULL, 'txn_21FAQJ9qhIaFc4RqFbQI9zhc', '2021-02-22 06:05:15', 2, 'Paid', 50.00, 1.28, 'bdt', 'BKASH-BKash', 1, '12123990', '', '2021-02-22 06:00:27', '2021-02-22 06:01:16', NULL, NULL, NULL, 'School', 21.45, NULL, '0', NULL, NULL),
(56, 82, 413, 'FA1613974206', NULL, 'txn_21FAgk6aQfxc3nA5iCbuH0Rm', '2021-02-22 06:14:55', 2, 'Paid', 5.50, 0.14, 'bdt', 'BKASH-BKash', 1, '12123990', 'FA2602500', '2021-02-22 06:10:06', '2021-02-22 06:10:20', NULL, NULL, NULL, 'School', 21.45, NULL, '0', NULL, NULL),
(57, 83, 414, 'FA1613974742', NULL, 'txn_21FAIVsRZzCPzysC32ybM2kE', '2021-02-22 06:23:51', 2, 'Paid', 5.50, 0.14, 'bdt', 'BKASH-BKash', 1, '12123990', 'FA2602500', '2021-02-22 06:19:02', '2021-02-22 06:20:49', NULL, NULL, NULL, 'School', 21.45, 1.18, '0', NULL, NULL),
(59, 84, 415, 'FA1613975255', NULL, 'txn_21FAusWyalI9H0xMCD5LoqjZ', '2021-02-22 06:32:24', 2, 'Paid', 5.50, 0.14, 'bdt', 'BKASH-BKash', 1, '', 'FA2602500', '2021-02-22 06:27:35', '2021-02-22 06:27:59', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(60, 85, 416, 'FA1613975400', NULL, 'txn_21FALHQANAi043lBt8usqJw3', '2021-02-22 06:34:48', 2, 'Paid', 50.00, 1.28, 'bdt', 'BKASH-BKash', 1, '12123990', '', '2021-02-22 06:30:00', '2021-02-22 06:30:12', NULL, NULL, NULL, 'School', 21.45, 10.73, '0', NULL, NULL),
(61, 86, 417, 'FA1613975646', 'ch_1INXzTBXLGOKjnPzav0DAvCA', 'txn_1INXzTBXLGOKjnPzdE1n9G6Y', '2021-02-22 06:33:55', 1, 'Paid', 2.00, 0.37, 'usd', NULL, 1, '12123991', 'FA2602501', '2021-02-22 06:34:06', '2021-02-22 06:34:06', NULL, NULL, NULL, 'School', NULL, 10.00, '0', NULL, NULL),
(62, 0, 0, 'FA1614597391', NULL, 'txn_21FAMWdsLAUrgRLy63J6YFDO', NULL, 2, 'Pending', 10000.00, 9.99, 'bdt', NULL, 1, '', 'FA1602501', '2021-03-01 05:16:31', '2021-03-01 11:16:31', 4, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(63, 0, 0, 'FA1614599090', NULL, 'txn_21FAEkcf8mIcXf5XAfs33lLN', NULL, 2, 'Pending', 10000.00, 9.99, 'bdt', NULL, 1, '', 'FA1602501', '2021-03-01 05:44:50', '2021-03-01 11:44:50', 4, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(64, 0, 0, 'FA1614674013', NULL, 'txn_21FAA4fFBblitGvilDSk9wxf', NULL, 2, 'Pending', 50.00, 1.28, 'bdt', NULL, 1, '', '', '2021-03-02 02:33:32', '2021-03-02 02:33:33', 1, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(65, 0, 0, 'FA1614674135', NULL, 'txn_21FAXWzKPvK1uSV6cy8nXUXw', NULL, 2, 'Pending', 100.00, 2.56, 'bdt', NULL, 1, '', 'FA1602501', '2021-03-02 02:35:35', '2021-03-02 08:35:35', 4, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(66, 87, 418, 'FA1614678250', NULL, 'txn_21FAgRsNNxREzzLKLODkdvfm', '2021-03-02 09:49:14', 2, 'Paid', 100.00, 2.56, 'bdt', 'BKASH-BKash', 1, '', 'FA1602501', '2021-03-02 03:44:10', '2021-03-02 03:44:30', 4, '2021-03-02 15:49:14', '2021-07-02 15:49:14', 'School', NULL, NULL, '0', NULL, NULL),
(67, 88, 419, 'FA1614679077', NULL, 'txn_21FAn8CYryjSWu4OeNGsxFtZ', '2021-03-02 10:03:01', 2, 'Paid', 50.00, 1.28, 'bdt', 'BKASH-BKash', 1, '', '', '2021-03-02 03:57:57', '2021-03-02 03:58:14', 1, '2021-03-02 16:03:01', '2021-04-02 16:03:01', 'School', NULL, NULL, '0', NULL, NULL),
(68, 89, 420, 'FA1614679745', NULL, 'txn_21FAmznEz7TDajAqE0KmA0Q1', '2021-03-02 10:14:09', 2, 'Paid', 50.00, 1.28, 'bdt', 'BKASH-BKash', 1, '', '', '2021-03-02 10:09:05', '2021-03-02 10:09:23', 1, '2021-03-02 16:14:09', '2021-04-02 16:14:09', 'School', NULL, NULL, '0', NULL, NULL),
(69, 91, 422, 'FA1614685927', 'ch_1IQWlkBXLGOKjnPzslDXSYaZ', 'txn_1IQWllBXLGOKjnPzDooOhtx6', '2021-03-01 23:52:04', 1, 'Paid', 50.00, 1.80, 'usd', NULL, 1, '', 'FA17D30FD', '2021-03-02 11:52:07', '2021-03-02 11:52:07', NULL, '2021-03-02 05:52:04', '2021-04-02 11:52:04', 'School', NULL, NULL, '0', NULL, NULL),
(70, 92, 423, 'FA1614686204', 'ch_1IQWqFBXLGOKjnPzwr7zJobv', 'txn_1IQWqFBXLGOKjnPz44iayHDs', '2021-03-01 23:56:43', 1, 'Paid', 20.00, 0.91, 'usd', NULL, 1, '', '', '2021-03-02 11:56:44', '2021-03-02 11:56:44', 4, '2021-03-02 05:56:43', '2021-07-02 11:56:43', 'School', NULL, NULL, '0', NULL, NULL),
(71, 93, 424, 'FA1614686997', 'ch_1IQX31BXLGOKjnPzojXq6ugc', 'txn_1IQX32BXLGOKjnPz8tXsFcrI', '2021-03-02 00:09:55', 1, 'Paid', 50.00, 1.80, 'usd', NULL, 1, '12123991', 'FA17D30FD', '2021-03-02 12:09:57', '2021-03-02 12:09:57', 2, '2021-03-02 06:09:55', '2021-05-02 12:09:55', 'School', NULL, 10.00, '0', NULL, NULL),
(72, 94, 425, 'FA1614749693', NULL, 'txn_21FAnQ6OJHmOV6MUmO9YXWeO', '2021-03-03 05:39:59', 2, 'Paid', 100.00, 2.56, 'bdt', 'BKASH-BKash', 1, '12123990', 'FA1602501', '2021-03-03 05:34:53', '2021-03-03 05:35:08', 4, '2021-03-03 11:39:59', '2021-07-03 11:39:59', 'School', 21.45, NULL, '0', NULL, NULL),
(73, 95, 426, 'FA1614751264', 'ch_1IQnlWBXLGOKjnPzmQxJwocC', 'txn_1IQnlXBXLGOKjnPzDsUqxqnw', '2021-03-03 06:00:58', 1, 'Paid', 50.00, 1.80, 'usd', NULL, 1, '12123991', 'FA17D30FD', '2021-03-03 06:01:04', '2021-03-03 06:01:04', 2, '2021-03-03 12:00:58', '2021-05-03 06:00:58', 'School', NULL, 10.00, '0', NULL, NULL),
(74, 0, 0, 'FA1615007542', NULL, 'txn_21FA1rO3Wr7E5IJr62bbaV8A', NULL, 2, 'Pending', 100.00, 2.56, 'bdt', NULL, 1, '', 'FA1602501', '2021-03-06 05:12:22', '2021-03-06 05:12:22', 4, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(75, 96, 427, 'FA1615007599', NULL, 'txn_21FApdUXE5pp5JXQYxbzhqYy', '2021-03-06 05:18:30', 2, 'Paid', 100.00, 2.56, 'bdt', 'BKASH-BKash', 1, '12123990', 'FA1602501', '2021-03-06 05:13:19', '2021-03-06 05:13:39', 4, '2021-03-06 11:18:30', '2021-07-06 11:18:30', 'School', 21.45, NULL, '0', NULL, NULL),
(76, 0, 0, NULL, NULL, 'txn_21FAWPxeWo4FhhXTXeynGPwI', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-08 10:43:16', '2021-03-08 10:43:16', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(77, 0, 0, NULL, NULL, 'txn_21FADeRvjAdzu0NMyWoWcgM0', NULL, NULL, NULL, 0.00, NULL, '', NULL, 3, NULL, NULL, '2021-03-08 10:50:57', '2021-03-08 10:50:57', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(78, 0, 0, NULL, NULL, 'txn_21FAQFhfDZheISpw9b8tyJbn', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-08 10:51:22', '2021-03-08 10:51:22', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(79, 0, 0, NULL, NULL, 'txn_21FAmN6oD5rq67OrMit9qnHf', NULL, NULL, NULL, 0.00, NULL, '', NULL, 3, NULL, NULL, '2021-03-08 10:54:20', '2021-03-08 10:54:20', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(80, 0, 0, NULL, NULL, 'txn_21FAaGjK8KF7RNXk9uMIjImv', NULL, NULL, NULL, 0.00, NULL, '', NULL, 2, NULL, NULL, '2021-03-08 10:55:47', '2021-03-08 10:55:47', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(81, 0, 0, NULL, NULL, 'txn_21FANbkoUYRQc584fE0qgHhy', NULL, NULL, NULL, 0.00, NULL, '', NULL, 2, NULL, NULL, '2021-03-08 11:07:33', '2021-03-08 11:07:33', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(82, 96, 427, 'FA1615201770', NULL, 'txn_21FAhxXAJOoCwQCCFA8cUz3i', NULL, 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-08 11:09:29', '2021-03-08 11:09:30', 2, NULL, NULL, 'School', 21.45, NULL, '0', NULL, NULL),
(83, 0, 0, NULL, NULL, 'txn_21FAmOS5UFYmIY2k6rWBKSeD', NULL, NULL, NULL, 0.00, NULL, '', NULL, 2, NULL, NULL, '2021-03-08 11:11:14', '2021-03-08 11:11:14', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(84, 96, 427, 'FA1615286078', NULL, 'txn_21FAXHj05CSFUYXAAhyAQojE', NULL, 2, 'Pending', 2000.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AF', '2021-03-09 10:34:37', '2021-03-09 10:34:38', 7, NULL, NULL, 'School', 21.45, NULL, '0', NULL, NULL),
(85, 96, 427, 'FA1615292534', NULL, 'txn_21FAKFY7OV7xYL3QsABlqvwF', '2021-03-09 12:27:31', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-09 12:22:14', '2021-03-09 12:22:30', 2, '2021-03-09 18:27:31', '2021-05-09 18:27:31', 'School', 21.45, NULL, '0', NULL, NULL),
(86, 96, 427, 'FA1615292685', NULL, 'txn_21FAu2iU5igUi8er8rXvUudW', '2021-03-09 12:30:01', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-09 12:24:45', '2021-03-09 12:24:59', 2, '2021-03-09 18:30:01', '2021-05-09 18:30:01', 'School', NULL, NULL, '0', NULL, NULL),
(87, 96, 427, 'FA1615292781', NULL, 'txn_21FAHCrTkkDkQ21biPBlQfnF', '2021-03-09 12:31:37', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-09 12:26:21', '2021-03-09 12:26:35', 2, '2021-03-09 18:31:37', '2021-05-09 18:31:37', 'School', NULL, NULL, '0', NULL, NULL),
(88, 94, 425, 'FA1615358386', NULL, 'txn_21FAQu9kfrc4ivKuIBOSIddx', '2021-03-10 06:45:06', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 06:39:46', '2021-03-10 07:07:44', 2, '2021-03-10 12:45:06', '2021-05-10 12:45:06', 'School', NULL, NULL, '0', NULL, NULL),
(89, 94, 425, 'FA1615360533', NULL, 'txn_21FANvGm6DmSf9z6gJILCUdW', '2021-03-10 07:20:50', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 07:15:33', '2021-03-10 07:16:08', 2, '2021-03-10 13:20:50', '2021-05-10 13:20:50', 'School', NULL, NULL, '0', NULL, NULL),
(90, 94, 425, 'FA1615361513', NULL, 'txn_21FALzQA99DiWC4kuE3cFLLH', '2021-03-10 07:37:10', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 07:31:53', '2021-03-10 07:37:28', 2, '2021-03-10 13:37:10', '2021-05-10 13:37:10', 'School', NULL, NULL, '0', NULL, NULL),
(91, 94, 425, 'FA1615363170', NULL, 'txn_21FAxWFtEp1vmCYqRscRIJEU', '2021-03-10 08:04:47', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 07:59:30', '2021-03-10 07:59:45', 2, '2021-03-10 14:04:47', '2021-05-10 14:04:47', 'School', NULL, NULL, '0', NULL, NULL),
(92, 94, 425, 'FA1615363599', NULL, 'txn_21FAsXY6o8CmLEWrtMmDZkRr', '2021-03-10 08:11:56', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 08:06:39', '2021-03-10 08:06:53', 2, '2021-03-10 14:11:56', '2021-05-10 14:11:56', 'School', NULL, NULL, '0', NULL, NULL),
(93, 94, 425, 'FA1615368234', NULL, 'txn_21FAOoa4OengzsuqBbmUS0vj', '2021-03-10 09:29:12', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 09:23:54', '2021-03-10 09:24:10', 2, '2021-03-10 15:29:12', '2021-05-10 15:29:12', 'School', NULL, NULL, '0', NULL, NULL),
(94, 94, 425, 'FA1615368371', NULL, 'txn_21FAbrefg07bmVdr9lTpBUeF', '2021-03-10 09:31:29', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 09:26:11', '2021-03-10 09:26:27', 2, '2021-03-10 15:31:29', '2021-05-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(95, 94, 425, 'FA1615368901', NULL, 'txn_21FAncmckmxp8Igao6HAltpG', '2021-03-10 09:40:19', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 09:35:01', '2021-03-10 09:35:16', 2, '2021-05-10 15:31:29', '2021-07-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(96, 96, 427, 'FA1615372634', NULL, 'txn_21FApiPgVfIPzSTu0p77HNDo', '2021-03-10 10:42:32', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 10:37:14', '2021-03-10 10:48:09', 2, '2021-07-06 11:18:30', '2021-09-06 11:18:30', 'School', NULL, NULL, '0', NULL, NULL),
(97, 96, 427, 'FA1615373360', NULL, 'txn_21FAIz3yfXYs91DVw0XahFHM', '2021-03-10 10:54:37', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 10:49:20', '2021-03-10 10:49:35', 2, '2021-09-06 11:18:30', '2021-11-06 11:18:30', 'School', NULL, NULL, '0', NULL, NULL),
(98, 96, 427, 'FA1615373680', NULL, 'txn_21FA8OkQpF4OGLiEVTJb7hA9', '2021-03-10 10:59:57', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-10 10:54:40', '2021-03-10 10:54:54', 2, '2021-11-06 11:18:30', '2022-01-06 11:18:30', 'School', NULL, NULL, '0', NULL, NULL),
(100, 96, 427, 'FA1615375495', NULL, 'txn_21FA0tK2sMXRjhYRWzr7W1s9', NULL, 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-10 11:24:55', '2021-03-10 11:24:55', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(104, 96, 427, 'FA1615376461', NULL, 'txn_21FAaYFQC3EEd2ssNMLVXCrK', NULL, 2, 'Failed', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-10 11:41:01', '2021-03-10 11:45:21', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(105, 96, 427, 'FA1615376760', NULL, 'txn_21FAyL8bs4IAJShR0j2s4hxS', NULL, 2, 'Failed', 1500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AD', '2021-03-10 11:46:00', '2021-03-10 11:47:00', 5, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(106, 94, 425, 'FA1615803568', NULL, 'txn_21FAhYKK8K6YlNYhlCYwrj6y', '2021-03-15 10:24:56', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-15 10:19:28', '2021-03-15 10:20:14', 2, '2021-07-10 15:31:29', '2021-09-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(107, 94, 425, 'FA1615805226', NULL, 'txn_21FAfnQxN5nd2G4mW6GiK0mB', '2021-03-16 08:23:22', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-15 10:47:06', '2021-03-15 10:47:06', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(108, 94, 425, 'FA1615808021', NULL, 'txn_21FA9BScxF69IFH15z6Qce1B', '2021-03-16 08:23:40', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-15 11:33:41', '2021-03-15 11:33:41', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(109, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, '', NULL, 2, NULL, NULL, '2021-03-16 05:28:31', '2021-03-16 05:28:31', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(110, 95, 426, 'FA1615894301', 'ch_1IVb7hBXLGOKjnPzV27XpjTq', 'txn_1IVb7hBXLGOKjnPz2UrHmESY', '0000-00-00 00:00:00', 1, 'Paid', 200.00, 6.28, 'usd', NULL, 3, '12123991', 'FA3604F1E', '2021-03-16 05:31:41', '2021-03-16 05:31:41', 6, '0000-00-00 00:00:00', '2021-09-16 11:31:41', 'School', NULL, 10.00, '0', NULL, NULL),
(111, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, '', NULL, 2, NULL, NULL, '2021-03-16 05:47:02', '2021-03-16 05:47:02', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(112, 95, 426, 'FA1615895491', 'ch_1IVbQsBXLGOKjnPzTATzrxIr', 'txn_1IVbQtBXLGOKjnPzP8OtGAqU', '2021-03-16 05:51:30', 1, 'Paid', 200.00, 6.28, 'usd', NULL, 3, '12123991', 'FA3604F1E', '2021-03-16 05:51:31', '2021-03-31 10:07:54', 6, '2021-09-16 11:31:41', '2022-03-16 11:31:41', 'School', 20.00, 40.00, '1', 'AP123214', 'The ucwords() function converts the first character of each word in a string to uppercase. \r\nNote: This function is binary-safe'),
(113, 95, 426, 'FA1615895882', 'ch_1IVbX7BXLGOKjnPz8pa6rTBn', 'txn_1IVbX7BXLGOKjnPzN8ZhlwVl', '0000-00-00 00:00:00', 1, 'Paid', 200.00, 6.28, 'usd', NULL, 3, '12123991', 'FA3604F1E', '2021-03-16 05:58:02', '2021-03-16 05:58:02', 6, '2021-09-16 11:31:41', '2022-03-16 11:31:41', 'School', NULL, 10.00, '0', NULL, NULL),
(114, 95, 426, 'FA1615896181', 'ch_1IVbc0BXLGOKjnPzD4twWBVO', 'txn_1IVbc0BXLGOKjnPzKEQsFUVn', '2021-03-16 06:03:00', 1, 'Paid', 1500.00, 9.99, 'usd', NULL, 3, '12123991', 'FA3604F16', '2021-03-16 06:03:01', '2021-03-31 10:07:54', 12, '2022-03-16 11:31:41', '2023-03-16 11:31:41', 'School', 20.00, 300.00, '1', 'AP123214', 'The ucwords() function converts the first character of each word in a string to uppercase. \r\nNote: This function is binary-safe'),
(115, 94, 425, 'FA1616052309', NULL, 'txn_21FAzHTNFwUy1Py5ZQiysLfO', '2021-03-18 07:30:41', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-18 07:25:08', '2021-03-18 07:25:34', 2, '2021-09-10 15:31:29', '2021-11-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(116, 94, 425, 'FA1616052657', NULL, 'txn_21FAjBfFtH6pIPLDTL1KdD78', '2021-03-18 07:36:29', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-18 07:30:57', '2021-03-18 07:31:21', 2, '2021-11-10 15:31:29', '2022-01-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(117, 94, 425, 'FA1616056785', NULL, 'txn_21FACFsJ9o1EF4IwsCyTB99I', '2021-03-18 08:23:49', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-18 08:39:45', '2021-03-18 08:39:45', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(118, 94, 425, 'FA1616056809', NULL, 'txn_21FAd6NyD9OQKvhmcT6LVQJS', '2021-03-19 08:24:03', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-18 08:40:09', '2021-03-18 08:40:09', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(120, 94, 425, 'FA1616058628', NULL, 'txn_21FAaAnEBdDa3W18SrbKVjYy', '2021-03-18 09:15:59', 2, 'Paid', 1500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AD', '2021-03-18 09:10:27', '2021-03-18 09:10:44', 5, '2022-01-10 15:31:29', '2022-06-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(121, 94, 425, 'FA1616066020', NULL, 'txn_21FAWgcRE8ww0mqQMPfPi0RP', '2021-03-18 11:19:12', 2, 'Paid', 1500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AD', '2021-03-18 11:13:39', '2021-03-18 11:13:56', 5, '2022-06-10 15:31:29', '2022-11-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(122, 94, 425, 'FA1616066205', NULL, 'txn_21FAgMC85vez1oxw0A1peaAS', '2021-03-18 11:22:17', 2, 'Paid', 1500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AD', '2021-03-18 11:16:45', '2021-03-18 11:16:58', 5, '2022-11-10 15:31:29', '2023-04-10 15:31:29', 'School', NULL, NULL, '0', NULL, NULL),
(123, 94, 425, 'FA1616302321', NULL, 'txn_21FANBt6zjJjYYpAl6lVoM9H', NULL, 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-21 04:52:01', '2021-03-21 04:52:01', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(124, 97, 428, 'FA1616485751', 'ch_1IY4z5BXLGOKjnPzwRfgLP4j', 'txn_1IY4z6BXLGOKjnPzmgOcE3bf', '2021-03-22 19:49:03', 1, 'Paid', 200.00, 6.28, 'usd', NULL, 1, '12123991', 'FA17D30FD', '2021-03-23 07:49:11', '2021-03-31 06:55:40', 12, '2021-03-23 01:49:03', '2022-03-23 07:49:03', 'School', 20.00, 40.00, '1', 'id-144-124', 'dadad'),
(125, 1, 12, 'FA1616564374', 'ch_1IYPREBXLGOKjnPzh6tVX0wI', 'txn_1IYPRFBXLGOKjnPzEIhYRqO3', '2021-03-24 05:39:28', 1, 'Paid', 1500.00, 9.99, 'usd', NULL, 3, NULL, 'FA3604F16', '2021-03-24 05:39:34', '2021-03-24 05:39:34', 12, '4368-03-24 16:16:56', '2022-03-24 05:39:28', 'Agent', NULL, NULL, '0', NULL, NULL),
(126, 94, 425, 'FA1616565937', NULL, 'txn_21FAuM8BdQhJFTkA4zQyGIf4', NULL, 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-24 06:05:36', '2021-03-24 06:05:37', 2, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(127, 0, 0, NULL, NULL, 'txn_21FA1FmT8RBNJeX1gesxgzJJ', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-25 06:18:46', '2021-03-25 06:18:46', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(128, 0, 0, NULL, NULL, 'txn_21FAfGT1ebpmmZ9jE84jbb2m', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-25 06:21:44', '2021-03-25 06:21:44', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(131, 0, 0, NULL, NULL, 'txn_21FAbgwqZtBN2RWcanwsikZv', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-25 06:50:41', '2021-03-25 06:50:41', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(132, 0, 0, NULL, NULL, 'txn_21FAIYQQ3ZW1tBbxG7BAZZwG', NULL, NULL, NULL, 0.00, NULL, '', NULL, 1, NULL, NULL, '2021-03-25 06:51:20', '2021-03-25 06:51:20', NULL, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(133, 94, 425, 'FA1616655225', NULL, 'txn_21FAzvou6Z71IaS3N7FtG0b7', '2021-03-25 06:59:29', 2, 'Paid', 15000.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA1A0A79A', '2021-03-25 06:53:45', '2021-03-25 07:27:14', 4, '2023-04-10 15:31:29', '2023-08-10 15:31:29', 'Agent', 21.45, 3217.50, '1', NULL, NULL),
(134, 94, 425, 'FA1616655256', NULL, 'txn_21FA4bBZeBDMbCRfEv9PtT3m', '2021-03-25 07:00:00', 2, 'Paid', 2000.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AF', '2021-03-25 06:54:15', '2021-03-25 07:29:07', 7, '2023-08-10 15:31:29', '2024-03-10 15:31:29', 'School', 0.00, 0.00, '0', NULL, NULL),
(136, 83, 414, 'FA1616658371', NULL, 'txn_21FAoX7LfpYJLp3BfQZCgKeL', '2021-03-25 07:51:15', 2, 'Failed', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-25 07:46:11', '2021-03-25 07:47:17', 2, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(137, 83, 414, 'FA1616658722', NULL, 'txn_21FAESQLqMb9Si6znn5W9GFK', '2021-03-25 07:59:35', 2, 'Pending', 2000.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AF', '2021-03-25 07:52:02', '2021-03-25 07:52:02', 7, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(138, 83, 414, 'FA1616658766', NULL, 'txn_21FAfNI1faruXzOOW0bccXCE', '2021-03-25 07:59:32', 2, 'Pending', 2000.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AF', '2021-03-25 07:52:46', '2021-03-25 07:52:46', 7, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(139, 83, 414, 'FA1616658814', NULL, 'txn_21FAUqqRGdOHqZtORUytOvhW', '2021-03-25 07:59:25', 2, 'Pending', 2000.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AF', '2021-03-25 07:53:34', '2021-03-25 07:53:34', 7, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(140, 83, 414, 'FA1616658910', NULL, 'txn_21FAbOhoADjRmBVtpPZgFaIu', '2021-03-25 07:55:47', 2, 'Failed', 2000.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AF', '2021-03-25 07:55:10', '2021-03-25 07:55:47', 7, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(141, 83, 414, 'FA1616659246', NULL, 'txn_21FAQUuMut8KRvdokTf2IBp9', '2021-03-25 08:00:46', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-25 08:00:46', '2021-03-25 08:00:46', 2, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(142, 83, 414, 'FA1616660169', NULL, 'txn_21FAfBO1iNrxkIcA55rIcFg1', '2021-03-25 08:16:09', 2, 'Pending', 500.00, 9.99, 'bdt', NULL, 3, '12123990', 'FA36044AE', '2021-03-25 08:16:09', '2021-03-25 08:16:09', 2, NULL, NULL, 'Agent', 0.00, 0.00, '0', NULL, NULL),
(143, 93, 424, 'FA1616666997', 'ch_1IYq8MBXLGOKjnPzH3anOc62', 'txn_1IYq8MBXLGOKjnPzzK8uPask', '2021-03-25 10:09:46', 1, 'Paid', 200.00, 6.28, 'usd', NULL, 3, '12123991', 'FA3604F1E', '2021-03-25 10:09:56', '2021-03-25 10:09:57', 6, '2021-05-02 12:09:55', '2021-11-02 12:09:55', 'Agent', 20.00, 10.00, '1', NULL, NULL),
(144, 93, 424, 'FA1616667135', 'ch_1IYqAlBXLGOKjnPzeT3NPreA', 'txn_1IYqAlBXLGOKjnPzQ8fTcJmU', '2021-03-25 10:12:15', 1, 'Paid', 1500.00, 9.99, 'usd', NULL, 3, '12123991', 'FA3604F16', '2021-03-25 10:12:14', '2021-03-31 06:55:40', 12, '2021-11-02 12:09:55', '2022-11-02 12:09:55', 'Agent', 20.00, 300.00, '1', 'id-144-124', 'dadad'),
(145, 10000222, 0, 'FA1616671393', NULL, 'txn_21FAyapJRajE5h3lHd7fOAcB', '2021-03-25 11:39:12', 2, 'Pending', 1000.00, 9.99, 'bdt', NULL, 1, '', '', '2021-03-25 11:23:12', '2021-03-25 11:23:13', 12, NULL, NULL, 'School', NULL, NULL, '0', NULL, NULL),
(146, 98, 445, 'FA1616671780', NULL, 'txn_21FAZJzZpzrTVi8j6C5SjV8K', '2021-03-25 11:35:27', 2, 'Paid', 1000.00, 9.99, 'bdt', 'BKASH-BKash', 1, '', '', '2021-03-25 11:29:40', '2021-03-25 11:29:58', 12, '2021-03-25 17:35:27', '2022-03-25 17:35:27', 'School', NULL, NULL, '0', NULL, NULL),
(147, 85, 416, 'FA1617018497', NULL, 'txn_21FAg5B6rzytSrMu46pslAEe', '2021-03-29 11:54:09', 2, 'Paid', 500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AE', '2021-03-29 11:48:17', '2021-03-31 07:00:06', 2, '2021-03-29 17:54:09', '2021-05-29 17:54:09', 'Agent', 21.45, 107.25, '1', 'LL-120', '1245'),
(148, 85, 416, 'FA1617019154', NULL, 'txn_21FAtXgBVPmaZrFs0hBZkxCi', '2021-03-29 12:05:05', 2, 'Paid', 2000.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AF', '2021-03-29 11:59:14', '2021-03-31 07:00:06', 7, '2021-05-29 17:54:09', '2021-12-29 17:54:09', 'Agent', 21.45, 429.00, '1', 'LL-120', '1245'),
(149, 85, 416, 'FA1617019269', NULL, 'txn_21FAKNlVZ4MsJXr2cC2h6b48', '2021-03-29 12:07:01', 2, 'Paid', 1500.00, 9.99, 'bdt', 'BKASH-BKash', 3, '12123990', 'FA36044AD', '2021-03-29 12:01:09', '2021-03-29 12:01:26', 5, '2021-12-29 17:54:09', '2022-05-29 17:54:09', 'Agent', 21.45, 321.75, '1', NULL, NULL),
(150, 0, 0, 'FA1617429173', NULL, 'txn_21FAFmDJR7sDTeE10k0Xn15H', NULL, 2, 'Pending', 8200.00, 9.99, 'bdt', NULL, 1, '', 'FA1606589', '2021-04-03 05:52:52', '2021-04-03 05:52:53', 4, NULL, NULL, 'School', 0.00, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` int(11) NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_number`, `room_number`, `class_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M', 4, 9, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(2, 'E', 7, 4, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(3, 'G', 1, 1, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(4, 'K', 1, 8, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(5, 'L', 1, 11, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(6, 'G', 5, 2, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(7, 'G', 3, 4, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(8, 'E', 9, 9, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(9, 'I', 5, 7, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(10, 'B', 222, 13, 12, 1, '2020-10-28 06:23:23', '2021-01-17 09:34:18'),
(11, 'E', 1, 10, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(12, 'B', 6, 8, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(13, 'E', 6, 6, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(14, 'J', 8, 2, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(15, 'E', 7, 6, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(16, 'F', 3, 5, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(17, 'A', 9, 9, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(18, 'E', 3, 10, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(19, 'G', 6, 7, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(20, 'E', 5, 11, 0, 1, '2020-10-28 06:23:23', '2020-10-28 06:23:23'),
(21, 'Science A', 101, 10, 0, 1, '2020-11-22 07:04:51', '2020-11-22 07:04:51'),
(22, 'Science B', 102, 10, 0, 1, '2020-11-22 07:05:10', '2020-11-22 07:05:10'),
(23, 'Shihab', 120, 1, 2, 1, '2020-12-01 07:09:05', '2020-12-05 06:07:07'),
(24, 'Admission', 101, 7, 0, 1, '2020-12-02 05:44:25', '2020-12-02 05:44:25'),
(25, 'admission', 404, 10, 0, 1, '2020-12-02 06:57:34', '2020-12-02 06:57:34'),
(26, 'Admission', 234, 3, 0, 1, '2020-12-02 07:46:49', '2020-12-02 07:46:49'),
(27, 'Arun', 102, 1, 12, 1, '2020-12-15 09:51:26', '2020-12-15 09:51:26'),
(28, 'A', 101, 17, 359, 1, '2020-12-21 07:20:06', '2020-12-21 07:20:06'),
(29, 'A', 204, 18, 12, 1, '2021-01-17 09:13:29', '2021-01-17 09:13:29'),
(30, 'G', 22333, 13, 12, 1, '2021-01-17 09:34:04', '2021-01-17 09:34:04'),
(31, 'G', 588, 1, 12, 1, '2021-01-18 05:47:09', '2021-01-18 05:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starttime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endtime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `school_id`, `schoolyear`, `starttime`, `endtime`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-21', '08-01-2021', '31-12-2021', 1, '2020-12-27 09:40:40', '2021-01-17 09:54:26'),
(2, 1, '2021-22', '01-01-2022', '31-12-2022', 2, '2020-12-27 10:36:18', '2020-12-27 10:41:56'),
(3, 1, '2019-20', '01-01-2019', '31-12-2019', 2, '2020-12-27 10:37:49', '2020-12-27 10:41:34'),
(4, 1, '2018-19', '01-01-2018', '31-12-2018', 2, '2020-12-27 10:41:06', '2020-12-27 10:41:06'),
(5, 1, '2021-2022', '13-01-2021', '13-01-2022', 1, '2021-01-17 09:56:33', '2021-01-17 09:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eiin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `express` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Express,2=Standard',
  `about_pic` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UTC',
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `pinterest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `google_analytics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_disc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_map` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_verify` tinyint(4) DEFAULT 1 COMMENT '1=yes,0=no',
  `admission_form` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=published,0=unpublished',
  `admission_verify` tinyint(4) NOT NULL DEFAULT 0,
  `add_payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=without payment,1=with payment',
  `admission_amount` double(8,2) NOT NULL DEFAULT 200.00,
  `add_amount_charge` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Stripe/Sslcommerz charge with amount,0=Stripe/Sslcommerz charge without amount',
  `admission_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes,0=no',
  `admission_exam` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=yes,0=no',
  `admit_card` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=yes,0=no',
  `admi_card_template` bigint(20) DEFAULT NULL,
  `admission_result` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=yes,0=no',
  `add_result_pubtime` timestamp NULL DEFAULT NULL COMMENT 'if admissionResult is 1,then when published result time. Result will automatically published this date time',
  `admission_student` int(11) NOT NULL DEFAULT 0 COMMENT 'Total student per admission for effect admission result published',
  `site_published` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes,0=no',
  `unpublished_msg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'if sitePublished is 1, then write message why siteUnPublished',
  `invoice_copy` tinyint(4) NOT NULL DEFAULT 1,
  `invoice_template` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `school_id`, `slogan`, `eiin`, `email`, `phone`, `telephone`, `standard`, `icon`, `express`, `logo_type`, `about_pic`, `timezone`, `language`, `facebook`, `twitter`, `pinterest`, `linkedin`, `google_analytics`, `tracking_code`, `meta_tags`, `meta_disc`, `site_map`, `contact_title`, `user_verify`, `admission_form`, `admission_verify`, `add_payment_status`, `admission_amount`, `add_amount_charge`, `admission_status`, `admission_exam`, `admit_card`, `admi_card_template`, `admission_result`, `add_result_pubtime`, `admission_student`, `site_published`, `unpublished_msg`, `invoice_copy`, `invoice_template`, `created_at`, `updated_at`) VALUES
(1, 1, 'Education in continuing a proud tradition.', '123456336', 'info@foqas.org', '415555656565', '+65 6883 0655', NULL, NULL, NULL, 1, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/Express/4291615875178.png', 'Asia/Dhaka', 'en', '#', '#', '#', '#', NULL, NULL, NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m22!1m8!1m3!1d3652.0566682306526!2d90.38299671498125!3d23.74535853459189!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d23.7452766!2d90.385115!4m5!1s0x3755b8bf5487ba93%3A0xdff56ff3b68006a2!2sipsita%20computers%20pte%20ltd!3m2!1d23.7453884!2d90.38528989999999!5e0!3m2!1sen!2sbd!4v1609135731513!5m2!1sen!2sbd', NULL, 0, 1, 1, 1, 150.00, 1, 1, 0, 1, 67, 0, '2015-02-06 23:05:00', 100, 1, NULL, 1, 2, '2020-12-06 11:07:23', '2021-03-20 12:10:01'),
(2, 2, NULL, '2563', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(3, 3, NULL, '2333', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:23', '2020-12-06 11:07:23'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(16, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(20, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(21, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(23, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(24, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(25, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(26, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(27, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(28, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(29, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(30, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(31, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(32, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(33, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(34, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(35, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(36, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(37, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(38, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:24', '2020-12-06 11:07:24'),
(39, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(40, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(41, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(42, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(43, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(44, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(45, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(46, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(47, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(48, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(49, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(51, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(52, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(53, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(54, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-06 11:07:25', '2020-12-06 11:07:25'),
(55, 55, NULL, NULL, 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2020-12-13 11:34:17', '2020-12-13 11:34:17'),
(56, 56, NULL, NULL, 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-17 10:00:33', '2021-01-17 10:00:33'),
(57, 57, NULL, NULL, 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-17 10:02:56', '2021-01-17 10:02:56'),
(58, 58, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-27 10:21:44', '2021-01-27 10:21:44'),
(59, 59, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-27 10:26:43', '2021-01-27 10:26:43'),
(60, 60, NULL, 'Reprehenderit in vel', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 05:28:54', '2021-01-28 05:28:54'),
(61, 61, NULL, 'Reprehenderit in vel', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 05:33:03', '2021-01-28 05:33:03'),
(62, 62, NULL, 'Reprehenderit in vel', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 06:41:33', '2021-01-28 06:41:33'),
(63, 63, NULL, 'Reprehenderit in vel', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 07:46:29', '2021-01-28 07:46:29'),
(64, 64, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 11:05:06', '2021-01-28 11:05:06'),
(65, 65, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 11:10:15', '2021-01-28 11:10:15'),
(66, 66, NULL, '1233', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-28 11:40:55', '2021-01-28 11:40:55'),
(67, 67, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:13:20', '2021-01-31 11:13:20'),
(68, 68, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:32:38', '2021-01-31 11:32:38'),
(69, 69, NULL, '131', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:36:23', '2021-01-31 11:36:23'),
(70, 70, NULL, '131', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:37:45', '2021-01-31 11:37:45'),
(71, 71, NULL, '131', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:48:39', '2021-01-31 11:48:39'),
(72, 72, NULL, '432', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 11:55:10', '2021-01-31 11:55:10'),
(73, 73, NULL, '341', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 12:13:23', '2021-01-31 12:13:23'),
(74, 74, NULL, '123456', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 12:21:40', '2021-01-31 12:21:40'),
(75, 75, NULL, '324', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-01-31 12:28:11', '2021-01-31 12:28:11'),
(76, 76, NULL, '43124', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-14 07:06:55', '2021-02-14 07:06:55'),
(77, 77, NULL, '5555', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-14 07:11:56', '2021-02-14 07:11:56'),
(78, 78, NULL, 'Aute tempor sit ut l', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-17 10:46:14', '2021-02-17 10:46:14'),
(79, 79, NULL, 'esfsf', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-18 10:51:39', '2021-02-18 10:51:39'),
(80, 80, NULL, 'faf', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-18 11:24:39', '2021-02-18 11:24:39'),
(81, 81, NULL, '12345', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:01:15', '2021-02-22 06:01:15'),
(82, 82, NULL, '258', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:10:19', '2021-02-22 06:10:19'),
(83, 83, NULL, 'Ducimus non recusan', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:20:48', '2021-02-22 06:20:48'),
(84, 84, NULL, 'Reiciendis ea ut sin', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:27:59', '2021-02-22 06:27:59'),
(85, 85, NULL, 'Aut distinctio Enim', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:30:11', '2021-02-22 06:30:11'),
(86, 86, NULL, 'Ullamco minima autem', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-02-22 06:34:05', '2021-02-22 06:34:05'),
(87, 87, NULL, 'Pariatur Recusandae', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 03:44:28', '2021-03-02 03:44:28'),
(88, 88, NULL, 'Voluptatem nisi volu', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'Asia/Dhaka', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 03:58:14', '2021-03-02 03:58:14'),
(89, 89, NULL, 'Nesciunt dolore in', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'Asia/Dhaka', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 10:09:23', '2021-03-02 10:09:23'),
(90, 90, NULL, 'Reprehenderit est a', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 11:48:08', '2021-03-02 11:48:08'),
(91, 91, NULL, 'Reprehenderit est a', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 11:52:05', '2021-03-02 11:52:05'),
(92, 92, NULL, 'Reprehenderit est a', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 11:56:44', '2021-03-02 11:56:44'),
(93, 93, NULL, 'Et ex modi aut rerum', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-02 12:09:57', '2021-03-02 12:09:57'),
(94, 94, NULL, '123', 'info@demo.com', '***********', '***********', 'http://192.168.0.109:8001/storage/FA21298820S/FA21298820H/2021/Standard/2751615363405.png', NULL, NULL, 2, NULL, 'Asia/Dhaka', 'en', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-03 05:35:07', '2021-03-18 11:29:21'),
(95, 95, NULL, 'Necessitatibus fugia', 'mdshihabuddinm@gmail.com', '***********', '***********', NULL, 'http://192.168.0.107:8001/storage/FA21596420S/FA21596420H/2021/Icon/5031614850411.png', 'http://192.168.0.107:8001/storage/FA21596420S/FA21596420H/2021/Express/6341614850625.png', 1, NULL, 'UTC', 'en', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-03 06:01:03', '2021-03-20 00:06:34'),
(96, 96, NULL, 'Qui quis illum moll', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'Asia/Dhaka', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-06 05:13:38', '2021-03-06 05:13:38'),
(97, 97, NULL, 'rsgseg', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'UTC', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-23 07:49:10', '2021-03-23 07:49:10'),
(98, 98, NULL, '123', 'info@demo.com', '***********', '***********', NULL, NULL, NULL, 1, NULL, 'Asia/Dhaka', 'Engli', '#', '#', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 200.00, 1, 1, 0, 0, NULL, 0, NULL, 0, 1, NULL, 1, 1, '2021-03-25 11:29:57', '2021-03-25 11:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortdrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `school_id`, `title`, `image`, `link`, `shortdrc`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(18, 1, 'My School', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MS/4721615093731.png', NULL, 'sdassascascascacacacacs', 1, 1, '2021-03-07 05:08:52', '2021-03-07 05:08:52'),
(19, 1, 'School Image', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MS/2471615093795.png', NULL, 'sadddeddwdwd', 2, 1, '2021-03-07 05:09:55', '2021-03-07 05:09:55'),
(20, 1, 'dbbgdfbbfdbfbdfb', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MS/9311615093817.png', NULL, 'fvdfvfdvdfvdf', 3, 1, '2021-03-07 05:10:17', '2021-03-07 05:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alabama', '1', '2018-12-21 21:17:05', '2020-12-12 06:54:47'),
(2, 1, 'Alaska', '1', '2018-12-21 21:17:36', '2020-09-02 21:54:58'),
(3, 1, 'Arizona', '1', '2018-12-21 21:18:05', '2020-09-03 15:13:30'),
(4, 1, 'Arkansas', '1', '2018-12-21 21:18:15', '2020-09-03 15:13:35'),
(5, 1, 'California', '1', '2018-12-21 21:18:21', '2020-09-03 15:13:39'),
(6, 1, 'Colorado', '1', '2018-12-21 21:18:31', '2020-09-03 15:13:44'),
(7, 1, 'Connecticut', '1', '2018-12-21 21:18:47', '2020-09-03 15:13:51'),
(8, 1, 'Delaware', '1', '2018-12-21 21:18:57', '2020-09-03 15:13:57'),
(9, 1, 'Florida', '1', '2018-12-21 21:19:03', '2020-09-03 15:14:02'),
(10, 1, 'Georgia', '1', '2018-12-21 21:19:08', '2020-09-03 15:14:09'),
(11, 1, 'Hawaii', '1', '2018-12-21 21:19:14', '2020-09-03 15:14:14'),
(12, 1, 'Idaho', '1', '2018-12-21 21:19:22', '2020-09-03 15:14:20'),
(13, 1, 'Illinois', '1', '2018-12-21 21:19:27', '2020-09-03 15:14:27'),
(14, 1, 'Indiana', '1', '2018-12-21 21:19:35', '2020-09-03 15:14:39'),
(15, 1, 'Iowa', '1', '2018-12-21 21:19:42', '2020-09-03 15:14:48'),
(16, 1, 'Kansas', '1', '2018-12-21 21:19:47', '2020-09-03 15:14:55'),
(17, 1, 'Kentucky', '1', '2018-12-21 21:19:54', '2020-09-03 15:15:00'),
(18, 1, 'Louisiana', '1', '2018-12-21 21:20:06', '2020-09-03 15:15:06'),
(19, 1, 'Maine', '1', '2018-12-21 21:20:12', '2020-09-03 15:15:10'),
(20, 1, 'Maryland', '1', '2018-12-21 21:20:18', '2020-09-03 15:15:14'),
(21, 1, 'Massachusetts', '1', '2018-12-21 21:20:29', '2020-09-03 15:15:21'),
(22, 1, 'Michigan', '1', '2018-12-21 21:20:34', '2020-09-03 15:15:28'),
(23, 1, 'Minnesota', '1', '2018-12-21 21:20:40', '2020-09-03 15:15:37'),
(24, 1, 'Mississippi', '1', '2018-12-21 21:20:47', '2020-09-03 15:15:47'),
(25, 1, 'Missouri', '1', '2018-12-21 21:20:53', '2020-09-03 15:15:57'),
(26, 1, 'Montana', '1', '2018-12-21 21:20:59', '2020-09-03 15:16:04'),
(27, 1, 'Nebraska', '1', '2018-12-21 21:21:05', '2020-09-03 15:16:11'),
(28, 1, 'Nevada', '1', '2018-12-21 21:21:12', '2020-09-03 15:16:19'),
(29, 1, 'New Hampshire', '1', '2018-12-21 21:21:33', '2020-09-03 15:16:26'),
(30, 1, 'New Jersey', '1', '2018-12-21 21:21:50', '2019-09-26 12:50:41'),
(31, 1, 'New Mexico', '1', '2018-12-21 21:21:56', '2020-09-03 15:16:44'),
(32, 1, 'New York', '1', '2018-12-21 21:22:02', '2019-07-05 15:42:46'),
(33, 1, 'North Carolina', '1', '2018-12-21 21:22:08', '2020-09-03 15:16:57'),
(34, 1, 'North Dakota', '1', '2018-12-21 21:22:13', '2020-09-03 15:17:05'),
(35, 1, 'Ohio', '1', '2018-12-21 21:22:18', '2020-09-03 15:17:11'),
(36, 1, 'Oklahoma', '1', '2018-12-21 21:22:24', '2020-09-03 15:17:18'),
(37, 1, 'Oregon', '1', '2018-12-21 21:22:30', '2020-09-03 15:17:25'),
(38, 1, 'Pennsylvania', '1', '2018-12-21 21:22:36', '2020-09-03 16:50:13'),
(39, 1, 'Rhode Island', '1', '2018-12-21 21:22:42', '2020-09-03 16:50:20'),
(40, 1, 'South Carolina', '1', '2018-12-21 21:22:47', '2020-09-03 16:50:32'),
(41, 1, 'South Dakota', '1', '2018-12-21 21:22:52', '2020-09-03 16:50:49'),
(42, 1, 'Tennessee', '1', '2018-12-21 21:22:58', '2020-09-03 16:50:55'),
(43, 1, 'Texas', '1', '2018-12-21 21:23:04', '2020-09-03 16:51:02'),
(44, 1, 'Utah', '1', '2018-12-21 21:23:09', '2020-09-03 16:51:08'),
(45, 1, 'Vermont', '1', '2018-12-21 21:23:15', '2020-09-03 16:51:15'),
(46, 1, 'Virginia', '1', '2018-12-21 21:23:21', '2020-09-03 16:51:22'),
(47, 1, 'Washington', '1', '2018-12-21 21:24:37', '2020-09-03 16:54:00'),
(48, 1, 'West Virginia', '1', '2018-12-21 21:24:43', '2020-09-03 16:51:36'),
(49, 1, 'Wisconsin', '1', '2018-12-21 21:24:48', '2020-09-03 16:51:42'),
(50, 1, 'Wyoming', '1', '2018-12-21 21:24:54', '2020-09-03 16:51:48'),
(51, 1, 'American Samoa', '1', '2018-12-21 21:24:59', '2020-09-03 16:51:55'),
(52, 1, 'District of Columbia', '1', '2018-12-21 21:25:04', '2020-09-03 16:52:02'),
(53, 1, 'Federated States of Micronesia', '1', '2018-12-21 21:25:11', '2020-09-03 16:52:11'),
(54, 1, 'Guam', '1', '2018-12-21 21:25:17', '2020-09-03 16:52:17'),
(55, 1, 'Marshall Islands', '1', '2018-12-21 21:25:23', '2020-09-03 16:52:23'),
(56, 1, 'Northern Mariana Islands', '1', '2018-12-21 21:25:27', '2020-09-03 16:52:29'),
(57, 1, 'Palau', '1', '2018-12-21 21:25:33', '2020-09-03 16:52:36'),
(58, 1, 'Puerto Rico', '1', '2018-12-21 21:25:39', '2020-09-03 16:52:42'),
(59, 1, 'Virgin Islands', '1', '2018-12-21 21:25:43', '2020-09-03 16:52:54'),
(60, 1, 'Dhaka', '1', '2019-01-08 05:29:46', '2020-12-12 07:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `student_board_exams`
--

CREATE TABLE `student_board_exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_year` int(11) NOT NULL,
  `institution_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpa` double(8,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_board_exams`
--

INSERT INTO `student_board_exams` (`id`, `student_id`, `exam_name`, `group`, `roll`, `registration`, `session`, `board`, `passing_year`, `institution_name`, `gpa`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 111, 'A Level', 'commerce', 4766421, 3484065, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 111, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(2, 126, 'SSC', 'arts', 8132629, 9512669, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 126, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(3, 156, 'SSC', 'science', 7733857, 6008322, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 156, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(4, 124, 'O Level', 'commerce', 4334201, 5338392, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 124, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(5, 135, 'A Level', 'commerce', 8658640, 8663686, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 135, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(6, 188, 'A Level', 'arts', 8669862, 8824103, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:14', '2020-10-28 06:24:14'),
(7, 164, 'A Level', 'arts', 7941823, 8344790, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 164, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(8, 118, 'O Level', 'arts', 7905627, 6982104, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 118, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(9, 105, 'JSC', 'commerce', 886127, 1701906, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 105, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(10, 166, 'O Level', 'arts', 182934, 2629234, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 166, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(11, 162, 'SSC', 'commerce', 7729604, 7956854, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 162, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(12, 87, 'SSC', 'commerce', 9561190, 200828, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 87, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(13, 221, 'O Level', 'commerce', 2482255, 4021637, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 221, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(14, 140, 'A Level', 'arts', 2756521, 1802255, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 140, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(15, 243, 'A Level', 'commerce', 7685317, 7044271, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 243, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(16, 70, 'A Level', 'arts', 8974131, 5139448, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 70, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(17, 214, 'O Level', 'commerce', 5598850, 4231254, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 214, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(18, 188, 'SSC', 'arts', 421420, 5122424, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(19, 128, 'SSC', 'science', 2578598, 9541457, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 128, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(20, 102, 'A Level', 'science', 7372825, 3054535, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 102, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(21, 227, 'A Level', 'science', 2873751, 124388, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 227, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(22, 250, 'SSC', 'science', 3872618, 7376060, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 250, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(23, 256, 'O Level', 'science', 3751417, 4267197, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 256, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(24, 137, 'A Level', 'commerce', 9786968, 687, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 137, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(25, 142, 'JSC', 'science', 3582595, 8341280, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 142, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(26, 120, 'SSC', 'commerce', 5291774, 116975, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 120, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(27, 213, 'SSC', 'arts', 9680982, 3689173, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 213, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(28, 226, 'O Level', 'commerce', 5269869, 9152786, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 226, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(29, 259, 'O Level', 'commerce', 5690798, 6663687, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 259, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(30, 176, 'A Level', 'arts', 4921633, 2119251, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 176, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(31, 85, 'JSC', 'science', 924749, 3404594, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 85, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(32, 157, 'A Level', 'arts', 7530830, 7982829, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 157, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(33, 261, 'JSC', 'arts', 5572098, 560572, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 261, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(34, 166, 'A Level', 'science', 9513752, 684226, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 166, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(35, 155, 'SSC', 'commerce', 1224839, 3013710, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 155, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(36, 200, 'O Level', 'science', 5073836, 9156485, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 200, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(37, 84, 'SSC', 'commerce', 3069557, 2531752, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 84, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(38, 250, 'O Level', 'arts', 1028306, 8062975, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 250, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(39, 188, 'A Level', 'science', 7023394, 9316306, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:15', '2020-10-28 06:24:15'),
(40, 195, 'A Level', 'commerce', 6383252, 2321720, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 195, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(41, 191, 'O Level', 'science', 2715773, 2462156, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 191, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(42, 91, 'JSC', 'commerce', 6345751, 7694898, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 91, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(43, 121, 'O Level', 'arts', 6478966, 5639044, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 121, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(44, 134, 'JSC', 'commerce', 2411594, 8425025, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 134, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(45, 77, 'JSC', 'arts', 2710570, 9611667, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 77, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(46, 182, 'SSC', 'commerce', 5076462, 3169879, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 182, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(47, 224, 'SSC', 'science', 8016620, 8642621, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 224, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(48, 156, 'A Level', 'arts', 5604127, 6554961, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 156, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(49, 98, 'O Level', 'arts', 1921068, 3510179, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 98, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(50, 76, 'O Level', 'commerce', 8048991, 7719957, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 76, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(51, 182, 'A Level', 'science', 1385290, 137421, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 182, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(52, 109, 'A Level', 'science', 4134186, 8983431, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 109, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(53, 175, 'A Level', 'arts', 1914764, 2089940, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 175, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(54, 168, 'O Level', 'commerce', 4994284, 6261684, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 168, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(55, 197, 'JSC', 'science', 6264198, 7426166, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 197, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(56, 236, 'SSC', 'commerce', 5001596, 6088219, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 236, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(57, 204, 'O Level', 'commerce', 9315376, 551491, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 204, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(58, 78, 'O Level', 'science', 9229772, 9744141, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 78, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(59, 87, 'JSC', 'commerce', 5437259, 2279290, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 87, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(60, 199, 'JSC', 'commerce', 910131, 3411602, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 199, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(61, 219, 'O Level', 'arts', 9093373, 1808996, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 219, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(62, 237, 'A Level', 'arts', 3891919, 6841083, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 237, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(63, 111, 'A Level', 'arts', 1755465, 2174829, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 111, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(64, 144, 'SSC', 'commerce', 1901482, 9556131, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 144, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(65, 128, 'SSC', 'science', 9141299, 5117531, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 128, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(66, 145, 'O Level', 'science', 4388503, 9606761, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 145, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(67, 69, 'JSC', 'arts', 5614293, 5445140, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 69, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(68, 241, 'A Level', 'commerce', 7663842, 6482082, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 241, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(69, 179, 'SSC', 'commerce', 4720469, 6106333, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 179, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(70, 210, 'A Level', 'science', 691711, 2913960, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 210, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(71, 191, 'O Level', 'arts', 9256654, 6306937, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 191, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(72, 199, 'A Level', 'commerce', 3850115, 8278351, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 199, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(73, 223, 'JSC', 'commerce', 1935581, 2290268, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 223, '2020-10-28 06:24:16', '2020-10-28 06:24:16'),
(74, 118, 'O Level', 'commerce', 7639231, 6699231, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 118, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(75, 88, 'JSC', 'commerce', 7823037, 1135729, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(76, 228, 'SSC', 'science', 8757346, 7331983, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 228, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(77, 83, 'JSC', 'commerce', 8792906, 7719583, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 83, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(78, 256, 'JSC', 'commerce', 3679013, 8216948, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 256, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(79, 224, 'JSC', 'science', 455275, 6525743, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 224, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(80, 205, 'JSC', 'arts', 4605006, 7926332, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 205, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(81, 206, 'O Level', 'commerce', 7014986, 6968145, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 206, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(82, 81, 'A Level', 'commerce', 5787771, 3692883, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 81, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(83, 257, 'JSC', 'science', 6754317, 9126901, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 257, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(84, 211, 'SSC', 'science', 7137305, 9685787, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 211, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(85, 136, 'O Level', 'arts', 7221000, 5626380, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 136, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(86, 84, 'O Level', 'science', 2267744, 1929852, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 84, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(87, 243, 'A Level', 'arts', 144746, 3424270, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 243, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(88, 117, 'SSC', 'arts', 851695, 7161675, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 117, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(89, 256, 'SSC', 'arts', 9781530, 2849233, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 256, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(90, 110, 'JSC', 'commerce', 102308, 6102009, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 110, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(91, 94, 'SSC', 'science', 7424189, 4285215, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 94, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(92, 147, 'JSC', 'science', 4436249, 6761383, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 147, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(93, 179, 'JSC', 'commerce', 9249200, 8248900, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 179, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(94, 114, 'SSC', 'commerce', 7643484, 2093068, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 114, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(95, 88, 'JSC', 'commerce', 6718714, 3477342, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(96, 102, 'O Level', 'arts', 3080330, 4997674, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 102, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(97, 97, 'O Level', 'arts', 7628463, 7092417, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 97, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(98, 80, 'JSC', 'science', 3959525, 9508693, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 80, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(99, 86, 'A Level', 'commerce', 3086465, 6034189, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 86, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(100, 188, 'O Level', 'arts', 6850486, 3225611, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(101, 248, 'JSC', 'science', 5726110, 7353144, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 248, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(102, 135, 'SSC', 'arts', 3850965, 88983, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 135, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(103, 93, 'JSC', 'science', 9944669, 4746034, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 93, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(104, 114, 'SSC', 'arts', 9081414, 5666961, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 114, '2020-10-28 06:24:17', '2020-10-28 06:24:17'),
(105, 109, 'A Level', 'commerce', 2534815, 4810925, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 109, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(106, 85, 'SSC', 'science', 8122728, 8425875, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 85, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(107, 178, 'O Level', 'science', 4670312, 7410826, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 178, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(108, 135, 'A Level', 'science', 5038187, 5462638, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 135, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(109, 260, 'JSC', 'arts', 19008, 5241304, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 260, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(110, 153, 'A Level', 'science', 8381996, 5308308, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 153, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(111, 136, 'SSC', 'commerce', 9191710, 8661126, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 136, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(112, 147, 'A Level', 'science', 7524202, 1307622, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 147, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(113, 243, 'A Level', 'science', 6210990, 7898432, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 243, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(114, 150, 'A Level', 'science', 5804895, 1807221, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 150, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(115, 160, 'O Level', 'arts', 563084, 5623680, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 160, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(116, 257, 'O Level', 'arts', 7215239, 4378399, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 257, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(117, 240, 'A Level', 'commerce', 8841936, 2474799, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 240, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(118, 171, 'SSC', 'arts', 7956718, 7805605, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 171, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(119, 68, 'A Level', 'arts', 5418442, 4155628, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 68, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(120, 194, 'O Level', 'arts', 4859730, 8306881, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 194, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(121, 241, 'O Level', 'arts', 9638321, 4892851, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 241, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(122, 231, 'A Level', 'science', 2408422, 6734526, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 231, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(123, 91, 'SSC', 'science', 8570185, 2962285, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 91, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(124, 181, 'A Level', 'arts', 8018411, 6100485, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 181, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(125, 197, 'SSC', 'science', 5691670, 9663011, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 197, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(126, 222, 'SSC', 'commerce', 6389398, 5072207, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 222, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(127, 68, 'A Level', 'commerce', 2419308, 8314534, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 68, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(128, 81, 'O Level', 'arts', 3770412, 2164006, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 81, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(129, 259, 'O Level', 'arts', 233064, 163001, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 259, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(130, 88, 'A Level', 'commerce', 9051486, 3275336, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(131, 221, 'O Level', 'arts', 8057677, 6221605, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 221, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(132, 173, 'A Level', 'science', 4995118, 546870, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 173, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(133, 242, 'JSC', 'science', 3120030, 7793135, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 242, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(134, 178, 'SSC', 'arts', 6354248, 6179945, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 178, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(135, 97, 'O Level', 'arts', 503772, 1508336, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 97, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(136, 146, 'JSC', 'science', 7954710, 666016, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 146, '2020-10-28 06:24:18', '2020-10-28 06:24:18'),
(137, 200, 'JSC', 'science', 8962123, 8213358, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 200, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(138, 144, 'SSC', 'science', 4959052, 873033, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 144, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(139, 128, 'JSC', 'commerce', 5044444, 3224535, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 128, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(140, 163, 'SSC', 'commerce', 5420582, 1309369, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 163, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(141, 210, 'SSC', 'science', 9315743, 4272013, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 210, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(142, 104, 'O Level', 'commerce', 3398575, 1575424, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 104, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(143, 253, 'SSC', 'arts', 3365049, 6189342, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 253, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(144, 128, 'JSC', 'arts', 5081732, 569105, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 128, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(145, 131, 'O Level', 'arts', 9967366, 1672885, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 131, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(146, 75, 'JSC', 'commerce', 9633751, 1618839, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 75, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(147, 65, 'O Level', 'science', 7849484, 1779617, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 65, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(148, 260, 'O Level', 'commerce', 8622189, 896346, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 260, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(149, 207, 'A Level', 'arts', 2036789, 4708459, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 207, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(150, 95, 'SSC', 'science', 1738836, 910490, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 95, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(151, 197, 'SSC', 'arts', 9406831, 5626945, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 197, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(152, 67, 'O Level', 'science', 2289843, 152645, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 67, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(153, 88, 'SSC', 'commerce', 538885, 313152, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(154, 127, 'A Level', 'commerce', 7676622, 2682629, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 127, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(155, 208, 'JSC', 'arts', 6156485, 8612539, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 208, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(156, 141, 'O Level', 'commerce', 7743454, 3269296, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 141, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(157, 88, 'SSC', 'arts', 3436571, 5104440, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(158, 125, 'O Level', 'commerce', 4108588, 3420481, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 125, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(159, 131, 'JSC', 'arts', 5019955, 4433160, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 131, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(160, 161, 'A Level', 'commerce', 4994148, 6766690, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 161, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(161, 138, 'O Level', 'science', 6574118, 2370392, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 138, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(162, 80, 'JSC', 'commerce', 3864511, 767733, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 80, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(163, 229, 'A Level', 'arts', 1106265, 1783709, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 229, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(164, 113, 'O Level', 'arts', 7989657, 851588, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 113, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(165, 188, 'A Level', 'commerce', 9847441, 7367635, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(166, 236, 'SSC', 'science', 562431, 3613574, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 236, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(167, 89, 'JSC', 'science', 6836027, 2269878, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 89, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(168, 111, 'SSC', 'arts', 6728280, 6385098, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 111, '2020-10-28 06:24:19', '2020-10-28 06:24:19'),
(169, 62, 'SSC', 'commerce', 761544, 8681210, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 62, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(170, 188, 'A Level', 'arts', 7292439, 5383553, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 188, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(171, 245, 'O Level', 'arts', 9782128, 5819122, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 245, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(172, 141, 'O Level', 'commerce', 1994065, 6298095, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 141, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(173, 196, 'O Level', 'arts', 3073200, 7260298, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 196, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(174, 104, 'O Level', 'science', 6549537, 4937015, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 104, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(175, 178, 'SSC', 'commerce', 3149471, 4687912, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 178, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(176, 88, 'O Level', 'arts', 5847804, 3878633, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 88, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(177, 242, 'A Level', 'commerce', 1154566, 5189307, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 242, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(178, 169, 'O Level', 'commerce', 209078, 580322, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 169, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(179, 235, 'A Level', 'science', 6677273, 7079800, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 235, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(180, 194, 'A Level', 'commerce', 1211042, 6372509, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 194, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(181, 254, 'A Level', 'arts', 500872, 4023925, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 254, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(182, 254, 'JSC', 'commerce', 234536, 5444601, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 254, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(183, 156, 'A Level', 'science', 8653449, 8543475, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 156, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(184, 105, 'SSC', 'science', 7538387, 1397399, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 105, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(185, 239, 'O Level', 'science', 4296850, 6169071, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 239, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(186, 82, 'A Level', 'science', 8175761, 5214467, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 82, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(187, 130, 'JSC', 'commerce', 8457862, 24408, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 130, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(188, 214, 'O Level', 'commerce', 9113704, 8909034, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 214, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(189, 194, 'O Level', 'science', 9557630, 6298997, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 194, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(190, 248, 'A Level', 'arts', 7366212, 3877541, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 248, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(191, 133, 'JSC', 'commerce', 4803608, 6245886, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 133, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(192, 109, 'A Level', 'science', 3286087, 237389, '2018-19', 'sylhet', 2011, 'efnj school', 5.00, 109, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(193, 95, 'A Level', 'science', 3377164, 9104228, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 95, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(194, 256, 'A Level', 'arts', 8105767, 1622707, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 256, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(195, 77, 'O Level', 'science', 2405802, 3338058, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 77, '2020-10-28 06:24:20', '2020-10-28 06:24:20'),
(196, 148, 'SSC', 'science', 6270747, 267695, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 148, '2020-10-28 06:24:21', '2020-10-28 06:24:21'),
(197, 70, 'A Level', 'arts', 7400962, 7334061, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 70, '2020-10-28 06:24:21', '2020-10-28 06:24:21'),
(198, 234, 'O Level', 'arts', 1290206, 7560179, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 234, '2020-10-28 06:24:21', '2020-10-28 06:24:21'),
(199, 150, 'SSC', 'science', 8687134, 7800599, '2018-19', 'rajsahi', 2011, 'efnj school', 5.00, 150, '2020-10-28 06:24:21', '2020-10-28 06:24:21'),
(200, 144, 'JSC', 'science', 1745641, 204562, '2018-19', 'dhaka', 2011, 'efnj school', 5.00, 144, '2020-10-28 06:24:21', '2020-10-28 06:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_infos`
--

CREATE TABLE `student_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `coursegroup_id` bigint(20) DEFAULT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` datetime NOT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_national_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_occupation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_annual_income` int(11) NOT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_national_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_annual_income` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_passport` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation_with_cperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_post_office` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_postcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_thana` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_division` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_post_office` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_postcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_thana` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_division` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Birth Certificate No',
  `gName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'G for Guardian/Parents',
  `gNationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gMobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gEmail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gdate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gnric_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'NRIC No./Passport No.',
  `gPhone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gAddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gOccupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singaporepr` tinyint(4) DEFAULT NULL,
  `bengaliLang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeBirth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_mark` float DEFAULT NULL,
  `main_school_name_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_bengali_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_roll` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_infos`
--

INSERT INTO `student_infos` (`id`, `student_id`, `coursegroup_id`, `session`, `version`, `group`, `birthday`, `religion`, `father_name`, `father_phone_number`, `father_national_id`, `father_occupation`, `father_designation`, `father_annual_income`, `mother_name`, `mother_phone_number`, `mother_national_id`, `mother_occupation`, `mother_designation`, `mother_annual_income`, `user_id`, `created_at`, `updated_at`, `height`, `weight`, `signature`, `father_email`, `mother_email`, `father_passport`, `contact_person`, `contact_person_mobile`, `contact_person_email`, `relation_with_cperson`, `present_address`, `present_post_office`, `present_postcode`, `present_thana`, `present_district`, `present_division`, `permanent_address`, `permanent_post_office`, `permanent_postcode`, `permanent_thana`, `permanent_district`, `permanent_division`, `dob_no`, `gName`, `gNationality`, `gMobile`, `gEmail`, `gdate`, `gnric_no`, `gPhone`, `gAddress`, `gOccupation`, `singaporepr`, `bengaliLang`, `placeBirth`, `street_address_1`, `street_address_2`, `city`, `state`, `zipCode`, `country`, `admission_mark`, `main_school_name_address`, `admission_bengali_class`, `class_roll`) VALUES
(1, 132, NULL, '1', 'spanish', '', '2025-06-11 00:00:00', '4', 'Prof. Santa Hane', '1843099', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Specialist', 'Postsecondary Education Administrators', 700000, 'Mabelle Hand', '8297910', 'SA0218IBYZVZJSEC8536V4XC', 'Medical Technician', 'Elementary School Teacher', 300000, 12, '2020-10-28 06:24:10', '2021-01-16 12:07:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 200, NULL, '1', 'bangla', '', '1937-06-16 00:00:00', 'islam', 'Dr. Sven Farrell', '7840836', 'SA0218IBYZVZJSEC8536V4XC', 'Professor', 'Gas Pumping Station Operator', 300000, 'Raymond Weber', '3508857', 'SA0218IBYZVZJSEC8536V4XC', 'Segmental Paver', 'Desktop Publisher', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 227, 1, '1', 'hindi', '', '2001-05-10 00:00:00', '2', 'Davion Goldner II', '644117', 'SA0218IBYZVZJSEC8536V4XC', 'Millwright', 'Choreographer', 700000, 'Howard Parisian Jr.', '2877889', 'SA0218IBYZVZJSEC8536V4XC', 'Nursery Manager', 'Production Inspector', 500000, 12, '2020-10-28 06:24:10', '2021-01-17 05:25:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 103, NULL, '1', 'english', '', '1987-08-13 00:00:00', 'christianism', 'Desiree Boyle', '7900640', 'SA0218IBYZVZJSEC8536V4XC', 'Engine Assembler', 'Medical Technician', 700000, 'Ms. Bridie Heidenreich', '8897740', 'SA0218IBYZVZJSEC8536V4XC', 'Private Sector Executive', 'Health Services Manager', 300000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 206, NULL, '1', 'bangla', '', '1922-01-04 00:00:00', 'buddhism', 'Hailee Johnston', '5198117', 'SA0218IBYZVZJSEC8536V4XC', 'Nursery Manager', 'Healthcare', 700000, 'Percival Kilback', '1008595', 'SA0218IBYZVZJSEC8536V4XC', 'Roofer', 'Landscape Artist', 700000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 157, NULL, '1', 'bangla', '', '1967-10-20 00:00:00', 'hinduism', 'Caleigh Wintheiser', '9463697', 'SA0218IBYZVZJSEC8536V4XC', 'Aircraft Mechanics OR Aircraft Service Technician', 'Manager of Air Crew', 700000, 'Annabel Wisoky', '1569299', 'SA0218IBYZVZJSEC8536V4XC', 'Pipelayer', 'Producers and Director', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 124, NULL, '1', 'bangla', '', '1990-11-23 00:00:00', 'other', 'Mr. Kendall Ebert Sr.', '933711', 'SA0218IBYZVZJSEC8536V4XC', 'Announcer', 'Agricultural Crop Farm Manager', 700000, 'Roel Kovacek', '9766240', 'SA0218IBYZVZJSEC8536V4XC', 'Library Worker', 'Singer', 700000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 146, NULL, '1', 'bangla', '', '2012-07-09 00:00:00', 'islam', 'Madilyn Sipes', '763914', 'SA0218IBYZVZJSEC8536V4XC', 'Product Promoter', 'Sales Representative', 700000, 'Rudy Altenwerth', '6695464', 'SA0218IBYZVZJSEC8536V4XC', 'Cooling and Freezing Equipment Operator', 'Mail Clerk', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 159, NULL, '1', 'english', '', '2015-09-07 00:00:00', 'christianism', 'Ted Purdy', '1717617', 'SA0218IBYZVZJSEC8536V4XC', 'Credit Analyst', 'Human Resources Specialist', 1000000, 'Joel Kilback', '4084831', 'SA0218IBYZVZJSEC8536V4XC', 'Mechanical Equipment Sales Representative', 'Ship Carpenter and Joiner', 300000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 162, NULL, '1', 'english', '', '1972-05-07 00:00:00', 'hinduism', 'Jacky Kris Jr.', '5880218', 'SA0218IBYZVZJSEC8536V4XC', 'Ship Mates', 'Medical Appliance Technician', 500000, 'Petra Bruen', '6052410', 'SA0218IBYZVZJSEC8536V4XC', 'Architect', 'Architectural Drafter OR Civil Drafter', 1000000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 179, NULL, '1', 'bangla', '', '1974-05-17 00:00:00', 'islam', 'Rhea O\'Hara', '4751713', 'SA0218IBYZVZJSEC8536V4XC', 'Library Science Teacher', 'Sewing Machine Operator', 500000, 'Fletcher Bogisich', '2810139', 'SA0218IBYZVZJSEC8536V4XC', 'Structural Iron and Steel Worker', 'Video Editor', 1000000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 123, NULL, '1', 'english', '', '2017-06-09 00:00:00', 'buddhism', 'Joaquin Wilderman DVM', '8673768', 'SA0218IBYZVZJSEC8536V4XC', 'Medical Assistant', 'Insurance Underwriter', 500000, 'Bernadette Douglas', '6276227', 'SA0218IBYZVZJSEC8536V4XC', 'Artillery Crew Member', 'Nuclear Medicine Technologist', 300000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 245, NULL, '1', 'bangla', '', '1997-03-28 00:00:00', 'hinduism', 'Mavis Sipes Sr.', '886316', 'SA0218IBYZVZJSEC8536V4XC', 'Vice President Of Human Resources', 'Maintenance Equipment Operator', 1000000, 'Paul Prosacco', '4269268', 'SA0218IBYZVZJSEC8536V4XC', 'Building Inspector', 'Political Scientist', 1000000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 105, NULL, '1', 'bangla', '', '1959-08-08 00:00:00', 'islam', 'Nia Lindgren DDS', '4559040', 'SA0218IBYZVZJSEC8536V4XC', 'Woodworker', 'Oil and gas Operator', 1000000, 'Dr. Tanya Champlin II', '104244', 'SA0218IBYZVZJSEC8536V4XC', 'Sheet Metal Worker', 'Automotive Master Mechanic', 700000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 233, NULL, '1', 'english', '', '1969-07-10 00:00:00', 'other', 'Rosella Botsford', '8679966', 'SA0218IBYZVZJSEC8536V4XC', 'Geoscientists', 'Locomotive Engineer', 1000000, 'Brandyn Hauck', '5669697', 'SA0218IBYZVZJSEC8536V4XC', 'Foundry Mold and Coremaker', 'Product Management Leader', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 106, NULL, '1', 'english', '', '1927-06-10 00:00:00', 'buddhism', 'Alda Kub', '6599620', 'SA0218IBYZVZJSEC8536V4XC', 'History Teacher', 'Host and Hostess', 1000000, 'Estella Bogisich', '8930612', 'SA0218IBYZVZJSEC8536V4XC', 'Credit Authorizer', 'Animal Care Workers', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 154, NULL, '1', 'english', '', '1973-06-18 00:00:00', 'christianism', 'Hector Cassin', '7750870', 'SA0218IBYZVZJSEC8536V4XC', 'Food Servers', 'Command Control Center Officer', 500000, 'Ms. Ernestine Armstrong', '3227589', 'SA0218IBYZVZJSEC8536V4XC', 'Locker Room Attendant', 'Nuclear Engineer', 1000000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 133, NULL, '1', 'english', '', '1997-06-03 00:00:00', 'christianism', 'Garrett McKenzie', '782365', 'SA0218IBYZVZJSEC8536V4XC', 'HR Manager', 'Securities Sales Agent', 1000000, 'Mac Kreiger', '4365342', 'SA0218IBYZVZJSEC8536V4XC', 'Archivist', 'Forming Machine Operator', 700000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 81, NULL, '1', 'bangla', '', '1939-09-03 00:00:00', 'buddhism', 'Floy Metz', '9292001', 'SA0218IBYZVZJSEC8536V4XC', 'Ticket Agent', 'Government Property Inspector', 700000, 'Prof. Juliana Ward Sr.', '6732052', 'SA0218IBYZVZJSEC8536V4XC', 'Film Laboratory Technician', 'Religious Worker', 700000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 247, NULL, '1', 'english', '', '1931-11-14 00:00:00', 'buddhism', 'Ms. Crystel Wintheiser II', '3306208', 'SA0218IBYZVZJSEC8536V4XC', 'Shuttle Car Operator', 'Production Control Manager', 1000000, 'Joanie Jenkins', '7864021', 'SA0218IBYZVZJSEC8536V4XC', 'Highway Patrol Pilot', 'Electrolytic Plating Machine Operator', 500000, NULL, '2020-10-28 06:24:10', '2020-10-28 06:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 84, NULL, '1', 'english', '', '1968-05-01 00:00:00', 'buddhism', 'Andreanne Paucek', '4194743', 'SA0218IBYZVZJSEC8536V4XC', 'Housekeeper', 'Elementary and Secondary School Administrators', 300000, 'Vance Block', '5826461', 'SA0218IBYZVZJSEC8536V4XC', 'Desktop Publisher', 'Stonemason', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 200, NULL, '1', 'english', '', '1981-10-03 00:00:00', 'christianism', 'Anne Ferry', '9230432', 'SA0218IBYZVZJSEC8536V4XC', 'MARCOM Manager', 'Insulation Worker', 500000, 'Tara Fadel DDS', '7459711', 'SA0218IBYZVZJSEC8536V4XC', 'Medical Transcriptionist', 'Gas Pumping Station Operator', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 62, NULL, '1', 'english', '', '1997-04-03 00:00:00', 'buddhism', 'Augustine Mante', '7603382', 'SA0218IBYZVZJSEC8536V4XC', 'Benefits Specialist', 'Business Teacher', 500000, 'Annetta Ritchie', '8404323', 'SA0218IBYZVZJSEC8536V4XC', 'Molding Machine Operator', 'Heating and Air Conditioning Mechanic', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 127, NULL, '1', 'english', '', '1999-10-28 00:00:00', 'christianism', 'Leopoldo Gaylord', '1509367', 'SA0218IBYZVZJSEC8536V4XC', 'Plastic Molding Machine Operator', 'New Accounts Clerk', 300000, 'Prof. Maximilian Kuhn', '554900', 'SA0218IBYZVZJSEC8536V4XC', 'Security Systems Installer OR Fire Alarm Systems Installer', 'Foundry Mold and Coremaker', 700000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 70, NULL, '1', 'bangla', '', '1951-11-15 00:00:00', 'islam', 'Jaquelin Medhurst', '8534403', 'SA0218IBYZVZJSEC8536V4XC', 'Building Cleaning Worker', 'Dentist', 500000, 'Alex Hahn', '4524290', 'SA0218IBYZVZJSEC8536V4XC', 'Electrical Engineer', 'Gaming Supervisor', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 95, NULL, '1', 'english', '', '2010-07-21 00:00:00', 'other', 'Dr. Quinten Will IV', '7916090', 'SA0218IBYZVZJSEC8536V4XC', 'Shuttle Car Operator', 'Fashion Model', 500000, 'Prof. Newton Barrows IV', '1126604', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Equipment Operator', 'Cashier', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 119, NULL, '1', 'bangla', '', '1998-03-09 00:00:00', 'hinduism', 'Letitia Padberg', '4885722', 'SA0218IBYZVZJSEC8536V4XC', 'Nuclear Technician', 'Gaming Service Worker', 1000000, 'Bruce Okuneva', '5514710', 'SA0218IBYZVZJSEC8536V4XC', 'Pressing Machine Operator', 'Cardiovascular Technologist', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 126, NULL, '1', 'bangla', '', '1972-05-23 00:00:00', 'buddhism', 'Anjali Upton', '9446237', 'SA0218IBYZVZJSEC8536V4XC', 'Chemical Equipment Tender', 'Electrical and Electronics Drafter', 1000000, 'Tyree O\'Conner', '4067062', 'SA0218IBYZVZJSEC8536V4XC', 'Gauger', 'Crossing Guard', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 121, NULL, '1', 'english', '', '1991-02-16 00:00:00', 'buddhism', 'Aubrey Daniel', '2233684', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Investigator', 'Plasterer OR Stucco Mason', 700000, 'Tony Mueller Sr.', '7251604', 'SA0218IBYZVZJSEC8536V4XC', 'Real Estate Association Manager', 'Plating Operator OR Coating Machine Operator', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 215, NULL, '1', 'english', '', '1983-10-05 00:00:00', 'buddhism', 'Javier Corwin MD', '8700197', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Security Specialist', 'Municipal Fire Fighter', 500000, 'Dr. Viola Jaskolski', '2466526', 'SA0218IBYZVZJSEC8536V4XC', 'First-Line Supervisor-Manager of Landscaping, Lawn Service, and Groundskeeping Worker', 'Washing Equipment Operator', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 125, NULL, '1', 'bangla', '', '1938-01-05 00:00:00', 'hinduism', 'Johnpaul Rowe', '3490662', 'SA0218IBYZVZJSEC8536V4XC', 'Scanner Operator', 'Law Clerk', 500000, 'Bud Ebert', '9412267', 'SA0218IBYZVZJSEC8536V4XC', 'Separating Machine Operators', 'Audio-Visual Collections Specialist', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 73, NULL, '1', 'english', '', '1984-01-13 00:00:00', 'hinduism', 'Leonard Marks', '5359377', 'SA0218IBYZVZJSEC8536V4XC', 'Chemist', 'Occupational Health Safety Specialist', 700000, 'Furman Roberts', '3891188', 'SA0218IBYZVZJSEC8536V4XC', 'Materials Engineer', 'Product Specialist', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 105, NULL, '1', 'english', '', '1965-03-14 00:00:00', 'christianism', 'Horace Lueilwitz', '3992616', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Inspector', 'Tool Sharpener', 300000, 'Blanca Wolf', '142672', 'SA0218IBYZVZJSEC8536V4XC', 'Radio Operator', 'Marine Cargo Inspector', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 214, NULL, '1', 'english', '', '1923-08-27 00:00:00', 'christianism', 'Herbert Hartmann DVM', '9352593', 'SA0218IBYZVZJSEC8536V4XC', 'Transportation Attendant', 'Industrial Machinery Mechanic', 300000, 'Mr. Braulio Armstrong', '1896589', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Science Technician', 'Clerk', 700000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 186, NULL, '1', 'bangla', '', '1980-09-06 00:00:00', 'islam', 'Prof. Tito Runte DVM', '4185998', 'SA0218IBYZVZJSEC8536V4XC', 'Aviation Inspector', 'Home Entertainment Equipment Installer', 500000, 'Prof. Nickolas Walter', '2557122', 'SA0218IBYZVZJSEC8536V4XC', 'Etcher and Engraver', 'Proofreaders and Copy Marker', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 188, NULL, '1', 'bangla', '', '1985-02-01 00:00:00', 'buddhism', 'Prof. Dayana Reichel', '5995988', 'SA0218IBYZVZJSEC8536V4XC', 'Interviewer', 'Social Science Research Assistant', 700000, 'Orval O\'Keefe', '1854170', 'SA0218IBYZVZJSEC8536V4XC', 'Logistician', 'Career Counselor', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 154, NULL, '1', 'english', '', '1990-03-10 00:00:00', 'buddhism', 'Brayan Kautzer', '3761526', 'SA0218IBYZVZJSEC8536V4XC', 'Sheet Metal Worker', 'Weapons Specialists', 500000, 'Prof. Stacey Auer DVM', '9999012', 'SA0218IBYZVZJSEC8536V4XC', 'Nursery Worker', 'Portable Power Tool Repairer', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 165, NULL, '1', 'bangla', '', '2002-07-01 00:00:00', 'buddhism', 'Mr. Jerry Weber Sr.', '962069', 'SA0218IBYZVZJSEC8536V4XC', 'Electrician', 'Maid', 1000000, 'Ms. Brandy Hintz DDS', '3083936', 'SA0218IBYZVZJSEC8536V4XC', 'Rigger', 'Software Engineer', 700000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 75, NULL, '1', 'bangla', '', '2010-03-21 00:00:00', 'islam', 'Manuela Thompson', '8158599', 'SA0218IBYZVZJSEC8536V4XC', 'Talent Director', 'Data Processing Equipment Repairer', 700000, 'Lisandro Wisozk PhD', '4356595', 'SA0218IBYZVZJSEC8536V4XC', 'Telemarketer', 'Stonemason', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 197, NULL, '1', 'english', '', '1981-11-25 00:00:00', 'buddhism', 'Mr. Braxton Koss MD', '9921397', 'SA0218IBYZVZJSEC8536V4XC', 'Millwright', 'Benefits Specialist', 500000, 'Branson Tromp IV', '767020', 'SA0218IBYZVZJSEC8536V4XC', 'Middle School Teacher', 'Hoist and Winch Operator', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 63, NULL, '1', 'bangla', '', '2018-12-24 00:00:00', 'other', 'Jaqueline Williamson', '6955035', 'SA0218IBYZVZJSEC8536V4XC', 'Product Specialist', 'Trainer', 700000, 'Jazmyn Bogisich', '6611550', 'SA0218IBYZVZJSEC8536V4XC', 'Scientific Photographer', 'Boiler Operator', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 141, NULL, '1', 'english', '', '1998-03-29 00:00:00', 'islam', 'Ardella Okuneva', '8251030', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Sales Representative', 'Marine Cargo Inspector', 700000, 'River Graham', '1604836', 'SA0218IBYZVZJSEC8536V4XC', 'Ship Carpenter and Joiner', 'Personal Trainer', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 149, NULL, '1', 'bangla', '', '1945-05-05 00:00:00', 'christianism', 'Victoria Murray', '6058879', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Worker', 'Transportation Equipment Maintenance', 700000, 'Billie Koss', '6744997', 'SA0218IBYZVZJSEC8536V4XC', 'Interaction Designer', 'Baker', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 146, NULL, '1', 'bangla', '', '1931-05-11 00:00:00', 'christianism', 'Miss Kelsie Nicolas', '3898784', 'SA0218IBYZVZJSEC8536V4XC', 'Bailiff', 'Fabric Pressers', 300000, 'Reinhold Sanford', '2466392', 'SA0218IBYZVZJSEC8536V4XC', 'Radio and Television Announcer', 'Pest Control Worker', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 116, NULL, '1', 'english', '', '1970-07-21 00:00:00', 'hinduism', 'Aurore Spinka', '4265841', 'SA0218IBYZVZJSEC8536V4XC', 'State', 'Answering Service', 700000, 'Herta Denesik IV', '7643483', 'SA0218IBYZVZJSEC8536V4XC', 'Detective', 'Child Care', 1000000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 201, NULL, '1', 'english', '', '1938-05-26 00:00:00', 'islam', 'Unique Medhurst', '9916033', 'SA0218IBYZVZJSEC8536V4XC', 'MARCOM Director', 'Information Systems Manager', 300000, 'Toni Ortiz II', '8742503', 'SA0218IBYZVZJSEC8536V4XC', 'Health Specialties Teacher', 'Electronic Drafter', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 118, NULL, '1', 'english', '', '1929-02-12 00:00:00', 'other', 'Jana Koch', '2594867', 'SA0218IBYZVZJSEC8536V4XC', 'Personal Home Care Aide', 'Ship Pilot', 300000, 'Cordia Schneider', '992836', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Inspector', 'Stone Sawyer', 300000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 261, NULL, '1', 'english', '', '1976-02-27 00:00:00', 'hinduism', 'Gust Rolfson', '1265925', 'SA0218IBYZVZJSEC8536V4XC', 'Motor Vehicle Operator', 'Carpet Installer', 500000, 'Arlie Schmitt', '760576', 'SA0218IBYZVZJSEC8536V4XC', 'Precision Pattern and Die Caster', 'Medical Equipment Repairer', 500000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 219, NULL, '1', '', 'Sc', '1931-03-11 00:00:00', '', 'Mrs. Alice Williamson DVM', '7794373', 'SA0218IBYZVZJSEC8536V4XC', 'Transformer Repairer', 'Economist', 500000, 'Ally Stanton', '5194940', 'SA0218IBYZVZJSEC8536V4XC', 'Glass Cutting Machine Operator', 'Textile Knitting Machine Operator', 1000000, 12, '2020-10-28 06:24:11', '2020-12-30 12:29:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 201, NULL, '1', 'english', '', '1972-10-18 00:00:00', 'christianism', 'Janis Gorczany Sr.', '4662602', 'SA0218IBYZVZJSEC8536V4XC', 'Industrial Production Manager', 'Audio-Visual Collections Specialist', 300000, 'Chaim VonRueden', '2798309', 'SA0218IBYZVZJSEC8536V4XC', 'Screen Printing Machine Operator', 'Welder', 700000, NULL, '2020-10-28 06:24:11', '2020-10-28 06:24:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 154, NULL, '1', 'bangla', 'science', '1960-01-30 00:00:00', 'buddhism', 'Ignacio Schamberger', '9659283', 'SA0218IBYZVZJSEC8536V4XC', 'Library Worker', 'Board Of Directors', 500000, 'Prof. Ana Goldner', '8126420', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Science Technician', 'History Teacher', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 84, NULL, '1', 'english', 'science', '1965-12-02 00:00:00', 'christianism', 'Donnie Jakubowski', '4267633', 'SA0218IBYZVZJSEC8536V4XC', 'Vice President Of Human Resources', 'Safety Engineer', 300000, 'Amari Dooley Sr.', '7538528', 'SA0218IBYZVZJSEC8536V4XC', 'Industrial Equipment Maintenance', 'Musical Instrument Tuner', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 114, NULL, '1', 'english', 'science', '1992-10-30 00:00:00', 'hinduism', 'Amira Hammes', '9076213', 'SA0218IBYZVZJSEC8536V4XC', 'Fashion Model', 'Fashion Model', 1000000, 'Lisa Klein DDS', '4663403', 'SA0218IBYZVZJSEC8536V4XC', 'Record Clerk', 'Aircraft Structure Assemblers', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 202, NULL, '1', 'bangla', 'science', '1934-09-20 00:00:00', 'islam', 'Kendall Kuhlman', '3979784', 'SA0218IBYZVZJSEC8536V4XC', 'Insurance Sales Agent', 'Motor Vehicle Inspector', 300000, 'Korbin Lockman', '6751697', 'SA0218IBYZVZJSEC8536V4XC', 'Ship Pilot', 'Entertainer and Performer', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 150, NULL, '1', 'bangla', 'science', '1922-08-02 00:00:00', 'hinduism', 'Dr. Jean Zemlak IV', '2825013', 'SA0218IBYZVZJSEC8536V4XC', 'Opticians', 'Log Grader and Scaler', 1000000, 'Elenora Hirthe', '7867865', 'SA0218IBYZVZJSEC8536V4XC', 'HVAC Mechanic', 'Teacher', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 193, NULL, '1', 'bangla', 'science', '1942-03-31 00:00:00', 'hinduism', 'Katheryn D\'Amore', '3455476', 'SA0218IBYZVZJSEC8536V4XC', 'CEO', 'Pipe Fitter', 300000, 'Mr. Aiden Renner MD', '2509242', 'SA0218IBYZVZJSEC8536V4XC', 'Web Developer', 'Agricultural Sales Representative', 700000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 236, NULL, '1', 'english', 'science', '2000-05-25 00:00:00', 'other', 'Halle Zulauf', '5237997', 'SA0218IBYZVZJSEC8536V4XC', 'Geological Data Technician', 'Recordkeeping Clerk', 1000000, 'Felicity Gorczany', '6027467', 'SA0218IBYZVZJSEC8536V4XC', 'Archivist', 'Orthodontist', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 151, NULL, '1', 'english', 'science', '1994-03-16 00:00:00', 'buddhism', 'Lavonne D\'Amore', '9805097', 'SA0218IBYZVZJSEC8536V4XC', 'Vending Machine Servicer', 'Maid', 700000, 'Lenora Miller', '9027972', 'SA0218IBYZVZJSEC8536V4XC', 'Psychiatrist', 'Dishwasher', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 109, NULL, '1', 'english', 'science', '2018-07-29 00:00:00', 'islam', 'Cydney Thiel DVM', '1712024', 'SA0218IBYZVZJSEC8536V4XC', 'Insurance Appraiser', 'Farm Equipment Mechanic', 700000, 'Camren Hammes', '9526095', 'SA0218IBYZVZJSEC8536V4XC', 'Animal Control Worker', 'User Experience Researcher', 700000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 120, NULL, '1', 'bangla', 'science', '1950-08-14 00:00:00', 'buddhism', 'Rodger Veum', '2546105', 'SA0218IBYZVZJSEC8536V4XC', 'Funeral Director', 'Tool Set-Up Operator', 1000000, 'Kayley Ledner', '215573', 'SA0218IBYZVZJSEC8536V4XC', 'Medical Technician', 'Crossing Guard', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 175, NULL, '1', 'english', 'science', '1993-12-14 00:00:00', 'hinduism', 'Oliver Murazik', '4134116', 'SA0218IBYZVZJSEC8536V4XC', 'Child Care Worker', 'User Experience Manager', 1000000, 'Dr. Coby Kessler PhD', '8349331', 'SA0218IBYZVZJSEC8536V4XC', 'Jeweler', 'Lathe Operator', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 203, NULL, '1', 'english', 'science', '2012-11-22 00:00:00', 'other', 'Garrick Dooley', '5674375', 'SA0218IBYZVZJSEC8536V4XC', 'Precision Printing Worker', 'Automotive Mechanic', 700000, 'Dr. Bradley Nikolaus I', '6464621', 'SA0218IBYZVZJSEC8536V4XC', 'Poultry Cutter', 'Funeral Attendant', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 191, NULL, '1', 'bangla', 'science', '1975-08-19 00:00:00', 'islam', 'Amina Nienow', '1894792', 'SA0218IBYZVZJSEC8536V4XC', 'Stevedore', 'Conservation Scientist', 1000000, 'Bettie Yost', '5070178', 'SA0218IBYZVZJSEC8536V4XC', 'Staff Psychologist', 'Securities Sales Agent', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 169, NULL, '1', 'bangla', 'science', '1985-01-29 00:00:00', 'other', 'Josianne Ruecker', '5722600', 'SA0218IBYZVZJSEC8536V4XC', 'School Bus Driver', 'Aviation Inspector', 500000, 'Winona Crona', '5682931', 'SA0218IBYZVZJSEC8536V4XC', 'Educational Psychologist', 'Fraud Investigator', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 197, NULL, '1', 'bangla', 'science', '1946-01-18 00:00:00', 'hinduism', 'Colin Mitchell', '200774', 'SA0218IBYZVZJSEC8536V4XC', 'Real Estate Sales Agent', 'Maintenance and Repair Worker', 700000, 'Braeden Mosciski III', '1197785', 'SA0218IBYZVZJSEC8536V4XC', 'School Social Worker', 'Electronic Masking System Operator', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 247, NULL, '1', 'bangla', 'science', '1985-02-25 00:00:00', 'other', 'Mrs. Amara Dach DVM', '4701991', 'SA0218IBYZVZJSEC8536V4XC', 'Logging Supervisor', 'Heat Treating Equipment Operator', 700000, 'Charlie Goodwin', '5817827', 'SA0218IBYZVZJSEC8536V4XC', 'Economist', 'Welding Machine Operator', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 259, NULL, '1', 'english', 'science', '1982-11-26 00:00:00', 'hinduism', 'Jennie Von', '763657', 'SA0218IBYZVZJSEC8536V4XC', 'Athletes and Sports Competitor', 'Cabinetmaker', 700000, 'Clint Ritchie', '9135085', 'SA0218IBYZVZJSEC8536V4XC', 'Nursing Instructor', 'Roustabouts', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 240, NULL, '1', 'bangla', 'science', '1995-04-13 00:00:00', 'christianism', 'Miss Sophia Dietrich MD', '2142078', 'SA0218IBYZVZJSEC8536V4XC', 'City', 'Emergency Medical Technician and Paramedic', 500000, 'Prof. Brown Carter', '8389908', 'SA0218IBYZVZJSEC8536V4XC', 'Airframe Mechanic', 'Machine Tool Operator', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 255, NULL, '1', 'english', 'science', '1960-06-11 00:00:00', 'other', 'Hassie Thiel Sr.', '675004', 'SA0218IBYZVZJSEC8536V4XC', 'Human Resources Specialist', 'Product Safety Engineer', 300000, 'Dr. Mollie Torphy', '8074381', 'SA0218IBYZVZJSEC8536V4XC', 'Producer', 'Counseling Psychologist', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 258, NULL, '1', 'english', 'science', '1921-05-06 00:00:00', 'islam', 'Rebeca Welch', '680054', 'SA0218IBYZVZJSEC8536V4XC', 'Space Sciences Teacher', 'Webmaster', 500000, 'Dr. Esmeralda Bruen', '1422099', 'SA0218IBYZVZJSEC8536V4XC', 'Railroad Yard Worker', 'Mining Engineer OR Geological Engineer', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 188, NULL, '1', 'bangla', 'science', '2013-05-29 00:00:00', 'christianism', 'Clotilde Swaniawski Sr.', '1004059', 'SA0218IBYZVZJSEC8536V4XC', 'Psychologist', 'Woodworker', 300000, 'Mathew Grady', '4298609', 'SA0218IBYZVZJSEC8536V4XC', 'Mechanical Engineer', 'Database Manager', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 97, NULL, '1', 'english', 'science', '1991-09-17 00:00:00', 'islam', 'Noe Gottlieb', '9498106', 'SA0218IBYZVZJSEC8536V4XC', 'Central Office Operator', 'Protective Service Worker', 300000, 'Aniya Haley', '7974437', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Investigator', 'Customer Service Representative', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 140, NULL, '1', 'bangla', 'science', '1995-10-26 00:00:00', 'christianism', 'Mr. Danial Considine III', '9690126', 'SA0218IBYZVZJSEC8536V4XC', 'Rail Yard Engineer', 'System Administrator', 500000, 'Emmy Rohan', '4000338', 'SA0218IBYZVZJSEC8536V4XC', 'Government Property Inspector', 'Psychiatrist', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 182, NULL, '1', 'bangla', 'science', '2004-12-17 00:00:00', 'islam', 'Ms. Germaine Kuhic', '8236707', 'SA0218IBYZVZJSEC8536V4XC', 'Teacher', 'Optometrist', 300000, 'Adrien Kohler', '9735943', 'SA0218IBYZVZJSEC8536V4XC', 'Agricultural Manager', 'Photographic Developer', 500000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 67, NULL, '1', 'english', 'science', '1989-01-02 00:00:00', 'other', 'Tamia Herman', '9026792', 'SA0218IBYZVZJSEC8536V4XC', 'Animal Husbandry Worker', 'Janitorial Supervisor', 1000000, 'Else Wunsch', '3391888', 'SA0218IBYZVZJSEC8536V4XC', 'Machine Feeder', 'Postsecondary Education Administrators', 700000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 76, NULL, '1', 'bangla', 'commerce', '2000-06-18 00:00:00', 'buddhism', 'Myron Schaefer', '3527939', 'SA0218IBYZVZJSEC8536V4XC', 'Sales and Related Workers', 'Machine Feeder', 300000, 'Elton Balistreri', '4373387', 'SA0218IBYZVZJSEC8536V4XC', 'Pharmacist', 'Airframe Mechanic', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 81, NULL, '1', 'bangla', 'commerce', '1951-09-17 00:00:00', 'hinduism', 'Hollie Fadel', '7764774', 'SA0218IBYZVZJSEC8536V4XC', 'Compliance Officers', 'Gas Distribution Plant Operator', 500000, 'Larry Schumm', '3516410', 'SA0218IBYZVZJSEC8536V4XC', 'Artist', 'Gas Plant Operator', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 247, NULL, '1', 'bangla', 'commerce', '1926-11-17 00:00:00', 'christianism', 'Letha Prosacco', '2455181', 'SA0218IBYZVZJSEC8536V4XC', 'Radio Operator', 'Recreation and Fitness Studies Teacher', 300000, 'August Denesik', '4674230', 'SA0218IBYZVZJSEC8536V4XC', 'Marking Clerk', 'Janitor', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `student_infos` (`id`, `student_id`, `coursegroup_id`, `session`, `version`, `group`, `birthday`, `religion`, `father_name`, `father_phone_number`, `father_national_id`, `father_occupation`, `father_designation`, `father_annual_income`, `mother_name`, `mother_phone_number`, `mother_national_id`, `mother_occupation`, `mother_designation`, `mother_annual_income`, `user_id`, `created_at`, `updated_at`, `height`, `weight`, `signature`, `father_email`, `mother_email`, `father_passport`, `contact_person`, `contact_person_mobile`, `contact_person_email`, `relation_with_cperson`, `present_address`, `present_post_office`, `present_postcode`, `present_thana`, `present_district`, `present_division`, `permanent_address`, `permanent_post_office`, `permanent_postcode`, `permanent_thana`, `permanent_district`, `permanent_division`, `dob_no`, `gName`, `gNationality`, `gMobile`, `gEmail`, `gdate`, `gnric_no`, `gPhone`, `gAddress`, `gOccupation`, `singaporepr`, `bengaliLang`, `placeBirth`, `street_address_1`, `street_address_2`, `city`, `state`, `zipCode`, `country`, `admission_mark`, `main_school_name_address`, `admission_bengali_class`, `class_roll`) VALUES
(79, 259, NULL, '1', 'english', 'commerce', '1966-04-25 00:00:00', 'other', 'Miss Alba Schmeler', '3386117', 'SA0218IBYZVZJSEC8536V4XC', 'Microbiologist', 'Supervisor of Police', 700000, 'Jesse Casper DVM', '3037980', 'SA0218IBYZVZJSEC8536V4XC', 'Separating Machine Operators', 'Fabric Pressers', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 135, NULL, '1', 'bangla', 'commerce', '1952-08-18 00:00:00', 'other', 'Karley Christiansen', '9808626', 'SA0218IBYZVZJSEC8536V4XC', 'Tax Preparer', 'Insurance Claims Clerk', 700000, 'Jose Daniel', '1242264', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Scientist', 'Dental Hygienist', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 211, NULL, '1', 'bangla', 'commerce', '1961-10-19 00:00:00', 'christianism', 'Mr. Wyman Goyette DVM', '1220323', 'SA0218IBYZVZJSEC8536V4XC', 'Nuclear Medicine Technologist', 'Architect', 300000, 'Fabiola Keeling I', '1521548', 'SA0218IBYZVZJSEC8536V4XC', 'Library Science Teacher', 'Air Crew Officer', 1000000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 240, NULL, '1', 'english', 'commerce', '1977-03-12 00:00:00', 'buddhism', 'Edwardo Prohaska', '4618458', 'SA0218IBYZVZJSEC8536V4XC', 'Vending Machine Servicer', 'Command Control Center Specialist', 1000000, 'Francis Kuvalis', '6276647', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Support Specialist', 'Sheriff', 300000, NULL, '2020-10-28 06:24:12', '2020-10-28 06:24:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 156, NULL, '1', 'english', 'commerce', '1971-09-29 00:00:00', 'other', 'Eloisa Lang MD', '891311', 'SA0218IBYZVZJSEC8536V4XC', 'Graduate Teaching Assistant', 'Cutting Machine Operator', 300000, 'Dr. Alicia Hand III', '7570278', 'SA0218IBYZVZJSEC8536V4XC', 'Naval Architects', 'Tile Setter OR Marble Setter', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 243, NULL, '1', 'bangla', 'commerce', '1924-05-31 00:00:00', 'christianism', 'Gus King', '5783972', 'SA0218IBYZVZJSEC8536V4XC', 'Furnace Operator', 'Roof Bolters Mining', 700000, 'Antonio Kutch', '5671792', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Inspector', 'Library Science Teacher', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 97, NULL, '1', 'bangla', 'commerce', '1927-08-21 00:00:00', 'hinduism', 'Darrick Mosciski', '2142669', 'SA0218IBYZVZJSEC8536V4XC', 'Statement Clerk', 'Insulation Worker', 1000000, 'Carley Simonis', '9247453', 'SA0218IBYZVZJSEC8536V4XC', 'Vending Machine Servicer', 'Retail Sales person', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 150, NULL, '1', 'bangla', 'commerce', '1929-12-07 00:00:00', 'buddhism', 'Erin Schamberger', '8430226', 'SA0218IBYZVZJSEC8536V4XC', 'Ship Mates', 'Hand Trimmer', 700000, 'Vincenza Lesch', '4799623', 'SA0218IBYZVZJSEC8536V4XC', 'Business Manager', 'Boilermaker', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 244, NULL, '1', 'english', 'commerce', '1944-04-10 00:00:00', 'islam', 'Claudine Greenfelder PhD', '2877491', 'SA0218IBYZVZJSEC8536V4XC', 'Precision Etcher and Engraver', 'Electrotyper', 300000, 'Dr. Jeromy Cormier DDS', '765526', 'SA0218IBYZVZJSEC8536V4XC', 'Metal Fabricator', 'Jewelry Model OR Mold Makers', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 114, NULL, '1', 'english', 'commerce', '1989-09-24 00:00:00', 'christianism', 'Diamond Gulgowski', '5090274', 'SA0218IBYZVZJSEC8536V4XC', 'Teacher', 'Diesel Engine Specialist', 700000, 'Darrell Quitzon I', '2625138', 'SA0218IBYZVZJSEC8536V4XC', 'Tool Sharpener', 'Licensing Examiner and Inspector', 700000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 129, NULL, '1', 'english', 'commerce', '1968-09-10 00:00:00', 'christianism', 'Prof. Denis Ortiz Jr.', '6456475', 'SA0218IBYZVZJSEC8536V4XC', 'Aircraft Structure Assemblers', 'Night Shift', 500000, 'Rick Flatley', '9194574', 'SA0218IBYZVZJSEC8536V4XC', 'Radar Technician', 'Administrative Law Judge', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 243, NULL, '1', 'english', 'commerce', '1949-02-05 00:00:00', 'islam', 'Dr. Michale Pfeffer MD', '5392302', 'SA0218IBYZVZJSEC8536V4XC', 'HVAC Mechanic', 'Sewing Machine Operator', 300000, 'Jaqueline Emmerich', '6818862', 'SA0218IBYZVZJSEC8536V4XC', 'Marine Architect', 'Automotive Glass Installers', 500000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 153, NULL, '1', 'bangla', 'arts', '1988-06-19 00:00:00', 'christianism', 'Shyann Wuckert', '7229854', 'SA0218IBYZVZJSEC8536V4XC', 'Tractor Operator', 'Staff Psychologist', 1000000, 'Conrad Wunsch', '985137', 'SA0218IBYZVZJSEC8536V4XC', 'Instrument Sales Representative', 'Insurance Policy Processing Clerk', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 94, NULL, '1', 'english', 'arts', '1964-08-26 00:00:00', 'other', 'Jayson Olson III', '1289882', 'SA0218IBYZVZJSEC8536V4XC', 'Railroad Yard Worker', 'Office Clerk', 500000, 'Velva Deckow', '3607466', 'SA0218IBYZVZJSEC8536V4XC', 'Homeland Security', 'General Practitioner', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 87, NULL, '1', 'english', 'arts', '1923-11-20 00:00:00', 'christianism', 'Devante Yost', '1580164', 'SA0218IBYZVZJSEC8536V4XC', 'Supervisor of Police', 'Diesel Engine Specialist', 500000, 'Nyah Muller', '9010718', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Repairer', 'Communications Equipment Operator', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 83, NULL, '1', 'english', 'arts', '1932-03-08 00:00:00', 'hinduism', 'Maria Kirlin', '4465366', 'SA0218IBYZVZJSEC8536V4XC', 'Tree Trimmer', 'Forest Fire Fighting Supervisor', 300000, 'Dr. Moises Howell II', '2454974', 'SA0218IBYZVZJSEC8536V4XC', 'Electrician', 'Marine Architect', 500000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 217, NULL, '1', 'english', 'arts', '2005-02-05 00:00:00', 'christianism', 'Dr. Garnet Hodkiewicz', '4705313', 'SA0218IBYZVZJSEC8536V4XC', 'Sawing Machine Operator', 'Executive Secretary', 500000, 'Dereck Connelly', '550417', 'SA0218IBYZVZJSEC8536V4XC', 'Armored Assault Vehicle Officer', 'Lawyer', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 142, NULL, '1', 'bangla', 'arts', '1943-06-21 00:00:00', 'christianism', 'Mauricio Herman III', '8188376', 'SA0218IBYZVZJSEC8536V4XC', 'Bicycle Repairer', 'Insulation Installer', 1000000, 'Mrs. Alice Champlin Sr.', '9224322', 'SA0218IBYZVZJSEC8536V4XC', 'Fire Inspector', 'Timing Device Assemblers', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 156, NULL, '1', 'bangla', 'arts', '2000-08-26 00:00:00', 'christianism', 'Dr. Fidel Fahey Jr.', '3818730', 'SA0218IBYZVZJSEC8536V4XC', 'Movie Director oR Theatre Director', 'Plating Operator OR Coating Machine Operator', 500000, 'Ms. Janae Donnelly IV', '9542333', 'SA0218IBYZVZJSEC8536V4XC', 'Lay-Out Worker', 'Geological Data Technician', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 118, NULL, '1', 'bangla', 'arts', '1932-12-04 00:00:00', 'christianism', 'Ms. Hortense Flatley', '7050373', 'SA0218IBYZVZJSEC8536V4XC', 'Psychologist', 'Cement Mason and Concrete Finisher', 700000, 'Ms. Zoie Carter', '2955921', 'SA0218IBYZVZJSEC8536V4XC', 'Usher', 'Advertising Manager OR Promotions Manager', 700000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 216, NULL, '1', 'english', 'arts', '1921-07-15 00:00:00', 'islam', 'Eddie Gaylord', '5692692', 'SA0218IBYZVZJSEC8536V4XC', 'Clinical School Psychologist', 'Teacher', 700000, 'Mrs. Pansy Maggio', '2525835', 'SA0218IBYZVZJSEC8536V4XC', 'Welder', 'Cost Estimator', 1000000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 248, NULL, '1', 'english', 'arts', '1941-05-18 00:00:00', 'other', 'Prof. Verona Carter', '5374773', 'SA0218IBYZVZJSEC8536V4XC', 'Crossing Guard', 'Job Printer', 1000000, 'Gene Smith', '3677383', 'SA0218IBYZVZJSEC8536V4XC', 'Computer Repairer', 'Portable Power Tool Repairer', 300000, NULL, '2020-10-28 06:24:13', '2020-10-28 06:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 267, NULL, '1', '', '', '2020-11-23 00:00:00', '', 'mr', '', '', '', '', 0, 'ms', '', '', '', '', 0, 2, '2020-11-23 06:56:25', '2020-11-23 06:56:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 189, NULL, '1', '', 'Ducimus deleniti su', '0000-00-00 00:00:00', '', 'Martina Neal', '+1 (636) 626-4916', 'Modi fugit molestia', 'Laborum Voluptates', 'Tenetur veniam labo', 815, 'Violet Carson', '+1 (192) 702-1653', 'Veniam officia reru', 'Eveniet dolor odit', 'Autem provident max', 336, 12, '2020-12-28 10:02:21', '2020-12-28 10:02:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 208, NULL, '1', '', 'Nam sint tempore i', '2021-01-20 16:08:37', '', 'MacKenzie Shepherd', '+1 (422) 599-3455', 'Et magnam nemo qui o', 'In elit illum cupi', 'Dolorem dolore paria', 383, 'Simon Mathis', '+1 (974) 368-6154', 'Quas hic quo ut volu', 'Placeat qui tempora', 'Modi quisquam odio N', 588, 12, '2021-01-05 10:06:23', '2021-01-05 10:06:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 112, 1, '1', 'spanish', 'Ea accusantium obcae', '0000-00-00 00:00:00', '1', 'Sharon Simon', '+1 (757) 922-4598', 'In occaecat non enim', 'Eaque culpa mollit', 'Maxime culpa qui vo', 681, 'Xander Maxwell', '+1 (321) 345-2505', 'Consequatur corporis', 'Nesciunt ea quo dol', 'Voluptatem in amet', 496, 12, '2021-01-16 12:09:56', '2021-01-16 12:24:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 488, 1, '1', '', '', '0000-00-00 00:00:00', '1', 'Maggy Lowe', '', '', '', '', 0, 'Lisandra Santiago', '', '', '', '', 0, 12, '2021-03-31 07:53:05', '2021-03-31 07:53:05', NULL, NULL, NULL, NULL, NULL, NULL, 'Omnis sit nesciunt', 'In consequatur dolo', 'nabyrywo@mailinator.com', 'Non dolorem debitis', 'Ipsa cum reprehende', 'Aliquid eum neque do', '82', 'Ut aut autem obcaeca', 'Accusamus modi magna', 'Ipsam ducimus esse', 'Ipsa cum reprehende', 'Aliquid eum neque do', '82', 'Ut aut autem obcaeca', 'Accusamus modi magna', 'Ipsam ducimus esse', 'Vitae modi velit ut', 'Russell Hughes', 'Ut illo rerum expedi', 'Fugiat quis distinct', 'virawy@mailinator.com', '0000-00-00', 'Ut dolore molestiae', '+1 (554) 261-6972', 'Ipsa quidem fuga I', 'Alias vitae labore s', 1, NULL, 'Amet et in voluptat', NULL, NULL, NULL, NULL, NULL, '18', 20, 'Tanisha Craig', 'In ut et dolor dolor', 1),
(112, 489, 1, '1', '', '', '2018-04-06 00:00:00', '3', 'Hammett Bowman', '', '', '', '', 0, 'Colette Browning', '', '', '', '', 0, 12, '2021-03-31 07:53:06', '2021-03-31 07:53:06', NULL, NULL, NULL, NULL, NULL, NULL, 'Lilah Gonzalez', 'Eu deserunt exceptur', 'ponetiq@mailinator.com', 'Iure aliquip assumen', 'Dolores ea soluta sa', 'Illum nulla iste ad', 'Deserunt consequatur', '140', '24', '1', 'Dolores ea soluta sa', 'Illum nulla iste ad', 'Deserunt consequatur', '140', '24', '1', 'Quisquam qui molliti', 'Adrienne Greer', 'Dolores dolores dict', 'Fugiat tempora error', 'pudafudi@mailinator.com', '0000-00-00', 'Et qui totam non quo', '+1 (732) 729-1768', 'Deleniti commodi ius', 'Reprehenderit itaqu', 1, 'Good', 'Quia distinctio Cor', NULL, NULL, NULL, NULL, NULL, '18', NULL, 'Brittany Estes', 'In commodi ut minim', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `school_payment_id` bigint(20) UNSIGNED NOT NULL,
  `month` tinyint(4) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` double(8,2) NOT NULL,
  `rangeFrom` datetime DEFAULT NULL,
  `rangeTo` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `school_id`, `school_payment_id`, `month`, `quantity`, `price`, `rangeFrom`, `rangeTo`, `created_at`, `updated_at`) VALUES
(1, 418, 0, 66, 4, 1, 100.00, '2021-03-02 15:49:14', '2021-07-02 15:49:14', '2021-03-02 09:44:30', '2021-03-02 09:44:30'),
(2, 419, 0, 67, 1, 1, 50.00, '2021-03-02 16:03:01', '2021-04-02 16:03:01', '2021-03-02 09:58:14', '2021-03-02 09:58:14'),
(3, 420, 0, 68, 1, 1, 50.00, '2021-03-02 16:14:09', '2021-04-02 16:14:09', '2021-03-02 10:09:23', '2021-03-02 10:09:23'),
(4, 423, 0, 70, 4, 1, 20.00, '2021-03-02 05:56:43', '2021-07-02 11:56:43', '2021-03-02 11:56:44', '2021-03-02 11:56:44'),
(5, 424, 0, 71, 2, 1, 50.00, '2021-03-02 06:09:55', '2021-05-02 12:09:55', '2021-03-02 12:09:57', '2021-03-02 12:09:57'),
(6, 425, 0, 72, 4, 1, 100.00, '2021-03-03 11:39:59', '2021-07-03 11:39:59', '2021-03-03 05:35:08', '2021-03-03 05:35:08'),
(7, 426, 0, 73, 2, 1, 50.00, '2021-03-03 12:00:58', '2021-02-28 06:00:58', '2021-03-03 06:01:04', '2021-03-03 06:01:04'),
(8, 427, 0, 75, 4, 1, 100.00, '2021-03-06 11:18:30', '2021-07-06 11:18:30', '2021-03-06 05:13:39', '2021-03-06 05:13:39'),
(9, 427, 96, 86, 2, 1, 500.00, '2021-03-09 18:30:01', '2021-05-09 18:30:01', '2021-03-09 12:24:59', '2021-03-09 12:24:59'),
(10, 427, 96, 87, 2, 1, 500.00, '2021-03-09 18:31:37', '2021-05-09 18:31:37', '2021-03-09 12:26:35', '2021-03-09 12:26:35'),
(11, 425, 94, 88, 2, 1, 500.00, '2021-03-10 12:45:06', '2021-05-10 12:45:06', '2021-03-10 07:07:44', '2021-03-10 07:07:44'),
(12, 425, 94, 89, 2, 1, 500.00, '2021-03-10 13:20:50', '2021-05-10 13:20:50', '2021-03-10 07:16:08', '2021-03-10 07:16:08'),
(13, 425, 94, 90, 2, 1, 500.00, '2021-03-10 13:37:10', '2021-05-10 13:37:10', '2021-03-10 07:37:28', '2021-03-10 07:37:28'),
(14, 425, 94, 91, 2, 1, 500.00, '2021-03-10 14:04:47', '2021-05-10 14:04:47', '2021-03-10 07:59:45', '2021-03-10 07:59:45'),
(15, 425, 94, 92, 2, 1, 500.00, '2021-03-10 14:11:56', '2021-05-10 14:11:56', '2021-03-10 08:06:53', '2021-03-10 08:06:53'),
(16, 425, 94, 93, 2, 1, 500.00, '2021-03-10 15:29:12', '2021-05-10 15:29:12', '2021-03-10 09:24:10', '2021-03-10 09:24:10'),
(17, 425, 94, 94, 2, 1, 500.00, '2021-03-10 15:31:29', '2021-05-10 15:31:29', '2021-03-10 09:26:27', '2021-03-10 09:26:27'),
(18, 425, 94, 95, 2, 1, 500.00, '2021-05-10 15:31:29', '2021-07-10 15:31:29', '2021-03-10 09:35:17', '2021-03-10 09:35:17'),
(19, 427, 96, 96, 2, 1, 500.00, '2021-07-06 11:18:30', '2021-09-06 11:18:30', '2021-03-10 10:48:09', '2021-03-10 10:48:09'),
(20, 427, 96, 97, 2, 1, 500.00, '2021-09-06 11:18:30', '2021-11-06 11:18:30', '2021-03-10 10:49:35', '2021-03-10 10:49:35'),
(21, 427, 96, 98, 2, 1, 500.00, '2021-11-06 11:18:30', '2022-01-06 11:18:30', '2021-03-10 10:54:54', '2021-03-10 10:54:54'),
(22, 425, 94, 106, 2, 1, 500.00, '2021-07-10 15:31:29', '2021-09-10 15:31:29', '2021-03-15 10:20:14', '2021-03-15 10:20:14'),
(23, 426, 95, 110, 6, 1, 200.00, '0000-00-00 00:00:00', '2021-09-16 11:31:41', '2021-03-16 05:31:41', '2021-03-16 05:31:41'),
(24, 426, 95, 113, 6, 1, 200.00, '2021-09-16 11:31:41', '2022-03-16 11:31:41', '2021-03-16 05:58:02', '2021-03-16 05:58:02'),
(25, 426, 95, 114, 12, 1, 1500.00, '2022-03-16 11:31:41', '2023-03-16 11:31:41', '2021-03-16 06:03:01', '2021-03-16 06:03:01'),
(26, 425, 94, 115, 2, 1, 500.00, '2021-09-10 15:31:29', '2021-11-10 15:31:29', '2021-03-18 07:25:34', '2021-03-18 07:25:34'),
(27, 425, 94, 116, 2, 1, 500.00, '2021-11-10 15:31:29', '2022-01-10 15:31:29', '2021-03-18 07:31:21', '2021-03-18 07:31:21'),
(28, 425, 94, 120, 5, 1, 1500.00, '2022-01-10 15:31:29', '2022-06-10 15:31:29', '2021-03-18 09:10:44', '2021-03-18 09:10:44'),
(29, 425, 94, 121, 5, 1, 1500.00, '2022-06-10 15:31:29', '2022-11-10 15:31:29', '2021-03-18 11:13:56', '2021-03-18 11:13:56'),
(30, 425, 94, 122, 5, 1, 1500.00, '2022-11-10 15:31:29', '2023-04-10 15:31:29', '2021-03-18 11:16:58', '2021-03-18 11:16:58'),
(31, 428, 97, 124, 12, 1, 200.00, '2021-03-23 01:49:03', '2022-03-23 07:49:03', '2021-03-23 07:49:11', '2021-03-23 07:49:11'),
(32, 12, 1, 125, 12, 1, 1500.00, '4368-03-24 16:16:56', '2022-03-24 05:39:28', '2021-03-24 05:39:34', '2021-03-24 05:39:34'),
(33, 425, 94, 133, 4, 1, 15000.00, '2023-04-10 15:31:29', '2023-08-10 15:31:29', '2021-03-25 07:27:14', '2021-03-25 07:27:14'),
(34, 425, 94, 134, 7, 1, 2000.00, '2023-08-10 15:31:29', '2024-03-10 15:31:29', '2021-03-25 07:29:07', '2021-03-25 07:29:07'),
(35, 424, 93, 143, 6, 1, 200.00, '2021-05-02 12:09:55', '2021-11-02 12:09:55', '2021-03-25 10:09:57', '2021-03-25 10:09:57'),
(36, 424, 93, 144, 12, 1, 1500.00, '2021-11-02 12:09:55', '2022-11-02 12:09:55', '2021-03-25 10:12:15', '2021-03-25 10:12:15'),
(37, 445, 98, 146, 12, 1, 1000.00, '2021-03-25 17:35:27', '2022-03-25 17:35:27', '2021-03-25 11:29:58', '2021-03-25 11:29:58'),
(38, 416, 85, 147, 2, 1, 500.00, '2021-03-29 17:54:09', '2021-05-29 17:54:09', '2021-03-29 11:48:35', '2021-03-29 11:48:35'),
(39, 416, 85, 148, 7, 1, 2000.00, '2021-05-29 17:54:09', '2021-12-29 17:54:09', '2021-03-29 11:59:31', '2021-03-29 11:59:31'),
(40, 416, 85, 149, 5, 1, 1500.00, '2021-12-29 17:54:09', '2022-05-29 17:54:09', '2021-03-29 12:01:26', '2021-03-29 12:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `syllabuses`
--

CREATE TABLE `syllabuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_id` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syllabuses`
--

INSERT INTO `syllabuses` (`id`, `file_path`, `title`, `description`, `active`, `school_id`, `user_id`, `created_at`, `updated_at`, `class_id`) VALUES
(2, 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/MULTIFILE/1609752930.png', 'Omnis optio unde id', '', 1, 1, 12, '2021-01-04 09:35:31', '2021-01-04 09:35:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacherinfos`
--

CREATE TABLE `teacherinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `level_of_education` tinyint(4) NOT NULL,
  `exam_degree_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_of_passing` year(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacherinfos`
--

INSERT INTO `teacherinfos` (`id`, `user_id`, `level_of_education`, `exam_degree_title`, `others`, `result`, `group`, `institution`, `duration`, `year_of_passing`, `status`, `created_at`, `updated_at`) VALUES
(1, 45, 1, 'S', NULL, 'Quibusdam', 'Neque officiis dolor', 'Connor Long', '1999', 2000, 1, '2020-11-25 09:30:46', '2021-01-24 12:10:00'),
(5, 45, 3, 'Diploma in Engineering', NULL, 'fgzg', 'dzgdx', 'zgzgzdg', 'zgzgdg', 1996, 1, '2020-11-25 11:50:31', '2020-11-25 11:50:31'),
(6, 45, 4, 'A', 'Other Exam Arun', '5.00', 'S', 'IPSITA', '2', 2021, 1, '2020-11-25 11:55:22', '2021-01-24 12:09:45'),
(7, 341, 1, 'O Level', NULL, '5', 'Science', 'Olympia Gregory', '2', 2005, 1, '2020-11-30 06:18:24', '2020-11-30 08:44:01'),
(8, 341, 2, 'A Level', NULL, '3', 'Science', 'Reprehenderit conseq', '2', 2007, 1, '2020-11-30 06:18:24', '2020-11-30 08:44:27'),
(9, 341, 4, 'Bachelor of Commerce (BCom)', NULL, '3.5', 'Accounting', 'Bangla', '4', 2011, 1, '2020-11-30 08:28:28', '2020-11-30 08:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `templete_designs`
--

CREATE TABLE `templete_designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=admission admit,2=exam admit,3=marksheet',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `examname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `examdate` date NOT NULL,
  `examcenter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_position` tinyint(4) DEFAULT NULL,
  `is_name` tinyint(4) DEFAULT NULL,
  `is_fname` tinyint(4) DEFAULT NULL,
  `is_mname` tinyint(4) DEFAULT NULL,
  `is_email` tinyint(4) DEFAULT NULL,
  `is_phone` tinyint(4) DEFAULT NULL,
  `is_address` tinyint(4) DEFAULT NULL,
  `is_admission_id` tinyint(4) DEFAULT NULL,
  `is_st_id` tinyint(4) DEFAULT NULL,
  `is_photo` tinyint(4) DEFAULT NULL,
  `photo_position` tinyint(4) DEFAULT NULL,
  `is_class` tinyint(4) DEFAULT NULL,
  `is_section` tinyint(4) DEFAULT NULL,
  `is_session` tinyint(4) DEFAULT NULL,
  `page` enum('a4','a5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `llogo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rlogo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mlogo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lsign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lsign_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msign_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsign_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgimg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bodyText` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footerText` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templete_designs`
--

INSERT INTO `templete_designs` (`id`, `school_id`, `type`, `name`, `heading`, `examname`, `examdate`, `examcenter`, `info_position`, `is_name`, `is_fname`, `is_mname`, `is_email`, `is_phone`, `is_address`, `is_admission_id`, `is_st_id`, `is_photo`, `photo_position`, `is_class`, `is_section`, `is_session`, `page`, `llogo`, `rlogo`, `mlogo`, `msign`, `lsign`, `rsign`, `lsign_title`, `msign_title`, `rsign_title`, `bgimg`, `bodyText`, `footerText`, `status`, `created_at`, `updated_at`) VALUES
(59, 1, 1, 'Patricia Salinas', 'Aut cum omnis cumque', 'Hyatt Le', '2008-02-12', 'Sed in qui et repreh', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, 'a4', '', '', '', '', '', '', NULL, 'Dolorem libero nihil', 'Magna aut aut consec', NULL, '', 'Aut deserunt obcaeca', 1, '2021-01-21 11:37:28', '2021-01-21 11:37:28'),
(60, 1, 2, 'Evelyn Combs', 'Voluptas eum invento', 'Isabella Noble', '1987-06-20', 'Aspernatur mollit di', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, 'a4', '', '', '', '', '', '', 'Laudantium pariatur', NULL, 'Autem quia voluptas', NULL, '', 'Deserunt ipsum aut p', 1, '2021-01-21 11:37:42', '2021-01-21 11:37:42'),
(61, 1, 3, 'Boris Mcintosh', 'Sequi at nihil nulla', 'Moses Manning', '2020-08-08', 'Est in vel ad quos f', 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, 1, 2, 1, 1, 1, 'a5', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/2801611380998.png', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/5501611394199.png', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/9861611394199.png', 'Left Sign Title', NULL, 'Left Sign Title', NULL, 'Ipsum voluptas estIpsum voluptas estIpsum voluptas est Ipsum voluptas estIpsum voluptas estIpsum voluptas est Ipsum voluptas estIpsum voluptas estIpsum voluptas est', 'Ipsum voluptas est', 1, '2021-01-21 11:46:26', '2021-01-23 09:39:24'),
(63, 1, 1, 'Martha Flynn', 'Ex eiusmod mollit vo', 'Zeus Shelton', '2021-01-19', 'Quod cillum consequa', 1, 1, 1, 1, NULL, NULL, NULL, 1, NULL, 1, 1, 1, 1, 1, 'a5', '', '', '', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/5891611395623.png', 'yfffhghkjbjkbjn', NULL, 'vgjvjhvhkbkbjbjkbjkbjbjbjbjb', NULL, 'Quod cillum consequaQuod cillum consequaQuod cillum consequa Quod cillum consequaQuod cillum consequaQuod cillum consequa', 'Asperiores non non a', 1, '2021-01-23 09:40:35', '2021-01-23 09:53:43'),
(64, 1, 1, 'Tiger Johnson', 'Consectetur veniam', 'Lacy Sullivan', '2008-11-04', 'In cum delectus est', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 'a5', '', '', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/2491611401632.png', '', 'cx', NULL, NULL, NULL, '', 'Consequat Iure ulla', 1, '2021-01-23 09:59:51', '2021-01-23 11:35:23'),
(65, 1, 2, 'Brian Santana', 'Cum officiis irure v', 'Amena Lucas', '2000-01-11', 'Ut ut sed in ullamco', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'a4', NULL, '', '', NULL, NULL, NULL, 'xvfcbn bv', 'xaaddad', NULL, NULL, '', 'Excepturi quas totam', 1, '2021-01-23 11:43:37', '2021-01-24 08:17:12'),
(66, 1, 1, 'Branden Shields', 'Aspernatur ipsum fug', 'Constance Noble', '2015-09-06', 'Ut omnis dicta debit', 2, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 2, 1, 1, NULL, 'a5', '', '', '', '', '', NULL, 'Facilis eaque non di', 'Ex adipisicing digni', 'Asiffffffffff', NULL, '', 'Sint est quo est po', 1, '2021-01-24 05:17:59', '2021-01-24 07:34:55'),
(67, 1, 1, 'Kiara Mercado', 'Lorem tenetur ipsum', 'Fleur Alvarez', '1998-10-11', 'Consequuntur quis et', 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, 1, 'a5', '', '', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/9181611490833.png', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/3491611490834.png', 'Commodi aut at enim', NULL, 'Commodi aut at enim', NULL, '\r\n	Commodi aut at enim\r\n	Commodi aut at enim\r\n	Commodi aut at enim\r\n	Commodi aut at enim\r\n	Commodi aut at enim\r\n', 'In est commodo offic', 1, '2021-01-24 05:21:38', '2021-01-24 12:20:34'),
(68, 1, 2, 'admission/admitcard', 'admission/admitcard', 'Ezekiel Brady', '1994-06-06', 'Aliquam incididunt v', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'a4', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/1531612088162.png', '', '', '', '', NULL, NULL, NULL, NULL, '', 'Excepteur odio recus', 1, '2021-01-24 09:51:10', '2021-01-31 10:16:02'),
(69, 1, 1, 'Camilla Kemp', 'Rerum labore asperna', 'Mia Patel', '2021-01-27', 'Et enim ex qui nihil', 2, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 'a5', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/9391612081937.png', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/8731612081937.png', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TEMPLETE/7821612081937.png', 'Head Master', NULL, 'Head Master', NULL, '', 'Laborum temporibus v', 1, '2021-01-31 08:32:17', '2021-01-31 08:32:17'),
(70, 1, 2, 'sssssssss', 'Corrupti quo offici', 'Chanda Deleon', '2017-05-27', 'Sit dolores sequi ve', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'a5', '', '', '', '', '', '', 'Impedit voluptatibu', NULL, 'Et rerum sint dicta', NULL, '', 'Cumque rem cupidatat', 2, '2021-02-04 09:41:23', '2021-02-04 09:41:23'),
(71, 1, 3, 'czcczzxc', 'ASif', 'cdcc', '2021-03-23', 'cdsdbfgfbgfbgfb', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'a4', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'gbgfbfgfgbfgbfgbgbfg', '', 2, '2021-03-03 09:41:40', '2021-03-03 09:41:40'),
(72, 1, 1, 'New 1', 'Admit Card', 'First Term', '2021-04-01', 'Building 1', 2, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, NULL, NULL, NULL, 'a4', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'Admit CardAdmit CardAdmit CardAdmit CardAdmit CardAdmit Card', 'Admit CardAdmit CardAdmit CardAdmit CardAdmit CardAdmit Card', 1, '2021-04-01 05:07:18', '2021-04-01 05:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `school_id`, `title`, `message`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 'Velit non rerum opti', 'Message about Mr. shihab', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/TP/1609416305.png', 1, '2020-12-31 12:04:10', '2020-12-31 12:05:05'),
(6, 1, 'Elit suscipit minus', 'Ullamco impedit ips', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/TP/4561612869017.png', 1, '2021-01-17 11:10:20', '2021-02-09 11:10:18'),
(7, 1, 'test', 'for test', 'http://192.168.0.107:8001/storage/FA20165757S/FA20165757H/2021/TP/9711614598970.png', 1, '2021-01-23 07:51:13', '2021-03-01 05:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `namebn` varchar(200) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `division_id`, `district_id`, `name`, `namebn`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 47, 'Noakhali', 'নোয়াখালী ', 1, NULL, NULL),
(2, 2, 47, 'Begumganj ', 'বেগমগঞ্জ', 1, NULL, NULL),
(3, 2, 47, 'Senbagh ', 'সেনবাগ', 1, NULL, NULL),
(4, 2, 47, 'Companigonj ', 'কোম্পানীগঞ্জ', 1, NULL, NULL),
(5, 2, 47, 'Chatkhil ', 'চাটখিল ', 1, NULL, NULL),
(6, 2, 47, 'Sonaimuri ', 'সোনাইমুড়ী', 1, NULL, NULL),
(7, 2, 47, 'Hatia ', 'হাতিয়া', 1, NULL, NULL),
(8, 2, 47, 'Subarnachar ', 'সূবর্ণচর', 1, NULL, NULL),
(9, 2, 47, 'Kabirhat ', 'কবিরহাট', 1, NULL, NULL),
(10, 2, 5, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 1, NULL, NULL),
(11, 2, 5, 'Bijoynagar ', 'বিজয়নগর', 1, NULL, NULL),
(12, 2, 5, 'Akhaura ', 'আখাউড়া ', 1, NULL, NULL),
(13, 2, 5, 'Ashuganj ', 'আশুগঞ্জ ', 1, NULL, NULL),
(14, 2, 5, 'Bancharampur ', 'বাঞ্ছারামপুর', 1, NULL, NULL),
(15, 2, 5, 'Kasba ', 'কসবা', 1, NULL, NULL),
(16, 2, 5, 'Nabinagar', 'নবীনগর', 1, NULL, '2020-12-19 10:04:03'),
(17, 2, 5, 'Nasirnagar ', 'নাসিরনগর ', 1, NULL, NULL),
(18, 2, 5, 'Sarail ', 'সরাইল', 1, NULL, NULL),
(19, 2, 11, 'Comilla Sadar South', 'কুমিল্লা সদর দক্ষিণ', 1, NULL, NULL),
(20, 2, 11, 'Comilla Adarsa Sadar ', 'কুমিল্লা আদর্শ সদর', 1, NULL, NULL),
(21, 2, 11, 'Barura ', 'বরুড়া', 1, NULL, NULL),
(22, 2, 11, 'Chandina ', 'চান্দিনা ', 1, NULL, NULL),
(23, 2, 11, 'Chauddagram ', 'চৌদ্দগ্রাম', 1, NULL, NULL),
(24, 2, 11, 'Daudkandi ', 'দাউদকান্দি ', 1, NULL, NULL),
(25, 2, 11, 'Brahmanpara ', 'ব্রাহ্মণপাড়া', 1, NULL, NULL),
(26, 2, 11, 'Homna ', 'হোমনা', 1, NULL, NULL),
(27, 2, 11, 'Monohorgonj ', 'মনোহরগঞ্জ', 1, NULL, NULL),
(28, 2, 11, 'Laksam ', 'লাকসাম ', 1, NULL, NULL),
(29, 2, 11, 'Debidwar ', 'দেবিদ্বার ', 1, NULL, NULL),
(30, 2, 11, 'Meghna ', 'মেঘনা ', 1, NULL, NULL),
(31, 2, 11, 'Muradnagar ', 'মুরাদনগর ', 1, NULL, NULL),
(32, 2, 11, 'Nangalkot ', 'নাঙ্গলকোট ', 1, NULL, NULL),
(33, 2, 11, 'Burichong ', 'বুড়িচং', 1, NULL, NULL),
(34, 2, 11, 'Titas ', 'তিতাস ', 1, NULL, NULL),
(35, 2, 31, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 1, NULL, NULL),
(36, 2, 31, 'Ramgati ', 'রামগতি', 1, NULL, NULL),
(37, 2, 31, 'Komolnagar ', 'কমল নগর', 1, NULL, NULL),
(38, 2, 31, 'Raipur ', 'রায়পুর', 1, NULL, NULL),
(39, 2, 31, 'Ramganj ', 'রামগঞ্জ', 1, NULL, NULL),
(40, 3, 59, 'Sherpur Sadar', 'শেরপুর সদর', 1, NULL, NULL),
(41, 3, 59, 'Nakla ', 'নকলা', 1, NULL, NULL),
(42, 3, 59, 'Sreebardi ', 'শ্রীবর্দি', 1, NULL, NULL),
(43, 3, 59, 'Nalitabari ', 'নালিতাবাড়ি', 1, NULL, NULL),
(44, 3, 59, 'Jhenaigati ', 'ঝিনাইগতি', 1, NULL, NULL),
(45, 2, 2, 'Alikadam', 'আলিকদম', 1, NULL, NULL),
(46, 2, 2, 'Bandarban Sadar', 'বান্দরবন সদর', 1, NULL, NULL),
(47, 2, 2, 'Lama', 'লামা', 1, NULL, NULL),
(48, 2, 2, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 1, NULL, NULL),
(49, 2, 2, 'Rowangchhari', 'রোয়াংছড়ি', 1, NULL, NULL),
(50, 2, 2, 'Ruma', 'রুমা', 1, NULL, NULL),
(51, 2, 2, 'Thanchi', 'থানচি', 1, NULL, NULL),
(52, 2, 8, 'Chandpur Sadar', 'চাঁদপুর সদর', 1, NULL, NULL),
(53, 2, 8, 'Faridganj', 'ফরিদগঞ্জ', 1, NULL, NULL),
(54, 2, 8, 'Haimchar', 'হাইমচর', 1, NULL, NULL),
(55, 2, 8, 'Hajiganj', 'হাজিগঞ্জ', 1, NULL, NULL),
(56, 2, 8, 'Kachua', 'কচুয়া', 1, NULL, NULL),
(57, 2, 8, 'Matlab', 'মতলব', 1, NULL, NULL),
(58, 2, 8, 'Uttar Matlab', 'উত্তর মতলব', 1, NULL, NULL),
(59, 2, 8, 'Shahrasti', 'শাহরাস্তি', 1, NULL, NULL),
(60, 2, 9, 'Anowara', 'আনোয়ারা', 1, NULL, NULL),
(61, 2, 9, 'Bayejid Bostami', 'বায়েজীদ বোস্তামী', 1, NULL, NULL),
(62, 2, 9, 'Banshkhali', 'বাঁশখালী', 1, NULL, NULL),
(63, 2, 9, 'Bakalia', 'বাকালিয়া', 1, NULL, NULL),
(64, 2, 9, 'Boalkhali', 'বোয়ালখালী', 1, NULL, NULL),
(65, 2, 9, 'Chandanaish', 'চন্দনাইশ', 1, NULL, NULL),
(66, 2, 9, 'Chandgaon', 'চাঁদগাও', 1, NULL, NULL),
(67, 2, 9, 'Chittagong Port', 'চট্টগ্রাম বন্দর', 1, NULL, NULL),
(68, 2, 9, 'Doublemooring', 'ডাবলমুরিং', 1, NULL, NULL),
(69, 2, 9, 'Fatikchhari', 'ফটিকছড়ি ', 1, NULL, NULL),
(70, 2, 9, 'Halishahar', 'হালিশহর', 1, NULL, NULL),
(71, 2, 9, 'Hathazari', 'হাটহাজারী', 1, NULL, NULL),
(72, 2, 9, 'Karnafuli', 'কর্ণফুলী', 1, NULL, NULL),
(73, 2, 9, 'Kotwali', 'কোতয়ালি', 1, NULL, NULL),
(74, 2, 9, 'Khulshi', 'খুলশী', 1, NULL, NULL),
(75, 2, 9, 'Lohagara', 'লোহাগাড়া', 1, NULL, NULL),
(76, 2, 9, 'Mirsharai', 'মীরসরাই', 1, NULL, NULL),
(77, 2, 9, 'Pahartali', 'পাহাড়তলী', 1, NULL, NULL),
(78, 2, 9, 'Panchlaish', 'পাঁচলাইশ', 1, NULL, NULL),
(79, 2, 9, 'Patiya', 'পটিয়া', 1, NULL, NULL),
(80, 2, 9, 'Patenga', 'পতেঙ্গা', 1, NULL, NULL),
(81, 2, 9, 'Rangunia', 'রাঙ্গুনিয়া', 1, NULL, NULL),
(82, 2, 9, 'Raozan', 'রাউজান', 1, NULL, NULL),
(83, 2, 9, 'Sandwip', 'সন্দ্বীপ', 1, NULL, NULL),
(84, 2, 9, 'Satkania', 'সাতকানিয়া', 1, NULL, NULL),
(85, 2, 9, 'Sitakunda', 'সীতাকুন্ড', 1, NULL, NULL),
(86, 2, 12, 'Chakaria', 'চকোরিয়া', 1, NULL, NULL),
(87, 2, 12, 'Cox\'s Bazar Sadar', 'কক্সবাজার সদর', 1, NULL, NULL),
(88, 2, 12, 'Kutubdia', 'কুতুবদিয়া', 1, NULL, NULL),
(89, 2, 12, 'Maheshkhali', 'মহেশখালী', 1, NULL, NULL),
(90, 2, 12, 'Ramu', 'রামু', 1, NULL, NULL),
(91, 2, 12, 'Teknaf', 'টেকনাফ ', 1, NULL, NULL),
(92, 2, 12, 'Ukhia', 'উখিয়া', 1, NULL, NULL),
(93, 2, 16, 'Chhagalnaiya', 'ছাগলনাইয়া', 1, NULL, NULL),
(94, 2, 16, 'Daganbhuiyan', 'দাগনভূইয়া', 1, NULL, NULL),
(95, 2, 16, 'Feni Sadar', 'ফেনী সদর', 1, NULL, NULL),
(96, 2, 16, 'Parshuram', 'পরশুরাম', 1, NULL, NULL),
(97, 2, 16, 'Sonagazi', 'সোনাগাজী', 1, NULL, NULL),
(98, 2, 26, 'Dighinala', 'দীঘিনালা', 1, NULL, NULL),
(99, 2, 26, 'Khagrachhari', 'খাগড়াছড়ি', 1, NULL, NULL),
(100, 2, 26, 'Lakshmichhari', 'লক্ষীছড়া', 1, NULL, NULL),
(101, 2, 26, 'Mahalchhari', 'মহালছড়ি', 1, NULL, NULL),
(102, 2, 26, 'Manikchhari', 'মানিকছড়ি', 1, NULL, NULL),
(103, 2, 26, 'Matiranga', 'মাটিরাঙ্গা', 1, NULL, NULL),
(104, 2, 26, 'Panchhari', 'পানছড়ি', 1, NULL, NULL),
(105, 2, 26, 'Ramgarh', 'রামগড়', 1, NULL, NULL),
(106, 2, 55, 'Baghaichhari', 'বাঘাইছড়ি', 1, NULL, NULL),
(107, 2, 55, 'Barkal', 'বরকল ', 1, NULL, NULL),
(108, 2, 55, 'Kawkhali (Betbunia)', 'কাউখালী ', 1, NULL, NULL),
(109, 2, 55, 'Belai', 'বেলাই', 1, NULL, NULL),
(110, 2, 55, 'Kaptai', 'কাপ্তাই', 1, NULL, NULL),
(111, 2, 55, 'Juraichhari', 'জুরাছড়ি ', 1, NULL, NULL),
(112, 2, 55, 'Langadu', 'লংগদু', 1, NULL, NULL),
(113, 2, 55, 'Naniarchar', 'নানিয়াচর', 1, NULL, NULL),
(114, 2, 55, 'Rajasthali', 'রাজস্থলী', 1, NULL, NULL),
(115, 2, 55, 'Rangamati Sadar', 'রাঙামাটি সদর', 1, NULL, NULL),
(116, 1, 3, 'Amtali', 'আমতলী', 1, NULL, NULL),
(117, 1, 3, 'Bamna', 'বামনা', 1, NULL, NULL),
(118, 1, 3, 'Barguna Sadar', 'বরগুনা সদর', 1, NULL, NULL),
(119, 1, 3, 'Betagi', 'বেতাগী', 1, NULL, NULL),
(120, 1, 3, 'Patharghata', 'পাথরঘাটা', 1, NULL, NULL),
(121, 1, 4, 'Agailjhara', 'আগৈলঝারা', 1, NULL, NULL),
(122, 1, 4, 'Babuganj', 'বাবুগঞ্জ', 1, NULL, NULL),
(123, 1, 4, 'Bakerganj', 'বাকেরগঞ্জ', 1, NULL, NULL),
(124, 1, 4, 'Banari Para', 'বানারিপাড়া', 1, NULL, NULL),
(125, 1, 4, 'Gaurnadi', 'গৌরনদী', 1, NULL, NULL),
(126, 1, 4, 'Hizla', 'হিজলা', 1, NULL, NULL),
(127, 1, 4, 'Barisal Sadar (Kotwali)', 'বরিশাল সদর(কোতয়ালি)', 1, NULL, NULL),
(128, 1, 4, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 1, NULL, NULL),
(129, 1, 4, 'Muladi', 'মুলাদি', 1, NULL, NULL),
(130, 1, 4, 'Wazirpur', 'উজিরপুর', 1, NULL, NULL),
(131, 1, 6, 'Bhola Sadar', 'ভোলা সদর', 1, NULL, NULL),
(132, 1, 6, 'Burhanuddin', 'বোরহানউদ্দিন ', 1, NULL, NULL),
(133, 1, 6, 'Charfasson', 'চরফ্যাসন ', 1, NULL, NULL),
(134, 1, 6, 'DaulatKhan', 'দৌলতখান ', 1, NULL, NULL),
(135, 1, 6, 'Lalmohan', 'লালমোহন', 1, NULL, NULL),
(136, 1, 6, 'Manpura', 'মনপুরা ', 1, NULL, NULL),
(137, 1, 6, 'Tazumuddin', 'তজমুদ্দিন ', 1, NULL, NULL),
(138, 1, 24, 'Jhalokati Sadar', 'ঝালকাঠি সদর', 1, NULL, NULL),
(139, 1, 24, 'Kathalia', 'কাঁঠালিয়া ', 1, NULL, NULL),
(140, 1, 24, 'Nalchity', 'নলছিটি ', 1, NULL, NULL),
(141, 1, 24, 'Rajapur', 'রাজাপুর ', 1, NULL, NULL),
(142, 1, 51, 'Bauphal', 'বাউফল ', 1, NULL, NULL),
(143, 1, 51, 'Dashmina', 'দশমিনা ', 1, NULL, NULL),
(144, 1, 51, 'Dumki', 'দুমকি', 1, NULL, NULL),
(145, 1, 51, 'Galachipa', 'গলাচিপা ', 1, NULL, NULL),
(146, 1, 51, 'Kalapara', 'কলাপাড়া', 1, NULL, NULL),
(147, 1, 51, 'Mirzaganj', 'মির্জাগঞ্জ ', 1, NULL, NULL),
(148, 1, 51, 'Patuakhali Sadar', 'পটুয়াখালি সদর', 1, NULL, NULL),
(149, 1, 52, 'Bhandaria', 'ভাণ্ডারিয়া ', 1, NULL, NULL),
(150, 1, 52, 'Kawkhali', 'কাউখালী ', 1, NULL, NULL),
(151, 1, 52, 'Mathbaria', 'মঠবাড়িয়া ', 1, NULL, NULL),
(152, 1, 52, 'Nazirpur', 'নাজিরপুর ', 1, NULL, NULL),
(153, 1, 52, 'Pirojpur Sadar', 'পিরোজপুর সদর', 1, NULL, NULL),
(154, 1, 52, 'Nesarabad(Swarupkati)', 'স্বরূপকাঠি', 1, NULL, NULL),
(155, 3, 13, 'Badda', 'বাড্ডা ', 1, NULL, NULL),
(156, 3, 13, 'Biman Bandar Thana', 'বিমান বন্দর থানা', 1, NULL, NULL),
(157, 3, 13, 'Cantonment', 'ক্যান্টনমেন্ট থানা', 1, NULL, NULL),
(158, 3, 13, 'Demra', 'ডেমরা', 1, NULL, NULL),
(159, 3, 13, 'Dhamrai', 'ধামরাই', 1, NULL, NULL),
(160, 3, 13, 'Dhanmondi', 'ধানমন্ডি', 1, NULL, NULL),
(161, 3, 13, 'Dohar', 'দোহার', 1, NULL, NULL),
(162, 3, 13, 'Gulshan', 'গুলশান', 1, NULL, NULL),
(163, 3, 13, 'Hazaribagh', 'হাজারীবাগ ', 1, NULL, NULL),
(164, 3, 13, 'Kafrul', 'কাফরুল', 1, NULL, NULL),
(165, 3, 13, 'Kamrangirchar', 'কামরাঙ্গিরচর', 1, NULL, NULL),
(166, 3, 13, 'Khilgaon', 'খিলগাঁও', 1, NULL, NULL),
(167, 3, 13, 'Keraniganj', 'কেরানীগঞ্জ', 1, NULL, NULL),
(168, 3, 13, 'Kotwali', 'কোতোয়ালী', 1, NULL, NULL),
(169, 3, 13, 'Lalbagh', 'লালবাগ', 1, NULL, NULL),
(170, 3, 13, 'Mirpur', 'মিরপুর ', 1, NULL, NULL),
(171, 3, 13, 'Mohammadpur', 'মোহাম্মদপুর', 1, NULL, NULL),
(172, 3, 13, 'Motijheel', 'মতিঝিল', 1, NULL, NULL),
(173, 3, 13, 'Nawabganj', 'নবাবগঞ্জ', 1, NULL, NULL),
(174, 3, 13, 'Pallabi', 'পল্লবি', 1, NULL, NULL),
(175, 3, 13, 'Ramna', 'রমনা ', 1, NULL, NULL),
(176, 3, 13, 'Sabujbagh', 'সবুজবাগ', 1, NULL, NULL),
(177, 3, 13, 'Savar', 'সাভার ', 1, NULL, NULL),
(178, 3, 13, 'Shyampur', 'শ্যামপুর ', 1, NULL, NULL),
(179, 3, 13, 'Sutrapur', 'সুত্রাপুর', 1, NULL, NULL),
(180, 3, 13, 'Tejgaon', 'তেজগাঁও', 1, NULL, NULL),
(181, 3, 13, 'Uttara', 'উত্তরা', 1, NULL, NULL),
(182, 3, 15, 'Alfadanga', 'আলফাডাঙা', 1, NULL, NULL),
(183, 3, 15, 'Bhanga', 'ভাঙ্গা', 1, NULL, NULL),
(184, 3, 15, 'Boalmari', 'বোয়ালমারী ', 1, NULL, NULL),
(185, 3, 15, 'Charbhadrasan', 'চরভদ্রাসন', 1, NULL, NULL),
(186, 3, 15, 'Faridpur Sadar', 'ফরিদপুর সদর', 1, NULL, NULL),
(187, 3, 15, 'Madhukhali', 'মধুখালী', 1, NULL, NULL),
(188, 3, 15, 'Nagarkanda', 'নগরকান্দা', 1, NULL, NULL),
(189, 3, 15, 'Sadarpur', 'সদরপুর ', 1, NULL, NULL),
(190, 3, 18, 'Gazipur Sadar', 'গাজীপুর সদর', 1, NULL, NULL),
(191, 3, 18, 'Kaliakair', 'কালিয়াকৈর ', 1, NULL, NULL),
(192, 3, 18, 'Kaliganj', 'কালীগঞ্জ ', 1, NULL, NULL),
(193, 3, 18, 'Kapasia', 'কাপাসিয়া ', 1, NULL, NULL),
(194, 3, 18, 'Sreepur', 'শ্রীপুর', 1, NULL, NULL),
(195, 3, 19, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 1, NULL, NULL),
(196, 3, 19, 'Kashiani', 'কাশিয়ানী ', 1, NULL, NULL),
(197, 3, 19, 'Kotalipara', 'কোটালীপাড়া ', 1, NULL, NULL),
(198, 3, 19, 'Muksudpur', 'মুকসুদপুর ', 1, NULL, NULL),
(199, 3, 19, 'Tungipara', 'টুংগীপাড়া', 1, NULL, NULL),
(200, 8, 22, 'Bakshiganj', 'বকশিগঞ্জ', 1, NULL, NULL),
(201, 8, 22, 'Dewanganj', 'দেওয়ানগঞ্জ', 1, NULL, NULL),
(202, 8, 22, 'Islampur', 'ইসলামপুর ', 1, NULL, NULL),
(203, 8, 22, 'Jamalpur Sadar', 'জামালপুর সদর', 1, NULL, NULL),
(204, 8, 22, 'Madarganj', 'মাদারগঞ্জ', 1, NULL, NULL),
(205, 8, 22, 'Melandaha', 'মেলানদহ', 1, NULL, NULL),
(206, 8, 22, 'Sarishabari', 'সরিষাবাড়ী', 1, NULL, NULL),
(207, 3, 28, 'Austagram', 'অষ্টগ্রাম ', 1, NULL, NULL),
(208, 3, 28, 'Bajitpur', 'বাজিতপুর', 1, NULL, NULL),
(209, 3, 28, 'Bhairab', 'ভৈরব ', 1, NULL, NULL),
(210, 3, 28, 'Hossainpur', 'হোসেনপুর ', 1, NULL, NULL),
(211, 3, 28, 'Itna', 'ইটনা ', 1, NULL, NULL),
(212, 3, 28, 'Karimganj', 'করিমগঞ্জ ', 1, NULL, NULL),
(213, 3, 28, 'Katiadi', 'কটিয়াদি', 1, NULL, NULL),
(214, 3, 28, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 1, NULL, NULL),
(215, 3, 28, 'Kuliar Char', 'কুলিয়ারচর ', 1, NULL, NULL),
(216, 3, 28, 'Mithamain', 'মিটামইন', 1, NULL, NULL),
(217, 3, 28, 'Nikli', 'নিকলি', 1, NULL, NULL),
(218, 3, 28, 'Pakundia', 'পাকুন্দিয়া ', 1, NULL, NULL),
(219, 3, 28, 'Tarail', 'তাড়াইল ', 1, NULL, NULL),
(220, 3, 33, 'Kalkini', 'কালকিনি ', 1, NULL, NULL),
(221, 3, 33, 'Madaripur Sadar', 'মাদারীপুর সদর', 1, NULL, NULL),
(222, 3, 33, 'Rajoir', 'রাজৈর', 1, NULL, NULL),
(223, 3, 33, 'Shibchar', 'শিবচর ', 1, NULL, NULL),
(224, 3, 35, 'Daulatpur', 'দৌলতপুর', 1, NULL, NULL),
(225, 3, 35, 'Ghior', 'ঘিওর', 1, NULL, NULL),
(226, 3, 35, 'Harirampur', 'হরিরামপুর', 1, NULL, NULL),
(227, 3, 35, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 1, NULL, NULL),
(228, 3, 35, 'Saturia', 'সাটুরিয়া ', 1, NULL, NULL),
(229, 3, 35, 'Shibalaya', 'শিবালয়', 1, NULL, NULL),
(230, 3, 35, 'Singair', 'সিঙ্গাইর', 1, NULL, NULL),
(231, 3, 38, 'Gazaria', 'গজারিয়া', 1, NULL, NULL),
(232, 3, 38, 'Lohajang', 'লৌহজং', 1, NULL, NULL),
(233, 3, 38, 'Munshiganj Sadar', 'মুন্সীগঞ্জ সদর', 1, NULL, NULL),
(234, 3, 38, 'Serajdikhan', 'সিরাজদিখান', 1, NULL, NULL),
(235, 3, 38, 'Sreenagar', 'শ্রীনগর', 1, NULL, NULL),
(236, 3, 38, 'Tongibari', 'টংগিবাড়ী ', 1, NULL, NULL),
(237, 8, 39, 'Bhaluka', 'ভালুকা', 1, NULL, NULL),
(238, 8, 39, 'Dhobaura', 'ধোবাউড়া ', 1, NULL, NULL),
(239, 8, 39, 'Fulbaria', 'ফুলবাড়ীয়া ', 1, NULL, NULL),
(240, 8, 39, 'Gaffargaon', 'গফরগাঁও', 1, NULL, NULL),
(241, 8, 39, 'Gauripur', 'গৌরীপুর', 1, NULL, NULL),
(242, 8, 39, 'Haluaghat', 'হালুয়াঘাট', 1, NULL, NULL),
(243, 8, 39, 'Ishwarganj', 'ঈশ্বরগঞ্জ', 1, NULL, NULL),
(244, 8, 39, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 1, NULL, NULL),
(245, 8, 39, 'Muktagachha', 'মুক্তাগাছা', 1, NULL, NULL),
(246, 8, 39, 'Nandail', 'নান্দাইল', 1, NULL, NULL),
(247, 8, 39, 'Phulpur', 'ফুলপুর', 1, NULL, NULL),
(248, 8, 39, 'Trishal', 'ত্রিশাল', 1, NULL, NULL),
(249, 3, 41, 'Araihazar', 'আড়াইহাজার', 1, NULL, NULL),
(250, 3, 41, 'Sonargaon', 'সোনারগাঁও', 1, NULL, NULL),
(251, 3, 41, 'Bandar', 'বন্দর', 1, NULL, NULL),
(252, 3, 41, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 1, NULL, NULL),
(253, 3, 41, 'Rupganj', 'রূপগঞ্জ ', 1, NULL, NULL),
(254, 3, 42, 'Belabo', 'বেলাব', 1, NULL, NULL),
(255, 3, 42, 'Manohardi', 'মনোহরদি', 1, NULL, NULL),
(256, 3, 42, 'Narsingdi Sadar', 'নরসিংদি সদর', 1, NULL, NULL),
(257, 3, 42, 'Palash Paurashava', 'পলাশ', 1, NULL, NULL),
(258, 3, 42, 'Raypura', 'রায়পুরা ', 1, NULL, NULL),
(259, 3, 42, 'Shibpur', 'শিবপুর ', 1, NULL, NULL),
(260, 8, 45, 'Atpara', 'আতপাড়া', 1, NULL, NULL),
(261, 8, 45, 'Barhatta', 'বারহাট্টা ', 1, NULL, NULL),
(262, 8, 45, 'Durgapur', 'দূর্গাপুর', 1, NULL, NULL),
(263, 8, 45, 'Khaliajuri', 'খালিয়াজুড়ি', 1, NULL, NULL),
(264, 8, 45, 'Kalmakanda', 'কলমাকান্দা', 1, NULL, NULL),
(265, 8, 45, 'Kendua Thana', 'কেন্দুয়া ', 1, NULL, NULL),
(266, 8, 45, 'Madan', 'মদন', 1, NULL, NULL),
(267, 8, 45, 'Mohanganj Thana', 'মোহনগঞ্জ', 1, NULL, NULL),
(268, 8, 45, 'Netrokona Sadar', 'নেত্রকোনা সদর', 1, NULL, NULL),
(269, 8, 45, 'Purbadhala', 'পূর্বধলা', 1, NULL, NULL),
(270, 3, 53, 'Baliakandi', 'বালিয়াকান্দি', 1, NULL, NULL),
(271, 3, 53, 'Goalanda', 'গোয়ালন্দ', 1, NULL, NULL),
(272, 3, 53, 'Pangsha', 'পাংশা', 1, NULL, NULL),
(273, 3, 53, 'Rajbari Sadar', 'রাজবাড়ী সদর', 1, NULL, NULL),
(274, 8, 58, 'Bhedarganj', 'ভেদরগঞ্জ', 1, NULL, NULL),
(275, 8, 58, 'Damudya', 'ডামুড্যা', 1, NULL, NULL),
(276, 8, 58, 'Gosairhat', 'গোসাইরহাট', 1, NULL, NULL),
(277, 8, 58, 'Naria', 'নড়িয়া', 1, NULL, NULL),
(278, 8, 58, 'Palong', 'পালং', 1, NULL, NULL),
(279, 8, 58, 'Zanjira', 'জাঁজিরা', 1, NULL, NULL),
(280, 3, 63, 'Basail', 'বাসাইল', 1, NULL, NULL),
(281, 3, 63, 'Bhuapur', 'ভূঞাপুর', 1, NULL, NULL),
(282, 3, 63, 'Delduar', 'দেলদুয়ার ', 1, NULL, NULL),
(283, 3, 63, 'Ghatail', 'ঘাটাইল ', 1, NULL, NULL),
(284, 3, 63, 'Gopalpur', 'গোপালপুর ', 1, NULL, NULL),
(285, 3, 63, 'Kalihati', 'কালিহাতি ', 1, NULL, NULL),
(286, 3, 63, 'Madhupur', 'মধুপুর', 1, NULL, NULL),
(287, 3, 63, 'Mirzapur', 'মির্জাপুর', 1, NULL, NULL),
(288, 3, 63, 'Nagarpur', 'নাগরপুর', 1, NULL, NULL),
(289, 3, 63, 'Sakhipur', 'সখিপুর', 1, NULL, NULL),
(290, 3, 63, 'Tangail Sadar', 'টাঙ্গাইল সদর', 1, NULL, NULL),
(291, 4, 1, 'Bagerhat Sadar', 'বাগেরহাট সদর', 1, NULL, NULL),
(292, 4, 1, 'Chitalmari', 'চিতলমারি', 1, NULL, NULL),
(293, 4, 1, 'Fakirhat', 'ফকিরহাট', 1, NULL, NULL),
(294, 4, 1, 'Kachua', 'কচুয়া', 1, NULL, NULL),
(295, 4, 1, 'Mollahat', 'মোল্লাহাট', 1, NULL, NULL),
(296, 4, 1, 'Mongla', 'মোংলা ', 1, NULL, NULL),
(297, 4, 1, 'Morrelganj', 'মোড়লগঞ্জ', 1, NULL, NULL),
(298, 4, 1, 'Rampal', 'রামপাল', 1, NULL, NULL),
(299, 4, 1, 'Sarankhola', 'শরণখোলা', 1, NULL, NULL),
(300, 4, 10, 'Alamdanga', 'আলমডাঙ্গা', 1, NULL, NULL),
(301, 4, 10, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর ', 1, NULL, NULL),
(302, 4, 10, 'Damurhuda', 'দামুড়হুদা ', 1, NULL, NULL),
(303, 4, 10, 'Jibannagar', 'জীবননগর ', 1, NULL, NULL),
(304, 4, 23, 'Abhaynagar', 'অভয়নগর ', 1, NULL, NULL),
(305, 4, 23, 'Bagherpara', 'বাঘারপাড়া', 1, NULL, NULL),
(306, 4, 23, 'Chaugachha', 'চৌগাছা', 1, NULL, NULL),
(307, 4, 23, 'Jhikargachha', 'ঝিকরগাছা', 1, NULL, NULL),
(308, 4, 23, 'Keshabpur', 'কেশবপুর', 1, NULL, NULL),
(309, 4, 23, 'Kotwali', 'কোতোয়ালী', 1, NULL, NULL),
(310, 4, 23, 'Manirampur', 'মণিরামপুর', 1, NULL, NULL),
(311, 4, 23, 'Sharsha', 'শার্শা', 1, NULL, NULL),
(312, 4, 25, 'Harinakunda', 'হরিণাকুন্ডু', 1, NULL, NULL),
(313, 4, 25, 'Jhenaidaha Sadar', 'ঝিনাইদহ সদর', 1, NULL, NULL),
(314, 4, 25, 'Kaliganj', 'কালীগঞ্জ', 1, NULL, NULL),
(315, 4, 25, 'Kotchandpur', 'কোটচাঁদপুর', 1, NULL, NULL),
(316, 4, 25, 'Maheshpur', 'মহেশপুর', 1, NULL, NULL),
(317, 4, 25, 'Shailkupa', 'শৈলকুপা', 1, NULL, NULL),
(318, 4, 27, 'Batiaghata', 'বটিয়াঘাটা', 1, NULL, NULL),
(319, 4, 27, 'Dacope', 'দাকোপ', 1, NULL, NULL),
(320, 4, 27, 'Daulatpur', 'দৌলতপুর', 1, NULL, NULL),
(321, 4, 27, 'Dumuria', 'ডুমুরিয়া', 1, NULL, NULL),
(322, 4, 27, 'Dighalia', 'দিঘলিয়া', 1, NULL, NULL),
(323, 4, 27, 'Khalishpur', 'খালিশপুর', 1, NULL, NULL),
(324, 4, 27, 'Khanjahan Ali', 'খানজাহান আলী', 1, NULL, NULL),
(325, 4, 27, 'Khulna Sadar', 'খুলনা সদর', 1, NULL, NULL),
(326, 4, 27, 'Koyra', 'কয়রা', 1, NULL, NULL),
(327, 4, 27, 'Paikgachha', 'পাইকগাছা', 1, NULL, NULL),
(328, 4, 27, 'Phultala', 'ফুলতলা', 1, NULL, NULL),
(329, 4, 27, 'Rupsa', 'রূপসা', 1, NULL, NULL),
(330, 4, 27, 'Sonadanga', 'সোনাডাঙ্গা', 1, NULL, NULL),
(331, 4, 27, 'Terokhada', 'তেরখাদা', 1, NULL, NULL),
(332, 4, 30, 'Bheramara', 'ভেড়ামারা', 1, NULL, NULL),
(333, 4, 30, 'Daulatpur', 'দৌলতপুর ', 1, NULL, NULL),
(334, 4, 30, 'Khoksa', 'খোকশা', 1, NULL, NULL),
(335, 4, 30, 'Kumarkhali', 'কুমারখালি', 1, NULL, NULL),
(336, 4, 30, 'Kushtia Sadar', 'কুষ্ঠিয়া সদর', 1, NULL, NULL),
(337, 4, 30, 'Mirpur', 'মিরপুর ', 1, NULL, NULL),
(338, 4, 34, 'Magura Sadar', 'মাগুরা সদর', 1, NULL, NULL),
(339, 4, 34, 'Mohammadpur', 'মোহাম্মদপুর', 1, NULL, NULL),
(340, 4, 34, 'Shalikha', 'শালিখা ', 1, NULL, NULL),
(341, 4, 34, 'Sreepur', 'শ্রীপুর', 1, NULL, NULL),
(342, 4, 36, 'Gangni', 'গাংনি', 1, NULL, NULL),
(343, 4, 36, 'Mujibnagar', 'মুজিবনগর ', 1, NULL, NULL),
(344, 4, 36, 'Meherpur Sadar', 'মেহেরপুর সদর', 1, NULL, NULL),
(345, 4, 48, 'Kalia', 'কালিয়া', 1, NULL, NULL),
(346, 4, 48, 'Lohagara', 'লোহাগড়া', 1, NULL, NULL),
(347, 4, 48, 'Narail Sadar', 'নড়াইল সদর', 1, NULL, NULL),
(348, 4, 57, 'Assasuni', 'আশাশুনি', 1, NULL, NULL),
(349, 4, 57, 'Debhata', 'দেবহাটা', 1, NULL, NULL),
(350, 4, 57, 'Kalaroa', 'কলারোয়া', 1, NULL, NULL),
(351, 4, 57, 'Kaliganj', 'কালীগঞ্জ ', 1, NULL, NULL),
(352, 4, 57, 'Satkhira Sadar', 'সাতক্ষীরা সদর ', 1, NULL, NULL),
(353, 4, 57, 'Shyamnagar', 'শ্যামনগর ', 1, NULL, NULL),
(354, 4, 57, 'Tala', 'তালা', 1, NULL, NULL),
(355, 7, 20, 'Ajmiriganj', 'আজমিরিগঞ্জ', 1, NULL, NULL),
(356, 7, 20, 'Bahubal', 'বাহুবল', 1, NULL, NULL),
(357, 7, 20, 'Baniachong', 'বানিয়াচং', 1, NULL, NULL),
(358, 7, 20, 'Chunarughat', 'চুনারুঘাট', 1, NULL, NULL),
(359, 7, 20, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 1, NULL, NULL),
(360, 7, 20, 'Lakhai', 'লাখাই', 1, NULL, NULL),
(361, 7, 37, 'Barlekha', 'বড়লেখা', 1, NULL, NULL),
(362, 7, 37, 'Kamalganj', 'কমলগঞ্জ', 1, NULL, NULL),
(363, 5, 37, 'Kulaura', 'কুলাউড়া', 1, NULL, NULL),
(364, 5, 37, 'Maulvibazar Sadar', 'মৌলভীবাজার সদর', 1, NULL, NULL),
(365, 5, 37, 'Rajnagar', 'রাজনগর', 1, NULL, NULL),
(366, 5, 37, 'Sreemangal', 'শ্রীমঙ্গল', 1, NULL, NULL),
(367, 7, 61, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 1, NULL, NULL),
(368, 7, 61, 'Chhatak', 'ছাতক', 1, NULL, NULL),
(369, 7, 61, 'Derai', 'দিরাই', 1, NULL, NULL),
(370, 7, 61, 'Dharampasha', 'ধরমপাশা', 1, NULL, NULL),
(371, 7, 61, 'Dowarabazar', 'দোয়ারাবাজার', 1, NULL, NULL),
(372, 7, 61, 'Jagannathpur', 'জগন্নাথপুর', 1, NULL, NULL),
(373, 7, 61, 'Jamalganj', 'জামালগঞ্জ', 1, NULL, NULL),
(374, 7, 61, 'Sulla', 'শাল্লা', 1, NULL, NULL),
(375, 7, 61, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 1, NULL, NULL),
(376, 7, 61, 'Tahirpur', 'তাহিরপুর', 1, NULL, NULL),
(377, 7, 62, 'Balaganj', 'বালাগঞ্জ', 1, NULL, NULL),
(378, 7, 62, 'Beanibazar', 'বিয়ানিবাজার', 1, NULL, NULL),
(379, 7, 62, 'Bishwanath', 'বিশ্বনাথ', 1, NULL, NULL),
(380, 7, 62, 'Companiganj', 'কোম্পানিগঞ্জ', 1, NULL, NULL),
(381, 7, 62, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 1, NULL, NULL),
(382, 7, 62, 'Golabganj', 'গোলাপগঞ্জ', 1, NULL, NULL),
(383, 7, 62, 'Gowainghat', 'গোয়াইনঘাট', 1, NULL, NULL),
(384, 7, 62, 'Jaintiapur', 'জৈন্তাপুর', 1, NULL, NULL),
(385, 7, 62, 'Kanaighat', 'কানাইঘাট', 1, NULL, NULL),
(386, 7, 62, 'Sylhet Sadar', 'সিলেট সদর', 1, NULL, NULL),
(387, 7, 62, 'Zakiganj', 'জকিগঞ্জ ', 1, NULL, NULL),
(388, 5, 7, 'Adamdighi', 'আদমদিঘী ', 1, NULL, NULL),
(389, 5, 7, 'Bogra Sadar', 'বগুড়া সদর', 1, NULL, NULL),
(390, 5, 7, 'Dhunat', 'ধুনট ', 1, NULL, NULL),
(391, 5, 7, 'Dhupchanchia', 'দুপচাঁচিয়া ', 1, NULL, NULL),
(392, 5, 7, 'Gabtali', 'গাবতলী ', 1, NULL, NULL),
(393, 5, 7, 'Kahaloo', 'কাহালু ', 1, NULL, NULL),
(394, 5, 7, 'Nandigram', 'নন্দীগ্রাম ', 1, NULL, NULL),
(395, 5, 7, 'Sariakandi', 'সারিয়াকান্দি ', 1, NULL, NULL),
(396, 5, 7, 'Sherpur', 'শেরপুর ', 1, NULL, NULL),
(397, 5, 7, 'Shibganj', 'শিবগঞ্জ ', 1, NULL, NULL),
(398, 5, 7, 'Sonatola', 'সোনাতলা ', 1, NULL, NULL),
(399, 5, 21, 'Akkelpur', 'আক্কেলপুর', 1, NULL, NULL),
(400, 5, 21, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 1, NULL, NULL),
(401, 5, 21, 'Kalai', 'কালাই', 1, NULL, NULL),
(402, 5, 21, 'Khetlal', 'ক্ষেতলাল', 1, NULL, NULL),
(403, 5, 21, 'Panchbibi', 'পাঁচবিবি', 1, NULL, NULL),
(404, 5, 40, 'Atrai', 'আত্রাই', 1, NULL, NULL),
(405, 5, 40, 'Badalgachhi', 'বদলগাছি', 1, NULL, NULL),
(406, 5, 40, 'Dhamoirhat', 'ধামইরহাট', 1, NULL, NULL),
(407, 5, 40, 'Manda', 'মান্দা', 1, NULL, NULL),
(408, 5, 40, 'Mahadebpur', 'মহাদেবপুর', 1, NULL, NULL),
(409, 5, 40, 'Naogaon Sadar', 'নওগাঁ সদর', 1, NULL, NULL),
(410, 5, 40, 'Niamatpur', 'নিয়ামতপুর', 1, NULL, NULL),
(411, 5, 40, 'Patnitala', 'পত্নীতলা', 1, NULL, NULL),
(412, 5, 40, 'Porsha', 'পোরশা', 1, NULL, NULL),
(413, 5, 40, 'Raninagar', 'রাণীনগর', 1, NULL, NULL),
(414, 5, 40, 'Sapahar', 'সাপাহার', 1, NULL, NULL),
(415, 5, 43, 'Bagatipara', 'বাগাতিপাড়া', 1, NULL, NULL),
(416, 5, 43, 'Baraigram', 'বরাইগ্রাম ', 1, NULL, NULL),
(417, 5, 43, 'Gurudaspur', 'গুরুদাসপুর', 1, NULL, NULL),
(418, 5, 43, 'Lalpur', 'লালপুর', 1, NULL, NULL),
(419, 5, 43, 'Natore Sadar', 'নাটোর সদর', 1, NULL, NULL),
(420, 5, 43, 'Singra', 'সিংড়া', 1, NULL, NULL),
(421, 5, 44, 'Bholahat', 'ভোলাহাট', 1, NULL, NULL),
(422, 5, 44, 'Gomastapur', 'গোমস্তাপুর', 1, NULL, NULL),
(423, 5, 44, 'Nachole', 'নাচোল', 1, NULL, NULL),
(424, 5, 44, 'Nawabganj Sadar', 'নবাবগঞ্জ সদর', 1, NULL, NULL),
(425, 5, 44, 'Shibganj', 'শিবগঞ্জ ', 1, NULL, NULL),
(426, 5, 49, 'Atgharia', 'আটঘোরিয়া ', 1, NULL, NULL),
(427, 5, 49, 'Bera', 'বেড়া', 1, NULL, NULL),
(428, 5, 49, 'Bhangura', 'ভাঙ্গুড়া', 1, NULL, NULL),
(429, 5, 49, 'Chatmohar', 'চাটমোহর', 1, NULL, NULL),
(430, 5, 49, 'Faridpur', 'ফরিদপুর', 1, NULL, NULL),
(431, 5, 49, 'Ishwardi', 'ঈশ্বরদী', 1, NULL, NULL),
(432, 5, 49, 'Pabna Sadar', 'পাবনা সদর', 1, NULL, NULL),
(433, 5, 49, 'Santhia', 'সাঁথিয়া', 1, NULL, NULL),
(434, 5, 49, 'Sujanagar', 'সুজানগর', 1, NULL, NULL),
(435, 5, 54, 'Bagha', 'বাঘা', 1, NULL, NULL),
(436, 5, 54, 'Baghmara', 'বাগমারা', 1, NULL, NULL),
(437, 5, 54, 'Boalia', 'বোয়ালিয়া', 1, NULL, NULL),
(438, 5, 54, 'Charghat', 'চারঘাট', 1, NULL, NULL),
(439, 5, 54, 'Durgapur', 'দূর্গাপুর', 1, NULL, NULL),
(440, 5, 54, 'Godagari', 'গোদাগাড়ি', 1, NULL, NULL),
(441, 5, 54, 'Matihar', 'মতিহার ', 1, NULL, NULL),
(442, 5, 54, 'Mohanpur', 'মোহনপুর', 1, NULL, NULL),
(443, 5, 54, 'Paba', 'পবা', 1, NULL, NULL),
(444, 5, 54, 'Puthia', 'পুঠিয়া', 1, NULL, NULL),
(445, 5, 54, 'Rajpara', 'রাজপারা', 1, NULL, NULL),
(447, 5, 54, 'Tanore', 'তানোর', 1, NULL, NULL),
(448, 5, 60, 'Belkuchi', 'বেলকুচি', 1, NULL, NULL),
(449, 5, 60, 'Chauhali', 'চৌহালি', 1, NULL, NULL),
(450, 5, 60, 'Kamarkhanda', 'কামারখন্দ', 1, NULL, NULL),
(451, 5, 60, 'Kazipur', 'কাজীপুর', 1, NULL, NULL),
(452, 5, 60, 'Royganj', 'রায়গঞ্জ', 1, NULL, NULL),
(453, 5, 60, 'Shahjadpur', 'শাহজাদপুর', 1, NULL, NULL),
(454, 5, 60, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 1, NULL, NULL),
(455, 5, 60, 'Tarash', 'তাড়াশ', 1, NULL, NULL),
(456, 5, 60, 'Ullah Para', 'উল্লাপাড়া', 1, NULL, NULL),
(457, 6, 14, 'Birampur', 'বিরামপুর', 1, NULL, NULL),
(458, 6, 14, 'Birganj', 'বীরগঞ্জ', 1, NULL, NULL),
(459, 6, 14, 'Biral', 'বিরল', 1, NULL, NULL),
(460, 6, 14, 'Bochaganj', 'বোচাগঞ্জ', 1, NULL, NULL),
(461, 6, 14, 'Chirirbandar', 'চিরিরবন্দর', 1, NULL, NULL),
(462, 6, 14, 'Fulbari', 'ফুলবাড়ী', 1, NULL, NULL),
(463, 6, 14, 'Ghoraghat', 'ঘোড়াঘাট', 1, NULL, NULL),
(464, 6, 14, 'Hakimpur', 'হাকিমপুর', 1, NULL, NULL),
(465, 6, 14, 'Kaharole', 'কাহারোল', 1, NULL, NULL),
(466, 6, 14, 'Khansama', 'খানসামা', 1, NULL, NULL),
(467, 6, 14, 'Dinajpur Sadar', 'দিনাজপুর সদর', 1, NULL, NULL),
(468, 6, 14, 'Nawabganj', 'নবাবগঞ্জ', 1, NULL, NULL),
(469, 6, 14, 'Parbatipur', 'পার্বতীপুর ', 1, NULL, NULL),
(470, 6, 17, 'Fulchhari', 'ফুলছড়ি', 1, NULL, NULL),
(471, 6, 17, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 1, NULL, NULL),
(472, 6, 17, 'Gobindaganj', 'গোবিন্দগঞ্জ', 1, NULL, NULL),
(473, 6, 17, 'Palashbari', 'পলাশবাড়ী', 1, NULL, NULL),
(474, 6, 17, 'Sadullapur', 'সাদুল্লাপুর', 1, NULL, NULL),
(475, 6, 17, 'Saghatta', 'সাঘাটা', 1, NULL, NULL),
(476, 6, 17, 'Sundarganj', 'সুন্দরগঞ্জ', 1, NULL, NULL),
(477, 6, 29, 'Bhurungamari', 'ভুরুঙ্গামারি', 1, NULL, NULL),
(478, 6, 29, 'Char Rajibpur', 'চর রাজিবপুর', 1, NULL, NULL),
(479, 6, 29, 'Chilmari', 'চিলমারী', 1, NULL, NULL),
(480, 6, 29, 'Phulbari', 'ফুলবাড়ী', 1, NULL, NULL),
(481, 6, 29, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 1, NULL, NULL),
(482, 6, 29, 'Nageshwari', 'নাগেশ্বরী', 1, NULL, NULL),
(483, 6, 29, 'Rajarhat', 'রাজারহাট', 1, NULL, NULL),
(484, 6, 29, 'Raumari', 'রৌমারী', 1, NULL, NULL),
(485, 6, 29, 'Ulipur', 'উলিপুর', 1, NULL, NULL),
(486, 6, 32, 'Aditmari', 'আদিতমারী ', 1, NULL, NULL),
(487, 6, 32, 'Hatibandha', 'হাতিবান্ধা', 1, NULL, NULL),
(488, 6, 32, 'Kaliganj', 'কালীগঞ্জ ', 1, NULL, NULL),
(489, 6, 32, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 1, NULL, NULL),
(490, 6, 32, 'Patgram', 'পাটগ্রাম', 1, NULL, NULL),
(491, 6, 46, 'Dimla', 'ডিমলা', 1, NULL, NULL),
(492, 6, 46, 'Domar', 'ডোমার', 1, NULL, NULL),
(493, 6, 46, 'Jaldhaka', 'জলঢাকা', 1, NULL, NULL),
(494, 6, 46, 'Kishoreganj', 'কিশোরগঞ্জ', 1, NULL, NULL),
(495, 6, 46, 'Nilphamari Sadar', 'নীফামারী সদর', 1, NULL, NULL),
(496, 6, 46, 'Saidpur', 'সৈয়দপুর', 1, NULL, NULL),
(497, 6, 50, 'Atwari', 'অটওয়ারী', 1, NULL, NULL),
(498, 6, 50, 'Boda', 'বোদা', 1, NULL, NULL),
(499, 6, 50, 'Debiganj', 'দেবীগঞ্জ', 1, NULL, NULL),
(500, 6, 50, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 1, NULL, NULL),
(501, 6, 50, 'Tentulia', 'তেতুলিয়া', 1, NULL, NULL),
(502, 6, 56, 'Badarganj', 'বদরগঞ্জ', 1, NULL, NULL),
(503, 6, 56, 'Gangachara', 'গঙ্গাছড়া', 1, NULL, NULL),
(504, 6, 56, 'Kaunia', 'কাউনিয়া', 1, NULL, NULL),
(505, 6, 56, 'Rangpur Sadar', 'রংপুর সদর', 1, NULL, NULL),
(506, 6, 56, 'Mitha Pukur', 'মিঠাপুকুর', 1, NULL, NULL),
(507, 6, 56, 'Pirgachha', 'পীরগাছা', 1, NULL, NULL),
(508, 6, 56, 'Pirganj', 'পীরগঞ্জ', 1, NULL, NULL),
(509, 6, 56, 'Taraganj', 'তারাগঞ্জ', 1, NULL, NULL),
(510, 6, 64, 'Baliadangi', 'বালিয়াডাঙ্গী', 1, NULL, NULL),
(511, 6, 64, 'Haripur', 'হরিপুর', 1, NULL, NULL),
(512, 6, 64, 'Pirganj', 'পীরগঞ্জ ', 1, NULL, NULL),
(513, 6, 64, 'Ranisankail', 'রাণীশংকৈল', 1, NULL, NULL),
(514, 6, 64, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `isSuper` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'school_super_admin',
  `school_id` int(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `student_code` int(11) DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=Male;2=Female;3=Others',
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pic_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `verified` tinyint(4) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `assign_school` bigint(20) DEFAULT NULL COMMENT 'school_id',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `role_title`, `active`, `isSuper`, `school_id`, `code`, `student_code`, `gender`, `blood_group`, `nationality`, `phone_number`, `address`, `about`, `pic_path`, `verified`, `email_verified_at`, `section_id`, `assign_school`, `remember_token`, `created_at`, `updated_at`, `department_id`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(1, 'Master', 'foqas@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'master', 'Super Admin', 1, '0', 1, NULL, 0, '1', '1', '', '', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, NULL, NULL, NULL, NULL, '2020-11-15 12:21:24', 0, NULL, NULL, NULL, NULL),
(12, 'Admin', 'admin@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'admin', 'Admin', 1, '1', 1, 20165757, 3065625, '1', '1', '', '01780597143', '2612 Cummings Station Suite 410Port Damaris, DE 63298-9171', 'Dolorem incidunt labore voluptas ullam doloremque quia. Dolorum labore numquam ut sunt dolore. Voluptates aut quaerat et placeat reprehenderit voluptatem voluptate.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, 8, NULL, 'opyJxxRUCLFJUqtN8A3SL592FQ2qASZwLTHY9ABNZco4Qc3nPiA7vJP2HdYv', '2020-10-28 06:23:25', '2021-03-28 07:15:14', 10, NULL, NULL, NULL, NULL),
(13, 'Dr. Kristoffer Jakubowski', 'accountant@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'accountant', NULL, 1, '0', 1, 20165757, 4965410, '1', '1', 'Bangladeshi', '34234234234', '937 Welch Forks Suite 132\nLake Amos, WY 53915-8322', 'Dignissimos odit natus optio. Ullam ea nobis doloremque corporis dolore sit asperiores. Et earum animi cumque quas voluptatem asperiores.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, 4, NULL, '4u5bDcNJSGVBanXbHCEFqzM1WFXNJcltrJd9qXdypk6ZQ61CjlPpKmjs5zhk', '2020-10-28 06:23:25', '2020-10-28 06:23:25', 5, NULL, NULL, NULL, NULL),
(14, 'Thad Hammes', 'fahey.derrick@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 1, '0', 1, 20165757, 2827670, '2', '1', 'Bangladeshi', '634-241-1350', '4109 Stanford Harbor Apt. 750\nPort Georgiana, IN 55103', 'Harum atque qui consequatur voluptatem. Unde natus quisquam magnam enim. Est at est consectetur iste.', 'https://lorempixel.com/640/480/?16011', 1, NULL, 2, NULL, 'ZboOsI0ivHfLZAFfS1gkzwQNXwB8rQIzrKAwOtimEu23SacixCmVlyEQnPLO', '2020-10-28 06:23:25', '2020-10-28 06:23:25', 7, NULL, NULL, NULL, NULL),
(15, 'Prof. Mckenna Schneider', 'accountant1@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'accountant', NULL, 1, '0', 1, 20165757, 1684495, '1', '1', 'United States', '263.883.5874 x373', '9046 Wyman Green Apt. 777\r\nNasirhaven, MD 99670-5052', 'Ducimus impedit molestiae quibusdam consectetur aperiam. Vero earum occaecati cumque quod nesciunt explicabo. Ut et rerum doloremque commodi.', 'https://lorempixel.com/640/480/?59406', 1, NULL, 9, NULL, 'UITXW9SJ4sYcgCL7qhOmyHXLYMbTHzYrVm1nNVlOu37NHctqEefDaTPv0uuL', '2020-10-28 06:23:25', '2021-02-22 10:40:23', 6, NULL, NULL, NULL, NULL),
(16, 'Clifton Kautzer', 'zboncak.skylar@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 0, '0', 1, 20165757, 7213215, '1', '1', 'Bangladeshi', '1-636-304-9946 x0481', '8334 Delpha Freeway\nMillsburgh, NV 44331', 'Iusto omnis fuga corrupti nam laboriosam. Aperiam ut qui sint eius qui id rerum. Adipisci exercitationem dignissimos maiores pariatur provident ipsam.', 'https://lorempixel.com/640/480/?60504', 1, NULL, 19, NULL, 'Jmza78Ee7f', '2020-10-28 06:23:26', '2020-12-09 11:29:31', 10, NULL, NULL, NULL, NULL),
(17, 'Prof. Deon Langosh DDS', 'kward@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 1, '0', 1, 20165757, 6874785, '1', '1', 'Bangladeshi', '1-521-901-6455', '1205 Krystel Circles\nRatkefort, WV 32527', 'Eos enim dolores qui veniam doloremque at et. Quas quam dolorem autem aut aut laborum sint. Id ut sit iusto.', 'https://lorempixel.com/640/480/?59769', 1, NULL, 20, NULL, '6XbJQp2m0h', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 2, NULL, NULL, NULL, NULL),
(18, 'Guillermo Wiza Sr.', 'jonathon.mann@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 1, '0', 1, 20165757, 4301911, '2', '1', 'Bangladeshi', '834.852.3535 x1587', '37217 Harris Lake Apt. 353\nDustintown, CO 23324', 'Praesentium pariatur excepturi tenetur et magni. Iure at placeat at sed. Quae voluptatum hic sint aut.', 'https://lorempixel.com/640/480/?43609', 1, NULL, 5, NULL, 'aLsOcRrhx2', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 5, NULL, NULL, NULL, NULL),
(19, 'Marguerite Turner', 'sigmund25@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 0, '0', 1, 20165757, 8018338, '1', '1', 'Bangladeshi', '+14383059445', '50714 Ruben Road\nGorczanyshire, CA 66996', 'Sit perferendis quis accusamus neque quia. Animi officiis non qui illo velit. Ea qui molestias doloribus id alias.', 'https://lorempixel.com/640/480/?94909', 1, NULL, 12, NULL, 'koYLoEfoIH', '2020-10-28 06:23:26', '2020-12-09 11:29:49', 3, NULL, NULL, NULL, NULL),
(20, 'Mac Kemmer', 'warren.little@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 1, '0', 1, 20165757, 4738282, '2', '1', 'Bangladeshi', '(445) 586-8735 x698', '55626 Nader Stravenue Suite 019\nDockchester, UT 04247', 'Non molestiae nesciunt in et sit hic hic. Eaque sit beatae voluptate eum nesciunt eum voluptatum pariatur. Quo voluptatibus magni a est dolores nostrum enim.', '', 1, NULL, 7, NULL, 'u8PspBfNDP', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 5, NULL, NULL, NULL, NULL),
(21, 'Ramiro Goldner', 'wiza.malvina@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'accountant', NULL, 1, '0', 1, 20165757, 9337594, '1', '1', 'Bangladeshi', '1-674-729-0666 x577', '43346 Walker Junction Apt. 076\nWest Nyasiafort, AZ 16727', 'Culpa consequatur alias nihil possimus sunt qui qui sed. Voluptas consequuntur et est qui doloremque. Dolorum omnis sapiente occaecati aut voluptate id.', '', 1, NULL, 17, NULL, '75tf0Ps4ZP', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 5, NULL, NULL, NULL, NULL),
(22, 'Mellie Wunsch I', 'librarian@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'librarian', NULL, 0, '0', 1, 20165757, 8396042, '1', '1', 'Bangladeshi', '752-410-4076 x5770', '69292 Kutch Greens Apt. 669\nEast Anyafurt, MD 84259-5439', 'Fugiat dolores adipisci minima est suscipit. Et nam facilis perspiciatis illo et recusandae natus. Minima nobis voluptas labore animi voluptatem ipsa et rem.', 'https://lorempixel.com/640/480/?74965', 1, NULL, 14, NULL, 'Abol7zFoXT', '2020-10-28 06:23:26', '2020-12-09 11:29:55', 4, NULL, NULL, NULL, NULL),
(23, 'Chadd Renner', 'tessie47@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 0, '0', 1, 20165757, 5305731, '2', '1', 'Bangladeshi', '950-375-6950 x9114', '48711 Fern Vista Apt. 069\nWest Britney, OR 92320', 'Laboriosam et officiis facilis nam nostrum vitae. Laborum omnis nihil suscipit adipisci veritatis inventore. Non qui assumenda molestiae sunt placeat occaecati porro.', 'https://lorempixel.com/640/480/?44132', 1, NULL, 3, NULL, '2hDXMERbcm', '2020-10-28 06:23:26', '2021-02-22 10:39:57', 4, NULL, NULL, NULL, NULL),
(24, 'Cheyenne Glover', 'meda.kub@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 2, '0', 1, 20165757, 8372964, '1', '1', 'Bangladeshi', '308.471.6992 x250', '5585 Littel Meadow\nPagacfort, AL 98397-3634', 'Sed architecto maxime soluta sit culpa. Ut maxime non a aut et distinctio nihil possimus. Perspiciatis aut temporibus est nihil quo deleniti.', 'https://lorempixel.com/640/480/?24696', 1, NULL, 15, NULL, 'lq30ey0MQr', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 4, NULL, NULL, NULL, NULL),
(25, 'Effie Jast V', 'liana62@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 4546367, '2', '1', 'Bangladeshi', '916.891.7726 x7351', '130 Beer Via Suite 536\nMonserratton, NH 12981-2774', 'Impedit dolorum delectus voluptatem deserunt quia. Debitis eum saepe dolor omnis. Consequuntur debitis ipsum similique reiciendis.', 'https://lorempixel.com/640/480/?56597', 1, NULL, 2, NULL, 'fAWrV70Pcg', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 4, NULL, NULL, NULL, NULL),
(26, 'Prof. June Fahey', 'dimitri42@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 3164043, '2', '1', 'Bangladeshi', '338-868-8879 x30790', '13566 Waelchi Grove Apt. 484\nJerdeshire, NH 78442', 'Et nihil commodi quaerat dolor quod. Repellat quia voluptas hic exercitationem. Placeat atque perspiciatis impedit voluptatem voluptas.', 'https://lorempixel.com/640/480/?58552', 1, NULL, 8, NULL, '436DWbUIiT', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 3, NULL, NULL, NULL, NULL),
(27, 'Michelle Schaefer', 'durgan.adela@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 5244525, '2', '1', 'Bangladeshi', '(342) 906-7646 x10614', '68633 Bins Tunnel Apt. 413\nConroystad, AK 18775', 'Voluptatem ut autem optio culpa. Quos non commodi impedit deleniti non et. Nostrum et corrupti consequuntur quia sed voluptatem rem.', 'https://lorempixel.com/640/480/?25595', 1, NULL, 8, NULL, 'RkGCbgiqnR', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 1, NULL, NULL, NULL, NULL),
(28, 'Sabrina Mante III', 'mertz.eudora@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 8568340, '1', '1', 'Bangladeshi', '1-298-764-5969 x734', '32894 Caroline Common\nSchneiderberg, MI 38356', 'Cum corporis doloribus dignissimos ut minima nam libero. Tenetur repudiandae dicta similique sequi. Molestias voluptatibus dolorum nisi consequatur.', 'https://lorempixel.com/640/480/?24429', 1, NULL, 8, NULL, 'GhTZhOGIP6', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 5, NULL, NULL, NULL, NULL),
(29, 'Mike Kassulke', 'swaniawski.jordane@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 0, '0', 1, 20165757, 6301409, '1', '1', 'Bangladeshi', '+1-506-231-2047', '99240 Onie Well\nSouth Budview, MT 58640-0644', 'Et sed expedita quia et laborum aliquam. Ad sed dolorem itaque blanditiis mollitia. Nihil nulla corporis provident culpa praesentium ducimus.', 'https://lorempixel.com/640/480/?22978', 1, NULL, 8, NULL, 'tdY0eUILVe', '2020-10-28 06:23:26', '2020-12-09 11:30:00', 5, NULL, NULL, NULL, NULL),
(30, 'Simone Stoltenberg', 'susanna.cassin@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 1758673, '1', '1', 'Bangladeshi', '+1-372-684-8448', '7170 Keenan Heights Apt. 145\nPort Liliane, CO 61445-3863', 'Officiis quia sed pariatur deleniti hic rerum culpa. Ipsum et quas aliquam quisquam eum quasi aut debitis. Laborum cupiditate aut quis voluptas voluptas iste.', 'https://lorempixel.com/640/480/?35331', 1, NULL, 15, NULL, 'Stu82VclKr', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 5, NULL, NULL, NULL, NULL),
(31, 'Juanita Predovic', 'justen54@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'librarian', NULL, 1, '0', 1, 20165757, 4947934, '1', '1', 'Bangladeshi', '729.416.2833', '1848 Tomas Parks Suite 515\nPort Kiannaland, AZ 76995-6240', 'Quis maxime ut perferendis harum soluta officiis. Ut porro eligendi repellendus. Est aut reiciendis occaecati.', 'https://lorempixel.com/640/480/?57483', 1, NULL, 14, NULL, 'G9YJaaezu5', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 10, NULL, NULL, NULL, NULL),
(32, 'Mr. Ignacio Hill II', 'teacher@demo.com', '$2y$10$ECUfzLPXSmNHa7oToC9BUuIfEZUEtnqdpD05c1xWN4eFTEVP.DlU6', 'teacher', 'Teacher', 1, '0', 1, 20165757, 8151824, '1', '1', 'Bangladeshi', '+17465209071', '6447 Valentina Stravenue Suite 327\nLake Dale, IA 56075', 'Fugiat nobis consequatur inventore reiciendis. Voluptate amet quo reiciendis iure tempore voluptatem autem. Dolorum iure dolores voluptas molestiae non.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 7, NULL, 'tcH3IaK2kYEnYLAbORg1sfCMvOjblYoO0618mM5jSSRYB6y2ZBxPrDiRPdHg', '2020-10-28 06:23:26', '2021-01-17 09:38:56', 9, NULL, NULL, NULL, NULL),
(33, 'Larry Fahey', 'marilie.wuckert@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 9493797, '1', '1', 'Bangladeshi', '+1.646.445.3843', '61415 Clarabelle Mountains Apt. 706\nNew Daphney, MD 57497-4577', 'Possimus sed voluptas totam non dolores ea aut. Accusamus reprehenderit exercitationem ullam expedita. Quis ratione aliquam sit dolorem.', '', 1, NULL, 2, NULL, 'vS1rozqtVj', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 2, NULL, NULL, NULL, NULL),
(34, 'Alexandrine Hermann', 'natalie72@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 8242747, '2', '1', 'Bangladeshi', '+19066928060', '7363 Kade Fall Suite 299\nDemondbury, NV 76869-8696', 'Sed ipsam aut sed adipisci. Numquam non quia qui repellat. Consequuntur qui veniam adipisci quas non dolore et.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, 6, NULL, 'zxmGiCDnTh', '2020-10-28 06:23:26', '2021-01-05 07:19:04', 5, NULL, NULL, NULL, NULL),
(35, 'Alfred Barrows', 'mills.loraine@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 263886, '1', '1', 'Bangladeshi', '1-802-791-3880 x232', '50183 Heathcote Unions\nWest Marques, AK 24217', 'Minus voluptatem corporis delectus dignissimos numquam voluptatibus quia. Quidem est doloribus amet. Facere velit commodi at est dolores qui dolorem.', '', 1, NULL, 8, NULL, 'jmyXDsvcUE', '2020-10-28 06:23:26', '2020-12-22 11:54:49', 3, NULL, NULL, NULL, NULL),
(36, 'Winifred Quigley III', 'kreiger.zackery@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 8570354, '2', '1', 'Bangladeshi', '982.650.1155', '1910 Belle Island Suite 224\nTrantowborough, MO 67895-9734', 'Nostrum quidem officiis est eum omnis. Est mollitia a neque ullam magni magnam. Et eligendi praesentium placeat est.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 13, NULL, 'd3NwpVOiEp', '2020-10-28 06:23:26', '2021-01-16 04:36:08', 9, NULL, NULL, NULL, NULL),
(37, 'Paris Veum', 'willa29@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 9506699, '2', '1', 'Bangladeshi', '567-310-7228 x91881', '820 Devonte Plains\nNorth Havenhaven, IN 29109', 'Velit enim cumque quis accusamus. Et voluptas et voluptate ea iste. Quas dicta deserunt sit aut voluptas.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 10, NULL, '0Eg4QcGGDQ', '2020-10-28 06:23:26', '2020-12-09 09:26:21', 5, NULL, NULL, NULL, NULL),
(38, 'Buddy Schmitt', 'bell40@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 8345272, '1', '1', 'Bangladeshi', '546.321.2600', '127 Taya Ford Apt. 647\nHiramside, HI 73001', 'Occaecati porro qui in sit alias. Sapiente dolore perspiciatis nam rerum ut non. Quo ut velit iste eveniet.', '', 1, NULL, 10, NULL, 'pcDHJ4vHWj', '2020-10-28 06:23:26', '2020-12-22 11:55:01', 6, NULL, NULL, NULL, NULL),
(39, 'Geoffrey Shanahan II', 'leilani.goyette@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 7609182, '1', '1', 'Bangladeshi', '+1-994-769-8272', '616 Hackett Lane Apt. 411\nNew Robb, AL 47174', 'Velit eaque officia labore modi. Delectus cupiditate iste quo sapiente. Excepturi quia ipsa ut hic temporibus repellendus.', '', 1, NULL, 19, NULL, 'UEM6v26WMt', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 7, NULL, NULL, NULL, NULL),
(40, 'Prof. Jocelyn Kunze I', 'bauch.paige@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 9081049, '2', '1', 'Bangladeshi', '791-518-7037 x94017', '3355 Claudine Club\nNew Korey, OH 33290', 'A nulla quis eos natus quae. Harum sunt mollitia maxime ducimus alias quis voluptas culpa. Repudiandae fugit sed dolores sunt et.', '', 1, NULL, 16, NULL, 'fIvlA4szXC', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 6, NULL, NULL, NULL, NULL),
(41, 'Sandra Hamill I', 'brennan.bauch@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 3774799, '2', '1', 'Bangladeshi', '458.840.9701 x7949', '1612 Corene Curve Apt. 664\nTretown, NE 13992', 'Ut quae officia cumque hic itaque ut accusamus veniam. Non a est rerum id non voluptatem assumenda. Quod sint rerum ea illum.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 20, NULL, '99Mbw5lmES', '2020-10-28 06:23:26', '2020-10-28 06:23:26', 9, NULL, NULL, NULL, NULL),
(42, 'Cydney Ziemann', 'mchristiansen@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 7396887, '2', '1', 'Bangladeshi', '1-893-241-7584 x49656', '812 Schneider Curve Suite 508\nEast Clintonberg, AK 12382-9973', 'Et ipsum saepe iure delectus distinctio nisi repellat soluta. Voluptatem nemo earum iusto et dicta. Velit sit iure sit debitis similique dolores.', '', 1, NULL, 7, NULL, '6GFwzMTDnq', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 2, NULL, NULL, NULL, NULL),
(43, 'Chesley Spencer', 'pietro57@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 2824176, '2', '1', 'Bangladeshi', '1-843-791-3462 x858', '1718 Langworth Islands Apt. 758\nUbaldoburgh, MS 33677-4242', 'Eius saepe ea vitae et rem iure corporis. Unde et enim repellat fugiat quas architecto. Nihil cumque reprehenderit ducimus suscipit ad.', '', 1, NULL, 5, NULL, 'mPAwvJkzP4', '2020-10-28 06:23:27', '2021-01-16 04:36:00', 4, NULL, NULL, NULL, NULL),
(44, 'Mr. Ewald Runolfsdottir', 'harber.patricia@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 8146107, '1', '1', 'Bangladeshi', '1-297-701-6745', '91543 Freeda Manors\nSteuberton, TX 89376', 'Consequatur autem nulla animi repellendus voluptatem omnis. Impedit facilis eveniet est consectetur ratione. Voluptatum corrupti excepturi iusto et accusamus.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 8, NULL, 'bfD75gsO4k', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 5, NULL, NULL, NULL, NULL),
(45, 'Allene Hill', 'raquel12@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 2, '0', 1, 20165757, 3349297, '2', '1', 'Bangladeshi', '(920) 608-8397', '147 Gordon Burgs\nNorth Kiaramouth, IL 89202', 'Voluptatem consequatur culpa fuga vel. Itaque aperiam quia pariatur qui ad et hic. Ipsa culpa ea illum laborum.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 4, NULL, 'mwkC6LRBJO', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 10, NULL, NULL, NULL, NULL),
(46, 'Modesta White', 'qabbott@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 4038486, '2', '1', 'Bangladeshi', '1-426-488-7434', '7707 Eleonore Keys\nNorth Cristopher, OK 24104', 'Ducimus voluptatem inventore corporis expedita ut. Saepe corrupti aliquam et sequi quisquam hic. Cupiditate iste incidunt itaque.', '', 1, NULL, 12, NULL, 'PYknAtDB12', '2020-10-28 06:23:27', '2020-12-09 09:19:12', 10, NULL, NULL, NULL, NULL),
(47, 'Ervin O&#039;Keefe DDS', 'mrunolfsson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 1595654, '2', '1', 'Bangladeshi', '1-503-246-1419', '138 Strosin Islands\nPort Alia, ME 08815', 'Ea ut rerum atque doloremque nostrum perspiciatis. Sint ut reiciendis debitis. Voluptatum ipsam saepe enim tenetur eaque quidem expedita.', '', 1, NULL, 4, NULL, 'SBCcr9KAZa', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 6, NULL, NULL, NULL, NULL),
(48, 'Jalyn Erdman', 'barbara.rohan@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 2115903, '1', '1', 'Bangladeshi', '+1-404-474-9102', '45275 Haag Mountain Apt. 567\nLake Electa, NH 24867', 'Blanditiis vel suscipit qui et rerum a voluptatem est. Ducimus beatae magni aut omnis quia reiciendis. Dolor itaque autem in minus harum dolores nulla quod.', '', 1, NULL, 1, NULL, '3zuuA0pIUm', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 1, NULL, NULL, NULL, NULL),
(49, 'Mr. Anibal Satterfield', 'ikihn@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 8228496, '1', '1', 'Bangladeshi', '+1.802.413.1347', '908 Carroll Center Apt. 661\nNorth Myrticeshire, MO 06151', 'Explicabo omnis sit aut rerum corrupti consequatur est est. Est aut repellat veritatis tempora aliquam et quis. Quibusdam rerum saepe exercitationem alias reprehenderit aut voluptatem.', '', 1, NULL, 14, NULL, 'W7VUslN6sE', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 2, NULL, NULL, NULL, NULL),
(50, 'Yasmeen Parisian', 'shannon62@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 2, '0', 1, 20165757, 6475133, '1', '1', 'Bangladeshi', '1-771-917-9689', '5161 Rene Keys Suite 441\nLake Nikita, WV 93889-7895', 'Facilis accusantium eius veritatis sed. Eligendi animi recusandae nesciunt aliquam. Corrupti ducimus dolorem optio pariatur ex.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 17, NULL, 'hNPW0GjnGb', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 7, NULL, NULL, NULL, NULL),
(51, 'William Hoeger', 'kylee55@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 2, '0', 1, 20165757, 754582, '1', '1', 'Bangladeshi', '(841) 936-7477', '5340 Ashtyn Dale Suite 831\nMcCulloughstad, CA 67398-9192', 'Repellendus distinctio alias quis repudiandae delectus ipsum consequatur dolorum. Expedita in labore aut omnis quasi sequi illum. In ea est accusamus ut ut facere officia.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 17, NULL, 'Q1u2MWzJiS', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 7, NULL, NULL, NULL, NULL),
(52, 'Austyn Cartwright', 'sister.gottlieb@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 4352772, '1', '1', 'Bangladeshi', '1-658-486-9962 x44112', '689 Pablo Flat Apt. 829\nPort Carterland, MA 39416-5932', 'Magni excepturi in explicabo provident doloribus ut. Totam est dolores sit eveniet harum esse. Rerum veniam commodi et maiores aut.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 14, NULL, 'sNdARDT6qf', '2020-10-28 06:23:27', '2020-12-09 11:05:03', 7, NULL, NULL, NULL, NULL),
(53, 'Ms. Rachel Kassulke', 'katharina01@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 2388176, '1', '1', 'Bangladeshi', '1-376-744-4728 x18327', '74161 Anderson Mountains\nGrahambury, WI 30540', 'Iste ut saepe neque eligendi sequi et animi blanditiis. Qui inventore deserunt quo qui in magnam. Quam tempora amet aut.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 8, NULL, 'SdjioXdP5j', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 3, NULL, NULL, NULL, NULL),
(54, 'Magnus Maggio', 'schimmel.hayden@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 9887213, '1', '1', 'Bangladeshi', '1-806-709-9179 x8889', '4737 Holly Spring Apt. 613\nNorth Queenton, AK 54599', 'Sint sed error porro sint ipsa. Suscipit perferendis hic rerum in sit odio. Ut earum quia deserunt ducimus quia.', '', 1, NULL, 17, NULL, 'MEk0Rv5TBU', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 2, NULL, NULL, NULL, NULL),
(55, 'Cristobal Corkery', 'jenifer59@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 7840038, '1', '1', 'Bangladeshi', '(672) 976-8659 x161', '15142 Kilback Tunnel Suite 028\nNorth Stephanie, IA 02591', 'Corrupti fuga vero omnis distinctio. Est voluptatibus deserunt veritatis occaecati esse in asperiores. Et voluptates velit quia quis itaque dolorem tempore.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 6, NULL, '3f2WQLL7Gm', '2020-10-28 06:23:27', '2020-12-09 11:14:07', 7, NULL, NULL, NULL, NULL),
(56, 'Nya Botsford', 'bryce.daugherty@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 5972803, '2', '1', 'Bangladeshi', '+18439689861', '52619 Janice Common\nBinsfort, WY 39149', 'Eveniet in quo blanditiis vero ad iusto dignissimos delectus. Tempora et impedit et non explicabo et occaecati facere. Eum eligendi porro dolores quas nihil et asperiores occaecati.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 3, NULL, 'ID890oREy9', '2020-10-28 06:23:27', '2020-12-09 09:19:20', 4, NULL, NULL, NULL, NULL),
(57, 'Aglae Cole', 'abshire.hazel@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 0, '0', 1, 20165757, 5073102, '2', '1', 'Bangladeshi', '(778) 261-9877', '50728 Boyd Brook\nReichertmouth, DE 55418-5817', 'Vitae est nihil illum qui. Quibusdam suscipit reprehenderit rem consequatur et beatae. Et sint perferendis aut vel tempore ut amet.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 16, NULL, 'FasjFlcfbi', '2020-10-28 06:23:27', '2020-12-09 09:24:51', 4, NULL, NULL, NULL, NULL),
(58, 'Miss Callie Sauer Jr.', 'jacynthe.harris@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 530158, '2', '1', 'Bangladeshi', '1-464-333-8498 x5613', '5341 Hartmann Village Apt. 399\nWest Jamirberg, HI 98762', 'Neque itaque omnis molestias delectus pariatur. Officiis aut eaque quisquam omnis. Tempore itaque sint quibusdam veritatis doloribus.', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 14, NULL, 'tahka6qH4q', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 5, NULL, NULL, NULL, NULL),
(59, 'Cristal Kshlerin', 'nreynolds@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 1819409, '2', '1', 'Bangladeshi', '723-490-3588 x240', '14475 Kaci Courts Apt. 874\nNikkoburgh, AK 43222', 'Nam quod dolores consectetur possimus maiores. At ullam dolorum fugiat ut porro. Sint ut facilis minima.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, 9, NULL, 'rde7Xmx5um', '2020-10-28 06:23:27', '2020-12-22 12:16:50', 3, NULL, NULL, NULL, NULL),
(60, 'Cecelia Hackett', 'miles88@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 8082436, '1', '1', 'Afghan', '(814) 722-1420', '869 Schaefer MountainEast Juliettown, DE 94347-3325', 'Quisquam vel dolorum molestiae in ut tempore distinctio et. Atque consequuntur placeat vero sed. Modi ea perferendis ipsum tempore sapiente ut sit.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1609580272.png', 1, NULL, 13, NULL, 'g3tjYD3mjm', '2020-10-28 06:23:27', '2021-03-28 07:06:20', 1, NULL, NULL, NULL, NULL),
(61, 'Dr. Horacio Grimes', 'anabelle.lebsack@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 4541332, '1', '1', 'Bangladeshi', '240.977.2667', '498 Serena Roads\nNew Jademouth, MT 05393', 'Et quia eum aut nulla nobis eveniet saepe. Adipisci delectus cum voluptas praesentium nobis. Et est et et laboriosam.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/STP/1608787175.png', 1, NULL, 19, NULL, '0ggtzUWCoi', '2020-10-28 06:23:27', '2020-10-28 06:23:27', 8, NULL, NULL, NULL, NULL),
(62, 'Prof. Deanna Marvin', 'durgan.cecil@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5894587, '1', '1', 'Bangladeshi', '+14586549849', '2624 Doris Mission Suite 273\nNorth Waylonstad, UT 67719-8680', 'Doloribus alias ut sit quae natus. Dolores facilis unde atque explicabo. Modi esse necessitatibus quia atque.', 'https://lorempixel.com/640/480/?58768', 1, NULL, 20, NULL, 'gMtjNvscaZ', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 6, NULL, NULL, NULL, NULL),
(63, 'Maurice Schmeler V', 'jolie.bednar@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8999766, '1', '1', 'Bangladeshi', '702.563.5094 x5116', '81355 Bode Mountains\nGlendamouth, WA 00748', 'Aut est aut rerum. Necessitatibus et ullam dolores doloremque. Ea inventore enim quia dolor placeat.', 'https://lorempixel.com/640/480/?82822', 1, NULL, 6, NULL, '8f7NFUaXMT', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 9, NULL, NULL, NULL, NULL),
(64, 'Harry Watsica', 'gerlach.mike@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1323623, '1', '1', 'Bangladeshi', '667.890.6125', '283 Katharina Greens\nLake Bartholomehaven, WY 01663-9659', 'Quo incidunt eos minus quisquam. Id iusto sapiente harum optio dolorem. Dolorem hic aut ut consequatur natus.', 'https://lorempixel.com/640/480/?34000', 1, NULL, 19, NULL, '6dc5hOlhj2', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 6, NULL, NULL, NULL, NULL),
(65, 'Prof. Mac Lakin DDS', 'madyson60@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1373799, '2', '1', 'Bangladeshi', '+1-862-921-2611', '5366 Hammes Mountain Apt. 695\nDaynamouth, VT 04440', 'Numquam quia ipsam nam deserunt. Qui sed quidem quibusdam aut. Dolore inventore eum porro aperiam quidem rerum.', 'https://lorempixel.com/640/480/?95078', 1, NULL, 9, NULL, 'AyfLfYv4Uy', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 8, NULL, NULL, NULL, NULL),
(66, 'Issac Erdman', 'laila52@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6702926, '2', '1', 'Bangladeshi', '854.668.1572 x057', '728 Aleen Course\nWest Dayne, AK 82007-5707', 'Ullam dolorum itaque quia accusamus voluptatem saepe et. Dolores autem itaque totam rerum occaecati ex necessitatibus. Vel sint sed dolor corporis.', 'https://lorempixel.com/640/480/?76009', 1, NULL, 17, NULL, 'DtrbhiXPhJ', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 8, NULL, NULL, NULL, NULL),
(67, 'Roger Corkery', 'wolff.carmen@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8706674, '1', '1', 'Bangladeshi', '1-948-245-9779 x2692', '468 Stehr Shoals Suite 697\nIcieport, NE 69832', 'Tempore aut sit molestiae accusamus ex et. A quam maiores aliquid consequatur nemo omnis. Incidunt aspernatur eos voluptate velit excepturi.', 'https://lorempixel.com/640/480/?53463', 1, NULL, 3, NULL, 'rMyD0QvCDx', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 3, NULL, NULL, NULL, NULL),
(68, 'Kamren Mante II', 'mason.kub@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4808210, '2', '1', 'Bangladeshi', '+1-498-245-0063', '44934 Ankunding Roads\nNew Gerhard, IN 26497', 'Expedita dignissimos aut numquam magnam temporibus nostrum. Exercitationem tempora dolore officia enim dolorem alias. Iure aliquid labore facilis ad libero non sit.', 'https://lorempixel.com/640/480/?26022', 1, NULL, 16, NULL, '04bKk8XDIF', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 2, NULL, NULL, NULL, NULL),
(69, 'Felicita Barrows', 'carolanne05@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 34914, '1', '1', 'Bangladeshi', '516-663-8861 x03783', '33779 Mohammad Ford Suite 070\nChamplinstad, DC 20423', 'Sapiente libero est maxime. Sint molestiae atque reiciendis impedit magnam fuga iste. Animi et quisquam nihil numquam.', 'https://lorempixel.com/640/480/?92245', 1, NULL, 20, NULL, 'TJPHG1sEL7', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 5, NULL, NULL, NULL, NULL),
(70, 'Dr. Monique Jakubowski', 'lottie25@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 32041, '1', '1', 'Bangladeshi', '749-680-4290', '67930 McClure Harbor Apt. 712\nSouth Jeanne, DC 03966', 'Assumenda libero quod dicta velit ut. Laudantium laborum illum aut. Itaque facilis omnis placeat aut.', 'https://lorempixel.com/640/480/?50470', 1, NULL, 20, NULL, 'TVwwEH0mdj', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 2, NULL, NULL, NULL, NULL),
(71, 'Trevor Terry', 'balistreri.fausto@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5239089, '2', '1', 'Bangladeshi', '868-567-7575 x0152', '1821 Caterina Bypass Apt. 696\nAbelchester, IA 27613-3353', 'Velit autem alias et eos. Fugiat distinctio illo voluptatum quaerat ratione. Qui eius vel alias occaecati fugiat qui dignissimos dolorem.', 'https://lorempixel.com/640/480/?45617', 1, NULL, 5, NULL, '7i4fkwugjy', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 10, NULL, NULL, NULL, NULL),
(72, 'Dr. Eloy Schneider MD', 'eliza.veum@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1769897, '1', '1', 'Bangladeshi', '1-938-886-5202 x119', '25932 Lilliana Passage Apt. 579\nOlaport, MD 19948-8797', 'Ducimus perspiciatis consequatur iusto quas perferendis et necessitatibus dolor. Nemo vel eligendi impedit consequatur dicta. Et sint et similique ullam dicta unde vero autem.', 'https://lorempixel.com/640/480/?54009', 1, NULL, 11, NULL, 'rGV13RGSU4', '2020-10-28 06:23:28', '2020-10-28 06:23:28', 10, NULL, NULL, NULL, NULL),
(73, 'Oren Ortiz', 'lwuckert@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 313585, '2', '1', 'Bangladeshi', '937.802.3800', '360 Otilia Mews\nLake Lelastad, KY 16863', 'Animi porro unde similique sit. Deleniti quae omnis vero voluptatem vitae quo voluptatem. Iste vitae animi quo.', 'https://lorempixel.com/640/480/?76351', 1, NULL, 13, NULL, 'hLQBhuIhi5', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 6, NULL, NULL, NULL, NULL),
(74, 'Brody Erdman V', 'rosetta.yost@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2298759, '1', '1', 'Bangladeshi', '534.536.0844', '231 Feil Drives\nBatzmouth, OK 68557', 'Aspernatur quas laboriosam magnam ut quasi debitis molestiae. Amet debitis consequatur ipsa quia iusto rerum. Libero eum ut nulla sed provident aut.', 'https://lorempixel.com/640/480/?70308', 1, NULL, 9, NULL, 'QeF7fPPsWB', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 4, NULL, NULL, NULL, NULL),
(75, 'Erling Reilly', 'darren04@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4303599, '2', '1', 'Bangladeshi', '317-967-6489', '175 Abbott Route Suite 682\nVonchester, VT 36771-0280', 'Modi adipisci rem maiores veritatis. Laborum reprehenderit maxime vero omnis. Sint ullam est sit non laborum animi.', 'https://lorempixel.com/640/480/?33242', 1, NULL, 7, NULL, '7T66oO76Uf', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 9, NULL, NULL, NULL, NULL),
(76, 'Dr. Jessy Haag', 'dschuppe@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4003335, '1', '1', 'Bangladeshi', '631-403-7125 x7072', '25894 Borer Ranch\nEast Sidbury, IL 20749-7010', 'Qui officiis et ut ex. Labore corporis qui consectetur voluptatem amet saepe porro. Culpa est aperiam et officia rerum vel ducimus ea.', 'https://lorempixel.com/640/480/?39198', 1, NULL, 3, NULL, 'YnydJqAtdm', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 8, NULL, NULL, NULL, NULL),
(77, 'Waylon Smitham', 'rreichel@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4742833, '2', '1', 'Bangladeshi', '+1.554.267.8826', '7906 Rice Crescent Apt. 149\nKeelingchester, HI 68096-6102', 'Et doloribus et doloremque quia dolore. Excepturi repudiandae impedit alias dicta iure. Corrupti laborum culpa omnis rem.', 'https://lorempixel.com/640/480/?59522', 1, NULL, 9, NULL, 'pxZjMx2Czt', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 7, NULL, NULL, NULL, NULL),
(78, 'Hermina Abbott', 'thompson.jeremie@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9663658, '2', '1', 'Bangladeshi', '515-934-1111', '994 Reynolds Heights Suite 378\nBlockton, ND 16244', 'Officiis blanditiis autem esse. Dolor sunt et ea quas dolore ea beatae doloremque. Perferendis earum et sit qui asperiores.', 'https://lorempixel.com/640/480/?85901', 1, NULL, 12, NULL, '3aldh2t7xA', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 6, NULL, NULL, NULL, NULL),
(79, 'Francesco Yundt', 'loraine75@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1564283, '1', '1', 'Bangladeshi', '787-219-7698 x3034', '4036 Macejkovic Passage\nBeckerport, UT 93089', 'Molestiae sapiente eos voluptate sunt consectetur distinctio et ipsum. Fuga aut dolores eveniet sint. Quibusdam minima veritatis et.', 'https://lorempixel.com/640/480/?34001', 1, NULL, 9, NULL, 'NPPPlRlvYx', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 3, NULL, NULL, NULL, NULL),
(80, 'Elizabeth Farrell Jr.', 'steve.lebsack@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 689293, '2', '1', 'Bangladeshi', '389-560-7194 x64770', '240 Ruecker Island Suite 368\nZboncakmouth, ND 61037', 'Dolorem omnis dolore debitis vero et voluptatem minima. Est delectus et blanditiis. Occaecati accusantium facere esse.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/SP/1601610962029.png', 1, NULL, 19, NULL, 'mOx0um3ak2', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 5, NULL, NULL, NULL, NULL),
(81, 'Trever Hayes', 'theron.reichel@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5535987, '1', '1', 'Bangladeshi', '+16589329889', '989 Dave Hills\nWaltonchester, OH 55724', 'Et rerum cum similique vel nihil minima in. Accusantium aut voluptas vel vero aliquam quos aut rem. Perspiciatis qui et suscipit sint.', 'https://lorempixel.com/640/480/?25289', 1, NULL, 16, NULL, 'naVKEY0JsX', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 3, NULL, NULL, NULL, NULL),
(82, 'Delaney Luettgen PhD', 'twindler@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1505148, '1', '1', 'Bangladeshi', '981-969-1224', '4796 Rippin Centers Suite 484\nAnkundingland, VA 60950-6148', 'Fugit architecto consequatur quis id temporibus. Et nostrum quia animi sunt. Velit nesciunt inventore exercitationem consequatur reiciendis.', 'https://lorempixel.com/640/480/?26436', 1, NULL, 1, NULL, '2aukQJC06F', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 2, NULL, NULL, NULL, NULL),
(83, 'Missouri Cremin', 'wunsch.nola@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9690786, '2', '1', 'Bangladeshi', '1-230-597-8953 x75843', '8626 Beth Mission Suite 106\nPort Augustview, MD 24398', 'In saepe quia ipsa ipsa sit possimus. Totam dignissimos quia deserunt laudantium quia rem optio. Magni perferendis non ea nemo minima sapiente.', 'https://lorempixel.com/640/480/?15374', 1, NULL, 16, NULL, '6vLBj6LUQ7', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 5, NULL, NULL, NULL, NULL),
(84, 'Prince Heller', 'emerald.shields@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4879477, '2', '1', 'Bangladeshi', '+17159149746', '1916 Aurelio Loaf\nLake Chrisberg, OK 27221-2328', 'Quo non doloremque enim rerum dolores. Est quia voluptates ea voluptatum. Dicta in eveniet beatae eveniet.', 'https://lorempixel.com/640/480/?85352', 1, NULL, 13, NULL, 'U27fquPHV5', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 6, NULL, NULL, NULL, NULL),
(85, 'Estefania Kihn', 'rippin.tremaine@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7266771, '2', '1', 'Bangladeshi', '583-549-8478 x504', '77714 Rogahn Forks Apt. 008\nGudrunfurt, ME 53813', 'Explicabo nesciunt repellat ratione consectetur possimus autem. Voluptatem quos modi alias veritatis autem ut. Impedit dicta placeat nihil et dicta.', 'https://lorempixel.com/640/480/?64104', 1, NULL, 2, NULL, 'J1CDtWqkG6', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 7, NULL, NULL, NULL, NULL),
(86, 'Linwood Barton', 'laila.fritsch@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4472168, '1', '1', 'Bangladeshi', '1-678-395-4570 x9644', '4328 Sadie Mountain Suite 453\nNew Uriah, NJ 42390', 'Distinctio et ab quaerat dolore exercitationem unde eaque. Perspiciatis nihil sapiente sed sequi quod qui sapiente sed. Sunt impedit libero voluptatum blanditiis.', 'https://lorempixel.com/640/480/?66430', 1, NULL, 18, NULL, 'v1dPrPCLJO', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 6, NULL, NULL, NULL, NULL),
(87, 'Lonie Reichert DVM', 'ivy58@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3673919, '1', '1', 'Bangladeshi', '(748) 918-7899 x232', '34391 Lafayette Pass Apt. 028\nLukasbury, MD 02425', 'Illum eos ratione et ducimus. Labore vel aut voluptates iste assumenda ut et. Sint rerum magni ipsum est animi molestiae.', 'https://lorempixel.com/640/480/?69586', 1, NULL, 5, NULL, 'jliyFYPsun', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 2, NULL, NULL, NULL, NULL),
(88, 'Ms. Brianne Rogahn Jr.', 'ebruen@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8867390, '2', '1', 'Bangladeshi', '(876) 793-9122', '921 Schowalter Garden\nNew Mikaylamouth, NM 82386-7229', 'Aut debitis ab et reprehenderit repellat id et sed. Expedita sunt consequatur occaecati adipisci voluptatibus. Ipsam impedit at odit itaque sapiente.', 'https://lorempixel.com/640/480/?18538', 1, NULL, 14, NULL, 'GZeLOxuSRE', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 1, NULL, NULL, NULL, NULL),
(89, 'Mrs. Delfina Weber Sr.', 'moore.lura@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 770256, '1', '1', 'Bangladeshi', '391.319.6628 x03018', '15828 Leila Court Suite 246\nMuellerborough, CT 67394', 'Quia ad sit assumenda commodi sit non nisi. Cum cupiditate quaerat perspiciatis excepturi quos quisquam illo eveniet. In nostrum veniam quia alias.', 'https://lorempixel.com/640/480/?96475', 1, NULL, 3, NULL, 'lwRc2gZlz4', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 2, NULL, NULL, NULL, NULL),
(90, 'Prof. Charlie Jacobson II', 'xlemke@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6649338, '2', '1', 'Bangladeshi', '1-202-383-2777', '6707 Fritsch Vista\nWest Augusta, HI 84634-5960', 'Qui soluta est qui et recusandae maiores. Repellat et et nemo autem eum reiciendis dolores. Voluptates doloremque quod maiores ut sed qui.', 'https://lorempixel.com/640/480/?17604', 1, NULL, 8, NULL, 'EI9fecsvba', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 10, NULL, NULL, NULL, NULL),
(91, 'Kaitlin Paucek', 'tavares79@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 676676, '1', '1', 'Bangladeshi', '1-997-504-6091 x619', '7129 Rohan Plains Apt. 214\nNew Rozellaton, NE 67379', 'Vel vel et labore unde libero dolorum. Debitis reprehenderit rerum quia velit cupiditate quam rerum officia. Dolorem temporibus saepe soluta.', 'https://lorempixel.com/640/480/?28232', 1, NULL, 2, NULL, 'eVw8sVtqH5', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 1, NULL, NULL, NULL, NULL),
(92, 'Deion Marquardt', 'hattie.douglas@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4486827, '2', '1', 'Bangladeshi', '+1-567-804-9456', '9330 Marjolaine Gardens\nReichertburgh, DC 22629-0137', 'Officia animi et aspernatur ut qui. Totam fuga dicta aut ipsum dolor dolorum. Impedit sapiente quia suscipit doloribus quo quaerat.', 'https://lorempixel.com/640/480/?37508', 1, NULL, 11, NULL, 'EOaNF8oXk9', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 4, NULL, NULL, NULL, NULL),
(93, 'Lura Shanahan DVM', 'jcorkery@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5959945, '2', '1', 'Bangladeshi', '667.424.1689', '333 Mayer Island Apt. 351\nRueckermouth, KY 43295', 'Est labore quia nemo nemo expedita a consequatur. Voluptatem dolor et cupiditate. Debitis maiores amet quis error quidem earum.', 'https://lorempixel.com/640/480/?48543', 1, NULL, 15, NULL, 'op7Lm9WpMy', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 6, NULL, NULL, NULL, NULL),
(94, 'Jammie Grimes', 'vandervort.avis@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4616159, '1', '1', 'Bangladeshi', '1-460-464-4150 x285', '558 Domenico Junction\nWest Columbus, OK 45846', 'Natus eum at aperiam. Inventore enim libero consequuntur nobis similique. Iusto ut debitis distinctio ea aut.', 'https://lorempixel.com/640/480/?62684', 1, NULL, 12, NULL, 'lb1hwhc54k', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 8, NULL, NULL, NULL, NULL),
(95, 'Opal Gutmann IV', 'abigale.bergstrom@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6397436, '1', '1', 'Bangladeshi', '(528) 918-3512', '4146 Jairo Viaduct Apt. 845\nKuhnborough, NJ 88105-7095', 'Voluptatibus ut quod aliquid ex. Magnam veritatis qui ut sed esse. Sed beatae exercitationem nostrum ut.', 'https://lorempixel.com/640/480/?28925', 1, NULL, 15, NULL, 'zJsnTA6OtW', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 1, NULL, NULL, NULL, NULL),
(96, 'Zakary Zboncak IV', 'audreanne.beier@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1718068, '2', '1', 'Bangladeshi', '+1-487-557-4933', '55621 Gulgowski Greens\nWest Estella, MO 92732-1662', 'Sit est illo qui rerum officiis. Dignissimos sunt error ut itaque impedit ex unde natus. Est voluptatem at harum et.', 'https://lorempixel.com/640/480/?45078', 1, NULL, 11, NULL, 'LKln4tZQVU', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 3, NULL, NULL, NULL, NULL),
(97, 'Vivien Stoltenberg', 'crist.maximillian@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3960444, '1', '1', 'Bangladeshi', '+1-993-341-7890', '557 Kian Springs\nSouth Bethberg, ME 12371', 'Excepturi a provident ut aut temporibus laborum. Magnam officiis deserunt est ipsum rerum eius quis. Dignissimos sed repellendus commodi voluptas ut asperiores est.', 'https://lorempixel.com/640/480/?96314', 1, NULL, 12, NULL, 'FVqkgcENAH', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 1, NULL, NULL, NULL, NULL),
(98, 'Ms. Helga Satterfield', 'kyler.jones@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1649565, '1', '1', 'Bangladeshi', '(415) 757-7457', '4541 Kenyatta Creek Suite 434\nCorychester, AL 65793-9506', 'Qui voluptas id eum ut quaerat. Accusantium incidunt placeat voluptatem. Qui soluta delectus nulla est voluptatem repellendus.', 'https://lorempixel.com/640/480/?35284', 1, NULL, 14, NULL, 'ZUjv8IRcFU', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 5, NULL, NULL, NULL, NULL),
(99, 'Prof. Ruben Erdman II', 'evangeline43@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 172495, '2', '1', 'Bangladeshi', '298-214-9039', '84579 Robel Centers Suite 022\nWittingbury, DE 55486-8902', 'Sit consequatur fugiat possimus consequatur quia dolorem. Fuga repudiandae quisquam iusto doloribus non. Sed et mollitia expedita.', 'https://lorempixel.com/640/480/?72800', 1, NULL, 11, NULL, 'kfSRFDnjWB', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 8, NULL, NULL, NULL, NULL),
(100, 'Kailee Sporer', 'collins.jonatan@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1541379, '2', '1', 'Bangladeshi', '512-948-8222 x964', '321 Romaguera Ramp\nRatkeside, AZ 82319', 'Dicta quod est minus distinctio numquam. Cupiditate rerum quia recusandae qui est. Fugit nesciunt non iste rerum nostrum.', 'https://lorempixel.com/640/480/?66975', 1, NULL, 20, NULL, 'jTyGj0y8e0', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 8, NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `role_title`, `active`, `isSuper`, `school_id`, `code`, `student_code`, `gender`, `blood_group`, `nationality`, `phone_number`, `address`, `about`, `pic_path`, `verified`, `email_verified_at`, `section_id`, `assign_school`, `remember_token`, `created_at`, `updated_at`, `department_id`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(101, 'Lilyan Hettinger', 'leola06@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 316747, '1', '1', 'Bangladeshi', '(364) 918-4623', '3004 Dulce Camp Suite 395\nNorth Angiemouth, MS 44108-5936', 'Velit eum autem voluptatem et debitis omnis. Iure dolores sed ea distinctio recusandae nobis. Est voluptatem excepturi maxime.', 'https://lorempixel.com/640/480/?20527', 1, NULL, 20, NULL, '9eVku23BA6', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 3, NULL, NULL, NULL, NULL),
(102, 'Greyson Gerhold', 'langosh.jeremy@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8871304, '1', '1', 'Bangladeshi', '215-794-1688 x653', '276 Clyde Summit Apt. 797\nLake Robynstad, DE 95126-5460', 'Rerum consectetur quibusdam earum sint nulla. Doloribus at illum et consectetur dicta. Reiciendis in perspiciatis sed.', 'https://lorempixel.com/640/480/?23354', 1, NULL, 13, NULL, 's74wsF8ho0', '2020-10-28 06:23:29', '2020-10-28 06:23:29', 1, NULL, NULL, NULL, NULL),
(103, 'Holly Hayes', 'legros.bethel@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5202467, '2', '1', 'Bangladeshi', '410-643-1581', '30484 Gene Greens Suite 395\nNew Gregg, ND 53116-7316', 'Repudiandae tenetur voluptatem molestiae beatae. Facere saepe id harum. Omnis illo unde in sit vel tempore.', 'https://lorempixel.com/640/480/?34635', 1, NULL, 2, NULL, 'wjTYi3kkfX', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 7, NULL, NULL, NULL, NULL),
(104, 'Pat Heidenreich', 'laverna.towne@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6404180, '1', '1', 'Bangladeshi', '1-649-650-9033', '490 Hildegard Street Suite 046\nEast Kristoffer, MN 05686', 'Voluptatem odit assumenda quisquam similique sequi. Adipisci ut excepturi accusamus non qui incidunt consequatur. Ea autem eos nemo saepe maiores in.', 'https://lorempixel.com/640/480/?54050', 1, NULL, 15, NULL, 'xKgWyStJiI', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 8, NULL, NULL, NULL, NULL),
(105, 'Prof. Hester Bayer', 'mcclure.stefan@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2016634, '1', '1', 'Bangladeshi', '1-710-752-5550', '3720 Kuhlman Junctions Apt. 801\nConstantinburgh, NC 57046', 'Earum laborum est qui ducimus. Expedita aut dignissimos aperiam. Cupiditate doloremque vel aut inventore quisquam.', 'https://lorempixel.com/640/480/?16156', 1, NULL, 11, NULL, 'npUv1THmpI', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 9, NULL, NULL, NULL, NULL),
(106, 'Earnest Parisian MD', 'zackary.russel@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3337469, '1', '1', 'Bangladeshi', '+1-242-729-5406', '11573 Wiza Trace Suite 347\nBlockburgh, CO 97476-1285', 'Ut et corporis non corporis dolorum qui. Blanditiis quis dolorem itaque tempore ipsam voluptatem. Ducimus dolorum odit iure laboriosam.', 'https://lorempixel.com/640/480/?94774', 1, NULL, 4, NULL, 'VWYKkkfOUw', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 9, NULL, NULL, NULL, NULL),
(107, 'Catalina Lowe', 'mccullough.susanna@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5768075, '2', '1', 'Bangladeshi', '+1.510.407.3319', '730 Rosamond Brook Suite 680\nBergehaven, SC 77544', 'Possimus dolorum quibusdam ipsum sunt optio ullam. Asperiores eveniet voluptas rerum facilis aut nemo. Omnis numquam odio dolorem nulla eos inventore.', 'https://lorempixel.com/640/480/?22466', 1, NULL, 20, NULL, 'xblUIEpqwY', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 2, NULL, NULL, NULL, NULL),
(108, 'Mrs. Eudora Parisian', 'cyril68@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3577184, '2', '1', 'Bangladeshi', '1-878-321-6729', '337 Cristopher Ways Suite 851\nWest Clayshire, IL 15104', 'Rerum vel est laborum sit quia error consequatur. Error neque ut tempora facere ab impedit pariatur. Animi eaque consequatur vero quae autem vitae ut.', 'https://lorempixel.com/640/480/?61584', 1, NULL, 4, NULL, 'noWiCSsrbm', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 3, NULL, NULL, NULL, NULL),
(109, 'Bridget Rau', 'schamplin@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9508341, '1', '1', 'Bangladeshi', '1-251-707-9636', '466 Danyka Spring\nStoltenbergville, RI 02320', 'Qui veritatis necessitatibus eligendi fugit. Voluptatum voluptatem facere quasi non quia quia praesentium. Distinctio quis facere nihil eius.', 'https://lorempixel.com/640/480/?17493', 1, NULL, 12, NULL, 'pOlDeKwx2D', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 8, NULL, NULL, NULL, NULL),
(110, 'Bernardo Beahan', 'molson@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 754686, '1', '1', 'Bangladeshi', '562.832.1193', '82245 Ratke Lake Apt. 655\nSouth Stoneburgh, WV 25484', 'Dolore dolores nemo excepturi et a impedit voluptas. Aut aliquam non modi et. Esse eius qui aliquid sunt.', 'https://lorempixel.com/640/480/?21975', 1, NULL, 17, NULL, 'ZD1KgtmRIn', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 3, NULL, NULL, NULL, NULL),
(111, 'Bailey Fahey', 'schimmel.sterling@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 0, '0', 1, 20165757, 7892887, '1', '1', 'Bangladeshi', '965-257-5047', '282 Ernesto Rue Suite 196\nLake Kenyattaville, ME 12606', 'Perspiciatis cumque repellat voluptate. Distinctio pariatur corporis ipsa ea nihil veniam culpa. Possimus voluptas animi omnis voluptas.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/SP/3001612771363.png', 1, NULL, 2, NULL, 'aXaP8guXdX', '2020-10-28 06:23:30', '2021-02-22 10:38:32', 1, NULL, NULL, NULL, NULL),
(113, 'Ms. Frieda Breitenberg Sr.', 'franecki.camren@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7831971, '2', '1', 'Bangladeshi', '375.325.5405', '38031 Germaine Harbors Apt. 265\nLeonoraton, MN 32586', 'In tempora iste eum dolor corrupti sit. Sed sed repellat quisquam unde magni sed quod quia. Mollitia libero ut numquam voluptatem est officia.', 'https://lorempixel.com/640/480/?88685', 1, NULL, 4, NULL, '4mDHzjrobd', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 1, NULL, NULL, NULL, NULL),
(114, 'Ethelyn Daniel DVM', 'astehr@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4964603, '1', '1', 'Bangladeshi', '1-473-630-0360', '531 May Motorway Suite 332\nEast Nicoleburgh, WI 88699-0538', 'Deleniti vero aut fuga cumque eos voluptatem. Qui quis distinctio nisi sit corporis quaerat. Rem omnis aspernatur natus velit et aliquam ut a.', 'https://lorempixel.com/640/480/?92169', 1, NULL, 3, NULL, 'eM2CHVl7n1', '2020-10-28 06:23:30', '2020-10-28 06:23:30', 1, NULL, NULL, NULL, NULL),
(115, 'Reilly Tillman IV', 'paula.rice@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1184750, '1', '1', 'Bangladeshi', '+1-410-510-2790', '8106 Stiedemann Park Apt. 878\nLake Luther, AK 42076', 'Dolorum vel ut ex perferendis dignissimos suscipit. Ut aut facilis incidunt neque ratione nihil et. Qui rerum quibusdam animi libero odio velit.', 'https://lorempixel.com/640/480/?45427', 1, NULL, 3, NULL, 'Wh43KlLnsM', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 9, NULL, NULL, NULL, NULL),
(116, 'Ms. Lacy Labadie', 'kvandervort@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2927558, '2', '1', 'Bangladeshi', '383.285.5449', '30530 Elsa Drives Apt. 333\nLangoshfurt, ME 92424-1086', 'Et aspernatur non sed porro. Error quo id voluptas amet voluptas et. Consequatur harum non quod reiciendis.', 'https://lorempixel.com/640/480/?57766', 1, NULL, 19, NULL, 'jp6ZxhbDJy', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 3, NULL, NULL, NULL, NULL),
(117, 'Tyra Wisoky', 'wcole@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 912522, '2', '1', 'Bangladeshi', '+1.498.828.5977', '4142 Malinda Rue Suite 093\nSophiaville, DC 44901-7619', 'Aliquam et aut praesentium maiores totam corporis sint. Suscipit maxime corporis velit voluptatem nihil voluptas. Eos qui possimus magnam provident.', 'https://lorempixel.com/640/480/?14986', 1, NULL, 6, NULL, 'oXVScvEPU7', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(118, 'Dr. Donavon Von', 'hkemmer@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1580190, '1', '1', 'Bangladeshi', '1-994-460-8917', '28258 Von Parkways\nPort Amayaton, MS 42810-5949', 'Aut fugit numquam dolorem. Qui enim et temporibus voluptatibus doloremque. Exercitationem excepturi eaque beatae veritatis.', '', 1, NULL, 15, NULL, 'zuMgSWHo1a', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 4, NULL, NULL, NULL, NULL),
(119, 'Ellsworth Casper II', 'fisher.lucinda@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3246019, '1', '1', 'Bangladeshi', '+1 (313) 587-9837', '5708 Arnold Divide Suite 372\nEulatown, GA 86808', 'Hic vitae ut rem. Sint velit est sit libero sunt dolor. Ullam qui quam aliquam.', 'https://lorempixel.com/640/480/?83895', 1, NULL, 14, NULL, 'bWi86n4AxA', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 3, NULL, NULL, NULL, NULL),
(120, 'Jennings Leuschke DDS', 'jena.raynor@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8123404, '1', '1', 'Bangladeshi', '884.874.0235 x689', '462 Torp Villages Suite 676\nEast Addisonview, OK 10020', 'Reiciendis impedit deserunt necessitatibus placeat. Est accusamus veniam ut in quis architecto. Quidem beatae reiciendis qui et deserunt aperiam nesciunt.', 'https://lorempixel.com/640/480/?40276', 1, NULL, 3, NULL, 'tu2S8rFbXY', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(121, 'Josephine Mayert', 'aluettgen@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9174289, '2', '1', 'Bangladeshi', '(887) 846-6474 x489', '23399 Macey Road Suite 444\nNew Tylerville, MA 69911', 'Ab sit perspiciatis dolore natus distinctio sapiente. Eos at molestiae accusamus dignissimos ut. Nemo provident occaecati in in.', 'https://lorempixel.com/640/480/?44293', 1, NULL, 4, NULL, 'Gh2vrJNth4', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 9, NULL, NULL, NULL, NULL),
(122, 'Destin Fahey', 'crolfson@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2036656, '2', '1', 'Bangladeshi', '(890) 901-9855 x80565', '8804 Ivory Divide Apt. 898\nEast Lora, LA 88785-2144', 'Aut autem laborum voluptas maxime non. Illo eum quia eos enim sed est. Voluptatem nihil optio ut quo accusamus sit.', 'https://lorempixel.com/640/480/?94764', 1, NULL, 11, NULL, 'I3oksxoBEs', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 4, NULL, NULL, NULL, NULL),
(123, 'Bethany Shanahan', 'destany74@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6838602, '1', '1', 'Bangladeshi', '609.222.8473', '5211 Walton Well\nMarkstown, NJ 19878', 'Labore iusto corrupti ad. Et quia magnam nihil vitae consequatur nam dignissimos. Aut eum et commodi magnam suscipit qui.', 'https://lorempixel.com/640/480/?23320', 1, NULL, 16, NULL, '679yOgtKGr', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(124, 'Prof. Nestor Prohaska Jr.', 'matteo.lind@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9896833, '1', '1', 'Bangladeshi', '1-382-880-7198 x40954', '550 Juanita Rapids Apt. 578\nKoelpinview, GA 01523-7360', 'Ut excepturi odio architecto sed et. Laboriosam consequatur possimus labore pariatur necessitatibus quia ab. Minima et totam voluptas eum laborum architecto soluta.', 'https://lorempixel.com/640/480/?57474', 1, NULL, 17, NULL, 'YVRb4WHqwb', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(125, 'Dr. Darby Weimann', 'qframi@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1137277, '1', '1', 'Bangladeshi', '1-998-860-4253 x075', '8413 Boehm Islands\nNorth Alexandrine, ND 16354', 'Ut in repellendus architecto at ea. Eveniet doloribus nam repudiandae doloribus omnis dolore molestiae eaque. Quis dolore maxime quas quasi aut quis.', 'https://lorempixel.com/640/480/?47796', 1, NULL, 7, NULL, 'eYM231EytD', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 5, NULL, NULL, NULL, NULL),
(126, 'Lionel Sawayn', 'sidney06@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3475675, '2', '1', 'Bangladeshi', '747-643-6213', '4353 Baumbach Terrace\nBartonview, NE 73389', 'Corrupti voluptatem quos quibusdam itaque quisquam temporibus. Aut minus quasi nihil ut et quo expedita placeat. Dolorem amet dolorum quo ducimus ut.', 'https://lorempixel.com/640/480/?22618', 1, NULL, 12, NULL, 'Zyvf7QRLc0', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 4, NULL, NULL, NULL, NULL),
(127, 'Tyrell Mohr', 'karelle31@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 845491, '1', '1', 'Bangladeshi', '(623) 719-4209', '46910 Dana Valley\nSouth Brownview, IA 67888', 'Et ipsa incidunt natus similique rerum et. Aut ut qui et voluptate. Mollitia rerum officia vero odit qui.', 'https://lorempixel.com/640/480/?58453', 1, NULL, 16, NULL, 'WEcry8HcRB', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 4, NULL, NULL, NULL, NULL),
(128, 'Arthur Murphy', 'haley.ibrahim@example.org', '$2y$10$wypnlkgZBY.1.6yk1kysQeERWZ62LwGLwBaHWCM.NAaCw5VxDqOVu', 'student', NULL, 0, '0', 1, 20165757, 4780928, '1', '1', 'Bangladeshi', '548.434.1397 x629', '25881 Robel Mills Suite 367\nLindgrenchester, MI 25181', 'Delectus vel rerum sunt veritatis quam sed labore. Non possimus natus vero. Earum vel ab unde amet debitis.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/SP/2741610960070.png', 1, NULL, 10, NULL, '0j6sjW9Psx', '2020-10-28 06:23:31', '2021-02-08 07:24:21', 9, NULL, NULL, NULL, NULL),
(129, 'Hudson Howell', 'auer.mervin@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8104302, '1', '1', 'Bangladeshi', '1-873-452-5962', '917 Pouros Burg Apt. 295\nNew Maggie, OR 84509', 'Ad non consequatur at consectetur. Impedit reiciendis natus aperiam aperiam assumenda doloribus. Voluptatibus asperiores rem non architecto.', 'https://lorempixel.com/640/480/?18472', 1, NULL, 11, NULL, '6tO3NLGWt2', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 2, NULL, NULL, NULL, NULL),
(130, 'Leo Hermiston DDS', 'wilfredo.rempel@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7218857, '1', '1', 'Bangladeshi', '567-855-8370 x027', '591 Will Unions Suite 993\nMagalichester, AZ 59286-4408', 'Eligendi illum explicabo sunt ut ab vero autem. Dolorum unde ipsam sed doloribus. Harum non rerum velit tenetur in ut facilis.', 'https://lorempixel.com/640/480/?12651', 1, NULL, 14, NULL, 'GfcOu47ZMK', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 1, NULL, NULL, NULL, NULL),
(131, 'Hilbert Lemke', 'uwest@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4928732, '1', '1', 'Bangladeshi', '1-949-661-3797 x6290', '96249 Jadon Oval\nLake Jorgehaven, MT 30298-5052', 'Debitis est ipsam porro voluptates repellat velit quia. Sit mollitia nam dicta voluptatem in harum ut. Recusandae corporis omnis aspernatur blanditiis.', 'https://lorempixel.com/640/480/?62477', 1, NULL, 13, NULL, 'pgYbqCyahU', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 5, NULL, NULL, NULL, NULL),
(132, 'Mariane Wyman', 'jaquan.kunde@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5819759, '2', '1', '', '+1.963.420.6328', '6272 Casper Drives Apt. 984Lawsonmouth, DE 69298', 'Natus excepturi totam velit excepturi sed. Velit quod assumenda eaque aspernatur et. Debitis assumenda consectetur quia eaque.', 'https://lorempixel.com/640/480/?17048', 1, NULL, 19, NULL, 'fzkFidV3uO', '2020-10-28 06:23:31', '2021-01-16 12:06:57', 7, NULL, NULL, NULL, NULL),
(133, 'Chasity McKenzie PhD', 'mohr.preston@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9302167, '2', '1', 'Bangladeshi', '(982) 298-6586 x8391', '615 Tromp Islands Suite 121\nNorth Omari, NV 88196-6629', 'Vero in voluptate tempora quas et fuga sint eligendi. Blanditiis quia alias voluptate aut. Molestias itaque incidunt sed et nobis.', 'https://lorempixel.com/640/480/?24176', 1, NULL, 8, NULL, 'NCUjGjqyAy', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(134, 'Sammie Anderson', 'nbotsford@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5252324, '1', '1', 'Bangladeshi', '541-327-6044 x054', '37665 Ellen Island\nNew Kirsten, TN 28962-7654', 'Amet mollitia explicabo ipsam ex et quo dolor. Cupiditate et eligendi numquam sit consectetur sapiente doloribus. Ea dolore consectetur enim harum.', 'https://lorempixel.com/640/480/?12693', 1, NULL, 14, NULL, 'kJgFDDv8rG', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 8, NULL, NULL, NULL, NULL),
(135, 'Dr. Mylene Kub II', 'arnoldo.romaguera@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6585729, '1', '1', 'Bangladeshi', '+12388559155', '81542 Payton Underpass\nWalshburgh, WI 56247-7626', 'Hic eveniet facilis et. Voluptas sit voluptas exercitationem minus facere et. Aut qui ipsum quidem eaque.', 'https://lorempixel.com/640/480/?16216', 1, NULL, 3, NULL, '7TXG5jJT68', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 6, NULL, NULL, NULL, NULL),
(136, 'Rebecca Abshire', 'jermaine.okeefe@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8785642, '1', '1', 'Bangladeshi', '381.280.9681', '5920 Amy Road Suite 663\nWindlermouth, TX 76965-3210', 'Veritatis ipsam eos quia magnam consectetur accusantium. Necessitatibus ipsam maiores corrupti sapiente corrupti sed. Aut ea et fugiat itaque ipsam.', 'https://lorempixel.com/640/480/?32633', 1, NULL, 13, NULL, 'H7Ct0PNln0', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 5, NULL, NULL, NULL, NULL),
(137, 'Candelario Kiehn', 'dejon.mcdermott@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4132923, '2', '1', 'Bangladeshi', '768-940-1869', '347 Alberta Point\nPort Myronport, AK 80256-8139', 'Ut ipsum suscipit nulla sapiente odit quasi est. Facilis consequatur omnis eligendi sed sit excepturi. Alias quis earum aperiam non.', 'https://lorempixel.com/640/480/?94038', 1, NULL, 17, NULL, 'l8Sx7oH6vf', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 5, NULL, NULL, NULL, NULL),
(138, 'Dr. Neha Schimmel', 'myra.crona@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5300341, '1', '1', 'Bangladeshi', '993.705.8440 x649', '370 Grayson Rest Suite 059\nAbbottview, NY 64776-6762', 'Vel quos quam mollitia distinctio rerum alias repellat omnis. Assumenda placeat et ea nobis quod delectus aliquid. Exercitationem ratione aliquid aut aperiam rerum corrupti in.', 'https://lorempixel.com/640/480/?79613', 1, NULL, 7, NULL, 'niMhECasTl', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 2, NULL, NULL, NULL, NULL),
(139, 'Raul Abshire', 'miller.eliza@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9166879, '1', '1', 'Bangladeshi', '(425) 512-6127', '83211 Tyler Track Suite 676\nLehnerborough, CT 90542-7254', 'Cupiditate natus quas maxime et. Voluptas dolorum in necessitatibus adipisci aperiam. Amet omnis optio quae veniam voluptate.', 'https://lorempixel.com/640/480/?11135', 1, NULL, 10, NULL, '7apO2cVB2R', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 3, NULL, NULL, NULL, NULL),
(140, 'Lilyan Wiegand', 'bednar.annetta@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2645400, '1', '1', 'Bangladeshi', '(835) 246-5595 x627', '26967 Nader View Suite 645\nSouth Richard, CT 12529', 'Eos at dolorum dicta sint rem omnis ad. Aut unde vero facilis aliquam. Cumque quia deserunt aperiam molestias quidem quod adipisci.', 'https://lorempixel.com/640/480/?37332', 1, NULL, 5, NULL, 'UhhZk9RJL4', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 2, NULL, NULL, NULL, NULL),
(141, 'Jazmin Collier', 'gudrun90@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9043902, '1', '1', 'Bangladeshi', '+1-630-676-1305', '742 Scarlett Path\nOliverland, AZ 78397-6177', 'Sed delectus sapiente inventore vero quo. Distinctio quia fugiat ad aperiam sit error similique. Fugiat quisquam ullam commodi est est doloribus culpa.', 'https://lorempixel.com/640/480/?39794', 1, NULL, 18, NULL, 'XfQHLKcMfR', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 7, NULL, NULL, NULL, NULL),
(142, 'Jose Kohler', 'alexzander.rogahn@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8993582, '2', '1', 'Bangladeshi', '814-721-5451 x79536', '7634 Murl Road\nWest Florianstad, MI 83295-4280', 'Nihil velit aut fugiat voluptatibus et tenetur. Dignissimos aut et quibusdam qui cum expedita. Nisi sapiente officiis necessitatibus dignissimos.', 'https://lorempixel.com/640/480/?29136', 1, NULL, 16, NULL, 'Gax9yRLrSW', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 8, NULL, NULL, NULL, NULL),
(143, 'Dr. Imogene Ernser', 'volson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8998738, '1', '1', 'Bangladeshi', '873.830.4329', '18166 Neal Squares\nOrlandton, AK 93564', 'Beatae quisquam et deserunt omnis officiis est dolores. Est rerum et nulla totam. Assumenda omnis et non sunt enim.', 'https://lorempixel.com/640/480/?76689', 1, NULL, 18, NULL, 'ojwxidJpWZ', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 1, NULL, NULL, NULL, NULL),
(144, 'Mattie Stoltenberg', 'noreilly@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9335836, '1', '1', 'Bangladeshi', '(372) 639-4632 x7075', '71997 Klocko Orchard\nGradychester, UT 52822', 'Error natus sed suscipit incidunt. Enim ea esse et fuga autem laudantium ipsum. Quisquam sint magni similique ipsam quo et aut fugiat.', 'https://lorempixel.com/640/480/?39272', 1, NULL, 20, NULL, '6W4qfgQmhk', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 10, NULL, NULL, NULL, NULL),
(145, 'Elody Macejkovic', 'orrin.dickinson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3814034, '1', '1', 'Bangladeshi', '240-409-3998', '3305 Devante Corners\nPedrostad, GA 06046-2412', 'Sequi sit veniam aperiam adipisci magnam at et. Iste soluta libero velit. Molestiae illum hic officia necessitatibus.', 'https://lorempixel.com/640/480/?16250', 1, NULL, 2, NULL, 'BXIIeFLJp0', '2020-10-28 06:23:31', '2020-10-28 06:23:31', 9, NULL, NULL, NULL, NULL),
(146, 'Urban Hand V', 'zharvey@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 98285, '1', '1', 'Bangladeshi', '1-963-947-3146', '8407 Alanna Meadow\nPort Bethelburgh, ID 42095', 'Eum odio earum debitis aliquam ullam. Totam ratione aliquam id enim et et. Perferendis ullam et dolorum occaecati doloremque dolorem excepturi.', 'https://lorempixel.com/640/480/?58793', 1, NULL, 14, NULL, 'ErTVfwr1Mk', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(147, 'Else Pacocha', 'willow57@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3538973, '2', '1', 'Bangladeshi', '898.396.4590', '24771 Alene Prairie Apt. 622\nPort Destini, MT 59590-4300', 'Et dolorem maxime non dolorem. Voluptatem iste eaque excepturi perferendis animi ea qui. Eos enim quae maiores qui.', 'https://lorempixel.com/640/480/?13595', 1, NULL, 16, NULL, 'cgKYx52bDS', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 10, NULL, NULL, NULL, NULL),
(148, 'Rogelio Jast', 'freeda.mcglynn@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9535401, '1', '1', 'Bangladeshi', '765.863.9494 x7966', '86262 Josue Drives Apt. 832\nCollierville, OH 56067', 'Et optio nostrum facere ut assumenda et. Ut laudantium neque nihil sint aliquam. Quia et id odio earum deleniti laudantium.', 'https://lorempixel.com/640/480/?99352', 1, NULL, 9, NULL, 'qKpp4zBxPm', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 1, NULL, NULL, NULL, NULL),
(149, 'Monserrat Wuckert MD', 'wyman.adams@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1848127, '2', '1', 'Bangladeshi', '1-667-464-5520 x652', '19767 Kunde Harbors\nNew Shaina, WY 96439', 'Quisquam est commodi ea est eum rerum eos. Nemo rerum debitis quis assumenda. Nihil vitae autem deserunt rerum ad incidunt.', 'https://lorempixel.com/640/480/?43890', 1, NULL, 1, NULL, '8qN64Zg1cy', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 2, NULL, NULL, NULL, NULL),
(150, 'Misty Roob', 'nicholaus91@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4757819, '2', '1', 'Bangladeshi', '(667) 785-9236 x666', '7475 Heidenreich Place\nPort Norvalhaven, SD 29602', 'Quam ullam ea sed ut sed similique. Voluptatem non suscipit doloremque harum omnis unde mollitia. Delectus officia quos non reprehenderit non nam.', 'https://lorempixel.com/640/480/?89305', 1, NULL, 18, NULL, 'cqvHgYgA5G', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 6, NULL, NULL, NULL, NULL),
(151, 'Finn Bergstrom', 'amina.windler@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6425339, '2', '1', 'Bangladeshi', '240.513.6746 x1481', '1518 Estell Way\nLake Aiyanabury, FL 91638-7333', 'Temporibus molestiae iure consectetur qui molestiae inventore minima perferendis. Distinctio velit occaecati aliquam autem quia et. Eius quo eius alias dolore harum.', 'https://lorempixel.com/640/480/?50482', 1, NULL, 13, NULL, 'vRNplniPXD', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 2, NULL, NULL, NULL, NULL),
(152, 'Krista Lesch', 'lela63@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8596818, '2', '1', 'Bangladeshi', '(580) 668-7932', '3895 McGlynn Run\nNew Londonville, NH 21433', 'Non perferendis tempore soluta. Officia doloremque quo quibusdam enim repudiandae. Consectetur iste doloribus eaque quo.', 'https://lorempixel.com/640/480/?92032', 1, NULL, 2, NULL, '78ZMQ69yfD', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 8, NULL, NULL, NULL, NULL),
(153, 'Estelle Weissnat', 'cassin.thora@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2948881, '1', '1', 'Bangladeshi', '(578) 649-4391 x51133', '1814 Anderson Ridge\nJerdefurt, OK 52125', 'Ratione voluptatem adipisci rerum. Placeat nisi nemo blanditiis unde quam at. Repudiandae dolores ab eos.', 'https://lorempixel.com/640/480/?73475', 1, NULL, 1, NULL, 'kIW7okGAXY', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 10, NULL, NULL, NULL, NULL),
(154, 'Tomas Harber', 'edward.morar@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4354198, '1', '1', 'Bangladeshi', '+1 (527) 385-4018', '706 Daugherty Pine\nLake Brittanyfort, ID 77857', 'Ullam qui quia iste dicta blanditiis perspiciatis quia. Voluptatibus eum minima quibusdam. Nisi necessitatibus ullam ut nam.', 'https://lorempixel.com/640/480/?91351', 1, NULL, 15, NULL, 'V224vRQP3y', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 8, NULL, NULL, NULL, NULL),
(155, 'Jamil Vandervort', 'alfonzo13@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7950039, '1', '1', 'Bangladeshi', '(732) 390-8595 x900', '6687 Schuppe Mills Suite 162\nEast Cathyfurt, OK 61654-6871', 'Excepturi rerum eveniet eligendi nesciunt non asperiores. Impedit aperiam sint consequatur rerum doloribus distinctio totam. Eos voluptatibus nemo atque unde voluptatum.', 'https://lorempixel.com/640/480/?70418', 1, NULL, 14, NULL, '1Y23p74sdB', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 6, NULL, NULL, NULL, NULL),
(156, 'Prof. Kaleigh Dibbert MD', 'viviane96@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 674775, '2', '1', 'Bangladeshi', '637.706.3528 x55029', '31291 Era Heights Apt. 531\nLake Laury, DC 34930', 'Quis aut nostrum perferendis alias sunt. Eum aperiam soluta fugit dignissimos. Incidunt animi consequatur veniam doloremque.', 'https://lorempixel.com/640/480/?43470', 1, NULL, 4, NULL, 'usU0sxnPlA', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 4, NULL, NULL, NULL, NULL),
(157, 'Summer Labadie', 'bulah.bernier@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4391685, '2', '1', 'Bangladeshi', '738-432-6169 x7717', '6942 Fay Motorway\nNew Gageberg, NE 57493', 'Non voluptatibus omnis soluta et odio dolor. Cumque itaque delectus dolorum qui tempora dolorem est. Modi deleniti saepe consequatur repudiandae.', 'https://lorempixel.com/640/480/?29961', 1, NULL, 17, NULL, '6gTC1jgbRd', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 9, NULL, NULL, NULL, NULL),
(158, 'Mrs. Kathlyn Schneider', 'helmer.sauer@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5128255, '1', '1', 'Bangladeshi', '+16425493314', '47095 Okuneva Trail\nVadaside, NM 46284-7296', 'Vitae dolor odit quisquam voluptas. Sapiente dignissimos velit quibusdam impedit porro aliquid dolore. Non itaque voluptas facere error voluptas sunt deleniti.', 'https://lorempixel.com/640/480/?53275', 1, NULL, 12, NULL, 'iMBUxgLiBs', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(159, 'Mrs. Graciela Franecki DVM', 'deshaun.crist@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7505116, '1', '1', 'Bangladeshi', '1-582-936-3828 x365', '327 Murphy Grove\nNorth Delores, MD 68197-4385', 'Reprehenderit ducimus vel sunt mollitia corporis nostrum. Dignissimos consequatur iste ab id aut. Aut animi quia quae eligendi corporis mollitia unde est.', 'https://lorempixel.com/640/480/?62383', 1, NULL, 20, NULL, 'o9Ng9arQVy', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 9, NULL, NULL, NULL, NULL),
(160, 'Dr. Kobe Jakubowski I', 'wolf.jackeline@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7920358, '2', '1', 'Bangladeshi', '864-713-4121 x6334', '4322 Lindgren Drives\nMarksburgh, AR 16536-1961', 'Totam molestiae neque illum amet rerum ullam quisquam labore. Atque modi voluptate dolorem voluptas minima ducimus. Error error esse esse similique quibusdam.', 'https://lorempixel.com/640/480/?55191', 1, NULL, 11, NULL, 'lUyjUxisb5', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(161, 'Mattie Ondricka III', 'oblanda@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 765807, '2', '1', 'Bangladeshi', '1-979-674-4481', '3656 Graham Brook Apt. 614\nNorth Kristina, PA 01000', 'Quod illum hic blanditiis beatae neque sit. In in facilis repudiandae quidem qui voluptas. Nesciunt adipisci perferendis perspiciatis quos ut quam omnis.', 'https://lorempixel.com/640/480/?32630', 1, NULL, 7, NULL, 'NmjJ1I41aN', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 6, NULL, NULL, NULL, NULL),
(162, 'Joe Harris', 'abagail48@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1954445, '1', '1', 'Bangladeshi', '950.290.7680 x02343', '79007 Walsh Greens\nPort Rasheedmouth, CT 69504-3394', 'Quidem alias omnis rerum exercitationem sit. Sint quibusdam dolore officia sequi fuga. Sunt voluptatem et iure commodi exercitationem libero.', 'https://lorempixel.com/640/480/?85068', 1, NULL, 1, NULL, 'ZgJ2JJiw5a', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 5, NULL, NULL, NULL, NULL),
(163, 'Domenic Fahey DVM', 'kaylah.stamm@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9148651, '1', '1', 'Bangladeshi', '(630) 620-4181', '1457 Cruickshank Loaf\nNew Elizaview, NC 25553-4309', 'Praesentium error vero est dolor inventore. Cumque quasi quia sint et nobis qui. Architecto animi doloribus sapiente distinctio fugiat quae.', 'https://lorempixel.com/640/480/?74426', 1, NULL, 12, NULL, 'jp89CHyX2x', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 2, NULL, NULL, NULL, NULL),
(164, 'Ms. Jaida Adams I', 'enos.dibbert@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7566505, '1', '1', 'Bangladeshi', '882.230.3493 x468', '3247 McClure Vista\nCarlieberg, ME 18037-2497', 'Tenetur ut voluptates qui deserunt officia rem aut. Ullam odit quibusdam eaque distinctio nobis laudantium quasi. Iusto accusantium consequatur excepturi.', 'https://lorempixel.com/640/480/?41663', 1, NULL, 3, NULL, 'dpe5BLS25p', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 4, NULL, NULL, NULL, NULL),
(165, 'Mrs. Eveline McLaughlin MD', 'carmella91@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9847622, '1', '1', 'Bangladeshi', '427.327.9382 x951', '45752 Kasandra Meadows\nEmilbury, ME 81391', 'Asperiores molestias atque provident autem. Sit qui ratione reiciendis natus. Voluptatum aspernatur cupiditate doloribus sequi dolorum.', 'https://lorempixel.com/640/480/?54175', 1, NULL, 19, NULL, 'zvQEPMfOBO', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 5, NULL, NULL, NULL, NULL),
(166, 'Sabryna Mayert', 'erempel@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3500098, '2', '1', 'Bangladeshi', '1-914-463-7912 x502', '25763 Kassandra Drives\nMannburgh, CA 06124-4148', 'Sapiente exercitationem temporibus eos sint ut. Deserunt aliquam illum eveniet animi. Qui accusantium minima debitis velit itaque.', 'https://lorempixel.com/640/480/?56999', 1, NULL, 20, NULL, 'w5kFRcKz43', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 2, NULL, NULL, NULL, NULL),
(167, 'Dr. Gabriel Moen V', 'kunde.anna@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6634034, '2', '1', 'Bangladeshi', '1-654-685-1021', '3829 Haleigh Orchard\nNorth Arjunland, WV 92105-5615', 'Et eveniet iste itaque at esse id. Et voluptatum repudiandae molestias voluptas inventore. Quia officiis veritatis quae accusantium officiis.', 'storage/FA20165757S/FA20165757H/2020/profile/iizBkNNGms3OUQOh2WmCkqwYttuRadEFP1LJUhXq.jpeg', 1, NULL, 2, NULL, 'HDOfGB5gBj', '2020-10-28 06:23:32', '2020-12-23 09:01:02', 5, NULL, NULL, NULL, NULL),
(168, 'Jazmyne Lowe', 'jrogahn@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3603271, '1', '1', 'Bangladeshi', '387-838-6040', '82514 Angel Court Suite 133\nPort Adalberto, AR 33732', 'Nostrum numquam accusantium placeat repellat. Necessitatibus eligendi repudiandae occaecati. Et ipsa nisi corrupti animi cupiditate et unde.', 'https://lorempixel.com/640/480/?17992', 1, NULL, 1, NULL, 'eE6wmMfkQx', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 3, NULL, NULL, NULL, NULL),
(169, 'Mr. Waldo Bergstrom', 'roma.heathcote@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6633263, '1', '1', 'Bangladeshi', '(230) 200-6416 x2089', '687 Stroman Coves\nJeradhaven, PA 08228-4125', 'Aliquam velit enim veritatis perferendis accusantium sit. Enim cum cupiditate odio perspiciatis doloremque rerum recusandae. Quia eum nostrum et numquam sed.', 'https://lorempixel.com/640/480/?55075', 1, NULL, 19, NULL, 'f80HyO3V4W', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 3, NULL, NULL, NULL, NULL),
(170, 'Myrtice Koelpin', 'katlyn.mayert@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9918361, '2', '1', 'Bangladeshi', '+16983396427', '7961 Daphney Stream Suite 024\nTaureanhaven, AZ 44880', 'Qui quibusdam quas est alias. Fuga quis aut iure odit veritatis qui quae. Modi labore eius odio voluptatem est veritatis.', 'https://lorempixel.com/640/480/?23130', 1, NULL, 14, NULL, 'yA34xerMVo', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(171, 'Hortense Mante', 'cole.elvie@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2095451, '2', '1', 'Bangladeshi', '+1.616.645.0311', '417 Janice Mission\nAnissatown, LA 80615', 'Animi laborum aperiam velit tempora ullam. Quia eligendi ut ipsum voluptatem. Optio natus nesciunt velit commodi maxime.', 'https://lorempixel.com/640/480/?33320', 1, NULL, 9, NULL, 'yiaAAyhKMm', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 4, NULL, NULL, NULL, NULL),
(172, 'Dr. Easton Runolfsson', 'lakin.marietta@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2341800, '2', '1', 'Bangladeshi', '948-279-9020 x48643', '7321 Goldner Stream\nSouth Gladycefort, RI 81387-2193', 'Rerum recusandae vero voluptas qui exercitationem aut. Voluptates rerum veritatis perspiciatis. Iste veritatis ab ipsum dolor.', 'https://lorempixel.com/640/480/?93885', 1, NULL, 3, NULL, 'VSuqyWSq6N', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(173, 'Lilly Waters', 'ewilliamson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6318363, '1', '1', 'Bangladeshi', '1-992-444-3494 x193', '7383 Elena Fork Apt. 409\nReichertport, AL 19369-1147', 'Velit enim vel omnis fugiat. Aliquid ut unde rerum repudiandae tempore aut vel provident. Et aut expedita iste dolores sint non facilis.', 'https://lorempixel.com/640/480/?27061', 1, NULL, 2, NULL, 'xsb0EijM8N', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 6, NULL, NULL, NULL, NULL),
(174, 'Prof. Oda Lynch MD', 'ewalker@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8557557, '2', '1', 'Bangladeshi', '+15988358497', '294 Larson Bypass Apt. 671\nPort Abbietown, MS 37302-0320', 'Dolorum fugiat et error veniam. Accusantium dignissimos illum quibusdam ullam ipsum. A error soluta et non est fugiat.', 'https://lorempixel.com/640/480/?37799', 1, NULL, 13, NULL, 'LY5tv6umSo', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 5, NULL, NULL, NULL, NULL),
(175, 'Torrey Hamill', 'lkautzer@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4920151, '1', '1', 'Bangladeshi', '+1-353-747-8525', '14202 Koelpin Harbors\nNew Chesterside, AR 25768', 'Ipsa non eligendi quisquam repellendus qui. Sit ea eius dolor iste ad consequuntur fuga. Sed ipsam nobis eos quas.', 'https://lorempixel.com/640/480/?74354', 1, NULL, 5, NULL, 'qOZKhi8tph', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 7, NULL, NULL, NULL, NULL),
(176, 'Autumn Considine III', 'collins.willis@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 0, '0', 1, 20165757, 2626186, '2', '1', 'Bangladeshi', '826-955-9108', '423 Kirlin Stravenue Apt. 987\nBayerberg, VA 08612', 'Eaque eum nesciunt modi fugit. Sunt sapiente consequatur sit perspiciatis facere ipsa. Fuga et ut eligendi.', 'https://lorempixel.com/640/480/?90876', 1, NULL, 9, NULL, 'xCEqpZ7UjP', '2020-10-28 06:23:32', '2021-02-08 07:38:40', 2, NULL, NULL, NULL, NULL),
(177, 'Cleo Skiles', 'wbrown@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7978177, '2', '1', 'Bangladeshi', '(413) 603-8266', '12911 Winfield Union Apt. 127\nUliceston, WY 49651-5178', 'Dolor asperiores magnam dolore a optio nostrum. Dicta eum voluptas in esse. Suscipit aut aut corrupti culpa.', 'https://lorempixel.com/640/480/?47240', 1, NULL, 9, NULL, 'WJm2ZJpHfj', '2020-10-28 06:23:32', '2020-10-28 06:23:32', 4, NULL, NULL, NULL, NULL),
(178, 'Viva Medhurst', 'yasmin27@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8710656, '2', '1', 'Bangladeshi', '1-810-792-0275 x7683', '703 Casandra Wells Apt. 900\nSouth Winifred, TN 31515-4917', 'Corporis dolorem quibusdam accusamus minima explicabo libero tempore. Ullam sint qui voluptas. Sunt ut aut odit iusto earum.', 'https://lorempixel.com/640/480/?89040', 1, NULL, 20, NULL, '31opHqDUQ3', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 3, NULL, NULL, NULL, NULL),
(179, 'Prof. Marisa Kling I', 'krystina.roob@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2253136, '1', '1', 'Bangladeshi', '1-921-910-4324', '3258 Scottie Isle\nPredovicmouth, KS 07379-8715', 'Quia qui voluptate commodi porro qui in quia odit. Tempora incidunt et quia vero omnis cupiditate accusantium. Praesentium omnis ullam voluptate vel mollitia.', 'https://lorempixel.com/640/480/?95584', 1, NULL, 16, NULL, '0wKUeHUz2u', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 6, NULL, NULL, NULL, NULL),
(180, 'Mr. Kadin Rutherford IV', 'rhiannon.hills@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1934274, '1', '1', 'Bangladeshi', '646.850.5339', '28831 Shanon Centers\nWest Ceasarton, WV 38093-8157', 'Dolorem nobis adipisci nobis expedita aliquid voluptas. Doloribus et quas placeat. Non dolores minus earum aut.', 'https://lorempixel.com/640/480/?73175', 1, NULL, 12, NULL, 'w6zNldXYuJ', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 5, NULL, NULL, NULL, NULL),
(181, 'Victor Ondricka', 'jeffery.macejkovic@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8479354, '2', '1', 'Bangladeshi', '296.859.5884 x432', '3841 Ziemann Viaduct Apt. 903\nSchuylerstad, MA 28593-9570', 'Error laboriosam aut dolore. Odit corrupti vel voluptas sed vel. Error ad occaecati et quia qui et sed.', 'https://lorempixel.com/640/480/?42927', 1, NULL, 4, NULL, 'ztNAG6AORq', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 4, NULL, NULL, NULL, NULL),
(182, 'Eugenia Shanahan', 'antoinette.gusikowski@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2575463, '1', '1', 'Bangladeshi', '1-961-569-5701 x989', '50100 Hayes Greens\nNorth Sandra, PA 25506', 'Qui excepturi sit molestiae dignissimos quam ipsa nulla nam. Molestias odio aperiam fugiat sed veniam inventore in. Nisi voluptate commodi doloremque voluptatem.', 'https://lorempixel.com/640/480/?27654', 1, NULL, 7, NULL, 'oK6xasRjG2', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 2, NULL, NULL, NULL, NULL),
(183, 'Dr. Bradley Predovic', 'queenie.smitham@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5053139, '2', '1', 'Bangladeshi', '+1 (885) 593-4884', '6034 Lubowitz Forest Suite 156\nEast Ebbaview, CA 69198', 'Rerum iure vel quam recusandae inventore quas. Quam est illo ratione et culpa ad. Quia ratione nesciunt quia commodi.', 'https://lorempixel.com/640/480/?91633', 1, NULL, 6, NULL, 'KErrbximXN', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 8, NULL, NULL, NULL, NULL),
(184, 'Mason Stroman', 'rhansen@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5096814, '2', '1', 'Bangladeshi', '447.330.8868 x85768', '984 Russel Haven Apt. 040\nHillview, MT 70286-4474', 'Quisquam id ullam hic voluptate. Est doloremque laborum facere facere sunt rerum. Est itaque nesciunt qui et eos.', 'https://lorempixel.com/640/480/?73144', 1, NULL, 6, NULL, 'Wp8W3AuMxt', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 8, NULL, NULL, NULL, NULL),
(185, 'Elody Tromp DDS', 'abechtelar@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6949307, '2', '1', 'Bangladeshi', '836-739-1866 x6340', '72641 Reyna Creek Suite 804\nOrlandberg, RI 91184', 'Repudiandae ut ad beatae soluta. Maxime excepturi dolorem optio omnis. Repellat sint rerum aut pariatur.', 'https://lorempixel.com/640/480/?92275', 1, NULL, 18, NULL, 'aUg8bWb5Vp', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 8, NULL, NULL, NULL, NULL),
(186, 'Lilly Welch', 'tracey.rodriguez@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3550635, '2', '1', 'Bangladeshi', '637-251-0400', '15416 Lind Wells\nEast Adelbertstad, CA 98968', 'In vitae molestiae qui. Non quis est laudantium temporibus consectetur. Accusamus aperiam iure quia itaque.', 'https://lorempixel.com/640/480/?45992', 1, NULL, 2, NULL, 'qcRcvHcy9R', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 9, NULL, NULL, NULL, NULL),
(187, 'Makenna Roob', 'kthompson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2136437, '1', '1', 'Bangladeshi', '(880) 981-7413 x7521', '8714 Cruickshank Drive Apt. 794\nStuartfort, NC 15918-7803', 'Aut sint vel optio ipsa. Praesentium eveniet rerum et in ea. Et est est sapiente.', 'https://lorempixel.com/640/480/?70634', 1, NULL, 16, NULL, 'PqQNKf7izQ', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 5, NULL, NULL, NULL, NULL),
(188, 'Jamir Hodkiewicz', 'casper.hill@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5775736, '2', '1', 'Bangladeshi', '(708) 294-9922 x362', '155 Mitchell Dam Suite 806\nSouth Enosborough, ID 81090-9400', 'Sed eos ipsum velit sunt delectus illo. Amet ut voluptatum doloribus exercitationem et id adipisci. Deserunt autem iure omnis corrupti.', 'https://lorempixel.com/640/480/?41305', 1, NULL, 20, NULL, 'SehaHzlxUi', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 6, NULL, NULL, NULL, NULL),
(189, 'Mufutau Church', 'fuqunaci@mailinator.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1472001, '1', '1', '', '+1 (239) 343-7591', 'Ullamco quasi commod', 'Aliquam vitae et qui', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/SP/1608787077.png', 1, NULL, 18, NULL, 'W9kshHedrB', '2020-10-28 06:23:33', '2020-12-28 10:02:20', 1, NULL, NULL, NULL, NULL),
(190, 'Dr. Nick Welch IV', 'ybauch@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 715922, '1', '1', 'Bangladeshi', '1-640-800-9777 x2859', '62825 Breitenberg Crescent Suite 835\nLake Brionnabury, CT 93877-7384', 'Cupiditate assumenda inventore et nisi et sint laudantium. Ut deleniti error quis tempora sint. Velit tenetur nam sunt vitae.', 'https://lorempixel.com/640/480/?38793', 1, NULL, 15, NULL, 'P9P4QRebO8', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 10, NULL, NULL, NULL, NULL),
(191, 'Ulices Greenholt', 'blangworth@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3466003, '2', '1', 'Bangladeshi', '+1 (814) 304-9221', '489 Medhurst Lane\nNorth Neomaview, WY 88903', 'Dolorum aut odio a harum occaecati aut ut corrupti. Facilis quia natus deserunt praesentium dolorum doloribus. Necessitatibus eos fuga illum necessitatibus.', 'https://lorempixel.com/640/480/?97911', 1, NULL, 5, NULL, 'SgthwISu2A', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 9, NULL, NULL, NULL, NULL),
(192, 'Novella Stracke', 'fsauer@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2595401, '1', '1', 'Bangladeshi', '+1-838-921-7921', '9374 Glenda Lake\nEast Leonardo, MT 92188', 'Quo enim voluptatem et ut. Explicabo debitis laborum non qui sunt tempora recusandae fugit. Aliquid itaque vel dolorem et molestias eligendi non.', 'https://lorempixel.com/640/480/?63561', 1, NULL, 3, NULL, 'ztDH3ptPz5', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 2, NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `role_title`, `active`, `isSuper`, `school_id`, `code`, `student_code`, `gender`, `blood_group`, `nationality`, `phone_number`, `address`, `about`, `pic_path`, `verified`, `email_verified_at`, `section_id`, `assign_school`, `remember_token`, `created_at`, `updated_at`, `department_id`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(193, 'Evelyn Jacobs', 'tremblay.dolores@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6326221, '2', '1', 'Bangladeshi', '318-353-3087', '683 Maiya Spur Apt. 264\nSouth Kaylee, NE 94693', 'Quia quibusdam adipisci aliquam exercitationem sunt et recusandae officiis. Eligendi iure assumenda sint error. Inventore ea architecto quo itaque qui quae maxime.', 'https://lorempixel.com/640/480/?94998', 1, NULL, 4, NULL, 'HrOquYs8jW', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 9, NULL, NULL, NULL, NULL),
(194, 'Ms. Luz Stokes', 'ohintz@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5495103, '1', '1', 'Bangladeshi', '541.587.2808 x118', '491 Lilla Rapids\nNorth Amira, NE 95852', 'Omnis magni esse tenetur provident eius reprehenderit. Est tenetur itaque quasi. Quaerat vel omnis officia ullam sed dolor.', 'https://lorempixel.com/640/480/?17032', 1, NULL, 4, NULL, '4p9AWuPZJI', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 7, NULL, NULL, NULL, NULL),
(195, 'Dr. Hayley Macejkovic I', 'verona33@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 187731, '2', '1', 'Bangladeshi', '990.352.1633 x5298', '64638 Pacocha Well Suite 760\nNew Tomborough, RI 47654', 'Delectus amet sapiente magnam. Sapiente id sunt vel ducimus non esse eum voluptas. Amet eum placeat nemo eius aliquid dignissimos tempore magni.', 'https://lorempixel.com/640/480/?98287', 1, NULL, 14, NULL, 'RRf9mM3XfR', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 7, NULL, NULL, NULL, NULL),
(196, 'Jairo Nolan', 'thahn@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 463319, '2', '1', 'Bangladeshi', '(868) 690-1560 x04796', '62683 Pagac Lodge Apt. 939\nEast Agustinastad, NC 62038', 'Nisi praesentium quia consequatur totam dolores. Fuga repudiandae non itaque amet et. Eum vitae doloremque incidunt culpa sit.', 'https://lorempixel.com/640/480/?21259', 1, NULL, 7, NULL, 'vRO4suJVgQ', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 7, NULL, NULL, NULL, NULL),
(197, 'Makayla Franecki', 'norn@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3664500, '2', '1', 'Bangladeshi', '1-708-854-2221 x77817', '6540 Ted Estate\nNorth Joanne, MO 43778-0931', 'Pariatur aut corrupti ipsum velit. Quos et iure consequatur velit corporis aut omnis. Ipsam provident numquam odio repudiandae.', 'https://lorempixel.com/640/480/?75304', 1, NULL, 15, NULL, 'l52prBcsfY', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 2, NULL, NULL, NULL, NULL),
(198, 'Prof. Kelley Hayes', 'eschulist@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9795860, '2', '1', 'Bangladeshi', '546-464-2849 x7608', '19645 Demond Manors\nRaleighchester, AL 52526', 'Nemo fugiat assumenda aspernatur adipisci aperiam quia nulla recusandae. Qui officiis iure aliquam eum nihil accusantium. Repellendus accusantium iure qui temporibus nemo eum.', 'https://lorempixel.com/640/480/?63851', 1, NULL, 19, NULL, 'g3Pbkxj8Q6', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 8, NULL, NULL, NULL, NULL),
(199, 'Dr. Kristian Pagac', 'aletha.abbott@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9894766, '1', '1', 'Bangladeshi', '+14139202765', '1749 Kulas Points Apt. 477\nEast Velvaberg, VA 83339-2787', 'Et error temporibus non alias. Ea rem aliquam explicabo animi est nemo dolores. Aperiam quod rerum qui temporibus voluptatum earum.', 'https://lorempixel.com/640/480/?14713', 1, NULL, 14, NULL, 'eyypgJ9Kp5', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 7, NULL, NULL, NULL, NULL),
(200, 'Mrs. Linnie Parker Jr.', 'zieme.anabel@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6981525, '2', '1', 'Bangladeshi', '1-886-932-8284 x510', '7919 Nolan Track\nSchmelershire, IL 03365-3553', 'Hic fuga est qui. Aperiam aut nobis ex id laboriosam voluptatem. Commodi quis nesciunt est ratione fuga.', 'https://lorempixel.com/640/480/?41079', 1, NULL, 10, NULL, 'ib4CagQEfh', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 7, NULL, NULL, NULL, NULL),
(201, 'Keshawn Sawayn Jr.', 'dickens.etha@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5486484, '1', '1', 'Bangladeshi', '1-306-367-7453 x18834', '409 Kulas Lake\nPort Rockyfurt, LA 00383-3062', 'Dignissimos hic qui atque consectetur in delectus et. Quae ut ut veniam non voluptatibus. Temporibus culpa architecto aut nesciunt dicta consectetur.', 'https://lorempixel.com/640/480/?33500', 1, NULL, 3, NULL, 'w9hwlBjWwt', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 6, NULL, NULL, NULL, NULL),
(202, 'Theresia Kuhic', 'rhea.conroy@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1247928, '1', '1', 'Bangladeshi', '1-942-942-8011 x63515', '20870 Beahan Stream Apt. 216\nSolonland, KY 92067', 'Numquam nemo fugiat aut a sint. Repudiandae labore expedita aut sint voluptatem dolor. Ut officiis accusantium error.', 'https://lorempixel.com/640/480/?84556', 1, NULL, 18, NULL, 'XafftDVJup', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 1, NULL, NULL, NULL, NULL),
(203, 'Taurean Kautzer III', 'jast.ned@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2544393, '1', '1', 'Bangladeshi', '201.561.3673', '5682 Ortiz Bypass Suite 871\nNew Mario, MD 72864-7034', 'Esse expedita repellat in placeat earum voluptas. Est qui impedit nam quo architecto. Tenetur aliquam rerum eaque porro reprehenderit architecto.', 'https://lorempixel.com/640/480/?16690', 1, NULL, 5, NULL, 'O1w0hjOZ1M', '2020-10-28 06:23:33', '2020-10-28 06:23:33', 1, NULL, NULL, NULL, NULL),
(204, 'Jerel Roob II', 'elissa.kling@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 736108, '2', '1', 'Bangladeshi', '871.367.9485', '4267 Hand Summit Suite 100\nRaeganbury, CT 34387', 'Delectus magni id mollitia nisi. Voluptatem perferendis quia sint. Provident omnis laudantium distinctio eos aperiam amet qui.', 'https://lorempixel.com/640/480/?26606', 1, NULL, 4, NULL, 'smfhPUjaUU', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 1, NULL, NULL, NULL, NULL),
(205, 'Mollie Cole', 'rita.king@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7459388, '2', '1', 'Bangladeshi', '721.814.6909', '454 Nader Extension Apt. 016\nSiennaside, VT 51453', 'Alias aut eos dicta magnam. Velit accusantium et molestias quam. Ea et ex voluptas quod eaque.', 'https://lorempixel.com/640/480/?66566', 1, NULL, 10, NULL, '7cOnllisEe', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 2, NULL, NULL, NULL, NULL),
(206, 'Dr. Bennie Hand V', 'rosalia.rohan@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4620166, '1', '1', 'Bangladeshi', '+14794561410', '521 Madison Glen Apt. 388\nNorth Antwonchester, ND 11055', 'Ipsa qui expedita officia. Et est et delectus omnis qui qui enim. Voluptas exercitationem nostrum maiores esse rerum quam.', 'https://lorempixel.com/640/480/?29719', 1, NULL, 1, NULL, 'YTOXw5YRp6', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 5, NULL, NULL, NULL, NULL),
(207, 'Elza Harris', 'ferry.rahul@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9115314, '2', '1', 'Bangladeshi', '(354) 735-0608 x11657', '3604 Gusikowski Plaza Apt. 843\nKeonland, MI 18906-3718', 'Aut accusamus voluptatem provident numquam sapiente impedit ex. Odio occaecati soluta cumque fuga id quaerat et. Deserunt sit ut repellat inventore.', 'https://lorempixel.com/640/480/?20549', 1, NULL, 14, NULL, 'BVWhhXOzQO', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(208, 'Steel Mcgowan', 'bojilecy@mailinator.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9233577, '1', '1', '', '+1 (848) 567-5353', 'Commodo sed rerum au', 'Repellendus Id ass', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/SP/1609309618.png', 1, NULL, 2, NULL, 'vYne28pD8r', '2020-10-28 06:23:34', '2021-01-05 10:06:23', 5, NULL, NULL, NULL, NULL),
(209, 'Ms. Aiyana Hermann III', 'corbin28@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1017422, '2', '1', 'Bangladeshi', '346.674.4294 x4749', '43043 Brock Glen Suite 819\nUliceston, MS 67643-6599', 'Ea repellendus est quo nemo. Quaerat fugiat sit eveniet rerum accusantium accusantium. Dolores saepe incidunt voluptas amet.', 'https://lorempixel.com/640/480/?55066', 1, NULL, 3, NULL, 'G4Jj5vnmic', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(210, 'Prudence Kiehn', 'spencer.johnnie@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 999049, '2', '1', 'Bangladeshi', '(946) 246-5835 x9791', '1373 Veum Pine\nNew Alfred, MI 86785-3907', 'Labore tenetur error eaque nemo labore. Ad explicabo quia suscipit temporibus. Eos nisi laborum sint magnam magni.', 'https://lorempixel.com/640/480/?16075', 1, NULL, 17, NULL, 'Qp2kOnflzU', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 4, NULL, NULL, NULL, NULL),
(211, 'Dulce Walsh', 'judah.runolfsdottir@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2545104, '1', '1', 'Bangladeshi', '1-997-343-9848', '63465 Luna Dam Apt. 054\nKleinhaven, AZ 70529-2615', 'Ex aliquam est harum porro. Cum quis sequi aut omnis consequuntur id voluptatem. Fuga alias alias odit.', 'https://lorempixel.com/640/480/?64467', 1, NULL, 7, NULL, 'MpEcY2Ijc7', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(212, 'Flo Raynor', 'harber.zechariah@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1112870, '2', '1', 'Bangladeshi', '313-778-9141 x4745', '3454 Braeden Summit\nGibsonborough, IL 44517-8643', 'Enim similique odit quam nihil sed porro sint. Et aliquam eum deserunt totam necessitatibus numquam officia. Non alias quibusdam illo consequuntur ut pariatur laudantium delectus.', 'https://lorempixel.com/640/480/?31531', 1, NULL, 1, NULL, 'D9kM6fsYyV', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 1, NULL, NULL, NULL, NULL),
(213, 'Chasity Wilderman', 'lolita.roob@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4370726, '2', '1', 'Bangladeshi', '1-863-274-1167', '402 Precious Forge Suite 391\nHalvorsontown, HI 60125', 'Saepe et qui ut neque similique. Id laboriosam in veritatis sit. Quae reprehenderit incidunt iste consequatur quasi ut commodi quaerat.', 'https://lorempixel.com/640/480/?36663', 1, NULL, 11, NULL, 'Kg8z19TymT', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 7, NULL, NULL, NULL, NULL),
(214, 'Miss Aurore Schultz DDS', 'schneider.delta@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8323592, '1', '1', 'Bangladeshi', '924-273-6262 x66132', '27902 Dorcas Knoll\nSouth Gianni, TN 23677', 'Velit incidunt est eligendi est et minus rem. Ut debitis reiciendis quia blanditiis et aliquid. Quia exercitationem dolores nobis quia mollitia vel qui.', 'https://lorempixel.com/640/480/?39781', 1, NULL, 18, NULL, 'IIGNvs55jJ', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 2, NULL, NULL, NULL, NULL),
(215, 'Dr. Brycen Dicki', 'arlie01@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 336996, '1', '1', 'Bangladeshi', '(253) 237-1513 x73332', '7483 Talon Crossroad\nDeltaburgh, TN 30699', 'Nihil animi voluptates sed nihil ipsa. Ad aut odit distinctio odit ut qui. Occaecati exercitationem autem necessitatibus mollitia.', 'https://lorempixel.com/640/480/?76306', 1, NULL, 7, NULL, 'fzmcHMZIzu', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 5, NULL, NULL, NULL, NULL),
(216, 'Orie Oberbrunner', 'ottilie.willms@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6284574, '2', '1', 'Bangladeshi', '621.614.4810 x4557', '5178 Wisozk Village Apt. 136\nRicefurt, ND 43081', 'Adipisci sit fuga reprehenderit necessitatibus. Dolores ut nam ad quisquam. Quia inventore qui non minima possimus dolore sapiente.', 'https://lorempixel.com/640/480/?42838', 1, NULL, 8, NULL, 'u6Bju90U4l', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 5, NULL, NULL, NULL, NULL),
(217, 'Miss Josie Price DVM', 'kconroy@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9895888, '2', '1', 'Bangladeshi', '1-594-425-6169 x09186', '129 Considine Trail Suite 468\nPort Emmanuelle, VA 39130', 'Expedita qui quam neque aut ad fuga. Nihil ipsa sit et. Sint et dignissimos sed qui quos.', 'https://lorempixel.com/640/480/?71626', 1, NULL, 6, NULL, '582JXQcBC7', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(218, 'Caleb Moore', 'damaris.willms@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1981001, '2', '1', 'Bangladeshi', '1-676-660-7013 x5888', '22990 Frami Corners Suite 311\nJarrodshire, MS 13884-9785', 'Animi nisi sunt sint. Voluptatem quaerat laborum minus dolorum cupiditate voluptatem. Sed nobis perspiciatis et assumenda doloremque et.', 'https://lorempixel.com/640/480/?12373', 1, NULL, 12, NULL, 'nxlFkKK7KZ', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(219, 'Aaron Brakuszzzzzzzzzz', 'xschiller@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 0, '0', 1, 20165757, 2686056, '2', '1', '', '707.480.3776 x16251', '57033 Bryon VillagesWest Broderickmouth, FL 87296', 'Eveniet ut numquam aperiam quis. Dolorem iusto eos voluptas iure ut facilis laboriosam. Excepturi consectetur necessitatibus vero enim. dfdf', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/SP/1609321244.png', 1, NULL, 15, NULL, 'V2sClF5rcv', '2020-10-28 06:23:34', '2021-01-05 10:03:58', 1, NULL, NULL, NULL, NULL),
(220, 'Kennedy Will', 'marvin.ada@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9142896, '1', '1', 'Bangladeshi', '642-379-8752', '79571 Koch Street\nSouth Valentin, GA 22282', 'Et in enim voluptatibus harum a error sed. Rem animi minus sed qui. Quidem sit quia et aperiam animi dolorum.', 'https://lorempixel.com/640/480/?65111', 1, NULL, 4, NULL, '83koKqfIck', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 6, NULL, NULL, NULL, NULL),
(221, 'Baylee Bahringer', 'jaren.ortiz@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3904042, '1', '1', 'Bangladeshi', '1-695-937-7505', '292 O&#039;Hara Island Apt. 369\nStokesbury, MN 55025', 'Illo nisi aut eius dolorem. Aspernatur in est consequatur fugit veniam. Voluptas blanditiis minus earum.', 'https://lorempixel.com/640/480/?52677', 1, NULL, 9, NULL, 'XEZrXm2BX2', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 3, NULL, NULL, NULL, NULL),
(222, 'Mark Thiel', 'schuster.ludie@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6296949, '1', '1', 'Bangladeshi', '940-334-1014', '73405 Johnson Grove Apt. 756\nSengerchester, IN 96182-3716', 'Accusantium ipsam alias expedita odio aut deleniti vel. Ut minima minima in iure ipsum omnis suscipit. Eius voluptas quo laboriosam nihil repudiandae culpa distinctio.', 'https://lorempixel.com/640/480/?60198', 1, NULL, 13, NULL, 'tj6icvajMb', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 10, NULL, NULL, NULL, NULL),
(223, 'Violet Bins', 'huels.lester@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7382418, '1', '1', 'Bangladeshi', '(394) 295-2079 x5760', '15712 Lillian Causeway\nPort Lemuel, NV 29746-7691', 'Aperiam veritatis ex aspernatur. Molestiae non adipisci id laborum neque. Architecto qui eum nemo aut ullam.', 'https://lorempixel.com/640/480/?69793', 1, NULL, 8, NULL, 'oGNXJbKxAO', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 10, NULL, NULL, NULL, NULL),
(224, 'Dr. Nona Gusikowski', 'xbartoletti@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1358192, '2', '1', 'Bangladeshi', '1-830-961-5245', '56544 Keebler Union\nWest Edmundmouth, NM 86902', 'Quam odio cumque vitae a quae nam. Alias voluptatem laboriosam culpa est magnam quisquam aut. Quidem voluptas molestias asperiores nostrum inventore id numquam.', 'https://lorempixel.com/640/480/?69435', 1, NULL, 14, NULL, 'hwzepmyD6S', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 4, NULL, NULL, NULL, NULL),
(225, 'Ryley Wiza', 'ronny.kohler@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5954685, '1', '1', 'Bangladeshi', '(713) 953-3491 x0415', '77235 Sydni Courts\nWest Georgetteside, AR 68675-6363', 'Distinctio quos quia placeat qui soluta vel eaque. Ipsam sequi ut perferendis culpa consequatur dolores. Dolor nobis facilis ut nulla et omnis dolor.', 'https://lorempixel.com/640/480/?51237', 1, NULL, 19, NULL, 'OTlWj7MhAb', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 10, NULL, NULL, NULL, NULL),
(226, 'Javonte Farrell', 'jamey21@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3860102, '2', '1', 'Bangladeshi', '205.309.0035 x2680', '77311 Murray Burgs\nAbbottborough, IL 86664-7947', 'Repellendus provident ut eius eveniet et ullam est praesentium. Alias id consectetur rerum suscipit minima rerum dolores. Rerum sint unde blanditiis quos ea.', 'https://lorempixel.com/640/480/?71566', 1, NULL, 3, NULL, 'caWm9OZcfn', '2020-10-28 06:23:34', '2020-10-28 06:23:34', 8, NULL, NULL, NULL, NULL),
(227, 'Aryanna Stanton', 'doyle35@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 0, '0', 1, 20165757, 4887241, '2', '1', '', '+1 (746) 686-3216', '91182 Kianna RanchLake Laurianne, AL 98282', 'Voluptatem similique aut totam nulla. Autem dolorem consequatur amet. Et doloremque sint reprehenderit sed eligendi velit.', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/SP/1609327280.png', 1, NULL, 8, NULL, 'nIz3G1w8z8', '2020-10-28 06:23:35', '2021-02-08 07:38:27', 3, NULL, NULL, NULL, NULL),
(228, 'Mrs. Yvette Bradtke', 'marvin.ray@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2281988, '2', '1', 'Bangladeshi', '296-637-6670 x52979', '716 Pagac Meadow\nEast Alfredbury, AZ 81707-8964', 'In error molestiae et dolor nihil omnis dolor incidunt. Aspernatur ab eaque in autem. Ut est consectetur eaque modi omnis ut.', 'https://lorempixel.com/640/480/?96185', 1, NULL, 9, NULL, 'uUIztQ6yhU', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 7, NULL, NULL, NULL, NULL),
(229, 'Gilbert Ebert', 'kallie.orn@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1079270, '2', '1', 'Bangladeshi', '+1.606.769.7257', '800 Gorczany Bridge Suite 253\nSouth Leora, MO 05328', 'Nesciunt similique quasi occaecati sequi fugit. Optio minus maiores deserunt est ut repellendus esse. Explicabo enim ipsam est sunt qui natus.', 'https://lorempixel.com/640/480/?52865', 1, NULL, 1, NULL, 'itXrzY2hHa', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 5, NULL, NULL, NULL, NULL),
(230, 'Gertrude Tromp', 'erdman.adell@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 59882, '1', '1', 'Bangladeshi', '1-221-843-9638 x653', '1132 Eulah Ports Suite 125\nNew Robbie, AL 16981', 'Qui ut eos et sit. Dignissimos alias blanditiis et nihil fugit non et non. Ut illum odio quasi repudiandae tempore molestiae molestiae.', 'https://lorempixel.com/640/480/?17408', 1, NULL, 1, NULL, 'ztU458pnOW', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(231, 'Athena Von', 'marian99@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 0, '0', 1, 20165757, 5440791, '1', '1', 'Bangladeshi', '637.733.7023 x32151', '4014 Bosco Loop Suite 235\nCharlenemouth, HI 74209', 'Eum optio mollitia quia vero incidunt ut quo. Accusantium rerum unde facere perferendis deleniti delectus. Rerum rerum voluptas in exercitationem et voluptatum nobis fugit.', 'https://lorempixel.com/640/480/?80200', 1, NULL, 17, NULL, 'NN2qaCzFhT', '2020-10-28 06:23:35', '2021-02-08 07:38:34', 9, NULL, NULL, NULL, NULL),
(232, 'Imelda Jacobi', 'roob.maryse@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6486656, '1', '1', 'Bangladeshi', '(652) 726-5715 x2158', '121 Cummings Village\nEast Rafaela, OK 53646', 'Distinctio aut error consequuntur accusantium. Omnis nostrum aut officia et. Consequatur unde et illo eos atque fuga inventore.', 'https://lorempixel.com/640/480/?69372', 1, NULL, 8, NULL, 'oZKH8kER6b', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 6, NULL, NULL, NULL, NULL),
(233, 'Jacinthe Lakin', 'ngraham@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7883688, '1', '1', 'Bangladeshi', '1-741-490-6385', '78238 Lebsack Heights\nLake Emmyshire, WV 35366', 'Rem qui quas provident vel quaerat excepturi. Quis ut aut pariatur ut fugit laudantium et voluptatem. Corporis illo et consequatur qui.', 'https://lorempixel.com/640/480/?51510', 1, NULL, 7, NULL, '0lCpMLzslf', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 9, NULL, NULL, NULL, NULL),
(234, 'Miss Savannah Nitzsche', 'cgoldner@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 2236945, '1', '1', 'Bangladeshi', '246.830.4338', '7311 Botsford Estates\nLehnerhaven, CA 44112', 'Est sed eligendi repellendus. Quaerat distinctio autem hic accusantium magni expedita. Autem velit voluptates deleniti dolor.', 'https://lorempixel.com/640/480/?85487', 1, NULL, 14, NULL, 'JYoTZJ0Arx', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 3, NULL, NULL, NULL, NULL),
(235, 'Eulah Schulist', 'moen.mayra@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5409127, '1', '1', 'Bangladeshi', '834.269.1089 x179', '622 Joelle Plaza\nEast Maye, LA 35769', 'Quaerat non error repellat cumque aliquam sint. Reiciendis quia soluta magnam qui nam. Aut ut autem laboriosam magni.', 'https://lorempixel.com/640/480/?85022', 1, NULL, 10, NULL, 'S1h4i5CFW3', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 10, NULL, NULL, NULL, NULL),
(236, 'Delilah Herman', 'student@demo.com', '$2y$10$KHKhsxIkbizqJUTiIS0jbeYoIlmqydEteAHihVc0ZUXjmKjeBHB7y', 'student', NULL, 1, '0', 1, 20165757, 5025060, '2', '1', 'Bangladeshi', '613-774-1399', '1962 Grant Lodge Suite 189\nNorth Kenyattamouth, ID 67552-4989', 'Quos tenetur veniam optio qui dolorem. Nihil laboriosam et aperiam vel aliquam ut. Tenetur quia dolorem ipsum quis quia aliquam modi.', 'https://lorempixel.com/640/480/?67407', 1, NULL, 10, NULL, 'rOjAf5Lw1o6frPzNi7FNZgHxyc7JQA6xRjHuBXaG5NXCSSyPZY0zC5Hbzwsw', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 10, NULL, NULL, NULL, NULL),
(237, 'Prince Hammes', 'obednar@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 9774859, '1', '1', 'Bangladeshi', '1-401-736-7922 x59851', '381 Jerry Street Suite 327\nCooperstad, MA 30722-8859', 'Itaque ad dolorem at maiores qui. Ut maiores repellat voluptates non explicabo quia. Minus in officiis eligendi sunt et.', 'https://lorempixel.com/640/480/?84335', 1, NULL, 15, NULL, 's3Adhk4wwV', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 8, NULL, NULL, NULL, NULL),
(238, 'Trisha Torp', 'uwunsch@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1298946, '1', '1', 'Bangladeshi', '(695) 630-0539 x9025', '52869 Lisandro Oval\nUrsulatown, AK 12404-1452', 'Quidem vitae deleniti laborum id nam nesciunt eos. Dolorem et dolor enim et iste ducimus. Sed itaque perferendis earum est consequuntur eos.', 'https://lorempixel.com/640/480/?12920', 1, NULL, 1, NULL, 'yxq4vf5dbL', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 6, NULL, NULL, NULL, NULL),
(239, 'Russel Jakubowski', 'adicki@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3016064, '2', '1', 'Bangladeshi', '(821) 823-2203 x43394', '809 Kathryn Cliff Apt. 716\nNorth Garland, SD 28773', 'Iure ut quia qui voluptatem voluptatum. Cum dolore suscipit autem enim. Qui praesentium quia nam ducimus non repellendus.', 'https://lorempixel.com/640/480/?24809', 1, NULL, 17, NULL, 'qR5YeWyGap', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 10, NULL, NULL, NULL, NULL),
(240, 'Lamont O&#039;Keefe', 'lehner.thaddeus@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5293452, '1', '1', 'Bangladeshi', '812.877.8790 x16249', '1207 Mante Glen\nLake Billyberg, GA 03398', 'Debitis nemo ut et. Ea in culpa quo non itaque debitis. In impedit dolorum nam earum earum veritatis.', 'https://lorempixel.com/640/480/?68737', 1, NULL, 15, NULL, 'tqzOjNogPh', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 3, NULL, NULL, NULL, NULL),
(241, 'Prof. Abe Altenwerth', 'hortense18@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7606811, '2', '1', 'Bangladeshi', '+1 (862) 443-4257', '60067 Wolff Flats Suite 960\nLake Arelyland, MO 98722-9544', 'Minus autem quos laudantium. Voluptas ipsum consequuntur ut maiores ut rerum. Doloribus at sint similique corporis ut.', 'https://lorempixel.com/640/480/?64653', 1, NULL, 12, NULL, 'XIqZKA4diF', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 8, NULL, NULL, NULL, NULL),
(242, 'Mr. Paxton Swaniawski Sr.', 'kharris@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1798077, '2', '1', 'Bangladeshi', '(231) 966-4412 x81631', '975 Schuppe Harbor Suite 541\nNew Fredyfort, MD 62528-4951', 'Modi tempore adipisci et molestias delectus. Exercitationem voluptatem vel tenetur occaecati itaque praesentium. Eos aspernatur ut architecto distinctio.', 'https://lorempixel.com/640/480/?64224', 1, NULL, 6, NULL, 'lxiakRaBva', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 5, NULL, NULL, NULL, NULL),
(243, 'Cesar Corkery', 'claude15@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 1076681, '1', '1', 'Bangladeshi', '(801) 998-8634 x9882', '80877 Aditya Fall\nEast Brendaborough, WA 27720', 'Consequatur placeat in qui qui suscipit aut. Aliquam qui laboriosam suscipit recusandae quibusdam ipsam. Necessitatibus harum qui omnis aut.', 'https://lorempixel.com/640/480/?22927', 1, NULL, 11, NULL, 'iGCz3SjyZ9', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(244, 'Ms. Macie Conroy Jr.', 'fshields@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3821490, '2', '1', 'Bangladeshi', '729-814-9498 x62207', '23708 Graham Glens\nSpinkaborough, VA 17423-1073', 'Veritatis minus cumque enim veritatis et illum inventore. Id beatae sequi ut qui ipsa dolorem ipsa. Sunt similique qui voluptas harum.', 'https://lorempixel.com/640/480/?39763', 1, NULL, 16, NULL, 'eaxxVLy4Ac', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(245, 'Mona Cremin', 'bennett.denesik@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6975366, '1', '1', 'Bangladeshi', '1-628-665-4124', '2851 Valentin Meadow\nNorth Sister, ME 15676-0754', 'Nostrum ab eveniet autem ut quaerat veniam. Ut est sapiente consequuntur corrupti fugit. Debitis vel hic rem.', 'https://lorempixel.com/640/480/?53877', 1, NULL, 13, NULL, 'aa8GxIldmv', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(246, 'Zoe Yost', 'bbosco@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6060777, '2', '1', 'Bangladeshi', '302.565.7996 x3782', '43507 Wilhelmine Brooks\nRoxaneborough, ND 52801', 'In consequuntur omnis impedit. Sequi laudantium aut molestias. Aut veritatis suscipit ea velit molestiae ex.', 'https://lorempixel.com/640/480/?29976', 1, NULL, 11, NULL, 'aZyxCarmaW', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 4, NULL, NULL, NULL, NULL),
(247, 'Giles Stokes', 'gfadel@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3511245, '1', '1', 'Bangladeshi', '1-525-751-1146 x615', '293 Carole Turnpike\nLake Sabrinaburgh, TN 88984-4609', 'Fuga vel minus perferendis ut qui blanditiis quidem. Et qui et totam aliquid voluptatibus fuga iure. Ut natus quia eveniet ab.', 'https://lorempixel.com/640/480/?39521', 1, NULL, 20, NULL, 'S9vtjbzdKL', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 3, NULL, NULL, NULL, NULL),
(248, 'Elnora Hoppe DVM', 'remington.hill@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3080631, '2', '1', 'Bangladeshi', '684-679-6246 x247', '811 Kunde Mountains Apt. 633\nRogersmouth, CO 34422-1732', 'Expedita et distinctio corrupti quae animi harum dolor. Vel velit doloremque totam corrupti possimus itaque neque et. At est et tenetur dolor dolorum qui numquam.', 'https://lorempixel.com/640/480/?45486', 1, NULL, 1, NULL, 'lck0mYIHok', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 6, NULL, NULL, NULL, NULL),
(249, 'Melissa Reichel', 'kylie41@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7363398, '1', '1', 'Bangladeshi', '(612) 736-8832 x771', '584 Mitchel Burg\nEast Ines, KS 07623', 'Tempore expedita aut sed totam. Ipsa veritatis dolore voluptatibus et voluptatem. Beatae nam distinctio minima quo quia consequatur facilis.', 'https://lorempixel.com/640/480/?78867', 1, NULL, 1, NULL, 'jIicrg42Kx', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 8, NULL, NULL, NULL, NULL),
(250, 'Granville Muller', 'winona85@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8418652, '1', '1', 'Bangladeshi', '226-478-3090 x68220', '689 Nitzsche Harbors\nMontyfort, NC 88200', 'Sequi quos doloribus quia adipisci consectetur illo facere. Est fugit praesentium qui corrupti ducimus. Consequatur sint et modi mollitia ut quia et.', 'https://lorempixel.com/640/480/?36002', 1, NULL, 2, NULL, 'OEtjF6Fq8T', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(251, 'Delphia Sipes', 'simeon18@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 5472551, '2', '1', 'Bangladeshi', '(549) 377-8553 x438', '53782 Lexi Parkway\nConroyshire, DE 35968-6133', 'Nisi ut deserunt qui iste libero non modi. Distinctio eaque voluptas porro nam officia quas repellat. Dolor debitis qui et accusantium voluptatum.', 'https://lorempixel.com/640/480/?64495', 1, NULL, 15, NULL, 'vr7D5UJzpC', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 5, NULL, NULL, NULL, NULL),
(252, 'Bernita Beatty', 'mueller.josianne@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6311630, '1', '1', 'Bangladeshi', '1-706-290-6862 x3909', '75023 Susie Spring\nPort Shawna, MO 89166-4879', 'Neque officia quia dolorum ut. Atque sapiente atque sed quisquam sit inventore. Ut sed et laudantium culpa est illo dolore.', 'https://lorempixel.com/640/480/?91854', 1, NULL, 5, NULL, '6zDGNeY6Jh', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 7, NULL, NULL, NULL, NULL),
(253, 'Theresa Buckridge V', 'ankunding.benny@example.net', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 708136, '2', '1', 'Bangladeshi', '1-903-379-8904 x061', '471 Breanna Locks Suite 496\nBartonport, MI 34004', 'Aperiam nobis blanditiis aperiam ratione est. Ut harum voluptatem rerum omnis. Accusamus officia distinctio pariatur dolor explicabo.', 'https://lorempixel.com/640/480/?65287', 1, NULL, 3, NULL, 'H1cNDsSBi5', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 5, NULL, NULL, NULL, NULL),
(254, 'Mr. Dax Funk', 'parisian.catalina@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 7122966, '2', '1', 'Bangladeshi', '774-557-6997 x2492', '3737 Ocie Streets\nNew Emilioberg, VA 26894', 'Laborum quis corporis et magni voluptatem et. Tempora nam soluta quo consectetur voluptatibus. Quia et laudantium hic totam hic harum.', 'https://lorempixel.com/640/480/?60217', 1, NULL, 14, NULL, 'x8BkYhxAqW', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 6, NULL, NULL, NULL, NULL),
(255, 'Prof. Nikolas Terry', 'sjacobs@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 3096325, '2', '1', 'Bangladeshi', '558-973-5608 x11705', '17257 Theodore Island Apt. 362\nMelvinafort, HI 48778-5216', 'Blanditiis consequuntur et alias sint nostrum laudantium qui. Cum facilis veniam ratione sed excepturi impedit sed minima. Inventore voluptatem voluptatum aut recusandae temporibus ea expedita dignissimos.', 'https://lorempixel.com/640/480/?69474', 1, NULL, 11, NULL, 'z8eGVU5tMY', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 9, NULL, NULL, NULL, NULL),
(256, 'Dr. Willis Crooks', 'thauck@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6332218, '2', '1', 'Bangladeshi', '+1-713-385-9541', '6832 Cronin Landing\nTorphyshire, NM 35093', 'Qui aliquid itaque cupiditate blanditiis totam velit. Sint harum omnis non sed perspiciatis sit. Est id sequi omnis qui animi repudiandae.', 'https://lorempixel.com/640/480/?14078', 1, NULL, 10, NULL, 'rH7s9zTdND', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 7, NULL, NULL, NULL, NULL),
(257, 'Blair Powlowski', 'aanderson@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 709312, '1', '1', 'Bangladeshi', '238-624-5805', '169 Reilly Hills Apt. 468\nBoyleville, MS 42989', 'Qui est rerum culpa iure dolorem repudiandae. Quia labore aut dignissimos at. Ab omnis molestias quae non.', 'https://lorempixel.com/640/480/?19997', 1, NULL, 16, NULL, 'pKWy41nnuo', '2020-10-28 06:23:35', '2020-10-28 06:23:35', 2, NULL, NULL, NULL, NULL),
(258, 'Gladyce Fritsch', 'ybradtke@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 4153705, '2', '1', 'Bangladeshi', '(884) 955-1796 x2146', '34854 Lambert Land\nEast Mireya, CA 56201', 'Vel voluptatem qui doloremque magnam provident. Atque corporis qui dicta aut occaecati. Ratione dolorum numquam perspiciatis et.', 'https://lorempixel.com/640/480/?91572', 1, NULL, 19, NULL, '4w9MijqJOE', '2020-10-28 06:23:36', '2020-10-28 06:23:36', 8, NULL, NULL, NULL, NULL),
(259, 'Pedro Stanton', 'xtromp@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 154024, '2', '1', 'Bangladeshi', '1-926-944-1301 x85230', '310 Newton Coves\nVivianberg, LA 39258-4240', 'Sed quas fuga et laboriosam dolore. Aliquid et enim praesentium dolor. Vel expedita et veritatis quasi.', 'https://lorempixel.com/640/480/?91257', 1, NULL, 6, NULL, 'BgjMnLegza', '2020-10-28 06:23:36', '2020-10-28 06:23:36', 1, NULL, NULL, NULL, NULL),
(260, 'Ms. Shania Hayes II', 'pablo.muller@example.org', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 6987889, '1', '1', 'Bangladeshi', '(612) 993-9946', '354 Jakubowski Groves Apt. 856\nNitzscheside, FL 39965', 'Harum autem aliquid sequi dolorem. Aut reiciendis nesciunt officiis et praesentium itaque. In rerum excepturi reprehenderit consectetur quas dolore.', 'https://lorempixel.com/640/480/?44040', 1, NULL, 19, NULL, 'iTAwQqgjih', '2020-10-28 06:23:36', '2020-10-28 06:23:36', 3, NULL, NULL, NULL, NULL),
(261, 'Earnestine Sipes', 'ohara.keyshawn@example.com', '$2y$10$kdeo91D/JO3Z/SdUC0Q2yuRFORodF.4nY33LDd71Nt1PR8tunrKAe', 'student', NULL, 1, '0', 1, 20165757, 8807394, '2', '1', 'Bangladeshi', '538-910-9793 x34048', '298 Waelchi Greens Apt. 308\nReynoldsberg, CA 25379-8421', 'Quaerat perspiciatis voluptates molestiae ab iusto eum quia. Ab quas incidunt facilis ut rerum. A minus ad officiis pariatur qui voluptatem perspiciatis.', 'https://lorempixel.com/640/480/?21397', 1, NULL, 14, NULL, 'TINhxYvOKs', '2020-10-28 06:23:36', '2020-10-28 06:23:36', 10, NULL, NULL, NULL, NULL),
(267, 'raj ', 'raj@gmail.com', '$2y$10$JJVbz9N7i/GngcPUsXLo4OMVIxUfh34mvPg9a9Or4Z0H6ZnWXtyQG', 'student', NULL, 1, '0', 1, 20165757, 12020697, '1', '1', 'Bangladesh ', '1723', 'Green Road', '', '', 1, NULL, 17, NULL, 'GHuMUytnGX', '2020-11-23 06:56:25', '2020-11-23 06:56:25', 5, NULL, NULL, NULL, NULL),
(341, 'Aglae Cole', '454@gmail.com', '$2y$10$DbXF5j2bM.duKxKUKkWs7eiTFwxAUaFWxmUy09J.9kMyyTFs0LgFq', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12059891, '2', '1', 'bd', '4323', '50728 Boyd Brook\nReichertmouth, DE 55418-5817', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 0, NULL, NULL, '2020-11-23 10:42:54', '2020-12-09 11:11:01', 1, NULL, NULL, NULL, NULL),
(342, 'Carissa Cole', 'jutarely@mailinator.com', '$2y$10$D4KgRFYrk6QTte.QBCL6YOU0N04FCYJTDfGXgF0yMl0/KFNaw09pO', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12051289, '1', '1', 'FR', '+1 (157) 523-4948', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, NULL, NULL, '2020-11-29 10:39:46', '2020-12-09 11:13:43', 0, NULL, NULL, NULL, NULL),
(343, 'Amir Bennett', 'xotuwa@mailinator.com', '$2y$10$QcRHlj/xIfw36pX5TjDa3exI4sx51FXLF4Al/r6qdD39MvveumUsS', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12022039, '2', '1', 'SZ', '+1 (106) 306-1229', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, NULL, NULL, '2020-11-29 10:43:34', '2020-12-09 11:11:08', 0, NULL, NULL, NULL, NULL),
(344, 'Fletcher Dillard', 'qyxumo@mailinator.com', '$2y$10$Bcuh.PeYaJMGoPZyDz3wquOuwPe60speMuf6MyggHpJQNtYOUN1FK', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12010851, '1', '1', 'BI', '+1 (988) 545-5657', '', '', '', 0, NULL, 0, NULL, NULL, '2020-11-29 10:44:58', '2020-11-29 10:44:58', 0, NULL, NULL, NULL, NULL),
(345, 'Hiroko Horn', 'zugaqeco@mailinator.com', '$2y$10$aw7sF7N49lJdCmHUZDAmfO/8RCKIAfygDIo9ptjicp2uMekLYqDrq', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12066467, '1', '1', 'BD', '+1 (919) 598-7594', '', '', '', 0, NULL, 0, NULL, NULL, '2020-11-29 10:45:46', '2020-11-29 10:45:46', 0, NULL, NULL, NULL, NULL),
(348, 'Mr Teacher', 'teacher@academy.com', '$2y$10$QvHz68q5i.FJSuOp9IZwDOsVMIB2/rO5J0toCutdLZdZT6mauJ2UK', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12015369, '1', '1', 'BD', '01737895623', '', '', '', 0, NULL, 0, 1, NULL, '2020-12-06 11:21:38', '2020-12-06 11:21:38', 0, NULL, NULL, NULL, NULL),
(349, 'Test with email', 'arunray.jaldhaka@yahoo.com', '$2y$10$iaXQaHV3HLAqEKH4jNcgNOjL3TIMfm7diE6G7bjXzoISU2YtedE7O', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12031236, '1', '1', 'BD', '01521308834', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, 1, NULL, '2020-12-06 11:34:56', '2020-12-06 11:34:56', 0, NULL, NULL, NULL, NULL),
(351, 'Abbot Hinton', 'fawoxypywe@mailinator.com', '$2y$10$WJUbEWQfAkskxlWOV3LCteivGz6op.Xk5JEWq1ASJatt30fgGCnC6', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12027730, '1', '1', 'IR', '+1 (838) 255-6508', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, 1, NULL, '2020-12-06 12:14:47', '2020-12-09 09:19:57', 0, NULL, NULL, NULL, NULL),
(352, 'Drew Caldwell', 'xovylotyfu@mailinator.com', '$2y$10$opHQ7i7pCO7fNouatC7Iz.IxoIaYt41YxJvon482.K1JRP68ixPuq', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12027175, '1', '1', 'SA', '+1 (728) 209-4801', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, 1, NULL, '2020-12-06 12:22:22', '2020-12-06 12:22:22', 0, NULL, NULL, NULL, NULL),
(358, 'Wynne Middleton', 'bicydopo@mailinator.com', '$2y$10$ueKmv3A/.y4e4hGgkTU2quc7wY.zbi5wIx9c3R7BblK6ZH7Hq/HjO', 'admin', 'Principal', 0, '0', 52, 20165757, 12040996, '2', '1', 'Nisi animi iusto pe', '+1 (457) 711-6782', '', '', '', 1, NULL, NULL, 1, NULL, '2020-12-07 09:57:53', '2020-12-09 11:28:49', 0, NULL, NULL, NULL, NULL),
(359, 'Nayda Bradley', 'branch@demo.com', '$2y$10$0JckjrtV2vjDFUp932NW5eJbHCimbNwCUZFm7IA4gbPNm.kv6UlNC', 'admin', 'Admin', 1, '0', 2, 20165758, 12019902, '2', '1', '', '+1 (621) 738-4738888', 'Dhaka', '', '', 1, NULL, NULL, 1, NULL, '2020-12-07 10:01:50', '2021-03-16 08:46:16', 0, NULL, NULL, NULL, NULL),
(360, 'Steven Gutierrez', 'cirokylodo33@mailinator.com', '$2y$10$UPclOLiLHiF6yvYLEYkOteVLOegDnzSRZzeRoOoRhASrCELogCqoa', 'admin', 'Principal', 1, '0', 52, 20165757, 12027097, '1', '1', 'Est quis libero dol', '+1 (564) 176-6939444', '', '', '', 1, NULL, NULL, 1, NULL, '2020-12-07 10:02:34', '2020-12-07 10:02:34', 0, NULL, NULL, NULL, NULL),
(362, 'Rylee Key', 'mdshihabuddinm@gmail.com', '$2y$10$1Q1irLAUF8187bWqhvz1aulV29Pef8z4EGcJ6RvAgg7D7XzQ9tpBa', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12014630, NULL, '1', 'VU', '+1 (525) 707-8372', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 1, NULL, 0, 1, NULL, '2020-12-07 11:27:11', '2020-12-07 11:27:11', 0, NULL, NULL, NULL, NULL),
(363, 'Buckminster Tillman', 'zezubalo@mailinator.com', '$2y$10$0vWUGw3P3Q7HVXoO3oTXn.pnuHjfDb8o6etaHPzRL3gxzGuM/GqaC', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12013858, NULL, '1', 'CG', '+1 (608) 974-4455', '', '', 'http://127.0.0.1:8000/storage/FA20165757S/FA20165757H/2020/STP/1608619778.png', 0, NULL, 0, 1, NULL, '2020-12-07 11:27:58', '2020-12-09 11:13:07', 0, NULL, NULL, NULL, NULL),
(365, 'Maite Ellison', 'pobitro.pobi@gmail.com', '$2y$10$XjTKiqfCZzmw4ZziENUAVeLuxjbqtc4lKIgBtmj9sexnFDE549SaW', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12019276, NULL, '1', 'AW', '+1 (479) 167-8321', '', '', '', 0, NULL, 0, 1, NULL, '2020-12-07 11:33:49', '2020-12-07 11:46:41', 0, NULL, NULL, NULL, NULL),
(367, 'arun', 'arun@gmail.com', '$2y$10$fvZlz5eEH.qqTf/1KtrMC..Eu3UvJp0RlQZCArU5xZ2xBCjYFhy92', 'admin', 'Admin', 0, '0', 1, 20165757, 12023391, '1', '1', 'Bangladeshi', '0288566', '', '', '', 1, NULL, NULL, 1, NULL, '2020-12-08 07:14:08', '2020-12-09 11:28:24', 0, NULL, NULL, NULL, NULL),
(368, 'Sean Cline', 'zywihyjiuuuu@mailiopklknator.com', '$2y$10$qnwrsWoHfIEtCv7lqhQ4qeWss9JhVPwmKZ9jz40LCn//qOxe79gOK', 'admin', 'Admin', 0, '0', 1, 20165757, 12024918, '1', '1', 'Nobis qui deserunt a', '+1 (413) 438-9453', '', '', '', 1, NULL, NULL, 1, NULL, '2020-12-08 08:25:00', '2020-12-09 11:28:36', 0, NULL, NULL, NULL, NULL),
(369, 'Kiayada Blackburn', 'raqyxecyg@mailinator.com', '$2y$10$i3Y/2XMEKMmlIBqyd4tSee.5v5YR4W4rZ0bXVVwVvSV/Y79R3xuZ2', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12012436, '2', '1', 'Inventore et delectu', '+1 (331) 242-3101', '', '', '', 1, NULL, 0, 1, NULL, '2020-12-12 10:56:15', '2020-12-12 10:56:15', 7, NULL, NULL, NULL, NULL),
(370, 'Daryl Maddox', 'zynuvisi@mailinator.com', '$2y$10$LcymMahxlXkrC2FVE8Ch5u.BJmSPDraJUtBvWtoi/tW7sVx2EWBLe', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12018438, '1', '1', 'Nisi ut labore non s', '+1 (768) 893-2273', '', '', '', 1, NULL, 2, 1, NULL, '2020-12-12 10:59:13', '2020-12-12 10:59:13', 6, NULL, NULL, NULL, NULL),
(371, 'Bell Irwin', 'bywepuqik@mailinator.com', '$2y$10$jYFgq3Sm1bPebX4vq4T9jucbZuHKZ2yDPt0NaU9EA2szhKTYx3mN6', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12016379, '1', '1', 'Iusto temporibus imp', '+1 (631) 193-8829', '', '', '', 1, NULL, 3, 1, NULL, '2020-12-12 11:10:12', '2021-01-16 04:35:48', 6, NULL, NULL, NULL, NULL),
(372, 'Patrick Fitzgerald', 'zyke@mailinator.com', '$2y$10$sq8yEfF61bhzSbqRtfiqkuy9xXc6HeTtwcukXafbuU2rTwQeoKbGq', 'accountant', 'Eaque ut et commodo', 0, '0', 54, 20165757, 12025563, '2', '1', 'Et anim et nostrum a', '+1 (185) 724-6601', '', '', '', 1, NULL, NULL, 1, NULL, '2020-12-21 05:34:12', '2020-12-27 11:39:27', 0, NULL, NULL, NULL, NULL),
(373, 'Vladimir Morrow', 'tutulexi@mailinator.com', '$2y$10$6McNoDmPDFqlhROLNLP.qOAtk8o1qOOVK8lfFRvI7Ca7R/I6tyC.W', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12024983, '2', '1', 'Quam a culpa rem omn', '+1 (246) 673-8533', '', '', '', 1, NULL, 22, 1, NULL, '2020-12-22 06:45:06', '2020-12-22 06:45:06', 9, NULL, NULL, NULL, NULL),
(374, 'Florence Sandoval', 'mukosy@mailinator.com', '$2y$10$xVNJyZj9Ky4QBOGBWRQZ8.BogxZ9rQnYh95mJLQ/CB9fwkYNS6n5W', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12020752, '1', '1', 'Qui at in commodi ac', '+1 (428) 282-3774', '', '', '', 1, NULL, 2, 1, NULL, '2020-12-22 06:49:38', '2020-12-22 06:49:38', 10, NULL, NULL, NULL, NULL),
(375, 'Tatum England', 'segu@mailinator.com', '$2y$10$uLF4Q5veMGFDFMFaWCldeeeqnN4WJ16t48I5PAFnto1bKWKYsJZlq', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12029229, '1', '1', 'Voluptas tenetur ear', '+1 (607) 154-4952', '', '', '', 1, NULL, 0, 1, NULL, '2020-12-22 10:09:10', '2020-12-22 10:09:10', 1, NULL, NULL, NULL, NULL),
(376, 'Asif', 'ruxewyq@mailinator.com', '$2y$10$fIivueefTYkX5hG2nfKS1OuCk9j1qJXkxkTZQQfwAH2uob/deC3r6', 'teacher', 'Teacher', 0, '0', 1, 20165757, 12086785, '1', '1', '', '+1 (995) 501-5491', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/STP/1608631864.png', 1, NULL, 9, 1, NULL, '2020-12-22 10:11:05', '2021-01-16 04:36:54', 6, NULL, NULL, NULL, NULL),
(377, '', '', '', 'student', NULL, 0, '0', NULL, NULL, NULL, NULL, '1', '', '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(378, 'Asifuzzaman', 'tivufokuri@mailinator.com', '$2y$10$NKFi89dr.g.yQAbbVCCweuSXJ6eJuPeezNiYPUFUx2LQvpSOEbiEC', 'teacher', 'Teacher', 1, '0', 1, 20165757, 12110108, '1', '1', 'Bangladeshi', '+1 (173) 849-3504', '', '', '', 1, NULL, 5, 1, NULL, '2021-01-17 06:27:34', '2021-01-24 12:03:48', 3, NULL, NULL, NULL, NULL),
(379, 'Asifuzzaman', 'asif@demo.com', '$2y$10$nxzlePv2B1J6G7SLjxyBCewIR0kUAgaFAWZc6/lkWmJ4PuFRixKB2', 'admin', NULL, 1, '0', 56, 21268695, 562122186, '1', '1', 'Bangladeshi', '1254785455', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/AP/8741610880649.png', 1, NULL, NULL, NULL, NULL, '2021-01-17 10:50:51', '2021-01-17 10:50:51', 0, NULL, NULL, NULL, NULL),
(380, 'Wallace Phillips', 'fohugyqyw@mailinator.com', '$2y$10$6P1zWj4dDHfQeZ7t7f5ASuGKsQ0rz7av.ZHufY/yGQ6KqICls9FnG', 'admin', NULL, 1, '0', 56, 21268695, 562113030, '2', '1', 'Anim velit atque ac', '+1 (358) 889-7824', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-18 09:41:18', '2021-01-18 09:41:18', 0, NULL, NULL, NULL, NULL),
(381, 'Ezekiel Stark', 'zawyxetin@mailinator.com', '$2y$10$Djc7wUNK2pL8ewA4WYaJp.KVN3CqOejuXt9AxgMVNTPEFasCTnqqu', 'teacher', 'Teacher', 2, '0', 1, 20165757, 12123989, NULL, '1', 'WF', '+1 (719) 122-4999', '', '', '', 0, NULL, 0, 1, NULL, '2021-01-23 10:48:15', '2021-01-23 10:48:15', 0, NULL, NULL, NULL, NULL),
(382, 'Tyrone Norman', 'wimulovyd@mailinator.com', '$2y$10$FvDpO0Tp/p9lrjTm6Pac1e0CthfnpS6mKk.EXHrX8UoBZKIy4iNey', 'admin', NULL, 1, '0', 59, 21147560, 2147483647, NULL, '1', 'South Georgia &amp; South Sandwich Islands', '+1 (733) 317-9544', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-27 10:26:44', '2021-01-27 10:26:44', 0, NULL, NULL, NULL, NULL),
(383, 'Whilemina Wise', 'qudyruba@mailinator.com', '$2y$10$xp7eOIr6RKeNOJ6rioLx2OTx45kV9OM0RkSRUhW4uUx2U8UGsMyPy', 'admin', NULL, 1, '0', 60, 21143022, 21158984, NULL, '1', 'Estonia', '+1 (229) 442-9433', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-28 05:28:55', '2021-01-28 05:28:55', 0, NULL, NULL, NULL, NULL),
(384, 'Whilemina Wise', 'qudyruba@mailinator.com', '$2y$10$X7OnH5/WoTJWJUfLluNlNOy6vvrImp.yekPJ088ZIOi6z.yvGBERa', 'admin', NULL, 1, '0', 61, 21615402, 21260548, NULL, '1', 'Estonia', '+1 (229) 442-9433', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-28 05:33:03', '2021-01-28 05:33:03', 0, NULL, NULL, NULL, NULL),
(385, 'Whilemina Wise', 'qudyruba@mailinator.com', '$2y$10$SC1Ut81je.sYqr3INLCMkOhZ6o3gk1LkBRXQ4f0LP9Nrc3MkOPKkW', 'admin', NULL, 1, '0', 62, 21219828, 21859525, NULL, '1', 'Estonia', '+1 (229) 442-9433', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-28 06:41:33', '2021-01-28 06:41:33', 0, NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `role_title`, `active`, `isSuper`, `school_id`, `code`, `student_code`, `gender`, `blood_group`, `nationality`, `phone_number`, `address`, `about`, `pic_path`, `verified`, `email_verified_at`, `section_id`, `assign_school`, `remember_token`, `created_at`, `updated_at`, `department_id`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(386, 'Whilemina Wise', 'qudyruba@mailinator.com', '$2y$10$Z7e8.dVaYPlezR/bV5Y11ulOf0ImRgg.BSvQnxzIXMSVMG7hKL9n6', 'admin', NULL, 1, '0', 63, 21452022, 21160820, NULL, '1', 'Estonia', '+1 (229) 442-9433', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-28 07:46:30', '2021-01-28 07:46:30', 0, NULL, NULL, NULL, NULL),
(390, 'Nathan Dalton', 'Nathan Dalton', '$2y$10$prGCEis/tZ6qtlU2gwawZOElm.qehv.CqMWeWsyUFI798wW3kKW3C', 'admin', NULL, 1, '0', 67, 21118541, 2147483647, NULL, '1', 'Bangladesh', '+1 (515) 137-7176', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:13:20', '2021-01-31 11:13:20', 0, NULL, NULL, NULL, NULL),
(391, 'Nathan Dalton', 'Nathan Dalton', '$2y$10$Sz0LzWauwRORgTcO8qQp8OOd6YJyUO8.SJBJjlfpcaoqrUvCohtHi', 'admin', NULL, 1, '0', 68, 21116158, 2147483647, NULL, '1', 'Bangladesh', '+1 (515) 137-7176', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:32:39', '2021-01-31 11:32:39', 0, NULL, NULL, NULL, NULL),
(392, 'Whilemina Moss', 'Whilemina Moss', '$2y$10$nh62bT8/SrpDlKl49bS8l.v7RZV2f7lcHX1pqVvrPvU8lFDJWvj9S', 'admin', NULL, 1, '0', 69, 21752451, 13110001, NULL, '1', 'Bangladesh', '+1 (119) 748-3967', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:36:23', '2021-01-31 11:36:23', 0, NULL, NULL, NULL, NULL),
(393, 'Whilemina Moss', 'Whilemina Moss', '$2y$10$OvXZBh8U1v0ReEDYAZ1r6OmiqwxsKnxDxWYdvZuMt0ecgtLY0fNdi', 'admin', NULL, 1, '0', 70, 21141356, 13110001, NULL, '1', 'Bangladesh', '+1 (119) 748-3967', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:37:45', '2021-01-31 11:37:45', 0, NULL, NULL, NULL, NULL),
(394, 'Whilemina Moss', 'arun24542@gmail.com', '$2y$10$qgT7lm8wzQbuzgge54JaYOEjCas/7Fg4NEHSju3XjgcBZUnjz9ea.', 'admin', NULL, 1, '0', 71, 21104856, 13110001, NULL, '1', 'Bangladesh', '+1 (119) 748-3967', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:48:39', '2021-01-31 11:48:39', 0, NULL, NULL, NULL, NULL),
(395, 'Zeus Ortega', 'arun24542@gmail.com', '$2y$10$QfS8ae4YvaqjakJI3UYjV.4kddkdWvFO7sgcpO6hLUPJcZflsxl3u', 'admin', NULL, 1, '0', 72, 21212689, 43210001, NULL, '1', 'Bangladesh', '+1 (556) 749-8386', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 11:55:10', '2021-01-31 11:55:10', 0, NULL, NULL, NULL, NULL),
(396, 'Thaddeus Brewer', 'arun24542@gmail.com', '$2y$10$cmDPcu5wo.go0pi3bYyFJu58BzohsqOkDRyWA4.Dq6s38rSaNE3be', 'admin', NULL, 1, '0', 73, 21317796, 34110001, NULL, '1', 'Bangladesh', '+1 (409) 248-8935', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 12:13:23', '2021-01-31 12:13:23', 0, NULL, NULL, NULL, NULL),
(397, 'afa sfaff', 'arun24542@gmail.com', '$2y$10$k9GisCVPKki7m/zSa/hZSuAL/UBCop/j.iNDCaDe/wxn2W19rkOUG', 'admin', NULL, 1, '0', 74, 21229529, 2147483647, NULL, '1', 'United States', '+11927974925', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 12:21:40', '2021-01-31 12:21:40', 0, NULL, NULL, NULL, NULL),
(398, 'Hamish Mcintosh', 'arun24542@gmail.com', '$2y$10$VWAqJrEXA6inOKo.o5LUiOl6Wy4CiF2oqqHj2TCw17MwKMaVLPPOe', 'admin', NULL, 1, '0', 75, 21253395, 32410001, NULL, '1', 'United States', '+1 (899) 124-3192', '', '', '', 1, NULL, NULL, NULL, NULL, '2021-01-31 12:28:12', '2021-01-31 12:28:12', 0, NULL, NULL, NULL, NULL),
(402, 'Arun Kumar', 'arun24542@gmail.com', '$2y$10$FYghtnK10pfBNdZed8nWi.sE2WQO8Dda2iURyMMjq/OkBXco5a.jS', 'agent', NULL, 1, '0', 1, 20165757, 12123990, NULL, '1', 'Bangladesh', '+8801737389557', 'Aut adipisci minima', 'Voluptas eu unde vol', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/1131612858161.png', 1, NULL, NULL, NULL, NULL, '2021-02-07 12:16:50', '2021-02-10 10:51:23', 0, NULL, NULL, NULL, NULL),
(403, 'Emrul Hasan', 'emrul.01745@gmail.com', '$2y$10$FYghtnK10pfBNdZed8nWi.sE2WQO8Dda2iURyMMjq/OkBXco5a.jS', 'agent', NULL, 1, '0', 1, 20165757, 12123991, NULL, '1', 'United States', '01745235689', 'Green Road,\r\nDhaka-1205', 'asdasd', '', 1, NULL, NULL, NULL, NULL, '2021-02-09 05:01:54', '2021-02-09 12:20:59', 0, NULL, NULL, NULL, NULL),
(404, 'Dorothy Black', 'else@gmail.com', '$2y$10$FYghtnK10pfBNdZed8nWi.sE2WQO8Dda2iURyMMjq/OkBXco5a.jS', 'agent', NULL, 1, '0', 1, 20165757, 12123992, NULL, '1', 'Guam', '+1 (378) 832-7517', 'In quo aliquip corru', 'sada', '', 1, NULL, NULL, NULL, NULL, '2021-02-09 10:51:15', '2021-02-10 06:47:40', 0, NULL, NULL, NULL, NULL),
(405, 'Martha Burgess', 'sodicago@mailinator.com', '$2y$10$PQFb83ToiaKsku4MhFcMfuMrzk10qbaqXBQsi033q7WVSd3syD2nW', 'accountant', 'Odit est at nemo co', 1, '0', 3, 20165757, 12123993, '1', '1', 'Doloribus occaecat e', '+1 (526) 102-4484', '', '', '', 1, NULL, NULL, 1, NULL, '2021-02-11 07:22:19', '2021-02-11 07:22:19', 0, NULL, NULL, NULL, NULL),
(407, 'dasdad', 'arun245420@gmail.com', '$2y$10$gHRIjH2ew4kmEINXDsxx6OumD.wfaPBU0SKlqQfWCJcWq6miS3QS2', 'admin', NULL, 1, '0', 76, 21221387, 2147483647, NULL, '1', 'Bangladesh', '0124', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-14 07:06:55', '2021-02-14 07:06:55', 0, NULL, NULL, NULL, NULL),
(408, 'sgzdgg', 'arun24540002@gmail.com', '$2y$10$XvAnWyPgWzsQTjxBkV9yOu2WDQbxEbJdMwgvs41uHVBMDebjKtsgi', 'admin', NULL, 1, '0', 77, 21170061, 555510001, NULL, '1', 'Bangladesh', '53466', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-14 07:11:57', '2021-02-14 07:11:57', 0, NULL, NULL, NULL, NULL),
(409, 'Cheryl Dunlap', 'virodepygy@mailinator.com', '$2y$10$DgP98nW9goDkzxpwpFGZwONEsR9jv9Hm7FfxNKW4Q.3OTXmkuH.N6', 'admin', NULL, 1, '0', 78, 21116588, 21241085, NULL, '1', 'Bangladesh', '+1 (344) 906-6149', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-17 10:46:16', '2021-02-17 10:46:16', 0, NULL, NULL, NULL, NULL),
(410, 'getwh gdsg', 'ff45ff@gmail.com', '$2y$10$4X2OmaTB3UDlg18Sg/CUv.Yk.rlKSohiEjef/qf6RitZTsK80ROS.', 'admin', NULL, 1, '0', 79, 21224739, 21311610, NULL, '1', 'Bangladesh', '643634634', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-18 10:51:40', '2021-02-18 10:51:40', 0, NULL, NULL, NULL, NULL),
(411, 'fsgs srgrs', 'arun245400002@gmail.com', '$2y$10$E4UsArEf6Jv.U1JnVJCgbuyHN9AM2v.PU3SDFAxNns3tOR.E9PAia', 'admin', NULL, 1, '0', 80, 21232717, 21235239, NULL, '1', 'Bangladesh', '5445', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-18 11:24:40', '2021-02-18 11:24:40', 0, NULL, NULL, NULL, NULL),
(412, 'Sydney Cantu', 'rijoxe@mailinator.com', '$2y$10$vDkyGcb7nOxIN5z8iAFrcOMBOkKngqPB2zAAV1NkJqbK6ClP70tD.', 'admin', NULL, 1, '0', 81, 21199504, 1234510001, NULL, '1', 'Bangladesh', '0173789525', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:01:16', '2021-02-22 06:01:16', 0, NULL, NULL, NULL, NULL),
(413, 'Callie Holcomb', 'xarewos@mailinator.com', '$2y$10$1.dPeLAXjjxiw5.1pweFMOyTl2zWlTHIL7prTDFvInDezn.ITf8Oa', 'admin', NULL, 1, '0', 82, 21762345, 25810001, NULL, '1', 'Bangladesh', '+1 (875) 825-2168', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:10:20', '2021-02-22 06:10:20', 0, NULL, NULL, NULL, NULL),
(414, 'Leilani Contreras', 'dowituru@mailinator.com', '$2y$10$BkuZZr3jcM9E2yQfS/C3H.XpXVLGF86g0viquZdmi9lr0vz/43Vuy', 'admin', NULL, 1, '1', 83, 21276510, 21501010, NULL, '1', 'Bangladesh', '+1 (298) 672-2908', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:20:49', '2021-02-22 06:20:49', 0, NULL, NULL, NULL, NULL),
(415, 'Blaze Blankenship', 'qebu@mailinator.com', '$2y$10$Zp2Ee8xw3DL7hl5tr1i2p.9/h/ADBfN1bhrNkA2PBsXM9V57Aumji', 'admin', NULL, 1, '0', 84, 21305895, 21136784, NULL, '1', 'Bangladesh', '+1 (653) 233-7401', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:27:59', '2021-02-22 06:27:59', 0, NULL, NULL, NULL, NULL),
(416, 'Laura Lambert', 'simuvuve@mailinator.com', '$2y$10$PvOf4GpKqPXzpawYnKxtWeAr1pbyPemzY78p9RkZXrf/lVBW1dC.G', 'admin', NULL, 1, '1', 85, 21243352, 21243260, NULL, '1', 'Bangladesh', '+1 (225) 879-5069', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:30:12', '2021-02-22 06:30:12', 0, NULL, NULL, NULL, NULL),
(417, 'Illiana Levy', 'sucuwobed@mailinator.com', '$2y$10$BXoPg.HmVWu4DxR5FqBE6.xbgvS.amizWhOX7ke6meQ8.FlI9uBu2', 'admin', NULL, 1, '0', 86, 21597229, 21152802, NULL, '1', 'United States', '+1 (467) 558-6387', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-02-22 06:34:06', '2021-02-22 06:34:06', 0, NULL, NULL, NULL, NULL),
(418, 'Cullen Beach', 'peloxoxyb@mailinator.com', '$2y$10$K6T6nVAyN0nt3apKH6Em0u8N3JWmEmMCme272SkMQOXUIQNMIDq1O', 'admin', NULL, 1, '0', 87, 21860539, 21718766, NULL, '1', 'Bangladesh', '+1 (189) 404-1519', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 03:44:30', '2021-03-02 03:44:30', 0, NULL, NULL, NULL, NULL),
(419, 'Ian Cochran', 'arupar25@gmail.com', '$2y$10$IThstNwzpH1B0RoUKJ3CL.ar3bolXEj/7RSFZyzHm9ITChXsDS2HO', 'admin', NULL, 1, '0', 88, 21333079, 21167344, NULL, '1', 'Bangladesh', '+1 (926) 434-7753', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 03:58:14', '2021-03-02 03:58:14', 0, NULL, NULL, NULL, NULL),
(420, 'Portia Vincent', 'kuqutywa@mailinator.com', '$2y$10$bsU5FJtSDY2xgIOXb1FQ/e6vALdilyfu0mcuKJ.4qaGLkUMMmpUWm', 'admin', NULL, 1, '0', 89, 21123869, 21322810, NULL, '1', 'Bangladesh', '+1 (962) 988-3972', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 10:09:23', '2021-03-02 10:09:23', 0, NULL, NULL, NULL, NULL),
(421, 'Erica Atkinson', 'arupar25@gmail.com', '$2y$10$CP8i6lNuwSgxs1nmL.GLp.Afw9suUGcqLonhy.sUqE3fMdsQpTwuC', 'admin', NULL, 1, '0', 90, 21282628, 21153282, NULL, '1', 'United States', '+1 (174) 141-4129', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 11:48:12', '2021-03-02 11:48:12', 0, NULL, NULL, NULL, NULL),
(422, 'Erica Atkinson', 'arupar25@gmail.com', '$2y$10$euxQZxQhcXcLvzyf9jc04umhZ.rKzcGH7oPITVdeMWEEeYgXrGrb2', 'admin', NULL, 1, '0', 91, 21204596, 21251713, NULL, '1', 'United States', '+1 (174) 141-4129', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 11:52:07', '2021-03-02 11:52:07', 0, NULL, NULL, NULL, NULL),
(423, 'Erica Atkinson', 'arupar25@gmail.com', '$2y$10$s.ub/vX9WerBkNRiEll9WubFBwuYwE0ApFHs7zdpMF8Vxg59297Mu', 'admin', NULL, 1, '0', 92, 21207849, 21270155, NULL, '1', 'United States', '+1 (174) 141-4129', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 11:56:44', '2021-03-02 11:56:44', 0, NULL, NULL, NULL, NULL),
(424, 'Clayton Abbott', 'gynolewika@mailinator.com', '$2y$10$rTce8pTzF5fjNKtvhrcO7.KiyzZwNdTw6onO58IRukW7qOKZEEHVy', 'admin', NULL, 1, '1', 93, 21353657, 21275867, NULL, '1', 'United States', '+1 (899) 662-7314', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-02 12:09:57', '2021-03-02 12:09:57', 0, NULL, NULL, NULL, NULL),
(425, 'Admin', 'faf@gmail.com', '$2y$10$7lNaX5by9u1TfEWSUA4/1.SWrRq8YG4dh5t.cnzEiUj2xDUEUzYE6', 'admin', NULL, 1, '1', 94, 21298820, 12310001, NULL, '1', 'Bangladesh', '15818151889', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-03 05:35:08', '2021-03-03 05:35:08', 0, NULL, NULL, NULL, NULL),
(426, 'GKMB', 'xycuc@mailinator.com', '$2y$10$biiBKg4RvUILxeVRwRmC3eDWDeKXJ01qNmI/4VPSu5BqWpFMzTX/i', 'admin', NULL, 1, '1', 95, 21596420, 21208048, NULL, '1', 'United States', '+1 (785) 603-4194', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-03 06:01:04', '2021-03-03 06:01:04', 0, NULL, NULL, NULL, NULL),
(427, 'AT', 'mufoxu@mailinator.com', '$2y$10$rzSrji00OEyKWvSP91/JSO/Gnc8dewXqRN1y/zyAVBb5fAYMPL8ym', 'admin', NULL, 1, '1', 96, 21295188, 21247377, NULL, '1', 'Bangladesh', '+1 (918) 212-8722', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-06 05:13:39', '2021-03-06 05:13:39', 0, NULL, NULL, NULL, NULL),
(428, 'IW', 'cuxyp@mailinator.com', '$2y$10$BL.CSsDNrktYLu/4erBOQuJyEXkcZplVDTlYOKs3FdKA0afQvf7/.', 'admin', NULL, 1, '0', 97, 21254782, 21324257, NULL, '1', 'United States', '+1 (561) 513-3786', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-23 07:49:11', '2021-03-23 07:49:11', 0, NULL, NULL, NULL, NULL),
(429, 'Mr. Test', 'testmr@gmail.com', '$2y$10$MHKkr7J/MDviGxFlBUYRM.Z2U3YtJj812G/4pBapcgOUcHh92feHO', 'agent', NULL, 1, '0', 1, 20165757, 12123993, NULL, '1', 'Bangladesh', '01735679954', '12', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 07:33:16', '2021-03-24 07:33:16', 0, NULL, NULL, NULL, NULL),
(431, 'Mr. test roy', 'mrtest@gmail.com', '$2y$10$szSPackj/6kPfjC6xLSi/.MNoluuSmd4D2odxaDJDlNr329V5r/oy', 'agent', NULL, 1, '0', 1, 20165757, 12123994, NULL, '1', 'Bangladesh', '2147854', '333', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 07:38:36', '2021-03-24 07:38:36', 0, NULL, NULL, NULL, NULL),
(432, 'Sebastian Roberson', 'arun000@gmail.com', '$2y$10$ft1K95WG.6wc8GId0EFC5eVo6PeZG5GsGoYymV6EkqR8Rl2vzYkEi', 'agent', NULL, 1, '0', 1, 20165757, 12123995, NULL, '1', 'Bangladesh', '15818151889', 'Pariatur Maiores en', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 07:41:41', '2021-03-24 07:41:41', 0, NULL, NULL, NULL, NULL),
(434, 'Abir School', 'abir@gmail.com', '$2y$10$YKH6jJ2nTrTx9iNFIBamf.GGTyy8OwyAglfr4dcgm8qaJUc7vUpeO', 'agent', NULL, 1, '0', 1, 20165757, 12123996, NULL, '1', 'Bangladesh', '123456987', '254', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 07:45:55', '2021-03-24 07:45:55', 0, NULL, NULL, NULL, NULL),
(435, 'dsgsg', 'sgdsgg@gmail.com', '$2y$10$xS.iRlHEY6QqqSbj41tFTucvse7NpzE0uuTCoBi1p1idNYmsuY95K', 'agent', NULL, 1, '0', 1, 20165757, 12123997, NULL, '1', 'Bangladesh', '235235', 'sagaga', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 07:55:39', '2021-03-24 07:55:39', 0, NULL, NULL, NULL, NULL),
(436, 'dsgsgaaf', 'sgdsggdf@gmail.com', '$2y$10$YLU6NsJB9sBK8QSBZ1q/Heztcg917BHMUYmnHMVOrJ4tVtF9rZz7u', 'agent', NULL, 1, '0', 1, 20165757, 12123998, NULL, '1', 'Bangladesh', '23523500', 'dafa', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:05:06', '2021-03-24 08:05:06', 0, NULL, NULL, NULL, NULL),
(437, 'dsgsgaaf', 'sgdsggdfc@gmail.com', '$2y$10$mHJQw1YUewcW2MRtJ9eSheSxkNvGQYNzPWtOEy7wlK9p.mMah1QGK', 'agent', NULL, 1, '0', 1, 20165757, 12123999, NULL, '1', 'Bangladesh', '235235005', 'dfsfa', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:08:06', '2021-03-24 08:08:06', 0, NULL, NULL, NULL, NULL),
(438, 'dafaf', 'arun2a4542@gmail.com', '$2y$10$ERacGV8wjds4tMwSN/Avf.We3S9yL/IqWXD35yZExEzPWluFx0ctK', 'agent', NULL, 1, '0', 1, 20165757, 12124000, NULL, '1', 'Bangladesh', '15818151889423', 'Pariatur Maiores en', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:13:23', '2021-03-24 08:13:23', 0, NULL, NULL, NULL, NULL),
(439, 'rsdhsr', 'shs@sg.com', '$2y$10$cDN8uBZWpJQKm6q1yK99UO./5Trfnb.g.eOobE0nwgCCJ37cl8GF2', 'agent', NULL, 1, '0', 1, 20165757, 12124001, NULL, '1', 'Bangladesh', '42453', '1245', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:14:42', '2021-03-24 08:14:42', 0, NULL, NULL, NULL, NULL),
(440, 'fag', 'gsg@gsdg.com', '$2y$10$7r6XMludpBdEzz4cyi7ldO9rwwy9SOm64rK8ovANpXlcN896OV9/m', 'agent', NULL, 1, '0', 1, 20165757, 12124002, NULL, '1', 'Bangladesh', '25478954', '1245', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:16:54', '2021-03-24 08:16:54', 0, NULL, NULL, NULL, NULL),
(441, 'Sebastian Robersonfs', 'mufoxfsfu@mailinator.com', '$2y$10$rn8LNI1gqBisUn4.wUgz0Om06EQQG4wbOa0Qxti3rV6UoSvg0a1E.', 'agent', NULL, 1, '0', 1, 20165757, 12124003, NULL, '1', 'Bangladesh', '321465784', 'Pariatur Maiores en', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:18:38', '2021-03-24 08:18:38', 0, NULL, NULL, NULL, NULL),
(442, 'vsgs', 'arun242211542@gmail.com', '$2y$10$o3jrTrsRltfCuc.dEYclLOcxoLTAHSBAqoGV541.x.Sp9u8rNCrcG', 'agent', NULL, 1, '0', 1, 20165757, 12124004, NULL, '1', 'Bangladesh', '3264616301', 'sdsggs', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:22:15', '2021-03-24 08:22:15', 0, NULL, NULL, NULL, NULL),
(443, 'afagfag', 'foqasfsdv@demo.com', '$2y$10$gAtaGH1KuQ/P1Z7e7FvogutRvigZnz8Gd6QYUJBbjxqc3yN0xEqza', 'agent', NULL, 1, '0', 1, 20165757, 12124005, NULL, '1', 'Bangladesh', '15818151321889', 'Pariatur Maiores en', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:25:12', '2021-03-24 08:25:12', 0, NULL, NULL, NULL, NULL),
(444, 'dsfsdfsf', 'admin1@demo.com', '$2y$10$jWytoNsd4edzbxT5/bkzxO0bQUdIqIgH999A2V/wJFz/HP7ovEz8i', 'agent', NULL, 1, '0', 1, 20165757, 12124006, NULL, '1', 'Bangladesh', '123456', 'dfaf', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-24 08:29:28', '2021-03-24 08:29:28', 0, NULL, NULL, NULL, NULL),
(445, 'SRB', 'arun24542@gmail.com', '$2y$10$b79cAA/NUOPzu4vCr7WDe.wnuLe4Fsl/weRIb3BVipWD4SPpvR1sC', 'admin', NULL, 1, '1', 98, 21888156, 12310001, NULL, '1', 'Bangladesh', '15818151889', '--', '', '', 1, NULL, NULL, NULL, NULL, '2021-03-25 11:29:58', '2021-03-25 11:29:58', 0, NULL, NULL, NULL, NULL),
(446, 'Asifuzzaman', 'jeposyq@mailinator.com', '$2y$10$.u4IqwmAgX2pDNTgL0q1nOt3bAqpGPosSOgAMx0bKeCw7mh46ADc.', 'staff', 'Aasif', 1, '0', 53, 20165757, 12124007, '1', '1', 'Albanian', '1254785455855255', '', '', '', 1, NULL, NULL, 1, NULL, '2021-03-28 07:27:19', '2021-03-28 07:27:19', 0, NULL, NULL, NULL, NULL),
(448, 'Asifuzzaman', 'dsadfvbgnhf@demo.com', '$2y$10$uy4.zLeFFDwC.CNxJpGo.O6dNUs/aZIMtoP9IpEFtSelIfxkJjl5C', 'librarian', 'fedrtfhkjllh', 1, '0', 3, 20165757, 12124008, '1', '1', 'Albanian', '752542452452452', '', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2021/STP/5961616917193.png', 1, NULL, NULL, 1, NULL, '2021-03-28 07:39:56', '2021-03-28 07:39:56', 0, NULL, NULL, NULL, NULL),
(488, 'Student 1', 'dili@mailinator.com', '$2y$10$rMmx9Lwndf460fheP0bureApsvBRLp8yAM8xay2.7rC5bfn4gLpBm', 'student', 'Student', 1, '0', 1, 20165757, 12124007, '1', '1', 'Distinctio Eos ame', 'Animi optio rem co', 'Ipsa cum reprehende,Aliquid eum neque do', '', 'http://192.168.0.109:8001/storage/FA20165757S/FA20165757H/2020/profile/XLsWFvVvw7BKDQy0CcMb68EwYKtO8yy2vp8asbeI.png', 1, NULL, 21, NULL, NULL, '2021-03-31 07:53:05', '2021-03-31 07:53:05', 0, NULL, NULL, NULL, NULL),
(489, 'Student 2', 'pyny@mailinator.com', '$2y$10$pPV9g7zmRg4YtPR8aIcueOWIjjc.gNzR0RZLVbXAX1hE4jteASuWu', 'student', 'Student', 1, '0', 1, 20165757, 12124008, '1', '1', 'A autem magni amet', '580', 'Dolores ea soluta sa,Illum nulla iste ad', '', '', 1, NULL, 22, NULL, NULL, '2021-03-31 07:53:06', '2021-03-31 07:53:06', 0, NULL, NULL, NULL, NULL),
(490, 'sasasasas', 'sassa@demo.com', '$2y$10$gU7GEaDRKpbFKO6Nj1UbOuCMLEqx5JJo4um60NWP6yRu6ewgex3G2', 'staff', 'asssa', 1, '0', 3, 20165757, 12124009, '1', '1', 'Bangladeshi', '85785577', '', '', '', 1, NULL, NULL, 1, NULL, '2021-03-31 11:32:23', '2021-03-31 11:32:23', 0, NULL, NULL, NULL, NULL),
(492, 'Asifuzzaman', 'as@demo.com', '$2y$10$wOIfg1ZcLP/4n5qH0q31Weh7ind6Zg6n/tFBOQEa9YTzSp1dp2qoO', 'admin', 'ssssssssssssss', 1, '0', 1, 20165757, 12124009, '1', '1', 'Bangladeshi', '0125448', '', '', '', 1, NULL, NULL, 1, NULL, '2021-04-01 08:05:12', '2021-04-01 08:05:12', 0, NULL, NULL, NULL, NULL),
(493, 'Asifuzzaman', 'ads@demo.com', '$2y$10$P0hcnh34BOcDVqMpr7okc.PTnTYNPpKLLS6Bnlye4UGxozpdLxxRy', 'librarian', 'Librarian', 1, '0', 1, 20165757, 12124010, '1', '1', 'American', '50241856', '', '', '', 1, NULL, NULL, 1, NULL, '2021-04-01 08:06:44', '2021-04-01 08:06:44', 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_sectors`
--
ALTER TABLE `account_sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `admission_payments`
--
ALTER TABLE `admission_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_payments_school_id_index` (`school_id`),
  ADD KEY `admission_payments_admission_id_index` (`admission_id`),
  ADD KEY `admission_payments_trans_number_index` (`trans_number`),
  ADD KEY `admission_payments_trans_id_index` (`trans_id`),
  ADD KEY `admission_payments_trans_date_index` (`trans_date`),
  ADD KEY `admission_payments_trans_type_index` (`trans_type`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agents_user_id_index` (`user_id`),
  ADD KEY `agents_district_id_index` (`district_id`),
  ADD KEY `agents_state_id_index` (`state_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX` (`school_id`,`student_id`,`section_id`,`exam_id`,`present`,`user_id`,`date`) USING BTREE;

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_book_code_unique` (`book_code`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_name_index` (`name`);

--
-- Indexes for table `course_attendances`
--
ALTER TABLE `course_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_attendances_school_id_index` (`school_id`),
  ADD KEY `course_attendances_student_id_index` (`student_id`),
  ADD KEY `course_attendances_section_id_index` (`section_id`),
  ADD KEY `course_attendances_course_id_index` (`course_id`),
  ADD KEY `course_attendances_exam_id_index` (`exam_id`),
  ADD KEY `course_attendances_user_id_index` (`user_id`);

--
-- Indexes for table `course_configs`
--
ALTER TABLE `course_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_groups`
--
ALTER TABLE `course_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `degrees_level_of_education_index` (`level_of_education`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dues`
--
ALTER TABLE `dues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_for_classes`
--
ALTER TABLE `exam_for_classes`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_systems`
--
ALTER TABLE `grade_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `important_links`
--
ALTER TABLE `important_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lets_encripts`
--
ALTER TABLE `lets_encripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_name_index` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `messages_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

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
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_admissions`
--
ALTER TABLE `pre_admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricings_price_type_index` (`price_type`),
  ADD KEY `pricings_title_index` (`title`),
  ADD KEY `pricings_status_index` (`status`),
  ADD KEY `pricings_subsMonth_index` (`subsMonth`) USING BTREE;

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_code_unique` (`code`),
  ADD KEY `district_city_index` (`district_id`,`city`),
  ADD KEY `agent` (`agentcode`),
  ADD KEY `pricings_activeTill_index` (`activeTill`);

--
-- Indexes for table `school_payments`
--
ALTER TABLE `school_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_payments_school_id_index` (`school_id`),
  ADD KEY `school_payments_user_id_index` (`user_id`),
  ADD KEY `school_payments_trans_number_index` (`trans_number`),
  ADD KEY `school_payments_trans_id_index` (`trans_id`),
  ADD KEY `school_payments_trans_date_index` (`trans_date`),
  ADD KEY `school_payments_trans_type_index` (`trans_type`),
  ADD KEY `school_payments_purpose_id_index` (`purpose_id`),
  ADD KEY `agcode` (`agentcode`),
  ADD KEY `ref_number` (`ref_number`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_email_index` (`email`),
  ADD KEY `settings_phone_index` (`phone`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_board_exams`
--
ALTER TABLE `student_board_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_infos`
--
ALTER TABLE `student_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_index` (`user_id`),
  ADD KEY `subscriptions_school_payment_id_index` (`school_payment_id`),
  ADD KEY `pricings_school_index` (`school_id`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  ADD KEY `subscription_items_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `syllabuses`
--
ALTER TABLE `syllabuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherinfos`
--
ALTER TABLE `teacherinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherinfos_user_id_index` (`user_id`);

--
-- Indexes for table `templete_designs`
--
ALTER TABLE `templete_designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`,`school_id`) USING BTREE,
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`,`school_id`) USING BTREE,
  ADD UNIQUE KEY `users_student_code_unique` (`school_id`,`student_code`) USING BTREE,
  ADD KEY `users_stripe_id_index` (`stripe_id`),
  ADD KEY `name` (`name`),
  ADD KEY `school_super` (`isSuper`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_sectors`
--
ALTER TABLE `account_sectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `admission_payments`
--
ALTER TABLE `admission_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_attendances`
--
ALTER TABLE `course_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course_configs`
--
ALTER TABLE `course_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_groups`
--
ALTER TABLE `course_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dues`
--
ALTER TABLE `dues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exam_for_classes`
--
ALTER TABLE `exam_for_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `grade_systems`
--
ALTER TABLE `grade_systems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `important_links`
--
ALTER TABLE `important_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lets_encripts`
--
ALTER TABLE `lets_encripts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `pre_admissions`
--
ALTER TABLE `pre_admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `school_payments`
--
ALTER TABLE `school_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `student_board_exams`
--
ALTER TABLE `student_board_exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `student_infos`
--
ALTER TABLE `student_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syllabuses`
--
ALTER TABLE `syllabuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacherinfos`
--
ALTER TABLE `teacherinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `templete_designs`
--
ALTER TABLE `templete_designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
