<?php
include 'inc/main.inc.php';
$settings = new SiteSettings();
$players = new Players();
$stats = new Stats();
if($settings->checkMaintenanace() == 1){
  header("location: maintenance/");
}
$statsid = $_GET['statsid'];
$statsen = str_replace("stats/", "", $statsid);
?>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?></title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="sv" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/style.css" /> 
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <link href="../css/stats.css" rel="stylesheet" />
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
      <a href="#"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>

                <div class="fixmobilepos">
                  <?php $settings->getMenyOutside(); ?>
              </div>
       
      <!--- Slut av mobilmeny--->
      


    </div> 

    <!----- Start utav menyn ------->

		<div id="leftmeny">
			<a href="#"><div id="logo"><?php echo $settings->getTitle(); ?></div></a>
			<div class="info-text"> 
				        
            </div>
            <div id="meny-content">
              <?php $settings->getMenyOutside(); ?>
            </div>
		</div>
    <!----Slut utav menyn----->

    <!----Start utav mid content----->
		<div id="midcontent">
      <h4 class="upcomingMatchesTitle">Statistik</h4>
      <div class="matchesFix">
        <div id="fullstats">
          <?php 

          if($statsen == "kd"){
            ?>
            <div class="bykd" style="width: 100%">
            <br />
            <span class="statsfix">Alla spelares K/D Statistik
            <div></div> 
            </span>
            <div class="line"></div>  
            <?php $stats->getFullKd(); ?>
            </div> 
            <?php
          }else{
            if($statsen == "kr"){
              ?>
            <div class="bykd" style="width: 100%">
            <br />
            <span class="statsfix">Alla spelares K/R Statistik
            <div></div> 
            </span>
            <div class="line"></div>  
            <?php $stats->getFullKR(); ?>
            </div>
              <?php
            }else{
              if($statsen == "kills"){
                ?>
            <div class="bykd" style="width: 100%">
            <br />
            <span class="statsfix">Statistik över alla spelares kills
            <div></div> 
            </span>
            <div class="line"></div>  
            <?php $stats->getFullKills(); ?>
            </div>
                <?php
              }else{
                if($statsen == "deaths"){
                ?>
            <div class="bykd" style="width: 100%">
            <br />
            <span class="statsfix">Statistik över alla spelares deaths
            <div></div> 
            </span>
            <div class="line"></div>  
            <?php $stats->getFullDeaths(); ?>
            </div>
            <?php
            }else{
              if($statsen == "matches"){
            ?>
            <div class="bykd" style="width: 100%">
            <br />
            <span class="statsfix">Statistik över alla spelares deaths
            <div></div> 
            </span>
            <div class="line"></div>  
            <?php $stats->getFullMatches(); ?>
            </div>
            <?php
            }else{
            ?> 
            <!---- Kill / death ratio ----->
            <div class="bykd">
            <br />
            <span class="statsfix">Top 5 K/D Spelarna <a href="kd" class="all" style="float: right; margin-right: 5px;">Visa alla</a>
              <div>
              </div>
            </span>
            <div class="line"></div>  
            <?php $stats->getStatsKD(); ?>
            </div> 
            <!--- Kills per round ----->
            <div class="bykd">
            <br />
            <span class="statsfix">Top 5 K/R Spelarna <a href="kr" class="all" style="float: right; margin-right: 5px;">Visa alla</a>
              <div>
              </div>
            </span>
            <div class="line"></div> 
            <?php $stats->getStatsKR(); ?>

                 </div>  

                 <!--- Total kills---->
            <div class="bykd">
            <br />
            <span class="statsfix">Top 5 Mest kills <a href="kills" class="all" style="float: right; margin-right: 5px;">Visa alla</a>
              <div>
              </div>
            </span>
            <div class="line"></div> 
            <?php $stats->getStatsKills(); ?>

            </div>


            <!--- Deaths ---->
            <div class="bykd">
            <br />
            <span class="statsfix">Top 5 mest antal deaths <a href="deaths" class="all" style="float: right; margin-right: 5px;">Visa alla</a>
              <div>
              </div>
            </span>
            <div class="line"></div> 
            <?php $stats->getStatsDeaths(); ?>

            </div>
            <!--- Matcher ---->
            <div class="bykd">
            <br />
            <span class="statsfix">Top 5 mest spelade matcher <a href="matches" class="all" style="float: right; margin-right: 5px;">Visa alla</a>
              <div>
              </div>
            </span>
            <div class="line"></div> 
            <?php $stats->getStatsMatches(); ?>

            </div>      
                <?php
              }
            }
          }
        }
      }
          ?> 

            </div> 
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

  <script src="js/jquery.timeago.js"></script>
</body>
</html>