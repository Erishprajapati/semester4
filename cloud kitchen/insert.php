<?php
$username = $_POST['Username'];
$number = $_POST['Number'];
$gender = $_POST['Gender'];
$location = $_POST['Location'];
$password = $_POST['Password'];

if(!empty($username) || !empty($number) || !empty($gender) || !empty($location) || !empty($password)){
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "Cloudkitchen";

//create connection 
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
if(mysqli_connect_error()){
    die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error());
}else{
    $SELECT = "SELECT number From Register Where number = ? Limit 1";
}
} else {
 echo"All field are required";

}
?>