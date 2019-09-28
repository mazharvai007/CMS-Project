<?php
    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }
    // Select all data from categories
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
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

    // Validate the post update fields
    if (isset($_POST['update_post'])) {
        $post_title = $_POST['title'];
        $post_category = $_POST['post_category'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'] ;
        $post_image = $_FILES['image']['name'];
        $post_image_tmp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        // The uploaded image is moved to the images folder
        move_uploaded_file($post_image_tmp,"../images/$post_image");

        // Check the image field is empty or not
        if (empty($post_image)) {
            $query_for_image = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connect, $query_for_image);

            while ($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category}', post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = {$the_post_id}";

        $update_post = mysqli_query($connect, $query);

        confirmQuery($update_post);

    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
    </div>
    <div class="form-group">
        <label for="">Category</label>
        <select name="post_category" id="" class="form-control">
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
        <input type="file" name="image" class="form-control">
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
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>