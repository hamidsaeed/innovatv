<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($id)) {
        $sql = "UPDATE `register_front` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `password` = '$password'  WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `register_front` (`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name', '$last_name', '$email', '$password')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: register_front.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: register_front.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
