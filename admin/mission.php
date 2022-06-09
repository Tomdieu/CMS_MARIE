<?php

    include 'functions/functions.php';

    if(!isset($_SESSION['id'])){
        header('location: login.php');
    }
    else {
        $select           = new Selection();
        $user             = $select->selectUserById($_SESSION['id']);
        $_SESSION['user'] = $user;

        $cnf = file_get_contents('./includes/conf.json');
        $cnf_data = json_decode($cnf,true);
        $website_name = $cnf_data['website']['name'];

        $marie = new Marie();
        $marie_data = $marie->getByName($website_name);
        $id_marie = $marie_data['id'];

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .a{
            padding:8px;
            border-radius: 3px;
            text-decoration: none;
            background-color: #ddd;
            color: #fff;
        }
        .a:active{
            transform: scale(.97);
        }
        main div{
            margin: 3px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php' ?>
    <div class="home_content">
        <header>
            <div class="text">
                <span>Nv Marie</span>
            </div>
            <div>
                <span class=""><?php echo $user['login'] ?? null;?></span>
            </div>
        </header>
        <main>
            <div>
                <h1>List Mission</h1>
            </div>
            
            <div style="margin: 3px;">
                <a href="create_mission.php" class="a">Ajouter Une Mission</a>
            </div>

           
            <?php 
            include 'functions/mission.php';
                $mission = new Mission();
                $missions = $mission->getAll($id_marie);
                // var_dump($missions);
            ?>
            <div class="lists-missiona">
                
                <?php 

                    foreach($missions as $miss){
                        echo "
                            <div class='mission'>
                                <div class='content'>".$miss['content']."</div>
                                <hr/>
                                <div class='contrl' style='width:100%;display:flex;justify-content:flex-end'>
                                    <a href='delete_mission.php?id=".$miss['id']."'><button class='btn btn-danger'>Delete</button></a>
                                    <a href='update_mission.php?id=".$miss['id']."'><button class='btn btn-success'>Update</button></a>
                                </div>
                            </div>
                        ";

                    }
                
                ?>
            </div>
        </main>
    </div>
</body>