-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 28 sep. 2021 à 00:27
-- Version du serveur :  5.7.24
-- Version de PHP :  7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testvuelaravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `entities`
--

CREATE TABLE `entities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'pdf' COMMENT 'type of the entity create (pdf, html, link)',
  `url` text,
  `content` longtext,
  `source` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entities`
--

INSERT INTO `entities` (`id`, `title`, `type`, `url`, `content`, `source`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'first document create', 'pdf', NULL, NULL, '/download/first_doc.pdf', '2021-09-28 00:01:02', '2021-09-28 00:01:02', NULL),
(2, 'second document create', 'link', 'https://google.com', NULL, '', '2021-09-28 00:01:02', '2021-09-28 00:01:02', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
