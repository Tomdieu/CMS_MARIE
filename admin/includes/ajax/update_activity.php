<?php

    if($_POST){
        $nom = $_POST['nom'];
        $id = $_POST['id'];
        $content = $_POST['content'];
        include '../../functions/functions.php';
        include '../../functions/Activity.php';

        $act = new Activity();
        $oldData = $act->findById($id);
        if($_FILES){
            if($_FILES['image']['error'] === 0){
                $filePath = '../../../static/images/';
                
                
                $image = $_FILES['image']['name'];
                $result = $act->update($nom,$image,$content,$id);
                if($result == 1)
                {
                    // if the project have been save we move the uploaded file
    
                    move_uploaded_file($_FILES['image']['tmp_name'],$filePath.$image);
                    $output['updated'] = true;
                }
            }
            else{
                $output['updated'] = true;

            }
            echo json_encode($output);
        }
        else{
            $image = $oldData['image'];
            $oldData = $act->findById($id);
            $result = $act->update($nom,$image,$content,$id);
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