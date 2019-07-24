<?php

class SiteSettings extends DB{

	public function __construct(){
	
	}

	public function getTitle(){
		return "EScore.se";
	}


	public function getFooter(){
		return "<i>&copy; Copyright Escore.se - 2019</i>";
	}

	public function getMeny(){

		echo '

		        <li><a href="index.php">Hem</a></li><br />
                <li><a href="results/">Tidigare resultat</a></li><br />
                <li><a href="stats/">Statistik</a></li><br />
		';
	}
	
	public function getMenyOutside(){

		echo '

		        <li><a href="../index.php">Hem</a></li><br />
                <li><a href="../results/">Tidigare resultat</a></li><br />
                <li><a href="../stats/">Statistik</a></li><br />
		';
	}

	public function getSiteMessage(){

		$DB = new DB();
		$DB->connect();

		$status = 1;

		$getmessage = $DB->prepare("SELECT * FROM site_message WHERE status = ?");
		$getmessage->bind_Param("s", $status);
		$getmessage->execute();
		$getmessage->store_result();

		if($getmessage->num_rows == 1){

			$getmessage->bind_result($id,$site_message,$status);

			while ($getmessage->fetch()) {

				echo '

				<div class="messageshow">'.$site_message.'</div>
				';

			}

		}

	}

	public $mainmessage;
	public $maintitle;

	public function checkMaintenanace(){

		$DB = new DB();
		$DB->connect();

		$status = 1;

		$getmain = $DB->prepare("SELECT * FROM maintenance WHERE status = ?");
		$getmain->bind_Param("s", $status);
		$getmain->execute();
		$getmain->store_result();

		if($getmain->num_rows == 1){

			$getmain->bind_result($id,$main_title,$main_message,$datum,$status);

			while ($getmain->fetch()) {

				$this->maintitle = $main_title;
				$this->mainmessage = $main_message;
				return $status;

			}

		}
	}

	public function getMainTitle(){
		return $this->maintitle;
	}
	public function getMainMessage(){
		return $this->mainmessage;
	}

}
?>