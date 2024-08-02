<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    if (!empty($id)) {
        $sql = "UPDATE `contact_front` SET `firstname` = '$firstname', `email` = '$email', `phone` = '$phone', `message` = '$message'  WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `contact_front` (`firstname`, `email`, `phone`, `message`) VALUES ('$firstname', '$email', '$phone', '$message')";
    }

    if (mysqli_query($conn, $sql)) {
        header('location: contact.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('location: contact.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
