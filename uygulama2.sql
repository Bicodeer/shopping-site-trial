-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Oca 2020, 17:21:40
-- Sunucu sürümü: 10.4.8-MariaDB
-- PHP Sürümü: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `uygulama2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `firma`
--

CREATE TABLE `firma` (
  `firma_id` int(11) UNSIGNED NOT NULL,
  `firma_adi` varchar(200) NOT NULL,
  `firma_tel` varchar(15) NOT NULL,
  `firma_mail` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `firma`
--

INSERT INTO `firma` (`firma_id`, `firma_adi`, `firma_tel`, `firma_mail`, `user_id`) VALUES
(2, 'İnosis Yazılım', '05422681450', 'gamze@gmail.com', 1),
(3, 'Benli Market', '5423658792', 'benli@info.com', 1),
(4, 'Recep Market', '05423698521', 'recep@market.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(20) NOT NULL,
  `kategori_adi` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_adi`, `user_id`) VALUES
(1, 'Temizlik Ürünleri', 1),
(3, 'Kozmetikler', 1),
(4, 'Baklagiller', 1),
(5, 'Kuruyemiş', 1),
(6, 'Et Ürünleri', 1),
(7, 'Meyve', 1),
(8, 'Sebze', 1),
(9, 'İçecek', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `sepet_id` int(50) NOT NULL,
  `urunler_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`sepet_id`, `urunler_id`, `user_id`) VALUES
(11, 3, 1),
(12, 5, 1),
(13, 8, 1),
(14, 4, 1),
(15, 6, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urunler_id` int(20) NOT NULL,
  `urun_adi` varchar(50) NOT NULL,
  `urun_yolu` varchar(50) NOT NULL,
  `aciklama` varchar(100) DEFAULT NULL,
  `kategori_id` int(20) DEFAULT NULL,
  `fiyat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urunler_id`, `urun_adi`, `urun_yolu`, `aciklama`, `kategori_id`, `fiyat`) VALUES
(3, 'Deterjan', '../images/indir.jpg', 'Toz Deterjan', 1, '25'),
(4, 'Nar', '../images/nar.png', 'Nar', 7, '12'),
(5, 'Barbunya', '../images/barbunya.png', 'Barbunya', 4, '8'),
(6, 'Dana Et', '../images/et.png', 'Dana Et', 6, '60'),
(7, 'Kola', '../images/kola.png', 'Kola', 9, '5.99'),
(8, 'Dana Sucuk', '../images/sucuk.png', 'Dana Sucuk', 6, '39.99'),
(9, 'Kuruyemiş', '../images/kuruyemiş.png', 'Kuruyemiş', 5, '60');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_log`
--

CREATE TABLE `user_log` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `user_log`
--

INSERT INTO `user_log` (`user_id`, `username`, `password`) VALUES
(1, 'gamze', 'gamze1234');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`firma_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`sepet_id`),
  ADD KEY `urunler_id` (`urunler_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urunler_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Tablo için indeksler `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `firma`
--
ALTER TABLE `firma`
  MODIFY `firma_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `sepet_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urunler_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `urunler_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
