<?php


    include '../../functions/functions.php';
    include '../../functions/mission.php';
    
    if($_POST){
        $content = $_POST['content'];
        $id_marie = $_POST['id_marie'];


        $mission = new Mission();
        $result = $mission->create($id_marie,$content);
        $output = [];
        if($result == 1){
            $output['created'] = true;
            echo json_encode($output);
        }
        else{
            $output['created'] = false;
            echo json_encode($output);
        }
    }