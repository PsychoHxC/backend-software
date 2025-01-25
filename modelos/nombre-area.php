<?php 

class NombreArea{
    
    //atributo
        public $conexion;
    
        //metodo constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
    

        public function consulta() {
            $con = "SELECT id_area, nombre_area FROM nombre_area ORDER BY id_area";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
        
            while ($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
        
            return $vec;
        }      
        
    
        public function eliminar($id){
            $del ="DELETE FROM nombre_area where id = $id";
            mysqli_query($this-> conexion, $del);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje']= "La categoria ha sido eliminada";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO nombre_area (id_area, nombre_area) VALUES (
                '{$params->id_area}',
                '{$params->nombre_area}')";
            mysqli_query($this->conexion, $ins);
        
            $vec = [];
            $vec['resultado'] = "OK";
            $vec['mensaje'] = "La solicitud ha sido guardada";
            return $vec;
        }
        

        public function editar($id, $params){
            $editar = "UPDATE area SET solicitud_personal = '$params -> solicitud_personal' WHERE id = $id ";
            mysqli_query($this->conexion,$editar);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje']= "La solicitud ha sido editada";
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
    }
?>