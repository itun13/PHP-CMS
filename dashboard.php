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
			<h1>Admin Dashboard</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<thead>
								<th>No</th>
								<th>Post Title</th>
								<th>Date & Time</th>
								<th>Author</th>
								<th>Category</th>
								<th>Banner</th>
								<th>Action</th>
							</thead>
						</tr>
						<?php
							$c = new Database();
							$c->conn;
							$sql = "SELECT * FROM admin_panal ORDER BY date_time DESC";
							$execute = mysqli_query($c->conn,$sql);
							$srNo = 0;
							while($rows = $execute->fetch_assoc()){	
							$id = $rows['id'];
							$dateTime = $rows['date_time'];
							$title = $rows['title'];
							$category = $rows['category'];
							$admin = $rows['author'];
							$image = $rows['image'];
							$post = $rows['post'];
							$srNo++;
						?>
						<tr>
							<td><?php echo $srNo; ?></td>
							<td style="color: blue;"><?php
									if(strlen($title)>20){
										$title = substr($title, 0, 20)."...";
									} 
									echo $title; ?></td>
							<td><?php echo $dateTime; ?></td>
							<td><?php echo $admin; ?></td>
							<td><?php echo $category; ?></td>
							<td><img src="upload/<?php echo $image;?>" width= "150" height="100"></td>
							<td>
								<a href="editpost.php?edit=<?php echo $id?>"> <span class="btn  btn-warning">Edit</span> </a>
								<a href="deletepost.php?delete=<?php echo $id?>"> <span class="btn btn-danger"> Delete</span> </a>
							</td>
						</tr>
						<?php						
						}
						?>
					</table>
				</div>
			</div>
			</div>
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

