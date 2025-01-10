<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCTU Library</title>
    <meta name="author" content="Jeremiah Seddoh">
    <meta name="description" content="GCTU Library">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="./assets//bootstrap/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Main heading -->
                <?php include('./partials/logo.php') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Subheading -->
                <h2 class="text-center">Welcome to GCTU Library</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Description paragraph -->
                <p class="text-center">This is a simple library system for GCTU</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex gap-3 justify-content-center align-items-center">
                <!-- Login and Register buttons -->
                <a href="login.php" class="btn btn-primary w-25">Login</a>
                <a href="register.php" class="btn btn-success w-25">Register</a>
            </div>
        </div>
    </div>
    
    <!-- Link to Bootstrap JS -->
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>