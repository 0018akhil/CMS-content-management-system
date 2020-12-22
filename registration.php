<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<?php 
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = mysqli_escape_string($conn, $username);
    $email = mysqli_escape_string($conn, $email);
    $password = mysqli_escape_string($conn, $password);

    $password = password_hash($password, PASSWORD_BCRYPT);

    $quary = "INSERT INTO users(username, user_email, user_password, user_role) ";
    $quary .= "VALUES ('{$username}', '{$email}', '{$password}', 'suscriber')";
    $select_randsalt_quary = mysqli_query($conn, $quary);

    header("location: registration.php");

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
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                    </div>
                        <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                    </div>
                        <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                    </div>
            
                    <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                </form>
                
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section>


    <hr>



<?php include "includes/footer.php";?>
