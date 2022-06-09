<?php


    include '../../functions/functions.php';
    include '../../functions/mission.php';
    
    if($_POST){
        $content = $_POST['content'];
        $id = $_POST['id'];


        $mission = new Mission();
        $result = $mission->update($id,$content);
        $output = [];
        if($result == 1){
            $output['updated'] = true;
            echo json_encode($output);
        }
        else{
            $output['updated'] = false;
            echo json_encode($output);
        }
    }