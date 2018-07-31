-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 31 2018 г., 14:43
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
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`type_id`, `name`, `price`, `comment`) VALUES
(7, 'HTC', 1200, 'HTC Aspire'),
(8, 'tablet Asus', 5000, 'tablet Asus for users'),
(10, 'Phillips', 17000, 'TV Phillips 12000 '),
(6, 'Sony', 750, 'Sony DSC-W830 Digital Camera'),
(6, 'Nikon', 1250, 'Refurbished Nikon COOLPIX A900 '),
(9, 'Acer', 12000, 'Acer Aspire 3-000'),
(10, 'All', 1200, 'All tovars'),
(9, 'Macbook', 2300, 'Mac book PRO  '),
(7, 'Iphone 5s', 2500, 'Iphone 5s'),
(10, 'HP', 2300, 'HP is the best solution for you'),
(9, 'MacBook Pro', 3000, 'MacBook Pro \r\nExcellent choice'),
(10, 'iMac', 4500, 'iMac - very nice'),
(10, 'Watch', 340, 'Apple watch very nice'),
(7, 'Samsung', 1500, 'Galaxy S9');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
