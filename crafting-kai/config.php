<?php
// config
// 1. Mostrar errores 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Iniciar sesión
session_start();

// 3. Incluir la conexión a la base de datos
require_once __DIR__ . '/db.php'; 

// 4. Autoloading 
spl_autoload_register(function ($nombre_clase) {
    $carpeta_clases = __DIR__ . '/clases/';
    $ruta = $carpeta_clases . $nombre_clase . '.php';

    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        // Esto avisará si se intenta usar una clase que no existe
        die("Error: No se pudo cargar la clase '$nombre_clase'. Archivo no encontrado en $ruta");
    }
});

?>