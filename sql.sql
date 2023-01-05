-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SLAM-Projet1
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `IDPersonne` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDPersonne`),
  CONSTRAINT `Contact_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contrat`
--

DROP TABLE IF EXISTS `Contrat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contrat` (
  `IDContrat` int(11) NOT NULL AUTO_INCREMENT,
  `DateSignature` date DEFAULT NULL,
  `CoutGlobal` float DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `IDPersonne` int(11) NOT NULL,
  `IDEntre` int(11) NOT NULL,
  PRIMARY KEY (`IDContrat`),
  KEY `IDPersonne` (`IDPersonne`),
  KEY `IDEntre` (`IDEntre`),
  CONSTRAINT `Contrat_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Contact` (`IDPersonne`),
  CONSTRAINT `Contrat_ibfk_2` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contrat`
--

LOCK TABLES `Contrat` WRITE;
/*!40000 ALTER TABLE `Contrat` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contrat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Coordonnees`
--

DROP TABLE IF EXISTS `Coordonnees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Coordonnees` (
  `IDCoord` int(11) NOT NULL AUTO_INCREMENT,
  `Rue` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `IDPersonne` int(11) DEFAULT NULL,
  `IDEntre` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDCoord`),
  KEY `IDPersonne` (`IDPersonne`),
  KEY `IDEntre` (`IDEntre`),
  CONSTRAINT `Coordonnees_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`),
  CONSTRAINT `Coordonnees_ibfk_2` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Coordonnees`
--

LOCK TABLES `Coordonnees` WRITE;
/*!40000 ALTER TABLE `Coordonnees` DISABLE KEYS */;
/*!40000 ALTER TABLE `Coordonnees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dev`
--

DROP TABLE IF EXISTS `Dev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dev` (
  `IDPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `IDIndice` int(11) NOT NULL,
  PRIMARY KEY (`IDPersonne`),
  KEY `IDIndice` (`IDIndice`),
  CONSTRAINT `Dev_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Personne` (`IDPersonne`),
  CONSTRAINT `Dev_ibfk_2` FOREIGN KEY (`IDIndice`) REFERENCES `Indice` (`IDIndice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dev`
--

LOCK TABLES `Dev` WRITE;
/*!40000 ALTER TABLE `Dev` DISABLE KEYS */;
/*!40000 ALTER TABLE `Dev` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Entreprise_Cliente`
--

DROP TABLE IF EXISTS `Entreprise_Cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Entreprise_Cliente` (
  `IDEntre` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDEntre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Entreprise_Cliente`
--

LOCK TABLES `Entreprise_Cliente` WRITE;
/*!40000 ALTER TABLE `Entreprise_Cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `Entreprise_Cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipe`
--

DROP TABLE IF EXISTS `Equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipe` (
  `IDEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `IDPersonne` int(11) NOT NULL,
  PRIMARY KEY (`IDEquipe`),
  KEY `IDPersonne` (`IDPersonne`),
  CONSTRAINT `Equipe_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipe`
--

LOCK TABLES `Equipe` WRITE;
/*!40000 ALTER TABLE `Equipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `Equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indice`
--

DROP TABLE IF EXISTS `Indice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indice` (
  `IDIndice` int(11) NOT NULL AUTO_INCREMENT,
  `CoutHoraire` float DEFAULT NULL,
  PRIMARY KEY (`IDIndice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indice`
--

LOCK TABLES `Indice` WRITE;
/*!40000 ALTER TABLE `Indice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Indice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Maitriser`
--

DROP TABLE IF EXISTS `Maitriser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Maitriser` (
  `IDPersonne` int(11) NOT NULL,
  `Code` int(11) NOT NULL,
  PRIMARY KEY (`IDPersonne`,`Code`),
  KEY `Code` (`Code`),
  CONSTRAINT `Maitriser_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  CONSTRAINT `Maitriser_ibfk_2` FOREIGN KEY (`Code`) REFERENCES `Outil` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Maitriser`
--

LOCK TABLES `Maitriser` WRITE;
/*!40000 ALTER TABLE `Maitriser` DISABLE KEYS */;
/*!40000 ALTER TABLE `Maitriser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Module`
--

DROP TABLE IF EXISTS `Module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Module` (
  `IDModule` int(11) NOT NULL AUTO_INCREMENT,
  `Etat` varchar(50) DEFAULT NULL,
  `IDEquipe` int(11) NOT NULL,
  `IDContrat` int(11) NOT NULL,
  PRIMARY KEY (`IDModule`),
  KEY `IDEquipe` (`IDEquipe`),
  KEY `IDContrat` (`IDContrat`),
  CONSTRAINT `Module_ibfk_1` FOREIGN KEY (`IDEquipe`) REFERENCES `Equipe` (`IDEquipe`),
  CONSTRAINT `Module_ibfk_2` FOREIGN KEY (`IDContrat`) REFERENCES `Contrat` (`IDContrat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Module`
--

LOCK TABLES `Module` WRITE;
/*!40000 ALTER TABLE `Module` DISABLE KEYS */;
/*!40000 ALTER TABLE `Module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Outil`
--

DROP TABLE IF EXISTS `Outil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Outil` (
  `Code` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(50) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Outil`
--

LOCK TABLES `Outil` WRITE;
/*!40000 ALTER TABLE `Outil` DISABLE KEYS */;
/*!40000 ALTER TABLE `Outil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Personne`
--

DROP TABLE IF EXISTS `Personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Personne` (
  `IDPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Personne`
--

LOCK TABLES `Personne` WRITE;
/*!40000 ALTER TABLE `Personne` DISABLE KEYS */;
/*!40000 ALTER TABLE `Personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tache`
--

DROP TABLE IF EXISTS `Tache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tache` (
  `IDTache` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(50) DEFAULT NULL,
  `Etat` varchar(50) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `IDModule` int(11) NOT NULL,
  PRIMARY KEY (`IDTache`),
  KEY `IDModule` (`IDModule`),
  CONSTRAINT `Tache_ibfk_1` FOREIGN KEY (`IDModule`) REFERENCES `Module` (`IDModule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tache`
--

LOCK TABLES `Tache` WRITE;
/*!40000 ALTER TABLE `Tache` DISABLE KEYS */;
/*!40000 ALTER TABLE `Tache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Travailler`
--

DROP TABLE IF EXISTS `Travailler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Travailler` (
  `IDPersonne` int(11) NOT NULL,
  `IDTache` int(11) NOT NULL,
  `NbHeures` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`IDPersonne`,`IDTache`),
  KEY `IDTache` (`IDTache`),
  CONSTRAINT `Travailler_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  CONSTRAINT `Travailler_ibfk_2` FOREIGN KEY (`IDTache`) REFERENCES `Tache` (`IDTache`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Travailler`
--

LOCK TABLES `Travailler` WRITE;
/*!40000 ALTER TABLE `Travailler` DISABLE KEYS */;
/*!40000 ALTER TABLE `Travailler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regrouper`
--

DROP TABLE IF EXISTS `regrouper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regrouper` (
  `IDPersonne` int(11) NOT NULL,
  `IDEquipe` int(11) NOT NULL,
  PRIMARY KEY (`IDPersonne`,`IDEquipe`),
  KEY `IDEquipe` (`IDEquipe`),
  CONSTRAINT `regrouper_ibfk_1` FOREIGN KEY (`IDPersonne`) REFERENCES `Dev` (`IDPersonne`),
  CONSTRAINT `regrouper_ibfk_2` FOREIGN KEY (`IDEquipe`) REFERENCES `Equipe` (`IDEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regrouper`
--

LOCK TABLES `regrouper` WRITE;
/*!40000 ALTER TABLE `regrouper` DISABLE KEYS */;
/*!40000 ALTER TABLE `regrouper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representer`
--

DROP TABLE IF EXISTS `representer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representer` (
  `IDEntre` int(11) NOT NULL,
  `IDPersonne` int(11) NOT NULL,
  PRIMARY KEY (`IDEntre`,`IDPersonne`),
  KEY `IDPersonne` (`IDPersonne`),
  CONSTRAINT `representer_ibfk_1` FOREIGN KEY (`IDEntre`) REFERENCES `Entreprise_Cliente` (`IDEntre`),
  CONSTRAINT `representer_ibfk_2` FOREIGN KEY (`IDPersonne`) REFERENCES `Contact` (`IDPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representer`
--

LOCK TABLES `representer` WRITE;
/*!40000 ALTER TABLE `representer` DISABLE KEYS */;
/*!40000 ALTER TABLE `representer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-05 15:53:37
