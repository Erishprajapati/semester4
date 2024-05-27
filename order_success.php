<?php
session_start();

// Check if the user is logged in or not
if (!isset($_SESSION['user'])) {

    header('location: index.php');
    exit;
}


include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Order Success</h1>
        <p>Thank you for your order! Your order has been successfully placed.</p>
       
    </div>
</div>

<?php

?>
