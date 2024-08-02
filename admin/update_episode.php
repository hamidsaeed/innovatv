<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $channel = $_POST['channel'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $host_id = $_POST['host_id'];
    $guest_id = $_POST['guest_id'];
    $release_date = $_POST['release_date'];

    if ($id) {
        // Update the existing episode
        $sql = "UPDATE episode SET 
                channel = '$channel', 
                title = '$title', 
                description = '$description', 
                host_id = '$host_id', 
                guest_id = '$guest_id', 
                release_date = '$release_date' 
                WHERE id = $id";
    } else {
        // Insert a new episode
        $sql = "INSERT INTO episode (channel, title, description, host_id, guest_id, release_date) VALUES 
                ('$channel', '$title', '$description', '$host_id', '$guest_id', '$release_date')";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: episode.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: episode.php");
}
?>
