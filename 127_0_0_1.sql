-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2016. Nov 16. 12:33
-- Kiszolgáló verziója: 10.1.16-MariaDB
-- PHP verzió: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `facebookclone`
--
CREATE DATABASE IF NOT EXISTS `facebookclone` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `facebookclone`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feedposts`
--

CREATE TABLE `feedposts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `posttitle` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `post` varchar(512) COLLATE utf8_hungarian_ci NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `feedposts`
--

INSERT INTO `feedposts` (`id`, `userid`, `posttitle`, `post`, `postdate`) VALUES
(5, 1, 'i needed ', 'a db reset again', '2016-11-16 11:29:36'),
(6, 1, '2nx', 'asdasdasdf', '2016-11-16 11:22:53'),
(7, 1, 'cím', 'valami', '2016-11-16 11:22:53'),
(8, 1, 'asd', 'asd', '2016-11-16 11:22:53'),
(9, 6, 'the yomi', 'chan\r\n', '2016-11-16 11:22:53');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ranks`
--

INSERT INTO `ranks` (`id`, `name`) VALUES
(99, 'Admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `e-mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rankid` int(11) NOT NULL,
  `lastseen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `e-mail`, `rankid`, `lastseen`) VALUES
(1, 'steamhunter', '6f8b2364f18a627b44f0e4d63fe5b5ea', 'steamhunter97@gmail.com', 99, '2016-11-16 11:24:00'),
(3, 'admin', '6f8b2364f18a627b44f0e4d63fe5b5ea', 'steamhunter97@gmail.com', 99, '2016-11-16 11:24:00'),
(6, 'TheYomiChan', 'b5d73d30683e117cee008545982e8ae5', 'gamehunter997@gmail.com', 0, '2016-11-16 11:24:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `feedposts`
--
ALTER TABLE `feedposts`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `feedposts`
--
ALTER TABLE `feedposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;--
-- Adatbázis: `facebookclonecomment`
--
CREATE DATABASE IF NOT EXISTS `facebookclonecomment` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `facebookclonecomment`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postcomment5`
--

CREATE TABLE `postcomment5` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(512) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postcomment6`
--

CREATE TABLE `postcomment6` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(512) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `postcomment6`
--

INSERT INTO `postcomment6` (`id`, `userid`, `comment`) VALUES
(1, 1, 'test comment');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postcomment7`
--

CREATE TABLE `postcomment7` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(512) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `postcomment7`
--

INSERT INTO `postcomment7` (`id`, `userid`, `comment`) VALUES
(1, 1, 'volt');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postcomment8`
--

CREATE TABLE `postcomment8` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(512) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postcomment9`
--

CREATE TABLE `postcomment9` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(512) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `postcomment5`
--
ALTER TABLE `postcomment5`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `postcomment6`
--
ALTER TABLE `postcomment6`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `postcomment7`
--
ALTER TABLE `postcomment7`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `postcomment8`
--
ALTER TABLE `postcomment8`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `postcomment9`
--
ALTER TABLE `postcomment9`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `postcomment5`
--
ALTER TABLE `postcomment5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT a táblához `postcomment6`
--
ALTER TABLE `postcomment6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT a táblához `postcomment7`
--
ALTER TABLE `postcomment7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT a táblához `postcomment8`
--
ALTER TABLE `postcomment8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT a táblához `postcomment9`
--
ALTER TABLE `postcomment9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
