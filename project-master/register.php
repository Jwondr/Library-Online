<?php
// Start the session
session_start();

// Include database connection
require('./db_connect.php');

// Initialize error and success messages
$error = "";
$success = "";

// Handle signup form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and passwords from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM `users` WHERE `username` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If username exists, set error message
        if ($result->num_rows > 0) {
            $error = "Username already exists. Please choose a different one.";
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO `users` (`username`, `password`, `created`) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $password);

            // Check if the insertion was successful
            if ($stmt->execute()) {
                $success = "Signup successful! You can now log in.";
            } else {
                $error = "An error occurred. Please try again.";
            }
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCTU Library | Signup</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <!-- Include custom styles -->
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="bg-white p-5 d-flex rounded-3 container-fluid d-flex justify-content-center align-items-center flex-column h-100 col-12 col-md-7 col-lg-5 col-xl-3">
        <!-- Include logo -->
        <?php include('./partials/logo.php') ?>
        <p class="my-subtitle">Create a new account</p>

        <!-- Display signup messages -->
        <?php if (!empty($error)): ?>
            <p class="error text-danger"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="success text-success"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Signup form -->
        <form class="my-form" method="post" action="">
            <label class="my-label" for="username">Username:</label>
            <input class="my-input" type="text" id="username" name="username" required>
            <label class="my-label" for="password">Password:</label>
            <input class="my-input" type="password" id="password" name="password" required>
            <label class="my-label" for="confirm_password">Confirm Password:</label>
            <input class="my-input" type="password" id="confirm_password" name="confirm_password" required>
            <button class="my-submit" type="submit">Signup</button>
        </form>
        <p class="my-alt">Already have an account? <a href="./login.php">Login here</a>.</p>
    </div>
</body>

</html>