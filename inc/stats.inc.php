<?php
class Stats extends DB{

	public $played_matches = "1";
	public $place = 1;	

	public function getStatsKD(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,kdratio,played_matches FROM players WHERE played_matches >= ? ORDER BY kdratio DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$kdratio,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

					<div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$kdratio.' K/D
					    </span>
					</div>

				';
				}
			}

		}

	}

	public function getStatsKR(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,krratio,played_matches FROM players WHERE played_matches >= ? ORDER BY krratio DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$krratio,$played_matches);

			while($getKD->fetch()){
				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '
					<div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$krratio.' K/R
					    </span>
					</div>
				';
				}
			}

		}
	}


	public function getStatsKills(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_kills,played_matches FROM players WHERE played_matches >= ? ORDER BY total_kills DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_kills,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '
                    <div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$total_kills.' Kills
					    </span>
					</div>
				';
				}
			}

		}
	}

	public function getStatsDeaths(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_deaths,played_matches FROM players WHERE played_matches >= ? ORDER BY total_deaths DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_deaths,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '
                    <div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext" style="right: 4px;">
					    '.$total_deaths.' deaths
					    </span>
					</div>
				';
				}
			}

		}
	}
	public function getStatsMatches(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_deaths,played_matches FROM players ORDER BY played_matches DESC LIMIT 5");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_deaths,$played_matches);


			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }
                if($played_matches == 1){
                	$textfix = "match";
                }else{
                	$textfix = "matcher";
                }
                if($played_matches<$this->played_matches){

                }else{
					echo '
                    <div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext" style="right: 4px;">
					    '.$played_matches.' '.$textfix.'
					    </span>
					</div>
				';
				}
			}
			}

		}
		public function getStatsAverageKills(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,average_kills,played_matches FROM players WHERE played_matches >= ? ORDER BY average_kills DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$average_kills,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '
                    <div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext" style="right: 4px;">
					    '.$average_kills.' Kills
					    </span>
					</div>
				';
				}
			}

		}
	}
	public function getStatsAverageDeaths(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,average_deaths,played_matches FROM players WHERE played_matches >= ? ORDER BY average_deaths DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$average_deaths,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '
                    <div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext" style="right: 4px;">
					    '.$average_deaths.' Deaths
					    </span>
					</div>
				';
				}
			}

		}
	}
		

	public function getFullKd(){
		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,kdratio,played_matches FROM players ORDER BY kdratio DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$kdratio,$played_matches);

			while($getKD->fetch()){
				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$kdratio.' K/D
					    </span>
					</div>

				';
				}
			}

		}
	}

	public function getFullKR(){

		$DB = new DB();
		$DB->connect();	

		$getKD = $DB->prepare("SELECT nickname,player_picture,krratio,played_matches FROM players ORDER BY krratio DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$krratio,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

				  <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$krratio.' K/R
					    </span>
					</div>

				';
				}
			}

		}
	}


	public function getFullKills(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_kills,played_matches FROM players ORDER BY total_kills DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_kills,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

					 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$total_kills.' Kills
					    </span>
					</div>

				';
				}
			}

		}
	}
	public function getFullDeaths(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_deaths,played_matches FROM players ORDER BY total_deaths DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_deaths,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

					 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$total_deaths.' Deaths
					    </span>
					</div>

				';
				}
			}

		}
	}
	public function getFullMatches(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,played_matches FROM players WHERE played_matches >= ? ORDER BY played_matches DESC");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$played_matches);

			while($getKD->fetch()){

				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }
                if($played_matches == 1){
                	$textfix = "match";
                }else{
                	$textfix = "matcher";
                }

					echo '

					 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$played_matches.' '.$textfix.'
					    </span>
					</div>

				';
				}
			}

		}

		public function getFullAverageKills(){
		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,average_kills,played_matches FROM players ORDER BY average_kills DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$average_kills,$played_matches);

			while($getKD->fetch()){
				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$average_kills.' Kills
					    </span>
					</div>

				';
				}
			}

		}
	}

	public function getFullAverageDeaths(){
		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,average_deaths,played_matches FROM players ORDER BY average_deaths DESC");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "<div style='padding: 15px;'>Statistik kommer inom kort</div>";

			}else{

			$getKD->bind_result($nickname,$player_picture,$average_deaths,$played_matches);

			while($getKD->fetch()){
				if($player_picture == ""){
                  $player_picture = "../img/avatars/noavatar.png";
                }

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="statsinsidebox">
					    <div class="insidename">
					    <span class="place">'.$this->place++.'</span>
					    <img src="'.$player_picture.'" style="height: 30px;" />
					    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a>
					    </div>
					    <span class="rightext">
					    '.$average_deaths.' Deaths
					    </span>
					</div>

				';
				}
			}

		}
	}

	public function getTeamLeaderboard(){

		$DB = new DB();
		$DB->connect();

		$getleaderboard = $DB->prepare("SELECT * FROM teams ORDER BY points DESC, rounddiff DESC");
		$getleaderboard->execute();
		$getleaderboard->store_result();
		
		if($getleaderboard->num_rows == 0){
			echo "Fel...";
		}else {

			$getleaderboard->bind_result($id,$teamname,$teamlogo,$fullteamname,$played,$wins,$loses,$won_rounds,$lose_rounds,$rounddiff,$winrate,$points);

			while($getleaderboard->fetch()){

				if($won_rounds > $lose_rounds){
					$getdiff = "+$rounddiff";
				}else{
					if($rounddiff == 0){
						$getdiff = $rounddiff;
					}else{
						$getdiff = $rounddiff;
					}
					
				}

				echo '

				<tr>
                <th>
                 '.$this->place++.'.
                <img src="'.$teamlogo.'" class="teamlogol" />
                <a href="../teams/'.$teamname.'">'.$fullteamname.'</a>
                </th>
                <th>'.$played.'</th>
                <th><font color="green">'.$wins.'</font>-<font color="red">'.$loses.'</font></th>
                <th>'.$getdiff.'</th>
                <th>'.$points.'</th>
                </tr>

				';




			}

		}
	}



}
?>