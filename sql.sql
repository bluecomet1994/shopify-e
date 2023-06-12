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


-- Dumping database structure for sampleselling
CREATE DATABASE IF NOT EXISTS `sampleselling` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sampleselling`;

-- Dumping data for table sampleselling.customer: ~2 rows (approximately)
INSERT INTO `customer` (`UserName`, `FName`, `LName`, `Password`, `CustomerID`, `Email`, `Unique_ID`) VALUES
	('usernone', NULL, NULL, NULL, 1, NULL, NULL),
	('marshallRag', 'Rag', 'Ragujan', '$2y$10$R3oXUGhB0RIFHVmFOGAxP.RbeLgwB6tNifY9mLGjRSSDdWS5Kfj6G', 3, 'stiflerwedontgiveup@gmail.com', NULL);

-- Dumping data for table sampleselling.sampleaudio: ~2 rows (approximately)
INSERT INTO `sampleaudio` (`sampleAudioSrc`, `sampleID`) VALUES
	('../sampleAudio/62e51630a8901meow.mp3', 4),
	('../sampleAudio/62e51651a1e59meow.mp3', 5);

-- Dumping data for table sampleselling.sampleimages: ~2 rows (approximately)
INSERT INTO `sampleimages` (`source_URL`, `sampleID`) VALUES
	('../samplesImages/62e51630a98b361e764e1b495bimage.jpg', 4),
	('../samplesImages/62e51651a2d6361e764e1b495bimage.jpg', 5);

-- Dumping data for table sampleselling.samplepath: ~2 rows (approximately)
INSERT INTO `samplepath` (`samplePath`, `sampleID`) VALUES
	('../samples/62e51630a788fmeow.zip', 4),
	('../samples/62e51651a0b5bmeow.zip', 5);

-- Dumping data for table sampleselling.samples: ~2 rows (approximately)
INSERT INTO `samples` (`sampleID`, `Sample_Name`, `Sample_Date`, `SamplePrice`, `SubsampleID`, `SampleDescription`) VALUES
	(4, 'Rag1', '2022-07-30 01:29:52', 111, 1, 'abcddd'),
	(5, 'rag2', '2022-07-30 01:30:25', 222, 1, 'asdfasdfsf');

-- Dumping data for table sampleselling.sampletype: ~2 rows (approximately)
INSERT INTO `sampletype` (`sampleTypeID`, `typeName`) VALUES
	(1, 'Melodies'),
	(2, 'Drums');

-- Dumping data for table sampleselling.subsampletype: ~2 rows (approximately)
INSERT INTO `subsampletype` (`subsampleID`, `subsampleName`, `sampleTypeID`) VALUES
	(1, 'guitar', 1),
	(2, 'dark piano', 1);

-- Dumping data for table sampleselling.user: ~0 rows (approximately)

-- Dumping data for table sampleselling.useraddress: ~0 rows (approximately)

-- Dumping data for table sampleselling.usercart: ~2 rows (approximately)
INSERT INTO `usercart` (`cart_ID`, `sampleID`, `qty`, `CustomerID`) VALUES
	(66, 5, 4, 3),
	(67, 4, 4, 3);

-- Dumping data for table sampleselling.usercity: ~0 rows (approximately)

-- Dumping data for table sampleselling.usercountry: ~0 rows (approximately)

-- Dumping data for table sampleselling.userstate: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
