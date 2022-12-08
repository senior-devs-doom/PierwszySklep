-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Cze 2021, 13:19
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mylashes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Psy'),
(2, 'Krety'),
(3, 'co tam jeszcze w kosmetykach?'),
(4, 'szminki?'),
(5, 'tipsy może jakieś'),
(6, 'Promocje'),
(7, 'Pozostałe'),
(8, 'Trawy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `dostepnosc` varchar(20) NOT NULL,
  `wysyłka` varchar(20) NOT NULL,
  `dostawa` varchar(20) NOT NULL,
  `producent` varchar(20) NOT NULL,
  `kodproduktu` varchar(20) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `dostepnosc`, `wysyłka`, `dostawa`, `producent`, `kodproduktu`, `opis`) VALUES
(0, 'Kortaderia pampasowa', '50.00', 'jeszcze z 5 kilo zos', '1 dzień', 'Dostawimy, dostawimy', 'Pani Beata', 'fd-g2gr2-fdsg-2332-d', 'Googlowałem trawe i taki gatunek wyskoczył pierwszy.'),
(1, 'Krecik', '6.66', 'Dziurze', 'Przekopie sie do 3 d', 'Dojdzie', 'Matka Natura z.o.o.', 'a-tam-gdzie-to-kreto', 'Taki tam czech, troglodyta i nudysta. Nie byłem więc nie wiem czy to czeski standard.'),
(2, 'Nasiona', '3.00', 'Zostało kilka mieszk', 'Pocztą, czyli nie ko', 'Pocztą, czyli pod do', 'Pani Beata', 'fd-g2gr2-fdsg-2332-d', 'Skończyły sie pomysły.'),
(3, 'Reksio', '0.00', 'duża ilość', '24 godziny', 'sam przyjdzie', 'Matka Natura z.o.o.', 'PL-HAU-HAU-0P12-001', 'Reksio to taki piesek co sobie chodzi i głównie zaczepia ludzi, ogólnie jest jedyny durny w kreskówce żeby pomagać zwierzom na farmie. Za to w swoich grach przygodowych jest prawdziwy killer. Serio, raz kolesia porwali do świata czarodziejów, i koleś pozamieniał wszystkich których mu wskazali w żaby, nic nie pytał po co ma skazywać wrogów na wieczność jako żabol, nie pytał co oni złego zrobili, po prostu łup łup łup, pozostawił same zgliszcza i wrócił do domu jak gdyby nigdy nic.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_kategorie`
--

CREATE TABLE `produkty_kategorie` (
  `id` int(11) NOT NULL,
  `produktyid` int(11) NOT NULL,
  `kategorieid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty_kategorie`
--

INSERT INTO `produkty_kategorie` (`id`, `produktyid`, `kategorieid`) VALUES
(1, 0, 8),
(2, 2, 8),
(3, 3, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `Imie i Nazwisko` text DEFAULT NULL,
  `produkty` text DEFAULT NULL,
  `zaplata` decimal(10,2) DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Miasto` text DEFAULT NULL,
  `Ulica` text DEFAULT NULL,
  `Numer Domu` text DEFAULT NULL,
  `Kod Pocztowy` text DEFAULT NULL,
  `data` date DEFAULT NULL,
  `Stan` text DEFAULT 'niewykonane'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `Imie i Nazwisko`, `produkty`, `zaplata`, `Email`, `Miasto`, `Ulica`, `Numer Domu`, `Kod Pocztowy`, `data`, `Stan`) VALUES
(1, 'nazwa', 'produkty', '0.00', 'k24_email', 'k24_miasto', 'k24_ulica', 'k24_numer_dom', 'kod_pocztowy', '2021-06-13', ''),
(4, 'asdf sdaf', 'Krecik sztuk 2;Reksio sztuk 5;', '13.32', 'k.chruzik@tlen.pl', 'asdf', 'asdf', 'sadf', '22-222', '2021-06-13', ''),
(5, 'Karol Chruzik', 'Kortaderia pampasowa sztuk 69;Krecik sztuk 2;Nasiona sztuk 20;Reksio sztuk 5;', '3523.32', 'k.chruzik@gmail.com', 'Sosnowiec', 'Wiejska', '57', '41-216', '2021-06-13', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty_kategorie`
--
ALTER TABLE `produkty_kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

--
-- AUTO_INCREMENT dla tabeli `produkty_kategorie`
--
ALTER TABLE `produkty_kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
