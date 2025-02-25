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
}
