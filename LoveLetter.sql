-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 01 Décembre 2017 à 15:52
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
  `idCarte` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valeur` int(11) DEFAULT NULL,
  `effet` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Deck`
--

CREATE TABLE `Deck` (
  `idDeck` int(11) NOT NULL,
  `idLogin` int(11) DEFAULT NULL,
  `idManche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DeckPossede`
--

CREATE TABLE `DeckPossede` (
  `id` int(11) NOT NULL,
  `deck` int(11) DEFAULT NULL,
  `carte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Defausse`
--

CREATE TABLE `Defausse` (
  `idDefausse` int(11) NOT NULL,
  `idLogin` int(11) DEFAULT NULL,
  `idManche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DefaussePossede`
--

CREATE TABLE `DefaussePossede` (
  `defausse` int(11) NOT NULL,
  `carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Joueur`
--

CREATE TABLE `Joueur` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Joueur`
--

INSERT INTO `Joueur` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'stirpoiler', 'stirpoiler', 'test.test@gmail.com', 'test.test@gmail.com', 1, '7LnUe0lJczpErW.wW4LQXsUq.vavYyUIkbsq8.pQEHY', 'GiLSmJ3AH/lQw0z7iQIcL3Z6+G8JMIYpjaCRPdYLVBV6pLN9/6m0BnrqZkNDffNCnlxY8n3SyG99C5JjDf8LDg==', '2017-12-01 15:21:29', NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}'),
(2, 'test', 'test', 'test.test2@gmail.com', 'test.test2@gmail.com', 1, 'ttbSNrjC5IpUl7EDAf0PM21PJSWe4rDyudu/rkTeDls', 'wWxVYtgdxwbcvqJ781oufBZinv17x+Dov99jX3KgRbtDfdy82VL4tVvLF1bGxTlgRI1XvcFFKfgJvwou8EekiA==', '2017-12-01 15:17:12', NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}');

-- --------------------------------------------------------

--
-- Structure de la table `Main`
--

CREATE TABLE `Main` (
  `idMain` int(11) NOT NULL,
  `idLogin` int(11) DEFAULT NULL,
  `idTour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MainPossede`
--

CREATE TABLE `MainPossede` (
  `main` int(11) NOT NULL,
  `carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Manche`
--

CREATE TABLE `Manche` (
  `idManche` int(11) NOT NULL,
  `token` tinyint(1) DEFAULT NULL,
  `idPartie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Participe`
--

CREATE TABLE `Participe` (
  `score` int(11) DEFAULT NULL,
  `token` tinyint(1) DEFAULT NULL,
  `idPartie` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Participe`
--

INSERT INTO `Participe` (`score`, `token`, `idPartie`, `idLogin`) VALUES
(-1, 0, 4, 1),
(-1, 0, 4, 2),
(-1, 0, 5, 1),
(-1, 0, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Partie`
--

CREATE TABLE `Partie` (
  `gagnant` int(11) DEFAULT NULL,
  `idPartie` int(11) NOT NULL,
  `nbJoueurs` int(11) DEFAULT NULL,
  `ouverte` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Partie`
--

INSERT INTO `Partie` (`gagnant`, `idPartie`, `nbJoueurs`, `ouverte`) VALUES
(NULL, 4, 2, 0),
(NULL, 5, 2, 1),
(NULL, 6, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Tour`
--

CREATE TABLE `Tour` (
  `idTour` int(11) NOT NULL,
  `idManche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Carte`
--
ALTER TABLE `Carte`
  ADD PRIMARY KEY (`idCarte`);

--
-- Index pour la table `Deck`
--
ALTER TABLE `Deck`
  ADD PRIMARY KEY (`idDeck`),
  ADD UNIQUE KEY `UNIQ_EF9E9909BDCC880D` (`idLogin`),
  ADD KEY `IDX_EF9E9909C37FCA71` (`idManche`);

--
-- Index pour la table `DeckPossede`
--
ALTER TABLE `DeckPossede`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BD6DE6D34FAC3637` (`deck`),
  ADD UNIQUE KEY `UNIQ_BD6DE6D3BAD4FFFD` (`carte`);

--
-- Index pour la table `Defausse`
--
ALTER TABLE `Defausse`
  ADD PRIMARY KEY (`idDefausse`),
  ADD UNIQUE KEY `UNIQ_5818FBC3BDCC880D` (`idLogin`),
  ADD KEY `IDX_5818FBC3C37FCA71` (`idManche`);

--
-- Index pour la table `DefaussePossede`
--
ALTER TABLE `DefaussePossede`
  ADD PRIMARY KEY (`defausse`,`carte`),
  ADD KEY `IDX_2E3FBB56A16E9995` (`defausse`),
  ADD KEY `IDX_2E3FBB56BAD4FFFD` (`carte`);

--
-- Index pour la table `Joueur`
--
ALTER TABLE `Joueur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FADDACF392FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_FADDACF3A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_FADDACF3C05FB297` (`confirmation_token`);

--
-- Index pour la table `Main`
--
ALTER TABLE `Main`
  ADD PRIMARY KEY (`idMain`),
  ADD UNIQUE KEY `UNIQ_1F1A625ABDCC880D` (`idLogin`),
  ADD UNIQUE KEY `UNIQ_1F1A625A192CA7F7` (`idTour`);

--
-- Index pour la table `MainPossede`
--
ALTER TABLE `MainPossede`
  ADD PRIMARY KEY (`main`,`carte`),
  ADD KEY `IDX_1205FCD6BF28CD64` (`main`),
  ADD KEY `IDX_1205FCD6BAD4FFFD` (`carte`);

--
-- Index pour la table `Manche`
--
ALTER TABLE `Manche`
  ADD PRIMARY KEY (`idManche`),
  ADD KEY `IDX_A7C267DD668AB7A7` (`idPartie`);

--
-- Index pour la table `Participe`
--
ALTER TABLE `Participe`
  ADD PRIMARY KEY (`idPartie`,`idLogin`),
  ADD KEY `IDX_8B0E2A77668AB7A7` (`idPartie`),
  ADD KEY `IDX_8B0E2A77BDCC880D` (`idLogin`);

--
-- Index pour la table `Partie`
--
ALTER TABLE `Partie`
  ADD PRIMARY KEY (`idPartie`),
  ADD KEY `IDX_2371A0B53D089C` (`gagnant`);

--
-- Index pour la table `Tour`
--
ALTER TABLE `Tour`
  ADD PRIMARY KEY (`idTour`),
  ADD KEY `IDX_CAE35657C37FCA71` (`idManche`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Deck`
--
ALTER TABLE `Deck`
  MODIFY `idDeck` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `DeckPossede`
--
ALTER TABLE `DeckPossede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Defausse`
--
ALTER TABLE `Defausse`
  MODIFY `idDefausse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Joueur`
--
ALTER TABLE `Joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Main`
--
ALTER TABLE `Main`
  MODIFY `idMain` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Manche`
--
ALTER TABLE `Manche`
  MODIFY `idManche` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Partie`
--
ALTER TABLE `Partie`
  MODIFY `idPartie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Tour`
--
ALTER TABLE `Tour`
  MODIFY `idTour` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Deck`
--
ALTER TABLE `Deck`
  ADD CONSTRAINT `FK_EF9E9909BDCC880D` FOREIGN KEY (`idLogin`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `FK_EF9E9909C37FCA71` FOREIGN KEY (`idManche`) REFERENCES `Manche` (`idManche`);

--
-- Contraintes pour la table `DeckPossede`
--
ALTER TABLE `DeckPossede`
  ADD CONSTRAINT `FK_BD6DE6D34FAC3637` FOREIGN KEY (`deck`) REFERENCES `Deck` (`idDeck`),
  ADD CONSTRAINT `FK_BD6DE6D3BAD4FFFD` FOREIGN KEY (`carte`) REFERENCES `Carte` (`idCarte`);

--
-- Contraintes pour la table `Defausse`
--
ALTER TABLE `Defausse`
  ADD CONSTRAINT `FK_5818FBC3BDCC880D` FOREIGN KEY (`idLogin`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `FK_5818FBC3C37FCA71` FOREIGN KEY (`idManche`) REFERENCES `Manche` (`idManche`);

--
-- Contraintes pour la table `DefaussePossede`
--
ALTER TABLE `DefaussePossede`
  ADD CONSTRAINT `FK_2E3FBB56A16E9995` FOREIGN KEY (`defausse`) REFERENCES `Defausse` (`idDefausse`),
  ADD CONSTRAINT `FK_2E3FBB56BAD4FFFD` FOREIGN KEY (`carte`) REFERENCES `Carte` (`idCarte`);

--
-- Contraintes pour la table `Main`
--
ALTER TABLE `Main`
  ADD CONSTRAINT `FK_1F1A625A192CA7F7` FOREIGN KEY (`idTour`) REFERENCES `Tour` (`idTour`),
  ADD CONSTRAINT `FK_1F1A625ABDCC880D` FOREIGN KEY (`idLogin`) REFERENCES `Joueur` (`id`);

--
-- Contraintes pour la table `MainPossede`
--
ALTER TABLE `MainPossede`
  ADD CONSTRAINT `FK_1205FCD6BAD4FFFD` FOREIGN KEY (`carte`) REFERENCES `Carte` (`idCarte`),
  ADD CONSTRAINT `FK_1205FCD6BF28CD64` FOREIGN KEY (`main`) REFERENCES `Main` (`idMain`);

--
-- Contraintes pour la table `Manche`
--
ALTER TABLE `Manche`
  ADD CONSTRAINT `FK_A7C267DD668AB7A7` FOREIGN KEY (`idPartie`) REFERENCES `Partie` (`idPartie`);

--
-- Contraintes pour la table `Participe`
--
ALTER TABLE `Participe`
  ADD CONSTRAINT `FK_8B0E2A77668AB7A7` FOREIGN KEY (`idPartie`) REFERENCES `Partie` (`idPartie`),
  ADD CONSTRAINT `FK_8B0E2A77BDCC880D` FOREIGN KEY (`idLogin`) REFERENCES `Joueur` (`id`);

--
-- Contraintes pour la table `Partie`
--
ALTER TABLE `Partie`
  ADD CONSTRAINT `FK_2371A0B53D089C` FOREIGN KEY (`gagnant`) REFERENCES `Joueur` (`id`);

--
-- Contraintes pour la table `Tour`
--
ALTER TABLE `Tour`
  ADD CONSTRAINT `FK_CAE35657C37FCA71` FOREIGN KEY (`idManche`) REFERENCES `Manche` (`idManche`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
