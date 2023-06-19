-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 19 2023 г., 18:56
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fitnessclub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `ID` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `password2` varchar(128) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`ID`, `login`, `password`, `password2`, `full_name`, `phone`) VALUES
(2, 'admin', 'admin', 'admin', 'adminadmin', '777'),
(3, 'Ilya', 'Ilya', 'Ilya', 'Илья Сухоручкин', '901 179 39 69'),
(4, 'NikolaTesla', 'dada', 'dada', 'Макаров Николай Сергеевич', '901 276-57-09'),
(12, 'Georgy', 'GeorgyCar', 'GeorgyCar', 'Пшеничников Георгий Павлович', '999 120-45-43'),
(13, 'EgorMachine', 'EgorMachineReal', 'EgorMachineReal', 'Червоников Егор Константинович', '910 499-34-43'),
(14, 'IvanTest', 'IvanTest', 'IvanTest', 'Гомзин Иван Александрович', '901 179 39 69'),
(15, 'IvanGomzin', 'IvanGomzin', 'IvanGomzin', 'Гомзин Иван Александрович', '901 179 39 69'),
(20, 'Ivan111', 'IvanIvanIvan', 'IvanIvanIvan', 'Гомзин Иван Александрович', '901 179 39 69'),
(25, 'IvanGomzin', 'IvanIvanIvan', 'IvanIvanIvan', 'Гомзин Иван Александрович', '901 179 39 69');

-- --------------------------------------------------------

--
-- Структура таблицы `entry`
--

