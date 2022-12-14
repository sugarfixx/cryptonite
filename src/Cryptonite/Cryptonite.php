<?php

namespace Cryptonite;

class Cryptonite
{

    /**
     * sets what algorithm to use via constructor
     * if not set AES-256-CBC is used as default
     * see https://www.php.net/manual/en/function.openssl-get-cipher-methods.php
     * @var string
     */
    private $cipherAlgo;

    /**
     * sets secretKey from constructor
     * if not set kryptonite is used as default
     * @var string
     */
    private $secretKey;

    /**
     * is set from the constructor
     * @var string
     */
    public $publicKey;

    /**
     * @param string $cipherAlgo
     * @param string $secretKey
     */
    public function __construct(string $cipherAlgo = "", string $secretKey = "")
    {
        $this->setCipherAlgo($cipherAlgo);
        $this->setSecretKey($secretKey);
        $this->generatePublicKey();
    }

    /**
     * @param $string
     * @param $publicKey
     * @return string // encrypted value
     */
    public function encrypt($string, $publicKey)
    {
        $key = hash('sha256', $publicKey);
        $ivalue = substr(hash('sha256', $this->secretKey), 0, 16); // sha256 is hash_hmac_algo
        $result = openssl_encrypt($string, $this->cipherAlgo, $key, 0, $ivalue);
        return base64_encode($result);  // output is an

    }

    /**
     * @param $encrypted
     * @param $publicKey
     * @return false|string
     */
    public function decrypt($encrypted, $publicKey)
    {
        $key    = hash('sha256', $publicKey);
        $ivalue = substr(hash('sha256', $this->secretKey), 0, 16); // sha256 is hash_hmac_algo
        return openssl_decrypt(base64_decode($encrypted), $this->cipherAlgo, $key, 0, $ivalue);
    }

    /**
     * @param $length
     * @return void
     */
    public function generatePublicKey($length = 10) : void
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->setPublicKey($randomString);
    }

    /**
     * @param string $cipherAlgo
     */
    public function setCipherAlgo(string $cipherAlgo): void
    {
        $this->cipherAlgo = !empty($cipherAlgo) ? $cipherAlgo : "AES-256-CBC";
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey(string $secretKey): void
    {
        $this->secretKey = !empty($secretKey) ? $secretKey : "kryptonite";
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }
}
