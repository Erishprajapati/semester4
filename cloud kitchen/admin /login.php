<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        username: <input type="text" name="username" id="" required> <br>
        Password: <input type="password" name="password" id="" required> <br>
        number: <input type="tel" name="number" id="" required><br>
        gender: 
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female<br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <a href="../register/register.php">Dont have an account?</a>
    <?php
    if (isset($_POST['submit'])) {
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $sql = "SELECT stu_id as id, NULL as is_admin FROM student WHERE username = '$user' AND password = '$pass' 
        UNION SELECT id, is_admin FROM user WHERE username = '$user' AND password = '$pass'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            //if exists create session and 
            //redirect to home page
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['is_admin'] = $row['is_admin'];
            header('location:http://localhost/fourthsem/pages/display.php');
        } else {
            //if user doesn't exists prompt
            echo "not found";
        }
    }
    ?>
</body>

</html>