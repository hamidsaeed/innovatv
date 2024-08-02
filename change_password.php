<?php

// Include the database configuration file
include 'database.php';

// Initialize error message variable
$error_message = "";
$success_message = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['new_password'])) {
        // Get form data
        $email = $_POST['email'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // Check if user exists in the database
        $sql = "SELECT * FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                // Update the password in the database
                $update_sql = "UPDATE register SET password = '$new_password' WHERE email = '$email'";
                if (mysqli_query($conn, $update_sql)) {
                    $success_message = "Password updated successfully.";
                    // Automatically log the user in after changing the password
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error_message = "Error updating password: " . mysqli_error($conn);
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
    <title>Change Password - Admin Panel</title>
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="../assets/images/big/icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Change Password</h2>
                        <p class="text-center">Enter your email address and new password to update your password.</p>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <form class="mt-4" method="post" action="change_password.php">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="enter your email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="new_password">New Password</label>
                                        <input class="form-control" id="new_password" name="new_password" type="password" placeholder="enter your new password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Change Password</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    <a href="login.php" class="text-danger">Back to Login</a>
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
