-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 29 2015 г., 21:21
-- Версия сервера: 5.1.37
-- Версия PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kassa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(200) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `xiz_name` varchar(200) NOT NULL,
  `doctors` varchar(200) NOT NULL,
  `navbat` int(11) NOT NULL,
  `xizmat_type` text NOT NULL,
  `t_y` varchar(20) NOT NULL,
  `manzil` varchar(200) NOT NULL,
  `t_pul` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Дамп данных таблицы `client`
--


-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(200) NOT NULL,
  `xiz_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `oxir_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `doctors`
--


-- --------------------------------------------------------

--
-- Структура таблицы `xizmatlar`
--

CREATE TABLE IF NOT EXISTS `xizmatlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xizmat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `xizmatlar`
--


-- --------------------------------------------------------

--
-- Структура таблицы `xizmat_type`
--

CREATE TABLE IF NOT EXISTS `xizmat_type` (
  `xiz_name_id` int(11) NOT NULL,
  `xizmat_type` varchar(200) NOT NULL,
  `xizmat_type_id` int(11) NOT NULL,
  `narxi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `xizmat_type`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
