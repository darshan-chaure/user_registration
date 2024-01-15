<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
include("includes/db.php");
$msg = "";
if(isset($_POST['submit'])) {
	$user = mysqli_real_escape_string($mysqli, $_POST['username']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($user == "" || $pass == "") {
		$msg = "User Name and Password field both are required.";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			$msg = "Invalid User Name or Password.";
		}

		if(isset($_SESSION['valid'])) {
			header('Location: index.php');
			exit();		
		}
	}
} else {
?>
<?php
}
?>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-info mar20">
			<div class="panel-heading">Login</div>
				<div class="panel-body">
					<?php
						if(!empty($msg)){
							echo "<span class='text-danger'>";
							echo $msg;
							echo "</span>";
						}
					?>
					<form class="form-horizontal" name="form1" method="post" action="">
						<div class="form-group">
							<label class="control-label col-sm-4" for="username">User Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="password">Password:</label>
							<div class="col-sm-8">          
								<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-offset-4 col-sm-8">
								<button type="submit" name="submit" class="btn btn-default">Submit</button>
								<a href='index.php' class="btn btn-info pull-right">Home</a>
							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</body>
</html>