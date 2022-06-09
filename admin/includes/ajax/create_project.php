<?php


    if($_POST){
        $id_marie = $_POST['id_marie'];
        $nom = $_POST['nom'];
        $cntent = $_POST['content'];
        $image = $_FILES['image']['name'];
        $output = [];
        if($_FILES['image']['error'] === 0){
            $filePath = '../../../static/images/';
            include '../../functions/functions.php';

            include '../../functions/Projet.php';

            $pj = new Projets();
            
            $result = $pj->create($nom,$image,$cntent,$id_marie);
            if($result == 1){
                // if the project have been save we move the uploaded file

                move_uploaded_file($_FILES['image']['tmp_name'],$filePath.$image);
                $output['created'] = true;
            }

            }else{
                $output['created'] = false;
            }

        echo json_encode($output);
    }
    else{
        echo json_encode([]);
    }