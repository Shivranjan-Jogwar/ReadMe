<?php
// create variables to store form data
$Name = $_POST['name'];
$Email = $_POST['email'];
$Subject=$_POST['subject'];
$Comment = $_POST['message'];


// establish connection to MySQL database
$connect = mysqli_connect("localhost", "root", "", "website_data");

// check if connection is successful
if (!$connect) {
    die('Could not connect: ' . mysqli_error());
}

// define SQL query
$sql = "INSERT INTO contact_messages (Vname, email, Vsubject, Vmessage, date_time) VALUES ('$Name', '$Email', '$Subject', '$Comment', 'na')";

// execute query
if (!mysqli_query($connect, $sql)) {
    die('Error: ' . mysqli_error($connect));
}

echo "Thank you for your valuable input";

// close database connection
mysqli_close($connect);
?> 

