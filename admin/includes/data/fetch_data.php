<?php


    include '../../functions/functions.php';


    $db = new Connection();

    $table = $_GET['table'];
    $id = $_GET['id'] ?? 1;
    $column = $_GET['column'] ?? 'id';


    if($table === 'regions'){
        $sql = "SELECT * FROM ".$table;
    }
    else{
        $sql = "SELECT * FROM ".$table." WHERE ".$column." = ".$id;
    }

    $result = mysqli_query($db->con,$sql);

    if(mysqli_num_rows($result) > 0){
        echo json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));
        // while($row = mysqli_fetch_assoc($result)){
        //     $data[] = $row;
        // }

    }
    else{
        $data = [];

        echo json_encode($data);
    }