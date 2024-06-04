<?php
require_once '../modelo/eloquent.php';
$conexion = new Conexion();
$capsule = $conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido los datos del formulario
    if (isset($_POST['movie_id']) && isset($_POST['new_name'])) {
        
        // Obtener los datos del formulario
        $movie_id = $_POST['movie_id'];
        $new_name = $_POST['new_name'];

        try {
            // Actualizar el nombre de la película con Eloquent
            $pelicula = Pelicula::findOrFail($movie_id);
            if ($pelicula) {
                $pelicula->nombre = $new_name;
                $pelicula->save();

                if ($pelicula->wasChanged()) {
                    echo "El nombre de la película con ID $movie_id se actualizó correctamente.";
                } else {
                    echo "El nombre de la película con ID $movie_id ya está actualizado o no se encontró.";
                }
            } else {
                echo "No se encontró ninguna película con el ID $movie_id.";
            }
        } catch (Exception $e) {
            echo "Error al actualizar el nombre de la película: " . $e->getMessage();
        }
    } else {
        echo "Se requieren tanto el ID de la película como el nuevo nombre.";
    }
}


$peliculas = Pelicula::all();

$peliculas = Pelicula::all();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Nombre de Película</title>
    <link rel="stylesheet" href="../stilos/stilo2.css">
</head>

<body>
    <header>
        <h1>Actualizar Nombre de Película</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../vista/index.php">Volver al inicio</menu></a></li>
        </ul>
    </nav>

    <section class="form-container">
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </section>

    <section class="products">
       
        <?php if (isset($peliculas)) : ?>
            <?php foreach ($peliculas as $pelicula) : ?>
                <article class="product">
                    <p>ID: <?php echo $pelicula->id; ?></p>
                    <p>Nombre: <?php echo $pelicula->nombre; ?></p>
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $pelicula->poster; ?>" alt="<?php echo $pelicula->nombre; ?>" class="pelicula-poster">
                    <p>Descripción: <?php echo $pelicula->descripcion; ?></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="update-form">
                        <label for="new_name_<?php echo $pelicula->id; ?>">Nuevo Nombre:</label>
                        <input type="text" id="new_name_<?php echo $pelicula->id; ?>" name="new_name" required>
                        <input type="hidden" name="movie_id" value="<?php echo $pelicula->id; ?>">
                        <button type="submit">Actualizar Nombre</button>
                    </form>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay películas disponibles</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2024 PelisPrime</p>
    </footer>
</body>
</html>
