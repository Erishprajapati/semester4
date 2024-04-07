<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
     <form action="insert.php" method="post">
        <div>
            <label for="Name">Name:</label><br>
            <input type="text" name="name"><br>
           <label for="Gender">Gender:</label><br>
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female<br>
            <label for="Phone Number">Phone Number:</label><br>
             <input type="tel" name="phone" id="phone"> <br>
            <label for="Email">Email:</label><br>
            <input type="text" name="email"><br>
            <label for="Password">Password:</label><br>
            <input type="password" name="password"><br>
            <input type="submit" value="Create"></submit>
        </div>
    </form>
</body>
</html>