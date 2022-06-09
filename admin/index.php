<?php

include './functions/functions.php';

if (!isset($_SESSION['id'])) {
	header('location: login.php');
} else {
	$select           = new Selection();
	$user             = $select->selectUserById($_SESSION['id']);
	$_SESSION['user'] = $user;
}

?>
<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Admin</title>
	 <?php include 'head.php' ?>
 </head>
 <body>
	<?php
		$content = file_get_contents('includes/conf.json');
		$json = json_decode($content,true);
		if($json['already_created']==false && $json['user_register']==true){
		echo '<link href="css/style.css" rel="stylesheet">';
		include 'includes/pages/marie.php';
		}
		elseif($json['already_created']==false && $json['user_register']==false){

			echo '<link href="css/style.css" rel="stylesheet">';
			header('location: register.php');
		}elseif($json['user_register']==true && $json['already_created']===true)
		{
			header('location: dashboard.php');
		}
	?>
 </body>
 </html>