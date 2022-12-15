<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="dien_may_xanh";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>