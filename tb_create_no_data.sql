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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.customer_purchase
CREATE TABLE IF NOT EXISTS `customer_purchase` (
  `customer_purchase_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(200) DEFAULT NULL,
  `dnt` datetime DEFAULT NULL,
  `customer_id` int NOT NULL,
  `customer_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customer_purchase_id`),
  KEY `fk_customer_purchase_customer1_idx` (`customer_id`),
  CONSTRAINT `fk_customer_purchase_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.customer_purchase_history
CREATE TABLE IF NOT EXISTS `customer_purchase_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(200) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `sampleID` int NOT NULL,
  `customer_purchase_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_purchase_history_samples1_idx` (`sampleID`),
  KEY `fk_customer_purchase_history_customer_purchase1_idx` (`customer_purchase_id`),
  CONSTRAINT `fk_customer_purchase_history_customer_purchase1` FOREIGN KEY (`customer_purchase_id`) REFERENCES `customer_purchase` (`customer_purchase_id`),
  CONSTRAINT `fk_customer_purchase_history_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.product_download_history
CREATE TABLE IF NOT EXISTS `product_download_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `downloaded_times` int DEFAULT NULL,
  `unique_id` varchar(200) DEFAULT NULL,
  `customer_purchase_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_download_history_customer_purchase1_idx` (`customer_purchase_id`),
  CONSTRAINT `fk_product_download_history_customer_purchase1` FOREIGN KEY (`customer_purchase_id`) REFERENCES `customer_purchase` (`customer_purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.sampleaudio
CREATE TABLE IF NOT EXISTS `sampleaudio` (
  `sampleAudioSrc` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`sampleAudioSrc`),
  KEY `fk_sampleaudio_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleaudio_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.sampleimages
CREATE TABLE IF NOT EXISTS `sampleimages` (
  `source_URL` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`source_URL`),
  KEY `fk_sampleimages_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleimages_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.samplepath
CREATE TABLE IF NOT EXISTS `samplepath` (
  `samplePath` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`samplePath`),
  KEY `fk_table2_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_table2_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.sampletype
CREATE TABLE IF NOT EXISTS `sampletype` (
  `sampleTypeID` int NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.subsampletype
CREATE TABLE IF NOT EXISTS `subsampletype` (
  `subsampleID` int NOT NULL AUTO_INCREMENT,
  `subsampleName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sampleTypeID` int NOT NULL,
  PRIMARY KEY (`subsampleID`),
  KEY `fk_subsampletype_sampletype1_idx` (`sampleTypeID`),
  CONSTRAINT `fk_subsampletype_sampletype1` FOREIGN KEY (`sampleTypeID`) REFERENCES `sampletype` (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int NOT NULL,
  `userEmail` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `address_ID` int NOT NULL,
  PRIMARY KEY (`user_ID`),
  KEY `fk_user_useraddress1_idx` (`address_ID`),
  CONSTRAINT `fk_user_useraddress1` FOREIGN KEY (`address_ID`) REFERENCES `useraddress` (`address_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.useraddress
CREATE TABLE IF NOT EXISTS `useraddress` (
  `address_ID` int NOT NULL,
  `address` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `cityID` int NOT NULL,
  PRIMARY KEY (`address_ID`),
  KEY `fk_useraddress_usercity1_idx` (`cityID`),
  CONSTRAINT `fk_useraddress_usercity1` FOREIGN KEY (`cityID`) REFERENCES `usercity` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.usercity
CREATE TABLE IF NOT EXISTS `usercity` (
  `cityID` int NOT NULL,
  `city_Name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `stateID` int NOT NULL,
  PRIMARY KEY (`cityID`),
  KEY `fk_usercity_userstate1_idx` (`stateID`),
  CONSTRAINT `fk_usercity_userstate1` FOREIGN KEY (`stateID`) REFERENCES `userstate` (`stateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.usercountry
CREATE TABLE IF NOT EXISTS `usercountry` (
  `country_ID` int NOT NULL,
  `countryName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table sampleselling.userstate
CREATE TABLE IF NOT EXISTS `userstate` (
  `stateID` int NOT NULL,
  `stateName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `country_ID` int NOT NULL,
  PRIMARY KEY (`stateID`),
  KEY `fk_userstate_country1_idx` (`country_ID`),
  CONSTRAINT `fk_userstate_country1` FOREIGN KEY (`country_ID`) REFERENCES `usercountry` (`country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
