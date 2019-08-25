<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$admin = new Admin();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);
$adminAdd = new AdminAdd();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$nickname = $_POST['nickname'];
$born = $_POST['born'];
$team = $_POST['team'];
$playerpicture = $_POST['playerpicture'];
$twitter = $_POST['twitter'];
$twitch = $_POST['twitch'];
$standin = $_POST['standin'];
$decrypt = "$firstname&$lastname&$nickname&$born&$team&$playerpicture&$twitch&$twitter&$standin";

parse_str($decrypt, $adduser);

if($firstname && $lastname && $nickname && $team){

	$adminAdd->addUser($adduser['firstname'],$adduser['lastname'],$adduser['nickname'],$adduser['born'],$adduser['team'],$adduser['playerpicture'],$adduser['twitch'],$adduser['twitter'],$adduser['standin']);


}else{
	echo "Alla fält är inte ifyllda";
}


?>