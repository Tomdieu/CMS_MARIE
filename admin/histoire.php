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
                <h1>Histoire De La Marie</h1>
            </div>
            <?php
                include 'functions/histoire.php';
                $hist = new Histoire();
                $n = $hist->count();
            ?>
            <?php
                if($n===0){
                    echo '<div style="margin-top: 10px;">
                     <a href="create_history.php" class="a">Ajouter Une Histoir</a>
                    </div>';
                }
            ?>

           
           
            <div class="Histoire">
                
                <?php 
                    if($n > 0){
                        $hist_data = $hist->getHistory($id_marie);
                        $id = $hist_data['id'];
                        $jsn = json_encode($hist_data);
                        
                    echo  "<div class='hist'>
                    <p class'content'>".$hist_data['content']."</p>
                    <div class='footer'>
                        <button class='btn btn-danger' onclick='deleteHistoire($jsn)'>Delete</button>
                        <a href='update_history.php?id=$id'><button class='btn btn-primary'>Update</button></a>
                    </div>
                </div>";
                    }
                    
                
                ?>
            </div>
        </main>
        <script>
            function deleteHistoire(data){
                id = data['id'];
                var ok = confirm('Do you Want To Delete The History');
                if(ok){
                    fetch('includes/ajax/delete_history.php?id='+id)
                    .then(dt=>dt.json())
                    .then(r=>{
                        setTimeout(reload,1000);
                    })
                    .catch(err=>console.log(err));
                    function reload(){
                        window.location = 'histoire.php';
                    }
                }
            }
        </script>
    </div>
</body>