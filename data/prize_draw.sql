-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 15 2019 г., 08:03
-- Версия сервера: 5.7.21
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `prize_draw`
--

-- --------------------------------------------------------

--
-- Структура таблицы `prize`
--

DROP TABLE IF EXISTS `prize`;
CREATE TABLE IF NOT EXISTS `prize` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prize` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prize`
--

INSERT INTO `prize` (`id`, `prize`) VALUES
(1, 'Prize 1'),
(2, 'Prize 2'),
(3, 'Prize 3'),
(4, 'Prize 4'),
(5, 'Prize 5'),
(6, 'Prize 6'),
(7, 'Prize 7');

-- --------------------------------------------------------

--
-- Структура таблицы `prize_type`
--

DROP TABLE IF EXISTS `prize_type`;
CREATE TABLE IF NOT EXISTS `prize_type` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prize_type`
--

INSERT INTO `prize_type` (`id`, `type`) VALUES
(1, 'Money'),
(2, 'Bonus'),
(3, 'Item');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'user@email.com', '$2y$10$IOUg/aTMTlMfxv0q3YL.pu4upa.onaH/I0Vhj4uD1haQi/5YmMf7q');

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sum` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wallet`
--

INSERT INTO `wallet` (`id`, `sum`, `user_id`) VALUES
(1, '0.00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
