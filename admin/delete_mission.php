<?php

    include 'functions/functions.php';

    if(!isset($_SESSION['id'])){
        header('location: login.php');
    }
    else {
        $select           = new Selection();
        $user             = $select->selectUserById($_SESSION['id']);
        $_SESSION['user'] = $user;
    }

    $cnf = file_get_contents('./includes/conf.json');
    $cnf_data = json_decode($cnf,true);
    $website_name = $cnf_data['website']['name'];

    $marie = new Marie();
    $marie_data = $marie->getByName($website_name);
    $id_marie = $marie_data['id'];

    $id_mission = $_GET['id'];

    include 'functions/mission.php';

    $mission  = new Mission();

    $miss = $mission->findById($id_mission)[0];

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
    <style>
        button,textarea{
            padding:8px;
            border-radius: 3px;
        }
        button:active{
            transform: scale(.97);
        }
        main{
            position: relative;
        }
        .btn-option{
            display: flex;
            flex-direction:row-reverse;

        }
        .btn-option *{
            margin-left: 3px;
            /* padding: 1.3em; */
        }
        .btn-option .btn-ctrl{
            width:50px;
            height: 100%;
            padding:1.2em;
            margin-left: 7px;
            font-weight: 800;
        }
        label{
            font-size: 1.2em;
        }
        textarea{
            font-size: 1.1em;
        }
        #content{
            padding:20px;
            background-color: #fff;
            color: #000;
            min-height: 200px;
            width: 100%;
            margin: 8px;
            border-radius: 4px 4px;
            overflow-y: scroll;
            max-height: 450px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 0 8px 0 rgba(255,255,255,.5);
        }
        #content:focus-within{
            box-shadow: 0 0 8px 2px rgb(37, 142, 240);
        }
        /* ::selection{
            background-color: inherit;
        } */
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
                <span class=""><?php echo $user['login'] ?? null;?></span>
            </div>
        </header>
        <main style="display:block;justify-content:center;align-items:center">

            <div class="add_personnel">
                <h1>Supprimer La Mission</h1>
                <input type="hidden" id="id_mission" value="<?php echo $id_mission;?>"/>
            
                <div id="content" contenteditable="false" spellcheck="false">
                    <?php echo $miss['content']; ?>
                </div>
                <div class="form-input" style="margin-left:4px">
                    <button id="deleted" type="submit" name="submit" class="btn btn-danger">Supprimer</button>
                </div>
                <div class="spinner">
                </div>
                <div class="alert">
                </div>
            </div>
            
        </main>
        <script>
            
            const spinner = document.querySelector('.spinner');

            const content = document.getElementById('content');

            const submitBtn = document.querySelector('#deleted');

            submitBtn.addEventListener('click',(e)=>{
                e.preventDefault();
                let id_mission = document.getElementById('id_mission').value;
                
              
                submitBtn.setAttribute('disabled',true);
                spinner.classList.add('active');

                var xml = new XMLHttpRequest();
                xml.responseType = "json";
                xml.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var data = this.response;
                        // console.log(this.responseText);
                        const _alert = document.querySelector('.alert');
                        spinner.classList.remove('active');

                        if(data['deleted'] == true){
                            submitBtn.removeAttribute('disabled');
                            _alert.innerHTML = "<h1 style='background-color:rgb(40, 255, 122);color:#fff;font-weigth:900;padding:10px'>Mission Deleted Successfully!</h1>";
                            setTimeout(redirect,1000);

                            function redirect(){
                                window.location = 'mission.php';
                            }
                        }
                        else{
                            _alert.innerHTML = "<h1 style='background-color:rgb(223, 25, 25);color:#fff;font-weigth:900;padding:10px'>Mission Coulld Not Be Deleted!</h1>";
                        }
                    }
                }
                let url = 'includes/ajax/delete_mission.php?id='+parseInt(id_mission);
                xml.open('GET',url,true);
                xml.send();

            });

            

        </script>
    </div>
</body>