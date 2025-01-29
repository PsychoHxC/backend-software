<?php


class Gerencia
{

    //atributo
    public $conexion;

    //metodo constructor
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //metodos

    public function consulta()
    {
        $con = "SELECT * FROM gerencia ORDER BY fecha_solicitud";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }
        return $vec;
    }

    public function eliminar($id)
    {
        $del = "DELETE FROM gerencia where id_solicitud = $id";
        mysqli_query($this->conexion, $del);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La solicitud ha sido eliminada";
        return $vec;
    }

    // public function insertar($params)
    // {
    //     $prioridad = isset($params['prioridad']) ? $params['prioridad'] : 'Media';
    //     $fecha_fin_oferta = isset($params['fecha_fin_oferta']) ? $params['fecha_fin_oferta'] : null;
    //     $id_solicitud = isset($params['id_solicitud']) ? $params['id_solicitud'] : null;
    
    //     // Insertar la solicitud con los nuevos campos
    //     $ins = "INSERT INTO gerencia (solicitud_personal, prioridad, fecha_fin_oferta, id_solicitud)
    //             VALUES ('{$params['solicitud_personal']}', '$prioridad', '$fecha_fin_oferta', '$id_solicitud')";
    
    //     mysqli_query($this->conexion, $ins);
        
    //     // Obtener el ID insertado
    //     $idInsertado = mysqli_insert_id($this->conexion);
    
    //     // Actualizar `id_gerencia` y `numero_solicitud` si son NULL
    //     $update = "UPDATE gerencia 
    //                SET id_gerencia = IFNULL(id_gerencia, '$idInsertado'),
    //                    numero_solicitud = IFNULL(numero_solicitud, 'NS-$idInsertado')
    //                WHERE id_solicitud = '$idInsertado'";
        
    //     mysqli_query($this->conexion, $update);
    
    //     return [
    //         "resultado" => "OK",
    //         "mensaje" => "La solicitud ha sido guardada",
    //         "id_solicitud" => $idInsertado
    //     ];
    // }
    

    public function insertar($params)
{
    $ins = "INSERT INTO gerencia (solicitud_personal,
            prioridad, 
            fecha_solicitud, 
            fecha_fin_oferta, 
            id_solicitud,
            detalle_oferta) 
            VALUES ('$params->solicitud_personal', 
            '$params->prioridad', 
            '$params->fecha_solicitud', 
            '$params->fechaFinOferta', 
            '$params->id_solicitud',
            '$params->detalle')";

    mysqli_query($this->conexion, $ins);
    $vec = [];
    $vec['resultado'] = "OK";
    $vec['mensaje'] = "La solicitud ha sido guardada";
    return $vec;
}
    
    public function editar($id, $params)
    {
        $editar = "UPDATE gerencia SET solicitud_personal = '$params -> solicitud_personal' WHERE id_solicitud = $id ";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La solicitud ha sido editada";
        return $vec;
    }

    public function filtro($valor)
    {
        $filtro = "SELECT * FROM gerencia WHERE fecha_solicitud LIKE ' %$valor% '";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];
        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultaAprobadas()
    {
        $query = "
            SELECT 
                area.id_area,
                area.jefe_area,
                area.solicitud_personal,
                area.detalle_solicitud,
                aprobaciones_area.id AS id_aprobacion,
                aprobaciones_area.fecha_aprobacion,
                nombre_area.nombre_area
            FROM 
                area
            INNER JOIN 
                aprobaciones_area 
            ON 
                area.id_aprobacion = aprobaciones_area.id
            
            INNER JOIN 
                nombre_area 
            ON 
                area.id_area = nombre_area.id_area  
            WHERE 
                area.id_aprobacion IS NOT NULL
            ORDER BY 
                aprobaciones_area.fecha_aprobacion DESC";

        $res = mysqli_query($this->conexion, $query);
        $resultados = [];

        while ($row = mysqli_fetch_assoc($res)) {
            $resultados[] = $row;
        }

        return $resultados;
    }



}
?>