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
                <form action="" method="post">
                    <div class="form-group">
                        <label for="cat_title">Category Name</label>
                        <input type="text" class="form-control" id="cat_title" name="cat_title">
                    </div>
                    <button type="submit" class="btn btn-primary" value="Add Category">Add Category</button>
                </form>
            </div>
            <div class="col-lg-6">
                <?php
                // Select all data from categoried
                $query = "SELECT * FROM categories";
                // Connect data for getting data from categories
                $select_categories = mysqli_query($connect, $query);
                ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Fetch the category from categories table by associative array
                            while ($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_id = $row["cat_id"];
                                $cat_title = $row["cat_title"];

                                echo "
                                    <tr>
                                        <td>{$cat_id}</td>
                                        <td>{$cat_title}</td>
                                    </tr>
                                ";
                            }
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