<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../conexion.php");
require_once("../modelos/gerencia.php");

$control = $_GET['control'];

$gerencia = new Gerencia($conexion);

switch ($control) {
    case 'consulta':
        $vec = $gerencia->consulta();
        break;

    // case 'insertar':
    //     $json = file_get_contents('php://input');
    //     $params = json_decode($json, true); // Decodificar en array asociativo

    //     if (!$params) {
    //         echo json_encode(["resultado" => "ERROR", "mensaje" => "Datos inválidos"]);
    //         exit;
    //     }

    //     $vec = $gerencia->insertar($params);
    //     echo json_encode($vec);
    //     break;


    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $gerencia->insertar($params);
        break;


    case 'eliminar':
        $id = $_GET['$id'];
        $vec = $gerencia->eliminar($id);
        break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $gerencia->editar($id, $params);
        break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $gerencia->filtro($dato);
        break;

    case 'aprobadas':
        $vec = $gerencia->consultaAprobadas();
        break;

        case 'aprobarOferta':
            $id = $_GET['id'];
        
            if (!$id) {
                echo json_encode(["resultado" => "ERROR", "mensaje" => "ID de solicitud no proporcionado"]);
                exit;
            }
        
            $vec = $gerencia->aprobarOferta($id);
            echo json_encode($vec);
            break;
        

}

$datosGerencia = json_encode($vec);
echo $datosGerencia;
header('Content-Type: application/json');




?>