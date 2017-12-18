-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 18, 2017 alle 22:09
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fantacalcio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `nome_stanza` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `attiva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `rooms`
--

INSERT INTO `rooms` (`id`, `nome_stanza`, `id_admin`, `attiva`) VALUES
(11, 'Ettoresroom', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`) VALUES
(1, 'ettoremoretti27@gmail.com', '$2y$10$m0b.wY93VOD9cPbG1eZ1AeD79ttWd8qcvMsjZGi5S70NczNFRTfoa', 'Ettore Moretti');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
