-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2019 at 03:57 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Logged In', '2018-08-05 04:57:19', '2018-08-05 04:57:19'),
(2, 'Logged Out', '2018-08-05 04:57:19', '2018-08-05 04:57:19'),
(3, 'Test Started', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(4, 'Test Ended', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(5, 'Question Created', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(6, 'Question Approved', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(7, 'Question Trashed', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(8, 'Question Restored', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(9, 'Question Modified', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(10, 'Test Granted', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(11, 'Test Snatched', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(12, 'Test Generated', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(13, 'Password Changed', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(14, 'Has Token', '2018-08-05 04:57:20', '2018-08-05 04:57:20'),
(15, 'Test Selected', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_user`
--

CREATE TABLE `activity_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expired_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(85, '2018_08_04_215229_create_option_question_user_table', 2),
(132, '2014_10_12_000000_create_users_table', 3),
(133, '2014_10_12_100000_create_password_resets_table', 3),
(134, '2018_07_09_144010_create_profiles_table', 3),
(135, '2018_07_10_075552_create_subjects_table', 3),
(136, '2018_07_21_052813_create_sections_table', 3),
(137, '2018_07_21_052919_create_subsections_table', 3),
(138, '2018_07_21_053020_create_questions_table', 3),
(139, '2018_07_21_053154_create_options_table', 3),
(140, '2018_07_26_150053_create_question_user_table', 3),
(141, '2018_07_26_170034_add_pre_post_images_to_question_table', 3),
(142, '2018_08_01_182304_create_sets_table', 3),
(143, '2018_08_01_183239_create_question_set_table', 3),
(144, '2018_08_04_225314_create_option_question_users_table', 3),
(145, '2018_08_04_235942_create_activities_table', 3),
(146, '2018_08_05_001041_create_activity_user_table', 3),
(147, '2018_08_06_154013_add_selected_to_sets_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` tinyint(1) NOT NULL DEFAULT '0',
  `question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `option_question_users`
--

CREATE TABLE `option_question_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/avatars/user.png',
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `security_question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `about`, `avatar`, `facebook`, `youtube`, `user_id`, `security_question`, `security_answer`, `created_at`, `updated_at`) VALUES
(1, 'Iam the first admin', 'uploads/avatars/admin.jpg', NULL, NULL, 1, NULL, NULL, '2018-08-05 04:57:19', '2018-08-05 04:57:19'),
(2, NULL, 'uploads/avatars/1533463097picture.jpg', NULL, NULL, 2, NULL, 'mine', '2018-08-05 04:57:46', '2018-08-05 04:58:17'),
(3, NULL, 'uploads/avatars/1533463142ahsan.jpg', NULL, NULL, 3, NULL, NULL, '2018-08-05 04:58:36', '2018-08-05 04:59:02'),
(4, NULL, 'uploads/avatars/user.png', NULL, NULL, 4, NULL, NULL, '2018-08-05 04:59:26', '2018-08-05 04:59:26'),
(5, NULL, 'uploads/avatars/1533569072noman.jpg', NULL, NULL, 5, NULL, NULL, '2018-08-06 10:21:10', '2018-08-06 10:24:32'),
(6, NULL, 'uploads/avatars/user.png', NULL, NULL, 6, NULL, NULL, '2018-08-09 04:36:52', '2018-08-09 04:36:52'),
(7, NULL, 'uploads/avatars/user.png', NULL, NULL, 8, NULL, NULL, '2018-08-09 04:40:40', '2018-08-09 04:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `statement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subsection_id` int(11) NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_time` timestamp NOT NULL DEFAULT '2018-08-05 04:57:03',
  `supervisor_time` timestamp NOT NULL DEFAULT '2018-08-05 04:57:03',
  `difficulty_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_age` int(11) NOT NULL,
  `current_age` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL,
  `success_ratio` int(11) NOT NULL DEFAULT '100',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pre_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `post_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE `question_set` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_user`
--

CREATE TABLE `question_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_questions` int(11) NOT NULL DEFAULT '0',
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

CREATE TABLE `sets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subsections`
--

CREATE TABLE `subsections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_questions` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) NOT NULL,
  `sequence_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_grant` tinyint(1) NOT NULL DEFAULT '0',
  `set` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `test_grant`, `set`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gcu.edu.pk', '$2y$10$7UbUV0OpXI6Yd2s8L.Q3seGm1PRxe/TLtBBEEqT/4225HiNsO8.mC', 'super', 0, '0', 'MiQO7GFLfSduMO2dt3OfeoO2JxIUwZ4OuqrMLqHdDaQNEryLrNSmRjYJQfdG', '2018-08-05 04:57:19', '2018-08-05 04:57:19'),
(2, 'Ertiza Ejaz', 'ertizaejaz@yahoo.com', '$2y$10$7UbUV0OpXI6Yd2s8L.Q3seGm1PRxe/TLtBBEEqT/4225HiNsO8.mC', 'specialist', 0, '0', '5Lgb74X3xWuNaMcJBFkRkLZMvgPWL0uDTUrk1kQkUbBjtgonokRInT0Alx4e', '2018-08-05 04:57:46', '2018-10-11 00:35:42'),
(3, 'Ahsan Liaqat', 'eartzaijaz@gmail.com', '$2y$10$7UbUV0OpXI6Yd2s8L.Q3seGm1PRxe/TLtBBEEqT/4225HiNsO8.mC', 'supervisor', 0, '0', 'QNUVTsu9WTSY5HCJSEgMRv8P1bTEESgejgbHWLcbvKBNYDyW3k3MTBInYTtv', '2018-08-05 04:58:36', '2018-10-11 00:35:49'),
(4, 'Amir Ali', 'ertejz@gmail.com', '$2y$10$7UbUV0OpXI6Yd2s8L.Q3seGm1PRxe/TLtBBEEqT/4225HiNsO8.mC', 'student', 0, '0', 'XHBuHLM4WP1t7d7lfo93zy10zDwutgQlI0aUIKMWdRv4LEQMsXxpDpTOGQ2G', '2018-08-05 04:59:26', '2018-08-05 05:00:00'),
(5, 'Noman Ali', 'nomicena@gmail.com', '$2y$10$H/W0X5xaUROQFDvOzVUcSewLZ78vq1FJCQkC.bCZWxE8kSkBFgY1.$2y$10$7UbUV0OpXI6Yd2s8L.Q3seGm1PRxe/TLtBBEEqT/4225HiNsO8.mC', 'specialist', 0, '0', 'SCqSogG9OvnMKtCgi4HozTnTPnDQjprHkLMwuXlXP3aAEXFDbcB6lelIjhRt', '2018-08-06 10:21:10', '2018-10-11 00:35:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_user`
--
ALTER TABLE `activity_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_question_users`
--
ALTER TABLE `option_question_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_set`
--
ALTER TABLE `question_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_user`
--
ALTER TABLE `question_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sets`
--
ALTER TABLE `sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsections`
--
ALTER TABLE `subsections`
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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `activity_user`
--
ALTER TABLE `activity_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `option_question_users`
--
ALTER TABLE `option_question_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_set`
--
ALTER TABLE `question_set`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_user`
--
ALTER TABLE `question_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sets`
--
ALTER TABLE `sets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subsections`
--
ALTER TABLE `subsections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
