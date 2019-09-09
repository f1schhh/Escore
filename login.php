<?php
include('inc/main.inc.php');
require('inc/loginfunctions/userInfo.php');
$user = new User();
if($_SESSION['steam_steamid'] == ""){
	header("location: index.php");
}else{
	$user->LoginUser($_SESSION['steam_steamid'],$_SESSION['steam_personaname'],$_SESSION['steam_avatarfull']);
}
?>