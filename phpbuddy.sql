-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 20 apr 2020 om 14:51
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
-- Tabelstructuur voor tabel `buddychat`
--

DROP TABLE IF EXISTS `buddychat`;
CREATE TABLE IF NOT EXISTS `buddychat` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `messageread` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `buddies` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_one` (`user_one`),
  KEY `user_two` (`user_two`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
CREATE TABLE IF NOT EXISTS `friend_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES
(10, '', 'comment', 'Hi crush', 'read', '2018-02-09 00:21:21'),
(11, 'Irene', 'like', '', 'read', '2018-02-09 00:21:34'),
(12, 'Joe', 'like', '', 'read', '2018-02-09 00:22:25'),
(13, '', 'comment', 'hello', 'unread', '2020-04-06 17:10:21'),
(14, '', 'comment', 'hello', 'read', '2020-04-06 17:10:21'),
(15, 'lol', 'like', '', 'unread', '2020-04-06 17:10:33'),
(16, 'lol', 'like', '', 'unread', '2020-04-06 17:10:33'),
(17, '', 'comment', 'hello', 'unread', '2020-04-06 18:17:34'),
(18, '', 'comment', 'hello', 'unread', '2020-04-06 18:17:34'),
(19, '', 'comment', 'helllo', 'unread', '2020-04-06 18:17:40'),
(20, '', 'comment', 'helllo', 'unread', '2020-04-06 18:17:40'),
(21, '', 'comment', 'hello', 'read', '2020-04-07 13:15:50'),
(22, '', 'comment', 'hello', 'unread', '2020-04-07 13:15:50'),
(23, 'lkdskfhsj', 'like', '', 'read', '2020-04-07 13:47:42'),
(24, 'lkdskfhsj', 'like', '', 'unread', '2020-04-07 13:47:42');

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
  `password` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locatie` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `interests` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hobby` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `buddy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `locatie`, `interests`, `hobby`, `extra`, `class`, `buddy`, `image`, `imgDescription`) VALUES
(5, 'Michaël', 'Storms', 'r0701956@student.thomasmore.be', '$2y$16$nJjC5dZwz1xCOG1G.L40muhAeE/jqu3PJIADHz7ps4k96zt70Gp9C', 'malle', 'Design', 'Gaming', 'foodie', '3IMD', 'BuddySearcher', '', ''),
(6, 'john', 'doe', 'r0701757@student.thomasmore.be', '$2y$16$75Ec4jiBwkvXkjl.jcuU6Ox35MP0My78oeDMNUk0ZsXjEkY13Tuti', 'Mechelen', 'Development', 'Voetbal', 'party', '1IMD', 'BuddySearcher', '', ''),
(7, 'Nina', 'Van der kerken', 'r0701958@student.thomasmore.be', '$2y$16$fPRZivdzT7wCU7KdYBGVAeL6Ao3b51Mvd8NxWlJR3d8BkO24vx0Bm', '', '', '', '', '', 'BuddySearcher', '', ''),
(8, 'Kevin', 'De Vos', 'r0701959@student.thomasmore.be', '$2y$16$bl1XVyZOGlS7asMaRvNAxuof5A7pod1SFZ/u5C3XvgAc/lCAaDipm', 'malle', 'Design & Development', 'Basketbal', 'foodie', '3IMD', 'BuddyHolder', '', ''),
(9, 'Jasmina', 'Mulder', 'r0701916@student.thomasmore.be', '$2y$16$LROOy5giaT0u40rvL0J14.fSJeiffkNWStxdaaWCGx3e9PKLxqRVC', 'Lier', 'Design & Development', 'Gaming', 'foodie', '1IMD', 'BuddySearcher', '', ''),
(10, 'luka', 'luka', 'r0764418@student.thomasmore.be', '$2y$16$wuhQlZ8jMi/bByz9vw8IIuJJiEEybphTaDlp7iL.RZDp.Hu7aU19u', '', '', '', '', '', '', '', '');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
