<?php
session_start();

require_once 'dbconfig.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    echo "already_logged_in";
    $conn->close();
    exit;
}

// Get the form data
$username = $_POST["username"];
$password = $_POST["password"];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["password"];

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Login successful
        $_SESSION["username"] = $username;
        echo "success";
    } else {
        // Invalid password
        echo "Invalid username or password";
    }
} else {
    // Username not found
    echo "Invalid username or password";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>