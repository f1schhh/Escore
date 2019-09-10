<?php
session_start();
setlocale(LC_ALL, 'sv_SE');
date_default_timezone_set("Europe/Stockholm");
include_once('config.inc.php');
include('sitesettings.inc.php');
include('players.inc.php');
include('matches.inc.php');
include('teams.inc.php');
include('stats.inc.php');
require('forallfunctions.inc.php');
require('deletefunctions.inc.php');
require('loginfunctions/steamauth.php');
require('loginfunctions/SteamConfig.php');
require('loginfunctions/userfunctions.inc.php');

$user = new User();
?>