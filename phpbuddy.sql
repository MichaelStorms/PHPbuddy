-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 29 apr 2020 om 15:03
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
-- Tabelstructuur voor tabel `antibruteforcetable`
--

DROP TABLE IF EXISTS `antibruteforcetable`;
CREATE TABLE IF NOT EXISTS `antibruteforcetable` (
  `abf_id` int(11) NOT NULL AUTO_INCREMENT,
  `abf_account` varchar(255) NOT NULL,
  `abf_ipadress` varchar(15) NOT NULL,
  `abf_time` datetime NOT NULL,
  `abf_post` text NOT NULL,
  `abf_get` text NOT NULL,
  PRIMARY KEY (`abf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='Logs of brute-force attacks';

--
-- Gegevens worden geëxporteerd voor tabel `antibruteforcetable`
--

INSERT INTO `antibruteforcetable` (`abf_id`, `abf_account`, `abf_ipadress`, `abf_time`, `abf_post`, `abf_get`) VALUES
(18, '', '::1', '2020-04-28 17:16:52', 'Array\n(\n    [email] => r0701956@student.thomasmore.be\n    [password] => test\n)\n', 'Array\n(\n)\n'),
(17, '', '::1', '2020-04-28 17:16:17', 'Array\n(\n    [email] => r0701956@student.thomasmore.be\n    [password] => test\n)\n', 'Array\n(\n)\n'),
(16, '', '::1', '2020-04-28 17:13:54', 'Array\n(\n    [email] => r0701956@student.thomasmore.be\n    [password] => test\n)\n', 'Array\n(\n)\n'),
(15, '', '::1', '2020-04-28 17:13:12', 'Array\n(\n    [email] => r0701956@student.thomasmore.be\n    [password] => code2012\n)\n', 'Array\n(\n)\n'),
(35, 'Honorable', '::1', '2020-04-29 00:19:04', 'Array\n(\n    [email] => Honorable\n    [password] => Mitch1998Storms1\n)\n', 'Array\n(\n)\n'),
(34, 'Honorable', '::1', '2020-04-29 00:19:03', 'Array\n(\n    [email] => Honorable\n    [password] => Mitch1998Storms1\n)\n', 'Array\n(\n)\n'),
(37, 'r0701956@student.thomasmore.be', '::1', '2020-04-29 16:30:32', 'Array\n(\n    [email] => r0701956@student.thomasmore.be\n    [password] => code2012\n)\n', 'Array\n(\n)\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `buddychat`
--

DROP TABLE IF EXISTS `buddychat`;
CREATE TABLE IF NOT EXISTS `buddychat` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `message` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `buddychat`
--

INSERT INTO `buddychat` (`id`, `sender_id`, `reciever_id`, `message`, `timestamp`, `status`) VALUES
(1, 5, 0, 'hello', '2020-04-25 14:54:30', 1),
(2, 5, 7, 'Hello there', '2020-04-25 14:55:43', 0),
(3, 7, 5, 'hello', '2020-04-25 14:58:19', 0),
(4, 7, 9, 'hello', '2020-04-25 15:16:55', 1),
(5, 7, 6, 'hey', '2020-04-25 15:48:13', 1),
(6, 7, 6, 'hello', '2020-04-25 15:49:29', 1),
(7, 7, 6, 'hey tehre', '2020-04-25 15:49:39', 1),
(8, 5, 7, 'hello', '2020-04-27 13:21:07', 1),
(9, 5, 6, 'hello', '2020-04-27 13:36:51', 1),
(10, 5, 6, 'how are you', '2020-04-27 13:36:55', 1),
(11, 5, 6, '&lt;script&gt;alert(‘XSS’)&lt;/script&gt;', '2020-04-27 14:34:47', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chat_login_details`
--

DROP TABLE IF EXISTS `chat_login_details`;
CREATE TABLE IF NOT EXISTS `chat_login_details` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_typing` enum('no','yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `chat_login_details`
--

INSERT INTO `chat_login_details` (`id`, `userid`, `last_activity`, `is_typing`) VALUES
(0, 5, '2020-04-25 14:08:53', 'yes');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `friends`
--

INSERT INTO `friends` (`id`, `user_one`, `user_two`, `buddies`) VALUES
(1, 7, 5, 0),
(2, 5, 6, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender`, `receiver`) VALUES
(3, 5, 10),
(5, 5, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

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
(24, 'lkdskfhsj', 'like', '', 'read', '2020-04-07 13:47:42'),
(25, '', 'comment', 'hello', 'read', '2020-04-23 14:32:09'),
(26, '', 'comment', 'hello', 'unread', '2020-04-23 14:32:09'),
(27, '', 'comment', 'hello', 'unread', '2020-04-23 14:32:13'),
(28, '', 'comment', 'hello', 'unread', '2020-04-23 14:32:13');

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
  `current_session` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `locatie`, `interests`, `hobby`, `extra`, `class`, `buddy`, `image`, `imgDescription`, `current_session`, `online`) VALUES
(5, 'Michaël', 'Storms', 'r0701956@student.thomasmore.be', '$2y$16$nJjC5dZwz1xCOG1G.L40muhAeE/jqu3PJIADHz7ps4k96zt70Gp9C', 'malle', 'Design', 'Gaming', 'foodie', '3IMD', 'BuddySearcher', '', '', 9, 1),
(6, 'john', 'doe', 'r0701757@student.thomasmore.be', '$2y$16$75Ec4jiBwkvXkjl.jcuU6Ox35MP0My78oeDMNUk0ZsXjEkY13Tuti', 'Mechelen', 'Development', 'Voetbal', 'party', '1IMD', 'BuddySearcher', '', '', 0, 0),
(7, 'Nina', 'Van der kerken', 'r0701958@student.thomasmore.be', '$2y$16$fPRZivdzT7wCU7KdYBGVAeL6Ao3b51Mvd8NxWlJR3d8BkO24vx0Bm', 'malle', 'Development', 'Voetbal', 'foodie', '1IMD', 'BuddySearcher', '', '', 6, 1),
(8, 'Kevin', 'De Vos', 'r0701959@student.thomasmore.be', '$2y$16$bl1XVyZOGlS7asMaRvNAxuof5A7pod1SFZ/u5C3XvgAc/lCAaDipm', 'malle', 'Design & Development', 'Basketbal', 'foodie', '3IMD', 'BuddyHolder', '', '', 0, 0),
(9, 'Jasmina', 'Mulder', 'r0701916@student.thomasmore.be', '$2y$16$LROOy5giaT0u40rvL0J14.fSJeiffkNWStxdaaWCGx3e9PKLxqRVC', 'Lier', 'Design & Development', 'Gaming', 'foodie', '1IMD', 'BuddySearcher', '', '', 0, 0),
(10, 'luka', 'luka', 'r0764418@student.thomasmore.be', '$2y$16$wuhQlZ8jMi/bByz9vw8IIuJJiEEybphTaDlp7iL.RZDp.Hu7aU19u', '', '', '', '', '', '', '', '', 0, 0);

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
