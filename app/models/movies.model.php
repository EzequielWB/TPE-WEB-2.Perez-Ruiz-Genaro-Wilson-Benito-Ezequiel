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
