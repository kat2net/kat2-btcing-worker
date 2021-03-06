<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if(file_exists('/app/data/done')){
    $info = array(
        'v' => $v,
        'name' => getenv('name'),
        'list' => array(
            'active' => true,
            'done' => (int)file_get_contents('/app/data/done'),
            'saved' => (int)file_get_contents('/app/data/saved')
        )
    );
}else{
    $info = array(
        'v' => $v,
        'name' => getenv('name'),
        'list' => array(
            'active' => false,
            'done' => 0,
            'saved' => 0
        )
    );
}

echo json_encode($info, JSON_PRETTY_PRINT);