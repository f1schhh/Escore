<?php
class Stats extends DB{

	public $played_matches = "2";
	public $place = 1;	

	public function getStatsKD(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,kdratio,played_matches FROM players WHERE played_matches >= ? ORDER BY kdratio DESC LIMIT 5");
		$getKD->bind_param("s", $this->played_matches);
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "Det har skett ett fel!";

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

			echo "Det har skett ett fel!";

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

			echo "Det har skett ett fel!";

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
	public function getTeamWinRate(){

		$DB = new DB();
		$DB->connect();

		$getRate = $DB->prepare("SELECT teamname,teamlogo,played,wins,loses,winrate FROM teams ORDER BY winrate DESC LIMIT 5");
		$getRate->execute();
		$getRate->store_result();


		if($getRate->num_rows == 0){

			echo "Det har skett ett fel!";

			}else{

			$getRate->bind_result($teamname,$teamlogo,$played,$wins,$loses,$winrate);

			while($getRate->fetch()){

				if($teamlogo == ""){
                  $teamlogo = "../img/teamicons/nologo.png";
                }

				if($played<$this->played_matches){

				}else{
					echo '
					<div class="statsinsidebox">
					    <div class="insidename">
					    <img src="'.$teamlogo.'" style="height: 30px;" />
					    <a href="../teams/'.$teamname.'" class="namefix">'.$teamname.'</a>
					    </div>
					    <span class="rightext">
					    '.$winrate.'%
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

			echo "Det har skett ett fel!";

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

			echo "Det har skett ett fel!";

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

			echo "Det har skett ett Det har skett ett fel!!";

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


}
?>