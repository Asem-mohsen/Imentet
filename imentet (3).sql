-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 11:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imentet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Phone` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` tinyint(1) DEFAULT 1,
  `AdminRole` int(11) NOT NULL,
  `IsAdmin` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Phone`, `Address`, `Email`, `Password`, `Active`, `AdminRole`, `IsAdmin`) VALUES
(1, 'Assem Mohsen', 1152992719, 'Helwan', 'asemmohsen911@gmail.com', '$2y$10$ERghY5PzxBGcLwDM.ZGU8.wHpGEXRnU.NQXQBMBHI3cBJtZqyQsiy', 1, 1, 1),
(5, 'Ruqaya Amr', 1013363970, 'Elsharbia', 'RuqayaAmr@gmail.com', '$2y$10$ddpL2ij8Oo/eVFqO2tvqJesME3AuYKeqmXM/B3eq7b7Cw5H6rzDS2', 1, 3, 1),
(6, 'Farah Khalid', 1066026071, 'Imbaba', 'FarahKhalid@gmail.com', '$2y$10$WP9Nzi2v1N3pz1mU5cZWi.I4ARkaPx9oXlhfpeBAqLQICkaNMK9zO', 1, 3, 1),
(7, 'Amgad Mahmoud', 1090894656, 'Naser City', 'AmgadMahmoud@gmail.com', '$2y$10$D2kyqOdxeMueVoiE48lfrOtLiDI2OIv9wsn/pWNFanrL.E6pOYn3S', 1, 4, 1),
(8, 'Ziad Mahmoud', 1018857409, 'Cairo', 'ZiadMahmoud@gmail.com', '$2y$10$ZgN7loAXfjF.LhKr1YQ8PeGI4QiwBhUUm3jrXy3a3BEefzcdfnAm6', 1, 2, 1),
(17, 'Rawan Ayman', 1013242421, 'ShbinElkom', 'RawanAyman@yahoo.com', '$2y$10$R0RZllE1VQPwcvU6p9mWN.fV4KNq0x6EnEK0RVRxogK8XNbcMfC8y', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adminimage`
--

CREATE TABLE `adminimage` (
  `ID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `Image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminimage`
--

INSERT INTO `adminimage` (`ID`, `AdminID`, `Image`) VALUES
(1, 7, 'avatar.png'),
(2, 1, '241940616_4241108849330280_6103244856096797194_n.jpg'),
(3, 6, 'avatar.png'),
(5, 5, 'avatar.png'),
(6, 8, 'avatar.png'),
(10, 17, 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `adminrole`
--

CREATE TABLE `adminrole` (
  `ID` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminrole`
--

INSERT INTO `adminrole` (`ID`, `Role`) VALUES
(1, 'Master Level'),
(2, 'Strategic Level'),
(3, 'Operations'),
(4, 'Customer Service');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ContractID` int(11) DEFAULT NULL,
  `CareerID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Approved` int(11) NOT NULL DEFAULT 2,
  `Reason` varchar(255) DEFAULT NULL,
  `Rating` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ID`, `UserID`, `ContractID`, `CareerID`, `Date`, `Approved`, `Reason`, `Rating`) VALUES
