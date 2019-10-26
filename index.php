<?php
ob_start();
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

                $show_post = 3;

                if (isset($_GET['page'])) {

                    $page = $_GET['page'];
                } else {
                    $page = "";
                }

                if ($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $show_post) - $show_post;
                }

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $post_query_count = "SELECT * FROM posts";
                } else {
                    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' ";
                }

            // Post count query
            $find_count = mysqli_query($connect, $post_query_count);
            $count = mysqli_num_rows($find_count);

            if ($count < 1) {
                echo "<h1 class='text-center'>No Post available!</h1>";
            } else {

            $count = ceil($count / $show_post);

            $post_query = "SELECT * FROM posts LIMIT $page_1, $show_post";
            $select_all_posts_query = mysqli_query($connect, $post_query);

            while ($posts = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $posts["post_id"];
                    $post_title = $posts["post_title"];
                    $post_author = $posts["post_author"];
                    $post_user = $posts["post_user"];
                    $post_date = $posts["post_date"];
                    $post_image = $posts["post_image"];
                    $post_content = substr($posts["post_content"], 0, 300);
                    $post_status = $posts["post_status"];


                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        <!--<a href="post/<?php //echo $post_id; ?>"><?php //echo $post_title; ?></a>-->
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
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
                        if ($i == $page) {
                            echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                ?>

            </ul>
        </nav>
    </div>

<!-- Footer -->
<?php
    include("includes/footer.php");
?>