<?php


if ($_POST) {

    $id_marie = $_POST['id_marie'];
    $nom = $_POST['nom'];
    $content = $_POST['content'];
    $type_annonce = $_POST['type_annonce'];

    include '../../functions/functions.php';
    include '../../functions/Annonce.php';
    $ann = new Annonce();
    if($_FILES) {
        $output = [];
        if ($_FILES['image']['error'] === 0) {
            $filePath = '../../../static/images/';

            
            $image = $_FILES['image']['name'];

            $result = $ann->create($nom, $type_annonce, $content,$image, $id_marie);
            if ($result == 1) {
                // if the project have been save we move the uploaded file

                move_uploaded_file($_FILES['image']['tmp_name'], $filePath . $image);
                $output['created'] = true;
            }
        } else {
            $output['created'] = false;
        }



        echo json_encode($output);
    }
    else{
        $result = $ann->create($nom, $type_annonce, $content,'', $id_marie);
        if ($result == 1) {
            $output['created'] = true;
        }
        else{
            $output['created'] = false;
            
        }
        echo json_encode($output);
        
    }
} else {
    echo json_encode([]);
}
