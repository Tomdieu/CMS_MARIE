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
$marie_data = $marie->getInfo($id_marie);
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
    <style>
        .a {
            padding: 8px;
            border-radius: 3px;
            text-decoration: none;
            background-color: #ddd;
        }

        .a:active {
            transform: scale(.97);
        }

        main div {
            margin: 3px;
            margin-bottom: 5px;
        }

        .main {
            width: 100%;
            display: flex;
            /* flex-wrap:wrap; */
        }

        .left,
        .right {
            width: 50%;
            background-color: rgb(10, 27, 59);
            box-shadow: 0 0 2px #fff;
        }

        .right {
            background-color: rgb(45, 141, 250);
        }

        .input {
            padding: 10px;
        }

        .input>* {
            display: block;
            width: 100%;
            font-weight: 700;
        }

        .input input,
        .input button {
            font-size: 1.2em;
            padding: 8px;
        }

        .input button {
            border-radius: 3px;
        }

        .input button:active {
            transform: scale(.98);
        }

        .bg-success {
            background-color: #fff;
            box-shadow: 0 0 0 2px rgb(66, 126, 66);
            color: rgb(66, 126, 66);
            transition: all 0s ease;
        }

        .bg-success:hover {
            background-color: rgb(66, 126, 66);
            color: #fff;
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px rgb(66, 126, 66);
        }

        #logoutbtn {
            padding: 5px;
            border-radius: 2px;
            background-color: beige;
            cursor: pointer;
        }

        #logoutbtn span {
            font-size: 1.1em;
        }

        #logoutbtn:active {
            transform: rotate(3turn) scale(.4);
        }

        @media screen and (max-width:700px) {
            .main {
                flex-direction: column;
            }

            .main>* {
                width: 100%;
            }
        }

        main {
            position: relative;
            overflow-x: unset;
        }

        .modal {
            position: absolute;
            /* width: 100%; */
            height: 100%;
            top: 0;
            right: 0;
            left: 0;
            background-color: rgba(25, 26, 25, 0.842);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal_content {
            max-width: 600px;
            box-shadow: 0 0 0 3px #fff;
            background-color: #fff;
            border-radius: 3px;
        }

        .modal_content input {
            /* font-size: 1em; */
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .modal_content input {
            color: black;
        }

        .modal.hide {
            display: none;
        }

        .zoom {
            animation: zoom .7s ease;
        }

        @keyframes zoom {
            from {
                transform: scale(0);
            }

            to {
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
        <main>
            <div style="margin: 5px;display: flex;justify-content: space-between;">
                <h1>Settings</h1>
                <button id="logoutbtn" onclick="logout();"><span class="bi bi-box-arrow-left"></span> Logout</button>
            </div>


            <div class="main">
                <div class="left">
                    <div class="input">
                        <label>
                            Nom
                        </label>
                        <input type="text" value="<?php echo $marie_data['nom'] ?>" disabled />
                    </div>
                    <div class="input">
                        <label>
                            Region
                        </label>
                        <input type="text" value="<?php echo $marie_data['region'] ?>" disabled />
                    </div>
                    <div class="input">
                        <label>
                            Departement
                        </label>
                        <input type="text" value="<?php echo $marie_data['departement'] ?>" disabled />
                    </div>
                    <div class="input">
                        <label>
                            Arrondissement
                        </label>
                        <input type="text" value="<?php echo $marie_data['arrondissement'] ?>" disabled />
                    </div>
                </div>
                <div class="right">
                    <input type="hidden" value="<?php echo $user['id'] ?>" id="id" />
                    <div class="input">
                        <label for="nom">Username</label>
                        <input type="text" name="" value="<?php echo $user['login'] ?>" id="">
                    </div>
                    <div class="input">
                        <label for="nom">Email</label>
                        <input type="email" name="" value="<?php echo $user['email'] ?>" id="">
                    </div>
                    <div class="input">
                        <label for="nom">Password</label>
                        <input type="password" name="" value="<?php echo $user['password'] ?>" id="">
                    </div>
                    <div class="input">
                        <button id="updated" class="bg-success">Update</button>
                    </div>
                </div>

            </div>
            <div class="modal hide">
                <div class="modal_content zoom">
                    <div class="input">
                        <label for="nom">Username</label>
                        <input type="text" id="username" placeholder="username" value="<?php echo $user['login'] ?>" id="">
                    </div>
                    <div class="input">
                        <label for="nom">Email</label>
                        <input type="email" id="email" placeholder="email" value="<?php echo $user['email'] ?>" id="">
                    </div>
                    <div class="input">
                        <label for="nom">Password</label>
                        <input type="password" id="password" value="<?php echo $user['password'] ?>" id="">
                    </div>
                    <div class="input">
                        <button id="update" class="bg-success">Update</button>
                    </div>
                </div>
            </div>
            <div class="spinner"></div>

            <script>

                function logout(){
                    window.location = 'logout.php';
                }

                var modal = document.querySelector('.modal');
                var btnUpdate = document.querySelector('#updated');
                var update = document.querySelector("#update");

                var login = document.querySelector("#username");
                var email = document.querySelector("#email");
                var password = document.querySelector("#password");

                var spinner = document.querySelector(".spinner");
                var id = document.querySelector('#id');

                btnUpdate.addEventListener('click', function() {
                    modal.classList.remove('hide');
                });


                update.addEventListener('click', () => {
                    if(id.value.length === 0){
                        alert("An error Occur!")
                        return;
                    }
                    if (login.value.length === 0) {
                        alert("Please enter your username");
                        return;
                    }
                    if (email.value.length === 0) {
                        alert("Please enter your email");
                        return;
                    }
                    if (password.value.length === 0) {
                        alert("Please enter your password");
                        return;
                    }
                    update.setAttribute('disabled', true);
                    spinner.classList.add("active");

                    var formData = new FormData();
                    formData.append('id', id.value);
                    formData.append('username', login.value);
                    formData.append('email', email.value);
                    formData.append('password', password.value);

                    xhr = new XMLHttpRequest();
                    xhr.responseType = 'json'
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = this.response;
                            // console.log(this.reponseText);
                            update.removeAttribute('disabled');
                            spinner.classList.remove("active");

                            console.log(data);
                            if (data['updated'] === true) {
                                setTimeout(reload, 2000);
                            }
                            else{
                                setTimeout(reload, 2000);
                                alert("Something when wrong");
                            }
                        }
                    }
                    var url = 'includes/ajax/update_user.php';
                    xhr.open('POST', url, true);
                    xhr.send(formData);
                })

                function reload(){
                    window.location  = 'settings.php';
                }
            </script>
        </main>
    </div>
</body>