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
            <img src="https://cdn3.iconfinder.com/data/icons/mini-icon-set-general-office/91/General_-_Office_30-512.png"
        style="width: 56px; height: 56px;">
      </a>

      </div>
      <a href="login.php"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>

                <div class="fixmobilepos">
              <?php
              echo $adminsettings->AdminMeny();
              ?>
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>
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
             <form method="POST" action="controllmatches.php?matchid=<?php echo $matchid; ?>">

              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Lag 1..." value="<?php echo $adminmatches->getTeamOne(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Lag 2..." value="<?php echo $adminmatches->getTeamTwo(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Status..." value="<?php echo $adminmatches->getMatchStatus(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Karta..." value="<?php echo $adminmatches->getMap(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Starttid..." value="<?php echo $adminmatches->getStartTime(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Startdatum..." value="<?php echo $adminmatches->getStartDate(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Score..." value="<?php echo $adminmatches->getScore(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="MVP..." value="<?php echo $adminmatches->getMVP(); ?>" />
              <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Matchid..." value="<?php echo $adminmatches->getMatchId(); ?>" />
              <input type="submit" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
             </form> 

             <div class="line"></div>
             <h5>Lineup</h5>
             <form>
             <div class="teamlineup">
             <img src="<?php echo $teams->TeamLogo($adminmatches->getTeamOne()); ?>" class="statslogo" />
             <span class="team1Logo"><?php echo $adminmatches->getTeamOne(); ?></span> 
             </div>

             <?php 
             $adminmatches->ShowLineUpTeam1($matchid,$adminmatches->getTeamOne());
             ?>
             <div class="teamlineup">
             <img src="<?php echo $teams->TeamLogo($adminmatches->getTeamTwo()); ?>" class="statslogo" />
             <span class="team1Logo"><?php echo $adminmatches->getTeamTwo(); ?></span> 
             </div>
             <?php
             $adminmatches->ShowLineUpTeam2($matchid,$adminmatches->getTeamTwo());
             ?>
             <br />
             <input type="submit" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
           </form>
           </div>

            <?php
            }else{
              ?>
        <div class="showAllMatches" style="<?php echo @$showm; ?>">
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