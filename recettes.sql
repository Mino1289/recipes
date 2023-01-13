-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 jan. 2023 à 12:04
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `ID_auteur` int(11) NOT NULL,
  `auteur_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`ID_auteur`, `auteur_name`) VALUES
(1, 'Inconnu');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `ID_category` int(11) NOT NULL,
  `category_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`ID_category`, `category_name`) VALUES
(1, 'Inconnu');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `ID_livre` int(11) NOT NULL,
  `livre_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`ID_livre`, `livre_name`) VALUES
(1, 'Inconnu');

-- --------------------------------------------------------

--
-- Structure de la table `orientation`
--

CREATE TABLE `orientation` (
  `ID_orientation` int(11) NOT NULL,
  `orientation_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orientation`
--

INSERT INTO `orientation` (`ID_orientation`, `orientation_name`) VALUES
(1, "Pas d'orientation");

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `ID_recette` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `ID_livre` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `ID_auteur` int(11) NOT NULL,
  `ID_category` int(11) NOT NULL,
  `ID_orientation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`ID_auteur`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_category`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`ID_livre`);

--
-- Index pour la table `orientation`
--
ALTER TABLE `orientation`
  ADD PRIMARY KEY (`ID_orientation`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`ID_recette`),
  ADD KEY `ID_livre` (`ID_livre`),
  ADD KEY `ID_auteur` (`ID_auteur`),
  ADD KEY `ID_category` (`ID_category`),
  ADD KEY `ID_orientation` (`ID_orientation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `ID_auteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `ID_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `ID_livre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orientation`
--
ALTER TABLE `orientation`
  MODIFY `ID_orientation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `ID_recette` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_ibfk_1` FOREIGN KEY (`ID_livre`) REFERENCES `livre` (`ID_livre`),
  ADD CONSTRAINT `recette_ibfk_2` FOREIGN KEY (`ID_category`) REFERENCES `category` (`ID_category`),
  ADD CONSTRAINT `recette_ibfk_3` FOREIGN KEY (`ID_auteur`) REFERENCES `auteur` (`ID_auteur`),
  ADD CONSTRAINT `recette_ibfk_4` FOREIGN KEY (`ID_orientation`) REFERENCES `orientation` (`ID_orientation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
