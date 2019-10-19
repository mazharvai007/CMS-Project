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
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Admin
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $comment_count = recordCount('comments'); ?></div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $user_count = recordCount('users'); ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $category_count = recordCount('categories'); ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <?php
            // Published Post
            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $select_all_pub_post = mysqli_query($connect, $query);
            $post_pub_count = mysqli_num_rows($select_all_pub_post);

            // Unpublished Post
            $query = "SELECT * FROM posts WHERE post_status = 'unpublished'";
            $select_all_unpub_post = mysqli_query($connect, $query);
            $post_unpub_count = mysqli_num_rows($select_all_unpub_post);

            // Draft Post
            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_all_draft_post = mysqli_query($connect, $query);
            $post_draft_count = mysqli_num_rows($select_all_draft_post);

            // Approved Comments
            $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
            $select_all_approved_comment = mysqli_query($connect, $query);
            $approve_comment_count = mysqli_num_rows($select_all_approved_comment);

            // Unapproved Comments
            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $select_all_unapproved_comment = mysqli_query($connect, $query);
            $unapprove_comment_count = mysqli_num_rows($select_all_unapproved_comment);

            // User Admin
            $query = "SELECT * FROM users WHERE user_role = 'admin'";
            $select_all_admin_users = mysqli_query($connect, $query);
            $admin_user_count = mysqli_num_rows($select_all_admin_users);

            // User Subscriber
            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $select_all_sub_users = mysqli_query($connect, $query);
            $sub_user_count = mysqli_num_rows($select_all_sub_users);
        ?>

        <!-- /.row -->
        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                            $element_text = ['Active Posts', 'Pending Post', 'Draft Posts', 'Active Comments', 'Pending Comments', 'Admin', 'Subscriber', 'Categories'];
                            $element_count = [$post_pub_count, $post_unpub_count, $post_draft_count, $approve_comment_count, $unapprove_comment_count, $admin_user_count, $sub_user_count, $category_count];

                            for ($i = 0; $i < 8; $i++) {
                                echo "[ '{$element_text[$i]}'" . ", " . "{$element_count[$i]} ], ";
                            }
                        ?>
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div class="col-lg-12">
                <div id="columnchart_material" style="height: 500px;"></div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php 
    include("includes/admin_footer.php");
?>