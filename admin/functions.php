<?php 

    // Check the query is failed or not
    function confirmQuery($result) {
        // Connect with DB globally inside each function
        global $connect;

        if (!$result) {
            die("Query Failed! " . mysqli_error($connect));
        }        
    }
    
    // Add Categories
    function add_categories() {
        // Connect with DB globally inside each function
        global $connect;

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
    }

    // Display Categories
    function display_categories() {
        // Connect with DB globally inside each function
        global $connect;        

        // Select all data from categories
        $query = "SELECT * FROM categories";
        // Connect DB for getting data from categories
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
    }

    function delete_categories() {
        // Connect with DB globally inside each function
        global $connect;
                
        if (isset($_GET['delete'])) {
            $cat_delete = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$cat_delete}";
            $delete_query = mysqli_query($connect, $query);

            /*Fix the second click delete problem. The function is reloading the page if click on the delete button.*/
            header("Location: categories.php");
        }        
    }

    // Delete Post
    function delete_post() {
        // Connect with DB globally inside each function
        global $connect;

        if (isset($_GET['delete'])) {
            $delete_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
            $delete_post = mysqli_query($connect, $query);

            header("Location: posts.php");
        }
    }

    // Reset visitors
    function reset_visitors() {
        global $connect;

        // Reset Visitors
//        if (isset($_GET['reset'])) {
//            $reset_post_id = $_GET['reset'];
//            $reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$reset_post_id}";
//            mysqli_query($connect, $reset_query);
//
//            header("Location: posts.php");
//        }

        if (isset($_GET['reset'])) {
            $reset_post_id = $_GET['reset'];
            $reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connect, $reset_post_id) . " ";
            mysqli_query($connect, $reset_query);

            header("Location: posts.php");
        }
    }
?>