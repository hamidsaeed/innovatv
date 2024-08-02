<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $companyid = $_POST['companyid'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $requirements = $_POST['requirements'];
    $date = $_POST['date'];

    if (!empty($id)) {
        $sql = "UPDATE `job` SET `title` = '$title', `description` = '$description', `companyid` = '$companyid', `location` = '$location', `type` = '$type', `requirements` = '$requirements',`date` = '$date' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `job` (`title`, `description`, `companyid`, `location`, `type`, `requirements`,`date`) VALUES ('$title', '$description', '$companyid', '$location', '$type', '$requirements','$date')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: jobs.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: jobs.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
