<?php
require_once('/app/vendor/autoload.php');

$v = '0.0.2';

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;

function genAddress(){
    $network = Bitcoin::getNetwork();
    $privateKey = PrivateKeyFactory::create(true);
    $publicKey = $privateKey->getPublicKey();

    $private_wif = $privateKey->toWif($network);
    $private_hex = $privateKey->getHex();
    $private_dec = gmp_strval($privateKey->getSecret(), 10);

    $public_wif = $publicKey->getHex();
    $public_hex = $publicKey->getPubKeyHash()->getHex();
    $public_dec = $publicKey->getAddress()->getAddress();

    $balance = getBalance($public_dec);
    if($balance['success']){
        $balance = $balance['balance'];

        $re = array(
            'success' => true,
            'compressed' => $privateKey->isCompressed(),
            'private' => array(
                'wif' => $private_wif,
                'hex' => $private_hex,
                'dec' => $private_dec
            ),
            'public' => array(
                'wif' => $public_wif,
                'hex' => $public_hex,
                'dec' => $public_dec
            ),
            'address' => $public_dec,
            'balance' => $balance
        );
    }else{
        $re = array(
            'success' => false
        );
    }

    if($re['success']){
        saveAddress($re);
    }

    return $re;
}

function getBalance($address){
    $call = file_get_contents('https://blockchain.info/address/'.$address.'?format=json&limit=1');
    $array = json_decode($call, true);

    if($array['address'] == $address){
        $re = array(
            'success' => true,
            'balance' => $array['final_balance']
        );
    }else{
        $re = array(
            'success' => false
        );
    }

    return $re;
}

function saveAddress($array){
    $json = json_encode($array, JSON_PRETTY_PRINT);
}