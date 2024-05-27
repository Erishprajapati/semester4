<?php 
    //Include Constants File
    include('../config/constants.php');
    session_start();
    
    // Check whether the id and image_name are set or not
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        // Get the ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
    
        // Remove the image file if available
        if ($image_name != "") {
            // Image is available, so remove it
            $path = "../images/category/" . $image_name;
            // Attempt to remove the image
            $remove = unlink($path);
    
            // If failed to remove image then add an error message to session but proceed
            if ($remove == false) {
                // Set the session message
               // $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Image File. Image may not exist.</div>";
            }
        }
    
        // Delete category from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        // Execute the query
        $res = mysqli_query($conn, $sql);
    
        // Check whether the query executed successfully or not
        if ($res == true) {
            // Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        } else {
            // Set failure message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        }
    
        // Redirect to Manage Category page
        header('location: manage-category.php');
    } else {
        // Redirect to Manage Category Page
        header('location: manage-category.php');
    }
    ?>
    