-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Ноя 17 2021 г., 18:08
-- Версия сервера: 8.0.27
-- Версия PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medic`
--
CREATE DATABASE IF NOT EXISTS `medic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `medic`;

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `doctor`
--

INSERT INTO `doctor` (`doctorId`, `name`) VALUES
(1, 'Чернов Виктор'),
(2, 'Устинов Евгений'),
(3, 'Швакова Виктория '),
(4, 'Мархаток Роман'),
(5, 'Корсик Полина');

-- --------------------------------------------------------

--
-- Структура таблицы `inspection`
--

CREATE TABLE `inspection` (
  `inspectionId` int NOT NULL,
  `patientId` int DEFAULT NULL,
  `doctorId` int DEFAULT NULL,
  `date` date NOT NULL,
  `symptoms` varchar(128) NOT NULL,
  `diagnosis` varchar(128) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `inspection`
--

INSERT INTO `inspection` (`inspectionId`, `patientId`, `doctorId`, `date`, `symptoms`, `diagnosis`, `comment`) VALUES
(1, 3, 4, '2021-11-02', 'Судороги, пониженное артериальное давление, слабость, головокружения', 'Синусовая брадикардия (R00)', 'Пациенту необходимо провести плановое лечение. Для уточнения диагноза, отправить на ЭКГ'),
(2, 3, 2, '2021-10-21', 'Повышенная температура - 38.4, боли в горле, озноб, кашель, слабость и сонливость', 'Острый ларингит (J04.0)', 'Был проведён осмотр, выявлены симптомы, коонец.'),
(3, 1, 3, '2021-10-21', 'Что-то страшное', 'Точно болен!', 'Ну тут нечего сказать'),
(4, 2, 4, '2021-10-21', 'Кашель, нехватка воздуха', 'Острый ларингит (J04.0)', 'Лечиться даа');

-- --------------------------------------------------------

--
-- Структура таблицы `medicament`
--

CREATE TABLE `medicament` (
  `medicamentId` int NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `sideEffects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `medicament`
--

INSERT INTO `medicament` (`medicamentId`, `title`, `description`, `sideEffects`) VALUES
(1, 'Азитромивел', 'Антибиотик группы макролидов', 'Со стороны системы кроветворения: нечасто - лейкопения, нейтропения, эозинофилия; очень редко - тромбоцитопения, гемолитическая анемия.\r\n\r\nАллергические реакции: редко - кожная сыпь, ангионевротический отек и анафилаксия (в редких случаях с летальным исходом) многоформная эритема, лекарственная сыпь с эозинофилией и системными проявлениями (DRESS-синдром). Некоторые из таких реакций, развившихся при применении азитромицина, приобретали рецидивирующее течение и требовали продолжительного лечения и наблюдения.\r\n\r\nСо стороны кожи и подкожных тканей: нечасто - кожная сыпь, зуд, крапивница, дерматит, сухость кожи, потливость; редко - реакция фотосенсибилизации; частота неизвестна - синдром Стивенса-Джонсона, токсический эпидермальный некролиз, многоформная эритема.\r\n\r\nСо стороны нервной системы: часто - головная боль; нечасто - головокружение, нарушение вкусовых ощущений, парестезия, сонливость, бессонница, нервозность; редко - ажитация; частота неизвестна - гипестезия, тревога, агрессия, обморок, судороги, психомоторная гиперактивность, потеря обоняния, извращение обоняния, потеря вкусовых ощущений, миастения, бред, галлюцинации.\r\n\r\nСо стороны органа зрения: нечасто - нарушение зрения.'),
(2, 'Что-то с чем-то', 'Подозрительно, но эффективно', 'Никто не знает, что будет'),
(3, 'Любое название', 'Описание', 'Какие-либо побочные эффекты');

-- --------------------------------------------------------

--
-- Структура таблицы `medicamentRecipe`
--

CREATE TABLE `medicamentRecipe` (
  `medicamentId` int NOT NULL,
  `recipeId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `medicamentRecipe`
--

INSERT INTO `medicamentRecipe` (`medicamentId`, `recipeId`) VALUES
(1, 2),
(2, 1),
(2, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE `patient` (
  `patientId` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`patientId`, `name`, `gender`, `birthday`, `address`) VALUES
(1, 'Кононович Олег Павлович', 'Мужчина', '1995-11-14', 'г. Минск, ул. Кирова 4, кв. 81'),
(2, 'Акопян Светлана Викторовна', 'Женщина', '2000-05-06', 'г. Минск, ул. Некрасова 11, кв. 152'),
(3, 'Былинский Владислав Андреевич', 'Мужчина', '1979-12-02', 'г. Минск, ул. Слободская 11, кв. 432');

-- --------------------------------------------------------

--
-- Структура таблицы `recipe`
--

CREATE TABLE `recipe` (
  `recipeId` int NOT NULL,
  `inspectionId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipe`
--

INSERT INTO `recipe` (`recipeId`, `inspectionId`) VALUES
(1, 1),
(2, 2),
(3, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`);

--
-- Индексы таблицы `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`inspectionId`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `id` (`doctorId`) USING BTREE;

--
-- Индексы таблицы `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`medicamentId`);

--
-- Индексы таблицы `medicamentRecipe`
--
ALTER TABLE `medicamentRecipe`
  ADD KEY `medicamentId` (`medicamentId`),
  ADD KEY `recipeId` (`recipeId`);

--
-- Индексы таблицы `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientId`);

--
-- Индексы таблицы `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipeId`),
  ADD KEY `inspectionId` (`inspectionId`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `inspection`
--
ALTER TABLE `inspection`
  MODIFY `inspectionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `medicament`
--
ALTER TABLE `medicament`
  MODIFY `medicamentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipeId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patient` (`patientId`),
  ADD CONSTRAINT `inspection_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
