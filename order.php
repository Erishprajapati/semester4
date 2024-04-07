<?php 
    session_start();
    require_once('partials-front/menu.php');
    require_once('config/constants.php'); // assuming you have a file containing constants like SITEURL and database connection

    // Check whether food id is set or not
    if(isset($_GET['food_id'])) {
        // Get the Food id and details of the selected food
        $food_id = $_GET['food_id'];

        // Get the Details of the Selected Food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        // Execute the Query
        $res = mysqli_query($conn, $sql);
        // Count the rows
        $count = mysqli_num_rows($res);
        // Check whether the data is available or not
        if($count==1) {
            // We have data
            // Get the Data from Database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            // Food not Available
            // Redirect to Home Page
            header('location:'.SITEURL);
        }
    } else {
        // Redirect to homepage
        header('location:'.SITEURL);
    }
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php 
                        // Check whether the image is available or not
                        if($image_name=="") {
                            // Image not Available
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            // Image is Available
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
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Full Name" class="input-responsive" required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Email" class="input-responsive" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="Address" class="input-responsive" required></textarea>
                <div class="order-label">Gender</div>
                <select name="gender" class="input-responsive" required>
                    <option value="" selected disabled>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<?php 
    // Check whether submit button is clicked or not
     /* if(isset($_POST['submit'])) {
        // Get all the details from the form
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty; // total = price x qty 
       // $order_date = date("Y-m-d h:i:sa"); // Order Date
        $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];
        /*
        if(isset($_POST['submit'])) {
            // Get all the details from the form
            $order_date = date("Y-m-d H:i:s", strtotime($_POST['order_date'])); // Convert to MySQL datetime format
        
            $order_details = array(
                'food' => $_POST['food'],
                'price' => $_POST['price'],
                'qty' => $_POST['qty'],
                'total' => $_POST['price'] * $_POST['qty'], // total = price x qty 
                'order_date' => $order_date, // Order Date in MySQL datetime format
                'status' => "Ordered",  // Ordered, On Delivery, Delivered, Cancelled
                'customer_name' => $_POST['full-name'],
                'customer_contact' => $_POST['contact'],
                'customer_email' => $_POST['email'],
                'customer_address' => $_POST['address']
            );
        
            // Display the array for debugging purposes
            echo "<pre>";
            print_r($order_details);
            echo "</pre>";      

        

        // Save the Order in Database
        $sql2 = "INSERT INTO tbl_order(food, price, qty, total, status, customer_name, customer_contact, customer_email, customer_address) 
            VALUES ('$food', $price, $qty, $total, '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

        // Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        // Check whether query executed successfully or not
        if($res2==true) {
            // Query Executed and Order Saved
            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
            header('location:'.SITEURL);
            exit; // added exit to prevent further execution
        } else {
            // Failed to Save Order
            $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
            header('location:'.SITEURL);
            exit; // added exit to prevent further execution
            
         } */
         if(isset($_POST['submit'])) {
            // Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; // total = price x qty 
            $order_date = date("Y-m-d H:i:s", strtotime($_POST['order_date'])); // Convert to MySQL datetime format
            $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
        
            // Construct the insert query
            $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
                    VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
        
            // Execute the query
            $result = mysqli_query($conn, $sql);
        
            if ($result) {
                echo "<script>alert('Order inserted successfully.');</script>";
            } else {
                echo "<script>alert('Error inserting order: " . mysqli_error($conn) . "');</script>";
            }
            
        }
?>