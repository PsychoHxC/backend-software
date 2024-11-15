<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/datos-candidatos.php");

$control = $_GET['control'];

$datosCan = new DatosCandidatos($conexion);

switch ($control) {
    case 'consulta':
        $vec = $datosCan->consulta();
    break;
    case 'insertar':
        $json = file_get_contents('php:/input');
        //$json = '[{4578957},{456},{54645},{5464},{13213}]';
        $params = json_decode($json);
        print_r($params);
        $vec = $datosCan->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $datosCan->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id =$_GET['id'];
        $vec = $datosCan->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $datosCan->filtro($dato);
    break;

}

$datosCandidatos = json_encode($vec);
echo $datosCandidatos;
header('Content-Type: application/json');




?>