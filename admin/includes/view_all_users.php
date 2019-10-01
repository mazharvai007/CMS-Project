<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Date</th>
        <th>Rand Salt</th>
        <th>Status</th>
        <th>Approved</th>
        <th>Unapproved</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    // Select all data from comments table
    $query = "SELECT * FROM users";
    // Connect DB for getting data
    $get_users = mysqli_query($connect, $query);

    // Fetch the category from categories table by associative array
    while ($row = mysqli_fetch_assoc($get_users)) {
        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];
        $user_randSalt = $row["user_randSalt"];
        $user_status = $row["user_status"];



        echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_password</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_image</td>";
            echo "<td>$user_role</td>";
            echo "<td>Date</td>";
            echo "<td>What is it?</td>";
            echo "<td>$user_status</td>";
            echo "<td><a href='users.php?approved=$user_id'>Approved</a></td>";
            echo "<td><a href='users.php?unapproved=$user_id'>Unapproved</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['approved'])) {
    $approved_user_id = $_GET['approved'];
    $query = "UPDATE users SET user_status = 'approved' WHERE user_id = $approved_user_id ";
    $approved_user = mysqli_query($connect, $query);

    header("Location: users.php");
}
if (isset($_GET['unapproved'])) {
    $unapproved_user_id = $_GET['unapproved'];
    $query = "UPDATE users SET user_status = 'unapproved' WHERE user_id = $unapproved_user_id ";
    $unapproved_user = mysqli_query($connect, $query);

    header("Location: users.php");
}
if (isset($_GET['delete'])) {
    $delete_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
    $delete_user = mysqli_query($connect, $query);

    header("Location: users.php");
}
?>