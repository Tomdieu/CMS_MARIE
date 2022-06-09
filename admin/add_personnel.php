<?php

include 'functions/functions.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');
} else {
    $select           = new Selection();
    $user             = $select->selectUserById($_SESSION['id']);
    $_SESSION['user'] = $user;
}

$cnf = file_get_contents('./includes/conf.json');
$cnf_data = json_decode($cnf, true);
$website_name = $cnf_data['website']['name'];

$marie = new Marie();
$marie_data = $marie->getByName($website_name);
$id_marie = $marie_data['id'];

// if ($_POST) {

//     $ext_erro = false;
//     // extensions allow to be uploaded
//     $extensions = array('pdf');
//     $file_ext = explode('.', $_FILES['cv']['name']);
//     var_dump($file_ext[0]);
//     echo $file_ext;
//     $file_ext = end($file_ext);


//     $phpFileUploadErrors = array(
//         0 => 'There is no error,file uploaded succcessfully',
//         1 => 'The upload file exceeds  the maximun upload file size directives in php.ini',
//         2 => 'The upload file excceds the MAX_FILE_SIZE directive that was specified in the HTML',
//         3 => 'The uploaded file was patially uploaded',
//         4 => 'No file was uploaded',
//         6 => 'Missing a temporary folder',
//         7 => 'Failed t write file to disk',
//         8 => 'A php extension stop the file upload.'
//     );


//     if (!in_array($file_ext, $extensions)) {
//         $ext_erro = true;
//     }
//     // if the error of upload is not equal to zero
//     if ($_FILES['cv']['error']) {
//         echo $phpFileUploadErrors[$_FILES['cv']['error']];
//     } elseif ($ext_erro) {
//         echo 'invalid file extension';
//     } else {
//         $path = '../static/doc/';
//         $data = json_decode(file_get_contents('./includes/conf.json'), true);
//         var_dump($_POST, $data);
//         $name = $data['website']['name'];

//         $marie = new Marie();
//         $ma = $marie->getByName($name);
//         var_dump($ma);
//         move_uploaded_file($_FILES['cv']['tmp_name'], $path . $_FILES['cv']['name']);

//         $personnel = new Personnel();
//         // $personnel->create();
//         $nom = $_POST['nom'];
//         $parcours = $_POST['parcours'];
//         // $personnel->create($nom,$parcours,$_FILES['cv']['name'],1);
//         $filepath = '../images';
//         echo 'image has beeen uploaded successfully';
//         // echo '<script>Heloo</script>';
//     }

