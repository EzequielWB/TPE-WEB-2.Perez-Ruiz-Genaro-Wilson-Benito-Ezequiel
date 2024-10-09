<<<<<<< HEAD
<?php

$nombre_genero = $_GET['genre'];

//conexion a base de datos 
$db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');

$query = $db->prepare('SELECT id, genero FROM generos WHERE genero = ?');
$query->execute([$nombre_genero]);
$genre = $query->fetch(PDO::FETCH_OBJ);

// Consulta para obtener las películas relacionadas con el género
$query = $db->prepare('SELECT nombre, director, descripcion FROM peliculas WHERE genero = ?');
$query->execute([$genre->id]);
$movies = $query->fetchAll(PDO::FETCH_OBJ);


echo "<h1>Genero: $genre->genero</h1>";
echo "
    <ul>";
        foreach ($movies as $movie) {
            echo "<li>
                    <h3>Nombre: $movie->nombre</h3>
                    <p>Dirijida por: $movie->director</p>
                    <p>Descripcion breve: $movie->descripcion</p>
                </li>";
    }
echo"</ul>";

?>

<p><a href="../TPE/index.html">Volver al inicio</a></p>
=======
<?php

$nombre_genero = $_GET['genre'];

//conexion a base de datos 
$db = new PDO('mysql:host=localhost;'.'dbname=catalogo_peliculas;charset=utf8', 'root', '');

$query = $db->prepare('SELECT id, genero FROM generos WHERE genero = ?');
$query->execute([$nombre_genero]);
$genre = $query->fetch(PDO::FETCH_OBJ);

// Consulta para obtener las películas relacionadas con el género
$query = $db->prepare('SELECT nombre, director, descripcion FROM peliculas WHERE genero = ?');
$query->execute([$genre->id]);
$movies = $query->fetchAll(PDO::FETCH_OBJ);


echo "<h1>Genero: $genre->genero</h1>";
echo "
    <ul>";
        foreach ($movies as $movie) {
            echo "<li>
                    <h3>Nombre: $movie->nombre</h3>
                    <p>Dirijida por: $movie->director</p>
                    <p>Descripcion breve: $movie->descripcion</p>
                </li>";
    }
echo"</ul>";

?>

<p><a href="../TPE/index.html">Volver al inicio</a></p>
>>>>>>> 63bb51f (Añadido MVC y router)
