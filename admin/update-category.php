<?php 
session_start(); // Start the session

// Include database connection and other necessary files
include('partials/menu.php'); 
include('config/constants.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 
        //Check whether the id is set or not
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            // Create SQL Query to get all other details (Use prepared statements to prevent SQL injection)
            $sql = "SELECT * FROM tbl_category WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the category exists
            if($result->num_rows == 1)
            {
                //Get all the data
                $row = $result->fetch_assoc();
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                // Redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                header('Location: admin/manage-category.php');
                exit(); // Stop further execution
            }
        }
        else
        {
            // Redirect to Manage Category
            header('Location: admin/manage-category.php');
            exit(); // Stop further execution
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Display the Image
                                ?>
                                <img src="../images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
        if(isset($_POST['submit']))
        {
            // Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Updating New Image if selected
            if(isset($_FILES['image']['name']))
            {
                // Get the Image Details
                $image_name = $_FILES['image']['name'];

                // Check whether the image is available or not
                if($image_name != "")
                {
                    // Auto Rename our Image
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Finally Upload the Image
                    if(move_uploaded_file($source_path, $destination_path))
                    {
                        // Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/" . $current_image;
                            unlink($remove_path);
                        }
                    }
                    else
                    {
                        // Failed to upload image
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        header('Location: /manage-category.php');
                        exit();
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            // Update the Database
            $sql2 = "UPDATE tbl_category SET 
                title = ?,
                image_name = ?,
                featured = ?,
                active = ?
                WHERE id=?
            ";

            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ssssi", $title, $image_name, $featured, $active, $id);
            $stmt2->execute();

            if($stmt2->affected_rows > 0)
            {
                // Category Updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('Location: manage-category.php');
                exit();
            }
            else
            {
                // Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                header('Location: manage-category.php');
                exit();
            }


        }
        
        ?>

    </div>
</div>
