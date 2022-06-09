<?php

$content = file_get_contents('includes/conf.json');
$json = json_decode($content,true);
if($json['already_created']==false and $json['user_register']==true){

echo '<link href="css/style.css" rel="stylesheet">';
include 'includes/pages/marie.php';
}
elseif($json['already_created']==false && $json['user_register']==false){

    echo '<link href="css/style.css" rel="stylesheet">';
    include 'register.php';
}elseif($json['user_register']==true && $json['already_created']===true)
{
    include 'dashboard.php';
}
