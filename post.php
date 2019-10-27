<?php
// Header and Navigation
include("includes/header.php");
include("includes/navigation.php");
?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];

                    // Post veiw count query
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                    $send_view_query = mysqli_query($connect, $view_query);

                    // Check the view count query
                    if (!$send_view_query) {
                        die("Query Failed! " . mysqli_error($connect));
                    }

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                    } else {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status == 'published' ";
                    }

                    $select_all_posts_query = mysqli_query($connect, $query);

                    if (mysqli_num_rows($select_all_posts_query) < 1 ) {
                        echo "<h1 class='text-center'>No Post available!</h1>";
                    } else {

                    while ($posts = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $posts["post_title"];
                        $post_author = $posts["post_author"];
                        $post_date = $posts["post_date"];
                        $post_image = $posts["post_image"];
                        $post_content = $posts["post_content"];

                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <?php echo $post_title; ?>
                        </h2>
                        <p class="lead">
                            by
                            <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>"
                             alt="<?php echo $post_title; ?>">
                        <hr>
                        <p><?php echo $post_content; ?></p>

                        <hr>

                        <div class="row">
                            <div class="pull-right">
                                <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Like</a>
                            </div>
                        </div>
                        <div class="row">
                            <p class="pull-right">Like: 10</p>
                        </div>

                    <?php }

            ?>


            <!-- Blog Comments -->

            <?php

                // Check the comment form fields
                if (isset($_POST['create_comment'])) {

                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = mysqli_escape_string($connect, $_POST['comment_content']);

                    // Validate the comment form
                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        // Getting data from the DB
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connect, $query);

                        if (!$create_comment_query) {
                            die("Query Failed!" . mysqli_error($connect));
                        }

                        // Increase the comments to each post
                        $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE post_id = $the_post_id";
                        $update_comment_count = mysqli_query($connect, $query) ;
                    } else {
                        echo "<script>alert('Fields cannot be empty!')</script>";
                    }
                }


            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="author">Your Name</label>
                        <input type="text" name="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" name="comment_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

                // Get data from DB by this query
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connect, $query);

                // Check the DB is connected or not
                if (!$select_comment_query) {
                    die("Query Faield!" . mysqli_error($connect));
                }

                while($row = mysqli_fetch_array($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    ?>

                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>

                <?php } }
                } else {
                    header("Location: index.php");
                }
            ?>
        </div>

        <!-- Siderbar -->
        <?php include("includes/sidebar.php") ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
<?php include("includes/footer.php"); ?>

