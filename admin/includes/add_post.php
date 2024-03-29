<?php 
    if (isset($_POST['add_post'])) {

        $post_title = escape($_POST['title']);
        $post_category_id = escape($_POST['post_category']);
        $post_author = escape($_POST['post_author']);
        $post_user = escape($_POST['post_user']);
        $post_status = escape($_POST['post_status']);

        $post_image = escape($_FILES['image']['name']);
        $post_image_tmp = escape($_FILES['image']['tmp_name']);
        
        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = escape(date("d-m-y"));

        // The uploaded image is moved to the images folder
        move_uploaded_file($post_image_tmp,"../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connect, $query);

        confirmQuery($create_post_query);

        echo "<p class='bg-success'>Post created successfully!</p>";

//        $the_post_id = mysqli_insert_id($connect);
//        echo "
//            <p class='bg-success'>Post Created.
//                <a href='../post.php?p_id={$the_post_id}'>View Post</a>
//                <span>or</span>
//                <a href='posts.php'>Edit More Posts</a>
//            </p>
//        ";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title">
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
<!--    <div class="form-group">-->
<!--        <label for="author">Author</label>-->
<!--        <input type="text" class="form-control" name="author">-->
<!--        <select name="post_author" id="" class="form-control">-->
<!--            --><?php
//            // Select all data from categories
//            $author_query = "SELECT * FROM users";
//            // Connect data for getting data from categories
//            $select_author = mysqli_query($connect, $author_query);
//
//            confirmQuery($select_author);
//
//            // Fetch the category from categories table by associative array
//            while ($row = mysqli_fetch_assoc($select_author)) {
//                $user_id = $row["user_id"];
//                $username = $row['username'];
//
//                echo "
//                        <option value='{$username}'>{$username}</option>
//                    ";
//            }
//            ?>
<!--        </select>-->
<!--    </div>-->
    <div class="form-group">
        <label for="author">User</label>
        <select name="post_user" id="" class="form-control">
            <?php
            // Select all data from categories
            $users_query = "SELECT * FROM users";
            // Connect data for getting data from categories
            $select_users = mysqli_query($connect, $users_query);

            confirmQuery($select_users);

            // Fetch the category from categories table by associative array
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row["user_id"];
                $username = $row['username'];

                echo "
                        <option value='{$username}'>{$username}</option>
                    ";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="post_status" id="" class="form-control">
            <option value="">---Select Option---</option>
            <option value="published">Published</option>
            <option value="unpublished">Unpublished</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_post" value="Add Post">
    </div>
</form>