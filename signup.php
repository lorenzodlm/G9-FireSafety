<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_firstName = $_POST['c_firstName'];
    $c_lastName = $_POST['c_lastName'];
    $c_email = $_POST['c_email'];
    $c_phonenum = $_POST['c_phonenum'];
    $c_address = $_POST['c_address'];
    $c_password = $_POST['c_password'];
    $isa_BusinessCustomer = isset($_POST['isa_BusinessCustomer']) ? 1 : 0;
    $c_company = isset($_POST['c_company']) ? $_POST['c_company'] : null;

    $stmt = $conn->prepare("INSERT INTO customer (c_firstName, c_lastName, c_email, c_phonenum, c_address, c_password, isa_BusinessCustomer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $c_firstName, $c_lastName, $c_email, $c_phonenum, $c_address, $c_password, $isa_BusinessCustomer);

    if ($stmt->execute()) {
        // If the customer is a business customer, insert the company into the businesscustomer table
        if ($isa_BusinessCustomer) {
            $last_id = $conn->insert_id; // Get the last inserted ID (c_id) after the customer has been inserted
            $stmtBusiness = $conn->prepare("INSERT INTO businesscustomer (c_id, c_company) VALUES (?, ?)");
            $stmtBusiness->bind_param("is", $last_id, $c_company);
            
            if (!$stmtBusiness->execute()) {
                echo "Error: " . $stmtBusiness->error;
            }
            
            $stmtBusiness->close();
        }
        
        $_SESSION['c_email'] = $c_email;
        header('Location: ' . ($isa_BusinessCustomer ? 'busUser_profile.php' : 'user_profile.php'));
        $_SESSION['userType'] = $isa_BusinessCustomer ? 'businessCustomer' : 'customer';
        $_SESSION['isLoggedIn'] = true;

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>