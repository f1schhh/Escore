<?php

class SiteSettings extends DB{

	public function __construct(){
	
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