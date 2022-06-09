<?php

    $content = file_get_contents('./includes/conf.json');
    $data = json_decode($content,true);
    var_dump($data);

    if($data['user_register'] == true && $data['already_created']==false){
        include_once '../index.php';
    }
    elseif($data['user_register'] == false && $data['already_created'] == false){
        include './register.php';
    }
    else{
        include '../dashboard.php';
    }