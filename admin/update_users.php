<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];
    $profile = $_POST['profile'];

    if (!empty($id)) {
        $sql = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `phone` = '$phone', `bio` = '$bio', `profile` = '$profile' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `phone`, `bio`, `profile`) VALUES ('$firstname', '$lastname', '$email', '$phone', '$bio', '$profile')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: users.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: users.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
