<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
$admin->CheckSiteMsg();
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
  <link rel="stylesheet" href="../css/home.css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/mobile.js"></script>
    <script src="js/add.js"></script>
    <script>
    $(document).ready(function(){
    $('.modal').modal();
     });
    </script>
   
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
      <h5 class="upcomingMatchesTitle">Välkommen in <?php echo $_SESSION['loginsession']; ?></h5>
      <div class="matchesFix">

        <!--- Add match modal ---->
        <div id='add_match' class='modal'>
    <div class='modal-content' id="matchmodal">
      <h4>Lägg till en match</h4>
      <form method="POST" action="home.php" id="editinfo">
            <input type="text" id="editinput" class="team1" required="" name="team1" placeholder="Lag 1..." />
            <input type="text" id="editinput" class="team2" required="" name="team2" placeholder="Lag 2..." />
            <input type="text" id="editinput" class="status" required="" name="status" placeholder="Status..." />
            <input type="text" id="editinput" class="map" required="" name="map" title="Karta" placeholder="Karta..." />
            <input type="text" id="editinput" class="starttime" required="" name="starttime" placeholder="Starttid..." />
            <input type="text" id="editinput" class="startdate" required="" name="startdate" placeholder="Startdatum..." />
            <input type="text" id="editinput" class="league" required="" name="league" placeholder="Liga..." /><br />
            <input type="submit" id="submatchinfo" name="submatchinfo" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Lägg till" />
      </form> 
    </div>
    </div>
    <!---- End of match modal ----->

    <!--- Add player modal ---->
        <div id='add_player' class='modal'>
    <div class='modal-content' id="playermodal">
      <h4>Lägg till en spelare</h4>
      <form method="POST" action="home.php" id="editinfo">
            <input type="text" id="editinput" class="firstname" required="" name="firstname" placeholder="Förnamn..." />
            <input type="text" id="editinput" class="lastname" required="" name="lastname" placeholder="Efternamn..." />
            <input type="text" id="editinput" class="nickname" required="" name="nickname" placeholder="Nickname..." />
            <input type="text" id="editinput" class="born" required="" name="born" placeholder="Född..." />
            <input type="text" id="editinput" class="team" required="" name="team" placeholder="Lag..." />
            <input type="text" id="editinput" class="playerpicture" name="playerpicture" placeholder="Profil bild..." />
            <input type="text" id="editinput" class="twitter" required="" name="twitter" placeholder="Twitter..." />
            <input type="text" id="editinput" class="twitch" required="" name="twitch" placeholder="Twitch..." />
            <span class="standinfix">Standin:</span>
            <select name="standin" class="standin" required="">
              <option value="Ja" name="yes">Ja</option>
              <option value="Nej" name="no">Nej</option>
            </select>  
            <br />
            <input type="submit" id="subuseradd" name="submatchinfo" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Lägg till" />
      </form> 
    </div>
    </div>
    <!---- End of player modal ----->
    <!--- Add team modal ---->
    <div id='add_team' class='modal'>
    <div class='modal-content' id="teammodal">
      <h4>Lägg till ett lag</h4>
      <form method="POST" action="home.php" id="editinfo">
            <input type="text" id="addteam" class="teamname" required="" name="teamname" placeholder="Lagnamn..." />
            <input type="text" id="addteam" class="fullteamname" required="" name="fullteamname" placeholder="Fullt lagnamn..." />
            <input type="text" id="addteam" class="teamlogo" name="teamlogo" placeholder="Laglogo..." />
            <input type="submit" id="subteamadd" name="submatchinfo" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Lägg till" />
      </form> 
    </div>
    </div>
    <!---- End of team modal ----->

         <a class="waves-effect waves-light btn modal-trigger" href="#add_match" style="background-color: #1087e8; color: white;">Lägg till match</a>
         <a class="waves-effect waves-light btn modal-trigger" href="#add_player" style="background-color: #1087e8; color: white;">Lägg till spelare</a>
         <a class="waves-effect waves-light btn modal-trigger" href="#add_team" style="background-color: #1087e8; color: white;">Lägg till lag</a>
         <a class="waves-effect waves-light btn modal-trigger" href="addpstats.php" style="background-color: #1087e8; color: white;">Lägg till match statistik</a>
         <br />
         <div id="longbox">
          <div class="sitemsgbox">
          <?php
          @$msgbtn = $_POST['savemsg'];
          @$msg  = $_POST['sitemsg'];
          @$site_status = $_POST['sitestatus'];

          if(isset($msgbtn)){

            if($msg && $site_status){

              if($site_status == "Ja"){
                $site_status = 1;
                $admin->UpdateSiteMsg($msg,$site_status);
              }
              if($site_status == "Nej"){
                $site_status = 0;
                $admin->UpdateSiteMsg($msg,$site_status);
              }
            }

          }
          ?>  
          <form method="POST" action="home.php">
          <b>Meddelande på sidan:</b>
          <br />
            <input type="text" id="statustext" name="sitemsg" value="<?php echo $admin->getSiteMsg(); ?>" style="display: inline-block;" />
            <select name="sitestatus" class="statusmsg" required="">
              <?php
              if($admin->getSiteStatus() == 1){
                ?>
                <option value="Ja" name="yes" selected="">Ja</option>
              <?php
              }else{
                ?>
                <option value="Ja" name="yes">Ja</option>
              <?php
              }
              ?>

               <?php
              if($admin->getSiteStatus() == 0){
                ?>
                <option value="Nej" name="no" selected="">Nej</option>
              <?php
              }else{
                ?>
                <option value="Nej" name="no">Nej</option>
              <?php
              }
              ?>
            </select>  
             <input type="submit" id="subteamadd" name="savemsg" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
          </form>
          </div>
          <div class="updatematchscore">
            <b>Uppdatera aktivt matchscore</b>
            <?php
            @$savescorebtn = $_POST['savescore'];
            if(isset($savescorebtn)){

              $Updatematchid = $_POST['Updatematchid'];
              $scorematch = $_POST['scorematch'];

              if($Updatematchid && $scorematch){

                $admin->UpdateMatchScore($Updatematchid,$scorematch);

              }else{
                echo "Fel....";
              }

            }
            ?>
            <form method="POST" action="home.php">
              <input type="text" class="updateMatchid" id="scoreupdate" required="" name="Updatematchid" placeholder="Matchid"  />
              <input type="text" class="updateScore" id="scoreupdate" required="" name="scorematch" placeholder="Score"  /><br />
               <input type="submit" id="savescore" name="savescore" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Spara" />
            </form> 
          </div> 

        </div>

         
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