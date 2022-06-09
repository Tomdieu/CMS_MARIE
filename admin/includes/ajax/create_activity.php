<?php


    if($_POST){

        $id_marie = $_POST['id_marie'];
        $nom = $_POST['nom'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'];
        
        include '../../functions/functions.php';
        include '../../functions/Activity.php';

        $output = [];
        if($_FILES['image']['error'] === 0){
            $filePath = '../../../static/images/';

            $pj = new Activity();
            
            $result = $pj->create($nom,$image,$content,$id_marie);
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