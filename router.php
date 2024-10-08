<?php
require_once './app/controllers/task.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'movie';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/',$action);

$movieController = new MovieController();

switch ($params[0]) {
    case 'movie':
        $movieController->showMovies();
        break;
    default:
        echo('404 Page not Found');
        break;
}