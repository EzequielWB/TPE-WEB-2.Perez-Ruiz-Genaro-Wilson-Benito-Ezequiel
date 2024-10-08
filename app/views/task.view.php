<?php

class movieView {

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
}