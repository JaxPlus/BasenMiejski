-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Kwi 2023, 09:46
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `basen`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `idNews` int(11) NOT NULL,
  `FK_idUser` int(11) NOT NULL,
  `newsTitle` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `creationDate` date NOT NULL,
  `sportEvent` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`idNews`, `FK_idUser`, `newsTitle`, `content`, `img`, `creationDate`, `sportEvent`) VALUES
(1, 1, 'Turniej Pływacki!', 'Ostatnio na naszym basenie odbył się turniej pływacki! Wszystkim zawodnikom dziękujemy za uczestnictwo a wygranym gratulujemy!', 'turniejPlywacki.jpg', '2023-03-02', 1),
(2, 1, 'Zmiana godzin otwarcia', 'Wydłużyliśmy pracę naszego basenu do 21! Dzięki temu możecie dłużej się bawić i pływać!', 'zmianaGodzin.jpg', '2023-03-02', 0),
(3, 1, 'Powiatowy turniej pływacki', 'W następnym tygodniu na naszym basenie odbędzie się pierwsza runda powiatowego turnieju pływackiego, więc z przykrością stwierdzamy, że wtedy basen będzie nieczynny, lecz zapraszamy w inne dni!', 'powiatowyTurniej.jpg', '2023-03-02', 1),
(16, 1, 'Nowe menu!', 'Specjalnie dla was wprowadziliśmy nowe słodkości do naszego menu! Musicie je zobaczyć!', 'przysmaki.jpg', '2023-04-18', 0),
(17, 1, 'Przeprowadzimy remont', 'W następnym miesiącu przeprowadzimy lekkie renowacje tu i tam, z tego powodu niektóre atrakcje mogą być wyłączone z użytku. Za wszelkie utrudnienia przepraszamy.', 'remont.jpg', '2023-04-18', 0),
(18, 7, 'Zakończenie turnieju!', 'Finały powiatowego turnieju już za nami, pełne emocji wyścigi były znakomite do oglądania! Gratulujemy wszystkim uczestnikom!', 'zakończenie.jpg', '2023-04-18', 1),
(19, 9, 'Kolejne zmiany w menu!', 'Tym razem chcemy was zachęcić do spróbowania naszego wegańskiego menu!', 'photo-1512621776951-a57141f2eefd.jpg', '2023-04-18', 0),
(20, 9, 'Wyciek!', 'Niestety pewne rury w naszym systemie się zniszczyły i wycieka z nich woda, więc basen zostanie chwilowo zamknięty. Za utrudnienia przepraszamy.', 'wyciek.jpg', '2023-04-18', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `FK_idUser` int(11) NOT NULL,
  `FK_idPass` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `price` double(5,2) NOT NULL,
  `numberOfTickets` smallint(6) NOT NULL,
  `numberOfReducedTickets` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `order`
--

INSERT INTO `order` (`idOrder`, `FK_idUser`, `FK_idPass`, `orderDate`, `price`, `numberOfTickets`, `numberOfReducedTickets`) VALUES
(72, 9, NULL, '2023-04-18', 46.00, 5, 2),
(73, 9, 4, '2023-04-18', 449.99, 0, 0),
(74, 9, NULL, '2023-04-18', 18.00, 2, 1),
(75, 9, 4, '2023-04-18', 449.99, 0, 0),
(76, 7, 3, '2023-04-18', 299.99, 0, 0),
(77, 7, 3, '2023-04-18', 299.99, 0, 0),
(78, 7, 4, '2023-04-18', 449.99, 0, 0),
(79, 7, NULL, '2023-04-18', 18.00, 2, 1),
(80, 7, 1, '2023-04-18', 200.99, 0, 0),
(81, 7, 2, '2023-04-18', 349.99, 0, 0),
(88, 8, NULL, '2023-04-18', 10.00, 1, 0),
(89, 8, 3, '2023-04-18', 299.99, 0, 0),
(90, 8, NULL, '2023-04-18', 20.00, 2, 0),
(91, 8, NULL, '2023-04-18', 20.00, 2, 0),
(92, 8, NULL, '2023-04-18', 20.00, 2, 0),
(93, 8, NULL, '2023-04-18', 20.00, 2, 0),
(94, 8, NULL, '2023-04-18', 20.00, 2, 0),
(95, 8, NULL, '2023-04-18', 20.00, 2, 0),
(96, 8, NULL, '2023-04-18', 20.00, 2, 0),
(97, 8, NULL, '2023-04-18', 20.00, 2, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pass`
--

CREATE TABLE `pass` (
  `idPass` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lenghtOfPass` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(40) NOT NULL,
  `priceOfPass` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `pass`
--

INSERT INTO `pass` (`idPass`, `name`, `lenghtOfPass`, `description`, `type`, `priceOfPass`) VALUES
(1, 'Karnet zwykły - pół roczny', '6 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie.', 'Bez trenera personalnego', 200.99),
(2, 'Karnet zwykły - całoroczny', '12 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie.', 'Bez trenera personalnego', 349.99),
(3, 'Karnet z trenerem - 6 miesięcy', '6 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie. Dodatkowo specjalnie wyćwiczony trener będzie nadzorował i pomagał w twoich ćwiczeniach.', 'Z trenerem personalnym', 299.99),
(4, 'Karnet z trenerem - całoroczny', '12 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie. Dodatkowo specjalnie wyćwiczony trener będzie nadzorował i pomagał w twoich ćwiczeniach.', 'Z trenerem personalnym', 449.99),
(17, 'Karnet z trenerem - 10 miesięcy', '10 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie. Dodatkowo specjalnie wyćwiczony trener będzie nadzorował i pomagał w twoich ćwiczeniach.', 'Z trenerem', 249.99),
(21, 'Karnet z trenerem - 10 miesięcyasd', '10 miesięcy', 'Ten karnet zezwala Ci na przychodzenie codziennie w dni otwarte basenu, o każdej godzinie. Dodatkowo specjalnie wyćwiczony trener będzie nadzorował i pomagał w twoich ćwiczeniach.', 'Z trenerem', 249.99);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `FK_idOrder` int(11) NOT NULL,
  `arrivalDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `ticket`
--

INSERT INTO `ticket` (`idTicket`, `FK_idOrder`, `arrivalDate`) VALUES
(89, 72, '2023-04-23'),
(90, 72, '2023-04-23'),
(91, 72, '2023-04-23'),
(92, 72, '2023-04-23'),
(93, 72, '2023-04-23'),
(94, 74, '2023-04-30'),
(95, 74, '2023-04-30'),
(96, 79, '2023-05-07'),
(97, 79, '2023-05-07'),
(100, 88, '2023-04-23'),
(101, 90, '2023-04-23'),
(102, 90, '2023-04-23'),
(103, 91, '2023-04-23'),
(104, 91, '2023-04-23'),
(105, 92, '2023-04-23'),
(106, 92, '2023-04-23'),
(107, 93, '2023-04-23'),
(108, 93, '2023-04-23'),
(109, 94, '2023-04-23'),
(110, 94, '2023-04-23'),
(111, 95, '2023-04-23'),
(112, 95, '2023-04-23'),
(113, 96, '2023-04-23'),
(114, 96, '2023-04-23'),
(115, 97, '2023-04-23'),
(116, 97, '2023-04-23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tel` int(9) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`idUser`, `firstName`, `lastName`, `password`, `email`, `tel`, `admin`) VALUES
(1, 'Jan', 'Greń', '$2y$10$pHQYjvn7O8ndvJokvnUuIOrDwVrR.QfJNbwsit.1q9s01kjKvGToO', 'gren@jan.com', 123456789, 1),
(7, 'Andrzej', 'Szary', '$2y$10$23sfo3d05iIIC22.ajSZ4.NNDUJXEAtphu4lLGsWGpzJSdU6KAdf2', 'szary@andrzej.com', 123456799, 1),
(8, 'Papryczek', 'Papryka', '$2y$10$/B6y3N9w7EoU2JqYQZEnU.qGDk.wX5uIGXb4/2YWvcPuBN5ZQJAd6', 'papryczek@gmail.com', 123456989, 0),
(9, 'Adam', 'Kozak', '$2y$10$NunzAK71M3eMScmm59q9TuChP.i1sVlazwiQ7npPmqOKwxvHgIkne', 'kozak@adam.com', 123459789, 1),
(10, 'Milena', 'Sampolska', '$2y$10$Hn0zEy4apm0lrWpAs.DKV.//tOFQjucmRaJr8dkG.WWlvokQ1w0xu', 'milena@gmail.com', 123496789, 0),
(11, 'Daria', 'Dariusia', '$2y$10$DmBVVxQT2GxUSOOe.gspmuiB7zmnuHlP11xkarutvbJIttdshEu8W', 'dariusia@gmail.com', 123956789, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idNews`),
  ADD KEY `FK_idUser` (`FK_idUser`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `FK_idUser` (`FK_idUser`),
  ADD KEY `order_ibfk_2` (`FK_idPass`);

--
-- Indeksy dla tabeli `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`idPass`);

--
-- Indeksy dla tabeli `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `FK_idOrder` (`FK_idOrder`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `idNews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `pass`
--
ALTER TABLE `pass`
  MODIFY `idPass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`FK_idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`FK_idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`FK_idPass`) REFERENCES `pass` (`idPass`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`FK_idOrder`) REFERENCES `order` (`idOrder`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
