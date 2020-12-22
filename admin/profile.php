<?php session_start(); ?>
<?php ob_start();?>
<?php include "../admin/functions.php"?>
<?php include "../includes/db.php"?>
<?php include "includes/admin_header.php"?>

<?php

if(isset($_SESSION['username'])){

    $username = $_SESSION['username'];

    $quary = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_quary = mysqli_query($conn, $quary);

    while($row = mysqli_fetch_assoc($select_user_profile_quary)){

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_password = $row['user_password'];

    }

}

?>

<?php 
    if(isset($_POST['update_profile'])){
        
        editProfile($_SESSION['username']);
    
        header("location: users.php"); 
    }
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    
                    <form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    <lable for="role">Role</lable>

    <select class="form-control" name="role" id="">

        <option value="Subscriber">Select the role</option>
        <option value="admin">Admin</option>
        <option value="Subscriber">Subscriber</option>

    </select>
    
    </div>

    <div class="form-group">
        <lable for="firstname">Firstname</lable>
        <input type="text" class="form-control" name="firstname" value = <?php echo $user_firstname ?>>
    </div>

    <div class="form-group">
        <lable for="lastname">Lastname</lable>
        <input type="text" class="form-control" name="lastname" value = <?php echo $user_lastname ?>>
    </div>
    
    <div class="form-group">
        <lable for="user_email">User email</lable>
        <input type="email" class="form-control" name="user_email" value = <?php echo $user_email ?>>
    </div>

    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password" value = <?php echo $user_password ?>>        
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div>
</form>

                </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>