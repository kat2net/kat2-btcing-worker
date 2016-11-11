<?php
require_once('/app/config.php');

$i = 0;
$do = true;
while($do == true){
    genAddress();
    $i++;

    file_put_contents('/app/data/done', $i);
}
