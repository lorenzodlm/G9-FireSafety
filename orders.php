<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
            padding: 20px;
            padding-top: 0px;
            font-size: 30px;
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

</body>

</html>