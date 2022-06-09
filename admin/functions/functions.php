
<?php

define('ROOT_PATH',dirname(dirname(__FILE__).DIRECTORY_SEPARATOR));
define('ROOT',dirname(ROOT_PATH).DIRECTORY_SEPARATOR);
session_start();


class Connection {
	public $host     = "";
	public $user     = "";
	public $password = "";
	public $db_name  = "";

	public $con;

	public function __construct() {
		$this->__init__();
		$this->con = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);

	}

	public function __init__(){
		$conf = file_get_contents(ROOT_PATH.'/includes/conf.json');
		$content = json_decode($conf,true);
		$database = $content['database'];
		$this->db_name = $database['name'];
		$this->user = $database['user'];
		$this->password = $database['pswd'];
		$this->host = $database['host'];
	}
}

class Register extends Connection {
	public function registration($username, $email, $password, $confirmpassword) {
		$duplicates = mysqli_query($this->con, "SELECT * FROM users WHERE `login`='$username' OR email='$email'");
		if (mysqli_num_rows($duplicates) > 0) {
			return 10;
		} else {
			if ($password === $confirmpassword) {
				$query = "INSERT into users(`login`,`password`,`email`) VALUES ('$username','$password','$email')";
				var_dump($query);
				if (mysqli_query($this->con, $query)) {
					return 1;

				} else {
					var_dump(mysqli_error($this->con));
					return 0;
				}
			} else {
				return 100;
			}
		}
	}

	public function update($username,$email,$password,$id){
		$sql = "UPDATE users SET `login` = '$username', email = '$email',`password` = '$password' WHERE id = $id";
		$result = mysqli_query($this->con,$sql);
		// var_dump(mysqli_error($this->con));
		if($result){
			return 1;
		}
		else{
			return 0;
		}
	}
}

class Login extends Connection {
	public $id;
	public function login($login, $password) {
		var_dump($login,$password);
		$result = mysqli_query($this->con, "SELECT * from users WHERE `login` = '$login' OR email = '$login'");
		$row    = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
			if ($password == $row['password']) {
				$this->id = $row['id'];
				return 1;
			} else {
				return 10;
			}
		} else {
			return 100;
		}
	}
	public function idUser() {
		return $this->id;
	}

}

class Selection extends Connection {
	public function selectUserById($id) {
		$sql    = "SELECT * from users where id = $id";
		$result = mysqli_query($this->con, $sql);
		return mysqli_fetch_assoc($result);
	}
}




include 'marie.php';
include 'Personnel.php';
// include 'histoire.php';
// include 'check_website_createation.php';