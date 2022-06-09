<?php

    if($_POST){
        $id_marie = $_POST['id_marie'];
        $content = $_POST['content'];

        include '../../functions/functions.php';
        include '../../functions/histoire.php';

        $hist = new Histoire();
        $res = $hist->create($id_marie,$content);
        var_dump($res);
        if($res == 1){
            $output['created'] = true;
        }
        else{
            $output['created'] = false;
        }
        echo json_encode($output);
    }
    else{
        echo json_encode([]);
    }