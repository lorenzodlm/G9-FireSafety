<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnect.php';

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check in customer table first to get c_id
    $stmt = $conn->prepare("SELECT * FROM customer WHERE c_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close(); // Close the statement

    if ($user && $password == $user['c_password']) {
        $c_id = $user['c_id'];

        // Check in businesscustomer table using c_id
        $stmtBusiness = $conn->prepare("SELECT * FROM businesscustomer WHERE c_id = ?");
        $stmtBusiness->bind_param("i", $c_id);
        $stmtBusiness->execute();
        $userBusiness = $stmtBusiness->get_result()->fetch_assoc();
        $stmtBusiness->close(); // Close the statement

        if ($userBusiness) {
            $_SESSION['userType'] = 'businesscustomer';
            $_SESSION['userId'] = $c_id;
            $_SESSION['userEmail'] = $user['c_email'];
        } else {
            $_SESSION['userType'] = 'customer';
            $_SESSION['userId'] = $c_id;
            $_SESSION['userEmail'] = $user['c_email'];
        }
        header('Location: index.php'); // Redirect to index.php
        exit;
    } else {
        // If customer login fails, then check in employee table
        $stmt = $conn->prepare("SELECT * FROM employee WHERE e_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close(); // Close the statement

        if ($user && $password == $user['e_password']) {
            $_SESSION['userType'] = 'employee';
            $_SESSION['userId'] = $user['e_id'];
            $_SESSION['userEmail'] = $user['e_email'];

            // Check if the employee is also a technician
            $stmtTech = $conn->prepare("SELECT * FROM technician WHERE e_id = ?");
            $stmtTech->bind_param("i", $user['e_id']);
            $stmtTech->execute();
            $userTech = $stmtTech->get_result()->fetch_assoc();
            $stmtTech->close(); // Close the statement

            if ($userTech) {
                $_SESSION['userType'] = 'technician';
            }
            header('Location: index.php'); // Redirect to index.php
            exit;
        } else {
            $error = "Invalid email or password";
        }
    }
}
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
            <a href="index.php">Home</a>
            <a href="contact.php">Contact Us</a>
            <a href="products.php">Products</a>
            <a href="book_checkup.php">Book Online</a>
            <a href="login.php">Log In</a>
        </nav>
    </header>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
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
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $error) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Don't have an account? <a href="signup.html">Sign up</a></p>
    </div>
</body>

</html>
<?php $conn->close(); ?>