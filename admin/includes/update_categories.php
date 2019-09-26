<!-- Start Edit Category -->
<form action="" method="post">
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

                $query = "UPDATE categories SET cat_title = '{$cat_title_update}' WHERE cat_id = {$cat_id_edit}";
                $update_query = mysqli_query($connect, $query);

                confirmQuery($update_query);
            }                                                    
        ?>
    </div>
    <div class="form-group">
        <button type="submit" name="update_category" class="btn btn-primary" value="Update Category">Update Category</button>
    </div>
</form>
<!-- End Edit Category -->