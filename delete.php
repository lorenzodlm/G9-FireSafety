<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and is an employee or technician
if (!isset($_SESSION['userType']) || ($_SESSION['userType'] != 'employee' && $_SESSION['userType'] != 'technician')) {
    header('Location: login.php'); // Redirect to login page if not logged in or not the correct user type
    exit;
}

include 'dbconnect.php';

// Check if table and id are set in the URL
if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = $_GET['id'];

    // Define the correct column name based on the table
    $column_name = '';
    switch ($table) {
        case 'customer':
            $column_name = 'c_id';
            break;
        case 'businesscustomer':
            $column_name = 'c_id';
            break;
        case 'employee':
            $column_name = 'e_id';
            break;
        case 'technician':
            $column_name = 'e_id';
            break;
        default:
            echo "Invalid table specified.";
            exit;
    }

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM $table WHERE $column_name = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Table and ID must be specified.";
}

header("Location: databases.php");
exit;

$conn->close();
?>
