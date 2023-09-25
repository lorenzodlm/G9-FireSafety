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

// Check if table is set in the URL
if (!isset($_GET['table'])) {
    die('Table not specified');
}

$table = $_GET['table'];

// Sanitize table name
$table = $conn->real_escape_string($table);

// Fetch table columns
$sql = "DESCRIBE $table";
$result = $conn->query($sql);
if (!$result) {
    die('Invalid table specified');
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $columns = [];
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $column = $row['Field'];
        if (isset($_POST[$column])) {
            $columns[] = $column;
            $values[] = "'" . $conn->real_escape_string($_POST[$column]) . "'";
        }
    }
    
    $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ")";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully. Redirecting in 3 seconds...";
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'alldatabases.php';
                }, 3000);
              </script>";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Record</title>
</head>

<body>
    <form method="post">
        <?php
        // Generate form fields dynamically based on table columns
        $result->data_seek(0); // Reset result pointer
        while ($row = $result->fetch_assoc()) {
            $column = $row['Field'];
            echo "<label for='$column'>" . ucfirst($column) . ":</label>";
            echo "<input type='text' name='$column' id='$column' required><br>";
        }
        ?>
        <button type="submit">Insert Record</button>
    </form>
</body>

</html>
