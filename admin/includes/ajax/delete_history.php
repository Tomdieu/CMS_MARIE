<?php

    if ($_GET) {
        $id = $_GET['id'];

        include '../../functions/functions.php';
        include '../../functions/histoire.php';

        $out = [];
        $hist = new Histoire();
        $result = $hist->delete($id);

        if ($result == 1) {
            $out['deleted'] = true;
        } else {
            $out['deleted'] = false;
        }
        echo json_encode($out);
    } else {
        echo json_encode([]);
    }
