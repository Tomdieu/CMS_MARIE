<?php
// $phpFileUploadErrors = array(
//     0 => 'There is no error,file uploaded succcessfully',
//     1 => 'The upload file exceeds  the maximun upload file size directives in php.ini',
//     2 => 'The upload file excceds the MAX_FILE_SIZE directive that was specified in the HTML',
//     3 => 'The uploaded file was patially uploaded',
//     4 => 'No file was uploaded',
//     6 => 'Missing a temporary folder',
//     7 => 'Failed t write file to disk',
//     8 => 'A php extension stop the file upload.'
// );

// var_dump($_POST);
if ($_POST) {

    include '../../functions/functions.php';
    include '../../functions/hasher.php';
    // var_dump($_POST);
    $nom = $_POST['nom'];
    $parcours = $_POST['parcours'];
    $poste = $_POST['poste'];
    $id_marie = $_POST['id_marie'];

    // var_dump($_FILES);

    $output = [];
    if ($_FILES['photo']['error'] === 0 && $_FILES['cv']['error'] === 0) {

        $per = new Personnel();

        $cv = $_FILES['cv']['name'];
        $photo = $_FILES['photo']['name'];
        $filePath = '../../../static/';

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


        $result = $per->create($nom, $parcours, $poste, $cv_name, $photo_name, $id_marie);
        $output['out'] = $result;
        if ($result == 1) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $filePath . 'images/' . $photo_name);
            move_uploaded_file($_FILES['cv']['tmp_name'], $filePath . 'doc/' . $cv_name);
            $output['file_upload'] = true;
            $output['created'] = true;
        } else {
            $output['created'] = false;
        }
    } else {
        $output['created'] = false;
        $output['file_upload'] = false;
        $output['photo_error'] = $phpFileUploadErrors[$_FILES['photo']['error']];
        $output['cv_error'] = $phpFileUploadErrors[$_FILES['cv']['error']];
    }

    echo json_encode($output);
} else {
    $out['get'] = $_GET;
    $out['post'] = $_POST;
    $out['files'] = $_FILES;
    $out['error'] = 'method not allow';
    echo json_encode($out);
}
