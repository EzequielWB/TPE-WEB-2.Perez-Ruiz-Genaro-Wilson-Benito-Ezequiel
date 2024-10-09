<?php
require_once './app/controllers/movie.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// Obtener acción desde la URL (por defecto 'genre')
$action = 'genre';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Inicializar controlador de películas
$movieController = new MovieController();

switch ($params[0]) {
    case 'genre':
        $movieController->showGenres(); // Llamar al método que muestra los géneros
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
    case 'addMovie':
        $movieController->showAddMovieForm(); // Método para mostrar el formulario
        break;
    case 'insertMovie':
        $movieController->addMovie(); // Inserta la película
        break;
    case 'deleteMovie':
        $movieController->deleteMovie(); // Manejar la eliminación de la película
        break;
    default:
        echo('404 Page not Found');
        break;
}
?>
