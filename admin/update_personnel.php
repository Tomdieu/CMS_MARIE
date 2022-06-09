<?php

include 'functions/functions.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');
} else {
    $select           = new Selection();
    $user             = $select->selectUserById($_SESSION['id']);
    $_SESSION['user'] = $user;
}

if ($_GET) {
    $id = $_GET['id'];
    $per = new Personnel();
    $personnel_data = $per->findById($id);

    $cnf = file_get_contents('./includes/conf.json');
    $cnf_data = json_decode($cnf, true);
    $website_name = $cnf_data['website']['name'];

    $marie = new Marie();
    $marie_data = $marie->getByName($website_name);
    $id_marie = $marie_data['id'];
}
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
                <h1 align="center">Modifier Les Information Du Personnel</h1>
                <div class="body">
                    <div id="status">

                    </div>
                    <input type="hidden" id="id" value="<?php echo $id; ?>">

                    <input type="hidden" id="id_marie" value="<?php echo $id_marie; ?>">
                    <div class="input">
                        <label>Nom & Prenom</label>
                        <input type="text" id="nom" value="<?php echo $personnel_data['nom']; ?>" />
                    </div>
                    <div class="input ">
                        <div class="controls" id='editor_controls'>
                        </div>
                    </div>
                    <div class="input">
                        <label>Parcours</label>
                        <div class="editor" id="parcours" contenteditable="true" spellcheck="false">
                            <?php echo $personnel_data['parcours']; ?>
                        </div>
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
                            <?php
                            foreach ($poste as $k => $v) {
                                if ($personnel_data['poste'] === $k) {
                                    echo "<option value='$k' selected=''>$v</option>";
                                } else {
                                    echo "<option value='$k' >$v</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input">
                        <label>Cv</label>
                        <input type="file" name="cv" id="cv" />
                        <?php
                        $cv = $personnel_data['cv'];
                        if ($personnel_data['cv']) {
                            echo "<span class='text-center'>Lien Du <a style='display:inline' href='../static/doc/$cv'>$cv</a></span>";
                        }
                        ?>
                    </div>
                    <div class="input">
                        <label>Photo</label>
                        <input type="file" name="image" id="image" />
                        <?php
                        $cv = $personnel_data['photo'];
                        if ($personnel_data['photo']) {
                            echo "<span class='text-center'>Lien Du <a style='display:inline' href='../static/images/$cv'>$cv</a></span>";
                        }
                        ?>
                    </div>
                    <div class="input">
                        <button class="success-btn" id='submit'>Update</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <div class="spinner"></div>

    <script src='js/editor.js'> </script>
    <script>
        var submit = document.getElementById('submit');
        var nom = document.getElementById('nom');
        var parcours = document.getElementById('parcours');
        var cv = document.getElementById('cv');
        var image = document.getElementById('image');

        var id_marie = document.getElementById('id_marie');
        var id = document.getElementById('id');
        var spinner = document.querySelector('.spinner');
        var status_ = document.querySelector('#status');
        var poste = document.querySelector("#poste");
        

        var mime_types = ['application/pdf'];

        submit.addEventListener('click', () => {

            if (nom.value.length === 0) {
                alert('PLease Enter the name of the personnel');
                return;
            }
            if (parcours.innerHTML.trim() === "<br>") {
                alert("PLease Enter The Parcours of the personnel");
                return;
            }

            // if(cv.files.length == 0){
            //     alert('Please Select A File');
            //     return;
            // }

            if (cv.files.length !== 0) {
                var file = cv.files[0];

                if (mime_types.indexOf(file.type) == -1) {
                    alert('Please Select Only A Pdf File!');
                    return;
                }



                if (file.size > 10 * 1024 * 1024) {
                    alert('PLease Select A PDF File Having Less than 10MB');
                    return;
                }
            }

            if (image.files.length !== 0) {
                var file = image.files[0];

                if (mime_types.indexOf(file.type) == -1) {
                    alert('Please Select Only A Pdf File!');
                    return;
                }



                if (file.size > 10 * 1024 * 1024) {
                    alert('PLease Select An Image File Having Less than 10MB');
                    return;
                }
            }

            submit.setAttribute('disabled', true);
            spinner.classList.add('active');
            var formData = new FormData();
            formData.append('id', id.value);
            if (cv.files.length !== 0) {
                formData.append('cv', cv.files[0]);

            }
            if (image.files.length !== 0) {
                formData.append('photo', image.files[0]);

            }
            formData.append('nom', nom.value);
            formData.append('parcours', parcours.innerHTML);
            formData.append('id_marie', id_marie.value);
            formData.append('poste',poste.value);

            console.log(formData);
            console.log(file);

            var xml = new XMLHttpRequest();
            xml.responseType = 'json';
            xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = this.response
                    // console.log(this.responseText);
                    console.log(data);
                    if (data['updated'] === true) {
                        submit.removeAttribute('disabled');
                        spinner.classList.remove('active');
                        status_.innerHTML = "Personnel Updated Successfully";
                        status_.classList.add('success');
                        setTimeout(redirect, 2000);

                        function redirect() {
                            window.location = 'list_personnel.php';
                        }
                    } else {
                        submit.removeAttribute('disabled');
                        spinner.classList.remove('active');
                        status_.innerHTML = data['error_msg'];
                        status_.classList.add('fail')

                    }
                    spinner.classList.remove('active');
                    status_.innerHTML = data['error_msg'];
                }
            }
            let url = 'includes/ajax/update_personnel.php';
            xml.open('POST', url, true);
            xml.send(formData);

        })
    </script>
</body>