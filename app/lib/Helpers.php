<?php

namespace App\Lib;

class Helpers
{
	private static $KEY = '123456789012345678901234';
	private static $IV = 'password';
    	
    public static function Descifrar($data) {
        return @mcrypt_decrypt(MCRYPT_3DES, self::$KEY, base64_decode($data), MCRYPT_MODE_CBC, SELF::$IV);
    }

    public static function Cifrar($data) {
        return @base64_encode(mcrypt_encrypt(MCRYPT_3DES, self::$KEY, $data, MCRYPT_MODE_CBC, SELF::$IV));
    }
}
?>