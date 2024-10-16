<?php

require_once './config.php'; 
require_once './app/models/DB.Model.php';

// GENERO

class GenresModel {

    private $db;

    public function connect() {
       
        $dbModel = new DBModel();
        $this->db = $dbModel->db; 
    }

    function getGenres() {

        $db = $this->connect(); //conexion (this para llamar a funcion connect) //VER

        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();

        $genres = $query->fetchAll(PDO::FETCH_OBJ);

        return $genres; //esto se pasa al view
    }
}

// PELICULAS

class MoviesModel {

    private $db;

    function connect(){
        $dbModel = new DBModel();
        $this->db = $dbModel->db; 
    }

    function getMoviesByGenre($genreId) {

        $db = $this->connect(); 

        $query = $this->db->prepare('SELECT * FROM peliculas WHERE genero = ?');
        $query->execute([$genreId]);

        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }

    function getMovieById($movieId) {
        $db = $this->connect();

        $query =$this->db->prepare('SELECT * FROM peliculas WHERE id = ?');
        $query->execute([$movieId]);
        return $query->fetch(PDO::FETCH_OBJ); 
    }

    public function eraseMovie($movieId) {
        $db = $this->connect(); 
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id = ?');
        $query->execute([$movieId]);
    }

    function updateMovie($id, $nombre, $director, $descripcion, $genero) {
        $db = $this->connect();
        $query = $this->db->prepare('UPDATE peliculas SET nombre = ?, director = ?, descripcion = ?, genero = ? WHERE id = ?');
        $query->execute([$nombre, $director, $descripcion, $genero, $id]);
    }
}

// AÑADIR

class AddMovieModel{

    private $db;

    function connect(){
        $dbModel = new DBModel();
        $this->db = $dbModel->db; 
    }

    function addMovie($nombre, $director, $descripcion, $genero) {
        $db = $this->connect();

        $query = $this->db->prepare('INSERT INTO peliculas (nombre, director, descripcion, genero) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $director, $descripcion, $genero]);
    }

}

class AddGenreModel {

    private $db;

    function connect(){
        $dbModel = new DBModel();
        $this->db = $dbModel->db; 
    }

    function addGenre($nombre) {
        $db = $this->connect();
        $query = $this->db->prepare('INSERT INTO generos (genero) VALUES (?)');
        $query->execute([$nombre]);
    }

}



