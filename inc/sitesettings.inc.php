<?php

class SiteSettings extends DB{

	public function __construct(){
	
	}

	public function getTitle(){
		return 'Escore.nu - BETA';
	}


	public function getFooter(){
		return '
		
        <a class="footerbtns modal-trigger" href="#contactmodal">Kontakta</a>  
        <a class="footerbtns modal-trigger" href="#donatemodal">Donera</a> 
        <a class="footerbtns modal-trigger" href="#loginmodal">Logga in</a>
		<i>&copy; Copyright Escore.nu - 2019</i>

		  <!-- Kontakt modal -->
         <div id="contactmodal" class="modal modal-fixed-footer" style="height: 50%;">
         <div class="modal-content" style="color: #4e4e4e;">
         <h4>Kontakta oss</h4>
         <p class="insidemodal">Är det något du undrar över? Tveka inte att skicka iväg ett mail till <b>info@escore.nu</b>. Du kan även nå oss på twitter <a href="https://twitter.com/escorenu" target="_blank">@escorenu</a></p>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Stäng</a>
        </div>
        </div>

        <!-- Donera modal -->
         <div id="donatemodal" class="modal modal-fixed-footer" style="height: 50%;">
         <div class="modal-content" style="color: #4e4e4e;">
         <h4>Donera till oss</h4>
         <p class="insidemodal">Känner du att du vill stödja oss? Då kan du donera till oss för att stödja oss att utveckla <b>Escore</b> till något ännu bättre och större. Donationer är frivilliga och du ska inte känna dig tvingad till och donera. Just nu har vi endast paypal som donationsalternativ men vi jobbar på att utveckla så man kan donera via swish. Klicka <a href="https://paypal.me/escorenu1" target="_blank">här</a> för att donera</p>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Stäng</a>
        </div>
        </div>

         <!-- Logga modal -->
         <div id="loginmodal" class="modal modal-fixed-footer" style="height: 30%;">
         <div class="modal-content" style="color: #4e4e4e;">
         <h4>Logga in</h4>
         <p class="insidemodal">
         Klicka på knappen nedanför för att logga in via steam för att få tillgång till att kommentera och fler funktioner i framtiden <br />
         <a href="http://localhost/SVTV/?login"><img src="../img/steamloginbtn.png" style="position: relative; right: 5px;" /></a>
         </p>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Stäng</a>
        </div>
        </div>
		';
	}

	public function getMeny(){

		echo '

				<li><a href="index.php">Hem</a></li><br />
				<li><a href="tabell/">Tabell</a></li><br />
                <li><a href="results/1">Tidigare resultat</a></li><br />
                <li><a href="stats/">Statistik</a></li><br />
		';
	}
	
	public function getMenyOutside(){

		echo '

				<li><a href="../index.php">Hem</a></li><br />
				<li><a href="../tabell/">Tabell</a></li><br />
                <li><a href="../results/1">Tidigare resultat</a></li><br />
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