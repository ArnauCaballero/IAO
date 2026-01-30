-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 30-01-2026 a les 18:49:04
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `pokemon_v2`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `captures`
--

CREATE TABLE `captures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `captured_at` datetime NOT NULL DEFAULT current_timestamp(),
  `level` int(11) DEFAULT 1,
  `is_on_team` tinyint(1) DEFAULT 0,
  `pokeball` enum('pokeball','greatball','ultraball','masterball') DEFAULT 'pokeball'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `captures`
--

INSERT INTO `captures` (`id`, `user_id`, `pokemon_id`, `nickname`, `captured_at`, `level`, `is_on_team`, `pokeball`) VALUES
(1, 1, 4, 'Pikapi', '2023-01-01 10:00:00', 50, 1, 'pokeball'),
(2, 1, 1, 'Bulby', '2023-01-02 11:30:00', 32, 1, 'greatball'),
(3, 1, 7, NULL, '2023-01-03 09:15:00', 15, 1, 'pokeball'),
(4, 2, 7, 'Shellshocker', '2023-01-01 10:05:00', 52, 1, 'ultraball'),
(5, 2, 5, 'MyMewtwo', '2023-12-25 00:00:01', 70, 1, 'masterball'),
(6, 3, 10, 'TestSubject1', '2020-05-01 08:00:00', 10, 1, 'pokeball'),
(7, 5, 11, 'Tapu-bulu', '2026-01-09 19:39:42', 1, 1, 'pokeball'),
(8, 5, 12, 'Omastar', '2026-01-09 19:39:44', 1, 1, 'pokeball'),
(9, 5, 13, 'Growlithe', '2026-01-09 19:39:45', 1, 0, 'pokeball'),
(10, 5, 14, 'Dhelmise', '2026-01-09 19:39:45', 1, 1, 'pokeball'),
(11, 5, 15, 'Cottonee', '2026-01-09 19:39:46', 1, 0, 'pokeball'),
(12, 5, 16, 'Swampert', '2026-01-09 19:39:47', 1, 1, 'pokeball'),
(13, 5, 17, 'Morgrem', '2026-01-09 19:39:58', 1, 0, 'pokeball'),
(14, 5, 18, 'Zapdos', '2026-01-09 19:40:00', 1, 1, 'pokeball'),
(15, 5, 19, 'Cetitan', '2026-01-09 19:40:01', 1, 1, 'pokeball'),
(16, 5, 20, 'Rhyhorn', '2026-01-09 19:46:46', 1, 0, 'pokeball'),
(17, 5, 21, 'Slurpuff', '2026-01-16 18:07:47', 1, 0, 'pokeball'),
(18, 5, 22, 'Klefki', '2026-01-16 18:08:57', 1, 0, 'pokeball'),
(19, 3, 23, 'Timburr', '2026-01-16 18:11:10', 1, 1, 'pokeball'),
(20, 3, 24, 'Klink', '2026-01-16 18:11:28', 1, 0, 'pokeball'),
(21, 3, 25, 'Granbull', '2026-01-16 18:11:30', 1, 1, 'pokeball'),
(22, 3, 26, 'Zamazenta', '2026-01-16 18:11:31', 1, 1, 'pokeball'),
(23, 3, 27, 'Gligar', '2026-01-16 18:11:32', 1, 1, 'pokeball'),
(24, 3, 28, 'Finizen', '2026-01-16 18:11:44', 1, 1, 'pokeball'),
(25, 3, 29, 'Whirlipede', '2026-01-16 18:56:06', 1, 0, 'pokeball'),
(26, 3, 30, 'Luxray', '2026-01-16 18:56:08', 1, 0, 'pokeball'),
(27, 3, 2, 'Charmander', '2026-01-16 18:56:08', 1, 0, 'pokeball'),
(28, 3, 31, 'Honedge', '2026-01-16 18:56:08', 1, 0, 'pokeball'),
(29, 3, 32, 'Grafaiai', '2026-01-16 18:56:09', 1, 0, 'pokeball'),
(30, 3, 33, 'Lanturn', '2026-01-16 18:56:09', 1, 0, 'pokeball'),
(31, 3, 34, 'Flamigo', '2026-01-16 18:56:09', 1, 0, 'pokeball'),
(32, 3, 35, 'Hydrapple', '2026-01-16 18:56:10', 1, 0, 'pokeball'),
(33, 3, 36, 'Ducklett', '2026-01-30 17:22:28', 1, 0, 'pokeball'),
(34, 6, 37, 'Terapagos', '2026-01-30 18:27:25', 1, 1, 'pokeball'),
(35, 6, 38, 'Magneton', '2026-01-30 18:27:34', 1, 1, 'pokeball'),
(36, 6, 39, 'Kingambit', '2026-01-30 18:27:36', 1, 1, 'pokeball'),
(37, 6, 40, 'Houndoom', '2026-01-30 18:27:37', 1, 1, 'pokeball'),
(38, 6, 41, 'Turtwig', '2026-01-30 18:27:38', 1, 0, 'pokeball'),
(39, 6, 42, 'Cacnea', '2026-01-30 18:27:39', 1, 0, 'pokeball'),
(40, 6, 43, 'Appletun', '2026-01-30 18:27:40', 1, 1, 'pokeball'),
(41, 6, 44, 'Butterfree', '2026-01-30 18:27:41', 1, 0, 'pokeball'),
(42, 6, 45, 'Cursola', '2026-01-30 18:27:41', 1, 0, 'pokeball'),
(43, 6, 46, 'Snover', '2026-01-30 18:27:42', 1, 0, 'pokeball'),
(44, 6, 47, 'Blissey', '2026-01-30 18:27:43', 1, 0, 'pokeball'),
(45, 6, 48, 'Venusaur', '2026-01-30 18:27:44', 1, 1, 'pokeball'),
(46, 3, 49, 'Darumaka', '2026-01-30 18:38:36', 1, 0, 'pokeball');

-- --------------------------------------------------------

--
-- Estructura de la taula `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `pokedex_num` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type1` varchar(20) NOT NULL,
  `type2` varchar(20) DEFAULT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `sprite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `pokemon`
