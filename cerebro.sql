-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2013 at 04:50 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cerebro`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`authorID`),
  UNIQUE KEY `name_index` (`firstname`,`lastname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=379 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorID`, `firstname`, `lastname`) VALUES
(3, NULL, NULL),
(19, 'Adi', 'Granov'),
(132, 'Al', 'Barrionuevo'),
(334, 'Alex', 'Ross'),
(87, 'Alex', 'Sinclair'),
(145, 'Alvaro', 'Lopez'),
(338, 'Amy', 'Reeder'),
(184, 'Andy', 'Diggle'),
(89, 'Andy', 'Kubert'),
(359, 'Ben', 'Oliver'),
(205, 'Ben', 'Templesmith'),
(90, 'Brad', 'Anderson'),
(329, 'Brian', 'Wood'),
(265, 'Brian K.', 'Vaughan'),
(224, 'Brian K.', 'Vaughn'),
(297, 'Brian Michael', 'Bendis'),
(330, 'Carlos', 'D''Anda'),
(194, 'Charles Paul', 'Wilson III'),
(187, 'Charlie', 'Kirchoff'),
(298, 'Chris', 'Bachalo'),
(325, 'Chris', 'Eliopoulos'),
(214, 'Chris', 'Samnee'),
(159, 'Christopher', 'Sebela'),
(34, 'Clayton', 'Cowles'),
(5, 'Cory', 'Petit'),
(259, 'Dave', 'Stewart'),
(322, 'David', 'Aja'),
(82, 'David', 'Finch'),
(4, 'Dean', 'White'),
(96, 'Dexter', 'Soy'),
(103, 'Dexter', 'Vines'),
(6, 'Dustin', 'Weaver'),
(100, 'Ed', 'McGuinness'),
(134, 'Emma', 'Rios'),
(169, 'Filipe', 'Andrade'),
(225, 'Fiona', 'Staples'),
(228, 'Fonografiks', NULL),
(269, 'Fonographiks', NULL),
(38, 'Frank', 'D''Armata'),
(17, 'Frank', 'Martin'),
(85, 'Frank', 'Quietly'),
(264, 'Frank', 'Stockton'),
(332, 'Gabe', 'Eltaeb'),
(39, 'Gabrielle', 'Dell''otto'),
(77, 'Grant', 'Morrison'),
(35, 'Greg', 'Land'),
(70, 'Guillem', 'March'),
(340, 'Guy', 'Major'),
(203, 'Horacio', 'Domingues'),
(80, 'Ian', 'Hannin'),
(68, 'In-Hyuk', 'Lee'),
(337, 'J.H.', 'Williams III'),
(156, 'Jamie', 'McKelvie'),
(73, 'Jared K.', 'Fletcher'),
(104, 'Javier', 'Rodriguez'),
(2, 'Jerome', 'Opena'),
(48, 'Jesus', 'Aburtov'),
(261, 'Jo', 'Chen'),
(99, 'Joe', 'Caramagna'),
(142, 'Joe', 'Quinones'),
(1, 'Jonathan', 'Hickman'),
(136, 'Jordie', 'Bellaire'),
(28, 'Justin', 'Ponsor'),
(123, 'Karl', 'Kesel'),
(192, 'Kelly', 'Yates'),
(30, 'Kelly Sue', 'DeConnick'),
(273, 'Kieron', 'Gillen'),
(185, 'Mark', 'Buckingham'),
(321, 'Matt', 'Fraction'),
(324, 'Matt', 'Hollingsworth'),
(276, 'Matthew', 'Wilson'),
(223, 'Matthew Dow', 'Smith'),
(260, 'Michael', 'Heisler'),
(45, 'Mico', 'Suayan'),
(57, 'Mike', 'McKone'),
(94, 'Mike', 'Mignola'),
(29, 'Morry', 'Hollowell'),
(219, 'Neil', 'Uyetake'),
(54, 'Nic', 'Klein'),
(257, 'Patric', 'Reynolds'),
(256, 'Patton', 'Oswalt'),
(378, 'Pere', 'Perez'),
(50, 'Pete', 'Woods'),
(93, 'Peter', 'Steigerwald'),
(198, 'Phil', 'Elliott'),
(141, 'Rachel', 'Dodson'),
(59, 'Rachelle', 'Rosenberg'),
(33, 'Rain', 'Beredo'),
(121, 'Rich', 'Elson'),
(79, 'Richard', 'Friend'),
(18, 'Richard', 'Isanove'),
(196, 'Richard Piers', 'Rayner'),
(339, 'Rob', 'Hunter'),
(51, 'Scott', 'Hanna'),
(86, 'Scott', 'Kolins'),
(193, 'Sharp', 'Brothers'),
(188, 'Shawn', 'Lee'),
(31, 'Stefano', 'Caselli'),
(138, 'Terry', 'Dodson'),
(204, 'Tim', 'Hamilton'),
(307, 'Tim', 'Townsend'),
(341, 'Todd', 'Klein'),
(72, 'Tomeu', 'Morey'),
(200, 'Tommy Lee', 'Edwards'),
(88, 'Tony', 'Avina'),
(78, 'Tony', 'Daniel'),
(195, 'Tony', 'Lee'),
(69, 'Tony S.', 'Daniel'),
(355, 'Trevor', 'McCarthy'),
(277, 'VC''s Clayton', 'Cowles'),
(301, 'VC''s Joe', 'Caramagna'),
(163, 'Veronica', 'Gandini'),
(353, 'W. Haden', 'Blackman'),
(127, 'Wil', 'Quintana'),
(122, 'Will', 'Quintana');

-- --------------------------------------------------------

--
-- Table structure for table `authorship`
--

CREATE TABLE `authorship` (
  `authorshipID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) unsigned DEFAULT NULL,
  `roleID` int(11) unsigned DEFAULT NULL,
  `authorID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`authorshipID`),
  UNIQUE KEY `constraint_name` (`roleID`,`authorID`,`comicID`),
  KEY `authorID` (`authorID`),
  KEY `comicID` (`comicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=454 ;

