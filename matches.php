<?php
include 'inc/main.inc.php';
$settings = new SiteSettings();
$matches = new Matches();
$teams = new Teams();
if($settings->checkMaintenanace() == 1){
  header("location: maintenance/");
}
$id = $_GET['matchid'];
$matchid = str_replace("matches/", "", $id);

if($matchid == ""){
header("location: ../index.php");
}
$matches->getMatchInformation($matchid);
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
  <link href="../css/matches.css" rel="stylesheet" />
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
      <div class="matchesFix">
        <!----- Start på huvudet ---->
        <div class="fullmatchbox">
          <?php 
         
          ?>
          <a href="../teams/<?php echo $matches->getTeamOne(); ?>">
          <div class="team1"> 
            <img src="<?php echo $teams->TeamLogo($matches->getTeamOne()); ?>" class="logosize" /><br />
            <span class="teamname"><?php echo $matches->getTeamOne(); ?></span>
          </div>
          </a> 

          <div class="middleinfo">
            <center>
              
              <?php
              if($matches->getMatchStatus() == "live"){
                echo '<h4>'.$matches->getStartTime().'</h4>';  
                echo '<span class="startdate"> '.$matches->getStartDate().' '.$matches->getStartYear().'</span><br />';
                $live = '<font color="green">LIVE</font>';
                $show = "display: none";
              }else if($matches->getMatchStatus() == "upcoming"){
                echo '<h4>'.$matches->getStartTime().'</h4>';  
                echo '<span class="startdate"> '.$matches->getStartDate().' '.$matches->getStartYear().'</span><br />';
                
                $show = "display:none";
              }else if($matches->getMatchStatus() == "ended"){
                echo '<h4>'.$matches->getStartTime().'</h4>';  
                echo '<span class="startdate"> '.$matches->getStartDate().' '.$matches->getStartYear().'</span><br />';
                $show = "";
                $showpre = "display:none";
              }
              ?>
              
              <?php echo $matches->getMap(); ?><br />
              <span class="league">
              <?php if($matches->getLeague() == "SECSGO S3"){
               $league = "Svenska Eliteserien Höstsäsongen 2019"; 
               echo $league;
               }else{
                echo $matches->getleague();
              } 
              ?>
            </span>
              <br />
              <span class="currentScore"><?php echo $matches->getScore(); ?> </span>
              <h5><?php echo @$live; ?></h5>
            </center>
          </div> 
          <a href="../teams/<?php echo $matches->getTeamTwo(); ?>">
          <div class="team2">
            <img src="<?php echo $teams->TeamLogo($matches->getTeamTwo()); ?>" class="logosizeright" /><br />
            <span class="teamnameright"><?php echo $matches->getTeamTwo(); ?></span>
          </div> 
        </a>
        </div>
        <!---- Slut på live info ----->


        <!----- Stats med mera ----->

        <div class="statsBox" style="<?php echo @$show; ?>">
           <div class="statsinsidebox">
            <div class="insidelogo">
           <img src="<?php echo $teams->TeamLogo($matches->getTeamOne()); ?>" class="statslogo" />
            <span class="team1Logo"><?php echo $matches->getTeamOne(); ?></span> 
            </div>
            <div class="overstats">
              <span class="overtext">Kills</span>
            </div>
            <div class="overstats">
              <span class="overtext">Deaths</span>
            </div>
            <div class="overstats">
              <span class="overtext">
              <span class="kdtext">K/D Ratio</span>
            </span>
            </div>
            <div class="overstats" style="border-right: none;">
              <span class="overtext">
              <span class="kprtext">Kills per round</span>
            </span>
            </div>
          </div>
            <?php $matches->getMatchStatsTeamOne($matchid,$matches->getTeamOne(),$matches->getScoreForKR()); 
            ?> 
        </div>

        <!---- Team 2 ----->

         <div class="statsBox" style="<?php echo @$show; ?>">
           <div class="statsinsidebox">
            <div class="insidelogo">
           <img src="<?php echo $teams->TeamLogo($matches->getTeamTwo()); ?>" class="statslogo" />
            <span class="team1Logo"><?php echo $matches->getTeamTwo(); ?></span> 
            </div>
            <div class="overstats">
              <span class="overtext">Kills</span>
            </div>
            <div class="overstats">
              <span class="overtext">Deaths</span>
            </div>
            <div class="overstats">
              <span class="overtext">
              <span class="kdtext">K/D Ratio</span>
            </span>
            </div>
            <div class="overstats" style="border-right: none;">
              <span class="overtext">
              <span class="kprtext">Kills per round</span>
            </span>
            </div>
          </div>
            <?php $matches->getMatchStatsTeamTwo($matchid,$matches->getTeamOne(),$matches->getScoreForKR()); 
            ?> 
        </div>
      </div>
      <!--- Slutet på stats efter gamet ---->

      <!---- Start på prematch ----->
      <div class="matchesFix" style="<?php echo @$showpre; ?>">
         <div class="team1before">
            <img src="<?php echo $teams->TeamLogo($matches->getTeamOne()); ?>" class="logoposs" />
            <span class="team1Logo"><?php echo $matches->getTeamOne(); ?></span> 
         </div>
      
         <div class="playersteam1">
          <center>
          <?php $matches->getLineup($matches->getTeamOne(), $matchid); ?>
        </center>
         </div>

    </div>

     <div class="matchesFix" style="<?php echo @$showpre; ?>">
         <div class="team1before">
            <img src="<?php echo $teams->TeamLogo($matches->getTeamTwo()); ?>" class="logoposs" />
            <span class="team1Logo"><?php echo $matches->getTeamTwo(); ?></span> 
         </div>

         <div class="playersteam1">
          <center>
          <?php $matches->getLineup($matches->getTeamTwo(), $matchid); ?>
        </center>
         </div>

    </div>

    <!----- Slut på prematch ---->

    <!--- Visa mvp of the match ---->
    <div class="matchesFix" style="<?php echo $show;?>">
      <div class="mvptitle"><span class="team1Logo">Mest värdefulla spelare</span></div> <br />
      <div class="mvpbox">
        <?php
        $matches->showMVP($matchid,$matches->getScoreForKR()); 
        ?>    
      </div>  
    </div>  
    <!----- Slut----->
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