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
        <a href="orders.php" class="button">Orders</a>
        <a href="#" class="button">CheckUp</a>
    </div>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Submission</title>
        <style>
            /* Style for larger text input fields */
            input[type="text"],
            input[type="email"] {
                width: 50%;
                padding: 2px;
                /* Increase padding for more height */
                margin-bottom: 20px;
                /* Increase margin for more separation */
                font-size: 16px;
                /* Increase font size for larger text */
            }

            /* Style for labels */
            label {
                font-weight: bold;
            }
        </style>
    </head>
</body>

</html>