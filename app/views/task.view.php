<?php

class movieView {

    function showMovies($movies) {
        
        echo '<ul>';
        foreach ($movies as $movie) {
           echo "<li>
                    <span> <b>$movie->nombre</b> - $movie->director (prioridad $movie->descripcion) </span>
                </li>";
        }
        echo "</ul>";
    
    }
}