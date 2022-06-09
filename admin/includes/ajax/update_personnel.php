<?php

include_once '../../functions/functions.php';
$filePath = '../../../static/doc/';
$fileImage = '../../../static/images/';


// $output[] = $_FILES;
// $output[] = $_POST;
$output['uploaded'] = false;
$output['error'] = false;

if ($_FILES) {
    if ($_FILES['cv']['error'] === 0 && $_FILES['photo']['error'] === 0) {
        $personnel = new Personnel();
        $oldData = $personnel->findById($_POST['id']);


        $file_ext = explode('.', $_FILES['cv']['name']);
        $cv_name = $file_ext[0];
        $file_ext = end($file_ext);
        $cv_name .= '_' . UUID();
        $cv_name .= '.'.$file_ext;

        $file_ext = explode('.', $_FILES['photo']['name']);
        $photo_name = $file_ext[0];
        $file_ext = end($file_ext);
        $photo_name .= '_' . UUID();
        $photo_name .= '.'.$file_ext;
        move_uploaded_file($_FILES['cv']['tmp_name'], $filePath . $cv_name);
        move_uploaded_file($_FILES['photo']['tmp_name'], $fileImage . $photo_name);

        rename($filePath . $oldData['cv'], $filePath .$cv_name);
        rename($fileImage . $oldData['photo'], $fileImage .$photo_name);

        $result = $personnel->update($_POST['id'], $_POST['nom'], $_POST['parcours'],$_POST['poste'], $_FILES['cv']['name'],$_FILES['photo']['name']);
        if ($result == 1) {
            $output['updated'] = true;
            $output['uploaded'] = true;
        } else {
            $output['updated'] = false;
        }
    } else {
        $phpFileUploadErrors = array(
            0 => 'There is no error,file uploaded succcessfully',
            1 => 'The upload file exceeds  the maximun upload file size directives in php.ini',
            2 => 'The upload file excceds the MAX_FILE_SIZE directive that was specified in the HTML',
            3 => 'The uploaded file was patially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed t write file to disk',
            8 => 'A php extension stop the file upload.'
        );
        $output['error'] = true;

        $output['cv_error_msg'] = $phpFileUploadErrors[$_FILES['cv']['error']];
        $output['photo_error_msg'] = $phpFileUploadErrors[$_FILES['photo']['error']];
    }
} else {
    $personnel = new Personnel();
    $oldData = $personnel->findById($_POST['id']);
    $result = $personnel->update($_POST['id'], $_POST['nom'], $_POST['parcours'],$_POST['poste'], $oldData['cv'],$oldData['photo']);
    if($result == 1){
        $output['updated'] = true;
    }else{
        $output['updated'] = false;
    }

    // echo $output;
}




echo json_encode($output);
