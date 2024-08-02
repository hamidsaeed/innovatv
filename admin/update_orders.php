<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $merchandise_id = $_POST['merchandise_id'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $comments = $_POST['comments'];
    $payment_type = $_POST['payment_type'];
    $discount = $_POST['discount'];
    $referrer = $_POST['referrer'];
    $status = $_POST['status'];

    if (!empty($id)) {
        $sql = "UPDATE `orders` SET `merchandise_id` = '$merchandise_id', `user_id` = '$user_id', `date` = '$date', `qty` = '$qty', `comments` = '$comments', `payment_type` = '$payment_type', `discount` = '$discount',`referrer` = '$referrer', `status` = '$status' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `orders` (`merchandise_id`, `user_id`, `date`, `qty`, `comments`, `payment_type`, `discount`,`referrer`, `status`) VALUES ('$merchandise_id', '$user_id', '$date', '$qty', '$comments', '$payment_type', '$discount','$referrer', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: orders.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: orders.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
