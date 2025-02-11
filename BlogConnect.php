<?php
// create variables to store form data
$Name = $_POST['a'];
$Email = $_POST['b'];
$Comment = $_POST['c'];

// establish connection to MySQL database
$connect = mysqli_connect("localhost", "root", "", "website_data");

// check if connection is successful
if (!$connect) {
    die('Could not connect: ' . mysqli_error());
}

// define SQL query
$sql = "INSERT INTO blog_comments (Vname, email, comment, date_time) VALUES ('$Name', '$Email', '$Comment', 'na')";

// execute query
if (!mysqli_query($connect, $sql)) {
    die('Error: ' . mysqli_error($connect));
}

echo "Thank you for your valuable input";

// close database connection
mysqli_close($connect);
?> 

