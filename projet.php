<?php
$cnf = file_get_contents('admin/includes/conf.json');
$content = json_decode($cnf, true);
$site_name = $content['website']['name'];

include 'admin/functions/functions.php';
include 'admin/functions/Projet.php';

$pj = new Projets();
$project_data = $pj->all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie | Projet</title>
    <?php include 'icon.php' ?>
    <link href="style/style.css" rel="stylesheet" />
    <style>
        body{
            background-color: #010203;
        }
    </style>
</head>

<body>
    <div><?php include 'navbar.php' ?></div>
    <div class="projets">
        <h1>Projet Marie</h1>
        <div class="project-list">
            <?php 
            
                foreach($project_data as $projet){
                    $nom = $projet['nom'];
                    $content = $projet['content']; 
                    $img = $projet['image'];
                    echo "
                        <div class='projet'>
                            <div class='img'><img src='static/images/$img'/></div>
                            <div>Nom : $nom</div>
                            <div><p>$content</p></div>
                        </div>
                    ";
                }
            ?>

        </div>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>