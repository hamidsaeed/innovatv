<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $base_rate = $_POST['base_rate'];

    if (!empty($id)) {
        $sql = "UPDATE `equipment` SET `user_id` = '$user_id', `name` = '$name', `location` = '$location', `description` = '$description', `base_rate` = '$base_rate' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `equipment` (`user_id`, `name`, `location`, `description`, `base_rate`) VALUES ('$user_id', '$name', '$location', '$description', '$base_rate')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: equipment.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: equipment.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
