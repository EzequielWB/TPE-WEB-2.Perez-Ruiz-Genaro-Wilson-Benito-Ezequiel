<?php
require_once './app/controllers/task.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// Obtener acción desde la URL (por defecto 'genre')
$action = 'genre';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/',$action);

// Inicializar controladores
$movieController = new MovieController();
$genreController = new GenreController();

switch ($params[0]) {
    case 'genre':
        $genreController->showGenres();
        break;
    case 'movie':
        $movieController->showMovies();
        break;
    case 'moviesByGenre':
        if (isset($params[1])) { // Verificar si se pasó un ID de género
            $genre_id = $params[1];
            $movieController->showMoviesByGenre($genre_id);
        } else {
            echo('404 Page not Found');
        }
        break;
    default:
        echo('404 Page not Found');
        break;
}
?>
