<?php

namespace App\Model;

use App\Lib\ClienteServicio;

class Items 
{

   public function GetArticulo($Nit, $Pagina = 0, $Cantidad = 20)
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
            $respuesta = ClienteServicio::post('4/R', $data );
        }
        return $respuesta;
   }

   public function CountArticulo($Nit)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "ESTADO" => false,
                "MENSAJE" =>"No se encontraron datos de conexion"
            );
        } else {
            $respuesta = ClienteServicio::post('4/S');
        }
        return $respuesta;
   }

   public function GetGruposArticulo($Nit, $Pagina = 0, $Cantidad = 20)
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
            $respuesta = ClienteServicio::post('52/R', $data );
        }
        return $respuesta;
   }

   public function CountGruposArticulo($Nit)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "ESTADO" => false,
                "MENSAJE" =>"No se encontraron datos de conexion"
            );
        } else {
            $respuesta = ClienteServicio::post('52/S');
        }
        return $respuesta;
   }
}
?>
