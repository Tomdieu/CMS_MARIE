<?php


    if($_POST){
        include '../../functions/functions.php';
        include '../../functions/hasher.php';
        
        include '../../functions/Projet.php';
        $nom = $_POST['nom'];
        $cntent = $_POST['content'];
        $id_project = $_POST['project_id'];
        $output = [];
        $pj = new Projets();
        $oldData = $pj->findById($id_project);
        if($_FILES){
            if($_FILES['image']['error'] === 0)
            {
                $filePath = '../../../static/images/';
                
                
                $image = $_FILES['image']['name'];
                // $oldData = $pj->findById($id_project);
                $result = $pj->update($id_project,$nom,$image,$cntent);
                if($result == 1)
                {
                    // if the project have been save we move the uploaded file
    
                    move_uploaded_file($_FILES['image']['tmp_name'],$filePath.$image);
                    $output['updated'] = true;
                }
    
            }
            else
            {
                $output['updated'] = false;
            }
    
            echo json_encode($output);
        }
        else{
            $image = $oldData['image'];
            $oldData = $pj->findById($id_project);
            $result = $pj->update($id_project,$nom,$image,$cntent);
            if($result == 1)
            {
                $output['updated'] = true;
            }
            else{
                $output['updated'] = false;
            }
            echo json_encode($output);

        }
    }

    else{
        echo json_encode([]);
    }