<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/area.php");

$control = $_GET['control'];
$vec = [];

$area = new Area($conexion);

switch ($control) {
    case 'consulta':
        $vec = $area->consulta();
    break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
    
        if (isset($params->nombre_area, $params->jefe_area, $params->solicitud_personal)) {
            $vec = $area->insertar($params);
            header('Content-Type: application/json'); // Asegura que se devuelva JSON
            echo json_encode($vec);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'resultado' => 'ERROR',
                'mensaje' => 'Datos incompletos'
            ]);
        }
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
    
            if (isset($_GET['id']) && isset($params->solicitud_personal)) {
                $id = intval($_GET['id']);
                $vec = $area->editar($id, $params);
            } else {
                $vec['resultado'] = 'ERROR';
                $vec['mensaje'] = 'Datos incompletos o ID no válido';
            }
            break;
    
    
    
        case 'eliminar':
            // Asegúrate de que se obtiene correctamente el parámetro 'id' desde la URL
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']); // Convierte a entero para mayor seguridad
                $vec = $area->eliminar($id);
                header('Content-Type: application/json');
                echo json_encode($vec);
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'resultado' => 'ERROR',
                    'mensaje' => 'ID no proporcionado o inválido'
                ]);
            }
            break;

    case 'aprobar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id']; // Obtener el ID de la solicitud desde la URL
        $idAprobacion = $params->id_aprobacion; // Obtener el valor del ID de aprobación
        
        $vec = $area->aprobarSolicitud($id, $idAprobacion);
        header('Content-Type: application/json');
        echo json_encode($vec);
        break;
    

}



$datosArea = json_encode($vec);
echo $datosArea;
header('Content-Type: application/json');




?>