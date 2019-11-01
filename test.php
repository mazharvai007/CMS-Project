<?php
// Start hash format
//        $password = 'secret';
//        $hash_format = "$2y$710&";
//        $salt = "iusesomecrazystrings22";
//        echo strlen($salt);
//
//        crypt($password, "$2y$710&iusesomecrazystrings22");
// End hash format

//echo password_hash('secret', PASSWORD_DEFAULT, array('cost' => 15));
//echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 15));

require "includes/header.php";

echo loggedInUserId();
if (userLikedThispost(1)) {
    echo "Yes";
} else {
    echo "No";
}
?>