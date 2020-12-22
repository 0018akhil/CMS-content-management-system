<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<?php 
if(isset($_POST['contact'])){

    ini_set( 'sendmail_from', "0018akhil@gmail.com" );
    ini_set( 'SMTP', "smtp.gmail.com" );
    ini_set( 'smtp_port', 25 );
    $to       = "0018akhil@gmail.com";
    $from     = "From: " . $_POST['email'];
    $subject  = $_POST['subject'];
    $body     = $_POST['body'];

    mail($to, $subject, $body, $from);

}
?>


<!-- Page Content -->
<div class="container">

<section id="login">
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
            <h1>Contact</h1>
                <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Your subject" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" cols="30" rows="10" placeholder="Description"></textarea>
                    </div>
            
                    <input type="submit" name="contact" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                </form>
                
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section>


    <hr>



<?php include "includes/footer.php";?>
