<?php
// Create variables to store form data
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$course = $_POST['course'];
$gender = $_POST['gender'];
$country_code = $_POST['country_code'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$tenth_percentage = $_POST['10thPercentage'];
$twelth_percentage = $_POST['12thPercentage'];
$password = $_POST['psw'];

// Establish connection to MySQL database
$connect = mysqli_connect("localhost", "root", "", "website_data");

// Check if connection is successful
if (!$connect) {
    die('Could not connect: ' . mysqli_error());
}

// Define SQL query
$sql = "INSERT INTO undergraduate_students (firstname, middlename, lastname, course, gender, country_code, phone, Vaddress, email, tenth_percentage, twelth_percentage, Vpassword) VALUES ('$firstname', '$middlename', '$lastname', '$course', '$gender', '$country_code', '$phone', '$address', '$email', '$tenth_percentage', '$twelth_percentage', '$password')";

// Execute query
if (!mysqli_query($connect, $sql)) {
    die('Error: ' . mysqli_error($connect));
}

echo "Registration successful";

// Close database connection
mysqli_close($connect);
?> 
