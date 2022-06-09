<?php


if ($_GET) {
    if (isset($_GET['id'])) {
        include '../../functions/functions.php';
        include '../../functions/Publiciter.php';

        $id = $_GET['id'];
        $out =[];
        $ann = new Publiciter();
        if($ann->delete($id)){
            $out['deleted'] = true;
        }
        else{
            $out['deleted'] = false;
        }
        echo json_encode($out);

    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
