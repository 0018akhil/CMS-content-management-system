<?php
if(isset($_POST['create_user'])){
    usersInsert($_POST['create_user']);
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <lable for="username">Username</lable>
        <input type="text" class="form-control" name="username">
    </div>

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
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <lable for="lastname">Lastname</lable>
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <lable for="user_image">User Image</lable>
        <input type="file" name="user_image" accept="image/*">
    </div>

    <div class="form-group">
        <lable for="user_email">User email</lable>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password">        
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
    </div>
</form>
