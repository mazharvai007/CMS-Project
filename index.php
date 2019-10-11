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

                // Post count query
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connect, $post_query_count);
                $count = mysqli_num_rows($find_count);

                $count = ceil($count / 2);

                $post_query = "SELECT * FROM posts";
                $select_all_posts_query = mysqli_query($connect, $post_query);

                while ($posts = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $posts["post_id"];
                    $post_title = $posts["post_title"];
                    $post_author = $posts["post_author"];
                    $post_date = $posts["post_date"];
                    $post_image = $posts["post_image"];
                    $post_content = substr($posts["post_content"], 0, 300);
                    $post_status = $posts["post_status"];

                    if ($post_status == 'published') {?>

                    <h1><?php echo $count; ?></h1>
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
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php }
                }
            ?>



        </div>

        <!-- Siderbar -->
        <?php include("includes/sidebar.php") ?>

    </div>
    <!-- /.row -->

    <hr>

    <div class="pagination-area">
        <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">

                <?php
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                ?>

            </ul>
        </nav>
    </div>

<!-- Footer -->
<?php
    include("includes/footer.php");
?>