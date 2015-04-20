-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 29, 2015 at 10:01 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cedar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initiator` int(10) unsigned NOT NULL DEFAULT '0',
  `recipient` int(10) unsigned NOT NULL DEFAULT '0',
  `acceptance` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `initiator`, `recipient`, `acceptance`) VALUES
(1, 1, 1, '1'),
(2, 1, 2, '0'),
(3, 4, 4, '0'),
(4, 4, 4, '0'),
(5, 4, 4, '0'),
(6, 4, 4, '0'),
(7, 4, 4, '0'),
(8, 4, 4, '0'),
(9, 4, 4, '0'),
(10, 4, 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `forum_messages`
--

CREATE TABLE `forum_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `author` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` varchar(14) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sections`
--

CREATE TABLE `forum_sections` (
  `section_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `timestamp` varchar(14) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE `forum_threads` (
  `thread_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `message` text,
  `author` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` varchar(14) NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobfair`
--

CREATE TABLE `jobfair` (
  `job_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `originator_id` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modification` varchar(8) NOT NULL,
  `company` varchar(30) NOT NULL DEFAULT '',
  `job_industry` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(30) NOT NULL DEFAULT '',
  `salary` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `country` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `prerequisites` text NOT NULL,
  `benefits` text NOT NULL,
  `contact` varchar(40) NOT NULL DEFAULT '',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `experience` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`job_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jobfair`
--

INSERT INTO `jobfair` (`job_id`, `originator_id`, `last_modification`, `company`, `job_industry`, `title`, `salary`, `city`, `country`, `description`, `prerequisites`, `benefits`, `contact`, `start_date`, `experience`) VALUES
(1, 1, '', 'St.lawrence', 'Programmer', 'Teaching Assistance', '700', 'Kampala', 'United States', 'nothing at all', '', 'I m', '0785077853', '2007-02-01', 1),
(2, 4, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0),
(3, 4, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0),
(4, 4, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL DEFAULT '',
  `last_name` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `date_join` varchar(20) NOT NULL,
  `home_address` varchar(40) NOT NULL DEFAULT '',
  `home_address_extra` varchar(40) NOT NULL DEFAULT '',
  `home_zip` varchar(10) NOT NULL DEFAULT '',
  `home_city` varchar(30) NOT NULL DEFAULT '',
  `home_state` varchar(30) NOT NULL DEFAULT '',
  `home_country` varchar(30) NOT NULL DEFAULT '',
  `home_phone` varchar(30) NOT NULL DEFAULT '',
  `home_cellphone` varchar(30) NOT NULL DEFAULT '',
  `gender` varchar(6) NOT NULL,
  `church` varchar(40) NOT NULL,
  `pastor` varchar(20) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `home_homepage` varchar(40) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL DEFAULT '0000',
  `term` varchar(10) NOT NULL DEFAULT '-----',
  `home_other_info` text NOT NULL,
  `majors` text NOT NULL,
  `company_name` varchar(30) NOT NULL DEFAULT '',
  `position` varchar(30) NOT NULL DEFAULT '',
  `industry` varchar(30) NOT NULL DEFAULT '',
  `company_address` varchar(40) NOT NULL DEFAULT '',
  `company_address_extra` varchar(40) NOT NULL DEFAULT '',
  `company_zip` varchar(10) NOT NULL DEFAULT '',
  `company_city` varchar(30) NOT NULL DEFAULT '',
  `company_state` varchar(30) NOT NULL DEFAULT '',
  `company_country` varchar(30) NOT NULL DEFAULT '',
  `company_phone` varchar(30) NOT NULL DEFAULT '',
  `company_cellphone` varchar(30) NOT NULL DEFAULT '',
  `company_homepage` varchar(40) NOT NULL DEFAULT '',
  `company_description` text NOT NULL,
  `company_other_info` text NOT NULL,
  `terms_ok` char(1) NOT NULL DEFAULT '0',
  `first_login` char(1) NOT NULL DEFAULT '1',
  `timestamp` varchar(14) NOT NULL,
  `subgroup` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`),
  UNIQUE KEY `ID` (`id`),
  KEY `name` (`first_name`,`last_name`),
  KEY `company` (`company_name`),
  KEY `home` (`home_city`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `password`, `email`, `date_join`, `home_address`, `home_address_extra`, `home_zip`, `home_city`, `home_state`, `home_country`, `home_phone`, `home_cellphone`, `gender`, `church`, `pastor`, `birthday`, `home_homepage`, `year`, `term`, `home_other_info`, `majors`, `company_name`, `position`, `industry`, `company_address`, `company_address_extra`, `company_zip`, `company_city`, `company_state`, `company_country`, `company_phone`, `company_cellphone`, `company_homepage`, `company_description`, `company_other_info`, `terms_ok`, `first_login`, `timestamp`, `subgroup`) VALUES
(1, 'kevin', 'janvier', 'kevin12345', 'kevin@yahoo.com', '0', 'kamapal', 'kakak', '99', 'kamapa', 'iqwei', 'uganda', '010983', '09129487124', '', '', '', '2014-10-20', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '0', '', 0),
(2, 'Kevin', 'Janvier', 'Tevgrosa', 'kevin.janvier5@hotmail.com', '0', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '', 0),
(3, 'Kevin', 'Janvier', 'woSrogwo', 'kevin@hotmail.com', '0', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '', 0),
(4, 'Florence', 'Nalungo', 'cinabalire570', 'Florence@gmail.com', '132', '', '', '', 'kampala', '', 'Female', '', '', 'Female', 'ffc', 'Dennis Kasirye', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Kevin', '', '', '1', '0', '', 0),
(5, 'janvier', 'muzusagabo', 'stinOCzo', 'jamcongre@gmail.com', '132', '', '', '', 'kampala', '', 'Uganda', '', '', 'Male', 'ffc', 'Dennis Kasirye', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '0', '', 0),
(6, 'jim', 'jum', 'ceef4abe427f4d8b6c26', 'jim@yahoo.com', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '1', '', 0),
(7, 'jim', 'jum', '870b72fe233fc2872016', 'jim@ahoo.com', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', 0000, '-----', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `members_subgroup`
--

CREATE TABLE `members_subgroup` (
  `subgroup_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `subgroup` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`subgroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `timestamp` varchar(14) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `headline`, `body`, `timestamp`) VALUES
(1, 'Cedar retreat at Faith family Church Uganda', 'Come and Witness Cedar retreat at Faith family Church Uganda Kampala ..Guest is Pr. Denis Kasirye', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `recipients` varchar(50) NOT NULL DEFAULT '',
  `timestamp` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
