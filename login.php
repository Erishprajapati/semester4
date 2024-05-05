<?php 
session_start();

include './config/constants.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $inputUsertype = $_POST['usertype'];

    if($inputUsertype == 1){
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql); 
        $num = mysqli_num_rows($result);
        
        if($num > 0) { 
            $_SESSION['username'] = $username; 
            header("Location: ./admin/index.php");
            exit();
        } else {
            echo "Invalid admin credentials";
        }
        
    } else if ($inputUsertype == 2){
        $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND Password = '$password'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) { 
            $_SESSION['username'] = $username; 
            header("Location: ./index.php"); 
            exit(); 
        } else {
            echo "Invalid credentials";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <div class="wrapper">
            <form method="post" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="usertype">User Type</label>
                    <select name="usertype" id="usertype">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>

                <input type="submit" value="Login" name="login" class="btn-login">
                <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>