<?php
require_once('/app/config.php');

$do = true;
while($do == true){
    genAddress();

    $done = file_get_contents('/app/data/done');
    $done = (int)$done;
    $done++;

    file_put_contents('/app/data/done', $done);
}