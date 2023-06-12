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

-- Dumping data for table sampleselling.customer: ~2 rows (approximately)
INSERT INTO `customer` (`UserName`, `FName`, `LName`, `Password`, `CustomerID`, `Email`, `Unique_ID`) VALUES
	(NULL, NULL, NULL, NULL, 0, 'default', '0'),
	('ragjnmarhsall', 'marshall', 'ragjn', '$2y$10$jqZhyZir3UWqjDKTWrlryuC7OyuH94RWXB1e..JopYpaTekYtW3P.', 1, 'rag@gmail.com', 'yr8pfZsE0MQR6340da96391f1'),
	('mathersmathers', 'marshallone', 'mathers', '$2y$10$GfeLSYZcf3VhOLUxUrR6fe6dBseDrgfh0tpVnYf17y24UmmJtmYmS', 3, 'mathers@gmail.com', 'MXxl60DoTRYR635d7f6be8924'),
	('adele21', 'adele', 'ross', '$2y$10$cwZRDPhVmfODei.opb95gO/5DOzWnq74M0khLU2MVD7sqLcyGyv2y', 4, 'adeleross@gmail.com', '1d3ByqmX6VAR636a8941288a8');

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

-- Dumping data for table sampleselling.customer_purchase: ~18 rows (approximately)
INSERT INTO `customer_purchase` (`customer_purchase_id`, `unique_id`, `dnt`, `customer_id`, `customer_email`) VALUES
	(11, 'rag', '2022-11-13 14:31:53', 4, 'rag'),
	(12, '6370bff5c3094', '2022-11-13 10:59:17', 0, 'kannadhasanragujan@gmail.com'),
	(13, '6370c2e8b71f0', '2022-11-13 11:11:52', 0, 'kannadhasanragujan@gmail.com'),
	(14, '6370c33cb872c', '2022-11-13 11:13:16', 0, 'kannadhasanragujan@gmail.com'),
	(15, '6370c38619a76', '2022-11-13 11:14:30', 0, 'stiflerwedontgiveup@gmail.com'),
	(16, '6370c4d9de3c3', '2022-11-13 11:20:09', 0, 'needtoknoweverything631@gmail.com'),
	(17, '6374a3fdca91d', '2022-11-16 09:49:01', 0, 'needtoknoweverything631@gmail.com'),
	(18, '6374a4bfa2907', '2022-11-16 09:52:15', 0, 'needtoknoweverything631@gmail.com'),
	(19, '6374a53e8e694', '2022-11-16 09:54:22', 0, 'kannadhasanragujan@gmail.com'),
	(20, '6374a6cb90944', '2022-11-16 10:00:59', 0, 'stiflerwedontgiveup@gmail.com'),
	(21, '6374abd38d577', '2022-11-16 10:22:27', 0, 'needtoknoweverything631@gmail.com'),
	(22, '6374ae4b36291', '2022-11-16 10:32:59', 0, 'needtoknoweverything631@gmail.com'),
	(23, '63808e86a25a6', '2022-11-25 10:44:38', 1, 'rag@gmail.com'),
	(24, '63808ee849908', '2022-11-25 10:46:16', 1, 'rag@gmail.com'),
	(25, '6380908d04900', '2022-11-25 10:53:17', 0, 'marshallrag@gmail.com'),
	(26, 'RRgzJQ7N7PoR638090dc396f1', '2022-11-25 10:55:09', 0, 'jasonmarshall@gmail.com'),
	(27, '6xB6owvq7YQR63809838047e3', '2022-11-25 11:26:25', 0, 'kanewilliamson@gmail.com'),
	(28, 'S8rwYxIpfR8R6380b877ab114', '2022-11-25 01:44:04', 0, 'marshallrag@gmail.com'),
	(29, '32DoyE7s5gkR6380b96c6b549', '2022-11-25 01:48:15', 0, 'jasonborne@gmail.com'),
	(30, 'SlDvix4ko7IR6380baa3e81b6', '2022-11-25 01:53:20', 0, 'eminemandcoworkers@gmail.com'),
	(31, 'TRrcq2dXpzQR6380bb91f09e7', '2022-11-25 01:56:50', 0, 'brojogan@gmail.com');

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

