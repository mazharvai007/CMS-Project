<?php
// Header and Navigation
include("includes/db.php");
include("includes/header.php");
include("includes/navigation.php");

// Include the phpmailer directories
use PHPMailer\PHPMailer\PHPMailer;
require "./vendor/phpmailer/phpmailer/src/Exception.php";
require "./vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "./vendor/phpmailer/phpmailer/src/SMTP.php";


// Load Composer's autoloader
require "./vendor/autoload.php";

// Include config
//require "./classes/config.php";


if (!ifItIsMethod('get') && !isset($_GET['forgot'])) {
    redirect("index.php");
}

if (ifItIsMethod('post')) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (checkEmail($email)) {
            if ($stmt = mysqli_prepare($connect, "UPDATE users SET token='{$token}' WHERE user_email= ? ")) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                /**
                 * Configure PHPMailer
                 */
                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                // Server Settings to send email
                $mail->isSMTP();
                $mail->Host       = Config::SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = Config::SMTP_USER;
                $mail->Password   = Config::SMTP_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = Config::SMTP_PORT;

                // Recipients
                $mail->setFrom('mazhar@themexpert.com', 'Mazhar');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'This is test email';
                $mail->Body    = 'This is the message body';


                if ($mail->send()){
                    echo "<p class='alert-success text-center'>Mail has been sent</p>";
                } else {
                    echo "<p class='alert-danger text-center'>Mail not sent</p>";
                }
            }
        }  else {
            echo "<p class='alert-danger text-center'>Email address does not match!</p>";
        }

    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->
