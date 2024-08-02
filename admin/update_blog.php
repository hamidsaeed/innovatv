<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    if (!empty($id)) {
        $sql = "UPDATE `blog_posts` SET `title` = '$title', `image` = '$image', `author` = '$author', `date` = '$date',`content` = '$content'  WHERE `id` = $id";
    } else {
        $sql = "INSERT INTO `blog_posts` (`title`, `image`, `author`, `date`, `content`) VALUES ('$title', '$image', '$author', '$date', '$content')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: blog.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: blogx.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>
