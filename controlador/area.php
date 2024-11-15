<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/area.php");

$control = $_GET['control'];

$area = new Area($conexion);

switch ($control) {
    case 'consulta':
        $vec = $area->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $area->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $area->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $area->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $area->filtro($dato);
    break;

}

$datosArea = json_encode($vec);
echo $datosArea;
header('Content-Type: application/json');




?>