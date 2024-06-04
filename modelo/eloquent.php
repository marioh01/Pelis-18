<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class Conexion {
    public function conectar() {
        define('HOST', 'localhost');
        define('NAME', 'pelis+18'); 
        define('USER', 'root'); 
        define('PASS', ''); 

        try {
            $capsule = new Capsule;
            $capsule->addConnection([
                'driver'        => 'mysql',
                'host'          => HOST,
                'database'      => NAME,
                'username'      => USER,
                'password'      => PASS,
                'charset'       => 'utf8',
                'collation'     => 'utf8_unicode_ci',
                'prefix'        => '',
            ]);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;

        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

class Pelicula extends Model
{
    protected $table = 'peliculas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
         'nombre',
         'descripcion',
         'poster',
         'trailerkey'];
}

class Director extends Model
{
    protected $table = 'Directores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido'];
}

class Actor extends Model
{
    protected $table = 'Actores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido'];
}

class Genero extends Model
{
    protected $table = 'Generos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre'];
}

class PeliculaDirector extends Model
{
    protected $table = 'Pelicula_Director';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'director_id'];
}

class PeliculaActor extends Model
{
    protected $table = 'Pelicula_Actor';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'actor_id'];
}

class PeliculaGenero extends Model
{
    protected $table = 'Pelicula_Genero';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'genero_id'];
}

class Contacto extends Model
{
    protected $table = 'contacto';
    protected $primaryKey = 'mensajeid';
    public $timestamps = false;
    protected $fillable = [
         'nombre',
         'correo',
         'celular',
         'mensaje',
         'fechaenvio',
    ];
}
?>