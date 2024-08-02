<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $industry = $_POST['industry'];
    $location = $_POST['location'];

    if (!empty($id)) {
        $sql = "UPDATE `company` SET `name` = '$name', `description` = '$description', `industry` = '$industry', `location` = '$location',  WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `company` (`name`, `description`, `industry`, `location`) VALUES ('$name', '$description', '$industry', '$location')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: company.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: company.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
