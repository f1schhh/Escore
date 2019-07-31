<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$admin = new Admin();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
$adminAdd = new AdminAdd();

$teamname = $_POST['teamname'];
$fullteamname = $_POST['fullteamname'];
$teamlogo = $_POST['teamlogo'];
$decrypt = "$teamname&$fullteamname&$teamlogo";

parse_str($decrypt, $addteam);

if($teamname && $fullteamname){

	$adminAdd->addTeam($addteam['teamname'],$addteam['fullteamname'],$addteam['teamlogo']);
	


}else{
	echo "Alla fält är inte ifyllda";
}


?>