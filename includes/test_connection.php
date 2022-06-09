<?php

    define('PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
    $output = [];
    if($_POST){
        $db_name = $_POST['db_name'];
        $db_user = $_POST['db_user'];
        $db_psw = $_POST['db_psw'] ?? '';
        $db_host = $_POST['db_host'];
        $db_port = $_POST['db_port'] ?? 3306;
        
        try{
            $con = mysqli_connect($db_host,$db_user,$db_psw,$db_name,$db_port);
            if($con){
            $output['connected'] = true;

            require_once PATH.'sql/read_file.php';
            $tables = readTables();
            $tables_data = getData();
            foreach($tables as $tb){
                mysqli_query($con,$tb);
            }
    
            foreach($tables_data as $tbd){
                mysqli_query($con,$tbd);
            }

            // include PATH.'admin/includes/data/update_config.php';
            $data = readCnf();
            $data['database']['name'] = $db_name;
            $data['database']['user'] = $db_user;
            $data['database']['pswd'] = $db_psw;
            $data['database']['host'] = $db_host;

            $data['user_register'] = true;
            updateCnf($data);

            }else{
            $output['connected'] = false;

            }
        }
        catch (\Throwable $th) {
            //throw $th;
            $output['connected'] = false;
        }

        // try {
        //     //code...
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        // catch(Exception e){
        //     $output['connected'] = false;
        // }
    }else{
        $output['error'] = 'This page only accept post method!';
    }

    echo json_encode($output);