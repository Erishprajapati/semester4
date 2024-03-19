<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php include "./partials-front/menu.php" ?>
    <div class="container1">

         <div class="logins">

        </div>

        <div class="register">
            <h1>User Login</h1>
        <form method="POST">
            <div class="inputs">
                <input required type="text" name="username" placeholder="Username or Email">
            </div>
            
            <div class="inputs">
                <input required type="password" name="password" placeholder="Password">
            </div>
            
            <input type="submit" name="submit" class="button" >
        
        </form>
        </div>
        
    </div>
    
    <?php
if(isset($_GET['message'])){
    echo $_GET['message'];
}
?>
    <?php 
    include "../config/constants.php";
    ?>
    <script>

</body>
</html>