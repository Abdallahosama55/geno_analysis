-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2023 at 11:27 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db`;

-- --------------------------------------------------------

--
-- Table structure for table `gene`
--

CREATE TABLE IF NOT EXISTS `gene` (
  `GeneID` int(11) NOT NULL DEFAULT '0',
  `GeneName` varchar(20) DEFAULT NULL,
  `Seq` varchar(2000) DEFAULT NULL,
  `GC_Content` varchar(2000) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `kmer_value` varchar(2000) DEFAULT NULL,
  `TranscriptionRes` varchar(2000) DEFAULT NULL,
  `StopCodon` varchar(2000) DEFAULT NULL,
  `FirstStopCodon` int(11) DEFAULT NULL,
  `ReverseCompelement` varchar(2000) DEFAULT NULL,
  `AminoAcid` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`GeneID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` char(10) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
