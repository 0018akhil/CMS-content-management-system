<?php
if(isset($_POST['upgrade_post'])){

    editposts();

    // header("location: posts.php");    

}

if(isset($_GET['p_id'])){
    $edit_id = $_GET['p_id'];
    $edit_quary = "SELECT * FROM posts WHERE post_id = {$edit_id}";
    $edit_quary = mysqli_query($conn, $edit_quary);

    while($edit_row = mysqli_fetch_assoc($edit_quary)){
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <lable for="title">Post Title</lable>
        <input type="text" class="form-control" name="title" value="<?php echo $edit_row['post_title'] ?>">
    </div>

    <div class="form-group">
        <lable for="post_category_id">post category</lable>

        <select class="form-control" name="post_category_id" id="">

        <?php 

            $category_option_quary = "SELECT * FROM categories";

            $category_option_result = mysqli_query($conn, $category_option_quary);

            while ($category_option_row = mysqli_fetch_assoc($category_option_result)) {

                $cat_option_title_value = $category_option_row['cat_title'];
                $cat_option_title_id = $category_option_row['cat_id'];

        ?>
            <option value="<?php echo $cat_option_title_id ?>"><?php echo $cat_option_title_value ?></option>

        <?php } ?>

        </select>

    </div>

    <div class="form-group">

        <lable for="author">Post Users</lable>
        <select class="form-control" name="author" id="">
            <?php 
                $select_users_quary = "SELECT * FROM users";
                $select_result = mysqli_query($conn, $select_users_quary);

                while($row_result = mysqli_fetch_assoc($select_result)){
                    $user_id = $row_result['user_id'];
                    $username = $row_result['username'];
                    echo "<option value='{$username}'>{$username}</option>";
                }
            ?>
        
        </select>
    </div>

    <div class="form-group">
        <lable for="post_status">post status</lable>
        <select class="form-control" name="post_status" id="">
                <option value="<?php echo $edit_row['post_status'] ?>"><?php echo $edit_row['post_status'] ?></option>
                <?php 
                    if($edit_row['post_status'] == 'publish'){
                        
                        echo '<option value="draft">Draft</option>';

                    } else {

                        echo '<option value="publish">Publish</option>';

                    }
                ?>
        </select>
    </div>

    <img width=100 src="../images/<?php echo $edit_row['post_image'] ?>" alt="<?php echo $edit_row['post_image'] ?>">

    <div class="form-group">
        <input type="file" name="post_image" accept="image/*">
    </div>

    <div class="form-group">
        <lable for="post_tags">Post Tag</lable>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $edit_row['post_tags'] ?>">
    </div>

    <div class="form-group">
        <lable for="posts_content">Post Content</lable> 
        <textarea class="form-control" name="posts_content" id="editor" cols="30" rows="10"><?php echo $edit_row['post_content'] ?></textarea>

    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="upgrade_post" value="Update Post">
    </div>
</form>

<?php } 
} ?>