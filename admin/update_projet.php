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

if (isset($_GET['id'])) {
    $id_projet = $_GET['id'];
    include 'functions/Projet.php';
    $pj = new Projets();
    $project_data = $pj->findById($id_projet);
    if (empty($project_data)) {
        header('location: list_projet.php');
    }
    // var_dump($project_data);
} else {
    header('location: list_projet.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Ajouter Mission</title>
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

        button:active {
            transform: scale(.97);
        }

        main {
            position: relative;
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
        <main style="display:block;justify-content:center;align-items:center">

            <div class="add_personnel">
                <h1>Ajouter Un Projet</h1>
                <div id="status"></div>
                <input type="hidden" id="project_id" value="<?php echo $id_projet ?>" />
                <input type="hidden" id="id_marie" value="<?php echo $id_marie; ?>" />
                <div class="input">
                    <label>Nom</label>
                    <input type="text" id="nom" value="<?php echo $project_data['nom'] ?? ''; ?>" />
                </div>
                <div class="input ">
                    <div class="controls" id='editor_controls'>
                    </div>
                </div>
                <div class="input">
                    <label for="content"> Replisser La Projet</label>
                    <div id="content" class="editor" contenteditable="true" spellcheck="false"><?php echo $project_data['content'] ?? ''; ?></div>
                </div>
                <div class="input">
                    <label>Image Du Projet</label>
                    <input type="file" id="image" accept="image/png,image/jpeg" />
                    <?php
                    if (isset($id_projet)) {
                        $img = $project_data['image'];
                        echo "
                                <span class='text-center'>Anncien Image <a href='../static/images/$img'>$img</a></span>
                            ";
                    }
                    ?>
                </div>
                <div class="form-input" style="margin-left:4px">
                    <button id="submit" type="submit" name="submit">
                        Update</button>
                </div>
                <div class="spinner">

                </div>
                <div class="alert">
                </div>


            </div>

        </main>
        <script src="js/editor.js"></script>
        <script>
            var submit = document.querySelector('#submit');
            var nom = document.querySelector('#nom');
            var content = document.querySelector('#content');
            var image = document.querySelector('#image');
            var id_marie = document.querySelector('#id_marie');
            var status_ = document.querySelector('#status');
            var spinner = document.querySelector('.spinner');
            var project_id = document.querySelector('#project_id');

            submit.addEventListener('click', () => {
                if (nom.value.length == 0) {
                    alert('Please Enter The Name of the project')
                    return;
                }

                if (content.innerHTML == '<br>' || content.innerHTML == '' || content.innerHTML.length == 0) {
                    alert('PLease Enter The content of the project');
                    return;
                }
                // if (project_id) {

                //     if (image.files.length == 0) {
                //         alert('please the image of the project is required!');
                //         return;
                //     }
                // }

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
                formData.append('id_marie', id_marie.value);
                formData.append('content', content.innerHTML);

                if (image.files.length !== 0) {
                    formData.append('image', image.files[0]);

                }


                formData.append('project_id', project_id.value);


                var xml = new XMLHttpRequest();
                xml.responseType = "json";
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = this.response;
                        // console.log(data);
                        // console.log(this.responseText);

                        if (data['updated'] == true) {
                            spinner.classList.remove('active');
                            status_.classList.add('success');

                            status_.innerHTML = 'Projet Update Successfully';

                            setTimeout(redirect, 1000);

                            function redirect() {
                                window.location = 'list_projet.php';
                            }
                        } else {
                            spinner.classList.remove('active');
                            status_.classList.add('fail');

                            status_.innerHTML = 'Projet Could Not Be Updated';


                        }
                        submit.removeAttribute('disabled');



                    }
                }
                var url;

                url = 'includes/ajax/update_project.php';


                xml.open('POST', url, true);
                xml.send(formData);


            });
        </script>

    </div>
</body>