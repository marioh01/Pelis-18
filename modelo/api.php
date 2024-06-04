<?php

require_once 'eloquent.php';

function obtenerClaveTrailer($movieId) {
    $apiKey = 'edd1cd2aa5e03bfc0762f03b146d31de';
    $trailerUrl = 'https://api.themoviedb.org/3/movie/' . $movieId . '/videos?api_key=' . $apiKey;

    try {
        $trailerResponse = file_get_contents($trailerUrl);
        $trailerData = json_decode($trailerResponse, true);

        if (isset($trailerData['results']) && count($trailerData['results']) > 0) {
            return $trailerData['results'][0]['key'];
        } else {
            return ''; 
        }
    } catch (Exception $e) {
        echo "Error al obtener la clave del trailer: " . $e->getMessage();
        return '';
    }
}


function llenarTablaPeliculas() {
    $apiKey = 'edd1cd2aa5e03bfc0762f03b146d31de';
    $url = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $apiKey;

    try {
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['results'])) {
            $movies = $data['results'];

            $conexion = new Conexion();
            $capsule = $conexion->conectar();

            foreach ($movies as $movie) {
                $trailerKey = obtenerClaveTrailer($movie['id']);
                Pelicula::create([
                    'nombre' => $movie['title'],
                    'descripcion' => $movie['overview'],
                    'poster' => $movie['poster_path'],
                    'trailerkey' => $trailerKey
                ]);
            }

            echo 'Películas insertadas correctamente en la tabla.';
        } else {
            echo 'No se encontraron películas en la respuesta de la API.';
        }
    } catch (Exception $e) {
        echo "Error al obtener películas desde la API: " . $e->getMessage();
    }
}

// Llamar a la función para llenar la tabla 'peliculas'
llenarTablaPeliculas();


?>