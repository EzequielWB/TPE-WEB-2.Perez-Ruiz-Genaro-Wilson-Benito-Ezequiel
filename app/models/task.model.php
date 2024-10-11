<?php

class MovieModel {

    private $db; // Variable base de datos

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
    }

    public function getAllMovies() {
        $query = $this->db->prepare("SELECT * FROM peliculas");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Nuevo método para obtener películas por género
    public function getMoviesByGenre($genre_id) {
        // Cambiar el filtro a 'genero' en lugar de 'id'
        $query = $this->db->prepare("SELECT * FROM peliculas WHERE genero = ?");
        $query->execute([$genre_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}

class genresModel {

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
    }

    public function getAllGenres() {
        $query = $this->db->prepare("SELECT * FROM generos");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
