<?php
require_once('/app/config.php');

$i = 1;
$update = false;

$do = true;
while($do == true){
    genAddress();

    if($i == 10){
        $update = true;
    }

    if($update){
        $done = file_get_contents('/app/data/done');
        $done = (int)$done;
        $done = $done + $i;
        file_put_contents('/app/data/done', $done);

        $i = 0;
        $update = false;
    }

    $i++;
}