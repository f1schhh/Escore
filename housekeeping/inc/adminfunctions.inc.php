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
	public $site_msg;
	public $msg_status;

	public function CheckSiteMsg(){

		$DB = new DB();
		$DB->connect();

		$sitemsg = $DB->prepare("SELECT * FROM site_message LIMIT 1");
		$sitemsg->execute();
		$sitemsg->store_result();

	    if($sitemsg->num_rows == 0){
	    	echo "Fel...";
	    }else{
	    	$sitemsg->bind_result($id,$site_message,$status);

	    	while ($sitemsg->fetch()) {

	    		$this->site_msg = $site_message;
	    		$this->msg_status = $status;
	    	}
	    }

	}

	public function getSiteMsg(){
		return $this->site_msg;
	}
	public function getSiteStatus(){
		return $this->msg_status;
	}
	private $msg_s;
	public function UpdateSiteMsg($msg,$site_status){
		$DB = new DB();
		$DB->connect();

		$this->msg_s = $DB->secret($msg);

		$updatemsg = $DB->prepare("UPDATE site_message SET site_message = ?, status = ?");
		$updatemsg->bind_Param("ss",$this->msg_s,$site_status);
		
		if($updatemsg->execute()){
			echo "<font color='green'>Site meddelandet är nu uppdaterat! </font> ";
		}

	}

}
?>