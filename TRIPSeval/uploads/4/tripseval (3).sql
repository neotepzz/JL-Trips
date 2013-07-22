-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2013 at 03:13 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tripseval`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `logtime` datetime NOT NULL,
  `logdesc` varchar(255) NOT NULL,
  `logtripid` int(11) NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=708 ;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `EVM` int(11) NOT NULL DEFAULT '0',
  `Deputy` int(11) NOT NULL DEFAULT '0',
  `Head` int(11) NOT NULL DEFAULT '0',
  `LGS` int(11) NOT NULL DEFAULT '0',
  `LHS` int(11) NOT NULL DEFAULT '0',
  `FFD` int(11) NOT NULL DEFAULT '0',
  `LESM` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  `Email` varchar(255) NOT NULL,
  `delete` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `tripid` int(11) NOT NULL AUTO_INCREMENT,
  `createdby` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `organiser` varchar(255) NOT NULL,
  `deptdate` datetime NOT NULL,
  `retdate` datetime NOT NULL,
  `pretripaccepted` int(11) NOT NULL,
  `pretripdenied` int(11) NOT NULL,
  `tripaccepted` int(11) NOT NULL,
  `tripdenied` int(11) NOT NULL,
  `tripfinalised` int(11) NOT NULL,
  `tripfinalisedenied` int(11) NOT NULL,
  `createddate` date NOT NULL,
  `pretripsubmitted` int(11) NOT NULL DEFAULT '0',
  `tripsubmitted` int(11) NOT NULL DEFAULT '0',
  `LGS` int(11) NOT NULL DEFAULT '0',
  `LHS` int(11) NOT NULL DEFAULT '0',
  `FFD` int(11) NOT NULL DEFAULT '0',
  `organiseremail` varchar(255) NOT NULL,
  `delete` int(11) NOT NULL DEFAULT '0',
  `pretrip` int(11) NOT NULL DEFAULT '1',
  `trip` int(11) NOT NULL DEFAULT '0',
  `LGSYearGroups` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `LGSProposedNumbers` int(11) NOT NULL,
  `ProposedLocation` varchar(255) NOT NULL,
  `CurriculumValue` varchar(1000) NOT NULL,
  `ProposedTransport` varchar(255) NOT NULL,
  `CoachCompany` varchar(255) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `TravelCompanyUse` varchar(3) NOT NULL,
  `TravelCompName` varchar(255) NOT NULL,
  `MrHarker` varchar(3) NOT NULL,
  `PupilCost` int(11) NOT NULL,
  `StaffAcc` varchar(1000) NOT NULL,
  `DeniedReason` varchar(1000) NOT NULL,
  `lgsevma` int(11) NOT NULL DEFAULT '0',
  `lhsevma` int(11) NOT NULL DEFAULT '0',
  `ffdevma` int(11) NOT NULL DEFAULT '0',
  `tripfinalaccept` int(11) NOT NULL DEFAULT '0',
  `FFDProposedNumbers` int(11) NOT NULL DEFAULT '0',
  `LHSProposedNumbers` int(11) NOT NULL DEFAULT '0',
  `FFDYearGroups` varchar(255) NOT NULL DEFAULT '0',
  `LHSYearGroups` varchar(255) NOT NULL DEFAULT '0',
  `FirstAiders` varchar(1000) NOT NULL,
  `lgsdepa` int(11) NOT NULL DEFAULT '0',
  `lhsdepa` int(11) NOT NULL DEFAULT '0',
  `ffddepa` int(11) NOT NULL DEFAULT '0',
  `lgsheada` int(11) NOT NULL DEFAULT '0',
  `lhsheada` int(11) NOT NULL DEFAULT '0',
  `ffdheada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tripid`),
  UNIQUE KEY `tripid` (`tripid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
