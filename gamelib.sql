-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Paź 2017, 13:18
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gamelib`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gry`
--

CREATE TABLE `gry` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text,
  `icon` text,
  `author` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `gry`
--

INSERT INTO `gry` (`id`, `name`, `icon`, `author`) VALUES
(1, 'Call of Duty', 'https://assets.vg247.com/current//2016/06/call_of_duty_infinite_warfare_possible_new_art_1.jpg', 'Infinityward'),
(2, 'Dota2', 'http://www.gry-online.pl/galeria/gry13/506128520.jpg', 'valve'),
(3, 'Pay Day 2', 'https://www.quneplay.de/wp-content/uploads/2015/09/payday-2-cover.jpg', 'Overkill'),
(4, 'Ghost Recon:WL', 'https://upload.wikimedia.org/wikipedia/en/b/b9/Ghost_Recon_Wildlands_cover_art.jpg', 'Ubisoft'),
(5, 'The Division', 'http://media.moddb.com/images/games/1/39/38388/Tom_Clancys_The_Division_Box.jpg', 'Ubisoft'),
(6, 'Arma3', 'https://vignette2.wikia.nocookie.net/armedassault/images/1/13/Arma-3-cover.jpg/revision/latest?cb=20140704174436', 'bohemia interactive'),
(7, 'StarCraft 2: WoL', 'https://upload.wikimedia.org/wikipedia/en/2/20/StarCraft_II_-_Box_Art.jpg', 'Blizzard'),
(8, 'Battlefield 3', '\"https://upload.wikimedia.org/wikipedia/en/6/69/Battlefield_3_Game_Cover.jpg\"', 'DICE');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text,
  `pass` text,
  `email` text,
  `gry_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `gry_id`) VALUES
(1, 'asdfg', 'qazwsx', 'asdfg@mail.pl', '2 3 4');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `gry`
--
ALTER TABLE `gry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
