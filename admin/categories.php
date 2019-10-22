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

        <!-- Add and show Category -->
        <div class="row">
            <div class="col-lg-6">
                <!-- Start Add Category -->
                <?php
                    add_categories();
                ?>
                <form action="" method="post" class="form-group">
                    <div class="form-group">
                        <label for="cat_title">Category Name</label>
                        <input type="text" class="form-control" id="cat_title" name="cat_title">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary" value="Add Category">Add Category</button>
                </form>
                <!-- End Add Cateogry -->

                <!-- This function will work if click on the edit of the category item -->
                <?php 
                    if (isset($_GET['edit'])) {
                        $cat_id = $_GET['edit'];

                        include("includes/update_categories.php");
                    }                
                ?>
                
            </div>
            <div class="col-lg-6">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Display Cateries -->
                        <?php
                            display_categories();
                        ?>

                        <!-- Delete Categories -->
                        <?php
                            delete_categories();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php
include("includes/admin_footer.php");
?>