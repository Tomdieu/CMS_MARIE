<?php

    if($_POST){
        $login = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $id = $_POST['id'];

        include '../../functions/functions.php';
        // var_dump($_POST);
        $reg = new Register();
        $result = $reg->update($login,$email,$password,$id);
        $out = [];
        $out['r'] = $result;
        if($result){
            $out['updated'] = true;
        }
        else{
            $out['updated'] = false;

        }
        echo json_encode($out);
    }else{  
        echo json_encode([]);
    }