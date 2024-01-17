<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<?php
        include_once("includes/headers.php");
    ?>
</head>

<body>
	<?php
	if(isset($_SESSION['valid'])) {			
		include("includes/db.php");
		$result = mysqli_query($mysqli, "SELECT * FROM login");
		$img = "uploads/" . $_SESSION['id'] . ".jpg";

		if(!file_exists($img)){
			$img = "uploads/na.jpg";
		}
	?>		
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-success mar20">
				<div class="panel-heading">Welcome <?php echo $_SESSION['name'] ?></div>
				<div class="panel-body">
					<img src="<?php echo $img; ?>" class="centerImg" height="100" />
					<br>
					<br>
					<a href='logout.php' class="btn btn-warning">Logout</a>
					<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">Upload Photo</button>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	<?php	
	} else {
	?>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-info mar20">
			<div class="panel-heading">NEC User Registration Demo</div>
			<div class="panel-body">
				Please click on "Login" if you are already registered. Otherwise click on "Register" button.
				</br>
				</br>
				<a href='login.php' class="btn btn-success">Login</a>
				<a href='register.php' class="btn btn-primary pull-right">Register</a>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	<?php
	}
	?>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Photo</h4>
				</div>
				<div class="modal-body">
					<!-- File size should be less than 2 MB. -->
					<form id="uploadForm" enctype="multipart/form-data">
						<input type="file" name="image" id="imageInput" accept="image/*"><br>
						<button type="submit" name="upload" class="btn btn-warning ">Upload</button>
					</form>

					<div id="imageContainer" class="noDisplay"></div>
					<script src="assets/js/script.js"></script>
				</div>
			</div>

		</div>
		</div>
	</div>
</body>
</html>