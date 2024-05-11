<?php 
session_start();
include('partials-front/menu.php');
include('config/constants.php');

if(isset($_GET['food_id'])) {
    // Get the Food id and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $food_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:'.SITEURL);
        exit;
    }
} else {
    header('location:'.SITEURL);
    exit;
}
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form id="order-form" action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php if($image_name == ""): ?>
                        <div class='error'>Image not Available.</div>
                    <?php else: ?>
                        <img src='images/food/<?php echo $image_name; ?>' alt='Chicke Hawain Pizza' class='img-responsive img-curve'>
                    <?php endif; ?>
                </div>
                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">Rs <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Full Name" class="input-responsive" pattern="[A-Za-z]{1,30}" title="Please enter only alphabets and maximum 30 characters." required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" pattern="[0-9]{7,10}" title="Please enter a valid phone number with 7 to 10 digits" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="Address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<?php
if (isset($_POST['submit'])) {
    // Get form data
    $food_title = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $full_name = $_POST['full-name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $total = $price * $quantity;
    $status = 'pending';

    // Get current date and time
    $order_date_time = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
    $sql = "INSERT INTO tbl_order (food, price, qty, total, status, customer_name, customer_contact, customer_address, order_date) 
    values ('$food_title', '$price', '$qty', '$total', '$status', '$full_name', '$contact', '$address', '$order_date_time')";
    $result = mysqli_query($conn, $sql);
if ($result){
    echo "<script>
    if(confirm('Order placed successfully.')) {
        window.location.href = 'http://localhost/semesterfour/fourth/foods.php';
    } else {
        // Redirect to another page or perform other actions if needed
    }
</script>";

} else {
    echo "Error: " . mysqli_error($conn);
}
}
?>
