<?php

class Teams extends DB{

	private $team1;
	public $fullteamname;
	public $teamlogo;
	public $teamname;

	public function showTeamName($team){
		$DB = new DB();
		$DB->connect();
		$this->team1 = $DB->secret($team);

		$getTeamInfo = $DB->prepare("SELECT teamname,teamlogo,fullteamname FROM teams WHERE teamname = ? OR fullteamname = ?");
		$getTeamInfo->bind_Param("ss", $this->team1, $this->team1);
		$getTeamInfo->execute();
		$getTeamInfo->store_result();

		if($getTeamInfo->num_rows == 1){

			$getTeamInfo->bind_result($teamname,$teamlogo,$fullteamname);

			while ($getTeamInfo->fetch()) {

				$this->teamname = $teamname;
				$this->fullteamname = $fullteamname;

				if($teamlogo == ""){
					$teamlogo = "http://localhost/svtv/img/teamicons/nologo.png";
				}
				
				$this->teamlogo = $teamlogo;

			}
		}else{
			header("location: ../index.php");
		}
	}

	public function getFullTeamName(){
		return $this->fullteamname;
	}
	public function getTeamLogo(){
		return $this->teamlogo;
	}
	public function getTeamName(){
		return $this->teamname;
	}

	private $playerteam;
	private $standinid;

	public function getPlayersOfTeam($team){

		$DB = new DB();
		$DB->connect();

		$this->playerteam = $DB->secret($team);
		$this->standinid = 0;

		$getPlayers = $DB->prepare("SELECT nickname,player_picture,team,standin FROM players WHERE team = ? AND standin = ? LIMIT 5");
		$getPlayers->bind_Param("ss", $this->playerteam, $this->standinid);
		$getPlayers->execute();
		$getPlayers->store_result();

		if($getPlayers->num_rows == 0){

			echo ''.$team.' lineup har vi ingen information om...';

		}else{
			$getPlayers->bind_result($nickname,$player_picture,$team,$standin);

			while ($getPlayers->fetch()) {
				if($player_picture == ""){
                   $player_picture = "../img/avatars/noavatar.png";
                }

				echo '
				 <a href="../players/'.$nickname.'">				
				 <div class="playerbox">
                 <div class="playerimg">
                    <img src="'.$player_picture.'" style="max-width: 100%; max-height: 100%; border-top-right-radius: 5px; border-top-left-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;" />
                    <center class="teamname">'.$nickname.'</center>
                 </div>
                 </div> 
                 </a>
                 

				';

			}
		}
	}

	private $teamid;
	private $mstatus;

	public function getMatchesOfTeam($team){

		$DB = new DB();
		$DB->connect();

		$this->teamid = $DB->secret($team);
		$this->mstatus = "ended";

		$getmatches = $DB->prepare("SELECT * FROM matches WHERE team1 = ? AND match_status = ? OR team2 = ? AND match_status = ? ORDER BY id DESC");
		$getmatches->bind_Param("ssss", $this->teamid, $this->mstatus,$this->teamid, $this->mstatus);
		$getmatches->execute();
		$getmatches->store_result();

		if($getmatches->num_rows == 0){
			echo '
			<div class="upcomingmatches">
           <span class="upcomingmatchestext">'.$this->teamid.' har inga tidigare matcher spelade...</span>
          </div>  
          
        </div>  
			';
		}else{
			$getmatches->bind_result($id,$matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$map,$score,$league,$stream,$mvp);

			while($getmatches->fetch()){


                $matches = array_map('intval', explode('-', $score));

                if($score == "not started"){
                	$matchscore = "";
                }else{

                if($matches[0] == $matches[1]){

                }else{

                if($matches[0]>$matches[1]){
                	$matches[0] = '<font color="green">'.$matches[0].' </font>';
                	$matches[1] = '<font color="red">'.$matches[1].' </font>';
                }else{

                	$matches[1] = '<font color="green">'.$matches[1].' </font>';
                	$matches[0] = '<font color="red">'.$matches[0].' </font>';
                }
                }

                $matchscore = "$matches[0] - $matches[1]";

                }
                    
                    $fixdate = strftime("%e %B", strtotime($starttdate));

                    $realtime = strtotime($starttime);
                    $fixtime = date("H:i", $realtime);

                    $status = "$fixdate $fixtime";
				

				echo '
				<a href="../matches/'.$matchid.'">
				<div class="matchtitle">
                <span class="matchTitlefix">
                  <span class="startTime">'.$status.' </span> 
                  <img src="'.getTeamLogo($team1).'" class="leftteamicon" />
                  '.$team1.' VS  '.$team2.' 
                 <img src="'.getTeamLogo($team2).'" class="rightteamicon" />

                 <span class="activeScore">'.$matchscore.'</span>
             </div></a>
				';

			}
		}

	}

	public function TeamLogo($team){
		$DB = new DB();
		$DB->connect();
		$this->team1 = $DB->secret($team);

		$getTeamInfo = $DB->prepare("SELECT teamlogo FROM teams WHERE teamname = ? OR fullteamname = ?");
		$getTeamInfo->bind_Param("ss", $this->team1, $this->team1);
		$getTeamInfo->execute();
		$getTeamInfo->store_result();

		if($getTeamInfo->num_rows == 1){

			$getTeamInfo->bind_result($teamlogo);

			while ($getTeamInfo->fetch()) {

				if($teamlogo == ""){
					$teamlogo = "http://localhost/svtv/img/teamicons/nologo.png";
				}

				return $teamlogo;

			}
		}
	}

}
?>