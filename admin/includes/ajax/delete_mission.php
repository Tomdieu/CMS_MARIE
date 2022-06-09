<?php


    if($_GET){
        $id = $_GET['id'];

        include '../../functions/functions.php';
        include '../../functions/mission.php';
        
        
        $ms = new Mission();
        $output = [];
        if($ms->delete($id)){
            $output['deleted'] = true;
            echo json_encode($output);
        }
        else{
            $output['deleted'] = false;

            echo json_encode($output);
        }
    }