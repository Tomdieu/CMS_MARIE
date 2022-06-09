<?php


    include 'read_file.php';


    $tables = getData();

    file_put_contents('sql.sql',$tables);