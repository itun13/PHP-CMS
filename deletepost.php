<?php require_once("includes/database.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php //confirm_login() ?>
<?php
		if(isset($_POST["submit"])){
			$b = new Database();
			$b->conn;
			$deleteFromUrl = $_POST['delete'];
			$query = "DELETE FROM admin_panal WHERE id = '$deleteFromUrl'";
			$execute = mysqli_query($b->conn,$query);
			if($execute){
				$_SESSION["successMessage"] = "Post Delete succesfully";
				header("Location:dashboard.php");				
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong with the query";
				header("Location:dashboard.php");	
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
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">
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
	</nav>
	<div class="container-fluid">
		<div class="row">

			<!-- The Side bar Section -->
			<div class="col-sm-2"><br/><br/>
				<ul class="nav nav-pills nav-stacked" id="side_nav">
					<li class="active"><a href="dashboard.php"><i class="glyphicon glyphicon-th"> Dashboard</i></a></li>
					<li><a href="addnewpost.php"><i class="glyphicon glyphicon-th-list"> Add New Post</i></a></li>
					<li><a href="categories.php"><i class="glyphicon glyphicon-tags"> Categories</i></a></li>
					<li id="last-nav-item"><a href="logout.php"><i class="glyphicon glyphicon-log-out last"> Log Out</i></a></li>
				</ul>
			</div>

			<!-- The Dashboard Content Management System -->
			<div class="col-sm-10">
			<div><?php echo Error(); echo Success();?></div>
			<?php
			$queryParameter = $_GET['delete'];
			$db = new Database();
			$db->conn;
			$sql = "SELECT * FROM admin_panal WHERE id = '$queryParameter'";

			
			$execute = mysqli_query($db->conn,$sql);
			

				while($rows = $execute->fetch_assoc()){
					
				$titleToUpdate = $rows['title'];
				$categoryToUpdate = $rows['category'];
				$imageToUpdate = $rows['image'];
				$postToUpdate = $rows['post'];
			}
					?>
					<form action="deletepost.php?delete=<?php echo $_GET['delete']?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input type="hidden" value="<?php echo $_GET['delete']?>" name="delete" />
								<label for="title"><span class="field_info">Title:</span></label>

								<input disabled value="<?php echo $titleToUpdate;?>"
								class="form-control" type="text" name="title" id="title" placeholder="title" >
								<br/>

							</div>
							<div class="form-group">



								<label for="category"><span class="field_info">Category:</span></label><span class="field_info">Existing Category:<i> <?php echo $categoryToUpdate; ?></i></span>

								<select disabled class="form-control" id="categoryselect" name="category">

								<?php

									$b = new Database();
									$b->conn;

									$query = "SELECT * FROM category ORDER BY date_time DESC";

									$execute = mysqli_query($b->conn,$query);
								
									while($DataRows = $execute->fetch_assoc()){

										$Id = $DataRows["id"];
										$CategoryName  = $DataRows["name"];

								?>
									<option value="<?php echo $CategoryName;?>">
									
									 <?php echo $CategoryName; ?> 
									</option>

								<?php } ?>
							
								</select>

							</div>

							<div class="form-group">

								<label for="Imageselect"><span class="field_info">Select Image:</span></label><span class="field_info"> Existing Image:</span> 
								<img src="upload/<?php echo $imageToUpdate; ?>" width=140 height=60>  
								<input disabled type="File" name="imageselect" class="form-control" id="Imageselect">

							</div>

							<div class="form-group">

								<label for="postarea"><span class="field_info">Post:</span></label>
								<textarea disabled class="form-control" name="post" id="post" ><?php echo $postToUpdate ;?></textarea>

							</div>
								<input type="submit" name="submit" class="btn btn-danger btn-lg "  value="Delete Post" >
							
						</fieldset>
					</form>
				</div>
				<div>
					<style>
						.field_info{
							color: #313131;
							font-family: Bitter,Georgia,"Times New Roman",Times,serif;
							font-size: 1.2em;
						}
					</style>
				</div>
			</div>

			<!-- Ending of col-sm-10 -->

		</div>
		<!-- Ending of the Container fluid -->
<!-- The footer Section -->
<div id="footer">
	<hr><p>Designed By | SAURAV RATH | Codession Technologies |&copy;All Rights Reserved --2019</p>
	<p>This site is just created for Project Demonstration Purpose. All Rights Reserved to Saurav Rath | Codession&trade; </p>
	<hr/>
</div>
</body>
</html>