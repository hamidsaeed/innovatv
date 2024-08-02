<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $user_id = $_POST['user_id'];
    $rate = $_POST['rate'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    if (!empty($id)) {
        $sql = "UPDATE `studio` SET `name` = '$name', `user_id` = '$user_id', `rate` = '$rate', `location` = '$location', `description` = '$description' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `studio` (`name`, `user_id`, `rate`, `location`, `description`) VALUES ('$name', '$user_id', '$rate', '$location', '$description')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: studio.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: studio.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