CREATE TABLE `entry` (
  `ID` int(11) NOT NULL,
  `timetable_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `timetable_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `timetable_time` time(6) NOT NULL,
  `client_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `entry`
--

INSERT INTO `entry` (`ID`, `timetable_id`, `user_name`, `user_phone`, `timetable_date`, `timetable_time`, `client_id`, `trainer_id`) VALUES
(45, 1, '', '', '2023-06-04 16:32:25.956284', '00:00:00.000000', 4, 2),
(62, 2, '', '', '2023-05-04 21:00:00.000000', '09:00:00.000000', 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `description` varchar(610) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`ID`, `description`, `full_name`) VALUES
(1, 'В «IvanFitness» работают очень приветливые люди, достойные тренера тренажерного зала ! В самом зале есть все необходимые тренажёры, всегда чисто и аккуратно )) оттуда просто не хотелось уезжать ) всем очень очень советую', 'Евтеева Ольга Викторовна'),
(2, '7.08.22 Сходила на групповое занятие TRX (9:00) Осталась не довольна тренером', 'Ларионова Наталья'),
(3, 'Хотелось бы выразить огромную благодарность за качественные и всегда разнообразные тренировки (не только групповые, но и индивидуальные) тренеру Алене Гульян. Это тренер который знает свое дело.', 'Куталадзе Нелли Омаровна'),
(34, 'Отличный фитнес клуб) ходим с женой, много групповых тренировок, нам все нравится)', 'Евгений Гончаров'),
(35, 'Самый удобный фитнес-клуб в центре:\r\n+Большая парковка.\r\n+Время работы с 7 до 24.\r\n+Просторный тренажерный зал.\r\nИ все это за сравнительно небольшие деньги.', 'Андрей Зверев'),
(36, 'Комфортный, чистый и светлый клуб. Приветливый персонал, удобная парковка. Приятно заниматься, очень много места, люди не мешают друг другу.', 'Евгения'),
(37, 'Хожу в IvanFitness полгода, очень приятная атмосфера, хороший зал и приветливые тренера которые всегда помогут и подскажут как и что делать. Спасибо Вам.', 'Анастасия'),
(38, 'Здравствуйте. Хотела бы оставить отзыв. Занимаюсь уже четыре месяца. Тренера просто супер. Занимаюсь по три раза в неделю. Тренерам можно задать любой вопрос по упражнениям. Хожу на занятия как на праздник. ', 'Ксения'),
(39, 'С большим удовольствием посещаю у вас групповые тренировки! Очень нравятся йога, стрейтч.', 'Инга'),
(46, 'Тестовый вывод отзыва!', 'Разработчик'),
(47, 'Ставлю пять звезд!', 'Пшеничный Святослав Анатольевич'),
(48, 'Ставлю пять звезд смело!', 'Гомзин Иван Александрович'),
(49, 'Замечательный фитнес клуб!', 'Иван'),
(50, 'Очень нравится!', 'Пшеничный Святослав Анатольевич'),
(51, 'пять звезд и точка.', 'Иван'),
(52, 'Добавление отзыва!', 'Иван'),
(53, '123', 'Иван');

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `ID` int(11) NOT NULL,
  `trainer_id` int(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `timetable_client` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `timetable`
--

INSERT INTO `timetable` (`ID`, `trainer_id`, `title`, `description`, `date`, `time`, `timetable_client`, `client_id`) VALUES
(1, 2, 'Групповое занятие CrossFit', '650 рублей.', '2023-05-04', '09:00:00.000000', 0, 0),
(2, 1, 'Групповое занятие Йога.', '700 рублей.', '2023-05-05', '09:00:00.000000', 0, 0),
(3, 1, 'Групповое занятие Йога.', '700 рублей.', '2023-06-04', '10:00:00.000000', 0, 0),
(4, 1, 'Групповое занятие Йога.', '700 рублей.', '2023-05-01', '11:00:00.000000', 0, 0),
(10, 4, 'Групповое занятие Степ-аэробика', '800 рублей.', '2023-06-05', '09:00:00.000000', 0, 0),
(11, 4, 'Групповое занятие Степ-аэробика', '800 рублей.', '2023-06-05', '10:00:00.000000', 0, 0),
(12, 4, 'Групповое занятие Степ-аэробика', '800 рублей.', '2023-06-05', '14:00:00.000000', 0, 0),
(16, 1, 'Групповое занятие Йога.', '700 рублей.', '2023-06-07', '12:00:00.000000', 0, 0),
(17, 1, 'Групповое занятие Йога.', '700 рублей.', '2023-06-07', '14:00:00.000000', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `trainers`
--

CREATE TABLE `trainers` (
  `ID` int(128) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `overview` varchar(255) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `trainers`
--

INSERT INTO `trainers` (`ID`, `full_name`, `overview`, `phone`, `description`) VALUES
(1, 'Анастасия', 'Йога', '901 134 77 54', 'Анастасия - опытный и сертифицированный тренер по йоге с более чем 10-летним стажем. Она специализируется на аштанга йоге и йоге для беременных, и считает, что йога помогает найти баланс и укрепить тело и разум.'),
(2, 'Антон', 'Кроссфит', '999 179 34 57', 'Антон - опытный и сертифицированный тренер по кроссфиту с более чем 8-летним стажем. Он нацелен на помощь своим ученикам в достижении максимальных результатов и преодолении своих личных ограничений. Антон обладает знаниями в области силовых тренировок.'),
(3, 'Евгений', 'Воркаут', '901 177-39-43', 'Евгений обладает глубокими знаниями о различных упражнениях и техниках воркаута, а также о применении разнообразных тренировочных инструментов и оборудования. '),
(4, 'Карина', 'Степ аэробика', '910 955-45-45', 'Карина является экспертом в области степ-аэробики и способна создавать динамичные и разнообразные программы тренировок, которые подходят для любого уровня физической подготовки. '),
(8, 'Антон', 'Степ аэробика', '901 179 39 69', 'Большое описание');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_entry_timetable` (`timetable_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Индексы таблицы `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `entry`
--
ALTER TABLE `entry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `trainers`
--
ALTER TABLE `trainers`
  MODIFY `ID` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `entry_ibfk_1` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`ID`),
  ADD CONSTRAINT `entry_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`ID`);

--
-- Ограничения внешнего ключа таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
