<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $socialmedialinks = $_POST['socialmedialinks'];

    if (!empty($id)) {
        $sql = "UPDATE `mediastar` SET `name` = '$name', `bio` = '$bio',`socialmedialinks` = '$socialmedialinks' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `mediastar` (`name`,`bio`,`socialmedialinks`) VALUES ('$name', '$bio','$socialmedialinks')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: mediastar.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: mediastar.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
