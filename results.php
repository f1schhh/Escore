<?php
include 'inc/main.inc.php';
$settings = new SiteSettings();
$matches = new Matches();
if($settings->checkMaintenanace() == 1){
  header("location: maintenance/");
}
@$page = $_GET['page'];
@$pageid = str_replace("results/", "", $page);
if(isset($_GET['page'])){

	  @$page = $_GET['page'];
    @$pageid = str_replace("results/", "", $page);

}else{
	$page = 1;
}
?>
<html lang="sv">
<head>
	<title><?php echo $settings->getTitle(); ?></title>
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
  <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
	<link rel="stylesheet" href="../css/style.css" /> 
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet" />
  <link href="../css/results.css" rel="stylesheet" />
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
            <img src="../img/icons/mobilebtn.png"
        style="width: 56px; height: 56px;">
      </a>

      </div>
      <a href="#"><div id="logo"><div class="mainlogo"></div></div></a>

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
		<h4 class="upcomingMatchesTitle">Tidigare resultat</h4>
        <div class="matchesFix">
        	<?php 
        	$matches->AllMatches($pageid);
        	$matches->AllMatchesMeny($pageid);
        	?>

        </div>

        </div> 
        

    <!--- Slut utav mid content----> 

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