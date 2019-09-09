<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$adminsettings = new AdminSettings();
$adminadd = new AdminAdd();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);

$adminadd->updateTeamsPoints1("11-16","EsportsAdviser");
$adminadd->updateTeamsPoints2("11-16","lilmix");
?>