-- Dumping data for table sampleselling.customer_purchase_history: ~44 rows (approximately)
INSERT INTO `customer_purchase_history` (`id`, `unique_id`, `qty`, `sampleID`, `customer_purchase_id`) VALUES
	(39, '6372330bff533d7742', 3, 60, 11),
	(40, '6370bff533d7742', 3, 57, 11),
	(41, '6370bff5d7742', 1, 50, 12),
	(42, '6370c2e8ca3df', 1, 50, 13),
	(43, '6370c33ccb53f', 1, 50, 14),
	(44, '6370c38629f47', 1, 50, 15),
	(45, '6370c4d9f107b', 1, 50, 16),
	(46, '6374a3fddc6f0', 1, 50, 17),
	(47, '6374a4bfb5e79', 5, 56, 18),
	(48, '6374a4bfbd5e0', 1, 50, 18),
	(49, '6374a53e99a66', 1, 50, 19),
	(50, '6374a6cba53fe', 1, 51, 20),
	(51, '6374a6cbac47d', 1, 61, 20),
	(52, '6374abd3a2485', 1, 51, 21),
	(53, '6374abd3a79a2', 3, 61, 21),
	(54, '6374ae4b44ef8', 1, 51, 22),
	(55, '1111', 1, 61, 21),
	(56, '63808e86b4a7e', 1, 50, 23),
	(57, '63808e86bdde2', 11, 61, 23),
	(58, '63808e86c55b9', 6, 56, 23),
	(59, '63808ee84cdbf', 1, 50, 24),
	(60, '63808ee85130c', 11, 61, 24),
	(61, '63808ee855113', 6, 56, 24),
	(62, '6380908d11174', 1, 50, 25),
	(63, '6380908d1a87c', 11, 61, 25),
	(64, '6380908d2254d', 6, 56, 25),
	(65, '638090fd346d0', 1, 50, 26),
	(66, '638090fd3c1a0', 11, 61, 26),
	(67, '638090fd45808', 6, 56, 26),
	(68, 'VxRZ9wEgAuwR638098515424d', 1, 50, 27),
	(69, 'neBF1PZcJdQR6380985163a66', 11, 61, 27),
	(70, 'Kq0kCcwxipkR6380985172679', 6, 56, 27),
	(71, 'zwMH7wdrT2YR6380b8946fbac', 1, 50, 28),
	(72, 'kHRclonuaxsR6380b89478b20', 11, 61, 28),
	(73, 'uId6RBmZVfUR6380b8948533f', 6, 56, 28),
	(74, 'shwfO3JT5yMR6380b98f55bbc', 7, 50, 29),
	(75, 'uRKCwDobtBAR6380b98f64f6d', 11, 61, 29),
	(76, 'l3xMHht0A54R6380b98f747f6', 6, 56, 29),
	(77, 'LRrjfaqAVR8R6380bac0ce740', 7, 50, 30),
	(78, 'njB0qTfp35UR6380bac0d869a', 11, 61, 30),
	(79, 'zjbPNwmlDaMR6380bac0e8bce', 6, 56, 30),
	(80, '8MM5F0SaGiER6380bbb2c7875', 7, 50, 31),
	(81, 'F1AM9QawfooR6380bbb2d6973', 11, 61, 31),
	(82, 'mpH7p1NLURER6380bbb2e2089', 6, 56, 31);

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

-- Dumping data for table sampleselling.product_download_history: ~1 rows (approximately)
INSERT INTO `product_download_history` (`id`, `downloaded_times`, `unique_id`, `customer_purchase_id`) VALUES
	(19, 1, '6381fbec12ae7', 21);

-- Dumping structure for table sampleselling.sampleaudio
CREATE TABLE IF NOT EXISTS `sampleaudio` (
  `sampleAudioSrc` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`sampleAudioSrc`),
  KEY `fk_sampleaudio_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleaudio_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampleaudio: ~8 rows (approximately)
INSERT INTO `sampleaudio` (`sampleAudioSrc`, `sampleID`) VALUES
	('/sampleSelling-master/products/samples/audio/63547c7688095audio.mp3', 50),
	('/sampleSelling-master/products/samples/audio/63547d1bc868eaudio.mp3', 51),
	('/sampleSelling-master/products/samples/audio/63548ca169292audio.mp3', 52),
	('/sampleSelling-master/products/samples/audio/6355c124571d6audio.mp3', 58),
	('/sampleSelling-master/products/samples/audio/635cefbc37aacaudio.mp3', 59),
	('/sampleSelling-master/products/samples/audio/635d2e7b01d98audio.mp3', 60),
	('/sampleSelling-master/products/samples/audio/635d6ba103e34audio.mp3', 61),
	('/sampleSelling-master/products/samples/audio/635d6c1e20eceaudio.mp3', 62),
	('/sampleSelling-master/products/samples/audio/635d6ef46cc37audio.mp3', 63),
	('/sampleSelling-master/products/samples/audio/635d6fae77748audio.mp3', 64);

-- Dumping structure for table sampleselling.sampleimages
CREATE TABLE IF NOT EXISTS `sampleimages` (
  `source_URL` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`source_URL`),
  KEY `fk_sampleimages_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_sampleimages_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampleimages: ~22 rows (approximately)
