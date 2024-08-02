<?php
// Database connection details
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

// Get the form data with checks
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Check if required fields are not empty
if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO register_front (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record saved successfully";
        header('Location: login.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo "Error: All fields are required.";
}

$conn->close();
?>
