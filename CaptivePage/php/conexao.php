<?php

// $servername = "localhost";
// $database = "burleigh_pavilion";
// $username = "root";
// $password = "piT00012001201";

$servername = "localhost";
$database = "burleigh_pavilion";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>