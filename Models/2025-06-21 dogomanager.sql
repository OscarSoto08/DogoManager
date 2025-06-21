-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2025 a las 21:29:21
-- Versión del servidor: 8.0.42
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dogomanager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `name`, `last_name`, `email`, `password`) VALUES
(1, 'Oscar', 'Gonzalez', 'oscar@example.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Joan', 'Daniel', 'joan@example.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `breed`
--

CREATE TABLE `breed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `is_active` BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `breed`
--

INSERT INTO `breed` (`id`, `name`, `size`) VALUES
(1, 'Labrador Retriever', 'Large'),
(2, 'German Shepherd', 'Large'),
(3, 'Golden Retriever', 'Large'),
(4, 'French Bulldog', 'Medium'),
(5, 'Bulldog', 'Medium'),
(6, 'Poodle', 'Medium'),
(7, 'Beagle', 'Medium'),
(8, 'Rottweiler', 'Large'),
(9, 'Yorkshire Terrier', 'Small'),
(10, 'Boxer', 'Large'),
(11, 'Dachshund', 'Small'),
(12, 'Siberian Husky', 'Large'),
(13, 'Doberman', 'Large'),
(14, 'Shih Tzu', 'Small'),
(15, 'Great Dane', 'Giant'),
(16, 'Chihuahua', 'Small'),
(17, 'Border Collie', 'Medium'),
(18, 'Australian Shepherd', 'Medium'),
(19, 'Bichon Frise', 'Small'),
(20, 'Cocker Spaniel', 'Medium'),
(21, 'Akita', 'Large'),
(22, 'Boston Terrier', 'Small'),
(23, 'Maltese', 'Small'),
(24, 'Weimaraner', 'Large'),
(25, 'Pug', 'Small'),
(26, 'Havanese', 'Small'),
(27, 'Collie', 'Large'),
(28, 'Newfoundland', 'Giant'),
(29, 'Basset Hound', 'Medium'),
(30, 'Shar Pei', 'Medium'),
(31, 'St. Bernard', 'Giant'),
(32, 'English Setter', 'Large'),
(33, 'Lhasa Apso', 'Small'),
(34, 'Samoyed', 'Large'),
(35, 'Alaskan Malamute', 'Giant'),
(36, 'Whippet', 'Medium'),
(37, 'Miniature Schnauzer', 'Small'),
(38, 'Scottish Terrier', 'Small'),
(39, 'Papillon', 'Small'),
(40, 'Cane Corso', 'Large'),
(41, 'Bernese Mountain Dog', 'Large'),
(42, 'Rhodesian Ridgeback', 'Large'),
(43, 'Bloodhound', 'Large'),
(44, 'Bullmastiff', 'Giant'),
(45, 'Belgian Malinois', 'Large'),
(46, 'Chow Chow', 'Medium'),
(47, 'Airedale Terrier', 'Medium'),
(48, 'Basenji', 'Small'),
(49, 'Cavapoo', 'Small'),
(50, 'Shiba Inu', 'Small');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int NOT NULL,
  `id_walk` int DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `id_walk`, `total`, `created_at`) VALUES
(1, 1, 21536, '2025-06-15 22:30:00'),
(2, 2, 17191, '2025-06-02 16:05:00'),
(3, 3, 22985, '2025-06-02 12:50:00'),
(4, 4, 27096, '2025-06-03 16:07:00'),
(5, 5, 26150, '2025-06-06 14:42:00'),
(6, 6, 27441, '2025-06-06 17:26:00'),
(7, 7, 27869, '2025-06-12 23:02:00'),
(8, 8, 18033, '2025-06-12 21:49:00'),
(9, 9, 18717, '2025-06-02 20:54:00'),
(10, 10, 28258, '2025-06-15 13:14:00'),
(11, 11, 15936, '2025-06-13 16:27:00'),
(12, 12, 15049, '2025-06-10 23:26:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owner`
--

CREATE TABLE `owner` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `owner`
--

INSERT INTO `owner` (`id`, `name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', 'Ramirez', 'carlos1@mail.com', 'pass1', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(2, 'Laura', 'Martinez', 'laura2@mail.com', 'pass2', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(3, 'Sofia', 'Lopez', 'sofia3@mail.com', 'pass3', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(4, 'Andres', 'Gomez', 'andres4@mail.com', 'pass4', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(5, 'Tatiana', 'Mendoza', 'tatiana5@mail.com', 'pass5', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(6, 'Jorge', 'Acosta', 'jorge6@mail.com', 'pass6', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(7, 'Marta', 'Bermudez', 'marta7@mail.com', 'pass7', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(8, 'Felipe', 'Rios', 'felipe8@mail.com', 'pass8', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(9, 'Ana', 'Gutierrez', 'ana9@mail.com', 'pass9', '2025-06-17 19:28:50', '2025-06-17 19:28:50'),
(10, 'Luis', 'Silva', 'luis10@mail.com', 'pass10', '2025-06-17 19:28:50', '2025-06-17 19:28:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `place`
--

CREATE TABLE `place` (
  `id` int NOT NULL,
  `place` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `place`
--

INSERT INTO `place` (`id`, `place`) VALUES
(1, 'Parque Simón Bolívar'),
(2, 'Parque de los Novios'),
(3, 'Parque El Virrey'),
(4, 'Cerro de Monserrate'),
(5, 'Jardín Botánico'),
(6, 'Zona T'),
(7, 'La Candelaria'),
(8, 'Usaquén'),
(9, 'Chapinero Central'),
(10, 'Parque Nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puppy`
--

CREATE TABLE `puppy` (
  `id` int NOT NULL,
  `owned_by` int DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `id_breed` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `puppy`
--

INSERT INTO `puppy` (`id`, `owned_by`, `picture`, `birth_date`, `id_breed`) VALUES
(1, 1, NULL, '2022-01-01', 1),
(2, 2, NULL, '2021-05-15', 2),
(3, 3, NULL, '2020-03-10', 3),
(4, 4, NULL, '2023-02-20', 4),
(5, 5, NULL, '2022-09-09', 5),
(6, 6, NULL, '2021-12-12', 6),
(7, 7, NULL, '2022-07-07', 7),
(8, 8, NULL, '2020-11-11', 8),
(9, 9, NULL, '2019-08-08', 9),
(10, 10, NULL, '2021-06-06', 10),
(11, 1, NULL, '2022-04-04', 11),
(12, 2, NULL, '2020-10-10', 12),
(13, 3, NULL, '2021-01-01', 13),
(14, 4, NULL, '2018-12-12', 14),
(15, 5, NULL, '2022-08-08', 15),
(16, 6, NULL, '2023-03-03', 16),
(17, 7, NULL, '2021-11-11', 17),
(18, 8, NULL, '2020-02-02', 18),
(19, 9, NULL, '2023-05-05', 19),
(20, 10, NULL, '2022-07-07', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `walk`
--

CREATE TABLE `walk` (
  `id` int NOT NULL,
  `id_walker` int DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `idPlace` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `walk`
--

INSERT INTO `walk` (`id`, `id_walker`, `starts_at`, `ends_at`, `price`, `is_accepted`, `rating`, `idPlace`) VALUES
(1, 9, '2025-06-15 21:00:00', '2025-06-15 22:30:00', 21535.98, 1, 4, 9),
(2, 10, '2025-06-02 15:00:00', '2025-06-02 16:05:00', 17191.45, 1, 5, 6),
(3, 2, '2025-06-02 12:00:00', '2025-06-02 12:50:00', 22985.02, 1, 5, 9),
(4, 8, '2025-06-03 15:00:00', '2025-06-03 16:07:00', 27095.75, 1, 5, 4),
(5, 14, '2025-06-06 14:00:00', '2025-06-06 14:42:00', 26149.91, 1, 5, 5),
(6, 13, '2025-06-06 16:00:00', '2025-06-06 17:26:00', 27440.52, 1, 4, 8),
(7, 7, '2025-06-12 22:00:00', '2025-06-12 23:02:00', 27868.68, 1, 5, 9),
(8, 11, '2025-06-12 21:00:00', '2025-06-12 21:49:00', 18033.31, 1, 3, 3),
(9, 3, '2025-06-02 20:00:00', '2025-06-02 20:54:00', 18717.18, 1, 5, 2),
(10, 9, '2025-06-15 12:00:00', '2025-06-15 13:14:00', 28257.79, 1, 3, 2),
(11, 6, '2025-06-13 15:00:00', '2025-06-13 16:27:00', 15935.85, 1, 5, 6),
(12, 12, '2025-06-10 22:00:00', '2025-06-10 23:26:00', 15048.96, 1, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `walker`
--

CREATE TABLE `walker` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `rate_per_hour` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating_avg` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `walker`
--

INSERT INTO `walker` (`id`, `name`, `last_name`, `email`, `password`, `profile_picture`, `id_admin`, `is_active`, `rate_per_hour`, `description`, `rating_avg`) VALUES
(1, 'Lauren', 'Alvarez', 'walker1@mail.com', 'pass1', NULL, 2, 1, 24757.3, 'Experienced dog walker 1', 3.64),
(2, 'Danny', 'Sharp', 'walker2@mail.com', 'pass2', NULL, 1, 1, 21720.85, 'Experienced dog walker 2', 4.1),
(3, 'Dana', 'Fry', 'walker3@mail.com', 'pass3', NULL, 2, 1, 22721, 'Experienced dog walker 3', 4.94),
(4, 'Christian', 'Washington', 'walker4@mail.com', 'pass4', NULL, 1, 1, 24225.91, 'Experienced dog walker 4', 4.77),
(5, 'Elaine', 'Small', 'walker5@mail.com', 'pass5', NULL, 2, 1, 16293.79, 'Experienced dog walker 5', 3.36),
(6, 'Angela', 'Ryan', 'walker6@mail.com', 'pass6', NULL, 1, 1, 20689.2, 'Experienced dog walker 6', 4.62),
(7, 'Wendy', 'Aguilar', 'walker7@mail.com', 'pass7', NULL, 2, 1, 23564.8, 'Experienced dog walker 7', 3.93),
(8, 'Scott', 'Clark', 'walker8@mail.com', 'pass8', NULL, 1, 1, 19288.4, 'Experienced dog walker 8', 4.31),
(9, 'Melissa', 'Jones', 'walker9@mail.com', 'pass9', NULL, 2, 1, 17534.12, 'Experienced dog walker 9', 4.45),
(10, 'Christopher', 'Crawford', 'walker10@mail.com', 'pass10', NULL, 1, 1, 21630.55, 'Experienced dog walker 10', 4.08),
(11, 'Jessica', 'Lane', 'walker11@mail.com', 'pass11', NULL, 2, 1, 20385.1, 'Experienced dog walker 11', 3.98),
(12, 'Andrew', 'Terry', 'walker12@mail.com', 'pass12', NULL, 1, 1, 22456.73, 'Experienced dog walker 12', 4.7),
(13, 'Gary', 'Martinez', 'walker13@mail.com', 'pass13', NULL, 2, 1, 17384.99, 'Experienced dog walker 13', 3.74),
(14, 'Margaret', 'Foster', 'walker14@mail.com', 'pass14', NULL, 1, 1, 24832, 'Experienced dog walker 14', 4.21),
(15, 'Jose', 'Howard', 'walker15@mail.com', 'pass15', NULL, 2, 1, 18659.2, 'Experienced dog walker 15', 3.87);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `walkpuppy`
--

CREATE TABLE `walkpuppy` (
  `walk_id` int NOT NULL,
  `puppy_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `walkpuppy`
--

INSERT INTO `walkpuppy` (`walk_id`, `puppy_id`) VALUES
(8, 1),
(2, 2),
(4, 2),
(3, 3),
(1, 4),
(3, 8),
(6, 8),
(11, 8),
(4, 9),
(4, 10),
(6, 11),
(12, 11),
(2, 12),
(9, 12),
(9, 14),
(5, 16),
(10, 16),
(1, 17),
(5, 17),
(12, 17),
(7, 18),
(8, 18),
(7, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_walk` (`id_walk`);

--
-- Indices de la tabla `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puppy`
--
ALTER TABLE `puppy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owned_by` (`owned_by`),
  ADD KEY `id_breed` (`id_breed`);

--
-- Indices de la tabla `walk`
--
ALTER TABLE `walk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_walker` (`id_walker`),
  ADD KEY `idPlace` (`idPlace`);

--
-- Indices de la tabla `walker`
--
ALTER TABLE `walker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `walkpuppy`
--
ALTER TABLE `walkpuppy`
  ADD PRIMARY KEY (`walk_id`,`puppy_id`),
  ADD KEY `puppy_id` (`puppy_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`id_walk`) REFERENCES `walk` (`id`);

--
-- Filtros para la tabla `puppy`
--
ALTER TABLE `puppy`
  ADD CONSTRAINT `puppy_ibfk_1` FOREIGN KEY (`owned_by`) REFERENCES `owner` (`id`),
  ADD CONSTRAINT `puppy_ibfk_2` FOREIGN KEY (`id_breed`) REFERENCES `breed` (`id`);

--
-- Filtros para la tabla `walk`
--
ALTER TABLE `walk`
  ADD CONSTRAINT `walk_ibfk_1` FOREIGN KEY (`id_walker`) REFERENCES `walker` (`id`),
  ADD CONSTRAINT `walk_ibfk_2` FOREIGN KEY (`idPlace`) REFERENCES `place` (`id`);

--
-- Filtros para la tabla `walker`
--
ALTER TABLE `walker`
  ADD CONSTRAINT `walker_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `walkpuppy`
--
ALTER TABLE `walkpuppy`
  ADD CONSTRAINT `walkpuppy_ibfk_1` FOREIGN KEY (`walk_id`) REFERENCES `walk` (`id`),
  ADD CONSTRAINT `walkpuppy_ibfk_2` FOREIGN KEY (`puppy_id`) REFERENCES `puppy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
