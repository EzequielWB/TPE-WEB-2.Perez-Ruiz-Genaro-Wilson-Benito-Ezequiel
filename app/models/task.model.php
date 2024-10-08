<?php

class MovieModel {

    private $db; //variable base de datos 

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');
    }

    public function getAllMovies() {

        $query = $this->db->prepare("SELECT * FROM peliculas");
        $query->execute();

        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }


}
?>