INSERT INTO `sampleimages` (`source_URL`, `sampleID`) VALUES
	('/sampleSelling-master/products/samples/image/63547c768cb0d61e764e1b495bimage.jpg', 50),
	('/sampleSelling-master/products/samples/image/63547d1bcc0f961e764e1b495bimage.jpg', 51),
	('/sampleSelling-master/products/samples/image/63548ca16d35a61e764e1b495bimage.jpg', 52),
	('/sampleSelling-master/products/midi/image/635495a50001961e764e1b495bimage.jpg', 53),
	('/sampleSelling-master/products/midi/image/6354970cb9d0861e764e1b495bimage.jpg', 54),
	('/sampleSelling-master/products/midi/image/6355bc7dc0e3561e764e1b495bimage.jpg', 55),
	('/sampleSelling-master/products/midi/image/6355bcca2952b61e764e1b495bimage.jpg', 56),
	('/sampleSelling-master/products/midi/image/6355bd045480b61e764e1b495bimage.jpg', 57),
	('/sampleSelling-master/products/samples/image/6355c1245c66061e764e1b495bimage.jpg', 58),
	('/sampleSelling-master/products/samples/image/635cefbc3eb0661e764e1b495bimage.jpg', 59),
	('/sampleSelling-master/products/samples/image/635d2e7b0a73e61e764e1b495bimage.jpg', 60),
	('/sampleSelling-master/products/samples/image/635d6ba1071db61e764e1b495bimage.jpg', 61),
	('/sampleSelling-master/products/samples/image/635d6c1e2548261e764e1b495bimage.jpg', 62),
	('/sampleSelling-master/products/samples/image/635d6ef4707e261e764e1b495bimage.jpg', 63),
	('/sampleSelling-master/products/samples/image/635d6fae7ac2a61e764e1b495bimage.jpg', 64),
	('/sampleSelling-master/products/samples/image/635d71e5172b961e764e1b495bimage.jpg', 65),
	('/sampleSelling-master/products/samples/image/635d7227bd2c061e764e1b495bimage.jpg', 66),
	('/sampleSelling-master/products/samples/image/635d729430ea361e764e1b495bimage.jpg', 67),
	('/sampleSelling-master/products/samples/image/635d77305419b61e764e1b495bimage.jpg', 68),
	('/sampleSelling-master/products/samples/image/635d7791898a861e764e1b495bimage.jpg', 69),
	('/sampleSelling-master/products/samples/image/635d77b95347761e764e1b495bimage.jpg', 70),
	('/sampleSelling-master/products/samples/image/635d77c82593961e764e1b495bimage.jpg', 71),
	('/sampleSelling-master/products/samples/image/635d7877d6de161e764e1b495bimage.jpg', 72),
	('/sampleSelling-master/products/samples/image/635d790c2c5ff61e764e1b495bimage.jpg', 73);

