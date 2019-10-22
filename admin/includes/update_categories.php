<!-- Start Edit Category -->
<form action="" method="post" class="form-group">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <?php

            if (isset($_GET['edit'])) {
                $cat_id_edit = $_GET['edit'];

                // Select all data from categories
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id_edit";
                // Connect data for getting data from categories
                $edit_categories = mysqli_query($connect, $query);

                // Fetch the category from categories table by associative array
                while ($row = mysqli_fetch_assoc($edit_categories)) {
                    $cat_id_edit = $row["cat_id"];
                    $cat_title_edit = $row['cat_title'];
                ?>
                    <input type="text" value="<?php if (isset($cat_title_edit)) { echo $cat_title_edit; } ?>" class="form-control" name="cat_title">
                <?php }
        }?>

        <!-- Update Categories -->
        <?php
            if (isset($_POST['update_category'])) {
                $cat_title_update = $_POST['cat_title'];

                // Update category using mysqli prepare statement
                $stmt = mysqli_prepare($connect, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                mysqli_stmt_bind_param($stmt, 'si', $cat_title_update, $cat_id_edit);
                mysqli_stmt_execute($stmt);
                if (!$stmt) {
                    die("Query Failed!" . mysqli_error($connect));
                }
                mysqli_stmt_close($stmt);
                redirect("categories.php");
            }                                                    
        ?>
    </div>
    <div class="form-group">
        <button type="submit" name="update_category" class="btn btn-primary" value="Update Category">Update Category</button>
    </div>
</form>
<!-- End Edit Category -->