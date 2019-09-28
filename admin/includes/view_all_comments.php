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
            $query = "SELECT * FROM comments";
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

//                // Select all data from categories
//                $query = "SELECT * FROM categories WHERE cat_id = $post_category";
//                // Connect data for getting data from categories
//                $select_categories = mysqli_query($connect, $query);
//
//                // Fetch the category from categories table by associative array
//                while ($row = mysqli_fetch_assoc($select_categories)) {
//                    $cat_id = $row["cat_id"];
//                    $cat_title = $row['cat_title'];
//                }

                // Get the post title where commenting
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_post_id = mysqli_query($connect, $query);

                // Fetch the post where commenting
                while ($rows = mysqli_fetch_assoc($select_post_id)) {
                    $post_id = $rows['post_id'];
                    $post_title = $rows['post_title'];
                }

                echo "
                    <tr>
                        <td>{$comment_id}</td>
                        <td>{$comment_author}</td>
                        <td>{$comment_content}</td>
                        <td>{$comment_email}</td>
                        <td>{$comment_status}</td>
                        <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
                        <td>{$comment_date}</td>
                        <td><a href='#'>Approved</a></td>
                        <td><a href='#'>Unapproved</a></td>                        
                        <td><a href='#'>Delete</a></td>
                    </tr>
                ";
            }                            
        ?>
    </tbody>
</table>

<?php
    delete_post();
?>