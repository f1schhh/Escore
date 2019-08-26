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

			$getTeamInfo->bind_result($id,$teamname,$teamlogo,$fullteamname,$played,$wins,$loses,$winrate);

			while ($getTeamInfo->fetch()) {

				if($teamlogo == ""){
					$teamlogo = "http://localhost/svtv/img/teamicons/nologo.png";
				}

				return $teamlogo;

			}
		}
	}
function getPlayer($player){

	$DB = new DB();
	$DB->connect();

	$playerid = $DB->secret($player);
	$nopicture = "../img/avatars/noavatar.png";

	$getplayerinfo = $DB->prepare("SELECT nickname,player_picture FROM players WHERE nickname = ?");
	$getplayerinfo->bind_Param("s", $playerid);
	$getplayerinfo->execute();
	$getplayerinfo->store_result();

	if($getplayerinfo->num_rows == 1){

		$getplayerinfo->bind_result($nickname,$player_picture);

		while ($getplayerinfo->fetch()) {

		   if($player_picture == ""){
             $player_picture = "../img/avatars/noavatar.png";
           }

			echo '
			<a href="../players/'.$nickname.'">
			 <div class="playerpicture"><img src="'.$player_picture.'" class="playerpos" />
              <span class="playernickname"><center>'.$nickname.'</center></span>
             </div>
             </a>
			';

		}

	}else{
		echo '
		 <div class="playerpicture"><img src="'.$nopicture.'" class="playerpos" />
              <span class="playernickname"><center>'.$playerid.'</center></span>
             </div>
		';
	}

}

