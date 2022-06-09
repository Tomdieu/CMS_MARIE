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
$marie_info = $ms->getInfo($id_marie);


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
    <?php include 'icon.php' ?>
    <style>
        .info{
            font-size: 1.2em;
            display: flex;
            justify-content: center;
            background-color: #010203;
            /* padding:20px; */
        }
        
    </style>
    <style>
        body{
            background-color: #2c5175;
        }
    </style>
</head>

<body>
    <div><?php include 'navbar.php' ?></div>
    <div>
        <h1>Presentation </h1>
        <div class="histore info" style="text-align: center;">
            <div style="max-width: 500px;text-align:left;margin:10px">
            <h1 align="center">Information de la marie de  <?php echo $marie_info['arrondissement']?> </h1>
            <!-- <div>
                Nom : <?php echo $marie_info['nom']?>
            </div> -->
            <div>
                Region : <?php echo $marie_info['region']?>
            </div>
            <div>
                Departement : <?php echo $marie_info['departement']?>
            </div>
            <div>
                Arrondissement : <?php echo $marie_info['arrondissement']?>
            </div>
            </div>
        </div>
        <div class="histore">
            <h1 align="center">Histoire de la marie</h1>
            <p>

                <?php echo $hist_data['content'] ?>
            </p>
        </div>

        <div class="personne">
            <h1 align="center">Personnel de la Marie</h1>
            <div class="personnel">

                <?php

                if($personnel){
                    foreach ($personnel as $per) {
                        $nom = $per['nom'];
                        $parcour = $per['parcours'];
                        $cv = $per['cv'];
                        $img = $per['photo'];
                        echo "
                            <div class='per'>
                                <div class='img' style=''>
                                    <img heigth='200' src='static/images/$img'/>
                                </div>
                                <div>Nom : $nom</div>
                                <div>
                                    Parcous:<br/>
                                <p>$parcour</p>
                                </div>
                                <a href='static/doc/$cv'><button>Telecharger Le Cv</button></a>
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
        <h1 align="center">Mission de la Marie</h1>
        <div class="mission">
                <?php 
                    $i =1;
                    foreach($mission_data as $mis){
                        $cnt = $mis['content'];
                        echo "
                            <div class='mis'>
                                $i <p>$cnt</p>
                            </div>
                        ";
                        $i += 1;
                    }
                ?>
        </div>
    </div>

    <?php include 'footer.php'?>
</body>

</html>