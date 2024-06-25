-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 24 Haz 2024, 13:27:52
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `oyun`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `locations`
--

INSERT INTO `locations` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Mersin', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `score`, `location_id`, `created_at`) VALUES
(1, 3, 5000, 1, '2024-06-24 13:23:15'),
(2, 4, 300, 1, '2024-06-24 13:23:25'),
(3, 6, 500000, 1, '2024-06-24 13:24:39'),
(7, 9, 3200, 1, '2024-06-24 13:25:49'),
(8, 7, 25000, 1, '2024-06-24 13:26:14'),
(9, 10, 2, 1, '2024-06-24 13:27:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(3, 'Adanalı01', 'mersin33', 'Adanalı01@b.c', '2024-06-24 13:22:36'),
(4, 'mersin', '$2y$10$AuPfk059Y8f6dsQe5FU3h.kRgk1lrNcf9.azKLD3BgD71Spf9Y2JC', 'zydmrlp92@gmail.com', '2024-06-24 13:07:15'),
(6, 'demo', '$2y$10$D1QcJUrSp8hzzU0uswJbjeQQ7ksLqKrDOOBUMLTUXlu85Nn4EQfki', 'demo@demo.com', '2024-06-24 13:23:55'),
(7, 'scream', '$2y$10$EQ9Qo1sYFckfL2IYeKVysOKHkqgXc4m36PUfAV2c0OZaBOnZgZ8w2', 's@ds.c', '2024-06-24 13:25:09'),
(9, '1', '$2y$10$NEH/whmK55CCgzUb3ryIzeWa5LtMTg0k/nkkbycfPJIfplYpFFd7a', '1@d.c', '2024-06-24 13:25:24'),
(10, '2', '$2y$10$2VUF/SURhNXnCBqxCMUsVuCBZBiKKIcrC7jcY18CQPQJHa96VFveq', '2@2.c', '2024-06-24 13:26:50');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
