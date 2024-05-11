<?php
    // Include Constants Page
    include('../config/constants.php');

    // Check if ID and Image Name are set
    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        // Process Deletion

        // Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the Image if Available
        if($image_name != "") {
            // Get the Image Path
            $path = "../images/food/".$image_name;

            // Remove Image File from Folder
            if(file_exists($path)) {
                $remove = unlink($path);

                // Check whether the image is removed or not
                if(!$remove) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                    header('location: ./manage-food.php');
                    exit(); // Stop further execution
                }
            }
        }

        // Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check if the query executed successfully
        if($res) {
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location: ./manage-food.php');
            exit(); // Stop further execution
        } else {
            // Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location: ./manage-food.php');
            exit(); // Stop further execution
        }
    } else {
        // Redirect to Manage Food Page if ID or Image Name is not set
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: ./manage-food.php');
        exit(); // Stop further execution
    }
?>
