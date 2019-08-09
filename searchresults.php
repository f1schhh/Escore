<?php
include('inc/main.inc.php');
$players = new Players();
$searchresult = $_POST['searchtxt'];

if($players == ""){

}else{
	$players->SearchForPlayer($searchresult);
}
?>