<?php
function readCnf(){
    return json_decode(file_get_contents('../conf.json'),true);
}

function updateCnf($data){
    $old_data = readCnf();
    foreach($data as $key=> $value){
        $old_data[$key] = $value;
    }

    file_put_contents('../conf.json',json_encode($old_data));
}
