<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_firstName = $_POST['c_firstname'];
    $c_lastName = $_POST['c_lastname'];
    $c_email = $_POST['c_email'];
    $c_phonenum = $_POST['c_phonenum'];
    $c_address = $_POST['c_address'];
    $c_password = $_POST['password'];
    $isa_BusinessCustomer = isset($_POST['isa_BusinessCustomer']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO users (c_firstname, c_lastname, c_email, c_phonenum, c_address, c_password, isa_BusinessCustomer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $c_firstName, $c_lastName, $c_email, $c_phonenum, $c_address, $c_password, $isa_BusinessCustomer);

    if ($stmt->execute()) {
        // Start a session to store user data temporarily
        session_start();
        $_SESSION['email'] = $c_email;
        // Redirect to the appropriate page based on the user type
        header('Location: ' . ($isa_BusinessCustomer ? 'busUser_profile.php' : 'user_profile.php'));
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
