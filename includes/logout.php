<?php session_start(); ?>
<?php

$_SESSION['user_name'] = null;
$_SESSION['user_firstname'] = null;
$_SESSION['user_lastname'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_id'] = null;
$_SESSION['user_randsalt'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");