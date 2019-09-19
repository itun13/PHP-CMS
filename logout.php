<?php require_once("includes/sessions.php"); ?>
<?php 
$_SESSION['userId'] = null;
session_destroy();
header("Location:login.php");
?>