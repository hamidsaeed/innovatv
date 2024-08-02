<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $skills = $_POST['skills'];
    $portfolio = $_POST['portfolio'];
    $rating = $_POST['rating'];

    if (!empty($id)) {
        $sql = "UPDATE `freelance` SET `user_id` = '$user_id', `skills` = '$skills', `portfolio` = '$portfolio', `rating` = '$rating' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `freelance` (`user_id`, `skills`, `portfolio`, `rating`) VALUES ('$user_id', '$skills', '$portfolio', '$rating')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: freelancer.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: freelancer.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
