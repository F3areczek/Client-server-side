-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 05. lis 2017, 13:32
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
-- Struktura tabulky `evaluation`
--

CREATE TABLE `evaluation` (
  `idevaluation` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idflower` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `flowers`
--

CREATE TABLE `flowers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `users_id` int(11) NOT NULL,
  `accepted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `flowers`
--

INSERT INTO `flowers` (`id`, `name`, `file`, `description`, `users_id`, `accepted`) VALUES
(19, 'Pivoňka pěstovní', 'img/flowers/46297-1179737450_01.jpg', '<p>V d&aacute;vn&yacute;ch dob&aacute;ch byla pivoňka obdivov&aacute;na nejenom pro svoje velk&eacute; květy, ale&nbsp;předev&scaron;&iacute;m pro svoje l&eacute;čebn&eacute; &uacute;činky. Až do&nbsp;konce 19. stolet&iacute;, byly tyto rostliny s&aacute;zeny k&nbsp;domům ne jako dekorace, n&yacute;brž aby&nbsp;dům chr&aacute;nily před zl&yacute;mi silami. V&scaron;echny č&aacute;sti rostliny se použ&iacute;valy na&nbsp;v&yacute;robu l&eacute;čiv od&nbsp;kořenů až po&nbsp;semena, kter&aacute; sloužila tak&eacute; jako ochucovadlo. Květy se použ&iacute;valy a&nbsp;st&aacute;le použ&iacute;vaj&iacute; k&nbsp;v&yacute;robě parf&eacute;mů, jinde na&scaron;li uplatněn&iacute; k&nbsp;barven&iacute; l&aacute;tek a&nbsp;pap&iacute;ru. Nyn&iacute; se v&scaron;ak pěstuj&iacute; předev&scaron;&iacute;m pro okrasu. Kr&aacute;sou květy pivoněk mohou někter&yacute;m připom&iacute;nat rozkvetl&eacute; růže. Existuje na&nbsp;35&nbsp;druhů pivoněk, vět&scaron;ina z&nbsp;nich m&aacute; dužnat&eacute; hl&iacute;znat&eacute; kořeny. Rostlina roste v&nbsp;trsech. Květy mohou b&yacute;t jednoduch&eacute;, polopln&eacute; nebo pln&eacute;. A&nbsp;nejčastěji nesou nejrůzněj&scaron;&iacute; odst&iacute;ny b&iacute;l&eacute;, růžov&eacute;, červen&eacute; a&nbsp;žlut&eacute;. Kožovit&eacute; listy jsou trojd&iacute;ln&eacute; a&nbsp;mohou b&yacute;t různě zubat&eacute;. Listy jsou dekorativn&iacute; před zač&aacute;tkem kveten&iacute; i&nbsp;po odkvětu, kdy se vytv&aacute;ř&iacute; plody obsahuj&iacute;c&iacute; čern&aacute; nebo červen&aacute; semena. Po&nbsp;odkvětu stonky seřez&aacute;v&aacute;me.</p>', 13, 1),
(20, 'Paeonia lactiflora', 'img/flowers/32569-1179737450_01.jpg', '<p><em><strong>Paeonia lactiflora</strong></em>&nbsp;(<strong>Chinese peony</strong>&nbsp;or&nbsp;<strong>common garden peony</strong>) is a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Species\">species</a>&nbsp;of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Herbaceous_plant\">herbaceous</a>&nbsp;<a href=\"https://en.wikipedia.org/wiki/Perennial_plant\">perennial</a>&nbsp;<a href=\"https://en.wikipedia.org/wiki/Flowering_plant\">flowering plant</a>&nbsp;in the&nbsp;<a href=\"https://en.wikipedia.org/wiki/Family_(biology)\">family</a>&nbsp;Paeoniaceae,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Native_plant\">native</a>&nbsp;to central and eastern Asia from eastern Tibet across northern China to eastern Siberia.</p>', 13, 1),
(21, 'Pink Hawaiian Coral', 'img/flowers/1115-1179737450_01.jpg', '<p><strong>Bloom time:</strong>&nbsp;May-June<br /><strong>Exposure:</strong>&nbsp;5-6 hours of full sun per day<br /><strong>Planting depth:</strong>&nbsp;&frac12;&rdquo; in warm zones; 2&rdquo; in cool zones<br /><strong>Fast Facts:</strong></p><ul><li>Can flourish and flower in the same spot for 50 years or more</li><li>Stems die back to the ground each winter and reemerge in spring</li><li>Low maintenance</li><li>Require little water</li><li>Naturally resist most pests</li><li>Aren&rsquo;t bothered by deer</li><li>30+ species including&nbsp;<em>Paeonia officinalis</em>&nbsp;and&nbsp;<em>Paeonia lactiflora</em></li><li>Need little fertilizer when grown in rich soil</li><li>Require good drainage</li></ul>', 13, 1),
(22, 'Garden Treasure', 'img/flowers/6471-1179737450_01.jpg', '<p><strong>Bloom time:</strong>&nbsp;June<br /><strong>Exposure:</strong>&nbsp;5-6 hours of full sun per day<br /><strong>Planting depth:</strong>&nbsp;&frac12;&rdquo; in warm zones, 1 &frac12;&rdquo; in cooler zones<br /><strong>Fast Facts:</strong></p><ul><li>Hybrid plants that blend the perennial habit of herbaceous peonies with the sturdiness, giant flowers, and color range of tree peonies</li><li>Herbaceous in nature, dying back to the ground when winter comes</li><li>Often called Itoh peonies</li><li>Attractive foliage through summer and into fall</li><li>Good at the front of the border because they are shorter than tree and herbaceous peonies</li><li>Showy and don&rsquo;t need staking</li></ul>', 13, 1);

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
(13, 'test@test.cz', '$2y$10$Jegs7MkAIu51BgEXdTmHGec31biHx99uukZUSyw5dOy1Kd2.qcpn6', 'Jan Vorlíček', 'admin');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`idevaluation`);

--
-- Klíče pro tabulku `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pro tabulku `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `idevaluation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pro tabulku `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
