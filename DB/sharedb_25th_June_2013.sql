-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 25 Juin 2013 à 11:46
-- Version du serveur: 5.6.11-log
-- Version de PHP: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sharedb`
--
CREATE DATABASE IF NOT EXISTS `sharedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sharedb`;

-- --------------------------------------------------------

--
-- Structure de la table `excellencyrate`
--

CREATE TABLE IF NOT EXISTS `excellencyrate` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `traderID` int(11) NOT NULL,
  `traderindex` int(11) NOT NULL,
  `addedOn` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `topindex` (`traderindex`,`traderID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AddedOn` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `paymentType` varchar(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sharemarket`
--

CREATE TABLE IF NOT EXISTS `sharemarket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(11) NOT NULL,
  `standing` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `addedOn` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `trade`
--

CREATE TABLE IF NOT EXISTS `trade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `riskfactor` varchar(11) NOT NULL,
  `gainingPrice` int(11) NOT NULL,
  `openDate` datetime NOT NULL,
  `closedDate` datetime NOT NULL,
  `addedOn` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` int(11) NOT NULL,
  `userrole` int(11) NOT NULL,
  `addedOn` datetime NOT NULL,
  `updatedOn` datetime NOT NULL,
  `userstatus` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Userindex` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `usertype`, `userrole`, `addedOn`, `updatedOn`, `userstatus`) VALUES
(1, 'ds', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'dsssd', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, 'Nitin', 'InRMwiIRMWE2KGPMUEuRBxvxA949trnjYglqtK20p6WOHzifMaN99YJU4BtC4tcdQTsB667WH3S6kZK12JJzgQ==', 'nitbabar@gmail.com', 0, 0, '2013-06-19 16:28:49', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
