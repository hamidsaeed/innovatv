<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database configuration file
include 'database.php';

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user into the database
    $sql = "INSERT INTO register (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to login page
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Register-Admin Panel</title>
    <link href="../dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">;
            <div class="auth-box row text-center">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/media.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <h2 class="mt-3 text-center">Sign Up for Free</h2>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <form class="mt-4" method="post" action="register.php">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="text" name="name" placeholder="your name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="email" name="email" placeholder="email address" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="password" name="password" placeholder="password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Sign Up</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Already have an account? <a href="login.php" class="text-danger">Sign In</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>

</html>
