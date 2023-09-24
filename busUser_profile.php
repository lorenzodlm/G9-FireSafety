<?php
include 'dbconnect.php';

// Assume the user is logged in and you have their email. In a real application, you would typically get this from a session variable.
$email = 'user@example.com'; // Replace with the actual user email

// Prepare SQL to get user information from the database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user is found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die('User not found');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

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
</style>

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

    <body>
        <div id="user-info">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['c_firstname']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['c_lastname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['c_email']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['c_phonenum']); ?></p>
            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($user['c_address'])); ?></p>
            <!-- Display other user information as needed -->
        </div>
    </body>
</body>

</html>