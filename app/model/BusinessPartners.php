<?php

namespace App\Model;

use App\Lib\ClienteServicio;
use App\Lib\BasedeDatos;

class BusinessPartners 
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
            $respuesta = ClienteServicio::post('2/R', $data );
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
            $respuesta = ClienteServicio::post('2/S');
        }
        return $respuesta;
   }

   public function Post($Nit, $data)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "Estado" => false,
                "Mensaje" =>"No se encontraron datos de conexion"
            );
        } else {
            $respuesta = ClienteServicio::post('2/C', $data );
            if($respuesta->ESTADO == TRUE) {
                $date = date("Y-m-d H:i:s");
                $connexion = BasedeDatos::Conectar();
                $consulta = "INSERT INTO app_insitu_socio (Nit, Operacion, Fecha, CardCode, CardName) 
                            VALUES (:Nit, :Operacion, :Fecha, :CardCode, :CardName)";
                $stm = $connexion->prepare($consulta);
                $stm->execute(array(
                    "Nit" => $Nit,
                    "Operacion" => "CREAR",
                    "Fecha" => $date,
                    "CardCode" => $data["CardCode"],
                    "CardName" => $data["CardName"]
                ));                  
            }
        }
        return $respuesta;
   }

   public function Update($Nit, $data)
   {
        $respuesta;
        $con = ClienteServicio::ConsultarDatosConexion($Nit);
        if($con == false) {
            $respuesta = (object) array(
                "Estado" => false,
                "Mensaje" =>"No se encontraron datos de conexion"
            );
        } else {
            $respuesta = ClienteServicio::post('2/U', $data );
            if($respuesta->ESTADO == TRUE) {
                $date = date("Y-m-d H:i:s");
                $connexion = BasedeDatos::Conectar();
                $consulta = "INSERT INTO app_insitu_socio (Nit, Operacion, Fecha, CardCode, CardName) 
                            VALUES (:Nit, :Operacion, :Fecha, :CardCode, :CardName)";
                $stm = $connexion->prepare($consulta);
                $stm->execute(array(
                    "Nit" => $Nit,
                    "Operacion" => "ACTUALIZAR",
                    "Fecha" => $date,
                    "CardCode" => $data["CardCode"],
                    "CardName" => $data["CardName"]
                ));                  
            }
        }
        return $respuesta;
   }
}
?>
