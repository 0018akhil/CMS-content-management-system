<?php

function submit_data()
{
    global $conn;
    $element_title = $_POST['cat_title'];
    if ($element_title == "" || empty($element_title)) {
        echo "Need something to insert";
    } else {
        $element_title = escape($element_title);
        $category_quary = "INSERT INTO categories(cat_title) VALUE('{$element_title}');";

        $category_insert = mysqli_query($conn, $category_quary);
    }
}

function delete_categories()
{
    global $conn;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $delete_quary = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

        $delete_result = mysqli_query($conn, $delete_quary);

        header("Location: categories.php");
    }
}

function confirmquary($quaryInput)
{
    if (!$quaryInput) {
        die("no insertion" . mysqli_error($quaryInput));
    }
}


function post_insert($postValue){
    global $conn;
    if (isset($postValue)) {
        $post_title = escape($_POST['title']);
        $post_author = escape($_POST['author']);
        $post_category_id = $_POST['post_category_id'];
        $post_status = escape($_POST['post_status']);
    
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
    
        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['posts_content']);
        $post_date = date('d-m-y');
        $post_comments_count = 0;
        move_uploaded_file($post_image_temp, "../images/$post_image");
    
        $quary = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
    
        $quary .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comments_count}','{$post_status}')";
    
        $post_result = mysqli_query($conn, $quary);
    
        confirmquary($post_result);

        $post_id = mysqli_insert_id($conn);

        echo "<p class='bg-success'>Post updated : <a href='../post.php?p_id={$post_id}'>View post</a> or <a href='posts.php'>View all posts</a></p>";
    
    }
}

function editposts(){
    global $conn;
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category_id = $_POST['post_category_id'];
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['posts_content']);
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $image_quary = "SELECT * FROM posts WHERE post_id = {$_GET['p_id']}";

        $image_result = mysqli_query($conn, $image_quary);

        confirmquary($image_result);

        while($image_row = mysqli_fetch_assoc($image_result)){
            $post_image = $image_row['post_image'];
        }
    }

    $quary = "UPDATE posts SET post_category_id = '{$post_category_id}', post_date = now(), post_title = '{$post_title}', post_author = '{$post_author}', post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}' ";

    $quary .= "WHERE post_id = {$_GET['p_id']}";

    $post_id = $_GET['p_id'];

    $post_result = mysqli_query($conn, $quary);

    confirmquary($post_result);

    echo "<p class='bg-success'>Post updated : <a href='../post.php?p_id={$post_id}'>View post</a> or <a href='posts.php'>View all posts</a></p>";
    
}

function getCategory($cat_id){
    global $conn;
    $cat_title_value = '';
    $edit_quary = "SELECT * FROM categories WHERE cat_id = {$cat_id}";

    $edit_result = mysqli_query($conn, $edit_quary);

    while ($edit_row = mysqli_fetch_assoc($edit_result)) {

        $cat_title_value = $edit_row['cat_title'];

    }

    return $cat_title_value;
}

function usersInsert($userValue){
    global $conn;
    if (isset($userValue)) {
        $username = escape($_POST['username']);
        $user_role = escape($_POST['role']);
        $user_firstname = escape($_POST['firstname']);
        $user_lastname = escape($_POST['lastname']);
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['password']);

        $user_password = password_hash($user_password, PASSWORD_BCRYPT);

        move_uploaded_file($user_image_temp, "../imagesUser/$user_image");
    
        $user_quary = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
    
        $user_quary .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}')";
    
        $user_result = mysqli_query($conn, $user_quary);
    
        confirmquary($user_result);

        echo "Usercreated: " . "<a href='users.php'>View users</a>";
    
    }
}

function editUser(){
    global $conn;
    $username = escape($_POST['username']);
    $user_role = escape($_POST['role']);
    $user_firstname = escape($_POST['firstname']);
    $user_lastname = escape($_POST['lastname']);

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['password']);

    if(empty($user_password)){
        $password_quary = "SELECT user_password FROM users WHERE user_id = {$_GET['u_id']}";
        $password_result = mysqli_query($conn,$password_quary);

        confirmquary($password_result);

        $row = mysqli_fetch_array($password_result);

        $user_password = $row['user_password'];

    } else {

        $user_password = password_hash($user_password, PASSWORD_BCRYPT);


    }
    move_uploaded_file($user_image_temp, "../imagesUser/$user_image");

    if(empty($user_image)){
        $image_user_quary = "SELECT * FROM users WHERE user_id = {$_GET['u_id']}";

        $image_user_result = mysqli_query($conn, $image_user_quary);

        confirmquary($image_user_result);

        while($image_user_row = mysqli_fetch_assoc($image_user_result)){
            $user_image = $image_user_row['user_image'];
        }
    }

    $quary = "UPDATE users SET username = '{$username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}' ";

    $quary .= "WHERE user_id = {$_GET['u_id']}";

    $user_result = mysqli_query($conn, $quary);

    confirmquary($user_result);

}

function editProfile($users_username){
    global $conn;

    $user_role = escape($_POST['role']);
    $user_firstname = escape($_POST['firstname']);
    $user_lastname = escape($_POST['lastname']);
    
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['password']);


    $quary = "UPDATE users SET user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' ";

    $quary .= "WHERE username = '{$users_username}' ";

    $user_result = mysqli_query($conn, $quary);

    confirmquary($user_result);

}

function usersCount(){

    if(isset($_GET['onlineusers'])){
    global $conn;

    if(!$conn){

    session_start();
    include("../includes/db.php");  

    $session = session_id();
    $time = time();
    $time_out_in_session = 30;
    $time_out = $time - $time_out_in_session;

    $session_quary = "SELECT * FROM users_online WHERE session = '{$session}'";
    $session_result = mysqli_query($conn, $session_quary);

    confirmquary($session_result);

    $session_count = mysqli_num_rows($session_result);
    

    if($session_count == null){
        mysqli_query($conn, "INSERT INTO users_online (session, time) VALUES ('{$session}', '{$time}')");
    } else {
        mysqli_query($conn, "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}'");
    }
    $users_online_quary = mysqli_query($conn, "SELECT * FROM users_online WHERE time > {$time_out}");

    $output_users = mysqli_num_rows($users_online_quary);

    echo $output_users;

    
        }
    }
}

usersCount();

function escape($string){
    global $conn;
    return mysqli_escape_string($conn, $string);
}