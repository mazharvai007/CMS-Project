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
<!--        <th>Delete</th>-->
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



        echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_password</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_image</td>";
            echo "<td>$user_role</td>";
//            echo "<td><a href='comments.php?approved=$comment_id'>Approved</a></td>";
//            echo "<td><a href='comments.php?unapproved=$comment_id'>Unapproved</a></td>";
//            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['approved'])) {
    $approved_comment_id = $_GET['approved'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approved_comment_id ";
    $approved_comment = mysqli_query($connect, $query);

    header("Location: comments.php");
}
if (isset($_GET['unapproved'])) {
    $unapproved_comment_id = $_GET['unapproved'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapproved_comment_id ";
    $unapproved_comment = mysqli_query($connect, $query);

    header("Location: comments.php");
}
if (isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
    $delete_comment = mysqli_query($connect, $query);

    header("Location: comments.php");
}
?>