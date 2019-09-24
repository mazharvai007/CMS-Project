<?php
// For header
include("includes/admin_header.php");
// For navigation
include("includes/admin_navigation.php");
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small>Author</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Start View Post -->
        <div class="row">
            <div class="col-lg-12">
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
                                $post_comments = $row["post_comments_count"];
                                $post_date = $row["post_date"];

                                echo "
                                    <tr>
                                        <td>{$post_id}</td>
                                        <td>{$post_author}</td>
                                        <td>{$post_title}</td>
                                        <td>{$post_category}</td>
                                        <td>{$post_status}</td>
                                        <td><img src='../images/{$post_image}' width='100' alt='{$post_title}' class='img-responsive'></td>
                                        <td>{$post_tags}</td>
                                        <td>{$post_comments}</td>
                                        <td>{$post_date}</td>
                                    </tr>
                                ";
                            }                            
                        ?>
                    </tbody>
                </table>            
            </div>            
        </div>
        <!-- End View Post -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php
include("includes/admin_footer.php");
?>