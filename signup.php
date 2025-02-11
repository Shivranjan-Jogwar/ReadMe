<?php
// Create variables to store form data
$username = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['psw'];

// Establish connection to MySQL database
$connect = mysqli_connect("localhost", "root", "", "website_data");

// Check if connection is successful
if (!$connect) {
    die('Could not connect: ' . mysqli_error());
}

// Define SQL query
$sql = "INSERT INTO users (username, email, Vpassword) VALUES ('$username', '$email', '$password')";

// Execute query
if (!mysqli_query($connect, $sql)) {
    die('Error: ' . mysqli_error($connect));
}

echo "Registration successful";

// Close database connection
mysqli_close($connect);
?> 
