<?php
 // Create a database connection
 $servername = "localhost";
 $username = "username";
 $password = "password";
 $dbname = "myDB";

 $conn = new mysqli($servername, $username, $password, $dbname);

 // Check the connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }

 // Get the input data from the login form
 $user = $_POST['username'];
 $pass = $_POST['password'];

 // Check if the username and password are correct
 $sql = "SELECT * FROM users WHERE username='$user' and password='$pass'";
 $result = $conn->query($sql);

 // If the login is successful, redirect to the inside document
 if ($result->num_rows > 0) {
    header("Location: inside.html");
 } else {
    echo "Invalid username or password.";
 }

 $conn->close();
?>