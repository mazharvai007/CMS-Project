<?php
// Connect DB
include("includes/db.php");

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

            $query = "SELECT * FROM posts";
            $select_all_posts_query = mysqli_query($connect, $query);

            while ($posts = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $posts["post_title"];
                $post_author = $posts["post_author"];
                $post_date = $posts["post_date"];
                $post_image = $posts["post_image"];
                $post_content = $posts["post_content"];
                $post_tags = $posts["post_tags"];
                $post_comments_count = $posts["post_comments_count"];
                $post_status = $posts["post_status"];

                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php }

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