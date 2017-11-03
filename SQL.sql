-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 03. lis 2017, 21:26
-- Verze serveru: 10.1.26-MariaDB
-- Verze PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `client_side`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role`) VALUES
(10, 'Vorlicek2@seznam.cz', 'c0618a9863fa856c58e89fa14e78c5b9452009ce', 'Jan Vorlíček', 'guest'),
(12, 'Vorlicek2ds@seznam.cz', '$2y$10$mCbjlX67DTiagoNpILlaJOS7VqwVQ7U88nNGqVrxIR5t69O0jtUAK', 'Jan Vorlíček', 'guest'),
(13, 'test@test.cz', '$2y$10$Jegs7MkAIu51BgEXdTmHGec31biHx99uukZUSyw5dOy1Kd2.qcpn6', 'Jan Vorlíček', 'guest'),
(14, 'test@test.czss', '$2y$10$Ju9TMFnkazKT8E1EzL72R./mNkGlzvQ.kblTMkZEA5k68wz6EbAAe', 'Jan Vorlíček', 'guest');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
