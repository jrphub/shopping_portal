<?php

class Encryption {

    private static $key = "rtyEPnajus";

    public static function encrypt($text) {
        $encrypted = self::endecrypt(self::$key, $text);
        return $encrypted;
    }

    public static function decrypt($password) {
        //$decrypted= trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::$key, base64_decode($password), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
        $decrypted = self::endecrypt(self::$key, $password, 'de');
        return $decrypted;
    }

    private static function endecrypt($pwd, $data, $case='') {
        if ($case == 'de') {
            $data = urldecode($data);
        }

        $key[] = "";
        $box[] = "";
        $temp_swap = "";
        $pwd_length = 0;

        $pwd_length = strlen($pwd);

        for ($i = 0; $i <= 255; $i++) {
            $key[$i] = ord(substr($pwd, ($i % $pwd_length), 1));
            $box[$i] = $i;
        }

        $x = 0;

        for ($i = 0; $i <= 255; $i++) {
            $x = ($x + $box[$i] + $key[$i]) % 256;
            $temp_swap = $box[$i];

            $box[$i] = $box[$x];
            $box[$x] = $temp_swap;
        }

        $temp = "";
        $k = "";

        $cipherby = "";
        $cipher = "";

        $a = 0;
        $j = 0;

        for ($i = 0; $i < strlen($data); $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;

            $temp = $box[$a];
            $box[$a] = $box[$j];

            $box[$j] = $temp;

            $k = $box[(($box[$a] + $box[$j]) % 256)];
            $cipherby = ord(substr($data, $i, 1)) ^ $k;

            $cipher .= chr($cipherby);
        }

        if ($case == 'de') {
            $cipher = urldecode(urlencode($cipher));
        } else {
            $cipher = urlencode($cipher);
        }

        return $cipher;
    }

}

//$encryptedmessage = Encryption::encrypt("You're my only hope!");
  //echo Encryption::decrypt($encryptedmessage);
