<?php
// Create variables to store form data
$username = $_POST['uname'];
$password = $_POST['psw'];

// Establish connection to MySQL database
$connect = mysqli_connect("localhost", "root", "", "website_data");

// Check if connection is successful
if (!$connect) {
    die('Could not connect: ' . mysqli_error());
}

// Define SQL query to check if user exists
$sql = "SELECT * FROM users WHERE username='$username' AND Vpassword='$password'";

// Execute query
$result = mysqli_query($connect, $sql);

// Check if query returned any rows
if (mysqli_num_rows($result) > 0) {
    header("Location: Course.html");
    exit;
} else {
    echo "Invalid username or password";
}

// Close database connection
mysqli_close($connect);
?> 
