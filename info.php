<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if(file_exists('/app/data')){
    $info = array(
        'v' => $v,
        'name' => getenv('name'),
        'list' => array(
            'active' => true,
            'done' => file_get_contents('/app/data')
        )
    );
}else{
    $info = array(
        'v' => $v,
        'name' => getenv('name'),
        'list' => array(
            'active' => false,
            'done' => 0
        )
    );
}

echo json_encode($info, JSON_PRETTY_PRINT);