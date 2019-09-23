<?php
// For header
include("includes/header.php");
// For navigation
include("includes/navigation.php");
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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>JavaScript</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>HTML</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php
include("includes/footer.php");
?>