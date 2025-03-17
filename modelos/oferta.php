<?php

class Oferta
{
    public $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Método para obtener las ofertas con estado = 1
    public function consulta()
    {
        $query = "SELECT id_solicitud, solicitud_personal AS nombre_oferta, fecha_fin_oferta, detalle_oferta 
                  FROM gerencia 
                  WHERE estado = 1";

        $result = mysqli_query($this->conexion, $query);
        $ofertas = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $ofertas[] = $row;
        }

        return $ofertas;
    }

    // Método para insertar una postulación
    public function insertarPostulacion($data)
    {
        $id_solicitud = $data['id_solicitud'];
        $tipo_identificacion = $data['tipo_identificacion'];
        $numero_identificacion = $data['numero_identificacion'];
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $celular = $data['celular'];
        $direccion = $data['direccion'];
        $email = $data['email'];
        $archivoBase64 = $data['archivo']; // Recibe el PDF en Base64
    
        // Decodificar el archivo Base64 y guardar en una carpeta
        $archivoDecodificado = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $archivoBase64));
    
        // Ruta donde se guardará el archivo
        $rutaArchivo = "../uploads/cv_" . time() . ".pdf";
        
        // Guardar el archivo en el servidor
        if (!file_put_contents($rutaArchivo, $archivoDecodificado)) {
            return ["resultado" => "ERROR", "mensaje" => "Error al guardar el archivo"];
        }
    
        // Insertar en la base de datos solo la ruta del archivo
        $query = "INSERT INTO postulados (id_solicitud, tipo_identificacion, numero_identificacion, nombre, apellidos, celular, direccion, email, archivo_pdf) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "issssssss", $id_solicitud, $tipo_identificacion, $numero_identificacion, $nombre, $apellidos, $celular, $direccion, $email, $rutaArchivo);
    
        if (mysqli_stmt_execute($stmt)) {
            return ["resultado" => "OK", "mensaje" => "Postulación guardada correctamente"];
        } else {
            return ["resultado" => "ERROR", "mensaje" => "Error al guardar la postulación"];
        }
    }
}
?>
