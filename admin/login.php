<?php

// Include the database configuration file
include 'database.php';

// Start session
session_start();

// Initialize error message variable
$error_message = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Get form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if user exists in the database
        $sql = "SELECT * FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                // Verify the hashed password
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];

                    // Redirect to the dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error_message = "Invalid email or password.";
                }
            } else {
                $error_message = "User with the specified email does not exist.";
            }
        } else {
            $error_message = "Error executing query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        $error_message = "Please fill in all required fields.";
    }
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
    <title>Login - Admin Panel</title>
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
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/media.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Enter your email address and password to access the admin panel.</p>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <form class="mt-4" method="post" action="login.php">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="password">Password</label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Sign In</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="register.php" class="text-danger">Sign Up</a>
                                </div>
                                <div class="col-lg-12 text-center mt-2">
                                    <a href="change_password.php" class="text-dark">Forgot Password? Change it Now</a>
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
