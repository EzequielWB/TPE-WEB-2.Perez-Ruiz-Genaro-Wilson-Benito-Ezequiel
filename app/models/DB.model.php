<?php

class DBModel {
    public $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    public function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if(count($tables) == 0) {
            $sql =<<<END
            -- Crear la base de datos si no existe
            CREATE DATABASE IF NOT EXISTS `catalogo_peliculas` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
            USE `catalogo_peliculas`;
    
            -- Crear tabla generos
            CREATE TABLE `generos` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `genero` varchar(20) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
    
            -- Insertar datos en la tabla generos
            INSERT INTO `generos` (`id`, `genero`) VALUES
            (1, 'Terror'),
            (2, 'Comedia'),
            (3, 'Accion'),
            (4, 'Romance')
            ON DUPLICATE KEY UPDATE genero = VALUES(genero);
    
            -- Crear tabla peliculas
            CREATE TABLE `peliculas` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(40) NOT NULL,
              `director` varchar(40) NOT NULL,
              `descripcion` text NOT NULL,
              `genero` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `id_genero` (`genero`),
              CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `generos` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
    
            -- Insertar datos en la tabla peliculas
            INSERT INTO `peliculas` (`id`, `nombre`, `director`, `descripcion`, `genero`) VALUES
            (1, 'Accion Desenfrenada', 'Juan Acciones', 'Pelicula de Accion', 3),
            (2, 'Comida simpatica', 'Maria Chistosa', 'Muchas risas', 2),
            (3, 'Amor desenfrenado', 'Alfredo Amoroso', 'Amor y amor', 4),
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
            (24, 'Hasta el último suspiro', 'María Enamorada', 'Un romance trágico que desafía la muerte misma', 4),
            (25, 'Aventuras terrorificas', 'Marcos Diabolico', 'Terror sin fin', 1);
    
            -- Crear tabla usuarios
            CREATE TABLE `usuarios` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `usuario` varchar(100) NOT NULL,
              `password` char(60) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`, `usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
    
            -- Insertar datos en la tabla usuarios
            INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
            (1, 'webadmin', '$2y$10$It/tLtd9oUs8wGHLCLcP1OIHa2AFsLR63FH8AZQ1I1eIWRIyEmH.u')
            ON DUPLICATE KEY UPDATE usuario = VALUES(usuario);
    
    END;
    
            // Ejecutar las consultas SQL para crear las tablas y llenar los datos iniciales
            $this->db->exec($sql);
        }
    }
}