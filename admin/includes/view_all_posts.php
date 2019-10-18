<?php

    include ("delete_post.php");

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
               case 'duplicate':
                   // Detailed way
//                   $query = "SELECT * FROM posts WHERE post_id = {$selectPostValueAsID} ";
//                   $select_duplicate_post_query = mysqli_query($connect, $query);
//
                   // Fetch the query
//                   while ($row = mysqli_fetch_array($select_duplicate_post_query)) {
//                       $post_title = $row['post_title'];
//                       $post_category_id = $row['post_category_id'];
//                       $post_date = $row['post_date'];
//                       $post_author = $row['post_author'];
//                       $post_status = $row['post_status'];
//                       $post_image = $row['post_image'];
//                       $post_tags = $row['post_tags'];
//                       $post_content = $row['post_content'];
//                   }
//
                   // Insert duplicate post into db
//                   $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
//                   $copy_the_post_query = mysqli_query($connect, $query);

                   // Check the duplicate query
//                   if (!$copy_the_post_query) {
//                       die("Query Failed! " . mysqli_error($connect));
//                   }
//
//                   confirmQuery($copy_the_post_query);

                   // Alternate way
                   $query = "INSERT INTO posts (post_tags, post_status, post_category_id, post_title, post_author, post_date ,post_image, post_content )";
                   $query .= "SELECT post_tags, post_status, post_category_id, post_title, post_author, now() ,post_image, post_content FROM posts WHERE post_id='{$selectPostValueAsID}'";
                   $alt_copy_the_post_query = mysqli_query($connect, $query);

                   confirmQuery($alt_copy_the_post_query);

                   echo "<p class='bg-success'>Post duplicate successfully!</p>";
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
        <div class="col-lg-12 nopadding">
            <div class="bulkOptionsContainer">
                <div class="col-lg-3">
                    <select name="checkOptions" id="" class="form-control">
                        <option value="">---Select Options---</option>
                        <option value="published">Published</option>
                        <option value="unpublished">Unpublished</option>
                        <option value="draft">Draft</option>
                        <option value="duplicate">Duplicate</option>
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
                        <th>User</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Preview</th>
                        <th>Views</th>
                        <th>Reset</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        // Select all data from categories
                        $query = "SELECT * FROM posts ORDER BY post_id DESC";
                        // Connect DB for getting data from categories
                        $get_posts = mysqli_query($connect, $query);

                        // Fetch the category from categories table by associative array
                        while ($row = mysqli_fetch_assoc($get_posts)) {
                            $post_id = $row["post_id"];
                            $post_author = $row["post_author"];
                            $post_user = $row["post_user"];
                            $post_title = $row["post_title"];
                            $post_category = $row["post_category_id"];
                            $post_status = $row["post_status"];
                            $post_image = $row["post_image"];
                            $post_tags = $row["post_tags"];
                            $post_comments_count = $row["post_comments_count"];
                            $post_date = $row["post_date"];
                            $post_views_count = $row['post_views_count'];

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


//                                if (isset($post_author) || !empty($post_author)) {
//                                    echo "<td>$post_author</td>";
//                                } else if (isset($post_user) || !empty($post_user)) {
//                                    echo "<td>$post_user</td>";
//                                }

                                echo "<td>$post_author</td>";
                                echo "<td>$post_user</td>";

                                echo "<td>$post_title</td>";
                                echo "<td>$cat_title</td>";
                                echo "<td>$post_status</td>";
                                echo "<td><img src='../images/$post_image' width='100' alt='$post_title' class='img-responsive'></td>";
                                echo "<td>$post_tags</td>";

                                $comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                $send_comment_query = mysqli_query($connect, $comment_query);
                                $comment_row = mysqli_fetch_array($send_comment_query);
                                $comment_id = $comment_row['comment_id'];
                                $count_comment = mysqli_num_rows($send_comment_query);

//                                echo "<td>$post_comments_count</td>";
                                echo "<td><a href='post_comments.php?id=$post_id'>$count_comment</a></td>";
                                echo "<td>$post_date</td>";
                                echo "<td><a href='../post.php?p_id=$post_id'>Preview</a></td>";
                                echo "<td>$post_views_count</td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure, you want to reset the post views?')\" href='posts.php?reset=$post_id'>Reset</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure, you want to edit the post?')\" href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
//                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete=$post_id'>Delete</a></td>";
                                echo "<td><a class='post-delete-btn' href='javascript:void(0)' rel='$post_id'>Delete</a></td>";
                                echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<?php
    reset_visitors();
    delete_post();
?>

<script src="js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $(".post-delete-btn").on("click", function () {
            var post_id = $(this).attr("rel");
            var post_delete = "posts.php?delete=" + post_id +" ";

            $(".delete-post-modal").attr("href", post_delete);
            $("#deleteModalPost").modal('show');
        });
    });
</script>
