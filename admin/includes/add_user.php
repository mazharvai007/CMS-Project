<?php 
    if (isset($_POST['add_user'])) {

        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];

        $user_image = $_FILES["image"]["name"];
        $user_image_tmp = $_FILES["image"]["tmp_name"];
        // The uploaded image is moved to the images folder
        move_uploaded_file($user_image_tmp,"../images/$user_image");

        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_image, username, user_email, user_password) VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_image}', '{$username}', '{$user_email}', '{$user_password}')";

        $create_user_query = mysqli_query($connect, $query);

        confirmQuery($create_user_query);

        echo "User created: " . " " . "<a href='users.php'>View users</a>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="author">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="">Role</label>
        <select name="user_role" id="" class="form-control">
           <option value="">---Select Option---</option>
           <option value="admin">Admin</option>
           <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="status">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tags">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>