<?php

    if($_GET){
        $id= $_GET['id'];

        include_once '../../functions/functions.php';

        $output = [];

        $per = new Personnel();
        if($per->delete($id) === 1){
            $output['deleted'] = true;
        }
        else{
            $output['deleted'] = false;
        }

        echo json_encode($output);

    }   
    else{
        echo json_encode([]);
    }