<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $star_id = $_POST['star_id'];
    $base_rate = $_POST['base_rate'];
    $stock = $_POST['stock'];
    if (!empty($id)) {
        $sql = "UPDATE `merchandise` SET `name` = '$name', `description` = '$description', `star_id` = '$star_id', `base_rate` = '$base_rate', `stock` = '$stock' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `merchandise` (`name`, `description`, `star_id`, `base_rate`, `stock`) VALUES ('$name', '$description', '$star_id', '$base_rate', '$stock')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: merchandise.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: merchandise.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
