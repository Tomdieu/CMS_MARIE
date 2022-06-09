<?php
$cnf = file_get_contents('admin/includes/conf.json');
$content = json_decode($cnf, true);
$site_name = $content['website']['name'];

include 'admin/functions/functions.php';
include 'admin/functions/Activity.php';

$act = new Activity();
$activity_data = $act->all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie | Activiter</title>
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
    <div class='activity'>
        <h1>Activite</h1>
        <div class="project-list">
            <?php 
                foreach($activity_data as $acti){
                    $nom = $acti['nom'];
                    $image = $acti['image'];
                    $content = $acti['content'];

                    echo "
                        <div class='projet'>
                            <div class='img'><img src='static/images/$image'/></div>
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