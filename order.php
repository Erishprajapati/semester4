
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
                    <?php 
                        if($image_name=="") {
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            echo "<img src='images/food/{$image_name}' alt='Chicke Hawain Pizza' class='img-responsive img-curve'>";
                        }
                    ?>
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
                <input type="text" name="full-name" placeholder="Full Name" class="input-responsive" required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" pattern="[0-9]{7,10}" title="Please enter a valid phone number with 7 to 10 digits" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="Address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        // Handle form submission
        $('#order-form').submit(function(event){
            // Prevent default form submission
            event.preventDefault();

            // Gather form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: 'process_order.php', // Replace 'process_order.php' with the actual PHP file handling order processing
                data: formData,
                success: function(response){
                    // Display success message
                    alert('Order placed successfully!');
                    // Redirect to another page if needed
                    window.location.href = 'order_success.php'; // Replace 'order_success.php' with the desired success page
                },
                error: function(xhr, status, error){
                    // Handle errors
                    alert('Error placing order: ' + error);
                }
            });
        });
    });
</script>