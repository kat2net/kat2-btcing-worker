<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

$v = '0.0.0.2';

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;

function genAddr(){
    $network = Bitcoin::getNetwork();
    $privateKey = PrivateKeyFactory::create(true);
    $publicKey = $privateKey->getPublicKey();

    $re = array(
        'compressed' => $privateKey->isCompressed(),
        'private' => array(
            'wif' => $privateKey->toWif($network),
            'hex' => $privateKey->getHex(),
            'dec' => gmp_strval($privateKey->getSecret(), 10)
        ),
        'public' => array(
            'wif' => $publicKey->getHex(),
            'hex' => $publicKey->getPubKeyHash()->getHex(),
            'dec' => $publicKey->getAddress()->getAddress()
        )
    );

    return $re;
}