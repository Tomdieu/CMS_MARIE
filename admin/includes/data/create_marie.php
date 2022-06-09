<?php
include '../../functions/functions.php';
include 'update_config.php';


    $data = readCnf();

    $name=  $_POST['name'];
    $id_region = $_POST['id_region'];
    $id_departement = $_POST['id_departement'];
    $id_arrondissement = $_POST['id_arrondissement'];
    $dt['name'] = $name;
    $dt['id_departement'] = $id_departement;
    $dt['id_arrondissement'] = $id_arrondissement;
    $dt['id_region'] = $id_region;
    $marie = new Marie();
    $res = $marie->create($name,$id_region,$id_departement,$id_arrondissement);
    if($res === 1){
        $data['already_created'] = true;
        $data['user_register'] = true;
        $data['website']['name'] = $name;
        updateCnf($data);

        $dt['created'] = true;
    }
    else{
        $dt['created'] = false;
    }

    echo json_encode($dt);

