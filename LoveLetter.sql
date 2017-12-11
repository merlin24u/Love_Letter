-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 11 Décembre 2017 à 16:08
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
  `effet` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Carte`
--

INSERT INTO `Carte` (`idCarte`, `nom`, `valeur`, `effet`) VALUES
(1, 'Guard', 1, 'Name a non Guard card and choose another player. If that player has that card, he or she is out of the round'),
(2, 'Priest', 2, 'Look at another player''s hand'),
(3, 'Baron', 3, 'You and another player secretly compare hands. The player with the lower value is out of the round'),
(4, 'Handmaid', 4, 'Until your next turn, ignore all effects from player''s cards'),
(5, 'Prince', 5, 'Choose any player including yourself to discard his or her hand and draw a new card'),
(6, 'King', 6, 'Trade hands with another player of your choice'),
(7, 'Countess', 7, 'If you have this card and the King or Prince in your hand, you must discard this card'),
(8, 'Princess', 8, 'If you discard this card, you are out of the round');

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
  `valeur` int(11) DEFAULT NULL,
  `idLogin` int(11) DEFAULT NULL,
  `idManche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DefaussePossede`
--

CREATE TABLE `DefaussePossede` (
  `id` int(11) NOT NULL,
  `defausse` int(11) DEFAULT NULL,
  `carte` int(11) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Structure de la table `Main`
--

CREATE TABLE `Main` (
  `idMain` int(11) NOT NULL,
  `idLogin` int(11) DEFAULT NULL,
  `idManche` int(11) DEFAULT NULL,
  `carteJouee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MainPossede`
--

CREATE TABLE `MainPossede` (
  `id` int(11) NOT NULL,
  `main` int(11) DEFAULT NULL,
  `carte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Manche`
--

CREATE TABLE `Manche` (
  `idManche` int(11) NOT NULL,
  `fini` tinyint(1) DEFAULT NULL,
  `idPartie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Participe`
--

CREATE TABLE `Participe` (
  `score` int(11) DEFAULT NULL,
  `token` tinyint(1) DEFAULT NULL,
  `pioche` tinyint(1) DEFAULT NULL,
  `éliminé` tinyint(1) DEFAULT NULL,
  `idPartie` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  ADD KEY `IDX_EF9E9909BDCC880D` (`idLogin`),
  ADD KEY `IDX_EF9E9909C37FCA71` (`idManche`);

--
-- Index pour la table `DeckPossede`
--
ALTER TABLE `DeckPossede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BD6DE6D34FAC3637` (`deck`),
  ADD KEY `IDX_BD6DE6D3BAD4FFFD` (`carte`);

--
-- Index pour la table `Defausse`
--
ALTER TABLE `Defausse`
  ADD PRIMARY KEY (`idDefausse`),
  ADD KEY `IDX_5818FBC3BDCC880D` (`idLogin`),
  ADD KEY `IDX_5818FBC3C37FCA71` (`idManche`);

--
-- Index pour la table `DefaussePossede`
--
ALTER TABLE `DefaussePossede`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `IDX_1F1A625ABDCC880D` (`idLogin`),
  ADD KEY `IDX_1F1A625AC37FCA71` (`idManche`),
  ADD KEY `IDX_1F1A625A3A47B9ED` (`carteJouee`);

--
-- Index pour la table `MainPossede`
--
ALTER TABLE `MainPossede`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT pour la table `DefaussePossede`
--
ALTER TABLE `DefaussePossede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Joueur`
--
ALTER TABLE `Joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Main`
--
ALTER TABLE `Main`
  MODIFY `idMain` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `MainPossede`
--
ALTER TABLE `MainPossede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Manche`
--
ALTER TABLE `Manche`
  MODIFY `idManche` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Partie`
--
ALTER TABLE `Partie`
  MODIFY `idPartie` int(11) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `FK_1F1A625A3A47B9ED` FOREIGN KEY (`carteJouee`) REFERENCES `Carte` (`idCarte`),
  ADD CONSTRAINT `FK_1F1A625ABDCC880D` FOREIGN KEY (`idLogin`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `FK_1F1A625AC37FCA71` FOREIGN KEY (`idManche`) REFERENCES `Manche` (`idManche`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
