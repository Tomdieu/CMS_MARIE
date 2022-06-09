<?php


if ($_POST) {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $content = $_POST['content'];
    $type_annonce = $_POST['type'];


    include '../../functions/functions.php';
    include '../../functions/Annonce.php';
    $ann = new Annonce();
    $oldData = $ann->findById($id);

    if($_FILES) {
        $output = [];
        if ($_FILES['image']['error'] === 0) {
            $filePath = '../../../static/images/';

            
            $image = $_FILES['image']['name'];

            $result = $ann->update($nom, $type_annonce, $content,$image, $id);
            if ($result == 1) {
                // if the project have been save we move the uploaded file

                move_uploaded_file($_FILES['image']['tmp_name'], $filePath . $image);
                $output['updated'] = true;
            }
        } else {
            $output['updated'] = false;
        }



        echo json_encode($output);
    }
    else{
        $image = $oldData['image'];
        $result = $ann->update($nom, $type_annonce, $content,$image, $id);
        if ($result == 1) {
            $output['updated'] = true;
        }
        else{
            $output['updated'] = false;
            
        }
        echo json_encode($output);
        
    }
} else {
    echo json_encode([]);
}
