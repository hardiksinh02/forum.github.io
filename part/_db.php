<?php

$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "xyz";

$con = mysqli_connect($servername, $user, $pass, $dbname);
if(!$con) {
    die("Connection failed: ".mysqli_connect_error());
}





?>