-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Sty 2019, 21:58
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `personal_budget`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addSetupRegisterUser` (IN `userID` INT)  BEGIN
    DECLARE i int DEFAULT 1;
    WHILE i <= 4 DO
        INSERT INTO income_categories_users VALUES (i, userID);
        SET i = i + 1;
    END WHILE;
    SET i = 1;
    WHILE i <= 17 DO
        INSERT INTO expense_categories_users VALUES (i, userID);
        SET i = i + 1;
    END WHILE;
    SET i = 1;
    WHILE i <= 3 DO
        INSERT INTO payment_methods_users VALUES (i, userID);
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `expenseID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `expenseAmount` decimal(10,2) DEFAULT NULL,
  `expenseDate` date DEFAULT NULL,
  `expenseCategoryID` int(11) NOT NULL,
  `paymentMethodID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expense_categories`
--

CREATE TABLE `expense_categories` (
  `expenseCategoryID` int(11) NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `expense_categories`
--

INSERT INTO `expense_categories` (`expenseCategoryID`, `category`) VALUES
(1, 'Jedzenie'),
(2, 'Mieszkanie'),
(3, 'Transport'),
(4, 'Telekomunikacja'),
(5, 'Opieka zdrowotna'),
(6, 'Ubranie'),
(7, 'Higiena'),
(8, 'Dzieci'),
(9, 'Rozrywka'),
(10, 'Wycieczka'),
(11, 'Szkolenia'),
(12, 'Książki'),
(13, 'Oszczędności'),
(14, 'Na złotą jesień, czyli emeryturę'),
(15, 'Spłata długów'),
(16, 'Darowizna'),
(17, 'Inne wydatki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expense_categories_users`
--

CREATE TABLE `expense_categories_users` (
  `expenseCategoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `expense_categories_users`
--

INSERT INTO `expense_categories_users` (`expenseCategoryID`, `userID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expense_comments`
--

CREATE TABLE `expense_comments` (
  `expenseID` int(11) NOT NULL,
  `comment` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes`
--

CREATE TABLE `incomes` (
  `incomeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `amountIncome` decimal(10,2) DEFAULT NULL,
  `dateIncome` date DEFAULT NULL,
  `incomeCategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `incomes`
--

INSERT INTO `incomes` (`incomeID`, `userID`, `amountIncome`, `dateIncome`, `incomeCategoryID`) VALUES
(2, 4, '520.00', '2018-08-06', 3),
(4, 2, '3320.00', '2018-10-08', 1),
(5, 12, '3120.00', '2019-01-01', 4),
(6, 4, '3120.00', '2018-10-08', 1),
(7, 1, '3120.00', '2019-01-06', 3),
(8, 4, '3120.00', '2016-05-22', 3),
(9, 4, '310.00', '2016-05-22', 2),
(10, 4, '30.00', '2016-05-22', 3),
(11, 4, '300.00', '2016-05-22', 4),
(12, 4, '100.00', '2016-05-22', 4),
(13, 2, '100.00', '2017-05-22', 4),
(14, 1, '300.00', '2017-05-22', 1),
(15, 2, '2200.00', '2017-05-22', 1),
(16, 2, '200.00', '2017-05-22', 4),
(17, 2, '100.00', '2017-05-22', 3),
(18, 1, '100.00', '2017-05-22', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `income_categories`
--

CREATE TABLE `income_categories` (
  `incomeCategoryID` int(11) NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `income_categories`
--

INSERT INTO `income_categories` (`incomeCategoryID`, `category`) VALUES
(1, 'Wynagrodzenie'),
(2, 'Odsetki bankowe'),
(3, 'Sprzedaż na allegro'),
(4, 'Inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `income_categories_users`
--

CREATE TABLE `income_categories_users` (
  `incomeCategoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `income_categories_users`
--

INSERT INTO `income_categories_users` (`incomeCategoryID`, `userID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `income_comments`
--

CREATE TABLE `income_comments` (
  `incomeID` int(11) NOT NULL,
  `comment` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods`
--

CREATE TABLE `payment_methods` (
  `paymentMethodID` int(11) NOT NULL,
  `paymentMethod` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `payment_methods`
--

INSERT INTO `payment_methods` (`paymentMethodID`, `paymentMethod`) VALUES
(1, 'Gotówka'),
(2, 'Karta debetowa'),
(3, 'Karta kredytowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_users`
--

CREATE TABLE `payment_methods_users` (
  `paymentMethodID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `payment_methods_users`
--

INSERT INTO `payment_methods_users` (`paymentMethodID`, `userID`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userID`, `name`, `email`) VALUES
(1, 'Ala', 'ala@gmail.com'),
(2, 'Ola', 'ola@gmail.com'),
(3, 'Ola', 'ola1@gmail.com'),
(4, 'Piotr', 'piotr@gmail.com'),
(5, 'Mateusz', 'mateusz@gmail.com'),
(6, 'Jan', 'jan@gmail.com'),
(7, 'Iza', 'iza@gmail.com'),
(8, 'Ela', 'ela@gmail.com'),
(9, 'Ula', 'ula@gmail.com'),
(10, 'Iga', 'iga@gmail.com'),
(11, 'Szymon', 'szymon@gmail.com'),
(12, 'Wojtek', 'wojtek@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_password`
--

CREATE TABLE `user_password` (
  `password` varchar(20) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `user_password`
--

INSERT INTO `user_password` (`password`, `userID`) VALUES
('111', 1),
('qwe', 2),
('asd', 3),
('zxc', 4),
('qaz', 5),
('wsx', 6),
('edc', 7),
('zzz', 8),
('xxx', 9),
('ccc', 10),
('vvv', 11),
('bbb', 12);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenseID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `expenseCategoryID` (`expenseCategoryID`),
  ADD KEY `paymentMethodID` (`paymentMethodID`);

--
-- Indeksy dla tabeli `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`expenseCategoryID`);

--
-- Indeksy dla tabeli `expense_categories_users`
--
ALTER TABLE `expense_categories_users`
  ADD PRIMARY KEY (`expenseCategoryID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indeksy dla tabeli `expense_comments`
--
ALTER TABLE `expense_comments`
  ADD PRIMARY KEY (`expenseID`);

--
-- Indeksy dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`incomeID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `incomeCategoryID` (`incomeCategoryID`);

--
-- Indeksy dla tabeli `income_categories`
--
ALTER TABLE `income_categories`
  ADD PRIMARY KEY (`incomeCategoryID`);

--
-- Indeksy dla tabeli `income_categories_users`
--
ALTER TABLE `income_categories_users`
  ADD PRIMARY KEY (`incomeCategoryID`,`userID`),
  ADD KEY `userIDuserIDuserIDuserID` (`userID`);

--
-- Indeksy dla tabeli `income_comments`
--
ALTER TABLE `income_comments`
  ADD PRIMARY KEY (`incomeID`);

--
-- Indeksy dla tabeli `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`paymentMethodID`);

--
-- Indeksy dla tabeli `payment_methods_users`
--
ALTER TABLE `payment_methods_users`
  ADD PRIMARY KEY (`paymentMethodID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indeksy dla tabeli `user_password`
--
ALTER TABLE `user_password`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `users_userID_fk` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `expenseCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `incomes`
--
ALTER TABLE `incomes`
  MODIFY `incomeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `income_categories`
--
ALTER TABLE `income_categories`
  MODIFY `incomeCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `paymentMethodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`expenseCategoryID`) REFERENCES `expense_categories` (`expenseCategoryID`),
  ADD CONSTRAINT `expenses_ibfk_3` FOREIGN KEY (`paymentMethodID`) REFERENCES `payment_methods` (`paymentMethodID`);

--
-- Ograniczenia dla tabeli `expense_categories_users`
--
ALTER TABLE `expense_categories_users`
  ADD CONSTRAINT `expense_categories_users_ibfk_1` FOREIGN KEY (`expenseCategoryID`) REFERENCES `expense_categories` (`expenseCategoryID`),
  ADD CONSTRAINT `expense_categories_users_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ograniczenia dla tabeli `expense_comments`
--
ALTER TABLE `expense_comments`
  ADD CONSTRAINT `expense_comments_ibfk_1` FOREIGN KEY (`expenseID`) REFERENCES `expenses` (`expenseID`);

--
-- Ograniczenia dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `incomes_ibfk_2` FOREIGN KEY (`incomeCategoryID`) REFERENCES `income_categories` (`incomeCategoryID`);

--
-- Ograniczenia dla tabeli `income_categories_users`
--
ALTER TABLE `income_categories_users`
  ADD CONSTRAINT `income_categories_users_ibfk_1` FOREIGN KEY (`incomeCategoryID`) REFERENCES `income_categories` (`incomeCategoryID`),
  ADD CONSTRAINT `income_categories_users_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ograniczenia dla tabeli `income_comments`
--
ALTER TABLE `income_comments`
  ADD CONSTRAINT `income_comments_ibfk_1` FOREIGN KEY (`incomeID`) REFERENCES `incomes` (`incomeID`);

--
-- Ograniczenia dla tabeli `payment_methods_users`
--
ALTER TABLE `payment_methods_users`
  ADD CONSTRAINT `payment_methods_users_ibfk_1` FOREIGN KEY (`paymentMethodID`) REFERENCES `payment_methods` (`paymentMethodID`),
  ADD CONSTRAINT `payment_methods_users_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ograniczenia dla tabeli `user_password`
--
ALTER TABLE `user_password`
  ADD CONSTRAINT `users_userID_fk` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
