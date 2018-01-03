<?php

namespace App\Lib;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class ClienteServicio
{
    public static $HOST;
    public static $DBNAME;
    public static $USUARIO;
    public static $CONTRASENIA;
    	
    public static function ConsultarDatosConexion($nit)
    {
        $respuesta = false;
        $sql = "SELECT T0.id_cia_ins, T0.dir_serlay_ins, T0.dir_hana_ins, T0.tx_puerto_ins,T0.tx_user_ins, T0.tx_con_ins, T0.tx_bd_ins
                FROM app_conf_insitu T0
                INNER JOIN app_compania T1 ON (T0.id_cia_ins = T1.id_cia)
                WHERE T1.tx_nit_cia = ?";

        $connexion = BasedeDatos::Conectar();
        $stm = $connexion->prepare($sql);
        $stm->execute(array($nit));
        $DatosSL = $stm->fetch();

        if($DatosSL){
            if($DatosSL->tx_puerto_ins){
                self::$HOST = $DatosSL->dir_hana_ins .":". $DatosSL->tx_puerto_ins ."/". $DatosSL->dir_serlay_ins ."/" ;
            }
            else{
                self::$HOST = $DatosSL->dir_hana_ins ."/". $DatosSL->dir_serlay_ins . "/" ;
            }
            self::$DBNAME = $DatosSL->tx_bd_ins;
            self::$USUARIO = $DatosSL->tx_user_ins;
            self::$CONTRASENIA = Helpers::Descifrar($DatosSL->tx_con_ins);
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function getSL($Entidad, $cantidadXPagina = 20)
    {
        $respuesta;
        try {

            $client = new Client([
                'base_uri' => self::$HOST,
                'cookies' => true,
                'timeout'  => 2.0,
            ]);

            $responseLogin = $client->post(
                'Login', 
                [
                    'json' => ['CompanyDB'=> self::$DBNAME, 'Password' => self::$CONTRASENIA, 'UserName' => self::$USUARIO]
                ]
            );

            if($responseLogin->getStatusCode() == 200) {
                $response = $client->get($Entidad, [
                    'headers' => [
                        'prefer' => 'odata.maxpagesize=' . $cantidadXPagina
                    ]
                ]);
                $respuesta = json_decode($response->getBody()->getContents());
            }
            else {
                $respuesta = (object) array(
                    "ESTADO" => false,
                    "MENSAJE" =>"Error al realizar Login"
                );
            }            

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $respuesta = $e->getResponse()->getBody()->getContents();
            }
            else {
                $respuesta = (object) array(
                    "ESTADO" => false,
                    "MENSAJE" =>"No se puede acceder al Host"
                );
            }
        }
        return $respuesta;
    }

    public static function postSL($Entidad, $data)
    {
        $respuesta;
        try {

            $client = new Client([
                'base_uri' => self::$HOST,
                'cookies' => true,
                'timeout'  => 2.0,
            ]);

            $responseLogin = $client->post(
                'Login', 
                [
                    'json' => ['CompanyDB'=> self::$DBNAME, 'Password' => self::$CONTRASENIA, 'UserName' => self::$USUARIO]
                ]
            );

            if($responseLogin->getStatusCode() == 200) {
                $response = $client->post($Entidad, [
                    'json' => $data,
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ]
                ]);
                $respuesta =json_decode( $response->getBody()->getContents());
            }
            else {
                $respuesta = json_encode(array(
                    "ESTADO" => false,
                    "MENSAJE" =>"Error al realizar Login"
                ));
            }            

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $respuesta = $e->getResponse()->getBody()->getContents();
            }
            else {
                $respuesta = json_encode(array(
                    "ESTADO" => false,
                    "MENSAJE" =>"No se puede acceder al Host"
                ));
            }
        }
        return $respuesta;
    }

    public static function post($Entidad, $data = array())
    {
        $respuesta;
        try {

            $client = new Client([
                'base_uri' => "http://192.168.1.36:5001/peticiones/",
                'timeout'  => 3.0,
            ]);

            $response = $client->post(
                $Entidad, 
                [
                    'json' => $data,
                    'headers' => ['Content-Type' => 'application/json']
                ]
            );

            if($response->getStatusCode() == 200) {
                $respuesta = json_decode($response->getBody()->getContents());
            }
            else {
                $respuesta = (object) array(
                    "ESTADO" => false,
                    "MENSAJE" =>"Error al realizar" . $Entidad
                );
            }            

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $respuesta = $e->getResponse()->getBody()->getContents();
            }
            else {
                $respuesta = (object) array(
                    "ESTADO" => false,
                    "MENSAJE" =>"No se puede acceder al Host"
                );
            }
        }
        return $respuesta;
    }
}
?>