-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 11 Novembre 2017 à 14:15
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `LoveLetter`
--

-- --------------------------------------------------------

--
-- Structure de la table `Carte`
--

CREATE TABLE `Carte` (
  `nom` varchar(20) NOT NULL,
  `valeur` int(11) DEFAULT NULL,
  `effet` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Defausse`
--

CREATE TABLE `Defausse` (
  `idDefausse` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `nbManche` int(11) NOT NULL,
  `idPartie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Joueur`
--

CREATE TABLE `Joueur` (
  `login` varchar(20) NOT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Main`
--

CREATE TABLE `Main` (
  `idMain` int(11) NOT NULL,
  `idTour` int(11) NOT NULL,
  `nbManche` int(11) NOT NULL,
  `idPartie` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `carteJouee` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Manche`
--

CREATE TABLE `Manche` (
  `nbManche` int(11) NOT NULL,
  `idPartie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Partie`
--

CREATE TABLE `Partie` (
  `idPartie` int(11) NOT NULL,
  `nbJoueurs` int(11) DEFAULT NULL,
  `gagnant` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Tour`
--

CREATE TABLE `Tour` (
  `idTour` int(11) NOT NULL,
  `nbManche` int(11) NOT NULL,
  `idPartie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Carte`
--
ALTER TABLE `Carte`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `Defausse`
--
ALTER TABLE `Defausse`
  ADD PRIMARY KEY (`idDefausse`,`login`,`nbManche`,`idPartie`),
  ADD KEY `FKDefausse1` (`login`),
  ADD KEY `FKDefausse2` (`nbManche`,`idPartie`);

--
-- Index pour la table `Joueur`
--
ALTER TABLE `Joueur`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `Main`
--
ALTER TABLE `Main`
  ADD PRIMARY KEY (`idMain`,`idTour`,`nbManche`,`idPartie`,`login`),
  ADD KEY `FKMain1` (`login`),
  ADD KEY `FKMain2` (`idTour`,`nbManche`,`idPartie`);

--
-- Index pour la table `Manche`
--
ALTER TABLE `Manche`
  ADD PRIMARY KEY (`nbManche`,`idPartie`),
  ADD KEY `FKManche` (`idPartie`);

--
-- Index pour la table `Partie`
--
ALTER TABLE `Partie`
  ADD PRIMARY KEY (`idPartie`),
  ADD KEY `FKPartie` (`gagnant`);

--
-- Index pour la table `Tour`
--
ALTER TABLE `Tour`
  ADD PRIMARY KEY (`idTour`,`nbManche`,`idPartie`),
  ADD KEY `FKTour` (`nbManche`,`idPartie`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Defausse`
--
ALTER TABLE `Defausse`
  ADD CONSTRAINT `FKDefausse1` FOREIGN KEY (`login`) REFERENCES `Joueur` (`login`),
  ADD CONSTRAINT `FKDefausse2` FOREIGN KEY (`nbManche`,`idPartie`) REFERENCES `Manche` (`nbManche`, `idPartie`);

--
-- Contraintes pour la table `Main`
--
ALTER TABLE `Main`
  ADD CONSTRAINT `FKMain1` FOREIGN KEY (`login`) REFERENCES `Joueur` (`login`),
  ADD CONSTRAINT `FKMain2` FOREIGN KEY (`idTour`,`nbManche`,`idPartie`) REFERENCES `Tour` (`idTour`, `nbManche`, `idPartie`);

--
-- Contraintes pour la table `Manche`
--
ALTER TABLE `Manche`
  ADD CONSTRAINT `FKManche` FOREIGN KEY (`idPartie`) REFERENCES `Partie` (`idPartie`);

--
-- Contraintes pour la table `Partie`
--
ALTER TABLE `Partie`
  ADD CONSTRAINT `FKPartie` FOREIGN KEY (`gagnant`) REFERENCES `Joueur` (`login`);

--
-- Contraintes pour la table `Tour`
--
ALTER TABLE `Tour`
  ADD CONSTRAINT `FKTour` FOREIGN KEY (`nbManche`,`idPartie`) REFERENCES `Manche` (`nbManche`, `idPartie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
