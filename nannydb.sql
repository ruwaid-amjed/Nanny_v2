-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 07:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nannydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutme`
--

CREATE TABLE `aboutme` (
  `aboutmeID` int(11) NOT NULL,
  `driverLicense` tinyint(1) NOT NULL,
  `car` tinyint(1) NOT NULL,
  `kids` tinyint(1) NOT NULL,
  `smoking` tinyint(1) NOT NULL,
  `sittingLocation` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aboutme`
--

INSERT INTO `aboutme` (`aboutmeID`, `driverLicense`, `car`, `kids`, `smoking`, `sittingLocation`, `language`, `education`) VALUES
(5, 1, 0, 0, 1, 'منزل العائله', 'اللغتين', 'بكالوريس'),
(6, 1, 0, 1, 0, ' موقع خاص بك', ' العربيه', 'كليات المجتمع'),
(7, 0, 0, 0, 0, ' موقع خاص بك', ' العربيه', ' بكالوريس'),
(8, 0, 0, 0, 1, ' منزل العائله', ' العربيه', ' بكالوريس'),
(9, 1, 0, 1, 0, ' منزل العائله', 'اللغتين', ' بكالوريس');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressID` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addressLine` text NOT NULL,
  `additionalDirection` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressID`, `city`, `addressLine`, `additionalDirection`) VALUES
(4, 'الزرقاء', 'جبل الاميرة رحمة', ''),
(5, 'عمان', 'طبربور', 'ديوان الخدمة المدنية'),
(6, 'عمان', 'صويفية', 'some place'),
(7, 'الزرقاء', 'حي الرشيد', 'جريبة'),
(8, 'الزرقاء', 'جبل الاميرة رحمة', ''),
(9, 'الزرقاء', 'مخيم الزرقاء', ''),
(10, 'أربد', 'البويضة', ''),
(11, 'أربد', 'الحصن', '');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `time_slot` varchar(10) NOT NULL,
  `saturday` tinyint(4) NOT NULL DEFAULT 0,
  `sunday` tinyint(4) NOT NULL DEFAULT 0,
  `monday` tinyint(4) NOT NULL DEFAULT 0,
  `tuesday` tinyint(4) NOT NULL DEFAULT 0,
  `wednesday` tinyint(4) NOT NULL DEFAULT 0,
  `thursday` tinyint(4) NOT NULL DEFAULT 0,
  `friday` tinyint(4) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `time_slot`, `saturday`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `idUser`) VALUES
(13, 'الصباح', 1, 1, 0, 1, 0, 1, 0, 4),
(14, 'الظهر', 1, 1, 0, 1, 0, 1, 0, 4),
(15, 'المساء', 1, 1, 1, 1, 1, 0, 1, 4),
(16, 'الليل', 1, 1, 1, 0, 1, 0, 1, 4),
(17, 'الصباح', 1, 1, 1, 1, 1, 1, 0, 5),
(18, 'الظهر', 1, 1, 1, 1, 1, 1, 0, 5),
(19, 'المساء', 0, 0, 0, 0, 0, 0, 0, 5),
(20, 'الليل', 0, 0, 0, 0, 0, 0, 0, 5),
(21, 'الصباح', 1, 1, 1, 1, 1, 1, 1, 8),
(22, 'الظهر', 1, 1, 1, 1, 1, 1, 1, 8),
(23, 'المساء', 1, 1, 1, 1, 1, 1, 1, 8),
(24, 'الليل', 0, 0, 0, 0, 0, 0, 0, 8),
(25, 'الصباح', 1, 1, 1, 1, 1, 1, 1, 9),
(26, 'الظهر', 1, 1, 1, 1, 1, 1, 1, 9),
(27, 'المساء', 1, 1, 1, 1, 1, 1, 1, 9),
(28, 'الليل', 0, 0, 0, 0, 0, 0, 0, 9),
(29, 'الصباح', 1, 1, 1, 0, 0, 1, 0, 10),
(30, 'الظهر', 1, 1, 1, 0, 0, 1, 0, 10),
(31, 'المساء', 0, 0, 0, 0, 0, 0, 0, 10),
(32, 'الليل', 0, 0, 0, 0, 0, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--

CREATE TABLE `bio` (
  `bioID` int(11) NOT NULL,
  `bioText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bio`
--

INSERT INTO `bio` (`bioID`, `bioText`) VALUES
(5, 'اسمي رويد، وأنا جليس أطفال محترف مع خبرة سنتين في العناية بالأطفال من مختلف الأعمار. أتقن فنون اللعب التعليمي وتطوير مهارات الأطفال بطرق مبتكرة وآمنة. أؤمن بأن تنمية الطفل تبدأ من بيئة محبة وداعمة، وأسعى دائمًا لخلق جو مرح وتعليمي في الوقت نفسه. حاصل على شهادة SCC ، وأتطلع دائمًا لتعزيز خبرتي من خلال التعلم المستمر والتفاعل مع الأطفال وأولياء أمورهم لتوفير أفضل رعاية ممكنة'),
(6, 'مرحبًا، اسمي سناء وأنا متخصصة في رعاية الأطفال بخبرة تزيد عن 8 سنوات. أتمتع بمهارة عالية في التعامل مع الأطفال بأعمار متفاوتة وأقدم برامج تعليمية وترفيهية تلائم احتياجاتهم وتعزز من نموهم الشخصي والمعرفي. أهتم بصحة وسلامة الأطفال أولاً وأوفر بيئة محفزة وآمنة لهم. أنا مسؤولة ومبدعة في ابتكار طرق تفاعلية تساعد على تنمية قدرات الأطفال الاجتماعية والتعليمية. متحمسة لمساعدة طفلك على التطور والنمو في بيئة داعمة وملهمة.'),
(7, 'مرحباً، أنا رانيا، جليسة أطفال متفانية بخبرة 4 سنوات في توفير الرعاية الأمثل للأطفال من جميع الأعمار. أتميز بقدرتي على إنشاء جدول يومي يحفز الأطفال على التعلم من خلال الألعاب التعليمية والأنشطة الإبداعية. حاصلة على شهادة في التربية الخاصة، ولدي القدرة على التعامل مع الحالات الطارئة بكفاءة وهدوء. أحرص دائماً على توفير بيئة آمنة ومحبة للأطفال، مما يسمح لهم بالنمو والاستكشاف بأمان'),
(8, 'مرحبًا، اسمي صهيب وأنا جليس أطفال بخبرة سنة واحدة. أتمتع بالصبر والمهارة في إدارة بيئات متعددة الأطفال، وأركز على تعزيز التعلم المبكر والتطوير الاجتماعي من خلال أنشطة ممتعة وتعليمية. متخصص في تنمية المهارات الإبداعية والبدنية للأطفال من خلال الرياضة والفنون. أضمن بيئة آمنة ومشجعة تسمح للأطفال بالنمو بثقة واستقلالية. حاصل على شهادات في [الإسعافات الأولية/تنمية الطفل]، وأقدم نهجاً متوازناً لرعاية الأطفال الذي يشمل اللعب والتعلم.'),
(9, 'مرحبًا، أنا أصيل، جليسة أطفال بخبرة سنتين، متخصصة في رعاية الأطفال من الأبتدائية حتى سن المدرسة. معتمدة في CDA والإسعافات الأولية، وأمتلك خلفية تعليمية في تربية الطفل. أستخدم نهجًا حنونًا ومبتكرًا للعناية بالأطفال، مع التركيز على الأنشطة التي تعزز التطور العقلي والجسدي. أؤمن بأهمية بناء علاقة ثقة واحترام مع كل طفل، وأعمل على توفير بيئة داعمة تشجع على الاستقلالية والتعلم من خلال اللعب.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `sitterID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `sitterID`, `userID`, `startDate`, `endDate`, `location`, `totalPrice`, `status`) VALUES
(7, 8, 7, '2024-05-24 22:00:00', '2024-05-25 00:00:00', 'حبل الاميرة رحمة , مسجد الغزالي', 15.00, 'not booked'),
(8, 10, 7, '2024-05-25 02:12:00', '2024-05-25 03:15:00', 'حي الرشيد , جريبة', 6.30, 'canceled'),
(10, 8, 7, '2024-05-26 20:00:00', '2024-05-26 23:00:00', 'حي الرشيد , جريبة', 22.50, 'not booked'),
(11, 9, 7, '2024-05-27 18:43:00', '2024-05-27 23:00:00', 'حي الرشيد , جريبة', 19.27, 'canceled'),
(12, 4, 7, '2024-05-28 17:41:00', '2024-05-28 21:41:00', 'Des Moines, IA 50309', 24.00, 'not booked'),
(13, 4, 7, '2024-05-27 20:39:00', '2024-05-27 23:37:00', 'حي الرشيد , جريبة', 17.80, 'canceled'),
(14, 10, 7, '2024-05-29 20:40:00', '2024-05-29 23:40:00', 'حي الرشيد , جريبة', 18.00, 'not booked');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `certificationID` int(11) NOT NULL,
  `firstAid` tinyint(1) NOT NULL,
  `CDA` tinyint(1) NOT NULL,
  `SCC` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`certificationID`, `firstAid`, `CDA`, `SCC`) VALUES