--
-- Dumping data for table `authorship`
--

INSERT INTO `authorship` (`authorshipID`, `comicID`, `roleID`, `authorID`) VALUES
(2, 9, 1, 2),
(10, 10, 1, 2),
(21, 11, 1, 2),
(31, 12, 1, 31),
(42, 13, 1, 31),
(51, 14, 1, 50),
(61, 15, 1, 50),
(70, 16, 1, 70),
(78, 17, 1, 78),
(88, 17, 1, 82),
(85, 17, 1, 85),
(86, 17, 1, 86),
(87, 17, 1, 89),
(96, 18, 1, 96),
(106, 19, 1, 96),
(116, 20, 1, 96),
(131, 21, 1, 96),
(162, 24, 1, 96),
(172, 25, 1, 96),
(126, 20, 1, 104),
(127, 20, 1, 121),
(128, 20, 1, 122),
(129, 20, 1, 123),
(140, 21, 1, 132),
(142, 22, 1, 134),
(152, 23, 1, 134),
(290, 38, 1, 156),
(298, 39, 1, 156),
(306, 40, 1, 156),
(181, 26, 1, 169),
(190, 27, 1, 169),
(199, 28, 1, 185),
(211, 29, 1, 196),
(218, 29, 1, 203),
(219, 29, 1, 204),
(222, 30, 1, 204),
(231, 31, 1, 204),
(240, 32, 1, 225),
(248, 33, 1, 225),
(256, 34, 1, 225),
(264, 35, 1, 225),
(282, 37, 1, 225),
(272, 36, 1, 257),
(314, 41, 1, 298),
(322, 42, 1, 298),
(330, 43, 1, 298),
(338, 44, 1, 322),
(346, 45, 1, 330),
(439, 55, 1, 330),
(447, 56, 1, 330),
(401, 51, 1, 337),
(410, 52, 1, 337),
(419, 53, 1, 337),
(428, 54, 1, 337),
(354, 46, 1, 338),
(362, 47, 1, 338),
(372, 48, 1, 355),
(381, 49, 1, 355),
(390, 50, 1, 355),
(436, 54, 1, 355),
(399, 50, 1, 378),
(98, 18, 2, 3),
(108, 19, 2, 3),
(118, 20, 2, 3),
(164, 24, 2, 3),
(242, 32, 2, 3),
(250, 33, 2, 3),
(258, 34, 2, 3),
(266, 35, 2, 3),
(284, 37, 2, 3),
(316, 41, 2, 3),
(324, 42, 2, 3),
(332, 43, 2, 3),
(4, 9, 2, 4),
(12, 10, 2, 4),
(23, 11, 2, 4),
(17, 9, 2, 17),
(18, 9, 2, 18),
(28, 11, 2, 28),
(29, 11, 2, 29),
(33, 12, 2, 33),
(44, 13, 2, 33),
(53, 14, 2, 33),
(63, 15, 2, 33),
(72, 16, 2, 72),
(80, 17, 2, 80),
(89, 17, 2, 87),
(90, 17, 2, 88),
(91, 17, 2, 90),
(92, 17, 2, 93),
(133, 21, 2, 127),
(144, 22, 2, 136),
(154, 23, 2, 136),
(183, 26, 2, 136),
(192, 27, 2, 136),
(174, 25, 2, 163),
(201, 28, 2, 187),
(213, 29, 2, 198),
(224, 30, 2, 198),
(233, 31, 2, 198),
(274, 36, 2, 259),
(403, 51, 2, 259),
(412, 52, 2, 259),
(421, 53, 2, 259),
(430, 54, 2, 259),
(292, 38, 2, 276),
(300, 39, 2, 276),
(308, 40, 2, 276),
(340, 44, 2, 324),
(348, 45, 2, 332),
(441, 55, 2, 332),
(449, 56, 2, 332),
(356, 46, 2, 340),
(364, 47, 2, 340),
(374, 48, 2, 340),
(383, 49, 2, 340),
(392, 50, 2, 340),
(437, 54, 2, 340),
(74, 16, 3, 3),
(244, 32, 3, 3),
(252, 33, 3, 3),
(260, 34, 3, 3),
(268, 35, 3, 3),
(6, 9, 3, 6),
(14, 10, 3, 6),
(25, 11, 3, 6),
(19, 9, 3, 19),
(35, 12, 3, 35),
(38, 12, 3, 38),
(40, 12, 3, 39),
(46, 13, 3, 45),
(49, 13, 3, 48),
(55, 14, 3, 54),
(65, 15, 3, 54),
(58, 14, 3, 57),
(59, 14, 3, 59),
(68, 15, 3, 68),
(82, 17, 3, 82),
(94, 17, 3, 94),
(176, 25, 3, 96),
(100, 18, 3, 100),
(110, 19, 3, 100),
(120, 20, 3, 100),
(135, 21, 3, 100),
(103, 18, 3, 103),
(113, 19, 3, 103),
(124, 20, 3, 103),
(138, 21, 3, 103),
(104, 18, 3, 104),
(114, 19, 3, 104),
(125, 20, 3, 104),
(139, 21, 3, 104),
(169, 24, 3, 136),
(188, 26, 3, 136),
(146, 22, 3, 138),
(156, 23, 3, 138),
(149, 21, 3, 141),
(159, 23, 3, 141),
(150, 21, 3, 142),
(194, 27, 3, 142),
(166, 24, 3, 156),
(185, 26, 3, 156),
(294, 38, 3, 156),
(302, 39, 3, 156),
(310, 40, 3, 156),
(203, 28, 3, 185),
(206, 28, 3, 187),
(207, 28, 3, 192),
(208, 28, 3, 193),
(209, 28, 3, 194),
(215, 29, 3, 200),
(226, 30, 3, 200),
(235, 31, 3, 200),
(220, 29, 3, 205),
(229, 30, 3, 214),
(238, 31, 3, 223),
(286, 37, 3, 225),
(276, 36, 3, 261),
(279, 36, 3, 264),
(318, 41, 3, 298),
(326, 42, 3, 298),
(334, 43, 3, 298),
(342, 44, 3, 322),
(350, 45, 3, 334),
(443, 55, 3, 334),
(451, 56, 3, 334),
(385, 49, 3, 337),
(394, 50, 3, 337),
(405, 51, 3, 337),
(414, 52, 3, 337),
(423, 53, 3, 337),
(432, 54, 3, 337),
(358, 46, 3, 338),
(366, 47, 3, 338),
(376, 48, 3, 359),
(8, 9, 4, 3),
(16, 10, 4, 3),
(27, 11, 4, 3),
(37, 12, 4, 3),
(48, 13, 4, 3),
(57, 14, 4, 3),
(67, 15, 4, 3),
(76, 16, 4, 3),
(84, 17, 4, 3),
(102, 18, 4, 3),
(112, 19, 4, 3),
(122, 20, 4, 3),
(137, 21, 4, 3),
(148, 22, 4, 3),
(158, 23, 4, 3),
(168, 24, 4, 3),
(178, 25, 4, 3),
(187, 26, 4, 3),
(196, 27, 4, 3),
(217, 29, 4, 3),
(246, 32, 4, 3),
(254, 33, 4, 3),
(262, 34, 4, 3),
(270, 35, 4, 3),
(278, 36, 4, 3),
(288, 37, 4, 3),
(320, 41, 4, 3),
(328, 42, 4, 3),
(336, 43, 4, 3),
(344, 44, 4, 3),
(352, 45, 4, 3),
(360, 46, 4, 3),
(368, 47, 4, 3),
(378, 48, 4, 3),
(387, 49, 4, 3),
(396, 50, 4, 3),
(407, 51, 4, 3),
(416, 52, 4, 3),
(425, 53, 4, 3),
(434, 54, 4, 3),
(445, 55, 4, 3),
(453, 56, 4, 3),
(205, 28, 4, 187),
(237, 31, 4, 187),
(228, 30, 4, 198),
(296, 38, 4, 276),
(304, 39, 4, 276),
(312, 40, 4, 276),
(7, 9, 5, 3),
(15, 10, 5, 3),
(26, 11, 5, 3),
(36, 12, 5, 3),
(47, 13, 5, 3),
(56, 14, 5, 3),
(66, 15, 5, 3),
(75, 16, 5, 3),
(83, 17, 5, 3),
(101, 18, 5, 3),
(111, 19, 5, 3),
(121, 20, 5, 3),
(136, 21, 5, 3),
(147, 22, 5, 3),
(157, 23, 5, 3),
(167, 24, 5, 3),
(177, 25, 5, 3),
(186, 26, 5, 3),
(195, 27, 5, 3),
(204, 28, 5, 3),
(216, 29, 5, 3),
(227, 30, 5, 3),
(236, 31, 5, 3),
(245, 32, 5, 3),
(253, 33, 5, 3),
(261, 34, 5, 3),
(269, 35, 5, 3),
(277, 36, 5, 3),
(287, 37, 5, 3),
(295, 38, 5, 3),
(303, 39, 5, 3),
(311, 40, 5, 3),
(319, 41, 5, 3),
(343, 44, 5, 3),
(351, 45, 5, 3),
(359, 46, 5, 3),
(367, 47, 5, 3),
(377, 48, 5, 3),
(386, 49, 5, 3),
(395, 50, 5, 3),
(406, 51, 5, 3),
(415, 52, 5, 3),
(424, 53, 5, 3),
(433, 54, 5, 3),
(444, 55, 5, 3),
(452, 56, 5, 3),
(327, 42, 5, 307),
(335, 43, 5, 307),
(11, 10, 6, 2),
(3, 9, 6, 3),
(22, 11, 6, 3),
(71, 16, 6, 3),
(97, 18, 6, 3),
(107, 19, 6, 3),
(117, 20, 6, 3),
(132, 21, 6, 3),
(143, 22, 6, 3),
(163, 24, 6, 3),
(173, 25, 6, 3),
(182, 26, 6, 3),
(191, 27, 6, 3),
(200, 28, 6, 3),
(212, 29, 6, 3),
(223, 30, 6, 3),
(232, 31, 6, 3),
(241, 32, 6, 3),
(249, 33, 6, 3),
(257, 34, 6, 3),
(265, 35, 6, 3),
(273, 36, 6, 3),
(283, 37, 6, 3),
(291, 38, 6, 3),
(299, 39, 6, 3),
(307, 40, 6, 3),
(315, 41, 6, 3),
(339, 44, 6, 3),
(347, 45, 6, 3),
(373, 48, 6, 3),
(382, 49, 6, 3),
(391, 50, 6, 3),
(402, 51, 6, 3),
(411, 52, 6, 3),
(420, 53, 6, 3),
(429, 54, 6, 3),
(440, 55, 6, 3),
(448, 56, 6, 3),
(32, 12, 6, 31),
(43, 13, 6, 31),
(52, 14, 6, 51),
(62, 15, 6, 51),
(79, 17, 6, 79),
(160, 23, 6, 134),
(153, 23, 6, 145),
(323, 42, 6, 307),
(331, 43, 6, 307),
(355, 46, 6, 339),
(363, 47, 6, 339),
(5, 9, 7, 5),
(13, 10, 7, 5),
(24, 11, 7, 5),
(34, 12, 7, 34),
(45, 13, 7, 34),
(54, 14, 7, 34),
(64, 15, 7, 34),
(73, 16, 7, 73),
(81, 17, 7, 73),
(99, 18, 7, 99),
(109, 19, 7, 99),
(119, 20, 7, 99),
(134, 21, 7, 99),
(145, 22, 7, 99),
(155, 23, 7, 99),
(165, 24, 7, 99),
(175, 25, 7, 99),
(184, 26, 7, 99),
(193, 27, 7, 99),
(202, 28, 7, 188),
(214, 29, 7, 188),
(225, 30, 7, 188),
(234, 31, 7, 219),
(243, 32, 7, 228),
(251, 33, 7, 228),
(259, 34, 7, 228),
(267, 35, 7, 228),
(275, 36, 7, 260),
(349, 45, 7, 260),
(442, 55, 7, 260),
(450, 56, 7, 260),
(285, 37, 7, 269),
(293, 38, 7, 277),
(301, 39, 7, 277),
(309, 40, 7, 277),
(317, 41, 7, 301),
(325, 42, 7, 301),
(333, 43, 7, 301),
(341, 44, 7, 325),
(357, 46, 7, 341),
(365, 47, 7, 341),
(375, 48, 7, 341),
(384, 49, 7, 341),
(393, 50, 7, 341),
(404, 51, 7, 341),
(413, 52, 7, 341),
(422, 53, 7, 341),
(431, 54, 7, 341),
(1, 9, 8, 1),
(9, 10, 8, 1),
(20, 11, 8, 1),
(30, 12, 8, 30),
(41, 13, 8, 30),
(50, 14, 8, 30),
(60, 15, 8, 30),
(95, 18, 8, 30),
(105, 19, 8, 30),
(115, 20, 8, 30),
(130, 21, 8, 30),
(141, 22, 8, 30),
(151, 23, 8, 30),
(161, 24, 8, 30),
(171, 25, 8, 30),
(180, 26, 8, 30),
(189, 27, 8, 30),
(69, 16, 8, 69),
(77, 17, 8, 77),
(170, 24, 8, 159),
(179, 25, 8, 159),
(197, 27, 8, 159),
(198, 28, 8, 184),
(210, 29, 8, 195),
(221, 30, 8, 195),
(230, 31, 8, 195),
(239, 32, 8, 224),
(247, 33, 8, 224),
(255, 34, 8, 224),
(263, 35, 8, 224),
(271, 36, 8, 256),
(281, 37, 8, 265),
(289, 38, 8, 273),
(297, 39, 8, 273),
(305, 40, 8, 273),
(313, 41, 8, 297),
(321, 42, 8, 297),
(329, 43, 8, 297),
(337, 44, 8, 321),
(345, 45, 8, 329),
(438, 55, 8, 329),
(446, 56, 8, 329),
(353, 46, 8, 337),
(361, 47, 8, 337),
(371, 48, 8, 337),
(380, 49, 8, 337),
(389, 50, 8, 337),
(400, 51, 8, 337),
(409, 52, 8, 337),
(418, 53, 8, 337),
(427, 54, 8, 337),
(370, 46, 8, 353),
(369, 47, 8, 353),
(379, 48, 8, 353),
(388, 49, 8, 353),
(397, 50, 8, 353),
(408, 51, 8, 353),
(417, 52, 8, 353),
(426, 53, 8, 353),
(435, 54, 8, 353);

