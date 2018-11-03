-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2018 at 11:27 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `search_project`
--
CREATE DATABASE IF NOT EXISTS `search_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `search_project`;

-- --------------------------------------------------------

--
-- Table structure for table `api_call`
--

CREATE TABLE `api_call` (
  `ID` int(11) NOT NULL,
  `url` varchar(190) NOT NULL,
  `search_key` varchar(190) NOT NULL,
  `filter` varchar(190) NOT NULL,
  `name` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_call`
--

INSERT INTO `api_call` (`ID`, `url`, `search_key`, `filter`, `name`) VALUES
(1, 'https://api.github.com/search/issues', 'q', '+state:closed', 'github');

-- --------------------------------------------------------

--
-- Table structure for table `words_score`
--

CREATE TABLE `words_score` (
  `id` int(11) NOT NULL,
  `words` varchar(255) DEFAULT NULL,
  `score` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_call`
--
ALTER TABLE `api_call`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `words_score`
--
ALTER TABLE `words_score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `words_score`
--
ALTER TABLE `words_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
