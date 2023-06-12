-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.29 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sampleselling.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `UserName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `FName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `LName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Password` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `CustomerID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Unique_ID` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.customer: ~2 rows (approximately)
INSERT INTO `customer` (`UserName`, `FName`, `LName`, `Password`, `CustomerID`, `Email`, `Unique_ID`) VALUES
	(NULL, NULL, NULL, NULL, 0, 'default', '0'),
	('ragjn', 'rag', 'jn', '$2y$10$jqZhyZir3UWqjDKTWrlryuC7OyuH94RWXB1e..JopYpaTekYtW3P.', 1, 'rag@gmail.com', 'yr8pfZsE0MQR6340da96391f1');

-- Dumping structure for table sampleselling.customer_purchase_history
CREATE TABLE IF NOT EXISTS `customer_purchase_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(200) DEFAULT NULL,
  `dnt` datetime DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `CustomerID` int NOT NULL,
  `sampleID` int NOT NULL,
  `customer_email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_purchase_history_customer1_idx` (`CustomerID`),
  KEY `fk_customer_purchase_history_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_customer_purchase_history_customer1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  CONSTRAINT `fk_customer_purchase_history_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sampleselling.customer_purchase_history: ~0 rows (approximately)
INSERT INTO `customer_purchase_history` (`id`, `unique_id`, `dnt`, `qty`, `CustomerID`, `sampleID`, `customer_email`) VALUES
	(24, '634a72d4c879b', '2022-10-15 10:44:04', 11, 1, 2, 'rag@gmail.com'),
	(25, '634a72d4ce6e3', '2022-10-15 10:44:04', 2, 1, 4, 'rag@gmail.com');

-- Dumping structure for table sampleselling.sampleaudio
CREATE TABLE IF NOT EXISTS `sampleaudio` (
  `sampleAudioSrc` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`sampleAudioSrc`),
  KEY `fk_sampleaudio_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleaudio_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampleaudio: ~0 rows (approximately)
INSERT INTO `sampleaudio` (`sampleAudioSrc`, `sampleID`) VALUES
	('../sampleAudio/633b07b5f0177audio.mp3', 2),
	('../sampleAudio/634a1b682f3d9audio.mp3', 4);

-- Dumping structure for table sampleselling.sampleimages
CREATE TABLE IF NOT EXISTS `sampleimages` (
  `source_URL` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`source_URL`),
  KEY `fk_sampleimages_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleimages_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampleimages: ~0 rows (approximately)
INSERT INTO `sampleimages` (`source_URL`, `sampleID`) VALUES
	('../samplesImages/633b07b5f0e2061e764e1b495bimage.jpg', 2),
	('../samplesImages/634a1b68305df61e764e1b495bimage.jpg', 4);

-- Dumping structure for table sampleselling.samplepath
CREATE TABLE IF NOT EXISTS `samplepath` (
  `samplePath` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`samplePath`),
  KEY `fk_table2_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_table2_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.samplepath: ~0 rows (approximately)
INSERT INTO `samplepath` (`samplePath`, `sampleID`) VALUES
	('../samples/633b07b5eefb6meow.zip', 2),
	('../samples/634a1b682c4e1meow.zip', 4);

