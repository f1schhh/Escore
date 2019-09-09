<?php
class User{

	public $db;

	public function __construct(){

		$this->db = new DB();

	}

	private $steam_id;
	private $steam_name;
	private $steam_avatar;
	private $time_joined;
	private $ip;
	private $id;
	private $rank;


	public function LoginUser($steamid,$steamname,$steamavatar){

		$this->db->connect();	

		$this->steam_id = $this->db->secret($steamid);
		$this->steam_name = $this->db->secret($steamname);
		$this->steam_avatar = $this->db->secret($steamavatar);
		$this->time_joined = date("Y-m-d H:i");
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->username = "";
		$this->password = "";
		$this->id = null;
		$this->rank = 0;

		$IfUserAlreadyExists = $this->db->prepare("SELECT * FROM users WHERE steam_id = ?");
		$IfUserAlreadyExists->bind_Param("s", $this->steam_id);
		$IfUserAlreadyExists->execute();
		$IfUserAlreadyExists->store_result();
		if($IfUserAlreadyExists->num_rows == 1){

			$updateuserinfo = $this->db->prepare("UPDATE users SET steam_avatar = ?, steam_name = ?, last_login = ? WHERE steam_id = ?");
			$updateuserinfo->bind_Param("ssss", $this->steam_avatar,$this->steam_name,$this->time_joined,$this->steam_id);
			if($updateuserinfo->execute()){
				$_SESSION['userssession'] = $this->steam_id;
			    header("location: index.php");
			}
		}else{
			$InsertUser = $this->db->prepare("INSERT INTO users (id,steam_id,steam_name,steam_avatar,username,password,joined_date,last_login,rank,ip) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$InsertUser->bind_Param("ssssssssss", $this->id, $this->steam_id, $this->steam_name, $this->steam_avatar, $this->username, $this->password, $this->time_joined,$this->time_joined,$this->rank, $this->ip);
			if($InsertUser->execute()){
				$_SESSION['userssession'] = $this->steam_id;
				header("location: index.php");
			}else{
				echo "Fel...";
			}
		}

	}

}
?>