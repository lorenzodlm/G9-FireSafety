<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "firesafety";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
} else {
    //print("Success");
}
?>