-- Dumping structure for table sampleselling.samples
CREATE TABLE IF NOT EXISTS `samples` (
  `sampleID` int NOT NULL AUTO_INCREMENT,
  `Sample_Name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `Sample_Date` datetime DEFAULT NULL,
  `SamplePrice` double DEFAULT NULL,
  `SubsampleID` int NOT NULL,
  `SampleDescription` text COLLATE utf8_bin,
  `UniqueId` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`sampleID`),
  KEY `fk_samples_subsampletype1_idx` (`SubsampleID`),
  CONSTRAINT `fk_samples_subsampletype1` FOREIGN KEY (`SubsampleID`) REFERENCES `subsampletype` (`subsampleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.samples: ~2 rows (approximately)
INSERT INTO `samples` (`sampleID`, `Sample_Name`, `Sample_Date`, `SamplePrice`, `SubsampleID`, `SampleDescription`, `UniqueId`) VALUES
	(0, NULL, NULL, NULL, 0, NULL, NULL),
	(2, 'dark_piano_beautiful', '2022-10-03 06:03:01', 200, 3, 'Dark atmosphere melody high quality', 'z2AOghh2AoAR633b07b5ea488'),
	(4, 'top_g', '2022-10-15 04:31:04', 100, 3, 'abc_def_eftgggg', 'obRSykMIt3cR634a1b6827053');

-- Dumping structure for table sampleselling.sampletype
CREATE TABLE IF NOT EXISTS `sampletype` (
  `sampleTypeID` int NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampletype: ~3 rows (approximately)
INSERT INTO `sampletype` (`sampleTypeID`, `typeName`) VALUES
	(0, 'default'),
	(1, 'drums'),
	(2, 'melodies');

-- Dumping structure for table sampleselling.subsampletype
CREATE TABLE IF NOT EXISTS `subsampletype` (
  `subsampleID` int NOT NULL AUTO_INCREMENT,
  `subsampleName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sampleTypeID` int NOT NULL,
  PRIMARY KEY (`subsampleID`),
  KEY `fk_subsampletype_sampletype1_idx` (`sampleTypeID`),
  CONSTRAINT `fk_subsampletype_sampletype1` FOREIGN KEY (`sampleTypeID`) REFERENCES `sampletype` (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.subsampletype: ~4 rows (approximately)
INSERT INTO `subsampletype` (`subsampleID`, `subsampleName`, `sampleTypeID`) VALUES
	(0, 'default', 0),
	(1, 'hard_rock', 2),
	(2, 'heavy_metal', 2),
	(3, 'piano_melodies', 1);

-- Dumping structure for table sampleselling.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int NOT NULL,
  `userEmail` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `address_ID` int NOT NULL,
  PRIMARY KEY (`user_ID`),
  KEY `fk_user_useraddress1_idx` (`address_ID`),
  CONSTRAINT `fk_user_useraddress1` FOREIGN KEY (`address_ID`) REFERENCES `useraddress` (`address_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.user: ~0 rows (approximately)

-- Dumping structure for table sampleselling.useraddress
CREATE TABLE IF NOT EXISTS `useraddress` (
  `address_ID` int NOT NULL,
  `address` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `cityID` int NOT NULL,
  PRIMARY KEY (`address_ID`),
  KEY `fk_useraddress_usercity1_idx` (`cityID`),
  CONSTRAINT `fk_useraddress_usercity1` FOREIGN KEY (`cityID`) REFERENCES `usercity` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.useraddress: ~0 rows (approximately)

-- Dumping structure for table sampleselling.usercart
CREATE TABLE IF NOT EXISTS `usercart` (
  `cart_ID` int NOT NULL AUTO_INCREMENT,
  `sampleID` int NOT NULL,
  `qty` int DEFAULT NULL,
  `CustomerID` int NOT NULL,
  PRIMARY KEY (`cart_ID`),
  KEY `fk_cart_samples1_idx` (`sampleID`),
  KEY `fk_usercart_customer1_idx` (`CustomerID`),
  CONSTRAINT `fk_cart_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`),
  CONSTRAINT `fk_usercart_customer1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.usercart: ~0 rows (approximately)
INSERT INTO `usercart` (`cart_ID`, `sampleID`, `qty`, `CustomerID`) VALUES
	(1, 2, 11, 1),
	(3, 4, 2, 1);

-- Dumping structure for table sampleselling.usercity
CREATE TABLE IF NOT EXISTS `usercity` (
  `cityID` int NOT NULL,
  `city_Name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `stateID` int NOT NULL,
  PRIMARY KEY (`cityID`),
  KEY `fk_usercity_userstate1_idx` (`stateID`),
  CONSTRAINT `fk_usercity_userstate1` FOREIGN KEY (`stateID`) REFERENCES `userstate` (`stateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.usercity: ~0 rows (approximately)

-- Dumping structure for table sampleselling.usercountry
CREATE TABLE IF NOT EXISTS `usercountry` (
  `country_ID` int NOT NULL,
  `countryName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.usercountry: ~0 rows (approximately)

-- Dumping structure for table sampleselling.userstate
CREATE TABLE IF NOT EXISTS `userstate` (
  `stateID` int NOT NULL,
  `stateName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `country_ID` int NOT NULL,
  PRIMARY KEY (`stateID`),
  KEY `fk_userstate_country1_idx` (`country_ID`),
  CONSTRAINT `fk_userstate_country1` FOREIGN KEY (`country_ID`) REFERENCES `usercountry` (`country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.userstate: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
