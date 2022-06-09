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
        button,
        textarea {
            padding: 8px;
            border-radius: 3px;
        }

        button:active {
            transform: scale(.97);
        }

        main {
            position: relative;
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
                <h1>List Des Activiter</h1>
            </div>
            
            <div>
                <a href="add_activity.php" class="a">Ajouter Une Activite</a>
            </div>

           
            <?php 
                include 'functions/Activity.php';
                $projet = new Activity();
                $projets = $projet->all();

            ?>
            <div class="list-projet">
                
                <?php 

                    foreach($projets as $pro){
                        $nom = $pro['nom'];
                        $dt = $pro; 
                        $out = json_encode($pro);
                        $id = $pro['id'];

                        echo "
                            <div class='projet'>
                                <div class='head'>
                                    <img src='../static/images/".$dt['image']."'/>
                                </div>
                                <div class='body bg-black'>"
                                    .$dt['content'].
                                "</div>
                                <div class='footer bg-trans'> 
                                    <button class='btn-danger' onclick='deleteProjet($out)'>Delete</button>
                                    <button class='btn btn-primary' onclick='openURL($out)'>Update</button>
                                </div>
                            </div>
                        ";

                    }
                
                ?>
            </div>
            <script>
                function deleteProjet(dt){
                    // console.log();
                    let nom = dt['nom'];
                    let id = dt['id'];
                    ok = confirm(`Voulez vous supprimer le projet ${nom} ?`);
                    if(ok){
                        fetch(`includes/ajax/delete_activity.php?id=${id}`)
                        .then(dt=>dt.json())
                        .then(dt=>{
                            setTimeout(reload,1000);
                        })
                        .catch(err=>{
                            console.log(err);
                        });

                        function reload(){
                            window.location = 'list_activity.php';
                        }
                    }
                    else{
                        return;
                    }
                }

                function openURL(dt){
                    console.log(dt);
                    window.location = 'update_activity.php?id='+dt['id'];
                }
            </script>
        </main>
    </div>
</body>