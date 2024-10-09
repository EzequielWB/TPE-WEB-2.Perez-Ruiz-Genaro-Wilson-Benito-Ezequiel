<?php

class MovieView {
    function showMovies($movies) {
        echo '<ul>';
        foreach ($movies as $movie) {
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span> <h1>$movie->nombre</h1> <h3>$movie->director</h3> </span>
                        <p>$movie->descripcion</p>
                </li>";
        }
        echo "</ul>";
    }

    // Método para mostrar géneros
    function showGenres($genres) {
        echo '<ul>';
        foreach ($genres as $genre) {
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span><a href='?action=moviesByGenre/$genre->id'><h1>$genre->genero</h1></a></span>
                  </li>";
        }
        echo "</ul>";
    }
}

class GenresView {

    function showGenres($genres) {
        echo '<ul>';
        foreach ($genres as $genre) {
            // Crear enlaces con los géneros que al hacer clic redirigen a `moviesByGenre`
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span><a href='?action=moviesByGenre/$genre->id'><h1>$genre->genero</h1></a></span>
                  </li>";
        }
        echo "</ul>";
    }
}
?>
