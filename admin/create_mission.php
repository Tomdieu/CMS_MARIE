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
                <h1>Ajouter Une Mission</h1>
                <input type="hidden" id="id_marie" value="<?php echo $id_marie;?>"/>
                <div class="btn-option">
                        <input type="file"  style="display: none;" id='img-btn-input'>

                        <input class="btn-ctrl" id="color-btn" type="color"/>
                        <button class="btn-ctrl" id="bold-btn"><span class="mdi mdi-format-bold"></span></button>
                        <button class="btn-ctrl" id="underline-btn">U</button>
                        <button class="btn-ctrl" id="italic-btn">I</button>
                        <select class="" id="heading-btn">
                            <option value="">Select Heading</option>

                            <option value="h1">H1</option>
                            <option value="h2">H2</option>
                            <option value="h3">H3</option>
                            <option value="h4">H4</option>
                            <option value="h5">H5</option>
                            <option value="h6">H6</option>

                        </select>
                        <button class="btn-ctrl" id="img-btn">Img</button>
                        <button class="btn-ctrl" id="italic-btn"><span class="mdi mdi-format-align-right"></span></button>

                        <button class="btn-ctrl" id="italic-btn"><span class="mdi mdi-format-align-center"></span></button>
                        <button class="btn-ctrl" id="italic-btn"><span class="mdi mdi-format-align-justify"></span></button>
                        <button class="btn-ctrl" id="italic-btn"><span class="mdi mdi-format-align-left"></span></button>
                        
                    
                </div>
                <label for="content"> Replisser La Mission</label>
                <div id="content" contenteditable="true" spellcheck="false">
                </div>
                <div class="form-input" style="margin-left:4px">
                        <button id="submit" type="submit" name="submit">Save</button>
                    </div>
                    <div class="spinner">

                    </div>
                <div class="alert">

                </div>

                <!-- <form method="post" action="" autocomplete="off" enctype="multipart/form-data">
                    
                    <div class="form-input">
                        <label>Mission</label>
                        <textarea name="histoire" id="" cols="30" rows="20" require></textarea>
                    </div>
                    
                    <div class="form-input">
                        <button type="submit" name="submit">Save</button>
                    </div>
                    
                </form> -->
            </div>
            
        </main>
        <script>
            const boldBtn = document.querySelector('#bold-btn');
            const underlineBtn = document.querySelector('#underline-btn');
            const italicBtn = document.querySelector('#italic-btn');
            const colorBtn = document.querySelector('#color-btn');
            const headingBtn = document.querySelector('#heading-btn');
            const imageBtn = document.querySelector('#img-btn');
            const inputFile = document.querySelector('#img-btn-input');
            const spinner = document.querySelector('.spinner');

            const content = document.getElementById('content');

            const submitBtn = document.querySelector('#submit');

            submitBtn.addEventListener('click',(e)=>{
                e.preventDefault();
                let id_marie = document.getElementById('id_marie').value;
                let content = document.getElementById('content').innerHTML;
                content = content.trim();
                console.log({content,id_marie});
                
                if(content == ''){
                    alert('Please fill the content!');
                    return;
                }
                submitBtn.setAttribute('disabled',true);
                spinner.classList.add('active');

                var xml = new XMLHttpRequest();
                xml.responseType = "json";
                xml.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var data = this.response;
                        const _alert = document.querySelector('.alert');
                        spinner.classList.remove('active');

                        if(data['created'] == true){
                            submitBtn.removeAttribute('disabled');
                            document.getElementById('content').innerHTML = '';
                            _alert.innerHTML = "<h1 style='background-color:rgb(40, 255, 122);color:#fff;font-weigth:900;padding:10px'>Mission Saved Successfully!</h1>";
                            setTimeout(redirect,1000);

                            function redirect(){
                                window.location = 'mission.php';
                            }
                        }
                        else{
                            _alert.innerHTML = "<h1 style='background-color:rgb(223, 25, 25);color:#fff;font-weigth:900;padding:10px'>Mission Coulld Not Be Successfully!</h1>";

                        }
                    }
                }
                let url = 'includes/ajax/save_mission.php';
                xml.open('POST',url,true);
                xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xml.send('id_marie='+parseInt(id_marie)+'&content='+content);

            });

            imageBtn.addEventListener('click',()=>{
                inputFile.click();
            })

            boldBtn.addEventListener('click',()=>{
                document.execCommand('bold');
            });

            underlineBtn.addEventListener('click',()=>{
                document.execCommand('underline');
            });

            italicBtn.addEventListener('click',()=>{
                document.execCommand('italic');
            });

            colorBtn.addEventListener('input',()=>{
                document.execCommand('foreColor',false,colorBtn.value);
            });

            headingBtn.addEventListener('click',()=>{
                console.log(content.innerHTML);
                if(headingBtn.value!=='')
                {
                document.execCommand('formatBlock',false,headingBtn.value);

                }
            });

            inputFile.addEventListener('input',()=>{
                console.log(inputFile.value);
                document.execCommand('insertImage',false,inputFile.value);
            })

        </script>
    </div>
</body>