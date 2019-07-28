<?php
class AdminPlayers extends DB{

	public $pagecheck;
	public $startfrom;

	public function AllPlayers($page){

		$DB = new DB();
		$DB->connect();
		$this->pagecheck = $DB->secret($page);

		$perpage = "16";
		$this->startfrom = ($this->pagecheck-1) * $perpage;

		$getplayers = $DB->prepare("SELECT nickname,player_picture FROM players ORDER BY nickname ASC LIMIT ?,?");
		$getplayers->bind_param("ss", $this->startfrom, $perpage);
		$getplayers->execute();
		$getplayers->store_result();

		if($getplayers->num_rows == 0){
			header("location: controllplayers.php?page=1");
		}else{

			$getplayers->bind_result($nickname,$player_picture);

			while ($getplayers->fetch()) {

				if($player_picture == ""){
                    $player_picture = "../img/avatars/noavatar.png";
                }

                echo '
                <a href="controllplayers.php?nickname='.$nickname.'">
                <div class="allplayersid">
                <img src="'.$player_picture.'" style="width: 32px; height: 32px;" />
                <span class="allnickname">'.$nickname.'</span>
                </div>
                ';

			}


		}
	}
    public $pagecheck1; 
    public function AllPlayersMeny($page){

    	$DB = new DB();
		$DB->connect(); 

		$perpage = 16;
		$this->pagecheck1 = $DB->secret($page);

		$getmeny = $DB->prepare("SELECT COUNT(id) AS total FROM players");
		$getmeny->execute();
		$getmeny->store_result();


		if($getmeny->num_rows == 0){

		}else{
			$getmeny->bind_Result($total);

			while($getmeny->fetch()){
				$total_pages = ceil($total / 16);
				
			}

			for($i=1; $i<=$total_pages; $i++){
				echo "<a href='controllplayers.php?page=$i' class='pagebtn' style='margin-left: 10px;'";
				if($i == $this->pagecheck1) echo " id='markedpage'";
				echo ">$i </a>";
			}
		}
    }

    private $nickcheck;

    public function CheckPlayer($nickname){

    	$DB = new DB();
		$DB->connect(); 

		$this->nickcheck = $DB->secret($nickname);

		$getid = $DB->prepare("SELECT * FROM players WHERE nickname = ?");
		$getid->bind_Param("s", $this->nickcheck);
		$getid->execute();
		$getid->store_result();

		if($getid->num_rows == 1){
			return 1;
		}else{
			return 0;
		}
    }

    private $nicknameid;
    public $firstname;
    public $born;
    public $playerpicture;
    public $twitter;
    public $twitch;
    public $lastname;
    public $team;
    public $nickname;
    public $standin;

    public function getAllPlayerInfo($nickname){

    	$DB = new DB();
		$DB->connect(); 

		$this->nicknameid = $DB->secret($nickname);

		$getall = $DB->prepare("SELECT * FROM players WHERE nickname = ?");
		$getall->bind_Param("s", $this->nicknameid);
		$getall->execute();
		$getall->store_result();

		if($getall->num_rows == 1){

			$getall->bind_Result($id,$steamid,$first_name,$nickname,$last_name,$age,$player_picture,$total_kills,$total_deaths,$kdratio,$krratio,$played_matches,$played_rounds,$team,$standin,$twitch_url,$twitter_url);

			while ($getall->fetch()) {

				$this->firstname = $first_name;
				$this->lastname = $last_name;
				$this->nickname = $nickname;
				$this->twitter = $twitter_url;
				$this->twitch = $twitch_url;
				$this->born = $age;
				$this->playerpicture = $player_picture;
				$this->team = $team;
				$this->standin = $standin;

			}

		}

    }
    public function getFirstName(){
    	return $this->firstname;
    }
    public function getLastname(){
		return $this->lastname;
	}
	public function getTwitter(){
		return $this->twitter;
	}
	public function getTwitch(){
		return $this->twitch;
	}
	public function getBorn(){
		return $this->born;
	}
	public function getPlayerpicture(){
		return $this->playerpicture;
	}
	public function getStandin(){
		return $this->standin;
	}
	public function getTeam(){
		return $this->team;
	}
	public function getNickname(){
		return $this->nickname;
	}


}
?>