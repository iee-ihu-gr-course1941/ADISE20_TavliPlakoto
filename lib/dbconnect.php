<?php

$servername = "localhost";
$dbname = "tavli";
require_once "config_local.php";

$username=$DB_USER;
$password=$DB_PASS;


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



?>
