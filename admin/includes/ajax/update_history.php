<?php

    if($_POST){
        $id = $_POST['id'];
        $content = $_POST['content'];

        include '../../functions/functions.php';
        include '../../functions/histoire.php';

        $out = [];
        $hist = new Histoire();
        $result = $hist->update($content,$id);
        $out['result'] = $result;

        if($result == 1){
            $out['updated'] = true;
        }
        else{
            $out['updated'] = false;
        }
        echo json_encode($out);

    }
    else{
        echo json_encode([]);
    }
