<?php
class Admin extends DB{


	private $user;
	private $pass;

	public function Login($username,$password){

		$DB = new DB();
		$DB->connect();

		$this->user = $DB->secret($username);
		$this->pass = $DB->secret(md5($password));

		$loginuser = $DB->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
		$loginuser->bind_Param("ss", $this->user, $this->pass);
		$loginuser->execute();
		$loginuser->store_result();

		if($loginuser->num_rows == 1){

		    $_SESSION['loginsession'] = $this->user;
		    header("location: home.php");

		}else{
			echo "<font color='red'>Fel användarnamn eller lösenord...</font>";
		}

	}

	private $loginid;

	public function CheckIfUserIsInlogged($sessionid){

		$DB = new DB();
		$DB->connect();

		$this->loginid = $DB->secret($sessionid);

		$check = $DB->prepare("SELECT * FROM users WHERE username = ?");
		$check->bind_Param("s", $this->loginid);
		$check->execute();
		$check->store_result();

		if($check->num_rows == 1){

		}else{
			header("location: ../index.php");
		}

	}

}
?>