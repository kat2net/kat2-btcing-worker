<?php
header("Access-Control-Allow-Origin: *");
$dir = $_SERVER['DOCUMENT_ROOT'];

if(file_exists('/app/data/lock')){
    echo 'It\'s Locked.';
}else{
    file_put_contents('/app/data/lock', time());
    file_put_contents('/app/data/done', '0');
    file_put_contents('/app/data/saved', '0');
    
    exec('php /app/worker.php > /app/data/output &');
}