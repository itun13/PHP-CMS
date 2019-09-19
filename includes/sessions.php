<?php
session_start();
function Error(){
	if(isset($_SESSION["ErrorMessage"])){
		$output = "<div class= \"alert alert-danger\" >";
		$output .= htmlentities($_SESSION["ErrorMessage"]);
		$output .= "</div>";
		$_SESSION["ErrorMessage"] = null;
		return $output;
	}
}
function Success(){
	if(isset($_SESSION["successMessage"])){
		//var_dump($_SESSION["successMessage"]);die();
		$output = "<div class=\"alert alert-success\" >";
		$output .= htmlentities($_SESSION["successMessage"]);
		$output .= "</div>";
		// var_dump($_SESSION["successMessage"]);die();
		$_SESSION["successMessage"] = null;
		return $output;
	}
}
?>