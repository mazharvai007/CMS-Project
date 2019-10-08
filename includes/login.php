<?php
    include ("db.php");

    session_start();


    if (isset($_POST['sign_in'])) {
        $username = $_POST['login_user'];
        $password = $_POST['login_password'];

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

        // Access the rand salt column
        $query = "SELECT user_randSalt FROM users";
        $select_randSalt_query = mysqli_query($connect, $query);

        if (!$select_randSalt_query) {
            die("Query Failed!" . mysqli_error($connect));
        }

        while($row = mysqli_fetch_array($select_randSalt_query)) {
            $salt = $row['user_randSalt'];
        }

        // Encrypting the password
        $password = crypt($password, $salt);

        // Check the username and password is correct or not
        if ($username !== $db_username && $password !== $db_user_password) {
            header("Location: ../index.php");
        } else {
            if (session_status() == PHP_SESSION_NONE) session_start();
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