<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $star_id = $_POST['star_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $user_id = $_POST['user_id'];
    if (!empty($id)) {
        $sql = "UPDATE `giveaway` SET `title` = '$title', `description` = '$description', `star_id` = '$star_id', `start_date` = '$start_date', `end_date` = '$end_date', `user_id` = '$user_id' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `giveaway` (`title`, `description`, `star_id`, `start_date`, `end_date`, `user_id`) VALUES ('$title', '$description', '$star_id', '$start_date', '$end_date', '$user_id')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: giveaway.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: giveaway.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
