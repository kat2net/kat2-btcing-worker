<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$info = array(
    'v' => $v,
    'name' => getenv('name'),
    'list' => array(
        'active' => false
    )
);

echo json_encode($info, JSON_PRETTY_PRINT);