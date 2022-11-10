<?php

require_once 'vendor/autoload.php';
use
    Cryptonite\Cryptonite;

// sample string to be encrypted
$string = "sample string";

// instantiate an instance of Cryptonite to be used
// for encryption.
$encryptor = new Cryptonite();

// if you do not have any key you can use the random
// one generated by the class. But any string might do
// $publicKey = 'any string';
$publicKey = $encryptor->publicKey;

// encrypt the string with the publicKey
$encrypted = $encryptor->encrypt($string, $publicKey);

// to decrypt we instantiate a new instance of the class
// to illustrate that this will work
$decrypted = (new Cryptonite())->decrypt($encrypted, $publicKey);

// compare the original string with the decrypted
$match = ($string === $decrypted) ? ' identical to ' : ' not identical to ';

echo $string . ' is ' . $match . $decrypted . '<hr>';