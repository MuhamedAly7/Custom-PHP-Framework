<?php

namespace Illuminates\Hashes;

class Hash
{    
    /**
     * encrypt
     *
     * @param  mixed $val
     * @return string
     */
    public static function encrypt(string $val) : string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($val, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        $ciphertext = base64_decode($iv.$hmac.$ciphertext_raw);
        return $ciphertext;
    }

    
    /**
     * decrypt
     *
     * @param  mixed $ciphertext
     * @return string
     */
    public static function decrypt(string $ciphertext) : string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');
        $convert = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($convert, 0, $ivlen);
        $hmac = substr($convert, $ivlen, 32);
        $ciphertext_raw = substr($convert, $ivlen+32);
        $original_text = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if(hash_equals($hmac, $calcmac))
        {
            return $original_text;
        }
        return '';
    }
    
    /**
     * make
     *
     * @param  mixed $password
     * @return string
     */
    public static function make(string $password) : string
    {
        return password_hash($password, config('hash.bcrypt_algo'));
    }

    
    /**
     * check
     *
     * @param  mixed $password
     * @param  mixed $hash
     * @return bool
     */
    public static function check(string $password, string $hash) : bool
    {
        return password_verify($password, $hash);
    }
}