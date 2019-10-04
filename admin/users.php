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
                        case 'add_user':
                            include ("includes/add_user.php");
                            break;
                        case 'edit_user':
                            include ("includes/edit_user.php");
                        default:
                            include ("includes/view_all_users.php");
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