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
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
    </div>
    <div class="form-group">
        <label for="category">Post Category ID</label>
        <input type="text" class="form-control" value="<?php echo $post_category; ?>" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" value="<?php echo $post_author; ?>" name="author">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" name="post_status" value="<?php echo $post_status; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
    </div>
</form>