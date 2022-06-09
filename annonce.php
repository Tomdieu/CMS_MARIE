<?php 
    $cnf = file_get_contents('admin/includes/conf.json');
    $content = json_decode($cnf,true);
    $site_name = $content['website']['name'];

include 'admin/functions/functions.php';
include 'admin/functions/Annonce.php';

$ann = new Annonce();
$annonce_data = $ann->all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie | Annonce</title>
    <?php include 'icon.php' ?>
    <link href="style/style.css" rel="stylesheet"/>
</head>
<body>
    <div><?php include 'navbar.php'?></div>
    <div class="projets">
        <h1>Annonce Marie</h1>
        <div class="project-list">
            <?php 
            
                foreach($annonce_data as $annonce){
                    $nom = $annonce['nom'];
                    $content = $annonce['content']; 
                    $type =  $annonce['type'];
                    $img = $annonce['image'];
                    echo "
                        <div class='projet'>
                            <div class='img'><img src='static/images/$img'/></div>
                            <div>$nom <br/>Annonce <b>$type</b></div>
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