<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$admin = new Admin();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
$adminAdd = new AdminAdd();

$team1 = $_POST['team1'];
$team2 = $_POST['team2'];
$status = $_POST['status'];
$map = $_POST['map'];
$starttime = $_POST['starttime'];
$startdate = $_POST['startdate'];
$league = $_POST['league'];

$decrypt = "$team1&$team2&$status&$map&$starttime&$startdate&$league";

parse_str($decrypt, $addmatch);

if($team1 && $team2 && $status && $map && $starttime && $startdate && $league){

	$adminAdd->addMatches($addmatch['team1'],$addmatch['team2'],$addmatch['status'],$addmatch['map'],$addmatch['starttime'],$addmatch['startdate'],$addmatch['league'],);


}else{
	echo "Alla fält är inte ifyllda";
}


?>