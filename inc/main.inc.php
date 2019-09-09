<?php
session_start();
setlocale(LC_ALL, 'sv_SE');
include_once('config.inc.php');
include('sitesettings.inc.php');
include('players.inc.php');
include('matches.inc.php');
include('teams.inc.php');
include('stats.inc.php');
require('loginfunctions/steamauth.php');
require('loginfunctions/steamconfig.php');
require('loginfunctions/userfunctions.inc.php');
?>