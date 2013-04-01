-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2013 at 07:10 PM
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
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `artistID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`artistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`firstname`, `lastname`, `artistID`) VALUES
('Fiona', 'Staples', 1),
('Ramon', 'Perez', 2),
('Robb', 'Mommaerts', 3),
('Stuart', 'Immonen', 4),
('Chris', 'Samnee', 5);

-- --------------------------------------------------------

--
-- Table structure for table `collector`
--

CREATE TABLE IF NOT EXISTS `collector` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `roleID` smallint(6) DEFAULT NULL,
  `collectorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`collectorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `collector`
--

INSERT INTO `collector` (`firstname`, `lastname`, `username`, `email`, `roleID`, `collectorID`, `password`) VALUES
('Laurinda', 'Weisse', 'lweisse', 'testing', NULL, 5, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('L', 'W', 'lweisse', '127.0.0.1', NULL, 7, '961195ebb2eaeeb8a76e92f5e78ab3021a2976ca');

-- --------------------------------------------------------

--
-- Table structure for table `colorist`
--

CREATE TABLE IF NOT EXISTS `colorist` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `coloristID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`coloristID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `colorist`
--

INSERT INTO `colorist` (`firstname`, `lastname`, `coloristID`) VALUES
('Laura', 'Martin', 2),
('Rainer', 'Petter', 3),
('Marte', 'Gracia', 4),
('Javier', 'Rodriguez', 5);

-- --------------------------------------------------------

--
-- Table structure for table `comic`
--

CREATE TABLE IF NOT EXISTS `comic` (
  `seriesID` int(10) unsigned DEFAULT NULL,
  `subtitle` varchar(128) DEFAULT NULL,
  `writerID` int(10) unsigned DEFAULT NULL,
  `artistID` int(11) DEFAULT NULL,
  `inkerID` int(10) DEFAULT NULL,
  `coloristID` int(10) DEFAULT NULL,
  `lettererID` int(10) DEFAULT NULL,
  `coverartistID` int(6) DEFAULT NULL,
  `covercoloristID` int(10) DEFAULT NULL,
  `volume` smallint(6) DEFAULT NULL,
  `number` smallint(6) DEFAULT NULL,
  `limitedseries` varchar(128) DEFAULT NULL,
  `pubmonth` varchar(128) DEFAULT NULL,
  `pubyear` smallint(4) DEFAULT NULL,
  `familyID` int(10) unsigned DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `comicID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` bigint(11) DEFAULT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `coverinker` int(11) DEFAULT NULL,
  PRIMARY KEY (`comicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `comic`
--

INSERT INTO `comic` (`seriesID`, `subtitle`, `writerID`, `artistID`, `inkerID`, `coloristID`, `lettererID`, `coverartistID`, `covercoloristID`, `volume`, `number`, `limitedseries`, `pubmonth`, `pubyear`, `familyID`, `publisherID`, `comicID`, `isbn`, `adddate`, `coverinker`) VALUES
(4, NULL, 2, 1, NULL, NULL, 1, 1, NULL, 1, 11, NULL, 'March', 2013, NULL, 3, 1, 985301166, '2013-03-27 12:01:01', NULL),
(3, NULL, 4, 2, NULL, 2, 2, 2, 2, 1, 26, NULL, 'May', 2013, 1, 1, 2, 2147483647, '2013-03-27 12:05:08', NULL),
(5, NULL, 5, 3, 1, 3, 3, 3, NULL, 1, 26, NULL, 'September', 2012, NULL, 2, 3, 1617682148, '2013-03-27 12:09:32', NULL),
(2, NULL, 2, 4, 2, 4, 4, 4, 1, 1, 9, NULL, 'May', 2013, 1, 1, 4, 5960607900, '2013-03-27 12:17:19', NULL),
(2, NULL, 2, 4, 2, 4, 4, 4, 1, 1, 5, NULL, 'May', 2013, 1, 1, 5, NULL, '2013-03-27 12:19:03', NULL),
(2, NULL, 2, 4, 2, 4, 4, 4, 1, 1, 6, NULL, 'May', 2013, 1, 1, 7, NULL, '2013-03-27 12:20:07', NULL),
(1, NULL, 3, 5, NULL, 5, 2, 6, 3, 3, 24, NULL, 'May', 2013, NULL, 1, 8, NULL, '2013-03-27 12:21:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coverartist`
--

CREATE TABLE IF NOT EXISTS `coverartist` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `coverartistID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`coverartistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `coverartist`
--

INSERT INTO `coverartist` (`firstname`, `lastname`, `coverartistID`) VALUES
('Fiona', 'Staples', 1),
('Ramon', 'Perez', 2),
('Robb', 'Mommaerts', 3),
('Stuart', 'Immonen', 4),
('Chris', 'Samnee', 6);

-- --------------------------------------------------------

--
-- Table structure for table `covercolorist`
--

CREATE TABLE IF NOT EXISTS `covercolorist` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `coverartistID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`coverartistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `covercolorist`
--

INSERT INTO `covercolorist` (`firstname`, `lastname`, `coverartistID`) VALUES
('Marte', 'Gracia', 1),
('Laura', 'Martin', 2),
('Javier', 'Rodriguez', 3);

-- --------------------------------------------------------

--
-- Table structure for table `coverinker`
--

CREATE TABLE IF NOT EXISTS `coverinker` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `coverartistID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`coverartistID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coverinker`
--


-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `familyname` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned DEFAULT NULL,
  `familyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`familyID`)
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
  `image` blob,
  `comicID` int(11) DEFAULT NULL,
  PRIMARY KEY (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `image`
--


-- --------------------------------------------------------

--
-- Table structure for table `inker`
--

CREATE TABLE IF NOT EXISTS `inker` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `inkerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`inkerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `inker`
--

INSERT INTO `inker` (`firstname`, `lastname`, `inkerID`) VALUES
('Mike', 'Norton', 1),
('Wade', 'von Grawbadger', 2);

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
-- Table structure for table `letterer`
--

CREATE TABLE IF NOT EXISTS `letterer` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `lettererID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`lettererID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `letterer`
--

INSERT INTO `letterer` (`firstname`, `lastname`, `lettererID`) VALUES
('Fonografiks', NULL, 1),
('VC''s Joe', 'Caramanga', 2),
('Tom', 'Long', 3),
('VC''s Cory', 'Petit', 4);

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
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publishername` varchar(128) DEFAULT NULL,
  `startyear` int(10) unsigned DEFAULT NULL,
  `endyear` int(10) unsigned DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `publisherID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`publisherID`)
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
  `roletype` varchar(128) DEFAULT NULL,
  `permissions` varchar(128) DEFAULT NULL,
  `roleID` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `role`
--


-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `seriestitle` varchar(128) DEFAULT NULL,
  `seriesID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publisherID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`seriesID`)
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

-- --------------------------------------------------------

--
-- Table structure for table `writer`
--

CREATE TABLE IF NOT EXISTS `writer` (
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `birthyear` smallint(4) DEFAULT NULL,
  `writerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`writerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `writer`
--

INSERT INTO `writer` (`firstname`, `lastname`, `birthyear`, `writerID`) VALUES
('Brian Michael', 'Bendis', NULL, 1),
('Brian K.', 'Vaughan', NULL, 2),
('Mark', 'Waid', NULL, 3),
('Jason', 'Aaron', NULL, 4),
('Ben', 'McCool', NULL, 5);
