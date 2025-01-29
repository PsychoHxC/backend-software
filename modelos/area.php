<?php 

class Area{
    
    //atributo
        public $conexion;
    
        //metodo constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
    
        //metodos
        
        public function consulta() {
            $con = "SELECT 
                        area.id, 
                        nombre_area.nombre_area AS nombre_area, 
                        area.jefe_area, 
                        area.solicitud_personal,
                        area.id_aprobacion 
                    FROM area
                    JOIN nombre_area ON area.id_area = nombre_area.id_area
                    ORDER BY area.id";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
        
            while ($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
        
            return $vec;
        }
        
    
        public function eliminar($id) {
            if ($id > 0) { // Valida que el ID sea mayor a 0
                $del = "DELETE FROM area WHERE id = $id";
                mysqli_query($this->conexion, $del);
        
                $vec = [];
                if (mysqli_affected_rows($this->conexion) > 0) {
                    $vec['resultado'] = "OK";
                    $vec['mensaje'] = "El registro ha sido eliminado correctamente.";
                } else {
                    $vec['resultado'] = "ERROR";
                    $vec['mensaje'] = "No se encontró un registro con el ID proporcionado.";
                }
                return $vec;
            } else {
                return [
                    'resultado' => 'ERROR',
                    'mensaje' => 'ID inválido.'
                ];
            }
        }

        public function insertar($params) {
            $ins = "INSERT INTO area (id_area, jefe_area, solicitud_personal, detalle_solicitud) VALUES (
                '{$params->id_area}', 
                '{$params->jefe_area}', 
                '{$params->solicitud_personal}',
                '{$params->detalle_solicitud}'
            )";
            mysqli_query($this->conexion, $ins);
        
            $vec = [];
            $vec['resultado'] = "OK";
            $vec['mensaje'] = "La solicitud ha sido guardada";
            return $vec;
        }
        

        public function editar($id, $params) {
            // Escapar los valores para evitar inyección SQL
            $id_area = mysqli_real_escape_string($this->conexion, $params->id_area);
            $jefe_area = mysqli_real_escape_string($this->conexion, $params->jefe_area);
            $solicitud_personal = mysqli_real_escape_string($this->conexion, $params->solicitud_personal);
            $detalle_solicitud = mysqli_real_escape_string($this->conexion, $params->detalle_solicitud);
        
            // Construir la consulta SQL para actualizar todos los campos
            $editar = "UPDATE area 
                       SET id_area = '$id_area', 
                           jefe_area = '$jefe_area', 
                           solicitud_personal = '$solicitud_personal', 
                           detalle_solicitud = '$detalle_solicitud' 
                       WHERE id = $id";
            
            // Ejecutar la consulta
            mysqli_query($this->conexion, $editar);
        
            // Verificar si hubo cambios
            $vec = [];
            if (mysqli_affected_rows($this->conexion) > 0) {
                $vec['resultado'] = "OK";
                $vec['mensaje'] = "La solicitud ha sido editada";
            } else {
                $vec['resultado'] = "ERROR";
                $vec['mensaje'] = "No se encontró el registro o no hubo cambios.";
            }
            return $vec;
        }
        public function filtro($valor){
            $filtro = "SELECT * FROM area WHERE nombre_area LIKE ' %$valor% '";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[]= $row;
            }
    
            return $vec;
        }
        public function aprobarSolicitud($id) {
            // Inserta un nuevo registro en la tabla aprobaciones_area
            $insertAprobacion = "INSERT INTO aprobaciones_area (id) VALUES (NULL)";
            mysqli_query($this->conexion, $insertAprobacion);
        
            // Obtén el último ID generado
            $idAprobacion = mysqli_insert_id($this->conexion);
        
            // Actualiza el registro en la tabla area
            $aprobar = "UPDATE area SET id_aprobacion = '$idAprobacion' WHERE id = $id";
            mysqli_query($this->conexion, $aprobar);
        
            $vec = [];
            if (mysqli_affected_rows($this->conexion) > 0) {
                $vec['resultado'] = "OK";
                $vec['mensaje'] = "La solicitud ha sido aprobada correctamente.";
            } else {
                $vec['resultado'] = "ERROR";
                $vec['mensaje'] = "No se pudo aprobar la solicitud.";
            }
            return $vec;
        }
        
        
        
        
    }
?>