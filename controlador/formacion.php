<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/formacion.php");

$control = $_GET['control'];

$formacion = new Formacion($conexion);

switch ($control) {
    case 'consulta':
        $vec = $formacion->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $formacion->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $formacion->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $formacion->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $formacion->filtro($dato);
    break;

}

$datosFormacion = json_encode($vec);
echo $datosFormacion;
header('Content-Type: application/json');




?>