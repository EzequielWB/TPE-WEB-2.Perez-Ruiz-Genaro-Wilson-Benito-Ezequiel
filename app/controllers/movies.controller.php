<?php

require_once 'app/models/movies.model.php';
require_once 'app/views/movies.view.php';

//GENERO

class GenreController {

    private $model;
    private $view;

    function __construct() { //el constructor es necesario ya que inicializamos el modelo y vista
        $this->model = new GenresModel();
        $this->view = new GenresView();
    }

    function showGenres(){

        $genres = $this->model->getGenres(); //entramos a model

        $this->view->listGenres($genres);//Actualizo vista
    }

    function deleteGenre($genreId) {
        $this->model->deleteGenre($genreId); 
        header('Location: ' . BASE_URL . 'principal'); 
    }

    
}

class AddGenreController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new AddGenreModel();
        $this->view = new AddGenreView();
    }

    function showAddGenreForm() {
        $this->view->showForm();
    }

    function saveGenre() {
        $nombre = $_POST['genero'];
        $this->model->addGenre($nombre);

        header('Location: ' . BASE_URL . 'principal');
    }

    function editGenre($genreId) {
        $genre = $this->model->getGenreById($genreId); 
        $this->view->showEditForm($genre); 
    }

    function updateGenre() {
        $id = $_POST['id']; // el id viene del form
        $nombre = $_POST['genero'];
        $this->model->updateGenre($id, $nombre);
        header('Location: ' . BASE_URL . 'principal');
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

    function showMoviesByGenre($genreId) {
        $movies = $this->model->getMoviesByGenre($genreId); // peliculas por genero
        $this->view->listMovies($movies, $genreId); // pasamos peliculas y genero
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
        require 'templates/form_add_pelicula.phtml'; //mismo form
        require 'templates/layout/footer.phtml'; 
        
    }

    function saveEdit() {

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

        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $descripcion = $_POST['descripcion'];
        $genero = $_POST['genero'];

        $id = $this->model->addMovie($nombre, $director, $descripcion, $genero);

        header('Location: ' . BASE_URL . 'principal');
    }
}