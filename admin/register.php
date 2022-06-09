<?php

    require './functions/functions.php';


    $register = new Register();

    if(isset($_POST['submit'])){
        $result = $register->registration($_POST['username'],$_POST['email'],$_POST['password'],$_POST['confirmpassword']);
        if($result == 1){
            $_SESSION['messages'] = 'Registration Successful Login';
            $_SESSION['project_created'] = true;
            $message = "";
            include 'includes/data/update_config.php';
            $data = readCnf();
            $data['user_register'] = true;
            updateCnf($data);
            echo "registratin successfull";
            header('location: login.php');
        }
        elseif($result == 10){
            $message = "";
            echo "username or email exits";
        }
        elseif($result == 100){
            $message = "";

            echo "password dont match";

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body{
            padding:0;
            margin:0;
        }
        main{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .center{
            padding: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 0 3px 4px #ddd;
            max-width: 600px;
        }
        .input{
            width: 100%;
            margin:2px;
        }
        .input >*{
            font-size: 1.2em;
            display: block;
            width: 100%;
        }

        input{
            border: none;
            outline: none;
            border-bottom: .5px solid #ddd;
            padding: 5px 3px 7px 5px;
            caret-color: rgb(18, 149, 236);
        }

        form{
            padding: 6px;
        }

        h1,a{
            text-align: center;
            text-decoration: none;
        }

        a:hover{
            color: rgb(9, 125, 192);
        }
        button{
            border: none;
            padding: 8px;
            background-color: rgba(16, 146, 221, 0.884);
            color: #fff;
            border-radius: 3px;
        }
        button:hover{
            box-shadow: 0 0 0 4px rgba(14, 148, 226, 0.925),0 0 0 1px #fff;
        }
        button:active{
            transform: scale(.98);
        }
    </style>
</head>
<body>
    <main>
        <div class="center">
            <h1>Create Account</h1>
        <form class="" action="" method="post" autocomplete="off">
            <div class="input">
                <label for="">username</label>
            <input type="text" name="username" placeholder="username "/>
            </div>
            <div class="input">

            <label for="">Email</label>
            <input type="email" name="email" placeholder="email "/>
            </div>
            <div class="input">

            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password "/>
            </div>
            <div class="input">

                <label for="">Password</label>
                <input type="password" name="confirmpassword" placeholder="Password "/>
                </div>

            
            <div class="input">
                
            <button type="submit" name="submit">Register</button>
            </div>
            <a style="display: block;" href="login.php">login</a>

            
        </div>
        </form>
        </div>
    </main>
</body>
</html>