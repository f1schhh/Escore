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

	public function footercopy(){
		return '';
	}

}
?>