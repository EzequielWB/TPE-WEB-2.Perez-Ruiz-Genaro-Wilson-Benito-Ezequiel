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
}