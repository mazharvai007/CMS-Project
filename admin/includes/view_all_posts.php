<div class="row">
    <div class="col-lg-12 no-gutter">
        <form action="" method="post">
            <div class="bulkOptionsContainer">
                <div class="col-lg-3">
                    <select name="" id="" class="form-control">
                        <option value="">---Select Options---</option>
                        <option value="">Published</option>
                        <option value="">Draft</option>
                        <option value="">Delete</option>
                    </select>
                </div>
                <div class="col-lg-9">
                    <input type="submit" name="add_new" class="btn btn-success" value="Apply">
                    <a href="add_post.php" class="btn btn-primary">Add New</a>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="table-responsive col-lg-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    // Select all data from categories
                    $query = "SELECT * FROM posts";
                    // Connect DB for getting data from categories
                    $get_posts = mysqli_query($connect, $query);

                    // Fetch the category from categories table by associative array
                    while ($row = mysqli_fetch_assoc($get_posts)) {
                        $post_id = $row["post_id"];
                        $post_author = $row["post_author"];
                        $post_title = $row["post_title"];
                        $post_category = $row["post_category_id"];
                        $post_status = $row["post_status"];
                        $post_image = $row["post_image"];
                        $post_tags = $row["post_tags"];
                        $post_comments_count = $row["post_comments_count"];
                        $post_date = $row["post_date"];

                        // Select all data from categories
                        $query = "SELECT * FROM categories WHERE cat_id = $post_category";
                        // Connect data for getting data from categories
                        $select_categories = mysqli_query($connect, $query);

                        // Fetch the category from categories table by associative array
                        while ($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_id = $row["cat_id"];
                            $cat_title = $row['cat_title'];
                        }

                        echo "
                            <tr>
                                <td>{$post_id}</td>
                                <td>{$post_author}</td>
                                <td>{$post_title}</td>
                                <td>{$cat_title}</td>
                                <td>{$post_status}</td>
                                <td><img src='../images/{$post_image}' width='100' alt='{$post_title}' class='img-responsive'></td>
                                <td>{$post_tags}</td>
                                <td>{$post_comments_count}</td>
                                <td>{$post_date}</td>
                                <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
                                <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    delete_post();
?>