-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 15 sep. 2021 à 09:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `escapegame_2021`
--
CREATE DATABASE IF NOT EXISTS `escapegame_2021` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `escapegame_2021`;

-- --------------------------------------------------------

--
-- Structure de la table `solution`
--

DROP TABLE IF EXISTS `solution`;
CREATE TABLE IF NOT EXISTS `solution` (
  `jour` date NOT NULL,
  `en1` char(1) NOT NULL,
  `en2` char(1) NOT NULL,
  `en3` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `solution`
--

INSERT INTO `solution` (`jour`, `en1`, `en2`, `en3`) VALUES
('2021-11-23', '7', 'A', '01111010'),
('2021-11-24', '9', 'D', '10011101'),
('2021-11-25', 'B', 'C', '10111100'),
('2021-11-26', 'E', '3', '11100011'),
('2021-11-27', 'F', '8', '11111000'),
('2021-11-28', '1', '3', '00010011');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
