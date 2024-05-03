<?php
    session_start();
    require_once('config/constants.php');

    if(isset($_POST['submit'])) {
        // Include database connection file if required
        require_once('config/constants.php');

        // Validate quantity
        $qty = $_POST['qty'];
        if ($qty <= 0) {
            echo "Error: Quantity must be greater than 0";
            exit;
        }
        
        // Get order details
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");
        $status = "Ordered";
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_address = $_POST['address'];

        // Insert order into database
        $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_address) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "siiisssss", $food, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_address);
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            // Redirect to order success page
            header('location: order_success.php');
            exit;
        } else {
            echo "<script>alert('Error inserting order: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // If form is not submitted, redirect to homepage or display error message
        header('location:'.SITEURL);
        exit;
    }
?>
