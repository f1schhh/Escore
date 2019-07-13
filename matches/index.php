<?php
include '../inc/main.inc.php';
$settings = new SiteSettings();
$matches = new Matches();
$matchid = $_GET['matchid'];
if($matchid == ""){
header("location: ../index.php");
}
$matches->getMatchInformation($matchid);
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
        <!----- Start på huvudet ---->
        <div class="fullmatchbox">

          <div class="team1"> 
            <img src="https://static.hltv.org/images/team/logo/9735" class="logosize" /><br />
            <span class="teamname"><?php echo $matches->getTeamOne(); ?></span>
          </div> 

          <div class="middleinfo">
            <center>
              <h4> 
              <?php
              if($matches->getMatchStatus() == "live"){
                echo '<font color="green">LIVE</font>';
                $show = "display: none";
              }else if($matches->getMatchStatus() == "upcoming"){
                echo $matches->getStartTime(); 
                $show = "display:none";
              }else if($matches->getMatchStatus() == "ended"){
                echo '<font color="red">Avslutad</font>';
                $show = "";
                $showpre = "display:none";
              }
              ?>
              </h4>
              <span class="currentScore"><?php echo $matches->getScore(); ?> </span><br />
              <?php echo $matches->getMap(); ?><br />
              <img src="http://www.secsgo.se/wp-content/uploads/2018/04/iel_large.png" style="width: 64px; height: 64px;">
            </center>
          </div>  
          
          <div class="team2">
            <img src="https://static.hltv.org/images/team/logo/8930" class="logosize" style="float: right;" /><br />
            <span class="teamnameright"><?php echo $matches->getTeamTwo(); ?></span>
          </div> 
        </div> 
        <!---- Slut på live info ----->


        <!----- Stats med mera ----->

        <div class="statsBox" style="<?php echo @$show; ?>">
           <img src="https://static.hltv.org/images/team/logo/9735" style="width: 32px; height: 32px; position: relative; top: 5px; left: 4px" />
            <span class="team1Logo"><?php echo $matches->getTeamOne(); ?></span> 
            <div class="line"></div>
            <?php $matches->getMatchStatsTeamOne($matchid,$matches->getTeamOne()); 
            ?> 
        </div>

        <!---- Team 2 ----->

         <div class="statsBox" style="<?php echo @$show; ?>">
           <img src="https://static.hltv.org/images/team/logo/8930" style="width: 32px; height: 32px; position: relative; top: 5px; left: 4px" />
            <span class="team1Logo"><?php echo $matches->getTeamTwo(); ?></span> 
            <div class="line"></div>
            <?php $matches->getMatchStatsTeamTwo($matchid,$matches->getTeamTwo()); ?> 
        </div>
      </div>
      <!--- Slutet på stats efter gamet ---->

      <!---- Start på prematch ----->
      <div class="matchesFix" style="<?php echo @$showpre; ?>">
         <div class="team1before">
            <img src="https://static.hltv.org/images/team/logo/9735" style="width: 32px; height: 32px; position: relative; top: 5px; left: 4px" />
            <span class="team1Logo">Lilmix</span> 
         </div>

       
         <div class="playersteam1">
             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px; " />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>
         </div>

    </div>

     <div class="matchesFix" style="<?php echo @$showpre; ?>">
         <div class="team1before">
            <img src="https://static.hltv.org/images/team/logo/8930" style="width: 32px; height: 32px; position: relative; top: 5px; left: 4px" />
            <span class="team1Logo">Granit</span> 
         </div>

         <div class="playersteam1">
             <div class="playerpicture" style="margin-left: none;"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px; " />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>

             <div class="playerpicture"><img src="https://i.gyazo.com/c0367e02e4e053b0912614549576b279.png" style="max-width: 100%; max-height: 100%; padding: 10px;" />
              <span class="playernickname">b0denmaster</span>
             </div>
         </div>

    </div>


    <div class="matchesFix" style="<?php echo $show;?>">
      <div class="mvptitle"><span class="team1Logo">Mest värdefulla spelare</span></div> <br />
      <div class="mvpbox">
        <?php
        $matches->showMVP($matchid); 
        ?>    
      </div>  
    </div>  

    <!----- Slut på prematch ---->


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