(5, 1, 0, 1),
(6, 1, 1, 0),
(7, 1, 1, 1),
(8, 1, 0, 1),
(9, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comfortablewith`
--

CREATE TABLE `comfortablewith` (
  `cmWithID` int(11) NOT NULL,
  `pets` tinyint(1) NOT NULL,
  `cook` tinyint(1) NOT NULL,
  `clean` tinyint(1) NOT NULL,
  `homework` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comfortablewith`
--

INSERT INTO `comfortablewith` (`cmWithID`, `pets`, `cook`, `clean`, `homework`) VALUES
(5, 1, 0, 1, 1),
(6, 0, 1, 1, 1),
(7, 1, 1, 0, 1),
(8, 1, 0, 0, 1),
(9, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`) VALUES
(22, 'Ruwaid AMJAD', 'ruwaid.amjad2000@gmail.com', '0795751453', 'I want to support you'),
(23, 'Asil Al-hmoud', 'asil2001@gmail.com', '0791234345', 'can you contact me for some business');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `expID` int(11) NOT NULL,
  `paidYear` varchar(255) NOT NULL,
  `infant` tinyint(1) NOT NULL,
  `toddler` tinyint(1) NOT NULL,
  `preschool` tinyint(1) NOT NULL,
  `elementary` tinyint(1) NOT NULL,
  `middleSchool` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`expID`, `paidYear`, `infant`, `toddler`, `preschool`, `elementary`, `middleSchool`) VALUES
(5, '2', 0, 1, 1, 1, 0),
(6, '8', 1, 1, 1, 0, 0),
(7, '4', 1, 1, 1, 0, 0),
(8, '1', 0, 0, 0, 1, 1),
(9, '2', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `fileID` int(11) NOT NULL,
  `path` text NOT NULL,
  `description` text NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`fileID`, `path`, `description`, `userID`) VALUES
(13, '../uploads/ruwaid.jpg', 'الصورة الشخصية', 4),
(14, '../uploads/identityRuwaid.jpg', 'ملف التعريف', 4),
(15, '../uploads/noCrimnalRuwaid.jpg', 'شهادة عدم المحكومية', 4),
(16, '../uploads/noIllRuwaid.jpg', 'شهادة خلو امراض', 4),
(17, '../uploads/snaa.jpg', 'الصورة الشخصية', 5),
(18, '../uploads/identityRuwaid.jpg', 'ملف التعريف', 5),
(19, '../uploads/noCrimnalRuwaid.jpg', 'شهادة عدم المحكومية', 5),
(20, '../uploads/noIllRuwaid.jpg', 'شهادة خلو امراض', 5),
(21, '../uploads/rania.jpg', 'الصورة الشخصية', 8),
(22, '../uploads/identityRuwaid.jpg', 'ملف التعريف', 8),
(23, '../uploads/noCrimnalRuwaid.jpg', 'شهادة عدم المحكومية', 8),
(24, '../uploads/noIllRuwaid.jpg', 'شهادة خلو امراض', 8),
(25, '../uploads/suhayb.png', 'الصورة الشخصية', 9),
(26, '../uploads/identityRuwaid.jpg', 'ملف التعريف', 9),
(27, '../uploads/noCrimnalRuwaid.jpg', 'شهادة عدم المحكومية', 9),
(28, '../uploads/noIllRuwaid.jpg', 'شهادة خلو امراض', 9),
(29, '../uploads/Asil.jpg', 'الصورة الشخصية', 10),
(30, '../uploads/identityRuwaid.jpg', 'ملف التعريف', 10),
(31, '../uploads/noCrimnalRuwaid.jpg', 'شهادة عدم المحكومية', 10),
(32, '../uploads/noIllRuwaid.jpg', 'شهادة خلو امراض', 10);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `informationID` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `m_number` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `addressID` int(11) NOT NULL,
  `expID` int(11) DEFAULT NULL,
  `jobPrefID` int(11) DEFAULT NULL,
  `priceID` int(11) DEFAULT NULL,
  `bioID` int(11) DEFAULT NULL,
  `aboutmeID` int(11) DEFAULT NULL,
  `skillID` int(11) DEFAULT NULL,
  `cmWithID` int(11) DEFAULT NULL,
  `certificationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`informationID`, `f_name`, `l_name`, `m_number`, `birth_date`, `age`, `gender`, `addressID`, `expID`, `jobPrefID`, `priceID`, `bioID`, `aboutmeID`, `skillID`, `cmWithID`, `certificationID`) VALUES
(4, 'رويد', 'أمجد', '0795751453', '2000-05-27', 23, 'ذكر', 4, 5, 5, 5, 5, 5, 5, 5, 5),
(5, 'سناء', 'عبدالله', '0791234567', '1987-07-17', 36, 'أنثى', 5, 6, 6, 6, 6, 6, 6, 6, 6),
(6, 'أحمد ', 'خليل', '0797645134', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'محمد', 'عامر', '0782453423', NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'رانيا', 'أبو سعدة', '0797654321', '1997-03-19', 27, 'أنثى', 8, 7, 7, 7, 7, 7, 7, 7, 7),
(9, 'صهيب', 'الخياط', '0795674321', '2002-12-05', 21, 'ذكر', 9, 8, 8, 8, 8, 8, 8, 8, 8),
(10, 'أصيل', 'الحمود', '0791236547', '2001-12-02', 22, 'أنثى', 10, 9, 9, 9, 9, 9, 9, 9, 9),
(11, 'حنان', 'الحمود', '0775634132', NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobpreferences`
--

CREATE TABLE `jobpreferences` (
  `jobPreferencesID` int(11) NOT NULL,
  `distance` varchar(255) NOT NULL,
  `numberOfKids` varchar(255) NOT NULL,
  `pet` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobpreferences`
--

INSERT INTO `jobpreferences` (`jobPreferencesID`, `distance`, `numberOfKids`, `pet`) VALUES
(5, '25km', '1 طفل ', 0),
(6, '10km', ' +4 طفل', 0),
(7, '10km', '1 طفل ', 1),
(8, '50km', '3 طفل', 1),
(9, '5km', '1 طفل ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `priceID` int(11) NOT NULL,
  `maxPrice` int(11) NOT NULL,
  `minPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`priceID`, `maxPrice`, `minPrice`) VALUES
(5, 7, 5),
(6, 8, 3),
(7, 10, 5),
(8, 6, 3),
(9, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skillID` int(11) NOT NULL,
  `reading` tinyint(1) NOT NULL,
  `games` tinyint(1) NOT NULL,
  `music` tinyint(1) NOT NULL,
  `draw` tinyint(1) NOT NULL,
  `craft` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skillID`, `reading`, `games`, `music`, `draw`, `craft`) VALUES
(5, 1, 1, 1, 1, 0),
(6, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 0, 0),
(9, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `informationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `role`, `informationID`) VALUES
(4, 'ruwaid.amjad2000@gmail.com', '$2y$10$3qd6LxGdN5obA/VkZkGwSe/Cc9GzbU.ll5JmJZGgNt0faxWfsPJTW', 'مربية', 4),
(5, 'snaa3bd@gmail.com', '$2y$10$w3igr9eDETgEx8jmxzDD8ufGT100NtM0PtlwOzB6a.C/Tm2L/QdEW', 'مربية', 5),
(6, 'ahmadkh@gmail.com', '$2y$10$7tKEchg0rr9sHaKhNrFK9uyyCuwbwAeSndPoDZy391Y8zDE03Kt6C', 'عائلة', 6),
(7, 'mohAmer@gmail.com', '$2y$10$gUWfENz.bx0PlO509ZmXPOsTZueIDQVr.gLr6AApy5WVsAQO38NAK', 'عائلة', 7),
(8, 'rania1997@gmail.com', '$2y$10$TOLVyTMhnYj/tO.a8EUkauOEWbL523sjab9gVxypr3jEeOQHuuaPC', 'مربية', 8),
(9, 'suhayb2002@gmail.com', '$2y$10$S3ErZMlEXCWrS7TeK0QubeuH4Dqo7hyZXv4CNiMrxvqVJHKogYbeO', 'مربية', 9),
(10, 'asil2001@gmail.com', '$2y$10$vZQlJXtMFGXDjapPTwTfr.YiFRxaR8Js0rkTgfEhOgqVXmzoLbs7i', 'مربية', 10),
(11, 'hanan2012@gmail.com', '$2y$10$0agjmOTM7Qi5TfnZBNXrzeu/XBmgqP1PxHxgeT2iRrXaRydCq6vD.', 'عائلة', 11),
(12, 'admin.admin@gmail.com', 'adminadmin', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutme`
--
ALTER TABLE `aboutme`
  ADD PRIMARY KEY (`aboutmeID`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUserForignkey` (`idUser`);

--
-- Indexes for table `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`bioID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `sitterID` (`sitterID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`certificationID`);

--
-- Indexes for table `comfortablewith`
--
ALTER TABLE `comfortablewith`
  ADD PRIMARY KEY (`cmWithID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`expID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `userForeignKey` (`userID`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`informationID`),
  ADD KEY `adressForeignKey` (`addressID`),
  ADD KEY `experianceForeignKey` (`expID`),
  ADD KEY `jobPrefForeignKey` (`jobPrefID`),
  ADD KEY `priceForeignKey` (`priceID`),
  ADD KEY `bioForeignKey` (`bioID`),
  ADD KEY `aboutmeForeignKey` (`aboutmeID`),
  ADD KEY `skillsForeignKey` (`skillID`),
  ADD KEY `cmWithForeignKey` (`cmWithID`),
  ADD KEY `certificationsForeignKey` (`certificationID`);

--
-- Indexes for table `jobpreferences`
--
ALTER TABLE `jobpreferences`
  ADD PRIMARY KEY (`jobPreferencesID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`priceID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skillID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `informationForeignKey` (`informationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutme`
--
ALTER TABLE `aboutme`
  MODIFY `aboutmeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bio`
--
ALTER TABLE `bio`
  MODIFY `bioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `certificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comfortablewith`
--
ALTER TABLE `comfortablewith`
  MODIFY `cmWithID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `expID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `informationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobpreferences`
--
ALTER TABLE `jobpreferences`
  MODIFY `jobPreferencesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `priceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `idUserForignkey` FOREIGN KEY (`idUser`) REFERENCES `users` (`userID`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`sitterID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `userForeignKey` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `aboutmeForeignKey` FOREIGN KEY (`aboutmeID`) REFERENCES `aboutme` (`aboutmeID`),
  ADD CONSTRAINT `adressForeignKey` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressID`),
  ADD CONSTRAINT `bioForeignKey` FOREIGN KEY (`bioID`) REFERENCES `bio` (`bioID`),
  ADD CONSTRAINT `certificationsForeignKey` FOREIGN KEY (`certificationID`) REFERENCES `certifications` (`certificationID`),
  ADD CONSTRAINT `cmWithForeignKey` FOREIGN KEY (`cmWithID`) REFERENCES `comfortablewith` (`cmWithID`),
  ADD CONSTRAINT `experianceForeignKey` FOREIGN KEY (`expID`) REFERENCES `experience` (`expID`),
  ADD CONSTRAINT `jobPrefForeignKey` FOREIGN KEY (`jobPrefID`) REFERENCES `jobpreferences` (`jobPreferencesID`),
  ADD CONSTRAINT `priceForeignKey` FOREIGN KEY (`priceID`) REFERENCES `price` (`priceID`),
  ADD CONSTRAINT `skillsForeignKey` FOREIGN KEY (`skillID`) REFERENCES `skills` (`skillID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `informationForeignKey` FOREIGN KEY (`informationID`) REFERENCES `information` (`informationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
