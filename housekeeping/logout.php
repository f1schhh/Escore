<?php
include '../inc/main.inc.php';
include '../inc/admin.inc.php';
$settings = new SiteSettings();
$admin = new Admin();
$admin->CheckIfUserIsInlogged($_SESSION['loginsession']);

session_destroy();
header("location: ../index.php");
?>