<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container1">
        <div class="register">
            <h1>Register</h1>
            <form method="POST">
            <div class="order-label">Full Name</div>
            <input type="text" name="full-name" placeholder=" " class="input-responsive" required>

            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" placeholder=" " class="input-responsive" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>

            <div class="order-label">Email</div>
            <input type="email" name="email" placeholder=" " class="input-responsive" required>

            <div class="order-label">Address</div>
            <textarea name="address" rows="10" placeholder=" " class="input-responsive" required></textarea>

            <div class="order-label">Gender</div>
            <select name="gender" class="input-responsive" required>
                <option value="" selected disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <div class="order-label">Password</div>
            <input type="text" name="password" placeholder=" " class="input-responsive"><br>

            <input type="submit" name="submit" value="Register" class="btn btn-primary">
        </form>
        <?php
include "./config/constants.php";

if(isset($_POST['submit'])){
    $fullName = $_POST['full-name'];
    $Number = $_POST['contact'];
    $Email = $_POST['email'];
    $Address = $_POST['address'];
    $Gender = $_POST['gender'];
    $Password = $_POST['password'];

    $query = "INSERT INTO tbl_user(fullName, Number, Email, Address, Gender, Password) VALUES ('$fullName', '$Number', '$Email', '$Address', '$Gender', '$Password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        //echo "User created successfully";
        header("Location: login.php?message=Account created successfully"); // Redirect to login page
        exit();
    } else {
        echo "User not inserted";
    }
}
?>
        </div>
    </div>
</body>
</html>