<?php
    include ("db.php");

    session_start();


    if (isset($_POST['sign_in'])) {
        $username = $_POST['login_user'];
        $password = $_POST['login_password'];

        // secure from anonymous injection
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}' ";
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

        // Check the username and password is correct or not
        if ($username !== $db_username && $password !== $db_user_password) {
            header("Location: ../index.php");
        } else {

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            header("Location: ../admin");
        }

        // Alternate
//        if ($username === $db_username && $password === $db_user_password) {
//            $_SESSION['username'] = $db_username;
//            $_SESSION['firstname'] = $db_user_firstname;
//            $_SESSION['lastname'] = $db_user_lastname;
//            $_SESSION['user_role'] = $db_user_role;
//
//            header("Location: ../admin");
//        } else {
//            header("Location: ../index.php");
//        }
    }

?>