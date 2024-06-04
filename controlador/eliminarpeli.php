<?php

require_once('../modelo/eloquent.php');

        $conexion = new Conexion();
        $capsule = $conexion->conectar();
      

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_pelicula"])) {
    $id_a_eliminar = $_POST["eliminar_pelicula"];

    try {
        // Buscar la película con el ID proporcionado
        $pelicula = Pelicula::findOrFail($id_a_eliminar);

        // Eliminar la película
        $pelicula->delete();

        echo "Película eliminada exitosamente.";
    } catch (ModelNotFoundException $e) {
        echo "No se encontró la película con el ID proporcionado.";
    } catch (Exception $e) {
        echo "Ocurrió un error al eliminar la película: " . $e->getMessage();
    }
}

// Obtener todas las películas
$peliculas = Pelicula::all();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stilos/stilo2.css">
    <title>Eliminar Película</title>
</head>
<body>
    <header>
        <h1>Eliminar Película</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../vista/index.php">Volver al inicio</a></li>
        </ul>
    </nav>

    <section class="products">
        <?php 
        if (isset($peliculas) && $peliculas->count() > 0) {
            foreach ($peliculas as $pelicula) : ?>
                <article class="product">
                    <p>ID: <?php echo $pelicula->id; ?></p>
                    <p>Nombre: <?php echo $pelicula->nombre; ?></p>
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $pelicula->poster; ?>" alt="<?php echo $pelicula->nombre; ?>" class="pelicula-poster">
                    <p>Descripción: <?php echo $pelicula->descripcion; ?></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta película?');">
                        <input type="hidden" name="eliminar_pelicula" value="<?php echo $pelicula->id; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </article>
            <?php endforeach;
        } else {
            echo "<p>No hay películas disponibles</p>";
        } ?>
    </section>

    <footer>
        <p>© 2024 PelisPrime</p>
    </footer>
</body>
</html>
