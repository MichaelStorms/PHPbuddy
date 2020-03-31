-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 31 mrt 2020 om 11:17
-- Serverversie: 8.0.18
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpbuddy`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locatie` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `interests` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hobby` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buddy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgDescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `locatie`, `interests`, `hobby`, `extra`, `class`, `buddy`, `image`, `imgDescription`) VALUES
(5, 'Michaël', 'Storms', 'r0701956@student.thomasmore.be', '$2y$16$nJjC5dZwz1xCOG1G.L40muhAeE/jqu3PJIADHz7ps4k96zt70Gp9C', 'malle', 'Design', 'Gaming', 'foodie', '3IMD', 'BuddySearcher', '', ''),
(6, 'john', 'doe', 'r0701757@student.thomasmore.be', '$2y$16$75Ec4jiBwkvXkjl.jcuU6Ox35MP0My78oeDMNUk0ZsXjEkY13Tuti', 'Mechelen', 'Development', 'Voetbal', 'party', '1IMD', 'BuddySearcher', '', ''),
(7, 'Nina', 'Van der kerken', 'r0701958@student.thomasmore.be', '$2y$16$fPRZivdzT7wCU7KdYBGVAeL6Ao3b51Mvd8NxWlJR3d8BkO24vx0Bm', 'Mechelen', 'Design & Development', 'Films kijken', 'party', '2IMD', 'BuddyHolder', '', ''),
(8, 'Kevin', 'De Vos', 'r0701959@student.thomasmore.be', '$2y$16$bl1XVyZOGlS7asMaRvNAxuof5A7pod1SFZ/u5C3XvgAc/lCAaDipm', 'malle', 'Design & Development', 'Basketbal', 'foodie', '3IMD', 'BuddyHolder', '', ''),
(9, 'Jasmina', 'Mulder', 'r0701916@student.thomasmore.be', '$2y$16$LROOy5giaT0u40rvL0J14.fSJeiffkNWStxdaaWCGx3e9PKLxqRVC', 'Lier', 'Design & Development', 'Gaming', 'foodie', '1IMD', 'BuddySearcher', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
