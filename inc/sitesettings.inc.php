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
                <li><a href="portfolio.php">Matcher</a></li><br />
                <li><a href="contact.php">Statistik</a></li><br />
		';
	}
	
	public function getMenyOutside(){

		echo '

		        <li><a href="index.php">Hem</a></li><br />
                <li><a href="portfolio.php">Stats</a></li><br />
                <!----- <li><a href="contact.php">Kontakta</a></li><br /> ------>
		';
	}

	public function footercopy(){
		return '';
	}

}
?>