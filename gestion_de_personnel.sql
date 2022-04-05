-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2020 at 09:46 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_de_personnel`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
CREATE TABLE IF NOT EXISTS `absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im` varchar(6) NOT NULL,
  `etat` enum('non','oui') NOT NULL DEFAULT 'non',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `im` (`im`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bilan_absences`
--

DROP TABLE IF EXISTS `bilan_absences`;
CREATE TABLE IF NOT EXISTS `bilan_absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im` varchar(6) NOT NULL,
  `duree` int(3) NOT NULL,
  `status` enum('oui','non') NOT NULL DEFAULT 'non',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im` (`im`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_demande` date NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personnel_num_matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_demande_id` int(11) NOT NULL,
  `status` enum('refus','allow') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'refus',
  `nbrs` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demandes_personnel_num_matricule_foreign` (`personnel_num_matricule`),
  KEY `demandes_type_demande_id_foreign` (`type_demande_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histo_pointages`
--

DROP TABLE IF EXISTS `histo_pointages`;
CREATE TABLE IF NOT EXISTS `histo_pointages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heure_entre` time NOT NULL,
  `heure_sortie` time NOT NULL,
  `im` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `histo_pointages_im_foreign` (`im`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2020_03_10_194917_create_personnels_table', 1),
(9, '2020_03_10_195610_create_type_demandes_table', 1),
(10, '2020_03_10_195612_create_demandes_table', 1),
(11, '2020_03_10_195613_create_users_table', 1),
(12, '2020_03_10_202114_create_pointages_table', 1),
(13, '2020_03_31_112516_create_histo_pointages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
CREATE TABLE IF NOT EXISTS `personnels` (
  `num_matricule` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('Masculin','Feminin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situation_familiale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_identity` varchar(2555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`num_matricule`),
  UNIQUE KEY `personnels_email_unique` (`email`),
  UNIQUE KEY `personnels_telephone_unique` (`telephone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personnels`
--

INSERT INTO `personnels` (`num_matricule`, `nom_prenom`, `profile`, `sexe`, `email`, `situation_familiale`, `telephone`, `secret_identity`, `created_at`, `updated_at`) VALUES
('212122', 'admin', 'femme.png', 'Feminin', 'admin@gmail.com', 'Marié(e)', '0348805690', '2193-5072-8235admin@gmail.com', '2020-04-04 12:57:23', '2020-04-04 12:57:23');

--
-- Triggers `personnels`
--
DROP TRIGGER IF EXISTS `updatelogss`;
DELIMITER $$
CREATE TRIGGER `updatelogss` AFTER UPDATE ON `personnels` FOR EACH ROW UPDATE `users` SET `email_personnel` =New.email WHERE `personnel_num_matricule`=New.num_matricule
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pointages`
--

DROP TABLE IF EXISTS `pointages`;
CREATE TABLE IF NOT EXISTS `pointages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heure_entre` time NOT NULL,
  `heure_sortie` time DEFAULT NULL,
  `personnel_num_matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pointages_personnel_num_matricule_foreign` (`personnel_num_matricule`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanctions`
--

DROP TABLE IF EXISTS `sanctions`;
CREATE TABLE IF NOT EXISTS `sanctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im` varchar(6) NOT NULL,
  `jour_manque` int(3) NOT NULL,
  `nbjrs` int(4) NOT NULL,
  `lib` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_demandes`
--

DROP TABLE IF EXISTS `type_demandes`;
CREATE TABLE IF NOT EXISTS `type_demandes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_sanctions`
--

DROP TABLE IF EXISTS `type_sanctions`;
CREATE TABLE IF NOT EXISTS `type_sanctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personnel_num_matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_personnel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('ROLE_ADMIN','ROLE_USER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ROLE_USER',
  `question1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email_personnel`),
  KEY `users_personnel_num_matricule_foreign` (`personnel_num_matricule`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `personnel_num_matricule`, `email_personnel`, `password`, `created_at`, `updated_at`, `role`, `question1`, `question2`) VALUES
(7, '212122', 'admin@gmail.com', '$2y$10$5ac6cYKDn5Mw4Q5tqzdGi.t25tNbBsGgk6WeEmKDix7iqbkXKJAnq', '2020-04-05 07:29:47', '2020-04-05 07:29:47', 'ROLE_ADMIN', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
