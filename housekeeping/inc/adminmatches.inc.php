<?php
class AdminMatches extends DB{

	public $startfrom;
	public $pagecheck;

    public function AllMatches($page){

    	$DB = new DB();
		$DB->connect();

		$perpage = "8";
		$this->pagecheck = $DB->secret($page);

		$this->startfrom = ($this->pagecheck-1) * $perpage;


		$getmatches = $DB->prepare("SELECT * FROM matches ORDER by starttdate DESC, starttime desc LIMIT ?, ?");
		$getmatches->bind_Param("ss", $this->startfrom, $perpage);
		$getmatches->execute();
		$getmatches->store_result();

		if($getmatches->num_rows == 0){
			header("location: controllmatches.php?page=1");
		}else{

			$getmatches->bind_result($id,$matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$map,$score,$league,$mvp);

			while ($getmatches->fetch()) {

				if($match_status == "live"){
					$status = "<font color='green'>LIVE</font>";
				}else{
					$status = "$starttdate $starttime";
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
				<a href="controllmatches.php?matchid='.$matchid.'">
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

    public $pagecheck1; 
    public function AllMatchesMeny($page){

    	$DB = new DB();
		$DB->connect(); 

		$perpage = 8;
		$this->pagecheck1 = $DB->secret($page);

		$getmeny = $DB->prepare("SELECT COUNT(id) AS total FROM matches");
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
				if($i == $this->pagecheck1) echo " id='markedpage'";
				echo ">$i </a>";
			}
		}
    }

    private $matchcheck;

    public function CheckMatchId($matchid){

    	$DB = new DB();
		$DB->connect(); 

		$this->matchcheck = $DB->secret($matchid);

		$getid = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$getid->bind_Param("s", $this->matchcheck);
		$getid->execute();
		$getid->store_result();

		if($getid->num_rows == 1){
			return 1;
		}else{
			return 0;
		}
    }

    private $allmatchid;
    public $match_id;
    public $start_time;
    public $start_date;
    public $team_one;
    public $team_two;
    public $matchstatus;
    public $upmap;
    public $sc0re;
    public $mvp1;


    public function getAllMatchInfo($matchid){

    	$DB = new DB();
		$DB->connect(); 

		$this->allmatchid = $DB->secret($matchid);

		$getall = $DB->prepare("SELECT * FROM matches WHERE matchid = ?");
		$getall->bind_Param("s", $this->allmatchid);
		$getall->execute();
		$getall->store_result();

		if($getall->num_rows == 1){

			$getall->bind_Result($id,$matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$map,$score,$league,$mvp);

			while ($getall->fetch()) {

				$this->match_id = $matchid;
				$this->matchstatus = $match_status;
				$this->sc0re = $score;
				$this->team_one = $team1;
				$this->team_two = $team2;
				$this->start_time = $starttime;
				$this->start_date = $starttdate;
				$this->upmap = $map;
				$this->mvp1 = $mvp;

			}

		}

    }
    public function getMatchId(){
    	return $this->match_id;
    }
    public function getMatchStatus(){
		return $this->matchstatus;
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
	public function getMVP(){
		return $this->mvp1;
	}
	public function getMap(){
		return $this->upmap;
	}
	public function getScore(){
		return $this->sc0re;
	}

	private $matchlineup;
	private $teamlineup;

	public function ShowLineUpTeam1($matchid, $team){
		$DB = new DB();
		$DB->connect();

		$this->matchlineup = $DB->secret($matchid);
		$this->teamlineup = $DB->secret($team);

		$getLineup = $DB->prepare("SELECT * FROM match_lineup WHERE matchid = ? AND team = ? LIMIT 5");
		$getLineup->bind_Param("ss", $this->matchlineup, $this->teamlineup);
		$getLineup->execute();
		$getLineup->store_result();

		if($getLineup->num_rows == 1){

			$getLineup->bind_result($id,$matchid,$team,$player1,$player2,$player3,$player4,$player5);

			while ($getLineup->fetch()) {

				echo '
				<input type="text" id="editinput" class="matchinfo" name="player1" value="'.$player1.'" />
				<input type="text" id="editinput" class="matchinfo" name="player2" value="'.$player2.'" />
				<input type="text" id="editinput" class="matchinfo" name="player3" value="'.$player3.'" />
				<input type="text" id="editinput" class="matchinfo" name="player4" value="'.$player4.'" />
				<input type="text" id="editinput" class="matchinfo" name="player5" value="'.$player5.'" />
				';

			}

		}
	}


	public function ShowLineUpTeam2($matchid, $team){
		$DB = new DB();
		$DB->connect();

		$this->matchlineup = $DB->secret($matchid);
		$this->teamlineup = $DB->secret($team);

		$getLineup = $DB->prepare("SELECT * FROM match_lineup WHERE matchid = ? AND team = ? LIMIT 5");
		$getLineup->bind_Param("ss", $this->matchlineup, $this->teamlineup);
		$getLineup->execute();
		$getLineup->store_result();

		if($getLineup->num_rows == 1){

			$getLineup->bind_result($id,$matchid,$team,$player1,$player2,$player3,$player4,$player5);

			while ($getLineup->fetch()) {

				echo '
				<input type="text" id="editinput" class="matchinfo" name="player6" value="'.$player1.'" />
				<input type="text" id="editinput" class="matchinfo" name="player7" value="'.$player2.'" />
				<input type="text" id="editinput" class="matchinfo" name="player8" value="'.$player3.'" />
				<input type="text" id="editinput" class="matchinfo" name="player9" value="'.$player4.'" />
				<input type="text" id="editinput" class="matchinfo" name="player10" value="'.$player5.'" />
				';

			}

		}
	}
}
?>