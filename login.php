<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnect.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // Check in the customer table
    $stmt = $conn->prepare("SELECT * FROM customer WHERE c_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        // Validate password here
        $_SESSION['userId'] = $user['c_id'];
        $_SESSION['userType'] = $user['isa_BusinessCustomer'] ? 'businessCustomer' : 'customer';
    } else {
        // Check in the employee table if not found in the customer table
        $stmt = $conn->prepare("SELECT * FROM employee WHERE e_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
            // Validate password here
            $_SESSION['userId'] = $user['e_id'];

            // Check if the user is also in the technician table
            $stmtTech = $conn->prepare("SELECT * FROM technician WHERE e_id = ?");
            $stmtTech->bind_param("i", $user['e_id']);
            $stmtTech->execute();
            $technician = $stmtTech->get_result()->fetch_assoc();
            $stmtTech->close();
            
            $_SESSION['userType'] = $technician ? 'technician' : 'employee';
            
        } else {
            $error = 'Invalid email or password';
        }
    }

    $stmt->close();

    if ($user) {
        header('Location: ' . $_SESSION['userType'] . '_profile.php');
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
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

        .text-box {
            width: 100%;
            float: left;
            border: 0.01em solid #dddbdb;
            border-radius: 0 0 2% 2%;
            padding: 1em;
        }

        .input-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
            bottom: 0.1em;
        }

        button:focus {
            outline: 0;
        }

        button:active {
            bottom: 0;
            background-color: #fdf;
        }
    </style>
</head>

<body>
    <header>
        <h1>FireSafety</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="contact.html">Contact Us</a>
            <a href="products.html">Products</a>
            <a href="#">Book Online</a>
            <a href="login.html">Log In</a>
        </nav>
    </header>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/login" method="post">
            <label>
                Email:
                <input type="email" name="email" required>
            </label>
            <label>
                Password:
                <input type="password" name="password" required>
            </label>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign up</a></p>
    </div>
</body>

</html>