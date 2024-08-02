<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_id = $_POST['user_id'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $postcode = $_POST['postcode'];
    $status = $_POST['status'];

    if (!empty($id)) {
        $sql = "UPDATE `client` SET `firstname` = '$firstname', `lastname` = '$lastname', `user_id` = '$user_id', `address` = '$address', `email` = '$email', `phone` = '$phone', `postcode` = '$postcode', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `client` (`firstname`, `lastname`, `user_id`, `address`, `email`, `phone`, `postcode`, `status`) VALUES ('$firstname', '$lastname', '$user_id', '$address', '$email', '$phone', '$postcode', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: client.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: client.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
