<?php
include '../inc/main.inc.php';
$settings = new SiteSettings();

?>
<html lang="sv">
<head>
	<title>lOGO</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/style.css" /> 
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <link href="../css/player.css" rel="stylesheet" />
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
            <img src="https://cdn3.iconfinder.com/data/icons/mini-icon-set-general-office/91/General_-_Office_30-512.png"
        style="width: 56px; height: 56px;">
      </a>

      </div>
      <a href="#"><div id="logo">Logo</div></a>

                <div class="fixmobilepos">
                  <?php $settings->getMenyOutside(); ?>
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo">Logo</div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">
              <?php $settings->getMenyOutside(); ?>
            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->
		<div id="midcontent">
      <div class="matchesFix">
        <div class="playerprofile">
          <div class="playerimg">
          <a href="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" data-lightbox="Player"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" class="playerImgSrc" /></a>
        </div>
          <div class="userinfobox" style="margin-top: 0px;">
              <span class="nickname"> Jonathan "<b>b0denmaster</b>" Bodenmalm </span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> Ålder <b>21</b></span><br />
           </div>
           <div class="userinfobox">
              <span class="nickname"> K/D Ratio <b>1.62</b> </span><br />
           </div>
        </div> 
        <div class="playerMeny">
          <div class="playerMenyFix">
          <a href="" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;"> Matcher</a>
          <a href="" class="waves-effect waves-light btn buttoncolor" style="display: inline-block; background-color: #1087e8;">  Statistik</a>
        </div>
      </div>
    </div>



        <!---InTE LäNGRE nEr----->
        </div>  

      </div>

    </div> 
  </div>

  <div id="footer">

  </div>

  <script src="js/jquery.timeago.js"></script>
</body>
</html>