(7, NULL, 10, 4, '2023-04-13', 1, 'Good Equipments and high Safety Rate', NULL),
(8, NULL, 9, 5, '2023-04-13', 1, 'High Safety Rate Compared to the price ', NULL),
(16, 2, NULL, 1, '2023-09-21', 2, '', NULL),
(28, 19, NULL, 3, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `ID` int(11) NOT NULL,
  `Careers` varchar(255) NOT NULL,
  `PlaceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`ID`, `Careers`, `PlaceID`) VALUES
(1, 'Store Owners', 2),
(2, 'Horse Riding', 1),
(3, 'Tour Guide', 2),
(4, 'Hot Air Balloon ', 1),
(5, 'Skydiving', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `ID` int(11) NOT NULL,
  `Collection` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `CatID` int(11) NOT NULL DEFAULT 1,
  `ShowOnPyramidsHome` int(2) NOT NULL DEFAULT 0,
  `ShowOnMuseumHome` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`ID`, `Collection`, `Image`, `Description`, `PlaceID`, `CatID`, `ShowOnPyramidsHome`, `ShowOnMuseumHome`) VALUES
(1, ' Egyptian mural', 'pexels-photo-3199399.jpeg', 'In the Old Kingdom pure painting of the highest quality is found as early as the 4th dynasty, in the scene of geese from the tomb of Nefermaat and Atet at Maydum. But the glory of Old Kingdom mural decoration is the low-relief work in the royal funerary m', 2, 1, 0, 0),
(2, 'Gold Tutankhamun Statue', 'tutankhamun-death-mask-pharaonic-egypt.jpg', 'This golden mask is the most famous of all the artefacts of ancient Egypt, a true icon of the pharaonic civilization. It will be the last artefact to be transported to the new museum.\r\nThe king is portrayed with the nemes, white and blue stripped line hea', 2, 1, 0, 1),
(4, 'Papyrus of Reckoning after Death', 'british-library-Z5glwhD3LH8-unsplash.jpg', 'In one of the great mythic cycles central to Egyptian religion, the goddess Isis took her infant son Horus to the papyrus thickets of the north to conceal him from her brother Seth, who had murdered her husband Osiris and usurped his throne. Horus grew to', 2, 1, 0, 0),
(5, 'Coffin of Ramesses II', 'Collections3.jpeg', 'The coffin of Ramesses II is one of the most-striking royal coffins discovered from ancient Egypt. Though stripped of its original embellishments, this late 18th Dynasty coffin is of the highest quality imported wood and was carefully reprocessed for the ', 2, 1, 0, 1),
(6, 'The Egyptian Queen Nefertiti', 'Nefertiti.jpg', 'Nefertiti was a queen of Egypt and wife of King Akhenaton, who played a prominent role in changing Egypt traditional polytheistic religion to one that was monotheistic worshipping the sun god known as Aton An elegant portrait bust of Nefertiti now in Berl', 2, 5, 0, 1),
(7, 'the Art of Ancient Egypt, Nubia, and the Near East ', 'kingandqueen.jpg', 'Featuring the pair statue of King Menkaura (Mycerinus) and queen; the triad of King Menkaura, the goddess Hathor, and the deified Hare nome; the bust of Prince Ankhhaf; and six “reserve heads,” the collection of Egyptian Old Kingdom masterpieces is the gr', 2, 1, 0, 1),
(8, 'A Bread in Ancient Egypt', 'collection-1-4.png', 'Around 2000 B.C., a baker in the ancient Egyptian city of Thebes captured yeast from the air and kneaded it into a triangle of dough. The baked bread was then buried in a dedication ceremony beneath the temple of Pharaoh Mentuhotep II on the west bank of ', 2, 2, 0, 0),
(9, 'Ancient Egyptian pottery', 'Ancient Egyptian pottery.jpg', 'Specialists in ancient Egyptian pottery draw a fundamental distinction between ceramics made of Nile clay and those made of marl clay, based on chemical and mineralogical composition and ceramic properties. Nile clay is the result of eroded material in th', 2, 1, 0, 0),
(10, 'Babylon', 'collections-3-2.jpeg', 'abylon is the name of an ancient city located on the lower Euphrates river in southern Mesopotamia. Babylon functioned as the main cultural and political centre of the Akkadian-speaking region of Babylonia, with its rulers establishing two important empir', 2, 4, 0, 1),
(11, 'Alexandria in Prison', 'collections-2-2.jpeg', 'Saint Catherine, a fourth-century princess of Alexandria, attempted to convince the Roman Emperor Maxentius of the validity of Christianity. In response, he condemned her to twelve days of starvation in prison. Veronese shows her in a dark cell comforted ', 2, 4, 0, 1),
(12, 'Mare and Foal', 'collection-3-3.jpg', 'With intuitive, emotive manipulations of color and an expansive vocabulary of short, quick, loose brushstrokes, Pierre-Auguste Renoir helped pioneer the Impressionist school of painting. Along with his friend Claude Monet, he privileged spontaneity and th', 2, 4, 0, 1),
(13, 'Christ Crucified (Velázquez)', 'collection-4-7.jpg', 'Velázquez followed the accepted iconography in the 17th century. His master, Francisco Pacheco, a big supporter of classicist painting, painted the crucified Christ using the same iconography later adopted by Velázquez: four nails, feet together and suppo', 2, 4, 0, 1),
(15, 'The Tower Of Babel', 'collections-2-6.jpeg', 'The Tower of Babel is a oil paintings by Pieter Bruegel the Elder. They depict the construction of the Tower of Babel, which according to the Book of Genesis in the Bible was a tower built by a unified, mono-lingual humanity as a mark of their achievement', 2, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `collectionscategories`
--

CREATE TABLE `collectionscategories` (
  `ID` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collectionscategories`
--

INSERT INTO `collectionscategories` (`ID`, `Category`) VALUES
(1, 'Antiquities'),
(2, 'Cultural'),
(3, 'Drawing'),
(4, 'Painting'),
(5, 'Sculpture');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PlaceID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`ID`, `UserID`, `Name`, `Email`, `PlaceID`, `Amount`, `PaymentID`) VALUES
(1, NULL, 'Assem Mohsen', 'asem911@yahoo.com', 1, 3000, 1),
(3, NULL, 'Assem Mohsen', 'asemmohsen911@gmail.com', 2, 4000, 3),
(8, NULL, 'Sara Sabry', 'SaraSabry@hotmail.com', 1, 10000, 3),
(19, 2, NULL, NULL, 2, 1000000, 1),
(22, NULL, 'Mohsen Sayed', 'Mohsen@yahoo.com', 2, 2000, 3),
(24, 24, NULL, NULL, 2, 1500, 1),
(25, NULL, 'Hisham mounir', 'HishamMounir@gmail.com', 1, 2000, 1),
(26, 24, NULL, NULL, 2, 1500, 1),
(27, NULL, 'Hisham mounir', 'HishamMounir@gmail.com', 1, 2000, 1),
(28, NULL, 'Julia Darwin', 'JuliaDarwin@gmail.com', 1, 1000, 1),
(29, 25, NULL, NULL, 1, 2500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnet`
--

CREATE TABLE `entertainmnet` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip',
  `PlaceID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `DateTo` date DEFAULT NULL,
  `Everyday` varchar(50) DEFAULT NULL,
  `RegularPrice` int(11) NOT NULL,
  `VipPrice` int(11) DEFAULT NULL,
  `CatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnet`
--

INSERT INTO `entertainmnet` (`ID`, `Name`, `Image`, `Description`, `PlaceID`, `Date`, `DateTo`, `Everyday`, `RegularPrice`, `VipPrice`, `CatID`) VALUES
(2, 'Maroon 5', 'KH5Yl8ji0anMIxBXXcyT7gNehD4TNvcDQJus7jFciGg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-14', NULL, NULL, 3500, 6000, 1),
(12, 'Career 180', 'Career180.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-03-25', NULL, NULL, 200, 300, 7),
(13, 'Art D’Égypte', 'foreverisnow-evergreen-pic2-1600px.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-11-24', '2023-11-30', NULL, 200, 400, 2),
(20, 'Running Marathon', 'f380ae_909314030dee4b71959e42574be40499_mv2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-12-28', NULL, NULL, 800, 1200, 3),
(21, 'Sound Clash', 'pexels-josh-sorenson-976866.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2024-11-27', NULL, NULL, 600, 1200, 1),
(22, 'Carl Cox', 'pexels-wendy-wei-1190297.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-05-19', NULL, NULL, 2000, 5000, 1),
(23, 'Shakira', 'pexels-annam-w-1047442.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-09-28', NULL, NULL, 2500, 10000, 1),
(24, '47 SOUL', 'pexels-wendy-wei-1190298.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-09-07', NULL, NULL, 500, 1000, 1),
(25, 'Dior', 'Dior.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2022-12-22', NULL, NULL, 3000, 6000, 6),
(26, 'Skydiving Egypt', 'Skydiving.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-15', '0000-00-00', 'Daily', 1500, 6000, 3),
(27, 'Squash ', 'squach.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-08', '0000-00-00', '', 350, 650, 3),
(28, 'Mega Marathon ', 'Marathon.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-07-13', NULL, NULL, 1200, 3000, 3),
(29, 'Signs From Egypt', 'signsfromegypt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-05-10', '2023-05-26', '', 200, 400, 2),
(41, 'Horse And Camels', 'Horses.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-04-13', '0000-00-00', 'Daily', 100, 0, 3),
(43, 'Children Museum', 'ChildernMus.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-06-22', '0000-00-00', 'Daily', 60, 0, 8),
(44, 'Hot Air Balloon', 'HotAir.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-09-29', '0000-00-00', 'Daily', 1500, 0, 3),
(50, 'The Exhibits Cover All Time of The Egyptian Civilization', 'collections-3-1.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-08-12', '2023-09-21', '', 150, 0, 9),
(51, 'Hadrian and Athens. Conversing with an Ideal World', 'collections-3-2.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-07-05', '2023-08-15', '', 150, 0, 9),
(52, 'Classicita ed Europa. The common destiny of Greece and Italy', 'collections-3-3.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-01-18', '2024-02-28', '', 200, 0, 9),
(53, 'Amr Diab', 'amrdiab.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-01-31', '0000-00-00', '', 1500, 2500, 1),
(54, 'Golden Parade Memorial Festival', 'GoldenParade.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-04-02', '2024-04-03', '', 300, 0, 2),
(55, 'Arts for Kids', 'event-2-2.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-05-15', '0000-00-00', '', 500, 0, 8),
(56, 'Business Hub ', 'Congress.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-07-14', '2023-08-02', '', 200, 0, 7),
(57, 'Opening Ceremony', 'opining.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-11-08', '2023-11-12', '', 2000, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnetcategory`
--

CREATE TABLE `entertainmnetcategory` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnetcategory`
--

INSERT INTO `entertainmnetcategory` (`ID`, `Name`) VALUES
(1, 'Concerts'),
(2, 'Festivals'),
(3, 'Sport Events'),
(6, 'Brand Events'),
(7, 'Bussines'),
(8, 'Education'),
(9, 'Exhibitions');

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnetticket`
--

CREATE TABLE `entertainmnetticket` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnetticket`
--

INSERT INTO `entertainmnetticket` (`ID`, `EventID`, `UserID`, `Price`, `PaymentID`, `Quantity`) VALUES
(7, 24, 2, 2000, 1, 4),
(8, 41, 2, 200, 1, 2),
(10, 41, 22, 100, 1, 1),
(11, 52, 23, 400, 1, 2),
(12, 55, 25, 1000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `eventsponsor`
--

CREATE TABLE `eventsponsor` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `ContractID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventsponsor`
--

INSERT INTO `eventsponsor` (`ID`, `EventID`, `ContractID`) VALUES
(1, 2, 2),
(4, 13, 3),
(5, 20, 2),
(7, 12, 3),
(8, 21, 2),
(9, 22, 2),
(10, 23, 3),
(11, 24, 2),
(12, 25, 6),
(13, 26, 9),
(14, 27, 4),
(15, 28, 4),
(16, 29, 6),
(28, 41, 2),
(29, 43, 4),
(30, 44, 10),
(36, 50, 6),
(37, 51, 7),
(38, 52, 3),
(39, 53, 2),
(40, 54, 3),
(41, 55, 7),
(42, 56, 6),
(43, 57, 12);

-- --------------------------------------------------------

--
-- Table structure for table `eventstatus`
--

CREATE TABLE `eventstatus` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventstatus`
--

INSERT INTO `eventstatus` (`ID`, `EventID`, `Status`, `Reason`) VALUES
(1, 24, 'Postponed', 'The band did not abide with our terms and conditions '),
(3, 2, 'Cancelled', 'The band objected to the concert price');

-- --------------------------------------------------------

--
-- Table structure for table `eventticketcart`
--

CREATE TABLE `eventticketcart` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `EntertainmnetID` int(11) NOT NULL,
  `Description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `UserID`, `EntertainmnetID`, `Description`) VALUES
(1, 2, 2, 'The Concert was amazing, I really liked it'),
(8, 2, 41, 'Great'),
(9, 23, 2, 'It was Amaaaaazing');

-- --------------------------------------------------------

--
-- Table structure for table `giftcategory`
--

CREATE TABLE `giftcategory` (
  `ID` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giftcategory`
--

INSERT INTO `giftcategory` (`ID`, `Category`, `Image`) VALUES
(1, 'Furniture ', 'Furnitrue.jpg'),
(3, 'Antiques ', 'Antiques.jpeg'),
(5, 'Paintings ', 'Paintings.jpg'),
(6, 'Hand Made ', 'HandMade.jpg'),
(7, 'Sculptures', 'Sculpture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `giftshop`
--

CREATE TABLE `giftshop` (
  `ID` int(11) NOT NULL,
  `Item` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giftshop`
--

INSERT INTO `giftshop` (`ID`, `Item`, `Image`, `Quantity`, `Price`, `CategoryID`) VALUES
(1, 'Sofa', 'images (2).jpg', 5, 500, 1),
(3, 'Rest Chair ', 'images (4).jpg', 10, 1500, 1),
(4, 'Ground of Articles', '330382482_1378123043007226_3098661652734508013_n.jpg', 22, 5000, 5),
(6, 'Tutankhamun Chair', 'Chair.jpg', 8, 2500, 1),
(7, 'Ancient Egyptian Chair ', 'Furnitrue.jpg', 8, 6000, 1),
(8, 'Box', 'shop-1-2.jpg', 7, 400, 3),
(9, 'Lizard Sculpture', 'collection-1-2.png', 20, 500, 7),
(10, 'Medal', 'shop-1-4.jpg', 22, 150, 6),
(11, 'Othman Empire Painting ', 'event-d-g-1.jpg', 22, 700, 5),
(12, 'Van Gough Paint', 'cart-1-2.jpg', 21, 600, 5),
(13, 'Volcano Painting', 'cart-1-1.jpg', 25, 400, 5),
(14, 'Winged Sacred Scarab', 'Unique.jpg', 21, 500, 3),
(15, 'Scarab winged black', 'Scarab.jpg', 34, 500, 7),
(16, 'Scarab Beetele Khepri', 'statue of winged.jpg', 42, 800, 7),
(17, 'key of life', '61w11tYnKIL.__AC_SX300_SY300_QL70_ML2_.jpg', 44, 300, 6),
(18, 'Sphinx heavy stone', '81baHk3Y4qL._AC_SX569_.jpg', 41, 800, 7),
(19, ' King Menkaure pharaoh', '71Y7DLrMlmL._AC_SY879_.jpg', 34, 1000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `itemscart`
--

CREATE TABLE `itemscart` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `GiftShopID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Price` int(11) DEFAULT NULL,
  `PeriodID` int(11) NOT NULL,
  `Entry` tinyint(2) NOT NULL,
  `DiscountOnTours` tinyint(1) DEFAULT NULL,
  `AccessKidsArea` tinyint(1) DEFAULT NULL,
  `ChildernMuseum` int(2) DEFAULT NULL,
  `VouchersMuseum` int(2) DEFAULT NULL,
  `DiscountOnKidsClasses` tinyint(1) DEFAULT NULL,
  `SubsMuseumLib` int(2) DEFAULT NULL,
  `AccessMuseumLib` int(2) DEFAULT NULL,
  `SpecialRecognition` int(2) DEFAULT NULL,
  `AccessToEvents` int(2) DEFAULT NULL,
  `FreeMuseumRest` int(2) DEFAULT NULL,
  `AccessTutankhamun` int(2) DEFAULT NULL,
  `AccessHologram` int(2) DEFAULT NULL,
  `AccessToMonuments` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`ID`, `Type`, `Price`, `PeriodID`, `Entry`, `DiscountOnTours`, `AccessKidsArea`, `ChildernMuseum`, `VouchersMuseum`, `DiscountOnKidsClasses`, `SubsMuseumLib`, `AccessMuseumLib`, `SpecialRecognition`, `AccessToEvents`, `FreeMuseumRest`, `AccessTutankhamun`, `AccessHologram`, `AccessToMonuments`) VALUES
(6, 'Individual', 350, 1, 2, 1, 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Families', 600, 1, 2, 1, 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Supporting', NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL),
(13, 'Patron', NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, 1, 1),
(16, 'Students', 250, 1, 2, 1, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0),
(17, 'Seniors', 330, 1, 2, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `membershippayemnts`
--

CREATE TABLE `membershippayemnts` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `MembershipID` int(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `EndsIn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membershippayemnts`
--

INSERT INTO `membershippayemnts` (`ID`, `UserID`, `MembershipID`, `Cost`, `PaymentID`, `Date`, `EndsIn`) VALUES
(6, 2, 12, 1000000, 2, '2023-04-25', '2025-04-25'),
(9, 19, 8, 600, 1, '2023-05-07', '2023-06-07'),
(11, 24, 16, 250, 1, '2023-05-13', '2023-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `membershipperiod`
--

CREATE TABLE `membershipperiod` (
  `ID` int(11) NOT NULL,
  `Period` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membershipperiod`
--

INSERT INTO `membershipperiod` (`ID`, `Period`) VALUES
(1, 'Monthly'),
(2, 'Yearly'),
(3, 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `paymentoptions`
--

CREATE TABLE `paymentoptions` (
  `ID` int(11) NOT NULL,
  `PaymentType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentoptions`
--

INSERT INTO `paymentoptions` (`ID`, `PaymentType`) VALUES
(1, 'Visa'),
(2, 'Cash'),
(3, 'Master Card'),
(4, 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`ID`, `Name`) VALUES
(1, 'Pyramids'),
(2, 'Grand Egyptian Museum');

-- --------------------------------------------------------

--
-- Table structure for table `q&a`
--

CREATE TABLE `q&a` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UsersQuestion` varchar(400) NOT NULL,
  `CsAnswer` varchar(400) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `ResponseFilter` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `q&a`
--

INSERT INTO `q&a` (`ID`, `Email`, `UsersQuestion`, `CsAnswer`, `AdminID`, `ResponseFilter`) VALUES
(1, 'Sherin@gmail.com', 'Opening Hours ?', 'Everyday From 9am to 6pm', 1, 1),
(2, 'Manar@gmail.com', 'Is there any transportations inside The pyramids area or even in the GEM ', 'Yes, We\'ll Launch a Transportation platform including all the details about the transportations', 1, 1),
(3, 'FarahaElsayed@gmail.com', 'What\'s Imentet Future plan ?', 'Our Main & Only Plan we have is to develop all archaeological sites to keep pace with upcoming ages ', 1, 1),
(5, 'Samy@gmail.com', 'How long is the Opening Ceremony? And can we book it ?', 'All the Opening Ceremony\'s Details will be posted soon', 1, 1),
(6, 'DavidGamal@gmail.com', 'How many Gates in the Pyramids area ?', 'Now we have 2 Gates and 4 under construction, to serve all visitors', 1, 1),
(7, 'SamarWessam@gmail.com', 'What is special about the Grand Egyptian Museum?', 'the world\'s largest museum dedicated to a single civilization.', 1, 1),
(8, 'FathiaElsayed@gmail.com', 'Is the Museum Open for visitors at the moment?', 'it is partially open for you to visit the galleries that are finished.', 1, 1),
(18, 'RawanMohsen@gmail.com', 'What the Grand Egyptian Museum will look like ?', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopcomments`
--

CREATE TABLE `shopcomments` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopcomments`
--

INSERT INTO `shopcomments` (`ID`, `ProductID`, `UserID`, `Comment`) VALUES
(1, 14, 24, 'Good Quality');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship`
--

CREATE TABLE `sponsorship` (
  `ContractID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContractedWith` text NOT NULL,
  `MembershipID` int(11) DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsorship`
--

INSERT INTO `sponsorship` (`ContractID`, `Name`, `ContractedWith`, `MembershipID`) VALUES
(2, 'Orange', 'MR. Nagiub Swirss', 12),
(3, 'Vodafone', 'Mohamed AbdAllah', 12),
(4, '57357', 'Dr. Amr Ezzat Salama', 12),
(5, 'Pepsi ', 'Ramon Laguarta', 12),
(6, 'HSBC', 'Todd Wilcox', 12),
(7, 'Bank Misr', 'Hisham Okasha', 12),
(9, 'Skydiving Egypt', 'MR. Faris Selim', 12),
(10, 'AirBalloon Egypt', 'Mr. Wassim Al-Suraity', 12),
(12, 'Entertainment Department of the GEM', 'Mr. Seif ElDeen Zakaria ', 12);

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `StationID` int(11) NOT NULL,
  `Station` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`StationID`, `Station`) VALUES
(2, 'GEM Parking'),
(3, 'Sphinx'),
(4, 'Pyramids Parking');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `StationID` int(11) NOT NULL,
  `ArrivalTime` time NOT NULL DEFAULT current_timestamp(),
  `StationTo` int(11) DEFAULT NULL,
  `DepartureTime` time NOT NULL DEFAULT current_timestamp(),
  `Price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`ID`, `Type`, `StationID`, `ArrivalTime`, `StationTo`, `DepartureTime`, `Price`) VALUES
(4, 'Bus', 2, '15:32:00', 3, '15:34:00', 0),
(5, 'Bus', 3, '13:33:55', 2, '16:00:00', 0),
(6, 'Bus', 4, '01:44:26', 2, '17:46:00', 0),
(7, 'Bus', 2, '01:49:02', 4, '06:52:02', 0),
(10, 'Bus', 3, '01:40:00', 4, '13:40:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Name` text DEFAULT NULL,
  `LastName` varchar(255) NOT NULL,
  `DateOfBirth` varchar(255) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RoleID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `LastName`, `DateOfBirth`, `Phone`, `Email`, `Password`, `RoleID`) VALUES
(2, 'Rawan', 'Mohsen', NULL, 1038239233, 'RawanMohsen@gmail.com', '$2y$10$TlO98K3bxUtODWGFSvFJWOby/OspGIT2Hl9sNRb9GGNOLu4Xj04M6', 1),
(19, 'Rana', 'Gamal', NULL, 1123290421, 'Rana@gmail.com', '$2y$10$jgGl212DYVjjDOb5iUqCC.QCJKAHVHZ76j/rRXIQGXKS/FH9nvhGm', NULL),
(22, 'ziad', '', NULL, NULL, 'ziad@gmail.com', '$2y$10$5aRjoyfUWWlQhma7.kgMC.TJZIdChLfG0ZINVj1lADMrD4Ay6tkkK', NULL),
(23, 'Khalid', 'Ashraf', NULL, NULL, 'KhaledAshraf@gmail.com', '$2y$10$xbTpHEnIxvHKztb8eh/J3ew4Cy5uTlpLHH1Y/KuvXPRDTSN9FkGrq', NULL),
(24, 'Grovin', 'Farid', NULL, NULL, 'Grovin@yahoo.com', '$2y$10$IwZtbiYacFBHBUfvzIhAuORFEjS6Dx3GAwGBkoY2MZzgXwimaWgxy', NULL),
(25, 'Fady', 'Hennah', '2000-06-28', 0, 'Fady@yahoo.com', '$2y$10$i8z.fIGbKFVsklyNttk1e.M/OpdALN.wVQufxp7PciHW7vIKWp1tS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userimages`
--

CREATE TABLE `userimages` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userimages`
--

INSERT INTO `userimages` (`ID`, `UserID`, `Image`) VALUES
(1, 2, 'avatar.png'),
(4, 19, 'avatar.png'),
(7, 22, 'avatar.png'),
(8, 23, 'avatar.png'),
(9, 24, 'avatar.png'),
(10, 25, 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `useritems`
--

CREATE TABLE `useritems` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `GiftShopID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useritems`
--

INSERT INTO `useritems` (`ID`, `UserID`, `GiftShopID`, `Quantity`, `PaymentID`, `Total`) VALUES
(69, 2, 3, 2, 1, 3000),
(71, 2, 6, 2, 1, 5000),
(72, 2, 3, 2, 1, 3000),
(73, 2, 8, 1, 1, 400),
(74, 2, 13, 2, 1, 800),
(77, 24, 12, 1, 1, 600),
(78, 24, 12, 1, 1, 600),
(79, 25, 14, 2, 1, 1000),
(82, 25, 8, 1, 1, 400),
(85, 25, 17, 1, 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `ID` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`ID`, `RoleName`) VALUES
(1, 'Egyptian Student'),
(2, 'Foreigner '),
(3, 'Foreigner Student'),
(4, 'Disabilities '),
(5, 'Egyptian');

-- --------------------------------------------------------

--
-- Table structure for table `visitpricing`
--

CREATE TABLE `visitpricing` (
  `ID` int(11) NOT NULL,
  `UserRole` int(11) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `EntranceFee` int(11) NOT NULL,
  `MuseumFee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitpricing`
--

INSERT INTO `visitpricing` (`ID`, `UserRole`, `PlaceID`, `EntranceFee`, `MuseumFee`) VALUES
(1, 1, 2, 70, 140),
(3, 1, 1, 50, NULL),
(4, 2, 2, 200, 500),
(5, 3, 2, 100, 400),
(6, 3, 1, 250, NULL),
(7, 4, 1, 50, 0),
(13, 4, 2, 70, 140),
(14, 2, 1, 500, 0),
(15, 5, 2, 100, 170),
(16, 5, 1, 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitticket`
--

CREATE TABLE `visitticket` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `Quantity` int(2) NOT NULL DEFAULT 1,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitticket`
--

INSERT INTO `visitticket` (`ID`, `UserID`, `PlaceID`, `Date`, `PaymentID`, `Quantity`, `Total`) VALUES
(12, 2, 2, '2023-05-03', 1, 4, 620),
(16, 2, 2, '2023-05-04', 1, 2, 310),
(18, 24, 2, '2023-05-08', 1, 1, 140),
(19, 24, 2, '2023-05-31', 1, 5, 1120),
(20, 24, 2, '2023-05-08', 1, 1, 170),
(26, 25, 2, '2023-05-13', 1, 10, 1490);

-- --------------------------------------------------------

--
-- Table structure for table `visitticketnotpaid`
--

CREATE TABLE `visitticketnotpaid` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AdminRole` (`AdminRole`);

--
-- Indexes for table `adminimage`
--
ALTER TABLE `adminimage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `adminrole`
--
ALTER TABLE `adminrole`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CareerID` (`CareerID`),
  ADD KEY `ContractID` (`ContractID`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlaceID` (`PlaceID`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlaceID` (`PlaceID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `collectionscategories`
--
ALTER TABLE `collectionscategories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlaceID` (`PlaceID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `entertainmnet`
--
ALTER TABLE `entertainmnet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlaceID` (`PlaceID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `entertainmnetcategory`
--
ALTER TABLE `entertainmnetcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `entertainmnetticket`
--
ALTER TABLE `entertainmnetticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventID` (`EventID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PaymentID` (`PaymentID`),
  ADD KEY `Price` (`Price`);

--
-- Indexes for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventID` (`EventID`),
  ADD KEY `ContractID` (`ContractID`);

--
-- Indexes for table `eventstatus`
--
ALTER TABLE `eventstatus`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `eventticketcart`
--
ALTER TABLE `eventticketcart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EntertainmnetID` (`EntertainmnetID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `giftcategory`
--
ALTER TABLE `giftcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `giftshop`
--
ALTER TABLE `giftshop`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `itemscart`
--
ALTER TABLE `itemscart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `GiftShopID` (`GiftShopID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PeriodID` (`PeriodID`);

--
-- Indexes for table `membershippayemnts`
--
ALTER TABLE `membershippayemnts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PaymentID` (`PaymentID`),
  ADD KEY `MembershipID` (`MembershipID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `membershipperiod`
--
ALTER TABLE `membershipperiod`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paymentoptions`
--
ALTER TABLE `paymentoptions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `q&a`
--
ALTER TABLE `q&a`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `shopcomments`
--
ALTER TABLE `shopcomments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `sponsorship`
--
ALTER TABLE `sponsorship`
  ADD PRIMARY KEY (`ContractID`),
  ADD KEY `MembershipID` (`MembershipID`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`StationID`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StationID` (`StationID`),
  ADD KEY `StationTo` (`StationTo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `userimages`
--
ALTER TABLE `userimages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `useritems`
--
ALTER TABLE `useritems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `GiftShopID` (`GiftShopID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `visitpricing`
--
ALTER TABLE `visitpricing`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserRole` (`UserRole`),
  ADD KEY `PlaceID` (`PlaceID`);

--
-- Indexes for table `visitticket`
--
ALTER TABLE `visitticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlaceID` (`PlaceID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `visitticketnotpaid`
--
ALTER TABLE `visitticketnotpaid`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `UserRoleID` (`UserRoleID`),
  ADD KEY `PlaceID` (`PlaceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `adminimage`
--
ALTER TABLE `adminimage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `adminrole`
--
ALTER TABLE `adminrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `collectionscategories`
--
ALTER TABLE `collectionscategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `entertainmnet`
--
ALTER TABLE `entertainmnet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `entertainmnetcategory`
--
ALTER TABLE `entertainmnetcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `entertainmnetticket`
--
ALTER TABLE `entertainmnetticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `eventstatus`
--
ALTER TABLE `eventstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eventticketcart`
--
ALTER TABLE `eventticketcart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `giftcategory`
--
ALTER TABLE `giftcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `giftshop`
--
ALTER TABLE `giftshop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `itemscart`
--
ALTER TABLE `itemscart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `membershippayemnts`
--
ALTER TABLE `membershippayemnts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `membershipperiod`
--
ALTER TABLE `membershipperiod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentoptions`
--
ALTER TABLE `paymentoptions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `q&a`
--
ALTER TABLE `q&a`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shopcomments`
--
ALTER TABLE `shopcomments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sponsorship`
--
ALTER TABLE `sponsorship`
  MODIFY `ContractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `StationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userimages`
--
ALTER TABLE `userimages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `useritems`
--
ALTER TABLE `useritems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitpricing`
--
ALTER TABLE `visitpricing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `visitticket`
--
ALTER TABLE `visitticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `visitticketnotpaid`
--
ALTER TABLE `visitticketnotpaid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AdminRole`) REFERENCES `adminrole` (`ID`);

--
-- Constraints for table `adminimage`
--
ALTER TABLE `adminimage`
  ADD CONSTRAINT `adminimage_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`ID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`CareerID`) REFERENCES `careers` (`ID`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`ContractID`) REFERENCES `sponsorship` (`ContractID`);

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `collections_ibfk_2` FOREIGN KEY (`CatID`) REFERENCES `collectionscategories` (`ID`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `donations_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

--
-- Constraints for table `entertainmnet`
--
ALTER TABLE `entertainmnet`
  ADD CONSTRAINT `entertainmnet_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `entertainmnet_ibfk_2` FOREIGN KEY (`CatID`) REFERENCES `entertainmnetcategory` (`ID`);

--
-- Constraints for table `entertainmnetticket`
--
ALTER TABLE `entertainmnetticket`
  ADD CONSTRAINT `entertainmnetticket_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `entertainmnetticket_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `entertainmnet` (`ID`),
  ADD CONSTRAINT `entertainmnetticket_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

--
-- Constraints for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  ADD CONSTRAINT `eventsponsor_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `entertainmnet` (`ID`),
  ADD CONSTRAINT `eventsponsor_ibfk_2` FOREIGN KEY (`ContractID`) REFERENCES `sponsorship` (`ContractID`);

--
-- Constraints for table `eventstatus`
--
ALTER TABLE `eventstatus`
  ADD CONSTRAINT `eventstatus_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `entertainmnet` (`ID`);

--
-- Constraints for table `eventticketcart`
--
ALTER TABLE `eventticketcart`
  ADD CONSTRAINT `eventticketcart_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `entertainmnet` (`ID`),
  ADD CONSTRAINT `eventticketcart_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`EntertainmnetID`) REFERENCES `entertainmnet` (`ID`);

--
-- Constraints for table `giftshop`
--
ALTER TABLE `giftshop`
  ADD CONSTRAINT `giftshop_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `giftcategory` (`ID`);

--
-- Constraints for table `itemscart`
--
ALTER TABLE `itemscart`
  ADD CONSTRAINT `itemscart_ibfk_1` FOREIGN KEY (`GiftShopID`) REFERENCES `giftshop` (`ID`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`PeriodID`) REFERENCES `membershipperiod` (`ID`);

--
-- Constraints for table `membershippayemnts`
--
ALTER TABLE `membershippayemnts`
  ADD CONSTRAINT `membershippayemnts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `membershippayemnts_ibfk_2` FOREIGN KEY (`MembershipID`) REFERENCES `membership` (`ID`),
  ADD CONSTRAINT `membershippayemnts_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

--
-- Constraints for table `q&a`
--
ALTER TABLE `q&a`
  ADD CONSTRAINT `q&a_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`ID`);

--
-- Constraints for table `shopcomments`
--
ALTER TABLE `shopcomments`
  ADD CONSTRAINT `shopcomments_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `giftshop` (`ID`),
  ADD CONSTRAINT `shopcomments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `sponsorship`
--
ALTER TABLE `sponsorship`
  ADD CONSTRAINT `sponsorship_ibfk_1` FOREIGN KEY (`MembershipID`) REFERENCES `membership` (`ID`);

--
-- Constraints for table `transportation`
--
ALTER TABLE `transportation`
  ADD CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`StationID`) REFERENCES `stations` (`StationID`),
  ADD CONSTRAINT `transportation_ibfk_2` FOREIGN KEY (`StationTo`) REFERENCES `stations` (`StationID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userrole` (`ID`);

--
-- Constraints for table `userimages`
--
ALTER TABLE `userimages`
  ADD CONSTRAINT `userimages_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `useritems`
--
ALTER TABLE `useritems`
  ADD CONSTRAINT `useritems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `useritems_ibfk_2` FOREIGN KEY (`GiftShopID`) REFERENCES `giftshop` (`ID`),
  ADD CONSTRAINT `useritems_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

--
-- Constraints for table `visitpricing`
--
ALTER TABLE `visitpricing`
  ADD CONSTRAINT `visitpricing_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `visitpricing_ibfk_2` FOREIGN KEY (`UserRole`) REFERENCES `userrole` (`ID`);

--
-- Constraints for table `visitticket`
--
ALTER TABLE `visitticket`
  ADD CONSTRAINT `visitticket_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `visitticket_ibfk_2` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `visitticket_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

--
-- Constraints for table `visitticketnotpaid`
--
ALTER TABLE `visitticketnotpaid`
  ADD CONSTRAINT `visitticketnotpaid_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`),
  ADD CONSTRAINT `visitticketnotpaid_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `visitticketnotpaid_ibfk_3` FOREIGN KEY (`UserRoleID`) REFERENCES `userrole` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
