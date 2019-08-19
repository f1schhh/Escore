<?php
include 'inc/main.inc.php';
$settings = new SiteSettings();
$players = new Players();
$matches = new Matches();

if($settings->checkMaintenanace() == 1){
  header("location: maintenance/");
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?> - BETA</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Escore är en svensk e-sport plattform som rapporterar resultat och statistik där du få reda på resultat,statistik,information om spelare med mera!">
  <meta property="og:title" content="Escore.nu - är en svensk e-sport plattform som rapporterar resultat och statistik">
  <meta property="og:image" content="none">
  <meta property="og:site_name" content="Escore.nu">
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
  <link rel="icon" type="image/png" sizes="32x32" href="/img/logo-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="/img/logo-16x16.png" />
	<link rel="stylesheet" href="css/style.css" /> 
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/lightbox.js"></script>
  <script src="js/mobile.js"></script>
  <script src="js/autoupdate.js"></script>
  <script src="js/usersearch.js"></script>
  <style type="text/css">
      #leftmeny{
        padding-bottom: 150%;
      }
  </style>
            
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
      <a href="#"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>

                <div class="fixmobilepos">
                  <?php $settings->getMeny(); ?>
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">

              <?php $settings->getMeny(); ?>

            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->
		<div id="midcontent">
      <?php $settings->getSiteMessage(); ?>
      <div class="topindex">
      <div class="titlepos">
      <h4 class="upcomingMatchesTitle">Matcher</h4>
    </div>

      <div class="searchbar">
        <form method="POST" action="#">
          <input type="text" id="searchinput" name="searchtxt" placeholder="Sök efter en spelare..." />
          <div class="searchdown">
          <div class="search-content">
          </div>
        </div>
         </form>
      </div>
      </div>
      <div class="matchesfix" id="contentfix">

        <div class="matchInfo">
        <?php
        $matches->ShowMatchesFront();
        ?>
        </div>

        <div class="twitter">
          <a class="twitter-timeline" href="https://twitter.com/SECSGO?ref_src=twsrc%5Etfw" data-tweet-limit="2">Twitterflöde</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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

  <script src="js/jquery.timeago.js"></script>
</body>
</html>