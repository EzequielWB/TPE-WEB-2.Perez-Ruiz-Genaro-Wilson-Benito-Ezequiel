<?php

include_once 'app/controllers/movies.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// Obtener acción desde la URL (por defecto 'genre')
$action = 'principal';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'principal';
}

$params = explode('/',$action);

$controllerGenres = new GenreController(); //llamo al controller de otro archivo
$controllerMovie = new MovieController();
$controllerAddMovie = new addMovieController();
$controllerDeleteMovie = new MovieController();

switch ($params[0]) {

    case 'principal':
        $controllerGenres->showGenres();
    break;

    case 'peliculas':
        if (isset($params[1])) {
            $genreId = $params[1];  
            $controllerMovie->showMoviesByGenre($genreId); 
        } else {
            $controllerGenres->showGenres();
        }
    break;

    case 'detalle':
            $movieId = $params[1]; // id desde url
            $controllerMovie->showMovieDetails($movieId);
    break;

    case 'añadir':
        $controllerAddMovie->addMovieGenres();  
    break;

    case 'guardar': 
        $controllerAddMovie->addMovieControl(); 
    break;

    case 'borrar':
        $controllerDeleteMovie->deleteMovie($params[1]);
    break;
}
?>
