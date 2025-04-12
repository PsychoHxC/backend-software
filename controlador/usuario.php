<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/usuario.php");

$control = $_GET['control'];

$usuario = new Usuario($conexion);

switch ($control) {
    case 'consulta':
        $vec = $usuario->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $usuario->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id']; // <-- CORRECTO
        $vec = $usuario->eliminar($id);
        echo json_encode($vec);
        break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $usuario->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $usuario->filtro($dato);
    break;

}

$datosUsuario = json_encode($vec);
echo $datosUsuario;
header('Content-Type: application/json');




?>