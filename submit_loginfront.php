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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($email) && !empty($password)) {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM register_front WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password); // Corrected: "ss" for two string parameters

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Successful login, redirect or start session
            header('Location: index.php'); 
            exit();
        } else {
            echo "Invalid credentials";
        }

        $stmt->close();
    } else {
        echo "Both fields are required.";
    }
}

$conn->close();
?>
