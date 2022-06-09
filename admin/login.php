<?php 
    require './functions/functions.php';

    if(isset($_SESSION['id'])){
        header('location: index.php');
    }

    if (isset($_POST['submit'])) {
        // code...
        $login = new Login();
        $result = $login->login($_POST['usernameemail'],$_POST['password']);
        if($result == 1){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $login->idUser();
            header('location: index.php');
            // echo "<script>alert('user not register')</script>";

        }
        elseif($result == 10){
            echo "<script>alert('password incorrect')</script>";

        }
        elseif($result == 100){
            echo "<script>alert('user not register')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            max-width: 100vw;
            height: 100vh;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #c5c1c1c7;
        }
        .div{
            /* width: 100%; */
            max-width: 500px;
            padding: 5px;
            border: 1px solid blue;
            border-radius: 4px;
        }


        form{
            padding: 10px;
        }

        form > *{
            display: block;
            margin: 5px;
            width: 100%;
        }

        input{
            padding: 5px;
            border: unset;
            border-radius: 3px;
        }
    

        form button{
            padding: 8px;
        }
        .input{
            padding: 2px;
        }

        .input >*{
            display: block;
            font-size: 1.2em;
        }

    </style>
</head>
<body>
    
    <?php 
        if(isset($_SESSION['messages'])){
            echo $_SESSION['messages'];
        }
    ?>
    <div class=".div">
    <h2 align="center">Login</h2>
    <form method="post" autocomplete="off" action="" >
        <div class="input">
        <label>Username</label>
        <input type="text" name="usernameemail" required value="">
        </div>
        <div class="input">
        <label>passwrd</label>
        <input type="text" required name="password" value="">
        </div>
        <div class="input">
        <button name="submit" type="submit">Login</button>

        </div>
    </form>
    </div>
</body>
</html>