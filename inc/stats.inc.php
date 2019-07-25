<?php
class Stats extends DB{

	public $played_matches = "3";
	public $place = 1;	

	public function getStatsKD(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,kdratio,played_matches FROM players ORDER BY kdratio DESC LIMIT 5");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$kdratio,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$kdratio.' K/D</span>
                     </div>   
                   <div class="line"></div>

				';
				}
			}

		}

	}

	public function getStatsKR(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,krratio,played_matches FROM players ORDER BY krratio DESC LIMIT 5");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$krratio,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$krratio.' K/R</span>
                     </div>   
                   <div class="line"></div>

				';
				}
			}

		}
	}


	public function getStatsKills(){

		$DB = new DB();
		$DB->connect();

		$getKD = $DB->prepare("SELECT nickname,player_picture,total_kills,played_matches FROM players ORDER BY total_kills DESC LIMIT 5");
		$getKD->execute();
		$getKD->store_result();


		if($getKD->num_rows == 0){

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_kills,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$total_kills.' Kills</span>
                     </div>   
                   <div class="line"></div>

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

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$kdratio,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <span class="place">'.$this->place++.'</span> <img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$kdratio.' K/D</span>
                 </div>   
                 <div class="line"></div>

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

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$krratio,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <span class="place">'.$this->place++.'</span><img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$krratio.' K/R</span>
                     </div>   
                   <div class="line"></div>

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

			echo "fel";

			}else{

			$getKD->bind_result($nickname,$player_picture,$total_kills,$played_matches);

			while($getKD->fetch()){

				if($played_matches<$this->played_matches){

				}else{
					echo '

				 <div class="matchesFix">
                    <span class="place">'.$this->place++.'</span><img src="'.$player_picture.'" style="height: 30px;" />
                    <a href="../players/'.$nickname.'" class="namefix">'.$nickname.'</a> 
                    <span class="statsline">'.$total_kills.' Kills</span>
                     </div>   
                   <div class="line"></div>

				';
				}
			}

		}
	}


}
?>