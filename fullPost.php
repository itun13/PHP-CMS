<?php require_once("includes/database.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">
	<link href="https://fonts.googleapis.com/css?family=Cute+Font&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
	<div style=" height:10px; background-color: #806d7a;"></div>
	<nav class="navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toogle collapsed" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle Naviagtion</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- For the logo of the website -->
				<a class="navbar-brand" href="blog.php"><p class="logo-section">TRAVOY</p></a>
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
		<!--container div -->
		<div class="container">
			<div class="row"><!-- row div -->
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<div class="blog-header">
						<h1 class="text-center">The Complete Responsive CMS Blog</h1>
					</div>
					<!-- Full Post Description Section -->
					<?php 
					$c = new Database();
					$c->conn;
					$postIdFromUrl = $_GET['id'];
					$viewQuery = "SELECT * FROM admin_panal WHERE id = $postIdFromUrl";
					$execute = mysqli_query($c->conn,$viewQuery);
					while($rows = $execute->fetch_assoc()){
						$postId = $rows['id'];
						$dateTime = $rows['date_time'];
						$title = $rows['title'];
						$category = $rows['category'];
						$author = $rows['author'];
						$image = $rows['image'];
						$post = $rows['post'];
					?>
					<div class="img-thumbnail blogpost">
						<img class="img-responsive img-rounded" src="upload/<?php echo $image; ?>" >
					</div>
					<div class="caption">
						<h1 id="heading"><?php echo htmlentities($title);?></h1>
						<p class="description">Category: <?php echo htmlentities($category);?> Published On <?php echo htmlentities($dateTime);?></p>
						<p class="post"><?php echo htmlentities($post);?></p>
					</div>
					<div style=" height:5px; background-color:	white;"></div>
				<?php } ?>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
<!-- The footer Section -->
<div id="footer">
	<hr><p>Designed By | SAURAV RATH | Codession Technologies |&copy;All Rights Reserved --2019</p>
	<p>This site is just created for Project Demonstration Purpose. All Rights Reserved to Saurav Rath | Codession&trade; </p>
	<hr/>
</div>
</body>
</html>

