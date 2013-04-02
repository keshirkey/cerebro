-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 10:27 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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

CREATE TABLE IF NOT EXISTS `author` (
  `authorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`authorID`),
  UNIQUE KEY `name_index` (`firstname`,`lastname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `author`
--


-- --------------------------------------------------------

--
-- Table structure for table `authorship`
--

CREATE TABLE IF NOT EXISTS `authorship` (
  `authorshipID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL,
  `contributorID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`authorshipID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `authorship`
--


-- --------------------------------------------------------

--
-- Table structure for table `collector`
--

CREATE TABLE IF NOT EXISTS `collector` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `permissionID` smallint(6) DEFAULT NULL,
  `collectorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`collectorID`),
  UNIQUE KEY `username_index` (`username`),
  UNIQUE KEY `email_index` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `collector`
--

INSERT INTO `collector` (`firstname`, `lastname`, `username`, `email`, `permissionID`, `collectorID`, `password`) VALUES
('Laurinda', 'Weisse', 'lweisse', 'testing', NULL, 5, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('test', 'test', 'test', 'test', NULL, 21, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

-- --------------------------------------------------------

--
-- Table structure for table `comic`
--

CREATE TABLE IF NOT EXISTS `comic` (
  `seriesID` int(10) unsigned DEFAULT NULL,
  `subtitle` varchar(128) DEFAULT NULL,
  `volume` smallint(6) DEFAULT NULL,
  `number` smallint(6) DEFAULT NULL,
  `limitedseries` varchar(128) DEFAULT NULL,
  `pubmonth` int(5) DEFAULT NULL,
  `pubyear` smallint(4) DEFAULT NULL,
  `familyID` int(10) unsigned DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `comicID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` bigint(11) DEFAULT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `comic`
--

INSERT INTO `comic` (`seriesID`, `subtitle`, `volume`, `number`, `limitedseries`, `pubmonth`, `pubyear`, `familyID`, `publisherID`, `comicID`, `isbn`, `adddate`) VALUES
(4, NULL, 1, 11, NULL, 0, 2013, NULL, 3, 1, 985301166, '2013-03-27 12:01:01'),
(3, NULL, 1, 26, NULL, 0, 2013, 1, 1, 2, 2147483647, '2013-03-27 12:05:08'),
(5, NULL, 1, 26, NULL, 0, 2012, NULL, 2, 3, 1617682148, '2013-03-27 12:09:32'),
(2, NULL, 1, 9, NULL, 0, 2013, 1, 1, 4, 5960607900, '2013-03-27 12:17:19'),
(2, NULL, 1, 5, NULL, 0, 2013, 1, 1, 5, NULL, '2013-03-27 12:19:03'),
(2, NULL, 1, 6, NULL, 0, 2013, 1, 1, 7, NULL, '2013-03-27 12:20:07'),
(1, NULL, 3, 24, NULL, 0, 2013, NULL, 1, 8, NULL, '2013-03-27 12:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `familyname` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `familyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`familyID`),
  UNIQUE KEY `familyname_index` (`familyname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`familyname`, `publisherID`, `familyID`) VALUES
('X-Men', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `image`
--


-- --------------------------------------------------------

--
-- Table structure for table `in_list`
--

CREATE TABLE IF NOT EXISTS `in_list` (
  `in_listID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) DEFAULT NULL,
  `listID` int(11) DEFAULT NULL,
  `collectorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`in_listID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `in_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `listID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(350) DEFAULT NULL,
  `collectorID` int(11) DEFAULT NULL,
  `tagID` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `listdescription` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`listID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `list`
--


-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE IF NOT EXISTS `months` (
  `monthID` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL
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

CREATE TABLE IF NOT EXISTS `owned` (
  `ownedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) DEFAULT NULL,
  `collectorID` int(11) DEFAULT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ownedID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `owned`
--


-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `permissiontype` varchar(128) DEFAULT NULL,
  `permissions` varchar(128) DEFAULT NULL,
  `permissionID` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `permissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publishername` varchar(128) DEFAULT NULL,
  `startyear` int(10) unsigned DEFAULT NULL,
  `endyear` int(10) unsigned DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`publisherID`),
  UNIQUE KEY `publishername` (`publishername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publishername`, `startyear`, `endyear`, `email`, `publisherID`) VALUES
('Marvel Comics', 1939, NULL, NULL, 1),
('Cryptozoic Entertainment', 2010, NULL, NULL, 2),
('Image Comics', 1992, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `reviewID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collectorID` int(11) DEFAULT NULL,
  `comicID` int(11) DEFAULT NULL,
  `stars` smallint(6) DEFAULT NULL,
  `text` varchar(5000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `review`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
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

CREATE TABLE IF NOT EXISTS `series` (
  `seriestitle` varchar(128) DEFAULT NULL,
  `seriesID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publisherID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`seriesID`),
  UNIQUE KEY `seriestitle` (`seriestitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`seriestitle`, `seriesID`, `publisherID`) VALUES
('Daredevil', 1, 1),
('All-New X-Men', 2, 1),
('Wolverine and the X-Men', 3, 1),
('Saga', 4, 3),
('Lookouts', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tagname` varchar(128) DEFAULT NULL,
  `tagID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagtypeID` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `tagged`
--

CREATE TABLE IF NOT EXISTS `tagged` (
  `taggedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comicID` int(11) DEFAULT NULL,
  `collectorID` int(11) DEFAULT NULL,
  `tagID` int(11) DEFAULT NULL,
  PRIMARY KEY (`taggedID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tagged`
--


-- --------------------------------------------------------

--
-- Table structure for table `tagtype`
--

CREATE TABLE IF NOT EXISTS `tagtype` (
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
