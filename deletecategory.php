<?php require_once("includes/sessions.php"); ?>
<?php require_once('includes/database.php');?>
<?php
	if(isset($_GET['id'])){
		$idFromURL = $_GET['id'];
		$db4 = new Database();
		$db4->conn;
		$query = "DELETE FROM category WHERE id = '$idFromURL'";
		$execute = mysqli_query($db4->conn,$query);
		if($execute){
			$_SESSION['successMessage'] = 'Category Successfully Deleted';
			header("Location:categories.php");
		}else{
			$_SESSION['errorMessage'] = "Something Went Wrong. Try Again!";
			header("Location:categories.php");
		}
	}
?>