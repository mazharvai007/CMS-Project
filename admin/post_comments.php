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

        <!-- Start View Post -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approved</th>
                                <th>Unapproved</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                // Select all data from comments table
                                $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connect, $_GET['id']). " ";
                                // Connect DB for getting data
                                $get_comments = mysqli_query($connect, $query);

                                // Fetch the category from categories table by associative array
                                while ($row = mysqli_fetch_assoc($get_comments)) {
                                    $comment_id = $row["comment_id"];
                                    $comment_post_id = $row["comment_post_id"];
                                    $comment_author = $row["comment_author"];
                                    $comment_content = $row["comment_content"];
                                    $comment_email = $row["comment_email"];
                                    $comment_status = $row["comment_status"];
                                    $comment_date = $row["comment_date"];

                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_content</td>";
                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_status</td>";

                                        // Get the post title where commenting
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $select_post_id = mysqli_query($connect, $query);
                                        // Fetch the post where commenting
                                        while ($rows = mysqli_fetch_assoc($select_post_id)) {
                                            $post_id = $rows['post_id'];
                                            $post_title = $rows['post_title'];
                                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                        }

                                        echo "<td>$comment_date</td>";
                                        echo "<td><a href='comments.php?approved=$comment_id'>Approved</a></td>";
                                        echo "<td><a href='comments.php?unapproved=$comment_id'>Unapproved</a></td>";
                                        echo "<td><a href='post_comments.php?delete=$comment_id&id=". $_GET['id'] ."'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

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

                        header("Location: post_comments.php?id=" . $_GET['id']. " ");
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