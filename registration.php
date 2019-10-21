<?php
// Header and Navigation
include("includes/header.php");
include("includes/navigation.php");

// User Registration
//if (isset($_POST['register'])) {
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Validate the fields
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    // Validate username field
    if ($username == '') {
        $error['username'] = 'Username can not be empty!';
    } elseif (strlen($username) < 4) {
        $error['username'] = 'Username required at least 4 character.';
    } elseif (checkUsername($username)) {
        $error['username'] = 'Username already exists, pick another one!';
    }

    // Validate email field
    if ($email == '') {
        $error['email'] = 'Email field can not be empty!';
    } elseif (checkEmail($email)) {
        $error['email'] = 'Email already exists, pick another one! or <a href="index.php">Please Login</a>';
    }

    // Check Password
    if ($password == '') {
        $error['password'] = 'Password can not be empty.';
    } elseif (strlen($password) < 4) {
        $error['password'] = 'Password required at least 4 character';
    }

    // User is registered or not
    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }

    if (empty($error)) {
        register_user($username, $email, $password);
        login_user($username, $password);
    }
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
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">
                                <p><?php echo isset($error['username']) ? '<span class="alert-danger">' . $error['username'] . '</span>' : '' ?></p>
                            </div>
                             <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : ''; ?>">
                                 <p><?php echo isset($error['email']) ? '<span class="alert-danger">' . $error['email'] . '</span>' : '' ?></p>
                            </div>
                             <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                 <p><?php echo isset($error['password']) ? '<span class="alert-danger">' . $error['password'] . '</span>' : '' ?></p>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
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
