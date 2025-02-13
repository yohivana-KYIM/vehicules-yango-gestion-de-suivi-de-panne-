-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 12:07 PM
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
-- Database: `vehicules`
--

-- --------------------------------------------------------

--
-- Table structure for table `chauffeurs`
--

CREATE TABLE `chauffeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entretien_preventifs`
--

CREATE TABLE `entretien_preventifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intervention_id` bigint(20) UNSIGNED NOT NULL,
  `date_planifiee` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'planifie',
  `cout_estime` decimal(10,2) DEFAULT NULL,
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
-- Table structure for table `interventions`
--

CREATE TABLE `interventions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nature_intervention` varchar(255) NOT NULL,
  `duree_intervention` int(11) NOT NULL,
  `date_debut_intervention` datetime NOT NULL,
  `vehicule_id` bigint(20) UNSIGNED NOT NULL,
  `mecanicien_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interventions`
--

INSERT INTO `interventions` (`id`, `nature_intervention`, `duree_intervention`, `date_debut_intervention`, `vehicule_id`, `mecanicien_id`, `created_at`, `updated_at`) VALUES
(1, 'dd', 5, '2025-02-14 12:02:00', 1, 1, '2025-02-13 10:02:46', '2025-02-13 10:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `mecaniciens`
--

CREATE TABLE `mecaniciens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mecaniciens`
--

INSERT INTO `mecaniciens` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_09_081451_create_mecaniciens_table', 1),
(6, '2025_02_09_081449_create_vehicules_table', 1),
(7, '2025_02_09_081450_create_interventions_table', 1),
(8, '2025_02_09_081452_create_chauffeurs_table', 1),
(9, '2025_02_09_081454_create_pieces_utilisees_table', 1),
(10, '2025_02_09_081455_create_pannes_table', 1),
(11, '2025_02_09_081502_create_entretien_preventifs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pannes`
--

CREATE TABLE `pannes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nature` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `date_de_signalement` datetime NOT NULL,
  `vehicule_id` bigint(20) UNSIGNED NOT NULL,
  `chauffeur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\User', 4, 'auth_token', '7d3697f96d937d5ee34f0b415a77baf123c0068f9d5e089315541e68fce0f36c', '[\"*\"]', NULL, NULL, '2025-02-10 07:46:27', '2025-02-10 07:46:27'),
(15, 'App\\Models\\User', 5, 'auth_token', 'f91c46d8d6ae8072284e309f9001d79fd829b803ef23d320f67da3714b28b9fc', '[\"*\"]', NULL, NULL, '2025-02-12 07:25:08', '2025-02-12 07:25:08'),
(16, 'App\\Models\\User', 6, 'auth_token', '4756ad00e0c72ab4b2bd37f78e99e714a84e33bdec3f31a35fc01001eeb1c693', '[\"*\"]', NULL, NULL, '2025-02-12 07:52:51', '2025-02-12 07:52:51'),
(18, 'App\\Models\\User', 7, 'auth_token', 'a70c9b09bf8a4ac8de5a28ad17cfb0a744fd8bf9970733e1f8d8698b98db64c6', '[\"*\"]', NULL, NULL, '2025-02-12 08:03:44', '2025-02-12 08:03:44'),
(22, 'App\\Models\\User', 1, 'auth_token', '272b7a6ff4683573aed28692789938a8d992e39ad1cb790085244f11ee1ba6a9', '[\"*\"]', '2025-02-12 15:52:18', NULL, '2025-02-12 15:50:51', '2025-02-12 15:52:18'),
(23, 'App\\Models\\User', 1, 'auth_token', '9aeecbdc28df7852ba62416948c85d2e7afd18d1f065bdaab798bc6d31ff984b', '[\"*\"]', '2025-02-13 10:02:26', NULL, '2025-02-13 09:36:37', '2025-02-13 10:02:26'),
(24, 'App\\Models\\User', 8, 'auth_token', 'b408af11d460b7d2dac84b7b9c485cfb67ac924731d56bdd6aad063193e45fbb', '[\"*\"]', NULL, NULL, '2025-02-13 09:59:17', '2025-02-13 09:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `pieces_utilisees`
--

CREATE TABLE `pieces_utilisees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fournisseur` varchar(255) NOT NULL,
  `date_de_montage` datetime NOT NULL,
  `date_de_changement` datetime NOT NULL,
  `intervention_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'chauffeur',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$Eg2CcC/hbgwUrD0xKNnmg.0t6N2gvt.XUZrDWAitiA4UFEJrcSnMK', 'admin', NULL, NULL, NULL),
(2, 'Gestionnaire', 'gestionnaire@example.com', NULL, '$2y$12$mCngp3ofEN8Ae9ErW8ENge6Lnl1j3yJ1srXahUbbNCktKeD.3qhO2', 'gestionnaire', NULL, NULL, NULL),
(3, 'Chauffeur', 'chauffeur@example.com', NULL, '$2y$12$QUdm/7PX8jgkSCdgflVWde2Sj1UJF5dW2THKTaaY2zaEY2istTYmu', 'chauffeur', NULL, NULL, NULL),
(4, 'aaa', 'cremin.hollis@example.com', NULL, '$2y$12$yRUAG0OXky7yqtU3Qu2areAVzrAI9MeCfaX/hRsBu0.7BfSeSbtou', 'gestionnaire', NULL, '2025-02-10 07:46:27', '2025-02-10 07:46:27'),
(8, 'abdou', 'njutapmvouiabdouchirac@gmail.com', NULL, '$2y$12$LTVLBVRuY0cr0x.pVBxHWuPEfAIIyg7EuKQyEtgc1GjFTOQgujzWW', 'chauffeur', NULL, '2025-02-13 09:59:17', '2025-02-13 09:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marque` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `nom_proprietaire` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicules`
--

INSERT INTO `vehicules` (`id`, `marque`, `model`, `nom_proprietaire`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'Camry', 'John Doe', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chauffeurs_user_id_foreign` (`user_id`);

--
-- Indexes for table `entretien_preventifs`
--
ALTER TABLE `entretien_preventifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entretien_preventifs_intervention_id_foreign` (`intervention_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interventions_vehicule_id_foreign` (`vehicule_id`),
  ADD KEY `interventions_mecanicien_id_foreign` (`mecanicien_id`);

--
-- Indexes for table `mecaniciens`
--
ALTER TABLE `mecaniciens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mecaniciens_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pannes`
--
ALTER TABLE `pannes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pannes_vehicule_id_foreign` (`vehicule_id`),
  ADD KEY `pannes_chauffeur_id_foreign` (`chauffeur_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pieces_utilisees`
--
ALTER TABLE `pieces_utilisees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pieces_utilisees_intervention_id_foreign` (`intervention_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entretien_preventifs`
--
ALTER TABLE `entretien_preventifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mecaniciens`
--
ALTER TABLE `mecaniciens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pannes`
--
ALTER TABLE `pannes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pieces_utilisees`
--
ALTER TABLE `pieces_utilisees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD CONSTRAINT `chauffeurs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `entretien_preventifs`
--
ALTER TABLE `entretien_preventifs`
  ADD CONSTRAINT `entretien_preventifs_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `interventions` (`id`);

--
-- Constraints for table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `interventions_mecanicien_id_foreign` FOREIGN KEY (`mecanicien_id`) REFERENCES `mecaniciens` (`id`),
  ADD CONSTRAINT `interventions_vehicule_id_foreign` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`);

--
-- Constraints for table `mecaniciens`
--
ALTER TABLE `mecaniciens`
  ADD CONSTRAINT `mecaniciens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pannes`
--
ALTER TABLE `pannes`
  ADD CONSTRAINT `pannes_chauffeur_id_foreign` FOREIGN KEY (`chauffeur_id`) REFERENCES `chauffeurs` (`id`),
  ADD CONSTRAINT `pannes_vehicule_id_foreign` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`);

--
-- Constraints for table `pieces_utilisees`
--
ALTER TABLE `pieces_utilisees`
  ADD CONSTRAINT `pieces_utilisees_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `interventions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
