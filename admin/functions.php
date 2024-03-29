<?php

//========= START DATABASE HELPERS =========//

// Redirection
function redirect($location) {
    return header("Location:" . $location);
    exit();
}

// Query Function
function query($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result) {
    return mysqli_fetch_array($result);
}

function numRowsRecords($result) {
    return mysqli_num_rows($result);
}
//========= START DATABASE HELPERS =========//

//========= START AUTHENTICATION HELPERS =========//
// Is admin?
function is_admin() {
    if (isLoggedIn()) {
        $user_query = query("SELECT user_role FROM users WHERE user_id =" . $_SESSION['user_id'] . " ");
        $row = fetchRecords($user_query);

        if ($row['user_role'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}
// Logged in User ID
function loggedInUserId() {
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE username ='" . $_SESSION['username'] . "' ");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}
//========= END AUTHENTICATION HELPERS =========//

//========= START GENERAL HELPERS =========//
function get_user_name() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}
//========= END GENERAL HELPERS =========//

//========= START USER SPECIFIC HELPERS =========//
// Record count of dashboard
function recordCount($table) {
    $post_query = query("SELECT * FROM $table");
    return numRowsRecords($post_query);
}

// Check post, comments, and users (Dashboard Chart)
function checkStatus($table, $column, $status) {

    $checkStatus_query = query("SELECT * FROM $table WHERE $column = '$status' ");
    return numRowsRecords($checkStatus_query);
}

// Get all posts of user
function getAllPostsUser() {
    $post_query = query("SELECT * FROM posts INNER JOIN users ON posts.post_id = users.user_id WHERE user_id= ".loggedInUserId()." ");
    return numRowsRecords($post_query);
}

// Get all comments of user
function getAllCommentsUser() {
    $comment_query = query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id INNER JOIN users ON posts.post_id = users.user_id WHERE user_id =".loggedInUserId()." ");
    return numRowsRecords($comment_query);
}

// Get all categories of user
function getAllCategoriesUser() {
    $category_query = query("SELECT * FROM categories WHERE cat_user_id=".loggedInUserId()." ");
    return numRowsRecords($category_query);
}

// Get the user published, unpublished and draft post
function userSpecificAllPost($status) {
    $userPost = query("SELECT * FROM posts INNER JOIN users ON posts.post_id = users.user_id WHERE users.user_id = ".loggedInUserId()." AND posts.post_status = '$status' ");
    return numRowsRecords($userPost);
}

// Get user approved and unapproved comments
function userSpecificAllComment($status) {
    $userComment = query("SELECT * FROM comments INNER JOIN users ON comments.comment_post_id = users.user_id WHERE users.user_id = ".loggedInUserId()." AND comments.comment_status = '$status' ");
    return numRowsRecords($userComment);
}
//========= END USER SPECIFIC HELPERS =========//

// Check Method
    function ifItIsMethod($method = null) {
        if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
            return true;
        }
        return false;
    }

    // Logged in method
    function isLoggedIn() {
        if (isset($_SESSION['user_role'])) {
            return true;
        }
        return false;
    }

    // Check user logged in
    function checkIfUserLoggedInAndRedirect($redirectLocation = null) {
        if (isLoggedIn()) {
            redirect($redirectLocation);
        }
    }

    /* before going online of a project need to escape all data that files where has database. I used the function in the add_post.php file*/
    function escape($string) {
        global $connect;

        return mysqli_real_escape_string($connect, trim(strip_tags($string)));
    }

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
                $stmt = mysqli_prepare($connect, "INSERT INTO categories(cat_title) VALUES(?)");
                mysqli_stmt_bind_param($stmt, 's', $cat_title);
                mysqli_stmt_execute($stmt);
                if (!$stmt) {
                    die("Query Failed!" . mysqli_error($connect));
                }
            }
            mysqli_stmt_close($stmt);
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

//        if (isset($_GET['delete'])) {
//            $delete_post_id = $_GET['delete'];
//            $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
//            $delete_post = mysqli_query($connect, $query);
//
//            header("Location: posts.php");
//        }

        if (isset($_POST['delete'])) {
            $delete_post_id = $_POST['post_id'];
            $delete_query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
            $delete_post = mysqli_query($connect, $delete_query);

            confirmQuery($delete_post);
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

    // Users online
    function users_online() {

        if (isset($_GET['usersOnline'])) {

            global $connect;

            if (!$connect) {
                session_start();
                include ("../includes/db.php");

                $session = session_id();
                $time = time();
                $time_out_in_seconds = 30;
                $time_out = $time - $time_out_in_seconds;

                $session_query = "SELECT * FROM users_online WHERE session = '$session' ";
                $send_session_query = mysqli_query($connect, $session_query);
                $online_user_count = mysqli_num_rows($send_session_query);

                if ($online_user_count == NULL) {
                    mysqli_query($connect, "INSERT INTO users_online(session, time) VALUES ('$session', $time)");
                } else {
                    mysqli_query($connect, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
                }

                $online_users_query = mysqli_query($connect, "SELECT * FROM users_online WHERE time > '$time_out'");
                echo $user_count = mysqli_num_rows($online_users_query);
            }
        }
    }
    users_online();

    // Image placeholder
    function imagePlaceholder($image='') {
        if (!$image) {
            return 'placeholder.jpeg';
        } else {
            return $image;
        }
    }



    // Check username
    function checkUsername($username) {
        global $connect;

        $username_query = "SELECT username FROM users WHERE username = '$username' ";
        $result = mysqli_query($connect, $username_query);
        confirmQuery($result);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    // Check email
    function checkEmail($email) {
        global $connect;

        $userEmail_query = "SELECT user_email FROM users WHERE user_email = '$email' ";
        $result = mysqli_query($connect, $userEmail_query);
        confirmQuery($result);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Check current user
    function currentUser() {
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }
        return false;
    }

    // Register User
    function register_user($username, $email, $password) {
        global $connect;

        // Escaping the unknown string
        $username = mysqli_real_escape_string($connect, $username);
        $email = mysqli_real_escape_string($connect, $email);
        $password = mysqli_real_escape_string($connect, $password);

        // Password HASH
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));

        // Access the rand salt column

        // Insert register user into the user table
        $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'subscriber' )";
        $register_user_query = mysqli_query($connect, $query);

        confirmQuery($register_user_query);
    }

    // User login
    function login_user($username, $password) {
        global $connect;

        // secure from anonymous injection
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = mysqli_query($connect, $query);

        if (!$select_user_query) {
            die("Query Failed!" . mysqli_error($connect));
        }

        while($row = mysqli_fetch_array($select_user_query)) {
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }

        // Password HASH with verify between login and db
        if (password_verify($password, $db_user_password)) {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            redirect("/practice/php/CMS-Project/admin");
        } else {
//            redirect("/practice/php/CMS-Project/index.php");
            return false;
        }
    }



    // Check user like post?
    function userLikedThispost($post_id) {
        $result = query("SELECT * FROM likes WHERE user_id = '" . loggedInUserId() . "' AND post_id={$post_id} ");
        confirmQuery($result);
        return mysqli_num_rows($result) >= 1 ? true : false;
    }

    // Get all likes of a post
    function getPostLikes($post_id) {
        $result = query("SELECT * FROM likes WHERE post_id =$post_id");
        return mysqli_num_rows($result);
    }
?>