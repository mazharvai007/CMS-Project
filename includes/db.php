<?php
    ob_start();

    // DB connect
    $db["db_host"] = "localhost";
    $db["db_user"] = "root";
    $db["db_pass"] = "91221";
    $db["db_name"] = "cms_project";

    foreach ($db as $key => $value) 
    {
        define(strtoupper($key), $value);
    }

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$connect)
    {
        echo "Database connection is failed!";
    }

?>