<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $num = $_POST['number'];
    $address = $_POST['add'];
    $gender = $_POST['gender'];
    $gmail = $_POST['mail'];
    $password = $_POST['pass'];

    // Connect to the MySQL database
    $con = mysqli_connect("localhost", "username", "password", "bakerymanagment");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
        $query = "insert into form(username,number,gender,address,email,password) values('$username','$num','$gender','$address','$gmail','$password')";
        mysqli_query($con, $query);
    }
    echo ('Successfully register');
} else {
    echo ('Please Enter some valid information');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumer</title>
        <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form{
            width:300px;
            margin:0 auto;
        }
        h2{
            text-align: center;
            color:black;
        }
        label{
            display:block;
            margin-top:10px;
        }
        input[type="text"],
input[type="number"],
input[type="address"],
input[type="email"],
input[type="password"],
select[name="gender"]
 {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    outline:none;
}

input[type="button"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}
    input[type="button"]:hover {
    background-color: #45a049;
}
.container {
    text-align:left;
    width: 650px;
    height:700px;
    padding: 26px;
    background-color: cadetblue;
    margin: 0 auto;
    margin-top: 100px;
    border: 1px solid black;
    border-radius: 4px;
}

   
    </style>

</head>
<body>
    <div class="container">
        <form action="register.php" method="post">
            <h2>User Sign-in</h2>
            <label for="Uername">Username:</label><br>
            <input type="text" id="username" name="username"><br> 
            <label for="Number">Phone number:</label><br>
            <input type="number" id="number" name="number"><br>
            <label for="adrress">Address:</label><br>
            <input type="address" id="address" name="adrress"><br>
            <label for="gender">Gender:</label> <br>
            <select name="gender" id="gender"> <br>
            <option value="male">Male</option> <br>
            <option value="female">Female</option> </select> 
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="button" value="login"><br>
        </form>
    </div>
</body>
</html>