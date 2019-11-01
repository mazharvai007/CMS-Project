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
                    Welcome to
                    <small><?php echo strtoupper(get_user_name()); ?></small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">My Data</a>
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
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $post_count = getAllPostsUser(); ?></div>
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
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $comment_count = getAllCommentsUser(); ?></div>
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
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $category_count = getAllCategoriesUser(); ?></div>
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
            $post_pub_count = userSpecificAllPost('published');

            // Unpublished Post
            $post_unpub_count = userSpecificAllPost('unpublished');

            // Draft Post
            $post_draft_count = userSpecificAllPost('draft');

            // Approved Comments
            $approve_comment_count = userSpecificAllComment('approved');

            // Unapproved Comments
            $unapprove_comment_count = userSpecificAllComment('unapproved');

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
                            $element_text = ['Active Posts', 'Pending Post', 'Draft Posts', 'Active Comments', 'Pending Comments', 'Categories'];
                            $element_count = [$post_pub_count, $post_unpub_count, $post_draft_count, $approve_comment_count, $unapprove_comment_count, $category_count];

                            for ($i = 0; $i < 6; $i++) {
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Pusher Integration -->
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    $(document).ready(function () {
        var puhser = new Pusher('ad1897aebedd9e57665f', {
            cluster: 'us2',
            encrypted: true
        });

        var channel = puhser.subscribe('notifications');
        channel.bind('new_user', function (notification) {
            var message = notification.message;
            toastr.success(`${message} just registered!`);
        })
    });
</script>
