<?php

//GENERO

class GenresView {
    
    function listGenres($genres) {
        require 'templates/layout/header.phtml';

        foreach($genres as $genre) {
            echo "<h1><a href='peliculas/$genre->id'> $genre->genero </a></h1>";
        }

        require 'templates/layout/footer.phtml';
    }
}

class AddGenreView {

    function showForm() {
        require 'templates/layout/header.phtml';
        echo "<h2>Añadir genero</h2>";
        require 'templates/form_add_genero.phtml';
        require 'templates/layout/footer.phtml';
    }

    function showError() {
        require 'templates/layout/header.phtml';
        echo "<h2>Error: Faltan datos</h2>";
        require 'templates/layout/footer.phtml';
    }
}

// PELICULAS

class MoviesView {
    
    function listMovies($movies) {
        require 'templates/layout/header.phtml';

        foreach($movies as $movie) {
            echo "<h1><a href='detalle/$movie->id'>$movie->nombre</a></a>";
        }
        echo "<h3><a href=''>Volver atras</a></h3>";

        require 'templates/layout/footer.phtml';
    }
}

class MovieDetailsView{

    function listDetails($movie){
        require 'templates/layout/header.phtml';

        echo "<h2>$movie->nombre</h2>";
        echo "<p>Director: $movie->director</p>";
        echo "<p>Descripcion: $movie->descripcion</p>";
        echo "<form action='borrar/$movie->id' method='POST'>";
        echo "<a href='editar/$movie->id' class='btn btn-primary'>EDITAR</a>";
        echo "<button type='submit' class='btn btn-danger'>BORRAR</button>";
        echo "</form>";

        require 'templates/layout/footer.phtml';
    }
}

// AÑADIR

class addMovieView{

    function addMovieVisual($genres) {

        require 'templates/layout/header.phtml';
        echo "<h2>Añadir película</h2>";
        require 'templates/form_add_pelicula.phtml';
        require 'templates/layout/footer.phtml';
    }

    function showError() {
        require 'templates/layout/header.phtml';
        echo "<h2>Error: Faltan datos</h2>";
        require 'templates/layout/footer.phtml';
    }
}