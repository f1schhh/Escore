<?php
class Admin extends DB{


	private $user;
	private $pass;

	public function Login($username,$password){

		$DB = new DB();
		$DB->connect();

		$this->user = $DB->secret($username);
		$this->pass = $DB->secret(sha1($password));
		$rankfix = 1;

		$loginuser = $DB->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND rank >= ? ");
		$loginuser->bind_Param("sss", $this->user, $this->pass, $rankfix);
		$loginuser->execute();
		$loginuser->store_result();

		if($loginuser->num_rows == 1){

		    $_SESSION['loginsession'] = $this->user;
		    header("location: home.php");

		}else{
			echo "<font color='red'>Fel användarnamn eller lösenord...</font>";
		}

	}

	public $loginid;

	public function CheckIfUserIsInlogged($sessionid){

		$DB = new DB();
		$DB->connect();

		$this->loginid = $DB->secret($sessionid);
		$rank = 2;
		
			$check = $DB->prepare("SELECT * FROM users WHERE username = ?");
		    $check->bind_Param("s", $this->loginid);
		    $check->execute();
		    $check->store_result();

		    if($check->num_rows == 1){
			
		    }else{
			header("location: ../index.php");
		    }

		$check = $DB->prepare("SELECT * FROM users WHERE username = ?");
		$check->bind_Param("s", $this->loginid);
		$check->execute();
		$check->store_result();

		if($check->num_rows == 1){
			
		}else{
			header("location: ../index.php");
		}

	}
	private $loginif;
	public function IfalreadyInlogged($sessionid){
		$DB = new DB();
		$DB->connect();

		$this->loginif = $DB->secret($sessionid);

		$check = $DB->prepare("SELECT * FROM users WHERE username = ?");
		$check->bind_Param("s", $this->loginif);
		$check->execute();
		$check->store_result();

		if($check->num_rows == 1){
			header("location: home.php");
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
	private $updatematchid;
	private $updatescore;

	public function UpdateMatchScore($matchid,$score){
		$DB = new DB();
		$DB->connect();

		$this->updatematchid = $DB->secret($matchid);
		$this->updatescore = $DB->secret($score);
		$matchstatus = "live";

		$checkmatchid = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$checkmatchid->bind_Param("s", $this->updatematchid);
		$checkmatchid->execute();
		$checkmatchid->store_result();

		if($checkmatchid->num_rows == 1){
			$updatescorefunc = $DB->prepare("UPDATE matches SET score = ?, match_status = ? WHERE matchid = ? ");
			$updatescorefunc->bind_Param("sss", $this->updatescore, $matchstatus, $this->updatematchid);
			if ($updatescorefunc->execute()) {
				echo '<br /><font color="green">Score är nu uppdaterat!</font>';
			}

		}
	}

}
?>