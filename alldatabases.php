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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .big-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 100px;
            padding-bottom: 0px;
            font-size: 72px;
            top: 0;
            position: fixed;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 150px;
            padding: 20px;
            padding-top: 1800px;
            font-size: 30px;
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

        .text-box {
            width: 100%;
            float: left;
            border: 0.01em solid #dddbdb;
            border-radius: 0 0 2% 2%;
            padding: 1em;
        }

        .button-container {
            position: fixed;
            top: 150px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 1000;
            padding: 10px;
        }

        .button {
            display: inline-block;
            margin: 0 15px;
            padding: 15px 30px;
            text-decoration: none;
            background-color: #FFDC86;
            color: #000;
            border-radius: 7.5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #ffffff;
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
    </style>
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
                <a href="<?php echo $_SESSION['userType']; ?>_profile.php">Profile</a>
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

    <div class="button-container">
        <a href="databases.php" class="button">General</a>
        <a href="alldatabases.php" class="button">All Databases</a>
    </div>

    <div class="container">
        <h2>Customer Table</h2>
        <table border="1">
            <tr>
                <th>c_id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>isa_business?</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display records from the customer table
            $result = $conn->query("SELECT * FROM customer");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=customer&id={$row['c_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=customer&id={$row['c_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=customer">Create New Record</a>

        <h2>Business Customer Table</h2>
        <table border="1">
            <tr>
                <th>c_id</th>
                <th>c_company</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display records from the businesscustomer table
            $result = $conn->query("SELECT * FROM businesscustomer");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=businesscustomer&id={$row['c_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=businesscustomer&id={$row['c_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=businesscustomer">Create New Record</a>

        <h2>Employee Table</h2>
        <table border="1">
            <tr>
                <th>e_id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>isa_technician?</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display records from the employee table
            $result = $conn->query("SELECT * FROM employee");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=employee&id={$row['e_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=employee&id={$row['e_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=employee">Create New Record</a>

        <h2>Technician Table</h2>
        <table border="1">
            <tr>
                <th>e_id</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display records from the technician table
            $result = $conn->query("SELECT * FROM technician");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['e_id']}</td>";
                echo "<td>";
                echo "<a href='update.php?table=technician&id={$row['e_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=technician&id={$row['e_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=technician">Create New Record</a>

        <h2>Order-Items Table</h2>
        <table border="1">
            <tr>
                <th>order_id</th>
                <th>item_id</th>
                <th>Quantity</th>
            </tr>
            <?php
            // Fetch and display records from the orders table
            $result = $conn->query("SELECT * FROM order_items");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=order_items&id={$row['order_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=order_items&id={$row['order_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=order_items">Create New Order</a>

        <h2>Orders Table</h2>
        <table border="1">
            <tr>
                <th>order_id</th>
                <th>c_id</th>
                <th>Order Date</th>
                <th>Delivery Status</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display records from the orders table
            $result = $conn->query("SELECT * FROM orders");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=orders&id={$row['order_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=orders&id={$row['order_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=orders">Create New Order</a>

        <h2>Item Table</h2>
        <table border="1">
            <tr>
                <th>item_id</th>
                <th>item_price</th>
                <th>item_name</th>
                <th>Actions</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM item");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=item&id={$row['item_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=item&id={$row['item_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=item">Create New Record</a>

        <h2>Check Up Table</h2>
        <table border="1">
            <tr>
                <th>Check Up ID</th>
                <th>c_id</th>
                <th>e_id</th>
                <th>item_id</th>
                <th>check_status</th>
                <th>date</th>
                <th>Time</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM checkup");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=checkup&id={$row['checkup_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=checkup&id={$row['checkup_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=checkup">Create New Record</a>

        <h2>Delivery Table</h2>
        <table border="1">
            <tr>
                <th>Delivery_id</th>
                <th>e_id</th>
                <th>c_id</th>
                <th>order_id</th>
                <th>Customer Address</th>
                <th>Delivery Status</th>
                <th>Actions</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM delivery");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>{$value}</td>";
                }
                echo "<td>";
                echo "<a href='update.php?table=delivery&id={$row['delivery_id']}'>Update</a> | ";
                echo "<a href='delete.php?table=delivery&id={$row['delivery_id']}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="insert.php?table=delivery">Create New Record</a>



</body>

</html>

<?php $conn->close() ?>