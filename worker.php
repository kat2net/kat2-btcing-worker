<?php
require_once('/app/config.php');

$i = 1;
$update = false;

$do = true;
while($do == true){
    $addr = genAddress();

    if($addr['success']){

        if($addr['saved']){
            $saved = file_get_contents('/app/data/saved');
            $saved = (int)$saved;
            $saved = $saved + 1;
            file_put_contents('/app/data/saved', $saved);
        }

        if($i == 5){$update = true;}

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
}