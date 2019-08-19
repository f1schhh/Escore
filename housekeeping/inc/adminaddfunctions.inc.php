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
		$totalkills = "0";
		$totaldeaths = "0";
		$kd = "";
		$kr = "";
		$played_matches = "0";
		$played_rounds = "0";

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
	private $statsnick;
	public $total_kills;
	public $total_deaths;
	public $kdr;
	public $kr;
	public $played_m;
	public $played_r;

	public function getPlayerStats($nickname1){

		$DB = new DB();
		$DB->connect();
		$this->statsnick = $DB->secret($nickname1);


		$getstats = $DB->prepare("SELECT total_kills,total_deaths,kdratio,krratio,played_matches,played_rounds FROM players WHERE nickname = ?");
		$getstats->bind_param("s", $this->statsnick);
		$getstats->execute();
		$getstats->store_result();

		if($getstats->num_rows == 1){

			$getstats->bind_result($total_kills,$total_deaths,$kdratio,$krratio,$played_matches,$played_rounds);

			while ($getstats->fetch()) {

				$this->total_kills = $total_kills;
				$this->total_deaths = $total_deaths;
				$this->kdr = $kdratio;
				$this->kr = $krratio;
				$this->played_m = $played_matches;
				$this->played_r = $played_rounds;

				return 1;
			}

		}else{
			return 0;
		}

	}
	public $matchid;
	public $nickname_stats;
	public $kills;
	public $deaths;
	public $team_stats;
	public function addGamePlayerStats($matchid,$nickname,$kills,$deaths,$team){
		$DB = new DB();
		$DB->connect();
		$this->matchid = $DB->secret($matchid);
		$this->nickname_stats = $DB->secret($nickname);
		$this->kills = $DB->secret($kills);
		$this->deaths = $DB->secret($deaths);
		$this->team_stats = $DB->secret($team);
		$id = null;

		$checkstats = $DB->prepare("SELECT * FROM match_stats WHERE matchid = ? AND playername = ?");
		$checkstats->bind_param("ss", $this->matchid, $this->nickname_stats);
		$checkstats->execute();
		$checkstats->store_result();

		if($checkstats->num_rows == 1){
			echo 'Fel';
		}else{

			$checkplayer = $DB->prepare("SELECT * FROM players WHERE nickname = ?");
			$checkplayer->bind_param("s", $this->nickname_stats);
			$checkplayer->execute();
			$checkplayer->store_result();

			if($checkplayer->num_rows == 1){

				$newkills = $this->total_kills + $this->kills;
				$newdeaths = $this->total_deaths + $this->deaths;
				$newkd = $newkills / $newdeaths;
				$newrealkd = round($newkd, 2);
				$newplayedrounds = $this->played_r + $this->rounds;
				$newkr = $newkills / $newplayedrounds;
				$newrealkr = round($newkr, 2);
				$newplayedmatches = $this->played_m + 1;
				$newaveragekills = round($newkills / $newplayedmatches);
				$newaveragedeaths = round($newdeaths / $newplayedmatches);


				$addStatsPlayer = $DB->prepare("UPDATE players SET total_kills = ?, total_deaths = ?, kdratio = ?, krratio = ?, average_kills = ?, average_deaths = ?, played_matches = ?, played_rounds = ? WHERE nickname = ?");
				$addStatsPlayer->bind_param("sssssssss", $newkills,$newdeaths,$newrealkd,$newrealkr,$newaveragekills, $newaveragedeaths,$newplayedmatches,$newplayedrounds,$this->nickname_stats);

				if($addStatsPlayer->execute()){
					$addStatsMatch = $DB->prepare("INSERT INTO match_stats (id,matchid,playername,kills,deaths,teamname) VALUES (?,?,?,?,?,?)");
					$addStatsMatch->bind_param("ssssss", $id,$this->matchid,$this->nickname_stats,$this->kills,$this->deaths,$this->team_stats);

					if($addStatsMatch->execute()){
						
					}
				}

			}else{
		    $steamid = "";
		    $first = "-";
		    $last = "-";
		    $age = "";
		    $playerp = "";
		    $getkd = $this->kills / $this->deaths;
		    $realkd = round($getkd, 2);
		    $getkr = $this->kills / $this->rounds;
		    $realkr = round($getkr, 2);
		    $playedm = 1;
		    $stand = 1;
		    $twitch = "";
		    $twitter = "";

			$addplayer = $DB->prepare("INSERT INTO players (id,steamid,first_name,nickname,last_name,age,player_picture,total_kills,total_deaths,kdratio,krratio,average_kills,average_deaths,played_matches,played_rounds,team,standin,twitch_url,twitter_url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$addplayer->bind_param("sssssssssssssssssss", $id, $steamid, $first, $this->nickname_stats, $last, $age, $playerp, $this->kills, $this->deaths, $realkd, $realkr, $this->kills, $this->deaths, $playedm, $this->rounds, $this->team_stats, $stand, $twitch, $twitter);

			if($addplayer->execute()){

					$addStatsMatch = $DB->prepare("INSERT INTO match_stats (id,matchid,playername,kills,deaths,teamname) VALUES (?,?,?,?,?,?)");
					$addStatsMatch->bind_param("ssssss", $id,$this->matchid,$this->nickname_stats,$this->kills,$this->deaths,$this->team_stats);

					if($addStatsMatch->execute()){
						
					}

		}
	}
}
}

}
?>