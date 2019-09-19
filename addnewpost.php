<?php require_once('includes/database.php');?>
<?php require_once("includes/sessions.php"); ?>
<?php
	if(isset($_POST["submit"])){
		$title = $_POST['title'];
		$category = $_POST['category'];
		$post = $_POST['post'];
		$currentTime = time();
		$dateTime = strftime("%B-%d-%Y %H:%M:%S" ,$currentTime);
		$admin = $_SESSION["username"];
		$image = $_FILES['imageselect']['name'];
		$target = "upload/".basename($_FILES['imageselect']['name']);
		if(empty($title)){
			$_SESSION["ErrorMessage"] = "Title cant be empty";
			header("Location:addnewpost.php");
		}
		elseif(strlen($title)<2){
			$_SESSION["ErrorMessage"] = "Title is very short";
			header("Location:addnewpost.php");
		}
		else{
			$b = new Database();
			$b->conn;
			$query = "INSERT INTO admin_panal(date_time,title,category,author,image,post) VALUES('$dateTime','$title','$category','$admin','$image','$post')";
			$execute = mysqli_query($b->conn,$query);
			move_uploaded_file($_FILES["imageselect"]["tmp_name"], $target);
			if($execute){
				$_SESSION["successMessage"] = "Post added succesfully";
				// var_dump($_SESSION["successMessage"]);die();
				header("Location:dashboard.php");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong with the query";
				header("Location:addnewpost.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Post</title>
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
					<li class="active"><a href="addnewpost.php"><i class="glyphicon glyphicon-th-list"> Add New Post</i></a></li>
					<li><a href="categories.php"><i class="glyphicon glyphicon-tags"> Categories</i></a></li>
					<li id="last-nav-item"><a href="logout.php"><i class="glyphicon glyphicon-log-out last"> Log Out</i></a></li>
				</ul>
			</div>
			<!-- The Dashboard Content Management System -->
			<div class="col-sm-10">
				<div><?php echo Error(); echo Success();?></div>
				<h1>Add New Post</h1>
				<!-- Add a post section Div -->
				<div>
					<form action="addnewpost.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<!-- Div for title of Post -->
							<div class="form-group">
								<label for="title"><span class="field_info">Title:</span></label>
								<input class="form-control" type="text" name="title" id="title" placeholder="title">
								<br/>
							</div>
							<!-- Div for Category of Post -->
							<div class="form-group">
								<label for="category"><span class="field_info">Category:</span></label>
								<select class="form-control" id="categoryselect" name="category">
									<!-- We need to extract the category from the database -->
								<?php
									$b = new Database();
									$b->conn;
									$query = "SELECT * FROM category ORDER BY date_time DESC";
									$execute = mysqli_query($b->conn,$query);
									while($DataRows = $execute->fetch_assoc()){
										$Id = $DataRows["id"];
										$CategoryName  = $DataRows["name"];
								?>
									<option value="<?php echo $CategoryName;?>"><?php echo $CategoryName; ?></option>
								<?php } ?>
								</select>
							</div>
							<!-- Div for image of the post -->
							<div class="form-group">
								<label for="imageselect"><span class="field_info">Image:</span></label>
								<input type="file" class="form-control" name="imageselect" id="imageselect">
							</div>
							<!-- Div for content of the post -->
							<div class="form-group">
								<label for="postarea"><span class="field_info">Post:</span></label>
								<textarea class="form-control" name="post" id="post"></textarea>
							</div>
								<input type="submit" name="submit" class="btn btn-success btn-lg "  value="Add New Post" >
						</fieldset>
					</form>
				</div><!-- Add a post section Div ends -->

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

