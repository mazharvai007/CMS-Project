<?php
    session_start();
    include ("db.php");
    include ("../admin/functions.php");

    if (isset($_POST['sign_in'])) {

        $username = trim($_POST['login_user']);
        $password = trim($_POST['login_password']);

        login_user($username, $password);
    }

?>