<?php
    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }
    // Select all data from categories
    $query = "SELECT * FROM posts";
    // Connect DB for getting data from categories
    $get_posts_by_id = mysqli_query($connect, $query);

    // Fetch the category from categories table by associative array
    while ($row = mysqli_fetch_assoc($get_posts_by_id)) {
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row['post_content'];
        $post_date = $row["post_date"];
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
    </div>
    <div class="form-group">
        <label for="">Category</label>
        <select name="" id="" class="form-control">
            <?php
                // Select all data from categories
                $query = "SELECT * FROM categories";
                // Connect data for getting data from categories
                $select_categories = mysqli_query($connect, $query);

                confirmQuery($select_categories);

                // Fetch the category from categories table by associative array
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row['cat_title'];

                    echo "
                        <option value='{$cat_id}'>{$cat_title}</option>
                    ";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" value="<?php echo $post_author; ?>" name="author">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" name="post_status" value="<?php echo $post_status; ?>" class="form-control">
    </div>
    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" width="100">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
    </div>
</form>