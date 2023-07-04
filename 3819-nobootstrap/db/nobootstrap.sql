-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 05 2022 г., 11:18
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nobootstrap`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, '111'),
(6, 'asdfasfaef'),
(4, 'fdsfsdf'),
(5, 'gfdgdfgd'),
(3, 'sfsdfsd');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` enum('Новая','На рассмотрении','Выполнена') NOT NULL DEFAULT 'Новая',
  `categoryId` int(11) NOT NULL,
  `time` timestamp NOT NULL,
  `description` text NOT NULL,
  `photoPath` varchar(255) NOT NULL,
  `photoBefore` varchar(50) NOT NULL,
  `photoAfter` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `userId`, `name`, `status`, `categoryId`, `time`, `description`, `photoPath`, `photoBefore`, `photoAfter`) VALUES
(1, 2, '555', 'Новая', 2, '2022-02-04 12:20:32', '555', 'D:\\OSPanel\\domains\\3819-nobootstrap\\php\\..\\img\\95e226c812ef5f457ca7f5f3cf61045f\\', 'before.PNG', NULL),
(2, 2, 'rewrwe', 'Новая', 6, '2022-02-04 12:22:29', 'ewrewrw', 'f6b5ad73f7b442f693dff1fb3575fec9', 'before.PNG', NULL),
(3, 2, 'gfdgdfgdf', 'Новая', 3, '2022-02-04 12:48:47', 'gfdgfdg', '51b5432f5afb2f48b346b942204128a5', 'before.PNG', NULL),
(4, 2, 'hdhsdh', 'Новая', 3, '2022-02-04 12:49:11', 'hgdfhsh', '4368e1351c34e9a23bb5f733fd23c2aa', 'before.PNG', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `email`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 1),
(2, 'user', 'user', 'user', 'user', 2),
(3, 'ывапвыпывпы', '111', '111', '111@111.ru', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