//     // echo '<pre>';
//     // var_dump($_FILES);
//     // echo '</pre>';
// }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="icons/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="css/editor.css" rel="stylesheet">
    <style>
        button,
        textarea {
            padding: 8px;
            border-radius: 3px;
        }

        button {
            cursor: pointer;
        }

        button:active {
            transform: scale(.97);
        }

        main {
            position: relative;
        }

        .form {
            padding: 10px;
        }
        body{
            position: relative;
        }
        .modal{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.897);
            top: 0;
            right: 0;
            /* bottom: 0; */
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal.hide{
            display: none;
        }
        .modal_content{
            padding: 8px;
            box-shadow: 0 0 0 4px rgb(218, 160, 160);
            border-radius: 4px;
            background-color: rgb(139, 79, 79);
            max-width: 300px;
        }
        .modal_content .input h4{
            color: #fff;
            font-size: 1.3em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            text-align: center;
        }
        .modal_content .input{
            padding: 9px;
            margin: 5px;
        }
        .modal_content .input button{
            background-color: rgb(218, 160, 160);
            color: #fff;
            font-weight: 900;
            transition: all 0s;
            font-size: 1.2em;
            box-shadow: 0 0 0 2px rgb(252, 103, 103);
        }
        .modal_content .input button:hover{
            box-shadow: 0 0 0 2px #fff,0 0 0 4px rgba(255, 162, 162, 0.867);
            background-color: #fff;
            color:rgb(218, 160, 160);
        }
        .zoom{
            animation: zoom .5s ease-out;
        }
        @keyframes zoom {
            from{
                transform: scale(0);
            }
            to{
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="home_content">
        <header>
            <div class="text">
                <span>Nv Marie</span>
            </div>
            <div>
                <span class=""><?php echo $user['login'] ?? null; ?></span>
            </div>
        </header>
        <main style="display:block;justify-content:center;align-items:center;width:100%">

            <div class="add_personnel">
                <div sid="form" class="form">
                    <h1 align="center">Ajouter Un Personnel</h1>
                    <input type="hidden" value="<?php echo $id_marie ?>" id='id_marie' />
                    <div class="form-input">
                        <label>Nom</label>
                        <input type="text" id="nom" placeholder="nom et prenom du personnel" required />
                    </div>
                    <div class="input">
                        <div class="controls" id='editor_controls'>
                        </div>
                    </div>
                    <div class="input">
                        <label for="parcours"> Replisser Le Parcours</label>
                        <div id="parcours" class="editor" contenteditable="true" spellcheck="false"></div>
                    </div>
                    <div class="form-input">
                        <label>Poste</label>
                        <?php 
                            $poste['maire'] = "Maire";
                            $poste['ajoint1'] = "1er Adjoint";
                            $poste['ajoint2'] = "2e Adjoint";
                            $poste['ajoint3'] = "3e Adjoint";
                            $poste['ajoint4'] = "4e Adjoint";

                        ?>
                        <select id="poste">
                            <option value="">Selectionner le poste</option>
                            <?php 
                                foreach($poste as $k => $v){
                                    echo "<option value='$k'>$v</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-input">
                        <label>Cv</label>
                        <input id="cv" type="file" accept="application/pdf" required />
                    </div>
                    <div class="form-input">
                        <label>Photo</label>
                        <input id="image" type="file" accept="image/png,image/jpeg" required />
                    </div>
                    <div class="form-input">
                        <button type="submit" id="submit" name="submit">Save</button>
                    </div>

                </div>
            </div>
        </main>
        <div class="spinner"></div>
        <div class="modal hide">
            <div class="modal_content zoom">
                <div class="input">
                    <h4>An error occur When Submitting the form please try again!</h4>
                </div>
                <div class="input">
                    <button onclick="hide()">Close</button>
                </div>
            </div>
        </div>
        <script>
            var submit = document.querySelector('#submit');
            var nom = document.querySelector("#nom");
            var parcours = document.querySelector("#parcours");
            var poste = document.querySelector("#poste");
            var cv = document.querySelector("#cv");
            var image = document.querySelector("#image");
            var id_marie = document.querySelector("#id_marie");
            var spinner = document.querySelector(".spinner");
            // var form = document.querySelector("#form");
            var modal = document.querySelector(".modal");


            function hide(){
                modal.classList.add('hide');
            }

            const sendData = (e) => {
                e.preventDefault();
                if (nom.value.length === 0) {
                    alert('Please enter the name of the personnel');
                    nom.focus();
                    return;
                }
                if (parcours.innerHTML.length === 0) {
                    alert('Please enter the parcours of the personnel!');
                    parcours.focus()
                    return;
                }
                if (poste.value.length === 0) {
                    alert("Please select the poste of the personnel!");
                    return;
                }

                if (cv.files.length == 0) {
                    alert("PLease select the cv of the personnel in pdf format!");
                    return;
                }

                if (image.files.length == 0) {
                    alert("PLease Select an image of the personnel!");
                    return;
                }

                if (cv.files.length !== 0) {
                    let mime_type = ['application/pdf'];
                    var file = cv.files[0];

                    if (mime_type.indexOf(file.type) == -1) {
                        alert('please select a pdf file');
                        return;
                    }
                }

                if (image.files.length !== 0) {
                    let mime_type = ['image/png', 'image/jpeg'];

                    var file = image.files[0];

                    if (mime_type.indexOf(file.type) == -1) {
                        alert('PLease Select Jpeg or png files!');
                        return;
                    }
                }

                submit.setAttribute('disabled', true);
                spinner.classList.add('active');

                var formData = new FormData();
                formData.append('nom', nom.value);
                formData.append('parcours', parcours.innerHTML);
                formData.append('id_marie', id_marie.value);
                formData.append('cv', cv.files[0]);
                formData.append('photo', image.files[0]);
                formData.append('poste', poste.value);

                // console.log(image.files[0]);

                // formData.forEach((x, i) => {
                //     console.log(x);
                // })


                xml = new XMLHttpRequest();
                // xml.responseType = 'json';
                xml.onreadystatechange = function() {
                    console.log(this.readyState, this.status);
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        var data = JSON.parse(this.responseText);
                        try{
                            var data = JSON.parse(this.responseText);
                            if(data['created']==true){
                                setTimeout(redirect,2000);

                            }
                        }
                        catch{
                            
                        }
                        if(data['error']){
                            modal.classList.remove('hide');
                        }
                        spinner.classList.remove('active');
                        submit.removeAttribute('disabled');
                    }
                }
                var url = 'includes/ajax/create_personnel.php'
                xml.open('POST', url, true);
                xml.send(formData);
            }

            submit.addEventListener('click', sendData);
            // form.onsubmit = () => {
            //     sendData();
            // }

            function redirect(){
                window.location = 'list_personnel.php';
            }
        </script>
        <script src="js/editor.js"></script>
    </div>
</body>