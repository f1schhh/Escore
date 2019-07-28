<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
$adminplayers = new AdminPlayers();
$teams = new Teams();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
@$page = $_GET['page'];
if(isset($_GET['page'])){

  @$page = $_GET['page'];

}else{
  $page = 1;
  
}
@$nickname = $_GET['nickname'];
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
      <h5 class="upcomingMatchesTitle">Alla spelare</h5>
      <div class="matchesFix">
        <?php 
        if($adminplayers->CheckPlayer($nickname) == 1){
          $adminplayers->getAllPlayerInfo($nickname);

        ?>
        <form method="POST" action="controllmatches.php?matchid=" id="editinfo">
              <input type="text" id="editinput" class="matchinfo" name="firstname" placeholder="Förnamn..." value="<?php echo $adminplayers->getFirstName(); ?>" />
        </form> 
        <?php
        }else{
        ?>
        <div id="allplayersshow">
        <?php
        if(empty($page)){
              header("location: controllplayers.php?page=1");
            }else{
               if(is_numeric($page)){
                 $adminplayers->allPlayers($page);
                 ?>
                 <br /><br />
                 <?php
                 $adminplayers->AllPlayersMeny($page);
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