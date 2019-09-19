<?php
	if(isset($_POST["submit"])){
		$title = $_POST['title'];
		$category = $_POST['category'];
		$post = $_POST['post'];
		$currentTime = time();
		$dateTime = strftime("%B-%d-%Y %H:%M:%S" ,$currentTime);
		$admin = "Saurav";
		$image = $_FILES['imageselect']['name'];
		$target = "upload/".basename($_FILES['imageselect']['name']);
	}
	if(empty($title)){
		$_SESSION["ErrorMessage"] = "Title cant be empty";
		header("Location:addnewpost.php");
	}
	elseif(strlen($title)<2){
		$_SESSION["ErrorMessage"] = "Too short";
		header("Location:addnewpost.php");
	}
	else{
		$b = new Database();
		$b->conn;
		$editFromUrl = $_POST['edit'];
		$query = "UPDATE admin_panal SET date_time = '$dateTime',title = '$title',category = '$category',author = '$admin',image = '$image',post = '$post' WHERE id ='$editFromUrl'";
		$execute = mysqli_query($b->conn,$query);
		move_uploaded_file($_FILES["imageselect"]["tmp_name"], $target);
		if($execute){
			$_SESSION["successMessage"] = "Post Updated succesfully";
			header("Location:dashboard.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong with the query";
			header("Location:dashboard.php");
		}
	}
?>
<?php require_once('includes/database.php');?>
<?php require_once("includes/sessions.php"); ?>
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
	<div class="col-sm-10">
		<h1>Update Post</h1>
		<div><?php echo Error(); echo Success();?></div>
		<div>
			<?php
			$queryParameter = $_GET['edit'];
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
			<form action="editpost.php?edit=<?php echo $_GET['edit']?>" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<input type="hidden" value="<?php echo $_GET['edit']?>" name="edit" />
						<label for="title"><span class="field_info">Title:</span></label>

						<input value="<?php echo $titleToUpdate;?>"
						class="form-control" type="text" name="title" id="title" placeholder="title" >
						<br/>
					</div>
					<div class="form-group">
						<label for="category"><span class="field_info">Category:</span></label><span class="field_info">Existing Category:<i> <?php echo $categoryToUpdate; ?></i></span>
						<select class="form-control" id="categoryselect" name="category">
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
						<input type="File" name="imageselect" class="form-control" id="Imageselect">
					</div>
					<div class="form-group">
						<label for="postarea"><span class="field_info">Post:</span></label>
						<textarea class="form-control" name="post" id="post" ><?php echo $postToUpdate ;?></textarea>
					</div>
						<input type="submit" name="submit" class="btn btn-success btn-lg "  value="Update Post" >
				</fieldset>
			</form>
		</div>
		<div>
<!-- The footer Section -->
<div id="footer">
	<hr><p>Designed By | SAURAV RATH | Codession Technologies |&copy;All Rights Reserved --2019</p>
	<p>This site is just created for Project Demonstration Purpose. All Rights Reserved to Saurav Rath | Codession&trade; </p>
	<hr/>
</div>
</body>
</html>
