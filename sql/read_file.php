<?php

define('ROOT_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
session_start();


    function readTables(){
        include 'create_tables.php';

        return $tables;
    }


    function getData(){
        include 'tables_data.php';
        return $tables_data;
    }

    function readCnf(){
        return json_decode(file_get_contents(ROOT_PATH.'admin/includes/conf.json'),true);
    }

    function updateCnf($data){
        $old_data = readCnf();
        foreach($data as $key=> $value){
            $old_data[$key] = $value;
        }

        file_put_contents(ROOT_PATH.'admin/includes/conf.json',json_encode($old_data));
    }