-- Dumping structure for table sampleselling.samplepath
CREATE TABLE IF NOT EXISTS `samplepath` (
  `samplePath` varchar(200) COLLATE utf8_bin NOT NULL,
  `sampleID` int NOT NULL,
  PRIMARY KEY (`samplePath`),
  KEY `fk_table2_samples1_idx` (`sampleID`),
  CONSTRAINT `fk_table2_samples1` FOREIGN KEY (`sampleID`) REFERENCES `samples` (`sampleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.samplepath: ~22 rows (approximately)
INSERT INTO `samplepath` (`samplePath`, `sampleID`) VALUES
	('/sampleSelling-master/products/samples/zip/63547c7683683meow.zip', 50),
	('/sampleSelling-master/products/samples/zip/63547d1bc3c50meow.zip', 51),
	('/sampleSelling-master/products/samples/zip/63548ca16498cmeow.zip', 52),
	('/sampleSelling-master/products/midi/zip/635495a4ef6c8meow.zip', 53),
	('/sampleSelling-master/products/midi/zip/6354970cb2765meow.zip', 54),
	('/sampleSelling-master/products/midi/zip/6355bc7dbdd01meow.zip', 55),
	('/sampleSelling-master/products/midi/zip/6355bcca23b02meow.zip', 56),
	('/sampleSelling-master/products/midi/zip/6355bd044e988meow.zip', 57),
	('/sampleSelling-master/products/samples/zip/6355c12452fa5meow.zip', 58),
	('/sampleSelling-master/products/samples/zip/635cefbc2bc23meow.zip', 59),
	('/sampleSelling-master/products/samples/zip/635d2e7af1010meow.zip', 60),
	('/sampleSelling-master/products/samples/zip/635d6ba0f292bmeow.zip', 61),
	('/sampleSelling-master/products/samples/zip/635d6c1e1ba1fmeow.zip', 62),
	('/sampleSelling-master/products/samples/zip/635d6ef465a4fmeow.zip', 63),
	('/sampleSelling-master/products/samples/zip/635d6fae72283meow.zip', 64),
	('/sampleSelling-master/products/samples/zip/635d71e5127a8meow.zip', 65),
	('/sampleSelling-master/products/samples/zip/635d7227b817cmeow.zip', 66),
	('/sampleSelling-master/products/samples/zip/635d72942fb15meow.zip', 67),
	('/sampleSelling-master/products/samples/zip/635d77304e5fcmeow.zip', 68),
	('/sampleSelling-master/products/samples/zip/635d779180164meow.zip', 69),
	('/sampleSelling-master/products/samples/zip/635d77b9487a2meow.zip', 70),
	('/sampleSelling-master/products/samples/zip/635d77c81faecmeow.zip', 71),
	('/sampleSelling-master/products/samples/zip/635d7877d242bmeow.zip', 72),
	('/sampleSelling-master/products/samples/zip/635d790c2799fmeow.zip', 73);

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

-- Dumping data for table sampleselling.samples: ~22 rows (approximately)
INSERT INTO `samples` (`sampleID`, `Sample_Name`, `Sample_Date`, `SamplePrice`, `SubsampleID`, `SampleDescription`, `UniqueId`) VALUES
	(50, 'marshall_33', '2022-10-23 01:27:50', 40, 3, 'Dark_silky high quality ', 'HFCvnOHVsgAR63547c7678c80'),
	(51, 'marshall_45', '2022-10-23 01:30:35', 34, 3, 'cruncy piano', 'ur4pAgefNqER63547d1bb3141'),
	(52, 'young_one', '2022-10-23 02:36:49', 56, 1, 'Epic hard rock drums', 'IuqBhSW4r38R63548ca156145'),
	(53, 'craz_piano_midi', '2022-10-23 03:15:16', 20, 5, 'crazy articulations', 'ZuH5fZVCMugR635495a4dffae'),
	(54, 'mellow_guitar_chords_midi', '2022-10-23 03:21:16', 15, 6, 'crazy mellow guitar midis', 'iAlQeZ7mhpER6354970ca93a0'),
	(55, 'guitar_mellow_brook_midi', '2022-10-24 12:13:17', 10, 6, 'you can make awesome samples', 'w8BZzzDKgtcR6355bc7db1a51'),
	(56, 'aggressive_nature_midi', '2022-10-24 12:14:34', 30, 5, 'aggressive rising scenarios ', 'v7Ii1ysKx7wR6355bcca1bc7e'),
	(57, 'born_to_this_midi', '2022-10-24 12:15:32', 25, 5, 'Country Guitar Chords\r\n30 sec length with 100BPM', 'GtU1k2xY2fQR6355bd0447777'),
	(58, 'marshall_455', '2022-10-24 12:33:08', 10, 3, 'You will the vibes of sexiness', 'jzBgKUhicvMR6355c124473b1'),
	(59, 'marshall mathers', '2022-10-29 11:17:48', 200, 3, 'abddee', 'cRxsZiWLsUQR635cefbc186be'),
	(60, 'OG_LOC', '2022-10-29 03:45:30', 20, 7, 'Steal you label', 'qoEsD2H5TZAR635d2e7ae21e8'),
	(61, 'game_changer', '2022-10-29 08:06:24', 15, 1, 'crazy hard hitting premade samples plug and play', 'EXzZLeWMBKMR635d6ba0e2745'),
	(62, 'mixed marshall', '2022-10-29 08:08:30', 25, 2, 'crazy hard hitting premade samples plug and play', '96GBF80uXNoR635d6c1e140a7'),
	(63, 'West_coast_G', '2022-10-29 08:20:36', 25, 7, 'vibey funk rips', '3l7RePAq7RIR635d6ef45d0fe'),
	(64, 'west_coast_funky', '2022-10-29 08:23:42', 14, 7, 'crazy californi summer vibe type guitar chords', 'aGWF0Bbw9OUR635d6fae68aaf'),
	(65, 'dark drill chords', '2022-10-29 08:33:09', 50, 5, 'anyone can make drill melodies with these chords', 'pDUzXwR9iEsR635d71e504b6c'),
	(66, 'dark drill chords_2', '2022-10-29 08:34:15', 50, 5, 'anyone can make drill melodies with these chords', 'fGkaIBw17XUR635d7227aae5e'),
	(67, 'orchestral movie piano midies', '2022-10-29 08:36:04', 35, 5, 'highly orchestrated dark and aggressive melody midi', 'RXboURzOR0cR635d72942d0cd'),
	(68, 'billy_rogers', '2022-10-29 08:55:44', 30, 6, 'country side mud guitar ', 'PkXyDtIbb5UR635d773040d9f'),
	(69, 'billy_rogers_2', '2022-10-29 08:57:21', 30, 5, 'country side mud guitar ', 'DnnzxU3nQOUR635d77916fd71'),
	(70, 'johnny cash dark', '2022-10-29 08:58:01', 20, 6, 'johnny cash type unique guitar melody midi', 'KjZEV4YQQEER635d77b92c11b'),
	(71, 'johnny cash dark_2', '2022-10-29 08:58:16', 20, 5, 'johnny cash type unique guitar melody midi', 'fv4k4AGtHxAR635d77c811b98'),
	(72, 'rum', '2022-10-29 09:01:11', 25, 5, 'rum rum piano', 'DWYf3RKSrKcR635d7877c49b1'),
	(73, 'guns and roses kick patterns', '2022-10-29 09:03:40', 35, 8, 'guns and roses heavey crashes and kick patterns', 'dEvdrHvXiEMR635d790c17cae');

-- Dumping structure for table sampleselling.sampletype
CREATE TABLE IF NOT EXISTS `sampletype` (
  `sampleTypeID` int NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.sampletype: ~3 rows (approximately)
INSERT INTO `sampletype` (`sampleTypeID`, `typeName`) VALUES
	(0, 'default'),
	(1, 'melodies'),
	(2, 'drums'),
	(4, 'midi');

-- Dumping structure for table sampleselling.subsampletype
CREATE TABLE IF NOT EXISTS `subsampletype` (
  `subsampleID` int NOT NULL AUTO_INCREMENT,
  `subsampleName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sampleTypeID` int NOT NULL,
  PRIMARY KEY (`subsampleID`),
  KEY `fk_subsampletype_sampletype1_idx` (`sampleTypeID`),
  CONSTRAINT `fk_subsampletype_sampletype1` FOREIGN KEY (`sampleTypeID`) REFERENCES `sampletype` (`sampleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.subsampletype: ~8 rows (approximately)
INSERT INTO `subsampletype` (`subsampleID`, `subsampleName`, `sampleTypeID`) VALUES
	(0, 'default', 0),
	(1, 'hard_rock', 2),
	(2, 'heavy_metal', 2),
	(3, 'piano_melodies', 1),
	(5, 'piano_midi', 4),
	(6, 'guitar_midi', 4),
	(7, 'guitar', 1),
	(8, 'rock_kick_patterns', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Dumping data for table sampleselling.usercart: ~8 rows (approximately)
INSERT INTO `usercart` (`cart_ID`, `sampleID`, `qty`, `CustomerID`) VALUES
	(27, 51, 3, 3),
	(28, 61, 2, 3),
	(29, 52, 5, 3),
	(39, 50, 1, 1),
	(40, 61, 11, 1),
	(41, 56, 6, 1),
	(42, 50, 1, 4),
	(43, 61, 11, 4),
	(44, 56, 6, 4),
	(45, 51, 1, 4);

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
