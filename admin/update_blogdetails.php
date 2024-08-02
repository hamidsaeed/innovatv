<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $date_posted = $_POST['date_posted'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    if (!empty($id)) {
        $sql = "UPDATE `posts` SET `title` = '$title', `content` = '$content', `author` = '$author', `date_posted` = '$date_posted', `category` = '$category', `image` = '$image' WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `posts` (`title`, `content`, `author`, `date_posted`, `category`, `image`) VALUES ('$title', '$content', '$author', '$date_posted', '$category', '$image')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: blogdetails.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: blogdetails.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
