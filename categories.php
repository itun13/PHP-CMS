<?php require_once('includes/database.php');?>
<?php require_once("includes/sessions.php"); ?>
<?php
	if(isset($_POST["submit"])){
		$category = $_POST['category'];
		//set default timezone to kolkata
		date_default_timezone_set("Asia/Kolkata");
		$currentTime = time();
		$DateTime = strftime("%B-%d-%Y %H:%M:%S" ,$currentTime);
		//Store username in admin variable
		$admin = $_SESSION["username"];
		//Check if Category is empty
		if(empty($category)){
			$_SESSION["ErrorMessage"] = "All fields must be filled out";
			header("Location:dashboard.php");
		}
		//check if category name length is greater than 100
		elseif(strlen($category)>100){
			$_SESSION["ErrorMessage"] = "Too long name";
			header("Location: categories.php");
		}
		else{
			$a = new Database();
			$a->conn;
			$query = "INSERT INTO category(date_time,name,creatorname) VALUES('$DateTime','$category','$admin')";
			$execute = mysqli_query($a->conn,$query);
			if($execute){
				$_SESSION["successMessage"] = "Category added succesfully";
				header("Location: dashboard.php");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong with the query";
				header("Location:categories.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
</head>
<body>
	<div style=" height:10px; background-color: #806d7a;"></div>
	<nav class="navbar" role="navigation" style="margin: 0px;">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toogle collapsed" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle Naviagtion</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- For the logo of the website -->
				<a class="navbar-brand" href="blog.php"><p class="logo-section" style="font-size: 35px;">TRAVOY</p></a>
			</div>
			<div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav collapsed">
					<li class="active"><a href="blog.php" target="_blank">Home</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Feature</a></li>
				</ul>
			</div>
		</div>
		<div style=" height:10px; background-color:	#806d7a;"></div>
	<div class="container-fluid">
		<div class="row">
			<!-- The Side bar Section -->
			<div class="col-sm-2"><br/><br/>
				<ul class="nav nav-pills nav-stacked" id="side_nav">
					<li><a href="dashboard.php"><i class="glyphicon glyphicon-th"> Dashboard</i></a></li>
					<li><a href="addnewpost.php"><i class="glyphicon glyphicon-th-list"> Add New Post</i></a></li>
					<li class="active"><a href="categories.php"><i class="glyphicon glyphicon-tags"> Categories</i></a></li>
					<li id="last-nav-item"><a href="logout.php"><i class="glyphicon glyphicon-log-out last"> Log Out</i></a></li>
				</ul>
			</div>
			<!-- The Dashboard Content Management System -->
			<div class="col-sm-10">
				<h1>Manage Category</h1>
				<!-- Category Content Div -->
				<div>
					<form action="categories.php" method="post">
						<fieldset>
							<div class="form-group">
								<label for="categoryname"><span class="field-info">Name:</span></label>
								<input class="form-control" type="text" name="category" id="categoryname" placeholder="Name">
								<br/>
								<input type="submit" name="submit" class="btn btn-success btn-lg "  value="Add New Category" >
							</div>
						</fieldset>
					</form>
				</div>

				<!-- Categories Display Section Div -->
				<div>
					<table class="table table-striped table-responsive table-hover">
						<tr>
							<thead>
								<th>Sr. No</th>
								<th>Date & TIme</th>
								<th>Category Name</th>
								<th>Creator Name</th>
								<th>Action</th>
							</thead>
						</tr>
						<?php
						$b = new Database();
						$b->conn;
						$query = "SELECT * FROM category ORDER BY date_time DESC";
						$execute = mysqli_query($b->conn,$query);
						$srNo = 0;
						if($execute->num_rows > 0){
							while($DataRows = $execute->fetch_assoc()){
								$Id = $DataRows["id"];
								$DateTime = $DataRows["date_time"];
								$CategoryName = $DataRows["name"];
								$CreatorName = $DataRows["creatorname"];
								$srNo++;
						?>
						<tr>
							<td><?php echo $srNo;  ?> </td>
							<td><?php echo $DateTime;  ?> </td>
							<td><?php echo $CategoryName;  ?> </td>
							<td><?php echo $CreatorName;  ?> </td>
							<td><a href="deletecategory.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
						</tr>
					<?php }} ?>			
					</table>
				</div><!-- Categories Display Section Div ends-->

			</div><!--  Content Section div ends -->

		</div><!-- End of the row class div -->

	</div><!-- End of the container class div -->

<!-- The footer Section -->
<div id="footer">
	<hr><p>Designed By | SAURAV RATH | Codession Technologies |&copy;All Rights Reserved --2019</p>
	<p>This site is just created for Project Demonstration Purpose. All Rights Reserved to Saurav Rath | Codession&trade; </p>
	<hr/>
</div>

</body>
</html>

