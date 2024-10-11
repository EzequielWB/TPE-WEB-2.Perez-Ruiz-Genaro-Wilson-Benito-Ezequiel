<?php 
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';


class MovieController {
    private $model;
    private $view;

    public function __construct(){
        $this->model = new MovieModel();
        $this->view = new MovieView();
    }

    public function showMovies() {
        $peliculas = $this->model->getAllMovies();
        $this->view->showMovies($peliculas);
    }

    // Nuevo método para mostrar películas por género
    public function showMoviesByGenre($genre_id) {
        $peliculas = $this->model->getMoviesByGenre($genre_id);
        $this->view->showMovies($peliculas);
    }
}

class GenreController {
    private $model;
    private $view;

    public function __construct(){
        $this->model = new GenresModel(); // El nombre correcto es GenresModel, no genresModel
        $this->view = new GenresView(); // Cambiar a GenresView
    }

    public function showGenres() {
        $genres = $this->model->getAllGenres();
        $this->view->showGenres($genres);
    }
}
?>
