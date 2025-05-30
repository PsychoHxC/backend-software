<?php 

class Usuario{
    
    //atributo
        public $conexion;
    
        //metodo constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
    
        //metodos
        
        public function consulta(){
        $con = "SELECT * FROM usuario ORDER BY rol_usuario";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];         
        
        while($row = mysqli_fetch_array($res)){
            $vec[]= $row;
        }
        return $vec;
        }
    
        public function eliminar($id){
            $del ="DELETE FROM usuario where id = $id";
            mysqli_query($this-> conexion, $del);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje']= "La categoria ha sido eliminada";
            return $vec;
        }

        
        public function insertar($params) {
            $nombre_usuario = mysqli_real_escape_string($this->conexion, $params->nombre_usuario);
            $email = mysqli_real_escape_string($this->conexion, $params->email);
            $clave = mysqli_real_escape_string($this->conexion, $params->clave);
            $telefono = mysqli_real_escape_string($this->conexion, $params->telefono);
            $rol_usuario = mysqli_real_escape_string($this->conexion, $params->rol_usuario);
        
            $ins = "INSERT INTO usuario (nombre_usuario, email, clave, telefono, rol_usuario)
                    VALUES ('$nombre_usuario', '$email', '$clave', '$telefono', '$rol_usuario')";
        
            mysqli_query($this->conexion, $ins);
        
            $vec = [];
            $vec['resultado'] = "OK";
            $vec['mensaje'] = "La solicitud ha sido guardada";
            return $vec;
        }
        
    // public function editar($id, $params){
    //     $editar = "UPDATE usuario SET solicitud_personal = '$params -> solicitud_personal' WHERE id = $id ";
    //     mysqli_query($this->conexion,$editar);
    //     $vec = [];
    //     $vec['resultado']= "OK";
    //     $vec['mensaje']= "La solicitud ha sido editada";
    //     return $vec;
    // }



    public function editar($id, $params): array {
        $campos = [];
    
        foreach ($params as $key => $value) {
            if ($key !== 'id') {
                $valor_escapado = mysqli_real_escape_string($this->conexion, $value);
                $campos[] = "$key = '$valor_escapado'";
            }
        }
    

        $set = implode(", ", $campos);
        $editar = "UPDATE usuario SET $set WHERE id = $id";
        mysqli_query($this->conexion, $editar);
    
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El usuario ha sido editado correctamente";
        return $vec;
    }
    

    public function filtro($valor){
        $filtro = "SELECT * FROM usuario WHERE nombre_usuario LIKE ' %$valor% '";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];
        while($row = mysqli_fetch_array($res)){
            $vec[]= $row;
        }

        return $vec;
    }
        
    }
?>