<?php

include_once 'app/models/movies.model.php';
include_once 'app/views/movies.view.php';

//GENERO

class GenreController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new GenresModel();
        $this->view = new GenresView();
    }

    function showGenres(){

        $genres = $this->model->getGenres(); //entramos a model

        $this->view->listGenres($genres);//Actualizo vista
    }
}

//PELICULA

class MovieController {

    private $model;
    private $view;
    private $details;

    function __construct() {
        $this->model = new MoviesModel();
        $this->view = new MoviesView();
        $this->details = new MovieDetailsView();
    }

    function showMoviesByGenre($genreId){

        $movies = $this->model->getMoviesByGenre($genreId); //entramos a model
        $this->view->listMovies($movies);//Actualizo vista
    }

    function showMovieDetails($movieId) {
        $movie = $this->model->getMovieById($movieId); 
        $this->details->listDetails($movie); 
    }

    function deleteMovie($movieId) {
        $this->model->eraseMovie($movieId); 
        header('Location: ' . BASE_URL); 
    }

    function showEdit($movieId) {
        $movie = $this->model->getMovieById($movieId); 
        $genresModel = new GenresModel(); 
        $genres = $genresModel->getGenres();
        require 'templates/layout/header.phtml'; 
        require 'templates/form_edit_pelicula.phtml'; 
        require 'templates/layout/footer.phtml'; 
        
    }

    function saveEdit() {
        if (!isset($_POST['nombre']) || !isset($_POST['director']) || !isset($_POST['descripcion']) || !isset($_POST['genero']) || !isset($_POST['id'])) {
            die("Faltan datos");
        }

        $id = $_POST['id']; 
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $descripcion = $_POST['descripcion'];
        $genero = $_POST['genero'];

        $this->model->updateMovie($id, $nombre, $director, $descripcion, $genero);

        header('Location: ' . BASE_URL . 'detalle/'.$id); //redirije(redirige?) a el id de la pelicula editada asi se ve el cambio 
    }
}

// AÑADIR

class addMovieController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new AddMovieModel();
        $this->view = new AddMovieView();
    }

    function addMovieGenres() {
        $genresModel = new GenresModel();  // modelo de generos
        $genres = $genresModel->getGenres(); // generos desde la base de datos
        $this->view->addMovieVisual($genres); // Pasa los generos a la vista
    }

    function addMovieControl() { // FUNCTION ES METODO

        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        
        if (!isset($_POST['director']) || empty($_POST['director'])) {
            return $this->view->showError('Falta completar el director');
        }

        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la descripción');
        }

        if (!isset($_POST['genero']) || empty($_POST['genero'])) {
            return $this->view->showError('Falta seleccionar el genero');
        }

        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $descripcion = $_POST['descripcion'];
        $genero = $_POST['genero'];

        $id = $this->model->addMovie($nombre, $director, $descripcion, $genero);

        header('Location: ' . BASE_URL . 'principal');
    }
}