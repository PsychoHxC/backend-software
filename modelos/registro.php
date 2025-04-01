<?php


class Registro{
    
//atributo
    public $conexion;

    //metodo constructor
    public function __construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos

    public function registrarUsuario($nombre_usuario, $email, $clave, $telefono) {
        // Cifrar la clave antes de guardarla
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO usuario (nombre_usuario, email, clave, telefono) 
                VALUES (?, ?, ?, ?)";
    
        $stmt = $this->conexion->prepare($sql);
    
        if ($stmt === false) {
            return array('success' => false, 'message' => 'Error en la preparación de la consulta.');
        }
    
        $stmt->bind_param("sssi", $nombre_usuario, $email, $clave_hash, $telefono);
    
        if ($stmt->execute()) {
            return array('success' => true, 'message' => 'Usuario registrado correctamente.');
        } else {
            return array('success' => false, 'message' => 'Error al registrar el usuario.');
        }
    }
    
    
}
?>