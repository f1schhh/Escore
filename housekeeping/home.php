<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
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
      <h4 class="upcomingMatchesTitle">Välkommen in <?php echo $_SESSION['loginsession']; ?></h4>
      <div class="matchesFix">

        <!--- Add match modal ---->
        <div id='add_post' class='modal'>
    <div class='modal-content'>
      <h4>Lägg till en match</h4>
      <form method="POST" action="home.php" id="editinfo">
            <input type="text" id="editinput" class="matchinfo" name="team1" placeholder="Lag 1..." />
            <input type="text" id="editinput" class="matchinfo" name="team2" placeholder="Lag 2..." />
            <input type="text" id="editinput" class="matchinfo" name="matchstatus" placeholder="Status..." />
            <input type="text" id="editinput" class="matchinfo" name="map" title="Karta" placeholder="Karta..." />
            <input type="text" id="editinput" class="matchinfo" name="starttime" placeholder="Starttid..." />
            <input type="text" id="editinput" class="matchinfo" name="startdate" placeholder="Startdatum..." />
            <input type="text" id="editinput" class="matchinfo" name="startdate" placeholder="Liga..." /><br />
            <input type="submit" id="submatchinfo" name="submatchinfo" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Lägg till" />
      </form> 
    </div>
    </div>
    <!---- End of match modal ----->
        <a class="waves-effect waves-light btn modal-trigger" href="#add_post" style="background-color: #1087e8; color: white;">Lägg till match</a>
         <a href="#" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;">Lägg till spelare</a>
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