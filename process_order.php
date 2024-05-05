
<?php
session_start();
require_once('config/constants.php'); // Include your database connection file

if (isset($_POST['submit'])) {
    // Get form data
    $food_title = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $full_name = $_POST['full-name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Get current date and time
    $order_date_time = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS

    // Insert order into database
    $sql = "INSERT INTO tbl_order (food_title, price, qty, full_name, contact, address, order_date_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "siiisss", $food_title, $price, $qty, $full_name, $contact, $address, $order_date_time);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Order placed successfully
        $_SESSION['success'] = "Order placed successfully!";
        header('location: foods.php');
        exit;
    } else {
        // Error placing order
        $_SESSION['error'] = "Error placing order. Please try again.";
        header('location: order_page.php'); // Redirect back to order page or display error message
        exit;
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect if form is not submitted
    header('location: login.php');
    exit;
}
?>
