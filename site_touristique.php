<?php 
    $cnf = file_get_contents('admin/includes/conf.json');
    $content = json_decode($cnf,true);
    $site_name = $content['website']['name'];


include 'admin/functions/functions.php';
include 'admin/functions/LieuTouristique.php';

$tour = new LieuxTouristique();
$lieux = $tour->all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie | Lieux Touristique </title>
    <?php include 'icon.php' ?>
    <link href="style/style.css" rel="stylesheet"/>
    <style>
        body{
            background-color: #010203;
        }
    </style>
</head>
<body>
    <div><?php include 'navbar.php'?></div>
    <div class='tourist'>
        <h1>Lieux Touristique</h1>
        <div class="tourist-list">
            <?php 
                foreach($lieux as $lieu){
                    $nom = $lieu['nom'];
                    $image = $lieu['image'];
                    $content = $lieu['description'];

                    echo "
                        <div class='lieu'>
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