<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $advertiser_id = $_POST['advertiser_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    if (!empty($id)) {
        $sql = "UPDATE `ad` SET `title` = '$title', `content` = '$content', `advertiser_id` = '$advertiser_id', `start_date` = '$start_date', `end_date` = '$end_date', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `ad` (`title`, `content`, `advertiser_id`, `start_date`, `end_date`, `status`) VALUES ('$title', '$content', '$advertiser_id', '$start_date', '$end_date', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: ad.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: ad.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
