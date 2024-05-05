<?php
// Start session
session_start();

// Check if the user is logged in or not
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the login page
    header('location: index.php');
    exit;
}

// Include the menu or header file
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Order Success</h1>
        <p>Thank you for your order! Your order has been successfully placed.</p>
        <!-- You can customize this message further as needed -->
    </div>
</div>

<?php
// Include the footer file
include('partials/footer.php');
?>
