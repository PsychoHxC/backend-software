<?php
// Cabeceras CORS
header("Access-Control-Allow-Origin: *"); // Permitir cualquier origen. Puedes cambiar * por un dominio específico.
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
header("Access-Control-Max-Age: 86400"); // Cache de preflight durante 1 día

// Configuración de la conexión
$servidor = "localhost";
$usuario = "root";
$clave = "root";
$db = "proyecto sena";

$conexion = mysqli_connect($servidor, $usuario, $clave) or die ('No se encontró el servidor');
mysqli_select_db($conexion, $db) or die ('No se encontró la base de datos');
mysqli_set_charset($conexion, "utf8");

//echo "Se conectó correctamente";
?>


