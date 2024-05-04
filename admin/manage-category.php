<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />
        <?php 
            // Start session
            session_start();

            // Include database connection file
            require_once('config/db_connect.php');

            // Display session messages
            $session_messages = ['add', 'remove', 'delete', 'no-category-found', 'update', 'upload', 'failed-remove'];
            foreach ($session_messages as $message) {
                if(isset($_SESSION[$message])) {
                    echo $_SESSION[$message];
                    unset($_SESSION[$message]);
                }
            }
        ?>
        <br><br>

        <!-- Button to Add Category -->
        <a href="./add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Query to get all categories from database
                $sql = "SELECT * FROM tbl_category";

                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check if there are any categories
                if(mysqli_num_rows($res) > 0) {
                    // Loop through categories and display them
                    $sn = 1;
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php if(!empty($image_name)) { ?>
                                    <img src="../images/category/<?php echo $image_name; ?>" width="100px" >
                                <?php } else { ?>
                                    <div class='error'>Image not Added.</div>
                                <?php } ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="./update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="./delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // No categories found
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No Category Added.</div></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>
