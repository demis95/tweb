-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 12:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto`
--

-- --------------------------------------------------------

--
-- Table structure for table `dati_utente`
--

CREATE TABLE `dati_utente` (
  `ref_user` int(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `Altezza` int(11) DEFAULT NULL,
  `genere` varchar(1) DEFAULT NULL,
  `eta` int(3) DEFAULT NULL,
  `peso0` int(3) DEFAULT NULL,
  `pesoX` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dati_utente`
--

INSERT INTO `dati_utente` (`ref_user`, `email`, `Altezza`, `genere`, `eta`, `peso0`, `pesoX`) VALUES
(26, 'angelomiccoli2495@gmail.com', 384, 'M', 421, 12, 4),
(27, 'demis.mazzotta@gmail.com', 170, 'M', 25, 55, 66),
(28, '', 0, 'M', 0, 0, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statisticheutente`
--

CREATE TABLE `statisticheutente` (
  `idUtente` int(10) NOT NULL,
  `data` date NOT NULL,
  `peso0` int(3) DEFAULT NULL,
  `imc` float DEFAULT NULL,
  `fabbisogno` float DEFAULT NULL,
  `pesoX` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statisticheutente`
--

INSERT INTO `statisticheutente` (`idUtente`, `data`, `peso0`, `imc`, `fabbisogno`, `pesoX`) VALUES
(3, '2021-01-14', 0, 17.3, 3278.4, 76),
(3, '2021-01-16', 50, 17.3, 3251.17, 75),
(26, '0000-00-00', NULL, NULL, 3251.17, 75),
(26, '2021-01-15', 50, 17.3, 3251.17, 75),
(27, '0000-00-00', NULL, NULL, 3403.85, 75),
(27, '2021-01-17', 50, 17.3, 3251.17, 75),
(27, '2021-01-18', 50, 17.3, 3251.17, 75),
(27, '2021-01-19', 120, 54.78, 3251.17, 75),
(27, '2021-01-20', 50, 17.3, 1208.62, 0),
(27, '2021-01-21', 96, 33.22, 3251.17, 75),
(27, '2021-01-23', 120, 41.52, 3387.34, 80),
(28, '0000-00-00', NULL, NULL, 2025.64, 30),
(28, '2021-01-20', NULL, NULL, NULL, NULL),
(28, '2021-01-22', NULL, NULL, 3251.17, 75),
(29, '2021-01-22', NULL, NULL, NULL, NULL),
(33, '2021-01-22', NULL, NULL, NULL, NULL),
(34, '2021-01-22', NULL, NULL, NULL, NULL),
(35, '2021-01-22', NULL, NULL, NULL, NULL),
(36, '2021-01-22', NULL, NULL, NULL, NULL),
(37, '2021-01-22', NULL, NULL, NULL, NULL),
(38, '2021-01-22', NULL, NULL, NULL, NULL),
(39, '2021-01-22', NULL, NULL, NULL, NULL),
(40, '2021-01-22', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(3, 'Demis1', 'mammata', 'demis.mazzotta@gmail.com'),
(26, 'burkinafaso74', 'mariamia', 'angelomiccoli2495@gmail.com'),
(27, 'demis2', 'a88efd03e98ddb1227776c9b3ba338a9', 'demis.mazzotta@gmail.com'),
(28, 'demis3', 'a88efd03e98ddb1227776c9b3ba338a9', 'demis.mazzotta@gmail.com'),
(29, 'demis4', 'a88efd03e98ddb1227776c9b3ba338a9', 'mazzotta.joele@gmail.com'),
(33, 'dede55', 'a88efd03e98ddb1227776c9b3ba338a9', 'demis.mazzotta@gmail.com'),
(34, 'dede88', 'a88efd03e98ddb1227776c9b3ba338a9', 'demis.mazzotta@gmail.com'),
(35, '3333333', '77c9749b451ab8c713c48037ddfbb2c4', 'demis.mazzotta@gmail.com'),
(36, '343434', '773d1df78f82629fac1ccb6b4121c7de', 'demis.mazzotta@gmail.com'),
(37, 'rrrrrrrrr', '66ba13e5474d241e80f7a12ed434645d', 'demis.mazzotta@gmail.com'),
(38, 'mmmm', 'a21798397afe3404a5c0cc399ccf67cf', 'demis.mazzotta@gmail.com'),
(39, 'awdawdaw', 'f3823903b2dd6e35243b1bbe5a14f651', 'demis.mazzotta@gmail.com'),
(40, 'porcodddio', 'a88efd03e98ddb1227776c9b3ba338a9', 'demis.mazzotta@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dati_utente`
--
ALTER TABLE `dati_utente`
  ADD PRIMARY KEY (`ref_user`);

--
-- Indexes for table `statisticheutente`
--
ALTER TABLE `statisticheutente`
  ADD PRIMARY KEY (`idUtente`,`data`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keylog` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dati_utente`
--
ALTER TABLE `dati_utente`
  ADD CONSTRAINT `dati_utente_ibfk_1` FOREIGN KEY (`ref_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statisticheutente`
--
ALTER TABLE `statisticheutente`
  ADD CONSTRAINT `statisticheutente_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
