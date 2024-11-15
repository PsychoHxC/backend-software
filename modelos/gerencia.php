<?php


class Gerencia{
    
//atributo
    public $conexion;

    //metodo constructor
    public function __construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    
    public function consulta(){
    $con = "SELECT * FROM gerencia ORDER BY fecha_solicitud";
    $res = mysqli_query($this->conexion, $con);
    $vec = [];         
    
    while($row = mysqli_fetch_array($res)){
        $vec[]= $row;
    }
    return $vec;
    }

    public function eliminar($id){
        $del ="DELETE FROM gerencia where id_solicitud = $id";
        mysqli_query($this-> conexion, $del);
        $vec = [];
        $vec['resultado']= "OK";
        $vec['mensaje']= "La solicitud ha sido eliminada";
        return $vec;
    }

    public function insertar ($params) {
        $ins ="INSERT INTO gerencia(solicitud_personal) VALUES('$params -> solicitud_personal')";
        mysqli_query($this->conexion, $ins);
        $vec = [];
        $vec['resultado']= "OK";
        $vec['mensaje']= "La solicitud ha sido guardada";
        return $vec;
    }

    public function editar($id, $params){
        $editar = "UPDATE gerencia SET solicitud_personal = '$params -> solicitud_personal' WHERE id_solicitud = $id ";
        mysqli_query($this->conexion,$editar);
        $vec = [];
        $vec['resultado']= "OK";
        $vec['mensaje']= "La solicitud ha sido editada";
        return $vec;
    }

    public function filtro($valor){
        $filtro= "SELECT * FROM gerencia WHERE fecha_solicitud LIKE ' %$valor% '";
        $res= mysqli_query($this->conexion, $filtro);
        $vec = [];
        while($row = mysqli_fetch_array($res)){
            $vec[]= $row;
        }

        return $vec;
    }

    
    
}
?>