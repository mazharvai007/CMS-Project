<?php
// Header and Navigation
include("includes/header.php");
include("includes/navigation.php");

if (isset($_POST['liked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

// 1 - Select/Fetching the right Post

    $searchPostQuery = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connect, $searchPostQuery);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['post_likes'];

// 2 - Update Post with likes

    mysqli_query($connect, "UPDATE posts SET post_likes = $likes + 1 WHERE post_id = $post_id");

// 3 - Create likes for post
    mysqli_query($connect, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();
}

if (isset($_POST['unliked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

// 1 - Select/Fetching the right Post

    $searchPostQuery = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connect, $searchPostQuery);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['post_likes'];

//    2 - Delete likes
    mysqli_query($connect, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");

// 3 - Update Post with decrement with likes
    mysqli_query($connect, "UPDATE posts SET post_likes = $likes - 1 WHERE post_id = $post_id");

    exit();
}
?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];

                    // Use MYSQLI Prepare statement for updating post
                    $update_statement = mysqli_prepare($connect, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");
                    mysqli_stmt_bind_param($update_statement, "i", $the_post_id);
                    mysqli_stmt_execute($update_statement);

                    if (!$update_statement) {
                        die("Query Failed! " . mysqli_stmt_error($connect));
                    }

                    if (isset($_SESSION['username']) && is_admin($_SESSION['username'])) {
                        $stmt1 = mysqli_prepare($connect, "SELECT post_title, post_author, post_user, post_date, post_image, post_content FROM posts WHERE post_id = ? ");
                    } else {
                        $stmt2 = mysqli_prepare($connect, "SELECT post_title, post_author, post_user, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ? ");

                        $published = 'published';
                    }

                    if (isset($stmt1)) {
                        mysqli_stmt_bind_param($stmt1, "i", $the_post_id);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);

                        $stmt = $stmt1;
                    } else {
                        mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);

                        $stmt = $stmt2;
                    }


                    while (mysqli_stmt_fetch($stmt)) { ?>

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

                        <?php
                            // Freeing result
                            mysqli_stmt_free_result($stmt);
                        ?>

                        <?php
                            if (isLoggedIn()) { ?>
                                <div class="row">
                                    <div class="pull-right">
                                        <a class="<?php echo userLikedThispost($the_post_id) ? 'unliked' : 'liked'; ?>" href="">
                                            <i class="glyphicon glyphicon-thumbs-up"></i>
                                            <span><?php echo userLikedThispost($the_post_id) ? 'Unlike' : 'Like'; ?></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="pull-right">Like: <?php echo getPostLikes($the_post_id); ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="pull-right">
                                        <p class="lead">You need to <a href="login.php">Login</a> to like!</p>
                                    </div>
                                </div>

                            <?php }
                        ?>

                    <?php



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

<script>
    $(document).ready(function () {
        var post_id = <?php echo $the_post_id; ?>;
        var user_id = <?php echo loggedInUserId(); ?>;
        // Like
       $('.liked').click(function () {
           $.ajax({
               url: "/practice/php/CMS-Project/post.php?p_id=<?php echo $the_post_id; ?>",
               type: 'post',
               data: {
                   'liked': 1,
                   'post_id': post_id,
                   'user_id': user_id
               }
           });
       });

       // Unlike
        $('.unliked').click(function () {
            $.ajax({
                url: "/practice/php/CMS-Project/post.php?p_id=<?php echo $the_post_id; ?>",
                type: 'post',
                data: {
                    'unliked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }
            });
        });
    });
</script>

