<?php

$servername = "localhost";
$dbname = "tavli";
require_once "config_local.php";

$username=$DB_USER;
$password=$DB_PASS;


if(gethostname()=='users.iee.ihu.gr')
{
  $conn = new mysqli($servername, $username, $password, $dbname,null,'/home/student/it/2015/it154510/mysql/run/mysql.sock');
}
else
{
  $conn = new mysqli($servername, $username, $password, $dbname);
}


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



?>
