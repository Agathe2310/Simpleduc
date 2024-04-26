-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 05 jan. 2023 à 15:00
-- Version du serveur : 10.3.31-MariaDB-0+deb10u1
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Bonjour-projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Contact`
--

CREATE TABLE `Contact` (
  `IDPersonne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `IDContrat` int(11) NOT NULL,
  `DateSignature` date DEFAULT NULL,
  `CoutGlobal` float DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `IDPersonne` int(11) NOT NULL,
  `IDEntre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Coordonnees`
--

CREATE TABLE `Coordonnees` (
  `IDCoord` int(11) NOT NULL,
  `Rue` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `IDPersonne` int(11) DEFAULT NULL,
  `IDEntre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Dev`
--

CREATE TABLE `Dev` (
  `IDPersonne` int(11) NOT NULL,
  `IDIndice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Entreprise_Cliente`
--

CREATE TABLE `Entreprise_Cliente` (
  `IDEntre` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `IDEquipe` int(11) NOT NULL,
  `IDPersonne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Indice`
--

CREATE TABLE `Indice` (
  `IDIndice` int(11) NOT NULL,
  `CoutHoraire` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Maitriser`
--

CREATE TABLE `Maitriser` (
  `IDPersonne` int(11) NOT NULL,
  `Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Module`
--

CREATE TABLE `Module` (
  `IDModule` int(11) NOT NULL,
  `Etat` varchar(50) DEFAULT NULL,
  `IDEquipe` int(11) NOT NULL,
  `IDContrat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Outil`
--

CREATE TABLE `Outil` (
  `Code` int(11) NOT NULL,
  `Libelle` varchar(50) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Personne`
--

CREATE TABLE `Personne` (
  `IDPersonne` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `regrouper`
--

CREATE TABLE `regrouper` (
  `IDPersonne` int(11) NOT NULL,
  `IDEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `representer`
--

CREATE TABLE `representer` (
  `IDEntre` int(11) NOT NULL,
  `IDPersonne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Tache`
--

CREATE TABLE `Tache` (
  `IDTache` int(11) NOT NULL,
  `Libelle` varchar(50) DEFAULT NULL,
  `Etat` varchar(50) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `IDModule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Travailler`
--

CREATE TABLE `Travailler` (
  `IDPersonne` int(11) NOT NULL,
  `IDTache` int(11) NOT NULL,
  `NbHeures` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`IDPersonne`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`IDContrat`),
  ADD KEY `IDPersonne` (`IDPersonne`),
  ADD KEY `IDEntre` (`IDEntre`);

--
-- Index pour la table `Coordonnees`
--
ALTER TABLE `Coordonnees`
  ADD PRIMARY KEY (`IDCoord`),
  ADD KEY `IDPersonne` (`IDPersonne`),
  ADD KEY `IDEntre` (`IDEntre`);

--
-- Index pour la table `Dev`
--
ALTER TABLE `Dev`
  ADD PRIMARY KEY (`IDPersonne`),
  ADD KEY `IDIndice` (`IDIndice`);

--
-- Index pour la table `Entreprise_Cliente`
--
ALTER TABLE `Entreprise_Cliente`
  ADD PRIMARY KEY (`IDEntre`);

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`IDEquipe`),
  ADD KEY `IDPersonne` (`IDPersonne`);

--
-- Index pour la table `Indice`
--
ALTER TABLE `Indice`
  ADD PRIMARY KEY (`IDIndice`);

--
-- Index pour la table `Maitriser`
--
ALTER TABLE `Maitriser`
  ADD PRIMARY KEY (`IDPersonne`,`Code`),
  ADD KEY `Code` (`Code`);

--
-- Index pour la table `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`IDModule`),
  ADD KEY `IDEquipe` (`IDEquipe`),
  ADD KEY `IDContrat` (`IDContrat`);

--
-- Index pour la table `Outil`
--
ALTER TABLE `Outil`
  ADD PRIMARY KEY (`Code`);

--
-- Index pour la table `Personne`
--
ALTER TABLE `Personne`
  ADD PRIMARY KEY (`IDPersonne`);

--
-- Index pour la table `regrouper`
--
ALTER TABLE `regrouper`
  ADD PRIMARY KEY (`IDPersonne`,`IDEquipe`),
  ADD KEY `IDEquipe` (`IDEquipe`);

--
-- Index pour la table `representer`
--
ALTER TABLE `representer`
  ADD PRIMARY KEY (`IDEntre`,`IDPersonne`),
  ADD KEY `IDPersonne` (`IDPersonne`);

--
-- Index pour la table `Tache`
--
ALTER TABLE `Tache`
  ADD PRIMARY KEY (`IDTache`),
  ADD KEY `IDModule` (`IDModule`);

--
-- Index pour la table `Travailler`
--
ALTER TABLE `Travailler`
  ADD PRIMARY KEY (`IDPersonne`,`IDTache`),
  ADD KEY `IDTache` (`IDTache`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `IDPersonne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Contrat`
--
ALTER TABLE `Contrat`
  MODIFY `IDContrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Coordonnees`
--
ALTER TABLE `Coordonnees`
  MODIFY `IDCoord` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Dev`
--
ALTER TABLE `Dev`
  MODIFY `IDPersonne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Entreprise_Cliente`
--
ALTER TABLE `Entreprise_Cliente`
  MODIFY `IDEntre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `IDEquipe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Indice`
--
ALTER TABLE `Indice`
  MODIFY `IDIndice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Module`
--
ALTER TABLE `Module`
  MODIFY `IDModule` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Outil`
--
ALTER TABLE `Outil`
  MODIFY `Code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Personne`
--
ALTER TABLE `Personne`
  MODIFY `IDPersonne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Tache`
--
ALTER TABLE `Tache`
  MODIFY `IDTache` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Contact`
--
ALTER TABLE `Contact`
  ADD CONSTRAINT `Contact_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`);

--
-- Contraintes pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `Contrat_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Contact` (`IDPersonne`),
  ADD CONSTRAINT `Contrat_ibfk_2` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`);

--
-- Contraintes pour la table `Coordonnees`
--
ALTER TABLE `Coordonnees`
  ADD CONSTRAINT `Coordonnees_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`),
  ADD CONSTRAINT `Coordonnees_ibfk_2` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`);

--
-- Contraintes pour la table `Dev`
--
ALTER TABLE `Dev`
  ADD CONSTRAINT `Dev_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`),
  ADD CONSTRAINT `Dev_ibfk_2` FOREIGN KEY (`IDIndice`) REFERENCES `Indice` (`IDIndice`);

--
-- Contraintes pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD CONSTRAINT `Equipe_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`);

--
-- Contraintes pour la table `Maitriser`
--
ALTER TABLE `Maitriser`
  ADD CONSTRAINT `Maitriser_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  ADD CONSTRAINT `Maitriser_ibfk_2` FOREIGN KEY (`Code`) REFERENCES `Outil` (`Code`);

--
-- Contraintes pour la table `Module`
--
ALTER TABLE `Module`
  ADD CONSTRAINT `Module_ibfk_1` FOREIGN KEY (`IDEquipe`) REFERENCES `Equipe` (`IDEquipe`),
  ADD CONSTRAINT `Module_ibfk_2` FOREIGN KEY (`IDContrat`) REFERENCES `Contrat` (`IDContrat`);

--
-- Contraintes pour la table `regrouper`
--
ALTER TABLE `regrouper`
  ADD CONSTRAINT `regrouper_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  ADD CONSTRAINT `regrouper_ibfk_2` FOREIGN KEY (`IDEquipe`) REFERENCES `Equipe` (`IDEquipe`);

--
-- Contraintes pour la table `representer`
--
ALTER TABLE `representer`
  ADD CONSTRAINT `representer_ibfk_1` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`),
  ADD CONSTRAINT `representer_ibfk_2` FOREIGN KEY (`IDPersonne`) REFERENCES `Contact` (`IDPersonne`);

--
-- Contraintes pour la table `Tache`
--
ALTER TABLE `Tache`
  ADD CONSTRAINT `Tache_ibfk_1` FOREIGN KEY (`IDModule`) REFERENCES `Module` (`IDModule`);

--
-- Contraintes pour la table `Travailler`
--
ALTER TABLE `Travailler`
  ADD CONSTRAINT `Travailler_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  ADD CONSTRAINT `Travailler_ibfk_2` FOREIGN KEY (`IDTache`) REFERENCES `Tache` (`IDTache`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