--

INSERT INTO `pokemon` (`id`, `pokedex_num`, `name`, `type1`, `type2`, `height`, `weight`, `sprite`) VALUES
(1, 1, 'bulbasaur', 'grass', 'poison', 0.70, 6.90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(2, 4, 'charmander', 'fire', NULL, 0.60, 8.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(3, 7, 'squirtle', 'water', NULL, 0.50, 9.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'),
(4, 25, 'pikachu', 'electric', NULL, 0.40, 6.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'),
(5, 150, 'mewtwo', 'psychic', NULL, 2.00, 122.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png'),
(6, 152, 'chikorita', 'grass', NULL, 0.90, 6.40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/152.png'),
(7, 158, 'totodile', 'water', NULL, 0.60, 9.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/158.png'),
(8, 155, 'cyndaquil', 'fire', NULL, 0.50, 7.90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/155.png'),
(9, 384, 'rayquaza', 'dragon', 'flying', 7.00, 206.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/384.png'),
(10, 132, 'ditto', 'normal', NULL, 0.30, 4.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/132.png'),
(11, 787, 'tapu-bulu', 'grass', 'fairy', 1.90, 45.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/787.png'),
(12, 139, 'omastar', 'rock', 'water', 1.00, 35.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/139.png'),
(13, 58, 'growlithe', 'fire', NULL, 0.70, 19.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/58.png'),
(14, 781, 'dhelmise', 'ghost', 'grass', 3.90, 210.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/781.png'),
(15, 546, 'cottonee', 'grass', 'fairy', 0.30, 0.60, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/546.png'),
(16, 260, 'swampert', 'water', 'ground', 1.50, 81.90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/260.png'),
(17, 860, 'morgrem', 'dark', 'fairy', 0.80, 12.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/860.png'),
(18, 145, 'zapdos', 'electric', 'flying', 1.60, 52.60, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/145.png'),
(19, 975, 'cetitan', 'ice', NULL, 4.50, 700.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/975.png'),
(20, 111, 'rhyhorn', 'ground', 'rock', 1.00, 115.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/111.png'),
(21, 685, 'slurpuff', 'fairy', NULL, 0.80, 5.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/685.png'),
(22, 707, 'klefki', 'steel', 'fairy', 0.20, 3.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/707.png'),
(23, 532, 'timburr', 'fighting', NULL, 0.60, 12.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/532.png'),
(24, 599, 'klink', 'steel', NULL, 0.30, 21.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/599.png'),
(25, 210, 'granbull', 'fairy', NULL, 1.40, 48.70, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/210.png'),
(26, 889, 'zamazenta', 'fighting', NULL, 2.90, 210.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/889.png'),
(27, 207, 'gligar', 'ground', 'flying', 1.10, 64.80, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/207.png'),
(28, 963, 'finizen', 'water', NULL, 1.30, 60.20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/963.png'),
(29, 544, 'whirlipede', 'bug', 'poison', 1.20, 58.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/544.png'),
(30, 405, 'luxray', 'electric', NULL, 1.40, 42.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/405.png'),
(31, 679, 'honedge', 'steel', 'ghost', 0.80, 2.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/679.png'),
(32, 945, 'grafaiai', 'poison', 'normal', 0.70, 27.20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/945.png'),
(33, 171, 'lanturn', 'water', 'electric', 1.20, 22.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/171.png'),
(34, 973, 'flamigo', 'flying', 'fighting', 1.60, 37.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/973.png'),
(35, 1019, 'hydrapple', 'grass', 'dragon', 1.80, 93.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1019.png'),
(36, 580, 'ducklett', 'water', 'flying', 0.50, 5.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/580.png'),
(37, 1024, 'terapagos', 'normal', NULL, 0.20, 6.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1024.png'),
(38, 82, 'magneton', 'electric', 'steel', 1.00, 60.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/82.png'),
(39, 983, 'kingambit', 'dark', 'steel', 2.00, 120.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/983.png'),
(40, 229, 'houndoom', 'dark', 'fire', 1.40, 35.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/229.png'),
(41, 387, 'turtwig', 'grass', NULL, 0.40, 10.20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/387.png'),
(42, 331, 'cacnea', 'grass', NULL, 0.40, 51.30, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/331.png'),
(43, 842, 'appletun', 'grass', 'dragon', 0.40, 13.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/842.png'),
(44, 12, 'butterfree', 'bug', 'flying', 1.10, 32.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/12.png'),
(45, 864, 'cursola', 'ghost', NULL, 1.00, 0.40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/864.png'),
(46, 459, 'snover', 'grass', 'ice', 1.00, 50.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/459.png'),
(47, 242, 'blissey', 'normal', NULL, 1.50, 46.80, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/242.png'),
(48, 3, 'venusaur', 'grass', 'poison', 2.00, 100.00, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png'),
(49, 554, 'darumaka', 'fire', NULL, 0.60, 37.50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/554.png');

-- --------------------------------------------------------

--
-- Estructura de la taula `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador del sistema amb accés total.'),
(2, 'trainer', 'Usuari estàndard amb límit de 3 Pokémon.'),
(3, 'vip', 'Usuari prèmium amb límit de 6 Pokémon.');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `usuaris`
--

INSERT INTO `usuaris` (`id`, `username`, `email`, `password`, `role_id`, `birth_date`, `created_at`) VALUES
(1, 'ash_ketchum', 'ash@pokemon.com', '$2y$10$IqnwkoVlAZWOmVP9PBR79OuQ9MB94fKV6kopwBL4jdf8nv96eAV3y', 2, '2010-05-22', '2026-01-09 19:38:32'),
(2, 'gary_oak', 'gary@pokemon.com', '$2y$10$jnX2jcg7hbVNPjOxf46OpOtxG4qyIs.zkE9A0/tj7tqAA/dOPpIaa', 2, '2010-04-10', '2026-01-09 19:38:32'),
(3, 'professor_oak', 'oak@pokemon.com', '$2y$10$tsyfdYDFft0HDZ16ciWCbeA99x433R5Mg4i9kVhRe1nmksOj0mGHq', 1, '1960-01-01', '2026-01-09 19:38:32'),
(4, 'vip_user', 'vip@pokemon.com', '$2y$10$UlbfFQdBe3To0he5vcPvNuPBHV5EQHwyWdYwNOxVJHw2QcDmqhjhG', 3, '2000-01-01', '2026-01-09 19:38:32'),
(5, 'testvip1', 'testvip1@gmail.com', '$2y$10$N.5LN.0lVnw9JxVD6NxgOOD9VedtHslR74pLQKq/jBziShHZPqNyG', 3, '2006-03-17', '2026-01-09 19:39:25'),
(6, 'marc', '2024_marc.martinez@iticbcn.cat', '$2y$10$Ew6/KAJ9ZsvK54GKAXcgMOBxScceCAA4GbQTbMrv3Arn3fT4jrdsC', 3, '2005-05-23', '2026-01-30 18:27:07');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `captures`
--
ALTER TABLE `captures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pokemon_id` (`pokemon_id`);

--
-- Índexs per a la taula `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pokedex_num` (`pokedex_num`);

--
-- Índexs per a la taula `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índexs per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `captures`
--
ALTER TABLE `captures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT per la taula `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT per la taula `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `captures`
--
ALTER TABLE `captures`
  ADD CONSTRAINT `captures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `captures_ibfk_2` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD CONSTRAINT `usuaris_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
