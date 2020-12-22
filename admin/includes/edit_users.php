<?php
if(isset($_POST['update_user'])){
    editUser();

    header("location: users.php"); 
}

if(isset($_GET['u_id'])){
    $user_id = $_GET['u_id'];
    $user_edit_quary = "SELECT * FROM users WHERE user_id = {$user_id}";

    $user_edit_result = mysqli_query($conn, $user_edit_quary);

    while($edit_row = mysqli_fetch_assoc($user_edit_result)){
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <lable for="username">Username</lable>
        <input type="text" class="form-control" name="username" value = <?php echo $edit_row['username'] ?>>
    </div>

    <div class="form-group">
    <lable for="role">Role</lable>

    <select class="form-control" name="role" id="">

        <option value=<?php echo $edit_row['user_role'] ?>>Select the role</option>
        <option value="admin">Admin</option>
        <option value="Subscriber">Subscriber</option>

    </select>
    
    </div>

    <div class="form-group">
        <lable for="firstname">Firstname</lable>
        <input type="text" class="form-control" name="firstname" value = <?php echo $edit_row['user_firstname'] ?>>
    </div>

    <div class="form-group">
        <lable for="lastname">Lastname</lable>
        <input type="text" class="form-control" name="lastname" value = <?php echo $edit_row['user_lastname'] ?>>
    </div>
    
    <img width=50 src="../imagesUser/<?php echo $edit_row['user_image'] ?>" alt="<?php echo $edit_row['username'] ?>">

    <div class="form-group">
        <lable for="user_image">User Image</lable>
        <input type="file" name="user_image" accept="image/*">
    </div>

    <div class="form-group">
        <lable for="user_email">User email</lable>
        <input type="email" class="form-control" name="user_email" value = <?php echo $edit_row['user_email'] ?>>
    </div>

    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password" value = "">        
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
    </div>
</form>

<?php }
}
?>