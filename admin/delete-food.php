<?php
    // Include Constants Page
    include('../config/constants.php');
    session_start();
    
    // Check whether the id and image_name are set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Get the ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
    
        // Remove the image file if available
        if($image_name != "")
        {
            // Image is available, so remove it
            $path = "../images/food/".$image_name;
            // Attempt to remove the image
            $remove = unlink($path);
    
            // If failed to remove image then add an error message to session but proceed
            if($remove == false)
            {
                // Set the session message
               // $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File. Image may not exist.</div>";
            }
        }
    
        // Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        // Execute the query
        $res = mysqli_query($conn, $sql);
    
        // Check whether the query executed successfully or not
        if($res==true)
        {
            // Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        }
        else
        {
            // Set failure message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        }
        // Redirect to Manage Food page
        header('location: manage-food.php');
    }
    else
    {
        // Redirect to Manage Food Page
        header('location: manage-food.php');
    }
    ?>
    