-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 jun 2020 om 18:34
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelcalifornia`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `base_price` decimal(5,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `base_price`, `quantity`) VALUES
(1, 'Single Room', '50.00', 9),
(2, 'Double Room', '100.00', 5),
(3, 'Family Room', '200.00', 5),
(4, 'Luxury Room', '500.00', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `city` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `price_periods`
--

CREATE TABLE `price_periods` (
  `id` int(11) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `cagetory_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `customers_id` int(11) NOT NULL,
  `rooms_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `designation` varchar(10) NOT NULL,
  `categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `floor`, `designation`, `categories_id`) VALUES
(1, 4, 1, '1 - 4', 1),
(2, 2, 1, '1 - 2', 1),
(3, 3, 1, '1 - 3', 2),
(4, 4, 2, '2 - 4', 2),
(5, 5, 3, '3 - 5', 2),
(6, 5, 2, '2 - 5', 3),
(7, 3, 2, '2 - 3', 3),
(8, 6, 4, '4 - 6', 3),
(9, 1, 1, '1 - 1', 3),
(10, 5, 4, '4 - 5', 3),
(11, 2, 2, '2 - 2', 3),
(12, 2, 3, '3 - 2', 4),
(13, 4, 4, '4 - 4', 4),
(14, 3, 4, '4 - 3', 4),
(15, 2, 4, '4 - 2', 4),
(16, 1, 4, '4 - 1', 4),
(17, 4, 3, '3 - 4', 1),
(18, 3, 3, '3 - 3', 1),
(19, 1, 2, '2 - 1', 1),
(20, 5, 1, '1 - 5', 2),
(21, 1, 3, '3 - 1', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`) VALUES
(3, 'admin', 'admin@admin.com', '$2y$10$yjANdKgR1xGeLBqBP2uf7.zR2p7Goo7Mwg1w.ZCXJjCTKVR2cz0BC');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `price_periods`
--
ALTER TABLE `price_periods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cagetory_id` (`cagetory_id`);

--
-- Indexen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`rooms_id`),
  ADD KEY `customer_id` (`customers_id`);

--
-- Indexen voor tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`categories_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`) USING HASH;

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `price_periods`
--
ALTER TABLE `price_periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `price_periods`
--
ALTER TABLE `price_periods`
  ADD CONSTRAINT `price_periods_ibfk_1` FOREIGN KEY (`cagetory_id`) REFERENCES `categories` (`id`);

--
-- Beperkingen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `room_id` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`);

--
-- Beperkingen voor tabel `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
