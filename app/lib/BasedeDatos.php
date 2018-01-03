<?php

namespace App\Lib;

use PDO;

class BasedeDatos
{
	const SERVIDOR = '163.172.114.139';
	const BDNAME = 'legalisapp_demoCss';
	const USUARIO = 'legalisapp_demoCss';
    const CLAVE = '21jejAlo';
    	
    public static function Conectar()
    {
        $Conexion = new PDO('mysql:dbname=' . self::BDNAME . ';host='.self::SERVIDOR, self::USUARIO, self::CLAVE);
        $Conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $Conexion;
    }
}
?>