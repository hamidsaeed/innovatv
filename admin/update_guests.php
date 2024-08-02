<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $bio = $_POST['bio'];
    $availability = $_POST['availability'];
    $expertise = $_POST['expertise'];

    if (!empty($id)) {
        $sql = "UPDATE `guest` SET `user_id` = '$user_id',`bio` = '$bio',`availability` = '$availability',`expertise` = '$expertise' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `guest` (`user_id`,`bio`,`availability`,`expertise`) VALUES ('$user_id','$bio','$availability','$expertise')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: guests.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: guests.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
