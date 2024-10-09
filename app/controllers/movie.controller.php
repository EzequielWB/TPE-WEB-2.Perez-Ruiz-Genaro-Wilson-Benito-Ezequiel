<?php 
require_once './app/models/movie.model.php';
require_once './app/views/movie.view.php';

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

    // Método para mostrar películas por género
    public function showMoviesByGenre($genre_id) {
        $peliculas = $this->model->getMoviesByGenre($genre_id);
        $this->view->showMovies($peliculas, $genre_id); // Pasar el genre_id a la vista
    }

    // Método para mostrar géneros
    public function showGenres() {
        $genreModel = new MovieModel(); // Si tienes un método para obtener géneros en el mismo modelo
        $genres = $genreModel->getAllGenres(); // Asegúrate de que este método esté definido
        $this->view->showGenres($genres); // Mostrar los géneros
    }

    public function showAddMovieForm() {
        $genreModel = new MovieModel(); // Obtener todos los géneros para el formulario
        $genres = $genreModel->getAllGenres();
        $this->view->showAddMovieForm($genres); // Mostrar el formulario
    }

    // Método para insertar la película
    public function addMovie() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $director = $_POST['director'];
            $descripcion = $_POST['descripcion'];
            $genero = $_POST['genero'];

            // Insertar la película en la base de datos
            $result = $this->model->insertMovie($nombre, $director, $descripcion, $genero);

            if ($result) {
                // Redirigir o mostrar un mensaje de éxito
                echo "Película añadida con éxito.<span></span>";
                echo "<a href='?action=genre'>Volver atras</a>";
            } else {
                // Manejo de error
                echo "Error al añadir la película.";
            }
        }
    }

    public function deleteMovie() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id']; // Obtener el ID de la película a borrar
            $genre_id = $_POST['genre_id']; // Obtener el ID del género
    
            // Llamar al método del modelo para borrar la película
            $result = $this->model->deleteMovie($id);
    
            if ($result) {
                // Si se eliminó correctamente, volver a mostrar las películas del género
                echo "Película borrada con éxito.";
                // Mostrar las películas de ese género
                $this->showMoviesByGenre($genre_id); // Mostrar solo las películas de este género
            } else {
                // Manejo de error
                echo "Error al borrar la película.";
            }
        }
    }
}
?>
