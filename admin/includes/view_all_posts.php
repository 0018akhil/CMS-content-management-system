<?php if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
            
            case 'publish':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue";
                
                $update_to_publish_status = mysqli_query($conn, $query);

            break;
            
            case 'draft':
    
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue";
                
                $update_to_publish_status = mysqli_query($conn, $query);
    
            break;

            case 'delete':
    
                $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
                
                $delete_publish_status = mysqli_query($conn, $query);

            break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = $checkBoxValue";

                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                
                    $post_image = $row['post_image'];
                
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_comments_count = 0;
                
                }
                $quary = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
            
                $quary .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}', now(),
                '{$post_image}','{$post_content}','{$post_tags}',{$post_comments_count},'{$post_status}')";
            
                $post_result = mysqli_query($conn, $quary);

                break;
        }
    }

    
} ?>

<form action="./posts.php" method="post">
<table class= "table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4" style="
    padding: 0; margin-bottom: 20px;">
            <select class="form-control" name="bulk_options" id="">
                <option value="">select option</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=addposts" class="btn btn-primary">Add New</a>
        </div>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>Users</th>
                                <th>Title</th>
                                <th>Catagory</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Commants</th>
                                <th>Views</th>
                                <th>Date</th>
                                <th>View post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $post_quary = "SELECT * FROM posts";
                            $posts_results = mysqli_query($conn, $post_quary);

                            while($row = mysqli_fetch_assoc($posts_results)){
                                $post_id = $row['post_id'];
                                $post_author = $row['post_author'];
                                $post_title = $row['post_title'];
                                $post_category_id = $row['post_category_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_view_count = $row['post_view_count'];
                                $post_date = $row['post_date'];
                            ?>
                        
                            <tr>
                                <td><input type="checkbox" id="selectBoxes" class ="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
                                <td><?php echo $post_id ?></td>
                                <td><?php echo $post_author ?></td>
                                <td><?php echo $post_title ?></td>

                                <?php $cat_title_value = getCategory($post_category_id) ?>

                                <td><?php echo $cat_title_value ?></td>

                                <td><?php echo $post_status ?></td>
                                <td><img width='100' src="../images/<?php echo $post_image ?>" alt="<?php echo $post_image ?>"></td>
                                <td><?php echo $post_tags ?></td>

                                <?php   
                                    $comment_count_quary = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";

                                    $comment_result = mysqli_query($conn, $comment_count_quary);

                                    $number_of_comments = mysqli_num_rows($comment_result);
                                ?>


                                <td><a href="comments.php?post_id=<?php echo $post_id ?>"><?php echo $number_of_comments ?></a></td>
                                <td><a href="posts.php?reset=<?php echo $post_id ?>"><?php echo $post_view_count ?></a></td>
                                <td><?php echo $post_date ?></td>
                                <td><a href="../post.php?p_id=<?php echo $post_id ?>">View post</a></td>
                                <td><a href="posts.php?source=editposts&p_id=<?php echo $post_id ?>">Edit</a></td>
                                <td><a href="posts.php?delete=<?php echo $post_id ?>">Delete</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
</form>
                    <?php 

                                if(isset($_GET['delete'])){
                                    $delete = $_GET['delete'];

                                    if(isset($_SESSION['role'])){

                                        if($_SESSION['role'] == 'admin'){

                                            $post_quary_delete = "DELETE FROM posts WHERE post_id = {$delete}";
                                            
                                            $delete_quary = mysqli_query($conn, $post_quary_delete);

                                        }


                                    }

                                    header("location: posts.php");
                                }

                                if(isset($_GET['reset'])){
                                    $reset_id = $_GET['reset'];
                                    $reset_views_quary = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$reset_id}";

                                    $reset_quary = mysqli_query($conn, $reset_views_quary);

                                    header("location: posts.php");
                                }
                    ?>