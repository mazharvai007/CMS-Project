<?php

    // Select Checkboxes
    if (isset($_POST['checkBoxArray'])) {

        foreach ($_POST['checkBoxArray'] as $selectPostValueAsID) {
           $selectCheckBoxes = $_POST['checkOptions'];

           switch ($selectCheckBoxes) {
               case 'published':
                   $query = "UPDATE posts SET post_status = '{$selectCheckBoxes}' WHERE post_id = {$selectPostValueAsID} ";
                   $update_to_publish = mysqli_query($connect, $query);
                   confirmQuery($update_to_publish);
                   break;
               case 'unpublished':
                   $query = "UPDATE posts SET post_status = '{$selectCheckBoxes}' WHERE post_id = {$selectPostValueAsID} ";
                   $update_to_unpublish = mysqli_query($connect, $query);
                   confirmQuery($update_to_unpublish);
                   break;
               case 'draft':
                   $query = "UPDATE posts SET post_status = '{$selectCheckBoxes}' WHERE post_id = {$selectPostValueAsID} ";
                   $update_to_draft = mysqli_query($connect, $query);
                   confirmQuery($update_to_draft);
                   break;
               case 'delete':
                   $query = "DELETE FROM posts WHERE post_id = {$selectPostValueAsID} ";
                   $update_to_delete = mysqli_query($connect, $query);
                   confirmQuery($update_to_delete);
                   break;
               default:
                   break;

           }
        }

    }

?>


<form action="" method="post">
    <div class="row">
        <div class="col-lg-12">
            <div class="bulkOptionsContainer">
                <div class="col-lg-3">
                    <select name="checkOptions" id="" class="form-control">
                        <option value="">---Select Options---</option>
                        <option value="published">Published</option>
                        <option value="unpublished">Unpublished</option>
                        <option value="draft">Draft</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="col-lg-9">
                    <input type="submit" name="submit" class="btn btn-success" value="Apply">
                    <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive col-lg-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th><input id="selectAllBoxes" type="checkbox"></th>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>View</th>
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

                            echo "<tr>";
                            ?>
                                <td><input class='selectAllBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                            <?php
                                echo "<td>$post_id</td>";
                                echo "<td>$post_author</td>";
                                echo "<td>$post_title</td>";
                                echo "<td>$cat_title</td>";
                                echo "<td>$post_status</td>";
                                echo "<td><img src='../images/$post_image' width='100' alt='$post_title' class='img-responsive'></td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_comments_count</td>";
                                echo "<td>$post_date</td>";
                                echo "<td><a href='../post.php?p_id=$post_id'>View</a></td>";
                                echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                                echo "<td><a href='posts.php?delete=$post_id'>Delete</a></td>";
                                echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<?php
    delete_post();
?>