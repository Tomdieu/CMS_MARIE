<?php


if($_GET){
    if(isset($_GET['id'])){ 
        $id = $_GET['id'];

        include '../../functions/functions.php';
        include '../../functions/Activity.php';


        $act = new Activity();
        $msg = [];
        if($act->delete($id)){
            $msg['deleted'] = true;
        }
        else{
            $msg['deleted'] = false;
        }

        echo json_encode($msg);

    }
    else{
        $err['error'] = 'yu must provide the id for the deletin to take place';
        echo json_encode($err);

    }
}
else{
    echo json_encode([]);
}