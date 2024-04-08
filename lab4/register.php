<?php
session_start();

require_once 'dbconfig.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST["username"];
$password = $_POST["password"];

// Validate username and password
$usernameValid = preg_match('/^[a-zA-Z0-9]{3,16}$/', $username);
$passwordValid = preg_match('/^.{8,16}$/', $password);

if ($usernameValid && $passwordValid) {
// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

// Execute the statement
if ($stmt->execute()) {
    // Registration successful
    echo "success";
} else {
    // Registration failed
    echo "Registration failed: " . $stmt->error;
}

// Close the statement
$stmt->close();
} else {
// Invalid username or password
if (!$usernameValid) {
echo "Invalid username. Username must be between 3 and 16 characters long, containing only letters and numbers.";
}
if (!$passwordValid) {
echo "Invalid password. Password must be between 8 and 16 characters long.";
}
}

// Close the connection
$conn->close();
?>