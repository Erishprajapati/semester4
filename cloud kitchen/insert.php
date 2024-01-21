<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$username = $_POST['name'];
$number = $_POST['number'];
$gender = $_POST['genders'];
$location = $_POST['location'];
$password = $_POST['password'];

if (!empty($username) || !empty($number) || !empty($gender) || !empty($location) || !empty($password)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Cloudkitchen";

    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT password FROM Register WHERE password = ? LIMIT 1";
        $INSERT = "INSERT INTO Register (username, number, gender, location, password) VALUES (?, ?, ?, ?, ?)";

        // prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $stmt->bind_result($password);
        $stmt->store_result();
        $rnum = $stmt->num_rows();
        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssss", $username, $number, $gender, $location, $password); // Fix the typo here
            $stmt = $conn->prepare($INSERT);
$stmt->bind_param("sssss", $username, $number, $gender, $location, $password);
try {
    $stmt->execute();
    echo "New record inserted successfully";
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 22001) {
        // Handle the case where data is too long for a column
        echo "Error: Data too long for column.";
    } else {
        // Handle other database-related errors
        echo "Error: " . $e->getMessage();
    }
}

$stmt->close();
$conn->close();
  }
?>
