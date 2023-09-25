<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo isset($_SESSION['userType']) ? $_SESSION['userType'] : 'userType Not Set';
echo '<br>';

include 'dbconnect.php';

// Check if the user is logged in
if (!isset($_SESSION['userId']) || !isset($_SESSION['userEmail'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$c_id = '';
$c_address = '';

// Fetch c_id and c_address from the customer or businesscustomer table based on the userId in the session
if ($_SESSION['userType'] == 'customer' || $_SESSION['userType'] == 'businesscustomer') {
    $stmt = $conn->prepare("SELECT c_id, c_address FROM customer WHERE c_id = ?");
    $stmt->bind_param("i", $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $c_id = $row['c_id'];
        $c_address = $row['c_address'];
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Online</title>
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
            font-size: 32px;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: top;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
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

    <div class="big-container">
        <h2>Book Check-up Online</h2>
    </div>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Style for larger text input fields */
            input[type="text"],
            input[type="email"] {
                width: 50%;
                padding: 2px;
                margin-bottom: 20px;
                font-size: 16px;
            }

            /* Style for labels */
            label {
                font-weight: bold;
            }
        </style>
    </head>

    <div class="container">
        <p>Check out our availability and book the date and time that works for you</p>
    </div>

    <form action="" method="post">
        <label for="c_id">Customer ID:</label>
        <input type="text" id="c_id" name="c_id" value="<?php echo $c_id; ?>" required readonly><br>

        <label for="item_id">Item ID (Ordered from Fire Safety website):</label>
        <input type="text" id="item_id" name="item_id" required><br>

        <label for="check_date">Select Date:</label>
        <input type="date" id="check_date" name="check_date" required><br>

        <label for="check_time">Select Time:</label>
        <input type="time" id="check_time" name="check_time" required><br>

        <label for="c_address">Customer Address:</label>
        <input type="text" id="c_address" name="c_address" value="<?php echo $c_address; ?>" required><br>

        <button type="submit">Schedule Appointment</button>
    </form>
</body>

</html>