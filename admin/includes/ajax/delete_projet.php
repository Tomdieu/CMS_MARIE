<?php

    if($_GET){
        $id = $_GET['id'];

        include '../../functions/functions.php';
        include '../../functions/Projet.php';

        $pj = new Projets();
        $output = [];
        if($pj->delete($id) === 1){
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
    