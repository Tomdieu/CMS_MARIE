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
                <h1>Ajouter Un Lieux Touristique</h1>
                <div id="status"></div>
                <input type="hidden" id="activity_id" value="" />
                <input type="hidden" id="id_marie" value="<?php echo $id_marie; ?>" />
                <div class="input">
                    <label>Nom du lieux touristique</label>
                    <input type="text" id="nom" value="" />
                </div>
                
                <div class="input ">
                    <div class="controls" id='editor_controls'>
                    </div>
                </div>
                <div class="input">
                    <label for="content"> Replisser Le Detail du lieux touristique</label>
                    <div id="content" class="editor" contenteditable="true" spellcheck="false"></div>
                </div>
                <div class="input">
                    <label>Image Du Lieux tourisque</label>
                    <input type="file" id="image" accept="image/png,image/jpeg" />

                </div>
                <div class="form-input" style="margin-left:4px">
                    <button id="submit" type="submit" name="submit">Save</button>
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

            submit.addEventListener('click', () => {
                if (nom.value.length == 0) {
                    alert('Please Enter The Name of the project')
                    return;
                }


                if (content.innerHTML == '<br>' || content.innerHTML == '' || content.innerHTML.length == 0) {
                    alert('PLease Enter The content of the project');
                    return;
                }

                if(image.files.length == 0){
                    alert("Please the image of the touristique site!");
                    return;
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
                formData.append('id_marie', id_marie.value);
                formData.append('content', content.innerHTML);
                formData.append('image', image.files[0]);


                var xml = new XMLHttpRequest();
                xml.responseType = "json";
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = this.response;
                        // console.log(this.response)
                        // console.log(this.responseText);

                        if (data['created'] == true) {
                            spinner.classList.remove('active');
                            status_.classList.add('success');

                            status_.innerHTML = 'Lieux Touristique Save Successfully';

                            setTimeout(redirect, 1000);

                            function redirect() {
                                window.location = 'list_lieux_touristique.php';
                            }
                        } else {
                            spinner.classList.remove('active');

                        }
                        submit.removeAttribute('disabled');
                        status_.classList.add('fail');

                    }
                }
                var url;
                url = 'includes/ajax/create_touristique_site.php';

                xml.open('POST', url, true);
                xml.send(formData);


            });
        </script>

    </div>
</body>