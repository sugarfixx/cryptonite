# Cryptonite

This package is for those who do not need the highest security. It is not intended to be used with information that is likely to be attacked. But if you need to hide data sent between services in a system this might do the trick.


## Usage

### Encrypt

````
// with default cipher algorith and secret
$cryptonite = new Cryptonite();
$publicKey = $cryptonite->publicKey;
$encrypted = $cryptonite->encrypt("value_to_encrypt", $publicKey)

// with custom cipher algorithm and secret
$cryptonite = new Cryptonite("My Cupher Algo", "My Secret");
$publicKey = $cryptonite->publicKey;
$encrypted = $cryptonite->encrypt("value_to_encrypt", $publicKey)
````

### Decrypt

````
// with default cipher algorith and secret
$decrypted = (new Cryptonite())->decrypt($encrypted, $publicKey);

// with custom cipher algorithm and secret
$decrypted = (new Cryptonite("My Cupher Algo", "My Secret"))->decrypt($encrypted, $publicKey);
````

## Installation


To require service into existing project, add this to composer.json
````
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:sugarfixx/cryptonite.git"
     }
  ]   
}
````
Run
```angular2html
composer require sugarfixx/cryptonite:dev-main
```
