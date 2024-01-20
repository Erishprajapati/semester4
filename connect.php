<?php 
$username = $_POST['username'];
$number = $_POST['number'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];

//connecting it with data
$conn = new mysqli('localhost','root', '', 'bakerymanagment');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into registration(username,password,address,gender,email,password)values(?,?,?,?,?)")
    $stmt ->bind_param("sissss",$username,$password,$address,$gender)
    $stmt->execute();
    echo"Registration sucessfull...";
    $stmt->close();
    $conn->close();
}