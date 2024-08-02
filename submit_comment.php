<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innovatv_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form input
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Insert comment into database
$sql = "INSERT INTO comments (post_id, name, email, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $post_id, $name, $email, $message);
$stmt->execute();

// Redirect back to the blog post
header("Location: blog-details.php?id=$post_id");
exit();
?>
