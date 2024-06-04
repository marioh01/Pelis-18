<?php
require_once __DIR__ . '/../modelo/eloquent.php';

// Solo define la función si aún no existe
if (!function_exists('obtenerPeliculas')) {
    // Función para obtener la información de todas las películas desde la base de datos
    function obtenerPeliculas() {
        try {
            // Conectarse a la base de datos
            $conexion = new Conexion();
            $capsule = $conexion->conectar();

            // Obtener todas las películas de la tabla 'peliculas'
            $peliculas = Pelicula::all();

            return $peliculas;
        } catch (Exception $e) {
            echo "Error al obtener películas desde la base de datos: " . $e->getMessage();
            return [];
        }
    }
}

// Llamar a la función para obtener las películas
$peliculas = obtenerPeliculas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stilos/stilo2.css">
    <link rel="stylesheet" href="../stilos/stiloIndex.css">
    <title>PelisPrime</title>
    <style>
       
    </style>
</head>
<body>
    <header>
        <h1>PelisPrime</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../controlador/insertarMensaje.php">Contactanos</a></li>
            <li><a href="../controlador/eliminarpeli.php">Eliminar películas</a></li>
            <li><a href="../controlador/Actualizarpeli.php">Actualizar películas</a></li>
            <li><a href="../modelo/api.php">api</a></li>
        </ul>
    </nav>

    <section class="products">
    <?php if ($peliculas->isEmpty()): ?>
        <p>No se encontraron películas.</p>
    <?php else: ?>
        <?php foreach ($peliculas as $pelicula): ?>
            <div class="pelicula-card">
            <img src="https://image.tmdb.org/t/p/w500<?php echo $pelicula->poster; ?>" alt="<?php echo $pelicula->nombre; ?>"  class="pelicula-poster">

                <div class="pelicula-info">
                    <h2 class="pelicula-title"><?php echo $pelicula->nombre; ?></h2>
                    <p class="pelicula-description"><?php echo $pelicula->descripcion; ?></p>
                    <?php if (!empty($pelicula->trailerkey)): ?>
                        <iframe class="trailer-video" src="https://www.youtube.com/embed/<?php echo $pelicula->trailerkey; ?>" frameborder="0" allowfullscreen></iframe>
                    <?php else: ?>
                        <p>No hay trailer disponible para esta película.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
    </section>

    <footer>
        <p>&copy; 2024 PelisPrime</p>
    </footer>
</body>
</html>