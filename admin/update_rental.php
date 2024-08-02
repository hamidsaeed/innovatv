<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $studio_id = $_POST['studio_id'];
    $equipment_id = $_POST['equipment_id'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $return_date = $_POST['return_date'];
    $cost = $_POST['cost'];

    if (!empty($id)) {
        $sql = "UPDATE `rental` SET `studio_id` = '$studio_id', `equipment_id` = '$equipment_id', `user_id` = '$user_id', `date` = '$date', `return_date` = '$return_date', `cost` = '$cost' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `rental` (`studio_id`, `equipment_id`, `user_id`,`date`,`return_date`,`cost`) VALUES ('$studio_id','$equipment_id', '$user_id', '$date','$return_date','$cost')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: rental.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: rental.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
