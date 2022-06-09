<?php

    include 'functions/functions.php';

    if(!isset($_SESSION['id'])){
        header('location: login.php');
    }
    else {
        $select           = new Selection();
        $user             = $select->selectUserById($_SESSION['id']);
        $_SESSION['user'] = $user;

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
                <h1>List Personnel</h1>
            </div>
            
            <div>
                <a href="add_personnel.php" class="a">Ajouter Un Personnel</a>
            </div>

           
            <?php 
                $personnel = new Personnel();
                $personnels = $personnel->all();
            ?>
            <div class="lists">
                
                <?php 

                    if($personnels){
                        foreach($personnels as $per){
                            $nom = $per['nom'];
                            $dt = json_encode($per);
                            echo "
                                <div class='list'>
                                    <div class='list-icon'>
                                        <span class='bi bi-person-circle'></span>
                                    </div>
                                    <div class='list-info'>
                                        <h2>".$nom."</h2>
                                    </div>
                                    <div>
                                       <a href='update_personnel.php?id=".$per['id']."'> <button class='btn btn-primary'>Update</button></a>
                                        <button class='btn btn-danger' onclick='deletePersonnel($dt)'>Delete</button>
                                    </div>
                                </div>
                            ";
    
                        }
                    }
                
                ?>
            </div>
            <script>
                function deletePersonnel(dt){
                    // console.log();
                    let nom = dt['nom'];
                    let id = dt['id'];
                    ok = confirm(`Voulez vous supprimer le personnels ${nom} ?`);
                    if(ok){
                        fetch(`includes/ajax/delete_personnel.php?id=${id}`)
                        .then(dt=>dt.json())
                        .then(dt=>{
                            setTimeout(reload,1000);
                        })
                        .catch(err=>{
                            console.log(err);
                        });

                        function reload(){
                            window.location = 'list_personnel.php';
                        }
                    }
                    else{
                        return;
                    }
                }
            </script>
        </main>
    </div>
</body>