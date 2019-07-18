<?php 
function getTeamLogo($teamname){
	$DB = new DB();
		$DB->connect();
		$team = $DB->secret($teamname);

		$getTeamInfo = $DB->prepare("SELECT * FROM teams WHERE teamname = ? OR fullteamname = ?");
		$getTeamInfo->bind_Param("ss", $team, $team);
		$getTeamInfo->execute();
		$getTeamInfo->store_result();

		if($getTeamInfo->num_rows == 1){

			$getTeamInfo->bind_result($id,$teamname,$teamlogo,$fullteamname);

			while ($getTeamInfo->fetch()) {

				return $teamlogo;

			}
		}
	}
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
				<a href="matches/'.$matchid.'">
				<div class="matchtitle">
                <span class="matchTitlefix">
 
                <span class="startTime">'.$status.' </span> 


                <img src="'.getTeamLogo($team1).'" class="leftteamicon"  />
                    '.$team1.' VS  '.$team2.' 
                <img src="'.getTeamLogo($team2).'" class="rightteamicon"  />

             <span class="activeScore">'.$matchscore.'</span>
           </span>

         </div>
         </a>
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

    public function getScoreForKR(){
		        
		        $scoreresult = array_map('intval', explode('-', $this->scorematch));

                $matchscore = $scoreresult[0] + $scoreresult[1];

                return $matchscore;
	}
    

    private $statsid;
    private $team;
    public $playernick;
    public function getMatchStatsTeamOne($matchid, $teamname, $score){

    	$DB = new DB();
		$DB->connect();
		$this->statsid = $DB->secret($matchid);
		$this->team = $DB->secret($teamname);

		$statsteamone = $DB->prepare("SELECT * FROM match_stats WHERE matchid = ? AND teamname = ? ORDER BY kills DESC LIMIT 5");
		$statsteamone->bind_Param("ss", $this->statsid, $this->team);
		$statsteamone->execute();
		$statsteamone->store_result();

		if($statsteamone->num_rows == 0){

		}else{

			$statsteamone->bind_result($id,$matchid,$playername,$kills,$deaths,$teamname);

			while($statsteamone->fetch()){

				$countkd = $kills / $deaths;

				$realkd = round($countkd, 2);

				$kpr = $kills / $score;

				$realkpr = round($kpr, 2);

				
				$playerinfo = $DB->prepare("SELECT first_name,nickname,last_name FROM players WHERE nickname = ?");
		        $playerinfo->bind_Param("s", $playername);
		        $playerinfo->execute();
		 
		        if($playerinfo->num_rows == 0){

			    $playerinfo->bind_result($first_name,$nickname,$last_name);

			    while($playerinfo->fetch()){
				$this->getname = $first_name;
				$this->getnick = $nickname;
				$this->getlast = $last_name;
				
			   }
		       }else{

		       	echo "Fel.....";
			 
		      }


				echo '

				<div class="matchesFix">
                <a href="../players/'.$this->getnick.'">'.$this->getname.' "<b>'.$this->getnick.'</b>" '.$this->getlast.'</a>
                <span class="statsline">'.$realkpr.' K/R</span>  
                <span class="statsline">'.$realkd.' K/D</span>   
                <span class="statsline">'.$deaths.' Deaths</span> 
                <span class="statsline">'.$kills.' Kills</span> 
                </div>  
                <div class="line"></div>
				';


			}

		}
    }

    public function nicknameGet(){
    	return $this->playernick;
    }

    private $statsid2;
    private $team2;
    public $getname;
    public $getnick;
    public $getlast;
    public function getMatchStatsTeamTwo($matchid, $teamname, $score){

    	$DB = new DB();
		$DB->connect();
		$this->statsid2= $DB->secret($matchid);
		$this->team2 = $DB->secret($teamname);

		$statsteamone = $DB->prepare("SELECT * FROM match_stats WHERE matchid = ? AND teamname = ? ORDER BY kills DESC LIMIT 5");
		$statsteamone->bind_Param("ss", $this->statsid2, $this->team2);
		$statsteamone->execute();
		$statsteamone->store_result();

		if($statsteamone->num_rows == 0){

		}else{

			$statsteamone->bind_result($id,$matchid,$playername,$kills,$deaths,$teamname);

			while($statsteamone->fetch()){

				$countkd = $kills / $deaths;

				$realkd = round($countkd, 2);

				$kpr = $kills / $score;

				$realkpr = round($kpr, 2);

				$playerinfo = $DB->prepare("SELECT first_name,nickname,last_name FROM players WHERE nickname = ?");
		        $playerinfo->bind_Param("s", $playername);
		        $playerinfo->execute();
		 
		        if($playerinfo->num_rows == 0){

			    $playerinfo->bind_result($first_name,$nickname,$last_name);

			    while($playerinfo->fetch()){
				$this->getname = $first_name;
				$this->getnick = $nickname;
				$this->getlast = $last_name;
				
			   }
		       }else{

		       	echo "Fel....";
			 
		     }


				echo '
				<div class="matchesFix">
				<a href="../players/'.$this->getnick.'">'.$this->getname.' "<b>'.$this->getnick.'</b>" '.$this->getlast.'</a> 
                <span class="statsline">'.$realkd.' K/D</span>   
                <span class="statsline">'.$deaths.' Deaths</span> 
                <span class="statsline">'.$kills.' Kills</span>  
                </div>  
                <div class="line"></div>
				';


			}

		}


    }

    private $mvpid;
    private $playerp;

    public function showMVP($matchid, $score){

    	$DB = new DB();
		$DB->connect();

		$this->mvpid = $DB->secret($matchid);


		$getmvp = $DB->prepare("SELECT mvp FROM matches WHERE matchid = ?");
		$getmvp->bind_Param("s", $this->mvpid);
		$getmvp->execute();
		$getmvp->store_result();

		if($getmvp->num_rows == 1){

			$getmvp->bind_result($mvp);

			while ($getmvp->fetch()) {

				// Get stats from the game

				$mvpmatchstats = $DB->prepare("SELECT matchid,playername,kills,deaths FROM match_stats WHERE playername = ? AND matchid = ?");
				$mvpmatchstats->bind_Param("ss", $mvp, $this->mvpid);
				$mvpmatchstats->execute();
				$mvpmatchstats->store_result();

				if($mvpmatchstats->num_rows == 1){

					$mvpmatchstats->bind_Result($matchid,$playername,$kills,$deaths);

					while ($mvpmatchstats->fetch()){

						$countkd = $kills / $deaths;

				        $realkd = round($countkd, 2);

				        $kpr = $kills / $score;

				        $realkpr = round($kpr, 2);
 
				        $playerinfo = $DB->prepare("SELECT first_name,nickname,last_name,player_picture FROM players WHERE nickname = ?");
		                $playerinfo->bind_Param("s", $playername);
		                $playerinfo->execute();
		 
		                if($playerinfo->num_rows == 0){

			            $playerinfo->bind_result($first_name,$nickname,$last_name,$player_picture);

			            while($playerinfo->fetch()){
				          $this->getname = $first_name;
				          $this->getnick = $nickname;
				          $this->getlast = $last_name;
				          $this->playerp = $player_picture;
				 
			            }
		                }else{

		       	         echo "Fel....";

		       	      }
			 
						echo '
						<div class="mvppicture"><img src="'.$this->playerp.'" class="mvpimgsrc" /></div>
					   <div class="mvpstats" style="margin-top: 0px;">
                       <span class="#">'.$this->getname.' "<b>'.$this->getnick.'</b>" '.$this->getlast.'</span>
                       </div>
                       <div class="mvpstats">
                       <span class="#">Totala kills: <b>'.$kills.'</b> </span>
                       </div>  
                       <div class="mvpstats">
                       <span class="#">K/D Ratio: <b>'.$realkd.'</b></span>
                       </div> 
                       <div class="mvpstats">
                       <span class="#">K/R Ratio: <b>'.$realkpr.'</b></span>
                       </div> 

					';
					}

				}

			}

		}


    }



}
?>