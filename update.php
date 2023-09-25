<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnect.php';

// Check if user is logged in and is an employee or technician
if (!isset($_SESSION['userType']) || ($_SESSION['userType'] != 'employee' && $_SESSION['userType'] != 'technician')) {
    header('Location: login.php');
    exit;
}

// Check if table and id are set in the URL
if (!isset($_GET['table']) || !isset($_GET['id'])) {
    die('Table or ID not specified');
}

$table = $_GET['table'];
$id = $_GET['id'];

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
    case 'orders':
        $column_name = 'order_id';
        break;
    case 'checkup':
        $column_name = 'checkup_id';
        break;
    case 'delivery':
        $column_name = 'delivery_id';
        break;
    case 'item':
        $column_name = 'item_id';
        break;
    default:
        echo "Invalid table specified.";
        exit;
}

// Sanitize and validate table name and id
$table = $conn->real_escape_string($table); // Sanitize table name
if (!ctype_digit($id)) { // Validate id
    die('Invalid ID');
}

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM $table WHERE $column_name = ?");
if (!$stmt) {
    die('Error preparing statement: ' . $conn->error);
}

// Bind the parameter
$stmt->bind_param('i', $id);

// Execute the statement
if (!$stmt->execute()) {
    die('Error executing statement: ' . $stmt->error);
}

// Get the result
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die('Record not found');
}
$row = $result->fetch_assoc();

// Close the statement
$stmt->close();


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Build update SQL query dynamically based on form data
    $sql = "UPDATE $table SET ";
    $updates = [];
    foreach ($_POST as $field => $value) {
        $value = $conn->real_escape_string($value); // Sanitize user input
        $updates[] = "$field = '$value'";
    }
    $sql .= implode(', ', $updates);
    $sql .= " WHERE $column_name = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully. Redirecting in 3 seconds...";
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'databases.php';
                }, 3000);
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>

<body>
    <form method="post">
        <?php
        // Generate form fields dynamically based on fetched record
        foreach ($row as $field => $value) {
            if ($field == 'id') continue; // Skip id field
            echo "<label for='$field'>" . ucfirst($field) . ":</label>";
            echo "<input type='text' name='$field' id='$field' value='$value' required><br>";
        }
        ?>
        <button type="submit">Update Record</button>
    </form>
</body>

</html>