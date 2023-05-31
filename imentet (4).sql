-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 11:32 AM
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
(1, 'Assem Mohsen', 1152992719, 'Helwan', 'asemmohsen911@gmail.com', '$2y$10$W4Ije1.mvCMbVqO7n5PhHu5.ED7lanwi9T9NtT50rOXPIRbXNluB6', 1, 1, 1),
(5, 'Ruqaya Amr', 1013363970, 'Elsharbia', 'RuqayaAmr@gmail.com', '$2y$10$ddpL2ij8Oo/eVFqO2tvqJesME3AuYKeqmXM/B3eq7b7Cw5H6rzDS2', 1, 3, 1),
(6, 'Farah Khalid', 1066026071, 'Imbaba', 'FarahKhalid@gmail.com', '$2y$10$WP9Nzi2v1N3pz1mU5cZWi.I4ARkaPx9oXlhfpeBAqLQICkaNMK9zO', 1, 3, 1),
(7, 'Amgad Mahmoud', 1090894656, 'Naser City', 'AmgadMahmoud@gmail.com', '$2y$10$D2kyqOdxeMueVoiE48lfrOtLiDI2OIv9wsn/pWNFanrL.E6pOYn3S', 0, 4, 1),
(8, 'Ziad Mahmoud', 1018857409, 'Alexandria', 'ZiadMahmoud@gmail.com', '$2y$10$xIpt4or107A5RDGmPXTaSO6sKwsHBE2DLcwNr/7vhPnLrBotV9qhe', 1, 2, 1),
(17, 'Rawan Ayman', 1013242421, 'ShbinElkom', 'RawanAyman@yahoo.com', '$2y$10$6F3i7G9Og1/kBiM/D2/.cuNtyvIM6l7YFwBjxEXpBrD2JAc1J1xrC', 1, 2, 1);

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
(28, 19, NULL, 3, NULL, 2, '', NULL),
(29, 26, NULL, 3, '2023-05-15', 0, 'Not applicable for the job description.', NULL),
(33, 25, NULL, 1, '2023-05-23', 2, '', NULL);

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
(1, 'GEM Stores', 2),
(2, 'Horse Riding', 1),
(3, 'GEM Tour Guides', 2),
(4, 'Hot Air Balloon ', 1),
(5, 'Skydiving', 1),
(6, 'Pyramids Security Guard', 1),
(7, 'GEM Security Guard ', 2),
(8, 'Pyramids Stores', 1),
(9, 'Pyramids Tour Guides ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `ID` int(11) NOT NULL,
  `Collection` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(2000) NOT NULL,
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
(2, 'Gold Tutankhamun Statue', 'tutankhamun-death-mask-pharaonic-egypt.jpg', 'This golden mask is the most famous of all the artefacts of ancient Egypt, a true icon of the pharaonic civilization. It will be the last artefact to be transported to the new museum.\r\nThe king is portrayed with the nemes, white and blue stripped line hea', 2, 1, 0, 0),
(4, 'Papyrus of Reckoning after Death', 'british-library-Z5glwhD3LH8-unsplash.jpg', 'In one of the great mythic cycles central to Egyptian religion, the goddess Isis took her infant son Horus to the papyrus thickets of the north to conceal him from her brother Seth, who had murdered her husband Osiris and usurped his throne. Horus grew to', 2, 1, 0, 0),
(5, 'Coffin of Ramesses II', 'Collections3.jpeg', 'The coffin of Ramesses II is one of the most-striking royal coffins discovered from ancient Egypt. Though stripped of its original embellishments, this late 18th Dynasty coffin is of the highest quality imported wood and was carefully reprocessed for the ', 2, 1, 0, 0),
(6, 'The Egyptian Queen Nefertiti', 'Nefertiti.jpg', 'Nefertiti was a queen of Egypt and wife of King Akhenaton, who played a prominent role in changing Egypt traditional polytheistic religion to one that was monotheistic worshipping the sun god known as Aton An elegant portrait bust of Nefertiti now in Berl', 2, 5, 0, 0),
(7, 'the Art of Ancient Egypt, Nubia, and the Near East ', 'kingandqueen.jpg', 'Featuring the pair statue of King Menkaura (Mycerinus) and queen; the triad of King Menkaura, the goddess Hathor, and the deified Hare nome; the bust of Prince Ankhhaf; and six “reserve heads,” the collection of Egyptian Old Kingdom masterpieces is the gr', 2, 1, 0, 0),
(8, 'The School of Athens', 'collection-3-6.jpg', 'For centuries technicians and scientists worked alongside but never together: the first focusing on technical problems to find successful solutions, while scientists kept exploring theories far from the real world. Only during the Renaissance science and technique meet halfway. The technique - on the way to be known as technology - starts considering scientific results, while science starts progressing through the use of technical instruments. Future discoveries will be so important that we can still see the benefits today.', 2, 2, 0, 0),
(9, 'Ancient Egyptian pottery', 'Ancient Egyptian pottery.jpg', 'Specialists in ancient Egyptian pottery draw a fundamental distinction between ceramics made of Nile clay and those made of marl clay, based on chemical and mineralogical composition and ceramic properties. Nile clay is the result of eroded material in th', 2, 1, 0, 0),
(10, 'Babylon', 'collections-3-2.jpeg', 'abylon is the name of an ancient city located on the lower Euphrates river in southern Mesopotamia. Babylon functioned as the main cultural and political centre of the Akkadian-speaking region of Babylonia, with its rulers establishing two important empir', 2, 4, 0, 0),
(11, 'Alexandria in Prison', 'collections-2-2.jpeg', 'Saint Catherine, a fourth-century princess of Alexandria, attempted to convince the Roman Emperor Maxentius of the validity of Christianity. In response, he condemned her to twelve days of starvation in prison. Veronese shows her in a dark cell comforted ', 2, 4, 0, 0),
(12, 'Mare and Foal', 'collection-3-3.jpg', 'With intuitive, emotive manipulations of color and an expansive vocabulary of short, quick, loose brushstrokes, Pierre-Auguste Renoir helped pioneer the Impressionist school of painting. Along with his friend Claude Monet, he privileged spontaneity and th', 2, 4, 0, 1),
(13, 'Christ Crucified (Velázquez)', 'collection-4-7.jpg', 'Velázquez followed the accepted iconography in the 17th century. His master, Francisco Pacheco, a big supporter of classicist painting, painted the crucified Christ using the same iconography later adopted by Velázquez: four nails, feet together and suppo', 2, 4, 0, 0),
(15, 'The Tower Of Babel', 'collections-2-6.jpeg', 'The Tower of Babel is a oil paintings by Pieter Bruegel the Elder. They depict the construction of the Tower of Babel, which according to the Book of Genesis in the Bible was a tower built by a unified, mono-lingual humanity as a mark of their achievement', 2, 2, 0, 0),
(16, 'Nefrtari Meets The Goddess Imentet', 'WhatsApp Image 2023-05-16 at 6.17.54 PM.jpeg', 'Imentet was initially an obscure goddess who lacked her own dedicated temples, but she grew in importance as the dynastic age progressed, until she became one of the most important deities of ancient Egypt. Her cult subsequently spread throughout the Roma', 2, 2, 0, 0),
(17, 'ancient book of the dead', 'collections-1-1.png', 'Archaeologists found a perfectly preserved 16-meter-long papyrus with texts from the Book of the Dead in the necropolis of the ancient Egyptian Saqqara, 25 kilometers from Cairo. Such complete texts had not been found for a hundred years, Egypt Independen', 2, 2, 0, 1),
(18, 'Ancient burial chambers for Pharaohs with ', 'collections-1-2.png', 'The Valley of the Kings is a burial ground for pharaohs who ruled Egypt during the 18th, 19th, and 20th dynasties (the New Kingdom of Egypt). Famous kings from this time period include Tutankhamun, Ramses II, Tuthmosis III, and Seti I, as well as Queen Ne', 2, 2, 0, 1),
(19, 'the tomb of Pharaoh Seti I', 'collections-1-3.png', 'Ancient Egyptian women were well known for their interest in beauty and cosmetics.\r\nAn archeological expert told Al Arabiya.net that at the time each woman would have her own box of facial makeup, kohl or eyeliner, hair pins and combs and perfumes.\r\n\r\nDr.', 2, 2, 0, 1),
(20, 'Tutankhamun’s treasures', 'collections-1-4.png', 'King Tutankhamun has been the poster boy for Ancient Egypt. His death mask was sublimely, breathtakingly crafted over 3,300 years ago from 24 pounds of beaten gold, with eyeliner of lapis lazuli and eyes of quartz and obsidian.\r\nIt s probably the most rec', 2, 5, 0, 1),
(21, 'Ancient cuneiform writing script', 'collections-1-5.png', 'An ancient Elamite cuneiform script on a clay brick from about 1140 B.C.', 2, 2, 0, 1),
(22, 'King Sity', 'collections-1-6-1.png', 'The global entertainment industries have had no shortage of inspiration since the dawn of mainstream media. Everything from pop culture to politics has all featured heavily in the creative outputs of the 20th and 21st centuries. It seems, though, that no ', 2, 4, 0, 1),
(24, 'King Ay and Queen Tiye', 'collection-sculpture-1.png ', 'Ay is believed to have been from Akhmim. During his short reign, he built a rock-cut chapel in Akhmim and dedicated it to the local deity Min. He may have been the son of the courtier Yuya and his wife Thuya, making him a brother of Tiye and Anen.This connection is based on the fact that both Yuya and Ay came from Akhmim and held the titles \'God\'s Father\' and \'Master of Horses\'. A strong physical resemblance has been noted between the mummy of Yuya and surviving statuary depictions of Ay. The mummy of Ay has not been located, although fragmentary skeletal remains recovered from his tomb may represent it,so a more thorough comparison with Yuya cannot be made. Therefore, the theory that he was the son of Yuya rests entirely on circumstantial evidence', 2, 5, 0, 0),
(25, 'Triad of Ramesses with Amun & Mut', 'collection-sculpture-2.png', 'The Cat. 767 triad depicts a king embraced by gods Amun-Ra and Mut. It challenges the dating and interpretation of the piece, as it shows features predating Ramesses II. The article questions whether it\'s a repaired Eighteenth Dynasty monument or an original Ramesside production that was accidentally damaged and restored.\r\nThis case study explores statue reuse, re-activation, and monument usurpation in antiquity.', 2, 5, 0, 0),
(26, 'Ramesses II, Ptah and Sekhmet', 'collection-sculpture-4.png', 'King Ramesses II (the Great) was the third and most powerful pharaoh of the Nineteenth Dynasty of the New Kingdom period. This legendary military strategist led several successful campaigns into the Levant and Nubia, and built various cities, temples and vast religious monuments. At Aswan, archaeologists have unearthed statues of King Ramesses II and “other gods” in the Abu Simbel temples. These temples are lit up by sunbeams twice a year in commemoration of King Ramesses II ’s ascension to the throne on 22nd February, and his birthday on 22nd October, when the agricultural harvest season began in ancient Egypt.', 2, 5, 0, 0),
(27, 'Merit-Ptah', 'collection-sculpture-5.png', 'Merit-Ptah first appears in literature in a 1937 book by Kate Campbell Hurd-Mead on female doctors. Campbell Hurd-Mead presents two ancient Egyptian female doctors, an unnamed one dating to the Fifth Dynasty and Merit-Ptah, dating evidently to the New Kingdom as Hurd-Mead states that she is shown in the Valley of the Kings (the burial ground of Egyptian kings from about 1500 BCE to 1080 BCE). The unnamed Old Kingdom female doctor is most likely Peseshet who is known from a tomb of the period. Later authors did not notice that Kate Campbell Hurd-Mead presented two doctors and mixed the data of the two women; Merit-Ptah was thus back-dated to the Old Kingdom.', 2, 5, 0, 0),
(28, 'King Menkaure and his Queen, Kha-merer-nebty II', 'collection-sculpture-6.png', 'In the southwest corner of the structure, the team discovered a magnificent cache of statuary carved in a smooth-grained dark stone called greywacke or schist. There were a number of triad statues—each showing 3 figures; the king, the fundamentally important goddess Hathor, and the personification of a nome (a geographic designation, similar to the modern idea of a region, district, or county). Hathor was worshipped in the pyramid temple complexes along with the supreme sun god Re and the god Horus, who was represented by the living king.', 2, 5, 0, 0),
(33, 'King Tutankhamun', 'collection-sculpture-7.png', 'Tutankhamon or Tutankhamen (1341 BC – c. 1323 BC), also known as Tutankhaten, was the antepenultimate pharaoh of the Eighteenth Dynasty of ancient Egypt. He ascended to the throne around the age of nine and reigned until his death around the age of nineteen. The most significant actions of his reign were reversing the societal changes enacted by his predecessor, Akhenaten, during the Amarna Period: Tutankhamun restored the traditional polytheistic form of ancient Egyptian religion, undoing the religious shift known as Atenism, and moved the royal court away from Akhenaten\'s capital, Amarna. Tutankhamun was one of few kings worshipped as a deity during his lifetime', 2, 5, 0, 0),
(34, 'Ramesses II', 'collection-sculpture-8.png', 'Ramesses II; Ancient Egyptian: Semitic pronunciation:  ( 1303 BC – 1213 BC), commonly known as Ramesses the Great, was an Egyptian pharaoh. He was the third ruler of the Nineteenth Dynasty. Along with Thutmose III of the Eighteenth Dynasty, he is often regarded as the greatest, most celebrated, and most powerful pharaoh of the New Kingdom, which itself was the most powerful period of ancient Egypt.\r\nIn ancient Greek sources, he is called Ozymandias, derived from the first part of his Egyptian-language regnal name: Usermaatre Setepenre. Ramesses was also referred to as the \"Great Ancestor\" by successor pharaohs and the Egyptian people', 2, 5, 0, 0),
(35, 'Throne of Tutankhamun', 'collection-paitning-1.png', 'The golden throne of Tutankhamun is a unique work of art. The luxurious armchair is distinguished by the complexity of its technique and an abundance of details.\r\nIts colors have not faded over three thousand years, which serves as a testament to the high skill of the ancient Egyptian craftsmen.', 2, 4, 0, 0),
(36, 'Relief of Hatshepsut', 'collection-paitning-2.png', 'Builders reused this painted relief block in the foundation of Ramesses IV\'s mortuary temple, subsequently excavated by the Metropolitan Museum. In the relief, western Asian soldiers are shown being trampled under the horses that pull the royal chariot, signaling the foreigners\' defeat in battle by the might of the Egyptian pharaoh. When the piece was excavated, this and another fragment of a battle scene (13.180.22) were dated to the reign of Ramesses II. A recent study of their stylistic and iconographic features, however, has caused scholars to redate them earlier, probably to the reign of Amenhotep II. This redating indicates that by the middle of the Eighteenth Dynasty, monumental battle scenes had become part of the decorative scheme of a temple\'s exterior walls.', 2, 4, 0, 0),
(37, 'Tomb of King Tutankhamun', 'collection-paitning-3.png', 'The tomb of Tutankhamun, also known by its tomb number, KV62, is the burial place of Tutankhamun (reigned c. 1334–1325 BC), a pharaoh of the Eighteenth Dynasty of ancient Egypt, in the Valley of the Kings. The tomb consists of four chambers and an entrance staircase and corridor. It is smaller and less extensively decorated than other Egyptian royal tombs of its time, and it probably originated as a tomb for a non-royal individual that was adapted for Tutankhamun\'s use after his premature death. Like other pharaohs, Tutankhamun was buried with a wide variety of funerary objects and personal possessions, such as coffins, furniture, clothing and jewelry, though in the unusually limited space these goods had to be densely packed. Robbers entered the tomb twice in the years immediately following the burial, but Tutankhamun\'s mummy and most of the burial goods remained intact. The tomb\'s low position', 2, 4, 0, 0),
(38, 'Deir El-Medina Village', 'collection-paitning-4.png', 'Dayr al-Madīnah, is an ancient Egyptian workmen\'s village which was home to the artisans who worked on the tombs in the Valley of the Kings during the 18th to 20th Dynasties of the New Kingdom of Egypt (ca. 1550–1080 BCE) The settlement\'s ancient name was Set maat (\"Place of Truth\"), and the workmen who lived there were called \"Servants in the Place of Truth\".During the Christian era, the temple of Hathor was converted into a Monastery of Saint Isidorus the Martyr (Coptic: ⲡⲧⲟⲡⲟⲥ ⲙ̄ⲫⲁⲅⲓⲟⲥ ⲁⲡⲁ ⲓⲥⲓⲇⲱⲣⲟⲥ ⲡⲙⲁⲣⲧⲉⲣⲟⲥ) from which the Egyptian Arabic name Deir el-Medina (\"Monastery of the City\") is derived', 2, 4, 0, 0),
(39, 'Temple of Hatshepsut', 'collection-paitning-5.png', 'The mortuary temple of Hatshepsut (Egyptian: Ḏsr-ḏsrw meaning \"Holy of Holies\") is a mortuary temple built during the reign of Pharaoh Hatshepsut of the Eighteenth Dynasty of Egypt. Located opposite the city of Luxor, it is considered to be a masterpiece of ancient architecture.Its three massive terraces rise above the desert floor and into the cliffs of Deir el-Bahari. Her tomb, KV20, lies inside the same massif capped by El Qurn, a pyramid for her mortuary complex. At the edge of the desert, 1 km (0.62 mi) east, connected to the complex by a causeway lies the accompanying valley temple. Across the river Nile, the whole structure points towards the monumental Eighth Pylon, Hatshepsut\'s most recognizable addition to the Temple of Karnak and the site from which the procession of the Beautiful Festival of the Valley departed. The temple\'s twin functions are identified by its axes: its main east-west axis served to receive the barque of Amun-Re at the climax of the festival, while its nor', 2, 4, 0, 0),
(40, 'Papyrus of Ani', 'collection-paitning-6.png', 'The Papyrus of Ani is a papyrus manuscript in the form of a scroll with cursive hieroglyphs and color illustrations that was created c. 1250 BCE, during the Nineteenth Dynasty of the New Kingdom of ancient Egypt. Egyptians compiled an individualized book for certain people upon their death, called the Book of Going Forth by Day, more commonly known as the Book of the Dead, typically containing declarations and spells to help the deceased in their afterlife. The Papyrus of Ani is the manuscript compiled for the Theban scribe Ani', 2, 4, 0, 0),
(41, 'Throne of Tutankhamun', 'collection-paitning-1.png', 'The golden throne of Tutankhamun is a unique work of art. The luxurious armchair is distinguished by the complexity of its technique and an abundance of details.\r\nIts colors have not faded over three thousand years, which serves as a testament to the high skill of the ancient Egyptian craftsmen.', 2, 4, 0, 0),
(42, 'Relief of Hatshepsut', 'collection-paitning-2.png', 'Builders reused this painted relief block in the foundation of Ramesses IV\'s mortuary temple, subsequently excavated by the Metropolitan Museum. In the relief, western Asian soldiers are shown being trampled under the horses that pull the royal chariot, signaling the foreigners\' defeat in battle by the might of the Egyptian pharaoh. When the piece was excavated, this and another fragment of a battle scene (13.180.22) were dated to the reign of Ramesses II. A recent study of their stylistic and iconographic features, however, has caused scholars to redate them earlier, probably to the reign of Amenhotep II. This redating indicates that by the middle of the Eighteenth Dynasty, monumental battle scenes had become part of the decorative scheme of a temple\'s exterior walls.', 2, 4, 0, 0),
(43, 'Tomb of King Tutankhamun', 'collection-paitning-3.png', 'The tomb of Tutankhamun, also known by its tomb number, KV62, is the burial place of Tutankhamun (reigned c. 1334–1325 BC), a pharaoh of the Eighteenth Dynasty of ancient Egypt, in the Valley of the Kings. The tomb consists of four chambers and an entrance staircase and corridor. It is smaller and less extensively decorated than other Egyptian royal tombs of its time, and it probably originated as a tomb for a non-royal individual that was adapted for Tutankhamun\'s use after his premature death. Like other pharaohs, Tutankhamun was buried with a wide variety of funerary objects and personal possessions, such as coffins, furniture, clothing and jewelry, though in the unusually limited space these goods had to be densely packed. Robbers entered the tomb twice in the years immediately following the burial, but Tutankhamun\'s mummy and most of the burial goods remained intact. The tomb\'s low position', 2, 4, 0, 0),
(44, 'Deir El-Medina Village', 'collection-paitning-4.png', 'Dayr al-Madīnah, is an ancient Egyptian workmen\'s village which was home to the artisans who worked on the tombs in the Valley of the Kings during the 18th to 20th Dynasties of the New Kingdom of Egypt (ca. 1550–1080 BCE) The settlement\'s ancient name was Set maat (\"Place of Truth\"), and the workmen who lived there were called \"Servants in the Place of Truth\".During the Christian era, the temple of Hathor was converted into a Monastery of Saint Isidorus the Martyr (Coptic: ⲡⲧⲟⲡⲟⲥ ⲙ̄ⲫⲁⲅⲓⲟⲥ ⲁⲡⲁ ⲓⲥⲓⲇⲱⲣⲟⲥ ⲡⲙⲁⲣⲧⲉⲣⲟⲥ) from which the Egyptian Arabic name Deir el-Medina (\"Monastery of the City\") is derived', 2, 4, 0, 0),
(45, 'Temple of Hatshepsut', 'collection-paitning-5.png', 'The mortuary temple of Hatshepsut (Egyptian: Ḏsr-ḏsrw meaning \"Holy of Holies\") is a mortuary temple built during the reign of Pharaoh Hatshepsut of the Eighteenth Dynasty of Egypt. Located opposite the city of Luxor, it is considered to be a masterpiece of ancient architecture.Its three massive terraces rise above the desert floor and into the cliffs of Deir el-Bahari. Her tomb, KV20, lies inside the same massif capped by El Qurn, a pyramid for her mortuary complex. At the edge of the desert, 1 km (0.62 mi) east, connected to the complex by a causeway lies the accompanying valley temple. Across the river Nile, the whole structure points towards the monumental Eighth Pylon, Hatshepsut\'s most recognizable addition to the Temple of Karnak and the site from which the procession of the Beautiful Festival of the Valley departed. The temple\'s twin functions are identified by its axes: its main east-west axis served to receive the barque of Amun-Re at the climax of the festival, while its north-south axis represented the life cycle of the pharaoh from coronation to rebirth', 2, 4, 0, 0),
(46, 'Papyrus of Ani', 'collection-paitning-6.png', 'The Papyrus of Ani is a papyrus manuscript in the form of a scroll with cursive hieroglyphs and color illustrations that was created c. 1250 BCE, during the Nineteenth Dynasty of the New Kingdom of ancient Egypt. Egyptians compiled an individualized book for certain people upon their death, called the Book of Going Forth by Day, more commonly known as the Book of the Dead, typically containing declarations and spells to help the deceased in their afterlife. The Papyrus of Ani is the manuscript compiled for the Theban scribe Ani', 2, 4, 0, 0);

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
(25, NULL, 'Hisham mounir', 'HishamMounir@gmail.com', 1, 2000, 1),
(26, 24, NULL, NULL, 2, 1500, 1),
(28, NULL, 'Julia Darwin', 'JuliaDarwin@gmail.com', 1, 1000, 1),
(29, 25, NULL, NULL, 1, 2500, 1),
(46, 27, NULL, NULL, 1, 1000000, 1),
(48, 28, NULL, NULL, 1, 3000, 1),
(49, NULL, 'shams eldin', 'Shams@yahoo.com', 2, 653, 1),
(50, 26, NULL, NULL, 1, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entertainmnet`
--

CREATE TABLE `entertainmnet` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(1009) NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip',
  `PlaceID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `DateTo` date DEFAULT NULL,
  `Everyday` varchar(50) DEFAULT NULL,
  `EgyptianPrice` int(11) NOT NULL,
  `ForeignPrice` int(11) DEFAULT NULL,
  `CatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entertainmnet`
--

INSERT INTO `entertainmnet` (`ID`, `Name`, `Image`, `Description`, `PlaceID`, `Date`, `DateTo`, `Everyday`, `EgyptianPrice`, `ForeignPrice`, `CatID`) VALUES
(2, 'Maroon 5', 'KH5Yl8ji0anMIxBXXcyT7gNehD4TNvcDQJus7jFciGg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-14', NULL, NULL, 3500, 6000, 1),
(12, 'Career 180', 'Career180.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-03-25', NULL, NULL, 200, 300, 7),
(13, 'Art D’Égypte', 'foreverisnow-evergreen-pic2-1600px.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-11-24', '2023-11-30', NULL, 200, 400, 2),
(20, 'Running Marathon', 'f380ae_909314030dee4b71959e42574be40499_mv2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-12-28', NULL, NULL, 800, 1200, 3),
(21, 'Sound Clash', 'pexels-josh-sorenson-976866.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2024-11-27', NULL, NULL, 600, 1200, 1),
(22, 'Carl Cox', 'pexels-wendy-wei-1190297.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-05-19', NULL, NULL, 2000, 5000, 1),
(23, 'Shakira', 'pexels-annam-w-1047442.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-09-28', NULL, NULL, 2500, 10000, 1),
(24, '47 SOUL', 'pexels-wendy-wei-1190298.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-09-07', NULL, NULL, 500, 1000, 1),
(25, 'Dior', 'Dior.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2022-12-22', NULL, NULL, 3000, 6000, 6),
(26, 'Skydiving Egypt', 'Skydiving.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-15', '0000-00-00', 'Daily', 4500, 6000, 3),
(27, 'Squash ', 'squach.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-06-08', '0000-00-00', '', 350, 650, 3),
(28, 'Mega Marathon ', 'Marathon.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-07-13', NULL, NULL, 1200, 3000, 3),
(29, 'Signs From Egypt', 'signsfromegypt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-05-10', '2023-05-26', '', 200, 400, 2),
(41, 'Horse And Camels', 'Horses.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-04-13', '0000-00-00', 'Daily', 150, 0, 3),
(43, 'Children Museum', 'ChildernMus.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-06-22', '0000-00-00', 'Daily', 60, 0, 10),
(44, 'Hot Air Balloon', 'HotAir.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 1, '2023-09-29', '0000-00-00', 'Daily', 1500, 0, 3),
(50, 'The Exhibits Cover All Time of The Egyptian Civilization', 'collections-3-1.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-08-12', '2023-09-21', '', 150, 0, 9),
(51, 'Hadrian and Athens. Conversing with an Ideal World', 'collections-3-2.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-07-05', '2023-08-15', '', 150, 0, 9),
(52, 'Classicita ed Europa. The common destiny of Greece and Italy', 'collections-3-3.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-01-18', '2024-02-28', '', 200, 0, 9),
(53, 'Amr Diab', 'amrdiab.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-01-31', '0000-00-00', '', 1500, 2500, 1),
(54, 'Golden Parade Memorial Festival', 'GoldenParade.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-04-02', '2024-04-03', '', 300, 0, 2),
(55, 'Arts for Kids', 'event-2-2.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2024-05-15', '0000-00-00', '', 500, 0, 8),
(56, 'Business Hub ', 'Congress.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-07-14', '2023-08-02', '', 200, 0, 7),
(57, 'Opening Ceremony', 'opining.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-11-08', '2023-11-12', '', 2000, 0, 2),
(61, 'RiseUp Summit of the Decade', 'events-2-1.png', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-06-07', '1970-01-01', '', 200, 0, 7),
(62, 'Imentet x BIS: Discusssion', 'events-2-3.png', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-06-26', '1970-01-01', '', 100, 0, 8),
(63, 'A Night with Omar Khairat', 'events-2-4.png', 'Harmony of Heritage: A Night with Omar Khairat is a captivating concert where the legendary Pianist Omar Khairat takes the stage, enchanting the audience with his exquisite melodies and timeless musical heritage.', 2, '2023-05-07', NULL, NULL, 500, 2500, 1),
(64, 'Soprano Fatma & Maestro Nader Abbassi', 'events-2-5.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-04-27', NULL, NULL, 1000, NULL, 1),
(65, 'Art Cairo 4th Edition', 'events-2-6.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', 2, '2023-04-19', '2023-04-23', NULL, 300, NULL, 2),
(67, 'Raphael, The Madonna of the Canopy on display ', 'event-4-6.jpg', 'The great altarpiece, magnificent although unfinished, painted by Raphael at the end of his Florentine period, and part of the Palatine Gallerys collection,  is now on view in the Tuscan town of Pescia, in the church that had housed it for more than 150 y', 2, '2023-05-30', '2023-06-09', '', 500, 1000, 9),
(68, 'Emotions in Antiquity and Ancient Egypt', 'event-4-1.jpg', 'The exhibition contains selected artefacts from the Museum Collection of Classical Antiquities and Egyptian Collection. Each one tells a story related to emotions of the time. But together they reveal feelings that are similar at different times and place', 2, '2021-05-11', '2021-10-12', NULL, 600, NULL, 9),
(70, 'Egypt in Europe: By the eyes of Civilization', 'event-3-6.jpg', 'The Royal Frederik University (today the University of Oslo) opens in 1813, at a time when ancient Egypt is a trend in Europe. Napoleon has rediscovered the rich cultural heritage of the fertile land on the banks of the Nile, prompting an army of scientis', 2, '2024-01-03', '2024-01-16', NULL, 2000, 6000, 9),
(71, 'Sound And Light', 'event-1-2.png', 'Step through a portal to ancient times, with the memorable Pyramids Sound and Light Show. The Sound Light show pyramids will take you on a journey thousands of years back, bringing the Egyptian legacy back to life Thousands of years have passed since the pharaohs walked on earth, leaving behind a mystery on how the great pyramids were built. And, we cannot just skip the enigmatic sphinx, standing prominently as a guard to protect the Great Pyramids.', 1, '2023-05-29', '1970-01-01', 'Daily', 200, 0, 1),
(74, 'Khufu Pyramid', 'pexels-diego-ferrari-13865652.jpg', 'The Great Pyramid of Giza is the largest Egyptian pyramid and the tomb of Fourth Dynasty pharaoh Khufu. Built in the early 26th century BC during a period of around 27 years, the pyramid is the oldest of the Seven Wonders of the Ancient World, and the only one to remain largely intact. It is the most famous monument of the Giza pyramid complex, in the Pyramid Fields of the Memphis and its Necropolis UNESCO World Heritage Site, in Giza, Egypt. It is at the most Northern end of the line of the 3 Pyramids of Giza', 1, '2023-05-31', NULL, 'Daily', 100, 0, 3),
(75, 'Khafre Pyramid', 'gallery-6.png', 'The pyramid of Khafre or of Chephren , romanized: haram ḵafra) is the middle of the three Ancient Egyptian Pyramids of Giza, the second tallest and second largest of the group. It is the tomb of the Fourth-Dynasty pharaoh Khafre (Chefren), who ruled c. 2558−2532 BC', 1, '2023-05-30', '1970-01-01', 'Daily', 30, 0, 3),
(76, 'King Tutankhamun', 'tutankhamun-death-mask-pharaonic-egypt.jpg', 'Tutankhamun has captivated audiences worldwide since British archaeologist Howard Carter discovered his tomb back in 1922. He has become an international icon of our Egyptian civilization.\r\nPainstakingly excavated over the course of almost ten years, the tombs four small rock-cut chambers hidden beneath the sands of the Valley of the Kings yielded over 5,000 incredible objects, bearing witness to the life and death of this king. The discovery of the tomb of Tutankhamun was the most spectacular discovery in the history of archeology.\r\nAlthough a recent CT scan of Tutankhamuns mummy has revealed interesting new information about the techniques in his mummification, and has confirmed that he was around 18 years old when he died, the cause of his death is still uncertain.', 2, '2023-05-31', '1970-01-01', 'Daily', 550, 2700, 10),
(77, 'Restoration Museum', 'career-1-1.png', 'Monument restoration can be accomplished in two primary ways: structurally and chemically. The process of strengthening the foundations so that the buildings can withstand future natural calamities is known as structural restoration. we will take you to a trip to discover our the monuments before and after their restoration process.', 2, '2023-05-31', '1970-01-01', 'Daily', 400, 1100, 10),
(78, 'King Khufu Solar Boat', 'KhufuSolarBoat.jpg', 'The Khufu ship is an intact full-size solar barque from ancient Egypt. It was sealed into a pit at the foot of the Great Pyramid of pharaoh Khufu around 2500 BC, during the Fourth Dynasty of the ancient Egyptian Old Kingdom. Like other buried Ancient Egyptian ships, it was part of the extensive grave goods intended for use in the afterlife. The Khufu ship is one of the oldest, largest and best-preserved vessels from antiquity. It is 43.4 meters (142 ft) long and 5.9 meters (19 ft) wide, and has been identified as the worlds oldest intact ship, and described as a masterpiece of woodcraft that could sail today if put into a lake or a river.\r\nThe ship was preserved in the Giza Solar boat museum, but was relocated to the Grand Egyptian Museum in August 2021.', 2, '2023-05-31', '1970-01-01', 'Daily', 225, 600, 10),
(79, 'Kids Area', 'kidsarea.jpg', 'An specialized area for kids where children can play, designed with the Ancient Egyptian style to provide an environment for children to read and discover more interesting secrets about the Egyptain civilization   ', 2, '2023-05-31', '1970-01-01', 'Daily', 100, 600, 8),
(81, 'Family Weekend', 'familyweeked.jpg', 'A variety of ancient Egyptian-inspired arts and crafts are also offered at the event, alongside live music and entertainment, the museum added.  enjoy a weekend full of discovery and excitement.', 2, '2023-05-26', '2023-05-27', NULL, 200, NULL, 8),
(82, 'Mers Ankh Tomb', 'mersankhtomb.jpg', 'Under the shadow of the Great Pyramid lies the mastaba of Queen Meresankh III, the wife of Khafre and granddaughter of Khufu. Both very large and exquisitely decorated, this is indeed a tomb worthy of her rank and fortunately also contains the best preserved wall reliefs in the Eastern Cemetery.\r\nThese are decorated with a diverse array of scenes, including bread baking, beer brewing, fowling, herding, mat making, metal smelting, and the sculpting of statues.', 1, '2023-05-31', '1970-01-01', 'Daily', 20, 50, 10),
(83, 'Ultimate Package', 'pexels-taha-abbas-11208768.jpg', 'Our Package include a various options to facilitate your trip and make it better as much as we can, our Package contain (Tour around the Pyramids , Horseback Ride & Khufu Pyramid Entry) All in one Package. ', 1, '2023-05-31', '1970-01-01', 'Daily', 500, 1000, 3);

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
(9, 'Exhibitions'),
(10, 'Museums');

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
(12, 55, 25, 1000, 1, 2),
(13, 51, 26, 300, 1, 2),
(14, 52, 27, 400, 1, 2),
(15, 52, 27, 200, 1, 1),
(16, 54, 27, 600, 1, 2),
(17, 20, 25, 800, 1, 1),
(18, 22, 25, 4000, 1, 2),
(19, 23, 28, 12500, 1, 5),
(20, 23, 28, 2500, 1, 1),
(21, 44, 26, 3000, 1, 2),
(23, 76, 2, 6500, 1, 4),
(25, 76, 2, 550, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventgallery`
--

CREATE TABLE `eventgallery` (
  `ID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventgallery`
--

INSERT INTO `eventgallery` (`ID`, `EventID`, `Image`) VALUES
(23, 63, 'events-d-g-1.png'),
(24, 63, 'events-d-g-2.png'),
(25, 63, 'events-d-g-2.png'),
(26, 63, 'events-d-g-1.png'),
(31, 67, 'event-d-g-1.jpg'),
(32, 67, 'event-d-g-2.jpg'),
(33, 67, 'event-d-g-3.jpg'),
(34, 67, 'event-d-g-4.jpg'),
(35, 68, 'event-d-g-1.jpg'),
(36, 68, 'event-d-g-2.jpg'),
(37, 68, 'event-d-g-3.jpg'),
(38, 68, 'event-d-g-4.jpg');

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
(43, 57, 12),
(47, 61, 6),
(48, 62, 12),
(49, 67, 12),
(50, 70, 12),
(51, 68, 12),
(52, 67, 12),
(53, 63, 6),
(54, 65, 5),
(55, 64, 7),
(56, 71, 12),
(59, 74, 12),
(60, 75, 12),
(61, 76, 12),
(62, 77, 12),
(63, 78, 12),
(64, 79, 12),
(65, 82, 12),
(66, 83, 3),
(67, 81, 12);

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
(8, 2, 41, 'Great'),
(13, 25, 22, 'بسم الله ماشاء الله , الله اكبر ايه ده ايه الحلاوة دي'),
(14, 26, 44, 'it was a 30 minutes trip, Incredible');

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
(1, 'Sofa', 'images (2).jpg', 5, 2000, 1),
(3, 'The Winged Sun of Thebes Tissue Box', 'shop-2.png', 10, 1500, 1),
(4, 'Hieroglyphs Notebook', 'shop-5.png', 22, 500, 6),
(6, 'Coffee Table', 'shop-10.png', 8, 2500, 1),
(7, 'Horus Jewelry Box', 'shop-4.png', 8, 6000, 1),
(8, 'Box', 'shop-1-2.jpg', 0, 400, 3),
(9, 'Lizard Sculpture', 'collection-1-2.png', 18, 500, 7),
(10, 'Medal', 'shop-1-4.jpg', 22, 150, 6),
(11, 'Othman Empire Painting ', 'event-d-g-1.jpg', 18, 700, 5),
(12, 'Egypt Travel Poster', 'shop-7.png', 21, 600, 5),
(13, 'Papyrus Painting', 'shop-8.png', 22, 400, 5),
(14, 'Winged Sacred Scarab', 'Unique.jpg', 21, 500, 3),
(15, 'Scarab winged black', 'Scarab.jpg', 34, 500, 7),
(16, 'Scarab Beetele Khepri', 'statue of winged.jpg', 42, 800, 7),
(17, 'Hieroglyphs Hand Fan', 'shop-3.png', 43, 300, 6),
(18, 'Sphinx heavy stone', '81baHk3Y4qL._AC_SX569_.jpg', 36, 800, 7),
(19, 'Isis Trinket Box', 'shop-9.png', 32, 1000, 7),
(20, 'Nefertiti Gold Necklace', 'shop-d-1.png', 70, 900, 3),
(21, 'Scarab Falcon Pyramid Box', 'shop-6.png', 32, 1500, 3),
(22, 'Bastet Cat Bookends', 'shop-12.png', 150, 2800, 1),
(23, 'Hieroglyphs Printed Mug', 'shop-11.png', 100, 800, 3);

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
  `DiscountGiftShop` tinyint(1) DEFAULT NULL,
  `DiscountParking` tinyint(1) DEFAULT NULL,
  `ChildernMuseum` int(2) DEFAULT NULL,
  `VouchersMuseum` int(2) DEFAULT NULL,
  `MembersNewsletter` tinyint(1) DEFAULT NULL,
  `SpecialExhibtions` int(2) DEFAULT NULL,
  `AccessMuseumLib` int(2) DEFAULT NULL,
  `InvatationsToActivites` int(2) DEFAULT NULL,
  `AccessToEvents` int(2) DEFAULT NULL,
  `AccessTutankhamun` int(2) DEFAULT NULL,
  `AccessHologram` int(2) DEFAULT NULL,
  `AccessToMonuments` int(2) DEFAULT NULL,
  `PriorityAccessToEvents` tinyint(1) DEFAULT NULL,
  `StudentsEvents` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`ID`, `Type`, `Price`, `PeriodID`, `Entry`, `DiscountGiftShop`, `DiscountParking`, `ChildernMuseum`, `VouchersMuseum`, `MembersNewsletter`, `SpecialExhibtions`, `AccessMuseumLib`, `InvatationsToActivites`, `AccessToEvents`, `AccessTutankhamun`, `AccessHologram`, `AccessToMonuments`, `PriorityAccessToEvents`, `StudentsEvents`) VALUES
(6, 'Individual', 350, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(8, 'Families', 600, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(12, 'Supporting', 0, 3, 1, 1, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0),
(13, 'Patron', 0, 3, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0),
(16, 'Students', 250, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1),
(17, 'Seniors', 330, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0);

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
(11, 24, 16, 250, 1, '2023-05-13', '2023-06-12'),
(15, 25, 17, 330, 1, '2023-05-14', '2023-06-14'),
(26, 27, 12, 1000000, 1, '2023-05-18', '2024-05-17'),
(27, 28, 17, 330, 1, '2023-05-22', '2023-06-22');

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
(18, 'RawanMohsen@gmail.com', 'What the Grand Egyptian Museum will look like ?', NULL, NULL, 0),
(26, 'DavidGabrial@yahoo.com', 'Test Test', NULL, NULL, 0),
(31, 'HendRostom@hotmail.com', 'Amazing, we finally have what befits our history, Good job Guysss ', NULL, NULL, 0);

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
(1, 14, 24, 'Good Quality'),
(2, 18, 26, 'Me gusto mucho'),
(4, 13, 28, 'Best quality ever');

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
(25, 'Fady', 'Hennah', '2000-06-28', 0, 'Fady@yahoo.com', '$2y$10$LqMpln.ZqPhhs/dPUrxUBexwEgmsEbJM2ATJBd/JXRgDI0o9BdG3u', 1),
(26, 'Karim', 'Gamal', NULL, NULL, 'KarimGamal@yahoo.com', '$2y$10$QdMMsvnNwTMp.wrWBcfGaOperQQpoDM5zf1oS3BGPBQNY6SXDdUSC', NULL),
(27, 'Nadin', 'Faid', '1999-08-19', 1235423682, 'NadinFaid@yahoo.com', '$2y$10$RDkeczAf0KK5Tc2a7vSaN.hKhPrvOwMSk2zRNKGXuSJ4evwvEeocK', 5),
(28, 'Hend', 'Rostom', '1979-07-19', 129382942, 'HendRostom@hotmail.com', '$2y$10$pVSDdzPq/i/Jz9PElWjo3u68LPqEW7rq9/ZzAhpDwz.TNj6NitbKy', 5);

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
(10, 25, 'avatar.png'),
(11, 26, 'avatar.png'),
(12, 27, 'avatar.png'),
(13, 28, 'Hend.jpg');

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
(85, 25, 17, 1, 1, 300),
(86, 26, 18, 1, 1, 800),
(87, 26, 11, 2, 1, 1400),
(88, 2, 18, 1, 1, 800),
(89, 2, 18, 1, 1, 800),
(90, 2, 17, 1, 1, 300),
(91, 2, 11, 2, 1, 1400),
(92, 27, 19, 2, 1, 2000),
(93, 28, 9, 1, 1, 500),
(94, 28, 18, 1, 1, 800),
(95, 28, 13, 2, 1, 800),
(96, 28, 9, 1, 1, 500),
(97, 28, 18, 1, 1, 800),
(98, 28, 13, 1, 1, 400);

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
(2, 'Foreigner Adult'),
(3, 'Foreigner Student'),
(4, 'Egyptian Senior'),
(5, 'Egyptian Adult'),
(7, 'Foreigner Senior');

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
(3, 1, 1, 30, NULL),
(4, 2, 2, 1000, 1000),
(5, 3, 2, 500, 250),
(6, 3, 1, 120, NULL),
(7, 4, 1, 60, 0),
(13, 4, 2, 75, 250),
(14, 2, 1, 240, 0),
(15, 5, 2, 150, 150),
(16, 5, 1, 60, 0),
(17, 7, 2, 500, 700),
(18, 7, 1, 240, 0);

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
(26, 25, 2, '2023-05-13', 1, 10, 1490),
(29, 26, 2, '2023-05-25', 1, 2, 280),
(36, 2, 2, '2023-05-15', 1, 6, 930),
(37, 25, 2, '2023-06-01', 1, 2, 340),
(38, 27, 2, '2023-05-18', 1, 2, 280),
(39, 24, 2, '2023-05-20', 1, 3, 480),
(40, 24, 2, '2023-06-01', 1, 6, 780),
(41, 28, 1, '2023-05-22', 1, 2, 100),
(42, 26, 2, '2023-05-25', 1, 2, 340),
(43, 26, 2, '2023-05-25', 1, 2, 280);

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
-- Dumping data for table `visitticketnotpaid`
--

INSERT INTO `visitticketnotpaid` (`ID`, `UserID`, `UserRoleID`, `Quantity`, `PlaceID`, `Date`, `Total`) VALUES
(347, 2, 5, 0, 2, '2023-05-31', 0),
(348, 2, 4, 0, 2, '2023-05-31', 0),
(349, 2, 1, 0, 2, '2023-05-31', 0),
(350, 2, 2, 0, 2, '2023-05-31', 0),
(351, 2, 3, 0, 2, '2023-05-31', 0),
(352, 2, 7, 0, 2, '2023-05-31', 0),
(353, 2, 5, 0, 2, '2023-05-31', 0),
(354, 2, 4, 0, 2, '2023-05-31', 0),
(355, 2, 1, 0, 2, '2023-05-31', 0),
(356, 2, 2, 0, 2, '2023-05-31', 0),
(357, 2, 3, 0, 2, '2023-05-31', 0),
(358, 2, 7, 0, 2, '2023-05-31', 0);

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
-- Indexes for table `eventgallery`
--
ALTER TABLE `eventgallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventID` (`EventID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `collectionscategories`
--
ALTER TABLE `collectionscategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `entertainmnet`
--
ALTER TABLE `entertainmnet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `entertainmnetcategory`
--
ALTER TABLE `entertainmnetcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `entertainmnetticket`
--
ALTER TABLE `entertainmnetticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `eventgallery`
--
ALTER TABLE `eventgallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `eventstatus`
--
ALTER TABLE `eventstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eventticketcart`
--
ALTER TABLE `eventticketcart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `giftcategory`
--
ALTER TABLE `giftcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `giftshop`
--
ALTER TABLE `giftshop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `itemscart`
--
ALTER TABLE `itemscart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `membershippayemnts`
--
ALTER TABLE `membershippayemnts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shopcomments`
--
ALTER TABLE `shopcomments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `userimages`
--
ALTER TABLE `userimages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `useritems`
--
ALTER TABLE `useritems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitpricing`
--
ALTER TABLE `visitpricing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `visitticket`
--
ALTER TABLE `visitticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `visitticketnotpaid`
--
ALTER TABLE `visitticketnotpaid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

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
-- Constraints for table `eventgallery`
--
ALTER TABLE `eventgallery`
  ADD CONSTRAINT `eventgallery_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `entertainmnet` (`ID`);

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
