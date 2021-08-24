<?php 
// TODO: Demonstrate Task 2
class Encryption
{
    private $db;
    // Note that the key is stored in /includes/configure.php

    // TODO: Constructor - Note that this constructor runs in application top.
    public function __construct($db, $unencryptedText, $key)
    {
        $this->db = $db;
        $this->unencryptedText = $unencryptedText;
        $this->key = $key;
    }

    // source: https://www.php.net/manual/en/function.openssl-encrypt.php
    function encrypt()
    {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($this->unencryptedText, $cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);
        $cipherText = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $this->cipherText = $cipherText;
    }

    
    // Source: https://www.php.net/manual/en/function.openssl-encrypt.php
    function decrypt($cipherText)
    {
        //decrypt later....
        $c = base64_decode($cipherText);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);

        if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
        {
            return $this->decryptedText = $original_plaintext;
        }
    }

        // Adds a user and their details to encrypted table 
        public function addTextEncrypted()
        {
            $sql = "INSERT INTO encryptedtext (encryptedText) VALUES ('" . mysqli_real_escape_string($this->db, $this->cipherText) . "')";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        // Reads all text from the database in the encryptedText table
        function readText()
        {
            global $db;
            $sql = "SELECT encryptedText FROM encryptedtext";
            $result = mysqli_query($db, $sql);
            return $result;
        }
}