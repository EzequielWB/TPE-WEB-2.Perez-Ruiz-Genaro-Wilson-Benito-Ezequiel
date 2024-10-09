<?php

class MovieView {
    function showMovies($movies, $genre_id) { // Modificar la firma del método para recibir el genre_id
        echo '<ul>';
        foreach ($movies as $movie) {
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span><h1>$movie->nombre</h1></span>
                    <form method='POST' action='" . BASE_URL . "deleteMovie' style='display:inline;'>
                        <input type='hidden' name='id' value='$movie->id'> <!-- ID de la película -->
                        <input type='hidden' name='genre_id' value='$genre_id'> <!-- ID del género -->
                        <input type='submit' value='Borrar' onclick='return confirm(\"¿Estás seguro de que deseas borrar esta película?\")'>
                    </form>
                  </li>";
        }
        echo "</ul>";
        echo "<a href='?action=genre'>Volver atras</a>";
    }

    function showGenres($genres) {
        echo '<h1>Generos</h1>';
        echo '<ul>';
        foreach ($genres as $genre) {
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span><a href='?action=moviesByGenre/$genre->id'><h1>$genre->genero</h1></a></span>
                  </li>";
        }
        echo "</ul>";
        echo '<h2><a href="?action=addMovie">Añadir pelicula</a></h2>'; // Enlace para agregar película
    }

    public function showAddMovieForm($genres) {
        echo '<h1>Añadir pelicula</h1>';
        echo '<form method="POST" action="' . BASE_URL . 'insertMovie">'; // Cambiar a insertMovie
        echo '<label for="nombre">Movie Name:</label>';
        echo '<input type="text" name="nombre" required>';
        
        echo '<label for="director">Director:</label>';
        echo '<input type="text" name="director" required>';
        
        echo '<label for="descripcion">Description:</label>';
        echo '<textarea name="descripcion" required></textarea>';
        
        echo '<label for="genero">Genre:</label>';
        echo '<select name="genero" required>';
        foreach ($genres as $genre) {
            echo "<option value='$genre->id'>$genre->genero</option>";
        }
        echo '</select>';
        
        echo '<input type="submit" value="Añadir pelicula">';
        echo "<a href='?action=genre'>Volver atras</a>";
        echo '</form>';
    }
}

class GenresView {
    function showGenres($genres) {
        echo '<ul>';
        foreach ($genres as $genre) {
            echo "<li style='border:1px solid black; margin-bottom:1px'>
                    <span><a href='?action=moviesByGenre/$genre->id'><h1>$genre->genero</h1></a></span>
                  </li>";
        }
        echo "</ul>";

        echo "<a href='?action=genre'>Volver atras</a>";
    }
}
?>