-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 11:59 PM
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
  `AdminRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Phone`, `Address`, `Email`, `Password`, `Active`, `AdminRole`) VALUES
(1, 'Assem Mohsen', 1152992719, 'Helwan', 'asemmohsen911@gmail.com', '$2y$10$DryWEEYGIguJezvwAonGUuFoiv..9WDoElB8RucNLW.vrX7C3giA6', 1, 1),
(4, 'Rawan Ayman', 1098656413, 'Madinty', 'RawanAyman@yahoo.com', '$2y$10$6SZCltF1dxPBqK29mGBQt.ObjCoWi6VgzNad9Ou/bAkpurnOZuwA6', 2, 2),
(5, 'Ruqaya Amr', 1013363970, 'Dokki', 'RuqayaAmr@gmail.com', '$2y$10$ddpL2ij8Oo/eVFqO2tvqJesME3AuYKeqmXM/B3eq7b7Cw5H6rzDS2', 1, 3),
(6, 'Farah Khalid', 1066026071, 'Naser City', 'FarahKhalid@gmail.com', '$2y$10$WP9Nzi2v1N3pz1mU5cZWi.I4ARkaPx9oXlhfpeBAqLQICkaNMK9zO', 1, 3),
(7, 'Amgad Mahmoud', 1090894656, 'Naser City', 'AmgadMahmoud@gmail.com', '$2y$10$D2kyqOdxeMueVoiE48lfrOtLiDI2OIv9wsn/pWNFanrL.E6pOYn3S', 1, 4),
(8, 'Ziad Mahmoud', 1018857409, 'Cairo', 'ZiadMahmoud@gmail.com', '$2y$10$ZgN7loAXfjF.LhKr1YQ8PeGI4QiwBhUUm3jrXy3a3BEefzcdfnAm6', 0, 2);

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
  `UserID` int(11) NOT NULL,
  `CareerID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Approved` int(11) NOT NULL DEFAULT 2,
  `Reason` varchar(255) DEFAULT NULL,
  `Rating` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ID`, `UserID`, `CareerID`, `Date`, `Approved`, `Reason`, `Rating`) VALUES
(1, 2, 2, '2023-03-22', 0, 'She is not applicable for the job', NULL),
(3, 3, 2, '2023-03-15', 2, '', NULL),
(4, 11, 3, '2023-03-09', 1, 'Manager\'s son', NULL),
(5, 12, 3, '2023-03-17', 1, 'Perfect Tour Guide', NULL),
(6, 12, 1, NULL, 2, NULL, NULL);

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
(3, 'Tour Guide', 2);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `ID` int(11) NOT NULL,
  `Collection` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `PlaceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`ID`, `Collection`, `Image`, `Description`, `PlaceID`) VALUES
