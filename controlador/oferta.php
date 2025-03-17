<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../modelos/oferta.php");

$control = $_GET['control'];
$oferta = new Oferta($conexion);

switch ($control) {
    case 'consulta':
        $vec = $oferta->consulta();
        echo json_encode($vec);
        break;

    case 'insertarPostulacion':
        $data = json_decode(file_get_contents("php://input"), true);
        $resultado = $oferta->insertarPostulacion($data);
        echo json_encode($resultado);
        break;

    default:
        echo json_encode(["resultado" => "ERROR", "mensaje" => "Acción no implementada"]);
        break;
}
?>
