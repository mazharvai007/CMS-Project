<?php
// Header and Navigation
include("includes/header.php");
include("includes/navigation.php");

// User Registration
if (isset($_POST['submit'])) {

    // Catch the register form fields
    $username = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fields validation
    if (!empty($username) && !empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {

        // Escaping the unknown string
        $username = mysqli_real_escape_string($connect, $username);
        $firstName = mysqli_real_escape_string($connect, $firstName);
        $lastName = mysqli_real_escape_string($connect, $lastName);
        $email = mysqli_real_escape_string($connect, $email);
        $password = mysqli_real_escape_string($connect, $password);

        // Access the rand salt column
        $query = "SELECT user_randSalt FROM users";
        $select_randSalt_query = mysqli_query($connect, $query);

        if (!$select_randSalt_query) {
            die("Query Failed!" . mysqli_error($connect));
        }

        $row = mysqli_fetch_array($select_randSalt_query);
        $salt = $row['user_randSalt'];

        // Insert register user into the user table
        $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_image, user_role) VALUES ('{$username}', '{$firstName}', '{$lastName}', '{$email}', '{$password}', '', 'subscriber' )";
        $register_user_query = mysqli_query($connect, $query);
        if (!$register_user_query) {
            die("Query Failed!" . mysqli_error($connect));
        }

        $message = "<p class='alert-success text-center'>Registration has been submitted!</p>";
    } else {
        $message = "<p class='alert-danger text-center'>All fields are required!</p>";
    }
} else {
    $message = "";
}

?>
    
 
<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                    <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <?php echo $message; ?>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="sr-only">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="sr-only">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                            </div>
                             <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                             <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>


<!-- Footer -->
<?php
    include("includes/footer.php");
?>
