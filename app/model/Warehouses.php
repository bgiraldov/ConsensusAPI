<?php

namespace App\Model;

use App\Lib\ClienteServicio;

class Warehouses 
{

   public function Get($Nit, $Pagina = 0, $Cantidad = 20)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "Estado" => false,
                "Mensaje" =>"No se encontraron datos de conexion"
            );
        } else {
            $data = array(
                "Omitir" => $Pagina * $Cantidad,
                "Cantidad" => $Cantidad
            );
            $respuesta = ClienteServicio::post('64/R', $data );
        }
        return $respuesta;
   }

   public function Count($Nit)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "ESTADO" => false,
                "MENSAJE" =>"No se encontraron datos de conexion"
            );
        } else {
            $respuesta = ClienteServicio::post('64/S');
        }
        return $respuesta;
   }
}
?>
