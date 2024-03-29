<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
$adminadd = new AdminAdd();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
?>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?> - Housekeeping</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/style.css" /> 
  <link rel="stylesheet" href="../css/admin.css" />
  <link rel="stylesheet" href="../css/home.css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/mobile.js"></script>
   
</head>
<body>
	<div id="smh">
    <!---Start utav mobil menyn---->

		<div id="menymobile">

      <div class="openmeny">

        <a href="#" class="mobilebtn">
            <img src="../img/icons/mobilebtn.png"
        style="width: 56px; height: 56px;">
      </a>

      </div>
      <a href="login.php"><div id="logo"><div class="mainlogo"></div></div></a>

                <div class="fixmobilepos">
              <?php
              echo $adminsettings->AdminMeny();
              ?>
              </div>
       
      <!--- Slut av mobilmeny--->
    </div> 
    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo"><div class="mainlogo"></div></div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">

              <?php
              echo $adminsettings->AdminMeny();
              ?>

            </div>
		</div>
    <!----Slut utav menyn----->
    <!----Start utav mid content----->
		<div id="midcontent">
      <h5 class="upcomingMatchesTitle">Lägg till matchstatistik</h5>
      <div class="matchesFix">
      	<?php
      	@$addstatsbtn = $_POST['addstatsbtn'];
      	/* Spelare 1 */
      	@$nick1 = $_POST['nick1'];
      	@$kills1 = $_POST['kills1'];
      	@$deaths1 = $_POST['deaths1'];
      	/* Spelare 2 */
      	@$nick2 = $_POST['nick2'];
      	@$kills2 = $_POST['kills2'];
      	@$deaths2 = $_POST['deaths2'];
      	/* Spelare 3 */
      	@$nick3 = $_POST['nick3'];
      	@$kills3 = $_POST['kills3'];
      	@$deaths3 = $_POST['deaths3'];
      	/* Spelare 4 */
      	@$nick4 = $_POST['nick4'];
      	@$kills4 = $_POST['kills4'];
      	@$deaths4 = $_POST['deaths4'];
      	/* Spelare 5 */
      	@$nick5 = $_POST['nick5'];
      	@$kills5 = $_POST['kills5'];
      	@$deaths5 = $_POST['deaths5'];
      	/* Spelare 6 */
      	@$nick6 = $_POST['nick6'];
      	@$kills6 = $_POST['kills6'];
      	@$deaths6 = $_POST['deaths6'];
      	/* Spelare 7 */
      	@$nick7 = $_POST['nick7'];
      	@$kills7 = $_POST['kills7'];
      	@$deaths7 = $_POST['deaths7'];
      	/* Spelare 8 */
      	@$nick8 = $_POST['nick8'];
      	@$kills8 = $_POST['kills8'];
      	@$deaths8 = $_POST['deaths8'];
      	/* Spelare 9 */
      	@$nick9 = $_POST['nick9'];
      	@$kills9 = $_POST['kills9'];
      	@$deaths9 = $_POST['deaths9'];
      	/* Spelare 10 */
      	@$nick10 = $_POST['nick10'];
      	@$kills10 = $_POST['kills10'];
      	@$deaths10 = $_POST['deaths10'];

      	@$team1 = $_POST['team1'];
      	@$team2 = $_POST['team2'];

      	@$matchid = $_POST['matchid'];
        @$mvp = $_POST['mvp'];
        @$score = $_POST['score'];

      	if(isset($addstatsbtn)){
      		if($nick1 && $kills1 && $deaths1 && $nick2 && $kills2 && $deaths2 && $nick3 && $kills3 && $deaths3 && $nick4 && $kills4 && $deaths4 && $nick5 && $kills5 && $deaths5 && $nick6 && $kills6 && $deaths6 && $nick7 && $kills7 && $deaths7 && $nick8 && $kills8 && $deaths8 && $nick9 && $kills9 && $deaths9 && $nick10 && $kills10 && $deaths10 && $team1 && $team2 && $matchid && $mvp && $score){

      			$adminadd->CheckMatchId($matchid);
      			/* Lag 1 */

      			/* Spelare 1 */
      			if($adminadd->getPlayerStats($nick1) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick1,$kills1,$deaths1,$team1,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick1,$kills1,$deaths1,$team1,$score);
      			}
      			/* Spelare 2 */
      			if($adminadd->getPlayerStats($nick2) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick2,$kills2,$deaths2,$team1,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick2,$kills2,$deaths2,$team1,$score);
      			}
      			/* Spelare 3 */
      			if($adminadd->getPlayerStats($nick3) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick3,$kills3,$deaths3,$team1,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick3,$kills3,$deaths3,$team1,$score);
      			}
      			/* Spelare 4 */
      			if($adminadd->getPlayerStats($nick4) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick4,$kills4,$deaths4,$team1,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick4,$kills4,$deaths4,$team1,$score);
      			}	
      			
      			/* Spelare 5 */
      			if($adminadd->getPlayerStats($nick5) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick5,$kills5,$deaths5,$team1,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick5,$kills5,$deaths5,$team1,$score);
      			}

      			/* Lag 2 */
      			/* Spelare 6 */
      			if($adminadd->getPlayerStats($nick6) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick6,$kills6,$deaths6,$team2,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick6,$kills6,$deaths6,$team2,$score);
      			}
      			/* Spelare 7 */
      			if($adminadd->getPlayerStats($nick7) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick7,$kills7,$deaths7,$team2,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick7,$kills7,$deaths7,$team2,$score);
      			}
      			/* Spelare 8 */
      			if($adminadd->getPlayerStats($nick8) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick8,$kills8,$deaths8,$team2,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick8,$kills8,$deaths8,$team2,$score);
      			}
      			/* Spelare 9 */
      			if($adminadd->getPlayerStats($nick9) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick9,$kills9,$deaths9,$team2,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick9,$kills9,$deaths9,$team2,$score);
      			}
      			/* Spelare 10 */
      			if($adminadd->getPlayerStats($nick10) == 1){
      				$adminadd->addGamePlayerStats($matchid,$nick10,$kills10,$deaths10,$team2,$score);
      			}else{
      				$adminadd->addGamePlayerStats($matchid,$nick10,$kills10,$deaths10,$team2,$score);
      			}
				$adminadd->updateMatchStatus($score,$mvp,$matchid);
				$adminadd->updateTeamsPoints1($score,$team1);
				$adminadd->updateTeamsPoints2($score,$team2);
				
      			echo "<font color='green'>Statistiken är nu inlagt! </font>";

      	    }else{
      	    	echo "Du har inte fyllt i alla fält!";
      	    }
      	}
      	

      	?>
      	<form method="POST" action="addpstats.php" id="editinfo">
            <input type="text" id="addteam" class="matchid" required="" name="matchid" placeholder="Matchid..." />
            <input type="text" id="addteam" class="score" required="" name="score" placeholder="Score..." />
            <input type="text" id="addteam" class="mvp" required="" name="mvp" placeholder="MVP..." /> 
            <input type="text" id="addteam" class="team1" required="" name="team1" placeholder="Lag 1..." />
            <span class="playerstatsfix">Spelare1:</span><br />
            <input type="text" id="addpstats" class="nick1" required="" name="nick1" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills1" required="" name="kills1" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths1" required="" name="deaths1" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare2:</span><br />
            <input type="text" id="addpstats" class="nick2" required="" name="nick2" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills2" required="" name="kills2" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths2" required="" name="deaths2" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare3:</span><br />
            <input type="text" id="addpstats" class="nick3" required="" name="nick3" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills3" required="" name="kills3" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths3" required="" name="deaths3" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare4:</span><br />
            <input type="text" id="addpstats" class="nick4" required="" name="nick4" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills4" required="" name="kills4" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths4" required="" name="deaths4" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare5:</span><br />
            <input type="text" id="addpstats" class="nick5" required="" name="nick5" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills5" required="" name="kills5" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths5" required="" name="deaths5" placeholder="Deaths..." />
            <div class="line"></div><br />

           <input type="text" id="addteam" class="team2" required="" name="team2" placeholder="Lag 2..." />
            <span class="playerstatsfix">Spelare1:</span><br />
            <input type="text" id="addpstats" class="nick6" required="" name="nick6" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills6" required="" name="kills6" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths6" required="" name="deaths6" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare2:</span><br />
            <input type="text" id="addpstats" class="nick7" required="" name="nick7" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills7" required="" name="kills7" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths7" required="" name="deaths7" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare3:</span><br />
            <input type="text" id="addpstats" class="nick8" required="" name="nick8" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills8" required="" name="kills8" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths8" required="" name="deaths8" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare4:</span><br />
            <input type="text" id="addpstats" class="nick9" required="" name="nick9" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills9" required="" name="kills9" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths9" required="" name="deaths9" placeholder="Deaths..." />
            <span class="playerstatsfix">Spelare5:</span><br />
            <input type="text" id="addpstats" class="nick10" required="" name="nick10" placeholder="Nick..." />
            <input type="text" id="addpstats" class="kills10" required="" name="kills10" placeholder="Kills..." />
            <input type="text" id="addpstats" class="deaths10" required="" name="deaths10" placeholder="Deaths..." />
            <input type="submit" id="subteamadd" name="addstatsbtn" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Lägg till" />
      </form> 
    </div> 
  </div>
</div>

  <div id="footer">
    <span class="insidefooter">
    <?php
    echo $settings->getFooter();
    ?>
  </span>
  </div>
</body>
</html>