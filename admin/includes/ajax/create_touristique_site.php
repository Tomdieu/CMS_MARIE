<?php


if ($_POST) {

    $id_marie = $_POST['id_marie'];
    $nom = $_POST['nom'];
    $content = $_POST['content'];

    include '../../functions/functions.php';
    include '../../functions/LieuTouristique.php';
    $lieux = new LieuxTouristique();
    if($_FILES) {
        $output = [];
        if ($_FILES['image']['error'] === 0) {
            $filePath = '../../../static/images/';

            
            $image = $_FILES['image']['name'];

            $result = $lieux->create($nom,$image, $content,$id_marie);
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
        $result = $lieux->create($nom, '', $content,$id_marie);
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
