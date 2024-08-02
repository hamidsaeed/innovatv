<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    if (!empty($id)) {
        $sql = "UPDATE `advertiser` SET `name` = '$name', `phone` = '$phone', `email` = '$email', `address` = '$address',`status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `advertiser` (`name`, `phone`, `email`, `address`, `status`) VALUES ('$name', '$phone', '$email', '$address', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: advertiser.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: advertiser.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
