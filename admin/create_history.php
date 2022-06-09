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

    include 'functions/histoire.php';

    $hist = new Histoire();
    if($hist->count() > 0){
        header('location: histoire.php');
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
    <link href="css/editor.css" rel="stylesheet">
    <link href="icons/css/materialdesignicons.min.css" rel="stylesheet" />


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

        .btn-option {
            display: flex;
            flex-direction: row-reverse;

        }

        .btn-option button {
            margin-left: 3px;
            padding: 1.3em;
        }

        label {
            font-size: 1.2em;
        }

        textarea {
            font-size: 1.1em;
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
                <h1>Ajouter Une Histoire</h1>
                <input type="hidden" id="id_marie" value="<?php echo $id_marie; ?>">
                <div class="input ">
                    <div class="controls" id='editor_controls'>
                    </div>
                </div>
                <div class="form-input">
                    <label>Histoire</label>
                    <div class="editor" id="histiore" contenteditable="true" spellcheck="false"></div>
                </div>

                <div class="form-input">
                    <button type="submit" id="submit">Save</button>
                </div>
                <div id="status"></div>
                <div class="spinner"></div>

            </div>
            <script src='js/editor.js'> </script>
            <script>
                var id_marie = document.querySelector('#id_marie');
                var histiore = document.querySelector('#histiore');

                var submitBtn = document.querySelector('#submit');
                var spinner = document.querySelector('.spinner');
                var status_ = document.querySelector('#status');

                submitBtn.addEventListener('click',()=>{
                    if(histiore.innerHTML.length == 0 || histiore.innerHTML.trim().length == 0 || histiore.innerHTML =='<br>'){
                       alert('please enter the content of the history');
                       return;
                    }
                    spinner.classList.add('active');
                    let url = 'includes/ajax/create_history.php';
                    var formData = new FormData();
                    formData.append('content',histiore.innerHTML);
                    formData.append('id_marie',id_marie.value);

                    var xml = new XMLHttpRequest();
                    xml.responseType ='json'
                    xml.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){
                            spinner.classList.remove('active');
                            // console.log(this.responseText)
                            var data = this.response;
                            console.log(data);
                            if(data['created'] == true){
                                status_.classList.add('success')
                                status_.innerHTML = 'Could Not Save the history of the marie';
                                setTimeout(redirect,2000);

                                function redirect(){
                                    document.location = 'histoty.php';
                                }
                            }else{
                                status_.classList.add('fail');
                                status_.innerHTML = 'Could Not Save the history of the marie';
                            }
                            function redirect(){
                                    document.location = 'histoty.php';
                                }
                        }
                    }

                    xml.open('POST',url,true);
                    xml.send(formData);
                });

            </script>

        </main>
    </div>
</body>