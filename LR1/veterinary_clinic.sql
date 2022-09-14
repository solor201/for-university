-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 14 2022 г., 04:23
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `veterinary_clinic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_owner` int(11) UNSIGNED NOT NULL,
  `name` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL,
  `year_of_birth` int(4) NOT NULL,
  `img_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `animal_owners`
--

CREATE TABLE `animal_owners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_owner_animal` (`id_owner`);

--
-- Индексы таблицы `animal_owners`
--
ALTER TABLE `animal_owners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `animal_owners`
--
ALTER TABLE `animal_owners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `animal_owners` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
