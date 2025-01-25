<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/nombre-area.php");

$control = $_GET['control'];

$nombreArea = new NombreArea($conexion);

switch ($control) {
    case 'consulta':
        $vec = $nombreArea->consulta();
    break;
   

}



$datosNombreArea = json_encode($vec);
echo $datosNombreArea;
header('Content-Type: application/json');




?>