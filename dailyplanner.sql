-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 19 2024 г., 12:00
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dailyplanner`
--

-- --------------------------------------------------------

--
-- Структура таблицы `moments`
--

CREATE TABLE `moments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `day` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `emotion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `moments`
--

INSERT INTO `moments` (`id`, `user_id`, `day`, `photo`, `emotion`) VALUES
(1, 1, '2023-12-07', 'images/2023-12-07.jpg', 'bad'),
(4, 1, '2023-12-09', '', 'good'),
(6, 3, '2023-12-10', 'images/cat1.png', 'bad'),
(9, 1, '2023-12-10', 'images/2023-12-07.jpg', 'bad'),
(11, 1, '2023-12-08', '', 'bad'),
(12, 2, '2023-12-10', 'images/Screenshot 2023-12-10 001755.png', 'bad'),
(13, 2, '2023-12-09', '', 'good'),
(14, 1, '2023-12-06', '', 'good'),
(15, 1, '2023-12-05', '', 'normal'),
(16, 1, '2023-12-11', 'images/emotions.jpg', 'normal'),
(17, 1, '2023-12-18', '', 'bad'),
(18, 1, '2023-12-20', '', 'bad'),
(19, 1, '2024-05-13', '', 'bad'),
(21, 1, '2024-05-21', '', 'good'),
(22, 1, '2024-05-22', '', 'normal'),
(23, 1, '2024-05-28', '', 'bad');

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `day` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `day`, `text`) VALUES
(1, 1, '2023-12-07', 'Дорогой дневник... оповоыжвжаоыжымофжh\r\nkkkkkmkhfijilify\r\n\r\n'),
(2, 2, '2023-12-07', 'slfjsjkgvs;fbj'),
(3, 1, '2023-12-09', 'впрвартв азззззззз'),
(4, 1, '2023-12-10', 'заметкиgyygykik 5555'),
(5, 3, '2023-12-10', 'заметкиgyygykik'),
(6, 1, '2023-12-10', 'заметкиgyygykik 5555'),
(7, 1, '2023-12-11', 'hfjjk'),
(10, 1, '2023-12-14', 'ggg'),
(11, 1, '2023-12-13', 'gbplf'),
(14, 2, '2023-12-10', 'заметкиgyygykik 777'),
(18, 1, '2023-12-31', 'ноый гол!!!'),
(24, 1, '2023-12-24', ''),
(25, 1, '2023-12-18', ''),
(26, 2, '2023-12-18', ''),
(27, 4, '2023-12-18', ''),
(28, 1, '2023-12-22', ''),
(29, 1, '2023-12-20', ''),
(30, 1, '2024-05-13', 'Дорогой дневник'),
(31, 1, '2024-05-17', ''),
(32, 1, '2024-05-21', 'еще одна попытка!!'),
(33, 1, '2024-05-22', 'всем привет!!'),
(34, 1, '2024-06-29', ''),
(35, 1, '2024-05-09', ''),
(36, 1, '2024-05-16', ''),
(37, 1, '2024-05-28', 'новая44'),
(38, 1, '2024-05-29', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `displayed` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `displayed`) VALUES
(1, 'index', 1),
(2, 'stat', 1),
(3, 'calendar', 1),
(4, 'about', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `date`) VALUES
(1, 1, 'Сделать веб', '2023-12-08'),
(3, 1, 'ВЕб', '2023-12-07'),
(13, 1, 'Сделать красиво', '2023-12-07'),
(14, 2, '234', '2023-12-07'),
(15, 1, 'сделать веб', '2023-12-09'),
(22, 1, '2222', '2023-12-10'),
(23, 1, 'Страничка \"О проекте\"', '2023-12-10'),
(24, 3, 'Полить цветы', '2023-12-10'),
(36, 1, 'jksdfjp;', '2023-12-10'),
(37, 2, 'туда сюда', '2023-12-10'),
(38, 2, 'там сям', '2023-12-10'),
(39, 2, 'миллионер', '2023-12-10'),
(44, 1, '222', '2023-12-11'),
(45, 1, 'Дело', '2023-12-24'),
(48, 1, 'дело', '2023-12-20'),
(66, 1, '4', '2024-05-21'),
(76, 1, 'новая задача', '2024-05-21'),
(90, 1, 'супер задача', '2024-05-22'),
(94, 1, 'новая', '2024-05-22'),
(109, 1, '4444', '2024-05-28');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`) VALUES
(1, '123', '123', '123@email.com'),
(2, '456', '456', '456@email.com'),
(3, 'user', 'user', 'user.com'),
(4, 'admin', 'wels1415', 'admin@admin.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `moments`
--
ALTER TABLE `moments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT для таблицы `moments`
--
ALTER TABLE `moments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
