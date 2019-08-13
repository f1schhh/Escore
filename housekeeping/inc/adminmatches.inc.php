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


		$getmatches = $DB->prepare("SELECT * FROM matches ORDER by match_status DESC, starttdate DESC, starttime desc LIMIT ?, ?");
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
				echo "<a href='controllmatches.php?page=$i' class='pagebtn'";
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
	public $player_1;
	public $player_2;
	public $player_3;
	public $player_4;
	public $player_5;

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

				$this->player_1 = $player1;
				$this->player_2 = $player2;
				$this->player_3 = $player3;
				$this->player_4 = $player4;
				$this->player_5 = $player5;

			}

		}
	}

	public $player_6;
	public $player_7;
	public $player_8;
	public $player_9;
	public $player_10;

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

				$this->player_6 = $player1;
				$this->player_7 = $player2;
				$this->player_8 = $player3;
				$this->player_9 = $player4;
				$this->player_10 = $player5;

			}

		}
	}
	// Team1
	public function player1(){
		return $this->player_1;
	}
	public function player2(){
		return $this->player_2;
	}
	public function player3(){
		return $this->player_3;
	}
	public function player4(){
		return $this->player_4;
	}
	public function player5(){
		return $this->player_5;
	}

	//Team2
	public function player6(){
		return $this->player_6;
	}
	public function player7(){
		return $this->player_7;
	}
	public function player8(){
		return $this->player_8;
	}
	public function player9(){
		return $this->player_9;
	}
	public function player10(){
		return $this->player_10;
	}


	private $editid;
	private $team1_edit;
	private $team2_edit;
	private $status_edit;
	private $map_edit;
	private $startime_edit;
	private $startdate_edit;
	private $score_edit;
	private $mvp_edit;


	public function saveMatchInfo($matchid, $team1, $team2, $matchstatus, $map, $score, $startime, $startdate, $mvp){

		$DB = new DB();
		$DB->connect();

		$this->editid = $DB->secret($matchid);
		$this->team1_edit = $DB->secret($team1);
		$this->team2_edit = $DB->secret($team2);
		$this->status_edit = $DB->secret($matchstatus);
		$this->map_edit = $DB->secret($map);
		$this->startime_edit = $DB->secret($startime);
		$this->startdate_edit = $DB->secret($startdate);
		$this->mvp_edit = $DB->secret($mvp);
		$this->score_edit = $DB->secret($score);

		$saveinfo = $DB->prepare("SELECT * FROM matches WHERE matchid = ? ");
		$saveinfo->bind_Param("s", $this->editid);
		$saveinfo->execute();
		$saveinfo->store_result();

		if($saveinfo->num_rows == 1){

			$editinfo = $DB->prepare("UPDATE matches SET team1 = ?, team2 = ?, match_status = ?, map = ?, starttime = ?, starttdate = ?, score = ?, mvp = ? WHERE matchid = ?");
			$editinfo->bind_Param("sssssssss", $this->team1_edit, $this->team2_edit, $this->status_edit, $this->map_edit, $this->startime_edit, $this->startdate_edit, $this->score_edit, $this->mvp_edit, $this->editid);
			if($editinfo->execute()){
				echo "<font color='green'>Matchinformationen är nu uppdaterad!</font>";
				echo ' <script>$(document).ready(function(){ $("#editinfo").load(location.href + " #editinfo");  }); </script>  ';
			}


		}
	}

	private $player1;
	private $player2;
	private $player3;
	private $player4;
	private $player5;
	private $player6;
	private $player7;
	private $player8;
	private $player9;
	private $player10; 
	private $mid;
	private $team_1;
	private $team_2;

	public function saveLineUp($matchid,$team1,$player1,$player2,$player3,$player4,$player5,$team2,$player6,$player7,$player8,$player9,$player10){

		$DB = new DB();
		$DB->connect();

		$this->mid = $DB->secret($matchid);
		$this->player1 = $DB->secret($player1);
		$this->player2 = $DB->secret($player2);
		$this->player3 = $DB->secret($player3);
		$this->player4 = $DB->secret($player4);
		$this->player5 = $DB->secret($player5);
		$this->player6 = $DB->secret($player6);
		$this->player7 = $DB->secret($player7);
		$this->player8 = $DB->secret($player8);
		$this->player9 = $DB->secret($player9);
		$this->player10 = $DB->secret($player10);
		$this->team_1 = $DB->secret($team1);
		$this->team_2 = $DB->secret($team2);
		$id = null;

		$saveinfo = $DB->prepare("SELECT * FROM matches WHERE matchid = ? ");
		$saveinfo->bind_Param("s", $this->mid);
		$saveinfo->execute();
		$saveinfo->store_result();

		if($saveinfo->num_rows == 1){

			// Kolla om de redan är inlagda lag 1
		    $checkline1 = $DB->prepare("SELECT * FROM match_lineup WHERE matchid = ? AND team = ?");
		    $checkline1->bind_Param("ss", $this->mid, $this->team_1);
		    $checkline1->execute();
		    $checkline1->store_result();

		    if($checkline1->num_rows == 1){
		    	$team1 = $DB->prepare("UPDATE match_lineup SET player1 = ?, player2 = ?, player3 = ?, player4 = ?, player5 = ? WHERE matchid = ? AND team = ?");
			    $team1->bind_Param("sssssss", $this->player1,$this->player2,$this->player3,$this->player4,$this->player5, $this->mid, $this->team_1);
			    if($team1->execute()){
				 
			     }
		    }else{
		    	$addlineup1 = $DB->prepare("INSERT INTO match_lineup (id,matchid,team,player1,player2,player3,player4,player5) VALUES (?,?,?,?,?,?,?,?)");
		    	$addlineup1->bind_Param("ssssssss", $id, $this->mid, $this->team_1, $this->player1, $this->player2, $this->player3, $this->player4, $this->player5);
		    	if($addlineup1->execute()){
		    		
		    	}
		    }

		    // Kolla om de redan är inlagda lag 2
		    $checkline2 = $DB->prepare("SELECT * FROM match_lineup WHERE matchid = ? AND team = ?");
		    $checkline2->bind_Param("ss", $this->mid, $this->team_2);
		    $checkline2->execute();
		    $checkline2->store_result();

		    if($checkline2->num_rows == 1){
		    	$team2 = $DB->prepare("UPDATE match_lineup SET player1 = ?, player2 = ?, player3 = ?, player4 = ?, player5 = ? WHERE matchid = ? AND team = ?");
			    $team2->bind_Param("sssssss", $this->player6,$this->player7,$this->player8,$this->player9,$this->player10, $this->mid, $this->team_2);
			    if($team2->execute()){
				echo "<font color='green'>Lineup är nu uppdaterad!</font>";
				echo ' <script>$(document).ready(function(){ $("#editlineup").load(location.href + " #editlineup");  }); </script>  ';
			    }
		    }else{

		    	$addlineup2 = $DB->prepare("INSERT INTO match_lineup (id,matchid,team,player1,player2,player3,player4,player5) VALUES (?,?,?,?,?,?,?,?)");
		    	$addlineup2->bind_Param("ssssssss", $id, $this->mid, $this->team_2, $this->player6, $this->player7, $this->player8, $this->player9, $this->player10);
		    	if($addlineup2->execute()){
		    		echo "<font color='green'>Lineup är nu uppdaterad!</font>";
				    echo ' <script>$(document).ready(function(){ $("#editlineup").load(location.href + " #editlineup");  }); </script>  ';
		    	}

		    }


		}
	}
}
?>