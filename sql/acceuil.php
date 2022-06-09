<?php
include 'admin/functions/functions.php';
include 'admin/functions/histoire.php';
include 'admin/functions/mission.php';

$cnf = file_get_contents('admin/includes/conf.json');
$content = json_decode($cnf, true);
$site_name = $content['website']['name'];

$ms = new Marie();
$marie_data = $ms->getByName($site_name);

$id_marie = $marie_data['id'];

$hist = new Histoire();
$hist_data = $hist->getHistory($id_marie);

$per = new Personnel();
$personnel  = $per->all();


$mis = new Mission();
$mission_data = $mis->getAll($id_marie);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie</title>
    <link href="style/style.css" rel="stylesheet" />
</head>

<body>
    <div><?php include 'navbar.php' ?></div>
    <div>
        <h1>Presentation</h1>
        <div class="histore">
            <h1>Histoire De La Marie</h1>
            <p>

                <?php echo $hist_data['content'] ?>
            </p>
        </div>

        <div class="personne">
            <h1>Personnel De La Marie</h1>
            <div class="personnel">

                <?php

                foreach ($personnel as $per) {
                    $nom = $per['nom'];
                    $parcour = $per['parcours'];
                    $cv = $per['cv'];
                    echo "
                        <div class='per'>
                            <div></div>
                            <div>Nom : $nom</div>
                            <div>
                                Parcous:<br/>
                            <p>$parcour</p>
                            </div>
                            <a href='static/doc/$cv'><button>Telecharger Le Cv</button></a>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>

        <div>
            <h1>Mission de la marie</h1>
        <div class="mission">
                <?php 
                    foreach($mission_data as $mis){
                        $cnt = $mis['content'];
                        echo "
                            <div class='mis'>
                                <p>$cnt</p>
                            </div>
                        ";
                    }
                ?>
        </div>
        </div>
    </div>

    <?php include 'footer.php'?>
</body>

</html>