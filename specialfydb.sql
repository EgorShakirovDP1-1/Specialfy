-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for izglitibas_iestade
CREATE DATABASE IF NOT EXISTS `izglitibas_iestade` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `izglitibas_iestade`;

-- Dumping structure for table izglitibas_iestade.audzekni
CREATE TABLE IF NOT EXISTS `audzekni` (
  `Audzekna_ID` int NOT NULL AUTO_INCREMENT,
  `Grupas_ID` int NOT NULL DEFAULT '0',
  `Personas_kods` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Vards` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Uzvards` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Dzimsanas_datums` date DEFAULT NULL,
  `Telefona_Nr` int DEFAULT NULL,
  `Vecums` int DEFAULT NULL,
  PRIMARY KEY (`Audzekna_ID`),
  KEY `grupas_id` (`Grupas_ID`),
  CONSTRAINT `grupas_id` FOREIGN KEY (`Grupas_ID`) REFERENCES `grupas` (`Grupas_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.audzekni: ~0 rows (approximately)

-- Dumping structure for table izglitibas_iestade.audzinataji
CREATE TABLE IF NOT EXISTS `audzinataji` (
  `Darba_stazs` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci NOT NULL DEFAULT '0',
  `Vards` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci NOT NULL DEFAULT '0',
  `Uzvards` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.audzinataji: ~0 rows (approximately)

-- Dumping structure for table izglitibas_iestade.diploma_vertejumi
CREATE TABLE IF NOT EXISTS `diploma_vertejumi` (
  `Diploma_ID` int NOT NULL AUTO_INCREMENT,
  `Prieksmeta_ID` int DEFAULT '0',
  `Audzekna_ID` int DEFAULT '0',
  `Diploma_vertejums` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  PRIMARY KEY (`Diploma_ID`),
  KEY `priekseta_id_` (`Prieksmeta_ID`),
  KEY `audzekna_id_` (`Audzekna_ID`),
  CONSTRAINT `audzekna_id_` FOREIGN KEY (`Audzekna_ID`) REFERENCES `audzekni` (`Audzekna_ID`),
  CONSTRAINT `priekseta_id_` FOREIGN KEY (`Prieksmeta_ID`) REFERENCES `prieksmeti` (`Prieksmeta_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.diploma_vertejumi: ~0 rows (approximately)

-- Dumping structure for table izglitibas_iestade.grupas
CREATE TABLE IF NOT EXISTS `grupas` (
  `Grupas_ID` int NOT NULL AUTO_INCREMENT,
  `Specialitates_ID` int NOT NULL DEFAULT '0',
  `Grupas_nosaukums` int NOT NULL DEFAULT '0',
  `Audz_vards` varchar(50) COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Audz_uzvards` varchar(50) COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  PRIMARY KEY (`Grupas_ID`),
  KEY `specialitates_id` (`Specialitates_ID`),
  CONSTRAINT `specialitates_id` FOREIGN KEY (`Specialitates_ID`) REFERENCES `specialitates` (`Specialitates_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.grupas: ~0 rows (approximately)

-- Dumping structure for table izglitibas_iestade.macibu_plani
CREATE TABLE IF NOT EXISTS `macibu_plani` (
  `Plana_ID` int NOT NULL AUTO_INCREMENT,
  `Grupas_ID` int NOT NULL DEFAULT '0',
  `Skolotaja_ID` int NOT NULL DEFAULT '0',
  `Prieksmeta_ID` int NOT NULL DEFAULT '0',
  `Semestris` int DEFAULT NULL,
  `Stundu_skaits_teorija_kopa` int DEFAULT NULL,
  `Stundu_skaits_praktika_kopa` int DEFAULT NULL,
  PRIMARY KEY (`Plana_ID`),
  KEY `skolotaja_id` (`Skolotaja_ID`),
  KEY `grupas_id_` (`Grupas_ID`),
  KEY `prieksmeta_id_` (`Prieksmeta_ID`),
  CONSTRAINT `grupas_id_` FOREIGN KEY (`Grupas_ID`) REFERENCES `grupas` (`Grupas_ID`),
  CONSTRAINT `prieksmeta_id_` FOREIGN KEY (`Prieksmeta_ID`) REFERENCES `prieksmeti` (`Prieksmeta_ID`),
  CONSTRAINT `skolotaja_id` FOREIGN KEY (`Skolotaja_ID`) REFERENCES `skolotaji` (`Skolotaja_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.macibu_plani: ~0 rows (approximately)

-- Dumping structure for table izglitibas_iestade.metodiskas_komisijas
CREATE TABLE IF NOT EXISTS `metodiskas_komisijas` (
  `Komisijas_ID` int NOT NULL,
  `Komisijas_nosaukums` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  PRIMARY KEY (`Komisijas_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.metodiskas_komisijas: ~0 rows (approximately)
INSERT INTO `metodiskas_komisijas` (`Komisijas_ID`, `Komisijas_nosaukums`) VALUES
	(1, 'Informācijas un komunikācijas tehnoloģijas'),
	(2, 'Matemātika un fizika');

-- Dumping structure for table izglitibas_iestade.prieksmeti
CREATE TABLE IF NOT EXISTS `prieksmeti` (
  `Prieksmeta_ID` int NOT NULL,
  `Nosaukums` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Stundu_skaits_teorija` int DEFAULT NULL,
  `Stundu_skaits_praktika` int DEFAULT NULL,
  PRIMARY KEY (`Prieksmeta_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.prieksmeti: ~0 rows (approximately)
INSERT INTO `prieksmeti` (`Prieksmeta_ID`, `Nosaukums`, `Stundu_skaits_teorija`, `Stundu_skaits_praktika`) VALUES
	(1, 'matemātika', 130, 90),
	(2, 'latviešu valoda', 75, 60),
	(3, 'datu bāzes', 175, 175),
	(4, 'sistēmu programmēšana', 155, 140);

-- Dumping structure for table izglitibas_iestade.skolotaji
CREATE TABLE IF NOT EXISTS `skolotaji` (
  `Skolotaja_ID` int NOT NULL AUTO_INCREMENT,
  `Komisijas_ID` int DEFAULT NULL,
  `Darba_stazs` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Vards` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Uzvards` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci DEFAULT NULL,
  `Telefona_Nr` int DEFAULT NULL,
  PRIMARY KEY (`Skolotaja_ID`),
  KEY `komisijas_id` (`Komisijas_ID`),
  CONSTRAINT `komisijas_id` FOREIGN KEY (`Komisijas_ID`) REFERENCES `metodiskas_komisijas` (`Komisijas_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.skolotaji: ~0 rows (approximately)
INSERT INTO `skolotaji` (`Skolotaja_ID`, `Komisijas_ID`, `Darba_stazs`, `Vards`, `Uzvards`, `Telefona_Nr`) VALUES
	(1, 1, '18', 'Anna', 'Jaunmuktāne', 23453453),
	(2, 1, '24', 'Kristaps', 'Bērziņš', 29483733),
	(3, 2, '6', 'Harijs', 'Auzāns', 29485736),
	(4, 2, '31', 'Leonīds', 'Liepiņš', 28374616),
	(5, 1, '15', 'Krista', 'Lipe', 24836662);

-- Dumping structure for table izglitibas_iestade.specialitates
CREATE TABLE IF NOT EXISTS `specialitates` (
  `Specialitates_ID` int NOT NULL,
  `Programmas_nosauk` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci NOT NULL,
  PRIMARY KEY (`Specialitates_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_latvian_ci;

-- Dumping data for table izglitibas_iestade.specialitates: ~2 rows (approximately)
INSERT INTO `specialitates` (`Specialitates_ID`, `Programmas_nosauk`) VALUES
	(345, 'Datorsistēmas'),
	(346, 'Programmēšana');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;