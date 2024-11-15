<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/contratacion.php");

$control = $_GET['control'];

$contratacion = new Contratacion($conexion);

switch ($control) {
    case 'consulta':
        $vec = $contratacion->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $contratacion->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $contratacion->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $contratacion->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $contratacion->filtro($dato);
    break;

}

$datoscontratacion = json_encode($vec);
echo $datoscontratacion;
header('Content-Type: application/json');




?>