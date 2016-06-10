-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 10. Jun 2016 um 20:10
-- Server-Version: 5.5.47-0+deb8u1
-- PHP-Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `usr_web1200_2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fitbit_users`
--

CREATE TABLE `fitbit_users` (
  `id` int(10) NOT NULL,
  `fitbit_id` varchar(256) NOT NULL,
  `access_token` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `refresh_token` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fitbit_users`
--
ALTER TABLE `fitbit_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fitbit_users`
--
ALTER TABLE `fitbit_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
