-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 May 2024, 15:44:33
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `english_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kelimeler`
--

CREATE TABLE `kelimeler` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `kelime` varchar(30) NOT NULL,
  `ceviri` varchar(30) NOT NULL,
  `cumle1` varchar(50) DEFAULT NULL,
  `cumle2` varchar(50) DEFAULT NULL,
  `cumle3` varchar(50) DEFAULT NULL,
  `db_image` varchar(600) DEFAULT NULL,
  `correct_count` int(11) NOT NULL DEFAULT 0,
  `last_correct_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `next_test_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kelimeler`
--

INSERT INTO `kelimeler` (`id`, `user_id`, `kelime`, `ceviri`, `cumle1`, `cumle2`, `cumle3`, `db_image`, `correct_count`, `last_correct_date`, `created_at`, `next_test_date`) VALUES
(60, '2495436', 'milk', 'süt', 'sütsüt', '', '', 'images/picture.png', 6, '2024-05-19 20:32:32', '2024-05-19 17:29:02', '2024-05-23'),
(80, '2495436', 's', 's', '', '', '', NULL, 1, NULL, '2024-05-23 07:57:58', '2024-05-24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `word_count` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `password`, `created_at`, `word_count`) VALUES
('2495436', 'admin', 'admin@admin.com', '123123', '2024-05-19 17:28:42', 10);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kelimeler`
--
ALTER TABLE `kelimeler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frgn` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kelimeler`
--
ALTER TABLE `kelimeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `kelimeler`
--
ALTER TABLE `kelimeler`
  ADD CONSTRAINT `frgn` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
