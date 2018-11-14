-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

-- CREATE DATABASE `escapegame` /*!40100 DEFAULT CHARACTER SET utf8 */;
-- USE `escapegame`;

DROP TABLE IF EXISTS `cables`;
CREATE TABLE `cables` (
  `idcable` int(11) NOT NULL AUTO_INCREMENT,
  `namecable` text NOT NULL,
  `description` text,
  PRIMARY KEY (`idcable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cables` (`idcable`, `namecable`, `description`) VALUES
(1,	'VGA',	NULL),
(2,	'JACK',	NULL),
(3,	'HDMI',	NULL),
(4,	'RJ45',	NULL),
(5,	'USB',	NULL);


DROP TABLE IF EXISTS `gameset`;
CREATE TABLE `gameset` (
  `idgame` int(11) NOT NULL AUTO_INCREMENT,
  `cableselect1` int(11) NOT NULL,
  `cableselect2` int(11) NOT NULL,
  `cableselect3` int(11) NOT NULL,
  `indice1` char(1) NOT NULL,
  `indice2` char(1) NOT NULL,
  `binary` char(8) NOT NULL,
  PRIMARY KEY (`idgame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `gameinprogress`;
CREATE TABLE `gameinprogress` (
  `idgameinprogress` int(11) NOT NULL AUTO_INCREMENT,
  `timestart` datetime NOT NULL,
  `timefirststep` datetime DEFAULT NULL,
  `timesecondestep` datetime DEFAULT NULL,
  `timeend` datetime DEFAULT NULL,
  `success` int(11) NOT NULL DEFAULT '1',
  `isvideoplayed` int(11) NOT NULL DEFAULT '0',
  `idgame` int(11) NOT NULL,
  PRIMARY KEY (`idgameinprogress`),
  KEY `idGame` (`idgame`),
  CONSTRAINT `gameinprogress_ibfk_1` FOREIGN KEY (`idgame`) REFERENCES `gameset` (`idgame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `gameset` (`idgame`, `cableselect1`, `cableselect2`, `cableselect3`, `indice1`, `indice2`, `binary`) VALUES
(1,	1,	2,	3,	'9',	'9',	'10011001'),
(2,	1,	2,	4,	'B',	'C',	'10111100'),
(3,	1,	2,	5,	'A',	'A',	'10101010'),
(4,	1,	3,	2,	'B',	'7',	'10110111'),
(5,	1,	3,	4,	'9',	'0',	'10010000'),
(6,	1,	3,	5,	'9',	'2',	'10010010'),
(7,	1,	4,	2,	'D',	'0',	'11010000'),
(8,	1,	4,	3,	'9',	'C',	'10011100'),
(9,	1,	4,	5,	'E',	'6',	'11100110'),
(10,	1,	5,	2,	'C',	'9',	'11001001'),
(11,	1,	5,	3,	'B',	'9',	'10111001'),
(12,	1,	5,	4,	'A',	'8',	'10101000'),
(13,	2,	1,	3,	'8',	'0',	'10000000'),
(14,	2,	1,	4,	'C',	'D',	'11001101'),
(15,	2,	1,	5,	'E',	'8',	'11101000'),
(16,	2,	3,	1,	'9',	'A',	'10011010'),
(17,	2,	3,	4,	'E',	'6',	'11100110'),
(18,	2,	3,	5,	'C',	'5',	'11000101'),
(19,	2,	4,	1,	'C',	'D',	'11001101'),
(20,	2,	4,	3,	'9',	'D',	'10011101'),
(21,	2,	4,	5,	'B',	'1',	'10110001'),
(22,	2,	5,	1,	'B',	'E',	'10111110'),
(23,	2,	5,	3,	'B',	'0',	'10110000'),
(24,	2,	5,	4,	'A',	'A',	'10101010'),
(25,	3,	1,	2,	'E',	'D',	'11101101'),
(26,	3,	1,	4,	'8',	'C',	'10001100'),
(27,	3,	1,	5,	'8',	'D',	'10001101'),
(28,	3,	2,	1,	'9',	'7',	'10010111'),
(29,	3,	2,	4,	'A',	'E',	'10101110'),
(30,	3,	2,	5,	'D',	'3',	'11010011'),
(31,	3,	4,	1,	'8',	'8',	'10001000'),
(32,	3,	4,	2,	'C',	'9',	'11001001'),
(33,	3,	4,	5,	'D',	'7',	'11010111'),
(34,	3,	5,	1,	'A',	'6',	'10100110'),
(35,	3,	5,	2,	'A',	'C',	'10101100'),
(36,	3,	5,	4,	'9',	'E',	'10011110'),
(37,	4,	1,	2,	'9',	'C',	'10011100'),
(38,	4,	1,	3,	'9',	'6',	'10010110'),
(39,	4,	1,	5,	'8',	'5',	'10000101'),
(40,	4,	2,	1,	'E',	'0',	'11100000'),
(41,	4,	2,	3,	'D',	'D',	'11011101'),
(42,	4,	2,	5,	'8',	'0',	'10000000'),
(43,	4,	3,	1,	'B',	'5',	'10110101'),
(44,	4,	3,	2,	'C',	'E',	'11001110'),
(45,	4,	3,	5,	'9',	'2',	'10010010'),
(46,	4,	5,	1,	'8',	'B',	'10001011'),
(47,	4,	5,	2,	'8',	'0',	'10000000'),
(48,	4,	5,	3,	'D',	'C',	'11011100'),
(49,	5,	1,	2,	'B',	'D',	'10111101'),
(50,	5,	1,	3,	'8',	'0',	'10000000'),
(51,	5,	1,	4,	'C',	'D',	'11001101'),
(52,	5,	2,	1,	'A',	'1',	'10100001'),
(53,	5,	2,	3,	'D',	'1',	'11010001'),
(54,	5,	2,	4,	'C',	'3',	'11000011'),
(55,	5,	3,	1,	'D',	'B',	'11011011'),
(56,	5,	3,	2,	'B',	'E',	'10111110'),
(57,	5,	3,	4,	'E',	'A',	'11101010'),
(58,	5,	4,	1,	'B',	'3',	'10110011'),
(59,	5,	4,	2,	'C',	'8',	'11001000'),
(60,	5,	4,	3,	'9',	'7',	'10010111');

-- 2018-11-06 10:32:37
