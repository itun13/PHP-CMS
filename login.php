<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/database.php"); ?>
<?php
if(isset($_POST["submit"])){
	$userName = $_POST['name'];
	$password = $_POST['password'];
	if(empty($userName) || empty($password) ){
		$_SESSION["errorMessage"] = "All Fields are required";
		header("Location:login.php");
		die();
	}
	else{
		$foundAccount = login_attempt($userName,$password);
		$_SESSION["userId"]= $foundAccount["id"];
		$_SESSION["username"] = $foundAccount["username"];
		if($foundAccount){  
			$_SESSION["successMessage"] = "Log In successfull for userid".$_SESSION["userId"];
			header("Location:dashboard.php");
		}else{
			$_SESSION["errorMessage"] = "Incorrect Username or Password";
			header("Location:login.php");
		}	
	}
}	
?>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
</head>
<body>
<style type="text/css">
	.header{
		width: 100%;
		height: 40px;
		background-color: black;
	}
</style>
<div class="header" ></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4"></div>		<!-- Ending of the Side-Nav Bar -->
		<div class="col-sm-4"><!--   -->
			<?php
			//calling the session methods
					echo Error();
					echo Success();
			?>
			<h1>Log In</h1>
			<div>
			<!-- Form Section -->
				<form action="login.php" method="post">
					<fieldset>
						<div class="form-group">
							<label for="adminname"><span class="field_info">Name:</span></label>
							<input class="form-control" type="text" name="name" id="name" placeholder="Name">
							<br/>
							<label for="password"><span class="field_info">Password:</span></label>
							<input class="form-control" type="password" name="password" id="password" placeholder="Password">
							<br/>
							<input type="submit" name="submit" class="btn btn-success btn-lg "  value="Log In" >
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div><!-- Ending of the Container fluid -->
<div class="footer" ></div>
</body>
</html>