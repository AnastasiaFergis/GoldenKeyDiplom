CREATE DATABASE goldenkey;
USE goldenkey;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `Agents` (
  `agentId` int NOT NULL,
  `firstName` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surName` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneNumber` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Agents` (`agentId`, `firstName`, `lastName`, `surName`, `phoneNumber`) VALUES
(1, 'Касперский', 'Иван', 'Иванович', '+7 (999) 633-11-23'),
(2, 'Аваст', 'Дмитрий', 'Михайлович', '+7 (994) 444-55-12'),
(3, 'Амиго', 'Кирилл', 'Егорович', '+7 (914) 851-51-09'),
(4, 'Иванов', 'Иван', 'Иванович', '+7 (914) 712-03-81'),
(5, 'Пенькова', 'Анжела', 'Генадьевна', '+7 (991) 765-77-12');

CREATE TABLE `AppealsOfCustomers` (
  `appealId` int NOT NULL,
  `clientName` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `clientEmail` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agentId` int DEFAULT NULL,
  `appealStatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `AppealsOfCustomers` (`appealId`, `clientName`, `clientEmail`, `subject`, `message`, `agentId`, `appealStatus`) VALUES
(1, 'Андрей', 'andrey@mail.ru', 'Проверка', 'Пример сообщения', NULL, 'Новый');

CREATE TABLE `Clients` (
  `clientId` int NOT NULL,
  `firstName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `surName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Clients` (`clientId`, `firstName`, `lastName`, `surName`, `email`, `phone`, `password`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', 'test@test', '+7 (999) 333-33-33', '098f6bcd4621d373cade4e832627b4f6');

CREATE TABLE `RealEstates` (
  `realEstatesId` int NOT NULL,
  `realEstatesName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL,
  `countBedsRooms` int NOT NULL,
  `countBathsRooms` int NOT NULL,
  `agentId` int DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `settlementId` int NOT NULL,
  `clientId_owner` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RealEstates` (`realEstatesId`, `realEstatesName`, `price`, `countBedsRooms`, `countBathsRooms`, `agentId`, `image`, `description`, `settlementId`, `clientId_owner`) VALUES
(1, 'Таинственный Замок', 17999500, 2, 1, 3, 'images/img_1', 'Уникальный замок с таинственной атмосферой и большим участком земли. Идеальное место для тех, кто ищет уединение и комфорт.', 1, 1),
(2, 'Подкова Удачи', 20500000, 2, 2, 1, 'images/img_2', 'Просторный дом с высокими потолками и шикарным видом на природу. Идеально подходит для семейного проживания или отдыха.', 2, 1),
(3, 'Лазурный Бриз', 24500000, 3, 2, 4, 'images/img_3', 'Современный особняк с панорамными окнами и прекрасным видом на море. Расположен в эксклюзивном районе, недалеко от пляжа.', 3, 1),
(4, 'Звездный Путь', 31000000, 4, 2, 2, 'images/img_4', 'Элегантный дом с роскошной отделкой и просторной территорией. Предлагает уникальное сочетание стиля и комфорта.', 4, 1),
(5, 'Радуга Мечтаний', 16900000, 2, 1, 1, 'images/img_5', 'Уютный коттедж с красивым садом и террасой. Идеальное место для спокойного и комфортного проживания.', 5, 1),
(6, 'Сказочный Дворец', 21500000, 2, 2, 3, 'images/img_6', 'Прекрасный дом в классическом стиле с элегантной мебелью и уютным камином. Предлагает роскошный отдых в окружении природы.', 6, 1),
(7, 'Маленькая Мечта', 23300000, 4, 2, 4, 'images/img_7', 'Современная вилла с большим бассейном и садом. Предлагает идеальное сочетание роскоши и удобства для вашего отдыха.', 7, 1),
(8, 'Лунная Соната', 29999999, 5, 3, 5, 'images/img_8', 'Эксклюзивная резиденция с видом на луну и просторными интерьерами. Предлагает уникальный опыт проживания в уединении.', 8, 1);

CREATE TABLE `Reviews` (
  `reviewId` int NOT NULL,
  `clientId` int NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Reviews` (`reviewId`, `clientId`, `message`, `score`) VALUES
(1, 1, 'За помощь в поиске квартиры хочу выразить благодарность агентству \'Golden Key\'. Они подобрали мне идеальный вариант, который полностью соответствует моим требованиям и бюджету. Процесс был очень гладким и комфортным благодаря их профессионализму и внимательности к деталям', 5);

CREATE TABLE `SalesApplications` (
  `saleApplicationId` int NOT NULL,
  `realEstateId` int NOT NULL,
  `clientId` int NOT NULL,
  `datetime` datetime NOT NULL,
  `agentId` int DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Settlements` (
  `settlementId` int NOT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `indexCity` int NOT NULL,
  `street` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `streetNum` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Settlements` (`settlementId`, `city`, `indexCity`, `street`, `streetNum`) VALUES
(1, 'Хабаровск', 680000, 'ул. Центральная', 123),
(2, 'Хабаровск', 680000, 'пр-кт. Ленина', 456),
(3, 'Амурск', 682640, 'ул. Главная', 789),
(4, 'Благовещенск', 675000, 'ул. Парковая', 20),
(5, 'Владивосток', 690000, 'пр-кт. Победы', 35),
(6, 'Владивосток', 690000, 'пр-кт. Адмирала Смирнова', 17),
(7, 'Владивосток', 690000, 'пр-кт. Комсомольский', 321),
(8, 'Владивосток', 690000, 'ул. Пушкина', 47);


ALTER TABLE `Agents`
  ADD PRIMARY KEY (`agentId`);

ALTER TABLE `AppealsOfCustomers`
  ADD PRIMARY KEY (`appealId`),
  ADD KEY `agentId` (`agentId`);

ALTER TABLE `Clients`
  ADD PRIMARY KEY (`clientId`);

ALTER TABLE `RealEstates`
  ADD PRIMARY KEY (`realEstatesId`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `settlementId` (`settlementId`),
  ADD KEY `clientId` (`clientId_owner`);

ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `clientId` (`clientId`);

ALTER TABLE `SalesApplications`
  ADD PRIMARY KEY (`saleApplicationId`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `salesapplications_ibfk_3` (`realEstateId`);

ALTER TABLE `Settlements`
  ADD PRIMARY KEY (`settlementId`);


ALTER TABLE `Agents`
  MODIFY `agentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `AppealsOfCustomers`
  MODIFY `appealId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `Clients`
  MODIFY `clientId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `RealEstates`
  MODIFY `realEstatesId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

ALTER TABLE `Reviews`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `SalesApplications`
  MODIFY `saleApplicationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `Settlements`
  MODIFY `settlementId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;


ALTER TABLE `AppealsOfCustomers`
  ADD CONSTRAINT `appealsofcustomers_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `Agents` (`agentId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `RealEstates`
  ADD CONSTRAINT `realestates_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `Agents` (`agentId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `realestates_ibfk_2` FOREIGN KEY (`settlementId`) REFERENCES `Settlements` (`settlementId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `realestates_ibfk_3` FOREIGN KEY (`clientId_owner`) REFERENCES `Clients` (`clientId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `Clients` (`clientId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `SalesApplications`
  ADD CONSTRAINT `salesapplications_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `Agents` (`agentId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `salesapplications_ibfk_2` FOREIGN KEY (`clientId`) REFERENCES `Clients` (`clientId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `salesapplications_ibfk_3` FOREIGN KEY (`realEstateId`) REFERENCES `RealEstates` (`realEstatesId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
