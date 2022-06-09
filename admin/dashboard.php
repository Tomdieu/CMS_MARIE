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
    <style>
        .personnel-footer a{
            text-decoration: none;
            color:#fff;
            font-weight: bold;
            text-decoration: underline;
            letter-spacing: 5px;
            font-size: 1.3em;
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
            <div class="lists">
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-person-circle"></span>
                    </div>
                    <div class="list-info">
                        <h2>Personnel Marie</h2>
                        <?php 
                            $per = new Personnel();
                        ?>
                        <h4><?php echo  $per->count();?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_personnel.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-bar-chart-steps"></span>
                    </div>
                    <div class="list-info">
                        <h2>Projet Marie</h2>
                        <?php
                        include 'functions/Projet.php'; 
                            $pj = new Projets();

                        ?>
                        <h4><?php echo $pj->count()?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_projets.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-signpost-split-fill"></span>
                    </div>
                    <div class="list-info">
                        <?php 
                            include 'functions/mission.php';
                            $miss = new Mission();

                        ?>
                        <h2>Mission Marie</h2>
                        <h4><?php echo $miss->count();?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="create_history.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-bar-chart-fill"></span>
                    </div>
                    <div class="list-info">
                        <?php 
                            include 'functions/Activity.php';
                            $act = new Activity();
                        ?>
                        <h2>Activiter Marie</h2>
                        <h4><?php echo $act->count()?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_activity.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-calendar-event"></span>
                    </div>
                    <div class="list-info">
                        <?php 
                            include 'functions/Annonce.php';
                            $ann = new Annonce();
                        ?>
                        <h2>Annonce Marie</h2>
                        <h4><?php echo $ann->count();?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_annonce.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-geo-alt"></span>
                    </div>
                    <div class="list-info">
                        <?php 
                            include 'functions/LieuTouristique.php';
                            $lieux = new LieuxTouristique();
                            
                        ?>
                        <h2>Lieux Touristic</h2>
                        <h4><?php echo $lieux->count();?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_lieux_touristique.php"><button>Ajouter</button></a>
                    </div>
                </div>
                <div class="list">
                    <div class="list-icon">
                        <span class="bi bi-file-image"></span>
                    </div>
                    <div class="list-info">
                        <?php 
                            include 'functions/Publiciter.php';
                            $pub = new Publiciter()
                        ?>
                        <h2>Publiciter Marie</h2>
                        <h4><?php echo $pub->count()?></h4>
                    </div>
                    <div class="list-footer">
                        <a href="add_publiciter.php"><button>Ajouter</button></a>
                    </div>
                </div>
            </div>
            <div class="users">
                <div>
                    <h1>Users</h1>
                </div>
                <div>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>ivantom</td>
                            <td>ivantomdio@gmail.com</td>
                            <td>Admin</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="personnels">
                <div>
                    <h1>Personnel Marie</h1>
                </div>
                <div class="list-personnels">
                    <?php

                        $list_personnel = $per->all();

                        if(count($list_personnel) >= 1){
                            foreach($list_personnel as $personnel){
                                $img = $personnel['photo'];
                                $poste = $personnel['poste'];
                                $cv = $personnel['cv'];
                                // var_dump($personnel);
                                echo "<div class='personnel'>
                                <div class='personnel-head'>
                                    <img src='../static/images/$img' alret=''>
                                </div>
                                <div class='personnel-info'>
                                    <h4>Nom : ".$personnel['nom']."</h4>
                                   
                                    <h5>Post : $poste</h5>
                                </div>
                                <div class='personnel-footer'>
                                    <a href='../static/doc/$cv'>cv</a>
                                </div>
                            </div>
                                ";
                            }
                        }
                        else{
                            echo 'Aucun Personnel';
                        }

                    ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>