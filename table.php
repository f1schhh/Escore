<?php
include 'inc/main.inc.php';
$settings = new SiteSettings();
$players = new Players();
$stats = new Stats();
if($settings->checkMaintenanace() == 1){
  header("location: ../maintenance/");
}
?>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?> </title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Escore är en svensk e-sport plattform som rapporterar resultat och statistik där du få reda på resultat,statistik,information om spelare med mera!">
  <meta property="og:title" content="Escore.nu - är en svensk e-sport plattform som rapporterar resultat och statistik">
  <meta property="og:image" content="../img/mainlogo.png">
  <meta property="og:site_name" content="Escore.nu">
  <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
  <link rel="icon" type="image/png" sizes="32x32" href="../img/logo-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="../img/logo-16x16.png" />
	<link rel="stylesheet" href="../css/style.css" /> 
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <link href="../css/stats.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/mobile.js"></script>
    <script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4862063650191114",
    enable_page_level_ads: true
  });
  </script>
    <script>
    $(document).ready(function(){
    $('.modal').modal();
     });
    </script>
    <style type="text/css">
    th{
      border-right: 1px solid rgba(0,0,0,0.12);
    }
    .leaderboardtabell{
      width: 100%; 
      border: 1px solid #e3e3e3;
      color: #4e4e4e;
      background: whitesmoke;
    }
    .teamlogol{
      width: 24px; 
      height: 24px; 
      position:relative; 
      top: 5px;
    }
    @media screen and (max-width:400px){
      .leaderboardtabell{
        font-size: 1em;
      }
    }
    @media screen and (max-width:360px){
      .leaderboardtabell{
        font-size: 0.85em;
      }

    }
    </style>        
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
      <a href="../index.php"><div id="logo"><div class="mainlogo"></div></div></a>

                <div class="fixmobilepos">
                  <?php $settings->getMenyOutside(); ?>
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="../index.php"><div id="logo"><div class="mainlogo"></div></div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">
              <?php $settings->getMenyOutside(); ?>
            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->
		<div id="midcontent">
      <h4 class="upcomingMatchesTitle">Tabellen</h4>
      <div class="matchesFix">
      <table class="leaderboardtabell">
      <tr>
        <th>Lagnamn</th>
        <th>Spelade matcher</th>
        <th>W-L</th>
        <th>Rundskillnad</th>
        <th>Poäng</th>
      </tr>
      <tr>
        <?php
        $stats->getTeamLeaderboard();
        ?>
      </table>


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