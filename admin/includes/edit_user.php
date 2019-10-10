<?php

if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];

    // Select all data from users table
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    // Connect DB for getting data from users
    $get_user_by_id = mysqli_query($connect, $query);

    // Fetch the user from users table by associative array
    while ($row = mysqli_fetch_assoc($get_user_by_id)) {
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


if (isset($_POST['edit_user'])) {

        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];

        $user_image = $_FILES["image"]["name"];
        $user_image_tmp = $_FILES["image"]["tmp_name"];
        // The uploaded image is moved to the images folder
        move_uploaded_file($user_image_tmp,"../images/$user_image");

        // Check the image field is empty or not
        if (empty($user_image)) {
            $query_for_user_image = "SELECT * FROM users WHERE user_id = $the_user_id ";
            $select_user_image = mysqli_query($connect, $query_for_user_image);

            while ($row = mysqli_fetch_array($select_user_image)) {
                $user_image = $row['user_image'];
            }
        }

        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];

        // Encrypt update password
        $query = "SELECT user_randSalt from users";
        $select_randsalt_query = mysqli_query($connect, $query);

        if (!$select_randsalt_query) {
            die("Query Failed! " . mysqli_error($connect));
        }

        $updatePassword = mysqli_fetch_array($select_randsalt_query);
        $salt = $updatePassword['user_randSalt'];
        $hashed_password = crypt($user_password, $salt);

        // Update database
        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', username = '{$username}', user_password = '{$hashed_password}', user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = {$the_user_id}";

        $update_user = mysqli_query($connect, $query);

        confirmQuery($update_user);
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="author">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="">Role</label>
        <select name="user_role" id="" class="form-control">
<!--            <option value="">---Select User Role---</option>-->
            <?php
//                // Select all data from users
//                $query = "SELECT * FROM users";
//                // Connect data for getting data from users
//                $select_user_role = mysqli_query($connect, $query);
//
//                confirmQuery($select_user_role);
//
//                // Fetch the role from table table by associative array
//                while ($row = mysqli_fetch_assoc($select_user_role)) {
//                    $user_id = $row["user_id"];
//                    $user_role = $row['user_role'];
//
//                    echo "
//                            <option value='{$user_id}'>{$user_role}</option>
//                        ";
//                }
            ?>

            <!--Alternate-->
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
                if ($user_role == 'admin') {
                    echo '<option value="subscriber">subscriber</option>';
                } else {
                    echo '<option value="admin">admin</option>';
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
    </div>
    <div class="form-group">
        <label for="status">Email</label>
        <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <img src="../images/<?php echo $user_image; ?>" alt="<?php echo $username; ?>" width="100">
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tags">Password</label>
        <input type="password" name="user_password" value="<?php echo $user_password; ?>" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>