(1, ' Egyptian mural', 'pexels-photo-3199399.jpeg', 'In the Old Kingdom pure painting of the highest quality is found as early as the 4th dynasty, in the scene of geese from the tomb of Nefermaat and Atet at Maydum. But the glory of Old Kingdom mural decoration is the low-relief work in the royal funerary m', 2),
(2, 'Gold Tutankhamun Statue', 'tutankhamun-death-mask-pharaonic-egypt.jpg', 'This golden mask is the most famous of all the artefacts of ancient Egypt, a true icon of the pharaonic civilization. It will be the last artefact to be transported to the new museum.\r\nThe king is portrayed with the nemes, white and blue stripped line hea', 2);

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
(2, 3, NULL, NULL, 2, 1000, 3),
(3, NULL, 'Assem Mohsen', 'asemmohsen911@gmail.com', 2, 4000, 3),
(4, 2, NULL, NULL, 1, 300, 2),
(5, 11, NULL, NULL, 2, 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnet`
--

CREATE TABLE `entertainmnet` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `DateTo` date DEFAULT NULL,
  `Everyday` varchar(50) DEFAULT NULL,
  `RegularPrice` int(11) NOT NULL,
  `VipPrice` int(11) NOT NULL,
  `CatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnet`
--

INSERT INTO `entertainmnet` (`ID`, `Name`, `Image`, `PlaceID`, `Date`, `DateTo`, `Everyday`, `RegularPrice`, `VipPrice`, `CatID`) VALUES
(2, 'Maroon 5', 'KH5Yl8ji0anMIxBXXcyT7gNehD4TNvcDQJus7jFciGg.jpg', 1, '2023-06-14', NULL, NULL, 3500, 6000, 1),
(12, 'Career 180', 'Career180.png', 2, '2023-03-25', NULL, NULL, 200, 300, 7),
(13, 'Art D’Égypte', 'foreverisnow-evergreen-pic2-1600px.jpg', 1, '2023-11-24', '2023-11-30', NULL, 200, 400, 2),
(20, 'Running Marathon', 'f380ae_909314030dee4b71959e42574be40499_mv2.jpg', 1, '2023-12-28', NULL, NULL, 800, 1200, 3),
(21, 'Sound Clash', 'pexels-josh-sorenson-976866.jpg', 1, '2024-11-27', NULL, NULL, 600, 1200, 1),
(22, 'Carl Cox', 'pexels-wendy-wei-1190297.jpg', 1, '2023-05-19', NULL, NULL, 2000, 5000, 1),
(23, 'Shakira', 'pexels-annam-w-1047442.jpg', 2, '2023-09-28', NULL, NULL, 2500, 10000, 1),
(24, '47 SOUL', 'pexels-wendy-wei-1190298.jpg', 2, '2023-09-07', NULL, NULL, 500, 1000, 1),
(25, 'Dior', 'Dior.jpg', 1, '2022-12-22', NULL, NULL, 3000, 6000, 6),
(26, 'Skydiving Egypt', 'Skydiving.jpg', 1, '2023-06-15', '0000-00-00', 'Daily', 1500, 6000, 3),
(27, 'Squash ', 'squach.jpg', 1, '2023-06-08', NULL, NULL, 350, 650, 3),
(28, 'Mega Marathon ', 'Marathon.jpg', 1, '2023-07-13', NULL, NULL, 1200, 3000, 3),
(29, 'Signs From Egypt', 'signsfromegypt.jpg', 2, '2023-05-10', '2023-05-26', '', 200, 400, 2),
(41, 'Horse And Camels', 'Horses.jpg', 1, '2023-03-29', '0000-00-00', 'Daily', 100, 200, 3);

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
(7, 'Bussines');

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnetticket`
--

CREATE TABLE `entertainmnetticket` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnetticket`
--

INSERT INTO `entertainmnetticket` (`ID`, `EventID`, `UserID`, `Price`, `PaymentID`) VALUES
(4, 2, 2, 3000, 3),
(5, 12, 3, 300, 4),
(6, 20, 2, 800, 4);

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
(13, 26, 3),
(14, 27, 4),
(15, 28, 4),
(16, 29, 6),
(28, 41, 5);

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
(2, 11, 25, 'Everything was perfect but the price was too high'),
(3, 12, 28, 'Need More Improvements on the land   '),
(4, 3, 25, 'Nice Choice for the place with the view of the pyramids, I was amazed by the show');

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
(1, 'Sofa', 'images (2).jpg', 10, 500, 1),
(3, 'Rest Chair ', 'images (4).jpg', 3, 1500, 1),
(4, 'Ground of Articles', '330382482_1378123043007226_3098661652734508013_n.jpg', 3, 5000, 5),
(6, 'Tutankhamun Chair', 'images (1).jpg', 4, 2500, 1),
(7, 'Ancient Egyptian Chair ', 'Furnitrue.jpg', 15, 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`ID`, `Type`, `Price`) VALUES
(6, 'VIP', 6000),
(7, 'Students', 1000),
(8, 'Monthly', 2000),
(9, 'Researches ', 1000);

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
  `UsersQuestion` varchar(400) NOT NULL,
  `CsAnswer` varchar(400) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `ResponseFilter` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `q&a`
--

INSERT INTO `q&a` (`ID`, `UsersQuestion`, `CsAnswer`, `AdminID`, `ResponseFilter`) VALUES
(1, 'Opening Hours ?', 'Everyday From 9am to 6pm', 1, 1),
(2, 'Is there any transportations inside The pyramids area or even in the GEM ', 'Yes, We\'ll Launch a Transportation platform including all the details about the transportations', 1, 1),
(3, 'What\'s Imentet Future plan ?', 'Our Main & Only Plan we have is to develop all archaeological sites to keep pace with upcoming ages ', 1, 1),
(5, 'How long is the Opening Ceremony? And can we book it ?', 'All the Opening Ceremony\'s Details will be posted soon', 1, 1),
(6, 'How many Gates in the Pyramids area ?', 'Now we have 2 Gates and 4 under construction, to serve all visitors', 1, 1),
(7, 'What is special about the Grand Egyptian Museum?', 'the world\'s largest museum dedicated to a single civilization.', 1, 1),
(8, 'Is the Museum Open for visitors at the moment?', 'it is partially open for you to visit the galleries that are finished.', 1, 1),
(9, 'What the Grand Egyptian Museum will look like ?', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship`
--

CREATE TABLE `sponsorship` (
  `ContractID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContractedWith` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsorship`
--

INSERT INTO `sponsorship` (`ContractID`, `Name`, `ContractedWith`) VALUES
(2, 'Orange', 'MR. Nagiub Swirss'),
(3, 'Vodafone', 'Mohamed AbdAllah'),
(4, '57357', 'Dr. Amr Ezzat Salama'),
(5, 'Pepsi ', 'Ramon Laguarta'),
(6, 'HSBC', 'Todd Wilcox'),
(7, 'Bank Misr', 'Hisham Okasha'),
(8, 'Banque du Caire', 'Tarek Fayed');

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
  `DepartureTime` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`ID`, `Type`, `StationID`, `ArrivalTime`, `StationTo`, `DepartureTime`) VALUES
(4, 'Bus', 2, '15:32:00', 3, '15:34:00'),
(5, 'Bus', 3, '13:33:55', 2, '16:00:00'),
(6, 'Bus', 4, '01:44:26', 2, '17:46:00'),
(7, 'Bus', 2, '01:49:02', 4, '06:52:02'),
(8, 'Bus', 2, '03:02:00', 3, '03:02:00'),
(10, 'Bus', 3, '01:40:00', 4, '13:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT 1,
  `MembershipID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `Age`, `Phone`, `Nationality`, `Email`, `Password`, `RoleID`, `MembershipID`) VALUES
(2, 'Rawan Mohsen', 21, 1038239233, 'Egyptian', 'RawanMohsen@gmail.com', '1234', 1, 7),
(3, 'Mariam Ali', 43, 1129302932, 'Iranian', 'MariamAli@hotmail.com', '12345', 2, NULL),
(11, 'Khaled Ashraf', 22, 1139294723, 'Syrian', 'KhaledAshraf@gmail.com', '1234', 2, 7),
(12, 'Sara Samir', 45, 1203230492, 'Italian', 'SaraSamir@gmail.com', '1234', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `userimages`
--

CREATE TABLE `userimages` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `useritems`
--

CREATE TABLE `useritems` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `GiftShopID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useritems`
--

INSERT INTO `useritems` (`ID`, `UserID`, `GiftShopID`, `Quantity`, `PaymentID`) VALUES
(1, 2, 1, 1, 3),
(2, 2, 4, 2, 4),
(3, 2, 3, 1, 2),
(6, 2, 4, 3, 4);

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
-- Table structure for table `visa`
--

CREATE TABLE `visa` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `VisaNumber` bigint(20) NOT NULL,
  `ExpDate` date NOT NULL,
  `CCV` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa`
--

INSERT INTO `visa` (`ID`, `UserID`, `PaymentID`, `VisaNumber`, `ExpDate`, `CCV`) VALUES
(1, 2, 4, 123512341234121, '2031-03-20', 123);

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
(1, 1, 2, 75, 140),
(3, 1, 1, 50, NULL),
(4, 2, 2, 200, 500),
(5, 3, 2, 250, 400),
(6, 3, 1, 80, NULL),
(7, 4, 1, 20, 0),
(13, 4, 2, 40, 60),
(14, 2, 1, 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitticket`
--

CREATE TABLE `visitticket` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlaceID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitticket`
--

INSERT INTO `visitticket` (`ID`, `UserID`, `PlaceID`, `Date`, `PaymentID`) VALUES
(1, 2, 1, '2023-03-15', 1),
(2, 3, 1, '2023-03-30', 4),
(3, 12, 2, '2023-03-15', 4);

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
  ADD KEY `CareerID` (`CareerID`);

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
  ADD KEY `PlaceID` (`PlaceID`);

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
-- Indexes for table `membership`
--
ALTER TABLE `membership`
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
-- Indexes for table `sponsorship`
--
ALTER TABLE `sponsorship`
  ADD PRIMARY KEY (`ContractID`);

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
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `MembershipID` (`MembershipID`);

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
-- Indexes for table `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PaymentID` (`PaymentID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `adminrole`
--
ALTER TABLE `adminrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entertainmnet`
--
ALTER TABLE `entertainmnet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `entertainmnetcategory`
--
ALTER TABLE `entertainmnetcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entertainmnetticket`
--
ALTER TABLE `entertainmnetticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `eventstatus`
--
ALTER TABLE `eventstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `giftcategory`
--
ALTER TABLE `giftcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `giftshop`
--
ALTER TABLE `giftshop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sponsorship`
--
ALTER TABLE `sponsorship`
  MODIFY `ContractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `StationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userimages`
--
ALTER TABLE `userimages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useritems`
--
ALTER TABLE `useritems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visa`
--
ALTER TABLE `visa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitpricing`
--
ALTER TABLE `visitpricing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `visitticket`
--
ALTER TABLE `visitticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AdminRole`) REFERENCES `adminrole` (`ID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`CareerID`) REFERENCES `careers` (`ID`);

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `place` (`ID`);

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
-- Constraints for table `q&a`
--
ALTER TABLE `q&a`
  ADD CONSTRAINT `q&a_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`ID`);

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
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userrole` (`ID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`MembershipID`) REFERENCES `membership` (`ID`);

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
-- Constraints for table `visa`
--
ALTER TABLE `visa`
  ADD CONSTRAINT `visa_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `visa_ibfk_2` FOREIGN KEY (`PaymentID`) REFERENCES `paymentoptions` (`ID`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
