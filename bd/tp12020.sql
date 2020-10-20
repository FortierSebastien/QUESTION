-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 20 oct. 2020 à 00:01
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tp12020`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `note`, `commentaire`, `detail`, `created`, `modified`, `meal_id`) VALUES
(2, '10', 'wow', 'c\'est sublime', NULL, NULL, 1),
(3, '10', 'trop bonnn', 'Sebastien', '2020-10-14', '2020-10-14', 0),
(4, '10', '2', 'saa', '2020-10-14', '2020-10-14', 0),
(5, '01', 'ok', 'seb', '2020-10-14', '2020-10-14', 0),
(6, '12', '21', '12', '2020-10-14', '2020-10-14', 0),
(7, '4', 'test', 'seb', '2020-10-14', '2020-10-14', 0),
(8, '4', 'test', 'seb', '2020-10-14', '2020-10-14', 0),
(9, '10', 'svp Fonctionne', 'svp', '2020-10-14', '2020-10-14', 0),
(10, 'si ', 'si sa marche wtf', 'ok', '2020-10-14', '2020-10-14', 0),
(11, '4', 'dfs', 'fs', '2020-10-14', '2020-10-14', 0),
(12, 'sdas', 'das', 'dsadsa', '2020-10-14', '2020-10-14', 0),
(13, 'salut', '\"\"', 'Fortier', '2020-10-19', '2020-10-19', 4),
(14, '10', '\"\"', 'WOW', '2020-10-19', '2020-10-19', 4);

-- --------------------------------------------------------

--
-- Structure de la table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `prenom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `experience` int(2) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employers`
--

INSERT INTO `employers` (`id`, `prenom`, `nom`, `experience`, `created`, `modified`) VALUES
(3, 'seb', 'fortier', 2, '2020-09-30', '2020-09-30');

-- --------------------------------------------------------

--
-- Structure de la table `i18n`
--

CREATE TABLE `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'en_US', 'Meals', 1, 'nom', 'pizza_en'),
(2, 'fr_CA', 'Meals', 4, 'nom', 'pizza_fr'),
(3, 'ja_JP', 'Meals', 4, 'nom', 'pizza_ja'),
(4, 'ja_JP', 'Meals', 9, 'nom', 'Sesshon ni tsuika'),
(5, 'ja_JP', 'Meals', 11, 'nom', 'Supagetti'),
(6, 'ja_JP', 'Meals', 13, 'nom', 'Umi no same'),
(7, 'ja_JP', 'Meals', 12, 'nom', 'Rakuretto'),
(8, 'fr_CA', 'Clients', 13, 'commentaire', '\"\"'),
(9, 'fr_CA', 'Clients', 14, 'commentaire', 'lol');

-- --------------------------------------------------------

--
-- Structure de la table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `prix` double NOT NULL,
  `date` date NOT NULL,
  `grosseur` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `slug` varchar(61) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `meals`
--

INSERT INTO `meals` (`id`, `prix`, `date`, `grosseur`, `employer_id`, `client_id`, `user_id`, `created`, `modified`, `slug`, `nom`) VALUES
(4, 20, '2020-10-13', 'M', 1, 1, 1, '2020-09-30', '2020-10-19', 'first one', 'pizza_en'),
(9, 30, '2020-10-14', 'S', 3, 2, 1, '2020-10-14', '2020-10-19', 'Ajouter-en-session', 'Add in session'),
(11, 23, '2020-10-14', 'S', 3, 2, 2, '2020-10-14', '2020-10-19', 'Spaghetti', 'Spaghetti'),
(12, 33, '2020-10-14', 'M', 3, 2, 3, '2020-10-14', '2020-10-19', 'Raclette', 'Raclette'),
(13, 76, '2020-10-14', 'G', 3, 2, 4, '2020-10-14', '2020-10-19', 'requin-de-mer', 'Sea Shark');

-- --------------------------------------------------------

--
-- Structure de la table `meals_tags`
--

CREATE TABLE `meals_tags` (
  `meal_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'admin', 'Peux voir les utilisateurs', NULL, NULL),
(2, 'visiteur', 'Possede aucun pouvoir de modification', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `modified`, `role_id`) VALUES
(1, 'admin@admin.ca', '$2y$10$B66wvnP004ABv.sJgHRkCeqkOIYyAqOZHNX0VW1uge4vgB.x5h2BO', '2020-10-13', '2020-10-14', 1),
(2, 'admin@Test.com', '$2y$10$WKItHWKbyJb2uN0KOiEC3eiI9bny4MYmaIG/G0.N1iTkbXSqOcv1u', '2020-10-14', '2020-10-14', 1),
(3, 'Sebastien@hotmail.com', '$2y$10$agNaPjP3q.czz33741dXE.JIjxCwxtpe626ywIWgu1eYQfP6QrJOe', '2020-10-14', '2020-10-14', 1),
(4, 'go_seb_go@hotmail.com', '$2y$10$eq1lBhr6VAvLQfTJT6pqCeZfP/5kSuSa97aOUGO.DbNLGnSxNDWim', '2020-10-14', '2020-10-14', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Index pour la table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Index pour la table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `client_id` (`client_id`) USING BTREE,
  ADD KEY `employer_id` (`employer_id`) USING BTREE;

--
-- Index pour la table `meals_tags`
--
ALTER TABLE `meals_tags`
  ADD PRIMARY KEY (`meal_id`,`tag_id`),
  ADD KEY `tag_key` (`tag_id`) USING BTREE;

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
