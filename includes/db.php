<?php

$databaseHost = 'localhost';
$databaseName = 'user_registration_login';
$databaseUsername = 'root';
$databasePassword = 'admin';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (mysqli_connect_errno()) {
  echo "MySQL Error: " . mysqli_connect_error();
  exit();
}
?>