-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 21. 14:40
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webterv`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat`
--

CREATE TABLE `chat` (
  `MessageID` int(10) NOT NULL,
  `Sender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Receiver` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `MessageContent` text NOT NULL,
  `MessageDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PictureID` int(11) DEFAULT NULL,
  `Comment` text NOT NULL,
  `CommentedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`CommentID`, `UserID`, `PictureID`, `Comment`, `CommentedAt`) VALUES
(27, 4, 29, 'asdasd', '2024-04-21 10:11:31'),
(28, 4, 29, 'asdasd', '2024-04-21 10:11:33');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pictures`
--

CREATE TABLE `pictures` (
  `PictureID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `UploadedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `pictures`
--

INSERT INTO `pictures` (`PictureID`, `UserID`, `Description`, `ImagePath`, `UploadedAt`) VALUES
(29, 4, 'asd', '6624e642f174e.PNG', '2024-04-21 10:11:14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`UserID`, `Email`, `Username`, `Password`, `CreatedAt`, `UpdatedAt`) VALUES
(4, 'asd@gmail.com', 'asd', '$2y$10$CHVFXMyRFoMVc5/c9LxNZOW/jwXgzvWdzZAyXciCbkY5Blcf2L5oa', '2024-04-20 19:21:40', '2024-04-20 19:21:40'),
(5, 'asd1@gmail.com', 'asd1', '$2y$10$Wb3PW2ApsOlsWkclpBKxJ.MlfzLIPwl7LXK6ERlVd42L2DUUiJNpW', '2024-04-21 09:33:21', '2024-04-21 09:33:21');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `Sender` (`Sender`),
  ADD KEY `Receiver` (`Receiver`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PictureID` (`PictureID`);

--
-- A tábla indexei `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`PictureID`),
  ADD KEY `UserID` (`UserID`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `chat`
--
ALTER TABLE `chat`
  MODIFY `MessageID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `pictures`
--
ALTER TABLE `pictures`
  MODIFY `PictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`Receiver`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PictureID`) REFERENCES `pictures` (`PictureID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
