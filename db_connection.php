<?php

$servername = "localhost";
$username = "root"; 
$password = "1111"; 
$dbname = "university_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
