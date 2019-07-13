<?php 
class Matches extends DB{

	private $matchstatusen;
	private $matchstatusen2; 

	public function ShowMatchesFront(){

		$this->matchstatusen = "live";
		$this->matchstatusen2 = "upcoming";

		$DB = new DB();
		$DB->connect();

		$matchesinfo = $DB->prepare("SELECT * FROM matches WHERE match_status = ? OR match_status = ? ORDER by match_status asc, id desc LIMIT 5");
		$matchesinfo->bind_Param("ss", $this->matchstatusen, $this->matchstatusen2);
		$matchesinfo->execute();
		$matchesinfo->store_result();


		if($matchesinfo->num_rows == 0){


			echo "Inga matcher tillgängliga....";


		}else{


			$matchesinfo->bind_Result($id,$matchid,$starttime,$team1,$team2,$match_status,$map,$score,$league,$mvp);

			while($matchesinfo->fetch()){

				if($match_status == "live"){
					$status = "<font color='green'>LIVE</font>";
				}else{
					$status = $starttime;
				}

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


				<div class="matchtitle">
                <span class="matchTitlefix">
 
                <span class="startTime">'.$status.' </span> 


                <img src="https://static.hltv.org/images/team/logo/9735" class="leftteamicon"  />
                    '.$team1.' VS  '.$team2.' 
                <img src="https://static.hltv.org/images/team/logo/8930" class="rightteamicon"  />

             <span class="activeScore">'.$matchscore.'</span>
           </span>

         </div>
         <br />

				';

			}

		}


	}

	public $matchidet;
	public $endmatch;
	public $scorematch;
	public $team_one;
	public $team_two;
	public $start_time;
	public $upmap;


	public function getMatchInformation($matchid){

		$DB = new DB();
		$DB->connect();

		$this->matchidet = $DB->secret($matchid);

		$showmatchinfo = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$showmatchinfo->bind_Param("s", $this->matchidet);
		$showmatchinfo->execute();
		$showmatchinfo->store_result();


		if($showmatchinfo->num_rows == 1){


			$showmatchinfo->bind_result($id,$matchid,$starttime,$team1,$team2,$match_status,$map,$score,$league,$mvp);

			while($showmatchinfo->fetch()){

				$this->endmatch = $match_status;
				$this->scorematch = $score;
				$this->team_one = $team1;
				$this->team_two = $team2;
				$this->start_time = $starttime;
				$this->upmap = $map;
			}
		}else{
			header("location: ../index.php");
		}
	}

	public function getMatchStatus(){
		return $this->endmatch;
	}
	public function getTeamOne(){
		return $this->team_one;
	}
	public function getTeamTwo(){
		return $this->team_two;
	}
	public function getStartTime(){
		return $this->start_time;
	}
	public function getMap(){
		return $this->upmap;
	}
	public function getScore(){
		        
		        $scoreresult = array_map('intval', explode('-', $this->scorematch));

                if($this->scorematch == "not started"){
                  $matchscore = "";
                }else{

                if($scoreresult[0] == $scoreresult[1]){

                }else{

                if($scoreresult[0]>$scoreresult[1]){
                  $scoreresult[0] = '<font color="green">'.$scoreresult[0].' </font>';
                  $scoreresult[1] = '<font color="red">'.$scoreresult[1].' </font>';
                }else{

                  $scoreresult[1] = '<font color="green">'.$scoreresult[1].' </font>';
                  $scoreresult[0] = '<font color="red">'.$scoreresult[0].' </font>';
                }
                }

                $matchscore = "$scoreresult[0] - $scoreresult[1]";

                return $matchscore;
	}







}
}
?>