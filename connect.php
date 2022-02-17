<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "re_enroll";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>