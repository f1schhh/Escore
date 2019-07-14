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

		$getTeamInfo = $DB->prepare("SELECT * FROM teams WHERE teamname = ? OR fullteamname = ?");
		$getTeamInfo->bind_Param("ss", $this->team1, $this->team1);
		$getTeamInfo->execute();
		$getTeamInfo->store_result();

		if($getTeamInfo->num_rows == 1){

			$getTeamInfo->bind_result($id,$teamname,$teamlogo,$fullteamname);

			while ($getTeamInfo->fetch()) {

				$this->teamname = $teamname;
				$this->fullteamname = $fullteamname;
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
		$this->standinid = "0";

		$getPlayers = $DB->prepare("SELECT nickname,player_picture,team,standin FROM players WHERE team = ? AND standin = ?");
		$getPlayers->bind_Param("ss", $this->playerteam, $this->standinid);
		$getPlayers->execute();
		$getPlayers->store_result();

		if($getPlayers->num_rows == 0){

			echo "ERROR";

		}else{
			$getPlayers->bind_result($nickname,$player_picture,$team,$standin);

			while ($getPlayers->fetch()) {

				echo '


				 <div class="playerbox">
                 <div class="playerimg">
                    <img src="'.$player_picture.'" style="max-width: 100%; max-height: 100%; border-top-right-radius: 5px; border-top-left-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;" />
                    <center class="teamname">'.$nickname.'</center>
                 </div>
                 </div> 
                 

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

		$getmatches = $DB->prepare("SELECT * FROM matches WHERE team1 = ? AND match_status = ? OR team2 = ? AND match_status = ? ORDER BY id DESC LIMIT 5");
		$getmatches->bind_Param("ssss", $this->teamid, $this->mstatus,$this->teamid, $this->mstatus);
		$getmatches->execute();
		$getmatches->store_result();

		if($getmatches->num_rows == 0){
			echo '

			error
			';
		}else{
			$getmatches->bind_result($id,$matchid,$starttime,$team1,$team2,$match_status,$map,$score,$league,$mvp);

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

				echo '
				<a href="#">
				<div class="matchtitle">
                <span class="matchTitlefix">
                  <span class="startTime">'.$starttime.'</span> 
                  <img src="https://static.hltv.org/images/team/logo/9735" class="leftteamicon" />
                  '.$team1.' VS  '.$team2.' 
                 <img src="https://static.hltv.org/images/team/logo/8930" class="rightteamicon" />

                 <span class="activeScore">'.$matchscore.'</span>
             </div></a>
				';

			}
		}

	}

}
?>