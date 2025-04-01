<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/registro.php");


$regsitro = new Registro($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data['nombre_usuario']) && 
        isset($data['email']) && 
        isset($data['clave']) && 
        isset($data['telefono'])
    ) {
        $nombre_usuario = $data['nombre_usuario'];
        $email = $data['email'];
        $clave = $data['clave'];
        $telefono = $data['telefono'];

        $respuesta = $regsitro->registrarUsuario($nombre_usuario, $email, $clave, $telefono);

        echo json_encode($respuesta);
    } else {
        echo json_encode(array('success' => false, 'message' => 'Faltan datos.'));
    }
}


?>