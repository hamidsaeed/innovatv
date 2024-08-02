<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $project_id = $_POST['project_id'];
    $freelancer_id = $_POST['freelancer_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if (!empty($id)) {
        $sql = "UPDATE `bid` SET `project_id` = '$project_id', `freelancer_id` = '$freelancer_id', `amount` = '$amount',  `date` = '$date', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `bid` (`project_id`, `freelancer_id`, `amount`, `date`, `status`) VALUES ('$project_id', '$freelancer_id', '$amount', '$date', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: bidding.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: bidding.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
