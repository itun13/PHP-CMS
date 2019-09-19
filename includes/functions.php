<?php require_once("includes/sessions.php"); ?>
<?php require_once("database.php"); ?>
<?php



function Redirect_to($new_Location){

	header("Location:".$new_Location);
}




function login_attempt($userName,$password){

	$database1= new Database();
	$database1->conn;
	$sql = "SELECT * FROM registration WHERE username = '$userName' AND password = '$password'";
	$execute = mysqli_query($database1->conn,$sql);
	if($admin = $execute->fetch_assoc()){

		return $admin;
	}else{
		return false;
	}

}




function login(){
	if(isset($_SESSION["userId"])){
		return true;
	}
}



function confirm_login(){
	if(!login()){
		$_SESSION["errorMessage"] = 'Login Required';
		Redirect_to('login.php');

	}

}


?>