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
                <?php
                    if (isset($_POST["submit"])) {
                        $cat_title = $_POST["cat_title"];

                        if ($cat_title === "" || empty($cat_title)) {
                            echo "This field should be not be empty";
                        } else {
                            $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
                            $create_category_query = mysqli_query($connect, $query);

                            if (!$create_category_query) {
                                die("Query Failed!" . mysqli_error($connect));
                            }
                        }
                    }
                ?>
                <!-- Start Add Category -->
                <form action="" method="post">
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
                        <?php
                        // Select all data from categories
                        $query = "SELECT * FROM categories";
                        // Connect data for getting data from categories
                        $select_categories = mysqli_query($connect, $query);

                        // Fetch the category from categories table by associative array
                        while ($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_id = $row["cat_id"];
                            $cat_title = $row["cat_title"];

                            echo "
                                    <tr>
                                        <td>{$cat_id}</td>
                                        <td>{$cat_title}</td>
                                        <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                                        <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                                    </tr>
                                ";
                        }
                        ?>

                        <?php
                        // Start Delete Query
                        if (isset($_GET['delete'])) {
                            $cat_delete = $_GET['delete'];

                            $query = "DELETE FROM categories WHERE cat_id = {$cat_delete}";
                            $delete_query = mysqli_query($connect, $query);

                            /*Fix the second click delete problem. The function is reloading the page if click on the delete button.*/
                            header("Location: categories.php");
                        }
                        // End Delete Query                        
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