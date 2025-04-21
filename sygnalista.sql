-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Kwi 2024, 18:35
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sygnalista`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `nazwaUz` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `uprawnienia` int(11) NOT NULL,
  `czyAnonim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id`, `imie`, `nazwisko`, `email`, `nazwaUz`, `haslo`, `uprawnienia`, `czyAnonim`) VALUES
(1, '', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj`
--

CREATE TABLE `rodzaj` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(90) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rodzaj`
--

INSERT INTO `rodzaj` (`id`, `nazwa`) VALUES
(1, 'zamówienia publiczne'),
(2, 'ochrona środowiska'),
(3, 'zdrowie psychiczne'),
(4, 'ochrona prywatności i danych osobowych'),
(5, 'bezpieczeństwo sieci i systemów teleinformatycznych');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozpatrzenia`
--

CREATE TABLE `rozpatrzenia` (
  `id` int(11) NOT NULL,
  `plik` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `zgloszenie_id` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozpatrzenialog`
--

CREATE TABLE `rozpatrzenialog` (
  `id` int(11) NOT NULL,
  `rozp_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `log` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stan`
--

CREATE TABLE `stan` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `stan`
--

INSERT INTO `stan` (`id`, `nazwa`) VALUES
(1, 'nowe'),
(2, 'w trakcie obsługi'),
(3, 'zakończone');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zglaszajacy`
--

CREATE TABLE `zglaszajacy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(35) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zglaszajacy`
--

INSERT INTO `zglaszajacy` (`id`, `nazwa`) VALUES
(1, 'pracownik'),
(2, 'kandydat do pracy'),
(3, 'nie chcę podawać'),
(4, 'emeryt'),
(5, 'kontrahent'),
(6, 'inna osoba');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `id` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `kodDok` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `tytul` varchar(75) COLLATE utf8_polish_ci NOT NULL,
  `dzial` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(800) COLLATE utf8_polish_ci NOT NULL,
  `plik` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `rodzaj_id` int(11) NOT NULL,
  `konto_id` int(11) NOT NULL,
  `zglaszajacy_id` int(11) NOT NULL,
  `uczestnicy` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rodzaj`
--
ALTER TABLE `rodzaj`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rozpatrzenia`
--
ALTER TABLE `rozpatrzenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rozpatrzenialog`
--
ALTER TABLE `rozpatrzenialog`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `stan`
--
ALTER TABLE `stan`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zglaszajacy`
--
ALTER TABLE `zglaszajacy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `rodzaj`
--
ALTER TABLE `rodzaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `rozpatrzenia`
--
ALTER TABLE `rozpatrzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rozpatrzenialog`
--
ALTER TABLE `rozpatrzenialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `stan`
--
ALTER TABLE `stan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `zglaszajacy`
--
ALTER TABLE `zglaszajacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
