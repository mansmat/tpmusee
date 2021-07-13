-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 04 juil. 2021 à 02:36
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musee`
--

-- --------------------------------------------------------

--
-- Structure de la table `bibliothèque`
--

CREATE TABLE `bibliothèque` (
  `ISBN` varchar(250) NOT NULL,
  `numMus` int(50) NOT NULL,
  `dateAchat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `moment`
--

CREATE TABLE `moment` (
  `jour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `musée`
--

CREATE TABLE `musée` (
  `numMus` int(11) NOT NULL,
  `nomMus` varchar(250) DEFAULT NULL,
  `nblivres` int(11) NOT NULL,
  `codePays` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `ISBN` varchar(250) NOT NULL,
  `nbPage` int(6) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `codePays` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`ISBN`, `nbPage`, `titre`, `codePays`) VALUES
('12345', 12, 'L\'arbre fétiche', 'BENIN');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `codePays` varchar(255) NOT NULL,
  `nbhabitant` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`codePays`, `nbhabitant`) VALUES
('BENIN', 80000000),
('NIG', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `referencer`
--

CREATE TABLE `referencer` (
  `nomSite` varchar(250) NOT NULL,
  `ISBN` varchar(250) NOT NULL,
  `numeroPage` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
  `nomSite` varchar(250) NOT NULL,
  `anneedecouv` date DEFAULT NULL,
  `codePays` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `visiter`
--

CREATE TABLE `visiter` (
  `numMus` int(11) NOT NULL,
  `jour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bibliothèque`
--
ALTER TABLE `bibliothèque`
  ADD PRIMARY KEY (`ISBN`,`numMus`);

--
-- Index pour la table `moment`
--
ALTER TABLE `moment`
  ADD PRIMARY KEY (`jour`);

--
-- Index pour la table `musée`
--
ALTER TABLE `musée`
  ADD PRIMARY KEY (`numMus`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`ISBN`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`codePays`);

--
-- Index pour la table `referencer`
--
ALTER TABLE `referencer`
  ADD PRIMARY KEY (`nomSite`,`ISBN`,`numeroPage`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`nomSite`);

--
-- Index pour la table `visiter`
--
ALTER TABLE `visiter`
  ADD PRIMARY KEY (`numMus`,`jour`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
