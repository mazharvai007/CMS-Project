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

                if (isset($_GET['category'])) {
                    $category_posts_id = $_GET['category'];

                    // Fetching post in the category page using the prepared statement part 1
                    if (is_admin($_SESSION['username'])) {
                        $stmt1 = mysqli_prepare($connect, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");
                    } else {
                        $stmt2 = mysqli_prepare($connect, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");

                        $published = 'published';
                    }

                    // Fetching post in the category page using the prepared statement part 2
                    if (isset($stmt1)) {
                        // Bind the data with the int "i"
                        mysqli_stmt_bind_param($stmt1, "i", $category_posts_id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt1);

                        // Bind the result with the variables
                        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                        $stmt = $stmt1;
                    } else {
                        mysqli_stmt_bind_param($stmt2, "is", $category_posts_id, $published);
                        mysqli_stmt_execute($stmt2);

                        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                        $stmt = $stmt2;
                    }

                    if (mysqli_stmt_num_rows($stmt) > 0 ) {
                        echo "<h1 class='text-center'>No Post available!</h1>";
                    }

                // Fetch the data
                while (mysqli_stmt_fetch($stmt)) :

                ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="<?php echo $post_title; ?>">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php endwhile; mysqli_stmt_close($stmt); }
                 else {
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
    <?php
    include("includes/footer.php");
    ?>