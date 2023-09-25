<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['userId']) || !isset($_SESSION['userEmail'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

include 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FireSafety Title</title>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            /* Make body a flex container */
            flex-direction: column;
            /* Stack children vertically */
            justify-content: center;
            /* Center children vertically */
            align-items: center;
            /* Center children horizontally */
            height: 100vh;
        }

        .big-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 100px;
            padding-bottom: 0px;
            font-size: 25px;
            position: fixed;
            top: 0;
            left: 0;

        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 0px;
            font-size: 20px;
            /* top: 0; */
            /* position: fixed; */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: top;
            background-color: #FFDC86;
            padding: 20px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        header h1 {
            color: #000000;
            margin: 0;
            margin-right: 200px;
            font-size: 56px;
        }

        nav {
            display: flex;
            /* justify-content: center; */
            background-color: #FFDC86;
            padding: 15px 0;
        }

        nav a {
            color: #000000;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ffffff;
        }

        .top-background {
            background: url('topbg.jpg') no-repeat center center;
            /* Replace with your image path */
            background-size: cover;
            /* This will cover the entire viewport */
            height: 650px;
            /* Adjust based on your needs */
            width: 100%;
        }

        .text-box {
            width: 100%;
            float: left;
            border: 0.01em solid #dddbdb;
            border-radius: 0 0 2% 2%;
            padding: 1em;
        }

        footer {
            display: flex;
            justify-content: space-between;
            align-items: bottom;
            background-color: #FFDC86;
            padding: 20px 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }


        table th {
            background-color: #f2f2f2;
        }
    </style>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Orders</title>
        <link rel="stylesheet" href="styles.css">
    </head>

<body>
    <header>
        <h1>FireSafety</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="contact.php">Contact Us</a>
            <a href="products.php">Products</a>
            <a href="book_checkup.php">Book Online</a>
            <?php if (isset($_SESSION['userType'])) : ?>
                <a href="./<?php echo $_SESSION['userType']; ?>_profile.php">Profile</a>
                <?php if ($_SESSION['userType'] == 'employee' || $_SESSION['userType'] == 'technician') : ?>
                    <a href="databases.php">Databases</a>
                <?php elseif ($_SESSION['userType'] == 'businesscustomer' || $_SESSION['userType'] == 'customer') : ?>
                    <a href="orders.php">Orders</a>
                <?php endif; ?>
                <a href="logout.php">Log Out</a>
            <?php else : ?>
                <a href="login.php">Log In</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <div class="container">
            <?php

            // Table for Customers Orders
            // Check if the user is an employee or technician
            if ($_SESSION['userType'] == 'customer' || $_SESSION['userType'] == 'businesscustomer') {
                $currentUserId = $_SESSION['userId']; // Assuming you store logged-in user's ID in $_SESSION['userId']

                $sql = "SELECT customer.c_id, customer.c_firstName, customer.c_lastName, customer.c_email, orders.order_id, item.item_name, item.item_id, order_items.quantity, item.item_price 
                    FROM customer
                    JOIN orders ON customer.c_id = orders.c_id
                    JOIN order_items ON orders.order_id = order_items.order_id
                    JOIN item ON order_items.item_id = item.item_id
                    WHERE customer.c_id = $currentUserId"; // Filter results for the current user

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Customers Orders</h2>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Customer ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Order ID</th>";
                    echo "<th>Item Name</th>";
                    echo "<th>Item ID</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Price THB</th>";
                    echo "<th>Total Price THB</th>";
                    echo "</tr>";

                    // Fetch and display records from the joined tables
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['c_id']}</td>";
                        echo "<td>{$row['c_firstName']}</td>";
                        echo "<td>{$row['c_lastName']}</td>";
                        echo "<td>{$row['c_email']}</td>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td>{$row['item_id']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>{$row['item_price']}</td>";
                        $totalPrice = $row['quantity'] * $row['item_price']; // Calculate Total Price
                        echo "<td>{$totalPrice}</td>"; // Display Total Price
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "0 results";
                }
            }

            // Table for Check Up
            // Check if the user is an employee or technician
            if ($_SESSION['userType'] == 'customer' || $_SESSION['userType'] == 'businesscustomer') {
                $currentUserId = $_SESSION['userId']; // Assuming you store logged-in user's ID in $_SESSION['userId']

                $sql = "SELECT checkup.checkup_id, employee.e_firstName, employee.e_lastName, item.item_name, checkup.check_date, checkup.check_time, customer.c_id, customer.c_address, checkup.check_status
                FROM checkup
                JOIN employee ON checkup.e_id = employee.e_id
                JOIN customer ON checkup.c_id = customer.c_id
                JOIN item ON checkup.item_id = item.item_id
                WHERE customer.c_id = $currentUserId"; // Filter results for the current user


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Check Ups</h2>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Checkup ID</th>";
                    echo "<th>Employee First Name</th>";
                    echo "<th>Employee Last Name</th>";
                    echo "<th>Item Name</th>";
                    echo "<th>Check Date</th>";
                    echo "<th>Check Time</th>";
                    echo "<th>Customer ID</th>";
                    echo "<th>Customer Address</th>";
                    echo "<th>Check Status</th>";
                    echo "</tr>";

                    // Fetch and display records from the joined tables
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['checkup_id']}</td>";
                        echo "<td>{$row['e_firstName']}</td>";
                        echo "<td>{$row['e_lastName']}</td>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td>{$row['check_date']}</td>";
                        echo "<td>{$row['check_time']}</td>";
                        echo "<td>{$row['c_id']}</td>";
                        echo "<td>{$row['c_address']}</td>";
                        echo "<td>{$row['check_status']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "0 results";
                }
            }

            ?>
        </div>
    </main>
</body>

</html>

<?php $conn->close() ?>