<?php 
    $cnf = file_get_contents('admin/includes/conf.json');
    $content = json_decode($cnf,true);
    $site_name = $content['website']['name'];


include 'admin/functions/functions.php';
include 'admin/functions/Publiciter.php';

$pub = new Publiciter();
$pub_data = $pub->all();

foreach($pub_data as $p){
    $pub->increase($p['id']);
}

$pub_data = $pub->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie | Publiciter</title>
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
    <div class='activity'>
        <h1>Espace Publiciter</h1>
        <div class="project-list">
            <?php 
                foreach($pub_data as $acti){
                    $nom = $acti['title'];
                    $image = $acti['image'];
                    $content = $acti['content'];
                    $num = $acti['visitors'];

                    echo "
                        <div class='projet'>
                            <div class='img'><img src='static/images/$image'/></div>
                            <div>Nom : $nom</div>
                            <div>Nombre de vue : $num</div>
                            <div><p>$content</p></div>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>