-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 21:20:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogo_peliculas`
--
CREATE DATABASE IF NOT EXISTS `catalogo_peliculas` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `catalogo_peliculas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `genero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`) VALUES
(1, 'Terror'),
(2, 'Comedia'),
(3, 'Accion'),
(4, 'Romance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `director` varchar(40) NOT NULL,
  `descripcion` text NOT NULL,
  `genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `nombre`, `director`, `descripcion`, `genero`) VALUES
(1, 'Accion Desenfrenada', 'Juan Acciones', 'Pelicula de Accion', 3),
(2, 'Comida simpatica', 'Maria Chistosa', 'Muchas risas', 2),
(3, 'Amor desenfrenado', 'Alfedro Amoroso', 'Amor y amor', 4),
(4, 'Muerte frenetica', 'Manuel Federico', 'En esta pelicula podras encontrar mucha muerte', 3),
(5, 'La noche oscura', 'Carlos Tétrico', 'Una historia aterradora en una mansión maldita', 1),
(6, 'El susurro del miedo', 'Ana Tenebrosa', 'Un susurro en la oscuridad que aterra a todos', 1),
(7, 'El espejo roto', 'Lucía Miedosa', 'Cada reflejo muestra un destino fatal', 1),
(8, 'El fantasma silencioso', 'Pedro Sombrío', 'Un espectro que aterroriza sin ser visto', 1),
(9, 'Los gritos del bosque', 'Jorge Escalofríos', 'Un bosque donde los árboles gritan en la noche', 1),
(10, 'Risas inesperadas', 'Sofía Alegre', 'Una serie de eventos hilarantes y fuera de control', 2),
(11, 'Un día sin pantalones', 'Carlos Risueño', 'El caos de un hombre que se olvida de su ropa', 2),
(12, 'La cena desastrosa', 'María Graciosa', 'Una cena que sale terriblemente mal pero con mucha diversión', 2),
(13, 'Casi famosos', 'Pedro Bromista', 'Un grupo de amigos que accidentalmente se vuelven celebridades', 2),
(14, 'Los errores felices', 'Ana Cómica', 'Una cadena de errores que resultan en momentos divertidos', 2),
(15, 'Misión explosiva', 'Juan Valiente', 'Una misión con explosiones y mucha adrenalina', 3),
(16, 'Carrera contra el tiempo', 'Carlos Acelerado', 'Un hombre tiene solo 24 horas para salvar el mundo', 3),
(17, 'El rescate imposible', 'María Intrépida', 'Una operación de rescate en lo más profundo del océano', 3),
(18, 'La batalla final', 'Pedro Guerrero', 'Una pelea épica entre dos ejércitos invencibles', 3),
(19, 'Fuerza de acero', 'Ana Férrea', 'Una agente secreta lucha contra una organización criminal', 3),
(20, 'El amor inesperado', 'Juan Corazón', 'Dos extraños que se enamoran durante un viaje', 4),
(21, 'Besos en París', 'Ana Romántica', 'Una historia de amor ambientada en la ciudad del amor', 4),
(22, 'Amor a la deriva', 'Carlos Enamorado', 'Una pareja que sobrevive a un naufragio en una isla', 4),
(23, 'Bajo la lluvia', 'Pedro Pasión', 'Un amor que florece durante una tormenta', 4),
(24, 'Hasta el último suspiro', 'María Enamorada', 'Un romance trágico que desafía la muerte misma', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genero` (`genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `generos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
