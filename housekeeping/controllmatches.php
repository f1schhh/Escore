<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
$adminmatches = new AdminMatches();
$teams = new Teams();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
@$page = $_GET['page'];
if(isset($_GET['page'])){

  @$page = $_GET['page'];

}else{
  $page = 1;
  
}
@$matchid = $_GET['matchid'];
?>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?> - Housekeeping</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
	<link rel="stylesheet" href="../css/style.css" /> 
  <link rel="stylesheet" href="../css/admin.css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/mobile.js"></script>
    <script src="../js/formedit.js"></script>
            
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
            <div id="meny-content">

              <?php
              echo $adminsettings->AdminMeny();
              ?>

            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->

		<div id="midcontent">
      <h5 class="upcomingMatchesTitle">Match Information</h5>
      <div class="matchesFix">
            <?php
            if($adminmatches->CheckMatchId($matchid) == 1){
              $adminmatches->getAllMatchInfo($matchid);
             ?>
             <div class="editmatches">
              <?php
              @$submatchinfo = $_POST['submatchinfo'];
              @$team1 = $_POST['team1'];
              @$team2 = $_POST['team2'];
              @$matchstatus = $_POST['matchstatus'];
              @$map = $_POST['map'];
              @$starttime = $_POST['starttime'];
              @$startdate = $_POST['startdate'];
              @$matchscore = $_POST['matchscore'];
              @$mvp = $_POST['mvp'];
              @$stream = $_POST['stream'];


              if(isset($submatchinfo)){
                if($team1 && $team2 && $matchstatus && $starttime && $startdate && $matchscore){
                  $adminmatches->saveMatchInfo($matchid, $team1, $team2, $matchstatus, $map, $matchscore, $starttime, $startdate, $stream, $mvp);
                }
              }
              ?>
             <form method="POST" action="controllmatches.php?matchid=<?php echo $matchid; ?>" id="editinfo">

              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Lag 1..." value="<?php echo $adminmatches->getTeamOne(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team2" placeholder="Lag 2..." value="<?php echo $adminmatches->getTeamTwo(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="matchstatus" placeholder="Status..." value="<?php echo $adminmatches->getMatchStatus(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="map" title="Karta" placeholder="Karta..." value="<?php echo $adminmatches->getMap(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="starttime" placeholder="Starttid..." value="<?php echo $adminmatches->getStartTime(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="startdate" placeholder="Startdatum..." value="<?php echo $adminmatches->getStartDate(); ?>" />
              <input type="text" id="editinput"  name="matchscore" placeholder="Score..." value="<?php echo $adminmatches->getScore(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="mvp" placeholder="MVP..." value="<?php echo $adminmatches->getMVP(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="stream" placeholder="Stream..." value="<?php echo $adminmatches->getStream(); ?>" />
              <input type="text" id="editinput" class="matchinfo" placeholder="Matchid..." value="<?php echo $adminmatches->getMatchId(); ?>" readonly/><br />
              <input type="submit" id="submatchinfo" name="submatchinfo" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
             </form> 

             <div class="line"></div>
             <h5>Lineup</h5>
             <?php
             @$sublineup = $_POST['sublineup'];
             @$player1 = $_POST['player1'];
             @$player2 = $_POST['player2'];
             @$player3 = $_POST['player3'];
             @$player4 = $_POST['player4'];
             @$player5 = $_POST['player5'];
             @$player6 = $_POST['player6'];
             @$player7 = $_POST['player7'];
             @$player8 = $_POST['player8'];
             @$player9 = $_POST['player9'];
             @$player10 = $_POST['player10'];

             if(isset($sublineup)){
              if($player1 && $player2 && $player3 && $player4 && $player5 && $player6 && $player7 && $player8 && $player9 && $player10){
                $adminmatches->saveLineUp($matchid,$adminmatches->getTeamOne(),$player1,$player2,$player3,$player4,$player5,$adminmatches->getTeamTwo(),$player6,$player7,$player8,$player9,$player10);
              }else{
                echo "Alla fält är inte ifyllda...";
              }
             }
             ?>
             <form method="POST" action="controllmatches.php?matchid=<?php echo $matchid; ?>" id="editlineup"> 
             <div class="teamlineup">
             <img src="<?php echo $teams->TeamLogo($adminmatches->getTeamOne()); ?>" class="statslogo" />
             <span class="team1Logo"><?php echo $adminmatches->getTeamOne(); ?></span> 
             </div>
             <?php 
             $adminmatches->ShowLineUpTeam1($matchid,$adminmatches->getTeamOne());
             ?>
             <input type="text" id="editinput" class="matchinfo" name="player1" placeholder="Spelare 1..." value="<?php echo $adminmatches->player1(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player2" placeholder="Spelare 2..." value="<?php echo $adminmatches->player2(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player3" placeholder="Spelare 3..." value="<?php echo $adminmatches->player3(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player4" placeholder="Spelare 4..." value="<?php echo $adminmatches->player4(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player5" placeholder="Spelare 5..." value="<?php echo $adminmatches->player5(); ?>" />
             <div class="teamlineup">
             <img src="<?php echo $teams->TeamLogo($adminmatches->getTeamTwo()); ?>" class="statslogo" />
             <span class="team1Logo"><?php echo $adminmatches->getTeamTwo(); ?></span> 
             </div>
             <?php
             $adminmatches->ShowLineUpTeam2($matchid,$adminmatches->getTeamTwo());
             ?>
             <input type="text" id="editinput" class="matchinfo" name="player6" placeholder="Spelare 1..." value="<?php echo $adminmatches->player6(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player7" placeholder="Spelare 2..." value="<?php echo $adminmatches->player7(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player8" placeholder="Spelare 3..." value="<?php echo $adminmatches->player8(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player9" placeholder="Spelare 4..." value="<?php echo $adminmatches->player9(); ?>" />
             <input type="text" id="editinput" class="matchinfo" name="player10" placeholder="Spelare 5...." value="<?php echo $adminmatches->player10(); ?>" />
             <br />
             <input type="submit" name="sublineup" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
           </form>
           </div>

            <?php
            }else{
              ?>
        <div class="showAllMatches">
        <?php
        if(empty($page)){
              header("location: controllmatches.php?page=1");
            }else{
               if(is_numeric($page)){
                 $adminmatches->AllMatches($page);
                 $adminmatches->AllMatchesMeny($page);
            }
          }
        ?>
       </div> 
       <?php
            } 
       ?>

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