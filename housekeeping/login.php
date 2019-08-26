<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$admin->IfalreadyInlogged($_SESSION['loginsession']);
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
                  
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo"><div class="mainlogo"></div></div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">

              

            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->
		<div id="midcontent">
      <h4 class="upcomingMatchesTitle">Logga in</h4>
      <div class="matchesFix">

        <?php
        @$username = $_POST['username'];
        @$password = $_POST['password'];
        @$subbtn = $_POST['subbtn'];

        if(isset($subbtn)){

          if($username && $password){
            $admin->login($username,$password);
          }else{
              echo "Du har inte fyllt i alla fält...";
          }
        }
        ?>

        <form method="POST" action="login.php">

          <input type="text" class="username" id="login" required="" name="username" placeholder="Användarnamn..." />
          <input type="password" class="password" id="login" required="" name="password" placeholder="Lösenord..." />
          <input type="submit" name="subbtn" class="waves-effect waves-light btn" style="background-color: #1087e8; color: white;" value="Logga in" />

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