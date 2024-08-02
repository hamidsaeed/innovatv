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

// Check if form data is set
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Check if required fields are not empty
if (!empty($firstname) && !empty($email)) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_front (firstname, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $email, $phone, $message);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: contactfront.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo "Error: First name and email are required.";
}

$conn->close();
?>
