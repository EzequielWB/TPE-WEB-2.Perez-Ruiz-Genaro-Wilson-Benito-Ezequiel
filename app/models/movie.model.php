<?php

class MovieModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=catalogo_peliculas;charset=utf8', 'root', '');
    }

    // Método para obtener todas las películas
    public function getAllMovies() {
        $query = $this->db->prepare("SELECT * FROM peliculas");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para obtener películas por género
    public function getMoviesByGenre($genre_id) {
        $query = $this->db->prepare("SELECT * FROM peliculas WHERE genero = ?");
        $query->execute([$genre_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para insertar una nueva película
    public function insertMovie($nombre, $director, $descripcion, $genero) {
        $query = $this->db->prepare('INSERT INTO peliculas(nombre, director, descripcion, genero) VALUES (?, ?, ?, ?)');
        return $query->execute([$nombre, $director, $descripcion, $genero]);
    }

    public function deleteMovie($id) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id = ?');
        return $query->execute([$id]); // Retorna verdadero si se ejecuta con éxito
    }

    // Método para obtener todos los géneros
    public function getAllGenres() {
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
