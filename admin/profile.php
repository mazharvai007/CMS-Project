<?php
    // For header
    include("includes/admin_header.php");
    // For navigation
    include("includes/admin_navigation.php");

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile_query = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $user_password = $row["user_password"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
            $user_role = $row["user_role"];
            $user_status = $row["user_status"];
        }
    }

    if (isset($_POST['update_profile'])) {

        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', username = '{$username}', user_password = '{$user_password}', user_email = '{$user_email}' WHERE username = '{$username}' ";

        $update_user = mysqli_query($connect, $query);

        confirmQuery($update_user);

        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
    }
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Profile
                    <small><?php echo strtoupper(get_user_name()); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Start View Post -->
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">First Name</label>
                        <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
                    </div>
                    <div class="form-group">
                        <label for="author">Last Name</label>
                        <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label for="">Role</label>-->
<!--                        <select name="user_role" id="" class="form-control">-->
<!--                            <option value="subscriber">--><?php //echo $user_role; ?><!--</option>-->
<!--                            --><?php
//                            if ($user_role == 'admin') {
//                                echo '<option value="subscriber">subscriber</option>';
//                            } else {
//                                echo '<option value="admin">admin</option>';
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="author">Username</label>
                        <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                    </div>
                    <div class="form-group">
                        <label for="status">Email</label>
                        <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tags">Password</label>
                        <input type="password" name="user_password" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                    </div>
                </form>
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