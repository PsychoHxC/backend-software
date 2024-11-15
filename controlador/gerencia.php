<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/gerencia.php");

$control = $_GET['control'];

$gerencia = new Gerencia($conexion);

switch ($control) {
    case 'consulta':
        $vec = $gerencia->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $gerencia->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $gerencia->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $gerencia->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $gerencia->filtro($dato);
    break;

}

$datosGerencia = json_encode($vec);
echo $datosGerencia;
header('Content-Type: application/json');




?>