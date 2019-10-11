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
                    $the_post_author = $_GET['author'];
                }
            ?>

                <h1 class="page-header">
                    <?php echo $the_post_author; ?>'s
                    <small>Posts</small>
                </h1>

            <?php

                $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                $select_all_posts_query = mysqli_query($connect, $query);

                while ($posts = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $posts["post_title"];
                    $post_author = $posts["post_author"];
                    $post_date = $posts["post_date"];
                    $post_image = $posts["post_image"];
                    $post_content = $posts["post_content"];

                    ?>

                    <!-- Author Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <?php echo $post_author; ?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                    <hr>
                    <p><?php echo $post_content; ?></p>

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