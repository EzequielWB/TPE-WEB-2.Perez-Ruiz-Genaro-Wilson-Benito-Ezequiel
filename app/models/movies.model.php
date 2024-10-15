<?php

// GENERO

class GenresModel {

    private $db;

    function connect(){
        $db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
        return $db;
    }

    function getGenres() {

        $db = $this->connect(); //conexion (this para llamar a funcion connect) //VER

        $query = $db->prepare('SELECT * FROM generos');
        $query->execute();

        $genres = $query->fetchAll(PDO::FETCH_OBJ);

        return $genres; //esto se pasa al view
    }
}

// PELICULAS

class MoviesModel {

    private $db;

    function connect(){
        $db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
        return $db;
    }

    function getMoviesByGenre($genreId) {

        $db = $this->connect(); 

        $query = $db->prepare('SELECT * FROM peliculas WHERE genero = ?');
        $query->execute([$genreId]);

        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }

    function getMovieById($movieId) {
        $db = $this->connect();

        $query = $db->prepare('SELECT * FROM peliculas WHERE id = ?');
        $query->execute([$movieId]);
        return $query->fetch(PDO::FETCH_OBJ); 
    }

    public function eraseMovie($movieId) {
        $db = $this->connect(); 
        $query = $db->prepare('DELETE FROM peliculas WHERE id = ?');
        $query->execute([$movieId]);
    }

    function updateMovie($id, $nombre, $director, $descripcion, $genero) {
        $db = $this->connect();
        $query = $db->prepare('UPDATE peliculas SET nombre = ?, director = ?, descripcion = ?, genero = ? WHERE id = ?');
        $query->execute([$nombre, $director, $descripcion, $genero, $id]);
    }
}

// AÑADIR

class AddMovieModel{

    private $db;

    function connect(){
        $db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
        return $db;
    }

    function addMovie($nombre, $director, $descripcion, $genero) {
        $db = $this->connect();

        $query = $db->prepare('INSERT INTO peliculas (nombre, director, descripcion, genero) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $director, $descripcion, $genero]);
    }

}

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
            
            CREATE TABLE `generos` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `genero` varchar(20) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

            INSERT INTO `generos` (`id`, `genero`) VALUES
            (1, 'Terror'),
            (2, 'Comedia'),
            (3, 'Accion'),
            (4, 'Romance');

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

            INSERT INTO `peliculas` (`id`, `nombre`, `director`, `descripcion`, `genero`) VALUES
            (1, 'Accion Desenfrenada', 'Juan Acciones', 'Pelicula de Accion', 3),
            (2, 'Comida simpatica', 'Maria Chistosa', 'Muchas risas', 2),
            (3, 'Amor desenfrenado', 'Alfredo Amoroso', 'Amor y amor', 4),
            (4, 'Muerte frenetica', 'Manuel Federico', 'En esta pelicula podras encontrar mucha muerte', 3),
            (5, 'La noche oscura', 'Carlos Tétrico', 'Una historia aterradora en una mansión maldita', 1);

            CREATE TABLE `usuarios` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `usuario` varchar(100) NOT NULL,
              `password` char(60) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`,`usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

            INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
            (1, 'webadmin', '$2y$10$It/tLtd9oUs8wGHLCLcP1OIHa2AFsLR63FH8AZQ1I1eIWRIyEmH.u');

            END;
    $this->db->query($sql);
        }
    }
}

