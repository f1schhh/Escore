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

			$playerinfo->bind_Result($id,$steamid,$first_name,$nickname,$last_name,$age,$player_picture,$total_kills,$total_deaths,$kdratio,$team,$standin,$twitch_url,$twitter_url);

			while($playerinfo->fetch()){

				$countkd = $total_kills / $total_deaths;

			echo '

			<div class="playerprofile">
          <div class="playerimg">
          <a href="'.$player_picture.'" data-lightbox="Player"><img src="'.$player_picture.'" class="playerImgSrc" /></a>
          </div>
          <div class="userinfobox" style="margin-top: 0px;">
              <span class="nickname"> '.$first_name.' "<b>'.$nickname.'</b>" '.$last_name.' </span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> Ålder: <b>'.$age.'</b></span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> K/D Ratio: <b>'.round($countkd, 2).'</b> </span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> Lag: <b>'.$team.'</b> </span><br />
           </div>
        </div> 
        <div class="playerMeny">
          <div class="playerMenyFix">
          <a href="" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;"> Matcher</a>
          <a href="" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;">  Statistik</a>
          <a href="'.$twitter_url.'" target="_blank" style="float: right;"><img src="../img/icons/twittericon.png" /></a>
          <a href="'.$twitch_url.'" target="_blank" style="float: right; margin-right: 5px;"><img src="../img/icons/twitchicon.png" /></a>
        </div>
      </div>
      ';
			}


		}else{
			header("location: ../index.php");
		}


	}


}
?>