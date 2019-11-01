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
                    Welcome to Comments
                    <small><?php echo strtoupper(get_user_name()); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Start View Post -->
        <div class="row">
            <div class="col-lg-12">
                <?php 
                    // Check the source if avaible.
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = "";
                    }
                    // Include the page based on condition technique
                    switch ($source) {
                        case 'add_post':
                            include ("includes/add_post.php");
                            break;
                        case 'edit_post':
                            include ("includes/edit_post.php");
                        default:
                            include ("includes/view_all_comments.php");
                            break;
                    }

                ?>            
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