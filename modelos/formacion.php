<?php 

class Formacion{
    
    //atributo
        public $conexion;
    
        //metodo constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
    
        //metodos
        
        public function consulta(){
        $con = "SELECT * FROM formacion ORDER BY nombre_formacion";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];         
        
        while($row = mysqli_fetch_array($res)){
            $vec[]= $row;
        }
        return $vec;
        }
    
        public function eliminar($id){
            $del ="DELETE FROM formacion where id = $id";
            mysqli_query($this-> conexion, $del);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje']= "La categoria ha sido eliminada";
            return $vec;
        }
        
    }
?>