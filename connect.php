<?php
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "bakerymanagment";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn)(
    die("Could not connect to the database");
?>