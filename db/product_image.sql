-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 31 2018 г., 15:05
-- Версия сервера: 10.0.32-MariaDB-0+deb8u1
-- Версия PHP: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kostenko_anton`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_image`
--

INSERT INTO `product_image` (`product_id`, `image_path`) VALUES
(331, 'images/Camera_sony.jpg'),
(332, 'images/Camera_Nikon.png'),
(1, 'images/Phone_htc.jpg'),
(3, 'images/Tablet_asus.png'),
(330, 'images/TV_Phillips.jpg'),
(333, 'images/Acer.jpeg'),
(334, 'uploads/images/clothe.jpg'),
(334, 'uploads/images/asics_1.jpg'),
(334, 'uploads/images/asics_2.jpg'),
(335, 'uploads/images/30026842b.jpg'),
(336, 'uploads/images/iphone-5s.jpg'),
(338, 'uploads/images/HP8000.png'),
(339, 'uploads/images/339392-apple-macbook-pro-15-inch-2013.jpg'),
(340, 'uploads/images/apple-imac-27-core-i5-3-1ghz-mc814rs-a.jpg'),
(341, 'uploads/images/42-alu-silver-sport-white-s1-grid.jpg'),
(341, 'uploads/images/Best-Apple-Watch-apps-have-your-Watch-achieve-its-full-potential.jpg'),
(341, 'uploads/images/X-Doria_Defense_Edge_Apple_Watch__RoseGold_Lavender_Hero.jpg'),
(343, 'uploads/images/0914-GI-GS9-PDP-Front-Blue.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
