<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if (!empty($id)) {
        $sql = "UPDATE `applications` SET `job_id` = '$job_id', `user_id` = '$user_id', `date` = '$date', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `applications` (`job_id`, `user_id`, `date`, `status`) VALUES ('$job_id', '$user_id', '$date', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: application.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: application.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
