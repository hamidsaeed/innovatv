<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $availability = $_POST['availability'];
    $bio = $_POST['bio'];

    if (!empty($id)) {
        $sql = "UPDATE `host` SET `user_id` = '$user_id', `availability` = '$availability', `bio` = '$bio' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `host` (`user_id`,`availability`,`bio`) VALUES ('$user_id', '$availability','$bio')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: host.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: host.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
