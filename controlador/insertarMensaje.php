<?php

require_once('../modelo/eloquent.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        
        $conexion = new Conexion();
        $capsule = $conexion->conectar();
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $celular = $_POST["celular"];
        $mensaje = $_POST["mensaje"];
        $fechaEnvio = date("Y-m-d H:i:s");

        // Crear un nuevo mensaje de contacto
        Contacto::create([
            'nombre' => $nombre,
            'correo' => $correo,
            'celular' => $celular,
            'mensaje' => $mensaje,
            'fechaenvio' => $fechaEnvio,
        ]);

        echo "Dato insertado correctamente";
    } catch (Exception $e) {
        echo "No se insertó el dato, error:<br>" . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stilos/stilo2.css">
    <title>Contactanos</title>
</head>
<body>
    <header>
        <h1>Contactanos</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../vista/index.php">Volver al inicio</menu></a></li>
        </ul>
    </nav>

    <section class="contact-form">
        <h2>Contactanos</h2>
        <form action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 PelisPrime</p>
    </footer>
</body>
</html>


