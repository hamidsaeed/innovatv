<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $platform = $_POST['platform'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    if (!empty($id)) {
        $sql = "UPDATE `adplacement` SET  `platform` = '$platform', `date` = '$date', `duration` = '$duration' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `adplacement` ( `platform`, `date`, `duration`) VALUES ('$platform', '$date', '$duration')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: adplace.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: adplace.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
