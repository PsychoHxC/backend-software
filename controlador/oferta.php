<?php

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// require_once("../conexion.php");
// require_once("../modelos/oferta.php");

// $control = $_GET['control'];

// $oferta = new Oferta($conexion);

// switch ($control) {
//     case 'consulta':
//         $vec = $oferta->consulta();
//         break;

//     case 'insertar':
//         break;


//     case 'eliminar':
//         break;

//     case 'editar':
//         break;

//     case 'filtro':
//         $dato = $_GET['dato'];
//         $vec = $gerencia->filtro($dato);
//         break;        

// }

// $datosOferta = json_encode($vec);
// echo $datosOferta;
// header('Content-Type: application/json');


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../conexion.php");
require_once("../modelos/oferta.php");

$control = $_GET['control'];

$oferta = new Oferta($conexion);

switch ($control) {
    case 'consulta':
        $vec = $oferta->consulta();
        echo json_encode($vec);
        break;

    case 'insertar':
    case 'eliminar':
    case 'editar':
    case 'filtro':
        echo json_encode(["resultado" => "ERROR", "mensaje" => "Acción no implementada"]);
        break;
}

header('Content-Type: application/json');


?>