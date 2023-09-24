<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_firstName = $_POST['c_firstname'];
    $c_lastName = $_POST['c_lastname'];
    $c_email = $_POST['c_email'];
    $c_phonenum = $_POST['c_phonenum'];
    $c_address = $_POST['c_address'];
    $c_password = $_POST['password'];
    $is_BusinessCustomer = isset($_POST['isa_businesscustomer']) ? 1 : 0;

    $sql = "INSERT INTO users (c_firstname, c_lastname, c_email, c_phonenum, c_address, password, is_businesscustomer) VALUES ('$firstname', '$lastname', '$email', '$phonenum', '$address', '$password', '$is_businesscustomer')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ' . ($is_BusinessCustomer ? 'busUser_profile.php?email=' . $email : 'user_profile.php?email=' . $email));
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
