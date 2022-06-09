

<?php

    $content = json_decode(file_get_contents('admin/includes/conf.json'),true);
    // var_dump($content['database']);
    $created = $content['already_created'];
    $user_register = $content['user_register'];


    if($created  === false){

        include 'install.php';

        // $data = $content['database'];

        // $con = mysqli_connect($data['host'],$data['user'],$data['pswd']);

        // $sql = 'CREATE DATABASE IF NOT EXISTS nvmarie';

        // mysqli_query($con,$sql);
        
        // mysqli_select_db($con,'nvmarie');


        // include 'sql/read_file.php';

        // $tables = readTables();
        // $tables_data = getData();

        // foreach($tables as $tb){
        //     mysqli_query($con,$tb);
        // }

        // foreach($tables_data as $tbd){
        //     mysqli_query($con,$tbd);
        // }
        // mysqli_close($con);
        // header('location: admin/register.php');
    }
    else{
        include 'acceuil.php';
    }