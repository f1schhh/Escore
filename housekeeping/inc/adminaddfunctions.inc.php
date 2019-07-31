<?php
class AdminAdd extends DB{

	public $team1;
	public $team2;
	public $status;
	public $map;
	public $starttime;
	public $startdate;
	public $league;
	public $year;
	public $sharematchid;

	public function addMatches($team1,$team2,$status,$map,$starttime,$startdate,$league){

		$DB = new DB();
		$DB->connect();

		$this->team1 = $DB->secret($team1);
		$this->team2 = $DB->secret($team2);
		$this->status = $DB->secret($status);
		$this->map = $DB->secret($map);
		$this->starttime = $DB->secret($starttime);
		$this->startdate = $DB->secret($startdate);
		$this->league = $DB->secret($league);
		$this->year = date("Y");
		$matchid = rand(10000,999999);
		$score = "not started";
		$mvp = "";
		$id = null;

		$addMatch = $DB->prepare("INSERT INTO matches (id,matchid,starttime,starttdate,startyear,team1,team2,match_status,map,score,league,mvp) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
		$addMatch->bind_param("ssssssssssss", $id,$matchid,$this->starttime,$this->startdate,$this->year,$this->team1,$this->team2,$this->status,$this->map,$score,$this->league,$mvp);

		if($addMatch->execute()){

			echo "Matchen är nu tillagd!";
			$this->sharematchid = $matchid;

		}else{
			printf("Error: %s.\n", $addMatch->error);
		}

	}
	public $standinnumber = 0;
	public function addLineup_Team1(){
		$DB = new DB();
		$DB->connect();

		$id = null;

		$getmatch = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$getmatch->bind_param("s", $this->sharematchid);
		$getmatch->execute();
		$getmatch->store_result();
		if($getmatch->num_rows == 1){

			$getlineup_team1 = $DB->prepare("SELECT nickname FROM players WHERE team = ? AND standin = ? LIMIT 5");
		    $getlineup_team1->bind_param("ss", $this->team1, $this->standinnumber);
		    $getlineup_team1->execute();
		    $getlineup_team1->store_result();

		    $players = array();

		        if($getlineup_team1->num_rows == 0){

		         }else{
		         	$getlineup_team1->bind_result($nickname);

		         	while ($getlineup_team1->fetch()) {
		         		$players[] = $nickname;
		         	}

		         	$insertlineup = $DB->prepare("INSERT INTO match_lineup (id,matchid,team,player1,player2,player3,player4,player5) VALUES (?,?,?,?,?,?,?,?)");
		         	$insertlineup->bind_param("ssssssss", $id,$this->sharematchid, $this->team1, $players[0],$players[1],$players[2],$players[3],$players[4]);
		         	if($insertlineup->execute()){

		         	}else{
		         		
		         	}

		         	
		         }

		}
		
	}
	public function addLineup_Team2(){
		$DB = new DB();
		$DB->connect();

		$id = null;

		$getmatch = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$getmatch->bind_param("s", $this->sharematchid);
		$getmatch->execute();
		$getmatch->store_result();
		if($getmatch->num_rows == 1){

			$getlineup_team1 = $DB->prepare("SELECT nickname FROM players WHERE team = ? AND standin = ? LIMIT 5");
		    $getlineup_team1->bind_param("ss", $this->team2, $this->standinnumber);
		    $getlineup_team1->execute();
		    $getlineup_team1->store_result();

		    $players = array();

		        if($getlineup_team1->num_rows == 0){

		         }else{
		         	$getlineup_team1->bind_result($nickname);

		         	while ($getlineup_team1->fetch()) {
		         		$players[] = $nickname;
		         	}

		         	$insertlineup = $DB->prepare("INSERT INTO match_lineup (id,matchid,team,player1,player2,player3,player4,player5) VALUES (?,?,?,?,?,?,?,?)");
		         	$insertlineup->bind_param("ssssssss", $id,$this->sharematchid, $this->team2, $players[0],$players[1],$players[2],$players[3],$players[4]);
		         	if($insertlineup->execute()){

		         	}else{
		         		
		         	}

		         	
		         }

		}
		
	}
	public $firstname;
	public $lastname;
	public $nickname;
	public $born;
	public $team;
	public $playerpicture;
	public $twitch;
	public $twitter;
	public $standin;

	public function addUser($firstname,$lastname,$nickname,$born,$team,$playerpicture,$twitch,$twitter,$standin){

		$DB = new DB();
		$DB->connect();

		$this->firstname = $DB->secret($firstname);
		$this->lastname = $DB->secret($lastname);
		$this->nickname = $DB->secret($nickname);
		$this->born = $DB->secret($born);
		$this->team = $DB->secret($team);
		$this->playerpicture = $DB->secret($playerpicture);
		$this->twitch = $DB->secret($twitch);
		$this->twitter = $DB->secret($twitter);
		$this->standin = $DB->secret($standin);
		if($this->standin == "Ja"){
			$standinid = 1;
		}else if($this->standin == "Nej"){
			$standinid = 0;
		}
		$id = null;
		$steamid = "";
		$totalkills = "";
		$totaldeaths = "";
		$kd = "";
		$kr = "";
		$played_matches = "";
		$played_rounds = "";

		$checkUser = $DB->prepare("SELECT * FROM players WHERE nickname = ?");
		$checkUser->bind_param("s", $this->nickname);
		$checkUser->execute();
		$checkUser->store_result();

		if($checkUser->num_rows == 1){
			echo "Spelaren finns redan tillagd...";
		}else{

			$addUser = $DB->prepare("INSERT INTO players (id,steamid,first_name,nickname,last_name,age,player_picture,total_kills,total_deaths,kdratio,krratio,played_matches,played_rounds,team,standin,twitch_url,twitter_url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		    $addUser->bind_param("sssssssssssssssss", $id,$steamid,$this->firstname,$this->nickname,$this->lastname,$this->born, $this->playerpicture,$totalkills,$totaldeaths,$kd,$kr,$played_matches,$played_rounds,$this->team,$standinid,$this->twitch,$this->twitter);
		    if($addUser->execute()){

			 echo "Spelaren är nu tillagd!";

		    }else{
			printf("Error: %s.\n", $addUser->error);
		    }

		}

		

	}
	public $teamname;
	public $fullteamname;
	public $teamlogo;
	public function addTeam($teamname,$fullteamname,$teamlogo){

		$DB = new DB();
		$DB->connect();

		$this->teamname = $DB->secret($teamname);
		$this->fullteamname = $DB->secret($fullteamname);
		$this->teamlogo = $DB->secret($teamlogo);
		$nothing = "";
		$id = null;

		$checkteam = $DB->prepare("SELECT * FROM teams WHERE teamname = ?");
		$checkteam->bind_param("s", $this->teamname);
		$checkteam->execute();
		$checkteam->store_result();

		if($checkteam->num_rows == 1){
			echo "Laget finns redan tillagt...";
		}else{

			$addTeam = $DB->prepare("INSERT INTO teams (id,teamname,teamlogo,fullteamname,played,wins,loses) VALUES (?,?,?,?,?,?,?)");
		    $addTeam->bind_param("sssssss", $id, $this->teamname, $this->teamlogo, $this->fullteamname,$nothing,$nothing,$nothing);

		if($addTeam->execute()){

			echo "Laget är nu tillagt!";

		}else{
			printf("Error: %s.\n", $addTeam->error);
		}

		}

	}

	public $matchidet;
	public $rounds;
	public function CheckMatchId($matchid){

		$DB = new DB();
		$DB->connect();

		$this->matchidet = $DB->secret($matchid);
		$matchstatus = "ended";


		$checkid = $DB->prepare("SELECT score FROM matches WHERE matchid = ? AND match_status = ?");
		$checkid->bind_param("ss", $this->matchidet, $matchstatus);
		$checkid->execute();
		$checkid->store_result();

		if($checkid->num_rows == 1){

			$checkid->bind_result($score);

			while($checkid->fetch()){

				$matches = array_map('intval', explode('-', $score));

                if($score == "not started"){
                	$matchscore = "";
                }else{
                	$this->rounds = $matches[0] + $matches[1];
                }
                return 1; 
			}
		}else{
			return 0;
		} 
	}

}
?>