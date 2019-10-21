<?php
// Header and Navigation
include("includes/header.php");
include("includes/navigation.php");

// User Registration
if (isset($_POST['contact'])) {

    $to = "mazhar@themexpert.com";
    $yourName = $_POST['yourName'];
    $yourSubject = wordwrap($_POST['yourSubject'], 70);
    $yourMessage = $_POST['yourMessage'];
    $header = "From" . $_POST['yourEmail'];

    // send email
    $sendMail = mail($to, $yourSubject, $yourMessage, $header);

    // if email succesfully sent
    echo ($sendMail)?"<p class='alert-success text-center'>Email Has Been Sent.</p>":"<p class='alert-danger text-center'>Cannot Send Email</p>";
}

?>
    
 
<!-- Page Content -->
<div class="container">
    
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                    <h1>Contact</h1>
                        <form role="form" action="contact.php" method="post" id="contact_form" autocomplete="off">
                            <div class="form-group">
                                <label for="yourName" class="sr-only">Name</label>
                                <input type="text" name="yourName" id="yourName" class="form-control" placeholder="Enter your Name">
                            </div>
                             <div class="form-group">
                                <label for="yourEmail" class="sr-only">Email</label>
                                <input type="email" name="yourEmail" id="yourEmail" class="form-control" placeholder="Enter your email">
                            </div>
                             <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="test" name="yourSubject" id="key" class="form-control" placeholder="Enter your subject">
                            </div>
                             <div class="form-group">
                                <label for="yourMessage" class="sr-only">Message</label>
                                 <textarea name="yourMessage" id="yourMessage" class="form-control" cols="30" rows="10" placeholder="Enter your message..."></textarea>
                            </div>

                            <input type="submit" name="contact" id="btn-contact" class="btn btn-custom btn-lg btn-block" value="Submit">
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