function getFullTeamName($team){

	$DB = new DB();
	$DB->connect();

	$teamid = $DB->secret($team);

	$getteamname = $DB->prepare("SELECT fullteamname FROM teams WHERE teamname = ?");
	$getteamname->bind_Param("s", $teamid);
	$getteamname->execute();
	$getteamname->store_result();

	if($getteamname->num_rows == 1){

		$getteamname->bind_result($fullteamname);

		while ($getteamname->fetch()) {

			return $fullteamname;

		}

	}else{
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

		$matchesinfo = $DB->prepare("SELECT matchid,starttime,starttdate,startyear,team1,team2,match_status,score FROM matches WHERE match_status = ? OR match_status = ? ORDER by starttdate,starttime ASC LIMIT 10");
		$matchesinfo->bind_Param("ss", $this->matchstatusen, $this->matchstatusen2);
		$matchesinfo->execute();
		$matchesinfo->store_result();


		if($matchesinfo->num_rows == 0){


			echo "Inga matcher tillgängliga....";


		}else{


			$matchesinfo->bind_Result($matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$score);

			while($matchesinfo->fetch()){

				if($match_status == "live"){
					$status = "<font color='green'>LIVE</font>";
				}else{
					
                    $fixdate = strftime("%e %B", strtotime($starttdate));

                    $realtime = strtotime($starttime);
                    $fixtime = date("H:i", $realtime);

                    $status = "$fixdate $fixtime";
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
	public $start_date;
	public $start_year;
	public $league;
	public $stream;


	public function getMatchInformation($matchid){

		$DB = new DB();
		$DB->connect();

		$this->matchidet = $DB->secret($matchid);

		$showmatchinfo = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$showmatchinfo->bind_Param("s", $this->matchidet);
		$showmatchinfo->execute();
		$showmatchinfo->store_result();


		if($showmatchinfo->num_rows == 1){


			$showmatchinfo->bind_result($id,$matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$map,$score,$league,$stream,$mvp);

			while($showmatchinfo->fetch()){

				$this->endmatch = $match_status;
				$this->scorematch = $score;
				$this->team_one = $team1;
				$this->team_two = $team2;
				$this->start_time = $starttime;
				$this->start_year = $startyear;
				$this->upmap = $map;
				$this->start_date = $starttdate;
				$this->league = $league;
				$this->stream = $stream;
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
	public function getStartDate(){
		return $this->start_date;
	}
	public function getStartYear(){
		return $this->start_year;
	}
	public function getMap(){
		return $this->upmap;
	}
	public function getLeague(){
		return $this->league;
	}
	public function getStream(){
		return $this->stream;
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
		$fullname = getFullTeamName($teamname);

		$statsteamone = $DB->prepare("SELECT * FROM match_stats WHERE matchid = ? AND teamname = ? OR matchid = ? AND teamname = ? ORDER BY kills DESC LIMIT 5");
		$statsteamone->bind_Param("ssss", $this->statsid, $this->team, $this->statsid, $fullname);
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

				<div class="statsinsidebox">
					<div class="insidename">
					    <a href="../players/'.$this->getnick.'" class="namefix">'.$this->getname.' "<b>'.$this->getnick.'</b>" '.$this->getlast.'</a>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$kills.' Kills
					    </span>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$deaths.' Deaths
					    </span>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$realkd.' K/D
					    </span>
					    </div>
					    <div class="allstats" style="border-right: none;">
					    <span class="rightext">
					    '.$realkpr.' K/R
					    </span>
					    </div>
				</div>

				
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
		$fullname = getFullTeamName($teamname);

		$statsteamone = $DB->prepare("SELECT * FROM match_stats WHERE matchid = ? AND teamname = ? OR matchid = ? AND teamname = ? ORDER BY kills DESC LIMIT 5");
		$statsteamone->bind_Param("ssss", $this->statsid2, $this->team2, $this->statsid2, $fullname);
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
				<div class="statsinsidebox">
					<div class="insidename">
					    <a href="../players/'.$this->getnick.'" class="namefix">'.$this->getname.' "<b>'.$this->getnick.'</b>" '.$this->getlast.'</a>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$kills.' Kills
					    </span>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$deaths.' Deaths
					    </span>
					    </div>
					    <div class="allstats">
					    <span class="rightext">
					    '.$realkd.' K/D
					    </span>
					    </div>
					    <div class="allstats" style="border-right: none;">
					    <span class="rightext">
					    '.$realkpr.' K/R
					    </span>
					    </div>
				</div>
				';


			}

		}


    }

    private $teamid;
    private $matchline;
    public function getLineup($team,$matchid){

    	$DB = new DB();
		$DB->connect();

		$this->teamid = $DB->secret($team);
		$this->matchline = $DB->secret($matchid);

		$getLineup = $DB->prepare("SELECT * FROM match_lineup WHERE matchid = ? AND team = ?");
		$getLineup->bind_Param("ss", $this->matchline, $this->teamid);
		$getLineup->execute();
		$getLineup->store_result();

		if($getLineup->num_rows == 1){

			$getLineup->bind_result($id,$matchid,$team,$player1,$player2,$player3,$player4,$player5);

			while ($getLineup->fetch()) {

				getPlayer($player1);
				getPlayer($player2);
				getPlayer($player3);
				getPlayer($player4);
				getPlayer($player5);
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
				          if($this->playerp == ""){
                          $this->playerp = "../img/avatars/noavatar.png";
                          }
				 
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

    public $startfrom;

    public function AllMatches($page){

    	$DB = new DB();
		$DB->connect();

		$status = "ended";
		$perpage = "8";

		$this->startfrom = ($page-1) * $perpage;


		$getmatches = $DB->prepare("SELECT * FROM matches WHERE match_status = ? ORDER by starttdate DESC, starttime desc LIMIT ?, ?");
		$getmatches->bind_Param("sss", $status, $this->startfrom, $perpage);
		$getmatches->execute();
		$getmatches->store_result();

		if($getmatches->num_rows == 0){
			header("location: ../index.php");
		}else{

			$getmatches->bind_result($id,$matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$map,$score,$league,$stream,$mvp);

			while ($getmatches->fetch()) {

				if($match_status == "live"){
					$status = "<font color='green'>LIVE</font>";
				}else{
					
                    $fixdate = strftime("%e %B", strtotime($starttdate));

                    $realtime = strtotime($starttime);
                    $fixtime = date("H:i", $realtime);

                    $status = "$fixdate $fixtime";
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
				<a href="../matches/'.$matchid.'">
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

    public function AllMatchesMeny($page){

    	$DB = new DB();
		$DB->connect();

		$status = "ended";
		$perpage = 8;

		$getmeny = $DB->prepare("SELECT COUNT(id) AS total FROM matches WHERE match_status = ?");
		$getmeny->bind_Param("s", $status);
		$getmeny->execute();
		$getmeny->store_result();


		if($getmeny->num_rows == 0){

		}else{
			$getmeny->bind_Result($total);

			while($getmeny->fetch()){
				$total_pages = ceil($total / 8);
				
			}

			for($i=1; $i<=$total_pages; $i++){
				echo "<a href='$i' class='pagebtn'";
				if($i == $page) echo " id='markedpage'";
				echo ">$i </a>";
			}
		}


    }



}
?>