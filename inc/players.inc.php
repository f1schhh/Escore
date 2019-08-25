<?php
class Players extends DB{

	private $searchplayer;

	public function getPlayerInformation($username){

		$DB = new DB();
		$DB->connect();


		$this->searchplayer = $DB->secret($username);

		$playerinfo = $DB->prepare("SELECT * FROM players WHERE nickname = ?");
		$playerinfo->bind_Param("s", $this->searchplayer);
		$playerinfo->execute();
		$playerinfo->store_result();


		if($playerinfo->num_rows == 1){

			$playerinfo->bind_Result($id,$steamid,$first_name,$nickname,$last_name,$age,$player_picture,$total_kills,$total_deaths,$kdratio,$krratio,$average_kills,$average_deaths,$played_matches,$played_rounds,$team,$standin,$twitch_url,$twitter_url);

			while($playerinfo->fetch()){

				@$countkd = $total_kills / $total_deaths;

        if($player_picture == ""){
          $player_picture = "../img/avatars/noavatar.png";
        }

        if($age == ""){
          $age1 = "-";
        }else{
        // Räknar ut åldern
        $birth = "$age";
        $birth = explode("/", $birth);

        $age1 = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date("md")
         ? ((date("Y") - $birth[2]) - 1)
         : (date("Y") - $birth[2]));
        }

			echo '

			<div class="playerprofile">
          <div class="playerimg">
          <a href="'.$player_picture.'" data-lightbox="Player"><img src="'.$player_picture.'" class="playerImgSrc" /></a>
          </div>
          <div class="userinfobox" style="margin-top: 0px;">
              <span class="nickname"> '.$first_name.' "<b>'.$nickname.'</b>" '.$last_name.' </span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> Ålder: <b>'.$age1.'</b></span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> Lag: <b><a href="../teams/'.$team.'" style="color: #4e4e4e;">'.$team.'</b> </a></span><br />
           </div>
        </div> 
        <div class="playerMeny">
          <div class="playerMenyFix">
          <a href="#" id="showmatches" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;"> Matcher</a>
          <a href="#" id="showstats" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;">  Statistik</a>

          ';
          if($twitter_url == ""){

          }else {
            echo '<a href="'.$twitter_url.'" target="_blank" style="float: right;"><img src="../img/icons/twittericon.png" /></a>';
          }

          if($twitch_url == ""){

          }else{
            echo '<a href="'.$twitch_url.'" target="_blank" style="float: right; margin-right: 5px;"><img src="../img/icons/twitchicon.png" /></a>';
          }
          echo '
        </div>
      </div>
      ';
			}


		}else{
			header("location: ../index.php");
		}


	}

  public $player;
  public $publicmatchid;
  public $testrng;

  public function getPlayersMatches($playername){

    $DB = new DB();
    $DB->connect();

    $this->player = $DB->secret($playername);

    $getmatches = $DB->prepare("SELECT matchid FROM match_stats WHERE playername = ?");
    $getmatches->bind_param("s", $this->player);
    $getmatches->execute();
    $getmatches->store_result();

    if($getmatches->num_rows == 0){
      return 0;
    }else{
      $getmatches->bind_Result($matchid);

      while ($getmatches->fetch()) {

        $this->publicmatchid[] = $matchid;

      }
    }
  }

  public function getAllMatches(){
    $DB = new DB();
    $DB->connect();

    @$rightarray = implode(",",array_map('intval', $this->publicmatchid));
    @$types = str_repeat('i', count($this->publicmatchid));    

    $matchesOfPlayer = $DB->prepare("SELECT matchid,starttime,starttdate,startyear,team1,team2,match_status,score FROM matches WHERE matchid IN ($rightarray) ORDER by id DESC LIMIT 6");
    @$matchesOfPlayer->bind_param($types, ...$this->publicmatchid);
    $matchesOfPlayer->execute();
    $matchesOfPlayer->store_result();

    if($matchesOfPlayer->num_rows == 0){
      echo "error ";
      
    }else{
      $matchesOfPlayer->bind_Result($matchid,$starttime,$starttdate,$startyear,$team1,$team2,$match_status,$score);
      while ($matchesOfPlayer->fetch()) {

                    $fixdate = strftime("%e %B", strtotime($starttdate));

                    $realtime = strtotime($starttime);
                    $fixtime = date("H:i", $realtime);

                    $status = "$fixdate $fixtime";

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

  private $nicksave;

  public function getPlayersStats($nick){  
    $DB = new DB();
    $DB->connect();

    $this->nicksave = $DB->secret($nick);

    $stats = $DB->prepare("SELECT total_kills,total_deaths,kdratio,krratio,average_kills,average_deaths,played_matches,played_rounds FROM players WHERE nickname = ?");
    $stats->bind_param("s", $this->nicksave);
    $stats->execute();
    $stats->store_result();

    if($stats->num_rows == 1){

      $stats->bind_result($total_kills,$total_deaths,$kdratio,$krratio,$average_kills,$average_deaths,$played_matches,$played_rounds);

      while ($stats->fetch()) {

        if($total_kills == ""){
          echo "$this->nicksave har inga matcher spelade...";
        }else{

          echo '
           <div class="statsinfobox">
              <span class="nickname"> Antal spelade matcher: <b>'.$played_matches.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> Antal spelade rundor: <b>'.$played_rounds.'</b> </span><br />
           </div>
          <div class="statsinfobox">
              <span class="nickname"> Antal kills: <b>'.$total_kills.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> Antal deaths: <b>'.$total_deaths.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> KD-Ratio: <b>'.$kdratio.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> KR-Ratio: <b>'.$krratio.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> Genomsnitt kills per match: <b>'.$average_kills.'</b> </span><br />
           </div>
           <div class="statsinfobox">
              <span class="nickname"> Genomsnitt deaths per match: <b>'.$average_deaths.'</b> </span><br />
           </div>
          ';


        }

      }

    }else{
      echo "Error";
    }


  }

  public $searchtxt;

  public function SearchForPlayer($txt){
    $DB = new DB();
    $DB->connect();

    $this->searchtxt = $DB->secret($txt);

    $str = "%".$this->searchtxt."%";

    $search = $DB->prepare("SELECT first_name,nickname,last_name,player_picture FROM players WHERE nickname LIKE ? OR first_name LIKE ? OR last_name LIKE ?");
    $search->bind_param("sss", $str,$str,$str);
    $search->execute();
    $search->store_result();

    if($search->num_rows > 0){

      $search->bind_Result($first_name,$nickname,$last_name,$player_picture);

      while ($search->fetch()) {
        if($player_picture == ""){
          $player_picture = "img/avatars/noavatar.png";
        }
        echo '
        <div class="insidesearch">
            <div class="searchposfix">
            <img src="'.$player_picture.'" style="height: 30px;" />
            <a href="players/'.$nickname.'" class="namefix">'.$first_name.' <b>"'.$nickname.'"</b> '.$last_name.'</a>
            </div>              
        </div>
        ';

      }

    }else{
      echo '
      <div class="nomatches">
      Inga träffar...
      </div>
      ';
    }

  }


}
?>