-- --------------------------------------------------------

--
-- Table structure for table `collector`
--

CREATE TABLE `collector` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `permissionID` smallint(6) unsigned DEFAULT NULL,
  `collectorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`collectorID`),
  UNIQUE KEY `username_index` (`username`),
  UNIQUE KEY `email_index` (`email`),
  KEY `permissionID` (`permissionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `collector`
--

INSERT INTO `collector` (`firstname`, `lastname`, `username`, `email`, `permissionID`, `collectorID`, `password`) VALUES
('Laurinda', 'Weisse', 'lweisse', 'testing', NULL, 5, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('test', 'test', 'test', 'test', NULL, 22, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('blah', 'blah', 'blah', 'blah', NULL, 23, '5bf1fd927dfb8679496a2e6cf00cbe50c1c87145'),
('llw', 'llw', 'llw', 'llw', NULL, 24, '29b50a9a7dca2f2683410214fc14e604178fb765'),
('Caitlin', 'Geier', 'lonecayt', 'geier.ac@gmail.com', NULL, 25, '64875fcccaac069fcb3e0e201e7d5b9166641608'),
('Kristen', 'Shirkey', 'keshirkey', 'keshirkey@gmail.com', NULL, 26, '2dc28987ec7bef100c36bb0c0bd904586da6470a');

-- --------------------------------------------------------

--
-- Table structure for table `comic`
--

CREATE TABLE `comic` (
  `seriesID` int(10) unsigned DEFAULT NULL,
  `subtitle` varchar(128) DEFAULT NULL,
  `volume` smallint(6) DEFAULT NULL,
  `number` smallint(6) DEFAULT NULL,
  `limitedseries` varchar(128) DEFAULT NULL,
  `pubyear` smallint(4) DEFAULT NULL,
  `familyID` int(10) unsigned DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `comicID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` bigint(11) DEFAULT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monthid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`comicID`),
  UNIQUE KEY `constraint_comic` (`seriesID`,`volume`,`number`),
  KEY `publisherID` (`publisherID`),
  KEY `seriesID` (`seriesID`,`familyID`,`publisherID`),
  KEY `monthid` (`monthid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `comic`
--

INSERT INTO `comic` (`seriesID`, `subtitle`, `volume`, `number`, `limitedseries`, `pubyear`, `familyID`, `publisherID`, `comicID`, `isbn`, `adddate`, `monthid`) VALUES
(4, NULL, 1, 11, NULL, 2013, NULL, 3, 1, 985301166, '2013-03-27 16:01:01', NULL),
(3, NULL, 1, 26, NULL, 2013, 1, 1, 2, 2147483647, '2013-03-27 16:05:08', NULL),
(5, NULL, 1, 2, NULL, 2012, NULL, 2, 3, 1617682148, '2013-04-13 17:33:15', NULL),
(2, NULL, 1, 9, NULL, 2013, 1, 1, 4, 5960607900, '2013-03-27 16:17:19', NULL),
(2, NULL, 1, 5, NULL, 2013, 1, 1, 5, NULL, '2013-03-27 16:19:03', NULL),
(2, NULL, 1, 6, NULL, 2013, 1, 1, 7, NULL, '2013-03-27 16:20:07', NULL),
(1, NULL, 3, 24, NULL, 2013, NULL, 1, 8, NULL, '2013-03-27 16:21:57', NULL),
(6, 'The Garden', 5, 3, 'No', 2013, 2, 1, 9, 0, '2013-04-08 02:00:29', 3),
(6, 'Avengers World', 5, 1, 'No', 2013, 2, 1, 10, 0, '2013-04-08 02:02:02', 2),
(6, 'We Were Avengers', 5, 2, 'No', 2013, 2, 1, 11, 0, '2013-04-08 02:10:56', 2),
(9, NULL, 2, 10, 'No', 2013, 2, 1, 12, 0, '2013-04-08 02:19:47', 2),
(9, NULL, 2, 11, 'No', 2013, 2, 1, 13, 0, '2013-04-08 02:25:46', 3),
(9, NULL, 2, 12, 'No', 2013, 2, 1, 14, 0, '2013-04-08 02:33:03', 4),
(9, NULL, 2, 13, 'No', 2013, 2, 1, 15, 0, '2013-04-08 02:38:12', 5),
(13, 'Riddle Me This, Part One: Black Magic Tricks', 1, 698, 'No', 2010, 9, 11, 16, 0, '2013-04-08 02:55:48', 6),
(13, 'Time and the Batman', 1, 700, 'No', 2010, 9, 11, 17, 0, '2013-04-08 03:00:52', 8),
(15, NULL, 7, 1, 'No', 2012, 11, 1, 18, 0, '2013-04-08 03:31:43', 9),
(15, NULL, 7, 2, 'No', 2012, 11, 1, 19, 0, '2013-04-08 03:46:29', 10),
(15, NULL, 7, 3, 'No', 2012, 11, 1, 20, 0, '2013-04-08 03:47:15', 10),
(15, NULL, 7, 4, 'No', 2012, 11, 1, 21, 0, '2013-04-08 03:51:31', 11),
(15, NULL, 7, 5, 'No', 2012, 11, 1, 22, 0, '2013-04-08 03:55:09', 12),
(15, NULL, 7, 6, 'No', 2012, 11, 1, 23, 0, '2013-04-08 03:58:16', 12),
(15, NULL, 7, 7, 'No', 2013, 11, 1, 24, 0, '2013-04-08 04:01:47', 1),
(15, NULL, 7, 8, 'No', 2013, 11, 1, 25, 0, '2013-04-08 04:05:44', 2),
(15, NULL, 7, 9, 'No', 2013, 11, 1, 26, 0, '2013-04-08 04:07:33', 3),
(15, NULL, 7, 10, 'No', 2013, 11, 1, 27, 0, '2013-04-08 04:09:39', 4),
(25, 'Hypothetical Gentleman, Part 1', 3, 1, 'No', 2012, 11, 23, 28, 0, '2013-04-08 04:17:57', 9),
(25, 'Ripper''s Curse, Part 1', 2, 2, 'No', 2011, 11, 23, 29, 0, '2013-04-08 04:23:59', 2),
(25, 'Ripper''s Curse, Part 2', 2, 3, 'No', 2011, 11, 23, 30, 0, '2013-04-08 04:27:00', 3),
(25, 'Ripper''s Curse, Part 3', 2, 4, 'No', 2011, 11, 23, 31, 0, '2013-04-08 04:29:34', 4),
(4, NULL, 1, 7, 'Yes', 2012, 11, 3, 32, 0, '2013-04-08 04:34:59', 11),
(4, NULL, 1, 8, 'Yes', 2012, 11, 3, 33, 0, '2013-04-08 04:36:03', 12),
(4, NULL, 1, 9, 'Yes', 2013, 11, 3, 34, 0, '2013-04-08 04:37:01', 1),
(4, NULL, 1, 10, 'Yes', 2013, 11, 3, 35, 0, '2013-04-08 04:38:18', 2),
(33, 'Float Out', 1, 1, 'Yes', 2010, 11, 31, 36, 0, '2013-04-08 04:44:21', 6),
(4, NULL, 1, 12, 'No', 2013, 11, 3, 37, 0, '2013-04-13 15:19:06', 4),
(35, NULL, 2, 3, 'No', 2013, 2, 1, 38, 0, '2013-04-13 15:24:34', 5),
(35, NULL, 2, 1, 'No', 2013, 2, 1, 39, 0, '2013-04-13 15:32:38', 3),
(35, NULL, 2, 2, 'No', 2013, 2, 1, 40, 0, '2013-04-13 15:33:51', 4),
(38, 'The New Revolution', 3, 1, 'No', 2013, 1, 1, 41, 0, '2013-04-13 15:37:39', 4),
(38, 'Poink is the New Bamf', 3, 2, 'No', 2013, 1, 1, 42, 0, '2013-04-13 15:51:38', 4),
(38, NULL, 3, 4, 'No', 2013, 1, 1, 43, 0, '2013-04-13 15:54:42', 6),
(41, NULL, 4, 9, 'No', 2013, 11, 1, 44, 0, '2013-04-13 16:04:52', 6),
(42, 'In the Shadow of Yavin Part 4', 1, 4, 'No', 2013, 11, 31, 45, 0, '2013-04-20 05:25:36', 4),
(43, 'To Drown the World Part Two', 2, 7, 'No', 2012, 39, 11, 46, 0, '2013-04-20 05:32:10', 5),
(43, 'To Drown the World Part Three', 2, 8, 'No', 2012, 39, 11, 47, 0, '2013-04-20 05:35:51', 6),
(43, 'To Drown the World Part Four', 2, 9, 'No', 2012, 39, 11, 48, 0, '2013-04-20 05:42:42', 7),
(43, 'To Drown the World Part Five', 2, 10, 'No', 2012, 39, 11, 49, 0, '2013-04-20 05:45:39', 8),
(43, 'To Drown the World Part Six', 2, 11, 'No', 2012, 39, 11, 50, 0, '2013-04-20 05:53:47', 9),
(43, 'World''s Finest I: Blood Tides', 2, 12, 'No', 2012, 39, 11, 51, 0, '2013-04-20 06:01:26', 10),
(43, 'World''s Finest II: Stygian Descent', 2, 13, 'No', 2012, 39, 11, 52, 0, '2013-04-20 06:03:43', 12),
(43, 'World''s Finest III: Heart of Stone', 2, 14, 'No', 2013, 39, 11, 53, 0, '2013-04-20 06:06:14', 1),
(43, 'Interlude II', 2, 15, 'No', 2013, 39, 11, 54, 0, '2013-04-20 06:09:11', 2),
(42, 'In the Shadow of Yavin Part 3', 1, 3, 'No', 2013, 48, 31, 55, 0, '2013-04-20 06:18:33', 3),
(42, 'In the Shadow of Yavin Part 2', 1, 2, 'No', 2013, 48, 31, 56, 0, '2013-04-20 06:27:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `familyname` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `familyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`familyID`),
  UNIQUE KEY `familyname_index` (`familyname`),
  KEY `publisherID` (`publisherID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`familyname`, `publisherID`, `familyID`) VALUES
('X-Men', 1, 1),
('Avengers', 1, 2),
('Batman', 11, 9),
(NULL, 1, 11),
('Bat-family', 11, 39),
(NULL, 31, 48);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `imageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(10) unsigned DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`imageID`),
  KEY `comicID` (`comicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageID`, `comicID`, `image`) VALUES
(1, 8, 'static/images/Daredevil_Vol_3_24.jpg'),
(2, 7, 'static/images/All-New_X-Men_Vol_1_6.jpg'),
(3, 4, 'static/images/All-New_X-Men_Vol_1_9.jpg'),
(4, 5, 'static/images/All-New_X-Men_Vol_1_5.jpg'),
(5, 2, 'static/images/Wolverine_and_the_X-Men_Vol_1_26.jpg'),
(6, 32, 'static/images/Saga07.jpg'),
(7, 33, 'static/images/Saga08.jpg'),
(8, 3, 'static/images/lookouts02.jpg'),
(9, 10, 'static/images/Avengers_Vol_5_1_(new).jpg'),
(10, 11, 'static/images/Avengers_Vol_5_2.jpg'),
(11, 9, 'static/images/Avengers_Vol_5_3.jpg'),
(12, 12, 'static/images/Avengers_Assemble_Vol_2_10.jpg'),
(13, 13, 'static/images/Avengers_Assemble_Vol_2_11.jpg'),
(14, 14, 'static/images/Avengers_Assemble_Vol_2_12.jpg'),
(15, 15, 'static/images/Avengers_Assemble_Vol_2_13.jpg'),
(16, 18, 'static/images/Captain_Marvel_Vol_7_1.jpg'),
(17, 19, 'static/images/Captain_Marvel_Vol_7_2.jpg'),
(18, 20, 'static/images/Captain_Marvel_Vol_7_3.jpg'),
(19, 21, 'static/images/Captain_Marvel_Vol_7_4.jpg'),
(20, 22, 'static/images/Captain_Marvel_Vol_7_5.jpg'),
(21, 23, 'static/images/Captain_Marvel_Vol_7_6.jpg'),
(22, 24, 'static/images/Captain_Marvel_Vol_7_7.jpg'),
(23, 25, 'static/images/Captain_Marvel_Vol_7_8.jpg'),
(24, 26, 'static/images/Captain_Marvel_Vol_7_9.jpg'),
(25, 27, 'static/images/Captain_Marvel_Vol_7_10.jpg'),
(26, 39, 'static/images/Young_Avengers_Vol_2_1.jpg'),
(27, 40, 'static/images/Young_Avengers_Vol_2_2.jpg'),
(28, 38, 'static/images/Young_Avengers_Vol_2_3_Textless.jpg'),
(29, 41, 'static/images/Uncanny_X-Men_Vol_3_1.jpg'),
(30, 42, 'static/images/Uncanny_X-Men_Vol_3_2.jpg'),
(31, 43, 'static/images/Uncanny_X-Men_Vol_3_4.jpg'),
(32, 44, 'static/images/Hawkeye_Vol_4_9.jpg'),
(33, 16, 'static/images/Batman_Cover_698.jpg'),
(34, 17, 'static/images/Batman_700.jpg'),
(35, 36, 'static/images/Serenity_Float_Out.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `in_list`
--

CREATE TABLE `in_list` (
  `in_listID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(10) unsigned DEFAULT NULL,
  `listID` int(10) unsigned DEFAULT NULL,
  `collectorID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`in_listID`),
  KEY `comicID` (`comicID`,`listID`,`collectorID`),
  KEY `listID` (`listID`,`collectorID`),
  KEY `collectorID` (`collectorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `listID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(350) DEFAULT NULL,
  `collectorID` int(10) unsigned DEFAULT NULL,
  `tagID` int(10) unsigned DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `listdescription` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`listID`),
  KEY `collectorID` (`collectorID`),
  KEY `tagID` (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `monthID` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`monthID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`monthID`, `name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `owned`
--

CREATE TABLE `owned` (
  `ownedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(10) unsigned DEFAULT NULL,
  `collectorID` int(10) unsigned DEFAULT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ownedID`),
  KEY `comicID` (`comicID`),
  KEY `collectorID` (`collectorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `owned`
--

INSERT INTO `owned` (`ownedID`, `comicID`, `collectorID`, `adddate`) VALUES
(2, 1, 24, '2013-04-08 20:35:37'),
(3, 2, 24, '2013-04-08 21:10:33'),
(4, 16, 24, '2013-04-08 21:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissiontype` varchar(128) DEFAULT NULL,
  `permissions` varchar(128) DEFAULT NULL,
  `permissionID` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publishername` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`publisherID`),
  UNIQUE KEY `publishername` (`publishername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publishername`, `email`, `publisherID`) VALUES
('Marvel Comics', NULL, 1),
('Cryptozoic Entertainment', NULL, 2),
('Image Comics', NULL, 3),
('DC Comics', NULL, 11),
('IDW Publishing', NULL, 23),
('Dark Horse Comics', NULL, 31);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collectorID` int(10) unsigned DEFAULT NULL,
  `comicID` int(10) unsigned DEFAULT NULL,
  `stars` smallint(6) DEFAULT NULL,
  `text` varchar(5000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`),
  KEY `collectorID` (`collectorID`),
  KEY `comicID` (`comicID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`roleID`),
  UNIQUE KEY `rolename` (`rolename`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `rolename`) VALUES
(1, 'artist'),
(2, 'colorist'),
(3, 'coverartist'),
(4, 'covercolorist'),
(5, 'coverinker'),
(9, 'editor'),
(6, 'inker'),
(7, 'letterer'),
(8, 'writer');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `seriestitle` varchar(128) DEFAULT NULL,
  `seriesID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publisherID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`seriesID`),
  UNIQUE KEY `seriestitle` (`seriestitle`),
  KEY `publisherID` (`publisherID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`seriestitle`, `seriesID`, `publisherID`) VALUES
('Daredevil', 1, 1),
('All-New X-Men', 2, 1),
('Wolverine and the X-Men', 3, 1),
('Saga', 4, 3),
('Lookouts', 5, 2),
('Avengers', 6, 1),
('Avengers Assemble', 9, 1),
('Batman', 13, 11),
('Captain Marvel', 15, 1),
('Doctor Who', 25, 23),
('Serenity', 33, 31),
('Young Avengers', 35, 1),
('Uncanny X-Men', 38, 1),
('Hawkeye', 41, 1),
('Star Wars', 42, 31),
('Batwoman', 43, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagname` varchar(128) DEFAULT NULL,
  `tagID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagtypeID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`tagID`),
  KEY `tagtypeID` (`tagtypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagged`
--

CREATE TABLE `tagged` (
  `taggedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(10) unsigned DEFAULT NULL,
  `collectorID` int(10) unsigned DEFAULT NULL,
  `tagID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`taggedID`),
  KEY `comicID` (`comicID`),
  KEY `collectorID` (`collectorID`),
  KEY `tagID` (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagtype`
--

CREATE TABLE `tagtype` (
  `tagtypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagtype` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`tagtypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tagtype`
--

INSERT INTO `tagtype` (`tagtypeID`, `tagtype`) VALUES
(1, 'comic'),
(2, 'list');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorship`
--
ALTER TABLE `authorship`
  ADD CONSTRAINT `authorship_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `author` (`authorID`),
  ADD CONSTRAINT `authorship_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`),
  ADD CONSTRAINT `authorship_ibfk_3` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`);

--
-- Constraints for table `collector`
--
ALTER TABLE `collector`
  ADD CONSTRAINT `collector_ibfk_1` FOREIGN KEY (`permissionID`) REFERENCES `permissions` (`permissionID`);

--
-- Constraints for table `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `comic_ibfk_1` FOREIGN KEY (`publisherID`) REFERENCES `publisher` (`publisherID`),
  ADD CONSTRAINT `comic_ibfk_2` FOREIGN KEY (`seriesID`) REFERENCES `series` (`seriesID`),
  ADD CONSTRAINT `comic_ibfk_3` FOREIGN KEY (`monthid`) REFERENCES `months` (`monthID`);

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`publisherID`) REFERENCES `publisher` (`publisherID`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`);

--
-- Constraints for table `in_list`
--
ALTER TABLE `in_list`
  ADD CONSTRAINT `in_list_ibfk_1` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`),
  ADD CONSTRAINT `in_list_ibfk_2` FOREIGN KEY (`listID`) REFERENCES `list` (`listID`),
  ADD CONSTRAINT `in_list_ibfk_3` FOREIGN KEY (`collectorID`) REFERENCES `collector` (`collectorID`);

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`collectorID`) REFERENCES `collector` (`collectorID`),
  ADD CONSTRAINT `list_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`);

--
-- Constraints for table `owned`
--
ALTER TABLE `owned`
  ADD CONSTRAINT `owned_ibfk_1` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`),
  ADD CONSTRAINT `owned_ibfk_2` FOREIGN KEY (`collectorID`) REFERENCES `collector` (`collectorID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`collectorID`) REFERENCES `collector` (`collectorID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`);

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`publisherID`) REFERENCES `publisher` (`publisherID`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`tagtypeID`) REFERENCES `tagtype` (`tagtypeID`);

--
-- Constraints for table `tagged`
--
ALTER TABLE `tagged`
  ADD CONSTRAINT `tagged_ibfk_1` FOREIGN KEY (`comicID`) REFERENCES `comic` (`comicID`),
  ADD CONSTRAINT `tagged_ibfk_2` FOREIGN KEY (`collectorID`) REFERENCES `collector` (`collectorID`),
  ADD CONSTRAINT `tagged_ibfk_3` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
