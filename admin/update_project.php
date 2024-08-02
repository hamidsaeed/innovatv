<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $client_id = $_POST['client_id'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    if (!empty($id)) {
        $sql = "UPDATE `project` SET `title` = '$title', `description` = '$description', `client_id` = '$client_id', `budget` = '$budget', `deadline` = '$deadline', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `project` (`title`, `description`, `client_id`, `budget`, `deadline`, `status`) VALUES ('$title', '$description', '$client_id', '$budget', '$deadline', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: project.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: project.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
