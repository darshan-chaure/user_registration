<html>
<head>
    <title>Register</title>
    <?php
        include_once("includes/headers.php");
    ?>
</head>

<body>
<?php
include("includes/db.php");
$msg = "";
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if(empty($user) || empty($pass) || empty($name) || empty($email)) {
        $msg = "All fields are mandatory.";
    } else {
        mysqli_query($mysqli, "INSERT IGNORE INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
            or die("Could not execute the insert query.");
            
        $msg = "Registration successful.";
    }
} else {
?>
<?php
}
?>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-info mar20">
            <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <?php
                        if(!empty($msg)){
                            echo "<span class='text-danger'>";
                            echo $msg;
                            echo "</span>";
                        }
                    ?>
                    <span id="err"></span>
                    <form class="form-horizontal" id="form1" name="form1" method="post" action="">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="username">Full Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="username">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="username">User Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="password">Password:</label>
                            <div class="col-sm-8">          
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="button" name="submit" class="btn btn-default" onclick="submitUser();">Submit</button>
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
