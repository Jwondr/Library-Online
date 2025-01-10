<?php
// Start the session
session_start();

// Include database connection
require('./db_connect.php');

// Initialize error and success messages
$error = "";
$success = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to check the username
    $sql = "SELECT * FROM `users` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        // Verify the password
        if ($user['password'] === $password) {
            // Set success message and store username in session
            $success = "Login successful! Welcome, " . htmlspecialchars($username) . ".";
            $_SESSION['username'] = $username;
        } else {
            // Set error message for invalid password
            $error = "Invalid password.";
        }
    } else {
        // Set error message for no user found
        $error = "No user found with that username.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCTU Library | Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <!-- Include custom styles -->
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="bg-white p-5 d-flex rounded-3 container-fluid d-flex justify-content-center align-items-center flex-column h-100 col-12 col-md-7 col-lg-5 col-xl-3">
        <!-- Include logo -->
        <?php include('./partials/logo.php') ?>
        <p class="my-subtitle">Log into your account</p>

        <!-- Display login messages -->
        <?php if (!empty($error)): ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="text-success"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Login form -->
        <form class="my-form" method="post" action="">
            <label class="my-label" for="username">Username:</label>
            <input class="my-input" type="text" id="username" name="username" required>
            <label class="my-label" for="password">Password:</label>
            <input class="my-input" type="password" id="password" name="password" required>
            <button class="my-submit" type="submit">Login</button>
        </form>
        <p class="my-alt">Don't have an account? <a href="./register.php">Signup here</a>.</p>
    </div>
</body>

</html>