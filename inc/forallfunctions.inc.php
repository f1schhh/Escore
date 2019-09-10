<?php
function getTeamLogo($teamname){
	    $DB = new DB();
		$DB->connect();
		$team = $DB->secret($teamname);

		$getTeamInfo = $DB->prepare("SELECT teamlogo FROM teams WHERE teamname = ? OR fullteamname = ?");
		$getTeamInfo->bind_Param("ss", $team, $team);
		$getTeamInfo->execute();
		$getTeamInfo->store_result();

		if($getTeamInfo->num_rows == 1){

			$getTeamInfo->bind_result($teamlogo);

			while ($getTeamInfo->fetch()) {

				if($teamlogo == ""){
					$teamlogo = "https://escore.nu/img/teamicons/nologo.png";
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
function getTBA(){
	echo '<a href="#">
			 <div class="playerpicture"><img src="../img/avatars/noavatar.png" class="playerpos" />
              <span class="playernickname"><center>TBA</center></span>
             </div>
             </a>';
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

function getUserSteamName($steamid){
	$DB = new DB();
	$DB->connect();

	$usera = $DB->secret($steamid);

	$getalluserinfo = $DB->prepare("SELECT steam_id,steam_name,steam_avatar,rank FROM users WHERE steam_id = ?");
	$getalluserinfo->bind_Param("s", $usera);
	$getalluserinfo->execute();
	$getalluserinfo->store_result();

	if($getalluserinfo->num_rows == 1){
		$getalluserinfo->bind_Result($steam_id,$steam_name,$steam_avatar,$rank);

		while($getalluserinfo->fetch()){

			return $steam_name;

		}

	}

}
function getUserSteamAvatar($steamid){
	$DB = new DB();
	$DB->connect();

	$usera = $DB->secret($steamid);

	$getalluserinfo = $DB->prepare("SELECT steam_id,steam_name,steam_avatar,rank FROM users WHERE steam_id = ?");
	$getalluserinfo->bind_Param("s", $usera);
	$getalluserinfo->execute();
	$getalluserinfo->store_result();

	if($getalluserinfo->num_rows == 1){
		$getalluserinfo->bind_Result($steam_id,$steam_name,$steam_avatar,$rank);

		while($getalluserinfo->fetch()){

			return $steam_avatar;

		}

	}

}	
function getUserRank($steamid){
	$DB = new DB();
	$DB->connect();

	$usera = $DB->secret($steamid);

	$getalluserinfo = $DB->prepare("SELECT steam_id,steam_name,steam_avatar,rank FROM users WHERE steam_id = ?");
	$getalluserinfo->bind_Param("s", $usera);
	$getalluserinfo->execute();
	$getalluserinfo->store_result();

	if($getalluserinfo->num_rows == 1){
		$getalluserinfo->bind_Result($steam_id,$steam_name,$steam_avatar,$rank);

		while($getalluserinfo->fetch()){

			return $rank;

		}

	}
}	
?>